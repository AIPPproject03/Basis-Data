<?php

function createDataPelanggan($ID_Pelanggan, $Nama_Pelanggan)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure
        $stmt = $conn->prepare("CALL Insert_Data_Pelanggan(?, ?)");

        // Bind parameter ke dalam statement
        $stmt->bind_param("ss", $ID_Pelanggan, $Nama_Pelanggan);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return false;
    }
}

// Tangani permintaan untuk menambah pelanggan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pelanggan'])) {
    $ID_Pelanggan = $_POST['ID_Pelanggan'];
    $Nama_Pelanggan = $_POST['Nama_Pelanggan'];

    // Panggil fungsi createDataPelanggan dengan data yang ingin ditambahkan
    $success = createDataPelanggan($ID_Pelanggan, $Nama_Pelanggan);

    if ($success) {
        // Jika berhasil, redirect kembali ke index.php dengan parameter success
        header("Location: index.php?success=1");
        exit();
    } else {
        // Jika gagal, redirect kembali ke index.php dengan parameter error
        header("Location: index.php?error=1");
        exit();
    }
}
