@extends('layouts.member')

@section('content')
    <style>
        .custom-loader {
            margin-top: 200px;
            margin-bottom: 200px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background:
                radial-gradient(farthest-side, #7044EF 94%, #0000) top/8px 8px no-repeat,
                conic-gradient(#0000 30%, #7044EF);
            -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 8px), #000 0);
            animation: s3 0.5s infinite linear;
        }

        @keyframes s3 {
            100% {
                transform: rotate(1turn)
            }
        }
    </style>
    <br><br><br><br>
    <div class="container">
        <center>
            <h3 class="mt-5"><b>Cabang</b></h3>
            <h5>Temukan Cabang Resmi Mybisnis di Kotamu</h5>
            <div class="col-sm-6 mt-4">
                <div class="row">
                    <div class="col-sm-9">
                        <input type="text" class="form-control mb-3" placeholder="Cari disini...">
                    </div>
                    <div class="col-sm">
                        <button type="submit" class="btn--primary w-100">Cari</button>
                    </div>
                </div>
            </div>
        </center>
    </div>
    <div style="background: rgba(245, 245, 245, 0.589);" class="mt-5">
        <div class="container pt-4 pb-5">
            <div class="row mt-4" id="dataCabang">
                {{--
                <div class="col-sm-6">
                    <a href="">
                        <div class="card border-0 bg-white shadow mb-4" style="border-radius: 10px;">
                            <div class="card-body">
                                <h5 class="text-uppercase text-dark"><b>WANDINI YUSLINDAWATI</b></h5>
                                <div style="font-size: 13px;">
                                    <div class="text-dark">
                                        Seller ID: MSGLOW052.26.64 <br>
                                        Seller Status: Business Manager <br>
                                        ID Card Valid Thru: - <br>
                                        <b> KOTA BANDUNG, JAWA BARAT, INDONESIA </b>
                                    </div>
                                    <div class=" mt-3 row">
                                        <div class="col-sm col-lg-5">
                                            <a href="" class="btn btn-outline--primary mb-2"><i
                                                    class="bi bi-whatsapp"></i>
                                                <span style="font-size: 13px;"> Hubungi
                                                    WA Seller ini</span></a>
                                        </div>
                                        <div class="col-sm">
                                            <a href="" class="btn btn-outline--primary mb-2"><i
                                                    class="bi bi-instagram"></i>
                                                <span style="font-size: 13px;">msglowdinibandungti</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> --}}
                <center>
                    <div class="custom-loader"></div>
                </center>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/axios.min.js') }}"></script>

    <script>
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
    var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
        getProduk()


        function getProduk() {
            axios.get(`${API_URL}/affiliator/cabang`, {
                    headers: {
                        'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    let dataCabang = response.data.data
                    $('#dataCabang').html("");
                    if (dataCabang[0] != null) {
                        $.each(dataCabang, function(key, value) {
                            $('#dataCabang').append(`<div class="col-sm-6">
                        <div>
                            <div class="card border-0 bg-white shadow mb-4" style="border-radius: 10px;">
                                <div class="card-body">
                                    <h5 class="text-uppercase text-dark"><b>${value.nama_cabang}</b></h5>
                                    <div style="font-size: 13px;">
                                        <div class="text-dark">
                                            Seller ID: ${value.sellerid ? value.sellerid : '-'} <br>
                                            Seller Status: ${value.status ? value.status : '-'} <br>
                                            ID Card : ${value.card ? value.card : '-'} <br>
                                            <b> ${value.kota_kab}, ${value.provinsi}, INDONESIA </b>
                                        </div>
                                        <div class=" mt-3 row">

                                            <div class="col-sm col-lg-5">
                                                <button type="button" onclick="pilihCabang(${value.id})" class="btn btn-outline--primary mb-2"><i
                                                    class="bi bi-arrow-up-right-circle-fill"></i>
                                                    <span style="font-size: 13px;"> Kunjungi Cabang Ini</span></button>
                                                        </div>
                                            <div class="col-sm">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`);
                        });
                    } else {
                        $('#dataCabang').html(`
                        <center>
                            <br><br>
                            <img src="{{ asset('images/empty.png') }}" style="width: 250px;" alt=""><br>
                            <h4 class="text--primary"><b> Tidak Ditemukan</b></h4>
                            <h6>Mohon maaf Cabang tidak ditemukan</h6>
                            <br><br>
                        </center>
                        `)
                    }
                    console.log('dataCabang', dataCabang)
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        }

        function pilihCabang(member_id) {
            localStorage.setItem('member_id', member_id)
            window.location.href = '/affiliate?member=' + member_id
            // alert("HAi")
            //
        }
    </script>
@endsection
