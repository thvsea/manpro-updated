<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    public function index(Request $request)
{
    $search = $request->search;
    $page = $request->page ?? 1;
    $page_size = 10;

    // Base query
    $query = Produk::query();

    // Apply search filter
    if (!empty($search)) {
        $query->where('nama_produk', 'like', '%' . $search . '%');
    }

    // Apply minimum price filter
    if ($minPrice = $request->input('min_price')) {
        $query->where('harga', '>=', $minPrice);
    }

    // Apply maximum price filter
    if ($maxPrice = $request->input('max_price')) {
        $query->where('harga', '<=', $maxPrice);
    }

    // Apply sorting
    if ($sort = $request->input('sort')) {
        if ($sort === 'price_asc') {
            $query->orderBy('harga', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('harga', 'desc');
        }
    }

    // Execute the query and get unique products
    $allProducts = $query->get();
    $uniqueProducts = $allProducts->unique('nama_produk');

    // Manual pagination
    $totalPages = ceil($uniqueProducts->count() / $page_size);
    $paginatedProducts = $uniqueProducts->forPage($page, $page_size);

    // Return the view with the filtered, sorted, and paginated data
    return view('homepage', [
        'produk' => $paginatedProducts,
        'totalPages' => $totalPages,
        'search' => $search,
        'minPrice' => $minPrice,
        'maxPrice' => $maxPrice,
        'sort' => $sort,
    ]);
}


    public function shop()
    {
        // Fetch all products from 'produk' table
        $produk = Produk::all();

        // Pass the data to the view
        return view('shop', ['produk'=> $produk]);
    }

    // public function show($id)
    // {
    //     $produk = Produk::findOrFail($id); // Fetch the produk by ID
    //     return view('product', compact('produk')); // Return the view with the produk data
    // }
    public function show($id)
    {
        // Fetch the product by ID
        $produk = Produk::findOrFail($id);

        $produkByMerk = Produk::query()
            ->where('nama_produk', $produk->nama_produk)
            ->get()
            ->map(fn($item) => ['merk' => $item->merk, 'jenis' => $item->jenis, 'harga' => $item->harga, 'stok' => $item->stok])
            ->groupBy(fn($item) => $item['merk']);

        // Pass the product, merk, and jenis to the view
        return view('product', compact('produk', 'produkByMerk'));
    }

    public function getProductByFilters(Request $request)
    {
        // Get the selected merk and jenis from the request
        $merk = $request->merk;
        $jenis = $request->jenis;
    
        // Find the product based on the selected merk and jenis
        $produk = Produk::where('merk', $merk)
                        ->where('jenis', $jenis)
                        ->first(); // Find the first product matching the filters
    
        // If no product is found, return an error
        if (!$produk) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    
        // Return the product details as JSON
        return response()->json([
            'id' => $produk->id_produk,
            'nama_produk' => $produk->nama_produk,
            'harga' => $produk->harga,
            'stok' => $produk->stok,
            // Include any other product details you need
        ]);
    }

    public function indexx(Request $request)
    {
        // Base query
        $query = Produk::query();

        // Handle search
        if ($search = $request->input('search')) {
            $query->where('nama_produk', 'like', '%' . $search . '%');
        }

        // Handle price range filter
        if ($minPrice = $request->input('min_price')) {
            $query->where('harga', '>=', $minPrice);
        }

        if ($maxPrice = $request->input('max_price')) {
            $query->where('harga', '<=', $maxPrice);
        }

        // Handle sorting
        if ($sort = $request->input('sort')) {
            if ($sort === 'price_asc') {
                $query->orderBy('harga', 'asc');
            } elseif ($sort === 'price_desc') {
                $query->orderBy('harga', 'desc');
            }
        }

        // Paginate results
        $produk = $query->paginate(12)->withQueryString();

        return view('home', [
            'produk' => $produk,
            'totalPages' => $produk->lastPage(),
        ]);
    }
    

}