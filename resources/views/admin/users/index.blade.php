<x-admin-layout>
  <div class="flex flex-col">
      <div class="-m-1.5 overflow-x-auto">
          <div class="p-1.5 min-w-full inline-block align-middle">
              <div class="border rounded-lg shadow overflow-hidden">
                  <table class="w-full divide-y divide-gray-200">
                      <thead class="bg-gray-50">
                          <tr>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase"></th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Username</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Full name</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Email</th>
                              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Roles</th>
                              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Action</th>
                          </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200">
                          @foreach ($users as $user)
                              <tr>
                                <td style="padding-left: 20px;"><img class="w-9 h-9 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="Jese image"></td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{$user->name}}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{$user->first_name}} {{$user->last_name}}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{$user->email}}</td>
                              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                  @foreach ($user->roles as $role)
                                  <span style="color: white" class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $role->name }}</span>
                                  @endforeach
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                  <a href="{{route('admin.users.show', $user->id)}}" type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Edit</a>
                                  @can('Delete users')
                                  <form method="POST" action="{{route('admin.users.destroy', $user->id)}}" onsubmit="return confirm('Are you sure?');">
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
