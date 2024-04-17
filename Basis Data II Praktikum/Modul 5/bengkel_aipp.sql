-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Apr 2024 pada 05.56
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengkel_aipp`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Count_Sparepart_Transactions` ()   BEGIN
    -- Query untuk menghitung banyaknya transaksi pembelian sparepart
    SELECT COUNT(ID_Pembelian_Sparepart) AS Jumlah_Transaksi
    FROM Pembelian_Sparepart;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Delete_Data` (IN `ID` VARCHAR(5), IN `Tabel` VARCHAR(50))   BEGIN
        IF Tabel = 'Jabatan' THEN
            DELETE FROM Jabatan WHERE ID_Jabatan = ID;
        ELSEIF Tabel = 'Pegawai' THEN
            DELETE FROM Nomor_Pegawai WHERE ID_Pegawai = ID;
            DELETE FROM Pegawai WHERE ID_Pegawai = ID;
        ELSEIF Tabel = 'Nomor_Pegawai' THEN
            DELETE FROM Nomor_Pegawai WHERE ID_Pegawai = ID;
        ELSEIF Tabel = 'Header_Transaksi' THEN
            DELETE FROM Header_Transaksi WHERE ID_Header = ID;
        ELSEIF Tabel = 'Transaksi' THEN
            DELETE FROM Transaksi WHERE ID_Transaksi = ID;
        ELSEIF Tabel = 'Pembelian_Sparepart' THEN
            DELETE FROM Pembelian_Sparepart WHERE ID_Pembelian_Sparepart = ID;
        ELSEIF Tabel = 'Sparepart' THEN
            DELETE FROM Pembelian_Sparepart WHERE ID_Sparepart = ID;
            DELETE FROM Sparepart WHERE ID_Sparepart = ID;
        ELSEIF Tabel = 'Pelanggan' THEN
            DELETE FROM Transaksi WHERE ID_Pelanggan = ID;
            DELETE FROM Pelanggan WHERE ID_Pelanggan = ID;
        ELSEIF Tabel = 'Pembelian_Service' THEN
            DELETE FROM Pembelian_Service WHERE ID_Pembelian_Service = ID;
        ELSEIF Tabel = 'Service' THEN
            DELETE FROM Pembelian_Service WHERE ID_Service = ID;
            DELETE FROM Service WHERE ID_Service = ID;
        END IF;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Data_Jabatan` (IN `ID_Jabatan` VARCHAR(5), IN `Nama_Jabatan` VARCHAR(50), IN `Gaji` INT)   BEGIN
	INSERT INTO Jabatan VALUES (ID_Jabatan, Nama_Jabatan, Gaji);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Data_Pegawai` (IN `ID_Pegawai` VARCHAR(5), IN `ID_Jabatan` VARCHAR(5), IN `Nama_Pegawai` VARCHAR(50), IN `Alamat` VARCHAR(50), IN `Username` VARCHAR(50), IN `PASSWORD` VARCHAR(50), IN `ID_Nomor` INT, IN `No_Telp` VARCHAR(15))   BEGIN
	    INSERT INTO Pegawai VALUES (ID_Pegawai, ID_Jabatan, Nama_Pegawai, Alamat, Username, PASSWORD);
        INSERT INTO Nomor_Pegawai VALUES (ID_Pegawai, ID_Nomor, No_Telp);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Data_Pelanggan` (IN `ID_Pelanggan` VARCHAR(5), IN `Nama_Pelanggan` VARCHAR(50))   BEGIN
        INSERT INTO Pelanggan VALUES (ID_Pelanggan, Nama_Pelanggan);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Data_Pembelian_Service` (IN `ID_Pembelian_Service` VARCHAR(5), IN `ID_Transaksi` VARCHAR(5), IN `ID_Pegawai` VARCHAR(5), IN `ID_Service` VARCHAR(5))   BEGIN
        INSERT INTO Pembelian_Service VALUES (ID_Pembelian_Service, ID_Transaksi, ID_Pegawai, ID_Service);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Data_Pembelian_Sparepart` (IN `ID_Pembelian_Sparepart` VARCHAR(5), IN `ID_Transaksi` VARCHAR(5), IN `ID_Sparepart` VARCHAR(5), IN `Jumlah_Beli` INT)   BEGIN
        INSERT INTO Pembelian_Sparepart VALUES (ID_Pembelian_Sparepart, ID_Transaksi, ID_Sparepart, Jumlah_Beli);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Data_Service` (IN `ID_Service` VARCHAR(5), IN `Nama_Service` VARCHAR(50), IN `Lama_Pengerjaan` INT, IN `Harga` INT)   BEGIN
        INSERT INTO Service VALUES (ID_Service, Nama_Service, Lama_Pengerjaan, Harga);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Data_Sparepart` (IN `ID_Sparepart` VARCHAR(5), IN `Nama_Sparepart` VARCHAR(50), IN `Stok` INT, IN `Jenis_Sparepart` VARCHAR(50), IN `Harga` INT)   BEGIN
        INSERT INTO Sparepart VALUES (ID_Sparepart, Nama_Sparepart, Stok, Jenis_Sparepart, Harga);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Show_Cheapest_Items` ()   BEGIN
    -- Query untuk menampilkan harga sparepart yang paling murah
    (SELECT 'Sparepart' AS Jenis, Nama_Sparepart AS Nama, MIN(Harga) AS Harga
    FROM Sparepart where Harga = (SELECT MIN(Harga) FROM Sparepart))

    UNION ALL

    -- Query untuk menampilkan harga layanan yang paling murah
    (SELECT 'Service' AS Jenis, Nama_Service AS Nama, MIN(Harga) AS Harga
    FROM Service where Harga = (SELECT MIN(Harga) FROM Service));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Show_Most_Expensive_Items` ()   BEGIN
    -- Query untuk menampilkan harga sparepart yang paling mahal
    (SELECT 'Sparepart' AS Jenis, Nama_Sparepart AS Nama, MAX(Harga) AS Harga
    FROM Sparepart WHERE Harga = (SELECT MAX(Harga) FROM Sparepart))

    UNION ALL

    -- Query untuk menampilkan harga layanan yang paling mahal
    (SELECT 'Service' AS Jenis, Nama_Service AS Nama, MAX(Harga) AS Harga
    FROM  Service WHERE Harga = (SELECT MAX(Harga) FROM Service));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Show_Most_Purchased_Items` ()   BEGIN
    -- Query untuk menampilkan sparepart yang paling banyak dibeli berdasarkan jumlah pembelian yang ada pada tabel Pembelian_Sparepart
    SELECT 'Sparepart' AS Jenis, Nama_Sparepart AS Nama, Jumlah_Beli
    FROM (
        SELECT sp.Nama_Sparepart, SUM(ps.Jumlah_Beli) AS Jumlah_Beli
        FROM Pembelian_Sparepart ps
        INNER JOIN Sparepart sp ON ps.ID_Sparepart = sp.ID_Sparepart
        GROUP BY ps.ID_Sparepart
        ORDER BY Jumlah_Beli DESC
        LIMIT 1
    ) AS SparepartQuery

    UNION ALL

    -- Query untuk menampilkan layanan yang paling banyak dibeli
    SELECT 'Service' AS Jenis, Nama_Service AS Nama, Jumlah_Beli
    FROM (
        SELECT sv.Nama_Service, COUNT(ps.ID_Service) AS Jumlah_Beli
        FROM Pembelian_Service ps
        INNER JOIN Service sv ON ps.ID_Service = sv.ID_Service
        GROUP BY ps.ID_Service
        ORDER BY Jumlah_Beli DESC
        LIMIT 1
    ) AS ServiceQuery;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Transaksi` (IN `ID_Transaksi` VARCHAR(11), IN `ID_Pelanggan` VARCHAR(11), IN `Tanggal_Pembelian` DATE, IN `Total_Biaya` INT, IN `ID_Pegawai` VARCHAR(11), IN `ID_Header` VARCHAR(11))   BEGIN
        INSERT INTO Transaksi VALUES (ID_Transaksi, ID_Pelanggan, Tanggal_Pembelian, Total_Biaya);
	INSERT INTO Header_Transaksi VALUES (ID_Header, ID_Pegawai, ID_Transaksi);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Data_Header_Transaksi` (IN `p_ID` VARCHAR(5), IN `p_ID_Pegawai` VARCHAR(5), IN `p_ID_Transaksi` VARCHAR(5))   BEGIN
    UPDATE Header_Transaksi
    SET
        ID_Pegawai = p_ID_Pegawai,
        ID_Transaksi = p_ID_Transaksi
    WHERE ID_Header = p_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Data_Jabatan` (IN `p_ID` VARCHAR(5), IN `p_Nama` VARCHAR(50), IN `p_Gaji` INT)   BEGIN
    UPDATE Jabatan
    SET
        Nama_Jabatan = p_Nama,
        Gaji = p_Gaji
    WHERE ID_Jabatan = p_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Data_Pegawai` (IN `p_ID_Pegawai` VARCHAR(5), IN `p_ID_Jabatan` VARCHAR(5), IN `p_Nama_Pegawai` VARCHAR(50), IN `p_Alamat` VARCHAR(50), IN `p_Username` VARCHAR(50), IN `p_PASSWORD` VARCHAR(50), IN `p_ID_Nomor` INT, IN `p_No_Telp` VARCHAR(15))   BEGIN
    UPDATE Pegawai
    SET
        ID_Jabatan = p_ID_Jabatan,
        Nama_Pegawai = p_Nama_Pegawai,
        Alamat = p_Alamat,
        Username = p_Username,
        PASSWORD = p_PASSWORD
    WHERE ID_Pegawai = p_ID_Pegawai;

    UPDATE Nomor_Pegawai
    SET
        ID_Nomor = p_ID_Nomor,
        No_Telp = p_No_Telp
    WHERE ID_Pegawai = p_ID_Pegawai;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Data_Pelanggan` (IN `p_ID` VARCHAR(5), IN `p_Nama` VARCHAR(50))   BEGIN
    UPDATE Pelanggan
    SET
        Nama_Pelanggan = p_Nama
    WHERE ID_Pelanggan = p_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Data_Pembelian_Service` (IN `p_ID` VARCHAR(5), IN `p_ID_Transaksi` VARCHAR(5), IN `p_ID_Pegawai` VARCHAR(5), IN `p_ID_Service` VARCHAR(5))   BEGIN
    UPDATE Pembelian_Service
    SET
        ID_Transaksi = p_ID_Transaksi,
        ID_Pegawai = p_ID_Pegawai,
        ID_Service = p_ID_Service
    WHERE ID_Pembelian_Service = p_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Data_Pembelian_Sparepart` (IN `p_ID` VARCHAR(5), IN `p_ID_Transaksi` VARCHAR(5), IN `p_ID_Sparepart` VARCHAR(5), IN `p_Jumlah` INT)   BEGIN
    UPDATE Pembelian_Sparepart
    SET
        ID_Transaksi = p_ID_Transaksi,
        ID_Sparepart = p_ID_Sparepart,
        Jumlah_Beli = p_Jumlah
    WHERE ID_Pembelian_Sparepart = p_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Data_Service` (IN `p_ID` VARCHAR(5), IN `p_Nama` VARCHAR(50), IN `p_Lama` INT, IN `p_Harga` INT)   BEGIN
    UPDATE Service
    SET
        Nama_Service = p_Nama,
        Lama_Pengerjaan = p_Lama,
        Harga = p_Harga
    WHERE ID_Service = p_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Data_Sparepart` (IN `p_ID` VARCHAR(5), IN `p_Nama` VARCHAR(50), IN `p_Stok` INT, IN `p_Jenis` VARCHAR(50), IN `p_Harga` INT)   BEGIN
    UPDATE Sparepart
    SET
        Nama_Sparepart = p_Nama,
        Stok = p_Stok,
        Jenis_Sparepart = p_Jenis,
        Harga = p_Harga
    WHERE ID_Sparepart = p_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Update_Data_Transaksi` (IN `p_ID` VARCHAR(5), IN `p_ID_Pelanggan` VARCHAR(5), IN `p_Tanggal` DATE, IN `p_Total` INT)   BEGIN
    UPDATE Transaksi
    SET
        ID_Pelanggan = p_ID_Pelanggan,
        Tanggal_Pembelian = p_Tanggal,
        Total_Biaya = p_Total
    WHERE ID_Transaksi = p_ID;
END$$

--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `Generate_Pembelian_Service_ID` (`p_ID_Pembelian_Service` VARCHAR(5)) RETURNS VARCHAR(50) CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
    DECLARE str VARCHAR(50);
    SET str = (SELECT CONCAT(
        LEFT((SELECT Nama_Pelanggan FROM Pelanggan WHERE ID_Pelanggan = (SELECT ID_Pelanggan FROM Transaksi WHERE ID_Transaksi = (SELECT ID_Transaksi FROM Pembelian_Service WHERE ID_Pembelian_Service = p_ID_Pembelian_Service))), 3),
        (SELECT ID_Transaksi FROM Pembelian_Service WHERE ID_Pembelian_Service = p_ID_Pembelian_Service),
        LEFT((SELECT Nama_Pegawai FROM Pegawai WHERE ID_Pegawai = (SELECT ID_Pegawai FROM Pembelian_Service WHERE ID_Pembelian_Service = p_ID_Pembelian_Service)), 3),
        (SELECT ID_Pelanggan FROM Transaksi WHERE ID_Transaksi = (SELECT ID_Transaksi FROM Pembelian_Service WHERE ID_Pembelian_Service = p_ID_Pembelian_Service)),
        FLOOR(RAND() * 100000)
    ));
    RETURN str;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Generate_Pembelian_Sparepart_ID` (`p_ID_Pembelian_Sparepart` VARCHAR(5)) RETURNS VARCHAR(50) CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
    DECLARE str VARCHAR(50);
    SET str = (SELECT CONCAT(
        LEFT((SELECT Nama_Pelanggan FROM Pelanggan WHERE ID_Pelanggan = (SELECT ID_Pelanggan FROM Transaksi WHERE ID_Transaksi = (SELECT ID_Transaksi FROM Pembelian_Sparepart WHERE ID_Pembelian_Sparepart = p_ID_Pembelian_Sparepart))), 3),
        ( SELECT ID_Pelanggan FROM Transaksi WHERE ID_Transaksi = (SELECT ID_Transaksi FROM Pembelian_Sparepart WHERE ID_Pembelian_Sparepart = p_ID_Pembelian_Sparepart)),
        LEFT((SELECT Nama_Pegawai FROM Pegawai WHERE ID_Pegawai = (SELECT ID_Pegawai FROM Header_Transaksi WHERE ID_Transaksi = (SELECT ID_Transaksi FROM Pembelian_Sparepart WHERE ID_Pembelian_Sparepart = p_ID_Pembelian_Sparepart))), 3),
        (SELECT DATE_FORMAT(Tanggal_Pembelian, '%d%m%Y') FROM Transaksi WHERE ID_Transaksi = (SELECT ID_Transaksi FROM Pembelian_Sparepart WHERE ID_Pembelian_Sparepart = p_ID_Pembelian_Sparepart)),
        FLOOR(RAND() * 100000)
    ));
    RETURN str;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Show_Sparepart_Service` (`p_ID_Transaksi` VARCHAR(5)) RETURNS TEXT CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
    DECLARE str TEXT;
    SET str = (SELECT GROUP_CONCAT(ID_Sparepart) FROM Pembelian_Sparepart WHERE ID_Transaksi = p_ID_Transaksi);
    SET str = CONCAT(str, ',', (SELECT GROUP_CONCAT(ID_Service) FROM Pembelian_Service WHERE ID_Transaksi = p_ID_Transaksi));
    RETURN str;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Show_Transaksi_Pegawai` (`p_ID_Pegawai` VARCHAR(5), `p_Tanggal` DATE) RETURNS TEXT CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
    DECLARE str TEXT;
    SET str = (SELECT GROUP_CONCAT(ID_Transaksi) FROM Header_Transaksi WHERE ID_Pegawai = p_ID_Pegawai);
    RETURN str;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `ban_dunlop`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `ban_dunlop` (
`ID_Sparepart` varchar(5)
,`Nama_Sparepart` varchar(50)
,`Stok` int(11)
,`Jenis_Sparepart` varchar(50)
,`Harga` int(11)
,`ID_Pembelian_Sparepart` varchar(5)
,`ID_Transaksi` varchar(5)
,`Jumlah_Beli` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `daftar_pegawai`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `daftar_pegawai` (
`ID_Pegawai` varchar(5)
,`Nama_Jabatan` varchar(50)
,`Nama_Pegawai` varchar(50)
,`Alamat` varchar(50)
,`Username` varchar(50)
,`Password` varchar(50)
,`ID_Nomor` int(11)
,`No_Telp` varchar(15)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `detail_transaksi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `detail_transaksi` (
`Nama_Pelanggan` varchar(50)
,`Nama_Pegawai` varchar(50)
,`Jumlah_Sparepart` bigint(21)
,`Jumlah_Service` bigint(21)
,`Tanggal_Pembelian` date
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `header_transaksi`
--

CREATE TABLE `header_transaksi` (
  `ID_Header` varchar(5) NOT NULL,
  `ID_Pegawai` varchar(5) DEFAULT NULL,
  `ID_Transaksi` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `header_transaksi`
--

INSERT INTO `header_transaksi` (`ID_Header`, `ID_Pegawai`, `ID_Transaksi`) VALUES
('H001', 'P002', 'T001'),
('H002', 'P003', 'T002'),
('H003', 'P004', 'T003'),
('H004', 'P005', 'T004'),
('H005', 'P002', 'T005'),
('H006', 'P003', 'T006');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `ID_Jabatan` varchar(5) NOT NULL,
  `Nama_Jabatan` varchar(50) DEFAULT NULL,
  `Gaji` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`ID_Jabatan`, `Nama_Jabatan`, `Gaji`) VALUES
('J001', 'MANAJER', 10000000),
('J002', 'KASIR', 5000000),
('J003', 'MONTIR', 7000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nomor_pegawai`
--

CREATE TABLE `nomor_pegawai` (
  `ID_Pegawai` varchar(5) DEFAULT NULL,
  `ID_Nomor` int(11) NOT NULL,
  `No_Telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nomor_pegawai`
--

INSERT INTO `nomor_pegawai` (`ID_Pegawai`, `ID_Nomor`, `No_Telp`) VALUES
('P001', 1, '082254678967'),
('P002', 2, '085647876499'),
('P003', 3, '081231323123'),
('P004', 4, '083213219321'),
('P005', 5, '082456456456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `ID_Pegawai` varchar(5) NOT NULL,
  `ID_Jabatan` varchar(5) DEFAULT NULL,
  `Nama_Pegawai` varchar(50) DEFAULT NULL,
  `Alamat` varchar(50) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`ID_Pegawai`, `ID_Jabatan`, `Nama_Pegawai`, `Alamat`, `Username`, `Password`) VALUES
('P001', 'J001', 'Budi', 'Jl. Bapakmu KM 5', 'budi', 'budi123'),
('P002', 'J002', 'Susi', 'Jl. Kalimana', 'susi', 'susi123'),
('P003', 'J003', 'Rudi', 'Jl. Jalan Aja', 'rudi', 'rudi123'),
('P004', 'J003', 'Tenz', 'Jl. Cinta NO 20', 'tenz', 'tenz123'),
('P005', 'J002', 'Jhonson', 'Jl. Valir', 'john', 'john123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `ID_Pelanggan` varchar(5) NOT NULL,
  `Nama_Pelanggan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`ID_Pelanggan`, `Nama_Pelanggan`) VALUES
('PL001', 'Amar'),
('PL002', 'Siti'),
('PL003', 'Rendi'),
('PL004', 'Rahman'),
('PL005', 'Bima');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pemasukan_pegawai_service`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `pemasukan_pegawai_service` (
`ID_Pegawai` varchar(5)
,`Nama_Pegawai` varchar(50)
,`Nama_Jabatan` varchar(50)
,`Nama_Service` varchar(50)
,`Harga` int(11)
,`Jumlah_Service` bigint(21)
,`Total_Pemasukan` bigint(31)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_service`
--

CREATE TABLE `pembelian_service` (
  `ID_Pembelian_Service` varchar(5) NOT NULL,
  `ID_Transaksi` varchar(5) DEFAULT NULL,
  `ID_Pegawai` varchar(5) DEFAULT NULL,
  `ID_Service` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian_service`
--

INSERT INTO `pembelian_service` (`ID_Pembelian_Service`, `ID_Transaksi`, `ID_Pegawai`, `ID_Service`) VALUES
('PS001', 'T007', 'P001', 'S003'),
('PS002', 'T002', 'P003', 'S002'),
('PS003', 'T003', 'P004', 'S003'),
('PS004', 'T004', 'P005', 'S004'),
('PS005', 'T005', 'P002', 'S005'),
('PS006', 'T002', 'P004', 'S002');

--
-- Trigger `pembelian_service`
--
DELIMITER $$
CREATE TRIGGER `UpdateTotalBiayaADPembelianService` AFTER DELETE ON `pembelian_service` FOR EACH ROW BEGIN
        UPDATE Transaksi
        SET Total_Biaya = Total_Biaya - (SELECT Harga FROM Service WHERE ID_Service = OLD.ID_Service)
        WHERE ID_Transaksi = OLD.ID_Transaksi;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateTotalBiayaAIPembelianService` AFTER INSERT ON `pembelian_service` FOR EACH ROW BEGIN
        UPDATE Transaksi
        SET Total_Biaya = Total_Biaya + (SELECT Harga FROM Service WHERE ID_Service = NEW.ID_Service)
        WHERE ID_Transaksi = NEW.ID_Transaksi;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateTotalBiayaAUPembelianService` AFTER UPDATE ON `pembelian_service` FOR EACH ROW BEGIN
        UPDATE Transaksi
        SET Total_Biaya = Total_Biaya - (SELECT Harga FROM Service WHERE ID_Service = OLD.ID_Service) + (SELECT Harga FROM Service WHERE ID_Service = NEW.ID_Service)
        WHERE ID_Transaksi = NEW.ID_Transaksi;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_sparepart`
--

CREATE TABLE `pembelian_sparepart` (
  `ID_Pembelian_Sparepart` varchar(5) NOT NULL,
  `ID_Transaksi` varchar(5) DEFAULT NULL,
  `ID_Sparepart` varchar(5) DEFAULT NULL,
  `Jumlah_Beli` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian_sparepart`
--

INSERT INTO `pembelian_sparepart` (`ID_Pembelian_Sparepart`, `ID_Transaksi`, `ID_Sparepart`, `Jumlah_Beli`) VALUES
('SR001', 'T001', 'SP001', 4),
('SR002', 'T002', 'SP002', 8),
('SR003', 'T003', 'SP003', 4),
('SR004', 'T004', 'SP004', 2),
('SR005', 'T005', 'SP005', 5);

--
-- Trigger `pembelian_sparepart`
--
DELIMITER $$
CREATE TRIGGER `UpdateJumlahStokADPembelianSparepart` AFTER DELETE ON `pembelian_sparepart` FOR EACH ROW BEGIN
        UPDATE Sparepart
        SET Stok = Stok + OLD.Jumlah_Beli
        WHERE ID_Sparepart = OLD.ID_Sparepart;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateJumlahStokAIPembelianSparepart` AFTER INSERT ON `pembelian_sparepart` FOR EACH ROW BEGIN
        UPDATE Sparepart
        SET Stok = Stok - NEW.Jumlah_Beli
        WHERE ID_Sparepart = NEW.ID_Sparepart;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateJumlahStokAUPembelianSparepart` AFTER UPDATE ON `pembelian_sparepart` FOR EACH ROW BEGIN
        UPDATE Sparepart
        SET Stok = Stok + OLD.Jumlah_Beli
        WHERE ID_Sparepart = OLD.ID_Sparepart;

        UPDATE Sparepart
        SET Stok = Stok - NEW.Jumlah_Beli
        WHERE ID_Sparepart = NEW.ID_Sparepart;
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateTotalBiayaADPembelianSparepart` AFTER DELETE ON `pembelian_sparepart` FOR EACH ROW BEGIN
        UPDATE Transaksi
        SET Total_Biaya = Total_Biaya - (SELECT Harga * OLD.Jumlah_Beli FROM Sparepart WHERE ID_Sparepart = OLD.ID_Sparepart)
        WHERE ID_Transaksi = OLD.ID_Transaksi;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateTotalBiayaAIPembelianSparepart` AFTER INSERT ON `pembelian_sparepart` FOR EACH ROW BEGIN
        UPDATE Transaksi
        SET Total_Biaya = Total_Biaya + (SELECT Harga * NEW.Jumlah_Beli FROM Sparepart WHERE ID_Sparepart = NEW.ID_Sparepart)
        WHERE ID_Transaksi = NEW.ID_Transaksi;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateTotalBiayaAUPembelianSparepart` AFTER UPDATE ON `pembelian_sparepart` FOR EACH ROW BEGIN
        UPDATE Transaksi
        SET Total_Biaya = Total_Biaya - (SELECT Harga * OLD.Jumlah_Beli FROM Sparepart WHERE ID_Sparepart = OLD.ID_Sparepart) + (SELECT Harga * NEW.Jumlah_Beli FROM Sparepart WHERE ID_Sparepart = NEW.ID_Sparepart)
        WHERE ID_Transaksi = NEW.ID_Transaksi;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `service`
--

CREATE TABLE `service` (
  `ID_Service` varchar(5) NOT NULL,
  `Nama_Service` varchar(50) DEFAULT NULL,
  `Lama_Pengerjaan` int(11) DEFAULT NULL,
  `Harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `service`
--

INSERT INTO `service` (`ID_Service`, `Nama_Service`, `Lama_Pengerjaan`, `Harga`) VALUES
('S001', 'Ganti Oli', 1, 50000),
('S002', 'Ganti Ban', 2, 100000),
('S003', 'Ganti Kampas Rem', 3, 150000),
('S004', 'Ganti Kampas Kopling', 4, 1000),
('S005', 'Ganti Busi', 5, 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sparepart`
--

CREATE TABLE `sparepart` (
  `ID_Sparepart` varchar(5) NOT NULL,
  `Nama_Sparepart` varchar(50) DEFAULT NULL,
  `Stok` int(11) DEFAULT NULL,
  `Jenis_Sparepart` varchar(50) DEFAULT NULL,
  `Harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sparepart`
--

INSERT INTO `sparepart` (`ID_Sparepart`, `Nama_Sparepart`, `Stok`, `Jenis_Sparepart`, `Harga`) VALUES
('SP001', 'Ban', 95, 'Kendaraan', 150000),
('SP002', 'Oli', 205, 'Oli', 50000),
('SP003', 'Kampas Rem', 300, 'Rem', 200000),
('SP004', 'Kampas Kopling', 400, 'Kopling', 300000),
('SP005', 'Busi', 500, 'Busi', 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `ID_Transaksi` varchar(5) NOT NULL,
  `ID_Pelanggan` varchar(5) DEFAULT NULL,
  `Tanggal_Pembelian` date DEFAULT NULL,
  `Total_Biaya` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`ID_Transaksi`, `ID_Pelanggan`, `Tanggal_Pembelian`, `Total_Biaya`) VALUES
('T001', 'PL001', '2021-01-01', 1300000),
('T002', 'PL002', '2021-01-02', 2050000),
('T003', 'PL003', '2021-01-08', 10400000),
('T004', 'PL004', '2021-01-04', 4000000),
('T005', 'PL005', '2021-01-05', 5000000),
('T006', 'PL002', '2021-01-06', 19250000),
('T007', 'PL004', '2024-04-03', 150000);

-- --------------------------------------------------------

--
-- Struktur untuk view `ban_dunlop`
--
DROP TABLE IF EXISTS `ban_dunlop`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ban_dunlop`  AS SELECT `sp`.`ID_Sparepart` AS `ID_Sparepart`, `sp`.`Nama_Sparepart` AS `Nama_Sparepart`, `sp`.`Stok` AS `Stok`, `sp`.`Jenis_Sparepart` AS `Jenis_Sparepart`, `sp`.`Harga` AS `Harga`, `ps`.`ID_Pembelian_Sparepart` AS `ID_Pembelian_Sparepart`, `ps`.`ID_Transaksi` AS `ID_Transaksi`, `ps`.`Jumlah_Beli` AS `Jumlah_Beli` FROM (`sparepart` `sp` join `pembelian_sparepart` `ps` on(`sp`.`ID_Sparepart` = `ps`.`ID_Sparepart`)) WHERE `sp`.`Nama_Sparepart` = 'Ban' AND `sp`.`Jenis_Sparepart` = 'Kendaraan' ;

-- --------------------------------------------------------

--
-- Struktur untuk view `daftar_pegawai`
--
DROP TABLE IF EXISTS `daftar_pegawai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daftar_pegawai`  AS SELECT `pg`.`ID_Pegawai` AS `ID_Pegawai`, `j`.`Nama_Jabatan` AS `Nama_Jabatan`, `pg`.`Nama_Pegawai` AS `Nama_Pegawai`, `pg`.`Alamat` AS `Alamat`, `pg`.`Username` AS `Username`, `pg`.`Password` AS `Password`, `np`.`ID_Nomor` AS `ID_Nomor`, `np`.`No_Telp` AS `No_Telp` FROM ((`pegawai` `pg` join `jabatan` `j` on(`pg`.`ID_Jabatan` = `j`.`ID_Jabatan`)) join `nomor_pegawai` `np` on(`pg`.`ID_Pegawai` = `np`.`ID_Pegawai`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `detail_transaksi`
--
DROP TABLE IF EXISTS `detail_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_transaksi`  AS SELECT `pl`.`Nama_Pelanggan` AS `Nama_Pelanggan`, `pg`.`Nama_Pegawai` AS `Nama_Pegawai`, count(`ps`.`ID_Sparepart`) AS `Jumlah_Sparepart`, count(`psv`.`ID_Service`) AS `Jumlah_Service`, `t`.`Tanggal_Pembelian` AS `Tanggal_Pembelian` FROM (((((`pelanggan` `pl` join `transaksi` `t` on(`pl`.`ID_Pelanggan` = `t`.`ID_Pelanggan`)) join `header_transaksi` `ht` on(`t`.`ID_Transaksi` = `ht`.`ID_Transaksi`)) join `pegawai` `pg` on(`ht`.`ID_Pegawai` = `pg`.`ID_Pegawai`)) join `pembelian_sparepart` `ps` on(`t`.`ID_Transaksi` = `ps`.`ID_Transaksi`)) join `pembelian_service` `psv` on(`t`.`ID_Transaksi` = `psv`.`ID_Transaksi`)) GROUP BY `t`.`ID_Transaksi` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `pemasukan_pegawai_service`
--
DROP TABLE IF EXISTS `pemasukan_pegawai_service`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pemasukan_pegawai_service`  AS SELECT `pg`.`ID_Pegawai` AS `ID_Pegawai`, `pg`.`Nama_Pegawai` AS `Nama_Pegawai`, `j`.`Nama_Jabatan` AS `Nama_Jabatan`, `sv`.`Nama_Service` AS `Nama_Service`, `sv`.`Harga` AS `Harga`, count(`ps`.`ID_Service`) AS `Jumlah_Service`, `sv`.`Harga`* count(`ps`.`ID_Service`) AS `Total_Pemasukan` FROM (((`pegawai` `pg` join `jabatan` `j` on(`pg`.`ID_Jabatan` = `j`.`ID_Jabatan`)) join `pembelian_service` `ps` on(`pg`.`ID_Pegawai` = `ps`.`ID_Pegawai`)) join `service` `sv` on(`ps`.`ID_Service` = `sv`.`ID_Service`)) WHERE `pg`.`ID_Jabatan` = 'J003' GROUP BY `pg`.`ID_Pegawai`, `sv`.`ID_Service` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `header_transaksi`
--
ALTER TABLE `header_transaksi`
  ADD PRIMARY KEY (`ID_Header`),
  ADD KEY `ID_Pegawai` (`ID_Pegawai`),
  ADD KEY `ID_Transaksi` (`ID_Transaksi`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`ID_Jabatan`);

--
-- Indeks untuk tabel `nomor_pegawai`
--
ALTER TABLE `nomor_pegawai`
  ADD PRIMARY KEY (`ID_Nomor`),
  ADD KEY `ID_Pegawai` (`ID_Pegawai`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`ID_Pegawai`),
  ADD KEY `ID_Jabatan` (`ID_Jabatan`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`ID_Pelanggan`);

--
-- Indeks untuk tabel `pembelian_service`
--
ALTER TABLE `pembelian_service`
  ADD PRIMARY KEY (`ID_Pembelian_Service`),
  ADD KEY `ID_Transaksi` (`ID_Transaksi`),
  ADD KEY `ID_Pegawai` (`ID_Pegawai`),
  ADD KEY `ID_Service` (`ID_Service`);

--
-- Indeks untuk tabel `pembelian_sparepart`
--
ALTER TABLE `pembelian_sparepart`
  ADD PRIMARY KEY (`ID_Pembelian_Sparepart`),
  ADD KEY `ID_Transaksi` (`ID_Transaksi`),
  ADD KEY `ID_Sparepart` (`ID_Sparepart`);

--
-- Indeks untuk tabel `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ID_Service`);

--
-- Indeks untuk tabel `sparepart`
--
ALTER TABLE `sparepart`
  ADD PRIMARY KEY (`ID_Sparepart`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_Transaksi`),
  ADD KEY `ID_Pelanggan` (`ID_Pelanggan`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `header_transaksi`
--
ALTER TABLE `header_transaksi`
  ADD CONSTRAINT `header_transaksi_ibfk_1` FOREIGN KEY (`ID_Pegawai`) REFERENCES `pegawai` (`ID_Pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `header_transaksi_ibfk_2` FOREIGN KEY (`ID_Transaksi`) REFERENCES `transaksi` (`ID_Transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nomor_pegawai`
--
ALTER TABLE `nomor_pegawai`
  ADD CONSTRAINT `nomor_pegawai_ibfk_1` FOREIGN KEY (`ID_Pegawai`) REFERENCES `pegawai` (`ID_Pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`ID_Jabatan`) REFERENCES `jabatan` (`ID_Jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembelian_service`
--
ALTER TABLE `pembelian_service`
  ADD CONSTRAINT `pembelian_service_ibfk_1` FOREIGN KEY (`ID_Transaksi`) REFERENCES `transaksi` (`ID_Transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_service_ibfk_2` FOREIGN KEY (`ID_Pegawai`) REFERENCES `pegawai` (`ID_Pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_service_ibfk_3` FOREIGN KEY (`ID_Service`) REFERENCES `service` (`ID_Service`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembelian_sparepart`
--
ALTER TABLE `pembelian_sparepart`
  ADD CONSTRAINT `pembelian_sparepart_ibfk_1` FOREIGN KEY (`ID_Transaksi`) REFERENCES `transaksi` (`ID_Transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_sparepart_ibfk_2` FOREIGN KEY (`ID_Sparepart`) REFERENCES `sparepart` (`ID_Sparepart`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`ID_Pelanggan`) REFERENCES `pelanggan` (`ID_Pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
