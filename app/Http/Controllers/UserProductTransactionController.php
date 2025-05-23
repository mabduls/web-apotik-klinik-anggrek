<?php

namespace App\Http\Controllers;

use App\Models\ProductTransaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserProductTransactionController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'sort' => 'nullable|in:newest,oldest',
            'status' => 'nullable|in:paid,pending',
            'page' => 'nullable|integer|min:1'
        ]);

        $query = $user->product_transactions()->with('transactionDetails.product');

        // Get query parameters
        $search = $request->query('search');
        $status = $request->query('status');

        // Base query
        $query = $user->hasRole('customers')
            ? $user->product_transactions()
            : ProductTransaction::query();

        // Apply search filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhere('total_amount', 'like', "%{$search}%")
                    ->orWhereHas('transactionDetails.product', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Apply status filter
        if ($request->has('status')) {
            $query->where('is_paid', $request->status === 'paid');
        }

        // Apply sorting
        $sort = $request->get('sort', 'newest');
        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc'); // default newest
        }

        // Paginate results
        try {
            $product_transactions = $query->paginate(5)->withQueryString();

            // Handle case when page number is too big
            if ($request->has('page') && $product_transactions->isEmpty()) {
                return redirect($product_transactions->url(1));
            }
        } catch (\Exception $e) {
            // Fallback to first page if pagination fails
            return redirect()->route('customers.transaction.page', [
                'page' => 1,
                'search' => $search,
                'sort' => $sort,
                'status' => $status
            ]);
        }

        return view('customers.product_transactions.index', [
            'product_transactions' => $product_transactions,
            'currentSearch' => $search,
            'currentSort' => $sort,
            'currentStatus' => $status,
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
