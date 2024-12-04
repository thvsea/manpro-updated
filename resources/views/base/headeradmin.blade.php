<div class="p-4 mb-6 text-white bg-yellow-500">
        <div class="flex justify-between">
            <a href="{{ route('admin.index') }}" class="block p-2 text-center rounded-md">Admin</a>
            
            <div class="flex flex-row space-x-5">
                <a href="{{ route('admin.products') }}" class="block p-2 text-center rounded-md">Manage Products</a>
                <a href="{{ route('admin.users.index') }}" class="block p-2 text-center rounded-md">View Users</a>
                <a href="{{ route('admin.admins.index') }}" class="block p-2 text-center rounded-md">View Admins</a>
                <a href="{{ route('admin.orders') }}" class="block p-2 text-center rounded-md">Manage Orders</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full p-2 text-center transition bg-red-600 rounded-md hover:bg-red-900">Logout</button>
                </form>
            </div>
        </div>
</div>