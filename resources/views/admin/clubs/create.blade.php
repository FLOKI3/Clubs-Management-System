<x-admin-layout>
    <div class="flex flex-col items-center">
        <div style="padding: 20px" class="bg-white shadow-md rounded-lg">
            <h1 style="text-align: center; font-size: 30px; margin-bottom: 20px; background-color:#1f2937; border-radius:12px; padding:10px; color: white;">Create Club</h1>
            <div style="width: 300px;">
                <form method="POST" action="{{route('admin.clubs.store')}}">
                    @csrf
                    
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>