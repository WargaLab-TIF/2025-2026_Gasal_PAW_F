<?php
    session_start();
    require_once('./include/conn.php');
    require_once('./include/validate.php');

    

    $err=[];
    $status=False;

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $userLama = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

        [$ok,$e] = validasi_username($username,$koneksi);if(!$ok){ $err['username']= $e;}
        [$ok,$e] = validasi_password($password,$username,$koneksi);if(!$ok){ $err['password']= $e;}

        $passM=md5($password);
        $query="SELECT * FROM user WHERE username = ? AND password=?";

        // $ex=mysqli_query($koneksi,$query);
        $state=mysqli_prepare($koneksi,$query);
        mysqli_stmt_bind_param($state,"ss",$username,$passM);
        mysqli_stmt_execute($state);
        $ex=mysqli_stmt_get_result($state);

        if(mysqli_num_rows($ex)>0){
            $result=mysqli_fetch_array($ex);
            $_SESSION['username']=$username;
            header("location:index.php");
            exit;
            }
    }
?> 
<!doctype html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <main class="layout">
    <h2>LOGIN</h2>
    <h3 style="color:red;"><?php if(isset($_SESSION['pesan'])){
        echo $_SESSION['pesan'];
    }?>
    <h2><?php if(isset($_SESSION['temp'])){
        echo "Hanya Owner yang dapat melihat data";
    }?></h2>
    <table> 
        <form method="post" action="">
            <tr>
                <td>Username</td>
                <td>
                    <label>
                        <input type="text" name="username" value="<?php if(isset($userLama)){echo $userLama;}?>">
                        <?php if(!empty($err['username'])){echo "<br><small style=color:red>".$err['username']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <label>
                        <input type="password" name="password">
                        <?php if(!empty($err['password'])){ echo "<br><small style=color:red>".$err['password']."</small>";}?>
                    </label>
                </td>
            </tr>
            <tr>
                <td></td><td></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class="detail">login</button>
                </td>
            </tr>
        </form>
    </table>
    </main>
</body>
</html>