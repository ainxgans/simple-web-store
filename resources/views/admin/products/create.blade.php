<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-scroll shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <header class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Add Product') }}
                        </h2>
                    </header>
                    <form action="{{route('products.store')}}" method="post" class="mt-6 space-y-6"
                          enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Name')"/>
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required
                                          autofocus/>
                            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')"/>
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                                          required/>
                            <x-input-error class="mt-2" :messages="$errors->get('description')"/>
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Price')"/>
                            <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('price')"/>
                        </div>

                        <div>
                            <x-input-label for="stock" :value="__('Stock')"/>
                            <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('stock')"/>
                        </div>
                        <div>
                            <x-input-label for="image" :value="__('Image')"/>
                            <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('image')"/>
                        </div>

                        <x-primary-button>{{ __('Add') }}</x-primary-button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
