<x-admin-layout>
    <div class="flex flex-col items-center">
        <div style="padding: 20px" class="bg-white shadow-md rounded-lg">
            <h1 style="text-align: center; font-size: 30px; margin-bottom: 20px; background-color:#1f2937; border-radius:12px; padding:10px; color: white;">Edit Role</h1>
            <div style="width: 300px;">
                <form method="POST" action="{{route('admin.roles.update', $role->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="max-w-sm">
                        <label>Role name</label>
                        <input value="{{$role->name}}" type="text" name="name" id="input-label" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    @error('name')
                        <span style="color: red" class="text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                    <div class="mt-4 flex justify-end">
                        <button type="submit"
                            class="text-white bg-indigo-700  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
                        <a href="{{ route('admin.roles.index') }}" type="button"
                            class="ml-2 text-white bg-gray-700  hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex flex-col items-center mt-3">
            <div style="padding: 20px" class="bg-white shadow-md rounded-lg">
                <h1 style="text-align: center; font-size: 30px; margin-bottom: 20px; background-color:#1f2937; border-radius:12px; padding:10px; color: white;">Role Permissions</h1>
                <div style="width: 300px;">
                    @if ($role->permissions)
                        @foreach ($role->permissions as $role_permission)
                            <form method="POST" action="{{route('admin.roles.permissions.revoke', [$role->id, $role_permission->id])}}" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')    
                                <button style="background-color: red; color: white; margin-bottom: 10px;" type="submit" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $role_permission->name }}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        @endforeach
                    @endif
                </div>

                <form method="POST" action="{{route('admin.roles.permissions', $role->id)}}">
                    @csrf
                    <p>Add permissions</p>
                    <select name="permission" id="permission" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        @foreach ($permissions as $permission)
                            <option value="{{$permission->name}}">{{$permission->name}}</option>
                        @endforeach    
                    </select>
                    <div class="mt-4 flex justify-end">
                        <button type="submit"
                            class="text-white bg-indigo-700  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</x-admin-layout>
