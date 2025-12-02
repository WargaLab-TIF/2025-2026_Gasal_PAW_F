<?php
    session_start();
    require_once("../../include/validate.php");
    require_once("../../include/conn.php");

    if(!isset($_SESSION['username'])){
    header("Location: ../../login.php");
    exit;
    }

    $user= $_SESSION['username'];
    $sql="SELECT * FROM user WHERE username='$user'";
    $tem=mysqli_query($koneksi, $sql);
    $lev=mysqli_fetch_array($tem);
    $wewenang=$lev['level'];

    if ($wewenang > 1){
        $_SESSION['pesan']="Anda Bukan owner";
        header("Location: ../../login.php");
        exit;
    };

    $err=[];
    $data=[];

    if(isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $sql = "SELECT * FROM barang WHERE id = $id";
        $result = mysqli_query($koneksi, $sql);
        $data = mysqli_fetch_assoc($result);
        
        if(!$data) {
            die("Data tidak ditemukan!");
        }
    }
	
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $namaB = $_POST['nama_barang'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $supp=$_POST['supplier_id'];
        [$ok,$e] = validasi_Null($namaB);if(!$ok){ $err['nama_barang']   = $e;}
        [$ok,$e] = validasi_hp($stok);if(!$ok){ $err['harga']   = $e;}
        [$ok,$e] = validasi_hp($stok);if(!$ok){ $err['stok'] = $e;}
        [$ok,$e] = validasi_supp($supp,$koneksi);if(!$ok){$err['supplier_id']=$e;}
        if(!$err){
            $perubahan = "nama_barang='$namaB',harga='$harga',stok='$stok',supplier_id='$supp'";
            $sql_update = "UPDATE barang SET $perubahan WHERE id=$id";
            mysqli_query($koneksi, $sql_update);
            header('location: ../barang.php');
            exit;
        } else {
            $pesan = "Tidak dapat menyimpan, data belum lengkap!";
        }
    }
?> 
<!doctype html>
<html>
<head>
    <title>Edit Data Barang</title>
    <style>
        label{display:block;margin:8px 0}
        h2{font-family:arial; color:blue;}
		th{background-color:#27D3F5;}
		.adding{background-color:green; color:white; border-radius: 4px; padding:10px;}
		.del{background-color:red; color:white; border-radius: 4px; padding:10px;}
        .layout{max-width: 275px;margin: 0 auto;padding: 1rem;background-color: #fff;border-radius: 8px;box-shadow: 0 0 20px rgba(0,0,0,0.1);}
    </style>
</head>
<body>
    <main class="layout">
    <h2>Edit Data Barang</h2>

    <table> 
        <form method="post" action="">
            <tr>
                <td>Nama Barang:</td>
                <td>
                    <label>
                        <input type="text" name="nama_barang" value="<?php echo $data['nama_barang']; ?>">
                        <?php if(!empty($err['nama_barang'])){echo "<br><small style=color:red>".$err['nama_barang']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Harga :</td>
                <td>
                    <label>
                        <input type="text" name="harga" value="<?php echo $data['harga']; ?>">
                        <?php if(!empty($err['harga'])){ echo "<br><small style=color:red>".$err['harga']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Stok:</td>
                <td>
                    <label>
                        <input type="text" name="stok" value="<?php echo $data['stok']; ?>">
                        <?php if(!empty($err['stok'])){ echo "<br><small style=color:red>".$err['stok']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Supplier_id :</td>
                <td>
                    <label>
                        <select name="supplier_id">
                            <option value="">-- Pilih Supplier --</option>
                            <?php
                            $bar = mysqli_query($koneksi, "SELECT id, nama FROM supplier ORDER BY nama");
                            while ($selb = mysqli_fetch_assoc($bar)):
                            ?>
                                <option value="<?= ($selb['id']) ?>">
                                    <?=($selb['nama']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <?php if(!empty($err['supplier_id'])){ echo "<br><small style=color:red>".$err['supplier_id']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" class="adding">Tambahkan</button>
                <a href="../barang.php"><button type="button" class="del">Batal</button></a></td>
            </tr>
        </form>
    </table>
    </main>
</body>
</html>