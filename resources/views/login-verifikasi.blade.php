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

    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast toast-success border-0" style="padding: 5px;" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header text-success">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong class="me-auto">Success</strong>
                <a href="" data-bs-dismiss="toast" aria-label="Close"><i class="bi bi-x-lg text-dark"></i></a>
            </div>
            <div class="toast-body">
                <h6>Berhasil memuat</h6>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast toast-error border-0" style="padding: 5px;" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header text-danger">
                <i class="bi bi-x-circle-fill me-2"></i>
                <strong class="me-auto">Gagal</strong>
                <a href="" data-bs-dismiss="toast" aria-label="Close"><i class="bi bi-x-lg text-dark"></i></a>
            </div>
            <div class="toast-body">
                Gagal
                {{-- <h6 id="message"></h6> --}}
            </div>
        </div>
    </div>



    <div style="">
        <div class="container d-flex justify-content-center" style="margin-top: 100px;">
            <div class="card border-0 bg-white shadow p-4 col-lg-4 col-md-7 col-11 rounded-4">
                <h4 class="fw-bold mb-4">Verifikasi kode OTP</h4>
                <div>
                    Kode OTP dikirim ke nomor <b id="nomorHp"></b>
                </div>
    
                <!-- Countdown -->
                <div>
                    Kirim ulang OTP dalam <span id="countdown" class="text-white fw-bold"></span>
                </div>
                <br>
    
                <!-- Tombol kirim ulang OTP (hidden default) -->
                <div id="resendWrapper" class="d-grid mb-3" style="display: none;">
                    <button type="button" onclick="resendOtp()" class="btn btn-outline-primary">
                        Kirim Ulang OTP
                    </button>
                </div>
    
                <form id="form-daftar" onsubmit="return false;">
                    <div class="mb-3">
                        <label for="otp" class="form-label fw-semibold">Kode OTP</label>
                        <input type="number" id="otp" class="form-control" name="otp" required>
                    </div>
                    <div class="d-grid mt-2">
                        <button type="button" onclick="verifikasi()" class="btn btn-primary">
                            <span class="custom-daftar">Verifikasi</span>
                            <div class="custom-loader" hidden></div>
                        </button>
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
        // ambil nomor hp dari localStorage
        let phone = localStorage.getItem("phone");
        if(phone == null) {
            window.location.href = "/login";
        }
        if (phone) {
            document.getElementById("nomorHp").innerText = phone;
        }

        let timer;

        document.addEventListener("DOMContentLoaded", function () {
            // tampilkan nomor dari localStorage
            let phone = localStorage.getItem("phone");
            if (phone) {
                document.getElementById("nomorHp").innerText = phone;
            } else {
                window.location.href = "/login"; // kalau belum ada phone, balik ke login
            }

            startCountdown();
        });

        function startCountdown() {
            const countdownElement = document.getElementById("countdown");
            const resendWrapper = document.getElementById("resendWrapper");

            // sembunyikan tombol resend
            resendWrapper.style.display = "none";

            // cek apakah ada expiry di localStorage
            let expiry = localStorage.getItem("otp_expiry");

            if (!expiry) {
                // set expiry baru (60 detik dari sekarang)
                expiry = Date.now() + 60 * 1000;
                localStorage.setItem("otp_expiry", expiry);
            } else {
                expiry = parseInt(expiry);
            }

            function updateCountdown() {
                const now = Date.now();
                const diff = expiry - now;

                if (diff <= 0) {
                    countdownElement.innerText = "00:00";
                    localStorage.removeItem("otp_expiry");
                    clearInterval(timer);
                    resendWrapper.style.display = "block"; // tampilkan tombol resend
                } else {
                    const seconds = Math.floor(diff / 1000);
                    const minutes = Math.floor(seconds / 60);
                    const remainingSeconds = seconds % 60;
                    countdownElement.innerText =
                        `${String(minutes).padStart(2, '0')}:${String(remainingSeconds).padStart(2, '0')}`;
                }
            }

            updateCountdown();
            timer = setInterval(updateCountdown, 1000);
        }

        function resendOtp() {
            let phone = localStorage.getItem("phone");
            if (!phone) {
                window.location.href = "/login";
                return;
            }

            let data = {
                phone: phone,
                action: "login"
            };

            const headers = {
                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                'device': 'web',
            };

            axios.post(`${API_URL}/otp/request`, data, { headers })
                .then(function (response) {
                    var toastElList = [].slice.call(document.querySelectorAll('.toast-success'))
                    var toastList = toastElList.map(function(toastEl) {
                        return new bootstrap.Toast(toastEl)
                    })
                    toastList.forEach(toast => toast.show())

                    // set expiry baru 60 detik
                    localStorage.setItem("otp_expiry", Date.now() + 60 * 1000);

                    // restart countdown
                    startCountdown();
                })
                .catch(function (error) {
                    // tampilkan pesan error
                    document.getElementById("message").innerText = error.response?.data || "Terjadi kesalahan";

                    // kalau mau pakai toast bootstrap
                    var toastElList = [].slice.call(document.querySelectorAll('.toast-error'))
                    var toastList = toastElList.map(function(toastEl) {
                        return new bootstrap.Toast(toastEl)
                    })
                    toastList.forEach(toast => toast.show())
                });
        }

        function verifikasi() {
            let data = {
                phone: phone,
                otp: document.getElementById('otp').value,
                action: "login"
            }

            // ganti tombol jadi loader
            $(".custom-daftar").attr("hidden", true);
            $(".custom-loader").attr("hidden", false);

            const headers = {
                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                'device': 'web',
            }

            axios.post(`${API_URL}/otp/verify`, data, { headers })
                .then(function(response) {
                    $(".custom-daftar").attr("hidden", false);
                    $(".custom-loader").attr("hidden", true);
                    var toastElList = [].slice.call(document.querySelectorAll('.toast-success'))
                    var toastList = toastElList.map(function(toastEl) {
                        return new bootstrap.Toast(toastEl)
                    })
                    toastList.forEach(toast => toast.show())
                    localStorage.setItem('token', response.data.tokens)
                    localStorage.setItem('user', JSON.stringify(response.data.data))
                    localStorage.removeItem("phone");
                    window.location.href = "/";
                })
                .catch(function(error) {
                    $(".custom-daftar").attr("hidden", false);
                    $(".custom-loader").attr("hidden", true);

                    // tampilkan pesan error
                    document.getElementById("message").innerText = error.response?.data.message;

                    // kalau mau pakai toast bootstrap
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
