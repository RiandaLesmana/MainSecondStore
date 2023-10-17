<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Confirm;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function checkout()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();

        if($carts == null)
        {
            return Redirect::back();
        }

        $order = Order::create([
            'user_id' => $user_id
        ]);

        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);

            $product->update([
                'stock' => $product->stock - $cart->amount
            ]);

            Transaction::create([
                'amount' => $cart->amount,
                'order_id' => $order->id,
                'product_id' => $cart->product_id
            ]);

            $cart->delete();
        }

        return Redirect::route('show_order', $order);
    }

    public function index_order()
    {
        $user = Auth::user();
        $is_admin = $user->is_admin;
        if($is_admin)
        {
            $orders = Order::all();
        }
        else
        {
            $orders = Order::where('user_id', $user->id)->get();
        }
        return view('index_order', compact('orders'));
    }

    public function show_order(Order $order)
    {
        $user = Auth::user();
        $is_admin = $user->is_admin;

        $confirm = Confirm::where('order_id', $order->id)->first(); // Fetch confirm data for the specific order

        if ($is_admin || $order->user_id == $user->id) {
            return view('show_order', compact('order', 'confirm')); // Pass the $confirm variable to the view
        }

        return view('show_order', compact('order')); // Display order detail without confirm data
    }

    



    public function submit_payment_receipt(Order $order, Request $request)
    {
        $file = $request->file('payment_receipt');
        $path = time() . '_' . $order->id . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        $order->update([
            'payment_receipt' => $path
        ]);

        return Redirect::back();
    }

    public function confirm_payment(Order $order)
    {
        $order->update([
            'is_paid' => true
        ]);

        return Redirect::back();
    }

    public function destroy(Order $order)
    {
        // Delete the order
        $order->delete();

        // Redirect to a desired location
        return redirect()->route('index_order')->with('success', 'Order deleted successfully');
    }

    public function index()
    {
        // Retrieve all orders from the database
        $orders = Order::all();

        // Return the view with the orders data
        return view('index_order', compact('orders'));
    }

    public function paidOrders()
    {
        // Retrieve only the paid orders from the database
        $orders = Order::where('is_paid', true)->get();

        // Return the view with the paid orders data
        return view('order_confirmation', compact('orders'));
    }
}
