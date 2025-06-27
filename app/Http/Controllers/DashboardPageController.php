<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\Rekap;
use App\Models\ProductTransaction;
use Illuminate\Http\Request;

class DashboardPageController extends Controller
{
    // In DashboardPageController.php
    public function index()
    {
        $today = now()->timezone('Asia/Jakarta')->startOfDay();
        // Get statistics
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $pendingReservations = Reservation::where('status', 'menunggu')->count();
        $pendingTransactions = ProductTransaction::where('status', 'pending')->count(); 

        $todayReservations = Reservation::where('created_at', '>=', $today)->count();
        $todayTransactions = ProductTransaction::where('created_at', '>=', $today)->count();

        // Ambil waktu terakhir transaksi hari ini
        $lastTransactionTime = ProductTransaction::where('created_at', '>=', $today)
            ->latest()
            ->value('created_at');

        // Ambil waktu terakhir reservasi hari ini
        $lastReservationTime = Reservation::where('created_at', '>=', $today)
            ->latest()
            ->value('created_at');

        // Get recent reservations (last 5)
        $recentReservations = Reservation::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'pendingReservations',
            'pendingTransactions', 
            'recentReservations',
            'todayReservations',
            'todayTransactions',
            'lastTransactionTime',
            'lastReservationTime'
        ));
    }

    public function details(Product $product)
    {
        $categories = Category::all();
        return view('admin.product_transactions.details', [
            'product' => $product,
        ]);
    }
}
