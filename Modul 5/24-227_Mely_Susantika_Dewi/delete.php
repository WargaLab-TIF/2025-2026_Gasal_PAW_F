<?php
$koneksi = mysqli_connect("localhost", "root", "", "store") or die(mysqli_error($koneksi));
?>


<?php
include 'koneksi.php'; // pastikan file koneksi.php ada di folder yang sama

$id = $_GET['id'];

// pastikan $koneksi adalah variabel dari koneksi.php
mysqli_query($koneksi, "DELETE FROM supplier WHERE id='$id'") or die(mysqli_error($koneksi));

header("Location: data_supplier.php");
exit;
?>
