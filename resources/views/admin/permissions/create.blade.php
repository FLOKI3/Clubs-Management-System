<x-admin-layout>
    <div class="flex flex-col items-center">
        <div style="padding: 20px" class="bg-white shadow-md rounded-lg">
            <h1 class="bg-gray-800" style="text-align: center; font-size: 30px; margin-bottom: 20px; border-radius:12px; padding:10px; color: white;">Create Permission</h1>
            <div style="width: 300px;">
                <form method="POST" action="{{route('admin.permissions.store')}}">
                    @csrf
                    <div class="max-w-sm">
                        <label>Permission name</label>
                        <input type="text" name="name" id="input-label" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    @error('name')
                        <span style="color: red" class="text-sm">
                            {{ $message }}
                        </span>
                    @enderror                   
                    <div style="margin-top: 20px;" class="flex justify-end">
                        <button type="submit" style="background-color: blue;" class="px-4 py-2 text-white rounded-md">Submit</button>
                        <a style="background-color: gray; margin-left: 5px;" href="{{route('admin.permissions.index')}}" class="px-4 py-2 text-white rounded-md">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</x-admin-layout>
