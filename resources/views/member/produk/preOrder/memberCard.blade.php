@extends('layouts.member')

@section('css')
    <style>
        #menuBottom a {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-4" style="padding-top: 120px">
        <!-- Ringkasan Pesanan -->
        <div class="card mb-4 shadow-sm border-0">
            <!-- Kartu Member Header -->
            <div class="card-header text-white" style="background-color: #23ca23; border-radius: 10px 10px 0 0;">
                <h4 class="mb-0 text-center">Kartu Membership Pre-Order</h4>
            </div>

            <!-- Kartu Member Body -->
            <div class="card-body p-4" style="background-color: #f8f9fa;">
                <div id="listPesanan" class="mb-3">
                </div>

                <!-- Jika belum mendaftar sebagai member -->
                <div id="belumMember" class="text-center p-3"
                    style="background-color: #ffebcc; border: 1px solid #ffc107; border-radius: 10px;">
                    <h5 class="text-warning">Belum menjadi member?</h5>
                    <p>Pilih produk untuk mendapatkan kartu member dan menikmati berbagai keuntungan.</p>
                    <a href="/member/pre-order/produk" class="btn btn-primary">Pilih Produk</a>
                </div>

                <!-- Jika sudah menjadi member, tampilkan detail pesanan -->
                <div id="sudahMember" style="display: none;">
                    <div class="card mb-3 shadow-sm" style="border: 1px solid #007bff; border-radius: 10px;">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Detail Pesanan</h5>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Tanggal Update Pesanan:</strong> <span id="tanggal"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Nama:</strong> <span id="nama"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>No. Hp:</strong> <span id="no_hp"></span>
                                </li>
                                {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Email:</strong> <span id="email"></span>
                                </li> --}}
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Periode PO:</strong> <span id="periode_po"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Metode Pengiriman:</strong> <span id="metode_pengiriman"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Metode Pembayaran:</strong> <span id="metode_bayar"></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Alamat:</strong> <span id="alamat"></span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Diskon -->
                    {{-- <div class="alert alert-warning mt-3 d-flex justify-content-between align-items-center"
                        style="border-radius: 10px;">
                        <span>Diskon Rp10.000 dengan GrabUnlimited. Bisa digabung promo lain.</span>
                        <a href="#" class="text-primary">Tambahkan</a>
                    </div> --}}
                </div>
            </div>

            <!-- Kartu Member Footer -->
            <a href="/member/pre-order/produk/ubah" id="tombolUbah" class="text-white">
                <div class="card-footer text-center" style="background-color: #007bff; border-radius: 0 0 10px 10px;">
                    <span>Ubah Pesanan</span>
                </div>
            </a>
        </div>



        <!-- Pilih Pengiriman -->
        {{-- <div class="card mb-4 shadow-sm border-0">
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
        </div> --}}

        <!-- Pilih Pembayaran -->
        {{-- <div class="card mb-4 shadow-sm border-0">
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
        </div> --}}
    </div>

    <!-- Bottom Bar Mengambang -->
    <div class="bottom-bar fixed-bottom bg-success text-white p-3 shadow-lg">
        <div class="d-flex justify-content-between flex-column flex-md-row">
            <div>
                {{-- <p class="mb-0">Subtotal (Termasuk pajak)</p>
                <h5>Rp455.205</h5> --}}
                <b class="mb-0"> <strong> Estimasi Total Belanja </strong></b>
                <b>
                    <strong>
                        <h4 class="text-white" id="totalHarga">Rp.0</h4>
                    </strong>
                </b>
            </div>
            <button class="btn btn-light text-dark btn-lg align-self-end mt-3 mt-md-0"
                onclick="alert('coming soon')">Download
                Kartu</button>
        </div>
    </div>

    <!-- CSS -->
    {{-- <style>
        @media (max-width: 768px) {
            .bottom-bar {
                bottom: 65px;
            }
        }
    </style> --}}



    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/axios.min.js') }}"></script>
    <script>
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
        var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
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
            // let dataPreOrder = localStorage.getItem('listPreOrder') ? JSON.parse(localStorage.getItem('listPreOrder')) :
            //     []
            // if (dataPreOrder.length == 0) {
            //     window.location.href = '/member/pre-order/produk'
            // }
            // getListPesanan()
            getPOMembership()
            // Jika sudah menjadi member


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

        const getPOMembership = async () => {
            try {
                const response = await axios.get(`${API_URL}/v1/po-membership`, {
                    params: {
                        member_id: JSON.parse(user).member_id
                    },
                    headers: {
                        'secret': API_SECRET,
                        'Author': 'bearer ' + token,
                        'device': 'web'
                    }
                });
                let dataPOMembership = response.data.data[0];
                if (dataPOMembership != null) {
                    document.getElementById('sudahMember').style.display = 'block';
                    document.getElementById('belumMember').style.display = 'none';
                } else {
                    document.getElementById('sudahMember').style.display = 'none';
                    document.getElementById('belumMember').style.display = 'block';
                    document.getElementById('tombolUbah').style.display = 'none';

                    return false;
                }
                let itemsBarang = dataPOMembership.items
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    // hour: '2-digit',
                    // minute: '2-digit',
                    // second: '2-digit'
                };
                const formattedDate = new Date(dataPOMembership.tanggal).toLocaleDateString('id-ID', options);
                $('#tanggal').text(formattedDate);
                $('#nama').text(dataPOMembership.nama ?? '-');
                $('#no_hp').text(dataPOMembership.no_hp ?? '-');
                // $('#email').text(dataPOMembership.email ?? '-');
                $('#periode_po').text(dataPOMembership.periode_po ?? '-');
                $('#metode_pengiriman').text(dataPOMembership.metode_pengiriman == 1 ? 'Diambil' : "Dikirim");
                if (dataPOMembership.metode_bayar == 1) {
                    $('#metode_bayar').text('Cash');
                } else {
                    $('#metode_bayar').html(
                        `Transfer - ${dataPOMembership.rekening.nama} (${dataPOMembership.rekening.no_rekening} ${dataPOMembership.rekening.deskripsi})`
                    );
                }
                // let alamat = dataPOMembership.alamat ?
                //     `${dataPOMembership.alamat.alamat}, ${dataPOMembership.alamat.desa.name} ${dataPOMembership.alamat.kecamatan.name} ${dataPOMembership.alamat.kab_kota.name} ${dataPOMembership.alamat.provinsi.name} ${dataPOMembership.alamat.postal_code}` :
                //     '-';
                $('#alamat').text(dataPOMembership.alamat);
                $.each(itemsBarang, function(key, value) {
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
                let totalHarga = itemsBarang.reduce((a, value) => {
                    return a += parseInt(value.total_harga)
                }, 0)

                $('#totalHarga').html(rp(totalHarga))
            } catch (error) {
                console.error('Error fetching PO Membership:', error);
                return null;
            }
        };

        created()
    </script>
@endsection

@section('js')
    <script>
        $('#menuBottom').remove()
        $('.atasButton').remove()
    </script>
@endsection
