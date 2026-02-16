<?php

namespace App\Http\Controllers;

use App\Models\InfluencerProfile;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InfluencerController extends Controller
{
    /**
     * Display a listing of influencers with search and filters
     */
    public function index(Request $request)
    {
        $query = InfluencerProfile::with(['user', 'categories', 'metrics', 'reviews'])
            ->where('is_verified', true);

        // Search by name or bio
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('bio', 'like', "%{$search}%");
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // Filter by follower count range
        if ($request->filled('min_followers')) {
            $query->whereHas('metrics', function($q) use ($request) {
                $q->where('follower_count', '>=', $request->min_followers);
            });
        }

        // Filter by price range
        if ($request->filled('max_price')) {
            $query->whereHas('services', function($q) use ($request) {
                $q->where('base_price', '<=', $request->max_price);
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'popular');
        switch ($sortBy) {
            case 'rating':
                // This would need a computed column or subquery for efficiency
                $influencers = $query->get()->sortByDesc(function($influencer) {
                    return $influencer->getAverageRating();
                });
                break;
            case 'newest':
                $query->latest();
                break;
            case 'popular':
            default:
                // Sort by number of orders or reviews
                $query->withCount('orders')->orderBy('orders_count', 'desc');
                break;
        }

        $influencers = $query->paginate(12);
        $categories = Category::whereNull('parent_id')->get();

        return view('influencers.index', compact('influencers', 'categories'));
    }

    /**
     * Display the specified influencer profile
     */
    public function show($id)
    {
        $influencer = InfluencerProfile::with([
            'user',
            'socialAccounts',
            'categories',
            'metrics',
            'services.packages',
            'portfolioItems',
            'reviews.customer'
        ])->findOrFail($id);

        $averageRating = $influencer->getAverageRating();
        $totalReviews = $influencer->getTotalReviews();

        return view('influencers.show', compact('influencer', 'averageRating', 'totalReviews'));
    }

    /**
     * Show the form for creating influencer profile
     */
    public function create()
    {
        // Only influencers can create profiles
        if (!Auth::user()->isInfluencer()) {
            abort(403, 'Only influencers can create profiles');
        }

        // Check if profile already exists
        if (Auth::user()->hasInfluencerProfile()) {
            return redirect()->route('influencer.edit');
        }

        $categories = Category::whereNull('parent_id')->get();
        return view('influencers.create', compact('categories'));
    }

    /**
     * Store a newly created influencer profile
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bio' => 'required|string|max:1000',
            'location' => 'required|string|max:255',
            'languages' => 'required|array',
            'categories' => 'required|array|min:1',
            'profile_image' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $profile = new InfluencerProfile();
        $profile->user_id = Auth::id();
        $profile->bio = $validated['bio'];
        $profile->location = $validated['location'];
        $profile->languages = $validated['languages'];

        // Handle image uploads
        if ($request->hasFile('profile_image')) {
            $profile->profile_image = $request->file('profile_image')->store('profiles', 'public');
        }

        if ($request->hasFile('cover_image')) {
            $profile->cover_image = $request->file('cover_image')->store('covers', 'public');
        }

        $profile->save();

        // Attach categories
        $profile->categories()->attach($validated['categories']);

        return redirect()->route('influencer.show', $profile->id)
            ->with('success', 'Profile created successfully! Please add your social accounts and services.');
    }

    /**
     * Show the form for editing the influencer profile
     */
    public function edit()
    {
        $profile = Auth::user()->influencerProfile;

        if (!$profile) {
            return redirect()->route('influencer.create');
        }

        $categories = Category::whereNull('parent_id')->get();
        return view('influencers.edit', compact('profile', 'categories'));
    }

    /**
     * Update the influencer profile
     */
    public function update(Request $request)
    {
        $profile = Auth::user()->influencerProfile;

        $validated = $request->validate([
            'bio' => 'required|string|max:1000',
            'location' => 'required|string|max:255',
            'languages' => 'required|array',
            'categories' => 'required|array|min:1',
            'profile_image' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $profile->bio = $validated['bio'];
        $profile->location = $validated['location'];
        $profile->languages = $validated['languages'];

        // Handle image uploads
        if ($request->hasFile('profile_image')) {
            // Delete old image
            if ($profile->profile_image) {
                Storage::disk('public')->delete($profile->profile_image);
            }
            $profile->profile_image = $request->file('profile_image')->store('profiles', 'public');
        }

        if ($request->hasFile('cover_image')) {
            // Delete old image
            if ($profile->cover_image) {
                Storage::disk('public')->delete($profile->cover_image);
            }
            $profile->cover_image = $request->file('cover_image')->store('covers', 'public');
        }

        $profile->save();

        // Sync categories
        $profile->categories()->sync($validated['categories']);

        return redirect()->route('influencer.show', $profile->id)
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Toggle favorite for an influencer
     */
    public function toggleFavorite($id)
    {
        $user = Auth::user();
        $influencer = InfluencerProfile::findOrFail($id);

        $favorite = $user->favorites()->where('influencer_id', $id)->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['favorited' => false]);
        } else {
            $user->favorites()->create(['influencer_id' => $id]);
            return response()->json(['favorited' => true]);
        }
    }
}
