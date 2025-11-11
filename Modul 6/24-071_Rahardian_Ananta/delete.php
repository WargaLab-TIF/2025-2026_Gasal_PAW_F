<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "store";

$conn = new mysqli($host, $user, $password, $dbname);

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $cek = mysqli_query($conn,"SELECT * FROM transaksi_detail WHERE barang_id='$id'");
    $jumlah = mysqli_num_rows($cek);

    if ($jumlah > 0) {
        echo "<script>alert('Tidak bisa hapus, barang dipakai transaksi');window.location='index.php';</script>";
        exit();
    } else {
        mysqli_query($conn,"DELETE FROM barang WHERE id='$id'");
        header("Location: index.php");
        exit();
    }

} else {
    header("Location: index.php");
    exit();
}
?>
