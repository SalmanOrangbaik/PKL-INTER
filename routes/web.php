<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//route basic
Route::get('profile', function () {
    return view('profile');
});

//route parameters
Route::get('produk/{namaProduk}', function ($p) {
    return 'Saya Membeli' . $p;
});

Route::get('kategori/{namaKategori}', function ($namaKategori) {
    return view('kategori', compact('namaKategori'));
});

//route Optional Parameters
Route::get('search/{keyword?}', function ($key = null) {
    return view('search', compact('key'));
});

Route::get('toko/{barang}/{promo} ', function ($barang = null, $promo = null) {
    return view('toko', compact('barang', 'promo'));
});
