-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Dez 2019 um 21:36
-- Server-Version: 10.4.6-MariaDB
-- PHP-Version: 7.3.9

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
(11, 5, 1),
(12, 7, 1);

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
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `Name_DE` varchar(255) NOT NULL,
  `Name_EN` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`ID`, `Name_DE`, `Name_EN`) VALUES
(1, 'Jacken', 'Jackets'),
(2, 'Hosen', 'Trousers'),
(5, 'Pullover', 'Pullover'),
(6, 'Unterwäsche', 'Underwear');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category_product`
--

CREATE TABLE `category_product` (
  `ID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `colors`
--

CREATE TABLE `colors` (
  `ID` int(11) NOT NULL,
  `Name_DE` varchar(255) NOT NULL,
  `Name_EN` varchar(255) NOT NULL,
  `HexValue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `colors`
--

INSERT INTO `colors` (`ID`, `Name_DE`, `Name_EN`, `HexValue`) VALUES
(1, 'Schwarz', 'Black', '000000'),
(2, 'Weiss', 'White', 'FFFFFF'),
(3, 'Grün', 'Green', '445C3C'),
(4, 'Blau', 'Blue', '315B96'),
(5, 'Violett', 'Purple', '58508D'),
(6, 'Rot', 'Red', 'B22222');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `StageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `orders`
--

INSERT INTO `orders` (`ID`, `UserID`, `StageID`) VALUES
(1, 16, 2),
(2, 16, 2),
(3, 18, 1),
(4, 16, 2),
(6, 16, 2),
(7, 16, 2),
(8, 16, 2),
(9, 16, 1),
(10, 23, 1);

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

--
-- Daten für Tabelle `orders_products`
--

INSERT INTO `orders_products` (`ID`, `ProductID`, `OrderID`, `Amount`, `SizeID`, `ColorID`) VALUES
(22, 1, 1, 5, 1, 3),
(28, 1, 3, 1, 1, 3),
(30, 1, 2, 1, 1, 3),
(31, 3, 2, 1, 2, 2),
(32, 1, 4, 1, 1, 3),
(33, 3, 4, 2, 2, 2),
(35, 1, 6, 1, 1, 3),
(36, 1, 7, 1, 1, 3),
(37, 1, 8, 1, 1, 3),
(38, 1, 9, 1, 1, 3),
(39, 1, 10, 1, 1, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `Name_DE` varchar(255) DEFAULT NULL,
  `Name_EN` varchar(255) DEFAULT NULL,
  `Description_DE` text DEFAULT NULL,
  `Description_EN` text DEFAULT NULL,
  `Sex` varchar(10) NOT NULL,
  `Image` varchar(4096) DEFAULT NULL,
  `Price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`ID`, `Name_DE`, `Name_EN`, `Description_DE`, `Description_EN`, `Sex`, `Image`, `Price`) VALUES
(1, 'T-Shirt Uni', 'T-Shirt', 'Ein einfarbiges T-Shirt welches in mehreren Farben und Grössen verfügbar ist.', 'A T-Shirt available in multiple colors.', 'Male', 'tshirt.png', 19.95),
(2, 'Jeans', 'Jeans', 'Ein paar Blauer wunderschöner Jeans', 'A Blue pair of beautiful pants.', 'Male', 'jeans.png', 49.95),
(3, 'Socken', 'Socks', 'Ein Normales paar weisser Socken.', 'A pair of white socks.', 'Female', 'socken.png', 9.95),
(4, 'Pullover', 'Pullover', 'Ein warmer aus 100% Wolle bestehender Pullover.', 'A warm and soft pullover with 100% cotten.', 'Male', 'pullover.png', 39.95),
(5, 'Jacke', 'Jacket', 'Eine dicke Jacke perfekt für zum Skifahren oder während kalten Wintertagen', 'A thic Veste that will keep you warm in the biggest snowstorm.', 'Male', 'jacke.png', 109.95),
(6, 'Mütze', 'Cap', 'Eine warme Wollmütze in zwei verschiedenen Farben entweder Schwarz oder Blau.', 'A comftable cap available in black or blue.', 'Female', 'mütze.png', 14.95),
(7, 'Schwarzes Kleid', 'Black dress', 'Elegantes Kleid für beiläufige wie auch formelle Ereignisse.', 'Sleek dress for casual as well as formal events.', 'Female', 'dress1.png', 49.95),
(8, 'Rotes Kleid', 'Red dress', 'Verführerisches rotes Kleid mit entzückender schwarzer schleife.', 'Seductive red dress with lovely black bow.', 'Female', 'dress2.png', 49.95);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sizes`
--

CREATE TABLE `sizes` (
  `ID` int(11) NOT NULL,
  `Name_DE` varchar(255) NOT NULL,
  `Name_EN` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `sizes`
--

INSERT INTO `sizes` (`ID`, `Name_DE`, `Name_EN`) VALUES
(1, 'Klein', 'Small'),
(2, 'Mittel', 'Medium'),
(3, 'Gross', 'Large');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stages`
--

CREATE TABLE `stages` (
  `ID` int(11) NOT NULL,
  `Name_DE` varchar(255) NOT NULL,
  `Name_EN` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `stages`
--

INSERT INTO `stages` (`ID`, `Name_DE`, `Name_EN`) VALUES
(1, 'Warenkorb', 'Basket'),
(2, 'Gekauft', 'Bought'),
(3, 'Versendet', 'Sent');

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
(15, 'meche', 'mech@mech', 'f7ff8b3b2c106010635c9252ab4c4a66', 1),
(16, 'yrue', 'yrue@test.ch', '202cb962ac59075b964b07152d234b70', 2),
(18, 'admin', 'admin@bfh.ch', '63a9f0ea7bb98050796b649e85481845', 2),
(23, 'Yannick', 'yannick.ruefenacht@hotmail.com', 'cd6ced3ae839a743ee8c44f307527d9f', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_types`
--

CREATE TABLE `user_types` (
  `ID` int(11) NOT NULL,
  `Name_DE` varchar(255) NOT NULL,
  `Name_EN` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user_types`
--

INSERT INTO `user_types` (`ID`, `Name_DE`, `Name_EN`) VALUES
(1, 'Kunde', 'Customer'),
(2, 'Admin', 'Administrator');

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
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_category_product_categoryid` (`categoryID`),
  ADD KEY `fk_category_product_productid` (`productID`);

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
  ADD KEY `fk_users` (`UserID`),
  ADD KEY `fk_order_stages` (`StageID`);

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
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `available_colors`
--
ALTER TABLE `available_colors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `available_sizes`
--
ALTER TABLE `available_sizes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `category_product`
--
ALTER TABLE `category_product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `colors`
--
ALTER TABLE `colors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
-- Constraints der Tabelle `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `fk_category_product_categoryid` FOREIGN KEY (`categoryID`) REFERENCES `category` (`ID`),
  ADD CONSTRAINT `fk_category_product_productid` FOREIGN KEY (`productID`) REFERENCES `products` (`ID`);

--
-- Constraints der Tabelle `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_stages` FOREIGN KEY (`StageID`) REFERENCES `stages` (`ID`),
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);

--
-- Constraints der Tabelle `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `fk_colors` FOREIGN KEY (`ColorID`) REFERENCES `colors` (`ID`),
  ADD CONSTRAINT `fk_orders` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `fk_products` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ID`),
  ADD CONSTRAINT `fk_sizes` FOREIGN KEY (`SizeID`) REFERENCES `sizes` (`ID`);

--
-- Constraints der Tabelle `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_types_users` FOREIGN KEY (`User_TypeID`) REFERENCES `user_types` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
