<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Reservation;
use Carbon\Carbon;
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

    public function showDoctors()
    {
        $products = Product::with('category')->orderBy('id', 'desc')->take(6)->get();
        $categories = Category::all();

        // Set timezone ke Indonesia (WIB - UTC+7)
        $now = Carbon::now('Asia/Jakarta'); // Asia/Jakarta = WIB timezone

        // Ambil semua reservasi user terlebih dahulu
        $allReservations = Reservation::where('user_id', auth()->id())->get();

        // Filter manual dengan timezone yang benar
        $reservations = $allReservations->filter(function ($reservation) use ($now) {
            // Parse tanggal dan jam reservasi dengan timezone WIB
            $reservationDate = Carbon::parse($reservation->tanggal_reservasi, 'Asia/Jakarta');
            $reservationTime = Carbon::parse($reservation->jam_reservasi, 'Asia/Jakarta');

            // Gabungkan tanggal dan jam reservasi
            $reservationDateTime = Carbon::create(
                $reservationDate->year,
                $reservationDate->month,
                $reservationDate->day,
                $reservationTime->hour,
                $reservationTime->minute,
                $reservationTime->second,
                'Asia/Jakarta' // Set timezone WIB
            );

            // Return true jika reservasi masih akan datang (lebih dari sekarang)
            return $reservationDateTime->gt($now);
        })
            ->sortBy([
                ['tanggal_reservasi', 'asc'],
                ['jam_reservasi', 'asc']
            ]);

        return view('customers.dashboard_page.doctors', [
            'products' => $products,
            'categories' => $categories,
            'reservations' => $reservations,
        ]);
    }

    public function showMedicines(Request $request)
    {
        $query = Product::with('category');

        // Filter berdasarkan kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $products = Product::with('category')->orderBy('name', 'asc')->get();
        $categories = Category::all();

        return view('customers.dashboard_page.medicines', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
