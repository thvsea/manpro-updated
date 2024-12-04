@extends('template.layoutadmin')

@section('section')
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-6">Edit Product</h1>

    <form action="{{ route('admin.product.update', $product->id_produk) }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="name" class="block">Product Name</label>
            <input type="text" name="name" value="{{ $product->nama_produk }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="price" class="block">Price</label>
            <input type="number" name="price" value="{{ $product->harga }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="merk" class="block">Merk</label>
            <input type="text" name="merk" value="{{ $product->merk }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="jenis" class="block">Jenis</label>
            <input type="text" name="jenis" value="{{ $product->jenis }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="image_url" class="block">Image URL</label>
            <input type="text" name="image_url" value="{{ $product->image }}" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Save Changes</button>
    </form>
</div>

@endsection
