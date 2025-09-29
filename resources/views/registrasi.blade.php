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

        html, body {
  overflow-x: hidden;
}

        .select2-container {
      width: 100% !important;
      max-width: 100% !important;
      box-sizing: border-box;
    }

    /* Style dasar */
    .select2-container .select2-selection--single {
      height: 48px; 
      padding: 8px 12px;
      border: 1px solid #ced4da;
      border-radius: 8px; 
      background-color: #fff;
      font-size: 15px;
      transition: all 0.2s ease-in-out;
      width: 100%;
    }

    /* Hover effect */
    .select2-container .select2-selection--single:hover {
      border-color: #B79657;
      box-shadow: 0 0 5px rgba(57, 167, 74, 0.3);
    }

    /* Fokus (ketika dropdown aktif) */
    .select2-container--default .select2-selection--single:focus {
      outline: none;
      border-color: #B79657;
      box-shadow: 0 0 5px rgba(57, 167, 74, 0.4);
    }

    /* Text pilihan */
    .select2-container .select2-selection__rendered {
      color: #333;
      line-height: 32px;
    }

    /* Tombol arrow */
    .select2-container .select2-selection__arrow {
      top: 10px;
      right: 8px;
    }

    /* Dropdown hasil pencarian */
    .select2-container .select2-dropdown {
      border-radius: 8px;
      border: 1px solid #ddd;
      padding: 4px;
      max-width: 100% !important;
      box-sizing: border-box;
    }

    /* Input pencarian dalam dropdown */
    .select2-search--dropdown .select2-search__field {
      border-radius: 6px;
      padding: 6px 10px;
      border: 1px solid #ccc;
      width: 100% !important;
      box-sizing: border-box;
    }

    /* Item dropdown */
    .select2-results__option {
      padding: 10px;
      font-size: 14px;
      border-radius: 6px;
      color: black;
      transition: background 0.2s;
    }

    /* Item hover */
    .select2-results__option--highlighted {
      background: #B79657;
      color: black;
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

        <div style=" min-height: 100vh;">
            <div class="container d-flex justify-content-center align-items-center py-5" data-aos="fade-up">
              <div class="card border-0 bg-white shadow p-4 col-lg-6 col-md-9 col-11 rounded-4">
                
                <h4 class="fw-bold mb-4">Form Registrasi Pendaftaran</h4>
          
                <form id="form-daftar" onsubmit="return false;">
                  <div class="row gy-3">
                    
                    <div class="col-md-6">
                      <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                      <input type="text" id="nama" name="nama" class="form-control" required>
                    </div>
          
                    <div class="col-md-6">
                      <label for="email" class="form-label fw-semibold">Email</label>
                      <input type="email" id="email" name="email" class="form-control" required>
                    </div>
          
                    <div class="col-md-12">
                      <label for="phone" class="form-label fw-semibold">Nomor HP</label>
                      <input type="number" id="phone" name="no_hp" class="form-control disable" required>
                      <small class="">
                        <i>*) Pastikan Nomor Handphone Aktif.</i>
                      </small>
                    </div>
          
                    <div class="col-md-12">
                      <label for="provinsi_id" class="form-label fw-semibold">Provinsi</label>
                      <select name="provinsi_id" id="provinsi_id" class="form-control theSelect">
                        <option value="">- Pilih -</option>
                      </select>
                    </div>
          
                    <div class="col-md-12">
                      <label for="kab_kota_id" class="form-label fw-semibold">Kab/Kota</label>
                      <select disabled name="kab_kota_id" id="kab_kota_id" class="form-control theSelect">
                        <option value="">- Pilih -</option>
                      </select>
                    </div>
          
                    <div class="col-md-12">
                      <label for="kecamatan_id" class="form-label fw-semibold">Kecamatan</label>
                      <select disabled name="kecamatan_id" id="kecamatan_id" class="form-control theSelect">
                        <option value="">- Pilih -</option>
                      </select>
                    </div>
          
                    <div class="col-md-12">
                      <label for="kelurahan_id" class="form-label fw-semibold">Desa/Kelurahan</label>
                      <select disabled name="kelurahan_id" id="kelurahan_id" class="form-control theSelect">
                        <option value="">- Pilih -</option>
                      </select>
                    </div>
          
                    <div class="col-md-12">
                      <label for="alamat" class="form-label fw-semibold">Alamat Lengkap</label>
                      <textarea id="alamat" name="alamat" rows="3" class="form-control" required></textarea>
                    </div>
          
                    <div class="col-md-12">
                      <label for="password" class="form-label fw-semibold">Password</label>
                      <input type="password" id="password" name="password" class="form-control" required>
                      <div class="form-check mt-2">
                        <input type="checkbox" class="form-check-input" onclick="showPassword()" id="showPass">
                        <label class="form-check-label mt-1" for="showPass">Lihat Password</label>
                      </div>
                    </div>
          
                    <div class="col-md-12">
                      <label for="konfirmasi_password" class="form-label fw-semibold">Konfirmasi Password</label>
                      <input type="password" id="konfirmasi_password" name="konfirmasi_password" class="form-control" required>
                      <div class="form-check mt-2">
                        <input type="checkbox" class="form-check-input" onclick="showKonfirmasiPassword()" id="showPass2">
                        <label class="form-check-label mt-1" for="showPass2">Lihat Password</label>
                      </div>
                    </div>
          
                    <div class="col-md-12 mt-4">
                      <button type="submit" onclick="daftar()" 
                        class="btn btn-primary w-100 text-white">
                        <span class="custom-daftar">Daftar</span>
                        <div class="custom-loader" hidden>
                        </div>
                      </button>
                    </div>
          
                  </div>
                </form>
              </div>
            </div>
          </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('lib/axios.min.js') }}"></script>
    <script src="{{ asset('lib/select2.min.js') }}"></script>

    <script>
        $(".theSelect").select2();
    </script>

    <script>
      var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
    var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
        let phone = localStorage.getItem("phone");
        if(phone == null) {
            //window.location.href = "/";
        }

        document.addEventListener("DOMContentLoaded", function() {
            let phone = localStorage.getItem("phone");
            if (phone) {
            document.getElementById("phone").value = phone;
            }
        });
        
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
            axios.get(`${API_URL}/wilayah/provinsi`, {
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
                        `${API_URL}/wilayah/kab-kota?id_provinsi=${id_provinsi}`, {
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
                        `${API_URL}/wilayah/kecamatan?id_kab_kota=${id_kab_kota}`, {
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
                        `${API_URL}/wilayah/kelurahan?id_kecamatan=${id_kecamatan}`, {
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
                no_hp: document.getElementById('phone').value,
                provinsi_id: document.getElementById('provinsi_id').value,
                kab_kota_id: document.getElementById('kab_kota_id').value,
                kecamatan_id: document.getElementById('kecamatan_id').value,
                kelurahan_id: document.getElementById('kelurahan_id').value,
                alamat: document.getElementById('alamat').value,
                password: document.getElementById('password').value,
                konfirmasi_password: document.getElementById('konfirmasi_password').value,
                request_otp: 1
            }
            $(".custom-daftar").attr("hidden", true);
            $(".custom-loader").attr("hidden", false);
            const headers = {
                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                'device': 'web',
            }

            axios.post(`${API_URL}/affiliator/register`, data, {
                    headers: headers
                })
                .then(function(response) {
                  localStorage.setItem('phone', data.no_hp)
                    $(".custom-daftar").attr("hidden", false);
                    $(".custom-loader").attr("hidden", true);
                    var toastElList = [].slice.call(document.querySelectorAll('.toast-success'))
                    var toastList = toastElList.map(function(toastEl) {
                        return new bootstrap.Toast(toastEl)
                    })
                    toastList.forEach(toast => toast.show())
                    
                    window.location.href = "/daftar/verifikasi"
                })
                .catch(function(error) {
                    $(".custom-daftar").attr("hidden", false);
                    $(".custom-loader").attr("hidden", true);
                    document.getElementById("message").innerHTML = error.response.data;
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
