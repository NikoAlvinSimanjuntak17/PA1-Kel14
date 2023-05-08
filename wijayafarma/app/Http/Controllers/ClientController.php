<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Models\Order;
use App\Models\ShippingInfo;

class ClientController extends Controller
{
     public function Dasboard(){
    $allproduct = Product::latest()->get();
    return view('users.home',compact('allproduct'));
    }
    public function Penyakit(){
        return view('users.penyakit');
    }

    public function CategoryPage($id){
        $category = Category::findOrFail($id);
        $products = Product::where('product_category_id',$id)->latest()->get();
    return view('users.category',compact('category','products'));
    }
        public function Product(){
    return view('users.allproduct');
    }
    public function SingleProduct($id){
        $product = Product::findOrFail($id);
        $subcat_id = Product::where('id',$id)->value('product_subcategory_id');
        $related_products = Product::where('product_subcategory_id',$subcat_id)->latest()->get();
        return view('users.productdetail',compact('product','related_products'));
    }
    public function AddToCart(){
        $userid = \Illuminate\Support\Facades\Auth::id();
        $cart_items = Cart::where('user_id',$userid)->get();
        return view('users.addtocart',compact('cart_items'));
    }
    public function AddProductToCart(Request $request){
        $product_price = $request->price;
        $quantity = $request->quantity;
        $price =  $product_price * $quantity;
        Cart::Insert([

            'product_id' => $request->product_id,
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'quantity' => $request->quantity,
            'price' => $price,
        ]);

        return redirect()->route('addtocart')->with('message','Barang Berhasil Ditambahkan ke Keranjang');
    }
    public function about(){
        return view('users.about');
    }
    public function GetShippingaddress(){
        return view('users.shipping');
    }
    public function AddShippingAddress(Request $request){
        ShippingInfo::insert ([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'phone_number' => $request->phone_number,
            'city_name' => $request->city_name,
            'postal_code' => $request->postal_code,
        ]);
        return redirect()->route('checkout');

    }
    public function RemoveCartItem($id){
        Cart::findOrFail($id)->delete();
        return redirect()->route('addtocart')->with('message','Barang Berhasil Dihapus dari keranjang');
    }
    public function CheckOut(){
        $userid = \Illuminate\Support\Facades\Auth::id();
        $cart_items = Cart::where('user_id',$userid)->get();
        $shipping_address = ShippingInfo::where('user_id',$userid)->first();
        return view('users.checkout',compact('cart_items','shipping_address'));
    }
    public function PlaceOrder(){
        $userid = \Illuminate\Support\Facades\Auth::id();
        $shipping_address = ShippingInfo::where('user_id',$userid)->first();
        $cart_items = Cart::where('user_id',$userid)->get();

        foreach($cart_items as $item){
            Order::insert([
                'user_id' => $userid,
                'shipping_phonenumber' => $shipping_address->phone_number,
                'shipping_city' => $shipping_address->city_name,
                'shipping_postalcode' => $shipping_address->postal_code,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'totalprice' => $item->price
            ]);
            $id = $item->id;
            Cart::findOrFail($id)->delete();
        }

        ShippingInfo::where('user_id',$userid)->first()->delete();

        return redirect()->route('peddingorders')->with('message','Your Order Has Been Placed SuccessFully!');
    }
        public function UserProfile(){
            return view('users.profile');
        }
        public function PeddingOrders(){
            $pending_orders = Order::where("status","pending")->latest()->get();
        return view('users.peddingorders',compact('pending_orders'));
    }
    public function History(){
        return view('users.history');
    }
    public function NewRelease(){
        return view('users.newrelease');
    }
    public function TodayDeal(){
        return view('users.todaydeal');
    }
    public function CustomerService(){
        return view('users.customerservice');
    }
}
