<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Balanja.id</title>
    <meta content="" name="description">

    <meta content="" name="keywords">
    <meta name="api-url" content="{{ config('api.url') }}">
    <meta name="api-secret" content="{{ config('api.secret') }}">

    <!-- Favicons -->
    <link href="{{ asset('images/logo-balanja.png') }}" rel="icon">
    <link href="{{ asset('images/logo-balanja.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('splide.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/frontend/assets/css/style.css') }}" rel="stylesheet">
    @yield('css')
    <style>
        .atasButton {
            margin-bottom: 65px;
        }

        #menuBottom a {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>

<body>

    @include('layouts.partials.member.header')

    <div class="top-header-margin" style="margin-bottom: 150px;">
        @yield('content')
        <nav class="fixed-bottom bg-white d-lg-none d-lg-block" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.205)">
            <div id="menuBottom" class="p-2"
                style="display: flex; justify-content: space-around; align-items: center;">
                <div><a href="/" class="{{ Request::is('/') ? 'text--primary' : 'text--secondary' }}"> <i
                            class="bi bi-house me-1"></i> Home</a>
                </div>
                <div><a href="/list-transaksi"
                        class="{{ Request::is('list-transaksi') ? 'text--primary' : 'text--secondary' }} position-relative">
                        <span class="position-relative">
                            <i class="bi bi-bag me-1"></i> <span id="jmlTransaksiM"
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"></span>
                        </span>
                        Pesanan</a></div>
                <div><a href="/keranjang" class="{{ Request::is('keranjang') ? 'text--primary' : 'text--secondary' }}">
                        <span class="position-relative">
                            <i class="bi bi-cart2 me-1"></i> <span id="jmlKeranjangM"
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"></span>
                        </span>
                        Keranjang</a></div>
                <div><a onclick="alert('Coming Soon')"
                        class="{{ Request::is('wishlist') ? 'text--primary' : 'text--secondary' }}"> <i
                            class="bi bi-heart me-1"></i>
                        Disukai</a></div>
            </div>
        </nav>
    </div>

    @include('layouts.partials.member.footer')


    <a href="#" class="back-to-top bg-dark d-flex align-items-center atasButton justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    @yield('js')
    <script src="{{ asset('mixin/mixin.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/vendor/php-email-form/validate.js') }}"></script>

    <script>
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
        var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
        var transaksi = localStorage.getItem('dataTransaksi') || []
        var keranjang = localStorage.getItem('listKeranjang') || []
        if (user) {
            var token = localStorage.getItem('token')
            axios.get(`${API_URL}/v1/cart?member_id=${JSON.parse(user).karyawan.id}`, {
                    headers: {
                        'secret': API_SECRET,
                        'Author': 'bearer ' + token,
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    keranjangL = response.data.data

                    if (keranjangL[0]) {
                        document.getElementById('jmlKeranjangM').innerHTML = keranjangL.length
                        // document.getElementById('jmlKeranjangM').innerHTML = keranjangL.length
                    } else {
                        document.getElementById('jmlKeranjangM').style.display = "none";
                        // document.getElementById('jmlKeranjangM').style.display = "none";
                    }
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
            axios.get(
                    `${API_URL}/v1/transaksi-online?konsumen_member_id=${JSON.parse(user).karyawan.id}&show_bukti_tf=1&status=pending&view_as_invoice=1&start=0&length=20`, {
                        headers: {
                            'secret': API_SECRET,
                            'Author': 'bearer ' + token,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataTransaksi = response.data
                    if (dataTransaksi.length > 0) {
                        document.getElementById('jmlTransaksiM').innerHTML = dataTransaksi.length
                        // document.getElementById('jmlTransaksiM').innerHTML = dataTransaksi.length
                    } else {
                        document.getElementById('jmlTransaksiM').style.display = "none"
                        // document.getElementById('jmlTransaksiM').style.display = "none"
                    }
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        } else {
            if (transaksi.length > 0) {
                document.getElementById('jmlTransaksiM').innerHTML = JSON.parse(transaksi).length
                // document.getElementById('jmlTransaksiM').innerHTML = JSON.parse(transaksi).length
            } else {
                document.getElementById('jmlTransaksiM').style.display = "none";
                // document.getElementById('jmlTransaksiM').style.display = "none";
            }
            if (keranjang[0]) {
                document.getElementById('jmlKeranjangM').innerHTML = JSON.parse(keranjang).length
                // document.getElementById('jmlKeranjangM').innerHTML = JSON.parse(keranjang).length
            } else {
                document.getElementById('jmlKeranjangM').style.display = "none";
                // document.getElementById('jmlKeranjangM').style.display = "none";
            }
        }
        document.onkeydown = function(e) {
            if (e.ctrlKey &&
                (e.keyCode === 85 ||
                    e.keyCode === 117)) {
                return false;
            } else {
                return true;
            }
        };
    </script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/frontend/assets/js/main.js') }}"></script>

</body>

</html>
