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
                        <p class="text-gray-600 dark:text-gray-400">Posted: {{ $item->created_at->diffForHumans() }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Last Updated: {{ $item->updated_at->diffForHumans() }}</p>
                    </div>

                    @php
                        $contract = $item->contracts()->where('borrower_id', auth()->id())->where('is_accepted', true)->first();
                    @endphp

                    @if ($contract)
                        <form action="{{ route('contracts.return', $contract->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 focus:outline-none">
                                Return Item
                            </button>
                        </form>
                    @else
                        <p class="mt-4 text-gray-600 dark:text-gray-400">You do not have an active contract to return this item.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
