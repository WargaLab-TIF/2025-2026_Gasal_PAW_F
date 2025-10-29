<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <?php
    $errors = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require 'validateNew.inc';

        if (!empty($_POST['phone'])) {
            validatePhone($_POST, 'phone', $errors);
        }
        if (!empty($_POST['email'])) {
            validateEmail($_POST, 'email', $errors);
        }
        if (!empty($_POST['website'])) {
            validateURL($_POST, 'website', $errors);
        }
        if (!empty($_POST['umur'])) {
            validateNumber($_POST, 'umur', $errors);
        }
        if (!empty($_POST['birthdate'])) {
            validateDateField($_POST, 'birthdate', $errors);
        }

        // Jika ada error = tampilkan pesan + form
        if ($errors) {
            echo '<h3>Error!</h3>';
            foreach ($errors as $error) {
                echo "$error<br>";
            }
            include 'form.inc';

        // Jika ada input dan tidak ada error
        } elseif (!empty($_POST['phone']) || !empty($_POST['email']) || !empty($_POST['website']) || !empty($_POST['umur']) || !empty($_POST['birthdate'])) {
            echo '<p>Form submitted successfully with no errors!</p>';
            include 'processData.php';
        } else {
            // Jika semua input ksong
            include 'form.inc';
        }
    } else {
        include 'form.inc';
    }
    ?>

</body>
</html>