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

        /* Make the image inside the payment card consistent in size with a rounded frame */
        .payment-card img.payment-icon {
            width: 50px; /* Set a fixed size for the image */
            height: 50px; /* Ensure the height matches the width */
            border-radius: 50%; /* Make the image round */
            object-fit: cover; /* Ensure the image covers the space without distortion */
            margin-right: 10px; /* Space between the image and the text */
        }

        /* Horizontal layout for payment card content */
        .payment-card .card-body {
            display: flex;
            align-items: center; /* Vertically align items */
            justify-content: flex-start; /* Align content to the left */
            gap: 10px; /* Space between elements */
        }

        /* Style for radio button */
        .payment-card input[type="radio"] {
            margin-right: 10px; /* Space between the radio button and image */
        }

        /* Bold style for the payment method name */
        .payment-card .form-check-label {
            font-weight: bold;
        }

        /* Add shadow effect on card selection */
        .payment-card.selected {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 10px; /* Rounded corners */
        }

        /* Hover effect for the card */
        .payment-card:hover {
            transform: scale(1.05); /* Slight zoom effect on hover */
            cursor: pointer; /* Change cursor to pointer to show it's clickable */
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
        <div class="modal-dialog modal-lg">
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
                        {{-- <div class="mb-3">
                            <label for="po" class="form-label">Pilih PO</label>
                            <select class="form-select" id="periode_po" name="po" required>
                                <option value="Minggu 1">Minggu 1</option>
                                <option value="Minggu 2">Minggu 2</option>
                                <option value="Minggu 3">Minggu 3</option>
                                <option value="Minggu 4">Minggu 4</option>
                            </select>
                        </div> --}}

                        <!--  (Pilihan Periode Tanggal) -->
                        <div class="mb-3">
                            <label for="po" class="form-label">Pilih Periode Tanggal PO</label>
                            <select class="form-select" id="periode_tanggal" name="po_tanggal" required>
                            </select>
                        </div>

                        <!-- Pembayaran -->
                        <div class="mb-3">
                            <label for="pembayaran" class="form-label">Metode Pembayaran</label>
                            <!-- <select class="form-select" id="metode_bayar" name="pembayaran" required
                                onchange="showBankInfo()">
                                {{-- <option value="1">Cash</option> --}}
                                {{-- <option value="1">Transfer - Mandiri</option>
                                <option value="transfer-bca">Transfer - BCA</option> --}}
                            </select> -->
                            <div>
                                <button type="button" class="btn btn-primary" id="selectPaymentMethodBtn" data-bs-toggle="modal" data-bs-target="#paymentMethodModal">
                                    <strong>Pilih</strong>
                                </button>
                            </div>
                            <p id="selectedPaymentMethod" class="mt-2"></p> <!-- Description of the selected payment method -->
                        </div>

                        <!-- Informasi Rekening -->
                        <div id="bankInfo" class="d-none">
                            <div class="mb-3 d-none">
                                <label class="form-label">Nomor Rekening</label>
                                <input type="text" id="nomorRekening" class="form-control" readonly disabled>
                            </div>
                            <div class="mb-3 d-none">
                                <label class="form-label">Nama Akun</label>
                                <input type="text" id="namaAkun" class="form-control" readonly disabled>
                            </div>
                        </div>

                        <!-- Pengiriman -->
                        <div class="mb-3">
                            <label for="pengiriman" class="form-label">Metode Pengiriman</label>
                            <select class="form-select" id="metode_pengiriman" name="pengiriman" required onchange="toggleOngkirNote()">
                                <option value="1">Diambil</option>
                                <option value="2">Dikirim</option>
                            </select>
                            <small id="ongkir_note" class="text-muted mt-1 d-none">
                                * Pengiriman memungkinkan akan ada biaya ongkir.
                            </small>
                        </div>

                        <!-- Catatan -->
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Catatan"></textarea>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" form="checkoutForm">Pesan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Selecting Payment Method -->
    <div class="modal fade" id="paymentMethodModal" tabindex="-1" aria-labelledby="paymentMethodModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentMethodModalLabel">Pilih Metode Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="paymentMethodsList" class="row">
                        <!-- Payment methods will be dynamically added here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="submitPaymentMethodBtn">Pilih</button>
                </div>
            </div>
        </div>
    </div>
    <!-- / -->

    <!-- Invoice Modal -->
    @include('member.produk.preOrder.modals.payment-instruction')

    <!-- Add CSS to prevent closing on ESC or clicking outside -->
    <style>
        .modal.fade {
            pointer-events: auto !important;
        }
    </style>
    <!-- / -->

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
                dataPOMembership.items = dataPOMembership.items.filter(item => item.barang != null);
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
                // $('#periode_po').val(dataPOMembership.periode_po)
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
                    nomorRekening.value = rekeningTerpilih?.no_rekening ?? 1;
                    namaAkun.value = rekeningTerpilih?.deskripsi ?? "-";
                }
                $('#metode_pengiriman').val(dataPOMembership.metode_pengiriman)
                $('#alamat').val(dataPOMembership.alamat)
                $('#periode_tanggal').val(dataPOMembership.periode_tanggal_id)
                $('#catatan').val(dataPOMembership.catatan)
                toggleOngkirNote();
                loadProducts()
            } catch (error) {
                render = true
                console.error('Error fetching PO Membership:', error);
                return null;
            }
        };

        const getPaymentMethods = async () => {
            try {
                const response = await axios.get(`${API_URL}/v1/po-payment/get-payment-methods`, {
                    headers: {
                        'secret': API_SECRET,
                        'Author': 'bearer ' + token,
                        'device': 'web'
                    }
                });

                const paymentMethods = response.data.data;

                // Get the payment methods list container
                const $paymentMethodsList = $('#paymentMethodsList');
                $paymentMethodsList.empty(); // Clear existing methods

                // Create card-style options for each payment method
                paymentMethods.forEach((method, index) => {
                    const methodHTML = `
                        <div class="col-12 col-md-6 mb-3">
                            <div class="card payment-card p-3 shadow-sm">
                                <div class="card-body">
                                    <!-- Radio button on the left -->
                                    <input type="radio" name="paymentMethod" id="paymentMethod${index}" value="${method.payment_code}" data-payment-type="${method.payment_type}">
                                    
                                    <!-- Image icon with rounded frame -->
                                    <img src="${method.icon_url}" alt="${method.label}" class="img-fluid payment-icon">
                                    
                                    <!-- Payment method name in bold style -->
                                    <label for="paymentMethod${index}" class="form-check-label ms-2">${method.label}</label>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#paymentMethodsList').append(methodHTML);
                });

            } catch (error) {
                console.error('Error fetching payment methods:', error);
            }
        };

        $(document).ready(function() {
            // Handle the click event for payment method cards
            $('#paymentMethodsList').on('click', '.payment-card', function () {
                var radioButton = $(this).find('input[type="radio"]'); // Get the radio button inside the clicked card
                radioButton.prop('checked', true); // Check the radio button
                
                // Add a round-shadow effect on the clicked card
                $(this).addClass('shadow-lg').siblings().removeClass('shadow-lg'); // Add shadow to the selected card and remove from others
            });

            // Handle submission of selected payment method
           $('#submitPaymentMethodBtn').click(function () {
                var selectedMethod = $('input[name="paymentMethod"]:checked').val(); // Get the selected payment method code
                
                // Correctly find the associated label using the 'for' attribute
                var selectedLabel = $('input[name="paymentMethod"]:checked').closest('.card-body').find('label').text().trim();

                console.log('selectedMethod', selectedMethod)
                console.log('selectedLabel', selectedLabel)

                if (selectedMethod) {
                    $('#selectedPaymentMethod').html(`
                    <b>Terpilih: ${selectedLabel}</b>
                    `);
                    $('#paymentMethodModal').modal('hide'); // Close the payment method modal
                    $('#checkoutModal').modal('show'); // Show the checkout modal
                } else {
                    alert('Please select a payment method');
                }
            });

            // When the payment method modal is shown, fetch and display the payment methods
            $('#paymentMethodModal').on('show.bs.modal', function () {
                getPaymentMethods();  // Fetch payment methods on modal show
            });

            $('#paymentMethodModal').on('hidden.bs.modal', function () {
                $('#checkoutModal').modal('show');
            });

            // Handler for the confirm payment button click
            $('#confirmPaymentBtn').on('click', function() {
                $(this).text('Loading...')
                $(this).attr('disabled', true)

                // Get the orderId from the #orderId element
                const orderId = $('#orderId').text();

                if (!orderId) {
                    console.log('Order ID is missing');
                    return;
                }

                // Show the loading spinner
                $(".loadingOverlay").attr("hidden", false);

                // Perform the fetch request
                axios.get(`${API_URL}/v1/po-payment/transaction/${orderId}`, {
                    headers: {
                        'secret': API_SECRET,
                        'Author': 'bearer ' + token,
                        'device': 'web'
                    }
                })
                .then(response => {
                    $(this).text('Saya Sudah Bayar')
                    $(this).attr('disabled', false)

                    // Hide the loading spinner once the response is received
                    $(".loadingOverlay").attr("hidden", true);

                    const poPayment = response.data
                    const {status} = poPayment
                    console.log('status', status)
                    const isPaid = ['settlement', 'captured'].includes(status)
                    const badgeColor = isPaid ? `success` : `danger`
                    const statusLabel = isPaid ? "LUNAS" : status
                    const statusHtml = `
                        <b class="text-${badgeColor}">${statusLabel.toUpperCase()}</b>
                    `

                    $('#status').html(statusHtml)

                    
                    if(isPaid) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Pesanan sudah kami terima mohon tunggu admin kami menghubungi dan mengirimkan invoice!',
                            timer: 4500,
                            showConfirmButton: false,
                            willClose: () => {
                                // Reload the page after the Swal disappears
                                // window.location.reload();
                                window.location.href = `/member/pre-order/member-card`;
                            }
                        });
                    }
                    
                    // Log the response to the console
                    console.log('Response:', response);
                })
                .catch(e => {
                    $(this).text('Saya Sudah Bayar')
                    $(this).attr('disabled', false)

                    // Hide the loading spinner in case of an error
                    $(".loadingOverlay").attr("hidden", true);

                    // Log the error
                    console.error('Error fetching data:', error);
                })
            });
        })

        const loadProducts = () => {

            if (isLoading) return;
            isLoading = true;
            if (isProduk == true) {
                document.getElementById('skeleton-loader').style.display = 'block';
                const urlParams = new URLSearchParams(window.location.search);
                const search = urlParams.get('search') ?? '';
                axios.get(
                        `${API_URL}/v1/toko-penyimpanan-public?harga=retail&start=${(page - 1) * itemsPerPage}&length=${itemsPerPage}&gudang_id=83&order=desc&show_as_product=1&search=${search}`, {
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

                        // if (listPreOrder.length > 0) {
                        //     listPreOrder = []
                        // }


                        products.forEach(product => {

                            // if (findData != null) {
                            //     listPreOrder.push({
                            //         id: product.id,
                            //         qty: findData.qty,
                            //         jumlah: product.varian_barang[0].jumlah,
                            //         barang: product.varian_barang[0].barang,
                            //         harga: product.harga,
                            //     });
                            // }

                            // localStorage.setItem('listPreOrder', JSON.stringify(
                            //     listPreOrder))

                            let dataPre = localStorage.getItem('listPreOrder') ? JSON.parse(
                                localStorage.getItem(
                                    'listPreOrder')) : []

                            let findData = dataPre.find(res => res.id == product
                            .id);

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

                        totalBayar = keepHarga
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

        const getPeriodeTanggalSet = async () => {
            try {
                render = false;
                const response = await axios.get(`${API_URL}/v1/periode-tanggal-set`, {
                    headers: {
                        'secret': API_SECRET,
                        'Author': 'bearer ' + token,
                        'device': 'web'
                    }
                });
                hari = response.data.hari;
                bulan = response.data.bulan;
                tahun = response.data.tahun;
                getPeriodeTanggal();
            } catch (error) {
                console.error('Error fetching', error);
                return null;
            }
        };

        const getPeriodeTanggal = async () => {
            try {
                render = false;
                const response = await axios.get(`${API_URL}/v1/periode-tanggal`, {
                    params: {
                        hari: hari,
                        bulan: bulan,
                        tahun: tahun
                    },
                    headers: {
                        'secret': API_SECRET,
                        'Author': 'bearer ' + token,
                        'device': 'web'
                    }
                });
                let periodeTanggal = response.data;
                if (periodeTanggal.length > 0) {
                    $.each(periodeTanggal, (i, value) => {
                        const date = new Date(value.tanggal);
                        const formatted = date.toLocaleDateString('id-ID', {
                            weekday: 'long',    // Hari
                            day: 'numeric',     // Tanggal
                            month: 'long',      // Bulan
                            year: 'numeric'     // Tahun
                        });

                        $('#periode_tanggal').append(`
                            <option value='${value.id}'>${formatted}</option>
                        `);
                    });
                }
                getPOMembership();

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

        function toggleOngkirNote() {
            const metode = document.getElementById('metode_pengiriman').value;
            const note = document.getElementById('ongkir_note');
            if (metode === '2') {
                note.classList.remove('d-none');
            } else {
                note.classList.add('d-none');
            }
        }

        function showBankInfo() {
            var metode_bayar = JSON.parse(document.getElementById("metode_bayar").value);
            var bankInfo = document.getElementById("bankInfo");
            var nomorRekening = document.getElementById("nomorRekening");
            var namaAkun = document.getElementById("namaAkun");

            if (metode_bayar != 1) {
                bankInfo.classList.remove("d-none");
                nomorRekening.value = metode_bayar.no_rekening ?? 1;
                namaAkun.value = metode_bayar.deskripsi ?? "-";
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

            let periode_tanggal = $('#periode_tanggal').val();
            if (periode_tanggal == null || periode_tanggal == "") {
                alert('Harap Isi Periode Tanggal')
                return false
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
                // periode_po: $('#periode_po').val(),
                metode_pengiriman: parseInt($('#metode_pengiriman').val()),
                total_bayar: totalBayar,
                alamat: $('#alamat').val(),
                periode_tanggal_id: $('#periode_tanggal').val(),
                catatan: $('#catatan').val(),
                status_po: 0,
                items: items,
            }

            if ($('#metode_bayar').val() != 1) {
                payload.metode_bayar = 2;
                payload.rekening_id = JSON.parse($('#metode_bayar').val() ?? null)?.id || null;
            } else {
                payload.metode_bayar = parseInt($('#metode_bayar').val()) || 0;
            }

            const selectedPaymentMethod = $('input[name="paymentMethod"]:checked').val();
            const selectedPaymentType = $('input[name="paymentMethod"]:checked').data('payment-type'); // Get the payment_type

            if([null, undefined, ""].includes(selectedPaymentMethod)) {
                alert('Harap pilih metode pembayaran!')
                return false
            }

            payload.payment_gateway = "payment_service"; // manual_transfer || payment_service
            payload.payment_code = selectedPaymentMethod; // Add payment_code from the selected method
            payload.payment_type = selectedPaymentType;

            if(selectedPaymentMethod === 'qris') {
                payload.payment_type = "qris";
                payload.payment_code = "";
            }
            else if(selectedPaymentMethod === 'gopay') {
                payload.payment_type = "gopay";
                payload.payment_code = "";
            }
            else if(selectedPaymentMethod === 'credit_card') {
                payload.payment_type = "credit_card";
                payload.payment_code = "";
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

                    // Show modal with the response data
                    // Modal setup
                    $('#checkoutModal').modal('hide')
                    showInvoiceModal(response.data.data_payment.paymentResponse)

                    // displayInvoiceModal(response.data.data, paymentResponse.data);
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Berhasil',
                    //     text: 'Pesanan sudah kami terima mohon tunggu admin kami menghubungi dan mengirimkan invoice!',
                    //     timer: 4500,
                    //     showConfirmButton: false
                    // });

                    // setTimeout(function () {
                    //     // window.location.href = `/member/pre-order/member-card`;
                    // }, 5000);
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
            getPeriodeTanggalSet();

            // localStorage.removeItem('listPreOrder')
            if (user) {
                document.getElementById('namaUser').innerHTML = JSON.parse(user).karyawan.nama_lengkap
                document.getElementById('total-amount').innerHTML = "Rp. 0"
            } else {
                window.location.href = "/login"
            }
        }

        // Modal function to display payment info
        function showInvoiceModal(paymentResponse) {
            // Update the modal content
            $('#orderId').text(paymentResponse.order_id);
            $('#expiry_time').text(`Batas Waktu: ${new Date(paymentResponse.expiry_time).toLocaleString('id-ID')}`);
            $('#amount').text(`Jumlah yang Harus Dibayar: Rp ${paymentResponse.gross_amount}`);
            
            const status = paymentResponse.transaction_status;
            $('#status').html(`
                <b class="text-danger">${status.toUpperCase()}</b>
            `);

            // Change status text color based on transaction status
            const statusElement = $('#status');
            statusElement.removeClass('text-danger text-green-500 text-red-500'); // Remove previous status color classes
            if (status === 'pending') {
                statusElement.addClass('text-danger'); // Pending status
            } else if (status === 'success') {
                statusElement.addClass('text-success'); // Success status
            } else if (status === 'failed') {
                statusElement.addClass('text-danger'); // Failed status
            }

            // Show specific instructions based on payment method
            $('#payment_instructions').empty();
            $('#payment_instruction_header').empty();
            if (paymentResponse.payment_type === 'bank_transfer') {
                if(paymentResponse.permata_va_number) {
                    
                    const bankName = "Bank Permata";
                    const vaNumber = paymentResponse.permata_va_number;
                    $('#payment_instruction_header').html(`
                        <div><strong>VA Number (${bankName}):</strong> ${vaNumber}</div>
                    `);
                }
                else {
                    // If payment method is Virtual Account (VA), display VA Number
                    const bankName = paymentResponse.va_numbers[0]['bank'] ?? "N/A";
                    const vaNumber = paymentResponse.va_numbers[0]['va_number'] ?? "N/A";
                    $('#payment_instruction_header').html(`
                        <div><strong>VA Number (${bankName}):</strong> ${vaNumber}</div>
                    `);
                }
            } 
            else if (['gopay', 'shopeepay', 'qris'].includes(paymentResponse.payment_type)) {
                // get qris image
                const qrcodeUrl = paymentResponse.actions.find(item => item.name == "generate-qr-code") ?? {url: ""}
                $('#payment_instruction_header').html(`
                    <div><strong>QR Code:</strong></div>
                    <img src="${qrcodeUrl.url}" alt="QR Code" class="img-fluid" />
                `);
                
            }


            // Call the API to get payment instructions for other methods
            axios.get(`${API_URL}/v1/po-payment/payment-instruction/${paymentResponse.order_id}`, {
                headers: {
                    'secret': API_SECRET,
                    'Author': 'bearer ' + token,
                    'device': 'web'
                }
            })
            .then(function(instructionResponse) {
                // Clear previous instructions
                const instructionsContainer = $('#payment_instructions');
                instructionsContainer.empty(); // jQuery method to clear content

                let instructionsHTML = '';
                
                // Loop through each payment method and its associated instructions
                $.each(instructionResponse.data.instruction, function(method, instructionList) {
                    // Create a unique ID for each accordion item
                    const accordionId = 'accordion_' + method.replace(/\s+/g, '_').toLowerCase();

                    // Create accordion for each payment method
                    instructionsHTML += `
                    <div class="accordion" id="${accordionId}">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading_${method}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_${method}" aria-expanded="true" aria-controls="collapse_${method}">
                                    ${method === 'general' ? "Petunjuk" : method.toUpperCase()}
                                </button>
                            </h2>
                            <div id="collapse_${method}" class="accordion-collapse collapse" aria-labelledby="heading_${method}" data-bs-parent="#${accordionId}">
                                <div class="accordion-body">
                                    <ul class="list-disc pl-5">
                                        ${instructionList.map(instruction => `<li>${instruction}</li>`).join('')}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>`;
                });

                // Set the instructions in the modal
                instructionsContainer.html(instructionsHTML); 
            })
            .catch(function(error) {
                console.log('Error fetching payment instructions:', error);
            });

            // Show the modal using Bootstrap's modal method
            $('#invoiceModal').modal('show');
        }

        created()
    </script>
@endsection

@section('js')
    <script>
        $('#menuBottom').remove()
    </script>
@endsection
