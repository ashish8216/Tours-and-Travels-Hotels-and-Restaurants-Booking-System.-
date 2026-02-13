<?php
// app/Http/Controllers/Frontend/HomeController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Hotel;
use App\Models\Restaurant;

class HomeController extends Controller
{
    public function index()
    {
        // Get popular/featured tours
        $popularTours = Tour::with('agent')
            ->where('status', 'active')
            ->latest()
            ->take(4)
            ->get();

        // Get featured hotels
        $featuredHotels = Hotel::with('agent')
            ->where('status', 'active')
            ->latest()
            ->take(4)
            ->get();

        // Get popular restaurants
        $popularRestaurants = Restaurant::with('agent')
            ->where('status', 'active')
            ->latest()
            ->take(4)
            ->get();

        // Get counts for stats
        $tours_count = Tour::where('status', 'active')->count();
        $hotels_count = Hotel::where('status', 'active')->count();
        $restaurants_count = Restaurant::where('status', 'active')->count();

        return view('frontend.home', compact(
            'popularTours',
            'featuredHotels',
            'popularRestaurants',
            'tours_count',
            'hotels_count',
            'restaurants_count'
        ));
    }
}
