<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//petugas
Route::post('register', 'PetugasController@register');
Route::post('login', 'PetugasController@login');
Route::get('/', function(){
  return Auth::user()->level;
})->middleware('jwt.verify');
Route::get('user', 'PetugasController@getAuthenticatedUser')->middleware('jwt.verify');

//Peminjam
// Route::get('Peminjam','PeminjamController@index')->middleware('jwt.verify');
Route::post('/add_p','PeminjamController@store')->middleware('jwt.verify');
Route::put('/update_p/{id}','PeminjamController@update')->middleware('jwt.verify');
Route::get('/tampil_p','PeminjamController@tampil')->middleware('jwt.verify');
Route::delete('/hapus_p/{id}','PeminjamController@destroy')->middleware('jwt.verify');

//Barang
// Route::get('Barang','BarangController@index')->middleware('jwt.verify');
Route::post('/add_barang','BarangController@store')->middleware('jwt.verify');
Route::put('/update_barang/{id}','BarangController@update')->middleware('jwt.verify');
Route::get('/tampil_barang','BarangController@tampil')->middleware('jwt.verify');
Route::delete('/hapus_barang/{id}','BarangController@destroy')->middleware('jwt.verify');

