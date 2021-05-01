CREATE DATABASE IF NOT EXISTS beadsql;
DROP TABLE IF EXISTS `felhasznalok`;
CREATE TABLE `felhasznalok` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `csaladi_nev` varchar(40) DEFAULT NULL,
  `uto_nev` varchar(40) DEFAULT NULL,
  `bejelentkezes` varchar(40) DEFAULT NULL,
  `jelszo` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `uzenetek`;
CREATE TABLE `uzenetek` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `nev` text DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `szoveg` varchar(500) DEFAULT NULL,
  `datum` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
