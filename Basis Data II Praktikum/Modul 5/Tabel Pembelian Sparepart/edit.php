<?php
include 'connection.php'; // Sertakan file koneksi database

// Periksa apakah fungsi sudah dideklarasikan sebelumnya sebelum mendeklarasikannya kembali
if (!function_exists('getIDTransaksiList')) {
    // Function untuk mengambil daftar ID Transaksi dari database
    function getIDTransaksiList()
    {
        global $conn;

        $sql = "SELECT ID_Transaksi FROM Transaksi";
        $result = $conn->query($sql);

        $IDTransaksiList = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $IDTransaksiList[] = $row['ID_Transaksi'];
            }
        }
        return $IDTransaksiList;
    }
}

// Periksa apakah fungsi sudah dideklarasikan sebelumnya sebelum mendeklarasikannya kembali
if (!function_exists('getIDSparepartList')) {
    // Function untuk mengambil daftar ID Sparepart dari database
    function getIDSparepartList()
    {
        global $conn;

        $sql = "SELECT ID_Sparepart FROM Sparepart";
        $result = $conn->query($sql);

        $IDSparepartList = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $IDSparepartList[] = $row['ID_Sparepart'];
            }
        }
        return $IDSparepartList;
    }
}

function editDataPembelianSparepart($ID_Pembelian_Sparepart, $ID_Transaksi, $ID_Sparepart, $Jumlah_Beli)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure Update_Data_Pembelian_Sparepart
        $stmt = $conn->prepare("CALL Update_Data_Pembelian_Sparepart(?, ?, ?, ?)");

        // Bind parameter ke dalam statement
        $stmt->bind_param("sssi", $ID_Pembelian_Sparepart, $ID_Transaksi, $ID_Sparepart, $Jumlah_Beli);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return $e->getMessage(); // Mengembalikan pesan error yang lebih deskriptif
    }
}

// Tangani permintaan untuk mengedit data pembelian sparepart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_pembelian_sparepart'])) {
    $ID_Pembelian_Sparepart = $_POST['edit_ID_Pembelian_Sparepart'];
    $ID_Transaksi = $_POST['edit_ID_Transaksi'];
    $ID_Sparepart = $_POST['edit_ID_Sparepart'];
    $Jumlah_Beli = $_POST['edit_Jumlah_Beli'];

    // Panggil fungsi editDataPembelianSparepart dengan data yang ingin diubah
    $result = editDataPembelianSparepart($ID_Pembelian_Sparepart, $ID_Transaksi, $ID_Sparepart, $Jumlah_Beli);

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
