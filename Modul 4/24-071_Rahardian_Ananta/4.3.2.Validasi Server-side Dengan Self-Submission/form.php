<?php
require 'validate.inc';


$errors = [];
$is_processed = false;

// 3. Inisialisasi variabel "sticky form"
$username = '';
$surname = '';
$email = '';
$password = '';
$alamat = '';
$semester = '';
$kelamin = '';
$hobi = [];

// 4. jika form menggunakan method post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Ambil data yang disubmit
    $username = htmlspecialchars($_POST['username'] ?? '');
    $surname = htmlspecialchars($_POST['surname'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? '');
    $alamat = htmlspecialchars($_POST['alamat'] ?? '');
    $semester = htmlspecialchars($_POST['semester'] ?? '');
    $kelamin = htmlspecialchars($_POST['kelamin'] ?? '');
    $hobi = (array) ($_POST['hobi'] ?? []);

    // Ya -> Validasi form
    validateUsername($_POST, 'username', $errors);
    validateName($_POST, 'surname', $errors);
    validateEmail($_POST, 'email', $errors);

    if (empty($errors)) {
        // Tidak ada error -> Tampilkan pesan sukses
        $is_processed = true;
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Self-Submission Form (Tugas 4.3.2)</title>
        <style>
            form div {
                margin-bottom: 15px;
            }
            label {
                display: block;
                margin-bottom: 5px;
            }
            input[type="text"],input[type="email"],input[type="password"],textarea,select {
                width: 300px;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            button {
                padding: 10px 15px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 4px;
            }
            .inline-label {
                display: inline-block;
                margin-right: 10px;
            }
            .error-summary {
                color: red;
                border: 1px solid red;
                background-color: #ffebee;
                padding: 10px;
                margin-bottom: 15px;
                border-radius: 4px;
            }
            .error-summary ul {
                margin: 0;
                padding-left: 20px;
            }
        </style>
    </head>
    <body>
        

        <?php
        // 5. Tampilkan Hasil Proses atau Error
        if ($is_processed) {
            echo "<h3>Form submitted successfully with no errors.</h3>";

        } elseif (!empty($errors)) {
            echo "<div class'error-summary'>";
            echo "<p><strong>Terdapat error validasi:</strong></p>";
            echo "<ul>";
            foreach ($errors as $field => $error_message) {
                echo "<li>$error_message</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
        ?>

        <?php
        if (!$is_processed) {
            require 'form.inc';
        }
        ?>

    </body>
</html>