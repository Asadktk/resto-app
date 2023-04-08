<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            
            
            
            @if (is_iterable($category)) 
            @unless ($categories->isEmpty())
            @foreach ($category->menus as $menu)
                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <img class="w-full h-48" src="{{ Storage::url($menu->image) }}" alt="Image" />
                    <div class="px-6 py-4">
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                            {{ $menu->name }}</h4>
                        <p class="leading-normal text-gray-700">
                            {{ $menu->description }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between p-4">
                        <span class="text-xl text-green-600">${{ $menu->price }}</span>
                    </div>
                </div>
            @endforeach 
            @else
            <tr class="border-gray-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 test-lg">
                    <p class="text-center">No Listings Found</p>
                </td>
            </tr>
            @endunless
             @endif
{{-- <h1>{{ $category->menues->name?? 'None' }}</h1> --}}
        </div>
    </div>
</x-guest-layout>
