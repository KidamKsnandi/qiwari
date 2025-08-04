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

Route::get('/sso-login', function () {
    return view('ssoLogin');
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
Route::get('/daftar', function () {
    return view('daftar');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/produk', function () {
    return view('member.produk.index');
});

Route::get('/list-produk', function () {
    return view('member.gerai.produk');
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

Route::get('/list-transaksi', function () {
    return view('member.transaksi.list');
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

// Pre Order
Route::get('/member/pre-order/produk', [MainController::class, 'preOrder']);
Route::get('/member/pre-order/produk/ubah', [MainController::class, 'preOrderUbah']);
Route::get('/member/pre-order/member-card', [MainController::class, 'preOrderMemberCard']);
