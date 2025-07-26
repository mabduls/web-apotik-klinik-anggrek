<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Your Cart | Klinik Anggrek</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .filter-to-primary {
            filter: invert(48%) sepia(79%) saturate(2476%) hue-rotate(225deg) brightness(100%) contrast(93%);
        }

        .filter-to-grey {
            filter: invert(74%) sepia(6%) saturate(0%) hue-rotate(180deg) brightness(91%) contrast(87%);
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            animation: modalAppear 0.3s ease-out;
        }

        @keyframes modalAppear {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                <h1 class="text-2xl font-bold text-gray-800">Your Cart</h1>
                <div class="w-5"></div> <!-- Empty div for alignment -->
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-6 py-8">
            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg flex justify-between items-center" role="alert">
                <div class="flex items-center">
                    <a href="{{ route('customers.transaction.page') }}" class="text-green-700 hover:text-green-800 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <p>{{ session('success') }}</p>
                </div>
                <button type="button" class="text-green-700 hover:text-green-800" onclick="this.parentElement.style.display='none'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg flex justify-between items-center" role="alert">
                <p>{{ session('error') }}</p>
                <button type="button" class="text-red-700 hover:text-red-800" onclick="this.parentElement.style.display='none'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items Section -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h2 class="text-xl font-bold text-gray-800">Cart Items ({{ $my_carts->count() }})</h2>
                                @if($my_carts->count() > 0)
                                <button id="clear-all-button" class="text-gray-500 hover:text-red-500 text-sm font-medium transition">Clear all</button>
                                @endif
                            </div>
                        </div>

                        @forelse($my_carts as $cart)
                        <div class="p-6 border-b border-gray-200 last:border-b-0 flex flex-col md:flex-row gap-6 items-center cart-item" data-id="{{ $cart->id }}">
                            <!-- Product Image -->
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-purple-100 rounded-xl flex items-center justify-center">
                                <img src="{{ Storage::url($cart->product->photo) }}" class="max-h-20 max-w-20 object-contain" alt="{{ $cart->product->name }}">
                            </div>

                            <!-- Product Details -->
                            <div class="flex-1">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-800">{{ $cart->product->name }}</h3>
                                        <div class="flex items-center gap-2 mt-1">
                                            <img src="{{ Storage::url($cart->product->category->icon) }}" class="w-5 h-5" alt="">
                                            <p class="text-sm text-gray-600">{{ $cart->product->category->name }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-xl text-blue-500 product-price" data-price="{{ $cart->product->price }}">
                                            Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center justify-between mt-4">
                                    <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden">
                                        <button class="px-3 py-1 bg-blue-50 hover:bg-blue-100 text-blue-500 transition quantity-decrease">-</button>
                                        <span class="px-4 py-1 text-center min-w-[40px] bg-white product-quantity">{{ $cart->quantity ?? 1 }}</span>
                                        <button class="px-3 py-1 bg-blue-50 hover:bg-blue-100 text-blue-500 transition quantity-increase">+</button>
                                    </div>
                                    <form action="{{ route('customers.dashboard.page.cart.remove', $cart->id) }}" method="POST" class="ml-auto remove-item-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="text-red-500 hover:text-red-600 font-medium flex items-center transition remove-button">
                                            <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="p-16 flex flex-col items-center justify-center text-center">
                            <img src="{{ asset('assets/svgs/ic-shopping-bag.svg') }}" class="w-24 h-24 mb-4 opacity-50" alt="Empty Cart">
                            <h3 class="text-xl font-bold mb-2 text-gray-800">Your Cart is Empty</h3>
                            <p class="text-gray-500 mb-6">Looks like you haven't added any products to your cart yet.</p>
                            <a href="{{ route('customers.dashboard.page.index') }}" class="bg-gradient-to-r from-blue-400 to-purple-400 text-white font-medium px-6 py-2 rounded-xl hover:from-blue-500 hover:to-purple-500 transition shadow-md">
                                Browse Products
                            </a>
                        </div>
                        @endforelse
                    </div>

                    <!-- Delivery Information Form -->
                    @if($my_carts->count() > 0)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-gray-800">Delivery Information</h2>
                        </div>
                        <div class="p-6">
                            <div id="delivery-form-container">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="col-span-2">
                                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Full Address</label>
                                        <textarea id="address" name="address" rows="3" class="w-full border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-300 focus:border-blue-300 px-4 py-2 transition" placeholder="Enter your full address" required></textarea>
                                    </div>

                                    <div>
                                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                        <input type="text" id="city" name="city" class="w-full border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-300 focus:border-blue-300 px-4 py-2 transition" placeholder="Enter your city" required>
                                    </div>

                                    <div>
                                        <label for="post_code" class="block text-sm font-medium text-gray-700 mb-2">Postal Code</label>
                                        <input type="text" id="post_code" name="post_code" class="w-full border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-300 focus:border-blue-300 px-4 py-2 transition" placeholder="Enter postal code" required>
                                        <!-- Pesan error akan ditambahkan di sini secara otomatis -->
                                    </div>

                                    <div>
                                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                        <input type="tel" id="phone_number" name="phone_number" class="w-full border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-300 focus:border-blue-300 px-4 py-2 transition" placeholder="Enter your phone number" required>
                                        <!-- Pesan error akan ditambahkan di sini secara otomatis -->
                                    </div>

                                    <div>
                                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Additional Notes (Optional)</label>
                                        <input type="text" id="notes" name="notes" class="w-full border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-300 focus:border-blue-300 px-4 py-2 transition" placeholder="Any special instructions for delivery">
                                    </div>

                                    <div class="col-span-2">
                                        <label for="proof_file" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                            Proof of Payment
                                        </label>
                                        <div id="file-input-container">
                                            <input type="file" id="proof_file" class="w-full border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-300 focus:border-blue-300 px-4 py-2 transition" accept="image/*,.pdf" required style="display: none;">
                                            <button type="button" onclick="document.getElementById('proof_file').click()" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-left bg-white">
                                                <span id="proof-file-name">Select a file...</span>
                                            </button>
                                            <p class="text-sm text-gray-500 mt-1">Upload a photo or PDF of your payment receipt.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Order Summary Section -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden sticky top-6">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-gray-800">Order Summary</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-medium text-gray-800" id="checkout-subtotal">
                                        Rp 0
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">PPN</span>
                                    <span class="font-medium text-gray-800" id="checkout-ppn">
                                        Rp 0
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Delivery Fee</span>
                                    <span class="font-medium text-gray-800" id="checkout-delivery-fee">
                                        Rp 0
                                    </span>
                                </div>
                                <div class="border-t border-gray-200 pt-4 mt-4">
                                    <div class="flex justify-between">
                                        <span class="font-bold text-lg text-gray-800">Total</span>
                                        <span class="font-bold text-lg text-blue-500" id="checkout-total">
                                            Rp 0
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Methods Section -->
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Payment Method</label>

                                <div class="space-y-3">
                                    <!-- Manual Transfer Option -->
                                    <div class="border border-gray-200 rounded-xl p-3 hover:border-blue-300 transition cursor-pointer payment-option" data-payment="manual">
                                        <div class="flex items-center">
                                            <input type="radio" id="payment-manual" name="payment_method" value="manual" class="h-4 w-4 text-blue-500 focus:ring-blue-400">
                                            <label for="payment-manual" class="ml-3 block font-medium text-gray-700 cursor-pointer flex items-center">
                                                <img src="{{ asset('assets/svgs/ic-bank.svg') }}" class="w-5 h-5 mr-2" alt="Bank">
                                                Manual Bank Transfer
                                            </label>
                                        </div>
                                    </div>

                                    <!-- E-Wallet Option -->
                                    <div class="border border-gray-200 rounded-xl p-3 hover:border-blue-300 transition cursor-pointer payment-option" data-payment="ewallet">
                                        <div class="flex items-center">
                                            <input type="radio" id="payment-ewallet" name="payment_method" value="ewallet" class="h-4 w-4 text-blue-500 focus:ring-blue-400">
                                            <label for="payment-ewallet" class="ml-3 block font-medium text-gray-700 cursor-pointer flex items-center">
                                                <img src="{{ asset('assets/svgs/ic-shopping-bag.svg') }}" class="w-5 h-5 mr-2" alt="E-Wallet">
                                                E-Wallet
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Details (conditionally shown) -->
                                <div id="manual-payment-details" class="mt-4 bg-blue-50 p-4 rounded-xl hidden">
                                    <p class="text-sm font-medium text-blue-600 mb-2">Bank Transfer Details:</p>
                                    <div class="bg-white p-3 rounded-lg border border-blue-100">
                                        <p class="text-gray-700"><span class="font-medium">Bank:</span> Bank Syariah Indonesia (BSI)</p>
                                        <p class="text-gray-700"><span class="font-medium">Account Number:</span> 7177535227</p>
                                        <p class="text-gray-700 text-sm mt-2">Please upload your payment proof after checkout.</p>
                                    </div>
                                </div>

                                <div id="ewallet-payment-details" class="mt-4 bg-blue-50 p-4 rounded-xl hidden">
                                    <p class="text-sm font-medium text-blue-600 mb-2">E-Wallet Payment:</p>
                                    <div class="bg-white p-3 rounded-lg border border-blue-100">
                                        <p class="text-gray-700">You will be redirected to our payment processor after checkout.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Checkout Button-->
                            <div class="mt-6">
                                <form action="{{ route('customers.transaction.store') }}" method="POST" id="checkout-form" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Hidden fields for delivery info -->
                                    <input type="hidden" name="address" id="form-address">
                                    <input type="hidden" name="city" id="form-city">
                                    <input type="hidden" name="post_code" id="form-post-code">
                                    <input type="hidden" name="phone_number" id="form-phone-number">
                                    <input type="hidden" name="notes" id="form-notes">
                                    <input type="hidden" name="total_amount" id="form-total-amount">
                                    <input type="hidden" name="payment_method" id="form-payment-method">

                                    <!-- File input untuk bukti pembayaran -->
                                    <input type="file" name="proof" id="proof_of_payment" style="display: none;">

                                    <button type="submit" id="checkout-button"
                                        class="w-full bg-gradient-to-r from-blue-400 to-purple-400 text-white font-bold text-lg px-6 py-3 rounded-xl hover:from-blue-500 hover:to-purple-500 transition shadow-md"
                                        {{ $my_carts->count() == 0 ? 'disabled' : '' }}>
                                        Proceed to Checkout
                                    </button>
                                </form>
                                <a href="{{ route('customers.dashboard.page.index') }}" class="w-full block text-center mt-4 text-blue-500 font-medium hover:text-blue-600 transition">
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmation-modal" class="modal">
        <div class="modal-content">
            <div class="text-center py-4">
                <svg class="w-16 h-16 text-yellow-500 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <h3 class="text-xl font-bold text-gray-800 mb-2" id="modal-title">Confirmation</h3>
                <p class="text-gray-600 mb-6" id="modal-message">Are you sure you want to remove this item from your cart?</p>
                <div class="flex justify-center space-x-4">
                    <button id="modal-cancel" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">Cancel</button>
                    <button id="modal-confirm" class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Remove</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="{{ asset('scripts/sliderConfig.js') }}" type="module"></script>
    <script>
        // This script should replace the current JavaScript in cart.blade.php

        document.addEventListener('DOMContentLoaded', function() {
            function updateCartQuantity(cartId, quantity) {
                // Get the CSRF token from the meta tag
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Use the correct route URL
                fetch(`/customers/cart/${cartId}/update-quantity`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            quantity: quantity
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to update quantity');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // Update was successful
                            calculatePrice();
                        } else {
                            console.error('Failed to update quantity:', data.message);
                            // Restore previous quantity on failure
                            const quantityElement = document.querySelector(`.cart-item[data-id="${cartId}"] .product-quantity`);
                            quantityElement.textContent = parseInt(quantityElement.textContent) - (quantity > parseInt(quantityElement.textContent) ? 1 : -1);
                            calculatePrice();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Restore previous quantity on error
                        const quantityElement = document.querySelector(`.cart-item[data-id="${cartId}"] .product-quantity`);
                        quantityElement.textContent = parseInt(quantityElement.textContent) - (quantity > parseInt(quantityElement.textContent) ? 1 : -1);
                        calculatePrice();
                    });
            }

            // Calculate total price function
            function calculatePrice() {
                let subTotal = 0;
                let deliveryFee = 10000;

                document.querySelectorAll('.cart-item').forEach(item => {
                    const priceElement = item.querySelector('.product-price');
                    const quantityElement = item.querySelector('.product-quantity');

                    const price = parseFloat(priceElement.getAttribute('data-price'));
                    const quantity = parseInt(quantityElement.textContent);

                    subTotal += price * quantity;
                });

                const formattedDeliveryFee = deliveryFee.toLocaleString('id');
                document.getElementById('checkout-delivery-fee').textContent = 'Rp ' + formattedDeliveryFee;

                const formattedSubtotal = subTotal.toLocaleString('id');
                document.getElementById('checkout-subtotal').textContent = 'Rp ' + formattedSubtotal;

                const tax = subTotal * 11 / 100;
                const formattedTax = tax.toLocaleString('id');
                document.getElementById('checkout-ppn').textContent = 'Rp ' + formattedTax;

                const total = subTotal + tax + deliveryFee;
                const formattedTotal = total.toLocaleString('id');
                document.getElementById('checkout-total').textContent = 'Rp ' + formattedTotal;

                document.getElementById('form-total-amount').value = total;
            }

            // Show modal function
            function showModal(title, message, action, itemId = null) {
                const modal = document.getElementById('confirmation-modal');
                const modalTitle = document.getElementById('modal-title');
                const modalMessage = document.getElementById('modal-message');
                const modalConfirm = document.getElementById('modal-confirm');

                modalTitle.textContent = title;
                modalMessage.textContent = message;
                window.actionType = action;
                window.currentItemId = itemId;

                if (action === 'remove' || action === 'clear-all' || action === 'zero-quantity') {
                    modalConfirm.textContent = 'Remove';
                    modalConfirm.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                    modalConfirm.classList.add('bg-red-500', 'hover:bg-red-600');
                }

                modal.style.display = 'block';
            }

            // Hide modal function
            function hideModal() {
                const modal = document.getElementById('confirmation-modal');
                modal.style.display = 'none';
            }

            // Initialize functions
            calculatePrice();

            // Payment options
            const paymentOptions = document.querySelectorAll('.payment-option');
            if (paymentOptions.length === 1) {
                paymentOptions[0].click();
            }

            // File upload handling
            document.getElementById('proof_file').addEventListener('change', function() {
                const fileName = this.files[0] ? this.files[0].name : 'Select a file...';
                document.getElementById('proof-file-name').textContent = fileName;

                if (this.files && this.files[0]) {
                    const fileSize = this.files[0].size / 1024 / 1024; // in MB
                    const fileType = this.files[0].type;

                    if (fileSize > 5) {
                        alert('File too large. Maximum size is 5MB.');
                        this.value = '';
                        document.getElementById('proof-file-name').textContent = 'Select a file...';
                        return;
                    }

                    if (!['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'].includes(fileType)) {
                        alert('Invalid file type. Please upload an image (JPG, PNG) or PDF file.');
                        this.value = '';
                        document.getElementById('proof-file-name').textContent = 'Select a file...';
                        return;
                    }

                    // Copy file to the actual form input
                    const proofPaymentInput = document.getElementById('proof_of_payment');

                    // Create a new FileList object
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(this.files[0]);
                    proofPaymentInput.files = dataTransfer.files;
                }
            });

            // Cart items quantity handling
            document.querySelectorAll('.cart-item').forEach(item => {
                const quantityElement = item.querySelector('.product-quantity');
                const increaseBtn = item.querySelector('.quantity-increase');
                const decreaseBtn = item.querySelector('.quantity-decrease');

                increaseBtn.addEventListener('click', function() {
                    const currentQuantity = parseInt(quantityElement.textContent);
                    const newQuantity = currentQuantity + 1;
                    quantityElement.textContent = newQuantity;

                    // Update UI harga langsung
                    calculatePrice();

                    // Update quantity di database via AJAX
                    updateCartQuantity(item.dataset.id, newQuantity);
                });

                decreaseBtn.addEventListener('click', function() {
                    const currentQuantity = parseInt(quantityElement.textContent);

                    if (currentQuantity > 1) {
                        const newQuantity = currentQuantity - 1;
                        quantityElement.textContent = newQuantity;

                        // Update UI harga langsung
                        calculatePrice();

                        // Update quantity di database via AJAX
                        updateCartQuantity(item.dataset.id, newQuantity);
                    } else {
                        const itemId = item.dataset.id;
                        showModal(
                            'Remove Item',
                            'The quantity will be zero. Remove this item from your cart?',
                            'zero-quantity',
                            itemId
                        );
                    }
                });
            });

            // Payment option selection
            document.querySelectorAll('.payment-option').forEach(option => {
                option.addEventListener('click', function() {
                    const paymentType = this.dataset.payment;
                    const radioInput = this.querySelector('input[type="radio"]');

                    // Check the radio button
                    radioInput.checked = true;

                    // Update hidden field for checkout
                    document.getElementById('form-payment-method').value = paymentType;

                    // Show/hide payment details
                    if (paymentType === 'manual') {
                        document.getElementById('manual-payment-details').classList.remove('hidden');
                        document.getElementById('ewallet-payment-details').classList.add('hidden');
                    } else if (paymentType === 'ewallet') {
                        document.getElementById('manual-payment-details').classList.add('hidden');
                        document.getElementById('ewallet-payment-details').classList.remove('hidden');
                    }
                });
            });

            // Form validation and submission
            document.getElementById('checkout-form').addEventListener('submit', function(e) {
                e.preventDefault();

                // Validasi manual
                const address = document.getElementById('address').value;
                const city = document.getElementById('city').value;
                const postCode = document.getElementById('post_code').value;
                const phone = document.getElementById('phone_number').value;
                const paymentMethod = document.getElementById('form-payment-method').value;
                const proofFile = document.getElementById('proof_of_payment').files[0];

                if (!address || !city || !postCode || !phone) {
                    alert('Harap lengkapi semua informasi pengiriman');
                    return false;
                }

                if (!paymentMethod) {
                    alert('Harap pilih metode pembayaran');
                    return false;
                }

                if (!proofFile) {
                    alert('Harap upload bukti pembayaran');
                    return false;
                }

                // Transfer data ke hidden fields
                document.getElementById('form-address').value = address;
                document.getElementById('form-city').value = city;
                document.getElementById('form-post-code').value = postCode;
                document.getElementById('form-phone-number').value = phone;
                document.getElementById('form-notes').value = document.getElementById('notes').value;

                // Submit the form
                this.submit();
            });

            // Modal event handlers
            const modalConfirm = document.getElementById('modal-confirm');
            const modalCancel = document.getElementById('modal-cancel');
            const modal = document.getElementById('confirmation-modal');

            // Clear all button
            const clearAllButton = document.getElementById('clear-all-button');
            if (clearAllButton) {
                clearAllButton.addEventListener('click', function() {
                    showModal('Clear Cart', 'Are you sure you want to remove all items from your cart?', 'clear-all');
                });
            }

            // Remove item buttons
            document.querySelectorAll('.remove-button').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const itemId = this.closest('.cart-item').dataset.id;
                    showModal('Remove Item', 'Are you sure you want to remove this product from your cart?', 'remove', itemId);
                });
            });

            // Modal confirm action
            modalConfirm.addEventListener('click', function() {
                if (window.actionType === 'remove' || window.actionType === 'zero-quantity') {
                    const form = document.querySelector(`.cart-item[data-id="${window.currentItemId}"] .remove-item-form`);

                    if (form) {
                        form.submit();
                    } else {
                        fetch(`/customers/dashboard/cart/${window.currentItemId}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    _method: 'DELETE'
                                })
                            })
                            .then(response => {
                                if (response.ok) {
                                    window.location.reload();
                                } else {
                                    throw new Error('Failed to remove item');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Failed to remove item. Please try again.');
                            });
                    }
                } else if (window.actionType === 'clear-all') {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "/customers/dashboard/cart";

                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    form.appendChild(csrfInput);

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    document.body.appendChild(form);
                    form.submit();
                }
                hideModal();
            });

            // Validasi real-time untuk input nomor telepon dan kode pos
            document.getElementById('phone_number').addEventListener('input', function(e) {
                validateNumericInput(this, 'Nomor telepon harus berupa angka');
            });

            document.getElementById('post_code').addEventListener('input', function(e) {
                validateNumericInput(this, 'Kode pos harus berupa angka');
            });

            function validateNumericInput(inputElement, errorMessage) {
                const value = inputElement.value;
                const errorElementId = inputElement.id + '_error';
                let errorElement = document.getElementById(errorElementId);

                // Hanya izinkan input angka
                inputElement.value = value.replace(/[^0-9]/g, '');

                // Cek apakah ada karakter non-angka yang dihapus
                if (value !== inputElement.value) {
                    // Buat atau perbarui elemen error jika belum ada
                    if (!errorElement) {
                        errorElement = document.createElement('p');
                        errorElement.id = errorElementId;
                        errorElement.className = 'text-red-500 text-sm mt-1';
                        inputElement.parentNode.appendChild(errorElement);
                    }
                    errorElement.textContent = errorMessage;
                    inputElement.classList.add('border-red-500');
                } else {
                    // Hapus pesan error dan styling jika valid
                    if (errorElement) {
                        errorElement.remove();
                    }
                    inputElement.classList.remove('border-red-500');
                }
            }

            // Validasi sebelum submit form
            document.getElementById('checkout-form').addEventListener('submit', function(e) {
                const phoneNumber = document.getElementById('phone_number').value;
                const postCode = document.getElementById('post_code').value;
                let isValid = true;

                // Validasi nomor telepon
                if (!/^\d{10,15}$/.test(phoneNumber)) {
                    showInputError('phone_number', 'Nomor telepon harus 10-15 digit angka');
                    isValid = false;
                }

                // Validasi kode pos
                if (!/^\d{5}$/.test(postCode)) {
                    showInputError('post_code', 'Kode pos harus 5 digit angka');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                    // Scroll ke error pertama
                    document.querySelector('.border-red-500')?.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            });

            function showInputError(inputId, message) {
                const inputElement = document.getElementById(inputId);
                const errorElementId = inputId + '_error';
                let errorElement = document.getElementById(errorElementId);

                if (!errorElement) {
                    errorElement = document.createElement('p');
                    errorElement.id = errorElementId;
                    errorElement.className = 'text-red-500 text-sm mt-1';
                    inputElement.parentNode.appendChild(errorElement);
                }

                errorElement.textContent = message;
                inputElement.classList.add('border-red-500');
            }

            // Modal cancel action
            modalCancel.addEventListener('click', hideModal);

            // Close modal when clicking outside
            window.addEventListener('click', function(e) {
                if (e.target === modal) {
                    hideModal();
                }
            });
        });
    </script>
</body>