<?php

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
/*
Route::get('/', function () {
    return view('home');
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
/*
Route::get('/user', 'UserController@index');
Route::get('/user-register', 'UserController@create');
Route::post('/user-register', 'UserController@store');
Route::get('/user-edit/{id}', 'UserController@edit');
*/
Route::resource('user', 'UserController');

Route::resource('customer', 'CustomerController');
Route::get('/format_customer', 'CustomerController@format');

Route::resource('brand', 'BrandController');
Route::get('/format_brand', 'BrandController@format');

Route::resource('mobil', 'MobilController');
Route::get('/format_mobil', 'MobilController@format');
Route::get('/laporan/mobil', 'LaporanController@Mobil');
Route::get('/laporan/mobil/pdf', 'LaporanController@MobilPdf');
Route::get('/laporan/mobil/excel', 'LaporanController@MobilExcel');

Route::resource('transaksi', 'TransaksiController');
Route::get('/laporan/trs', 'LaporanController@transaksi');
Route::get('/laporan/trs/pdf', 'LaporanController@transaksiPdf');
Route::get('/laporan/trs/excel', 'LaporanController@transaksiExcel');
