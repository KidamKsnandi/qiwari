@extends('layouts.member')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/tab-notif.css') }}">

    <br>
    @if ($wishList == '[]')
        <center>
            <br><br><br><br>
            <br>
            <div class="" data-aos="fade-up">
                <i class="bi bi-heart-fill me-1" data-aos="fade-right" style="color: rgb(228, 22, 22); font-size: 70px;"></i>
            </div><br>
            <h2><b> Wishlist </b></h2>
            <div style="width: 400px;">
                Simpan barang-barang yang kamu suka buat dibeli nanti. Yuk, mulai isi Wishlist kamu!
            </div>
            <br>
            <a href="/" class="btn text-white col-sm-2" style="background: rgb(17, 163, 17);">Cari Produk</a>
        </center>
    @else
        <div class="" style="background: whitesmoke;">
            <div class="container" data-aos="fade-up">
                <h3 style="padding-top: 120px; padding-bottom: 30px;" data-aos="fade-right"><b><i
                            class="bi bi-heart-fill me-1" style="color: rgb(15, 160, 15);"></i>
                        Wishlist </b></h3>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                @foreach ($wishList as $item)
                    <div class="col-lg-3 col-6">
                        <a href="{{ route('paket.detail', $item->produk->slug) }}">
                            <div class="card border-0 bg-dark" data-aos="fade-in"
                                style="box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.119);">
                                <img src="{{ $item->produk->gambar() }}"
                                    style="height: 180px; width: 100%; object-fit: cover;" data-aos="zoom-out"
                                    class="card-img-top border-0" alt="...">
                                <div class="card-body border-0" data-aos="zoom-in">
                                    <div class="card-title text-dark" style="font-size: 15px; font-family: sans-serif">
                                        <span>
                                            {{ Str::limit($item->produk->nama, 40) }} </span>
                                    </div>
                                    <div class="text-bold mb-1 text-dark" style="color: black font-size: 17px;"><b>
                                            Rp.
                                            {{ number_format($item->produk->harga, 0, '', '.') }} </b></div>
                                    <div class="card-text row mt-3" style="font-size: 13px;">
                                        <div class="col-8">
                                            <a href="{{ route('paket.detail', $item->produk->slug) }}"
                                                class="btn text-white" style="background: rgb(15, 194, 15);">Beli
                                                Sekarang</a>
                                        </div>
                                        <div class="col">
                                            <form action="/member/wishlist/delete/{{ $item->id }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger float-end"><i
                                                        class="bi bi-trash"
                                                        onclick="return confirm('Apakah anda yakin menghapus')"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Hapus"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
