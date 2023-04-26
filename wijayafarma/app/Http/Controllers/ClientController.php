<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;


class ClientController extends Controller
{
     public function Dasboard(){
    $allproduct = Product::latest()->get();
    return view('users.dasboard',compact('allproduct'));
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
        return view('users.addtocart');
    }
    public function AddProductToCart(Request $request){
        // $product_price = $request->price;
        // $quantity = $request->quantity;
        // $price =  $product_price * $quantity;
        // Cart::Insert([

        //     'product_id' => $request->product_id,
        //     'user_id' => \Illuminate\Support\Facades\Auth::id(),
        //     'quantity' => $request->quantity,
        //     'price' => $price,
        // ]);

        // return redirect()->route('addtocart')->with('message','Barang Berhasil Ditambahkan ke Keranjang');
    }

    public function CheckOut(){
        return view('users.checkout');
    }
    public function UserProfile(){
        return view('users.profile');
    }
    public function PeddingOrders(){
        return view('users.peddingorders');
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
