<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
        $admin = Auth::user();

        $order = Order::get();
        foreach ($order as $item) {
            $notif = $admin->notifications()->where('data->id',$item->id)->first();
            if(!$notif){
                $save = new OrderNotification($item);
                $admin->notify($save);
            }
        }
        return view('admin.allproducts', compact('products','admin'));
    }
    public function AddProduct(){
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();
        $admin = Auth::user();

        $order = Order::get();
        foreach ($order as $item) {
            $notif = $admin->notifications()->where('data->id',$item->id)->first();
            if(!$notif){
                $save = new OrderNotification($item);
                $admin->notify($save);
            }
        }
        return view('admin.addproduct',compact('categories','subcategories','admin'));
    }
        public function StoreProduct(Request $request){
            $request->validate([
                'product_name' => 'required|unique:products',
                'price' => 'required',
                'quantity' => 'required',
                'product_deskripsi' => 'required',
                'product_category_id' => 'required|exists:categories,id',
                'product_subcategory_id' => 'required|exists:subcategories,id',
                'product_img.*' => 'required|image|mimes:jpeg,png,jpg,giv,svg|max:2048',
            ]
        );

            $brand_images = $request->file('product_img');
    $images = array();
    foreach($brand_images as $brand_image){
        $nama_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $nama_gen . '.' . $img_ext;
        $up_location = "upload/";
        $last_img = $up_location . $img_name;

        // Move the uploaded file to the specified location
        $brand_image->move($up_location, $img_name);

        $images[] = $last_img;
    }



            $category_id = $request->product_category_id;
            $subcategory_id = $request->product_subcategory_id;

            $category_name = Category::where('id',$category_id)->value('category_name');
            $subcategory_name = SubCategory::where('id',$subcategory_id)->value('subcategory_name');

            Product::insert([
                'product_name' => $request->product_name,
                'product_deskripsi' => $request->product_deskripsi,
                'price' => $request->price,
                'product_category_name' => $category_name,
                'product_subcategory_name' => $subcategory_name,
                'product_category_id' => $request->product_category_id,
                'product_subcategory_id' => $request->product_subcategory_id,
                'product_img' => json_encode($images),
                'quantity' => $request->quantity,
                'slug' => strtolower(str_replace('','-',$request->product_name)),
            ]);

            Category::where('id',$category_id)->increment('product_count',1);
            SubCategory::where('id',$subcategory_id)->increment('product_count',1);

            return redirect()->route('allproduct')->with('message','Tambah Produk Berhasil!');

        }
    public function EditProductImg($id){
        $productinfo = Product::findOrFail($id);
        return view('admin.editproductimg',compact('productinfo'));
    }
    public function UpdateProductImg(Request $request){
        $request->validate([
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $id = $request->id;
        $image = $request->file('product_img');
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'),$image_name);
        $image_url = 'upload/' . $image_name;

        Product::findOrFail($id)->update([
            'product_img' => $image_url,
        ]);

        return redirect()->route('allproduct')->with('message','Gambar Produk Berhasil Di Update');
    }
    public function EditProduct($id){
        $product = Product::findOrFail($id);

        return view('admin.editproduct', compact('product'));
    }
    public function updateproduct(Request $request){
        $id = $request->id;

        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'product_deskripsi' => 'required',
        ]);
        Product::findOrFail($id)->update([
            'product_name' => $request->product_name,
            'product_deskripsi' => $request->product_deskripsi,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace('','-',$request->product_name)),
        ]);
        return redirect()->route('allproduct')->with('message','Produk Berhasil Di Update');


    }
    public function DeleteProduct($id){
        $cat_id = Product::where('id',$id)->value('product_category_id');
        $subcat_id = Product::where('id',$id)->value('product_subcategory_id');
        Category::where('id',$cat_id)->decrement('product_count',1);
        SubCategory::where('id',$subcat_id)->decrement('product_count',1);
        Product::findOrFail($id)->delete();

        return redirect()->route('allproduct')->with('message','Produk Berhasil Di Hapus');
    }

}