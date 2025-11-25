<form action="pelanggan_tambah_proses.php" method="post">
    <h2>Tambah Pelanggan</h2>

    ID <br>
    <input type="text" name="id" required><br><br>

    Nama <br>
    <input type="text" name="nama" required><br><br>

    Jenis Kelamin <br>
    <select name="jenis_kelamin">
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
    </select><br><br>

    Telepon <br>
    <input type="text" name="telp" required><br><br>

    Alamat <br>
    <textarea name="alamat" required></textarea><br><br>

    <button type="submit">Simpan</button>
</form>

<a href="pelanggan.php">Kembali</a>
