<?php
// Tangani permintaan untuk menghapus transaksi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_transaksi'])) {
    $delete_ID_Transaksi = $_POST['delete_ID_Transaksi'];

    try {
        // Prepare statement untuk memanggil stored procedure
        $stmt = $conn->prepare("CALL Delete_Data(?, 'Transaksi')");

        // Bind parameter ke dalam statement
        $stmt->bind_param("s", $delete_ID_Transaksi);

        // Eksekusi statement
        $stmt->execute();

        // Jika berhasil, redirect kembali ke index.php dengan parameter success
        header("Location: index.php?delete_success=1");
        exit();
    } catch (mysqli_sql_exception $e) {
        // Jika gagal, redirect kembali ke index.php dengan parameter error
        header("Location: index.php?delete_error=1");
        exit();
    }
}
