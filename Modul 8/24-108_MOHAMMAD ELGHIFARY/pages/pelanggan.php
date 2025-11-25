<?php

if(!isset($_SESSION['login']) || $_SESSION['login'] !== true ){
    echo "Anda tidak berhak mengakses halaman ini. Silahkan <a href='index.php'>login</a> terlebih dahulu";
    exit();
}

if ($_SESSION['level'] != '1') {
    echo "Akses ditolak! Anda harus memiliki hak akses Admin untuk melihat halaman ini.";
    exit();
}

require_once "conn.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$nama= "";
$jenis_kelamin = "";
$telp= "";
$alamat= "";
$id_value= "";
$error= "";
$sukses= "";
$op= isset($_GET['op']) ? $_GET['op'] : ""; 

if($op == 'delete'){
    $id_del = $_GET['id'];
    try {
        $sql_del = "DELETE FROM pelanggan WHERE id = '$id_del'";
        $q_del   = mysqli_query($conn, $sql_del);
        if($q_del){
            $sukses = "Data pelanggan berhasil dihapus";
            echo "<script>alert('Data berhasil dihapus'); window.location='index.php?page=pelanggan';</script>";
        }
    } catch (mysqli_sql_exception $e) {
        $error = "Gagal menghapus! Data pelanggan ini sedang digunakan dalam riwayat Transaksi.";
    }
}

if($op == 'edit'){
    $id_edit = $_GET['id'];
    try {
        $sql1    = "SELECT * FROM pelanggan WHERE id = '$id_edit'";
        $q1      = mysqli_query($conn, $sql1);
        $r1      = mysqli_fetch_array($q1);
        
        if($r1){
            $nama          = $r1['nama'];
            $jenis_kelamin = $r1['jenis_kelamin'];
            $telp          = $r1['telp'];
            $alamat        = $r1['alamat'];
            $id_value      = $r1['id'];
        } else {
            $error = "Data tidak ditemukan";
        }
    } catch (Exception $e) {
        $error = "Terjadi kesalahan saat mengambil data.";
    }
}

if(isset($_POST['simpan'])){
    $nama          = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telp          = $_POST['telp'];
    $alamat        = $_POST['alamat'];
    $id_post       = $_POST['id'];

    if($nama && $jenis_kelamin && $telp && $alamat){
        try {
            if($id_post){ 
                $sql1 = "UPDATE pelanggan SET nama='$nama', jenis_kelamin='$jenis_kelamin', telp='$telp', alamat='$alamat' WHERE id='$id_post'";
                $q1   = mysqli_query($conn, $sql1);
                if($q1) $sukses = "Data berhasil diupdate";
            } else {
                $sql1 = "INSERT INTO pelanggan (nama, jenis_kelamin, telp, alamat) VALUES ('$nama', '$jenis_kelamin', '$telp', '$alamat')";
                $q1   = mysqli_query($conn, $sql1);
                if($q1) $sukses = "Berhasil memasukkan data pelanggan baru";
            }

            if($sukses){
                echo "<script>window.location='index.php?page=pelanggan';</script>";
            }

        } catch (mysqli_sql_exception $e) {
            $error = "Gagal menyimpan data: " . $e->getMessage();
        }
        
    } else {
        $error = "Silakan masukkan semua data wajib.";
    }
}

$sql    = "SELECT * FROM pelanggan ORDER BY id ASC";
$query  = mysqli_query($conn, $sql);
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <link rel="stylesheet" href="./css/datamaster.css">
</head>
<body>
    <div class="container">
        <h2 class="judul">Data Pelanggan</h2>
        <div class="btn-top">
            <a href="index.php?page=barang#form-barang" style="text-decoration: none;">
                <button class="tambah" type="button"> + Tambah Barang</button>
            </a>
        </div>
        <?php if($error){ ?>
            <div class="alert alert-error" style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px; border: 1px solid #f5c6cb; border-radius: 4px;">
                <?= $error ?>
            </div>
        <?php } ?>
        <?php if($sukses){ ?>
            <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 10px; border: 1px solid #c3e6cb; border-radius: 4px;">
                <?= $sukses ?>
            </div>
        <?php } ?>

        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>L/P</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Tindakan</th>
            </tr>
            <?php $no = 1; ?>
            <?php if (!empty($result)): ?>
                <?php foreach ($result as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['jenis_kelamin'] ?></td>
                    <td><?= $row['telp'] ?></td>
                    <td><?= $row['alamat'] ?></td>
                    <td>
                        <a href="index.php?page=pelanggan&op=edit&id=<?= $row['id'] ?>">
                            <button class="edit" type="button">Edit</button>
                        </a>

                        <a href="index.php?page=pelanggan&op=delete&id=<?= $row['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data pelanggan ini?')">
                            <button class="hapus" type="button">Hapus</button>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">Tidak ada data pelanggan yang ditemukan.</td></tr>
            <?php endif; ?>
        </table>

        <div class="form-container" id="form-pelanggan" style="margin-top: 20px;">
            <h3>
                <?= ($op == 'edit') ? "Edit Data Pelanggan" : "Tambah Data Pelanggan"; ?>
            </h3>
            
            <form action="index.php?page=pelanggan" method="POST">
                <input type="hidden" name="id" value="<?= $id_value ?>">

                <div class="form-group">
                    <label for="nama">Nama Pelanggan</label>
                    <input type="text" id="nama" name="nama" value="<?= $nama ?>" required>
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">- Pilih Jenis Kelamin -</option>
                        <option value="L" <?= ($jenis_kelamin == 'L') ? "selected" : "" ?>>Laki-laki</option>
                        <option value="P" <?= ($jenis_kelamin == 'P') ? "selected" : "" ?>>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="telp">Nomor Telepon</label>
                    <input type="text" id="telp" name="telp" value="<?= $telp ?>" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" required><?= $alamat ?></textarea>
                </div>

                <button type="submit" name="simpan" class="btn-simpan">Simpan Data</button>
                
                <a href="index.php?page=pelanggan" class="btn-batal" style="text-decoration: none;">
                    <button type="button" class="btn-batal"><?= ($op == 'edit') ? "Batal Edit" : "Reset Form"; ?></button>
                </a>
            </form>
        </div>
    </div>
</body>
</html>