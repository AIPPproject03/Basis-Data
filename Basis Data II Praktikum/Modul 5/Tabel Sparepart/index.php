<?php
session_start(); // Mulai session

include 'connection.php'; // Sertakan file koneksi database
include 'create.php'; // Sertakan file create.php
include 'delete.php'; // Sertakan file delete.php
include 'edit.php'; // Sertakan file edit.php

// Tangani pesan sukses
if (isset($_GET['success'])) {
    $success_message = "";
    switch ($_GET['success']) {
        case 'create':
            $success_message = "Data sparepart berhasil ditambahkan";
            break;
        case 'delete':
            $success_message = "Data sparepart berhasil dihapus";
            break;
        case 'edit':
            $success_message = "Data sparepart berhasil diubah";
            break;
        default:
            break;
    }
    echo "<h3 style='color: green;'>$success_message</h3>";
}

// Tangani pesan error
if (isset($_GET['error'])) {
    echo "<h3 style='color: red;'>Gagal: " . urldecode($_GET['error']) . "</h3>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Sparepart</title>
</head>

<body>

    <!-- FORM CREATE -->
    <form action="index.php" method="post">
        <h2>Tambah Sparepart</h2>
        <input type="text" name="ID_Sparepart" placeholder="ID Sparepart">
        <input type="text" name="Nama_Sparepart" placeholder="Nama Sparepart">
        <input type="number" name="Stok" placeholder="Stok">
        <input type="text" name="Jenis_Sparepart" placeholder="Jenis Sparepart">
        <input type="number" name="Harga" placeholder="Harga">
        <input type="submit" name="create_sparepart" value="Tambah Sparepart">
    </form>

    <!-- FORM DELETE -->
    <form action="index.php" method="post">
        <h2>Hapus Sparepart</h2>
        <input type="text" name="delete_ID_Sparepart" placeholder="ID Sparepart to Delete">
        <input type="submit" name="delete_sparepart" value="Hapus Sparepart">
    </form>

    <!-- FORM EDIT -->
    <form action="index.php" method="post">
        <h2>Edit Sparepart</h2>
        <input type="text" name="edit_ID_Sparepart" placeholder="ID Sparepart to Edit">
        <input type="text" name="edit_Nama_Sparepart" placeholder="Nama Sparepart">
        <input type="number" name="edit_Stok" placeholder="Stok">
        <input type="text" name="edit_Jenis_Sparepart" placeholder="Jenis Sparepart">
        <input type="number" name="edit_Harga" placeholder="Harga">
        <input type="submit" name="edit_sparepart" value="Edit Sparepart">
    </form>

    <!-- TABEL SPAREPART -->
    <h2>Daftar Sparepart</h2>
    <table border="1">
        <tr>
            <th>ID Sparepart</th>
            <th>Nama Sparepart</th>
            <th>Stok</th>
            <th>Jenis Sparepart</th>
            <th>Harga</th>
        </tr>
        <?php
        // Query untuk mengambil data dari tabel Sparepart
        $sql = "SELECT * FROM Sparepart";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID_Sparepart'] . "</td>";
                echo "<td>" . $row['Nama_Sparepart'] . "</td>";
                echo "<td>" . $row['Stok'] . "</td>";
                echo "<td>" . $row['Jenis_Sparepart'] . "</td>";
                echo "<td>" . $row['Harga'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data sparepart</td></tr>";
        }
        ?>
    </table>
</body>

</html>