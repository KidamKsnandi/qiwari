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
            margin-right: 30px;
        }

        .image-category {
            height: 40px;
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

            </div>
            {{-- <div class="swiper-pagination"></div> --}}
        </div>
    </section>

    <div class="container mb-4">
        {{-- <div class="card ">
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
        </div> --}}

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

        <div class="alert alert-info alert-dismissible d-flex align-items-center fade show mt-4" role="alert"
            style="font-size: 12px">
            <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Info:">
                <use xlink:href="#info-fill" />
            </svg>
            <span>
                Selamat datang dan selamat berbelanja di Qiwari
            </span>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <div class="modal fade" id="pilihGerai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content ">
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
    <center style=" background: whitesmoke;">
        <div class="container">
            <div class="category-container">
                <div class="category-logos">
                    <a class="category" style="cursor: pointer" onclick="filter(0)"><img class="image-category"
                            src=" {{ asset('images/lainnya.png') }} " alt="logo" /> <br />
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Lainnya</span>
                    </a>
                    <a id="katalogView" class="category" style="cursor: pointer" onclick="openPreOrder()"><img
                            class="image-category" src=" {{ asset('images/pre-order.png') }} " alt="logo" /> <br />
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Pre-Order</span>
                    </a>
                    <a id="katalogView" class="category" style="cursor: pointer" onclick="openKatalog()"><img
                            class="image-category" src=" {{ asset('images/katalog.png') }} " alt="logo" /> <br />
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Katalog</span>
                    </a>
                    <a class="category" style="cursor: pointer"
                        onclick="filter({{ json_encode($data[0]) }}, {{ $data[0]->id }})"><img class="image-category"
                            src=" {{ asset('images/makanan.png') }} " alt="logo" /> <br />
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Makanan</span>
                    </a>
                    <a class="category" style="cursor: pointer"
                        onclick="filter({{ json_encode($data[1]) }}, {{ $data[1]->id }})"><img class="image-category"
                            src=" {{ asset('images/minuman.png') }} " alt="logo" /> <br />
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Minuman</span>
                    </a>
                    <a class="category" style="cursor: pointer"
                        onclick="filter({{ json_encode($data[2]) }}, {{ $data[2]->id }})"><img class="image-category"
                            src=" {{ asset('images/fashion.png') }} " alt="logo" /> <br />
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Fashion</span>
                    </a>
                    <a class="category" style="cursor: pointer"
                        onclick="filter({{ json_encode($data[3]) }}, {{ $data[3]->id }})"><img class="image-category"
                            src=" {{ asset('images/home.png') }} " alt="logo" /> <br />
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Rumah Tangga</span>
                    </a>
                    <a class="category" style="cursor: pointer"
                        onclick="filter({{ json_encode($data[4]) }}, {{ $data[4]->id }})"><img class="image-category"
                            src=" {{ asset('images/jasa.png') }} " alt="logo" /> <br />
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Jasa</span>
                    </a>
                    <a class="category" style="cursor: pointer"
                        onclick="filter({{ json_encode($data[5]) }}, {{ $data[5]->id }})"><img class="image-category"
                            src=" {{ asset('images/kesehatan.png') }} " alt="logo" /> <br />
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Kesehatan</span>
                    </a>
                    <a class="category" style="cursor: pointer"
                        onclick="filter({{ json_encode($data[6]) }}, {{ $data[6]->id }})"><img class="image-category"
                            src=" {{ asset('images/donasi.png') }} " alt="logo" /> <br />
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Donasi</span>
                    </a>
                    <a class="category" style="cursor: pointer"
                        onclick="filter({{ json_encode($data[7]) }}, {{ $data[7]->id }})"><img class="image-category"
                            src=" {{ asset('images/affiliate.png') }} " alt="logo" /> <br />
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Affiliate</span>
                    </a>
                    <a class="category" style="cursor: pointer" onclick="filter(0)"><img class="image-category"
                            src=" {{ asset('images/tagihan.png') }} " alt="logo" /> <br />
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Tagihan </span>
                    </a>
                    <a class="category" style="cursor: pointer" onclick="filter(0)"><img class="image-category"
                            src=" {{ asset('images/topup.png') }} " alt="logo" /> <br />
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Top-Up</span>
                    </a>
                    <a class="category" style="cursor: pointer" onclick="filter(0)"><img class="image-category"
                            src=" {{ asset('images/promo.png') }} " alt="logo" /> <br />
                        <span style="text-decoration: none; font-size: 13px; color: rgb(99, 98, 98)">Promo</span>
                    </a>

                </div>
            </div>
        </div>
    </center>
    <br>
    {{-- <div class="container">
        <div class="card" style="background: #23ca23">
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
    <main id="main">

        <div class="container " style="" data-aos="fade-up">
            <div class="row justify-content-between ">
                <div class="col">
                    <h5 data-aos="fade-in"><b>
                            Untuk Kamu
                        </b></h5>
                </div>
                <div class="col-auto">
                    <a href="/list-produk" class="btn btn-outline-primary btn-sm">Lihat Semua ></a>
                </div>
            </div>
            <div style="border-bottom: 2px solid rgba(128, 128, 128, 0.541); padding-bottom: 10px;"></div>

            @include('components.rekomendasi-produk')

        </div>
        <div class="container" style="" data-aos="fade-up">
            <h5 style="border-bottom: 2px solid rgba(128, 128, 128, 0.541); padding-bottom: 10px;" data-aos="fade-in"><b>
                    List Semua Produk
                </b></h5>
            @include('components.semuaProduk')
            <center>
                <a href="/list-produk" class="mt-auto btn btn-primary"
                    style="border-radius: 50px; background: #4294e3;
            background: linear-gradient(47deg, rgb(126, 213, 149) 0%, #23ca23 68%)  ;">Lihat
                    Semua</a>
            </center>
        </div>
        <br><br>

        <!-- ======= Pricing Section ======= -->
        {{-- <section id="pricing" class="pricing">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Pricing</h2>
                    <p>Check our Pricing</p>
                </header>

                <div class="row gy-4" data-aos="fade-left">

                    <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="box">
                            <h3 style="color: #07d5c0;">Free Plan</h3>
                            <div class="price"><sup>$</sup>0<span> / mo</span></div>
                            <img src="{{ asset('assets/frontend/assets/img/pricing-free.png') }}" class="img-fluid"
                                alt="">
                            <ul>
                                <li>Aida dere</li>
                                <li>Nec feugiat nisl</li>
                                <li>Nulla at volutpat dola</li>
                                <li class="na">Pharetra massa</li>
                                <li class="na">Massa ultricies mi</li>
                            </ul>
                            <a href="#" class="btn-buy">Buy Now</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="box">
                            <span class="featured">Featured</span>
                            <h3 style="color: #65c600;">Starter Plan</h3>
                            <div class="price"><sup>$</sup>19<span> / mo</span></div>
                            <img src="{{ asset('assets/frontend/assets/img/pricing-starter.png') }}" class="img-fluid"
                                alt="">
                            <ul>
                                <li>Aida dere</li>
                                <li>Nec feugiat nisl</li>
                                <li>Nulla at volutpat dola</li>
                                <li>Pharetra massa</li>
                                <li class="na">Massa ultricies mi</li>
                            </ul>
                            <a href="#" class="btn-buy">Buy Now</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="box">
                            <h3 style="color: #ff901c;">Business Plan</h3>
                            <div class="price"><sup>$</sup>29<span> / mo</span></div>
                            <img src="{{ asset('assets/frontend/assets/img/pricing-business.png') }}" class="img-fluid"
                                alt="">
                            <ul>
                                <li>Aida dere</li>
                                <li>Nec feugiat nisl</li>
                                <li>Nulla at volutpat dola</li>
                                <li>Pharetra massa</li>
                                <li>Massa ultricies mi</li>
                            </ul>
                            <a href="#" class="btn-buy">Buy Now</a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="box">
                            <h3 style="color: #ff0071;">Ultimate Plan</h3>
                            <div class="price"><sup>$</sup>49<span> / mo</span></div>
                            <img src="{{ asset('assets/frontend/assets/img/pricing-ultimate.png') }}" class="img-fluid"
                                alt="">
                            <ul>
                                <li>Aida dere</li>
                                <li>Nec feugiat nisl</li>
                                <li>Nulla at volutpat dola</li>
                                <li>Pharetra massa</li>
                                <li>Massa ultricies mi</li>
                            </ul>
                            <a href="#" class="btn-buy">Buy Now</a>
                        </div>
                    </div>

                </div>

            </div>

        </section> --}}
        <!-- End Pricing Section -->

        <!-- ======= F.A.Q Section ======= -->
        <!-- End F.A.Q Section -->

        {{-- <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Portfolio</h2>
                    <p>Check our latest work</p>
                </header>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-app">App</li>
                            <li data-filter=".filter-card">Card</li>
                            <li data-filter=".filter-web">Web</li>
                        </ul>
                    </div>
                </div>

                <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('assets/frontend/assets/img/portfolio/portfolio-1.jpg') }}"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>App 1</h4>
                                <p>App</p>
                                <div class="portfolio-links">
                                    <a href="assets/img/portfolio/portfolio-1.jpg') }}" data-gallery="portfolioGallery"
                                        class="portfokio-lightbox" title="App 1"><i class="bi bi-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('assets/frontend/assets/img/portfolio/portfolio-2.jpg') }}"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Web 3</h4>
                                <p>Web</p>
                                <div class="portfolio-links">
                                    <a href="assets/img/portfolio/portfolio-2.jpg') }}" data-gallery="portfolioGallery"
                                        class="portfokio-lightbox" title="Web 3"><i class="bi bi-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('assets/frontend/assets/img/portfolio/portfolio-3.jpg') }}"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>App 2</h4>
                                <p>App</p>
                                <div class="portfolio-links">
                                    <a href="assets/img/portfolio/portfolio-3.jpg') }}" data-gallery="portfolioGallery"
                                        class="portfokio-lightbox" title="App 2"><i class="bi bi-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('assets/frontend/assets/img/portfolio/portfolio-4.jpg') }}"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Card 2</h4>
                                <p>Card</p>
                                <div class="portfolio-links">
                                    <a href="assets/img/portfolio/portfolio-4.jpg') }}" data-gallery="portfolioGallery"
                                        class="portfokio-lightbox" title="Card 2"><i class="bi bi-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('assets/frontend/assets/img/portfolio/portfolio-5.jpg') }}"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Web 2</h4>
                                <p>Web</p>
                                <div class="portfolio-links">
                                    <a href="assets/img/portfolio/portfolio-5.jpg') }}" data-gallery="portfolioGallery"
                                        class="portfokio-lightbox" title="Web 2"><i class="bi bi-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('assets/frontend/assets/img/portfolio/portfolio-6.jpg') }}"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>App 3</h4>
                                <p>App</p>
                                <div class="portfolio-links">
                                    <a href="assets/img/portfolio/portfolio-6.jpg') }}" data-gallery="portfolioGallery"
                                        class="portfokio-lightbox" title="App 3"><i class="bi bi-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('assets/frontend/assets/img/portfolio/portfolio-7.jpg') }}"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Card 1</h4>
                                <p>Card</p>
                                <div class="portfolio-links">
                                    <a href="assets/img/portfolio/portfolio-7.jpg') }}" data-gallery="portfolioGallery"
                                        class="portfokio-lightbox" title="Card 1"><i class="bi bi-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('assets/frontend/assets/img/portfolio/portfolio-8.jpg') }}"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Card 3</h4>
                                <p>Card</p>
                                <div class="portfolio-links">
                                    <a href="assets/img/portfolio/portfolio-8.jpg') }}" data-gallery="portfolioGallery"
                                        class="portfokio-lightbox" title="Card 3"><i class="bi bi-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('assets/frontend/assets/img/portfolio/portfolio-9.jpg') }}"
                                class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Web 3</h4>
                                <p>Web</p>
                                <div class="portfolio-links">
                                    <a href="assets/img/portfolio/portfolio-9.jpg') }}" data-gallery="portfolioGallery"
                                        class="portfokio-lightbox" title="Web 3"><i class="bi bi-plus"></i></a>
                                    <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End Portfolio Section -->

        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Testimonials</h2>
                    <p>What they are saying about us</p>
                </header>

                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit
                                    rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam,
                                    risus at semper.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="{{ asset('assets/frontend/assets/img/testimonials/testimonials-1.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Saul Goodman</h3>
                                    <h4>Ceo &amp; Founder</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid
                                    cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet
                                    legam anim culpa.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="{{ asset('assets/frontend/assets/img/testimonials/testimonials-2.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Sara Wilsson</h3>
                                    <h4>Designer</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam
                                    duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="{{ asset('assets/frontend/assets/img/testimonials/testimonials-3.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Jena Karlis</h3>
                                    <h4>Store Owner</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat
                                    minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore
                                    labore illum veniam.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="{{ asset('assets/frontend/assets/img/testimonials/testimonials-4.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>Matt Brandon</h3>
                                    <h4>Freelancer</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                        class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster
                                    veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam
                                    culpa fore nisi cillum quid.
                                </p>
                                <div class="profile mt-auto">
                                    <img src="{{ asset('assets/frontend/assets/img/testimonials/testimonials-5.jpg') }}"
                                        class="testimonial-img" alt="">
                                    <h3>John Larson</h3>
                                    <h4>Entrepreneur</h4>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- End Testimonials Section -->

        <!-- ======= Team Section ======= -->
        <section id="team" class="team">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Team</h2>
                    <p>Our hard working team</p>
                </header>

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/frontend/assets/img/team/team-1.jpg') }}" class="img-fluid"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Walter White</h4>
                                <span>Chief Executive Officer</span>
                                <p>Velit aut quia fugit et et. Dolorum ea voluptate vel tempore tenetur ipsa quae aut. Ipsum
                                    exercitationem iure minima enim corporis et voluptate.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/frontend/assets/img/team/team-2.jpg') }}" class="img-fluid"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Sarah Jhonson</h4>
                                <span>Product Manager</span>
                                <p>Quo esse repellendus quia id. Est eum et accusantium pariatur fugit nihil minima suscipit
                                    corporis. Voluptate sed quas reiciendis animi neque sapiente.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/frontend/assets/img/team/team-3.jpg') }}" class="img-fluid"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>William Anderson</h4>
                                <span>CTO</span>
                                <p>Vero omnis enim consequatur. Voluptas consectetur unde qui molestiae deserunt. Voluptates
                                    enim aut architecto porro aspernatur molestiae modi.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('assets/frontend/assets/img/team/team-4.jpg') }}" class="img-fluid"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Amanda Jepson</h4>
                                <span>Accountant</span>
                                <p>Rerum voluptate non adipisci animi distinctio et deserunt amet voluptas. Quia aut aliquid
                                    doloremque ut possimus ipsum officia.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End Team Section -->

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Our Clients</h2>
                    <p>Temporibus omnis officia</p>
                </header>

                <div class="clients-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img
                                src="{{ asset('assets/frontend/assets/img/clients/client-1.png') }}" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img
                                src="{{ asset('assets/frontend/assets/img/clients/client-2.png') }}" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img
                                src="{{ asset('assets/frontend/assets/img/clients/client-3.png') }}" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img
                                src="{{ asset('assets/frontend/assets/img/clients/client-4.png') }}" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img
                                src="{{ asset('assets/frontend/assets/img/clients/client-5.png') }}" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img
                                src="{{ asset('assets/frontend/assets/img/clients/client-6.png') }}" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img
                                src="{{ asset('assets/frontend/assets/img/clients/client-7.png') }}" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"><img
                                src="{{ asset('assets/frontend/assets/img/clients/client-8.png') }}" class="img-fluid"
                                alt=""></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

        </section><!-- End Clients Section -->

        <!-- ======= Recent Blog Posts Section ======= -->
        <section id="recent-blog-posts" class="recent-blog-posts">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Blog</h2>
                    <p>Recent posts form our Blog</p>
                </header>

                <div class="row">

                    <div class="col-lg-4">
                        <div class="post-box">
                            <div class="post-img"><img src="{{ asset('assets/frontend/assets/img/blog/blog-1.jpg') }}"
                                    class="img-fluid" alt=""></div>
                            <span class="post-date">Tue, September 15</span>
                            <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit
                            </h3>
                            <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="post-box">
                            <div class="post-img"><img src="{{ asset('assets/frontend/assets/img/blog/blog-2.jpg') }}"
                                    class="img-fluid" alt=""></div>
                            <span class="post-date">Fri, August 28</span>
                            <h3 class="post-title">Et repellendus molestiae qui est sed omnis voluptates magnam</h3>
                            <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="post-box">
                            <div class="post-img"><img src="{{ asset('assets/frontend/assets/img/blog/blog-3.jpg') }}"
                                    class="img-fluid" alt=""></div>
                            <span class="post-date">Mon, July 11</span>
                            <h3 class="post-title">Quia assumenda est et veritatis aut quae</h3>
                            <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End Recent Blog Posts Section --> --}}

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

    </main><!-- End #main -->
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
            axios.get(`${API_URL}/v1/affiliator/cabang`, {
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
                    console.log('dataCabang', dataCabang)
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        }

        function pilihGerai(value) {
            console.log(value)
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
