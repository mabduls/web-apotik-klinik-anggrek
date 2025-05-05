<x-guest-layout>
    <div class="flex items-center justify-center bg-gradient-to-br from-pink-50 to-blue-50 p-10">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <!-- Header with pastel gradient -->
                <div class="bg-gradient-to-r from-pink-300 via-purple-300 to-blue-300 p-6 text-center">
                    <h1 class="text-3xl font-bold text-white">Welcome Back</h1>
                    <p class="text-white/90 mt-1">Sign in to your account</p>
                </div>

                <div class="p-8">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-6" :status="session('status')" />

                    @if(session('status'))
                    <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email Input -->
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-pink-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl shadow-sm 
                                    focus:ring-2 focus:ring-pink-300 focus:border-pink-300 placeholder-gray-400 
                                    transition duration-200" placeholder="you@example.com" value="{{ old('email') }}">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
                        </div>

                        <!-- Password Input -->
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="current-password" required
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl shadow-sm 
                                    focus:ring-2 focus:ring-blue-300 focus:border-blue-300 placeholder-gray-400 
                                    transition duration-200" placeholder="••••••••">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox"
                                    class="h-4 w-4 text-pink-400 focus:ring-pink-300 border-gray-300 rounded">
                                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                    Remember me
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                            <div class="text-sm">
                                <a href="{{ route('password.request') }}" class="font-medium text-purple-500 hover:text-purple-400 transition duration-200">
                                    Forgot password?
                                </a>
                            </div>
                            @endif
                        </div>

                        <!-- Login Button -->
                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm 
                                text-sm font-medium text-white bg-gradient-to-r from-pink-400 to-purple-400 
                                hover:from-pink-500 hover:to-purple-500 focus:outline-none focus:ring-2 
                                focus:ring-offset-2 focus:ring-pink-300 transition duration-200">
                                Sign In
                            </button>
                        </div>
                    </form>

                    <!-- Back to Home Button -->
                    <div class="mt-6 text-center">
                        <a href="{{ route('welcome') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-pink-500 transition duration-200">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>

            <!-- Additional Help Text -->
            <div class="mt-6 text-center text-sm text-gray-500">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-medium text-purple-500 hover:text-purple-400 transition duration-200">
                    Sign up
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>