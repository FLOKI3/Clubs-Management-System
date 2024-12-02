<x-admin-layout>
@section('title', 'CLUBS')
    <form method="POST" action="{{route('admin.clubs.step1')}}">
        @csrf
    <div class="flex items-center justify-center">
        <div class="p-4 bg-white shadow-md rounded-lg" style="width: 700px">
            <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
                <li class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <span class="me-2">1</span>
                        Create <span class="hidden sm:inline-flex sm:ms-2">Role</span>
                    </span>
                </li>
                <li class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <span class="me-2">2</span>
                        Create <span class="hidden sm:inline-flex sm:ms-2">Club</span>
                    </span>
                </li>
                <li class="flex items-center">
                    <span class="me-2">3</span>
                    Confirmation
                </li>
            </ol>
            <div class="mt-4 flex flex-col items-center pb-10">
                
            <div class="mt-4 max-w-sm">
                <label for="name" class="block">Role Name</label>
                <input type="text" name="guard_name" id="name"
                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
            </div>
            @error('guard_name')
                <span style="color: red" class="text-sm">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="mt-4 flex justify-end">
            <button type="submit"
                class="text-white bg-indigo-700  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Next</button>
        </div>
    </div>
</form>
</x-admin-layout>