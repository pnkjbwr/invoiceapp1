<?php

use App\Product;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::resource('customers', 'CustomerController');
    Route::resource('invoices', 'InvoiceController');
    Route::resource('taxrates', 'TaxrateController');
    Route::resource('products', 'ProductController');

    Route::get('salesq', function () {
        $products = Product::with('taxRate')->get();
        return view('admin.sales.index',compact('products'));
    });
});