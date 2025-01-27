<x-admin-layout>
    @section('title', 'USERS')
    <div class="flex flex-col items-center">
        <div style="padding: 20px" class="bg-white shadow-md rounded-lg">
            <div class="w-full px-6 pb-8 sm:max-w-xl sm:rounded-lg">
                <h2 class="text-2xl font-bold sm:text-xl">Profile Information</h2>
                <div class="grid max-w-2xl mx-auto mt-8">
                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('admin.users.fields')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
