<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CLUBS.MA | @yield('title')</title>

    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">

    <!-- Multi-select -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- DataTables CSS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">

    <!-- Full Calendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <nav class="fixed top-0 z-50 w-full bg-gray-800 border-b border-gray-700">
        
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            
            <div class="flex items-center justify-between">
                
                <div class="flex items-center justify-startP rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm rounded-lg sm:hidden focus:outline-none focus:ring-2 text-gray-400 hover:bg-gray-700 focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="{{route('admin.index')}}" class="flex ms-2 md:me-24">
                        <img src="{{  URL('assets/images/logo.png')}}" class="h-9 ml-3" alt="FlowBite Logo" />
                        <span
                            class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-white"></span>
                    </a>
                </div>
                
                <div class="flex items-center">
                    <div class="flex items-center ms-3 object-cover">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                @php
                                    $media = auth()->user()->getFirstMedia('profile_pictures');
                                    $imageUrl = $media ? asset('storage/' . $media->id . '/' . $media->file_name) : null;
                                @endphp
                                
                                @if($imageUrl)
                                    <img src="{{ $imageUrl }}" alt="Profile Picture" class="w-8 h-8 rounded-full object-cover">
                                @else
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/2048px-Default_pfp.svg.png" alt="Profile Picture" class="w-8 h-8 rounded-full">
                                @endif
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none divide-y rounded shadow bg-gray-700 divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-white" role="none">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-sm font-medium truncate text-gray-300" role="none">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="{{ route('profile.edit') }}"
                                        class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 hover:text-white"
                                        role="menuitem">Profile</a>
                                </li>
                                <ul class="py-1" role="none">

                                    <li>
                                        <form style="cursor: pointer;"
                                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-600 hover:text-white"
                                            method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <a :href="route('logout')"
                                                onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </a>
                                        </form>

                                    </li>
                                </ul>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gray-800 border-r border-gray-700 sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('admin.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                        <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z"/>
                            <path d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z"/>
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                @can('Manage clubs')
                <li>
                    <a href="{{ route('admin.clubs.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                        <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ms-3">Clubs</span>
                    </a>
                </li>
                @endcan
                @can('Manage rooms')
                <li>
                    <a href="{{ route('admin.rooms.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                        <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 19V5h4a1 1 0 0 1 1 1v11h1a1 1 0 0 1 0 2h-6Z"/>
                            <path fill-rule="evenodd" d="M12 4.571a1 1 0 0 0-1.275-.961l-5 1.428A1 1 0 0 0 5 6v11H4a1 1 0 0 0 0 2h1.86l4.865 1.39A1 1 0 0 0 12 19.43V4.57ZM10 11a1 1 0 0 1 1 1v.5a1 1 0 0 1-2 0V12a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ms-3">Rooms</span>
                    </a>
                </li>
                @endcan
                @can('Manage lessons')
                <li>
                    <a href="{{ route('admin.lessons.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                        <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ms-3">Lessons</span>
                    </a>
                </li>
                @endcan
                @can('Manage sessions')
                <li>
                    <a href="{{ route('admin.courses.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                        <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ms-3">Sessions</span>
                    </a>
                </li>
                @endcan
                @can('Manage users')
                <li>
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                        <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                        
                    </a>
                </li>
                @endcan
                @can('Manage roles')
                <li>
                    <a href="{{ route('admin.roles.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                        <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M4.857 3A1.857 1.857 0 0 0 3 4.857v4.286C3 10.169 3.831 11 4.857 11h4.286A1.857 1.857 0 0 0 11 9.143V4.857A1.857 1.857 0 0 0 9.143 3H4.857Zm10 0A1.857 1.857 0 0 0 13 4.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 9.143V4.857A1.857 1.857 0 0 0 19.143 3h-4.286Zm-10 10A1.857 1.857 0 0 0 3 14.857v4.286C3 20.169 3.831 21 4.857 21h4.286A1.857 1.857 0 0 0 11 19.143v-4.286A1.857 1.857 0 0 0 9.143 13H4.857Zm10 0A1.857 1.857 0 0 0 13 14.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 19.143v-4.286A1.857 1.857 0 0 0 19.143 13h-4.286Z" clip-rule="evenodd"/>
                        </svg>                          
                        <span class="flex-1 ms-3 whitespace-nowrap">Roles</span>

                    </a>
                </li>
                @endcan
                @can('Manage permissions')
                <li>
                    <a href="{{ route('admin.permissions.index') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                        <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M8 7V2.221a2 2 0 0 0-.5.365L3.586 6.5a2 2 0 0 0-.365.5H8Zm2 0V2h7a2 2 0 0 1 2 2v.126a5.087 5.087 0 0 0-4.74 1.368v.001l-6.642 6.642a3 3 0 0 0-.82 1.532l-.74 3.692a3 3 0 0 0 3.53 3.53l3.694-.738a3 3 0 0 0 1.532-.82L19 15.149V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M17.447 8.08a1.087 1.087 0 0 1 1.187.238l.002.001a1.088 1.088 0 0 1 0 1.539l-.377.377-1.54-1.542.373-.374.002-.001c.1-.102.22-.182.353-.237Zm-2.143 2.027-4.644 4.644-.385 1.924 1.925-.385 4.644-4.642-1.54-1.54Zm2.56-4.11a3.087 3.087 0 0 0-2.187.909l-6.645 6.645a1 1 0 0 0-.274.51l-.739 3.693a1 1 0 0 0 1.177 1.176l3.693-.738a1 1 0 0 0 .51-.274l6.65-6.646a3.088 3.088 0 0 0-2.185-5.275Z" clip-rule="evenodd"/>
                        </svg>                         
                        <span class="flex-1 ms-3 whitespace-nowrap">Permissions</span>
                    </a>
                </li>
                @endcan
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                        <svg class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
                        </svg>                          
                        <span class="flex-1 ms-3 whitespace-nowrap">Home</span>
                    </a>
                </li>
            </ul>
        </div>
        
    </aside>
    
    <div class="p-4 sm:ml-64 flex justify-center items-center">
        <!-- class='border-2' -->
        <div class="p-4 border-dashed rounded-lg border-gray-700 mt-14 w-full">
            @if (Session::has('message'))
                <div id="toast-success" class="flex items-center w-full max-w-sm p-4 mb-4 rounded-lg shadow text-gray-400 bg-gray-800 mx-auto" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg bg-blue-800 text-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                      </svg>
                      
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{Session::get('message')}}</div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex items-center justify-center h-8 w-8 text-gray-500 hover:text-white bg-gray-800 hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            @endif
            
            
            {{$slot}}
        </div>
    </div>
    
</body>
<script src="./node_modules/preline/dist/preline.js"></script>
<script src="https://unpkg.com/flowbite@latest/dist/flowbite.js"></script>
<script>
    new DataTable('#example');
</script>
<script>
    new MultiSelectTag('multiselect', {
    rounded: true,    // default true
    shadow: false,      // default false
    placeholder: 'Search',  // default Search...
    tagColor: {
        textColor: '#327b2c',
        borderColor: '#92e681',
        bgColor: '#eaffe6',
    },
    onChange: function(values) {
        console.log(values)
    }
})
</script>

</html>
