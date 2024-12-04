@extends('template.layout')

@section('title', 'Ongoing Orders - Toko Mekar Sari')
@section('meta-description', 'Lihat daftar pesanan yang sedang berlangsung di Toko Mekar Sari. Temukan status, metode pembayaran, dan detail produk yang dipesan.')

@section('section')

<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Ongoing Orders</h1>

    @if($orders->isEmpty())
        <p class="text-gray-600 text-center">You have no ongoing orders.</p>
    @else
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-3 text-left">Order ID</th>
                        <th class="p-3 text-left">Tanggal Order</th>
                        <th class="p-3 text-left">Jumlah Bayar</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Metode Pembayaran</th>
                        <th class="p-3 text-left">Products</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($orders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $order->id_order }}</td>
                        <td class="p-3">{{ $order->tanggal_order }}</td>
                        <td class="p-3">Rp. {{ number_format($order->jumlah_bayar, 0, ',', '.') }}</td>
                        <td class="p-3">{{ $order->status_order }}</td>
                        <td class="p-3">
                            {{ $order->metode_pembayaran }}  
                            @if ($order->status_order == 'waiting for payment') 
                                <a href="{{ route('payment.show', ['order' => $order->id_order]) }}" class="text-blue-500 hover:underline">Pay Now</a>
                            @endif
                        </td>
                        <td class="p-3">
                            <!-- Display each ordered product with more details -->
                            <div class="space-y-4">
                                @foreach($order->orderProduk as $product)
                                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                                        <h3 class="font-semibold text-lg">{{ $product->produk->nama_produk }}</h3>
                                        <p><strong>Merk:</strong> {{ $product->produk->merk }}</p>
                                        <p><strong>Jenis:</strong> {{ $product->produk->jenis }}</p>
                                        <p><strong>Jumlah:</strong> {{ $product->jumlah }}</p>
                                        <p><strong>Harga:</strong> Rp. {{ number_format($product->produk->harga, 0, ',', '.') }}</p>
                                        <p><strong>Subtotal:</strong> Rp. {{ number_format($product->jumlah * $product->produk->harga, 0, ',', '.') }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

</body>

@endsection
