-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2016 at 06:27 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cv_levin`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE IF NOT EXISTS `akun` (
  `kode_akun` varchar(10) NOT NULL,
  `nama_akun` varchar(30) NOT NULL,
  PRIMARY KEY (`kode_akun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`kode_akun`, `nama_akun`) VALUES
('100', 'kas'),
('110', 'piutang dagang'),
('120', 'persediaan dagang'),
('130', 'perlengkapan'),
('200', 'hutang dagang'),
('250', 'ppn'),
('300', 'modal'),
('310', 'prive'),
('400', 'penjualan'),
('410', 'pendapatan jasa'),
('500', 'hpp'),
('510', 'pembelian'),
('520', 'retur pembelian'),
('600', 'biaya gaji'),
('610', 'biaya listrik'),
('620', 'biaya telepon dan internet'),
('630', 'biaya perlengkapan');

-- --------------------------------------------------------

--
-- Table structure for table `beban_operasional`
--

CREATE TABLE IF NOT EXISTS `beban_operasional` (
  `kode_operasional` int(11) NOT NULL AUTO_INCREMENT,
  `nama_operasional` varchar(60) NOT NULL,
  `tanggal_operasional` date NOT NULL,
  `total_bayar` double NOT NULL,
  PRIMARY KEY (`kode_operasional`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `data_jual`
--

CREATE TABLE IF NOT EXISTS `data_jual` (
  `id_data_jual` int(11) NOT NULL AUTO_INCREMENT,
  `id_nota` int(11) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `merk` varchar(30) NOT NULL,
  `harga` double NOT NULL,
  `qty` double NOT NULL,
  `total` double NOT NULL,
  `tipe` varchar(20) NOT NULL,
  PRIMARY KEY (`id_data_jual`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `data_nota`
--

CREATE TABLE IF NOT EXISTS `data_nota` (
  `id_data` int(11) NOT NULL AUTO_INCREMENT,
  `id_nota` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `kwantitas` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  PRIMARY KEY (`id_data`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hpp`
--

CREATE TABLE IF NOT EXISTS `hpp` (
  `id_hpp` int(11) NOT NULL AUTO_INCREMENT,
  `id_sparepart` varchar(255) NOT NULL,
  `nama_sparepart` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `hpp` int(11) NOT NULL,
  PRIMARY KEY (`id_hpp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE IF NOT EXISTS `jurnal` (
  `id_jurnal` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_jurnal` date NOT NULL,
  `kode_akun` varchar(10) NOT NULL,
  `posisi_dr_cr` varchar(5) NOT NULL,
  `nominal` double NOT NULL,
  PRIMARY KEY (`id_jurnal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE IF NOT EXISTS `kendaraan` (
  `nama_kendaraan` varchar(30) NOT NULL,
  `tipe_kendaraan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`nama_kendaraan`, `tipe_kendaraan`) VALUES
('honda', 'brio'),
('suzuki', 'swift'),
('honda', 'mobilio'),
('suzuki', 'ertiga'),
('Audi', 'A3'),
('Audi', 'A4'),
('Audi', 'A5'),
('Audi', 'A6'),
('Audi', 'A8'),
('Audi', 'Q3'),
('Audi', 'Q5'),
('Audi', 'Q7'),
('Audi', 'R8'),
('Audi', 'TT'),
('BMW', 'Z4'),
('BMW', 'M Series'),
('BMW', '1 Series'),
('BMW ', '3 Series'),
('BMW ', '5 Series'),
('BMW', '6 Series'),
('BMW', '7 Series'),
('BMW', 'X 1'),
('BMW', 'X3'),
('BMW', 'X5'),
('BMW', 'Z3'),
('Chevrolet', 'Appache'),
('Chevrolet', 'Aveo'),
('Chevrolet', 'Blazer'),
('Chevrolet', 'Camaro'),
('Chevrolet', 'Colorado'),
('Chevrolet', 'Captiva'),
('Chevrolet', 'Cruze'),
('Chevrolet', 'Estate'),
('Chevrolet', 'Kalos'),
('Chevrolet', 'Lumina'),
('Chevrolet', 'Montera'),
('Chevrolet', 'Optra'),
('Chevrolet', 'Orlando'),
('Chevrolet', 'Spark'),
('Chevrolet', 'Spin'),
('Chery', 'Cruise'),
('Chery', 'Campus'),
('Chery', 'Cristal'),
('Chery', 'QQ'),
('Chery', 'TransCar'),
('Chery', 'Tiggo'),
('Chrysler', 'Cherokee'),
('Chrysler', 'Grand Cherokee'),
('Chrysler', 'Neon'),
('Chrysler', 'PT Cruiser'),
('Chrysler', 'CJ-5'),
('chrysler', 'CJ-7'),
('chrysler', 'Wreangler'),
('Daewoo', '2000 i'),
('Daewoo', 'Espero'),
('Daewoo', 'Lanos'),
('Daewoo', 'Leganza'),
('Daewoo', 'Matiz'),
('Daewoo', 'Nexia'),
('Daewoo', 'Tacuma'),
('Daihatsu', 'Ayla'),
('Daihatsu', 'Ceria'),
('Daihatsu', 'Charade'),
('Daihatsu', 'Classy'),
('Daihatsu', 'espass'),
('Daihatsu', 'feroza'),
('Daihatsu', 'Grandmax'),
('Daihatsu', 'Grandmax  pickup'),
('Daihatsu', 'HIJET'),
('Daihatsu', 'Luxio'),
('Daihatsu', 'Neo Zebra'),
('Daihatsu', 'Rocky'),
('Daihatsu', 'Sirion'),
('Daihatsu', 'Taft'),
('Daihatsu', 'Taruna'),
('Daihatsu', 'Terios'),
('Daihatsu', 'Winner'),
('Daihatsu', 'Xenia'),
('Daihatsu', 'Zebra'),
('Datsun', '120'),
('Datsun', 'GO'),
('Datsun', 'GO+'),
('Ford', 'Ranger'),
('Ford', 'Escape'),
('Ford', 'Escord'),
('Ford', 'Everest'),
('Ford', 'Fairmont'),
('Ford', 'Fiesta'),
('Ford', 'Focus'),
('Ford', 'Laser'),
('Ford', 'LYNX'),
('Ford', 'Telstar'),
('Ford', 'Territory'),
('Ford', 'Sierra'),
('Ford', 'Cougar'),
('Ford', 'Capri'),
('Ford', 'Explorer'),
('Ford', 'Gala'),
('Ford', 'Mustang'),
('honda', 'accord'),
('honda', 'city'),
('honda', 'civic'),
('honda', 'CR-V'),
('honda', 'CR-Z'),
('honda', 'crossroad'),
('honda', 'Edix'),
('honda', 'Elysion'),
('honda', 'Estilo'),
('honda', 'Felio'),
('honda', 'Fit'),
('honda', 'Fread'),
('honda', 'Genio'),
('honda', 'HR-V'),
('honda', 'Integra'),
('honda', 'Jazz'),
('honda', 'Maestro'),
('honda', 'Odyssay'),
('honda', 'Stream'),
('honda', 'Prelude'),
('honda', 'Presstige'),
('honda', 'S2000'),
('Hyundai', 'Accent'),
('Hyundai', 'Atoz'),
('Hyundai', 'Avega'),
('Hyundai', 'Cakra'),
('Hyundai', 'Coupe'),
('Hyundai', 'Getz'),
('Hyundai', 'Grand Avega'),
('Hyundai', 'H-1'),
('Hyundai', 'i10'),
('Hyundai', 'i20'),
('Hyundai', 'Matrix'),
('Hyundai', 'New Tucson'),
('Hyundai', 'Santa Fe'),
('Hyundai', 'Starex'),
('Hyundai', 'Sonata'),
('Hyundai', 'Trajet'),
('Hyundai', 'Verna'),
('Hyundai', 'Elantra'),
('Hyundai', 'excel'),
('Isuzu', 'BigHorn'),
('Isuzu', 'Colt 77 PS'),
('Isuzu', 'D-Max'),
('Isuzu', 'Elf Minibus'),
('Isuzu', 'Grand touring'),
('Isuzu', 'New panther'),
('Isuzu', 'Panther'),
('Jaguar', 'S-type'),
('Jaguar', 'X-type'),
('Jaguar', 'XF'),
('Jaguar', 'XJ'),
('Jaguar', 'XK'),
('Jaguar', 'Daimler'),
('Jeep', 'Compass'),
('Jeep', 'Rubicon'),
('Jeep', 'Jeep'),
('Jeep', 'Sahara'),
('KIA', 'Carens I'),
('KIA', 'Carens II'),
('KIA', 'Carnival'),
('KIA', 'Magentis'),
('KIA', 'Picanto'),
('KIA', 'Pregio'),
('KIA', 'Pride'),
('KIA', 'Rio'),
('KIA', 'Sedona'),
('KIA', 'Sorento'),
('KIA', 'Sportage'),
('KIA', 'Summa'),
('KIA', 'Travello'),
('KIA', 'Shuma'),
('KIA', 'Spectra'),
('KIA', 'Optima'),
('KIA', 'Visto'),
('Lan Rover', 'Defender'),
('Lan Rover', 'Discovery'),
('Lan Rover', 'Free Lander'),
('Lan Rover', 'Range Rover'),
('Lexus', 'LS'),
('Lexus', 'LX'),
('Lexus', 'RX'),
('Lexus', 'SC'),
('Lexus', '430'),
('Lexus', 'CT200'),
('Lexus', 'ES300'),
('Lexus', 'GS'),
('Lexus', 'IS'),
('Mazda', '2'),
('Mazda', '3'),
('Mazda', '323'),
('Mazda', '5'),
('Mazda', '6'),
('Mazda', '8'),
('Mazda', '626'),
('Mazda', 'Astina'),
('Mazda', 'Baby Boomer'),
('Mazda', 'Biante'),
('Mazda', 'BT-50'),
('Mazda', 'Cronos'),
('Mazda', 'CX-5'),
('Mazda', 'CX-7'),
('Mazda', 'CX-9'),
('Mazda', 'E2000'),
('Mazda', 'Familia'),
('Mazda', 'Lantis'),
('Mazda', 'L2500'),
('Mazda', 'MR-90'),
('Mazda', 'MX'),
('Mazda', 'RX-7'),
('Mazda', 'RX-8'),
('Mazda', 'RX-9'),
('Mazda', 'Tribute'),
('Mazda', 'Vantren'),
('Mitsubishi', 'Chariot'),
('Mitsubishi', 'Colt'),
('Mitsubishi', 'Eterna'),
('Mitsubishi', 'Galant'),
('Mitsubishi', 'Grandis'),
('Mitsubishi', 'Kuda'),
('Mitsubishi', 'L200'),
('Mitsubishi', 'Lancer'),
('Mitsubishi', 'Magna'),
('Mitsubishi', 'Maven'),
('Mitsubishi', 'Mirage'),
('Mitsubishi', 'Outlander'),
('Mitsubishi', 'Pajero'),
('Mitsubishi', 'Pajero Sport'),
('Mitsubishi', 'Strada'),
('Mitsubishi', 'Space'),
('Mitsubishi', 'L300'),
('Nissan', 'X-Trail'),
('Nissan', 'Evalia'),
('Nissan', 'Grand Livina'),
('Nissan', 'Infiniti'),
('Nissan', 'Juke'),
('Nissan', 'Livina'),
('Nissan', 'March'),
('Nissan', 'Primera'),
('Nissan', 'Serena'),
('Nissan', 'Skyline'),
('Peugeot', '107'),
('Peugeot', '206'),
('Peugeot', '207'),
('Peugeot', '306'),
('Peugeot', '307'),
('Peugeot', '405'),
('Peugeot', '406'),
('Peugeot', '505'),
('Peugeot', '308'),
('Peugeot', '407'),
('Peugeot', '605'),
('Peugeot', '607'),
('Peugeot', '806'),
('Peugeot', '807'),
('Peugeot', 'RCZ'),
('Proton', 'Gen2'),
('Proton', 'Neo'),
('Proton', 'Saga'),
('Proton', 'Exora'),
('Proton', 'Satri');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan_pelanggan`
--

CREATE TABLE IF NOT EXISTS `kendaraan_pelanggan` (
  `no_polisi` varchar(10) NOT NULL,
  `no_mesin` varchar(19) NOT NULL,
  `no_rangka` varchar(19) NOT NULL,
  `nama_kendaraan` varchar(30) NOT NULL,
  `tipe_kendaraan` varchar(30) NOT NULL,
  `transmisi` varchar(20) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `warna` varchar(30) NOT NULL,
  `KM` varchar(10) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  PRIMARY KEY (`no_polisi`),
  UNIQUE KEY `no_mesin` (`no_mesin`,`no_rangka`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `montir`
--

CREATE TABLE IF NOT EXISTS `montir` (
  `id_montir` int(11) NOT NULL AUTO_INCREMENT,
  `nama_montir` varchar(30) NOT NULL,
  `alamat_montir` varchar(30) NOT NULL,
  `telpon_montir` varchar(15) NOT NULL,
  `banyak_mobil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_montir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE IF NOT EXISTS `nota` (
  `id_nota` int(11) NOT NULL AUTO_INCREMENT,
  `tipe` varchar(20) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `tgl_lunas` date DEFAULT NULL,
  PRIMARY KEY (`id_nota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pegawai` varchar(30) NOT NULL,
  `alamat_pegawai` varchar(50) NOT NULL,
  `telpon_pegawai` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(25) NOT NULL,
  `level` varchar(25) NOT NULL,
  `status` varchar(6) NOT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `alamat_pegawai`, `telpon_pegawai`, `username`, `password`, `level`, `status`) VALUES
(1, 'aulia', 'bandung', '089812009876', 'aulia', 'gudang', '02', 'aktif'),
(2, 'linka', 'bandung', '081522345667', 'linka', 'cs', '01', 'aktif'),
(3, 'dola', 'bandung', '088872345123', 'dola', 'keuangan', '03', 'aktif'),
(4, 'kasih', 'jakarta', '085678901245', 'kasih', 'kasir', '04', 'aktif'),
(5, 'levin', 'bandung', '0891231623513', 'levin', 'pemilik', '05', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat_pelanggan` varchar(100) NOT NULL,
  `telpon_pelanggan` varchar(13) NOT NULL,
  `email_pelanggan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE IF NOT EXISTS `pembelian` (
  `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_sparepart` varchar(255) NOT NULL,
  `nama_sparepart` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `q` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `dp` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `no_nota` int(11) NOT NULL,
  `tanggal_lunas` date DEFAULT NULL,
  `id_supplier` int(11) NOT NULL,
  PRIMARY KEY (`id_pembelian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jenis_sparepart` varchar(30) NOT NULL,
  `id_sparepart` int(11) NOT NULL,
  `nama_sparepart` varchar(30) NOT NULL,
  `merk` varchar(30) NOT NULL,
  `tipe` varchar(30) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` double NOT NULL,
  `banyaknya` int(11) NOT NULL,
  `ppn` double NOT NULL,
  `bayar` double NOT NULL,
  `sisa` double NOT NULL,
  `status` varchar(20) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `no_nota` int(11) NOT NULL,
  `tanggal_lunas` date DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan`
--

CREATE TABLE IF NOT EXISTS `perbaikan` (
  `id_jasa` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_masuk` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `no_polisi` varchar(10) NOT NULL,
  `id_montir` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `sparepart` varchar(20) NOT NULL,
  `id_stok` int(11) DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `pembayaran` varchar(10) NOT NULL DEFAULT 'belum',
  `dp` int(11) NOT NULL,
  PRIMARY KEY (`id_jasa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sparepart`
--

CREATE TABLE IF NOT EXISTS `sparepart` (
  `id_sparepart` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_sparepart` varchar(25) NOT NULL,
  `nama_sparepart` varchar(30) NOT NULL,
  `merk` varchar(30) NOT NULL,
  `tahun` varchar(30) NOT NULL,
  `harga` double NOT NULL,
  `stok` int(11) NOT NULL,
  PRIMARY KEY (`id_sparepart`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
  `id_stok` int(11) NOT NULL AUTO_INCREMENT,
  `id_sparepart` int(20) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(30) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `s-qty` int(11) NOT NULL,
  `s-harga` float NOT NULL,
  `s-total` float NOT NULL,
  `tipe` varchar(20) NOT NULL,
  PRIMARY KEY (`id_stok`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(30) NOT NULL,
  `alamat_supplier` varchar(30) NOT NULL,
  `telpon_supplier` varchar(15) NOT NULL,
  `email_supplier` varchar(20) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
