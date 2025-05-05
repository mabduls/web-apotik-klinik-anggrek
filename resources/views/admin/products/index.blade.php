<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/@herophotos/react@2.0.11/outline/index.js" defer></script>
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    @include('layouts.navigation')
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition class="mb-4 px-4 py-3 rounded-lg bg-green-600 text-white shadow-lg flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="text-white hover:text-gray-200 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            @endif
            <div class="mb-6 px-4 sm:px-0 flex flex-row w-full justify-between items-center">
                <h2 class="font-bold text-xl dark:text-gray-200 leading-tight">
                    {{ __('Manage Products') }}
                </h2>
                <a href="{{ route('admin.products.create') }}" class="font-bold py-2 px-6 rounded-full text-white bg-gray-700 hover:bg-gray-600 transition">
                    Add Products
                </a>
            </div>
            <div class="dark:bg-gray-800 p-10 overflow-hidden shadow-sm sm:rounded-lg">
                @forelse($products as $product)
                    <div class="item-card grid grid-cols-12 items-center text-white py-4 hover:bg-gray-700/50 rounded-lg transition-colors">
                        <!-- Product Info Column -->
                        <div class="col-span-12 sm:col-span-5 flex items-center gap-x-4">
                            <img src="{{ Storage::url($product->photo) }}" alt="{{ $product->name }}"
                                class="w-16 h-16 rounded-lg object-cover">
                            <div class="min-w-0">
                                <h3 class="text-gray-900 dark:text-gray-100 font-bold text-lg sm:text-xl truncate">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-base dark:text-white font-medium">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <!-- Category Column -->
                        <div class="col-span-12 sm:col-span-3 mt-2 justify-items-center sm:mt-0">
                            <p class="text-base dark:text-white py-1 px-3 rounded-full">
                                {{ $product->category->name }}
                            </p>
                        </div>

                        <!-- Action Buttons Column -->
                        <div class="col-span-12 sm:col-span-4 flex justify-end gap-3 mt-3 sm:mt-0">
                            <a href="{{ route('admin.products.edit', $product) }}"
                                class="font-bold py-2 px-6 rounded-full text-white bg-gray-700 hover:bg-gray-600 transition">
                                Edit
                            </a>
                            <div x-data="{ open: false }" class="flex">
                                <button @click="open = true" type="button"
                                    class="font-bold py-2 px-4 rounded-full text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 transition-all shadow-md hover:shadow-lg">
                                    Delete
                                </button>
                                <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                    <div class="bg-gray-800 dark:bg-gray-700 rounded-lg p-6 max-w-sm w-full mx-4">
                                        <h3 class="text-xl font-bold text-gray-100 mb-4">Confirm Deletion</h3>
                                        <p class="text-gray-300 mb-6">Are you sure you want to delete "{{ $product->name }}" product? This action cannot be undone.</p>
                                        <div class="flex justify-end space-x-3">
                                            <button @click="open = false" type="button" class="px-4 py-2 rounded-lg text-gray-300 hover:text-white bg-gray-600 hover:bg-gray-500 transition">
                                                Cancel
                                            </button>
                                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @unless($loop->last)
                        <hr class="my-3 border-gray-700">
                    @endunless

                    @empty
                    <div class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-400 py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11.414V15a1 1 0 11-2 0v-1.586l-.293-.293a1 1 0 011.414-1.414L11 12.586zM10 4a6 6 0 100 12A6 6 0 0010 4z" />
                        </svg>
                        <p class="text-lg font-semibold">No Products Found</p>
                        <p class="text-gray-500 dark:text-gray-400">You have not added any products yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</body>

</html>