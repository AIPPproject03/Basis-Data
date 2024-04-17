<?php
include 'connection.php'; // Sertakan file koneksi database
include 'function.php'; // Sertakan file function.php

// Function 1: Generate_Pembelian_Sparepart_ID
$ID_Pembelian_Sparepart = 'SR002'; // Ganti your_value dengan nilai yang sesuai
$sql_generate_pembelian_sparepart_id = "SELECT Generate_Pembelian_Sparepart_ID('$ID_Pembelian_Sparepart') AS Pembelian_Sparepart_ID";
$result_generate_pembelian_sparepart_id = $conn->query($sql_generate_pembelian_sparepart_id);

// Cek apakah query berhasil dan baris data tersedia sebelum mengambil nilai
if ($result_generate_pembelian_sparepart_id && $result_generate_pembelian_sparepart_id->num_rows > 0) {
    $row_generate_pembelian_sparepart_id = $result_generate_pembelian_sparepart_id->fetch_assoc();
    $generated_pembelian_sparepart_id = $row_generate_pembelian_sparepart_id['Pembelian_Sparepart_ID'];
} else {
    $generated_pembelian_sparepart_id = "Error: Tidak dapat menghasilkan ID pembelian sparepart.";
}

// Function 2: Generate_Pembelian_Service_ID
$ID_Pembelian_Service = 'PS001'; // Ganti your_value dengan nilai yang sesuai
$sql_generate_pembelian_service_id = "SELECT Generate_Pembelian_Service_ID('$ID_Pembelian_Service') AS Pembelian_Service_ID";
$result_generate_pembelian_service_id = $conn->query($sql_generate_pembelian_service_id);

// Cek apakah query berhasil dan baris data tersedia sebelum mengambil nilai
if ($result_generate_pembelian_service_id && $result_generate_pembelian_service_id->num_rows > 0) {
    $row_generate_pembelian_service_id = $result_generate_pembelian_service_id->fetch_assoc();
    $generated_pembelian_service_id = $row_generate_pembelian_service_id['Pembelian_Service_ID'];
} else {
    $generated_pembelian_service_id = "Error: Tidak dapat menghasilkan ID pembelian service.";
}

// Function 3: Show_Transaksi_Pegawai
$ID_Pegawai = 'P002'; // Ganti your_value dengan nilai yang sesuai
$Tanggal = '21-01-02'; // Ganti your_date_value dengan tanggal yang sesuai
$sql_show_transaksi_pegawai = "SELECT Show_Transaksi_Pegawai('$ID_Pegawai', '$Tanggal') AS Transaksi_Pegawai";
$result_show_transaksi_pegawai = $conn->query($sql_show_transaksi_pegawai);

// Cek apakah query berhasil dan baris data tersedia sebelum mengambil nilai
if ($result_show_transaksi_pegawai && $result_show_transaksi_pegawai->num_rows > 0) {
    $row_show_transaksi_pegawai = $result_show_transaksi_pegawai->fetch_assoc();
    $transaksi_pegawai = $row_show_transaksi_pegawai['Transaksi_Pegawai'];
} else {
    $transaksi_pegawai = "Error: Tidak dapat menampilkan transaksi pegawai.";
}

// Function 4: Show_Sparepart_Service
$ID_Transaksi = 'T002'; // Ganti your_value dengan nilai yang sesuai
$sql_show_sparepart_service = "SELECT Show_Sparepart_Service('$ID_Transaksi') AS Sparepart_Service";
$result_show_sparepart_service = $conn->query($sql_show_sparepart_service);

// Cek apakah query berhasil dan baris data tersedia sebelum mengambil nilai
if ($result_show_sparepart_service && $result_show_sparepart_service->num_rows > 0) {
    $row_show_sparepart_service = $result_show_sparepart_service->fetch_assoc();
    $sparepart_service = $row_show_sparepart_service['Sparepart_Service'];
} else {
    $sparepart_service = "Error: Tidak dapat menampilkan sparepart & service.";
}

// View 1: ban_dunlop
$sql_ban_dunlop = "SELECT * FROM ban_dunlop";
$result_ban_dunlop = $conn->query($sql_ban_dunlop);

// View 2: pemasukan_pegawai_service
$sql_pemasukan_pegawai_service = "SELECT * FROM pemasukan_pegawai_service";
$result_pemasukan_pegawai_service = $conn->query($sql_pemasukan_pegawai_service);

// View 3: daftar_pegawai
$sql_daftar_pegawai = "SELECT * FROM daftar_pegawai";
$result_daftar_pegawai = $conn->query($sql_daftar_pegawai);

// View 4: detail_transaksi
$sql_detail_transaksi = "SELECT * FROM detail_transaksi";
$result_detail_transaksi = $conn->query($sql_detail_transaksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function and View</title>
</head>

<body>
    <!-- Function 1: Generate_Pembelian_Sparepart_ID -->
    <h2>Generate Pembelian Sparepart ID:</h2>
    <p><?php echo $generated_pembelian_sparepart_id; ?></p>

    <!-- Function 2: Generate_Pembelian_Service_ID -->
    <h2>Generate Pembelian Service ID:</h2>
    <p><?php echo $generated_pembelian_service_id; ?></p>

    <!-- Function 3: Show_Transaksi_Pegawai -->
    <h2>Transaksi Pegawai:</h2>
    <p><?php echo $transaksi_pegawai; ?></p>

    <!-- Function 4: Show_Sparepart_Service -->
    <h2>Sparepart & Service:</h2>
    <p><?php echo $sparepart_service; ?></p>

    <!-- View 1: ban_dunlop -->
    <h2>ban_dunlop View:</h2>
    <table border="1">
        <tr>
            <th>ID Sparepart</th>
            <th>Nama Sparepart</th>
            <th>Stok</th>
            <th>Jenis Sparepart</th>
            <th>Harga</th>
            <th>ID Pembelian Sparepart</th>
            <th>ID Transaksi</th>
            <th>Jumlah Beli</th>
        </tr>
        <?php
        if ($result_ban_dunlop->num_rows > 0) {
            while ($row_ban_dunlop = $result_ban_dunlop->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_ban_dunlop['ID_Sparepart'] . "</td>";
                echo "<td>" . $row_ban_dunlop['Nama_Sparepart'] . "</td>";
                echo "<td>" . $row_ban_dunlop['Stok'] . "</td>";
                echo "<td>" . $row_ban_dunlop['Jenis_Sparepart'] . "</td>";
                echo "<td>" . $row_ban_dunlop['Harga'] . "</td>";
                echo "<td>" . $row_ban_dunlop['ID_Pembelian_Sparepart'] . "</td>";
                echo "<td>" . $row_ban_dunlop['ID_Transaksi'] . "</td>";
                echo "<td>" . $row_ban_dunlop['Jumlah_Beli'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
        }
        ?>
    </table>

    <!-- View 2: pemasukan_pegawai_service -->
    <h2>pemasukan_pegawai_service View:</h2>
    <table border="1">
        <tr>
            <th>ID Pegawai</th>
            <th>Nama Pegawai</th>
            <th>Nama Jabatan</th>
            <th>Nama Service</th>
            <th>Harga</th>
            <th>Jumlah Service</th>
            <th>Total Pemasukan</th>
        </tr>
        <?php
        if ($result_pemasukan_pegawai_service->num_rows > 0) {
            while ($row_pemasukan_pegawai_service = $result_pemasukan_pegawai_service->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_pemasukan_pegawai_service['ID_Pegawai'] . "</td>";
                echo "<td>" . $row_pemasukan_pegawai_service['Nama_Pegawai'] . "</td>";
                echo "<td>" . $row_pemasukan_pegawai_service['Nama_Jabatan'] . "</td>";
                echo "<td>" . $row_pemasukan_pegawai_service['Nama_Service'] . "</td>";
                echo "<td>" . $row_pemasukan_pegawai_service['Harga'] . "</td>";
                echo "<td>" . $row_pemasukan_pegawai_service['Jumlah_Service'] . "</td>";
                echo "<td>" . $row_pemasukan_pegawai_service['Total_Pemasukan'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
        }
        ?>
    </table>

    <!-- View 3: daftar_pegawai -->
    <h2>daftar_pegawai View:</h2>
    <table border="1">
        <tr>
            <th>ID Pegawai</th>
            <th>Nama Jabatan</th>
            <th>Nama Pegawai</th>
            <th>Alamat</th>
            <th>Username</th>
            <th>Password</th>
            <th>ID Nomor</th>
            <th>No. Telp</th>
        </tr>
        <?php
        if ($result_daftar_pegawai->num_rows > 0) {
            while ($row_daftar_pegawai = $result_daftar_pegawai->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_daftar_pegawai['ID_Pegawai'] . "</td>";
                echo "<td>" . $row_daftar_pegawai['Nama_Jabatan'] . "</td>";
                echo "<td>" . $row_daftar_pegawai['Nama_Pegawai'] . "</td>";
                echo "<td>" . $row_daftar_pegawai['Alamat'] . "</td>";
                echo "<td>" . $row_daftar_pegawai['Username'] . "</td>";
                echo "<td>" . $row_daftar_pegawai['Password'] . "</td>";
                echo "<td>" . $row_daftar_pegawai['ID_Nomor'] . "</td>";
                echo "<td>" . $row_daftar_pegawai['No_Telp'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Tidak ada data</td></tr>";
        }
        ?>
    </table>

    <!-- View 4: detail_transaksi -->
    <h2>detail_transaksi View:</h2>
    <table border="1">
        <tr>
            <th>Nama Pelanggan</th>
            <th>Nama Pegawai</th>
            <th>Jumlah Sparepart</th>
            <th>Jumlah Service</th>
            <th>Tanggal Pembelian</th>
        </tr>
        <?php
        if ($result_detail_transaksi->num_rows > 0) {
            while ($row_detail_transaksi = $result_detail_transaksi->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_detail_transaksi['Nama_Pelanggan'] . "</td>";
                echo "<td>" . $row_detail_transaksi['Nama_Pegawai'] . "</td>";
                echo "<td>" . $row_detail_transaksi['Jumlah_Sparepart'] . "</td>";
                echo "<td>" . $row_detail_transaksi['Jumlah_Service'] . "</td>";
                echo "<td>" . $row_detail_transaksi['Tanggal_Pembelian'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
        }
        ?>
    </table>

</body>

</html>