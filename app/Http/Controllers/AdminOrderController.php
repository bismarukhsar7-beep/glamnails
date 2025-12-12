<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Simple admin auth guard using session admin_id.
     */
    private function ensureAuthenticated()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        return null;
    }

    /**
     * List all orders.
     */
    public function index(Request $request)
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }

        $status = $request->query('status'); // e.g., pending, processing, shipped, completed, cancelled

        $orders = Order::withCount('items')
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->orderByDesc('created_at')
            ->get();

        return view('admin.orders.index', [
            'orders' => $orders,
            'activeStatus' => $status,
        ]);
    }

    /**
     * Show a single order with items.
     */
    public function show($id)
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }

        $order = Order::with('items')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, $id)
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }

        $request->validate([
            'status' => 'required|string|max:50',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', 'Order status updated.');
    }
}

