# BY AIPPproject03
# Nama : A.Irwin Putra Pangesti
# NIM  : 223020503162
#  SOAL 1:
CREATE VIEW ban_dunlop AS
    SELECT sp.ID_Sparepart, sp.Nama_Sparepart, sp.Stok, sp.Jenis_Sparepart, sp.Harga, ps.ID_Pembelian_Sparepart, ps.ID_Transaksi, ps.Jumlah_Beli
    FROM Sparepart sp
    INNER JOIN Pembelian_Sparepart ps ON sp.ID_Sparepart = ps.ID_Sparepart
    WHERE sp.Nama_Sparepart = 'Ban' AND sp.Jenis_Sparepart = 'Kendaraan';
SELECT * FROM ban_dunlop;

#  SOAL 2:
CREATE VIEW pemasukan_pegawai_service AS
    SELECT pg.ID_Pegawai, pg.Nama_Pegawai, sv.Nama_Service, sv.Harga, COUNT(ps.ID_Service) AS Jumlah_Service, sv.Harga * COUNT(ps.ID_Service) AS Total_Pemasukan
    FROM Pegawai pg
    INNER JOIN Pembelian_Service ps ON pg.ID_Pegawai = ps.ID_Pegawai
    INNER JOIN Service sv ON ps.ID_Service = sv.ID_Service
    WHERE pg.ID_Jabatan = 'J003'
    GROUP BY pg.ID_Pegawai, sv.ID_Service;
SELECT * FROM pemasukan_pegawai_service;

#  SOAL 3:
CREATE VIEW daftar_pegawai AS
    SELECT pg.ID_Pegawai, pg.ID_Jabatan, pg.Nama_Pegawai, pg.Alamat, pg.Username, pg.Password, np.ID_Nomor, np.No_Telp
    FROM Pegawai pg
    INNER JOIN Nomor_Pegawai np ON pg.ID_Pegawai = np.ID_Pegawai;
SELECT * FROM daftar_pegawai;

#  SOAL 4:
CREATE VIEW detail_transaksi AS
    SELECT pl.Nama_Pelanggan, pg.Nama_Pegawai, COUNT(ps.ID_Sparepart) AS Jumlah_Sparepart, COUNT(psv.ID_Service) AS Jumlah_Service, t.Tanggal_Pembelian
    FROM Pelanggan pl
    INNER JOIN Transaksi t ON pl.ID_Pelanggan = t.ID_Pelanggan
    INNER JOIN Header_Transaksi ht ON t.ID_Transaksi = ht.ID_Transaksi
    INNER JOIN Pegawai pg ON ht.ID_Pegawai = pg.ID_Pegawai
    INNER JOIN Pembelian_Sparepart ps ON t.ID_Transaksi = ps.ID_Transaksi
    INNER JOIN Pembelian_Service psv ON t.ID_Transaksi = psv.ID_Transaksi
    GROUP BY t.ID_Transaksi;
SELECT * FROM detail_transaksi;

