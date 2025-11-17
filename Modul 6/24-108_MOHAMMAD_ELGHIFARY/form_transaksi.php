<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "penjualan_tp6";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
function validate_date($key_name){
    $tanggal_input = $_POST[$key_name] ?? '';
    if (empty($tanggal_input)) {
        return ['kondisi' => false, 'eror' => 'Tanggal transaksi tidak boleh kosong.'];
    }
    $tanggal_hari_ini = date("Y-m-d");
    $hari_input = strtotime($tanggal_input) / 86400;
    $hari_ini = strtotime($tanggal_hari_ini) / 86400;
    if ($hari_input < $hari_ini) {
        $pesan_error = "Gagal! Tanggal transaksi tidak boleh kurang dari hari ini ({$tanggal_hari_ini}).";
        return ['kondisi' => false, 'eror' => $pesan_error];
    }
    return ['kondisi' => true];
}
function validate_keterangan($post_array, $key_name) {
    $keterangan_input = $post_array[$key_name] ?? '';
    $keterangan_bersih = trim($keterangan_input);
    if (strlen($keterangan_bersih) < 3) {
        return ['kondisi' => false, 'eror' => 'Keterangan transaksi harus memiliki minimal 3 karakter.'];
    }
    return ['kondisi' => true];
}
$waktu_transaksi = '';
$keterangan = '';
$total = 0;
$pelanggan_id = '';
$errors = [];
$pesan_sukses = '';

if (isset($_POST['submit'])) {
    $waktu_transaksi = $_POST['waktu_transaksi'] ?? '';
    $keterangan = $_POST['keterangan'] ?? '';
    $total = $_POST['total'] ?? 0;
    $pelanggan_id = $_POST['pelanggan_id'] ?? '';

    $sukses = true;
    $validasi_tgl = validate_date('waktu_transaksi');
    if (!$validasi_tgl['kondisi']) {
        $errors['waktu_transaksi'] = $validasi_tgl['eror'];
        $sukses = false;
    }
    $validasi_ket = validate_keterangan($_POST, 'keterangan');
    if (!$validasi_ket['kondisi']) {
        $errors['keterangan'] = $validasi_ket['eror'];
        $sukses = false;
    }
    if (empty($pelanggan_id)) {
        $errors['pelanggan_id'] = "Pelanggan harus dipilih.";
        $sukses = false;
    }
    if ($sukses) {
        $stmt = mysqli_prepare($conn, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssii", $waktu_transaksi, $keterangan, $total, $pelanggan_id);

        if (mysqli_stmt_execute($stmt)) {
            session_start();
            $_SESSION['pesan_sukses'] = "Data transaksi baru berhasil disimpan.";
            
            header("Location: index.php");
            exit();
        } else {
            $errors['database'] = "Gagal menambahkan data: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } 
}
$sql_pelanggan = "SELECT id, nama FROM pelanggan ORDER BY nama ASC";
$query_pelanggan = mysqli_query($conn, $sql_pelanggan);
$result_pelanggan = mysqli_fetch_all($query_pelanggan, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Transaksi</title>
    
    <style>
        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 450px;
        }

        .form-card h2 {
            text-align: center;
            color: #333;
            margin-top: 0;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
        }

        /* Style untuk SEMUA input, select, dan textarea */
        .form-group input[type="date"],
        .form-group input[type="number"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-group textarea {
            min-height: 80px; /* Tinggi minimal untuk textarea */
            resize: vertical;
        }
        
        .form-button {
            width: 100%;
            padding: 12px 15px;
            border: none;
            border-radius: 5px;
            background-color: #007bff; /* Biru */
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .form-button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.9em;
            margin-top: 5px;
        }
        
        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
    </head>
<body>

    <div class="form-card">
        <h2>Tambah Data Transaksi</h2>

        <?php if (isset($errors['database'])) echo '<div class="alert-error">' . htmlspecialchars($errors['database']) . '</div>'; ?>

        <form method="POST" action="">
            
            <div class="form-group">
                <label for="waktu_transaksi">Waktu Transaksi:</label>
                <input type="date" id="waktu_transaksi" name="waktu_transaksi" value="<?php echo htmlspecialchars($waktu_transaksi); ?>" >
                <?php if (isset($errors['waktu_transaksi'])) echo '<div class="error-message">' . htmlspecialchars($errors['waktu_transaksi']) . '</div>'; ?>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea id="keterangan" name="keterangan" rows="4" placeholder="Masukkan keterangan transaksi"><?php echo htmlspecialchars($keterangan); ?></textarea>
                <?php if (isset($errors['keterangan'])) echo '<div class="error-message">' . htmlspecialchars($errors['keterangan']) . '</div>'; ?>
            </div>

            <div class="form-group">
                <label for="total">Total:</label>
                <input type="number" id="total" name="total" value="<?php echo htmlspecialchars($total); ?>" >
                </div>

            <div class="form-group">
                <label for="pelanggan_id">Pelanggan:</label>
                <select id="pelanggan_id" name="pelanggan_id" >
                    <option value="">Pilih Pelanggan</option>
                    <?php
                    if (count($result_pelanggan) > 0) {
                        foreach ($result_pelanggan as $row) {
                            $selected = ($row['id'] == $pelanggan_id) ? 'selected' : '';
                            echo "<option value='" . $row["id"] . "' $selected>". htmlspecialchars($row["nama"])."</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada pelanggan</option>";
                    }
                    ?>
                </select>
                <?php if (isset($errors['pelanggan_id'])) echo '<div class="error-message">' . htmlspecialchars($errors['pelanggan_id']) . '</div>'; ?>
            </div>

            <button type="submit" name="submit" class="form-button">Tambah Transaksi</button>
        </form>
    </div>
    </body>
</html>
<?php
$conn->close();
?>