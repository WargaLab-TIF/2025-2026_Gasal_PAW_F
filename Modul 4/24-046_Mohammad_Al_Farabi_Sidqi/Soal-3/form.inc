<h2>Form Input Data</h2>

    <form action="form.php" method="post">
        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" value="<?php if (isset($_POST['surname'])) echo htmlspecialchars($_POST['surname']); ?>">
        <span class="error"><?php echo $surname_err; ?></span>
        <br>
        <label for="usia">Usia:</label>
        <input type="text" id="usia" name="usia" value="<?php echo htmlspecialchars($_POST['usia']); ?>">
        <span class="error"><?php echo $usia_err; ?></span>
        <br>
        <label>Tanggal Lahir (DD-MM-YYYY):</label> <br>
        <input type="text" name="day" value="<?php if (isset($_POST['day'])) echo htmlspecialchars($_POST['day']); ?>">
        <input type="text" name="month" value="<?php if (isset($_POST['month'])) echo htmlspecialchars($_POST['month']); ?>">
        <input type="text" name="year" value="<?php if (isset($_POST['year'])) echo htmlspecialchars($_POST['year']); ?>">
        <span class="error"><?php echo $dob_err; ?></span>
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