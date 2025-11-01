<?php
    echo "3.4.1 <br>";
        $height = array("andy" => "176", "bany" => "165", "charlie" => "170");
        $data_tambah = ["slamet" => "180", "supri" => "172", "jaenal" => "156", "bahlil" => "162", "maul" => "170"];
        $height = array_merge($height, $data_tambah);

        foreach($height as $x => $x_value){
            echo "key= ".$x.", value= ".$x_value;
            echo "<br>";
        }
        echo "<<br> <br> <br>";


        

     echo "3.4.2 <br>";
         $weigh = array("aldi" => "55", "arya" => "60", "arip" => "70");
         foreach($weigh as $x => $x_value){
            echo "key= ".$x.", value= ".$x_value;
            echo "<br>";
        }
