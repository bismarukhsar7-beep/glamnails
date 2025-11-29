<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;


class CheckoutController extends Controller
{
    // Show checkout page
    public function index()
    {
        $cart = session()->get('cart', []);

        // Convert cart (which contains product IDs) into usable items
        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);

            if ($product) {
                $quantity = $item['quantity'];
                $subtotal = $product->price * $quantity;
                $total += $subtotal;

                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ];
            }
        }

        return view('checkout.index', compact('cartItems', 'total'));
    }

    // Process checkout (we will complete this after migrating orders table)
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        // Calculate total
        $total = 0;
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $total += $product->price * $item['quantity'];
            }
        }

        // Create order
        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email ?? '',
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => $total,
            'status' => 'pending',
        ]);

        // Save order items
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item['quantity'],
                    'subtotal' => $product->price * $item['quantity'],
                ]);
            }
        }

        // CLEAR CART
        session()->forget('cart');

        return redirect()->route('thankyou');
    }

}
