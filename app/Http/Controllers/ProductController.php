<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function GetProducts () {
        return Response(Product::all(), 200);
    }

    public function GetProduct ($id) {
        return Response(Product::findOrFail($id), 200);
    }

    public function AddProduct (Request $request) {
        return Response(Product::create($request->all()), 201);
    }

    public function UpdateProduct (Request $request, $id) {
        Product::findOrFail($id)->update($request->all());
        return Response(Product::findOrFail($id), 200);
    }

    public function DeleteProduct ($id) {
        Response(Product::findOrFail($id)->delete(), 204);
    }
}