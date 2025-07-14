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
                grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
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

    <section id="recent-blog-posts" class="recent-blog-posts">

        <div class="container-fluid" style="margin-top: 90px" data-aos="fade-up">
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

        var contentElement = document.getElementById('dataProduk');
        var paginationElement = document.getElementById('pagination');
        var currentPageSpan = document.getElementById('currentPage');
        var loadingElement = document.getElementById('loading');

        var gerai_id = localStorage.getItem('gerai_id')

        function displayData(page) {
            isLoading = true;
            loadingElement.style.display = 'block';

            axios.get(
                    `${API_URL}/v1/barang-public?harga=retail&order=desc&search=${search}&start=${(page - 1) * itemsPerPage}&length=${itemsPerPage}&show_as_product=1&member_id=${gerai_id}`, {
                        headers: {
                            'secret': API_SECRET,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let produkData = response.data.data
                    totalPages = Math.ceil(response.data.total / itemsPerPage);

                    if (produkData[0] != null) {
                        $.each(produkData, function(key, value) {
                            $('#dataProduk').append(`
                            <a href="/detail/${value.slug}">
                                <div class="post-box">
                                    <div class="post-img"><img
                                    src="${value.photo[0] && value.photo[0].path ? value.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}"
                                    class="img-fluid" alt=""></div>

                                    <h6 class="text-dark"><b> ${value.nama}  </b></h6>
                                    <b class="text--primary" > ${rupiah(value.harga)}</b>
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

                    isLoading = false;
                    loadingElement.style.display = 'none';
                })
                .catch(function(error) {
                    console.log(error);
                });

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
