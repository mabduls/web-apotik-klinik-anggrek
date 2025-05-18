<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Reservasi | Klinik Anggrek</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .filter-to-primary {
            filter: invert(48%) sepia(79%) saturate(2476%) hue-rotate(225deg) brightness(100%) contrast(93%);
        }

        .filter-to-grey {
            filter: invert(74%) sepia(6%) saturate(0%) hue-rotate(180deg) brightness(91%) contrast(87%);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-purple-50 min-h-screen">
    <div class="min-h-screen">
        <!-- Header/Navigation -->
        <header class="bg-white shadow-lg">
            <div class="container mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('customers.dashboard.page.index') }}" class="flex items-center text-blue-500 hover:text-blue-600 transition">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-lg font-medium">Kembali ke Dashboard</span>
                    </a>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Reservasi Saya</h1>
                <a href="{{ route('customers.reservation.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                    Buat Reservasi Baru
                </a>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-6 py-8">
            @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
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

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <!-- Filter and Search Section -->
                    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <!-- Search Bar -->
                        <div class="relative w-full sm:w-64">
                            <form action="{{ route('customers.reservation.page') }}" method="GET">
                                <input type="text" name="search" value="{{ $currentSearch }}" placeholder="Cari reservasi..."
                                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <div class="absolute left-3 top-2.5 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </form>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <!-- Date Sorting -->
                            <div class="relative">
                                <select id="sort-select" class="bg-white border rounded-lg px-3 py-2 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="newest" {{ $currentSort === 'newest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="oldest" {{ $currentSort === 'oldest' ? 'selected' : '' }}>Terlama</option>
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
                                    <option value="disetujui" {{ $currentStatus === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="menunggu" {{ $currentStatus === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
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

                    @if($reservations->isEmpty())
                    <div class="text-center py-12">
                        <h3 class="mt-6 text-lg font-medium text-gray-900">Belum ada reservasi</h3>
                        <p class="mt-2 text-sm text-gray-500">Anda belum membuat reservasi apapun. Mulai buat reservasi pertama Anda.</p>
                        <div class="mt-6">
                            <a href="{{ route('customers.reservation.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Buat Reservasi Baru
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Reservasi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasien</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($reservations as $reservation)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-500">
                                        #{{ $reservation->nomor_reservasi }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($reservation->tanggal_reservasi)->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $reservation->jam_reservasi }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $reservation->nama_pasien }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                        $statusClasses = [
                                        'menunggu' => 'bg-yellow-100 text-yellow-800',
                                        'disetujui' => 'bg-green-100 text-green-800',
                                        ];
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClasses[$reservation->status] }}">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('customers.reservation.details', $reservation) }}" class="text-blue-500 hover:text-blue-700">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($reservations->hasPages())
                    <div class="mt-6 flex justify-center items-center space-x-2">
                        {{-- Previous Page Link --}}
                        <a href="{{ $reservations->previousPageUrl() }}"
                            class="px-3 py-1 rounded-md bg-blue-500 text-white {{ $reservations->onFirstPage() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}">
                            &lt;
                        </a>

                        {{-- Pagination Numbers --}}
                        @php
                        $currentPage = $reservations->currentPage();
                        $lastPage = $reservations->lastPage();
                        $startPage = max(1, min($currentPage - 2, $lastPage - 4));
                        $endPage = min($startPage + 4, $lastPage);
                        @endphp

                        @for ($i = $startPage; $i <= $endPage; $i++)
                            <a href="{{ $reservations->url($i) }}"
                            class="px-3 py-1 rounded-md {{ $i == $currentPage ? 'bg-blue-700 text-white' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                            {{ $i }}
                            </a>
                            @endfor

                            {{-- Next Page Link --}}
                            <a href="{{ $reservations->nextPageUrl() }}"
                                class="px-3 py-1 rounded-md bg-blue-500 text-white {{ !$reservations->hasMorePages() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}">
                                &gt;
                            </a>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortSelect = document.getElementById('sort-select');
            const statusFilter = document.getElementById('status-filter');
            const applyButton = document.getElementById('apply-filters');

            function applyFilters() {
                const sortValue = sortSelect.value;
                const statusValue = statusFilter.value;
                const searchValue = '{{ $currentSearch }}';

                const url = new URL(window.location.href);
                const params = new URLSearchParams(url.search);

                if (sortValue) params.set('sort', sortValue);
                else params.delete('sort');

                if (statusValue) params.set('status', statusValue);
                else params.delete('status');

                if (searchValue) params.set('search', searchValue);

                params.delete('page');

                window.location.href = `${url.pathname}?${params.toString()}`;
            }

            applyButton.addEventListener('click', applyFilters);

            // Auto submit search form when typing (with debounce)
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                let searchTimeout;

                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        this.form.submit();
                    }, 500);
                });
            }
        });
    </script>
</body>

</html>