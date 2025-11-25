<?php 
include 'koneksi.php'; 
if($_SESSION['level'] != 1) {
    echo "<script>alert('Anda tidak memiliki akses!'); window.location='home.php';</script>";
    exit(); 
}

if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id_barang = mysqli_real_escape_string($koneksi, $_GET['id']);

    // 1. Cek dulu di tabel transaksi_detail (Sesuai Modul 6)
    $cek_transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE id_barang='$id_barang'");
    
    if(mysqli_num_rows($cek_transaksi) > 0) {
        // Jika ada, TAMPILKAN ALERT sesuai instruksi PDF
        echo "<script>alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail'); window.location='home.php?page=barang';</script>";
    } else {
        // Jika tidak ada, baru boleh hapus
        $hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id_barang'");
        if($hapus) {
            echo "<script>window.location='home.php?page=barang&pesan=berhasil_hapus';</script>";
        } else {
            echo "<script>window.location='home.php?page=barang&pesan=gagal_hapus';</script>";
        }
    }
}
?>
<style>
/* ====== WRAPPER ====== */
.card-content {
    background-color: white;
    border-radius: 12px;
    padding: 25px;
    max-width: 1000px;
    margin: 0 auto;
    box-shadow: 0 4px 12px rgba(0,0,60,0.06);
}

/* ====== HEADER ====== */
.card-content h2 {
    color: #2a2a72; /* Biru tua */
    margin: 0 0 10px 0;
    padding-bottom: 10px;
    border-bottom: 2px solid #efefef;
    font-weight: 600;
}

.header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

/* ====== ALERT ====== */
.alert {
    padding: 10px 15px;
    margin-bottom: 18px;
    border-radius: 6px;
    font-size: 14px;
}

.alert-success {
    background: #e9f9ef;
    color: #1f7a2e;
    border: 1px solid #c8e9d1;
}

.alert-danger {
    background: #fde8e8;
    color: #b31c1c;
    border: 1px solid #f2c2c2;
}

/* ====== BUTTONS ====== */
.btn {
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    transition: 0.2s;
    cursor: pointer;
    color: #fff;
    border: none;
}

.btn-primary {
    background: #6f3cff; /* Ungu */
}
.btn-primary:hover {
    background: #542dcc;
}

.btn-warning {
    background: #ffb527;
    color: #333;
}
.btn-warning:hover {
    background: #e09d1d;
}

.btn-danger {
    background: #e63946;
}
.btn-danger:hover {
    background: #c62828;
}

/* ====== TABLE ====== */
.content-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    font-size: 14px;
}

.content-table thead tr {
    background-color: #2a2a72; /* Biru tua */
    color: white;
}

.content-table th,
.content-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #e5e5e5;
}

.content-table tbody tr:nth-child(even) {
    background-color: #faf9ff; /* Ungu muda */
}

.content-table tbody tr:hover {
    background-color: #f1ecff; /* Hover ungu lembut */
}

</style>
<div class="container-fluid">
    <h2 style="margin-top: 0;">Data Master Barang</h2>
    <hr>
    
    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "berhasil_tambah") echo "<div class='alert alert-success' style='padding:10px; background:#d4edda; margin-bottom:10px;'>Data berhasil ditambahkan!</div>";
        elseif($_GET['pesan'] == "berhasil_edit") echo "<div class='alert alert-success' style='padding:10px; background:#d4edda; margin-bottom:10px;'>Data berhasil diubah!</div>";
        elseif($_GET['pesan'] == "berhasil_hapus") echo "<div class='alert alert-success' style='padding:10px; background:#d4edda; margin-bottom:10px;'>Data berhasil dihapus!</div>";
    }
    ?>
    
    <div style="margin-bottom: 20px;">
        <a href="Data_Master/barang_tambah.php" class="btn btn-primary">+ Tambah Data Barang</a>
    </div>

    <table class="content-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Supplier</th> <th>Stok</th>
                <th>Harga Satuan</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $query_barang = mysqli_query($koneksi, "
                SELECT barang.*, supplier.nama_supplier 
                FROM barang 
                LEFT JOIN supplier ON barang.id_supplier = supplier.id_supplier 
                ORDER BY barang.nama_barang ASC
            ");
            
            if(mysqli_num_rows($query_barang) == 0){
                echo "<tr><td colspan='7' style='text-align:center;'>Tidak ada data barang.</td></tr>";
            }
            
            while($d = mysqli_fetch_assoc($query_barang)){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['kode_barang']; ?></td>
                <td><?php echo $d['nama_barang']; ?></td>
                
                <td><?php echo $d['nama_supplier'] ? $d['nama_supplier'] : '-'; ?></td>
                
                <td><?php echo $d['stok']; ?></td>
                <td>Rp <?php echo number_format($d['harga'], 0, ',', '.'); ?></td>
                <td>
                    <a href="Data_Master/barang_edit.php?id=<?php echo $d['id_barang']; ?>" class="btn btn-warning">Edit</a>
                    <a href="home.php?page=barang&aksi=hapus&id=<?php echo $d['id_barang']; ?>" 
                       onclick="return confirm('Hapus barang <?php echo $d['nama_barang']; ?>?')" 
                       class="btn btn-danger">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>