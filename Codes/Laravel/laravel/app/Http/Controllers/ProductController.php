<?php

namespace App\Http\Controllers;

use App\Jobs\addProductJob;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function get(Request $request) {
        return Product::all();
    }

    public function add (Request $request) {
        dispatch(new addProductJob($request->only('name')));
    }
}
