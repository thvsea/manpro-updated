<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Produk; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
//     public function addToCart($id)
// {
//     // Get the product by its ID
//     $produk = Produk::findOrFail($id);

//     // Check if the product is already in the cart for the user (assuming user ID 1 for now)
//     $cartItem = Cart::where('user_id', 1)->where('product_id', $id)->first();

//     if ($cartItem) {
//         // If the product is already in the cart, increment the quantity
//         $cartItem->quantity += 1;
//         $cartItem->save();
//     } else {
//        // Otherwise, create a new cart entry using the new Cart instance
//        $cart = new Cart;
//        $cart->user_id = 1; // Assuming user_id is 1 for now
//        $cart->product_id = $id;
//        $cart->quantity = 1;
//        $cart->price = $produk->harga; // Get the product's price

//        // Save the cart item to the database
//        $cart->save();
        
//     }

//     // return redirect()->back()->with('success', 'Product added to cart!');
//     return response()->json(['message' => 'Product added to cart!']);
// }
// public function addToCart($id)
// {
//     // Get the product by its ID
//     $produk = Produk::findOrFail($id);

//     // Get the current authenticated user's ID
//     $userId = auth()->user()->id; // Get the logged-in user's ID

//     // Check if the product is already in the cart for the user
//     $cartItem = Cart::where('user_id', $userId)->where('product_id', $id)->first();

//     if ($cartItem) {
//         // If the product is already in the cart, increment the quantity
//         $cartItem->quantity += 1;
//         $cartItem->save();
//     } else {
//         // Otherwise, create a new cart entry
//         $cart = new Cart;
//         $cart->user_id = $userId; // Set the authenticated user's ID
//         $cart->product_id = $id;
//         $cart->quantity = 1; // Set the initial quantity to 1
//         $cart->price = $produk->harga; // Get the product's price

//         // Save the cart item to the database
//         $cart->save();
//     }

//     return response()->json(['message' => 'Product added to cart!']);
// }
public function addToCart(Request $request)
{
    $request->validate([
        'merk' => 'required',
        'jenis' => 'required',
    ]);
    
    $merk = $request->merk;
    $jenis = $request->jenis;

    // Get the product by its ID
    $produk = Produk::where('merk', $merk)
            ->where('jenis', $jenis)
            ->first(); // Find the first product matching the filters

    $id = $produk->id_produk;

    // Get the current authenticated user's ID
    $userId = Auth::user()->id;

    // Validate the quantity input
    $quantity = $request->input('quantity', 1); // Default to 1 if no quantity is provided
    if ($quantity < 1) {
        return response()->json(['message' => 'Quantity must be at least 1.'], 400);
    }

    // Check if the product is already in the cart for the user
    $cartItem = Cart::where('user_id', $userId)->where('product_id', $id)->first();

    if ($cartItem) {
        // If the product is already in the cart, increment the quantity by the added quantity
        $cartItem->quantity += $quantity;
        $cartItem->save();
    } else {
        // Otherwise, create a new cart entry with the provided quantity
        $cart = new Cart;
        $cart->user_id = $userId; // Set the authenticated user's ID
        $cart->product_id = $id;
        $cart->quantity = $quantity; // Set the initial quantity
        $cart->price = $produk->harga; // Get the product's price

        // Save the cart item to the database
        $cart->save();
    }

    // return response()->json(['message' => 'Product added to cart!']);
    return redirect()->back()->with('success', 'Product added to cart!');
}



// public function index()
// {
//     // Fetch cart items for user ID 1
//     $cartItems = Cart::where('user_id', 1)->with('produk')->get(); // Assuming 'produk' is the relationship defined in the Cart model
    
//     return view('cart', compact('cartItems')); // Change 'cart.index' to the actual view file
// }

public function index()
{
    // Get the current authenticated user's ID
    $userId = auth()->user()->id; // Get the logged-in user's ID

    // Fetch cart items for the authenticated user
    $cartItems = Cart::where('user_id', $userId)->with('produk')->get();

    return view('cart', compact('cartItems')); // Pass cart items to the view
}


// public function update(Request $request, $id)
// {
//     $cartItem = Cart::findOrFail($id);
    
//     // Check which button was pressed
//     if ($request->action === 'plus') {
//         $cartItem->quantity += 1; // Increment quantity
//     } elseif ($request->action === 'minus' && $cartItem->quantity > 1) {
//         $cartItem->quantity -= 1; // Decrement quantity if greater than 1
//     }

//     // Save the updated cart item
//     $cartItem->save();

//     // Redirect back to the cart page with success message
//     return redirect()->back()->with('success', 'Cart updated successfully!');
// }

public function update(Request $request, $id)
{
    // Get the current authenticated user's ID
    $userId = auth()->user()->id; // Get the logged-in user's ID

    $cartItem = Cart::where('user_id', $userId)->findOrFail($id); // Ensure this cart item belongs to the authenticated user

    // Check which button was pressed
    if ($request->action === 'plus') {
        $cartItem->quantity += 1; // Increment quantity
    } elseif ($request->action === 'minus' && $cartItem->quantity > 1) {
        $cartItem->quantity -= 1; // Decrement quantity if greater than 1
    }

    // Save the updated cart item
    $cartItem->save();

    // Redirect back to the cart page with success message
    return redirect()->back()->with('success', 'Cart updated successfully!');
}


// public function destroy($id)
// {
//     // Find the cart item by its ID
//     $cartItem = Cart::findOrFail($id);
    
//     // Delete the cart item from the database
//     $cartItem->delete();
    
//     // Redirect back to the cart page with a success message
//     return redirect()->back()->with('success', 'Item removed from cart!');
// }

public function destroy($id)
{
    // Get the current authenticated user's ID
    $userId = auth()->user()->id; // Get the logged-in user's ID

    // Find the cart item for the authenticated user
    $cartItem = Cart::where('user_id', $userId)->findOrFail($id);

    // Delete the cart item from the database
    $cartItem->delete();

    // Redirect back to the cart page with a success message
    return redirect()->back()->with('success', 'Item removed from cart!');
}


// public function checkout()
// {
//     // Assuming you are hardcoding the user_id to 1 for now
//     $userId = 1;

//     // Get all cart items for this user
//     $cartItems = Cart::where('user_id', $userId)->with('produk')->get();

//     // Calculate the total amount
//     $total = $cartItems->sum(function($item) {
//         return $item->quantity * $item->price;
//     });

//     // Pass the cart items and total to the checkout view
//     return view('checkout', [
//         'cartItems' => $cartItems,
//         'total' => $total
//     ]);
// }

public function checkout()
{
    // Get the current authenticated user's ID
    $userId = auth()->user()->id; // Get the logged-in user's ID

    // Get all cart items for this user
    $cartItems = Cart::where('user_id', $userId)->with('produk')->get();

    // Calculate the total amount
    $total = $cartItems->sum(function($item) {
        return $item->quantity * $item->price;
    });

    // Pass the cart items and total to the checkout view
    return view('checkout', [
        'cartItems' => $cartItems,
        'total' => $total
    ]);
}






}

