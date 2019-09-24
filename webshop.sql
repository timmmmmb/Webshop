-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Sep 2019 um 09:25
-- Server-Version: 10.1.38-MariaDB
-- PHP-Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `webshop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `available_colors`
--

CREATE TABLE `available_colors` (
  `ID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `ColorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `available_sizes`
--

CREATE TABLE `available_sizes` (
  `ID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `SizeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `colors`
--

CREATE TABLE `colors` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `HexValue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders_products`
--

CREATE TABLE `orders_products` (
  `ID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `Amount` int(255) NOT NULL,
  `SizeID` int(11) NOT NULL,
  `ColorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Description` mediumtext,
  `Image` varchar(4096) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sizes`
--

CREATE TABLE `sizes` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `EMail` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `available_colors`
--
ALTER TABLE `available_colors`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_products_available_colors` (`ProductID`),
  ADD KEY `fk_colors_available_colors` (`ColorID`);

--
-- Indizes für die Tabelle `available_sizes`
--
ALTER TABLE `available_sizes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_products_available_sizes` (`ProductID`),
  ADD KEY `fk_sizes_available_sizes` (`SizeID`);

--
-- Indizes für die Tabelle `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_users` (`UserID`);

--
-- Indizes für die Tabelle `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_products` (`ProductID`),
  ADD KEY `fk_orders` (`OrderID`),
  ADD KEY `fk_sizes` (`SizeID`),
  ADD KEY `fk_colors` (`ColorID`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `available_colors`
--
ALTER TABLE `available_colors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `available_sizes`
--
ALTER TABLE `available_sizes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `colors`
--
ALTER TABLE `colors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `sizes`
--
ALTER TABLE `sizes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `available_colors`
--
ALTER TABLE `available_colors`
  ADD CONSTRAINT `fk_colors_available_colors` FOREIGN KEY (`ColorID`) REFERENCES `colors` (`ID`),
  ADD CONSTRAINT `fk_products_available_colors` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ID`);

--
-- Constraints der Tabelle `available_sizes`
--
ALTER TABLE `available_sizes`
  ADD CONSTRAINT `fk_products_available_sizes` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ID`),
  ADD CONSTRAINT `fk_sizes_available_sizes` FOREIGN KEY (`SizeID`) REFERENCES `sizes` (`ID`);

--
-- Constraints der Tabelle `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);

--
-- Constraints der Tabelle `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `fk_colors` FOREIGN KEY (`ColorID`) REFERENCES `colors` (`ID`),
  ADD CONSTRAINT `fk_orders` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `fk_products` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ID`),
  ADD CONSTRAINT `fk_sizes` FOREIGN KEY (`SizeID`) REFERENCES `sizes` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
