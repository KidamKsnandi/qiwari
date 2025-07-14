@extends('layouts.member')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    {{-- <link rel="stylesheet" href="{{ asset('css/select2.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        label {
            float: left;
            font-size: 11px;
            margin-bottom: 5px;
        }

        .bg-daftar {
            background: #7044ef;
            height: 300px;
        }

        button:hover {
            background: #7044ef;
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

        @keyframes s3 {
            100% {
                transform: rotate(1turn)
            }
        }
    </style>
    <br><br><br>

    <div class="toast-container position-fixed bottom-0 end-0 p-3 mb-2" style="z-index: 11">
        <div id="liveToast" class="toast toast-success border-0" style="padding: 5px;" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header text-success">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong class="me-auto">Success</strong>
                <a href="" data-bs-dismiss="toast" aria-label="Close"><i class="bi bi-x-lg text-dark"></i></a>
            </div>
            <div class="toast-body">
                <h6>Anda berhasil melakukan daftar</h6>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3 mb-2" style="z-index: 11">
        <div id="liveToast" class="toast toast-error border-0" style="padding: 5px;" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header text-danger">
                <i class="bi bi-x-circle-fill me-2"></i>
                <strong class="me-auto">Gagal</strong>
                <a href="" data-bs-dismiss="toast" aria-label="Close"><i class="bi bi-x-lg text-dark"></i></a>
            </div>
            <div class="toast-body">
                <h6 id="message"></h6>
            </div>
        </div>
    </div>



    <section id="contact" class="contact" style="background: rgba(245, 245, 245, 0.116);">

        <div class="container" data-aos="fade-up">

            <h2 class="text-center text--primary"><b> Form Pendaftaran Member</b></h2>
            <br>

            <div style="display: flex; justify-content: center;">
                <form action="" method="post" class="col-lg-7 php-email-form bg-white card border-0"
                    style="box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.13);">
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <label for="">NAMA</label>
                            <input type="text" id="nama" name="nama" class="form-control" placeholder=""
                                required>
                        </div>

                        <div class="col-md-6 ">
                            <label for="">EMAIL</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder=""
                                required>
                        </div>

                        {{-- <div class="col-md-12">
                            <label for="">Jenis Kelamin</label>
                            <select name="jk" id="jk" class="form-control" style="width: 100%;" id="">
                                <option value="">- Pilih Jenis Kelamin -</option>
                                <option value="1">Laki-Laki </option>
                                <option value="2">Perempuan </option>
                            </select>

                        </div> --}}
                        <div class="col-md-12">
                            <label for="">NO HP</label>
                            <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder=""
                                required>
                        </div>
                        {{-- <div class="col-md-12">
                            <label for="">PROVINSI</label>
                            <select name="provinsi_id" id="provinsi_id" class="theSelect form-control" style="width: 100%; "
                                id="">
                                <option value="" style="">- Pilih -</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="">KAB/KOTA</label>
                            <select disabled name="kab_kota_id" id="kab_kota_id" class="theSelect form-control"
                                style="width: 100%;" id="">
                                <option value="">- Pilih -</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="">KECAMATAN</label>
                            <select disabled name="kecamatan_id" id="kecamatan_id" class="theSelect form-control"
                                style="width: 100%;" id="">
                                <option value="">- Pilih -</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="">DESA/KELURAHAN</label>
                            <select disabled name="kelurahan_id" id="kelurahan_id" class="theSelect form-control"
                                style="width: 100%;" id="">
                                <option value="">- Pilih -</option>
                            </select>
                        </div> --}}
                        {{-- <div class="col-md-12">
                            <label for="">ALAMAT LENGKAP</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="" required></textarea>
                        </div> --}}
                        <div class="col-md-12">
                            <label for="">PASSWORD</label>
                            <input type="password" id="password" class="form-control" name="password" id="password"
                                placeholder="" required>
                            <div class="float-start mt-1">
                                <input type="checkbox" onclick="showPassword()" class="mr-1">&nbsp; Lihat
                                Password
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="">KONFIRMASI PASSWORD</label>
                            <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password"
                                placeholder="" required>
                            <div class="float-start mt-1">
                                <input type="checkbox" onclick="showKonfirmasiPassword()" class="mr-1">&nbsp;
                                Lihat Password
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" onclick="daftar()"
                                style="background: rgb(10, 115, 250);
                            background: linear-gradient(
                              139deg,
                              rgba(10, 115, 250, 1) 0%,
                              rgba(112, 68, 239, 1) 72%
                            );"
                                class="col-5 mt-3">
                                <center>
                                    <div class="custom-daftar">Daftar</div>
                                    <div class="custom-loader" hidden></div>
                                </center>
                            </button>
                        </div>
                        <div class="text-center">Sudah punya akun? <a href="/login">Login Disini</a></div>


                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('lib/axios.min.js') }}"></script>
    <script src="{{ asset('lib/select2.min.js') }}"></script>

    <script>
        $(".theSelect").select2();
    </script>

    <script>
        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function showKonfirmasiPassword() {
            var y = document.getElementById("konfirmasi_password");
            if (y.type === "password") {
                y.type = "text";
            } else {
                y.type = "password";
            }
        }

        // Get Provinsi
        function getProvinsi() {
            axios.get('https://api-bal.zuppaqu.com/v1/wilayah/provinsi', {
                    headers: {
                        'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    let dataProvinsi = response.data.data
                    $('#provinsi_id').html('<option value="">- Pilih -</option>');
                    $.each(dataProvinsi, function(key, value) {
                        $("#provinsi_id").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        }

        getProvinsi()

        // Get Kab Kota
        $(document).ready(function() {
            $('#provinsi_id').on('change', function() {
                var id_provinsi = this.value;
                axios.get(
                        `https://api-bal.zuppaqu.com/v1/wilayah/kab-kota?id_provinsi=${id_provinsi}`, {
                            headers: {
                                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                                'device': 'web'
                            }
                        })
                    .then(function(response) {
                        let dataKabKota = response.data.data
                        $("#kab_kota_id").attr("disabled", false);
                        $('#kab_kota_id').html('<option value="">- Pilih -</option>');
                        $.each(dataKabKota, function(key, value) {
                            $("#kab_kota_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    });
            });

            // Get Kecamatan
            $('#kab_kota_id').on('change', function() {
                var id_kab_kota = this.value;
                axios.get(
                        `https://api-bal.zuppaqu.com/v1/wilayah/kecamatan?id_kab_kota=${id_kab_kota}`, {
                            headers: {
                                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                                'device': 'web'
                            }
                        })
                    .then(function(response) {
                        let dataKabKota = response.data.data
                        $("#kecamatan_id").attr("disabled", false);
                        $('#kecamatan_id').html('<option value="">- Pilih -</option>');
                        $.each(dataKabKota, function(key, value) {
                            $("#kecamatan_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    });
            });
            // Get Desa Kelurahan
            $('#kecamatan_id').on('change', function() {
                var id_kecamatan = this.value;
                axios.get(
                        `https://api-bal.zuppaqu.com/v1/wilayah/kelurahan?id_kecamatan=${id_kecamatan}`, {
                            headers: {
                                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                                'device': 'web'
                            }
                        })
                    .then(function(response) {
                        let dataKabKota = response.data.data
                        $("#kelurahan_id").attr("disabled", false);
                        $('#kelurahan_id').html('<option value="">- Pilih -</option>');
                        $.each(dataKabKota, function(key, value) {
                            $("#kelurahan_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    });
            });
        });

        function daftar() {
            let data = {
                nama_lengkap: document.getElementById('nama').value,
                // jk: document.getElementById('jk').value,
                email: document.getElementById('email').value,
                no_hp: document.getElementById('no_hp').value,
                // provinsi_id: document.getElementById('provinsi_id').value,
                // kab_kota_id: document.getElementById('kab_kota_id').value,
                // kecamatan_id: document.getElementById('kecamatan_id').value,
                // kelurahan_id: document.getElementById('kelurahan_id').value,
                // alamat: document.getElementById('alamat').value,
                password: document.getElementById('password').value,
                konfirmasi_password: document.getElementById('konfirmasi_password').value
            }
            console.log('data', data)
            $(".custom-daftar").attr("hidden", true);
            $(".custom-loader").attr("hidden", false);
            const headers = {
                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                'device': 'web',
            }

            axios.post('https://api-bal.zuppaqu.com/v1/affiliator/register', data, {
                    headers: headers
                })
                .then(function(response) {
                    $(".custom-daftar").attr("hidden", false);
                    $(".custom-loader").attr("hidden", true);
                    var toastElList = [].slice.call(document.querySelectorAll('.toast-success'))
                    var toastList = toastElList.map(function(toastEl) {
                        return new bootstrap.Toast(toastEl)
                    })
                    toastList.forEach(toast => toast.show())
                    window.location.href = "/login"
                    // location.reload();
                })
                .catch(function(error) {
                    $(".custom-daftar").attr("hidden", false);
                    $(".custom-loader").attr("hidden", true);
                    document.getElementById("message").innerHTML = error.response.data.message;
                    var toastElList = [].slice.call(document.querySelectorAll('.toast-error'))
                    var toastList = toastElList.map(function(toastEl) {
                        return new bootstrap.Toast(toastEl)
                    })
                    toastList.forEach(toast => toast.show())
                    console.log(error);
                });

        }
    </script>
@endsection
