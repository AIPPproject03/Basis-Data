<?php
function editDataTransaksi($ID_Transaksi, $ID_Pelanggan, $Tanggal_Pembelian, $Total_Biaya)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure
        $stmt = $conn->prepare("CALL Update_Data_Transaksi(?, ?, ?, ?)");

        // Bind parameter ke dalam statement
        $stmt->bind_param("sssi", $ID_Transaksi, $ID_Pelanggan, $Tanggal_Pembelian, $Total_Biaya);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return false;
    }
}

// Tangani permintaan untuk mengedit transaksi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_transaksi'])) {
    $edit_ID_Transaksi = $_POST['edit_ID_Transaksi'];
    $edit_ID_Pelanggan = $_POST['edit_ID_Pelanggan'];
    $edit_Tanggal_Pembelian = $_POST['edit_Tanggal_Pembelian'];
    $edit_Total_Biaya = $_POST['edit_Total_Biaya'];

    // Panggil fungsi editDataTransaksi dengan data yang ingin diubah
    $success = editDataTransaksi($edit_ID_Transaksi, $edit_ID_Pelanggan, $edit_Tanggal_Pembelian, $edit_Total_Biaya);

    if ($success) {
        // Jika berhasil, redirect kembali ke index.php dengan parameter success
        header("Location: index.php?edit_success=1");
        exit();
    } else {
        // Jika gagal, redirect kembali ke index.php dengan parameter error
        header("Location: index.php?edit_error=1");
        exit();
    }
}
