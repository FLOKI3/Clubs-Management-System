<x-admin-layout>
    @section('title', 'USERS')
    <div class="flex flex-col items-center">
        <div style="padding: 20px" class="bg-white shadow-md rounded-lg">
            <div class="w-full px-6 pb-8 sm:max-w-xl sm:rounded-lg">
                <h2 class="text-2xl font-bold sm:text-xl">Create user</h2>
                <div class="grid max-w-2xl mx-auto">
                    <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="items-center mt-8 sm:mt-14 text-[#202142]">
                            <div
                                class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                                <div class="w-full">
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">
                                        Username</label>
                                    <input type="text" id="name" name="name"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        placeholder="Username" value="">
                                        @error('name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                </div>
                                
                                <div class="w-full">
                                    <label for="first_name"
                                        class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">
                                        First name</label>
                                    <input type="text" id="first_name" name="first_name"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        placeholder="First name" value="">
                                        @error('first_name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="w-full">
                                    <label for="last_name"
                                        class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">
                                        Last name</label>
                                    <input type="text" id="last_name" name="last_name"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        placeholder="Last name" value="">
                                        @error('last_name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="mb-2 sm:mb-6">
                                <label for="phone_number"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">
                                    Phone N°</label>
                                <input type="text" id="phone_number" name="phone_number"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    placeholder="+123456789" value="">
                                    @error('phone_number')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                            </div>
                            <div class="mb-2 sm:mb-6">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">
                                    Email</label>
                                <input type="email" id="email" name="email"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    placeholder="email@gmail.com" value="">
                                    @error('email')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                            </div>
                            <div class="mb-2 sm:mb-6">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">
                                    Password</label>
                                <input type="password" id="password" name="password"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    value="">
                                    @error('password')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                            </div>
                            <div class="mb-2 sm:mb-6">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">
                                    Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    value="">
                                    @error('password_confirmation')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                            </div>
                            @if(Auth::user()->hasRole('manager') && Auth::user()->club)
                            <input type="hidden" name="club_id" value="{{ Auth::user()->club->id }}">
                            @else
                            <div class="mb-2 sm:mb-6">
                            <label class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">Club</label>
                            <select name="club_id" id="club_id" class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                                    <option value="" disabled selected>Select Club</option>
                                    @foreach ($clubs as $club)
                                        <option value="{{ $club->id }}" {{ old('club_id') == $club->id ? 'selected' : '' }}>
                                            {{ $club->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('club_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif
                            <div class="mb-2 sm:mb-6">
                            <label class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">Add Role</label>
                            <select name="role" id="role" class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                                    <option value="" disabled selected>Select Role</option>
                                    <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="coach" {{ old('role') == 'coach' ? 'selected' : '' }}>Coach</option>
                                </select>
                                @error('role')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="mt-4 flex justify-end">
                                <button type="submit"
                                    class="text-white bg-indigo-700  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
                                <a href="{{ route('admin.users.index') }}" type="button"
                                    class="ml-2 text-white bg-gray-700  hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
