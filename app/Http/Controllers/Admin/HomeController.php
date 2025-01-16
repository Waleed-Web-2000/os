<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash; 
use App\Models\User;
use Auth;
use Carbon\carbon;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wallet;
use App\Models\PayoutRequest;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Setting;
use App\Models\OrderItem;
use App\Models\BuyOrder;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function setting(){
        $data=Setting::first();
        return view('admin.setting')->with('data',$data); 
    } 

    public function update($id, Request $request)
{
    // Fetch the first setting entry (or any other logic for $data)
    $data = Setting::first();
    $settings = Setting::findOrFail($id);

    $currentLogo = $settings->logo; 
    $currentFev = $settings->fev;

    $newLogo = $currentLogo;
    $newFev = $currentFev;

    // Handle logo upload
    if ($request->hasFile('logo')) {
        $logoFile = $request->file('logo');
        $newLogo = md5($logoFile->getClientOriginalName()) . time() . "." . $logoFile->getClientOriginalExtension();

        // Move the new file to storage
        $logoFile->move(storage_path('app/public/uploads/setting/'), $newLogo);

        // Delete the old logo file if it exists
        if ($currentLogo) {
            File::delete(storage_path('app/public/uploads/setting/') . $currentLogo);
        }
    }

    // Handle favicon (fev) upload
    if ($request->hasFile('fev')) {
        $fevFile = $request->file('fev');
        $newFev = md5($fevFile->getClientOriginalName()) . "." . $fevFile->getClientOriginalExtension();

        // Move the new file to storage
        $fevFile->move(storage_path('app/public/uploads/setting/fev/'), $newFev);

        // Delete the old favicon file if it exists
        if ($currentFev) {
            File::delete(storage_path('app/public/uploads/setting/fev/') . $currentFev);
        }
    }

    // Update the setting entry in the database
    $settings->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'description' => $request->description,
        'address' => $request->address,
        'fev' => $newFev, 
        'copy_right' => $request->copy_right,
        'about' => $request->about,
        'privacy_policy' => $request->privacy_policy,
        'shipping_policy' => $request->shipping_policy,
        'terms_policy' => $request->terms_policy,
        'logo' => $newLogo,               
        'meta_description' => $request->meta_description,
    ]);

    toastr()->timeOut(10000)->closeButton()->addSuccess('Setting Updated Successfully');
    return view('/admin/setting', compact('settings'))->with('data', $data);
}

    public function user_index()
    {
        $users = User::with('wallet')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

     public function status($id)
    {
        $users = User::findorFail($id);
        $newStatus = ($users->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $users->update(['status' => $newStatus]); 
        return redirect()->route('user.all')->with('success', 'User Status Changed Succesfully');
    }

    public function dashboard() 
    {
    $dashboard = DB::select("
                            Select sum(total) As TotalAmount,
                            sum(if(status='ordered',total,0)) As TotalOrderedAmount,
                            sum(if(status='booked',total,0)) As TotalBookedAmount,
                            sum(if(status='returned',total,0)) As TotalReturnedAmount,
                            sum(if(status='delivered',total,0)) As TotalDeliveredAmount,
                            sum(if(status='canceled',total,0)) As TotalCanceledAmount,
                            Count(*) As Total,
                            sum(if(status='ordered',1,0)) As TotalOrdered,
                            sum(if(status='booked',1,0)) As TotalBooked,
                            sum(if(status='returned',1,0)) As TotalReturned,
                            sum(if(status='delivered',1,0)) As TotalDelivered,
                            sum(if(status='canceled',1,0)) As TotalCanceled
                            From orders
                            ");
    return view('admin.dashboard', compact('dashboard')); 
    }

    public function bannerIndex(){
        $banners = Banner::paginate(10);
        return view('admin.banner.index')->with('banners',$banners); 
    } 

    public function Bannercreate()
    {
        return view('admin/banner/create');
    }

     public function BannerStore(Request $request)
    {
        // Validate the incoming request
    $validatedData = $request->validate([
        'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

        $fileName = null;

    // Handle file upload for the image
    if ($request->hasFile('banner')) {
        $file = $request->file('banner');
        $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
        $file->move(storage_path('app/public/uploads/banner/'), $fileName);
    }

        Banner::create([
                'banner' => $fileName,
                'status' => 'ACTIVE',
        ]);
        return redirect()->route('banner.all')->with('success', 'Banner Created Successfully');
    } 

     public function Bannerstatus($id)
    {
        $category = Banner::findorFail($id);
        $newStatus = ($category->status == 'DEACTIVE') ? 'ACTIVE' : 'DEACTIVE';
        $category->update(['status' => $newStatus]);
        return redirect()->route('banner.all')->with('success', 'Banner Status Changed Succesfully');
    }

    public function Bannerdelete($id)
{

        $banner = Banner::findOrFail($id);
        $currentImage = $banner->banner;
        // Delete the order itself
        $banner->delete();
         if ($currentImage && file_exists(storage_path('app/public/uploads/banner/' . $currentImage))) {
        File::delete(storage_path('app/public/uploads/banner/' . $currentImage));
         }
        File::delete(storage_path('app/public/uploads/banner/') . $currentImage);
        return redirect()->route('banner.all')->with('success', 'Banner Deleted Successfully!');
}


    public function AddtoCartOrders()
    {
        $atcOrders = Order::paginate(10);
        return view('admin.order.index', compact('atcOrders'));
    }

    public function SingleAddtoCartOrders($order_id)
    {
        $order = Order::find($order_id);
        $orderitems = OrderItem::where('order_id', $order_id)->orderBy('id')->paginate(10);
        $transaction = Transaction::where('order_id', $order_id)->first();
        return view('admin.order.single', compact('order', 'orderitems', 'transaction'));
    }

    public function UpdateOrderStatus(Request $request) 
{
    // Find the order
    $order = Order::find($request->order_id);
    $order->status = $request->order_status;

    // Set the delivered or canceled date
    if ($request->order_status == 'delivered') {
        $order->delivered_date = Carbon::now();
    } 
    else if ($request->order_status == 'returned') {
        $order->reutrned_date = Carbon::now(); 
    }
    else if ($request->order_status == 'canceled') {
        $order->canceled_date = Carbon::now();
    }
    $order->save();

    // If the order is delivered, update the transaction status and wallet
    if ($request->order_status == 'delivered') {
        // Update the transaction status
        $transaction = Transaction::where('order_id', $request->order_id)->first();
        $transaction->status = 'approved';
        $transaction->save(); 

        // Calculate remaining amount and update wallet
        $user_id = $order->user_id;
        $total = $order->total; // Total amount from the order
        $selling_price = $order->selling_price; // Selling price from the order
        $remainingAmount = $selling_price - $total; // Remaining amount after deduction

        // Get or create the user's wallet
        $wallet = Wallet::where('user_id', $user_id)->first();

        if ($wallet) {
            // Update the existing wallet balance
            $wallet->balance += $remainingAmount;
            $wallet->save();
        } else {
            // Create a new wallet if it doesn't exist
            Wallet::create([
                'user_id' => $user_id,
                'balance' => $remainingAmount,
            ]);
        }
    }


    // If the order is returned, update the transaction status and wallet
if ($request->order_status == 'returned') {
    // Update the transaction status
    $transaction = Transaction::where('order_id', $request->order_id)->first();
    if ($transaction) {
        $transaction->status = 'approved'; // Update to 'returned' for clarity
        $transaction->save();
    }

    // Calculate the amount to be deducted (profit + shipping)
    $user_id = $order->user_id;
    $total = $order->total; 
    $totals = $total - 199; 
    $selling_price = $order->selling_price; // Selling price of the order

    // Calculate the profit (selling price - total cost)
    $profit = $selling_price - $totals;

    // Total deduction (profit + shipping)
    $deductionAmount = $profit;

    // Get or create the user's wallet
    $wallet = Wallet::where('user_id', $user_id)->first();

    if ($wallet) {
        // Deduct the amount from the wallet balance
        $wallet->balance -= $deductionAmount;
        $wallet->save();
    } else {
        // Create a new wallet with a negative balance if needed
        Wallet::create([
            'user_id' => $user_id,
            'balance' => -$deductionAmount, // Allow negative balance
        ]);
    }
}


    // Return with a success message
    return back()->with("status", "Status Changed Successfully");
}


     public function AddtoCartOrdersDelete($order_id)
{
    try {
        // Find the order by its ID
        $order = Order::findOrFail($order_id);

        // Delete associated order items
        $order->Items()->delete();

        // Delete the order itself
        $order->delete();

        return redirect()->route('addtocartorders')->with('success', 'Order and its items have been successfully deleted.');
    } catch (\Exception $e) {
        return redirect()->route('addtocartorders')->with('error', 'Failed to delete the order: ' . $e->getMessage());
    }
}
   
    public function UserPayout()
    {
        $payoutRequests = PayoutRequest::get();
        return view('admin.user.payout', compact('payoutRequests'));
    }

public function PayoutUpdateStatus(Request $request, $id)
{
    // Validate the input
    $request->validate([
        'status' => 'required|string|in:pending,approved',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
    ]);

    // Find the payout request by ID
    $payoutRequest = PayoutRequest::find($id);

    if (!$payoutRequest) {
        return back()->with('error', 'Payout request not found.');
    }

    // Update the status
    $payoutRequest->status = strtolower($request->status);

    $fileName = $payoutRequest->image; // Preserve the old image if not updated

    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($payoutRequest->image && file_exists(storage_path('app/public/uploads/payout/' . $payoutRequest->image))) {
            unlink(storage_path('app/public/uploads/payout/' . $payoutRequest->image));
        }

        // Upload new image
        $file = $request->file('image');
        $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
        $file->storeAs('/public/uploads/payout/', $fileName); // Store image in storage/app/uploads/payout/
    }

    // Save the updated payout request with the new image (if any)
    $payoutRequest->image = $fileName;
    $payoutRequest->save();

    // Mark related orders as "paid" if status is "approved"
    if ($payoutRequest->status === 'approved') {
        $orders = Order::where('user_id', $payoutRequest->user_id)
            ->where('status', 'delivered') // Only select delivered orders
            ->where('payment_status',  '!=', 'paid') // Only select orders with payment_status = pending
            ->get();

        foreach ($orders as $order) {
            $order->payment_status = 'paid';
            $order->paid_date = now(); // Record the payment date
            $order->save();
        }
    }

    return back()->with('success', 'Payout request status updated successfully.');
}




}
