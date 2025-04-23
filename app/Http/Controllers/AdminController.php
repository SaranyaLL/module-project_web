<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\category;
use Validator;
use App\Models\product;

class AdminController extends Controller
{
    //
    public function view_category()
    {
        $data=category::all();
        return view('admin.category',compact('data'));
    }
    public function add_category(Request $request)
    {
        // Validating the incoming request data
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:255', // Assuming category is a string field with max length 255
        ]);
    
        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 422); // 422 Unprocessable Entity
        }
    
        // If validation passes, proceed to save the category
        $data = new category;
        $data->category_name = $request->category;
        $data->save();
    
        // Assuming category_id is the unique identifier of the newly added category
        $category_id = $data->id;
    
        // Return success response with JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Category added successfully',
            'category_id' => $category_id
        ]);
    }
   public function view_product()
   {
    $category=category::all();
    return view('admin.product',compact('category'));
   }
    
   public function add_product(Request $request)
   {

    $product = new Product;
   
       $product->title = $request->title;
       $product->description = $request->description;

       //$product->image = $request->image;
       $product->category= $request->category;
       $product->quantity = $request->quantity;
       $product->price= $request->price;
       $image = $request->image;
       $imageName = time() . '.' . $image->getClientOriginalExtension();
       $request->image->move('product',$imageName);
       $product->image=$imageName;

       $product->save();



       return redirect()->back()->with('message', 'Product Added Successfully');

   }
   


   public function delete_category($id)
   {
     $data=category::find($id);
     $data->delete();
     return redirect()->back()->with('message','category deleted successfully');
   }


   public function show_product()
   {
    $product=product::all();
    return view('admin.show_product',compact('product'));
   }

   public function delete_product($id)
   {
    $product=product::find($id);
    $product->delete();
    return redirect()->back()->with('message','Product Deleted Succeccfully');
   }

   public function update_product($id)
   {
    $product=product::find($id);
    $category=category::all();
    return view('admin.update_product',compact('product','category'));
   }

   public function update_product_confirm(Request $request,$id)
   {
    $product=product::find($id);
    $product->title=$request->title;
    $product->description=$request->description;
    $product->price=$request->price;
    $product->category=$request->category;
    $product->quantity=$request->quantity;
    $image=$request->image;

    if($image)
     {
    $imagename=time().'.'.$image->getClientOriginalExtension();
    $request->image->move('product',$imagename);


    $product->image=$imagename;

     }
    $product->save();

     return redirect()->back()->with('message','Product Update Successfully');
   }

}