<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;

class CategoryController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $categories = Category::orderBy('id')->get();

        return response()->json([
            'status' => 'success',
            'categories' => $categories
        ]);
    }

    public function store(StorecategoryRequest $request)
    {
        $category = Category::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "category Created successfully!",
            'category' => $category
        ], 201);
    }

    public function show(Category $category)
    {
        $category->find($category->id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($category, 200);
    }

    public function update(StorecategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        if (!$category) {
            return response()->json(['message' => 'category not found'], 404);
        }

        return response()->json([
            'status' => true,
            'message' => "category Updated successfully!",
            'category' => $category
        ], 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully'
        ], 200);
    }
}