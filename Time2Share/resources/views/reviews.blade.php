<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}'s Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (auth()->id() !== $user->id)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl font-semibold mb-4">Leave a Review</h3>
                        <form action="{{ route('reviews.store', ['user' => $user->id]) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="rating" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Rating</label>
                                <select name="rating" id="rating" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm dark:bg-gray-800 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="review_text" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Review</label>
                                <textarea name="review_text" id="review_text" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm dark:bg-gray-800 focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"></textarea>
                            </div>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 focus:outline-none">Submit Review</button>
                        </form>
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-4">Reviews</h3>
                    @forelse ($reviews as $review)
                        <div class="mb-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="font-semibold">{{ $review->reviewer->name }}</span>
                                    <span class="text-gray-600 dark:text-gray-400">rated</span>
                                    <span class="font-semibold">{{ $review->rating }}</span>
                                    <span class="text-gray-600 dark:text-gray-400">stars</span>
                                </div>
                                <span class="text-gray-600 dark:text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="mt-2">{{ $review->review_text }}</p>
                        </div>
                    @empty
                        <p>No reviews yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
