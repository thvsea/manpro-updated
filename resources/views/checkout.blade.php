@extends('template.layout')

@section('title', 'Checkout - Toko Anda')
@section('meta-description', 'Selesaikan pembelian Anda dengan mengisi detail pembayaran dan alamat. Pilih metode pembayaran yang sesuai dan nikmati belanja mudah.')

@section('section')

<body class="bg-gray-100">
<div class="container mx-auto p-6">
    <!-- Breadcrumb -->
    <nav class="text-gray-600 text-sm mb-4">
        <a href="/home" class="text-gray-500 hover:text-gray-900">Home</a> >
        <span class="text-gray-900">Checkout</span>
    </nav>

    <h1 class="text-3xl font-bold mb-6">Checkout</h1>

    <form action="{{ route('checkout.placeOrder') }}" method="POST">
        @csrf <!-- Laravel CSRF protection -->

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Billing Details -->
            <div>
                <h2 class="text-xl font-semibold mb-4">Billing Details</h2>
                <div class="space-y-4">
                    <div class="flex gap-4">
                        <label class="sr-only" for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" placeholder="First Name" 
                               class="w-full p-3 border border-gray-300 rounded-md" required>

                        <label class="sr-only" for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" 
                               class="w-full p-3 border border-gray-300 rounded-md" required>
                    </div>
                    <label for="country" class="sr-only">Country</label>
                    <select name="country" id="country" class="w-full p-3 border border-gray-300 rounded-md" required>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Europe">Europe</option>
                    </select>

                    <label for="street_address" class="sr-only">Street Address</label>
                    <input type="text" name="street_address" id="street_address" placeholder="Street Address" 
                           class="w-full p-3 border border-gray-300 rounded-md" required>

                    <label for="city" class="sr-only">City</label>
                    <input type="text" name="city" id="city" placeholder="Town / City" 
                           class="w-full p-3 border border-gray-300 rounded-md" required>

                    <label for="province" class="sr-only">Province</label>
                    <select name="province" id="province" class="w-full p-3 border border-gray-300 rounded-md" required>
                        <option value="Western Province">Western Province</option>
                        <option value="Eastern Province">Eastern Province</option>
                    </select>

                    <label for="zip_code" class="sr-only">ZIP Code</label>
                    <input type="text" name="zip_code" id="zip_code" placeholder="ZIP Code" 
                           class="w-full p-3 border border-gray-300 rounded-md" required>

                    <label for="phone" class="sr-only">Phone</label>
                    <input type="text" name="phone" id="phone" placeholder="Phone" 
                           class="w-full p-3 border border-gray-300 rounded-md" required>

                    <label for="email" class="sr-only">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="Email Address" 
                           class="w-full p-3 border border-gray-300 rounded-md" required>

                    <label for="additional_info" class="sr-only">Additional Information</label>
                    <textarea name="additional_info" id="additional_info" placeholder="Additional Information" 
                              class="w-full p-3 border border-gray-300 rounded-md"></textarea>
                </div>
            </div>

            <!-- Order Summary -->
            <div>
                <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                <div class="border border-gray-300 p-4 rounded-md">
                    @foreach ($cartItems as $item)
                    <div class="flex justify-between mb-2">
                        <span>{{ $item->produk->nama_produk }} x {{ $item->quantity }}</span>
                        <span>Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                    </div>
                    @endforeach

                    <div class="flex justify-between font-semibold mb-2">
                        <span>Subtotal</span>
                        <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between font-bold text-xl mb-4">
                        <span>Total</span>
                        <span>Rp. {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <h2 class="text-lg font-semibold mb-2">Payment Methods</h2>
                    <div class="space-y-2">
                        <div>
                            <input type="radio" name="payment_method" id="bank_transfer" value="bank_transfer" 
                                   class="mr-2" required checked>
                            <label for="bank_transfer">Direct Bank Transfer</label>
                            <p class="text-sm text-gray-500">Use your Order ID as reference. Order is shipped after payment.</p>
                        </div>
                        <div>
                            <input type="radio" name="payment_method" id="cash_delivery" value="cash_delivery" 
                                   class="mr-2">
                            <label for="cash_delivery">Cash on Delivery</label>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-md mt-6 hover:bg-blue-600">
                        Place Order
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
