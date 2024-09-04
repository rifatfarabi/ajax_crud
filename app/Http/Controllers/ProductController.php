<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product(){
        return view('products');
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
        ]

    );
    }
}
