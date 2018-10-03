-- phpMyAdmin SQL Dump
-- version 2.11.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 03, 2018 at 05:17 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `earsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokuments`
--

CREATE TABLE IF NOT EXISTS `dokuments` (
  `id` int(10) NOT NULL auto_increment,
  `nomor` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `name_file` varchar(255) NOT NULL,
  `tgl_surat` date NOT NULL,
  `user_id` int(3) NOT NULL,
  `jenis` varchar(6) NOT NULL,
  `kelompok_id` int(2) NOT NULL,
  `kode_lemari` varchar(10) NOT NULL,
  `kode_kotak` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dokuments`
--


-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE IF NOT EXISTS `kelompok` (
  `id` int(11) NOT NULL auto_increment,
  `ket` varchar(50) NOT NULL,
  `user_id` int(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `kelompok`
--

INSERT INTO `kelompok` (`id`, `ket`, `user_id`) VALUES
(6, 'PT. USSI', 0),
(7, 'PT. INFOKOM EXE', 0),
(10, 'MEDIA INFORMASI', 0),
(11, 'UNDANGAN', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kotak`
--

CREATE TABLE IF NOT EXISTS `kotak` (
  `kode` varchar(10) NOT NULL,
  `kode_lemari` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `user_id` int(2) NOT NULL,
  PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kotak`
--

INSERT INTO `kotak` (`kode`, `kode_lemari`, `nama`, `user_id`) VALUES
('BX0001', 'LR001', 'Surat Ijin', 0),
('BX0002', 'LR002', 'Surat Undangan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lemari`
--

CREATE TABLE IF NOT EXISTS `lemari` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `ruangan` varchar(50) NOT NULL,
  `user_id` int(2) NOT NULL,
  PRIMARY KEY  (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lemari`
--

INSERT INTO `lemari` (`kode`, `nama`, `lokasi`, `ruangan`, `user_id`) VALUES
('LR003', 'Lemari Berkas Arsip Kuning', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL auto_increment,
  `key` varchar(50) NOT NULL,
  `val` text NOT NULL,
  `ket` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `val`, `ket`) VALUES
(3, 'TITLE_APPS', 'CV. SAWARGI', 'Title Pada Browser'),
(35, 'APPS_VERSION', 'e-Arsip <small>1.0.0</small>', '2 = Version Core Programming\r\n1 = Template\r\n1 = Core System'),
(21, 'COMPANY_NAME', 'CV. SAWARGI SEJAHTERA', ''),
(27, 'PESAN_TOMBOL_HAPUS', 'Anda yakin akan menghapus data, tersebut?', ''),
(28, 'PESAN_UPDATE_DATA', 'Data berhasil diupdate.', ''),
(29, 'PESAN_INSERT_DATA', 'Data berhasil disimpan.', ''),
(30, 'PESAN_DELETE_DATA', 'Data berhasil dihapus.', ''),
(95, 'AUTONUMBER_ARSIP', 'YA', 'YA, TIDAK'),
(91, 'COMPANY_ADDR', 'Jl. Raya Ciwidey - Kab Bandung', 'alamat kantor pusat'),
(92, 'COMPANY_PHONE', '(022) 589 xxxx', 'telepon kantor pusat'),
(93, 'COMPANY_EMAIL', 'cs.sawargi@gmail.com', 'email kantor pusat'),
(94, 'COPYRIGHT', 'Copyright &copy; 2015 <strong>CV. SAWARGI</strong> <br/>All rights reserved ', 'copyright lockscreen');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `create` int(1) NOT NULL default '0',
  `read` int(1) NOT NULL default '0',
  `update` int(1) NOT NULL default '0',
  `delete` int(1) NOT NULL default '0',
  `status` char(1) NOT NULL,
  `user_id` int(20) NOT NULL,
  `created_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `username`, `password`, `fullname`, `create`, `read`, `update`, `delete`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 'Administrator', 'administrator', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 1, 1, 1, 1, '1', 4, '2015-11-01 00:00:00', '2017-05-03 00:00:00');
