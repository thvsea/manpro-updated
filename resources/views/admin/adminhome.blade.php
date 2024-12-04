@extends('template.layoutadmin')

@section('section')
<div class="container mx-auto">
    <h1 class="mb-6 text-3xl font-bold">Admin Dashboard</h1>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
        <a href="{{ route('admin.products') }}" class="block p-4 text-white bg-blue-500 rounded-md">Manage Products</a>
        <a href="{{ route('admin.users.index') }}" class="block p-4 text-white bg-green-500 rounded-md">View Users</a>
        <a href="{{ route('admin.admins.index') }}" class="block p-4 text-white bg-purple-500 rounded-md">View Admins</a>
        <a href="{{ route('admin.orders') }}" class="block p-4 text-white bg-yellow-500 rounded-md">Manage Orders</a>
    </div>
</div>
@endsection
