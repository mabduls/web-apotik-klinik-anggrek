<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 font-sans antialiased">
    @include('layouts.navigation')

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Success Alert -->
            @if(session('success'))
            <div x-data="{ show: true }"
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90"
                class="mb-6 relative">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl shadow-lg border border-green-400">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            <div>
                                <p class="font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button @click="show = false"
                            class="flex-shrink-0 ml-4 text-white hover:text-green-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 rounded-lg p-1 transition-colors duration-200">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endif

            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl shadow-lg">
                            <i class="fas fa-layer-group text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                                Manage Categories
                            </h1>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">
                                Organize and manage your content categories
                            </p>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('admin.categories.create') }}"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 
                                text-white font-semibold rounded-xl shadow-lg hover:shadow-xl 
                                transform hover:scale-105 transition-all duration-200 ease-in-out
                                focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                            <i class="fas fa-plus mr-2"></i>
                            Add New Category
                        </a>
                    </div>
                </div>
            </div>

            <!-- Categories Grid -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                @forelse($categories as $category)
                @if($loop->first)
                <!-- Grid Header -->
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                    <div class="grid grid-cols-12 gap-4 items-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        <div class="col-span-1 text-center">#</div>
                        <div class="col-span-2 text-center">Icon</div>
                        <div class="col-span-5">Category Name</div>
                        <div class="col-span-2 text-center">Created</div>
                        <div class="col-span-2 text-center">Actions</div>
                    </div>
                </div>
                @endif

                <!-- Category Item -->
                <div class="category-item border-b border-gray-100 dark:border-gray-700 last:border-b-0 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <div class="px-6 py-5">
                        <div class="grid grid-cols-12 gap-4 items-center">

                            <!-- Index Number -->
                            <div class="col-span-1 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 dark:bg-gray-600 text-gray-600 dark:text-gray-300 rounded-full text-sm font-medium">
                                    {{ $loop->iteration }}
                                </span>
                            </div>

                            <!-- Category Icon -->
                            <div class="col-span-2 flex justify-center">
                                <div class="relative group">
                                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200 blur"></div>
                                    <img src="{{ Storage::url($category->icon) }}"
                                        alt="{{ $category->name }}"
                                        class="relative w-14 h-14 rounded-full object-cover border-2 border-white dark:border-gray-600 shadow-md group-hover:shadow-lg transition-shadow duration-200">
                                </div>
                            </div>

                            <!-- Category Name -->
                            <div class="col-span-5">
                                <div class="flex items-center space-x-3">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $category->name }}
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            Category ID: #{{ $category->id }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Created Date -->
                            <div class="col-span-2 text-center">
                                <div class="text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-calendar-alt text-gray-400 mr-1"></i>
                                    {{ $category->created_at ? $category->created_at->format('M d, Y') : 'N/A' }}
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="col-span-2 flex justify-center space-x-2">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="inline-flex items-center px-3 py-2 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900 dark:hover:bg-blue-800 
                                              text-blue-700 dark:text-blue-300 text-sm font-medium rounded-lg
                                              transition-all duration-200 ease-in-out transform hover:scale-105
                                              focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
                                    title="Edit Category">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete Button -->
                                <div x-data="{ open: false }">
                                    <button @click="open = true"
                                        class="inline-flex items-center px-3 py-2 bg-red-100 hover:bg-red-200 dark:bg-red-900 dark:hover:bg-red-800 
                                                       text-red-700 dark:text-red-300 text-sm font-medium rounded-lg
                                                       transition-all duration-200 ease-in-out transform hover:scale-105
                                                       focus:ring-2 focus:ring-red-500 focus:ring-offset-1"
                                        title="Delete Category">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <!-- Delete Confirmation Modal -->
                                    <div x-show="open"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0"
                                        x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 backdrop-blur-sm"
                                        style="display: none;">

                                        <div x-show="open"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 transform scale-90"
                                            x-transition:enter-end="opacity-100 transform scale-100"
                                            x-transition:leave="transition ease-in duration-200"
                                            x-transition:leave-start="opacity-100 transform scale-100"
                                            x-transition:leave-end="opacity-0 transform scale-90"
                                            class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden border border-gray-200 dark:border-gray-600">

                                            <!-- Modal Header -->
                                            <div class="bg-gradient-to-r from-red-500 to-pink-600 px-6 py-4">
                                                <div class="flex items-center space-x-3">
                                                    <div class="flex-shrink-0">
                                                        <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                                                    </div>
                                                    <h3 class="text-xl font-bold text-white">Confirm Deletion</h3>
                                                </div>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="px-6 py-6">
                                                <div class="flex items-start space-x-4">
                                                    <img src="{{ Storage::url($category->icon) }}"
                                                        alt="{{ $category->name }}"
                                                        class="w-12 h-12 rounded-lg object-cover border border-gray-200 dark:border-gray-600">
                                                    <div class="flex-1">
                                                        <p class="text-gray-700 dark:text-gray-300 mb-2">
                                                            Are you sure you want to delete the category
                                                            <span class="font-semibold text-gray-900 dark:text-white">"{{ $category->name }}"</span>?
                                                        </p>
                                                        <p class="text-sm text-red-600 dark:text-red-400">
                                                            <i class="fas fa-exclamation-circle mr-1"></i>
                                                            This action cannot be undone.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Footer -->
                                            <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 flex justify-end space-x-3">
                                                <button @click="open = false"
                                                    type="button"
                                                    class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 
                                                                   rounded-lg hover:bg-gray-50 dark:hover:bg-gray-500 
                                                                   focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 
                                                                   transition-colors duration-200">
                                                    <i class="fas fa-times mr-2"></i>Cancel
                                                </button>

                                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 
                                                                       text-white rounded-lg shadow-md hover:shadow-lg 
                                                                       transform hover:scale-105 transition-all duration-200
                                                                       focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                        <i class="fas fa-trash mr-2"></i>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @empty
                <!-- Empty State -->
                <div class="px-6 py-16 text-center">
                    <div class="flex flex-col items-center justify-center space-y-4">
                        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-full">
                            <i class="fas fa-layer-group text-gray-400 text-4xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                No Categories Found
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-6">
                                Get started by creating your first category to organize your content.
                            </p>
                            <a href="{{ route('admin.categories.create') }}"
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 
                                          text-white font-semibold rounded-xl shadow-lg hover:shadow-xl 
                                          transform hover:scale-105 transition-all duration-200 ease-in-out
                                          focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <i class="fas fa-plus mr-2"></i>
                                Create First Category
                            </a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Enhanced Pagination -->
            @if($categories->count() > 0 || $categories->hasPages())
            <div class="mt-8">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} results
                        </div>

                        <div class="flex items-center space-x-1">
                            {{-- First Page Link --}}
                            <a href="{{ $categories->url(1) }}"
                                class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $categories->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500' : 'bg-blue-500 text-white hover:bg-blue-600 hover:shadow-md' }}"
                                title="First Page"
                                {{ $categories->onFirstPage() ? 'aria-disabled=true' : '' }}>
                                <i class="fas fa-angle-double-left"></i>
                            </a>

                            {{-- Previous Page Link --}}
                            <a href="{{ $categories->previousPageUrl() }}"
                                class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $categories->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500' : 'bg-blue-500 text-white hover:bg-blue-600 hover:shadow-md' }}"
                                title="Previous"
                                {{ $categories->onFirstPage() ? 'aria-disabled=true' : '' }}>
                                <i class="fas fa-angle-left"></i>
                            </a>

                            {{-- Pagination Numbers --}}
                            @php
                            $currentPage = $categories->currentPage();
                            $lastPage = $categories->lastPage();
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($lastPage, $currentPage + 2);

                            if ($currentPage <= 3) {
                                $endPage=min(5, $lastPage);
                                }
                                if ($currentPage>= $lastPage - 2) {
                                $startPage = max($lastPage - 4, 1);
                                }

                                $showStartEllipsis = $startPage > 2;
                                $showEndEllipsis = $endPage < $lastPage - 1;
                                    @endphp

                                    {{-- Always show first page --}}
                                    <a href="{{ $categories->url(1) }}"
                                    class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ 1 == $currentPage ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}">
                                    1
                                    </a>

                                    @if($showStartEllipsis)
                                    <span class="px-2 py-2 text-gray-500 dark:text-gray-400">...</span>
                                    @endif

                                    {{-- Middle pages --}}
                                    @for ($i = $startPage; $i <= $endPage; $i++)
                                        @if($i !=1 && $i !=$lastPage)
                                        <a href="{{ $categories->url($i) }}"
                                        class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $i == $currentPage ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}">
                                        {{ $i }}
                                        </a>
                                        @endif
                                        @endfor

                                        @if($showEndEllipsis)
                                        <span class="px-2 py-2 text-gray-500 dark:text-gray-400">...</span>
                                        @endif

                                        {{-- Always show last page if different from first --}}
                                        @if($lastPage != 1)
                                        <a href="{{ $categories->url($lastPage) }}"
                                            class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $lastPage == $currentPage ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600' }}">
                                            {{ $lastPage }}
                                        </a>
                                        @endif

                                        {{-- Next Page Link --}}
                                        <a href="{{ $categories->nextPageUrl() }}"
                                            class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ !$categories->hasMorePages() ? 'bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500' : 'bg-blue-500 text-white hover:bg-blue-600 hover:shadow-md' }}"
                                            title="Next"
                                            {{ !$categories->hasMorePages() ? 'aria-disabled=true' : '' }}>
                                            <i class="fas fa-angle-right"></i>
                                        </a>

                                        {{-- Last Page Link --}}
                                        <a href="{{ $categories->url($lastPage) }}"
                                            class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ $categories->currentPage() == $lastPage ? 'bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500' : 'bg-blue-500 text-white hover:bg-blue-600 hover:shadow-md' }}"
                                            title="Last Page"
                                            {{ $categories->currentPage() == $lastPage ? 'aria-disabled=true' : '' }}>
                                            <i class="fas fa-angle-double-right"></i>
                                        </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Stats Footer (if categories exist) -->
            @if($categories->count() > 0)
            <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2 text-gray-600 dark:text-gray-400">
                            <i class="fas fa-chart-bar"></i>
                            <span class="text-sm font-medium">Total Categories:</span>
                            <span class="font-bold text-blue-600 dark:text-blue-400">{{ $categories->count() }}</span>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">
                        <i class="fas fa-clock mr-1"></i>
                        Last updated: {{ now()->format('M d, Y H:i') }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .category-item:nth-child(even) {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .dark .category-item:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.02);
        }

        .category-item:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .dark .category-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
    </style>
</body>

</html>