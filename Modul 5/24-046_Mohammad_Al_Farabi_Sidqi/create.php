    <?php
    include "koneksi.php";

    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];

        $nama_err = $telp_err = $alamat_err = "";

        if ($nama === '') {
            $nama_err = "Nama tidak boleh kosong.";
        } elseif (!preg_match("/^[a-zA-Z'-]+$/", $nama)) {
            $nama_err = "Hanya boleh berisi huruf (A–Z atau a–z).";
        }

        if ($telp === '') {
            $telp_err = "Nomor telepon tidak boleh kosong.";
        } elseif (!preg_match("/^[0-9]+$/", $telp)) {
            $telp_err = "Nomor telepon hanya boleh angka.";
        }

        if ($alamat === '') {
            $alamat_err = "Alamat tidak boleh kosong.";
        } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z0-9\s.,-]+$/", $alamat)) {
            $alamat_err = "Alamat harus berisi huruf dan angka (alfanumerik).";
        }

        if ($nama_err === "" && $telp_err === "" && $alamat_err === "") {
            $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
            if (mysqli_query($conn, $sql)) {
                header("Location: index.php");
            }
        }
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Buat</title>
    </head> 
    <style>
        body {
            margin: 5%;
            background-color: blue;
        }

        .layout {
            border-radius: 10px;
            padding: 5%;
            background-color: white;
        }

        button {
            color: green;
        }

        .batal {
            color: red;
        }
    </style>

    <body>
        <div class="layout">
            <form action="" method="POST">
                <table>
                    <tr>
                        <td><label for="">Nama</label></td>
                        <td><input type="text" name="nama" value="<?php echo $nama; ?>"></td>
                        <td><span class="error"><?php echo $nama_err; ?></span></td>
                    </tr>
                    <tr>
                        <td><label for="">Telp</label></td>
                        <td><input type="text" name="telp" value="<?php echo $telp; ?>"></td>
                        <td><span class="error"><?php echo $telp_err; ?></span></td>
                    </tr>
                    <tr>
                        <td><label for="">Alamat</label></td>
                        <td><input type="text" name="alamat" value="<?php echo $alamat; ?>"></td>
                        <td><span class="error"><?php echo $alamat_err; ?></span></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button name="submit" value="submit" type="submit">Simpan</button>
                            <span class="batal">[<a href="index.php">Batal</a>]</span>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>

    </html>