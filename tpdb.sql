-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 12 jan. 2021 à 22:45
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP :  7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tpdb`
--
CREATE DATABASE IF NOT EXISTS `tpdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tpdb`;

-- --------------------------------------------------------

--
-- Structure de la table `Article`
--

CREATE TABLE `Article` (
  `idArticle` int(11) NOT NULL,
  `nomArticle` varchar(255) NOT NULL,
  `qteArticle` int(11) NOT NULL,
  `prixArticle` int(11) NOT NULL,
  `dateEnreg` date NOT NULL DEFAULT current_timestamp(),
  `categorie` int(11) NOT NULL,
  `imageArticle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Article`
--

INSERT INTO `Article` (`idArticle`, `nomArticle`, `qteArticle`, `prixArticle`, `dateEnreg`, `categorie`, `imageArticle`) VALUES
(1, 'Sac', 500, 5000, '2021-01-12', 18, '../images/ProduitImg/Sac'),
(2, 'Avanture ambigue', 55, 2500, '2021-01-12', 17, '../images/ProduitImg/Avanture ambigue'),
(3, 'Avengers', 50, 145000, '2021-01-12', 15, '../images/ProduitImg/Avengers'),
(5, 'iPHONE', 897, 50000, '2021-01-12', 17, '../images/ProduitImg/iPHONE'),
(6, 'Ecran', 55, 57000, '2021-01-12', 17, '../images/ProduitImg/Ecran');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `idCateg` int(11) NOT NULL,
  `nomCateg` varchar(255) NOT NULL,
  `dateEnreg` date NOT NULL DEFAULT current_timestamp(),
  `favoris` tinyint(1) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`idCateg`, `nomCateg`, `dateEnreg`, `favoris`, `image`) VALUES
(12, 'IA', '2021-01-11', 1, '../images/CategorieImg/IA'),
(15, 'Films', '2021-01-11', 1, '../images/CategorieImg/Films'),
(17, 'Autre', '2021-01-12', 0, '../images/CategorieImg/Autre'),
(18, 'Mode', '2021-01-12', 1, '../images/CategorieImg/Mode'),
(19, 'Hacking', '2021-01-12', 1, '../images/CategorieImg/Hacking'),
(20, 'Programmeur', '2021-01-12', 0, '../images/CategorieImg/Programmeur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Article`
--
ALTER TABLE `Article`
  ADD PRIMARY KEY (`idArticle`),
  ADD KEY `categorie` (`categorie`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCateg`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Article`
--
ALTER TABLE `Article`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `idCateg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Article`
--
ALTER TABLE `Article`
  ADD CONSTRAINT `Article_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categories` (`idCateg`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
