<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'DESC')->get();
        return view('admin.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'about' => 'required|string',
            'price' => 'required|integer|min:0',
            'photo' => 'required|image|mimes:png,jpg,jpeg,svg',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('product_photos', 'public');
                $validated['photo'] = $photoPath;
            }

            $validated['slug'] = Str::slug($request->name);

            Product::create($validated);

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['Something went wrong! Please try again later.' . $e->getMessage()],
            ]);
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'photo' => 'sometimes|image|mimes:png,jpg,jpeg,svg',
            'about' => 'sometimes|string',
            'price' => 'sometimes|integer|min:0',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('photo')) {
                if ($product->photo) {
                    Storage::disk('public')->delete($product->photo);
                }
                
                $photoPath = $request->file('photo')->store('product_photos', 'public');
                $validated['photo'] = $photoPath;
            }

            $validated['slug'] = Str::slug($request->name);
            $product -> update($validated);

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product Update Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['Something went wrong! Please try again later.' . $e->getMessage()],
            ]);
            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->route('admin.products.index')->with('success', 'Product Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['Something went wrong! Please try again later.' . $e->getMessage()],
            ]);
            throw $error;
        }
    }
}
