<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Show the form for creating a review
     */
    public function create($orderId)
    {
        $order = Order::with(['influencer.user', 'service'])->findOrFail($orderId);

        // Ensure the order belongs to the authenticated customer
        if ($order->customer_id !== Auth::id()) {
            abort(403);
        }

        // Ensure order is completed
        if (!$order->canBeReviewed()) {
            return back()->with('error', 'This order cannot be reviewed yet.');
        }

        return view('reviews.create', compact('order'));
    }

    /**
     * Store a newly created review
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'communication_rating' => 'nullable|integer|min:1|max:5',
            'quality_rating' => 'nullable|integer|min:1|max:5',
            'professionalism_rating' => 'nullable|integer|min:1|max:5',
            'value_rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $order = Order::findOrFail($validated['order_id']);

        // Ensure the order belongs to the authenticated customer
        if ($order->customer_id !== Auth::id()) {
            abort(403);
        }

        // Ensure order can be reviewed
        if (!$order->canBeReviewed()) {
            return back()->with('error', 'This order cannot be reviewed.');
        }

        Review::create([
            'order_id' => $order->id,
            'customer_id' => Auth::id(),
            'influencer_id' => $order->influencer_id,
            'rating' => $validated['rating'],
            'communication_rating' => $validated['communication_rating'] ?? null,
            'quality_rating' => $validated['quality_rating'] ?? null,
            'professionalism_rating' => $validated['professionalism_rating'] ?? null,
            'value_rating' => $validated['value_rating'] ?? null,
            'comment' => $validated['comment'] ?? null,
        ]);

        // TODO: Send notification to influencer

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Review submitted successfully!');
    }

    /**
     * Add influencer response to review
     */
    public function respond(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        // Ensure the review is for the authenticated influencer
        if ($review->influencer_id !== Auth::user()->influencerProfile->id) {
            abort(403);
        }

        $validated = $request->validate([
            'influencer_response' => 'required|string|max:500',
        ]);

        $review->influencer_response = $validated['influencer_response'];
        $review->save();

        return back()->with('success', 'Response added successfully!');
    }
}
