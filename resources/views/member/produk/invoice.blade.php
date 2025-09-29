@extends('layouts.member')

@section('content')
    <style>
        @media print {

            /* Gaya khusus untuk cetakan */
            body * {
                visibility: hidden;
            }

            #printableArea,
            #printableArea * {
                visibility: visible;
            }

            #printableArea {
                position: absolute;
                left: 0;
                top: 0;
            }
        }

        .bottom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
        }

        .bottom-bar a {
            color: #fff;
            text-decoration: none;
            padding: 13px;
        }
        .batasWaktu {
            border: 2px solid rgb(179, 17, 17);
            background: rgba(255, 0, 0, 0.056);
            padding: 10px;
            border-radius: 15px;
            color: rgb(179, 17, 17);
        }
    </style>
    <br><br><br>
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="col-sm-8">
                <a href="/transaksi/jasa" class="btn btn-outline-primary mb-4"><i
                    class="bi bi-arrow-left me-1"></i>Kembali</a>
                    <button onclick="reloadPage()" class="btn btn-primary"><i class="bi bi-arrow-clockwise"></i> Segarkan</button>
                <div class="mt-3 mb-3">
                    <div class="col-sm-3" id="tampilanKomplain">
                        <button onclick="openKomplainModal()" class="btn btn-danger w-100">
                            <i class="bi bi-journal-text"></i> Komplain
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="shadow mt-4 col-sm-8 mb-3" style="border-radius: 20px;" id="tampilanDitujuan">
                <div class="p-4">
                    <h5 class="fw-bold">Selesaikan Pesanan</h5>
                    <div class="d-flex justify-content-between">
                        <div class="text-sm">Klik tombol berikut jika sudah Selesai</div>
                    </div>
                    <button onclick="tandaiSelesai('{{ $no_invoice }}')" class="btn btn-primary w-100 mt-2">Selesai</button>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="shadow mt-4 col-sm-8 mb-3" style="border-radius: 20px;" id="tampilanDiperjalanan">
                <div class="p-4">
                    <h5 class="fw-bold">Sedang Diperjalanan</h5>
                    <div class="d-flex justify-content-between">
                        <div class="text-sm">Klik tombol berikut jika Terapis sudah sampai Ditujuan</div>
                    </div>
                    <button onclick="tandaiSampaiTujuan('{{ $no_invoice }}')" class="btn btn-primary w-100 mt-2">Sudah Sampai Ditujuan</button>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="batasWaktu col-sm-4 mb-3" id="batasWaktuBayar">
                <div class="text-center">
                    <h5 class="text-center">Batas waktu bayar</h5>
                    <h4 class="fw-bold" style="color: rgb(179, 17, 17);" id="countdown">00:00:00</h4>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="col-sm-8">

                <div class="card" style="border-radius: 20px;" id="printableArea">
                    <div class="p-4">
                            <img class="mb-4" src="{{ asset('images/logo-balanja.png') }}" alt="" width="200px">
                        
                        <div class="d-flex justify-content-between">
                            <h3><b>INVOICE</b></h3>
                            <h2> <b id="keteranganLunas"></b></h2>
                        </div>
                        <span class="text--primary h6"><b id="no_invoice">INV/78382748738/234</b></span>
                        <div class="row mt-3">
                            <div class="col-sm">
                                <h5><b>DITERBITKAN ATAS NAMA</b></h5>
                                Penjual : <b id="penjual">-</b>
                            </div>
                            <div class="col-sm">
                                <h5><b>UNTUK</b></h5>
                                <table>
                                    <tr>
                                        <td width="200px">Pembeli</td>
                                        <td><b id="pembeli"> -</b></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pembelian</td>
                                        <td><b id="tgl_pembelian">12-12-2022</b></td>
                                    </tr>
                                    <tr>
                                        <td>No. Telepon</td>
                                        <td><b id="no_telepon">082807363339</b></td>
                                    </tr>
                                    <tr>
                                        <td style="display: flex;">
                                            Alamat Pembelian
                                        </td>
                                        <td><b id="alamat">-</b> <span id="detailAlamat"></span>
    
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
    
                        <div class="table-responsive mt-5">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>INFO PRODUK</th>
                                        <th>JUMLAH</th>
                                        <th>HARGA DASAR</th>
                                        <th>TOTAL HARGA</th>
                                    </tr>
                                </thead>
                                <tbody id="infoBarang">
    
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6"></div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-between">
                                    <div><b>TOTAL HARGA</b></div>
                                    <div><b id="totalHarga">Rp. 23.000</b></div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between" id="ongkirView">
                                    <div>Ongkos Kirim</div>
                                    <div> <span id="ongkir"></span></div>
                                </div>
                                <hr id="ongkirViewhr">
                                <div class="d-flex justify-content-between">
                                    <div><b>BIAYA LAYANAN</b></div>
                                    <div> <b id="biayaLayanan">Rp. 0</b></div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div><b>BIAYA APLIKASI</b></div>
                                    <div> <b id="biayaAplikasi">Rp. 0</b></div>
                                </div>
                                <div id="biayaPg"></div>
                                {{-- <div class="d-flex justify-content-between">
                                    <div>Bayar Asuransi Pengiriman</div>
                                    <div>Rp300</div>
                                </div> --}}
                                <div id="diskon"></div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div><b>Kode Unik</b></div>
                                    <div><b id="kodeUnik">123</b></div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div><b>TOTAL BELANJA</b></div>
                                    <div><b id="totalBelanja">Rp. 23.000</b></div>
                                </div>
                                {{-- <hr>
                                <div class="d-flex justify-content-between">
                                    <div>Biaya Jasa Aplikasi</div>
                                    <div>Rp300</div>
                                </div> --}}
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div><b>TOTAL TAGIHAN</b></div>
                                    <div><b id="totalTagihan">Rp. 23.000</b></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm">
                                <span id="pengirimanView">
                                    Pengiriman :
                                    <h6><b id="pengiriman"></b></h6>
                                </span>
                            </div>
                            <div class="col-sm">
                                Metode Pembayaran :
                                <h6><b id="metodeBayar">Manual Transfer</b></h6>
                            </div>
                        </div>
                        <div class="row" id="kurirView">
                            <div class="col-sm">
                                Kurir :
                                <h6><b id="kurir"></b></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-3 d-flex justify-content-center">
            <button class="text-center btn btn-outline-primary col-sm-8 fw-bold" onclick="printContent()"> <i class="bi bi-printer"></i>
                Print</button>
        </div>

        {{-- Tampilan Transfer --}}
        <div class="mt-3 d-flex justify-content-center">
            <div class="shadow col-sm-8" style="border-radius: 20px;" id="tampilanTransfer">
                <div class="p-4">
                    <h5 class="text-center fw-bold">Manual Transfer</h5>
                    <hr>

                    Transfer sebelum <span id="expiredTime"></span>
                    {{-- <div class="d-flex flex-row" id="bankOptions">

                    </div> --}}

                    <div class="" id="detailBank"></div>

                    <label for="" class="mt-3">Jumlah Transfer</label>
                    <div class="input-group">
                        <input id="jumlah_transfer" readonly type="text" class="form-control" value="">

                        {{-- <button class="btn btn-primary" id="button-addon2"
                        onclick="salinDanPilih('tes')">Salin</button> --}}
                    </div>
                    <label for="" class="mt-2">Bukti Bayar</label>
                    <div class="input-group">
                        <input id="buktiBayar" type="file" class="form-control" value="">

                    </div>

                    {{-- <center class="mt-4 mb-4">
                        <a  class="text-danger">Batalkan Transaksi</a>
                    </center> --}}
                            {{-- <p class="mb-2">
                                Jika sudah transfer, mohon klik tombol dibawah ini agar kami bisa teruskan uangmu ke <b>KIDAM
                                    KUSNANDI</b>
                            </p> --}}
                            <button onclick="sudahTransfer()" class="btn btn-primary mt-3 w-100">Saya Sudah Transfer</button>
                        
                </div>
            </div>
        </div>

        {{-- Tampilan Virtual Account --}}
        <div class="d-flex justify-content-center">
            <div class="shadow mt-4 col-sm-8" style="border-radius: 20px;" id="tampilanVirtualAccount">
                <div class="p-4">
                    <h5 class="fw-bold">Virtual Account </h5>
                    <div class="d-flex justify-content-between">
                        <div class="text-sm">Silahkan transfer ke Virtual Account berikut</div>
                        <h5 id="virtualAccountName" class="fw-bold"></h5>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="virtualAccountNumber" readonly>
                        <button class="btn btn-primary" id="button-addon2"
                            onclick='salinDanPilih(document.getElementById("virtualAccountNumber").value)'>Salin
                        </button>
                    </div>
                    {{-- <center class="mt-4 mb-4">
                        <a href="" class="text-danger">Batalkan Transaksi</a>
                    </center> --}}
                    <button onclick="cekStatus()" class="btn btn-primary w-100">Cek Status Pembayaran</button>
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-center">
            <div class="shadow mt-4 col-sm-8" style="border-radius: 20px;" id="tampilanQRIS">
                <div class="p-4">
                    <h5 class="fw-bold">QRIS</h5>
                    <div class="d-flex justify-content-between">
                        <div class="text-sm">Silahkan Scan QR Code (QRIS) berikut</div>
                    </div>
                    <div id="imageQRIS"></div>
                    {{-- <center class="mt-4 mb-4">
                        <a href="" class="text-danger">Batalkan Transaksi</a>
                    </center> --}}
                    <button onclick="cekStatus()" class="btn btn-primary w-100">Cek Status Pembayaran</button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <div class="col-sm-6" id="tampilanDibatalkan">
            <button onclick="konfirmasiBatal()" class="btn btn-outline-danger w-100">Batalkan Pesanan</button>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/axios.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
    var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
        function reloadPage() {
            window.location.reload();
        }
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

        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var member = urlParams.get('member')

        if (member) {
            let member_id = localStorage.getItem('member_id')
            if (member != member_id) {
                localStorage.setItem('member_id', member)
            }
        } else {
            let member_id = localStorage.getItem('member_id')
            member = member_id
        }

        var expired_time;
        var statusBayar;
        var transaksiId;
        var rekening_id = null;
        getData();

        let intervalId = null;
        intervalId = setInterval(cekStatusAuto, 10000);

        const endTime = new Date(expired_time).getTime();
        const countdownInterval = setInterval(updateCountdown, 1000);

        function updateCountdown() {
            const currentTime = new Date().getTime();
            const timeDifference = endTime - currentTime;

            if (timeDifference <= 0) {
                clearInterval(countdownInterval);
                document.getElementById('countdown').innerHTML = 'Waktu sudah habis!';
                // Panggil fungsi ketika countdown selesai
                if(statusBayar != 'lunas') {
                    countdownFinishedAction();
                }
            } else {
                const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                document.getElementById('countdown').innerHTML =
                    `${days} hari, ${hours} jam, ${minutes} menit, ${seconds} detik`;
            }
        }

        // Fungsi yang dipanggil ketika countdown selesai
        function countdownFinishedAction() {
            // Tambahkan aksi yang diinginkan di sini
            Swal.fire({
                icon: 'error',
                title: 'Maaf!',
                text: 'Batas pembayaran sudah berakhir'
            });
            $("#tampilanTransfer").hide();
            $("#tampilanQRIS").hide();
            $("#batasWaktuBayar").hide();

        }

        function printContent() {
            // Panggil window.print() untuk mencetak
            window.print();
        }

        function salinDanPilih(text) {
            const el = document.createElement('textarea');
            el.value = text;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            alert('Nomor Rekening disalin !');
        }


        var noInvoice;

        function getMonthAbbreviation(monthNumber) {
            var months = [
                "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
                "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
            ];
            return months[monthNumber];
        }

        function addLeadingZero(number) {
            return number < 10 ? '0' + number : number;
        }

        function getData() {
            var data = JSON.parse(localStorage.getItem('invoice'));
            const urlParams = new URLSearchParams(window.location.search);
            const order_id = urlParams.get('order_id');
            let noInvoices = '{{ $no_invoice }}'
            let newInvoice = noInvoices.replace(/-/, '/').replace(/-/, '/');
            if (data == null) {
                axios.get(`${API_URL}/view-invoice/${noInvoices}`, {
                        headers: {
                            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                            'device': 'web'
                        }
                    })
                    .then(function(response) {
                        var dataTransaksi = localStorage.getItem('dataTransaksi') ? JSON.parse(localStorage
                            .getItem(
                                'dataTransaksi')) : []
                        dataTransaksi = dataTransaksi.filter(item => item.no_invoice !== noInvoices);
                        localStorage.setItem('dataTransaksi', JSON.stringify(dataTransaksi));
                        dataTransaksi.push(response.data)
                        localStorage.setItem('dataTransaksi', JSON.stringify(dataTransaksi))
                        localStorage.setItem('invoice', JSON.stringify(response.data))
                        let noInvoice = response.data.no_invoice.replace(/\//g, '-');
                        // window.location.href = `/pay/${noInvoice}`
                        // Handle the response data as needed
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
                return false
            }
            if (data.no_invoice != newInvoice) {
                axios.get(`${API_URL}/view-invoice/${noInvoices}`, {
                        headers: {
                            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                            'device': 'web'
                        }
                    })
                    .then(function(response) {
                        var dataTransaksi = localStorage.getItem('dataTransaksi') ? JSON.parse(localStorage
                            .getItem(
                                'dataTransaksi')) : []
                        dataTransaksi = dataTransaksi.filter(item => item.no_invoice !== noInvoices);
                        localStorage.setItem('dataTransaksi', JSON.stringify(dataTransaksi));
                        dataTransaksi.push(response.data)
                        localStorage.setItem('dataTransaksi', JSON.stringify(dataTransaksi))
                        localStorage.setItem('invoice', JSON.stringify(response.data))
                        let noInvoice = response.data.no_invoice.replace(/\//g, '-');
                        // window.location.href = `/pay/${noInvoice}`
                        // Handle the response data as needed
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }

            if (data.status_bayar != "belum_lunas") {
                $("#tampilanVirtualAccount").hide();
                $("#tampilanQRIS").hide();
                $("#tampilanTransfer").hide();
                $("#batasWaktuBayar").hide();
            } else {
                var currentTime = new Date();
                var expireTime = new Date(data.expire_time);

                if (currentTime > expireTime) {
                    $("#tampilanVirtualAccount").hide();
                    $("#tampilanQRIS").hide();
                    $("#tampilanTransfer").hide();
                    $("#batasWaktuBayar").hide();
                }
            }


            if (data.shipment_option == null) {
                $('#pengirimanView').html("")
                $('#kurirView').html("")
            }
            var today = new Date(data.waktu_transaksi);

            var year = today.getFullYear();
            var month = today.getMonth() + 1;
            var day = today.getDate();

            month = month < 10 ? '0' + month : month;
            day = day < 10 ? '0' + day : day;

            var formattedDate = day + '-' + month + '-' + year;

            var expired_Time = new Date(data.expire_time);
            transaksiId = data.id;
            statusBayar = data.status_bayar;

            var dayE = addLeadingZero(expired_Time.getDate());
            var monthE = getMonthAbbreviation(expired_Time.getMonth());
            var yearE = expired_Time.getFullYear();
            var hours = addLeadingZero(expired_Time.getHours());
            var minutes = addLeadingZero(expired_Time.getMinutes());

            monthE = monthE < 10 ? '0' + monthE : monthE;
            dayE = dayE < 10 ? '0' + dayE : dayE;

            var formattedDateE = dayE + ' ' + monthE + ' ' + yearE + ', ' + hours + ':' + minutes + ' WIB';

            if(data.status != 'diperjalanan') {
                $("#tampilanDiperjalanan").hide();
            }
            if(data.status != 'ditujuan') {
                $("#tampilanDitujuan").hide();
            }
            if(data.status != 'selesai') {
                $("#tampilanKomplain").hide();
            }
            if(data.status == 'dibatalkan') {
                $("#tampilanVirtualAccount").hide();
                $("#batasWaktuBayar").hide();
            }
            if (data.status === 'pending' || data.status === 'diproses') {
                $("#tampilanDibatalkan").show();
            } else {
                $("#tampilanDibatalkan").hide();
            }


            expired_time = data.expire_time
            $('#no_invoice').html(data.no_invoice)
            noInvoice = data.no_invoice
            $('#pembeli').html(data.customer.nama)
            $('#tgl_pembelian').html(formattedDate)
            $('#no_telepon').html(data.customer.no_hp)
            $('#expiredTime').html(formattedDateE)
            $('#alamat').html(data.customer.data_pengiriman.alamat + ",")
            $('#detailAlamat').html(`
                ${data.customer.data_pengiriman.desa.name} , ${data.customer.data_pengiriman.kecamatan.name}, ${data.customer.data_pengiriman.kab_kota.name} , ${data.customer.data_pengiriman.provinsi.name}
            `)
            $('#biayaLayanan').html(data.biaya_layanan ? rp(data.biaya_layanan) : rp(0))
            $('#biayaAplikasi').html(data.biaya_aplikasi ? rp(data.biaya_aplikasi) : rp(0))
            $('#totalHarga').html(rp(data.uang_masuk))

            if (data.shipment_option == "take_away") {
                $('#pengiriman').html("Diambil Sendiri")
                $('#kurir').html("-")
                $('#ongkir').html("Rp. 0")
            } else {
                $('#pengiriman').html("Dikirim")
                $('#kurir').html("Balanja Express")
                $('#ongkir').html(rp(data.ongkir))
            }
            if (data.status_bayar == "belum_lunas") {
                $('#keteranganLunas').html("BELUM LUNAS")
                $('#keteranganLunas').css("color", "red")
            } else {
                $('#keteranganLunas').html("LUNAS")
                $('#keteranganLunas').css("color", "green")
            }

            if (data.transaction_type == "jasa") {
                $('#ongkirView').remove()
                $('#ongkirViewhr').remove()
            }

            if (data.diskon && data.diskon.length > 0) {
                data.diskon.forEach(item => {
                    $('#diskon').append(`
                        <hr>
                        <div class="d-flex justify-content-between">
                                <div>Diskon <b>(${item.name})</b></div>
                                <div> <b>${ item.discount_mode == 'nominal' ? rp(item.value) : item.value + "%" } </b></div>
                        </div>
                    `)
                });
            }

            $('#kodeUnik').html(data.kode_unik ? data.kode_unik : '-')
            $('#totalBelanja').html(rp(data.total_bayar))
            $('#totalTagihan').html(rp(data.total_bayar))
            $('#jumlah_transfer').val(rp(data.total_bayar))
            $.each(data.item, (key, data) => {
                $('#infoBarang').append(`
                <tr>
                    <td>
                        <div class="text--primary"> ${data.barang_nama}</div>
                    </td>
                    <td>${data.qty}</td>
                    <td>${rp(data.harga )}</td>
                    <td>${rp(data.total_harga )}</td>
                </tr>
                `)
            })

            if (data.metode_bayar == 'manual_transfer') {
                $("#tampilanVirtualAccount").hide();
                $("#tampilanQRIS").hide();
                rekening_id = data.kode_bayar
                $("#detailBank").html(`
                <div class="shadow border mt-3" style="background: white; border-radius: 15px;">
                    <div class="p-4">

                        <h5 class="card-title">  <img src="${data.kode_bayar_detail.image_url ? data.kode_bayar_detail.image_url : 'https://e7.pngegg.com/pngimages/482/107/png-clipart-house-building-computer-icons-logo-house-angle-building.png'}"
                                            class="img-fluid" width="40px"> ${data.kode_bayar_detail.nama} ${data.kode_bayar_detail.deskripsi ? 'a.n ' + data.kode_bayar_detail.deskripsi : ''}</h5>
                        <div class="input-group mt-2">
                            <input type="text" class="form-control" value="${data.kode_bayar_detail.no_rekening}" readonly>

                            <button class="btn btn-primary" id="button-addon2"
                                onclick='salinDanPilih("${data.kode_bayar_detail.no_rekening}")'>Salin</button>
                        </div>
                    </div>
                </div>
                `)
                $('#metodeBayar').html(
                    `Manual Transfer ${data.kode_bayar_detail.nama} ${data.kode_bayar_detail.deskripsi} (${data.kode_bayar_detail.no_rekening})`
                )
            } else if (data.metode_bayar == "payment_gateway" && data.payment_info.payment_type == "qris") {
                $('#biayaPg').html(`
                    <hr>
                    <div class="d-flex justify-content-between">
                            <div><b>BIAYA TRANSAKSI</b></div>
                            <div> <b >${rp(data.biaya_pg)}</b></div>
                    </div>
                `)
                $("#tampilanTransfer").hide();
                $("#tampilanVirtualAccount").hide();
                $('#imageQRIS').html(`
                <div class="col-sm-4">
                    <div class="card mt-2 mb-3" style="border-radius: 15px;">
                    <div class="card-body">
                        <img src="${data.payment_info.payment_detail.qris_url}" style="" class="img-fluid" />
                    </div>
                    </div>
                </div>
                `);
            } else if (data.metode_bayar == "payment_gateway") {
                $('#biayaPg').html(`
                    <hr>
                    <div class="d-flex justify-content-between">
                            <div><b>BIAYA TRANSAKSI</b></div>
                            <div> <b >${rp(data.biaya_pg)}</b></div>
                    </div>
                `)
                $("#tampilanTransfer").hide();
                $("#tampilanQRIS").hide();
                // $('#virtualAccountName').html(data.midtrans.bank)
                // $('#virtualAccountNumber').val(data.midtrans.va_number)
                // $('#metodeBayar').html(
                //     `Virtual Account (${data.midtrans.bank})`
                // )
                $('#virtualAccountName').html(data.payment_info.payment_detail.va_numbers[0].bank)
                $('#virtualAccountNumber').val(data.payment_info.payment_detail.va_numbers[0].va_number)
                $('#metodeBayar').html(
                    `Virtual Account`
                )
            }

            $('#penjual').html(data.terapis.nama_lengkap)

        }

        function sudahTransfer() {
            if (rekening_id == null) {
                alert("Harap pilih Bank rekening terlebih dahulu!")
            } else {
                Swal.fire({
                    title: 'Peringatan',
                    text: 'Anda yakin sudah transfer?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var file = document.getElementById('buktiBayar').files[0];
                        var formData = new FormData();

                        formData.append('no_invoice', noInvoice);
                        formData.append('rekening_id', rekening_id);
                        formData.append('file', file);

                        axios.post(`${API_URL}/conf-order`, formData, {
                                headers: {
                                    'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                                    'Author': 'bearer ' + token,
                                    'device': 'web'
                                }
                            })
                            .then(function(response) {
                                Swal.fire('Terima kasih!', 'Pengiriman anda sedang diproses', 'info');
                                let existTransaksi = JSON.parse(localStorage.getItem('dataTransaksi'));
                                existTransaksi.map(res => {
                                    if (res.no_invoice == response.data.no_invoice) {
                                        res.status = response.data.status
                                    }
                                })
                                localStorage.setItem('dataTransaksi', JSON.stringify(existTransaksi))
                                window.location.href = "/list-transaksi";
                            })
                            .catch(function(error) {
                                // handle error
                                alert(error.response.data.message)
                            });


                    }
                });
            }
        }

        async function cekStatus() {
            try {
                var data = JSON.parse(localStorage.getItem('invoice'));
                let response = await axios.get(`${API_URL}/view-invoice/${data.id}`, {
                    headers: {
                        'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                        'device': 'web'
                    }
                })
                if (response.data.status_bayar == "belum_lunas") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan!',
                        text: 'Pembayaran Belum Lunas!'
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Pembayaran Sudah Lunas, Terima Kasih >_<'
                    });
                    localStorage.setItem('invoice', JSON.stringify(response.data))
                    let noInvoice = response.data.no_invoice.replace(/\//g, '-');
                    window.location.href = `/pay/${noInvoice}`
                }

            } catch (e) {
                console.log(e)
            }
        }
        
        async function cekStatusAuto() {
            try {
                var data = JSON.parse(localStorage.getItem('invoice'));
                let response = await axios.get(`${API_URL}/view-invoice/${data.id}`, {
                    headers: {
                        'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                        'device': 'web'
                    }
                });

                if (response.data.status_bayar != "belum_lunas") {
                    localStorage.setItem('invoice', JSON.stringify(response.data));
                    let noInvoice = response.data.no_invoice.replace(/\//g, '-');
                    
                    // hentikan auto cek setelah lunas
                    clearInterval(intervalId);

                    // window.location.href = `/pay/${noInvoice}`;
                }

            } catch (e) {
                console.log(e);
            }
        }

        // Tandai Ditujuan
        async function tandaiSampaiTujuan(noInvoice) {
            try {
                let noInvoices = '{{ $no_invoice }}';
                let newInvoice = noInvoices.replace(/-/g, '/');

                Swal.fire({
                    title: 'Loading...',
                    text: 'Sedang memproses...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                let formData = new FormData();
                formData.append('no_invoice', newInvoice);

                let response = await axios.post(
                    `${API_URL}/transaksi-online/mark-as-arrived`,
                    formData,
                    {
                        headers: {
                            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                            'Author': 'Bearer ' + token,
                            'device': 'web'
                        }
                    }
                );

                localStorage.setItem('invoice', JSON.stringify(response.data));

                // ✅ reload otomatis setelah 2 detik
                Swal.fire({
                    icon: 'success',
                    title: 'Terimakasih',
                    text: 'Selamat menikmati layanan kami.',
                    timer: 2000,
                    showConfirmButton: false
                });

                // reload setelah Swal selesai
                setTimeout(() => {
                    window.location.href = "/transaksi/jasa";
                }, 2000);

            } catch (e) {
                console.error(e);
                // Swal.fire({
                //     icon: 'error',
                //     title: 'Oops...',
                //     text: 'Terjadi kesalahan. Silakan coba lagi.'
                // });
            }
        }

        // Tandai Selesai
        async function tandaiSelesai(noInvoice) {
            try {
                let noInvoices = '{{ $no_invoice }}';
                let newInvoice = noInvoices.replace(/-/g, '/');

                Swal.fire({
                    title: 'Loading...',
                    text: 'Sedang memproses...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                let formData = new FormData();
                formData.append('no_invoice', newInvoice);

                let response = await axios.post(
                    `${API_URL}/transaksi-online/mark-order-complete`,
                    formData,
                    {
                        headers: {
                            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                            'Author': 'Bearer ' + token, // ✅ fix di sini
                            'device': 'web'
                        }
                    }
                );

                localStorage.setItem('invoice', JSON.stringify(response.data));

                // ✅ reload otomatis setelah 2 detik
                Swal.fire({
                    icon: 'success',
                    title: 'Terimakasih',
                    text: 'Pesanan telah diselesaikan.',
                    timer: 2000,
                    showConfirmButton: false
                });

                // reload setelah Swal selesai
                setTimeout(() => {
                    window.location.href = "/transaksi/jasa";
                }, 2000);

            } catch (e) {
                console.error(e);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan. Silakan coba lagi.'
                });
            }
        }

        // Dibatalkan
        function konfirmasiBatal() {
            let yakin = confirm("Apakah Anda yakin ingin membatalkan pesanan?");
            if (yakin) {
                dibatalkan(); // jalankan fungsi aslinya
            }
        }

        async function dibatalkan(noInvoice) {
            try {
                let noInvoices = '{{ $no_invoice }}';
                let newInvoice = noInvoices.replace(/-/g, '/');

                Swal.fire({
                    title: 'Loading...',
                    text: 'Sedang memproses...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                let formData = new FormData();
                formData.append('no_invoice', newInvoice);

                let response = await axios.post(
                    `${API_URL}/transaksi-online/cancel`,
                    formData,
                    {
                        headers: {
                            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                            'Author': 'Bearer ' + token,
                            'device': 'web'
                        }
                    }
                );

                localStorage.setItem('invoice', JSON.stringify(response.data));

                // ✅ reload otomatis setelah 2 detik
                Swal.fire({
                    icon: 'success',
                    title: 'Dibatalkan',
                    text: 'Pesanan berhasil dibatalkan',
                    timer: 2000,
                    showConfirmButton: false
                });

                // reload setelah Swal selesai
                setTimeout(() => {
                    window.location.href = "/transaksi/jasa";
                }, 2000);

            } catch (e) {
                console.error(e);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan. Silakan coba lagi.'
                });
            }
        }

        //Komplain
        const kategoriRefundOptions = [
            "Jasa tidak sesuai",
            "Terapis datang terlambat",
            "Terapis kurang profesional",
            "Harga tidak sesuai",
            "Lainnya"
        ];

        // buka modal komplain
        function openKomplainModal() {
            let optionsHtml = kategoriRefundOptions.map(opt => `<option value="${opt}">${opt}</option>`).join("");

            Swal.fire({
            title: 'Komplain',
            html: `
                <form id="komplainForm" enctype="multipart/form-data">
                    <div class="form-group text-start">
                        <label for="kategori_refund">Kategori Komplain</label>
                        <select id="kategori_refund" class="form-control mt-2 mb-2">
                            ${optionsHtml}
                        </select>
                    </div>
                    <div class="form-group text-start mt-2">
                        <label for="alasan">Alasan</label>
                        <textarea id="alasan" class="form-control mt-2 mb-2" rows="4" placeholder="Tuliskan alasan..."></textarea>
                    </div>
                    <div class="form-group text-start mt-2">
                        <label for="lampiran">Lampiran (opsional)</label>
                        <input type="file" id="lampiran" class="form-control mt-2 mb-2" />
                    </div>
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Kirim Komplain',
            cancelButtonText: 'Batal',
            buttonsStyling: false, // biar kita bisa pakai custom class
            customClass: {
                popup: 'rounded-4 shadow-lg',       // popup sedikit membulat + shadow
                confirmButton: 'btn btn-primary me-2', // tombol hijau modern
                cancelButton: 'btn btn-secondary' // tombol batal modern
            },
            preConfirm: () => {
                const kategori_refund = document.getElementById('kategori_refund').value;
                const alasan = document.getElementById('alasan').value;
                const lampiran = document.getElementById('lampiran').files[0] || null;

                if (!kategori_refund || !alasan) {
                    Swal.showValidationMessage('Kategori dan alasan wajib diisi');
                    return false;
                }

                return { kategori_refund, alasan, lampiran };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                submitKomplain(result.value);
            }
        });

        }

        // async function kirim komplain
        async function submitKomplain(data) {
            try {
                let noInvoices = '{{ $no_invoice }}';
                let newInvoice = noInvoices.replace(/-/g, '/');

                Swal.fire({
                    title: 'Loading...',
                    text: 'Sedang mengirim komplain...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                let formData = new FormData();
                formData.append("transaksi_id", transaksiId);
                formData.append("kategori_refund", data.kategori_refund);
                formData.append("alasan", data.alasan);
                if (data.lampiran) {
                    formData.append("lampiran", data.lampiran);
                }

                let response = await axios.post(
                    `${API_URL}/refund-transaksi`,
                    formData,
                    {
                        headers: {
                            "secret": "aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq",
                            "Author": "Bearer " + token,
                            "device": "web"
                        }
                    }
                );

                Swal.fire({
                    icon: 'success',
                    title: 'Komplain Terkirim',
                    text: 'Komplain Anda berhasil dikirim',
                    timer: 2000,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    window.location.href = "/transaksi/jasa";
                }, 2000);

            } catch (e) {
                console.error(e);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat mengirim komplain. Silakan coba lagi.'
                });
            }
        }

    </script>
@endsection
