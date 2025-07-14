<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link href="{{ asset('images/logo-qiwari.png') }}" rel="icon">
    <link href="{{ asset('images/logo-qiwari.png') }}" rel="apple-touch-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <title>Katalog Qiwari</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        header img {
            height: 50px;
        }

        header h1 {
            font-size: 1.5em;
            text-align: center;
            flex-grow: 1;
            margin: 0;
        }

        .promo-header {
            background-color: red;
            color: white;
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
        }

        .promo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
        }

        .promo-item {
            background-color: #f9f9f9;
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .promo-item img {
            max-width: 100%;
            height: auto;
        }

        .promo-item .description {
            font-size: 1em;
            margin: 10px 0;
        }

        .promo-item .price {
            font-size: 1.2em;
            color: red;
            font-weight: bold;
        }

        /* CSS for print */
        @media print {
            body * {
                visibility: hidden;
            }

            .print-area,
            .print-area * {
                visibility: visible;
            }

            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container print-area">
        <header>
            <img src="{{ asset('images/logo-qiwari.png') }}" alt="Qiwari Logo">
            <h1>PASTI HEMAT EDISI 4 PERIODE: {{ date('d F Y') }}</h1>

        </header>
        <section class="promo-section ">
            {{-- <center>
                <img src="{{ asset('images/logo-qiwari.png') }}" alt="" width="200px">
            </center> --}}
            <div class="promo-grid">
                @foreach ($data as $item)
                    <div class="promo-item">
                        @if (isset($item['photo'][0]['path']))
                            <img src="{{ $item['photo'][0]['path'] }}" alt="{{ $item['nama'] }}">
                        @else
                            <img src="https://removal.ai/wp-content/uploads/2021/02/no-img.png"
                                alt="{{ $item['nama'] }}">
                        @endif
                        <p class="description">{{ $item['nama'] }}</p>
                        <p class="price">{{ 'Rp' . number_format($item['harga'], 0, ',', '.') }}</p>
                    </div>
                @endforeach
                <!-- Tambahkan lebih banyak item sesuai kebutuhan -->
            </div>
        </section>
    </div>
    <center>
        <a class="btn btn-secondary" href="/">Kembali</a>
        <button class="btn btn-primary" onclick="window.print()">Print</button>
    </center>
    <br>
    <br>
</body>

</html>
