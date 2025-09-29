@extends('layouts.member')

@section('content')
    <style>
        .card {
            box-shadow: 0px 3px 9px rgba(0, 0, 0, 0.164);

        }

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
    {{-- <div class="container" style="margin-top: 90px" data-aos="fade-up">
            <center>

                <div class="col-sm-6 mt-4">
                    <div class="row">
                        <div class="col-sm-9">
                            <input type="text" name="search" id="search" class="form-control mb-3"
                                placeholder="Cari disini...">
                        </div>
                        <div class="col-sm">
                            <button type="button" class="btn--primary w-100" onclick="cari()">Cari</button>
                        </div>
                    </div>
                </div>
                <br>
            </center>
            <h5 style="border-bottom: 2px solid rgba(128, 128, 128, 0.541); padding-bottom: 10px;" data-aos="fade-in"><b>
                    List Semua Produk
                </b></h5><br>

            <div class="row-mobile" id="dataProduk">
                <center>

                    <div class="custom-loader"></div>
                </center>
            </div>

        </div> --}}
    <section id="recent-blog-posts" class="recent-blog-posts">

        <div class="container-fluid" style="margin-top: 40px" data-aos="fade-up">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar">
                        <h4>Filter</h4>
                        <hr>
                        <div class="form-group ">
                            <label for="category">Kategori:</label><br />
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="elektronik" id="elektronik" />
                                <label class="form-check-label" for="elektronik"> Elektronik </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="pakaian" id="pakaian" />
                                <label class="form-check-label" for="pakaian"> Pakaian </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="buku" id="buku" />
                                <label class="form-check-label" for="buku"> Buku </label>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="minPrice">Minimal Harga:</label>
                            <input type="number" class="form-control" id="minPrice" placeholder="Minimal Harga" />
                        </div>
                        <div class="form-group">
                            <label for="maxPrice">Maksimal Harga:</label>
                            <input type="number" class="form-control" id="maxPrice" placeholder="Maksimal Harga" />
                        </div>
                        <button class="btn btn-outline-primary form-control mt-2" onclick="filterProducts()">Filter</button>
                    </div>
                </div>
                <div class="col-md-9 mt-4">
                    <div id="productList" class="row">
                        <h5 style="border-bottom: 2px solid rgba(128, 128, 128, 0.541); padding-bottom: 10px;"
                            data-aos="fade-in"><b>
                                List Semua Produk
                            </b></h5><br>
                        <div class="row-mobile" id="dataProduk">
                        </div>
                        <center>
                            <div id="loading" class="custom-loader"></div>
                        </center>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/axios.min.js') }}"></script>

    <script>
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
    var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var member = urlParams.get('member')
        console.log("sarching", search)

        if (member) {
            let member_id = localStorage.getItem('member_id')
            if (member != member_id) {
                localStorage.setItem('member_id', member)
            }
            cekMember();
            // getGudang()
        } else {
            let member_id = localStorage.getItem('member_id')
            if (member_id) {
                window.location.href = `/affiliate?member=${member_id}`
            } else {
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

        var gudang_id

        function cekMember() {
            axios.get(`${API_URL}/affiliator/member-public/${member}`, {
                    headers: {
                        'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    let memberData = response.data
                    if (memberData.sebagai == 'marketing') {
                        if (memberData.wilayah[0]) {
                            gudang_id = memberData.wilayah[0].gudang_id
                            getProduk()
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

        function getGudang() {
            axios.get(`${API_URL}/gudang-public?member_id=${member}`, {
                    headers: {
                        'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    gudang_id = response.data.data[0].id
                    getProduk()
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

        var isLoading = false;
        var loadingElement = document.getElementById('loading');

        function getProduk() {
            isLoading = true;
            loadingElement.style.display = 'block';

            axios.get(
                    `${API_URL}/toko-penyimpanan-public?harga=retail&search=${search}&gudang_id=${gudang_id}&show_as_product=1`, {
                        headers: {
                            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataProduk = response.data.data
                    $('#dataProduk').html("");

                    if (dataProduk[0] != null) {
                        $.each(dataProduk, function(key, value) {
                            $('#dataProduk').append(`
                            <a href="/affiliate/detail/${value.slug}">
                                <div class="post-box">
                                    <div class="post-img"><img
                                    src="${value.photo[0] && value.photo[0].path ? value.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}"
                                    class="img-fluid" alt=""></div>

                                    <h6 class="text-dark"><b> ${value.nama}  </b></h6>
                                    <b class="text--primary" > ${rupiah(value.harga)}</b>
                                    <span style="color: grey; font-size:12px;">${value.varian_barang[0].gudang.member.kab_kota ? value.varian_barang[0].gudang.member.kab_kota.name : 'KAB. BANDUNG'}</span>
                                </div>
                            </a>
                        `);
                        });
                    } else {
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
            isLoading = false;
            loadingElement.style.display = 'none';
        }
    </script>
@endsection
