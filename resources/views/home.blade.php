@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900">{{ __('Dashboard') }}</h2>

            <div class="mt-4">
                <p class="text-lg text-gray-700">{{ __('You are logged in!') }}</p>
                <!-- Menampilkan nama pengguna atau email -->
                <p class="mt-2 text-gray-500">{{ __('Welcome back, ') }} {{ Auth::user()->name }}!</p>
            </div>

            <div class="mt-6">
                <!-- Tombol Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">
                        {{ __('Logout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
