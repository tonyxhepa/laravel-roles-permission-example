<?php

namespace App\Http\Controllers;

use App\Models\Product;
use function auth;
use function view;

class ProductController extends Controller
{
    public function index()
    {
        $products = auth()->user()->products;

        return view('products.index', compact('products'));
    }

    public function edit(Product $product)
    {
        $this->authorize('view', $product);
        return $product;
    }
}
