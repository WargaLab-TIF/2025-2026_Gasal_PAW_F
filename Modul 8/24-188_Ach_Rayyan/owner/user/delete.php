<?php

    include "../../koneksi.php";

    mysqli_report(MYSQLI_REPORT_OFF);

    if (isset($_GET['id_user'])) {
        $id = $_GET['id_user'];
        $sql = "DELETE FROM users WHERE id_user = $id";

        if (mysqli_query($conn, $sql)) {
            header("location: user.php");
        }
    }

?>