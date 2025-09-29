@extends('layouts.member')

@section('content')
<main id="main" class="">
    <div class="container" style="margin-top: 150px;">
      <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="/pelatihan">Pelatihan</a></li>
          <li class="breadcrumb-item active" aria-current="page">Detail Pelatihan</li>
        </ol>
      </nav>      
      <div id="detailPelatihan" class="row g-4"></div>
    </div>
</main>
@endsection

@section('css')
    <style>
       .thumb-img {
      cursor: pointer;
      border: 2px solid transparent;
      border-radius: 8px;
    }
    .thumb-img.active {
      box-shadow: 0px 3px 10px rgba(16, 167, 16, 0.534); 
      border: 3px solid rgb(16, 167, 16);
    }
    .main-img {
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .skeleton {
      background: linear-gradient(90deg, #eee, #f5f5f5, #eee);
      background-size: 200% 100%;
      animation: shimmer 1.5s infinite;
      border-radius: 6px;
    }
    @keyframes shimmer {
      0% { background-position: -200% 0; }
      100% { background-position: 200% 0; }
    }
    .skeleton-img {
      width: 100%;
      height: 300px;
    }
    .skeleton-text {
      height: 20px;
      margin-bottom: 10px;
      width: 80%;
    }
    .skeleton-text.short {
      width: 40%;
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

        const id = localStorage.getItem("pelatihanId");
        var token = localStorage.getItem('token');

        function showSkeleton() {
        document.getElementById("detailPelatihan").innerHTML = `
          <div class="col-lg-4">
            <div class="skeleton skeleton-img mb-3"></div>
            <div class="row g-2">
              <div class="col-3"><div class="skeleton" style="height:60px"></div></div>
              <div class="col-3"><div class="skeleton" style="height:60px"></div></div>
              <div class="col-3"><div class="skeleton" style="height:60px"></div></div>
              <div class="col-3"><div class="skeleton" style="height:60px"></div></div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="skeleton skeleton-text"></div>
            <div class="skeleton skeleton-text short"></div>
            <div class="skeleton skeleton-text"></div>
            <div class="skeleton skeleton-text"></div>
            <div class="skeleton skeleton-text" style="width:90%"></div>
          </div>
        `;
      }

      async function fetchDetail() {
        if (!id) {
          document.getElementById("detailPelatihan").innerHTML = "<p class='text-danger'>ID tidak ditemukan</p>";
          return;
        }

        showSkeleton();

        try {
          const res = await axios.get(
            `${API_URL}/pelatihan/${id}`,
            {
              headers: {
                'secret': 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq',
                'Author': 'bearer ' + token,
                'device': 'web'
              }
            }
          );

          const item = res.data.data;
          renderDetail(item);
        } catch (err) {
          console.error("Error fetch detail:", err);
          document.getElementById("detailPelatihan").innerHTML = "<p class='text-danger'>Gagal memuat detail pelatihan</p>";
        }
      }

      function renderDetail(item) {
        // ambil foto utama (is_main true)
        const main = item.attachments.find(a => a.is_main);
        const mainImg = main 
          ? `${API_URL}/${main.path}` 
          : 'https://via.placeholder.com/600x300';

        // buat thumbnail
        const thumbs = item.attachments.map(a => `
          <div class="col-3">
            <img src=`${API_URL}/${a.path}" 
                class="img-fluid thumb-img ${a.is_main ? 'active' : ''}" 
                data-src=`${API_URL}/${a.path}">
          </div>
        `).join("");

        document.getElementById("detailPelatihan").innerHTML = `
          <div class="col-lg-4">
            <img id="mainImage" src="${mainImg}" class="img-fluid main-img mb-3">
            <div class="row g-2">${thumbs}</div>
          </div>
          <div class="col-lg-8">
            <h2 class="fw-bold">${item.nama}</h2>
            <div class="d-flex align-items-center gap-2 mb-2">
              <img src="${item.asosiasi?.logo_path 
                          ? `${API_URL}/${item.asosiasi.logo_path}` 
                          : 'https://static.vecteezy.com/system/resources/previews/016/470/362/non_2x/body-massage-spa-logo-body-relaxing-massage-therapy-logo-green-gradient-free-vector.jpg'}" 
                  alt="Logo ${item.asosiasi?.nama || ''}" 
                  class="rounded" 
                  style="width:30px; height:30px;">
              <h5 class="text-muted mb-0">${item.asosiasi?.nama || ''}</h5>
            </div>
            <div class="mb-4 h2"> Rp ${item.harga.toLocaleString('id-ID')}</div>
            <div class="mb-1"><strong>Waktu:</strong> ${new Date(item.waktu.replace(" ", "T")).toLocaleDateString("id-ID", { day:"numeric", month:"long", year:"numeric" })}</div>
            <div class="mb-1"><strong>Tempat:</strong> ${item.tempat || '-'}</div>
            <p class="text-muted">${item.deskripsi}</p>
            <button class="btn btn-primary">Daftar Sekarang</button>
          </div>
        `;

        // thumbnail click event
        document.querySelectorAll(".thumb-img").forEach(img => {
          img.addEventListener("click", () => {
            document.getElementById("mainImage").src = img.dataset.src;
            document.querySelectorAll(".thumb-img").forEach(t => t.classList.remove("active"));
            img.classList.add("active");
          });
        });
      }

      fetchDetail();
      </script>
@endsection
