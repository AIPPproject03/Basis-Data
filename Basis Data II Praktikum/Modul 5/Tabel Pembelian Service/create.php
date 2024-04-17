<?php
include 'connection.php'; // Sertakan file koneksi database

function createDataPembelianService($ID_Pembelian_Service, $ID_Transaksi, $ID_Pegawai, $ID_Service)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure Insert_Data_Pembelian_Service
        $stmt = $conn->prepare("CALL Insert_Data_Pembelian_Service(?, ?, ?, ?)");

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

// Tangani permintaan untuk membuat data pembelian service baru
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_pembelian_service'])) {
    $ID_Pembelian_Service = $_POST['ID_Pembelian_Service'];
    $ID_Transaksi = $_POST['ID_Transaksi'];
    $ID_Pegawai = $_POST['ID_Pegawai'];
    $ID_Service = $_POST['ID_Service'];

    // Panggil fungsi createDataPembelianService dengan data yang ingin ditambahkan
    $result = createDataPembelianService($ID_Pembelian_Service, $ID_Transaksi, $ID_Pegawai, $ID_Service);

    if ($result === true) {
        // Jika berhasil, redirect kembali ke index.php dengan parameter success
        header("Location: index.php?success=create");
        exit();
    } else {
        // Jika gagal, redirect kembali ke index.php dengan parameter error dan sertakan pesan error
        header("Location: index.php?error=" . urlencode($result)); // Sertakan pesan error dalam URL
        exit();
    }
}
