@extends('layouts.member')



@section('content')
    <br><br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <div class="card border-0 bg-white shadow rounded mb-4" style="background: white;" data-aos="fade-right">
                    <livewire:buat-usaha />
                </div>
            </div>
        </div>
        <div class="col">
            <center>
                <img src="{{ asset('images/buat-usaha.png') }}" width="270px" data-aos="fade-down" alt=""><br><br>
                <h3 data-aos="fade-left"><b> Nama toko yang unik, selalu terlihat menarik </b></h3>
                <div data-aos="fade-up">
                    Gunakan nama yang singkat dan sederhana agar tokomu mudah dingat pembeli.
                </div>
            </center>
        </div>
    </div>
    </div>
@endsection
