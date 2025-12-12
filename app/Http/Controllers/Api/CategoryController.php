<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * API Controller for Category operations
 * Provides RESTful endpoints for category data management
 */
class CategoryController extends Controller
{
    /**
     * Get all categories
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $categories = Category::orderBy('name')->get();

        // Optionally include product count for each category
        if ($request->has('include_product_count') && $request->include_product_count) {
            $categories->transform(function($category) {
                $category->product_count = Product::where('category', $category->name)->count();
                return $category;
            });
        }

        return response()->json([
            'success' => true,
            'data' => $categories,
            'message' => 'Categories retrieved successfully'
        ]);
    }

    /**
     * Get a specific category by ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category,
            'message' => 'Category retrieved successfully'
        ]);
    }

    /**
     * Get products belonging to a specific category
     *
     * @param int $id
     * @return JsonResponse
     */
    public function products(int $id): JsonResponse
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        $products = Product::where('category', $category->name)->get();

        return response()->json([
            'success' => true,
            'data' => [
                'category' => $category,
                'products' => $products
            ],
            'message' => 'Category products retrieved successfully'
        ]);
    }
}


