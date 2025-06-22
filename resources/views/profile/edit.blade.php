<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        slate: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        },
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        <!-- Header Section -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="animate-fade-in-down">
                    <h2 class="font-bold text-2xl text-slate-700 leading-tight flex items-center gap-3">
                        <div class="w-8 h-8 bg-gradient-to-r from-pink-300 to-purple-300 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        {{ __('Profile Settings') }}
                    </h2>
                    <p class="text-slate-500 mt-1">Kelola informasi profil dan keamanan akun Anda</p>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="py-8 min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

                <!-- Navigation Back Button -->
                <div class="animate-slide-in-left">
                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-lg border border-white/50 p-6 hover:shadow-xl transition-all duration-300 hover:scale-[1.02]">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-slate-700 mb-1">Dashboard Navigation</h3>
                                <p class="text-slate-500 text-sm">Kembali ke halaman utama</p>
                            </div>
                            @if(auth()->user()->hasRole('owner'))
                            <a href="{{ route('admin.dashboard') }}"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-400 to-pink-400 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 hover:from-purple-500 hover:to-pink-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Owner Dashboard
                            </a>
                            @elseif(auth()->user()->hasRole('customers'))
                            <a href="{{ route('customers.dashboard.page.index') }}"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-400 to-teal-400 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 hover:from-blue-500 hover:to-teal-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Customer Dashboard
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Profile Information Card -->
                <div class="animate-slide-in-up" style="animation-delay: 0.1s">
                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-lg border border-white/50 overflow-hidden hover:shadow-xl transition-all duration-300">
                        <div class="bg-gradient-to-r from-pink-300 via-purple-300 to-blue-300 h-2"></div>
                        <div class="p-8">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 bg-gradient-to-r from-pink-400 to-purple-400 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-slate-700">Informasi Profil</h3>
                                    <p class="text-slate-500">Perbarui informasi akun dan alamat email Anda</p>
                                </div>
                            </div>

                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <!-- Password Update Card -->
                <div class="animate-slide-in-up" style="animation-delay: 0.2s">
                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-lg border border-white/50 overflow-hidden hover:shadow-xl transition-all duration-300">
                        <div class="bg-gradient-to-r from-orange-300 via-yellow-300 to-green-300 h-2"></div>
                        <div class="p-8">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 bg-gradient-to-r from-orange-400 to-yellow-400 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-slate-700">Keamanan Password</h3>
                                    <p class="text-slate-500">Pastikan akun Anda menggunakan password yang kuat</p>
                                </div>
                            </div>

                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Delete Account Card -->
                <div class="animate-slide-in-up" style="animation-delay: 0.3s">
                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-lg border border-white/50 overflow-hidden hover:shadow-xl transition-all duration-300">
                        <div class="bg-gradient-to-r from-red-300 via-pink-300 to-rose-300 h-2"></div>
                        <div class="p-8">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 bg-gradient-to-r from-red-400 to-pink-400 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-slate-700">Zona Bahaya</h3>
                                    <p class="text-slate-500">Tindakan permanen yang tidak dapat dibatalkan</p>
                                </div>
                            </div>

                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-in-left {
            0% {
                opacity: 0;
                transform: translateX(-30px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slide-in-up {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.6s ease-out;
        }

        .animate-slide-in-left {
            animation: slide-in-left 0.8s ease-out;
        }

        .animate-slide-in-up {
            animation: slide-in-up 0.8s ease-out;
            opacity: 0;
            animation-fill-mode: forwards;
        }

        /* Smooth transitions for interactive elements */
        * {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced backdrop blur effect */
        .backdrop-blur-sm {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        /* Hover animations */
        .hover\:scale-\[1\.02\]:hover {
            transform: scale(1.02);
        }

        .hover\:scale-105:hover {
            transform: scale(1.05);
        }

        /* Focus states for accessibility */
        .focus\:ring-4:focus {
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
        }
    </style>
</body>

</html>