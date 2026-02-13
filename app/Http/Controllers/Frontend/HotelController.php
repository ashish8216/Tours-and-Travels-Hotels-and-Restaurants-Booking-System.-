<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    /**
     * Display a listing of hotels.
     */
    public function index(Request $request)
    {
        $query = Hotel::where('status', 'active')->with('agent');

        // Search by name
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('city', 'like', '%' . $request->search . '%')
                  ->orWhere('address', 'like', '%' . $request->search . '%');
        }

        // Filter by city
        if ($request->has('city') && $request->city) {
            $query->where('city', $request->city);
        }

        // Filter by amenities
        if ($request->has('amenities') && $request->amenities) {
    $amenities = is_array($request->amenities) ? $request->amenities : explode(',', $request->amenities);

    $query->where(function ($q) use ($amenities) {
        foreach ($amenities as $amenity) {
            $amenity = trim($amenity);
            // Try JSON contains first
            $q->orWhereJsonContains('amenities', $amenity);
            // Also check for string contains (for legacy data)
            $q->orWhere('amenities', 'like', '%' . $amenity . '%');
        }
    });
}

        // Sort options
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');

        if ($sort === 'price') {
            // Get hotels with their minimum room price
            $query->addSelect(['min_price' => Room::selectRaw('MIN(price_per_night)')
                ->whereColumn('agent_id', 'hotels.agent_id')
                ->where('availability', 'available')
            ])->orderBy('min_price', $order);
        } else {
            $query->orderBy($sort, $order);
        }

        // Get distinct cities for filter
        $cities = Hotel::where('status', 'active')->distinct()->pluck('city')->filter();

        $hotels = $query->paginate(12)->withQueryString();

        return view('frontend.hotels.index', compact('hotels', 'cities'));
    }

    /**
     * Display the specified hotel.
     */
    public function show(Hotel $hotel)
    {
        // Get available rooms for this hotel (using agent_id since no direct hotel_id relationship)
        $rooms = Room::where('agent_id', $hotel->agent_id)
                     ->where('availability', 'available')
                     ->get();

        return view('frontend.hotels.show', compact('hotel', 'rooms'));
    }

    /**
     * Show booking form for a room.
     */
    public function book(Request $request, Hotel $hotel, Room $room)
    {
        // Verify room belongs to the same agent as hotel
        if ($room->agent_id !== $hotel->agent_id) {
            abort(404, 'Room not found for this hotel');
        }

        // Validate dates
        $request->validate([
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:' . $room->max_guests,
        ]);

        // Calculate nights and total price
        $check_in = \Carbon\Carbon::parse($request->check_in);
        $check_out = \Carbon\Carbon::parse($request->check_out);
        $nights = $check_out->diffInDays($check_in);
        $total_amount = $room->price_per_night * $nights;

        // Check room availability for dates
        $isAvailable = $this->checkRoomAvailability($room, $request->check_in, $request->check_out);

        if (!$isAvailable) {
            return back()->with('error', 'This room is not available for the selected dates.');
        }

        return view('frontend.hotels.booking', compact('hotel', 'room', 'check_in', 'check_out', 'nights', 'total_amount'));
    }

    /**
     * Store a new booking.
     */
    public function storeBooking(Request $request, Hotel $hotel, Room $room)
    {
        // Verify room belongs to the same agent as hotel
        if ($room->agent_id !== $hotel->agent_id) {
            abort(404, 'Room not found for this hotel');
        }

        // Validate booking data
        $validated = $request->validate([
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:' . $room->max_guests,
            'guest_name' => 'required|string|max:255',
            'guest_phone' => 'required|string|max:20',
            'special_requests' => 'nullable|string',
        ]);

        // Check room availability
        $isAvailable = $this->checkRoomAvailability($room, $request->check_in, $request->check_out);

        if (!$isAvailable) {
            return back()->with('error', 'This room is no longer available for the selected dates.');
        }

        // Calculate total amount
        $check_in = \Carbon\Carbon::parse($request->check_in);
        $check_out = \Carbon\Carbon::parse($request->check_out);
        $nights = $check_out->diffInDays($check_in);
        $total_amount = $room->price_per_night * $nights;

        // Create booking
        $booking = RoomBooking::create([
            'agent_id' => $hotel->agent_id,
            'room_id' => $room->id,
            'user_id' => Auth::id(),
            'guest_name' => $validated['guest_name'],
            'guest_phone' => $validated['guest_phone'],
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'price_per_night' => $room->price_per_night,
            'total_amount' => $total_amount,
            'status' => 'pending',
            'booking_source' => 'frontend',
        ]);

        return redirect()->route('hotels.booking.confirmation', $booking)
                        ->with('success', 'Booking submitted successfully! We will contact you soon.');
    }

    /**
     * Show booking confirmation.
     */
    public function bookingConfirmation(RoomBooking $booking)
    {
        // Ensure the booking belongs to the authenticated user
        if (Auth::id() !== $booking->user_id) {
            abort(403);
        }

        // Load related data
        $booking->load(['room', 'user', 'agent']);

        // Get hotel from agent_id
        $hotel = Hotel::where('agent_id', $booking->agent_id)->first();

        return view('frontend.hotels.booking-confirmation', compact('booking', 'hotel'));
    }

    /**
     * Check room availability for given dates.
     */
    private function checkRoomAvailability(Room $room, $check_in, $check_out)
    {
        // Check if room is marked as available
        if ($room->availability !== 'available') {
            return false;
        }

        // Check for overlapping bookings
        $overlappingBookings = RoomBooking::where('room_id', $room->id)
            ->where(function ($query) use ($check_in, $check_out) {
                $query->whereBetween('check_in', [$check_in, $check_out])
                      ->orWhereBetween('check_out', [$check_in, $check_out])
                      ->orWhere(function ($q) use ($check_in, $check_out) {
                          $q->where('check_in', '<=', $check_in)
                            ->where('check_out', '>=', $check_out);
                      });
            })
            ->whereIn('status', ['pending', 'confirmed', 'checked_in'])
            ->exists();

        return !$overlappingBookings;
    }

    /**
     * Show user's hotel bookings.
     */
    public function myBookings()
    {
        return redirect()->route('my-bookings.index', ['#hotel']);
    }

    /**
     * Cancel a booking.
     */
    public function cancelBooking(RoomBooking $booking)
    {
        // Ensure the booking belongs to the authenticated user
        if (Auth::id() !== $booking->user_id) {
            abort(403);
        }

        // Only allow cancellation of pending or confirmed bookings
        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return back()->with('error', 'Cannot cancel this booking.');
        }

        $booking->update([
            'status' => 'cancelled',
            'status_updated_at' => now(),
        ]);

        return back()->with('success', 'Booking cancelled successfully.');
    }
}
