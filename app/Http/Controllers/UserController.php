<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index() {
    $user_id = Auth::user()->id;

    // Fetch all orders
    $orders = Order::where('user_id', $user_id)->get();

    // Fetch delivered orders
    $deliver = Order::where('user_id', $user_id)
        ->where('status', 'delivered')
        ->get();

    // Fetch canceled orders
    $cancel = Order::where('user_id', $user_id)->where('status', 'canceled')->get();
    $pending = Order::where('user_id', $user_id)->where('status', 'ordered')->get();
    $book = Order::where('user_id', $user_id)->where('status', 'booked')->get();
    $return = Order::where('user_id', $user_id)->where('status', 'returned')->get();

    // Fetch user's wallet balance
    $wallet = Wallet::where('user_id', $user_id)->first();

    // Pass data to the view
    return view('user.dashboard', compact('orders', 'deliver', 'cancel', 'book', 'return', 'pending','wallet'));
}

    public function order_confirmations() {
        if(Session::has('order_id'))
            {
                $order = Order::find(Session::get('order_id'));
                return view('user.order-confirm', compact('order'));
            }
        return redirect()->route('cart');  
    } 
    public function orders() {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('user.orders', compact('orders'));
    }
    public function order_detail($order_id) {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $order_id)->first();
        if ( $order ) 
            {
                $orderitems = OrderItem::where('order_id', $order->id)->orderBy('id')->get();
                $transaction = Transaction::where('order_id', $order->id)->first();
                return view('user.orders-detail', compact('order', 'orderitems', 'transaction'));
            }
        else 
            {
                return redirect()->route('login');
            }    
    }

    
} 
