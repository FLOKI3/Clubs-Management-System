<x-admin-layout>
    @section('title', 'SESSIONS')
    <div class="flex flex-col items-center">
        <div style="padding: 20px" class="bg-white shadow-md rounded-lg">
            <h1 style="text-align: center; font-size: 30px; margin-bottom: 20px; background-color:#1f2937; border-radius:12px; padding:10px; color: white;">Edit Crouse</h1>
            <div style="width: 300px;">
                <!-- Delete Button -->
            @can('Delete sessions')
            <form method="POST" action="{{ route('admin.courses.destroy', $course->id) }}" class="mt-4" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 bg-red-600 hover:bg-red-700 focus:ring-red-800">
                        <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                        </svg>
                        <span class="sr-only">Delete</span>
                    </button>
            </div>
            </form>
            @endcan
            <form method="POST" action="{{ route('admin.courses.update', $course->id) }}">
                @csrf
                @method('PUT')

                <!-- Lesson Dropdown -->
                <div>
                    <label for="lesson_id">Lesson:</label>
                    <select name="lesson_id" id="lesson_id" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required>
                        @foreach($lessons as $lesson)
                            <option value="{{ $lesson->id }}" {{ $course->lesson_id == $lesson->id ? 'selected' : '' }}>
                                {{ $lesson->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Room Dropdown -->
                <div>
                    <label class="mt-4" for="room_id">Room:</label>
                    <select name="room_id" id="room_id" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ $course->room_id == $room->id ? 'selected' : '' }}>
                                {{ $room->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Coach Dropdown -->
                <div>
                    <label class="mt-4" for="coach_id">Coach:</label>
                    <select name="coach_id" id="coach_id" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $course->coach_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Start and End Time -->
                <div>
                    <label class="mt-4" for="startTime">Start Time:</label>
                    <input type="datetime-local" name="startTime" id="startTime" value="{{ $course->startTime }}" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                </div>
                <div>
                    <label class="mt-4" for="endTime">End Time:</label>
                    <input type="datetime-local" name="endTime" id="endTime" value="{{ $course->endTime }}" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
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
