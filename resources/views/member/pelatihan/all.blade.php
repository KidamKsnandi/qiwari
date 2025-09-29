@extends('layouts.member')

@section('content')
<main id="main" class="">
    <div class="container" style="margin-top: 150px;">
        <div class="row justify-content-between ">
            <div class="col">
                <h4 class="mt-2">
                    <b>
                        Pelatihan
                    </b>
                </h4>    
                <div class="row mb-1">
                    <div class="col-sm-5">
                        <div class="input-group mb-2">
                            <input type="text" value="" id="search" class="form-control" style=""
                                placeholder="Cari pelatihan..."aria-describedby="submitButton">
                            <button onclick="cari()" class="btn btn-primary"
                                style="" type="button"
                                id="submitButton"><i class="bi bi-search text-white"></i></button>
                        </div>
                    </div>
                    <div class="col-sm">
                        {{-- <a href="/griya-sehat/terdekat" class="btn btn-primary"><i class="bi bi-geo-alt-fill"></i> Cari Griya Sehat Terdekat</a> --}}
                    </div>
                </div>
            </div>
            <div class="col-auto">
                {{-- <a href="/semua-terapis" class="btn btn-primary">Lihat Semua</a> --}}
            </div>
        </div>

        <div class="row g-3" id="card-container">
            <!-- Skeleton / Card muncul di sini -->
          </div>
        <div id="sentinel" class="text-center mt-3">
        </div>
        
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
        .training-card {
            border-radius: 15px;
        overflow: hidden;
        transition: transform .25s ease, box-shadow .25s ease;
        background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(250,250,255,0.88));
        }
        .training-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 40px rgba(12, 38, 63, 0.12);
        }


        .training-card .card-img-top {
        height: 140px;
        object-fit: cover;
        filter: saturate(.95) contrast(1.02);
        }


        .badge-topic {
            background: rgb(221, 255, 216);
            color: #16aa1b;
            border: 1px solid #16aa1b;
            border-radius: .45rem;
            padding: .25rem .6rem;
            font-weight: 600;
            font-size: .78rem;
        }


        .price {
        font-weight: 700;
        font-size: 1.05rem;
        }


        .card-footer-custom {
        background: transparent;
        border-top: 1px dashed rgba(15,23,42,0.06);
        padding-top: .75rem;
        margin-top: .75rem;
        }


        /* Small helper to limit description height */
        .desc-clamp {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        }


        /* Responsive tweaks */
        @media (max-width: 575.98px) {
        .training-card .card-img-top { height: 120px; }
        }

        /* Skeleton loader */
        .skeleton {
        background: linear-gradient(90deg, #eee 25%, #f9f9f9 37%, #eee 63%);
        background-size: 400% 100%;
        animation: shimmer 1.4s ease infinite;
        }
        @keyframes shimmer {
        0% { background-position: -400px 0; }
        100% { background-position: 400px 0; }
        }
        .skeleton-text {
        height: 12px;
        border-radius: 6px;
        margin-bottom: 6px;
        }
        .skeleton-img {
        height: 140px;
        width: 100%;
        border-radius: .5rem;
        margin-bottom: 10px;
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
        function formatWaktu(waktu) {
            if (!waktu) return "-";
            const date = new Date(waktu.replace(" ", "T")); 
            // format ke bahasa Indonesia
            const options = { day: "numeric", month: "long", year: "numeric" };
            const formatted = date.toLocaleDateString("id-ID", options);
            // tambahin koma setelah bulan
            const parts = formatted.split(" ");
            return `${parts[0]} ${parts[1]}, ${parts[2]}`;
        }

        const formatRupiah = (number, prefix = undefined) => {
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

        function limitText(text, max = 100) {
          if (!text) return "-";
          return text.length > max ? text.substring(0, max) + "..." : text;
        }


        const container = document.getElementById('card-container');
        const sentinel = document.getElementById('sentinel');
        let start = 0, length = 10;
        let isLoading = false;
      
        // render skeleton
        function showSkeleton(count = 4) {
          const skeletons = [];
          for (let i = 0; i < count; i++) {
            skeletons.push(`
              <div class="col-6 col-md-4 col-lg-3">
                <div class="bg-white shadow-sm p-3 rounded h-100">
                  <div class="skeleton skeleton-img"></div>
                  <div class="skeleton skeleton-text" style="width: 60%"></div>
                  <div class="skeleton skeleton-text" style="width: 80%"></div>
                  <div class="skeleton skeleton-text" style="width: 40%"></div>
                </div>
              </div>
            `);
          }
          container.insertAdjacentHTML('beforeend', skeletons.join(''));
        }
      
        // hapus skeleton
        function clearSkeleton() {
          container.querySelectorAll('.skeleton').forEach(el => {
            el.closest('.col-6')?.remove();
          });
        }
      
        // fetch data pakai axios
        async function fetchData() {
          if (isLoading) return;
          isLoading = true;
          showSkeleton();
      
          try {
            const res = await axios.get(
              `${API_URL}/pelatihan?start=${start}&length=${length}`,
              {
                headers: {
                  'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                  'Author': 'bearer ' + token,
                  'device': 'web'
                }
              }
            );
      
            clearSkeleton();
      
            const data = res.data.data || []; // sesuaikan struktur respons API
            data.forEach(item => {
              container.insertAdjacentHTML('beforeend', `
                <div class="col-6 col-md-4 col-lg-3">
                  <div class="bg-white shadow training-card h-100">
                    <img 
                    src="${item.attachments && item.attachments.length > 0 && item.attachments[0].path 
                            ? `${API_URL}/${item.attachments[0].path}` 
                            : 'https://via.placeholder.com/300x140'}" 
                    class="card-img-top" 
                    alt="${item.nama}"
                    >

                    <div class="p-3">
                      <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge-topic">${formatWaktu(item.waktu) || '-'}</span>
                      </div>
                      <h5 class="card-title mb-1">${limitText(item.nama, 25)}</h5>
                      <p class="card-text small text-muted desc-clamp">${limitText(item.asosiasi.nama, 35) || ''}</p>
                      <div class="price">${formatRupiah(item.harga) || '0'}</div>
                      <button 
                        class="btn btn-secondary mt-2 w-100 btn-sm" 
                        onclick="goToDetail(${item.id}, '${item.slug}')"
                      >
                        Lihat Pelatihan
                      </button>

                    </div>
                  </div>
                </div>
              `);
            });
      
            start += length;
          } catch (err) {
            console.error('Error fetch API:', err);
          } finally {
            isLoading = false;
          }
        }
      
        // Lazy load pakai IntersectionObserver
        const observer = new IntersectionObserver(entries => {
          if (entries[0].isIntersecting) {
            fetchData();
          }
        });
        observer.observe(sentinel);
      
        // initial load
        fetchData();

        //Detail
        function goToDetail(id, slug) {
          localStorage.setItem("pelatihanId", id); // simpan ID di localStorage
          window.location.href = `/detail-pelatihan/${slug}`; // redirect ke detail
        }

      </script>
@endsection
