<form method="POST" action="">
  <div>
    <label for="nama">Nama</label><br>
    <input
      type="text"
      id="nama"
      name="nama"
      value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>"
    />
    <?php
    if (!empty($errors['nama'])) {
      echo '<div style="color:red">' . htmlspecialchars($errors['nama']) . '</div>';
    }
    ?>
  </div>

  <div>
    <label for="email">Email</label><br>
    <input
      type="text"
      id="email"
      name="email"
      value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
    />
    <?php
    if (!empty($errors['email'])) {
      echo '<div style="color:red">' . htmlspecialchars($errors['email']) . '</div>';
    }
    ?>
  </div>

  <div>
    <label for="age">Umur</label><br>
    <input
      type="text"
      id="age"
      name="age"
      value="<?= htmlspecialchars($_POST['age'] ?? '') ?>"
    />
    <?php
    if (!empty($errors['age'])) {
      echo '<div style="color:red">' . htmlspecialchars($errors['age']) . '</div>';
    }
    ?>
  </div>

  <button type="submit">Kirim</button>
</form>
