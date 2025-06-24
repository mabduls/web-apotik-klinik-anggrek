<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Orders Dashboard</title>
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
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-pills text-white text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ Auth::user()->hasRole('owner') ? __('Pharmacy Orders') : __('My Transactions') }}
                                </h1>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">
                                    Manage and track all pharmacy orders
                                </p>
                            </div>
                        </div>

                        <!-- Filters Section -->
                        <div class="flex flex-col sm:flex-row gap-3 lg:gap-4">
                            <div class="relative group">
                                <select id="sort-select" class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white rounded-xl px-4 py-3 pr-10 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-300 dark:hover:border-gray-500">
                                    <option value="newest" {{ $currentSort === 'newest' ? 'selected' : '' }}>🕒 Newest First</option>
                                    <option value="oldest" {{ $currentSort === 'oldest' ? 'selected' : '' }}>⏰ Oldest First</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-chevron-down text-sm"></i>
                                </div>
                            </div>

                            <div class="relative group">
                                <select id="status-filter" class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white rounded-xl px-4 py-3 pr-10 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-300 dark:hover:border-gray-500">
                                    <option value="">📋 All Statuses</option>
                                    <option value="success" {{ $currentStatus === 'success' ? 'selected' : '' }}>✅ Success Only</option>
                                    <option value="pending" {{ $currentStatus === 'pending' ? 'selected' : '' }}>⏳ Pending Only</option>
                                    <option value="cancelled" {{ $currentStatus === 'cancelled' ? 'selected' : '' }}>❌ Cancelled Only</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-chevron-down text-sm"></i>
                                </div>
                            </div>

                            <button id="apply-filters" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 transform hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <i class="fas fa-filter mr-2"></i>Apply Filters
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders List -->
            <div class="space-y-4">
                @forelse($product_transactions as $transaction)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700 group">
                    <div class="p-6">
                        <!-- Mobile Layout -->
                        <div class="block lg:hidden space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-receipt text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Tracking Number</p>
                                        <p class="font-bold text-gray-900 dark:text-white">{{ $transaction->tracking_number ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    @if($transaction->is_paid)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        <i class="fas fa-check-circle mr-1"></i>SUCCESS
                                    </span>
                                    @elseif($transaction->status === 'cancelled')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        <i class="fas fa-times-circle mr-1"></i>CANCELLED
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                        <i class="fas fa-clock mr-1"></i>PENDING
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Customer</p>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $transaction->user->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Date</p>
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $transaction->created_at->format('d M Y') }}</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Amount</p>
                                    <p class="text-xl font-bold text-blue-600 dark:text-blue-400">
                                        Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                    </p>
                                </div>
                                <a href="{{ route('admin.product_transactions.show', $transaction) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white rounded-lg font-medium transition-all duration-200 hover:shadow-lg transform hover:scale-105">
                                    <i class="fas fa-eye mr-2"></i>View Details
                                </a>
                            </div>
                        </div>

                        <!-- Desktop Layout -->
                        <div class="hidden lg:grid lg:grid-cols-12 lg:gap-6 lg:items-center">
                            <div class="col-span-2">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-receipt text-white text-sm"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Tracking Number</p>
                                        <p class="font-bold text-gray-900 dark:text-white truncate">{{ $transaction->tracking_number ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Customer</p>
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $transaction->user->name }}</p>
                            </div>

                            <div class="col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Total Amount</p>
                                <p class="text-lg font-bold text-blue-600 dark:text-blue-400">
                                    Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                </p>
                            </div>

                            <div class="col-span-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Order Date</p>
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $transaction->created_at->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $transaction->created_at->format('H:i') }}</p>
                            </div>

                            <div class="col-span-2">
                                @if($transaction->is_paid)
                                <span class="inline-flex items-center px-3 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    <i class="fas fa-check-circle mr-2"></i>SUCCESS
                                </span>
                                @elseif($transaction->status === 'cancelled')
                                <span class="inline-flex items-center px-3 py-2 rounded-full text-sm font-semibold bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                    <i class="fas fa-times-circle mr-2"></i>CANCELLED
                                </span>
                                @else
                                <span class="inline-flex items-center px-3 py-2 rounded-full text-sm font-semibold bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                    <i class="fas fa-clock mr-2"></i>PENDING
                                </span>
                                @endif
                            </div>

                            <div class="col-span-2 flex justify-end">
                                <a href="{{ route('admin.product_transactions.show', $transaction) }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white rounded-xl font-medium transition-all duration-200 hover:shadow-lg transform hover:scale-105 group-hover:shadow-xl">
                                    <i class="fas fa-eye mr-2"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-inbox text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No Transactions Found</h3>
                        <p class="text-gray-500 dark:text-gray-400">
                            {{ Auth::user()->hasRole('owner') ? 'No pharmacy orders have been placed yet.' : 'You haven\'t made any transactions yet.' }}
                        </p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Enhanced Pagination -->
            @if($product_transactions->count() > 0 || $product_transactions->hasPages())
            <div class="mt-8">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            Showing {{ $product_transactions->firstItem() }} to {{ $product_transactions->lastItem() }} of {{ $product_transactions->total() }} results
                        </div>

                        <div class="flex items-center space-x-1">
                            {{-- First Page Link --}}
                            <a href="{{ $product_transactions->url(1) }}"
                                class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $product_transactions->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500' : 'bg-blue-500 text-white hover:bg-blue-600 hover:shadow-md' }}"
                                title="First Page"
                                {{ $product_transactions->onFirstPage() ? 'aria-disabled=true' : '' }}>
                                <i class="fas fa-angle-double-left"></i>
                            </a>

                            {{-- Previous Page Link --}}
                            <a href="{{ $product_transactions->previousPageUrl() }}"
                                class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $product_transactions->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500' : 'bg-blue-500 text-white hover:bg-blue-600 hover:shadow-md' }}"
                                title="Previous"
                                {{ $product_transactions->onFirstPage() ? 'aria-disabled=true' : '' }}>
                                <i class="fas fa-angle-left"></i>
                            </a>

                            {{-- Pagination Numbers --}}
                            @php
                            $currentPage = $product_transactions->currentPage();
                            $lastPage = $product_transactions->lastPage();
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
                                    <a href="{{ $product_transactions->url(1) }}"
                                    class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ 1 == $currentPage ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}">
                                    1
                                    </a>

                                    @if($showStartEllipsis)
                                    <span class="px-2 py-2 text-gray-500 dark:text-gray-400">...</span>
                                    @endif

                                    {{-- Middle pages --}}
                                    @for ($i = $startPage; $i <= $endPage; $i++)
                                        @if($i !=1 && $i !=$lastPage)
                                        <a href="{{ $product_transactions->url($i) }}"
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
                                        <a href="{{ $product_transactions->url($lastPage) }}"
                                            class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $lastPage == $currentPage ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}">
                                            {{ $lastPage }}
                                        </a>
                                        @endif

                                        {{-- Next Page Link --}}
                                        <a href="{{ $product_transactions->nextPageUrl() }}"
                                            class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ !$product_transactions->hasMorePages() ? 'bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500' : 'bg-blue-500 text-white hover:bg-blue-600 hover:shadow-md' }}"
                                            title="Next"
                                            {{ !$product_transactions->hasMorePages() ? 'aria-disabled=true' : '' }}>
                                            <i class="fas fa-angle-right"></i>
                                        </a>

                                        {{-- Last Page Link --}}
                                        <a href="{{ $product_transactions->url($lastPage) }}"
                                            class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $product_transactions->currentPage() == $lastPage ? 'bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500' : 'bg-blue-500 text-white hover:bg-blue-600 hover:shadow-md' }}"
                                            title="Last Page"
                                            {{ $product_transactions->currentPage() == $lastPage ? 'aria-disabled=true' : '' }}>
                                            <i class="fas fa-angle-double-right"></i>
                                        </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortSelect = document.getElementById('sort-select');
            const statusFilter = document.getElementById('status-filter');
            const applyButton = document.getElementById('apply-filters');

            function applyFilters() {
                const sortValue = sortSelect.value;
                const statusValue = statusFilter.value;

                const url = new URL(window.location.href);
                const params = new URLSearchParams(url.search);

                if (sortValue) params.set('sort', sortValue);
                else params.delete('sort');

                if (statusValue) params.set('status', statusValue);
                else params.delete('status');

                params.delete('page');

                // Add loading state
                applyButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';
                applyButton.disabled = true;

                window.location.href = `${url.pathname}?${params.toString()}`;
            }

            applyButton.addEventListener('click', applyFilters);

            // Add keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey && e.key === 'Enter') {
                    applyFilters();
                }
            });
        });
    </script>
</body>

</html>