<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors | Klinik Anggrek</title>
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

        .doctor-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-purple-50">
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
                <a href="{{ route('customers.reservation.page') }}" class="text-gray-600 hover:text-blue-500 transition-colors font-medium">Transaction</a>
                <a href="#" class="text-gray-600 hover:text-blue-500 transition-colors font-medium">Medicines</a>
                <a href="{{ route('customers.dashboard.page.doctors') }}" class="text-blue-500 transition-colors font-medium">Doctors</a>
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
                            <a href="#" class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 text-gray-600 font-semibold group">
                                <img src="{{ asset('assets/svgs/ic-medicine.svg') }}" class="w-7 h-7 group-hover:filter-to-primary" alt="">
                                <span>Medicine</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customers.dashboard.page.doctors') }}" class="flex items-center gap-3 p-3 rounded-xl bg-blue-50 text-blue-500 font-semibold group">
                                <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="filter-to-primary" alt="">
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
                <!-- Header Section -->
                <section class="mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <h2 class="text-3xl font-extrabold text-gray-800">
                            Our <span class="text-blue-500">Expert Doctors</span>
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
                                    placeholder="Search doctors by name or specialty">
                            </div>
                        </form>
                    </div>
                </section>

                <!-- Introduction Banner -->
                <section class="mb-6">
                    <div class="flex justify-between gap-5 items-center bg-gradient-to-r from-blue-200 to-purple-200 py-5 px-6 rounded-2xl">
                        <div>
                            <p class="text-lg font-bold text-gray-800">
                                Find the right doctor <br>
                                for your health needs
                            </p>
                            <p class="mt-2 mb-3 text-gray-600">
                                Schedule appointments with our highly qualified professionals
                            </p>
                            <a href="{{ route('customers.reservation.create') }}" class="mt-5 px-4 py-1.5 bg-white text-blue-500 rounded-full text-sm font-semibold hover:shadow-md transition">
                                Book Now
                            </a>
                        </div>
                        <img src="{{ asset('assets/svgs/doctor-help.svg') }}" class="w-[120px] h-[90px]" alt="">
                    </div>
                </section>

                <!-- Doctor Specialties -->
                <section class="mb-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">
                        Specialties
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gradient-to-r from-blue-100 to-blue-200 rounded-xl p-5 cursor-pointer hover:shadow-md transition">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="bg-white p-2 rounded-full">
                                    <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="size-8 filter-to-primary" alt="">
                                </div>
                                <h4 class="font-bold text-gray-800 text-lg">General Practitioners</h4>
                            </div>
                            <p class="text-gray-600">Our general practitioners provide comprehensive healthcare for patients of all ages.</p>
                            <div class="flex justify-end mt-3">
                                <span class="inline-block bg-white text-blue-500 px-3 py-1 rounded-full text-sm font-semibold">5 doctors</span>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-purple-100 to-purple-200 rounded-xl p-5 cursor-pointer hover:shadow-md transition">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="bg-white p-2 rounded-full">
                                    <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="size-8 filter-to-primary" alt="">
                                </div>
                                <h4 class="font-bold text-gray-800 text-lg">Dentists</h4>
                            </div>
                            <p class="text-gray-600">Our dentists provide preventive care, treatments, and oral health guidance.</p>
                            <div class="flex justify-end mt-3">
                                <span class="inline-block bg-white text-blue-500 px-3 py-1 rounded-full text-sm font-semibold">3 doctors</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- General Practitioners Section -->
                <section class="mb-10">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">
                            General Practitioners
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Doctor Card 1 -->
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg doctor-card transition-all duration-300">
                            <div class="bg-gradient-to-r from-blue-100 to-blue-200 h-40 relative flex justify-end">
                                <img src="{{ asset('assets/svgs/doctor-male.svg') }}" class="h-full object-contain absolute bottom-0 right-4" alt="Dr. Andi Pratama">
                            </div>
                            <div class="p-5">
                                <h4 class="text-xl font-bold text-gray-800 mb-1">Dr. Andi Pratama</h4>
                                <p class="text-blue-500 font-medium mb-3">General Practitioner</p>
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="bg-blue-50 p-2 rounded-full">
                                        <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="size-5 filter-to-primary" alt="">
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Education</p>
                                        <p class="font-semibold text-gray-800">Medical Doctor, University of Indonesia</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="bg-blue-50 p-2 rounded-full">
                                        <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="size-5 filter-to-primary" alt="">
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Experience</p>
                                        <p class="font-semibold text-gray-800">8+ years</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Doctor Card 2 -->
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg doctor-card transition-all duration-300">
                            <div class="bg-gradient-to-r from-blue-100 to-blue-200 h-40 relative flex justify-end">
                                <img src="{{ asset('assets/svgs/doctor-female.svg') }}" class="h-full object-contain absolute bottom-0 right-4" alt="Dr. Siti Rahma">
                            </div>
                            <div class="p-5">
                                <h4 class="text-xl font-bold text-gray-800 mb-1">Dr. Siti Rahma</h4>
                                <p class="text-blue-500 font-medium mb-3">General Practitioner</p>
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="bg-blue-50 p-2 rounded-full">
                                        <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="size-5 filter-to-primary" alt="">
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Education</p>
                                        <p class="font-semibold text-gray-800">Medical Doctor, Gadjah Mada University</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="bg-blue-50 p-2 rounded-full">
                                        <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="size-5 filter-to-primary" alt="">
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Experience</p>
                                        <p class="font-semibold text-gray-800">10+ years</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Dentists Section -->
                <section class="mb-10">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">
                            Dentists
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Doctor Card 1 -->
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg doctor-card transition-all duration-300">
                            <div class="bg-gradient-to-r from-purple-100 to-purple-200 h-40 relative flex justify-end">
                                <img src="{{ asset('assets/svgs/doctor-male.svg') }}" class="h-full object-contain absolute bottom-0 right-4" alt="Dr. Budi Santoso">
                            </div>
                            <div class="p-5">
                                <h4 class="text-xl font-bold text-gray-800 mb-1">Dr. Budi Santoso</h4>
                                <p class="text-blue-500 font-medium mb-3">Dentist</p>
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="bg-blue-50 p-2 rounded-full">
                                        <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="size-5 filter-to-primary" alt="">
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Education</p>
                                        <p class="font-semibold text-gray-800">Dental Surgery, Airlangga University</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="bg-blue-50 p-2 rounded-full">
                                        <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="size-5 filter-to-primary" alt="">
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Experience</p>
                                        <p class="font-semibold text-gray-800">6+ years</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Doctor Card 2 -->
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg doctor-card transition-all duration-300">
                            <div class="bg-gradient-to-r from-purple-100 to-purple-200 h-40 relative flex justify-end">
                                <img src="{{ asset('assets/svgs/doctor-female.svg') }}" class="h-full object-contain absolute bottom-0 right-4" alt="Dr. Maya Putri">
                            </div>
                            <div class="p-5">
                                <h4 class="text-xl font-bold text-gray-800 mb-1">Dr. Maya Putri</h4>
                                <p class="text-blue-500 font-medium mb-3">Dentist</p>
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="bg-blue-50 p-2 rounded-full">
                                        <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="size-5 filter-to-primary" alt="">
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Education</p>
                                        <p class="font-semibold text-gray-800">Dental Medicine, Padjadjaran University</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="bg-blue-50 p-2 rounded-full">
                                        <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="size-5 filter-to-primary" alt="">
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Experience</p>
                                        <p class="font-semibold text-gray-800">9+ years</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Doctor Card 3 -->
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg doctor-card transition-all duration-300">
                            <div class="bg-gradient-to-r from-purple-100 to-purple-200 h-40 relative flex justify-end">
                                <img src="{{ asset('assets/svgs/doctor-male.svg') }}" class="h-full object-contain absolute bottom-0 right-4" alt="Dr. Agus Wijaya">
                            </div>
                            <div class="p-5">
                                <h4 class="text-xl font-bold text-gray-800 mb-1">Dr. Agus Wijaya</h4>
                                <p class="text-blue-500 font-medium mb-3">Dentist - Orthodontist</p>
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="bg-blue-50 p-2 rounded-full">
                                        <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="size-5 filter-to-primary" alt="">
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Education</p>
                                        <p class="font-semibold text-gray-800">Orthodontics Specialist, Indonesia University</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="bg-blue-50 p-2 rounded-full">
                                        <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="size-5 filter-to-primary" alt="">
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Experience</p>
                                        <p class="font-semibold text-gray-800">7+ years</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Right Sidebar -->
            <div class="col-span-12 lg:col-span-3">
                <!-- Appointment Card -->
                <div class="bg-white rounded-2xl p-6 shadow-lg mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Your Appointments</h3>
                    @if($reservations->isEmpty())
                    <div class="bg-blue-50 rounded-xl p-4 text-center">
                        <p class="text-gray-600">You don't have any upcoming appointments.</p>
                        <a href="{{ route('customers.reservation.create') }}" class="mt-3 inline-block text-blue-500 text-sm font-semibold hover:text-blue-600 transition">Book Now</a>
                    </div>
                    @else
                    <div class="flex flex-col gap-4">
                        @foreach($reservations as $reservation)
                        <div class="bg-blue-50 rounded-xl p-4">
                            <div class="flex items-center gap-3 mb-3">
                                <div>
                                    <p class="font-semibold text-gray-800">Reservation #{{ $reservation->nomor_reservasi }}</p>
                                    <p class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($reservation->tanggal_reservasi)->format('l, F j, Y') }},
                                        {{ \Carbon\Carbon::parse($reservation->jam_reservasi)->format('g:i A') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-end mt-3">
                                <a href="{{ route('customers.reservation.details', $reservation) }}" class="text-blue-500 text-sm font-semibold hover:text-blue-600 transition">View Details</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('customers.reservation.page') }}" class="w-full block text-center bg-gradient-to-r from-blue-400 to-purple-400 text-white font-semibold py-3 rounded-xl hover:from-blue-500 hover:to-purple-500 transition shadow-md">
                            Your Reservation
                        </a>
                    </div>
                </div>

                <!-- Health Tips -->
                <div class="bg-white rounded-2xl p-5 shadow-lg mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Health Tips</h3>
                    <div class="flex flex-col gap-4">
                        <div class="flex gap-3 items-start p-3 hover:bg-blue-50 rounded-lg transition">
                            <img src="{{ asset('assets/svgs/ic-lightning.svg') }}" class="w-6 h-6 filter-to-primary mt-1" alt="">
                            <div>
                                <p class="font-semibold text-sm text-gray-800">Stay Hydrated</p>
                                <p class="text-xs text-gray-500">Drink at least 8 glasses of water daily for better health</p>
                            </div>
                        </div>
                        <div class="flex gap-3 items-start p-3 hover:bg-blue-50 rounded-lg transition">
                            <img src="{{ asset('assets/svgs/ic-walking.svg') }}" class="w-6 h-6 filter-to-primary mt-1" alt="">
                            <div>
                                <p class="font-semibold text-sm text-gray-800">Daily Exercise</p>
                                <p class="text-xs text-gray-500">30 minutes of walking can improve cardiovascular health</p>
                            </div>
                        </div>
                        <div class="flex gap-3 items-start p-3 hover:bg-blue-50 rounded-lg transition">
                            <img src="{{ asset('assets/svgs/ic-sleep.svg') }}" class="w-6 h-6 filter-to-primary mt-1" alt="">
                            <div>
                                <p class="font-semibold text-sm text-gray-800">Quality Sleep</p>
                                <p class="text-xs text-gray-500">Aim for 7-9 hours of sleep for optimal health</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="bg-gradient-to-r from-pink-100 to-red-100 rounded-2xl p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('assets/svgs/ic-emergency.svg') }}" class="w-8 h-8 filter-to-primary" alt="">
                        <h3 class="text-lg font-bold text-gray-800">Emergency Contact</h3>
                    </div>
                    <p class="text-gray-600 mb-4">
                        For urgent medical assistance outside clinic hours, please contact our emergency line.
                    </p>
                    <div class="bg-white rounded-xl p-4 flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-800">Emergency Call</p>
                            <p class="text-blue-500 font-bold">112</p>
                        </div>
                        <a href="tel:112" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition">
                            <img src="{{ asset('assets/svgs/ic-call.svg') }}" class="w-5 h-5 filter-to-white" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-6 mt-8">
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
    <script>
        // Doctor search functionality
        $(document).ready(function() {
            $('#desktopSearchDoctor, #mobileSearchForm input').on('keyup', function() {
                const searchTerm = $(this).val().toLowerCase();
                $('.doctor-card').each(function() {
                    const doctorName = $(this).find('h4').text().toLowerCase();
                    const doctorSpecialty = $(this).find('p:first').text().toLowerCase();

                    if (doctorName.includes(searchTerm) || doctorSpecialty.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
</body>

</html>