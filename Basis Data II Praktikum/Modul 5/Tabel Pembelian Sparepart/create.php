<?php
include 'connection.php'; // Sertakan file koneksi database

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

function createDataPembelianSparepart($ID_Pembelian_Sparepart, $ID_Transaksi, $ID_Sparepart, $Jumlah_Beli)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure Insert_Data_Pembelian_Sparepart
        $stmt = $conn->prepare("CALL Insert_Data_Pembelian_Sparepart(?, ?, ?, ?)");

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

// Tangani permintaan untuk menambahkan data pembelian sparepart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_pembelian_sparepart'])) {
    $ID_Pembelian_Sparepart = $_POST['ID_Pembelian_Sparepart'];
    $ID_Transaksi = $_POST['ID_Transaksi'];
    $ID_Sparepart = $_POST['ID_Sparepart'];
    $Jumlah_Beli = $_POST['Jumlah_Beli'];

    // Panggil fungsi createDataPembelianSparepart dengan data yang ingin ditambahkan
    $result = createDataPembelianSparepart($ID_Pembelian_Sparepart, $ID_Transaksi, $ID_Sparepart, $Jumlah_Beli);

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
