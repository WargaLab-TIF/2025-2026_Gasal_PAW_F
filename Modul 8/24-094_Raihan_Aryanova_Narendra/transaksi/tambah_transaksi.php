<?php
include '../cek_session.php'; 
include '../koneksi.php'; 

// --- PROSES SIMPAN DATA MASTER ---
if (isset($_POST['simpan_master'])) {
    $waktu_transaksi = $_POST['waktu_transaksi']; // Nama input harus sama
    $id_pelanggan    = $_POST['id_pelanggan'];
    $keterangan      = $_POST['keterangan'];
    $total           = 0;

    // Validasi sederhana
    if(empty($waktu_transaksi) || empty($id_pelanggan)) {
        echo "<script>alert('Data tidak boleh kosong!');</script>";
    } else {
        // Query Insert
        $query = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, id_pelanggan) 
                  VALUES ('$waktu_transaksi', '$keterangan', '$total', '$id_pelanggan')";
        
        if (mysqli_query($koneksi, $query)) {
            $id_baru = mysqli_insert_id($koneksi); // Ambil ID transaksi barusan
            echo "<script>alert('Data Master Berhasil Disimpan!'); window.location='detail.php?id=$id_baru';</script>";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5>Langkah 1: Input Master Transaksi</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                
                <div class="form-group">
                    <label>Waktu Transaksi</label>
                    <input type="date" name="waktu_transaksi" class="form-control" 
                           min="<?= date('Y-m-d'); ?>" required>
                </div>

                <div class="form-group">
                    <label>Pelanggan</label>
                    <select name="id_pelanggan" class="form-control" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php
                        $plg = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                        while($p = mysqli_fetch_array($plg)){
                            echo "<option value='".$p['id_pelanggan']."'>".$p['nama_pelanggan']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" minlength="3" rows="3" required placeholder="Keterangan transaksi..."></textarea>
                </div>

                <a href="../home.php?page=transaksi" class="btn btn-secondary">Kembali</a>
                <button type="submit" name="simpan_master" class="btn btn-success float-right">Lanjut ke Detail &rarr;</button>

            </form>
        </div>
    </div>
</div>
</body>
</html>