<?php

    include "../../koneksi.php";

    mysqli_report(MYSQLI_REPORT_OFF);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM barang WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
            header("location: barang.php");
        }
    }

?>