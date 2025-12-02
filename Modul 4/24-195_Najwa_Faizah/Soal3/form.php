<?php
$errors = array();
$submitted = false;

function validateForm($data, &$errors) {
    // Regular expression 
    if (!preg_match("/^[a-zA-Z\s-]+$/", $data['name'])) {
        $errors['name'] = "Nama hanya boleh berisi huruf, spasi, dan tanda hubung.";
    }

    // String 
    $data['email'] = strtolower(trim($data['email']));
    if (empty($data['email'])) {
        $errors['email'] = "Email tidak boleh kosong.";
    }

    // Filter 
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid.";
    }

    if (!empty($data['website']) && !filter_var($data['website'], FILTER_VALIDATE_URL)) {
        $errors['website'] = "Format URL tidak valid.";
    }

    if (!empty($data['ip']) && !filter_var($data['ip'], FILTER_VALIDATE_IP)) {
        $errors['ip'] = "Format IP tidak valid.";
    }

    // Type testing 
    if (!is_numeric($data['age']) || !is_int((int)$data['age'])) {
        $errors['age'] = "Umur harus berupa angka bulat.";
        if (!filter_var($data['height'], FILTER_VALIDATE_FLOAT)) {
            $errors['height'] = "Tinggi harus berupa angka desimal.";
        }
    }

    // Date validation
    $date_parts = explode('-', $data['birthdate']);
    if (count($date_parts) === 3) {
        if (!checkdate((int)$date_parts[1], (int)$date_parts[2], (int)$date_parts[0])) {
            $errors['birthdate'] = "Format tanggal tidak valid.";
        }
    } else {
        $errors['birthdate'] = "Format tanggal harus YYYY-MM-DD.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true;
    validateForm($_POST, $errors);
}

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Server-side Validation Form</title>
</head>
<body>
    <?php if ($submitted && empty($errors)): ?>
        <p style="color: green;">Form submitted successfully!</p>
    <?php elseif ($submitted): ?>
        <div style="color: red;">
            <?php foreach ($errors as $error): ?>
                <p><?php echo h($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo h($_SERVER['PHP_SELF']); ?>" method="post">
        <div>
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name"
                value="<?php echo isset($_POST['name']) ? h($_POST['name']) : ''; ?>">
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"
                value="<?php echo isset($_POST['email']) ? h($_POST['email']) : ''; ?>">
        </div>

        <div>
            <label for="website">Website:</label>
            <input type="url" id="website" name="website"
                value="<?php echo isset($_POST['website']) ? h($_POST['website']) : ''; ?>">
        </div>

        <div>
            <label for="ip">IP Address:</label>
            <input type="text" id="ip" name="ip"
                value="<?php echo isset($_POST['ip']) ? h($_POST['ip']) : ''; ?>">
        </div>

        <div>
            <label for="age">Umur:</label>
            <input type="number" id="age" name="age"
                value="<?php echo isset($_POST['age']) ? h($_POST['age']) : ''; ?>">
        </div>

        <div>
            <label for="height">Tinggi:</label>
            <input type="text" id="height" name="height"
                value="<?php echo isset($_POST['height']) ? h($_POST['height']) : ''; ?>">
        </div>

        <div>
            <label for="birthdate">Tanggal Lahir:</label>
            <input type="date" id="birthdate" name="birthdate"
                value="<?php echo isset($_POST['birthdate']) ? h($_POST['birthdate']) : ''; ?>">
        </div>

        <div>
            <input type="submit" value="Submit">
        </div>
    </form>
</body>
</html>
