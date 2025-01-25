<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('invoices','InvoiceController');
Route::resource('section','SectionController');
Route::resource('products','ProductsController');
Route::resource('customers','CustomersController');
Route::resource('discounts','DiscountsController');
Route::resource('taxes','TaxController');
Route::get('/{page}', 'AdminController@index');


