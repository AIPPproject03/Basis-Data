<?php

function editDataPegawai($ID_Pegawai, $ID_Jabatan, $Nama_Pegawai, $Alamat, $Username, $Password, $ID_Nomor, $No_Telp)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure
        $stmt = $conn->prepare("CALL Update_Data_Pegawai(?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameter ke dalam statement
        $stmt->bind_param("ssssssis", $ID_Pegawai, $ID_Jabatan, $Nama_Pegawai, $Alamat, $Username, $Password, $ID_Nomor, $No_Telp);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return false;
    }
}

// Tangani permintaan untuk mengedit pegawai
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_pegawai'])) {
    $edit_ID_Pegawai = $_POST['edit_ID_Pegawai'];
    $edit_ID_Jabatan = $_POST['edit_ID_Jabatan'];
    $edit_Nama_Pegawai = $_POST['edit_Nama_Pegawai'];
    $edit_Alamat = $_POST['edit_Alamat'];
    $edit_Username = $_POST['edit_Username'];
    $edit_Password = $_POST['edit_Password'];
    $edit_ID_Nomor = $_POST['edit_ID_Nomor'];
    $edit_No_Telp = $_POST['edit_No_Telp'];

    // Periksa apakah ID Nomor sudah digunakan oleh pegawai lain
    $check_query = "SELECT COUNT(*) as total FROM Nomor_Pegawai WHERE ID_Nomor='$edit_ID_Nomor'";
    $result = $conn->query($check_query);
    $row = $result->fetch_assoc();

    // Periksa apakah ID Nomor sama dengan ID Nomor awal dari pegawai yang diedit
    $check_original_query = "SELECT ID_Nomor FROM Nomor_Pegawai WHERE ID_Pegawai='$edit_ID_Pegawai'";
    $original_result = $conn->query($check_original_query);
    $original_row = $original_result->fetch_assoc();
    $original_ID_Nomor = $original_row['ID_Nomor'];

    if ($row['total'] > 0 && $edit_ID_Nomor !== $original_ID_Nomor) {
        // Jika ID Nomor sudah digunakan oleh pegawai lain dan bukan ID Nomor awal, redirect dengan parameter error
        header("Location: index.php?edit_error=1");
        exit();
    }

    // Panggil fungsi editDataPegawai dengan data yang ingin diubah
    $success = editDataPegawai($edit_ID_Pegawai, $edit_ID_Jabatan, $edit_Nama_Pegawai, $edit_Alamat, $edit_Username, $edit_Password, $edit_ID_Nomor, $edit_No_Telp);

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
