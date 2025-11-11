<?php
    session_start();
    require_once("./core/conn.php");
    $active = "pelanggan";
    
    $pelanggan = null;
    $pelanggan_sql = "SELECT * FROM pelanggan";

    if ($sql = mysqli_query($conn, $pelanggan_sql)) {
        $pelanggan = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $pelanggan[] = $row;
        } 

        if (count($pelanggan) == []) {
            $pelanggan = null;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggan</title>
    <script defer src="./package/jquery/jquery.js"></script>
    <script defer src="./js/sidebar.js"></script>
    <script defer src="./js/main.js"></script>
    <link rel="stylesheet" href="./package/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/pelanggan.css">
    <link rel="stylesheet" href="./css/main.css">
    <script defer src="./package/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <?php if (isset($_SESSION["notif"])): ?>
        <?php
             require_once "include/notif/notif.php";
             unset($_SESSION["notif"]);
        ?>
    <?php endif; ?>

    <div class="wrapper d-flex align-items-stretch" style="overflow: hidden;">        
    <?php require_once __DIR__ . "/include/sidebar.php" ?>

    <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5" style="overflow: auto; height: 100vh;">
        <div class="container-fluid" style="max-height: fit-content;">
            <div class="d-flex" style="width: 100%; justify-content: end; gap: 20px; margin-bottom: 20px;">
                <a type="button" class="btn btn-primary" href="/MasterDetail/pelanggan_detail.php">
                    <i class="fa fa-plus"></i>
                    Tambah Data Pelanggan
            </a>
            </div>
            <?php if ($pelanggan): ?>
                <?php require_once "./include/pelanggan/pelanggan_list.php"; ?>
            <?php else: ?>
                <div style="width: 100%; display: flex; justify-content: center; margin-top: 100px; font-size: 46px;">
                    Tidak Ada data Pelanggan
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>