<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardPageController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function details(Product $product)
    {
        $categories = Category::all();
        return view('admin.product_transactions.details', [
            'product' => $product,
        ]);
    }
}
