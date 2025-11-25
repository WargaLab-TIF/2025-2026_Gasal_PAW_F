<?php 
require "koneksi.php"; 

if (isset($_GET['id_user'])) { 
    $id = $_GET['id_user'];  // Menyimpan nilai id_user ke dalam variabel $id

    // Hapus data dari database
    $query = "DELETE FROM user WHERE id_user = $id";  // Menggunakan $id yang sudah didefinisikan
    $result = mysqli_query($koneksi, $query); 

    if ($result) { 
        header("Location: index.php"); 
        exit; 
    } else { 
        echo "Gagal menghapus data. <a href='index.php'>Kembali</a>"; 
    } 
} else { 
    echo "ID tidak valid. <a href='index.php'>Kembali</a>"; 
} 
?>
