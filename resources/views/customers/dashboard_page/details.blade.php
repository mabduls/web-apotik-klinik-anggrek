<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | Klinik Anggrek</title>
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
                <h1 class="text-2xl font-bold text-gray-800">Product Details</h1>
                <button type="button" class="p-2 hover:bg-blue-100 rounded-full transition">
                    <img src="{{ asset('assets/svgs/ic-triple-dots.svg') }}" class="w-5 h-5 filter-to-grey hover:filter-to-primary" alt="">
                </button>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-6 py-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Product Image Section -->
                    <div class="flex items-center justify-center p-8 bg-gradient-to-br from-blue-100 to-purple-100">
                        <img src="{{ Storage::url($product->photo) }}" class="max-h-96 object-contain" alt="{{ $product->name }}">
                    </div>

                    <!-- Product Details Section -->
                    <div class="p-8 flex flex-col gap-6">
                        <!-- Product Header -->
                        <div class="border-b border-gray-200 pb-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h2>
                                    <div class="flex items-center gap-2">
                                        <img src="{{ Storage::url($product->category->icon) }}" class="w-8 h-8" alt="">
                                        <p class="text-lg font-medium text-gray-700">{{ $product->category->name }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1 bg-blue-50 px-3 py-1 rounded-xl">
                                    <img src="{{ asset('assets/svgs/star.svg') }}" class="w-6 h-6 text-yellow-400" alt="">
                                    <p class="font-bold text-lg text-blue-500">4.5/5</p>
                                </div>
                            </div>

                            <p class="text-lg leading-relaxed text-gray-600">{{ $product->about }}</p>
                        </div>

                        <!-- Product Features -->
                        <div class="py-4">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Features</h3>
                            <div class="flex flex-wrap gap-4">
                                <div class="flex items-center gap-3 border border-blue-100 rounded-xl p-4 bg-blue-50">
                                    <img src="{{ asset('assets/svgs/ic-cup-filled.svg') }}" class="w-8 h-8 filter-to-primary" alt="">
                                    <p class="text-base font-medium text-gray-700">Popular</p>
                                </div>
                                <div class="flex items-center gap-3 border border-purple-100 rounded-xl p-4 bg-purple-50">
                                    <img src="{{ asset('assets/svgs/ic-thumb-shape-filled.svg') }}" class="w-8 h-8 filter-to-primary" alt="">
                                    <p class="text-base font-medium text-gray-700">Grade A</p>
                                </div>
                                <div class="flex items-center gap-3 border border-green-100 rounded-xl p-4 bg-green-50">
                                    <img src="{{ asset('assets/svgs/ic-clipboard-tick-filled.svg') }}" class="w-8 h-8 filter-to-primary" alt="">
                                    <p class="text-base font-medium text-gray-700">Healthy</p>
                                </div>
                                <div class="flex items-center gap-3 border border-blue-100 rounded-xl p-4 bg-blue-50">
                                    <img src="{{ asset('assets/svgs/ic-shiled-tick-filled.svg') }}" class="w-8 h-8 filter-to-primary" alt="">
                                    <p class="text-base font-medium text-gray-700">Official</p>
                                </div>
                            </div>
                        </div>

                        <!-- User Reviews -->
                        <div class="border-t border-b border-gray-200 py-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Customer Reviews</h3>
                            <div class="bg-blue-50 p-4 rounded-xl">
                                <p class="text-lg text-gray-700 mb-3">
                                    "My kid was happier whenever he is playing
                                    without artificial toys, full energy yeah!"
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <img src="{{ asset('assets/images/photo.png') }}" class="w-10 h-10 rounded-full" alt="">
                                        <p class="text-base font-semibold text-gray-800">Safira</p>
                                    </div>
                                    <div class="flex">
                                        <img src="{{ asset('assets/svgs/star.svg') }}" class="w-5 h-5 text-yellow-400" alt="">
                                        <img src="{{ asset('assets/svgs/star.svg') }}" class="w-5 h-5 text-yellow-400" alt="">
                                        <img src="{{ asset('assets/svgs/star.svg') }}" class="w-5 h-5 text-yellow-400" alt="">
                                        <img src="{{ asset('assets/svgs/star.svg') }}" class="w-5 h-5 text-yellow-400" alt="">
                                        <img src="{{ asset('assets/svgs/star.svg') }}" class="w-5 h-5 text-yellow-400" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Price and CTA -->
                        <div class="flex items-center justify-between mt-6">
                            <div>
                                <p class="text-3xl font-bold text-blue-500">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="text-gray-500">/quantity</p>
                            </div>
                            <form action="{{ route('customers.dashboard.page.cart.store', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-gradient-to-r from-blue-400 to-purple-400 text-white font-bold text-lg px-8 py-3 rounded-xl hover:from-blue-500 hover:to-purple-500 transition shadow-md">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="{{ asset('scripts/sliderConfig.js') }}" type="module"></script>
</body>

</html>