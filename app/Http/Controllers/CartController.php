<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class CartController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'user_id'=>'required|integer|exists:user,id',
            'quantity' => 'required|integer|min:1',  
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'price' => 'required|string',
            'image' => 'required|string',
        ]);
        $product = Product::find($validatedData['product_id']);

if (!$product) {
    return response()->json(['success' => false, 'message' => 'Product not found'], 404);
}

        
            
    
    
        // Check if the user is authenticated

        if (Auth::check()) {
            $user = Auth::user();
            $product = Product::find($validatedData['product_id']);
    
            if ($product) {
                // Attempt to update or create a cart item
                $cart = Cart::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                    ],
                    [
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'address' => $user->address,
                        'quantity' => $validatedData['quantity'],
                        'price' => $product->price,
                        'image' => $product->image,
                    ]
                );
    
                if ($cart->wasRecentlyCreated || $cart->wasChanged()) {
                    return response()->json(['success' => true, 'message' => 'Product added to cart']);
                } else {
                    return response()->json(['success' => false, 'message' => 'No changes were made to the cart item'], 400);
                }
            }
        }
    
        return response()->json(['success' => false, 'message' => 'Failed to add product'], 400);
    }
    
    


    
    
}
