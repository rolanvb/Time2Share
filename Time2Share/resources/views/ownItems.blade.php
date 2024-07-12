<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{
        search: '',
        sortKey: 'name',
        sortOrder: 'asc',
        items: @js($items->items()),
        get filteredItems() {
            return this.items
                .filter(item => item.name.toLowerCase().includes(this.search.toLowerCase()))
                .sort((a, b) => {
                    let modifier = this.sortOrder === 'asc' ? 1 : -1;
                    if (aValue < bValue) return -1 * modifier;
                    if (aValue > bValue) return 1 * modifier;
                    return 0;
                });
        }
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 flex flex-col sm:flex-row justify-between">
                        <input type="text" x-model="search" placeholder="Search items..." class="border rounded p-2 mb-4 sm:mb-0 sm:mr-4 text-gray-900 ">
                        <div class="flex items-center">
                            <label for="sortKey" class="mr-2 text-gray-900 dark:text-gray-100">Sort by:</label>
                            <select id="sortKey" x-model="sortKey" class="border rounded p-2 pr-7 mr-2 text-gray-900">
                                <option value="name">Name</option>
                                <option value="updated_at">Date</option>
                            </select>
                            <button @click="sortOrder = sortOrder === 'asc' ? 'desc' : 'asc'" class="p-2 border rounded text-gray-900 dark:text-gray-100">
                                <span x-text="sortOrder === 'asc' ? 'Ascending' : 'Descending'"></span>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <template x-for="item in filteredItems" :key="item.id">
                            <a :href="'/items/' + item.id" class="block">
                                <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg mb-4">
                                    <img :src="item.image_url" :alt="item.name" class="w-full h-48 object-cover mb-4 rounded">
                                    <h3 class="text-xl font-bold mb-2" x-text="item.name"></h3>
                                    <p class="text-gray-600 dark:text-gray-400">Owner: <span x-text="item.owner.name"></span></p>
                                    <p class="text-gray-600 dark:text-gray-400"><span x-text="new Date(item.updated_at).toLocaleDateString()"></span></p>
                                </div>
                            </a>
                        </template>
                    </div>

                    <div class="mt-6">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
