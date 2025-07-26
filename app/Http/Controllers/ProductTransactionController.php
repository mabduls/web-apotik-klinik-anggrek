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

        return redirect()->route('admin.product_transactions.show', $productTransaction)
            ->with('success', 'Status transaksi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductTransaction $productTransaction)
    {
        //
    }
}
