<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $item->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-center">
                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-full h-auto max-h-96 object-cover rounded-lg">
                    </div>
                    <div class="mt-4">
                        <p class="text-xl font-bold">{{ $item->name }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Owner: {{ $item->owner->name }}</p>
                        <p class="text-gray-600 dark:text-gray-400">{{ $item->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
