<?php

use Dom\Mysql;

require_once "../../core/conn.php";
require_once "../module/helper.php";
session_start();

if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"] ?? "";
    $telp = $_POST["telp"] ?? "";
    $jenis_kelamin = $_POST["jenis_kelamin"] ?? "";
    $alamat = $_POST["alamat"] ?? "";
    $id = $_POST["id"] ?? "";

    if (!empty($id)) {
        $update_pelanggan = "
            UPDATE pelanggan 
            SET nama = '$nama',
                jenis_kelamin = '$jenis_kelamin',
                telp = '$telp',
                alamat = '$alamat'
            WHERE id = '$id'
        ";

        try {
            if (mysqli_query($conn, $update_pelanggan)) {
                $_SESSION["notif"] = [];
                $_SESSION["notif"]["judul"] = "Berhasil Mengedit";
                $_SESSION["notif"]["pesan"] = "Berhasil Mengedit Data Pelanggan";
                header("Location: ../../pelanggan_detail.php?id=$id");
                exit;
            } else {
                $_SESSION["notif"] = [];
                $_SESSION["notif"]["judul"] = "Gagal Mengedit";
                $_SESSION["notif"]["pesan"] = "Gagal Mengedit Data Pelanggan";
                header("Location: ../../pelanggan_detail.php?id={$id}");
                exit;
            }
        } catch (Exception $err) {
            $_SESSION["notif"] = [];
            $_SESSION["notif"]["judul"] = "Gagal Mengedit";
            $_SESSION["notif"]["pesan"] = "Gagal Mengedit Data Pelanggan";
            header("Location: ../../pelanggan_detail.php?id={$id}");
            exit;
        }

    } else {
        $id = generateRandomString();

        $create_pelanggan = "
            INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat)
            VALUES ('$id', '$nama', '$jenis_kelamin', '$telp', '$alamat')
        ";

        try {
            if (mysqli_query($conn, $create_pelanggan)) {
                $_SESSION["notif"] = [];
                $_SESSION["notif"]["judul"] = "Berhasil Menambah";
                $_SESSION["notif"]["pesan"] = "Berhasil Menambah Data Pelanggan";
                header("Location: /MasterDetail/pelanggan_detail.php?id=$id");
                exit;
            } else {
                $_SESSION["notif"] = [];
                $_SESSION["notif"]["judul"] = "Gagal Menambah";
                $_SESSION["notif"]["pesan"] = "Gagal Menambah Data Pelanggan";
                header("Location: /MasterDetail/pelanggan_detail.php");
                exit;
            }
        } catch (Exception $err) {
            $_SESSION["notif"] = [];
            $_SESSION["notif"]["judul"] = "Gagal Menambah";
            $_SESSION["notif"]["pesan"] = "Gagal Menambah Data Pelanggan";
            header("Location: /MasterDetail/pelanggan_detail.php");
            exit;
        }
    }
}

if (isset($_GET["delete"]) && isset($_GET["id"]) && $_GET["delete"] == "true" && $_SERVER["REQUEST_METHOD"] == "GET") {
    $pelanggan = "SELECT id FROM pelanggan WHERE id = '{$_GET['id']}'";
    if ($query_pel = mysqli_query($conn, $pelanggan)) {
        if (mysqli_fetch_assoc($query_pel)) {
            try {
                $delete_sql = "DELETE FROM pelanggan WHERE id = '{$_GET["id"]}'";
                mysqli_query($conn, $delete_sql);
                $_SESSION["notif"] = [];
                $_SESSION["notif"]["judul"] = "Berhasil Hapus Data";
                $_SESSION["notif"]["pesan"] = "Berhasil Hapus Data Pelanggan";
            } catch (Exception $err) {
                $_SESSION["notif"] = [];
                $_SESSION["notif"]["judul"] = "Gagal Hapus Data";
                $_SESSION["notif"]["pesan"] = "Gagal Hapus Data Pelanggan";
            }

            header("Location: /MasterDetail/pelanggan.php");
            exit;
        }
    }
}
