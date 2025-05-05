<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apotek & Klinik Anggrek - Solusi Kesehatan Terpercaya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #56c4c5;
            --secondary: #ffb6c1;
            --accent: #a5dee5;
            --text: #444444;
            --light-bg: #f9f9f9;
        }

        body {
            font-family: 'Nunito', 'Segoe UI', sans-serif;
            color: var(--text);
            scroll-behavior: smooth;
        }

        .bg-primary {
            background-color: var(--primary);
        }

        .bg-secondary {
            background-color: var(--secondary);
        }

        .bg-accent {
            background-color: var(--accent);
        }

        .text-primary {
            color: var(--primary);
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #48b0b1;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary {
            background-color: var(--secondary);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #ff9fad;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .service-card {
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .header-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .section {
            min-height: 100vh;
            padding: 5rem 1rem;
        }

        .wave-divider {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .wave-divider svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 70px;
        }

        .wave-divider .shape-fill {
            fill: var(--accent);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        @media (max-width: 768px) {
            .features-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Custom animations */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .float {
            animation: float 4s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-light-bg">
    <!-- Header Navigation -->
    <!-- Header Navigation -->
    <header class="bg-white header-shadow fixed w-full z-30">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <!-- Logo -->
            <div class="text-2xl font-bold text-primary flex items-center">
                <i class="fas fa-clinic-medical mr-2"></i>
                <span>Klinik Anggrek</span>
            </div>

            <!-- Desktop Navigation - Tengah -->
            <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2">
                <div class="flex items-center space-x-4">
                    <a href="#beranda" class="px-3 py-2 text-gray-700 hover:text-primary transition">Beranda</a>
                    <a href="#layanan" class="px-3 py-2 text-gray-700 hover:text-primary transition">Layanan</a>
                    <a href="#tentang" class="px-3 py-2 text-gray-700 hover:text-primary transition">Tentang Kami</a>
                </div>
            </div>

            <!-- Auth Navigation - Kanan -->
            <div class="hidden md:flex items-center space-x-2">
                @if (Route::has('login'))
                <nav class="flex items-center">
                    @auth
                    <a
                        href="{{ Auth::user()->hasRole('owner') ? route('admin.dashboard') : route('customers.dashboard.page.index') }}"
                        class="rounded-md px-3 py-2 text-black hover:text-primary transition">
                        Dashboard
                    </a>
                    @else
                    <a
                        href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black hover:text-primary transition">
                        Log in
                    </a>
                    @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md transition">
                        Register
                    </a>
                    @endif
                    @endauth
                </nav>
                @endif
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-gray-700 hover:text-primary focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden bg-white py-2 hidden">
            <a href="#beranda" class="block px-6 py-2 text-gray-700 hover:bg-gray-100">Beranda</a>
            <a href="#layanan" class="block px-6 py-2 text-gray-700 hover:bg-gray-100">Layanan</a>
            <a href="#tentang" class="block px-6 py-2 text-gray-700 hover:bg-gray-100">Tentang Kami</a>

            @if (Route::has('login'))
            @auth
            <a href="{{ Auth::user()->hasRole('owner') ? route('admin.dashboard') : route('customers.dashboard.page.index') }}"
                class="block px-6 py-2 text-gray-700 hover:bg-gray-100">
                Dashboard
            </a>
            @else
            <a href="{{ route('login') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-100">Log in</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="block bg-primary text-white px-6 py-2">Register</a>
            @endif
            @endauth
            @endif
        </div>
    </header>

    <!-- Section 1: Hero -->
    <section id="beranda" class="section flex items-center bg-white relative pt-24">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0" data-aos="fade-right" data-aos-duration="1000">
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                        Kesehatan Anda <span class="text-primary">Prioritas Kami</span>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8">
                        Apotek & Klinik Anggrek menyediakan layanan kesehatan yang mudah diakses di Cilegon, Banten. Pesan obat online atau reservasi jadwal konsultasi dengan dokter untuk pengalaman berobat yang nyaman.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#" class="btn-primary px-6 py-3 rounded-lg text-center font-medium">
                            Pesan Obat Online
                        </a>
                        <a href="#" class="btn-secondary px-6 py-3 rounded-lg text-center font-medium">
                            Reservasi Dokter
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center" data-aos="fade-left" data-aos-duration="1000">
                    <img src="{{ asset('assets/images/img-dokter-pasien-r.webp') }}" alt="Ilustrasi Kesehatan" class="float max-w-full h-auto">
                </div>
            </div>
        </div>
        <div class="wave-divider">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <!-- Section 2: Services -->
    <section id="layanan" class="section bg-accent relative">
        <div class="container mx-auto px-6 py-12">
            <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Layanan Kami</h2>
                <p class="text-lg text-gray-700 max-w-2xl mx-auto">
                    Apotek & Klinik Anggrek menyediakan berbagai layanan kesehatan untuk memenuhi kebutuhan Anda dan keluarga. Kami berkomitmen memberikan layanan terbaik dan tepercaya.
                </p>
            </div>

            <div class="flex flex-col justify-center">
                <div class="features-grid place-items-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                    <!-- Service Card 1 -->
                    <div class="service-card bg-white rounded-xl shadow-lg p-6">
                        <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mb-6 mx-auto">
                            <i class="fas fa-pills text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-center mb-3">Pemesanan Obat Online</h3>
                        <p class="text-gray-600 text-center">
                            Pesan obat dari rumah dan terima di lokasi Anda atau ambil langsung di apotek kami tanpa antri.
                        </p>
                    </div>

                    <!-- Service Card 2 -->
                    <div class="service-card bg-white rounded-xl shadow-lg p-6">
                        <div class="w-16 h-16 bg-secondary rounded-full flex items-center justify-center mb-6 mx-auto">
                            <i class="fas fa-calendar-check text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-center mb-3">Reservasi Jadwal Dokter</h3>
                        <p class="text-gray-600 text-center">
                            Hindari antrian panjang dengan memesan jadwal konsultasi dokter dari kenyamanan rumah Anda.
                        </p>
                    </div>

                    <!-- Service Card 3 -->
                    <div class="service-card bg-white rounded-xl shadow-lg p-6">
                        <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mb-6 mx-auto">
                            <i class="fas fa-user-md text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-center mb-3">Konsultasi Kesehatan</h3>
                        <p class="text-gray-600 text-center">
                            Dapatkan konsultasi dari dokter berpengalaman untuk berbagai keluhan kesehatan Anda.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-16 text-center" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                <a href="{{ route('login') }}" class="btn-primary inline-block px-8 py-4 rounded-lg font-semibold text-lg">
                    Lihat Semua Layanan
                </a>
            </div>
        </div>
        <div class="wave-divider">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill" style="fill: #FFFFFF;"></path>
            </svg>
        </div>
    </section>

    <!-- Section 3: About & Features -->
    <section id="tentang" class="section bg-white">
        <div class="container mx-auto px-6 py-12">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0" data-aos="fade-right" data-aos-duration="1000">
                    <img src="{{ asset('assets/images/img-tentang-kami.webp') }}" alt="Klinik Anggrek" class="max-w-full h-auto">
                </div>
                <div class="md:w-1/2 md:pl-12" data-aos="fade-left" data-aos-duration="1000">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Tentang Apotek & Klinik Anggrek</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        Apotek & Klinik Anggrek berlokasi di Cilegon, Banten, Kecamatan Ciwaduk, Jalan Anggrek. Kami telah melayani masyarakat dengan layanan kesehatan berkualitas selama bertahun-tahun.
                    </p>
                    <p class="text-lg text-gray-600 mb-6">
                        Dengan ruang tunggu yang terbatas, inovasi website ini hadir untuk memberikan solusi agar Anda tidak perlu lagi menunggu lama di klinik. Kami memahami bahwa waktu Anda berharga dan kesehatan tidak bisa menunggu.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-primary text-xl mt-1 mr-4"></i>
                            <p class="text-gray-600">Tenaga medis profesional dan berpengalaman</p>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-primary text-xl mt-1 mr-4"></i>
                            <p class="text-gray-600">Obat-obatan berkualitas dan lengkap</p>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-primary text-xl mt-1 mr-4"></i>
                            <p class="text-gray-600">Layanan online yang mudah dan cepat</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-24" data-aos="fade-up" data-aos-duration="1000">
                <h3 class="text-2xl font-bold text-center mb-12">Mengapa Memilih Kami?</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Feature 1 -->
                    <div class="text-center">
                        <div class="bg-primary h-20 w-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-heartbeat text-white text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-semibold mb-2">Pelayanan Terbaik</h4>
                        <p class="text-gray-600">Kami mengutamakan kenyamanan dan kebutuhan setiap pasien</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="text-center">
                        <div class="bg-secondary h-20 w-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shipping-fast text-white text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-semibold mb-2">Pengiriman Cepat</h4>
                        <p class="text-gray-600">Obat diantar ke lokasi Anda dengan cepat dan aman</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="text-center">
                        <div class="bg-primary h-20 w-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-calendar-alt text-white text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-semibold mb-2">Reservasi Mudah</h4>
                        <p class="text-gray-600">Sistem reservasi online yang praktis dan efisien</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="text-center">
                        <div class="bg-secondary h-20 w-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-lock text-white text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-semibold mb-2">Privasi Terjamin</h4>
                        <p class="text-gray-600">Data kesehatan Anda selalu kami jaga kerahasiaannya</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Contact Info -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Hubungi Kami</h4>
                    <div class="space-y-3">
                        <p class="flex items-start">
                            <i class="fas fa-map-marker-alt mr-3 mt-1"></i>
                            <span>Jalan Anggrek, Kecamatan Ciwaduk, Cilegon, Banten</span>
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-phone-alt mr-3"></i>
                            <span>+62 812-3456-7890</span>
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-envelope mr-3"></i>
                            <span>info@klinikapotekangrek.com</span>
                        </p>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Link Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">Beranda</a></li>
                        <li><a href="#" class="hover:underline">Layanan</a></li>
                        <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                        <li><a href="#" class="hover:underline">Daftar Obat</a></li>
                        <li><a href="#" class="hover:underline">Jadwal Dokter</a></li>
                    </ul>
                </div>

                <!-- Opening Hours -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Jam Operasional</h4>
                    <ul class="space-y-2">
                        <li class="flex justify-between">
                            <span>Senin - Jumat:</span>
                            <span>08:00 - 20:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Sabtu:</span>
                            <span>09:00 - 18:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Minggu:</span>
                            <span>09:00 - 15:00</span>
                        </li>
                    </ul>
                    <div class="mt-4 flex space-x-3">
                        <a href="#" class="text-white hover:text-gray-200 transition">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-white hover:text-gray-200 transition">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-white hover:text-gray-200 transition">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/20 mt-12 pt-6 text-center">
                <p>&copy; 2025 Apotek & Klinik Anggrek. Semua Hak Dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });

        // Initialize AOS
        AOS.init({
            once: true,
            duration: 800,
            easing: 'ease-in-out'
        });
    </script>
</body>

</html>