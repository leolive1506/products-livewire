<div>
    <x-slot name="header">
        <div class="flex justify-end gap-4">
            <a 
                href="{{ route('admin.product.create') }}"
                wire:navigate
                class="rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">
                Create new
            </a>
        </div>
    </x-slot>
    <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
        @foreach ($this->products as $product)
            <li class="relative">
                <div
                    class="group aspect-h-4 aspect-w-10 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                    <img src="{{ $product->image }}" alt="{{ $product->image }} photo" class="pointer-events-none object-cover group-hover:opacity-75">
                    {{-- <button type="button" class="absolute inset-0 focus:outline-none">
                        <span class="sr-only">View details for {{ $product->image }}</span>
                    </button> --}}
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900 dark:text-white">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </p>
                        <p class="pointer-events-none block text-sm font-medium text-gray-500">{{ $product->name }}</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.product.edit', $product->id) }}" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </a>
                    </div>
                    <div>
                        <p>{{ $product->created_at->format('d/m/Y') }}</p>    
                        <p>{{ $product->updated_at->format('d/m/Y') }}</p>    
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
