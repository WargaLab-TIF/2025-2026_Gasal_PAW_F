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

    $error = [];
    $data=[];

    if(isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $sql = "SELECT * FROM pelanggan WHERE id = $id";
        $result = mysqli_query($koneksi, $sql);
        $data = mysqli_fetch_assoc($result);
        
        if(!$data) {
            die("Data tidak ditemukan!");
        }
    }
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $jk= $_POST['jk'];
            $telp = $_POST['telp'];
            $alamat = $_POST['alamat'];

            [$ok,$e] = validasi_Null($nama);if(!$ok){ $error['nama']   = $e;}
            [$ok,$e] = validasi_hp($telp);if(!$ok){ $error['telp']   = $e;}
            [$ok,$e] = validasi_Null($alamat);if(!$ok){ $error['alamat'] = $e;}
            [$ok,$e] = validasi_Null($jk);if(!$ok){ $err['jk']= $e;}
            
            if(!$error){
                $perubahan = "nama='$nama',jenis_kelamin='$jk',telp='$telp',alamat='$alamat'";
                $sql_update = "UPDATE pelanggan SET $perubahan WHERE id='$id'";
                mysqli_query($koneksi, $sql_update);
                header('location: ../pelanggan.php');
                exit;
            } else {
                $pesan = "Data tidak lengkap!";
            }
        }
	
?>
<!doctype html>
<html>
<head>
    <title>Edit Data Master Pelanggan</title>
    <style>
        label{display:block;margin:8px 0}
        h2{font-family:arial; color:blue;}
		th{background-color:#27D3F5;}
		.adding{background-color:green; color:white; border-radius: 4px; padding:10px}
		.del{background-color:red; color:white; border-radius: 4px; padding:10px;}
        .layout{max-width: 300px;margin: 0 auto;padding: 1rem;background-color: #fff;border-radius: 8px;box-shadow: 0 0 20px rgba(0,0,0,0.1);}
    </style>
</head>
<body>
    <main class="layout">
        <h2>Edit Data Master Pelanggan</h2>
        <table> 
            <form method="post" action="">
                <tr>
                    <td>Nama:</td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                        <label>
                            <input type="text" name="nama" value="<?=$data['nama']?>">
                            <?php if(!empty($err['nama'])){echo "<br><small style=color:red>".$err['nama']."</small>";}?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>Jenis Kelamin:</td>
                    <td>
                        <label>
                            Laki-laki<input type="radio" name="jk" value="L" checked>Perempuan<input type="radio" name="jk" value="P">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>No Telepon:</td>
                    <td>
                        <label>
                            <input type="text" name="telp" value="<?=$data['telp']?>">
                            <?php if(!empty($err['telp'])){ echo "<br><small style=color:red>".$err['telp']."</small>";}?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>Alamat:</td>
                    <td>
                        <label>
                            <input type="text" name="alamat" value="<?=$data['alamat']?>">
                            <?php if(!empty($err['alamat'])){ echo "<br><small style=color:red>".$err['alamat']."</small>";}?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" class="adding">Update</button>
                    <a href="../pelanggan.php"><button type="button" class="del">Batal</button></a></td>
                </tr>
            </form>
        </table>
    </main>
</body>
</html>