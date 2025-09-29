@extends('layouts.member')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/tabs.css') }}">

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container" style="margin-top: 50px;" data-aos="fade-up">
            <h3 style=" font-weight: bold;">Dashboard Saya</h3>
            <div class="row gy-4">

                <div class="col" data-aos="fade-right">
                    <div class="count-box">
                        <i class="bi bi-bookmarks-fill"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $totalPaket }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Paket Saya</p>
                        </div>
                    </div>
                </div>

                <div class="col" data-aos="fade-left">
                    <div class="count-box"><i class="bi bi-journal-text"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="{{ $riwayatPaket }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Riwayat Paket</p>
                        </div>
                    </div>
                </div>

                {{-- <div class="col">
                    <div class="count-box">
                        <i class="bi bi-headset" style="color: #15be56;"></i>
                        <div>
                            <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Paket Sudah Dibayar</p>
                        </div>
                    </div>
                </div> --}}

            </div>

        </div>
    </section><!-- End Counts Section -->

    <div class="container" data-aos="fade-up">
        <div class="tab-wrap">

            <!-- active tab on page load gets checked attribute -->
            <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
            <label for="tab1">Paket Saya</label>

            <input type="radio" id="tab2" name="tabGroup1" class="tab">
            <label for="tab2">Riwayat Paket</label>

            <div class="tab__content">
                @if ($transaksi == '[]')
                    <center>
                        <div class="" style="margin-bottom: 60px; margin-top: 60px;">
                            <i class="bi bi-folder2-open" style="font-size: 70px;"></i> <br>
                            <h6>Tidak Ada Paket Untuk Anda</h6>
                            <a href="/paket">Beli Paket</a>
                        </div>
                    </center>
                @else
                    @foreach ($transaksi as $item)
                        @if ($item->status == 2)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="">
                                        Nama Paket <br>
                                        <h5><b>{{ $item->paket->nama }}</b></h5>
                                    </div>
                                    <div class="" style="color: gray;">
                                        {!! Str::limit($item->paket->deskripsi, 100) !!}
                                    </div>
                                    <div class="mt-2">
                                        Kode Voucher <br>
                                        <b>{{ $item->voucher }}</b>
                                    </div>
                                    <div style="text-align: right;">
                                        Tanggal Transaksi : {{ date('d-m-Y', strtotime($item->tgl_transaksi)) }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>

            <div class="tab__content">
                <br>
                @if ($transaksi == '[]')
                    <center>
                        <div class="" style="margin-bottom: 60px; margin-top: 60px;">
                            <i class="bi bi-clock-history" style="font-size: 70px;"></i> <br>
                            <h6>Tidak Ada Riwayat Paket</h6>
                        </div>
                    </center>
                @endif
                @foreach ($transaksi as $riwayat)
                    <div class="row" style="border-bottom: 1px solid gray; padding-bottom: 1px;">
                        <div class="col mt-2">
                            Nama Paket <br>
                            <h5><b> {{ $riwayat->paket->nama }}</b></h5>
                        </div>
                        <div class="col">
                            @if ($riwayat->status == 2)
                                <button class="btn btn-success mt-3" style="float: right;" disabled>Sudah Dibeli <i
                                        class="bi bi-check2"></i></button>
                            @elseif ($riwayat->status == 1)
                                <button class="btn btn-primary mt-3" style="float: right;" disabled>Mengecek Pembayaran <i
                                        class="bi bi-file-earmark-break-fill"></i></button>
                            @elseif ($riwayat->status == 3)
                                <button class="btn btn-danger mt-3" style="float: right;" disabled>Ditolak <i
                                        class="bi bi-x-lg"></i></button>
                            @else
                                <button class="btn btn-secondary mt-3" style="float: right;" disabled>Pending</button>
                            @endif
                        </div>
                    </div>
                @endforeach
                <br>
            </div>



        </div>
    </div>

















    {{-- <div class="container" data-aos="fade-left">
        <h5 style="color: #36cc14;"><b>Paket Saya</b></h5>
        <hr>
        <div class="card border-0 bg-white shadow" data-aos="zoom-in" data-aos-delay="100">
            <div class="card-body">
                <div class="">
                    Nama Paket <br>
                    <h5><b> Belajar Basic Laravel </b></h5>
                </div>
                <div class="" style="color: gray;">
                    {!! Str::limit('Laravel buku laravell ini bagus sekali untuk belajar coding dengan baik', 100) !!}
                </div>
                <div class="mt-2">
                    Kode Voucher <br>
                    <b>TW170123EJ</b>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,600,700&display=swap" rel="stylesheet">
    <div class="container">
        <div class="layout">
            <input name="nav" type="radio" class="nav home-radio" id="home" checked="checked" />
            <div class="page home-page mt-4">
                <div class="page-contents">
                    <div class="card border-0 bg-white shadow">
                        <div class="card-body">
                            <div class="">
                                Nama Paket <br>
                                <h5><b> Belajar Basic Laravel </b></h5>
                            </div>
                            <div class="" style="color: gray;">
                                {!! Str::limit('Laravel buku laravell ini bagus sekali untuk belajar coding dengan baik', 100) !!}
                            </div>
                            <div class="mt-2">
                                Kode Voucher <br>
                                <b>TW170123EJ</b>
                            </div>
                            <div style="text-align: right;">
                                Tanggal Transaksi : 23-02-2023
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <label class="nav" for="home">
                <span>
                    Semua Paket
                </span>
            </label>

            <input name="nav" type="radio" class="about-radio" id="about" />
            <div class="page about-page mt-4">
                <div class="page-contents">
                    <div class="card border-0 bg-white shadow">
                        <div class="card-body">
                            <div class="">
                                Nama Paket <br>
                                <h5><b> Belajar Basic Laravel </b></h5>
                            </div>
                            <div class="" style="color: gray;">
                                {!! Str::limit('Laravel buku laravell ini bagus sekali untuk belajar coding dengan baik', 100) !!}
                            </div>
                            <div class="mt-2">
                                Kode Voucher <br>
                                <b>TW170123EJ</b>
                            </div>
                            <div style="text-align: right;">
                                Tanggal Transaksi : 23-02-2023
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <label class="nav" for="about">
                <span>
                    Paket Saya
                </span>
            </label>

            <input name="nav" type="radio" class="contact-radio" id="contact" />
            <div class="page contact-page mt-4">
                <div class="page-contents">
                    <div class="alert alert-info">Menunggu Konfirmasi Dari Admin</div>
                    <div class="card border-0 bg-white shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="">
                                        Nama Paket <br>
                                        <h5><b> Belajar Basic Laravel </b></h5>
                                    </div>
                                    <div class="">
                                        Kode Voucher <br>
                                        <b>TW170123EJ</b>
                                    </div>
                                    <div class="mt-2">
                                        Metode Pembayaran : TUNAI
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="text-align: right;">
                                        Total Harga :
                                    </div>
                                    <h1 style="text-align: right; color: #36cc14;">
                                        Rp. 35.000
                                    </h1>
                                </div>
                            </div>

                            <div style="text-align: right;" class="">
                                Tanggal Transaksi : 23-02-2023
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <label class="nav" for="contact">
                <span>
                    Sudah Dibayar
                </span>

            </label>
            <br><br>
        </div>
    </div> --}}
@endsection
