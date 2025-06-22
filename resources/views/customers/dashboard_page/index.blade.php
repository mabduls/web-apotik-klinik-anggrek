<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Klinik Anggrek</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
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

        <!-- Menu navigasi dipindah ke tengah -->
        <div class="absolute left-1/2 transform -translate-x-1/2">
            <div class="flex items-center gap-4">
                <a href="#" class="text-blue-500 transition-colors font-medium">Home</a>
                <a href="{{ route('customers.transaction.page') }}" class="text-gray-600 hover:text-blue-500 transition-colors font-medium">Transaction</a>
                <a href="#" class="text-gray-600 hover:text-blue-500 transition-colors font-medium">Medicines</a>
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
                            <a href="customers.dashboard.page.index" class="flex items-center gap-3 p-3 rounded-xl bg-blue-50 text-blue-500 font-semibold group">
                                <img src="{{ asset('assets/svgs/ic-grid.svg') }}" class="filter-to-primary" alt="">
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
                            <a href="#" class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 text-gray-600 font-semibold group">
                                <img src="{{ asset('assets/svgs/ic-medicine.svg') }}" class="w-7 h-7 group-hover:filter-to-primary" alt="">
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
            <div class="col-span-12 md:col-span-10 lg:col-span-7">
                <!-- Welcome Section -->
                <section class="mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <h2 class="text-3xl font-extrabold text-gray-800">
                            We Provide <span class="text-blue-500">Best Medicines</span>
                        </h2>
                        <!-- Mobile Search -->
                        <form action="" method="POST" id="mobileSearchForm" class="w-full md:hidden">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="search"
                                    class="block w-full py-3 pl-12 pr-4 rounded-xl font-semibold placeholder:text-gray-400 placeholder:font-normal text-gray-700 text-base bg-blue-50 focus:ring-2 focus:ring-blue-300 focus:outline-none transition-all"
                                    placeholder="Search by product name">
                            </div>
                        </form>
                    </div>
                </section>

                <!-- Order Status Banner -->
                <section class="mb-6">
                    <div class="flex justify-between gap-5 items-center bg-gradient-to-r from-blue-200 to-purple-200 py-5 px-6 rounded-2xl">
                        <div>
                            <p class="text-lg font-bold text-gray-800">
                                Your last order has <br>
                                been processed
                            </p>
                            <button class="mt-3 px-4 py-1.5 bg-white text-blue-500 rounded-full text-sm font-semibold hover:shadow-md transition">
                                Track Order
                            </button>
                        </div>
                        <img src="{{ asset('assets/svgs/nekodicine.svg') }}" class="w-[120px] h-[90px]" alt="">
                    </div>
                </section>

                <!-- Categories -->
                <section class="mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">
                        Categories
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @forelse($categories as $category)
                        <div class="flex items-center gap-3 py-4 px-4 bg-white rounded-xl hover:shadow-md transition">
                            <img src="{{ Storage::url($category->icon) }}" class="size-10" alt="">
                            <a href="#" class="text-base font-semibold truncate stretched-link">
                                {{ $category->name }}
                            </a>
                        </div>
                        @empty
                        <p class="text-base font-semibold text-center col-span-4 text-gray-600">
                            No categories found
                        </p>
                        @endforelse
                    </div>
                </section>

                <!-- Latest Products -->
                <section class="mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">
                        Latest Products
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @forelse($products as $product)
                        <a href="{{ route('customers.dashboard.page.details', $product->slug) }}" class="rounded-2xl bg-white p-4 flex flex-col gap-4 hover:shadow-md transition cursor-pointer block">
                            <div class="h-[140px] flex items-center justify-center">
                                <img src="{{ Storage::url($product->photo) }}" class="h-full object-contain" alt="">
                            </div>
                            <div>
                                <p class="text-base font-semibold line-clamp-2 text-gray-800">
                                    {{ $product->name }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </a>
                        @empty
                        <p class="text-base font-semibold text-center col-span-3 text-gray-600">
                            No products found
                        </p>
                        @endforelse
                    </div>
                </section>
                <!-- Most Purchased -->
                <!-- tampilkan disini -->
            </div>

            <!-- Right Sidebar -->
            <div class="col-span-12 lg:col-span-3">
                <!-- Doctor Explore Card -->
                <div class="bg-gradient-to-r from-blue-100 to-purple-100 p-6 rounded-2xl relative overflow-hidden mb-6">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-200 rounded-full -mr-10 -mt-10 opacity-20"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-purple-200 rounded-full -ml-10 -mb-10 opacity-20"></div>

                    <img src="{{ asset('assets/svgs/cloud.svg') }}" class="mb-2 w-12" alt="">
                    <div class="flex flex-col gap-4 mb-8 relative z-10">
                        <p class="text-lg font-bold text-gray-800">
                            Explore great doctors <br>
                            for your better life
                        </p>
                        <a href="#"
                            class="rounded-full bg-white text-blue-500 flex w-max gap-2.5 px-6 py-2 justify-center items-center text-base font-bold hover:shadow-md transition">
                            Explore
                        </a>
                    </div>
                    <img src="{{ asset('assets/svgs/doctor-help.svg') }}" class="w-full h-32 object-contain relative z-10" alt="">
                </div>

                <!-- Recently Viewed -->
                <div class="bg-white rounded-2xl p-5 shadow-lg">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Recently Viewed</h3>
                    <div class="flex flex-col gap-4">
                        @foreach([1, 2] as $item)
                        <div class="flex gap-3 items-center p-2 hover:bg-blue-50 rounded-lg transition">
                            <img src="{{ asset('assets/images/product-'.$item.'.webp') }}" class="w-12 h-12 object-contain" alt="">
                            <div>
                                <p class="font-semibold text-sm text-gray-800">{{ ['Softovac Rami', 'Enoki Softovac'][$item-1] }}</p>
                                <p class="text-xs text-gray-500">{{ ['Viewed 2 hours ago', 'Viewed yesterday'][$item-1] }}</p>
                            </div>
                        </div>
                        @endforeach
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
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="{{ asset('scripts/searchProductListener.js') }}" type="module"></script>
</body>

</html>