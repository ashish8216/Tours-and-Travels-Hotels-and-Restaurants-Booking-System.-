<?php
// app/Http/Controllers/Frontend/MyBookingController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TourBooking;
use App\Models\RoomBooking;
use App\Models\RestaurantReservation; // Add this line
use App\Models\Hotel;

class MyBookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all tour bookings
        $tourBookings = TourBooking::with(['tour', 'agent', 'tourDate'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get all room bookings (which represent hotel bookings)
        $roomBookings = RoomBooking::with(['room.hotel', 'agent', 'user'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get all restaurant reservations
        $restaurantReservations = RestaurantReservation::with(['restaurant', 'table', 'agent', 'user'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.my-bookings.index', compact(
            'tourBookings',
            'roomBookings',
            'restaurantReservations'
        ));
    }

    public function showTourBooking($id)
    {
        $booking = TourBooking::with(['tour', 'agent', 'tourDate', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('frontend.my-bookings.tour-show', compact('booking'));
    }

    public function showRoomBooking($id)
    {
        $booking = RoomBooking::with(['room.hotel', 'agent', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('frontend.my-bookings.room-show', compact('booking'));
    }

    // Add this new method for showing restaurant reservation details
    public function showRestaurantReservation($id)
    {
        $reservation = RestaurantReservation::with(['restaurant', 'table', 'agent', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('frontend.my-bookings.restaurant-show', compact('reservation'));
    }
}
