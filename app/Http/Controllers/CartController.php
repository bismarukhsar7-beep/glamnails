<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Add item to cart
    public function add(Request $request)
    {
        $productId = $request->product_id;

        // Validate product exists
        $product = Product::findOrFail($productId);

        $quantity = max(1, (int)$request->quantity); // <-- Use the real quantity

        $cart = session()->get('cart', []);

        // If item exists, increase qty by chosen amount
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'quantity' => $quantity
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart!');
    }


    // Show cart page
    public function index()
    {
        $cart = session()->get('cart', []);

        // Convert cart items into Product models
        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);

            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $product->price * $item['quantity'],
                ];

                $total += $product->price * $item['quantity'];
            }
        }

        return view('pages.cart.index', compact('cartItems', 'total'));
    }

    // Update item qty
    public function update(Request $request)
    {
        $productId = $request->product_id;

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = max(1, (int)$request->quantity);
            session()->put('cart', $cart);
        }

        return back();
    }

    // Remove item
    public function remove(Request $request)
    {
        $productId = $request->product_id;

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return back();
    }

    // Clear cart
    public function clear()
    {
        session()->forget('cart');
        return back();
    }
}
