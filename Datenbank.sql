-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 15. Jan 2023 um 17:13
-- Server-Version: 10.4.17-MariaDB
-- PHP-Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `projekt`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE `news` (
  `newsid` int(255) NOT NULL,
  `path` varchar(200) DEFAULT NULL,
  `paththumb` varchar(250) DEFAULT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `news`
--

INSERT INTO `news` (`newsid`, `path`, `paththumb`, `title`, `comment`, `date`) VALUES
(23, 'uploads/2023-01-15-17-08-04.jpeg', 'thumbs/2023-01-15-17-08-04.jpeg', 'Österreichischer Innovationspreis Tourismus für The Harmonie Vienna   ', 'Motto des Hotels: \'Gemeinsam für ein Gästelächeln\'\r\n  ', '2023-01-15'),
(24, 'uploads/2023-01-15-17-09-02.jpeg', 'thumbs/2023-01-15-17-09-02.jpeg', 'Hotel glänzt nach Renovierung!   ', 'Hotel Overlook am 23. November 2022\r\n  ', '2023-01-15'),
(25, 'uploads/2023-01-15-17-09-59.jpeg', 'thumbs/2023-01-15-17-09-59.jpeg', 'Hotel Overlook überrascht mit Ladesäule für die Gäste!   ', 'Reisen mit dem E-Auto leichter gemacht\r\n  \r\n  ', '2023-01-15'),
(26, 'uploads/2023-01-15-17-10-42.jpeg', 'thumbs/2023-01-15-17-10-42.jpeg', 'Konzentration auf das Wesentliche im Hotel Overlook!   ', 'Harmonische Kombination aus Alt und Neu\r\n  ', '2023-01-15');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `useremail` varchar(200) CHARACTER SET utf8 NOT NULL,
  `nachname` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '''''',
  `vorname` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '"',
  `password` varchar(260) CHARACTER SET utf8 NOT NULL DEFAULT '"',
  `anrede` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '"',
  `geb` date DEFAULT NULL,
  `stadt` varchar(200) DEFAULT '"',
  `plz` int(5) DEFAULT NULL,
  `land` varchar(200) NOT NULL DEFAULT '"',
  `aktiv` varchar(50) NOT NULL DEFAULT 'aktiv'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`useremail`, `nachname`, `vorname`, `password`, `anrede`, `geb`, `stadt`, `plz`, `land`, `aktiv`) VALUES
('admin@hotel', '\'\'', 'admin', '$2y$10$SkDLUM2li7LfSlW1oXljteHGyDaqj13bS3189xSFfRYbMHVkjgaWa', '\"', NULL, '\"', NULL, '\"', 'aktiv'),
('asanov@hotmail.com', 'Asanov', 'Alen', '$2y$10$jMXxA4wr5RuxqjVHA79QVuvwcG7.eooCTcpGYU3x1BczCTkQK1zkS', 'herr', '0000-00-00', 'Wien', 1100, 'Österreich', 'aktiv'),
('saski@hotel.at', 'hartl', 'saskia', '$2y$10$KIoMEIrJk0D2ay7yzHfcvOQI5v9WS2D/DKMe1sbWgGIQ2atLlg6OW', 'herr', '0000-00-00', 'wien', 1234, 'Österreich', 'inaktiv');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zimmerreservierung`
--

CREATE TABLE `zimmerreservierung` (
  `resid` int(20) NOT NULL,
  `date1` date NOT NULL,
  `date2` date NOT NULL,
  `personen` int(20) NOT NULL,
  `haustiere` varchar(5) CHARACTER SET utf8 NOT NULL,
  `fruehstueck` varchar(5) CHARACTER SET utf8 NOT NULL,
  `parkplatz` varchar(5) CHARACTER SET utf8 NOT NULL,
  `useremail` varchar(200) NOT NULL,
  `Preis` double NOT NULL,
  `Status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `zimmerreservierung`
--

INSERT INTO `zimmerreservierung` (`resid`, `date1`, `date2`, `personen`, `haustiere`, `fruehstueck`, `parkplatz`, `useremail`, `Preis`, `Status`) VALUES
(24, '2023-02-01', '2023-02-02', 1, 'ja', 'nein', 'nein', 'asanov@hotmail.com', 56.49, 'bestätigt'),
(25, '2023-01-14', '2023-01-17', 3, 'ja', 'ja', 'nein', 'asanov@hotmail.com', 652.32, 'storniert'),
(26, '2023-01-30', '2023-01-31', 5, 'nein', 'nein', 'nein', 'asanov@hotmail.com', 222.5, 'neu'),
(27, '2023-03-04', '2023-03-11', 1, 'ja', 'ja', 'ja', 'saski@hotel.at', 563.29, 'neu');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsid`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`useremail`);

--
-- Indizes für die Tabelle `zimmerreservierung`
--
ALTER TABLE `zimmerreservierung`
  ADD PRIMARY KEY (`resid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `news`
--
ALTER TABLE `news`
  MODIFY `newsid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT für Tabelle `zimmerreservierung`
--
ALTER TABLE `zimmerreservierung`
  MODIFY `resid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
