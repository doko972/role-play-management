-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jul 15, 2024 at 07:11 PM
-- Server version: 8.0.37
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roleplay`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_`
--

CREATE TABLE `add_` (
  `id_characters` int NOT NULL,
  `id_img` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Support et rapport de Bug'),
(2, 'Suggestions'),
(3, 'Discussions générales'),
(4, 'Sanctuaire d\'Athéna'),
(5, 'Sanctuaire sous-marin de Poséidon'),
(6, 'Les Enfers d\'Hadès');

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `id_characters` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `story` text CHARACTER SET utf8mb4 COLLATE utf8mb4_tr_0900_ai_ci NOT NULL,
  `story_date` date NOT NULL,
  `main_charc` tinyint(1) NOT NULL,
  `id_faction` int NOT NULL,
  `id_user` int NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`id_characters`, `name`, `story`, `story_date`, `main_charc`, `id_faction`, `id_user`, `image`) VALUES
(2, 'Balance', 'Dōko de la Balance (天秤座（ライブラ）の童虎（ドウコ） - raibura no dōko) est le gardien du septième temple du zodiaque, celui de la Balance (天秤宮, tenbinkyū), et est le maître de Shiryū du Dragon. Il est âgé de 261 ans et est donc le doyen parmi les Saints. Ce survivant de la précédente Guerre Sainte ne bouge guère de la cascade de Rozan, depuis laquelle il surveille la tour où ont été enfermés les 108 étoiles maléfiques au service d&#039;Hadès. Toutefois lors du réveil du dieu Hadès, il retourne au Sanctuaire et se joint à la bataille, rajeunit grâce au Misopetha-Menos.', '2024-07-14', 1, 1, 23, 'uploads/balancem.jpg'),
(5, 'Gemeaux', 'Saga des Gémeaux (双子座（ジェミニ）のサガ - jemini no saga) est le gardien du troisième temple du zodiaque, celui des Gémeaux (双児宮, sōjikyū). Il est l&#039;imposteur qui a assassiné le Pope treize ans avant l&#039;histoire de Saint Seiya, a également attenté à la vie d&#039;Athéna encore bébé et mené à la mort d&#039;Aiolos du Sagittaire.', '2024-07-14', 1, 1, 28, 'uploads/gemeauxm.jpg'),
(51, 'Griffon', 'Description. Minos du Griffon de l&amp;#039;étoile Céleste de la Noblesse est un des trois Juges des Enfers, les spectres les plus puissants de la chevalerie d&amp;#039;Hadès. C&amp;#039;est un personnage sans scrupule qui adore faire souffrir ses adversaires. Il est surnommé &amp;quot;le Marionnettiste&amp;quot;.', '2024-07-14', 1, 1, 21, 'uploads/griffon.jpg'),
(52, 'Garuda', 'Eaque du Garuda, Spectre de l&#039;étoile Céleste de la Vaillance (天雄星ガルーダのアイアコス, Tenyūsei Garūda no Aiakosu)\r\nAge : 22 ans\r\nEtoile : Etoile Céleste de la Vaillance\r\nNationalité : Népalaise\r\nSurplis : Garuda\r\nRang : Juge des Enfers\r\n\r\nTechniques de combat\r\n* Garuda Flap (Battement d&#039;Ailes du Garuda)\r\n* Galactica Illusion (Illusion Galactique)\r\n* Galactica Death Bring (Offrande Mortelle Galactique)\r\n\r\nEaque du Garuda est un personnage de la série Saint Seiya apparaissant dans le Chapitre Meikai-Hen du manga de Masami Kurumada ainsi que dans Saint Seiya - The Lost Canvas, le manga préquel de Shiori Teshirogi. Il est un des trois Juges des Enfers au côté de Rhadamanthe de la Wyverne et Minos du Griffon et est donc à ce titre l&#039;un des Spectres les plus puissants de l&#039;armée d&#039;Hadès.\r\n\r\nA noter que dans la version japonaise, le Spectre du Garuda est appelé Aiakos , Eaque n&#039;étant qu&#039;une francisation du terme venant du grec ancien.\r\nHaut', '2024-07-14', 1, 3, 24, 'uploads/garuda.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `faction`
--

CREATE TABLE `faction` (
  `id_faction` int NOT NULL,
  `faction_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `faction`
--

INSERT INTO `faction` (`id_faction`, `faction_name`) VALUES
(1, 'Athena'),
(2, 'Poseidon'),
(3, 'Hades');

-- --------------------------------------------------------

--
-- Table structure for table `img`
--

CREATE TABLE `img` (
  `id_img` int NOT NULL,
  `file` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `alternatif_txt` varchar(50) DEFAULT NULL,
  `id_faction` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `img`
--

INSERT INTO `img` (`id_img`, `file`, `name`, `class`, `alternatif_txt`, `id_faction`) VALUES
(1, 'img/gold/belier.webp', 'Belier', 'Chevalier d\'Or', 'Chevalier d\'Or du Belier', 1),
(2, 'img/gold/balance.webp', 'Balance', 'Chevalier d\'Or', 'Chevalier d\'Or de la Balance', 1),
(3, 'img/gold/cancer.webp', 'Cancer', 'Chevalier d\'Or', 'Chevalier d\'Or du Cancer', 1),
(4, 'img/gold/capricorne.webp', 'Capricorne', 'Chevalier d\'Or', 'Chevalier d\'Or du Capricorne', 1),
(5, 'img/gold/gemeaux.webp', 'Gemeaux', 'Chevalier d\'Or', 'Chevalier d\'Or du Gemeaux', 1),
(6, 'img/gold/lion.webp', 'Lion', 'Chevalier d\'Or', 'Chevalier d\'Or du Lion', 1),
(7, 'img/gold/poissons.webp', 'Poissons', 'Chevalier d\'Or', 'Chevalier d\'Or du Poissons', 1),
(8, 'img/gold/sagittaire.webp', 'Sagittaire', 'Chevalier d\'Or', 'Chevalier d\'Or du Sagittaire', 1),
(9, 'img/gold/scorpion.webp', 'Scorpion', 'Chevalier d\'Or', 'Chevalier d\'Or du Scorpion', 1),
(10, 'img/gold/taureau.webp', 'Taureau', 'Chevalier d\'Or', 'Chevalier d\'Or du Taureau', 1),
(11, 'img/gold/verseau.webp', 'Verseau', 'Chevalier d\'Or', 'Chevalier d\'Or du Verseau', 1),
(12, 'img/gold/vierge.webp', 'Vierge', 'Chevalier d\'Or', 'Chevalier d\'Or du Vierge', 1),
(13, 'img/argent/aigle.webp', 'Aigle', 'Chevalier d\'Argent', 'Chevalier d\'Argent de l\'Aigle', 1),
(14, 'img/argent/centaure.webp', 'Centaure', 'Chevalier d\'Argent', 'Chevalier d\'Argent du Centaure', 1),
(15, 'img/argent/corbeau.webp', 'Corbeau', 'Chevalier d\'Argent', 'Chevalier d\'Argent du Corbeau', 1),
(16, 'img/argent/fleche.webp', 'Fleche', 'Chevalier d\'Argent', 'Chevalier d\'Argent de la Fleche', 1),
(17, 'img/argent/lyre.webp', 'Lyre', 'Chevalier d\'Argent', 'Chevalier d\'Argent de la Lyre', 1),
(18, 'img/argent/persee.webp', 'Persee', 'Chevalier d\'Argent', 'Chevalier d\'Argent de Persee', 1),
(19, 'img/bronze/pegase.webp', 'Pegase', 'Chevalier de Bronze', 'Chevalier de Bronze de Pegase', 1),
(20, 'img/bronze/dragon.webp', 'Dragon', 'Chevalier de Bronze', 'Chevalier de Bronze de Dragon', 1),
(21, 'img/bronze/cygne.webp', 'Cygne', 'Chevalier de Bronze', 'Chevalier de Bronze de Cygne', 1),
(22, 'img/bronze/andromede.webp', 'Andromede', 'Chevalier de Bronze', 'Chevalier de Bronze de Andromede', 1),
(23, 'img/bronze/phoenix.webp', 'Phoenix', 'Chevalier de Bronze', 'Chevalier de Bronze de Phoenix', 1),
(30, 'img/marinas/ddm.jpg', 'Dragon des Mers', 'General', 'General du Dragon des Mers', 2),
(31, 'img/marinas/chrysaor.jpg', 'Chrysaor', 'General', 'General de Chrysaor', 2),
(32, 'img/marinas/hipocampe.jpg', 'Hippocampe', 'General', 'General du Cheval des Mers', 2),
(33, 'img/marinas/kraken.jpg', 'Kraken', 'General', 'General de Kraken', 2),
(34, 'img/marinas/scylla.jpg', 'Scylla', 'General', 'General de Scylla', 2),
(35, 'img/marinas/sorrento.jpg', 'Sirene', 'General', 'General de la Sirene', 2),
(50, 'img/spectres/wyvern.jpg', 'Wyverne', 'de l\'etoile Celeste de la Ferocite', 'Spectres du Wyverne', 3),
(51, 'img/spectres/griffon.jpg', 'Griffon', 'de l\'etoile Celeste de la Noblesse', 'Spectres du Griffon', 3),
(52, 'img/spectres/garuda.jpg', 'Garuda', 'de l\'etoile Celeste de la Vaillance', 'Spectres du Garuda', 3),
(53, 'img/spectres/balron.jpg', 'Balron', 'de l\'etoile Celeste de l\'Excellence', 'Spectres du Balron', 3),
(54, 'img/spectres/sphinx.jpg', 'Sphinx', 'de l\'etoile Celeste de l\'animalite', 'Spectres du Sphinx', 3),
(55, 'img/spectres/papillon.jpg', 'Papillon', 'de l\'etoile terrestre enchanteresse', 'Spectres du Papillon', 3),
(56, 'img/spectres/harpie.jpg', 'Harpie', 'de l\'etoile Celeste de la lamentation', 'Spectres de la Harpie', 3),
(57, 'img/spectres/deep.jpg', 'Deep', 'de l\'etoile terrestre de l\'obscurite', 'Spectres de Deep', 3),
(58, 'img/spectres/gigant.jpg', 'Cyclope', 'de l\'etoile terrestre de la Violence', 'Spectres du Cyclope', 3),
(59, 'img/spectres/basilic.jpg', 'Basilic', 'de l\'etoile Celeste de la victoire', 'Spectres du Basilic', 3),
(60, 'img/spectres/alraune.jpg', 'Alraune', 'de l\'etoile Celeste de la magie', 'Spectres de Alraune', 3),
(61, 'img/spectres/acheron.jpg', 'Acheron', 'de l\'etoile Celeste de l\'intervalle', 'Spectres de Acheron', 3);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `content` text NOT NULL,
  `topic_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `content`, `topic_id`, `created_at`) VALUES
(1, 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#039;imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n&#039;a pas fait que survivre cinq siècles, mais s&#039;est aussi adapté à la bureautique informatique, sans que son contenu n&#039;en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 1, '2024-07-15 17:30:18'),
(2, 'Pourquoi l&#039;utiliser?\r\n\r\nOn sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L&#039;avantage du Lorem Ipsum sur un texte générique comme &#039;Du texte. Du texte. Du texte.&#039; est qu&#039;il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour &#039;Lorem Ipsum&#039; vous conduira vers de nombreux sites qui n&#039;en sont encore qu&#039;à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d&#039;y rajouter de petits clins d&#039;oeil, voire des phrases embarassantes).', 1, '2024-07-15 17:30:30'),
(3, 'D&#039;où vient-il?\r\n\r\nContrairement à une opinion répandue, le Lorem Ipsum n&#039;est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s&#039;est intéressé à un des mots latins les plus obscurs, consectetur, extrait d&#039;un passage du Lorem Ipsum, et en étudiant tous les usages de ce mot dans la littérature classique, découvrit la source incontestable du Lorem Ipsum. Il provient en fait des sections 1.10.32 et 1.10.33 du &quot;De Finibus Bonorum et Malorum&quot; (Des Suprêmes Biens et des Suprêmes Maux) de Cicéron. Cet ouvrage, très populaire pendant la Renaissance, est un traité sur la théorie de l&#039;éthique. Les premières lignes du Lorem Ipsum, &quot;Lorem ipsum dolor sit amet...&quot;, proviennent de la section 1.10.32.', 1, '2024-07-15 17:30:42'),
(4, 'Lorsque se termine Le sanctuaire de Hadès, l’habitué des CHEVALIERS DU ZODIAQUE est un peu dans le même état que le gamin qui assistait au drama de L’EMPIRE CONTRE ATTAQUE : La princesse Saori ? Elle est égorgée comme un mouton !\r\nShaka, le chevalier le plus proche de Bouddha ? Il se suicide ! Les chevaliers de bronze qui accomplissent des miracles depuis notre adolescence ? Ils ne se servent à rien et sont complètement dépassés par les événements. Quant aux chevaliers d’or, leurs glorieux aînés en qui le spectateur pouvait rechercher réassurance, ils se font balayer les uns après les autres et finissent en enfer où Rhadamante, l’un des trois Juges les humilient en les exterminant les uns après les autres.\r\n\r\nAussi insécurisés que son public, les chevaliers de Bronze vont devoir se lancer dans une bataille où leur rôle est crucial : retrouver Athéna au royaume des morts pour lui donner son armure qui lui permettra d’affronter leur ennemi ultime : Hadès.\r\nAlors que chaque arc de DRAGON BALL Z se distingueront les uns des autres, ceux des ST SEIYA forment une énorme continuité où, comme chez Marvel, tout événement est rattaché au précédent : Kanon et Saga des gémeaux manipulés par Hadès manipulent à leur tour le grand pope, Hilda de Polaris et Poseïdon donnant lieu aux saga du Sanctuaire, d’Asgard et de Poseïdon. Les pièces s’emboîtent patiemment et force est de constater que ST SEIYA n’est pas qu’un enchaînement de combats sans queue ni tête mais bel et bien d’une histoire au long cours qui trouve avec Hadès une conclusion à sa hauteur.', 3, '2024-07-15 18:55:42'),
(5, 'on fait des suggestion ou non?', 4, '2024-07-15 19:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `title`, `category_id`) VALUES
(1, 'Premier nouveau sujet', 1),
(2, 'Encore un nouveau sujet', 1),
(3, 'Bienvenue chez vous mes Spectres', 6),
(4, 'Petite suggestion ou pas', 2);

-- --------------------------------------------------------

--
-- Table structure for table `to_ban`
--

CREATE TABLE `to_ban` (
  `id_user_user` int NOT NULL,
  `id_user_administrator` int NOT NULL,
  `ban_time` datetime NOT NULL,
  `reason` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `login` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `passwd` varchar(64) NOT NULL,
  `truename` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `birthday` date NOT NULL,
  `creatime` date NOT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT '0',
  `faction_id` int NOT NULL,
  `selected_card` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `login`, `passwd`, `truename`, `email`, `birthday`, `creatime`, `is_online`, `faction_id`, `selected_card`) VALUES
(21, 'doko972', '$2y$10$Onfv14wn.gkzwQe3DktwoO0z6oFVzlHzx7UIoLXV/CFDhLHHAABDa', 'doko', 'doko@doko.com', '1975-11-01', '2024-07-14', 1, 3, 51),
(22, 'doko', '$2y$10$6V2vbWpxxEB1Z7Wnm98vyONiS8FwzQp3xQCBEDvZbQktqQp0.y69W', 'tama', 'tama@tama.com', '1973-04-06', '2024-07-14', 1, 2, 33),
(23, 'tama', '$2y$10$7Cv0X.Y4B0nC2T373XxkZeMoIDdGpwhqJqcgmRpoQzD/rG6nReUSm', 'tama&#039;a', 'tama@tama.com', '2022-02-02', '2024-07-14', 1, 1, 2),
(24, 'Perséphone972', '$2y$10$Q1mYlaabK1AXDzCqO8F0wuoryJLj0RunJgAcK9.SnG.KJVJuuJaTe', 'Coré', 'Maroussia14@hotmail.fr', '1973-04-06', '2024-07-14', 1, 3, 52),
(25, 'josette', '$2y$10$LBBFBkmmc7b1aKvLd6EB0uWRThNbDIJ4r3ohdPoLbepQoPuQGPkv6', 'josette', 'josette@josette.com', '2020-02-05', '2024-07-14', 1, 2, 30),
(26, 'monique', '$2y$10$Q0tGRoBc7pI7j2x7jjs9h.Msnwl9ZEGEpXeuaa/K4MGEWI0SR69xS', 'monique', 'monique@monique.com', '1955-03-02', '2024-07-14', 1, 1, 1),
(27, 'ginette', '$2y$10$mnQiPKnXf6KkQ8w3fHiwHOAH2REoAQo./lA5YTquGKY3uX3.weGO2', 'ginette', 'ginette@ginette.com', '1970-01-01', '2024-07-14', 1, 3, 54),
(28, 'colette', '$2y$10$J2JF8zErxgQxp.E5y//GH.QfJVKOu9FLQCpSmRlckUF6iaEE71Um2', 'colette', 'colette@colette.com', '1966-01-01', '2024-07-14', 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE `user_posts` (
  `id_posts` int NOT NULL,
  `head` varchar(50) NOT NULL,
  `post` varchar(50) NOT NULL,
  `date_registered` date NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_`
--
ALTER TABLE `add_`
  ADD PRIMARY KEY (`id_characters`,`id_img`),
  ADD KEY `id_img` (`id_img`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id_characters`),
  ADD KEY `id_faction` (`id_faction`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `faction`
--
ALTER TABLE `faction`
  ADD PRIMARY KEY (`id_faction`);

--
-- Indexes for table `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id_img`),
  ADD KEY `fk_faction` (`id_faction`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `to_ban`
--
ALTER TABLE `to_ban`
  ADD PRIMARY KEY (`id_user_user`,`id_user_administrator`),
  ADD KEY `id_user_administrator` (`id_user_administrator`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD PRIMARY KEY (`id_posts`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `id_characters` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `faction`
--
ALTER TABLE `faction`
  MODIFY `id_faction` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `img`
--
ALTER TABLE `img`
  MODIFY `id_img` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_posts`
--
ALTER TABLE `user_posts`
  MODIFY `id_posts` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_`
--
ALTER TABLE `add_`
  ADD CONSTRAINT `add__ibfk_1` FOREIGN KEY (`id_characters`) REFERENCES `characters` (`id_characters`),
  ADD CONSTRAINT `add__ibfk_2` FOREIGN KEY (`id_img`) REFERENCES `img` (`id_img`);

--
-- Constraints for table `characters`
--
ALTER TABLE `characters`
  ADD CONSTRAINT `characters_ibfk_1` FOREIGN KEY (`id_faction`) REFERENCES `faction` (`id_faction`),
  ADD CONSTRAINT `characters_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `img`
--
ALTER TABLE `img`
  ADD CONSTRAINT `fk_faction` FOREIGN KEY (`id_faction`) REFERENCES `faction` (`id_faction`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`);

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `to_ban`
--
ALTER TABLE `to_ban`
  ADD CONSTRAINT `to_ban_ibfk_1` FOREIGN KEY (`id_user_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `to_ban_ibfk_2` FOREIGN KEY (`id_user_administrator`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD CONSTRAINT `user_posts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
