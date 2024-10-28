<x-admin-layout>
    <div class="flex flex-col items-center">
        <div style="padding: 20px" class="bg-white shadow-md rounded-lg">
            <div style="width: 300px;">
                <div style="background-color: #d2d2d2; border-radius: 12px;" class="p-3">
                    <div>Username: <span style="font-weight: bold;">{{$user->name}}</span></div>
                    <div>Email: <span style="font-weight: bold;">{{$user->email}}</span></div>
                </div>


                <h1 style="text-align: center; font-size: 30px; margin-bottom: 20px; margin-top: 20px; background-color:#1f2937; border-radius:12px; padding:10px; color: white;">Roles</h1>
                @if ($user->roles)
                    @foreach ($user->roles as $user_role)
                        <form method="POST" action="{{route('admin.users.roles.remove', [$user->id, $user_role->id])}}" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')    
                            <button style="background-color: red; color: white; margin-bottom: 10px;" type="submit" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium">
                                {{ $user_role->name }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>
                    @endforeach
                @endif
                @can('Add roles')
                <form method="POST" action="{{route('admin.users.roles', $user->id)}}">
                    @csrf
                    <p>Add roles</p>
                    <select name="role" id="role" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        @foreach ($roles as $role)
                            <option value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach    
                    </select>
                    @error('name')
                        <span style="color: red" class="text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                    <div style="margin-top: 20px;" class="flex justify-end">
                        <button type="submit" style="background-color: blue;" class="px-4 py-2 text-white rounded-md">Add</button>
                        <a style="background-color: gray; margin-left: 5px;" href="{{route('admin.users.index')}}" class="px-4 py-2 text-white rounded-md">Cancel</a>
                    </div>
                </form>
                @endcan
            </div>
        </div>
    </div>


    
    
</x-admin-layout>
