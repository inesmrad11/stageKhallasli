-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 12 août 2024 à 15:48
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `khallasli_crm`
--

-- --------------------------------------------------------

--
-- Structure de la table `prospects`
--

CREATE TABLE `prospects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ;

--
-- Déchargement des données de la table `prospects`
--

INSERT INTO `prospects` (`id`, `name`, `email`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Sara Baccouche', 'sara.baccouche@gmail.com', '23456789', '456 Avenue Habib Bourguiba, Sfax, Tunisie', 'Intéressée', '2024-08-09 11:01:33', '2024-08-09 11:01:33'),
(3, 'Khaled Mbarek', 'khaled.mbarek@gmail.com', '34567890', '789 Boulevard de la Liberté, Sousse, Tunisie', 'Non contacté', '2024-08-09 11:01:33', '2024-08-09 11:01:33'),
(4, 'Nadia Bouazizi', 'nadia.bouazizi@gmail.com', '45678901', '101 Rue de la République, Bizerte, Tunisie', 'En attente', '2024-08-09 11:01:33', '2024-08-09 11:01:33'),
(5, 'Mohamed Jallouli', 'mohamed.jallouli@gmail.com', '56789012', '202 Avenue de l’Indépendance, Kairouan, Tunisie', 'Contacté', '2024-08-09 11:01:33', '2024-08-09 11:01:33');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','manager','employee') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed Ben Ali', '$2y$10$oUnBbJ5NGW5yW4Rr3ZJbvuemfoJjFZdEzInF6C/iQux5H2Cyh4WYG', 'admin.tunis@gmail.com', 'admin', '2024-08-06 11:55:28', '2024-08-06 12:39:29');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `prospects`
--
ALTER TABLE `prospects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `prospects`
--
ALTER TABLE `prospects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
