<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Order;
use App\Models\Subcategory;
use App\Http\Controllers\Controller;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function index(){
        $allsubcategories = Subcategory::latest()->get();
        $admin = Auth::user();

        $order = Order::get();
        foreach ($order as $item) {
            $notif = $admin->notifications()->where('data->id',$item->id)->first();
            if(!$notif){
                $save = new OrderNotification($item);
                $admin->notify($save);
            }
        }
        return view('admin.allsubcategory',compact('allsubcategories','admin'));
    }
    public function AddSubCategory(){
        $categories = Category::latest()->get();
        return view('admin.addsubcategory', compact('categories'));
    }
    public function StoreSubCategory(Request $request){
        $request->validate([
             'subcategory_name' => 'required|unique:subcategories,subcategory_name,NULL,id,category_id,'.$request->category_id,
            'category_id' => 'required|unique:categories,category_name,NULL,id',
        ]);

        $category_id = $request->category_id;
        $category_name = Category::where('id',$category_id)->value('category_name');

        SubCategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace('','-',$request->subcategory_name)),
            'category_id' => $category_id,
            'category_name' => $category_name
        ]);

        Category::where('id',$category_id)->increment('subcategory_count',1);

        return redirect()->route('allsubcategory')->with('message','SubCategories Added Succesfullly!');

    }
    public function EditSubCat($id){
        $subcatinfo = Subcategory::findOrFail($id);

        return view('admin.editsubcat',compact('subcatinfo'));
    }
    public function UpdateSubCat(Request $request){
        $request->validate([
                     'subcategory_name' => 'required|unique:subcategories,subcategory_name,NULL,id,category_id,'.$request->category_id,
    'category_id' => 'required|unique:categories,category_name,NULL,id',
        ]);
        $subcatid = $request->subcatid;

        SubCategory::findorFail($subcatid)->update([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace('','-',$request->subcategory_name)),
        ]);
        return redirect()->route('allsubcategory')->with('message','SubCategories Update Succesfullly!');

    }
    public function DeleteSubCat($id){
        $cat_id = SubCategory::where('id',$id)->value('category_id');
        SubCategory::findOrFail($id)->delete();

        Category::where('id',$cat_id)->decrement('subcategory_count',1);
        return redirect()->route('allsubcategory')->with('message','SubCategories Delete Succesfullly!');
    }
}
