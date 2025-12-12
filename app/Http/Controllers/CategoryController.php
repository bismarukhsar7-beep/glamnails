<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Ensure admin is authenticated.
     */
    private function ensureAuthenticated()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        return null;
    }

    public function index()
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }

        $categories = Category::orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }

        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $path = $request->image->storeAs('uploads', $imageName, 'public');
            $data['image'] = 'storage/' . $path;
        }

        Category::create($data);

        return redirect()->route('admin.categories')
            ->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }

        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }

        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $path = $request->image->storeAs('uploads', $imageName, 'public');
            $data['image'] = 'storage/' . $path;
        }

        $category->update($data);

        return redirect()->route('admin.categories')
            ->with('success', 'Category updated successfully.');
    }

    public function delete($id)
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }

        $category = Category::findOrFail($id);
        
        // Check if category has products
        $productCount = Product::where('category', $category->name)->count();
        
        if ($productCount > 0) {
            return redirect()->route('admin.categories')
                ->with('error', "Cannot delete category '{$category->name}' because it has {$productCount} product(s). Please delete or reassign the products first.");
        }
        
        $category->delete();

        return redirect()->route('admin.categories')
            ->with('success', 'Category deleted successfully.');
    }

    /**
     * Show products belonging to a given category (matched by name).
     */
    public function products($id)
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }

        $category = Category::findOrFail($id);
        $products = Product::where('category', $category->name)->get();

        return view('admin.categories.products', compact('category', 'products'));
    }
}

