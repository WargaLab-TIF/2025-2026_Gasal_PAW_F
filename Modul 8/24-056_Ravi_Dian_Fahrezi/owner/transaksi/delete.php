<?php

    include "../../koneksi.php";

    mysqli_report(MYSQLI_REPORT_OFF);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM transaksi WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
            header("location: transaksi.php");
        }
    }

?>