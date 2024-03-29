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

DELIMITER $$
--
-- Eljárások
--
DROP PROCEDURE IF EXISTS `AddUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddUser` (IN `name` VARCHAR(255), IN `email` VARCHAR(255), IN `password` VARCHAR(255), IN `activationcode` VARCHAR(255), IN `status` INT(11), IN `nev` VARCHAR(250), IN `varos` VARCHAR(250), IN `megye` VARCHAR(50), IN `elerhetoseg` VARCHAR(250), IN `ado` VARCHAR(500), IN `weblink` VARCHAR(300))  BEGIN
	INSERT INTO userregistration(name, email, password, activationcode, status) VALUES(name, email, password, activationcode, status);
    SET @last = LAST_INSERT_ID();
	INSERT INTO allatmentok(Nev, Varos, Megye, Elerhetoseg, Ado, Weblink, madeby) VALUES(nev, varos, megye, elerhetoseg, ado, weblink, @last);
END$$

DELIMITER ;
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

--
-- A tábla adatainak kiíratása `allatmentok`
--

INSERT INTO `allatmentok` (`id`, `Nev`, `Cim`, `Megye`, `Elerhetoseg`, `Ado`, `Weblink`, `madeby`) VALUES
(1, 'Tarka Falka ALAPÍTVÁNY', 'Békéscsaba Rigó u. 17.', 'Békés megye', '70 774 7102', '18393907-1-04', 'https://www.facebook.com/tarkafalkaebrehab/', 1),
(2, 'Adler Állatmentő Egyesület', 'Budapest XXIII. Soroksár', 'Budapest', '', '18877788-1-43', 'https://www.facebook.com/adlerallatmentoegyesulet/', 1),
(3, 'Agenor Civil Állatvédő Egyesület', 'Budapest XXI. Csepel', 'Budapest', '30 382 9855 agenorcsepel@gmail.com', '18976461-1-43', 'https://www.facebook.com/agenorcsepel/', 1),
(4, 'A Gazdátlan Állatokért Alapítvány', 'Tatabánya Bartók Béla u. 3.', 'Komárom-Esztergom megye', '70 610 2208', '18616064-1-11', 'https://www.facebook.com/GazdatlanAllatokertAlapitvany/', 1),
(5, 'Ágica Sérült Állatmenedék Alapítvány ', 'Dunaföldvár', 'Tolna megye', '30 367 2115', '18648355-1-17', 'https://www.facebook.com/agica.alapitvanya/', 1),
(6, 'Alex Állatvédő Egyesület', 'Várpalota Tölgyes út', 'Fejér megye', '20 256 7345', '18288401-1-19', 'https://www.facebook.com/Alex-%C3%81llatv%C3%A9d%C5%91-Egyes%C3%BClet-328650850528605/', 1),
(7, 'Alapítvány a Jászberényi Állat- és Növénykertért', 'Jászberény 5100 Margit-sziget 1.', 'Jász-Nagykun-Szolnok megye', '57 415010 jaszoo@pr.hu', '15413996-2-16', 'http://www.jaszberenyzoo.hu/', 1),
(8, 'Alapítvány a macskákért', 'Piliscsaba 2081 Árpád vezér utca 43.', 'Pest megye', '26 373243 amacska@t-online.hu', '18011476-1-13', 'http://www.macskakert.hu/', 1),
(9, 'Aprajafalva Yorki Rescue Fajtamentő Alapítvány', 'Budapest', 'Budapest', 'aprajafalviak@gmail.com', '19004655-1-42', 'https://www.facebook.com/aprajafalviak/', 1),
(10, 'Állat és Ember Állat- és Természetvédő, Kultúrális és Szabadidő Egyesület', 'Budapest 1151 Pisztráng utca 3.', 'Budapest', '70 2236476 kasznakata@gmail.com', '18195376-2-42', 'http://www.xn--llatsember-r4a4h.hu/', 1),
(11, 'Állat és Természetvédők Budaörsi Egyesülete', 'Budaörs 2040 Lévai utca 34.', 'Pest megye', '70 6016700', '18693180-1-13', 'https://www.facebook.com/budaorsiallatmenhely/', 1),
(12, 'Állat és Természetvédelmi Járőrszolgálat Újpest', 'Budapest', 'Budapest', '20 3147751 ujpestbejelentes@allatmentoliga.com', '', 'https://www.facebook.com/ujpestjaror/', 1),
(13, 'Állatbarátok Köre Közhasznú Egyesület', 'Gyöngyös 3200 Fő tér 9.', 'Heves megye', '31 7813162', '18588196-1-10', 'https://ado1szazalek.com/allatbaratok-kore-kozhasznu-egyesulet-gyongyos/9857', 1),
(14, 'Állatbarát Alapítvány', 'Nyíregyháza', 'Szabolcs-Szatmár-Bereg megye', '', '18791927-1-15', 'https://www.allatbarat.com/', 1),
(15, 'Állati Fuvar', 'Országszerte Magyarország', 'Nógrád megye', '20 2100817', '', 'https://www.facebook.com/allatifuvar/', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `pwdreset`
--

DROP TABLE IF EXISTS `pwdreset`;
CREATE TABLE IF NOT EXISTS `pwdreset` (
  `pwdResetId` int(11) NOT NULL AUTO_INCREMENT,
  `pwdResetEmail` text COLLATE utf8_hungarian_ci NOT NULL,
  `pwdResetToken` longtext COLLATE utf8_hungarian_ci NOT NULL,
  `pwdResetExpires` text COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`pwdResetId`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetToken`, `pwdResetExpires`) VALUES
(11, 'admin@admin.com', '3033710dffffa493c5ea1abe193b9eb5', '1563539341');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `userregistration`
--

DROP TABLE IF EXISTS `userregistration`;
CREATE TABLE IF NOT EXISTS `userregistration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `activationcode` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `userregistration`
--

INSERT INTO `userregistration` (`id`, `name`, `email`, `password`, `activationcode`, `status`, `admin`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$15$N7qq/3tersYxsXDlu07sDO4djIqIJZAKfxSFQk6tBZ2pWeE2YMgti', '', 1, 1);


--
-- Megkötések a táblához `allatmentok`
--
ALTER TABLE `allatmentok`
  ADD CONSTRAINT `allatmentok_ibfk_1` FOREIGN KEY (`madeby`) REFERENCES `userregistration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

