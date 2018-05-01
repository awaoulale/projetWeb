-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 01 mai 2018 à 11:16
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `ece`
--

DROP TABLE IF EXISTS `ece`;
CREATE TABLE IF NOT EXISTS `ece` (
  `mail` text NOT NULL,
  `pseudo` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ece`
--

INSERT INTO `ece` (`mail`, `pseudo`, `id`, `nom`, `prenom`) VALUES
('eleonore.vermeulen@edu.ece.fr', 'EVermeulen', 1, 'Vermeulen', 'Eleonore'),
('magali.treuvelot@edu.ece.fr', 'MTreuvelot', 2, 'Treuvelot', 'Magali'),
('awa.oulale@edu.ece.fr', 'AOulale', 3, 'Oulale', 'Awa'),
('cyprien.uhartjouet@edu.ece.fr', 'CUhart', 4, 'Uhart', 'Cyprien'),
('jeanpierre.segado@edu.ece.fr', 'JSegado', 5, 'Segado', 'Jean-Pierre'),
('elizabeth.rendler@edu.ece.fr', 'ERendler', 6, 'Rendler', 'Elizabeth'),
('meva.ranarison@edu.ece.fr', 'MRanarison', 7, 'Ranarison', 'Meva'),
('yann.rinjard@edu.ece.fr', 'YRinjard', 8, 'Rinjard', 'Yann'),
('thevinh.truong@edu.ece.fr', 'TTruong', 9, 'Truong', 'Thevinh'),
('numa.lamy@edu.ece.fr', 'NLamy', 10, 'Lamy', 'Numa');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
