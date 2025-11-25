<?php 
if(!isset($koneksi)){
    include 'koneksi.php';
}
if($_SESSION['level'] != 1) {
    echo "<script>window.location='home.php?pesan=akses_ditolak';</script>";
    exit(); 
}
// LOGIKA HAPUS SUPPLIER
if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id_supplier = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Cek di tabel barang
    $cek = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_supplier='$id_supplier'");
    
    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Gagal Hapus! Supplier ini masih terhubung dengan data Barang.'); window.location='home.php?page=supplier';</script>";
    } else {
        $hapus = mysqli_query($koneksi, "DELETE FROM supplier WHERE id_supplier='$id_supplier'");
        if($hapus) {
            echo "<script>window.location='home.php?page=supplier&pesan=berhasil_hapus';</script>";
        } else {
            echo "<script>window.location='home.php?page=supplier&pesan=gagal_hapus';</script>";
        }
    }
}
?>

<style>
    .card-content {
        background-color: white; 
        border-radius: 8px; 
        box-shadow: 0 2px 10px rgba(0,0,0,0.05); 
        padding: 25px;
    }

    h2 { 
        color: #1b1f3b; 
        margin-bottom: 20px; 
        border-bottom: 2px solid #f0f0f0; 
        padding-bottom: 10px; 
        font-weight: 600;
    }

    .content-table { 
        width: 100%; 
        border-collapse: collapse; 
        margin-top: 15px; 
        font-size: 14px;
    }
    
    .content-table thead tr {
        background-color: #1b1f3b;
        color: #ffffff;
        text-align: left;
    }
    
    .content-table th, .content-table td { 
        padding: 12px 15px; 
        border-bottom: 1px solid #dddddd;
    }
    
    .content-table tbody tr:nth-of-type(even) {
        background-color: #f9f9f9; 
    }
    
    .content-table tbody tr:hover {
        background-color: #f1f1f1;
    }
    
    .btn { 
        padding: 8px 14px; 
        text-decoration: none; 
        border-radius: 6px; 
        font-size: 13px; 
        display: inline-block;
        border: none;
        cursor: pointer;
        transition: 0.2s;
        color: white;
    }

    .btn-primary { background-color: #7a3cff; }
    .btn-primary:hover { background-color: #5c2bbf; }

    .btn-warning { background-color: #ffc107; color: #333; }
    .btn-warning:hover { background-color: #e0a800; }

    .btn-danger { background-color: #dc3545; }
    .btn-danger:hover { background-color: #c82333; }

    .alert {
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 6px;
        font-size: 14px;
    }
    .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

    .header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
</style>
<?php 
include 'koneksi.php'; 

if($_SESSION['level'] != 1) {
    echo "<script>alert('Akses Ditolak!'); window.location='home.php';</script>";
    exit(); 
}

// Hapus Supplier
if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    // Cek apakah supplier sedang dipakai di tabel barang
    $cek = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_supplier='$id'");
    if(mysqli_num_rows($cek) > 0){
        echo "<script>alert('Gagal! Supplier ini sedang digunakan pada data Barang.'); window.location='home.php?page=supplier';</script>";
    } else {
        mysqli_query($koneksi, "DELETE FROM supplier WHERE id_supplier='$id'");
        echo "<script>window.location='home.php?page=supplier&pesan=hapus_sukses';</script>";
    }
}
?>

<div class="container-fluid">
    <h2 style="margin-top: 0;">Data Master Supplier</h2>
    <hr>
    <a href="Data_Master/supplier_tambah.php" class="btn btn-primary" style="margin-bottom: 20px;">+ Tambah Supplier</a>

    <table class="content-table" style="width:100%; border-collapse:collapse;">
        <thead style="background:#2a2a72; color:white;">
            <tr>
                <th style="padding:10px;">No</th>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM supplier ORDER BY nama_supplier ASC");
            while($d = mysqli_fetch_assoc($query)){
            ?>
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:10px;"><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($d['nama_supplier']); ?></td>
                <td><?php echo htmlspecialchars($d['alamat']); ?></td>
                <td><?php echo htmlspecialchars($d['no_telp']); ?></td>
                <td>
                    <a href="Data_Master/supplier_edit.php?id=<?php echo $d['id_supplier']; ?>" class="btn btn-warning">Edit</a>
                    <a href="home.php?page=supplier&aksi=hapus&id=<?php echo $d['id_supplier']; ?>" onclick="return confirm('Hapus supplier ini?')" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>