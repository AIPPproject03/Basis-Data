<?php
function createDataTransaksi($ID_Transaksi, $ID_Pelanggan, $Tanggal_Pembelian, $Total_Biaya, $ID_Pegawai, $ID_Header)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure
        $stmt = $conn->prepare("CALL Transaksi(?, ?, ?, ?, ?, ?)");

        // Bind parameter ke dalam statement
        $stmt->bind_param("sssiss", $ID_Transaksi, $ID_Pelanggan, $Tanggal_Pembelian, $Total_Biaya, $ID_Pegawai, $ID_Header);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return $e->getMessage(); // Mengembalikan pesan error yang lebih deskriptif
    }
}

// Tangani permintaan untuk menambahkan data transaksi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['transaksi'])) {
    $ID_Transaksi = $_POST['ID_Transaksi'];
    $ID_Pelanggan = $_POST['ID_Pelanggan'];
    $Tanggal_Pembelian = $_POST['Tanggal_Pembelian'];
    $Total_Biaya = $_POST['Total_Biaya'];
    $ID_Pegawai = $_POST['ID_Pegawai'];
    $ID_Header = $_POST['ID_Header'];

    // Panggil fungsi createDataTransaksi dengan data yang ingin ditambahkan
    $result = createDataTransaksi($ID_Transaksi, $ID_Pelanggan, $Tanggal_Pembelian, $Total_Biaya, $ID_Pegawai, $ID_Header);

    if ($result === true) {
        // Jika berhasil, redirect kembali ke index.php dengan parameter success
        header("Location: index.php?success=1");
        exit();
    } else {
        // Jika gagal, redirect kembali ke index.php dengan parameter error dan sertakan pesan error
        header("Location: index.php?error=" . urlencode($result)); // Sertakan pesan error dalam URL
        exit();
    }
}
