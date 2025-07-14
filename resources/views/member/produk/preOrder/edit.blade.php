@extends('layouts.member')

@section('css')
    <style>
        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 15px;
            padding: 10px;
        }

        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .product-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-price {
            color: #ff6347;
        }

        .product-quantity {
            border: 1px solid #ccc;
            border-radius: 50%;
            padding: 5px 10px;
            background-color: #f8f8f8;
        }

        @keyframes shimmer {
            0% {
                background-position: -100% 0;
            }

            100% {
                background-position: 100% 0;
            }
        }

        .skeleton {
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .skeleton-image {
            width: 100px;
            height: 100px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
            border-radius: 5px;
        }

        .skeleton-text,
        .skeleton-text-small,
        .skeleton-button {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        .skeleton-text {
            height: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .skeleton-text-small {
            height: 10px;
            margin-bottom: 8px;
            border-radius: 5px;
        }

        .skeleton-button {
            width: 40px;
            height: 30px;
            border-radius: 5px;
        }

        .bottom-bar {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #23ca23;
            /* Navy transparent */
            padding: 10px 20px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
        }

        .bottom-bar .total {
            font-size: 18px;
            font-weight: bold;
        }

        .bottom-bar .checkout-btn {
            background-color: #ff9900;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .bottom-bar .checkout-btn:hover {
            background-color: #e68a00;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* @media (max-width: 768px) {
                                                                                                                                                                                                                                                                                                         .overlay {
                                                                                                                                                                                                                                                                                            position: fixed;
                                                                                                                                                                                                                                                                                            top: 0;
                                                                                                                                                                                                                                                                                            left: 0;
                                                                                                                                                                                                                                                                                            width: 100%;
                                                                                                                                                                                                                                                                                            height: 100%;
                                                                                                                                                                                                                                                                                            background-color: rgba(255, 255, 255, 0.9);
                                                                                                                                                                                                                                                                                            z-index: 9999;
                                                                                                                                                                                                                                                                                            display: flex;
                                                                                                                                                                                                                                                                                            justify-content: center;
                                                                                                                                                                                                                                                                                            align-items: center;
                                                                                                                                                                                                                                                                                        }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               .bottom-bar {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            bottom: 65px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } */
    </style>
@endsection

@section('content')
    <div class="overlay loadingOverlay" id="loadingOverlay" hidden>
        <div class="spinner-border text-success" role="status">
        </div>
    </div>
    <div class="container mt-4" style="padding-top: 120px">
        <div class="card mb-4">
            <div class="card-body">
                Nama Member : <b id="namaUser"></b>
            </div>
        </div>
        <div id="product-list" class="row">
        </div>
        <div id="skeleton-loader">
            <div class="col-12 product-card d-flex align-items-center skeleton p-2">
                <div class="skeleton-image me-3"></div>
                <div class="w-100">
                    <div class="skeleton-text" style="width: 70%;"></div>
                    <div class="skeleton-text-small" style="width: 50%;"></div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="skeleton-text-small" style="width: 40%;"></div>
                        <div class="d-flex align-items-center">
                            <div class="skeleton-button"></div>
                            <div class="mx-2 skeleton-button" style="width: 30px;"></div>
                            <div class="skeleton-button"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 product-card d-flex align-items-center skeleton p-2">
                <div class="skeleton-image me-3"></div>
                <div class="w-100">
                    <div class="skeleton-text" style="width: 70%;"></div>
                    <div class="skeleton-text-small" style="width: 50%;"></div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="skeleton-text-small" style="width: 40%;"></div>
                        <div class="d-flex align-items-center">
                            <div class="skeleton-button"></div>
                            <div class="mx-2 skeleton-button" style="width: 30px;"></div>
                            <div class="skeleton-button"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 product-card d-flex align-items-center skeleton p-2">
                <div class="skeleton-image me-3"></div>
                <div class="w-100">
                    <div class="skeleton-text" style="width: 70%;"></div>
                    <div class="skeleton-text-small" style="width: 50%;"></div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="skeleton-text-small" style="width: 40%;"></div>
                        <div class="d-flex align-items-center">
                            <div class="skeleton-button"></div>
                            <div class="mx-2 skeleton-button" style="width: 30px;"></div>
                            <div class="skeleton-button"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 product-card d-flex align-items-center skeleton p-2">
                <div class="skeleton-image me-3"></div>
                <div class="w-100">
                    <div class="skeleton-text" style="width: 70%;"></div>
                    <div class="skeleton-text-small" style="width: 50%;"></div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="skeleton-text-small" style="width: 40%;"></div>
                        <div class="d-flex align-items-center">
                            <div class="skeleton-button"></div>
                            <div class="mx-2 skeleton-button" style="width: 30px;"></div>
                            <div class="skeleton-button"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 product-card d-flex align-items-center skeleton p-2">
                <div class="skeleton-image me-3"></div>
                <div class="w-100">
                    <div class="skeleton-text" style="width: 70%;"></div>
                    <div class="skeleton-text-small" style="width: 50%;"></div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="skeleton-text-small" style="width: 40%;"></div>
                        <div class="d-flex align-items-center">
                            <div class="skeleton-button"></div>
                            <div class="mx-2 skeleton-button" style="width: 30px;"></div>
                            <div class="skeleton-button"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 product-card d-flex align-items-center skeleton p-2">
                <div class="skeleton-image me-3"></div>
                <div class="w-100">
                    <div class="skeleton-text" style="width: 70%;"></div>
                    <div class="skeleton-text-small" style="width: 50%;"></div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="skeleton-text-small" style="width: 40%;"></div>
                        <div class="d-flex align-items-center">
                            <div class="skeleton-button"></div>
                            <div class="mx-2 skeleton-button" style="width: 30px;"></div>
                            <div class="skeleton-button"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="bottom-bar">
        <div class="total">
            Estimasi Total Belanja: <br> <span id="total-amount"></span>
        </div>
        <button class="checkout-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkoutModal">
            Simpan
        </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="checkoutForm">
                        <!-- Tanggal dan Waktu -->
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Update Pesanan</label>
                            <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" required
                                disabled onchange="displayDay()">
                        </div>

                        <!-- Keterangan Hari -->
                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari</label>
                            <input type="text" class="form-control" id="hari" name="hari" disabled>
                        </div>

                        <!-- PO (Pilihan Minggu 1 sampai 4) -->
                        <div class="mb-3">
                            <label for="po" class="form-label">Pilih PO</label>
                            <select class="form-select" id="periode_po" name="po" required>
                                <option value="Minggu 1">Minggu 1</option>
                                <option value="Minggu 2">Minggu 2</option>
                                <option value="Minggu 3">Minggu 3</option>
                                <option value="Minggu 4">Minggu 4</option>
                            </select>
                        </div>

                        <!-- Pembayaran -->
                        <div class="mb-3">
                            <label for="pembayaran" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" id="metode_bayar" name="pembayaran" required
                                onchange="showBankInfo()">
                                <option value="1">Cash</option>
                                {{-- <option value="1">Transfer - Mandiri</option>
                                <option value="transfer-bca">Transfer - BCA</option> --}}
                            </select>
                        </div>

                        <!-- Informasi Rekening -->
                        <div id="bankInfo" class="d-none">
                            <div class="mb-3">
                                <label class="form-label">Nomor Rekening</label>
                                <input type="text" id="nomorRekening" class="form-control" readonly disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Akun</label>
                                <input type="text" id="namaAkun" class="form-control" readonly disabled>
                            </div>
                        </div>

                        <!-- Pengiriman -->
                        <div class="mb-3">
                            <label for="pengiriman" class="form-label">Metode Pengiriman</label>
                            <select class="form-select" id="metode_pengiriman" name="pengiriman" required>
                                <option value="1">Diambil</option>
                                <option value="2">Dikirim</option>
                            </select>
                        </div>

                        <!-- Alamat Konsumen -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat Konsumen"></textarea>
                            <button type="button" class="btn btn-secondary mt-2" onclick="getLocation()">Ambil Lokasi
                                Terkini</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="checkoutForm">Submit</button>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/axios.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
        var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
        let page = 1;
        var itemsPerPage = 6;
        var currentPage = 1;
        var totalPages = 1;
        let isLoading = false;
        var totalBayar = 0;
        const quantities = {};
        var isProduk = true;
        var render = true;
        var dataPOMembership = null;
        var itemsBarang = null;

        const getPOMembership = async () => {
            try {
                render = false;
                const response = await axios.get(`${API_URL}/v1/po-membership`, {
                    params: {
                        member_id: JSON.parse(user).member_id
                    },
                    headers: {
                        'secret': API_SECRET,
                        'Author': 'bearer ' + token,
                        'device': 'web'
                    }
                });
                dataPOMembership = response.data.data[0];
                itemsBarang = dataPOMembership.items;
                const now = new Date();
                const formattedDate = now.getFullYear() + '-' +
                    ('0' + (now.getMonth() + 1)).slice(-2) + '-' +
                    ('0' + now.getDate()).slice(-2) + ' ' +
                    ('0' + now.getHours()).slice(-2) + ':' +
                    ('0' + now.getMinutes()).slice(-2);
                $('#tanggal').val(formattedDate);
                const hariInput = document.getElementById('hari');

                const options = {
                    weekday: 'long'
                };
                const hari = new Intl.DateTimeFormat('id-ID', options).format(
                    now);

                hariInput.value = hari;
                $('#periode_po').val(dataPOMembership.periode_po)
                if (dataPOMembership.metode_bayar == 1) {
                    $('#metode_bayar').val(dataPOMembership.metode_bayar)
                } else {
                    var rekeningTerpilih = dataPOMembership.rekening;

                    $('#metode_bayar option').each(function() {
                        var optionValue = $(this).val();
                        try {
                            var optionObject = JSON.parse(optionValue);

                            if (optionObject.id === rekeningTerpilih.id) {
                                $(this).prop('selected', true);
                            }
                        } catch (e) {
                            console.log('Invalid JSON:', optionValue);
                        }
                    });
                    bankInfo.classList.remove("d-none");
                    nomorRekening.value = rekeningTerpilih.no_rekening;
                    namaAkun.value = rekeningTerpilih.deskripsi;
                }
                $('#metode_pengiriman').val(dataPOMembership.metode_pengiriman)
                $('#alamat').val(dataPOMembership.alamat)
                loadProducts()
            } catch (error) {
                render = true
                console.error('Error fetching PO Membership:', error);
                return null;
            }
        };


        const loadProducts = () => {

            if (isLoading) return;
            isLoading = true;
            if (isProduk == true) {
                document.getElementById('skeleton-loader').style.display = 'block';

                axios.get(
                        `${API_URL}/v1/toko-penyimpanan-public?harga=retail&start=${(page - 1) * itemsPerPage}&length=${itemsPerPage}&gudang_id=83&order=desc&show_as_product=1`, {
                            headers: {
                                'secret': API_SECRET,
                                'device': 'web'
                            }
                        })
                    .then(response => {
                        const products = response.data.data;
                        if (products.length == 0) {
                            isProduk = false
                        }
                        totalPages = Math.ceil(response.data.total / itemsPerPage);
                        const productList = document.getElementById('product-list');

                        document.getElementById('skeleton-loader').style.display = 'none';

                        var listPreOrder = localStorage.getItem('listPreOrder') ? JSON.parse(localStorage
                            .getItem(
                                'listPreOrder')) : []

                        if (listPreOrder.length > 0) {
                            listPreOrder = []
                        }


                        products.forEach(product => {
                            let findData = itemsBarang.find(res => res.penyimpanan_id == product
                                .id);
                            if (findData != null) {
                                listPreOrder.push({
                                    id: product.id,
                                    qty: findData.qty,
                                    jumlah: product.varian_barang[0].jumlah,
                                    barang: product.varian_barang[0].barang,
                                    harga: product.harga,
                                });
                            }

                            localStorage.setItem('listPreOrder', JSON.stringify(
                                listPreOrder))

                            let dataPre = localStorage.getItem('listPreOrder') ? JSON.parse(
                                localStorage.getItem(
                                    'listPreOrder')) : []
                            keepHarga = dataPre.reduce((a, item) => {
                                return a += (item.harga * item.qty)
                            }, 0)

                            quantities[product.id] = findData ? findData.qty : 0;

                            const productCard = `
                                <div class="col-12 product-card d-flex">
                                    <img src="${product.photo[0] && product.photo[0].path ? product.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}" class="product-image" alt="${product.name}">
                                    <div class="ms-3 w-100">
                                        <div class="product-details">
                                            <div>
                                                <h5>${product.nama}</h5>
                                                <p class="product-price">${rupiah(product.harga)}</p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-sm btn-outline-secondary" onclick='decreaseQuantity(${product.id}, ${product.harga}, ${JSON.stringify(product)})'>-</button>
                                                <span id="quantity-${product.id}" class="mx-2">${quantities[product.id]}</span>
                                                <button class="btn btn-sm btn-outline-secondary" onclick='increaseQuantity(${product.id}, ${product.varian_barang[0].jumlah}, ${product.harga}, ${JSON.stringify(product)})'>+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            productList.innerHTML += productCard;
                        });

                        totalBayar += keepHarga
                        document.getElementById('total-amount').innerHTML = rupiah(totalBayar)

                        page++;
                        isLoading = false;
                        render = true
                    })
                    .catch(error => {
                        console.error('Error fetching products:', error);
                        isLoading = false;
                        render = true
                        document.getElementById('skeleton-loader').style.display = 'none';
                    });
            }
        };

        const getRekening = async () => {
            try {
                render = false;
                const response = await axios.get(`${API_URL}/v1/rekening`, {
                    params: {
                        member_id: 80
                    },
                    headers: {
                        'secret': API_SECRET,
                        'Author': 'bearer ' + token,
                        'device': 'web'
                    }
                });
                let rekening = response.data.data;
                if (rekening.length > 0) {
                    $.each(rekening, (i, value) => {
                        $('#metode_bayar').append(`
                            <option value='${JSON.stringify(value)}'>Transfer - ${value.nama}</option>
                        `)
                    })
                }
            } catch (error) {
                console.error('Error fetching', error);
                return null;
            }
        };

        // Function to increase quantity
        const increaseQuantity = (productId, jumlah, harga, data) => {
            if (quantities[productId] < 99) {
                quantities[productId]++;
                document.getElementById(`quantity-${productId}`).innerText = quantities[productId];
                updateHarga(productId, quantities[productId], harga, data)

            }
        };

        // Function to decrease quantity
        const decreaseQuantity = (productId, harga, data) => {
            if (quantities[productId] > 0) {
                quantities[productId]--;
                document.getElementById(`quantity-${productId}`).innerText = quantities[productId];
                updateHarga(productId, quantities[productId], harga, data)
            }
        };

        const updateHarga = (productId, qty, harga, data) => {
            let dataPreOrder = localStorage.getItem('listPreOrder') ? JSON.parse(localStorage.getItem('listPreOrder')) :
                []
            var checkDataPreOrder = dataPreOrder.find(response => {
                return response.id == productId
            })
            if (checkDataPreOrder) {
                dataPreOrder.map(res => {
                    if (res.id == productId) {
                        res.qty = qty
                    }
                })
            } else {
                dataPreOrder.push({
                    id: data.id,
                    qty: qty,
                    jumlah: data.varian_barang[0].jumlah,
                    barang: data.varian_barang[0].barang,
                    harga: data.harga,
                })
            }
            localStorage.setItem('listPreOrder', JSON.stringify(dataPreOrder))

            let dataPre = localStorage.getItem('listPreOrder') ? JSON.parse(localStorage.getItem('listPreOrder')) : []
            let keepHarga = dataPre.reduce((a, item) => {
                return a += (item.harga * item.qty)
            }, 0)
            totalBayar = keepHarga
            document.getElementById('total-amount').innerHTML = rupiah(totalBayar)
            // if (qty == 0) {
            //     var filterNot = dataPre.filter(res => res.id != productId)
            //     localStorage.setItem('listPreOrder', JSON.stringify(filterNot))
            // }
            if (totalBayar == 0) {
                document.getElementById('total-amount').innerHTML = "Rp. 0"
            }

        }

        function showBankInfo() {
            var metode_bayar = JSON.parse(document.getElementById("metode_bayar").value);
            var bankInfo = document.getElementById("bankInfo");
            var nomorRekening = document.getElementById("nomorRekening");
            var namaAkun = document.getElementById("namaAkun");

            if (metode_bayar != 1) {
                bankInfo.classList.remove("d-none");
                nomorRekening.value = metode_bayar.no_rekening;
                namaAkun.value = metode_bayar.deskripsi;
            } else {
                bankInfo.classList.add("d-none");
            }
        }

        function displayDay() {
            const tanggalInput = document.getElementById('tanggal').value;
            const hariInput = document.getElementById('hari');

            if (tanggalInput) {
                const date = new Date(tanggalInput);
                const options = {
                    weekday: 'long'
                };
                const hari = new Intl.DateTimeFormat('id-ID', options).format(
                    date); // Menampilkan nama hari dalam Bahasa Indonesia

                hariInput.value = hari;
            } else {
                hariInput.value = '';
            }
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError, {
                    enableHighAccuracy: true, // Meminta akurasi tinggi
                    timeout: 10000, // Waktu tunggu 10 detik
                    maximumAge: 0 // Jangan gunakan cache data lokasi lama
                });
            } else {
                alert("Geolocation tidak didukung oleh browser ini.");
            }
        }

        function showPosition(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;

            // Menggunakan Nominatim API untuk mendapatkan alamat dari koordinat
            const url =
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&zoom=18&addressdetails=1`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const address = data.display_name;
                    document.getElementById('alamat').value = address;
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Gagal mengambil alamat. Coba lagi.");
                });
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("Pengguna menolak permintaan Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Informasi lokasi tidak tersedia.");
                    break;
                case error.TIMEOUT:
                    alert("Permintaan lokasi telah habis waktu.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Terjadi kesalahan yang tidak diketahui.");
                    break;
            }
        }

        const checkout = () => {
            let dataPreOrder = localStorage.getItem('listPreOrder') ? JSON.parse(localStorage.getItem('listPreOrder')) :
                []
            console.log('dataPreOrder', dataPreOrder)
            if (dataPreOrder.length == 0) {
                alert('Pilih setidaknya 1 Barang')
            } else {
                window.location.href = '/member/pre-order/checkout'
            }
        }

        document.getElementById('checkoutForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah reload halaman

            let dataPreOrder = localStorage.getItem('listPreOrder') ? JSON.parse(localStorage.getItem(
                'listPreOrder')) : [];
            let items = [];
            if (dataPreOrder.length < 1) {
                alert('Pilih setidaknya 1 produk!')
            }

            let alamat = $('#alamat').val();
            if (alamat == null || alamat == "") {
                alert('Harap isi alamar')
            }
            dataPreOrder.forEach(res => {
                items.push({
                    penyimpanan_id: res.id,
                    qty: res.qty,
                    harga: res.harga
                })
            })
            let payload = {
                id: dataPOMembership.id,
                tanggal: $('#tanggal').val(),
                member_id: JSON.parse(user).member_id,
                nama: JSON.parse(user).karyawan.nama_lengkap,
                no_hp: JSON.parse(user).no_hp,
                email: JSON.parse(user).email,
                periode_po: $('#periode_po').val(),
                metode_pengiriman: parseInt($('#metode_pengiriman').val()),
                total_bayar: totalBayar,
                alamat: $('#alamat').val(),
                items: items,
            }

            if ($('#metode_bayar').val() != 1) {
                payload.metode_bayar = 2;
                payload.rekening_id = JSON.parse($('#metode_bayar').val()).id;
            } else {
                payload.metode_bayar = parseInt($('#metode_bayar').val());
            }

            // console.log('payload', payload)
            // return false;

            $(".loadingOverlay").attr("hidden", false);
            var token = localStorage.getItem('token')

            axios.post(`${API_URL}/v1/po-membership/store`, payload, {
                    headers: {
                        'secret': API_SECRET,
                        'Author': 'bearer ' + token,
                        'device': 'web'
                    }
                })
                .then(function(response) {
                    $(".loadingOverlay").attr("hidden", true);
                    localStorage.setItem('invoice', JSON.stringify(response.data))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data Preorder anda berhasil diubah!'
                    });
                    window.location.href = `/member/pre-order/member-card`
                })
                .catch(function(error) {
                    $(".loadingOverlay").attr("hidden", true);
                    // handle error
                    console.log(error);
                    alert(error.response.data.error)
                });

        });

        // Lazy load scroll event
        window.addEventListener('scroll', () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 500) {
                if (render == true) {
                    getPOMembership();
                }
            }
        });

        const created = () => {
            // loadProducts();
            getRekening()
            getPOMembership();

            // localStorage.removeItem('listPreOrder')
            if (user) {
                document.getElementById('namaUser').innerHTML = JSON.parse(user).karyawan.nama_lengkap
                document.getElementById('total-amount').innerHTML = "Rp. 0"
            } else {
                window.location.href = "/login"
            }
        }

        created()
    </script>
@endsection

@section('js')
    <script>
        $('#menuBottom').remove()
    </script>
@endsection
