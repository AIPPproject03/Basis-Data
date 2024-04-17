<?php
include 'connection.php'; // Sertakan file koneksi database

function createDataSparepart($ID_Sparepart, $Nama_Sparepart, $Stok, $Jenis_Sparepart, $Harga)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure Insert_Data_Sparepart
        $stmt = $conn->prepare("CALL Insert_Data_Sparepart(?, ?, ?, ?, ?)");

        // Bind parameter ke dalam statement
        $stmt->bind_param("ssisi", $ID_Sparepart, $Nama_Sparepart, $Stok, $Jenis_Sparepart, $Harga);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return $e->getMessage(); // Mengembalikan pesan error yang lebih deskriptif
    }
}

// Tangani permintaan untuk menambahkan data sparepart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_sparepart'])) {
    $ID_Sparepart = $_POST['ID_Sparepart'];
    $Nama_Sparepart = $_POST['Nama_Sparepart'];
    $Stok = $_POST['Stok'];
    $Jenis_Sparepart = $_POST['Jenis_Sparepart'];
    $Harga = $_POST['Harga'];

    // Panggil fungsi createDataSparepart dengan data yang ingin ditambahkan
    $result = createDataSparepart($ID_Sparepart, $Nama_Sparepart, $Stok, $Jenis_Sparepart, $Harga);

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
