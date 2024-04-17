<?php
include 'connection.php'; // Sertakan file koneksi database

function deleteDataService($ID_Service)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure Delete_Data
        $stmt = $conn->prepare("CALL Delete_Data(?, 'Service')");

        // Bind parameter ke dalam statement
        $stmt->bind_param("s", $ID_Service);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return $e->getMessage(); // Mengembalikan pesan error yang lebih deskriptif
    }
}

// Tangani permintaan untuk menghapus data service
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_service'])) {
    $ID_Service = $_POST['delete_ID_Service'];

    // Panggil fungsi deleteDataService dengan data yang ingin dihapus
    $result = deleteDataService($ID_Service);

    if ($result === true) {
        // Jika berhasil, redirect kembali ke index.php dengan parameter success
        header("Location: index.php?success=delete");
        exit();
    } else {
        // Jika gagal, redirect kembali ke index.php dengan parameter error dan sertakan pesan error
        header("Location: index.php?error=" . urlencode($result)); // Sertakan pesan error dalam URL
        exit();
    }
}
