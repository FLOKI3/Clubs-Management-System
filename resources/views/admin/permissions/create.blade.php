<x-admin-layout>
    @section('title', 'PERMISSIONS')
    <div class="flex flex-col items-center">
        <div style="padding: 20px" class="bg-white shadow-md rounded-lg">
            <h1 class="bg-gray-800" style="text-align: center; font-size: 30px; margin-bottom: 20px; border-radius:12px; padding:10px; color: white;">Create Permission</h1>
            <div style="width: 300px;">
                <form method="POST" action="{{route('admin.permissions.store')}}">
                    @csrf
                    @include('admin.permissions.fields')
                </form>
            </div>
        </div>
    </div>    
</x-admin-layout>
