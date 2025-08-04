<!-- ======= Header ======= -->

<style>
    ul li a {
        text-decoration: none;
        color: inherit;
    }

    #userLogins .dropdown-toggle {
        display: flex;
        align-items: center;
    }

    #userLogins img {
        margin-right: 10px;
        /* Jarak antara gambar dan teks */
    }

    .getstarted {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px 15px;
        border-radius: 5px;
        background-color: #007bff;
        /* Warna background tombol */
        color: #fff;
        text-decoration: none;
    }
</style>

<header id="header" class="header fixed-top bg-white shadow">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center">
            <img src="{{ asset('images/logo-balanja.png') }}" width="100%" alt="Logo">
            {{-- <span class="">mybisnis</span> --}}
        </a>


        <div class="list-navbar">
            <ul
                style="display: flex;
                align-items: center;
                justify-content: flex-end;
                list-style: none;
                margin: 0;
                padding: 0;">
                <li><a class="nav-link scrollto "
                        href="https://wa.me/6285861345339?text=Hai,%20Qiwari.id%20Saya%20Butuh%20Bantuan!!"> <span
                            class="position-relative">
                            <i class="bi bi-whatsapp" style="font-size: 20px;"></i></span></a></li>
                <li><a class="nav-link scrollto " onclick="alert('Coming Soon')"> <span class="position-relative">
                            <i class="bi bi-bell" style="font-size: 20px;"></i></span></a></li>
                <li id="loginM"><a style="height: 30px" class="getstarted scrollto" href="/login">Login</a></li>
                <li id="userLogins" class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                        id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://www.pngall.com/wp-content/uploads/5/User-Profile-PNG-High-Quality-Image.png"
                            alt="Profile Picture" class="rounded-circle me-2" width="40" height="40">
                        <span class="d-none d-md-inline"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser">
                        <li><a class="dropdown-item" href="/profile-dashboard">Dashboard</a></li>
                        <li><a class="dropdown-item" href="/member/pre-order/member-card">Pre-Order</a></li>
                        <li><a class="dropdown-item" href="https://app.balanja.id">Seller</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <nav id="navbar" class="navbar">
            <ul>
                <li>
                    <div class="input-group">
                        {{-- <select class="form-control" style="width: 150px"">
                            <option value="all">Semua Kategori</option>
                            <option value="electronics">Elektronik</option>
                            <option value="clothing">Pakaian</option>
                            <option value="books">Buku</option>
                            <!-- Tambahkan kategori lain sesuai kebutuhan -->
                        </select> --}}
                        <input type="text" value="" id="search" class="form-control" style=" width: 500px;"
                            placeholder="Cari produk..."aria-describedby="submitButton">
                        <button onclick="cari()" class="btn"
                            style="background: rgb(31, 198, 16); color: white; margin-right: 10px;" type="button"
                            id="submitButton"><i class="bi bi-search text-white"></i></button>
                    </div>
                </li>
                {{-- <li><a class="nav-link scrollto" href="/produk">Produk</a></li>
                <li id="cabang"></li> --}}
                <li><a class="nav-link scrollto mt-2"
                        href="https://wa.me/6285861345339?text=Hai,%20Balanja.id%20Saya%20Butuh%20Bantuan!!"> <span
                            class="position-relative">
                            <i class="bi bi-whatsapp" style="font-size: 20px;"></i>
                    </a></li>
                <li style="display: none"><a class="nav-link scrollto mt-1" href="/keranjang"> <span class="position-relative">
                            <i class="bi bi-cart" style="font-size: 20px;"></i>
                            <span id="jmlKeranjang"
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"></span>
                        </span></a></li>
                <li><a class="nav-link scrollto mt-1" href="/list-transaksi"> <span class="position-relative">
                            <i class="bi bi-bag" style="font-size: 20px;"></i>
                            <span id="jmlTransaksi"
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"></span>
                        </span></a></li>
                <li id="daftar"><a class="getstarted scrollto" href="/daftar">Daftar</a></li>
                <li id="login"><a class="getstarted scrollto" href="/login">Login</a></li>
                <li id="userLogin">
                    {{-- <a class="nav-link scrollto" href="/profile"><i class="bi bi-person"
                            style="font-size: 20px;"></i><span id="userName" class="ms-2"></span></a> --}}
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                            id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://www.pngall.com/wp-content/uploads/5/User-Profile-PNG-High-Quality-Image.png"
                                alt="Profile Picture" class="rounded-circle me-2" width="40" height="40">
                            <span class="d-none d-sm-inline" id="userName"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser">
                            <li><a class="dropdown-item" href="/profile-dashboard">Dashboard</a></li>
                            <li><a class="dropdown-item" href="/member/pre-order/member-card">Pre-Order</a></li>
                            <li><a class="dropdown-item" href="https://app.balanja.id">Seller</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="/logout">Logout</a></li>
                        </ul>
                    </div>
                </li>
                {{-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#">Drop Down 2</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>
                </li> --}}
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
    <div class="search-mobile">
        <div class="container">
            <div class="input-group">
                <input type="text" value="" id="searchM" class="form-control"
                    placeholder="Cari produk..."aria-describedby="submitButtonMobile">
                <button onclick="cariM()" class="btn"
                    style="background: rgb(31, 198, 16); color: white; margin-right: 10px;" type="button"
                    id="submitButtonMobile"><i class="bi bi-search text-white"></i></button>
            </div>
        </div>
    </div>
</header><!-- End Header -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('lib/axios.min.js') }}"></script>
<script>
    var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
        var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var search = urlParams.get('search')
    let checkMember = localStorage.getItem('member_id')
    var user = localStorage.getItem('user')
    var token = localStorage.getItem('token')
    var transaksi = localStorage.getItem('dataTransaksi') || []
    var keranjang = localStorage.getItem('listKeranjang') || []

    if (window.innerWidth <= 768) {
        document.getElementById("searchM").addEventListener("keyup", function(event) {
            // Check if the key pressed is Enter (key code 13)
            if (event.keyCode === 13) {
                // Trigger the click event of the button with the specified ID
                document.getElementById("submitButtonMobile").click();
            }
        });
    } else {
        document.getElementById("search").addEventListener("keyup", function(event) {
            // Check if the key pressed is Enter (key code 13)
            if (event.keyCode === 13) {
                // Trigger the click event of the button with the specified ID
                document.getElementById("submitButton").click();
            }
        });
    }

    if (user != null) {
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
                    document.getElementById('jmlKeranjang').innerHTML = keranjangL.length
                    // document.getElementById('jmlKeranjangM').innerHTML = keranjangL.length
                } else {
                    document.getElementById('jmlKeranjang').style.display = "none";
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
                    document.getElementById('jmlTransaksi').innerHTML = dataTransaksi.length || 0
                    // document.getElementById('jmlTransaksiM').innerHTML = dataTransaksi.length
                } else {
                    document.getElementById('jmlTransaksi').style.display = "none"
                    // document.getElementById('jmlTransaksiM').style.display = "none"
                }
            })
            .catch(function(error) {
                // handle error
                console.log(error);
            });



        document.getElementById('loginM').style.display = "none";
        document.getElementById('login').style.display = "none";
        document.getElementById('daftar').style.display = "none";
        document.getElementById('userName').innerHTML = JSON.parse(user).karyawan.nama_lengkap;
    } else {
        if (transaksi.length > 0) {
            document.getElementById('jmlTransaksi').innerHTML = JSON.parse(transaksi).length
            // document.getElementById('jmlTransaksiM').innerHTML = JSON.parse(transaksi).length
        } else {
            document.getElementById('jmlTransaksi').style.display = "none";
            // document.getElementById('jmlTransaksiM').style.display = "none";
        }
        if (keranjang.length > 0) {
            document.getElementById('jmlKeranjang').innerHTML = JSON.parse(keranjang).length
            // document.getElementById('jmlKeranjangM').innerHTML = JSON.parse(keranjang).length
        } else {
            document.getElementById('jmlKeranjang').style.display = "none";
            // document.getElementById('jmlKeranjangM').style.display = "none";
        }
        document.getElementById('userLogin').style.display = "none";
        document.getElementById('userLogins').style.display = "none";

    }
    if (search != null) {
        document.getElementById('search').value = search;
        document.getElementById('searchM').value = search;
    } else {
        search = "";
    }

    // if (checkMember == null) {
    //     document.getElementById('cabang').innerHTML =
    //         ` <li><a class="nav-link scrollto" href="/sellers">Cabang</a></li>`
    // }

    function cari() {
        const search = document.getElementById('search').value;
        const path = window.location.pathname;
        let url = '';
        if (path == '/member/pre-order/produk/ubah' || path == '/member/pre-order/produk') {
            url = `${path}?search=${encodeURIComponent(search)}`;
        } else {
            if (checkMember == null) {
                url = `/list-produk?search=${encodeURIComponent(search)}`;
            } else {
                url = `/list-produk?member=${checkMember}&search=${encodeURIComponent(search)}`;
            }
        }

        window.location.href = url;
    }

    function cariM() {
        const searchM = document.getElementById('searchM').value;
        const path = window.location.pathname;
        let url = '';
        if (path == '/member/pre-order/produk/ubah' || path == '/member/pre-order/produk') {
            url = `${path}?search=${encodeURIComponent(searchM)}`;
        } else {
            if (checkMember == null) {
                url = `/list-produk?search=${encodeURIComponent(searchM)}`;
            } else {
                url = `/list-produk?member=${checkMember}&search=${encodeURIComponent(searchM)}`;
            }
        }

        window.location.href = url;
    }
</script>
