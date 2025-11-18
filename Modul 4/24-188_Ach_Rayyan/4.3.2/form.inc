<?php
?>
<form action="ProcesData_form.php" method="post">
  Username: <br>
  <input type="text" name="username"
         value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
  <br><br>

  Email: <br>
  <input type="text" name="email"
         value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
  <br><br>

  Password: <br>
  <input type="password" name="password">
  <br><br>

  <input type="submit" value="Submit"
         style="background-color: rgb(74, 48, 221); color: white; padding: 10px 20px; border: none; cursor: pointer;">
</form>
