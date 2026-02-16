<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display role-based dashboard
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isInfluencer()) {
            return $this->influencerDashboard();
        } elseif ($user->isCustomer()) {
            return $this->customerDashboard();
        } elseif ($user->isAdmin()) {
            return $this->adminDashboard();
        }

        abort(403);
    }

    /**
     * Influencer dashboard
     */
    private function influencerDashboard()
    {
        $profile = Auth::user()->influencerProfile;

        if (!$profile) {
            return redirect()->route('influencer.create')
                ->with('info', 'Please create your influencer profile first.');
        }

        $stats = [
            'total_orders' => $profile->orders()->count(),
            'pending_orders' => $profile->orders()->where('status', Order::STATUS_PENDING)->count(),
            'completed_orders' => $profile->orders()->where('status', Order::STATUS_COMPLETED)->count(),
            'total_earnings' => $profile->orders()
                ->where('status', Order::STATUS_COMPLETED)
                ->sum('influencer_earnings'),
            'average_rating' => $profile->getAverageRating(),
            'total_reviews' => $profile->getTotalReviews(),
            'active_services' => $profile->services()->where('is_active', true)->count(),
        ];

        $recentOrders = $profile->orders()
            ->with(['customer', 'service'])
            ->latest()
            ->take(5)
            ->get();

        $recentReviews = $profile->reviews()
            ->with(['customer', 'order'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.influencer', compact('stats', 'recentOrders', 'recentReviews', 'profile'));
    }

    /**
     * Customer dashboard
     */
    private function customerDashboard()
    {
        $user = Auth::user();

        $stats = [
            'total_orders' => $user->ordersAsCustomer()->count(),
            'pending_orders' => $user->ordersAsCustomer()->where('status', Order::STATUS_PENDING)->count(),
            'completed_orders' => $user->ordersAsCustomer()->where('status', Order::STATUS_COMPLETED)->count(),
            'total_spent' => $user->ordersAsCustomer()
                ->where('status', Order::STATUS_COMPLETED)
                ->sum('total_amount'),
            'favorites_count' => $user->favorites()->count(),
        ];

        $recentOrders = $user->ordersAsCustomer()
            ->with(['influencer.user', 'service'])
            ->latest()
            ->take(5)
            ->get();

        $favoriteInfluencers = $user->favorites()
            ->with('influencer.user')
            ->latest()
            ->take(6)
            ->get();

        return view('dashboard.customer', compact('stats', 'recentOrders', 'favoriteInfluencers'));
    }

    /**
     * Admin dashboard
     */
    private function adminDashboard()
    {
        $stats = [
            'total_users' => \App\Models\User::count(),
            'total_influencers' => \App\Models\InfluencerProfile::count(),
            'total_customers' => \App\Models\User::where('role', 'customer')->count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', Order::STATUS_PENDING)->count(),
            'total_revenue' => Order::where('status', Order::STATUS_COMPLETED)->sum('platform_fee'),
            'pending_verifications' => \App\Models\InfluencerProfile::where('verification_status', 'pending')->count(),
        ];

        $recentOrders = Order::with(['customer', 'influencer.user', 'service'])
            ->latest()
            ->take(10)
            ->get();

        $pendingVerifications = \App\Models\InfluencerProfile::with('user')
            ->where('verification_status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.admin', compact('stats', 'recentOrders', 'pendingVerifications'));
    }
}
