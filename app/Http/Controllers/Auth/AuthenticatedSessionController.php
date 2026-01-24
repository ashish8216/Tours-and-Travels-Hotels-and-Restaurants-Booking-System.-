<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        // Store redirect URL if provided (from tour booking)
        if (request()->has('redirect')) {
            session(['tour_booking_redirect' => request('redirect')]);
        }

        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Check if this login was for tour booking
        $tourRedirect = session('tour_booking_redirect');

        if ($tourRedirect && $user->role === 'user') {
            // Clear the session
            session()->forget('tour_booking_redirect');

            // Redirect back to tour page
            return redirect($tourRedirect);
        }

        // Default role-based redirects
        return match ($user->role) {
            'admin' => redirect('/admin'),
            'agent' => redirect('/agent/dashboard'),
            default => redirect('/'), // Changed from /user/dashboard to /
        };
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
