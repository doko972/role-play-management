-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jul 11, 2024 at 03:55 PM
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
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `id_characters` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `story` text CHARACTER SET utf8mb4 COLLATE utf8mb4_tr_0900_ai_ci NOT NULL,
  `story_date` date NOT NULL,
  `main_charc` tinyint(1) NOT NULL,
  `id_faction` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`id_characters`, `name`, `story`, `story_date`, `main_charc`, `id_faction`, `id_user`) VALUES
(1, 'Mu', '\r\n\r\nKiki d&#039;Appendix, impatient, est exténué d&#039;attendre son maître Mū, plongé en pleine discussion avec Dōko de la Balance.\r\n\r\nDōko, vieux et rabougri, confirme qu&#039;il y a de très fortes chances pour que la Japonaise Saori Kido soit Athéna. Mū pense également que les Galaxian Wars organisées entre les Bronze Saints n&#039;étaient qu&#039;un stratagème voué à inciter le mal rôdant au Sanctuaire à se dévoiler au grand jour. Il avait ressenti disparaître le Cosmos de son maître Shion 13 ans avant, et depuis le Pope semble être une autre personne.\r\n\r\nDōko‏‎ pense lui aussi que ce Cosmos maléfique ne peut être celui de Shion, car celui-ci ne tomberait jamais aussi bas. Mū se rend compte qu&#039;il n&#039;a au final rien appris de neuf à Dōko‏‎, qui était déjà au courant de tout, et le saint du Bélier félicite alors celui de la Balance, voyant bien là l&#039;expérience d&#039;un survivant de la précédente Guerre Sainte. Mū lui demande une dernière chose : comment a-t-il songé que Saori Kido pourrait être Athéna ?\r\n\r\nDōko rit et lui rappelle que son disciple, Shiryū, a participé à ces Galaxian Wars, et que c&#039;est comme ça qu&#039;il a appris que le Pégase de cette ère se trouvait justement aux côtés de Saori Kido.\r\n', '2024-07-11', 1, 1, 6),
(2, 'Doko', 'Dōko de la Balance est âgé de 18 ans et, avec Shion du Bélier, sont les seuls survivants de la guerre sainte contre Hadès. Les détails de cette guerre ne sont pas connus mais une image les montre avec leurs armures endommagées et les armes de la Balance, elles aussi endommagées, dispersées autour d&#039;eux. Shion porte à la main l&#039;épée et Dōko son bouclier. En vue de la prochaine guerre sainte, il recoit alors d&#039;Athéna la mission de surveiller la tour où les 108 étoiles maléfiques d&#039;Hadès sont enfermées.\r\n\r\nAthéna lui offre également le misopetha menos, technique divine pour le vieillissement simulé. Son coeur ne bat plus que 100 000 fois par an.', '2024-07-11', 1, 1, 6),
(12, 'Mu', 'creer une nouvelle histoire', '2024-07-11', 1, 1, 6);

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
  `alternatif_txt` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `selected_card` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `login`, `passwd`, `truename`, `email`, `birthday`, `creatime`, `is_online`, `selected_card`) VALUES
(1, 'doko', 'tekmate', 'hades', 'doko972@gmail.com', '1975-11-01', '2024-07-10', 0, NULL),
(4, 'josette', '$2y$10$QeWKX9NR.N1rYDCUUPkww.RvFD55khG5hW87an1QfWNmWLeUMfJH.', 'josette', 'josette@gmail.com', '2024-07-02', '2024-07-11', 0, NULL),
(5, 'josé', '$2y$10$tzjv9vjt2v.rLX8bq7tQzu/RkfKMjTAdjfynN.N.WPbv3RaSCzdnS', 'josé', 'josette@gmail.com', '2024-07-01', '2024-07-11', 0, NULL),
(6, 'doko972', '$2y$10$YNFVAt5IGb7GVphMTRoTpeXZvJiea0rVQa2Er1bwqId6H8NIGqtFm', 'doko', 'david@gmail.com', '2024-07-05', '2024-07-11', 1, 2),
(7, 'batman', '$2y$10$aFJxa1VqIi5foAk9zYW1Y.BHNaf9iW7g5TnSt1xJ/8FepEGy3pVVa', 'rené', 'batman@gmail.com', '1978-08-10', '2024-07-11', 1, NULL),
(8, 'radhamanthe', '$2y$10$pCoUWibvY4ywGx2G4I4Mc.YXaSIl1lZg7KU1UERkbmSLOuKs0qm.C', 'maurice', 'rada@gmail.com', '1950-08-01', '2024-07-11', 0, NULL),
(9, 'maroussia', '$2y$10$Mg/zgXdGqhDX3wwOx9KvXOhCeEnP8MBSV1Hl11yAVYnr1ZYDYmdpm', 'maroussia', 'maroussia@gmail.com', '1980-11-02', '2024-07-11', 1, NULL),
(10, 'seb', '$2y$10$UTjjfiJTkNOXSP.4zhqpPu07N0K0BulHsOwLz38gRItYX/rixJrU2', 'sebastien', 'seb@gmail.com', '1985-05-01', '2024-07-11', 0, NULL),
(11, 'thomas', '$2y$10$STAG9Ea4RxoF1WQFSa9ozuc6N3fwETpib.a0bgsmTH78FC2Dkt/ky', 'thomas', 'thomas@thomas.com', '1999-05-12', '2024-07-11', 0, NULL),
(12, 'sylvain', '$2y$10$ezlONk5el0jd54dCoozJwepflRGsAmH6tS5uu4toaWYy/aq9MIsHq', 'sylvain', 'sylvain@sylvain.com', '1954-12-01', '2024-07-11', 0, NULL),
(13, 'henri', '$2y$10$WeNyXpyfFuRSy9.kAhw1N.Oc9iX43GbtUvgKvDwy22zoMsFb3lJZ6', 'henri', 'henri@henri.com', '1972-12-02', '2024-07-11', 0, NULL),
(14, 'noah', '$2y$10$Cm5YjyBVX5J17mMVZwZBp.tISBU/bzLRpFdoypq6GAMqwqEN.iBOC', 'noah', 'noah@noah.com', '1987-11-06', '2024-07-11', 1, 0),
(15, 'mae', '$2y$10$zo1NfkDZFUMoSZfAbAGUK.EFiFc8QVWKFHNwfJaYj.yPxBZ8MXGe2', 'mae', 'mae@mae.com', '1988-03-11', '2024-07-11', 1, 0),
(16, 'lea', '$2y$10$3SQ32pxC7dKogwye7iNfwux8VHH7co20c1h0XL0AKup9GjxSlHTpO', 'lea', 'lea@lea.com', '2003-12-05', '2024-07-11', 0, NULL),
(17, 'tama', '$2y$10$xEE0H72okXEPyNt5H6nEROtENuiRz5SHLC9vxfMWlKrf8jEs38CWW', 'tama', 'tama@gmail.com', '1975-01-11', '2024-07-11', 1, 1);

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
  ADD PRIMARY KEY (`id_img`);

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
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `id_characters` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `faction`
--
ALTER TABLE `faction`
  MODIFY `id_faction` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `img`
--
ALTER TABLE `img`
  MODIFY `id_img` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
