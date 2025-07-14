@extends('layouts.member')

@section('css')
    <style>
        .radio-button {
            display: inline-block;
            position: relative;
            cursor: pointer;
        }

        .radio-button__input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .radio-button__label {
            display: inline-block;
            padding-left: 30px;
            margin-bottom: 10px;
            position: relative;
            font-size: 15px;
            color: #f2f2f2;
            font-weight: 600;
            cursor: pointer;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .radio-button__custom {
            position: absolute;
            top: 0;
            left: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #555;
            transition: all 0.3s ease;
        }

        .radio-button__input:checked+.radio-button__label .radio-button__custom {
            background-color: #7044ef;
            border-color: transparent;
            transform: scale(0.8);
            box-shadow: 0 0 20px #4c8bf580;
        }

        .radio-button__input:checked+.radio-button__label {
            color: #7044ef;
        }

        .radio-button__label:hover .radio-button__custom {
            transform: scale(1.2);
            border-color: #7044ef;
            box-shadow: 0 0 20px #4c8bf580;
        }

        #map {
            height: 200px;
        }

        /* Tambahkan gaya untuk overlay dan spinner */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endsection

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <!-- Overlay dan Spinner -->
    <div class="overlay loadingOverlay" id="loadingOverlay" hidden>
        <div class="spinner-border text-success" role="status">
        </div>
    </div>
    <br>
    <div class="container mt-3 py-5 ">
        <div class="row mt-5">
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="" id="alamatKonsumen">

                    </div>
                </div>
                <div class="card mt-4">
                    <div>
                        <div class="card-body">
                            <h6>Barang Yang di Beli</h6>
                            <div class="row mb-2" id="checkoutView">

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h6 style="font-size: 13px;" class="mt-3">Pesan Untuk Penjual</h6>
                                    <textarea class="form-control mb-2" name="pesan_penjual" id="pesan_penjual" rows="3" placeholder="" required></textarea>
                                </div>
                            </div>
                            <div class="" id="pengirimanView">
                                <div class="d-flex justify-content-between mb-3">
                                    <div class="">
                                        Opsi Pengiriman
                                    </div>
                                    <div class="" style="color: grey; text-align: right" id="keteranganpengiriman">
                                        Pilih
                                    </div>
                                </div>
                                <div class="" id="buttonPengiriman">
                                    <div class="alert alert-warning" role="alert" id="alertPengiriman">
                                        <i class="bi bi-exclamation-circle-fill"></i> Harap tentukan lokasi terlebih dahulu!
                                    </div>
                                </div>
                            </div>
                            <div class="" id="kurirView">
                            </div>
                            {{-- <label for="">Pilih pengiriman</label>
                            <select name="" class="form-control mb-2" id="">
                                <option value="">JNE</option>
                            </select> --}}
                        </div>
                    </div>

                </div>

                {{-- <div class="card mt-2">
                    <div class="card-body p-2">
                        <div class="d-flex justify-content-between">
                            <span><input type="checkbox" id="uangMukaKlik" value="2500"> Uang Muka </span> <b>Minimal Rp.
                                2500</b>
                        </div>
                    </div>
                </div> --}}

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="">
                                Metode Pembayaran
                            </div>
                            <div class="" style="color: grey; text-align: right" id="keteranganPMethod">Pilih
                            </div>
                        </div>
                        <button class="btn  text-dark form-control btn-lg" data-bs-toggle="modal" data-bs-target="#pMethod"
                            style="background: white; box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.266)">
                            <div class="d-flex justify-content-between">
                                <div class="" id="keteranganPayment">
                                    Pilih Metode Pembayaran
                                    l
                                </div>
                                <div class="">
                                    <i class="bi bi-caret-right-fill "></i>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
                <br>

            </div>
            <div class="col">
                <a href="" class="btn mb-2  form-control" type="button" data-bs-toggle="modal"
                    data-bs-target="#pilihVoucher" style="border: 1px solid green">
                    Pilih Voucher</a>

                <div class="card">
                    <div class="card-body p-1">
                        <div class="d-flex justify-content-between">
                            <span><input type="checkbox" id="donasiKlik" value="1000"> Donasi </span> <b
                                id="donasiLabel">Rp. 1000</b>
                        </div>
                    </div>
                </div>

                <div class="card rounded mt-1 ">
                    <div class="card-body">
                        <center>
                            <b>Ringkasan Belanja</b>
                        </center>
                    </div>
                    <div style="background: silver; width: 100%; height: 1px;"></div>
                    <div class="card-body">
                        {{-- <div class="mb-2"> <b style="" class="mb-3">Total Belanja</b><br></div> --}}
                        {{-- <div class="row mb-2">
                            <div class="col">
                                <b style="font-size: 14px" class="mt-3">Harga Barang</b>
                            </div>
                            <div class="col" style="text-align: right">
                                <b id="harga_barang" style="font-size: 14px" class="mt-3"></b>
                            </div>
                        </div> --}}
                        <div class="row mb-2 " id="viewTotalBerat">
                            <div class="col">
                                <b style="font-size: 14px" class="mt-3">Total Berat </b>
                            </div>
                            <div class="col" style="text-align: right">
                                <b id="total_berat" style="font-size: 14px" class="mt-3">0 gr</b>
                            </div>
                        </div>
                        <div class="row mb-2 ">
                            <div class="col">
                                <b style="font-size: 14px" class="mt-3">Total Harga (<span id="jmlBeli">0</span>
                                    barang) </b>
                            </div>
                            <div class="col" style="text-align: right">
                                <b id="total_harga" style="font-size: 14px" class="mt-3">Rp. 0</b>
                            </div>
                        </div>
                        <div class="" id="ongkosKirimView" hidden>
                            <div class="row mb-2 ongkosKirim" id="ongkosKirim">
                            </div>
                        </div>
                        <div class="row mb-2" id="diskonView" hidden>
                            <div class="col">
                                <b style="font-size: 14px" class="mt-3">Diskon </b>
                            </div>
                            <div class="col" style="text-align: right">
                                <b id="diskonValue" style="font-size: 14px" class="mt-3">Rp.0</b>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <b style="font-size: 14px" class="mt-3">Total Belanja </b>
                            </div>
                            <div class="col" style="text-align: right">
                                <b id="total_belanja" style="font-size: 14px" class="mt-3">Rp.0</b>
                            </div>
                        </div>
                        <div class="row mb-2 biaya_layanan" id="biaya_layanan">
                        </div>
                        <div class="row mb-2 biaya_aplikasi" id="biaya_aplikasi">
                        </div>
                        <div class="row mb-2 biaya_transaksi" id="biaya_transaksi">
                        </div>
                        <div class="row mb-2" id="donasiView" hidden>
                            <div class="col">
                                <b style="font-size: 14px" class="mt-3">Donasi </b>
                            </div>
                            <div class="col" style="text-align: right">
                                <b id="donasi_value" style="font-size: 14px" class="mt-3">Rp.0</b>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <b style="font-size: 20px" class="mt-3">Total Bayar </b>
                            </div>
                            <div class="col" style="text-align: right">
                                <b id="total_bayar" style="font-size: 20px" class="mt-3">Rp.0</b>
                            </div>
                        </div>
                        <form>
                            <button id="buttonBeliSekarang" type="button" onclick="beliSekarang()"
                                style="background: #4294e3;
                            background: linear-gradient(47deg, rgb(126, 213, 149) 0%, #23ca23 68%)  ;"
                                class="mt-3 lanjut col-sm-12">
                                <span class="custom-beli">Beli Sekarang</span>
                                <b class="custom-loader" hidden>transaksi diproses</b>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="pengiriman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Pengiriman</h5>
                    <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion accordion-flush pengirimanOptions" id="pengiriman">

                        {{-- <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-3">
                                    <span style="font-size: 16px;"> Dikirim </span>
                                </button>
                            </h2>
                            <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#pengiriman">
                                <div class="accordion-body">
                                    <br>
                                    <div class="jakirOptions" id="jakirOptions">

                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="kurir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih kurir</h5>
                    <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="accordion accordion-flush" id="kurir">
                        <div class="kurirOptionsExpress"></div>
                        <div class="kurirOptions"></div>

                        {{-- <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-3">
                                    <span style="font-size: 16px;"> Dikirim </span>
                                </button>
                            </h2>
                            <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#pengiriman">
                                <div class="accordion-body">
                                    <br>
                                    <div class="jakirOptions" id="jakirOptions">

                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="pMethod" tabindex="-1" aria-labelledby="exampleModalLabelPMethod"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelPMethod">Pilih Metode Pembayaran</h5>
                    <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card border-0 shadow mb-3 mt-1">
                        <div class="card-body" id="listPayment">

                            {{-- <div class="accordion accordion-flush" id="faqlist4 ">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq-content-4">
                                            <span style="font-size: 16px;">Transfer Bank (Manual)</span>
                                        </button>
                                    </h2>
                                    <div id="faq-content-4" class="accordion-collapse collapse"
                                        data-bs-parent="#faqlist4">
                                        <div class="accordion-body" id="listManualPayment">


                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="accordion accordion-flush" id="faqlist5 ">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq-content-5">
                                            <span style="font-size: 16px;">Payment Gateway </span>
                                        </button>
                                    </h2>
                                    <div id="faq-content-5" class="accordion-collapse collapse"
                                        data-bs-parent="#faqlist5">
                                        <div class="accordion-body">
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <img src="https://midtrans.com/assets/img/logo.svg?v=1707296644"
                                                        class="img-fluid" width="100%">
                                                </div>
                                                <div class="col-8 text-start" style="align-items: center; display: flex;">
                                                    <b style="color: rgb(100, 100, 100); ">
                                                        Midtrans</b>
                                                </div>
                                                <div class="col">
                                                    <div class="radio-button-container">
                                                        <div class="radio-button">
                                                            <input type="radio" value="payment_gateway"
                                                                class="radio-button__input" id="payment_gateway"
                                                                name="payment_method">
                                                            <label class="radio-button__label" for="payment_gateway">
                                                                <span class="radio-button__custom"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion accordion-flush" id="faqlist6">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq-content-6">
                                            <span style="font-size: 16px;">COD </span>
                                        </button>
                                    </h2>
                                    <div id="faq-content-6" class="accordion-collapse collapse"
                                        data-bs-parent="#faqlist6">
                                        <div class="accordion-body">
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/6192/6192245.png"
                                                        class="img-fluid">
                                                </div>
                                                <div class="col-8 text-start" style="align-items: center; display: flex;">
                                                    <b style="color: rgb(100, 100, 100); ">
                                                        COD (Bayar Di Tempat)</b>
                                                </div>
                                                <div class="col">
                                                    <div class="radio-button-container">
                                                        <div class="radio-button">
                                                            <input type="radio" value="cod"
                                                                class="radio-button__input" id="cod"
                                                                name="payment_method">
                                                            <label class="radio-button__label" for="cod">
                                                                <span class="radio-button__custom"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div> --}}


                        </div>
                        <button type="button" onclick="pilihPaymentMethod()"
                            style="background: #4294e3;
                        background: linear-gradient(47deg, rgb(126, 213, 149) 0%, #23ca23 68%)  ;"
                            class="mt-3 lanjut col-sm-12 btn-block w-100">
                            <span> Pilih </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pilihVoucher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Promo Voucher
                    </h5>
                    <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="" id="listVoucher"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pilihAlamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Alamat Pengiriman
                    </h5>
                    <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <a id="tambahAlamatURL" href="/tambah-alamat-saya" class="btn btn-primary text-white w-100 btn-lg">+
                        Tambah Alamat Baru</a><br><br>
                    <div id="listAlamatSaya">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="snapModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pembayaran Melalui Midtrans</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="urlSnapMidtrans" src="" style="width: 100%; height: 500px;"
                        frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('lib/axios.min.js') }}"></script>
    <script src="{{ asset('lib/select2.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        const rp = (number, prefix = undefined) => {
            // return new Intl.NumberFormat("id-ID", {
            //     style: "currency",
            //     currency: "IDR",
            // }).format(number);
            let isMinus = "";
            if (parseInt(number) < 0) {
                isMinus = "-";
            }
            if (number) {
                const number_string = number
                    .toString()
                    .replace(/[^,\d]/g, "")
                    .toString();
                const split = number_string.split(",");
                const sisa = split[0].length % 3;
                let rupiah = split[0].substr(0, sisa);
                const ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                let separator = "";

                // tambahkan titik jika yang di input sudah menjadi number ribuan
                if (ribuan) {
                    separator = sisa ? "." : "";
                    rupiah += separator + ribuan.join(".");
                }

                rupiah = split[1] != undefined ? `${rupiah},${split[1]}` : rupiah;
                rupiah = `${isMinus}${rupiah}`;
                return `Rp. ${rupiah}`;
            }

            return number;
        };
        var gerai;

        var is_cart;
        var total_harga;
        var pengiriman_id = 1;
        var metode_bayar = null;
        var shipment_option;
        var kodeBayar = null;
        var alamat_id;
        var alamatPengiriman;
        var donasi;
        var toko_id;
        var alamatToko;
        var is_url_payment = false;
        var redirect_url_midtrans;
        var biayaLayananValue;
        var biayaAplikasiValue;
        var donasiValue;
        var diskonVoucherEvent;
        // var diskonVoucherBarang;
        var biayaPG = 0;
        var metode_pembayaran;
        var metode_pembayaran_data;
        var alamatKu;
        var hargaOngkir;


        var params = getSearchParameters();
        if (params.pass_cart != null) {
            getCheckout(params.pass_cart)
        } else {
            javascript: history.back()
        }

        var listCheckout = localStorage.getItem('listCheckout') ? JSON.parse(localStorage.getItem('listCheckout')) : []
        var produkItem = localStorage.getItem('produkItem') ? JSON.parse(localStorage.getItem('produkItem')) : []

        created()

        function created() {
            localStorage.removeItem('hargaKurir')
            localStorage.removeItem('dataKurir')
            if (user != null) {
                $('#tambahAlamatURL').attr('href', `/tambah-alamat-saya?pass_cart=${params.pass_cart}`)
                if (produkItem[0].barang.product_type == 'jasa') {
                    $('#pengirimanView').html("")
                }
                renderAlamat()

            } else {
                if (is_cart == 'y' && listCheckout[0].barang.product_type == "jasa") {
                    $('#alamatKonsumen').html(`
                        <div class="card-header bg-white">
                            <h6>Dikirim ke</h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 style="font-size: 13px;" class="mt-3">Nama</h6>
                                    <input type="text" id="nama" class="form-control mb-2" required>
                                </div>
                                <div class="col-md-12">
                                    <h6 style="font-size: 13px;" class="mt-3">Email</h6>
                                    <input type="email" id="email" class="form-control mb-2" required>
                                </div>
                                <div class="col-md-12">
                                    <h6 style="font-size: 13px;" class="mt-3">No. Hp</h6>
                                    <input type="number" id="no_hp" class="form-control mb-2" required>
                                </div>
                                <div class="col-md-12">
                                    <h6 style="font-size: 13px;" class="mt-3">Gender</h6>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="l" value="l">
                                        <label class="form-check-label" for="male">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="p" value="p">
                                        <label class="form-check-label" for="female">Perempuan</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 style="font-size: 13px;" class="mt-3">PROVINSI</h6>
                                    <select name="provinsi_id" id="provinsi_id" class="theSelect form-control mb-2"
                                        style="width: 100%; " id="">
                                        <option value="" style="">- Pilih -</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <h6 style="font-size: 13px;" class="mt-3">KAB/KOTA</h6>
                                    <select disabled name="kab_kota_id" id="kab_kota_id" class="theSelect form-control mb-2"
                                        style="width: 100%;" id="">
                                        <option value="">- Pilih -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 style="font-size: 13px;" class="mt-3">KECAMATAN</h6>
                                    <select disabled name="kecamatan_id" id="kecamatan_id" class="theSelect form-control mb-2"
                                        style="width: 100%;" id="">
                                        <option value="">- Pilih -</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <h6 style="font-size: 13px;" class="mt-3">DESA/KELURAHAN</h6>
                                    <select disabled name="kelurahan_id" id="kelurahan_id" class="theSelect form-control mb-2"
                                        style="width: 100%;" id="">
                                        <option value="">- Pilih -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h6 style="font-size: 13px;" class="mt-3">ALAMAT LENGKAP</h6>
                                <textarea class="form-control mb-2" name="alamat" id="alamat" rows="3" placeholder="" required></textarea>
                            </div>
                            <div class="row mb-4">
                                <div class="form-group col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex justify-content-between">
                                                <label for="postal_code">Kode POS:</label>
                                                <button type="button" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Untuk isi kode pos harap pilih provinsi, kab/kota, kecamatan, dan desa/kelurahan" onclick="this.blur()">
                                                    <i class="bi bi-info-circle-fill"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control" id="postal_code" readonly>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <label for="latitude">Latitude:</label>
                                            <input type="text" class="form-control" id="latitude">
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <label for="longitude">Longitude:</label>
                                            <input type="text" class="form-control" id="longitude">
                                        </div>
                                        <div class="col-md-3 col-sm-6 ">
                                            <div id="buttonLokasiSaatIni"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-2" id="map"></div>

                        </div>
                        `)



                    $(".theSelect").select2();
                    $('#pengirimanView').html("")
                    renderMap()
                } else if (is_cart == 'n' && produkItem[0].barang.product_type == "jasa") {
                    $('#alamatKonsumen').html(`
                        <div class="card-header bg-white">
                            <h6>Dikirim ke</h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 style="font-size: 13px;" class="mt-3">Nama</h6>
                                    <input type="text" id="nama" class="form-control mb-2" required>
                                </div>
                                <div class="col-md-12">
                                    <h6 style="font-size: 13px;" class="mt-3">Email</h6>
                                    <input type="email" id="email" class="form-control mb-2" required>
                                </div>
                                <div class="col-md-12">
                                    <h6 style="font-size: 13px;" class="mt-3">No. Hp</h6>
                                    <input type="number" id="no_hp" class="form-control mb-2" required>
                                </div>
                                 <div class="col-md-12">
                                    <h6 style="font-size: 13px;" class="mt-3">Gender</h6>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="l" value="l">
                                        <label class="form-check-label" for="male">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="p" value="p">
                                        <label class="form-check-label" for="female">Perempuan</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 style="font-size: 13px;" class="mt-3">PROVINSI</h6>
                                    <select name="provinsi_id" id="provinsi_id" class="theSelect form-control mb-2"
                                        style="width: 100%; " id="">
                                        <option value="" style="">- Pilih -</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <h6 style="font-size: 13px;" class="mt-3">KAB/KOTA</h6>
                                    <select disabled name="kab_kota_id" id="kab_kota_id" class="theSelect form-control mb-2"
                                        style="width: 100%;" id="">
                                        <option value="">- Pilih -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 style="font-size: 13px;" class="mt-3">KECAMATAN</h6>
                                    <select disabled name="kecamatan_id" id="kecamatan_id" class="theSelect form-control mb-2"
                                        style="width: 100%;" id="">
                                        <option value="">- Pilih -</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <h6 style="font-size: 13px;" class="mt-3">DESA/KELURAHAN</h6>
                                    <select disabled name="kelurahan_id" id="kelurahan_id" class="theSelect form-control mb-2"
                                        style="width: 100%;" id="">
                                        <option value="">- Pilih -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h6 style="font-size: 13px;" class="mt-3">ALAMAT LENGKAP</h6>
                                <textarea class="form-control mb-2" name="alamat" id="alamat" rows="3" placeholder="" required></textarea>
                            </div>
                            <div class="row mb-4">
                                <div class="form-group col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex justify-content-between">
                                                <label for="postal_code">Kode POS:</label>
                                                <button type="button" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Untuk isi kode pos harap pilih provinsi, kab/kota, kecamatan, dan desa/kelurahan" onclick="this.blur()">
                                                    <i class="bi bi-info-circle-fill"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control" id="postal_code" readonly>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <label for="latitude">Latitude:</label>
                                            <input type="text" class="form-control" id="latitude">
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <label for="longitude">Longitude:</label>
                                            <input type="text" class="form-control" id="longitude">
                                        </div>
                                        <div class="col-md-3 col-sm-6 ">
                                            <div id="buttonLokasiSaatIni"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-2" id="map"></div>

                        </div>
                        `)

                    $(".theSelect").select2();
                    $('#pengirimanView').html("")
                    renderMap()
                } else {
                    $('#alamatKonsumen').html(`
                        <div class="card-header bg-white">
                            <h6>Dikirim ke</h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 style="font-size: 13px;" class="mt-3">Nama</h6>
                                    <input type="text" id="nama" class="form-control mb-2" required>
                                </div>
                                <div class="col-md-12">
                                    <h6 style="font-size: 13px;" class="mt-3">Email</h6>
                                    <input type="email" id="email" class="form-control mb-2" required>
                                </div>
                                <div class="col-md-12">
                                    <h6 style="font-size: 13px;" class="mt-3">No. Hp</h6>
                                    <input type="number" id="no_hp" class="form-control mb-2" required>
                                </div>
                                 <div class="col-md-12">
                                    <h6 style="font-size: 13px;" class="mt-3">Gender</h6>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="l" value="l">
                                        <label class="form-check-label" for="male">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="p" value="p">
                                        <label class="form-check-label" for="female">Perempuan</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 style="font-size: 13px;" class="mt-3">PROVINSI</h6>
                                    <select name="provinsi_id" id="provinsi_id" class="theSelect form-control mb-2"
                                        style="width: 100%; " id="">
                                        <option value="" style="">- Pilih -</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <h6 style="font-size: 13px;" class="mt-3">KAB/KOTA</h6>
                                    <select disabled name="kab_kota_id" id="kab_kota_id" class="theSelect form-control mb-2"
                                        style="width: 100%;" id="">
                                        <option value="">- Pilih -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 style="font-size: 13px;" class="mt-3">KECAMATAN</h6>
                                    <select disabled name="kecamatan_id" id="kecamatan_id" class="theSelect form-control mb-2"
                                        style="width: 100%;" id="">
                                        <option value="">- Pilih -</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <h6 style="font-size: 13px;" class="mt-3">DESA/KELURAHAN</h6>
                                    <select disabled name="kelurahan_id" id="kelurahan_id" class="theSelect form-control mb-2"
                                        style="width: 100%;" id="">
                                        <option value="">- Pilih -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h6 style="font-size: 13px;" class="mt-3">ALAMAT LENGKAP</h6>
                                <textarea class="form-control mb-2" name="alamat" id="alamat" rows="3" placeholder="" required></textarea>
                            </div>
                            <div class="row mb-4">
                                <div class="form-group col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex justify-content-between">
                                                <label for="postal_code">Kode POS:</label>
                                                <button type="button" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Untuk isi kode pos harap pilih provinsi, kab/kota, kecamatan, dan desa/kelurahan" onclick="this.blur()">
                                                    <i class="bi bi-info-circle-fill"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control" id="postal_code" readonly>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <label for="latitude">Latitude:</label>
                                            <input type="text" class="form-control" id="latitude">
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <label for="longitude">Longitude:</label>
                                            <input type="text" class="form-control" id="longitude">
                                        </div>
                                        <div class="col-md-3 col-sm-6 ">
                                            <div id="buttonLokasiSaatIni"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-2" id="map"></div>
                            <button class="btn btn-success w-100 mt-2" type="button" onclick="pilihKoordinat()"><span id="labelButton">Tentukan lokasi</span></button>
                        </div>
                        `)



                    $(".theSelect").select2();

                    renderMap()
                }

            }
            getVoucher()

            getProvinsi()
            getJasaKirim()

            if (is_cart == 'y') {
                toko_id = listCheckout[0].barang.member_id
                getPaymentMethod()
                getBiaya().then(() => {
                    if (listCheckout[0].barang.product_type == "jasa") {
                        var totalBerat = 0;
                        $('#viewTotalBerat').hide();
                    } else {
                        var totalBerat = listCheckout.reduce((a, item) => {
                            return a += (parseInt(item.barang.berat) * item.qty)
                        }, 0)
                    }
                    var totalBarang = listCheckout.reduce((a, item) => {
                        return a += parseInt(item.qty)
                    }, 0)
                    totalHarga = listCheckout.reduce((a, item) => {
                        return a += (item.harga * item.qty)
                    }, 0)

                    $("#total_berat").html(totalBerat + " gram")
                    $("#total_harga").html(rp(totalHarga))
                    $("#jmlBeli").html(totalBarang)

                    // Diskon
                    var voucher = JSON.parse(localStorage.getItem("voucher"));
                    var voucher_id = localStorage.getItem("voucher_id");

                    if (voucher_id) {
                        cancelVoucher()
                        // diskonVoucherEvent = voucher;
                        // $('#diskonView').attr('hidden', false)
                        // if (voucher.type == "nominal") {
                        //     $('#diskonValue').html("-" + rp(voucher.value))
                        //     var totalDiskon = totalHarga - voucher.value
                        // } else {
                        //     let diskon = (totalHarga * voucher.value) / 100
                        //     $('#diskonValue').html("-" + rp(diskon))
                        //     var totalDiskon = totalHarga - diskon
                        // }
                        // $("#total_belanja").html(rp(totalDiskon))

                        // totalBayar = totalDiskon
                        $("#total_belanja").html(rp(totalHarga))

                        totalBayar = totalHarga
                    } else {
                        $("#total_belanja").html(rp(totalHarga))

                        totalBayar = totalHarga
                    }

                    var biayaLayanan = biayaLayananValue
                    let totalBiayaLayanan = parseInt(totalBayar) + parseInt(biayaLayanan);

                    totalBayar = totalBiayaLayanan

                    var biayaAplikasi = biayaAplikasiValue
                    let totalBiayaAplikasi = parseInt(totalBayar) + parseInt(biayaAplikasi);

                    totalBayar = totalBiayaAplikasi


                    $("#total_bayar").html(rp(totalBayar))

                    $("#biaya_layanan").html(`
                    <div class="col">
                        <b style="font-size: 14px" class="mt-3">Biaya Layanan</b>
                    </div>
                    <div class="col" style="text-align: right">
                         <b style="font-size: 14px" class="mt-3">${rp(biayaLayanan)}</b>
                    </div>
                `)
                    $("#biaya_aplikasi").html(`
                    <div class="col">
                        <b style="font-size: 14px" class="mt-3">Biaya Jasa Aplikasi</b>
                    </div>
                    <div class="col" style="text-align: right">
                         <b style="font-size: 14px" class="mt-3">${rp(biayaAplikasi)}</b>
                    </div>
                `)

                    $("#checkoutView").html(`
                <div class="row">
                    <div class="col-md-2">
                        <img src="${listCheckout[0].barang.photo[0] != null && listCheckout[0].barang.photo[0].path != null ? listCheckout[0].barang.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}" data-aos="fade-right"
                            class="rounded mb-2" style="height: 80px; width: 110px; object-fit: cover;" alt="">
                    </div>
                    <div class="col-md-6">
                        <h5><b class="mb-3">${listCheckout[0].barang.nama} - ${listCheckout[0].barang.varian}</b>
                        </h5>
                        <h5><b> <span>${rp(listCheckout[0].harga)} (${listCheckout[0].qty})</span> </b></h5>
                    </div>
                    <div class="konten4"
                        style="display: flex; justify-content: flex-end;">
                        ${listCheckout[0].barang.product_type === 'jasa' ? '' : `<div><span>Berat: <b>${Math.round(listCheckout[0].barang.berat)} gram</b> </span></div>`}
                    </div>
                    <div style="background: rgb(228, 228, 228) ; height: 3px;">
                    </div>
                    <br>
                </div>
                `)
                    if (listCheckout.length > 1) {
                        $("#checkoutView").append(`
                            <div class="collapse row" id="collapseProduk">
                            </div>
                            <a class="text-center" style="color: black; cursor: pointer" data-bs-toggle="collapse" data-bs-target="#collapseProduk" aria-expanded="false" aria-controls="collapseProduk">
                            <span id="toggleText">Tampilkan</span> ${listCheckout.length - 1}+ Produk <i id="toggleIcon" class="bi bi-caret-down-fill"></i>
                            </a>
                            <br><br>
                        `)
                        $(document).ready(function() {
                            $('[data-bs-toggle="collapse"]').on('click', function() {
                                var toggleText = $('#toggleText');
                                var toggleIcon = $('#toggleIcon');

                                if (toggleText.text() === 'Tampilkan') {
                                    toggleText.text('Sembunyikan');
                                    toggleIcon.removeClass('bi-caret-down-fill').addClass(
                                        'bi-caret-up-fill');
                                } else {
                                    toggleText.text('Tampilkan');
                                    toggleIcon.removeClass('bi-caret-up-fill').addClass(
                                        'bi-caret-down-fill');
                                }
                            });
                        });
                        $.each(listCheckout, function(key, value) {
                            if (key > 0) {
                                $('#collapseProduk').append(`
                                        <div class="col-md-2">
                                            <img src="${value.barang.photo[0] != null && value.barang.photo[0].path != null ? value.barang.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}" data-aos="fade-right"
                                                class="rounded mb-2" style="height: 80px; width: 110px; object-fit: cover;" alt="">
                                        </div>
                                        <div class="col-md-6">
                                            <h5><b class="mb-3">${value.barang.nama} - ${value.barang.varian}</b>
                                            </h5>
                                            <h5><b> <span>${rp(value.harga)} (${value.qty})</span> </b></h5>
                                        </div>
                                    <div class="konten4"
                                    style="display: flex; justify-content: flex-end;">
                                    ${value.barang.product_type === 'jasa' ? '' : `<div><span>Berat: <b>${Math.round(value.barang.berat)} gram</b> </span></div>`}
                                </div>
                                        <div style="background: rgb(228, 228, 228) ; height: 3px;">
                                        </div> <br>
                            `)
                            }
                        })
                    }
                })

            } else {
                gerai = produkItem[0]
                toko_id = produkItem[0].barang.member_id
                getPaymentMethod()
                getBiaya().then(() => {
                    if (produkItem[0].barang.product_type == "jasa") {
                        var totalBerat = 0;
                        $('#viewTotalBerat').hide();
                    } else {
                        var totalBerat = produkItem.reduce((a, item) => {
                            return a += (parseInt(item.barang.berat) * item.qty)
                        }, 0)
                    }
                    var totalBarang = produkItem.reduce((a, item) => {
                        return a += parseInt(item.qty)
                    }, 0)
                    totalHarga = produkItem.reduce((a, item) => {
                        return a += (item.harga * item.qty)
                    }, 0)

                    $("#total_berat").html(totalBerat + " gram")
                    $("#total_harga").html(rp(totalHarga))
                    $("#jmlBeli").html(totalBarang)

                    // Diskon
                    var voucher = JSON.parse(localStorage.getItem("voucher"));
                    var voucher_id = localStorage.getItem("voucher_id");

                    if (voucher_id) {
                        cancelVoucher()
                        // diskonVoucherEvent = voucher;
                        // $('#diskonView').attr('hidden', false)
                        // if (voucher.type == "nominal") {
                        //     $('#diskonValue').html("-" + rp(voucher.value))
                        //     var totalDiskon = totalHarga - voucher.value
                        // } else {
                        //     let diskon = (totalHarga * voucher.value) / 100
                        //     $('#diskonValue').html("-" + rp(diskon))
                        //     var totalDiskon = totalHarga - diskon
                        // }
                        // $("#total_belanja").html(rp(totalDiskon))

                        // totalBayar = totalDiskon
                        $("#total_belanja").html(rp(totalHarga))

                        totalBayar = totalHarga
                    } else {
                        $("#total_belanja").html(rp(totalHarga))

                        totalBayar = totalHarga
                    }

                    var biayaLayanan = biayaLayananValue
                    let totalBiayaLayanan = parseInt(totalBayar) + parseInt(biayaLayanan);

                    totalBayar = totalBiayaLayanan

                    var biayaAplikasi = biayaAplikasiValue
                    let totalBiayaAplikasi = parseInt(totalBayar) + parseInt(biayaAplikasi);

                    totalBayar = totalBiayaAplikasi


                    $("#total_bayar").html(rp(totalBayar))

                    $("#biaya_layanan").html(`
                <div class="col">
                    <b style="font-size: 14px" class="mt-3">Biaya Layanan</b>
                </div>
                <div class="col" style="text-align: right">
                     <b  style="font-size: 14px" class="mt-3"> ${rp(biayaLayanan)}</b>
                </div>
                `)

                    $("#biaya_aplikasi").html(`
                <div class="col">
                    <b style="font-size: 14px" class="mt-3">Biaya Aplikasi</b>
                </div>
                <div class="col" style="text-align: right">
                     <b  style="font-size: 14px" class="mt-3">${rp(biayaAplikasi)}</b>
                </div>
                `)

                    $.each(produkItem, function(key, value) {
                        $('#checkoutView').append(`
                    <div class="col-md-2">
                            <img src="${value.barang.photo[0] != null ? value.barang.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}" data-aos="fade-right"
                                class="rounded mb-2" style="height: 80px; width: 110px; object-fit: cover;" alt="">
                            {{-- <b> Stok  :  <span id="stockbarang"></span></b> --}}
                        </div>
                        <div class="col-md-6">
                            <h5><b class="mb-3">${value.barang.nama} - ${value.barang.varian}</b>
                            </h5>
                            <h5><b> <span>${rp(value.harga)} (${value.qty})</span> </b></h5>
                        </div>
                   <div class="konten4"
                        style="display: flex; justify-content: flex-end;">
                        ${value.barang.product_type === 'jasa' ? '' : `<div><span>Berat: <b>${Math.round(value.barang.berat)} gram</b> </span></div>`}
                    </div>
                        <div style="background: rgb(228, 228, 228) ; height: 3px;">
                        </div>
                        ${produkItem[0].barang.product_type != 'jasa' ? '<br>' : ''}

                    `)
                    })
                })
            }

            getAlamatToko()


        }

        function getBiaya() {
            return new Promise((resolve, reject) => {
                axios.get(`https://api-bal.zuppaqu.com/v1/get-transaction-fee?member_id=${toko_id}`, {
                        headers: {
                            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                            'device': 'web'
                        }
                    })
                    .then(function(response) {
                        biayaLayananValue = response.data.find(res => res.code == 'biaya-layanan').nominal
                        biayaAplikasiValue = response.data.find(res => res.code == 'biaya-aplikasi').nominal
                        donasiValue = response.data.find(res => res.code == 'donasi').nominal
                        $('#donasiKlik').val(donasiValue)
                        $('#donasiLabel').html(rp(donasiValue))
                        resolve({
                            biayaLayananValue,
                            biayaAplikasiValue
                        });
                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                        reject(error);
                    });
            });
        }

        function renderMap() {
            var map = L.map('map').setView([-6.923786, 107.610226], 12);

            // Add Tile Layer (OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker([-6.923786, 107.610226]).addTo(map);

            // Menambahkan popup ke marker
            marker.bindPopup("<b>Tentukan lokasi!</b>").openPopup();

            // Initialize latitude and longitude input fields
            var latitudeInput = document.getElementById('latitude');
            var longitudeInput = document.getElementById('longitude');

            // Function to update input fields with coordinates
            function updateCoordinates(latlng) {
                latitudeInput.value = latlng.lat.toFixed(6);
                longitudeInput.value = latlng.lng.toFixed(6);
            }

            function updateMarker(latlng) {
                marker
                    .setLatLng([latlng.lat.toFixed(6), latlng.lng.toFixed(6)])
                    .bindPopup("<b>Lokasi yang Dipilih!</b>")
                    .openPopup();
                return false;
            };

            getLocation()


            // Event listener for click on map
            map.on('click', function(e) {
                updateCoordinates(e.latlng);
                updateMarker(e.latlng);
            });



            $('#buttonLokasiSaatIni').html(
                `<button class="btn btn-info w-100 mt-4" type="button" id="buttonLokasi">Pilih Lokasi Saat Ini</button>`
            )

            $('#buttonLokasi').on('click', function() {
                getLocation();
            });

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var lat = position.coords.latitude;
                        var lng = position.coords.longitude;
                        $('#latitude').val(lat);
                        $('#longitude').val(lng);
                        updateMarker({
                            lat: lat,
                            lng: lng
                        }); // Update marker with the function from renderMap
                    }, function() {
                        alert("Tidak dapat menentukan lokasi Anda. Pastikan GPS Anda aktif.");
                    });
                } else {
                    alert("Browser Anda tidak mendukung geolocation.");
                }
            }

        }

        function getAlamatToko() {
            axios.get(`https://api-bal.zuppaqu.com/v1/member/get-alamat-toko?member_id=${toko_id}`, {
                    headers: {
                        'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    alamatToko = response.data
                    if (user != null && alamatKu[0] != null) {
                        $('#buttonPengiriman').html(`
                          <button class="btn  text-dark form-control btn-lg" data-bs-toggle="modal"
                                data-bs-target="#pengiriman"
                                style="background: white; box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.266)">
                                <div class="d-flex justify-content-between">
                                    <div class="" id="keteranganPengiriman">
                                        Pilih Pengiriman
                                    </div>
                                    <div class="">
                                        <i class="bi bi-caret-right-fill "></i>
                                    </div>
                                </div>
                            </button>
                        `)
                    }
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    $('#alertPengiriman').html(`
                    <i class="bi bi-info-circle-fill"></i> ${error.response.data.message}
                    `)
                    alert('Maaf Toko ini belum mengatur alamatnya')
                });
        }



        function renderAlamat() {
            var token = localStorage.getItem('token')
            axios.get(`https://api-bal.zuppaqu.com/v1/member/index-alamat?member_id=${JSON.parse(user).karyawan.id}`, {
                    headers: {
                        'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                        'Author': 'bearer ' + token,
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    let alamatSaya = response.data.data
                    alamatKu = alamatSaya

                    if (alamatSaya[0]) {
                        alamat_id = alamatSaya[0].id
                        alamatPengiriman = alamatSaya[0]
                        localStorage.setItem('destination', JSON.stringify({
                            latitude: alamatSaya[0].latitude,
                            longitude: alamatSaya[0].longitude,
                            postal_code: alamatSaya[0].postal_code,
                        }))
                        renderListAlamat(alamatSaya)
                        $('#alamatKonsumen').html(`
                            <div class="card-header bg-white">
                                <h6> Dikirim Ke </h6>
                                <a href="" style="" class="text-black col-sm-3" data-bs-toggle="modal"
                                    data-bs-target="#pilihAlamat">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-11">
                                                <span class="badge"
                                                    style="background: rgb(186, 186, 186);">${alamatSaya[0].jenis_alamat}</span>
                                                <b>${alamatSaya[0].label_alamat}</b> -
                                                ${alamatSaya[0].nama_kontak}
                                                (${alamatSaya[0].nomor_kontak})
                                                <br>
                                                <span
                                                    style="color: gray; font-size: 14px;">${alamatSaya[0].alamat}, ${alamatSaya[0].desa.name}, ${alamatSaya[0].kecamatan.name}, ${alamatSaya[0].kab_kota.name}, ${alamatSaya[0].provinsi.name}</span>
                                            </div>
                                            <div class="col">
                                                <i class="bi bi-caret-right-fill float-end"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            `)
                    } else {
                        $('#alamatKonsumen').html(`
                        <div class="card-header bg-white">
                            <a href="/tambah-alamat-saya?pass_cart=${params.pass_cart}" class="btn text-white col-sm-3 btn-sm"
                            style=" background: rgb(15, 180, 15);">+ Tambah Alamat Baru</a>
                        </div>
                        `)
                    }
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });


        }

        function renderListAlamat(alamatSaya) {
            $('#listAlamatSaya').html('')
            $.each(alamatSaya, function(key, value) {
                if (value.id == alamat_id) {
                    $('#listAlamatSaya').append(`
                    <div class="card  mb-3"
                        style="background: rgba(26, 216, 26, 0.127); border: 1px solid rgb(27, 170, 27);">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="">
                                    <span class="text-bold"
                                        style="color: gray;">${value.label_alamat}</span>
                                    <h5><b>${value.nama_kontak}</b></h5>
                                    <span>${value.nomor_kontak}</span>
                                    <span>${value.label_alamat}
                                        (${value.catatan})
                                    </span>
                                </div>
                                <i class="bi bi-check text-success" style="font-size: 40px; "></i>
                            </div>
                        </div>
                    </div>
                    `)

                } else {
                    $('#listAlamatSaya').append(`
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="">
                                        <span class="text-bold"
                                            style="color: gray;">${value.label_alamat}</span>
                                        <h5><b>${value.nama_kontak}</b></h5>
                                        <span>${value.nomor_kontak}</span>
                                        <span>${value.label_alamat}
                                            (${value.catatan})
                                        </span>
                                    </div>
                                    <div>
                                        <button type="button" onclick='pilihAlamatSaya(${JSON.stringify(value)}, ${JSON.stringify(alamatSaya)})' class="btn mt-2 float-end"
                                            style="background: rgb(22, 179, 22); color: white;">Pilih</button>
                                        <a class="btn mt-2 me-2 float-end" style="background: rgb(225, 225, 0); color: white;" href="/edit-alamat-saya/${value.id}?pass_cart=${params.pass_cart}">Edit</a>
                                        <button type="button" class="btn mt-2 me-2 float-end" onclick='hapusAlamat(${value.id}, ${JSON.stringify(value)}, ${JSON.stringify(alamatSaya)})'
                                            style="background: rgb(255, 0, 0); color: white;">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `)
                }
            })

        }



        function updateMarkerLokasiIni(lat, lng) {
            var map = L.map('map').setView([lat, lng], 12);
            var marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup("<b>Lokasi Anda!</b>").openPopup();
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                marker.bindPopup("<b>Lokasi yang Dipilih!</b>").openPopup();
            });
        }

        function pilihKoordinat() {
            let listCheckout = JSON.parse(localStorage.getItem('listCheckout'))
            let produkItem = JSON.parse(localStorage.getItem('produkItem'))
            let postalCode = $('#postal_code').val()
            let lat = $('#latitude').val()
            let lng = $('#longitude').val()
            if (is_cart == "n" && produkItem[0].barang.product_type == "barang" && !postalCode) {
                alert("Harap Isi Kode Pos")
            } else if (is_cart == "y" && listCheckout[0].barang.product_type == "barang" && !postalCode) {
                alert("Harap Isi Kode Pos")
            } else if (!lat) {
                alert("Harap Isi Latitude")
            } else if (!lng) {
                alert("Harap Isi Longitude")
            } else {
                $("#labelButton").html("Terapkan lokasi koordinat")
                localStorage.setItem('destination', JSON.stringify({
                    latitude: lat,
                    longitude: lng,
                    postal_code: postalCode,
                }))
                Swal.fire('Berhasil!', 'Koordinat berhasil diterapkan', 'success');
                $('#buttonPengiriman').html(`
                      <button class="btn  text-dark form-control btn-lg" data-bs-toggle="modal"
                        data-bs-target="#pengiriman"
                        style="background: white; box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.266)">
                        <div class="d-flex justify-content-between">
                            <div class="" id="keteranganPengiriman">
                                Pilih Pengiriman
                            </div>
                            <div class="">
                                <i class="bi bi-caret-right-fill "></i>
                            </div>
                        </div>
                    </button>
                `)
            }
        }

        function pilihAlamatSaya(value, alamatSaya) {
            alamat_id = value.id
            alamatPengiriman = value
            localStorage.setItem('destination', JSON.stringify({
                latitude: value.latitude,
                longitude: value.longitude,
                postal_code: value.postal_code,
            }))
            renderListAlamat(alamatSaya)
            $('#alamatKonsumen').html(`
                <div class="card-header bg-white">
                    <a href="" style="" class="text-black col-sm-3" data-bs-toggle="modal"
                        data-bs-target="#pilihAlamat">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-11">
                                    <span class="badge"
                                        style="background: rgb(186, 186, 186);">${value.jenis_alamat}</span>
                                    <b>${value.label_alamat}</b> -
                                    ${value.nama_kontak}
                                    (${value.nomor_kontak})
                                    <br>
                                    <span
                                        style="color: gray; font-size: 14px;">${value.alamat}, ${value.desa.name}, ${value.kecamatan.name}, ${value.kab_kota.name}, ${value.provinsi.name}</span>
                                </div>
                                <div class="col">
                                    <i class="bi bi-caret-right-fill float-end"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                `)

        }

        function hapusAlamat(idAlamat, value, alamatSaya) {
            Swal.fire({
                title: 'Peringatan',
                text: 'Anda yakin ingin menghapus data alamat ini?',
                icon: 'peringatan',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    var token = localStorage.getItem('token')
                    payload = {
                        id: idAlamat
                    }

                    axios.post('https://api-bal.zuppaqu.com/v1/member/delete-alamat', payload, {
                            headers: {
                                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                                'Author': 'bearer ' + token,
                                'device': 'web',

                            }
                        })
                        .then(function(response) {
                            Swal.fire('Berhasil!', 'Alamat terhapus', 'danger');
                            renderAlamat()
                        })
                        .catch(function(error) {
                            // handle error
                            alert(error.response.data.message)
                        });


                }
            });
        }

        // Get Params
        function getSearchParameters() {
            var prmstr = window.location.search.substr(1);
            return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
        }

        function transformToAssocArray(prmstr) {
            var params = {};
            var prmarr = prmstr.split("&");
            for (var i = 0; i < prmarr.length; i++) {
                var tmparr = prmarr[i].split("=");
                params[tmparr[0]] = tmparr[1];
            }
            return params;
        }

        function getCheckout(params) {
            if (params == "y") {
                is_cart = 'y'
            } else {
                is_cart = 'n'

            }
        }

        function getTarif() {
            var kodeDari = document.getElementById('kodeDari').value;
            var kodeKe = document.getElementById('kodeKe').value;
            if (kodeDari != "" && kodeKe != "") {
                getDataTarif(kodeDari, kodeKe)
            }
        }

        function getJasaKirim() {
            axios.get(
                    `https://api-bal.zuppaqu.com/v1/p-jasa-kirim?view_all=1`, {
                        headers: {
                            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataJasaKirim = response.data
                    if (dataJasaKirim[0] != null) {
                        $.each(dataJasaKirim, function(key, value) {
                            $('.pengirimanOptions').append(`
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq-content-${key}">
                                            <span style="font-size: 16px;"> ${value.name} </span>
                                        </button>
                                    </h2>

                                    <div id="faq-content-${key}" class="accordion-collapse collapse" data-bs-parent="#pengiriman">
                                        <div class="accordion-body">
                                            <br>
                                            <div class="jakirOptions${key}" id="jakirOptions${key}">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `)
                            $.each(value.items, function(keys, data) {
                                $(`#jakirOptions${key}`).append(`
                                    <div class="pengiriman-option" data-bs-dismiss="modal" onclick='pilihJasaKirim(${JSON.stringify(data)})'>
                                        <div>
                                            <b>${data.name}</b>
                                            <p> <i> ${data.description} </i> </p>
                                        </div>
                                    </div>
                                `);
                            })
                        });
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });

        }

        function getKurir(id_jasa_kirim) {
            let listCheckout = JSON.parse(localStorage.getItem('listCheckout'))
            let produkItem = JSON.parse(localStorage.getItem('produkItem'))
            var destination = JSON.parse(localStorage.getItem('destination'))
            var itemsBarang = []
            if (is_cart == 'y') {
                listCheckout.forEach(item => {
                    itemsBarang.push({
                        "name": item.barang.nama,
                        "value": item.barang.id,
                        "quantity": item.qty,
                        "weight": Math.round(item.barang.berat)
                    })
                })
            } else {
                produkItem.forEach(item => {
                    itemsBarang.push({
                        "name": item.barang.nama,
                        "value": item.barang.id,
                        "quantity": item.qty,
                        "weight": Math.round(item.barang.berat)
                    })
                })

            }
            var payload = {
                "category": id_jasa_kirim, // for next_day, reguler, kargo
                "items": itemsBarang
            }
            if (id_jasa_kirim == "instan") {
                payload.method = "latlong"
                payload.origin = {
                    "latitude": alamatToko.latitude,
                    "longitude": alamatToko.longitude
                }
                payload.destination = {
                    "latitude": destination.latitude,
                    "longitude": destination.longitude
                }
            } else {
                payload.method = "postal_code"
                payload.origin = {
                    "postal_code": alamatToko.postal_code
                }
                payload.destination = {
                    "postal_code": destination.postal_code
                }
            }
            $('.kurirOptionsExpress').html(
                "<div class='text-center'><div class='spinner-border' role='status'><span class='sr-only'></span></div></div>"
            );
            $('.kurirOptions').html(
                "<div class='text-center'><div class='spinner-border' role='status'><span class='sr-only'></span></div></div>"
            );
            async function fetchRates() {
                try {
                    const response = await axios.post(
                        `https://api-bal.zuppaqu.com/v1/p-jasa-kirim-rates`, payload, {
                            headers: {
                                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                                'Author': 'bearer ' + token,
                                'device': 'web'
                            }
                        }
                    );
                    let dataJasaKirimRates = response.data.data;
                    if (dataJasaKirimRates[0] != null) {
                        $('.kurirOptions').html("");
                        $.each(dataJasaKirimRates, function(key, value) {
                            $('.kurirOptions').append(`
                                    <div class="kurirOptions3" id="kurirOptions3">
                                        <div class="d-flex justify-content-between pengiriman-option" data-bs-dismiss="modal" onclick='pilihKurir(${JSON.stringify(value)})'>
                                            <div>
                                                <b>${value.courier_name} (${value.courier_service_name})</b>
                                                <p>Durasi ${value.duration}</p>
                                            </div>
                                            <div>
                                                <b>${rp(value.price)}</b>
                                            </div>
                                        </div>
                                    </div>
                                `);

                        });
                    } else {
                        $('.kurirOptions').html('')
                    }
                } catch (error) {
                    console.log(error);
                }
            }

            async function fetchDirectionsExpress() {
                let payloadExpress = {
                    category: id_jasa_kirim,
                    origin: {
                        "latitude": alamatToko.latitude,
                        "longitude": alamatToko.longitude
                    },
                    destination: {
                        "latitude": destination.latitude,
                        "longitude": destination.longitude
                    }
                }
                try {
                    const response = await axios.post(
                        `https://express-api-bal.zuppaqu.com/v2/shipping-prices/calculate`, payloadExpress, {
                            headers: {
                                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                                'device': 'web'
                            }
                        }
                    );
                    let dataJasaKirimRates = response.data.results;
                    if (dataJasaKirimRates[0] != null) {
                        $('.kurirOptionsExpress').html("");

                        $.each(dataJasaKirimRates, function(key, value) {

                            $('.kurirOptionsExpress').append(`
                                <div class="kurirOptions3" id="kurirOptions3">
                                    <div class="d-flex justify-content-between pengiriman-option" data-bs-dismiss="modal" onclick='pilihKurir(${JSON.stringify(value)})'>
                                        <div>
                                            <b>${value.courier_name} (${value.courier_service_name})</b>
                                            <p>Durasi ${value.duration}</p>
                                        </div>
                                        <div>
                                            <b>${rp(value.price)}</b>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        $('.kurirOptionsExpress').html('')
                    }
                } catch (error) {
                    console.log(error);
                }
            }
            fetchDirectionsExpress();
            fetchRates();
        }


        function pilihJasaKirim(data) {
            // pengiriman_id = data.id
            if (data.value_shipment_option != "take_away") {
                $('#ongkosKirimView').attr('hidden', true)
                $('#ongkosKirim').html('')
                $("#kurirView").html(`
                    <div class="d-flex justify-content-between mt-4 mb-3">
                        <div class="">
                            Opsi Kurir
                        </div>
                        <div class="" style="color: grey; text-align: right" id="keterangankurir">
                            Pilih
                        </div>
                    </div>
                    <button class="btn  text-dark form-control btn-lg" data-bs-toggle="modal"
                        data-bs-target="#kurir"
                        style="background: white; box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.266)">
                        <div class="d-flex justify-content-between">
                            <div class="" id="keteranganKurir">
                                Pilih Kurir

                            </div>
                            <div class="">
                                <i class="bi bi-caret-right-fill "></i>
                            </div>
                        </div>
                    </button>
                    `)
                shipment_option = "dikirim"
                localStorage.setItem('kurir_id', data.id)
                getKurir(data.id)
            } else {
                $("#kurirView").html("")
                $('#ongkosKirimView').attr('hidden', false)
                $('#ongkosKirim').html('')

                $('#ongkosKirim').append(`
                    <div class="col">
                        <b style="font-size: 14px" class="mt-3">Ongkos Kirim (Ambil Sendiri)</b>
                    </div>
                    <div class="col" style="text-align: right">
                        <b id="jmlBeli" style="font-size: 14px" class="mt-3">Rp. 0</b>
                    </div>
                    `)
                shipment_option = data.value_shipment_option
            }


            $("#keteranganpengiriman").html(`
                <span class="text-dark mb-3"">
                    <b> ${data.name} </b> <br>
                </span>
                `)
            $("#keteranganPengiriman").html(`
                    ${data.name}
                `)

            // let newTotalHarga = parseInt(totalHarga) + parseInt(data.harga);

            // totalHarga = newTotalHarga

            // $("#total_harga").html(rp(totalHarga))
        }

        function pilihKurir(data) {
            let hargaKurir = localStorage.getItem('hargaKurir')
            if (hargaKurir) {
                totalHarga = totalHarga - hargaKurir
            }
            localStorage.setItem('hargaKurir', data.price)
            localStorage.setItem('dataKurir', JSON.stringify(data))
            hargaOngkir = data.price
            totalHarga = totalHarga + hargaOngkir;

            var voucher = JSON.parse(localStorage.getItem("voucher"));
            var voucher_id = localStorage.getItem("voucher_id");
            if (voucher_id) {
                if (voucher.type == "nominal") {
                    $('#diskonValue').html("-" + rp(voucher.value))
                    var totalDiskon = totalHarga - voucher.value
                } else {
                    let diskon = (totalHarga * voucher.value) / 100
                    $('#diskonValue').html("-" + rp(diskon))
                    var totalDiskon = totalHarga - diskon
                }
                $("#total_belanja").html(rp(totalDiskon))

                totalBayar = totalDiskon
            } else {
                $("#total_belanja").html(rp(totalHarga))

                totalBayar = totalHarga
            }

            var biayaLayanan = biayaLayananValue
            let totalBiayaLayanan = parseInt(totalBayar) + parseInt(biayaLayanan);

            totalBayar = totalBiayaLayanan

            var biayaAplikasi = biayaAplikasiValue
            let totalBiayaAplikasi = parseInt(totalBayar) + parseInt(biayaAplikasi);

            totalBayar = totalBiayaAplikasi

            $("#total_bayar").html(rp(totalBayar))

            $('#ongkosKirimView').attr('hidden', false)
            $('#ongkosKirim').html('')

            $('#ongkosKirim').append(`
                <div class="col">
                    <b style="font-size: 14px" class="mt-3">Ongkos Kirim (${data.courier_name})</b>
                </div>
                <div class="col" style="text-align: right">
                    <b id="jmlBeli" style="font-size: 14px" class="mt-3">${rp(data.price)}</b>
                </div>
                `)

            $("#keterangankurir").html(`
                <span class="text-dark mb-3"">
                    <b> ${data.courier_name} (${data.courier_service_name}) </b> <br>
                </span>
                `)
            $("#keteranganKurir").html(`
                    ${data.courier_name} (${data.courier_service_name})                `)
        }

        function getVoucher() {
            voucher_id = localStorage.getItem('voucher_id')
            // var dataVoucher = [{
            //         "id": 1,
            //         "name": "Diskon",
            //         "type": "nominal",
            //         "diskon": 10000,
            //         "end_time": "Berakhir 15 menit lagi"
            //     },
            //     {
            //         "id": 2,
            //         "name": "Diskon",
            //         "type": "persentase",
            //         "diskon": 15,
            //         "end_time": "Berakhir 13 menit lagi"
            //     },
            // ];
            axios.get(
                    `https://api-bal.zuppaqu.com/v1/get-available-discounts`, {
                        headers: {
                            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataVoucher = response.data
                    console.log('dataVoucher', dataVoucher)
                    if (dataVoucher != null) {
                        $.each(dataVoucher, function(key, value) {
                            $('#listVoucher').html("")
                            if (dataVoucher[0] == null) {
                                $('#listVoucher').html(`
                                    <h5 class="text-center">Belum Tersedia</h5>
                                `)
                            } else {
                                if (voucher_id) {
                                    $('#listVoucher').append(`
                                        <center class="mb-2">
                                            <span class="text-danger" style="cursor: pointer" onclick="cancelVoucher()"> <i class="bi bi-x"></i> Tidak pakai voucher</span>
                                        </center>
                                    `)
                                }
                                $.each(dataVoucher, function(key, value) {
                                    if (value.id == voucher_id) {
                                        $('#listVoucher').append(`
                                            <div class="card  mb-3"
                                                style="background: rgba(26, 216, 26, 0.127); border: 1px solid rgb(27, 170, 27);">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="">
                                                            <h5><b>${value.name} ${value.type == 'percentage' ? value.value +'%' : rp(value.value) }</b></h5>
                                                            <span>Diskon dari : ${value.owned_by}</span>
                                                        </div>
                                                        <i class="bi bi-check text-success" style="font-size: 40px; "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        `)
                                    } else {
                                        $('#listVoucher').append(`
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="">
                                                            <h5><b>${value.name} ${value.type == 'percentage' ? value.value +'%' : rp(value.value) }</b></h5>
                                                            <span>Diskon dari : ${value.owned_by}</span>
                                                        </div>

                                                        <button type="button" class="btn float-end"
                                                            style="background: rgb(22, 179, 22); color: white;" onclick='pakaiVoucher(${JSON.stringify(value)})'>Pakai</button>
                                                    </div>
                                                </div>
                                            </div>
                                        `)
                                    }
                                })
                            }
                        });
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 429) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error.response.data
                        });
                    }
                    console.log(error);
                });

        }

        function pakaiVoucher(dataVoucher) {
            if ($('#donasiKlik').is(':checked')) {
                $('#donasiKlik').click()
            }
            $('#diskonView').attr('hidden', false)
            diskonVoucherEvent = dataVoucher
            if (dataVoucher.type == "percentage") {
                let diskon = (totalHarga * dataVoucher.value) / 100
                $('#diskonValue').html("-" + rp(diskon))
                var totalDiskon = totalHarga - diskon
            } else {
                $('#diskonValue').html("-" + rp(dataVoucher.value))
                var totalDiskon = totalHarga - dataVoucher.value
            }
            $("#total_belanja").html(rp(totalDiskon))

            totalBayar = totalDiskon

            var biayaLayanan = biayaLayananValue
            let totalBiayaLayanan = parseInt(totalBayar) + parseInt(biayaLayanan);

            totalBayar = totalBiayaLayanan

            var biayaAplikasi = biayaAplikasiValue
            let totalBiayaAplikasi = parseInt(totalBayar) + parseInt(biayaAplikasi);

            if (biayaPG > 0) {
                totalBiayaAplikasi += parseInt(biayaPG)
            }

            totalBayar = totalBiayaAplikasi

            $("#total_bayar").html(rp(totalBayar))
            localStorage.setItem('voucher_id', dataVoucher.id)
            localStorage.setItem('voucher', JSON.stringify(dataVoucher))
            getVoucher()
        }

        function cancelVoucher() {
            $('#diskonView').attr('hidden', true)
            $('#diskonValue').html('')

            $("#total_belanja").html(rp(totalHarga))

            totalBayar = totalHarga

            var biayaLayanan = biayaLayananValue
            let totalBiayaLayanan = parseInt(totalBayar) + parseInt(biayaLayanan);

            totalBayar = totalBiayaLayanan

            var biayaAplikasi = biayaAplikasiValue
            let totalBiayaAplikasi = parseInt(totalBayar) + parseInt(biayaAplikasi);

            if (biayaPG > 0) {
                totalBiayaAplikasi += parseInt(biayaPG)
            }

            totalBayar = totalBiayaAplikasi

            $("#total_bayar").html(rp(totalBayar))
            diskonVoucherEvent = null;
            localStorage.removeItem('voucher_id')
            localStorage.removeItem('voucher')
            getVoucher()
        }

        function getPaymentMethod() {
            axios.get(
                    `https://api-bal.zuppaqu.com/v1/p-method?member_id=${toko_id}`, {
                        headers: {
                            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataPayment = response.data.data
                    if (dataPayment != null) {
                        $.each(dataPayment, function(key, value) {
                            $('#listPayment').append(`
                                <div class="accordion accordion-flush" id="payment${key}">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#payment-content-${key}">
                                                <span style="font-size: 16px;">${value.group}</span>
                                            </button>
                                        </h2>
                                        <div id="payment-content-${key}" class="accordion-collapse collapse"
                                            data-bs-parent="#payment${key}">
                                            <div class="accordion-body" id="listPaymentMethod${key}">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                            if (value.items.length > 0) {
                                $.each(value.items, function(kunci, data) {
                                    if (value.group == "Manual Transfer") {
                                        $(`#listPaymentMethod${key}`).append(`
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <img src="${data.image_url ? data.image_url : 'https://e7.pngegg.com/pngimages/482/107/png-clipart-house-building-computer-icons-logo-house-angle-building.png'}"
                                                        class="img-fluid">
                                                </div>
                                                <div class="col-8 text-start "
                                                    style="align-items: center; display: flex;">
                                                    <b style="color: rgb(100, 100, 100); ">

                                                        ${data.name} (${data.description})</b>
                                                </div>
                                                <div class="col">
                                                    <div class="radio-button-container">
                                                        <div class="radio-button">
                                                            <input type="radio"
                                                                class="radio-button__input" value="${value.group}" data='${JSON.stringify(data)}' id="manual_transfer${kunci}"
                                                                name="payment_method">
                                                            <label class="radio-button__label" for="manual_transfer${kunci}">
                                                                <span class="radio-button__custom"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        `)
                                    } else if (value.group == "Virtual Account") {
                                        $(`#listPaymentMethod${key}`).append(`
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <img src="${data.image ?  data.image : 'https://e7.pngegg.com/pngimages/482/107/png-clipart-house-building-computer-icons-logo-house-angle-building.png'}"
                                                        class="img-fluid">
                                                </div>
                                                <div class="col-8 text-start "
                                                    style="align-items: center; display: flex;">
                                                    <b style="color: rgb(100, 100, 100); ">
                                                        ${data.name}</b>
                                                </div>
                                                <div class="col">
                                                    <div class="radio-button-container">
                                                        <div class="radio-button">
                                                            <input type="radio"
                                                                class="radio-button__input" value="${value.group}" data='${JSON.stringify(data)}' id="virtual_account${kunci}"
                                                                name="payment_method">
                                                            <label class="radio-button__label" for="virtual_account${kunci}">
                                                                <span class="radio-button__custom"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        `)
                                    } else if (value.group == "COD") {
                                        $(`#listPaymentMethod${key}`).append(`
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/6192/6192245.png"
                                                        class="img-fluid">
                                                </div>
                                                <div class="col-8 text-start "
                                                    style="align-items: center; display: flex;">
                                                    <b style="color: rgb(100, 100, 100); ">
                                                        ${data.name}</b>
                                                </div>
                                                <div class="col">
                                                    <div class="radio-button-container">
                                                        <div class="radio-button">
                                                            <input type="radio"
                                                                class="radio-button__input" value="${value.group}" data='${JSON.stringify(data)}' id="cod"
                                                                name="payment_method">
                                                            <label class="radio-button__label" for="cod">
                                                                <span class="radio-button__custom"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        `)
                                    }
                                })
                            }
                        });
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });


        }

        function pilihPaymentMethod() {
            let paymentMethod = document.getElementsByName('payment_method');
            let selectedValue = '';
            let dataAttribute = {};
            paymentMethod.forEach(method => {
                if (method.checked) {
                    selectedValue = method.value;
                    dataAttribute = JSON.parse(method.getAttribute('data'));
                    metode_pembayaran = method.value;
                    metode_pembayaran_data = JSON.parse(method.getAttribute('data'));
                }
            });
            // Jika Manual Transfer
            if (selectedValue == "Manual Transfer") {
                metode_bayar = 'manual_transfer'
                kodeBayar = dataAttribute.code
                if ($('#donasiKlik').is(':checked')) {
                    $('#donasiKlik').click()
                }
                $("#keteranganPMethod").html(`
                <span class="text-dark mb-3"">
                        Manual Transfer <br> <b> ${dataAttribute.name} (${dataAttribute.description}) </b><br>
                </span>
                `)
                $("#keteranganPayment").html(`
                        Manual Transfer  <b> ${dataAttribute.name} (${dataAttribute.description}) </b>
                `)
                if (biayaPG > 0) {
                    totalBayar = parseInt(totalBayar) - parseInt(biayaPG)
                    $('#biaya_transaksi').html('')
                    $('#total_bayar').html(rp(totalBayar))
                }
                // Jika Virtual Account
            } else if (selectedValue == "Virtual Account") {
                metode_bayar = 'payment_gateway'
                if ($('#donasiKlik').is(':checked')) {
                    $('#donasiKlik').click()
                }
                $("#keteranganPMethod").html(`
                <span class="text-dark mb-3"">
                        Virtual Account <br> <b>${dataAttribute.name} </b><br>
                </span>
                `)
                $("#keteranganPayment").html(`
                        Virtual Account  <b>${dataAttribute.name} </b>
                `)
                $("#biaya_transaksi").html(`
                    <div class="col">
                        <b style="font-size: 14px" class="mt-3">Biaya Transaksi</b>
                    </div>
                    <div class="col" style="text-align: right">
                         <b style="font-size: 14px" class="mt-3">${dataAttribute.fee.type == 'nominal' ? rp(dataAttribute.fee.value) : 'belum difungsikan'}</b>
                    </div>
                `)
                if (dataAttribute.fee.type == 'nominal') {
                    biayaPG = dataAttribute.fee.value
                    totalBayar = parseInt(totalBayar) + parseInt(dataAttribute.fee.value)
                    $('#total_bayar').html(rp(totalBayar))
                } else {
                    alert('belum')
                }
                // Jika COD
            } else if (selectedValue == "COD") {
                alert('COMING SOON')
                metode_bayar == null
                kodeBayar == null
                if ($('#donasiKlik').is(':checked')) {
                    $('#donasiKlik').click()
                }
                if (biayaPG > 0) {
                    totalBayar = parseInt(totalBayar) - parseInt(biayaPG)
                    $('#biaya_transaksi').html('')
                    $('#total_bayar').html(rp(totalBayar))
                }
                return false
            }
            $('#pMethod').modal('hide');
        }

        function beliSekarang() {
            let listCheckout = localStorage.getItem('listCheckout') ? JSON.parse(localStorage.getItem('listCheckout')) : []
            let produkItem = localStorage.getItem('produkItem') ? JSON.parse(localStorage.getItem('produkItem')) : []
            var nama = $('#nama').val()
            var email = $('#email').val()
            var no_hp = $('#no_hp').val()
            var gender = $('input[name="gender"]:checked').val();
            var alamat = $('#alamat').val()
            var provinsi_id = $('#provinsi_id').val()
            var kab_kota_id = $('#kab_kota_id').val()
            var kecamatan_id = $('#kecamatan_id').val()
            var desa_id = $('#kelurahan_id').val()
            var postalCode = $('#postal_code').val()
            var latitude = $('#latitude').val()
            var longitude = $('#longitude').val()
            // Kondisi Login atau Tidak Login persiapan payload
            if (!user) {
                // Kondisi Lewat Keranjang atau tidak setting validasi dan total
                if (is_cart == 'y') {
                    // Kondisi Jasa atau barang
                    if (listCheckout[0].barang.product_type == 'jasa') {
                        if (nama == "" || email == "" || no_hp == "" || gender == "" || alamat == "" || provinsi_id == "" ||
                            kab_kota_id ==
                            "" ||
                            kecamatan_id == "" || desa_id == "" || postalCode == "") {
                            alert('Harap isi semua form!')
                            return false
                        } else if (metode_bayar == null) {
                            alert("Harap pilih metode pembayaran")
                            return false
                        }
                    } else {
                        if (nama == "" || email == "" || no_hp == "" || gender == "" || alamat == "" || provinsi_id == "" ||
                            kab_kota_id ==
                            "" ||
                            kecamatan_id == "" || desa_id == "" || postalCode == "" || latitude == "" || longitude == "") {
                            alert('Harap isi semua form!')
                            return false
                        } else if (shipment_option == null) {
                            alert("Harap pilih pengiriman")
                            return false
                        } else if (metode_bayar == null) {
                            alert("Harap pilih metode pembayaran")
                            return false
                        }
                    }
                    var totalBarang = listCheckout.reduce((a, item) => {
                        return a += parseInt(item.qty)
                    }, 0)
                    var totalHargaBarang = listCheckout.reduce((a, item) => {
                        return a += (item.harga * item.qty)
                    }, 0)
                } else {
                    if (produkItem[0].barang.product_type == 'jasa') {
                        if (nama == "" || email == "" || no_hp == "" || gender == "" || alamat == "" || provinsi_id == "" ||
                            kab_kota_id ==
                            "" ||
                            kecamatan_id == "" || desa_id == "" || postalCode == "") {
                            alert('Harap isi semua form!')
                            return false
                        } else if (metode_bayar == null) {
                            alert("Harap pilih metode pembayaran")
                            return false
                        }
                    } else {
                        if (nama == "" || email == "" || no_hp == "" || gender == "" || alamat == "" || provinsi_id == "" ||
                            kab_kota_id ==
                            "" ||
                            kecamatan_id == "" || desa_id == "" || postalCode == "" || latitude == "" || longitude == "") {
                            alert('Harap isi semua form!')
                            return false
                        } else if (shipment_option == null) {
                            alert("Harap pilih pengiriman")
                            return false
                        } else if (metode_bayar == null) {
                            alert("Harap pilih metode pembayaran")
                            return false
                        }

                    }

                    var totalBarang = produkItem.reduce((a, item) => {
                        return a += parseInt(item.qty)
                    }, 0)
                    var totalHargaBarang = produkItem.reduce((a, item) => {
                        return a += (item.harga * item.qty)
                    }, 0)

                }

                var checkout = {
                    kasir_id: 1,
                    tipe_konsumen_id: 1,
                    metode: 2,
                    bank: "BSI",
                    transfer: totalHarga,
                    tunai: totalHarga,
                    totalHarga: totalHargaBarang,
                    pengiriman_id: pengiriman_id,
                    nama: nama,
                    email: email,
                    no_hp: no_hp,
                    jenis_kelamin: gender,
                    alamat: alamat,
                    provinsi_id: provinsi_id,
                    kab_kota_id: kab_kota_id,
                    kecamatan_id: kecamatan_id,
                    desa_id: desa_id,
                    latitude: latitude,
                    longitude: longitude,
                    item: [],
                }

                // Kondisi Lewat Keranjang atau tidak setting item
                if (is_cart == "y") {
                    listCheckout.forEach(el => {
                        checkout.item.push({
                            penyimpanan_id: el.id,
                            asuransi: 0,
                            diskon_persen: 0,
                            diskon_rp: 0,
                            qty: el.qty,
                            barang: el.barang,
                            harga_satuan: el.harga,
                        })
                    });
                } else {
                    produkItem.forEach(el => {
                        checkout.item.push({
                            penyimpanan_id: el.id,
                            asuransi: 0,
                            diskon_persen: 0,
                            diskon_rp: 0,
                            qty: el.qty,
                            barang: el.barang,
                            harga_satuan: el.harga,
                        })
                    });
                }

                localStorage.setItem('checkout', JSON.stringify(checkout))

                let checkouts = localStorage.getItem('checkout')
                var data = JSON.parse(checkouts)
                var payload = {
                    nama: data.nama,
                    email: data.email,
                    no_hp: data.no_hp,
                    jenis_kelamin: data.jenis_kelamin,
                    transfer: data.totalHarga,
                    biaya_layanan: biayaLayananValue,
                    biaya_aplikasi: biayaAplikasiValue,
                    pengiriman_id: data.pengiriman_id,
                    shipment_option: shipment_option,
                    item: data.item,
                    alamat_pengiriman: data.alamat,
                    provinsi: data.provinsi_id,
                    kab_kota: data.kab_kota_id,
                    kecamatan: data.kecamatan_id,
                    desa: data.desa_id,
                    latitude: data.latitude,
                    longitude: data.longitude,
                }

            } else {
                // Kondisi Lewat Keranjang atau tidak setting validasi dan total
                if (is_cart == 'y') {
                    // Kondisi Jasa atau barang
                    if (listCheckout[0].barang.product_type == 'jasa') {
                        if (nama == "" || email == "" || no_hp == "" || gender == "" || alamat == "" || provinsi_id == "" ||
                            kab_kota_id ==
                            "" ||
                            kecamatan_id == "" || desa_id == "" || postalCode == "") {
                            alert('Harap isi semua form!')
                            return false
                        } else if (metode_bayar == null) {
                            alert("Harap pilih metode pembayaran")
                            return false
                        }
                    } else {
                        if (nama == "" || email == "" || no_hp == "" || gender == "" || alamat == "" || provinsi_id == "" ||
                            kab_kota_id ==
                            "" ||
                            kecamatan_id == "" || desa_id == "" || postalCode == "" || latitude == "" || longitude == "") {
                            alert('Harap isi semua form!')
                            return false
                        } else if (shipment_option == null) {
                            alert("Harap pilih pengiriman")
                            return false
                        } else if (metode_bayar == null) {
                            alert("Harap pilih metode pembayaran")
                            return false
                        }
                    }
                    var totalBarang = listCheckout.reduce((a, item) => {
                        return a += parseInt(item.qty)
                    }, 0)
                    var totalHargaBarang = listCheckout.reduce((a, item) => {
                        return a += (item.harga * item.qty)
                    }, 0)
                } else {
                    if (produkItem[0].barang.product_type == 'jasa') {
                        if (nama == "" || email == "" || no_hp == "" || gender == "" || alamat == "" || provinsi_id == "" ||
                            kab_kota_id ==
                            "" ||
                            kecamatan_id == "" || desa_id == "" || postalCode == "") {
                            alert('Harap isi semua form!')
                            return false
                        } else if (metode_bayar == null) {
                            alert("Harap pilih metode pembayaran")
                            return false
                        }
                    } else {
                        if (nama == "" || email == "" || no_hp == "" || gender == "" || alamat == "" || provinsi_id == "" ||
                            kab_kota_id ==
                            "" ||
                            kecamatan_id == "" || desa_id == "" || postalCode == "" || latitude == "" || longitude == "") {
                            alert('Harap isi semua form!')
                            return false
                        } else if (shipment_option == null) {
                            alert("Harap pilih pengiriman")
                            return false
                        } else if (metode_bayar == null) {
                            alert("Harap pilih metode pembayaran")
                            return false
                        }
                    }
                    var totalBarang = produkItem.reduce((a, item) => {
                        return a += parseInt(item.qty)
                    }, 0)
                    var totalHargaBarang = produkItem.reduce((a, item) => {
                        return a += (item.harga * item.qty)
                    }, 0)

                }

                var checkout = {
                    kasir_id: 1,
                    tipe_konsumen_id: 1,
                    metode: 2,
                    bank: "BSI",
                    transfer: totalHarga,
                    tunai: totalHarga,
                    totalHarga: totalHargaBarang,
                    pengiriman_id: pengiriman_id,
                    nama: nama,
                    email: email,
                    no_hp: no_hp,
                    jenis_kelamin: gender,
                    alamat: alamat,
                    provinsi_id: provinsi_id,
                    kab_kota_id: kab_kota_id,
                    kecamatan_id: kecamatan_id,
                    desa_id: desa_id,
                    latitude: latitude,
                    longitude: longitude,
                    item: [],
                }

                // Kondisi Lewat Keranjang atau tidak setting item
                if (is_cart == "y") {
                    listCheckout.forEach(el => {
                        checkout.item.push({
                            penyimpanan_id: el.id,
                            asuransi: 0,
                            diskon_persen: 0,
                            diskon_rp: 0,
                            qty: el.qty,
                            barang: el.barang,
                            harga_satuan: el.harga,
                        })
                    });
                } else {
                    produkItem.forEach(el => {
                        checkout.item.push({
                            penyimpanan_id: el.id,
                            asuransi: 0,
                            diskon_persen: 0,
                            diskon_rp: 0,
                            qty: el.qty,
                            barang: el.barang,
                            harga_satuan: el.harga,
                        })
                    });
                }

                localStorage.setItem('checkout', JSON.stringify(checkout))

                let checkouts = localStorage.getItem('checkout')

                var data = JSON.parse(checkouts)

                var payload = {
                    nama: alamatPengiriman.member_name,
                    email: JSON.parse(user).email,
                    no_hp: alamatPengiriman.nomor_kontak,
                    jenis_kelamin: JSON.parse(user).jenis_kelamin,
                    transfer: data.totalHarga,
                    biaya_layanan: biayaLayananValue,
                    biaya_aplikasi: biayaAplikasiValue,
                    pengiriman_id: data.pengiriman_id,
                    shipment_option: shipment_option,
                    item: data.item,
                    alamat_pengiriman: alamatPengiriman.alamat,
                    provinsi: alamatPengiriman.provinsi_id,
                    kab_kota: alamatPengiriman.kab_kota_id,
                    kecamatan: alamatPengiriman.kecamatan_id,
                    desa: alamatPengiriman.desa_id,
                    latitude: alamatPengiriman.latitude,
                    longitude: alamatPengiriman.longitude,
                }
            }

            // Cek jika ada member_id
            let member_id = localStorage.getItem('member_id')
            if (member_id) {
                payload.member_id = member_id
            }

            // Kondisi Metode Pembayaran
            if (metode_pembayaran == "Manual Transfer") {
                payload.metode_bayar = metode_bayar
                payload.kode_bayar = kodeBayar
            } else if (metode_pembayaran == "Virtual Account") {
                payload.metode_bayar = metode_bayar
                payload.biaya_pg = biayaPG
                payload.payment_channel = {
                    type: 'bank_transfer',
                    code: metode_pembayaran_data.code
                }
            }

            // Kondisi Lewat keranjang dan tipe barang setting pengiriman
            if (is_cart == "y") {
                var dataKurir = JSON.parse(localStorage.getItem('dataKurir'))
                var destination = JSON.parse(localStorage.getItem('destination'))
                var kurir_id = localStorage.getItem('kurir_id')
                if (dataKurir) {
                    if (kurir_id == "instan") {
                        payload.shipment = {
                            "mode": "latlong",
                            "latitude": destination.latitude,
                            "longitude": destination.longitude,
                            "courier_code": dataKurir.courier_code,
                            "courier_service_code": dataKurir.courier_service_code,
                            "order_note": "-"
                        }
                    } else {
                        payload.shipment = {
                            "mode": "postal_code",
                            "postal_code": destination.postal_code,
                            "courier_code": dataKurir.courier_code,
                            "courier_service_code": dataKurir.courier_service_code,
                            "order_note": "-"
                        }
                    }
                    let dataPreOrder = JSON.parse(localStorage.getItem('dataPreOrder'))
                    if (dataPreOrder) {
                        payload.transaction_type = "jasa"
                        payload.tanggal_reservasi = dataPreOrder.tanggal_reservasi
                        payload.keluhan = dataPreOrder.keterangan
                    } else {
                        payload.transaction_type = "barang"
                    }
                }
            }

            // Kondisi Tidak Lewat keranjang, setting pengiriman dan setting jasa
            if (is_cart == "n") {
                if (produkItem[0].barang.product_type == 'barang') {
                    var dataKurir = JSON.parse(localStorage.getItem('dataKurir'))
                    var destination = JSON.parse(localStorage.getItem('destination'))
                    var kurir_id = localStorage.getItem('kurir_id')
                    if (dataKurir) {
                        if (kurir_id == "instan") {
                            payload.shipment = {
                                "mode": "latlong",
                                "latitude": destination.latitude,
                                "longitude": destination.longitude,
                                "courier_code": dataKurir.courier_code,
                                "courier_service_code": dataKurir.courier_service_code,
                                "order_note": "-"
                            }
                        } else {
                            payload.shipment = {
                                "mode": "postal_code",
                                "postal_code": destination.postal_code,
                                "courier_code": dataKurir.courier_code,
                                "courier_service_code": dataKurir.courier_service_code,
                                "order_note": "-"
                            }
                        }
                    }
                    let dataPreOrder = JSON.parse(localStorage.getItem('dataPreOrder'))
                    if (dataPreOrder) {
                        payload.transaction_type = "jasa"
                        payload.tanggal_reservasi = dataPreOrder.tanggal_reservasi
                        payload.keluhan = dataPreOrder.keterangan
                    } else {
                        payload.transaction_type = "barang"
                    }
                } else {
                    let dataPreOrder = JSON.parse(localStorage.getItem('dataPreOrder'))
                    if (dataPreOrder) {
                        payload.transaction_type = "jasa"
                        payload.tanggal_reservasi = dataPreOrder.tanggal_reservasi
                        payload.keluhan = dataPreOrder.keterangan
                    } else {
                        payload.transaction_type = "barang"
                    }
                }
            }

            if (diskonVoucherEvent != null) {
                // const ids = diskonVoucherEvent.map(item => item.id);
                // payload.diskon = {
                //     id: diskonVoucherEvent.id,
                //     type: diskonVoucherEvent.type,
                //     value: diskonVoucherEvent.value
                // }
                payload.event_diskon_ids = [diskonVoucherEvent.id]
            }

            if ($('#donasiKlik').is(':checked')) {
                payload.donasi = donasiValue
            }

            if (hargaOngkir) {
                payload.ongkir = hargaOngkir
            }

            // console.log('payload', payload)
            // return false
            // Kondisi Login Atau Tidak Login Checkout
            if (user != null) {
                $("#buttonBeliSekarang").attr("disabled", true);
                $("#buttonBeliSekarang").css("background",
                    "linear-gradient(47deg, rgb(109, 110, 109) 0%, #424342 68%)");
                $(".custom-beli").attr("hidden", true);
                $(".custom-loader").attr("hidden", false);
                $(".loadingOverlay").attr("hidden", false);
                var token = localStorage.getItem('token')
                axios.post('https://api-bal.zuppaqu.com/v1/checkout', payload, {
                        headers: {
                            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                            'Author': 'bearer ' + token,
                            'device': 'web'
                        }
                    })
                    .then(function(response) {
                        $(".loadingOverlay").attr("hidden", true);
                        var dataTransaksi = localStorage.getItem('dataTransaksi') ? JSON.parse(localStorage
                            .getItem(
                                'dataTransaksi')) : []
                        dataTransaksi.push(response.data)
                        localStorage.setItem('dataTransaksi', JSON.stringify(dataTransaksi))
                        localStorage.setItem('invoice', JSON.stringify(response.data))
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Transaksi berhasil dilakukan!'
                        });
                        let noInvoice = response.data.no_invoice.replace(/\//g, '-');
                        window.location.href = `/pay/${noInvoice}`

                    })
                    .catch(function(error) {
                        // handle error
                        alert(error)
                        console.log(error);
                        $("#buttonBeliSekarang").attr("disabled", false);
                        $("#buttonBeliSekarang").css("background",
                            "linear-gradient(47deg, rgb(126, 213, 149) 0%, #23ca23 68%)  ;");
                        $(".custom-beli").attr("hidden", false);
                        $(".custom-loader").attr("hidden", true);
                        $(".loadingOverlay").attr("hidden", true);
                    });
            } else {
                $("#buttonBeliSekarang").attr("disabled", true);
                $("#buttonBeliSekarang").css("background",
                    "linear-gradient(47deg, rgb(109, 110, 109) 0%, #424342 68%)");
                $(".custom-beli").attr("hidden", true);
                $(".custom-loader").attr("hidden", false);
                $(".loadingOverlay").attr("hidden", false);
                axios.post('https://api-bal.zuppaqu.com/v1/checkout', payload, {
                        headers: {
                            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                            'device': 'web'
                        }
                    })
                    .then(function(response) {
                        $(".loadingOverlay").attr("hidden", true);
                        var dataTransaksi = localStorage.getItem('dataTransaksi') ? JSON.parse(localStorage
                            .getItem(
                                'dataTransaksi')) : []
                        dataTransaksi.push(response.data)
                        localStorage.setItem('dataTransaksi', JSON.stringify(dataTransaksi))
                        localStorage.setItem('invoice', JSON.stringify(response.data))
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Transaksi berhasil dilakukan!'
                        });
                        let noInvoice = response.data.no_invoice.replace(/\//g, '-');
                        window.location.href = `/pay/${noInvoice}`
                    })
                    .catch(function(error) {
                        $("#buttonBeliSekarang").attr("disabled", false);
                        $("#buttonBeliSekarang").css("background",
                            "linear-gradient(47deg, rgb(126, 213, 149) 0%, #23ca23 68%)  ;");
                        $(".custom-beli").attr("hidden", false);
                        $(".custom-loader").attr("hidden", true);
                        $(".loadingOverlay").attr("hidden", true);
                        // handle error
                        console.log(error);
                        alert(error.response.data.error)
                    });
            }
        }





        // Get Provinsi
        async function getProvinsi() {
            try {
                const response = await axios.get('https://api-bal.zuppaqu.com/v1/wilayah/provinsi', {
                    headers: {
                        'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                        'device': 'web'
                    }
                });
                let dataProvinsi = response.data.data;
                $('#provinsi_id').html('<option value="">- Pilih -</option>');
                $.each(dataProvinsi, function(key, value) {
                    $("#provinsi_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            } catch (error) {
                // handle error
                console.log(error);
            }
        }

        // Get Kab Kota
        $(document).ready(async function() {
            $('#donasiKlik').change(async function() {
                if (this.checked) {
                    $('#donasiView').attr('hidden', false)
                    $('#donasi_value').html(rp(this.value))
                    var totalDonasi = parseInt(totalBayar) + parseInt(this.value)
                    $('#total_bayar').html(rp(totalDonasi))
                } else {
                    $('#donasiView').attr('hidden', true)
                    $('#total_bayar').html(rp(totalBayar))
                }
            });
            $('#uangMukaKlik').change(async function() {
                if (this.checked) {
                    alert('coming soon')
                } else {}
            });
            $('#provinsi_id').on('change', async function() {
                var id_provinsi = this.value;
                try {
                    const response = await axios.get(
                        `https://api-bal.zuppaqu.com/v1/wilayah/kab-kota?id_provinsi=${id_provinsi}`, {
                            headers: {
                                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                                'device': 'web'
                            }
                        }
                    );
                    let dataKabKota = response.data.data
                    $("#kab_kota_id").attr("disabled", false);
                    $('#kab_kota_id').html('<option value="">- Pilih -</option>');
                    $.each(dataKabKota, function(key, value) {
                        $("#kab_kota_id").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                } catch (error) {
                    // handle error
                    console.log(error);
                }
            });

            // Get Kecamatan
            $('#kab_kota_id').on('change', async function() {
                var id_kab_kota = this.value;
                try {
                    const response = await axios.get(
                        `https://api-bal.zuppaqu.com/v1/wilayah/kecamatan?id_kab_kota=${id_kab_kota}`, {
                            headers: {
                                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                                'device': 'web'
                            }
                        }
                    );
                    let dataKabKota = response.data.data
                    $("#kecamatan_id").attr("disabled", false);
                    $('#kecamatan_id').html('<option value="">- Pilih -</option>');
                    $.each(dataKabKota, function(key, value) {
                        $("#kecamatan_id").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                } catch (error) {
                    // handle error
                    console.log(error);
                }
            });
            // Get Desa Kelurahan
            $('#kecamatan_id').on('change', async function() {
                var id_kecamatan = this.value;
                try {
                    const response = await axios.get(
                        `https://api-bal.zuppaqu.com/v1/wilayah/kelurahan?id_kecamatan=${id_kecamatan}`, {
                            headers: {
                                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                                'device': 'web'
                            }
                        }
                    );
                    let dataKabKota = response.data.data
                    $("#kelurahan_id").attr("disabled", false);
                    $('#kelurahan_id').html('<option value="">- Pilih -</option>');
                    $.each(dataKabKota, function(key, value) {
                        $("#kelurahan_id").append('<option data-postal-code="' + value
                            .postal_code + '" value="' + value.id + '">' + value
                            .name +
                            '</option>');
                    });
                } catch (error) {
                    // handle error
                    console.log(error);
                }
            });

            $('#kelurahan_id').on('change', async function() {
                var id_kelurahan = this.value;
                var postalCode = $('#kelurahan_id option:selected').attr('data-postal-code');
                $('#postal_code').val(postalCode)
                pilihKoordinat()

            });

        });

        function tambahAlamat() {
            let payload = {
                member_id: JSON.parse(user).karyawan.id,
                label_alamat: $('#label_alamat').val(),
                provinsi_id: parseInt($('#provinsi_id').val()),
                kab_kota_id: parseInt($('#kab_kota_id').val()),
                kecamatan_id: parseInt($('#kecamatan_id').val()),
                desa_id: parseInt($('#kelurahan_id').val()),
                alamat: $('#alamat_lengkap').val(),
                nomor_kontak: $('#nomor_penerima').val(),
                nama_kontak: $('#nama_penerima').val(),
                jenis_alamat: $('#jenis_alamat').val(),
                catatan: $('#catatan').val(),
            }
            var token = localStorage.getItem('token')
            axios.post('https://api-bal.zuppaqu.com/v1/member/input-alamat', payload, {
                    headers: {
                        'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                        'Author': 'bearer ' + token,
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    alert("Berhasil menambahkan Alamat")
                    renderAlamat()
                    $('#alamatBaru').modal('hide');
                })
                .catch(function(error) {
                    alert(error.response.data.message)
                    $('#alamatBaru').modal('hide');
                });

        }
    </script>
@endsection


<style>
    .badge {
        background: rgba(0, 53, 226, 0.398);
        color: rgb(0, 15, 113);
        padding: 10px;
        border-radius: 10px;
    }

    .lanjut {
        display: inline-block;
        border-radius: 4px;
        background-color: rgb(57, 187, 40);
        border: none;
        color: #FFFFFF;
        text-align: center;
        font-size: 17px;
        padding: 10px;
        width: 150px;
        transition: all 0.5s;
        cursor: pointer;
        /* margin: 5px; */
    }

    .lanjut span {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: 0.5s;
    }

    .lanjut span:after {
        content: '»';
        position: absolute;
        opacity: 0;
        top: 0;
        right: -15px;
        transition: 0.5s;
    }

    .lanjut:hover span {
        padding-right: 15px;
    }

    .lanjut:hover span:after {
        opacity: 1;
        right: 0;
    }

    /* Custom styling */
    .pengiriman-option {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
        transition: background-color 0.3s;
    }

    .pengiriman-option:hover {
        background-color: #f8f9fa;
    }

    .pengiriman-option img {
        max-width: 40px;
        max-height: 40px;
        border-radius: 5px;
    }
</style>
