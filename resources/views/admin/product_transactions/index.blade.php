<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Transaction</title>
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
                    {{ Auth::user()->hasRole('owner') ? __('Pharmacy Orders') : __('My Transaction') }}
                </h2>
                <div class="flex flex-col sm:flex-row gap-3">
                    <!-- Date Sorting -->
                    <div class="relative">
                        <select id="sort-select" class="bg-gray-700 text-white rounded-md px-3 py-2 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="newest" {{ $currentSort === 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="oldest" {{ $currentSort === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="relative">
                        <select id="status-filter" class="bg-gray-700 text-white rounded-md px-3 py-2 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="">All Statuses</option>
                            <option value="success" {{ $currentStatus === 'success' ? 'selected' : '' }}>Success Only</option>
                            <option value="pending" {{ $currentStatus === 'pending' ? 'selected' : '' }}>Pending Only</option>
                            <option value="cancelled" {{ $currentStatus === 'cancelled' ? 'selected' : '' }}>Cancelled Only</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Apply Button -->
                    <button id="apply-filters" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md transition">
                        Apply
                    </button>
                </div>
            </div>
            <div class="flex flex-col gap-y-5 dark:bg-gray-800 p-10 overflow-hidden shadow-sm sm:rounded-lg">
                @forelse($product_transactions as $transaction)
                <div class="item-card grid grid-cols-12 items-center text-white">
                    <div class="col-span-2">
                        <p class="text-base dark:text-white">
                            No. Resi
                        </p>
                        <h3 class="text-gray-900 dark:text-gray-100 font-bold text-lg">
                            {{ $transaction->tracking_number ?? '-' }}
                        </h3>
                    </div>
                    <div class="col-span-2">
                        <p class="text-base dark:text-white">
                            Customer
                        </p>
                        <h3 class="text-gray-900 dark:text-gray-100 font-bold text-xl">
                            {{ $transaction->user->name }}
                        </h3>
                    </div>
                    <div class="col-span-2">
                        <p class="text-base dark:text-white">
                            Total
                        </p>
                        <h3 class="text-gray-900 dark:text-gray-100 font-bold text-xl">
                            Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                        </h3>
                    </div>
                    <div class="col-span-2">
                        <p class="text-base dark:text-white">
                            Date
                        </p>
                        <h3 class="text-gray-900 dark:text-gray-100 font-bold text-xl">
                            {{ $transaction->created_at->format('d M Y') }}
                        </h3>
                    </div>
                    <div class="col-span-2">
                        @if($transaction->is_paid)
                        <div class="inline-flex items-center justify-center">
                            <span class="font-bold py-1 px-4 rounded-full text-white bg-green-500 flex items-center justify-center h-8">
                                <p class="text-white font-bold text-sm leading-none">
                                    SUCCESS
                                </p>
                            </span>
                        </div>
                        @elseif($transaction->status === 'cancelled')
                        <div class="inline-flex items-center justify-center">
                            <span class="font-bold py-1 px-4 rounded-full text-white bg-red-500 flex items-center justify-center h-8">
                                <p class="text-white font-bold text-sm leading-none">
                                    CANCELLED
                                </p>
                            </span>
                        </div>
                        @else
                        <div class="inline-flex items-center justify-center">
                            <span class="font-bold py-1 px-4 rounded-full text-white bg-orange-500 flex items-center justify-center h-8">
                                <p class="text-white font-bold text-sm leading-none">
                                    PENDING
                                </p>
                            </span>
                        </div>
                        @endif
                    </div>
                    <div class="col-span-2 flex justify-end">
                        <a href="{{ route('admin.product_transactions.show', $transaction) }}" class="font-bold py-2 px-6 rounded-full text-white bg-gray-700 hover:bg-gray-600 transition">
                            View Detail
                        </a>
                    </div>
                </div>
                <hr class="my-3">
                @empty
                <div class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-400">
                    <p class="text-lg font-semibold">No Transactions Found</p>
                    <p class="text-gray-500 dark:text-gray-400">You have not made any transactions yet.</p>
                </div>
                @endforelse
            </div>
            <!-- Pagination -->
            @if($product_transactions->count() > 0 || $product_transactions->hasPages())
            <div class="mt-6 flex justify-center items-center space-x-1">
                {{-- First Page Link --}}
                <a href="{{ $product_transactions->url(1) }}"
                    class="px-3 py-1 rounded-md bg-blue-500 text-white {{ $product_transactions->onFirstPage() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}"
                    title="First Page"
                    {{ $product_transactions->onFirstPage() ? 'disabled' : '' }}>
                    &laquo;
                </a>

                {{-- Previous Page Link --}}
                <a href="{{ $product_transactions->previousPageUrl() }}"
                    class="px-3 py-1 rounded-md bg-blue-500 text-white {{ $product_transactions->onFirstPage() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}"
                    title="Previous"
                    {{ $product_transactions->onFirstPage() ? 'disabled' : '' }}>
                    &lt;
                </a>

                {{-- Pagination Numbers --}}
                @php
                $currentPage = $product_transactions->currentPage();
                $lastPage = $product_transactions->lastPage();

                // Always show current page and 2 pages before/after
                $startPage = max(1, $currentPage - 2);
                $endPage = min($lastPage, $currentPage + 2);

                // Adjust if near start
                if ($currentPage <= 3) {
                    $endPage=min(5, $lastPage);
                    }

                    // Adjust if near end
                    if ($currentPage>= $lastPage - 2) {
                    $startPage = max($lastPage - 4, 1);
                    }

                    $showStartEllipsis = $startPage > 2;
                    $showEndEllipsis = $endPage < $lastPage - 1;
                        @endphp

                        {{-- Always show first page --}}
                        <a href="{{ $product_transactions->url(1) }}"
                        class="px-3 py-1 rounded-md {{ 1 == $currentPage ? 'bg-blue-700 text-white' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                        1
                        </a>

                        @if($showStartEllipsis)
                        <span class="px-3 py-1 dark:text-gray-300">...</span>
                        @endif

                        {{-- Middle pages --}}
                        @for ($i = $startPage; $i <= $endPage; $i++)
                            @if($i !=1 && $i !=$lastPage) {{-- Skip first/last as we always show them --}}
                            <a href="{{ $product_transactions->url($i) }}"
                            class="px-3 py-1 rounded-md {{ $i == $currentPage ? 'bg-blue-700 text-white' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                            {{ $i }}
                            </a>
                            @endif
                            @endfor

                            @if($showEndEllipsis)
                            <span class="px-3 py-1 dark:text-gray-300">...</span>
                            @endif

                            {{-- Always show last page if different from first --}}
                            @if($lastPage != 1)
                            <a href="{{ $product_transactions->url($lastPage) }}"
                                class="px-3 py-1 rounded-md {{ $lastPage == $currentPage ? 'bg-blue-700 text-white' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                                {{ $lastPage }}
                            </a>
                            @endif

                            {{-- Next Page Link --}}
                            <a href="{{ $product_transactions->nextPageUrl() }}"
                                class="px-3 py-1 rounded-md bg-blue-500 text-white {{ !$product_transactions->hasMorePages() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}"
                                title="Next"
                                {{ !$product_transactions->hasMorePages() ? 'disabled' : '' }}>
                                &gt;
                            </a>

                            {{-- Last Page Link --}}
                            <a href="{{ $product_transactions->url($lastPage) }}"
                                class="px-3 py-1 rounded-md bg-blue-500 text-white {{ $product_transactions->currentPage() == $lastPage ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}"
                                title="Last Page"
                                {{ $product_transactions->currentPage() == $lastPage ? 'disabled' : '' }}>
                                &raquo;
                            </a>
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

                window.location.href = `${url.pathname}?${params.toString()}`;
            }
            applyButton.addEventListener('click', applyFilters);
        });
    </script>
</body>

</html>