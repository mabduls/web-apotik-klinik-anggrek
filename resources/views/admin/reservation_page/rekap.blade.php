<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Rekap Data Pasien</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    @include('layouts.navigation')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Rekap Data Pasien</h2>
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mt-4 space-y-4 md:space-y-0">
                    <!-- Search Bar -->
                    <form method="GET" action="{{ route('admin.reservations.rekap') }}" class="flex items-center w-full md:w-auto">
                        <div class="relative w-full md:w-64">
                            <input type="text" name="search" value="{{ $currentSearch }}"
                                class="pl-10 pr-4 py-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600"
                                placeholder="Cari pasien...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Cari
                        </button>
                        @if($currentSearch)
                        <a href="{{ route('admin.reservations.rekap') }}" class="ml-2 px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                            Reset
                        </a>
                        @endif
                    </form>

                    <!-- Sort Dropdown -->
                    <form method="GET" action="{{ route('admin.reservations.rekap') }}" class="flex items-center">
                        <input type="hidden" name="search" value="{{ $currentSearch }}">
                        <select name="sort" onchange="this.form.submit()"
                            class="px-8 py-2 border rounded-md text-gray-300 dark:bg-gray-700 dark:border-gray-600">
                            <option value="newest" {{ $currentSort == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ $currentSort == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No Reservasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Pasien</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">NIK</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Reservasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No Telepon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($rekaps as $index => $rekap)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white">{{ $rekaps->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white">#{{ $rekap->reservation->nomor_reservasi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white">{{ $rekap->nama_pasien }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white">{{ $rekap->nik }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white">{{ \Carbon\Carbon::parse($rekap->tanggal_reservasi)->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white">{{ $rekap->no_telepon }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.reservations.rekap.details', $rekap) }}"
                                        class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-500">
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Tidak ada data rekap pasien</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($rekaps->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                    <div class="text-sm text-gray-700 dark:text-gray-300">
                        Menampilkan <span class="font-medium">{{ $rekaps->firstItem() }}</span>
                        sampai <span class="font-medium">{{ $rekaps->lastItem() }}</span>
                        dari <span class="font-medium">{{ $rekaps->total() }}</span> data
                    </div>
                    <div class="flex items-center space-x-1">
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

                                @if($showStartEllipsis)
                                <span class="px-3 py-1">...</span>
                                @endif

                                @for ($i = $startPage; $i <= $endPage; $i++)
                                    <a href="{{ $rekaps->url($i) }}"
                                    class="px-3 py-1 rounded-md {{ $i == $currentPage ? 'bg-blue-700 text-white' : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                                    {{ $i }}
                                    </a>
                                    @endfor

                                    @if($showEndEllipsis)
                                    <span class="px-3 py-1">...</span>
                                    @endif

                                    {{-- Next Page Link --}}
                                    <a href="{{ $rekaps->nextPageUrl() }}"
                                        class="px-3 py-1 rounded-md bg-blue-500 text-white {{ !$rekaps->hasMorePages() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-600' }}"
                                        title="Next"
                                        {{ !$rekaps->hasMorePages() ? 'disabled' : '' }}>
                                        &gt;
                                    </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</body>

</html>