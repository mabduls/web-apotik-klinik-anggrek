<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Back to Dashboard Buttons -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl flex space-x-4">
                    @if(auth()->user()->hasRole('owner'))
                        <x-primary-button>
                            <a href="{{ route('admin.dashboard') }}">Back to Owner Dashboard</a>
                        </x-primary-button>
                    @elseif(auth()->user()->hasRole('customers'))
                        <x-primary-button>
                            <a href="{{ route('customers.dashboard.page.index') }}">Back to Customer Dashboard</a>
                        </x-primary-button>
                    @endif
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>