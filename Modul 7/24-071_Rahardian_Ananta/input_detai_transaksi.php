<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "store";

$conn = new mysqli($host, $user, $password, $dbname);
$result_barang = mysqli_query($conn, "SELECT * FROM barang");
$result_transaksi = mysqli_query($conn, "SELECT * FROM transaksi");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $barang_id = $_POST["pilih_barang"];
    $id_transaksi = $_POST["id_transaksi"];
    $qty = $_POST["qty"];

    // ambil harga barang dari tabel barang
    $qBarang = mysqli_query(
        $conn,
        "SELECT harga FROM barang WHERE id='$barang_id'",
    );
    $dataBarang = mysqli_fetch_assoc($qBarang);
    $harga_satuan = $dataBarang["harga"];

    // hitung total harga
    $harga_satuan = (int)$dataBarang['harga'];
    $qty = (int)$qty;
    
    $total_harga = $harga_satuan * $qty;

    // cek apakah barang ini sudah ada pada transaksi ini
    $cek = mysqli_query(
        $conn,
        "SELECT * FROM transaksi_detail
         WHERE barang_id = '$barang_id'
         AND transaksi_id = '$id_transaksi'",
    );

    if (mysqli_num_rows($cek) > 0) {
        echo "Barang sudah ada dalam transaksi ini!";
    } else {
        // insert ke detail sesuai kolom yang benar
        mysqli_query(
            $conn,
            "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga)
                            VALUES ('$id_transaksi','$barang_id','$qty','$total_harga')",
        );

        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
    <form method="post">

        <label for="pilih_barang">Pilih Barang</label><br>
        <select name="pilih_barang">
            <option value="">Pilih Barang</option>
         <?php while ($s = mysqli_fetch_assoc($result_barang)) { ?>
             <option value="<?= $s["id"] ?>"><?= $s[
    "nama_barang"
] ?></option>  <?php } ?>
         </select><br>

         <label for="id_transaksi">Id Transaksi</label><br>
         <select name="id_transaksi">
             <option value="">Id transaksi</option>
          <?php while ($s = mysqli_fetch_assoc($result_transaksi)) { ?>
              <option value="<?= $s["id"] ?>"><?= $s[
    "id"
] ?></option>  <?php } ?>
          </select><br>

          <label for="qty">Kuantiti</label><br>
          <input type="number" name="qty"><br>

         <button type="submit">Tambah Transaksi</button>
    </form>
    <!--<a href="index.php"><button>Kembali</button></a>-->
</body>
</html>
