<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            color: #343a40;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .tambah-data {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .tambah-data:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #d9edf7;
            color: black;
        }

        td a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 3px;
            color: white;
        }

        .edit-btn {
            background-color: #d8560d;
        }

        .edit-btn:hover {
            background-color: #d8560d;
        }

        .hapus-btn {
            background-color: #dc3545;
        }

        .hapus-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Data User</h1>
            <a href="create.php" class="tambah-data">Tambah Data</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Level</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require "koneksi.php";
                $row = mysqli_query($koneksi, 'SELECT * FROM user');
                while ($data = mysqli_fetch_assoc($row)) {
                    echo "<tr>";
                    echo "<td>" . $data['id_user'] . "</td>";
                    echo "<td>" . $data['username'] . "</td>";
                    echo "<td>" . $data['nama'] . "</td>";
                    echo "<td>" . ($data['level'] == 1 ? "Admin" : "User Biasa") . "</td>";
                    echo "<td>";
                    echo "<a href='edit.php?id=" . $data['id_user'] . "' class='edit-btn'>Edit</a> ";
                    echo "<a href='delete.php?id=" . $data['id_user'] . "' onclick='return confirmDelete();' class='hapus-btn'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus data ini?");
    }
</script>

</html>
