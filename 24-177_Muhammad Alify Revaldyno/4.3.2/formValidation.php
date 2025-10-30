<?php
require 'validate.inc';

$errors = [];
$surname = '';
$submitted = false;

// jika tombol Submit ditekan
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $surname = $_POST['surname'] ?? '';

    if (validateName($_POST, 'surname', $errors)) {
        $submitted = true;
        echo "<p style='color:green;'>Form submitted successfully with no errors.</p>";
    } else {
        echo "<p style='color:red;'>Ada error pada form:</p>";
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}

// jika belum submit atau ada error, tampilkan form lagi
if (!$submitted) :
?>
    <form method="POST" action="formValidation.php">
        <label for="surname">Surname:</label>
        <input type="text" name="surname" id="surname"
               value="<?= htmlspecialchars($surname) ?>">
        <input type="submit" value="Submit">
    </form>
<?php endif; ?>
