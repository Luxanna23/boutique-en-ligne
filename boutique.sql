-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 17 mai 2023 à 12:15
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

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
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `numero` int NOT NULL,
  `rue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `codePostal` int NOT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id`, `id_user`, `numero`, `rue`, `codePostal`, `ville`) VALUES
(1, 1, 1, 'a', 1, 'a'),
(2, 2, 1, 'z', 1, 'z');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prix` int NOT NULL,
  `date` date NOT NULL,
  `id_categorie` int NOT NULL,
  `quantite` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `description`, `prix`, `date`, `id_categorie`, `quantite`, `image`) VALUES
(9, 'Boucles d\'oreilles Jasmin', 'Boucles d\'oreilles longues doré à l\'or fin, formées de différents motifs en nacre.\r\nRavissantes boucles à l\'aspect sobre et efficace qui saura faire son effet.\r\n\r\nLongueur : 65mm\r\nPoids d\'une boucle : 4,16g', 55, '2023-05-16', 7, 0, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SEC18315-01SEL-P_380x443_crop_center.jpg?v=1667234371'),
(10, 'Boucles d\'oreilles Sunrise', 'Boucles d\'oreilles en acier doré à l\'or fin présentant un cercle à demi coloré.\r\nNous conseillons de les porter en accumulation afin de rehausser le style.\r\nDéclinées en bracelet, collier et bague\r\nDiamètre : 12mm\r\nPoids de la boucle : 0,77g', 30, '2023-05-16', 10, 0, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SEM19703-01TQB-P1_380x443_crop_center.jpg?v=1678878425'),
(11, 'Boucles d\'oreilles Lilith', 'Boucles d\'oreilles en acier doré à l\'or fin représentant un cercle martelé à l\'image d\'un soleil.\r\nL\'effet martelé de ce bijou amène un air ethnique à votre tenue. Idéal si vous souhaitez élever votre tenue sans effort.\r\nDiamètre : 28mm\r\nPoids: 2,06g', 35, '2023-05-09', 11, 0, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SEM19976-01UNI-NM_380x443_crop_center.jpg?v=1677841640'),
(12, 'Earcuff Chanty', 'Un earcuff ajustable en acier uni ou doré à l’or fin qu’il suffit simplement d’enfiler sur le l’oreille.\r\nMinimaliste et tellement stylé, cet accessoire se porte aussi bien seul qu’en accumulation avec d’autres boucles.\r\nÀ l’unité, pour les mixer à votre ', 20, '2023-02-08', 8, 0, 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/earcuff-chanty-acier-dore-portees_380x443_crop_center.jpg?v=1654079288');

-- --------------------------------------------------------

--
-- Structure de la table `categart`
--

DROP TABLE IF EXISTS `categart`;
CREATE TABLE IF NOT EXISTS `categart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_article` int NOT NULL,
  `id_categorie` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_parent` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `titre`, `image`, `id_parent`) VALUES
(1, 'Nouveautés', 'https://www.zoshacollection.com/blog/wp-content/uploads/2022/08/bijoux-acier-inoxydable-1-1024x1024.jpg', NULL),
(2, 'Bracelets', 'https://piwii.fr/wp-content/uploads/2018/02/Capture-d%E2%80%99e%CC%81cran-2020-01-10-a%CC%80-14.59.01.png', NULL),
(3, 'Boucles d\'oreilles', 'https://cdn.shopify.com/s/files/1/2364/4415/products/IMG_9208.heic?v=1680018166', NULL),
(4, 'Colliers', 'https://cdn.shopify.com/s/files/1/0509/4116/5720/products/colliers-elegance-or-jardin-des-bijoux-398.webp?v=1683811549&width=934', NULL),
(5, 'Bagues', 'https://cdn.shopify.com/s/files/1/0272/2489/9683/products/bague-rubis-fines-989A0237_700x.jpg?v=1634130923', NULL),
(6, 'Montres', 'https://www.histoiredor.com/dw/image/v2/BCQS_PRD/on/demandware.static/-/Sites-THOM_CATALOG/default/dw345e35f4/images/HIMFJQC712-model0.jpg?sw=750&sh=750', NULL),
(7, 'Boucles longues', 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SEL19973-01GRN-NM_380x442_crop_center.jpg?v=1679327540', 3),
(8, 'Earcuffs', 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/earcuff-randa-acier-dore-1-portees_380x443_crop_center.jpg?v=1654079953', 3),
(10, 'Mini boucles', 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SES20140-01TQB-P2_380x443_crop_center.jpg?v=1684148052', 3),
(11, 'Boucles medium', 'https://cdn.shopify.com/s/files/1/0602/7975/0845/products/SEC18556-01UNI-P_380x443_crop_center.jpg?v=1669624528', 3);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_article` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `usernewsletter`
--

DROP TABLE IF EXISTS `usernewsletter`;
CREATE TABLE IF NOT EXISTS `usernewsletter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `date_subbed` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `avatar`) VALUES
(4, 'toto@toto', '$2y$10$46Arck0Y.tYTGJ7IUR6rNezORV84MryqzSKGSnzM0XUPKS6/jpRDW', 'toto', 'toto', 'avatars/default.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
