    <x-admin-layout>
        <div class="flex flex-col items-center">
            <div style="padding: 20px" class="bg-white shadow-md rounded-lg">
                <h1 style="text-align: center; font-size: 30px; margin-bottom: 20px; background-color:#1f2937; border-radius:12px; padding:10px; color: white;">Edit Room</h1>
                <div style="width: 300px;">
                    <form method="POST" action="{{ route('admin.rooms.update', $room->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="max-w-sm">
                            <label for="name" class="block">Room name</label>
                            <input type="text" name="name" id="name" value="{{ $room->name }}"
                                   class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        </div>
                        @error('name')
                            <span style="color: red" class="text-sm">
                                {{ $message }}
                            </span>
                        @enderror
                        @if(isset($club))
                            <input type="hidden" name="club_id" value="{{ $club->id }}">
                        @else
                            <p class="mt-4">Edit Club</p>
                            <select name="club_id" id="club_id" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required>
                                    @foreach ($clubs as $club)
                                        <option value="{{ $club->id }}" {{ old('club_id', $room->club_id ?? '') == $club->id ? 'selected' : '' }}>
                                            {{ $club->name }}
                                        </option>
                                    @endforeach
                            </select>
                            @error('club_id')
                                <span style="color: red" class="text-sm">
                                    {{ $message }}
                                </span>
                            @enderror
                        @endif
                        
                        <div class="mt-4 flex justify-end">
                            <button type="submit"
                                    class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save
                            </button>
                            <a href="{{ route('admin.rooms.index') }}" type="button"
                               class="ml-2 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-admin-layout>