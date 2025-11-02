<form action="form.php" method="post">
  <label>username</label><br>
  <input type="text" name="username"><br><br>

  <label>email</label><br>
  <input type="email" name="email"><br><br>

  <label>Password</label><br>
  <input type="password" name="password"><br><br>

  <label>alamat</label><br>
  <textarea name="alamat"></textarea><br><br>

  <label>Semester</label><br>
  <select name="semester">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
  </select><br><br>

  <label>Country</label><br>
  <input type="hidden" name="country" value="Indonesia"><br>

  <label>Kelamin</label><br>
  <input type="radio" name="kelamin" value="laki_laki"> Laki-Laki
  <input type="radio" name="kelamin" value="perempuan"> Perempuan
  <br><br>

  <label>Hobi</label> <br>
  <input type="checkbox" name="hobi[]" value="mancing"> Mancing <br>
  <input type="checkbox" name="hobi[]" value="tidur" checked> Tidur
  <br><br>

  <input type="submit" value="submit"
         style="background-color: rgb(91, 91, 191); color: white; border: 0; border-radius: 3px; padding: 8px 10px;">
</form>
