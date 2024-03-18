# BY AIPPproject03
# Nama : A.Irwin Putra Pangesti
# NIM  : 223020503162
# CREATE TABLE:
CREATE TABLE Jabatan (
    ID_Jabatan VARCHAR(5),
    Nama_Jabatan VARCHAR(50),
    Gaji INT
);
CREATE TABLE Pegawai (
    ID_Pegawai VARCHAR(5),
    ID_Jabatan VARCHAR(5),
    Nama_Pegawai VARCHAR(50),
    Alamat VARCHAR(50),
    Username VARCHAR(50),
    Password VARCHAR(50)
);
CREATE TABLE Nomor_Pegawai (
    ID_Pegawai VARCHAR(5),
    ID_Nomor INT,
    No_Telp VARCHAR(15)
);

CREATE TABLE Header_Transaksi (
    ID_Header VARCHAR(5),
    ID_Pegawai VARCHAR(5),
    ID_Transaksi VARCHAR(5)
);
CREATE TABLE Transaksi (
    ID_Transaksi VARCHAR(5),
    ID_Pelanggan VARCHAR(5),
    Tanggal_Pembelian DATE,
    Total_Biaya INT
);
CREATE TABLE Pembelian_Sparepart (
    ID_Pembelian_Sparepart VARCHAR(5),
    ID_Transaksi VARCHAR(5),
    ID_Sparepart VARCHAR(5),
    Jumlah_Beli INT
);
CREATE TABLE Sparepart (
    ID_Sparepart VARCHAR(5),
    Nama_Sparepart VARCHAR(50),
    Stok INT,
    Jenis_Sparepart VARCHAR(50),
    Harga INT
);
CREATE TABLE Pelanggan (
    ID_Pelanggan VARCHAR(5),
    Nama_Pelanggan VARCHAR(50)
);
CREATE TABLE Pembelian_Service (
    ID_Pembelian_Service VARCHAR(5),
    ID_Transaksi VARCHAR(5),
    ID_Pegawai VARCHAR(5),
    ID_Service VARCHAR(5)
);
CREATE TABLE Service (
    ID_Service VARCHAR(5),
    Nama_Service VARCHAR(50),
    Lama_Pengerjaan INT,
    Harga INT
);

# CREATE PRIMARY KEY:
ALTER TABLE Pegawai
    ADD PRIMARY KEY (ID_Pegawai);
ALTER TABLE Jabatan
    ADD PRIMARY KEY (ID_Jabatan);
ALTER TABLE Nomor_Pegawai
    ADD PRIMARY KEY (ID_Nomor);
ALTER TABLE Header_Transaksi
    ADD PRIMARY KEY (ID_Header);
ALTER TABLE Pelanggan
    ADD PRIMARY KEY (ID_Pelanggan);
ALTER TABLE Transaksi
    ADD PRIMARY KEY (ID_Transaksi);
ALTER TABLE Pembelian_Sparepart
    ADD PRIMARY KEY (ID_Pembelian_Sparepart);
ALTER TABLE Sparepart
    ADD PRIMARY KEY (ID_Sparepart);
ALTER TABLE Pembelian_Service
    ADD PRIMARY KEY (ID_Pembelian_Service);
ALTER TABLE Service
    ADD PRIMARY KEY (ID_Service);

# CREATE FOREIGN KEY:
ALTER TABLE Pegawai
    ADD FOREIGN KEY (ID_Jabatan) REFERENCES Jabatan(ID_Jabatan) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Nomor_Pegawai
    ADD FOREIGN KEY (ID_Pegawai) REFERENCES Pegawai(ID_Pegawai) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Header_Transaksi
    ADD FOREIGN KEY (ID_Pegawai) REFERENCES Pegawai(ID_Pegawai) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD FOREIGN KEY (ID_Transaksi) REFERENCES Transaksi(ID_Transaksi) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Transaksi
    ADD FOREIGN KEY (ID_Pelanggan) REFERENCES Pelanggan(ID_Pelanggan) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Pembelian_Sparepart
    ADD FOREIGN KEY (ID_Transaksi) REFERENCES Transaksi(ID_Transaksi) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD FOREIGN KEY (ID_Sparepart) REFERENCES Sparepart(ID_Sparepart) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Pembelian_Service
    ADD FOREIGN KEY (ID_Transaksi) REFERENCES Transaksi(ID_Transaksi) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD FOREIGN KEY (ID_Pegawai) REFERENCES Pegawai(ID_Pegawai) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD FOREIGN KEY (ID_Service) REFERENCES Service(ID_Service) ON DELETE CASCADE ON UPDATE CASCADE;

# INSERT DATA RECORD:
INSERT INTO Jabatan VALUES
    ('J001', 'MANAJER', 10000000),
    ('J002', 'KASIR', 5000000),
    ('J003', 'MONTIR', 7000000);

INSERT INTO Pegawai VALUES
    ('P001', 'J001', 'Budi', 'Jl. Bapakmu KM 5', 'budi', 'budi123'),
    ('P002', 'J002', 'Susi', 'Jl. Kalimana', 'susi', 'susi123'),
    ('P003', 'J003', 'Rudi', 'Jl. Jalan Aja', 'rudi', 'rudi123'),
    ('P004', 'J003', 'Tenz', 'Jl. Cinta NO 20', 'tenz', 'tenz123'),
    ('P005', 'J002', 'Melly', 'Jl. Valorant', 'melly', 'melly123');

INSERT INTO Nomor_Pegawai VALUES
    ('P001', 1, '082254678967'),
    ('P002', 2, '085647876499'),
    ('P003', 3, '081231323123'),
    ('P004', 4, '083213219321'),
    ('P005', 5, '082456456456');

INSERT INTO Header_Transaksi VALUES
    ('H001', 'P002', 'T001'),
    ('H002', 'P003', 'T002'),
    ('H003', 'P004', 'T003'),
    ('H004', 'P005', 'T004'),
    ('H005', 'P002', 'T005');

INSERT INTO Transaksi VALUES
    ('T001', 'PL001', '2021-01-01', 1000000),
    ('T002', 'PL002', '2021-01-02', 2000000),
    ('T003', 'PL003', '2021-01-03', 3000000),
    ('T004', 'PL004', '2021-01-04', 4000000),
    ('T005', 'PL005', '2021-01-05', 5000000);

INSERT INTO Pembelian_Sparepart VALUES
    ('PS001', 'T001', 'SP001', 10),
    ('PS002', 'T002', 'SP002', 20),
    ('PS003', 'T003', 'SP003', 30),
    ('PS004', 'T004', 'SP004', 40),
    ('PS005', 'T005', 'SP005', 50);

INSERT INTO Sparepart VALUES
    ('SP001', 'Ban', 100, 'Kendaraan', 100000),
    ('SP002', 'Oli', 200, 'Oli', 50000),
    ('SP003', 'Kampas Rem', 300, 'Rem', 200000),
    ('SP004', 'Kampas Kopling', 400, 'Kopling', 300000),
    ('SP005', 'Busi', 500, 'Busi', 10000);

INSERT INTO Pelanggan VALUES
    ('PL001', 'Amar'),
    ('PL002', 'Siti'),
    ('PL003', 'Rendi'),
    ('PL004', 'Rahman'),
    ('PL005', 'Bima');

INSERT INTO Pembelian_Service VALUES
    ('PS001', 'T001', 'P002', 'S001'),
    ('PS002', 'T002', 'P003', 'S002'),
    ('PS003', 'T003', 'P004', 'S003'),
    ('PS004', 'T004', 'P005', 'S004'),
    ('PS005', 'T005', 'P002', 'S005');

INSERT INTO Service VALUES
    ('S001', 'Ganti Oli', 1, 50000),
    ('S002', 'Ganti Ban', 2, 100000),
    ('S003', 'Ganti Kampas Rem', 3, 150000),
    ('S004', 'Ganti Kampas Kopling', 4, 200000),
    ('S005', 'Ganti Busi', 5, 25000);

# NOMOR 1:
DELIMITER $$
CREATE
    PROCEDURE `bengkel_mobil`.`Insert_Data_Pegawai`(
	    IN ID_Pegawai VARCHAR(5),
        IN ID_Jabatan VARCHAR(5),
        IN Nama_Pegawai VARCHAR(50),
        IN Alamat VARCHAR(50),
        IN Username VARCHAR(50),
        IN PASSWORD VARCHAR(50),
        IN ID_Nomor INT,
        IN No_Telp VARCHAR(15)
    )
    BEGIN
	    INSERT INTO Pegawai VALUES (ID_Pegawai, ID_Jabatan, Nama_Pegawai, Alamat, Username, PASSWORD);
        INSERT INTO Nomor_Pegawai VALUES (ID_Pegawai, ID_Nomor, No_Telp);
    END$$
DELIMITER ;
CALL Insert_Data_Pegawai('P006', 'J001', 'Budi', 'Jl. Bapakmu KM 5', 'budi', 'budi123', 6, '082254678967');

DELIMITER $$
CREATE
    PROCEDURE `bengkel_mobil`.`Transaksi`(
	    IN ID_Transaksi VARCHAR(11),
	    IN ID_Pelanggan VARCHAR(11),
        IN Tanggal_Pembelian DATE,
	    IN Total_Biaya  INT,
	    IN ID_Pegawai   VARCHAR(11),
	    IN ID_Header    VARCHAR(11)
    )
    BEGIN
        INSERT INTO Transaksi VALUES (ID_Transaksi, ID_Pelanggan, Tanggal_Pembelian, Total_Biaya);
	    INSERT INTO Header_Transaksi VALUES (ID_Header, ID_Pegawai, ID_Transaksi);
    END$$
DELIMITER ;
CALL Transaksi('T006', 'PL002', '2021-01-06', 6000000, 'P003', 'H006');


# NOMOR 2:
DELIMITER $$
CREATE
    PROCEDURE `bengkel_mobil`.`Insert_Data_Jabatan`(
        IN ID_Jabatan VARCHAR(5),
        IN Nama_Jabatan VARCHAR(50),
        IN Gaji INT
    )
    BEGIN
        INSERT INTO Jabatan VALUES (ID_Jabatan, Nama_Jabatan, Gaji);
    END$$
DELIMITER ;

DELIMITER $$
CREATE
    PROCEDURE `bengkel_mobil`.`Insert_Data_Pelanggan`(
        IN ID_Pelanggan VARCHAR(5),
        IN Nama_Pelanggan VARCHAR(50)
    )
    BEGIN
        INSERT INTO Pelanggan VALUES (ID_Pelanggan, Nama_Pelanggan);
    END$$
DELIMITER ;

DELIMITER $$
CREATE
    PROCEDURE `bengkel_mobil`.`Insert_Data_Sparepart`(
        IN ID_Sparepart VARCHAR(5),
        IN Nama_Sparepart VARCHAR(50),
        IN Stok INT,
        IN Jenis_Sparepart VARCHAR(50),
        IN Harga INT
    )
    BEGIN
        INSERT INTO Sparepart VALUES (ID_Sparepart, Nama_Sparepart, Stok, Jenis_Sparepart, Harga);
    END$$
DELIMITER ;

DELIMITER $$
CREATE
    PROCEDURE `bengkel_mobil`.`Insert_Data_Service`(
        IN ID_Service VARCHAR(5),
        IN Nama_Service VARCHAR(50),
        IN Lama_Pengerjaan INT,
        IN Harga INT
    )
    BEGIN
        INSERT INTO Service VALUES (ID_Service, Nama_Service, Lama_Pengerjaan, Harga);
    END$$
DELIMITER ;

DELIMITER $$
CREATE
    PROCEDURE `bengkel_mobil`.`Insert_Data_Pembelian_Sparepart`(
        IN ID_Pembelian_Sparepart VARCHAR(5),
        IN ID_Transaksi VARCHAR(5),
        IN ID_Sparepart VARCHAR(5),
        IN Jumlah_Beli INT
    )
    BEGIN
        INSERT INTO Pembelian_Sparepart VALUES (ID_Pembelian_Sparepart, ID_Transaksi, ID_Sparepart, Jumlah_Beli);
    END$$
DELIMITER ;

DELIMITER $$
CREATE
    PROCEDURE `bengkel_mobil`.`Insert_Data_Pembelian_Service`(
        IN ID_Pembelian_Service VARCHAR(5),
        IN ID_Transaksi VARCHAR(5),
        IN ID_Pegawai VARCHAR(5),
        IN ID_Service VARCHAR(5)
    )
    BEGIN
        INSERT INTO Pembelian_Service VALUES (ID_Pembelian_Service, ID_Transaksi, ID_Pegawai, ID_Service);
    END$$
DELIMITER ;

# NOMOR 3:
DELIMITER $$
CREATE
    PROCEDURE `bengkel_mobil`.`Delete_Data`(
        IN ID VARCHAR(5),
        IN Tabel VARCHAR(50)
    )
    BEGIN
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
DELIMITER ;
CALL Delete_Data('P006', 'Pegawai');
# NOMOR 4:
DELIMITER $$
CREATE PROCEDURE `bengkel_mobil`.`Update_Data_Pegawai`(
    IN p_ID_Pegawai VARCHAR(5),
    IN p_ID_Jabatan VARCHAR(5),
    IN p_Nama_Pegawai VARCHAR(50),
    IN p_Alamat VARCHAR(50),
    IN p_Username VARCHAR(50),
    IN p_PASSWORD VARCHAR(50),
    IN p_ID_Nomor INT,
    IN p_No_Telp VARCHAR(15)
)
BEGIN
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
DELIMITER ;
CALL Update_Data_Pegawai('P001', 'J001', 'Budi', 'Jl. Bapakmu KM 5', 'budi', 'budi123', 1, '082254678967');

# NOMOR 5:
DELIMITER $$
CREATE PROCEDURE `bengkel_mobil`.`Update_Data_Sparepart`(
    IN p_ID VARCHAR(5),
    IN p_Nama VARCHAR(50),
    IN p_Stok INT,
    IN p_Jenis VARCHAR(50),
    IN p_Harga INT
)
BEGIN
    UPDATE Sparepart
    SET
        Nama_Sparepart = p_Nama,
        Stok = p_Stok,
        Jenis_Sparepart = p_Jenis,
        Harga = p_Harga
    WHERE ID_Sparepart = p_ID;
END$$
DELIMITER ;
CALL Update_Data_Sparepart('SP001', 'Ban', 100, 'Kendaraan', 150000);

DELIMITER $$
CREATE PROCEDURE `bengkel_mobil`.`Update_Data_Service`(
    IN p_ID VARCHAR(5),
    IN p_Nama VARCHAR(50),
    IN p_Lama INT,
    IN p_Harga INT
)
BEGIN
    UPDATE Service
    SET
        Nama_Service = p_Nama,
        Lama_Pengerjaan = p_Lama,
        Harga = p_Harga
    WHERE ID_Service = p_ID;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `bengkel_mobil`.`Update_Data_Pelanggan`(
    IN p_ID VARCHAR(5),
    IN p_Nama VARCHAR(50)
)
BEGIN
    UPDATE Pelanggan
    SET
        Nama_Pelanggan = p_Nama
    WHERE ID_Pelanggan = p_ID;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `bengkel_mobil`.`Update_Data_Transaksi`(
    IN p_ID VARCHAR(5),
    IN p_ID_Pelanggan VARCHAR(5),
    IN p_Tanggal DATE,
    IN p_Total INT
)
BEGIN
    UPDATE Transaksi
    SET
        ID_Pelanggan = p_ID_Pelanggan,
        Tanggal_Pembelian = p_Tanggal,
        Total_Biaya = p_Total
    WHERE ID_Transaksi = p_ID;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `bengkel_mobil`.`Update_Data_Pembelian_Sparepart`(
    IN p_ID VARCHAR(5),
    IN p_ID_Transaksi VARCHAR(5),
    IN p_ID_Sparepart VARCHAR(5),
    IN p_Jumlah INT
)
BEGIN
    UPDATE Pembelian_Sparepart
    SET
        ID_Transaksi = p_ID_Transaksi,
        ID_Sparepart = p_ID_Sparepart,
        Jumlah_Beli = p_Jumlah
    WHERE ID_Pembelian_Sparepart = p_ID;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `bengkel_mobil`.`Update_Data_Pembelian_Service`(
    IN p_ID VARCHAR(5),
    IN p_ID_Transaksi VARCHAR(5),
    IN p_ID_Pegawai VARCHAR(5),
    IN p_ID_Service VARCHAR(5)
)
BEGIN
    UPDATE Pembelian_Service
    SET
        ID_Transaksi = p_ID_Transaksi,
        ID_Pegawai = p_ID_Pegawai,
        ID_Service = p_ID_Service
    WHERE ID_Pembelian_Service = p_ID;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `bengkel_mobil`.`Update_Data_Header_Transaksi`(
    IN p_ID VARCHAR(5),
    IN p_ID_Pegawai VARCHAR(5),
    IN p_ID_Transaksi VARCHAR(5)
)
BEGIN
    UPDATE Header_Transaksi
    SET
        ID_Pegawai = p_ID_Pegawai,
        ID_Transaksi = p_ID_Transaksi
    WHERE ID_Header = p_ID;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `bengkel_mobil`.`Update_Data_Jabatan`(
    IN p_ID VARCHAR(5),
    IN p_Nama VARCHAR(50),
    IN p_Gaji INT
)
BEGIN
    UPDATE Jabatan
    SET
        Nama_Jabatan = p_Nama,
        Gaji = p_Gaji
    WHERE ID_Jabatan = p_ID;
END$$
DELIMITER ;

# NOMOR 6:
DELIMITER $$
CREATE FUNCTION `bengkel_mobil`.`Show_Transaksi_Pegawai`(
    p_ID_Pegawai VARCHAR(5),
    p_Tanggal DATE
)
RETURNS TEXT
BEGIN
    DECLARE str TEXT;
    SET str = (SELECT GROUP_CONCAT(ID_Transaksi) FROM Header_Transaksi WHERE ID_Pegawai = p_ID_Pegawai);
    RETURN str;
END$$
DELIMITER ;
SELECT Show_Transaksi_Pegawai('P002', '2021-01-01');

# NOMOR 7:
DELIMITER $$
CREATE FUNCTION `bengkel_mobil`.`Show_Sparepart_Service`(
    p_ID_Transaksi VARCHAR(5)
)
RETURNS TEXT
BEGIN
    DECLARE str TEXT;
    SET str = (SELECT GROUP_CONCAT(ID_Sparepart) FROM Pembelian_Sparepart WHERE ID_Transaksi = p_ID_Transaksi);
    SET str = CONCAT(str, ',', (SELECT GROUP_CONCAT(ID_Service) FROM Pembelian_Service WHERE ID_Transaksi = p_ID_Transaksi));
    RETURN str;
END$$
DELIMITER ;
SELECT Show_Sparepart_Service('T001');

# PEMANGGILAN:
