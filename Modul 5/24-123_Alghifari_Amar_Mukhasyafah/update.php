<?php
include 'koneksi.php';
if(isset($_POST['update'])) {
    $up = $_POST['no'];
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $update = mysqli_query($conn, "UPDATE master_supllier SET nama = 
    '$nama', telp = $telp, alamat = '$alamat' WHERE no = $up");
    
    if($update) {
        header ('location:tampilkan.php');
        exit;
    } else {
        echo "update gagal";
    }
}
?>


<a href="tampilkan.php">aa</a>