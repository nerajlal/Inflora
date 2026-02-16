<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\ServicePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of orders (customer or influencer view)
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->isCustomer()) {
            $orders = Order::with(['influencer.user', 'service'])
                ->where('customer_id', $user->id)
                ->latest()
                ->paginate(10);
        } elseif ($user->isInfluencer()) {
            $orders = Order::with(['customer', 'service'])
                ->where('influencer_id', $user->influencerProfile->id)
                ->latest()
                ->paginate(10);
        } else {
            abort(403);
        }

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order
     */
    public function create($serviceId)
    {
        $service = Service::with(['influencer.user', 'packages'])->findOrFail($serviceId);

        return view('orders.create', compact('service'));
    }

    /**
     * Store a newly created order
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'package_id' => 'nullable|exists:service_packages,id',
            'brief' => 'required|string',
            'requirements' => 'nullable|array',
        ]);

        $service = Service::findOrFail($validated['service_id']);
        $package = $validated['package_id'] ? ServicePackage::findOrFail($validated['package_id']) : null;

        // Calculate pricing
        $totalAmount = $package ? $package->price : $service->base_price;
        $platformFeeRate = config('app.platform_commission_rate', 15) / 100;
        $platformFee = $totalAmount * $platformFeeRate;
        $influencerEarnings = $totalAmount - $platformFee;

        // Calculate delivery date
        $deliveryDays = $package ? $package->delivery_days : $service->delivery_days;
        $deliveryDate = now()->addDays($deliveryDays);

        $order = Order::create([
            'customer_id' => Auth::id(),
            'influencer_id' => $service->influencer_id,
            'service_id' => $service->id,
            'package_id' => $package?->id,
            'status' => Order::STATUS_PENDING,
            'total_amount' => $totalAmount,
            'platform_fee' => $platformFee,
            'influencer_earnings' => $influencerEarnings,
            'brief' => $validated['brief'],
            'requirements' => $validated['requirements'] ?? null,
            'delivery_date' => $deliveryDate,
        ]);

        // TODO: Send notification to influencer
        // TODO: Process payment

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order placed successfully! Waiting for influencer to accept.');
    }

    /**
     * Display the specified order
     */
    public function show($id)
    {
        $order = Order::with([
            'customer',
            'influencer.user',
            'service',
            'package',
            'deliverables',
            'review'
        ])->findOrFail($id);

        // Ensure user has permission to view this order
        $user = Auth::user();
        if ($user->isCustomer() && $order->customer_id !== $user->id) {
            abort(403);
        }
        if ($user->isInfluencer() && $order->influencer_id !== $user->influencerProfile->id) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Update order status (influencer only)
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Ensure the order belongs to the authenticated influencer
        if ($order->influencer_id !== Auth::user()->influencerProfile->id) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:accepted,in_progress,delivered,cancelled',
            'reason' => 'required_if:status,cancelled|string|nullable',
        ]);

        $order->status = $validated['status'];
        $order->save();

        // TODO: Send notification to customer

        $message = match($validated['status']) {
            'accepted' => 'Order accepted successfully!',
            'in_progress' => 'Order marked as in progress.',
            'delivered' => 'Order delivered! Waiting for customer approval.',
            'cancelled' => 'Order cancelled.',
            default => 'Order status updated.'
        };

        return redirect()->route('orders.show', $order->id)
            ->with('success', $message);
    }

    /**
     * Upload deliverables (influencer only)
     */
    public function uploadDeliverable(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Ensure the order belongs to the authenticated influencer
        if ($order->influencer_id !== Auth::user()->influencerProfile->id) {
            abort(403);
        }

        $validated = $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'description' => 'nullable|string',
        ]);

        $filePath = $request->file('file')->store('deliverables', 'public');
        $fileType = $request->file('file')->getClientOriginalExtension();

        $order->deliverables()->create([
            'file_path' => $filePath,
            'file_type' => $fileType,
            'description' => $validated['description'] ?? null,
            'delivered_at' => now(),
        ]);

        // Update order status to delivered if not already
        if ($order->status !== Order::STATUS_DELIVERED) {
            $order->status = Order::STATUS_DELIVERED;
            $order->save();
        }

        return back()->with('success', 'Deliverable uploaded successfully!');
    }

    /**
     * Approve order (customer only)
     */
    public function approve($id)
    {
        $order = Order::findOrFail($id);

        // Ensure the order belongs to the authenticated customer
        if ($order->customer_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== Order::STATUS_DELIVERED) {
            return back()->with('error', 'Order must be delivered before approval.');
        }

        $order->status = Order::STATUS_COMPLETED;
        $order->save();

        // TODO: Release payment to influencer

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order completed! You can now leave a review.');
    }

    /**
     * Request revision (customer only)
     */
    public function requestRevision(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Ensure the order belongs to the authenticated customer
        if ($order->customer_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'revision_notes' => 'required|string',
        ]);

        $order->status = Order::STATUS_REVISION_REQUESTED;
        $order->requirements = array_merge(
            $order->requirements ?? [],
            ['revision_notes' => $validated['revision_notes']]
        );
        $order->save();

        // TODO: Send notification to influencer

        return back()->with('success', 'Revision requested successfully!');
    }
}
