<x-admin-layout>
@section('title', 'CLUBS')
    <div class="flex flex-col">
        @can('Create clubs')
                <div class="flex justify-end">
                    <a href="{{route('admin.clubs.create')}}" type="button"
                        class="ml-2 text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-green-600 hover:bg-green-700 focus:ring-green-800">Create Club
                    </a>
                </div>
        @endcan
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div>
                    <table id="example" class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Club name</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase" >Managers</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($clubs as $club)
                                <tr>
                                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        @php
                                            $media = $club->getFirstMedia('clubs_logo');
                                            $imageUrl = $media ? asset('storage/' . $media->id . '/' . $media->file_name) : null;
                                        @endphp
                                        
                                        @if($imageUrl)
                                            <img src="{{ $imageUrl }}" alt="Clubs Logo" class="w-8 h-8 rounded-full object-cover">
                                        @else
                                            <img src="{{ asset('assets/images/no-image.png') }}" alt="Profile Picture" class="w-8 h-8 rounded-full">
                                        @endif
                                        <div class="ps-3">
                                            <div class="text-base font-semibold">{{$club->name}}</div>
                                        </div>  
                                    </th>
                                    
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                    @if ($managers[$club->id]->isNotEmpty())
                                        <ul>
                                            @foreach ($managers[$club->id] as $manager)
                                                <li>{{ $manager->name }} ({{ $manager->email }})</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <em>No managers assigned</em>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex justify-center items-center">
                                    @can('Edit clubs')
                                    <a href="{{route('admin.clubs.edit', $club->id)}}" type="button" class="text-white focus:ring-4 focus:outline-none font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                                        <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>
                                        <span class="sr-only">Edit</span>
                                    </a>
                                    @endcan
                                    @can('Delete clubs')
                                    <form method="POST" action="{{route('admin.clubs.destroy', $club->id)}}" onsubmit="return confirm('Are you sure?');">
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

