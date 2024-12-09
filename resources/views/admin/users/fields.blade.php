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
    @if(Auth::user()->hasRole('manager') && Auth::user()->club)
    <input type="hidden" name="club_id" value="{{ Auth::user()->club->id }}">
    @else
    <div class="mb-2 sm:mb-6">
        <label class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">Club</label>
        <select name="club_id" id="club_id" class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" required>
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
    </div>
    @endif
    <div class="mb-2 sm:mb-6">
        <label class="block mb-2 text-sm font-medium text-indigo-900 dark:text-black">Role</label>
        <select name="role" id="role" class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" required>
                    <option value="manager" {{ old('role', $user->roles->contains('name', 'manager') ? 'manager' : '') == 'manager' ? 'selected' : '' }}>
                        Manager
                    </option>
                    <option value="coach" {{ old('role', $user->roles->contains('name', 'coach') ? 'coach' : '') == 'coach' ? 'selected' : '' }}>
                        Coach
                    </option>
            </select>
            @error('club_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="mt-4 flex justify-end">
        <button type="submit"
            class="text-white bg-indigo-700  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
        <a href="{{ route('admin.users.index') }}" type="button"
            class="ml-2 text-white bg-gray-700  hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Cancel
        </a>
    </div>
</div>