<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Name Field -->
        <div class="form-group">
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                <svg class="w-4 h-4 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
                {{ __('Nama Lengkap') }}
            </label>
            <div class="relative">
                <input
                    id="name"
                    name="name"
                    type="text"
                    class="w-full px-4 py-3 rounded-xl border-2 border-purple-200 bg-white/80 focus:border-purple-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-100 transition-all duration-300 text-slate-700 placeholder-slate-400"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Masukkan nama lengkap Anda" />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <div class="w-2 h-2 bg-green-400 rounded-full opacity-0 transition-opacity duration-300" id="name-success"></div>
                </div>
            </div>
            @if($errors->get('name'))
            <div class="mt-2 flex items-center gap-2 text-red-500 text-sm animate-shake">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                {{ $errors->get('name')[0] }}
            </div>
            @endif
        </div>

        <!-- Email Field -->
        <div class="form-group">
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                </svg>
                {{ __('Alamat Email') }}
            </label>
            <div class="relative">
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="w-full px-4 py-3 rounded-xl border-2 border-blue-200 bg-white/80 focus:border-blue-400 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all duration-300 text-slate-700 placeholder-slate-400"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                    placeholder="nama@email.com" />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <div class="w-2 h-2 bg-green-400 rounded-full opacity-0 transition-opacity duration-300" id="email-success"></div>
                </div>
            </div>
            @if($errors->get('email'))
            <div class="mt-2 flex items-center gap-2 text-red-500 text-sm animate-shake">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                {{ $errors->get('email')[0] }}
            </div>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-3 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-yellow-800 mb-2">
                            {{ __('Email Anda belum terverifikasi.') }}
                        </p>
                        <button
                            form="send-verification"
                            type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-4 focus:ring-yellow-200 transition-all duration-300 hover:scale-105">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            {{ __('Kirim Ulang Email Verifikasi') }}
                        </button>
                    </div>
                </div>

                @if (session('status') === 'verification-link-sent')
                <div class="mt-3 p-3 bg-green-50 border border-green-200 rounded-lg animate-fade-in">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-sm font-medium text-green-800">
                            {{ __('Link verifikasi baru telah dikirim ke email Anda.') }}
                        </p>
                    </div>
                </div>
                @endif
            </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-4">
            <div class="flex items-center gap-4">
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-purple-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ __('Simpan Perubahan') }}
                </button>

                @if (session('status') === 'profile-updated')
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
                    <span class="text-sm font-medium">{{ __('Berhasil disimpan!') }}</span>
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

        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }

        /* Enhanced form styling */
        .form-group input:focus+.absolute .opacity-0 {
            opacity: 1;
        }

        .form-group input:valid:not(:placeholder-shown)+.absolute .opacity-0 {
            opacity: 1;
        }

        /* Smooth hover effects */
        .form-group input:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* Loading state for buttons */
        button:active {
            transform: scale(0.98);
        }

        /* Enhanced accessibility */
        input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }
    </style>

    <script>
        // Enhanced form interactivity
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[type="text"], input[type="email"]');

            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    const successIndicator = this.parentElement.querySelector('.bg-green-400');
                    if (this.value.length > 0 && this.checkValidity()) {
                        successIndicator.style.opacity = '1';
                    } else {
                        successIndicator.style.opacity = '0';
                    }
                });

                // Add floating label effect
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });
        });
    </script>
</section>