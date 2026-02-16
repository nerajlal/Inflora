@extends('layouts.marketplace')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-serif font-bold text-gray-900">
                Welcome back, <span class="text-gold-600">{{ Auth::user()->name }}</span>
            </h1>
            <p class="mt-2 text-gray-600">Here's what's happening with your influencer profile.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Earnings -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gold-500/10 text-gold-600">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Earnings</p>
                            <p class="text-2xl font-semibold text-gray-900">₹{{ number_format($stats['total_earnings']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Orders -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-50 text-blue-600">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Pending Orders</p>
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

            <!-- Rating -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-50 text-yellow-600">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Rating</p>
                            <div class="flex items-baseline">
                                <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['average_rating'], 1) }}</p>
                                <span class="ml-1 text-sm text-gray-500">({{ $stats['total_reviews'] }} reviews)</span>
                            </div>
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
                        <a href="{{ route('orders.manage') }}" class="text-sm text-gold-600 hover:text-gold-700 font-medium">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recentOrders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ Str::limit($order->service->title, 30) }}</div>
                                        <div class="text-xs text-gray-500">Due: {{ $order->delivery_date?->format('M d') ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $order->customer->name }}</div>
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
                                        ₹{{ number_format($order->influencer_earnings) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('orders.show', $order->id) }}" class="text-gold-600 hover:text-gold-900">Manage</a>
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

            <!-- Recent Reviews -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow-sm rounded-lg border border-gray-100">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Reviews</h2>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @forelse($recentReviews as $review)
                        <div class="p-6">
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 text-sm">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 {{ $i < $review->rating ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                                <span class="ml-2 text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-gray-600 italic">"{{ Str::limit($review->comment, 80) }}"</p>
                            <div class="mt-2 text-xs font-medium text-gray-900">- {{ $review->customer->name }}</div>
                        </div>
                        @empty
                        <div class="p-6 text-center text-sm text-gray-500">No reviews yet.</div>
                        @endforelse
                    </div>
                    <div class="p-4 bg-gray-50 text-center rounded-b-lg">
                        <a href="{{ route('influencer.show', $profile->id) }}#reviews" class="text-sm font-medium text-gold-600 hover:text-gold-700">View All Reviews</a>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="mt-8 bg-white shadow-sm rounded-lg border border-gray-100 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h2>
                    <div class="space-y-3">
                        <a href="{{ route('influencer.services.create') }}" class="block w-full text-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gold-500 hover:bg-gold-600">
                            Add New Service
                        </a>
                        <a href="{{ route('influencer.edit') }}" class="block w-full text-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
