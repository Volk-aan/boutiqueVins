-- --------------------------------------------------------
-- Hôte :                        lamp-edu.condorcet.be
-- Version du serveur:           5.5.33-MariaDB - openSUSE package
-- SE du serveur:                Linux
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de la table volkan_bostanci_citadelle. ATTENTE
CREATE TABLE IF NOT EXISTS `ATTENTE` (
  `ID_PRODUIT` int(5) NOT NULL,
  `ID_CLIENT` int(6) NOT NULL,
  `QUANTITE` int(32) NOT NULL,
  PRIMARY KEY (`ID_PRODUIT`,`ID_CLIENT`),
  KEY `FK_ATTENTE_CLIENTS` (`ID_CLIENT`),
  CONSTRAINT `ATTENTE_ibfk_1` FOREIGN KEY (`ID_PRODUIT`) REFERENCES `PRODUITS` (`ID_PRODUIT`),
  CONSTRAINT `ATTENTE_ibfk_2` FOREIGN KEY (`ID_CLIENT`) REFERENCES `UTILISATEURS` (`ID_CLIENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Export de la structure de la table volkan_bostanci_citadelle. COMMANDE
CREATE TABLE IF NOT EXISTS `COMMANDE` (
  `ID_COMMANDE` int(6) NOT NULL AUTO_INCREMENT,
  `ID_CLIENT` int(6) NOT NULL,
  `PRIX_TOTAL` decimal(13,2) DEFAULT NULL,
  `PAYE` int(11) DEFAULT '0',
  `DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_COMMANDE`),
  KEY `FK_COMMANDE_CLIENTS` (`ID_CLIENT`),
  CONSTRAINT `COMMANDE_ibfk_1` FOREIGN KEY (`ID_CLIENT`) REFERENCES `UTILISATEURS` (`ID_CLIENT`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Export de la structure de la table volkan_bostanci_citadelle. COMMENTE
CREATE TABLE IF NOT EXISTS `COMMENTE` (
  `ID_PRODUIT` int(5) NOT NULL,
  `ID_CLIENT` int(2) NOT NULL,
  `NOTE` int(2) NOT NULL,
  `COMMENTAIRE` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID_PRODUIT`,`ID_CLIENT`),
  KEY `FK_COMMENTE_CLIENTS` (`ID_CLIENT`),
  CONSTRAINT `COMMENTE_ibfk_2` FOREIGN KEY (`ID_CLIENT`) REFERENCES `UTILISATEURS` (`ID_CLIENT`),
  CONSTRAINT `COMMENTE_ibfk_1` FOREIGN KEY (`ID_PRODUIT`) REFERENCES `PRODUITS` (`ID_PRODUIT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Export de la structure de la table volkan_bostanci_citadelle. COMPORTE
CREATE TABLE IF NOT EXISTS `COMPORTE` (
  `ID_COMMANDE` int(9) NOT NULL,
  `ID_PRODUIT` int(5) NOT NULL,
  `QUANTITE` int(5) NOT NULL,
  `PRIX` decimal(13,2) NOT NULL,
  PRIMARY KEY (`ID_PRODUIT`,`ID_COMMANDE`),
  KEY `FK_COMPORTE_COMMANDE` (`ID_COMMANDE`),
  CONSTRAINT `COMPORTE_ibfk_1` FOREIGN KEY (`ID_PRODUIT`) REFERENCES `PRODUITS` (`ID_PRODUIT`),
  CONSTRAINT `COMPORTE_ibfk_2` FOREIGN KEY (`ID_COMMANDE`) REFERENCES `COMMANDE` (`ID_COMMANDE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Export de la structure de la table volkan_bostanci_citadelle. COULEURS
CREATE TABLE IF NOT EXISTS `COULEURS` (
  `ID_COULEUR` int(2) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(32) NOT NULL,
  PRIMARY KEY (`ID_COULEUR`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Export de la structure de la table volkan_bostanci_citadelle. GOUTS
CREATE TABLE IF NOT EXISTS `GOUTS` (
  `ID_GOUT` int(2) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(128) NOT NULL,
  PRIMARY KEY (`ID_GOUT`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Export de la structure de la table volkan_bostanci_citadelle. PAGES
CREATE TABLE IF NOT EXISTS `PAGES` (
  `ID_PAGE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) NOT NULL,
  `TEXTE` text NOT NULL,
  PRIMARY KEY (`ID_PAGE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Export de la structure de la table volkan_bostanci_citadelle. PAYS
CREATE TABLE IF NOT EXISTS `PAYS` (
  `ID_PAYS` int(2) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(128) NOT NULL,
  PRIMARY KEY (`ID_PAYS`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Export de la structure de la table volkan_bostanci_citadelle. PRODUITS
CREATE TABLE IF NOT EXISTS `PRODUITS` (
  `ID_PRODUIT` int(5) NOT NULL AUTO_INCREMENT,
  `ID_PAYS` int(2) NOT NULL,
  `ID_GOUT` int(2) NOT NULL,
  `ID_COULEUR` int(2) NOT NULL,
  `NOM` varchar(50) NOT NULL,
  `DESCRIPTION` text,
  `DEGRE_ALCOOL` varchar(50) NOT NULL,
  `MILLESIME` varchar(128) NOT NULL,
  `TEMP_SERVICE` int(2) NOT NULL,
  `STOCK` int(12) NOT NULL,
  `BIO` tinyint(1) NOT NULL,
  `PHOTO` varchar(128) DEFAULT 'wine.png',
  `PRIX` double(5,2) DEFAULT NULL,
  `SUPPRIME` int(11) DEFAULT '0',
  PRIMARY KEY (`ID_PRODUIT`),
  KEY `FK_PRODUITS_PAYS` (`ID_PAYS`),
  KEY `FK_PRODUITS_GOUTS` (`ID_GOUT`),
  KEY `FK_PRODUITS_COULEURS` (`ID_COULEUR`),
  CONSTRAINT `PRODUITS_ibfk_1` FOREIGN KEY (`ID_PAYS`) REFERENCES `PAYS` (`ID_PAYS`),
  CONSTRAINT `PRODUITS_ibfk_2` FOREIGN KEY (`ID_GOUT`) REFERENCES `GOUTS` (`ID_GOUT`),
  CONSTRAINT `PRODUITS_ibfk_3` FOREIGN KEY (`ID_COULEUR`) REFERENCES `COULEURS` (`ID_COULEUR`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
-- Export de la structure de la table volkan_bostanci_citadelle. UTILISATEURS
CREATE TABLE IF NOT EXISTS `UTILISATEURS` (
  `ID_CLIENT` int(6) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(128) NOT NULL,
  `PRENOM` varchar(128) NOT NULL,
  `RUE` varchar(128) DEFAULT NULL,
  `CODE_POSTAL` varchar(128) DEFAULT NULL,
  `LOCALITE` varchar(128) DEFAULT NULL,
  `TELEPHONE` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(128) NOT NULL,
  `MOT_DE_PASSE` varchar(1024) NOT NULL,
  `SALT` varchar(512) NOT NULL,
  `ROLE` varchar(50) NOT NULL DEFAULT 'ROLE_USER',
  PRIMARY KEY (`ID_CLIENT`),
  UNIQUE KEY `EMAIL` (`EMAIL`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
