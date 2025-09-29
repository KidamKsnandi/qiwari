<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
    return view('index');
});
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return view('clear');
});
Route::get('/logout', function () {

    return view('logout');
});
Route::get('/privacy-policy', function () {
    return view('member.privacy_policy');
});
Route::get('/profile-dashboard', function () {
    return view('member.profil');
});
Route::get('/detail/{slug}', [MainController::class, 'detailProduk']);

Route::get('/login', function () {
    return view('login');
});
Route::get('/login-user', function () {
    return view('login-user');
});
Route::get('/login/verifikasi', function () {
    return view('login-verifikasi');
});
Route::get('/daftar', function () {
    // return view('register-nohp');
    return view('registrasi');
});
Route::get('/daftar/verifikasi', function () {
    return view('daftar-verifikasi');
});
Route::get('/registrasi', function () {
    return view('registrasi');
});
Route::get('/produk', function () {
    return view('member.produk.index');
});

Route::get('/list-produk', function () {
    return view('member.gerai.produk');
});

Route::get('/detail-terapis/{slug}', function () {
    return view('member.terapis.detail');
});

Route::get('/jasa', function () {
    return view('member.terapis.all');
});

Route::get('/griya-sehat', function () {
    return view('member.griya-sehat.all');
});

Route::get('/pelatihan', function () {
    return view('member.pelatihan.all');
});

Route::get('/detail-pelatihan/{slug}', function () {
    return view('member.pelatihan.detail');
});

Route::get('/detail-produk/{slug}', [MainController::class, 'detailProdukGerai']);

Route::get('/checkout', function () {
    return view('member.produk.checkout');
});

Route::get('/sellers', function () {
    return view('member.sellers.index');
});

Route::get('/payment', function () {
    return view('member.produk.payment');
});

Route::get('/keranjang', function () {
    return view('member.keranjang.index');
});

Route::get('/transaksi/jasa', function () {
    return view('member.transaksi.transaksi-jasa');
});
Route::get('/transaksi/produk', function () {
    return view('member.transaksi.transaksi-produk');
});

Route::get('/artikel', function () {
    return view('member.artikel');
});
Route::get('/kontak', function () {
    return view('member.kontak-kami');
});
Route::get('/tambah-alamat-saya', function () {
    return view('member.alamat-saya');
});

Route::get('/edit-alamat-saya/{id}', function ($id) {
    return view('member.alamat-saya-edit', compact('id'));
});

// Referral
Route::get('/aff', function () {
    return view('member.gerai.produk');
});

Route::get('/pay/{no_invoice}', [MainController::class, 'invoice']);
Route::get('/redirect_map', [MainController::class, 'redirectMap']);

Route::get('/affiliate/detail/{slug}', [MainController::class, 'detailProdukReferral']);

Route::get('/rcv-ord/{slug}', [MainController::class, 'selesaiPesanan']);

// Download PDF Katalog
Route::get('/katalog-produk/{gudang_id}', [MainController::class, 'katalogProduk']);