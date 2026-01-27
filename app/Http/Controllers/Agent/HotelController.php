<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index()
    {
        $agent = Auth::user()->agent;

        if (!$agent) {
            return redirect()->route('agent.dashboard')
                ->with('error', 'Please complete your agent profile first.');
        }

        // Check if agent has hotel service
        if (!$agent->hasService('hotel')) {
            return redirect()->route('agent.dashboard')
                ->with('error', 'Hotel service is not enabled for your account.');
        }

        // Get or create the hotel
        $hotel = $agent->hotel;

        if (!$hotel) {
            // Create hotel for the agent
            $hotel = Hotel::create([
                'agent_id' => $agent->id,
                'name' => $agent->business_name,
                'address' => $agent->address,
                'phone' => $agent->phone,
                'email' => $agent->email,
                'check_in_time' => '14:00',
                'check_out_time' => '12:00',
                'amenities' => json_encode(['wifi', 'parking', 'breakfast']),
                'status' => 'active',
            ]);
        }

        return redirect()->route('agent.hotels.show', $hotel);
    }

    public function show(Hotel $hotel)
    {
        $agent = Auth::user()->agent;

        if ($hotel->agent_id !== $agent->id) {
            abort(403);
        }

        // Get counts manually since rooms table doesn't have hotel_id column
        $roomsCount = Room::where('agent_id', $hotel->agent_id)->count();
        $bookingsCount = RoomBooking::where('agent_id', $hotel->agent_id)->count();

        $todayCheckins = RoomBooking::where('agent_id', $hotel->agent_id)
            ->whereDate('check_in', now()->toDateString())
            ->whereIn('status', ['confirmed', 'checked_in'])
            ->orderBy('check_in')
            ->limit(5)
            ->get();

        $todayCheckouts = RoomBooking::where('agent_id', $hotel->agent_id)
            ->whereDate('check_out', now()->toDateString())
            ->whereIn('status', ['checked_in', 'checked_out'])
            ->orderBy('check_out')
            ->limit(5)
            ->get();

        // Add counts to hotel object for view
        $hotel->rooms_count = $roomsCount;
        $hotel->bookings_count = $bookingsCount;

        return view('agent.hotels.show', compact('hotel', 'todayCheckins', 'todayCheckouts'));
    }

    public function edit(Hotel $hotel)
    {
        $agent = Auth::user()->agent;

        if ($hotel->agent_id !== $agent->id) {
            abort(403);
        }

        return view('agent.hotels.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $agent = Auth::user()->agent;

        if ($hotel->agent_id !== $agent->id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:500',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'check_in_time' => 'required|date_format:H:i',
            'check_out_time' => 'required|date_format:H:i',
            'policies' => 'nullable|string',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle amenities as JSON
        if ($request->has('amenities')) {
            $validated['amenities'] = json_encode($validated['amenities']);
        } else {
            $validated['amenities'] = json_encode([]);
        }

        if ($request->hasFile('image')) {
            if ($hotel->image) {
                Storage::disk('public')->delete($hotel->image);
            }
            $validated['image'] = $request->file('image')->store('hotels', 'public');
        }

        $hotel->update($validated);

        return redirect()->route('agent.hotels.show', $hotel)
            ->with('success', 'Hotel updated successfully!');
    }
}
