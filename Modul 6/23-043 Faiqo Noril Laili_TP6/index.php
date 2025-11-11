<h1>barang</h1>
<table border="1">
<tr>
    <th>id</th>
    <th>kode barang</th>
    <th>nama barang</th>
    <th>harga</th>
    <th>stok</th>
    <th>nama supplier</th>
    <th>action</th>
</tr>
<?php
include "koneksi.php";
if(isset($_GET["delete"])){
    if(mysqli_num_rows(mysqli_query($conn,"SELECT barang_id from transaksi_detail where barang_id = $_GET[delete]"))){
        echo "<script>
        alert('barang tidak dapat dihapus karena digunakan dalam transaksi detail');
        </script>";
    }elseif(mysqli_query($conn, "DELETE from barang where id = $_GET[delete]")){
        echo "berhasil";
    }
}
$hasil = mysqli_query($conn,"SELECT b.*, s.nama nama_supplier
                            from barang b 
                            join supplier s 
                            on  b.supplier_id = s.id
                            order by id");
while($data = mysqli_fetch_assoc($hasil)){
    echo 
    "<tr>
    <td>$data[id]</td>
    <td>$data[kode_barang]</td>
    <td>$data[nama_barang]</td>
    <td>$data[harga]</td>
    <td>$data[stok]</td>
    <td>$data[nama_supplier]</td>
    <td><a href='index.php?delete=$data[id]' onclick='return confirm(\"apakah anda yakin ingin menghapus data ini?\")'><button>delete</button></a></td>
    </tr>";

}
?>
</table>
<h1>
<a href="tambah_transaksi.php"><button>tambah transaksi</button></a>
<a href="tambah_transaksi_detail.php"><button>tambah transaksi detail</button></a></h1>

<table border='1'>
    <h1>transaksi</h1>
    <tr>
        <th>ID</th>
        <th>waktu transaksi</th>
        <th>keterangan</th>
        <th>total</th>
        <th>nama pelanggan </th>
    </tr>
<?php
$hasil = mysqli_query($conn,"SELECT t.* ,p.nama nama_pelanggan
                            from transaksi t 
                            join pelanggan p on t.pelanggan_id = p.id
                            order by t.id");
while ($baris = mysqli_fetch_assoc($hasil)){
echo"
<tr>
<td>$baris[id]</td>
<td>$baris[waktu_transaksi]</td>
<td>$baris[keterangan]</td>
<td>$baris[total]</td>
<td>$baris[nama_pelanggan]</td>
</tr>";
}
?>
</table>
<table border='1'>
    <h1>transaksi detail</h1>
    <tr>
        <th>transaksi ID</th>
        <th>nama barang</th>
        <th>harga</th>
        <th>qty</th>
    </tr>
<?php
$hasil = mysqli_query($conn,"SELECT d.*,b.nama_barang 
                            from transaksi_detail d
                            join barang b on b.id = d.barang_id
                            order by transaksi_id");
while ($baris = mysqli_fetch_assoc($hasil)){
echo"
<tr>
<td>$baris[transaksi_id]</td>
<td>$baris[nama_barang]</td>
<td>$baris[harga]</td>
<td>$baris[qty]</td>
</tr>";
}
?>
</table>