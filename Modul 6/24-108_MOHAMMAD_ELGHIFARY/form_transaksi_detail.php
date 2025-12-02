<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "penjualan_tp6";
$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
$transaksi_id = '';
$barang_id = '';
$qty = '';
$errors = [];
$pesan_sukses = '';
if (isset($_POST['submit'])) {
    $transaksi_id = (int)($_POST['transaksi_id'] ?? 0);
    $barang_id = (int)($_POST['barang_id'] ?? 0);
    $qty = (int)($_POST['qty'] ?? 1);

    $sukses = true;
    if (empty($transaksi_id)) {
        $errors['transaksi_id'] = "Transaksi harus dipilih.";
        $sukses = false;
    }
    if (empty($barang_id)) {
        $errors['barang_id'] = "Barang harus dipilih.";
        $sukses = false;
    }
    if (empty($qty)) {
        $errors['qty'] = "Quantity (Qty) harus diisi.";
        $sukses = false;
    }
    if ($sukses) {
        $sql_check = "SELECT 1 FROM transaksi_detail WHERE transaksi_id = $transaksi_id AND barang_id = $barang_id";
        $query_check = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($query_check) > 0) {
            $errors['barang_id'] = "Gagal! Barang ini sudah ada di dalam transaksi tersebut.";
            $sukses = false;
        }
    }
    $harga_satuan = 0;
    if ($sukses) { 
        $sql_harga = "SELECT harga FROM barang WHERE id = $barang_id";
        $query_harga = mysqli_query($conn, $sql_harga);
        
        if ($row_harga = mysqli_fetch_assoc($query_harga)) {
            $harga_satuan = $row_harga['harga']; 
        } else {
            $errors['barang_id'] = "Gagal mengambil data harga barang.";
            $sukses = false;
        }
    }
    if ($sukses) {      
        mysqli_begin_transaction($conn);
        try {
            $sql_insert_detail = "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga) VALUES ($transaksi_id, $barang_id, $qty, $harga_satuan)";
            $result_insert = mysqli_query($conn, $sql_insert_detail);
            $sql_update_total = "
                UPDATE transaksi t
                SET t.total = (
                    SELECT SUM(td.harga * td.qty) 
                    FROM transaksi_detail td 
                    WHERE td.transaksi_id = $transaksi_id
                )
                WHERE t.id = $transaksi_id
            ";
            $result_update = mysqli_query($conn, $sql_update_total);
            if ($result_insert && $result_update) {
                mysqli_commit($conn);
                session_start();
                $_SESSION['pesan_sukses'] = "Berhasil! Barang ditambahkan. Total Transaksi telah di-update.";
                
                header("location: index.php");
                exit();
            } else {
                mysqli_rollback($conn);
                $errors['database'] = "Gagal (Rollback): " . mysqli_error($conn);
            }

        } catch (Exception $e) {
            mysqli_rollback($conn);
            $errors['database'] = "Error Transaksi: " . $e->getMessage();
        }
    } 
}

$sql_transaksi = "SELECT id FROM transaksi ORDER BY waktu_transaksi DESC";
$query_transaksi = mysqli_query($conn, $sql_transaksi);
$list_transaksi = mysqli_fetch_all($query_transaksi, MYSQLI_ASSOC);

$sql_barang = "SELECT id, nama_barang FROM barang ORDER BY nama_barang ASC";
$query_barang = mysqli_query($conn, $sql_barang);
$list_barang = mysqli_fetch_all($query_barang, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Transaksi</title>
    
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
        .form-group select,
        .form-group input[type="number"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .form-group select {
            color: #333;
        }
        .form-group select:invalid {
            color: #777;
        }
        option[value=""] {
            color: #999;
        }

        .form-button {
            width: 100%;
            padding: 12px 15px;
            border: none;
            border-radius: 5px;
            background-color: #007bff; 
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
        <h2>Tambah Detail Transaksi</h2>
        
        <?php if (isset($errors['database'])) echo '<div class="alert-error">' . htmlspecialchars($errors['database']) . '</div>'; ?>

        <form method="POST" action="">
            
            <div class="form-group">
                <label for="barang_id">Pilih Barang:</label>
                <select id="barang_id" name="barang_id" > <option value="">-- Pilih Barang --</option>
                    <?php
                    foreach ($list_barang as $row) {
                        $selected = ($row['id'] == $barang_id) ? 'selected' : '';
                        echo "<option value='" . $row["id"] . "' $selected>". htmlspecialchars($row["nama_barang"]). "</option>";
                    }
                    ?>
                </select>
                <?php if (isset($errors['barang_id'])) echo '<div class="error-message">' . htmlspecialchars($errors['barang_id']) . '</div>'; ?>
            </div>

            <div class="form-group">
                <label for="transaksi_id">ID Transaksi:</label>
                <select id="transaksi_id" name="transaksi_id" >
                    <option value="">Pilih ID Transaksi</option>
                    <?php
                    foreach ($list_transaksi as $trx) {
                        $selected = ($trx['id'] == $transaksi_id) ? 'selected' : ''; 
                        echo "<option value='" . $trx["id"] . "' $selected>". htmlspecialchars($trx["id"])."</option>";
                    }
                    ?>
                </select>
                <?php if (isset($errors['transaksi_id'])) echo '<div class="error-message">' . htmlspecialchars($errors['transaksi_id']) . '</div>'; ?>
            </div>

            <div class="form-group">
                <label for="qty">Jumlah (Qty):</label>
                <input type="number" id="qty" name="qty" value="<?php echo htmlspecialchars($qty); ?>" >
                <?php if (isset($errors['qty'])) echo '<div class="error-message">' . htmlspecialchars($errors['qty']) . '</div>'; ?>
            </div>
            
            <button type="submit" name="submit" class="form-button">Tambah Barang</button>
        </form>
    </div>

</body>
</html>
<?php
$conn->close();
?>