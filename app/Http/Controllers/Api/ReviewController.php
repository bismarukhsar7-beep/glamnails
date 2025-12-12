<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * API Controller for Review operations
 * Provides RESTful endpoints for review data management
 */
class ReviewController extends Controller
{
    /**
     * Get all reviews with optional filtering
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Review::with('product')->orderBy('created_at', 'desc');

        // Apply product filter if provided
        if ($request->has('product_id') && $request->product_id) {
            $query->where('product_id', $request->product_id);
        }

        // Apply rating filter if provided
        if ($request->has('rating') && $request->rating) {
            $query->where('rating', $request->rating);
        }

        // Paginate results
        $perPage = $request->get('per_page', 10);
        $reviews = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $reviews,
            'message' => 'Reviews retrieved successfully'
        ]);
    }

    /**
     * Get a specific review by ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $review = Review::with('product')->find($id);

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $review,
            'message' => 'Review retrieved successfully'
        ]);
    }

    /**
     * Create a new review
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max, optional
        ]);

        $data = $request->only(['product_id', 'name', 'rating', 'comment']);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $data['image'] = 'storage/'.$imagePath;
        }

        $review = Review::create($data);

        // Load the product relationship
        $review->load('product');

        return response()->json([
            'success' => true,
            'data' => $review,
            'message' => 'Review created successfully'
        ], 201);
    }

    /**
     * Update an existing review
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found'
            ], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'rating' => 'sometimes|integer|min:1|max:5',
            'comment' => 'sometimes|string|max:1000',
        ]);

        $review->update($request->only(['name', 'rating', 'comment']));

        return response()->json([
            'success' => true,
            'data' => $review,
            'message' => 'Review updated successfully'
        ]);
    }

    /**
     * Delete a review
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'success' => false,
                'message' => 'Review not found'
            ], 404);
        }

        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully'
        ]);
    }

    /**
     * Get reviews for a specific product
     *
     * @param int $productId
     * @return JsonResponse
     */
    public function byProduct(int $productId): JsonResponse
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $reviews = Review::where('product_id', $productId)
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Calculate average rating
        $averageRating = $reviews->avg('rating') ?? 0;

        return response()->json([
            'success' => true,
            'data' => [
                'product' => $product,
                'reviews' => $reviews,
                'average_rating' => round($averageRating, 1),
                'total_reviews' => $reviews->count()
            ],
            'message' => 'Product reviews retrieved successfully'
        ]);
    }
}


