@extends('layouts.member')

@section('content')
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

        hr {
            background: whitesmoke;
            height: 1px;
        }

        .card-body {
            padding: 20px;
        }
    </style>
    <br><br><br>
    <section id="faq" class="faq" style="background: rgba(245, 245, 245, 0.623);">

        <div class="container" data-aos="fade-up" style="margin-bottom: 100px;">

            <div class="row">
                <center>
                    <div class="col-lg-7">
                        <div class="card border-0 shadow mb-5">
                            <div class="card-body">
                                <div class="row dataProduk" id="dataProduk">

                                </div>
                                <h3 class="text--primary"> <span id="hargaProduk"></span> </h3>
                            </div>
                        </div>
                        <h6 style="color: rgb(66, 66, 66);"><b>Pilih Metode Pembayaran</b></h6>
                        <div class="card border-0 shadow mb-3 mt-1">
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="faqlist1">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                                                <span style="font-size: 16px;"> Virtual Account </span>
                                            </button>
                                        </h2>
                                        <div id="faq-content-1" class="accordion-collapse collapse"
                                            data-bs-parent="#faqlist1">
                                            <div class="accordion-body">
                                                <br>
                                                <div class="row">
                                                    <div class="col">
                                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/1200px-Bank_Central_Asia.svg.png"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="col-9 text-start "
                                                        style="align-items: center; display: flex;">
                                                        <b style="color: rgb(100, 100, 100); ">
                                                            BCA
                                                            Virtual Account</b>
                                                    </div>
                                                    <div class="col">
                                                        <div class="radio-button-container">
                                                            <div class="radio-button">
                                                                <input type="radio" class="radio-button__input"
                                                                    id="radio1" name="radio-group">
                                                                <label class="radio-button__label" for="radio1">
                                                                    <span class="radio-button__custom"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col">
                                                        <img src="https://buatlogoonline.com/wp-content/uploads/2022/10/Logo-Bank-BRI.png"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="col-9 text-start "
                                                        style="align-items: center; display: flex;">
                                                        <b style="color: rgb(100, 100, 100); ">
                                                            BRI
                                                            Virtual Account</b>
                                                    </div>
                                                    <div class="col">
                                                        <div class="radio-button-container">
                                                            <div class="radio-button">
                                                                <input type="radio" class="radio-button__input"
                                                                    id="radio2" name="radio-group">
                                                                <label class="radio-button__label" for="radio2">
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

                                <div class="accordion accordion-flush" id="faqlist2">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                                                <span style="font-size: 16px;">Convenience Store </span>
                                            </button>
                                        </h2>
                                        <div id="faq-content-2" class="accordion-collapse collapse"
                                            data-bs-parent="#faqlist2">
                                            <div class="accordion-body">
                                                <br>
                                                <div class="row">
                                                    <div class="col">
                                                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Alfamart_logo.svg"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="col-9 text-start "
                                                        style="align-items: center; display: flex;">
                                                        <b style="color: rgb(100, 100, 100); ">
                                                            Alfamart</b>
                                                    </div>
                                                    <div class="col">
                                                        <div class="radio-button-container">
                                                            <div class="radio-button">
                                                                <input type="radio" class="radio-button__input"
                                                                    id="radio3" name="radio-group">
                                                                <label class="radio-button__label" for="radio3">
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

                                <div class="accordion accordion-flush" id="faqlist3">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                                                <span style="font-size: 16px;">E-Wallet </span>
                                            </button>
                                        </h2>
                                        <div id="faq-content-3" class="accordion-collapse collapse"
                                            data-bs-parent="#faqlist3">
                                            <div class="accordion-body">
                                                <br>
                                                <div class="row">
                                                    <div class="col">
                                                        <img src="data:image/png;base64,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"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="col-9 text-start "
                                                        style="align-items: center; display: flex;">
                                                        <b style="color: rgb(100, 100, 100); ">
                                                            DANA</b>
                                                    </div>
                                                    <div class="col">
                                                        <div class="radio-button-container">
                                                            <div class="radio-button">
                                                                <input type="radio" class="radio-button__input"
                                                                    id="radio4" name="radio-group">
                                                                <label class="radio-button__label" for="radio4">
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

                                <div class="accordion accordion-flush" id="faqlist4">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#faq-content-4">
                                                <span style="font-size: 16px;">Transfer Bank </span>
                                            </button>
                                        </h2>
                                        <div id="faq-content-4" class="accordion-collapse collapse"
                                            data-bs-parent="#faqlist4">
                                            <div class="accordion-body">
                                                <br>
                                                <div class="row">
                                                    <div class="col">
                                                        <img src="https://e7.pngegg.com/pngimages/482/107/png-clipart-house-building-computer-icons-logo-house-angle-building.png"
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="col-9 text-start "
                                                        style="align-items: center; display: flex;">
                                                        <b style="color: rgb(100, 100, 100); ">
                                                            Transfer Bank (Konfirmasi Manual)</b>
                                                    </div>
                                                    <div class="col">
                                                        <div class="radio-button-container">
                                                            <div class="radio-button">
                                                                <input type="radio" class="radio-button__input"
                                                                    id="radio5" name="radio-group">
                                                                <label class="radio-button__label" for="radio5">
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
                            </div>
                        </div>

                        <div class="card border-0 shadow mb-3 mt-4">
                            <div class="card-body">
                                <h5 class="text-start mb-2"><b>Ringkasan Pembayaran</b></h5>
                                <div class="" id="ringkasanPembayaran">
                                    <div class="d-flex" style="justify-content: space-between;">
                                        <div>
                                            Harga Produk
                                        </div>
                                        <div>
                                            Rp. 1.000.000
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex" style="justify-content: space-between;">
                                        <div>
                                            <b> Harga Produk </b>
                                        </div>
                                        <div>
                                            <b>Rp. 1.000.000</b>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" onclick="lanjutBayar()" class="btn--primary mt-5"
                                    style="width: 100%;">Lanjutkan
                                    Pembayaran</button>
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

        // alert("Maaf, dalam tahap pengembangan")

        created()

        function created() {
            getData()
        }

        function getData() {
            let checkout = localStorage.getItem('checkout') ? JSON.parse(localStorage.getItem('checkout')) : []
            var jumlahBeli = checkout.item.reduce((a, item) => {
                return a += parseInt(item.qty)
            }, 0)
            console.log("checkout", checkout.item);
            $.each(checkout.item, function(key, value) {
                $('#dataProduk').append(`
                <div class="col-2 mt-2">
                    <img src="${value.barang.photo[0] != null ? value.barang.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}"
                        class="rounded img-fluid" alt="" >
                </div>
                <div class="col-10 text-start d-flex align-items-center">
                    <h5><b> ${value.barang.nama} </b></h5>
                </div>
            `);
                $('#hargaProduk').html(rp(checkout.tunai))
                $('#ringkasanPembayaran').html(
                    `
                    <div class="d-flex" style="justify-content: space-between;">
                        <div>
                            Harga Barang
                        </div>
                        <div>
                            ${rp(checkout.tunai)}
                        </div>
                    </div>
                    <div class="d-flex" style="justify-content: space-between;" >
                        <div>
                            Jumlah Beli
                        </div>
                        <div>
                            ${jumlahBeli}
                        </div>
                    </div>
                    <div class="d-flex" style="justify-content: space-between;" >
                        <div>
                            Ongkos Kirim
                        </div>
                        <div>
                            ${rp(checkout.ongkir)}
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex" style="justify-content: space-between;">
                        <div>
                            <b> Total Harga </b>
                        </div>
                        <div>
                            <b>${rp(checkout.tunai)}</b>
                        </div>
                    </div>
                    `
                )
            });


        }

        function lanjutBayar() {
            let checkout = localStorage.getItem('checkout')
            let member_id = localStorage.getItem('member_id')
            var data = JSON.parse(checkout)
            var payload = {
                member_id: member_id,
                nama: data.nama,
                email: data.email,
                no_hp: data.no_hp,
                transfer: data.totalHarga,
                ongkir: data.ongkir ? data.ongkir : 0,
                pengiriman_id: data.pengiriman_id,
                metode_transfer: data.metode,
                metode_bayar: "manual_transfer",
                item: data.item,
                alamat_pengiriman: data.alamat,
                provinsi: data.provinsi_id,
                kab_kota: data.kab_kota_id,
                kecamatan: data.kecamatan_id,
                desa: data.desa_id,
            }
            console.log("payload", payload)
            axios.post('https://api-bal.zuppaqu.com/v1/checkout', payload, {
                    headers: {
                        'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    console.log('response', response.data)
                    var dataTransaksi = localStorage.getItem('dataTransaksi') ? JSON.parse(localStorage.getItem(
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
                    // let dataProvinsi = response.data.data
                    // $('#provinsi_id').html('<option value="">- Pilih -</option>');
                    // $.each(dataProvinsi, function(key, value) {
                    //     $("#provinsi_id").append('<option value="' + value
                    //         .id + '">' + value.name + '</option>');
                    // });
                })
                .catch(function(error) {
                    // handle error
                    alert(error)
                    console.log(error);
                });
        }
    </script>
@endsection
