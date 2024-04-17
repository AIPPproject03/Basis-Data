<?php
session_start(); // Mulai session

include 'connection.php';
include 'create.php';
include 'delete.php';
include 'edit.php';

// Jika ada parameter GET 'success', tampilkan pesan sukses
if (isset($_GET['success'])) {
    echo "<h3 style='color: green;'>Data transaksi berhasil ditambahkan</h3>";
}

// Jika ada parameter GET 'error', tampilkan pesan error
if (isset($_GET['error'])) {
    echo "<h3 style='color: red;'>Gagal menambahkan data transaksi</h3>";
}

// Jika ada parameter GET 'delete_success', tampilkan pesan penghapusan berhasil
if (isset($_GET['delete_success'])) {
    echo "<h3 style='color: green;'>Data transaksi berhasil dihapus</h3>";
}

// Jika ada parameter GET 'delete_error', tampilkan pesan kesalahan penghapusan
if (isset($_GET['delete_error'])) {
    echo "<h3 style='color: red;'>Gagal menghapus data transaksi. ID tidak sesuai atau tidak ditemukan</h3>";
}

// Jika ada parameter GET 'edit_success', tampilkan pesan sukses edit data
if (isset($_GET['edit_success'])) {
    echo "<h3 style='color: green;'>Data transaksi berhasil diubah</h3>";
}

// Jika ada parameter GET 'edit_error', tampilkan pesan error edit data
if (isset($_GET['edit_error'])) {
    echo "<h3 style='color: red;'>Gagal mengubah data transaksi</h3>";
}

// Ambil data pelanggan untuk dropdown
$sql_pelanggan = "SELECT * FROM Pelanggan";
$result_pelanggan = $conn->query($sql_pelanggan);

// Ambil data pegawai untuk dropdown
$sql_pegawai = "SELECT * FROM Pegawai";
$result_pegawai = $conn->query($sql_pegawai);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Transaksi</title>
</head>

<body>

    <!-- CREATE FORM -->
    <form action="index.php" method="post">
        <h2>Tambah Transaksi</h2>
        <input type="text" name="ID_Transaksi" placeholder="ID Transaksi">
        <select name="ID_Pelanggan">
            <?php
            if ($result_pelanggan->num_rows > 0) {
                while ($row_pelanggan = $result_pelanggan->fetch_assoc()) {
                    echo "<option value='" . $row_pelanggan['ID_Pelanggan'] . "'>" . $row_pelanggan['ID_Pelanggan'] . "</option>";
                }
            } else {
                echo "<option value=''>Tidak ada pelanggan</option>";
            }
            ?>
        </select>
        <input type="date" name="Tanggal_Pembelian" placeholder="Tanggal Pembelian">
        <input type="number" name="Total_Biaya" placeholder="Total Biaya">
        <select name="ID_Pegawai">
            <?php
            if ($result_pegawai->num_rows > 0) {
                while ($row_pegawai = $result_pegawai->fetch_assoc()) {
                    echo "<option value='" . $row_pegawai['ID_Pegawai'] . "'>" . $row_pegawai['ID_Pegawai'] . "</option>";
                }
            } else {
                echo "<option value=''>Tidak ada pegawai</option>";
            }
            ?>
        </select>
        <input type="text" name="ID_Header" placeholder="ID Header">
        <input type="submit" name="transaksi" value="Tambah Transaksi">
    </form>

    <!-- DELETE FORM -->
    <form action="index.php" method="post">
        <h2>Hapus Transaksi</h2>
        <input type="text" name="delete_ID_Transaksi" placeholder="ID Transaksi to Delete">
        <input type="submit" name="delete_transaksi" value="Hapus Transaksi">
    </form>

    <!-- EDIT FORM -->
    <form action="index.php" method="post">
        <h2>Edit Transaksi</h2>
        <input type="text" name="edit_ID_Transaksi" placeholder="ID Transaksi to Edit">
        <input type="date" name="edit_Tanggal_Pembelian" placeholder="Tanggal Pembelian">
        <select name="edit_ID_Pelanggan">
            <?php
            // Mengembalikan pointer hasil ke awal
            mysqli_data_seek($result_pelanggan, 0);
            if ($result_pelanggan->num_rows > 0) {
                while ($row_pelanggan = $result_pelanggan->fetch_assoc()) {
                    echo "<option value='" . $row_pelanggan['ID_Pelanggan'] . "'>" . $row_pelanggan['ID_Pelanggan'] . "</option>";
                }
            } else {
                echo "<option value=''>Tidak ada pelanggan</option>";
            }
            ?>
        </select>
        <input type="number" name="edit_Total_Biaya" placeholder="Total Biaya">
        <select name="edit_ID_Pegawai">
            <?php
            // Mengembalikan pointer hasil ke awal
            mysqli_data_seek($result_pegawai, 0);
            if ($result_pegawai->num_rows > 0) {
                while ($row_pegawai = $result_pegawai->fetch_assoc()) {
                    echo "<option value='" . $row_pegawai['ID_Pegawai'] . "'>" . $row_pegawai['ID_Pegawai'] . "</option>";
                }
            } else {
                echo "<option value=''>Tidak ada pegawai</option>";
            }
            ?>
        </select>
        <input type="text" name="edit_ID_Header" placeholder="ID Header">
        <input type="submit" name="edit_transaksi" value="Edit Transaksi">
    </form>


    <!-- TABEL TRANSAKSI -->
    <h2>Daftar Transaksi</h2>
    <table border="1">
        <tr>
            <th>ID Transaksi</th>
            <th>Tanggal Pembelian</th>
            <th>ID Pelanggan</th>
            <th>Total Biaya</th>
            <th>ID Pegawai</th>
            <th>ID Header</th>
        </tr>
        <?php
        $sql = "SELECT Transaksi.ID_Transaksi, Transaksi.ID_Pelanggan, Transaksi.Tanggal_Pembelian, Transaksi.Total_Biaya, Pegawai.ID_Pegawai, Header_Transaksi.ID_Header
        FROM Transaksi
        JOIN Header_Transaksi ON Transaksi.ID_Transaksi = Header_Transaksi.ID_Transaksi
        JOIN Pegawai ON Header_Transaksi.ID_Pegawai = Pegawai.ID_Pegawai;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID_Transaksi'] . "</td>";
                echo "<td>" . $row['Tanggal_Pembelian'] . "</td>";
                echo "<td>" . $row['ID_Pelanggan'] . "</td>";
                echo "<td>" . $row['Total_Biaya'] . "</td>";
                echo "<td>" . $row['ID_Pegawai'] . "</td>";
                echo "<td>" . $row['ID_Header'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data transaksi</td></tr>";
        }
        ?>
    </table>
</body>

</html>