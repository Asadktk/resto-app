<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('reservations.index') }}"
                class="px-4 m-2 py-2 bg-indigo-700 text-white top-4 left-6 rounded-lg">Reservations</a>
            <div class="w-full bg-slate-100 m-2 p-4 rounded-lg">

                <form method="POST" action="{{ route('reservations.update', $reservation) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label for="first_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                        <input type="text" name="first_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $reservation->first_name }}" >

                        @error('first_name')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="mb-6">
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                            Name</label>
                        <input name="last_name" rows="4" type="text"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $reservation->last_name }}">

                        @error('last_name')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="mb-6">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $reservation->email }}">

                        @error('email')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="mb-6">
                        <label for="tel_number"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile Number</label>
                        <input type="number" name="tel_number"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $reservation->tel_number }}">

                        @error('tel_number')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="mb-6">
                        <label for="res_date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reservation
                            Date</label>
                        <input type="datetime-local" name="res_date" value="{{ $reservation->res_date}}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        @error('res_date')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="mb-6">
                        <label for="guest_number"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guest Number</label>
                        <input type="number" name="guest_number"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $reservation->guest_number }}" >

                        @error('guest_number')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="mb-6">
                        <label for="table_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Table</label>

                        <select name="table_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                            @foreach ($tables as $table)
                                <option value="{{ $table->id }}" @selected($table->id == $reservation->table_id)>
                                    {{ $table->name }} ({{ $table->guest_number }} Guest)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                </form>
            </div>


        </div>
    </div>
</x-admin-layout>
