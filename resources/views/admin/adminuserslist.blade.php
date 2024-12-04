@extends('template.layoutadmin')

@section('section')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-6">View Users</h1>

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-2 border">Name</th>
                <th class="py-2 px-2 border">Email</th>
                <th class="py-2 px-2 border">Time Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="py-2 px-2 border">{{ $user->name }}</td>
                <td class="py-2 px-2 border">{{ $user->email }}</td>
                <td class="py-2 px-2 border">{{ $user->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
