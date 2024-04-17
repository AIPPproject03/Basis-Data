<?php
session_start(); // Mulai session

include 'connection.php'; // Sertakan file koneksi database
include 'create.php'; // Sertakan file create.php
include 'delete.php'; // Sertakan file delete.php
include 'edit.php'; // Sertakan file edit.php

// Pesan sukses dan error
$success_message = "";
$error_message = "";

// Tangani pesan sukses
if (isset($_GET['success'])) {
    $success_code = $_GET['success'];
    if ($success_code == 'create') {
        $success_message = "Data pembelian sparepart berhasil ditambahkan";
    } elseif ($success_code == 'edit') {
        $success_message = "Data pembelian sparepart berhasil diubah";
    } elseif ($success_code == 'delete') {
        $success_message = "Data pembelian sparepart berhasil dihapus";
    }
}

// Tangani pesan error
if (isset($_GET['error'])) {
    $error_message = "Gagal: " . urldecode($_GET['error']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pembelian Sparepart</title>
</head>

<body>

    <!-- Pesan Sukses -->
    <?php if ($success_message) : ?>
        <h3 style="color: green;"><?php echo $success_message; ?></h3>
    <?php endif; ?>

    <!-- Pesan Error -->
    <?php if ($error_message) : ?>
        <h3 style="color: red;"><?php echo $error_message; ?></h3>
    <?php endif; ?>

    <!-- FORM CREATE -->
    <form action="index.php" method="post">
        <h2>Tambah Pembelian Sparepart</h2>
        <input type="text" name="ID_Pembelian_Sparepart" placeholder="ID Pembelian Sparepart">
        <select name="ID_Transaksi">
            <?php
            // Query untuk mengambil data id_transaksi dari tabel Transaksi
            $sql = "SELECT ID_Transaksi FROM Transaksi";
            $result = $conn->query($sql);

            // Loop untuk menampilkan opsi select
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['ID_Transaksi'] . "'>" . $row['ID_Transaksi'] . "</option>";
            }
            ?>
        </select>
        <select name="ID_Sparepart">
            <?php
            // Query untuk mengambil data id_sparepart dari tabel Sparepart
            $sql = "SELECT ID_Sparepart FROM Sparepart";
            $result = $conn->query($sql);

            // Loop untuk menampilkan opsi select
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['ID_Sparepart'] . "'>" . $row['ID_Sparepart'] . "</option>";
            }
            ?>
        </select>
        <input type="number" name="Jumlah_Beli" placeholder="Jumlah Beli">
        <input type="submit" name="create_pembelian_sparepart" value="Tambah Pembelian Sparepart">
    </form>

    <!-- FORM DELETE -->
    <form action="index.php" method="post">
        <h2>Hapus Pembelian Sparepart</h2>
        <input type="text" name="delete_ID_Pembelian_Sparepart" placeholder="ID Pembelian Sparepart to Delete">
        <input type="submit" name="delete_pembelian_sparepart" value="Hapus Pembelian Sparepart">
    </form>

    <!-- FORM EDIT -->
    <form action="index.php" method="post">
        <h2>Edit Pembelian Sparepart</h2>
        <input type="text" name="edit_ID_Pembelian_Sparepart" placeholder="ID Pembelian Sparepart to Edit">
        <select name="edit_ID_Transaksi">
            <?php
            // Query untuk mengambil data id_transaksi dari tabel Transaksi
            $sql = "SELECT ID_Transaksi FROM Transaksi";
            $result = $conn->query($sql);

            // Loop untuk menampilkan opsi select
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['ID_Transaksi'] . "'>" . $row['ID_Transaksi'] . "</option>";
            }
            ?>
        </select>
        <select name="edit_ID_Sparepart">
            <?php
            // Query untuk mengambil data id_sparepart dari tabel Sparepart
            $sql = "SELECT ID_Sparepart FROM Sparepart";
            $result = $conn->query($sql);

            // Loop untuk menampilkan opsi select
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['ID_Sparepart'] . "'>" . $row['ID_Sparepart'] . "</option>";
            }
            ?>
        </select>
        <input type="number" name="edit_Jumlah_Beli" placeholder="Jumlah Beli">
        <input type="submit" name="edit_pembelian_sparepart" value="Edit Pembelian Sparepart">
    </form>

    <!-- TABEL PEMBELIAN SPAREPART -->
    <h2>Daftar Pembelian Sparepart</h2>
    <table border="1">
        <tr>
            <th>ID Pembelian Sparepart</th>
            <th>ID Transaksi</th>
            <th>ID Sparepart</th>
            <th>Jumlah Beli</th>
        </tr>
        <?php
        // Query untuk mengambil data dari tabel Pembelian_Sparepart
        $sql = "SELECT * FROM Pembelian_Sparepart";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID_Pembelian_Sparepart'] . "</td>";
                echo "<td>" . $row['ID_Transaksi'] . "</td>";
                echo "<td>" . $row['ID_Sparepart'] . "</td>";
                echo "<td>" . $row['Jumlah_Beli'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data pembelian sparepart</td></tr>";
        }
        ?>
    </table>

</body>

</html>