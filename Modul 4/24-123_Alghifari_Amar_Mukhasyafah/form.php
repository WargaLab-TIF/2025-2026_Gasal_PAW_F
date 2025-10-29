<?php
require 'validate.inc'; // import semua fungsi validasi
$errors = [];

if (isset($_POST['submit'])) {

    // Jalankan semua validasi
    $valid = true;
    $valid &= validateName($_POST, 'surname', $errors);
    $valid &= validateEmail($_POST, 'email', $errors);
    $valid &= validateAge($_POST, 'age', $errors);
    $valid &= validateDate($_POST, $errors);

    if ($valid) {
        echo "<h3>Form submitted successfully with no errors.</h3>";
        echo "<p>Hasil input:</p>";
        echo "Nama: " . htmlspecialchars($_POST['surname']) . "<br>";
        echo "Email: " . htmlspecialchars($_POST['email']) . "<br>";
        echo "Umur: " . htmlspecialchars($_POST['age']) . "<br>";
        echo "Tanggal Lahir: " . htmlspecialchars($_POST['day']) . "-" . 
             htmlspecialchars($_POST['month']) . "-" . 
             htmlspecialchars($_POST['year']) . "<br>";
    } else {
        echo "<h3>Terjadi kesalahan:</h3>";
        echo "<ul>";
        foreach ($errors as $msg) {
            echo "<li>$msg</li>";
        }
        echo "</ul>";
        include 'form.inc';
    }
} else {
    include 'form.inc';
}
?>
