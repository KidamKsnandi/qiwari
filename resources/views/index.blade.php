@extends('layouts.member')

@section('css')
    <style>
        .category-container {
            padding: 15px;
            width: 100%;
            overflow-x: auto;
        }

        .category-container::-webkit-scrollbar {
            display: none;
        }

        .category-logos {
            display: inline-flex;
        }

        .category {
            margin-right: 15px;
            margin-left: 15px;
        }

        @keyframes pulse {
        0% { background-color: #e0e0e0; }
        50% { background-color: #f0f0f0; }
        100% { background-color: #e0e0e0; }
        }

    </style>
@endsection


@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- ======= Hero Section ======= -->
    {{-- <section id="hero" class="hero d-flex align-items-center">

        <div class="container">
            <div class="row" style="margin-top: 90px;">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Solusi bisnis diera digital khusus untuk anda</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">Bergabung bersama keluarga besar kami dan raih keuntungan yang
                        tak terhingga.</h2>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="/daftar"
                                class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Daftar Affiliate</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('assets/frontend/assets/img/hero-img.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section> --}}
    <!-- End Hero -->


    <section style="padding-bottom: 5px" id="portfolio-details" class="portfolio-details">
        {{-- <div class="container"> --}}
        <div class="portfolio-details-slider swiper">
            <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                    <img src="{{ asset('assets/frontend/assets/img/slide1.png') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/frontend/assets/img/slide2.png') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/frontend/assets/img/slide3.png') }}" alt="">
                </div>

                <div class="swiper-slide">
                    <img src="{{ asset('assets/frontend/assets/img/slide4.png') }}" alt="">
                </div>
                
                <div class="swiper-slide">
                    <img src="{{ asset('assets/frontend/assets/img/slide5.png') }}" alt="">
                </div>

            </div>
            {{-- <div class="swiper-pagination"></div> --}}
        </div>
    </section>

    {{-- <div class="container mb-4">
        <div class="card ">
            <div class="card-header bg-white">
                <a href="" style="" class="text-black " data-bs-toggle="modal" data-bs-target="#pilihGerai">
                    <div class="d-flex justify-content-between ">
                        <div class="">
                            <b id="namaGerai">Semua Gerai</b>
                        </div>
                        <div class="" style="font-size: 14px; color: grey; text-align: right" id="keteranganKurir">
                            Pilih Gerai</div>
                    </div>
                </a>
            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
        </svg>

        <div class="alert alert-info alert-dismissible d-flex align-items-center fade show mt-2" role="alert"
            style="font-size: 12px">
            <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Info:">
                <use xlink:href="#info-fill" />
            </svg>
            <span>
                Selamat Datang di Matrial
            </span>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div> --}}

    <div class="modal fade" id="pilihGerai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Gerai
                    </h5>
                    <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="listGerai">

                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $data = [
            (object) [
                'id' => 4,
                'kategori' => 'Makanan',
            ],
            (object) [
                'id' => 5,
                'kategori' => 'Minuman',
            ],
            (object) [
                'id' => 6,
                'kategori' => 'Fashion',
            ],
            (object) [
                'id' => 7,
                'kategori' => 'Rumah Tangga',
            ],
            (object) [
                'id' => 9,
                'kategori' => 'Jasa',
            ],
            (object) [
                'id' => 10,
                'kategori' => 'Kesehatan',
            ],
            (object) [
                'id' => 11,
                'kategori' => 'Donasi',
            ],
            (object) [
                'id' => 12,
                'kategori' => 'Affiliate',
            ],
            (object) [
                'id' => 15,
                'kategori' => 'Hewan Qurban',
            ],
            (object) [
                'id' => 16,
                'kategori' => 'Terapi',
            ],
        ];

        $dataQurban = (object) [
            'id' => 92,
            'nama_teritori' => 'Soekarno Hatta',
            'kota_kab' => 'KOTA BANDUNG',
            'provinsi' => 'JAWA BARAT',
            'nama_cabang' => 'Stasiun Qurban',
            'wa' => null,
            'status' => 'cabang',
            'sellerid' => 'MYB-01May2024-92',
            'card' => null,
            'ig' => null,
            'anggota' => [],
        ];

        $dataTerapi = (object) [
            'id' => 102,
            'nama_teritori' => 'Cimahi',
            'kota_kab' => 'Kota Cimahi"',
            'provinsi' => 'Jawa Barat',
            'nama_cabang' => 'Budi Terapis',
            'wa' => null,
            'status' => 'cabang',
            'sellerid' => 'MYB--28Jun2024-102',
            'card' => null,
            'ig' => null,
            'anggota' => [],
        ];
    @endphp
    <center style="">
        <div class="container">
            <div class="category-container">
                <div class="category-logos">
                    <a href="/jasa" class="category" style="cursor: pointer">
                        <div class="card" style="border-radius: 100%;">
                            <center>
                                <img class="image-category p-3"
                                    style="width: 80px; height: 80px;" src=" {{ asset('images/icon/jasa.png') }} " alt="logo" /> 
                            </center>
                        </div>
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Jasa</span>
                    </a>
                    <a href="/jasa" class="category" style="cursor: pointer">
                        <div class="card" style="border-radius: 100%;">
                            <center>
                                <img
                                    class="image-category p-3" style="width: 80px; height: 80px;" src=" {{ asset('images/icon/toko-matrial.png') }} " alt="logo" /> 
                            </center>
                        </div>
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Toko</span>
                    </a>
                    <a href="/list-produk" class="category" style="cursor: pointer">
                        <div class="card" style="border-radius: 100%;">
                            <center>
                                <img
                                    class="image-category p-3" style="width: 80px; height: 80px;" src=" {{ asset('images/icon/produk.png') }} " alt="logo" /> 
                            </center>
                        </div>
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Produk</span>
                    </a>
                </div>
            </div>
        </div>
    </center>
    <br>
    {{-- <div class="container">
        <div class="card" style="background: #35a949">
            <div class="row justify-content-between mt-2 me-2 ms-2 text-white">
                <div class="col">
                    <h2>Promo</h2>
                </div>
                <div class="col-auto">
                    <a class="text-white">Lihat Semua</a>
                </div>
            </div>
            <div class="row mt-2 me-2 ms-2">
                <div class="col-md-2">
                    <div class="card mb-4 bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Voucher</h5>
                            <hr>
                            <p class="card-text">Diskon 10%</p>
                            <div class="card">
                                <p class="card-text text-dark text-center">ABC123</p>
                            </div>
                            <center>
                                <button class="btn btn-primary mt-1" onclick="copyPromoCode('ABC123')">Salin</button>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card mb-4 bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Voucher</h5>
                            <hr>
                            <p class="card-text">Cashback 10%</p>
                            <div class="card">
                                <p class="card-text text-dark text-center">DEF456</p>
                            </div>
                            <center>
                                <button class="btn btn-primary mt-1" onclick="copyPromoCode('DEF456')">Salin</button>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card mb-4 bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Voucher</h5>
                            <hr>
                            <p class="card-text">Diskon 20%</p>
                            <div class="card">
                                <p class="card-text text-dark text-center">GHI890</p>
                            </div>
                            <center>
                                <button class="btn btn-primary mt-1" onclick="copyPromoCode('GHI890')">Salin</button>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card mb-4 bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Voucher</h5>
                            <hr>
                            <p class="card-text">Diskon 70%</p>
                            <div class="card">
                                <p class="card-text text-dark text-center">KLM910</p>
                            </div>
                            <center>
                                <button class="btn btn-primary mt-1" onclick="copyPromoCode('KLM910')">Salin</button>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card mb-4 bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Voucher</h5>
                            <hr>
                            <p class="card-text">Cashback 15%</p>
                            <div class="card">
                                <p class="card-text text-dark text-center">MNO710</p>
                            </div>
                            <center>
                                <button class="btn btn-primary mt-1" onclick="copyPromoCode('MNO710')">Salin</button>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card mb-4 bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Voucher</h5>
                            <hr>
                            <p class="card-text">Cashback 40%</p>
                            <div class="card">
                                <p class="card-text text-dark text-center">PQR654</p>
                            </div>
                            <center>
                                <button class="btn btn-primary mt-1" onclick="copyPromoCode('PQR654')">Salin</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <main id="main" class="" style="background: whitesmoke; border-top: 1px solid rgb(237, 237, 237);">

        <div class="container " style="" data-aos="fade-up">
            <div class="row justify-content-between mt-3">
                <div class="col">
                    <h3 class=""><b>
                            Untuk Kamu
                        </b></h3>
                </div>
                <div class="col-auto">
                    <a href="/list-produk" class="btn btn-primary btn-sm">Lihat Semua</a>
                </div>
            </div>

            @include('components.rekomendasi-produk')

        </div>
        <div class="container" style="" data-aos="fade-up">
            <h3 style="border-bottom: 2px solid rgba(213, 213, 213, 0.541); padding-bottom: 10px;" class=""><b>
                    List Semua Produk
                </b></h3>
            @include('components.semuaProduk')
            <center>
                <a href="/list-produk" class="mt-auto btn btn-primary">Lihat
                    Semua</a>
            </center>
        </div>
        <br><br>
        {{-- <div class="container" style="" data-aos="fade-up">
            <h5 style="border-bottom: 2px solid rgba(128, 128, 128, 0.541); padding-bottom: 10px;" ><b>
                    List Semua Produk
                </b></h5>
            @include('components.semuaProduk')
            <center>
                <a href="/list-produk" class="mt-auto btn btn-primary"
                    style="border-radius: 50px; background: #4294e3;
            background: linear-gradient(47deg, #cea249 0%, #35a949 68%)  ;">Lihat
                    Semua</a>
            </center>
        </div> --}}
        {{-- <br><br> --}}

        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast toast-successs border-0" style="padding: 5px;" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="toast-header text-success">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <strong class="me-auto">Sukses</strong>
                    <a href="" data-bs-dismiss="toast" aria-label="Close"><i
                            class="bi bi-x-lg text-dark"></i></a>
                </div>
                <div class="toast-body">
                    <h6>Anda berhasil memasukkan ke keranjang</h6>
                    <a href="/keranjang" class="btn text-dark"
                        style="background: rgb(224, 224, 224); font-size: 14px;">Cek
                        Keranjang</a>
                </div>
            </div>
        </div>

        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast toast-success border-0" style="padding: 5px;" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="toast-header text-success">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <strong class="me-auto">Sukses</strong>
                    <a href="" data-bs-dismiss="toast" aria-label="Close"><i
                            class="bi bi-x-lg text-dark"></i></a>
                </div>
                <div class="toast-body">
                    <h6>Anda berhasil memasukkan ke keranjang</h6>
                    <a href="/keranjang" class="btn text-dark"
                        style="background: rgb(224, 224, 224); font-size: 14px;">Cek
                        Keranjang</a>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalLinks" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel"><b class="text-center">Belanja
                                rame-rame pasti lebih seru!</b></h1>
                    </div><br>
                    <center>
                        <div class="alert alert-primary" style="width: 90%" role="alert">
                            <span id="linkAffiliates"></span>
                            <input type="hidden" name="copyTexts" id="copyTexts">
                        </div>
                    </center>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <center>
                                            <span id="linkWhatsapps">
                                                {{-- <a href="" style="cursor: pointer">
                                                <i style="font-size: 40px;color: green" class="bi bi-whatsapp"></i>
                                                <p class="text-center">Whatsapp</p>
                                            </a> --}}
                                            </span>
                                        </center>
                                    </div>

                                    <div class="col"><br>
                                        <center>
                                            <span id="linkSalins">
                                                {{-- <a onclick="salinLink()" style="cursor: pointer">
                                                <i style="font-size: 40px;color: blue" class="fas fa-copy"></i>
                                                <p class="text-center">Salin Link</p>
                                            </a> --}}
                                            </span>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalLink" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel"><b class="text-center">Belanja
                                rame-rame pasti lebih seru!</b></h1>
                    </div><br>
                    <center>
                        <div class="alert alert-primary" style="width: 90%" role="alert">
                            <span id="linkAffiliate"></span>
                            <input type="hidden" name="copyText" id="copyText">
                        </div>
                    </center>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <center>
                                            <span id="linkWhatsapp">
                                                {{-- <a href="" style="cursor: pointer">
                                                <i style="font-size: 40px;color: green" class="bi bi-whatsapp"></i>
                                                <p class="text-center">Whatsapp</p>
                                            </a> --}}
                                            </span>
                                        </center>
                                    </div>

                                    <div class="col"><br>
                                        <center>
                                            <span id="linkSalin">
                                                {{-- <a onclick="salinLink()" style="cursor: pointer">
                                                <i style="font-size: 40px;color: blue" class="fas fa-copy"></i>
                                                <p class="text-center">Salin Link</p>
                                            </a> --}}
                                            </span>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    <script>
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
        var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
        console.log('API_URL', API_URL);
        console.log(API_SECRET);
        function formatformatRupiah(angka) {
            let newAngka = new Intl.NumberFormat('id-ID').format(angka);
            return newAngka;
        }

        function copyPromoCode(promoCode) {
            navigator.clipboard.writeText(promoCode).then(function() {
                alert("Kode promo berhasil disalin!");
            }, function() {
                alert("Maaf, terjadi kesalahan saat menyalin kode promo.");
            });
        }

        function filter(data, id) {
            if (data == 0) {
                alert("Coming Soon")
            } else {
                localStorage.setItem('kategori_id', id)
                localStorage.setItem('kategori', JSON.stringify(data))
                window.location.href = "/list-produk"
            }
        }

        function filterQurban(dataQurban, data, id) {
            localStorage.setItem('kategori_id', id)
            localStorage.setItem('kategori', JSON.stringify(data))
            localStorage.setItem('gerai_id', dataQurban.id)
            localStorage.setItem('gerai', JSON.stringify(dataQurban))
            window.location.href = "/list-produk"

        }

        function filterTerapi(dataTerapi, data, id) {
            localStorage.removeItem('kategori_id')
            localStorage.removeItem('kategori')
            localStorage.setItem('gerai_id', dataTerapi.id)
            localStorage.setItem('gerai', JSON.stringify(dataTerapi))
            window.location.href = "/list-produk"

        }

        function openKatalog() {
            window.location.href = `/katalog-produk/83`;

        }

        function openPreOrder() {
            if (user == undefined) {
                window.location.href = `/login?type=whatsapp`;
            } else {
                window.location.href = `/member/pre-order/member-card`;
            }

        }

        geraiNow = JSON.parse(localStorage.getItem('gerai'));
        if (geraiNow) {
            $('#namaGerai').html(geraiNow.nama_cabang)
        }
        getGerai()
        gerai_id = localStorage.getItem('gerai_id')

        function getGerai() {
            axios.get(`${API_URL}/affiliator/cabang`, {
                    headers: {
                        'secret': API_SECRET,
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    let dataCabang = response.data.data
                    $('#listGerai').html("");
                    if (dataCabang[0] != null) {
                        if (gerai_id == null) {
                            $('#listGerai').html(`
                                <div class="card  mb-3"
                                    style="background: rgba(26, 216, 26, 0.127); border: 1px solid rgb(27, 170, 27);">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h5> <span class="text-bold"
                                                    style="color: gray;">Semua Gerai</span> </h5>
                                            <i class="bi bi-check text-success" style="font-size: 40px; "></i>
                                        </div>

                                    </div>
                                </div>
                                `);
                        } else {
                            $('#listGerai').html(`
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5> <span class="text-bold"
                                                        style="color: gray;">Semua Gerai</span> </h5>
                                                <button type="button" onclick='pilihGerai("semua")' class="btn  mt-2 float-end"
                                                    style="background: rgb(22, 179, 22); color: white;">Pilih</button>
                                            </div>
                                        </div>
                                    </div>
                                `)
                        }
                        $.each(dataCabang, function(key, value) {
                            if (value.id == gerai_id) {
                                $('#listGerai').append(`
                                <div class="card  mb-3"
                                    style="background: rgba(26, 216, 26, 0.127); border: 1px solid rgb(27, 170, 27);">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="col-10">
                                                <span class="text-bold"
                                                    style="color: gray;">${value.nama_cabang}</span>
                                                <h5>
                                                    ${value.nama_teritori} - ${value.kota_kab}
                                                </h5>
                                            </div>
                                            <i class="bi bi-check text-success" style="font-size: 40px; "></i>
                                        </div>
                                    </div>
                                </div>
                                `)

                            } else {
                                $('#listGerai').append(`
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <span class="text-bold"
                                                        style="color: gray;">${value.nama_cabang}</span>
                                                    <h5>
                                                        ${value.nama_teritori} - ${value.kota_kab}
                                                    </h5>
                                                </div>
                                                <button type="button" onclick='pilihGerai(${JSON.stringify(value)})' class="btn  mt-2 float-end"
                                                            style="background: rgb(22, 179, 22); color: white;">Pilih</button>
                                            </div>
                                        </div>
                                    </div>
                                `)
                            }
                        })
                    } else {
                        $('#dataCabang').html(`
                        <center>
                            <br><br>
                            <img src="{{ asset('images/empty.png') }}" style="width: 250px;" alt=""><br>
                            <h4 class="text--primary"><b> Tidak Ditemukan</b></h4>
                            <h6>Mohon maaf Cabang tidak ditemukan</h6>
                            <br><br>
                        </center>
                        `)
                    }
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        }

        function pilihGerai(value) {
            if (value == "semua") {
                localStorage.removeItem('gerai_id')
                localStorage.removeItem('gerai')
                localStorage.removeItem('kategori_id')
                localStorage.removeItem('kategori')
                window.location.href = "/list-produk"
            } else {
                localStorage.setItem('gerai_id', value.id)
                localStorage.setItem('gerai', JSON.stringify(value))
                window.location.href = "/list-produk"
            }
        }
    </script>
@endsection
