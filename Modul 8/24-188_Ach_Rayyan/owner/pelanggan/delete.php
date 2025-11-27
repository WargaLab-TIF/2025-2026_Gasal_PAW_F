<?php

    include "../../koneksi.php";

    mysqli_report(MYSQLI_REPORT_OFF);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM pelanggan WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
            header("location: pelanggan.php");
        }
    }

?>