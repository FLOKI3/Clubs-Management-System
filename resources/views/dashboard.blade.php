<x-app-layout>
    

    <div class="min-h-screen bg-gray-900 flex flex-col items-center justify-center">
        <h1 class="text-5xl text-white font-bold mb-8 animate-pulse">
            Coming Soon
        </h1>
        <p class="text-white text-lg mb-8">
            I'm working hard to bring you something amazing. Stay tuned!
        </p>
        @can('Dashboard access')
        <a class="text-blue-800 text-lg mb-8 underline " href="{{route('admin.index')}}">Dashboard</a>
        @endcan
    </div>
</x-app-layout>
