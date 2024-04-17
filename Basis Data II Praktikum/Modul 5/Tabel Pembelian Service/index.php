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
        $success_message = "Data pembelian service berhasil ditambahkan";
    } elseif ($success_code == 'edit') {
        $success_message = "Data pembelian service berhasil diubah";
    } elseif ($success_code == 'delete') {
        $success_message = "Data pembelian service berhasil dihapus";
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
    <title>Manajemen Pembelian Service</title>
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
        <h2>Tambah Pembelian Service</h2>
        <input type="text" name="ID_Pembelian_Service" placeholder="ID Pembelian Service">
        <!-- Select Dropdown untuk ID Transaksi -->
        <select name="ID_Transaksi">
            <?php
            // Query untuk mengambil data ID Transaksi dari tabel Transaksi
            $sql_transaksi = "SELECT ID_Transaksi FROM Transaksi";
            $result_transaksi = $conn->query($sql_transaksi);

            // Tampilkan opsi select untuk setiap ID Transaksi
            if ($result_transaksi->num_rows > 0) {
                while ($row_transaksi = $result_transaksi->fetch_assoc()) {
                    echo "<option value='" . $row_transaksi['ID_Transaksi'] . "'>" . $row_transaksi['ID_Transaksi'] . "</option>";
                }
            }
            ?>
        </select>
        <!-- Select Dropdown untuk ID Pegawai -->
        <select name="ID_Pegawai">
            <?php
            // Query untuk mengambil data ID Pegawai dari tabel Pegawai
            $sql_pegawai = "SELECT ID_Pegawai FROM Pegawai";
            $result_pegawai = $conn->query($sql_pegawai);

            // Tampilkan opsi select untuk setiap ID Pegawai
            if ($result_pegawai->num_rows > 0) {
                while ($row_pegawai = $result_pegawai->fetch_assoc()) {
                    echo "<option value='" . $row_pegawai['ID_Pegawai'] . "'>" . $row_pegawai['ID_Pegawai'] . "</option>";
                }
            }
            ?>
        </select>
        <!-- Select Dropdown untuk ID Service -->
        <select name="ID_Service">
            <?php
            // Query untuk mengambil data ID Service dari tabel Service
            $sql_service = "SELECT ID_Service FROM Service";
            $result_service = $conn->query($sql_service);

            // Tampilkan opsi select untuk setiap ID Service
            if ($result_service->num_rows > 0) {
                while ($row_service = $result_service->fetch_assoc()) {
                    echo "<option value='" . $row_service['ID_Service'] . "'>" . $row_service['ID_Service'] . "</option>";
                }
            }
            ?>
        </select>
        <input type="submit" name="create_pembelian_service" value="Tambah Pembelian Service">
    </form>

    <!-- FORM DELETE -->
    <form action="index.php" method="post">
        <h2>Hapus Pembelian Service</h2>
        <input type="text" name="delete_ID_Pembelian_Service" placeholder="ID Pembelian Service to Delete">
        <input type="submit" name="delete_pembelian_service" value="Hapus Pembelian Service">
    </form>

    <!-- FORM EDIT -->
    <form action="index.php" method="post">
        <h2>Edit Pembelian Service</h2>
        <!-- Select Dropdown untuk ID Pembelian Service -->
        <select name="edit_ID_Pembelian_Service">
            <?php
            // Query untuk mengambil data ID Pembelian Service dari tabel Pembelian_Service
            $sql_pembelian_service = "SELECT ID_Pembelian_Service FROM Pembelian_Service";
            $result_pembelian_service = $conn->query($sql_pembelian_service);

            // Tampilkan opsi select untuk setiap ID Pembelian Service
            if ($result_pembelian_service->num_rows > 0) {
                while ($row_pembelian_service = $result_pembelian_service->fetch_assoc()) {
                    echo "<option value='" . $row_pembelian_service['ID_Pembelian_Service'] . "'>" . $row_pembelian_service['ID_Pembelian_Service'] . "</option>";
                }
            }
            ?>
        </select>
        <!-- Select Dropdown untuk ID Transaksi -->
        <select name="edit_ID_Transaksi">
            <?php
            // Query untuk mengambil data ID Transaksi dari tabel Transaksi
            $sql_transaksi = "SELECT ID_Transaksi FROM Transaksi";
            $result_transaksi = $conn->query($sql_transaksi);

            // Tampilkan opsi select untuk setiap ID Transaksi
            if ($result_transaksi->num_rows > 0) {
                while ($row_transaksi = $result_transaksi->fetch_assoc()) {
                    echo "<option value='" . $row_transaksi['ID_Transaksi'] . "'>" . $row_transaksi['ID_Transaksi'] . "</option>";
                }
            }
            ?>
        </select>
        <!-- Select Dropdown untuk ID Pegawai -->
        <select name="edit_ID_Pegawai">
            <?php
            // Query untuk mengambil data ID Pegawai dari tabel Pegawai
            $sql_pegawai = "SELECT ID_Pegawai FROM Pegawai";
            $result_pegawai = $conn->query($sql_pegawai);

            // Tampilkan opsi select untuk setiap ID Pegawai
            if ($result_pegawai->num_rows > 0) {
                while ($row_pegawai = $result_pegawai->fetch_assoc()) {
                    echo "<option value='" . $row_pegawai['ID_Pegawai'] . "'>" . $row_pegawai['ID_Pegawai'] . "</option>";
                }
            }
            ?>
        </select>
        <!-- Select Dropdown untuk ID Service -->
        <select name="edit_ID_Service">
            <?php
            // Query untuk mengambil data ID Service dari tabel Service
            $sql_service = "SELECT ID_Service FROM Service";
            $result_service = $conn->query($sql_service);

            // Tampilkan opsi select untuk setiap ID Service
            if ($result_service->num_rows > 0) {
                while ($row_service = $result_service->fetch_assoc()) {
                    echo "<option value='" . $row_service['ID_Service'] . "'>" . $row_service['ID_Service'] . "</option>";
                }
            }
            ?>
        </select>
        <input type="submit" name="edit_pembelian_service" value="Edit Pembelian Service">
    </form>

    <!-- TABEL PEMBELIAN SERVICE -->
    <h2>Daftar Pembelian Service</h2>
    <table border="1">
        <tr>
            <th>ID Pembelian Service</th>
            <th>ID Transaksi</th>
            <th>ID Pegawai</th>
            <th>ID Service</th>
        </tr>
        <?php
        // Query untuk mengambil data dari tabel Pembelian_Service
        $sql = "SELECT * FROM Pembelian_Service";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID_Pembelian_Service'] . "</td>";
                echo "<td>" . $row['ID_Transaksi'] . "</td>";
                echo "<td>" . $row['ID_Pegawai'] . "</td>";
                echo "<td>" . $row['ID_Service'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data pembelian service</td></tr>";
        }
        ?>
    </table>

</body>

</html>