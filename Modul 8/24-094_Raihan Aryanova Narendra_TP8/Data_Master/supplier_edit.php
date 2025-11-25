<?php 
include '../cek_session.php'; 
include '../koneksi.php'; 

if($_SESSION['level'] != 1) exit();
$id = $_GET['id'];
$d = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM supplier WHERE id_supplier='$id'"));

if(isset($_POST['update'])){
    $id_up = $_POST['id'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);

    $query = "UPDATE supplier SET nama_supplier='$nama', alamat='$alamat', no_telp='$telp' WHERE id_supplier='$id_up'";
    if(mysqli_query($koneksi, $query)){
        header("location:../home.php?page=supplier&pesan=edit_sukses");
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Supplier</title></head>
<body style="font-family:sans-serif; padding:20px; background:#f4f4f4;">
<div style="background:white; padding:30px; max-width:600px; margin:0 auto; border-radius:8px;">
    <h2>Edit Supplier</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $d['id_supplier']; ?>">
        <div style="margin-bottom:15px;">
            <label style="display:block; font-weight:bold;">Nama Supplier</label>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($d['nama_supplier']); ?>" required style="width:100%; padding:8px;">
        </div>
        <div style="margin-bottom:15px;">
            <label style="display:block; font-weight:bold;">Alamat</label>
            <textarea name="alamat" required style="width:100%; padding:8px;"><?php echo htmlspecialchars($d['alamat']); ?></textarea>
        </div>
        <div style="margin-bottom:15px;">
            <label style="display:block; font-weight:bold;">No. Telepon</label>
            <input type="text" name="telp" value="<?php echo htmlspecialchars($d['no_telp']); ?>" required style="width:100%; padding:8px;">
        </div>
        <button type="submit" name="update" style="background:#007bff; color:white; padding:10px 20px; border:none; border-radius:4px;">Update</button>
        <a href="../home.php?page=supplier" style="text-decoration:none; margin-left:10px; color:#555;">Batal</a>
    </form>
</div>
</body>
</html>