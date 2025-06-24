<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Reservasi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    @include('layouts.navigation')

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Daftar Reservasi Pasien</h1>

            <!-- Search and Filter Section -->
            <div class="flex flex-col sm:flex-row gap-3">
                <!-- Search Bar -->
                <div class="relative">
                    <form action="{{ route('admin.reservations.index') }}" method="GET">
                        <input type="text" name="search" value="{{ $currentSearch }}" placeholder="Cari reservasi..."
                            class="pl-10 pr-4 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </form>
                </div>

                <!-- Date Sorting -->
                <div class="relative">
                    <select id="sort-select" class="bg-white dark:bg-gray-700 border rounded-lg px-3 py-2 pr-8 appearance-none dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                    <select id="status-filter" class="bg-white dark:bg-gray-700 border rounded-lg px-3 py-2 pr-8 appearance-none dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
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

        @if(session('success'))
        <div class="mb-6 px-4 py-3 rounded-lg bg-green-600 text-white shadow-lg flex justify-between items-center">
            <span>{{ session('success') }}</span>
            <button @click="$el.remove()" class="text-white hover:text-gray-200 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No. Reservasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Pasien</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Reservasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($reservations as $reservation)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-500 dark:text-blue-400">
                                #{{ $reservation->nomor_reservasi }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $reservation->nama_pasien }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ \Carbon\Carbon::parse($reservation->tanggal_reservasi)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $reservation->jam_reservasi }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $reservation->status === 'disetujui' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200' }}">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.reservations.show', $reservation) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-500">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                Tidak ada reservasi ditemukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Results Info and Pagination -->
            <div class="flex flex-col sm:flex-row justify-between items-center px-6 py-4 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                <div class="mb-4 sm:mb-0">
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        Showing <span class="font-medium">{{ $reservations->firstItem() }}</span> to <span class="font-medium">{{ $reservations->lastItem() }}</span> of <span class="font-medium">{{ $reservations->total() }}</span> results
                    </p>
                </div>

                <!-- Pagination -->
                @if($reservations->total() > 0)
                <div class="flex justify-center items-center space-x-1">
                    {{-- First Page Link --}}
                    <a href="{{ $reservations->url(1) }}"
                        class="px-3 py-1 rounded-md bg-blue-500 text-white {{ $reservations->onFirstPage() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}"
                        title="First Page"
                        {{ $reservations->onFirstPage() ? 'disabled' : '' }}>
                        &laquo;
                    </a>

                    {{-- Previous Page Link --}}
                    <a href="{{ $reservations->previousPageUrl() }}"
                        class="px-3 py-1 rounded-md bg-blue-500 text-white {{ $reservations->onFirstPage() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}"
                        title="Previous"
                        {{ $reservations->onFirstPage() ? 'disabled' : '' }}>
                        &lt;
                    </a>

                    {{-- Pagination Numbers --}}
                    @php
                    $currentPage = $reservations->currentPage();
                    $lastPage = $reservations->lastPage();

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
                        <a href="{{ $reservations->url(1) }}"
                            class="px-3 py-1 rounded-md {{ 1 == $currentPage ? 'bg-blue-700 text-white' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                            1
                        </a>
                        @if($startPage > 2)
                        <span class="px-3 py-1">...</span>
                        @endif
                        @endif

                        {{-- Page numbers --}}
                        @for ($i = $startPage; $i <= $endPage; $i++)
                            <a href="{{ $reservations->url($i) }}"
                            class="px-3 py-1 rounded-md {{ $i == $currentPage ? 'bg-blue-700 text-white' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                            {{ $i }}
                            </a>
                            @endfor

                            {{-- Show last page and ellipsis if needed --}}
                            @if($endPage < $lastPage)
                                @if($endPage < $lastPage - 1)
                                <span class="px-3 py-1">...</span>
                                @endif
                                <a href="{{ $reservations->url($lastPage) }}"
                                    class="px-3 py-1 rounded-md {{ $lastPage == $currentPage ? 'bg-blue-700 text-white' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                                    {{ $lastPage }}
                                </a>
                                @endif

                                {{-- Next Page Link --}}
                                <a href="{{ $reservations->nextPageUrl() }}"
                                    class="px-3 py-1 rounded-md bg-blue-500 text-white {{ !$reservations->hasMorePages() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}"
                                    title="Next"
                                    {{ !$reservations->hasMorePages() ? 'disabled' : '' }}>
                                    &gt;
                                </a>

                                {{-- Last Page Link --}}
                                <a href="{{ $reservations->url($lastPage) }}"
                                    class="px-3 py-1 rounded-md bg-blue-500 text-white {{ $reservations->currentPage() == $lastPage ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}"
                                    title="Last Page"
                                    {{ $reservations->currentPage() == $lastPage ? 'disabled' : '' }}>
                                    &raquo;
                                </a>
                </div>
                @endif
            </div>
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