<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('aset', 'Api\AsetController@index');
    Route::get('aset/{id}', 'Api\AsetController@show');
    Route::post('aset', 'Api\AsetController@store');
    Route::put('aset/{id}', 'Api\AsetController@update');
    Route::delete('aset/{id}', 'Api\AsetController@destroy');

Route::get('driver', 'Api\DriverController@index');
    Route::get('driver/{id}', 'Api\DriverController@show');
    Route::post('driver', 'Api\DriverController@store');
    Route::put('driver/{id}', 'Api\DriverController@update');
    Route::delete('driver/{id}', 'Api\DriverController@destroy');

Route::get('mitra', 'Api\MitraController@index');
    Route::get('mitra/{id}', 'Api\MitraController@show');
    Route::post('mitra', 'Api\MitraController@store');
    Route::put('mitra/{id}', 'Api\MitraController@update');
    Route::delete('mitra/{id}', 'Api\MitraController@destroy');

Route::get('pegawai', 'Api\PegawaiController@index');
    Route::get('pegawai/{id}', 'Api\PegawaiController@show');
    Route::post('pegawai', 'Api\PegawaiController@store');
    Route::put('pegawai/{id}', 'Api\PegawaiController@update');
    Route::delete('pegawai/{id}', 'Api\PegawaiController@destroy');

Route::get('role', 'Api\RoleController@index');
    Route::get('role/{id}', 'Api\RoleController@show');
    Route::post('role', 'Api\RoleController@store');
    Route::put('role/{id}', 'Api\RoleController@update');
    Route::delete('role/{id}', 'Api\RoleController@destroy');

Route::get('promo', 'Api\PromoController@index');
    Route::get('promo/{id}', 'Api\PromoController@show');
    Route::post('promo', 'Api\PromoController@store');
    Route::put('promo/{id}', 'Api\PromoController@update');
    Route::delete('promo/{id}', 'Api\PromoController@destroy');

Route::get('customer', 'Api\CustomerController@index');
    Route::get('customer/{id}', 'Api\CustomerController@show');
    Route::post('customer', 'Api\CustomerController@store');
    Route::put('customer/{id}', 'Api\CustomerController@update');
    Route::delete('customer/{id}', 'Api\CustomerController@destroy');

Route::get('transaksi', 'Api\TransaksiController@index');
    Route::get('transaksi/{id}', 'Api\TransaksiController@show');
    Route::post('transaksi', 'Api\TransaksiController@store');
    Route::put('transaksi/{id}', 'Api\TransaksiController@update');
    Route::delete('transaksi/{id}', 'Api\TransaksiController@destroy');

Route::get('jadwalshift', 'Api\JadwalShiftControler@index');
    Route::get('jadwalshift/{id}', 'Api\JadwalShiftController@show');
    Route::post('jadwalshift', 'Api\JadwalShiftController@store');
    Route::put('jadwalshift/{id}', 'Api\JadwalShiftController@update');
    Route::delete('jadwalshift/{id}', 'Api\JadwalShiftController@destroy');

Route::get('detailjadwal', 'Api\DetailJadwalController@index');
    Route::get('detailjadwal/{id}', 'Api\DetailJadwalController@show');
    Route::post('detailjadwal', 'Api\DetailJadwalController@store');
    Route::put('detailjadwal/{id}', 'Api\DetailJadwalController@update');
    Route::delete('detailjadwal/{id}', 'Api\DetailJadwalController@destroy');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
