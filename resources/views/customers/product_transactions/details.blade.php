<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Details | Klinik Anggrek</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .filter-to-primary {
            filter: invert(48%) sepia(79%) saturate(2476%) hue-rotate(225deg) brightness(100%) contrast(93%);
        }

        .filter-to-grey {
            filter: invert(74%) sepia(6%) saturate(0%) hue-rotate(180deg) brightness(91%) contrast(87%);
        }

        .stretched-link::after {
            content: "";
            @apply absolute inset-0 z-10;
        }

        .status-badge {
            @apply font-bold py-1.5 px-4 rounded-full text-white text-sm;
        }

        .status-success {
            @apply bg-green-400;
        }

        .status-pending {
            @apply bg-orange-400;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-purple-50">
    <main class="flex-grow container mx-auto px-4 py-6 mt-16">
        <!-- Main Content -->
        <div class="col-span-12 md:col-span-10 lg:col-span-10">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        Order Details
                    </h2>
                    <p class="text-gray-600">Transaction ID: #{{ $productTransaction->id }}</p>
                </div>

                <a href="{{ route('customers.transaction.page') }}" class="flex items-center gap-2 text-blue-500 hover:text-blue-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    <span>Back to Transaction</span>
                </a>
            </div>

            <!-- Status Card -->
            <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-gray-600 mb-1">Order Status</p>
                        @if($productTransaction->is_paid)
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
                    <div>
                        <p class="text-gray-600 mb-1">Order Date</p>
                        <p class="font-semibold text-gray-800">{{ $productTransaction->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 mb-1">Total Amount</p>
                        <p class="font-bold text-blue-500 text-xl">Rp {{ number_format($productTransaction->total_amount, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Order Items -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Items List -->
                    <div class="bg-white rounded-2xl shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Order Items ({{ $productTransaction->transactionDetails->sum('quantity') }})</h3>

                        <div class="space-y-4">
                            @forelse($productTransaction->transactionDetails as $detail)
                            <div class="flex items-start gap-4 p-4 border border-gray-100 rounded-xl hover:bg-blue-50 transition-colors">
                                <img src="{{ Storage::url($detail->product->photo) }}" alt="Product Photo" class="w-16 h-16 rounded-lg object-contain">

                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-800 truncate">{{ $detail->product->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $detail->product->category->name }}</p>
                                    <p class="text-sm text-gray-500 mt-1">Quantity: {{ $detail->quantity }}</p>
                                </div>

                                <div class="text-right">
                                    <p class="font-semibold text-gray-800">Rp {{ number_format($detail->product->price, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-500">Total: Rp {{ number_format($detail->product->price * $detail->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-gray-500 mt-2">No items found in this order</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Delivery Information -->
                    <div class="bg-white rounded-2xl shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Delivery Information</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Recipient</p>
                                <p class="font-medium text-gray-800 p-3 bg-gray-200 rounded-lg">{{ Auth::user()->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Phone Number</p>
                                <p class="font-medium text-gray-800 p-3 bg-gray-200 rounded-lg">{{ $productTransaction->phone_number }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">City</p>
                                <p class="font-medium text-gray-800 p-3 bg-gray-200 rounded-lg">{{ $productTransaction->city }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Postal Code</p>
                                <p class="font-medium text-gray-800 p-3 bg-gray-200 rounded-lg">{{ $productTransaction->post_code }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 mb-1">Address</p>
                                <p class="font-medium text-gray-800 p-3 bg-gray-200 rounded-lg min-h-16">{{ $productTransaction->address }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500 mb-1">Notes</p>
                                <p class="font-medium text-gray-800 p-3 bg-gray-200 rounded-lg min-h-16">
                                    {{ $productTransaction->notes ?: 'No additional notes' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Summary -->
                <div class="space-y-6">
                    <!-- Payment Proof -->
                    <div class="space-y-6">
                        <!-- Payment Proof - DIKANAN -->
                        <div class="bg-white rounded-2xl shadow-md p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Payment Proof</h3>
                            <div class="border-2 border-dashed border-gray-200 rounded-lg p-4 flex justify-center items-center">
                                <img src="{{ Storage::url($productTransaction->proof) }}"
                                    alt="Payment Proof"
                                    class="max-w-full h-auto max-h-64 object-contain">
                            </div>
                            <div class="mt-4 text-center">
                                <p class="text-sm text-gray-500">Uploaded on {{ $productTransaction->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="bg-white rounded-2xl shadow-md p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Order Summary</h3>

                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <p class="text-gray-600">Subtotal</p>
                                    <p class="font-medium">Rp {{ number_format($productTransaction->total_amount, 0, ',', '.') }}</p>
                                </div>
                                <div class="flex justify-between">
                                    <p class="text-gray-600">Shipping</p>
                                    <p class="font-medium">Free</p>
                                </div>
                                <div class="flex justify-between">
                                    <p class="text-gray-600">Tax</p>
                                    <p class="font-medium">Rp 0</p>
                                </div>
                                <div class="border-t border-gray-200 pt-3 mt-2">
                                    <div class="flex justify-between">
                                        <p class="font-bold text-gray-800">Total</p>
                                        <p class="font-bold text-blue-500">Rp {{ number_format($productTransaction->total_amount, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-6 space-y-3">
                                <a href="https://web.whatsapp.com/" target="_blank" class="block w-full text-center border border-blue-500 text-blue-500 hover:bg-blue-50 py-2.5 px-4 rounded-xl font-semibold transition-colors">
                                    Contact Support
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-6 mt-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <p class="font-semibold text-blue-500">© 2025 Klinik Anggrek. All rights reserved.</p>
                </div>
                <div class="flex gap-6">
                    <a href="#" class="text-gray-600 hover:text-blue-500 transition">Terms</a>
                    <a href="#" class="text-gray-600 hover:text-blue-500 transition">Privacy</a>
                    <a href="#" class="text-gray-600 hover:text-blue-500 transition">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>