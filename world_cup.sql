-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : lefevrecuv001.mysql.db
-- Généré le :  mar. 19 juin 2018 à 12:23
-- Version du serveur :  5.6.39-log
-- Version de PHP :  7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lefevrecuv001`
--

-- --------------------------------------------------------

--
-- Structure de la table `cagnotte`
--

CREATE TABLE `cagnotte` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idPari` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `montant` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cotes`
--

CREATE TABLE `cotes` (
  `id` int(11) NOT NULL,
  `idGroupeCotes` int(11) NOT NULL,
  `idMatch` int(11) NOT NULL,
  `idTypePari` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL,
  `cote` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_match`
--

CREATE TABLE `groupe_match` (
  `id` int(11) NOT NULL,
  `groupe` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_match_detail`
--

CREATE TABLE `groupe_match_detail` (
  `id` int(11) NOT NULL,
  `idGroupeMatch` int(11) NOT NULL,
  `ordre` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_user`
--

CREATE TABLE `groupe_user` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `idUserMasster` int(11) NOT NULL,
  `private` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_user_detail`
--

CREATE TABLE `groupe_user_detail` (
  `id` int(11) NOT NULL,
  `idGroupeUser` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `match`
--

CREATE TABLE `match` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `teamA` int(11) NOT NULL,
  `teamB` int(11) NOT NULL,
  `idTypeMatch` int(11) NOT NULL,
  `idGroupeMatch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pari`
--

CREATE TABLE `pari` (
  `id` int(11) NOT NULL,
  `idMatch` int(11) NOT NULL,
  `idTypePari` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idCotes` int(11) NOT NULL,
  `montant` float NOT NULL,
  `gain` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `resultat`
--

CREATE TABLE `resultat` (
  `id` int(11) NOT NULL,
  `idMatch` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) CHARACTER SET latin1 NOT NULL,
  `iso` varchar(3) CHARACTER SET latin1 NOT NULL,
  `iso2` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `type_match`
--

CREATE TABLE `type_match` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `type_pari`
--

CREATE TABLE `type_pari` (
  `id` int(11) NOT NULL,
  `typePari` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) CHARACTER SET latin1 NOT NULL,
  `prenom` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pseudo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `avatar` int(2) NOT NULL,
  `mail` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `mailConfirm` tinyint(1) NOT NULL,
  `dateUpdate` datetime NOT NULL,
  `newsLetter` tinyint(1) NOT NULL,
  `accordRGPD` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `userAccordRGPD`
--

CREATE TABLE `userAccordRGPD` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `accord` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cagnotte`
--
ALTER TABLE `cagnotte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `date` (`date`),
  ADD KEY `idPari` (`idPari`);

--
-- Index pour la table `cotes`
--
ALTER TABLE `cotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMatch` (`idMatch`),
  ADD KEY `typePari` (`idTypePari`),
  ADD KEY `team` (`idTeam`),
  ADD KEY `date` (`date`),
  ADD KEY `idGroupeCotes` (`idGroupeCotes`);

--
-- Index pour la table `groupe_match`
--
ALTER TABLE `groupe_match`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupe_match_detail`
--
ALTER TABLE `groupe_match_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idGroupeMatch` (`idGroupeMatch`),
  ADD KEY `ordre` (`ordre`),
  ADD KEY `idTeam` (`idTeam`);

--
-- Index pour la table `groupe_user`
--
ALTER TABLE `groupe_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `idUserMasster` (`idUserMasster`);

--
-- Index pour la table `groupe_user_detail`
--
ALTER TABLE `groupe_user_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idGroupeUser` (`idGroupeUser`) USING BTREE,
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `match`
--
ALTER TABLE `match`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date` (`date`),
  ADD KEY `teamA` (`teamA`),
  ADD KEY `teamB` (`teamB`),
  ADD KEY `idTypeMatch` (`idTypeMatch`),
  ADD KEY `idGroupeMatch` (`idGroupeMatch`);

--
-- Index pour la table `pari`
--
ALTER TABLE `pari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMatch` (`idMatch`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idCotes` (`idCotes`),
  ADD KEY `idTypePari` (`idTypePari`);

--
-- Index pour la table `resultat`
--
ALTER TABLE `resultat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMatch` (`idMatch`),
  ADD KEY `idTeam` (`idTeam`);

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
-- Index pour la table `type_pari`
--
ALTER TABLE `type_pari`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pseudo` (`pseudo`),
  ADD KEY `password` (`password`),
  ADD KEY `mail` (`mail`),
  ADD KEY `mailConfirm` (`mailConfirm`),
  ADD KEY `dateUpdate` (`dateUpdate`),
  ADD KEY `newsLetter` (`newsLetter`);

--
-- Index pour la table `userAccordRGPD`
--
ALTER TABLE `userAccordRGPD`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cagnotte`
--
ALTER TABLE `cagnotte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT pour la table `cotes`
--
ALTER TABLE `cotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT pour la table `groupe_match`
--
ALTER TABLE `groupe_match`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT pour la table `groupe_match_detail`
--
ALTER TABLE `groupe_match_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT pour la table `groupe_user`
--
ALTER TABLE `groupe_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT pour la table `groupe_user_detail`
--
ALTER TABLE `groupe_user_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT pour la table `match`
--
ALTER TABLE `match`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT pour la table `pari`
--
ALTER TABLE `pari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT pour la table `resultat`
--
ALTER TABLE `resultat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT pour la table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT pour la table `type_match`
--
ALTER TABLE `type_match`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT pour la table `type_pari`
--
ALTER TABLE `type_pari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT pour la table `userAccordRGPD`
--
ALTER TABLE `userAccordRGPD`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
