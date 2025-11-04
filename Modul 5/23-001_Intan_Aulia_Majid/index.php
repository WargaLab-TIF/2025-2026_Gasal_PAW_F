<?php

$conn = mysqli_connect("localhost", "root", "", "store");

$query = "SELECT * FROM supplier";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4 text-center">Data Master Supplier</h2>
        
        <div class="flex justify-end mb-4">
            <a href="create.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Tambah Data</a>
        </div>

        <table class="w-full border border-gray-300 text-sm text-gray-700">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-3 py-2">No</th>
                    <th class="border border-gray-300 px-3 py-2">Nama</th>
                    <th class="border border-gray-300 px-3 py-2">Telp</th>
                    <th class="border border-gray-300 px-3 py-2">Alamat</th>
                    <th class="border border-gray-300 px-3 py-2">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0 ?>
                <?php foreach($data as $row): ?>
                    <?php $no += 1 ?>
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-3 py-2 text-center"><?php echo $no ?></td>
                        <td class="border border-gray-300 px-3 py-2"><?php echo $row["nama"] ?></td>
                        <td class="border border-gray-300 px-3 py-2"><?php echo $row["telp"] ?></td>
                        <td class="border border-gray-300 px-3 py-2"><?php echo $row["alamat"] ?></td>
                        <td class="border border-gray-300 px-3 py-2 text-center">
                            <a href="update.php?id=<?php echo $row['id']?>" class="text-yellow-600 hover:underline mr-2">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id']?>" onclick="return confirm('Anda yakin akan menghapus supplier ini?');" class="text-red-600 hover:underline">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?> 
            </tbody>
        </table>
    </div>
</body>
</html>
