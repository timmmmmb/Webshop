-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Sep 2019 um 10:14
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

--
-- Daten für Tabelle `available_colors`
--

INSERT INTO `available_colors` (`ID`, `ProductID`, `ColorID`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 2, 4),
(4, 6, 4),
(5, 6, 1),
(6, 4, 6),
(7, 3, 2),
(8, 1, 5),
(9, 1, 2),
(10, 1, 1),
(11, 5, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `available_sizes`
--

CREATE TABLE `available_sizes` (
  `ID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `SizeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `available_sizes`
--

INSERT INTO `available_sizes` (`ID`, `ProductID`, `SizeID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 2),
(5, 5, 2),
(6, 6, 2),
(7, 3, 2),
(8, 4, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `colors`
--

CREATE TABLE `colors` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `HexValue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `colors`
--

INSERT INTO `colors` (`ID`, `Name`, `HexValue`) VALUES
(1, 'Schwarz', '000000'),
(2, 'Weiss', 'FFFFFF'),
(3, 'Grün', '30FF00'),
(4, 'Blau', '0031FF'),
(5, 'Violett', 'A700FF'),
(6, 'Rot', 'FF0000');

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
  `ColorID` int(11) NOT NULL,
  `StageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Description` mediumtext,
  `Image` varchar(4096) DEFAULT NULL,
  `Preis` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`ID`, `Name`, `Description`, `Image`, `Preis`) VALUES
(1, 'T-Shirt Uni', 'Ein einfarbiges T-Shirt welches in mehreren Farben und Grössen verfügbar ist.', 'tshirt.png', 19.95),
(2, 'Jeans', 'Ein paar Blauer wunderschöner Jeans', 'jeans.jpg', 49.95),
(3, 'Socken', 'Ein Normales paar weisser Socken.', 'socken.jpg', 9.95),
(4, 'Pullover', 'Ein warmer aus 100% Wolle bestehender Pullover.', 'pullover.jpg', 39.95),
(5, 'Jacke', 'Eine dicke Jacke perfekt für zum Skifahren oder während kalten Wintertagen', 'jacke.jpg', 109.95),
(6, 'Mütze', 'Eine warme Wollmütze in zwei verschiedenen Farben entweder Schwarz oder Blau.', 'mütze.jpg', 14.95);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sizes`
--

CREATE TABLE `sizes` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sizes`
--

INSERT INTO `sizes` (`ID`, `Name`, `Description`) VALUES
(1, 'Klein', ''),
(2, 'Mittel', ''),
(3, 'Gross', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stages`
--

CREATE TABLE `stages` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `stages`
--

INSERT INTO `stages` (`ID`, `Name`, `Description`) VALUES
(1, 'Warenkorb', 'Das Produkt befindet sich noch im Warenkorb'),
(2, 'Gekauft', 'Das Produkt wurde bezahlt und wird in kürze ausgeliefert.'),
(3, 'Versendet', 'Das Produkt wurde versendet.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `EMail` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `User_TypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`ID`, `Name`, `EMail`, `Password`, `User_TypeID`) VALUES
(12, 'bob', 'bob@bob', '9f9d51bc70ef21ca5c14f307980a29d8', 1),
(13, 'svenbob', 'bobby@bob', '9f9d51bc70ef21ca5c14f307980a29d8', 1),
(14, 'tim', 'tim@tim', 'b15d47e99831ee63e3f47cf3d4478e9a', 1),
(15, 'meche', 'mech@mech', 'f7ff8b3b2c106010635c9252ab4c4a66', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_types`
--

CREATE TABLE `user_types` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user_types`
--

INSERT INTO `user_types` (`ID`, `Name`, `Description`) VALUES
(1, 'Kunde', 'Ein kunde kann Produkte kaufen.'),
(2, 'Admin', 'Ein Admin kann Bestellungen abbrechen');

--
-- Indizes der exportierten Tabellen
--

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
  ADD KEY `fk_colors` (`ColorID`),
  ADD KEY `fk_stages_orders_products` (`StageID`);

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
-- Indizes für die Tabelle `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_user_types_users` (`User_TypeID`);

--
-- Indizes für die Tabelle `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`ID`);
  
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
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `available_colors`
--
ALTER TABLE `available_colors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `available_sizes`
--
ALTER TABLE `available_sizes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `colors`
--
ALTER TABLE `colors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `sizes`
--
ALTER TABLE `sizes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `stages`
--
ALTER TABLE `stages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `user_types`
--
ALTER TABLE `user_types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `fk_sizes` FOREIGN KEY (`SizeID`) REFERENCES `sizes` (`ID`),
  ADD CONSTRAINT `fk_stages_orders_products` FOREIGN KEY (`StageID`) REFERENCES `stages` (`ID`);

--
-- Constraints der Tabelle `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_types_users` FOREIGN KEY (`User_TypeID`) REFERENCES `user_types` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
