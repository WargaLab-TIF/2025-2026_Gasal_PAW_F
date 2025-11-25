    <?php


    if(!isset($_SESSION['login']) || $_SESSION['login'] !== true ){
        header("Location: ../index.php");
        exit();
    }

    $aksi = $_POST['aksi'] ?? $_GET['aksi'] ?? '';
    $transaksi_id = (int)($_POST['transaksi_id'] ?? $_GET['transaksi_id'] ?? 0);
    $barang_id    = (int)($_POST['barang_id'] ?? $_GET['barang_id'] ?? 0);
    $qty          = (int)($_POST['qty'] ?? 0);

    if ($transaksi_id <= 0) {
        echo "ID Transaksi tidak valid";
        exit;
    }

    function updateGrandTotal($conn, $transaksi_id) {
        $sql_sum = "SELECT SUM(harga * qty) as total_baru 
                    FROM transaksi_detail 
                    WHERE transaksi_id = $transaksi_id";

        $res_sum = mysqli_query($conn, $sql_sum);
        $row_sum = mysqli_fetch_assoc($res_sum);
        $total_baru = $row_sum['total_baru'] ?? 0;

        mysqli_query($conn, 
            "UPDATE transaksi SET total = $total_baru 
            WHERE id = $transaksi_id");
    }


    if ($aksi == 'tambah') {

        $cek_barang = mysqli_query($conn, "SELECT harga FROM barang WHERE id = $barang_id");
        $data_barang = mysqli_fetch_assoc($cek_barang);
        $harga = $data_barang['harga'];
        $cek_ada = mysqli_query($conn, 
            "SELECT qty FROM transaksi_detail 
            WHERE transaksi_id = $transaksi_id AND barang_id = $barang_id");

        if (mysqli_num_rows($cek_ada) > 0) {
            $row_ada = mysqli_fetch_assoc($cek_ada);
            $qty_baru = $row_ada['qty'] + $qty;

            $sql = "UPDATE transaksi_detail 
                    SET qty = $qty_baru 
                    WHERE transaksi_id = $transaksi_id AND barang_id = $barang_id";

        } else {
            $sql = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty)
                    VALUES ($transaksi_id, $barang_id, $harga, $qty)";
        }

        mysqli_query($conn, $sql);
        updateGrandTotal($conn, $transaksi_id);
    }


    elseif ($aksi == 'update') {

        if ($qty > 0) {
            $sql = "UPDATE transaksi_detail 
                    SET qty = $qty 
                    WHERE transaksi_id = $transaksi_id AND barang_id = $barang_id";

            mysqli_query($conn, $sql);
            updateGrandTotal($conn, $transaksi_id);
        }
    }


    elseif ($aksi == 'hapus') {

        $sql = "DELETE FROM transaksi_detail 
                WHERE transaksi_id = $transaksi_id AND barang_id = $barang_id";

        mysqli_query($conn, $sql);
        updateGrandTotal($conn, $transaksi_id);
    }


    header("Location: ./index.php?page=transaksi&detail_id=$transaksi_id");
    exit;
