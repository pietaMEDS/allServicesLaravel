<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Products::all()->sortByDesc('priority'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:products|string',
            'description' => 'required|max:255|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'priority' => 'integer',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $imagePath = Storage::disk('public')->put('products', $request->file('logo'));
        $publicUrl = url(Storage::url($imagePath));

        $product = Products::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'logo' => $publicUrl,
            'priority' => $validated['priority'],
            'category_id' => $validated['category_id'],
        ]);
        return response(ProductResource::make($product), 201);
    }

    public function show(string $id)
    {
        $category = Categories::find($id);
        if ($category) {
            return response(ProductResource::collection(Products::where('category_id', $id)->get()));
        }
        return response([
            'status' => 'ERR_NOT_FOUND',
            'message' => 'Category not found',
        ], 404);
    }

    public function update(Request $request, string $id)
    {
        $product = Products::find($id);
        if ($product) {
            $validated = $request->validate([
                'name' => 'max:255|string',
                'description' => 'max:255|string',
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'priority' => 'integer',
                'category_id' => 'integer|exists:categories,id',
            ]);

            if ($request->file('logo')) {
                $imagePath = Storage::disk('public')->put('products', $request->file('logo'));
                $publicUrl = url(Storage::url($imagePath));
                if ($product->logo){
                    $relePath = str_replace(url('/storage') . '/', '', $product->logo);
                    Storage::disk('public')->delete($relePath);
                }
                $product->logo = $publicUrl;
            }

            if (array_key_exists('name', $validated)) {
                $product->name = $validated['name'];
            }
            if (array_key_exists('description', $validated)) {
                $product->description = $validated['description'];
            }
            if (array_key_exists('priority', $validated)) {
                $product->priority = $validated['priority'];
            }
            if (array_key_exists('category_id', $validated)) {
                $product->category_id = $validated['category_id'];
            }

            $product->save();

            return response(ProductResource::make($product));
        }
        return response([
            'status' => 'ERR_NOT_FOUND',
            'message' => 'Product not found'
        ], 404);
    }

    public function destroy(string $id)
    {
        $product = Products::find($id);
        if ($product) {
            if ($product->logo) {
                $relePath = str_replace(url('/storage') . '/', '', $product->logo);
                Storage::disk('public')->delete($relePath);
            }

            $product->delete();
            return response(null, 204);
        }
        return response([
            'status' => 'ERR_NOT_FOUND',
            'message' => 'Product not found'
        ], 404);
    }
}
