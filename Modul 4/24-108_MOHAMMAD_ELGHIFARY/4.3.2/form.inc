<form action="processData_form.php" method="post">
    
    <label for="username">Username</label><br>
    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
    <?php if (isset($errors['username'])) echo '<br><span class="error-field">' . htmlspecialchars($errors['username']) . '</span>'; ?>
    <br><br>

    <label for="Email_address">Email</label><br>
    <input type="email" id="Email_address" name="Email_address" value="<?php echo htmlspecialchars($email); ?>">
    <?php if (isset($errors['Email_address'])) echo '<br><span class="error-field">' . htmlspecialchars($errors['Email_address']) . '</span>'; ?>
    <br><br>

    <label for="Password">Password</label><br>
    <input type="password" id="Password" name="Password" value="<?php echo htmlspecialchars($password); ?>">
    <?php if (isset($errors['Password'])) echo '<br><span class="error-field">' . htmlspecialchars($errors['Password']) . '</span>'; ?>
    <br><br>

    <label for="Street_Address">Alamat</label><br>
    <textarea id="Street_Address" name="Street_Address"><?php echo htmlspecialchars($address); ?></textarea>
    <?php if (isset($errors['Street_Address'])) echo '<br><span class="error-field">' . htmlspecialchars($errors['Street_Address']) . '</span>'; ?>
    <br><br>

    <label for="state">State:</label>
    <select id="state" name="state">
        <option value="">-- Pilih State --</option>
        <option value="jawa-timur" <?php if ($state == 'jawa-timur') echo 'selected'; ?>>Jawa Timur</option>
        <option value="jawa-tengah" <?php if ($state == 'jawa-tengah') echo 'selected'; ?>>Jawa Tengah</option>
        <option value="jawa-barat" <?php if ($state == 'jawa-barat') echo 'selected'; ?>>Jawa Barat</option>
        <option value="bali" <?php if ($state == 'bali') echo 'selected'; ?>>Bali</option>
    </select>
    <?php if (isset($errors['state'])) echo '<br><span class="error-field">' . htmlspecialchars($errors['state']) . '</span>'; ?>
    <br><br>

    <label for="country">Country</label>
    <input type="hidden" id="country" name="country" value="Indonesia"><br><br>

    <label>Kelamin</label><br>
    <input type="radio" id="Laki-Laki" name="gender" value="Laki-Laki" <?php if ($gender == 'Laki-Laki') echo 'checked'; ?>>
    <label for="Laki-Laki">Laki-Laki</label>
    <input type="radio" id="Perempuan" name="gender" value="Perempuan" <?php if ($gender == 'Perempuan') echo 'checked'; ?>>
    <label for="Perempuan">Perempuan</label>
    <?php if (isset($errors['gender'])) echo '<br><span class="error-field">' . htmlspecialchars($errors['gender']) . '</span>'; ?>
    <br><br>

    <label>Hobi:</label><br>
    <input type="checkbox" id="Mancing" name="hobby[]" value="Mancing" <?php if (in_array('Mancing', $hobby)) echo 'checked'; ?>>
    <label for="Mancing">Mancing</label><br>
    <input type="checkbox" id="Tidur" name="hobby[]" value="Tidur" <?php if (in_array('Tidur', $hobby)) echo 'checked'; ?>>
    <label for="Tidur">Tidur</label>
    <?php if (isset($errors['hobby'])) echo '<br><span class="error-field">' . htmlspecialchars($errors['hobby']) . '</span>'; ?>
    <br><br>

    <input type="submit" name="submit" value="Submit">
</form>