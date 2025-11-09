    <form method="POST" action="processData_form.php">
            <label for="username">username</label><br>
            <input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"><br><br>

            <label for="email">Email:</label><br>
            <input type="" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"><br><br>

            <label for="umur">Umur:</label><br>
            <input type="text" name="umur" value="<?php echo htmlspecialchars($_POST['umur'] ?? ''); ?>"><br><br>

            <label for="website">Website:</label><br>
            <input type="text" name="website" value="<?php echo htmlspecialchars($_POST['website'] ?? ''); ?>"><br><br>

            <label for="tanggal">Tanggal Lahir:</label><br>
            <input type="text" name="tanggal" placeholder="dd-mm-yyyy" value="<?php echo htmlspecialchars($_POST['tanggal'] ?? ''); ?>"><br><br>

            <label for="password">password</label><br>
            <input type="password" name="password" value="<?php echo htmlspecialchars($_POST['password'] ?? ''); ?>"><br><br>

            <label for="negara">Negara</label><br>
            <input type="text" name="negara" value="<?php echo htmlspecialchars($_POST['negara'] ?? ''); ?>"> <br><br>
            
            <label for="float">Nilai Float</label><br>
            <input type="text" name="float" value="<?php echo htmlspecialchars($_POST['float'] ?? ''); ?>"> <br><br>

            <label for="ip">Alamat IP:</label><br>
            <input type="text" name="ip" value="<?php echo htmlspecialchars($_POST['ip'] ?? ''); ?>"><br><br>



            <button>submit</button><br><br><br>
        </form>