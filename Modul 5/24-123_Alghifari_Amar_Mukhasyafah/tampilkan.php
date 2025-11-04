<?php
include 'koneksi.php';
$query = "SELECT * FROM master_supllier";
$result = mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/styles.css">
</head>
<body>
    <div class="positon">
  <table border="2">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Telp</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['no']?></td>
        <td><?php echo $row['nama']?></td>
        <td><?php echo $row['telp']?></td>
        <td><?php echo $row['alamat']?></td>
        <td>
            <a href="hapus.php?no=<?php echo $row['no']?>" 
            onclick="return confirm('Yakin Ingin hapus data ini')">delete</a>
            
            <a href="edit.php?no=<?php echo $row['no']?>"
            >update</a>
        </td>    
    <?php  }?>
    </tr>
</table> 
        <a href="tambah.php" class="a1">TAMBAH DATA?</a>
</div>   
</body>
</html>
