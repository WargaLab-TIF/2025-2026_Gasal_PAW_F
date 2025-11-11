<?php
if (isset($_GET['hapus'])){
        $id_barang = ($_GET['hapus']);

        $cek = mysqli_prepare($conn, "SELECT COUNT(*) FROM transaksi_detail WHERE barang_id = ?");
        mysqli_stmt_bind_param($cek, "i", $id_barang);
        mysqli_execute($cek);
        mysqli_stmt_bind_result($cek, $jumlah_pengguna);
        mysqli_stmt_fetch($cek);
        mysqli_stmt_close($cek);

        if ($jumlah_pengguna > 0) {
            echo "<script> alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail');
                window.location.href = 'index.php'; </script>";
            exit;
        }
        else {
            $stmt_delete = mysqli_prepare($conn, "DELETE FROM barang WHERE id = ?");
            mysqli_stmt_bind_param($stmt_delete, "i", $id_barang);
            mysqli_stmt_execute($stmt_delete);
            mysqli_stmt_close($stmt_delete);

            echo "<script> alert('Barang berhasil dihapus.');
                window.location.href = 'index.php';
                </script>";
            exit;
        }

        
    }