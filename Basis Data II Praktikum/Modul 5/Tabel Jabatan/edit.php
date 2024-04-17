<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_jabatan'])) {
    // Tangkap ID Jabatan yang akan diubah dari form
    $edit_ID_Jabatan = $_POST['edit_ID_Jabatan'];
    // Tangkap data baru untuk Nama Jabatan dan Gaji dari form
    $edit_Nama_Jabatan = $_POST['edit_Nama_Jabatan'];
    $edit_Gaji = $_POST['edit_Gaji'];

    // Pastikan ID Jabatan yang diterima tidak kosong
    if (!empty($edit_ID_Jabatan)) {
        // Periksa apakah ID Jabatan yang ingin diubah ada dalam database
        $check_query = "SELECT COUNT(*) as total FROM jabatan WHERE ID_Jabatan='$edit_ID_Jabatan'";
        $result = $conn->query($check_query);
        $row = $result->fetch_assoc();
        if ($row['total'] > 0) {
            // Jika ID Jabatan ditemukan dalam database, lakukan proses pengeditan data
            $edit_query = "UPDATE jabatan SET Nama_Jabatan='$edit_Nama_Jabatan', Gaji='$edit_Gaji' WHERE ID_Jabatan='$edit_ID_Jabatan'";
            if ($conn->query($edit_query) === TRUE) {
                // Jika proses pengeditan berhasil, redirect kembali ke index.php dengan parameter edit_success
                header("Location: index.php?edit_success=1");
                exit();
            } else {
                // Jika terjadi kesalahan saat proses pengeditan, redirect kembali ke index.php dengan parameter edit_error
                header("Location: index.php?edit_error=1");
                exit();
            }
        } else {
            // Jika ID Jabatan tidak ditemukan dalam database, redirect kembali ke index.php dengan parameter edit_error
            header("Location: index.php?edit_error=1");
            exit();
        }
    } else {
        // Jika ID Jabatan kosong, redirect kembali ke index.php dengan parameter edit_error
        header("Location: index.php?edit_error=1");
        exit();
    }
}
