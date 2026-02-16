<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Influenceora') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            gold: {
                                400: '#f4d03f',
                                500: '#D4AF37',
                                600: '#b89628',
                            },
                            dark: {
                                800: '#2c2c2c',
                                900: '#1a1a1a',
                            }
                        },
                        fontFamily: {
                            sans: ['Lato', 'sans-serif'],
                            serif: ['Playfair Display', 'serif'],
                        }
                    }
                }
            }
        </script>
        <style>
            .gold-gradient-text {
                background: linear-gradient(135deg, #D4AF37, #f4d03f);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .gold-gradient-bg {
                background: linear-gradient(135deg, #D4AF37, #f4d03f);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900 flex flex-col min-h-screen">
        
        <!-- Navigation -->
        <nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gold-500/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20"> <!-- Increased height for premium feel -->
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ url('/') }}" class="text-2xl font-bold font-serif gold-gradient-text">
                                Influenceora
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gold-500 hover:border-gold-300 focus:outline-none transition duration-150 ease-in-out">
                                For Creators
                            </a>
                            <a href="{{ route('influencer.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-900 hover:text-gold-500 hover:border-gold-300 focus:outline-none border-gold-500 transition duration-150 ease-in-out">
                                Browse Influencers
                            </a>
                            @auth
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 hover:text-gold-500 hover:border-gold-300 focus:outline-none transition duration-150 ease-in-out {{ request()->routeIs('dashboard') ? 'border-gold-500 text-gray-900' : 'text-gray-500' }}">
                                    Dashboard
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        @auth
                            <div class="ml-3 relative" x-data="{ open: false }">
                                <div>
                                    <button @click="open = !open" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <span class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gold-600 focus:outline-none transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}
                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="display: none;">
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log Out</a>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-gold-600">Log in</a>
                            <a href="{{ route('home') }}" class="ml-8 inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white gold-gradient-bg hover:opacity-90 transition-opacity">
                                Join as Influencer
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-dark-900 text-white py-12 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-lg font-serif font-bold mb-4 text-gold-500">Influenceora</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">The premium platform connecting elite influencers with luxury brands worldwide.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-serif font-bold mb-4 text-white">For Creators</h3>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li><a href="#" class="hover:text-gold-500 transition">Join Platform</a></li>
                            <li><a href="#" class="hover:text-gold-500 transition">Creator Resources</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-serif font-bold mb-4 text-white">For Brands</h3>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li><a href="#" class="hover:text-gold-500 transition">Partner With Us</a></li>
                            <li><a href="#" class="hover:text-gold-500 transition">Campaign Management</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-serif font-bold mb-4 text-white">Support</h3>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li><a href="#" class="hover:text-gold-500 transition">Help Center</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:text-gold-500 transition">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-10 pt-8 text-center text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Influenceora. All rights reserved by <a href="https://metora.in/" class="text-gold-500 hover:text-white transition">Metora.in</a>
                </div>
            </div>
        </footer>

    </body>
</html>
