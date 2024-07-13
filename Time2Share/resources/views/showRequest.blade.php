<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('pendingRequests') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $item->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <p class="text-3xl font-bold">{{ $item->name }}</p>
                        @php
                            $borrower = \App\Models\User::find($contract->borrower_id);
                        @endphp
                        @if ($borrower)
                            <a href="{{route('reviews.show', $borrower)}}" class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors ">Requested by: {{ $borrower->name }}</a>
                        @else
                            <p class="text-gray-600 dark:text-gray-400">Requested by: Unknown</p>
                        @endif
                    </div>
                    <div class="flex items-center justify-center">
                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-full h-auto max-h-96 object-cover rounded-lg">
                    </div>
                    <div class="mt-4">
                        <p >Start Date: {{$contract->start_date}} </p>
                        <p >End Date: {{$contract->end_date}} </p>
                        <p class="mt-4 text-xl font-semibold">Description</p>
                        <p class="mb-4">{{ $item->description }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Posted: {{ $item->created_at->diffForHumans() }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Last Updated: {{ $item->updated_at->diffForHumans() }}</p>
                    </div>

                    <!-- Accept and Decline buttons -->
                    <div class="mt-6 flex justify-between">
                        <form method="POST" action="{{ route('contracts.accept', ['contract' => $contract->id]) }}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Accept
                            </button>
                        </form>
                        <form method="POST" action="{{ route('contracts.reject', ['contract' => $contract->id]) }}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Decline
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
