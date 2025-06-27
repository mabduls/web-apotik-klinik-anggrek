<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    @include('layouts.navigation')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Header -->
            <div class="mb-8">
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-700 dark:to-purple-700 rounded-xl p-8 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
                            <p class="text-blue-100 text-lg">Here's what's happening with your clinic today.</p>
                        </div>
                        <div class="hidden md:block">
                            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4">
                                <div class="text-center">
                                    <div class="text-2xl font-bold">{{ date('d') }}</div>
                                    <div class="text-sm">{{ date('M Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Products -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Products</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalProducts ?? 0 }}</p>
                        </div>
                        <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-full">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Categories -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Categories</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalCategories ?? 0 }}</p>
                        </div>
                        <div class="bg-green-100 dark:bg-green-900 p-3 rounded-full">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pending Reservations -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Pending Reservations</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $pendingReservations ?? 0 }}</p>
                        </div>
                        <div class="bg-yellow-100 dark:bg-yellow-900 p-3 rounded-full">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Transactions Pending -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Transactions Pending</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $pendingTransactions ?? 0 }}</p>
                        </div>
                        <div class="bg-purple-100 dark:bg-purple-900 p-3 rounded-full">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Navigation Quick Access -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Quick Access</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Manage Products Card -->
                            <a href="{{ route('admin.products.index') }}" class="group">
                                <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-lg p-6 border border-blue-200 dark:border-blue-700 hover:shadow-lg transition-all duration-300 group-hover:scale-105">
                                    <div class="flex items-center mb-4">
                                        <div class="bg-blue-500 p-2 rounded-lg">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white ml-3">Manage Products</h3>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">Add, edit, and manage your pharmacy products. Set prices, descriptions, and organize by categories.</p>
                                </div>
                            </a>

                            <!-- Manage Categories Card -->
                            <a href="{{ route('admin.categories.index') }}" class="group">
                                <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-lg p-6 border border-green-200 dark:border-green-700 hover:shadow-lg transition-all duration-300 group-hover:scale-105">
                                    <div class="flex items-center mb-4">
                                        <div class="bg-green-500 p-2 rounded-lg">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white ml-3">Manage Categories</h3>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">Organize your products into categories. Create and manage product classifications for better organization.</p>
                                </div>
                            </a>

                            <!-- Pharmacy Orders Card -->
                            <a href="{{ route('admin.product_transactions.index') }}" class="group">
                                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-yellow-900/20 dark:to-yellow-800/20 rounded-lg p-6 border border-yellow-200 dark:border-yellow-700 hover:shadow-lg transition-all duration-300 group-hover:scale-105">
                                    <div class="flex items-center mb-4">
                                        <div class="bg-yellow-500 p-2 rounded-lg">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white ml-3">Pharmacy Orders</h3>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">View and manage customer orders. Process payments, update order status, and handle shipping.</p>
                                </div>
                            </a>

                            <!-- Customer Reservations Card -->
                            <a href="{{ route('admin.reservations.index') }}" class="group">
                                <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-lg p-6 border border-purple-200 dark:border-purple-700 hover:shadow-lg transition-all duration-300 group-hover:scale-105">
                                    <div class="flex items-center mb-4">
                                        <div class="bg-purple-500 p-2 rounded-lg">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white ml-3">Customer Reservations</h3>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">Manage patient appointments and reservations. Approve or reschedule booking requests.</p>
                                </div>
                            </a>
                        </div>

                        <!-- Rekap Data Pasien Card - Full Width -->
                        <div class="mt-4">
                            <a href="{{ route('admin.reservations.rekap') }}" class="group block">
                                <div class="bg-gradient-to-r from-indigo-50 to-cyan-50 dark:from-indigo-900/20 dark:to-cyan-800/20 rounded-lg p-6 border border-indigo-200 dark:border-indigo-700 hover:shadow-lg transition-all duration-300 group-hover:scale-[1.02]">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="bg-indigo-500 p-3 rounded-lg">
                                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Rekap Data Pasien</h3>
                                                <p class="text-gray-600 dark:text-gray-400">Comprehensive patient records and medical history management</p>
                                            </div>
                                        </div>
                                        <div class="hidden md:block">
                                            <svg class="w-6 h-6 text-indigo-500 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity & Chart -->
                <div class="space-y-6">
                    <!-- Recent Reservations -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Reservations</h3>
                        <div class="space-y-3">
                            @forelse($recentReservations ?? [] as $reservation)
                            <div class="flex items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $reservation->nama_pasien }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ date('d M Y', strtotime($reservation->tanggal_reservasi)) }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full {{ $reservation->status == 'menunggu' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' }}">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </div>
                            @empty
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No recent reservations</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Daily Statistics -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Today's Activity</h3>
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Today's Reservations -->
                            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Today's Reservations</p>
                                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $todayReservations ?? 0 }}</p>
                                        @if($todayReservations > 0 && $lastReservationTime)
                                        <p class="text-xs text-gray-500 dark:text-gray-400">last at {{ $lastReservationTime->timezone('Asia/Jakarta')->format('h:i A') }}</p>
                                        @endif
                                    </div>
                                    <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-full">
                                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Today's Transactions -->
                            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border-l-4 border-green-500">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Today's Transactions</p>
                                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $todayTransactions ?? 0 }}</p>
                                        @if($todayTransactions > 0 && $lastTransactionTime)
                                        <p class="text-xs text-gray-500 dark:text-gray-400">last at {{ $lastTransactionTime->timezone('Asia/Jakarta')->format('h:i A') }}</p>
                                        @endif
                                    </div>
                                    <div class="bg-green-100 dark:bg-green-900 p-3 rounded-full">
                                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="mt-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">System Overview</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full mb-3">
                                <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">System Status</h3>
                            <p class="text-green-600 dark:text-green-400">All systems operational</p>
                        </div>
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-full mb-3">
                                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Performance</h3>
                            <p class="text-blue-600 dark:text-blue-400">Excellent</p>
                        </div>
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-full mb-3">
                                <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Security</h3>
                            <p class="text-purple-600 dark:text-purple-400">Protected</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>