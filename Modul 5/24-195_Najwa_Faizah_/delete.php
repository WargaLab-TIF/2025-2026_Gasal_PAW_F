<?php  
$conn = new mysqli("localhost", "root", "", "tp5");  
if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}  

if (isset($_GET['id'])) {  
    $id = $_GET['id'];  
    $sql = "DELETE FROM supplier WHERE no = $id";  
    mysqli_query($conn, $sql);  
    header("Location: index.php");  
    exit;  
}  

$conn->close();  
?>
