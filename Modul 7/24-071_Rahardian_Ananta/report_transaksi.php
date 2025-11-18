

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Laporan</title>
    <style>
        /* Mengatur dasar halaman */
        body {
            font-family: Arial, sans-serif;
            margin: 0; 
            background-color: #f9f9f9; /* Warna abu-abu muda */
            padding: 20px; /* Kasih jarak dari pinggir browser */
        }

        /* [1] KOTAK PUTIH UTAMA */
        .container-laporan {
            background-color: #ffffff; /* Putih */
            border: 1px solid #e0e0e0; /* Garis abu-abu tipis */
            border-radius: 5px;
            
            /* Trik agar header birunya menyatu di pojok atas */
            overflow: hidden; 
        }

        /* [2] Header Biru (DI DALAM KOTAK) */
        .header-biru {
            background-color: #0d6efd; /* Warna biru */
            color: white;
            padding: 16px 20px;
            font-size: 18px;
            font-weight: bold;
        }

        /* [3] Area Konten di bawah header biru */
        .konten-filter {
            padding: 20px; /* Jarak di dalam area putih */
        }

        /* [4] Tombol "Kembali" (DI ATAS) */
        .tombol-kembali {
            background-color: #0d6efd; /* Biru */
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none; /* Hilangkan garis bawah link */
            font-size: 14px;
            
            /* Penting: Kasih jarak bawah ke form filter */
            display: inline-block; /* Biar ukurannya pas */
            margin-bottom: 20px; 
        }

        /* [5] Form yang isinya sebaris */
        .form-filter-inline {
            /* Trik agar input dan tombol sejajar */
            display: flex; 
            align-items: center; /* Sejajar vertikal */
            gap: 15px; /* Jarak antar elemen */
        }

        /* [6] Input Tanggal */
        .input-tanggal {
            border: 1px solid #ccc;
            padding: 7px 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        /* [7] Tombol "Tampilkan" */
        .tombol-tampilkan {
            background-color: #198754; /* Hijau */
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            border: none; /* Tombol tidak perlu border */
            cursor: pointer; /* Bentuk kursor jadi tangan */
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container-laporan">
        
        <div class="header-biru">Rekap Laporan Penjualan</div>
        
        <div class="konten-filter">
            
            <a href="index.php" class="tombol-kembali"> < Kembali </a>
            
            <form action="menampilkan_report.php" method="POST" class="form-filter-inline">
                
                <input type="date" name="awal" class="input-tanggal">
                <input type="date" name="akhir" class="input-tanggal">
                <button type="submit" class="tombol-tampilkan"> Tampilkan</button>
                
            </form>
        </div>
    </div>
    
    </body>
</html>