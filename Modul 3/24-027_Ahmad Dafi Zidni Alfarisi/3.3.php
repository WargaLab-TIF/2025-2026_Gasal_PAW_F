<?php
$height = array("Andy"=>"176", "Barry"=>"165", "Charlie"=>"170");
$height["David"] = "180";
$height["Ethan"] = "172";
$height["Frank"] = "168";
$height["George"] = "175";
$height["Henry"] = "182";


end($height); 
echo current($height);
echo "<br><br>";
?>

<?php
$height = array(
    "Andy"=>"176", "Barry"=>"165", "Charlie"=>"170",
    "David"=>"180", "Ethan"=>"172", "Frank"=>"168",
    "George"=>"175", "Henry"=>"182"
);

unset($height["Barry"]);

end($height);
echo current($height);
echo "<br><br>";
?>

<?php
$weight = array("Andy"=>"70", "Barry"=>"65", "Charlie"=>"68");
$values = array_values($weight);
echo $values[1];
?>