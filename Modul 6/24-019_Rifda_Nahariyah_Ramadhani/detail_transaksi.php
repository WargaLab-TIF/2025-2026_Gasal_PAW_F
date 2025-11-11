<?php
include 'koneksi.php';

function updateTotalTransaksi($koneksi, $transaksi_id) {
    $transaksi_id = (int) $transaksi_id; 

    $sql_hitung_total = "SELECT SUM(td.harga) AS total_baru FROM transaksi_detail tdWHERE td.transaksi_id = $transaksi_id";
    
    $result_hitung = $koneksi->query($sql_hitung_total);
    if ($result_hitung === false) { return false; } 

    $row = $result_hitung->fetch_assoc();
    $total_baru = $row['total_baru'] ?? 0;

    $sql_update_total = "UPDATE transaksi SET total = $total_baru WHERE id = $transaksi_id";
    $success = $koneksi->query($sql_update_total);
    return $success;
}


if (isset($_POST['btn_simpan'])) {
    $barang_id = (int)$_POST['barang_id']; 
    $transaksi_id = (int)$_POST['transaksi_id']; 
    $qty = (int)$_POST['qty']; 

    $check_query = "SELECT COUNT(*) AS count FROM transaksi_detail WHERE transaksi_id = $transaksi_id AND barang_id = $barang_id";
    $check_res = $koneksi->query($check_query);
    $check_row = $check_res->fetch_assoc();

    if ($check_row['count'] > 0) {
        echo "<script>alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail.');</script>";
    } else {
    
        $harga_query = "SELECT harga AS harga_satuan FROM barang WHERE id = $barang_id"; 
        $harga_res = $koneksi->query($harga_query);
        
        if ($harga_res && $harga_row = $harga_res->fetch_assoc()) {
            $harga_satuan = $harga_row['harga_satuan'];
            $harga_detail = $harga_satuan * $qty; 

            $sql_insert = "
                INSERT INTO transaksi_detail (barang_id, transaksi_id, qty, harga) 
                VALUES ($barang_id, $transaksi_id, $qty, $harga_detail)
            ";
            
            if ($koneksi->query($sql_insert)) {
                
                if (updateTotalTransaksi($koneksi, $transaksi_id)) {
                    header('Location: index.php'); 
                    exit();
                } else {
                    echo "<script>alert('Detail transaksi berhasil ditambahkan.');</script>";
                }
            } else {
                echo "<script>alert('Gagal menambahkan data: " . $koneksi->error . "');</script>";
            }
        } else {
             echo "<script>alert('Gagal mengambil harga barang. Pastikan ID Barang valid.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Detail Transaksi</title>
</head>
<body style="font-family: Arial; background-color: white; margin: 0; padding: 0;">
    
<div style="
width: 420px;
background: #fff;
padding: 20px;
border-radius: 12px;
box-shadow: 0 0 10px rgba(0,0,0,0.1);
margin: 50px auto;
">

<div class="form-container">
    <h2 style="text-align: center; color: black;">Tambah Detail Transaksi</h2>

    <form method="POST" action="">

        <div>
            <label for="barang_id"><b>Pilih Barang</b></label>
            <select name="barang_id" id="barang_id" 
            style="width: 100%; padding: 10px; padding:8px; border:1px solid black; border-radius:6px; margin-bottom:15px; margin-top: 5px;" required>
                <option value="">-- Pilih Barang --</option>
                <?php
                $barang_res = mysqli_query($koneksi, "SELECT id, nama_barang, harga FROM barang"); 
                while ($b = mysqli_fetch_assoc($barang_res)) {
                    echo "<option value='{$b['id']}'>{$b['nama_barang']} (Rp " . number_format($b['harga'], 0, ',', '.') . ")</option>";
                }
                ?>
            </select>
        </div>

        <div>
            <label for="transaksi_id" style="margin-bottom:5px;"><b>Pilih ID Transaksi</b></label>
            <select name="transaksi_id" id="transaksi_id" 
            style="width: 100%; padding: 10px; padding:8px; border:1px solid black; border-radius:6px; margin-bottom:15px; margin-top: 5px;" required>
                <option value="">-- Pilih ID Transaksi --</option>
                <?php
                $transaksi_res = mysqli_query($koneksi, "SELECT id, keterangan FROM transaksi ORDER BY id DESC");
                while ($t = mysqli_fetch_assoc($transaksi_res)) {
                    echo "<option value='{$t['id']}'>ID {$t['id']} - {$t['keterangan']}</option>";
                }
                ?>
            </select>
        </div>

        <div>
            <label for="qty" style="margin-bottom:5px;"><b>Quantity</b></label>
            <input type="number" name="qty" id="qty" min="1" placeholder="Masukkan jumlah barang" 
            style="width: 100%; padding: 10px; padding:8px; box-sizing: border-box; border:1px solid black; border-radius:6px; margin-bottom:15px; margin-top: 5px;" required>
        </div>
        
        <button type="submit" name="btn_simpan"
            style="background-color:blue; color:white; border:none; padding:10px; border-radius:6px; cursor:pointer; 
            width: 100%; font-size: 16px; margin-top: 10px;">
            <b>Tambah Detail Transaksi</b>
        </button>
    </form>
    
    <a href="index.php" 
    style="display: block; text-align: center; margin-top: 20px; color: blue; text-decoration: none;">
        Kembali ke Halaman Utama
    </a>
</div>

</body>
</html>
<?php
$koneksi->close();
?>