@extends('template.layoutadmin')

@section('section')
<div class="container mx-auto">
    <h1 class="mb-6 text-3xl font-bold">Add Product</h1>

    <form action="{{ route('admin.product.store') }}" method="POST">
        @csrf
        
        <div class="mb-4" x-data="{ isNewProduct: true }">
            <label class="block mb-2">Product Name</label>
            
            <div class="relative flex items-center mb-3 cursor-pointer" @click="isNewProduct = !isNewProduct">
                <input type="checkbox" x-model="isNewProduct" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <div class="flex items-center">
                    <div class="h-8 w-14">
                        <div class="h-8 transition-colors duration-200 ease-in-out rounded-full w-14" :class="isNewProduct ? 'bg-blue-500' : 'bg-gray-200'">
                            <div class="absolute w-6 h-6 transition-transform duration-200 ease-in-out transform bg-white rounded-full shadow-md top-1" :class="isNewProduct ? 'translate-x-7' : 'translate-x-1'"></div>
                        </div>
                    </div>
                    <span class="ml-3 text-sm font-medium" x-text="isNewProduct ? 'New Product' : 'Existing Product'"></span>
                </div>
            </div>
            
            <input type="hidden" name="isNewProduct" x-model="isNewProduct">

            <template x-if="isNewProduct">
                <input type="text" name="new_product_name" class="w-full p-2 border rounded" placeholder="Enter new product name">
            </template>

            <template x-if="!isNewProduct">
                <select name="existing_product_name" class="w-full p-2 border rounded">
                    <option value="">Select existing product</option>
                    @foreach(\App\Models\Produk::select('nama_produk')->distinct()->get() as $product)
                        <option value="{{ $product->nama_produk }}">{{ $product->nama_produk }}</option>
                    @endforeach
                </select>
            </template>
        </div>

        <div class="mb-4">
            <label for="price" class="block">Price</label>
            <input type="number" name="price" value="" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="merk" class="block">Merk</label>
            <input type="text" name="merk" value="" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="jenis" class="block">Jenis</label>
            <input type="text" name="jenis" value="" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="image_url" class="block">Image URL</label>
            <input type="text" name="image_url" value="" class="w-full p-2 border rounded">
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Add Product</button>
    </form>
</div>

@endsection