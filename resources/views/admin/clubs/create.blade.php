<x-admin-layout>
    @section('title', 'Create Club')

    <form method="POST" action="{{ route('admin.clubs.store') }}">
        @csrf
        <div class="p-4 bg-white shadow-md rounded-lg" style="max-width: 600px; margin: auto;">
            <h2 class="text-xl font-semibold mb-4">Create a New Club</h2>

            <!-- Club Name -->
            <div class="mb-4">
                <label for="club_name" class="block text-sm font-medium text-gray-700">Club Name</label>
                <input type="text" name="club_name" id="club_name" value="{{ old('club_name') }}"
                    class="py-2 px-4 block w-full border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                @error('club_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <a href="{{ route('admin.clubs.index') }}"
                    class="text-gray-600 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2">
                    Cancel
                </a>
                <button type="submit"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Create Club
                </button>
            </div>
        </div>
    </form>
</x-admin-layout>
