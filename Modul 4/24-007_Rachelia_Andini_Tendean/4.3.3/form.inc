<form action="form.php" method="post">
    <label>Phone (10 - 15 digit):</label>
    <input type="text" name="phone" value="<?php echo $_POST['phone'] ?? ''; ?>"><br>

    <label>Email:</label>
    <input type="text" name="email" value="<?php echo $_POST['email'] ?? ''; ?>"><br>

    <label>Website URL:</label>
    <input type="text" name="website" value="<?php echo $_POST['website'] ?? ''; ?>"><br>

    <label>Umur (Number):</label>
    <input type="text" name="umur" value="<?php echo $_POST['umur'] ?? ''; ?>"><br>

    <label>Tanggal Lahir (YYYY-MM-DD):</label>
    <input type="text" name="birthdate" value="<?php echo $_POST['birthdate'] ?? ''; ?>"><br>

    <input type="submit" value="Submit">
</form>
