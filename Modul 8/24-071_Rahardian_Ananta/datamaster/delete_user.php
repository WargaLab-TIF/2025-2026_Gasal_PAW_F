<?php
    session_start();
    if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
        header("Location: login.php");
        exit();
    }
    require "../conn.php";
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $hapus = mysqli_query($conn, "DELETE FROM user WHERE id_user = '$id'");
        if ($hapus) {
            echo "<script>
                alert('User berhasil dihapus!');
                window.location.href = 'datamaster.php';
            </script>";
        } else {
        echo "Gagal menghapus: " . mysqli_error($conn);
    }
} else {
header("Location: datamaster.php");
}
?>