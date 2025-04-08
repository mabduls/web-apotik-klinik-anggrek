<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/@heroicons/react@2.0.11/outline/index.js" defer></script>
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    @include('layouts.navigation')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
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
                <h2 class="font-bold text-xl dark:text-gray-200 leading-tight">
                    {{ __('Manage Categories') }}
                </h2>
                <a href="{{ route('admin.categories.create') }}" class="font-bold py-2 px-6 rounded-full text-white bg-gray-700 hover:bg-gray-600 transition">
                    Add Category
                </a>
            </div>
            <div class="flex flex-col gap-y-5 dark:bg-gray-800 p-10 overflow-hidden shadow-sm sm:rounded-lg">
                @forelse($categories as $category)
                <div class="item-card flex flex-row justify-between items-center text-white">
                    <img src="{{ Storage::url($category->icon) }}" alt="{{ $category->name }}" class="w-12 h-12 rounded-full object-cover">
                    <h3 class="text-gray-900 dark:text-gray-100 font-bold text-xl">
                        {{ $category->name }}
                    </h3>
                    <div class="flex flex-row items-center gap-x-3">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="font-bold py-2 px-6 rounded-full text-white bg-gray-700 hover:bg-gray-600 transition">
                            Edit
                        </a>
                        <div x-data="{ open: false }">
                            <button @click="open = true" type="button" class="font-bold py-2 px-3 rounded-full text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 transition-all shadow-md hover:shadow-lg">
                                Delete
                            </button>

                            <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                <div class="bg-gray-800 dark:bg-gray-700 rounded-lg p-6 max-w-sm w-full mx-4">
                                    <h3 class="text-xl font-bold text-gray-100 mb-4">Confirm Deletion</h3>
                                    <p class="text-gray-300 mb-6">Are you sure you want to delete "{{ $category->name }}" category? This action cannot be undone.</p>
                                    <div class="flex justify-end space-x-3">
                                        <button @click="open = false" type="button" class="px-4 py-2 rounded-lg text-gray-300 hover:text-white bg-gray-600 hover:bg-gray-500 transition">
                                            Cancel
                                        </button>
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 rounded-lg text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 transition">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-gray-900 dark:text-gray-100">No categories found.</p>
                @endforelse
            </div>
        </div>
    </div>
</body>

</html>