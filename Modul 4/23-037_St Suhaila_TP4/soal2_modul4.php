<?php
require "validate.inc";   // berisi fungsi validateName()
$errors = [];
$error = false;

// Proses validasi jika form disubmit
if (isset($_POST["submit"])) {
    validateName($errors, "surname");

    if ($errors) {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
</head>

<body>
    <form action="soal2_modul4.php" method="post">
        <?php 
        // Tampilkan form hanya jika belum ada data valid
        if (!$error) {
            require "form.inc"; 
            echo '<button type="submit" name="submit">Submit</button>';
        }
        ?>
    </form>

    <?php
    // Tampilkan hasil setelah tombol submit ditekan
    if (isset($_POST["submit"])) {
        if ($error) {
            echo "<h2 style='color:red;'>DATA INVALID ❌</h2>";
            foreach ($errors as $key => $val) {
                echo "<p><strong>$key</strong> => $val</p>";
            }
        } else {
            echo "<h2 style='color:green;'>DATA OK ✅</h2>";
            echo "<p>Form submitted successfully with no errors.</p>";
        }
    }
    ?>
</body>
</html>
