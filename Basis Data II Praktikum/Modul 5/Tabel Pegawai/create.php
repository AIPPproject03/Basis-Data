<?php
include 'connection.php';

function tambahDataPegawai($ID_Pegawai, $ID_Jabatan, $Nama_Pegawai, $Alamat, $Username, $Password, $ID_Nomor, $No_Telp)
{
    global $conn;

    // Cek apakah id_nomor sudah ada di database
    $check = $conn->prepare("SELECT * FROM Nomor_Pegawai WHERE ID_Nomor = ?");
    $check->bind_param("s", $ID_Nomor);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Jika id_nomor sudah ada, redirect ke halaman index.php dengan parameter GET 'error'
        header("Location: index.php?error=id_nomor_exists");
        exit();
    }

    try {
        // Prepare statement untuk memanggil stored procedure
        $stmt = $conn->prepare("CALL Insert_Data_Pegawai(?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameter ke dalam statement
        $stmt->bind_param("ssssssis", $ID_Pegawai, $ID_Jabatan, $Nama_Pegawai, $Alamat, $Username, $Password, $ID_Nomor, $No_Telp);

        // Eksekusi statement
        $stmt->execute();

        // Redirect ke halaman index.php dengan parameter GET 'success'
        header("Location: index.php?success=true");
        exit(); // Penting: pastikan tidak ada output lain sebelum redirect
    } catch (mysqli_sql_exception $e) {
        // Jika terjadi kesalahan, redirect ke halaman index.php dengan parameter GET 'error'
        header("Location: index.php?error=true");
        exit(); // Penting: pastikan tidak ada output lain sebelum redirect
    }
}

// Cek apakah form telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pegawai'])) {
    // Ambil nilai dari form
    $ID_Pegawai = $_POST['ID_Pegawai'];
    $ID_Jabatan = $_POST['ID_Jabatan'];
    $Nama_Pegawai = $_POST['Nama_Pegawai'];
    $Alamat = $_POST['Alamat'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $ID_Nomor = $_POST['ID_Nomor'];
    $No_Telp = $_POST['No_Telp'];

    // Panggil function untuk menambah data pegawai
    tambahDataPegawai($ID_Pegawai, $ID_Jabatan, $Nama_Pegawai, $Alamat, $Username, $Password, $ID_Nomor, $No_Telp);
}
