<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * API Controller for Product operations
 * Provides RESTful endpoints for product data management
 */
class ProductController extends Controller
{
    /**
     * Get all products with optional filtering
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Product::query();

        // Apply category filter if provided
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Apply search filter if provided
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%")
                  ->orWhere('desc', 'LIKE', "%{$search}%");
            });
        }

        // Apply price range filter if provided
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Apply sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginate results
        $perPage = $request->get('per_page', 12);
        $products = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $products,
            'message' => 'Products retrieved successfully'
        ]);
    }

    /**
     * Get a specific product by ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $product = Product::with('reviews')->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product,
            'message' => 'Product retrieved successfully'
        ]);
    }

    /**
     * Search products by query string
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json([
                'success' => false,
                'message' => 'Search query must be at least 2 characters'
            ], 400);
        }

        $products = Product::where(function($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('category', 'LIKE', "%{$query}%")
              ->orWhere('desc', 'LIKE', "%{$query}%");
        })->limit(20)->get();

        // Format products for JavaScript consumption
        $baseUrl = 'http://127.0.0.1:8000';
        $formattedProducts = $products->map(function($product) use ($baseUrl) {
            // Simple image URL construction
            $imageUrl = $product->image;
            if ($imageUrl && !str_starts_with($imageUrl, 'http')) {
                if (str_starts_with($imageUrl, 'storage/')) {
                    $imageUrl = $baseUrl . '/' . $imageUrl;
                } else {
                    $imageUrl = $baseUrl . '/images/' . $imageUrl;
                }
            }

            return [
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category,
                'price' => $product->price,
                'image' => $imageUrl,
                'url' => $baseUrl . '/products/' . $product->id
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $formattedProducts,
            'message' => 'Search results retrieved successfully'
        ]);
    }

    /**
     * Get products by category
     *
     * @param string $category
     * @return JsonResponse
     */
    public function byCategory(string $category): JsonResponse
    {
        $products = Product::where('category', $category)->get();

        return response()->json([
            'success' => true,
            'data' => $products,
            'message' => 'Products by category retrieved successfully'
        ]);
    }
}


