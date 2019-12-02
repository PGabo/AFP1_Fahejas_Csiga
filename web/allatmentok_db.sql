-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `allatmentok_db`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allatmentok`
--

DROP TABLE IF EXISTS `allatmentok`;
CREATE TABLE IF NOT EXISTS `allatmentok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nev` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `Cim` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `Megye` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `Elerhetoseg` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `Ado` varchar(500) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `Weblink` varchar(300) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `madeby` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `madeby` (`madeby`),
  KEY `madeby_2` (`madeby`)
) ENGINE=InnoDB AUTO_INCREMENT=318 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;
