@extends('template.layout')

@section('title', 'Keranjang Belanja - Produk Mekarsari')
@section('meta-description', 'Lihat dan kelola keranjang belanja Anda di Mekarsari. Pilih produk terbaik untuk kebutuhan Anda, dengan harga terjangkau dan kualitas unggulan.')

@section('section')
<div class="container mx-auto p-6">
    <nav class="text-gray-600 text-sm mb-4">
        <a href="/home" class="text-gray-500 hover:text-gray-900">Home</a> >
        <span class="text-gray-900">Keranjang Belanja</span>
    </nav>
</div>

<div class="container mx-auto p-6 flex space-x-8">
    <!-- Product Table -->
    <div class="w-2/3 bg-white p-6 shadow">
        <h1 class="text-2xl font-bold mb-4">Keranjang Belanja Anda</h1>
        <table class="w-full">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-4">Produk</th>
                    <th class="p-4">Merk</th>
                    <th class="p-4">Jenis</th>
                    <th class="p-4">Harga</th>
                    <th class="p-4">Kuantitas</th>
                    <th class="p-4">Subtotal</th>
                    <th class="p-4"></th> 
                </tr>
            </thead>
            <tbody id="cart-items">
                @foreach($cartItems as $item)
                <tr class="border-b">
                    <td class="p-4 flex items-center space-x-4">
                        <img src="{{ $item->produk->image }}" alt="Gambar {{ $item->produk->nama_produk }}" class="w-12">
                        <span>{{ $item->produk->nama_produk }}</span>
                    </td>
                    <td class="p-4 text-gray-500">{{ $item->produk->merk }}</td>
                    <td class="p-4 text-gray-500">{{ $item->produk->jenis }}</td>
                    <td class="p-4 text-gray-500">Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="p-4">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                            @csrf
                            @method('PATCH')
                            <button type="submit" name="action" value="minus" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded-l">-</button>
                            <input type="number" name="quantity" value="{{ $item->quantity }}" class="border text-center w-12" min="1" readonly required>
                            <button type="submit" name="action" value="plus" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded-r">+</button>
                        </form>
                    </td>
                    <td class="p-4">Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    <td class="p-4 text-right">
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="delete-item text-gray-400 hover:text-red-500">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Cart Totals -->
    <div class="w-1/3 bg-white p-6 shadow">
        <h2 class="text-2xl font-bold">Total Keranjang</h2>
        <div class="flex justify-between mt-4">
            <span>Subtotal</span>
            <span class="text-gray-500">Rp. {{ number_format($cartItems->sum(function($item) {
                return $item->price * $item->quantity;
            }), 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between mt-4 font-bold">
            <span>Total</span>
            <span class="text-yellow-500">Rp. {{ number_format($cartItems->sum(function($item) {
                return $item->price * $item->quantity;
            }), 0, ',', '.') }}</span>
        </div>
        <a href="{{ route('checkout') }}">
            <button 
                class="mt-6 w-full bg-yellow-500 text-white py-2 rounded {{ count($cartItems) === 0 ? 'opacity-50 cursor-not-allowed' : '' }}" 
                {{ count($cartItems) === 0 ? 'disabled' : '' }}
            >
                Check Out
            </button>
        </a>
    </div>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
@endsection
