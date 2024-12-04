@extends('template.layoutadmin')

@section('section')
<div class="container px-4 py-8 mx-auto">
    <div class="mx-auto max-w-7xl">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Users List</h2>
            </div>
            
            <div class="p-6">
                <a href="{{ route('admin.users.create') }}" class="inline-block px-3 py-2 mb-3 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">Create</a>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">ID</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">Name</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">Email</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($models as $model)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $model->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $model->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $model->email }}</td>
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.users.edit', $model->id) }}" class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">Edit</a>
                                        <form action="{{ route('admin.users.destroy', $model->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600">Delete</button>
                                        </form>
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
@endsection
