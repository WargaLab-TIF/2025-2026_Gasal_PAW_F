<?php
require 'validate_error.inc';
$errors = [];
$surname = $_POST['surname'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (validateName($_POST, 'surname')) {
        echo "<p style='color:green;'>Form submitted successfully with no errors</p>";
    } else {
        global $errors;
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>

<form method="POST" action="form.php">
    Surname: <input type="text" name="surname" value="<?php echo htmlspecialchars($surname); ?>"><br><br>
    <input type="submit" value="kirim">
</form>
