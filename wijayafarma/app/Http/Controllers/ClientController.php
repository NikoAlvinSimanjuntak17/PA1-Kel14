<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Models\ShippingInfo;

class ClientController extends Controller
{
        public function index(){
        $allproduct = Product::latest()->get();
    return view('users.home',compact('allproduct'));
    }
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
    public function PeddingOrdersDetil($id){
        $pedding = Order::findOrFail($id);
        return view('users.peddingorderdetil',compact('pedding'));
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

    public function deletecart(Request $request){
        $ids = $request->ids;
        Cart::whereIn('id',$ids)->delete();
        return redirect()->route('addtocart')->with('message','Barang Berhasil Dihapus dari keranjang');
    }

    public function AddProductToCart(Request $request){
        Cart::Insert([
            'product_id' => $request->product_id,
            'product_nama' => $request->product_name,
            'product_img' => $request->product_img,
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        return redirect()->route('product')->with('message','Barang Berhasil Ditambahkan ke Keranjang');
    }
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->input('quantity');
        $cart->save();

        return redirect()->back()->with('success', 'Quantity updated successfully.');
    }

    public function about(){
        return view('users.about');
    }
    public function GetShippingaddress(){
        return view('users.shipping');
    }
    // public function AddShippingAddress(Request $request){
    //     ShippingInfo::insert ([
    //         'user_id' => \Illuminate\Support\Facades\Auth::id(),
    //         'phone_number' => $request->phone_number,
    //         'city_name' => $request->city_name,
    //         'postal_code' => $request->postal_code,
    //     ]);
    //     return redirect()->route('checkout');
    // }
    public function RemoveCartItem($id){
        Cart::findOrFail($id)->delete();
        return redirect()->route('addtocart')->with('message','Barang Berhasil Dihapus dari keranjang');
    }

    public function CheckOut(Request $request)
    {
        $userid = \Illuminate\Support\Facades\Auth::id();
        $checkedItems = $request->input('ids', []);

        if (empty($checkedItems)) {
            return redirect()->back()->with('error', 'Pilih produk sebelum melanjutkan ke checkout.');
        }

        // Dapatkan hanya item yang dicentang dari keranjang
        $cart_items = Cart::whereIn('id', $checkedItems)->where('user_id', $userid)->get();

        // $shipping_address = ShippingInfo::where('user_id', $userid)->first();

        return view('users.checkout', compact('cart_items'));
    }


    public function PlaceOrder(Request $request)
    {
        $userid = \Illuminate\Support\Facades\Auth::id();
        $cart_items = Cart::where('user_id', $userid)->get();

        $shipping_phonenumber = $request->input('shipping_phonenumber');
        $shipping_city = $request->input('shipping_city');
        $shipping_postalcode = $request->input('shipping_postalcode');

        // Periksa validitas data pengiriman
        if (!$shipping_phonenumber || !$shipping_city || !$shipping_postalcode) {
            // Tangani situasi di mana nilai-nilai tersebut tidak valid
            // Misalnya, tampilkan pesan kesalahan kepada pengguna atau lakukan tindakan lain sesuai kebutuhan Anda.
            // Kemudian kembalikan respons atau lakukan pengalihan ke halaman yang sesuai.
        }

        $productIds = [];
        $productimgs = [];
        $productnames = [];
        $quantities = [];
        $prices = [];

        foreach ($cart_items as $item) {
            $productIds[] = $item->product_id;
            $productimgs[] = $item->product_img;
            $productnames[] = $item->product_nama;
            $quantities[] = $item->quantity;
            $prices[] = $item->price;

            $id = $item->id;
            Cart::findOrFail($id)->delete();
        }

        Order::insert([
            'user_id' => $userid,
            'shipping_phonenumber' => $shipping_phonenumber,
            'shipping_city' => $shipping_city,
            'shipping_postalcode' => $shipping_postalcode,
            'product_id' => json_encode($productIds),
            'product_nama' => json_encode($productnames),
            'product_img' => json_encode($productimgs),
            'quantity' => json_encode($quantities),
            'totalprice' => json_encode($prices)
        ]);

        return redirect()->route('peddingorders')->with('message', 'Your Order Has Been Placed Successfully!');
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

    public function incrementQuantity($id)
    {
        $product = Cart::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $product->quantity++;
        $product->save();

        return redirect()->back()->with('success', 'Quantity berhasil diincrement.');
    }

    public function decrementQuantity($id)
    {
        $product = Cart::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        if ($product->quantity > 1) {
            $product->quantity--;
            $product->save();
        }
        else{
            $product->delete();
            return redirect()->back()->with('success', 'Produk berhasil dihapus.');
        }

        return redirect()->back()->with('success', 'Quantity berhasil didecrement.');
    }
}

