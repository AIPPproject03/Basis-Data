<?php
include 'connection.php'; // Sertakan file koneksi database

function deleteDataPembelianSparepart($ID_Pembelian_Sparepart)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure Delete_Data
        $stmt = $conn->prepare("CALL Delete_Data(?, 'Pembelian_Sparepart')");

        // Bind parameter ke dalam statement
        $stmt->bind_param("s", $ID_Pembelian_Sparepart);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return $e->getMessage(); // Mengembalikan pesan error yang lebih deskriptif
    }
}

// Tangani permintaan untuk menghapus data pembelian sparepart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_pembelian_sparepart'])) {
    $ID_Pembelian_Sparepart = $_POST['delete_ID_Pembelian_Sparepart'];

    // Panggil fungsi deleteDataPembelianSparepart dengan data yang ingin dihapus
    $result = deleteDataPembelianSparepart($ID_Pembelian_Sparepart);

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
