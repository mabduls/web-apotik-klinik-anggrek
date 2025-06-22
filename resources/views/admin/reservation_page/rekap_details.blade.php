<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Rekap Pasien</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    @include('layouts.navigation')
    <div class="container mx-auto px-4 py-8">
        <!-- Success Notification -->
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
            <a href="{{ route('admin.reservations.rekap', $rekap->reservation) }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Rekap
            </a>
            <button onclick="openEditModal()"
                class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Update Data Pasien
            </button>
        </div>

        <!-- Main Card -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Detail Rekap Pasien</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">No. Rekap: #{{ $rekap->id }}</p>
                    </div>
                    <div class="mt-2 md:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Lengkap
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
                                    <p class="text-gray-800 dark:text-white font-medium">{{ $rekap->nama_pasien }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">NIK</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white">{{ $rekap->nik }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Jenis Kelamin</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white">{{ $rekap->jenis_kelamin }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Umur</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white">{{ $rekap->umur }} tahun</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Alamat</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white">{{ $rekap->alamat }}</p>
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
                                    <p class="text-sm text-gray-500 dark:text-gray-400">No. Reservasi</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white font-medium">#{{ $rekap->reservation->nomor_reservasi }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Reservasi</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white">{{ \Carbon\Carbon::parse($rekap->tanggal_reservasi)->format('d M Y') }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">No. Telepon</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white">{{ $rekap->no_telepon }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">No. BPJS</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-800 dark:text-white">{{ $rekap->no_bpjs ?? '-' }}</p>
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
                                <p class="text-gray-800 dark:text-white">{{ $rekap->tinggi_badan }} cm</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="col-span-1">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Berat Badan</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-gray-800 dark:text-white">{{ $rekap->berat_badan }} kg</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Diagnosis and Treatment -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Diagnosis -->
                    <div class="bg-gray-50 dark:bg-gray-700/30 p-5 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-600 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Diagnosa Penyakit
                        </h3>
                        <div class="prose prose-sm dark:prose-invert max-w-none">
                            <p class="text-gray-800 dark:text-white">{{ $rekap->diagnosa_penyakit }}</p>
                        </div>
                    </div>

                    <!-- Treatment -->
                    <div class="bg-gray-50 dark:bg-gray-700/30 p-5 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-600 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                            </svg>
                            Saran Pengobatan
                        </h3>
                        <div class="prose prose-sm dark:prose-invert max-w-none">
                            <p class="text-gray-800 dark:text-white">{{ $rekap->saran_pengobatan }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal Form -->
        <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
            <div class="relative top-20 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-md bg-white dark:bg-gray-800">
                <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-200 dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Update Data Pasien</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('admin.reservations.rekap.update', $rekap) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Personal Info -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Pasien</label>
                                <input type="text" name="nama_pasien" value="{{ $rekap->nama_pasien }}"
                                    class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">NIK</label>
                                <input type="text" name="nik" value="{{ $rekap->nik }}"
                                    class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
                                <input type="text" name="alamat" value="{{ $rekap->alamat }}"
                                    class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                    <option value="Laki-laki" {{ $rekap->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $rekap->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <!-- Health Info -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Umur</label>
                                <input type="number" name="umur" value="{{ $rekap->umur }}"
                                    class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tinggi Badan (cm)</label>
                                <input type="number" name="tinggi_badan" value="{{ $rekap->tinggi_badan }}"
                                    class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Berat Badan (kg)</label>
                                <input type="number" name="berat_badan" value="{{ $rekap->berat_badan }}"
                                    class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Telepon</label>
                                <input type="text" name="no_telepon" value="{{ $rekap->no_telepon }}"
                                    class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor BPJS</label>
                                <input type="text" name="no_bpjs" value="{{ $rekap->no_bpjs }}"
                                    class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>
                        </div>
                    </div>

                    <!-- Diagnosis and Treatment -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="diagnosa_penyakit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Diagnosa Penyakit</label>
                            <textarea name="diagnosa_penyakit" id="diagnosa_penyakit" rows="4"
                                class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>{{ $rekap->diagnosa_penyakit }}</textarea>
                        </div>
                        <div>
                            <label for="saran_pengobatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Saran Pengobatan</label>
                            <textarea name="saran_pengobatan" id="saran_pengobatan" rows="4"
                                class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>{{ $rekap->saran_pengobatan }}</textarea>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-600">
                        <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500 transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openEditModal() {
                document.getElementById('editModal').classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeEditModal() {
                document.getElementById('editModal').classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            // Close modal when clicking outside
            window.onclick = function(event) {
                const modal = document.getElementById('editModal');
                if (event.target === modal) {
                    closeEditModal();
                }
            }
        </script>
    </div>
</body>

</html>