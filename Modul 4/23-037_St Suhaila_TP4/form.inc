<label>Surname</label>
<input
  type="text"
  name="surname"
  value="<?php 
if(isset($_POST['surname'])) echo 
htmlspecialchars($_POST['surname']) ?>"
/>
