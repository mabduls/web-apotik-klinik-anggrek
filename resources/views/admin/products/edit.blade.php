<!DOCTYPE html>
<html lang="en" class="dark"> <!-- Force dark mode -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    @include('layouts.navigation')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 px-4 sm:px-0">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Edit Product') }}
                </h2>
            </div>
            <div class="bg-white dark:bg-gray-800 p-10 overflow-hidden shadow-sm sm:rounded-lg">
                @if($errors->any())
                @foreach ($errors->all() as $error)
                <div class="mb-4 py-3 w-full text-center text-red-600 bg-red-100 border border-red-300 rounded-lg dark:bg-red-200 dark:text-red-800 dark:border-red-800" role="alert">
                    {{ $error }}
                </div>
                @endforeach
                @endif
                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="mb-3 block font-medium text-sm text-gray-700 dark:text-gray-300">
                            {{ __('Name') }}
                        </label>
                        <input id="name" type="text" name="name" value="{{ $product->name ?? old('name') }}" autofocus
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-600" />
                        @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="price" class="mb-3 block font-medium text-sm text-gray-700 dark:text-gray-300">
                            {{ __('Price') }}
                        </label>
                        <input id="price" type="number" name="price" value="{{ $product->price ?? old('price') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-600" />
                        @error('price')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="category_id" class="mb-3 block font-medium text-sm text-gray-700 dark:text-gray-300">
                            {{ __('Category') }}
                        </label>
                        <select name="category_id" id="category_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 
                            dark:border-gray-600 dark:text-white dark:focus:ring-indigo-600 py-2 px-3">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="photo" class="mb-3 block font-medium text-sm text-gray-700 dark:text-gray-300">
                            {{ __('Photo') }}
                        </label>
                        @if($product->photo)
                        <img src="{{ Storage::url($product->photo) }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-full object-cover">
                        @else
                        <div class="w-12 h-12 bg-gray-200 rounded-full"></div>
                        @endif
                        <input id="photo" type="file" name="photo" autocomplete="Photo"
                            class="mt-5 block w-full text-gray-700 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900 dark:file:text-indigo-100 dark:hover:file:bg-indigo-800" />
                        @error('photo')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="about" class="mb-3 block font-medium text-sm text-gray-700 dark:text-gray-300">
                            {{ __('About') }}
                        </label>
                        <textarea name="about" id="about" rows="5"
                            class="border border-gray-300 rounded-xl w-full shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-indigo-600 py-2 px-3">{{ $product->about ?? old('about') }}</textarea>
                        @error('about')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end mt-6 flex-column">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:bg-indigo-500 dark:hover:bg-indigo-400">
                            {{ __('Update Product') }}
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="ml-5 font-bold py-2 px-6 rounded-full text-white bg-gray-700 hover:bg-gray-600 transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>