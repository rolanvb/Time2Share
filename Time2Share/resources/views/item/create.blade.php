<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add New Item
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-gray-900 dark:text-gray-100">Item Name</label>
                            <input type="text" id="name" name="name" class="border rounded p-2 w-full" required autofocus>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-900 dark:text-gray-100">Description</label>
                            <textarea id="description" name="description" rows="4" class="border rounded p-2 w-full"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-gray-900 dark:text-gray-100">Image (optional)</label>
                            <input type="file" id="image" name="image_url" accept="image/*" class="border rounded p-2">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white rounded px-4 py-2">
                                Create Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
