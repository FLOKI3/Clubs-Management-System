<x-admin-layout>
    <div class="flex flex-col">
        @can('Create permissions')
                <div class="flex justify-end pb-3">
                    <a style="background-color: green; transition: background-color 0.3s;"
                    onmouseover="this.style.backgroundColor='#28a745'"
                    onmouseout="this.style.backgroundColor='green'" href="{{route('admin.permissions.create')}}" class="px-4 py-2 text-white rounded-md">Create Permission</a>
                </div>
                @endcan
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                
                <div class="border rounded-lg shadow overflow-hidden">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Permissions</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Roles</th>
                                @canany(['Edit permissions', 'Delete permissions'])
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Action</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($permissions as $permission)
                                <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{$permission->name}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                    @foreach ($permission->roles as $role)
                                    <span style="color: white" class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    @can('Edit permissions')
                                    <a href="{{route('admin.permissions.edit', $permission->id)}}" type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Edit</a>
                                    @endcan
                                    @can('Delete permissions')
                                    <form method="POST" action="{{route('admin.permissions.destroy', $permission->id)}}" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')    
                                        <button type="submit" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 focus:outline-none focus:text-red-800 disabled:opacity-50 disabled:pointer-events-none">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
