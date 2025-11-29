<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show all products + search + category filter
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Category filter
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Search filter
        if ($request->filled('query')) {
            $search = $request->query('query');

            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('category', 'LIKE', "%{$search}%");    // ✔ removed description
            });
        }

        $products = $query->get();

        return view('products.index', compact('products'));
    }






    /**
     * Show single product page
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Search page (optional)
     */
    public function search(Request $request)
    {
        $query = trim($request->input('query', ''));

        $results = Product::where('name', 'LIKE', "%{$query}%")->get();

        return view('products.search', [
            'results' => $results,
            'query' => $query
        ]);
    }
}
