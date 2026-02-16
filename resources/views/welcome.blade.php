<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Inflora') }} - Influencer Marketplace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-indigo-600">Inflora</a>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('influencer.index') }}" class="text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-indigo-500 text-sm font-medium">
                            Browse Influencers
                        </a>
                        <a href="#" class="text-gray-500 inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:text-gray-700 text-sm font-medium">
                            How it Works
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">Log in</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Connect with top</span>
                            <span class="block text-indigo-600 xl:inline">influencers & creators</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Find the perfect influencer for your brand. From Instagram posts to YouTube reviews, get authentic content that drives results.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('influencer.index') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg">
                                    Browse Influencers
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg">
                                    Join as Creator
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80" alt="Team working">
        </div>
    </div>

    <!-- Categories Section -->
    <div class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 text-center mb-8">Popular Categories</h2>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6">
                <!-- Fashion -->
                <a href="{{ route('influencer.index', ['category' => 1]) }}" class="bg-white rounded-lg p-6 text-center hover:shadow-md transition">
                    <span class="text-3xl mb-2 block">👗</span>
                    <span class="font-medium text-gray-900">Fashion</span>
                </a>
                <!-- Tech -->
                <a href="{{ route('influencer.index', ['category' => 2]) }}" class="bg-white rounded-lg p-6 text-center hover:shadow-md transition">
                    <span class="text-3xl mb-2 block">💻</span>
                    <span class="font-medium text-gray-900">Tech</span>
                </a>
                <!-- Travel -->
                <a href="{{ route('influencer.index', ['category' => 4]) }}" class="bg-white rounded-lg p-6 text-center hover:shadow-md transition">
                    <span class="text-3xl mb-2 block">✈️</span>
                    <span class="font-medium text-gray-900">Travel</span>
                </a>
                <!-- Fitness -->
                <a href="{{ route('influencer.index', ['category' => 5]) }}" class="bg-white rounded-lg p-6 text-center hover:shadow-md transition">
                    <span class="text-3xl mb-2 block">💪</span>
                    <span class="font-medium text-gray-900">Fitness</span>
                </a>
                <!-- Gaming -->
                <a href="{{ route('influencer.index', ['category' => 6]) }}" class="bg-white rounded-lg p-6 text-center hover:shadow-md transition">
                    <span class="text-3xl mb-2 block">🎮</span>
                    <span class="font-medium text-gray-900">Gaming</span>
                </a>
                <!-- Food -->
                <a href="{{ route('influencer.index', ['category' => 3]) }}" class="bg-white rounded-lg p-6 text-center hover:shadow-md transition">
                    <span class="text-3xl mb-2 block">🍳</span>
                    <span class="font-medium text-gray-900">Food</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Features</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Everything you need to collaborate
                </p>
            </div>

            <div class="mt-10">
                <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Secure Icon -->
                                <svg class="h-6 w-6" fill="none" class="h-6 w-6" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Secure Payments</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Your funds are held safely until the work is approved.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Verified Icon -->
                                <svg class="h-6 w-6" fill="none" class="h-6 w-6" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Verified Influencers</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Every creator is vetted to ensure authentic engagement.
                        </dd>
                    </div>

                    <div class="relative">
                        <dt>
                            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <!-- Support Icon -->
                                <svg class="h-6 w-6" fill="none" class="h-6 w-6" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">24/7 Support</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Our team is here to help with any questions or issues.
                        </dd>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2026 Inflora. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
