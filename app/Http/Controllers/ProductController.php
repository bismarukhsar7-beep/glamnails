<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function adminIndex()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = \App\Models\Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
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

        // Store image via Laravel filesystem (public disk -> storage/app/public/uploads)
        $imagePath = $request->file('image')->store('uploads', 'public');

        // Insert product
        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'desc' => $request->desc,
            'image' => 'storage/'.$imagePath, // public/storage symlink should exist
        ]);

        return redirect()->route('admin.products')
            ->with('success', 'Product added successfully!');
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = \App\Models\Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $data = $request->only(['name', 'category', 'price', 'desc']);
        
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
            ]);
            
            $imagePath = $request->file('image')->store('uploads', 'public');
            $data['image'] = 'storage/'.$imagePath;
        }
        
        $product->update($data);

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
        $categories = Category::orderBy('name')->get();

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

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
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

    /**
     * Ajax search endpoint for dropdown results
     */
    public function ajaxSearch(Request $request)
    {
        $query = $request->input('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $products = Product::where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('category', 'LIKE', "%{$query}%");
            })
            ->limit(10)
            ->get()
            ->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'category' => $product->category,
                    'price' => $product->price,
                    'image' => $product->image_url,
                    'url' => route('products.show', $product->id)
                ];
            });

        return response()->json($products);
    }


}
