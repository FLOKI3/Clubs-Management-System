<x-admin-layout>
    <div class="flex flex-col items-center">
        <div style="padding: 20px" class="bg-white shadow-md rounded-lg">
            <h1 style="text-align: center; font-size: 30px; margin-bottom: 20px; background-color:#1f2937; border-radius:12px; padding:10px; color: white;">Create Role</h1>
            <div style="width: 300px;">
                <form method="POST" action="{{route('admin.roles.store')}}">
                    @csrf
                    <div class="max-w-sm">
                        <label>Role name</label>
                        <input type="text" name="name" id="input-label" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    @error('name')
                        <span style="color: red" class="text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                    <p class="mt-4">Add permissions</p>
                    <select name="permissions[]" id="multiselect" multiple>
                        @foreach ($permissions as $permission)
                            <option value="{{$permission->name}}">{{$permission->name}}</option>
                        @endforeach    
                    </select>
                    @error('permissions')
                        <span style="color: red" class="text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                    <div style="margin-top: 20px;" class="flex justify-end">
                        <button type="submit" style="background-color: blue;" class="px-4 py-2 text-white rounded-md">Submit</button>
                        <a style="background-color: gray; margin-left: 5px;" href="{{route('admin.roles.index')}}" class="px-4 py-2 text-white rounded-md">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
