@extends('template.layout')

@section('section')

<!-- Title and Meta Description -->
@section('title', 'Jual Produk Jahit Terbaik - Toko Mekar Sari')
@section('meta-description', 'Temukan peralatan jahit dan barang-barang berkualitas di Toko Mekar Sari. Beli sekarang untuk produk terbaik dan harga terjangkau!')

<!-- Hero Section -->
<section class="flex items-center justify-center text-white h-[300px] bg-white-800" 
    style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('backgroundhome.png'); background-size: cover; background-attachment: fixed; position: relative;">
    <h1 class="w-2/3 text-4xl font-bold text-center text-white">Mencari barang-barang terkait peralatan jahit?</h1>
</section>

<!-- Filter Section -->
<section class="py-2 text-black bg-orange-100">
    <div class="container flex items-center justify-between w-11/12 mx-auto sm:w-6/12">
        <div class="flex items-center space-x-2">
         
        </div>

        <form action="{{ route('home') }}" method="GET" class="flex items-center space-x-4">
            <!-- Sort by -->
            <div class="flex items-center space-x-2">
                <label for="sort" class="text-sm font-medium">Sort by</label>
                <select id="sort" name="sort" class="block w-40 px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none">
                    <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Default</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>

            <!-- Price Range -->
            <div class="flex items-center space-x-2">
                <label for="min_price" class="text-sm font-medium">Min Price</label>
                <input type="number" id="min_price" name="min_price" value="{{ request('min_price') }}" class="block w-20 px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none">
            </div>
            <div class="flex items-center space-x-2">
                <label for="max_price" class="text-sm font-medium">Max Price</label>
                <input type="number" id="max_price" name="max_price" value="{{ request('max_price') }}" class="block w-20 px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none">
            </div>

            <button type="submit" class="px-4 py-2 text-white bg-blue-500 border border-blue-500 shadow-sm rounded-md">
                Apply
            </button>
        </form>
    </div>
</section>

<!-- Products Section -->
<section class="w-11/12 mx-auto sm:w-6/12">
    <form action="{{ route('home') }}" method="GET" class="flex items-center mx-auto mt-4 mb-4">
        <div class="relative flex-1">
            <input type="text" id="search" class="block w-full px-3 py-2 bg-white border border-gray-300 shadow-sm rounded-l-md focus:outline-none" placeholder="Search..." value="{{ request('search') }}" name="search">
            @if(request('search'))
                <a href="{{ route('home') }}" class="absolute text-gray-400 -translate-y-1/2 right-2 top-1/2 hover:text-gray-600">
                    <i class="fa-solid fa-times"></i>
                </a>
            @endif
        </div>
        <button type="submit" class="px-4 py-2 text-white bg-blue-500 border border-blue-500 shadow-sm rounded-r-md">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>
</section>

<section class="w-11/12 mx-auto mb-5 bg-white sm:w-6/12">
    <div class="mx-auto">
        @if ($produk->count() > 0)
            <div class="grid w-full grid-cols-2 gap-6 sm:grid-cols-4">
                @foreach($produk as $item)
                <a href="{{ route('produk.show', $item->id_produk) }}">
                    <div class="w-full overflow-hidden bg-gray-200 border rounded-md h-[250px]">
                        <img src="{{ $item->image }}" alt="{{ $item->nama_produk }}" class="object-cover object-center w-full h-full">
                    </div>
                    <div class="flex justify-between mt-4">
                        <div>
                            <h3 class="text-sm text-gray-700">
                                <span aria-hidden="true" class="inset-0"></span>
                                {{ $item->nama_produk }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $item->ukuran }}</p>
                        </div>
                        <p class="text-sm font-medium text-gray-900">Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        @else
            <div class="flex items-center justify-center h-40 text-center text-gray-700 rounded-md">
                No products found
            </div>
        @endif
        
        @if($totalPages > 1)
            <div class="flex justify-center gap-2 mt-8">
                @php
                    $currentPage = request('page', 1);
                    $start = max(1, $currentPage - 2);
                    $end = min($totalPages, $currentPage + 2);
                @endphp

                @if($currentPage > 1)
                    <a href="{{ route('home', ['page' => $currentPage - 1, 'search' => request('search')]) }}" class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Previous
                    </a>
                @endif

                @for($i = $start; $i <= $end; $i++)
                    <a href="{{ route('home', ['page' => $i, 'search' => request('search')]) }}" 
                       class="px-3 py-1 text-sm {{ $i == $currentPage ? 'bg-blue-500 text-white' : 'text-gray-700 bg-white hover:bg-gray-50' }} border border-gray-300 rounded-md">
                        {{ $i }}
                    </a>
                @endfor

                @if($currentPage < $totalPages)
                    <a href="{{ route('home', ['page' => $currentPage + 1, 'search' => request('search')]) }}" class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Next
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>

<!-- Banner Section -->
<section class="relative bg-orange-100 h-[53rem]">
    <div class="container relative z-10 pt-16 mx-auto text-center">
        <h2 class="mb-3 text-xl">Carilah keperluanmu dengan</h2>
        <h3 class="mb-1 text-3xl font-bold">#TokoMekarSari</h3>
    </div>
    <div class="absolute w-full h-[48rem] bg-contain bg-no-repeat bg-center z-0" style="background-image: url('backgroundhome2.PNG'); top: 5rem;"></div>
</section>

@endsection