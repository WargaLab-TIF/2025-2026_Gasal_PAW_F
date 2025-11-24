<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

if ($username == "" || $password == "") {
    echo "
        Username dan Password tidak boleh kosong!<br>
        <a href='login.php'>Kembali ke Login</a>
    ";
    exit;
}


$sql = mysqli_query($koneksi, 
    "SELECT * FROM user WHERE username='$username' AND password='$password'"
);

$data = mysqli_fetch_assoc($sql);

if ($data) {

    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['level'] = $data['level'];

    header("Location: index.php");
    exit;

} else {
    echo "
        Login gagal! Username atau Password salah.<br>
        <a href='login.php'>Silahkan coba lagi</a>
    ";
}
?>
