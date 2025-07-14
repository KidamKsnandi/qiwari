<style>
    .card {
        box-shadow: 0px 3px 9px rgba(0, 0, 0, 0.164);

    }

    .card:hover {
        box-shadow: 0px 3px 7px rgba(0, 0, 0, 0.26);
        cursor: pointer;
    }


    .custom-loaders {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background:
            radial-gradient(farthest-side, #7044EF 94%, #0000) top/8px 8px no-repeat,
            conic-gradient(#0000 30%, #7044EF);
        -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 8px), #000 0);
        animation: s3 0.5s infinite linear;
    }

    .product-list-container {
        height: 400px;
        width: 100%;
        overflow-x: auto;
    }

    .product-list-container::-webkit-scrollbar {
        display: none;
    }

    .product-list {
        display: inline-flex;
    }

    .product {
        width: 200px;
        height: 200px;
        margin-right: 10px;
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



    h6 {
        font-size: 13px;
    }
</style>

<section id="recent-blog-posts" class="recent-blog-posts">
    <div class="container product-list-container" style="" data-aos="fade-up">
        <div class="product-list" id="dataProduks">

        </div>
        <div id="loadings">
            <div class="product-list">
                @for ($i = 0; $i < 6; $i++)
                    <!-- resources/views/components/skeleton-card.blade.php -->
                    <div class="product post-box">
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
    var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
    var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
    var member_id = localStorage.getItem('member_id')
    var gerai_id = localStorage.getItem('gerai_id')
    var gudang_ids

    var itemsPerPages = 6; // Jumlah item per halaman
    var currentPages = 1;
    var totalPagess = 1;
    var isLoadings = false;
    var contentElements = document.getElementById('dataProduks');
    var loadingsElement = document.getElementById('loadings');
    if (gerai_id) {
        cekMembers()
    } else {
        getProduks(currentPages)

    }

    function cekMembers() {
        axios.get(`${API_URL}/v1/affiliator/member-public/${gerai_id}`, {
                headers: {
                    'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                    'device': 'web'
                }
            })
            .then(function(response) {
                let memberData = response.data
                if (memberData.sebagai == 'marketing') {
                    if (memberData.wilayah[0]) {
                        gudang_ids = memberData.wilayah[0].gudang_id
                        getProduksRefs(currentPages)
                    } else {
                        getGudangs()
                    }
                } else {
                    getGudangs()
                }
                console.log(response.data)
            })
            .catch(function(error) {
                // handle error
                console.log(error);
            });
    }

    function getProduks(page) {

        isLoadings = true;
        loadingsElement.style.display = 'block';

        axios.get(
                `${API_URL}/v1/toko-penyimpanan-public?harga=retail&start=${(page - 1) * itemsPerPages}&length=${itemsPerPages}&gudang_id=83&order=desc&show_as_product=1`, {
                    headers: {
                        'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                        'device': 'web'
                    }
                })
            .then(function(response) {
                let dataProduks = response.data.data
                totalPagess = Math.ceil(response.data.total / itemsPerPages);
                // $('#dataProduks').html("");

                if (dataProduks[0] != null) {
                    $.each(dataProduks, function(key, value) {
                        $('#dataProduks').append(`
                                <div class="product post-box" >
                                    <div style="cursor:pointer" onclick='detailProduks(${JSON.stringify(value)})'>
                                        <div class="post-img"><img
                                        src="${value.photo[0] && value.photo[0].path ? value.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}"
                                        class="img-fluid" alt=""></div>

                                        <h6 class="text-dark"><b> ${value.nama.slice(0, 23) + (value.nama.length > 23 ? "..." : "")}  </b></h6>
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
                                            <i onclick='masukKeranjangs(${JSON.stringify(value)})'
                                                class="bi bi-cart text-center text-primary" style="cursor:pointer"></i>
                                        </div>
                                        <div class="col">
                                            <a onclick='shares(${JSON.stringify(value)})' data-bs-toggle="modal" style="cursor: pointer;"
                                                data-bs-target="#modalLinks"> <i class="bi bi-share text-center text-primary"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            `);


                    });
                } else {
                    $('#dataProduks').html(`
                        <center>
                            <br><br>
                            <img src="{{ asset('images/empty.png') }}" style="width: 250px;" alt=""><br>
                            <h4 class="text--primary"><b> Tidak Ditemukan</b></h4>
                            <h6>Mohon maaf Produk tidak ditemukan</h6>
                            <br><br>
                        </center>
                        `)
                }

                isLoadings = false;
                loadingsElement.style.display = 'none';
            })
            .catch(function(error) {
                // handle error
                console.log(error);
            });
    }

    function checkAndLoadDatas() {
        const scrollPosition = window.scrollY + window.innerHeight;
        const contentHeight = contentElements.offsetHeight;

        if (!isLoadings && scrollPosition >= contentHeight && currentPages < totalPagess) {
            currentPages++;
            if (gerai_id) {
                getProduksRefs(currentPages)
            } else {
                getProduks(currentPages)

            }
            // getProduks(currentPages);
        }
    }

    // Event listener untuk mendeteksi scroll
    window.addEventListener('scroll', checkAndLoadDatas);


    function getGudangs() {
        axios.get(`${API_URL}/v1/gudang-public?member_id=${gerai_id}`, {
                headers: {
                    'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                    'device': 'web'
                }
            })
            .then(function(response) {
                gudang_ids = response.data.data[0].id
                getProduksRefs(currentPages)
            })
            .catch(function(error) {
                // handle error
                $('#dataProduks').html(`
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

    function getProduksRefs(page) {
        isLoadings = true;
        loadingsElement.style.display = 'block';
        axios.get(
                `${API_URL}/v1/toko-penyimpanan-public?harga=retail&start=${(page - 1) * itemsPerPages}&length=${itemsPerPages}&gudang_id=83&show_as_product=1`, {
                    headers: {
                        'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                        'device': 'web'
                    }
                })
            .then(function(response) {
                let dataProduks = response.data.data
                totalPagess = Math.ceil(response.data.total / itemsPerPages);
                // $('#dataProduks').html("");

                if (dataProduks[0] != null) {
                    $.each(dataProduks, function(key, value) {

                        $('#dataProduks').append(`
                                <div class="product post-box" >
                                    <div style="cursor:pointer" onclick='detailProduks(${JSON.stringify(value)})'>
                                        <div class="post-img"><img
                                        src="${value.photo[0] && value.photo[0].path ? value.photo[0].path : 'https://removal.ai/wp-content/uploads/2021/02/no-img.png'}"
                                        class="img-fluid" alt=""></div>

                                        <h6 class="text-dark"><b> ${value.nama.slice(0, 23) + (value.nama.length > 23 ? "..." : "")}  </b></h6>
                                        <b class="text--primary" > ${rupiah(value.harga)} </b> ${value.harga_coret > 0 ? `<s style="font-size: 13px; color: grey;">${rupiah(value.harga_coret)}</s>` : ''} <br>
                                        <span style="color: grey; font-size:12px;">${value.varian_barang[0].gudang.alamat ? value.varian_barang[0].gudang.alamat : ''}</span>
                                        <hr>
                                    </div>
                                    <div class="text-center row">
                                        <div class="col">
                                            <i onclick="alert('Coming Soon')"
                                                class="bi bi-heart text-center text-primary" style="cursor:pointer"></i>
                                        </div>
                                        <div class="col">
                                            <i onclick='masukKeranjangs(${JSON.stringify(value)})'
                                                class="bi bi-cart text-center text-primary" style="cursor:pointer"></i>
                                        </div>
                                        <div class="col">
                                            <a onclick='shares(${JSON.stringify(value)})' data-bs-toggle="modal" style="cursor: pointer;"
                                                data-bs-target="#modalLinks"> <i class="bi bi-share text-center text-primary"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            `);

                    });
                } else {
                    $('#dataProduks').html(`
                    <center>
                        <br><br>
                        <img src="{{ asset('images/empty.png') }}" style="width: 250px;" alt=""><br>
                        <h4 class="text--primary"><b> Tidak Ditemukan</b></h4>
                        <h6>Mohon maaf Produk tidak ditemukan</h6>
                        <br><br>
                    </center>
                    `)
                }
                isLoadings = false;
                loadingsElement.style.display = 'none';
            })
            .catch(function(error) {
                // handle error
                $('#dataProduks').html(`
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

    function detailProduks(data) {
        window.location.href = `/detail-produk/${data.slug}`
    }

    function masukKeranjangs(detailProduk) {
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
                            'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                            'Author': 'bearer ' + token,
                            'device': 'web'
                        }
                    })
                    .then(function(response) {
                        var toastElList = [].slice.call(document.querySelectorAll('.toast-successs'))
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
                                harga: detailProduk.varian_barang[0].harga,
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
                    var toastElList = [].slice.call(document.querySelectorAll('.toast-successs'))
                    var toastList = toastElList.map(function(toastEl) {
                        return new bootstrap.Toast(toastEl)
                    })
                    toastList.forEach(toast => toast.show())
                }
            }
        }
    }

    function shares(item) {
        $('#copyTexts').val(`https://qiwari.id/detail-produk/${item.slug}`)
        $('#linkAffiliates').html(`https://qiwari.id/detail-produk/${item.slug}`)
        $('#linkSalins').html(
            `<a onclick="salinLinks('https://qiwari.id/detail-produk/${item.slug}')" style="cursor: pointer">
                    <i style="font-size: 40px;color: blue" class="fas fa-copy"></i>
                    <p class="text-center">Salin Link</p>
                </a>
                `
        )
        $('#linkWhatsapps').html(
            `   <a href="whatsapp://send?text=https://qiwari.id/detail-produk/${item.slug}" style="cursor: pointer">
                        <i style="font-size: 40px;color: green" class="bi bi-whatsapp"></i>
                        <p class="text-center">Whatsapp</p>
                    </a> `
        )
    }

    function salinLinks(text) {
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
