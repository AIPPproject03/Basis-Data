<?php
include 'connection.php';

function createDataService($ID_Service, $Nama_Service, $Lama_Pengerjaan, $Harga)
{
    global $conn;

    try {
        // Prepare statement untuk memanggil stored procedure Insert_Data_Service
        $stmt = $conn->prepare("CALL Insert_Data_Service(?, ?, ?, ?)");

        // Bind parameter ke dalam statement
        $stmt->bind_param("ssii", $ID_Service, $Nama_Service, $Lama_Pengerjaan, $Harga);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, kembalikan true
        return true;
    } catch (mysqli_sql_exception $e) {
        // Tangani pesan error jika diperlukan
        return $e->getMessage(); // Mengembalikan pesan error yang lebih deskriptif
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['service'])) {
    $ID_Service = $_POST['ID_Service'];
    $Nama_Service = $_POST['Nama_Service'];
    $Lama_Pengerjaan = $_POST['Lama_Pengerjaan'];
    $Harga = $_POST['Harga'];

    $result = createDataService($ID_Service, $Nama_Service, $Lama_Pengerjaan, $Harga);

    if ($result === true) {
        header("Location: index.php?success=1");
        exit();
    } else {
        header("Location: index.php?error=" . urlencode($result));
        exit();
    }
}
