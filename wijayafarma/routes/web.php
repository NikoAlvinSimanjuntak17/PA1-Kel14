<?php

use App\Http\Controllers\Admin\DasboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\aboutController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\DeseasesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('users.home');
});


Route::controller(HomeController::class)->group(function(){
    Route::get('/','index')->name('Home');
});
Route::controller(ClientController::class)->group(function(){

    Route::get('/produk/category/{id}/{slug}','CategoryPage')->name('category');
    Route::get('/produk','Product')->name('product');
    Route::get('/produk-details/{id}/{slug}','SingleProduct')->name('singleproduct');
    Route::get('/new-release','NewRelease')->name('newrelease');
});

Route::middleware(['auth','role:user'])->group(function(){
    Route::controller(ClientController::class)->group(function(){
        Route::get('/about','About')->name('about');
        Route::get('/produk','Product')->name('product');
        Route::get('/shiping-address','GetShippingaddress')->name('shippingaddress');
        Route::post('/place-order','PlaceOrder')->name('placeorder');
        // Route::get('/shiping-address','GetShippingaddress')->name('shippingaddress');
        Route::post('add-shipping-address','AddShippingAddress')->name('addshippingaddress');
        Route::get('/checkout','Checkout')->name('checkout');
        Route::get('/user-profile','UserProfile')->name('userprofile');
        Route::get('/user-profile/pedding-orders','PeddingOrders')->name('peddingorders');
        Route::get('/user-profile/history','History')->name('history');
        Route::get('todays-deal','TodayDeal')->name('todaydeal');
        Route::get('/custom-service','CustomerService')->name('customerservice');
        Route::get('/add-to-cart','AddToCart')->name('addtocart');
        Route::post('/add-product-to-cart','AddProductToCart')->name('addproducttocart');
        Route::get('/remove-cart-item/{id}','RemoveCartItem')->name('removeitem');
    });
});


Route::get('/home', function () {
    return view('users.home');
})->middleware(['auth', 'role:user'])->name('dashboard');



Route::middleware('auth')->group(function () { /* middleware auth digunakan untuk memastikan bahwa hanya pengguna yang sudah melakukan autentikasi (login) yang dapat mengakses route yang terdaftar dalam group ini. Jika pengguna belum melakukan autentikasi, maka sistem akan mengarahkan pengguna ke halaman login terlebih dahulu sebelum pengguna dapat mengakses route yang ditentukan. */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/*
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');: route ini akan mengarahkan pengguna ke halaman untuk mengedit profil pengguna yang sudah terautentikasi.
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');: route ini akan menghandle permintaan dari pengguna untuk menyimpan perubahan profil pengguna yang sudah terautentikasi.
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');: route ini akan menghandle permintaan dari pengguna untuk menghapus akun pengguna yang sudah terautentikasi.
*/

Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(DasboardController::class)->group(function(){
        Route::get('/admin/dasboard','index')->name('admindasboard');
    });
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/all-category','Index')->name('allcategory');
        Route::get('/admin/add-category','AddCategory')->name('addcategory');
        Route::post('admin/store-category','StoreCategory')->name('storecategory');
        Route::get('admin/edit-category/{id}','EditCategory')->name('editcategory');
        Route::post('admin/update-category','UpdateCategory')->name('updatecategory');
        Route::get('admin/delete-category/{id}','DeleteCategory')->name('deletecategory');
    });
    Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/admin/all-subcategory','index')->name('allsubcategory');
        Route::get('/admin/add-subcategory','AddSubCategory')->name('addsubcategory');
        Route::post('admin/store-subcategory','StoreSubCategory')->name('storesubcategory');
        Route::get('admin/edit-subcategory/{id}','EditSubCat')->name('editsubcat');
        Route::post('admin/update-subcategory','UpdateSubCat')->name('updatesubcat');
        Route::get('admin/delete-subcategory/{id}','DeleteSubCat')->name('deletesubcat');
    });
    Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/all-products','index')->name('allproduct');
        Route::get('/admin/add-product','AddProduct')->name('addproduct');
        Route::post('/admin/store-product','StoreProduct')->name('storeproduct');
        Route::get('/admin/edit-product-img/{id}','EditProductImg')->name('editproductimg');
        Route::post('/admin/update-product-img','UpdateProductImg')->name('updateproductimg');
        Route::get('/admin/edit-product/{id}','EditProduct')->name('editproduct');
        Route::post('/admin/update-product','UpdateProduct')->name('updateproduct');
        Route::get('admin/delete-product/{id}','DeleteProduct')->name('deleteproduct');

    });
    Route::controller(DeseasesController::class)->group(function(){
        Route::get('/admin/all-penyakit','index')->name('allpenyakit');
        Route::get('/admin/add-penyakit','AddPenyakit')->name('addpenyakit');
        Route::post('/admin/store-penyakit','StorePenyakit')->name('storepenyakit');
        Route::get('/admin/edit-penyakit-img/{id}','EditPenyakitImg')->name('editpenyakitimg');
        Route::post('/admin/update-penyakit-img','UpdatePenyakitImg')->name('updatepenyakitimg');
        Route::get('/admin/edit-penyakit/{id}','EditPenyakit')->name('editpenyakit');
        Route::post('/admin/update-penyakit','UpdatePenyakit')->name('updatepenyakit');
        Route::get('admin/delete-penyakit/{id}','DeletePenyakit')->name('deletepenyakit');

    });
    Route::controller(OrderController::class)->group(function(){
        Route::get('/admin/pending-order','index')->name('pendingorder');
    });
    Route::controller(AdminAboutController::class)->group(function(){
        Route::get('/admin/about','index')->name('about');
    });


});

require __DIR__.'/auth.php';
