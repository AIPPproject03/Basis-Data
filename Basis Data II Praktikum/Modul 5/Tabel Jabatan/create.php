<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['jabatan'])) {
    // Tangkap data yang dikirimkan melalui form
    $ID_Jabatan = $_POST['ID_Jabatan'];
    $Nama_Jabatan = $_POST['Nama_Jabatan'];
    $Gaji = $_POST['Gaji'];

    // Pastikan data yang diterima tidak kosong
    if (!empty($ID_Jabatan) && !empty($Nama_Jabatan) && !empty($Gaji)) {
        // Cek apakah ID Jabatan sudah ada dalam database
        $check_query = "SELECT COUNT(*) as total FROM jabatan WHERE ID_Jabatan='$ID_Jabatan'";
        $result = $conn->query($check_query);
        $row = $result->fetch_assoc();
        if ($row['total'] == 0) {
            // Jika ID Jabatan belum ada, lakukan proses penambahan data
            $insert_query = "INSERT INTO jabatan (ID_Jabatan, Nama_Jabatan, Gaji) VALUES ('$ID_Jabatan', '$Nama_Jabatan', '$Gaji')";
            if ($conn->query($insert_query) === TRUE) {
                // Jika proses penambahan berhasil, redirect kembali ke index.php dengan parameter success
                header("Location: index.php?success=1");
                exit();
            } else {
                // Jika terjadi kesalahan saat proses penambahan, redirect kembali ke index.php dengan parameter error
                header("Location: index.php?error=1");
                exit();
            }
        } else {
            // Jika ID Jabatan sudah ada, redirect kembali ke index.php dengan parameter error
            header("Location: index.php?error=1");
            exit();
        }
    } else {
        // Jika ada data yang kosong, redirect kembali ke index.php dengan parameter error
        header("Location: index.php?error=1");
        exit();
    }
}
