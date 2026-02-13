{{-- resources/views/auth/verify-email.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Verify Email')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-lg mb-4">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Verify Your Email</h2>
            <p class="text-gray-600 mt-2">Thanks for signing up! Please verify your email address</p>
        </div>

        <!-- Verify Email Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="p-8">
                @if (session('status') == 'verification-link-sent')
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            A new verification link has been sent to your email address.
                        </div>
                    </div>
                @endif

                <div class="text-center mb-6">
                    <div class="bg-blue-50 rounded-lg p-6 mb-6">
                        <svg class="w-16 h-16 text-blue-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <p class="text-gray-700 mb-2">
                            We've sent a verification link to:
                        </p>
                        <p class="text-blue-600 font-semibold">
                            {{ Auth::user()->email }}
                        </p>
                    </div>

                    <p class="text-gray-600 text-sm mb-4">
                        Please check your email and click the verification link to activate your account.
                    </p>
                    <p class="text-gray-500 text-xs">
                        Didn't receive the email? Check your spam folder or request a new link below.
                    </p>
                </div>

                <div class="flex flex-col space-y-3">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                            Resend Verification Email
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-4 rounded-lg transition-all duration-300">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-8">
            <a href="{{ url('/') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 text-sm transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Home
            </a>
        </div>
    </div>
</div>
@endsection
