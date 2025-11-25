<?php
include '../koneksi.php'; // Naik satu level untuk ambil koneksi

$id_transaksi = $_GET['id'];

// Ambil Info Master Transaksi untuk Header
$master = mysqli_query($koneksi, "SELECT t.*, p.nama_pelanggan 
                                  FROM transaksi t 
                                  JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan 
                                  WHERE id_transaksi='$id_transaksi'");
$row_master = mysqli_fetch_assoc($master);

// --- PROSES TAMBAH BARANG KE KERANJANG ---
if(isset($_POST['tambah_item'])){
    $id_barang = $_POST['id_barang'];
    $qty       = $_POST['qty'];

    // 1. Cek apakah barang sudah ada di transaksi ini?
    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE id_transaksi='$id_transaksi' AND id_barang='$id_barang'");
    
    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Barang ini sudah ada di list! Tidak boleh dobel.');</script>";
    } else {
        // 2. Ambil Harga Barang dari Tabel Barang
        $q_brg = mysqli_query($koneksi, "SELECT harga FROM barang WHERE id_barang='$id_barang'");
        $d_brg = mysqli_fetch_assoc($q_brg);
        $harga_satuan = $d_brg['harga'];

        // 3. Hitung Subtotal (Harga x Qty)
        $subtotal_item = $harga_satuan * $qty; // Ini yang masuk kolom 'harga' di transaksi_detail

        // 4. Insert ke Detail
        // Perhatikan nama kolom: id_transaksi, id_barang, harga, qty
        $insert = mysqli_query($koneksi, "INSERT INTO transaksi_detail (id_transaksi, id_barang, harga, qty) 
                                          VALUES ('$id_transaksi', '$id_barang', '$subtotal_item', '$qty')");
        
        if($insert){
            // 5. UPDATE TOTAL MASTER OTOMATIS
            $q_total = mysqli_query($koneksi, "SELECT SUM(harga) as total_akhir FROM transaksi_detail WHERE id_transaksi='$id_transaksi'");
            $d_total = mysqli_fetch_assoc($q_total);
            $total_fix = $d_total['total_akhir'];

            // Update tabel transaksi kolom total
            mysqli_query($koneksi, "UPDATE transaksi SET total='$total_fix' WHERE id_transaksi='$id_transaksi'");
            
            // Refresh halaman
            echo "<script>window.location='detail.php?id=$id_transaksi';</script>";
        } else {
            echo "Gagal Insert: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
    <style>
        /* ====== RESET ====== */
body {
    font-family: Arial, sans-serif;
    background: #f4f4f9;
    margin: 0;
    color: #333;
}

/* ====== CONTAINER ====== */
.container {
    max-width: 1100px;
    margin: 35px auto;
    padding: 0 20px;
}

/* ====== GRID FLEX ====== */
.row {
    display: flex;
    gap: 20px;
}

.col-md-4 {
    width: 32%;
}

.col-md-8 {
    width: 66%;
}

/* ====== CARD ====== */
.card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,60,0.06);
    overflow: hidden;
}

.card-header {
    background: #2a2a72;
    padding: 15px 20px;
    color: #fff;
    font-weight: bold;
}

.card-header.bg-warning {
    background: #ffb527;
    color: #333;
}

.card-body {
    padding: 20px;
}

/* ====== ALERT ====== */
.alert {
    padding: 12px 18px;
    background: #e8f2ff;
    border-left: 4px solid #2a2a72;
    border-radius: 6px;
    margin-bottom: 20px;
    font-size: 15px;
}

/* ====== FORM ====== */
.form-group {
    margin-bottom: 14px;
}

label {
    font-size: 14px;
    font-weight: bold;
    color: #333;
}

.form-control {
    width: 100%;
    padding: 9px 10px;
    font-size: 14px;
    border-radius: 6px;
    border: 1px solid #bbb;
    margin-top: 5px;
    box-sizing: border-box;
}

.form-control:focus {
    border-color: #6f3cff;
    outline: none;
}

/* ====== BUTTONS ====== */
.btn {
    padding: 10px 14px;
    border-radius: 6px;
    text-decoration: none;
    display: inline-block;
    font-size: 15px;
    transition: 0.2s ease;
    cursor: pointer;
    text-align: center;
    color: #fff;
    border: none;
}

.btn-block {
    width: 100%;
}

.btn-primary {
    background: #6f3cff;
}
.btn-primary:hover {
    background: #542dcc;
}

.btn-success {
    background: #1e9e52;
}
.btn-success:hover {
    background: #167d41;
}

/* ====== TABLE ====== */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    font-size: 14px;
}

.table thead tr {
    background: #2a2a72;
    color: #fff;
}

.table th,
.table td {
    padding: 12px 15px;
    border-bottom: 1px solid #e5e5e5;
}

.table tbody tr:nth-child(even) {
    background: #faf9ff;
}

.table tbody tr:hover {
    background: #f1ecff;
}

/* ====== TOTAL AKHIR ====== */
.font-weight-bold td {
    font-weight: bold;
    background: #eceaff;
}

/* ====== RESPONSIVE ====== */
@media (max-width: 768px) {
    .row {
        flex-direction: column;
    }
    .col-md-4, .col-md-8 {
        width: 100%;
    }
    .table th, .table td {
        font-size: 13px;
        padding: 9px;
    }
}

    </style>
   
<body>
<div class="container mt-5">
    
    <div class="alert alert-info">
        <strong>No. Transaksi: #<?= $row_master['id_transaksi']; ?></strong> | 
        Pelanggan: <?= $row_master['nama_pelanggan']; ?> | 
        Tanggal: <?= $row_master['waktu_transaksi']; ?>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-warning">Pilih Barang</div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <select name="id_barang" class="form-control" required>
                                <option value="">- Pilih Barang -</option>
                                <?php
                                $brg = mysqli_query($koneksi, "SELECT * FROM barang");
                                while($b = mysqli_fetch_array($brg)){
                                    echo "<option value='".$b['id_barang']."'>".$b['nama_barang']." (Rp ".number_format($b['harga']).")</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Qty (Jumlah)</label>
                            <input type="number" name="qty" class="form-control" min="1" value="1" required>
                        </div>
                        <button type="submit" name="tambah_item" class="btn btn-primary btn-block">Tambah</button>
                    </form>
                </div>
            </div>
            <br>
            <a href="../home.php?page=transaksi" class="btn btn-success btn-block py-3">SELESAI & SIMPAN</a>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Keranjang Belanja</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Qty</th>
                                <th>Subtotal (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $grand_total = 0;
                            $list = mysqli_query($koneksi, "SELECT td.*, b.nama_barang 
                                                            FROM transaksi_detail td 
                                                            JOIN barang b ON td.id_barang = b.id_barang 
                                                            WHERE td.id_transaksi='$id_transaksi'");
                            
                            while($item = mysqli_fetch_array($list)){
                                $grand_total += $item['harga'];
                            ?>
                            <tr>
                                <td><?= $item['nama_barang']; ?></td>
                                <td><?= $item['qty']; ?></td>
                                <td align="right"><?= number_format($item['harga']); ?></td>
                            </tr>
                            <?php } ?>
                            
                            <tr class="font-weight-bold">
                                <td colspan="2" align="right">TOTAL AKHIR</td>
                                <td align="right">Rp <?= number_format($grand_total); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>