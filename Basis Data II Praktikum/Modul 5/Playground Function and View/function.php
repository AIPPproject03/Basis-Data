<?php
include 'connection.php';

// Function 1: Generate_Pembelian_Sparepart_ID
function Generate_Pembelian_Sparepart_ID($p_ID_Pembelian_Sparepart)
{
    global $conn;
    $query = "SELECT CONCAT(
            LEFT((SELECT Nama_Pelanggan FROM Pelanggan WHERE ID_Pelanggan = (SELECT ID_Pelanggan FROM Transaksi WHERE ID_Transaksi = (SELECT ID_Transaksi FROM Pembelian_Sparepart WHERE ID_Pembelian_Sparepart = ?))), 3),
            ( SELECT ID_Pelanggan FROM Transaksi WHERE ID_Transaksi = (SELECT ID_Transaksi FROM Pembelian_Sparepart WHERE ID_Pembelian_Sparepart = ?)),
            LEFT((SELECT Nama_Pegawai FROM Pegawai WHERE ID_Pegawai = (SELECT ID_Pegawai FROM Header_Transaksi WHERE ID_Transaksi = (SELECT ID_Transaksi FROM Pembelian_Sparepart WHERE ID_Pembelian_Sparepart = ?))), 3),
            (SELECT DATE_FORMAT(Tanggal_Pembelian, '%d%m%Y') FROM Transaksi WHERE ID_Transaksi = (SELECT ID_Transaksi FROM Pembelian_Sparepart WHERE ID_Pembelian_Sparepart = ?)),
            FLOOR(RAND() * 100000)
        ) AS str";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $p_ID_Pembelian_Sparepart, $p_ID_Pembelian_Sparepart, $p_ID_Pembelian_Sparepart, $p_ID_Pembelian_Sparepart);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['str'];
}

// Function 2: Generate_Pembelian_Service_ID
function Generate_Pembelian_Service_ID($p_ID_Pembelian_Service)
{
    global $conn;
    $query = "SELECT CONCAT(
            LEFT((SELECT Nama_Pelanggan FROM Pelanggan WHERE ID_Pelanggan = (SELECT ID_Pelanggan FROM Transaksi WHERE ID_Transaksi = (SELECT ID_Transaksi FROM Pembelian_Service WHERE ID_Pembelian_Service = ?))), 3),
            (SELECT ID_Transaksi FROM Pembelian_Service WHERE ID_Pembelian_Service = ?),
            LEFT((SELECT Nama_Pegawai FROM Pegawai WHERE ID_Pegawai = (SELECT ID_Pegawai FROM Pembelian_Service WHERE ID_Pembelian_Service = ?)), 3),
            (SELECT ID_Pelanggan FROM Transaksi WHERE ID_Transaksi = (SELECT ID_Transaksi FROM Pembelian_Service WHERE ID_Pembelian_Service = ?)),
            FLOOR(RAND() * 100000)
        ) AS str";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $p_ID_Pembelian_Service, $p_ID_Pembelian_Service, $p_ID_Pembelian_Service, $p_ID_Pembelian_Service);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['str'];
}

// Function 3: Show_Transaksi_Pegawai
function Show_Transaksi_Pegawai($p_ID_Pegawai, $p_Tanggal)
{
    global $conn;
    $query = "SELECT GROUP_CONCAT(ID_Transaksi) AS str FROM Header_Transaksi WHERE ID_Pegawai = ? AND Tanggal_Transaksi = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $p_ID_Pegawai, $p_Tanggal);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['str'];
}

// Function 4: Show_Sparepart_Service
function Show_Sparepart_Service($p_ID_Transaksi)
{
    global $conn;
    $query = "SELECT GROUP_CONCAT(ID_Sparepart) AS sparepart_ids FROM Pembelian_Sparepart WHERE ID_Transaksi = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $p_ID_Transaksi);
    $stmt->execute();
    $result_sparepart = $stmt->get_result();

    $query = "SELECT GROUP_CONCAT(ID_Service) AS service_ids FROM Pembelian_Service WHERE ID_Transaksi = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $p_ID_Transaksi);
    $stmt->execute();
    $result_service = $stmt->get_result();

    $row_sparepart = $result_sparepart->fetch_assoc();
    $row_service = $result_service->fetch_assoc();

    return $row_sparepart['sparepart_ids'] . ',' . $row_service['service_ids'];
}
