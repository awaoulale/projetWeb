-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 30 avr. 2018 à 13:35
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
-- Structure de la table `amis`
--

DROP TABLE IF EXISTS `amis`;
CREATE TABLE IF NOT EXISTS `amis` (
  `id_ami1` int(11) NOT NULL,
  `id_ami2` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `amis`
--

INSERT INTO `amis` (`id_ami1`, `id_ami2`) VALUES
(1, 2),
(1, 5),
(4, 5),
(3, 4),
(4, 5),
(6, 7);

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id_doc` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `chemin` text NOT NULL,
  `publication` timestamp NOT NULL,
  `lieu` text NOT NULL,
  `statut` text NOT NULL,
  PRIMARY KEY (`id_doc`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `documents`
--

INSERT INTO `documents` (`id_doc`, `id_auteur`, `chemin`, `publication`, `lieu`, `statut`) VALUES
(1, 1, 'C:/wamp64/www/projet/doc1.bmp', '2012-04-10 22:12:00', 'Paris', 'public'),
(2, 3, 'C:/wamp64/www/projet/doc1.bmp', '2017-01-13 03:24:21', 'Creteil', 'private');

-- --------------------------------------------------------

--
-- Structure de la table `emplois`
--

DROP TABLE IF EXISTS `emplois`;
CREATE TABLE IF NOT EXISTS `emplois` (
  `titre` text NOT NULL,
  `durée` text NOT NULL,
  `description` text NOT NULL,
  `type` text NOT NULL,
  `id_emploi` int(11) NOT NULL,
  `specialite` text NOT NULL,
  PRIMARY KEY (`id_emploi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emplois`
--

INSERT INTO `emplois` (`titre`, `durée`, `description`, `type`, `id_emploi`, `specialite`) VALUES
('Stage informatique', '1 semaine', 'Venez faire un projet piscine au sein de l\'ECE Paris. Jetez vous à l\'eau!', 'CDD', 1, 'Informatique');

-- --------------------------------------------------------

--
-- Structure de la table `reactions`
--

DROP TABLE IF EXISTS `reactions`;
CREATE TABLE IF NOT EXISTS `reactions` (
  `id_doc` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `aime` text NOT NULL,
  `partage` text NOT NULL,
  `commentaire` text NOT NULL,
  PRIMARY KEY (`id_doc`,`id_utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reactions`
--

INSERT INTO `reactions` (`id_doc`, `id_utilisateur`, `aime`, `partage`, `commentaire`) VALUES
(1, 2, 'oui', 'non', ''),
(2, 3, 'non', 'non', 'Super!');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` text NOT NULL,
  `Prenom` text NOT NULL,
  `mail` text NOT NULL,
  `pseudo` text NOT NULL,
  `lastconnexion` date NOT NULL,
  `type` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `Nom`, `Prenom`, `mail`, `pseudo`, `lastconnexion`, `type`) VALUES
(1, 'Oulale', 'Awa', 'awa.oulale@edu.ece.fr', 'AOulale', '2018-04-29', 'Auteur'),
(2, 'Vermeulen', 'Eleonore', 'eleonore.vermeulen@edu.ece.fr', 'EVermeulen', '2018-03-04', 'Auteur'),
(3, 'Treuvelot', 'Magali', 'magali.treuvelot@edu.ece.fr', 'MTreuvelot', '2010-06-09', 'Auteur'),
(4, 'Segado', 'Jean-Pierre', 'jeanpierre.segado@edu.ece.fr', 'JSegado', '2018-04-19', 'Admin'),
(5, 'Rendler', 'Elizabeth', 'elizabeth.rendler@edu.ece.fr', 'ERendler', '2017-12-11', 'Admin'),
(6, 'Uhart-Jouet ', 'Cyprien', 'cyprien.uhartjouet@edu.ece.fr', 'CUhart', '2016-05-20', 'Auteur');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
