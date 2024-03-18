# BY AIPPproject03
# Nama : A.Irwin Putra Pangesti
# NIM  : 223020503162
#  SOAL 1:
DELIMITER $$
CREATE TRIGGER `UpdateTotalBiayaAIPembelianService` AFTER INSERT ON `Pembelian_Service` FOR EACH ROW
    BEGIN
        UPDATE Transaksi
        SET Total_Biaya = Total_Biaya + (SELECT Harga FROM Service WHERE ID_Service = NEW.ID_Service)
        WHERE ID_Transaksi = NEW.ID_Transaksi;
    END$$
DELIMITER ;

#  SOAL 2:
DELIMITER $$
CREATE TRIGGER `UpdateTotalBiayaAUPembelianService` AFTER UPDATE ON `Pembelian_Service` FOR EACH ROW
    BEGIN
        UPDATE Transaksi
        SET Total_Biaya = Total_Biaya - (SELECT Harga FROM Service WHERE ID_Service = OLD.ID_Service) + (SELECT Harga FROM Service WHERE ID_Service = NEW.ID_Service)
        WHERE ID_Transaksi = NEW.ID_Transaksi;
    END$$
DELIMITER ;

#  SOAL 3:
DELIMITER $$
CREATE TRIGGER `UpdateTotalBiayaADPembelianService` AFTER DELETE ON `Pembelian_Service` FOR EACH ROW
    BEGIN
        UPDATE Transaksi
        SET Total_Biaya = Total_Biaya - (SELECT Harga FROM Service WHERE ID_Service = OLD.ID_Service)
        WHERE ID_Transaksi = OLD.ID_Transaksi;
    END$$
DELIMITER ;

#  SOAL 4:
DELIMITER $$
CREATE TRIGGER `UpdateTotalBiayaAIPembelianSparepart` AFTER INSERT ON `Pembelian_Sparepart` FOR EACH ROW
    BEGIN
        UPDATE Transaksi
        SET Total_Biaya = Total_Biaya + (SELECT Harga * NEW.Jumlah_Beli FROM Sparepart WHERE ID_Sparepart = NEW.ID_Sparepart)
        WHERE ID_Transaksi = NEW.ID_Transaksi;
    END$$
DELIMITER ;

#  SOAL 5:
DELIMITER $$
CREATE TRIGGER `UpdateTotalBiayaAUPembelianSparepart` AFTER UPDATE ON `Pembelian_Sparepart` FOR EACH ROW
    BEGIN
        UPDATE Transaksi
        SET Total_Biaya = Total_Biaya - (SELECT Harga * OLD.Jumlah_Beli FROM Sparepart WHERE ID_Sparepart = OLD.ID_Sparepart) + (SELECT Harga * NEW.Jumlah_Beli FROM Sparepart WHERE ID_Sparepart = NEW.ID_Sparepart)
        WHERE ID_Transaksi = NEW.ID_Transaksi;
    END$$
DELIMITER ;

#  SOAL 6:
DELIMITER $$
CREATE TRIGGER `UpdateTotalBiayaADPembelianSparepart` AFTER DELETE ON `Pembelian_Sparepart` FOR EACH ROW
    BEGIN
        UPDATE Transaksi
        SET Total_Biaya = Total_Biaya - (SELECT Harga * OLD.Jumlah_Beli FROM Sparepart WHERE ID_Sparepart = OLD.ID_Sparepart)
        WHERE ID_Transaksi = OLD.ID_Transaksi;
    END$$
DELIMITER ;

#  SOAL 7:
DELIMITER $$
CREATE TRIGGER `UpdateJumlahStokAIPembelianSparepart` AFTER INSERT ON `Pembelian_Sparepart` FOR EACH ROW
    BEGIN
        UPDATE Sparepart
        SET Stok = Stok - NEW.Jumlah_Beli
        WHERE ID_Sparepart = NEW.ID_Sparepart;
    END$$
DELIMITER ;

#  SOAL 8:
DELIMITER $$
CREATE TRIGGER `UpdateJumlahStokAUPembelianSparepart` AFTER UPDATE ON `Pembelian_Sparepart` FOR EACH ROW
    BEGIN
        UPDATE Sparepart
        SET Stok = Stok + OLD.Jumlah_Beli - NEW.Jumlah_Beli
        WHERE ID_Sparepart = NEW.ID_Sparepart;
    END$$
DELIMITER ;

#  SOAL 9:
DELIMITER $$
CREATE TRIGGER `UpdateJumlahStokADPembelianSparepart` AFTER DELETE ON `Pembelian_Sparepart` FOR EACH ROW
    BEGIN
        UPDATE Sparepart
        SET Stok = Stok + OLD.Jumlah_Beli
        WHERE ID_Sparepart = OLD.ID_Sparepart;
    END$$
DELIMITER ;
