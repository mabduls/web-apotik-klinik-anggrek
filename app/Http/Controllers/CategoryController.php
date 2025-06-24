<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $perPage = 5; 
        $categories = Category::orderBy('id', 'DESC')
            ->paginate($perPage);

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:png,jpg,jpeg,svg',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('category_icons', 'public');
                $validated['icon'] = $iconPath;
            }

            $validated['slug'] = Str::slug($request->name);

            Category::create($validated);

            DB::commit();

            return redirect()->route('admin.categories.index')->with('success', 'Category Created Successfully');
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
    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'icon' => 'sometimes|image|mimes:png,jpg,jpeg,svg',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('category_icons', 'public');
                $validated['icon'] = $iconPath;
            }

            $validated['slug'] = Str::slug($request->name);
            $category->update($validated);

            DB::commit();

            return redirect()->route('admin.categories.index')->with('success', 'Category Update Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['Something went wrong! Please try again later.' . $e->getMessage()],
            ]);
            throw $error;
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Category Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['Something went wrong! Please try again later.' . $e->getMessage()],
            ]);
            throw $error;
        }
    }
}
