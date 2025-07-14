@extends('layouts.member')

@section('css')
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
    <br> <br><br>
    <div class="container mt-2 py-5">
        <div class="" id="contents"></div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
        var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
        const rp = (number, prefix = undefined) => {
            // return new Intl.NumberFormat("id-ID", {
            //     style: "currency",
            //     currency: "IDR",
            // }).format(number);
            let isMinus = "";
            if (parseInt(number) < 0) {
                isMinus = "-";
            }
            if (number) {
                const number_string = number
                    .toString()
                    .replace(/[^,\d]/g, "")
                    .toString();
                const split = number_string.split(",");
                const sisa = split[0].length % 3;
                let rupiah = split[0].substr(0, sisa);
                const ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                let separator = "";

                // tambahkan titik jika yang di input sudah menjadi number ribuan
                if (ribuan) {
                    separator = sisa ? "." : "";
                    rupiah += separator + ribuan.join(".");
                }

                rupiah = split[1] != undefined ? `${rupiah},${split[1]}` : rupiah;
                rupiah = `${isMinus}${rupiah}`;
                return `Rp. ${rupiah}`;
            }

            return number;
        };

        if (user) {
            $('#contents').html(`
            <h4>List Transaksi</h4>
                <!-- Tab links -->
            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab"
                        aria-controls="pending" aria-selected="true"><span class="position-relative">Pending <span id="jmlBelumBayar" class="ms-2 position-absolute top-0 start-100 translate-middle rounded-pill badge bg-danger"></span></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="diproses-tab" data-bs-toggle="tab" href="#diproses" role="tab"
                        aria-controls="diproses" aria-selected="false"><span class="position-relative">Diproses <span id="jmlDiproses" class="ms-2 position-absolute top-0 start-100 translate-middle rounded-pill badge bg-danger"></span></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="dikirim-tab" data-bs-toggle="tab" href="#dikirim" role="tab"
                        aria-controls="dikirim" aria-selected="false"><span class="position-relative">Dikirim <span id="jmlDikirim" class="ms-2 position-absolute top-0 start-100 translate-middle rounded-pill badge bg-danger"></span></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="diterima-tab" data-bs-toggle="tab" href="#diterima" role="tab"
                        aria-controls="diterima" aria-selected="false"><span class="position-relative">Diterima <span id="jmlDiterima" class="ms-2 position-absolute top-0 start-100 translate-middle rounded-pill badge bg-danger"></span></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="selesai-tab" data-bs-toggle="tab" href="#selesai" role="tab"
                        aria-controls="selesai" aria-selected="false"><span class="position-relative">Selesai <span id="jmlSelesai" class="ms-2 position-absolute top-0 start-100 translate-middle rounded-pill badge bg-danger"></span></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="dibatalkan-tab" data-bs-toggle="tab" href="#dibatalkan" role="tab"
                        aria-controls="dibatalkan" aria-selected="false"><span class="position-relative">Dibatalkan <span id="jmlDibatalkan" class="ms-2 position-absolute top-0 start-100 translate-middle rounded-pill badge bg-danger"></span></span></a>
                </li>
            </ul>

                <!-- Tab content -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <!-- List of orders - Pending -->

                </div>
                <!-- Add other tab content similarly -->
                <div class="tab-pane fade" id="diproses" role="tabpanel" aria-labelledby="diproses-tab">
                    <!-- List of orders - Diproses -->
                    <!-- Add your content here -->
                </div>
                <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="dikirim-tab">
                    <!-- List of orders - Dikirim -->
                    <!-- Add your content here -->
                </div>
                <div class="tab-pane fade" id="diterima" role="tabpanel" aria-labelledby="diterima-tab">
                    <!-- List of orders - Diterima -->
                    <!-- Add your content here -->
                </div>
                <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                    <!-- List of orders - Selesai -->
                    <!-- Add your content here -->
                </div>
                <div class="tab-pane fade" id="dibatalkan" role="tabpanel" aria-labelledby="dibatalkan-tab">
                    <!-- List of orders - Dibatalkan -->
                    <!-- Add your content here -->
                </div>
            </div>
            `)
            var token = localStorage.getItem('token')
            // Pending
            axios.get(
                    `${API_URL}/v1/transaksi-online?konsumen_member_id=${JSON.parse(user).karyawan.id}&show_bukti_tf=1&status=pending&view_as_invoice=1&start=0&length=20`, {
                        headers: {
                            'secret': API_SECRET,
                            'Author': 'bearer ' + token,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataTransaksiPending = response.data
                    if (dataTransaksiPending[0] == null) {
                        $('#pending').html(`
                        <div class="container mt-5">
                            <center>
                                <img src="{{ asset('images/empty.png') }}" width="250px" data-aos="fade-left" alt="">
                            </center>
                        </div>
                        `)
                    } else {
                        if (dataTransaksiPending.length > 0) {
                            $('#jmlBelumBayar').html(dataTransaksiPending.length)
                        }
                        $.each(dataTransaksiPending, function(key, value) {
                            $('#pending').append(`
                            <div class="card mt-2" onclick='lihatDetail(${JSON.stringify(value)})' style="cursor:pointer">
                                <div class="card-body">
                                    <p class="text-primary">Pending (${value.status_bayar == 'lunas' ?  'Lunas' : 'Belum Lunas'})</p>
                                    <h5 class="card-title">${value.no_invoice}</h5>
                                    <div class="d-flex justify-content-between">
                                        <span class="card-text">Tanggal Transaksi</span>
                                        <span class="card-text">Nominal</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="card-text">${value.waktu_transaksi}</span>
                                        <h5 class="card-text text-primary">${rp(value.total_bayar)}</h5>
                                    </div>

                                    <!-- Add image here if needed -->
                                </div>
                            </div>
                            `)
                        })
                    }
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });


            // Diproses
            axios.get(
                    `${API_URL}/v1/transaksi-online?konsumen_member_id=${JSON.parse(user).karyawan.id}&show_bukti_tf=1&status=diproses&view_as_invoice=1&start=0&length=20`, {
                        headers: {
                            'secret': API_SECRET,
                            'Author': 'bearer ' + token,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataTransaksiProses = response.data
                    console.log('dataTransaksiProses', dataTransaksiProses)
                    if (dataTransaksiProses[0] == null) {
                        $('#diproses').html(`
                        <div class="container mt-5">
                            <center>
                                <img src="{{ asset('images/empty.png') }}" width="250px" data-aos="fade-left" alt="">
                            </center>
                        </div>
                        `)
                    } else {
                        if (dataTransaksiProses.length > 0) {
                            $('#jmlDiproses').html(dataTransaksiProses.length)
                        }
                        $.each(dataTransaksiProses, function(key, value) {
                            $('#diproses').append(`
                            <div class="card mt-2" onclick='lihatDetail(${JSON.stringify(value)})' style="cursor:pointer">
                                <div class="card-body">
                                    <p class="text-primary">Diproses</p>
                                    <h5 class="card-title">${value.no_invoice}</h5>
                                    <div class="d-flex justify-content-between">
                                        <span class="card-text">Tanggal Transaksi</span>
                                        <span class="card-text">Nominal</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="card-text">${value.waktu_transaksi}</span>
                                        <h5 class="card-text text-primary">${rp(value.total_bayar)}</h5>
                                    </div>

                                    <!-- Add image here if needed -->
                                </div>
                            </div>
                            `)
                        })
                    }
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });

            // Dikirim
            axios.get(
                    `${API_URL}/v1/transaksi-online?konsumen_member_id=${JSON.parse(user).karyawan.id}&show_bukti_tf=1&status=dikirim&view_as_invoice=1&start=0&length=20`, {
                        headers: {
                            'secret': API_SECRET,
                            'Author': 'bearer ' + token,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataTransaksiKirim = response.data
                    if (dataTransaksiKirim[0] == null) {
                        $('#dikirim').html(`
                        <div class="container mt-5">
                            <center>
                                <img src="{{ asset('images/empty.png') }}" width="250px" data-aos="fade-left" alt="">
                            </center>
                        </div>
                        `)
                    } else {
                        if (dataTransaksiKirim.length > 0) {
                            $('#jmlDikirim').html(dataTransaksiKirim.length)
                        }
                        $.each(dataTransaksiKirim, function(key, value) {
                            $('#dikirim').append(`
                            <div class="card mt-2" onclick='lihatDetail(${JSON.stringify(value)})' style="cursor:pointer">
                                <div class="card-body">
                                    <p class="text-primary">Dikirim</p>
                                    <h5 class="card-title">${value.no_invoice}</h5>
                                    <div class="d-flex justify-content-between">
                                        <span class="card-text">Tanggal Transaksi</span>
                                        <span class="card-text">Nominal</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="card-text">${value.waktu_transaksi}</span>
                                        <h5 class="card-text text-primary">${rp(value.total_bayar)}</h5>
                                    </div>

                                    <!-- Add image here if needed -->
                                </div>
                            </div>
                            `)
                        })
                    }
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });



            // Diterima
            axios.get(
                    `${API_URL}/v1/transaksi-online?konsumen_member_id=${JSON.parse(user).karyawan.id}&show_bukti_tf=1&status=diterima&view_as_invoice=1&start=0&length=20`, {
                        headers: {
                            'secret': API_SECRET,
                            'Author': 'bearer ' + token,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataTransaksiTerima = response.data
                    if (dataTransaksiTerima[0] == null) {
                        $('#diterima').html(`
                        <div class="container mt-5">
                            <center>
                                <img src="{{ asset('images/empty.png') }}" width="250px" data-aos="fade-left" alt="">
                            </center>
                        </div>
                        `)
                    } else {
                        if (dataTransaksiTerima.length > 0) {
                            $('#jmlDiterima').html(dataTransaksiTerima.length)
                        }
                        $.each(dataTransaksiTerima, function(key, value) {
                            $('#diterima').append(`
                            <div class="card mt-2" onclick='lihatDetail(${JSON.stringify(value)})' style="cursor:pointer">
                                <div class="card-body">
                                    <p class="text-primary">Diterima</p>
                                    <h5 class="card-title">${value.no_invoice}</h5>
                                    <div class="d-flex justify-content-between">
                                        <span class="card-text">Tanggal Transaksi</span>
                                        <span class="card-text">Nominal</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="card-text">${value.waktu_transaksi}</span>
                                        <h5 class="card-text text-primary">${rp(value.total_bayar)}</h5>
                                    </div>

                                    <!-- Add image here if needed -->
                                </div>
                            </div>
                            `)
                        })
                    }
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });



            // Selesai
            axios.get(
                    `${API_URL}/v1/transaksi-online?konsumen_member_id=${JSON.parse(user).karyawan.id}&show_bukti_tf=1&status=selesai&view_as_invoice=1&start=0&length=20`, {
                        headers: {
                            'secret': API_SECRET,
                            'Author': 'bearer ' + token,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataTransaksiSelesai = response.data
                    if (dataTransaksiSelesai[0] == null) {
                        $('#selesai').html(`
                        <div class="container mt-5">
                            <center>
                                <img src="{{ asset('images/empty.png') }}" width="250px" data-aos="fade-left" alt="">
                            </center>
                        </div>
                        `)
                    } else {
                        if (dataTransaksiSelesai.length > 0) {
                            $('#jmlSelesai').html(dataTransaksiSelesai.length)
                        }
                        $.each(dataTransaksiSelesai, function(key, value) {
                            $('#selesai').append(`
                            <div class="card mt-2" onclick='lihatDetail(${JSON.stringify(value)})' style="cursor:pointer">
                                <div class="card-body">
                                    <p class="text-primary">Selesai</p>
                                    <h5 class="card-title">${value.no_invoice}</h5>
                                    <div class="d-flex justify-content-between">
                                        <span class="card-text">Tanggal Transaksi</span>
                                        <span class="card-text">Nominal</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="card-text">${value.waktu_transaksi}</span>
                                        <h5 class="card-text text-primary">${rp(value.total_bayar)}</h5>
                                    </div>

                                    <!-- Add image here if needed -->
                                </div>
                            </div>
                            `)
                        })
                    }
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });



            // Dibatalkan
            axios.get(
                    `${API_URL}/v1/transaksi-online?konsumen_member_id=${JSON.parse(user).karyawan.id}&show_bukti_tf=1&status=dibatalkan&view_as_invoice=1&start=0&length=20`, {
                        headers: {
                            'secret': API_SECRET,
                            'Author': 'bearer ' + token,
                            'device': 'web'
                        }
                    })
                .then(function(response) {
                    let dataTransaksiBatal = response.data
                    if (dataTransaksiBatal[0] == null) {
                        $('#dibatalkan').html(`
                        <div class="container mt-5">
                            <center>
                                <img src="{{ asset('images/empty.png') }}" width="250px" data-aos="fade-left" alt="">
                            </center>
                        </div>
                        `)
                    } else {
                        if (dataTransaksiBatal.length > 0) {
                            $('#jmlDibatalkan').html(dataTransaksiBatal.length)
                        }
                        $.each(dataTransaksiBatal, function(key, value) {
                            $('#dibatalkan').append(`
                            <div class="card mt-2" onclick='lihatDetail(${JSON.stringify(value)})' style="cursor:pointer">
                                <div class="card-body">
                                    <p class="text-primary">Dibatalkan</p>
                                    <h5 class="card-title">${value.no_invoice}</h5>
                                    <div class="d-flex justify-content-between">
                                        <span class="card-text">Tanggal Transaksi</span>
                                        <span class="card-text">Nominal</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="card-text">${value.waktu_transaksi}</span>
                                        <h5 class="card-text text-primary">${rp(value.total_bayar)}</h5>
                                    </div>

                                    <!-- Add image here if needed -->
                                </div>
                            </div>
                            `)
                        })
                    }
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });



        } else {
            var dataTransaksi = JSON.parse(localStorage.getItem('dataTransaksi'));
            $('#contents').html(`
                <h4>List Transaksi</h4>
            `)
            $.each(dataTransaksi, (key, value) => {
                $('#contents').append(`
                <div class="card mt-2" onclick='lihatDetail(${JSON.stringify(value)})' style="cursor:pointer">
                    <div class="card-body">
                        <p class="text-primary">${value.status_bayar == 'lunas' ? 'Lunas' : 'Belum Lunas'}</p>
                        <h5 class="card-title">${value.no_invoice}</h5>
                        <div class="d-flex justify-content-between">
                            <span class="card-text">Tanggal Transaksi</span>
                            <span class="card-text">Nominal</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="card-text">${value.waktu_transaksi}</span>
                            <h5 class="card-text text-primary">${rp(value.total_bayar)}</h5>
                        </div>

                        <!-- Add image here if needed -->
                    </div>
                </div>
                `)
            })

        }

        function getDatatable() {
            var myElement = document.getElementById("myTable");

            myElement.setAttribute("id", "datatable");
            let table = new DataTable('#datatable');

        }
        getData()

        function getData() {
            var dataTransaksi = JSON.parse(localStorage.getItem('dataTransaksi'));
            var no = 1;
            $.each(dataTransaksi, (key, data) => {
                var listBarang = data.item.map(function(obj) {
                    return obj.barang_nama;
                }).join(", ");
                $("#listTransaksi").append(`
                <tr>
                    <td>
                        ${no++}
                    </td>
                    <td>
                        ${data.no_invoice}
                    </td>
                    <td>
                        ${listBarang}
                    </td>
                    <td>
                        ${rp(parseInt(data.total_bayar))}
                    </td>
                    <td>
                        <button class="btn btn-warning" onclick='lihatDetail(${JSON.stringify(data)})''> <i class="bi bi-eye"></i> </button>
                    </td>


                </tr>
                `)
            })
            getDatatable()
        }

        function lihatDetail(data) {
            localStorage.setItem('invoice', JSON.stringify(data));
            let noInvoice = data.no_invoice.replace(/\//g, '-');
            window.location.href = `/pay/${noInvoice}`

        }
    </script>
@endsection
