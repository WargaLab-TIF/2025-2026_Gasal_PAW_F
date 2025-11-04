<?php
// Konfigurasi database
$host = 'localhost';
$dbname = 'store';
$username = 'root';
$password = '';

// Membuat koneksi
$koneksi = mysqli_connect($host, $username, $password, $dbname);


// Variabel untuk menyimpan error dan nilai input sebelumnya
$errors = [];
$nama = $telp = $alamat = "";

// Mengambil ID dari query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data berdasarkan ID
    $query = "SELECT * FROM supplier WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);
    $supplier = mysqli_fetch_assoc($result);

    if ($supplier) {
        $nama = $supplier['nama'];
        $telp = $supplier['telp'];
        $alamat = $supplier['alamat'];
    } else {
        die("Data tidak ditemukan.");
    }
}

// Proses update data dengan validasi server-side
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    // Validasi nama
    if (empty($nama)) {
        $errors['nama'] = "Nama tidak boleh kosong.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $errors['nama'] = "Nama hanya boleh mengandung huruf dan spasi.";
    }

    // Validasi telp
    if (empty($telp)) {
        $errors['telp'] = "Nomor telepon tidak boleh kosong.";
    } elseif (!preg_match("/^[0-9]+$/", $telp)) {
        $errors['telp'] = "Nomor telepon hanya boleh mengandung angka.";
    }

    // Validasi alamat
    if (empty($alamat)) {
        $errors['alamat'] = "Alamat tidak boleh kosong.";
    } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]+$/", $alamat)) {
        $errors['alamat'] = "Alamat harus alfanumerik dan mengandung minimal 1 huruf dan 1 angka.";
    }

    // Jika tidak ada error, update data ke database
    if (empty($errors)) {
        $query = "UPDATE supplier SET nama = '$nama', telp = '$telp', alamat = '$alamat' WHERE id = '$id'";
        if (mysqli_query($koneksi, $query)) {
            header("Location: index.php"); // Arahkan ke halaman utama
            exit;
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f8f9fa;
        }
        h1 {
            color: #343a40;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        .error {
            color: #dc3545;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .batal {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-left: 10px;
        }
        .batal:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>Edit Data Master Supplier</h1>
    <form method="POST" action="">
        <label>Nama:</label>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($nama); ?>">
        <?php if (isset($errors['nama'])): ?>
            <p class="error"><?php echo $errors['nama']; ?></p>
        <?php endif; ?>

        <label>Telp:</label>
        <input type="text" name="telp" value="<?php echo htmlspecialchars($telp); ?>">
        <?php if (isset($errors['telp'])): ?>
            <p class="error"><?php echo $errors['telp']; ?></p>
        <?php endif; ?>

        <label>Alamat:</label>
        <textarea name="alamat"><?php echo htmlspecialchars($alamat); ?></textarea>
        <?php if (isset($errors['alamat'])): ?>
            <p class="error"><?php echo $errors['alamat']; ?></p>
        <?php endif; ?>

        <button type="submit">Update</button>
        <a href="index.php" class="batal">Batal</a>
    </form>
</body>
</html>
