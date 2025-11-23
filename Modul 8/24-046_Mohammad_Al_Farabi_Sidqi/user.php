<?php 
session_start();

if(!isset($_SESSION['login'])){
    header('Location: login.php');
} elseif($_SESSION['role'] == 1){
    header('Location: admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
</head>
<body>
    <?php include "header2.php"; ?>
    <h2>Wlkambek <?= htmlspecialchars($nama_user) ?></h2>
</body>

</html>