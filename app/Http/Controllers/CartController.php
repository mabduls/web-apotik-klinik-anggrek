<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cart()
    {
        $user = Auth::user();
        $my_carts = $user->carts()->with('product')->get();
        return view('customers.dashboard_page.cart', [
            'my_carts' => $my_carts
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
    public function store($productId, Request $request)
    {
        $user = Auth::user();
        $existingCart = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        DB::beginTransaction();
        try {
            if ($existingCart) {
                $existingCart->quantity += $request->quantity ?? 1;
                $existingCart->save();
            } else {
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'quantity' => $request->quantity ?? 1
                ]);
            }

            DB::commit();
            return redirect()->route('customers.dashboard.page.cart')->with('success', 'Product added to cart');
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'system_error' => ['Product failed added to cart: ' . $e->getMessage()],
            ]);
        }
    }

    public function updateQuantity(Request $request, Cart $cart)
    {
        // Validate the request
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        try {
            // Update the cart item quantity
            $cart->quantity = $request->quantity;
            $cart->save();

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Cart quantity updated successfully',
                'quantity' => $cart->quantity
            ]);
        } catch (\Exception $e) {
            // Return an error response
            return response()->json([
                'success' => false,
                'message' => 'Failed to update cart quantity: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function clear()
    {
        $user = Auth::user();

        try {
            $user->carts()->delete();
            return redirect()->route('customers.dashboard.page.cart')
                ->with('success', 'All items have been removed from your cart');
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'system_error' => ['Something went wrong! Please try again later. ' . $e->getMessage()],
            ]);
        }
    }

    public function destroy(Cart $cart)
    {
        try {
            $cart->delete();
            return redirect()->route('customers.dashboard.page.cart')
                ->with('success', 'Product removed from cart');
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'system_error' => ['Something went wrong! Please try again later. ' . $e->getMessage()],
            ]);
        }
    }
}
