    <form method="POST" action="processData_form.php">
            <br> <br>
            <label for="username">username</label><br>
            <input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"><br><br>

            <label for="email">email</label><br>
            <input type="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"><br><br>

            <label for="password">password</label><br>
            <input type="password" name="password" value="<?php echo $_POST['password']; ?>"><br><br>

            <label for="alamat">alamat</label><br>
            <textarea name="alamat" id="alamat"><?php echo htmlspecialchars($_POST['alamat'] ?? ''); ?></textarea><br><br>

            <label for="semester">semester</label><br>
            <select id="semester" name="semester" style="width: 167px">
              <?php
              $semester = $_POST['semester'] ?? '';
              for ($i = 1; $i <= 8; $i++) {
                $pilih = ($semester == $i) ? 'selected' : '';
                echo "<option value='$i' $pilih>$i</option>";
              }
              ?>
            </select><br><br>

            <label for="country">country</label>
            <input type="hidden" name="country" value="Indonesia"> <br><br>

            <label for="kelamin">kelamin</label><br>
            <label style="margin-right: 5px;"><input type="radio" name="kelamin" value="laki-laki"
              <?php echo (($_POST['kelamin'] ?? '') == 'laki-laki') ? 'checked' : ''; ?>> laki-laki</label>
            <label><input type="radio" name="kelamin" value="perempuan"
              <?php echo (($_POST['kelamin'] ?? '') == 'perempuan') ? 'checked' : ''; ?>> perempuan</label><br><br>
            
            <label for="hobi">hobi</label><br>
            <label><input type="radio" name="hobby" value="mancing"
              <?php echo (($_POST['hobby'] ?? '') == 'mancing') ? 'checked' : ''; ?>>mancing</label><br>
            <label><input type="radio" name="hobby" value="tidur"
              <?php echo (($_POST['hobby'] ?? '') == 'tidur') ? 'checked' : ''; ?>> tidur</label><br>
            <label><input type="radio" name="hobby" value="mandi"
              <?php echo (($_POST['hobby'] ?? '') == 'mandi') ? 'checked' : ''; ?>> mandi</label><br><br>


            <button>submit</button>
        </form>