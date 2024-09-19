<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product(){
        $products = Product::latest()->paginate(5);
        return view('products', compact('products'));
    }

    public function addProduct(Request $request){

        $request->validate([
            'name' => 'required|unique:products',
            'price' => 'required',
        ],
        [
            'name.required' => 'Name is required',
            'name.unique' => 'Name is already Exists',
            'price.required' => 'Price is required',
        ],

        );

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function updateProduct(Request $request){
        // $request->validate([
        //     'up_name' => 'required|unique:products,id'.$request->up_id,
        //     'up_price' => 'required',
        // ],
        // [
        //     'up_name.required' => 'Name is required',
        //     'up_name.unique' => 'Name is already Exists',
        //     'up_price.required' => 'Price is required',
        // ],

        // );

        Product::where('id',$request->up_id)->update([
            'name' => $request->up_name,
            'price' => $request->up_price,
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }
}
