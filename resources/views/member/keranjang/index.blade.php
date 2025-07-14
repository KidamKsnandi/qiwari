@extends('layouts.member')

@section('content')
    <div id="mainScreen">

        <div class="container">
            <div class="bungkus_cart" style="margin-top: 130px;">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="gabungan">

                            <h4><b> Keranjang </b></h4>
                            <div class="listCheckout" id="listCheckoutKeranjang">

                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card rounded d-none d-sm-block">
                            <div class="card-header bg-white text-center">
                                <b> Ringkasan Belanja </b>
                            </div>
                            <div class="card-body">
                                <br>
                                <div class="d-flex justify-content-between">
                                    <div>Total Harga (<span id="qtyBarang">0</span> barang)</div>
                                    <b id="total_harga">Rp0</b>
                                </div>
                                <br><br>
                                <div class="d-flex justify-content-between">
                                    <h5>Total Harga</h5>
                                    <h5 id="totalHarga" style="font-weight:bolder">Rp0</h5>
                                </div>
                                <center id="buttonBeli">
                                    <button class="btn--primary mt-2 mb-1 w-100">Beli Sekarang</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="card_bottom">
            <div class="list" style="width: 100%; height: 0.2rem; background-color:
            #F3F4F5"></div>
            <div class="">
                <div class="d-flex">
                    <div class="col">
                        <p class="total" style="margin-left: 15px; margin-top: 1.5rem;">Total</p>
                        <h3 style="margin-left: 15px; margin-top: -1rem; font-size:1.3em; font-weight: bold;"
                            id="total">
                            Rp0</h3>
                    </div>
                    <div class="col" id="buttonBeliMobile">
                        <button class="green-button float-end" style="border-radius: 10px">Beli Sekarang</button>
                    </div>
                    {{-- <div class="bungkus_teks_bagian_kanan"
                        style="display: flex; flex-direction: column; align-items: flex-end;">
                        <p class="total" style="margin-top: 1.5rem;">Total</p>
                        <h3 style="margin-top: -1rem; font-size:1.3em;" id="total">Rp0</h3>
                    </div>
                    <button class="green-button" style="border-radius: 10px">Beli Sekarang</button> --}}
                </div>
            </div>
        </div>

    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,400;1,600&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .bungkus_cart {
            /* display: flex; */
            margin: auto;
            /* width: 67%; */
            height: 100%;
        }

        .gabungan {
            display: flex;
            flex-direction: column;
            margin-right: 2rem;
            width: 100%;
        }

        .persegi_panjang {
            display: flex;
            flex-direction: column;
            padding: 10px 0;
            border-top: #dddddd solid 2px;
            /* width: 100%; */
        }

        .konten3 .whistlist {
            margin-right: 1rem;
        }

        .icon_sampah {
            margin-left: 0.5rem;
            margin-right: 3rem
        }

        .icon_plus {
            margin-left: 0.5rem;
            margin-right: 1rem
        }

        .icon_minus {
            margin-left: 0.5rem;
            margin-right: 3rem
        }

        .konten3 {
            font-size: medium;
        }

        [data-feather="trash-2"] {
            font-size: 3rem;
            /* Atur ukuran ikon sesuai kebutuhan */
        }

        .persegi {
            border: #F3F4F5 solid;
            border-radius: 5%;
            width: 20rem;
            height: 20rem;
        }

        .in_persegi {
            border-bottom: #F3F4F5 solid 5px;
            width: 100%;
            height: 6rem;
        }

        .persegi h4 {
            padding: 10px;
            font-weight: 600;
        }

        .baris1 {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding: 0 10px;
            font-weight: 300;
        }

        hr {
            width: 90%;
            border: none;
            /* Menghapus garis bawaan */
            border-top: 1px solid #878686;
            /* Menambahkan garis horizontal dengan warna dan lebar tertentu */
            margin-top: 20px;
            margin-bottom: 15px;
        }

        .persegi .baris1 {
            font-size: 0.9em;
            font-weight: 600;
        }

        .green-button {
            margin-top: 14px;
            background-color: #4CAF50;
            /* Warna hijau */
            color: #fff;
            /* Warna teks putih */
            width: 19rem;
            height: 2rem;
            border: none;
            /* Menghilangkan border */
            border-radius: 5px;
            /* Membuat sudut tombol lebih melengkung */
            cursor: pointer;
            /* Mengubah kursor menjadi tanda tangan saat mengarahkan ke tombol */
        }

        /* Hover state: Warna tombol berubah saat kursor mengarahkan tombol */
        .green-button:hover {
            background-color: #45a049;
            /* Warna hijau yang lebih gelap saat dihover */
        }

        .card_bottom {
            display: none;
        }

        @media (max-width: 980px) {
            .container_cart {
                display: flex;
                justify-content: flex-start;
            }

            .bungkus {
                width: 100%;
            }

            .persegi {
                display: none;
            }

            .card_bottom {
                margin-bottom: 40px;
                display: block;
                background-color: #fff;
                position: fixed;
                bottom: 0;
                width: 100%;
                height: 7rem;
                z-index: 5;
            }

            .bungkus_card_bottom {
                display: flex;
                justify-content: space-between;
            }

            .bungkus_card_bottom .bagian_kiri input {
                width: 2rem;
                height: 2rem;
                margin-left: 2rem;
                margin-top: 2rem;
            }

            .bungkus_card_bottom .bagian_kanan {
                display: flex;
            }



            .green-button {
                margin: 25px 14px;
                background: #4294e3;
                background: linear-gradient(47deg, rgb(126, 213, 149) 0%, #23ca23 68%);
                /* Warna hijau */
                color: #fff;
                /* Warna teks putih */
                padding: 10px;
                width: 170px;
                height: 3rem;
                border: none;
                /* Menghilangkan border */
                border-radius: 5px;
                /* Membuat sudut tombol lebih melengkung */
                cursor: pointer;
                /* Mengubah kursor menjadi tanda tangan saat mengarahkan ke tombol */
            }

            /* Hover state: Warna tombol berubah saat kursor mengarahkan tombol */
            .bungkus_card_bottom .bagian_kanan .green-button:hover {
                background-color: #45a049;
                /* Warna hijau yang lebih gelap saat dihover */
            }
        }

        @media (max-width: 500px) {
            .container_cart {
                margin-top: 7rem;
            }

            .gabungan {
                margin-right: 0;
            }

            .judul {
                display: none;
            }

            .alamat_toko {
                display: none;
            }

            .konten3 p {
                font-size: 0.8rem;
            }

            .persegi_panjang {
                padding: 10px 10px;
            }

            .nomor {
                font-size: 1rem;
                margin-top: 0.05rem;
                margin-right: 0.1rem;
            }

            .whistlist {
                font-size: 0.8rem;
                margin-right: 0.2rem;
                margin-top: 0.1rem;
            }

            .icon_sampah {
                width: 1rem;
                height: 1rem;
                margin-top: 0.1rem;
                margin-left: 0.2rem;
                margin-right: 1rem
            }

            .icon_plus {
                width: 1rem;
                height: 1rem;
                margin-top: 0.2rem;
                margin-right: 1rem;
            }

            .icon_minus {
                width: 1rem;
                height: 1rem;
                margin-top: 0.2rem;
                margin-right: 1rem;
            }

            .bungkus_card_bottom .bagian_kiri input {
                width: 1rem;
                height: 1rem;
                margin-left: 1em;
                margin-top: 2.5rem;
            }

        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/axios.min.js') }}"></script>
    <script>
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
        var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
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


        created()

        function created() {
            if (user) {
                localStorage.removeItem('listCheckout')
                $('#buttonBeli').html(`
                <button disabled class="btn--primary mt-2 mb-1 w-100">Beli Sekarang</button>
                `)
                $('#buttonBeliMobile').html(`
                <button disabled class="green-button float-end" style="border-radius: 10px">Beli Sekarang</button>
                `)
                var token = localStorage.getItem('token')
                let dataKeranjang;
                axios.get(`${API_URL}/v1/cart?member_id`${JSON.parse(user).karyawan.id}`, {
                        headers: {
                            'secret': API_SECRET,
                            'Author': 'bearer ' + token,
                            'device': 'web'
                        }
                    })
                    .then(function(response) {
                        dataKeranjang = response.data.data
                        if (dataKeranjang[0] == null) {
                            $('#mainScreen').html(`
                            <br><br><br><br>
                            <div class="container mt-5">
                                <center>
                                    <img src="{{ asset('images/empty.png') }}" width="250px" data-aos="fade-left" alt="">
                                    <h3 class="mt-3" data-aos="fade-in"><b> Wah, Keranjang Belanjamu Kosong </b></h3>
                                    <div class="text-secondary" data-aos="fade-in">Yuk, isi dengan barang-barang impianmu!</div>
                                    <a href="/" class="btn text-white mt-4" style="background: rgb(33, 195, 22);" data-aos="fade-up">Belanja
                                        Sekarang</a>
                                </center>
                            </div>
                            `)
                        } else {
                            $.each(dataKeranjang, function(key, value) {
                                handleClick(value)
                                // console.log('JSON.stringify(value)', JSON.stringify(value))
                                $('#listCheckoutKeranjang').append(`
                                <div class="persegi_panjang">
                                    <div class="konten2" style="display: flex; align-items: center;">
                                        <input onclick='handleClick(${JSON.stringify(value)})' checked class="form-check-input" type="checkbox" value=""
                                            id="flexCheckChecked" >
                                        <img src="${value.barang.photo[0] && value.barang.photo[0].path ? value.barang.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}"
                                            alt=""
                                            style="height: 5rem; width: 5rem; margin-left: 1.6rem; margin-top: 1rem; border-radius: 5%;">
                                        <div class="konten3">
                                            <p style="margin-top: 1rem; margin-left: 1rem; "> ${value.barang.nama} - ${value.barang.varian} </p>
                                            <p style="margin-left: 1rem; margin-top:-0.5rem;"><b> ${rp(value.harga)} </b></p>
                                        </div>
                                    </div>
                                    <div class="konten4"
                                        style="display: flex; justify-content: flex-end;">
                                        <div>

                                            <i id="subL" onclick="getIdL(${value.penyimpanan_id}, ${value.jumlah_stok})" style="cursor: pointer;" class="subL bi bi-dash-circle"
                                                data-feather="minus-circle"></i>
                                            &nbsp;
                                            <input value="${value.qty}" type="number" id="qty" value="1"
                                                style="width: 40px; border: 0; text-align: center; font-weight: bold;" />

                                            &nbsp;
                                            <i id="addL" onclick="getIdL(${value.penyimpanan_id}, ${value.jumlah_stok})" data-feather="plus-circle" class="addL bi bi-plus-circle"
                                                style="cursor: pointer;"></i>
                                        </div>
                                        &nbsp;&nbsp;|&nbsp;&nbsp;
                                        <a style="cursor: pointer" onclick="hapusKeranjang(${value.id})" class="text-dark">
                                            <i class="bi bi-trash"></i>&nbsp; Hapus
                                        </a>
                                    </div>
                                </div>
                                `)
                            })
                            $('.addL').click(function() {
                                if ($(this).prev().val() < jumlah) {
                                    let angka = $(this).prev().val()
                                    let qty = parseInt(angka) + 1
                                    $(this).prev().val(+$(this).prev().val() + 1);
                                    // let harga = $('#harga_produk').val()
                                    if (user) {
                                        payload = {
                                            penyimpanan_id: id,
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
                                                changeCheckout(qty)
                                            })
                                            .catch(function(error) {
                                                // handle error
                                                alert(error)
                                                console.log(error);
                                            });
                                    } else {
                                        var data = localStorage.getItem('listKeranjang') ? JSON.parse(
                                            localStorage.getItem(
                                                'listKeranjang')) : []
                                        data.map(res => {
                                            if (res.id == id) {
                                                res.qty = qty
                                            }
                                        })
                                        localStorage.setItem('listKeranjang', JSON.stringify(data))
                                        changeCheckout(qty)
                                    }
                                }
                            });
                            $('.subL').click(function() {
                                if ($(this).next().val() > 1) {
                                    if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
                                    // let harga = $('#harga_produk').val()
                                    let angka = $(this).next().val()
                                    let qty = parseInt(angka)
                                    if (user) {
                                        payload = {
                                            penyimpanan_id: id,
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
                                                changeCheckout(qty)
                                            })
                                            .catch(function(error) {
                                                // handle error
                                                alert(error)
                                                console.log(error);
                                            });
                                    } else {
                                        var data = localStorage.getItem('listKeranjang') ? JSON.parse(
                                            localStorage.getItem(
                                                'listKeranjang')) : []
                                        data.map(res => {
                                            if (res.id == id) {
                                                res.qty = qty
                                            }
                                        })
                                        localStorage.setItem('listKeranjang', JSON.stringify(data))
                                        changeCheckout(qty)
                                    }
                                }
                            });
                        }
                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    });

            } else {
                localStorage.removeItem('listCheckout')
                $('#buttonBeli').html(`
                <button disabled class="btn--primary mt-2 mb-1 w-100">Beli Sekarang</button>
                `)
                $('#buttonBeliMobile').html(`
                <button disabled class="green-button float-end" style="border-radius: 10px">Beli Sekarang</button>
                `)
                let dataKeranjang = localStorage.getItem('listKeranjang') ? JSON.parse(localStorage.getItem(
                    'listKeranjang')) : []
                if (dataKeranjang[0] == null) {
                    $('#mainScreen').html(`
                    <br><br><br><br>
                    <div class="container mt-5">
                        <center>
                            <img src="{{ asset('images/empty.png') }}" width="250px" data-aos="fade-left" alt="">
                            <h3 class="mt-3" data-aos="fade-in"><b> Wah, Keranjang Belanjamu Kosong </b></h3>
                            <div class="text-secondary" data-aos="fade-in">Yuk, isi dengan barang-barang impianmu!</div>
                            <a href="/" class="btn text-white mt-4" style="background: rgb(33, 195, 22);" data-aos="fade-up">Belanja
                                Sekarang</a>
                        </center>
                    </div>
                    `)
                } else {
                    $.each(dataKeranjang, function(key, value) {
                        handleClick(value)
                        // console.log('JSON.stringify(value)', JSON.stringify(value))
                        $('#listCheckoutKeranjang').append(`
                        <div class="persegi_panjang">
                            <div class="konten2" style="display: flex; align-items: center;">
                                <input onclick='handleClick(${JSON.stringify(value)})' checked class="form-check-input" type="checkbox" value=""
                                    id="flexCheckChecked" >
                                <img src="${value.barang.photo[0] && value.barang.photo[0].path ? value.barang.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}"
                                    alt=""
                                    style="height: 5rem; width: 5rem; margin-left: 1.6rem; margin-top: 1rem; border-radius: 5%;">
                                <div class="konten3">
                                    <p style="margin-top: 1rem; margin-left: 1rem; "> ${value.barang.nama} - ${value.barang.varian}  </p>
                                    <p style="margin-left: 1rem; margin-top:-0.5rem;"><b> ${rp(value.harga)} </b></p>
                                </div>
                            </div>
                            <div class="konten4"
                                style="display: flex; justify-content: flex-end;">
                                <div>

                                    <i id="sub" onclick="getId(${value.id}, ${value.jumlah})" style="cursor: pointer;" class="sub bi bi-dash-circle"
                                        data-feather="minus-circle"></i>
                                    &nbsp;
                                    <input value="${value.qty}" type="number" id="qty" value="1"
                                        style="width: 40px; border: 0; text-align: center; font-weight: bold;" />

                                    &nbsp;
                                    <i id="add" onclick="getId(${value.id}, ${value.jumlah})" data-feather="plus-circle" class="add bi bi-plus-circle"
                                        style="cursor: pointer;"></i>
                                </div>
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                <a style="cursor: pointer" onclick="hapusKeranjang(${value.id})" class="text-dark">
                                    <i class="bi bi-trash"></i>&nbsp; Hapus
                                </a>
                            </div>
                        </div>
                        `)
                    })
                }
            }
        }

        function handleClick(data) {
            var dataKeranjang = localStorage.getItem('listKeranjang') ? JSON.parse(localStorage.getItem('listKeranjang')) :
                []
            let item = dataKeranjang.find(res => res.id == data.id)
            let dataCheckout = localStorage.getItem('listCheckout') ? JSON.parse(localStorage.getItem('listCheckout')) : []
            console.log('localStorage.getItem', localStorage.getItem('listCheckout'))
            console.log('dataCheckout', dataCheckout)
            if (dataCheckout == null) {
                if (user) {
                    dataCheckout.push({
                        id: data.penyimpanan_id,
                        qty: data.qty,
                        jumlah: data.jumlah,
                        barang: data.barang,
                        harga: data.harga,
                        member_id: data.member_id
                    })
                } else {
                    dataCheckout.push({
                        id: item.id,
                        qty: item.qty,
                        jumlah: item.jumlah,
                        barang: item.barang,
                        harga: item.harga,
                        member_id: member_id
                    })
                }
                localStorage.setItem('listCheckout', JSON.stringify(dataCheckout))
            } else {
                if (user) {
                    var existCheckout = dataCheckout.find(res => {
                        return res.id == data.penyimpanan_id
                    })
                } else {
                    var existCheckout = dataCheckout.find(res => {
                        return res.id == item.id
                    })
                }
                if (!existCheckout) {
                    if (user) {
                        dataCheckout.push({
                            id: data.penyimpanan_id,
                            qty: data.qty,
                            jumlah: data.jumlah,
                            barang: data.barang,
                            harga: data.harga,
                            member_id: data.member_id
                        })
                    } else {
                        dataCheckout.push({
                            id: item.id,
                            qty: item.qty,
                            jumlah: item.jumlah,
                            barang: item.barang,
                            harga: item.harga,
                            member_id: item.member_id
                        })
                    }
                    localStorage.setItem('listCheckout', JSON.stringify(dataCheckout))
                } else {
                    if (user) {
                        var filterNot = dataCheckout.filter(res => res.id != data.penyimpanan_id)
                    } else {
                        var filterNot = dataCheckout.filter(res => res.id != item.id)
                    }
                    localStorage.setItem('listCheckout', JSON.stringify(filterNot))
                }
            }

            let listCheckout = localStorage.getItem('listCheckout') ? JSON.parse(localStorage.getItem('listCheckout')) : []
            var totalBarang = listCheckout.reduce((a, item) => {
                return a += parseInt(item.qty)
            }, 0)
            var totalHarga = listCheckout.reduce((a, item) => {
                return a += (item.harga * item.qty)
            }, 0)
            if (totalBarang > 0) {
                $('#buttonBeli').html(`
                <button onclick="beliSekarang()" class="btn--primary mt-2 mb-1 w-100">Beli Sekarang</button>
                `)
                $('#buttonBeliMobile').html(`
                <button onclick="beliSekarang()" class="green-button float-end" style="border-radius: 10px">Beli Sekarang</button>
                `)
            } else {
                $('#buttonBeli').html(`
                <button disabled class="btn--primary mt-2 mb-1 w-100">Beli Sekarang</button>
                `)
                $('#buttonBeliMobile').html(`
                <button disabled class="green-button float-end" style="border-radius: 10px">Beli Sekarang</button>
                `)
            }
            $("#qtyBarang").html(totalBarang)
            $("#total_harga").html(rp(totalHarga))
            $("#totalHarga").html(rp(totalHarga))
            $("#total").html(rp(totalHarga))
        }

        function hapusKeranjang(id) {
            if (user) {
                payload = {
                    id: id,
                }
                var token = localStorage.getItem('token')
                axios.post(`${API_URL}/v1/delete/cart`, [payload], {
                        headers: {
                            'secret': API_SECRET,
                            'Author': 'bearer ' + token,
                            'device': 'web'
                        }
                    })
                    .then(function(response) {
                        $('#listCheckoutKeranjang').html("")
                        $("#qtyBarang").html("0")
                        $("#total_harga").html("Rp.0")
                        $("#totalHarga").html("Rp.0")
                        $("#total").html("Rp.0")
                        created()
                    })
                    .catch(function(error) {
                        // handle error
                        alert(error)
                        console.log(error);
                    });
            } else {
                let listKeranjang = localStorage.getItem('listKeranjang') ? JSON.parse(localStorage.getItem(
                    'listKeranjang')) : []
                let filterNot = listKeranjang.filter(res => res.id != id)

                localStorage.setItem('listKeranjang', JSON.stringify(filterNot))
                $('#listCheckoutKeranjang').html("")
                $("#qtyBarang").html("0")
                $("#total_harga").html("Rp.0")
                $("#totalHarga").html("Rp.0")
                $("#total").html("Rp.0")
                created()
            }

        }

        function beliSekarang() {
            window.location.href = "/checkout?pass_cart=y"
        }

        var id;
        var jumlah;

        function getId(idValue, jumlahValue) {
            id = idValue;
            jumlah = jumlahValue;
        }

        $('.add').click(function() {
            if ($(this).prev().val() < jumlah) {
                let angka = $(this).prev().val()
                let qty = parseInt(angka) + 1
                $(this).prev().val(+$(this).prev().val() + 1);
                // let harga = $('#harga_produk').val()
                if (user) {
                    payload = {
                        penyimpanan_id: id,
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
                            changeCheckout(qty)
                        })
                        .catch(function(error) {
                            // handle error
                            alert(error)
                            console.log(error);
                        });
                } else {
                    var data = localStorage.getItem('listKeranjang') ? JSON.parse(localStorage.getItem(
                        'listKeranjang')) : []
                    data.map(res => {
                        if (res.id == id) {
                            res.qty = qty
                        }
                    })
                    localStorage.setItem('listKeranjang', JSON.stringify(data))
                    changeCheckout(qty)
                }
            }
        });
        $('.sub').click(function() {
            if ($(this).next().val() > 1) {
                if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
                // let harga = $('#harga_produk').val()
                let angka = $(this).next().val()
                let qty = parseInt(angka)
                var data = localStorage.getItem('listKeranjang') ? JSON.parse(localStorage.getItem(
                    'listKeranjang')) : []
                data.map(res => {
                    if (res.id == id) {
                        res.qty = qty
                    }
                })
                localStorage.setItem('listKeranjang', JSON.stringify(data))
                changeCheckout(qty)
                // let total_harga = harga * qty
                // $('#total_harga').html(rupiah(total_harga))
                // $('#total_harga').html(rupiah(total_harga))
            }
        });

        function getIdL(idValue, jumlahValue) {
            id = idValue;
            jumlah = jumlahValue;

        }






        function changeCheckout(qty) {
            let data = localStorage.getItem('listCheckout') ? JSON.parse(localStorage.getItem('listCheckout')) : []
            data.map(res => {
                if (res.id == id) {
                    res.qty = qty
                }
            })
            localStorage.setItem('listCheckout', JSON.stringify(data))

            let listCheckout = localStorage.getItem('listCheckout') ? JSON.parse(localStorage.getItem('listCheckout')) : []
            var totalBarang = listCheckout.reduce((a, item) => {
                return a += parseInt(item.qty)
            }, 0)
            var totalHarga = listCheckout.reduce((a, item) => {
                return a += (item.harga * item.qty)
            }, 0)
            if (totalBarang > 0) {
                $('#buttonBeli').html(`
            <button onclick="beliSekarang()" class="btn--primary mt-2 mb-1 w-100">Beli Sekarang</button>
            `)
            } else {
                $('#buttonBeli').html(`
            <button disabled class="btn--primary mt-2 mb-1 w-100">Beli Sekarang</button>
            `)
            }
            $("#qtyBarang").html(totalBarang)
            $("#total_harga").html(rp(totalHarga))
            $("#totalHarga").html(rp(totalHarga))
            $("#total").html(rp(totalHarga))
        }
    </script>
@endsection
