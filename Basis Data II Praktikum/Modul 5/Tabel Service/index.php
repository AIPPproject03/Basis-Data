<?php
session_start(); // Mulai session

include 'connection.php';
include 'create.php';
include 'delete.php';
include 'edit.php';

// Pesan sukses dan error
$success_message = "";
$error_message = "";

// Tangani pesan sukses
if (isset($_GET['success'])) {
    $success_code = $_GET['success'];
    if ($success_code == 'create') {
        $success_message = "Data service berhasil ditambahkan";
    } elseif ($success_code == 'edit') {
        $success_message = "Data service berhasil diubah";
    } elseif ($success_code == 'delete') {
        $success_message = "Data service berhasil dihapus";
    }
}

// Tangani pesan error
if (isset($_GET['error'])) {
    $error_message = "Gagal menangani permintaan: " . urldecode($_GET['error']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Service</title>
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

    <!-- CREATE FORM -->
    <form action="index.php" method="post">
        <h2>Tambah Service</h2>
        <input type="text" name="ID_Service" placeholder="ID Service">
        <input type="text" name="Nama_Service" placeholder="Nama Service">
        <input type="number" name="Lama_Pengerjaan" placeholder="Lama Pengerjaan">
        <input type="number" name="Harga" placeholder="Harga">
        <input type="submit" name="service" value="Tambah Service">
    </form>

    <!-- DELETE FORM -->
    <form action="index.php" method="post">
        <h2>Hapus Service</h2>
        <input type="text" name="delete_ID_Service" placeholder="ID Service to Delete">
        <input type="submit" name="delete_service" value="Hapus Service">
    </form>

    <!-- EDIT FORM -->
    <form action="index.php" method="post">
        <h2>Edit Service</h2>
        <input type="text" name="edit_ID_Service" placeholder="ID Service to Edit">
        <input type="text" name="edit_Nama_Service" placeholder="Nama Service">
        <input type="number" name="edit_Lama_Pengerjaan" placeholder="Lama Pengerjaan">
        <input type="number" name="edit_Harga" placeholder="Harga">
        <input type="submit" name="edit_service" value="Edit Service">
    </form>

    <!-- TABEL SERVICE -->
    <h2>Daftar Service</h2>
    <table border="1">
        <tr>
            <th>ID Service</th>
            <th>Nama Service</th>
            <th>Lama Pengerjaan</th>
            <th>Harga</th>
        </tr>
        <?php
        $sql = "SELECT * FROM Service";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID_Service'] . "</td>";
                echo "<td>" . $row['Nama_Service'] . "</td>";
                echo "<td>" . $row['Lama_Pengerjaan'] . "</td>";
                echo "<td>" . $row['Harga'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data service</td></tr>";
        }
        ?>
    </table>

</body>

</html>