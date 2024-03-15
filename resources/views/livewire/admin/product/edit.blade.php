<form wire:submit="update">
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
                            <img
                                src="{{ $form->image ? $form->image?->temporaryUrl() : $form->product->image }}"
                                alt="Previus upload image"
                                class="mx-auto size-32 rounded"
                            />
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
