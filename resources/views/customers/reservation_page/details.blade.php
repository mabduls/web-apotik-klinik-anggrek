<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi | Klinik Anggrek</title>
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
                    <a href="{{ route('customers.reservation.page') }}" class="flex items-center text-blue-500 hover:text-blue-600 transition">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-lg font-medium">Kembali ke Daftar Reservasi</span>
                    </a>
                </div>
                <h1 class="text-2xl font-bold text-gray-600">Detail <span class="text-blue-500">Reservasi Saya</span></h1>
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

            <!-- Main Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Card Header -->
                <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Detail Reservasi</h2>
                            <p class="text-sm text-gray-500 mt-1">No. Reservasi: #{{ $reservation->nomor_reservasi }}</p>
                        </div>
                        <div class="mt-2 md:mt-0">
                            @php
                            $statusClasses = [
                            'menunggu' => 'bg-yellow-100 text-yellow-800',
                            'disetujui' => 'bg-green-100 text-green-800'
                            ];
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $statusClasses[$reservation->status] }}">
                                @if($reservation->status === 'disetujui')
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                @endif
                                {{ ucfirst($reservation->status) }}
                                @if($reservation->status === 'menunggu')
                                <span class="ml-1 text-xs">(Menunggu konfirmasi admin)</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card Content -->
                <div class="px-6 py-6">
                    <!-- Patient and Reservation Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Patient Information -->
                        <div class="bg-blue-50 p-5 rounded-lg">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Informasi Pasien
                            </h3>
                            <div class="space-y-4">
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <p class="text-sm text-gray-500">Nama Lengkap</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-gray-800 font-medium">{{ $reservation->nama_pasien }}</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <p class="text-sm text-gray-500">Jenis Kelamin</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-gray-800 font-medium">{{ $reservation->jenis_kelamin }}</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <p class="text-sm text-gray-500">NIK</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-gray-800 font-medium">{{ $reservation->nik }}</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <p class="text-sm text-gray-500">Alamat</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-gray-800 font-medium">{{ $reservation->alamat }}</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <p class="text-sm text-gray-500">Umur</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-gray-800 font-medium">{{ $reservation->umur }} tahun</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <p class="text-sm text-gray-500">No. Telepon</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-gray-800 font-medium">{{ $reservation->no_telepon ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reservation Information -->
                        <div class="bg-blue-50 p-5 rounded-lg">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Informasi Reservasi
                            </h3>
                            <div class="space-y-4">
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <p class="text-sm text-gray-500">Tanggal</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-gray-800 font-medium">
                                            {{ \Carbon\Carbon::parse($reservation->tanggal_reservasi)->translatedFormat('l, d F Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <p class="text-sm text-gray-500">Jam</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-gray-800 font-medium">{{ $reservation->jam_reservasi }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Health Information -->
                            <h3 class="text-lg font-bold text-gray-800 mt-6 mb-4 pb-2 border-b border-gray-200 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                                Informasi Kesehatan
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <p class="text-sm text-gray-500">Tinggi Badan</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-gray-800 font-medium">{{ $reservation->tinggi_badan }} cm</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-1">
                                        <p class="text-sm text-gray-500">Berat Badan</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-gray-800 font-medium">{{ $reservation->berat_badan }} kg</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Complaint -->
                    <div class="mt-8 bg-blue-50 p-5 rounded-lg">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Keluhan Pasien
                        </h3>
                        <div class="bg-white rounded-lg p-4">
                            <p class="text-gray-800">{{ $reservation->keluhan }}</p>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="mt-8 flex justify-end">
                        <a href="https://web.whatsapp.com/" target="_blank" class="flex items-center px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                            Contact Owner
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>