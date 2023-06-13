<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\deseases;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Database\Eloquent\Relations\MorphMany;

class DasboardController extends Controller
{
       public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }


    public function index(){
        $product = Product::count();
        $category = Category::count();
        $subcategory = Subcategory::count();
        $today = Carbon::today();
        $orders = Order::whereDate('time', $today)->whereIn('status', ['in progress', 'selesai'])->count();

        $ordercount = Order::count();
        $count = Order::whereIn('status', ['in progress','selesai'])->get();
        $deseases = deseases::count();
        $admin = Auth::user();

        $order = Order::get();
        foreach ($order as $item) {
            $notif = $admin->notifications()->where('data->id',$item->id)->first();
            if(!$notif){
                $save = new OrderNotification($item);
                $admin->notify($save);
            }
        }
        return view('admin.dasboard',compact('product','category','subcategory','orders','deseases','admin','count','ordercount'));
    }
    public function read($id){
        if($id){
            Auth::user()->notifications()->where('id',$id)->first()->markAsRead();
        }
        return redirect()->back();
    }
    public function editprofileadmin(){
        return view('admin.editprofile');
    }
}
