<?php

use App\Http\Controllers\Agent\DashboardController;
use App\Http\Controllers\Agent\HotelController;
use App\Http\Controllers\Agent\RestaurantController;
use App\Http\Controllers\Agent\RestaurantReservationController;
use App\Http\Controllers\Agent\RestaurantTableController;
use App\Http\Controllers\Agent\RoomBookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\AgentRequestController;
use App\Http\Controllers\Agent\RoomController;
use App\Http\Controllers\Agent\TourBookingController;
use App\Http\Controllers\Agent\TourController;
use App\Http\Controllers\Agent\TourDateController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TourController as FrontendTourController;
use App\Http\Controllers\Frontend\HotelController as FrontendHotelController; // Add this
use App\Http\Controllers\Frontend\MyBookingController as FrontendMyBookingController;
use App\Http\Controllers\Frontend\RestaurantController as FrontendRestaurantController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('frontend.home');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    $user = Auth::user();

    return match ($user->role) {
        'admin' => redirect('/admin'),
        'agent' => redirect()->route('agent.dashboard'),
        default => redirect('/'), // Regular users go to homepage
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Agent routes
Route::middleware(['auth', 'role:agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
    Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');
    Route::get('/hotels/{hotel}/edit', [HotelController::class, 'edit'])->name('hotels.edit');
    Route::put('/hotels/{hotel}', [HotelController::class, 'update'])->name('hotels.update');
    // Room routes
    Route::resource('rooms', RoomController::class);

    // Room Bookings routes
    Route::get('/room-bookings', [RoomBookingController::class, 'index'])->name('room-bookings.index');
    Route::get('/room-bookings/create', [RoomBookingController::class, 'create'])->name('room-bookings.create');
    Route::post('/room-bookings', [RoomBookingController::class, 'store'])->name('room-bookings.store');
    Route::get('/available-rooms', [RoomBookingController::class, 'availableRooms'])->name('available-rooms');
    Route::get('/room-bookings/{booking}', [RoomBookingController::class, 'show'])->name('room-bookings.show');
    Route::post('/room-bookings/{booking}/status', [RoomBookingController::class, 'updateStatus'])->name('room-bookings.update-status');

    // Image management routes
    Route::post('/rooms/{room}/images/{image}/set-primary', [RoomController::class, 'setPrimaryImage'])
        ->name('rooms.images.set-primary');

    Route::delete('/rooms/{room}/images/{image}', [RoomController::class, 'destroyImage'])
        ->name('rooms.images.destroy');

    // Restaurant Management
    Route::prefix('restaurants')->name('restaurants.')->group(function () {
        Route::get('/', [RestaurantController::class, 'index'])->name('index');
        Route::get('/{restaurant}', [RestaurantController::class, 'show'])->name('show');
        Route::get('/{restaurant}/edit', [RestaurantController::class, 'edit'])->name('edit');
        Route::put('/{restaurant}', [RestaurantController::class, 'update'])->name('update');

        // Tables
        Route::prefix('{restaurant}/tables')->name('tables.')->group(function () {
            Route::get('/', [RestaurantTableController::class, 'index'])->name('index');
            Route::get('/create', [RestaurantTableController::class, 'create'])->name('create');
            Route::post('/', [RestaurantTableController::class, 'store'])->name('store');
            Route::get('/{table}/edit', [RestaurantTableController::class, 'edit'])->name('edit');
            Route::put('/{table}', [RestaurantTableController::class, 'update'])->name('update');
            Route::delete('/{table}', [RestaurantTableController::class, 'destroy'])->name('destroy');
        });

        // Reservations
        Route::prefix('{restaurant}/reservations')->name('reservations.')->group(function () {
            Route::get('/', [RestaurantReservationController::class, 'index'])->name('index');
            Route::get('/create', [RestaurantReservationController::class, 'create'])->name('create');
            Route::post('/', [RestaurantReservationController::class, 'store'])->name('store');
            Route::get('/{reservation}', [RestaurantReservationController::class, 'show'])->name('show');
            Route::post('/{reservation}/confirm', [RestaurantReservationController::class, 'confirm'])->name('confirm');
            Route::post('/{reservation}/cancel', [RestaurantReservationController::class, 'cancel'])->name('cancel');
            Route::patch('/{reservation}/notes', [RestaurantReservationController::class, 'updateNotes'])->name('update-notes');
        });
    });

    // Tour Management
    Route::resource('tours', TourController::class);

    // Tour Dates Management
    Route::prefix('tours/{tour}/dates')->name('tours.dates.')->group(function () {
        Route::get('/', [TourDateController::class, 'index'])->name('index');
        Route::get('/create', [TourDateController::class, 'create'])->name('create');
        Route::post('/', [TourDateController::class, 'store'])->name('store');
        Route::get('/{date}/edit', [TourDateController::class, 'edit'])->name('edit');
        Route::put('/{date}', [TourDateController::class, 'update'])->name('update');
        Route::delete('/{date}', [TourDateController::class, 'destroy'])->name('destroy');

        // Bulk add dates
        Route::get('/bulk-create', [TourDateController::class, 'bulkCreate'])->name('bulk-create');
        Route::post('/bulk-store', [TourDateController::class, 'bulkStore'])->name('bulk-store');
    });

    // Tour Bookings Management
    Route::prefix('tour-bookings')->name('tour-bookings.')->group(function () {
        Route::get('/', [TourBookingController::class, 'index'])->name('index');
        Route::get('/create', [TourBookingController::class, 'create'])->name('create');
        Route::post('/', [TourBookingController::class, 'store'])->name('store');
        Route::get('/{booking}', [TourBookingController::class, 'show'])->name('show');
        Route::post('/{booking}/confirm', [TourBookingController::class, 'confirm'])->name('confirm');
        Route::post('/{booking}/cancel', [TourBookingController::class, 'cancel'])->name('cancel');
        Route::patch('/{booking}/notes', [TourBookingController::class, 'updateNotes'])->name('update-notes');
    });
});

//frontend routes
Route::get('/become-agent', function () {
    return view('frontend.agent-request');
})->name('agent.request.form');

Route::post('/become-agent', [AgentRequestController::class, 'store'])
    ->name('agent.request.store');

// Tour Routes
Route::get('/tours', [FrontendTourController::class, 'index'])->name('tours.index');
Route::get('/tours/{id}', [FrontendTourController::class, 'show'])->name('tours.show');
Route::post('/tours/{id}/check-availability', [FrontendTourController::class, 'checkAvailability'])->name('tours.check-availability');

// Hotel Frontend Routes
Route::get('/hotels', [FrontendHotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [FrontendHotelController::class, 'show'])->name('hotels.show');

// Hotel Booking Routes (authenticated)
Route::middleware('auth')->group(function () {
    Route::get('/hotels/{hotel}/rooms/{room}/book', [FrontendHotelController::class, 'book'])->name('hotels.book');
    Route::post('/hotels/{hotel}/rooms/{room}/book', [FrontendHotelController::class, 'storeBooking'])->name('hotels.store-booking');
    Route::get('/hotel-bookings/{booking}/confirmation', [FrontendHotelController::class, 'bookingConfirmation'])->name('hotels.booking.confirmation');
    Route::get('/my-hotel-bookings', [FrontendHotelController::class, 'myBookings'])->name('hotels.my-bookings');
    Route::post('/hotel-bookings/{booking}/cancel', [FrontendHotelController::class, 'cancelBooking'])->name('hotels.cancel-booking');

    // Tour booking routes (keep these)
    Route::post('/tours/{tour}/book', [FrontendTourController::class, 'book'])->name('tours.book');
    Route::get('/booking/{booking}/confirmation', [FrontendTourController::class, 'confirmation'])->name('booking.confirmation');
    Route::get('/my-bookings', [FrontendTourController::class, 'myBookings'])->name('my-bookings');
    Route::get('/my-bookings', [FrontendMyBookingController::class, 'index'])->name('my-bookings.index');
    Route::get('/my-bookings/tour/{id}', [FrontendMyBookingController::class, 'showTourBooking'])->name('my-bookings.tour.show');
    Route::get('/my-bookings/room/{id}', [FrontendMyBookingController::class, 'showRoomBooking'])->name('my-bookings.room.show');
});

// Restaurant Frontend Routes
Route::get('/restaurants', [FrontendRestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{restaurant}', [FrontendRestaurantController::class, 'show'])->name('restaurants.show');
Route::post('/restaurants/{restaurant}/check-availability', [FrontendRestaurantController::class, 'checkAvailability'])->name('restaurants.check-availability');

// Restaurant Reservation Routes (authenticated)
Route::middleware('auth')->group(function () {
    Route::get('/restaurants/{restaurant}/reserve', [FrontendRestaurantController::class, 'reserve'])->name('restaurants.reserve');
    Route::post('/restaurants/{restaurant}/reservations', [FrontendRestaurantController::class, 'storeReservation'])->name('restaurants.store-reservation');
    Route::get('/restaurant-reservations/{reservation}/confirmation', [FrontendRestaurantController::class, 'reservationConfirmation'])->name('restaurants.reservation.confirmation');
    Route::post('/restaurant-reservations/{reservation}/cancel', [FrontendRestaurantController::class, 'cancelReservation'])->name('restaurants.cancel-reservation');
     Route::get('/my-bookings/restaurant/{id}', [FrontendMyBookingController::class, 'showRestaurantReservation'])
        ->name('my-bookings.restaurant.show');
});
// Other Frontend Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');
Route::get('/about', function () {
    return view('frontend.about_us');
})->name('about');

// Route::get('/packages', [PackageController::class, 'index'])->name('packages');
// Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

require __DIR__ . '/auth.php';
