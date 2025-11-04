<?php
include 'koneksi.php';
if(isset($_GET['no'])) {
    $no = $_GET['no'];
    $hapus = mysqli_query($conn, "DELETE FROM master_supllier WHERE no = $no");

    if ($hapus) {
        header ('location:tampilkan.php');
    }

}
?>