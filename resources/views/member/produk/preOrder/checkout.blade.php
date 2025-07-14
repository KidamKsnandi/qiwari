@extends('layouts.member')

@section('content')
    <div class="container mt-4" style="padding-top: 120px">
        <!-- Ringkasan Pesanan -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header  text-white" style="background-color: #23ca23">
                <h5 class="mb-0">Ringkasan Pesanan</h5>
                <a href="/member/pre-order" class="text-white">Tambah pesanan</a>
            </div>
            <div class="card-body">
                <div id="listPesanan">

                </div>
                <!-- Diskon -->
                {{-- <div class="alert alert-warning mt-3">
                    <span>Diskon Rp10.000 dengan GrabUnlimited. Bisa digabung promo lain.</span>
                    <a href="#" class="text-primary float-end">Tambahkan</a>
                </div> --}}
            </div>
        </div>

        <!-- Pilih Pengiriman -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header  text-white" style="background-color: #23ca23">
                <h5 class="mb-0">Pilih Pengiriman</h5>
            </div>
            <div class="card-body">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="shipping" id="regular" checked>
                    <label class="form-check-label" for="regular">
                        Reguler (Rp10.000)
                    </label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="shipping" id="express">
                    <label class="form-check-label" for="express">
                        Ekspres (Rp20.000)
                    </label>
                </div>
            </div>
        </div>

        <!-- Pilih Pembayaran -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header  text-white" style="background-color: #23ca23">
                <h5 class="mb-0">Pilih Pembayaran</h5>
            </div>
            <div class="card-body">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment" id="ovo" checked>
                    <label class="form-check-label" for="ovo">
                        OVO
                    </label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="payment" id="bank_transfer">
                    <label class="form-check-label" for="bank_transfer">
                        Transfer Bank
                    </label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="payment" id="credit_card">
                    <label class="form-check-label" for="credit_card">
                        Kartu Kredit/Debit
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar Mengambang -->
    <div class="bottom-bar fixed-bottom bg-warning text-white p-3 shadow-lg ">
        <div class="d-flex justify-content-between">
            <div>
                {{-- <p class="mb-0">Subtotal (Termasuk pajak)</p>
                <h5>Rp455.205</h5> --}}
                <p class="mb-0">Total Harga</p>
                <b>
                    <h4 class="text-success" id="totalHarga">Rp.0</h4>
                </b>
            </div>
            <button class="btn btn-success btn-lg align-self-end" onclick="alert('coming soon')">Pesan</button>
        </div>
    </div>

    <!-- CSS -->
    <style>
        /* Mengatur jarak bottom bar untuk mobile */
        @media (max-width: 768px) {
            .bottom-bar {
                bottom: 65px;
                /* Mengangkat bar lebih ke atas di mobile */
            }
        }
    </style>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/axios.min.js') }}"></script>
    <script>
        const rp = (number, prefix = undefined) => {
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

        const created = () => {
            let dataPreOrder = localStorage.getItem('listPreOrder') ? JSON.parse(localStorage.getItem('listPreOrder')) :
                []
            if (dataPreOrder.length == 0) {
                window.location.href = '/member/pre-order'
            }
            getListPesanan()
        }

        const getListPesanan = () => {
            let dataPreOrder = localStorage.getItem('listPreOrder') ? JSON.parse(localStorage.getItem('listPreOrder')) :
                []
            $.each(dataPreOrder, function(key, value) {
                $('#listPesanan').append(`
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mt-2">
                    <div>
                        <span class="fw-bold">${value.qty}x ${value.barang.nama}</span>
                    </div>
                    <div class="text-end">
                        <span class="text-success fw-bold">${rp(value.harga * value.qty)}</span><br>
                        {{-- <del class="text-muted">Rp33.500</del> --}}
                    </div>
                </div>
            `)
            })
            let totalHarga = dataPreOrder.reduce((a, value) => {
                return a += (value.harga * value.qty)
            }, 0)
            $('#totalHarga').html(rp(totalHarga))
        }

        created()
    </script>
@endsection
