-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 24 jan. 2024 à 13:32
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vente_de_gateaux`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `numero_commande` int(11) NOT NULL,
  `date_de_commande` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `numero_commande`, `date_de_commande`, `id_user`) VALUES
(1, 2224, '2024-01-23', 7);

-- --------------------------------------------------------

--
-- Structure de la table `detail`
--

CREATE TABLE `detail` (
  `id` int(11) NOT NULL,
  `id_commande` int(100) NOT NULL,
  `id_gateau` int(100) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `detail`
--

INSERT INTO `detail` (`id`, `id_commande`, `id_gateau`, `quantite`) VALUES
(4, 1, 4, 1),
(5, 1, 3, 1),
(6, 1, 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `list_gateaux`
--

CREATE TABLE `list_gateaux` (
  `id_gateaux` int(11) NOT NULL,
  `nom_du_gateaux` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `prix` int(50) NOT NULL,
  `photo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `list_gateaux`
--

INSERT INTO `list_gateaux` (`id_gateaux`, `nom_du_gateaux`, `description`, `prix`, `photo`) VALUES
(2, 'Verrine aux fruits', 'verrines aux fruits avec mascarpone, morceaux de fraises, colis de fruits, bicuits émietté.', 20, '5e9e56262d6bf7dccdc5c1e83f465487.jpg'),
(3, 'Brownie au chocolat', 'Brownie au chocolat bien fondant, très chocolaté, chocolat noir 70% à déguster tiède pour les gourmands', 30, 'dsc054191.jpg'),
(4, 'Verrine facon tarte au citron ', 'verrine facon tarte au citron avec ca meringue... un delicé', 40, 'maxresdefault.jpg'),
(5, 'Panacotta ', 'panacotta avec des morceaux de fraises, coulis de fraise, biscuits émiettées', 50, 'panna.jpg'),
(6, 'Tiramisu a la pistache', 'tiramisu a la pistache , mascarpone, crème de pistache, biscuits a la cuillère. Si vous aimez la pistache ce tiramisu et fais pour vous§', 40, 'tiramisu-pistache.jpg'),
(7, 'Gateaux au chocolat', 'gâteaux au chocolat et fondant a l&#039;intérieur! chocolat noir 70% ', 60, 'morceau-gateau-au-chocolat-assiette-dans-bois_893012-40924.avif'),
(8, 'Gateaux aux 3 chocolats ', 'vous aimez le chocolats? ce gateaux et fait pour voir avec 3 saveurs chocolat noir chocolat au lait et chocolat blanc. très peux de sucre ajouter!', 60, 'Recette-entremets-3-chocolats-croustillant-Lilie-Bakery-500x500.webp'),
(9, 'Morceaux de gâteaux au chocolat et fraise', 'Un mélange parfait chocolat fraise! conçu pour les gourmands!', 80, 'morceau-gateau-au-chocolat-fraises-dessus_893012-41033.avif'),
(10, 'Gateaux au chocolat et cerise', 'l&#039;assortiment parfait! cerise kirsch! chocolat noir 60%!', 100, 'morceau-gateau-au-chocolat-cerise-dessus_349893-1765.avif'),
(11, 'Assortiment de verrines', 'verrines surprise, 3 assortiment de verrines, si vous aimze les challenge ces verrines et fait pour vous!', 80, 'trilogie-de-verrines.jpeg'),
(12, 'Fondant au chocolat', 'hum un bon fondant tout droit sortir du four bien chaud bien fondant! tres chocolaté...  a déguste chaud ou tiède', 150, 'Recette-gateau-chocolat-mascarpone-facile-Lilie-Bakery.webp'),
(13, 'Moelleux au chocolat', 'Moelleux au chocolat avec nappage au chocolat au lait, avec des morceaux de fraises!', 40, 'a18fd0ab521f2407a101086261ad0c33.jpeg'),
(14, 'Gâteaux au chocolat', 'gateau au chocolat très fondant!', 50, 'Gateau-chocolat-zucchini-tinyjpg-1178px.jpg'),
(15, 'Entremet au chocolat ', 'entremet au chcolat au lait très peux de sucre!', 100, 'gateau-chocolat.jpg'),
(16, 'Morceau de gateau au chocolat', 'morceaux de gâteau de chocolat noir avec des framboises et sont coulis de chocolat!', 160, 'morceau-gateau-au-chocolat-baies-sauce-au-chocolat_893012-40994.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `prenom` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(250) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `numero_telephone` varchar(10) NOT NULL,
  `date_de_naissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `email`, `mot_de_passe`, `adresse`, `numero_telephone`, `date_de_naissance`) VALUES
(7, 'bey', 'nawal', 'nbey34@gmail.com', '$2y$10$BoncR5Z7AusIId9Hcbi/deAas8nZbS/tpm8h2rr/3bKqKa8LyYquy', '12 rue quelque part ici ', '0102030405', '1989-09-04');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_commande` (`id_commande`),
  ADD KEY `id_gateau` (`id_gateau`);

--
-- Index pour la table `list_gateaux`
--
ALTER TABLE `list_gateaux`
  ADD PRIMARY KEY (`id_gateaux`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `detail`
--
ALTER TABLE `detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `list_gateaux`
--
ALTER TABLE `list_gateaux`
  MODIFY `id_gateaux` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`),
  ADD CONSTRAINT `detail_ibfk_2` FOREIGN KEY (`id_gateau`) REFERENCES `list_gateaux` (`id_gateaux`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
