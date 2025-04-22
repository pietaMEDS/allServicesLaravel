<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response( CategoryResource::collection( Categories::all()->sortByDesc('priority') ) );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255|string',
            'description' => 'required|string|max:255',
            'priority' => 'required|integer|min:0|max:100',
        ]);

        $category = Categories::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
        ]);

        return response( CategoryResource::make($category), 201 );
    }

    public function update(Request $request, string $id)
    {
        $category = Categories::find($id);
        if ($category) {
            $validated = $request->validate([
                'name' => 'max:255|string',
                'description' => 'string|max:255',
                'priority' => 'integer|min:0|max:100',
            ]);

            $category->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'priority' => $validated['priority'],
            ]);

            return response( CategoryResource::make($category) );
        }

        return response( [
            'status' => 'ERR_NOT_FOUND',
            'message' => 'Category not found'
        ], 404 );
    }

    public function destroy(string $id)
    {
        $category = Categories::find($id);
        if ($category && $id != 1) {

            Products::where('category_id', $id)->update(['category_id' => 1]);

            $category->delete();
            return response( null, 204 );
        }
        return response( [
            'status' => 'ERR_NOT_FOUND',
            'message' => 'Category not found'
        ], 404 );

    }
}
