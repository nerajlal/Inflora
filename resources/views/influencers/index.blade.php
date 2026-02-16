<x-marketplace-layout>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 mb-4">Discover Elite Creators</h1>
                <p class="text-gray-500 max-w-2xl mx-auto">Browse our curated selection of professional influencers ready to elevate your brand.</p>
            </div>

            <div class="flex flex-col md:flex-row gap-8">
                
                <!-- Filters Sidebar -->
                <div class="w-full md:w-1/4">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-serif font-bold text-gray-900">Refine Search</h2>
                            @if(request()->anyFilled(['search', 'category', 'location', 'min_followers', 'max_price', 'sort']))
                                <a href="{{ route('influencer.index') }}" class="text-xs text-gold-600 hover:text-gold-700 font-medium">Clear All</a>
                            @endif
                        </div>
                        
                        <form action="{{ route('influencer.index') }}" method="GET">
                            
                            <!-- Search -->
                            <div class="mb-5">
                                <label for="search" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Keywords</label>
                                <div class="relative">
                                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Name, bio, tag..." class="w-full rounded-lg border-gray-200 bg-gray-50 focus:border-gold-500 focus:ring-gold-500 text-sm py-2.5 pl-3">
                                </div>
                            </div>

                            <!-- Category -->
                            <div class="mb-5">
                                <label for="category" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Category</label>
                                <select name="category" id="category" class="w-full rounded-lg border-gray-200 bg-gray-50 focus:border-gold-500 focus:ring-gold-500 text-sm py-2.5">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Location -->
                            <div class="mb-5">
                                <label for="location" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Location</label>
                                <input type="text" name="location" id="location" value="{{ request('location') }}" placeholder="City or Country" class="w-full rounded-lg border-gray-200 bg-gray-50 focus:border-gold-500 focus:ring-gold-500 text-sm py-2.5">
                            </div>

                            <div class="grid grid-cols-2 gap-3 mb-5">
                                <!-- Min Followers -->
                                <div>
                                    <label for="min_followers" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Min Followers</label>
                                    <input type="number" name="min_followers" id="min_followers" value="{{ request('min_followers') }}" placeholder="1k+" class="w-full rounded-lg border-gray-200 bg-gray-50 focus:border-gold-500 focus:ring-gold-500 text-sm py-2.5">
                                </div>

                                <!-- Max Price -->
                                <div>
                                    <label for="max_price" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Max Price</label>
                                    <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" placeholder="$" class="w-full rounded-lg border-gray-200 bg-gray-50 focus:border-gold-500 focus:ring-gold-500 text-sm py-2.5">
                                </div>
                            </div>

                            <!-- Sort -->
                            <div class="mb-8">
                                <label for="sort" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Sort By</label>
                                <select name="sort" id="sort" class="w-full rounded-lg border-gray-200 bg-gray-50 focus:border-gold-500 focus:ring-gold-500 text-sm py-2.5">
                                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popularity</option>
                                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full bg-dark-900 text-white font-medium py-3 px-4 rounded-lg hover:bg-gold-600 transition duration-200 shadow-md">
                                Apply Filters
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Influencers Grid -->
                <div class="w-full md:w-3/4">
                    
                    @if($influencers->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($influencers as $influencer)
                                <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100 flex flex-col h-full group">
                                    <!-- Cover Image -->
                                    <div class="h-32 bg-gray-200 w-full relative overflow-hidden">
                                        @if($influencer->cover_image)
                                            <img src="{{ Storage::url($influencer->cover_image) }}" alt="Cover" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-r from-gray-800 to-gray-900 flex items-center justify-center">
                                                <svg class="h-12 w-12 text-gray-700" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                                            </div>
                                        @endif
                                        <div class="absolute inset-0 bg-black bg-opacity-10 group-hover:bg-opacity-0 transition"></div>
                                    </div>
                                    
                                    <div class="p-5 pt-0 relative flex-grow flex flex-col">
                                        <!-- Profile Image -->
                                        <div class="absolute -top-12 left-5">
                                            @if($influencer->profile_image)
                                                <img src="{{ Storage::url($influencer->profile_image) }}" alt="{{ $influencer->user->name }}" class="h-24 w-24 rounded-full border-4 border-white object-cover shadow-sm">
                                            @else
                                                <div class="h-24 w-24 rounded-full border-4 border-white bg-gold-500 flex items-center justify-center text-3xl font-serif font-bold text-white shadow-sm">
                                                    {{ substr($influencer->user->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mt-14 mb-2">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h3 class="text-lg font-bold text-gray-900 leading-tight font-serif">
                                                        <a href="{{ route('influencer.show', $influencer->id) }}" class="hover:text-gold-600 transition">
                                                            {{ $influencer->user->name }}
                                                        </a>
                                                    </h3>
                                                    <p class="text-xs text-gray-500 mt-1 flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                        {{ $influencer->location ?? 'Global' }}
                                                    </p>
                                                </div>
                                                <div class="flex items-center bg-gray-50 border border-gray-100 px-2 py-1 rounded-lg">
                                                    <svg class="w-3.5 h-3.5 text-gold-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                                    <span class="text-xs font-bold text-gray-900 ml-1">{{ number_format($influencer->getAverageRating(), 1) }}</span>
                                                    <span class="text-xs text-gray-400 ml-1">({{ $influencer->reviews_count }})</span>
                                                </div>
                                            </div>

                                            <p class="mt-3 text-sm text-gray-600 line-clamp-2 leading-relaxed">
                                                {{ $influencer->bio }}
                                            </p>

                                            <div class="mt-4 flex flex-wrap gap-1.5">
                                                @foreach($influencer->categories->take(3) as $cat)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                                        {{ $cat->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                                            <div>
                                                <p class="text-xs text-gray-400 uppercase tracking-wide">Starting at</p>
                                                <p class="text-lg font-bold text-gray-900 font-serif">
                                                    ${{ number_format($influencer->services->min('base_price') ?? 0) }}
                                                </p>
                                            </div>
                                            <a href="{{ route('influencer.show', $influencer->id) }}" class="text-gold-600 hover:text-gold-700 text-sm font-bold flex items-center group-hover:translate-x-1 transition">
                                                View Profile <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-10">
                            {{ $influencers->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="bg-white rounded-xl shadow-sm p-16 text-center border border-gray-100">
                            <div class="mx-auto h-16 w-16 text-gray-300 mb-4 bg-gray-50 rounded-full flex items-center justify-center">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">No influencers match your search</h3>
                            <p class="mt-2 text-gray-500 max-w-sm mx-auto">Try adjusting your filters, or search for a broader term to see more results.</p>
                            <div class="mt-8">
                                <a href="{{ route('influencer.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-full text-white bg-gold-500 hover:bg-gold-600 transition">
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
