<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Data</title>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo "<h3>Data yang berhasil dikirim:</h3>";

    // PHONE
    if (!empty($_POST['phone'])) {
        $phone = htmlspecialchars($_POST['phone']);
        echo "Phone: <b>" . $phone . "</b><br>";
    } else {
        echo "Phone: <b>Tidak ada</b><br>";
    }

    // EMAIL
    if (!empty($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
        echo "Email: <b>" . $email . "</b><br>";
    } else {
        echo "Email: <b>Tidak ada</b><br>";
    }

    // WEBSITE
    if (!empty($_POST['website'])) {
        $website = htmlspecialchars($_POST['website']);
        echo "Website: <b>" . $website . "</b><br>";
    } else {
        echo "Website: <b>Tidak ada</b><br>";
    }

    // UMUR
    if (!empty($_POST['umur'])) {
        $umur = htmlspecialchars($_POST['umur']);
        echo "Umur: <b>" . $umur . "</b><br>";
    } else {
        echo "Umur: <b>Tidak ada</b><br>";
    }

    // TANGGAL LAHIR
    if (!empty($_POST['birthdate'])) {
        $birthdate = htmlspecialchars($_POST['birthdate']);
        echo "Tanggal Lahir: <b>" . $birthdate . "</b><br>";
    } else {
        echo "Tanggal Lahir: <b>Tidak ada</b><br>";
    }
}
?>
</body>
</html>
