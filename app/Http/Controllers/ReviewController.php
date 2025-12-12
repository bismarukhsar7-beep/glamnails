<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{

    public function index()
    {
        $reviews = Review::latest()->get();
        return view('reviews.index', compact('reviews'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'name'       => 'required|string|max:255',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'required|string',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max, optional
        ]);

        $data = [
            'product_id' => $request->product_id,
            'name'       => $request->name,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ];

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $data['image'] = 'storage/'.$imagePath;
        }

        Review::create($data);

        return back()->with('success', 'Thank you for your review!');
    }

    /**
     * Admin: List all reviews
     */
    public function adminIndex()
    {
        // Ensure admin is authenticated
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $reviews = Review::with('product')->latest()->paginate(20);
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Admin: Show single review
     */
    public function adminShow($id)
    {
        // Ensure admin is authenticated
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $review = Review::with('product')->findOrFail($id);
        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Admin: Delete review
     */
    public function adminDelete($id)
    {
        // Ensure admin is authenticated
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        Review::findOrFail($id)->delete();
        return redirect()->route('admin.reviews')->with('success', 'Review deleted successfully!');
    }
}
