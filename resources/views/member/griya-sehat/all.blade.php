@extends('layouts.member')

@section('content')
<main id="main" class="">
    <div class="container" style="margin-top: 150px;">
        <div class="row justify-content-between ">
            <div class="col">
                <h4 class="mt-2">
                    <b>
                        Griya Sehat
                    </b>
                </h4>    
                <div class="row mb-1">
                    <div class="col-sm-5">
                        <div class="input-group mb-2">
                            <input type="text" value="" id="search" class="form-control" style=""
                                placeholder="Cari griya sehat..."aria-describedby="submitButton">
                            <button onclick="cari()" class="btn btn-primary"
                                style="" type="button"
                                id="submitButton"><i class="bi bi-search text-white"></i></button>
                        </div>
                    </div>
                    <div class="col-sm">
                        <a href="/griya-sehat/terdekat" class="btn btn-primary"><i class="bi bi-geo-alt-fill"></i> Cari Griya Sehat Terdekat</a>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                {{-- <a href="/semua-terapis" class="btn btn-primary">Lihat Semua</a> --}}
            </div>
        </div>

        <div class="row g-3">
            <div class="row g-3 mt-1" id="list-terapis">
                <!-- Card akan diappend di sini -->
              </div>
        </div>

          <br><br>
    </div>
</main>
@endsection

@section('css')
    <style>
        @keyframes pulse {
            0% { background-color: #e0e0e0; }
            50% { background-color: #f0f0f0; }
            100% { background-color: #e0e0e0; }
        }
    </style>
@endsection

@section('js')
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    <script>
        var API_URL = document.querySelector('meta[name="api-url"]').getAttribute('content');
    var API_SECRET = document.querySelector('meta[name="api-secret"]').getAttribute('content');
        function copyPromoCode(promoCode) {
            navigator.clipboard.writeText(promoCode).then(function() {
                alert("Kode promo berhasil disalin!");
            }, function() {
                alert("Maaf, terjadi kesalahan saat menyalin kode promo.");
            });
        }

        function filter(data, id) {
            if (data == 0) {
                alert("Coming Soon")
            } else {
                localStorage.setItem('kategori_id', id)
                localStorage.setItem('kategori', JSON.stringify(data))
                window.location.href = "/list-produk"
            }
        }

        function filterQurban(dataQurban, data, id) {
            localStorage.setItem('kategori_id', id)
            localStorage.setItem('kategori', JSON.stringify(data))
            localStorage.setItem('gerai_id', dataQurban.id)
            localStorage.setItem('gerai', JSON.stringify(dataQurban))
            window.location.href = "/list-produk"

        }

        function filterTerapi(dataTerapi, data, id) {
            localStorage.removeItem('kategori_id')
            localStorage.removeItem('kategori')
            localStorage.setItem('gerai_id', dataTerapi.id)
            localStorage.setItem('gerai', JSON.stringify(dataTerapi))
            window.location.href = "/list-produk"

        }

        function openKatalog() {
            console.log('gudang_id', gudang_id)
            if (gudang_id == undefined) {
                alert('Pilih Gerai Terlebih Dahulu!')
            }
            window.location.href = `/katalog-produk/${gudang_id}`;

        }

        geraiNow = JSON.parse(localStorage.getItem('gerai'));
        if (geraiNow) {
            $('#namaGerai').html(geraiNow.nama_cabang)
        }
        function getTerapis(dataTerapi) {
            localStorage.setItem('terapis', dataTerapi.id)

        }

        getGerai()
        gerai_id = localStorage.getItem('gerai_id')
        terapis = localStorage.getItem('terapis')

        function showSkeleton(count = 3) {
            const container = document.getElementById("list-terapis");
            container.innerHTML = ""; // clear

            for (let i = 0; i < count; i++) {
                const skeleton = `
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 rounded-4 h-100">
                    <div class="row g-0 align-items-center">
                        <div class="col-4 text-center">
                        </div>
                        <!-- Detail skeleton -->
                        <div class="col-8">
                        <div class="card-body">
                            <h6 class="placeholder-glow">
                            <span class="placeholder rounded-2 col-8"></span>
                            </h6>
                            <p class="placeholder-glow small mb-2">
                            <span class="placeholder rounded-2 col-6"></span>
                            </p>
                            <div class="placeholder-glow">
                            <span class="placeholder rounded-2 col-4"></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                            <div></div>
                            <span class="btn placeholder col-6"></span>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>`;
                container.insertAdjacentHTML("beforeend", skeleton);
            }
            }

            function getGerai() {
            // ⏳ tampilkan skeleton dulu
            showSkeleton(6);

            axios.get(`${API_URL}/affiliator/cabang`, {
                headers: {
                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                'device': 'web'
                }
            })
            .then(res => {
                const data = res.data.data;
                const container = document.getElementById("list-terapis");
                container.innerHTML = ""; // hapus skeleton

                data.forEach(item => {
                const nama = 'GRIYA SEHAT Reflexology & Shiatsu Modern' || "Nama Tidak Tersedia";
                const kota = item.kota_kab || "Kota Tidak Tersedia";
                const foto = item.photo 
                    // ? `${API_URL}/${item.photo}`
                    ? `https://tempatspa.com/pictures/place-full/2/21.08.09.15.27-1628497664.6476-68589743.png` 
                    : "https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png";
                const rating = item.rating || "0.0";
                const sertifikasi = item.sertifikasi || "Sertifikasi Asosiasi";
                const slug = item.slug || item.id;

                const card = `
                    <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow border-0 h-100" style="border-radius: 15px;">
                        <div class="row g-0 align-items-center">
                        <div class="col-4 text-center">
                            <img src="${foto}" style="width: 100%; height: 170px; object-fit: cover;" class="rounded-4 p-2">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                            <h6 class="card-title mb-1"><b>${nama}</b></h6>
                            <p class="text-muted small mb-2">${kota}</p>
                            <div class="d-flex flex-wrap gap-3 mb-2">
                                <span class="d-flex align-items-center small text-muted">
                                <i class="bi bi-star-fill me-1 text-warning"></i> ${rating}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div></div>
                                <button 
                                class="btn text-black lihat-terapis border" 
                                data-slug="${slug}">
                                Lihat Griya Sehat
                                </button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>`;
                
                container.insertAdjacentHTML("beforeend", card);
                });

                // Event listener tombol
                document.querySelectorAll(".lihat-terapis").forEach(btn => {
                btn.addEventListener("click", function() {
                    const slug = this.getAttribute("data-slug");
                    const selected = data.find(d => (d.slug || d.id) == slug);
                    localStorage.setItem("selectedTerapis", JSON.stringify(selected));
                    window.location.href = `/detail-terapis/${slug}`;
                });
                });

            })
            .catch(err => {
                console.error(err);
            });
            }



        function pilihGerai(value) {
            console.log(value)
            if (value == "semua") {
                localStorage.removeItem('gerai_id')
                localStorage.removeItem('gerai')
                localStorage.removeItem('kategori_id')
                localStorage.removeItem('kategori')
                window.location.href = "/list-produk"
            } else {
                localStorage.setItem('gerai_id', value.id)
                localStorage.setItem('gerai', JSON.stringify(value))
                window.location.href = "/list-produk"
            }
        }
    </script>
@endsection
