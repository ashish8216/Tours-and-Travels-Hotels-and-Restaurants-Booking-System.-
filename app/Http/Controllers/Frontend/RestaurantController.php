<?php
// app/Http/Controllers/Frontend/RestaurantController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\RestaurantTable;
use App\Models\RestaurantReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    /**
     * Display a listing of restaurants.
     */
    public function index(Request $request)
    {
        $query = Restaurant::where('status', 'active');

        // Search by name or location
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('cuisine_type', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by cuisine type
        if ($request->has('cuisine') && $request->cuisine) {
            $query->where('cuisine_type', $request->cuisine);
        }

        // Filter by location
        if ($request->has('location') && $request->location) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by capacity
        if ($request->has('capacity') && $request->capacity) {
            $query->where('capacity', '>=', $request->capacity);
        }

        // Sort options
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');
        $query->orderBy($sort, $order);

        // Get distinct cuisine types and locations for filters
        $cuisines = Restaurant::where('status', 'active')
            ->whereNotNull('cuisine_type')
            ->distinct()
            ->pluck('cuisine_type')
            ->filter();

        $locations = Restaurant::where('status', 'active')
            ->distinct()
            ->pluck('location')
            ->filter();

        $restaurants = $query->paginate(12)->withQueryString();

        return view('frontend.restaurants.index', compact('restaurants', 'cuisines', 'locations'));
    }

    /**
     * Display the specified restaurant.
     */
    public function show(Restaurant $restaurant)
    {
        if ($restaurant->status !== 'active') {
            abort(404);
        }

        // Get available tables
        $tables = $restaurant->tables()
            ->where('status', 'available')
            ->orderBy('capacity')
            ->get();

        return view('frontend.restaurants.show', compact('restaurant', 'tables'));
    }

    /**
     * Check table availability for a specific date and time.
     */
    public function checkAvailability(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'guests' => 'required|integer|min:1',
        ]);

        // Find tables that can accommodate the guests
        $availableTables = $restaurant->tables()
            ->where('status', 'available')
            ->where('capacity', '>=', $request->guests)
            ->get()
            ->filter(function($table) use ($request) {
                return $table->isAvailableFor($request->date, $request->time);
            });

        // Group tables by capacity
        $groupedTables = $availableTables->groupBy('capacity');

        return response()->json([
            'available' => $availableTables->count() > 0,
            'tables' => $groupedTables->map(function($tables, $capacity) {
                return [
                    'capacity' => $capacity,
                    'count' => $tables->count(),
                    'tables' => $tables->map(function($table) {
                        return [
                            'id' => $table->id,
                            'name' => $table->table_name ?? $table->table_number,
                            'type' => $table->type,
                        ];
                    })
                ];
            })->values(),
            'total_tables' => $availableTables->count(),
        ]);
    }

    /**
     * Show reservation form.
     */
    public function reserve(Request $request, Restaurant $restaurant)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to make a reservation.');
        }

        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'guests' => 'required|integer|min:1',
        ]);

        // Check if restaurant is open at the selected time
        $openingTime = \Carbon\Carbon::parse($restaurant->opening_time);
        $closingTime = \Carbon\Carbon::parse($restaurant->closing_time);
        $selectedTime = \Carbon\Carbon::parse($request->time);

        if ($selectedTime->lt($openingTime) || $selectedTime->gt($closingTime)) {
            return back()->with('error', 'Restaurant is closed at the selected time.');
        }

        // Check available tables
        $availableTables = $restaurant->tables()
            ->where('status', 'available')
            ->where('capacity', '>=', $request->guests)
            ->get()
            ->filter(function($table) use ($request) {
                return $table->isAvailableFor($request->date, $request->time);
            });

        if ($availableTables->isEmpty()) {
            return back()->with('error', 'No tables available for the selected date and time.');
        }

        return view('frontend.restaurants.reservation', compact('restaurant', 'request', 'availableTables'));
    }

    /**
     * Store a new reservation.
     */
    public function storeReservation(Request $request, Restaurant $restaurant)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'restaurant_table_id' => 'required|exists:restaurant_tables,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'guests' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'special_requests' => 'nullable|string|max:500',
        ]);

        // Check if table is still available
        $table = RestaurantTable::find($validated['restaurant_table_id']);

        if (!$table || $table->restaurant_id !== $restaurant->id) {
            return back()->with('error', 'Invalid table selected.');
        }

        if (!$table->isAvailableFor($validated['date'], $validated['time'])) {
            return back()->with('error', 'This table is no longer available at the selected time.');
        }

        // Create reservation
        $reservation = RestaurantReservation::create([
            'restaurant_id' => $restaurant->id,
            'restaurant_table_id' => $table->id,
            'user_id' => Auth::id(),
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'number_of_people' => $validated['guests'],
            'reservation_date' => $validated['date'],
            'reservation_time' => $validated['time'],
            'status' => 'pending',
            'special_requests' => $validated['special_requests'],
            'agent_id' => $restaurant->agent_id,
            'reservation_number' => 'RES-' . strtoupper(Str::random(8)),
        ]);

        return redirect()->route('restaurants.reservation.confirmation', $reservation)
            ->with('success', 'Reservation submitted successfully! We will confirm shortly.');
    }

    /**
     * Show reservation confirmation.
     */
    public function reservationConfirmation(RestaurantReservation $reservation)
    {
        if (Auth::id() !== $reservation->user_id) {
            abort(403);
        }

        $reservation->load(['restaurant', 'table', 'agent']);

        return view('frontend.restaurants.reservation-confirmation', compact('reservation'));
    }

    /**
     * Cancel a reservation.
     */
    public function cancelReservation(RestaurantReservation $reservation)
    {
        if (Auth::id() !== $reservation->user_id) {
            abort(403);
        }

        if (!in_array($reservation->status, ['pending', 'confirmed'])) {
            return back()->with('error', 'Cannot cancel this reservation.');
        }

        $reservation->cancel('Cancelled by customer');

        return back()->with('success', 'Reservation cancelled successfully.');
    }
}
