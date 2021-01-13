<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CostomerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',function(){
    return view('menu');
});
Route::get('logout',function(){
    return "
    <script>
    alert('ออกจากระบบเรียบร้อย');
    window.location='https://www.google.com/';
    </script>
    ";
});
Route::post('add_product_active',[ProductController::class, 'create']);
Route::post('edit_product_active',[ProductController::class, 'update']);

Route::get('product', function () {
     return view('product',['data'=>Product::all()]);
 });

 Route::get('add_product', function () {
    return view('add_data.product');
});
Route::get('confirm_customer', function () {
    return view('confirm_customer');
});
Route::get('insert_product_order', function () {
    return redirect('insert_product_order/-');
});
Route::get('order_product',[OrderController::class, 'index']);

 Route::get('edit_product/{id}',[ProductController::class, 'edit']);
 Route::get('delete_product/{id}',[ProductController::class, 'destroy']);
 Route::get('insert_product_order/{id}',[CostomerController::class, 'show']);
 Route::post('check_customer',[CostomerController::class, 'index']);
 Route::post('add_product_order',[OrderController::class, 'create']);
 Route::get('show_order_product/{id}',[OrderController::class, 'show']);
 Route::get('edit_product_order/{id}/{id_product}',[OrderController::class, 'edit']);
 Route::post('update_order_product',[OrderController::class, 'update']);
 Route::get('delete_product_order/{id}/{Order_no}',[OrderController::class, 'destroy']);
 Route::get('delete_order_product/{Order_no}',[OrderController::class, 'destroy_Order']);
 Route::post('get_report_order_customer',[OrderController::class, 'get_report_order_customer']);
 Route::get('report_order_customer',[OrderController::class, 'report_order_customer']);
 Route::get('excel_report_order_customer/{gdoc_date1}/{gdoc_date2}',[OrderController::class, 'excel_report_order_customer']);
 Route::get('process_order_customer',[OrderController::class, 'process_order_customer']);
 Route::post('process_report_order_customer',[OrderController::class, 'process_report_order_customer']);
 Route::get('process_report_order_customer/{gdoc_date1}/{gdoc_date2}',[OrderController::class, 'process_report_order_customer_active']);

 Route::get('test',function(){
    return  date("Y-m-d").'T'.(date("H")+10).date(":i");
});
