<?php
session_start(); // Mulai session

include 'connection.php';
include 'create.php';
include 'delete.php';
include 'edit.php';

// Jika ada parameter GET 'success', tampilkan pesan sukses
if (isset($_GET['success'])) {
    echo "<h3 style='color: green;'>Data jabatan berhasil ditambahkan</h3>";
}

// Jika ada parameter GET 'error', tampilkan pesan error
if (isset($_GET['error'])) {
    echo "<h3 style='color: red;'>Gagal menambahkan data jabatan</h3>";
}

// Jika ada parameter GET 'delete_success', tampilkan pesan penghapusan berhasil
if (isset($_GET['delete_success'])) {
    echo "<h3 style='color: green;'>Data jabatan berhasil dihapus</h3>";
}

// Jika ada parameter GET 'delete_error', tampilkan pesan kesalahan penghapusan
if (isset($_GET['delete_error'])) {
    echo "<h3 style='color: red;'>Gagal menghapus data jabatan. ID tidak sesuai atau tidak ditemukan</h3>";
}

// Jika ada parameter GET 'edit_success', tampilkan pesan sukses edit data
if (isset($_GET['edit_success'])) {
    echo "<h3 style='color: green;'>Data jabatan berhasil diubah</h3>";
}

// Jika ada parameter GET 'edit_error', tampilkan pesan error edit data
if (isset($_GET['edit_error'])) {
    echo "<h3 style='color: red;'>Gagal mengubah data jabatan</h3>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Jabatan</title>
</head>

<body>

    <!-- CREATE FORM -->
    <form action="index.php" method="post">
        <h2>Tambah Jabatan</h2>
        <input type="text" name="ID_Jabatan" placeholder="ID Jabatan">
        <input type="text" name="Nama_Jabatan" placeholder="Nama Jabatan">
        <input type="text" name="Gaji" placeholder="Gaji">
        <input type="submit" name="jabatan" value="Tambah Jabatan">
    </form>

    <!-- DELETE FORM -->
    <form action="index.php" method="post">
        <h2>Hapus Jabatan</h2>
        <input type="text" name="delete_ID_Jabatan" placeholder="ID Jabatan to Delete">
        <input type="submit" name="delete_jabatan" value="Hapus Jabatan">
    </form>

    <!-- EDIT FORM -->
    <form action="index.php" method="post">
        <h2>Edit Jabatan</h2>
        <input type="text" name="edit_ID_Jabatan" placeholder="ID Jabatan to Edit">
        <input type="text" name="edit_Nama_Jabatan" placeholder="Nama Jabatan">
        <input type="text" name="edit_Gaji" placeholder="Gaji">
        <input type="submit" name="edit_jabatan" value="Edit Jabatan">
    </form>

    <!-- VIEW TABLE -->
    <h2>Daftar Jabatan</h2>
    <table border="1">
        <tr>
            <th>ID Jabatan</th>
            <th>Nama Jabatan</th>
            <th>Gaji</th>
        </tr>
        <?php
        $query = "SELECT * FROM jabatan";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID_Jabatan'] . "</td>";
                echo "<td>" . $row['Nama_Jabatan'] . "</td>";
                echo "<td>" . $row['Gaji'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada data jabatan</td></tr>";
        }
        ?>

</body>

</html>