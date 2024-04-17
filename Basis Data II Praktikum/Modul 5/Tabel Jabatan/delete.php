<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_jabatan'])) {
    // Tangkap ID Jabatan yang ingin dihapus dari form
    $delete_ID_Jabatan = $_POST['delete_ID_Jabatan'];

    // Pastikan ID Jabatan yang diterima tidak kosong
    if (!empty($delete_ID_Jabatan)) {
        // Periksa apakah ID Jabatan yang ingin dihapus ada dalam database
        $check_query = "SELECT COUNT(*) as total FROM jabatan WHERE ID_Jabatan='$delete_ID_Jabatan'";
        $result = $conn->query($check_query);
        $row = $result->fetch_assoc();
        if ($row['total'] > 0) {
            // Jika ID Jabatan ditemukan dalam database, lakukan proses penghapusan data
            $delete_query = "DELETE FROM jabatan WHERE ID_Jabatan='$delete_ID_Jabatan'";
            if ($conn->query($delete_query) === TRUE) {
                // Jika proses penghapusan berhasil, redirect kembali ke index.php dengan parameter delete_success
                header("Location: index.php?delete_success=1");
                exit();
            } else {
                // Jika terjadi kesalahan saat proses penghapusan, redirect kembali ke index.php dengan parameter delete_error
                header("Location: index.php?delete_error=1");
                exit();
            }
        } else {
            // Jika ID Jabatan tidak ditemukan dalam database, redirect kembali ke index.php dengan parameter delete_error
            header("Location: index.php?delete_error=1");
            exit();
        }
    } else {
        // Jika ID Jabatan kosong, redirect kembali ke index.php dengan parameter delete_error
        header("Location: index.php?delete_error=1");
        exit();
    }
}
