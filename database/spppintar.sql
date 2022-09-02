-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Apr 2021 pada 06.57
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spppintar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `backset`
--

CREATE TABLE `backset` (
  `url` varchar(100) NOT NULL,
  `sessiontime` varchar(4) DEFAULT NULL,
  `footer` varchar(50) DEFAULT NULL,
  `themesback` varchar(2) DEFAULT NULL,
  `responsive` varchar(2) DEFAULT NULL,
  `app` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `backset`
--

INSERT INTO `backset` (`url`, `sessiontime`, `footer`, `themesback`, `responsive`, `app`) VALUES
('http://localhost/spppintar', '1001', 'SPP PINTAR', '1', '0', 'SPP Pintar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bebasan`
--

CREATE TABLE `bebasan` (
  `no` int(10) NOT NULL,
  `period_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `jenis_id` int(10) NOT NULL,
  `bill` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `sudahbayar` int(10) NOT NULL,
  `kasir` varchar(100) NOT NULL,
  `tgl_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bebasan`
--

INSERT INTO `bebasan` (`no`, `period_id`, `student_id`, `jenis_id`, `bill`, `status`, `sudahbayar`, `kasir`, `tgl_input`) VALUES
(1, 1, 2, 1, 200000, 'belum', 30000, 'admin', '2021-04-16'),
(2, 1, 7, 1, 200000, 'belum', 0, 'admin', '2021-04-16'),
(3, 1, 12, 1, 200000, 'belum', 0, 'admin', '2021-04-16'),
(4, 1, 17, 1, 200000, 'belum', 0, 'admin', '2021-04-16'),
(5, 1, 22, 1, 200000, 'belum', 0, 'admin', '2021-04-16'),
(6, 1, 27, 1, 200000, 'belum', 0, 'admin', '2021-04-16'),
(7, 1, 32, 1, 200000, 'belum', 0, 'admin', '2021-04-16'),
(8, 1, 37, 1, 200000, 'belum', 0, 'admin', '2021-04-16'),
(9, 1, 42, 1, 200000, 'belum', 0, 'admin', '2021-04-16'),
(10, 1, 47, 1, 200000, 'belum', 0, 'admin', '2021-04-16'),
(11, 1, 52, 1, 200000, 'belum', 0, 'admin', '2021-04-16'),
(12, 1, 57, 1, 200000, 'belum', 0, 'admin', '2021-04-16'),
(13, 1, 62, 1, 200000, 'belum', 0, 'admin', '2021-04-16'),
(14, 1, 67, 1, 200000, 'belum', 0, 'admin', '2021-04-16'),
(15, 1, 72, 1, 200000, 'belum', 0, 'admin', '2021-04-16'),
(16, 1, 77, 1, 200000, 'belum', 0, 'admin', '2021-04-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bebasan_pay`
--

CREATE TABLE `bebasan_pay` (
  `no` int(10) NOT NULL,
  `bebasan_id` int(10) NOT NULL,
  `period_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `kasir` varchar(100) NOT NULL,
  `jumlah` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bebasan_pay`
--

INSERT INTO `bebasan_pay` (`no`, `bebasan_id`, `period_id`, `student_id`, `tanggal`, `kasir`, `jumlah`) VALUES
(1, 1, 1, 2, '2021-04-16', 'admin', 10000),
(2, 1, 1, 2, '2021-04-16', 'admin', 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulanan`
--

CREATE TABLE `bulanan` (
  `no` int(10) NOT NULL,
  `period_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `jenis_id` int(10) NOT NULL,
  `month_id` int(10) NOT NULL,
  `bulanan_bill` int(10) NOT NULL,
  `bulanan_status` varchar(10) NOT NULL,
  `bulanan_bayar` int(10) NOT NULL,
  `kasir` varchar(100) NOT NULL,
  `tgl_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bulanan`
--

INSERT INTO `bulanan` (`no`, `period_id`, `student_id`, `jenis_id`, `month_id`, `bulanan_bill`, `bulanan_status`, `bulanan_bayar`, `kasir`, `tgl_input`) VALUES
(1, 1, 2, 3, 1, 100000, 'sudah', 100000, 'admin', '2021-04-16'),
(2, 1, 2, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(3, 1, 2, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(4, 1, 2, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(5, 1, 2, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(6, 1, 2, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(7, 1, 2, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(8, 1, 2, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(9, 1, 2, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(10, 1, 2, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(11, 1, 2, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(12, 1, 2, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(13, 1, 7, 3, 1, 100000, 'belum', 0, 'admin', '2021-04-16'),
(14, 1, 7, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(15, 1, 7, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(16, 1, 7, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(17, 1, 7, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(18, 1, 7, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(19, 1, 7, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(20, 1, 7, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(21, 1, 7, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(22, 1, 7, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(23, 1, 7, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(24, 1, 7, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(25, 1, 12, 3, 1, 100000, 'belum', 0, 'admin', '2021-04-16'),
(26, 1, 12, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(27, 1, 12, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(28, 1, 12, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(29, 1, 12, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(30, 1, 12, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(31, 1, 12, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(32, 1, 12, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(33, 1, 12, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(34, 1, 12, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(35, 1, 12, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(36, 1, 12, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(37, 1, 17, 3, 1, 100000, 'belum', 0, 'admin', '2021-04-16'),
(38, 1, 17, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(39, 1, 17, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(40, 1, 17, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(41, 1, 17, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(42, 1, 17, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(43, 1, 17, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(44, 1, 17, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(45, 1, 17, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(46, 1, 17, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(47, 1, 17, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(48, 1, 17, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(49, 1, 22, 3, 1, 100000, 'belum', 0, 'admin', '2021-04-16'),
(50, 1, 22, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(51, 1, 22, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(52, 1, 22, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(53, 1, 22, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(54, 1, 22, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(55, 1, 22, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(56, 1, 22, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(57, 1, 22, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(58, 1, 22, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(59, 1, 22, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(60, 1, 22, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(61, 1, 27, 3, 1, 100000, 'belum', 0, 'admin', '2021-04-16'),
(62, 1, 27, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(63, 1, 27, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(64, 1, 27, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(65, 1, 27, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(66, 1, 27, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(67, 1, 27, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(68, 1, 27, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(69, 1, 27, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(70, 1, 27, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(71, 1, 27, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(72, 1, 27, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(73, 1, 32, 3, 1, 100000, 'belum', 0, 'admin', '2021-04-16'),
(74, 1, 32, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(75, 1, 32, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(76, 1, 32, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(77, 1, 32, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(78, 1, 32, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(79, 1, 32, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(80, 1, 32, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(81, 1, 32, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(82, 1, 32, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(83, 1, 32, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(84, 1, 32, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(85, 1, 37, 3, 1, 100000, 'belum', 0, 'admin', '2021-04-16'),
(86, 1, 37, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(87, 1, 37, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(88, 1, 37, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(89, 1, 37, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(90, 1, 37, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(91, 1, 37, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(92, 1, 37, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(93, 1, 37, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(94, 1, 37, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(95, 1, 37, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(96, 1, 37, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(97, 1, 42, 3, 1, 100000, 'belum', 0, 'admin', '2021-04-16'),
(98, 1, 42, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(99, 1, 42, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(100, 1, 42, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(101, 1, 42, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(102, 1, 42, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(103, 1, 42, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(104, 1, 42, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(105, 1, 42, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(106, 1, 42, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(107, 1, 42, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(108, 1, 42, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(109, 1, 47, 3, 1, 100000, 'belum', 0, 'admin', '2021-04-16'),
(110, 1, 47, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(111, 1, 47, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(112, 1, 47, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(113, 1, 47, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(114, 1, 47, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(115, 1, 47, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(116, 1, 47, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(117, 1, 47, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(118, 1, 47, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(119, 1, 47, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(120, 1, 47, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(121, 1, 52, 3, 1, 100000, 'belum', 0, 'admin', '2021-04-16'),
(122, 1, 52, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(123, 1, 52, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(124, 1, 52, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(125, 1, 52, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(126, 1, 52, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(127, 1, 52, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(128, 1, 52, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(129, 1, 52, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(130, 1, 52, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(131, 1, 52, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(132, 1, 52, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(133, 1, 57, 3, 1, 100000, 'belum', 0, 'admin', '2021-04-16'),
(134, 1, 57, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(135, 1, 57, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(136, 1, 57, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(137, 1, 57, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(138, 1, 57, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(139, 1, 57, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(140, 1, 57, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(141, 1, 57, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(142, 1, 57, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(143, 1, 57, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(144, 1, 57, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(145, 1, 62, 3, 1, 100000, 'belum', 0, 'admin', '2021-04-16'),
(146, 1, 62, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(147, 1, 62, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(148, 1, 62, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(149, 1, 62, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(150, 1, 62, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(151, 1, 62, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(152, 1, 62, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(153, 1, 62, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(154, 1, 62, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(155, 1, 62, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(156, 1, 62, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(157, 1, 67, 3, 1, 100000, 'belum', 0, 'admin', '2021-04-16'),
(158, 1, 67, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(159, 1, 67, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(160, 1, 67, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(161, 1, 67, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(162, 1, 67, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(163, 1, 67, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(164, 1, 67, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(165, 1, 67, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(166, 1, 67, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(167, 1, 67, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(168, 1, 67, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(169, 1, 72, 3, 1, 100000, 'belum', 0, 'admin', '2021-04-16'),
(170, 1, 72, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(171, 1, 72, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(172, 1, 72, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(173, 1, 72, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(174, 1, 72, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(175, 1, 72, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(176, 1, 72, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(177, 1, 72, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(178, 1, 72, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(179, 1, 72, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(180, 1, 72, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(181, 1, 77, 3, 1, 100000, 'belum', 0, 'admin', '2021-04-16'),
(182, 1, 77, 3, 2, 100000, 'belum', 0, 'admin', '2021-04-16'),
(183, 1, 77, 3, 3, 100000, 'belum', 0, 'admin', '2021-04-16'),
(184, 1, 77, 3, 4, 100000, 'belum', 0, 'admin', '2021-04-16'),
(185, 1, 77, 3, 5, 100000, 'belum', 0, 'admin', '2021-04-16'),
(186, 1, 77, 3, 6, 100000, 'belum', 0, 'admin', '2021-04-16'),
(187, 1, 77, 3, 7, 50000, 'belum', 0, 'admin', '2021-04-16'),
(188, 1, 77, 3, 8, 100000, 'belum', 0, 'admin', '2021-04-16'),
(189, 1, 77, 3, 9, 100000, 'belum', 0, 'admin', '2021-04-16'),
(190, 1, 77, 3, 10, 100000, 'belum', 0, 'admin', '2021-04-16'),
(191, 1, 77, 3, 11, 100000, 'belum', 0, 'admin', '2021-04-16'),
(192, 1, 77, 3, 12, 100000, 'belum', 0, 'admin', '2021-04-16'),
(193, 1, 2, 2, 1, 20000, 'sudah', 20000, 'admin', '2021-04-16'),
(194, 1, 2, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(195, 1, 2, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(196, 1, 2, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(197, 1, 2, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(198, 1, 2, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(199, 1, 2, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(200, 1, 2, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(201, 1, 2, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(202, 1, 2, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(203, 1, 2, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(204, 1, 2, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16'),
(205, 1, 7, 2, 1, 20000, 'belum', 0, 'admin', '2021-04-16'),
(206, 1, 7, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(207, 1, 7, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(208, 1, 7, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(209, 1, 7, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(210, 1, 7, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(211, 1, 7, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(212, 1, 7, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(213, 1, 7, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(214, 1, 7, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(215, 1, 7, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(216, 1, 7, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16'),
(217, 1, 12, 2, 1, 20000, 'belum', 0, 'admin', '2021-04-16'),
(218, 1, 12, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(219, 1, 12, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(220, 1, 12, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(221, 1, 12, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(222, 1, 12, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(223, 1, 12, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(224, 1, 12, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(225, 1, 12, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(226, 1, 12, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(227, 1, 12, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(228, 1, 12, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16'),
(229, 1, 17, 2, 1, 20000, 'belum', 0, 'admin', '2021-04-16'),
(230, 1, 17, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(231, 1, 17, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(232, 1, 17, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(233, 1, 17, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(234, 1, 17, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(235, 1, 17, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(236, 1, 17, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(237, 1, 17, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(238, 1, 17, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(239, 1, 17, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(240, 1, 17, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16'),
(241, 1, 22, 2, 1, 20000, 'belum', 0, 'admin', '2021-04-16'),
(242, 1, 22, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(243, 1, 22, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(244, 1, 22, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(245, 1, 22, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(246, 1, 22, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(247, 1, 22, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(248, 1, 22, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(249, 1, 22, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(250, 1, 22, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(251, 1, 22, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(252, 1, 22, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16'),
(253, 1, 27, 2, 1, 20000, 'belum', 0, 'admin', '2021-04-16'),
(254, 1, 27, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(255, 1, 27, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(256, 1, 27, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(257, 1, 27, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(258, 1, 27, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(259, 1, 27, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(260, 1, 27, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(261, 1, 27, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(262, 1, 27, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(263, 1, 27, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(264, 1, 27, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16'),
(265, 1, 32, 2, 1, 20000, 'belum', 0, 'admin', '2021-04-16'),
(266, 1, 32, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(267, 1, 32, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(268, 1, 32, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(269, 1, 32, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(270, 1, 32, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(271, 1, 32, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(272, 1, 32, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(273, 1, 32, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(274, 1, 32, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(275, 1, 32, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(276, 1, 32, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16'),
(277, 1, 37, 2, 1, 20000, 'belum', 0, 'admin', '2021-04-16'),
(278, 1, 37, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(279, 1, 37, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(280, 1, 37, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(281, 1, 37, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(282, 1, 37, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(283, 1, 37, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(284, 1, 37, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(285, 1, 37, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(286, 1, 37, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(287, 1, 37, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(288, 1, 37, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16'),
(289, 1, 42, 2, 1, 20000, 'belum', 0, 'admin', '2021-04-16'),
(290, 1, 42, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(291, 1, 42, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(292, 1, 42, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(293, 1, 42, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(294, 1, 42, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(295, 1, 42, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(296, 1, 42, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(297, 1, 42, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(298, 1, 42, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(299, 1, 42, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(300, 1, 42, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16'),
(301, 1, 47, 2, 1, 20000, 'belum', 0, 'admin', '2021-04-16'),
(302, 1, 47, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(303, 1, 47, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(304, 1, 47, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(305, 1, 47, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(306, 1, 47, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(307, 1, 47, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(308, 1, 47, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(309, 1, 47, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(310, 1, 47, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(311, 1, 47, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(312, 1, 47, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16'),
(313, 1, 52, 2, 1, 20000, 'belum', 0, 'admin', '2021-04-16'),
(314, 1, 52, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(315, 1, 52, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(316, 1, 52, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(317, 1, 52, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(318, 1, 52, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(319, 1, 52, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(320, 1, 52, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(321, 1, 52, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(322, 1, 52, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(323, 1, 52, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(324, 1, 52, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16'),
(325, 1, 57, 2, 1, 20000, 'belum', 0, 'admin', '2021-04-16'),
(326, 1, 57, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(327, 1, 57, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(328, 1, 57, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(329, 1, 57, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(330, 1, 57, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(331, 1, 57, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(332, 1, 57, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(333, 1, 57, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(334, 1, 57, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(335, 1, 57, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(336, 1, 57, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16'),
(337, 1, 62, 2, 1, 20000, 'belum', 0, 'admin', '2021-04-16'),
(338, 1, 62, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(339, 1, 62, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(340, 1, 62, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(341, 1, 62, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(342, 1, 62, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(343, 1, 62, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(344, 1, 62, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(345, 1, 62, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(346, 1, 62, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(347, 1, 62, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(348, 1, 62, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16'),
(349, 1, 67, 2, 1, 20000, 'belum', 0, 'admin', '2021-04-16'),
(350, 1, 67, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(351, 1, 67, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(352, 1, 67, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(353, 1, 67, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(354, 1, 67, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(355, 1, 67, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(356, 1, 67, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(357, 1, 67, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(358, 1, 67, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(359, 1, 67, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(360, 1, 67, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16'),
(361, 1, 72, 2, 1, 20000, 'belum', 0, 'admin', '2021-04-16'),
(362, 1, 72, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(363, 1, 72, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(364, 1, 72, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(365, 1, 72, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(366, 1, 72, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(367, 1, 72, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(368, 1, 72, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(369, 1, 72, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(370, 1, 72, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(371, 1, 72, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(372, 1, 72, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16'),
(373, 1, 77, 2, 1, 20000, 'belum', 0, 'admin', '2021-04-16'),
(374, 1, 77, 2, 2, 20000, 'belum', 0, 'admin', '2021-04-16'),
(375, 1, 77, 2, 3, 20000, 'belum', 0, 'admin', '2021-04-16'),
(376, 1, 77, 2, 4, 20000, 'belum', 0, 'admin', '2021-04-16'),
(377, 1, 77, 2, 5, 20000, 'belum', 0, 'admin', '2021-04-16'),
(378, 1, 77, 2, 6, 20000, 'belum', 0, 'admin', '2021-04-16'),
(379, 1, 77, 2, 7, 20000, 'belum', 0, 'admin', '2021-04-16'),
(380, 1, 77, 2, 8, 20000, 'belum', 0, 'admin', '2021-04-16'),
(381, 1, 77, 2, 9, 20000, 'belum', 0, 'admin', '2021-04-16'),
(382, 1, 77, 2, 10, 20000, 'belum', 0, 'admin', '2021-04-16'),
(383, 1, 77, 2, 11, 20000, 'belum', 0, 'admin', '2021-04-16'),
(384, 1, 77, 2, 12, 20000, 'belum', 0, 'admin', '2021-04-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chmenu`
--

CREATE TABLE `chmenu` (
  `userjabatan` varchar(20) NOT NULL,
  `menu1` varchar(1) DEFAULT NULL,
  `menu2` varchar(1) DEFAULT NULL,
  `menu3` varchar(1) DEFAULT '0',
  `menu4` varchar(1) DEFAULT '0',
  `menu5` varchar(1) DEFAULT '0',
  `menu6` varchar(1) DEFAULT '0',
  `menu7` varchar(1) DEFAULT '0',
  `menu8` varchar(1) DEFAULT '0',
  `menu9` varchar(1) DEFAULT '0',
  `menu10` varchar(1) DEFAULT '0',
  `menu11` varchar(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `chmenu`
--

INSERT INTO `chmenu` (`userjabatan`, `menu1`, `menu2`, `menu3`, `menu4`, `menu5`, `menu6`, `menu7`, `menu8`, `menu9`, `menu10`, `menu11`) VALUES
('admin', '4', '4', '4', '4', '4', '4', '4', '4', '4', '4', '4'),
('Karyawan', '4', '5', '4', '3', '3', '2', '3', '5', '1', '1', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `class`
--

CREATE TABLE `class` (
  `no` int(10) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `class`
--

INSERT INTO `class` (`no`, `kelas`, `status`) VALUES
(1, 'XA', 'active'),
(2, 'XB', 'active'),
(3, 'XI IPA', 'active'),
(4, 'XI IPS', 'active'),
(5, 'XII', 'active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data`
--

CREATE TABLE `data` (
  `nama` varchar(100) DEFAULT NULL,
  `tagline` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `notelp` varchar(20) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `web` varchar(100) NOT NULL,
  `npwp` varchar(100) NOT NULL,
  `avatar` varchar(150) NOT NULL,
  `no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data`
--

INSERT INTO `data` (`nama`, `tagline`, `alamat`, `notelp`, `signature`, `email`, `web`, `npwp`, `avatar`, `no`) VALUES
('SMA FYMA MEDIA NUSANTARA', 'Profesional Terpercaya', 'jalan Ngurah Rai no.8 , Denpasar, Bali', '02100110011', 'Tut Wuri Handayani', 'fyma@gmail.com', 'www.fymamedia/demo.com', '19171171718171', 'upload/image/tut wuri.png', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`) VALUES
(1, 'Ujian', '#5553CE', '2021-04-17 00:00:00', '2021-04-18 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `event_colors`
--

CREATE TABLE `event_colors` (
  `no` int(10) NOT NULL,
  `warna` varchar(10) NOT NULL,
  `kodewarna` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `event_colors`
--

INSERT INTO `event_colors` (`no`, `warna`, `kodewarna`) VALUES
(1, 'Upacara', '#64C5B1'),
(2, 'Pengumuman', '#34D3EB'),
(3, 'Kelulusan', '#32C861'),
(4, 'Pembayaran', '#FFA91C'),
(5, 'Ujian', '#5553CE'),
(6, 'Penting', '#F96A74'),
(7, 'Festival', '#F06292'),
(10, 'Liburan', '#313A46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `graduation`
--

CREATE TABLE `graduation` (
  `grad_id` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `info`
--

CREATE TABLE `info` (
  `nama` varchar(100) DEFAULT NULL,
  `userid` int(10) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `info`
--

INSERT INTO `info` (`nama`, `userid`, `avatar`, `tanggal`, `isi`, `id`) VALUES
('admin', 24, 'upload/image/placeholder.png', '2021-04-15', '<h1>Pengumuman baru:</h1><p>hanya beli di tokopedia.com/warungebook</p><p><br></p><p>Pastikan beli original</p><p></p>                                                                                                                                                                                                                                                                                                                                                                                                                              ', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `kode` varchar(20) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`kode`, `nama`, `no`) VALUES
('0001', 'admin', 30),
('0003', 'Karyawan', 31);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_bayar`
--

CREATE TABLE `jenis_bayar` (
  `jenis_id` int(10) NOT NULL,
  `period_id` int(10) NOT NULL,
  `pos_bayar_id` int(10) NOT NULL,
  `jenis_pembayaran` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tahunajar` varchar(10) NOT NULL,
  `update_time` date NOT NULL,
  `create_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_bayar`
--

INSERT INTO `jenis_bayar` (`jenis_id`, `period_id`, `pos_bayar_id`, `jenis_pembayaran`, `nama`, `tahunajar`, `update_time`, `create_time`) VALUES
(1, 1, 3, 'bebas', 'Study Tour', '2020/2021', '2021-04-16', '2021-04-16'),
(2, 1, 2, 'bulanan', 'Komputer', '2020/2021', '2021-04-16', '2021-04-16'),
(3, 1, 1, 'bulanan', 'SPP ', '2020/2021', '2021-04-16', '2021-04-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `months`
--

CREATE TABLE `months` (
  `month_id` int(11) NOT NULL,
  `month_name` varchar(45) DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `months`
--

INSERT INTO `months` (`month_id`, `month_name`, `status`) VALUES
(1, 'Juli', 'inactive'),
(2, 'Agustus', 'active'),
(3, 'September', 'inactive'),
(4, 'Oktober', 'inactive'),
(5, 'November', 'inactive'),
(6, 'Desember', 'inactive'),
(7, 'Januari', 'inactive'),
(8, 'Februari', 'inactive'),
(9, 'Maret', 'inactive'),
(10, 'April', 'inactive'),
(11, 'Mei', 'inactive'),
(12, 'Juni', 'inactive');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `no` int(10) NOT NULL,
  `period_start` year(4) NOT NULL,
  `period_end` year(4) NOT NULL,
  `period_name` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`no`, `period_start`, `period_end`, `period_name`, `status`) VALUES
(1, 2020, 2021, '2020/2021', 'active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pin`
--

CREATE TABLE `pin` (
  `pin` varchar(255) NOT NULL,
  `ubah` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pin`
--

INSERT INTO `pin` (`pin`, `ubah`) VALUES
('10470c3b4b1fed12c3baac014be15fac67c6e815', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_bayar`
--

CREATE TABLE `pos_bayar` (
  `id` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pos_bayar`
--

INSERT INTO `pos_bayar` (`id`, `nama`, `keterangan`) VALUES
(1, 'SPP ', ''),
(2, 'Komputer', ''),
(3, 'Study Tour', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `no` int(10) NOT NULL,
  `bank` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `norek` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`no`, `bank`, `nama`, `norek`) VALUES
(4, 'BCA', 'ANDI M', '120919101');

-- --------------------------------------------------------

--
-- Struktur dari tabel `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `nis` varchar(45) DEFAULT NULL,
  `nisn` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birth_place` varchar(45) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `nohp` varchar(45) DEFAULT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `ibu` varchar(100) DEFAULT NULL,
  `ayahwali` varchar(100) DEFAULT NULL,
  `waortu` varchar(45) DEFAULT NULL,
  `kelas_id` varchar(11) DEFAULT NULL,
  `jurusan` int(11) DEFAULT NULL,
  `catatan` text NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `last_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `student`
--

INSERT INTO `student` (`student_id`, `nis`, `nisn`, `password`, `nama`, `gender`, `birth_place`, `birth_date`, `avatar`, `nohp`, `hobi`, `alamat`, `ibu`, `ayahwali`, `waortu`, `kelas_id`, `jurusan`, `catatan`, `status`, `input_date`, `last_update`) VALUES
(1, '20071', '0', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Andi', 'Laki Laki', 'Jepara', '2000-04-06', 'upload/image/placeholder150x150.png', '628776728271', 'menulis, bernyanyi', 'jalan patu senin, kecamatan bla bla bla', 'saiman', 'parto', '\r\n  6280382928392', '3', 1, ' ', 'active', '2021-04-16', '2021-04-16'),
(3, '1002', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rani', 'Perempuan', 'Jambi', '2001-02-01', 'image/placeholder.png', '6289630727252', 'Tulis', 'jambi', 'desi', 'warjo', '6289630727252', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(4, '1003', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Laki laki', 'Jambi', '2002-01-01', 'image/placeholder.png', '6289630727253', 'Hitung', 'jepara', 'titi', 'bejo', '6289630727253', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(5, '1004', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Ranu', 'Perempuan', 'Jambi', '2002-02-01', 'image/placeholder.png', '6289630727254', 'Nyanyi', 'jabon', 'nini', 'tejo', '6289630727254', '4', 4, '', 'active', '2021-04-16', '2021-04-16'),
(6, '1005', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rane', 'Laki laki', 'Jambi', '2003-01-01', 'image/placeholder.png', '6289630727255', 'Baca', 'jalengka', 'rini', 'bajo', '6289630727255', '5', 5, '', 'active', '2021-04-16', '2021-04-16'),
(8, '1007', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rana', 'Laki laki', 'Jambi', '2004-01-01', 'image/placeholder.png', '6289630727257', 'Hitung', 'jurabaya', 'lini', 'dojo', '6289630727257', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(9, '1008', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rani', 'Perempuan', 'Jambi', '2004-02-01', 'image/placeholder.png', '6289630727258', 'Nyanyi', 'jakarta', 'kini', 'jojo', '6289630727258', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(10, '1009', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Laki laki', 'Jambi', '2005-01-01', 'image/placeholder.png', '6289630727259', 'Baca', 'jambi', 'boni', 'nojo', '6289630727259', '4', 4, '', 'active', '2021-04-16', '2021-04-16'),
(11, '1010', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Ranu', 'Perempuan', 'Jambi', '2005-02-01', 'image/placeholder.png', '6289630727260', 'Tulis', 'jepara', 'neni', 'rejo', '6289630727260', '5', 5, '', 'active', '2021-04-16', '2021-04-16'),
(12, '1011', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rane', 'Laki laki', 'Jambi', '2006-01-01', 'image/placeholder.png', '6289630727261', 'Hitung', 'jabon', 'tuni', 'yujo', '6289630727261', '1', 1, '', 'active', '2021-04-16', '2021-04-16'),
(13, '1012', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Perempuan', 'Jambi', '2006-02-01', 'image/placeholder.png', '6289630727262', 'Nyanyi', 'jalengka', 'wati', 'parjo', '6289630727262', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(14, '1013', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rana', 'Laki laki', 'Jambi', '2007-01-01', 'image/placeholder.png', '6289630727263', 'Baca', 'jemarang', 'desi', 'warjo', '6289630727263', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(15, '1014', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rani', 'Perempuan', 'Jambi', '2007-02-01', 'image/placeholder.png', '6289630727264', 'Tulis', 'jurabaya', 'titi', 'bejo', '6289630727264', '4', 4, '', 'active', '2021-04-16', '2021-04-16'),
(16, '1015', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Laki laki', 'Jambi', '2008-01-01', 'image/placeholder.png', '6289630727265', 'Hitung', 'jakarta', 'nini', 'tejo', '6289630727265', '5', 5, '', 'active', '2021-04-16', '2021-04-16'),
(17, '1016', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Ranu', 'Perempuan', 'Jambi', '2008-02-01', 'image/placeholder.png', '6289630727266', 'Nyanyi', 'jambi', 'rini', 'bajo', '6289630727266', '1', 1, '', 'active', '2021-04-16', '2021-04-16'),
(18, '1017', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rane', 'Laki laki', 'Jambi', '2009-01-01', 'image/placeholder.png', '6289630727267', 'Baca', 'jepara', 'mini', 'kojo', '6289630727267', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(19, '1018', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Perempuan', 'Jambi', '2009-02-01', 'image/placeholder.png', '6289630727268', 'Tulis', 'jabon', 'lini', 'dojo', '6289630727268', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(20, '1019', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rana', 'Laki laki', 'Jambi', '2010-01-01', 'image/placeholder.png', '6289630727269', 'Hitung', 'jalengka', 'kini', 'jojo', '6289630727269', '4', 4, '', 'active', '2021-04-16', '2021-04-16'),
(21, '1020', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rani', 'Perempuan', 'Jambi', '2010-02-01', 'image/placeholder.png', '6289630727270', 'Nyanyi', 'jemarang', 'boni', 'nojo', '6289630727270', '5', 5, '', 'active', '2021-04-16', '2021-04-16'),
(22, '1021', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Laki laki', 'Jambi', '2011-01-01', 'image/placeholder.png', '6289630727271', 'Baca', 'jurabaya', 'neni', 'rejo', '6289630727271', '1', 1, '', 'active', '2021-04-16', '2021-04-16'),
(23, '1022', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Ranu', 'Perempuan', 'Jambi', '2011-02-01', 'image/placeholder.png', '6289630727272', 'Tulis', 'jakarta', 'tuni', 'yujo', '6289630727272', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(24, '1023', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rane', 'Laki laki', 'Jambi', '2012-01-01', 'image/placeholder.png', '6289630727273', 'Hitung', 'jambi', 'wati', 'parjo', '6289630727273', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(25, '1024', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Perempuan', 'Jambi', '2012-02-01', 'image/placeholder.png', '6289630727274', 'Nyanyi', 'jepara', 'desi', 'warjo', '6289630727274', '4', 4, '', 'active', '2021-04-16', '2021-04-16'),
(26, '1025', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rana', 'Laki laki', 'Jambi', '2013-01-01', 'image/placeholder.png', '6289630727275', 'Baca', 'jabon', 'titi', 'bejo', '6289630727275', '5', 5, '', 'active', '2021-04-16', '2021-04-16'),
(27, '1026', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rani', 'Perempuan', 'Jambi', '2013-02-01', 'image/placeholder.png', '6289630727276', 'Tulis', 'jalengka', 'nini', 'tejo', '6289630727276', '1', 1, '', 'active', '2021-04-16', '2021-04-16'),
(28, '1027', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Laki laki', 'Jambi', '2014-01-01', 'image/placeholder.png', '6289630727277', 'Hitung', 'jemarang', 'rini', 'bajo', '6289630727277', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(29, '1028', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Ranu', 'Perempuan', 'Jambi', '2014-02-01', 'image/placeholder.png', '6289630727278', 'Nyanyi', 'jurabaya', 'mini', 'kojo', '6289630727278', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(30, '1029', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rane', 'Laki laki', 'Jambi', '2015-01-01', 'image/placeholder.png', '6289630727279', 'Baca', 'jakarta', 'lini', 'dojo', '6289630727279', '4', 4, '', 'active', '2021-04-16', '2021-04-16'),
(31, '1030', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Perempuan', 'Jambi', '2015-02-01', 'image/placeholder.png', '6289630727280', 'Tulis', 'jambi', 'kini', 'jojo', '6289630727280', '5', 5, '', 'active', '2021-04-16', '2021-04-16'),
(32, '1031', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rana', 'Laki laki', 'Jambi', '2016-01-01', 'image/placeholder.png', '6289630727281', 'Hitung', 'jepara', 'boni', 'nojo', '6289630727281', '1', 1, '', 'active', '2021-04-16', '2021-04-16'),
(33, '1032', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rani', 'Perempuan', 'Jambi', '2016-02-01', 'image/placeholder.png', '6289630727282', 'Nyanyi', 'jabon', 'neni', 'rejo', '6289630727282', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(34, '1033', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Laki laki', 'Jambi', '2017-01-01', 'image/placeholder.png', '6289630727283', 'Baca', 'jalengka', 'tuni', 'yujo', '6289630727283', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(35, '1034', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Ranu', 'Perempuan', 'Jambi', '2017-02-01', 'image/placeholder.png', '6289630727284', 'Tulis', 'jemarang', 'wati', 'parjo', '6289630727284', '4', 4, '', 'active', '2021-04-16', '2021-04-16'),
(36, '1035', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rane', 'Laki laki', 'Jambi', '2018-01-01', 'image/placeholder.png', '6289630727285', 'Hitung', 'jurabaya', 'desi', 'warjo', '6289630727285', '5', 5, '', 'active', '2021-04-16', '2021-04-16'),
(37, '1036', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Perempuan', 'Jambi', '2018-02-01', 'image/placeholder.png', '6289630727286', 'Nyanyi', 'jakarta', 'titi', 'bejo', '6289630727286', '1', 1, '', 'active', '2021-04-16', '2021-04-16'),
(38, '1037', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rana', 'Laki laki', 'Jambi', '2019-01-01', 'image/placeholder.png', '6289630727287', 'Baca', 'jambi', 'nini', 'tejo', '6289630727287', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(39, '1038', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rani', 'Perempuan', 'Jambi', '2019-02-01', 'image/placeholder.png', '6289630727288', 'Tulis', 'jepara', 'rini', 'bajo', '6289630727288', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(40, '1039', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Laki laki', 'Jambi', '2020-01-01', 'image/placeholder.png', '6289630727289', 'Hitung', 'jabon', 'mini', 'kojo', '6289630727289', '4', 4, '', 'active', '2021-04-16', '2021-04-16'),
(41, '1040', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Ranu', 'Perempuan', 'Jambi', '2020-02-01', 'image/placeholder.png', '6289630727290', 'Nyanyi', 'jalengka', 'lini', 'dojo', '6289630727290', '5', 5, '', 'active', '2021-04-16', '2021-04-16'),
(42, '1041', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rane', 'Laki laki', 'Jambi', '2021-01-01', 'image/placeholder.png', '6289630727291', 'Baca', 'jemarang', 'kini', 'jojo', '6289630727291', '1', 1, '', 'active', '2021-04-16', '2021-04-16'),
(43, '1042', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Perempuan', 'Jambi', '2021-02-01', 'image/placeholder.png', '6289630727292', 'Tulis', 'jurabaya', 'boni', 'nojo', '6289630727292', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(44, '1043', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rana', 'Laki laki', 'Jambi', '2022-01-01', 'image/placeholder.png', '6289630727293', 'Hitung', 'jakarta', 'neni', 'rejo', '6289630727293', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(45, '1044', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rani', 'Perempuan', 'Jambi', '2022-02-01', 'image/placeholder.png', '6289630727294', 'Nyanyi', 'jambi', 'tuni', 'yujo', '6289630727294', '4', 4, '', 'active', '2021-04-16', '2021-04-16'),
(46, '1045', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Laki laki', 'Jambi', '2023-01-01', 'image/placeholder.png', '6289630727295', 'Baca', 'jepara', 'wati', 'parjo', '6289630727295', '5', 5, '', 'active', '2021-04-16', '2021-04-16'),
(47, '1046', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Ranu', 'Perempuan', 'Jambi', '2023-02-01', 'image/placeholder.png', '6289630727296', 'Tulis', 'jabon', 'desi', 'warjo', '6289630727296', '1', 1, '', 'active', '2021-04-16', '2021-04-16'),
(48, '1047', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rane', 'Laki laki', 'Jambi', '2024-01-01', 'image/placeholder.png', '6289630727297', 'Hitung', 'jalengka', 'titi', 'bejo', '6289630727297', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(49, '1048', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Perempuan', 'Jambi', '2024-02-01', 'image/placeholder.png', '6289630727298', 'Nyanyi', 'jemarang', 'nini', 'tejo', '6289630727298', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(50, '1049', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rana', 'Laki laki', 'Jambi', '2025-01-01', 'image/placeholder.png', '6289630727299', 'Baca', 'jurabaya', 'rini', 'bajo', '6289630727299', '4', 4, '', 'active', '2021-04-16', '2021-04-16'),
(51, '1050', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rani', 'Perempuan', 'Jambi', '2025-02-01', 'image/placeholder.png', '6289630727300', 'Tulis', 'jakarta', 'mini', 'kojo', '6289630727300', '5', 5, '', 'active', '2021-04-16', '2021-04-16'),
(52, '1051', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Laki laki', 'Jambi', '2026-01-01', 'image/placeholder.png', '6289630727301', 'Hitung', 'jambi', 'lini', 'dojo', '6289630727301', '1', 1, '', 'active', '2021-04-16', '2021-04-16'),
(53, '1052', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Ranu', 'Perempuan', 'Jambi', '2026-02-01', 'image/placeholder.png', '6289630727302', 'Nyanyi', 'jepara', 'kini', 'jojo', '6289630727302', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(54, '1053', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rane', 'Laki laki', 'Jambi', '2027-01-01', 'image/placeholder.png', '6289630727303', 'Baca', 'jabon', 'boni', 'nojo', '6289630727303', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(55, '1054', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Perempuan', 'Jambi', '2027-02-01', 'image/placeholder.png', '6289630727304', 'Tulis', 'jalengka', 'neni', 'rejo', '6289630727304', '4', 4, '', 'active', '2021-04-16', '2021-04-16'),
(56, '1055', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rana', 'Laki laki', 'Jambi', '2028-01-01', 'image/placeholder.png', '6289630727305', 'Hitung', 'jemarang', 'tuni', 'yujo', '6289630727305', '5', 5, '', 'active', '2021-04-16', '2021-04-16'),
(57, '1056', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rani', 'Perempuan', 'Jambi', '2028-02-01', 'image/placeholder.png', '6289630727306', 'Nyanyi', 'jurabaya', 'wati', 'parjo', '6289630727306', '1', 1, '', 'active', '2021-04-16', '2021-04-16'),
(58, '1057', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Laki laki', 'Jambi', '2029-01-01', 'image/placeholder.png', '6289630727307', 'Baca', 'jakarta', 'desi', 'warjo', '6289630727307', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(59, '1058', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Ranu', 'Perempuan', 'Jambi', '2029-02-01', 'image/placeholder.png', '6289630727308', 'Tulis', 'jambi', 'titi', 'bejo', '6289630727308', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(60, '1059', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rane', 'Laki laki', 'Jambi', '2030-01-01', 'image/placeholder.png', '6289630727309', 'Hitung', 'jepara', 'nini', 'tejo', '6289630727309', '4', 4, '', 'active', '2021-04-16', '2021-04-16'),
(61, '1060', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Perempuan', 'Jambi', '2030-02-01', 'image/placeholder.png', '6289630727310', 'Nyanyi', 'jabon', 'rini', 'bajo', '6289630727310', '5', 5, '', 'active', '2021-04-16', '2021-04-16'),
(62, '1061', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rana', 'Laki laki', 'Jambi', '2031-01-01', 'image/placeholder.png', '6289630727311', 'Baca', 'jalengka', 'mini', 'kojo', '6289630727311', '1', 1, '', 'active', '2021-04-16', '2021-04-16'),
(63, '1062', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rani', 'Perempuan', 'Jambi', '2031-02-01', 'image/placeholder.png', '6289630727312', 'Tulis', 'jemarang', 'lini', 'dojo', '6289630727312', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(64, '1063', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Laki laki', 'Jambi', '2032-01-01', 'image/placeholder.png', '6289630727313', 'Hitung', 'jurabaya', 'kini', 'jojo', '6289630727313', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(65, '1064', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Ranu', 'Perempuan', 'Jambi', '2032-02-01', 'image/placeholder.png', '6289630727314', 'Nyanyi', 'jakarta', 'boni', 'nojo', '6289630727314', '4', 4, '', 'active', '2021-04-16', '2021-04-16'),
(66, '1065', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rane', 'Laki laki', 'Jambi', '2033-01-01', 'image/placeholder.png', '6289630727315', 'Baca', 'jambi', 'neni', 'rejo', '6289630727315', '5', 5, '', 'active', '2021-04-16', '2021-04-16'),
(67, '1066', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Perempuan', 'Jambi', '2033-02-01', 'image/placeholder.png', '6289630727316', 'Tulis', 'jepara', 'tuni', 'yujo', '6289630727316', '1', 1, '', 'active', '2021-04-16', '2021-04-16'),
(68, '1067', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rana', 'Laki laki', 'Jambi', '2034-01-01', 'image/placeholder.png', '6289630727317', 'Hitung', 'jabon', 'wati', 'parjo', '6289630727317', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(69, '1068', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rani', 'Perempuan', 'Jambi', '2034-02-01', 'image/placeholder.png', '6289630727318', 'Nyanyi', 'jalengka', 'desi', 'warjo', '6289630727318', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(70, '1069', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Laki laki', 'Jambi', '2035-01-01', 'image/placeholder.png', '6289630727319', 'Baca', 'jemarang', 'titi', 'bejo', '6289630727319', '4', 4, '', 'active', '2021-04-16', '2021-04-16'),
(71, '1070', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Ranu', 'Perempuan', 'Jambi', '2035-02-01', 'image/placeholder.png', '6289630727320', 'Tulis', 'jurabaya', 'nini', 'tejo', '6289630727320', '5', 5, '', 'active', '2021-04-16', '2021-04-16'),
(72, '1071', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rane', 'Laki laki', 'Jambi', '2036-01-01', 'image/placeholder.png', '6289630727321', 'Hitung', 'jakarta', 'rini', 'bajo', '6289630727321', '1', 1, '', 'active', '2021-04-16', '2021-04-16'),
(73, '1072', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Perempuan', 'Jambi', '2036-02-01', 'image/placeholder.png', '6289630727322', 'Nyanyi', 'jambi', 'mini', 'kojo', '6289630727322', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(74, '1073', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rana', 'Laki laki', 'Jambi', '2037-01-01', 'image/placeholder.png', '6289630727323', 'Baca', 'jepara', 'lini', 'dojo', '6289630727323', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(75, '1074', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rani', 'Perempuan', 'Jambi', '2037-02-01', 'image/placeholder.png', '6289630727324', 'Tulis', 'jabon', 'kini', 'jojo', '6289630727324', '4', 4, '', 'active', '2021-04-16', '2021-04-16'),
(76, '1075', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Laki laki', 'Jambi', '2038-01-01', 'image/placeholder.png', '6289630727325', 'Hitung', 'jalengka', 'boni', 'nojo', '6289630727325', '5', 5, '', 'active', '2021-04-16', '2021-04-16'),
(77, '1076', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Ranu', 'Perempuan', 'Jambi', '2038-02-01', 'image/placeholder.png', '6289630727326', 'Nyanyi', 'jemarang', 'neni', 'rejo', '6289630727326', '1', 1, '', 'active', '2021-04-16', '2021-04-16'),
(78, '1077', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rane', 'Laki laki', 'Jambi', '2039-01-01', 'image/placeholder.png', '6289630727327', 'Baca', 'jurabaya', 'tuni', 'yujo', '6289630727327', '2', 2, '', 'active', '2021-04-16', '2021-04-16'),
(79, '1078', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rano', 'Perempuan', 'Jambi', '2039-02-01', 'image/placeholder.png', '6289630727328', 'Tulis', 'jakarta', 'wati', 'parjo', '6289630727328', '3', 3, '', 'active', '2021-04-16', '2021-04-16'),
(80, '1079', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rana', 'Laki laki', 'Jambi', '2040-01-01', 'image/placeholder.png', '6289630727329', 'Baca', 'jambi', 'desi', 'warjo', '6289630727329', '4', 4, '', 'inactive', '2021-04-16', '2021-04-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `student_alumni`
--

CREATE TABLE `student_alumni` (
  `student_id` int(11) NOT NULL,
  `nis` varchar(45) DEFAULT NULL,
  `nisn` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birth_place` varchar(45) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `nohp` varchar(45) DEFAULT NULL,
  `hobi` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `ibu` varchar(100) DEFAULT NULL,
  `ayahwali` varchar(100) DEFAULT NULL,
  `waortu` varchar(45) DEFAULT NULL,
  `kelas_id` varchar(11) DEFAULT NULL,
  `jurusan` int(11) DEFAULT NULL,
  `catatan` text NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `last_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `student_alumni`
--

INSERT INTO `student_alumni` (`student_id`, `nis`, `nisn`, `password`, `nama`, `gender`, `birth_place`, `birth_date`, `avatar`, `nohp`, `hobi`, `alamat`, `ibu`, `ayahwali`, `waortu`, `kelas_id`, `jurusan`, `catatan`, `status`, `input_date`, `last_update`) VALUES
(2, '1001', '10002001', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'Rana', 'Laki laki', 'Jambi', '2001-01-01', 'image/placeholder.png', '6289630727251', 'Baca', 'jakarta', 'wati', 'parjo', '6289630727251', '1', 1, '', 'lulus', '2021-04-16', '2021-04-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `uang_kategori`
--

CREATE TABLE `uang_kategori` (
  `kategori_id` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `uang_kategori`
--

INSERT INTO `uang_kategori` (`kategori_id`, `nama`, `jenis`, `keterangan`) VALUES
(1, 'Pembayaran Siswa', 'in', 'Semua pemasukan yang diperoleh dari iuran bulanan/non bulanan siswa'),
(4, 'Dana BOS', 'in', 'dana bantuan operasional'),
(5, 'Listrik', 'out', 'Beban Listrik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `uang_masuk_keluar`
--

CREATE TABLE `uang_masuk_keluar` (
  `no` int(10) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `kasir` varchar(100) NOT NULL,
  `kategori_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `period_id` int(10) NOT NULL,
  `bebas_id` int(10) NOT NULL,
  `bulanan_id` int(10) NOT NULL,
  `tgl_update` date NOT NULL,
  `tgl_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `uang_masuk_keluar`
--

INSERT INTO `uang_masuk_keluar` (`no`, `tipe`, `nama`, `keterangan`, `jumlah`, `kasir`, `kategori_id`, `student_id`, `period_id`, `bebas_id`, `bulanan_id`, `tgl_update`, `tgl_input`) VALUES
(1, 'pay', 'SPP  T.A 2020/2021', 'pembayaran bulanan', 100000, 'admin', 1, 2, 1, 0, 1, '2021-04-16', '2021-04-16'),
(2, 'pay', 'Komputer T.A 2020/2021', 'pembayaran bulanan', 20000, 'admin', 1, 2, 1, 0, 193, '2021-04-16', '2021-04-16'),
(3, 'pay', 'Study Tour T.A 2020/2021', 'pembayaran cicilan', 10000, 'admin', 1, 2, 1, 1, 0, '2021-04-16', '2021-04-16'),
(4, 'pay', 'Study Tour T.A 2020/2021', 'pembayaran cicilan', 20000, 'admin', 1, 2, 1, 1, 0, '2021-04-16', '2021-04-16'),
(5, 'in', 'Dana Bos', 'bantuan pemprov', 1000000, 'admin', 4, 0, 0, 0, 0, '2021-04-16', '2021-04-16'),
(6, 'out', 'Listrik', 'token listrik', 100000, 'admin', 5, 0, 0, 0, 0, '2021-04-16', '2021-04-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `userna_me` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pa_ssword` varchar(70) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nohp` varchar(20) DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `tglaktif` date DEFAULT NULL,
  `jabatan` varchar(20) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userna_me`, `email`, `pa_ssword`, `nama`, `alamat`, `nohp`, `tgllahir`, `tglaktif`, `jabatan`, `avatar`, `no`) VALUES
('admin', 'admin@admin.com', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'admin', 'alamat', '111', '2020-02-02', '2020-02-02', 'admin', 'upload/image/placeholder.png', 24);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `backset`
--
ALTER TABLE `backset`
  ADD PRIMARY KEY (`url`);

--
-- Indeks untuk tabel `bebasan`
--
ALTER TABLE `bebasan`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `bebasan_pay`
--
ALTER TABLE `bebasan_pay`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `bulanan`
--
ALTER TABLE `bulanan`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `chmenu`
--
ALTER TABLE `chmenu`
  ADD PRIMARY KEY (`userjabatan`);

--
-- Indeks untuk tabel `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `event_colors`
--
ALTER TABLE `event_colors`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `graduation`
--
ALTER TABLE `graduation`
  ADD PRIMARY KEY (`grad_id`);

--
-- Indeks untuk tabel `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `no` (`no`);

--
-- Indeks untuk tabel `jenis_bayar`
--
ALTER TABLE `jenis_bayar`
  ADD PRIMARY KEY (`jenis_id`);

--
-- Indeks untuk tabel `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`month_id`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `pin`
--
ALTER TABLE `pin`
  ADD PRIMARY KEY (`ubah`);

--
-- Indeks untuk tabel `pos_bayar`
--
ALTER TABLE `pos_bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `fk_student_class1_idx` (`kelas_id`),
  ADD KEY `fk_student_majors1_idx` (`jurusan`);

--
-- Indeks untuk tabel `student_alumni`
--
ALTER TABLE `student_alumni`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `fk_student_class1_idx` (`kelas_id`),
  ADD KEY `fk_student_majors1_idx` (`jurusan`);

--
-- Indeks untuk tabel `uang_kategori`
--
ALTER TABLE `uang_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `uang_masuk_keluar`
--
ALTER TABLE `uang_masuk_keluar`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userna_me`),
  ADD KEY `no` (`no`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bebasan`
--
ALTER TABLE `bebasan`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `bebasan_pay`
--
ALTER TABLE `bebasan_pay`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `bulanan`
--
ALTER TABLE `bulanan`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT untuk tabel `class`
--
ALTER TABLE `class`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `event_colors`
--
ALTER TABLE `event_colors`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `graduation`
--
ALTER TABLE `graduation`
  MODIFY `grad_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `jenis_bayar`
--
ALTER TABLE `jenis_bayar`
  MODIFY `jenis_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `months`
--
ALTER TABLE `months`
  MODIFY `month_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pos_bayar`
--
ALTER TABLE `pos_bayar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `rekening`
--
ALTER TABLE `rekening`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `student_alumni`
--
ALTER TABLE `student_alumni`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `uang_kategori`
--
ALTER TABLE `uang_kategori`
  MODIFY `kategori_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `uang_masuk_keluar`
--
ALTER TABLE `uang_masuk_keluar`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
