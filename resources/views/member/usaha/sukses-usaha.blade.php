@extends('layouts.member')

@section('content')
    <br><br><br>
    <div class="container mt-5">
        <center>
            <img src="{{ asset('images/sukses-usaha.png') }}" width="300px" data-aos="fade-left" alt="">
            <h3 class="" data-aos="fade-up"><b><i class="bi bi-check"
                        style="color: rgb(39, 179, 39); font-size: 30px;"></i> Anda
                    telah
                    memiliki Usaha/Toko baru! </b></h3>
            <div class="text-secondary" data-aos="fade-in">Anda siap untuk berjualan?</div>
            <a href="/" class="btn text-white mt-4 col-2" style="background: rgb(33, 195, 22);" data-aos="fade-up">Ya,
                Saya
                siap!</a>
        </center>
    </div>
@endsection
