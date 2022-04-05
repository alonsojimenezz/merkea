<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorías de Producto') }}
        </h2>
    </x-slot>

    <!-- This example requires Tailwind CSS v2.0+ -->


    <div class="flex flex-col">
        <div class="my-2 overflow-x-auto sm:mx-6 lg:mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Categoría</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Descripción</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $counter = 1; @endphp
                            @foreach ($categories as $category)
                                <tr class="{{ $counter % 2 == 1 ? 'bg-white' : 'bg-gray-50' }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $category->Name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $category->Description }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $category->Active ? 'Activo' : 'Inactivo' }}
                                    </td>
                                </tr>
                                @php $counter++; @endphp
                            @endforeach

                            <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="my-2 sm:mx-6 lg:mx-8 sm:px-6 lg:px-8">
            {!! $categories->links() !!}
        </div>
    </div>

</x-app-layout>
