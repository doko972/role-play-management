-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mer. 21 août 2024 à 09:07
-- Version du serveur : 8.0.37
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `u966152070_roleplay`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Support et rapport de Bug'),
(2, 'Tutorials'),
(3, 'Discussions générales'),
(4, 'Sanctuaire d\'Athéna'),
(5, 'Sanctuaire sous-marin de Poséidon'),
(6, 'Les Enfers d\'Hadès');

-- --------------------------------------------------------

--
-- Structure de la table `characters`
--

CREATE TABLE `characters` (
  `id_characters` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `story` text NOT NULL,
  `story_date` date NOT NULL,
  `main_charc` tinyint(1) NOT NULL,
  `id_faction` int NOT NULL,
  `id_user` int NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `characters`
--

INSERT INTO `characters` (`id_characters`, `name`, `story`, `story_date`, `main_charc`, `id_faction`, `id_user`, `image`) VALUES
(1, 'Athena', 'Bienvenue, vaillants Chevaliers et nobles guerriers.\n\nJe suis Athéna, déesse de la sagesse, de la stratégie et de la guerre juste. Depuis des millénaires, je veille sur l\'humanité, guidant et protégeant ceux qui cherchent la paix et la justice.\n\nAu fil des âges, des chevaliers courageux ont répondu à mon appel, revêtant les armures sacrées pour défendre la Terre contre les forces du mal. Ces chevaliers, connus sous le nom de Chevaliers d\'Athéna, incarnent les valeurs de bravoure, d\'honneur et de dévouement. Leur mission est de combattre les ténèbres et de préserver l\'équilibre entre le bien et le mal.\n\nJe vous invite, nobles âmes, à rejoindre les rangs de mes fidèles chevaliers. Que vous soyez un Chevalier de Bronze, d\'Argent ou d\'Or, votre cœur pur et votre cosmos brûlant feront de vous un défenseur digne de ce nom. Ensemble, nous affronterons les défis qui se dresseront sur notre chemin, repoussant les forces obscures d\'Hadès, les machinations de Poséidon, et toutes les menaces qui tenteront de plonger le monde dans le chaos.\n\nJe vous exhorte à embrasser votre destin avec courage et détermination. Écoutez votre cœur, suivez la voie de la justice et laissez votre cosmos s\'élever. En tant que protecteurs de la Terre, vous portez sur vos épaules le poids de l\'espoir et de la lumière.\n\nQu\'importe les épreuves, sachez que vous ne serez jamais seuls. Je serai toujours à vos côtés, guidant vos pas et renforçant votre esprit. Ensemble, nous triompherons des ténèbres et préserverons la paix et l\'harmonie sur Terre.\n\nRejoignez-moi, braves guerriers, et laissez-nous écrire ensemble l\'épopée des Chevaliers d\'Athéna. Que votre cosmos brûle ardemment et que votre courage illumine le chemin de la justice.', '2024-07-18', 1, 1, 34, '../uploads/Athena_29_-_Renderpng.jpg'),
(30, 'Poseidon', 'Salutations, nobles guerriers et protecteurs des océans.\r\n\r\nJe suis Poséidon, dieu des mers et des océans, souverain des profondeurs marines et gardien des vastes étendues aquatiques. Depuis les temps immémoriaux, je règne sur les mers, assurant leur équilibre et protégeant leurs habitants des menaces qui pèsent sur notre monde.\r\n\r\nLes eaux de la Terre sont ma demeure, et les Marinas, mes vaillants généraux et soldats, sont les protecteurs de ce royaume aquatique. Ces courageux guerriers, vêtus de leurs écailles scintillantes, se dressent contre ceux qui osent troubler la paix de nos océans. Leur devoir est de défendre les sanctuaires sous-marins et de maintenir l\'harmonie entre les éléments.\r\n\r\nJe vous invite, braves âmes, à rejoindre les rangs de mes fidèles Marinas. Que vous soyez un Général des Mers ou un soldat dévoué, votre dévouement et votre force feront de vous un défenseur digne de ce nom. Ensemble, nous lutterons contre les forces obscures et les menaces qui tentent de déstabiliser notre monde aquatique.\r\n\r\nEn tant que protecteurs des océans, vous portez en vous la puissance des vagues et la tranquillité des profondeurs. Vous devez être prêts à affronter les défis avec détermination et courage, repoussant les machinations d\'Hadès, les ambitions d\'Athéna, et toutes les forces qui tentent de perturber l\'équilibre de notre royaume.\r\n\r\nJe vous exhorte à embrasser votre destin avec ferveur et loyauté. Écoutez l\'appel des océans, laissez votre cosmos résonner avec la puissance des eaux et devenez les champions de la mer. En tant que protecteurs des océans, vous avez le pouvoir de changer le cours de l\'histoire et de préserver la beauté et la sérénité de notre monde.\r\n\r\nSachez que vous ne serez jamais seuls. Je serai toujours à vos côtés, guidant vos actions et renforçant votre esprit. Ensemble, nous triompherons des ténèbres et préserverons la paix et l\'harmonie sur Terre et dans les mers.\r\n\r\nRejoignez-moi, courageux guerriers, et laissez-nous écrire ensemble l\'épopée des Marinas de Poséidon. Que votre cosmos brille avec la force des océans et que votre détermination éclaire le chemin de la justice.', '2024-07-18', 1, 2, 39, '../uploads/66993565df30f_Poseidon-full.jpg'),
(33, 'General de l\'Hippocampe', 'Je suis Beber, Général de l&#039;Hippocampe, le gardien des abysses et défenseur du Pilier de l&#039;Océan Atlantique Nord.\r\n\r\nSous le règne de Poséidon, mon devoir sacré est de protéger les océans et d&#039;assurer l&#039;équilibre des forces entre les mers et la terre. Ma force et ma détermination sont aussi puissantes que les vagues déchaînées, et mon armure d&#039;écaille brille d&#039;une lueur marine, symbole de la puissance de l&#039;Hippocampe, une créature mythologique née des profondeurs.\r\n\r\nSous les flots, je suis le souverain des eaux impétueuses, celui qui commande aux courants marins et aux tempêtes. Ceux qui osent défier Poséidon et menacer l&#039;harmonie des océans devront affronter ma colère. Mes techniques de combat sont aussi imprévisibles que la mer elle-même, capable de détruire les ennemis de l&#039;empereur des mers d&#039;une seule attaque. Comme le gardien des secrets des abysses, je veille sur les trésors de l&#039;océan et préserve le sanctuaire du dieu des mers.\r\n\r\nFidèle à mon rôle, je suis un guerrier d&#039;une loyauté sans faille envers Poséidon. Je lutte non seulement pour protéger notre domaine, mais aussi pour assurer que l&#039;ordre divin soit maintenu. Mon esprit est aussi serein que les eaux calmes, mais dès que le danger approche, je deviens l&#039;ouragan qui balaye tout sur son passage.\r\n\r\nAinsi, je suis Beber, le Général de l&#039;Hippocampe, l&#039;incarnation de la puissance et de la majesté de l&#039;océan, prêt à défendre mon seigneur et à anéantir tous ceux qui oseraient perturber la paix des eaux sacrées.', '2024-08-18', 1, 2, 42, '../uploads/66c204cd57af1_bis-armmer-chevaldesmers-removebg-preview.png'),
(50, 'Hades', 'Bienvenue, intrépide visiteur. Tu te tiens à présent devant moi, Hadès, le dieu des Enfers et souverain des âmes perdues. Mon royaume s&#039;étend bien au-delà de la compréhension des mortels, un lieu où les âmes des défunts trouvent leur repos éternel ou subissent les tourments de leurs actions passées.\r\n\r\nDepuis des millénaires, je veille sur cet empire de ténèbres avec une main de fer, garantissant que l&#039;équilibre entre la vie et la mort demeure intact. Ici, dans les profondeurs des Enfers, les illusions de la vie terrestre se dissipent, laissant place à la vérité absolue.\r\n\r\nChevalier, si tu as osé pénétrer dans mon domaine, c&#039;est que ton destin te mène vers une épreuve décisive. Chaque âme qui traverse les rives du Styx doit prouver sa valeur. Les flammes infernales de cet endroit révèlent la véritable nature des êtres, testant leur courage et leur détermination.\r\n\r\nDans ce monde d&#039;ombre et de mystère, trois factions principales s&#039;affrontent pour la suprématie : les vaillants Chevaliers d&#039;Athéna, les puissants Marinas de Poséidon, et mes redoutables Spectres. Chacune de ces factions aspire à la domination, mais seul le plus fort triomphera.\r\n\r\nChevalier, choisis ta voie avec sagesse. Seras-tu un serviteur fidèle de la justice sous la bannière d&#039;Athéna ? Un guerrier intrépide des profondeurs marines de Poséidon ? Ou rejoindras-tu mes rangs, embrassant le pouvoir sombre et incommensurable des Spectres ?\r\n\r\nPrépare-toi à affronter des épreuves que nul vivant ne pourrait imaginer. Ton courage, ta détermination et ta loyauté seront mis à l&#039;épreuve à chaque instant. Mais souviens-toi, même au cœur des ténèbres les plus profondes, une lueur d&#039;espoir peut briller. Seuls les plus braves et les plus dignes peuvent espérer triompher des défis des Enfers et gagner peut-être ma faveur.\r\n\r\nApproche avec révérence, et que les ombres te guident dans ta quête. Bienvenue dans mon royaume, chevalier. Puisses-tu trouver la force de surmonter les ténèbres et découvrir la véritable nature de ton âme.\r\n', '2024-08-16', 1, 3, 33, '../uploads/66b0a42c77e50_Hades2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `faction`
--

CREATE TABLE `faction` (
  `id_faction` int NOT NULL,
  `faction_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `faction`
--

INSERT INTO `faction` (`id_faction`, `faction_name`) VALUES
(1, 'Athena'),
(2, 'Poseidon'),
(3, 'Hades');

-- --------------------------------------------------------

--
-- Structure de la table `img`
--

CREATE TABLE `img` (
  `id_img` int NOT NULL,
  `file` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `alternatif_txt` varchar(50) DEFAULT NULL,
  `id_faction` int NOT NULL,
  `taken_by_user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `img`
--

INSERT INTO `img` (`id_img`, `file`, `name`, `class`, `alternatif_txt`, `id_faction`, `taken_by_user_id`) VALUES
(1, 'img/dieux/athena.jpg', 'Deesse Athena', 'Deesse de la Guerre', 'Deesse de la Guerre', 1, 34),
(2, 'img/gold/grandpope.jpg', 'Grand Pope', 'Grand Pope', 'Grand pope gardien du sanctuaire', 1, NULL),
(3, 'img/gold/belier.webp', 'Chevalier du Belier', 'Chevalier d\'Or', 'Chevalier d\'Or du Belier', 1, NULL),
(4, 'img/gold/balance.webp', 'Chevalier de la Balance', 'Chevalier d\'Or', 'Chevalier d\'Or de la Balance', 1, NULL),
(5, 'img/gold/cancer.webp', 'Chevalier du Cancer', 'Chevalier d\'Or', 'Chevalier d\'Or du Cancer', 1, NULL),
(6, 'img/gold/capricorne.webp', 'Chevalier du Capricorne', 'Chevalier d\'Or', 'Chevalier d\'Or du Capricorne', 1, NULL),
(7, 'img/gold/gemeaux.webp', 'Chevalier des Gemeaux', 'Chevalier d\'Or', 'Chevalier d\'Or du Gemeaux', 1, NULL),
(8, 'img/gold/lion.webp', 'Chevalier du Lion', 'Chevalier d\'Or', 'Chevalier d\'Or du Lion', 1, NULL),
(9, 'img/gold/poissons.webp', 'Chevalier des Poissons', 'Chevalier d\'Or', 'Chevalier d\'Or des Poissons', 1, NULL),
(10, 'img/gold/sagittaire.webp', 'Chevalier du Sagittaire', 'Chevalier d\'Or', 'Chevalier d\'Or du Sagittaire', 1, NULL),
(11, 'img/gold/scorpion.webp', 'Chevalier du Scorpion', 'Chevalier d\'Or', 'Chevalier d\'Or du Scorpion', 1, NULL),
(12, 'img/gold/taureau.webp', 'Chevalier du Taureau', 'Chevalier d\'Or', 'Chevalier d\'Or du Taureau', 1, NULL),
(13, 'img/gold/verseau.webp', 'Chevalier du Verseau', 'Chevalier d\'Or', 'Chevalier d\'Or du Verseau', 1, NULL),
(14, 'img/gold/vierge.webp', 'Chevalier de la Vierge', 'Chevalier d\'Or', 'Chevalier d\'Or du Vierge', 1, NULL),
(15, 'img/argent/aigle.webp', 'Chevalier de l\'Aigle', 'Chevalier d\'Argent', 'Chevalier d\'Argent de l\'Aigle', 1, NULL),
(16, 'img/argent/centaure.webp', 'Chevalier du Centaure', 'Chevalier d\'Argent', 'Chevalier d\'Argent du Centaure', 1, NULL),
(17, 'img/argent/corbeau.webp', 'Chevalier du Corbeau', 'Chevalier d\'Argent', 'Chevalier d\'Argent du Corbeau', 1, NULL),
(18, 'img/argent/fleche.webp', 'Chevalier de la Fleche', 'Chevalier d\'Argent', 'Chevalier d\'Argent de la Fleche', 1, NULL),
(19, 'img/argent/lyre.webp', 'Chevalier de la Lyre', 'Chevalier d\'Argent', 'Chevalier d\'Argent de la Lyre', 1, NULL),
(20, 'img/argent/persee.webp', 'Chevalier de Persee', 'Chevalier d\'Argent', 'Chevalier d\'Argent de Persee', 1, NULL),
(21, 'img/argent/misty.jpg', 'Chevalier du Lezard', 'Chevalier d\'Argent', 'Chevalier d\'argent du lezard', 1, NULL),
(22, 'img/bronze/pegase.webp', 'Chevalier de Pegase', 'Chevalier de Bronze', 'Chevalier de Bronze de Pegase', 1, NULL),
(23, 'img/bronze/dragon.webp', 'Chevalier du Dragon', 'Chevalier de Bronze', 'Chevalier de Bronze de Dragon', 1, NULL),
(24, 'img/bronze/cygne.webp', 'Chevalier du Cygne', 'Chevalier de Bronze', 'Chevalier de Bronze de Cygne', 1, NULL),
(25, 'img/bronze/andromede.webp', 'Chevalier d\'Andromede', 'Chevalier de Bronze', 'Chevalier de Bronze de Andromede', 1, NULL),
(26, 'img/bronze/phoenix.webp', 'Chevalier du Phoenix', 'Chevalier de Bronze', 'Chevalier de Bronze de Phoenix', 1, NULL),
(30, 'img/marinas/poseidon.jpg', 'Dieu Poseidon', 'Dieux des Mers', 'Dieux des Mers', 2, 39),
(31, 'img/marinas/ddm.jpg', 'General Dragon des Mers', 'General', 'General du Dragon des Mers', 2, NULL),
(32, 'img/marinas/chrysaor.jpg', 'General du Chrysaor', 'General', 'General de Chrysaor', 2, NULL),
(33, 'img/marinas/hipocampe.jpg', 'General de l\'Hippocampe', 'General', 'General du Cheval des Mers', 2, 42),
(34, 'img/marinas/kraken.jpg', 'General du Kraken', 'General', 'General de Kraken', 2, NULL),
(35, 'img/marinas/scylla.jpg', 'General de Scylla', 'General', 'General de Scylla', 2, NULL),
(36, 'img/marinas/sorrento.jpg', 'General dela Sirene', 'General', 'General de la Sirene', 2, NULL),
(50, 'img/spectres/hades.jpg', 'Dieu Hades', 'Dieux des enfers', 'doeux des enfers', 3, 33),
(51, 'img/spectres/pandore.jpg', 'Pandore', 'commandante de l\'armée d\'Hadès', 'pandore commandante de l\'armée d\'Hadès', 3, NULL),
(52, 'img/spectres/wyvern.jpg', 'Spectres du Wyverne', 'de l\'etoile Celeste de la Ferocite', 'Spectres du Wyverne', 3, NULL),
(53, 'img/spectres/griffon.jpg', 'Spectres du Griffon', 'de l\'etoile Celeste de la Noblesse', 'Spectres du Griffon', 3, NULL),
(54, 'img/spectres/garuda.jpg', 'Spectres du Garuda', 'de l\'etoile Celeste de la Vaillance', 'Spectres du Garuda', 3, NULL),
(55, 'img/spectres/balron.jpg', 'Spectres du Balron', 'de l\'etoile Celeste de l\'Excellence', 'Spectres du Balron', 3, NULL),
(56, 'img/spectres/sphinx.jpg', 'Spectres du Sphinx', 'de l\'etoile Celeste de l\'animalite', 'Spectres du Sphinx', 3, NULL),
(57, 'img/spectres/papillon.jpg', 'Spectres du Papillon', 'de l\'etoile terrestre enchanteresse', 'Spectres du Papillon', 3, NULL),
(58, 'img/spectres/harpie.jpg', 'Spectres de la Harpie', 'de l\'etoile Celeste de la lamentation', 'Spectres de la Harpie', 3, NULL),
(59, 'img/spectres/deep.jpg', 'Spectres de Deep', 'de l\'etoile terrestre de l\'obscurite', 'Spectres de Deep', 3, NULL),
(60, 'img/spectres/gigant.jpg', 'Spectres du Cyclope', 'de l\'etoile terrestre de la Violence', 'Spectres du Cyclope', 3, NULL),
(61, 'img/spectres/basilic.jpg', 'Spectres du Basilic', 'de l\'etoile Celeste de la victoire', 'Spectres du Basilic', 3, NULL),
(62, 'img/spectres/alraune.jpg', 'Spectres de Alraune', 'de l\'etoile Celeste de la magie', 'Spectres de Alraune', 3, NULL),
(63, 'img/spectres/acheron.jpg', 'Spectres de Acheron', 'de l\'etoile Celeste de l\'intervalle', 'Spectres de Acheron', 3, NULL),
(65, '../uploads/hades.png', 'hades.png', '', '', 1, NULL),
(66, '../uploads/Poseidon-full.jpg', 'Poseidon-full.jpg', '', '', 1, NULL),
(67, '../uploads/Athena_29_-_Renderpng.webp', 'Athena_29_-_Renderpng.webp', '', '', 1, NULL),
(74, '../uploads/2024-01-19_00-09-05.jpg', '2024-01-19_00-09-05.jpg', '', '', 1, NULL),
(75, '../uploads/Had_s144.webp', 'Had_s144.webp', '', '', 1, NULL),
(76, '../uploads/2024-06-13_10-40-42.jpg', '2024-06-13_10-40-42.jpg', '', '', 1, NULL),
(77, '../uploads/2024-06-16_15-14-59.jpg', '2024-06-16_15-14-59.jpg', '', '', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `content` text NOT NULL,
  `topic_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `image_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `content`, `topic_id`, `created_at`, `user_id`, `image_id`) VALUES
(16, 'Salutations, nobles guerriers et protecteurs des océans.\r\n\r\nJe suis Poséidon, dieu des mers et des océans, souverain des profondeurs marines et gardien des vastes étendues aquatiques. Depuis les temps immémoriaux, je règne sur les mers, assurant leur équilibre et protégeant leurs habitants des menaces qui pèsent sur notre monde.\r\n\r\nLes eaux de la Terre sont ma demeure, et les Marinas, mes vaillants généraux et soldats, sont les protecteurs de ce royaume aquatique. Ces courageux guerriers, vêtus de leurs écailles scintillantes, se dressent contre ceux qui osent troubler la paix de nos océans. Leur devoir est de défendre les sanctuaires sous-marins et de maintenir l\'harmonie entre les éléments.\r\n\r\nJe vous invite, braves âmes, à rejoindre les rangs de mes fidèles Marinas. Que vous soyez un Général des Mers ou un soldat dévoué, votre dévouement et votre force feront de vous un défenseur digne de ce nom. Ensemble, nous lutterons contre les forces obscures et les menaces qui tentent de déstabiliser notre monde aquatique.\r\n\r\nEn tant que protecteurs des océans, vous portez en vous la puissance des vagues et la tranquillité des profondeurs. Vous devez être prêts à affronter les défis avec détermination et courage, repoussant les machinations de Hadès, les ambitions d\'Athéna, et toutes les forces qui tentent de perturber l\'équilibre de notre royaume.\r\n\r\nJe vous exhorte à embrasser votre destin avec ferveur et loyauté. Écoutez l\'appel des océans, laissez votre cosmos résonner avec la puissance des eaux et devenez les champions de la mer. En tant que protecteurs des océans, vous avez le pouvoir de changer le cours de l\'histoire et de préserver la beauté et la sérénité de notre monde.\r\n\r\nSachez que vous ne serez jamais seuls. Je serai toujours à vos côtés, guidant vos actions et renforçant votre esprit. Ensemble, nous triompherons des ténèbres et préserverons la paix et l\'harmonie sur Terre et dans les mers.\r\n\r\nRejoignez-moi, courageux guerriers, et laissez-nous écrire ensemble l\'épopée des Marinas de Poséidon. Que votre cosmos brille avec la force des océans et que votre détermination éclaire le chemin de la justice.', 9, '2024-07-18 16:33:44', 35, 66),
(17, 'Bienvenue, vaillants Chevaliers et nobles guerriers.\r\n\r\nJe suis Athéna, déesse de la sagesse, de la stratégie et de la guerre juste. Depuis des millénaires, je veille sur l\'humanité, guidant et protégeant ceux qui cherchent la paix et la justice.\r\n\r\nAu fil des âges, des chevaliers courageux ont répondu à mon appel, revêtant les armures sacrées pour défendre la Terre contre les forces du mal. Ces chevaliers, connus sous le nom de Chevaliers d\'Athéna, incarnent les valeurs de bravoure, d\'honneur et de dévouement. Leur mission est de combattre les ténèbres et de préserver l\'équilibre entre le bien et le mal.\r\n\r\nJe vous invite, nobles âmes, à rejoindre les rangs de mes fidèles chevaliers. Que vous soyez un Chevalier de Bronze, d\'Argent ou d\'Or, votre cœur pur et votre cosmos brûlant feront de vous un défenseur digne de ce nom. Ensemble, nous affronterons les défis qui se dresseront sur notre chemin, repoussant les forces obscures de Hadès, les machinations de Poséidon, et toutes les menaces qui tenteront de plonger le monde dans le chaos.\r\n\r\nJe vous exhorte à embrasser votre destin avec courage et détermination. Écoutez votre cœur, suivez la voie de la justice et laissez votre cosmos s\'élever. En tant que protecteurs de la Terre, vous portez sur vos épaules le poids de l\'espoir et de la lumière.\r\n\r\nQu\'importe les épreuves, sachez que vous ne serez jamais seuls. Je serai toujours à vos côtés, guidant vos pas et renforçant votre esprit. Ensemble, nous triompherons des ténèbres et préserverons la paix et l\'harmonie sur Terre.\r\n\r\nRejoignez-moi, braves guerriers, et laissez-nous écrire ensemble l\'épopée des Chevaliers d\'Athéna. Que votre cosmos brûle ardemment et que votre courage illumine le chemin de la justice.', 10, '2024-07-18 16:37:44', 35, 67),
(25, 'Bienvenue, mortel. Tu te tiens à présent devant Hadès, le souverain impitoyable des Enfers. Dans ce royaume de ténèbres éternelles, où les âmes damnées trouvent leur repos final, je règne en maître absolu. Ici, au cœur de l&#039;obscurité, les illusions de la vie terrestre se dissipent, et seule la vérité des profondeurs demeure.\r\n\r\nChevalier, si tu es parvenu jusqu&#039;ici, c&#039;est que ton destin te conduit à un tournant crucial. Les flammes infernales de ce royaume dévoilent les vérités cachées et testent la pureté de ton âme. Ceux qui osent défier les lois immuables de la mort doivent prouver leur valeur, car ce domaine n&#039;accorde ni pitié ni pardon.\r\n\r\nPrépare-toi à affronter des épreuves que nul vivant ne pourrait imaginer. Ton courage, ta détermination et ta loyauté seront mis à l&#039;épreuve à chaque instant. Mais souviens-toi, même au cœur des ténèbres les plus profondes, une lueur d&#039;espoir peut briller. Seuls les plus braves et les plus dignes peuvent espérer triompher des défis des Enfers et peut-être, gagner la faveur du sombre souverain que je suis.\r\n\r\nApproche avec révérence, et que les ombres te guident dans ta quête. Bienvenue dans mon royaume, chevalier. Puisses-tu trouver la force de surmonter les ténèbres et découvrir la véritable nature de ton âme.', 8, '2024-08-05 15:23:06', 33, 75),
(29, 'nouveau post\r\nou pas', 11, '2024-08-08 09:20:16', 33, 77),
(30, 'Nouveau POst de test', 8, '2024-08-09 08:33:34', 33, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

CREATE TABLE `topics` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`id`, `title`, `category_id`, `created_at`) VALUES
(8, 'Bienvenue mes Spectres', 6, '2024-08-07 09:24:43'),
(9, 'Venez à moi mes Marinas', 5, '2024-08-07 09:24:43'),
(10, 'Venez pres de votre deesse', 4, '2024-08-07 09:24:43'),
(11, 'test de msg', 1, '2024-08-07 09:29:09');

-- --------------------------------------------------------

--
-- Structure de la table `to_ban`
--

CREATE TABLE `to_ban` (
  `id_ban` int NOT NULL,
  `status` int NOT NULL,
  `ban_time` datetime NOT NULL,
  `reason` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `login` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  `passwd` varchar(64) NOT NULL,
  `truename` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `birthday` date NOT NULL,
  `creatime` date NOT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT '0',
  `faction_id` int NOT NULL,
  `selected_card` int DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `login`, `passwd`, `truename`, `email`, `birthday`, `creatime`, `is_online`, `faction_id`, `selected_card`, `last_activity`, `role`) VALUES
(33, 'hades972', '$2y$10$UCYBOslM/gQNpdLVw1H35e/NiQVoJf31.JRQAjosA9Ex9j6LvyJ9C', 'Hades', 'doko@gmail.com', '1975-11-01', '2024-07-18', 0, 3, 50, '2024-08-16 14:19:32', 'admin'),
(34, 'Athena', '$2y$10$xAUubhT.h3Bxpq6EOwcv3e0uzxN1berq9Mw9vozUj3TKm4R2FDi12', 'Athena', 'athena@gmail.com', '2002-10-01', '2024-07-18', 0, 1, 1, '2024-08-07 08:34:34', 'admin'),
(36, 'SupaCat_Mania', '$2y$10$HoRBEHSdQEL3ZJfDEARV1OZ6VTS.r8kROMxoh4yvDsZQ3/Rwn8sli', 'bip', 'CompteSaintSeiya@gmail.com', '2005-06-04', '2024-07-19', 0, 1, NULL, '2024-07-25 11:17:48', 'user'),
(37, 'Merhunes', '$2y$10$A/gwdUmGiz3Liv034NV3oeJXazGCVyklU2QB4eGlFxH7.cTseq1RC', 'Eric', 'ericrom@hotmail.fr', '1979-07-17', '2024-07-24', 0, 2, 34, '2024-07-25 11:17:48', 'user'),
(39, 'podjeidon', '$2y$10$Z0g4Z6R1aOyR9ukZeAS0SOcnH/7Yn303sBGZHjczzUp3MM7x/MopO', 'Poséïdon', 'podjeidon@gmail.com', '1983-01-01', '2024-08-04', 0, 2, 30, '2024-07-25 11:17:48', 'admin'),
(40, 'wyvern', '$2y$10$K2z3XxsBcWfTblcVxcTrQONsijxNwvaC//40q0PCT0idogmDVByNW', 'wyvern', 'ynglng0408@gmail.com', '2002-05-04', '2024-08-04', 0, 3, 52, '2024-07-25 11:17:48', 'user'),
(41, 'jean', '$2y$10$gBj4EVS6zsw5S.Kn7LBbtecTdgROUpqwLjTYdkLMhdURSR/TCkSgq', 'jean', 'jean@gmail.com', '2000-01-01', '2024-08-07', 0, 1, NULL, '2024-08-07 08:35:42', 'user'),
(42, 'beber', '$2y$10$6Fql8Iw121di/dB6c.P0BuzaHdHcBj9X5KExtUII671AT56uHsX2q', 'beber', 'beber@gmail.com', '2000-02-01', '2024-08-17', 0, 1, 33, NULL, 'user'),
(43, 'beber', '$2y$10$yFW77e.OyWxTMqFNWq89wOHR1uQv8eNpugBED/f4cKIduzP3YGkWO', 'beber', 'beber@gmail.com', '2000-02-01', '2024-08-17', 0, 1, NULL, NULL, 'user'),
(44, 'beber', '$2y$10$oTabUn/Mhwl0m1/A8uJAO.Xw4fdHG2CDN1Y5mJZBgqCdwVQeXPyHK', 'beber', 'beber@gmail.com', '2000-02-01', '2024-08-17', 0, 1, NULL, NULL, 'user'),
(45, 'beber', '$2y$10$G.yxL9WK1RVMsQGfrDRBZOhNhsHmDL5tOXkWcqnqzKxDBFxP/ujKm', 'beber', 'beber@gmail.com', '2000-02-01', '2024-08-17', 0, 1, NULL, NULL, 'user'),
(46, 'beber', '$2y$10$xCnY0tkbluMx.fin3jWZA.Qa8XjLG387t0bqSxnpdncI9fWc76pWe', 'beber', 'beber@gmail.com', '2000-02-01', '2024-08-17', 0, 1, NULL, NULL, 'user'),
(47, 'beber', '$2y$10$4Y7hSFWhYy/1TFg9KV/g.O6qQA3OxIOCLF1XlqFhfSQnHx0ErWZ.K', 'beber', 'beber@gmail.com', '2000-02-01', '2024-08-17', 0, 1, NULL, NULL, 'user'),
(48, 'joseto', '$2y$10$ud.GK/ZaxsvqHqT2cmZAgeuDPWKKjJCWZdyyF6wCLA9agi6Z32PVu', 'joseto', 'joseto@gmail.com', '2002-02-02', '2024-08-18', 1, 2, NULL, NULL, 'user'),
(49, 'popo', '$2y$10$J1b2tEMmJS42TwyyhE0RiOBZH1heceZifiiqFuKaH29wPsWkh2poq', 'popo', 'popo@popo.com', '2005-05-05', '2024-08-19', 0, 1, NULL, NULL, 'user'),
(50, 'fififi', '$2y$10$k6nSpSqJhQMwrdVrJwiwSuUT4ghDJcFHHqFQTSDTGjk9R53geumIW', 'fififi', 'fififi@fififi.com', '2006-06-06', '2024-08-19', 1, 3, NULL, NULL, 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id_characters`),
  ADD KEY `id_faction` (`id_faction`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `faction`
--
ALTER TABLE `faction`
  ADD PRIMARY KEY (`id_faction`);

--
-- Index pour la table `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id_img`),
  ADD KEY `fk_faction` (`id_faction`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Index pour la table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `to_ban`
--
ALTER TABLE `to_ban`
  ADD PRIMARY KEY (`id_ban`,`status`),
  ADD KEY `id_user_administrator` (`status`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `characters`
--
ALTER TABLE `characters`
  MODIFY `id_characters` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `faction`
--
ALTER TABLE `faction`
  MODIFY `id_faction` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `img`
--
ALTER TABLE `img`
  MODIFY `id_img` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `characters`
--
ALTER TABLE `characters`
  ADD CONSTRAINT `characters_ibfk_1` FOREIGN KEY (`id_faction`) REFERENCES `faction` (`id_faction`),
  ADD CONSTRAINT `characters_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Contraintes pour la table `img`
--
ALTER TABLE `img`
  ADD CONSTRAINT `fk_faction` FOREIGN KEY (`id_faction`) REFERENCES `faction` (`id_faction`);

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`);

--
-- Contraintes pour la table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `to_ban`
--
ALTER TABLE `to_ban`
  ADD CONSTRAINT `to_ban_ibfk_1` FOREIGN KEY (`id_ban`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `to_ban_ibfk_2` FOREIGN KEY (`status`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
