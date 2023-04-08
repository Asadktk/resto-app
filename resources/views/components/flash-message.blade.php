@if (session()->has('success'))
    
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"  class="flex p-4 mb-4 text-sm text-green-500 m-7 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-blue-500">
        <p>
            {{ session('success') }}
        </p>
    </div>

@endif

@if (session()->has('danger'))
    
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"  class="flex p-4 mb-4 text-sm text-red-500 rounded-lg m-7 bg-red-50 dark:bg-gray-800 dark:text-red-400">
        <p>
            {{ session('danger') }}
        </p>
    </div>

@endif

@if (session()->has('warning'))
    
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"  class="flex p-4 mb-4 text-sm text-warning-800 rounded-lg m-7 bg-orange-100 dark:bg-gray-800  dark:text-orange-400">
        <p>
            {{ session('warning') }}
        </p>
    </div>

@endif