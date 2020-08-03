<?php

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

Route::get('/home', 'HomeController@index')->name('home');


Route::get('invoice/invoiceitemproducts/get', 'InvoiceController@getAllInvoiceItemProducts');

Route::get('invoice', 'InvoiceController@index');
Route::get('invoice/create', 'InvoiceController@create');

Route::post('invoice/store', 'InvoiceController@store');
