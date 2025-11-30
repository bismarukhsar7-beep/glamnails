<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function adminIndex()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'desc' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp'
        ]);

        // Upload image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);

        // Insert product
        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'desc' => $request->desc,
            'image' => 'uploads/'.$imageName,
        ]);

        return redirect()->route('admin.products')
            ->with('success', 'Product added successfully!');
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }


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
    public function category($category)
    {
        if ($category == 'all') {
            $products = Product::all();
        } else {
            $products = Product::where('category', $category)->get();
        }

        return view('products.index', compact('products'));
    }


}
