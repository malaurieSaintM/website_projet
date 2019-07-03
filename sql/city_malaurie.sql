-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 03 juil. 2019 à 13:10
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `city_malaurie`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers_faq`
--

DROP TABLE IF EXISTS `answers_faq`;
CREATE TABLE IF NOT EXISTS `answers_faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answers` varchar(255) NOT NULL,
  `id_questions` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `answers_faq`
--

INSERT INTO `answers_faq` (`id`, `answers`, `id_questions`) VALUES
(1, 'Vous pouvez vous rendre à la mairie tout les jours de la semaine sauf le dimanche', 1),
(2, 'Les horaires de la mairie sont du lundi au vendredi : 9h-17h\r\n\r\net le samedi: 9h-12h', 2),
(3, 'Pour refaire votre carte d\'identité, vous devez vous rendre dans une mairie délivrant des cartes d\'identité et ramener les documents suivants: votre carte d\'identité, photo d\'identité récente et conforme aux normes, justificatif de domicile\r\n\r\n', 3),
(4, 'Chaque année, la vile organise une journée où vous pouvez rencontrez et vous inscrire dans une association sportive', 4),
(5, 'Vous trouverez des bus et des cars, une gare, un aéroport ', 5),
(6, 'Retrouvez les heures de bus sur le site : https://www.reseau-mat.fr/', 6),
(7, 'Anticipez vos démarches, votre enfant doit être âgé entre 2 mois et 3 ans, et doit être vacciné ', 7),
(8, 'Rapprochez-vous de votre mairie et ailliez vos documents officiels (livret de famille, etc)', 8);

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `content` longtext NOT NULL,
  `summary` text NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `created_at`, `content`, `summary`, `is_published`, `image`) VALUES
(1, '« Le Crime de l’Orient Express » : rencontre avec Kenneth Branaghf', '2018-01-10', '<p>Morbi vel erat non mauris convallis vehicula. Nulla et sapien. Integer tortor tellus, aliquam faucibus, convallis id, congue eu, quam. Mauris ullamcorper felis vitae erat.sssss</p>', 'Résumé de l\'article Le Crime de l’Orient Expressssss', 1, NULL),
(2, 'Pourquoi \"Mario + Lapins Crétins : Kingdom Battle\" est le jeu de la rentrée', '2018-01-16', '<p>Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>', 'Résumé de l\'article Mario + Lapins Crétins', 0, NULL),
(3, 'Pourquoi \"Destiny 2\" est un remède à l’ultra-moderne solitude', '2018-01-14', '<p>Pellentesque rhoncus nunc et augue. Integer id felis. Curabitur aliquet pellentesque diam.</p>', ' Résumé de l\'article Destiny 2', 1, NULL),
(4, 'BO de « Les seigneurs de Dogtown » : l’époque bénie du rock.', '2018-01-03', '<p>Nulla sollicitudin. Fusce varius, ligula non tempus aliquam, nunc turpis ullamcorper nibh, in tempus sapien eros vitae ligula.</p>', 'Résumé de l\'article Les seigneurs de Dogtown', 1, NULL),
(5, 'Comment “Assassin’s Creed” trouve un nouveau souffle en Egypte', '2018-01-06', '<p>Ut velit mauris, egestas sed, gravida nec, ornare ut, mi. Aenean ut orci vel massa suscipit pulvinar.</p>', 'Résumé de l\'article Assassin’s Creed', 0, NULL),
(6, 'De “Skyrim” à “L.A. Noire” ou “Doom” : pourquoi les vieux jeux sont meilleurs sur la Switch', '2018-01-17', '<p>Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.</p>', 'Résumé de l\'article Switch', 1, NULL),
(7, 'Revue - The Ramones', '2018-01-08', '<p>Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh.</p>', 'Résumé de l\'article The Ramones', 1, NULL),
(8, 'Critique « Star Wars 8 – Les derniers Jedi » de Rian Johnson : le renouveau de la saga ?', '2018-01-01', '<p>Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue.</p>', 'Résumé de l\'article Star Wars 8', 0, NULL),
(14, 'La BO du film « Pixel »', '2018-03-07', '<p>Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>\r\n<p>Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>\r\n<p>Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>', 'Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', 1, NULL),
(15, 'Ma nouvelle basse trop stylée', '2018-04-06', 'Puis elle au moins, elle me gonfle pas.', 'Dés fois je dors avec...', 1, '9677548ee4ee2f157590053c5c5f56c4.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `article_category`
--

DROP TABLE IF EXISTS `article_category`;
CREATE TABLE IF NOT EXISTS `article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article_category`
--

INSERT INTO `article_category` (`id`, `article_id`, `category_id`) VALUES
(1, 4, 1),
(2, 4, 2),
(3, 1, 1),
(4, 2, 4),
(5, 3, 4),
(6, 5, 4),
(7, 6, 4),
(8, 7, 2),
(9, 8, 1),
(10, 14, 1),
(11, 14, 2),
(12, 14, 4),
(13, 15, 2);

-- --------------------------------------------------------

--
-- Structure de la table `bills`
--

DROP TABLE IF EXISTS `bills`;
CREATE TABLE IF NOT EXISTS `bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `files` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `categories_faq`
--

DROP TABLE IF EXISTS `categories_faq`;
CREATE TABLE IF NOT EXISTS `categories_faq` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories_faq`
--

INSERT INTO `categories_faq` (`id`, `name`) VALUES
(1, 'Vie municipale'),
(2, 'Etat civil'),
(3, 'Sport'),
(4, 'Transport'),
(5, 'Enfance');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `image`) VALUES
(1, 'Cinéma', 'Trailers, infos, sorties...', NULL),
(2, 'Musique', 'Concerts, sorties d\'albums, festivals...', NULL),
(3, 'Théâtre', '', NULL),
(4, 'Jeux vidéos', 'Videos, tests...', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `choices_problems`
--

DROP TABLE IF EXISTS `choices_problems`;
CREATE TABLE IF NOT EXISTS `choices_problems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `choices_problems`
--

INSERT INTO `choices_problems` (`id`, `description`) VALUES
(1, 'Mobiliers'),
(2, 'Revêtements'),
(3, 'Signalisations au sol'),
(4, 'Feux tricolores'),
(5, 'Panneaux'),
(6, 'Parcs'),
(7, 'Squares'),
(8, 'Aires de jeux'),
(9, 'Poubelles'),
(10, 'Ramassages'),
(11, 'Dégradations');

-- --------------------------------------------------------

--
-- Structure de la table `choices_type_problems`
--

DROP TABLE IF EXISTS `choices_type_problems`;
CREATE TABLE IF NOT EXISTS `choices_type_problems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type_problems` int(255) NOT NULL,
  `id_choices_problems` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `choices_type_problems`
--

INSERT INTO `choices_type_problems` (`id`, `id_type_problems`, `id_choices_problems`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 2, 5),
(6, 3, 6),
(7, 3, 7),
(8, 3, 8),
(9, 4, 9),
(10, 4, 10),
(11, 4, 11);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `published_at` date NOT NULL,
  `summary` text,
  `content` longtext,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `img` varchar(255) DEFAULT NULL,
  `second_img` varchar(255) DEFAULT NULL,
  `video` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `title`, `date`, `published_at`, `summary`, `content`, `is_published`, `img`, `second_img`, `video`) VALUES
(1, 'Route du Rhum', '2019-03-01', '2019-05-01', 'Suivez en direct le départ de la Route du Rhum sur la hauteur des remparts de Saint-Malo', NULL, 1, 'C:\\wamp64\\www\\saintmalo\\assets\\img\\evenement\\route.jpg', 'C:\\wamp64\\www\\saintmalo\\assets\\img\\evenement\\route.jpg', 'C:\\wamp64\\www\\city_malaurie\\assets\\videos\\saint-malo.mp4');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `caption`, `name`, `article_id`) VALUES
(19, 'View 4', 'ebe4361baf7318a92facaec817c6d0d9.jpg', 15),
(18, 'View 3', '832353270aacb6e3322f493a66aaf5b9.jpg', 15),
(16, 'View 1', 'f50ebce922538b3c57a3e6b7bbb6d628.jpg', 15),
(17, 'View 2', '1aaa7438a59157a0f21ad30dda4d4088.jpg', 15);

-- --------------------------------------------------------

--
-- Structure de la table `questions_faq`
--

DROP TABLE IF EXISTS `questions_faq`;
CREATE TABLE IF NOT EXISTS `questions_faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `id_categories` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `questions_faq`
--

INSERT INTO `questions_faq` (`id`, `question`, `id_categories`) VALUES
(1, 'Quand peut-on se rendre à la mairie ?', 1),
(2, 'Quels sont les horaires d\'ouverture de la mairie ?', 1),
(3, 'Comment refaire sa carte d\'identité ?', 2),
(4, 'Où peut-on s\'inscrire pour pratiquer une activité sportive ?', 3),
(5, 'Quels sont les transports que l\'on trouve à Saint-Malo ?', 4),
(6, 'Quelles sont les horaires de bus ?', 4),
(7, 'Comment inscrire son enfant à la crèche ?', 5),
(8, 'Comment inscrire son enfant à l\'école ?', 5);

-- --------------------------------------------------------

--
-- Structure de la table `type_problems`
--

DROP TABLE IF EXISTS `type_problems`;
CREATE TABLE IF NOT EXISTS `type_problems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_problems`
--

INSERT INTO `type_problems` (`id`, `name`) VALUES
(1, 'Voiries'),
(2, 'Signalisation'),
(3, 'Espace verts'),
(4, 'Propreté'),
(5, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(225) NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `bio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `is_admin`, `bio`) VALUES
(30, 'Admin', 'TheBrickBox', 'admin@thebrickbox.net', 'b53759f3ce692de7aff1b5779d3964da', 1, 'admin du blog'),
(31, 'User', 'TheBrickBox', 'user@thebrickbox.net', 'b53759f3ce692de7aff1b5779d3964da', 0, 'utilisateur du blog'),
(32, 'malaurie', 'saint martin', 'm.stm95280@gmail.com', 'ef1488380a4f1c3134744778c0991b8c', 0, '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
