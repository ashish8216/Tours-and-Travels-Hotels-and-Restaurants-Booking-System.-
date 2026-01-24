@extends('frontend.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Page Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Contact Us</h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
            Have questions about our travel packages? Need assistance with bookings?
            We're here to help you plan your perfect journey.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Contact Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Card Header -->
                <div class="bg-blue-600 text-white px-6 py-4">
                    <h4 class="text-xl font-bold mb-1">Send us a Message</h4>
                    <small class="text-blue-100">We'll respond within 24 hours</small>
                </div>

                <!-- Card Body -->
                <div class="p-6">
                    <form id="contactForm" x-data="{
                        isSubmitting: false,
                        isSuccess: false,
                        errors: {},

                        async submitForm() {
                            this.isSubmitting = true;
                            this.errors = {};

                            // Simple validation
                            const formData = new FormData(this.$refs.form);
                            const name = formData.get('name');
                            const email = formData.get('email');
                            const message = formData.get('message');

                            if (!name) this.errors.name = 'Name is required';
                            if (!email) this.errors.email = 'Email is required';
                            if (!message) this.errors.message = 'Message is required';

                            if (email && !this.validateEmail(email)) {
                                this.errors.email = 'Please enter a valid email';
                            }

                            if (Object.keys(this.errors).length > 0) {
                                this.isSubmitting = false;
                                return;
                            }

                            // Simulate form submission (replace with actual AJAX call)
                            await new Promise(resolve => setTimeout(resolve, 1500));

                            // Show success message
                            this.isSuccess = true;
                            this.$refs.form.reset();
                            this.isSubmitting = false;

                            // Reset success message after 5 seconds
                            setTimeout(() => {
                                this.isSuccess = false;
                            }, 5000);
                        },

                        validateEmail(email) {
                            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            return re.test(email);
                        }
                    }" @submit.prevent="submitForm">
                        @csrf

                        <!-- Success Message -->
                        <div x-show="isSuccess" x-cloak
                             class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-medium">Thank you! Your message has been sent successfully.</span>
                            </div>
                            <p class="text-sm mt-1">We'll get back to you within 24 hours.</p>
                        </div>

                        <!-- Name -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Full Name</label>
                            <input
                                type="text"
                                name="name"
                                x-ref="name"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="John Doe"
                                :class="{ 'border-red-500': errors.name }"
                            >
                            <div x-show="errors.name" x-cloak class="text-red-600 text-sm mt-1">
                                <span x-text="errors.name"></span>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Email Address</label>
                            <input
                                type="email"
                                name="email"
                                x-ref="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="john@example.com"
                                :class="{ 'border-red-500': errors.email }"
                            >
                            <div x-show="errors.email" x-cloak class="text-red-600 text-sm mt-1">
                                <span x-text="errors.email"></span>
                            </div>
                        </div>

                        <!-- Phone (Optional) -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Phone Number <span class="text-gray-500 text-sm">(Optional)</span></label>
                            <input
                                type="tel"
                                name="phone"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="+1 (555) 123-4567"
                            >
                        </div>

                        <!-- Subject -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Subject</label>
                            <select
                                name="subject"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            >
                                <option value="">Select a subject</option>
                                <option value="tour_booking">Tour Booking Inquiry</option>
                                <option value="hotel_booking">Hotel Reservation</option>
                                <option value="custom_tour">Custom Tour Request</option>
                                <option value="group_booking">Group/Corporate Booking</option>
                                <option value="feedback">Feedback/Suggestion</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <!-- Message -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Message</label>
                            <textarea
                                name="message"
                                x-ref="message"
                                rows="5"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="Tell us about your travel plans, questions, or concerns..."
                                :class="{ 'border-red-500': errors.message }"
                            ></textarea>
                            <div x-show="errors.message" x-cloak class="text-red-600 text-sm mt-1">
                                <span x-text="errors.message"></span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            :disabled="isSubmitting"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-4 rounded-lg transition duration-200 flex items-center justify-center"
                            :class="{ 'opacity-75 cursor-not-allowed': isSubmitting }"
                        >
                            <span x-show="!isSubmitting">Send Message</span>
                            <span x-show="isSubmitting" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Sending...
                            </span>
                        </button>
                    </form>
                </div>

                <!-- Card Footer -->
                <div class="bg-gray-50 px-6 py-4 text-center text-gray-600 text-sm">
                    By submitting this form, you agree to our <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>.
                </div>
            </div>
        </div>

        <!-- Contact Information & Map -->
        <div class="space-y-8">
            <!-- Contact Info Card -->
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Contact Information</h3>

                <div class="space-y-4">
                    <!-- Address -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-medium text-gray-900">Office Address</h4>
                            <p class="text-gray-600 mt-1">
                                Thamel, Kathmandu<br>
                                Nepal 44600
                            </p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-medium text-gray-900">Phone Numbers</h4>
                            <p class="text-gray-600 mt-1">
                                +977-1-4412345<br>
                                +977-9801234567 (24/7)
                            </p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-medium text-gray-900">Email Address</h4>
                            <p class="text-gray-600 mt-1">
                                info@toursandtravels.com<br>
                                support@toursandtravels.com
                            </p>
                        </div>
                    </div>

                    <!-- Business Hours -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-medium text-gray-900">Business Hours</h4>
                            <p class="text-gray-600 mt-1">
                                Sunday-Friday: 9:00 AM - 6:00 PM<br>
                                Saturday: 10:00 AM - 4:00 PM
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Placeholder -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-4 bg-blue-600 text-white">
                    <h4 class="font-bold">Visit Our Office</h4>
                </div>
                <div class="h-64 bg-gray-200 flex items-center justify-center">
                    <div class="text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        <p class="text-sm">Map integration available<br>with Google Maps API</p>
                    </div>
                </div>
                <div class="p-4 text-center">
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">
                        Get Directions →
                    </a>
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Follow Us</h3>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center hover:bg-blue-200 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-blue-400 text-white rounded-lg flex items-center justify-center hover:bg-blue-500 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.213c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-pink-500 text-white rounded-lg flex items-center justify-center hover:bg-pink-600 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1112.324 0 6.162 6.162 0 01-12.324 0zM12 16a4 4 0 110-8 4 4 0 010 8zm4.965-10.405a1.44 1.44 0 112.881.001 1.44 1.44 0 01-2.881-.001z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-blue-700 text-white rounded-lg flex items-center justify-center hover:bg-blue-800 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Custom scrollbar for textarea */
textarea::-webkit-scrollbar {
    width: 6px;
}
textarea::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}
textarea::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}
textarea::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}

/* Form focus styles */
input:focus, select:focus, textarea:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}
</style>
@endpush
