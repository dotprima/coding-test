<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
      $this->middleware('CheckUserLogin');
    }


    public function index(Request $request)
    {
      $results = Product::get();
      return response()->json([
        'Token' => $request['token'],
        'Data' => $results
      ]);
    }

    public function show(Request $request,$id)
    {
      $results = Product::find($id);
      return response()->json([
        'Token' => $request['token'],
        'Data' => $results
      ]);
    }
}
