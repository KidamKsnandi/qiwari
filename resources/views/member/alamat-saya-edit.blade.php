<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Balanja.id</title>
    <meta content="" name="description">

    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('images/logo-qiwari.png') }}" rel="icon">
    <link href="{{ asset('images/logo-qiwari.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('splide.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/frontend/assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
</head>

<body>
    <style>
        #map {
            height: 300px;
        }
    </style>
    <div class="top-header-margin" style="margin-bottom: 100px; margin-top: 50px;">
        <div class="container">
            <a onclick="javascript:history.back()" class="btn btn-outline-secondary mb-4"><i
                    class="bi bi-arrow-left me-1"></i>Kembali</a>
            <div class="card">
                <div class="card-header">
                    <h5>Edit Alamat </h5>
                </div>
                <div class="card-body">
                    <h5 class="mb-3"><b>Lengkapi detail alamat</b></h5>
                    <form action="">
                        <div class="form-group mb-3">
                            <label>Nama Penerima</label>
                            <div class="input-group ">
                                <input type="text" value="" placeholder="" name="nama_penerima"
                                    id="nama_penerima" autocomplete='off' class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Nomor HP</label>
                            <div class="input-group ">
                                <input type="text" value="" placeholder="" name="no_hp" id="nomor_penerima"
                                    autocomplete='off' class="form-control" required>

                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label>Label Alamat</label>
                            <div class="input-group ">
                                <input type="text" value="" placeholder="" name="label_alamat"
                                    id="label_alamat" autocomplete='off' class="form-control" required>
                            </div>
                            <span class="text-secondary" style="font-size: 13px;">Rumah, Kantor, Apartemen, Kos</span>
                        </div>
                        {{-- <div class="form-group mb-2">
                            <h6 style="font-size: 13px;" class="mt-3">Jenis Alamat</h6>
                            <select name="jenis_alamat" id="jenis_alamat" class="form-control mb-2"
                                style="width: 100%; " id="">
                                <option value="" style="">- Pilih -</option>
                                <option value="utama" style="">Utama</option>
                                <option value="toko" style="">Toko</option>
                                <option value="retur" style="">Retur</option>
                            </select>
                        </div> --}}
                        <div class="col-md-12">
                            <h6 style="font-size: 13px;" class="mt-3">Gender</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="l"
                                    value="l">
                                <label class="form-check-label" for="l">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="p"
                                    value="l">
                                <label class="form-check-label" for="l">Perempuan</label>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <h6 style="font-size: 13px;" class="mt-3">PROVINSI </h6>
                            <select name="provinsi_id" id="provinsi_id" class=" theSelect form-control mb-2"
                                style="width: 100%; " id="">
                                <option value="" style="">- Pilih -</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <h6 style="font-size: 13px;" class="mt-3">KAB/KOTA</h6>
                            <select name="kab_kota_id" id="kab_kota_id" class="theSelect form-control mb-2"
                                style="width: 100%;" id="">
                                <option value="">- Pilih -</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <h6 style="font-size: 13px;" class="mt-3">KECAMATAN</h6>
                            <select name="kecamatan_id" id="kecamatan_id" class="theSelect form-control mb-2"
                                style="width: 100%;" id="">
                                <option value="">- Pilih -</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <h6 style="font-size: 13px;" class="mt-3">DESA/KELURAHAN</h6>
                            <select name="kelurahan_id" id="kelurahan_id" class="theSelect form-control mb-2"
                                style="width: 100%;" id="">
                                <option value="">- Pilih -</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Alamat Lengkap</label>
                            <div class="input-group ">
                                <textarea placeholder="" id="alamat_lengkap" name="alamat_lengkap" class="form-control" required rows="3"></textarea>

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="d-flex justify-content-between">
                                            <label for="postal_code">Kode POS:</label>
                                            <button type="button" class="btn btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Untuk isi kode pos harap pilih provinsi, kab/kota, kecamatan, dan desa/kelurahan"
                                                onclick="this.blur()">
                                                <i class="bi bi-info-circle-fill"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control" id="postal_code" readonly>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label for="latitude">Latitude:</label>
                                        <input type="text" class="form-control" id="latitude">
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label for="longitude">Longitude:</label>
                                        <input type="text" class="form-control" id="longitude">
                                    </div>
                                    <div class="col-md-3 col-sm-6 ">
                                        <div id="buttonLokasiSaatIni"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2" id="map"></div>
                        <div class="form-group mt-2 mb-2">
                            <label>Catatan untuk kurir (opsional)</label>
                            <div class="input-group ">
                                <input type="text" value="" placeholder="" name="patokan" id="catatan"
                                    autocomplete='off' class="form-control ">
                            </div>
                            <span class="text-secondary" style="font-size: 13px;">Warna rumah, patokan, pesan khusus,
                                dll.</span>
                        </div>
                        <button type="button" onclick="editAlamat()" class="btn w-100 text-white"
                            style="background: rgb(20, 169, 20);">Ubah
                            Alamat</button>
                    </form>
                </div>
            </div>
        </div>

    </div>


    <script src="{{ asset('mixin/mixin.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/vendor/php-email-form/validate.js') }}"></script>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('lib/axios.min.js') }}"></script>
    <script src="{{ asset('lib/select2.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
        var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
        $(".theSelect").select2();
        var id_provinsi;
        var id_kab_kota;
        var id_kecamatan;
        var id_desa;

        var user = localStorage.getItem('user')
        if (user == null) {
            javascript: history.back()
        }

        var map = L.map('map').setView([-6.923786, 107.610226], 12);

        // Add Tile Layer (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([-6.923786, 107.610226]).addTo(map);

        // Menambahkan popup ke marker
        marker.bindPopup("<b>Tentukan lokasi!</b>").openPopup();

        // Initialize latitude and longitude input fields
        var latitudeInput = document.getElementById('latitude');
        var longitudeInput = document.getElementById('longitude');

        // Function to update input fields with coordinates
        function updateCoordinates(latlng) {
            latitudeInput.value = latlng.lat.toFixed(6);
            longitudeInput.value = latlng.lng.toFixed(6);
        }

        function updateMarker(latlng) {
            marker
                .setLatLng([latlng.lat.toFixed(6), latlng.lng.toFixed(6)])
                .bindPopup("<b>Lokasi yang Dipilih!</b>")
                .openPopup();
            return false;
        };


        // getLocation();

        // Event listener for click on map
        map.on('click', function(e) {
            updateCoordinates(e.latlng);
            updateMarker(e.latlng);
        });

        $('#buttonLokasiSaatIni').html(
            `<button class="btn btn-info w-100 mt-4" type="button" id="buttonLokasi">Pilih Lokasi Saat Ini</button>`
        )

        $('#buttonLokasi').on('click', function() {
            getLocation();
        });

        function getLocation(data) {
            if (data) {
                console.lo
                var lat = parseFloat(data.latitude);
                var lng = parseFloat(data.longitude);
                $('#latitude').val(lat);
                $('#longitude').val(lng);
                updateMarker({
                    lat: lat,
                    lng: lng
                });
            } else {
                alert("Browser Anda tidak mendukung geolocation.");
            }
        }


        getAlamat()

        function getProvinsi() {
            // Provinsi
            axios.get(`${API_URL}/v1/wilayah/provinsi`, {
                    headers: {
                        'secret': API_SECRET,
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    let dataProvinsi = response.data.data
                    $('#provinsi_id').html('<option value="">- Pilih -</option>');
                    $.each(dataProvinsi, function(key, value) {
                        $("#provinsi_id").append(
                            `<option value="${value.id}" ${value.id == id_provinsi ? 'selected' : ''}> ${value.name} </option>`
                        );
                    });
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });

            // Kab Kota
            axios.get(
                    `${API_URL}/v1/wilayah/kab-kota?id_provinsi=${id_provinsi}`, {
                        headers: {
                            'secret': API_SECRET,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataKabKota = response.data.data
                    $('#kab_kota_id').html('<option value="">- Pilih -</option>');
                    $.each(dataKabKota, function(key, value) {
                        $("#kab_kota_id").append(
                            `<option value="${value.id}"  ${value.id == id_kab_kota ? 'selected' : ''}>${value.name}</option>`
                        );
                    });
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });

            // Kecamatan
            axios.get(
                    `${API_URL}/v1/wilayah/kecamatan?id_kab_kota=${id_kab_kota}`, {
                        headers: {
                            'secret': API_SECRET,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataKabKota = response.data.data
                    $('#kecamatan_id').html('<option value="">- Pilih -</option>');
                    $.each(dataKabKota, function(key, value) {
                        $("#kecamatan_id").append(
                            `<option value="${value.id}"  ${value.id == id_kecamatan ? 'selected' : ''}>${value.name}</option>`
                        );
                    });
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });

            // Kelurahan
            axios.get(
                    `${API_URL}/v1/wilayah/kelurahan?id_kecamatan=${id_kecamatan}`, {
                        headers: {
                            'secret': API_SECRET,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataKabKota = response.data.data
                    $("#kelurahan_id").attr("disabled", false);
                    $('#kelurahan_id').html('<option value="">- Pilih -</option>');
                    $.each(dataKabKota, function(key, value) {
                        $("#kelurahan_id").append(
                            `<option data-postal-code="${value.postal_code}" value="${value.id}" ${value.id == id_desa ? 'selected' : ''}>${value.name}</option>`
                        );
                    });
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });


        }

        // Get Kab Kota
        $(document).ready(function() {
            $('#provinsi_id').on('change', function() {
                var id_provinsi = this.value;
                axios.get(
                        `${API_URL}/v1/wilayah/kab-kota?id_provinsi=${id_provinsi}`, {
                            headers: {
                                'secret': API_SECRET,
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
                        `${API_URL}/v1/wilayah/kecamatan?id_kab_kota=${id_kab_kota}`, {
                            headers: {
                                'secret': API_SECRET,
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
                        `${API_URL}/v1/wilayah/kelurahan?id_kecamatan=${id_kecamatan}`, {
                            headers: {
                                'secret': API_SECRET,
                                'device': 'web'
                            }
                        })
                    .then(function(response) {
                        let dataKabKota = response.data.data
                        $("#kelurahan_id").attr("disabled", false);
                        $('#kelurahan_id').html('<option value="">- Pilih -</option>');
                        $.each(dataKabKota, function(key, value) {
                            $("#kelurahan_id").append('<option data-postal-code="' + value
                                .postal_code + '" value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    });
            });

            $('#kelurahan_id').on('change', function() {
                var id_kelurahan = this.value;
                var postalCode = $('#kelurahan_id option:selected').attr('data-postal-code');
                $('#postal_code').val(postalCode)

            });

        });

        function getAlamat() {
            var id = '{{ $id }}'
            var token = localStorage.getItem('token')
            axios.get(`${API_URL}/v1/member/index-alamat/detail/${id}`, {
                    headers: {
                        'secret': API_SECRET,
                        'Author': 'bearer ' + token,
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    let data = response.data
                    id_provinsi = data.provinsi_id
                    id_kab_kota = data.kab_kota_id
                    id_kecamatan = data.kecamatan_id
                    id_desa = data.desa_id
                    getProvinsi()
                    getLocation(data)
                    $('#label_alamat').val(data.label_alamat)
                    $('#provinsi_id').val(data.provinsi_id)
                    $('#kab_kota_id').val(data.kab_kota_id)
                    $('#kecamatan_id').val(data.kecamatan_id)
                    $('#kelurahan_id').val(data.desa_id)
                    $('#alamat_lengkap').val(data.alamat)
                    $('#nomor_penerima').val(data.nomor_kontak)
                    $('#nama_penerima').val(data.nama_kontak)
                    $('#catatan').val(data.catatan)
                    $('#latitude').val(data.latitude)
                    $('#longitude').val(data.longitude)
                    $('#postal_code').val(data.postal_code)
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        function editAlamat() {
            var id = '{{ $id }}'
            let payload = {
                id: id,
                member_id: JSON.parse(user).karyawan.id,
                label_alamat: $('#label_alamat').val(),
                provinsi_id: parseInt($('#provinsi_id').val()),
                kab_kota_id: parseInt($('#kab_kota_id').val()),
                kecamatan_id: parseInt($('#kecamatan_id').val()),
                desa_id: parseInt($('#kelurahan_id').val()),
                alamat: $('#alamat_lengkap').val(),
                nomor_kontak: $('#nomor_penerima').val(),
                nama_kontak: $('#nama_penerima').val(),
                jenis_kelamin: $('input[name="gender"]:checked').val(),
                jenis_alamat: "utama",
                catatan: $('#catatan').val(),
                latitude: $('#latitude').val(),
                longitude: $('#longitude').val(),
                postal_code: $('#postal_code').val(),
            }
            var token = localStorage.getItem('token')
            var params = getSearchParameters();
            if (payload.label_alamat == "" || payload.nomor_kontak == "" || payload.nama_kontak == "" || payload.alamat ==
                "" || payload.provinsi_id == "" || payload.kab_kota_id ==
                "" ||
                payload.kecamatan_id == "" || payload.desa_id == "" || payload.latitude == "" || payload.longitude == "" ||
                payload.catatan == "") {
                alert('Harap isi semua form!')

            } else {
                axios.post(`${API_URL}/v1/member/input-alamat`, payload, {
                        headers: {
                            'secret': API_SECRET,
                            'Author': 'bearer ' + token,
                            'device': 'web'
                        }
                    })
                    .then(function(response) {

                        alert("Berhasil Mengedit Alamat")
                        if (params.pass_cart == 'y' || params.pass_cart == 'n') {
                            window.location.href = `/checkout?pass_cart=${params.pass_cart}`
                        } else {
                            window.location.href = `/profile-dashboard`
                        }
                        // renderAlamat()
                        // $('#alamatBaru').modal('hide');
                    })
                    .catch(function(error) {
                        error.response.data.forEach(element => {
                            alert(element)
                        });
                        // $('#alamatBaru').modal('hide');
                    });

            }
        }

        // Get Params
        function getSearchParameters() {
            var prmstr = window.location.search.substr(1);
            return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
        }

        function transformToAssocArray(prmstr) {
            var params = {};
            var prmarr = prmstr.split("&");
            for (var i = 0; i < prmarr.length; i++) {
                var tmparr = prmarr[i].split("=");
                params[tmparr[0]] = tmparr[1];
            }
            return params;
        }

        document.onkeydown = function(e) {
            if (e.ctrlKey &&
                (e.keyCode === 85 ||
                    e.keyCode === 117)) {
                return false;
            } else {
                return true;
            }
        };
    </script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/frontend/assets/js/main.js') }}"></script>

</body>

</html>
