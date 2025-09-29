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
                <h6>Anda berhasil login</h6>
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
                <h2 class=" fw-bold mb-3">Login</h2>
                <form onsubmit="kirimOtp(event)">
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-semibold">Nomor HP</label>
                        <input type="phone" id="phone" class="form-control" name="phone" required placeholder="08123xxx">
                    </div>
                
                    <div class="d-grid mt-2">
                        <button type="submit" class="btn btn-primary">
                            <span class="custom-daftar">Login</span>
                            <div class="custom-loader" hidden></div>
                        </button>
                    </div>
                    <!-- Additional Login Options -->
            <div class="d-flex justify-content-center my-4">
                <span class="text-muted">ATAU</span>
            </div>

            <div class="d-grid gap-1 mt-2">
                <a href="/login-user" type="button" class="btn btn-outline-primary mb-1">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>Login dengan Username
                </a>
                {{-- <button class="btn mb-2" style="background-color: white; border: 1px solid rgb(208, 208, 208); font-weight: bold;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48">
                      <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.19 3.61l6.85-6.85C35.9 2.7 30.47 0 24 0 14.64 0 6.48 5.36 2.69 13.11l7.97 6.19C12.57 13.42 17.88 9.5 24 9.5z"/>
                      <path fill="#4285F4" d="M46.5 24c0-1.5-.14-2.95-.39-4.35H24v8.26h12.7c-.55 2.98-2.19 5.5-4.66 7.19l7.1 5.51C43.48 36.5 46.5 30.72 46.5 24z"/>
                      <path fill="#FBBC05" d="M10.66 28.3c-.47-1.38-.73-2.85-.73-4.3s.26-2.92.73-4.3l-7.97-6.19C1.66 16.64 0 20.13 0 24s1.66 7.36 4.69 10.49l7.97-6.19z"/>
                      <path fill="#34A853" d="M24 48c6.48 0 11.91-2.12 15.88-5.77l-7.1-5.51c-2 1.36-4.61 2.16-8.78 2.16-6.12 0-11.43-3.92-13.34-9.39l-7.97 6.19C6.48 42.64 14.64 48 24 48z"/>
                    </svg>
                    <span>Login dengan Akun Google</span>
                </button> --}}
                  
            </div>
                    <div class="text-center mt-4 text-muted">
                        Belum punya akun? <a href="/daftar" class="text-decoration-none fw-semibold">Daftar Disini</a>
                    </div>

                </form>
            </div>
        </div>
        
    </div>

    {{-- <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" id="email" class="form-control " name="email" required>
                    </div>
        
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" id="password" class="form-control" name="password" required>
                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input" onclick="showPassword()" id="showPass">
                            <label for="showPass" class="form-check-label mt-1">Lihat Password</label>
                        </div>
                    </div> --}}

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

        function kirimOtp(e) {
            e.preventDefault(); // cegah form submit reload halaman

            let phone = document.getElementById('phone').value;

            let data = {
                phone: phone,
                action: "login"
            };

            $(".custom-daftar").attr("hidden", true);
            $(".custom-loader").attr("hidden", false);

            const headers = {
                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                'device': 'web',
            };

            axios.post(`${API_URL}/otp/request`, data, { headers })
                .then(function(response) {
                    $(".custom-daftar").attr("hidden", false);
                    $(".custom-loader").attr("hidden", true);

                    // simpan nomor HP ke localStorage
                    localStorage.setItem("phone", phone);
                    localStorage.setItem("otp_expiry", Date.now() + 60 * 1000);

                    // redirect ke halaman verifikasi OTP
                    window.location.href = "/login/verifikasi";
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
                })
                .finally(function() {
                    $(".custom-daftar").attr("hidden", false);
                    $(".custom-loader").attr("hidden", true);
                });
        }


        function login() {
            let data = {
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
            }
            $(".custom-daftar").attr("hidden", true);
            $(".custom-loader").attr("hidden", false);
            const headers = {
                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                'device': 'web',
            }

            axios.post(`${API_URL}/auth/user-login`, data, {
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
                    localStorage.setItem('token', response.data.tokens)
                    localStorage.setItem('user', JSON.stringify(response.data.data))
                    window.location.href = "/";
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
