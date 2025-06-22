<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Welcome Back</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .floating-animation {
            animation: floating 3s ease-in-out infinite;
        }

        .floating-delayed {
            animation: floating 3s ease-in-out infinite;
            animation-delay: 1.5s;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.7;
            }

            50% {
                transform: translateY(-20px) rotate(2deg);
                opacity: 1;
            }
        }

        .slide-in {
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gradient-border {
            background: linear-gradient(135deg, #E0E7FF, #F3E8FF, #FCE7F3);
            padding: 2px;
            border-radius: 24px;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-glow:focus {
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.3);
        }

        .btn-hover {
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(167, 139, 250, 0.3);
        }

        .bubble {
            position: absolute;
            background: linear-gradient(135deg, #A7F3D0, #DBEAFE, #E0E7FF);
            border-radius: 50%;
            opacity: 0.6;
            animation: bubble 4s infinite ease-in-out;
        }

        @keyframes bubble {

            0%,
            100% {
                transform: translateY(0) scale(1);
                opacity: 0.6;
            }

            50% {
                transform: translateY(-100px) scale(1.1);
                opacity: 0.8;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-pink-50 relative overflow-hidden">
    <!-- Floating Background Elements -->
    <div class="bubble w-20 h-20 top-10 left-10 floating-animation"></div>
    <div class="bubble w-32 h-32 top-20 right-20 floating-delayed"></div>
    <div class="bubble w-16 h-16 bottom-20 left-20 floating-animation" style="animation-delay: 2s;"></div>
    <div class="bubble w-24 h-24 bottom-10 right-10 floating-delayed" style="animation-delay: 0.5s;"></div>

    <div class="relative z-10 min-h-screen flex items-center justify-center p-4">
        <!-- Changed max-w-md to max-w-2xl for wider desktop view -->
        <div class="w-full max-w-md md:max-w-2xl slide-in">
            <!-- Main Card -->
            <div class="gradient-border">
                <div class="glass-effect rounded-3xl overflow-hidden">
                    <!-- Header Section -->
                    <div class="text-center p-8 bg-gradient-to-r from-purple-100 via-blue-100 to-pink-100">
                        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                            Welcome Back!
                        </h1>
                        <p class="text-gray-600 mt-2">Sign in to continue your journey</p>
                    </div>

                    <!-- Form Section -->
                    <!-- Changed padding to be responsive - larger on desktop -->
                    <div class="p-6 md:p-10">
                        <!-- Session Status -->
                        @if(session('status'))
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 slide-in">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

                            <!-- Email Input -->
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-purple-400 group-focus-within:text-purple-600 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                    <input id="email" name="email" type="email" autocomplete="email" required
                                        class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-2xl 
                                        focus:bg-white focus:border-purple-300 focus:ring-0 input-glow
                                        placeholder-gray-400 transition-all duration-300"
                                        placeholder="you@example.com" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="space-y-2">
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-pink-400 group-focus-within:text-pink-600 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input id="password" name="password" type="password" autocomplete="current-password" required
                                        class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-2xl 
                                        focus:bg-white focus:border-pink-300 focus:ring-0 input-glow
                                        placeholder-gray-400 transition-all duration-300"
                                        placeholder="••••••••">
                                </div>
                                @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between pt-2">
                                <label class="flex items-center">
                                    <input id="remember_me" name="remember" type="checkbox"
                                        class="h-4 w-4 text-purple-400 focus:ring-purple-300 border-gray-300 rounded">
                                    <span class="ml-3 text-sm text-gray-600">Remember me</span>
                                </label>

                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-sm font-medium text-purple-500 hover:text-purple-400 transition-colors">
                                    Forgot password?
                                </a>
                                @endif
                            </div>

                            <!-- Login Button -->
                            <button type="submit"
                                class="w-full py-4 px-6 bg-gradient-to-r from-purple-400 to-pink-400 
                                hover:from-purple-500 hover:to-pink-500 text-white font-semibold 
                                rounded-2xl btn-hover focus:outline-none focus:ring-4 
                                focus:ring-purple-300 focus:ring-opacity-50">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Sign In
                                </span>
                            </button>
                        </form>

                        <!-- Navigation Links -->
                        <div class="mt-8 space-y-4">
                            <div class="text-center">
                                <a href="{{ route('welcome') }}"
                                    class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-purple-500 transition-colors">
                                    <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                    Back to Home
                                </a>
                            </div>

                            <div class="text-center">
                                <span class="text-sm text-gray-500">Don't have an account? </span>
                                <a href="{{ route('register') }}"
                                    class="text-sm font-semibold text-purple-500 hover:text-purple-400 transition-colors">
                                    Create Account
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>