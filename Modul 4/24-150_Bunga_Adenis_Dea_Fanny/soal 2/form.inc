<form action="processData_form.php" method="post">
    
    <p>
      <label>surname:</label><br>
      <input type="text" name="surname" value="<?= $surname ?>">
    </p>

    <p>
      <label>Email address:</label><br>
      <input type="email" name="email" value="<?= $email ?>">
    </p>

    <p>
      <label>Password:</label><br>
      <input type="password" name="password" value="<?= $password ?>">
    </p>

    <p>
      <label>Street Address:</label><br>
      <textarea name="street" rows="3" cols="35"><?= $street ?></textarea>
    </p>

    <p>
      <label>State:</label><br>
      <select name="state">
        <option value="">-----pilih-----</option>
        <option <?= ($state=='Jawa Timur')?'selected':'' ?>>Jawa Timur</option>
        <option <?= ($state=='Jawa Tengah')?'selected':'' ?>>Jawa Tengah</option>
        <option <?= ($state=='Jawa Barat')?'selected':'' ?>>Jawa Barat</option>
        <option <?= ($state=='DKI Jakarta')?'selected':'' ?>>DKI Jakarta</option>
        <option <?= ($state=='Bali')?'selected':'' ?>>Bali</option>
      </select>
    </p>

    <input type="hidden" name="country" value="<?= $country ?>">

    <p>
      <label>Gender:</label><br>
      <label><input type="radio" name="gender" value="Female" <?= ($gender=='Female')?'checked':'' ?>> Female</label>
      <label><input type="radio" name="gender" value="Male" <?= ($gender=='Male')?'checked':'' ?>> Male</label>
    </p>

    <p>
      <label>Hobi:</label><br>
      <label><input type="checkbox" name="hobi[]" value="abisin duit" <?= (is_array($hobi) && in_array('abisin duit',$hobi))?'checked':'' ?>> abisin duit</label><br>
      <label><input type="checkbox" name="hobi[]" value="liat tiktok" <?= (is_array($hobi) && in_array('liat tiktok',$hobi))?'checked':'' ?>> liat tiktok</label>
    </p>

    <p><button type="submit">Kirim</button></p>
</form>
