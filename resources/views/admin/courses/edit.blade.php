<x-admin-layout>
    <div class="flex flex-col items-center">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-center text-2xl mb-6">Edit Course</h1>
            <form method="POST" action="{{ route('admin.courses.update', $course->id) }}">
                @csrf
                @method('PUT')

                <!-- Lesson Dropdown -->
                <div>
                    <label for="lesson_id">Lesson:</label>
                    <select name="lesson_id" id="lesson_id" class="block w-full mt-2">
                        @foreach($lessons as $lesson)
                            <option value="{{ $lesson->id }}" {{ $course->lesson_id == $lesson->id ? 'selected' : '' }}>
                                {{ $lesson->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Room Dropdown -->
                <div>
                    <label for="room_id">Room:</label>
                    <select name="room_id" id="room_id" class="block w-full mt-2">
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ $course->room_id == $room->id ? 'selected' : '' }}>
                                {{ $room->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Coach Dropdown -->
                <div>
                    <label for="coach_id">Coach:</label>
                    <select name="coach_id" id="coach_id" class="block w-full mt-2">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $course->coach_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Start and End Time -->
                <div>
                    <label for="startTime">Start Time:</label>
                    <input type="datetime-local" name="startTime" id="startTime" value="{{ $course->startTime }}" class="block w-full mt-2">
                </div>
                <div>
                    <label for="endTime">End Time:</label>
                    <input type="datetime-local" name="endTime" id="endTime" value="{{ $course->endTime }}" class="block w-full mt-2">
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>

            <!-- Delete Button -->
            <form method="POST" action="{{ route('admin.courses.destroy', $course->id) }}" class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this course?')" 
                        class="btn btn-danger bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
                    Delete Course
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>
