<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($items->count())
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($items as $item)
                                <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg">
                                    <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-full h-48 object-cover mb-4 rounded">
                                    <h3 class="text-xl font-bold mb-2">{{ $item->name }}</h3>
                                    <p class="text-gray-600 dark:text-gray-400">Owner: {{ $item->owner->name }}</p>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $items->links() }}
                        </div>
                    @else
                        <div>There are no items!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
