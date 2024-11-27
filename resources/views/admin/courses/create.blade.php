<x-admin-layout>
    <div class="flex flex-col items-center">
        <div style="padding: 20px" class="bg-white shadow-md rounded-lg">
            <h1 style="text-align: center; font-size: 30px; margin-bottom: 20px; background-color:#1f2937; border-radius:12px; padding:10px; color: white;">Create Room</h1>
            <div style="width: 300px;">
    <form action="{{ route('admin.courses.store') }}" method="POST">
        @csrf

        <!-- Club Selection -->
        @if(isset($club))
            <input type="hidden" name="club_id" value="{{ $club->id }}">
        @endif
        <!-- Lesson Selection -->
        <div class="mb-4">
            <label for="lesson_id" class="block text-sm font-medium">Lesson</label>
            <select name="lesson_id" id="lesson_id" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required>
                @foreach($lessons as $lesson)
                    <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                @endforeach
            </select>
            @error('lesson_id')
                <span style="color: red" class="text-sm">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <!-- Room Selection -->
        <div class="mb-4">
            <label for="room_id" class="block text-sm font-medium">Room</label>
            <select name="room_id" id="room_id" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>
            @error('room_id')
                <span style="color: red" class="text-sm">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <!-- Coach Selection -->
        <div class="mb-4">
            <label for="coach_id" class="block text-sm font-medium">Coach</label>
            <select name="coach_id" id="coach_id" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('coach_id')
                <span style="color: red" class="text-sm">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <!-- Start Time -->
        <div class="mb-4">
            <label for="startTime" class="block text-sm font-medium">Start Time</label>
            <input type="datetime-local" name="startTime" id="startTime" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
            @error('startTime')
                <span style="color: red" class="text-sm">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <!-- End Time -->
        <div class="mb-4">
            <label for="endTime" class="block text-sm font-medium">End Time</label>
            <input type="datetime-local" name="endTime" id="endTime" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
            @error('endTime')
                <span style="color: red" class="text-sm">
                    {{ $message }}
                </span>
            @enderror
        </div>
        

        <!-- Submit Button -->
        <div class="mt-4 flex justify-end">
            <button type="submit"
                    class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save
            </button>
            <a href="{{ route('admin.courses.index') }}" type="button"
               class="ml-2 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Cancel
            </a>
        </div>
    </form>
</div>
</div>
</div>
</x-admin-layout>
