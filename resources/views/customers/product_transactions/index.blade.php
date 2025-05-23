<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Transactions | Klinik Anggrek</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .filter-to-primary {
            filter: invert(48%) sepia(79%) saturate(2476%) hue-rotate(225deg) brightness(100%) contrast(93%);
        }

        .filter-to-grey {
            filter: invert(74%) sepia(6%) saturate(0%) hue-rotate(180deg) brightness(91%) contrast(87%);
        }

        .stretched-link::after {
            content: "";
            @apply absolute inset-0 z-10;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-purple-50 min-h-screen flex flex-col">
    <!-- Mobile Navigation -->
    <nav class="md:hidden fixed top-0 left-0 right-0 z-50 bg-white shadow-lg px-4 py-3 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <img src="{{ asset('assets/svgs/logo-mark.svg') }}" class="h-6" alt="Klinik Anggrek">
            <span class="text-lg font-bold text-blue-500">Klinik Anggrek</span>
        </div>

        <div class="flex items-center gap-3">
            <button type="button" class="p-1.5 bg-blue-100 rounded-full hover:bg-blue-200 transition-colors">
                <span class="relative">
                    <img src="{{ asset('assets/svgs/ic-notification.svg') }}" class="size-4 filter-to-primary" alt="">
                    <span class="block rounded-full size-1.5 bg-pink-500 absolute top-0 right-0 -translate-x-1/2"></span>
                </span>
            </button>
            <button type="button" class="p-1.5 bg-blue-100 rounded-full hover:bg-blue-200 transition-colors">
                <img src="{{ asset('assets/svgs/ic-shopping-bag.svg') }}" class="size-4 filter-to-primary" alt="">
            </button>

            <!-- User Dropdown -->
            <div class="flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-2 py-1 border border-transparent text-sm leading-4 font-medium rounded-xl text-gray-700 bg-blue-100 hover:bg-blue-200 focus:outline-none transition ease-in-out duration-150">
                            <div class="truncate max-w-[80px]">{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-blue-500 hover:bg-blue-50">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-pink-500 hover:bg-pink-50">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </nav>

    <!-- Desktop Navigation -->
    <nav class="hidden md:flex fixed top-0 left-0 right-0 z-50 bg-white shadow-lg items-center justify-between px-8 py-4">
        <div class="flex items-center gap-2">
            <img src="{{ asset('assets/svgs/logo-mark.svg') }}" class="h-8" alt="Klinik Anggrek">
            <span class="text-xl font-bold text-blue-500">Klinik Anggrek</span>
        </div>

        <div class="flex-1 max-w-xl mx-10">
            <form action="{{ route('customers.transaction.page') }}" method="GET">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ $currentSearch ?? '' }}"
                        class="block w-full py-2.5 pl-12 pr-4 rounded-xl font-medium placeholder:text-gray-400 placeholder:font-normal text-gray-700 text-base bg-blue-50 focus:ring-2 focus:ring-blue-300 focus:outline-none transition-all"
                        placeholder="Cari transaksi...">
                </div>
            </form>
        </div>

        <div class="flex items-center gap-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('customers.dashboard.page.index') }}" class="text-gray-600 hover:text-blue-500 transition-colors font-medium">Home</a>
                <a href="{{ route('customers.transaction.page') }}" class="text-blue-500 transition-colors font-medium">Transaction</a>
                <a href="#" class="text-gray-600 hover:text-blue-500 transition-colors font-medium">Medicines</a>
                <a href="{{ route('customers.dashboard.page.doctors') }}" class="text-gray-600 hover:text-blue-500 transition-colors font-medium">Doctors</a>
                <a href="{{ route('customers.reservation.page') }}" class="text-gray-600 hover:text-blue-500 transition-colors font-medium">Reservation</a>
                <a href="{{ route('customers.dashboard.page.cart') }}" class="text-gray-600 hover:text-blue-500 transition-colors font-medium">Cart</a>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('customers.dashboard.page.cart') }}" class="p-2 bg-blue-100 rounded-full hover:bg-blue-200 transition-colors">
                    <img src="{{ asset('assets/svgs/ic-shopping-bag.svg') }}" class="size-5 filter-to-primary" alt="">
                </a>
                <div class="flex items-center gap-2 ml-2">
                    <div class="flex items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-xl text-gray-700 bg-blue-100 hover:bg-blue-200 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')" class="text-blue-500 hover:bg-blue-50">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-pink-500 hover:bg-pink-50">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-4 py-6 mt-20">
        <div class="grid grid-cols-12 gap-6">
            <!-- Left Sidebar -->
            <div class="col-span-12 md:col-span-2 lg:col-span-2">
                <nav class="bg-white rounded-2xl p-4 shadow-lg sticky top-24">
                    <ul class="flex flex-col gap-2">
                        <li>
                            <a href="{{ route('customers.dashboard.page.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 text-gray-600 font-semibold group">
                                <img src="{{ asset('assets/svgs/ic-grid.svg') }}" class="filter-to-grey group-hover:filter-to-primary" alt="">
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customers.transaction.page') }}" class="flex items-center gap-3 p-3 rounded-xl bg-blue-50 text-blue-500 font-semibold group">
                                <img src="{{ asset('assets/svgs/ic-note.svg') }}" class="filter-to-grey group-hover:filter-to-primary" alt="">
                                <span>Transaction</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customers.dashboard.page.doctors') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 text-gray-600 font-semibold group">
                                <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="filter-to-grey group-hover:filter-to-primary" alt="">
                                <span>Doctors</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customers.reservation.page') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 text-gray-600 font-semibold group">
                                <img src="{{ asset('assets/svgs/ic-note.svg') }}" class="filter-to-grey group-hover:filter-to-primary" alt="">
                                <span>Reservation</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 text-gray-600 font-semibold group">
                                <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="filter-to-grey group-hover:filter-to-primary" alt="">
                                <span>Profile</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-span-12 md:col-span-10 lg:col-span-10">
                <!-- Header Section -->
                <section class="mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <h2 class="text-3xl font-extrabold text-gray-600">
                            Daftar <span class="text-blue-500">Transaksi Saya</span>
                        </h2>
                    </div>
                </section>

                @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-xl shadow">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Transactions Content -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6">
                        <!-- Filter and Search Section -->
                        <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <!-- Search Bar for Mobile -->
                            <div class="relative w-full md:hidden">
                                <form action="{{ route('customers.transaction.page') }}" method="GET">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" name="search" value="{{ $currentSearch ?? '' }}" placeholder="Cari transaksi..."
                                            class="block w-full py-3 pl-12 pr-4 rounded-xl font-semibold placeholder:text-gray-400 placeholder:font-normal text-gray-700 text-base bg-blue-50 focus:ring-2 focus:ring-blue-300 focus:outline-none transition-all">
                                    </div>
                                </form>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-3 w-full">
                                <!-- Date Sorting -->
                                <div class="relative">
                                    <select id="sort-select" class="bg-white border rounded-lg px-3 py-2 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="newest" {{ ($currentSort ?? '') === 'newest' ? 'selected' : '' }}>Terbaru</option>
                                        <option value="oldest" {{ ($currentSort ?? '') === 'oldest' ? 'selected' : '' }}>Terlama</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Status Filter -->
                                <div class="relative">
                                    <select id="status-filter" class="bg-white border rounded-lg px-3 py-2 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Semua Status</option>
                                        <option value="paid" {{ ($currentStatus ?? '') === 'paid' ? 'selected' : '' }}>Berhasil</option>
                                        <option value="pending" {{ ($currentStatus ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Apply Button -->
                                <button id="apply-filters" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                                    Terapkan
                                </button>
                            </div>
                        </div>

                        @if($product_transactions->isEmpty())
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <h3 class="mt-6 text-lg font-medium text-gray-900">Belum ada transaksi</h3>
                            <p class="mt-2 text-sm text-gray-500">Anda belum melakukan transaksi apapun.</p>
                            <div class="mt-6">
                                <a href="{{ route('customers.dashboard.page.index') }}" class="inline-flex items-center px-6 py-2.5 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                    Belanja Sekarang
                                </a>
                            </div>
                        </div>
                        @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Transaksi</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($product_transactions as $transaction)
                                    <tr class="hover:bg-blue-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-500">
                                            #{{ $transaction->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $transaction->created_at->translatedFormat('d F Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($transaction->is_paid)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Berhasil
                                            </span>
                                            @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('customers.transaction.details', $transaction) }}" class="text-blue-500 hover:text-blue-700">Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($product_transactions->hasPages() && $product_transactions->lastPage() > 1)
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

                            // Determine the range of pages to show
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($lastPage, $currentPage + 2);

                            // Adjust if we're near the start or end
                            if ($currentPage <= 3) {
                                $endPage=min(5, $lastPage);
                                } elseif ($currentPage>= $lastPage - 2) {
                                $startPage = max($lastPage - 4, 1);
                                }
                                @endphp

                                {{-- Show first page and ellipsis if needed --}}
                                @if($startPage > 1)
                                <a href="{{ $product_transactions->url(1) }}"
                                    class="px-3 py-1 rounded-md {{ 1 == $currentPage ? 'bg-blue-700 text-white' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                                    1
                                </a>
                                @if($startPage > 2)
                                <span class="px-3 py-1">...</span>
                                @endif
                                @endif

                                {{-- Page numbers --}}
                                @for ($i = $startPage; $i <= $endPage; $i++)
                                    <a href="{{ $product_transactions->url($i) }}"
                                    class="px-3 py-1 rounded-md {{ $i == $currentPage ? 'bg-blue-700 text-white' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                                    {{ $i }}
                                    </a>
                                    @endfor

                                    {{-- Show last page and ellipsis if needed --}}
                                    @if($endPage < $lastPage)
                                        @if($endPage < $lastPage - 1)
                                        <span class="px-3 py-1">...</span>
                                        @endif
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <p class="font-semibold text-blue-500">© 2025 Klinik Anggrek. All rights reserved.</p>
                </div>
                <div class="flex gap-6">
                    <a href="#" class="text-gray-600 hover:text-blue-500 transition">Terms</a>
                    <a href="#" class="text-gray-600 hover:text-blue-500 transition">Privacy</a>
                    <a href="#" class="text-gray-600 hover:text-blue-500 transition">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortSelect = document.getElementById('sort-select');
            const statusFilter = document.getElementById('status-filter');
            const applyButton = document.getElementById('apply-filters');

            function applyFilters() {
                const url = new URL(window.location.href);
                const params = new URLSearchParams(url.search);

                // Update sort parameter
                if (sortSelect.value) {
                    params.set('sort', sortSelect.value);
                } else {
                    params.delete('sort');
                }

                // Update status parameter
                if (statusFilter.value) {
                    params.set('status', statusFilter.value);
                } else {
                    params.delete('status');
                }

                // Always reset to first page when changing filters
                params.delete('page');

                window.location.href = `${url.pathname}?${params.toString()}`;
            }

            // Apply filters when button clicked
            applyButton.addEventListener('click', applyFilters);

            // Auto submit when enter pressed in search
            const searchInputs = document.querySelectorAll('input[name="search"]');
            searchInputs.forEach(input => {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        applyFilters();
                    }
                });
            });
        });
    </script>
</body>

</html>