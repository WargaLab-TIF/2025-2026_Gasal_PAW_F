<!DOCTYPE html>
<html>
<head>
    <title>Form Input Handling</title>
</head>
<body>
    

    <?php
    require 'validate.inc';
    $errors = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valid = true;

        $valid &= validateName($_POST, 'nama_depan', $errors);
        $valid &= validateName($_POST, 'nama_belakang', $errors);

        if ($valid) {
            echo "Form submitted successfully with no errors.<br>";
        } else {
            echo "Invalid, correct the following errors:<br>";
            foreach ($errors as $err) {
                echo $err . "<br>";
            }
        }
    }

    include 'form.inc';
    ?>
</body>
</html>
