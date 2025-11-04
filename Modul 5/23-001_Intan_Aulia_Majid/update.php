<?php
$conn = mysqli_connect("localhost", "root", "", "store");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $telp = $_POST["telp"];
    $alamat = $_POST["alamat"];

    if (empty($nama)) {
        $error .= "Nama tidak boleh kosong.<br>";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        $error .= "Nama hanya boleh huruf.<br>";
    }

    if (empty($telp)) {
        $error .= "Nomor telepon tidak boleh kosong.<br>";
    } elseif (!preg_match("/^[0-9]+$/", $telp)) {
        $error .= "Nomor telepon hanya boleh angka.<br>";
    }

    if (empty($alamat)) {
        $error .= "Alamat tidak boleh kosong.<br>";
    } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*[0-9])[A-Za-z0-9\s]+$/", $alamat)) {
        $error .= "Alamat harus berisi huruf dan angka (alfanumerik).<br>";
    }

    if ($error == "") {
        $sql = "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            header("location: index.php");
            exit();
        } else {
            $error = "Gagal menyimpan data.<br>";
        }
    } else {
        $error .= "Silakan periksa kembali input Anda.";
    }

} else {
    $id = $_GET['id'];
    $query = "SELECT * FROM supplier WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    $nama = $data['nama'];
    $telp = $data['telp'];
    $alamat = $data['alamat'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Supplier</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-xl font-semibold text-gray-700 mb-4 text-center">Edit Data Supplier</h2>

        <?php if (!empty($error)): ?>
            <div class="bg-red-100 text-red-700 border border-red-300 rounded p-3 mb-4 text-sm">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="update.php" method="POST" class="space-y-4">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama</label>
                <input type="text" name="nama" value="<?php echo $nama; ?>" 
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Telp</label>
                <input type="text" name="telp" value="<?php echo $telp; ?>" 
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Alamat</label>
                <input type="text" name="alamat" value="<?php echo $alamat; ?>" 
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="flex justify-between items-center mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Update
                </button>
                <a href="index.php" class="text-gray-600 hover:text-gray-800">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
