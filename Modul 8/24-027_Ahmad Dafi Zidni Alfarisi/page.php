<?php 
include "koneksi.php";

if (!isset($_GET["p"])) {
    echo "<h2>Selamat Datang di Sistem Kasir</h2>";
    echo "<p>Silahkan pilih menu di atas untuk mulai mengelola data.</p>";
    return;
}

$halaman = $_GET["p"];

if ($halaman == "barang") {

    echo "
    <h2>Data Barang</h2>
    <a href='?p=barang_tambah' style='display:inline-block;margin-bottom:10px;'>+ Tambah Barang</a>
    ";

    $queryBarang = mysqli_query($koneksi, "SELECT * FROM barang");

    echo "
    <table border='1' cellpadding='8' cellspacing='0' style='border-collapse:collapse;'>
        <tr style='background:#f0f0f0;'>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    ";

    while ($barang = mysqli_fetch_assoc($queryBarang)) {
        echo "
        <tr>
            <td>{$barang['kode_barang']}</td>
            <td>{$barang['nama_barang']}</td>
            <td>{$barang['harga']}</td>
            <td>{$barang['stok']}</td>
            <td>
                <a href='?p=barang_edit&id={$barang['id']}'>Edit</a> | 
                <a href='aksi.php?aksi=barang_hapus&id={$barang['id']}'>Hapus</a>
            </td>
        </tr>
        ";
    }

    echo "</table>";
}

else if ($halaman == "barang_tambah") {

    echo "
    <h2>Tambah Barang</h2>

    <form method='POST' action='aksi.php?aksi=barang_tambah'>
        <label>Kode Barang</label><br>
        <input name='kode_barang' style='width:200px;'><br><br>

        <label>Nama Barang</label><br>
        <input name='nama_barang' style='width:300px;'><br><br>

        <label>Harga</label><br>
        <input type='number' name='harga' style='width:150px;'><br><br>

        <label>Stok</label><br>
        <input type='number' name='stok' style='width:150px;'><br><br>

        <button>Simpan</button>
    </form>
    ";
}

else if ($halaman == "barang_edit") {

    $id = $_GET["id"];
    $dataBarang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM barang WHERE id=$id"));

    echo "
    <h2>Edit Barang</h2>

    <form method='POST' action='aksi.php?aksi=barang_edit&id=$id'>
        <label>Kode Barang</label><br>
        <input name='kode_barang' value='{$dataBarang['kode_barang']}' style='width:200px;'><br><br>

        <label>Nama Barang</label><br>
        <input name='nama_barang' value='{$dataBarang['nama_barang']}' style='width:300px;'><br><br>

        <label>Harga</label><br>
        <input type='number' name='harga' value='{$dataBarang['harga']}' style='width:150px;'><br><br>

        <label>Stok</label><br>
        <input type='number' name='stok' value='{$dataBarang['stok']}' style='width:150px;'><br><br>

        <button>Update</button>
    </form>
    ";
}

else if ($halaman == "user") {

    echo "
    <h2>Data User</h2>
    <a href='?p=user_tambah' style='display:inline-block;margin-bottom:10px;'>+ Tambah User</a>
    ";

    $queryUser = mysqli_query($koneksi, "SELECT * FROM user");

    echo "
    <table border='1' cellpadding='8' cellspacing='0' style='border-collapse:collapse;'>
        <tr style='background:#f0f0f0;'>
            <th>Username</th>
            <th>Nama Lengkap</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
    ";

    while ($user = mysqli_fetch_assoc($queryUser)) {
        echo "
        <tr>
            <td>{$user['username']}</td>
            <td>{$user['nama']}</td>
            <td>{$user['level']}</td>
            <td>
                <a href='?p=user_edit&id={$user['id']}'>Edit</a> |
                <a href='aksi.php?aksi=user_hapus&id={$user['id']}'>Hapus</a>
            </td>
        </tr>
        ";
    }

    echo "</table>";
}

else if ($halaman == "user_tambah") {

    echo "
    <h2>Tambah User</h2>

    <form method='POST' action='aksi.php?aksi=user_tambah'>
        <label>Username</label><br>
        <input name='username' style='width:200px;'><br><br>

        <label>Password</label><br>
        <input name='password' type='password' style='width:200px;'><br><br>

        <label>Nama Lengkap</label><br>
        <input name='nama_lengkap' style='width:300px;'><br><br>

        <label>Level (1=Owner, 2=Kasir)</label><br>
        <input name='level' style='width:100px;'><br><br>

        <button>Simpan</button>
    </form>
    ";
}

else if ($halaman == "user_edit") {

    $id = $_GET["id"];
    $dataUser = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM user WHERE id=$id"));

    echo "
    <h2>Edit User</h2>

    <form method='POST' action='aksi.php?aksi=user_edit&id=$id'>
        <label>Username</label><br>
        <input name='username' value='{$dataUser['username']}' style='width:200px;'><br><br>

        <label>Password</label><br>
        <input name='password' value='{$dataUser['password']}' type='password' style='width:200px;'><br><br>

        <label>Nama Lengkap</label><br>
        <input name='nama_lengkap' value='{$dataUser['nama']}' style='width:300px;'><br><br>

        <label>Level (1=Owner, 2=Kasir)</label><br>
        <input name='level' value='{$dataUser['level']}' style='width:100px;'><br><br>

        <button>Update</button>
    </form>
    ";
}

else if ($halaman == "transaksi") {

    echo "
    <h2>Transaksi Penjualan</h2>

    <form method='POST' action='aksi.php?aksi=transaksi'>
        <label>Tanggal Transaksi</label><br>
        <input type='date' name='tanggal_transaksi'><br><br>

        <label>Total Pembayaran</label><br>
        <input type='number' name='total_pembayaran'><br><br>

        <button>Simpan Transaksi</button>
    </form>
    ";
}

else if ($halaman == "laporan") {

    echo "<h2>Laporan Transaksi</h2>";

    $queryLaporan = mysqli_query($koneksi, "SELECT * FROM transaksi");

    echo "
    <table border='1' cellpadding='8' cellspacing='0' style='border-collapse:collapse;'>
        <tr style='background:#f0f0f0;'>
            <th>Tanggal</th>
            <th>Total</th>
        </tr>
    ";

    while ($laporan = mysqli_fetch_assoc($queryLaporan)) {
        echo "
        <tr>
            <td>{$laporan['tanggal']}</td>
            <td>{$laporan['total']}</td>
        </tr>
        ";
    }

    echo "</table>";
}

?>
