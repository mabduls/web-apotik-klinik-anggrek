<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="form-group">
            <label for="update_password_current_password" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                {{ __('Password Saat Ini') }}
            </label>
            <div class="relative">
                <input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    class="w-full px-4 py-3 pr-12 rounded-xl border-2 border-orange-200 bg-white/80 focus:border-orange-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-orange-100 transition-all duration-300 text-slate-700 placeholder-slate-400"
                    autocomplete="current-password"
                    placeholder="Masukkan password saat ini" />
                <button
                    type="button"
                    onclick="togglePassword('update_password_current_password')"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="eye-update_password_current_password">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>
            </div>
            @if($errors->updatePassword->get('current_password'))
            <div class="mt-2 flex items-center gap-2 text-red-500 text-sm animate-shake">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                {{ $errors->updatePassword->get('current_password')[0] }}
            </div>
            @endif
        </div>

        <!-- New Password -->
        <div class="form-group">
            <label for="update_password_password" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ __('Password Baru') }}
            </label>
            <div class="relative">
                <input
                    id="update_password_password"
                    name="password"
                    type="password"
                    class="w-full px-4 py-3 pr-12 rounded-xl border-2 border-green-200 bg-white/80 focus:border-green-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-green-100 transition-all duration-300 text-slate-700 placeholder-slate-400"
                    autocomplete="new-password"
                    placeholder="Buat password baru yang kuat" />
                <button
                    type="button"
                    onclick="togglePassword('update_password_password')"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="eye-update_password_password">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>
            </div>

            <!-- Password Strength Indicator -->
            <div class="mt-2 space-y-2">
                <div class="flex gap-1">
                    <div class="h-1 flex-1 rounded-full bg-gray-200" id="strength-1"></div>
                    <div class="h-1 flex-1 rounded-full bg-gray-200" id="strength-2"></div>
                    <div class="h-1 flex-1 rounded-full bg-gray-200" id="strength-3"></div>
                    <div class="h-1 flex-1 rounded-full bg-gray-200" id="strength-4"></div>
                </div>
                <p class="text-xs text-slate-500" id="strength-text">Gunakan minimal 8 karakter dengan kombinasi huruf, angka, dan simbol</p>
            </div>

            @if($errors->updatePassword->get('password'))
            <div class="mt-2 flex items-center gap-2 text-red-500 text-sm animate-shake">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                {{ $errors->updatePassword->get('password')[0] }}
            </div>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5-6a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ __('Konfirmasi Password') }}
            </label>
            <div class="relative">
                <input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="w-full px-4 py-3 pr-12 rounded-xl border-2 border-blue-200 bg-white/80 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all duration-300 text-slate-700 placeholder-slate-400"
                    autocomplete="new-password"
                    placeholder="Ketik ulang password baru" />
                <button
                    type="button"
                    onclick="togglePassword('update_password_password_confirmation')"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="eye-update_password_password_confirmation">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>

                <!-- Match Indicator -->
                <div class="absolute inset-y-0 right-12 flex items-center pr-3">
                    <div class="w-2 h-2 rounded-full opacity-0 transition-all duration-300" id="match-indicator"></div>
                </div>
            </div>
            @if($errors->updatePassword->get('password_confirmation'))
            <div class="mt-2 flex items-center gap-2 text-red-500 text-sm animate-shake">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                {{ $errors->updatePassword->get('password_confirmation')[0] }}
            </div>
            @endif
        </div>

        <!-- Security Tips -->
        <div class="bg-gradient-to-r from-cyan-50 to-blue-50 border border-cyan-200 rounded-xl p-4">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-sm font-semibold text-cyan-800 mb-2">Tips Keamanan Password</h4>
                    <ul class="text-xs text-cyan-700 space-y-1">
                        <li class="flex items-center gap-2">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Minimal 8 karakter panjangnya
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Kombinasi huruf besar, kecil, angka, dan simbol
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Hindari informasi pribadi yang mudah ditebak
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-4">
            <div class="flex items-center gap-4">
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-yellow-500 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-orange-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    {{ __('Update Password') }}
                </button>

                @if (session('status') === 'password-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    x-init="setTimeout(() => show = false, 3000)"
                    class="flex items-center gap-2 px-4 py-2 bg-green-100 text-green-800 rounded-lg border border-green-200">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ __('Password berhasil diupdate!') }}</span>
                </div>
                @endif
            </div>
        </div>
    </form>

    <style>
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

        /* Enhanced form styling */
        .form-group input:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        button:active {
            transform: scale(0.98);
        }

        input:focus {
            outline: none;
        }
    </style>

    <script>
        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const eyeIcon = document.getElementById('eye-' + inputId);

            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12m0 0l3.121-3.121M12 12v6"></path>
                `;
            } else {
                input.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            }
        }

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
                'Gunakan minimal 8 karakter dengan kombinasi huruf, angka, dan simbol',
                'Password terlalu lemah',
                'Password cukup kuat',
                'Password kuat',
                'Password sangat kuat'
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
            const password = document.getElementById('update_password_password').value;
            const confirmation = document.getElementById('update_password_password_confirmation').value;
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

        // Initialize event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('update_password_password');
            const confirmationInput = document.getElementById('update_password_password_confirmation');

            passwordInput.addEventListener('input', function() {
                updateStrengthIndicator(this.value);
                checkPasswordMatch();
            });

            confirmationInput.addEventListener('input', checkPasswordMatch);
        });
    </script>
</section>