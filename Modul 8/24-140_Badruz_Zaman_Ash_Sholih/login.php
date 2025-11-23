<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "penjualan");

if (isset($_SESSION['user']) && isset($_SESSION['level'])) {
    header("Location: owner.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['pass']);

    $query = "SELECT * FROM user WHERE username = ? AND password = ? ";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "ss", $username, $password);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);


    $data = mysqli_fetch_assoc($result);
    if ($data) {
        $_SESSION['user']  = $data['username'];
        $_SESSION['level'] = $data['level'];

        if ($data['level'] == 1) {
            header("Location: owner.php");
        } else if ($data['level'] == 2) {
            header("Location: kasir.php");
        }
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: verdana;
            background: #f2f4f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background: white;
            padding: 25px 30px;
            width: 300px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-size: 14px;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: 0.2s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border: 1px solid #007BFF;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            background: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <?php if (!empty($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <h3> Login </h3>
        <form action="" method="post">
            <label for="username">Username :</label>
            <input type="text" name="username" placeholder="Username"> <br>

            <label for="pass">Password :</label>
            <input type="password" name="pass" placeholder="Password"> <br>

            <input type="submit" value="Login">
        </form>
    </div>
</body>

</html>