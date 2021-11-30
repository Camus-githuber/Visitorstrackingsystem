-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 06 oct. 2021 à 09:57
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bortech_visitors_record`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrators`
--

CREATE TABLE `administrators` (
  `Id` int(11) NOT NULL,
  `Name` text NOT NULL,
  `SSN` text NOT NULL,
  `PhoneNumber` int(11) NOT NULL,
  `Gender` text NOT NULL,
  `Dob` date NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Passwords` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `administrators`
--

INSERT INTO `administrators` (`Id`, `Name`, `SSN`, `PhoneNumber`, `Gender`, `Dob`, `Email`, `Passwords`) VALUES
(1, 'camus', '976587358', 187684168, 'M', '2021-09-07', 'camusbordas2@gmail.com', 'dbb644f29b75130bed1b8767aa2256d6'),
(2, 'dexter', '675465476', 674463543, 'M', '2021-10-15', 'camusbordas3@gmail.com', '1240f76a415ccc39cddad31a3b56c3c2');

-- --------------------------------------------------------

--
-- Structure de la table `visitors`
--

CREATE TABLE `visitors` (
  `Id` int(11) NOT NULL,
  `Name` text NOT NULL,
  `SSN` int(20) NOT NULL,
  `PhoneNumber` int(15) NOT NULL,
  `Gender` text NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `visitors`
--

INSERT INTO `visitors` (`Id`, `Name`, `SSN`, `PhoneNumber`, `Gender`, `Email`) VALUES
(1, 'mereline', 675765464, 465464667, 'F', 'mere@yahoo.fr');

-- --------------------------------------------------------

--
-- Structure de la table `visitorstrack`
--

CREATE TABLE `visitorstrack` (
  `Id` int(11) NOT NULL,
  `VisitorId` int(11) NOT NULL,
  `EntryTime` time NOT NULL,
  `ExitTime` time NOT NULL,
  `Dates` date NOT NULL,
  `Reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `visitorstrack`
--

INSERT INTO `visitorstrack` (`Id`, `VisitorId`, `EntryTime`, `ExitTime`, `Dates`, `Reason`) VALUES
(1, 1, '09:51:35', '09:51:43', '2021-10-06', 'edrdc y yt y 7tgugi uyuiyuigug');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `PhoneNumber` (`PhoneNumber`);

--
-- Index pour la table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Index pour la table `visitorstrack`
--
ALTER TABLE `visitorstrack`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `VisitorId` (`VisitorId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `visitorstrack`
--
ALTER TABLE `visitorstrack`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `visitorstrack`
--
ALTER TABLE `visitorstrack`
  ADD CONSTRAINT `visitorstrack_ibfk_1` FOREIGN KEY (`VisitorId`) REFERENCES `visitors` (`Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
