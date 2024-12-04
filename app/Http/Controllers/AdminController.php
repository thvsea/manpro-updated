<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $models = User::where('is_admin', 1)->get();
        return view('admin.admins.index', compact('models'));
    }
    
    public function create()
    {
        $model = new User();
        return view('admin.admins.form', compact('model'));
    }
    
    public function store(Request $request)
    {
        $model = new User();
        $model->name = $request->name;
        $model->email = $request->email;
        $model->password = Hash::make($request->password);
        $model->is_admin = 1;
        $model->save();
        return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully');
    }
    
    public function edit($id)
    {
        $model = User::where('is_admin', 1)->findOrFail($id);
        return view('admin.admins.form', compact('model'));
    }
    
    public function update(Request $request, $id)
    {
        $model = User::where('is_admin', 1)->findOrFail($id);
        $model->name = $request->name;
        $model->email = $request->email;
        if ($request->password) {
            $model->password = Hash::make($request->password);
        }
        $model->is_admin = 1;
        $model->save();
        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully');
    }
    
    public function destroy($id)
    {
        $model = User::where('is_admin', 1)->findOrFail($id);
        $model->delete();
        return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully');
    }
    
    public function adminhome()
    {
        return view('admin.adminhome');
    }

    public function viewProducts()
    {
        $products = Produk::orderBy('nama_produk', 'asc')->get();
        return view('admin.adminproductslist', compact('products'));
    }

    public function editProduct($id)
    {
        $product = Produk::findOrFail($id);
        return view('admin.adminproductsedit', compact('product'));
    }
    
    public function deleteProduct($id)
    {
        $product = Produk::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
    }

    public function addProduct()
    {
        return view('admin.adminaddproduct');
    }

    public function storeProduct(Request $request)
    {
        if ($request->isNewProduct === "true") {
            $product_name = $request->new_product_name;
        } else {
            $product_name = $request->existing_product_name;
        }
        
        $product = new Produk();
        $product->nama_produk = $product_name;
        $product->harga = $request->price;
        $product->merk = $request->merk;
        $product->jenis = $request->jenis;
        $product->image = $request->image_url;
        
        $product->save();
        return redirect()->route('admin.products')->with('success', 'Product added successfully');
    }

    public function updateProduct(Request $request, $id)
    {
        // dd($request->all()); // This will show all data being received
        $product = Produk::findOrFail($id);

        $product->nama_produk = $request->input('name');
        $product->harga = $request->input('price');
        $product->merk = $request->input('merk');
        $product->jenis = $request->input('jenis');
        $product->image = $request->input('image_url');

        // Save the updated product
        $product->save();
        // $product->update($request->only(['nama_produk', 'harga']));
        
        return redirect()->route('admin.products')->with('success', 'Product updated successfully');
    }

    public function viewUsers()
    {
        $users = User::where('is_admin', 0)->get();
        return view('admin.adminadminslist', compact('users'));
    }

    public function viewAdmins()
    {
        $admins = User::where('is_admin', 1)->get();
        return view('admin.adminadminslist', compact('admins'));
    }

    public function viewOrders()
    {
        $orders = Order::all();
        return view('admin.adminorderslist', compact('orders'));
        
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status_order = $request->status;
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Order status updated successfully');
    }
}
