<?php
$txt="Hello world!";
$jumlah_kata=str_word_count($txt);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Soal no 9</title>
</head>
<body>
    <p><?php echo $jumlah_kata; ?></p>
</body>
</html>