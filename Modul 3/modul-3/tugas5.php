<?php
    echo "3.5.1 <br>";
    $students = array(
        array("Alex", "220401", "0812345678"),
        array("Bianca", "220402", "0812345687"),
        array("Candice", "220403", "0812345665")
    );
    $data_tambah = array(
        array("dodit", "220404", "0812345671"),
        array("asif", "220405", "0812345682"),
        array("bagus", "220406", "0812345663"),
        array("nizam", "220407", "0812345664"),
        array("wahyu", "220408", "0812345665"),
    );
    $students = array_merge($students,$data_tambah);
    echo"saya sudah menambahakn 5 data baru pada array <br> <br> <br>";

    

    

    echo "3.5.2 <br>";
    echo "menampilkan data array dalam bentuk tabel : ";
    echo "<table border=1>";
        echo "<tr>";
            echo "<td>Nama</td>";
            echo "<td>NIM</td>";
            echo "<td>Mobile</td>";
        echo "</tr>";
        foreach($students as $a){
            echo"<tr>";
            foreach($a as $data){
                echo "<td>".$data."</td>";
            }
            echo"</tr>";
        }
    echo "</table>";
