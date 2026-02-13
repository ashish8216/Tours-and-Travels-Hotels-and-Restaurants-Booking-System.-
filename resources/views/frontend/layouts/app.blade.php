{{-- resources/views/frontend/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tours & Travels') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="font-sans antialiased bg-white">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo - Perfect for your multi-service platform -->
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center group">
                        <div class="relative">
                            <!-- Outer Circle with Gradient -->
                            <div
                                class="w-11 h-11 rounded-full bg-gradient-to-br from-blue-600 via-green-600 to-purple-600 flex items-center justify-center shadow-lg group-hover:shadow-xl transform group-hover:scale-110 transition-all duration-300">
                                <!-- Inner Circle -->
                                <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center">
                                    <span
                                        class="text-lg font-bold bg-gradient-to-br from-blue-600 via-green-600 to-purple-600 bg-clip-text text-transparent">Y</span>
                                </div>
                            </div>
                            <!-- Decorative Ring -->
                            <div
                                class="absolute -inset-0.5 rounded-full bg-gradient-to-br from-blue-600 via-green-600 to-purple-600 opacity-0 group-hover:opacity-30 blur transition-opacity duration-300">
                            </div>
                        </div>
                        <span
                            class="ml-3 text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Yatra</span>
                    </a>
                </div>

                <!-- Desktop Navigation - Centered with better spacing -->
                <div class="hidden md:flex items-center justify-center flex-1">
                    <div class="flex items-center space-x-1">
                        <a href="/"
                            class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('home') ? 'bg-gray-100 text-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }}">
                            Home
                        </a>
                        <a href="{{ route('tours.index') }}"
                            class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('tours*') ? 'bg-gray-100 text-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }}">
                            Tours
                        </a>
                        <a href="{{ route('hotels.index') }}"
                            class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('hotels*') ? 'bg-gray-100 text-green-600' : 'text-gray-700 hover:bg-gray-50 hover:text-green-600' }}">
                            Hotels
                        </a>
                        <a href="{{ route('restaurants.index') }}"
                            class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('restaurants*') ? 'bg-gray-100 text-purple-600' : 'text-gray-700 hover:bg-gray-50 hover:text-purple-600' }}">
                            Restaurants
                        </a>
                        <a href="{{ route('about') }}"
                            class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('about') ? 'bg-gray-100 text-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }}">
                            About Us
                        </a>
                        <a href="{{ route('blog') }}"
                            class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('blog*') ? 'bg-gray-100 text-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }}">
                            Blog
                        </a>
                        <a href="{{ route('contact') }}"
                            class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('contact') ? 'bg-gray-100 text-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }}">
                            Contact
                        </a>
                    </div>
                </div>

                <!-- Auth Links - Clean & Professional -->
                <div class="hidden md:flex items-center space-x-3">
                    @auth
                        <!-- My Bookings - Subtle Badge -->
                        <a href="{{ route('my-bookings.index') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('my-bookings*') ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }}">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            My Bookings
                        </a>

                        <!-- Agent Dropdown - Professional -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="max-w-[100px] truncate">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 ml-1" :class="{ 'rotate-180': open }" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" x-cloak
                                class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50">
                                <a href="{{ route('agent.request.form') }}"
                                    class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Become an Agent
                                </a>
                                <hr class="my-1 border-gray-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-red-600">
                                        <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Non-authenticated users -->
                        <a href="{{ route('login') }}?redirect={{ urlencode(route('agent.request.form')) }}"
                            class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Become an Agent
                        </a>

                        <div class="flex items-center space-x-2">
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-all duration-200">
                                Login
                            </a>
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow">
                                Sign Up
                            </a>
                        </div>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none transition-colors duration-200">
                        <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="h-6 w-6" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu - Improved styling -->
        <div x-show="mobileMenuOpen" x-cloak class="md:hidden border-t border-gray-100 bg-white shadow-lg">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <a href="/"
                    class="block px-3 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('home') ? 'bg-gray-100 text-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-colors duration-200">
                    Home
                </a>
                <a href="{{ route('tours.index') }}"
                    class="block px-3 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('tours*') ? 'bg-gray-100 text-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-colors duration-200">
                    Tours
                </a>
                <a href="{{ route('hotels.index') }}"
                    class="block px-3 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('hotels*') ? 'bg-gray-100 text-green-600' : 'text-gray-700 hover:bg-gray-50 hover:text-green-600' }} transition-colors duration-200">
                    Hotels
                </a>
                <a href="{{ route('restaurants.index') }}"
                    class="block px-3 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('restaurants*') ? 'bg-gray-100 text-purple-600' : 'text-gray-700 hover:bg-gray-50 hover:text-purple-600' }} transition-colors duration-200">
                    Restaurants
                </a>
                <a href="{{ route('about') }}"
                    class="block px-3 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('about') ? 'bg-gray-100 text-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-colors duration-200">
                    About Us
                </a>
                <a href="{{ route('blog') }}"
                    class="block px-3 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('blog*') ? 'bg-gray-100 text-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-colors duration-200">
                    Blog
                </a>
                <a href="{{ route('contact') }}"
                    class="block px-3 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('contact') ? 'bg-gray-100 text-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-colors duration-200">
                    Contact
                </a>

                @auth
                    <a href="{{ route('my-bookings.index') }}"
                        class="block px-3 py-2.5 text-base font-medium rounded-lg {{ request()->routeIs('my-bookings*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }} transition-colors duration-200">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            My Bookings
                        </span>
                    </a>

                    <div class="border-t border-gray-100 my-2 pt-2">
                        <span class="block px-3 py-2 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Logged in as {{ Auth::user()->name }}
                        </span>
                        <a href="{{ route('agent.request.form') }}"
                            class="flex items-center px-3 py-2.5 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Become an Agent
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center w-full px-3 py-2.5 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-red-600 rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <div class="border-t border-gray-100 my-2 pt-2">
                        <a href="{{ route('login') }}?redirect={{ urlencode(route('agent.request.form')) }}"
                            class="flex items-center px-3 py-2.5 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-green-600 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Become an Agent
                        </a>
                        <a href="{{ route('login') }}"
                            class="flex items-center px-3 py-2.5 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="flex items-center px-3 py-2.5 text-base font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Sign Up
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages (unchanged) -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 relative" role="alert"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 relative" role="alert"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <span class="block sm:inline">{{ session('error') }}</span>
            <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Section -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Tours & Travels</h3>
                    <p class="text-gray-300 mb-4">
                        Your trusted partner for unforgettable travel experiences in Nepal and beyond.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.213c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1112.324 0 6.162 6.162 0 01-12.324 0zM12 16a4 4 0 110-8 4 4 0 010 8zm4.965-10.405a1.44 1.44 0 112.881.001 1.44 1.44 0 01-2.881-.001z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition">About
                                Us</a></li>
                        <li><a href="{{ route('tours.index') }}"
                                class="text-gray-400 hover:text-white transition">Tours</a></li>
                        <li><a href="{{ route('hotels.index') }}"
                                class="text-gray-400 hover:text-white transition">Hotels</a></li>
                        <li><a href="{{ route('blog') }}" class="text-gray-400 hover:text-white transition">Blog</a>
                        </li>
                        <li><a href="{{ route('contact') }}"
                                class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Us</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 text-gray-400 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-gray-300">Thamel, Kathmandu, Nepal</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="text-gray-300">+977-1-4412345</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-300">info@toursandtravels.com</span>
                        </li>
                        <li class="flex items-center mt-4 pt-4 border-t border-gray-800">
                            <svg class="w-5 h-5 mr-3 text-green-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="{{ route('agent.request.form') }}"
                                class="text-green-400 hover:text-green-300 font-medium transition">
                                Become a Partner Agent
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Newsletter</h4>
                    <p class="text-gray-300 mb-4">Subscribe to get travel tips and special offers.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email"
                            class="flex-grow px-4 py-2 rounded-l-lg text-gray-900 focus:outline-none">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-r-lg font-medium transition">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Tours & Travels. All rights reserved.</p>
                <div class="mt-2 text-sm">
                    <a href="#" class="hover:text-white transition mx-2">Privacy Policy</a> |
                    <a href="#" class="hover:text-white transition mx-2">Terms of Service</a> |
                    <a href="#" class="hover:text-white transition mx-2">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</body>

</html>
