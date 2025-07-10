<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Rekap Data Pasien</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 font-sans antialiased">
    @include('layouts.navigation')

    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                    <i class="fas fa-clipboard-list text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Rekap Data Pasien</h1>
                    <p class="text-gray-600 dark:text-gray-400">Kelola dan lihat data rekap pasien dengan mudah</p>
                </div>
            </div>
        </div>

        <!-- Main Card -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">

            <!-- Search and Filter Section -->
            <div class="p-6 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                    <!-- Search Bar -->
                    <form method="GET" action="{{ route('admin.reservations.rekap') }}" class="flex-1 max-w-md">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400 text-sm"></i>
                            </div>
                            <input type="text" name="search" value="{{ $currentSearch }}"
                                class="pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg w-full 
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                       focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                       transition-all duration-200 ease-in-out"
                                placeholder="Cari nama pasien atau NIK...">
                        </div>
                    </form>

                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-3">
                        <!-- Search Button -->
                        <button type="submit" form="search-form"
                            class="px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg
                                   transition-all duration-200 ease-in-out transform hover:scale-105
                                   focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                                   shadow-lg hover:shadow-xl">
                            <i class="fas fa-search mr-2"></i>Cari
                        </button>

                        <!-- Reset Button -->
                        @if($currentSearch)
                        <a href="{{ route('admin.reservations.rekap') }}"
                            class="px-4 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-600 dark:hover:bg-gray-500 
                                  text-gray-700 dark:text-gray-200 rounded-lg
                                  transition-all duration-200 ease-in-out
                                  focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <i class="fas fa-times mr-2"></i>Reset
                        </a>
                        @endif

                        <!-- Sort Dropdown -->
                        <form method="GET" action="{{ route('admin.reservations.rekap') }}" class="relative">
                            <input type="hidden" name="search" value="{{ $currentSearch }}">
                            <select name="sort" onchange="this.form.submit()"
                                class="px-4 py-3 pr-8 border border-gray-300 dark:border-gray-600 rounded-lg
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                                       focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                       transition-all duration-200 ease-in-out cursor-pointer">
                                <option value="newest" {{ $currentSort == 'newest' ? 'selected' : '' }}>
                                    <i class="fas fa-sort-numeric-down mr-2"></i>Terbaru
                                </option>
                                <option value="oldest" {{ $currentSort == 'oldest' ? 'selected' : '' }}>
                                    <i class="fas fa-sort-numeric-up mr-2"></i>Terlama
                                </option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-hashtag text-xs"></i>
                                        <span>No</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-ticket-alt text-xs"></i>
                                        <span>No Reservasi</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-user text-xs"></i>
                                        <span>Nama Pasien</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-id-card text-xs"></i>
                                        <span>NIK</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-calendar text-xs"></i>
                                        <span>Tanggal</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-phone text-xs"></i>
                                        <span>No Telepon</span>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    <div class="flex items-center justify-center space-x-1">
                                        <i class="fas fa-cogs text-xs"></i>
                                        <span>Aksi</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($rekaps as $index => $rekap)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full">
                                            {{ $rekaps->firstItem() + $index }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="text-sm font-mono text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900 px-2 py-1 rounded">
                                            #{{ $rekap->reservation->nomor_reservasi }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            <div class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                                                <span class="text-sm font-medium text-white">
                                                    {{ strtoupper(substr($rekap->nama_pasien, 0, 1)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $rekap->nama_pasien }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white font-mono">
                                        {{ $rekap->nik }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                                        <span class="text-sm text-gray-900 dark:text-white">
                                            {{ \Carbon\Carbon::parse($rekap->tanggal_reservasi)->format('d M Y') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-phone text-gray-400 mr-2"></i>
                                        <span class="text-sm text-gray-900 dark:text-white">
                                            {{ $rekap->no_telepon }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('admin.reservations.rekap.details', $rekap) }}"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 
                                            rounded-md transition-all duration-200 ease-in-out transform hover:scale-105
                                            focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                                            shadow-sm hover:shadow-md">
                                        <i class="fas fa-eye mr-2"></i>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-3">
                                        <div class="p-3 bg-gray-100 dark:bg-gray-700 rounded-full">
                                            <i class="fas fa-search text-gray-400 text-2xl"></i>
                                        </div>
                                        <div class="text-lg font-medium text-gray-900 dark:text-white">
                                            Tidak Ada Riwayat Rekam Medis Yang Tersedia
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            Coba ubah filter pencarian atau tambah data baru
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-col sm:flex-row justify-between items-center px-6 py-4 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                    <div class="mb-4 sm:mb-0">
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            Showing <span class="font-medium">{{ $rekaps->firstItem() }}</span> to <span class="font-medium">{{ $rekaps->lastItem() }}</span> of <span class="font-medium">{{ $rekaps->total() }}</span> results
                        </p>
                    </div>

                    <!-- Pagination -->
                    @if($rekaps->total() > 0)
                    <div class="flex justify-center items-center space-x-1">
                        {{-- First Page Link --}}
                        <a href="{{ $rekaps->url(1) }}"
                            class="px-3 py-1 rounded-md bg-blue-500 text-white {{ $rekaps->onFirstPage() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}"
                            title="First Page"
                            {{ $rekaps->onFirstPage() ? 'disabled' : '' }}>
                            &laquo;
                        </a>

                        {{-- Previous Page Link --}}
                        <a href="{{ $rekaps->previousPageUrl() }}"
                            class="px-3 py-1 rounded-md bg-blue-500 text-white {{ $rekaps->onFirstPage() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}"
                            title="Previous"
                            {{ $rekaps->onFirstPage() ? 'disabled' : '' }}>
                            &lt;
                        </a>

                        {{-- Pagination Numbers --}}
                        @php
                        $currentPage = $rekaps->currentPage();
                        $lastPage = $rekaps->lastPage();

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
                            <a href="{{ $rekaps->url(1) }}"
                                class="px-3 py-1 rounded-md {{ 1 == $currentPage ? 'bg-blue-700 text-white' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                                1
                            </a>
                            @if($startPage > 2)
                            <span class="px-3 py-1">...</span>
                            @endif
                            @endif

                            {{-- Page numbers --}}
                            @for ($i = $startPage; $i <= $endPage; $i++)
                                <a href="{{ $rekaps->url($i) }}"
                                class="px-3 py-1 rounded-md {{ $i == $currentPage ? 'bg-blue-700 text-white' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                                {{ $i }}
                                </a>
                                @endfor

                                {{-- Show last page and ellipsis if needed --}}
                                @if($endPage < $lastPage)
                                    @if($endPage < $lastPage - 1)
                                    <span class="px-3 py-1">...</span>
                                    @endif
                                    <a href="{{ $rekaps->url($lastPage) }}"
                                        class="px-3 py-1 rounded-md {{ $lastPage == $currentPage ? 'bg-blue-700 text-white' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                                        {{ $lastPage }}
                                    </a>
                                    @endif

                                    {{-- Next Page Link --}}
                                    <a href="{{ $rekaps->nextPageUrl() }}"
                                        class="px-3 py-1 rounded-md bg-blue-500 text-white {{ !$rekaps->hasMorePages() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}"
                                        title="Next"
                                        {{ !$rekaps->hasMorePages() ? 'disabled' : '' }}>
                                        &gt;
                                    </a>

                                    {{-- Last Page Link --}}
                                    <a href="{{ $rekaps->url($lastPage) }}"
                                        class="px-3 py-1 rounded-md bg-blue-500 text-white {{ $rekaps->currentPage() == $lastPage ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}"
                                        title="Last Page"
                                        {{ $rekaps->currentPage() == $lastPage ? 'disabled' : '' }}>
                                        &raquo;
                                    </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add form reference for search
        document.querySelector('input[name="search"]').form.id = 'search-form';
    </script>
</body>

</html>