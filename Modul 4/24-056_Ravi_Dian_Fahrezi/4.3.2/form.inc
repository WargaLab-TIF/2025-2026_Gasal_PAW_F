<form action="processData_form.php" method="POST">
    username <br>
    <input type="text" name="username" id="username" placeholder="Masukkan Nama" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
    <br><br>

    email <br>
    <input type="text" name="email" id="email" placeholder="Masukkan email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
    <br><br>

    Password <br>
    <input type="password" name="password" id="password" placeholder="Masukkan password">
    <br><br>

    <input type="submit" name="submit" value="Submit">
</form>
