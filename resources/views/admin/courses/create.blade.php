<x-admin-layout>
    <h1 class="text-lg font-bold mb-4">Create Course</h1>
    <form action="{{ route('admin.courses.store') }}" method="POST">
        @csrf

        <!-- Club Selection -->
        @if(isset($club))
            <input type="hidden" name="club_id" value="{{ $club->id }}">
        @endif
        <!-- Lesson Selection -->
        <div class="mb-4">
            <label for="lesson_id" class="block text-sm font-medium">Lesson</label>
            <select name="lesson_id" id="lesson_id" class="block w-full border-gray-300 rounded-md">
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
            <select name="room_id" id="room_id" class="block w-full border-gray-300 rounded-md">
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
            <select name="coach_id" id="coach_id" class="block w-full border-gray-300 rounded-md">
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
            <input type="datetime-local" name="startTime" id="startTime" class="block w-full border-gray-300 rounded-md">
            @error('startTime')
                <span style="color: red" class="text-sm">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <!-- End Time -->
        <div class="mb-4">
            <label for="endTime" class="block text-sm font-medium">End Time</label>
            <input type="datetime-local" name="endTime" id="endTime" class="block w-full border-gray-300 rounded-md">
            @error('endTime')
                <span style="color: red" class="text-sm">
                    {{ $message }}
                </span>
            @enderror
        </div>
        

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Create Course</button>
    </form>
</x-admin-layout>
