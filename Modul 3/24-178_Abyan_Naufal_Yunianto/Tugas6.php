<?php
    echo "<b>Eksplor 3.6. fungsi php </b><br>";
    $mahasiswa = [
    'nama' => 'Budi',
    'usia' => 20,
    'kota' => 'Jakarta'
    ];

    $nilai_siswa = [85, 90, 78, 92];

    $data_baru = [
        'email' => 'budi@mail.com',
        'prodi' => 'Teknik'
    ];

    echo "<br>";
    echo "<b>Eksplor 3.6.1. array_push()</b><br>";
    
        $buah = ['Apel', 'Jeruk'];

        // Menambahkan satu atau lebih elemen ke akhir array
        array_push($buah, 'Mangga', 'Pisang');

        print_r($buah);

    echo "<br><br>";
    echo "<b>Implementasi 3.6.2. array_merge()</b><br>";

        // Menggabungkan array asosiatif ($mahasiswa dan $data_baru)
        $gabung = array_merge($mahasiswa, $data_baru);

        print_r($gabung);

    echo "<br><br>";
    echo "<b>Implementasi 3.6.3. array_values()</b><br>";

        // Mengambil nilai dari array asosiatif $mahasiswa
        $nilai = array_values($mahasiswa);

        print_r($nilai);

    
    echo "<br><br>";
    echo "<b>Implementasi 3.6.4. array_search()</b><br>";

        // Mencari key dari 'Jakarta' di array $mahasiswa
        $kunci_ditemukan = array_search('Jakarta', $mahasiswa);
        echo $kunci_ditemukan;

    echo "<br><br>";
    echo "<b>Implementasi 3.6.5. array_filter()</b><br>";

        // Mencari nilai yang lebih besar dari 80 di array $nilai_siswa
        $nilai_lulus = array_filter($nilai_siswa, function($nilai) {
            return $nilai > 80;
        });

        print_r($nilai_lulus);

    echo "<br><br>";
    echo "<b>Implementasi 3.6.6. sorting array(sort(),rsort(),asort(),ksort())</b><br>";

        $buah_unsorted = ['Mangga', 'Apel', 'Pisang', 'Jeruk'];
        $data_asosiatif = ['c' => 30, 'a' => 10, 'b' => 20];

        // 1. sort() - Mengurutkan array numerik berdasarkan nilai
        $buah_sort = $buah_unsorted;
        sort($buah_sort);
        echo "sort(): ";
        print_r($buah_sort); 

        // 2. rsort() - Mengurutkan array numerik berdasarkan nilai (terbalik)
        $buah_rsort = $buah_unsorted;
        rsort($buah_rsort);
        echo "<br>rsort(): ";
        print_r($buah_rsort);

        // 3. asort() - Mengurutkan array asosiatif berdasarkan NILAI (mempertahankan kunci)
        $data_asort = $data_asosiatif;
        asort($data_asort);
        echo "<br>asort(): ";
        print_r($data_asort);

        // 4. ksort() - Mengurutkan array asosiatif berdasarkan KUNCI
        $data_ksort = $data_asosiatif;
        ksort($data_ksort);
        echo "<br>ksort(): ";
        print_r($data_ksort); 
        
?>