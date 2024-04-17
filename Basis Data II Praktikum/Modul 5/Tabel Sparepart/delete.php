<?php
include 'connection.php'; // Sertakan file koneksi database

function deleteDataSparepart($ID_Sparepart)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure Delete_Data
        $stmt = $conn->prepare("CALL Delete_Data(?, 'Sparepart')");

        // Bind parameter ke dalam statement
        $stmt->bind_param("s", $ID_Sparepart);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return $e->getMessage(); // Mengembalikan pesan error yang lebih deskriptif
    }
}

// Tangani permintaan untuk menghapus data sparepart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_sparepart'])) {
    $ID_Sparepart = $_POST['delete_ID_Sparepart'];

    // Lakukan validasi terlebih dahulu untuk memastikan ID_Sparepart ada dalam database
    $sql_check_id = "SELECT ID_Sparepart FROM Sparepart WHERE ID_Sparepart = '$ID_Sparepart'";
    $result_check_id = $conn->query($sql_check_id);

    if ($result_check_id->num_rows > 0) {
        // ID_Sparepart ditemukan, panggil fungsi deleteDataSparepart
        $result = deleteDataSparepart($ID_Sparepart);

        if ($result === true) {
            // Jika berhasil, redirect kembali ke index.php dengan parameter success
            header("Location: index.php?success=delete");
            exit();
        } else {
            // Jika gagal, redirect kembali ke index.php dengan parameter error dan sertakan pesan error
            header("Location: index.php?error=" . urlencode($result)); // Sertakan pesan error dalam URL
            exit();
        }
    } else {
        // ID_Sparepart tidak ditemukan dalam database, kirimkan pesan error
        $error_message = "ID Sparepart tidak ditemukan dalam database.";
        header("Location: index.php?error=" . urlencode($error_message)); // Sertakan pesan error dalam URL
        exit();
    }
}
