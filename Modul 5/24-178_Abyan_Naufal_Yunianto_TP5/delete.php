<?php
    include "koneksi.php";


    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $sql = "DELETE FROM supplier WHERE id = '$id'";
        $q_delete = mysqli_query($koneksi, $sql);

        if($q_delete) {
            header("Location: index.php?status=hapus_sukses");
            exit();
        } else {
            header("Location: index.php?status=hapus_gagal");
            exit();
        }
    } else {
        header("Location: index.php");
        exit();
    }
?>