<?php
    require "validate.php";
    $koneksi = mysqli_connect("localhost","root","","store");

    $error = [];
    $data=[];

    if(isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $sql = "SELECT * FROM supplier WHERE id = $id";
        $result = mysqli_query($koneksi, $sql);
        $data = mysqli_fetch_assoc($result);
        
        if(!$data) {
            die("Data tidak ditemukan!");
        }
    }
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $telp = $_POST['telp'];
            $alamat = $_POST['alamat'];

            [$ok,$e] = validasi_nama($nama);if(!$ok){ $error['nama']   = $e;}
            [$ok,$e] = validasi_telp($telp);if(!$ok){ $error['telp']   = $e;}
            [$ok,$e] = validasi_alamat($alamat);if(!$ok){ $error['alamat'] = $e;}
            
            if(!$error){
                $perubahan = "nama='$nama',telp='$telp',alamat='$alamat'";
                $sql_update = "UPDATE supplier SET $perubahan WHERE id=$id";
                $update = mysqli_query($koneksi, $sql_update);
                if($update && isset($_GET['aksi'])){
                    if($_GET['aksi'] == 'update'){
                        header('location: index.php');
                        exit;
                    }
                }
            } else {
                $pesan = "Data tidak lengkap!";
            }
        }
	
?>
<!doctype html>
<html>
<head>
    <title>Edit Data Master Supplier</title>
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
        <h2>Edit Data Master Supplier</h2>
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
                    <a href="index.php"><button type="button" class="del">Batal</button></a></td>
                </tr>
            </form>
        </table>
    </main>
</body>
</html>