<style>
    .card {
        box-shadow: 0px 3px 9px rgba(0, 0, 0, 0.164);

    }

    .card:hover {
        box-shadow: 0px 3px 7px rgba(0, 0, 0, 0.26);
        cursor: pointer;
    }


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

    /* Gaya Dasar Skeleton */
    .skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        border-radius: 4px;
        display: inline-block;
        height: 1em;
        width: 100%;
        position: relative;
        overflow: hidden;
    }

    /* Gaya Skeleton Gambar */
    .skeleton-img {
        width: 100%;
        height: 150px;
        border-radius: 4px;
    }

    /* Gaya Skeleton Teks */
    .skeleton-text {
        width: 100%;
        height: 1em;
        margin-bottom: 0.5em;
    }

    /* Gaya Skeleton Tombol */
    .skeleton-button {
        width: 100%;
        height: 2em;
        border-radius: 4px;
    }

    /* Animasi Skeleton */
    @keyframes loading {
        0% {
            background-position: 0% 0%;
        }

        100% {
            background-position: 100% 0%;
        }
    }

    /* Terapkan Animasi */
    .skeleton {
        animation: loading 1.5s infinite ease-in-out;
    }

    @keyframes s3 {
        100% {
            transform: rotate(1turn)
        }
    }

    @media only screen and (min-width: 1024px) {
        .row-mobile {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr)) !important;
            grid-column-gap: 5px !important;
            grid-row-gap: 5px !important;
            grid-auto-rows: min-content !important;
        }
    }

    @media only screen and (max-width:767px) {
        .row-mobile {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            grid-column-gap: 5px !important;
            grid-row-gap: 5px !important;
            grid-auto-rows: min-content !important;
        }
    }

    h6 {
        font-size: 13px;
    }
</style>

<section id="recent-blog-posts" class="recent-blog-posts">

    <div class="container" style="" data-aos="fade-up">
        <div class="row-mobile" id="dataProduk">

        </div>
        <div id="loading">
            <div class="row-mobile">
                @for ($i = 0; $i < 6; $i++)
                    <!-- resources/views/components/skeleton-card.blade.php -->
                    <div class="post-box">
                        <div>
                            <div class="skeleton skeleton-img"></div>
                            <h6 class="skeleton skeleton-text"></h6>
                            <b class="skeleton skeleton-text"></b> <br>
                            <span class="skeleton skeleton-text"></span>
                            <hr>
                        </div>
                        <div class="text-center row">
                            <div class="col">
                                <div class="skeleton skeleton-button"></div>
                            </div>
                            <div class="col">
                                <div class="skeleton skeleton-button"></div>
                            </div>
                            <div class="col">
                                <div class="skeleton skeleton-button"></div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

        </div>
        <center>
            {{-- <div id="loading" class="custom-loader"></div> --}}
        </center>
    </div>
</section>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('lib/axios.min.js') }}"></script>

<script>
    var member_id = localStorage.getItem('member_id')
    var gerai_id = localStorage.getItem('gerai_id')
    var gudang_id


    var itemsPerPage = 6; // Jumlah item per halaman
    var currentPage = 1;
    var totalPages = 1;
    var isLoading = false;
    var contentElement = document.getElementById('dataProduk');
    var loadingElement = document.getElementById('loading');
    if (gerai_id) {
        cekMember()
    } else {
        getProduk(currentPage)

    }

    function cekMember() {
        axios.get(`${API_URL}/v1/affiliator/member-public/${gerai_id}`, {
                headers: {
                    'secret': API_SECRET,
                    'device': 'web'
                }
            })
            .then(function(response) {
                let memberData = response.data
                if (memberData.sebagai == 'marketing') {
                    if (memberData.wilayah[0]) {
                        gudang_id = memberData.wilayah[0].gudang_id
                        getProdukRef(currentPage)
                    } else {
                        getGudang()
                    }
                } else {
                    getGudang()
                }
                console.log(response.data)
            })
            .catch(function(error) {
                // handle error
                console.log(error);
            });
    }

    function getProduk(page) {

        isLoading = true;
        loadingElement.style.display = 'block';

        axios.get(
                `${API_URL}/v1/toko-penyimpanan-public?harga=retail&start=${(page - 1) * itemsPerPage}&length=${itemsPerPage}&gudang_id=83&order=desc&show_as_product=1`, {
                    headers: {
                        'secret': API_SECRET,
                        'device': 'web'
                    }
                })
            .then(function(response) {
                let dataProduk = response.data.data
                totalPages = Math.ceil(response.data.total / itemsPerPage);
                // $('#dataProduk').html("");

                if (dataProduk[0] != null) {
                    $.each(dataProduk, function(key, value) {
                        $('#dataProduk').append(`
                                <div class="post-box" >
                                    <div style="cursor:pointer" onclick='detailProduk(${JSON.stringify(value)})'>
                                        <div class="post-img"><img
                                        src="${value.photo[0] && value.photo[0].path ? value.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}"
                                        class="img-fluid" alt=""></div>

                                        <h6 class="text-dark"><b> ${value.nama.slice(0, 17) + (value.nama.length > 17 ? "..." : "")}  </b></h6>
                                        <b class="text--primary" > ${rupiah(value.harga)}</b> ${value.harga_coret > 0 ? `<s style="font-size: 13px; color: grey;">${rupiah(value.harga_coret)}</s>` : ''} <br>
                                        <span style="color: grey; font-size:12px;">${value.varian_barang[0].gudang.alamat ? value.varian_barang[0].gudang.alamat : ''}</span>
                                        <hr>
                                    </div>
                                    <div class="text-center row">
                                        <div class="col">
                                            <i onclick="alert('Coming Soon')"
                                                class="bi bi-heart text-center text-primary" style="cursor:pointer"></i>
                                        </div>
                                        <div class="col">
                                            <a onclick='share(${JSON.stringify(value)})' data-bs-toggle="modal" style="cursor: pointer;"
                                                data-bs-target="#modalLink"> <i class="bi bi-share text-center text-primary"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            `);

                    });
                } else {
                    $('#dataProduk').html(`
                        <center>
                            <br><br>
                            <img src="{{ asset('images/empty.png') }}" style="width: 250px;" alt=""><br>
                            <h4 class="text--primary"><b> Tidak Ditemukan</b></h4>
                            <h6>Mohon maaf Produk tidak ditemukan</h6>
                            <br><br>
                        </center>
                        `)
                }

                isLoading = false;
                loadingElement.style.display = 'none';
            })
            .catch(function(error) {
                // handle error
                console.log(error);
            });
    }

    function checkAndLoadData() {
        const scrollPosition = window.scrollY + window.innerHeight;
        const contentHeight = contentElement.offsetHeight;

        if (!isLoading && scrollPosition >= contentHeight && currentPage < totalPages) {
            currentPage++;
            if (gerai_id) {
                getProdukRef(currentPage)
            } else {
                getProduk(currentPage)

            }
        }
    }

    // Event listener untuk mendeteksi scroll
    window.addEventListener('scroll', checkAndLoadData);


    function getGudang() {
        axios.get(`${API_URL}/v1/gudang-public?member_id=${gerai_id}`, {
                headers: {
                    'secret': API_SECRET,
                    'device': 'web'
                }
            })
            .then(function(response) {
                gudang_id = response.data.data[0].id
                getProdukRef(currentPage)
            })
            .catch(function(error) {
                // handle error
                $('#dataProduk').html(`
                        <center>
                            <br><br>
                            <img src="{{ asset('images/empty.png') }}" style="width: 250px;" alt=""><br>
                            <h4 class="text--primary"><b> Tidak Ditemukan</b></h4>
                            <h6>Mohon maaf Produk tidak ditemukan</h6>
                            <br><br>
                        </center>`);
                console.log(error);
            });

    }

    function getProdukRef(page) {
        isLoading = true;
        loadingElement.style.display = 'block';
        axios.get(
                `${API_URL}/v1/toko-penyimpanan-public?harga=retail&start=${(page - 1) * itemsPerPage}&length=${itemsPerPage}&gudang_id=83&show_as_product=1`, {
                    headers: {
                        'secret': API_SECRET,
                        'device': 'web'
                    }
                })
            .then(function(response) {
                let dataProduk = response.data.data
                totalPages = Math.ceil(response.data.total / itemsPerPage);
                // $('#dataProduk').html("");

                if (dataProduk[0] != null) {
                    $.each(dataProduk, function(key, value) {
                        $('#dataProduk').append(`
                                <div class="post-box" >
                                    <div style="cursor:pointer" onclick='detailProduk(${JSON.stringify(value)})'>
                                        <div class="post-img"><img
                                        src="${value.photo[0] && value.photo[0].path ? value.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}"
                                        class="img-fluid" alt=""></div>

                                        <h6 class="text-dark"><b> ${value.nama.slice(0, 17) + (value.nama.length > 17 ? "..." : "")}  </b></h6>
                                        <b class="text--primary" > ${rupiah(value.harga)}</b> ${value.harga_coret > 0 ? `<s style="font-size: 13px; color: grey;">${rupiah(value.harga_coret)}</s>` : ''} <br>
                                        <span style="color: grey; font-size:12px;">${value.varian_barang[0].gudang.alamat ? value.varian_barang[0].gudang.alamat : ''}</span>
                                        <hr>
                                    </div>
                                    <div class="text-center row">
                                        <div class="col">
                                            <i onclick="alert('Coming Soon')"
                                                class="bi bi-heart text-center text-primary" style="cursor:pointer"></i>
                                        </div>
                                        <div class="col">
                                            <a onclick='share(${JSON.stringify(value)})' data-bs-toggle="modal" style="cursor: pointer;"
                                                data-bs-target="#modalLink"> <i class="bi bi-share text-center text-primary"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            `);

                    });
                } else {
                    $('#dataProduk').html(`
                    <center>
                        <br><br>
                        <img src="{{ asset('images/empty.png') }}" style="width: 250px;" alt=""><br>
                        <h4 class="text--primary"><b> Tidak Ditemukan</b></h4>
                        <h6>Mohon maaf Produk tidak ditemukan</h6>
                        <br><br>
                    </center>
                    `)
                }
                isLoading = false;
                loadingElement.style.display = 'none';
            })
            .catch(function(error) {
                // handle error
                $('#dataProduk').html(`
                    <center>
                        <br><br>
                        <img src="{{ asset('images/empty.png') }}" style="width: 250px;" alt=""><br>
                        <h4 class="text--primary"><b> Tidak Ditemukan</b></h4>
                        <h6>Mohon maaf Produk tidak ditemukan</h6>
                        <br><br>
                    </center>`);
                console.log(error);
            });
    }

    function detailProduk(data) {
        window.location.href = `/detail-produk/${data.slug}`
    }

    function masukKeranjang(detailProduk) {
        if (detailProduk.varian_barang[0].barang.kategori.kategori == "Hewan Qurban") {
            alert('Hewan Qurban tidak bisa dimasukkan ke keranjang');
        } else {
            var data = localStorage.getItem('listKeranjang') ? JSON.parse(localStorage.getItem('listKeranjang')) : []
            var penyimpananId = detailProduk.varian_barang[detailProduk.varian_barang.length - 1].id
            if (user) {
                payload = {
                    penyimpanan_id: penyimpananId,
                    qty: 1,
                    member_id: JSON.parse(user).karyawan.id,
                }
                var token = localStorage.getItem('token')
                axios.post(`${API_URL}/v1/input/cart`, [payload], {
                        headers: {
                            'secret': API_SECRET,
                            'Author': 'bearer ' + token,
                            'device': 'web'
                        }
                    })
                    .then(function(response) {
                        var toastElList = [].slice.call(document.querySelectorAll('.toast-success'))
                        var toastList = toastElList.map(function(toastEl) {
                            return new bootstrap.Toast(toastEl)
                        })
                        toastList.forEach(toast => toast.show())
                    })
                    .catch(function(error) {
                        // handle error
                        alert(error.response.data.message)
                        console.log(error);
                    });
            } else {
                if (detailProduk.varian_barang[0].jumlah == 0) {
                    alert(
                        `Stok ${detailProduk.varian_barang[0].barang.nama} tidak cukup: ${detailProduk.varian_barang[0].jumlah}`
                    )
                } else {
                    if (data == undefined) {
                        data.push({
                            id: penyimpananId,
                            qty: 1,
                            jumlah: detailProduk.varian_barang[0].jumlah,
                            konversi_ket: detailProduk.varian_barang[0].konversi_ket,
                            barang: detailProduk.varian_barang[0].barang,
                            harga: detailProduk.harga,
                            member_id: detailProduk.member_id
                        })
                        localStorage.setItem('listKeranjang', JSON.stringify(data))
                    } else {
                        let existKeranjang = data.find(res => {
                            return res.id == penyimpananId
                        })
                        if (!existKeranjang) {
                            data.push({
                                id: penyimpananId,
                                qty: 1,
                                jumlah: detailProduk.varian_barang[0].jumlah,
                                konversi_ket: detailProduk.varian_barang[0].konversi_ket,
                                barang: detailProduk.varian_barang[0].barang,
                                harga: detailProduk.harga,
                                member_id: detailProduk.member_id
                            })
                            localStorage.setItem('listKeranjang', JSON.stringify(data))
                        } else {
                            data.map(res => {
                                if (res.id == penyimpananId) {
                                    res.qty = 1
                                }
                            })
                            localStorage.setItem('listKeranjang', JSON.stringify(data))
                        }
                    }
                    var toastElList = [].slice.call(document.querySelectorAll('.toast-success'))
                    var toastList = toastElList.map(function(toastEl) {
                        return new bootstrap.Toast(toastEl)
                    })
                    toastList.forEach(toast => toast.show())
                }
            }
        }
    }

    function share(item) {
        $('#copyText').val(`https://balanja.id/detail-produk/${item.slug}`)
        $('#linkAffiliate').html(`https://balanja.id/detail-produk/${item.slug}`)
        $('#linkSalin').html(
            `<a onclick="salinLink('https://balanja.id/detail-produk/${item.slug}')" style="cursor: pointer">
                    <i style="font-size: 40px;color: blue" class="fas fa-copy"></i>
                    <p class="text-center">Salin Link</p>
                </a>
                `
        )
        $('#linkWhatsapp').html(
            `   <a href="whatsapp://send?text=https://balanja.id/detail-produk/${item.slug}" style="cursor: pointer">
                        <i style="font-size: 40px;color: green" class="bi bi-whatsapp"></i>
                        <p class="text-center">Whatsapp</p>
                    </a> `
        )
    }

    function salinLink(text) {
        const el = document.createElement('textarea');
        el.value = text;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        navigator.clipboard.writeText(text);
        alert('Link Disalin');
    }
</script>
