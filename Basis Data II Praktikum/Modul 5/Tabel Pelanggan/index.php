<?php
session_start(); // Mulai session

include 'connection.php';
include 'create.php';
include 'delete.php';
include 'edit.php';

// Jika ada parameter GET 'success', tampilkan pesan sukses
if (isset($_GET['success'])) {
    echo "<h3 style='color: green;'>Data pelanggan berhasil ditambahkan</h3>";
}

// Jika ada parameter GET 'error', tampilkan pesan error
if (isset($_GET['error'])) {
    echo "<h3 style='color: red;'>Gagal menambahkan data pelanggan</h3>";
}

// Jika ada parameter GET 'delete_success', tampilkan pesan penghapusan berhasil
if (isset($_GET['delete_success'])) {
    echo "<h3 style='color: green;'>Data pelanggan berhasil dihapus</h3>";
}

// Jika ada parameter GET 'delete_error', tampilkan pesan kesalahan penghapusan
if (isset($_GET['delete_error'])) {
    echo "<h3 style='color: red;'>Gagal menghapus data pelanggan. ID tidak sesuai atau tidak ditemukan</h3>";
}

// Jika ada parameter GET 'edit_success', tampilkan pesan sukses edit data
if (isset($_GET['edit_success'])) {
    echo "<h3 style='color: green;'>Data pelanggan berhasil diubah</h3>";
}

// Jika ada parameter GET 'edit_error', tampilkan pesan error edit data
if (isset($_GET['edit_error'])) {
    echo "<h3 style='color: red;'>Gagal mengubah data pelanggan</h3>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelanggan</title>
</head>

<body>

    <!-- CREATE FORM -->
    <form action="index.php" method="post">
        <h2>Tambah Pelanggan</h2>
        <input type="text" name="ID_Pelanggan" placeholder="ID Pelanggan">
        <input type="text" name="Nama_Pelanggan" placeholder="Nama Pelanggan">
        <input type="submit" name="pelanggan" value="Tambah Pelanggan">
    </form>

    <!-- DELETE FORM -->
    <form action="index.php" method="post">
        <h2>Hapus Pelanggan</h2>
        <input type="text" name="delete_ID_Pelanggan" placeholder="ID Pelanggan to Delete">
        <input type="submit" name="delete_pelanggan" value="Hapus Pelanggan">
    </form>

    <!-- EDIT FORM -->
    <form action="index.php" method="post">
        <h2>Edit Pelanggan</h2>
        <input type="text" name="edit_ID_Pelanggan" placeholder="ID Pelanggan to Edit">
        <input type="text" name="edit_Nama_Pelanggan" placeholder="Nama Pelanggan">
        <input type="submit" name="edit_pelanggan" value="Edit Pelanggan">
    </form>

    <!-- TABEL PELANGGAN -->
    <h2>Daftar Pelanggan</h2>
    <table border="1">
        <tr>
            <th>ID Pelanggan</th>
            <th>Nama Pelanggan</th>
        </tr>
        <?php
        $sql = "SELECT * FROM pelanggan";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID_Pelanggan'] . "</td>";
                echo "<td>" . $row['Nama_Pelanggan'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>0 results</td></tr>";
        }
        ?>

</body>

</html>