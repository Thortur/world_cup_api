-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 05 Juin 2018 à 18:10
-- Version du serveur :  5.6.36
-- Version de PHP :  5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `cagnotte`
--

CREATE TABLE IF NOT EXISTS `cagnotte` (
`id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `montant` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cagnotte`
--

INSERT INTO `cagnotte` (`id`, `idUser`, `date`, `montant`) VALUES
(1, 1, '2018-06-04 15:20:53', 500),
(2, 2, '2018-06-05 15:30:38', 500),
(3, 3, '2018-06-05 15:36:42', 500);

-- --------------------------------------------------------

--
-- Structure de la table `cotes`
--

CREATE TABLE IF NOT EXISTS `cotes` (
`id` int(11) NOT NULL,
  `idMatch` int(11) NOT NULL,
  `idTypePari` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL,
  `cote` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cotes`
--

INSERT INTO `cotes` (`id`, `idMatch`, `idTypePari`, `idTeam`, `cote`, `date`) VALUES
(1, 1, 1, 1, 3, '2018-06-04 14:23:44'),
(2, 1, 1, 2, 9.3, '2018-06-04 14:23:44'),
(3, 1, 1, 0, 6.7, '2018-06-04 14:23:44'),
(4, 1, 1, 1, 4, '2018-06-04 12:34:30'),
(5, 1, 1, 2, 9.9, '2018-06-04 12:34:30'),
(6, 1, 1, 0, 3.2, '2018-06-04 12:34:30'),
(7, 1, 1, 1, 2, '2018-06-04 12:34:38'),
(8, 1, 1, 2, 7, '2018-06-04 12:34:38'),
(9, 1, 1, 0, 5.9, '2018-06-04 12:34:38');

-- --------------------------------------------------------

--
-- Structure de la table `groupe_match`
--

CREATE TABLE IF NOT EXISTS `groupe_match` (
`id` int(11) NOT NULL,
  `groupe` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupe_match`
--

INSERT INTO `groupe_match` (`id`, `groupe`) VALUES
(1, 'Groupe A'),
(2, 'Groupe B'),
(3, 'Groupe C'),
(4, 'Groupe D'),
(5, 'Groupe E'),
(6, 'Groupe F'),
(7, 'Groupe G'),
(8, 'Groupe H');

-- --------------------------------------------------------

--
-- Structure de la table `groupe_match_detail`
--

CREATE TABLE IF NOT EXISTS `groupe_match_detail` (
`id` int(11) NOT NULL,
  `idGroupeMatch` int(11) NOT NULL,
  `ordre` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupe_match_detail`
--

INSERT INTO `groupe_match_detail` (`id`, `idGroupeMatch`, `ordre`, `idTeam`) VALUES
(1, 1, 1, 21),
(2, 1, 2, 6),
(3, 1, 3, 1),
(4, 1, 4, 32),
(5, 2, 1, 20),
(6, 2, 2, 16),
(7, 2, 3, 2),
(8, 2, 4, 10),
(9, 3, 1, 17),
(10, 3, 2, 7),
(11, 3, 3, 31),
(12, 3, 4, 15),
(13, 4, 1, 28),
(14, 4, 2, 18),
(15, 4, 3, 14),
(16, 4, 4, 3),
(17, 5, 1, 29),
(18, 5, 2, 24),
(19, 5, 3, 25),
(20, 5, 4, 22),
(21, 6, 1, 11),
(22, 6, 2, 26),
(23, 6, 3, 23),
(24, 6, 4, 9),
(25, 7, 1, 13),
(26, 7, 2, 27),
(27, 7, 3, 5),
(28, 7, 4, 12),
(29, 8, 1, 19),
(30, 8, 2, 4),
(31, 8, 3, 30),
(32, 8, 4, 8);

-- --------------------------------------------------------

--
-- Structure de la table `match`
--

CREATE TABLE IF NOT EXISTS `match` (
`id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `teamA` int(11) NOT NULL,
  `teamB` int(11) NOT NULL,
  `idTypeMatch` int(11) NOT NULL,
  `idGroupeMatch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `match`
--

INSERT INTO `match` (`id`, `date`, `teamA`, `teamB`, `idTypeMatch`, `idGroupeMatch`) VALUES
(1, '2018-06-14 18:00:00', 21, 6, 1, 1),
(2, '2018-06-15 17:00:00', 1, 32, 1, 1),
(3, '2018-06-15 18:00:00', 2, 10, 1, 2),
(4, '2018-06-15 21:00:00', 20, 16, 1, 2),
(5, '2018-06-16 13:00:00', 17, 7, 1, 3),
(6, '2018-06-16 16:00:00', 28, 18, 1, 4),
(7, '2018-06-16 19:00:00', 31, 15, 1, 3),
(8, '2018-06-16 21:00:00', 14, 3, 1, 4),
(9, '2018-06-17 16:00:00', 25, 22, 1, 5),
(10, '2018-06-17 18:00:00', 11, 26, 1, 6),
(11, '2018-06-17 21:00:00', 29, 24, 1, 5),
(12, '2018-06-18 15:00:00', 23, 9, 1, 6),
(13, '2018-06-18 18:00:00', 13, 27, 1, 7),
(14, '2018-06-18 21:00:00', 5, 12, 1, 7),
(15, '2018-06-19 15:00:00', 30, 8, 1, 8),
(16, '2018-06-19 18:00:00', 19, 4, 1, 8),
(17, '2018-06-19 21:00:00', 21, 1, 1, 1),
(18, '2018-06-20 15:00:00', 20, 2, 1, 2),
(19, '2018-06-20 18:00:00', 32, 6, 1, 1),
(20, '2018-06-20 21:00:00', 10, 16, 1, 2),
(21, '2018-06-21 16:00:00', 15, 7, 1, 3),
(22, '2018-06-21 20:00:00', 17, 31, 1, 3),
(23, '2018-06-21 21:00:00', 28, 14, 1, 4),
(24, '2018-06-22 15:00:00', 29, 25, 1, 5),
(25, '2018-06-22 18:00:00', 3, 18, 1, 4),
(26, '2018-06-22 20:00:00', 22, 24, 1, 5),
(27, '2018-06-23 15:00:00', 13, 5, 1, 7),
(28, '2018-06-23 18:00:00', 9, 26, 1, 6),
(29, '2018-06-23 21:00:00', 11, 23, 1, 6),
(30, '2018-06-24 15:00:00', 12, 27, 1, 7),
(31, '2018-06-24 20:00:00', 8, 4, 1, 8),
(32, '2018-06-24 21:00:00', 19, 30, 1, 8),
(33, '2018-06-25 18:00:00', 21, 32, 1, 1),
(34, '2018-06-25 17:00:00', 6, 1, 1, 1),
(35, '2018-06-25 20:00:00', 16, 2, 1, 2),
(36, '2018-06-25 21:00:00', 10, 20, 1, 2),
(37, '2018-06-26 17:00:00', 7, 31, 1, 3),
(38, '2018-06-26 17:00:00', 15, 17, 1, 3),
(39, '2018-06-26 21:00:00', 3, 28, 1, 4),
(40, '2018-06-26 21:00:00', 18, 14, 1, 4),
(41, '2018-06-27 17:00:00', 9, 11, 1, 6),
(42, '2018-06-27 19:00:00', 26, 23, 1, 6),
(43, '2018-06-27 21:00:00', 22, 29, 1, 5),
(44, '2018-06-27 21:00:00', 24, 25, 1, 5),
(45, '2018-06-28 17:00:00', 8, 19, 1, 8),
(46, '2018-06-28 18:00:00', 4, 30, 1, 8),
(47, '2018-06-28 21:00:00', 27, 5, 1, 7),
(48, '2018-06-28 20:00:00', 12, 13, 1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `resultat`
--

CREATE TABLE IF NOT EXISTS `resultat` (
`id` int(11) NOT NULL,
  `idMatch` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
`id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `iso` varchar(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `team`
--

INSERT INTO `team` (`id`, `nom`, `iso`) VALUES
(1, 'Egypte', 'egy'),
(2, 'Maroc', 'mar'),
(3, 'Nigeria', 'nga'),
(4, 'Sénégal', 'sen'),
(5, 'Tunisie', 'tun'),
(6, 'Arabie Saoudite', 'ksa'),
(7, 'Australie', 'aus'),
(8, 'Japon', 'jpn'),
(9, 'République de Corée', 'kor'),
(10, 'Iran', 'irn'),
(11, 'Allemagne', 'ger'),
(12, 'Angleterre', 'eng'),
(13, 'Belgique', 'bel'),
(14, 'Croatie', 'cro'),
(15, 'Danemark', 'den'),
(16, 'Espagne', 'esp'),
(17, 'France', 'fra'),
(18, 'Islande', 'isl'),
(19, 'Pologne', 'pol'),
(20, 'Portugal', 'por'),
(21, 'Russie', 'rus'),
(22, 'Serbie', 'srb'),
(23, 'Suède', 'swe'),
(24, 'Suisse', 'sui'),
(25, 'Costa Rica', 'crc'),
(26, 'Mexique', 'mex'),
(27, 'Panama', 'pan'),
(28, 'Argentine', 'arg'),
(29, 'Brésil', 'bra'),
(30, 'Colombie', 'col'),
(31, 'Pérou', 'per'),
(32, 'Uruguay', 'uru');

-- --------------------------------------------------------

--
-- Structure de la table `type_match`
--

CREATE TABLE IF NOT EXISTS `type_match` (
`id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_match`
--

INSERT INTO `type_match` (`id`, `nom`) VALUES
(1, 'Groupe'),
(2, 'Huitièmes de finale'),
(3, 'Quarts de finale'),
(4, 'Demi-finales'),
(5, 'Match pour la troisième place'),
(6, 'Finale');

-- --------------------------------------------------------

--
-- Structure de la table `type_paris`
--

CREATE TABLE IF NOT EXISTS `type_paris` (
`id` int(11) NOT NULL,
  `typeParis` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_paris`
--

INSERT INTO `type_paris` (`id`, `typeParis`) VALUES
(1, 'victoire'),
(2, 'nb but');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `pseudo`, `mail`, `password`) VALUES
(1, 'LefÃ¨vre', 'Christophe', 'Thortur', 'lefevre.christophe@outlook.com', '5vRMEBGU');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cagnotte`
--
ALTER TABLE `cagnotte`
 ADD PRIMARY KEY (`id`), ADD KEY `idUser` (`idUser`), ADD KEY `date` (`date`);

--
-- Index pour la table `cotes`
--
ALTER TABLE `cotes`
 ADD PRIMARY KEY (`id`), ADD KEY `idMatch` (`idMatch`), ADD KEY `typePari` (`idTypePari`), ADD KEY `team` (`idTeam`), ADD KEY `date` (`date`);

--
-- Index pour la table `groupe_match`
--
ALTER TABLE `groupe_match`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupe_match_detail`
--
ALTER TABLE `groupe_match_detail`
 ADD PRIMARY KEY (`id`), ADD KEY `idGroupeMatch` (`idGroupeMatch`), ADD KEY `ordre` (`ordre`), ADD KEY `idTeam` (`idTeam`);

--
-- Index pour la table `match`
--
ALTER TABLE `match`
 ADD PRIMARY KEY (`id`), ADD KEY `teamA` (`teamA`), ADD KEY `teamB` (`teamB`), ADD KEY `date` (`date`), ADD KEY `idTypeMatch` (`idTypeMatch`);

--
-- Index pour la table `resultat`
--
ALTER TABLE `resultat`
 ADD PRIMARY KEY (`id`), ADD KEY `idMatch` (`idMatch`), ADD KEY `idTeam` (`idTeam`);

--
-- Index pour la table `team`
--
ALTER TABLE `team`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_match`
--
ALTER TABLE `type_match`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_paris`
--
ALTER TABLE `type_paris`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD KEY `pseudo` (`pseudo`), ADD KEY `password` (`password`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cagnotte`
--
ALTER TABLE `cagnotte`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `cotes`
--
ALTER TABLE `cotes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `groupe_match`
--
ALTER TABLE `groupe_match`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `groupe_match_detail`
--
ALTER TABLE `groupe_match_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `match`
--
ALTER TABLE `match`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `resultat`
--
ALTER TABLE `resultat`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `team`
--
ALTER TABLE `team`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `type_match`
--
ALTER TABLE `type_match`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `type_paris`
--
ALTER TABLE `type_paris`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
