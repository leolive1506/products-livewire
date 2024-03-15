<form wire:submit="store">
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 dark:border-gray-300/10">
            <h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-gray-100">New Product</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input wire:model.live="form.name" id="name" class="block mt-1 w-full" type="text"
                        name="name" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="price" :value="__('Price')" />
                    <x-text-input wire:model.live="form.price" id="price" class="block mt-1 w-full" type="number"
                        name="price" required />
                    <x-input-error :messages="$errors->get('form.price')" class="mt-2" />
                </div>


                <div class="col-span-3">
                    <label for="cover-photo"
                        class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Cover photo</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            @if ($form->image)
                                <img src="{{ $form->image->temporaryUrl() }}" alt="Previus upload image"
                                    class="mx-auto size-32 rounded" />
                            @else
                                <svg class="mx-auto size-32 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            @endif
                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                <label for="file-upload"
                                    class="relative cursor-pointer rounded-md bg-white dark:bg-transparent font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500 transition">
                                    <span>Upload a file</span>
                                    <input wire:model.live="form.image" id="file-upload" name="file-upload" type="file"
                                        class="sr-only">
                                </label>
                                <p class="pl-1 text-gray-900 dark:text-gray-300">or drag and drop</p>
                            </div>
                            <p class="text-xs leading-5 text-gray-900 dark:text-gray-300 opacity-70">PNG, JPG, GIF up to
                                10MB</p>
                            <x-input-error :messages="$errors->get('form.image')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="col-span-3">
                    <x-input-label for="description" :value="__('Description')" />
                    <div class="mt-2 flex flex-col h-[80%]">
                        <textarea wire:model.live="form.description" id="description" rows="3"
                            class="block w-full h-full min-h-full flex-grow resize-none rounded-md border-0 py-1.5 text-gray-900 dark:bg-gray-900 dark:text-gray-300 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                    <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
                </div>
            </div>
        </div>


        <div class="flex items-center justify-end gap-x-6">
            <button type="button"
                class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-100">Cancel</button>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
</form>
