-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mer. 24 sep. 2025 à 11:34
-- Version du serveur : 8.0.43
-- Version de PHP : 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `leboncoin`
--
CREATE DATABASE IF NOT EXISTS `leboncoin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `leboncoin`;

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE IF NOT EXISTS `annonces` (
  `a_id` int NOT NULL AUTO_INCREMENT,
  `a_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `a_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `a_price` decimal(10,2) NOT NULL,
  `a_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `a_publication` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_id` int NOT NULL,
  PRIMARY KEY (`a_id`),
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`a_id`, `a_title`, `a_description`, `a_price`, `a_picture`, `a_publication`, `u_id`) VALUES
(1, 'coco', 'noix de coco', 12.00, NULL, '2025-09-17 13:55:00', 1),
(3, 'Bambu', 'Bambu pas cher', 234.00, NULL, '2025-09-22 06:42:19', 1),
(4, 'Ici mon annonce', 'C une annonce', 34.00, NULL, '2025-09-22 09:32:23', 3),
(5, 'test', 'ceci est un test', 45.00, NULL, '2025-09-22 09:44:31', 3),
(6, 'Zoro', 'Zoro', 67.00, '68d1399793ec2.png', '2025-09-22 11:57:11', 3),
(7, 'azeaze', 'azeazeaze', 12.00, NULL, '2025-09-22 11:59:47', 3),
(8, 'zae', 'aze', 12.00, NULL, '2025-09-22 13:09:55', 3),
(9, 'Made by Akasa', 'Made by Me', 34.00, '68d19019af767.png', '2025-09-22 18:06:17', 1),
(10, 'Premier POST', 'Super POST', 34.00, '68d2564acbfd1.png', '2025-09-23 08:11:54', 4),
(11, 'Bim Bam Boum', 'Badabooooummmmm', 45.00, '68d2976258cd6.png', '2025-09-23 12:49:38', 4);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE IF NOT EXISTS `favoris` (
  `favori_id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int NOT NULL,
  `annonce_id` int NOT NULL,
  UNIQUE KEY `uniq_user_annonce` (`user_id`,`annonce_id`),
  KEY `fk_favoris_annonce` (`annonce_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`user_id`, `annonce_id`) VALUES
(3, 9),
(3, 11);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int NOT NULL AUTO_INCREMENT,
  `u_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `u_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `u_username` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `u_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_email` (`u_email`),
  UNIQUE KEY `u_username` (`u_username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`u_id`, `u_email`, `u_password`, `u_username`, `u_inscription`) VALUES
(1, 'akasa@mail.fr', '$2y$10$zNfOeVlpNkUjNSzttMMBVeOYDteLG3bvnzHt2s1ZQogPwWsBuvwTq', 'akasa', '2025-09-16 14:39:32'),
(2, 'zenitsu@mail.fr', '$2y$10$DtdNNW3mjvw3.GvObnigPe4pGZUbiTf.os255eEAPglV4kgQT2rSm', 'zenitsu', '2025-09-17 11:24:28'),
(3, 'pseudo@mail.fr', '$2y$10$9.b1ua86Ew7BFq2qfsCtXeAH.66NfkhBbLqP0hKIbGeVcP92djHf2', 'pseudo', '2025-09-22 09:27:51'),
(4, 'john@mail.fr', '$2y$10$tUgx0f.c/SNYbmPkLIkHceR8Y.3gKGv6xIhu9fc1gRq/g8nrE78hO', 'john', '2025-09-23 08:10:25');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `fk_favoris_annonce` FOREIGN KEY (`annonce_id`) REFERENCES `annonces` (`a_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_favoris_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
