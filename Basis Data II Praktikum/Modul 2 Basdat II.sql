# BY AIPPproject03
# Nama : A.Irwin Putra Pangesti
# NIM  : 223020503162
# SOAL 1:
DELIMITER $$
CREATE PROCEDURE `bengkel_mobil`.`Show_Most_Purchased_Items`()
BEGIN
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
DELIMITER ;
CALL Show_Most_Purchased_Items();

# SOAL 2:
DELIMITER $$
CREATE PROCEDURE `bengkel_mobil`.`Show_Most_Expensive_Items`()
BEGIN
    -- Query untuk menampilkan harga sparepart yang paling mahal
    (SELECT 'Sparepart' AS Jenis, Nama_Sparepart AS Nama, Harga
    FROM Sparepart ORDER BY Harga DESC LIMIT 1)

    UNION ALL

    -- Query untuk menampilkan harga layanan yang paling mahal
    (SELECT 'Service' AS Jenis, Nama_Service AS Nama, Harga
    FROM Service ORDER BY Harga DESC LIMIT 1);
END$$
DELIMITER ;
CALL Show_Most_Expensive_Items();

# SOAL 3:
DELIMITER $$
CREATE PROCEDURE `bengkel_mobil`.`Show_Cheapest_Items`()
BEGIN
    -- Query untuk menampilkan harga sparepart yang paling murah
    (SELECT 'Sparepart' AS Jenis, Nama_Sparepart AS Nama, Harga
    FROM Sparepart ORDER BY Harga ASC LIMIT 1)

    UNION ALL

    -- Query untuk menampilkan harga layanan yang paling murah
    (SELECT 'Service' AS Jenis, Nama_Service AS Nama, Harga
    FROM Service ORDER BY Harga ASC LIMIT 1);
END$$
DELIMITER ;
CALL Show_Cheapest_Items();

# SOAL 4:
DELIMITER $$
CREATE PROCEDURE `bengkel_mobil`.`Count_Sparepart_Transactions`()
BEGIN
    -- Query untuk menghitung banyaknya transaksi pembelian sparepart
    SELECT COUNT(ID_Pembelian_Sparepart) AS Jumlah_Transaksi
    FROM Pembelian_Sparepart;
END$$
DELIMITER ;
CALL Count_Sparepart_Transactions();

# SOAL 5:
DELIMITER $$
CREATE FUNCTION `bengkel_mobil`.`Generate_Pembelian_Sparepart_ID`(
    p_ID_Pelanggan VARCHAR(5),
    p_ID_Pegawai VARCHAR(5),
    p_Tanggal DATE
)
RETURNS VARCHAR(50)
BEGIN
    DECLARE str VARCHAR(50);
    SET str = (SELECT CONCAT(
        LEFT((SELECT Nama_Pelanggan FROM Pelanggan WHERE ID_Pelanggan = p_ID_Pelanggan), 3),
        p_ID_Pelanggan,
        'and',
        LEFT((SELECT Nama_Pegawai FROM Pegawai WHERE ID_Pegawai = p_ID_Pegawai), 3),
        DATE_FORMAT(p_Tanggal, '%d%m%Y'),
        FLOOR(RAND() * 100000)
    ));
    RETURN str;
END$$
DELIMITER ;
SELECT Generate_Pembelian_Sparepart_ID('PL004', 'P001', '2021-01-01');

# SOAL 6:
DELIMITER $$
CREATE FUNCTION `bengkel_mobil`.`Generate_Pembelian_Service_ID`(
    p_ID_Pelanggan VARCHAR(5),
    p_ID_Pegawai VARCHAR(5),
    p_ID_Service VARCHAR(5)
)
RETURNS VARCHAR(50)
BEGIN
    DECLARE str VARCHAR(50);
    SET str = (SELECT CONCAT(
        LEFT((SELECT Nama_Pelanggan FROM Pelanggan WHERE ID_Pelanggan = p_ID_Pelanggan), 3),
        p_ID_Pelanggan,
        'and',
        LEFT((SELECT Nama_Pegawai FROM Pegawai WHERE ID_Pegawai = p_ID_Pegawai), 3),
        p_ID_Pegawai,
        FLOOR(RAND() * 100000)
    ));
    RETURN str;
END$$
DELIMITER ;
SELECT Generate_Pembelian_Service_ID('PL001', 'P001', 'S001');
