<x-home-layout>

    <div class="flex flex-wrap justify-center gap-6 bg-gray-100 dark:bg-gray-900">
        @forelse($products as $product)
            <div
                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    @php
                        $imageUrl = Str::startsWith($product->image, 'https') ? $product->image : Storage::url($product->image);
                    @endphp
                    <img class="rounded-t-lg" src="{{ $imageUrl }}" alt=""/>
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$product->name}}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$product->description}}</p>

                </div>
            </div>
        @empty
            <p>No products found.</p>
        @endforelse
    </div>
</x-home-layout>
