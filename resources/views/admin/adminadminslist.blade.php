@extends('template.layoutadmin')

@section('section')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-6">View Admin</h1>

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 border px-2">Name</th>
                <th class="py-2 border px-2">Email</th>
                <th class="py-2 border px-2">Time Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $admin)
            <tr>
                <td class="py-2 border px-2">{{ $admin->name }}</td>
                <td class="py-2 border px-2">{{ $admin->email }}</td>
                <td class="py-2 border px-2">{{ $admin->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection