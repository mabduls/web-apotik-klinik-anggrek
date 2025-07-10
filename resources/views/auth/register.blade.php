<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Join Our Community</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .main-container {
            height: 100vh;
            height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            box-sizing: border-box;
        }

        .form-container {
            width: 100%;
            max-width: 28rem;
            margin: 0 auto;
            max-height: 95vh;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #3B82F6 #F1F5F9;
        }

        .form-container::-webkit-scrollbar {
            width: 6px;
        }

        .form-container::-webkit-scrollbar-track {
            background: #F1F5F9;
            border-radius: 3px;
        }

        .form-container::-webkit-scrollbar-thumb {
            background-color: #3B82F6;
            border-radius: 3px;
        }

        @media (min-width: 768px) {
            .form-container {
                max-width: 32rem;
            }
        }

        @media (min-width: 1024px) {
            .form-container {
                max-width: 36rem;
            }
        }

        @media (min-width: 1536px) {
            .form-container {
                max-width: 40rem;
            }
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
                transform: translateY(-20px) rotate(-2deg);
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
            background: linear-gradient(135deg, #DBEAFE, #F0F9FF, #F0FDF4);
            padding: 2px;
            border-radius: 24px;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-glow:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        .btn-hover {
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }

        .bubble {
            position: absolute;
            background: linear-gradient(135deg, #DBEAFE, #F0F9FF, #A7F3D0);
            border-radius: 50%;
            opacity: 0.6;
            animation: bubble 4s infinite ease-in-out;
            z-index: -1;
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

        .progress-bar {
            height: 4px;
            background: linear-gradient(to right, #3B82F6, #10B981);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        /* Password strength colors */
        .strength-weak {
            background-color: #ef4444;
        }

        .strength-fair {
            background-color: #f59e0b;
        }

        .strength-good {
            background-color: #10b981;
        }

        .strength-strong {
            background-color: #059669;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-cyan-50 to-emerald-50 relative overflow-hidden">
    <!-- Floating Background Elements -->
    <div class="bubble w-24 h-24 top-20 left-16 floating-animation"></div>
    <div class="bubble w-28 h-28 top-10 right-24 floating-delayed"></div>
    <div class="bubble w-20 h-20 bottom-32 left-12 floating-animation" style="animation-delay: 2.5s;"></div>
    <div class="bubble w-32 h-32 bottom-16 right-16 floating-delayed" style="animation-delay: 1s;"></div>

    <div class="relative z-10 main-container">
        <div class="form-container slide-in">
            <!-- Main Card -->
            <div class="gradient-border">
                <div class="glass-effect rounded-3xl overflow-hidden">
                    <!-- Header Section -->
                    <div class="text-center p-6 bg-gradient-to-r from-blue-100 via-cyan-100 to-emerald-100">
                        <div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-r from-blue-400 to-emerald-400 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-emerald-600 bg-clip-text text-transparent">
                            Join Our Community
                        </h1>
                        <p class="text-gray-600 mt-1 text-sm">Create your account and start exploring</p>

                        <!-- Progress Bar -->
                        <div class="mt-3 bg-gray-200 rounded-full h-1">
                            <div class="progress-bar w-full"></div>
                        </div>
                    </div>

                    <!-- Form Section -->
                    <div class="p-6 md:p-8">
                        <form method="POST" action="{{ route('register') }}" class="space-y-4">
                            @csrf

                            <!-- Name Input -->
                            <div class="space-y-1">
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-blue-400 group-focus-within:text-blue-600 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input id="name" name="name" type="text" autocomplete="name" required
                                        class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl 
                                        focus:bg-white focus:border-blue-300 focus:ring-0 input-glow
                                        placeholder-gray-400 transition-all duration-300"
                                        placeholder="John Doe" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Input -->
                            <div class="space-y-1">
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-cyan-400 group-focus-within:text-cyan-600 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                    <input id="email" name="email" type="email" autocomplete="email" required
                                        class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl 
                                        focus:bg-white focus:border-cyan-300 focus:ring-0 input-glow
                                        placeholder-gray-400 transition-all duration-300"
                                        placeholder="you@example.com" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="space-y-1">
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Password
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-emerald-400 group-focus-within:text-emerald-600 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input id="password" name="password" type="password" autocomplete="new-password" required
                                        class="w-full pl-10 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-2xl 
                                        focus:bg-white focus:border-emerald-300 focus:ring-0 input-glow
                                        placeholder-gray-400 transition-all duration-300"
                                        placeholder="••••••••">
                                </div>

                                <!-- Password Strength Indicator -->
                                <div class="mt-1 space-y-1">
                                    <div class="flex gap-1">
                                        <div class="h-1 flex-1 rounded-full bg-gray-200" id="strength-1"></div>
                                        <div class="h-1 flex-1 rounded-full bg-gray-200" id="strength-2"></div>
                                        <div class="h-1 flex-1 rounded-full bg-gray-200" id="strength-3"></div>
                                        <div class="h-1 flex-1 rounded-full bg-gray-200" id="strength-4"></div>
                                    </div>
                                    <p class="text-xs text-slate-500" id="strength-text">Use at least 8 characters with a mix of letters, numbers & symbols</p>
                                </div>

                                @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="space-y-1">
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5-6a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Confirm Password
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-emerald-400 group-focus-within:text-emerald-600 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        autocomplete="new-password" required
                                        class="w-full pl-10 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-2xl 
                                        focus:bg-white focus:border-emerald-300 focus:ring-0 input-glow
                                        placeholder-gray-400 transition-all duration-300"
                                        placeholder="••••••••">
                                    <!-- Match Indicator -->
                                    <div class="absolute inset-y-0 right-10 flex items-center pr-2">
                                        <div class="w-2 h-2 rounded-full opacity-0 transition-all duration-300" id="match-indicator"></div>
                                    </div>
                                </div>
                                @error('password_confirmation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Security Tips -->
                            <div class="bg-gradient-to-r from-blue-50 to-emerald-50 border border-blue-200 rounded-xl p-3 mt-3">
                                <div class="flex items-start gap-2">
                                    <div class="flex-shrink-0">
                                        <svg class="w-4 h-4 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-xs font-semibold text-blue-800 mb-1">Password Security Tips</h4>
                                        <ul class="text-xs text-blue-700 space-y-1">
                                            <li class="flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Minimum 8 characters
                                            </li>
                                            <li class="flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Mix of uppercase, lowercase, numbers & symbols
                                            </li>
                                            <li class="flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                                Avoid easily guessable personal information
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms Agreement -->
                            <div class="flex items-start space-x-2 pt-1">
                                <input id="terms" name="terms" type="checkbox" required
                                    class="h-4 w-4 text-blue-400 focus:ring-blue-300 border-gray-300 rounded mt-1">
                                <label for="terms" class="text-xs text-gray-600 leading-relaxed">
                                    I agree to the <a href="#" class="text-blue-500 hover:text-blue-400 font-medium">Terms</a>
                                    and <a href="#" class="text-blue-500 hover:text-blue-400 font-medium">Privacy Policy</a>
                                </label>
                            </div>

                            <!-- Register Button -->
                            <button type="submit"
                                class="w-full py-3 px-6 bg-gradient-to-r from-blue-400 to-emerald-400 
                                hover:from-blue-500 hover:to-emerald-500 text-white font-semibold 
                                rounded-2xl btn-hover focus:outline-none focus:ring-4 
                                focus:ring-blue-300 focus:ring-opacity-50 mt-4">
                                <span class="flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                    Create Account
                                </span>
                            </button>
                        </form>

                        <!-- Navigation Links -->
                        <div class="mt-2 space-y-3">
                            <div class="text-center">
                                <a href="{{ route('welcome') }}"
                                    class="inline-flex items-center text-xs font-medium text-gray-500 hover:text-blue-500 transition-colors">
                                    <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                    </svg>
                                    Back to Home
                                </a>
                            </div>

                            <div class="text-center">
                                <span class="text-xs text-gray-500">Already have an account? </span>
                                <a href="{{ route('login') }}"
                                    class="text-xs font-semibold text-blue-500 hover:text-blue-400 transition-colors">
                                    Sign In
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form validation and interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
            const progressBar = document.querySelector('.progress-bar');

            // Update progress bar based on filled inputs
            function updateProgress() {
                const filledInputs = Array.from(inputs).filter(input => input.value.trim() !== '').length;
                const progress = (filledInputs / inputs.length) * 100;
                progressBar.style.width = progress + '%';
            }

            // Add event listeners to inputs
            inputs.forEach(input => {
                input.addEventListener('input', updateProgress);
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            // Form submission with loading state
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Creating Account...
                `;
                submitBtn.disabled = true;
            });

            // Password strength checker
            function checkPasswordStrength(password) {
                let strength = 0;
                const checks = {
                    length: password.length >= 8,
                    lowercase: /[a-z]/.test(password),
                    uppercase: /[A-Z]/.test(password),
                    numbers: /\d/.test(password),
                    symbols: /[^A-Za-z0-9]/.test(password)
                };

                strength = Object.values(checks).filter(Boolean).length;
                return {
                    strength,
                    checks
                };
            }

            // Update password strength indicator
            function updateStrengthIndicator(password) {
                const {
                    strength,
                    checks
                } = checkPasswordStrength(password);
                const indicators = [1, 2, 3, 4].map(i => document.getElementById(`strength-${i}`));
                const textEl = document.getElementById('strength-text');

                // Reset all indicators
                indicators.forEach(el => {
                    el.className = 'h-1 flex-1 rounded-full bg-gray-200 transition-all duration-300';
                });

                // Update based on strength
                const colors = ['', 'strength-weak', 'strength-fair', 'strength-good', 'strength-strong'];
                const texts = [
                    'Use at least 8 characters with a mix of letters, numbers & symbols',
                    'Password too weak',
                    'Password is fair',
                    'Password is strong',
                    'Password is very strong'
                ];

                for (let i = 0; i < Math.min(strength, 4); i++) {
                    indicators[i].classList.add(colors[strength] || 'strength-weak');
                }

                textEl.textContent = texts[strength] || texts[0];
                textEl.className = `text-xs transition-colors duration-300 ${
                    strength === 0 ? 'text-slate-500' :
                    strength === 1 ? 'text-red-500' :
                    strength === 2 ? 'text-yellow-500' :
                    'text-green-500'
                }`;
            }

            // Check password match
            function checkPasswordMatch() {
                const password = document.getElementById('password').value;
                const confirmation = document.getElementById('password_confirmation').value;
                const indicator = document.getElementById('match-indicator');

                if (confirmation.length > 0) {
                    if (password === confirmation) {
                        indicator.className = 'w-2 h-2 bg-green-400 rounded-full opacity-100 transition-all duration-300';
                    } else {
                        indicator.className = 'w-2 h-2 bg-red-400 rounded-full opacity-100 transition-all duration-300';
                    }
                } else {
                    indicator.className = 'w-2 h-2 rounded-full opacity-0 transition-all duration-300';
                }
            }

            // Initialize password validation
            const passwordInput = document.getElementById('password');
            const confirmationInput = document.getElementById('password_confirmation');

            passwordInput.addEventListener('input', function() {
                updateStrengthIndicator(this.value);
                checkPasswordMatch();
            });

            confirmationInput.addEventListener('input', checkPasswordMatch);
        });
    </script>
</body>

</html>