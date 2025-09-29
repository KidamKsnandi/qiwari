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
                <form>
                    <div id="email-login" >
                        <div class="col-md-12 mb-4">
                            <label for="email" class="form-label">Email / Username</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" id="email" class="form-control" name="email"
                                    placeholder="Masukkan Email" required>
                            </div>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="Masukkan Password" required>
                            </div>
                            <div class="form-text text-start mt-1">
                                <input type="checkbox" onclick="showPassword()">&nbsp; Lihat Password
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" onclick="loginEmail(event)" class="btn btn-primary w-100">
                                <span class="custom-daftar">Login</span>
                                <div class="custom-loader" hidden></div>
                            </button>
                        </div>
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

        function loginEmail(ev) {
            ev.preventDefault()
            let data = {
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
            }
            $(".custom-login").attr("hidden", true);
            $(".custom-loader").attr("hidden", false);
            const headers = {
                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                'device': 'web',
            }

            axios.post(`${API_URL}/auth/user-login`, data, {
                headers: headers
            })
            .then(function(response) {
                $(".custom-login").attr("hidden", false);
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
                $(".custom-login").attr("hidden", false);
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
