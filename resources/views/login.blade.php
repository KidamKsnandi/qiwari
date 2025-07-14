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

        .otp-input-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .otp-input {
            width: 60px;
            height: 50px;
            font-size: 24px;
            text-align: center;
            border: 2px solid rgba(10, 115, 250, 0.5);
            border-radius: 10px;
            outline: none;
            transition: all 0.3s ease;
        }

        .otp-input:focus {
            border-color: rgb(74, 239, 68);
            box-shadow: 0 0 5px rgb(74, 239, 67);
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



    <section id="contact" class="contact" style="background: rgba(245, 245, 245, 0.116);">

        <div class="container py-5" data-aos="fade-up" id="loginView" style="display: none">
            <h2 class="text-center text--primary mb-4"><b>Login</b></h2>

            <div style="display: flex; justify-content: center;">
                <form action="" method="post" id="php-email-form"
                    class="col-lg-6 php-email-form bg-white card border-0 p-4"
                    style="box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.13); border-radius: 15px;">
                    <div class="row gy-4">
                        <!-- Conditional rendering based on URL parameter -->
                        <!-- Jika type=whatsapp -->
                        <div id="whatsapp-login" style="display: none;">
                            <div class="col-md-12">
                                <label for="phone" class="form-label">Nomor Telepon Whatsapp</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-phone"></i>
                                    </span>
                                    <input type="tel" id="phone" class="form-control" name="phone"
                                        placeholder="Masukkan Nomor Telepon" required min="12">
                                </div>
                            </div>


                            <div class="col-md-12 text-center">
                                <button type="submit" onclick="loginWhatsapp()" class="btn btn-primary col-10 mt-3"
                                    style="background: linear-gradient(47deg, rgb(126, 213, 149) 0%, #23ca23 68%); border-radius: 25px;">
                                    <div class="custom-login"> <i class="bi bi-whatsapp me-2"></i>Login via WhatsApp</div>
                                    <center>
                                        <div class="custom-loader" hidden></div>
                                    </center>

                                </button>
                            </div>
                        </div>

                        <!-- Jika type=email -->
                        <div id="email-login" style="display: none;">
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" id="email" class="form-control" name="email"
                                        placeholder="Masukkan Email" required>
                                </div>
                            </div>

                            <div class="col-md-12">
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
                                <button type="submit" onclick="loginEmail()" class="btn btn-primary col-8 mt-3"
                                    style="background: linear-gradient(47deg, rgb(126, 213, 149) 0%, #23ca23 68%); border-radius: 25px;">
                                    <div class="custom-login"> <i class="bi bi-envelope me-2"></i>Login via Email</div>
                                    <center>
                                        <div class="custom-loader" hidden></div>
                                    </center>
                                </button>
                            </div>
                        </div>

                        <!-- Link untuk beralih login -->
                        <div class="col-md-12 text-center mt-4">
                            <a href="?type=email" id="link-email" class="btn btn-link" style="display: none;">
                                <i class="bi bi-envelope"></i> Login via Email
                            </a>
                            <a href="?type=whatsapp" id="link-whatsapp" class="btn btn-link" style="display: none;">
                                <i class="bi bi-whatsapp"></i> Login via WhatsApp
                            </a>
                        </div>

                        <div class="text-center mt-3">Belum punya akun? <a href="/daftar" class="text-primary">Daftar
                                Disini</a></div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container py-5" data-aos="fade-up" id="kodeOtpView" style="display: none">
            <h2 class="text-center text--primary mb-4"><b>Masukkan Kode OTP</b></h2>

            <div style="display: flex; justify-content: center;">
                <form action="" method="post" class="col-lg-6 bg-white card border-0 p-4"
                    style="box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.13); border-radius: 15px;">
                    <div class="row gy-4">

                        <!-- Tampilan khusus untuk Kode OTP -->
                        <div id="otp-input" style="display: none;">
                            <div class="col-md-12 text-center mb-3">
                                <p class="text-muted">Masukkan 6 digit kode OTP yang telah dikirimkan ke nomor WhatsApp
                                    Anda.</p>
                            </div>

                            <div class="col-md-12">
                                <div class="otp-input-container text-center">
                                    <input type="text" maxlength="1" class="otp-input mx-1" id="otp1" required>
                                    <input type="text" maxlength="1" class="otp-input mx-1" id="otp2" required>
                                    <input type="text" maxlength="1" class="otp-input mx-1" id="otp3" required>
                                    <input type="text" maxlength="1" class="otp-input mx-1" id="otp4" required>
                                </div>
                            </div>

                            <div class="col-md-12 text-center mt-3">
                                <button type="submit" onclick="verifyOtp()" class="btn btn-primary col-8 mt-3"
                                    style="background: linear-gradient(47deg, rgb(126, 213, 149) 0%, #23ca23 68%); border-radius: 25px;">
                                    <i class="bi bi-check-circle me-2"></i>Verifikasi OTP
                                </button>
                            </div>
                        </div>

                        <!-- Tautan kembali ke login jika diperlukan -->
                        <div class="col-md-12 text-center mt-4">
                            <a href="?type=whatsapp" class="btn btn-link">
                                <i class="bi bi-arrow-left"></i> Kembali ke Login WhatsApp
                            </a>
                        </div>

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
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
        var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
        window.onload = function() {
            const params = new URLSearchParams(window.location.search);
            const type = params.get('type');
            const kode_otp = params.get('kode_otp');

            if (type === 'whatsapp' && kode_otp === 'waiting') {
                document.getElementById('otp-input').style.display = 'block';
                document.getElementById('kodeOtpView').style.display = 'block';
                document.getElementById('loginView').remove();
                const inputs = document.querySelectorAll('.otp-input')[0].focus();
            }

            if (type === 'whatsapp') {
                document.getElementById('loginView').style.display = 'block';
                document.getElementById('kodeOtpView').remove();
                document.getElementById('whatsapp-login').style.display = 'block';
                document.getElementById('link-email').style.display = 'block';
                document.getElementById('email-login').remove();
                document.getElementById('link-whatsapp').remove();
            } else {
                document.getElementById('loginView').style.display = 'block';
                document.getElementById('kodeOtpView').remove();
                document.getElementById('email-login').style.display = 'block';
                document.getElementById('link-whatsapp').style.display = 'block';
                document.getElementById('whatsapp-login').remove();
                document.getElementById('link-email').remove();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.otp-input');

            inputs.forEach((input, index) => {
                input.addEventListener('input', (e) => {
                    if (input.value.length === 1) {
                        // Pindah ke input berikutnya
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                    } else if (input.value.length === 0 && index > 0) {
                        // Pindah ke input sebelumnya jika dihapus
                        inputs[index - 1].focus();
                    }
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
            });
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

        function loginEmail() {
            const form = document.getElementById('php-email-form');

            // Mengecek apakah form valid
            if (!form.checkValidity()) {
                return false;
            }
            let data = {
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
            }
            $(".custom-login").attr("hidden", true);
            $(".custom-loader").attr("hidden", false);
            const headers = {
                'secret': API_SECRET,
                'device': 'web',
            }

            axios.post(`${API_URL}/v1/auth/user-login`, data, {
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

        function loginWhatsapp() {
            const form = document.getElementById('php-email-form');
            // Mengecek apakah form valid
            if (!form.checkValidity()) {
                return false;
            }
            $(".custom-login").attr("hidden", true);
            $(".custom-loader").attr("hidden", false);
            window.location.href = '?type=whatsapp&kode_otp=waiting'
        }

        function verifyOtp() {
            // Logika verifikasi OTP
            let otp = '';
            for (let i = 1; i <= 4; i++) {
                otp += document.getElementById('otp' + i).value;
            }

            if (otp.length === 4) {
                // Lakukan verifikasi dengan OTP yang dikirimkan
                // alert('OTP Verifikasi: ' + otp);
                $(".custom-login").attr("hidden", true);
                $(".custom-loader").attr("hidden", false);
                const data = {
                    kode_otp: otp
                }
                const headers = {
                    'secret': API_SECRET,
                    'device': 'web',
                }

                axios.post(`${API_URL}/v1/auth/user-login`, data, {
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
            } else {
                alert('Masukkan 4 digit kode OTP');
            }
        }
    </script>
@endsection
