<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\deseases;
use App\Models\Order;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

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
        $order = Order::count();
        $deseases = deseases::count();
        return view('admin.dasboard',compact('product','category','subcategory','order','deseases'));
    }
}
