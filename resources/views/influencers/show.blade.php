<x-marketplace-layout>
    <div class="bg-gray-100 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Profile Header -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                <!-- Cover Image -->
                <div class="h-48 bg-gray-300 w-full relative">
                    @if($influencer->cover_image)
                        <img src="{{ Storage::url($influencer->cover_image) }}" alt="Cover" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-indigo-600 flex items-center justify-center">
                            <h1 class="text-4xl font-bold text-white opacity-25">INFLORA</h1>
                        </div>
                    @endif
                </div>
                
                <div class="px-8 pb-8">
                    <div class="relative flex justify-between items-end -mt-12 mb-6">
                        <div class="flex items-end">
                            <!-- Profile Image -->
                            <div class="relative">
                                @if($influencer->profile_image)
                                    <img src="{{ Storage::url($influencer->profile_image) }}" alt="{{ $influencer->user->name }}" class="h-32 w-32 rounded-full border-4 border-white object-cover">
                                @else
                                    <div class="h-32 w-32 rounded-full border-4 border-white bg-gray-200 flex items-center justify-center text-4xl font-bold text-gray-500">
                                        {{ substr($influencer->user->name, 0, 1) }}
                                    </div>
                                @endif
                                
                                <div class="absolute bottom-2 right-2 bg-green-500 h-4 w-4 rounded-full border-2 border-white" title="Online"></div>
                            </div>
                            
                            <div class="ml-6 mb-2">
                                <h1 class="text-3xl font-bold text-gray-900">{{ $influencer->user->name }}</h1>
                                <p class="text-gray-500 flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $influencer->location }}
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-3 mb-2">
                            <!-- Favorite Button -->
                            <button id="favorite-btn" onclick="toggleFavorite({{ $influencer->id }})" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-md font-medium hover:bg-gray-50 transition flex items-center gap-2">
                                <svg id="heart-icon" class="h-5 w-5 {{ Auth::check() && Auth::user()->hasFavorited($influencer->id) ? 'text-red-500 fill-current' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                Save
                            </button>
                            
                            <!-- Share Button -->
                            <button class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-md font-medium hover:bg-gray-50 transition">
                                Share
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        
                        <!-- Left Column: Bio & Info -->
                        <div class="col-span-1 lg:col-span-2 space-y-8">
                            
                            <!-- About -->
                            <div>
                                <h2 class="text-xl font-bold text-gray-900 mb-3">About Me</h2>
                                <div class="prose max-w-none text-gray-600">
                                    <p>{{ $influencer->bio }}</p>
                                </div>
                            </div>

                            <!-- Metrics -->
                            @if($influencer->metrics)
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-indigo-600">{{ number_format($influencer->metrics->follower_count) }}</div>
                                        <div class="text-xs text-gray-500 uppercase tracking-wide">Followers</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-indigo-600">{{ $influencer->metrics->engagement_rate }}%</div>
                                        <div class="text-xs text-gray-500 uppercase tracking-wide">Engagement</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-indigo-600">{{ $totalReviews }}</div>
                                        <div class="text-xs text-gray-500 uppercase tracking-wide">Reviews</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-indigo-600">{{ number_format($averageRating, 1) }}</div>
                                        <div class="text-xs text-gray-500 uppercase tracking-wide">Rating</div>
                                    </div>
                                </div>
                            @endif

                            <!-- Portfolio -->
                            @if($influencer->portfolioItems->count() > 0)
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900 mb-4">Portfolio</h2>
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                        @foreach($influencer->portfolioItems as $item)
                                            <div class="group relative aspect-square bg-gray-200 rounded-lg overflow-hidden cursor-pointer">
                                                <img src="{{ Storage::url($item->file_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition flex items-center justify-center opacity-0 group-hover:opacity-100">
                                                    <span class="text-white font-medium">{{ $item->title }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Reviews -->
                            <div>
                                <h2 class="text-xl font-bold text-gray-900 mb-4">Reviews ({{ $totalReviews }})</h2>
                                @if($influencer->reviews->count() > 0)
                                    <div class="space-y-6">
                                        @foreach($influencer->reviews as $review)
                                            <div class="border-b border-gray-100 pb-6 last:border-0">
                                                <div class="flex items-center justify-between mb-2">
                                                    <div class="flex items-center gap-2">
                                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center font-bold text-xs text-gray-600">
                                                            {{ substr($review->user->name, 0, 1) }}
                                                        </div>
                                                        <span class="font-medium text-gray-900">{{ $review->user->name }}</span>
                                                    </div>
                                                    <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="flex items-center mb-2">
                                                    @for($i=1; $i<=5; $i++)
                                                    <svg class="h-4 w-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                    @endfor
                                                </div>
                                                <p class="text-gray-600 text-sm">{{ $review->comment }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 italic">No reviews yet.</p>
                                @endif
                            </div>

                        </div>

                        <!-- Right Column: Services sticky sidebar -->
                        <div class="col-span-1">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Services</h2>
                            <div class="space-y-4 sticky top-24">
                                @forelse($influencer->services as $service)
                                    <div class="bg-white border border-gray-200 rounded-lg p-5 hover:shadow-md transition">
                                        <div class="flex justify-between items-start mb-2">
                                            <h3 class="font-bold text-lg text-gray-900">{{ $service->title }}</h3>
                                            <span class="bg-indigo-50 text-indigo-700 px-2 py-0.5 rounded text-xs font-semibold uppercase">
                                                {{ $service->delivery_days }} Days
                                            </span>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $service->description }}</p>
                                        
                                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                            <div>
                                                <span class="text-xs text-gray-500 block">Starting at</span>
                                                <span class="text-xl font-bold text-gray-900">${{ $service->base_price }}</span>
                                            </div>
                                            <a href="{{ route('orders.create', ['service' => $service->id]) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md font-medium text-sm hover:bg-indigo-700 transition">
                                                Order Now
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="bg-gray-50 border border-dashed border-gray-300 rounded-lg p-8 text-center text-gray-500">
                                        This influencer hasn't listed any services yet.
                                    </div>
                                @endforelse
                                
                                <!-- Categories Tags -->
                                <div class="bg-white border border-gray-200 rounded-lg p-5 mt-4">
                                    <h3 class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wide">Experience In</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($influencer->categories as $category)
                                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <!-- Social Links -->
                                <div class="bg-white border border-gray-200 rounded-lg p-5 mt-4">
                                    <h3 class="text-sm font-semibold text-gray-900 mb-3 uppercase tracking-wide">Social Profiles</h3>
                                    <div class="space-y-2">
                                        @foreach($influencer->socialAccounts as $account)
                                            <a href="{{ $account->profile_url }}" target="_blank" class="flex items-center text-gray-600 hover:text-indigo-600 transition">
                                                <span class="capitalize font-medium">{{ $account->platform }}</span>
                                                <svg class="h-3 w-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleFavorite(id) {
            fetch(`/influencer/${id}/favorite`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.status === 401) {
                    window.location.href = '/login';
                    return;
                }
                return response.json();
            })
            .then(data => {
                if (data.favorited) {
                    document.getElementById('heart-icon').classList.remove('text-gray-400');
                    document.getElementById('heart-icon').classList.add('text-red-500', 'fill-current');
                } else {
                    document.getElementById('heart-icon').classList.remove('text-red-500', 'fill-current');
                    document.getElementById('heart-icon').classList.add('text-gray-400');
                }
            });
        }
    </script>
    @endpush
</x-marketplace-layout>
