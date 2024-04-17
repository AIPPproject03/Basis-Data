<?php
session_start(); // Mulai session

include 'connection.php';
include 'create.php';
include 'delete.php';
include 'edit.php';

// Jika ada parameter GET 'success', tampilkan pesan sukses
if (isset($_GET['success'])) {
    echo "<h3 style='color: green;'>Data pegawai berhasil ditambahkan</h3>";
}

// Jika ada parameter GET 'error', tampilkan pesan error
if (isset($_GET['error'])) {
    echo "<h3 style='color: red;'>Gagal menambahkan data pegawai</h3>";
}

// Jika ada parameter GET 'delete_success', tampilkan pesan penghapusan berhasil
if (isset($_GET['delete_success'])) {
    echo "<h3 style='color: green;'>Data pegawai berhasil dihapus</h3>";
}

// Jika ada parameter GET 'delete_error', tampilkan pesan kesalahan penghapusan
if (isset($_GET['delete_error'])) {
    echo "<h3 style='color: red;'>Gagal menghapus data pegawai. ID tidak sesuai atau tidak ditemukan</h3>";
}

// Jika ada parameter GET 'edit_success', tampilkan pesan sukses edit data
if (isset($_GET['edit_success'])) {
    echo "<h3 style='color: green;'>Data pegawai berhasil diubah</h3>";
}

// Jika ada parameter GET 'edit_error', tampilkan pesan error edit data
if (isset($_GET['edit_error'])) {
    echo "<h3 style='color: red;'>Gagal mengubah data pegawai</h3>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bengkel AIPP</title>
</head>

<body>

    <!-- CREATE FORM -->
    <form action="index.php" method="post">
        <h2>Create Pegawai</h2>
        <input type="text" name="ID_Pegawai" placeholder="ID Pegawai">
        <?php
        // Cek apakah ID Pegawai sudah ada
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pegawai'])) {
            $ID_Pegawai = $_POST['ID_Pegawai'];
            if (empty($ID_Pegawai)) {
                echo "<br><span style='color: red;'>ID Pegawai tidak boleh kosong</span>";
            } else {
                $check_query = "SELECT COUNT(*) as total FROM Pegawai WHERE ID_Pegawai='$ID_Pegawai'";
                $result = $conn->query($check_query);
                $row = $result->fetch_assoc();
                if ($row['total'] > 0) {
                    echo "<br><span style='color: red;'>ID Pegawai sudah ada</span>";
                }
            }
        }
        ?>
        <select name="ID_Jabatan">
            <?php
            $sql = "SELECT * FROM jabatan";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['ID_Jabatan'] . "'>" . $row['Nama_Jabatan'] . "</option>";
            }
            ?>
        </select>
        <input type="text" name="Nama_Pegawai" placeholder="Nama Pegawai">
        <input type="text" name="Alamat" placeholder="Alamat">
        <input type="text" name="Username" placeholder="Username">
        <input type="text" name="Password" placeholder="Password">
        <input type="text" name="ID_Nomor" placeholder="ID Nomor (Nomor yang baru)">
        <?php
        // Cek apakah ID Nomor sudah ada atau kosong
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pegawai'])) {
            $ID_Nomor = $_POST['ID_Nomor'];
            if (empty($ID_Nomor)) {
                echo "<br><span style='color: red;'>ID Nomor tidak boleh kosong</span>";
            } else {
                $check_query = "SELECT COUNT(*) as total FROM Nomor_Pegawai WHERE ID_Nomor='$ID_Nomor'";
                $result = $conn->query($check_query);
                $row = $result->fetch_assoc();
                if ($row['total'] > 0) {
                    echo "<br><span style='color: red;'>ID Nomor sudah ada</span>";
                }
            }
        }
        ?>
        <input type="text" name="No_Telp" placeholder="No Telp">
        <input type="submit" name="pegawai" value="Tambah Pegawai">
    </form>

    <!-- DELETE FORM -->
    <form action="index.php" method="post">
        <h2>Delete Pegawai</h2>
        <input type="text" name="delete_ID_Pegawai" placeholder="ID Pegawai to Delete">
        <input type="submit" name="delete_pegawai" value="Delete Pegawai">
    </form>

    <!-- EDIT FORM -->
    <form action="index.php" method="post">
        <h2>Edit Pegawai</h2>
        <input type="text" name="edit_ID_Pegawai" placeholder="ID Pegawai to Edit">
        <select name="edit_ID_Jabatan">
            <?php
            $sql = "SELECT * FROM jabatan";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['ID_Jabatan'] . "'>" . $row['Nama_Jabatan'] . "</option>";
            }
            ?>
        </select>
        <input type="text" name="edit_Nama_Pegawai" placeholder="Nama Pegawai">
        <input type="text" name="edit_Alamat" placeholder="Alamat">
        <input type="text" name="edit_Username" placeholder="Username">
        <input type="text" name="edit_Password" placeholder="Password">
        <input type="text" name="edit_ID_Nomor" placeholder="ID Nomor">
        <?php
        // Cek apakah ID Nomor sudah ada atau tidak
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_pegawai'])) {
            $edit_ID_Nomor = $_POST['edit_ID_Nomor'];
            if (empty($edit_ID_Nomor)) {
                echo "<br><span style='color: red;'>ID Nomor tidak boleh kosong</span>";
            } else {
                $check_query = "SELECT COUNT(*) as total FROM Nomor_Pegawai WHERE ID_Nomor='$edit_ID_Nomor'";
                $result = $conn->query($check_query);
                $row = $result->fetch_assoc();
                if ($row['total'] > 0) {
                    echo "<br><span style='color: red;'>ID Nomor sudah digunakan oleh pegawai lain</span>";
                }
            }
        }
        ?>
        <input type="text" name="edit_No_Telp" placeholder="No Telp">
        <input type="submit" name="edit_pegawai" value="Edit Pegawai">
    </form>

    <!-- VIEW FORM -->
    <h2>Daftar Pegawai</h2>
    <table border="1">
        <tr>
            <th>ID Pegawai</th>
            <th>Nama Pegawai</th>
            <th>Alamat</th>
            <th>Username</th>
            <th>Password</th>
            <th>ID Nomor</th>
            <th>No Telp</th>
        </tr>
        <?php
        // Query untuk menampilkan daftar pegawai dari view daftar_pegawai
        $query = "SELECT * FROM daftar_pegawai";
        $result = $conn->query($query);

        // Periksa apakah ada baris yang dikembalikan
        if ($result->num_rows > 0) {
            // Tampilkan data pegawai dalam bentuk tabel
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID_Pegawai"] . "</td>";
                echo "<td>" . $row["Nama_Pegawai"] . "</td>";
                echo "<td>" . $row["Alamat"] . "</td>";
                echo "<td>" . $row["Username"] . "</td>";
                echo "<td>" . $row["Password"] . "</td>";
                echo "<td>" . $row["ID_Nomor"] . "</td>";
                echo "<td>" . $row["No_Telp"] . "</td>";
                echo "</tr>";
            }
        } else {
            // Tampilkan pesan jika tidak ada pegawai yang ditemukan
            echo "<tr><td colspan='7'>Tidak ada data pegawai</td></tr>";
        }
        ?>
    </table>


</body>

</html>