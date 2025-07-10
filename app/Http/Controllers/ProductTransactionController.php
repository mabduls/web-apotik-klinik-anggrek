<?php

namespace App\Http\Controllers;

use App\Models\ProductTransaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 5;

        $query = ProductTransaction::with('user');

        $query->with('user');

        $sort = $request->get('sort', 'newest');
        $statusFilter = $request->get('status');

        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'success':
                $query->where('status', 'approved');
                break;
            case 'pending':
                $query->where('status', 'pending');
                break;
            case 'cancelled':
                $query->where('status', 'cancelled');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        if ($statusFilter === 'success') {
            $query->where('status', 'approved');
        } elseif ($statusFilter === 'pending') {
            $query->where('status', 'pending');
        } elseif ($statusFilter === 'cancelled') {
            $query->where('status', 'cancelled');
        }

        $product_transactions = $query->paginate($perPage);

        return view('admin.product_transactions.index', [
            'product_transactions' => $product_transactions,
            'currentSort' => $sort,
            'currentStatus' => $statusFilter,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'post_code' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'notes' => 'nullable|string|max:255',
            'proof' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'payment_method' => 'required|string|in:manual,ewallet'
        ]);

        DB::beginTransaction();

        try {
            $user = Auth::user();
            $cartItems = $user->carts()->with('product')->get();

            // Verifikasi keranjang tidak kosong
            if ($cartItems->isEmpty()) {
                return back()->with('error', 'Keranjang Anda kosong');
            }

            // Handle file upload
            if ($request->hasFile('proof') && $request->file('proof')->isValid()) {
                $proofPath = $request->file('proof')->store('payment_proofs', 'public');
            } else {
                return back()->with('error', 'Bukti pembayaran tidak valid');
            }

            $totalAmount = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            // Create transaction
            $transaction = ProductTransaction::create([
                'user_id' => $user->id,
                'address' => $validated['address'],
                'city' => $validated['city'],
                'post_code' => $validated['post_code'],
                'phone_number' => $validated['phone_number'],
                'notes' => $validated['notes'] ?? null,
                'proof' => $proofPath,
                'payment_method' => $validated['payment_method'],
                'total_amount' => $totalAmount,
                'is_paid' => false
            ]);

            // Create transaction details
            foreach ($cartItems as $item) {
                TransactionDetail::create([
                    'product_transaction_id' => $transaction->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);
            }

            // Clear cart
            $user->carts()->delete();

            DB::commit();

            return redirect()->route('product_transactions.index')
                ->with('success', 'Checkout berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Checkout error: ' . $e->getMessage());

            return back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductTransaction $productTransaction)
    {
        $productTransaction = ProductTransaction::with(['transactionDetails.product', 'user'])
            ->find($productTransaction->id);

        if (!$productTransaction) {
            return redirect()->back()->with('error', 'Product transaction not found');
        }

        return view('admin.product_transactions.details', [
            'productTransaction' => $productTransaction,
        ]);
    }

    public function edit(ProductTransaction $productTransaction)
    {
        //
    }

    public function update(Request $request, ProductTransaction $productTransaction)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,cancelled'
        ]);

        $productTransaction->update([
            'status' => $validated['status']
        ]);

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductTransaction $productTransaction)
    {
        //
    }
}
