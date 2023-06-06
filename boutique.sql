-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 06 juin 2023 à 07:35
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `categart`
--

CREATE TABLE `categart` (
  `id` int NOT NULL,
  `id_article` int NOT NULL,
  `id_souscat` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categart`
--

INSERT INTO `categart` (`id`, `id_article`, `id_souscat`) VALUES
(1, 9, 1),
(2, 10, 3),
(3, 11, 4),
(4, 12, 2),
(5, 13, 5),
(6, 14, 5),
(7, 15, 5),
(8, 16, 6),
(9, 17, 6),
(10, 18, 7),
(11, 19, 7),
(12, 20, 8),
(13, 21, 9),
(14, 22, 9),
(15, 23, 9),
(16, 24, 10),
(17, 25, 10),
(18, 26, 11),
(19, 27, 11),
(20, 29, 12),
(21, 28, 11),
(22, 30, 12),
(23, 31, 12);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categart`
--
ALTER TABLE `categart`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categart`
--
ALTER TABLE `categart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
