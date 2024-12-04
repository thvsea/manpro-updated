@extends('template.layout')

@section('title', 'Payment Details - Toko Mekar Sari')
@section('meta-description', 'Lihat detail pembayaran untuk pesanan Anda, termasuk total bayar, produk yang dipesan, dan informasi bank untuk transfer.')

@section('section')

<body class="bg-gray-100">
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Payment Details</h1>

    <div class="bg-white p-6 shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Order ID: {{ $order->id_order }}</h2>

        <div class="mb-6">
            <p><strong>Tanggal Order:</strong> {{ $order->tanggal_order }}</p>
            <p><strong>Status:</strong> {{ $order->status_order }}</p>
            <p><strong>Jumlah Bayar:</strong> Rp. {{ number_format($order->jumlah_bayar, 0, ',', '.') }}</p>
        </div>

        <h3 class="text-xl font-semibold mb-4">Ordered Products</h3>
        <div class="space-y-4">
            @foreach($order->orderProduk as $product)
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p><strong>Product:</strong> {{ $product->produk->nama_produk }}</p>
                    <p><strong>Merk:</strong> {{ $product->produk->merk }}</p>
                    <p><strong>Jenis:</strong> {{ $product->produk->jenis }}</p>
                    <p><strong>Jumlah:</strong> {{ $product->jumlah }}</p>
                    <p><strong>Harga:</strong> Rp. {{ number_format($product->produk->harga, 0, ',', '.') }}</p>
                    <p><strong>Subtotal:</strong> Rp. {{ number_format($product->jumlah * $product->produk->harga, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>

        <h3 class="text-xl font-semibold mt-6 mb-4">Payment Information</h3>
        <p>Please transfer the total amount to:</p>
        <p><strong>Bank:</strong> BCA</p>
        <p><strong>Account Number:</strong> 1234567890</p>
        <p><strong>Account Name:</strong> PT. Dutakom Wibawa Putra</p>

        <h3 class="text-xl font-semibold mt-6 mb-4">Upload Proof of Payment</h3>
        <form action="{{ route('payment.submit', ['order' => $order->id_order]) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <label for="payment_proof" class="block text-sm font-medium text-gray-700">Choose payment proof file:</label>
            <input type="file" id="payment_proof" name="payment_proof" class="block w-full text-sm text-gray-500" required>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">Submit Payment Proof</button>
        </form>
    </div>
</div>

</body>

@endsection
