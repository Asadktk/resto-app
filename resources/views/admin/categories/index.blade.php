<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('categories.create') }}"
                class="px-4 py-2 bg-indigo-700 text-white top-4 left-6 rounded-lg">New Category</a>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4   ">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-slate-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-4">
                                Product name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Color
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Category
                            </th>
                            
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $category->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $category->description }}
                                </td>
                                <td class="px-6 py-4">
                                    <img class="hidden w-48 mr-6 md:block"
                                        src="{{ $category->image ? asset('storage/' . $category->image) : asset('/images/no-image.png') }}"
                                        alt="" />
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                            class="fa-solid fa-pencil"></i>Edit </a>
                                            <br/>
                                            <form method="POST" action="{{route('categories.destroy', $category)}}" class="px-2">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    <i class="fa-solid fa-trash"></i>
                                                    Delete
                                                </button>
                                            </form>
                                    </div>
                                  
                                </td>

                            </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
