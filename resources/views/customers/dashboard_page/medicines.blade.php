<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine | Klinik Anggrek</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
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

        <!-- Menu navigasi dipindah ke tengah -->
        <div class="absolute left-1/2 transform -translate-x-1/2">
            <div class="flex items-center gap-4">
                <a href="{{ route('customers.dashboard.page.index') }}" class="text-gray-600 hover:text-blue-500 transition-colors font-medium">Home</a>
                <a href="{{ route('customers.transaction.page') }}" class="text-gray-600 hover:text-blue-500 transition-colors font-medium">Transaction</a>
                <a href="{{ route('customers.dashboard.page.medicines') }}" class="text-blue-500 transition-colors font-medium">Medicines</a>
                <a href="{{ route('customers.dashboard.page.doctors') }}" class="text-gray-600 hover:text-blue-500 transition-colors font-medium">Doctors</a>
                <a href="{{ route('customers.reservation.page') }}" class="text-gray-600 hover:text-blue-500 transition-colors font-medium">Reservation</a>
                <a href="{{ route('customers.dashboard.page.cart') }}" class="text-gray-600 hover:text-blue-500 transition-colors font-medium">Cart</a>
            </div>
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
    </nav>

    <main class="flex-grow container mx-auto px-4 py-6 mt-16">
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
                            <a href="{{ route('customers.transaction.page') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 text-gray-600 font-semibold group">
                                <img src="{{ asset('assets/svgs/ic-note.svg') }}" class="filter-to-grey group-hover:filter-to-primary" alt="">
                                <span>Transaction</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customers.dashboard.page.medicines') }}" class="flex items-center gap-3 p-3 rounded-xl bg-blue-50 text-blue-500 font-semibold group">
                                <img src="{{ asset('assets/svgs/ic-medicine.svg') }}" class="w-7 h-7 filter-to-primary" alt="">
                                <span>Medicine</span>
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
                        <h2 class="text-3xl font-extrabold text-gray-800">
                            Our <span class="text-blue-500">Medicines</span>
                        </h2>

                        <!-- Search and Filter -->
                        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                            <div class="w-full md:w-64">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" name="search" id="searchInput"
                                        class="block w-full py-3 pl-12 pr-4 rounded-xl font-semibold placeholder:text-gray-400 placeholder:font-normal text-gray-700 text-base bg-blue-50 focus:ring-2 focus:ring-blue-300 focus:outline-none transition-all"
                                        placeholder="Search medicines..." value="{{ request('search') }}">
                                </div>
                            </div>

                            <div class="relative w-full md:w-48">
                                <select id="categoryFilter" class="block w-full py-3 px-4 rounded-xl font-semibold text-gray-700 text-base bg-blue-50 focus:ring-2 focus:ring-blue-300 focus:outline-none appearance-none transition-all">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="h-5 w-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Categories Horizontal Scroll -->
                <section class="mb-6">
                    <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-hide">
                        <button class="category-filter-btn px-4 py-2 rounded-full bg-blue-500 text-white font-semibold whitespace-nowrap" data-category="">
                            All Medicines
                        </button>
                        @foreach($categories as $category)
                        <button class="category-filter-btn px-4 py-2 rounded-full bg-white hover:bg-blue-100 text-gray-700 font-semibold whitespace-nowrap transition-colors" data-category="{{ $category->id }}">
                            {{ $category->name }}
                        </button>
                        @endforeach
                    </div>
                </section>

                <!-- Medicine Grid -->
                <section class="mb-6">
                    <div id="medicineGrid">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($products as $product)
                            <div class="medicine-item bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow"
                                data-name="{{ strtolower($product->name) }}"
                                data-category="{{ $product->category_id }}">
                                <a href="{{ route('customers.dashboard.page.details', $product->slug) }}" class="block">
                                    <div class="h-48 flex items-center justify-center p-4 bg-gray-50">
                                        <img src="{{ Storage::url($product->photo) }}" class="h-full object-contain" alt="{{ $product->name }}">
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-semibold text-gray-800 mb-1 line-clamp-2">{{ $product->name }}</h3>
                                        <div class="flex items-center justify-between mt-3">
                                            <span class="text-blue-500 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            <span class="text-xs px-2 py-1 bg-blue-100 text-blue-600 rounded-full">{{ $product->category->name }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </section>
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
        $(document).ready(function() {
            // Filter function
            function filterMedicines() {
                const searchTerm = $('#searchInput').val().toLowerCase();
                const categoryId = $('#categoryFilter').val();

                $('.medicine-item').each(function() {
                    const itemName = $(this).data('name');
                    const itemCategory = $(this).data('category');

                    const nameMatch = searchTerm === '' || itemName.includes(searchTerm);
                    const categoryMatch = categoryId === '' || itemCategory == categoryId;

                    if (nameMatch && categoryMatch) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            // Category filter buttons
            $('.category-filter-btn').click(function() {
                const categoryId = $(this).data('category');
                $('#categoryFilter').val(categoryId);
                updateActiveButton(categoryId);
                filterMedicines();
            });

            // Category dropdown filter
            $('#categoryFilter').change(function() {
                const categoryId = $(this).val();
                updateActiveButton(categoryId);
                filterMedicines();
            });

            // Search input with live update
            $('#searchInput').on('input', function() {
                filterMedicines();
            });

            function updateActiveButton(categoryId) {
                $('.category-filter-btn').removeClass('bg-blue-500 text-white').addClass('bg-white hover:bg-blue-100 text-gray-700');
                $(`.category-filter-btn[data-category="${categoryId}"]`).removeClass('bg-white hover:bg-blue-100 text-gray-700').addClass('bg-blue-500 text-white');
            }

            // Initialize active filter
            const initialCategory = "{{ request('category') }}";
            if (initialCategory) {
                updateActiveButton(initialCategory);
            }

            // Reset filters function
            window.resetFilters = function() {
                $('#searchInput').val('');
                $('#categoryFilter').val('');
                updateActiveButton('');
                $('.medicine-item').show();
            };
        });
    </script>
</body>

</html>