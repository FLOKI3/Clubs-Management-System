<x-admin-layout>
    <form method="POST" action="{{ route('admin.clubs.step2') }}">
        @csrf
        <div class="flex items-center justify-center">
            <div class="p-4 bg-white shadow-md rounded-lg" style="width: 700px">
                <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
                    <li class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
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
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/2048px-Default_pfp.svg.png" alt="Default Logo"/>
                    <div class="flex mt-2 md:mt-6">
                        <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Logo</a>
                    </div>
                    <div class="mt-4 max-w-sm">
                        <label for="name" class="block">Club Name</label>
                        <input type="text" name="club_name" id="name" value="{{ old('name') }}"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    @error('club_name')
                        <span style="color: red" class="text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                    <!-- Manager Select Dropdown -->
                    <div class="mt-4 max-w-sm">
                        <label for="manager_id" class="block">Select Manager</label>
                        <select name="manager_id" id="manager_id" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select a Manager</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('manager_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('manager_id')
                        <span style="color: red" class="text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mt-4 flex justify-between">
                    <a href="{{ route('admin.clubs.step1') }}"
                        class="text-gray-600 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-800">
                        Back
                    </a>
                    <button type="submit"
                        class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
