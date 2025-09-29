@extends('layouts.member')

@section('css')
    <style>
        .reward-card {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .reward-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        .reward-details {
            flex: 1;
            margin-left: 15px;
        }

        .reward-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .reward-description {
            margin: 5px 0;
        }

        .reward-points,
        .reward-quota {
            margin: 5px 0;
        }

        .card-gradient {
            background: linear-gradient(135deg, #4CAF50, #81C784);
            /* Hijau gradasi */
            color: white;
        }
    </style>
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/tab-setting.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/select2.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

    <script>
        $(".theSelect").select2();
    </script>

    <br><br><br><br>
    <div class="container " data-aos="fade-left"><br>

        {{-- <div class="card shadow" data-aos="fade-left"
            style="border-radius: 15px; border-top: 0; border-left: 0; border-bottom: 0; ">
            <div class="card-body">
                <h2 class="text-center">Hai, <span id="nameUser"></span> </h2>
            </div>
        </div> --}}

        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card card-gradient border-0 shadow-lg">
                    <div class="card-body text-center">
                        <h1 class="card-title">Hai, <span id="nameUser"></span>!</h1>
                        <p class="card-text">Ini adalah halaman dashboard profile kamu</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mt-4" data-aos="fade-left"
            style="border-radius: 15px; border-top: 0; border-left: 0; border-bottom: 0; border-right: 5px solid rgb(32, 64, 193);">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <span>Poin Anda</span>
                        <h2><b id="poin"></b></h2>
                    </div>
                    <div class="col">
                        <i class="bi bi-circle-fill d-none d-md-block me-3"
                            style="float: right; font-size: 45px; color: rgb(33, 176, 33);"></i>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="reward-tab" data-bs-toggle="tab" data-bs-target="#reward" type="button"
                    role="tab" aria-controls="reward" aria-selected="true">Reward</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="alamat-tab" data-bs-toggle="tab" data-bs-target="#alamat" type="button"
                    role="tab" aria-controls="alamat" aria-selected="true">Alamat</button>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Reward -->
            <div class="tab-pane fade show active listReward" id="reward" role="tabpanel" aria-labelledby="reward-tab">

            </div>
            <div class="tab-pane fade listAlamat" id="alamat" role="tabpanel" aria-labelledby="alamat-tab">

            </div>

            <!-- Daftar Seller Form -->
            <div class="tab-pane fade " id="seller" role="tabpanel" aria-labelledby="seller-tab">
                <form class="mt-3">
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Kategori Produk</label>
                        <input type="text" class="form-control" id="productCategory"
                            placeholder="Masukkan kategori produk">
                    </div>
                    <div class="mb-3">
                        <label for="promotionPlace" class="form-label">Tempat Promosi</label>
                        <input type="text" class="form-control" id="promotionPlace"
                            placeholder="Masukkan tempat promosi">
                    </div>
                    <div class="mb-3">
                        <label for="reason" class="form-label">Alasan</label>
                        <textarea class="form-control" id="reason" rows="3" placeholder="Masukkan alasan"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <!-- Daftar Affiliator Form -->
            <div class="tab-pane fade" id="affiliator" role="tabpanel" aria-labelledby="affiliator-tab">
                <form class="mt-3">
                    <div class="mb-3">
                        <label for="territory" class="form-label">Teritori</label>
                        <input type="text" class="form-control" id="territory" placeholder="Masukkan teritori">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    {{-- <div class="container" data-aos="fade-up">
        <div class="tab-wrap">

            <input type="radio" id="tab1" name="tabGroup1" class="tab" {{ session('checked') ? '' : 'checked' }}>
            <label for="tab1"><i class="bi bi-person me-2"></i> Biodata Diri</label>

            <input type="radio" id="tab2" name="tabGroup1" class="tab" {{ session('alamat') ? 'checked' : '' }}>
            <label for="tab2"><i class="bi bi-geo-alt me-2"></i> Daftar Alamat</label>

            <input type="radio" id="tab3" name="tabGroup1" class="tab"
                {{ session('pembayaran') ? 'checked' : '' }}>
            <label for="tab3"><i class="bi bi-wallet me-2"></i> Pembayaran</label>

            <input type="radio" id="tab4" name="tabGroup1" class="tab" {{ session('rekening') ? 'checked' : '' }}>
            <label for="tab4"><i class="bi bi-credit-card me-2"></i> Rekening Bank</label>

            <input type="radio" id="tab5" name="tabGroup1" class="tab"
                {{ session('transaksi') ? 'checked' : '' }}>
            <label for="tab5"><i class="bi bi-receipt me-2"></i> Transaksi</label>

            <div class="tab__content">
                <br>
                <div class="row" data-aos="fade-down">
                    <div class="col-sm-4 mb-3">

                        <img src="{{ asset('images/user.jpg') }}" data-aos="fade-left" class="img-fluid mb-3 rounded"
                            style="" alt="">
                        <a href="" class="btn pilih-foto mb-3" data-aos="fade-bottom">Pilih Foto</a>
                    </div>
                    <div class="col">
                        <div class="card border-0 bg-white " data-aos="fade-left">
                            <div class="card-header bg-white">
                                <div class="row">
                                    <div class="col">
                                        <b>Biodata Diri</b>
                                    </div>
                                    <div class="col">
                                        <a href="" class="btn text-white btn-sm" type="button"
                                            data-bs-toggle="modal" data-bs-target="#profil"
                                            style="background: rgb(13, 203, 13); float: right;"><i
                                                class="bi bi-pen me-1"></i> Edit
                                            Profil</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <table class="mt-2 table">
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>:</td>
                                        <td>
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir</td>
                                        <td>:</td>
                                        <td>
                                            -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Agama</td>
                                        <td>:</td>
                                        <td>
                                            -
                                        </td>
                                    </tr>
                                </table>
                                <br>

                            </div>
                        </div>
                        <div class="card border-0 bg-dark" data-aos="fade-down">
                            <div class="card-header bg-white ">
                                <div class="row">
                                    <div class="col">
                                        <b>Akun Balanja</b>
                                    </div>
                                    <div class="col">
                                        <a href="" class="btn text-white btn-sm" type="button"
                                            data-bs-toggle="modal" data-bs-target="#akun"
                                            style="background: rgb(13, 203, 13); float: right;"><i
                                                class="bi bi-pencil-square me-1"></i> Edit
                                            akun</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="mt-2">
                                    <tr>
                                        <td width="180">Email</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Telepon</td>
                                        <td>-</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab__content"><br>
                <a href="" class="btn text-white col-sm-3" type="button" data-bs-toggle="modal"
                    data-bs-target="#alamat" style="background: rgb(15, 165, 15); float: right;">+ Tambah Alamat

                    <div class="card  mb-3"
                        style="background: rgba(26, 216, 26, 0.127); border: 1px solid rgb(27, 170, 27);">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-10">
                                    <span class="text-bold" style="color: gray;">Sayuran</span>
                                    <h5><b>Kidam</b></h5>
                                    <span>089822</span>
                                    <span>sayuran2 </span>
                                    <form action="/member/alamat/hapus/" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm delete-confirm mt-4">Hapus
                                            Alamat</button>
                                    </form>
                                </div>
                                <div class="col">
                                    <center>
                                        <br>
                                        <i class="bi bi-check text-success" style="font-size: 40px; "></i>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-10">
                                    <span class="text-bold" style="color: gray;">da</span>
                                    <h5><b>vid</b></h5>
                                    <span>bek</span>
                                    <span>kam</span>
                                    <form action="/member/alamat/hapus/" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm delete-confirm mt-4">Hapus
                                            Alamat</button>
                                    </form>
                                </div>
                                <div class="col">
                                    <form action="/member//alamataktif" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn  mt-2 float-end"
                                            style="background: rgb(22, 179, 22); color: white;">Pilih</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="tab__content"><br>
                <center>
                    <h2><b>Belum ada Transaksi</b></h2>
                    Yuk, mulai belanja dan penuhi berbagai kebutuhanmu di Balanja! <br>
                    <a href="/" class="btn text-white mt-4" style="background: rgb(33, 195, 22);"
                        data-aos="fade-up">Mulai Belanja</a>
                </center>
            </div>

            <div class="tab__content">
                <br>

                <div class="row mb-3">
                    <div class="col-sm-10">
                        <h5>Saldo Balanja kamu bisa ditarik ke rekening ini.</h5>
                    </div>
                    <div class="col">
                        <a href="" class="btn text-white" type="button" data-bs-toggle="modal"
                            data-bs-target="#rekening" style="background: rgb(15, 165, 15);">Tambah Rekening</a>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <center>
                                    <img src="" class="" style="width: 80%;" alt="">
                                </center>
                            </div>
                            <div class="col-sm-9">
                                <div class="text-secondary">
                                    BRI
                                </div>
                                <h5><b>0043432432/b></h5>
                                <div class="text-uppercase">
                                    DamZ
                                </div>
                            </div>
                            <div class="col">
                                <form action="/member/rekening/hapus/" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-danger btn-sm delete-confirm mt-4">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab__content"><br>
                <h4><b>Daftar Transaksi</b></h4>
                <div class="alert alert-primary">
                    <i class="bi bi-info-circle"></i> <b>Info Seputar Belanja</b> Info Seputar Belanja.
                </div><br><br>
                <center>
                    <img src="{{ asset('images/transaksi.png') }}" width="250px" data-aos="fade-left" alt="">
                    <h3 class="mt-3" data-aos="fade-in"><b> Kamu belum pernah bertransaksi </b></h3>
                    <div class="text-secondary" data-aos="fade-in">Yuk, mulai belanja dan penuhi berbagai kebutuhanmu di
                        Balanja!</div>
                    <a href="/" class="btn text-white mt-4" style="background: rgb(33, 195, 22);"
                        data-aos="fade-up">Mulai Belanja</a>
                </center>
            </div>



        </div>
    </div> --}}


    {{-- <section id="faq" class="faq">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <h2>F.A.Q</h2>
                <p>Daftar pertanyaan yang paling sering ditanyakan</p>
            </header>

            <div class="row">
                <div class="col-lg-6">
                    <!-- F.A.Q List 1-->
                    <div class="accordion accordion-flush" id="faqlist1">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-1">
                                    Apa itu Balanja?
                                </button>
                            </h2>
                            <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                <div class="accordion-body">
                                    My bisnis adalah Perusahaan distributor modern yang penjualannya melalui platform my
                                    bisnis secara online dan terintegrasi
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-2">
                                    Bagaimana cara menjadi afiliator Balanja ??
                                </button>
                            </h2>
                            <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                <div class="accordion-body">
                                    Silahkan isi form online afiliator yang telah disediakan nanti CS dari Balanja
                                    akan menghubungi anda
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-3">
                                    Bagaimana cara menjadi cabang Balanja ??
                                </button>
                            </h2>
                            <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                <div class="accordion-body">
                                    Silahkan isi form online cabang yang telah disediakan nanti CS dari Balanja akan
                                    menghubungi anda
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">

                    <!-- F.A.Q List 2-->
                    <div class="accordion accordion-flush" id="faqlist2">

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2-content-1">
                                    Apa keuntungan bergabung menjadi afiliator Balanja ?

                                </button>
                            </h2>
                            <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                <div class="accordion-body">
                                    Sangat banyak sekali dimulai dari komisi, inestif , bonus dan pengembangan diri

                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2-content-2">
                                    Saya gaptek apakah bisa gabung di Balanja ?

                                </button>
                            </h2>
                            <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                <div class="accordion-body">
                                    Sangat bisa asal mau berusaha dan kerja keras, karena mybisnis akan memberikan
                                    strategi penjualan yang laris di dunia online
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2-content-3">
                                    Berapa biaya untuk bergabung menjadi afiliator Balanja ??

                                </button>
                            </h2>
                            <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                <div class="accordion-body">
                                    <b> GRATIS !! </b> bisa di katakana gratis karena anda hanya membeli produk saja
                                    untuk bahan konten anda maka anda sudah berhak menjadi afiliator di mybisnis.

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </section>
    <center>
        <a class="btn btn-primary" href="/logout">LOGOUT</a>
    </center> --}}

    <style>
        .pilih-foto {
            border: 1px solid rgb(34, 183, 34);
            color: rgb(34, 183, 34);
            width: 75%;
        }

        .pilih-foto:hover {
            border: 1px solid rgb(34, 183, 34);
            background: rgb(34, 183, 34);
            color: white;
        }
    </style>


    <div class="modal fade" id="profil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">EDIT PROFIL
                    </h5>
                </div>
                <div class="modal-body">
                    <form action="/member/profil/edit" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="form-group mb-2">
                            <label>Instansi</label>
                            <div class="input-group ">
                                <input type="text" value="{{ $member->instansi->nama }}" placeholder="" name="instansi"
                                    autocomplete='off' class="form-control @error('instansi') is-invalid @enderror"
                                    disabled>
                                @error('instansi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="form-group mb-2">
                            <label>Nama Lengkap</label>
                            <div class="input-group ">
                                <input type="text" value="" placeholder="Masukan nama lengkap" name="name"
                                    autocomplete='off' class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class=" form-group mb-2">
                            <label>Tanggal Lahir</label>
                            <input class="form-control @error('tgl_lahir') is-invalid @enderror" value=""
                                name="tgl_lahir" type="date" autocomplete='off' required>
                            @error('tgl_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row mb-2">
                            <div class="form-group col">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin"
                                    class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label>Agama</label>
                                <select name="agama" class="form-control @error('agama') is-invalid @enderror" required>
                                    <option value="Islam">Islam</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Budha">Budha</option>
                                </select>
                                @error('agama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class=" form-group mb-2">
                            <label>No. Telepon</label>
                            <input class="form-control @error('no_telepon') is-invalid @enderror" value=""
                                name="no_telepon" type="number" autocomplete='off' required>
                            @error('no_telepon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn text-white form-control"
                        style="background: rgb(19, 180, 19);">Simpan
                        Perubahan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="akun" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">EDIT AKUN
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        <i class="fa-solid fa-triangle-exclamation mr-1"></i>
                        Isi data dibawah jika ingin mengubah Email atau Password anda.
                    </div>
                    <form action="/member/profil/editAkun/" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label>Alamat Email</label>
                            <div class="input-group ">
                                <input type="text"" placeholder="Masukan alamat email" name="email"
                                    autocomplete='off' class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="current">Password Lama</label>
                            <input type="password" name="current_password" autocomplete="off"
                                placeholder="Masukan Password Lama"
                                class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="password" class="label">Password Baru</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Masukan Password Baru" autocomplete="new-password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="konfirmasi">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" autocomplete="off"
                                placeholder="Konfirmasi Password Baru"
                                class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn text-white form-control"
                        style="background: rgb(19, 51, 180);">Simpan
                        Perubahan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="alamat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Alamat Baru
                    </h5>
                </div>
                <div class="modal-body">
                    <h5 class="mb-3"><b>Lengkapi detail alamat</b></h5>
                    <form action="alamat/tambah" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label>Label Alamat</label>
                            <div class="input-group ">
                                <input type="text" value="{{ old('label_alamat') }}" placeholder=""
                                    name="label_alamat" autocomplete='off'
                                    class="form-control @error('label_alamat') is-invalid @enderror" required>
                                @error('label_alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <span class="text-secondary" style="font-size: 13px;">Rumah, Kantor, Apartemen, Kos</span>
                        </div>
                        <div class="form-group mb-2">
                            <label>Alamat Lengkap</label>
                            <div class="input-group ">
                                <textarea placeholder="" name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror"
                                    required rows="3">{{ old('alamat_lengkap') }} </textarea>
                                @error('alamat_lengkap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label>Catatan untuk kurir (opsional)</label>
                            <div class="input-group ">
                                <input type="text" value="{{ old('patokan') }}" placeholder="" name="patokan"
                                    autocomplete='off' class="form-control @error('patokan') is-invalid @enderror">
                                @error('patokan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <span class="text-secondary" style="font-size: 13px;">Warna rumah, patokan, pesan khusus,
                                dll.</span>
                        </div>
                        <div class="form-group mb-3">
                            <label>Nama Penerima</label>
                            <div class="input-group ">
                                <input type="text" value="" placeholder="" name="nama_penerima"
                                    autocomplete='off' class="form-control @error('nama_penerima') is-invalid @enderror"
                                    required>
                                @error('nama_penerima')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Nomor HP</label>
                            <div class="input-group ">
                                <input type="text" value="" placeholder="" name="no_hp" autocomplete='off'
                                    class="form-control @error('no_hp') is-invalid @enderror" required>
                                @error('no_hp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn w-100 text-white" style="background: rgb(20, 169, 20);">Tambah
                            Alamat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rekening" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mau tambah rekening apa?
                    </h5>
                </div>
                <div class="modal-body">
                    <form action="rekening/tambah" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label>Nama Bank</label>
                            <div class="input-group ">
                                <select name="id_bank" required
                                    class="form-control form-control
                                    theSelect"
                                    @error('id_bank') is-invalid @enderror>
                                    <option value="">Pilih Nama Bank</option>
                                    </option>
                                    {{-- @foreach ($bank as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('id_bank') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach --}}
                                </select>
                                @error('id_bank')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label>Nomor Rekening </label>
                            <div class="input-group ">
                                <input type="number" value="{{ old('no_rekening') }}"
                                    placeholder="Masukkan nomor rekening" name="no_rekening" autocomplete='off'
                                    class="form-control @error('no_rekening') is-invalid @enderror" required>
                                @error('no_rekening')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Nama Pemilik</label>
                            <div class="input-group ">
                                <input type="text" value="{{ old('nama_pemilik') }}"
                                    placeholder="Masukkan Nama Pemilik" name="nama_pemilik" autocomplete='off'
                                    class="form-control @error('nama_pemilik') is-invalid @enderror" required>
                                @error('nama_pemilik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="alert" style="background: whitesmoke;">
                            <i class="bi bi-info-circle"></i> Dengan klik tombol di bawah, kamu menyetujuiSyarat &
                            KetentuansertaKebijakan Privasiuntuk menambahkan rekening.
                        </div>
                        <button type="submit" class="btn w-100 text-white" style="background: rgb(20, 169, 20);">Tambah
                            Rekening</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
    var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
        if (user) {
            document.getElementById('nameUser').innerHTML = JSON.parse(user).karyawan.nama_lengkap
        } else {
            window.location.href = "/login"
        }

        var poin;

        getPoin()
        getAlamat()

        function getPoin() {
            var token = localStorage.getItem('token')
            var user = JSON.parse(localStorage.getItem('user'))
            axios.get(
                    `${API_URL}/poin/index-rekap?member_id=${user.karyawan.id}&type=konsumen`, {
                        headers: {
                            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                            'Author': 'bearer ' + token,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    poin = response.data
                    $('#poin').html(poin.dapat_ditarik)
                    getReward()
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });




        }

        function getReward() {
            var token = localStorage.getItem('token')
            axios.get(
                    `${API_URL}/reward`, {
                        headers: {
                            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                            'Author': 'bearer ' + token,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let reward = response.data.data
                    $.each(reward, function(key, value) {
                        $('.listReward').append(`
                                <div class="reward-card mt-4">
                                    <img src="${value.patch}" alt="Reward Image">
                                    <div class="reward-details">
                                        <h5 class="reward-title">${value.judul}</h5>
                                        <div class="reward-description">${value.keterangan}</div>
                                        <div class="reward-points"> <strong> ${value.nilai} Poin </strong> </div>
                                        <div class="reward-quota">Kuota: ${value.kouta}</div>
                                        <button ${value.nilai > poin.dapat_ditarik ? "disabled" : ""  } class="btn btn-success" onclick='redeemReward(${JSON.stringify(value)})'>Redeem </button>
                                    </div>
                                </div>
                            `)
                    })
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });




        }

        function redeemReward(reward) {
            var user = JSON.parse(localStorage.getItem('user'))
            Swal.fire({
                title: 'Anda Yakin',
                text: 'Anda akan me-redeem reward ini?',
                icon: 'peringatan',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    var token = localStorage.getItem('token')
                    payload = {
                        member_id: user.karyawan.id,
                        reward_id: reward.id,
                    }

                    axios.post(`${API_URL}/pengajuan-reward`, payload, {
                            headers: {
                                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                                'Author': 'bearer ' + token,
                                'device': 'web',

                            }
                        })
                        .then(function(response) {
                            Swal.fire('Berhasil!', 'Reward berhasil di redeem', 'success');
                            getPoin()
                        })
                        .catch(function(error) {
                            // handle error
                            alert(error.response.data.message)
                        });


                }
            });
        }

        function getAlamat() {
            var token = localStorage.getItem('token')
            axios.get(`${API_URL}/member/index-alamat?member_id=${JSON.parse(user).karyawan.id}`, {
                    headers: {
                        'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                        'Author': 'bearer ' + token,
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    let alamatSaya = response.data.data
                    if (alamatSaya[0]) {
                        $('.listAlamat').html("")
                        $('.listAlamat').append(`
                              <a href="/tambah-alamat-saya?pass_cart=profile" class="mt-4 btn btn-primary text-white w-100 btn-lg">+
                        Tambah Alamat Baru</a><br><br>
                        `)
                        $.each(alamatSaya, function(key, value) {
                            $('.listAlamat').append(`
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <span class="text-bold"
                                                    style="color: gray;">${value.label_alamat}</span>
                                                <h5><b>${value.nama_kontak}</b></h5>
                                                <span>${value.nomor_kontak}</span>
                                                <span>${value.label_alamat}
                                                    (${value.catatan})
                                                </span>
                                            </div>
                                            <div>
                                                <a class="btn mt-2 me-2 float-end" style="background: rgb(225, 225, 0); color: white;" href="/edit-alamat-saya/${value.id}?pass_cart=profile">Edit</a>
                                                <button type="button" class="btn mt-2 me-2 float-end" onclick='hapusAlamat(${value.id}, ${JSON.stringify(value)}, ${JSON.stringify(alamatSaya)})'
                                                    style="background: rgb(255, 0, 0); color: white;">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `)
                        })
                    } else {
                        $('#alamatKonsumen').html(`
                        <div class="card-header bg-white">
                            <a href="/tambah-alamat-saya?pass_cart=${params.pass_cart}" class="btn text-white col-sm-3 btn-sm"
                            style=" background: rgb(15, 180, 15);">+ Tambah Alamat Baru</a>
                        </div>
                        `)
                    }
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });


        }

        function hapusAlamat(idAlamat, value, alamatSaya) {
            Swal.fire({
                title: 'Peringatan',
                text: 'Anda yakin ingin menghapus data alamat ini?',
                icon: 'peringatan',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    var token = localStorage.getItem('token')
                    payload = {
                        id: idAlamat
                    }

                    axios.post(`${API_URL}/member/delete-alamat`, payload, {
                            headers: {
                                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                                'Author': 'bearer ' + token,
                                'device': 'web',

                            }
                        })
                        .then(function(response) {
                            Swal.fire('Berhasil!', 'Alamat terhapus', 'danger');
                            getAlamat()
                        })
                        .catch(function(error) {
                            // handle error
                            alert(error.response.data.message)
                        });


                }
            });
        }
    </script>
@endsection
