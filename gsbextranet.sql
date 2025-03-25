-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 25 mars 2025 à 08:27
-- Version du serveur : 10.3.39-MariaDB-0+deb10u1
-- Version de PHP : 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gsbextranet`
--

-- --------------------------------------------------------

--
-- Structure de la table `historiqueconnexion`
--

CREATE TABLE `historiqueconnexion` (
  `idMedecin` int(11) NOT NULL,
  `dateDebutLog` datetime NOT NULL,
  `dateFinLog` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `historiqueconnexion`
--

INSERT INTO `historiqueconnexion` (`idMedecin`, `dateDebutLog`, `dateFinLog`) VALUES
(89, '2024-11-13 15:24:32', '2024-11-13 15:24:32'),
(89, '2024-11-13 15:24:45', '2024-11-14 13:27:30'),
(89, '2024-11-14 13:26:01', '2024-11-14 13:27:30'),
(89, '2024-11-14 13:26:17', '2024-11-14 13:27:30'),
(89, '2024-11-14 13:26:28', '2024-11-14 13:27:30'),
(89, '2024-11-14 13:27:35', '2024-11-14 13:52:06'),
(89, '2024-11-14 13:48:15', '2024-11-14 13:52:06'),
(89, '2024-11-14 13:59:42', '2024-11-14 14:09:44'),
(89, '2024-11-14 14:00:15', '2024-11-14 14:09:44'),
(89, '2024-11-14 14:09:50', '2024-11-14 14:46:38'),
(89, '2024-11-14 14:14:12', '2024-11-14 14:46:38'),
(89, '2024-11-14 14:44:41', '2024-11-14 14:46:38'),
(89, '2024-11-14 14:46:47', NULL),
(89, '2024-11-14 16:22:32', NULL),
(89, '2024-11-15 16:03:21', NULL),
(91, '2024-11-20 14:52:49', '2024-11-20 14:52:49'),
(92, '2024-11-20 14:53:32', '2024-11-20 14:53:32'),
(93, '2024-11-20 15:00:32', '2024-11-20 15:00:32'),
(93, '2024-11-20 15:00:55', '2024-11-20 15:00:55'),
(93, '2024-11-20 15:06:08', '2024-11-20 15:06:08'),
(96, '2024-11-20 15:35:17', '2024-11-20 15:35:17'),
(98, '2024-11-29 16:33:18', '2024-11-29 16:33:18'),
(98, '2024-11-29 16:33:36', '2024-11-29 16:39:17'),
(98, '2024-11-29 16:40:10', '2024-11-29 16:40:21'),
(101, '2025-03-04 11:23:06', '2025-03-04 11:23:06'),
(101, '2025-03-04 11:23:30', '2025-03-04 11:26:13'),
(101, '2025-03-04 11:26:22', '2025-03-04 11:26:36'),
(101, '2025-03-04 11:26:44', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(11) NOT NULL,
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `maintenance`
--

INSERT INTO `maintenance` (`id`, `maintenance_mode`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

CREATE TABLE `medecin` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `motDePasse` varchar(60) DEFAULT NULL,
  `dateCreation` datetime DEFAULT NULL,
  `rpps` varchar(10) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `dateConsentement` date DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`id`, `nom`, `prenom`, `telephone`, `mail`, `motDePasse`, `dateCreation`, `rpps`, `token`, `dateConsentement`, `role_id`, `permission_id`) VALUES
(98, 'dsqdqs', 'dqd', NULL, 'YmF2MmNpd0RXd2dVWGdtb1FlRkh6ZGFKMVExMUZURG93N3Q5NVpvWlJIST0=', '$2y$10$435TZVLKaOsuhWqFxAZ5T.C7kt.DRGyAY2vV07AAslvv.JOkzN2VK', '2024-11-29 16:33:18', NULL, NULL, '2024-11-29', 1, 3),
(101, 'Kondryc', 'Eliot', NULL, 'MzdMU2dWT2ZCNUFaamZ3TXZ2TlpPWEc2UE93UTVmNmpOUUlWL3lOSFdEYz0=', '$2y$10$cmIjIYVSTDhXQdtRDFWmuera4CJlRkkLOPJR8IE5drWJ6cQWFDACG', '2025-03-04 11:23:06', NULL, NULL, '2025-03-04', NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `medecinproduit`
--

CREATE TABLE `medecinproduit` (
  `idMedecin` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Heure` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `medecinproduit`
--

INSERT INTO `medecinproduit` (`idMedecin`, `idProduit`, `Date`, `Heure`) VALUES
(3, 1, '2023-04-01', '09:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `Permissions`
--

CREATE TABLE `Permissions` (
  `id` int(11) NOT NULL,
  `permission_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Permissions`
--

INSERT INTO `Permissions` (`id`, `permission_name`) VALUES
(1, 'user'),
(2, 'chef de produit'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `objectif` varchar(255) NOT NULL,
  `information` text NOT NULL,
  `effetIndesirable` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `objectif`, `information`, `effetIndesirable`) VALUES
(2, 'Ibuprofènee', 'Soulager la douleur et réduire l’inflammation', 'L’ibuprofène est un anti-inflammatoire non stéroïdien (AINS) utilisé pour traiter la douleur et l’inflammation.', 'Problèmes gastro-intestinaux, tels que des douleurs abdominales ou des nausées.'),
(3, 'Amoxicilline', 'Traiter les infections bactériennes', 'L’amoxicilline est un antibiotique utilisé pour traiter diverses infections causées par des bactéries.', 'Réactions allergiques, diarrhée.'),
(4, 'Aspirine', 'Soulager la douleur, réduire la fièvre et l’inflammation', 'L’aspirine est un AINS utilisé pour traiter la douleur, réduire la fièvre et l’inflammation.', 'Irritation de l’estomac, risque de saignement.'),
(54, 'ddfd', 'fddffdfdfd', 'fddffddffdfd', 'dfdffdfd');

-- --------------------------------------------------------

--
-- Structure de la table `produit_operations_log`
--

CREATE TABLE `produit_operations_log` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `operation_type` enum('CREATE','READ','UPDATE','DELETE') NOT NULL,
  `compte` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `operation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit_operations_log`
--

INSERT INTO `produit_operations_log` (`id`, `produit_id`, `operation_type`, `compte`, `ip_address`, `operation_date`, `description`) VALUES
(4, 2, 'UPDATE', '97', 'fd42:4290:498e:5a74:216:3eff:feb4:c31a', '2024-11-21 13:01:58', 'Mise à jour du produit avec l\'ID 2'),
(5, 2, 'UPDATE', '97', 'fd42:4290:498e:5a74:216:3eff:feb4:c31a', '2024-11-21 13:02:21', 'Mise à jour du produit avec l\'ID 2'),
(6, 2, 'UPDATE', '97', 'fd42:4290:498e:5a74:216:3eff:feb4:c31a', '2024-11-21 13:02:24', 'Mise à jour du produit avec l\'ID 2'),
(7, 5, 'DELETE', '97', 'fd42:4290:498e:5a74:216:3eff:feb4:c31a', '2024-11-21 13:02:26', 'Suppression du produit avec l\'ID 5'),
(8, 52, 'CREATE', '97', 'fd42:4290:498e:5a74:216:3eff:feb4:c31a', '2024-11-21 13:02:39', 'Insertion d\'un produit (dd)'),
(9, 53, 'CREATE', '97', 'fd42:4290:498e:5a74:216:3eff:feb4:c31a', '2024-11-21 13:02:49', 'Insertion d\'un produit (dd)'),
(10, 54, 'CREATE', '99', 'fd42:4290:498e:5a74:216:3eff:feb4:c31a', '2024-12-13 13:03:18', 'Insertion d\'un produit (ddfd)');

-- --------------------------------------------------------

--
-- Structure de la table `Roles`
--

CREATE TABLE `Roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Roles`
--

INSERT INTO `Roles` (`id`, `role_name`) VALUES
(1, 'medecin'),
(2, 'visiteur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `historiqueconnexion`
--
ALTER TABLE `historiqueconnexion`
  ADD PRIMARY KEY (`idMedecin`,`dateDebutLog`) USING BTREE;

--
-- Index pour la table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_medecin_role` (`role_id`),
  ADD KEY `fk_medecin_permission` (`permission_id`);

--
-- Index pour la table `medecinproduit`
--
ALTER TABLE `medecinproduit`
  ADD PRIMARY KEY (`idMedecin`,`idProduit`,`Date`,`Heure`),
  ADD KEY `idProduit` (`idProduit`);

--
-- Index pour la table `Permissions`
--
ALTER TABLE `Permissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit_operations_log`
--
ALTER TABLE `produit_operations_log`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `medecin`
--
ALTER TABLE `medecin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT pour la table `Permissions`
--
ALTER TABLE `Permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `produit_operations_log`
--
ALTER TABLE `produit_operations_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `historiqueconnexion`
--
ALTER TABLE `historiqueconnexion`
  ADD CONSTRAINT `historiqueconnexion_ibfk_1` FOREIGN KEY (`idMedecin`) REFERENCES `medecin` (`id`);

--
-- Contraintes pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD CONSTRAINT `fk_medecin_permission` FOREIGN KEY (`permission_id`) REFERENCES `Permissions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_medecin_role` FOREIGN KEY (`role_id`) REFERENCES `Roles` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `medecinproduit`
--
ALTER TABLE `medecinproduit`
  ADD CONSTRAINT `medecinproduit_ibfk_1` FOREIGN KEY (`idMedecin`) REFERENCES `medecin` (`id`),
  ADD CONSTRAINT `medecinproduit_ibfk_2` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`id`);

DELIMITER $$
--
-- Évènements
--
CREATE DEFINER=`login5030`@`localhost` EVENT `supprimer_medecins_inactifs` ON SCHEDULE EVERY 1 MONTH STARTS '2024-11-08 14:30:59' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    -- Sélection des médecins inactifs depuis plus de 3 ans
    DELETE FROM medecin
    WHERE idMedecin IN (
        SELECT idMedecin
        FROM historiqueconnexion
        WHERE dateDebutLog < NOW() - INTERVAL 3 YEAR
    );

    -- Suppression de l'historique de connexion des médecins inactifs
    DELETE FROM historiqueconnexion
    WHERE idMedecin NOT IN (SELECT idMedecin FROM medecin);

    -- Suppression des visios consultées par les médecins inactifs
    DELETE FROM visio_consultees
    WHERE idMedecin NOT IN (SELECT idMedecin FROM medecin);

    -- Suppression des produits consultés par les médecins inactifs
    DELETE FROM produits_consultes
    WHERE idMedecin NOT IN (SELECT idMedecin FROM medecin);
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
