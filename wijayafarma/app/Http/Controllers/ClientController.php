<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Models\ShippingInfo;
use Illuminate\Support\Facades\Storage;

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
    public function orderdelete($id){
        Order::findOrFail($id)->delete();
        return redirect()->route('peddingorders')->with('message','order berhasil Dihapus');
    }
    public function SingleProduct($id)
    {
        $product = Product::findOrFail($id);
        $subcat_id = Product::where('id', $id)->value('product_subcategory_id');
        $related_products = Product::where('product_subcategory_id', $subcat_id)->latest()->get();

        // Get the orders related to the product and have a non-null ulasan
        $orders = Order::where('product_id', 'LIKE', '%' . $id . '%')->whereNotNull('ulasan')->get();

        // Prepare arrays to store comments, user IDs, names, and created dates
        $comments = [];
        $userIds = [];
        $userNames = []; // Add this array to store user names
        $createdDates = [];

        foreach ($orders as $order) {
            $productIds = json_decode($order->product_id);
            if (in_array($id, $productIds)) {
                $comments[] = $order->ulasan;
                $userIds[] = $order->user_id;
                $userNames[] = User::where('id', $order->user_id)->value('name'); // Get the user name
                $createdDates[] = $order->created_at;
            }
        }

        return view('users.productdetail', compact('product', 'related_products', 'comments', 'userIds', 'userNames', 'createdDates'));
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
        $product = Product::find($request->product_id);

        if($request->quantity <= $product->quantity) {
            Cart::Insert([
                'product_id' => $request->product_id,
                'product_nama' => $request->product_name,
                'product_img' => $request->product_img,
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'quantity' => $request->quantity,
                'price' => $request->price,
            ]);

            return redirect()->route('product')->with('message', 'Barang Berhasil Ditambahkan ke Keranjang');
        } else {
            return redirect()->route('product')->with('error', 'Quantity melebihi batas yang tersedia');
        }
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
        $address = $request->input('address');
        $shipping_postalcode = $request->input('shipping_postalcode');

        // Periksa validitas data pengiriman
        if (!$shipping_phonenumber || !$shipping_city || !$address || !$shipping_postalcode) {
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

            // Mengurangi jumlah produk yang tersedia
            $product = Product::findOrFail($item->product_id);
            $product->quantity -= $item->quantity;
            $product->save();
        }

        Order::insert([
            'user_id' => $userid,
            'shipping_phonenumber' => $shipping_phonenumber,
            'shipping_city' => $shipping_city,
            'address' => $address,
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
            $pending_orders = Order::whereIn('status', ['pending', 'in progress'])->latest()->get();
            return view('users.peddingorders',compact('pending_orders'));
    }

    public function uploadBayar(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }

        if ($request->hasFile('img_bayar')) {
            $image = $request->file('img_bayar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload'), $imageName);

            // Update the order record with the image path
            $order->img_bayar = 'upload/' . $imageName;
            $order->save();

            return redirect()->back()->with('message', 'Payment proof uploaded successfully');
        }

        return redirect()->back()->with('error', 'No image uploaded');
    }
    public function komentar(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }

        $ulasan = $request->input('ulasan');
        // Set nilai ulasan pada order

        $order->ulasan = $ulasan;

        // Simpan perubahan pada order
        $order->save();


        return redirect()->back()->with('message', 'Terimakasi atas Ulasannya');
    }


    public function History(){
        $completed_orders = Order::where("status", "selesai")->latest()->get();
        return view('users.history', compact('completed_orders'));
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
    public function orderDelivered($id)
{
    $order = Order::findOrFail($id);
    $order->status = 'selesai';
    $order->save();

    // Redirect ke halaman yang tepat atau tampilkan pesan sukses
    return redirect()->route('history')->with('success', 'Order has been delivered.');
}
public function HistoryDetil($id){
    $pedding = Order::findOrFail($id);
    return view('users.historydetil',compact('pedding'));
}
public function webdelete($id)
{
        Order::findOrFail($id)->delete();
        return redirect()->route('peddingorders')->with('message','order berhasil Dihapus');
}
public function delete($id)
{
    // Find the order record
    $order = Order::findOrFail($id);

    // Delete the image from storage
    Storage::delete($order->img_bayar);

    // Update the order record with a null value for the image
    $order->img_bayar = null;
    $order->save();

    // Redirect or return a response as needed
    return redirect()->back()->with('success', 'Image deleted successfully.');
}

}

