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
                <h6>berhasil</h6>
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
                <h6 id="message"></h6>
            </div>
        </div>
    </div>



    <div style="">
        <div class="container d-flex justify-content-center" style="margin-top: 100px;">
            <div class="card border-0 bg-white shadow p-4 col-lg-4 col-md-7 col-11 rounded-4">
                <h2 class="fw-bold mb-4">Daftar</h2>
    
                <!-- Tambahkan id untuk form -->
                <form id="form-daftar" onsubmit="return false;">
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-semibold">Nomor HP</label>
                        <input type="number" id="phone" class="form-control" name="phone" required>
                        <div class="mt-1 text-sm">Pastikan Nomor HP kamu aktif</div>
                    </div>
    
                    <!-- Tempat menampilkan error -->
                    <div id="message" class="text-danger small mt-2"></div>
    
                    <div class="d-grid mt-4">
                        <!-- ganti type="button" agar tidak reload -->
                        <button type="button" onclick="kirim()" class="btn btn-primary">
                            <span class="custom-daftar">Daftar</span>
                            <div class="custom-loader" hidden>
                                <div class="spinner-border spinner-border-sm text-light"></div>
                            </div>
                        </button>
                    </div>
    
                    <div class="text-center mt-4 text-muted">
                        Sudah punya akun? <a href="/login" class="text-decoration-none fw-semibold">Login</a>
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
        localStorage.removeItem("phone");

function kirim() {
    let phone = document.getElementById('phone').value;

    let data = { phone };

    // ganti tombol jadi loader
    $(".custom-daftar").attr("hidden", true);
    $(".custom-loader").attr("hidden", false);

    const headers = {
        'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
        'device': 'web',
    }

    axios.post(`${API_URL}/otp/request`, data, { headers })
        .then(function(response) {
            $(".custom-daftar").attr("hidden", false);
            $(".custom-loader").attr("hidden", true);

            // ✅ simpan nomor hp ke localStorage
            localStorage.setItem("phone", phone);

            localStorage.setItem("phone", phone);
                    localStorage.setItem("otp_expiry", Date.now() + 60 * 1000);

            // redirect ke halaman verifikasi
            window.location.href = "/daftar/verifikasi";
        })
        .catch(function(error) {
            $(".custom-daftar").attr("hidden", false);
            $(".custom-loader").attr("hidden", true);

            // tampilkan pesan error
            document.getElementById("message").innerText = error.response?.data?.message || "Terjadi kesalahan";

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
