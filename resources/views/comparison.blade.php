@extends('template.layout')

@section('title', 'Perbandingan Produk Digital - Solusi Terbaik untuk Anda')
@section('meta-description', 'Bandingkan produk digital terbaik dengan harga terjangkau. Pilih produk sesuai kebutuhan Anda, seperti Hanger Baju dan Hanger Jas. Klik untuk informasi lebih lanjut!')

@section('section')
<div class="container mx-auto p-6">
    <!-- Title -->
    <h1 class="text-4xl font-bold text-center">Perbandingan Produk</h1>
    <p class="text-gray-500 mt-2 text-center">Beranda > Perbandingan</p>

    <!-- Product Row -->
    <div class="flex justify-between items-start mt-8">
        <!-- Product Navigation -->
        <div class="w-1/4">
            <h2 class="text-lg font-bold">Jelajahi Produk Lain</h2>
            <a href="/produk" class="text-yellow-600 mt-2 block">Lihat Produk Lain</a>
        </div>

        <!-- Product Images & Reviews -->
        <div class="w-3/4 flex justify-evenly items-start space-x-6">
            <!-- Product 1 -->
            <div class="text-center w-1/3">
                <img src="https://via.placeholder.com/100" alt="Hanger Baju Berkualitas" class="mx-auto mb-2">
                <h3 class="font-bold">Hanger Baju</h3>
                <p>Rp. 18,000.00</p>
                <p class="text-yellow-500 flex justify-center items-center">
                    4.7 <i class="fas fa-star ml-1"></i> 
                    <span class="text-gray-500 ml-2">| 1 Review</span>
                </p>
            </div>

            <!-- Product 2 -->
            <div class="text-center w-1/3">
                <img src="https://via.placeholder.com/100" alt="Hanger Jas Premium" class="mx-auto mb-2">
                <h3 class="font-bold">Hanger Jas</h3>
                <p>Rp. 20,000.00</p>
                <p class="text-yellow-500 flex justify-center items-center">
                    4.2 <i class="fas fa-star ml-1"></i> 
                    <span class="text-gray-500 ml-2">| 145 Reviews</span>
                </p>
            </div>

            <!-- Add A Product Dropdown -->
            <div class="text-center w-1/3">
                <h3 class="font-bold">Tambahkan Produk</h3>
                <div class="relative">
                    <button id="menu-button" class="bg-yellow-500 text-white py-2 px-4 rounded-full flex items-center justify-center w-full">
                        Pilih Produk <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <div id="dropdown-menu" class="absolute right-0 mt-2 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Produk 1</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Produk 2</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Produk 3</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Comparison Table -->
    <div class="mt-10 bg-white shadow p-6">
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-4 text-left">Kategori</th>
                    <th class="p-4 text-left">Hanger Baju</th>
                    <th class="p-4 text-left">Hanger Jas</th>
                </tr>
            </thead>
            <tbody>
                <!-- General Info -->
                <tr class="border-b">
                    <td class="p-4 font-bold">Paket Penjualan</td>
                    <td class="p-4">5 buah hanger</td>
                    <td class="p-4">1 hanger besar, 2 kecil</td>
                </tr>
                <tr class="border-b">
                    <td class="p-4 font-bold">Nomor Model</td>
                    <td class="p-4">TFCBUIGRBLS6RHS</td>
                    <td class="p-4">DTUBLIGRBL568</td>
                </tr>
                <tr class="border-b">
                    <td class="p-4 font-bold">Material Sekunder</td>
                    <td class="p-4">Plastik Kuat</td>
                    <td class="p-4">Kayu Solid</td>
                </tr>

                <!-- Dimensions -->
                <tr class="bg-gray-100">
                    <th class="p-4 text-left">Dimensi</th>
                    <th class="p-4"></th>
                    <th class="p-4"></th>
                </tr>
                <tr class="border-b">
                    <td class="p-4 font-bold">Lebar</td>
                    <td class="p-4">30 cm</td>
                    <td class="p-4">32 cm</td>
                </tr>
                <tr class="border-b">
                    <td class="p-4 font-bold">Tinggi</td>
                    <td class="p-4">17 cm</td>
                    <td class="p-4">19 cm</td>
                </tr>

                <!-- Warranty -->
                <tr class="bg-gray-100">
                    <th class="p-4 text-left">Garansi</th>
                    <th class="p-4"></th>
                    <th class="p-4"></th>
                </tr>
                <tr class="border-b">
                    <td class="p-4 font-bold">Tidak Termasuk Garansi</td>
                    <td class="p-4">Kerusakan akibat pemakaian salah</td>
                    <td class="p-4">Kerusakan akibat pemakaian salah</td>
                </tr>
                <tr class="border-b">
                    <td class="p-4 font-bold">Garansi Domestik</td>
                    <td class="p-4">1 Hari</td>
                    <td class="p-4">2 Hari</td>
                </tr>

                <!-- Add to Cart Button -->
                <tr>
                    <td></td>
                    <td class="p-4">
                        <button class="bg-yellow-500 text-white py-2 px-4 rounded w-full">Tambah ke Keranjang</button>
                    </td>
                    <td class="p-4">
                        <button class="bg-yellow-500 text-white py-2 px-4 rounded w-full">Tambah ke Keranjang</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Font Awesome Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

<!-- Dropdown Toggle Script -->
<script>
    document.getElementById('menu-button').addEventListener('click', function () {
        const dropdown = document.getElementById('dropdown-menu');
        dropdown.classList.toggle('hidden');
    });
</script>
@endsection
