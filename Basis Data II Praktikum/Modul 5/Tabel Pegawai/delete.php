<?php

function hapusDataPegawai($ID_Pegawai, $Tabel = "Pegawai")
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure
        $stmt = $conn->prepare("CALL Delete_Data(?,?)");

        // Bind parameter ke dalam statement
        $stmt->bind_param("ss", $ID_Pegawai, $Tabel);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return false;
    }
}

// Tangani permintaan untuk menghapus pegawai
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_pegawai'])) {
    $delete_ID_Pegawai = $_POST['delete_ID_Pegawai'];

    // Panggil fungsi hapusDataPegawai dengan ID Pegawai yang ingin dihapus
    $success = hapusDataPegawai($delete_ID_Pegawai);

    if ($success) {
        // Jika berhasil, redirect kembali ke index.php dengan parameter success
        header("Location: index.php?delete_success=1");
        exit();
    } else {
        // Jika gagal, redirect kembali ke index.php dengan parameter error
        header("Location: index.php?delete_error=1");
        exit();
    }
}
