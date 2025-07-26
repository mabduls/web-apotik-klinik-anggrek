<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Transaction</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/@herophotos/react@2.0.11/outline/index.js" defer></script>
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    @include('layouts.navigation')
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
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
            <div class="mb-6 px-4 sm:px-0 flex flex-row w-full justify-between items-center">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.product_transactions.index') }}" class="text-gray-300 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <h2 class="font-bold text-xl dark:text-gray-200 leading-tight">
                        {{ __('Detail Transaction') }}
                    </h2>
                </div>
            </div>
            <div class="dark:bg-gray-800 p-6 sm:p-8 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Header Transaction Info -->
                <!-- Header Transaction Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gray-700/50 p-4 rounded-lg">
                        <p class="text-sm text-gray-300">Customer</p>
                        <p class="text-white font-bold text-xl">
                            {{ $productTransaction->user->name }}
                        </p>
                    </div>
                    <div class="bg-gray-700/50 p-4 rounded-lg">
                        <p class="text-sm text-gray-300">No. Resi</p>
                        <p class="text-white font-bold text-xl">
                            {{ $productTransaction->tracking_number ?? '-' }}
                        </p>
                    </div>
                    <div class="bg-gray-700/50 p-4 rounded-lg">
                        <p class="text-sm text-gray-300">Total Transaction</p>
                        <p class="text-white font-bold text-xl">
                            Rp {{ number_format($productTransaction->total_amount, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-gray-700/50 p-4 rounded-lg">
                        <p class="text-sm text-gray-300">Date</p>
                        <p class="text-white font-bold text-xl">
                            {{ $productTransaction->created_at }}
                        </p>
                    </div>
                    <div class="bg-gray-700/50 p-4 rounded-lg">
                        <p class="text-sm text-gray-300">Total Items</p>
                        <p class="text-white font-bold text-xl">
                            {{ $productTransaction->transactionDetails->sum('quantity') }} items
                        </p>
                    </div>
                </div>

                <!-- Payment Status indicator remains as is -->
                <div class="bg-gray-700/50 p-4 rounded-lg flex items-center mt-4">
                    @if($productTransaction->status === 'approved')
                    <span class="font-bold py-1 px-4 rounded-full text-white bg-green-500 text-sm w-full text-center">
                        APPROVED
                    </span>
                    @elseif($productTransaction->status === 'cancelled')
                    <span class="font-bold py-1 px-4 rounded-full text-white bg-red-500 text-sm w-full text-center">
                        CANCELLED
                    </span>
                    @else
                    <span class="font-bold py-1 px-4 rounded-full text-white bg-orange-500 text-sm w-full text-center">
                        PENDING
                    </span>
                    @endif
                </div>
                <hr class="border-gray-700 my-6">
                <!-- Main Content -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Items List -->
                    <div class="lg:col-span-2">
                        <h3 class="text-white font-bold text-xl mb-4">List of Items</h3>
                        <div class="space-y-4">
                            @forelse($productTransaction->transactionDetails as $detail)
                            <div class="bg-gray-700/50 p-4 rounded-lg flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                <div class="flex items-center gap-4 flex-1 min-w-0">
                                    <img src="{{ Storage::url($detail->product->photo) }}" alt="Product Photo"
                                        class="w-16 h-16 rounded-lg object-cover">
                                    <div class="min-w-0">
                                        <h4 class="text-white font-bold truncate">{{ $detail->product->name }}</h4>
                                        <p class="text-gray-300 text-sm">
                                            {{ $detail->product->category->name }}
                                        </p>
                                        <p class="text-gray-400 text-sm mt-1">
                                            Quantity: {{ $detail->quantity }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-white font-bold">
                                        Rp {{ number_format($detail->product->price, 0, ',', '.') }}
                                    </p>
                                    <p class="text-sm text-gray-300">
                                        Total: Rp {{ number_format($detail->product->price * $detail->quantity, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            @empty
                            <div class="bg-gray-700/50 p-6 rounded-lg text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11.414V15a1 1 0 11-2 0v-1.586l-.293-.293a1 1 0 011.414-1.414L11 12.586zM10 4a6 6 0 100 12A6 6 0 0010 4z" />
                                </svg>
                                <p class="text-gray-400">No items found</p>
                            </div>
                            @endforelse
                        </div>
                        <!-- Delivery Info -->
                        <h3 class="text-white font-bold text-xl mt-8 mb-4">Delivery Information</h3>
                        <div class="bg-gray-700/50 p-6 rounded-lg space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <p class="text-sm text-gray-300">Address</p>
                                    <p class="text-white font-medium">{{ $productTransaction->address }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-300">City</p>
                                    <p class="text-white font-medium">{{ $productTransaction->city }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-300">Postal Code</p>
                                    <p class="text-white font-medium">{{ $productTransaction->post_code }}</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Phone Number</p>
                                <p class="text-white font-medium">{{ $productTransaction->phone_number }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Notes</p>
                                <p class="text-white font-medium whitespace-pre-line">{{ $productTransaction->notes ?: '-' }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Proof of Payment -->
                    <div class="lg:col-span-1">
                        <h3 class="text-white font-bold text-xl mb-4">Proof of Payment</h3>
                        <div class="bg-gray-700/50 p-4 rounded-lg">
                            <img src="{{ Storage::url($productTransaction->proof) }}" alt="Payment Proof"
                                class="w-full h-auto max-h-[400px] object-contain rounded">
                        </div>
                        <!-- Action Buttons -->
                        <div class="mt-6 space-y-3">
                            @role('owner')
                            @if($productTransaction->status === 'approved')
                            <a href="https://web.whatsapp.com/" target="_blank" class="block w-full text-center py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded transition">
                                Contact Customer
                            </a>
                            @elseif($productTransaction->status === 'pending')
                            <div class="flex gap-3">
                                <form method="POST" action="{{ route('admin.product_transactions.update', $productTransaction) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="w-full py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded transition">
                                        Approve Order
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.product_transactions.update', $productTransaction) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="w-full py-2 px-4 bg-red-600 hover:bg-red-700 text-white rounded transition">
                                        Cancel Order
                                    </button>
                                </form>
                            </div>
                            @elseif($productTransaction->status === 'cancelled')
                            <div class="flex gap-3">
                                <form method="POST" action="{{ route('admin.product_transactions.update', $productTransaction) }}" class="w-full">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="w-full py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded transition">
                                        Re-approve Order
                                    </button>
                                </form>
                            </div>
                            <a href="https://web.whatsapp.com/" target="_blank" class="block w-full text-center py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded transition">
                                Contact Customer
                            </a>
                            @endif
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>