<x-admin-layout>
    <div class="flex flex-col items-center">
        <div style="padding: 20px" class="bg-white shadow-md rounded-lg">
            <h1 style="text-align: center; font-size: 30px; margin-bottom: 20px; background-color:#1f2937; border-radius:12px; padding:10px; color: white;">Edit Permission</h1>
            <div style="width: 300px;">
                <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
                    @csrf
                    @method('PUT')
                    <div class="max-w-sm">
                        <label>Permission name</label>
                        <input value="{{ $permission->name }}" type="text" name="name" id="input-label" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    @error('name')
                        <span style="color: red" class="text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                    <p class="mt-4">Add Roles</p>
                    <select name="roles[]" id="multiselect" multiple>
                        @foreach ($roles as $role)
                            <option value="{{$role->name}}"
                                @if($permission->roles->contains($role)) selected @endif>
                                {{$role->name}}</option>
                        @endforeach    
                    </select>
                    @error('roles')
                        <span style="color: red" class="text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                    <div class="mt-4 flex justify-end">
                        <button type="submit"
                            class="text-white bg-indigo-700  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
                        <a href="{{ route('admin.permissions.index') }}" type="button"
                            class="ml-2 text-white bg-gray-700  hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>


       
</x-admin-layout>
