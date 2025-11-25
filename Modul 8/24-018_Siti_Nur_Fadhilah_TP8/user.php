<?php 
    session_start();
    require 'database/conn.php';
    // require 'validate.php'; // Membutuhkan file validate.php untuk fungsi sanitasi

    // 1. Proteksi Halaman: Jika belum login, arahkan ke login.php 
    if (!isset($_SESSION['login'])) {
        header('Location: login.php');
        exit;
    } 
    // 2. Proteksi Halaman: Hanya user Level 2 yang boleh mengakses 
    else if ($_SESSION['role'] != 2){
        header('Location: index.php');
        exit;
    }

    $id_user = $_SESSION['id_user'];
    $pesan_sukses = "";
    $pesan_error = "";

    // --- Logika Update Data ---
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Ambil dan sanitasi data dari form
        $nama_baru = sanitize($_POST['nama']);
        $hp_baru = sanitize($_POST['nohp']);
        $alamat_baru = sanitize($_POST['alamat']);

        // Validasi data (gunakan fungsi dari validate.php)
        $err = [];
        $err['nama'] = validate_nama($nama_baru);
        $err['hp'] = validate_hp($hp_baru);
        $err['alamat'] = validate_alamat($alamat_baru);
        
        // Hapus error yang kosong
        $err = array_filter($err);

        if (empty($err)) {
            // Jika tidak ada error, lakukan update
            $query_update = "UPDATE user SET nama = ?, hp = ?, alamat = ? WHERE id_user = ?";
            $stmt_update = mysqli_prepare($koneksi, $query_update);
            mysqli_stmt_bind_param($stmt_update, "sssi", $nama_baru, $hp_baru, $alamat_baru, $id_user);

            if (mysqli_stmt_execute($stmt_update)) {
                // Update berhasil
                $pesan_sukses = "Data profil berhasil diperbarui!";
                // Update session nama user agar langsung terlihat
                $_SESSION['nama_user'] = $nama_baru; 
            } else {
                $pesan_error = "Gagal memperbarui data: " . mysqli_error($koneksi);
            }
        } else {
            // Jika ada error, tampilkan pesan error
            $pesan_error = "Gagal memperbarui data. Cek kembali isian Anda.";
        }
    }


    // --- Ambil data user yang sedang login (dilakukan setelah update agar data form terbaru) ---
    $query = "SELECT id_user, username, nama, alamat, hp FROM user WHERE id_user = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data_user = mysqli_fetch_assoc($result);
    
    // Fallback jika data tidak ditemukan (seharusnya tidak terjadi)
    if (!$data_user) {
        header('Location: logout.php');
        exit;
    }
    

?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile User</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>

        body {
            font-family: 'Poppins', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            background: radial-gradient(circle at top, #e5e7eb, #f9fafb);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            flex-direction: column;
        }

        .header {
            width: 100%;
            background-color: #3498db;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: absolute;
            top: 0;
            left: 0;
        }

        .header h1 {
            font-size: 20px;
        }

        .user-info {
            font-size: 14px;
        }

        .nav-bar {
            width: 100%;
            background-color: #2c3e50;
            padding: 10px 20px;
            position: absolute;
            top: 50px;
            left: 0;
        }

        .nav-bar ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .nav-bar ul li a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            display: block;
            transition: background 0.3s;
        }

        .nav-bar ul li a:hover {
            background-color: #34495e;
        }

        .logout-link {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }

        .card {
            width: 100%;
            max-width: 480px;
            background: var(--card);
            border-radius: 5px;
            overflow: hidden;
            margin-top: 100px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        /* ... Sisa CSS (dihilangkan untuk meringkas kode di sini, tetapi ada di file Anda) ... */
        .card-header {
            height: 130px;
            background: linear-gradient(135deg, var(--primary), var(--primary2));
            position: relative;
        }

        .avatar-wrapper {
            position: absolute;
            left: 50%;
            bottom: -45px;
            transform: translateX(-50%);
            text-align: center;
        }

        .avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 4px solid #ffffff;
            overflow: hidden;
            background: #e5e7eb;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-body {
            padding: 70px 26px 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            font-size: 11px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 4px;
            display: block;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 9px 11px;
            border-radius: 3px;
            border: 1px solid var(--border);
            font-size: 13px;
            outline: none;
            transition: 0.2s;
            font-family: inherit;
        }
        
        .btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 9px 16px;
            border-radius: 3px;
            border: none;
            font-size: 13px;
            cursor: pointer;
            font-weight: 500;
            font-family: inherit;
        }

        .btn-secondary {
            background: var(--btn-secondary);
            color: #374151;
        }

        .btn-primary {
            background: var(--btn-primary);
            color: #ffffff;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            border: 1px solid #f5c6cb;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 3px;
        }

    </style>
</head>
<body>
    <div class="header">
        <h1>Sistem Penjualan</h1>
        <div class="user-info">
            Selamat Datang, <?= htmlspecialchars($_SESSION['nama_user']); ?> (Kasir)
            <button>
            <a href="logout.php" onclick="return confirm('apakah anda yakin ingin logout??')" 
            style="text-decoration: none; color: #e74c3c; font-weight: bold;">Logout</a>
            </button>
        </div>
    </div>

    <div class="nav-bar">
        <ul>
            <li><a href="user.php" style="background-color: #34495e;">Home </a></li>
            <li><a href="transaksi.php">Transaksi</a></li>
            <li><a href="laporan.php">Laporan</a></li> 
        </ul>
    </div>


</body>
</html>