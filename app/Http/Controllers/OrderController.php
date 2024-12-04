<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderProduk;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        // Setting user ID to 1
        // $userId = 1;
        $userId = auth()->user()->id;

        // Retrieve the total quantity of products from the carts table for user ID 1
        $jumlahProduk = Cart::where('user_id', $userId)->sum('quantity');

        // Calculate the total payment amount from the carts
        $jumlahBayar = Cart::where('user_id', $userId)
            ->get()
            ->sum(function ($cartItem) {
                return $cartItem->price * $cartItem->quantity;
            });

        // Combine the address data into a single 'alamat' format
        $alamat = $request->input('street_address') . ', ' . 
                  $request->input('city') . ', ' . 
                  $request->input('province') . ', ' . 
                  $request->input('country') . ', ' . 
                  $request->input('zip_code');

        // Create the order with the retrieved data
        $order = Order::create([
            'tanggal_order' => now()->toDateString(),
            'metode_pembayaran' => $request->input('payment_method'),
            'jumlah_bayar' => $jumlahBayar,
            'alamat' => $alamat,
            'jumlah_produk' => $jumlahProduk, // retrieved from carts table
            'status_order' => 'waiting for payment', // default status
            'id_user' => $userId,
        ]);

        // Loop through the cart items to create entries in OrderProduk
        $cartItems = Cart::where('user_id', $userId)->get();
        
        foreach ($cartItems as $item) {
            OrderProduk::create([
                'id_order' => $order->id_order, // The newly created order ID
                'id_produk' => $item->product_id, // Assuming 'id_produk' is in the Cart table
                'jumlah' => $item->quantity, // Quantity from the cart
            ]);
        }

        // After inserting, delete the cart items
        Cart::where('user_id', $userId)->delete();

        // Redirect to the view orders page
        return redirect()->route('orders.view')->with('success', 'Your order has been placed successfully.');
    }

    public function viewOrders()
{
    // Assuming you have a User model and orders are associated with the user
    // $userId = 1; // Replace this with the actual logged-in user's ID if needed
    $userId = auth()->user()->id;
    $orders = Order::where('id_user', $userId)
    ->with('orderProduk.produk')
    ->get(); // Fetch orders for the user

    return view('orders', compact('orders')); // Pass orders to the view
}

public function showPayment($orderId)
{
    $order = Order::with('orderProduk.produk')->findOrFail($orderId);
    return view('payment', compact('order'));
}

public function submitPaymentProof(Request $request, $orderId)
{
    // Validate the uploaded payment proof
    $request->validate([
        'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Find the order by its ID
    $order = Order::findOrFail($orderId);

    // Check if a payment proof file has been uploaded
    if ($request->hasFile('payment_proof')) {
        // Store the uploaded image in the 'payment_proofs' directory and get the file path
        $filename = $request->file('payment_proof')->store('payment_proofs', 'public');
        
        // Update the order with the file path and change the order status
        $order->payment_proof = $filename;
        $order->status_order = 'payment submitted, waiting for confirmation';
        $order->save();  // Save the order with the updated information
    }

    //to display the payment proof stored idfk
    // <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Payment Proof">

    // Redirect to the orders list page with a success message
    return redirect()->route('orders.view')->with('success', 'Payment proof uploaded successfully!');
}



}
