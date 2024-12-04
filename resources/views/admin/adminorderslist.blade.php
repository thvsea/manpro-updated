@extends('template.layoutadmin')

@section('section')
<div class="container px-4 py-8 mx-auto">
    <div class="mx-auto max-w-7xl">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Manage Orders</h1>
        </div>

        <div class="bg-white rounded-lg shadow-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border-b">Order ID</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border-b">Customer</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border-b">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border-b">Products</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border-b">Payment Proof</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $order->id_order }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $order->id_user }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-block px-2 py-1 text-xs font-semibold text-white rounded 
                                    {{ $order->status_order == 'completed' ? 'bg-green-500' : ($order->status_order == 'pending' ? 'bg-yellow-500' : 'bg-blue-500') }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status_order)) }}
                                </span>
                            </td>

                            <!-- Display Products Ordered -->
                            <td class="px-6 py-4 text-sm">
                                <ul class="space-y-2">
                                    @foreach($order->orderProduk as $product)
                                    <li class="p-2 bg-gray-50 rounded-md">
                                        <strong>{{ $product->produk->nama_produk }}</strong><br>
                                        Merk: {{ $product->produk->merk }}<br>
                                        Jenis: {{ $product->produk->jenis }}<br>
                                        Jumlah: {{ $product->jumlah }}<br>
                                        Harga: Rp. {{ number_format($product->produk->harga, 0, ',', '.') }}<br>
                                        Subtotal: Rp. {{ number_format($product->jumlah * $product->produk->harga, 0, ',', '.') }}
                                    </li>
                                    @endforeach
                                </ul>
                            </td>

                            <!-- Display Payment Proof if Submitted -->
                            <td class="px-6 py-4 text-sm">
                                @if($order->payment_proof)
                                    <a href="{{ asset('storage/' . $order->payment_proof) }}" 
                                       target="_blank" class="text-blue-500 hover:underline">View Payment Proof</a>
                                @else
                                    <span class="text-gray-500">No proof submitted</span>
                                @endif
                            </td>

                            <!-- Update Order Status -->
                            <td class="px-6 py-4 text-sm">
                                <form action="{{ route('admin.order.status', $order->id_order) }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    <select name="status" class="border p-2 rounded focus:ring-2 focus:ring-blue-500">
                                        <option value="pending" @if($order->status_order == 'pending') selected @endif>Pending</option>
                                        <option value="completed" @if($order->status_order == 'completed') selected @endif>Completed</option>
                                        <option value="waiting_for_payment" @if($order->status_order == 'waiting_for_payment') selected @endif>Waiting for Payment</option>
                                        <option value="payment_submitted" @if($order->status_order == 'payment_submitted') selected @endif>Payment Submitted</option>
                                        <option value="packing" @if($order->status_order == 'packing') selected @endif>Packing</option>
                                        <option value="sent" @if($order->status_order == 'sent') selected @endif>Sent</option>
                                    </select>
                                    <button type="submit" 
                                            class="bg-green-500 text-white px-3 py-2 rounded-md hover:bg-green-600">Update</button>
                                </form>
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
