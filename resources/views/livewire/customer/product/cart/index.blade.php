<div>
    <div class="flex min-h-full items-stretch justify-center text-center sm:items-center sm:px-6 lg:px-8">
        <div class="flex w-full max-w-3xl transform text-left text-base transition sm:my-8">
            <form class="relative flex w-full flex-col overflow-hidden bg-white pb-8 pt-6 sm:rounded-lg sm:pb-6 lg:py-8">
                <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8">
                    <h2 class="text-lg font-medium text-gray-900">Shopping Cart</h2>
                </div>

                <section aria-labelledby="cart-heading">
                    <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>

                    <ul role="list" class="divide-y divide-gray-200 px-4 sm:px-6 lg:px-8">
                        @foreach ($this->cart as $item)
                            <li class="flex py-8 text-sm sm:items-center">
                                <img src="{{ $item->product->image }}"
                                    alt="Front of zip tote bag with white canvas, black canvas straps and handle, and black zipper pulls."
                                    class="h-24 w-24 flex-none rounded-lg border border-gray-200 sm:h-32 sm:w-32">
                                <div
                                    class="ml-4 grid flex-auto grid-cols-1 grid-rows-1 items-start gap-x-5 gap-y-3 sm:ml-6 sm:flex sm:items-center sm:gap-0">
                                    <div class="row-end-1 flex-auto sm:pr-6">
                                        <h3 class="font-medium text-gray-900">
                                            <a href="#">{{ $item->product->name }}</a>
                                        </h3>
                                        <p class="mt-1 text-gray-500">x{{ $item->quantity }}</p>

                                    </div>
                                  
                                    <div class="flex items-center sm:block sm:flex-none sm:text-center">
                                        <p class="w-full font-medium text-gray-900 text-right text-xl">
                                            R$ {{ number_format($item->product->price, 2, ',', '.') }}
                                        </p>
                                        <div class="flex items-center sm:block sm:flex-none sm:text-center">
                                            <button type="button" wire:click="add({{ $item }})" class="text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>                                              
                                            </button>
                                            <button type="button" wire:click="decrease({{ $item }})" class="text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>                                              
                                            </button>
                                            <button type="button" wire:click="remove({{ $item }})" class="text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>                                              
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>

                <section aria-labelledby="summary-heading" class="mt-auto sm:px-6 lg:px-8">
                    <div class="bg-gray-50 p-6 sm:rounded-lg sm:p-8">
                        <h2 id="summary-heading" class="sr-only">Order summary</h2>

                        <div class="flow-root">
                            <dl class="-my-4 divide-y divide-gray-200 text-sm">
                                <div class="flex items-center justify-between py-4">
                                    <dt class="text-base font-medium text-gray-900">Order total</dt>
                                    <dd class="text-base font-medium text-gray-900">
                                        R$ {{ number_format($this->total, 2, ',', '.') }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </section>

                <div class="mt-8 flex justify-end px-4 sm:px-6 lg:px-8 gap-4">
                    <a 
                        href="{{ route('customer.product.index') }}"
                        wire:navigate
                        class="rounded-md border border-gray-300 bg-gray-100 px-4 py-2 text-sm font-medium text-gray-800 shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-50"
                    >
                        Choose again
                    </a>
                    <button
                        type="button"
                        class="rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">
                        Continue to Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
