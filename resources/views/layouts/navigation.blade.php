<header>
    <nav class="border-gray-200 px-4 lg:px-6 py-2.5 bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="#" class="flex items-center">
                <img src="{{  URL('assets/images/v.png')}}" class="h-9 sm:h-9" alt="Flowbite Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap text-white">ALHALLA</span>
            </a>
            <div class="flex items-center lg:order-2">
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
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="{{ route('dashboard') }}" class="block py-2 pr-4 pl-3 rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 text-white" aria-current="page">Home</a>
                    </li>
                    @can('Dashboard access')
                    <li>
                        <a href="{{ route('admin.index') }}" class="block py-2 pr-4 pl-3 border-b lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 text-gray-400 lg hover:bg-gray-700 hover:text-white lg hover:bg-transparent border-gray-700">Dashboard</a>
                    </li>    
                    @endcan
                    
                    
                    
                </ul>
            </div>
        </div>
    </nav>
</header>
<script src="https://unpkg.com/flowbite@latest/dist/flowbite.js"></script>