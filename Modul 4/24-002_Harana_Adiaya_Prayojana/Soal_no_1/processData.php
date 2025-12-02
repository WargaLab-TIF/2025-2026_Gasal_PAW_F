<?php
  require "validate.inc";
  $err=[];
  validateName($_POST, "username",$err);
  if(!$err){
    echo "Nama Valid";
  }
  else{
    echo "Error:<ul>";
    foreach($err as $i){
      echo $i."</ul>";
    }
  }
  
?>
<form action="processData_form.html">
  <button>Kembali</button>
</form>