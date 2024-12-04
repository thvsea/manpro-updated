@extends('template.layout')

@section('title', 'Detail Produk - ' . $produk->nama_produk)
@section('meta-description', 'Lihat detail produk: ' . $produk->nama_produk . ', harga, spesifikasi, dan cara membeli.')

@section('section')

<div class="container mx-auto py-8">
    
    <!-- Breadcrumb -->
    <nav class="text-gray-600 text-sm mb-6">
        <a href="/home" class="text-gray-500 hover:text-gray-900">Home</a> >
        <a href="/shop" class="text-gray-500 hover:text-gray-900">Shop</a> >
        <span class="text-gray-900">{{ $produk->nama_produk }}</span>
    </nav>

    <!-- Product Section -->
    <div class="flex flex-col lg:flex-row lg:space-x-12">
        <!-- Product Images -->
        <div class="lg:w-1/2">
            <img src="{{ $produk->image }}" alt="{{ $produk->nama_produk }}" class="w-full rounded-lg shadow-lg mb-4" loading="lazy">
        </div>

        <!-- Product Details -->
        <div class="lg:w-1/2">
            <h1 class="text-3xl font-bold mb-2" id="product-name">{{ $produk->nama_produk }}</h1>
            <p id="product-price" class="text-lg text-gray-600 mb-4">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</p>
            
            <!-- Star Ratings -->
            <div class="flex items-center mb-4">
                <div class="text-yellow-500 space-x-1">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="ml-2 text-sm text-gray-500">(5 customer reviews)</p>
            </div>

            <!-- Merk and Jenis -->
            <form id="addToCartForm" action="{{ route('cart.add', ['id' => $produk->id_produk]) }}" method="POST">
                @csrf

                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="merk" class="block text-sm font-medium">Merk:</label>
                        <select id="merk" name="merk" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" aria-describedby="merkHelp">
                            <option value="">Pilih...</option>
                            @foreach($produkByMerk as $merk => $listJenis)
                                <option value="{{ $merk }}">{{ $merk }}</option>
                            @endforeach
                        </select>
                        <small id="merkHelp" class="text-gray-500">Pilih merk produk yang tersedia.</small>
                    </div>

                    <div class="w-1/2">
                        <label for="jenis" class="block text-sm font-medium">Jenis:</label>
                        <select id="jenis" name="jenis" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" aria-describedby="jenisHelp">
                        </select>
                        <small id="jenisHelp" class="text-gray-500">Pilih jenis produk sesuai merk.</small>
                    </div>
                </div>

                <!-- Hidden inputs to pass product ID and quantity -->
                <input type="hidden" name="product_id" value="{{ $produk->id_produk }}">
                <input type="hidden" id="productQuantity" name="quantity" value="1">
                
                <!-- Quantity Input -->
                <div class="flex items-center mb-6">
                    <label for="quantity" class="sr-only">Quantity</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-16 border text-center rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="mt-4 py-2 px-6 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Add to Cart</button>
                
                @if ($errors->any())
                    <div class="mt-2 bg-red-500 text-sm text-white rounded-lg p-4" role="alert" aria-live="assertive">
                        <span class="font-bold">Error</span>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const produkByMerk = @json($produkByMerk);
    
    $(document).ready(function() {
        const $priceElement = $('#product-price');
        // Update the form's quantity value when the user changes the quantity input field
        $('#quantity').on('input', function() {
            var quantity = $(this).val();
            $('#productQuantity').val(quantity);
        });

        $('#merk').on('change', function() {
            const merk = $(this).val();
            $('#jenis').html('');

            if (!merk) return;

            const jenisForMerk = produkByMerk[merk];

            for (const x of jenisForMerk) {
                $('#jenis').append(`
                    <option value="${x.jenis}" data-price="${x.harga}">${x.jenis}</option>
                `);
            }

            const firstJenis = $('#jenis option').first();
            const price = firstJenis.data('price');
            $('#jenis').val(firstJenis.val()); // Set the first jenis as selected
            $priceElement.text(`Rp. ${new Intl.NumberFormat('id-ID').format(price)}`); 

        });

        $('#jenis').on('change', function() {
            const selectedOption = $(this).find(':selected');
            const price = selectedOption.data('price');
            $priceElement.text(`Rp. ${new Intl.NumberFormat('id-ID').format(price)}`);
        });
    });
</script>