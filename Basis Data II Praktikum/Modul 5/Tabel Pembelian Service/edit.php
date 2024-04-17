<?php
include 'connection.php'; // Sertakan file koneksi database

function editDataPembelianService($ID_Pembelian_Service, $ID_Transaksi, $ID_Pegawai, $ID_Service)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure Update_Data_Pembelian_Service
        $stmt = $conn->prepare("CALL Update_Data_Pembelian_Service(?, ?, ?, ?)");

        // Bind parameter ke dalam statement
        $stmt->bind_param("ssss", $ID_Pembelian_Service, $ID_Transaksi, $ID_Pegawai, $ID_Service);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return $e->getMessage(); // Mengembalikan pesan error yang lebih deskriptif
    }
}

// Tangani permintaan untuk mengedit data pembelian service
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_pembelian_service'])) {
    $ID_Pembelian_Service = $_POST['edit_ID_Pembelian_Service'];
    $ID_Transaksi = $_POST['edit_ID_Transaksi'];
    $ID_Pegawai = $_POST['edit_ID_Pegawai'];
    $ID_Service = $_POST['edit_ID_Service'];

    // Panggil fungsi editDataPembelianService dengan data yang ingin diubah
    $result = editDataPembelianService($ID_Pembelian_Service, $ID_Transaksi, $ID_Pegawai, $ID_Service);

    if ($result === true) {
        // Jika berhasil, redirect kembali ke index.php dengan parameter success
        header("Location: index.php?success=edit");
        exit();
    } else {
        // Jika gagal, redirect kembali ke index.php dengan parameter error dan sertakan pesan error
        header("Location: index.php?error=" . urlencode($result)); // Sertakan pesan error dalam URL
        exit();
    }
}
