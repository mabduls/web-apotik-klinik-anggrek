<?php

namespace App\Http\Controllers;

use App\Models\ProductTransaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserProductTransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('customers')) {
            $product_transactions = $user->product_transactions()->orderBy('id', 'DESC')->get();
        } else {
            $product_transactions = ProductTransaction::orderBy('id', 'DESC')->get();
        }
        return view('customers.product_transactions.index', [
            'product_transactions' => $product_transactions,
        ]);
    }

    public function details(ProductTransaction $productTransaction)
    {
        $productTransaction = ProductTransaction::with('transactionDetails.product')->find($productTransaction->id);
        if (!$productTransaction) {
            return redirect()->back()->with('error', 'Product transaction not found');
        }
        return view('customers.product_transactions.details', [
            'productTransaction' => $productTransaction,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'post_code' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'notes' => 'nullable|string|max:255',
            'proof' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'payment_method' => 'required|string|in:manual,ewallet',
            'total_amount' => 'required|numeric'
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
                'total_amount' => $validated['total_amount'],
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

            return back()->with('success', 'Checkout berhasil! Terima kasih telah berbelanja.');
            
        } catch (\Exception $e) {
            DB::rollBack();

            // Log error untuk debugging
            Log::error('Checkout error: ' . $e->getMessage());

            return back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }
}
