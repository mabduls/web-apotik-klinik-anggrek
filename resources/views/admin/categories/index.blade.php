<!DOCTYPE html>
<html lang="en" class="dark"> <!-- Force dark mode -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="min-h-screen bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    @include('layouts.navigation')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 px-4 sm:px-0">
                <h2 class="font-semibold text-xl dark:text-gray-200 leading-tight">
                    {{ __('Categories') }}
                </h2>
            </div>

            <div class="flex flex-col gap-y-5 dark:bg-gray-800 p-10 overflow-hidden shadow-sm sm:rounded-lg">
                @forelse($categories as $category)
                <div class="item-card flex flex-row justify-between items-center text-white">
                    <img src="{{ Storage::url($category->icon) }}" alt="{{ $category->name }}" class="w-12 h-12 rounded-full object-cover">
                    <h3 class="text-gray-900 dark:text-gray-100 font-bold text-xl">
                        {{ $category->name }}
                    </h3>
                    <div class="flex flex-row items-center gap-x-3">
                        <a href="#" class="py-2 px-6 rounded-full text-white bg-gray-700 hover:bg-gray-600 transition">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                            @csrf
                            @method('DELETE')
                            <button class="py-2 px-3 rounded-full text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 transition-all shadow-md hover:shadow-lg">
                                Delete
                            </button>
                        </form>
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