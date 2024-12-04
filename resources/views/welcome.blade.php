<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mekarsari - Solusi Terbaik untuk Belanja Online</title>
    <meta name="description" content="Mekarsari menawarkan berbagai produk berkualitas dengan pengalaman belanja terbaik. Daftar dan login untuk mulai berbelanja.">
    <meta name="keywords" content="produk online, belanja online, Mekarsari, register, login">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gradient-to-r from-yellow-100 via-yellow-400 to-yellow-600 min-h-screen flex items-center justify-center">

    <div class="text-center text-black space-y-6">
        <!-- Main Heading (H1 for SEO) -->
        <h1 class="text-3xl font-bold">Selamat Datang di Mekarsari</h1>
        
        <!-- Image with alt text for SEO -->
        <img src="{{ asset('Mekarsari.png') }}" alt="Mekarsari logo, belanja online terbaik" width="500" class="mx-auto">

        <!-- Buttons Section -->
        <div class="space-x-4">
            <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-black font-semibold rounded-lg shadow-md hover:bg-blue-100 transition duration-200">Register</a>
            <a href="{{ route('login') }}" class="px-6 py-3 bg-white text-black font-semibold rounded-lg shadow-md hover:bg-blue-100 transition duration-200">Login</a>
        </div>
    </div>

</body>

</html>
