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
                    <div class="flex flex-row mb-3 justify-between">
                        <div>
                            <x-button href="{{ route('products.create') }}" class="h-10">Add Product</x-button>
                            <button type="button"
                                    onclick="modalImport()"
                                    class="text-blue-600 hover:text-blue-800 ml-2">
                                Import from excel
                            </button>
                        </div>
                        <form action="" class="flex flex-row space-x-2 items-center">
                            <x-text-input name="search" placeholder="Search product" class="mt-1 block w-full h-10"
                                          value="{{ request('search') }}"/>
                            <x-primary-button>Search</x-primary-button>
                        </form>
                    </div>


                    <table class="min-w-full divide-y divide-gray-200 border">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-left">
                                <span
                                    class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-50 uppercase tracking-wider">No</span>
                            </th>
                            <th class="px-6 py-3 text-left">
                                <span
                                    class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-50 uppercase tracking-wider">Name</span>
                            </th>
                            <th class="px-6 py-3 text-left">
                                <span
                                    class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-50 uppercase tracking-wider">Description</span>
                            </th>
                            <th class="px-6 py-3 text-left">
                                <span
                                    class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-50 uppercase tracking-wider">Price</span>
                            </th>
                            <th class="px-6 py-3 text-left">
                                <span
                                    class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-50 uppercase tracking-wider">Stock</span>
                            </th>
                            <th class="px-6 py-3 text-left">
                                <span
                                    class="text-xs leading-4 font-medium text-gray-500 dark:text-gray-50 uppercase tracking-wider">Action</span>
                            </th>
                        </tr>
                        </thead>

                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 divide-solid">
                        @php($no = 1)
                        @forelse($products as $product)
                            <tr class="bg-white dark:bg-gray-800">
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                    {{ $no++ }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                    {{ $product->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 truncate max-w-xs">
                                    {{ $product->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                    @rupiah($product->price)
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                    {{ $product->stock }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                    <a class="text-blue-500" href="{{route('products.edit', $product)}}">Edit</a>
                                    <button type="button"
                                            onclick="openModal('deleteModal{{ $product->id }}')"
                                            class="text-red-600 hover:text-red-800 ml-2">
                                        Delete
                                    </button>
                                </td>
                                <div id="deleteModal{{ $product->id }}"
                                     class="fixed inset-0 bg-gray-500 bg-opacity-75 dark:bg-gray-800 dark:bg-opacity-75 hidden items-center justify-center">
                                    <div class="bg-white dark:bg-slate-600 rounded-lg p-8 max-w-sm mx-auto">
                                        <div class="mb-4">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Delete
                                                Confirmation</h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-300 mt-2">
                                                Are you sure want to delete product "{{ $product->name }}"?
                                            </p>
                                        </div>
                                        <div class="flex justify-end gap-4">
                                            <button type="button"
                                                    onclick="closeModal('deleteModal{{ $product->id }}')"
                                                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                                Cancel
                                            </button>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900" colspan="4">
                                    No products found
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="modalImport"
         class="fixed inset-0 bg-gray-500 bg-opacity-75 dark:bg-gray-800 dark:bg-opacity-75 hidden items-center justify-center">
        <div class="bg-white dark:bg-slate-600 rounded-lg p-8 max-w-sm mx-auto">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-3">Import from Excel</h3>
                <p class="text-sm text-gray-900 dark:text-gray-200">Import from excel file, use <a class="text-blue-500"
                                                                                                   href="{{url('/files/example.xlsx')}}">this
                        template</a></p>
            </div>
            <div class="flex justify-end gap-4">
                <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data"
                      class="inline">
                    @csrf
                    <div class="mb-5">
                        <input type="file" name="file" id="file">
                    </div>
                    <div class="flex flex-row">
                        <button type="button"
                                onclick="closeModal('modalImport')"
                                class="px-4 py-2  text-gray-200 ">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function openModal(modalId) {
            console.log(modalId);
            document.getElementById(modalId).classList.remove('hidden');
            document.getElementById(modalId).classList.add('flex');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('flex');
            document.getElementById(modalId).classList.add('hidden');
        }

        function modalImport() {
            document.getElementById('modalImport').classList.remove('hidden');
            document.getElementById('modalImport').classList.add('flex');
        }

        // Close modal when clicking outside
        window.onclick = function (event) {
            if (event.target.classList.contains('fixed')) {
                event.target.classList.remove('flex');
                event.target.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>

