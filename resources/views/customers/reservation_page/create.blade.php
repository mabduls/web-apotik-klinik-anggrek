<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Reservasi | Klinik Anggrek</title>
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
                        <span class="text-lg font-medium">Back To List Reservation</span>
                    </a>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">Create New Reservation</h1>
                <div class="w-10"></div> <!-- Spacer untuk balance -->
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-6 py-8">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Reservation Form</h2>

                        @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">
                                        Terdapat {{ $errors->count() }} kesalahan dalam pengisian form:
                                    </h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('customers.reservation.store') }}">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Kolom Kiri -->
                                <div class="space-y-6">
                                    <!-- Nama Pasien -->
                                    <div>
                                        <label for="nama_pasien" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap Pasien</label>
                                        <input type="text" id="nama_pasien" name="nama_pasien" value="{{ old('nama_pasien') }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                            required>
                                    </div>

                                    <!-- Jenis Kelamin -->
                                    <!-- Di file create.blade.php -->
                                    <div>
                                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                        <select id="jenis_kelamin" name="jenis_kelamin" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>

                                    <!-- NIK -->
                                    <div>
                                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">Nomor Induk Kependudukan (NIK)</label>
                                        <input type="text" id="nik" name="nik" value="{{ old('nik') }}" maxlength="16"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                            required>
                                    </div>

                                    <!-- Alamat -->
                                    <div>
                                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                                        <textarea id="alamat" name="alamat" rows="3"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                            required>{{ old('alamat') }}</textarea>
                                    </div>

                                    <!-- Umur -->
                                    <div>
                                        <label for="umur" class="block text-sm font-medium text-gray-700 mb-1">Umur</label>
                                        <input type="number" id="umur" name="umur" value="{{ old('umur') }}" min="1" max="120"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                            required>
                                    </div>
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="space-y-6">
                                    <!-- Tinggi Badan -->
                                    <div>
                                        <label for="tinggi_badan" class="block text-sm font-medium text-gray-700 mb-1">Tinggi Badan (cm)</label>
                                        <input type="number" step="0.1" id="tinggi_badan" name="tinggi_badan" value="{{ old('tinggi_badan') }}" min="30" max="250"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                            required>
                                    </div>

                                    <!-- Berat Badan -->
                                    <div>
                                        <label for="berat_badan" class="block text-sm font-medium text-gray-700 mb-1">Berat Badan (kg)</label>
                                        <input type="number" step="0.1" id="berat_badan" name="berat_badan" value="{{ old('berat_badan') }}" min="2" max="300"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                            required>
                                    </div>

                                    <!-- No Telepon -->
                                    <div>
                                        <label for="no_telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                        <input type="tel" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                            required>
                                    </div>

                                    <!-- Tanggal Reservasi -->
                                    <div>
                                        <label for="tanggal_reservasi" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Reservasi</label>
                                        <input type="date" id="tanggal_reservasi" name="tanggal_reservasi" value="{{ old('tanggal_reservasi') }}" min="{{ date('Y-m-d') }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                            required>
                                    </div>

                                    <!-- Jam Reservasi -->
                                    <div>
                                        <label for="jam_reservasi" class="block text-sm font-medium text-gray-700 mb-1">Jam Reservasi</label>
                                        <select id="jam_reservasi" name="jam_reservasi"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                            required>
                                            <option value="">Pilih Jam</option>
                                            @php
                                            $start = strtotime('08:00');
                                            $end = strtotime('20:00');
                                            $currentTime = now();
                                            $today = $currentTime->format('Y-m-d');

                                            for ($time = $start; $time <= $end; $time=strtotime('+15 minutes', $time)) {
                                                $timeFormatted=date('H:i', $time);
                                                $disabled=false;

                                                if (old('tanggal_reservasi')==$today) {
                                                $disabled=$time < strtotime($currentTime->format('H:i'));
                                                }

                                                echo '<option value="'.$timeFormatted.'" '.($disabled ? ' disabled' : '' ).' '.((old(' jam_reservasi')==$timeFormatted) ? 'selected' : '' ).'>'.$timeFormatted.'</option>';
                                                }
                                                @endphp
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Keluhan -->
                            <div class="mt-6">
                                <label for="keluhan" class="block text-sm font-medium text-gray-700 mb-1">Keluhan</label>
                                <textarea id="keluhan" name="keluhan" rows="4"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                    required>{{ old('keluhan') }}</textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-8">
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-blue-400 to-purple-400 text-white font-bold py-3 px-6 rounded-lg hover:from-blue-500 hover:to-purple-500 transition shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Create Reservation
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Update jam yang tersedia saat tanggal berubah
        document.getElementById('tanggal_reservasi').addEventListener('change', function() {
            const date = this.value;
            const today = new Date().toISOString().split('T')[0];
            const timeSelect = document.getElementById('jam_reservasi');
            const currentTime = new Date();
            const currentHours = currentTime.getHours().toString().padStart(2, '0');
            const currentMinutes = currentTime.getMinutes().toString().padStart(2, '0');

            // Enable/disable options based on selected date
            Array.from(timeSelect.options).forEach(option => {
                if (option.value) {
                    if (date === today) {
                        // Disable waktu yang sudah lewat untuk hari ini
                        option.disabled = option.value < `${currentHours}:${currentMinutes}`;
                    } else {
                        option.disabled = false;
                    }
                }
            });
        });
    </script>
</body>

</html>