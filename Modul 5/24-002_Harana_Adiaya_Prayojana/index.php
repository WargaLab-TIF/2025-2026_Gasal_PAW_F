<?php
/* koneksi inline */
$koneksi = mysqli_connect("localhost","root","","store");

/* --- HAPUS --- */
if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    $sql_hapus="DELETE FROM supplier WHERE id=$id";
    mysqli_query($koneksi, $sql_hapus);
    header("Location: index.php"); 
    exit;
}
?>
<!doctype html>
<html>
<head>
    <title>Data Supplier</title>
    <style>
        label{display:block;margin:8px 0}
        h2{font-family:arial; color:blue;}
		th{background-color:#27D3F5;}
		.adding{background-color:green; color:white; padding:11px 30px; border-radius: 4px; }
		.edit{background-color:#E0903F; color:white; padding:10px; border-radius: 4px;}
		.del{background-color:red; color:white; border-radius: 4px; padding:10px;}
        .layout{max-width: 585px;margin: 0 auto;padding: 1rem;background-color: #fff;border-radius: 8px;box-shadow: 0 0 20px rgba(0,0,0,0.1);}
    </style>
    
</head>
<body>

<main class="layout">
    <h2>Data Master Supplier</h2>
    <div style="display:flex; align-items:center; margin-bottom:10px">
        <form action="form_create.php" style="margin-left:auto"><button class="adding">Tambah Data</button></form>
    </div>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th><th>Nama</th><th>Telp</th><th>Alamat</th><th>Aksi</th>
        </tr>
        <?php
            $res = mysqli_query($koneksi, "SELECT * FROM supplier");
            while($row = mysqli_fetch_array($res)):
        ?>
        <tr>
            <td><?=$row['id']?></td>
            <td><?=$row['nama']?></td>
            <td><?=$row['telp']?></td>
            <td><?=$row['alamat']?></td>
            <td>
                <div style="display:flex; align-items:center; margin-bottom:10px; justify-content: space-between;">
                    <button class="edit" onclick="location.href='form_update.php?id=<?=$row['id']?>'">Edit</button>
                    <button class="del" onclick="if(confirm('Yakin hapus data <?=$row['nama']?>?')) location.href='?delete=<?=$row['id']?>'">Hapus</button>
                </div>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</main>
</body>
</html>