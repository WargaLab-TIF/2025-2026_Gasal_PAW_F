<?php 
if(!isset($koneksi)){
    include 'koneksi.php';
}
if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id_user = mysqli_real_escape_string($koneksi, $_GET['id']);
    if($id_user == $_SESSION['id_user']){
        echo "<script>alert('Anda tidak bisa menghapus akun yang sedang digunakan!'); window.location='home.php?page=user';</script>";
        exit;
    }

    $hapus = mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id_user'");
    
    if($hapus) {
        echo "<script>window.location='home.php?page=user&pesan=berhasil_hapus';</script>";
    } else {
        echo "<script>window.location='home.php?page=user&pesan=gagal_hapus';</script>";
    }
}
?>

<style>
    /* Style Konsisten dengan Dashboard */
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
    
    /* Tombol */
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

    /* Alert */
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

    /* Badge untuk Level */
    .badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: bold;
    }
    .badge-owner { background: #d1e7dd; color: #0f5132; }
    .badge-kasir { background: #cfe2ff; color: #084298; }
</style>

<div class="card-content">
    
    <div class="header-actions">
        <h2>Data User (Pengguna)</h2>
        <a href="Data_Master/user_tambah.php" class="btn btn-primary">+ Tambah User</a>
    </div>

    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "berhasil_tambah"){
            echo "<div class='alert alert-success'>Data user berhasil ditambahkan!</div>";
        } else if($_GET['pesan'] == "berhasil_edit"){
            echo "<div class='alert alert-success'>Data user berhasil diupdate!</div>";
        } else if($_GET['pesan'] == "berhasil_hapus"){
            echo "<div class='alert alert-success'>Data user berhasil dihapus!</div>";
        } else if($_GET['pesan'] == "gagal_hapus"){
            echo "<div class='alert alert-danger'>Gagal menghapus user.</div>";
        }
    }
    ?>

    <table class="content-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Level Akses</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $query_user = mysqli_query($koneksi, "SELECT * FROM user ORDER BY level ASC, nama ASC");
            
            if (!$query_user) {
                echo "<tr><td colspan='5'><div class='alert alert-danger'>Kesalahan Query: " . mysqli_error($koneksi) . "</div></td></tr>";
            } else {
                while($d = mysqli_fetch_assoc($query_user)){ 
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><b><?php echo $d['nama']; ?></b></td>
                <td><?php echo $d['username']; ?></td>
                <td>
                    <?php if($d['level'] == 1) { ?>
                        <span class="badge badge-owner">Owner</span>
                    <?php } else { ?>
                        <span class="badge badge-kasir">Kasir</span>
                    <?php } ?>
                </td>
                <td>
                    <a href="Data_Master/user_edit.php?id=<?php echo $d['id_user']; ?>" class="btn btn-warning">Edit</a>
                    
                    <?php if(!isset($_SESSION['id_user']) || $d['id_user'] != $_SESSION['id_user']) { ?>
                        <a href="home.php?page=user&aksi=hapus&id=<?php echo $d['id_user']; ?>" 
                           onclick="return confirm('Yakin ingin menghapus user <?php echo $d['nama']; ?>?')"
                           class="btn btn-danger">Hapus</a>
                    <?php } else { ?>
                        <button class="btn btn-secondary" disabled title="Tidak bisa hapus akun sendiri">Hapus</button>
                    <?php } ?>
                </td>
            </tr>
            <?php 
                } 
            }
            ?>
        </tbody>
    </table>
</div>