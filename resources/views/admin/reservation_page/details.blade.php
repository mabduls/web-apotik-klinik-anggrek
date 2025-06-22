<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    @include('layouts.navigation')
    <div class="container mx-auto px-4 py-8">
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

        <!-- Action Buttons -->
        <div class="mb-6 flex flex-wrap gap-3">
            <a href="{{ route('admin.reservations.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Reservasi
            </a>
        </div>

        <!-- Main Card -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Detail Reservasi</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">No. Reservasi: #{{ $reservation->nomor_reservasi }}</p>
                    </div>
                    <div class="mt-2 md:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                            {{ $reservation->status === 'disetujui' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200' }}">
                            @if($reservation->status === 'disetujui')
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @endif
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card Content -->
            <div class="px-6 py-6">
                <!-- Patient and Reservation Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Patient Information -->
                    <div class="bg-gray-50 dark:bg-gray-700/30 p-5 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-600 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Informasi Pasien
                        </h3>
                        <div class="space-y-4">
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Nama Pasien</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white font-medium">{{ $reservation->nama_pasien }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Jenis Kelamin</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white font-medium">{{ $reservation->jenis_kelamin }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">NIK</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white">{{ $reservation->nik }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Alamat</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white">{{ $reservation->alamat }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Umur</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white">{{ $reservation->umur }} tahun</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reservation Information -->
                    <div class="bg-gray-50 dark:bg-gray-700/30 p-5 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-600 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Informasi Reservasi
                        </h3>
                        <div class="space-y-4">
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $reservation->status === 'disetujui' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200' }}">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Reservasi</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white">{{ \Carbon\Carbon::parse($reservation->tanggal_reservasi)->format('d M Y') }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Jam Reservasi</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white">{{ $reservation->jam_reservasi }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">No. Telepon</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white">{{ $reservation->no_telepon ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Health Information -->
                <div class="mt-8 bg-gray-50 dark:bg-gray-700/30 p-5 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        Informasi Kesehatan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="col-span-1">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tinggi Badan</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-gray-800 dark:text-white">{{ $reservation->tinggi_badan }} cm</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="col-span-1">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Berat Badan</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-gray-800 dark:text-white">{{ $reservation->berat_badan }} kg</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Complaint -->
                <div class="mt-8 bg-gray-50 dark:bg-gray-700/30 p-5 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-600 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Keluhan Pasien
                    </h3>
                    <div class="prose prose-sm dark:prose-invert max-w-none">
                        <p class="text-gray-800 dark:text-white">{{ $reservation->keluhan }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex justify-end space-x-4">
                    @if($reservation->status !== 'disetujui')
                    <form method="POST" action="{{ route('admin.reservations.update', $reservation) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="disetujui">
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition">
                            Set Disetujui
                        </button>
                    </form>
                    @else
                    <a href="https://web.whatsapp.com/send?phone={{ $reservation->no_telepon }}&text=Halo%20{{ urlencode($reservation->nama_pasien) }}%2C%20reservasi%20Anda%20telah%20disetujui.%20Silakan%20datang%20tepat%20waktu."
                        target="_blank"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 inline-flex items-center transition">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        Contact Customer
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>