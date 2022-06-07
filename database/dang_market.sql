-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 07 juin 2022 à 07:37
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dang_market`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `date_creation`) VALUES
(1, 'admin', '$2y$10$eGpA/r29a0FPlHFWubgbF.5tE7aWZNp3aPgKhrN7DqoSlH.f7hH.K', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_prod`
--

CREATE TABLE `categorie_prod` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `engros_detail` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie_prod`
--

INSERT INTO `categorie_prod` (`id`, `nom`, `engros_detail`) VALUES
(1, 'Viandes - poissons - oeufs', ''),
(2, 'Produits laitiers', ''),
(3, 'Legumes & Fruits', ''),
(4, 'Cereales et derives', ''),
(5, 'Boissons', '');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `numcom` varchar(12) NOT NULL,
  `totalcom` int(11) NOT NULL,
  `nomclient` varchar(40) NOT NULL,
  `tel` char(9) NOT NULL,
  `adresse` varchar(40) NOT NULL,
  `tempscom` datetime NOT NULL,
  `statut` char(3) NOT NULL DEFAULT 'Non'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `produit` int(11) NOT NULL,
  `qte` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `prodcom`
--

CREATE TABLE `prodcom` (
  `id` int(11) NOT NULL,
  `numcom` varchar(40) NOT NULL,
  `image` varchar(100) NOT NULL,
  `nomprod` varchar(40) NOT NULL,
  `prixprod` int(11) NOT NULL,
  `qteprod` int(11) NOT NULL,
  `pqprod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(100) NOT NULL,
  `categorie` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prix` int(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `old_prix` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `categorie`, `image`, `nom`, `prix`, `description`, `old_prix`) VALUES
(1, 5, '1.png', 'VINUT', 250, 'PRODUIT RICHE EN VITAMINE C', NULL),
(2, 5, '2.png', 'JUS PAMPELEMOUS', 700, 'JUS RICHE EN PROTEINE, EN VITAMINE C ET D', NULL),
(3, 5, '3.png', 'jus d\'orange', 500, 'jus fait d\'orange.', NULL),
(4, 5, '5.png', 'djino', 800, 'Cocktail De Fruits', NULL),
(5, 5, '7.png', 'Orangina', 800, 'jus fais d\'orange', NULL),
(6, 5, '9.png', 'rita lemon', 800, 'jus canette de citron', NULL),
(7, 5, '8.png', 'Vimto', 700, 'jus fais de rezin', NULL),
(8, 5, '10.png', 'Reaktor', 500, 'boisson energetique', NULL),
(9, 5, '11.png', 'vitamont', 1200, 'jus fait a base des pommes', NULL),
(49, 5, '12.png', 'jus de sprite', 500, 'jus Lemon', NULL),
(50, 5, '13.png', 'coca cola', 700, 'bonsson gaxeuse qa base d\'extrail feuille de coca', NULL),
(51, 5, '14.png', 'jus de resain', 900, 'jus fais de raisin', NULL),
(52, 5, '15.png', 'Fanta', 600, 'boisson aromatisee aux fruit cree par coca cola', NULL),
(53, 5, '16.png', 'Malta', 500, 'boisson gazeuse de malt legerement gazeifiee, brassee a partir d\'orge, et d\'eau comme la biere', NULL),
(54, 5, '17.png', 'Dudu', 500, 'compose essentielement de laid entier en poudre de sucre', NULL),
(55, 5, '18.png', 'Biotta', 1200, 'jus de pomme de terre', NULL),
(56, 5, '19.png', 'pepsi', 1000, 'jus ayant un gout d\'agrumes. les saveurs du coca-cola pencheraient du cote de la vanille et du raiss', NULL),
(57, 5, '20.png', 'TAMPICO', 700, 'boisson raflechissante aromatisee aux bon gout d\'ananas, de banane et d\'orange', NULL),
(58, 3, '1-2-700x700.png', 'Carotte', 250, 'les carottes bien frais disponibles tous les jours', NULL),
(59, 3, '517b164c28_50183208_adobestock-44049006-lukas-gojda-1600.png', 'Oranges', 350, 'les oranges bien frais et juteux disponible h24', NULL),
(60, 3, '10662003.png', 'pasteque', 1500, 'les pasteques de qualites (premier choix) disponible ici', NULL),
(61, 3, 'ananas-victoria.png', 'ananas', 750, 'les ananas bien frais et moins chers disponible pour tous.', NULL),
(62, 3, 'banane.png', 'Bananes', 450, 'les bananes bien fraiches et propres de premier choix disponible ici', NULL),
(63, 3, 'capture-d-e-cran-2014-11-26-a-22.11.13.png', 'goyave', 100, 'fruit tropical de tres bonne qualite disponible chez nous. ici', NULL),
(64, 3, 'kiwi.png', 'kiwi', 1500, 'Fruit d\'espece de liane de tres bonnes qualites venu de la CHINE  disponible ici', NULL),
(65, 3, 'mangue-large.png', 'mangue', 100, 'Fruit du manguier tres sucree et de bonne qualites', NULL),
(66, 3, 'poire_0.png', 'poire', 250, 'fruit a pepins tres comestibles au gout doux et sucre disponible ici.', NULL),
(67, 3, 'pommes.png', 'pomme', 675, 'fruit cultive en local comestible tres doux et sucre.  \r\ndisponible ICI.', NULL),
(68, 3, 'raisin.png', 'raisin', 1800, 'fruit tres doux et tres sucre venu de la FRANCE.\r\ndisponible ICI.', NULL),
(69, 3, 'shutterstock_192308075.png', 'fraise', 2000, 'fruit  frais et de bonne qualite disponible ICI', NULL),
(70, 3, '7b32549378a1e7e89233250ff0262427.png', 'COLLECTION LEGUMES', 3500, '', NULL),
(71, 3, '7d746628898d18de64a300a360dfb6c6.png', 'PAQUET DE LEGUME', 2575, '', NULL),
(72, 3, '30cdc87998f01bd71973d35de513aa11.png', 'COLLECTION LEGUMES', 1500, 'BONNE QUALITE DE LEGUME', NULL),
(73, 3, '70dc2e031f2f232a3f27b9a58ed52ed6 - Copie.png', 'COLLECTION LEGUMES', 750, 'MEILLEURES QUALITE', NULL),
(74, 3, '81129b9d774c0e3f7e6e15d7450a4fdc.png', 'TASBA ET AUTRES LEGUMES', 2000, 'LEGUME A VITAMINE', NULL),
(75, 3, '82816490777737827bc401336d065227.png', 'COLLECTION LEGUMES', 5400, 'LEGUME COMPLET', NULL),
(76, 3, 'ca4d5c6bf09a2868374c755205143c01.png', 'COLLECTION LEGUMES', 1500, 'LEGUME DE MEILLEURE CHOIS', NULL),
(77, 3, 'ca4d5c6bf09a2868374c755205143c01.png', 'COLLECTION LEGUMES', 1500, 'LEGUME DE MEILLEURE CHOIS', NULL),
(78, 2, '2_Smilga_gross.png', 'YAOURT SMILGA', 600, '', NULL),
(79, 2, '3412290001372 - Lait Fermenté PB - JPG BD site web.png', 'PUYSAN BRETON', 2000, 'LE LAIT FERMENTE', NULL),
(80, 2, 'sotigroup-dolait-yaourt-zoom.png', 'DOLAIT', 350, 'LAIT DE DOLAIT', NULL),
(81, 2, 'sotigroup-laitcaille-zoom.png', 'DOFAIT', 3000, 'LE LAIT CALAIT FRAISE', NULL),
(82, 2, 'téléchargement.png', 'PRESIDENT', 600, 'LE LAIT DE BOEURE,DOUX GASTRONOMIQUE', NULL),
(83, 1, '1.jpg', 'CARPE', 1500, 'carpe toute fraiche disponible', NULL),
(84, 1, 'IMG_2414.JPG', 'MAQUEREAU', 1500, 'disponible uniquement pour un achat apartir de 5 maquereau', NULL),
(85, 1, 'IMG_2415.JPG', 'machoiron', 1000, 'machoiron en stock vendu par kg', NULL),
(86, 1, 'IMG_2416.JPG', 'CILLURE', 800, 'poisson d\'eau douce vendu au prix de 1', NULL),
(88, 1, 'IMG_2417.JPG', 'CAPITAINE', 1200, 'poisson aux ecailles argentes', NULL),
(89, 1, 'IMG_2422.JPG', 'CUISSE DE POULET', 700, 'cuisse de poulet vendu au prix unique de 700', NULL),
(90, 1, 'IMG_2423.JPG', 'gesier', 2000, 'disponible vendu en stock de 5', NULL),
(91, 1, 'IMG_2425.JPG', 'PARTIE HAUT DE CUISSE', 1500, 'partie haut de cuisse disponible uniquement apartir d\'une quantite de 3', NULL),
(92, 1, 'IMG_2428.JPG', 'CARACASSE DE BOEUF', 120000, 'compose de la poitrine et de la cuisse avant et arriere', NULL),
(93, 1, 'IMG_2429.PNG', 'CUISSE DE MOUTON', 20000, 'cuisse de mouton disponible', NULL),
(94, 1, 'IMG_2430.JPG', 'POITRINE DE BOEUF', 15000, 'Disponible en qualite frais', NULL),
(95, 1, 'IMG_2432.JPG', 'FOIE DE BOEUF', 2500, 'qualite frais d\'une disponibilite inferieur ou egale a 2 jrs', NULL),
(96, 1, 'IMG_2433.JPG', 'ROGNON', 3000, 'Vendu en quantite de 2 au prix unique de 3000', NULL),
(97, 1, 'IMG_2434.JPG', 'CUISSE DE CHEVRE', 10000, 'cuisse de chevre disponible', NULL),
(98, 1, 'IMG_2436.JPG', 'CHEVRE ENTIER', 25000, 'chevre entier excepte les parties interieurs.', NULL),
(99, 1, 'IMG_2438.JPG', 'PLATEAUX D\'OEUFS', 1800, 'plateau constitue de 30 oeufs.', NULL),
(100, 1, 'IMG_2439.JPG', 'PLATEAUX D\'OEUFS DE CANARDS', 1500, 'plateau constitue de 25 oeufs de canards', NULL),
(101, 2, 'Nido.png', 'Poudre Nido', 3100, 'nourissant et fortifiant', NULL),
(102, 2, 'calin.png', 'Calin', 850, 'produit extra fondant', NULL),
(103, 2, 'beure.png', 'Beurre de Montagne', 700, 'beurre de qualite tres doux', NULL),
(105, 2, 'cerelac.png', 'CERELAC', 2700, 'produit pour enfant. tres bon et Nourissant', NULL),
(106, 2, 'jadida.png', 'jadida', 750, 'beurre familial 900g net', NULL),
(109, 2, 'camlait.png', 'Camlait', 450, 'yaourt vanille tres Bon', NULL),
(111, 2, 'dolait.png', 'yaout camlait', 600, 'yaourt des mature tres bon pour l\'organisme', NULL),
(112, 2, 'Nousriss.png', 'NOURISS Soja', 350, 'naturel et nourrissant', NULL),
(113, 2, 'sotigroup-dolait-yaourt-zoom.png', 'Dolait', 750, 'dolait gout mangue', NULL),
(114, 4, 'AVOINE PETIT.png', 'AVOINE PETIT', 4500, 'riche en vibre alimentaire', NULL),
(115, 4, 'BLE DUR.png', 'BLE DUR', 3000, 'riche en proteine y compris en gluten', NULL),
(116, 4, 'BLE TENDRE.png', 'BLE TENDRE', 2200, 'Ble utilise pour faire de la farine', NULL),
(118, 2, 'lait barb.png', 'lait babeurre', 350, '', NULL),
(119, 4, 'MAÏS JAUNE.png', 'MAÏS JAUNE', 10000, 'vendu en sac de 25kg. riche en amidon.', NULL),
(121, 4, 'FONIO.png', 'FONIO', 700, 'plante annuelle herbacee', NULL),
(122, 4, 'MAIS BLANC.png', 'MAÏS BLANC', 9500, 'vendu en sac de 25 kg. genereralment considere comme une categorie de mais blanc.', NULL),
(124, 4, 'MIL BLANC.png', 'MIL BLANC', 5000, 'presentent une teneur interessante en proteine et sont composes d\'acides amines', NULL),
(125, 4, 'MIL JAUNE.png', 'MIL JAUNE', 3000, 'riches en phosphore et en magnesium.', NULL),
(126, 4, 'MIL ROUGE.png', 'MIL ROUGE', 700, 'Riche en vitamine A,B,C,E.', NULL),
(127, 4, 'RIZ LOCAL.png', 'RIZ LOCAL', 7000, 'Du Riz propre qui n\'a nul besoin de tri et/ou de vannage.', NULL),
(128, 4, 'RIZ PARFUME.png', 'riz parfume', 9500, 'ris au grain long naturellement parfume', NULL),
(129, 4, 'SORGHO.png', 'SORGHO', 4800, 'riche en minerais. sa bonne tenneur en phosphore en fait un aliment dynamisant et excellent pour l\'o', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(9) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `tel`, `password`, `date_creation`) VALUES
(1, 'user', 'moussahassana42@gmail.com', '', '$2y$10$VP256Svq2BN4T61i.NM.cujUHHdd3nmGLxoq4BYe7z497JlfEA0Ca', '0000-00-00 00:00:00'),
(13, 'elbachir', 'user@gmail.com', '69058561', '$2y$10$Yzxo4YDP9.WNMsE/3G4dkuQ0Kl/aA2ndCJTk5A1kjd76i7pWFH3JC', '2022-06-07 06:25:51');

-- --------------------------------------------------------

--
-- Structure de la table `user_favoris`
--

CREATE TABLE `user_favoris` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `produit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie_prod`
--
ALTER TABLE `categorie_prod`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`numcom`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `produit` (`produit`);

--
-- Index pour la table `prodcom`
--
ALTER TABLE `prodcom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `numcom` (`numcom`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie` (`categorie`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_favoris`
--
ALTER TABLE `user_favoris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produit` (`produit`),
  ADD KEY `user` (`user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categorie_prod`
--
ALTER TABLE `categorie_prod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `prodcom`
--
ALTER TABLE `prodcom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `user_favoris`
--
ALTER TABLE `user_favoris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`produit`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `prodcom`
--
ALTER TABLE `prodcom`
  ADD CONSTRAINT `prodcom_ibfk_1` FOREIGN KEY (`numcom`) REFERENCES `commande` (`numcom`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categorie_prod` (`id`);

--
-- Contraintes pour la table `user_favoris`
--
ALTER TABLE `user_favoris`
  ADD CONSTRAINT `user_favoris_ibfk_1` FOREIGN KEY (`produit`) REFERENCES `produits` (`id`),
  ADD CONSTRAINT `user_favoris_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
