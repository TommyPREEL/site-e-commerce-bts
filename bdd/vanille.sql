-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 21 Novembre 2019 à 08:58
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `vanille`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `num_admin` int(2) NOT NULL AUTO_INCREMENT,
  `nom_admin` varchar(30) NOT NULL,
  `prenom_admin` varchar(50) NOT NULL,
  `login` varchar(20) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  PRIMARY KEY (`num_admin`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`num_admin`, `nom_admin`, `prenom_admin`, `login`, `mdp`) VALUES
(1, 'preel', 'tommy', 'preelt', '12345');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `CAT_id` char(3) NOT NULL,
  `libelle` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`CAT_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`CAT_id`, `libelle`) VALUES
('bon', 'Bonbons'),
('car', 'Caramels'),
('cho', 'Chocolats');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `CDE_id` int(3) NOT NULL,
  `datecommande` date DEFAULT NULL,
  `nomPrenomClient` varchar(50) DEFAULT NULL,
  `adresseRueClient` varchar(50) DEFAULT NULL,
  `cpClient` char(5) DEFAULT NULL,
  `villeClient` varchar(40) DEFAULT NULL,
  `mailClient` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CDE_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`CDE_id`, `datecommande`, `nomPrenomClient`, `adresseRueClient`, `cpClient`, `villeClient`, `mailClient`) VALUES
(1, '2019-09-27', 'preel tommy', '39 avenue parmentier', '31200', NULL, NULL),
(2, '2019-09-27', 'pinsolles jul', '39 avenue parmentier', '31200', 'toulouse', 'pinsollesjul@gmail.com'),
(3, '2019-10-11', 'preel tommy', 'eth', '54545', 'toulouse', 'preel.tommy@gmail.com'),
(4, '2019-10-11', 'preel tommy', 'eth', '54545', 'toulouse', 'preel.tommy@gmail.com'),
(5, '2019-10-11', 'preel tommy', 'eth', '54545', 'toulouse', 'preel.tommy@gmail.com'),
(6, '2019-10-11', 'preel tommy', 'eth', '54545', 'toulouse', 'preel.tommy@gmail.com'),
(7, '2019-10-11', 'preel tommy', 'gf,j,', '12345', 'gnfgfn', 'preel.tommy@gmail.com'),
(8, '2019-10-11', 'arr aret', 'rzgz grg', '14253', 'gtrzgzrgrz', 'preel.tommy@gmail.com'),
(9, '2019-10-11', 'jujuju', 'jujuj', '12851', 'juujuju', 'ujujju'),
(10, '2019-10-11', 'popo', 'ipiypyp', '14253', 'poopo', 'yippip'),
(11, '2019-10-11', 'popo', 'ipiypyp', '14253', 'poopo', 'yippip'),
(12, '2019-10-11', 'azert', 'zerty', '14253', 'zert', 'preel.tommy@gmail.com'),
(13, '2019-10-11', 'pmolik', 'jklhyjuk', '14785', 'pmlkilj', 'jklhjukil'),
(14, '2019-10-18', 'juurjry', 'rujru', '84111', 'yujry', 'rurujr'),
(15, '2019-10-18', 'yjrjyjyj', 'iukiulioul', '45165', 'jyjyrjrj', 'jyrjrjjujik'),
(16, '2019-10-18', '(ehhnt', 'hnqh', '42545', 'htnhtqn', 'qthnntq'),
(17, '2019-10-18', 'erggrgr', 'gerger', '87858', 'rgrgergr', 'egregerger'),
(18, '2019-10-18', 'tdtujd', 'yjtyjyj', '14718', 'jdtujdjdtj', 'tjjdtydj'),
(19, '2019-11-19', 'zeffze', 'ukyk', '25355', 'ezffez', 'ezfefz'),
(20, '2019-11-19', 'jtrjt', 'jtrrtjtr', '41477', 'trrttrjrtj', 'tjtjrrtjtrjjtr');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE IF NOT EXISTS `contenir` (
  `idcommande` int(3) NOT NULL,
  `idProduit` char(5) NOT NULL,
  PRIMARY KEY (`idcommande`,`idProduit`),
  KEY `I_FK_CONTENIR_Commande` (`idcommande`),
  KEY `I_FK_CONTENIR_Produit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contenir`
--

INSERT INTO `contenir` (`idcommande`, `idProduit`) VALUES
(13, 'BO01'),
(13, 'BO06'),
(13, 'BO07'),
(14, 'CA01'),
(14, 'CA02'),
(14, 'CA04'),
(15, 'CA01'),
(15, 'CA02'),
(15, 'CA03'),
(16, 'BO01'),
(16, 'BO02'),
(16, 'BO03'),
(16, 'BO04'),
(16, 'BO05'),
(17, 'BO01'),
(17, 'BO02'),
(17, 'BO03'),
(17, 'BO04'),
(18, 'BO05'),
(18, 'BO06'),
(19, 'BO01'),
(19, 'BO02'),
(20, 'BO01'),
(20, 'BO03');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `PDT_id` char(5) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `idCategorie` char(3) NOT NULL,
  `stock` int(5) NOT NULL,
  PRIMARY KEY (`PDT_id`),
  KEY `FK_Produit_CATEGORIE` (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`PDT_id`, `description`, `prix`, `image`, `idCategorie`, `stock`) VALUES
('BO01', 'Bonbons acidulés Lot 3 Kg', '43.00', 'images/bonbons/bonbon1.png', 'bon', 98),
('BO02', 'Berlingots en vrac Lot 2Kg', '25.00', 'images/bonbons/bonbon2.png', 'bon', 100),
('BO03', 'Bonbons menthe Lot 3Kg', '33.00', 'images/bonbons/bonbon3.png', 'bon', 0),
('BO04', 'Sucettes festives Lot 3Kg', '48.00', 'images/bonbons/bonbon4.png', 'bon', 0),
('BO05', 'Bonbons surprise Lot 1Kg', '14.00', 'images/bonbons/bonbon5.png', 'bon', 1223),
('BO06', 'Smarties Lot 3Kg', '18.00', 'images/bonbons/bonbon6.png', 'bon', 1223),
('BO07', 'Nounours colorés Lot 2Kg', '24.00', 'images/bonbons/bonbon7.png', 'bon', 1224),
('CA01', 'Caramels Beurre salé lot 2Kg', '36.00', 'images/caramels/caramel1.png', 'car', 999),
('CA02', 'Caramels Vanille 2 lots 1Kg', '12.00', 'images/caramels/caramel2.png', 'car', 104),
('CA03', 'Caramel tablette Lot 3Kg', '30.00', 'images/caramels/caramel3.png', 'car', 1224),
('CA04', 'Caramels parfumés Lot 2Kg', '41.00', 'images/caramels/caramel4.png', 'car', 1224),
('CA05', 'Caramels croquants Lot 1Kg', '18.00', 'images/caramels/caramel5.png', 'car', 1224),
('CA06', 'Caramels surprise Lot 3 Kg', '48.00', 'images/caramels/caramel6.png', 'car', 1224),
('CH01', 'Chocolats Pralinés lot 2Kg', '200.00', 'images/chocolats/choco1.png', 'cho', 22),
('CH02', 'Oeufs en chocolat Lot 2Kg', '26.00', 'images/chocolats/choco2.png', 'cho', 1224),
('CH03', 'Fagots au chocolat lot 1Kg', '17.00', 'images/chocolats/choco3.png', 'cho', 1224),
('CH04', 'Chocolats amande Lot 2Kg', '45.00', 'images/chocolats/choco4.png', 'cho', 1224),
('CH05', 'Noir Intense Lot 3Kg', '55.00', 'images/chocolats/choco5.png', 'cho', 1224),
('CH06', 'Vanille Chocolat lot 1Kg', '23.00', 'images/chocolats/choco6.png', 'cho', 1224),
('CH07', 'Trésor de Chocolats  lot 2Kg', '65.00', 'images/chocolats/choco7.png', 'cho', 1224),
('CH08', 'Truffes délice lot 2Kg', '43.00', 'images/chocolats/choco8.png', 'cho', 1224);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_fk_1` FOREIGN KEY (`idcommande`) REFERENCES `commande` (`CDE_id`),
  ADD CONSTRAINT `contenir_fk_2` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`PDT_id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`CAT_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
