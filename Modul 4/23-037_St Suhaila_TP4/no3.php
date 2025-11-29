<?php
$errors = [];
$output = ""; // Menampung pesan hasil validasi
$form_visible = true; // Awalnya form ditampilkan

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $form_visible = false; 

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $age = trim($_POST['age']);
    $day = trim($_POST['day']);
    $month = trim($_POST['month']);
    $year = trim($_POST['year']);


    if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $errors[] = "Nama tidak valid ";
    }

   
    if ($name === "") {
        $errors[] = "Nama tidak boleh kosong.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    if (!is_numeric($age)) {
        $errors[] = "Umur harus berupa angka.";
    }

    if (!checkdate((int)$month, (int)$day, (int)$year)) {
        $errors[] = "Tanggal lahir tidak valid.";
    }


    if (empty($errors)) {
        $output .= "<h3 Semua data valid!</h3>";
        $output .= "<p><b>Nama:</b> " . strtoupper($name) . "<br>";
        $output .= "<b>Email:</b> " . strtolower($email) . "<br>";
        $output .= "<b>Umur:</b> " . $age . "<br>";
        $output .= "<b>Tanggal Lahir:</b> $day / $month / $year</p>";
    } else {
        $output .= "<h3 Data tidak valid</h3><ul>";
        foreach ($errors as $error) {
            $output .= "<li>$error</li>";
        }
        $output .= "</ul>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>DATA</title>
</head>
<body>
    <?php
    // Jika form sudah disubmit, tampilkan hasil
    if (!$form_visible) {
        echo $output;
    } else {
        // Jika belum disubmit, tampilkan form
    ?>
    <form method="post" action="">
        <label>Nama:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="text" name="email" required><br><br>

        <label>Umur:</label><br>
        <input type="text" name="age" required><br><br>

        <label>Tanggal Lahir (dd/mm/yyyy):</label><br>
        <input type="text" name="day" size="2" placeholder="DD" required> /
        <input type="text" name="month" size="2" placeholder="MM" required> /
        <input type="text" name="year" size="4" placeholder="YYYY" required><br><br>

        <button type="submit">Kirim</button>
    </form>
    <?php } ?>
</body>
</html>
