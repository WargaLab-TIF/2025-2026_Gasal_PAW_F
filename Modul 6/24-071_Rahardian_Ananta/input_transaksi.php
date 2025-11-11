<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "store";

$conn = new mysqli($host, $user, $password, $dbname);
$result_supplier = mysqli_query($conn,"SELECT * FROM pelanggan");

$waktu_transaksi = "";
$keterangan = "";

$chek_waktu = false;
$chek_keterangan = false;
$chek_idPelanggan = false;

if($_SERVER['REQUEST_METHOD'] == "POST"){ 
 $waktu_transaksi = $_POST['waktu_transaksi']; 
 $keterangan = $_POST['keterangan']; 
 $total = $_POST['total']; 
 $pelanggan_id = $_POST['pelanggan_id']; 
 
 if ($waktu_transaksi >= date('Y-m-d')){
     $chek_waktu = true;
 } else {
     echo "Tanggal tidak boleh kurang dari hari ini!";
 }
 
if (strlen($keterangan) > 2 and !empty($_POST["keterangan"])) {
    $chek_keterangan = true;
} else {
    echo "panjang minimal 3 karakter. <br>";
}

if (!empty($pelanggan_id)){
    $chek_idPelanggan = true;
} else {
        echo "Mohon pilih pelanggan id dengan benar";
}

if ($chek_waktu and $chek_keterangan and $chek_idPelanggan == true){
    $sql = "INSERT INTO 
   transaksi(waktu_transaksi,keterangan,total,pelanggan_id) 
   VALUES('$waktu_transaksi','$keterangan','$total','$pelanggan_id')"; 
    mysqli_query($conn,$sql); 
    header("Location: index.php");
} 
} 


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
    <form method="post">
        
        <label for="waktu_transaksi">Waktu Transaksi</label><br>
        <input type="date" name="waktu_transaksi" value="<?php echo $waktu_transaksi ?>"><br>
            
        <label for="keterangan">Keterangan</label><br>
        <textarea name="keterangan" rows="5" cols="21"><?php echo $keterangan ?></textarea><br>
            
        <label for="total">Total</label><br>
        <input type="number" name="total" value="0"><br>

        <label for="pelanggan_id">Pelanggan</label><br>
        <select name="pelanggan_id"> 
            <option value="">Pilih ID Pelanggan</option>
         <?php while($s = mysqli_fetch_assoc($result_supplier)) { ?>  
             <option value="<?= $s['id'] ?>"><?= $s['id'] ?></option>  <?php } ?> 
         </select><br> 
         <button type="submit">Tambah Transaksi</button>
    </form>
</body>
</html>