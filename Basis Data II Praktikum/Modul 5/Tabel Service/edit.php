<?php
include 'connection.php'; // Sertakan file koneksi database

function editDataService($ID_Service, $Nama_Service, $Lama_Pengerjaan, $Harga)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure Update_Data_Service
        $stmt = $conn->prepare("CALL Update_Data_Service(?, ?, ?, ?)");

        // Bind parameter ke dalam statement
        $stmt->bind_param("ssii", $ID_Service, $Nama_Service, $Lama_Pengerjaan, $Harga);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return $e->getMessage(); // Mengembalikan pesan error yang lebih deskriptif
    }
}

// Tangani permintaan untuk mengedit data service
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_service'])) {
    $ID_Service = $_POST['edit_ID_Service'];
    $Nama_Service = $_POST['edit_Nama_Service'];
    $Lama_Pengerjaan = $_POST['edit_Lama_Pengerjaan'];
    $Harga = $_POST['edit_Harga'];

    // Panggil fungsi editDataService dengan data yang ingin diubah
    $result = editDataService($ID_Service, $Nama_Service, $Lama_Pengerjaan, $Harga);

    if ($result === true) {
        // Jika berhasil, redirect kembali ke index.php dengan parameter success
        header("Location: index.php?success=edit");
        exit();
    } else {
        // Jika gagal, redirect kembali ke index.php dengan parameter error dan sertakan pesan error
        if (strpos($result, 'tidak sesuai atau tidak ditemukan') !== false) {
            header("Location: index.php?error=ID tidak sesuai atau tidak ditemukan");
        } else {
            header("Location: index.php?error=" . urlencode($result)); // Sertakan pesan error dalam URL
        }
        exit();
    }
}
