@extends('layouts.marketplace')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-serif font-bold text-gray-900">
                Hello, <span class="text-gold-600">{{ Auth::user()->name }}</span>
            </h1>
            <p class="mt-2 text-gray-600">Track your orders and manage your favorite influencers.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Spent -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gold-500/10 text-gold-600">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Spent</p>
                            <p class="text-2xl font-semibold text-gray-900">₹{{ number_format($stats['total_spent']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Orders -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-50 text-blue-600">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Active Orders</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $stats['pending_orders'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Completed Orders -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-50 text-green-600">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Completed</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $stats['completed_orders'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Favorites -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-50 text-red-600">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Favorites</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $stats['favorites_count'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Orders -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow-sm rounded-lg border border-gray-100">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Orders</h2>
                        <a href="{{ route('orders.index') }}" class="text-sm text-gold-600 hover:text-gold-700 font-medium">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Influencer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recentOrders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ Str::limit($order->service->title, 25) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $order->influencer->user->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                               ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800')) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        ₹{{ number_format($order->total_amount) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('orders.show', $order->id) }}" class="text-gold-600 hover:text-gold-900">Details</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No orders yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Favorite Influencers -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow-sm rounded-lg border border-gray-100">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">Favorite Influencers</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-4">
                            @forelse($favoriteInfluencers as $favorite)
                                <a href="{{ route('influencer.show', $favorite->influencer->id) }}" class="group block text-center">
                                    <div class="relative mx-auto w-16 h-16 rounded-full overflow-hidden border-2 border-gray-100 group-hover:border-gold-500 transition-colors">
                                        @if($favorite->influencer->profile_image)
                                            <img src="{{ Storage::url($favorite->influencer->profile_image) }}" alt="" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="mt-2 text-sm font-medium text-gray-900 group-hover:text-gold-600 truncate">{{ $favorite->influencer->user->name }}</p>
                                </a>
                            @empty
                                <div class="col-span-2 text-center text-sm text-gray-500 py-4">
                                    No favorites yet. <a href="{{ route('influencer.index') }}" class="text-gold-600 hover:underline">Explore</a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
