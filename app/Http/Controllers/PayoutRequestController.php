<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayoutRequest;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PayoutRequestController extends Controller
{
    // View all payout requests for the logged-in user
    public function index()
    {
        $payoutRequests = PayoutRequest::where('user_id', Auth::id())->paginate(10);
        return view('user.payout.index', compact('payoutRequests'));
    } 

    // Show the form to create a new payout request
    public function create()
    {
        return view('user.payout.create');
    }

    // Store a new payout request
  public function store(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
    ]);

    $wallet = Wallet::where('user_id', Auth::id())->first();

    // Check if the wallet exists and if the requested amount equals the wallet balance
    if (!$wallet || $wallet->balance != $request->amount) {
        return back()->with('error', 'You can only request the exact balance in your wallet.');
    }

    // Deduct the requested amount from the wallet
    $wallet->balance -= $request->amount;
    $wallet->save();

    // Create a payout request
    $payoutRequest = PayoutRequest::create([
        'user_id' => Auth::id(),
        'amount' => $request->amount,
    ]);

    return redirect()->route('user.payout')->with('success', 'Payout request submitted successfully.');
}

   public function generateTransactionHistory($userId)
{
    $user = User::find($userId);

    if (!$user) {
        return back()->with('error', 'User not found.');
    }

    // Fetch payout requests with approved status
    $payoutRequests = PayoutRequest::where('user_id', $userId)
        ->where('status', 'approved')
        ->get();

    // Calculate total approved amount
    $totalAmount = $payoutRequests->sum('amount');

    // Pass data to the PDF view
    $pdf = Pdf::loadView('user.payout.transaction', [
        'payoutRequests' => $payoutRequests,
        'totalAmount' => $totalAmount,
        'userId' => $userId,
        'userName' => $user->name, 
    ]);

    // Download the PDF
    return $pdf->download("transaction-history-user-{$userId}.pdf");
}

public function generateOrdersHistory($userId)
{
    $user = User::find($userId);

    if (!$user) {
        return back()->with('error', 'User not found.');
    }

    // Fetch customer orders where payment status is 'paid' or 'pending'
    $orders = Order::where('user_id', $userId)
        ->whereIn('payment_status', ['paid', 'pending'])
        ->get();

    // Calculate total orders count
    $totalOrders = $orders->count();

    // Pass data to the PDF view
    $pdf = Pdf::loadView('user.payout.order-history', [
        'orders' => $orders,
        'totalOrders' => $totalOrders,
        'userId' => $userId,
        'userName' => $user->name, 
    ]);

    // Download the PDF
    return $pdf->download("order-history-user-{$userId}.pdf");
}

        
}

