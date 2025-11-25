<?php include 'header.php'; ?>

<style>
    .box {
        background: white;
        width: 600px;
        margin: 40px auto;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    }
</style>

<div class="box">
    <h2>Selamat Datang, <?= $_SESSION['nama']; ?></h2>
</div>
