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
        ]);

        Review::create([
            'product_id' => $request->product_id,
            'name'       => $request->name,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return back()->with('success', 'Thank you for your review!');
    }
}
