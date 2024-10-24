<x-admin-layout>
    <div class="flex flex-col">
        @can('Create roles')
                <div class="flex justify-end pb-3">
                    <a style="background-color: green; transition: background-color 0.3s;"
                    onmouseover="this.style.backgroundColor='#28a745'"
                    onmouseout="this.style.backgroundColor='green'" href="{{route('admin.roles.create')}}" class="px-4 py-2 text-white rounded-md">Create Role</a>
                </div>
                @endcan
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="border rounded-lg shadow overflow-hidden">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Roles</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase" >Permissions</th>
                                @canany(['Edit roles', 'Delete roles'])
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Action</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($roles as $role)
                                <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{$role->name}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                    @foreach ($role->permissions as $index => $permission)
                                        <span style="color: white" class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                            {{ $permission->name }}
                                        </span>
                                        @if (($index + 1) % 8 == 0 && !$loop->last)
                                            </div><div class="pt-2">
                                        @endif
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    @can('Edit roles')
                                    <a href="{{route('admin.roles.edit', $role->id)}}" type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Edit</a>
                                    @endcan
                                    @can('Delete roles')
                                    <form method="POST" action="{{route('admin.roles.destroy', $role->id)}}" onsubmit="return confirm('Are you sure?');">
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

