<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form</title>
</head>
<body>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<h3>Data yang berhasil dikirim:</h3>";

        if (isset($_POST['surname'])) {
            $surname = htmlspecialchars($_POST['surname']);
        } else {
            $surname = 'Tidak ada';
        }
        echo "Surname: <b>" . $surname . "</b><br>";

        if (isset($_POST['nim'])) {
            $nim = htmlspecialchars($_POST['nim']);
        } else {
            $nim = 'Tidak ada';
        }
        echo "NIM : <b>" . $nim . "</b>";
    }
?>
</body>
</html>