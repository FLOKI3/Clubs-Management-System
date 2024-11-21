<x-admin-layout>
    <form method="POST" action="{{ route('admin.clubs.step3') }}">
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
                    <li class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                        <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            Create <span class="hidden sm:inline-flex sm:ms-2">Club</span>
                        </span>
                    </li>
                    <li class="flex items-center text-blue-600 dark:text-blue-500">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        Confirmation
                    </li>
                </ol>

                <div class="mt-4 flex flex-col items-center pb-10">
                    <h2 class="text-lg font-bold">Review Your Details</h2>
                    
                    <!-- Display the role name from session -->
                    <div class="mt-4 max-w-sm">
                        <p><strong>Club Name:</strong> {{ session('step2')['club_name'] }}</p>
                        <p><strong>Role Name: </strong>{{ $step1['role_name'] }}</p>
                    </div>
                    <div class="mt-4 w-full bg-gray-100 p-4 rounded-lg">
                        <h3 class="font-semibold text-lg">Manager Details</h3>
                        <p><strong>Username:</strong> {{ $manager->name }}</p>
                        <p><strong>Full name:</strong> {{ $manager->first_name }} {{ $manager->last_name }}</p>
                        <p><strong>Email:</strong> {{ $manager->email }}</p>
                        <p><strong>Joined:</strong> {{ $manager->created_at->format('M d, Y') }}</p>
                    </div>
                </div>

                <div class="mt-4 flex justify-between">
                    <!-- Back Button -->
                    <a href="{{ route('admin.clubs.step2') }}"
                        class="text-gray-600 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-800">
                        Back
                    </a>
                    
                    <!-- Submit Button to finalize -->
                    <button type="submit"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
