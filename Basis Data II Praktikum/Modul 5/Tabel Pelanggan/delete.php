<?php

function deleteDataPelanggan($ID_Pelanggan)
{
    global $conn;

    try {
        // Prepare statement untuk menghapus data pelanggan
        $stmt = $conn->prepare("CALL Delete_Data(?, 'pelanggan')");

        // Bind parameter ke dalam statement
        $stmt->bind_param("s", $ID_Pelanggan);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return false;
    }
}

// Tangani permintaan untuk menghapus pelanggan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_pelanggan'])) {
    $delete_ID_Pelanggan = $_POST['delete_ID_Pelanggan'];

    // Panggil fungsi deleteDataPelanggan dengan ID pelanggan yang ingin dihapus
    $success = deleteDataPelanggan($delete_ID_Pelanggan);

    if ($success) {
        // Jika berhasil, redirect kembali ke index.php dengan parameter delete_success
        header("Location: index.php?delete_success=1");
        exit();
    } else {
        // Jika gagal, redirect kembali ke index.php dengan parameter delete_error
        header("Location: index.php?delete_error=1");
        exit();
    }
}
