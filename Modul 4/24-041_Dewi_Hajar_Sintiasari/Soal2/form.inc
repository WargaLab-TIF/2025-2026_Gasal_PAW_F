<form action="processData_form.php" method="post">
    <label for="surname">username</label><br>
    <input type="text" name="surname" id="surname" value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>"><br><br>

    <label for="email">email</label><br>
    <input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"><br><br>

    <label for="password">Password</label><br>
    <input type="password" name="password" id="password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>"><br><br>

    <label for="alamat">alamat</label><br>
    <textarea name="alamat" id="alamat" rows="3"><?php echo isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : ''; ?></textarea><br><br>
    
    <label for="gender">Kelamin</label><br>
    <input type="radio" name="gender" id="laki" value="Laki-Laki" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Laki-Laki') ? 'checked' : ''; ?>>
    <label for="laki">Laki-Laki</label>
    <input type="radio" name="gender" id="perempuan" value="Perempuan" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Perempuan') ? 'checked' : ''; ?>>
    <label for="perempuan">Perempuan</label><br><br>

    <label for="hobi">Hobi</label><br>
    <input type="checkbox" name="hobi[]" id="mancing" value="Mancing" <?php echo (isset($_POST['hobi']) && in_array('Mancing', $_POST['hobi'])) ? 'checked' : ''; ?>>
    <label for="mancing">Mancing</label><br>
    <input type="checkbox" name="hobi[]" id="tidur" value="Tidur" checked <?php echo (isset($_POST['hobi']) && in_array('Tidur', $_POST['hobi'])) ? 'checked' : ''; ?>>
    <label for="tidur">Tidur</label><br>

    <label for="submit"></label><br>
    <input type="submit" name="submit" id="submit" value="Submit" style="background-color: blue; color: white; border: 0px; border-radius: 3px; padding: 8px 10px;">
</form>