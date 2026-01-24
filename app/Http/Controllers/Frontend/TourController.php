<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourBooking;
use App\Models\TourDate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $query = Tour::with([
            'agent',
            'tourDates' => function($query) {
                $query->where('status', 'available')
                      ->where('date', '>=', now()->toDateString())
                      ->orderBy('date');
            }
        ])->where('status', 'active');

        // Filter by location
        if ($request->has('location') && $request->location) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by difficulty
        if ($request->has('difficulty') && $request->difficulty) {
            $query->where('difficulty_level', $request->difficulty);
        }

        // Filter by duration
        if ($request->has('duration') && $request->duration) {
            $query->where('duration_hours', '<=', $request->duration);
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sort options
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');
        $query->orderBy($sort, $order);

        $tours = $query->paginate(12);
        $locations = Tour::where('status', 'active')->distinct()->pluck('location');

        return view('frontend.tours', compact('tours', 'locations'));
    }

    public function show($id)
    {
        $tour = Tour::with([
            'agent',
            'tourDates' => function($query) {
                $query->where('status', 'available')
                      ->where('date', '>=', now()->toDateString())
                      ->orderBy('date');
            }
        ])->where('status', 'active')->findOrFail($id);

        // Get related tours (same location or same agent)
        $relatedTours = Tour::where('status', 'active')
            ->where('id', '!=', $tour->id)
            ->where(function($q) use ($tour) {
                $q->where('location', $tour->location)
                  ->orWhere('agent_id', $tour->agent_id);
            })
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('frontend.tour-show', compact('tour', 'relatedTours'));
    }

    public function checkAvailability(Request $request, $id)
    {
        $request->validate([
            'tour_date_id' => 'required|exists:tour_dates,id',
            'people' => 'required|integer|min:1'
        ]);

        $tour = Tour::findOrFail($id);
        $tourDate = TourDate::where('id', $request->tour_date_id)
            ->where('tour_id', $id)
            ->where('status', 'available')
            ->first();

        if (!$tourDate) {
            return response()->json([
                'available' => false,
                'message' => 'No available slots for this date'
            ]);
        }

        $availableSlots = $tourDate->available_slots - $tourDate->booked_slots;

        if ($availableSlots < $request->people) {
            return response()->json([
                'available' => false,
                'message' => "Only {$availableSlots} slots available"
            ]);
        }

        // Check if user is logged in
        if (!Auth::check()) {
            return response()->json([
                'available' => true,
                'requires_login' => true,
                'message' => 'Please login to book this tour'
            ]);
        }

        return response()->json([
            'available' => true,
            'tour_date_id' => $tourDate->id,
            'price_per_person' => $tour->price,
            'total_amount' => $tour->price * $request->people,
            'start_time' => $tourDate->start_time
        ]);
    }

    public function book(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'tour_date_id' => 'required|exists:tour_dates,id',
            'people' => 'required|integer|min:1|max:20',
            'special_requests' => 'nullable|string|max:500',
        ]);

        $tour = Tour::findOrFail($id);
        $tourDate = TourDate::findOrFail($request->tour_date_id);

        // Verify the tour date belongs to this tour
        if ($tourDate->tour_id != $tour->id) {
            return back()->with('error', 'Invalid tour date selected.');
        }

        // Check availability
        $availableSlots = $tourDate->available_slots - $tourDate->booked_slots;

        if ($availableSlots < $request->people) {
            return back()->with('error', "Only {$availableSlots} slots available.");
        }

        // Create booking - FIXED: Using correct field names from your TourBooking model
        $booking = TourBooking::create([
            'booking_number' => 'TB-' . strtoupper(Str::random(10)), // Use booking_number, not booking_reference
            'tour_id' => $tour->id,
            'tour_date_id' => $tourDate->id,
            'user_id' => Auth::id(),
            'agent_id' => $tour->agent_id, // Add agent_id
            'number_of_people' => $request->people,
            'price_per_person' => $tour->price, // Add price_per_person
            'total_amount' => $tour->price * $request->people,
            'status' => 'pending',
            'payment_status' => 'pending', // Add payment_status
            'special_requests' => $request->special_requests,
        ]);

        // Update booked slots
        $tourDate->increment('booked_slots', $request->people);

        // Redirect to confirmation page
        return redirect()->route('booking.confirmation', $booking)
                         ->with('success', 'Tour booked successfully!');
    }

    public function confirmation(TourBooking $booking)
    {
        // Verify the booking belongs to the logged-in user
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('frontend.tour-booking-confirmation', compact('booking'));
    }

    public function myBookings()
    {
        $bookings = Auth::user()->tourBookings()
            ->with(['tour', 'tourDate'])
            ->latest()
            ->paginate(10);

        return view('frontend.tour-mybookings', compact('bookings'));
    }
}
