<?php?>

<form action="form.php" method="post" novalidate>
    
    <div>
        <label for="username">username</label>
        <input type="text" id="username" name="username" required value="<?php echo $username; ?>" />
    </div>
    
    <div>
        <label for="surname">Surname</label>
        <input type="text" id="surname" name="surname" required value="<?php echo $surname; ?>" />
    </div>

    <div>
        <label for="email">email</label>
        <input type="email" id="email" name="email" required value="<?php echo $email; ?>" />
    </div>

    <div>
        <label for="password">password</label>
        <input type="password" id="password" name="password" required value="<?php echo $password; ?>" />
    </div>

    <div>
        <label for="alamat">alamat</label>
        <textarea id="alamat" name="alamat" rows="4"><?php echo $alamat; ?></textarea>
    </div>

    <div>
        <label for="semester">semester</label>
        <select id="semester" name="semester">
            <option value="">-- Pilih Semester --</option>
            <option value="1" <?php if ($semester == '1') echo 'selected'; ?>>1</option>
            <option value="2" <?php if ($semester == '2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if ($semester == '3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if ($semester == '4') echo 'selected'; ?>>4</option>
        </select>
    </div>

    <label for="country">Country</label>
    <input type="hidden" name="country" value="Indonesia" />

    <div>
        <label>Kelamin</label>
        <input type="radio" id="pria" name="kelamin" value="laki-laki" required <?php if ($kelamin == 'laki-laki') echo 'checked'; ?> />
        <label for="pria" class="inline-label">laki-laki</label>

        <input type="radio" id="perempuan" name="kelamin" value="perempuan" <?php if ($kelamin == 'perempuan') echo 'checked'; ?> />
        <label for="perempuan" class="inline-label">perempuan</label>
    </div>

    <div>
        <label>Hobi</label>
        <input type="checkbox" id="tidur" name="hobi[]" value="tidur" <?php if (in_array('tidur', $hobi)) echo 'checked'; ?> />
        <label for="tidur">Tidur</label>

        <input type="checkbox" id="musik" name="hobi[]" value="musik" <?php if (in_array('musik', $hobi)) echo 'checked'; ?> />
        <label for="musik">Musik</label>
    </div>

    <div>
        <button type="submit">Submit</button>
    </div>
    
</form>