<?php
$conn = mysqli_connect("localhost","root","","penjualan");
if($conn) {
    echo "database asuk";
} else {
    echo "salah";
}
?>