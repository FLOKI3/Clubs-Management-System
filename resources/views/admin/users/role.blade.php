<x-admin-layout>
    <div class="p-2 md:p-4">
        <div class="w-full px-6 pb-8 sm:max-w-xl sm:rounded-lg">
            <h2 class="text-2xl font-bold sm:text-xl">Profile Information</h2>
            <div class="grid max-w-2xl mx-auto mt-8">
                <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col items-center space-y-5 sm:flex-row sm:space-y-0">
                        <!-- Profile Picture Preview -->
                        @php
                            $media = $user->getFirstMedia('profile_pictures');
                            $imageUrl = $media ? asset('storage/' . $media->id . '/' . $media->file_name) : null;
                        @endphp
                        @if($imageUrl)
                            <img class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                                src="{{ $imageUrl }}"
                                alt="avatar">
                            @else
                                <img class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/2048px-Default_pfp.svg.png"
                                    alt="Bordered avatar">
                        @endif
                        <div class="flex flex-col space-y-5 sm:ml-8">
                            <label style="cursor: pointer;" type="file" name="profile_picture"
                                class="py-3.5 px-7 text-base font-medium text-indigo-100 focus:outline-none bg-[#202142] rounded-lg border border-indigo-200 hover:bg-indigo-900 focus:z-10 focus:ring-4 focus:ring-indigo-200 ">
                                Change picture
                                <input type="file" id='uploadFile1' class="hidden" name="profile_picture" />
                            </label>
                            <!--
                            <button type="button"
                                class="py-3.5 px-7 text-base font-medium text-indigo-900 focus:outline-none bg-white rounded-lg border border-indigo-200 hover:bg-indigo-100 hover:text-[#202142] focus:z-10 focus:ring-4 focus:ring-indigo-200 ">
                                Delete picture
                            </button>
                            -->
                        </div>
                    </div>
                    <div class="items-center mt-8 sm:mt-14 text-[#202142]">
                        <div
                            class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                            <div class="w-full">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">
                                    Username</label>
                                <input type="text" id="name" name="name"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    placeholder="Username" value="{{ old('first_name', $user->name) }}" required>
                            </div>
                            <div class="w-full">
                                <label for="first_name"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">
                                    First name</label>
                                <input type="text" id="first_name" name="first_name"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    placeholder="First name" value="{{ old('first_name', $user->first_name) }}"
                                    required>
                            </div>
                            <div class="w-full">
                                <label for="last_name"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">
                                    Last name</label>
                                <input type="text" id="last_name" name="last_name"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    placeholder="Last name" value="{{ old('last_name', $user->last_name) }}" required>
                            </div>
                        </div>
                        <div class="mb-2 sm:mb-6">
                            <label for="phone_number"
                                class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">
                                Phone N°</label>
                            <input type="text" id="phone_number" name="phone_number"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                placeholder="email@mail.com" value="{{ old('email', $user->phone_number) }}" required>
                        </div>
                        <div class="mb-2 sm:mb-6">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">
                                Email</label>
                            <input type="email" id="email" name="email"
                                class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                placeholder="email@mail.com" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="text-white bg-indigo-700  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
                            <a href="{{ route('admin.users.index') }}" type="button"
                                class="ml-2 text-white bg-gray-700  hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Cancel
                            </a>
                        </div>
                    </div>
                </form>
                <div>
                    <h2 class="text-2xl font-bold sm:text-xl">User Roles</h2>
                    <div style="width: 300px;" class="mt-4">
                        @if ($user->roles)
                            @foreach ($user->roles as $user_role)
                                <form method="POST"
                                    action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button style="background-color: red; color: white; margin-bottom: 10px;"
                                        type="submit"
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $user_role->name }}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            @endforeach
                        @endif
                        @can('Add roles')
                            <form method="POST" action="{{ route('admin.users.roles', $user->id) }}" class="mt-4">
                                @csrf
                                <label class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">Add
                                    roles</label>
                                <select name="role" id="role"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('name')
                                    <span style="color: red" class="text-sm">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <div style="margin-top: 20px;" class="flex justify-end">
                                    <button type="submit"
                                        class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Add</button>
                                </div>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
