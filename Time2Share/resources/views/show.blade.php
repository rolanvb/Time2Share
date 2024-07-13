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
                    <div class="mb-4">
                        <p class="text-3xl font-bold">{{ $item->name }}</p>
                        <a href="{{route('reviews.show', $item->owner_id)}}"
                            class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors ">
                            Owner: {{ $item->owner->name }}
                        </a>
                    </div>
                    <div class="flex items-center justify-center">
                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-full h-auto max-h-96 object-cover rounded-lg">
                    </div>
                    <div class="mt-4">
                        <p class="mt-4 text-xl font-semibold">Description</p>
                        <p class="mb-4">{{ $item->description }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Posted: {{$item->created_at->diffForHumans()}}</p>
                        <p class="text-gray-600 dark:text-gray-400">Last Updated: {{$item->updated_at->diffForHumans()}}</p>
                    </div>

                    <form action="{{ route('contracts.store', $item->id) }}" method="POST" class="mt-4">
                        @csrf
                        <h1 class="text-xl font-semibold">Request to Borrow</h1>
                        <div class="mb-4 w-40">
                            <label for="start_date">Start Date</label>
                            <input type="date" id="start_date" name="start_date" class="border rounded p-2 w-full text-gray-800" required>
                            <label for="end_date">End Date</label>
                            <input type="date" id="end_date" name="end_date" class="border rounded p-2 w-full text-gray-800" required>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white rounded px-4 py-2">
                                Submit Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
