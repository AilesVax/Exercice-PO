-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 07 déc. 2025 à 19:58
-- Version du serveur : 8.4.3
-- Version de PHP : 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `parc_attraction`
--

-- --------------------------------------------------------

--
-- Structure de la table `activities`
--

CREATE TABLE `activities` (
  `id` int NOT NULL,
  `nom` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `type_id` int NOT NULL,
  `places_disponibles` int NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `datetime_debut` datetime NOT NULL,
  `duree` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `activities`
--

INSERT INTO `activities` (`id`, `nom`, `type_id`, `places_disponibles`, `description`, `datetime_debut`, `duree`) VALUES
(1, 'Football', 1, 20, 'Match amical de football', '2025-01-20 18:00:00', 120),
(2, 'Yoga', 1, 15, 'Séance de yoga pour débutants', '2025-01-22 09:00:00', 60),
(3, 'Visite musée', 2, 30, 'Sortie culturelle au musée national', '2025-02-01 14:00:00', 90),
(4, 'Cinéma plein air', 3, 50, 'Projection de film en plein air', '2025-02-05 20:30:00', 120),
(5, 'Concert', 4, 100, 'Concert live en soirée', '2025-03-10 21:00:00', 180),
(6, 'Basketball', 1, 12, 'Match de basketball', '2025-01-25 17:30:00', 90),
(7, 'Atelier Peinture', 2, 10, 'Atelier artistique pour tous niveaux', '2025-02-15 10:00:00', 120);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `activite_id` int NOT NULL,
  `date_reservation` datetime DEFAULT CURRENT_TIMESTAMP,
  `etat` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `activite_id`, `date_reservation`, `etat`) VALUES
(1, 1, 1, '2025-01-10 12:30:00', 0),
(2, 2, 3, '2025-01-12 09:45:00', 0),
(3, 1, 2, '2025-01-15 16:10:00', 0),
(4, 4, 5, '2025-01-20 11:50:00', 1),
(5, 5, 4, '2025-01-22 13:15:00', 1),
(6, 2, 2, '2025-01-23 14:00:00', 0),
(7, 3, 1, '2025-01-18 10:00:00', 1),
(12, 1, 1, '2025-12-06 22:41:47', 1),
(13, 1, 5, '2025-12-06 22:42:35', 1),
(14, 2, 1, '2025-12-06 22:47:20', 1),
(15, 10, 3, '2025-12-07 12:29:56', 0),
(16, 10, 4, '2025-12-07 12:45:08', 0),
(17, 10, 1, '2025-12-07 17:59:53', 1),
(18, 10, 3, '2025-12-07 18:00:05', 1),
(19, 14, 3, '2025-12-07 18:39:07', 0),
(20, 14, 2, '2025-12-07 18:44:28', 1),
(21, 14, 2, '2025-12-07 18:44:33', 1),
(22, 14, 1, '2025-12-07 18:44:40', 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_activite`
--

CREATE TABLE `type_activite` (
  `id` int NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_activite`
--

INSERT INTO `type_activite` (`id`, `nom`) VALUES
(1, 'Sport'),
(2, 'Culture'),
(3, 'Loisir'),
(4, 'Événement');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `motdepasse` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_general_ci DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `prenom`, `nom`, `email`, `motdepasse`, `role`) VALUES
(1, 'Lucas', 'Martin', 'lucas.martin@example.com', 'mdp123', 'user'),
(2, 'Sarah', 'Dupont', 'sarah.dupont@example.com', 'azerty', 'user'),
(3, 'Admin', 'Root', 'admin@example.com', 'adminpass', 'admin'),
(4, 'Julie', 'Bernard', 'julie.bernard@example.com', 'secret123', 'user'),
(5, 'Tom', 'Leroy', 'tom.leroy@example.com', 'toto', 'user'),
(10, 'hudgfdhv', 'jkdnjfn', 'josnkg@fnbdj', 'Raph', 'user'),
(11, 'cd', 'dcdc', 'jhd@hdjd', 'ded', 'user'),
(13, 'eded', 'knkn', 'cdcdc@jdk', 'lol', 'user'),
(14, 'raph', 'vax', 'raph@vax', 'raph', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `activite_id` (`activite_id`);

--
-- Index pour la table `type_activite`
--
ALTER TABLE `type_activite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `type_activite`
--
ALTER TABLE `type_activite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type_activite` (`id`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`activite_id`) REFERENCES `activities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
