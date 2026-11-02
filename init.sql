-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 15 oct. 2026 à 09:00
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mg_sitemarchand`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE `adresse` (
  `IDADRESSE` int(11) NOT NULL,
  `RUE` varchar(32) NOT NULL,
  `CP` smallint(6) NOT NULL,
  `VILLE` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`IDADRESSE`, `RUE`, `CP`, `VILLE`) VALUES
(1, '15 rue Jean Moulin', 29100, 'Douarnenez');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `IDCATEGORIE` int(11) NOT NULL,
  `LIBELLECATEGORIE` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`IDCATEGORIE`, `LIBELLECATEGORIE`) VALUES
(1, 'One Piece'),
(2, 'Naruto'),
(3, 'Dragon Ball'),
(4, 'Bleach'),
(5, 'Demon Slayer');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `IDCLIENT` int(11) NOT NULL,
  `PSEUDO` varchar(32) NOT NULL,
  `MDP` varchar(32) NOT NULL,
  `NOM` varchar(32) NOT NULL,
  `PRENOM` varchar(32) NOT NULL,
  `MAIL` varchar(50) DEFAULT NULL,
  `TEL` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`IDCLIENT`, `PSEUDO`, `MDP`, `NOM`, `PRENOM`, `MAIL`, `TEL`) VALUES
(1, 'Monkey D Mael', 'azerty', 'Monkey', 'Mael', 'monkeyDmael@onepiece.fr', '+33615825789'),
(2, 'mael258', '123456', 'gargadennec', 'mael', 'mael.gdc@gmail.com', '0643699763'),
(3, 'ger', '123', 'GARGADENNEC', 'Maël', 'gargadennec-m@saint-louis29.net', '0643699763'),
(10, 'mael234', '123', 'GARGADENNEC', 'Maël', 'gargadennec-m@saint-louis29.net', '0643699763');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `NUMCOMMANDE` int(11) NOT NULL,
  `IDCLIENT` int(11) NOT NULL,
  `IDSTATUT` varchar(3) NOT NULL,
  `DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`NUMCOMMANDE`, `IDCLIENT`, `IDSTATUT`, `DATE`) VALUES
(1, 1, 'tra', '2026-02-04'),
(2, 2, 'VAL', '2026-04-30'),
(3, 2, 'VAL', '2026-05-04'),
(4, 2, 'ENC', '2026-05-07'),
(5, 10, 'VAL', '2026-10-12');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE `contenir` (
  `NUMCOMMANDE` int(11) NOT NULL,
  `IDPRODUIT` int(11) NOT NULL,
  `QUANTITE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`NUMCOMMANDE`, `IDPRODUIT`, `QUANTITE`) VALUES
(1, 1, 2),
(2, 3, 2),
(3, 3, 5),
(4, 2, 1),
(5, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `habiter`
--

CREATE TABLE `habiter` (
  `IDCLIENT` int(11) NOT NULL,
  `IDADRESSE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `habiter`
--

INSERT INTO `habiter` (`IDCLIENT`, `IDADRESSE`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `IDPRODUIT` int(11) NOT NULL,
  `IDCATEGORIE` int(11) NOT NULL,
  `NOMPRODUIT` varchar(32) NOT NULL,
  `PRIX` decimal(8,2) NOT NULL,
  `STOCK` int(11) NOT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `NOMIMAGE` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`IDPRODUIT`, `IDCATEGORIE`, `NOMPRODUIT`, `PRIX`, `STOCK`, `DESCRIPTION`, `NOMIMAGE`) VALUES
(1, 1, 'One piece Tome 1', '7.00', 0, 'Le premier tome du manga one piece', 'https://m.media-amazon.com/images/I/91t7YlWwGfL._SL1500_.jpg'),
(2, 1, 'One piece Tome 2', '7.00', 1, 'Le second tome du manga one piece', 'https://m.media-amazon.com/images/I/918Ai9a893L._SL1500_.jpg'),
(3, 1, 'One piece Tome 3', '7.00', 2, 'Le troisième tome du manga one piece', 'https://m.media-amazon.com/images/I/91sKhhBDJ0L._SL1500_.jpg'),
(4, 2, 'Naruto Tome 1', '7.00', 3, 'Le premier tome du manga naruto', 'https://m.media-amazon.com/images/I/91hIZnHeLiL._SL1500_.jpg'),
(5, 2, 'Naruto Tome 2', '7.00', 4, 'Le second tome du manga naruto', 'https://m.media-amazon.com/images/I/91MIOoG77AL._SL1500_.jpg'),
(6, 2, 'Naruto Tome 3', '7.00', 3, 'Le troisième tome du manga naruto', 'https://m.media-amazon.com/images/I/91neI5NlUZL._SL1500_.jpg'),
(7, 3, 'Dragon Ball Tome 1', '7.00', 15, 'Le premier tome du manga dragon ball', 'https://m.media-amazon.com/images/I/71OCG7ILxAL._SL1500_.jpg'),
(8, 3, 'Dragon Ball Tome 2', '7.00', 3, 'Le second tome du manga dragon ball', 'https://m.media-amazon.com/images/I/61Y3F84hxoL._SL1069_.jpg'),
(9, 3, 'Dragon Ball Tome 3', '7.00', 3, 'Le troisième tome du manga dragon ball', 'https://m.media-amazon.com/images/I/61DU5XATgLL._SL1070_.jpg'),
(11, 4, 'Bleach Tome 1', '5.00', 3, ' Le premier tome du manga bleach', 'https://m.media-amazon.com/images/I/81G0iDgrFPL._SL1500_.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `IDSTATUT` varchar(3) NOT NULL,
  `LIBELLESTATUT` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`IDSTATUT`, `LIBELLESTATUT`) VALUES
('ANN', 'Annulée'),
('ENC', 'En cours'),
('ENV', 'Envoyée'),
('PAY', 'Payée'),
('tra', 'en transite'),
('VAL', 'Validée');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `codeUser` int(11) NOT NULL,
  `login` varchar(15) NOT NULL,
  `mdp` varchar(32) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `role` varchar(3) NOT NULL DEFAULT 'usr'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`codeUser`, `login`, `mdp`, `nom`, `prenom`, `role`) VALUES
(1, 'leroy-a', '123456', 'Leroy', 'Achille', 'adm'),
(2, 'denis-e', '654321', 'Denis', 'Emma', 'usr'),
(3, 'olsen-g', 'azerty', 'Olsen', 'Gabriel', 'usr'),
(4, 'erwann', 'leroux29@', 'le roux', 'erwann', 'adm');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`IDADRESSE`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`IDCATEGORIE`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`IDCLIENT`),
  ADD UNIQUE KEY `PSEUDO` (`PSEUDO`); -- Unicité du pseudo pour éviter les conflits

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`NUMCOMMANDE`),
  ADD KEY `FK_ETRE` (`IDSTATUT`),
  ADD KEY `FK_PASSER` (`IDCLIENT`);

--
-- Index pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`NUMCOMMANDE`,`IDPRODUIT`),
  ADD KEY `FK_CONTENIR` (`IDPRODUIT`);

--
-- Index pour la table `habiter`
--
ALTER TABLE `habiter`
  ADD PRIMARY KEY (`IDCLIENT`,`IDADRESSE`),
  ADD KEY `FK_HABITER` (`IDADRESSE`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`IDPRODUIT`),
  ADD KEY `FK_APPARTENIR` (`IDCATEGORIE`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`IDSTATUT`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`codeUser`),
  ADD UNIQUE KEY `login` (`login`); -- Unicité du login pour éviter les conflits

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `IDADRESSE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `IDCATEGORIE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `IDCLIENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `NUMCOMMANDE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `IDPRODUIT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `codeUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_ETRE` FOREIGN KEY (`IDSTATUT`) REFERENCES `statut` (`IDSTATUT`),
  ADD CONSTRAINT `FK_PASSER` FOREIGN KEY (`IDCLIENT`) REFERENCES `client` (`IDCLIENT`);

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_CONTENIR` FOREIGN KEY (`IDPRODUIT`) REFERENCES `produit` (`IDPRODUIT`),
  ADD CONSTRAINT `FK_CONTENIR2` FOREIGN KEY (`NUMCOMMANDE`) REFERENCES `commande` (`NUMCOMMANDE`);

--
-- Contraintes pour la table `habiter`
--
ALTER TABLE `habiter`
  ADD CONSTRAINT `FK_HABITER` FOREIGN KEY (`IDADRESSE`) REFERENCES `adresse` (`IDADRESSE`),
  ADD CONSTRAINT `FK_HABITER2` FOREIGN KEY (`IDCLIENT`) REFERENCES `client` (`IDCLIENT`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_APPARTENIR` FOREIGN KEY (`IDCATEGORIE`) REFERENCES `categorie` (`IDCATEGORIE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
