<x-marketplace-layout>
    <div class="bg-gray-100 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-6">
                
                <!-- Filters Sidebar -->
                <div class="w-full md:w-1/4">
                    <div class="bg-white p-6 rounded-lg shadow-sm sticky top-24">
                        <h2 class="text-lg font-semibold mb-4">Filters</h2>
                        <form action="{{ route('influencer.index') }}" method="GET">
                            
                            <!-- Search -->
                            <div class="mb-4">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Name or keyword" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Category -->
                            <div class="mb-4">
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <select name="category" id="category" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Location -->
                            <div class="mb-4">
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                <input type="text" name="location" id="location" value="{{ request('location') }}" placeholder="City or Country" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Min Followers -->
                            <div class="mb-4">
                                <label for="min_followers" class="block text-sm font-medium text-gray-700 mb-1">Min Followers</label>
                                <input type="number" name="min_followers" id="min_followers" value="{{ request('min_followers') }}" placeholder="e.g. 1000" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Max Price -->
                            <div class="mb-4">
                                <label for="max_price" class="block text-sm font-medium text-gray-700 mb-1">Max Price ($)</label>
                                <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" placeholder="e.g. 500" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <!-- Sort -->
                            <div class="mb-6">
                                <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                                <select name="sort" id="sort" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popularity</option>
                                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">
                                Apply Filters
                            </button>
                            
                            @if(request()->anyFilled(['search', 'category', 'location', 'min_followers', 'max_price', 'sort']))
                                <a href="{{ route('influencer.index') }}" class="block text-center mt-3 text-sm text-gray-500 hover:text-gray-700">
                                    Clear Filters
                                </a>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- Influencers Grid -->
                <div class="w-full md:w-3/4">
                    
                    @if($influencers->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($influencers as $influencer)
                                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition overflow-hidden border border-gray-100">
                                    <!-- Cover Image -->
                                    <div class="h-24 bg-gray-200 w-full object-cover">
                                        @if($influencer->cover_image)
                                            <img src="{{ Storage::url($influencer->cover_image) }}" alt="Cover" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-indigo-50 flex items-center justify-center text-indigo-200">
                                                <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="p-5 pt-0 relative">
                                        <!-- Profile Image -->
                                        <div class="absolute -top-10 left-4">
                                            @if($influencer->profile_image)
                                                <img src="{{ Storage::url($influencer->profile_image) }}" alt="{{ $influencer->user->name }}" class="h-20 w-20 rounded-full border-4 border-white object-cover">
                                            @else
                                                <div class="h-20 w-20 rounded-full border-4 border-white bg-gray-300 flex items-center justify-center text-xl font-bold text-white">
                                                    {{ substr($influencer->user->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mt-12">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h3 class="text-lg font-bold text-gray-900 leading-tight">
                                                        <a href="{{ route('influencer.show', $influencer->id) }}" class="hover:text-indigo-600">
                                                            {{ $influencer->user->name }}
                                                        </a>
                                                    </h3>
                                                    <p class="text-sm text-gray-500">{{ $influencer->location }}</p>
                                                </div>
                                                <div class="flex items-center bg-yellow-50 px-2 py-1 rounded text-xs font-medium text-yellow-700">
                                                    <span class="mr-1">★</span> {{ number_format($influencer->getAverageRating(), 1) }}
                                                    <span class="text-gray-400 ml-1">({{ $influencer->reviews_count }})</span>
                                                </div>
                                            </div>

                                            <div class="mt-3 text-sm text-gray-600 line-clamp-2">
                                                {{ $influencer->bio }}
                                            </div>

                                            <div class="mt-3 flex flex-wrap gap-1">
                                                @foreach($influencer->categories->take(3) as $cat)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ $cat->name }}
                                                    </span>
                                                @endforeach
                                                @if($influencer->categories->count() > 3)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-500">
                                                        +{{ $influencer->categories->count() - 3 }}
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                                                <div>
                                                    <p class="text-xs text-gray-500">Starting from</p>
                                                    <p class="text-lg font-bold text-gray-900">
                                                        ${{ number_format($influencer->services->min('base_price') ?? 0) }}
                                                    </p>
                                                </div>
                                                <a href="{{ route('influencer.show', $influencer->id) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                                    View Profile →
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-8">
                            {{ $influencers->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" class="h-6 w-6" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No influencers found</h3>
                            <p class="mt-1 text-sm text-gray-500">Try adjusting your filters or search terms.</p>
                            <div class="mt-6">
                                <a href="{{ route('influencer.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Clear all filters
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-marketplace-layout>
