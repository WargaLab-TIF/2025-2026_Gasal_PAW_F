<?php
$username = $text = $email = $float = $day = $month = $year = "";
$usernameErr = $textErr = $emailErr = $floatErr = $dateErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["username"])) {
        $usernameErr = "Username wajib diisi";
    } else {
        $username = trim($_POST["username"]);
        if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
            $usernameErr = "Username hanya boleh huruf dan angka";
        }
    }

    if (empty($_POST["text"])) {
        $textErr = "Alamat wajib diisi";
    } else {
        $text = trim($_POST["text"]);
        if (!is_string($text)) {
            $textErr = "Alamat harus berupa teks";
        } elseif (!preg_match("/^[a-zA-Z0-9\s\.,\/\-]+$/", $text)) {
            $textErr = "Alamat mengandung karakter tidak valid";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email wajib diisi";
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format email tidak valid";
        }
    }

    if (empty($_POST["float"])) {
        $floatErr = "Nilai wajib diisi";
    } else {
        $float = trim($_POST["float"]);
        if (!is_numeric($float)) {
            $floatErr = "Nilai harus angka";
        } else {
            $float = (float)$float;
        }
    }

    $day = $_POST["day"] ?? "";
    $month = $_POST["month"] ?? "";
    $year = $_POST["year"] ?? "";
    if (empty($day) || empty($month) || empty($year)) {
        $dateErr = "Tanggal lengkap wajib diisi";
    } elseif (!checkdate((int)$month, (int)$day, (int)$year)) {
        $dateErr = "Tanggal tidak valid";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Validasi Server-side</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <label for="username">Username</label><br>
        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>"><br>
        <span style="color:red"><?php echo $usernameErr; ?></span>
        <br><br>

        <label for="alamat">Alamat</label><br>
        <input type="text" name="text" value="<?php echo htmlspecialchars($text); ?>"><br>
        <span style="color:red"><?php echo $textErr; ?></span>
        <br><br>

        <label for="email">Email</label><br>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>"><br>
        <span style="color:red"><?php echo $emailErr; ?></span>
        <br><br>

        <label for="nilai">Nilai</label><br>
        <input type="text" name="float" value="<?php echo htmlspecialchars($float); ?>"><br>
        <span style="color:red"><?php echo $floatErr; ?></span>
        <br><br>


        <label for="tanggal">Tanggal</label><br>
        <input type="text" name="day" size="2" placeholder="DD" value="<?php echo htmlspecialchars($day); ?>">
        <input type="text" name="month" size="2" placeholder="MM" value="<?php echo htmlspecialchars($month); ?>">
        <input type="text" name="year" size="4" placeholder="YYYY" value="<?php echo htmlspecialchars($year); ?>"><br>
        <span style="color:red"><?php echo $dateErr; ?></span>
        <br><br>

        <button type="submit" style="background-color: blue; color: white; font-weight: bold; width: 70px; height: 25px; border-radius: 5px;">Kirim</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" &&
        empty($usernameErr) && empty($textErr) && empty($emailErr) &&
        empty($floatErr) && empty($dateErr)) {
        echo "<h3>Data yang dikirim:</h3>";
        echo "Username: $username<br>";
        echo "Alamat: $text<br>";
        echo "Email: $email<br>";
        echo "Nilai: $float<br>";
        echo "Tanggal: $day-$month-$year<br>";
    }
    ?>
</body>
</html>
