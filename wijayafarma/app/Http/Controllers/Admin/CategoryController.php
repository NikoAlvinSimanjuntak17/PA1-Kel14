<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        $admin = Auth::user();

        $order = Order::get();
        foreach ($order as $item) {
            $notif = $admin->notifications()->where('data->id',$item->id)->first();
            if(!$notif){
                $save = new OrderNotification($item);
                $admin->notify($save);
            }
        }
        return view('admin.allcategory',compact('categories','admin'));
    }
    public function AddCategory(){
        return view('admin.addcategory');
    }
    public function StoreCategory(Request $request){
        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace('','-',$request->category_name))
        ]);

        return redirect()->route('allcategory')->with('message','Categories Added Succesfullly!');
    }
        public function EditCategory($id){
            $category_info = Category::findOrFail($id);

            return view('admin.editcategory',compact('category_info'));

        }
        public function UpdateCategory(Request $request){
            $category_id = $request->category_id;

            $request->validate([
                'category_name' => 'required|unique:categories'
            ]);

            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'slug' => strtolower(str_replace('','-',$request->category_name))
            ]);

            return redirect()->route('allcategory')->with('message','Categories Update Succesfullly!');

        }
        public function DeleteCategory($id){
            Category::findOrFail($id)->delete();
            return redirect()->route('allcategory')->with('message','Categories Delete Succesfullly!');
        }
}
