<x-admin-layout>
    @section('title', 'ROOMS')
    <div class="flex flex-col">
        @can('Create rooms')
                <div class="flex justify-end">
                    <a href="{{ route('admin.rooms.create') }}" type="button"
                        class="ml-2 text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-green-600 hover:bg-green-700 focus:ring-green-800">Create Room
                    </a>
                </div>
        @endcan
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div>
                    <table id="example" class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Room name</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase" >Club</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase" >Statut</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @foreach ($rooms as $room)
                                <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $room->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $room->club->name }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full {{ $room->status === 'active' ? 'bg-green-500' : 'bg-red-500' }} me-2"></div> {{ ucfirst($room->status) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex justify-center items-center">
                                        @can('Edit rooms')
                                    <a href="{{ route('admin.rooms.edit', $room->id) }}" type="button" class="text-white focus:ring-4 focus:outline-none font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                                        <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>
                                        <span class="sr-only">Edit</span>
                                    </a>
                                    @endcan
                                    @can('Delete rooms')
                                    <form method="POST" action="{{route('admin.rooms.destroy', $room->id)}}" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE') 
                                        <button type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 bg-red-600 hover:bg-red-700 focus:ring-red-800">
                                            <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                            </svg>
                                            <span class="sr-only">Delete</span>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
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

