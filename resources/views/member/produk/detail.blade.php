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
                    <div class="" id="productImage">
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
                            <h2 style="color: gray; font-size: 13px; font-weight: bold;">
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
                            {{-- <p>Varian:</p>
                            <div id="typeOptions" class="type-options mb-3"></div> --}}

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
                                Berat : <span style="">
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
                        Kojic-San
                    </div>
                </center>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    {{-- <button  onclick="sharlinkwa()">sa</button> --}}
                                    <center> <i onclick="sharlinkwa()" style="cursor: pointer;font-size: 40px; color: green"
                                            class=" bi bi-whatsapp"></i></center>
                                    <p onclick="sharlinkwa()" class="text-center">Whatsapp</p>
                                </div>
                                <div class="col"><br>
                                    <center> <a id="linksalin">
                                            <i onclick="copyToClipboard()" style="font-size: 40px;color: blue"
                                                class="fas fa-copy"></i></center>
                                    <p class="text-center">Salin Link</p>
                                    </a>
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
        var slug = '{{ $slug }}'
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var member = urlParams.get('member')
        if (member) {
            let member_id = localStorage.getItem('member_id')
            if (member != member_id) {
                localStorage.setItem('member_id', member)
            }
            window.location.href = `/affiliate/detail/${slug}?member=${member}`
        }
        getDetailProduk()

        function getDetailProduk() {

            axios.get(`${API_URL}/v1/barang-public/${slug}?harga=retail`, {
                    headers: {
                        'secret': API_SECRET,
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    let detailProduk = response.data
                    $('#handleButton').html(`<button id="keranjangButton" onclick='masukKeranjang(${JSON.stringify(detailProduk)})' type="button"
                                    class="btn col-sm-12 text--primary btn-white"
                                    style="border: 1px solid #7044ef; width: 100%">
                                    <center>
                                    <div class="custom-keranjang">+ Masukan Keranjang </div>
                                    <div class="custom-loader" hidden></div>
                                    </center>
                                    </button>
                                    <button type="button" onclick='beliSekarang(${JSON.stringify(detailProduk)})'' class=" btn--primary form-control mt-3"> Beli Sekarang
                                    </button>`);
                    $('#productImage').html(` <img src="${detailProduk.photo[0] != null ? detailProduk.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}" data-aos="fade-right" class="rounded"
                        width="100%" alt="">`);
                    $('#namaProduk').html(detailProduk.nama);
                    $('#hargaProduk').html(rupiah(detailProduk.harga));
                    $('#total_harga').html(rupiah(detailProduk.harga));
                    $('#kategoriProduk').html(detailProduk.kategori.kategori);
                    $('#beratProduk').html(detailProduk.berat);
                    $('#deskripsi').html(detailProduk.deskripsi ? detailProduk.deskripsi : "-");
                    $('#satuanProduk').html("Satuan : " + detailProduk.satuan.satuan);

                    $('#harga_produk').val(detailProduk.harga)

                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        }

        function masukKeranjang(detailProduk) {
            $(".custom-keranjang").attr("hidden", true);
            $(".custom-loader").attr("hidden", false);
            var data = localStorage.getItem('listKeranjang') ? JSON.parse(localStorage.getItem('listKeranjang')) : []
            var qty = $('#qty').val()
            // console.log('data', detailProduk)
            // console.log('qty', qty)

            if (data == undefined) {
                data.push({
                    id: detailProduk.id,
                    photo: detailProduk.photo,
                    nama: detailProduk.nama,
                    harga_dasar: detailProduk.harga,
                    qty: qty,
                    varian: detailProduk.varian
                })
                localStorage.setItem('listKeranjang', JSON.stringify(data))
            } else {
                let existKeranjang = data.find(res => {
                    return res.id == detailProduk.id
                })
                if (!existKeranjang) {
                    data.push({
                        id: detailProduk.id,
                        photo: detailProduk.photo,
                        nama: detailProduk.nama,
                        harga_dasar: detailProduk.harga,
                        qty: qty,
                        varian: detailProduk.varian
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

        function beliSekarang(detailProduk) {
            let data = []
            var qty = $('#qty').val()

            data.push({
                id: detailProduk.id,
                photo: detailProduk.photo,
                nama: detailProduk.nama,
                harga_dasar: detailProduk.harga,
                qty: qty,
                varian: detailProduk.varian
            })

            localStorage.setItem('produkItem', JSON.stringify(data))

            window.location.href = `/checkout?pass_cart=n`
        }

        $('.add').click(function() {
            // if ($(this).prev().val() < 3) {
            $(this).prev().val(+$(this).prev().val() + 1);
            let harga = $('#harga_produk').val()
            let qty = $('#qty').val()
            let total_harga = harga * qty
            $('#total_harga').val(total_harga)
            $('#total_harga').html(rupiah(total_harga))

            // }
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
    </script>
@endsection
