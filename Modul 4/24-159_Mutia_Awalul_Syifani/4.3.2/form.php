<!DOCTYPE html>
<html>
<head>
    <title>Form Validasi</title>
</head>
<body>
    <?php

    require 'validate_baru.inc';

    $errors = []; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $isValid = true;

        if (!validateName($_POST, 'surname')) {
            $errors['surname'] = "Surname hanya boleh berisi huruf";
            $isValid = false;
        }

        if (!validateEmail($_POST, 'email')) {
            $errors['email'] = "Email harus dalam format yang valid";
            $isValid = false;
        }

        if ($isValid) {
            echo '<p>Form submitted successfully with no errors</p>';
        } else {
            echo '<p>Data invalid!</p>';
            echo '<ul style="color:red;">';
            foreach ($errors as $field => $message) {
                echo "<li>$message</li>";
            }
            echo '</ul>';
            include 'form_valbaru.inc';
        }
    } else {

        include 'form_valbaru.inc';
    }
    ?>
</body>
</html>
