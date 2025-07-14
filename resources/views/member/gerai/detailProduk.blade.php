@extends('layouts.member')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <br><br><br>

    <style type="text/css">
        label>input {
            visibility: hidden;
            position: absolute;
        }

        label>input+img {
            cursor: pointer;
            border: 2px solid transparent;
        }

        label>input:checked+img {
            border: 3px solid rgb(0, 76, 255);
            border-radius: 5px;
        }

        .horizontal-scrollable {
            overflow-x: auto;
            white-space: nowrap;
            display: flex;
            padding: 10px;
            margin: 0px;
        }

        .row {
            display: flex;
            justify-content: center;
            /* align-items: center; */
        }

        .custom-loader {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background:
                radial-gradient(farthest-side, #F4F4F4 94%, #0000) top/4px 4px no-repeat,
                conic-gradient(#0000 30%, #F4F4F4);
            -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 4px), #000 0);
            animation: s3 0.5s infinite linear;
        }

        .skeleton-container {
            width: 300px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: pulse 1.5s infinite ease-in-out;
        }

        .skeleton-header,
        .skeleton-content {
            height: 15px;
            background-color: #f0f0f0;
            margin-bottom: 10px;
            border-radius: 4px;
            animation: shimmer 2s infinite linear;
        }

        .skeleton-header {
            width: 50%;
        }

        .skeleton-content {
            width: 100%;
        }

        .image-container {
            width: 250px;
            height: 200px;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
        }

        .skeleton-image {
            width: 300%;
            height: 100%;
            background-color: #f0f0f0;
            /* animation: shimer 0.3s infinite linear; */
        }


        .type-options {
            display: flex;
        }

        .type-option {
            padding: 10px;
            margin-right: 10px;
            cursor: pointer;
            border: 1px solid #ccc;
        }

        .type-option:hover {
            border: 1px solid #333;
        }

        @keyframes shimer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -300px 0;
            }

            100% {
                background-position: 300px 0;
            }
        }


        @keyframes s3 {
            100% {
                transform: rotate(1turn)
            }
        }

        /* Style the radio buttons */
        input[type="radio"] {
            display: none;
            /* Hide the default radio button */
        }

        /* Style the labels (container for images) */
        label {
            cursor: pointer;
            border: 2px solid transparent;
        }

        /* Style the labels when a radio button is checked (selected) */
        input[type="radio"]:checked+label {
            border-color: #007bff;
            /* Change the border color to indicate selection */
        }
    </style>

    <section id="features" class="features">
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast toast-success border-0" style="padding: 5px;" role="alert"
                aria-live="assertive" aria-atomic="true">
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
        <div class="container mt-4" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-3">
                    <div id="productImage">
                        <div class="image-container">
                            <div class="skeleton-image"></div>
                        </div>
                    </div>
                    <br><br>
                    <div class="container horizontal-scrollable" style=" overflow-x: hidden;">
                        {{-- <center>
                            <div class="row">
                                @if ($paket->gambar1 != null)
                                    <div class="col">
                                        <input type="radio" name="imageRadio" id="imageRadio1"
                                            onchange="GambarGanti('{{ $paket->gambar1 }}','{{ $paket->harga }}','{{ $paket->stok }}')" />
                                        <label for="imageRadio1">
                                            <img src="{{ asset('images/produk/' . $paket->gambar1) }}" width="44px"
                                                srcset="">
                                        </label>
                                    </div>
                                @endif

                                <div class="col">
                                    <input type="radio" name="imageRadio" id="imageRadio2"
                                        onchange="GambarGanti('{{ $paket->gambar2 }}','{{ $paket->harga }}','{{ $paket->stok }}')" />
                                    <label for="imageRadio2">
                                        @if ($paket->gambar2 != null)
                                            <img src="{{ asset('images/produk/' . $paket->gambar2) }}" width="44px"
                                                srcset="">
                                        @endif
                                    </label>
                                </div>

                                <div class="col">
                                    <input type="radio" name="imageRadio" id="imageRadio3"
                                        onchange="GambarGanti('{{ $paket->gambar3 }}','{{ $paket->harga }}','{{ $paket->stok }}')" />
                                    <label for="imageRadio3">
                                        @if ($paket->gambar3 != null)
                                            <img src="{{ asset('images/produk/' . $paket->gambar3) }}" width="44px"
                                                srcset="">
                                        @endif
                                    </label>
                                </div>


                                <div class="col">
                                    <input type="radio" name="imageRadio" id="imageRadio4"
                                        onchange="GambarGanti('{{ $paket->gambar4 }}','{{ $paket->harga }}','{{ $paket->stok }}')" />
                                    <label for="imageRadio4">
                                        @if ($paket->gambar4 != null)
                                            <img src="{{ asset('images/produk/' . $paket->gambar4) }}" width="44px"
                                                srcset="">
                                        @endif
                                    </label>
                                </div>
                                <div class="col">
                                    <input type="radio" name="imageRadio" id="imageRadio5"
                                        onchange="GambarGanti('{{ $paket->gambar5 }}','{{ $paket->harga }}','{{ $paket->stok }}')" />
                                    <label for="imageRadio5">
                                        @if ($paket->gambar5 != null)
                                            <img src="{{ asset('images/produk/' . $paket->gambar5) }}" width="44px"
                                                srcset="">
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </center> --}}
                    </div>

                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="" data-aos="fade-up" style="">
                        <div class="card-body ">
                            <h2 style="color: gray; font-size: 20px; font-weight: bold;">
                                DETAIL PRODUK
                            </h2>

                            <div class="mb-2">
                                <h4><b id="namaProduk">
                                        <div class="skeleton-content"></div>
                                    </b></h4>
                            </div>
                            <div class="">
                                <h2 id="hargaProduk" class="text--primary" style="">
                                    <div class="skeleton-content"></div>
                                </h2>
                                <input type="hidden" id="harga_produk">
                                <hr>
                            </div>
                            {{-- <div class="chips mb-3">
                                @if ($varian != '[]')
                                    <b class="mb-2">Pilih Varian</b><br>
                                    @foreach ($varian as $key => $item)
                                        <label class="btn">
                                            <input type="radio" name="id_varian" id="{{ $key }}"
                                                value="{{ $item->id }}"
                                                onclick="varian({{ $key }}, '{{ $item->id }}','{{ $item->gambar }}', '{{ $item->harga }}', '{{ $item->stok }}', '{{ $item->warna }}')"
                                                autocomplete="off" required>
                                            <span class="btn  btn-sm text-white "
                                                style="font-size: 15px ; background: navy">{{ $item->warna }}</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    @endforeach
                                    <hr>
                                @endif
                            </div> --}}
                            <p>Varian:</p>
                            <div id="typeOptions" class="type-options mb-3"></div>

                            <div class="row">
                                <div class="col"><span id="satuanProduk">
                                        <div class="skeleton-content"></div>
                                    </span> </div>
                                {{-- <div class="col"> Berat Satuan : 20 Gram</div> --}}
                                {{-- <div class="col">Tinggi : 25 Cm </div> --}}
                            </div>
                            {{-- <div class="row mb-3">
                                <div class="col"> Lebar : 50 Cm</div>
                                <div class="col"> Panjang : 50 Cm </div>
                            </div> --}}
                            <div class="">
                                Kategori : <span style="">
                                    <b class="text--primary" id="kategoriProduk">
                                        <div class="skeleton-content"></div>
                                    </b>
                                </span>
                            </div>
                            <div class="mb-2 ">
                                <span style="" id="labelBerat">
                                    Berat :
                                    <b class="" id="beratProduk">
                                        <div class="skeleton-content"></div>
                                    </b>
                                </span>
                            </div>
                            <br>
                            <div class="mb-3 ">
                                <label for=""><b> Deskripsi </b></label> <br>
                                <span id="deskripsi">
                                    <div class="skeleton-header"></div>
                                    <div class="skeleton-content"></div>
                                    <div class="skeleton-content"></div>
                                </span>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" data-aos="fade-left">
                        <div class="card-header bg-white">
                            Atur Jumlah Dan Catatan
                        </div>
                        <div class="container">
                            <br>
                            <div class="bungkus" id="bungkus" style="display:flex">

                                <i id="sub" style="cursor: pointer;" class="sub bi bi-dash-circle"
                                    data-feather="minus-circle"></i>
                                &nbsp;
                                <input type="number" id="qty" value="1"
                                    style="width: 40px; border: 0; text-align: center; font-weight: bold;" />

                                &nbsp;
                                <i id="add" data-feather="plus-circle" class="add bi bi-plus-circle"
                                    style="cursor: pointer;"></i>
                            </div>
                            <div class="row">
                                <div class="col" id="stokView">
                                    <span style="" class="mt-2">Stok total </span>: <b> <span id="stok">
                                            <div class="custom-loader"></div>
                                        </span>
                                    </b>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex" style="justify-content: space-between">
                                <div class="">
                                    Subtotal
                                </div>
                                <div class="">
                                    <b style="" id="total_harga">
                                        <div class="custom-loader"></div>
                                    </b>
                                </div>
                            </div>
                            <br>
                            <form action="/checkout" method="get" id="handleButton">


                                {{-- <button onclick="masukKeranjang()" type="button"
                                    class="btn col-sm-12 text--primary btn-white"
                                    style="border: 1px solid #7044ef; width: 100%">+ Masukan
                                    Keranjang </button>
                                <button type="submit" class=" btn--primary form-control mt-3"> Beli
                                    Sekarang
                                </button> --}}


                            </form>
                            <hr>
                            <div class="row">
                                {{-- <div class="col">
                                    <center>
                                        @if (isset($wishList))
                                        <a style="cursor: pointer" onclick="add_wishlist()"> <i id="heart"
                                                style="color:red" class="bi bi-heart "></i>
                                            Wishlist </a>
                                    @else
                                        <a style="cursor: pointer" onclick="add_wishlist()"> <i id="heart"
                                                class="bi bi-heart "></i>
                                            Wishlist </a>
                                        @endif
                                        <input type="hidden" name="id_produk" id="id_produk" value="{{ $paket->id }}">
                                    </center>
                                </div> --}}
                                <div class="col">
                                    <center>
                                        <a onclick="alert('Coming Soon')" style="cursor: pointer;"> <i
                                                class="bi bi-heart" style="font-size: 25px;"></i>
                                        </a>
                                    </center>
                                </div>
                                <div class="col">
                                    <center>
                                        <a href="https://wa.me/6285861345339?text=Apakah Barang Masih Ada??   ""
                                            style="cursor: pointer; color:green"> <i class="bi bi-whatsapp"
                                                style="font-size: 25px;"></i>
                                        </a>
                                    </center>
                                </div>
                                <div class="col">
                                    <center>
                                        <a data-bs-toggle="modal" style="cursor: pointer;"
                                            data-bs-target="#exampleModal"> <i class="bi bi-share"
                                                style="font-size: 25px;"></i>
                                        </a>
                                    </center>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <div class="modal fade" id="bookingModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pesan <b id="namaProdukBooking"></b> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPreOrder">
                        <div class="mb-3" id="jumlahPreOrder">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" value="1" class="form-control" id="jumlah"
                                placeholder="Masukkan jumlah" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="day" disabled>
                                <input type="date" class="form-control" id="tanggal" onchange="displayDay()">
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="waktu" class="form-label">Waktu</label>
                            <input type="time" class="form-control" id="waktu" value="<?php echo date('H:i', strtotime('+7 hours')); ?>">
                        </div>
                        <div class="mb-3" id="keteranganPreOrder">
                            <label for="keterangan" class="form-label">Keterangan/Keluhan</label>
                            <textarea class="form-control" id="keterangan" rows="3" placeholder="Tambahkan keterangan/keluhan" required></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="alert alert-info" role="alert">
                                <i class="bi bi-info-circle"></i> Pesanan Anda akan diproses 2 jam setelah jam pemesanan
                                Anda
                            </div>
                        </div>
                        <button type="button" onclick="bookingPesan()" class="btn btn-primary btn-block w-100"
                            style=""> Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/axios.min.js') }}"></script>
    <script>
        function displayDay() {
            var date = new Date(document.getElementById('tanggal').value);
            var day = date.toLocaleDateString('id-ID', {
                weekday: 'long'
            });
            document.getElementById('day').value = day;
        }
    </script>
    <script>
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
        var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var member = urlParams.get('member');
        var slug = '{{ $slug }}';
        var gudang_id;
        var produkDetail;
        if (member) {
            let member_id = localStorage.getItem('member_id')
            $('#copyText').val(`https://qiwari.id/detail-produk/${slug}?member=${member_id}`)
            $('#linkAffiliate').html(`https://qiwari.id/detail-produk/${slug}?member=${member_id}`)
            $('#linkSalin').html(
                `   <a onclick="salinLink('https://qiwari.id/detail-produk/${slug}?member=${member_id}')" style="cursor: pointer">
                        <i style="font-size: 40px;color: blue" class="fas fa-copy"></i>
                        <p class="text-center">Salin Link</p>
                    </a> `
            )
            $('#linkWhatsapp').html(
                `   <a href="whatsapp://send?text=https://qiwari.id/detail-produk/${slug}?member=${member_id}" style="cursor: pointer">
                        <i style="font-size: 40px;color: green" class="bi bi-whatsapp"></i>
                        <p class="text-center">Whatsapp</p>
                    </a> `
            )
            if (member != member_id) {
                localStorage.setItem('member_id', member)
            }
            getDetailProduk()
        } else {
            let member_id = localStorage.getItem('member_id')
            var gerai_id = localStorage.getItem('gerai_id')
            if (member_id) {
                var member = localStorage.getItem('member_id')
                window.location.href = `/detail-produk/${slug}?member=${member_id}`
            }
            $('#copyText').val(`https://qiwari.id/detail-produk/${slug}`)
            $('#linkAffiliate').html(`https://qiwari.id/detail-produk/${slug}`)
            $('#linkSalin').html(
                `<a onclick="salinLink('https://qiwari.id/detail-produk/${slug}')" style="cursor: pointer">
                    <i style="font-size: 40px;color: blue" class="fas fa-copy"></i>
                    <p class="text-center">Salin Link</p>
                </a>
                `
            )
            $('#linkWhatsapp').html(
                `   <a href="whatsapp://send?text=https://qiwari.id/detail-produk/${slug}" style="cursor: pointer">
                        <i style="font-size: 40px;color: green" class="bi bi-whatsapp"></i>
                        <p class="text-center">Whatsapp</p>
                    </a> `
            )
            getDetailProduk()
        }
        // getDetailProduk()


        function masukKeranjang(detailProduk) {
            if (produkDetail.barang.kategori.kategori == "Hewan Qurban") {
                $(".custom-keranjang").attr("hidden", true);
                $(".custom-loader").attr("hidden", false);
                alert('Hewan Qurban tidak bisa dimasukkan ke keranjang');
                $(".custom-keranjang").attr("hidden", false);
                $(".custom-loader").attr("hidden", true);
            } else {
                $(".custom-keranjang").attr("hidden", true);
                $(".custom-loader").attr("hidden", false);
                var data = localStorage.getItem('listKeranjang') ? JSON.parse(localStorage.getItem('listKeranjang')) : []
                var qty = $('#qty').val()
                if (user) {
                    payload = {
                        penyimpanan_id: detailProduk.id,
                        qty: qty,
                        member_id: JSON.parse(user).karyawan.id,
                    }
                    var token = localStorage.getItem('token')
                    axios.post(`${API_URL}/v1/input/cart`, [payload], {
                            headers: {
                                'secret': API_SECRET,
                                'Author': 'bearer ' + token,
                                'device': 'web'
                            }
                        })
                        .then(function(response) {
                            $(".custom-keranjang").attr("hidden", false);
                            $(".custom-loader").attr("hidden", true);
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
                            $(".custom-keranjang").attr("hidden", false);
                            $(".custom-loader").attr("hidden", true);
                        });
                } else {
                    if (data == undefined) {
                        data.push({
                            id: detailProduk.id,
                            qty: qty,
                            jumlah: detailProduk.jumlah,
                            konversi_ket: detailProduk.konversi_ket,
                            barang: detailProduk.barang,
                            harga: detailProduk.harga,
                            member_id: detailProduk.member_id
                        })
                        localStorage.setItem('listKeranjang', JSON.stringify(data))
                    } else {
                        let existKeranjang = data.find(res => {
                            return res.id == detailProduk.id
                        })
                        if (!existKeranjang) {
                            data.push({
                                id: detailProduk.id,
                                qty: qty,
                                jumlah: detailProduk.jumlah,
                                konversi_ket: detailProduk.konversi_ket,
                                barang: detailProduk.barang,
                                harga: detailProduk.harga,
                                member_id: detailProduk.member_id
                            })
                            localStorage.setItem('listKeranjang', JSON.stringify(data))
                        } else {
                            data.map(res => {
                                if (res.id == detailProduk.id) {
                                    res.qty = qty
                                }
                            })
                            localStorage.setItem('listKeranjang', JSON.stringify(data))
                        }
                    }
                    $(".custom-keranjang").attr("hidden", false);
                    $(".custom-loader").attr("hidden", true);
                    var toastElList = [].slice.call(document.querySelectorAll('.toast-success'))
                    var toastList = toastElList.map(function(toastEl) {
                        return new bootstrap.Toast(toastEl)
                    })
                    toastList.forEach(toast => toast.show())
                }
            }


        }

        function beliSekarang(detailProduk, detailProduks) {
            if (detailProduk.barang.kategori.kategori == "Hewan Qurban") {
                window.location.href =
                    `https://wa.me/6285861345339?text=Apakah Hewan Qurban ${detailProduk.barang.nama} - ${detailProduk.barang.varian} Masih Ada?? Saya mau beli! %0A%0A Nama Saya : %0A No. HP : %0A Kota/Kab : %0A Alamat :`;
            } else {
                let data = []
                var qty = $('#qty').val()
                console.log('detailProduks', detailProduks)
                data.push({
                    id: detailProduk.id,
                    qty: qty,
                    jumlah: detailProduk.jumlah,
                    konversi_ket: detailProduk.konversi_ket,
                    barang: detailProduk.barang,
                    harga: detailProduk.harga,
                    member_id: detailProduks.member_id
                })

                localStorage.setItem('produkItem', JSON.stringify(data))
                localStorage.removeItem('dataPreOrder')

                window.location.href = `/checkout?pass_cart=n`
            }
        }

        function booking(detailProduk, detailProduks) {
            let data = []
            var qty = $('#qty').val()
            data.push({
                id: detailProduk.id,
                qty: qty,
                jumlah: detailProduk.jumlah,
                konversi_ket: detailProduk.konversi_ket,
                barang: detailProduk.barang,
                harga: detailProduk.harga,
                member_id: detailProduks.member_id
            })

            localStorage.setItem('produkItem', JSON.stringify(data))
            activeModalBooking()
            // window.location.href = `/checkout?pass_cart=n`
        }

        function bookingPesan() {
            let dataBooking = JSON.parse(localStorage.getItem('produkItem'))
            if (dataBooking[0].barang.product_type == "jasa" && $('#keterangan').val() == '') {
                alert('Keterangan/Keluhan Wajib diisi')
                return false
            }
            if (dataBooking[0].barang.product_type == "barang" && $('#jumlah').val() == '') {
                alert('Jumlah Wajib diisi')
                return false
            }
            let dataPreOrder = {
                jumlah: $('#jumlah').val(),
                tanggal_reservasi: $('#tanggal').val() + " " + $('#waktu').val(),
                keterangan: $('#keterangan').val()
            }
            localStorage.setItem('dataPreOrder', JSON.stringify(dataPreOrder))
            window.location.href = `/checkout?pass_cart=n`

        }

        function activeModalBooking() {
            let dataBooking = JSON.parse(localStorage.getItem('produkItem'))
            let waktu_preorder = 0
            if (dataBooking[0].barang.waktu_preorder > 0) {
                waktu_preorder = dataBooking[0].barang.waktu_preorder
            }
            const date = new Date();
            date.setDate(date.getDate() + waktu_preorder);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            let batasTanggal = `${year}-${month}-${day}`;
            $('#namaProdukBooking').html(dataBooking[0].barang.nama)
            $('#bookingModal').modal('toggle');
            $('#tanggal').attr('min', batasTanggal)
            $('#tanggal').val(batasTanggal)
            displayDay()
            if (dataBooking[0].barang.product_type == "jasa") {
                $('#jumlah').val('1')
                $('#jumlah').attr('readonly', true)
                $('#jumlahPreOrder').hide()
            } else {
                $('#keteranganPreOrder').hide()
            }
        }

        function cekMember() {
            axios.get(`${API_URL}/v1/affiliator/member-public/${gerai_id}`, {
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
            axios.get(`${API_URL}/v1/gudang-public?member_id=${gerai_id}`, {
                    headers: {
                        'secret': API_SECRET,
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    console.log('member', response.data.data)
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

        function getProduk() {

            axios.get(
                    `${API_URL}/v1/toko-penyimpanan-public?harga=retail&gudang_id=${gudang_id}&show_as_product=1`, {
                        headers: {
                            'secret': API_SECRET,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataProduk = response.data.data
                    let detailProduks = dataProduk.find(res => {
                        return res.slug == slug
                    })
                    let detailProduk = detailProduks.varian_barang.find(response => response.barang.slug == slug)
                    produkDetail = detailProduk
                    if (detailProduk) {
                        if (produkDetail.barang.product_type != 'jasa') {
                            $('#handleButton').html(`<button ${detailProduk.jumlah == 0 ? 'disabled' : ''} id="keranjangButton" onclick='masukKeranjang(${JSON.stringify(detailProduk)})' type="button"
                                        class="btn col-sm-12 text--primary btn-white"
                                        style="border: 1px solid #7044ef; width: 100%">
                                        <center>
                                        <div class="custom-keranjang">+ Masukan Keranjang </div>
                                        <div class="custom-loader" hidden></div>
                                        </center>
                                        </button>
                                        <button ${detailProduk.jumlah == 0 ? 'disabled' : ''} type="button" onclick='beliSekarang(${JSON.stringify(detailProduk)}, ${JSON.stringify(detailProduks)})' class=" btn--primary form-control mt-3"> Beli Sekarang
                                        </button>`);
                        }
                        $('#productImage').html(` <img src="${detailProduk.barang.photo[0] != null && detailProduk.barang.photo[0].path != null ? detailProduk.barang.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}" data-aos="fade-right" class="rounded"
                        width="100%" alt="">`);
                        $('#namaProduk').html(detailProduk.barang.nama + ` - ${detailProduk.barang.varian}`);
                        $('#hargaProduk').html(rupiah(detailProduk.harga) + " " +
                            `${detailProduk.barang.harga_coret > 0 ? `<s style="font-size: 20px; color: grey;">${rupiah(detailProduk.barang.harga_coret)}</s>` : ''}`
                        );
                        $('#total_harga').html(rupiah(detailProduk.harga));
                        $('#kategoriProduk').html(detailProduk.barang.kategori.kategori);
                        if (detailProduk.barang.kategori.kategori == "Hewan Qurban") {
                            $('#beratProduk').html("");
                            $('#labelBerat').html(`
                            Kandang :
                                <b class="">
                                    ${detailProduk.blok.blok}
                                </b>
                        `);
                        } else if (detailProduk.barang.kategori.kategori == "Terapi") {
                            $('#beratProduk').html("");
                            $('#labelBerat').html(`

                        `);
                        } else {
                            $('#beratProduk').html(Math.round(detailProduk.barang.berat) + ' gram');
                        }
                        $('#deskripsi').html(detailProduk.barang.deskripsi ? detailProduk.barang.deskripsi : "-");
                        $('#satuanProduk').html("Satuan : " + detailProduk.barang.satuan.satuan);

                        $('#harga_produk').val(detailProduk.harga)
                        if (detailProduk.barang.product_type != 'jasa') {
                            $('#stok').html(detailProduk.jumlah);
                        } else {
                            $('#bungkus').hide()
                            $('#stokView').html('')
                        }

                        for (let type of detailProduks.varian_barang) {
                            const typeOption = document.createElement("div");
                            typeOption.className = "type-option";
                            typeOption.textContent = type.barang.varian;
                            typeOption.addEventListener("click", function() {
                                $('#namaProduk').html(type.barang.nama +
                                    ` - ${type.barang.varian}`);
                                $('#productImage').html(
                                    ` <img src="${type.barang.photo[0] && type.barang.photo[0].path != null ? type.barang.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}" data-aos="fade-right" class="rounded" width="100%" alt="">`
                                );
                                if (type.barang.product_type != 'jasa') {
                                    $('#stok').html(type.jumlah);
                                } else {
                                    $('#bungkus').hide()
                                    $('#stokView').html('')
                                }
                                $('#hargaProduk').html(rupiah(type.harga) + " " +
                                    `${type.barang.harga_coret > 0 ? `<s style="font-size: 20px; color: grey;">${rupiah(type.barang.harga_coret)}</s>` : ''}`
                                );
                                $('#harga_produk').val(type.harga)
                                $('#total_harga').html(rupiah(type.harga));
                                $('#qty').val('1')
                                produkDetail = type
                                if (type.barang.product_type != 'jasa') {
                                    $('#handleButton').html(`<button ${type.jumlah == 0 ? 'disabled' : ''} id="keranjangButton" onclick='masukKeranjang(${JSON.stringify(type)})' type="button"
                                        class="btn col-sm-12 text--primary btn-white"
                                        style="border: 1px solid #7044ef; width: 100%">
                                        <center>
                                        <div class="custom-keranjang">+ Masukan Keranjang </div>
                                        <div class="custom-loader" hidden></div>
                                        </center>
                                        </button>
                                        <button ${type.jumlah == 0 ? 'disabled' : ''} type="button" onclick='beliSekarang(${JSON.stringify(type)}, ${JSON.stringify(detailProduks)})' class=" btn--primary form-control mt-3"> Beli Sekarang
                                        </button>`);
                                }
                            });
                            typeOptions.appendChild(typeOption);
                        }
                    } else {
                        javascript: history.back()
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
        }

        function getDetailProduk() {
            axios.get(`${API_URL}/v1/toko-penyimpanan/${slug}?harga=retail&show_as_product=1`, {
                    headers: {
                        'secret': API_SECRET,
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    var detailProduks = response.data
                    let detailProduk = detailProduks.varian_barang.find(response => response.barang.slug == slug)
                    produkDetail = detailProduk
                    if (produkDetail.barang.product_type != 'jasa') {
                        $('#handleButton').html(`<button ${detailProduk.jumlah == 0 ? 'disabled' : ''} id="keranjangButton" onclick='masukKeranjang(${JSON.stringify(detailProduk)})' type="button"
                                            class="btn col-sm-12 text--primary btn-white"
                                            style="border: 1px solid #7044ef; width: 100%">
                                            <center>
                                            <div class="custom-keranjang">+ Masukan Keranjang </div>
                                            <div class="custom-loader" hidden></div>
                                            </center>
                                            </button>
                                            <button ${detailProduk.jumlah == 0 ? 'disabled' : ''} type="button" onclick='beliSekarang(${JSON.stringify(detailProduk)}, ${JSON.stringify(detailProduks)})' class='${detailProduk.jumlah == 0 ? 'btn btn-secondary' : 'btn--primary' } form-control mt-3'> Beli Sekarang
                                            </button>`);
                        if (detailProduk.barang.is_pre_order) {
                            $('#handleButton').append(`
                                <button type="button" onclick='booking(${JSON.stringify(detailProduk)}, ${JSON.stringify(detailProduks)})' class='btn--primary form-control mt-3'> Pre-Order
                        </button>
                            `)
                        }
                    } else {
                        $('#handleButton').html('');
                        if (detailProduk.barang.is_pre_order) {
                            $('#handleButton').append(`
                                    <button type="button" onclick='booking(${JSON.stringify(detailProduk)}, ${JSON.stringify(detailProduks)})' class='btn--primary form-control mt-3'> Pesan Sekarang
                            </button>
                                `)
                        }
                    }
                    $('#productImage').html(` <img src="${detailProduk.barang.photo[0] != null && detailProduk.barang.photo[0].path != null ? detailProduk.barang.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}" data-aos="fade-right" class="rounded"
                        width="100%" alt="">`);
                    $('#namaProduk').html(detailProduk.barang.nama + ` - ${detailProduk.barang.varian}`);
                    // if (detailProduk.jumlah == 0) {
                    //     $('#hargaProduk').html("TERJUAL");
                    //     $('#hargaProduk').attr("class", "text-danger");
                    // } else {
                    $('#hargaProduk').html(rupiah(detailProduk.harga) + " " +
                        `${detailProduk.barang.harga_coret > 0 ? `<s style="font-size: 20px; color: grey;">${rupiah(detailProduk.barang.harga_coret)}</s>` : ''}`
                    );
                    // }
                    $('#total_harga').html(rupiah(detailProduk.harga));
                    $('#kategoriProduk').html(detailProduk.barang.kategori.kategori);
                    if (detailProduk.barang.kategori.kategori == "Hewan Qurban") {
                        $('#beratProduk').html("");
                        $('#labelBerat').html(`
                            Kandang :
                                <b class="">
                                    ${detailProduk.blok.blok}
                                </b>
                        `);
                    } else if (detailProduk.barang.kategori.kategori == "Terapi") {
                        $('#beratProduk').html("");
                        $('#labelBerat').html(`

                        `);
                    } else {
                        $('#beratProduk').html(Math.round(detailProduk.barang.berat) + ' gram');
                    }
                    $('#deskripsi').html(detailProduk.barang.deskripsi ? detailProduk.barang.deskripsi : "-");
                    $('#satuanProduk').html("Satuan : " + detailProduk.barang.satuan.satuan);

                    $('#harga_produk').val(detailProduk.harga)
                    if (detailProduk.barang.product_type != 'jasa') {
                        $('#stok').html(detailProduk.jumlah);
                    } else {
                        $('#bungkus').hide()
                        $('#stokView').html('')
                    }

                    for (let type of detailProduks.varian_barang) {
                        const typeOption = document.createElement("div");
                        typeOption.className = "type-option";
                        typeOption.textContent = type.barang.varian;
                        typeOption.addEventListener("click", function() {
                            $('#namaProduk').html(type.barang.nama +
                                ` - ${type.barang.varian}`);
                            $('#productImage').html(
                                ` <img src="${type.barang.photo[0] && type.barang.photo[0].path != null ? type.barang.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}" data-aos="fade-right" class="rounded" width="100%" alt="">`
                            );
                            if (type.barang.product_type != 'jasa') {
                                $('#stok').html(type.jumlah);
                            } else {
                                $('#bungkus').hide()
                                $('#stokView').html('')
                            }
                            // if (type.jumlah == 0) {
                            //     $('#hargaProduk').html("TERJUAL");
                            //     $('#hargaProduk').attr("class", "text-danger");
                            // } else {
                            $('#hargaProduk').html(rupiah(type.harga) + " " +
                                `${type.barang.harga_coret > 0 ? `<s style="font-size: 20px; color: grey;">${rupiah(type.barang.harga_coret)}</s>` : ''}`
                            );
                            // }
                            $('#harga_produk').val(type.harga)
                            $('#total_harga').html(rupiah(type.harga));
                            $('#qty').val('1')
                            produkDetail = type
                            if (type.barang.product_type != 'jasa') {
                                $('#handleButton').html(`<button ${type.jumlah == 0 ? 'disabled' : ''} id="keranjangButton" onclick='masukKeranjang(${JSON.stringify(type)})' type="button"
                                        class="btn col-sm-12 text--primary btn-white"
                                        style="border: 1px solid #7044ef; width: 100%">
                                        <center>
                                        <div class="custom-keranjang">+ Masukan Keranjang </div>
                                        <div class="custom-loader" hidden></div>
                                        </center>
                                        </button>
                                         <button ${type.jumlah == 0 ? 'disabled' : ''} type="button" onclick='beliSekarang(${JSON.stringify(type)}, ${JSON.stringify(detailProduks)})' class='${type.jumlah == 0 ? 'btn btn-secondary' : 'btn--primary' } form-control mt-3'> Beli Sekarang
                                        </button>`);
                                if (type.barang.is_pre_order) {
                                    $('#handleButton').append(`
                                            <button type="button" onclick='booking(${JSON.stringify(type)}, ${JSON.stringify(detailProduks)})' class='btn--primary form-control mt-3'> Pre-Order
                                            </button>
                                            `)
                                }
                            } else {
                                $('#handleButton').html('');
                                if (detailProduk.barang.is_pre_order) {
                                    $('#handleButton').append(`
                                    <button type="button" onclick='booking(${JSON.stringify(detailProduk)}, ${JSON.stringify(detailProduks)})' class='btn--primary form-control mt-3'> Pesan Sekarang
                            </button>
                                `)
                                }
                            }
                        });
                        typeOptions.appendChild(typeOption);
                    }

                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        }

        $('.add').click(function() {
            if ($(this).prev().val() < produkDetail.jumlah) {
                $(this).prev().val(+$(this).prev().val() + 1);
                let harga = $('#harga_produk').val()
                let qty = $('#qty').val()
                let total_harga = harga * qty
                $('#total_harga').val(total_harga)
                $('#total_harga').html(rupiah(total_harga))

            }
        });
        $('.sub').click(function() {
            if ($(this).next().val() > 1) {
                if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
                let harga = $('#harga_produk').val()
                let qty = $('#qty').val()
                let total_harga = harga * qty
                $('#total_harga').html(rupiah(total_harga))
                $('#total_harga').html(rupiah(total_harga))
            }
        });

        function salinLink(text) {
            const el = document.createElement('textarea');
            el.value = text;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            navigator.clipboard.writeText(text);
            alert('Link Affiliate Disalin');
        }
    </script>
@endsection
