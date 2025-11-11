<?php
    session_start();
    require_once("./core/conn.php");
    $active = "pelanggan";
    $tab = isset($_GET["tab"]) ? $_GET["tab"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : "";

    $pelanggan = null;
    $transaksi = null;

    if (isset($_GET["sort_tanggal"])  && $_GET["sort_tanggal"] != "default") {
        $transaksi_sql = mysqli_query($conn, "SELECT * FROM transaksi WHERE pelanggan_id = '$id' ORDER BY waktu_transaksi " . ($_GET["sort_tanggal"] == "asc" ? "ASC" : "DESC"));
    } else {
        $transaksi_sql = mysqli_query($conn, "SELECT * FROM transaksi WHERE pelanggan_id = '$id' ORDER BY id");
    }
    $pelanggan_sql = mysqli_query($conn, "SELECT id, nama, jenis_kelamin, telp, alamat FROM pelanggan WHERE id = '$id'");
    if ($pelanggan_sql) {
        $pelanggan =  mysqli_fetch_assoc($pelanggan_sql);
    }

    if ($transaksi_sql) {
        $transaksi = [];
        while ($row= mysqli_fetch_assoc($transaksi_sql)) {
            $transaksi[] = $row;
        }
        if ($transaksi == []) {
            $transaksi = null;
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
        <nav aria-label="breadcrumb" style="z-index: -1;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Admin</li>
                <li class="breadcrumb-item active" aria-current=<?= isset($pelanggan) ? "" : "page" ?>>Pelanggan</li>

                <?php if ($pelanggan): ?>
                    <li class="breadcrumb-item active" aria-current="page"><?= $id ?></li>
                <?php endif; ?>
            </ol>
        </nav>
        <div class="container-fluid" style="max-height: fit-content;">
            <form action="./proses/pelanggan/pelanggan.php" method="POST">

                <div class="row g-3">

                    <input type="hidden" id="id" name="id" value=<?= isset($_GET["id"]) ? $_GET["id"] : "" ?> >

                    <div class="col-12">
                        <label for="nama" class="form-label">Nama</label>
                        <input style="border: 1px solid rgb(206, 212, 218);" type="text" name="nama" value="<?= isset($pelanggan) ? $pelanggan["nama"] : ""  ?>" class="form-control" id="nama" placeholder="name@example.com" required>
                    </div>
    
                    <div class="col">
                        <label for="telp" class="form-label" >No Telp</label>
                        <input style="border: 1px solid rgb(206, 212, 218);" name="telp" value="<?= isset($pelanggan) ? $pelanggan["telp"] : "" ?>" type="text" class="form-control" id="telp" placeholder="name@example.com" required>
                    </div>
    
                    <div class="col">   
                        <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis-kelamin" name="jenis_kelamin" aria-label="Default select example" require>
                            <option value="L" <?= isset($pelanggan) && $pelanggan["jenis_kelamin"] == "L" ? "selected" : "" ?>>Laki Laki</option>
                            <option value="P" <?= isset($pelanggan) && $pelanggan["jenis_kelamin"] == "P" ? "selected" : "" ?>>Perempuan</option>
                        </select>
                    </div>
    
                    <div class="col-12 mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea  name="alamat" style="border: 1px solid rgb(206, 212, 218); max-height: auto; resize: vertical;" class="form-control" id="alamat" rows="3" required><?= isset($pelanggan) ? $pelanggan["alamat"] : "" ?></textarea>
                    </div>
                </div>

                <div style="width: 100%; display: flex; gap: 10px; justify-content: flex-end;">
                    <a type="button" class="btn btn-danger" href=<?= isset($pelanggan) ? "/MasterDetail/proses/pelanggan/pelanggan.php?delete=true&id={$_GET["id"]}" : "#" ?>>
                        Hapus
                    </a>
                    <a type="button" class="btn btn-secondary" href="/MasterDetail/pelanggan.php">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                </div>
            </form>

            <?php if (isset($pelanggan)): ?>
                <div style="display: flex; gap: 10px;; margin-bottom: 10px; width: 100%; justify-content: end; margin-top: 20px   ;">
                    <button class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah Data Detail
                    </button>
                    <div class="dropdown">

                        <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" style="padding-right: 15px;" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort
                        </button>

                        <ul class="dropdown-menu" style="right: 5px;">
                            <li><a class="dropdown-item" href="?tab=<?= $tab ?>&sort_tanggal=default&id=<?= $id ?>">Default</a></li>
                            <li><a class="dropdown-item" href="?tab=<?= $tab ?>&sort_tanggal=asc&id=<?= $id ?>">Tanggal Naik</a></li>
                            <li><a class="dropdown-item" href="?tab=<?= $tab ?>&sort_tanggal=desc&id=<?= $id ?>">Tanggal Turun</a></li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <ul class="nav nav-tabs mar">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?tab=transaksi<?= isset($pelanggan) ? "&id=" . $id : ""; ?>">Transaksi</a>
                </li>
            </ul>
        </div>

        <?php if (isset($transaksi)): ?>
            <div>
                <?php require_once "./include/pelanggan/transaksi.php" ?>
            </div>
        <?php else: ?>
                <div style="width: 100%; text-align: center; margin-top: 30px;">
                    TIDAK ADA TRANSAKSI
                </div>
        <?php endif; ?>

      </div>
    </div>
</body>

</html>