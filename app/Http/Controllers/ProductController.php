<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $userproduct = Product::all();
        return response()->json(['userproduct' => $userproduct], 200);
    }

    public function show($id)
    {
        $userproduct = Product::find($id);
        if ($userproduct) {
            return response()->json(['userproduct' => $userproduct], 200);
        }
        return response()->json(['message' => 'No Product Found'], 404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('product'), $fileName);
            $product->image = $fileName;
        }

        $product->save();

        return redirect()->back()->with('message', 'Product added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'description' => 'required|string|max:191',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:191',
        ]);

        $product = Product::find($id);
        if ($product) {
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->category = $request->category;

            if ($request->hasFile('image')) {
                $fileName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('product'), $fileName);
                $product->image = $fileName;
            }

            $product->update();
            return response()->json(['message' => 'Product updated successfully'], 200);
        }

        return response()->json(['message' => 'No Product Found'], 404);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully'], 200);
        }

        return response()->json(['message' => 'No Product Found'], 404);
    }
}
