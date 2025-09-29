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

        /* Gaya Dasar Skeleton */
    .skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        border-radius: 15px;
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
    .post-box:hover {
        background: #f0f0f0;
    }

        h6 {
            font-size: 13px;
        }
    </style>

    <section id="recent-blog-posts" class="recent-blog-posts">

        <div class="container" style="margin-top: 110px">
            <div class="row g-0 align-items-center">
                <!-- Foto Terapis -->
                <div class="col-3 col-md-1 text-center mb-2 mb-md-0">
                  <img id="foto" 
                       style="width: 100%; height: 120px; object-fit: cover;" 
                       class="rounded-4 p-2">
                </div>
              
                <!-- Detail Terapis -->
                <div class="col-8 col-md-9">
                  <div class="card-body">
                    <h4 class="card-title"><b id="nama"></b></h4>
                    <div class="text-muted small mb-2" id="kota"></div>
              
                    {{-- <span class="d-flex align-items-center fw-bold text-muted">
                        <i class="bi bi-award-fill text--primary me-1"></i> <span id="sertifikasi"></span>
                    </span> --}}
                    <div class="d-flex flex-wrap gap-3 mb-2">
                        <span class="d-flex align-items-center small text-muted">
                            <i class="bi bi-star-fill me-1 text-warning"></i> 
                            <span id="rating"></span>
                        </span>
                    </div>
                  </div>
                </div>
              </div>
              

                    <div id="productList" class="row mt-4">
                        <h5
                           ><b>
                                Semua Jasa
                            </b></h5><br>
                            {{-- <div class="d-flex mb-3">
                                <button class="tab-btn active" onclick="setFilter('')">Semua</button>
                                <button class="tab-btn" onclick="setFilter('barang')">Produk</button>
                                <button class="tab-btn" onclick="setFilter('jasa')">Jasa</button>
                              </div> --}}
                        <div class="row-mobile" id="dataProduk">
                        </div>
                        <center>
                            <div id="loading">
                                <div class="row-mobile mt-3">
                                    @for ($i = 0; $i < 6; $i++)
                                        <!-- resources/views/components/skeleton-card.blade.php -->
                                        <div class="post-box border-0 shadow">
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
                        </center>
                    </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/axios.min.js') }}"></script>

    <script>
        const terapis = JSON.parse(localStorage.getItem("selectedTerapis"));


        if (terapis) {
        document.getElementById("nama").textContent = terapis.nama_cabang;
        document.getElementById("kota").textContent = terapis.kota_kab;
        document.getElementById("rating").textContent = terapis.rating || '0.0';
        // document.getElementById("sertifikasi").textContent = terapis.sertifikasi || 'Sertifikasi Asosiasi';
        document.getElementById("foto").src = `https://api.balanja.kehosting.in/${terapis.photo}`;
        // dst...
        }

        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var member = urlParams.get('member')
        if (member) {
            let member_id = localStorage.getItem('member_id')
            if (member != member_id) {
                localStorage.setItem('member_id', member)
            }
            window.location.href = `/affiliate?member=${member}`
        } else {
            let member_id = localStorage.getItem('member_id')
            if (member_id) {
                window.location.href = `/affiliate?member=${member_id}`
            }
        }

        var itemsPerPage = 12; // Jumlah item per halaman
        var currentPage = 1;
        var totalPages = 1;
        var isLoading = false;
        let filterType = ""; 

        var contentElement = document.getElementById('dataProduk');
        var paginationElement = document.getElementById('pagination');
        var currentPageSpan = document.getElementById('currentPage');
        var loadingElement = document.getElementById('loading');

        var gerai_id = localStorage.getItem('gerai_id')

        function setFilter(type) {
            filterType = type;
            page = 1;
            $('#dataProduk').html(""); // reset isi produk
            $('.tab-btn').removeClass('active');
            event.target.classList.add('active');
            displayData(page);
        }

        function displayData(page) {
            isLoading = true;
        loadingElement.style.display = 'block';

        const params = new URLSearchParams({
            harga: "retail",
            order: "desc",
            product_type: 'jasa',
            start: (page - 1) * itemsPerPage,
            length: itemsPerPage,
            show_as_product: 1,
            member_id: terapis.id
        });

        // tambahkan kalau ada search
        if (search) {
        params.append("search", search);
        }

        // tambahkan kalau ada filterType
        // if (filterType) {
        // params.append("product_type", filterType);
        // }

        const url = `https://api.balanja.kehosting.in/v1/barang-public?${params.toString()}`;


        axios.get(url, {
            headers: {
            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
            'device': 'web'
            }
        })
                .then(function(response) {
                    let produkData = response.data.data
                    totalPages = Math.ceil(response.data.total / itemsPerPage);

                    if (produkData[0] != null) {
                        $.each(produkData, function(key, value) {
                            $('#dataProduk').append(` 
                            <div class="post-box shadow rounded-4" >
                                    <div style="cursor:pointer" onclick='detailProduk(${JSON.stringify(value)})'>
                                        <div class=""><img
                                        src="${value.photo[0] && value.photo[0].path ? `https:\/\/api.balanja.kehosting.in\/barang\/photo\/${value.photo[0].photo}` : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}"
                                        class="rounded-4" style="width: 100%; height: 180px; object-fit: cover;" alt=""></div>
                                        <h6 class="text-dark mt-2"><b> ${value.nama.slice(0,25) + (value.nama.length >25 ? "..." : "")}  </b></h6>
                                        <b class="text--primary" > ${rupiah(value.harga)}</b> ${value.harga_coret > 0 ? `<s style="font-size: 13px; color: grey;">${rupiah(value.harga_coret)}</s>` : ''}
                                        <hr>
                                    </div>
                                    <div class="text-center row">
                                        <div class="col">
                                            <i onclick="alert('Coming Soon')"
                                                class="bi bi-heart text-center" style="cursor:pointer"></i>
                                        </div>
                                        <div class="col">
                                            <i onclick='masukKeranjang(${JSON.stringify(value)})'
                                                class="bi bi-cart text-center" style="cursor:pointer"></i>
                                        </div>
                                        <div class="col">
                                            <a onclick='share(${JSON.stringify(value)})' data-bs-toggle="modal" style="cursor: pointer;"
                                                data-bs-target="#modalLink"> <i class="bi bi-share text-center"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        $('#dataProduk').html(`
                        <div>
                            <br><br>
                            <h4 class="text--primary"><b> Tidak Ditemukan</b></h4>
                            <h6>Mohon maaf Produk tidak ditemukan</h6>
                            <br><br>
                        </div>
                        `)
                    }

                    isLoading = false;
                    loadingElement.style.display = 'none';
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        function detailProduk(data) {
            window.location.href = `/detail-produk/${data.slug}`
        }

        function checkAndLoadData() {
            const scrollPosition = window.scrollY + window.innerHeight;
            const contentHeight = contentElement.offsetHeight;

            if (!isLoading && scrollPosition >= contentHeight && currentPage < totalPages) {
                currentPage++;
                displayData(currentPage);
            }
        }

        // Event listener untuk mendeteksi scroll
        window.addEventListener('scroll', checkAndLoadData);


        // Inisialisasi tampilan halaman pertama
        displayData(currentPage);
    </script>
@endsection
