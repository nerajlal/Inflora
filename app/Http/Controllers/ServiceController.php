<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServicePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display influencer's services
     */
    public function index()
    {
        $profile = Auth::user()->influencerProfile;
        $services = $profile->services()->with('packages')->get();

        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created service
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'service_type' => 'required|in:instagram_post,instagram_story,instagram_reel,youtube_video,youtube_shorts,tiktok_video,twitter_post,blog_post,product_review,brand_ambassador,event_appearance,custom',
            'base_price' => 'required|numeric|min:0',
            'delivery_days' => 'required|integer|min:1',
            'revisions_included' => 'required|integer|min:0',
            'requirements' => 'nullable|string',
            
            // Packages (optional)
            'packages' => 'nullable|array',
            'packages.*.name' => 'required_with:packages|string',
            'packages.*.description' => 'required_with:packages|string',
            'packages.*.price' => 'required_with:packages|numeric|min:0',
            'packages.*.delivery_days' => 'required_with:packages|integer|min:1',
            'packages.*.package_type' => 'required_with:packages|in:basic,standard,premium',
        ]);

        $profile = Auth::user()->influencerProfile;

        $service = $profile->services()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'service_type' => $validated['service_type'],
            'base_price' => $validated['base_price'],
            'delivery_days' => $validated['delivery_days'],
            'revisions_included' => $validated['revisions_included'],
            'requirements' => $validated['requirements'] ?? null,
        ]);

        // Create packages if provided
        if ($request->has('packages')) {
            foreach ($request->packages as $packageData) {
                $service->packages()->create($packageData);
            }
        }

        return redirect()->route('services.index')
            ->with('success', 'Service created successfully!');
    }

    /**
     * Show the form for editing the specified service
     */
    public function edit($id)
    {
        $service = Service::with('packages')->findOrFail($id);

        // Ensure the service belongs to the authenticated influencer
        if ($service->influencer_id !== Auth::user()->influencerProfile->id) {
            abort(403);
        }

        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified service
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        // Ensure the service belongs to the authenticated influencer
        if ($service->influencer_id !== Auth::user()->influencerProfile->id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'service_type' => 'required|in:instagram_post,instagram_story,instagram_reel,youtube_video,youtube_shorts,tiktok_video,twitter_post,blog_post,product_review,brand_ambassador,event_appearance,custom',
            'base_price' => 'required|numeric|min:0',
            'delivery_days' => 'required|integer|min:1',
            'revisions_included' => 'required|integer|min:0',
            'requirements' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $service->update($validated);

        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully!');
    }

    /**
     * Remove the specified service
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        // Ensure the service belongs to the authenticated influencer
        if ($service->influencer_id !== Auth::user()->influencerProfile->id) {
            abort(403);
        }

        // Check if service has active orders
        if ($service->orders()->whereIn('status', ['pending', 'accepted', 'in_progress'])->exists()) {
            return back()->with('error', 'Cannot delete service with active orders');
        }

        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully!');
    }

    /**
     * Toggle service active status
     */
    public function toggleStatus($id)
    {
        $service = Service::findOrFail($id);

        // Ensure the service belongs to the authenticated influencer
        if ($service->influencer_id !== Auth::user()->influencerProfile->id) {
            abort(403);
        }

        $service->is_active = !$service->is_active;
        $service->save();

        return response()->json([
            'success' => true,
            'is_active' => $service->is_active
        ]);
    }
}
