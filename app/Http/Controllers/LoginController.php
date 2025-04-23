<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\Category;

class LoginController extends Controller
{
    // Redirect user based on their type after login
    public function index() {
        if (Auth::id()) {
            $user_type = Auth()->user()->usertype;
            if ($user_type == "admin") {
                return view("admin.adminhome");
            } elseif ($user_type == "user") {
                return view("user.userhome");
            } else {
                return redirect()->back();
            }
        }
        // Optionally, return a default view or redirect if not authenticated
        return redirect()->route('login1'); // Assuming you have a login route
    }

    // Retrieve all categories
    public function usercategory() {
        $categories = Category::all();

        return response()->json([
            'success' => true,
            'data' => $categories,
            'message' => 'Categories retrieved successfully.'
        ], 200);
    }

    public function userproduct($categoryName = null) {
        if ($categoryName && $categoryName !== 'all') {
            $products = Product::where('category', $categoryName)->get();
        } else {
            $products = Product::all();
        }
    
        if ($products->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No products found for this category.'
            ], 404);
        }
    
        return response()->json([
            'success' => true,
            'products' => $products,
            'message' => 'Products retrieved successfully.'
        ], 200);
    }
}
