<!-- Langkah 5 -->
<!DOCTYPE html>
<html>
<head>
    <title>Form Validasi</title>
</head>
<body>
    <?php
   
    require 'validate.inc';

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (validateName($_POST, 'surname')) {
            echo '<p>Form submitted successfully with no errors</p>';
        } else {
            echo '<p>Data invalid!</p>';
            
            include 'form_baru.inc';
        }
    } else {
        include 'form_baru.inc';
    }
    ?>
</body>
</html>
