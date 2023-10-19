<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminSlideController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\MessageContactController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ShopController;
use App\Http\Controllers\Client\ShopDetailsController;
use App\Http\Controllers\ProfileController;
use App\Models\AdminBlogModel;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::prefix('admin')->name('admin.')->group(function(){
    //User
    Route::get('user',[UserController::class, 'index'])->name('users.index');
    //Category
    Route::get('category',[ProductCategoryController::class, 'index'])->name('category.index');
    //Add
    Route::get('category/add',[ProductCategoryController::class, 'add'])->name('category.add');
    //Store
    Route::post('category/store',[ProductCategoryController::class, 'store'])->name('category.store');
    //Detail
    Route::get('category/{product_category}', [ProductCategoryController::class, 'detail'])->name('category.detail');
    //Delete
    Route::get('category/destroy/{product_category}', [ProductCategoryController::class, 'destroy'])->name('category.destroy');
    //update
    Route::post('category/update/{product_category}', [ProductCategoryController::class, 'update'])->name('category.update');
    //------------------------------------------------------
    //Product
    Route::resource('product',ProductController::class);
    //Create//
    //uploadImage
    Route::post('product/Ckeditor-upload-image',[ProductController::class,'Uploadimage'])->name('product.ckedit.upload.image');
    //Slug
    Route::post('product/slug',[ProductController::class,'Slug'])->name('product.create.slug');
    //Edit//
    //update//
    //Restore
    Route::get('product/{product}/restore',[ProductController::class, 'restore'])->name('product.restore');

    //Blog
    Route::resource('formblog',AdminBlogController::class);
    //blog?restore
     Route::get('formblog/{formblog}/restore',[AdminBlogController::class,'restoreBlog'])->name('formblog.restore');
    //blog?Create
    //blog?slug
    Route::post('formblog/slug',[AdminBlogController::class,'Slug'])->name('formblog.create.slug');
    //blog?edit
    //blog?delete
    Route::resource('slide',AdminSlideController::class);
    Route::post('slide/slug',[AdminBlogController::class,'Slug'])->name('slide.create.slug');

    //Dashboard
    Route::get('dashboarditems', [DashboardController::class, 'index'])->name('dashboarditems.index');





});


//Home theme
Route::get('/',[HomeController::class, 'index'])->name('home.index');

Route::middleware('auth')->group(function(){

    Route::get('product/add-to-cart/{productId}', [CartController::class, 'AddToCart'])->name('product.add-to-cart');
    Route::get('product/delete-item-in-cart/{productId}', [CartController::class, 'DeleteItem'])->name('product.delete-item-in-cart');
    Route::get('product/update-item-in-cart/{productId}/{qty?}', [CartController::class, 'UpdateItem'])->name('product.update-item-in-cart');



    Route::get('cart', [CartController::class, 'indexCart'])->name('cart.index');
    Route::get('blog', [BlogController::class, 'indexBlog'])->name('blog.index');
    Route::get('contact', [CartController::class, 'indexContact'])->name('contact.index');
    Route::get('shop', [ShopController::class, 'shopIndex'])->name('shop.index');
    Route::get('shopdetails', [ShopDetailsController::class, 'shopDetailsIndex'])->name('shopdetails.index');



    Route::get('product/delete-item-in-cart', [CartController::class, 'emptyCart'])->name('product.delete-item-in-cart');
    Route::get('checkout', [CartController::class, 'checout'])->name('checkout');
    Route::post('placeorder',[OrderController::class, 'placeOrder'])->name('place-order');
    Route::post('messcontact',[MessageContactController::class, 'messcontact'])->name('messcontact');

    Route::get('vnpay-callback', [OrderController::class, 'vnpayCallback'])->name('vnpay-callback');

    Route::get('test-send-sms', function(){
        // Your Account SID and Auth Token from console.twilio.com
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $client = new Twilio\Rest\Client($sid, $token);

        // Use the Client to make requests to the Twilio REST API
        $client->messages->create(
            // The number you'd like to send the message to
            '+84388609749',
            [
                // A Twilio phone number you purchased at https://console.twilio.com
                'from' => env('TWILIO_PHONE_NUMBER'),
                // The body of the text message you'd like to send
                'body' => "Test Send SMS"
            ]
        );
    })->name('send-sms');

});




