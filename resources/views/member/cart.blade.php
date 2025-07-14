{{-- @extends('layouts.member')

@section('content')
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
@endsection --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,800;1,200&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        <div class="bungkus">
            <div class="gabungan">
                <div class="judul" style="display:flex ;">
                    <h2>keranjang</h2>
                </div>

                <div class="list"
                    style="width: 40rem; height: 0.2rem; background-color:
            #F3F4F5; margin-top: 1rem;">
                </div>
                <div class="persegi_panjang">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked" style="font-weight: 500;">
                            <img src="https://img.freepik.com/premium-photo/woman-vibrant-calavera-makeup-celebrates-day-dead_731930-42762.jpg"
                                alt=""
                                style="height: 1rem; width: 1rem; margin-left: 0.6999999999999993rem; margin-top: 1rem; border-radius: 5%;">
                            &nbsp; Sony audio offical
                        </label>
                    </div>
                    <p style="margin-left: 1.6rem; font-size: small;">jakarta pusat</p>
                    <div class="konten2" style="display: flex;">
                        <img src="https://img.freepik.com/premium-photo/woman-vibrant-calavera-makeup-celebrates-day-dead_731930-42762.jpg"
                            alt=""
                            style="height: 5rem; width: 5rem; margin-left: 1.5rem; margin-top: 1rem; border-radius: 5%;">
                        <div class="konten3">
                            <p style="margin-top: 1rem; margin-left: 0.5rem; font-size:medium;">SONY WI-C100 Blue
                                Wireless In-ear Sport Earphone / WIC100 / WI C100 </p>
                            <p style="margin-left: 0.5rem; font-weight: 800;">Rp20.000</p>
                        </div>
                    </div>
                    <div class="konten4" style="display: flex; justify-content: flex-end; margin-top: 1rem">
                        <p style="margin-right: 1rem;">pindah kan ke whistlist</p>
                        |
                        <i data-feather="trash-2" style="margin-left: 0.5rem; margin-right: 3rem"></i>
                        <i data-feather="plus-circle" style="margin-left: 0.5rem; margin-right: 1rem"></i>
                        <p> 1 </p>
                        <i data-feather="minus-circle" style="margin-left: 0.5rem; margin-right: 3rem"></i>

                    </div>
                </div>
                <div class="list" style="width: 40rem; height: 0.2rem; background-color:
            #F3F4F5"></div>
            </div>
            <div class="persegi">
                <div class="in_persegi">
                </div>
                <h4>Ringkasan belanja</h4>
                <div class="baris1">
                    <p>Total Harga (1 barang)</p>
                    <p>Rp499.000</p>
                </div>
                <div class="baris1">
                    <p>Total Diskon Barang</p>
                    <p>Rp499.000</p>
                </div>
                <center>
                    <hr>
                </center>
                <div class="baris1">
                    <h3>Total Harga</h3>
                    <h3>Rp599.000</h3>
                </div>
                <center>
                    <button class="green-button">Tombol Hijau</button>
                </center>
            </div>
        </div>
    </div>


    <div class="card_bottom">
        <div class="list" style="width: 100%; height: 0.2rem; background-color:
            #F3F4F5"></div>
        <div class="bungkus_card_bottom">
            <div class="bagian_kiri">

                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked
                    style="width: 2rem; height: 2rem; margin-left: 2rem; margin-top: 2rem;">
                <label class="form-check-label" for="flexCheckChecked"
                    style="font-weight: 300; font-size: larger; margin-bottom: 5rem">
                    &nbsp; Semua
                </label>
            </div>

            <div class="bagian_kanan">
                <div class="bungkus_teks_bagian_kanan"
                    style="display: flex; flex-direction: column; align-items: flex-end">
                    <p style="margin-top: 1.5rem;">Total</p>
                    <h3>Rp.20.000</h3>
                </div>
                <button class="green-button">Tombol Hijau</button>
            </div>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>

</html>

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

    .container {
        display: flex;
        justify-content: center;
        width: 100%;
        height: 100vh;
        background-color: rgb(255, 255, 255);
    }

    .bungkus {
        display: flex;
        justify-content: center;
        width: 67%;
        height: 100%;
        background-color: #fff;
    }


    .persegi_panjang {
        display: flex;
        flex-direction: column;
        margin-right: 3rem;
        border-radius: 10px;
        width: 40rem;
        height: 13.5rem;
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
        .persegi {
            display: none;
        }

        .card_bottom {
            display: block;
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 7rem;
        }

        .bungkus_card_bottom {
            display: flex;
            justify-content: space-between;
        }

        .bungkus_card_bottom .bagian_kanan {
            display: flex;
        }

        .bungkus_card_bottom .bagian_kanan .green-button {
            margin: 25px 14px;
            background-color: #23971b;
            /* Warna hijau */
            color: #fff;
            /* Warna teks putih */
            width: 7rem;
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
</style>
