@extends('layouts.member')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .card {}

        .card:hover {
            box-shadow: 0px 3px 7px rgba(0, 0, 0, 0.26);
            cursor: pointer;
        }

        .custom-loader {
            margin-top: 200px;
            margin-bottom: 200px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background:
                radial-gradient(farthest-side, #7044EF 94%, #0000) top/8px 8px no-repeat,
                conic-gradient(#0000 30%, #7044EF);
            -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 8px), #000 0);
            animation: s3 0.5s infinite linear;
        }

        .sidebar {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.385);
            border-radius: 5px;
        }

        /* Gaya Dasar Skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            border-radius: 4px;
            display: inline-block;
            height: 1em;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        /* Gaya Skeleton Gambar */
        .skeleton-img {
            width: 100%;
            height: 150px;
            border-radius: 4px;
        }

        /* Gaya Skeleton Teks */
        .skeleton-text {
            width: 100%;
            height: 1em;
            margin-bottom: 0.5em;
        }

        /* Gaya Skeleton Tombol */
        .skeleton-button {
            width: 100%;
            height: 2em;
            border-radius: 4px;
        }

        /* Animasi Skeleton */
        @keyframes loading {
            0% {
                background-position: 0% 0%;
            }

            100% {
                background-position: 100% 0%;
            }
        }

        /* Terapkan Animasi */
        .skeleton {
            animation: loading 1.5s infinite ease-in-out;
        }

        @keyframes s3 {
            100% {
                transform: rotate(1turn)
            }
        }

        @media only screen and (min-width: 1024px) {
            .row-mobile {
                display: grid;
                grid-template-columns: repeat(6, minmax(0, 1fr)) !important;
                grid-column-gap: 5px !important;
                grid-row-gap: 5px !important;
                grid-auto-rows: min-content !important;
            }
        }

        @media only screen and (max-width:767px) {
            .row-mobile {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                grid-column-gap: 5px !important;
                grid-row-gap: 5px !important;
                grid-auto-rows: min-content !important;
            }
        }

        h6 {
            font-size: 13px;
        }
    </style>
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast toast-success border-0" style="padding: 5px;" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header text-success">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong class="me-auto">Sukses</strong>
                <a href="" data-bs-dismiss="toast" aria-label="Close"><i class="bi bi-x-lg text-dark"></i></a>
            </div>
            <div class="toast-body">
                <h6>Anda berhasil memasukkan ke keranjang</h6>
                <a href="/keranjang" class="btn text-dark" style="background: rgb(224, 224, 224); font-size: 14px;">Cek
                    Keranjang</a>
            </div>
        </div>
    </div>
    <section id="recent-blog-posts" class="recent-blog-posts">

        <div class="container" style="margin-top: 90px" data-aos="fade-up">
            <div class="d-flex">

                        <a href="" style="" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#pilihFilter">
                            <div class="">
                                <i class="bi bi-filter"></i>
                                <b id="namaKategori">Filter</b>
                            </div>
                        </a>
                {{-- <div class="card  ">
                    <div class="card-header bg-white">
                        <a href="" style="" class="text-black " data-bs-toggle="modal"
                            data-bs-target="#pilihGerai">

                            <div class="">
                                <i class="bi bi-house"></i>
                                <b id="namaGerai">Semua Gerai</b>
                            </div>
                        </a>
                    </div>
                </div> --}}
            </div>
            <div class=" mt-4">
                <div id="productList" class="row">
                    <h5 style="border-bottom: 2px solid rgba(128, 128, 128, 0.541); padding-bottom: 10px;"
                        data-aos="fade-in">
                        <b>
                            List Semua Produk
                        </b>
                    </h5><br>
                    <div class="row-mobile" id="dataProduk">

                    </div>
                    <div id="loading">
                        <div class="row-mobile">
                            @for ($i = 0; $i < 6; $i++)
                                <!-- resources/views/components/skeleton-card.blade.php -->
                                <div class="post-box shadow">
                                    <div>
                                        <div class="skeleton skeleton-img"></div>
                                        <h6 class="skeleton skeleton-text"></h6>
                                        <b class="skeleton skeleton-text"></b> <br>
                                        <span class="skeleton skeleton-text"></span>
                                        <hr>
                                    </div>
                                    <div class="text-center row">
                                        <div class="col">
                                            <div class="skeleton skeleton-button"></div>
                                        </div>
                                        <div class="col">
                                            <div class="skeleton skeleton-button"></div>
                                        </div>
                                        <div class="col">
                                            <div class="skeleton skeleton-button"></div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                    </div>
                    <center>
                        {{-- <div id="loading" class="custom-loader"></div> --}}
                    </center>
                </div>
            </div>
        </div>
    </section>

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
    <div class="modal fade" id="pilihFilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Filter Kategori
                    </h5>
                    <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="listKategori">

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
@endsection

@section('js')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/axios.min.js') }}"></script>

    <script>
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
        var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var member = urlParams.get('member');
        if (member) {
            localStorage.setItem('member_id', member)
        } else {
            var member_id = localStorage.getItem('member_id')
        }
        var gerai_id = localStorage.getItem('gerai_id')
        var kategori_id = localStorage.getItem('kategori_id')
        var gudang_id


        var itemsPerPage = 6; // Jumlah item per halaman
        var currentPage = 1;
        var totalPages = 1;
        var isLoading = false;
        var contentElement = document.getElementById('dataProduk');
        var loadingElement = document.getElementById('loading');

        if (gerai_id) {
            cekMember()
        } else {
            getProduk(currentPage)

        }

        geraiNow = JSON.parse(localStorage.getItem('gerai'));
        if (geraiNow) {
            $('#namaGerai').html("Gerai : " + geraiNow.nama_cabang)
        }
        kategoriNow = JSON.parse(localStorage.getItem('kategori'));
        if (kategoriNow) {
            $('#namaKategori').html("Filter : " + kategoriNow.kategori)
        }
        getGerai()

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
                                                <button type="button" onclick='pilihGerai("semua")' class="btn btn-outline-primary mt-2 float-end"
                                                    >Pilih</button>
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
                                                    ${value.nama_teritori}
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
                                                        ${value.nama_teritori}
                                                    </h5>
                                                </div>
                                                <button type="button" onclick='pilihGerai(${JSON.stringify(value)})' class="btn btn-outline-primary mt-2 float-end"
                                                            >Pilih</button>
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
                window.location.href = "/list-produk"
            } else {
                localStorage.setItem('gerai_id', value.id)
                localStorage.setItem('gerai', JSON.stringify(value))
                window.location.href = "/list-produk"
            }
        }

        getKategori()

        function getKategori() {
            axios.get(`${API_URL}/kategori-public`, {
                    headers: {
                        'secret': API_SECRET,
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    let dataKategori = response.data.data
                    $('#listKategori').html("");
                    if (dataKategori[0] != null) {
                        if (kategori_id == null) {
                            $('#listKategori').html(`
                                <div class="card  mb-3"
                                    style="background: rgba(26, 216, 26, 0.127); border: 1px solid rgb(27, 170, 27);">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-bold"
                                                    style="color: gray;">Semua Kategori</span>
                                            <i class="bi bi-check text-success" style="font-size: 40px; "></i>
                                        </div>
                                    </div>
                                </div>
                                `);
                        } else {
                            $('#listKategori').html(`
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="text-bold"
                                                        style="color: gray;">Semua Kategori</span>
                                                <button type="button" onclick='pilihKategori("semua")' class="btn btn-outline-primary mt-2 float-end"
                                                    >Pilih</button>
                                            </div>
                                        </div>
                                    </div>
                                `)
                        }
                        $.each(dataKategori, function(key, value) {
                            if (value.id == kategori_id) {
                                $('#listKategori').append(`
                                <div class="card  mb-3"
                                    style="background: rgba(26, 216, 26, 0.127); border: 1px solid rgb(27, 170, 27);">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-bold"
                                                    style="color: gray;">${value.kategori}</span>
                                            <i class="bi bi-check text-success" style="font-size: 40px; "></i>
                                        </div>
                                    </div>
                                </div>
                                `)

                            } else {
                                $('#listKategori').append(`
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="text-bold"
                                                        style="color: gray;">${value.kategori}</span>
                                                <button type="button" onclick='pilihKategori(${JSON.stringify(value)})' class="btn btn-outline-primary mt-2 float-end"
                                                    >Pilih</button>
                                            </div>
                                        </div>
                                    </div>
                                `)
                            }
                        })
                    } else {
                        $('#dataKategori').html(`
                        <center>
                            <br><br>
                            <img src="{{ asset('images/empty.png') }}" style="width: 250px;" alt=""><br>
                            <h4 class="text--primary"><b> Tidak Ditemukan</b></h4>
                            <h6>Mohon maaf kategori tidak ditemukan</h6>
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

        function pilihKategori(value) {
            if (value == "semua") {
                localStorage.removeItem('kategori_id')
                localStorage.removeItem('kategori')
                window.location.href = "/list-produk"
            } else {
                localStorage.setItem('kategori_id', value.id)
                localStorage.setItem('kategori', JSON.stringify(value))
                window.location.href = "/list-produk"
            }
        }



        function cekMember() {
            axios.get(`${API_URL}/affiliator/member-public/${gerai_id}`, {
                    headers: {
                        'secret': API_SECRET,
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    let memberData = response.data
                    if (memberData.sebagai == 'marketing') {
                        if (memberData.wilayah[0]) {
                            gudang_id = memberData.wilayah[0].gudang_id
                            getProdukRef(currentPage)
                        } else {
                            getGudang()
                        }
                    } else {
                        getGudang()
                    }
                    console.log(response.data)
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        }

        var isProduk = 0;

        function getProduk(page) {

            isLoading = true;
            loadingElement.style.display = 'block';

            axios.get(
                    `${API_URL}/toko-penyimpanan-public?search=${search}${kategori_id ? `&kategori_id=${kategori_id}&` : `&`}harga=retail&start=${(page - 1) * itemsPerPage}&length=${itemsPerPage}&gudang_id=83&order=desc&show_as_product=1`, {
                        headers: {
                            'secret': API_SECRET,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataProduk = response.data.data
                    dataProduk.forEach(item => {
                        item.varian_barang.forEach(product => {
                            delete product.barang?.deskripsi
                        })
                    })
                    totalPages = Math.ceil(response.data.total / itemsPerPage);
                    // $('#dataProduk').html("");

                    if (dataProduk[0] != null) {
                        isProduk = 1;
                        $.each(dataProduk, function(key, value) {
                            $('#dataProduk').append(`
                                <div class="post-box shadow" >
                                    <div style="cursor:pointer" onclick='detailProduk(${JSON.stringify(value)})'>
                                        <div class=""><img
                                        src="${value.photo[0] && value.photo[0].path ? `https:\/\/api.balanja.kehosting.in\/barang\/photo\/${value.photo[0].photo}` : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}"
                                        class="rounded-4" style="width: 100%; height: 180px; object-fit: cover;" alt=""></div>

                                        <h6 class="mt-2"><b> ${value.nama.slice(0, 17) + (value.nama.length > 17 ? "..." : "")}  </b></h6>
                                        <b class="text--primary" > ${rupiah(value.harga)}</b> ${value.harga_coret > 0 ? `<s style="font-size: 13px; color: grey;">${rupiah(value.harga_coret)}</s>` : ''} <br>
                                        <hr>
                                    </div>
                                    <div class="text-center row">
                                        <div class="col">
                                            <i onclick="alert('Coming Soon')"
                                                class="bi bi-heart text-center text-primary" style="cursor:pointer"></i>
                                        </div>
                                        <div class="col">
                                            <a onclick='share(${JSON.stringify(value)})' data-bs-toggle="modal" style="cursor: pointer;"
                                                data-bs-target="#modalLink"> <i class="bi bi-share text-center text-primary"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        if (isProduk == 0) {
                            $('#dataProduk').html(`
                            <center>
                                <br><br>
                                <img src="{{ asset('images/empty.png') }}" style="width: 250px;" alt=""><br>
                                <h4 class="text--primary"><b> Tidak Ditemukan</b></h4>
                                <h6>Mohon maaf Produk tidak ditemukan</h6>
                                <br><br>
                            </center>
                            `)
                        }
                    }

                    isLoading = false;
                    loadingElement.style.display = 'none';
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        }

        function checkAndLoadData() {
            const scrollPosition = window.scrollY + window.innerHeight;
            const contentHeight = contentElement.offsetHeight;

            if (!isLoading && scrollPosition >= contentHeight && currentPage < totalPages) {
                currentPage++;
                if (gerai_id) {
                    getProdukRef(currentPage)
                } else {
                    getProduk(currentPage)

                }
            }
        }

        // Event listener untuk mendeteksi scroll
        window.addEventListener('scroll', checkAndLoadData);


        function getGudang() {
            axios.get(`${API_URL}/gudang-public?member_id=${gerai_id}`, {
                    headers: {
                        'secret': API_SECRET,
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    gudang_id = response.data.data[0].id
                    getProdukRef(currentPage)
                })
                .catch(function(error) {
                    // handle error
                    $('#dataProduk').html(`
                            <center>
                                <br><br>
                                <img src="{{ asset('images/empty.png') }}" style="width: 250px;" alt=""><br>
                                <h4 class="text--primary"><b> Tidak Ditemukan</b></h4>
                                <h6>Mohon maaf Produk tidak ditemukan</h6>
                                <br><br>
                            </center>`);
                    console.log(error);
                });

        }

        function getProdukRef(page) {
            isLoading = true;
            loadingElement.style.display = 'block';
            axios.get(
                    `${API_URL}/toko-penyimpanan-public?&search=${search}${kategori_id ? `&kategori_id=${kategori_id}&` : `&`}harga=retail&start=${(page - 1) * itemsPerPage}&length=${itemsPerPage}&gudang_id=83&show_as_product=1`, {
                        headers: {
                            'secret': API_SECRET,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataProduk = response.data.data
                    totalPages = Math.ceil(response.data.total / itemsPerPage);
                    // $('#dataProduk').html("");

                    if (dataProduk[0] != null) {
                        isProduk = 1;
                        $.each(dataProduk, function(key, value) {
                            $('#dataProduk').append(`
                                <div class="post-box bg-dark" >
                                    <div style="cursor:pointer" onclick='detailProduk(${JSON.stringify(value)})'>
                                        <div class=""><img
                                        src="${value.photo[0] && value.photo[0].path ? `https:\/\/api.balanja.kehosting.in\/barang\/photo\/${value.photo[0].photo}` : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}"
                                        class="rounded-4" style="width: 100%; height: 180px; object-fit: cover;" alt=""></div>

                                        <h6 class="mt-2"><b> ${value.nama.slice(0, 17) + (value.nama.length > 17 ? "..." : "")}  </b></h6>
                                        <b class="text--primary" > ${rupiah(value.harga)}</b> ${value.harga_coret > 0 ? `<s style="font-size: 13px; color: grey;">${rupiah(value.harga_coret)}</s>` : ''} <br>
                                        <hr>
                                    </div>
                                    <div class="text-center row">
                                        <div class="col">
                                            <i onclick="alert('Coming Soon')"
                                                class="bi bi-heart text-center text-primary" style="cursor:pointer"></i>
                                        </div>
                                        <div class="col">
                                            <a onclick='share(${JSON.stringify(value)})' data-bs-toggle="modal" style="cursor: pointer;"
                                                data-bs-target="#modalLink"> <i class="bi bi-share text-center text-primary"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            `);

                        });
                    } else {
                        if (isProduk == 0) {
                            $('#dataProduk').html(`
                            <center>
                                <br><br>
                                <img src="{{ asset('images/empty.png') }}" style="width: 250px;" alt=""><br>
                                <h4 class="text--primary"><b> Tidak Ditemukan</b></h4>
                                <h6>Mohon maaf Produk tidak ditemukan</h6>
                                <br><br>
                            </center>
                            `)
                        }
                    }
                    isLoading = false;
                    loadingElement.style.display = 'none';
                })
                .catch(function(error) {
                    // handle error
                    $('#dataProduk').html(`
                        <center>
                            <br><br>
                            <img src="{{ asset('images/empty.png') }}" style="width: 250px;" alt=""><br>
                            <h4 class="text--primary"><b> Tidak Ditemukan</b></h4>
                            <h6>Mohon maaf Produk tidak ditemukan</h6>
                            <br><br>
                        </center>`);
                    console.log(error);
                });
        }

        function detailProduk(data) {
            window.location.href = `/detail-produk/${data.slug}`
        }

        function masukKeranjang(detailProduk) {
            if (detailProduk.varian_barang[0].barang.kategori.kategori == "Hewan Qurban") {
                alert('Hewan Qurban tidak bisa dimasukkan ke keranjang');
            } else {
                var data = localStorage.getItem('listKeranjang') ? JSON.parse(localStorage.getItem('listKeranjang')) : []

                var penyimpananId = detailProduk.varian_barang[detailProduk.varian_barang.length - 1].id
                if (user) {
                    payload = {
                        penyimpanan_id: penyimpananId,
                        qty: 1,
                        member_id: JSON.parse(user).karyawan.id,
                    }
                    var token = localStorage.getItem('token')
                    axios.post(`${API_URL}/input/cart`, [payload], {
                            headers: {
                                'secret': API_SECRET,
                                'Author': 'bearer ' + token,
                                'device': 'web'
                            }
                        })
                        .then(function(response) {
                            var toastElList = [].slice.call(document.querySelectorAll('.toast-success'))
                            var toastList = toastElList.map(function(toastEl) {
                                return new bootstrap.Toast(toastEl)
                            })
                            toastList.forEach(toast => toast.show())
                        })
                        .catch(function(error) {
                            // handle error
                            alert(error.response.data.message)
                            console.log(error);
                        });
                } else {
                    if (detailProduk.varian_barang[0].jumlah == 0) {
                        alert(
                            `Stok ${detailProduk.varian_barang[0].barang.nama} tidak cukup: ${detailProduk.varian_barang[0].jumlah}`
                        )
                    } else {
                        if (data == undefined) {
                            data.push({
                                id: penyimpananId,
                                qty: 1,
                                jumlah: detailProduk.varian_barang[0].jumlah,
                                konversi_ket: detailProduk.varian_barang[0].konversi_ket,
                                barang: detailProduk.varian_barang[0].barang,
                                harga: detailProduk.harga,
                                member_id: detailProduk.member_id
                            })
                            localStorage.setItem('listKeranjang', JSON.stringify(data))
                        } else {
                            let existKeranjang = data.find(res => {
                                return res.id == penyimpananId
                            })
                            if (!existKeranjang) {
                                data.push({
                                    id: penyimpananId,
                                    qty: 1,
                                    jumlah: detailProduk.varian_barang[0].jumlah,
                                    konversi_ket: detailProduk.varian_barang[0].konversi_ket,
                                    barang: detailProduk.varian_barang[0].barang,
                                    harga: detailProduk.harga,
                                    member_id: detailProduk.member_id
                                })
                                localStorage.setItem('listKeranjang', JSON.stringify(data))
                            } else {
                                data.map(res => {
                                    if (res.id == penyimpananId) {
                                        res.qty = 1
                                    }
                                })
                                localStorage.setItem('listKeranjang', JSON.stringify(data))
                            }
                        }
                        var toastElList = [].slice.call(document.querySelectorAll('.toast-success'))
                        var toastList = toastElList.map(function(toastEl) {
                            return new bootstrap.Toast(toastEl)
                        })
                        toastList.forEach(toast => toast.show())
                    }
                }
            }
        }

        function share(item) {
            $('#copyText').val(`https://qiwari.id/detail-produk/${item.slug}`)
            $('#linkAffiliate').html(`https://qiwari.id/detail-produk/${item.slug}`)
            $('#linkSalin').html(
                `<a onclick="salinLink('https://qiwari.id/detail-produk/${item.slug}')" style="cursor: pointer">
                    <i style="font-size: 40px;color: blue" class="fas fa-copy"></i>
                    <p class="text-center">Salin Link</p>
                </a>
                `
            )
            $('#linkWhatsapp').html(
                `   <a href="whatsapp://send?text=https://qiwari.id/detail-produk/${item.slug}" style="cursor: pointer">
                        <i style="font-size: 40px;color: green" class="bi bi-whatsapp"></i>
                        <p class="text-center">Whatsapp</p>
                    </a> `
            )
        }

        function salinLink(text) {
            const el = document.createElement('textarea');
            el.value = text;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            navigator.clipboard.writeText(text);
            alert('Link Disalin');
        }
    </script>
@endsection
