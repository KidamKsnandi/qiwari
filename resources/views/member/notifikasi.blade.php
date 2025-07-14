@extends('layouts.member')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/tab-notif.css') }}">

    <br><br><br><br>
    <div class="container" data-aos="fade-up">
        {{-- <h3 class="mt-3" data-aos="fade-right"><b> Notifikasi </b></h3> --}}
        <div class="tab-wrap">

            <!-- active tab on page load gets checked attribute -->
            <input type="radio" id="tab1" name="tabGroup1" class="tab" checked>
            <label for="tab1"><i class="bi bi-receipt me-2"></i> Transaksi</label>

            <input type="radio" id="tab2" name="tabGroup1" class="tab">
            <label for="tab2"><i class="bi bi-bell me-2"></i> Update</label>

            <div class="tab__content">
                <div class="row mt-3">
                    <div class="col-lg-3 col-6 mb-2">
                        <a href="" class="btn w-100 btn-hover" style="border: 1.7px solid rgb(26, 157, 26);">
                            <img src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/zeus/kratos/5e972574.svg"
                                style="width: 40px;" class="me-2" alt="">
                            Menunggu
                            Konfirmasi</a>
                    </div>
                    <div class="col-lg-3 col-6 mb-2">
                        <a href="" class="btn w-100 btn-hover" style="border: 1.7px solid rgb(26, 157, 26);">
                            <img src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/zeus/kratos/7764102f.svg"
                                style="width: 40px;" class="me-2" alt="">
                            Pesanan
                            Diproses</a>
                    </div>
                    <div class="col-lg-3 col-6 mb-2">
                        <a href="" class="btn w-100 btn-hover" style="border: 1.7px solid rgb(26, 157, 26);">
                            <img src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/zeus/kratos/a39f2a72.svg"
                                style="width: 40px;" class="me-2" alt="">
                            Sedang Dikirim</a>
                    </div>
                    <div class="col-lg-3 col-6 mb-2">
                        <a href="" class="btn w-100 btn-hover" style="border: 1.7px solid rgb(26, 157, 26);">
                            <img src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/zeus/kratos/b590a65c.svg"
                                style="width: 40px;" class="me-2" alt="">
                            Sampai Tujuan</a>
                    </div>
                </div>
            </div>

            <div class="tab__content">

            </div>



        </div>
    </div>
@endsection
