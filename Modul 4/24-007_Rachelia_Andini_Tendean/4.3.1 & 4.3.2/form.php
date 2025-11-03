<?php
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'validate.inc';

    // Validasi hanya jika field diisi
    if (!empty($_POST['surname'])) {
        validateName($_POST, 'surname', $errors);
    }
    if (!empty($_POST['nim'])) {
        validateNIM($_POST, 'nim', $errors);
    }

    if ($errors) {
        echo '<h3>Error!!!!!</h3>';
        foreach ($errors as $field => $error) {
            echo "$error<br>";
        }
        include 'form.inc';
    } elseif (!empty($_POST['surname']) || !empty($_POST['nim'])) {
        // Ada input dan tidak ada error
        echo '<p>Form submitted successfully with no errors!</p>';
        include 'processData.php';
    } else {
        // Submit tapi semua kosong → tampilkan form lagi tanpa pesan
        include 'form.inc';
    }
} else {
  
    include 'form.inc';
}
?>
