<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Order;
use App\Models\Address;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function store(Request $request){
    // Add product to the cart
    Cart::instance('cart')->add($request->id, $request->name, $request->quantity, $request->price, ['image' => $request->image]);

    // Get the new cart count
    $cartCount = Cart::instance('cart')->count();

     
    return redirect()->back()->with('success', 'Added Cart Successfully!');
}

    public function decreaseQuantity($rowId)
{
    // Check if item exists in the cart
    $item = Cart::instance('cart')->get($rowId);
    if (!$item) {
        return response()->json(['success' => false, 'message' => 'Item not found in cart.']);
    }

    // Decrease quantity
    $newQuantity = max(0, $item->qty - 1);
    Cart::instance('cart')->update($rowId, $newQuantity);

    return redirect()->back()->with('success', 'Quantity Updated Successfully!');
}

public function increaseQuantity($rowId)
{
    // Check if item exists in the cart
    $item = Cart::instance('cart')->get($rowId);
    if (!$item) {
        return response()->json(['success' => false, 'message' => 'Item not found in cart.']);
    }

    // Increase quantity
    $newQuantity = $item->qty + 1;
    Cart::instance('cart')->update($rowId, $newQuantity);

    return redirect()->back()->with('success', 'Quantity Updated Successfully!');
}
  
    public function remove_item(Request $request, $rowId) {
        Cart::instance('cart')->remove($rowId);
        return redirect()->back()->with('success', 'Item Remove Successfully!');
    }

    public function empty_cart() {
        Cart::instance('cart')->destroy();
        return redirect()->back()->with('success', 'Cart Clear Successfully!');
    }

    public function checkout() {   
        if(!Auth::check()) {
            return redirect()->route('login');
        }
        $address = Address::where('user_id',Auth::user()->id)->where('isdefault', 1)->first();
        return view('checkout', compact('address'));
    }

    public function place_an_order(Request $request) {

        $user_id = Auth::user()->id;
        $address = Address::where('user_id', $user_id)->where('isdefault', true)->first();
        if (!$address)
        {
            $request->validate([
                'name' => 'required',
                'phone' => 'required|numeric|digits:11',
                'address' => 'required',
                'city' => 'required',
                'note' => 'nullable',
            ]);
            $address = new Address();
            $address->name = $request->name;
            $address->phone = $request->phone;
            $address->city = $request->city;
            $address->address = $request->address;
            $address->note = $request->note;
            $address->user_id = $user_id;
            $address->isdefault = true; 
            $address->save();
        }    

       


        $this->setAmountforCheckout(); 

        $subtotal = Session::get('checkout')['subtotal'];
                                            
                                            
        $subtotal = preg_replace('/[^\d.]/', '', $subtotal);
                                            
                                            
        $subtotal = (float) $subtotal;
                                            
                                           
        $shipping = 199.00;
                                            
                                           
        $total = $subtotal + $shipping;

        $order = new Order();
        $order->user_id = $user_id;
        $order->subtotal = Session::get('checkout')['subtotal'];
        $order->total = $total;
        $order->selling_price = $request->selling_price;
        $order->name = $address->name; 
        $order->phone = $address->phone;
        $order->address = $address->address;
        $order->note = $address->note;
        $order->city = $address->city;
        $order->save();

        foreach(Cart::instance('cart')->content() as $item) {
            $orderitem = new OrderItem();
            $orderitem->product_id = $item->id;
            $orderitem->price = $item->price;
            $orderitem->quantity = $item->qty;
            $orderitem->order_id = $order->id;
            $orderitem->save();
        }

        if($request->mode == "card"){
            //
        }
        else if($request->mode == "another"){
            //
        }
        else if($request->mode == "cod") {
        $transaction = new Transaction();
        $transaction->user_id = $user_id;
        $transaction->order_id = $order->id;
        $transaction->mode = $request->mode;
        $transaction->status = "pending";
        $transaction->save();
        }

        Cart::instance('cart')->destroy();
        session()->forget('checkout');
        session()->put('order_id', $order->id);

        return redirect()->route('cart.order.confirms');
    }
 

    public function setAmountforCheckout() {
        if (Cart::instance('cart')->count() <= 0) 
        {
            Session::forget('checkout');
            return;
        }

        Session::put('checkout', [
            'subtotal' => Cart::instance('cart')->subtotal(),
        ]);
    }
}
