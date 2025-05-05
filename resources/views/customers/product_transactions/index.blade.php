<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Transactions | Klinik Anggrek</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
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

<body class="bg-gradient-to-br from-blue-50 to-purple-50">
    <div class="min-h-screen">
        <!-- Header/Navigation -->
        <header class="bg-white shadow-lg">
            <div class="container mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('customers.dashboard.page.index') }}" class="flex items-center text-blue-500 hover:text-blue-600 transition">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-lg font-medium">Back to Dashboard</span>
                    </a>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">My Transactions</h1>
                <div class="w-5"></div> <!-- Empty div for alignment -->
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-6 py-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Transaction History</h2>
                </div>

                <div class="p-6">
                    @forelse($product_transactions as $transaction)
                    <div class="grid grid-cols-12 items-center gap-4 p-4 hover:bg-blue-50 rounded-xl transition mb-3">
                        <div class="col-span-12 md:col-span-4">
                            <p class="text-sm text-gray-500">
                                Total Transaction
                            </p>
                            <h3 class="text-gray-800 font-bold text-xl">
                                Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <p class="text-sm text-gray-500">
                                Date
                            </p>
                            <h3 class="text-gray-800 font-bold text-xl">
                                {{ $transaction->created_at->format('d M Y H:i') }}
                            </h3>
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            @if($transaction->is_paid)
                            <div class="inline-flex items-center justify-center">
                                <span class="font-bold py-1 px-4 rounded-full text-white bg-gradient-to-r from-green-400 to-green-500 flex items-center justify-center h-8 shadow-sm">
                                    <p class="text-white font-bold text-sm leading-none">
                                        SUCCESS
                                    </p>
                                </span>
                            </div>
                            @else
                            <div class="inline-flex items-center justify-center">
                                <span class="font-bold py-1 px-4 rounded-full text-white bg-gradient-to-r from-orange-400 to-orange-500 flex items-center justify-center h-8 shadow-sm">
                                    <p class="text-white font-bold text-sm leading-none">
                                        PENDING
                                    </p>
                                </span>
                            </div>
                            @endif
                        </div>
                        <div class="col-span-12 md:col-span-2 flex justify-end mt-4 md:mt-0">
                            <a href="{{ route('customers.transaction.details', $transaction) }}" class="font-bold py-2 px-6 rounded-xl text-white bg-gradient-to-r from-blue-400 to-purple-400 hover:from-blue-500 hover:to-purple-500 transition shadow-md">
                                View Detail
                            </a>
                        </div>
                    </div>
                    <hr class="my-3 border-gray-200">
                    @empty
                    <div class="flex flex-col items-center justify-center py-12 text-gray-500">
                        <svg class="w-16 h-16 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <p class="text-lg font-semibold">No Transactions Found</p>
                        <p class="text-gray-500">You have not made any transactions yet.</p>
                        <a href="{{ route('customers.dashboard.page.index') }}" class="mt-4 bg-gradient-to-r from-blue-400 to-purple-400 text-white font-medium px-6 py-2 rounded-xl hover:from-blue-500 hover:to-purple-500 transition shadow-md">
                            Browse Products
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</body>

</html>