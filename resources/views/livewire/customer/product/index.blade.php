<ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
    @foreach ($this->products as $product)
        <li class="relative">
            <div
                class="group aspect-h-4 aspect-w-10 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                <img src="{{ $product->image }}" alt="{{ $product->image }} photo" class="pointer-events-none object-cover group-hover:opacity-75">
                <button type="button" class="absolute inset-0 focus:outline-none">
                    <span class="sr-only">View details for {{ $product->image }}</span>
                </button>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900 dark:text-white">
                        R$ {{ number_format($product->price, 2, ',', '.') }}
                    </p>
                    <p class="pointer-events-none block text-sm font-medium text-gray-500">{{ $product->name }}</p>
                </div>
                <div>
                    <x-primary-button>BUY</x-primary-button>    
                </div>
            </div>
        </li>
    @endforeach
</ul>
