<?php
include 'connection.php'; // Sertakan file koneksi database

function deleteDataPembelianService($ID_Pembelian_Service)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure Delete_Data
        $stmt = $conn->prepare("CALL Delete_Data(?, 'Pembelian_Service')");

        // Bind parameter ke dalam statement
        $stmt->bind_param("s", $ID_Pembelian_Service);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return $e->getMessage(); // Mengembalikan pesan error yang lebih deskriptif
    }
}

// Tangani permintaan untuk menghapus data pembelian service
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_pembelian_service'])) {
    $ID_Pembelian_Service = $_POST['delete_ID_Pembelian_Service'];

    // Panggil fungsi deleteDataPembelianService dengan data yang ingin dihapus
    $result = deleteDataPembelianService($ID_Pembelian_Service);

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
