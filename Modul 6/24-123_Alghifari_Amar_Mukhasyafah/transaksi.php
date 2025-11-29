<?php
    session_start();
    require_once("./core/conn.php");
    $active = "transaksi";
    $tab = isset($_GET["tab"]) ? $_GET["tab"] : "";
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
            
        </div>
    </div>
</body>

</html>