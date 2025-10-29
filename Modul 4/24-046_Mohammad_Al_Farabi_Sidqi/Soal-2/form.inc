<h2>Form Input Data</h2>

    <form action="form.php" method="post">
        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" value="<?php if (isset($_POST['surname'])) echo htmlspecialchars($_POST['surname']); ?>">
        <span class="error"><?php echo $surname_err; ?></span>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php if (isset($_POST['email'])) echo htmlspecialchars($email); ?>">
        <span class="error"><?php echo $email_err; ?></span>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php if (isset($_POST['password'])) echo $password; ?>">
        <span class="error"><?php echo $password_err; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Kirim">
    </form>