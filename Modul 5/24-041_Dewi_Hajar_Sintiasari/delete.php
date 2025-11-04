<?php  

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'store';

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM supplier WHERE id = $id";
    if(mysqli_query($conn, $sql)){
        header("location: index.php");
    }
}
?>