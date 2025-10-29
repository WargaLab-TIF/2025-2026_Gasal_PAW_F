<!DOCTYPE html>
<html>
<head>
    <title>Form Validasi Eksplorasi</title>
</head>
<body>
    <?php
    require 'validate_explore.inc';

    $errors = []; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $isValid = true;
        
        if (!validateSurname($_POST, 'surname', $errors)) {
            $isValid = false;
        }

        if (!validateEmail($_POST, 'email', $errors)) {
            $isValid = false;
        }

        if (!validateURL($_POST, 'url', $errors)) {
            $isValid = false;
        }

        if (!validateNumber($_POST, 'number', $errors)) {
            $isValid = false;

        if (!validateDate($_POST, 'date', $errors)) {
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
        
            include 'form_explore.inc';
        }
    }
    } else {
        include 'form_explore.inc';
    }
    ?>
</body>
</html>