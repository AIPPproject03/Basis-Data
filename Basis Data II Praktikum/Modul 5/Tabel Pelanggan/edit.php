<?php

function editDataPelanggan($ID_Pelanggan, $Nama_Pelanggan)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure
        $stmt = $conn->prepare("CALL Update_Data_Pelanggan(?, ?)");

        // Bind parameter ke dalam statement
        $stmt->bind_param("ss", $ID_Pelanggan, $Nama_Pelanggan);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return false;
    }
}

// Tangani permintaan untuk mengedit pelanggan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_pelanggan'])) {
    $edit_ID_Pelanggan = $_POST['edit_ID_Pelanggan'];
    $edit_Nama_Pelanggan = $_POST['edit_Nama_Pelanggan'];

    // Panggil fungsi editDataPelanggan dengan data yang ingin diubah
    $success = editDataPelanggan($edit_ID_Pelanggan, $edit_Nama_Pelanggan);

    if ($success) {
        // Jika berhasil, redirect kembali ke index.php dengan parameter edit_success
        header("Location: index.php?edit_success=1");
        exit();
    } else {
        // Jika gagal, redirect kembali ke index.php dengan parameter edit_error
        header("Location: index.php?edit_error=1");
        exit();
    }
}
