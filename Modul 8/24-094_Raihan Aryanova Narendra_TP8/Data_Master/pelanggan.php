<?php 
if(!isset($koneksi)){
    include 'koneksi.php';
}
// LOGIKA HAPUS PELANGGAN
if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id_pelanggan = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Cek di tabel transaksi
    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_pelanggan='$id_pelanggan'");
    
    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Gagal Hapus! Pelanggan ini memiliki riwayat transaksi.'); window.location='home.php?page=pelanggan';</script>";
    } else {
        $hapus = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'"); 
        if($hapus) {
            echo "<script>window.location='home.php?page=pelanggan&pesan=berhasil_hapus';</script>";
        } else {
            echo "<script>window.location='home.php?page=pelanggan&pesan=gagal_hapus';</script>";
        }
    }
}
?>

<style>    
/* =====================================================
   CARD CONTENT
   ===================================================== */
.card-content {
    background-color: white;
    border-radius: 12px;
    padding: 25px;
    max-width: 1000px;
    margin: 0 auto;
    box-shadow: 0 4px 12px rgba(0,0,60,0.06);
}

/* =====================================================
   HEADER
   ===================================================== */
.card-content h2 {
    color: #2a2a72;
    margin: 0;
    padding-bottom: 10px;
    border-bottom: 2px solid #eee;
}

.header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

/* =====================================================
   ALERT
   ===================================================== */
.alert {
    padding: 10px 15px;
    border-radius: 6px;
    margin-bottom: 18px;
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

/* =====================================================
   BUTTONS
   ===================================================== */
.btn {
    padding: 7px 12px;
    border-radius: 6px;
    text-decoration: none;
    display: inline-block;
    font-size: 13px;
    transition: 0.2s ease;
    cursor: pointer;
    color: #fff;
    border: none;
}

.btn-primary { background: #6f3cff; }
.btn-primary:hover { background: #542dcc; }

.btn-warning { background: #ffb527; color: #333; }
.btn-warning:hover { background: #e09d1d; }

.btn-danger { background: #e63946; }
.btn-danger:hover { background: #c62828; }

/* =====================================================
   TABLE
   ===================================================== */
.content-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    margin-top: 10px;
}

.content-table thead tr {
    background-color: #2a2a72;
    color: white;
}

.content-table th,
.content-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #e5e5e5;
}

/* Warna baris */
.content-table tbody tr:nth-child(even) { background: #faf9ff; }
.content-table tbody tr:hover { background: #f1ecff; }

/* =====================================================
   PERBAIKAN KHUSUS KOLOM
   ===================================================== */

/* Kolom alamat biar tidak melebar */
.content-table td:nth-child(3) {
    max-width: 330px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Kolom telepon */
.content-table td:nth-child(4) {
    white-space: nowrap;
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    font-family: "Courier New", monospace;
    font-size: 13px;
}

/* Kolom aksi */
.content-table td:nth-child(5) {
    white-space: nowrap;
    display: flex;
    gap: 8px;
    align-items: center;
}

/* Tombol di kolom aksi lebih kecil */
.content-table td:nth-child(5) .btn {
    padding: 6px 10px;
    font-size: 12px;
}

/* RESPONSIVE */
@media (max-width: 700px) {
    .content-table td:nth-child(5) {
        flex-direction: column;
        align-items: flex-start;
    }
    .content-table td:nth-child(4) {
        max-width: 110px;
    }
}

</style>

<?php 
if(!isset($koneksi)){
    include 'koneksi.php';
}


if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id_pelanggan = mysqli_real_escape_string($koneksi, $_GET['id']);
    // Cek apakah data dipakai di transaksi (opsional, untuk keamanan data)
    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_pelanggan='$id_pelanggan'");
    
    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Gagal! Pelanggan ini memiliki riwayat transaksi.'); window.location='home.php?page=pelanggan';</script>";
    } else {
        $hapus = mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'"); 
        if($hapus) {
            echo "<script>window.location='home.php?page=pelanggan&pesan=berhasil_hapus';</script>";
        } else {
            echo "<script>window.location='home.php?page=pelanggan&pesan=gagal_hapus';</script>";
        }
    }
}
?>

<div class="card-content">
    <div class="header-actions" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h2 style="margin:0; color:#2a2a72;">Data Pelanggan</h2>
        <a href="Data_Master/pelanggan_tambah.php" class="btn btn-primary">+ Tambah Pelanggan</a>
    </div>

    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "berhasil_tambah") echo "<div class='alert alert-success'>Data berhasil disimpan!</div>";
        elseif($_GET['pesan'] == "berhasil_edit") echo "<div class='alert alert-success'>Data berhasil diupdate!</div>";
        elseif($_GET['pesan'] == "berhasil_hapus") echo "<div class='alert alert-success'>Data berhasil dihapus!</div>";
        elseif($_GET['pesan'] == "gagal_hapus") echo "<div class='alert alert-danger'>Gagal menghapus data.</div>";
    }
    ?>

    <table class="content-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>No. Telepon</th> <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $query_pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan ORDER BY nama_pelanggan ASC");
            
            if(mysqli_num_rows($query_pelanggan) == 0){
                echo "<tr><td colspan='5' align='center'>Belum ada data pelanggan.</td></tr>";
            }

            while($d = mysqli_fetch_assoc($query_pelanggan)){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><b><?php echo htmlspecialchars($d['nama_pelanggan']); ?></b></td>
                <td><?php echo htmlspecialchars($d['alamat']); ?></td>
                <td><?php echo htmlspecialchars($d['no_telp']); ?></td>
                <td>
                    <a href="Data_Master/pelanggan_edit.php?id=<?php echo $d['id_pelanggan']; ?>" class="btn btn-warning">Edit</a>
                    
                    <a href="home.php?page=pelanggan&aksi=hapus&id=<?php echo $d['id_pelanggan']; ?>" 
                       onclick="return confirm('Yakin ingin menghapus pelanggan <?php echo $d['nama_pelanggan']; ?>?')" 
                       class="btn btn-danger">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>