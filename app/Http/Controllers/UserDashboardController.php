<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'desc')->take(6)->get();
        $categories = Category::all();
        return view('customers.dashboard_page.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function details(Product $product)
    {
        $categories = Category::all();
        return view('customers.dashboard_page.details', [
            'product' => $product,
        ]);
    }
}
