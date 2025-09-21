<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/@heroicons/react@2.0.11/outline/index.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-100 to-gray-200 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 font-sans antialiased">
    @include('layouts.navigation')

    <div class="py-8 lg:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Success Alert -->
            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" class="mb-6 relative">
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg p-4 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            <div>
                                <p class="font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button @click="show = false" class="flex-shrink-0 ml-4 text-white hover:text-green-200 transition-colors duration-200">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endif

            <!-- Header Section -->
            <div class="mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 lg:p-8">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-blue-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-box text-white text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ __('Product Management') }}
                                </h1>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">
                                    Manage your pharmacy inventory and products
                                </p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-blue-600 hover:from-purple-600 hover:to-blue-700 text-white rounded-xl font-semibold transition-all duration-200 transform hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <i class="fas fa-plus mr-2"></i>Add New Product
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid/List -->
            <div class="space-y-4">
                @forelse($products as $product)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700 group">
                    <div class="p-6">

                        <!-- Mobile Layout -->
                        <div class="block lg:hidden space-y-4">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="relative">
                                        <img src="{{ Storage::url($product->photo) }}" alt="{{ $product->name }}"
                                            class="w-20 h-20 rounded-xl object-cover shadow-md">
                                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-br from-purple-500 to-blue-600 rounded-full flex items-center justify-center">
                                            <i class="fas fa-pills text-white text-xs"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                                        {{ $product->name }}
                                    </h3>
                                    <div class="flex items-center space-x-2 mb-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                            <i class="fas fa-tag mr-1"></i>{{ $product->category->name }}
                                        </span>
                                    </div>
                                    <p class="text-xl font-bold text-purple-600 dark:text-purple-400">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex justify-between items-center pt-4 border-t border-gray-100 dark:border-gray-700">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="inline-flex items-center px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200">
                                        <i class="fas fa-edit mr-1 text-sm"></i>Edit
                                    </a>

                                    <div x-data="{ open: false }">
                                        <button @click="open = true"
                                            class="inline-flex items-center px-3 py-2 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-lg hover:bg-red-200 dark:hover:bg-red-800 transition-all duration-200">
                                            <i class="fas fa-trash mr-1 text-sm"></i>Delete
                                        </button>

                                        <!-- Delete Modal -->
                                        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
                                            <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-6 max-w-md w-full">
                                                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-red-100 dark:bg-red-900 rounded-full">
                                                    <i class="fas fa-exclamation-triangle text-2xl text-red-600 dark:text-red-400"></i>
                                                </div>
                                                <h3 class="text-xl font-bold text-gray-900 dark:text-white text-center mb-2">Delete Product</h3>
                                                <p class="text-gray-600 dark:text-gray-400 text-center mb-6">
                                                    Are you sure you want to delete "<strong class="text-gray-900 dark:text-white">{{ $product->name }}</strong>"? This action cannot be undone.
                                                </p>
                                                <div class="flex space-x-3">
                                                    <button @click="open = false"
                                                        class="flex-1 px-4 py-3 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-xl transition-colors duration-200 font-medium">
                                                        Cancel
                                                    </button>
                                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="flex-1">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="w-full px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl transition-all duration-200 font-medium">
                                                            Delete Product
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Desktop Layout -->
                        <div class="hidden lg:flex lg:items-center lg:justify-between">
                            <div class="flex items-center space-x-6 flex-1">
                                <div class="flex-shrink-0">
                                    <div class="relative">
                                        <img src="{{ Storage::url($product->photo) }}" alt="{{ $product->name }}"
                                            class="w-20 h-20 rounded-xl object-cover shadow-md group-hover:shadow-lg transition-shadow duration-300">
                                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-br from-purple-500 to-blue-600 rounded-full flex items-center justify-center">
                                            <i class="fas fa-pills text-white text-xs"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                                        {{ $product->name }}
                                    </h3>
                                    <div class="flex items-center space-x-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                            <i class="fas fa-tag mr-2"></i>{{ $product->category->name }}
                                        </span>
                                        <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3 ml-6">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200 font-medium">
                                    <i class="fas fa-edit mr-2"></i>Edit Product
                                </a>

                                <div x-data="{ open: false }">
                                    <button @click="open = true"
                                        class="inline-flex items-center px-4 py-2 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-xl hover:bg-red-200 dark:hover:bg-red-800 transition-all duration-200 font-medium">
                                        <i class="fas fa-trash mr-2"></i>Delete
                                    </button>

                                    <!-- Delete Modal -->
                                    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
                                        <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-6 max-w-md w-full">
                                            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-red-100 dark:bg-red-900 rounded-full">
                                                <i class="fas fa-exclamation-triangle text-2xl text-red-600 dark:text-red-400"></i>
                                            </div>
                                            <h3 class="text-xl font-bold text-gray-900 dark:text-white text-center mb-2">Delete Product</h3>
                                            <p class="text-gray-600 dark:text-gray-400 text-center mb-6">
                                                Are you sure you want to delete "<strong class="text-gray-900 dark:text-white">{{ $product->name }}</strong>"? This action cannot be undone.
                                            </p>
                                            <div class="flex space-x-3">
                                                <button @click="open = false"
                                                    class="flex-1 px-4 py-3 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-xl transition-colors duration-200 font-medium">
                                                    Cancel
                                                </button>
                                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="flex-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-full px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl transition-all duration-200 font-medium">
                                                        Delete Product
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty

                <!-- Enhanced Empty State -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 bg-gradient-to-br from-purple-100 to-blue-100 dark:from-purple-900 dark:to-blue-900 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-box-open text-4xl text-purple-500 dark:text-purple-400"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">No Products Found</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-8">
                            You haven't added any products yet. Start building your pharmacy inventory by adding your first product.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="{{ route('admin.products.create') }}"
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-blue-600 hover:from-purple-600 hover:to-blue-700 text-white rounded-xl font-semibold transition-all duration-200 transform hover:scale-105">
                                <i class="fas fa-plus mr-2"></i>Add Your First Product
                            </a>
                            <button class="inline-flex items-center px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200">
                                <i class="fas fa-download mr-2"></i>Import Products
                            </button>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Enhanced Pagination -->
            @if($products->count() > 0 || $products->hasPages())
            <div class="mt-8">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
                        </div>

                        <div class="flex items-center space-x-1">
                            {{-- First Page Link --}}
                            <a href="{{ $products->url(1) }}"
                                class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $products->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500' : 'bg-blue-500 text-white hover:bg-blue-600 hover:shadow-md' }}"
                                title="First Page"
                                {{ $products->onFirstPage() ? 'aria-disabled=true' : '' }}>
                                <i class="fas fa-angle-double-left"></i>
                            </a>

                            {{-- Previous Page Link --}}
                            <a href="{{ $products->previousPageUrl() }}"
                                class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $products->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500' : 'bg-blue-500 text-white hover:bg-blue-600 hover:shadow-md' }}"
                                title="Previous"
                                {{ $products->onFirstPage() ? 'aria-disabled=true' : '' }}>
                                <i class="fas fa-angle-left"></i>
                            </a>

                            {{-- Pagination Numbers --}}
                            @php
                            $currentPage = $products->currentPage();
                            $lastPage = $products->lastPage();
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($lastPage, $currentPage + 2);

                            if ($currentPage <= 3) {
                                $endPage=min(5, $lastPage);
                                }
                                if ($currentPage>= $lastPage - 2) {
                                $startPage = max($lastPage - 4, 1);
                                }

                                $showStartEllipsis = $startPage > 2;
                                $showEndEllipsis = $endPage < $lastPage - 1;
                                    @endphp

                                    {{-- Always show first page --}}
                                    <a href="{{ $products->url(1) }}"
                                    class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ 1 == $currentPage ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}">
                                    1
                                    </a>

                                    @if($showStartEllipsis)
                                    <span class="px-2 py-2 text-gray-500 dark:text-gray-400">...</span>
                                    @endif

                                    {{-- Middle pages --}}
                                    @for ($i = $startPage; $i <= $endPage; $i++)
                                        @if($i !=1 && $i !=$lastPage)
                                        <a href="{{ $products->url($i) }}"
                                        class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $i == $currentPage ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}">
                                        {{ $i }}
                                        </a>
                                        @endif
                                        @endfor

                                        @if($showEndEllipsis)
                                        <span class="px-2 py-2 text-gray-500 dark:text-gray-400">...</span>
                                        @endif

                                        {{-- Always show last page if different from first --}}
                                        @if($lastPage != 1)
                                        <a href="{{ $products->url($lastPage) }}"
                                            class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $lastPage == $currentPage ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}">
                                            {{ $lastPage }}
                                        </a>
                                        @endif

                                        {{-- Next Page Link --}}
                                        <a href="{{ $products->nextPageUrl() }}"
                                            class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ !$products->hasMorePages() ? 'bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500' : 'bg-blue-500 text-white hover:bg-blue-600 hover:shadow-md' }}"
                                            title="Next"
                                            {{ !$products->hasMorePages() ? 'aria-disabled=true' : '' }}>
                                            <i class="fas fa-angle-right"></i>
                                        </a>

                                        {{-- Last Page Link --}}
                                        <a href="{{ $products->url($lastPage) }}"
                                            class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $products->currentPage() == $lastPage ? 'bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500' : 'bg-blue-500 text-white hover:bg-blue-600 hover:shadow-md' }}"
                                            title="Last Page"
                                            {{ $products->currentPage() == $lastPage ? 'aria-disabled=true' : '' }}>
                                            <i class="fas fa-angle-double-right"></i>
                                        </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Stats Cards (Optional - you can add this if you have product statistics) -->
            @if($products->count() > 0)
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-boxes text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Products</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $products->total() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Avg Price</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                Rp {{ number_format($products->avg('price'), 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-tags text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Categories</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $products->groupBy('category_id')->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add any additional JavaScript functionality here
            console.log('Product Management Dashboard loaded');
        });
    </script>
</body>

</html>