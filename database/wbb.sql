-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 14 Juillet 2014 à 10:35
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `wbb`
--
CREATE DATABASE IF NOT EXISTS `wbb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `wbb`;

-- --------------------------------------------------------

--
-- Structure de la table `bars_news`
--

CREATE TABLE IF NOT EXISTS `bars_news` (
  `bar_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  PRIMARY KEY (`bar_id`,`news_id`),
  KEY `IDX_F848BD9289A253A` (`bar_id`),
  KEY `IDX_F848BD92B5A459A0` (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `bestofs_news`
--

CREATE TABLE IF NOT EXISTS `bestofs_news` (
  `bestof_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  PRIMARY KEY (`bestof_id`,`news_id`),
  KEY `IDX_C4C10831DD8BC253` (`bestof_id`),
  KEY `IDX_C4C10831B5A459A0` (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cities_news`
--

CREATE TABLE IF NOT EXISTS `cities_news` (
  `city_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  PRIMARY KEY (`city_id`,`news_id`),
  KEY `IDX_3F44455D8BAC62AF` (`city_id`),
  KEY `IDX_3F44455DB5A459A0` (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media__gallery`
--

CREATE TABLE IF NOT EXISTS `media__gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `context` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `default_format` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `media__gallery_media`
--

CREATE TABLE IF NOT EXISTS `media__gallery_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_80D4C5414E7AF8F` (`gallery_id`),
  KEY `IDX_80D4C541EA9FDD75` (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `media__media`
--

CREATE TABLE IF NOT EXISTS `media__media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `enabled` tinyint(1) NOT NULL,
  `provider_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_status` int(11) NOT NULL,
  `provider_reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider_metadata` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `length` decimal(10,0) DEFAULT NULL,
  `content_type` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_size` int(11) DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `context` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cdn_is_flushable` tinyint(1) DEFAULT NULL,
  `cdn_flush_at` datetime DEFAULT NULL,
  `cdn_status` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=161 ;

--
-- Contenu de la table `media__media`
--

INSERT INTO `media__media` (`id`, `name`, `description`, `enabled`, `provider_name`, `provider_status`, `provider_reference`, `provider_metadata`, `width`, `height`, `length`, `content_type`, `content_size`, `copyright`, `author_name`, `context`, `cdn_is_flushable`, `cdn_flush_at`, `cdn_status`, `updated_at`, `created_at`) VALUES
(1, '798cbbd9e3a89366.jpg', NULL, 0, 'sonata.media.provider.image', 1, '160f4da363431d5455172a48eaa906705b91c768.jpeg', '{"filename":"798cbbd9e3a89366.jpg"}', 600, 401, NULL, 'image/jpeg', 59171, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-05 14:36:27', '2014-06-05 14:36:27'),
(2, '3_7_651027174.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'c18f5744c5e2b5e306f63ee1f435a80b532c5fad.jpeg', '{"filename":"congress_hotel_venue_search_Sofitel_Agadir_Royalbay_Resort_5707y03_7_651027174.jpg"}', 346, 260, NULL, 'image/jpeg', 23461, NULL, NULL, 'default', 0, NULL, NULL, '2014-06-09 09:57:49', '2014-06-05 14:36:48'),
(3, 'Sofitel-Agadir-1.jpg', NULL, 0, 'sonata.media.provider.image', 1, '58e18ccf3ae428efbee7f876210b1bb9c9952bf4.jpeg', '{"filename":"Sofitel-Agadir-1.jpg"}', 430, 322, NULL, 'image/jpeg', 23910, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-05 14:38:52', '2014-06-05 14:38:52'),
(4, 'natalie_dormer_2.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'c3bc703344ef6af5dcc00c40cd08a400d06bc063.jpeg', '{"filename":"natalie_dormer_2.jpg"}', 2123, 3000, NULL, 'image/jpeg', 667766, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-05 14:39:42', '2014-06-05 14:39:42'),
(5, '019.jpg', NULL, 0, 'sonata.media.provider.image', 1, '2bc3b89157fe1e4deaca225b6bd302df7d22128b.jpeg', '{"filename":"019.jpg"}', 604, 453, NULL, 'image/jpeg', 53341, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-05 14:41:30', '2014-06-05 14:41:30'),
(6, '019.jpg', NULL, 0, 'sonata.media.provider.image', 1, '51f61c037f9ad1599151d84ab484b6f3fe64b3ff.jpeg', '{"filename":"019.jpg"}', 604, 453, NULL, 'image/jpeg', 53341, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-08 00:07:03', '2014-06-08 00:07:03'),
(7, 'Intro_table.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'e4f542250ba0b6863ecdbc3f101c1ec925a51251.jpeg', '{"filename":"Intro_table.jpg"}', 2000, 1300, NULL, 'image/jpeg', 685990, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-08 11:37:57', '2014-06-08 11:37:57'),
(8, 'Intro_table.jpg', NULL, 0, 'sonata.media.provider.image', 1, '9d15b871efd404c46f658100b0cc496fdfafdfd6.jpeg', '{"filename":"Intro_table.jpg"}', 2000, 1300, NULL, 'image/jpeg', 685990, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-08 11:37:59', '2014-06-08 11:37:59'),
(9, 'bdb.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'd54336197d164fd20ee3e1818db0cf3266be8f70.jpeg', '{"filename":"bdb.jpg"}', 1103, 285, NULL, 'image/jpeg', 104308, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-09 11:37:25', '2014-06-09 11:37:25'),
(10, '1.jpg', NULL, 0, 'sonata.media.provider.image', 1, '574bf508c17c90ae96d7b3315e10a96079df2260.jpeg', '{"filename":"1.jpg"}', 1280, 960, NULL, 'image/jpeg', 549053, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-09 11:51:55', '2014-06-09 11:51:55'),
(11, '3.jpg', NULL, 0, 'sonata.media.provider.image', 1, '6672f0e79edcbcc8c84c2dd3fb06d9766daa3865.jpeg', '{"filename":"3.jpg"}', 640, 480, NULL, 'image/jpeg', 91349, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-09 11:53:16', '2014-06-09 11:53:16'),
(12, '1.jpg', NULL, 0, 'sonata.media.provider.image', 1, '2f34e3f8e10956cf8feb12cecf6d8c8ff42b6a91.jpeg', '{"filename":"1.jpg"}', 1280, 960, NULL, 'image/jpeg', 549053, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-09 11:54:36', '2014-06-09 11:54:36'),
(13, '3.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'c20c23a5a6676b1f70557f168c947f2014db09ca.jpeg', '{"filename":"3.jpg"}', 640, 480, NULL, 'image/jpeg', 91349, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-09 11:55:29', '2014-06-09 11:55:29'),
(14, '1.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'db62efc83b46676d76dfa6f0e420da2598b5d406.jpeg', '{"filename":"1.jpg"}', 1280, 960, NULL, 'image/jpeg', 549053, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-10 07:55:02', '2014-06-10 07:55:02'),
(15, '2.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'e4e8b4c5191a8085906e0cf3ffdd8b794081d186.jpeg', '{"filename":"2.jpg"}', 640, 480, NULL, 'image/jpeg', 139645, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-10 07:55:19', '2014-06-10 07:55:19'),
(16, '3.jpg', NULL, 0, 'sonata.media.provider.image', 1, '04fedf8357edf6fff2968fc9fb6f47cb7b6e4094.jpeg', '{"filename":"3.jpg"}', 640, 480, NULL, 'image/jpeg', 91349, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-10 07:55:32', '2014-06-10 07:55:32'),
(17, '5.jpg', NULL, 0, 'sonata.media.provider.image', 1, '544cc159eb263b3252e3158194ddf832945aef51.jpeg', '{"filename":"5.jpg"}', 640, 480, NULL, 'image/jpeg', 71012, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-10 07:55:44', '2014-06-10 07:55:44'),
(18, '5.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'd05ffb4cb1aa07bf234605ac37213a44f10dbbe9.jpeg', '{"filename":"5.jpg"}', 640, 480, NULL, 'image/jpeg', 71012, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-10 07:55:57', '2014-06-10 07:55:57'),
(19, '1.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'e8a232e18d3067813fc76711fd0088a539067f64.jpeg', '{"filename":"1.jpg"}', 1280, 960, NULL, 'image/jpeg', 549053, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-10 07:56:09', '2014-06-10 07:56:09'),
(20, '2.jpg', NULL, 0, 'sonata.media.provider.image', 1, '16abff7b933a28e98de394c9c711e24d8fe65ccf.jpeg', '{"filename":"2.jpg"}', 640, 480, NULL, 'image/jpeg', 139645, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-13 13:23:31', '2014-06-13 13:23:31'),
(21, '5.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'de601a56719344aed91018f48c18a7ab5fb3dca1.jpeg', '{"filename":"5.jpg"}', 640, 480, NULL, 'image/jpeg', 71012, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-13 13:24:30', '2014-06-13 13:24:30'),
(22, 'hero-the_bar.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'f23abff745bc7f7418583d00d795c943d7bbd978.jpeg', '{"filename":"hero-the_bar.jpg"}', 1500, 1000, NULL, 'image/jpeg', 530733, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-13 13:24:58', '2014-06-13 13:24:58'),
(23, 'Cape-Horn-bar-5.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'cdbca8287d6c7600bcff28d277ca3f32da91f008.jpeg', '{"filename":"Cape-Horn-bar-5.jpg"}', 1500, 998, NULL, 'image/jpeg', 601802, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-13 13:25:17', '2014-06-13 13:25:17'),
(24, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, '936f36ba6462afb189d6be2e0876500d777c47db.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-13 13:32:58', '2014-06-13 13:32:58'),
(25, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, '6ea2cd9f78318909180466ff3d56d1c44ead4542.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-13 13:34:31', '2014-06-13 13:34:31'),
(26, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, '92b53072d60d876da411eb79a83459871cc9b548.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-13 16:17:59', '2014-06-13 16:17:59'),
(27, 'Cape-Horn-bar-5.jpg', NULL, 0, 'sonata.media.provider.image', 1, '456bbd310018833c0d9fde500b50f547794aba38.jpeg', '{"filename":"Cape-Horn-bar-5.jpg"}', 1500, 998, NULL, 'image/jpeg', 601802, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-13 16:20:36', '2014-06-13 16:20:36'),
(28, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, 'b7716367abdce7d20ecf673079a4eee06c85bdd2.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-13 16:21:37', '2014-06-13 16:21:37'),
(29, 'Cape-Horn-bar-5.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'f9efbd0d24ee745973699408e68c39788999f8bc.jpeg', '{"filename":"Cape-Horn-bar-5.jpg"}', 1500, 998, NULL, 'image/jpeg', 601802, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-14 15:28:12', '2014-06-14 15:28:12'),
(30, '2.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'e32f7ce835a13308890162855d1798451677bd6d.jpeg', '{"filename":"2.jpg"}', 640, 480, NULL, 'image/jpeg', 139645, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-14 15:28:36', '2014-06-14 15:28:36'),
(31, '3.jpg', NULL, 0, 'sonata.media.provider.image', 1, '647b09f314891197e0919c805107d9970f2ff643.jpeg', '{"filename":"3.jpg"}', 640, 480, NULL, 'image/jpeg', 91349, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-14 15:32:46', '2014-06-14 15:32:46'),
(32, '1.jpg', NULL, 0, 'sonata.media.provider.image', 1, '3eeaa1573031b8b831f9e56c55028942a3833ef2.jpeg', '{"filename":"1.jpg"}', 1280, 960, NULL, 'image/jpeg', 549053, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-14 16:15:19', '2014-06-14 16:15:19'),
(34, 'Le-Blokk-2.jpg', NULL, 0, 'sonata.media.provider.image', 1, '51824bfc5f7f41dff5ad6c68a658127034709323.jpeg', '{"filename":"Le-Blokk-2.jpg"}', 2026, 1185, NULL, 'image/jpeg', 270781, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-16 17:18:22', '2014-06-16 17:18:22'),
(35, '5707_slfh_01_p_1024x728.jpg', NULL, 0, 'sonata.media.provider.image', 1, '85153a7f1c5f6e7a7405a683877aa2f697617441.jpeg', '{"filename":"5707_slfh_01_p_1024x728.jpg"}', 1024, 728, NULL, 'image/jpeg', 126087, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-16 17:18:42', '2014-06-16 17:18:42'),
(36, 'BarO.jpg', NULL, 0, 'sonata.media.provider.image', 1, '84b1ca7ac42d802d0a80865e64b6c84cf43a39f6.jpeg', '{"filename":"BarO.jpg"}', 1341, 432, NULL, 'image/jpeg', 122232, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-17 12:18:31', '2014-06-17 12:18:31'),
(37, '47096203.jpg', NULL, 0, 'sonata.media.provider.image', 1, '8c2bf809e23d575ba81c4ef3f1144b78ea1273e2.jpeg', '{"filename":"47096203.jpg"}', 1024, 686, NULL, 'image/jpeg', 133048, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-18 12:51:57', '2014-06-18 12:51:57'),
(38, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, '20198ce62ae1db83a557bf2e1a4640cda5c7afbc.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-18 12:52:22', '2014-06-18 12:52:22'),
(39, 'WaterFall.jpg', NULL, 0, 'sonata.media.provider.image', 1, '22ce472772ded3a696f4f7e00f1bbbcc41bd39cc.jpeg', '{"filename":"WaterFall.jpg"}', 2048, 1365, NULL, 'image/jpeg', 478712, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-19 13:08:21', '2014-06-19 13:08:21'),
(40, 'WaterFall.jpg', NULL, 0, 'sonata.media.provider.image', 1, '82020893a4e9e478debd31167053f563a0c662ca.jpeg', '{"filename":"WaterFall.jpg"}', 2048, 1365, NULL, 'image/jpeg', 478712, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-19 13:09:50', '2014-06-19 13:09:50'),
(41, 'WaterFall.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'c222889cae8f23a805f4042ba06e4e44199e7115.jpeg', '{"filename":"WaterFall.jpg"}', 2048, 1365, NULL, 'image/jpeg', 478712, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-19 13:11:10', '2014-06-19 13:11:10'),
(42, 'Natalie-Dormer-Game-of-Thrones1.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'b7967362aac40c3be58586f1f4a3e84c2b3b6385.jpeg', '{"filename":"Natalie-Dormer-Game-of-Thrones1.jpg"}', 1920, 1440, NULL, 'image/jpeg', 302208, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-19 13:14:15', '2014-06-19 13:14:15'),
(43, 'WaterFall.jpg', NULL, 0, 'sonata.media.provider.image', 1, '4228418d30c484186624c3c8671afc39d9c14597.jpeg', '{"filename":"WaterFall.jpg"}', 2048, 1365, NULL, 'image/jpeg', 478712, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-19 13:16:19', '2014-06-19 13:16:19'),
(44, 'WaterFall.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'fb5f2936e41c7c89c069c3370828032bb899079e.jpeg', '{"filename":"WaterFall.jpg"}', 2048, 1365, NULL, 'image/jpeg', 478712, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-19 13:16:59', '2014-06-19 13:16:59'),
(45, '146272704.jpg', NULL, 0, 'sonata.media.provider.image', 1, '87f88d2fb617c4920bc04d77c7d4c042a498231d.jpeg', '{"filename":"146272704.jpg"}', 1255, 837, NULL, 'image/jpeg', 302144, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-20 16:22:44', '2014-06-20 16:22:44'),
(46, '152830700.jpg', NULL, 0, 'sonata.media.provider.image', 1, '2af0a2a108f1b5d7e656bc7a6cd848832ab8f5a6.jpeg', '{"filename":"152830700.jpg"}', 1255, 837, NULL, 'image/jpeg', 404201, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-20 16:39:58', '2014-06-20 16:39:58'),
(47, '149957747.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'c28bf7cf571eac5cbfd7cd4f732146478f789611.jpeg', '{"filename":"149957747.jpg"}', 2575, 3870, NULL, 'image/jpeg', 4874927, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-20 17:38:10', '2014-06-20 17:38:10'),
(48, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, '259479369623452098638450414fe1b7b1ad9829.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-21 14:01:23', '2014-06-21 14:01:23'),
(49, 'Cape-Horn-bar-5.jpg', NULL, 0, 'sonata.media.provider.image', 1, '8feedb74be1d32248b7cadec03c57a2a1b2c8a9b.jpeg', '{"filename":"Cape-Horn-bar-5.jpg"}', 1500, 998, NULL, 'image/jpeg', 601802, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-21 15:39:20', '2014-06-21 15:39:20'),
(50, 'hero-the_bar.jpg', NULL, 0, 'sonata.media.provider.image', 1, '0fa702b20f0e02eeb4bbe523e4bc802728893f07.jpeg', '{"filename":"hero-the_bar.jpg"}', 1500, 1000, NULL, 'image/jpeg', 530733, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-23 15:46:41', '2014-06-23 15:46:41'),
(51, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, '807653da360790d3e60753f7160e42d53d6acebb.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-23 15:47:25', '2014-06-23 15:47:25'),
(52, '1.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'd3777915c1546e94c50caeec7378e2ac9f59460d.jpeg', '{"filename":"1.jpg"}', 1280, 960, NULL, 'image/jpeg', 549053, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-23 15:48:06', '2014-06-23 15:48:06'),
(53, '1.jpg', NULL, 0, 'sonata.media.provider.image', 1, '1d3e76c66db100524e1f377b2c84db24a9a431a2.jpeg', '{"filename":"1.jpg"}', 1280, 960, NULL, 'image/jpeg', 549053, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-23 15:54:31', '2014-06-23 15:54:31'),
(54, '2.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'b9aeef4f560bcb3cb1030ed58a8d615c0f748325.jpeg', '{"filename":"2.jpg"}', 640, 480, NULL, 'image/jpeg', 139645, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-23 15:55:04', '2014-06-23 15:55:04'),
(55, '88ffbc8367.jpg', NULL, 0, 'sonata.media.provider.image', 1, '0976b5da8dc6eae40c66eb40c62519832234d169.jpeg', '{"filename":"88ffbc8367.jpg"}', 600, 600, NULL, 'image/jpeg', 39570, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-23 17:23:41', '2014-06-23 17:23:41'),
(56, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, 'bf659c7481a5d9a91a25ce99a44230fdbf7f986d.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-23 17:24:31', '2014-06-23 17:24:31'),
(57, 'hero-the_bar.jpg', NULL, 0, 'sonata.media.provider.image', 1, '2ef09d512d5a6af8cc0cfa8ac5f3059db28ca2f8.jpeg', '{"filename":"hero-the_bar.jpg"}', 1500, 1000, NULL, 'image/jpeg', 530733, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-24 19:46:10', '2014-06-24 19:46:10'),
(58, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, '72224df47cb00197ffa6446ed4d1c7e95d5434ca.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-24 19:47:01', '2014-06-24 19:47:01'),
(59, 'So Zen .jpg.JPG', NULL, 0, 'sonata.media.provider.image', 1, '3a1acf3bfcd1b753b7c194c3a79b0192d501313e.jpeg', '{"filename":"So Zen .jpg.JPG"}', 640, 425, NULL, 'image/jpeg', 121427, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-24 19:52:26', '2014-06-24 19:52:26'),
(60, '121-110-thickbox.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'ba9cefa5a6644563aaa776d2315ca17b53045bde.jpeg', '{"filename":"121-110-thickbox.jpg"}', 600, 600, NULL, 'image/jpeg', 25124, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-25 10:22:48', '2014-06-25 10:22:48'),
(61, '121-110-thickbox.jpg', NULL, 0, 'sonata.media.provider.image', 1, '6f7a5579049fe436128dde06d4649b354b731190.jpeg', '{"filename":"121-110-thickbox.jpg"}', 600, 600, NULL, 'image/jpeg', 25124, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-25 10:29:04', '2014-06-25 10:29:04'),
(62, 'image001.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'd5e4b2fa164a50faac15c5145dfd125842c34baa.jpeg', '{"filename":"image001.jpg"}', 395, 195, NULL, 'image/jpeg', 8905, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-25 10:38:34', '2014-06-25 10:38:34'),
(63, 'Cape-Horn-bar-5.jpg', NULL, 0, 'sonata.media.provider.image', 1, '2dcdae19519ffd90867bc2f55141ab3c8fb370cd.jpeg', '{"filename":"Cape-Horn-bar-5.jpg"}', 1500, 998, NULL, 'image/jpeg', 601802, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:52:13', '2014-06-25 12:52:13'),
(64, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, '10eb5fbd4f280d0630a3655bcfd2201c04f035a2.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:52:39', '2014-06-25 12:52:39'),
(65, 'hero-the_bar.jpg', NULL, 0, 'sonata.media.provider.image', 1, '043d7c12988527a60acc9d23a43ae385d2d9a012.jpeg', '{"filename":"hero-the_bar.jpg"}', 1500, 1000, NULL, 'image/jpeg', 530733, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:53:10', '2014-06-25 12:53:10'),
(66, '1.jpg', NULL, 0, 'sonata.media.provider.image', 1, '9788090517ffb228964b9db48a36248cad312a76.jpeg', '{"filename":"1.jpg"}', 1280, 960, NULL, 'image/jpeg', 549053, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:53:47', '2014-06-25 12:53:47'),
(67, '2.jpg', NULL, 0, 'sonata.media.provider.image', 1, '309f87deebabbc4cc38dad264e5828d3ef70940c.jpeg', '{"filename":"2.jpg"}', 640, 480, NULL, 'image/jpeg', 139645, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:54:15', '2014-06-25 12:54:15'),
(68, '3.jpg', NULL, 0, 'sonata.media.provider.image', 1, '9cd9ce9b4461a7c1b7566b1a6ec968aefccc12a9.jpeg', '{"filename":"3.jpg"}', 640, 480, NULL, 'image/jpeg', 91349, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:54:36', '2014-06-25 12:54:36'),
(69, '4.jpg', NULL, 0, 'sonata.media.provider.image', 1, '7a8ed8053df2e8378c926ced6750a1a7000869c7.jpeg', '{"filename":"4.jpg"}', 640, 480, NULL, 'image/jpeg', 105241, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:55:03', '2014-06-25 12:55:03'),
(70, '5.jpg', NULL, 0, 'sonata.media.provider.image', 1, '80726d66ab95c449666ee5f3ff9f49464cce000c.jpeg', '{"filename":"5.jpg"}', 640, 480, NULL, 'image/jpeg', 71012, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:55:23', '2014-06-25 12:55:23'),
(71, '5.jpg', NULL, 0, 'sonata.media.provider.image', 1, '8028ca50648c15ab506ac696910a77b09d96fe38.jpeg', '{"filename":"5.jpg"}', 640, 480, NULL, 'image/jpeg', 71012, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:55:23', '2014-06-25 12:55:23'),
(72, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, 'd26751ebfdf73b7f163bbfd354a2e07c2e10baf9.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:55:56', '2014-06-25 12:55:56'),
(73, 'hero-the_bar.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'd218b5d00b478a1020fe25fd09cf1ca0bf4b8358.jpeg', '{"filename":"hero-the_bar.jpg"}', 1500, 1000, NULL, 'image/jpeg', 530733, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:56:25', '2014-06-25 12:56:25'),
(74, 'Cape-Horn-bar-5.jpg', NULL, 0, 'sonata.media.provider.image', 1, '85d9ce82b97302df5a5e496d2264e536f892e891.jpeg', '{"filename":"Cape-Horn-bar-5.jpg"}', 1500, 998, NULL, 'image/jpeg', 601802, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:56:54', '2014-06-25 12:56:54'),
(75, '1.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'ccc9c065a98ca9be849675ea6b780b06bd4f9b5c.jpeg', '{"filename":"1.jpg"}', 1280, 960, NULL, 'image/jpeg', 549053, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:57:25', '2014-06-25 12:57:25'),
(76, '4.jpg', NULL, 0, 'sonata.media.provider.image', 1, '40fd76629f3171e178756689368b4a7a821810d7.jpeg', '{"filename":"4.jpg"}', 640, 480, NULL, 'image/jpeg', 105241, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:57:49', '2014-06-25 12:57:49'),
(77, '3.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'e90c5d3227a5976da028a29ba94a456c18f4d2f1.jpeg', '{"filename":"3.jpg"}', 640, 480, NULL, 'image/jpeg', 91349, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:58:12', '2014-06-25 12:58:12'),
(78, '2.jpg', NULL, 0, 'sonata.media.provider.image', 1, '849c4f611b0d570c7541cff62cc5c5d1b1291fa0.jpeg', '{"filename":"2.jpg"}', 640, 480, NULL, 'image/jpeg', 139645, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:58:38', '2014-06-25 12:58:38'),
(79, '1.jpg', NULL, 0, 'sonata.media.provider.image', 1, '004cd9517bc570a3e224eb9bda3a23871176f0a8.jpeg', '{"filename":"1.jpg"}', 1280, 960, NULL, 'image/jpeg', 549053, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 12:59:12', '2014-06-25 12:59:12'),
(80, '1.jpg', NULL, 0, 'sonata.media.provider.image', 1, '052fa3f9ca3e40606da085e70b027867f0ade788.jpeg', '{"filename":"1.jpg"}', 1280, 960, NULL, 'image/jpeg', 549053, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:01:18', '2014-06-25 13:01:18'),
(81, '3.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'b04dace37ebb9cfab703cd7f2cb675080d11ba13.jpeg', '{"filename":"3.jpg"}', 640, 480, NULL, 'image/jpeg', 91349, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:01:52', '2014-06-25 13:01:52'),
(82, '4.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'c1d2696c573b8d10f7e91e18cfa68b856170e2e6.jpeg', '{"filename":"4.jpg"}', 640, 480, NULL, 'image/jpeg', 105241, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:02:11', '2014-06-25 13:02:11'),
(83, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, '7220db8b78a5dbdf146fe263e4dd45394931473c.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:02:39', '2014-06-25 13:02:39'),
(84, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, '3061548a6a5c39c312c1c1f9404722a432ad6bc7.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:02:42', '2014-06-25 13:02:42'),
(85, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, '17fab812e6726cead5e34b32efbecd687e09f7ea.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:03:24', '2014-06-25 13:03:24'),
(86, 'hero-the_bar.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'bd2a3d1a9b48a7df0209af199d4f16607d2c34d2.jpeg', '{"filename":"hero-the_bar.jpg"}', 1500, 1000, NULL, 'image/jpeg', 530733, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:03:50', '2014-06-25 13:03:50'),
(87, '2.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'ce161c4d8e4707d8e2bac9167aab4727d351b5c3.jpeg', '{"filename":"2.jpg"}', 640, 480, NULL, 'image/jpeg', 139645, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:04:13', '2014-06-25 13:04:13'),
(88, '1.jpg', NULL, 0, 'sonata.media.provider.image', 1, '2ad8923e5a150da6ae5c63796767ff0c5b8d2a2e.jpeg', '{"filename":"1.jpg"}', 1280, 960, NULL, 'image/jpeg', 549053, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:04:42', '2014-06-25 13:04:42'),
(89, '4.jpg', NULL, 0, 'sonata.media.provider.image', 1, '3f23791ff2e120344eb413e744bf04bbcdacd990.jpeg', '{"filename":"4.jpg"}', 640, 480, NULL, 'image/jpeg', 105241, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:04:59', '2014-06-25 13:04:59'),
(90, '4.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'e19ff9881a6bc4c17bbe59848021babd6552888d.jpeg', '{"filename":"4.jpg"}', 640, 480, NULL, 'image/jpeg', 105241, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:05:00', '2014-06-25 13:05:00'),
(91, '5.jpg', NULL, 0, 'sonata.media.provider.image', 1, '36d04ab439fb7102c7308aa8776149fc9a182c2b.jpeg', '{"filename":"5.jpg"}', 640, 480, NULL, 'image/jpeg', 71012, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:05:25', '2014-06-25 13:05:25'),
(92, '2.jpg', NULL, 0, 'sonata.media.provider.image', 1, '47992096df13b7e04e5980d6eac6f547e43691a1.jpeg', '{"filename":"2.jpg"}', 640, 480, NULL, 'image/jpeg', 139645, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:05:46', '2014-06-25 13:05:46'),
(93, '4.jpg', NULL, 0, 'sonata.media.provider.image', 1, '397bca925ddd3b5479b406c57c4da3daa0402d38.jpeg', '{"filename":"4.jpg"}', 640, 480, NULL, 'image/jpeg', 105241, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:06:00', '2014-06-25 13:06:00'),
(94, '5.jpg', NULL, 0, 'sonata.media.provider.image', 1, '6b76ffc61e9cdc71a824df93b80cbd76dc29fd22.jpeg', '{"filename":"5.jpg"}', 640, 480, NULL, 'image/jpeg', 71012, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:06:22', '2014-06-25 13:06:22'),
(95, '5.jpg', NULL, 0, 'sonata.media.provider.image', 1, '30842020bb6626cebc3d95047fefd0d7e7ca09ca.jpeg', '{"filename":"5.jpg"}', 640, 480, NULL, 'image/jpeg', 71012, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:06:23', '2014-06-25 13:06:23'),
(96, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, '8cdcfc84294bb62f162ad23b8e5c85fac00be686.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:06:48', '2014-06-25 13:06:48'),
(97, 'hero-the_bar.jpg', NULL, 0, 'sonata.media.provider.image', 1, '8cf09774f480a371fb795cbb31d6b517e05b67ab.jpeg', '{"filename":"hero-the_bar.jpg"}', 1500, 1000, NULL, 'image/jpeg', 530733, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:07:11', '2014-06-25 13:07:11'),
(98, 'hero-the_bar.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'e3dcd12200dfa7af8fef65e72cb66575cf72a4ee.jpeg', '{"filename":"hero-the_bar.jpg"}', 1500, 1000, NULL, 'image/jpeg', 530733, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:07:18', '2014-06-25 13:07:18'),
(99, 'hero-the_bar.jpg', NULL, 0, 'sonata.media.provider.image', 1, '5e441f5f36432486708a6e3a891f251492309ad4.jpeg', '{"filename":"hero-the_bar.jpg"}', 1500, 1000, NULL, 'image/jpeg', 530733, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:07:50', '2014-06-25 13:07:50'),
(100, 'hero-the_bar.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'ace90b350c3b15f78d2ce2366996e1a3da4457c9.jpeg', '{"filename":"hero-the_bar.jpg"}', 1500, 1000, NULL, 'image/jpeg', 530733, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:07:58', '2014-06-25 13:07:58'),
(101, 'hero-the_bar.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'ceeb576c124da76a7ce02daa1ab94262e38d3ec5.jpeg', '{"filename":"hero-the_bar.jpg"}', 1500, 1000, NULL, 'image/jpeg', 530733, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:08:21', '2014-06-25 13:08:21'),
(102, '2.jpg', NULL, 0, 'sonata.media.provider.image', 1, '9f8dcd923fe5c5142c227709a5bcdd96641fdefd.jpeg', '{"filename":"2.jpg"}', 640, 480, NULL, 'image/jpeg', 139645, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:08:43', '2014-06-25 13:08:43'),
(103, '5.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'ed844b055f48237fb49179bb0504de7e677fe68d.jpeg', '{"filename":"5.jpg"}', 640, 480, NULL, 'image/jpeg', 71012, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:09:05', '2014-06-25 13:09:05'),
(104, '1.jpg', NULL, 0, 'sonata.media.provider.image', 1, '0d937f9660b0a08b989d887b1a1013cf64bd3f51.jpeg', '{"filename":"1.jpg"}', 1280, 960, NULL, 'image/jpeg', 549053, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:13:29', '2014-06-25 13:13:29'),
(105, '2.jpg', NULL, 0, 'sonata.media.provider.image', 1, '669dfef70229858776065a381c3230034eeb2544.jpeg', '{"filename":"2.jpg"}', 640, 480, NULL, 'image/jpeg', 139645, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:13:55', '2014-06-25 13:13:55'),
(106, '3.jpg', NULL, 0, 'sonata.media.provider.image', 1, '77d30de993e7288e2d767d49108043f959d93a0b.jpeg', '{"filename":"3.jpg"}', 640, 480, NULL, 'image/jpeg', 91349, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:14:18', '2014-06-25 13:14:18'),
(107, '2.jpg', NULL, 0, 'sonata.media.provider.image', 1, '756c288fde6df897ab1220c7f0eeb7ef8ae50279.jpeg', '{"filename":"2.jpg"}', 640, 480, NULL, 'image/jpeg', 139645, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:14:44', '2014-06-25 13:14:44'),
(108, '4.jpg', NULL, 0, 'sonata.media.provider.image', 1, '986b67cffab2e0a07c6dea1898a03d5261e5de1d.jpeg', '{"filename":"4.jpg"}', 640, 480, NULL, 'image/jpeg', 105241, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:15:07', '2014-06-25 13:15:07'),
(109, '4.jpg', NULL, 0, 'sonata.media.provider.image', 1, '2b927f1245c9f35a4213511e00c9837cc4d89c5b.jpeg', '{"filename":"4.jpg"}', 640, 480, NULL, 'image/jpeg', 105241, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:15:32', '2014-06-25 13:15:32'),
(110, '3.jpg', NULL, 0, 'sonata.media.provider.image', 1, '422d480ae6e08bd610ac4c318691b7a7ca261cd8.jpeg', '{"filename":"3.jpg"}', 640, 480, NULL, 'image/jpeg', 91349, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:16:00', '2014-06-25 13:16:00'),
(111, 'Astoria2.jpg', NULL, 0, 'sonata.media.provider.image', 1, '50a277662a7d534fc45be9b0e5875c4651941aa6.jpeg', '{"filename":"Astoria2.jpg"}', 640, 434, NULL, 'image/jpeg', 216592, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:20:11', '2014-06-25 13:20:11'),
(112, '14856832.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'ac2442a82267c83c81b628ac70a533029c4b6b21.jpeg', '{"filename":"14856832.jpg"}', 500, 333, NULL, 'image/jpeg', 30959, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:20:24', '2014-06-25 13:20:24'),
(113, 'Astoria2.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'a9a7efe136e74573e2c46b1b9d0490a04dafba80.jpeg', '{"filename":"Astoria2.jpg"}', 640, 434, NULL, 'image/jpeg', 216592, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:20:35', '2014-06-25 13:20:35'),
(114, '798cbbd9e3a89366.jpg', NULL, 0, 'sonata.media.provider.image', 1, '470395f3859d192d765cd3b9f586531b805ec1e7.jpeg', '{"filename":"798cbbd9e3a89366.jpg"}', 600, 401, NULL, 'image/jpeg', 59171, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:21:03', '2014-06-25 13:21:03'),
(115, 'Eiffel-Tower-Paris-France.jpg', NULL, 0, 'sonata.media.provider.image', 1, '53ec0cdcd348165f41b11ba218f19c834860b7a5.jpeg', '{"filename":"Eiffel-Tower-Paris-France.jpg"}', 2560, 1600, NULL, 'image/jpeg', 903782, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:21:18', '2014-06-25 13:21:18'),
(116, 'sofitel.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'd62213a9f9c3c9cd7b6ad87f475e87dff921ed22.jpeg', '{"filename":"sofitel.jpg"}', 1024, 728, NULL, 'image/jpeg', 119852, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:21:23', '2014-06-25 13:21:23'),
(117, '8701-12028.jpg', NULL, 0, 'sonata.media.provider.image', 1, '777dea52ad2a4fb3f7a953e4175d33e44f74b341.jpeg', '{"filename":"8701-12028.jpg"}', 515, 400, NULL, 'image/jpeg', 41622, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:21:53', '2014-06-25 13:21:53'),
(118, 'WaterFall.jpg', NULL, 0, 'sonata.media.provider.image', 1, '630ea676be7b9256f7e546999d05ed914d453b89.jpeg', '{"filename":"WaterFall.jpg"}', 2048, 1365, NULL, 'image/jpeg', 478712, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:22:06', '2014-06-25 13:22:06'),
(119, 'SILVER-MARRAKECH_bg.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'd0997171459c0b9d723cfdbbc0c10a1d7b92ac2c.jpeg', '{"filename":"SILVER-MARRAKECH_bg.jpg"}', 1685, 878, NULL, 'image/jpeg', 512956, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:22:18', '2014-06-25 13:22:18'),
(120, 'moulin_rouge_cancan.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'f7d3f361568c50922c4b70dba7477344adc83383.jpeg', '{"filename":"moulin_rouge_cancan.jpg"}', 2816, 2112, NULL, 'image/jpeg', 630735, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-25 13:23:04', '2014-06-25 13:23:04'),
(121, '88ffbc8367.jpg', NULL, 0, 'sonata.media.provider.image', 1, '6e0f299e21dcc881965b36fd4f8554b709826457.jpeg', '{"filename":"88ffbc8367.jpg"}', 600, 600, NULL, 'image/jpeg', 39570, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-25 21:48:48', '2014-06-25 21:48:48'),
(122, 'So-Lounge-Sofitel-Marrakech-Palais-Imperial-6.jpg', NULL, 0, 'sonata.media.provider.image', 1, '88b17e0b3bc9c1af517b818084415850d0f436b3.jpeg', '{"filename":"So-Lounge-Sofitel-Marrakech-Palais-Imperial-6.jpg"}', 703, 500, NULL, 'image/jpeg', 425274, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-26 12:22:57', '2014-06-26 12:22:57'),
(123, 'So Zen .jpg.JPG', NULL, 0, 'sonata.media.provider.image', 1, '2eca490a945a05fb814d1462ec9c64fa69911924.jpeg', '{"filename":"So Zen .jpg.JPG"}', 640, 425, NULL, 'image/jpeg', 121427, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-26 12:26:25', '2014-06-26 12:26:25'),
(124, '5707_slfh_01_p_1024x728.jpg', NULL, 0, 'sonata.media.provider.image', 1, '1bb5a4e742f3eb514ab507168dd4fa165f8091b7.jpeg', '{"filename":"5707_slfh_01_p_1024x728.jpg"}', 1024, 728, NULL, 'image/jpeg', 126087, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-26 12:28:41', '2014-06-26 12:28:41'),
(125, '5707_slfh_01_p_1024x728.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'f514f836a25878f8369f113bb9271c4d0e13f368.jpeg', '{"filename":"5707_slfh_01_p_1024x728.jpg"}', 1024, 728, NULL, 'image/jpeg', 126087, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-26 12:28:44', '2014-06-26 12:28:44'),
(126, 'So-Lounge-Sofitel-Marrakech-Palais-Imperial-6.jpg', NULL, 0, 'sonata.media.provider.image', 1, '7b9161737e2b3d70c7ae9e944cde9df901476fd4.jpeg', '{"filename":"So-Lounge-Sofitel-Marrakech-Palais-Imperial-6.jpg"}', 703, 500, NULL, 'image/jpeg', 425274, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-26 12:38:02', '2014-06-26 12:38:02'),
(127, 'Intro_table.jpg', NULL, 0, 'sonata.media.provider.image', 1, '54000a31d4901ec2cc1d2b4a5a3bfe4d55488990.jpeg', '{"filename":"Intro_table.jpg"}', 2000, 1300, NULL, 'image/jpeg', 685990, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-26 15:27:06', '2014-06-26 15:27:06'),
(128, 'So-Lounge-Sofitel-Marrakech-Palais-Imperial-6.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'dbd7c3f3c9d3a10cb8f3cbdf7c709a8b6211d2e8.jpeg', '{"filename":"So-Lounge-Sofitel-Marrakech-Palais-Imperial-6.jpg"}', 703, 500, NULL, 'image/jpeg', 425274, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-26 15:35:13', '2014-06-26 15:35:13'),
(129, '88ffbc8367.jpg', NULL, 0, 'sonata.media.provider.image', 1, '17a53e7431b00bc78624dbb79001a384fdf90cb8.jpeg', '{"filename":"88ffbc8367.jpg"}', 600, 600, NULL, 'image/jpeg', 39570, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-26 18:55:23', '2014-06-26 18:55:23'),
(130, '88ffbc8367.jpg', NULL, 0, 'sonata.media.provider.image', 1, '421424de5b7d25cac049b9ceb1e5c53b96760b3b.jpeg', '{"filename":"88ffbc8367.jpg"}', 600, 600, NULL, 'image/jpeg', 39570, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-26 19:10:54', '2014-06-26 19:10:54'),
(131, 'agadir.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'e1e647a838de2dded85c1a3643f51655d4d6c917.jpeg', '{"filename":"agadir.jpg"}', 298, 169, NULL, 'image/jpeg', 11790, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-27 19:25:19', '2014-06-27 19:25:19'),
(132, 'BBAR SALLE ANIMEE.JPG', NULL, 0, 'sonata.media.provider.image', 1, 'a04b0fc58f73c231564821b4833b211f516b063c.jpeg', '{"filename":"BBAR SALLE ANIMEE.JPG"}', 1600, 1067, NULL, 'image/jpeg', 257425, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-27 19:47:23', '2014-06-27 19:47:23'),
(133, 'congress_hotel_venue_search_Sofitel_Agadir_Royalbay_Resort_5707y03_7_651027174.jpg', NULL, 0, 'sonata.media.provider.image', 1, '372d964c87b3c27c009bdf7926986b89376e418d.jpeg', '{"filename":"congress_hotel_venue_search_Sofitel_Agadir_Royalbay_Resort_5707y03_7_651027174.jpg"}', 346, 260, NULL, 'image/jpeg', 23461, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-27 19:53:12', '2014-06-27 19:53:12'),
(134, '14856832.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'f9da04ebf6fb4031829b67b2d030b7b3d396bc7f.jpeg', '{"filename":"14856832.jpg"}', 500, 333, NULL, 'image/jpeg', 30959, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-28 12:28:31', '2014-06-28 12:28:31'),
(135, '83267091.jpg', NULL, 0, 'sonata.media.provider.image', 1, '53098e232e242352383f3c0e415d6da22b2e4bdd.jpeg', '{"filename":"83267091.jpg"}', 2122, 1415, NULL, 'image/jpeg', 1241784, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-29 14:13:03', '2014-06-29 14:13:03'),
(136, '106062154.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'f955468142781b59b8f52fdd2b824d88bcf30404.jpeg', '{"filename":"106062154.jpg"}', 887, 1182, NULL, 'image/jpeg', 620459, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-29 14:13:41', '2014-06-29 14:13:41'),
(137, '106062154.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'b3ae4eeead9e1bdd2de57f4ad090afc1368d4eef.jpeg', '{"filename":"106062154.jpg"}', 887, 1182, NULL, 'image/jpeg', 620459, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-29 14:13:47', '2014-06-29 14:13:47'),
(138, '156060806.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'aa96d46c17c2430dc2d2123814c3b7a8b1963ea5.jpeg', '{"filename":"156060806.jpg"}', 1025, 1025, NULL, 'image/jpeg', 297070, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-29 14:32:31', '2014-06-29 14:32:31'),
(139, '165830424.jpg', NULL, 0, 'sonata.media.provider.image', 1, '5259b2e02fcacaa8af920a647692c330748253d6.jpeg', '{"filename":"165830424.jpg"}', 1255, 837, NULL, 'image/jpeg', 343843, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-29 14:38:33', '2014-06-29 14:38:33'),
(140, '171143112.jpg', NULL, 0, 'sonata.media.provider.image', 1, '13d25089c06f21fd6668fa011ec5c7373d72d98a.jpeg', '{"filename":"171143112.jpg"}', 1255, 837, NULL, 'image/jpeg', 375432, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-29 14:47:38', '2014-06-29 14:47:38'),
(141, '172932840.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'afa3a861d037d96dad35fa42b64e05ffd5082160.jpeg', '{"filename":"172932840.jpg"}', 1255, 837, NULL, 'image/jpeg', 329154, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-06-29 15:12:44', '2014-06-29 15:12:44'),
(142, '121-110-thickbox.jpg', NULL, 0, 'sonata.media.provider.image', 1, '81dc92c803ea25a21160962f9aa4b1fead3fe0e1.jpeg', '{"filename":"121-110-thickbox.jpg"}', 600, 600, NULL, 'image/jpeg', 25124, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-30 14:13:31', '2014-06-30 14:13:31'),
(143, '019.jpg', NULL, 0, 'sonata.media.provider.image', 1, '72acc67ea3bb6ac88367430eee3d5b18a6e675fb.jpeg', '{"filename":"019.jpg"}', 604, 453, NULL, 'image/jpeg', 53341, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-30 14:14:40', '2014-06-30 14:14:40'),
(150, 'Green Day - Wake Me Up When September Ends [Official Music Video]', NULL, 0, 'sonata.media.provider.youtube', 1, 'NU9JoFKlaZ0', '{"provider_url":"http:\\/\\/www.youtube.com\\/","thumbnail_url":"http:\\/\\/i1.ytimg.com\\/vi\\/NU9JoFKlaZ0\\/hqdefault.jpg","author_name":"greenday","type":"video","width":459,"version":"1.0","title":"Green Day - Wake Me Up When September Ends [Official Music Video]","thumbnail_width":480,"html":"<iframe width=\\"459\\" height=\\"344\\" src=\\"http:\\/\\/www.youtube.com\\/embed\\/NU9JoFKlaZ0?feature=oembed\\" frameborder=\\"0\\" allowfullscreen><\\/iframe>","thumbnail_height":360,"author_url":"http:\\/\\/www.youtube.com\\/user\\/greenday","provider_name":"YouTube","height":344}', 459, 344, NULL, 'video/x-flv', NULL, NULL, 'greenday', 'default', NULL, NULL, NULL, '2014-07-01 13:42:53', '2014-07-01 13:42:53'),
(155, '019.jpg', NULL, 0, 'sonata.media.provider.image', 1, '0512d531c042b69c5dcac86cadf05e2cedabb5d4.jpeg', '{"filename":"019.jpg"}', 604, 453, NULL, 'image/jpeg', 53341, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-07-09 15:40:11', '2014-07-09 15:40:11'),
(156, 'natalie_dormer_2.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'ea29b189388c22d24cd654b1a621b4f16959cb9a.jpeg', '{"filename":"natalie_dormer_2.jpg"}', 2123, 3000, NULL, 'image/jpeg', 667766, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-07-11 17:04:30', '2014-07-11 17:04:30'),
(160, '019.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'e593d7414c37bf0d9099e82dc20f633f12564dac.jpeg', '{"filename":"019.jpg"}', 604, 453, NULL, 'image/jpeg', 53341, NULL, NULL, 'simple_image', NULL, NULL, NULL, '2014-07-11 17:24:23', '2014-07-11 17:24:23');

-- --------------------------------------------------------

--
-- Structure de la table `wbb_ad`
--

CREATE TABLE IF NOT EXISTS `wbb_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` smallint(6) DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `begin_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_84E111553DA5256D` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `wbb_bar`
--

CREATE TABLE IF NOT EXISTS `wbb_bar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `suburb_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foursquare` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_credit_card` tinyint(1) DEFAULT NULL,
  `is_coat_check` tinyint(1) DEFAULT NULL,
  `parking` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` smallint(6) DEFAULT NULL,
  `menu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_reservation` tinyint(1) DEFAULT NULL,
  `reservation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `seo_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_top` tinyint(1) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `foursquare_excluded_tips` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `foursquare_selected_images` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `instagram_excluded_imgs` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `energyLevel_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8BDF1EB989D9B62` (`slug`),
  KEY `IDX_8BDF1EBA76ED395` (`user_id`),
  KEY `IDX_8BDF1EB8BAC62AF` (`city_id`),
  KEY `IDX_8BDF1EB76C25F1` (`suburb_id`),
  KEY `IDX_8BDF1EB97B12258` (`energyLevel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Contenu de la table `wbb_bar`
--

INSERT INTO `wbb_bar` (`id`, `user_id`, `city_id`, `suburb_id`, `name`, `slug`, `latitude`, `longitude`, `address`, `phone`, `email`, `website`, `foursquare`, `twitter`, `facebook`, `instagram`, `is_credit_card`, `is_coat_check`, `parking`, `price`, `menu`, `is_reservation`, `reservation`, `description`, `seo_description`, `on_top`, `status`, `foursquare_excluded_tips`, `foursquare_selected_images`, `instagram_excluded_imgs`, `created_at`, `updated_at`, `energyLevel_id`) VALUES
(1, 1, 1, 1, 'Sofitel', 'Sofitel', '31.62362654', '-8.00273200', 'Je teste une adresse hyper longue de manière à voir, si on a bien prévu ce cas de figure, en intégration', NULL, NULL, 'http://google.com', '4bf19889324cc9b68e39cc92', 'WebDesignDev', 'Fanopsis', 'bmwi', 1, 1, NULL, NULL, NULL, 1, NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis euismod sapien ut tortor vulputate, id molestie sem posuere. Sed congue, magna fermentum euismod mattis, felis dui viverra felis, a sodales risus libero et eros. Nam dignissim, massa nec lacinia porttitor, nisl dolor aliquam augue, ac vulputate eros est sit amet eros.<br><br>&nbsp;Nulla ut accumsan libero. Morbi eu sapien lobortis, egestas magna a, elementum orci. Sed sem orci, gravida vestibulum neque id, volutpat fermentum purus. Curabitur vel lectus nec ligula iaculis facilisis placerat id sem. Ut id diam eget arcu luctus elementum id facilisis elit. Integer luctus iaculis diam, a porttitor odio. <br><br>Nulla dictum libero eget elementum iaculis. Sed auctor cursus nulla, non sollicitudin massa tincidunt sit amet. Sed sollicitudin massa at felis hendrerit, ac bibendum lacus malesuada. Nulla porttitor mauris diam, eget bibendum eros convallis in.Vestibulum erat justo, ultrices in pellentesque vitae, iaculis eu magna. Aenean nec lacus blandit nunc dictum elementum eget ac nisi. Fusce odio metus, pharetra id purus eu, sodales aliquam elit. Aenean posuere neque nec nisl consequat faucibus. <br><br>Nunc scelerisque nunc sodales ornare ultricies. Praesent a mollis orci, sit amet interdum dui. Nullam at lacus ac nisi feugiat laoreet. Praesent faucibus vitae odio nec posuere. Donec id lorem vulputate, bibendum enim vel, tempus sem. Sed mollis id purus quis elementum. Duis lacinia purus sed tellus sollicitudin auctor. <br>Integer at mi mauris. Morbi imperdiet nibh imperdiet metus interdum ullamcorper. Donec egestas quam id justo consequat elementum. Quisque justo odio, euismod sed ullamcorper at, tempor vitae nulla. Integer at leo ut tortor cursus porttitor<br><br>.Duis venenatis ornare commodo. Morbi varius ante lectus, at semper augue pellentesque sit amet. Pellentesque pretium scelerisque lacus, et tincidunt mauris gravida at. Integer dolor arcu, gravida sit amet odio sit amet, viverra convallis quam. Duis bibendum mollis congue. Curabitur fermentum eros sit amet tortor ultricies, et ultrices tortor fermentum. Aliquam nec nulla vel urna commodo pretium vitae nec risus. Mauris nulla quam, pellentesque sed viverra et, dignissim id est.Integer at bibendum velit, ut aliquam erat. Sed feugiat pretium risus ac viverra. Duis sed quam ullamcorper, interdum elit sed, aliquet magna. Nullam et dictum nisl. Nam a felis sed dui dictum rutrum. Nullam felis dolor, elementum quis accumsan vel, mollis et nunc.<br><br>&nbsp;Vivamus sed libero vitae elit vestibulum euismod a in orci. Integer auctor id mauris a imperdiet. Quisque non leo consequat, fringilla ante fringilla, vulputate magna. Praesent blandit nisl a scelerisque interdum. Vivamus vestibulum ut mi at imperdiet. Quisque consectetur luctus nibh, quis fringilla dolor scelerisque ultricies.Curabitur rutrum lectus tortor, congue mollis leo scelerisque a. Curabitur eu odio eget turpis molestie egestas. Pellentesque eget vehicula diam. Pellentesque et arcu nisl. Aenean feugiat hendrerit ipsum, nec aliquam eros blandit quis. Maecenas congue sodales lacus consectetur hendrerit. Cras pretium gravida interdum.Nullam nec dui in mauris luctus luctus. Nunc ullamcorper dapibus auctor. Suspendisse tristique diam lectus, non lacinia urna commodo sed. Donec vitae consequat risus, vitae mollis arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus nec mauris ut sem blandit gravida. Pellentesque sodales aliquet porttitor. In hac habitasse platea dictumst. Sed posuere diam et dolor convallis, molestie pulvinar turpis euismod. Fusce semper volutpat elit eu laoreet. Quisque euismod, velit ac eleifend pretium, nibh nibh semper purus, dapibus semper tellus lectus vestibulum ipsum. Pellentesque tempus est quam, eu aliquam justo sagittis non.<span>Nam accumsan placerat ante, nec mollis arcu euismod vitae.<br><br>&nbsp;Duis iaculis, massa et facilisis vehicula, neque erat auctor leo, in pulvinar dolor nibh eu odio. Donec at aliquam justo. Nulla facilisi. Curabitur iaculis euismod quam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pulvinar, enim a posuere interdum, tortor orci volutpat purus, at imperdiet ipsum eros sed augue. Nunc a pharetra eros. In metus risus, blandit vel ultricies in, condimentum et tortor. Etiam fringilla leo eu ante posuere volutpat et id diam. Quisque commodo, libero at vestibulum tempor, quam tortor eleifend lacus, non consectetur elit nulla id velit. Nam tempor semper dui, id commodo nisl ultricies vel. Curabitur sit amet rhoncus ligula. Aenean dignissim fermentum orci. Ut felis erat, euismod ac purus ac, bibendum iaculis enim. Sed aliquam felis vel hendrerit blandit.</span>', 'Le texte SEO de description', 1, 2, 'a:13:{i:0;s:24:"51bec338498e557a67d16f49";i:1;s:24:"4f04d5568231c7e150666e51";i:2;s:24:"516204e1e4b0e93e2a3f993e";i:3;s:24:"4d4911691e43cbff3c5da5b1";i:4;s:24:"51711e8ee4b0a5a9400a3c02";i:5;s:24:"5118c3ece4b0e3bf09cb7f9f";i:6;s:24:"510ae68ae4b076917cafd2f7";i:7;s:24:"4f870dcde4b07efb9baad7d6";i:8;s:24:"4f786373e4b0e0abc53ffc2e";i:9;s:24:"4eb3ff1a0aaf1abedea82ea4";i:10;s:24:"50635dd4e4b01f36bf53a1d8";i:11;s:24:"4fb52339e4b0ccfe26d8977c";i:12;s:24:"4e67855c091ab297bb4b827a";}', 'a:0:{}', 'a:0:{}', '2014-06-05 14:20:33', '2014-07-11 12:58:25', NULL),
(3, 1, 1, 1, 'Chez Zouhair', 'Chez_Zouhair', '31.66491048', '-8.06294569', NULL, NULL, NULL, 'http://google.com', '4bf19889324cc9b68e39cc92', 'WebDesignDev', 'Fanopsis', 'bmwi', 1, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 0, 'a:0:{}', 'a:5:{i:0;s:24:"5061f4b6e4b0428648187121";i:1;s:24:"4f6f4cdee4b0e0075c418f1f";i:2;s:24:"516b15fbe4b0a7336981372d";i:3;s:24:"515da9a0e4b09b10afe08e98";i:4;s:24:"500be34ee4b042b4069a3cee";}', 'a:1:{i:0;s:28:"731889666878754323_187301426";}', '2014-06-05 14:26:44', '2014-06-24 15:27:37', NULL),
(4, 1, 1, 1, 'Silver', 'Silver', '31.62348665', '-7.99207408', NULL, NULL, NULL, 'http://google.com', '4bf19889324cc9b68e39cc92', 'WebDesignDev', 'Fanopsis', 'bmwi', 1, 1, NULL, NULL, NULL, 1, NULL, '<b>Lorem Ipsum is simply dummy text of the printing and \r\ntypesetting industry. Lorem Ipsum has been the industry''s</b> <u><a href="http://google.com" target="_blank" rel="nofollow">standard dummy\r\n text ever since the 1500s, when an unknown printer took a galley of \r\ntype and scrambled it to make a type</a></u> specimen book. It has survived not \r\nonly five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and \r\ntypesetting industry. Lorem Ipsum has been the industry''s standard dummy\r\n text ever since the 1500s, when an unknown printer took a galley of \r\ntype and scrambled it to make a type specimen book. It has survived not \r\nonly five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.<b></b><br>', NULL, 1, 2, 'a:0:{}', 'a:0:{}', 'a:0:{}', '2014-06-05 14:36:51', '2014-06-27 19:07:14', NULL),
(6, 1, 1, 1, 'V.I.P', 'V_I_P', '31.60096200', '-8.03720700', 'test tes', NULL, NULL, 'http://google.com', '4bf19889324cc9b68e39cc92', 'WebDesignDev', 'Fanopsis', 'bmwi', 1, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, 2, 'a:0:{}', 'a:0:{}', 'a:0:{}', '2014-06-05 14:42:24', '2014-06-26 19:33:57', NULL),
(8, 1, 15, 15, 'Jad Mahal', 'Jad-Mahal', '31.62063625', '-7.99906929', 'Hivernage, Marrakech', '+212 524 847596', 'http://www.jad-mahal.com/contacts/', 'http://www.jad-mahal.com/', '4bf19889324cc9b68e39cc92', 'jad_mahal_kech', 'PalaisJadMahal', 'bmwi', 1, 1, NULL, 4, NULL, 0, 'http://www.jad-mahal.com/lounge-bar/', '<b>Lorem Ipsum is simply dummy</b> text of the printing and \r\ntypesetting industry. Lorem Ipsum has been the industry''s standard dummy\r\n text ever since the 1500s, when an unknown printer took a galley of \r\ntype and scrambled it to make a type specimen book. It has survived not \r\nonly five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and \r\ntypesetting industry. Lorem Ipsum has been the industry''s standard dummy\r\n text ever since the 1500s, when an unknown printer took a galley of \r\ntype and scrambled it to make a type specimen book. It has survived not \r\nonly five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with <a href="http://jad-mahal.com/lounge-bar/" target="_blank" rel="nofollow">desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.</a><br>ustry''s standard dummy\r\n ever since the 1500s, when an unknown printer took a galley of \r\ntype and scrambled it to make a type specimen book. It has survived not \r\nonly five centuries, but also the leap into electronic typesetting, \r\nremaining essentially unchanged. It was popularised in the 1960s with \r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more\r\n recently with desktop publishing software like Aldus PageMaker \r\nincluding versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and \r\ntypesetting industry. Lorem Ipsum has been the industry''s standard dummy\r\n text ever since the 1500s, when an unknown printer took a galley of \r\ntype and scrambled it to make a type specimen<br><br>', 'jad mahal un palais féerique en plein hivernage jad mahal un palais féerique en plein hivernagejad mahal un palais féerique en plein hivernagejad mahal un palais féerique en plein hivernagejad mahal un palais féerique en plein hivernagejad mahal un palais', 0, 2, 'a:8:{i:0;s:24:"4f04d5568231c7e150666e51";i:1;s:24:"51bec338498e557a67d16f49";i:2;s:24:"510ae68ae4b076917cafd2f7";i:3;s:24:"4f786373e4b0e0abc53ffc2e";i:4;s:24:"4eb3ff1a0aaf1abedea82ea4";i:5;s:24:"50635dd4e4b01f36bf53a1d8";i:6;s:24:"4fb52339e4b0ccfe26d8977c";i:7;s:24:"4e67855c091ab297bb4b827a";}', 'a:5:{i:0;s:24:"5084507fe4b06d381b87bf72";i:1;s:24:"500be34ee4b0ddfaa73b163f";i:2;s:24:"516b161e498e28efe45c30bf";i:3;s:24:"5384d148498e877e30bfd2f3";i:4;s:24:"536a85ec498e2da911c79333";}', 'a:15:{i:0;s:28:"736301329769975440_187301426";i:1;s:28:"726816212332727937_187301426";i:2;s:28:"729708857925193585_187301426";i:3;s:28:"730456761526799513_187301426";i:4;s:28:"731889666878754323_187301426";i:5;s:28:"726114743166062427_187301426";i:6;s:28:"725361450454240358_187301426";i:7;s:28:"724635610921717371_187301426";i:8;s:28:"723903679305239967_187301426";i:9;s:28:"721740783544585353_187301426";i:10;s:28:"716674041629789380_187301426";i:11;s:28:"718842565416602820_187301426";i:12;s:28:"719562175250058890_187301426";i:13;s:28:"720282459930250431_187301426";i:14;s:28:"721001590824520851_187301426";}', '2014-06-08 11:36:45', '2014-07-04 15:08:01', NULL),
(9, 1, 3, 7, 'Buddha Bar', 'Buddha-Bar', '48.87504208', '2.30123854', '2-4 Avenue Bertie Albrecht', '(7883424234', 'sqdf@sdf.Fr', 'http://www.sqdf.Qf', '4bfd2db02b83b71365a7a998', 'buddhabargroup', 'buddhabarofficial', 'buddhabarparis', 1, 1, NULL, 2, 'www.sdf.fr', 0, 'www.sdf.fr', 'sdfqdfqsfsqdf<br>qsfdsdf<br>', 'dsqfsf', 0, 2, 'a:0:{}', 'a:3:{i:0;s:24:"516475c5e4b0c2c9976fd169";i:1;s:24:"52a77957498e96fbeefc6aa7";i:2;s:24:"51609a7fe4b0d19a918fb242";}', 'a:0:{}', '2014-06-09 11:36:27', '2014-06-29 15:38:34', NULL),
(10, 1, 2, 3, 'Le Dôme', 'Le-Dome', '30.42126000', '-9.60014900', 'N 2 Rue 3 Founty', '0478383939393', 'test@test.com', 'http://www.url.com', '4bfd2db02b83b71365a7a998', 'buddhabargroup', 'buddhabarofficial', 'buddhabarparis', 1, 1, 'Underground', 2, 'http://www.url.com', 1, 'http://www.url.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris erat libero, sagittis eu lacus ut, ullamcorper interdum enim. <br><br>Etiam sagittis egestas vehicula. Duis cursus tellus et ullamcorper aliquet. Morbi dignissim posuere velit eget scelerisque. Vivamus lacinia quam vel neque interdum lobortis. Fusce aliquet ac turpis in vestibulum. Duis hendrerit tincidunt libero vel sagittis. Phasellus vehicula mi sed nibh tristique euismod.In hac habitasse platea dictumst. Aenean vel sem libero. Maecenas et mollis libero, id interdum mi. <br><br>In pharetra feugiat diam fermentum lobortis. Proin a congue ante, non condimentum neque. <br>Fusce ac ipsum adipiscing, ullamcorper eros et, fringilla felis. Pellentesque sit amet interdum quam, id aliquam eros. Integer scelerisque tortor vitae felis dapibus, porta vestibulum lacus rhoncus. Aliquam quis massa id justo imperdiet mattis. Nunc sollicitudin mi nisl, a vehicula lectus hendrerit at. Duis varius vehicula velit, ac posuere nibh rutrum quis. Aenean porttitor ultrices arcu, sed hendrerit turpis faucibus non. Quisque tristique sit amet felis at pretium. Proin at nunc quis neque adipiscing pulvinar. Curabitur blandit enim mi, imperdiet varius erat pellentesque nec.Cras arcu metus, imperdiet a diam a, interdum dapibus nulla. Duis molestie dignissim luctus. <br><br>Mauris vel viverra velit. Etiam eleifend dui semper lacus facilisis blandit. Etiam sodales, ligula eu tempus accumsan, diam orci suscipit leo, sed vehicula enim risus eu eros. Donec eget sapien eu nisl blandit egestas at non elit. Nam dictum, neque et eleifend auctor, enim nisl gravida nisl, eu consequat urna massa vitae purus. Sed ullamcorper pellentesque sapien, et lacinia dolor. Ut tristique arcu eget purus ornare, ac condimentum arcu laoreet. Vivamus elit orci, egestas vel aliquam at, malesuada eu turpis. Vestibulum non venenatis neque. Nunc et ornare augue, eu gravida metus. Nullam ac risus eu sapien vehicula vestibulum ac eu augue.Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus pretium scelerisque tellus at iaculis. Nulla a vehicula dui. Fusce aliquet leo imperdiet tincidunt adipiscing. Vestibulum id nisl vel arcu blandit rhoncus. Nam in magna et quam dignissim cursus non vitae massa. Donec tellus purus, egestas eget suscipit sit amet, pharetra a magna. Vestibulum ac metus in nulla bibendum sollicitudin ut vel est. Vestibulum eu massa a erat volutpat ultricies. Donec congue elementum sapien quis fermentum. Aenean ornare ante non turpis cursus faucibus. Nulla eget ullamcorper dui. Donec eu diam eu dui placerat facilisis. Sed gravida nisi a magna tristique vestibulum. Quisque id sapien porttitor, fringilla ante vel, euismod neque.Nam tellus leo, dapibus at mattis quis, hendrerit et diam. Fusce purus enim, dapibus eget risus et, tincidunt congue ligula. Quisque sodales ipsum nisi, eu tempus dui varius a. Nam cursus, elit non iaculis molestie, nunc massa fringilla nisi, et mattis tellus risus nec urna. Vestibulum cursus orci eu vestibulum blandit. Vivamus feugiat convallis sollicitudin. Suspendisse potenti. Phasellus ut dapibus justo, vitae ornare nunc. Phasellus mi nulla, porttitor eu dignissim sed, auctor vel massa. Nam gravida nec ipsum et tincidunt. Nulla iaculis mi eu ligula eleifend, a consectetur nisi tempus. Mauris id convallis lacus. Proin odio nulla, tincidunt vel porttitor id, congue et lorem. Donec eget neque turpis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec venenatis condimentum metus, vel congue mauris accumsan sed.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 0, 2, 'a:0:{}', 'a:0:{}', 'a:0:{}', '2014-06-14 15:30:09', '2014-06-27 18:42:51', NULL),
(11, 1, 5, 19, 'Le Jardin de l''Eau', 'Le-Jardin-De-Leau', '0.00000000', '0.00000000', 'N 104 Rue 8', '33663416327', 'test@test.fr', 'http://www.url.com', '4bfd2db02b83b71365a7a998', 'buddhabargroup', 'buddhabarofficial', 'buddhabarparis', 1, 1, 'Underground', 2, 'http://www.url.com', 1, 'http://www.url.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris erat libero, sagittis eu lacus ut, ullamcorper interdum enim. Etiam sagittis egestas vehicula. Duis cursus tellus et ullamcorper aliquet. Morbi dignissim posuere velit eget scelerisque. Vivamus lacinia quam vel neque interdum lobortis. Fusce aliquet ac turpis in vestibulum. Duis hendrerit tincidunt libero vel sagittis. Phasellus vehicula mi sed nibh tristique euismod.In hac habitasse platea dictumst. Aenean vel sem libero. Maecenas et mollis libero, id interdum mi. In pharetra feugiat diam fermentum lobortis. Proin a congue ante, non condimentum neque. Fusce ac ipsum adipiscing, ullamcorper eros et, fringilla felis. Pellentesque sit amet interdum quam, id aliquam eros. Integer scelerisque tortor vitae felis dapibus, porta vestibulum lacus rhoncus. Aliquam quis massa id justo imperdiet mattis. Nunc sollicitudin mi nisl, a vehicula lectus hendrerit at. Duis varius vehicula velit, ac posuere nibh rutrum quis. Aenean porttitor ultrices arcu, sed hendrerit turpis faucibus non. Quisque tristique sit amet felis at pretium. <br><br>Proin at nunc quis neque adipiscing pulvinar. Curabitur blandit enim mi, imperdiet varius erat pellentesque nec.Cras arcu metus, imperdiet a diam a, interdum dapibus nulla. Duis molestie dignissim luctus. Mauris vel viverra velit. Etiam eleifend dui semper lacus facilisis blandit. Etiam sodales, ligula eu tempus accumsan, diam orci suscipit leo, sed vehicula enim risus eu eros. Donec eget sapien eu nisl blandit egestas at non elit. Nam dictum, neque et eleifend auctor, enim nisl gravida nisl, eu con<br>sequat urna massa vitae purus. Sed ullamcorper pellentesque sapien, et lacinia dolor. Ut tristique arcu eget purus ornare, ac condimentum arcu laoreet. Vivamus elit orci, egestas vel aliquam at, malesuada eu turpis. Vestibulum non venenatis neque. Nunc et ornare augue, eu gravida metus. Nullam ac risus eu sapien vehicula vestibulum ac eu augue.Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus pretium scelerisque tellus at iaculis. Nulla a vehicula dui. Fusce aliquet leo imperdiet tincidunt adipiscing. Vestibulum id nisl vel arcu blandit rhoncus. Nam in magna et quam dignissim cursus non vitae massa. Donec tellus purus, egestas eget suscipit sit amet, pharetra a magna. Vestibulum ac metus in nulla bibendum sollicitudin ut vel est. Vestibulum eu massa a erat volutpat ultricies. Donec congue<br><br>&nbsp;elementum sapien quis fermentum. Aenean ornare ante non turpis cursus faucibus. Nulla eget ullamcorper dui. Donec eu diam eu dui placerat facilisis. Sed gravida nisi a magna tristique vestibulum. Quisque id sapien porttitor, fringilla ante vel, euismod neque.Nam tellus leo, dapibus at mattis quis, hendrerit et diam. Fusce purus enim, dapibus eget risus et, tincidunt congue ligula. Quisque sodales ipsum nisi, eu tempus dui varius a. Nam cursus, elit non iaculis molestie, nunc massa fringilla nisi, et mattis tellus risus nec urna. Vestibulum cursus orci eu vestibulum blandit. Vivamus feugiat convallis sollicitudin. Suspendisse potenti. Phasellus ut dapibus justo, vitae ornare nunc. Phasellus mi nulla, porttitor eu dignissim sed, auctor vel massa. Nam gravida nec ipsum et tincidunt. Nulla iaculis mi eu ligula eleifend, a consectetur nisi tempus. Mauris id convallis lacus. Proin odio nulla, tincidunt vel porttitor id, congue et lorem. Donec eget neque turpis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec venenatis condimentum metus, vel congue mauris accumsan sed.', 'cursus orci eu vestibulum blandit. Vivamus feugiat convallis sollicitudin. Suspendisse potenti. Phasellus ut d', 1, 1, 'a:0:{}', 'a:0:{}', 'a:0:{}', '2014-06-14 15:33:12', '2014-06-27 21:16:23', NULL),
(12, 1, 4, 17, 'Le Belvédère', 'Le-Belvedere', '40.72300840', '-74.00063280', 'n 85 rue de paris', '33663416327', 'test@test.com', 'http://www.url.com', '4bfd2db02b83b71365a7a998', 'buddhabargroup', 'buddhabarofficial', 'buddhabarparis', 1, 1, 'Unattended parking lot', 3, 'http://www.url.com', 1, 'http://www.url.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris erat libero, sagittis eu lacus ut, ullamcorper interdum enim. Etiam sagittis egestas vehicula. Duis cursus tellus et ullamcorper aliquet. Morbi dignissim posuere velit eget scelerisque. Vivamus lacinia quam vel neque interdum lobortis.<br>Fusce aliquet ac turpis in vestibulum. Duis hendrerit tincidunt libero vel sagittis. Phasellus vehicula mi sed nibh tristique euismod.In hac habitasse platea dictumst. Aenean vel sem libero. Maecenas et mollis libero, id interdum mi. In pharetra feugiat diam fermentum lobortis. Proin a congue ante, non condimentum neque. Fusce ac ipsum adipiscing, ullamcorper eros et, fringilla felis. <br><br>Pellentesque sit amet interdum quam, id aliquam eros. Integer scelerisque tortor vitae felis dapibus, porta vestibulum lacus rhoncus. Aliquam quis massa id justo imperdiet mattis. Nunc sollicitudin mi nisl, a vehicula lectus hendrerit at. Duis varius vehicula velit, ac posuere nibh rutrum quis. Aenean porttitor ultrices arcu, sed hendrerit turpis faucibus non. Quisque tristique sit amet felis at pretium. Proin at nunc quis neque adipiscing pulvinar. Curabitur blandit enim mi, imperdiet varius erat pellentesque nec.Cras arcu metus, imperdiet a diam a, interdum dapibus nulla. Duis molestie dignissim luctus. Mauris vel viverra velit. Etiam eleifend dui semper lacus facilisis blandit. Etiam sodales, ligula eu tempus accumsan, diam orci suscipit leo, sed vehicula enim risus eu eros. Donec eget sapien eu nisl blandit egestas at non elit. Nam dictum, neque et eleifend auctor, enim nisl gravida nisl, eu consequat urna massa vitae purus. Sed ullamcorper pellentesque sapien, et lacinia dolor. <br><br>Ut tristique arcu eget purus ornare, ac condimentum arcu laoreet. Vivamus elit orci, egestas vel aliquam at, malesuada eu turpis. Vestibulum non venenatis neque. Nunc et ornare augue, eu gravida metus. Nullam ac risus eu sapien vehicula vestibulum ac eu augue.', 'Ut tristique arcu eget purus ornare, ac condimentum arcu laoreet', 0, 2, 'a:0:{}', 'a:0:{}', 'a:0:{}', '2014-06-14 16:16:41', '2014-06-26 17:11:11', NULL),
(13, 1, 3, 9, 'Monkey''s Bar', 'Monkeys-Bar', '48.87543600', '2.37365100', 'test adress', '03478294', NULL, NULL, '4bfd2db02b83b71365a7a998', 'buddhabargroup', 'buddhabarofficial', 'buddhabarparis', 1, 1, 'Unattended parking lot', 2, NULL, 0, NULL, '1.1.1.1.&nbsp;&nbsp;&nbsp;&nbsp;\r\nDiscover\r\nBars from Top Cities\r\n\r\nUn carrousel affiche la liste des\r\ntop cities. Il affiche les villes par lot de 6. Au clic sur les flèches permet\r\nde faire défiler les villes une par une en bouclant. \r\n\r\nLes villes sont affichées de\r\nmanière aléatoire.\r\n\r\n1.1.1.2.&nbsp;&nbsp;&nbsp;&nbsp; Latest\r\nBest of\r\n\r\nUn\r\ncarrousel affiche la liste des derniers Best of créés via le Back Office et indiqués\r\ncomme «&nbsp;On Top&nbsp;». Il affiche les Best of par lot de 3. Au clic sur\r\nles flèches permet de faire défiler les Best of un par un en bouclant. Lorsque\r\nl’on désactive un Best of, en le retirant <br><br><br><br>', 'test', 1, 2, 'a:0:{}', 'a:0:{}', 'a:0:{}', '2014-06-17 12:19:11', '2014-06-27 19:04:27', NULL),
(14, 1, 2, 4, 'Papagayo', 'Papagayo', '0.00000000', '0.00000000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 1, 'a:0:{}', 'a:0:{}', 'a:0:{}', '2014-06-19 13:08:53', '2014-06-23 16:15:59', NULL),
(15, 1, 2, 4, 'First', 'First', '30.42361900', '-9.61199100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, 1, NULL, NULL, 'test hqsgvdyfdcyusghdc jqsvcxbjsqdvc jsqdhcvbhjkkkdbnxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx lshckjsdcjgsdcb, kqsgckqsgdcyjvqc schjfsjdhcvsdc;:sd,clsdjihjkésdfv', 1, 2, 'a:0:{}', 'a:0:{}', 'a:0:{}', '2014-06-19 13:10:01', '2014-06-28 20:08:08', NULL),
(16, 1, 9, 18, 'Dar Sabra', 'Dar-Sabra', '31.63293137', '-7.99877691', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, 2, 'a:0:{}', 'a:0:{}', 'a:0:{}', '2014-06-19 13:14:42', '2014-06-27 21:15:36', NULL),
(17, 1, 1, 6, 'Pacha', 'Pacha', '31.59194400', '-7.99090908', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, 1, 'a:0:{}', 'a:0:{}', 'a:0:{}', '2014-06-19 13:15:39', '2014-06-25 10:20:22', NULL),
(18, 1, 1, 5, 'Auberge le Maquis', 'Auberge-Le-Maquis', '31.31478100', '-7.74904100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, 2, 'a:0:{}', 'a:0:{}', 'a:0:{}', '2014-06-19 13:17:04', '2014-06-26 19:44:50', NULL),
(19, 1, 3, 8, 'Bar Parisien', 'Bar-Parisien', '47.78222000', '1.07095000', 'rue de la boetie', '73982478392748', 'qsdf@qf.fr', NULL, '4bfd2db02b83b71365a7a998', 'buddhabargroup', 'buddhabarofficial', 'buddhabarparis', 1, 1, 'Valet', 2, 'http://www.qfsdf.com', 0, NULL, 'Un régal pour les papilles. <br><br>Prêt à manger un vrai festin?<br>', 'qfdqdsf', 0, 1, 'a:0:{}', 'a:0:{}', 'a:0:{}', '2014-06-20 16:39:28', '2014-06-25 12:31:11', NULL),
(20, 1, 1, 1, 'Je créé un nom de bar long juste pour tester', 'Je-Cree-Un-Nom-De-Bar-Long-Juste-Pour-Tester', '31.65856600', '-8.06459100', 'test', '23124', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, 1, NULL, 'qsdfsdqfqsdf', NULL, 1, 2, 'a:0:{}', 'a:0:{}', 'a:0:{}', '2014-06-20 17:38:18', '2014-06-27 19:52:42', NULL),
(21, 1, 6, 20, 'Test bar', 'Test-Bar', '48.81820960', '1.92920090', 'Test adresse', '0384934', NULL, NULL, '4bfd2db02b83b71365a7a998', 'buddhabargroup', 'buddhabarofficial', NULL, 1, 1, NULL, 2, NULL, 1, NULL, 'Bar description<br>', 'SEO Description', 1, 2, 'a:0:{}', 'a:0:{}', 'a:0:{}', '2014-06-29 14:16:29', '2014-06-29 14:40:37', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `wbb_bar_media`
--

CREATE TABLE IF NOT EXISTS `wbb_bar_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bar_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `video1_id` int(11) DEFAULT NULL,
  `video2_id` int(11) DEFAULT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8C818C389A253A` (`bar_id`),
  KEY `IDX_8C818C3EA9FDD75` (`media_id`),
  KEY `IDX_8C818C347218004` (`video1_id`),
  KEY `IDX_8C818C355942FEA` (`video2_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

--
-- Contenu de la table `wbb_bar_media`
--

INSERT INTO `wbb_bar_media` (`id`, `bar_id`, `media_id`, `video1_id`, `video2_id`, `alt`, `position`, `created_at`, `updated_at`) VALUES
(1, 4, 1, NULL, NULL, 'entrée silver', 3, '2014-06-05 14:36:51', '2014-06-27 19:07:14'),
(2, 4, 54, NULL, NULL, 'comptoir silver', 2, '2014-06-05 14:36:51', '2014-06-27 19:07:14'),
(3, 1, 1, NULL, NULL, 'Entrée sofitel', 3, '2014-06-05 14:39:01', '2014-07-11 12:58:25'),
(4, 1, 53, NULL, NULL, 'comptoir Sofitel', 2, '2014-06-05 14:39:01', '2014-07-11 12:58:25'),
(6, 3, 4, NULL, NULL, 'natalie', 1, '2014-06-05 14:40:05', '2014-06-24 15:27:37'),
(9, 6, 4, NULL, NULL, 'natalie', 1, '2014-06-05 14:42:24', '2014-06-26 19:33:57'),
(10, 6, 2, NULL, NULL, 'salon vip', 2, '2014-06-05 14:42:24', '2014-06-26 19:33:57'),
(13, 9, 49, NULL, NULL, 'testsetesrsfdsfds', 1, '2014-06-09 11:37:35', '2014-06-29 15:38:34'),
(15, 1, 15, NULL, NULL, 'Comptoir serveur sofitel', 4, '2014-06-10 07:56:16', '2014-07-11 12:58:25'),
(17, 1, 150, NULL, NULL, 'verre de bierre Sofitel', 1, '2014-06-10 07:56:16', '2014-07-11 12:58:25'),
(20, 10, 29, NULL, NULL, NULL, 1, '2014-06-14 15:30:09', '2014-06-27 18:42:51'),
(21, 10, 30, NULL, NULL, NULL, 2, '2014-06-14 15:30:09', '2014-06-27 18:42:51'),
(22, 11, 31, NULL, NULL, NULL, 1, '2014-06-14 15:33:12', '2014-06-27 21:16:23'),
(23, 12, 32, NULL, NULL, NULL, 2, '2014-06-14 16:16:41', '2014-06-26 17:11:11'),
(24, 13, 36, NULL, NULL, 'monkey''s bar', 1, '2014-06-17 12:19:11', '2014-06-27 19:04:27'),
(25, 14, 39, NULL, NULL, NULL, 1, '2014-06-19 13:08:53', '2014-06-23 16:15:59'),
(26, 15, 40, NULL, NULL, 'chute d''eau first', 1, '2014-06-19 13:10:01', '2014-06-28 20:08:08'),
(27, 16, 42, NULL, NULL, NULL, 1, '2014-06-19 13:14:42', '2014-06-27 21:15:36'),
(28, 17, 43, NULL, NULL, NULL, 1, '2014-06-19 13:16:44', '2014-06-25 10:20:22'),
(29, 18, 44, NULL, NULL, 'Chute d''eau Auberge', 1, '2014-06-19 13:17:04', '2014-06-26 19:44:50'),
(30, 19, 46, NULL, NULL, NULL, 1, '2014-06-20 16:40:08', '2014-06-25 12:31:11'),
(31, 20, 47, NULL, NULL, 'nom long', 1, '2014-06-20 17:38:18', '2014-06-27 19:52:42'),
(34, 1, 121, NULL, NULL, 'red bull sofitel', 5, '2014-06-25 21:48:52', '2014-07-11 12:58:25'),
(35, 4, 126, NULL, NULL, 'salon silver', 1, '2014-06-26 12:38:06', '2014-06-27 19:07:14'),
(36, 12, 127, NULL, NULL, NULL, 1, '2014-06-26 15:28:01', '2014-06-26 17:11:11'),
(37, 8, 133, NULL, NULL, 'the new image', 1, '2014-06-27 19:53:15', '2014-06-27 19:53:24'),
(38, 21, 135, NULL, NULL, 'Alternatif texte', 1, '2014-06-29 14:16:29', '2014-06-29 14:40:37'),
(39, 21, 137, NULL, NULL, 'Alternatif texte 2', 2, '2014-06-29 14:16:29', '2014-06-29 14:40:37'),
(40, 1, 142, NULL, NULL, NULL, 6, '2014-06-30 14:13:36', '2014-07-11 12:58:25');

-- --------------------------------------------------------

--
-- Structure de la table `wbb_bar_occasion`
--

CREATE TABLE IF NOT EXISTS `wbb_bar_occasion` (
  `bar_id` int(11) NOT NULL,
  `occasion_id` int(11) NOT NULL,
  PRIMARY KEY (`bar_id`,`occasion_id`),
  KEY `IDX_82F53E6A89A253A` (`bar_id`),
  KEY `IDX_82F53E6A4034998F` (`occasion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `wbb_bar_occasion`
--

INSERT INTO `wbb_bar_occasion` (`bar_id`, `occasion_id`) VALUES
(1, 6),
(1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `wbb_bar_opening`
--

CREATE TABLE IF NOT EXISTS `wbb_bar_opening` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bar_id` int(11) DEFAULT NULL,
  `opening_day` smallint(6) NOT NULL,
  `from_hour` smallint(6) NOT NULL,
  `to_hour` smallint(6) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `semsoftBar_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F0EA768E89A253A` (`bar_id`),
  KEY `IDX_F0EA768ED083AAA` (`semsoftBar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=301 ;

--
-- Contenu de la table `wbb_bar_opening`
--

INSERT INTO `wbb_bar_opening` (`id`, `bar_id`, `opening_day`, `from_hour`, `to_hour`, `created_at`, `updated_at`, `semsoftBar_id`) VALUES
(55, NULL, 2, 11, 16, '2014-07-12 12:18:24', '2014-07-12 12:18:24', 60),
(56, NULL, 2, 17, 23, '2014-07-12 12:18:24', '2014-07-12 12:18:24', 60),
(57, NULL, 3, 11, 16, '2014-07-12 12:18:24', '2014-07-12 12:18:24', 60),
(58, NULL, 3, 17, 23, '2014-07-12 12:18:24', '2014-07-12 12:18:24', 60),
(59, NULL, 4, 11, 16, '2014-07-12 12:18:24', '2014-07-12 12:18:24', 60),
(60, NULL, 4, 17, 23, '2014-07-12 12:18:24', '2014-07-12 12:18:24', 60),
(61, NULL, 5, 11, 16, '2014-07-12 12:18:24', '2014-07-12 12:18:24', 60),
(62, NULL, 5, 17, 23, '2014-07-12 12:18:24', '2014-07-12 12:18:24', 60),
(63, NULL, 6, 11, 16, '2014-07-12 12:18:24', '2014-07-12 12:18:24', 60),
(64, NULL, 6, 17, 23, '2014-07-12 12:18:24', '2014-07-12 12:18:24', 60),
(65, NULL, 1, 12, 0, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 65),
(66, NULL, 2, 12, 0, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 65),
(67, NULL, 3, 12, 0, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 65),
(68, NULL, 4, 12, 0, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 65),
(69, NULL, 5, 12, 0, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 65),
(70, NULL, 6, 12, 0, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 65),
(71, NULL, 7, 12, 22, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 65),
(72, NULL, 1, 12, 0, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 69),
(73, NULL, 2, 12, 0, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 69),
(74, NULL, 3, 12, 0, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 69),
(75, NULL, 4, 12, 0, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 69),
(76, NULL, 5, 12, 0, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 69),
(77, NULL, 6, 12, 0, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 69),
(78, NULL, 7, 12, 0, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 69),
(79, NULL, 2, 17, 22, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 72),
(80, NULL, 3, 17, 22, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 72),
(81, NULL, 4, 17, 22, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 72),
(82, NULL, 5, 17, 23, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 72),
(83, NULL, 6, 17, 23, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 72),
(84, NULL, 7, 17, 21, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 72),
(85, NULL, 1, 17, 2, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 73),
(86, NULL, 2, 17, 2, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 73),
(87, NULL, 3, 17, 2, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 73),
(88, NULL, 4, 17, 2, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 73),
(89, NULL, 5, 17, 4, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 73),
(90, NULL, 6, 17, 4, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 73),
(91, NULL, 7, 19, 2, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 73),
(92, NULL, 1, 12, 23, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 74),
(93, NULL, 2, 12, 23, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 74),
(94, NULL, 3, 12, 23, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 74),
(95, NULL, 4, 12, 23, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 74),
(96, NULL, 5, 12, 1, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 74),
(97, NULL, 6, 15, 1, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 74),
(98, NULL, 1, 11, 2, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 75),
(99, NULL, 2, 11, 2, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 75),
(100, NULL, 3, 11, 2, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 75),
(101, NULL, 4, 11, 2, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 75),
(102, NULL, 5, 11, 4, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 75),
(103, NULL, 6, 11, 4, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 75),
(104, NULL, 7, 11, 2, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 75),
(105, NULL, 1, 18, 1, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 77),
(106, NULL, 2, 18, 1, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 77),
(107, NULL, 3, 18, 1, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 77),
(108, NULL, 4, 18, 1, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 77),
(109, NULL, 5, 18, 2, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 77),
(110, NULL, 6, 18, 2, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 77),
(111, NULL, 7, 18, 1, '2014-07-12 12:18:25', '2014-07-12 12:18:25', 77),
(112, NULL, 1, 12, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 78),
(113, NULL, 2, 12, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 78),
(114, NULL, 3, 12, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 78),
(115, NULL, 4, 12, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 78),
(116, NULL, 5, 12, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 78),
(117, NULL, 6, 12, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 78),
(118, NULL, 7, 12, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 78),
(119, NULL, 2, 17, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 79),
(120, NULL, 3, 17, 0, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 79),
(121, NULL, 4, 17, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 79),
(122, NULL, 5, 17, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 79),
(123, NULL, 6, 18, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 79),
(124, NULL, 1, 15, 23, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 82),
(125, NULL, 2, 11, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 82),
(126, NULL, 3, 11, 23, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 82),
(127, NULL, 4, 11, 0, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 82),
(128, NULL, 5, 11, 0, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 82),
(129, NULL, 6, 9, 0, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 82),
(130, NULL, 7, 9, 23, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 82),
(131, NULL, 1, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 84),
(132, NULL, 2, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 84),
(133, NULL, 3, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 84),
(134, NULL, 4, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 84),
(135, NULL, 5, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 84),
(136, NULL, 6, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 84),
(137, NULL, 7, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 84),
(138, NULL, 1, 20, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 85),
(139, NULL, 2, 20, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 85),
(140, NULL, 3, 20, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 85),
(141, NULL, 4, 20, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 85),
(142, NULL, 5, 20, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 85),
(143, NULL, 6, 20, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 85),
(144, NULL, 7, 20, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 85),
(145, NULL, 1, 7, 10, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 86),
(146, NULL, 1, 12, 23, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 86),
(147, NULL, 2, 7, 10, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 86),
(148, NULL, 2, 12, 23, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 86),
(149, NULL, 3, 7, 10, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 86),
(150, NULL, 3, 12, 23, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 86),
(151, NULL, 4, 7, 10, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 86),
(152, NULL, 4, 12, 23, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 86),
(153, NULL, 5, 7, 10, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 86),
(154, NULL, 5, 12, 23, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 86),
(155, NULL, 6, 7, 12, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 86),
(156, NULL, 6, 12, 22, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 86),
(157, NULL, 7, 7, 12, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 86),
(158, NULL, 7, 12, 22, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 86),
(159, NULL, 1, 9, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 88),
(160, NULL, 2, 9, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 88),
(161, NULL, 3, 9, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 88),
(162, NULL, 4, 9, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 88),
(163, NULL, 5, 9, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 88),
(164, NULL, 6, 9, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 88),
(165, NULL, 7, 9, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 88),
(166, NULL, 2, 18, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 90),
(167, NULL, 3, 18, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 90),
(168, NULL, 4, 18, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 90),
(169, NULL, 5, 18, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 90),
(170, NULL, 6, 18, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 90),
(171, NULL, 7, 18, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 90),
(172, NULL, 1, 10, 0, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 98),
(173, NULL, 2, 10, 0, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 98),
(174, NULL, 3, 10, 0, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 98),
(175, NULL, 4, 10, 0, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 98),
(176, NULL, 5, 10, 0, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 98),
(177, NULL, 6, 10, 0, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 98),
(178, NULL, 5, 22, 3, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 99),
(179, NULL, 1, 18, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 101),
(180, NULL, 2, 18, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 101),
(181, NULL, 3, 18, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 101),
(182, NULL, 4, 18, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 101),
(183, NULL, 5, 18, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 101),
(184, NULL, 6, 18, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 101),
(185, NULL, 7, 18, 0, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 101),
(186, NULL, 1, 6, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 102),
(187, NULL, 2, 6, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 102),
(188, NULL, 3, 6, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 102),
(189, NULL, 4, 6, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 102),
(190, NULL, 5, 6, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 102),
(191, NULL, 6, 6, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 102),
(192, NULL, 7, 6, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 102),
(193, NULL, 1, 18, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 105),
(194, NULL, 2, 18, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 105),
(195, NULL, 3, 18, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 105),
(196, NULL, 4, 18, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 105),
(197, NULL, 5, 18, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 105),
(198, NULL, 6, 18, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 105),
(199, NULL, 7, 18, 4, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 105),
(200, NULL, 3, 16, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 107),
(201, NULL, 4, 16, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 107),
(202, NULL, 5, 16, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 107),
(203, NULL, 6, 16, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 107),
(204, NULL, 7, 16, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 107),
(205, NULL, 1, 12, 23, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 109),
(206, NULL, 2, 12, 23, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 109),
(207, NULL, 3, 12, 23, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 109),
(208, NULL, 4, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 109),
(209, NULL, 5, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 109),
(210, NULL, 4, 23, 6, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 110),
(211, NULL, 5, 23, 6, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 110),
(212, NULL, 6, 23, 6, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 110),
(213, NULL, 7, 23, 6, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 110),
(214, NULL, 1, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 111),
(215, NULL, 2, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 111),
(216, NULL, 3, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 111),
(217, NULL, 4, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 111),
(218, NULL, 5, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 111),
(219, NULL, 6, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 111),
(220, NULL, 7, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 111),
(221, NULL, 1, 14, 22, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 118),
(222, NULL, 2, 14, 22, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 118),
(223, NULL, 3, 14, 22, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 118),
(224, NULL, 4, 14, 22, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 118),
(225, NULL, 5, 14, 22, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 118),
(226, NULL, 6, 14, 22, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 118),
(227, NULL, 7, 14, 22, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 118),
(228, NULL, 1, 17, 3, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 119),
(229, NULL, 2, 17, 3, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 119),
(230, NULL, 3, 17, 3, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 119),
(231, NULL, 4, 17, 3, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 119),
(232, NULL, 5, 17, 3, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 119),
(233, NULL, 6, 17, 3, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 119),
(234, NULL, 7, 17, 3, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 119),
(235, NULL, 1, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 127),
(236, NULL, 2, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 127),
(237, NULL, 3, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 127),
(238, NULL, 4, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 127),
(239, NULL, 5, 12, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 127),
(240, NULL, 6, 12, 2, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 127),
(241, NULL, 7, 12, 1, '2014-07-12 12:18:26', '2014-07-12 12:18:26', 127),
(242, NULL, 1, 11, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 128),
(243, NULL, 2, 11, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 128),
(244, NULL, 3, 11, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 128),
(245, NULL, 4, 11, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 128),
(246, NULL, 5, 11, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 128),
(247, NULL, 6, 11, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 128),
(248, NULL, 7, 12, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 128),
(249, NULL, 1, 17, 22, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 132),
(250, NULL, 2, 17, 22, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 132),
(251, NULL, 3, 12, 14, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 132),
(252, NULL, 3, 17, 22, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 132),
(253, NULL, 4, 12, 14, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 132),
(254, NULL, 4, 17, 22, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 132),
(255, NULL, 5, 12, 14, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 132),
(256, NULL, 5, 17, 22, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 132),
(257, NULL, 6, 12, 14, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 132),
(258, NULL, 6, 17, 22, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 132),
(259, NULL, 7, 12, 14, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 132),
(260, NULL, 7, 17, 22, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 132),
(261, NULL, 1, 17, 1, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 135),
(262, NULL, 2, 16, 1, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 135),
(263, NULL, 3, 17, 1, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 135),
(264, NULL, 4, 17, 1, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 135),
(265, NULL, 5, 17, 3, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 135),
(266, NULL, 6, 17, 3, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 135),
(267, NULL, 7, 17, 1, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 135),
(268, NULL, 1, 18, 3, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 138),
(269, NULL, 2, 18, 3, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 138),
(270, NULL, 3, 18, 3, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 138),
(271, NULL, 4, 18, 3, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 138),
(272, NULL, 5, 18, 3, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 138),
(273, NULL, 6, 18, 3, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 138),
(274, NULL, 7, 18, 3, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 138),
(275, NULL, 1, 17, 0, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 141),
(276, NULL, 2, 17, 1, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 141),
(277, NULL, 3, 17, 1, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 141),
(278, NULL, 4, 17, 1, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 141),
(279, NULL, 5, 17, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 141),
(280, NULL, 6, 18, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 141),
(281, NULL, 7, 17, 0, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 141),
(282, NULL, 2, 17, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 147),
(283, NULL, 3, 19, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 147),
(284, NULL, 4, 19, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 147),
(285, NULL, 5, 19, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 147),
(286, NULL, 6, 19, 3, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 147),
(287, NULL, 7, 12, 0, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 147),
(288, NULL, 1, 8, 0, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 149),
(289, NULL, 2, 8, 0, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 149),
(290, NULL, 3, 8, 0, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 149),
(291, NULL, 4, 8, 1, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 149),
(292, NULL, 5, 12, 3, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 149),
(293, NULL, 6, 12, 3, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 149),
(294, NULL, 1, 7, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 150),
(295, NULL, 2, 7, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 150),
(296, NULL, 3, 7, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 150),
(297, NULL, 4, 7, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 150),
(298, NULL, 5, 7, 4, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 150),
(299, NULL, 6, 7, 4, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 150),
(300, NULL, 7, 7, 2, '2014-07-12 12:18:27', '2014-07-12 12:18:27', 150);

-- --------------------------------------------------------

--
-- Structure de la table `wbb_bar_tag`
--

CREATE TABLE IF NOT EXISTS `wbb_bar_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bar_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `position` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `semsoftBar_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A42A296089A253A` (`bar_id`),
  KEY `IDX_A42A2960BAD26311` (`tag_id`),
  KEY `IDX_A42A2960D083AAA` (`semsoftBar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;

--
-- Contenu de la table `wbb_bar_tag`
--

INSERT INTO `wbb_bar_tag` (`id`, `bar_id`, `tag_id`, `position`, `created_at`, `updated_at`, `semsoftBar_id`, `type`) VALUES
(1, 4, 1, 1, '2014-06-05 14:37:19', '2014-06-27 19:07:14', NULL, ''),
(2, 1, 2, 1, '2014-06-05 14:39:01', '2014-07-11 12:58:25', NULL, '2'),
(3, 3, 1, 1, '2014-06-05 14:40:05', '2014-06-24 15:27:37', NULL, ''),
(4, 6, 2, 1, '2014-06-05 14:42:24', '2014-06-26 19:33:57', NULL, ''),
(5, 6, 3, 2, '2014-06-05 14:42:24', '2014-06-26 19:33:57', NULL, ''),
(7, 8, 5, 1, '2014-06-08 11:48:24', '2014-06-27 19:53:24', NULL, ''),
(12, 8, 3, 2, '2014-06-08 12:20:21', '2014-06-27 19:53:24', NULL, ''),
(13, 8, 2, 3, '2014-06-08 12:20:21', '2014-06-27 19:53:24', NULL, ''),
(14, 1, 1, 2, '2014-06-08 12:20:46', '2014-07-11 12:58:25', NULL, '1'),
(15, 1, 2, 3, '2014-06-08 12:20:46', '2014-07-11 12:58:25', NULL, '2'),
(16, 3, 4, 2, '2014-06-08 12:20:59', '2014-06-24 15:27:37', NULL, ''),
(17, 4, 4, 2, '2014-06-08 12:21:13', '2014-06-27 19:07:14', NULL, ''),
(19, 9, 1, 1, '2014-06-09 11:39:58', '2014-06-29 15:38:34', NULL, ''),
(20, 10, 1, 1, '2014-06-14 15:30:09', '2014-06-27 18:42:51', NULL, ''),
(21, 10, 2, 2, '2014-06-14 15:30:09', '2014-06-27 18:42:51', NULL, ''),
(22, 10, 5, 3, '2014-06-14 15:30:09', '2014-06-27 18:42:51', NULL, ''),
(23, 11, 2, 1, '2014-06-14 15:33:12', '2014-06-27 21:16:23', NULL, ''),
(24, 11, 6, 2, '2014-06-14 15:33:12', '2014-06-27 21:16:23', NULL, ''),
(25, 12, 1, 1, '2014-06-14 16:16:41', '2014-06-26 17:11:11', NULL, ''),
(26, 12, 2, 2, '2014-06-14 16:16:41', '2014-06-26 17:11:11', NULL, ''),
(27, 13, 1, 1, '2014-06-17 12:19:11', '2014-06-27 19:04:27', NULL, ''),
(28, 13, 4, 2, '2014-06-17 12:19:11', '2014-06-27 19:04:27', NULL, ''),
(29, 12, 6, 3, '2014-06-26 16:30:42', '2014-06-26 17:11:11', NULL, ''),
(30, 12, 5, 4, '2014-06-26 16:30:42', '2014-06-26 17:11:11', NULL, ''),
(32, 12, 4, 6, '2014-06-26 17:07:08', '2014-06-26 17:11:11', NULL, ''),
(33, 18, 5, 1, '2014-06-26 19:43:36', '2014-06-26 19:44:50', NULL, ''),
(34, 18, 2, 2, '2014-06-26 19:44:50', '2014-06-26 19:44:50', NULL, ''),
(35, 10, 3, 4, '2014-06-27 11:18:46', '2014-06-27 18:42:51', NULL, ''),
(36, 10, 4, 5, '2014-06-27 18:42:51', '2014-06-27 18:42:51', NULL, ''),
(37, 9, 5, 2, '2014-06-27 19:03:01', '2014-06-29 15:38:34', NULL, ''),
(38, 9, 2, 3, '2014-06-27 19:03:01', '2014-06-29 15:38:34', NULL, ''),
(39, 13, 2, 3, '2014-06-27 19:04:27', '2014-06-27 19:04:27', NULL, ''),
(40, 13, 5, 4, '2014-06-27 19:04:27', '2014-06-27 19:04:27', NULL, ''),
(41, 4, 2, 3, '2014-06-27 19:05:10', '2014-06-27 19:07:14', NULL, ''),
(42, 4, 5, 4, '2014-06-27 19:05:10', '2014-06-27 19:07:14', NULL, ''),
(43, 20, 5, 1, '2014-06-27 19:52:42', '2014-06-27 19:52:42', NULL, ''),
(44, 20, 6, 2, '2014-06-27 19:52:42', '2014-06-27 19:52:42', NULL, ''),
(45, 21, 4, 1, '2014-06-29 14:16:29', '2014-06-29 14:40:37', NULL, ''),
(46, 21, 1, 2, '2014-06-29 14:16:29', '2014-06-29 14:40:37', NULL, ''),
(47, 1, 4, 4, '2014-07-11 12:57:33', '2014-07-11 12:58:25', NULL, '2'),
(48, 1, 1, 5, '2014-07-11 12:57:33', '2014-07-11 12:58:25', NULL, '1');

-- --------------------------------------------------------

--
-- Structure de la table `wbb_bestof`
--

CREATE TABLE IF NOT EXISTS `wbb_bestof` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `sponsor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `by_tag` tinyint(1) DEFAULT NULL,
  `on_top` tinyint(1) DEFAULT NULL,
  `ordered` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `sponsorImage_id` int(11) DEFAULT NULL,
  `energyLevel_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_BAF14BBA989D9B62` (`slug`),
  KEY `IDX_BAF14BBA8BAC62AF` (`city_id`),
  KEY `IDX_BAF14BBAF92F3E70` (`country_id`),
  KEY `IDX_BAF14BBA3DA5256D` (`image_id`),
  KEY `IDX_BAF14BBAFAF5A804` (`sponsorImage_id`),
  KEY `IDX_BAF14BBA97B12258` (`energyLevel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Contenu de la table `wbb_bestof`
--

INSERT INTO `wbb_bestof` (`id`, `city_id`, `country_id`, `name`, `description`, `sponsor`, `seo_description`, `by_tag`, `on_top`, `ordered`, `created_at`, `updated_at`, `slug`, `image_id`, `sponsorImage_id`, `energyLevel_id`) VALUES
(1, NULL, 8, 'Sed augue ipsum', 'Vivamus in erat ut urna cursus vestibulum. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est. Integer tincidunt. Vivamus quis mi.', 'AMP', 'Vestibulum fringilla pede sit amet', 1, 0, 0, '2014-06-09 11:58:07', '2014-07-11 10:45:21', 'A', 128, NULL, 10),
(2, 4, 3, 'Fusce ac felis sit amet', 'Ut a nisl id ante tempus hendrerit. Nunc nec neque. Praesent egestas tristique nibh. Nullam tincidunt adipiscing enim.&nbsp;', 'APP', 'Proin pretium leo ac pellentesque', 1, 1, 1, '2014-06-09 11:58:39', '2014-07-11 11:51:05', 'b', 105, NULL, 10),
(3, 5, 3, 'Nunc interdum lacus sit amet', 'Aenean commodo ligula eget dolor', 'MPP', 'Suspendisse faucibus nunc et', 1, 0, 1, '2014-06-09 11:59:46', '2014-06-25 13:14:48', 'cc', 107, NULL, NULL),
(4, 2, 1, 'Fusce egestas elit eget lorem', 'Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Pellentesque posuere. Ut non enim eleifend felis pretium feugiat. Vivamus laoreet. Mauris sollicitudin fermentum libero.\r\n\r\nDonec id justo. Proin magna. Aenean imperdiet. Curabitur ullamcorper ultricies nisi. Ut a nisl id ante tempus hendrerit.\r\n\r\nPhasellus viverra nulla ut metus varius laoreet. Pellentesque commodo eros a enim. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Donec interdum, metus et hendrerit aliquet, dolor diam sagittis ligula, eget egestas libero turpis vel mi. Quisque rutrum.\r\n\r\nPraesent venenatis metus at tortor pulvinar varius. Fusce risus nisl, viverra et, tempor et, pretium in, sapien. Aenean ut eros et nisl sagittis vestibulum. Vivamus consectetuer hendrerit lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis.', 'PPP', 'Praesent egestas neque eu enim', 1, 0, 1, '2014-06-09 12:03:20', '2014-07-04 15:08:01', 'ff', 108, NULL, NULL),
(9, 2, 1, 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris erat libero, sagittis eu lacus ut, ullamcorper interdum enim. Etiam sagittis egestas vehicula. Duis cursus tellus et ullamcorper aliquet. Morbi dignissim posuere velit eget scelerisque. Vivamus lacinia quam vel neque interdum lobortis. Fusce aliquet ac turpis in vestibulum. Duis hendrerit tincidunt libero vel sagittis. Phasellus vehicula mi sed nibh tristique euismod.', 'sss', 'sdsd sdsdsd sdsds dsdsd sdsdsd sdsd', 1, 1, 1, '2014-06-14 16:28:11', '2014-06-27 20:58:08', 'dd', 109, NULL, NULL),
(10, 2, 1, 'Maecenas et mollis libero', '<b>Cras arcu metu</b>s, imperdiet a diam a, interdum dapibus nulla. Duis molestie dignissim luctus. Mauris vel viverra velit. Etiam eleifend dui semper lacus facilisis blandit. Etiam sodales, ligula eu tempus accumsan, diam orci suscipit leo, sed vehicula enim risus eu eros. Donec eget sapien eu nisl blandit egestas at non elit. Nam dictum, neque et eleifend auctor, enim nisl gravida nisl, eu consequat urna massa vitae purus. Sed ullamcorper pellentesque sapien, et lacinia dolor. Ut tristique arcu eget purus ornare, ac condimentum arcu laoreet. Vivamus elit orci, egestas vel aliquam at, malesuada eu turpis. Vestibulum non venenatis neque. Nunc et ornare augue, eu gravida metus. Nullam ac risus eu sapien vehicula vestibulum ac eu augue.', 'lojljlk', 'test', 1, 0, 1, '2014-06-14 16:30:04', '2014-06-27 20:52:51', 'ee', 110, NULL, NULL),
(13, NULL, NULL, 'Bloody Mary''s', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam \r\nnonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat \r\nvolutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation \r\nullamcorper suscipit lobortis nisl ut aliquip ex ea commodo con suscipit lobortissequat. \r\n suscipit lobortis suscipit lobortis suscipit lobortis suscipit lobortis  suscipit lobortis  suscipit lobortis<br><br><br>', 'Red bull', 'red bull sponsors this best of', 1, 1, 0, '2014-06-17 12:15:07', '2014-06-28 20:31:09', 'tt', 111, 130, NULL),
(14, 7, 2, 'wbb best of', 'description', NULL, NULL, 1, 0, 1, '2014-06-19 13:07:04', '2014-06-25 13:20:39', 'yy', 113, NULL, NULL),
(15, 2, 1, 'wbb bestof2', 'svzefv', NULL, NULL, 1, 0, 1, '2014-06-19 13:08:53', '2014-06-25 13:20:37', 'ii', 112, NULL, NULL),
(16, 1, 1, 'Bestof3', 'azdazdazda', NULL, NULL, 1, 0, 1, '2014-06-19 13:10:39', '2014-06-25 13:21:27', 'oo', 114, NULL, NULL),
(17, NULL, 5, 'Bestof4', 'arfar', NULL, NULL, 1, 0, 1, '2014-06-19 13:11:36', '2014-06-25 13:21:24', 'mm', 115, NULL, NULL),
(18, NULL, 1, 'bestof5', 'ezrgg', NULL, NULL, 1, 0, 1, '2014-06-19 13:13:10', '2014-06-26 19:54:50', 'pp', 116, NULL, NULL),
(19, NULL, NULL, 'JetSet', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam \r\nnonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat \r\nvolutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation \r\nullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. \r\nDuis autem vel eum iriure dolor in hendrerit in vulputate velit esse \r\nmolestie consequat, vel illum dolore eu feugiat nulla facilisis at vero \r\neros et accumsan et iusto odio dignissim qui blandit praesent luptatum \r\nzzril delenit augue duis dolore te feugait nulla facilisi. Nam liber \r\ntempor cum soluta nobis eleifend option congue nihil imperdiet doming id\r\n quod mazim placerat facer possim assum. Typi non habent claritatem \r\ninsitam; est usus legentis in iis qui facit eorum claritatem. \r\nInvestigationes demonstraverunt lectores legere me lius quod ii legunt \r\nsaepius. Claritas est etiam processus dynamicus, qui sequitur mutationem\r\n consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc\r\n putamus parum claram, anteposuerit litterarum formas humanitatis per \r\nseacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis \r\nvidentur parum clari, fiant sollemnes in futurum.<br>', 'Red Bull', 'Red bull sponsors best of', 0, 0, 1, '2014-06-19 13:14:39', '2014-06-27 20:52:59', 'nn', 117, 129, NULL),
(20, 4, 3, 'Bestof6', 'gherht', NULL, NULL, 1, 0, 1, '2014-06-19 13:17:34', '2014-06-25 13:22:18', 'zz', 118, NULL, NULL),
(21, 3, 2, 'Rooftop', 'sddfsdqf', NULL, 'qsdfqsdf', 0, 0, 0, '2014-06-20 16:15:46', '2014-06-26 19:55:33', 'qq', 119, NULL, NULL),
(22, NULL, NULL, 'Zen', 'test test<br>', 'test', 'test', 1, 1, 1, '2014-06-23 17:18:18', '2014-06-25 13:23:10', 'Zen', 120, NULL, NULL),
(23, 2, 1, 'Test URL', 'tes tes tes tkljdbcjkdbxvjkqdbv zksdcbsfhksdbc zsdkcfbsekdbcjzhshjékdvhc où ksdchksbcqc<br>', NULL, 'test seo', 1, 1, 1, '2014-06-27 19:25:53', '2014-06-27 21:01:23', 'Test-Url', 131, NULL, NULL),
(24, NULL, 4, 'test by tags off', NULL, NULL, NULL, 0, 1, 1, '2014-06-28 09:24:59', '2014-06-28 12:28:36', 'Test-By-Tags-Off', 134, NULL, NULL),
(25, 6, 2, 'Loundge', 'Description du best of<br>', NULL, 'SEO Description du best of', 1, 1, 1, '2014-06-29 14:28:31', '2014-06-29 14:33:16', 'Loundge', 138, NULL, NULL),
(26, 6, 2, 'Friendly Bars', 'Best of description<br>', NULL, 'SEO Description', 0, 1, 1, '2014-06-29 14:42:37', '2014-06-30 12:57:10', 'Friendly-Bars', 139, NULL, NULL),
(27, 6, 2, 'Popular Bars', 'Best of description<br>jdlk fmqslkdf mqsfd sqkd fqs<br>dfsdf qslkjdfsqdf<br>', NULL, 'SEO Description', 0, 1, 1, '2014-06-29 14:48:11', '2014-06-29 14:48:11', 'Popular-Bars', 140, NULL, NULL),
(28, NULL, NULL, 'Travellers', 'Best of description<br>', NULL, 'Best of description', 1, 1, 1, '2014-06-29 15:23:26', '2014-06-29 15:34:03', 'Travellers', 141, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `wbb_bestof_bar`
--

CREATE TABLE IF NOT EXISTS `wbb_bestof_bar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bestof_id` int(11) DEFAULT NULL,
  `bar_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `position` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1387D3E1DD8BC253` (`bestof_id`),
  KEY `IDX_1387D3E189A253A` (`bar_id`),
  KEY `IDX_1387D3E1EA9FDD75` (`media_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Contenu de la table `wbb_bestof_bar`
--

INSERT INTO `wbb_bestof_bar` (`id`, `bestof_id`, `bar_id`, `media_id`, `position`, `created_at`, `updated_at`, `description`) VALUES
(1, 9, 3, 2, 1, '2014-06-14 16:28:11', '2014-06-14 16:28:11', NULL),
(2, 9, 4, 3, 2, '2014-06-14 16:28:11', '2014-06-14 16:28:11', NULL),
(4, 1, 3, 6, 1, '2014-06-19 01:39:18', '2014-07-11 10:45:21', NULL),
(5, 1, 9, 13, 2, '2014-06-19 01:39:18', '2014-07-11 10:45:21', NULL),
(7, 2, 1, 2, 1, '2014-06-21 13:30:51', '2014-06-21 14:15:16', NULL),
(8, 2, 3, 3, 2, '2014-06-21 13:30:51', '2014-06-21 14:15:16', NULL),
(9, 2, 4, 1, 3, '2014-06-21 13:30:51', '2014-06-21 14:15:16', NULL),
(11, 2, 6, 3, 5, '2014-06-21 13:30:51', '2014-06-21 14:15:16', NULL),
(12, 2, 8, 4, 6, '2014-06-21 13:30:51', '2014-06-21 14:15:16', NULL),
(16, 2, 11, 6, 10, '2014-06-21 13:30:51', '2014-06-21 14:15:16', NULL),
(17, 2, 13, 4, 11, '2014-06-21 13:30:51', '2014-06-21 14:15:16', NULL),
(18, 2, 14, 6, 12, '2014-06-21 13:30:51', '2014-06-21 14:15:16', NULL),
(19, 21, 1, 17, 1, '2014-06-21 15:57:57', '2014-06-26 18:59:58', NULL),
(20, 21, 4, 2, 2, '2014-06-21 15:57:57', '2014-06-26 18:59:58', NULL),
(21, 21, 13, 24, 3, '2014-06-21 15:57:57', '2014-06-26 18:59:58', NULL),
(22, 21, 18, 29, 4, '2014-06-21 15:57:57', '2014-06-26 18:59:58', NULL),
(28, 13, 1, 17, 1, '2014-06-26 19:12:26', '2014-06-27 20:53:42', 'Sofitel facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus'),
(29, 13, 4, 35, 2, '2014-06-26 19:12:26', '2014-06-27 20:53:42', 'Silver facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus'),
(30, 13, 13, 24, 3, '2014-06-26 19:13:04', '2014-06-27 20:53:42', NULL),
(31, 13, 18, 29, 4, '2014-06-26 19:13:04', '2014-06-27 20:53:42', 'facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus'),
(32, 13, 6, 9, 5, '2014-06-26 19:36:58', '2014-06-27 20:53:42', 'facit eorum claritatem. Investigatione facit eorum claritatem. Investigatione'),
(33, 13, 15, 26, 6, '2014-06-26 19:36:58', '2014-06-27 20:53:42', 'facit eorum claritatem. Investigatione facit eorum claritatem. Investigatione facit eorum claritatem. Investigatione'),
(34, 13, 20, 31, 7, '2014-06-26 19:36:58', '2014-06-27 20:53:42', 'facit eorum claritatem. Investigatione facit eorum claritatem. Investigatione facit eorum claritatem. Investigatione'),
(36, 23, 1, NULL, 2, '2014-06-27 19:34:03', '2014-06-27 19:36:24', NULL),
(37, 23, 6, NULL, 1, '2014-06-27 19:36:00', '2014-06-27 19:36:24', NULL),
(38, 24, 4, NULL, 1, '2014-06-28 09:26:02', '2014-06-28 12:28:36', 'test'),
(39, 24, 9, NULL, 2, '2014-06-28 09:26:02', '2014-06-28 12:28:36', 'super'),
(40, 26, 21, 38, 1, '2014-06-29 14:42:37', '2014-06-30 12:58:48', 'Je mets ici le texte pour le roll over.'),
(41, 27, 21, 38, 1, '2014-06-29 14:48:11', '2014-06-29 14:48:11', 'TSEF SDLFGHJS');

-- --------------------------------------------------------

--
-- Structure de la table `wbb_bestof_bestof`
--

CREATE TABLE IF NOT EXISTS `wbb_bestof_bestof` (
  `bestof_id` int(11) NOT NULL,
  `in_bestof_id` int(11) NOT NULL,
  PRIMARY KEY (`bestof_id`,`in_bestof_id`),
  KEY `IDX_D6D851E5DD8BC253` (`bestof_id`),
  KEY `IDX_D6D851E5BF1126F0` (`in_bestof_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `wbb_bestof_bestof`
--

INSERT INTO `wbb_bestof_bestof` (`bestof_id`, `in_bestof_id`) VALUES
(1, 2),
(1, 9),
(2, 1),
(2, 3),
(2, 9),
(2, 14),
(2, 16),
(2, 20),
(2, 21),
(21, 2),
(27, 25),
(28, 13),
(28, 21),
(28, 28);

-- --------------------------------------------------------

--
-- Structure de la table `wbb_bestof_occasion`
--

CREATE TABLE IF NOT EXISTS `wbb_bestof_occasion` (
  `bestof_id` int(11) NOT NULL,
  `occasion_id` int(11) NOT NULL,
  PRIMARY KEY (`bestof_id`,`occasion_id`),
  KEY `IDX_74430C43DD8BC253` (`bestof_id`),
  KEY `IDX_74430C434034998F` (`occasion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `wbb_bestof_occasion`
--

INSERT INTO `wbb_bestof_occasion` (`bestof_id`, `occasion_id`) VALUES
(1, 6),
(1, 7),
(2, 6),
(2, 7);

-- --------------------------------------------------------

--
-- Structure de la table `wbb_bestof_tag`
--

CREATE TABLE IF NOT EXISTS `wbb_bestof_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bestof_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `position` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_66F1E8C8DD8BC253` (`bestof_id`),
  KEY `IDX_66F1E8C8BAD26311` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Contenu de la table `wbb_bestof_tag`
--

INSERT INTO `wbb_bestof_tag` (`id`, `bestof_id`, `tag_id`, `position`, `created_at`, `updated_at`, `type`) VALUES
(1, 9, 1, 1, '2014-06-14 16:28:11', '2014-06-27 20:58:08', ''),
(2, 9, 2, 2, '2014-06-14 16:28:11', '2014-06-27 20:58:08', ''),
(3, 10, 3, 1, '2014-06-14 16:30:04', '2014-06-25 13:19:42', ''),
(6, 21, 2, 1, '2014-06-26 10:45:37', '2014-06-26 18:59:39', ''),
(7, 2, 1, 1, '2014-06-26 10:46:50', '2014-07-11 11:51:05', '1'),
(8, 2, 2, 2, '2014-06-26 10:46:50', '2014-07-11 11:51:05', '2'),
(10, 15, 3, 1, '2014-06-26 10:47:03', '2014-06-26 10:47:03', ''),
(11, 15, 1, 2, '2014-06-26 10:47:03', '2014-06-26 10:47:03', ''),
(12, 16, 6, 1, '2014-06-26 10:47:23', '2014-06-26 10:47:23', ''),
(13, 21, 3, 2, '2014-06-26 12:44:02', '2014-06-26 18:59:39', ''),
(14, 13, 5, 1, '2014-06-26 19:41:33', '2014-06-28 20:31:09', ''),
(15, 13, 2, 2, '2014-06-26 19:41:33', '2014-06-28 20:31:09', ''),
(16, 23, 2, 1, '2014-06-27 19:25:53', '2014-06-27 21:01:23', ''),
(17, 23, 5, 2, '2014-06-27 19:25:53', '2014-06-27 21:01:23', ''),
(18, 1, 1, 1, '2014-06-27 20:56:32', '2014-07-11 11:02:41', '1'),
(19, 1, 2, 2, '2014-06-27 20:56:32', '2014-07-11 11:02:41', '2'),
(20, 9, 5, 3, '2014-06-27 20:57:58', '2014-06-27 20:58:08', ''),
(21, 25, 6, 1, '2014-06-29 14:30:18', '2014-06-29 14:33:16', ''),
(22, 25, 1, 2, '2014-06-29 14:31:14', '2014-06-29 14:33:16', ''),
(23, 28, 5, 1, '2014-06-29 15:23:45', '2014-06-29 15:34:11', ''),
(24, 28, 1, 2, '2014-06-29 15:24:18', '2014-06-29 15:34:11', ''),
(25, 26, 1, 1, '2014-06-30 10:53:31', '2014-06-30 12:57:10', ''),
(26, 26, 4, 2, '2014-06-30 13:11:02', '2014-06-30 12:57:10', '');

-- --------------------------------------------------------

--
-- Structure de la table `wbb_bestof_trend`
--

CREATE TABLE IF NOT EXISTS `wbb_bestof_trend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bestof_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `position` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1CA28C75DD8BC253` (`bestof_id`),
  KEY `IDX_1CA28C75BAD26311` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `wbb_best_of`
--

CREATE TABLE IF NOT EXISTS `wbb_best_of` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `best_of_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sponsor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sponsor_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seoDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `byTag` tinyint(1) DEFAULT NULL,
  `onTop` tinyint(1) DEFAULT NULL,
  `ordered` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A874DEE08BAC62AF` (`city_id`),
  KEY `IDX_A874DEE0F92F3E70` (`country_id`),
  KEY `IDX_A874DEE07B63F4D8` (`best_of_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `wbb_best_of`
--

INSERT INTO `wbb_best_of` (`id`, `city_id`, `country_id`, `best_of_id`, `name`, `description`, `image`, `sponsor`, `sponsor_image`, `seoDescription`, `byTag`, `onTop`, `ordered`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, 'test bestof', NULL, '77f868273b54f1384d61198611af90493a284552.jpeg', NULL, 'a71d9529dbc665f5655c1db041404cddf4c34954.jpeg', NULL, 1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, 'test', 'test', 'bec659ddfd354c5423beb2fcb1a4b4e20bf778c5.jpeg', NULL, '96a2a2de32fa57320b355aa7cc76948b41e86ac5.jpeg', NULL, 1, 1, 1, NULL, NULL),
(3, NULL, NULL, NULL, 'test', NULL, '6db4ad0075e08282fda29faca6c752668620d713.jpeg', NULL, '6512c4abfb84e75828389eb822cb80040580cfc3.jpeg', NULL, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `wbb_city`
--

CREATE TABLE IF NOT EXISTS `wbb_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `on_top` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2CFE314F989D9B62` (`slug`),
  KEY `IDX_2CFE314FF92F3E70` (`country_id`),
  KEY `IDX_2CFE314F3DA5256D` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Contenu de la table `wbb_city`
--

INSERT INTO `wbb_city` (`id`, `country_id`, `name`, `latitude`, `longitude`, `seo_description`, `on_top`, `created_at`, `updated_at`, `slug`, `image_id`) VALUES
(1, 1, 'Marrakesh', '31.63333330', '-8.00000000', 'Une ville qu''elle est sympa', 1, '2014-06-05 14:19:24', '2014-07-07 13:32:13', 'Marrakesh', 80),
(2, 1, 'Agadir', '30.43067802', '-9.59973798', NULL, 1, '2014-06-05 14:19:54', '2014-07-05 12:14:48', 'Agadir', 81),
(3, 2, 'Paris', '48.85661400', '2.35222190', NULL, 1, '2014-06-09 11:22:16', '2014-07-07 13:32:52', 'Paris', 82),
(4, 3, 'New York', '40.71278370', '-74.00594130', NULL, 1, '2014-06-09 11:22:25', '2014-07-04 14:55:52', 'New-York', 122),
(5, 3, 'Detroit', '42.33142700', '-83.04575380', NULL, 1, '2014-06-09 11:22:38', '2014-06-25 13:03:27', 'Detroit', 85),
(6, 2, 'Toulouse', '43.60465200', '1.44420900', NULL, 1, '2014-06-09 11:22:51', '2014-07-04 14:51:37', 'Toulouse', 125),
(7, 2, 'Nice', '43.71017280', '7.26195320', 'Un test de description', 0, '2014-06-09 11:22:58', '2014-06-25 13:04:46', 'Nice', 88),
(8, 4, 'London', '51.50735090', '-0.12775830', NULL, 1, '2014-06-09 11:23:13', '2014-06-25 13:05:06', 'London', 90),
(9, 6, 'Toronto', '43.65322600', '-79.38318430', NULL, 0, '2014-06-09 11:23:38', '2014-06-25 13:05:28', 'Toronto', 91),
(10, 1, 'Tanger', '35.76666670', '-5.80000000', NULL, 1, '2014-06-09 11:23:59', '2014-06-25 13:06:03', 'Tanger', 93),
(11, 1, 'Aga', '0.00000000', '0.00000000', 'DESDDEEE', 0, '2014-06-14 16:35:34', '2014-06-25 13:06:27', 'Aga', 95),
(12, 9, 'Rome', '41.87238890', '12.48018020', NULL, 1, '2014-06-17 12:08:17', '2014-06-25 13:06:51', 'Rome', 96),
(13, 7, 'Berlin', '52.52000660', '13.40473942', 'test', 1, '2014-06-17 12:09:01', '2014-06-25 13:08:02', 'Berlin', 100),
(14, 5, 'Zurich', '47.36864980', '8.53918250', 'test Zurich', 1, '2014-06-18 13:33:52', '2014-06-25 13:08:25', 'Zurich', 101),
(15, 3, 'Las Vegas', '36.25512300', '-99.99999999', 'Dream city las vegas', 1, '2014-06-19 13:06:23', '2014-06-25 13:08:49', 'Las-Vegas', 102),
(17, 3, 'Chicago', '41.87811360', '-87.62979820', 'azerty', 1, '2014-06-25 10:19:00', '2014-06-25 13:12:00', 'Chicago', 103),
(18, NULL, 'test', '31.51305560', '-9.76972220', NULL, 1, '2014-06-28 20:00:58', '2014-06-28 20:01:34', 'Test', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `wbb_city_bestof`
--

CREATE TABLE IF NOT EXISTS `wbb_city_bestof` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `bestof_id` int(11) DEFAULT NULL,
  `position` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_505C43958BAC62AF` (`city_id`),
  KEY `IDX_505C4395DD8BC253` (`bestof_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `wbb_city_bestof`
--

INSERT INTO `wbb_city_bestof` (`id`, `city_id`, `bestof_id`, `position`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 1, '2014-06-18 13:35:54', '2014-06-18 13:35:54'),
(2, NULL, 3, 2, '2014-06-18 13:35:54', '2014-06-18 13:35:54'),
(3, NULL, 4, 1, '2014-06-18 18:32:58', '2014-06-18 18:32:58'),
(4, NULL, 4, 1, '2014-06-18 18:36:55', '2014-06-18 18:36:55'),
(5, NULL, 3, 1, '2014-06-19 13:06:23', '2014-06-19 13:06:23'),
(6, NULL, 2, 2, '2014-06-19 13:06:23', '2014-06-19 13:06:23');

-- --------------------------------------------------------

--
-- Structure de la table `wbb_city_suburb`
--

CREATE TABLE IF NOT EXISTS `wbb_city_suburb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E950F7E1989D9B62` (`slug`),
  KEY `IDX_E950F7E18BAC62AF` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Contenu de la table `wbb_city_suburb`
--

INSERT INTO `wbb_city_suburb` (`id`, `city_id`, `name`, `created_at`, `updated_at`, `slug`) VALUES
(1, 1, 'Gueliz', '2014-06-05 14:19:24', '2014-06-05 14:19:24', 'Gueliz'),
(2, 1, 'Daoudiate', '2014-06-05 14:19:24', '2014-06-05 14:19:24', 'Daoudiate'),
(3, 2, 'Founty', '2014-06-05 14:19:54', '2014-06-05 14:19:54', 'Founty'),
(4, 2, 'Marina', '2014-06-05 14:40:48', '2014-06-05 14:40:48', 'Marina'),
(5, 1, 'Palmeraie', '2014-06-08 00:04:53', '2014-06-08 00:04:53', 'Palmeraie'),
(6, 1, 'Hivernage', '2014-06-08 11:31:17', '2014-06-08 11:31:17', 'Hivernage'),
(7, 3, 'Le Marais', '2014-06-09 11:33:03', '2014-06-17 11:57:13', 'Le-Marais'),
(8, 3, 'Le Louvre', '2014-06-17 11:57:13', '2014-06-17 11:57:13', 'Le-Louvre'),
(9, 3, 'Les Champs Elysées', '2014-06-17 11:57:13', '2014-06-17 11:57:13', 'Les-Champs-Elysees'),
(10, 12, 'Rome area', '2014-06-17 12:08:17', '2014-06-17 12:08:17', 'Rome-Area'),
(11, 13, 'Germany Area', '2014-06-17 12:09:01', '2014-06-17 12:09:01', 'Germany-Area'),
(12, 14, 'FIFA', '2014-06-18 13:33:52', '2014-06-18 13:33:52', 'Fifa'),
(13, 7, 'Super quartier', '2014-06-18 18:32:58', '2014-06-18 18:32:58', 'Super-Quartier'),
(14, 1, 'Medina', '2014-06-18 18:38:01', '2014-06-18 18:38:01', 'Medina'),
(15, 15, 'The strip', '2014-06-19 13:06:23', '2014-06-19 13:06:23', 'The-Strip'),
(16, 17, 'Downtown', '2014-06-25 10:19:00', '2014-06-25 10:19:00', 'Downtown'),
(17, 4, 'Lower Manhattan', '2014-06-26 16:28:28', '2014-06-26 16:28:28', 'Lower-Manhattan'),
(18, 9, 'pouchkine', '2014-06-27 21:15:19', '2014-06-27 21:15:19', 'Pouchkine'),
(19, 5, 'troy', '2014-06-27 21:16:14', '2014-06-27 21:16:14', 'Troy'),
(20, 6, 'Centre-ville', '2014-06-29 14:16:14', '2014-06-29 14:16:14', 'Centre-Ville'),
(23, 12, 'Vatican', '2014-07-05 11:00:34', '2014-07-05 11:00:34', 'Vatican'),
(24, 13, '', '2014-07-12 12:18:24', '2014-07-12 12:18:24', '-1'),
(25, 12, '', '2014-07-12 12:18:24', '2014-07-12 12:18:24', '-2'),
(26, 17, '', '2014-07-12 12:18:25', '2014-07-12 12:18:25', '-3'),
(27, 8, 'Covent Garden and Holborn', '2014-07-12 12:18:25', '2014-07-12 12:18:25', 'Covent-Garden-And-Holborn'),
(28, 4, 'Midtown Manhattan', '2014-07-12 12:18:25', '2014-07-12 12:18:25', 'Midtown-Manhattan'),
(29, 4, 'Lower East Manhattan', '2014-07-12 12:18:26', '2014-07-12 12:18:26', 'Lower-East-Manhattan'),
(30, 9, '', '2014-07-12 12:18:26', '2014-07-12 12:18:26', '-4'),
(31, 8, 'City and East London', '2014-07-12 12:18:26', '2014-07-12 12:18:26', 'City-And-East-London'),
(32, 7, '', '2014-07-12 12:18:26', '2014-07-12 12:18:26', '-5'),
(33, 3, 'St Germain and the Latin Quarter', '2014-07-12 12:18:26', '2014-07-12 12:18:26', 'St-Germain-And-The-Latin-Quarter'),
(34, 8, 'Soho and Fitzrovia', '2014-07-12 12:18:26', '2014-07-12 12:18:26', 'Soho-And-Fitzrovia'),
(35, 3, 'Champs Elysees', '2014-07-12 12:18:26', '2014-07-12 12:18:26', 'Champs-Elysees'),
(36, 15, '', '2014-07-12 12:18:27', '2014-07-12 12:18:27', '-6');

-- --------------------------------------------------------

--
-- Structure de la table `wbb_city_tag`
--

CREATE TABLE IF NOT EXISTS `wbb_city_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `position` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_10DBC9658BAC62AF` (`city_id`),
  KEY `IDX_10DBC965BAD26311` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `wbb_city_tag`
--

INSERT INTO `wbb_city_tag` (`id`, `city_id`, `tag_id`, `position`, `created_at`, `updated_at`) VALUES
(1, NULL, 3, 1, '2014-06-18 18:32:58', '2014-06-18 18:32:58'),
(2, NULL, 2, 1, '2014-06-19 13:06:23', '2014-06-19 13:06:23');

-- --------------------------------------------------------

--
-- Structure de la table `wbb_country`
--

CREATE TABLE IF NOT EXISTS `wbb_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `acronym` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_59007C814F34D596` (`ad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=251 ;

--
-- Contenu de la table `wbb_country`
--

INSERT INTO `wbb_country` (`id`, `ad_id`, `name`, `created_at`, `updated_at`, `acronym`) VALUES
(1, NULL, 'Morocco', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MA'),
(2, NULL, 'France', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'FR'),
(3, NULL, 'United States', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'US'),
(4, NULL, 'United Kingdom', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GB'),
(5, NULL, 'Switzerland', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CH'),
(6, NULL, 'Canada', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CA'),
(7, NULL, 'Germany', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'DE'),
(8, NULL, 'Spain', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'ES'),
(9, NULL, 'Italy', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'IT'),
(10, NULL, 'Afghanistan', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AF'),
(11, NULL, 'Aland Islands', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AX'),
(12, NULL, 'Albania', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AL'),
(13, NULL, 'Algeria', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'DZ'),
(14, NULL, 'American Samoa', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AS'),
(15, NULL, 'Andorra', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AD'),
(16, NULL, 'Angola', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AO'),
(17, NULL, 'Anguilla', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AI'),
(18, NULL, 'Antarctica', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AQ'),
(19, NULL, 'Antigua and Barbuda', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AG'),
(20, NULL, 'Argentina', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AR'),
(21, NULL, 'Armenia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AM'),
(22, NULL, 'Aruba', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AW'),
(23, NULL, 'Australia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AU'),
(24, NULL, 'Austria', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AT'),
(25, NULL, 'Azerbaijan', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AZ'),
(26, NULL, 'Bahamas', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BS'),
(27, NULL, 'Bahrain', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BH'),
(28, NULL, 'Bangladesh', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BD'),
(29, NULL, 'Barbados', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BB'),
(30, NULL, 'Belarus', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BY'),
(31, NULL, 'Belgium', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BE'),
(32, NULL, 'Belize', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BZ'),
(33, NULL, 'Benin', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BJ'),
(34, NULL, 'Bermuda', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BM'),
(35, NULL, 'Bhutan', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BT'),
(36, NULL, 'Bolivia, Plurinational State of', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BO'),
(37, NULL, 'Bonaire, Sint Eustatius and Saba', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BQ'),
(38, NULL, 'Bosnia and Herzegovina', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BA'),
(39, NULL, 'Botswana', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BW'),
(40, NULL, 'Bouvet Island', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BV'),
(41, NULL, 'Brazil', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BR'),
(42, NULL, 'British Indian Ocean Territory', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'IO'),
(43, NULL, 'Brunei Darussalam', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BN'),
(44, NULL, 'Bulgaria', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BG'),
(45, NULL, 'Burkina Faso', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BF'),
(46, NULL, 'Burundi', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BI'),
(47, NULL, 'Cambodia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'KH'),
(48, NULL, 'Cameroon', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CM'),
(49, NULL, 'Cape Verde', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CV'),
(50, NULL, 'Cayman Islands', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'KY'),
(51, NULL, 'Central African Republic', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CF'),
(52, NULL, 'Chad', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TD'),
(53, NULL, 'Chile', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CL'),
(54, NULL, 'China', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CN'),
(55, NULL, 'Christmas Island', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CX'),
(56, NULL, 'Cocos (Keeling) Islands', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CC'),
(57, NULL, 'Colombia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CO'),
(58, NULL, 'Comoros', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'KM'),
(59, NULL, 'Congo', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CG'),
(60, NULL, 'Congo, The Democratic Republic of the', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CD'),
(61, NULL, 'Cook Islands', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CK'),
(62, NULL, 'Costa Rica', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CR'),
(63, NULL, 'Cote d''Ivoire', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CI'),
(64, NULL, 'Croatia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'HR'),
(65, NULL, 'Cuba', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CU'),
(66, NULL, 'Curacao', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CW'),
(67, NULL, 'Cyprus', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CY'),
(68, NULL, 'Czech Republic', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'CZ'),
(69, NULL, 'Denmark', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'DK'),
(70, NULL, 'Djibouti', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'DJ'),
(71, NULL, 'Dominica', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'DM'),
(72, NULL, 'Dominican Republic', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'DO'),
(73, NULL, 'Ecuador', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'EC'),
(74, NULL, 'Egypt', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'EG'),
(75, NULL, 'El Salvador', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SV'),
(76, NULL, 'Equatorial Guinea', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GQ'),
(77, NULL, 'Eritrea', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'ER'),
(78, NULL, 'Estonia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'EE'),
(79, NULL, 'Ethiopia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'ET'),
(80, NULL, 'Falkland Islands (Malvinas)', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'FK'),
(81, NULL, 'Faroe Islands', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'FO'),
(82, NULL, 'Fiji', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'FJ'),
(83, NULL, 'Finland', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'FI'),
(84, NULL, 'French Guiana', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GF'),
(85, NULL, 'French Polynesia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'PF'),
(86, NULL, 'French Southern Territories', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TF'),
(87, NULL, 'Gabon', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GA'),
(88, NULL, 'Gambia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GM'),
(89, NULL, 'Georgia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GE'),
(90, NULL, 'Ghana', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GH'),
(91, NULL, 'Gibraltar', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GI'),
(92, NULL, 'Greece', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GR'),
(93, NULL, 'Greenland', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GL'),
(94, NULL, 'Grenada', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GD'),
(95, NULL, 'Guadeloupe', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GP'),
(96, NULL, 'Guam', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GU'),
(97, NULL, 'Guatemala', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GT'),
(98, NULL, 'Guernsey', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GG'),
(99, NULL, 'Guinea', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GN'),
(100, NULL, 'Guinea-Bissau', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GW'),
(101, NULL, 'Guyana', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GY'),
(102, NULL, 'Haiti', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'HT'),
(103, NULL, 'Heard Island and McDonald Islands', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'HM'),
(104, NULL, 'Holy See (Vatican City State)', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'VA'),
(105, NULL, 'Honduras', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'HN'),
(106, NULL, 'Hong Kong', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'HK'),
(107, NULL, 'Hungary', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'HU'),
(108, NULL, 'Iceland', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'IS'),
(109, NULL, 'India', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'IN'),
(110, NULL, 'Indonesia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'ID'),
(111, NULL, 'Iran, Islamic Republic of', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'IR'),
(112, NULL, 'Iraq', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'IQ'),
(113, NULL, 'Ireland', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'IE'),
(114, NULL, 'Isle of Man', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'IM'),
(115, NULL, 'Israel', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'IL'),
(116, NULL, 'Jamaica', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'JM'),
(117, NULL, 'Japan', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'JP'),
(118, NULL, 'Jersey', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'JE'),
(119, NULL, 'Jordan', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'JO'),
(120, NULL, 'Kazakhstan', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'KZ'),
(121, NULL, 'Kenya', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'KE'),
(122, NULL, 'Kiribati', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'KI'),
(123, NULL, 'Korea, Democratic People''s Republic of', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'KP'),
(124, NULL, 'Korea, Republic of', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'KR'),
(125, NULL, 'Kuwait', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'KW'),
(126, NULL, 'Kyrgyzstan', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'KG'),
(127, NULL, 'Lao People''s Democratic Republic', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'LA'),
(128, NULL, 'Latvia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'LV'),
(129, NULL, 'Lebanon', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'LB'),
(130, NULL, 'Lesotho', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'LS'),
(131, NULL, 'Liberia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'LR'),
(132, NULL, 'Libyan Arab Jamahiriya', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'LY'),
(133, NULL, 'Liechtenstein', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'LI'),
(134, NULL, 'Lithuania', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'LT'),
(135, NULL, 'Luxembourg', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'LU'),
(136, NULL, 'Macao', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MO'),
(137, NULL, 'Macedonia, The former Yugoslav Republic of', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MK'),
(138, NULL, 'Madagascar', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MG'),
(139, NULL, 'Malawi', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MW'),
(140, NULL, 'Malaysia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MY'),
(141, NULL, 'Maldives', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MV'),
(142, NULL, 'Mali', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'ML'),
(143, NULL, 'Malta', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MT'),
(144, NULL, 'Marshall Islands', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MH'),
(145, NULL, 'Martinique', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MQ'),
(146, NULL, 'Mauritania', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MR'),
(147, NULL, 'Mauritius', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MU'),
(148, NULL, 'Mayotte', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'YT'),
(149, NULL, 'Mexico', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MX'),
(150, NULL, 'Micronesia, Federated States of', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'FM'),
(151, NULL, 'Moldova, Republic of', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MD'),
(152, NULL, 'Monaco', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MC'),
(153, NULL, 'Mongolia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MN'),
(154, NULL, 'Montenegro', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'ME'),
(155, NULL, 'Montserrat', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MS'),
(156, NULL, 'Morocco', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MA'),
(157, NULL, 'Mozambique', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MZ'),
(158, NULL, 'Myanmar', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MM'),
(159, NULL, 'Namibia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'NA'),
(160, NULL, 'Nauru', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'NR'),
(161, NULL, 'Nepal', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'NP'),
(162, NULL, 'Netherlands', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'NL'),
(163, NULL, 'New Caledonia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'NC'),
(164, NULL, 'New Zealand', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'NZ'),
(165, NULL, 'Nicaragua', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'NI'),
(166, NULL, 'Niger', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'NE'),
(167, NULL, 'Nigeria', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'NG'),
(168, NULL, 'Niue', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'NU'),
(169, NULL, 'Norfolk Island', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'NF'),
(170, NULL, 'Northern Mariana Islands', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MP'),
(171, NULL, 'Norway', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'NO'),
(172, NULL, 'Oman', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'OM'),
(173, NULL, 'Pakistan', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'PK'),
(174, NULL, 'Palau', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'PW'),
(175, NULL, 'Palestinian Territory, Occupied', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'PS'),
(176, NULL, 'Panama', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'PA'),
(177, NULL, 'Papua New Guinea', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'PG'),
(178, NULL, 'Paraguay', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'PY'),
(179, NULL, 'Peru', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'PE'),
(180, NULL, 'Philippines', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'PH'),
(181, NULL, 'Pitcairn', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'PN'),
(182, NULL, 'Poland', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'PL'),
(183, NULL, 'Portugal', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'PT'),
(184, NULL, 'Puerto Rico', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'PR'),
(185, NULL, 'Qatar', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'QA'),
(186, NULL, 'Reunion', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'RE'),
(187, NULL, 'Romania', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'RO'),
(188, NULL, 'Russian Federation', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'RU'),
(189, NULL, 'Rwanda', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'RW'),
(190, NULL, 'Saint Barthelemy', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'BL'),
(191, NULL, 'Saint Helena, Ascension and Tristan Da Cunha', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SH'),
(192, NULL, 'Saint Kitts and Nevis', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'KN'),
(193, NULL, 'Saint Lucia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'LC'),
(194, NULL, 'Saint Martin (French Part)', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'MF'),
(195, NULL, 'Saint Pierre and Miquelon', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'PM'),
(196, NULL, 'Saint Vincent and The Grenadines', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'VC'),
(197, NULL, 'Samoa', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'WS'),
(198, NULL, 'San Marino', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SM'),
(199, NULL, 'Sao Tome and Principe', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'ST'),
(200, NULL, 'Saudi Arabia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SA'),
(201, NULL, 'Senegal', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SN'),
(202, NULL, 'Serbia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'RS'),
(203, NULL, 'Seychelles', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SC'),
(204, NULL, 'Sierra Leone', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SL'),
(205, NULL, 'Singapore', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SG'),
(206, NULL, 'Sint Maarten (Dutch Part)', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SX'),
(207, NULL, 'Slovakia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SK'),
(208, NULL, 'Slovenia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SI'),
(209, NULL, 'Solomon Islands', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SB'),
(210, NULL, 'Somalia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SO'),
(211, NULL, 'South Africa', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'ZA'),
(212, NULL, 'South Georgia and The South Sandwich Islands', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'GS'),
(213, NULL, 'South Sudan', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SS'),
(214, NULL, 'Sri Lanka', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'LK'),
(215, NULL, 'Sudan', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SD'),
(216, NULL, 'Suriname', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SR'),
(217, NULL, 'Svalbard and Jan Mayen', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SJ'),
(218, NULL, 'Swaziland', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SZ'),
(219, NULL, 'Sweden', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SE'),
(220, NULL, 'Syrian Arab Republic', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'SY'),
(221, NULL, 'Taiwan, Province of China', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TW'),
(222, NULL, 'Tajikistan', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TJ'),
(223, NULL, 'Tanzania, United Republic of', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TZ'),
(224, NULL, 'Thailand', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TH'),
(225, NULL, 'Timor-Leste', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TL'),
(226, NULL, 'Togo', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TG'),
(227, NULL, 'Tokelau', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TK'),
(228, NULL, 'Tonga', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TO'),
(229, NULL, 'Trinidad and Tobago', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TT'),
(230, NULL, 'Tunisia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TN'),
(231, NULL, 'Turkey', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TR'),
(232, NULL, 'Turkmenistan', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TM'),
(233, NULL, 'Turks and Caicos Islands', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TC'),
(234, NULL, 'Tuvalu', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'TV'),
(235, NULL, 'Uganda', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'UG'),
(236, NULL, 'Ukraine', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'UA'),
(237, NULL, 'United Arab Emirates', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'AE'),
(238, NULL, 'United States Minor Outlying Islands', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'UM'),
(239, NULL, 'Uruguay', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'UY'),
(240, NULL, 'Uzbekistan', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'UZ'),
(241, NULL, 'Vanuatu', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'VU'),
(242, NULL, 'Venezuela, Bolivarian Republic of', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'VE'),
(243, NULL, 'Viet Nam', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'VN'),
(244, NULL, 'Virgin Islands, British', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'VG'),
(245, NULL, 'Virgin Islands, U.S.', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'VI'),
(246, NULL, 'Wallis and Futuna', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'WF'),
(247, NULL, 'Western Sahara', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'EH'),
(248, NULL, 'Yemen', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'YE'),
(249, NULL, 'Zambia', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'ZM'),
(250, NULL, 'Zimbabwe', '2014-06-05 14:18:44', '2014-06-05 14:18:44', 'ZW');

-- --------------------------------------------------------

--
-- Structure de la table `wbb_news`
--

CREATE TABLE IF NOT EXISTS `wbb_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `share_text` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quote_author` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quote_text` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rich_description` longtext COLLATE utf8_unicode_ci,
  `is_an_interview` tinyint(1) DEFAULT NULL,
  `on_top` tinyint(1) DEFAULT NULL,
  `sponsor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `sponsorImage_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sponsorImageSmall_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1C76AA2B989D9B62` (`slug`),
  KEY `IDX_1C76AA2BB5A459A0` (`news_id`),
  KEY `IDX_1C76AA2BFAF5A804` (`sponsorImage_id`),
  KEY `IDX_1C76AA2BA13EB601` (`sponsorImageSmall_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `wbb_news`
--

INSERT INTO `wbb_news` (`id`, `news_id`, `title`, `share_text`, `quote_author`, `quote_text`, `seo_description`, `rich_description`, `is_an_interview`, `on_top`, `sponsor`, `created_at`, `updated_at`, `sponsorImage_id`, `slug`, `sponsorImageSmall_id`) VALUES
(2, 1, 'Nulla neque dolor sagittis', 'Aenean massa', 'Etiam feugiat lorem non', 'Maecenas vestibulum mollis diam', 'Pellentesque habitant morbi tristique senectus', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim eget porttitor condimentum. Nullam ut vehicula libero. Ut ante mauris, molestie eu augue eu, imperdiet semper magna. Nam lorem est, laoreet eget elementum eu, accumsan eget odio. Vivamus nunc lorem, suscipit ut gravida a, ultrices sit amet dui. Duis est metus, viverra ac metus eget, tincidunt varius diam. Curabitur ullamcorper urna sit amet lacus ultricies, quis vulputate lorem laoreet. Integer id lacus eu turpis tempor mattis. In in mi auctor, scelerisque odio sed, blandit justo. Aenean feugiat ante non fermentum tempus. Vestibulum eget dictum massa. Sed consequat rutrum mi aliquet egestas. Integer egestas, nisi ac placerat egestas, nisl lectus semper arcu, sed porttitor elit purus et urna. Praesent viverra consequat lacus, eu viverra sem venenatis non. Suspendisse potenti.Aenean id nisl nibh. Pellentesque eros turpis, blandit a eleifend at, aliquet eu mi. Donec sit amet dapibus mi. Donec a tellus vitae mauris gravida sagittis. Curabitur interdum dignissim lacus, ut pretium arcu imperdiet eget. Fusce consectetur dui a risus elementum, at fringilla magna pretium. In hac habitasse platea dictumst.Fusce dictum metus quis bibendum blandit. In eleifend mauris vitae urna porttitor, quis varius diam tincidunt. Pellentesque venenatis, urna a volutpat condimentum, lacus mi tincidunt sapien, eu sodales odio odio sed felis. Donec hendrerit gravida arcu in posuere. Praesent ipsum erat, posuere quis semper non, facilisis in mi. Donec vel leo urna. Ut vel iaculis elit, eu pulvinar lectus. In hac habitasse platea dictumst. Proin fringilla consequat gravida. Suspendisse lorem nulla, egestas a libero cursus, feugiat egestas metus. Proin quis turpis at lorem tincidunt vulputate. Donec lacinia eget mi at consectetur. Aenean vitae velit elementum urna venenatis molestie ut et tellus.<div><br></div>', 1, 0, 'KLA', '2014-06-09 11:52:05', '2014-06-23 16:49:57', NULL, 'b', NULL),
(3, 1, 'Praesent porttitor nulla vitae', 'Praesent ac', 'Pellentesque libero tortor tincidunt', 'Integer ante arcu accumsan a', 'Morbi mollis tellus ac sapien', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim eget porttitor condimentum. Nullam ut vehicula libero. Ut ante mauris, molestie eu augue eu, imperdiet semper magna. Nam lorem est, laoreet eget elementum eu, accumsan eget odio. Vivamus nunc lorem, suscipit ut gravida a, ultrices sit amet dui. Duis est metus, viverra ac metus eget, tincidunt varius diam. Curabitur ullamcorper urna sit amet lacus ultricies, quis vulputate lorem laoreet. Integer id lacus eu turpis tempor mattis. In in mi auctor, scelerisque odio sed, blandit justo. Aenean feugiat ante non fermentum tempus. Vestibulum eget dictum massa. Sed consequat rutrum mi aliquet egestas. Integer egestas, nisi ac placerat egestas, nisl lectus semper arcu, sed porttitor elit purus et urna. Praesent viverra consequat lacus, eu viverra sem venenatis non. Suspendisse potenti.Aenean id nisl nibh. Pellentesque eros turpis, blandit a eleifend at, aliquet eu mi. Donec sit amet dapibus mi. Donec a tellus vitae mauris gravida sagittis. Curabitur interdum dignissim lacus, ut pretium arcu imperdiet eget. Fusce consectetur dui a risus elementum, at fringilla magna pretium. In hac habitasse platea dictumst.Fusce dictum metus quis bibendum blandit. In eleifend mauris vitae urna porttitor, quis varius diam tincidunt. Pellentesque venenatis, urna a volutpat condimentum, lacus mi tincidunt sapien, eu sodales odio odio sed felis. Donec hendrerit gravida arcu in posuere. Praesent ipsum erat, posuere quis semper non, facilisis in mi. Donec vel leo urna. Ut vel iaculis elit, eu pulvinar lectus. In hac habitasse platea dictumst. Proin fringilla consequat gravida. Suspendisse lorem nulla, egestas a libero cursus, feugiat egestas metus. Proin quis turpis at lorem tincidunt vulputate. Donec lacinia eget mi at consectetur. Aenean vitae velit elementum urna venenatis molestie ut et tellus.In vitae purus vitae massa varius euismod. Donec congue, risus eu viverra viverra, ipsum erat porta erat, vel aliquet quam purus ut velit. Cras imperdiet tristique eros, eu fringilla velit imperdiet vel. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec vel porta libero. Nam at purus tempus, commodo turpis quis, tempor justo. Fusce ut aliquet purus. Curabitur a arcu eget orci tristique congue commodo pulvinar risus.Suspendisse nisi massa, egestas eget porttitor sed, pharetra at purus. Mauris tortor tortor, semper at risus nec, dignissim scelerisque urna. Quisque convallis mattis risus quis laoreet. Phasellus condimentum at mauris id laoreet. Duis id adipiscing dui. In erat risus, fringilla vitae tortor in, tincidunt fringilla odio. Ut sed nibh vel enim vestibulum eleifend. Curabitur non orci ac turpis sagittis pharetra non bibendum magna. Nullam vel commodo ante. In eu est et felis vehicula vulputate. Morbi mollis orci non magna fringilla pellentesque. Pellentesque purus leo, congue quis justo eu, accumsan suscipit diam. Nulla accumsan ipsum ac cursus volutpat.<div><br></div></div>', 1, 0, 'AMP', '2014-06-09 11:53:27', '2014-06-23 16:50:01', NULL, 'c', NULL),
(4, 1, 'Maecenas nec odio et', 'Pellentesque auctor neque nec urna', 'Pellentesque commodo eros a', 'Duis vel nibh at', 'Praesent congue erat at massa', '<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim eget porttitor condimentum. Nullam ut vehicula libero. Ut ante mauris, molestie eu augue eu, imperdiet semper magna. Nam lorem est, laoreet eget elementum eu, accumsan eget odio. Vivamus nunc lorem, suscipit ut gravida a, ultrices sit amet dui. Duis est metus, viverra ac metus eget, tincidunt varius diam. Curabitur ullamcorper urna sit amet lacus ultricies, quis vulputate lorem laoreet. Integer id lacus eu turpis tempor mattis. In in mi auctor, scelerisque odio sed, blandit justo. Aenean feugiat ante non fermentum tempus. Vestibulum eget dictum massa. Sed consequat rutrum mi aliquet egestas. Integer egestas, nisi ac placerat egestas, nisl lectus semper arcu, sed porttitor elit purus et urna. Praesent viverra consequat lacus, eu viverra sem venenatis non. Suspendisse potenti.Aenean id nisl nibh. Pellentesque eros turpis, blandit a eleifend at, aliquet eu mi. Donec sit amet dapibus mi. Donec a tellus vitae mauris gravida sagittis. Curabitur interdum dignissim lacus, ut pretium arcu imperdiet eget. Fusce consectetur dui a risus elementum, at fringilla magna pretium. In hac habitasse platea dictumst.Fusce dictum metus quis bibendum blandit. In eleifend mauris vitae urna porttitor, quis varius diam tincidunt. Pellentesque venenatis, urna a volutpat condimentum, lacus mi tincidunt sapien, eu sodales odio odio sed felis. Donec hendrerit gravida arcu in posuere. Praesent ipsum erat, posuere quis semper non, facilisis in mi. Donec vel leo urna. Ut vel iaculis elit, eu pulvinar lectus. In hac habitasse platea dictumst. Proin fringilla consequat gravida. Suspendisse lorem nulla, egestas a libero cursus, feugiat egestas metus. Proin quis turpis at lorem tincidunt vulputate. Donec lacinia eget mi at consectetur. Aenean vitae velit elementum urna venenatis molestie ut et tellus.In vitae purus vitae massa varius euismod. Donec congue, risus eu viverra viverra, ipsum erat porta erat, vel aliquet quam purus ut velit. Cras imperdiet tristique eros, eu fringilla velit imperdiet vel. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec vel porta libero. Nam at purus tempus, commodo turpis quis, tempor justo. Fusce ut aliquet purus. Curabitur a arcu eget orci tristique congue commodo pulvinar risus.Suspendisse nisi massa, egestas eget porttitor sed, pharetra at purus. Mauris tortor tortor, semper at risus nec, dignissim scelerisque urna. Quisque convallis mattis risus quis laoreet. Phasellus condimentum at mauris id laoreet. Duis id adipiscing dui. In erat risus, fringilla vitae tortor in, tincidunt fringilla odio. Ut sed nibh vel enim vestibulum eleifend. Curabitur non orci ac turpis sagittis pharetra non bibendum magna. Nullam vel commodo ante. In eu est et felis vehicula vulputate. Morbi mollis orci non magna fringilla pellentesque. Pellentesque purus leo, congue quis justo eu, accumsan suscipit diam. Nulla accumsan ipsum ac cursus volutpat.<div><br></div></div>', 1, 1, 'APP', '2014-06-09 11:54:52', '2014-06-23 16:57:55', NULL, 'd', NULL),
(5, 1, 'Sofitel Test', 'test test', 'test test test test', 'test test test test test', 'test test', 'Lorem Ipsum is simply dummy text of the printing and <br>\r\ntypesetting industry. Lorem Ipsum has been the industry''s standard dummy<br>\r\n text ever since the 1500s, when an unknown printer took a galley of <br>\r\ntype and scrambled it to make a type specimen book. It has survived not <br>\r\nonly five centuries, but also the leap into electronic typesetting, <br>\r\nremaining essentially unchanged. It was popularised in the 1960s with <br>\r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more<br>\r\n recently with desktop publishing software like Aldus PageMaker <br>\r\nincluding versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and <br>\r\ntypesetting industry. Lorem Ipsum has been the industry''s standard dummy<br>\r\n text ever since the 1500s, when an unknown printer took a galley of <br>\r\ntype and scrambled it to make a type specimen book. It has survived not <br>\r\nonly five centuries, but also the leap into electronic typesetting, <br>\r\nremaining essentially unchanged. It was popularised in the 1960s with <br>\r\nthe release of Letraset sheets containing Lorem Ipsum passages, and more<br>\r\n recently with desktop publishing software like Aldus PageMaker <br>\r\nincluding versions of Lorem Ipsum.<br>', 1, 1, 'test', '2014-06-16 16:16:34', '2014-06-23 16:50:10', 3, 'e', NULL),
(6, 1, 'Test Buddha bar', 'test test test test', 'test test test test test test test test', 'test test test test test test test', 'test seo description', 'test test test test test test test 1 test test test test test test test 2 test test test test test test test3 test test test test test test test 4 test test test test test test test 5 test test test test test test test 7 <b></b><br><br><br><br><br><br>', 1, 1, 'test', '2014-06-18 12:52:01', '2014-06-23 16:56:32', 37, 'f', NULL),
(7, 1, 'test news', 'test news', 'test news test news test news', 'test news test news', 'test news test news test news', 'test news test news test news test news test news test news1<br><br><br><br><br><br>', 1, 0, 'test', '2014-06-23 17:23:47', '2014-06-23 17:28:50', 55, 'g', NULL),
(8, 1, 'Article 10', 'Share 10', 'Author 10', 'Quote 10', 'Seo 10', 'Description 10', 0, 1, NULL, '2014-06-28 22:52:45', '2014-06-28 22:56:34', NULL, 'h', NULL),
(9, 1, 'Article 11', 'Share 11', 'Quote 11', 'Text 11', 'SEO 11', 'description 11', 0, 1, NULL, '2014-06-28 22:53:25', '2014-06-28 22:56:30', NULL, 'i', NULL),
(10, 1, 'Article 12', 'Share 12', 'Author 12', 'Quote 12', 'SEO 12', 'Description 12', 0, 1, NULL, '2014-06-28 22:54:42', '2014-06-28 22:56:25', NULL, 'j', NULL),
(11, 1, 'Article 13', 'Share 13', 'Author 13', 'Quote 13', 'SEO 13', 'Description 13', 1, 1, NULL, '2014-06-28 22:55:06', '2014-06-28 22:55:06', NULL, 'k', NULL),
(12, 1, 'Article 14', 'Share 14', 'Author 14', 'Quote 14', 'SEO 14', 'Description 14', 1, 1, NULL, '2014-06-28 22:55:26', '2014-06-28 22:55:26', NULL, 'l', NULL),
(13, 1, 'Article 15', 'Share 15', 'Author 15', 'Quote 15', 'SEO 15', 'Description 15', 0, 1, NULL, '2014-06-28 22:55:59', '2014-06-28 22:56:20', NULL, 'm', NULL),
(14, 1, 'Article 16', 'Share 16', 'Quote 16', 'Text 16', 'SEO 16', 'Description 16', 1, 0, NULL, '2014-06-28 22:58:59', '2014-06-28 22:58:59', NULL, 'n', NULL),
(15, 1, 'rtyjrtj', NULL, NULL, NULL, NULL, 'rtujyrturuk', 1, 1, NULL, '2014-07-05 12:56:07', '2014-07-05 12:56:07', NULL, 'Rtyjrtj', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `wbb_news_bars`
--

CREATE TABLE IF NOT EXISTS `wbb_news_bars` (
  `bar_id` int(11) NOT NULL,
  `new_id` int(11) NOT NULL,
  PRIMARY KEY (`bar_id`,`new_id`),
  KEY `IDX_5292A4A189A253A` (`bar_id`),
  KEY `IDX_5292A4A1BD06B3B3` (`new_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `wbb_news_bars`
--

INSERT INTO `wbb_news_bars` (`bar_id`, `new_id`) VALUES
(1, 2),
(8, 2);

-- --------------------------------------------------------

--
-- Structure de la table `wbb_news_bestofs`
--

CREATE TABLE IF NOT EXISTS `wbb_news_bestofs` (
  `bestof_id` int(11) NOT NULL,
  `new_id` int(11) NOT NULL,
  PRIMARY KEY (`bestof_id`,`new_id`),
  KEY `IDX_71975637DD8BC253` (`bestof_id`),
  KEY `IDX_71975637BD06B3B3` (`new_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `wbb_news_bestofs`
--

INSERT INTO `wbb_news_bestofs` (`bestof_id`, `new_id`) VALUES
(1, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `wbb_news_cities`
--

CREATE TABLE IF NOT EXISTS `wbb_news_cities` (
  `city_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  PRIMARY KEY (`city_id`,`news_id`),
  KEY `IDX_390EF44E8BAC62AF` (`city_id`),
  KEY `IDX_390EF44EB5A459A0` (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `wbb_news_cities`
--

INSERT INTO `wbb_news_cities` (`city_id`, `news_id`) VALUES
(1, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `wbb_news_media`
--

CREATE TABLE IF NOT EXISTS `wbb_news_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `position` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EC809A06B5A459A0` (`news_id`),
  KEY `IDX_EC809A06EA9FDD75` (`media_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Contenu de la table `wbb_news_media`
--

INSERT INTO `wbb_news_media` (`id`, `news_id`, `media_id`, `alt`, `created_at`, `updated_at`, `position`) VALUES
(1, NULL, 10, NULL, '2014-06-09 11:52:05', '2014-06-09 11:52:05', NULL),
(2, NULL, 11, NULL, '2014-06-09 11:53:27', '2014-06-09 11:53:27', NULL),
(3, NULL, 12, NULL, '2014-06-09 11:54:52', '2014-06-09 11:54:52', NULL),
(4, NULL, 13, NULL, '2014-06-09 11:55:32', '2014-06-09 11:55:32', NULL),
(5, NULL, 20, NULL, '2014-06-13 13:23:41', '2014-06-13 13:23:41', NULL),
(6, NULL, 21, NULL, '2014-06-13 13:24:36', '2014-06-13 13:24:36', NULL),
(7, NULL, 22, NULL, '2014-06-13 13:25:25', '2014-06-13 13:25:25', NULL),
(8, NULL, 23, NULL, '2014-06-13 13:25:35', '2014-06-13 13:25:35', NULL),
(9, NULL, 24, NULL, '2014-06-13 13:33:05', '2014-06-13 13:33:05', NULL),
(10, NULL, 25, NULL, '2014-06-13 13:34:36', '2014-06-13 13:34:36', NULL),
(11, NULL, 26, NULL, '2014-06-13 16:18:05', '2014-06-13 16:18:05', NULL),
(13, 2, 27, NULL, '2014-06-13 16:20:42', '2014-07-07 13:32:52', 1),
(14, 3, 13, NULL, '2014-06-13 16:21:18', '2014-06-13 16:21:18', NULL),
(15, 4, 28, NULL, '2014-06-13 16:21:44', '2014-06-13 16:21:44', NULL),
(16, 5, 1, NULL, '2014-06-16 16:17:07', '2014-06-16 16:17:07', NULL),
(17, 6, 38, 'test alt', '2014-06-18 12:52:30', '2014-06-18 12:52:30', NULL),
(18, 7, 47, NULL, '2014-06-28 22:50:47', '2014-06-28 22:50:47', NULL),
(19, 8, 133, 'Alternative 10', '2014-06-28 22:52:45', '2014-06-28 22:52:45', NULL),
(20, 9, 46, NULL, '2014-06-28 22:53:25', '2014-06-28 22:53:25', NULL),
(21, 10, 9, NULL, '2014-06-28 22:54:42', '2014-06-28 22:54:42', NULL),
(22, 13, 5, NULL, '2014-06-28 22:55:59', '2014-06-28 22:55:59', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `wbb_semsoft_imported_bar`
--

CREATE TABLE IF NOT EXISTS `wbb_semsoft_imported_bar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `suburb_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `county` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `latitude` decimal(10,0) DEFAULT NULL,
  `longitude` decimal(10,0) DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` smallint(6) DEFAULT NULL,
  `is_credit_card` tinyint(1) DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `is_out_door_seating` tinyint(1) DEFAULT NULL,
  `is_happy_hour` tinyint(1) DEFAULT NULL,
  `is_wifi` tinyint(1) DEFAULT NULL,
  `menu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reservation` tinyint(1) DEFAULT NULL,
  `parking_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_user_page` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_user_page` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram_user_page` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_plus_user_page` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foursquare_check_ins` int(11) DEFAULT NULL,
  `facebook_check_ins` int(11) DEFAULT NULL,
  `foursquare_likes` int(11) DEFAULT NULL,
  `facebook_likes` int(11) DEFAULT NULL,
  `is_permanently_closed` tinyint(1) DEFAULT NULL,
  `business_found` tinyint(1) DEFAULT NULL,
  `updated_columns` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `overwritten_columns` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `address` longtext COLLATE utf8_unicode_ci,
  `foursquare_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foursquare_user_page` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foursquare_tips` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `bar_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DFC4FF6B8BAC62AF` (`city_id`),
  KEY `IDX_DFC4FF6B76C25F1` (`suburb_id`),
  KEY `IDX_DFC4FF6BF92F3E70` (`country_id`),
  KEY `IDX_DFC4FF6B89A253A` (`bar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=156 ;

--
-- Contenu de la table `wbb_semsoft_imported_bar`
--

INSERT INTO `wbb_semsoft_imported_bar` (`id`, `city_id`, `suburb_id`, `name`, `county`, `postal_code`, `description`, `latitude`, `longitude`, `website`, `email`, `phone`, `price`, `is_credit_card`, `seo_description`, `is_out_door_seating`, `is_happy_hour`, `is_wifi`, `menu`, `reservation`, `parking_type`, `facebook_id`, `facebook_user_page`, `twitter_name`, `twitter_user_page`, `instagram_id`, `instagram_user_page`, `google_plus_user_page`, `foursquare_check_ins`, `facebook_check_ins`, `foursquare_likes`, `facebook_likes`, `is_permanently_closed`, `business_found`, `updated_columns`, `overwritten_columns`, `address`, `foursquare_id`, `foursquare_user_page`, `foursquare_tips`, `country_id`, `bar_id`) VALUES
(56, 13, 24, 'Bar 203', 'Berlin', '10178', 'Bar 203 - the TV Tower - is the tallest structure in Germany and one of the most iconic buildings Berlin. Built by the DDR as a symbol of the east, a beacon of progress, it remains one of the most distinctive buildings in the city, an enormous silver ball perched atop a silver spike and capped with a red and white striped needle reminiscent of the rocket in Tintin: Destination Moon, a mid-twentieth century view of the future. Speaking of views, the building also houses a restaurant and a fully stocked bar that offers – at 203 metres above Berlin - one of the highest and best panoramas of the city. This is the place to head to take in a classic cocktail while looking out on the bustle of Berlin below and musing on the complex changes that century has wrought on the place. You’ll be aided in your contemplation by the revolving of the restaurant as it makes a full 360-degree rotation every 30 minutes. It’s a white, light space, the view the main focus of the room, the Reichstag and the Tiergarten dotted below. Grab a glass of wine or a G&T and play spot the landmark. On a clear day you can see for well over twenty miles around.Bar Interior Photographer: Katrin Bernsteiner', '53', '13', 'http://www.tv-turm.de/de/bar.php', '', '', 3, 1, 'Bar 203 - the TV Tower - is the tallest structure in Germany and one of the most iconic buildings Berlin. Built by the DDR as a symbol of the east, a beacon of progress...', 1, 0, 0, '', 0, '', '', '', '', '', '177527496', 'http://instagram.com/Bar+203', '', 24, 0, 2, 0, 0, 0, 'a:14:{i:0;s:6:"County";i:1;s:8:" Street2";i:2;s:8:" Website";i:3;s:9:" Category";i:4;s:15:" OutdoorSeating";i:5;s:11:" PriceRange";i:6;s:16:" PaymentAccepted";i:7;s:12:" InstagramId";i:8;s:18:" InstagramUserPage";i:9;s:13:" FoursquareId";i:10;s:19:" FoursquareUserPage";i:11;s:16:" FoursquareLikes";i:12;s:19:" FoursquareCheckIns";i:13;s:15:" FoursquareTips";}', 'a:3:{i:0;s:7:"Country";i:1;s:8:" Street1";i:2;s:20:" GeocoordinateString";}', 'Panoramastr. 1A Fernsehturm', '524c7f9711d259b1d4cd219a', 'https://foursquare.com/v/bar-203/524c7f9711d259b1d4cd219a', 1, 7, NULL),
(57, NULL, NULL, 'Blah', '', '', '', '58', '12', '', '', '', 0, 0, ' ', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', ' ', '', '', 0, NULL, NULL),
(58, NULL, NULL, 'Baronetti', '', '22411000', '   Pricey, upscale restaurant-lounge-club in salubrious Ipanema, the Notting Hill of Rio. The interior is done in plush, modern white tones which effectively accentuates the coffee-brown skin of the designer-clad girls from Ipanema who come walking by. As if they needed the help! In the upstairs lounge and restaurant you can grab bites of succulent sushi and fine cocktails, while the club is in a larger downstairs space, with home-grown DJs specialising in American house that is perfect for dancing. There are dozens of nearby spots to visit should the sight of shapely model types bore you.  ', '-23', '-43', 'http://www.baronneti.com.br', '', '5,52122E+11', 0, 0, '   Pricey, upscale restaurant-lounge-club in salubrious Ipanema, the Notting Hill of Rio. The interior is done in plush, modern white tones which effectively ...', 0, 0, 0, '', 0, '', '1,43548E+14', 'https://www.facebook.com/pages/Baronetti/143547512383532', '', '', '308678041', 'http://instagram.com/Baronetti', '', 0, 4448, 0, 628, 0, 0, 'a:9:{i:0;s:10:"PostalCode";i:1;s:8:" Website";i:2;s:9:" Category";i:3;s:11:" FacebookId";i:4;s:17:" FacebookUserPage";i:5;s:12:" InstagramId";i:6;s:18:" InstagramUserPage";i:7;s:14:" FacebookLikes";i:8;s:17:" FacebookCheckins";}', 'a:3:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:6:" Phone";}', 'Rua Barão da Torre, 354 ', '', '', 0, 41, NULL),
(59, NULL, NULL, 'The Balcony', 'Bangkok', '10500', ' A new Silom Soi favourite, with the usual outdoor seating to satisfy the voyeur in you all. The two balconies, on both sides of the street, are popular spots to both see and be seen, and as this lively nightlife area is usually heaving with revellers there’s plenty to look at. However, the inside lounge is possibly even better than the terraces, with a long circular bar that is a throwback to Fifties Hollywood. We grant you the soft sofas are more ''Friends'' than ''Frank'' but it shouldn''t stop you lighting up a cigar and sipping on a whiskey. Pull up a bar stool or grab a seat at one of the tables. Upstairs, another bar offers a fine aerial view of the soi, plus games machines and a karaoke lounge for potential revelry. The cabaret nights here are hotly anticipated and the bar also hosts a range of special events during festive periods. Open from 5:30pm till late, the bar offers a range of Thai dishes and international fast food, so you can settle in for a night of eating and drinking. Happy hour runs from 5:30 – 8pm, with deals on house drinks, jugs of cocktails and beer pitchers, but the crowds really start piling in around 9:30pm.Silom Soi 4 is well known for its gay nightlife and The Balcony is a gay bar, but straight – and curious -clients are warmly welcomed too. The resulting crowd is made up of a heady mix of trendsetters and adventurous tourists – the perfect recipe for a fun night out. ', '14', '101', 'http://www.balconypub.com', 'info@balconypub.com', '6622355891', 0, 1, ' A new Silom Soi favourite, with the usual outdoor seating to satisfy the voyeur in you all. The two balconies, on both sides of the street...', 1, 1, 1, '', 0, '', '', '', '', '', '1451081', 'http://instagram.com/The+Balcony', '', 1781, 0, 19, 0, 0, 0, 'a:13:{i:0;s:6:"County";i:1;s:9:" Category";i:2;s:15:" OutdoorSeating";i:3;s:10:" HappyHour";i:4;s:5:" Wifi";i:5;s:16:" PaymentAccepted";i:6;s:12:" InstagramId";i:7;s:18:" InstagramUserPage";i:8;s:13:" FoursquareId";i:9;s:19:" FoursquareUserPage";i:10;s:16:" FoursquareLikes";i:11;s:19:" FoursquareCheckIns";i:12;s:15:" FoursquareTips";}', 'a:3:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:6:" Phone";}', 'Silom Soi 4 Silom Road', '4b0587f7f964a5206aa922e3', 'https://foursquare.com/v/the-balcony/4b0587f7f964a5206aa922e3', 16, 224, NULL),
(60, NULL, NULL, 'Bubbledogs', 'Greater London', 'W1T 4QG', ' Bubbledogs is the apotheosis of this, a restaurant which only serves hot dogs and Champagne (alongside other sparkling wines). Sandia Chang and James Knappett''s hotly anticipated Charlotte Street joint serves ten kinds of dog in a handsome space featuring exposed brickwork, wood panelling and stylish mirrors. The K-Dog, topped with spicy kimchee, and the guacamole-laden José are the top dogs, but there’s fun to be had working your way through the whole menu. Wash these down with copious amounts of well-priced and well-sourced fizz. Keep an eye out for the Kitchen Table, due to open later in the year.', '52', '0', 'http://www.bubbledogs.co.uk', '', '4,42076E+11', 1, 1, ' Bubbledogs is the apotheosis of this, a restaurant which only serves hot dogs and Champagne (alongside other sparkling wines). ', 0, 0, 0, 'foursquare.com/v/bubbledogs/4f861896e4b0820432cec5f8/menu', 0, '', '1,55456E+14', 'https://www.facebook.com/bubbledogsuk', 'bubbledogsuk', 'https://www.twitter.com/bubbledogsuk', '222290464', 'http://instagram.com/Bubbledogs%26', '', 1348, 4555, 71, 1093, 0, 0, 'a:29:{i:0;s:6:"County";i:1;s:16:" MondayOpenHours";i:2;s:17:" TuesdayOpenHours";i:3;s:19:" WednesdayOpenHours";i:4;s:18:" ThursdayOpenHours";i:5;s:16:" FridayOpenHours";i:6;s:18:" SaturdayOpenHours";i:7;s:16:" SundayOpenHours";i:8;s:9:" Category";i:9;s:15:" OutdoorSeating";i:10;s:5:" Wifi";i:11;s:11:" PriceRange";i:12;s:16:" PaymentAccepted";i:13;s:19:" RestaurantServices";i:14;s:8:" MenuUrl";i:15;s:16:" PublicTransport";i:16;s:11:" FacebookId";i:17;s:17:" FacebookUserPage";i:18;s:12:" TwitterName";i:19;s:16:" TwitterUserPage";i:20;s:12:" InstagramId";i:21;s:18:" InstagramUserPage";i:22;s:13:" FoursquareId";i:23;s:19:" FoursquareUserPage";i:24;s:14:" FacebookLikes";i:25;s:17:" FacebookCheckins";i:26;s:16:" FoursquareLikes";i:27;s:19:" FoursquareCheckIns";i:28;s:15:" FoursquareTips";}', 'a:6:{i:0;s:7:"Country";i:1;s:5:" City";i:2;s:8:" Street1";i:3;s:20:" GeocoordinateString";i:4;s:8:" Website";i:5;s:6:" Phone";}', '70 Charlotte St ', '4f861896e4b0820432cec5f8', 'https://foursquare.com/v/bubbledogs/4f861896e4b0820432cec5f8', 58, 4, NULL),
(61, 12, 25, 'Bartaruga', '', '', ' Chic, Baroque-style bar, a favoured haunt of local celebs, models and media types. Which might mean you. Located in Piazza Mattei, it''s a grand interior, with ornate ceilings and furniture, complimented by a pricey yet creative drinks list. Music runs from soul and funk to house and techno and gets louder as the night goes on, when those dusky Roman beauties in Versace hit the dance floor. It''s open late but we say get there early to book your place at the bar. And keep your eyes on those beauties.', '42', '12', 'http://www.bartaruga.com/', '', '00 39 6689 2299', 0, 0, ' Chic, Baroque-style bar, a favoured haunt of local celebs, models and media types. Which might mean you. Located in Piazza Mattei, it''s a grand interior, ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', 'Piazza Mattei 8 ', '', '', 0, 9, NULL),
(62, NULL, NULL, 'Oak Room', 'Capital Region', '2200', ' Done less on the lines of the walnut-paneled masterpiece that was the famed Park Room in New York''s Plaza Hotel than a chic and stylish hipster hangout that suits this city, they more than make up for the flightiness of the setting in the drinks selection. Wine is abundant as are the spirits but it''s the cocktail concoctions that stand out. Dozens of creative variations include the Exiled Cathusian (Green Chatreuse, Tanqueray Gin, Cointreau and powdered sugar)', '0', '0', '', '', '', 0, 0, ' Done less on the lines of the walnut-paneled masterpiece that was the famed Park Room in New York''s Plaza Hotel than a chic and stylish hipster hangout', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', 'Birkegade 10 ', '', '', 0, 69, NULL),
(63, NULL, NULL, 'Cafe Lust', 'Utrecht', '3512EN', ' Lust, one of the deadly sins.  In Dante''s Inferno, the lustful are buffeted  by winds symbolising  their passions. And so to Cafe Lust, which takes the set up of a traditional Dutch brown cafe and gives it a modern spin. It fervidly popular with locals and foreigners alike. Alongside beer, this small, welcoming bar serves a mean cocktail and on weekends the house DJs play a funky selection of tunes with a decidedly Latin edge well into the night.  Top tipples include Strawberry Collins, Frozen Daiquiri and the intriguingly named Out of Africa ( Gin, Safari, jus d''orange, lime, lemon juice and a splash of grenadine for good measure. The wine list or "winkaart" is far better than one might imagine. On it, find such heavyweights as the uber-crisp Tenuta Olim Bauda, Piemonte Chardoand the mighty Accordini, Amarone della Valpolicella Classico Acinatico 2007, an ideal and highly agreeable companion to a spot of supper. And on the subject of nosh, the food here is well worth your time.  It comes for the most part in the form of tasty small plates which nod to the Mediterranean and to the Far East. The result is less a culinary Babel of tongues and more a harmonious synthesis of opposites. In addition to such fripperies as Charcuterie platters, salads and the like, there are more substantial offerings to be had. Cheif among them is the Beef Sashimi, Black Angus Steak and a hefty essay in Surf and Turf. The terrace may make it particularly popular in summer but make no mistake, this is a hot spot all year round.', '52', '5', 'http://cafelust.nl', '', '31302382421', 1, 0, ' Lust, one of the deadly sins.  In Dante''s Inferno, the lustful are buffeted  by winds symbolising  their passions. And so to Cafe Lust, which takes the set up of a traditional Dutch brown cafe and gives it a modern spin.', 0, 0, 0, '', 0, '', '1,94163E+14', 'https://www.facebook.com/pages/Caf%C3%A9-Lust/194162850624008', '', '', '2198115', 'http://instagram.com/Caf%C3%A9+Lust', '', 677, 3704, 5, 111, 0, 0, 'a:24:{i:0;s:6:"County";i:1;s:11:" PostalCode";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:15:" OutdoorSeating";i:11;s:11:" PriceRange";i:12;s:19:" RestaurantServices";i:13;s:11:" FacebookId";i:14;s:17:" FacebookUserPage";i:15;s:12:" InstagramId";i:16;s:18:" InstagramUserPage";i:17;s:13:" FoursquareId";i:18;s:19:" FoursquareUserPage";i:19;s:14:" FacebookLikes";i:20;s:17:" FacebookCheckins";i:21;s:16:" FoursquareLikes";i:22;s:19:" FoursquareCheckIns";i:23;s:15:" FoursquareTips";}', 'a:3:{i:0;s:19:"GeocoordinateString";i:1;s:8:" Website";i:2;s:6:" Phone";}', 'Nobelstraat 10 ', '4afde594f964a520de2b22e3', 'https://foursquare.com/v/caf%C3%A9-lust/4afde594f964a520de2b22e3', 5, 162, NULL),
(64, NULL, NULL, 'Sam''s Tavern', 'WA', '98122', ' The venue might be new but the name is anything but. The original Sam’s was the precursor to Red Robin and the owner of this new venture is part of the family who launched the famous burger chain. The 21st century Sam’s is a classic American tavern with a rugged roadhouse vibe. Occupying the former home of Chino’s on Capitol Hill, the space has been refitted with reclaimed wood tables, a bar inset with an array of shiny copper pennies and a dramatic antler chandelier. This is not a place that cares over-much for trends and fashions', '0', '0', '', '', '', 0, 0, ' The venue might be new but the name is anything but. The original Sam’s was the precursor to Red Robin and the owner of this new venture...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '1024 E Pike St 11th and E Pike St', '', '', 0, 3, NULL),
(65, NULL, NULL, 'MEATMission', 'Greater London', 'N1 6HG', ' Yianni Papoutsis’s grease-spattered empire continues its conquest of London with a new outpost in Shoreditch, his most ambitious yet. Having started out manning a south London burger wagon, serving what many regarded as the best, most deliciously filthy burgers in the city, now encompasses three permanent venues. The faintly illicit MeatLiquor (just off Oxford Street, hidden behind a branch of Debenhams), Covent Garden’s MeatMarket and now east London’s MEATMission, a burger temple in a former mission hall with a striking Gilbert and George-esque stained glass ceiling. This new outpost offers goodies not available at previous incarnations – including the ridiculously addictive Monkey Fingers – as well as all the staples, including their famous bingo wings and those perfect American-style burgers – the Dead Hippie is a favourite with the blogosphere – plus a few artery-hardening glories like their ‘chilli garbage plate.’Cocktails are potent and just as wicked as the food on offer. The Pinot Grinchio packs a considerable kick for a drink that mixes white wine and apple juice and the Peckham Negroni is also a joy. They’ve got an impressive range of beers on tap too and this venue doesn’t seem to get quite as rammed as the Welbeck Street original, so there are less insane queues (though that may well change) and it feels like a place you might linger in for longer, rather than simply eating and running. Which is a good thing because the atmosphere is hip without feeling forced and the food is crazy good.', '52', '0', 'http://www.meatmission.com', 'info@MEATmission.com', '4,42077E+11', 2, 1, ' Yianni Papoutsis’s grease-spattered empire continues its conquest of London with a new outpost in Shoreditch, his most ambitious yet.', 0, 0, 1, '', 0, '', '1,75354E+14', 'https://www.facebook.com/pages/Meat-Mission/175354322611162', 'meatmission', 'https://www.twitter.com/meatmission', '51381366', 'http://instagram.com/Meat+Mission', '', 4169, 16342, 289, 753, 0, 0, 'a:28:{i:0;s:6:"County";i:1;s:16:" MondayOpenHours";i:2;s:17:" TuesdayOpenHours";i:3;s:19:" WednesdayOpenHours";i:4;s:18:" ThursdayOpenHours";i:5;s:16:" FridayOpenHours";i:6;s:18:" SaturdayOpenHours";i:7;s:16:" SundayOpenHours";i:8;s:9:" Category";i:9;s:15:" OutdoorSeating";i:10;s:5:" Wifi";i:11;s:11:" PriceRange";i:12;s:16:" PaymentAccepted";i:13;s:19:" RestaurantServices";i:14;s:8:" Booking";i:15;s:11:" FacebookId";i:16;s:17:" FacebookUserPage";i:17;s:12:" TwitterName";i:18;s:16:" TwitterUserPage";i:19;s:12:" InstagramId";i:20;s:18:" InstagramUserPage";i:21;s:13:" FoursquareId";i:22;s:19:" FoursquareUserPage";i:23;s:14:" FacebookLikes";i:24;s:17:" FacebookCheckins";i:25;s:16:" FoursquareLikes";i:26;s:19:" FoursquareCheckIns";i:27;s:15:" FoursquareTips";}', 'a:6:{i:0;s:7:"Country";i:1;s:5:" City";i:2;s:8:" Street1";i:3;s:20:" GeocoordinateString";i:4;s:8:" Website";i:5;s:6:" Phone";}', '14-15 Hoxton Market ', '50c35e21e4b08c3b59223478', 'https://foursquare.com/v/meat-mission/50c35e21e4b08c3b59223478', 103, 4, NULL),
(66, 13, 24, '6vorne', 'Berlin', '10711', '''6vorne'' is all about numbers. Its cryptic name translates as ''six forward'' which, contrary to some suggestions, is not a reference to the contorted pleasures of Twister. Its other numerical boast is that it stocks 100 different vodkas, enough to sate the palette of the most discerning vodka connoisseur. There’s an imaginative and interesting list of cocktails on offer (and don’t worry, they don’t all have vodka in them) and they’re reasonably priced and competently made. On the aesthetic front, think clean lines, dark walnut features, lashings of Germanic minimalism (if that''s not a contradiction in terms) all bathed in the most wonderful of orange and green lights. Sloping white seats and futuristic wall spaces give it a slightly Kubrickian air, that sense of retro meets futurism (think 2001: A Space Odyssey meets the Clockwork Orange Milk Bar). In fact, you may find yourself slightly mesmerised by the backlit bottle shelves that line some of the walls.  (The interior is courtesy of local designers Murat Top and Alen Aronov).  It’s little surprise then that the place has become a hit with the young Berlin creative and fashion types, who throng here to enjoy classy cocktails in chic surroundings to a soundtrack of subdued electronica and house, though it also does show sporting events sometimes so do check your calendar. It also isn’t an enormous space so can get very busy at peak times and at weekends.  But in a city that’s famous for its cocktail scene, 6vorne still manages to stand out, so it’s well worth a visit.', '53', '13', '', 'alen@6vorne.de', '491 636 061 666', 2, 0, '''6vorne'' is all about numbers. Its cryptic name translates as ''six forward'' which, contrary to some suggestions, is not a reference to the contorted pleasures of Twister.', 1, 0, 0, '', 0, '', '', '', '', '', '', '', '', 24, 0, 0, 0, 0, 0, 'a:9:{i:0;s:6:"County";i:1;s:9:" Category";i:2;s:15:" OutdoorSeating";i:3;s:11:" PriceRange";i:4;s:13:" FoursquareId";i:5;s:19:" FoursquareUserPage";i:6;s:16:" FoursquareLikes";i:7;s:19:" FoursquareCheckIns";i:8;s:15:" FoursquareTips";}', 'a:2:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";}', 'Hektorstrasse 11 ', '4adcda79f964a520ba4621e3', 'https://foursquare.com/v/6vorne/4adcda79f964a520ba4621e3', 0, 7, NULL),
(67, NULL, NULL, 'Subculture', '', '9300', '‘Sub’ is indeed a suitable prefix for the subterranean spot Subculture. This bar boasts both an underground location and an appropriately underground atmosphere.  Inside, low lighting and lots of red add up to warm glow that sets the mood – there are lots of comfortable couches to recline on should you be in a reclining mood, though the entertainment might keep you upright. Because music is a very big deal here and they often have live music from local bands plus the cream of Queenstown''s DJ talent – the sound system is the best in town. The music changes from night to night, but hip-hop, dancehall, funk and r’n’b feature prominently, so there’s always something decent on offer, and the venue also has a good track record in attracting international talent. The atmosphere is lively and colourful, and the place hums with people having a good time and eager to party. They also hold regular art exhibitions for the culturally inclined. The bar offers a range of fruity, well-made cocktails and a decent wine list – it’s that rare venue that prides itself on its drinks as much as the entertainment (alas the two often don’t go hand in hand), styling itself solidly as a cocktail bar as well as a nightclub, so you can order in confidence that the staff tend to know what they’re doing! There are also drinks offers most nights from 9pm should you be partying on a budget (the place is open 4 nights a week). The food is tasty and has a distinctly Japanese flavour, with noodles and other Asian fare available if you get the munchies.', '-45', '169', 'http://www.subculture.net.nz', '', '6434437685', 0, 0, '‘Sub’ is indeed a suitable prefix for the subterranean spot Subculture. This bar boasts both an underground location and an appropriately underground atmosphere.', 0, 0, 0, '', 0, '', '2,09854E+14', 'https://www.facebook.com/pages/Subculture/209854095700920', '', '', '4190094', 'http://instagram.com/Subculture', '', 0, 203, 0, 32, 0, 0, 'a:8:{i:0;s:10:"PostalCode";i:1;s:9:" Category";i:2;s:11:" FacebookId";i:3;s:17:" FacebookUserPage";i:4;s:12:" InstagramId";i:5;s:18:" InstagramUserPage";i:6;s:14:" FacebookLikes";i:7;s:17:" FacebookCheckins";}', 'a:4:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:8:" Website";i:3;s:6:" Phone";}', '13 church st ', '', '', 0, 164, NULL),
(68, NULL, NULL, 'Turm Bar', 'Hamburg', '20148', '"Cocktails and more" bar located in a little round tower opposite Dammtor  station on the Moorweide - an ideal stop for visitors to the cinemas or  shops. The interior has taken on the shape of the tower with round tables,  semicircular chairs and a round bar with the same shapely curves of that  blond with the Jameson Highball. It''s a comfortable loungey atmosphere  that''s even livelier in summer when you can sit outside. Dozens of colourful  cocktails and long drinks available at fair prices. Don''t Turm back.', '54', '10', 'http://www.turmbar.de', '', '4940444567', 3, 0, '"Cocktails and more" bar located in a little round tower opposite Dammtor  station on the Moorweide - an ideal stop for visitors to the cinemas or  shops. ...', 1, 1, 0, '', 0, '', '', '', '', '', '16306443', 'http://instagram.com/Turmbar', '', 462, 0, 7, 0, 0, 0, 'a:12:{i:0;s:6:"County";i:1;s:9:" Category";i:2;s:15:" OutdoorSeating";i:3;s:10:" HappyHour";i:4;s:11:" PriceRange";i:5;s:12:" InstagramId";i:6;s:18:" InstagramUserPage";i:7;s:13:" FoursquareId";i:8;s:19:" FoursquareUserPage";i:9;s:16:" FoursquareLikes";i:10;s:19:" FoursquareCheckIns";i:11;s:15:" FoursquareTips";}', 'a:2:{i:0;s:19:"GeocoordinateString";i:1;s:6:" Phone";}', 'Rothenbaumchaussee 2 ', '4b44eefff964a520310026e3', 'https://foursquare.com/v/turmbar/4b44eefff964a520310026e3', 10, 7, NULL),
(69, NULL, NULL, 'Papaya', '', '00-372', '"This frutily named gorgeous white confection must surely count as one of the best bars and restaurants in the city." Discuss. ( Protractors may not be used) Few would take issue with the thesis that it’s one of its best designed spaces: its dazzlingly bright, white bar has a long counter on one side of the room above which runs a floral frieze providing artful splashes of colour. A more formal dining-room boasts is hung with striking paintings and features an arresting sculpture of silver coral, all of which is bathed in suitably romantic light.  The powers that be of Papaya say of it : "If we go down the stairs we will reach the second room, whose interiors give the impression of a daydream on the bottom of the sea." Mere fluff? Not a bit of it. An open kitchen ( a not unwelcome addition to the terminally suspicious) allows one to see  the chefs at work, a spectacle that at times borders on theatre, particularly when they’re unleashed on the modish teppanyaki grill. As for the bill of fare, it, too, has its moments of theatre.  Leading the charge are classic dishes from the Far East. Examples include the utterly scrumptious banana leaf and class pad Thai, traditional papaya salad and that perennial favourite, green curry. What these chaps can''t do with that quartet of Thai ingredients ( lemongrass, chillis, ginger, galangal,) frankly isn''t worth knowing.  The seafood is as fresh as it comes, too ( why, the oysters and lobsters are plucked from the aquarium) and they have a hefty wine list too. All of which, alas, comes with an equally hefty price tag. So fill your pockets with as many zloty as you can.', '52', '21', 'http://www.papaya.waw.pl/', 'papaya@papaya.waw.pl', '48228261199', 0, 1, '"This frutily named gorgeous white confection must surely count as one of the best bars and restaurants in the city." Discuss. ( Protractors may not be used)...', 0, 0, 0, '', 0, 'street', '1,97923E+14', 'https://www.facebook.com/pages/Papaya/197923450241208', '', '', '39792', 'http://instagram.com/Papaya', '', 0, 1468, 0, 149, 0, 0, 'a:17:{i:0;s:15:"MondayOpenHours";i:1;s:17:" TuesdayOpenHours";i:2;s:19:" WednesdayOpenHours";i:3;s:18:" ThursdayOpenHours";i:4;s:16:" FridayOpenHours";i:5;s:18:" SaturdayOpenHours";i:6;s:16:" SundayOpenHours";i:7;s:9:" Category";i:8;s:16:" PaymentAccepted";i:9;s:19:" RestaurantServices";i:10;s:12:" ParkingType";i:11;s:11:" FacebookId";i:12;s:17:" FacebookUserPage";i:13;s:12:" InstagramId";i:14;s:18:" InstagramUserPage";i:15;s:14:" FacebookLikes";i:16;s:17:" FacebookCheckins";}', 'a:5:{i:0;s:7:"Country";i:1;s:5:" City";i:2;s:8:" Street1";i:3;s:20:" GeocoordinateString";i:4;s:6:" Phone";}', 'ul. Foksal 16 ', '', '', 0, 182, NULL),
(70, NULL, NULL, 'Honey', 'Auckland', '1010', '“Come on, honey, let''s go down to a place you''ll like on O''Connell Street”.  Over at Honey – or, to give the place its full name, The Honey Champagne Cocktail Bar, they have 30 types of champagne including all your favourites, as well as a delectable champagne cocktail with crushed mint that will have you begging for more. Housed in the old headquarters of an insurance company, the venue has been sympathetically done out, combining classical charm with modern drinking den.  The stylish setting boasting marble and oak bars, plenty of comfortable couches to recline on, a real fire for when the nights get cold and lots of old fashioned lamps casting a flattering lighting over the patrons, making it a good spot for a romantic evening. The heritage ceilings and vintage posters speak of the building’s original purpose, but now it’s a temple to the choicest champagne and the well-made cocktail, with over 60 varieties on offer, as well as a very good selection of beers and a seriously tempting range of New Zealand wines. (If you have a sweet tooth, we’d recommend the vodka-based Apple Crumble cocktail – it’s dessert in a glass!) There''s a roof deck to chill out on when the weather gets warmer, so relax and check out the hipsters who''ve made this place their home from home. DJs spin until late and the crowd tends towards fashion, media and film types, though early evening it’s a prime location to grab a quick drink after-work and it tends to be quieter than some of the other venues in the area. ', '-37', '175', '', '', '6493695639', 0, 0, '“Come on, honey, let''s go down to a place you''ll like on O''Connell Street”.  Over at Honey – or, to give the place its full name, The Honey Champagne Cocktail Bar...', 0, 0, 0, '', 0, '', '', '', '', '', '5642883', 'http://instagram.com/Honey+Bar', '', 182, 0, 0, 0, 0, 0, 'a:11:{i:0;s:6:"County";i:1;s:11:" PostalCode";i:2;s:8:" Street2";i:3;s:9:" Category";i:4;s:12:" InstagramId";i:5;s:18:" InstagramUserPage";i:6;s:13:" FoursquareId";i:7;s:19:" FoursquareUserPage";i:8;s:16:" FoursquareLikes";i:9;s:19:" FoursquareCheckIns";i:10;s:15:" FoursquareTips";}', 'a:3:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:6:" Phone";}', '5 O''Connell St at Shortland St', '4b2da344f964a520e2d924e3', 'https://foursquare.com/v/honey-bar/4b2da344f964a520e2d924e3', 2, 164, NULL),
(71, NULL, NULL, 'Alice', '', '6011', '“Curiouser and curiouser!” Follow the flashing neon white rabbit into wonderland. Tucked down an unassuming, rain-damp alley, you’ll find Alice, one of Wellington’s most idiosyncratic bars. Inside you’ll find porthole mirrors, dangling lanterns and posters of the Red Queen on the walls. The drinks list is an attractive thing, resembling a hard-backed book and certain cocktails are even served in tea pots fit for a March Hare. So what are you waiting for? Pack your pocket watch and go find that yellow door. The looking glass world awaits.', '-41', '175', 'http://www.whiterabbit.co.nz/', '', '6443852242', 0, 0, '“Curiouser and curiouser!” Follow the flashing neon white rabbit into wonderland. Tucked down an unassuming, rain-damp alley, you’ll find Alice, one of ...', 0, 0, 0, '', 0, '', '1,32526E+14', 'https://www.facebook.com/pages/Alice/132526350152100', '', '', '2714415', 'http://instagram.com/Alice', '', 0, 1001, 0, 54, 0, 0, 'a:9:{i:0;s:10:"PostalCode";i:1;s:6:" Phone";i:2;s:9:" Category";i:3;s:11:" FacebookId";i:4;s:17:" FacebookUserPage";i:5;s:12:" InstagramId";i:6;s:18:" InstagramUserPage";i:7;s:14:" FacebookLikes";i:8;s:17:" FacebookCheckins";}', 'a:2:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";}', 'Forresters Lane, Te Aro ', '', '', 0, 164, NULL),
(72, 17, 26, 'Coppervine', 'IL', '60614', '“In constant pursuit of the perfect pairing.” That’s how this new Lincoln Park spot styles itself and it’s a mission we’re happy to accept. This casual neighbourhood drinking and dining spot offers a list of creative drinks which are all designed to pair with dishes from their small plate menu. So the 9-5, an aromatic blend of gin, Combier  FDR, Spiced Perique, and Apricot Bitters goes well with olives and almonds, while their decadent Maine lobster BLT has been paired with a Modern Man’s Manhattan, a drink which mixes rye, vermouth and aromatic bitters. The lobster mac ‘n’ cheese, meanwhile, has been paired with an Old Fashioned made with brown butter-infused bourbon, a stiff drink designed to cut throw the richness, while the Apple Orchard, a blend of Apple Brandy, Orgeat, and Black Walnut Bitters works well with their cheese plate. A similar approach has been taken with their beer menu, the various ales and lagers chosen to go well with the food menu, ditto the wine list. It’s all too easy to opt for a bottle of a familiar white, but here the whole menu is set up to allow you to explore flavour pairings, while trying new wines, many of which are available by the glass. It’s a cool concept, well executed, and we applaud them for it.Photography by - Anthony Tahlier', '42', '-88', 'http://coppervinechicago.com', '', '17739351000', 2, 1, '“In constant pursuit of the perfect pairing.” That’s how this new Lincoln Park spot styles itself and it’s a mission we’re happy to accept. This casual neighbourhood drinking and dining spot offers a list of creative drinks which are all designed to pair with dishes from their small plate menu. ', 0, 0, 0, 'foursquare.com/v/coppervine/529e820a11d2a50bde5c3f87/menu', 0, 'street,valet', '5,27013E+14', 'https://www.facebook.com/coppervinechicago', '', '', '174615071', 'http://instagram.com/Coppervine', '', 237, 914, 8, 428, 0, 0, 'a:31:{i:0;s:6:"County";i:1;s:11:" PostalCode";i:2;s:8:" Website";i:3;s:6:" Phone";i:4;s:16:" MondayOpenHours";i:5;s:17:" TuesdayOpenHours";i:6;s:19:" WednesdayOpenHours";i:7;s:18:" ThursdayOpenHours";i:8;s:16:" FridayOpenHours";i:9;s:18:" SaturdayOpenHours";i:10;s:16:" SundayOpenHours";i:11;s:9:" Category";i:12;s:5:" Mood";i:13;s:15:" OutdoorSeating";i:14;s:11:" PriceRange";i:15;s:16:" PaymentAccepted";i:16;s:19:" RestaurantServices";i:17;s:8:" MenuUrl";i:18;s:8:" Booking";i:19;s:12:" ParkingType";i:20;s:11:" FacebookId";i:21;s:17:" FacebookUserPage";i:22;s:12:" InstagramId";i:23;s:18:" InstagramUserPage";i:24;s:13:" FoursquareId";i:25;s:19:" FoursquareUserPage";i:26;s:14:" FacebookLikes";i:27;s:17:" FacebookCheckins";i:28;s:16:" FoursquareLikes";i:29;s:19:" FoursquareCheckIns";i:30;s:15:" FoursquareTips";}', 'a:2:{i:0;s:7:"Country";i:1;s:20:" GeocoordinateString";}', '1962 N Halsted St ', '529e820a11d2a50bde5c3f87', 'https://foursquare.com/v/coppervine/529e820a11d2a50bde5c3f87', 7, 3, NULL),
(73, NULL, NULL, '1806', 'VIC', '3000', '1806 is, apparently, the year that the term cocktail was first defined in print and so it comes as little surprise that the cocktail, its history and its glorious present are a source of celebration and reverence at this elegant Exhibition Street bar. The room itself is a bit poky, but some smart use of wood panelling and red velvet makes gives the space a kind of clubby charm. The walls are lined with cabinets housing an array of vintage cocktail related paraphernalia - but all of this is mere backdrop for the main event, the drinks themselves. The list is exciting and varied, with drinks dating back to the birth of the cocktail. They use premium ingredients and have an inventive list of contemporary cocktails, which are delivered with equal care and attention to detail. They serve other drinks and have a decent wine list, but to be honest, you’d be remiss not to at least sample one of their cocktails when they’re as good as this.', '-38', '145', 'http://1806.com.au', '', '61396637722', 2, 1, '1806 is, apparently, the year that the term cocktail was first defined in print and so it comes as little surprise that the cocktail, its history and ...', 0, 0, 0, 'foursquare.com/v/1806/4b0681dff964a5207dec22e3/menu', 0, 'street,lot', '1,9742E+14', 'https://www.facebook.com/eighteenOsix', 'drinks1806', 'https://www.twitter.com/drinks1806', '275572', 'http://instagram.com/1806', '', 2362, 21978, 46, 3607, 0, 0, 'a:31:{i:0;s:6:"County";i:1;s:11:" PostalCode";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:5:" Mood";i:11;s:15:" OutdoorSeating";i:12;s:5:" Wifi";i:13;s:11:" PriceRange";i:14;s:16:" PaymentAccepted";i:15;s:19:" RestaurantServices";i:16;s:8:" MenuUrl";i:17;s:12:" ParkingType";i:18;s:11:" FacebookId";i:19;s:17:" FacebookUserPage";i:20;s:12:" TwitterName";i:21;s:16:" TwitterUserPage";i:22;s:12:" InstagramId";i:23;s:18:" InstagramUserPage";i:24;s:13:" FoursquareId";i:25;s:19:" FoursquareUserPage";i:26;s:14:" FacebookLikes";i:27;s:17:" FacebookCheckins";i:28;s:16:" FoursquareLikes";i:29;s:19:" FoursquareCheckIns";i:30;s:15:" FoursquareTips";}', 'a:4:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:8:" Website";i:3;s:6:" Phone";}', '169 Exhibition St. ', '4b0681dff964a5207dec22e3', 'https://foursquare.com/v/1806/4b0681dff964a5207dec22e3', 55, 23, NULL),
(74, 8, 27, '19.20', '', 'EC1V 0DR', '19.20, a stylish offering from the people behind Beach Blanket Babylon, boats a colourful and striking interior featuring padded red walls, graffiti murals and stained glass windows.  The main lure though is the four American-style, yellow-topped pool tables, which are usually surrounded by lively groups of people toting pool cues and bottles of beer. The Clerkenwell bar serves up top notch cocktails (we really like the sound of their Peppered Passion, a concoction of rum, passion fruit puree, lime and black pepper) and superior snacks – their burgers have a particularly good rep.  It’s got a nice relaxed atmosphere and attracts a mixed, after-work crowd. DJs play on weekend nights and there’s ample room for dancing.', '52', '0', 'www.19-20.co.uk', '', '4,42073E+11', 0, 1, '19.20, a stylish offering from the people behind Beach Blanket Babylon, boats a colourful and striking interior featuring padded red walls, graffiti murals ...', 0, 0, 0, '', 0, 'street', '2,76295E+11', 'https://www.facebook.com/1920bar', '', '', '924847', 'http://instagram.com/1920+bar', '', 0, 3510, 0, 264, 0, 0, 'a:19:{i:0;s:10:"PostalCode";i:1;s:16:" MondayOpenHours";i:2;s:17:" TuesdayOpenHours";i:3;s:19:" WednesdayOpenHours";i:4;s:18:" ThursdayOpenHours";i:5;s:16:" FridayOpenHours";i:6;s:18:" SaturdayOpenHours";i:7;s:16:" SundayOpenHours";i:8;s:9:" Category";i:9;s:16:" PaymentAccepted";i:10;s:19:" RestaurantServices";i:11;s:12:" ParkingType";i:12;s:16:" PublicTransport";i:13;s:11:" FacebookId";i:14;s:17:" FacebookUserPage";i:15;s:12:" InstagramId";i:16;s:18:" InstagramUserPage";i:17;s:14:" FacebookLikes";i:18;s:17:" FacebookCheckins";}', 'a:4:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:8:" Website";i:3;s:6:" Phone";}', '19-20 Great Sutton Street EC1V 0DR', '', '', 0, 4, NULL),
(75, NULL, NULL, '360Istanbul', 'Istanbul', '34330', '360Istanbul''s charms are not inconsiderable. Chief among them are its location in a delightful 19th Century building, its food which fuses Turkish cuisine with that of the world. It has an excellent wine-menu, good music, able DJ''s, sophisticated clientele and above all the breathtaking views of the city. Across the Bosphorus stands The Blue Mosque herself (which is one of the most famous in the world) and beyond glimmers the Sea of Marmara. On the drinks front, you are in safe hands in the barman, who, with over twenty years'' experience under his belt, intimately knows the finer points of mixing a cocktail. Whether it''s a mojito or a margarita, you won''t be disappointed.', '41', '29', 'http://360istanbul.com', '', '9,02123E+11', 0, 1, '360Istanbul''s charms are not inconsiderable. Chief among them are its location in a delightful 19th Century building, its food which fuses Turkish cuisine ...', 1, 0, 1, '', 0, 'street,valet', '1,92803E+14', 'https://www.facebook.com/360istanbul', '', '', '213810044', 'http://instagram.com/360+Istanbul', '', 34847, 16734, 1291, 20846, 0, 0, 'a:26:{i:0;s:6:"County";i:1;s:11:" PostalCode";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:15:" OutdoorSeating";i:11;s:5:" Wifi";i:12;s:16:" PaymentAccepted";i:13;s:19:" RestaurantServices";i:14;s:12:" ParkingType";i:15;s:11:" FacebookId";i:16;s:17:" FacebookUserPage";i:17;s:12:" InstagramId";i:18;s:18:" InstagramUserPage";i:19;s:13:" FoursquareId";i:20;s:19:" FoursquareUserPage";i:21;s:14:" FacebookLikes";i:22;s:17:" FacebookCheckins";i:23;s:16:" FoursquareLikes";i:24;s:19:" FoursquareCheckIns";i:25;s:15:" FoursquareTips";}', 'a:4:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:8:" Website";i:3;s:6:" Phone";}', 'İstiklal Cad. Mısır Apt. No:163 Kat:8 Beyoğlu', '4bcc565afb84c9b61328203e', 'https://foursquare.com/v/360-istanbul/4bcc565afb84c9b61328203e', 564, 231, NULL),
(76, NULL, NULL, 'Kickin'' Boot Whiskey Kitchen', 'WA', '98107', 'A barbecue and cocktail spot in Ballard—another one –the Kickin’ Boot Whiskey Kitchen is the work of the Matador crew, the folks behind the Southland Whiskey Kitchen in Portland. The interior is rustic in an upscale way, lots of brick and wood, but also airy, with large windows and a terrace area for al fresco dining', '0', '0', '', '', '', 0, 0, 'A barbecue and cocktail spot in Ballard—another one –the Kickin’ Boot Whiskey Kitchen is the work of the Matador crew, the folks behind the Southland Whiskey Kitchen in Portland. ', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '5309 22nd Ave. NW at Shilshole Ave NW', '', '', 0, 3, NULL),
(77, NULL, NULL, 'Knee High Stocking Company', 'WA', '98122', 'A barely marked door, a doorbell, text requests for reservations, no cameras, House Rules...a speakeasy. For some of you, I know that can mean pretentious mixologists, overpriced drinks and a “wanna be” clientele. But at Knee High your texted reservations and doorbell search will be rewarded as you enter the jewel box-sized space. Friendly and knowledgeable bartenders mix classic cocktails, house specialties, and creative seasonal sippers such as the Laura Palmer (Bombay Dry gin infused with Earl Grey tea, lemon, and Coca-Cola). Order a chicken pot pie or some lamb mini burgers and you’ve got the makings for a very delicious evening. As far as the House Rules go, I think we can all agree that “we don’t have Jägermeister, nor any drink that ends in ''-bomb'', and nothing with Red Bull” is not such a bad rule to follow.', '48', '-122', 'http://www.kneehighstocking.com', 'owners@kneehighstocking.com', '12069797049', 2, 1, 'A barely marked door, a doorbell, text requests for reservations, no cameras, House Rules...a speakeasy. For some of you, I know that can mean pretentious mixologists, overpriced drinks and a “wanna be” clientele.', 0, 0, 0, 'foursquare.com/v/knee-high-stocking-co/49b7551df964a52028531fe3/menu', 0, '', '', '', 'kneehighstockco', 'https://www.twitter.com/kneehighstockco', '646770', 'http://instagram.com/Knee+High+Stocking+Co.', '', 4593, 0, 55, 0, 0, 0, 'a:25:{i:0;s:6:"County";i:1;s:8:" Street2";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:15:" OutdoorSeating";i:11;s:5:" Wifi";i:12;s:11:" PriceRange";i:13;s:16:" PaymentAccepted";i:14;s:19:" RestaurantServices";i:15;s:8:" MenuUrl";i:16;s:12:" TwitterName";i:17;s:16:" TwitterUserPage";i:18;s:12:" InstagramId";i:19;s:18:" InstagramUserPage";i:20;s:13:" FoursquareId";i:21;s:19:" FoursquareUserPage";i:22;s:16:" FoursquareLikes";i:23;s:19:" FoursquareCheckIns";i:24;s:15:" FoursquareTips";}', 'a:6:{i:0;s:7:"Country";i:1;s:11:" PostalCode";i:2;s:8:" Street1";i:3;s:20:" GeocoordinateString";i:4;s:8:" Website";i:5;s:6:" Phone";}', '1356 E Olive Way at Bellevue Ave', '49b7551df964a52028531fe3', 'https://foursquare.com/v/knee-high-stocking-co/49b7551df964a52028531fe3', 46, 3, NULL),
(78, 4, 28, 'The Rum House', 'NY', '10036', 'A beacon amid the bustle of Times Square, the Rum House at the Edison Hotel is now under new ownership. The bar, a fixture of the theatre district, is not the same place as it was. Now by the same team as Tribeca’s Ward III, this is cut above the usual hotel bar, appealing to a wider crowd than you might expect. It’s unpretentious and friendly but not without style. As the name suggests the cocktail list is pretty rum-centric and they know how to whip up a textbook mojito. The room is attractively decked out with vintage pieces and the piano has remained since the refit, meaning they still play host to a splash of jazz piano of an evening.', '41', '-74', 'www.edisonrumhouse.com', '', '16464906924', 2, 1, 'A beacon amid the bustle of Times Square, the Rum House at the Edison Hotel is now under new ownership. The bar, a fixture of the theatre district, is ...', 0, 0, 0, 'foursquare.com/v/the-rum-house/41575800f964a520311d1fe3/menu', 0, '', '1,55244E+14', 'https://www.facebook.com/TheRumHouse', 'rumhouseny', 'https://www.twitter.com/rumhouseny', '234418938', 'http://instagram.com/The+Rum+House', '', 6109, 1839, 93, 1545, 0, 0, 'a:30:{i:0;s:6:"County";i:1;s:11:" PostalCode";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:15:" OutdoorSeating";i:11;s:5:" Wifi";i:12;s:11:" PriceRange";i:13;s:16:" PaymentAccepted";i:14;s:19:" RestaurantServices";i:15;s:8:" MenuUrl";i:16;s:16:" PublicTransport";i:17;s:11:" FacebookId";i:18;s:17:" FacebookUserPage";i:19;s:12:" TwitterName";i:20;s:16:" TwitterUserPage";i:21;s:12:" InstagramId";i:22;s:18:" InstagramUserPage";i:23;s:13:" FoursquareId";i:24;s:19:" FoursquareUserPage";i:25;s:14:" FacebookLikes";i:26;s:17:" FacebookCheckins";i:27;s:16:" FoursquareLikes";i:28;s:19:" FoursquareCheckIns";i:29;s:15:" FoursquareTips";}', 'a:4:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:8:" Website";i:3;s:6:" Phone";}', '228 W 47th St ', '41575800f964a520311d1fe3', 'https://foursquare.com/v/the-rum-house/41575800f964a520311d1fe3', 63, 3, NULL),
(79, NULL, NULL, 'Hoxton Pony', 'Greater London', 'EC2A 3AH', 'A beacon on the still-grim stretch of London that is Curtain Road, the Hoxton Pony is everything you’d expect it to be, urban, stylishly designed and a bit self-consciously quirky. The upstairs bar has art made from crushed cars and an open kitchen serving decent grub. Downstairs there’s a tiny dance floor and pounding music. Cocktails are inventive: their infusion jars are particularly cool. You choose a base spirit and then add juices and herbs to create some pretty far out concoctions. The results are served in tea cups. The whole milieu is incredibly Hoxton, but that’s all part of its charm.', '52', '0', 'http://www.thehoxtonpony.com', '', '4,42076E+11', 2, 1, 'A beacon on the still-grim stretch of London that is Curtain Road, the Hoxton Pony is everything you’d expect it to be, urban, stylishly designed and ...', 0, 1, 0, 'foursquare.com/v/the-hoxton-pony/4ac518c6f964a5201aa520e3/menu', 0, '', '1,52832E+14', 'https://www.facebook.com/thehoxtonponylondon', 'thehoxtonpony', 'https://www.twitter.com/thehoxtonpony', '5032', 'http://instagram.com/The+Hoxton+Pony', '', 1223, 28159, 27, 6373, 0, 0, 'a:31:{i:0;s:6:"County";i:1;s:8:" Website";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:5:" Mood";i:11;s:15:" OutdoorSeating";i:12;s:10:" HappyHour";i:13;s:11:" PriceRange";i:14;s:16:" PaymentAccepted";i:15;s:19:" RestaurantServices";i:16;s:8:" MenuUrl";i:17;s:16:" PublicTransport";i:18;s:11:" FacebookId";i:19;s:17:" FacebookUserPage";i:20;s:12:" TwitterName";i:21;s:16:" TwitterUserPage";i:22;s:12:" InstagramId";i:23;s:18:" InstagramUserPage";i:24;s:13:" FoursquareId";i:25;s:19:" FoursquareUserPage";i:26;s:14:" FacebookLikes";i:27;s:17:" FacebookCheckins";i:28;s:16:" FoursquareLikes";i:29;s:19:" FoursquareCheckIns";i:30;s:15:" FoursquareTips";}', 'a:4:{i:0;s:4:"City";i:1;s:8:" Street1";i:2;s:20:" GeocoordinateString";i:3;s:6:" Phone";}', '104-108 Curtain Rd. ', '4ac518c6f964a5201aa520e3', 'https://foursquare.com/v/the-hoxton-pony/4ac518c6f964a5201aa520e3', 19, 4, NULL),
(80, 12, 25, 'The Gallery', '', '186', '', '0', '0', '', '', '', 0, 0, 'A beautiful club-bar in the Centro Storico furnished in vibrant tones', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '12  Via della Maddalena  Centro Storico ', '', '', 0, 9, NULL);
INSERT INTO `wbb_semsoft_imported_bar` (`id`, `city_id`, `suburb_id`, `name`, `county`, `postal_code`, `description`, `latitude`, `longitude`, `website`, `email`, `phone`, `price`, `is_credit_card`, `seo_description`, `is_out_door_seating`, `is_happy_hour`, `is_wifi`, `menu`, `reservation`, `parking_type`, `facebook_id`, `facebook_user_page`, `twitter_name`, `twitter_user_page`, `instagram_id`, `instagram_user_page`, `google_plus_user_page`, `foursquare_check_ins`, `facebook_check_ins`, `foursquare_likes`, `facebook_likes`, `is_permanently_closed`, `business_found`, `updated_columns`, `overwritten_columns`, `address`, `foursquare_id`, `foursquare_user_page`, `foursquare_tips`, `country_id`, `bar_id`) VALUES
(81, NULL, NULL, 'Noti', '', '8009', 'A beautiful spot full of beautiful people, Noti simply oozes sophistication. Housed in the former home of Barcelona’s newspaper, El Noticiero Universal,  (so one assumes that’s where they got the name) the space has been inventively rejigged by designer Francesc Pons to make for a pleasant, quality drinking experience. Walking in, you’re faced with a stylish bar area where you can idle over the cocktail of the day or explore the substantial Spanish wine list. Then, in the glamorous dining room - all red and black with lots of mirrors - you can sample an array of tasty modern dishes from a menu courtesy of Christian Crespin and Elena Barta. The fish is market fresh so worth trying, or plump for one of the quality meat dishes (for the discerning carnivore, steak tartare comes recommended). They do a lunch offer, too, if you’re on a budget but still want to sample the superior cuisine. The cocktails are well made by bar tenders who know their trade and care about their offering, so you’re guaranteed a decent drink. Should you want to enjoy your meal or drinks away from peering eyes, you can reserve a private space for your party. Smooth jazz filters through the air and there are occasional live DJ sessions to pep things up. The atmosphere is infectious, with the place attracting a sophisticated, urban crowd rather than simply a lot of tourist gawkers, drawn by the laid back, cool atmosphere and super-chic setting. Handily located to explore the rest of the city, Noti is one of Barcelona’s gems.', '41', '2', 'http://noti-universal.com/', '', '34933426673', 0, 0, 'A beautiful spot full of beautiful people, Noti simply oozes sophistication. Housed in the former home of Barcelona’s newspaper, El Noticiero Universal,  (so one assumes that’s where they got the name)', 0, 0, 0, '', 0, '', '2,01238E+14', 'https://www.facebook.com/pages/NOTI/201237599915519', '', '', '', '', '', 0, 0, 0, 18, 0, 0, 'a:5:{i:0;s:8:"Category";i:1;s:11:" FacebookId";i:2;s:17:" FacebookUserPage";i:3;s:14:" FacebookLikes";i:4;s:17:" FacebookCheckins";}', 'a:3:{i:0;s:10:"PostalCode";i:1;s:8:" Street1";i:2;s:20:" GeocoordinateString";}', 'Roger de Llúria, 35 ', '', '', 0, 8, NULL),
(82, NULL, NULL, 'Cyclops', 'WA', '98121', 'A Belltown classic serving up tasty cocktails and spicy-flavoured food fare. Décor is cool ''50''s diner with red vinyl booths and stools, although it''s the retro chic you''re reveling in - just as you do at the minimalist boutique  Ace Hotel just upstairs. Dishes include empanadas and pepper-flavoured mashed potatoes but the cocktails are simply superb: generous pours, great top-shelf selections and fresh juices as mixers. Cyclops regulars are cool and laid-back in a designer-grunge Seattle kind of way and most of them have two eyes.', '48', '-122', 'http://cyclopsseattle.com', 'hostess@cyclopsseattle.com', '12064411677', 2, 1, 'A Belltown classic serving up tasty cocktails and spicy-flavoured food fare. Décor is cool ''50''s diner with red vinyl booths and stools, although it''s ...', 1, 1, 0, 'foursquare.com/v/cyclops-seattle-wa/41044980f964a520730b1fe3/menu', 0, 'street', '1,36949E+14', 'https://www.facebook.com/pages/Cyclops/136948679670357', '', '', '284652', 'http://instagram.com/Cyclops', '', 6342, 6781, 41, 846, 0, 0, 'a:30:{i:0;s:6:"County";i:1;s:8:" Street2";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:5:" Mood";i:11;s:15:" OutdoorSeating";i:12;s:10:" HappyHour";i:13;s:11:" PriceRange";i:14;s:16:" PaymentAccepted";i:15;s:19:" RestaurantServices";i:16;s:8:" MenuUrl";i:17;s:12:" ParkingType";i:18;s:16:" PublicTransport";i:19;s:11:" FacebookId";i:20;s:17:" FacebookUserPage";i:21;s:12:" InstagramId";i:22;s:18:" InstagramUserPage";i:23;s:13:" FoursquareId";i:24;s:19:" FoursquareUserPage";i:25;s:14:" FacebookLikes";i:26;s:17:" FacebookCheckins";i:27;s:16:" FoursquareLikes";i:28;s:19:" FoursquareCheckIns";i:29;s:15:" FoursquareTips";}', 'a:5:{i:0;s:10:"PostalCode";i:1;s:8:" Street1";i:2;s:20:" GeocoordinateString";i:3;s:8:" Website";i:4;s:6:" Phone";}', '2421 1st Ave at Wall St', '41044980f964a520730b1fe3', 'https://foursquare.com/v/cyclops-seattle-wa/41044980f964a520730b1fe3', 46, 3, NULL),
(83, NULL, NULL, 'Club Safari', '', 'FL 33410', 'A bizarre style-club meets Safari Park and just helps to confirm anything is  possible in Florida. Located in the Palm Beach Gardens Marriott, the dance  floor is packed with sweaty, tanned and gorgeous disco hedonists grooving to  a mix of Top 40 chart beats as well as more eclectic New York-meets-LA club  tunes. But we particularly like the funky safari twist: lifelike animals  like lions and tigers are positioned throughout and you could end up dancing  with a giraffe. Do not confuse it with the six-foot tall supermodel in the  brown-spotted skirt you''ve had your eyes on.', '27', '-80', 'http://www.clubsafaripbg.com/?gclid=CLTJiqX2rZUCFQ5MQgod5CN2kQ', 'info@clubsafaripbg.com', '561.622.8888 Ext. 7110', 0, 0, 'A bizarre style-club meets Safari Park and just helps to confirm anything is  possible in Florida. Located in the Palm Beach Gardens Marriott, the dance ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '4000  RCA Blvd.  Palm Beach Gardens ', '', '', 0, 3, NULL),
(84, NULL, NULL, 'The Bon Vivant', 'Edinburgh', 'EH2 1DY', 'A bon vivant is a person who lives well, who likes life’s finer things, especially those one can ingest and imbibe, a suitable name for this wine bar and restaurant with its dash of Gallic charm. The Thistle Street bar stocks a superb selection of wines and champagnes, with over 30 available by the glass and carafe. (There’s a wine shop next door if you’re still not sated). They have a frequently rotating cocktail list and the opening hours make it the perfect stop off for a late night tipple. They also serve an array of lovely things on which to nibble, with both their starters and desserts served in miniature portions, which is great if you’re indecisive or if you only want a tiny bite, though ‘normal’ sized meals are available too. Mains (or in this case, ‘middles’) are modern European in influence, pan roast pork fillet, butter-poached brill and the like. Desserts are worth saving room for, particularly the praline chocolate tart.  The prices are reasonable and the place is simply but attractively, decorated, slightly pub-like in atmosphere, busy and buzzy, with candles on the table-tops and warm, dark walls. DJs play on Fridays and Saturdays and they also have regular Sunday jazz sessions, perfect for a weekend chill out.', '56', '-3', 'http://bonvivantedinburgh.co.uk', '', '4,41312E+11', 3, 1, 'A Bon Vivant is a person who lives well, who likes life’s finer things, especially those one can ingest and imbibe. How apt a name then for this appealing ...', 0, 0, 1, '', 0, '', '1,10486E+14', 'https://www.facebook.com/pages/The-Bon-Vivant/110485698997989', 'the_bon_vivant', 'https://www.twitter.com/the_bon_vivant', '330849', 'http://instagram.com/The+Bon+Vivant', '', 622, 5500, 15, 2290, 0, 0, 'a:26:{i:0;s:6:"County";i:1;s:16:" MondayOpenHours";i:2;s:17:" TuesdayOpenHours";i:3;s:19:" WednesdayOpenHours";i:4;s:18:" ThursdayOpenHours";i:5;s:16:" FridayOpenHours";i:6;s:18:" SaturdayOpenHours";i:7;s:16:" SundayOpenHours";i:8;s:9:" Category";i:9;s:15:" OutdoorSeating";i:10;s:5:" Wifi";i:11;s:11:" PriceRange";i:12;s:16:" PaymentAccepted";i:13;s:11:" FacebookId";i:14;s:17:" FacebookUserPage";i:15;s:12:" TwitterName";i:16;s:16:" TwitterUserPage";i:17;s:12:" InstagramId";i:18;s:18:" InstagramUserPage";i:19;s:13:" FoursquareId";i:20;s:19:" FoursquareUserPage";i:21;s:14:" FacebookLikes";i:22;s:17:" FacebookCheckins";i:23;s:16:" FoursquareLikes";i:24;s:19:" FoursquareCheckIns";i:25;s:15:" FoursquareTips";}', 'a:4:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:8:" Website";i:3;s:6:" Phone";}', '55 Thistle St ', '4bae5d02f964a52023a83be3', 'https://foursquare.com/v/the-bon-vivant/4bae5d02f964a52023a83be3', 9, 4, NULL),
(85, NULL, NULL, 'Prozak', '', '', 'A cavernous and cosmopolitan music club located just off the city''s atmospheric Market Square, Prozak comprises the Holy Trinity of elite late-night entertainment: a suave selection of drinks, progressive dance music and veritable slew of pretty people geared up for a night of pure revelry. Make your way down a short flight of stairs and through the persnickety door police to get to all the action, which happens in large labyrinth-like hallways and relaxing lounges decorated with avant-garde artwork and eclectic furnishings. After the bar turns into club (and the cover charge kicks into effect), you’ll typically find a mix of in-the-know visitors, engaging expats and a loyal following of cool locals crowding the bar, chilling with water pipes or shimmy-shammying across the sizeable subterranean dance floors.', '50', '20', 'http://www.prozak.pl/', 'prozak@prozak.pl', '48124291128', 0, 0, 'A cavernous and cosmopolitan music club located just off the city''s atmospheric Market Square, Prozak comprises the Holy Trinity of elite late-night entertainment: ...', 0, 0, 0, '', 0, '', '1,96593E+14', 'https://www.facebook.com/pages/Klub-Prozak/196593390372364', '', '', '236412935', 'http://instagram.com/Klub+Prozak', '', 0, 749, 0, 208, 0, 0, 'a:14:{i:0;s:15:"MondayOpenHours";i:1;s:17:" TuesdayOpenHours";i:2;s:19:" WednesdayOpenHours";i:3;s:18:" ThursdayOpenHours";i:4;s:16:" FridayOpenHours";i:5;s:18:" SaturdayOpenHours";i:6;s:16:" SundayOpenHours";i:7;s:9:" Category";i:8;s:11:" FacebookId";i:9;s:17:" FacebookUserPage";i:10;s:12:" InstagramId";i:11;s:18:" InstagramUserPage";i:12;s:14:" FacebookLikes";i:13;s:17:" FacebookCheckins";}', 'a:5:{i:0;s:4:"City";i:1;s:8:" Street1";i:2;s:20:" GeocoordinateString";i:3;s:8:" Website";i:4;s:6:" Phone";}', 'pl. Dominikański 6 ', '', '', 0, 182, NULL),
(86, NULL, NULL, 'Belle Epoque', 'QLD', '4006', 'A celebration of all things French, this bar, restaurant and patisserie in Fortitude Valley exudes elegance. The decor is redolent of an old fashioned French brasserie, serving classic French cuisine in warm, inviting surroundings. This is the kind of place where you can linger over a bowl of excellent onion soup or a plate of fruits des mer. Mirrors line the walls and there''s a large bar area where one can partake of a pre-dinner drink, a Kir Royal perhaps or a signature Belle Epoque cocktail of calavados, fresh mint, apple juice and champagne. There''s a large selection of aperitifs and a wine list that features a decent selection of wines by the glass as well as an impressive array of champagnes. The next door patisserie is a great place to pick up a baguette, a pastry or a coffee served in the flat-white style.', '-27', '153', 'http://www.belleepoque.com.au', '', '61738521500', 0, 1, 'A celebration of all things French, this bar, restaurant and patisserie in Fortitude Valley exudes elegance. The decor is redolent of an old fashioned ...', 1, 0, 0, '', 0, 'street,lot,valet', '1,75241E+11', 'https://www.facebook.com/pages/Belle-%C3%89poque-Bistro-Brisbane/175241171374', '738521500', 'https://www.twitter.com/0738521500', '2079509', 'http://instagram.com/Belle+%C3%89poque+Bistro+-+Brisbane', '', 443, 1917, 4, 175, 0, 0, 'a:29:{i:0;s:6:"County";i:1;s:11:" PostalCode";i:2;s:6:" Phone";i:3;s:16:" MondayOpenHours";i:4;s:17:" TuesdayOpenHours";i:5;s:19:" WednesdayOpenHours";i:6;s:18:" ThursdayOpenHours";i:7;s:16:" FridayOpenHours";i:8;s:18:" SaturdayOpenHours";i:9;s:16:" SundayOpenHours";i:10;s:9:" Category";i:11;s:15:" OutdoorSeating";i:12;s:16:" PaymentAccepted";i:13;s:19:" RestaurantServices";i:14;s:12:" ParkingType";i:15;s:16:" PublicTransport";i:16;s:11:" FacebookId";i:17;s:17:" FacebookUserPage";i:18;s:12:" TwitterName";i:19;s:16:" TwitterUserPage";i:20;s:12:" InstagramId";i:21;s:18:" InstagramUserPage";i:22;s:13:" FoursquareId";i:23;s:19:" FoursquareUserPage";i:24;s:14:" FacebookLikes";i:25;s:17:" FacebookCheckins";i:26;s:16:" FoursquareLikes";i:27;s:19:" FoursquareCheckIns";i:28;s:15:" FoursquareTips";}', 'a:3:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:8:" Website";}', 'Emporium, 1000 Ann Street, Fortitude Valley ', '4cb5429cf6616dcbc986d608', 'https://foursquare.com/v/belle-epoque-patisserie/4cb5429cf6616dcbc986d608', 6, 23, NULL),
(87, NULL, NULL, 'Grog', '', ' 730-0034', 'A chic new minimalist cocktail bar with a ten-seater counter and intimate  4-seater tables where long-glass alcohol and short sharp shots are the name  of the game. It''s trademark dark in that hip Japanese sushi box kind of way,  with tall windows to look out onto the street life outside and smooth mirror  lighting adding space age atmosphere from behind the bar. Good for some  low-intensity romance or a late drink at the end of the night. After all, what self-respecting cocktail barfly could refuse somewhere with a name like this.', '34', '132', '', '', '00 81 82 240 0007 or 00 81 82 240 0007', 0, 0, 'A chic new minimalist cocktail bar with a ten-seater counter and intimate  4-seater tables where long-glass alcohol and short sharp shots are the name ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', 'Town Shintenchi Building 5F  5-21 Shintenchi Naka-ku', '', '', 0, 117, NULL),
(88, 3, 8, 'Sir Winston', 'Île-de-France', '75116', 'A chic, English-cum-American drink and dance spot in the heart of Paris? Who said diplomacy was dead. Our stylish French friends have refurbished the oldest pub in Paris, giving it a plush, dark-wood finish, naming it after Winston Churchill, and making it look like an English member''s bar meets a New York cocktail lounge. The hip and trendy regulars lounge on plush sofas and couches on the first floor sipping fine cocktails under beautiful oil paintings, while downstairs is more of a dance space with DJs spinning jazzy sounds. All around you though you can order fine cocktails and flirt with dashing boys and girls. For all its hip quotient, it''s surprisingly welcoming and laid-back. There are outside pavement café tables to sit and eat at too. ', '49', '2', 'http://www.sirwinston.fr', '', '33140671737', 3, 1, 'A chic, English-cum-American drink and dance spot in the heart of Paris? Who said diplomacy was dead. Our stylish French friends have refurbished the ...', 1, 0, 1, '', 0, '', '5,50826E+14', 'https://www.facebook.com/pages/Sir-Winston/550825894963894', '', '', '1192010', 'http://instagram.com/Sir+Winston', '', 2479, 6239, 48, 441, 0, 0, 'a:27:{i:0;s:6:"County";i:1;s:11:" PostalCode";i:2;s:8:" Website";i:3;s:16:" MondayOpenHours";i:4;s:17:" TuesdayOpenHours";i:5;s:19:" WednesdayOpenHours";i:6;s:18:" ThursdayOpenHours";i:7;s:16:" FridayOpenHours";i:8;s:18:" SaturdayOpenHours";i:9;s:16:" SundayOpenHours";i:10;s:9:" Category";i:11;s:15:" OutdoorSeating";i:12;s:5:" Wifi";i:13;s:11:" PriceRange";i:14;s:16:" PaymentAccepted";i:15;s:19:" RestaurantServices";i:16;s:11:" FacebookId";i:17;s:17:" FacebookUserPage";i:18;s:12:" InstagramId";i:19;s:18:" InstagramUserPage";i:20;s:13:" FoursquareId";i:21;s:19:" FoursquareUserPage";i:22;s:14:" FacebookLikes";i:23;s:17:" FacebookCheckins";i:24;s:16:" FoursquareLikes";i:25;s:19:" FoursquareCheckIns";i:26;s:15:" FoursquareTips";}', 'a:3:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:6:" Phone";}', '5 rue de Presbourg ', '4adcda06f964a520bc3221e3', 'https://foursquare.com/v/sir-winston-paris-%C3%AEledefrance/4adcda06f964a520bc3221e3', 30, 2, NULL),
(89, NULL, NULL, 'Solas', '', '2', 'A chilled bar on trendy Wexford Street, Solas is a popular spot and deservedly so. Boasting a laid back pub vibe and a lively atmosphere, this place attracts a young crowd eager to kick back with a drink. A relaxed hang out on weekdays, its relatively small size and narrow layout means it can get crazily packed on weekends, but even then the atmosphere is still pretty friendly. Music is an agreeable mix of funk and soul and the house DJs really know how to do their thing and get people going. Formerly the Modern Green Bar, this is a top spot for those who like their tunes smooth. Worth checking out.', '53', '-6', 'http://www.solasbars.com', '', '35314780583', 1, 1, 'A chilled bar on trendy Wexford Street, Solas is a popular spot and deservedly so. Boasting a laid back pub vibe and a lively atmosphere, this place attracts ...', 0, 0, 1, '', 0, 'street', '1,25103E+14', 'https://www.facebook.com/solasdublin', '', '', '257318932', 'http://instagram.com/The+Solas+Bar', '', 1068, 1911, 21, 114, 0, 0, 'a:21:{i:0;s:10:"PostalCode";i:1;s:8:" Website";i:2;s:9:" Category";i:3;s:15:" OutdoorSeating";i:4;s:5:" Wifi";i:5;s:11:" PriceRange";i:6;s:16:" PaymentAccepted";i:7;s:19:" RestaurantServices";i:8;s:12:" ParkingType";i:9;s:16:" PublicTransport";i:10;s:11:" FacebookId";i:11;s:17:" FacebookUserPage";i:12;s:12:" InstagramId";i:13;s:18:" InstagramUserPage";i:14;s:13:" FoursquareId";i:15;s:19:" FoursquareUserPage";i:16;s:14:" FacebookLikes";i:17;s:17:" FacebookCheckins";i:18;s:16:" FoursquareLikes";i:19;s:19:" FoursquareCheckIns";i:20;s:15:" FoursquareTips";}', 'a:3:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:6:" Phone";}', '31 Wexford St ', '4b257a6cf964a520987224e3', 'https://foursquare.com/v/solas/4b257a6cf964a520987224e3', 11, 113, NULL),
(90, 13, 24, 'Galander Kreuzberg', 'Berlin', '10965', 'A classic Berlin bar this, furnished in vintage-style with inviting leather armchairs, black and white photographs on the walls, a well-stocked back bar, and a warm yellow glow. Dominik Galander’s eponymous Kreuzberg bar – part of a mini liquid empire - is a cosy, friendly place with a main bar area in the front, a few tables scattered in the back, and a piano in the corner for when the mood for music strikes. Most of the crowd are local but everyone is made to feel welcome. The bar tenders are down to earth and easy-going. They stock a good range of beer, an excellent selection of wine and can mix up a Golden Age cocktail for you, everything from a potent Gin Rickey to a smooth, sweet 1940s Golden Cadillac to a fruity Pusser’s Painkiller from the 1970s. Try their three course liquid dinner if you want a real treat: an aperitif followed by something more full-blooded chased with a sweet dessert cocktail. The staff are knowledgeable and will happily regale you with stories of the bar tender’s art and the history of the things you’re drinking. A solid, welcoming neighbourhood bar that’s a cut above the average and, as such, much recommended. ', '52', '13', 'http://bar.galander-berlin.de', '', '4,93029E+11', 3, 1, 'A classic Berlin bar this, furnished in vintage-style with inviting leather armchairs, black and white photographs on the walls, a well-stocked back bar, and a warm yellow glow. Dominik Galander’s eponymous Kreuzberg bar – part of a mini liquid empire - is a cosy, friendly place with a main bar area in the front...', 0, 0, 0, '', 0, '', '', '', '', '', '12954791', 'http://instagram.com/GALANDER+%E2%80%93+Kreuzberg+%E2%80%93', '', 197, 0, 12, 0, 0, 0, 'a:23:{i:0;s:6:"County";i:1;s:11:" PostalCode";i:2;s:8:" Website";i:3;s:6:" Phone";i:4;s:16:" MondayOpenHours";i:5;s:17:" TuesdayOpenHours";i:6;s:19:" WednesdayOpenHours";i:7;s:18:" ThursdayOpenHours";i:8;s:16:" FridayOpenHours";i:9;s:18:" SaturdayOpenHours";i:10;s:16:" SundayOpenHours";i:11;s:9:" Category";i:12;s:15:" OutdoorSeating";i:13;s:5:" Wifi";i:14;s:11:" PriceRange";i:15;s:16:" PaymentAccepted";i:16;s:12:" InstagramId";i:17;s:18:" InstagramUserPage";i:18;s:13:" FoursquareId";i:19;s:19:" FoursquareUserPage";i:20;s:16:" FoursquareLikes";i:21;s:19:" FoursquareCheckIns";i:22;s:15:" FoursquareTips";}', 'a:3:{i:0;s:7:"Country";i:1;s:8:" Street1";i:2;s:20:" GeocoordinateString";}', 'Großbeerenstr. 54 Kreuzberg', '4b45dba2f964a520431126e3', 'https://foursquare.com/v/galander--kreuzberg-/4b45dba2f964a520431126e3', 6, 7, NULL),
(91, NULL, NULL, 'The Bentley', 'NSW', '2010', 'A collaborative venture between acclaimed Sydney sommelier Nick Hildebrandt and chef Brent Savage was always going to be special – and The Bentley delivered on all fronts. Already established as one of the city’s best places to drink and dine, a 2010 refurbishment lifted this place up to an even more elite level. The bar area is now more defined and operates independently of the restaurant, making it a good choice for a cocktail even if you’re not planning to stay for dinner – though we recommend you do', '0', '0', '', '', '', 0, 0, 'A collaborative venture between acclaimed Sydney sommelier Nick Hildebrandt and chef Brent Savage was always going to be special – and The Bentley delivered on all fronts.', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '320 Crown Street Surry Hills  2010', '', '', 0, 23, NULL),
(92, NULL, NULL, 'Marika', '', '', '', '0', '0', '', '', '', 0, 0, 'A complex lady of many personalities, Marika is a fine-dining restaurant by day and sultry club by night', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', 'Ulitsa Petrovka 21 ', '', '', 0, 188, NULL),
(93, NULL, NULL, 'Bar Fakers', '', ' 606-8236', 'A cool and grungy loft bar that''s not as phoney as the name suggests.  Conveniently located above the Anchovie Cafe near Mototanaka Station, the drinks are cheaper than most spots this side of town and the cheery regular barmen don''t skimp on the shots. Beers and vodka-based cocktails seem to be popular with the regulars, a mix of with-it youngsters and more sober professionals. Inside it''s dark and moody with bar stools lining the counter, although we prefer the sofas and soft chairs to lie back on and listen to the techno and ambient sounds. Why not ''Fake'' it?', '35', '136', '', '', '00 81 75 722 8228', 0, 0, 'A cool and grungy loft bar that''s not as phoney as the name suggests.  Conveniently located above the Anchovie Cafe near Mototanaka Station, the drinks ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '47-2  Okubo-cho Tanaka  Sakyo-ku ', '', '', 0, 117, NULL),
(94, NULL, NULL, 'Monkey Club', '', 'FL 33401', 'A cool tongue-in-cheek club-bar that transports you to some colonial  plantation owner''s Caribbean-island mansion. The decor is all  island-inspired kitsch with plantation-style shutter windows, French doors,  bougainvillaea wrapped trellises and massive palm trees obscuring the  gazebos. The crowd is just as spectacular - a tribe of trendy tanned yuppies  in skimpy, shiny garb some of them straight off the beach. Gyrate with some  Margarita while drinking a margarita on a dance floor as large as a cane  field. DJs spin everything from trip-hop to salsa and cheesy theme nights  like the ''Miss Hawaiian Tropic Model Search'' are worth the entrance alone.  The menu features basic American bar food and if the whole scene does not  suit your style, you''re on Palm Beach''s trendy Clematis Street where  happening hot spots are as ubiquitous as dodgy Palm Beach ballot papers.', '27', '-80', '', '', '15 618 336 500', 0, 0, 'A cool tongue-in-cheek club-bar that transports you to some colonial  plantation owner''s Caribbean-island mansion. The decor is all  island-inspired kitsch ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '219  Clematis St.  West Palm Beach ', '', '', 0, 3, NULL),
(95, NULL, NULL, 'Guru Bar', '', '', 'A cult, kitsch loft-bar in the heart of town but with not enough room to swing  a dolmades so book early if you want to eat. Food is tasty Thai and comes with spice but it''s the drinks and company you come here for. Regulars are students, artists, intellectuals and actors from Thisson and surrounds, and they recline on soft velvet sofas nodding to the DJs beat, sipping mostly whiskey or wine. The best table is the small one in the corner, next to the plant, where you can gaze at fellow gurus almost unnoticed.', '38', '24', 'http://www.bargurubar.gr', '', '5', 0, 0, 'A cult, kitsch loft-bar in the heart of town but with not enough room to swing  a dolmades so book early if you want to eat. Food is tasty Thai and comes ...', 0, 0, 0, '', 0, '', '2,87987E+14', 'https://www.facebook.com/pages/BAR-guru-BAR-the-early-years-1996-2003/287987164551709', '', '', '', '', '', 0, 43, 0, 10, 0, 0, 'a:5:{i:0;s:8:"Category";i:1;s:11:" FacebookId";i:2;s:17:" FacebookUserPage";i:3;s:14:" FacebookLikes";i:4;s:17:" FacebookCheckins";}', 'a:3:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:6:" Phone";}', '10 Thetrou sq. ', '', '', 0, 92, NULL),
(96, NULL, NULL, 'Mink', '', 'Victoria 3182', 'A dark basement bar? Hidden seating? Enormous selection of spirits and the whole thing done out in velvet? Just think what could happen and, in fact, it does in this sexy haven for those looking for more than a Burning Bush to kiss their lips. Wicked and wonderful.', '-38', '145', 'http://www.minkbar.com.au/', '', '61 3 9536 1199', 0, 0, 'A dark basement bar? Hidden seating? Enormous selection of spirits and the whole thing done out in velvet? Just think what could happen and, in fact, ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '2b  Acland Street  2b Acland Street ', '', '', 0, 23, NULL),
(97, 4, 29, 'Antik', 'NY', '10079', 'A dimly lit, retro-chic bar located in the vicinity of the super cool Bowery Hotel, Antik has the advantage of late-opening hours. This means they are ideally situated for soaking up the hotel spill-over crowd looking to continue the fun after the Bowery’s lobby bar closes at 2am. Owners are nightlife impresarios Larry Kramer and Craig Koenig, also of R&R and Retreat, and in this watering hole they’ve aimed for a touch of Prohibition-era decorum. There’s no need to jostle for space at the bar of this semi-private lounge. In fact, there is no bar - Antik offers its patrons bottle service or a selection of classic New York cocktails brought directly to the table by cocktail servers. Antik prides itself on its intimate, discreet atmosphere, so with just eight tables and space for only 74 people, reservations are recommended if you want to secure yourself a prime spot among the trendsetters who gather here. Cocktails include the Cowboy, a jalapeno-infused margarita, and the Hi Ho – gin, white port and bitters – and are mostly on the money, though they can veer towards the sugary-sweet at times. Housed in the old Marion’s Marquee space, it can be a tad self-conscious, but it still has its own charms. The appealing decor mixes burgundy and gold walls with sumptuous drapes, opulent chandeliers and marble-topped tables for a 21st Century hipster interpretation of the 1920s speakeasy. Staff are attentive and the VIP area is truly cool. With some killer tunes thrown in, this one’s a grower.', '41', '-74', 'http://drshameera.blogspot.com', '', '1,60196E+11', 0, 0, 'A dimly lit, retro-chic bar located in the vicinity of the super cool Bowery Hotel, Antik has the advantage of late-opening hours. ', 0, 0, 0, '', 0, '', '1,16313E+14', 'https://www.facebook.com/pages/Antik/116312841790504', '', '', '635746', 'http://instagram.com/Antik', '', 378, 99, 1, 4, 0, 0, 'a:15:{i:0;s:6:"County";i:1;s:8:" Street2";i:2;s:8:" Website";i:3;s:9:" Category";i:4;s:11:" FacebookId";i:5;s:17:" FacebookUserPage";i:6;s:12:" InstagramId";i:7;s:18:" InstagramUserPage";i:8;s:13:" FoursquareId";i:9;s:19:" FoursquareUserPage";i:10;s:14:" FacebookLikes";i:11;s:17:" FacebookCheckins";i:12;s:16:" FoursquareLikes";i:13;s:19:" FoursquareCheckIns";i:14;s:15:" FoursquareTips";}', 'a:4:{i:0;s:10:"PostalCode";i:1;s:8:" Street1";i:2;s:20:" GeocoordinateString";i:3;s:6:" Phone";}', '356 Bowery btw 3rd and 4th', '4a02e559f964a52072711fe3', 'https://foursquare.com/v/antik/4a02e559f964a52072711fe3', 5, 3, NULL),
(98, NULL, NULL, 'Jameson Bar', '', 'LV 1011', 'A dinky bar with a retro vibe, Jameson has far moe charm than an Irish joint in an eastern European city has any right to. Maybe it''s the cocktails which are surprisingly good or the crowd which is an agreeable mix of tourists and locals. It''s one of the only late bars in the area which is definitely an asset and makes a good chill out spot after a night on the town. It''s a low key, idiosyncratic spot - but sometimes that''s all you want.', '57', '24', 'http://www.jamesonbar.lv', '', '37129262262', 0, 1, 'A dinky bar with a retro vibe, Jameson has far moe charm than an Irish joint in an eastern European city has any right to. Maybe it''s the cocktails which ...', 0, 1, 0, '', 0, 'street', '2,83131E+14', 'https://www.facebook.com/jamesonbar.lv', '', '', '270050563', 'http://instagram.com/Jameson+Bar%26Club', '', 1279, 2133, 18, 591, 0, 0, 'a:28:{i:0;s:10:"PostalCode";i:1;s:8:" Website";i:2;s:6:" Phone";i:3;s:16:" MondayOpenHours";i:4;s:17:" TuesdayOpenHours";i:5;s:19:" WednesdayOpenHours";i:6;s:18:" ThursdayOpenHours";i:7;s:16:" FridayOpenHours";i:8;s:18:" SaturdayOpenHours";i:9;s:16:" SundayOpenHours";i:10;s:9:" Category";i:11;s:5:" Mood";i:12;s:15:" OutdoorSeating";i:13;s:10:" HappyHour";i:14;s:16:" PaymentAccepted";i:15;s:19:" RestaurantServices";i:16;s:12:" ParkingType";i:17;s:11:" FacebookId";i:18;s:17:" FacebookUserPage";i:19;s:12:" InstagramId";i:20;s:18:" InstagramUserPage";i:21;s:13:" FoursquareId";i:22;s:19:" FoursquareUserPage";i:23;s:14:" FacebookLikes";i:24;s:17:" FacebookCheckins";i:25;s:16:" FoursquareLikes";i:26;s:19:" FoursquareCheckIns";i:27;s:15:" FoursquareTips";}', 'a:2:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";}', 'Kr. Barona street 52 ', '4ca53f22ae1eef3b2e203047', 'https://foursquare.com/v/jameson/4ca53f22ae1eef3b2e203047', 11, 128, NULL),
(99, 9, 30, 'Lily Lounge', 'ON', '', 'A fabulous "boutique" lounge and restaurant hangout in the heart of Little Italy where getting a specialty cocktail doesn''t mean you have to put up with a side order of pretension and a loud stockbroker in a suit sounding off next to you at the bar. The chic, streamlined party space is set over two floors and features two bars. The upper floor is the main lounge and is decked out with rows of funky dining booths, while the lower level provides the dance floor, where you’ll find some of the best DJs in the city doing their thing. The adventurous food menu offers quirky and imaginative dishes. Billed as “international tapas” they mix modern Italian with the best of European – so expect everything from chicken quesadillas to tasty goats cheese ravioli. The food may be good but it''s the drinks you really come for: Lily is known for rustling up a string of crafty creations such as the Bowl of Beauty (vodka-laced Jell-O), the Pollyanna (raspberry vodka, strawberry juice and prosecco) and, our favourite, the Royal Family Martini made with a monstrous, but entirely welcome, helping of Beefeater Gin. The nightlife is plentiful here on College Street, but it’s of a slightly more mature order than the city’s downtown clubland district. So you’ll find a sophisticated, artsy crowd hanging out at Lily, and baggy jeans and trainers will be frowned upon.  And if you think the bar staff are gorgeous, you’re in for a treat, the late-night downstairs regulars are even hotter.', '44', '-79', 'https://www.facebook.com/pages/Lily-lounge/130261820374168', 'info@lilylounge.com', '14165320419', 1, 0, 'A fabulous "boutique" lounge and restaurant hangout in the heart of Little Italy where getting a specialty cocktail doesn''t mean you have to put up with a side order ...', 0, 0, 0, '', 0, 'street', '2,66172E+14', 'https://www.facebook.com/LilyLoungeMarch14', '', '', '', '', '', 0, 4, 0, 4, 0, 0, 'a:15:{i:0;s:6:"County";i:1;s:16:" MondayOpenHours";i:2;s:17:" TuesdayOpenHours";i:3;s:19:" WednesdayOpenHours";i:4;s:18:" ThursdayOpenHours";i:5;s:16:" FridayOpenHours";i:6;s:18:" SaturdayOpenHours";i:7;s:16:" SundayOpenHours";i:8;s:9:" Category";i:9;s:11:" PriceRange";i:10;s:12:" ParkingType";i:11;s:11:" FacebookId";i:12;s:17:" FacebookUserPage";i:13;s:14:" FacebookLikes";i:14;s:17:" FacebookCheckins";}', 'a:4:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:8:" Website";i:3;s:6:" Phone";}', '656 college street ', '', '', 0, 6, NULL),
(100, NULL, NULL, 'De Vagant', 'Antwerp', '2000', 'A famous city centre bar with adjoining shop and restaurant, renowned for only serving liqueurs and jenerver - Belgian gin. But what a choice: there are more than 200 gin selections in the bar and over 400 in the shop - plus a choice of 1,000 miniature bottles to buy or try - just in case you get thirsty. Predictably, the traditional fare served up in the restaurant is flavoured with the same jenerver. Choose a stool in the bar, order a round for your friends and discover whether you prefer this stuff to vodka or scotch.', '51', '4', 'http://www.devagant.be', 'info@devagant.be', '3232331538', 2, 1, 'A famous city centre bar with adjoining shop and restaurant, renowned for only serving liqueurs and jenerver - Belgian gin. But what a choice: there are ...', 1, 0, 0, '', 0, '', '1,97069E+14', 'https://www.facebook.com/pages/De-Vagant/197069090312229', '', '', '1487119', 'http://instagram.com/De+Vagant', '', 1253, 1503, 38, 190, 0, 0, 'a:19:{i:0;s:6:"County";i:1;s:8:" Street2";i:2;s:9:" Category";i:3;s:15:" OutdoorSeating";i:4;s:5:" Wifi";i:5;s:11:" PriceRange";i:6;s:16:" PaymentAccepted";i:7;s:19:" RestaurantServices";i:8;s:11:" FacebookId";i:9;s:17:" FacebookUserPage";i:10;s:12:" InstagramId";i:11;s:18:" InstagramUserPage";i:12;s:13:" FoursquareId";i:13;s:19:" FoursquareUserPage";i:14;s:14:" FacebookLikes";i:15;s:17:" FacebookCheckins";i:16;s:16:" FoursquareLikes";i:17;s:19:" FoursquareCheckIns";i:18;s:15:" FoursquareTips";}', 'a:4:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:8:" Website";i:3;s:6:" Phone";}', 'Reyndersstraat 25 Pelgrimsstraat', '4b634fedf964a5207d712ae3', 'https://foursquare.com/v/de-vagant/4b634fedf964a5207d712ae3', 14, 31, NULL),
(101, NULL, NULL, 'Once in a Blue Moon', '', '135-954', 'A famous live jazz club in happening Cheongdam-dong, modelled on the Blue Moon bars in the States. Expect an eclectic mix of musical styles from original jazz and swing, to bebop and fusion, played by local musicians who may look like they should be on mandolins but are as expert on strings and brass as their Chicago and New Orleans counterparts. The bar is spread over three floors – the first is geared towards enjoying the music up close, the second for letting the music drift into the background as guests chat with friends, and the third for private parties and the VIP crowd. But the jazz is what it’s really all about here. Two groups perform every night, each playing two sets between 7:30pm and 12:40am, so you can be sure of some top notch entertainment whatever time you roll up. World-renowned musicians are known to frequent this intimate drinking hole, along with the trendsetting local crowd and foreigners who have heard tell of the swinging jazz and smooth atmosphere. It’s also a popular location for shooting films, TV shows and commercials. The food is a pricey but top-class mix of French, Mexican and local dishes - try the lobster or the rib eye steak if you’re really looking to push the boat out - and the drinks menu more than matches it for quality and quantity. More than 100 wines are available and your cocktails are named after jazz musicians. A Dizzy Gillespie anyone? Sounds strangely appropriate after you''ve had a few.', '38', '127', 'http://english.visitkorea.or.kr/enu/SI/SI_EN_3_1_1_1.jsp?cid=1523940', '', '8225495490', 0, 1, 'A famous live jazz club in happening Cheongdam-dong, modelled on the Blue Moon bars in the States. Expect an eclectic mix of musical styles from original jazz and swing...', 0, 0, 0, '', 0, '', '2,79265E+14', 'https://www.facebook.com/pages/Once-in-a-Blue-Moon/279264565434621', '', '', '3948035', 'http://instagram.com/Once+In+A+Blue+Moon', '', 1119, 6180, 27, 226, 0, 0, 'a:22:{i:0;s:10:"PostalCode";i:1;s:8:" Website";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:16:" PaymentAccepted";i:11;s:11:" FacebookId";i:12;s:17:" FacebookUserPage";i:13;s:12:" InstagramId";i:14;s:18:" InstagramUserPage";i:15;s:13:" FoursquareId";i:16;s:19:" FoursquareUserPage";i:17;s:14:" FacebookLikes";i:18;s:17:" FacebookCheckins";i:19;s:16:" FoursquareLikes";i:20;s:19:" FoursquareCheckIns";i:21;s:15:" FoursquareTips";}', 'a:2:{i:0;s:19:"GeocoordinateString";i:1;s:6:" Phone";}', '85  Cheongdam-dong  Gangnam-gu ', '4d566d96cff7721e2e7bb5f5', 'https://foursquare.com/v/once-in-a-blue-moon/4d566d96cff7721e2e7bb5f5', 11, 124, NULL),
(102, NULL, NULL, 'Vesuvio', 'CA', '94133', 'A favourite hang-out of Jack Kerouac and Neal Cassidy, this San Fran bar is a must visit for anyone with even a passing interest in the Beat Generation. Fortunately, it doesn’t just coast on its literary associations, and it remains an atmospheric and inviting bar by any standard. Located in North Beach, opposite the famous City Lights Bookstore, it has a jazzy, lively vibe and attracts a crowd of laid-back locals alongside the odd literary-minded tourist clutching their well-thumbed copies of On The Road. Spread over two floors, the walls are peppered with photos of Kerouac, Ginsberg, Dylan Thomas and co – though they’ve thankfully resisted the urge to overdo it. There’s a decent selection of beers and spirits on offer and an air of unmanufactured bohemia.', '38', '-122', 'http://www.vesuvio.com', 'vesuvio@vesuvio.com', '14153623370', 2, 1, 'A favourite hang-out of Jack Kerouac and Neal Cassidy, this San Fran bar is a must visit for anyone with even a passing interest in the Beat Generation. ...', 0, 1, 0, 'foursquare.com/v/vesuvio-cafe/3fd66200f964a52044ed1ee3/menu', 0, '', '4,68333E+14', 'https://www.facebook.com/pages/Vesuvios/468333306533419', '', '', '217344649', 'http://instagram.com/Vesuvio%27s', '', 10502, 7123, 179, 126, 0, 0, 'a:26:{i:0;s:6:"County";i:1;s:11:" PostalCode";i:2;s:8:" Street2";i:3;s:16:" MondayOpenHours";i:4;s:17:" TuesdayOpenHours";i:5;s:19:" WednesdayOpenHours";i:6;s:18:" ThursdayOpenHours";i:7;s:16:" FridayOpenHours";i:8;s:18:" SaturdayOpenHours";i:9;s:16:" SundayOpenHours";i:10;s:9:" Category";i:11;s:10:" HappyHour";i:12;s:11:" PriceRange";i:13;s:16:" PaymentAccepted";i:14;s:8:" MenuUrl";i:15;s:11:" FacebookId";i:16;s:17:" FacebookUserPage";i:17;s:12:" InstagramId";i:18;s:18:" InstagramUserPage";i:19;s:13:" FoursquareId";i:20;s:19:" FoursquareUserPage";i:21;s:14:" FacebookLikes";i:22;s:17:" FacebookCheckins";i:23;s:16:" FoursquareLikes";i:24;s:19:" FoursquareCheckIns";i:25;s:15:" FoursquareTips";}', 'a:3:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:6:" Phone";}', '255 Columbus Ave btwn Broadway and Pacific', '3fd66200f964a52044ed1ee3', 'https://foursquare.com/v/vesuvio-cafe/3fd66200f964a52044ed1ee3', 82, 3, NULL),
(103, NULL, NULL, 'Barrio Central', 'Greater London', 'W1F 8PS', 'A few doors down from the refined Milk and Honey lies a rather different bar. The lively Latin-influenced Barrio Central is the younger sister of a popular Islington bar. The décor is colourful and cluttered, with a degree of kitsch appeal, featuring as it does an abundance of quirky lampshades, a makeshift garden area and a healthy scattering of tiki trinkets. The bar stocks an array of tequilas and the cocktail list is lengthy and inventive. They even offer cocktail flights if you want to give your palate a work-out without getting overly refreshed', '0', '0', '', '', '', 0, 0, 'A few doors down from the refined Milk and Honey lies a rather different bar. The lively Latin-influenced Barrio Central is the younger sister of a popular ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '6 Poland St Soho', '', '', 0, 4, NULL),
(104, NULL, NULL, 'The Saint', 'VIC', '3182', 'A former bank in St Kilda that''s been turned into a hotel and, to us, that''s a sign of progress. The old bank vault is now a drinking den and you can recline on great soft couches sampling their wide selection of Saint specials, all the time knowing your money is safe with the management. The various cosmopolitans on offer seemed popular with the luscious young Kylie look-alikes we came across, but fruity muddles were also available. Out back is a Balinese (or is it Japanese?) inspired garden, where it''s just fine to lie back in summer, sip a cocktail and pretend you''re Simon Templar. DJs spin cool tunes for a flirty crowd who are far more devil than saint. Banking has never been this much fun.', '-38', '145', 'http://www.thesainthotel.com', '', '61395938333', 0, 0, 'A former bank in St Kilda that''s been turned into a hotel and, to us, that''s a sign of progress. The old bank vault is now a drinking den and you can ...', 0, 0, 0, '', 0, 'street', '1,2061E+14', 'https://www.facebook.com/sainthotel', '', '', '2154306', 'http://instagram.com/The+Saint+Hotel', '', 0, 16720, 0, 3526, 0, 0, 'a:11:{i:0;s:6:"County";i:1;s:9:" Category";i:2;s:5:" Mood";i:3;s:19:" RestaurantServices";i:4;s:12:" ParkingType";i:5;s:11:" FacebookId";i:6;s:17:" FacebookUserPage";i:7;s:12:" InstagramId";i:8;s:18:" InstagramUserPage";i:9;s:14:" FacebookLikes";i:10;s:17:" FacebookCheckins";}', 'a:6:{i:0;s:7:"Country";i:1;s:5:" City";i:2;s:11:" PostalCode";i:3;s:8:" Street1";i:4;s:20:" GeocoordinateString";i:5;s:6:" Phone";}', '54 Fitzroy St St.Kilda', '', '', 0, 23, NULL),
(105, NULL, NULL, 'Passage', '', '1010', 'A former pedestrian underpass linking the Hofburg Palace with the Kunsthistorisches Museum under the busy Ringstrasse, the space was derelict for many years before being turned into its current incarnation: the hottest subterranean underpass night club and bar in the world. The futuristic design makes it seem like you are entering a spaceship and the state-of-the-art lighting and sound system continue the effect. They play house, soul, funk and cutting edge techno and the staff mix up some mean martinis too. So much for Vienna being the home of the coffee house. Welcome to the new old world.', '48', '16', 'http://www.sunshine.at/neu/index.php?l=clubshow&id=2&menu=club&act=2', '', '4,3432E+11', 0, 0, 'A former pedestrian underpass linking the Hofburg Palace with the Kunsthistorisches Museum under the busy Ringstrasse, the space was derelict for many ...', 0, 0, 0, '', 0, '', '1,4336E+14', 'https://www.facebook.com/pages/Club-Passage/143360155726165', '', '', '307495255', 'http://instagram.com/Club+Passage', '', 0, 15572, 0, 1926, 0, 0, 'a:15:{i:0;s:10:"PostalCode";i:1;s:16:" MondayOpenHours";i:2;s:17:" TuesdayOpenHours";i:3;s:19:" WednesdayOpenHours";i:4;s:18:" ThursdayOpenHours";i:5;s:16:" FridayOpenHours";i:6;s:18:" SaturdayOpenHours";i:7;s:16:" SundayOpenHours";i:8;s:9:" Category";i:9;s:11:" FacebookId";i:10;s:17:" FacebookUserPage";i:11;s:12:" InstagramId";i:12;s:18:" InstagramUserPage";i:13;s:14:" FacebookLikes";i:14;s:17:" FacebookCheckins";}', 'a:3:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:6:" Phone";}', 'Burgring 1 ', '', '', 0, 24, NULL),
(106, NULL, NULL, 'Provence Bar', '', '110-0008', '', '0', '0', '', '', '', 0, 0, 'A Franco-Sino classic in the landmark Sofitel Tokyo.  The hotel is a five-tier pagoda made of white granite and glass', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', 'Sofitel Tokyo Hotel  Ikenohata Taito-ku ', '', '', 0, 117, NULL),
(107, NULL, NULL, 'Transit Cocktail Lounge', 'VIC', '3000', 'A full cup must be carried steadily, as the  proverb has it. Bear this in mind when marvelling at the decor of Melbourne''s Transport Hotel, with its brand of gleaming industrial minimalism complete with arterial chrome beer pipes, and polished terrazzo floors off which even the most fastidious would happily eat their dinner.  Misleadingly titled a a hotel, in truth Transport is a bar, and it offers a chic that one does not always associate with Australia. Which is unfair. People-watch then in style while mulling over the menu from which you can order anything from panini to pie.  So futuristic is the feel of the place that it will be at least a 1000 years before it could be called ''retro.''', '-38', '145', 'http://www.transitcocktaillounge.com.au', '', '61396548808', 0, 1, 'A full cup must be carried steadily, as the  proverb has it. Bear this in mind when marvelling at the decor of Melbourne''s Transport Hotel, with its brand ...', 1, 0, 0, '', 0, '', '3,0863E+11', 'https://www.facebook.com/308629941585', 'transitcocktail', 'https://www.twitter.com/transitcocktail', '346493', 'http://instagram.com/Transit+Bar', '', 609, 0, 12, 0, 0, 0, 'a:23:{i:0;s:6:"County";i:1;s:11:" PostalCode";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:15:" OutdoorSeating";i:11;s:16:" PaymentAccepted";i:12;s:11:" FacebookId";i:13;s:17:" FacebookUserPage";i:14;s:12:" TwitterName";i:15;s:16:" TwitterUserPage";i:16;s:12:" InstagramId";i:17;s:18:" InstagramUserPage";i:18;s:13:" FoursquareId";i:19;s:19:" FoursquareUserPage";i:20;s:16:" FoursquareLikes";i:21;s:19:" FoursquareCheckIns";i:22;s:15:" FoursquareTips";}', 'a:5:{i:0;s:7:"Country";i:1;s:8:" Street1";i:2;s:20:" GeocoordinateString";i:3;s:8:" Website";i:4;s:6:" Phone";}', 'Federation Sq. ', '4ba365ccf964a520de3938e3', 'https://foursquare.com/transitcocktail', 5, 23, NULL),
(108, NULL, NULL, 'Avantgarde', 'Bucharest', '', 'A fun, flirtatious late-night club-bar furnished like the inside of a Russian  spaceship. It''s a flash, futuristic interior, spread over two levels with  much aluminum and glass, but if the décor doesn''t get you the drinks  certainly will. Cocktails poured by hard working bar staff might be pricey,  but they''re strong and well mixed. Besides, if you''re in here at all you  probably won''t mind what it costs. It can of course get posy, as with all  late-night clubs in town, but what do you expect from a place calling itself  Avantgarde in an attempt to appear avant garde?  ', '44', '26', '', '', '00 401 94 75 57 66', 0, 0, 'A fun, flirtatious late-night club-bar furnished like the inside of a Russian  spaceship. It''s a flash, futuristic interior, spread over two levels with ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 26, 0, 0, 0, 0, 0, 'a:7:{i:0;s:6:"County";i:1;s:9:" Category";i:2;s:13:" FoursquareId";i:3;s:19:" FoursquareUserPage";i:4;s:16:" FoursquareLikes";i:5;s:19:" FoursquareCheckIns";i:6;s:15:" FoursquareTips";}', 'a:2:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";}', 'Str. Cazzavillan Luigi ', '4d395db297e0a1cddb28633e', 'https://foursquare.com/v/avantgarde/4d395db297e0a1cddb28633e', 0, 187, NULL);
INSERT INTO `wbb_semsoft_imported_bar` (`id`, `city_id`, `suburb_id`, `name`, `county`, `postal_code`, `description`, `latitude`, `longitude`, `website`, `email`, `phone`, `price`, `is_credit_card`, `seo_description`, `is_out_door_seating`, `is_happy_hour`, `is_wifi`, `menu`, `reservation`, `parking_type`, `facebook_id`, `facebook_user_page`, `twitter_name`, `twitter_user_page`, `instagram_id`, `instagram_user_page`, `google_plus_user_page`, `foursquare_check_ins`, `facebook_check_ins`, `foursquare_likes`, `facebook_likes`, `is_permanently_closed`, `business_found`, `updated_columns`, `overwritten_columns`, `address`, `foursquare_id`, `foursquare_user_page`, `foursquare_tips`, `country_id`, `bar_id`) VALUES
(109, 8, 31, 'Mary Jane''s', 'Greater London', 'EC3N 1NT', 'A funky addition to the sometimes predictable City bar scene, Mary Jane’s treads its own path. Located on the Minories, not far from Tower Gateway, inside there’s a mezzanine level with large tables and black leather seating and a more labyrinthine downstairs section with an aquarium and a number of booths to choose from. There’s decent bar food and superb cocktails (we like their signature drink: champagne with Sputnik Rose Petal Vodka and a splash of watermelon, but the Sweetshop Shooters are also worth your time). As with most venues in the area, the place is heaving on weekdays, but shuts on weekends.', '52', '0', 'http://www.maryjanesbar.com', 'manager@maryjanesbar.com', '4,42075E+11', 2, 1, 'A funky addition to the sometimes predictable City bar scene, Mary Jane’s treads its own path. Located on the Minories, not far from Tower Gateway, inside ...', 0, 1, 0, 'foursquare.com/v/mary-janes/4da810a343a12d0c2647aea1/menu', 0, 'street', '1,96526E+14', 'https://www.facebook.com/pages/Mary-Janes-Bar/196526337054103', 'maryjanesbar', 'https://www.twitter.com/maryjanesbar', '6766860', 'http://instagram.com/Mary+Janes+Bar', '', 1028, 19161, 7, 2072, 0, 0, 'a:32:{i:0;s:6:"County";i:1;s:8:" Street2";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:5:" Mood";i:11;s:15:" OutdoorSeating";i:12;s:10:" HappyHour";i:13;s:11:" PriceRange";i:14;s:16:" PaymentAccepted";i:15;s:19:" RestaurantServices";i:16;s:8:" MenuUrl";i:17;s:12:" ParkingType";i:18;s:16:" PublicTransport";i:19;s:11:" FacebookId";i:20;s:17:" FacebookUserPage";i:21;s:12:" TwitterName";i:22;s:16:" TwitterUserPage";i:23;s:12:" InstagramId";i:24;s:18:" InstagramUserPage";i:25;s:13:" FoursquareId";i:26;s:19:" FoursquareUserPage";i:27;s:14:" FacebookLikes";i:28;s:17:" FacebookCheckins";i:29;s:16:" FoursquareLikes";i:30;s:19:" FoursquareCheckIns";i:31;s:15:" FoursquareTips";}', 'a:3:{i:0;s:19:"GeocoordinateString";i:1;s:8:" Website";i:2;s:6:" Phone";}', '124-127 Minories at Haydon St', '4da810a343a12d0c2647aea1', 'https://foursquare.com/v/mary-janes/4da810a343a12d0c2647aea1', 14, 4, NULL),
(110, 7, 32, 'La Suite', 'Provence-Alpes-Côte d''Azur', '6300', 'A gem of a sea-front club-bar recently renovated to cash in on Nice''s hip  revival. It''s dominated by a late-twenties crowd who can be posy and  pretentious since you need money and connections most nights to get through  the door. But book a table first and you''ll be down with the scene. Include  a bottle in the price (Dom Perignon would be nice) and it will be waiting on  your table on arrival. House DJs including the occasional guest from Paris  play the latest in international club sounds and cool French ambient tracks.  Bring money though: this may be seaside town but it''s not ''buckets and spades''.', '44', '7', 'http://www.so-club-nice.com', '', '33641020462', 0, 0, 'A gem of a sea-front club-bar recently renovated to cash in on Nice''s hip  revival. It''s dominated by a late-twenties crowd who can be posy and  pretentious ...', 0, 0, 0, '', 0, '', '1,21725E+14', 'https://www.facebook.com/LaSuiteOperaNightClubVieuxNice', '', '', '236597153', 'http://instagram.com/La+Suite+Opera+Night-Club+Vieux+Nice', '', 3, 1773, 0, 1660, 0, 0, 'a:21:{i:0;s:6:"County";i:1;s:16:" MondayOpenHours";i:2;s:17:" TuesdayOpenHours";i:3;s:19:" WednesdayOpenHours";i:4;s:18:" ThursdayOpenHours";i:5;s:16:" FridayOpenHours";i:6;s:18:" SaturdayOpenHours";i:7;s:16:" SundayOpenHours";i:8;s:9:" Category";i:9;s:5:" Mood";i:10;s:11:" FacebookId";i:11;s:17:" FacebookUserPage";i:12;s:12:" InstagramId";i:13;s:18:" InstagramUserPage";i:14;s:13:" FoursquareId";i:15;s:19:" FoursquareUserPage";i:16;s:14:" FacebookLikes";i:17;s:17:" FacebookCheckins";i:18;s:16:" FoursquareLikes";i:19;s:19:" FoursquareCheckIns";i:20;s:15:" FoursquareTips";}', 'a:5:{i:0;s:10:"PostalCode";i:1;s:8:" Street1";i:2;s:20:" GeocoordinateString";i:3;s:8:" Website";i:4;s:6:" Phone";}', '2 rue Bréa ', '51fd9c69498eeb50ff8ad305', 'https://foursquare.com/v/la-suite-opera/51fd9c69498eeb50ff8ad305', 1, 2, NULL),
(111, NULL, NULL, 'Crazy Café', '', '1065', 'A glam Pest favourite where you get pizzas and pictures of pop-stars with your karaoke and cocktails. The usual bevy of lovely, leggy locals flock in here but it''s the drinks that will really knock you out: a selection of over 100 bottled beers, 18 draught types and 50 cocktails expertly prepared by skilled Magyar mixologists. It''s a big cellar space, with two restaurant areas serving pizzas and Hungarian dishes, two bars and a stage for live music. The walls are decorated with portraits of hundreds of big-name local (and international) celebrities but stop wasting time looking at them. Get the drinks in.', '48', '19', 'http://www.crazycafe.hu/', '', '3613024003', 1, 1, 'A glam Pest favourite where you get pizzas and pictures of pop-stars with your karaoke and cocktails. The usual bevy of lovely, leggy locals flock in ...', 0, 0, 0, '', 0, 'street', '1,36678E+14', 'https://www.facebook.com/crazycafe', '', '', '1668886', 'http://instagram.com/Crazy+Cafe', '', 496, 1875, 4, 1473, 0, 0, 'a:27:{i:0;s:10:"PostalCode";i:1;s:8:" Website";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:5:" Mood";i:11;s:11:" PriceRange";i:12;s:16:" PaymentAccepted";i:13;s:19:" RestaurantServices";i:14;s:12:" ParkingType";i:15;s:16:" PublicTransport";i:16;s:11:" FacebookId";i:17;s:17:" FacebookUserPage";i:18;s:12:" InstagramId";i:19;s:18:" InstagramUserPage";i:20;s:13:" FoursquareId";i:21;s:19:" FoursquareUserPage";i:22;s:14:" FacebookLikes";i:23;s:17:" FacebookCheckins";i:24;s:16:" FoursquareLikes";i:25;s:19:" FoursquareCheckIns";i:26;s:15:" FoursquareTips";}', 'a:3:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:6:" Phone";}', 'Budapest, Jókai utca 30.  ', '4c1bb93b3855c9b6c77ecc71', 'https://foursquare.com/v/crazy-cafe/4c1bb93b3855c9b6c77ecc71', 7, 107, NULL),
(112, 3, 33, 'Le Cabaret', '', '75001', 'A glamorous North African meets Middle Eastern restaurant-bar designed by the brilliant Jacques Garcia. Hip regulars sip cocktails on soft-cushioned beds set in low-ceiling alcoves', '0', '0', '', '', '', 0, 0, 'A glamorous North African meets Middle Eastern restaurant-bar designed by the brilliant Jacques Garcia. Hip regulars sip cocktails on soft-cushioned beds ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '2 place du Palais Royal ', '', '', 0, 2, NULL),
(113, 8, 34, 'The Social', 'Greater London', 'W1W 7JD', 'A glass-floored Collection-esque catwalk leads into the ultimate pine experience bar on 2 floors. Media types flock to this windowless pine mecca for pre-club drinks, even queueing for the privilege. Beers not cocktails are the order of the day but you might pick up a nice bit of rough on the way out.', '52', '0', 'http://www.thesocial.com/', 'carl@thesocial.com', '4,42076E+11', 3, 1, 'A glass-floored Collection-esque catwalk leads into the ultimate pine experience bar on 2 floors. Media types flock to this windowless pine mecca for ...', 0, 0, 0, 'foursquare.com/v/the-social/4ac518c9f964a520a6a520e3/menu', 0, '', '1,28421E+14', 'https://www.facebook.com/pages/The-Social-Hip-Hop-Karaoke/128421250561541', '', '', '226764843', 'http://instagram.com/The+Social+-+Hip+Hop+Karaoke', '', 2566, 1167, 28, 227, 0, 0, 'a:16:{i:0;s:6:"County";i:1;s:9:" Category";i:2;s:11:" PriceRange";i:3;s:16:" PaymentAccepted";i:4;s:8:" MenuUrl";i:5;s:11:" FacebookId";i:6;s:17:" FacebookUserPage";i:7;s:12:" InstagramId";i:8;s:18:" InstagramUserPage";i:9;s:13:" FoursquareId";i:10;s:19:" FoursquareUserPage";i:11;s:14:" FacebookLikes";i:12;s:17:" FacebookCheckins";i:13;s:16:" FoursquareLikes";i:14;s:19:" FoursquareCheckIns";i:15;s:15:" FoursquareTips";}', 'a:3:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:6:" Phone";}', '5 Little Portland St ', '4ac518c9f964a520a6a520e3', 'https://foursquare.com/v/the-social/4ac518c9f964a520a6a520e3', 44, 4, NULL),
(114, NULL, NULL, 'Zeebar', '', 'BS1 4HX', 'A glass-fronted venue with a long ''D'' shaped bar, Boom is renowned for its vibrant and funky swagger with abstract shapes and primaries dominating this   swanky bar. Filled with sofas and booths, the emphasis is firmly on delivering the best New World/Pacific Rim experience in cool environs. Interesting, relaxed and subtly hip, rather like your good self.', '51', '-3', '', '', '(0117) 925 4839', 0, 0, 'A glass-fronted venue with a long ''D'' shaped bar, Boom is renowned for its vibrant and funky swagger with abstract shapes and primaries dominating this ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '46-48  Queen Charlotte Street ', '', '', 0, 4, NULL),
(115, NULL, NULL, '7 Ate Nine', '', '', 'A glimmering white oasis in the centre of Kuala Lumpur, everything about 7 Ate Nine is sleek and stylish. Located at the Ascott hotel, the bar’s interior is awash with chrome and glass and rich, polished wood, everything speaking of understated expense. There’s a gorgeous lounge area with cream linen sofas and soft lighting, and an elegantly curving mezzanine.  The menu encompasses a tempting array of ‘liquids and solids’ including some impeccably presented variants on the mojito and daiquiri', '0', '0', '', '', '', 0, 0, 'A glimmering white oasis in the centre of Kuala Lumpur, everything about 7 Ate Nine is sleek and stylish. Located at the Ascott hotel, the bar’s interior ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '9  Jalan Pinang ', '', '', 0, 140, NULL),
(116, NULL, NULL, 'Library Bar', '', '2', 'A glorious bar tucked away on the first floor of Dublin’s Central Hotel, the Library Bar has a delightfully old fashioned feel to it. Inside one finds a crackling fire and high backed chairs, soft lighting and a sophisticated atmosphere. It is peaceful and elegant, grown up in the very best sense. Table service and inviting sofas add to the appeal. There’s a good array of drinks and the occasional ripple of piano music. The ideal place to sit and think and talk and reminisce over a pint of the black stuff or a good glug of whiskey.', '53', '-6', 'http://www.centralhoteldublin.com/library-bar', '', '35316797302', 2, 1, 'A glorious bar tucked away on the first floor of Dublin’s Central Hotel, the Library Bar has a delightfully old fashioned feel to it. Inside one finds ...', 0, 0, 1, '', 0, '', '1,36338E+14', 'https://www.facebook.com/pages/Library-Bar-At-Central-Hotel/136337786429953', '', '', '241388275', 'http://instagram.com/Library+Bar+At+Central+Hotel', '', 913, 2264, 40, 88, 0, 0, 'a:17:{i:0;s:10:"PostalCode";i:1;s:9:" Category";i:2;s:15:" OutdoorSeating";i:3;s:5:" Wifi";i:4;s:11:" PriceRange";i:5;s:16:" PaymentAccepted";i:6;s:11:" FacebookId";i:7;s:17:" FacebookUserPage";i:8;s:12:" InstagramId";i:9;s:18:" InstagramUserPage";i:10;s:13:" FoursquareId";i:11;s:19:" FoursquareUserPage";i:12;s:14:" FacebookLikes";i:13;s:17:" FacebookCheckins";i:14;s:16:" FoursquareLikes";i:15;s:19:" FoursquareCheckIns";i:16;s:15:" FoursquareTips";}', 'a:5:{i:0;s:7:"Country";i:1;s:8:" Street1";i:2;s:20:" GeocoordinateString";i:3;s:8:" Website";i:4;s:6:" Phone";}', '2 Exchequer St Exchequer Street', '4ade0f0bf964a520e97021e3', 'https://foursquare.com/v/the-library-bar/4ade0f0bf964a520e97021e3', 16, 113, NULL),
(117, NULL, NULL, 'Gecko''s Garden', '', '', 'A glorious green oasis in the heart of Seoul, Gecko’s Garden is just part of the Gecko’s complex which, spread over multiple levels, also includes a restaurant, a gorgeous courtyard garden and a rooftop bar. With its welcoming vibe and plenty of space to sit inside and out this is a popular destination with both locals and visitors. Located just behind the Hamilton Hotel in Itaewon and sheltered from the urban murk, Gecko’s has an air of the countryside resort about it, with wicker seats and terracotta patio tiles making you feel far removed from the urban jungle of Seoul. The restaurant is lined with numerous large windows, giving diners a view of the lush garden outside and lending the room a touch of that al fresco feeling. The eclectic menu draws its influence from all over Europe, with pasta and salad dishes available for lunch while a selection of tapas, steaks and burgers is on the dinner menu. The lively barbecues they host from Friday to Sunday are also popular. A chilled, relaxed spot, it makes an ideal place for a relaxing lunch or group dinner, or simply lingering long with an icy beer, a crisp glass of sauvignon, or a refreshing strawberry daiquiri. Its iced tea-flavoured sorbets, served with an assortment of fruit, also go down well when the temperature soars, particularly with the female clientele. From 12 – 5pm the usual additional tax of 10 per cent is waived so guests can enjoy their food and drink at lower prices. ', '38', '127', '', 'geckosgarden@hotmail.com', '+82 2-790-0540', 0, 0, 'A glorious green oasis in the heart of Seoul, Gecko’s Garden is just part of the Gecko’s complex which, spread over multiple levels, also includes a restaurant, a gorgeous courtyard garden ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '116-6 Itaewon Dong ', '', '', 0, 124, NULL),
(118, NULL, NULL, 'Underground', '', '1066', 'A glorious Pest club-bar in homage to the Emir Kusturica film Underground.  Which is entirely appropriate in that: a) it''s located beneath a cinema, b)  it is underground.  It''s a subterranean space decked out with huge, built-in  factory fans and industrial-type lamps hanging from the ceiling, you access  it by stairs instead of a lift (as in the film). DJs spin a mix of funk and  garage to young and attractive regulars who you can be certain are into  movies. It gets loud and crowded at weekends though. We like ambient nights on  Sundays to Tuesdays. The drinks are spot-on and the bar is long and easily  accessed.', '48', '19', 'www.odeon.hu', '', '3612693223', 0, 0, 'A glorious Pest club-bar in homage to the Emir Kusturica film Underground.  Which is entirely appropriate in that: a) it''s located beneath a cinema, b) ...', 0, 0, 0, '', 0, 'street', '4,19334E+14', 'https://www.facebook.com/odeonunderground', '', '', '36993069', 'http://instagram.com/Odeon+Underground', '', 0, 134, 0, 1251, 0, 0, 'a:17:{i:0;s:10:"PostalCode";i:1;s:8:" Website";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:12:" ParkingType";i:11;s:11:" FacebookId";i:12;s:17:" FacebookUserPage";i:13;s:12:" InstagramId";i:14;s:18:" InstagramUserPage";i:15;s:14:" FacebookLikes";i:16;s:17:" FacebookCheckins";}', 'a:3:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:6:" Phone";}', 'Teréz körút 30. ', '', '', 0, 107, NULL),
(119, NULL, NULL, 'Koko', 'QC', 'H2X 4C9', 'A gorgeous art deco confection, Montreal’s Koko is seemingly effortless in its elegance. From the Audrey Beardsley prints on the ceiling to the smooth, chilled out beats on the sound system, this place oozes true urban cool. A short hop from the smart Hotel Opus, on St Laurent’s restaurant strip, Koko serves inventive Asian influenced dishes and wickedly creative cocktails in dramatic silver and black surroundings. The hipster crowd dress accordingly and the prices are pretty wince-inducing but, for all that, the mood isn’t pretentious or unwelcoming, there’s a laid-back, genial quality that bridges that gap and makes this a place you go to enjoy yourself rather than just to pretend to be enjoying yourself.', '46', '-74', 'http://kokomontreal.com', '', '15146575656', 3, 0, 'A gorgeous art deco confection, Montreal’s Koko is seemingly effortless in its elegance. From the Audrey Beardsley prints on the ceiling to the smooth, ...', 0, 0, 0, '', 0, '', '1,30292E+14', 'https://www.facebook.com/pages/Koko-Restaurant-Bar/130292223669739', 'kokomontreal', 'https://www.twitter.com/kokomontreal', '300676', 'http://instagram.com/Koko+Restaurant+Bar', '', 1762, 15422, 3, 958, 0, 0, 'a:24:{i:0;s:6:"County";i:1;s:8:" Street2";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:11:" PriceRange";i:11;s:11:" FacebookId";i:12;s:17:" FacebookUserPage";i:13;s:12:" TwitterName";i:14;s:16:" TwitterUserPage";i:15;s:12:" InstagramId";i:16;s:18:" InstagramUserPage";i:17;s:13:" FoursquareId";i:18;s:19:" FoursquareUserPage";i:19;s:14:" FacebookLikes";i:20;s:17:" FacebookCheckins";i:21;s:16:" FoursquareLikes";i:22;s:19:" FoursquareCheckIns";i:23;s:15:" FoursquareTips";}', 'a:5:{i:0;s:10:"PostalCode";i:1;s:8:" Street1";i:2;s:20:" GeocoordinateString";i:3;s:8:" Website";i:4;s:6:" Phone";}', '8, rue Sherbrooke Ouest coin Saint-Laurent', '4b624ebef964a5206f412ae3', 'https://foursquare.com/v/koko-restaurant-bar-montr%C3%A9al-qc/4b624ebef964a5206f412ae3', 28, 6, NULL),
(120, 12, 25, 'Boeme', 'Latium', '198', 'A happening club-bar where hot young things from the local fashion and film world check each other out over their long drinks. It can get pretty posey but the DJ grooves are often spot-on, whether it''s hard house on weekends or more eclectic tunes in the week.', '42', '12', 'http://www.boeme.it/', '', '00 39 06 8412212', 3, 0, 'A happening club-bar in the Nuovo Salario where hot young things from the local fashion and film world check each other out over their long drinks. It ...', 0, 0, 0, '', 0, '', '', '', '', '', '47184298', 'http://instagram.com/B%C3%B2eme', '', 23, 0, 1, 0, 0, 0, 'a:11:{i:0;s:6:"County";i:1;s:8:" Street2";i:2;s:9:" Category";i:3;s:11:" PriceRange";i:4;s:12:" InstagramId";i:5;s:18:" InstagramUserPage";i:6;s:13:" FoursquareId";i:7;s:19:" FoursquareUserPage";i:8;s:16:" FoursquareLikes";i:9;s:19:" FoursquareCheckIns";i:10;s:15:" FoursquareTips";}', 'a:2:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";}', 'Via Velletri Piazza Fiume', '50700358e4b075042568148b', 'https://foursquare.com/v/b%C3%B2eme/50700358e4b075042568148b', 0, 9, NULL),
(121, 9, 30, 'Amber', 'ON', 'M5r1x5', 'A happening restaurant-bar in Yorkville that''s bright and airy despite being located in a low-ceiling basement totally void of any windows. For more than a decade it’s been the place to see and be seen in Toronto, and in that time its decor has been through various guises, from minimalist to Miami South Beach, via Moroccan chic. In 2011 its latest look was revealed, with a beachy theme turning the bar and lounge into an outdoorsy-feeling space reminiscent of old Hollywood or 1950s Havanna. Turquoise art deco trims, banana leaf prints and a gleaming new bar made of Calcutta marble all combine to create a space that is warmer and more welcoming than the previous all white space. Hip Toronto artist Matt McNaught was also hired to create and edgy green graffiti mural at the entrance. And while the new interior is a breath of fresh air, in summer months drinkers tend to decamp to the alluring patio for the real thing. The place attracts an A-list crowd, particularly during Toronto International Film Festival, and the Champagne and Grey Goose is often to be found flowing freely as the DJ spins some seductive house and upbeat tunes. The cocktails are pretty spot on too, ranging from the dry classics to more colourful concoctions. Some Havana-inspired twists have also been added to the drinks menu go with the new decor. But it''s the Mexican-Mediterranean fusion food that sets the place apart, a welcome departure from the Italian/Provencal fare that''s so usual in this area. The menu includes lobster quesadilla and Moroccan Lamb chops and the owner is a Syrian. Now that''s what we call fusion.', '44', '-79', 'http://www.amberinyorkville.com/', '', '14169269037', 0, 0, 'A happening restaurant-bar in Yorkville that''s bright and airy despite being located in a low-ceiling basement totally void of any windows.', 0, 0, 0, '', 0, '', '1,7908E+14', 'https://www.facebook.com/pages/Amber/179079548804396', '', '', '242710573', 'http://instagram.com/Amber', '', 0, 2319, 0, 376, 0, 0, 'a:8:{i:0;s:6:"County";i:1;s:9:" Category";i:2;s:11:" FacebookId";i:3;s:17:" FacebookUserPage";i:4;s:12:" InstagramId";i:5;s:18:" InstagramUserPage";i:6;s:14:" FacebookLikes";i:7;s:17:" FacebookCheckins";}', 'a:4:{i:0;s:10:"PostalCode";i:1;s:8:" Street1";i:2;s:20:" GeocoordinateString";i:3;s:6:" Phone";}', '119 yorkville Ave. ', '', '', 0, 6, NULL),
(122, NULL, NULL, 'Mafia Bar', '', '', 'A hard-to-find gem in typically upscale Apku-Jong Dong where the hottest stars  can be found in the hippest bars. Wealthy Koreans and more than a few local  celebs head to Mafia although we''re talking local wiseguys, not  Gottti-style goodfellas. Dark, plush and carpeted, it''s full of smart suited  would-be criminals although regular barman Tiger is more likely to smile  and give you a beer than pull out the concrete boots.', '38', '127', '', '', '', 0, 0, 'A hard-to-find gem in typically upscale Apku-Jong Dong where the hottest stars  can be found in the hippest bars. Wealthy Koreans and more than a few ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', 'Apku-Jong Dong ', '', '', 0, 124, NULL),
(123, NULL, NULL, 'Club Paradiso', '', '47900', 'A hedonistic hot spot with gorgeous gardens and spectacular sea views where  the local jet set come to play. Located in the rolling hills of Covignano -  Rimini''s Beverly Hills - Paradiso regulars are high-flying stars from the  world of film, fashion and culture. That said, if you arrive in the right  car, wear the right suit and have the right all-over body tan, there''s no  reason you can''t join them. The multi-roomed venue includes a large central  dance floor, a quiet chill-out room with billiard tables and sofas, and,  bizarrely, a New Age lounge area where you can drink herbal teas, sample the  health products and have a massage in a smoke and alcohol-free environment.  We prefer the alcohol-fuelled areas though and suggest you sip a martini in  the main bar and watch the dance-floor crowd get frisky over pop, house,  disco, blues and funk tunes played by the house DJs. More a lifestyle choice  than a club, we guarantee you won''t want to leave Paradise.  ', '44', '13', '', 'info@paradisoclub.it', '00 39 0541 751132', 0, 0, 'A hedonistic hot spot with gorgeous gardens and spectacular sea views where  the local jet set come to play. Located in the rolling hills of Covignano ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', 'Via Covignano 260', '', '', 0, 9, NULL),
(124, NULL, NULL, 'Izumi', 'Shanghai', '', 'A Japanese-style sake bar in the heart of Shanghai, Izumi may be small, but it has a friendly, inclusive vibe that’s very appealing. Located in the former French Concession, it’s a hip and chilled spot that offers a superb array of sake and shochu based cocktails. Simply decorated with raw stone walls and the odd artfully placed plant, it has a low-key intimate feel and the staff are efficient in a laid-back kind of way. Their smooth saketini is a pleasant fusion tipple and they stock over 40 shochu varieties and 20 sakes if you want your drink unadulterated. They also serve beer if spirits aren’t your thing. Soft jazzy music provides the soundtrack to your evening and they sometimes feature live bands', '0', '0', '', '', '', 0, 0, 'A Japanese-style sake bar in the heart of Shanghai, Izumi may be small, but it has a friendly, inclusive vibe that’s very appealing. Located in the former ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '21 Yongjia Rd French Concession', '', '', 0, 54, NULL),
(125, NULL, NULL, 'The Radium Beerhall', 'Gauteng', '2192', 'A Johannesburg institution that harks back to the days of the gold rush. Located on a busy corner, the bars on the window suggest a prison, but swagger in through the swing doors and it''s a boozer''s home from home. Wooden floors, ancient teak bar and spicy Portuguese cooking make it ideal for a late lunch or long night. Your drinking partners are down-home oldsters, media types and left-leaning politicos.', '-26', '28', 'http://www.theradium.co.za/', 'mr.radium@iafrica.com', '00 27 11 728 3866', 0, 1, 'A Johannesburg institution that harks back to the days of the gold rush. Located on a busy corner, the bars on the window suggest a prison, but swagger ...', 1, 0, 0, '', 0, '', '', '', '', '', '1959003', 'http://instagram.com/Radium+Beer+Hall', '', 597, 0, 3, 0, 0, 0, 'a:12:{i:0;s:6:"County";i:1;s:11:" PostalCode";i:2;s:9:" Category";i:3;s:15:" OutdoorSeating";i:4;s:16:" PaymentAccepted";i:5;s:12:" InstagramId";i:6;s:18:" InstagramUserPage";i:7;s:13:" FoursquareId";i:8;s:19:" FoursquareUserPage";i:9;s:16:" FoursquareLikes";i:10;s:19:" FoursquareCheckIns";i:11;s:15:" FoursquareTips";}', 'a:2:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";}', '282 Louis Botha Ave. ', '4b05870ef964a520857d22e3', 'https://foursquare.com/v/the-radium-beerhall/4b05870ef964a520857d22e3', 17, 211, NULL),
(126, 9, 30, 'Laide', '', '', 'A kinkily-themed bar that''s a pun on the sexual act - and the name of the street it''s located on. Those with lascivious intentions are made for Laide. The superb drinks menu plays up the theme, with potions like the Threesome (a three-layer surprise), and the Nymphomaniac (spiced rum, peach schnapps & Malibu) falling under tall classics, short classics, martinis and champagne cocktail categories. Gorgeous single girls take places on cosy booths while boys prefer stools at the horseshoe-shaped bar which has a view of the action. The tapas menu - snow crab enchiladas', '0', '0', '', '', '', 0, 0, 'A kinkily-themed bar that''s a pun on the sexual act - and the name of the street it''s located on. Those with lascivious intentions are made for Laide. ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '138  Adelaide Street East ', '', '', 0, 6, NULL),
(127, NULL, NULL, 'Academia da Cachaca', 'RJ', '22430-200', 'A laid-back yet up-market Leblon classic specialising in North East Brazilian food and great cocktails all built from the traditional Brazilian spirit of cachaca. There are at least 500 varieties of the potion to choose from - served up either straight, as traditional Caiparinhas, or as colourful fruity concoctions by barmen who are quite clearly pass masters. Try the passion-fruit Caiparinha with real fruit floating inside - best sipped while snacking on something like a manioc croquette with cream cheese. Our kind of academy!', '-23', '-43', 'http://www.academiadacachaca.com.br/', '', '5524921159', 3, 1, 'A laid-back yet up-market Leblon classic specialising in North East Brazilian food and great cocktails all built from the traditional Brazilian spirit ...', 1, 0, 0, '', 0, 'street', '2,34973E+14', 'https://www.facebook.com/academiadacachaca', '', '', '247450591', 'http://instagram.com/Academia+da+Cacha%C3%A7a', '', 4341, 1075, 146, 5814, 0, 0, 'a:27:{i:0;s:6:"County";i:1;s:11:" PostalCode";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:5:" Mood";i:11;s:15:" OutdoorSeating";i:12;s:11:" PriceRange";i:13;s:16:" PaymentAccepted";i:14;s:19:" RestaurantServices";i:15;s:12:" ParkingType";i:16;s:11:" FacebookId";i:17;s:17:" FacebookUserPage";i:18;s:12:" InstagramId";i:19;s:18:" InstagramUserPage";i:20;s:13:" FoursquareId";i:21;s:19:" FoursquareUserPage";i:22;s:14:" FacebookLikes";i:23;s:17:" FacebookCheckins";i:24;s:16:" FoursquareLikes";i:25;s:19:" FoursquareCheckIns";i:26;s:15:" FoursquareTips";}', 'a:4:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:8:" Website";i:3;s:6:" Phone";}', 'R. Conde Bernadotte, 26 ', '4b058720f964a5202c8122e3', 'https://foursquare.com/v/academia-da-cacha%C3%A7a/4b058720f964a5202c8122e3', 123, 41, NULL),
(128, 3, 35, 'De La Ville Café', 'Île-de-France', '75010', 'A lascivious and ultra cool former 19th century bordello, now a stylish low key café by day and swanky pre-club venue at night. Actors, models and the likes of DJ Lauren Garnier clink glasses, trade air kisses and generally help make it the hot spot of the moment. Inside it''s got marble columns, distressed walls and a grand staircase, a style which suits both the afternoon tea sophisticates and the hip, younger club set who come in later when the candles light up and the music begins to glow. Staff serve delicious if pricey cheese platters and charcuterie dishes, but for your money the extra minty Mojitos are out of this world. Some village café, you will agree.', '49', '2', 'http://www.delavillecafe.com', '', '33148244809', 2, 1, 'A lascivious and ultra cool former 19th century bordello, now a stylish low key café by day and swanky pre-club venue at night. Actors, models and the ...', 1, 0, 1, '', 0, '', '3,00754E+14', 'https://www.facebook.com/pages/De-La-Ville-Caf%C3%A9/300754363367293', '', '', '267948130', 'http://instagram.com/De+La+Ville+Caf%C3%A9', '', 5969, 139, 77, 1, 0, 0, 'a:24:{i:0;s:6:"County";i:1;s:16:" MondayOpenHours";i:2;s:17:" TuesdayOpenHours";i:3;s:19:" WednesdayOpenHours";i:4;s:18:" ThursdayOpenHours";i:5;s:16:" FridayOpenHours";i:6;s:18:" SaturdayOpenHours";i:7;s:16:" SundayOpenHours";i:8;s:9:" Category";i:9;s:15:" OutdoorSeating";i:10;s:5:" Wifi";i:11;s:11:" PriceRange";i:12;s:16:" PaymentAccepted";i:13;s:11:" FacebookId";i:14;s:17:" FacebookUserPage";i:15;s:12:" InstagramId";i:16;s:18:" InstagramUserPage";i:17;s:13:" FoursquareId";i:18;s:19:" FoursquareUserPage";i:19;s:14:" FacebookLikes";i:20;s:17:" FacebookCheckins";i:21;s:16:" FoursquareLikes";i:22;s:19:" FoursquareCheckIns";i:23;s:15:" FoursquareTips";}', 'a:5:{i:0;s:7:"Country";i:1;s:8:" Street1";i:2;s:20:" GeocoordinateString";i:3;s:8:" Website";i:4;s:6:" Phone";}', '34/36 boulevard de Bonne Nouvelle ', '4adcda06f964a520a73221e3', 'https://foursquare.com/v/delaville-caf%C3%A9/4adcda06f964a520a73221e3', 96, 2, NULL),
(129, NULL, NULL, 'La Chunga', '', '6400', 'A late-night piano bar just opposite the classy Martinez. It''s equally plush  and sophisticated although in a more classic 50s new wave French film way.  You may not find J.P. Belmondo at one of the tables but movie stars from the  festival pack are in here post-midnight for music and drinks that flow until  late. Martinis are taken at dark corner tables although whiskey-sours drunk  by louche film academics seem part of the scene. Bar-staff are wise and  attentive with the confident in-control air of those who have seen it all.', '44', '7', 'http://www.lachungacannes.com', '', '33493941129', 0, 0, 'A late-night piano bar just opposite the classy Martinez. It''s equally plush  and sophisticated although in a more classic 50s new wave French film way. ...', 0, 0, 0, '', 0, '', '1,19658E+14', 'https://www.facebook.com/lachungacannes', '', '', '258242882', 'http://instagram.com/La+Chunga+Cannes', '', 0, 410, 0, 249, 0, 0, 'a:10:{i:0;s:10:"PostalCode";i:1;s:8:" Website";i:2;s:9:" Category";i:3;s:19:" RestaurantServices";i:4;s:11:" FacebookId";i:5;s:17:" FacebookUserPage";i:6;s:12:" InstagramId";i:7;s:18:" InstagramUserPage";i:8;s:14:" FacebookLikes";i:9;s:17:" FacebookCheckins";}', 'a:3:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:6:" Phone";}', 'Rue De Latour Maubourg ', '', '', 0, 2, NULL),
(130, NULL, NULL, 'La Perla', '', '47900', 'A legendary club with a reputation for attracting more than its fair share of  local beauties. Expect pricey yet powerful cocktails at the long bar, served  by stylish bar staff trying to cope with the crowd. Your fellow drinkers and  dancers are firmly from La Dolce Vita set, stylish and up-market and  possibly involved in the modelling industry. Down a vodka for courage and  request a dance from that Perla in the Versace evening dress.  ', '44', '13', 'http://caffelaperla.it/index.html', '', '00 39 0541 789 453', 0, 0, 'A legendary club with a reputation for attracting more than its fair share of  local beauties. Expect pricey yet powerful cocktails at the long bar, served ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '189  Vle Vespucci  Riccione ', '', '', 0, 9, NULL),
(131, NULL, NULL, 'Shirakaba', '', ' 606-8313', 'A legendary, yet hard-to-find gem in a residential area to the side of Yoshida  Hill, you''ll only know it by the little red door that marks the entrance.  Once a hangout for student activists of nearby Kyoto University, it used to  have twenty-four hour police surveillance. Things have calmed down now  though and if you make it out here, you''ll find a general air of drunken  joviality through the cigarette smoke. The locals are a mix of young  intellectuals and bohemian types who like to party, while the current  owner, former partner of a late student leader, holds an annual cherry  blossom party in his memory. We''ll drink to that.', '35', '136', '', '', '00 81 75 771 2388', 0, 0, 'A legendary, yet hard-to-find gem in a residential area to the side of Yoshida  Hill, you''ll only know it by the little red door that marks the entrance. ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', 'Nakaoji-cho  Yoshida yama ', '', '', 0, 117, NULL),
(132, NULL, NULL, 'Libertine', 'QLD', '4064', 'A libertine by definition defies convention. If you answer to this description, this place may well be for you. With chandeliers and gold-leaf walls, timber floors and artfully strewn cushions, the mood is by turns intimate and hedonistic. A luxurious sofa wraps around the bar and leads to an even cosier room. As the shadows of the candles flicker against the ruby red walls, it feels as if you have inadvertently entered an opium den.  The beautiful people sip cocktails in the separate lounge before taking their seats to sample chef Ryan Crawford''s French-Vietnamese fare. Rest assured that the bar staff are more than equal to the high standard set in the kitchen. Tamara''s Libertini, for example, is a delicious ode to gin with lychee and grapefruit. Small wonder then that this compelling marriage of cocktails and chopsticks has lured so many social butterflies, and one hopes it will continue to do so.', '-27', '153', 'http://www.libertine.net.au', '', '61733673353', 2, 1, 'A libertine by definition defies convention. If you answer to this description, this place may well be for you. With chandeliers and gold-leaf walls, ...', 1, 1, 0, 'foursquare.com/v/libertine-bar--restaurant/4be3bfd61dd22d7f4d7a97bd/menu', 0, 'lot', '1,3288E+14', 'https://www.facebook.com/libertine.net.au', 'libertinebris', 'https://www.twitter.com/libertinebris', '229571726', 'http://instagram.com/Libertine+Bar+and+Restaurant', '', 554, 2967, 7, 3883, 0, 0, 'a:30:{i:0;s:6:"County";i:1;s:16:" MondayOpenHours";i:2;s:17:" TuesdayOpenHours";i:3;s:19:" WednesdayOpenHours";i:4;s:18:" ThursdayOpenHours";i:5;s:16:" FridayOpenHours";i:6;s:18:" SaturdayOpenHours";i:7;s:16:" SundayOpenHours";i:8;s:9:" Category";i:9;s:15:" OutdoorSeating";i:10;s:10:" HappyHour";i:11;s:5:" Wifi";i:12;s:11:" PriceRange";i:13;s:16:" PaymentAccepted";i:14;s:19:" RestaurantServices";i:15;s:8:" MenuUrl";i:16;s:12:" ParkingType";i:17;s:11:" FacebookId";i:18;s:17:" FacebookUserPage";i:19;s:12:" TwitterName";i:20;s:16:" TwitterUserPage";i:21;s:12:" InstagramId";i:22;s:18:" InstagramUserPage";i:23;s:13:" FoursquareId";i:24;s:19:" FoursquareUserPage";i:25;s:14:" FacebookLikes";i:26;s:17:" FacebookCheckins";i:27;s:16:" FoursquareLikes";i:28;s:19:" FoursquareCheckIns";i:29;s:15:" FoursquareTips";}', 'a:6:{i:0;s:4:"City";i:1;s:11:" PostalCode";i:2;s:8:" Street1";i:3;s:8:" Street2";i:4;s:20:" GeocoordinateString";i:5;s:6:" Phone";}', 'The Barracks 61 Petrie Terrace', '4be3bfd61dd22d7f4d7a97bd', 'https://foursquare.com/v/libertine-bar--restaurant/4be3bfd61dd22d7f4d7a97bd', 15, 23, NULL),
(133, NULL, NULL, 'Blue Bar', '', '8 100 801', 'A literal blue bar not a metaphorical one, the ceilings, walls and lights in  here are all in various ocean shades that gradually wash over you like water  in waves. It''s a bit Space Odyssey trippy and the rays of blue ceiling light  add to the spacey effect. Or is that the powerful cocktails poured by the  luminous blue bar staff. Music is  ambient to trip hop and blue curacoa is a popular mixer.  ', '34', '130', '', '', '00 81 (0)92 262 2002', 0, 0, 'A literal blue bar not a metaphorical one, the ceilings, walls and lights in  here are all in various ocean shades that gradually wash over you like water ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '40362  Wakamatsu Building BFI  Nakasu ', '', '', 0, 117, NULL),
(134, NULL, NULL, 'Scheltema', '', '1012', 'A little aloof, perhaps, but this cultured bar is rather good and the bar staff know their trade. It used to be bustling with media bods, but they''ve all long gone and left a quieter, more relaxed crowd. Don''t expect a knees-up every night, just a good place to unwind in peace.', '52', '5', '', '', '31206232323', 0, 0, 'A little aloof, perhaps, but this cultured bar is rather good and the bar staff know their trade. It used to be bustling with media bods, but they''ve ...', 0, 0, 0, '', 0, '', '2,14062E+14', 'https://www.facebook.com/pages/Cafe-Scheltema/214062305276446', '', '', '', '', '', 0, 412, 0, 78, 0, 0, 'a:6:{i:0;s:10:"PostalCode";i:1;s:9:" Category";i:2;s:11:" FacebookId";i:3;s:17:" FacebookUserPage";i:4;s:14:" FacebookLikes";i:5;s:17:" FacebookCheckins";}', 'a:2:{i:0;s:19:"GeocoordinateString";i:1;s:6:" Phone";}', 'Nieuwezijds Voorburgwal 242 ', '', '', 0, 162, NULL),
(135, NULL, NULL, 'Zest ', 'North Holland', '1053 LE', 'A little bit away from the main town centre, and consequently not clogged with tourists, Zest is possibly the first and only Bulgarian bar in Amsterdam. It’s a smallish space with a few boxy benches outside on the pavement. Inside there’s a grand chandelier which is juxtaposed with more quirky and down to earth décor. There is local art on the walls and a few potted plants dotted about the place.Run by Vasil Karov and Nico Hubenov, Zest offers a range of drinks – beers, teas and a nice line in Bulgarian wines as well as a small range of cocktails. Keeps things simply and you’ll be best rewarded. The café-bar also serves a range of tapas/mezze plates as well as a number of Bulgarian-influenced dishes, including a delicious organic Bulgarian potato salad, and various Bulgarian stews, like guveche, stuffed peppers and a vegan bobchorba soup – in fact vegans and vegetarians are surprisingly well catered to here  though there are also burgers if you’d prefer. The atmosphere is laid back and welcoming and later in the evening, with local DJs behind the decks, the place has a really nice buzz about it, cool and convivial. It’s easy to see why this has quickly established itself as a favourite in this part of town.  ', '52', '5', 'http://www.zestamsterdam.nl', '', '31204129631', 2, 1, 'A little bit away from the main town centre, and consequently not clogged with tourists, Zest is possibly the first and only Bulgarian bar in Amsterdam.', 1, 0, 1, '', 0, 'street', '1,30483E+14', 'https://www.facebook.com/zest.amsterdam', '', '', '47344296', 'http://instagram.com/Zest', '', 130, 214, 8, 558, 0, 0, 'a:31:{i:0;s:6:"County";i:1;s:11:" PostalCode";i:2;s:8:" Street2";i:3;s:6:" Phone";i:4;s:16:" MondayOpenHours";i:5;s:17:" TuesdayOpenHours";i:6;s:19:" WednesdayOpenHours";i:7;s:18:" ThursdayOpenHours";i:8;s:16:" FridayOpenHours";i:9;s:18:" SaturdayOpenHours";i:10;s:16:" SundayOpenHours";i:11;s:9:" Category";i:12;s:5:" Mood";i:13;s:15:" OutdoorSeating";i:14;s:5:" Wifi";i:15;s:11:" PriceRange";i:16;s:16:" PaymentAccepted";i:17;s:19:" RestaurantServices";i:18;s:12:" ParkingType";i:19;s:16:" PublicTransport";i:20;s:11:" FacebookId";i:21;s:17:" FacebookUserPage";i:22;s:12:" InstagramId";i:23;s:18:" InstagramUserPage";i:24;s:13:" FoursquareId";i:25;s:19:" FoursquareUserPage";i:26;s:14:" FacebookLikes";i:27;s:17:" FacebookCheckins";i:28;s:16:" FoursquareLikes";i:29;s:19:" FoursquareCheckIns";i:30;s:15:" FoursquareTips";}', 'a:3:{i:0;s:7:"Country";i:1;s:20:" GeocoordinateString";i:2;s:8:" Website";}', 'Bilderdijkstraat 188 Kinkerstraat', '50674824e4b0890847912b06', 'https://foursquare.com/v/zest/50674824e4b0890847912b06', 7, 162, NULL),
(136, NULL, NULL, 'Chelsea', 'Bruxelles-Capitale', '1060', 'A little gem on Chaussée de Charleroi, this one a combo of wine bar, restaurant and cigar lounge. It''s called Chelsea but it''s of multiple themes and far from the Sloane range. The lavish interior includes Oriental carpets and antique furniture imported from Rajasthan, while the garden out back is a little nod to the English countryside. The original wine menu includes the option of a ''set'' of six wines in small glasses so you get a wide range - just think of it as liquid tapas. The menu meanwhile includes gems like caviar of vegetables. Go Chelsea!', '51', '4', 'http://www.chelsea.be', '', '+ 32 2 544 1977', 0, 0, 'A little gem on Chaussée de Charleroi, this one a combo of wine bar, restaurant and cigar lounge. It''s called Chelsea but it''s of multiple themes and ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 1, 0, 0, 0, 0, 0, 'a:7:{i:0;s:6:"County";i:1;s:9:" Category";i:2;s:13:" FoursquareId";i:3;s:19:" FoursquareUserPage";i:4;s:16:" FoursquareLikes";i:5;s:19:" FoursquareCheckIns";i:6;s:15:" FoursquareTips";}', 'a:2:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";}', 'chaussée de Charleroi 85 ', '4ade0d76f964a520b56b21e3', 'https://foursquare.com/v/chelsea/4ade0d76f964a520b56b21e3', 0, 31, NULL),
(137, NULL, NULL, 'Caliente', '', '', 'A lively classic on the Croisette and open all year which makes a change  since Cannes becomes Can''t in the winter. The theme is sultry South  Americana, with regular Latino groups playing salsa and samba until the  early hours. We particularly like the sea front terrace where tropical  cocktails from the Pina Colada to the Caiparinha are served from sunset to  sunrise. There''s space for 250 inside which is good in cooler months but if  you''re on the strong drinks and dancing up a storm, you''ll be hot inside and  out.', '44', '7', '', '', '+33 4 9394 4959', 0, 0, 'A lively classic on the Croisette and open all year which makes a change  since Cannes becomes Can''t in the winter. The theme is sultry South  Americana, ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '84  Boulevard La Croisette ', '', '', 0, 2, NULL),
(138, NULL, NULL, 'Pusser''s New York Bar', '', '80331', 'A lone European outpost for a bar born in the British Virgins Islands, the interior of Pusser’s is decorated with British naval paraphernalia from the18th and 19th centuries. As you might expect given Pusser’s provenance, the bar specializes in Caribbean-inspired cocktails. The majority of the drinks are rum-based and they pack a considerable punch. Their signature tipple is the Pusser''s Painkiller, a potent mix of rum, orange juice, coconut, pineapple, and nutmeg) or you could just make like a sailor opt for a shot of Grog. There’s a piano bar in the cellar and the bar stays open until the small hours.', '48', '12', 'http://www.pussersbar.de/', 'cocktails@pussers.info', '4989220500', 0, 0, 'A lone European outpost for a bar born in the British Virgins Islands, the interior of Pusser’s is decorated with British naval paraphernalia from the18th ...', 0, 0, 0, '', 0, '', '2,93953E+14', 'https://www.facebook.com/pages/Pussers-New-York-Bar/293953150638731', '', '', '259136584', 'http://instagram.com/Pussers+New+York+Bar', '', 0, 430, 0, 72, 0, 0, 'a:15:{i:0;s:10:"PostalCode";i:1;s:16:" MondayOpenHours";i:2;s:17:" TuesdayOpenHours";i:3;s:19:" WednesdayOpenHours";i:4;s:18:" ThursdayOpenHours";i:5;s:16:" FridayOpenHours";i:6;s:18:" SaturdayOpenHours";i:7;s:16:" SundayOpenHours";i:8;s:9:" Category";i:9;s:11:" FacebookId";i:10;s:17:" FacebookUserPage";i:11;s:12:" InstagramId";i:12;s:18:" InstagramUserPage";i:13;s:14:" FacebookLikes";i:14;s:17:" FacebookCheckins";}', 'a:3:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:6:" Phone";}', 'Falkenturmstr. 9 ', '', '', 0, 7, NULL),
(139, NULL, NULL, 'Café Commercial', '', '', 'A Madrid institution that''s seen it all since before the Civil War. On a  bustling intersection in the business district it''s ideal for a lunch or  post- work rendezvous. Inside is all heavy wooden tables and leather-lined  seats while the walls are mirrors that reflect the clientele: office workers  and artists, artisans and intellectuals, the young and the old. Alcohol is  straight up beers and spirits but why not prepare for a night on the town  with a shot of Pacharan - a fruity Spanish liqueur. Salud!  ', '40', '-4', '', '', '91 521 56 55', 0, 0, 'A Madrid institution that''s seen it all since before the Civil War. On a  bustling intersection in the business district it''s ideal for a lunch or  post- ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', 'Glorieta de Bilbao 7 ', '', '', 0, 8, NULL),
(140, NULL, NULL, 'Drift Bar in Ravesi''s', '', '', '', '0', '0', '', '', '', 0, 0, '', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', 'Campbell Pde &amp ', '', '', 0, 23, NULL),
(141, 15, 36, 'Lavo', 'NV', '89109', 'A Mediterranean theme dominates the décor at Lavo, the Venetian’s high-end restaurant and nightclub. The plaster work, tiling and the tinkling fountains are all meant to bring to mind the sun-warmed cities of Italy. Created by the team behind Tao, this is a lavish and ornate space. Huge lanterns hang over the main bar, bathing the expansive cocktail lounge in a warm glow. There’s an attractive VIP area and the view from the terrace out over the Strip is one of the best in the city. The kitchen serves well-executed, if over-fussy, Italian cuisine so you can dine in style before crossing the walkway into the throbbing club room, its dance floor crammed with honed, glamorous bodies moving to a standard Vegas mix of hip-hop and R’n’B. Girls shimmy on a series elevated platforms, drinks in hand, and the mood is vibrant, seductive and very, very Vegas.', '36', '-115', 'http://www.lavolv.com', '', '17027911800', 3, 1, 'A Mediterranean theme dominates the décor at Lavo, the Venetian’s high-end restaurant and nightclub. The plaster work, tiling and the tinkling fountains ...', 1, 0, 1, 'foursquare.com/v/lavo-italian-restaurant--nightclub/49de85bef964a52069601fe3/menu', 0, '', '38345802460', 'https://www.facebook.com/lavo', 'lavolv', 'https://www.twitter.com/lavolv', '310918', 'http://instagram.com/LAVO+Las+Vegas', '', 21738, 111788, 186, 43753, 0, 0, 'a:30:{i:0;s:6:"County";i:1;s:11:" PostalCode";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:5:" Mood";i:11;s:15:" OutdoorSeating";i:12;s:5:" Wifi";i:13;s:11:" PriceRange";i:14;s:16:" PaymentAccepted";i:15;s:19:" RestaurantServices";i:16;s:8:" MenuUrl";i:17;s:11:" FacebookId";i:18;s:17:" FacebookUserPage";i:19;s:12:" TwitterName";i:20;s:16:" TwitterUserPage";i:21;s:12:" InstagramId";i:22;s:18:" InstagramUserPage";i:23;s:13:" FoursquareId";i:24;s:19:" FoursquareUserPage";i:25;s:14:" FacebookLikes";i:26;s:17:" FacebookCheckins";i:27;s:16:" FoursquareLikes";i:28;s:19:" FoursquareCheckIns";i:29;s:15:" FoursquareTips";}', 'a:5:{i:0;s:7:"Street1";i:1;s:8:" Street2";i:2;s:20:" GeocoordinateString";i:3;s:8:" Website";i:4;s:6:" Phone";}', '3325 Las Vegas Blvd S at The Palazzo', '49de85bef964a52069601fe3', 'https://foursquare.com/v/lavo-italian-restaurant--nightclub/49de85bef964a52069601fe3', 173, 3, NULL),
(142, NULL, NULL, 'Quai des Artistes', '', '98000', '', '0', '0', '', '', '', 0, 0, 'A modern Parisian style brasserie in the most desirable spot bang on the  Monaco harbour. And it''s far more than just a brasserie', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '4 Quai Antoine 1er Quai Antoine ler  Monte Carlo', '', '', 0, 152, NULL);
INSERT INTO `wbb_semsoft_imported_bar` (`id`, `city_id`, `suburb_id`, `name`, `county`, `postal_code`, `description`, `latitude`, `longitude`, `website`, `email`, `phone`, `price`, `is_credit_card`, `seo_description`, `is_out_door_seating`, `is_happy_hour`, `is_wifi`, `menu`, `reservation`, `parking_type`, `facebook_id`, `facebook_user_page`, `twitter_name`, `twitter_user_page`, `instagram_id`, `instagram_user_page`, `google_plus_user_page`, `foursquare_check_ins`, `facebook_check_ins`, `foursquare_likes`, `facebook_likes`, `is_permanently_closed`, `business_found`, `updated_columns`, `overwritten_columns`, `address`, `foursquare_id`, `foursquare_user_page`, `foursquare_tips`, `country_id`, `bar_id`) VALUES
(143, 8, 27, 'Light Bar', 'Greater London', 'WC2N 4HX', 'A more eclectic drinkerie than this is hard to imagine: designed by Phillipe Starck, this is a bar without a bar (it''s screened off) within a trademark minimalist setting. As the name intimates, light is the focal point and the ceiling lighting of pure colour is breathtaking. This is table service only, so you''ll soon be on first name terms with your divinely dressed neighbours as you share some of the finest cocktails together, if you can get on the guest lists that is.', '52', '0', 'http://backofhouse.morganshotelgroup.com', '', '4,42073E+11', 3, 1, 'A more eclectic drinkerie than this is hard to imagine: designed by Phillipe Starck, this is a bar without a bar (it''s screened off) within a trademark ...', 0, 0, 0, '', 0, '', '65500976667', 'https://www.facebook.com/65500976667', 'morganshotels', 'https://www.twitter.com/morganshotels', '751134', 'http://instagram.com/Light+Bar', '', 610, 0, 15, 0, 0, 0, 'a:17:{i:0;s:6:"County";i:1;s:9:" Category";i:2;s:15:" OutdoorSeating";i:3;s:5:" Wifi";i:4;s:11:" PriceRange";i:5;s:16:" PaymentAccepted";i:6;s:11:" FacebookId";i:7;s:17:" FacebookUserPage";i:8;s:12:" TwitterName";i:9;s:16:" TwitterUserPage";i:10;s:12:" InstagramId";i:11;s:18:" InstagramUserPage";i:12;s:13:" FoursquareId";i:13;s:19:" FoursquareUserPage";i:14;s:16:" FoursquareLikes";i:15;s:19:" FoursquareCheckIns";i:16;s:15:" FoursquareTips";}', 'a:4:{i:0;s:7:"Street1";i:1;s:20:" GeocoordinateString";i:2;s:8:" Website";i:3;s:6:" Phone";}', '45 St. Martin''s Ln ', '4ac518bef964a52022a320e3', 'https://foursquare.com/v/light-bar/4ac518bef964a52022a320e3', 9, 4, NULL),
(144, NULL, NULL, 'Rockpool Bar and Grill', 'VIC', '3006', 'A more informal offshoot of Neil Perry’s rightly renowned Rockpool restaurant in Sydney. The Melbourne-based Bar and Grill allows you to sample Perry’s food – based on an ethos of insanely fresh produce cooked simply and well – without inflicting as much damage on your wallet (though that’s not to say it’s cheap, far from it). The Bates Smart designed room is airy and impressive. You can opt to dine in the restaurant proper - the wagyu beef is divine - or lounge in the bar, sipping top quality cocktails and perusing a menu of bar food far, far above the usual snacks and platters.  A great place to impress a date or simply to unwind after work with a superb glass of wine and an out-of-this-world burger.', '-38', '145', 'http://www.rockpool.com/melbourne/', '', '61386481900', 0, 1, 'A more informal offshoot of Neil Perry’s rightly renowned Rockpool restaurant in Sydney. The Melbourne-based Bar and Grill allows you to sample Perry’s food – based on an ethos of insanely fresh produce cooked simply and well – ', 0, 0, 0, 'foursquare.com/v/rockpool-bar--grill/4b0a16a6f964a520ae2123e3/menu', 0, '', '', '', 'rockpoolgroup', 'https://www.twitter.com/rockpoolgroup', '1967011', 'http://instagram.com/Rockpool+Bar+%26+Grill', '', 2199, 0, 53, 0, 0, 0, 'a:16:{i:0;s:6:"County";i:1;s:6:" Phone";i:2;s:9:" Category";i:3;s:15:" OutdoorSeating";i:4;s:16:" PaymentAccepted";i:5;s:19:" RestaurantServices";i:6;s:8:" MenuUrl";i:7;s:12:" TwitterName";i:8;s:16:" TwitterUserPage";i:9;s:12:" InstagramId";i:10;s:18:" InstagramUserPage";i:11;s:13:" FoursquareId";i:12;s:19:" FoursquareUserPage";i:13;s:16:" FoursquareLikes";i:14;s:19:" FoursquareCheckIns";i:15;s:15:" FoursquareTips";}', 'a:6:{i:0;s:4:"City";i:1;s:11:" PostalCode";i:2;s:8:" Street1";i:3;s:8:" Street2";i:4;s:20:" GeocoordinateString";i:5;s:8:" Website";}', '8 Whiteman St. at Crown Complex', '4b0a16a6f964a520ae2123e3', 'https://foursquare.com/v/rockpool-bar--grill/4b0a16a6f964a520ae2123e3', 55, 23, NULL),
(145, 4, 28, 'The Bar Room at the Museum of Modern Art', 'NY', '10019', '', '0', '0', '', '', '', 0, 0, 'A museum as famous as New York’s MoMA requires a suitably stylish bar and restaurant', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '9 W 53rd St Museum of Modern Art', '', '', 0, 3, NULL),
(146, NULL, NULL, 'Blue Naartjie', '', '', 'A naartjie, for those who don''t know, is a tasty South African tangerine. Head to this bar in Orange Grove suburb though and you''re more likely to be tasting fruity cocktails than simple fruit. Set in a pretty tree-lined street, the lively vibe in summer goes on until day break when the toughest "Joburg jollers" are still on the go. The interior has eccentric wall decorations and comfy furniture and your friendly fellow boozers are a mix of hard living hipsters and in-the-know tourists. With a drinks selection wide enough to suit all tastes why not take a beer, a brandy or a bourbon up to the top floor balcony and decide whether you want to stay until dawn.', '-26', '28', '', '', '270 725 277 704', 0, 0, 'A naartjie, for those who don''t know, is a tasty South African tangerine. Head to this bar in Orange Grove suburb though and you''re more likely to be ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '46 8th Street Orange Grove ', '', '', 0, 211, NULL),
(147, 17, 26, 'American Junkie', 'IL', '60654', 'A new addition to a burgeoning mini chain of West Coast-based eateries, the River North branch of American Junkie seems determined to set itself apart from its siblings. The venue is attempting to mark itself out in more ways than one. This is a far more upmarket affair than its predecessors – to let people know it’s more than just a big noisy sports bar where people have a propensity to dance on the tables - with a food menu that’s chef driven and seasonal, featuring dishes like a double decker burger - made with LaFrieda beef from New York – and smoked pork shoulder. The cocktail programme echoes that sense of repositioning, with a decent array of drinks that will please the masses while also keeping the purists happy. Fresh juices and fresh, seasonal berries play a big part in the mixed drinks, while they also stock some on-trend kegged cocktails, which are set to change seasonally. It’s a vast, sprawling space, spread over two floors, which seats around 320 in all and proudly boasts “one of the Midwest’s largest high-definition TV screens” in addition to a retractable roof for nights when the weather is warmer and a ‘descending DJ booth’ for nights when you want to hit the dance floor  - after your chef-driven, seasonal dinner and quality cocktails, that is.', '42', '-88', 'http://www.americanjunkiechi.com', '', '13122390995', 3, 1, 'A new addition to a burgeoning mini chain of West Coast-based eateries, the River North branch of American Junkie seems determined to set itself apart from its siblings.', 1, 0, 1, 'foursquare.com/v/american-junkie/51327549e4b0f53f8fcf31b7/menu', 0, 'street,valet', '1,3246E+14', 'https://www.facebook.com/chicagojunkie', 'atticatjunkie', 'https://www.twitter.com/atticatjunkie', '71761266', 'http://instagram.com/American+Junkie+Chicago', '', 39, 37412, 4, 7627, 0, 0, 'a:32:{i:0;s:6:"County";i:1;s:8:" Street2";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:5:" Mood";i:11;s:15:" OutdoorSeating";i:12;s:5:" Wifi";i:13;s:11:" PriceRange";i:14;s:16:" PaymentAccepted";i:15;s:19:" RestaurantServices";i:16;s:8:" MenuUrl";i:17;s:12:" ParkingType";i:18;s:16:" PublicTransport";i:19;s:11:" FacebookId";i:20;s:17:" FacebookUserPage";i:21;s:12:" TwitterName";i:22;s:16:" TwitterUserPage";i:23;s:12:" InstagramId";i:24;s:18:" InstagramUserPage";i:25;s:13:" FoursquareId";i:26;s:19:" FoursquareUserPage";i:27;s:14:" FacebookLikes";i:28;s:17:" FacebookCheckins";i:29;s:16:" FoursquareLikes";i:30;s:19:" FoursquareCheckIns";i:31;s:15:" FoursquareTips";}', 'a:5:{i:0;s:10:"PostalCode";i:1;s:8:" Street1";i:2;s:20:" GeocoordinateString";i:3;s:8:" Website";i:4;s:6:" Phone";}', '15 W Illinois St Fl 2 N State St', '528180be11d2f33611d3c384', 'https://foursquare.com/v/attic-at-american-junkie/528180be11d2f33611d3c384', 0, 3, NULL),
(148, NULL, NULL, 'Sp!r!t', '', 'M1 3EZ', 'A new and ultra stylish addition to the Canal Street posse, the seductively curved glass frontage houses a three-floored restaurant and bar, where brickwork and bare floors dominate. Struggle not to slip off the designer stools whilst watching the elegant eaters and succulent sippers on the floors below.', '53', '-2', '', '', '1 612 379 725', 0, 0, 'A new and ultra stylish addition to the Canal Street posse, the seductively curved glass frontage houses a three-floored restaurant and bar, where brickwork ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '10  Canal Street ', '', '', 0, 4, NULL),
(149, NULL, NULL, 'The Apartment', 'Wellington', '6011', 'A New York loft-style lounge bar, located in the heart of Courtney Place, The Apartment is a seriously stylish spot, open for breakfast and coffee by day while also offering a cracking range of cocktails in the evening. Inside it’s airy and open, but with defined areas for dining and drinking. The décor is contemporary and urban, lots of bare brick and soft brown leather, sculptural light fittings, a dramatic wooden bookcase (complete with grandfather clock) which bisects the space and a roaring fireplace which beckons temptingly on cold nights. The cocktail list features all the classics and has a definite New York leaning: Manhattans, Old Fashioneds, and the like, More contemporary creation include a Gingerbread Martini, a sweet, fruity Apricot Squeeze, the punchy, chili-laced Sofrito, the blueberry-packed West Hampton and for those with seriously sweet teeth, a Jaffa Cake Martini and, gulp, a Werther’s Original Martini.  There’s a substantial wine list and a decent food menu too. More sophisticated than some places on the strip, it has a relaxed but stylish atmosphere and has something to offer both those popping in to unwind after work and those out to make an evening of it. ', '-41', '175', 'http://www.theapartment.co.nz/', '', '6443859771', 2, 1, 'A New York loft-style lounge bar, located in the heart of Courtney Place, The Apartment is a seriously stylish spot, open for breakfast and coffee by day while also offering a cracking range of cocktails in the evening. Inside it’s airy and open, but with defined areas for dining and drinking.', 1, 1, 0, '', 0, 'street', '1,75114E+14', 'https://www.facebook.com/theapartmentbarwgtn', '', '', '416565', 'http://instagram.com/The+Apartment', '', 743, 3847, 4, 2189, 0, 0, 'a:29:{i:0;s:6:"County";i:1;s:8:" Website";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:5:" Mood";i:11;s:15:" OutdoorSeating";i:12;s:10:" HappyHour";i:13;s:11:" PriceRange";i:14;s:16:" PaymentAccepted";i:15;s:19:" RestaurantServices";i:16;s:12:" ParkingType";i:17;s:16:" PublicTransport";i:18;s:11:" FacebookId";i:19;s:17:" FacebookUserPage";i:20;s:12:" InstagramId";i:21;s:18:" InstagramUserPage";i:22;s:13:" FoursquareId";i:23;s:19:" FoursquareUserPage";i:24;s:14:" FacebookLikes";i:25;s:17:" FacebookCheckins";i:26;s:16:" FoursquareLikes";i:27;s:19:" FoursquareCheckIns";i:28;s:15:" FoursquareTips";}', 'a:3:{i:0;s:7:"Country";i:1;s:20:" GeocoordinateString";i:2;s:6:" Phone";}', '25 Allen St Te Aro ', '4bf5c3da92d1952153a6591f', 'https://foursquare.com/v/the-apartment-wellington/4bf5c3da92d1952153a6591f', 4, 164, NULL),
(150, NULL, NULL, 'Ba Bar Seattle', 'WA', '98122', 'A newly expanded bar area, late night hours, and a refined cocktail menu are waiting for you at Ba Bar. Open morning, noon and night, this Vietnamese eatery on Capitol Hill serves up delicious coffee, house made pastries, steaming bowls of pho, and creative cocktails. Happy Hour starts at 3pm daily with a cocktail menu full of unique libations. The Saigon Julep with apple brandy, basil, and sugar cane syrup will refresh you on warm days, while the Hung Hero made with gold rum, Benedictine, black pepper syrup, and lime will kick-start your senses. The bar is airy and bright with large windows, steel and wood furniture, and a big screen TV for Friday night Kung Fu movies. If your singing improves while drinking, don’t miss Wednesday night karaoke which features over 18,000 songs in English and Vietnamese.-- (Photography by Geoffrey Smith)--(Facebook-https://www.facebook.com/babarseattle    )--(Twitter-@BaBarSeattle)', '48', '-122', 'http://babarseattle.com', '', '12063282030', 2, 1, 'A newly expanded bar area, late night hours, and a refined cocktail menu are waiting for you at Ba Bar.', 0, 0, 0, 'foursquare.com/v/ba-bar/4dbdc9c36a23e294ba4e3ee8/menu', 0, '', '1,33646E+14', 'https://www.facebook.com/133646373371124', 'babarseattle', 'https://www.twitter.com/babarseattle', '3016008', 'http://instagram.com/Ba+Bar', '', 5088, 0, 89, 0, 0, 0, 'a:26:{i:0;s:10:"PostalCode";i:1;s:8:" Street2";i:2;s:16:" MondayOpenHours";i:3;s:17:" TuesdayOpenHours";i:4;s:19:" WednesdayOpenHours";i:5;s:18:" ThursdayOpenHours";i:6;s:16:" FridayOpenHours";i:7;s:18:" SaturdayOpenHours";i:8;s:16:" SundayOpenHours";i:9;s:9:" Category";i:10;s:15:" OutdoorSeating";i:11;s:11:" PriceRange";i:12;s:16:" PaymentAccepted";i:13;s:19:" RestaurantServices";i:14;s:8:" MenuUrl";i:15;s:11:" FacebookId";i:16;s:17:" FacebookUserPage";i:17;s:12:" TwitterName";i:18;s:16:" TwitterUserPage";i:19;s:12:" InstagramId";i:20;s:18:" InstagramUserPage";i:21;s:13:" FoursquareId";i:22;s:19:" FoursquareUserPage";i:23;s:16:" FoursquareLikes";i:24;s:19:" FoursquareCheckIns";i:25;s:15:" FoursquareTips";}', 'a:6:{i:0;s:7:"Country";i:1;s:7:" County";i:2;s:8:" Street1";i:3;s:20:" GeocoordinateString";i:4;s:8:" Website";i:5;s:6:" Phone";}', '550 12th Ave at E Barclay St', '4dbdc9c36a23e294ba4e3ee8', 'https://foursquare.com/v/ba-bar/4dbdc9c36a23e294ba4e3ee8', 54, 3, NULL),
(151, NULL, NULL, 'Parkside Bar', '', '160', '‘Music, whisky and life’ says the sign outside the fashionable Parkside Bar and we can’t say fairer than that. Though we might add food and wine to the list, both of which the Parkside does well. The bar stocks a wide range of wine, serves an array of classic cocktails as well a few contemporary drinks, and boasts a particularly strong selection of scotch, bourbon and whiskey. The bar tenders know their stuff an the drinks list features classic American cocktails like the Negroni, the Aviation, the Sidecar, the Clover Club and the Manhattan as well as a few modern house creations, like the Tearroir, a delicate green matcha-based cocktail which is beautifully presented - a drunk to savour. The food menu is international in influence, mixing traditional noodle dishes with pizza and sandwiches.  The design of the space is stylish and urban, lots of wood, chrome and old stone, with a stage area on one side of the room. Live music is a big part of this place’s appeal. Every Friday night is classic jazz night and there’s live music most weekends. Come early as it gets pretty busy when there’s a band playing.', '25', '122', '', '', '+886 2 8772 6508', 0, 0, '‘Music, whisky and life’ says the sign outside the fashionable Parkside Bar and we can’t say fairer than that. Though we might add food and wine to the list, both of which the Parkside does well.', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', 'Yanji Street 131 Lane 24 B1', '', '', 0, NULL, NULL),
(152, 8, 27, 'Terroirs', 'Greater London', 'WC2N 4DW', '''Natural'' wines are the order of the day at Terroirs. It''s a loose term, but essentially that means wines made from organic grapes as well as those made with no added sugar or sulphur or any of the other extras that sneak in during the wine-making process. This is all well and good but would count for nowt were the wines not top notch. Fortunately they are and the list is thick with varieties the average quaffer may not have heard of. The food is excellent too. They serve inventive French-inspired dishes, well-sourced charcuterie and a wide range of artisanal cheeses - the perfect accompaniment to glass of something earthy and unusual. The upstairs bar is white-walled and informal with the main focus on tasty things to eat and imbibe', '0', '0', '', '', '', 0, 0, '''Natural'' wines are the order of the day at Terroirs. It''s a loose term, but essentially that means wines made from organic grapes as well as those made ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '5 William IV St Strand', '', '', 0, 4, NULL),
(153, 13, 24, 'Casablanca Lounge', '', '', 'A beach bar in the heart of Berlin? Given the changeable nature of the German weather, that might seem folly itself, but that’s what Casablanca Lounge is aiming to be. To this end there are soft yellow walls, several potted palms dotted about the room and a whole load of sand on the floor (yep, that’s right, actual sand, the stuff that gets in your shoes and sandwiches). Flip-flops are practically de rigeur here – those who like to be a bit dressier on their nights out might find the whole thing slightly tiresome. But while it may not be the most stylish spot in the city, it is huge fun: a lively spot for a post-work drink. A longish cocktail menu covers all the bases, including an unusually big selection of cachaca-based drinks, and they serve a decent selection of beers. There are daily changing promotions where particular types of drink are on offer (eg, Becks day, highball days, etc) as well as a generous happy hour that’s sure to please those who want to drink on a budget. It’s also open during the day, so you can enjoy a cool drink or a coffee beneath the swaying palms (OK, they don’t really sway, but we’re just going with the flow). While you’re never going to forget that you’re in an urban bar – a theme bar no less – there’s something about it that’s appealingly kitschy if you go in the right state of mind. So sit back and sip your Mai Tai and pretend you’re somewhere sunny and ocean adjacent. ', '53', '13', 'http://www.casablancalounge.de/', '', '+49 30 44706862', 0, 0, 'A beach bar in the heart of Berlin? Given the changeable nature of the German weather, that might seem folly itself, but that’s what Casablanca Lounge is aiming to be. ', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', 'Waldeyerstraße 9 10247 Berlin ', '', '', 0, 7, NULL),
(154, NULL, NULL, 'Zorro', '', '47900', 'A bright and cheerful summer club that you don''t have to wear a mask to  despite the name. This is the North Riviera and you can once again expect to  see the beautiful people, but the regulars here are younger and more  laid-back than the ultra-rich jet-set crowd you get at Byblos and Paradiso.  The theme is South American - DJs play house mixed with samba and salsa, and  the drinks range from vodka shots and beers to Mojitos and Caiparoskas. A  perfect late night spot after an early-evening drink on the water.    ', '44', '13', '', '', '00 39 0544988214', 0, 0, 'A bright and cheerful summer club that you don''t have to wear a mask to  despite the name. This is the North Riviera and you can once again expect to ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '81  Via Tritone  Pinarella di Cervia ', '', '', 0, 9, NULL),
(155, NULL, NULL, 'Cork Tree', '', 'CA 92260', 'A bustling bar and a smart dining room combine in Cork Tree to form one appealing destination. Owned by veteran restaurateurs Joaquin and Sharon Delgado and Ray and Kathi Rodriguez, this place knows what it''s doing. The wine list is Californian in focus and impressively extensive', '0', '0', '', '', '', 0, 0, 'A bustling bar and a smart dining room combine in Cork Tree to form one appealing destination. Owned by veteran restaurateurs Joaquin and Sharon Delgado ...', 0, 0, 0, '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 'a:1:{i:0;s:0:"";}', 'a:1:{i:0;s:0:"";}', '74950 Country Club Drive ', '', '', 0, 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `wbb_session`
--

CREATE TABLE IF NOT EXISTS `wbb_session` (
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `session_value` longtext COLLATE utf8_unicode_ci NOT NULL,
  `session_time` int(11) NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `wbb_session`
--

INSERT INTO `wbb_session` (`session_id`, `session_value`, `session_time`) VALUES
('4kemv5i0i78q37ccvh6i620jj0', 'X3NmMl9hdHRyaWJ1dGVzfGE6NTp7czo4OiJjaXR5U2x1ZyI7czo5OiJNYXJyYWtlc2giO3M6MTI6InVzZXJMYXRpdHVkZSI7czoxODoiMzEuNjMzMzMyOTk5OTk5OTk3IjtzOjEzOiJ1c2VyTG9uZ2l0dWRlIjtzOjI6Ii04IjtzOjI3OiJfc2VjdXJpdHkuYWRtaW4udGFyZ2V0X3BhdGgiO3M6MzI6Imh0dHA6Ly93YmIuZGV2L2FwcF9kZXYucGhwL2FkbWluIjtzOjE4OiJfY3NyZi9yZWdpc3RyYXRpb24iO3M6NDM6IjBGQVRMTVJ3U1g2VmxmQVZfcTJTQ1U5RVZBXzNkMWdHRk9yQXFJb3piMDQiO31fc2YyX2ZsYXNoZXN8YTowOnt9X3NmMl9tZXRhfGE6Mzp7czoxOiJ1IjtpOjE0MDQ3Mjg2NjU7czoxOiJjIjtpOjE0MDQ3MjIyMjA7czoxOiJsIjtzOjE6IjAiO30=', 1404728666),
('4u3l2m1dhf7e9lhb9klb69ie92', 'X3NmMl9hdHRyaWJ1dGVzfGE6MTp7czoyNzoiX3NlY3VyaXR5LmFkbWluLnRhcmdldF9wYXRoIjtzOjMyOiJodHRwOi8vd2JiLmRldi9hcHBfZGV2LnBocC9hZG1pbiI7fV9zZjJfZmxhc2hlc3xhOjA6e31fc2YyX21ldGF8YTozOntzOjE6InUiO2k6MTQwNTA2OTM1MztzOjE6ImMiO2k6MTQwNTA2OTM1MztzOjE6ImwiO3M6MToiMCI7fQ==', 1405069353),
('5af79d3ar86cpns69l0k53ceo2', 'X3NmMl9hdHRyaWJ1dGVzfGE6NTp7czo4OiJjaXR5U2x1ZyI7czo5OiJNYXJyYWtlc2giO3M6MTI6InVzZXJMYXRpdHVkZSI7czoxODoiMzEuNjMzMzMyOTk5OTk5OTk3IjtzOjEzOiJ1c2VyTG9uZ2l0dWRlIjtzOjI6Ii04IjtzOjE4OiJfY3NyZi9yZWdpc3RyYXRpb24iO3M6NDM6IlBqNk1NQ0w1QXh5R0hRZl9TeW5uVm9OOVFobnBjd3pGWGZQVVFiSTNxZnciO3M6MTg6Il9jc3JmL2F1dGhlbnRpY2F0ZSI7czo0MzoiQmd5NHlXZHFWSEcxX1A3WFFrMW13SVRIV1hDTm9KRkJtNldQOWhXZVVwNCI7fV9zZjJfZmxhc2hlc3xhOjA6e31fc2YyX21ldGF8YTozOntzOjE6InUiO2k6MTQwNDgyNTk2MTtzOjE6ImMiO2k6MTQwNDgxMjExMjtzOjE6ImwiO3M6MToiMCI7fQ==', 1404825962),
('6ij0t0bhtua9b7n2qm162295l4', 'X3NmMl9hdHRyaWJ1dGVzfGE6OTp7czoxMjoidXNlckxhdGl0dWRlIjtzOjA6IiI7czoxMzoidXNlckxvbmdpdHVkZSI7czowOiIiO3M6ODoiY2l0eVNsdWciO3M6MDoiIjtzOjE4OiJfY3NyZi9yZWdpc3RyYXRpb24iO3M6NDM6IjN1MFNjZ0U3cjRRM01GcjhLRnpuQVpJNEdxcXhZOUhjQ0R1WktpWEkta00iO3M6MTg6Il9jc3JmL2F1dGhlbnRpY2F0ZSI7czo0MzoiUFY3Zm1rSVBUdEhobkZyZk9DczdiSGlIZnh6TzhvRmszQVpES3RKSC1YbyI7czo3OiJmcm9tR2VvIjtiOjE7czoyNzoiX3NlY3VyaXR5LmFkbWluLnRhcmdldF9wYXRoIjtzOjMyOiJodHRwOi8vd2JiLmRldi9hcHBfZGV2LnBocC9hZG1pbiI7czoxNDoiX3NlY3VyaXR5X3VzZXIiO3M6NjkyOiJDOjc0OiJTeW1mb255XENvbXBvbmVudFxTZWN1cml0eVxDb3JlXEF1dGhlbnRpY2F0aW9uXFRva2VuXFVzZXJuYW1lUGFzc3dvcmRUb2tlbiI6NjA0OnthOjM6e2k6MDtOO2k6MTtzOjU6ImFkbWluIjtpOjI7czo1NjM6ImE6NDp7aTowO0M6MjY6IldCQlxVc2VyQnVuZGxlXEVudGl0eVxVc2VyIjoyMjE6e2E6OTp7aTowO3M6ODg6ImJhdndqRmV1RFBtTjhqTTBZZU5LcENRZlNBZWxrT2NMZVV6ek13eU12V1l3N3pCRUpVVm1QeXhsVXZYYUo0M1RaMDJPNFQ0eFM3eGhpbDZwRlVCcWRnPT0iO2k6MTtzOjMxOiJhb3Axemw4dDMxY2d3czhrazAwNDQ0dzA0MGtvczAwIjtpOjI7czo1OiJhZG1pbiI7aTozO3M6NToiYWRtaW4iO2k6NDtiOjA7aTo1O2I6MDtpOjY7YjowO2k6NztiOjE7aTo4O2k6MTt9fWk6MTtiOjE7aToyO2E6Mjp7aTowO086NDE6IlN5bWZvbnlcQ29tcG9uZW50XFNlY3VyaXR5XENvcmVcUm9sZVxSb2xlIjoxOntzOjQ3OiIAU3ltZm9ueVxDb21wb25lbnRcU2VjdXJpdHlcQ29yZVxSb2xlXFJvbGUAcm9sZSI7czoxNjoiUk9MRV9TVVBFUl9BRE1JTiI7fWk6MTtPOjQxOiJTeW1mb255XENvbXBvbmVudFxTZWN1cml0eVxDb3JlXFJvbGVcUm9sZSI6MTp7czo0NzoiAFN5bWZvbnlcQ29tcG9uZW50XFNlY3VyaXR5XENvcmVcUm9sZVxSb2xlAHJvbGUiO3M6OToiUk9MRV9VU0VSIjt9fWk6MzthOjA6e319Ijt9fSI7czoxODoiX2NzcmYvc29uYXRhLmJhdGNoIjtzOjQzOiI1ZGZYak11VW1KU2hHSVpaNXpCdUdOVFp2bzNZZU82dmNLUzNvUGpsMGFZIjt9X3NmMl9mbGFzaGVzfGE6MDp7fV9zZjJfbWV0YXxhOjM6e3M6MToidSI7aToxNDA1MTY2NzQzO3M6MToiYyI7aToxNDA1MDk3MzI1O3M6MToibCI7czoxOiIwIjt9', 1405166743),
('8f848m14ad67ka9djog9dcurk3', 'X3NmMl9hdHRyaWJ1dGVzfGE6NTp7czo4OiJjaXR5U2x1ZyI7czowOiIiO3M6MTg6Il9jc3JmL3JlZ2lzdHJhdGlvbiI7czo0MzoiMXZac1ljaGd3T3Z5NjdLSEdmQTVWRVNXcjYxWjZhM1pqUkZ6VjVQdmpyYyI7czoxMjoidXNlckxhdGl0dWRlIjtzOjE4OiIzMS42MzMzMzI5OTk5OTk5OTciO3M6MTM6InVzZXJMb25naXR1ZGUiO3M6MjoiLTgiO3M6Mjc6Il9zZWN1cml0eS5hZG1pbi50YXJnZXRfcGF0aCI7czozMjoiaHR0cDovL3diYi5kZXYvYXBwX2Rldi5waHAvYWRtaW4iO31fc2YyX2ZsYXNoZXN8YTowOnt9X3NmMl9tZXRhfGE6Mzp7czoxOiJ1IjtpOjE0MDQ4OTE1NDc7czoxOiJjIjtpOjE0MDQ4MjYwMDQ7czoxOiJsIjtzOjE6IjAiO30=', 1404891548),
('9ubp9psk6ae2ppu41s76kkdlg1', 'X3NmMl9hdHRyaWJ1dGVzfGE6NDg6e3M6Mjc6Il9zZWN1cml0eS5hZG1pbi50YXJnZXRfcGF0aCI7czozMjoiaHR0cDovL3diYi5kZXYvYXBwX2Rldi5waHAvYWRtaW4iO3M6MTQ6Il9zZWN1cml0eV91c2VyIjtzOjY5MjoiQzo3NDoiU3ltZm9ueVxDb21wb25lbnRcU2VjdXJpdHlcQ29yZVxBdXRoZW50aWNhdGlvblxUb2tlblxVc2VybmFtZVBhc3N3b3JkVG9rZW4iOjYwNDp7YTozOntpOjA7TjtpOjE7czo1OiJhZG1pbiI7aToyO3M6NTYzOiJhOjQ6e2k6MDtDOjI2OiJXQkJcVXNlckJ1bmRsZVxFbnRpdHlcVXNlciI6MjIxOnthOjk6e2k6MDtzOjg4OiJiYXZ3akZldURQbU44ak0wWWVOS3BDUWZTQWVsa09jTGVVenpNd3lNdldZdzd6QkVKVVZtUHl4bFV2WGFKNDNUWjAyTzRUNHhTN3hoaWw2cEZVQnFkZz09IjtpOjE7czozMToiYW9wMXpsOHQzMWNnd3M4a2swMDQ0NHcwNDBrb3MwMCI7aToyO3M6NToiYWRtaW4iO2k6MztzOjU6ImFkbWluIjtpOjQ7YjowO2k6NTtiOjA7aTo2O2I6MDtpOjc7YjoxO2k6ODtpOjE7fX1pOjE7YjoxO2k6MjthOjI6e2k6MDtPOjQxOiJTeW1mb255XENvbXBvbmVudFxTZWN1cml0eVxDb3JlXFJvbGVcUm9sZSI6MTp7czo0NzoiAFN5bWZvbnlcQ29tcG9uZW50XFNlY3VyaXR5XENvcmVcUm9sZVxSb2xlAHJvbGUiO3M6MTY6IlJPTEVfU1VQRVJfQURNSU4iO31pOjE7Tzo0MToiU3ltZm9ueVxDb21wb25lbnRcU2VjdXJpdHlcQ29yZVxSb2xlXFJvbGUiOjE6e3M6NDc6IgBTeW1mb255XENvbXBvbmVudFxTZWN1cml0eVxDb3JlXFJvbGVcUm9sZQByb2xlIjtzOjk6IlJPTEVfVVNFUiI7fX1pOjM7YTowOnt9fSI7fX0iO3M6MjA6Il9jc3JmL3M1M2JmYTg3YTBkNTU0IjtzOjQzOiJEZ1Y0UlR4WWNVNzZ5NTBFb2hoV205bTA4TFg0elNVVDA3VmVLRlp3QkRBIjtzOjIwOiJfY3NyZi9zNTNiZmFiMWVjZTVmNCI7czo0MzoibllXNmJQS3d4dnZfZWlJYWdMR0VJdllVUWJaTFN5aFV1U3haZHZ6SW8yVSI7czoyMDoiX2NzcmYvczUzYmZhZGFjMGQ2OTUiO3M6NDM6IjhackdaTVltYW13SEo5ZVJtQWFHM3FZc1IzQ18tckFQd21ucGphem05MlUiO3M6MTg6Il9jc3JmL3NvbmF0YS5iYXRjaCI7czo0MzoiY0JDc3Z1ak1KTDM5RkZ0YVo0MVN2NDNYXy1aNXdwT2sxRDRySUEyanRPUSI7czoyMDoiX2NzcmYvczUzYmZhZGJmYTAwMzkiO3M6NDM6Ii00RUlOR2NkTnVpSnZHOTJMQ3pBM0x6NF9kcldhbGpTUDVsa29YUjgzYmciO3M6MjA6Il9jc3JmL3M1M2JmYWRjOWUzY2JiIjtzOjQzOiJWaXR0SzJGTUxtU0FFNm51Qi1PYjFNM3FZOGpOR0FwMmJkcVZhQmVIbFJvIjtzOjIwOiJfY3NyZi9zNTNiZmFkZDI0NzU3ZCI7czo0Mzoidlg5eUc1OG1jZ004UVVHWjUwX0p4SVdiMmQycTFRYmhYQ045bm5samNJSSI7czoyMDoiX2NzcmYvczUzYmZhZGRlYTRjY2QiO3M6NDM6ImRRQ1FXa0NpN1VKSkw0UlBkWk5LRVhqT0pRZnlnUC1IWUt4eG9TTFpzNmsiO3M6MjA6Il9jc3JmL3M1M2JmYWU1MTRiOTQzIjtzOjQzOiJ5N1o1VnZkNFpjZTlBSm1ZemxCZVp1NDZNMG5jZjFIU0lYUXFySXk1SGlnIjtzOjIwOiJfY3NyZi9zNTNiZmIxMjA1NDM1YyI7czo0MzoiWkxkclB1eHNkWE9fR1U5S0oxTmgwNDJESHZvS1JhVVNmcTdDT2JGVTRtOCI7czoyMDoiX2NzcmYvczUzYmZiMWI2ZTE5NzAiO3M6NDM6Im5HTzRKNHZLN0w1VnFPVDlPWjM5aTlmblhscm9fUTBIaGVUMWJZQlZfUkkiO3M6MjA6Il9jc3JmL3M1M2JmYjIyOWNiNzNmIjtzOjQzOiJtZ0QwQ2ltLUVGckpRMUhWNVZXSndqbV85enRBLWJuNi14ZDBORmtmRUJNIjtzOjIwOiJfY3NyZi9zNTNiZmIyMzI1OGNjNiI7czo0Mzoiall2WmpmSTVoNkFxaVB3eDdoMFhRRUFPdTBnOFRhOWVubTIxMnRrRmZwayI7czoyMDoiX2NzcmYvczUzYmZiMjQzNWY2OTkiO3M6NDM6ImREWXI5dnVmRmRRNFRkOG11NVBZZHhmN3JDY2pOU2NKUWp5dTE2eGFhSE0iO3M6MjA6Il9jc3JmL3M1M2JmYjI3ZDcyMTRkIjtzOjQzOiJCWVFHdnNMNlE5bTZXOGxBSlpPTll5TU9YRk1xOEp3dFpmdFh0RXU1YTlrIjtzOjIwOiJfY3NyZi9zNTNiZmI0ZTUyMDA4ZSI7czo0Mzoiazl4VTlLZzdsTEk5OE9ubmgwNG5FeGNVTEFTYkUwVmhkZVdhV05pMndLcyI7czoxMjoidXNlckxhdGl0dWRlIjtzOjE4OiIzMS42MzMzMzI5OTk5OTk5OTciO3M6MTM6InVzZXJMb25naXR1ZGUiO3M6MjoiLTgiO3M6ODoiY2l0eVNsdWciO3M6MDoiIjtzOjIwOiJfY3NyZi9zNTNiZmI1MWZlNmY2NyI7czo0MzoiX1M5N2toVW1FVlhtUWU4blJhUmRMUXhUNWpXaHZsNmJtVmpxeTdzOUZlRSI7czoyMDoiX2NzcmYvczUzYmZiNTQxNzUyZjMiO3M6NDM6IldnVUJmU0dRTU90MmlCMFN0VDFCc2ZueGR6Mmg3Ykl0Tk5MLXlIUXBvSkkiO3M6MjA6Il9jc3JmL3M1M2JmYjYwZGE4MTljIjtzOjQzOiJQYXd4eng2aTZQXzlWZExqVm1KS0RtUXhEbDBHSHlWcmVJSXFBRG1SNWI4IjtzOjIwOiJfY3NyZi9zNTNiZmI2MjNjMzU4NSI7czo0MzoiNWVNd3RiX0dkNHlTakQxU3RkVHF3VEx3MTZScXNCRXVPMFpqWUQ0RmtHNCI7czoyMDoiX2NzcmYvczUzYmZiNjMzN2Y3ZDQiO3M6NDM6IjN1aXBhbkpMX0pKNVFwX1ExZFZaTTlUT0JzRk55VXlxdm5oVmVvU3BTdDgiO3M6MjA6Il9jc3JmL3M1M2JmYjYzYmFmNDgzIjtzOjQzOiJpYlp2djk0eGQwamhhN2ZsZXl1eFd0US1uNER1RjRKanRIVnZTS1ljWjRRIjtzOjIwOiJfY3NyZi9zNTNiZmI2NDI5MWY4YyI7czo0MzoiLTJSWFBaSGFOTElLdlpuM2trWThUVlVFbE1yaHBLRFRhRXVxWnRLNTVKTSI7czoyMDoiX2NzcmYvczUzYmZiNjRhMGQ4M2UiO3M6NDM6Ikl6QmJTVmFWWDRiVUZJTENFTzRsbHhaVUpacEZ1SHBXWUtBY3RBREZKeGciO3M6MjA6Il9jc3JmL3M1M2JmYmJmNTk1Yzk5IjtzOjQzOiJSVk1RN2lTY2ZCU0p4NmdqWEVvb3g1dF81cHVnZTZpUjZPRkpSOVFVTGU4IjtzOjIwOiJfY3NyZi9zNTNiZmMwMGI5NTc4YiI7czo0Mzoib3V2ZFMtaGpsZDhJU1JndFg4YmJ2cndOcTdrOEZ3N0pIOGFvbE11R1ljNCI7czoyMDoiX2NzcmYvczUzYmZjMDUzOTVhNmUiO3M6NDM6IkFqeWtFTEQ3SHBiOEtZX0MwMGZPV2FRNHlXdFlITXdzajBmRFdsZWhYSzgiO3M6MjA6Il9jc3JmL3M1M2JmYzA2MDBkM2U4IjtzOjQzOiI1TWttajZXM2NZSU5ZVHo3Vmt1c0lmcnBjOUFzMDRiUnNMMUxabnhsQmpzIjtzOjIwOiJfY3NyZi9zNTNiZmMxNTQ0MGI3YyI7czo0MzoiaGJZemNKNTFlZlpBbzRkSHY3c1dObFpCUVU4VGxLNHZPeFNsalNGNUI3ZyI7czoyMDoiX2NzcmYvczUzYmZjMTc0ODJlY2YiO3M6NDM6IlctNjZfZElxUHhZYkprTGlQdWRwTzV0eUNLUTNLUWp5MUlpbWtGUjRkSGsiO3M6MjA6Il9jc3JmL3M1M2JmYzE5YWM0MDUxIjtzOjQzOiJiVEJFa19VaXlQMmVFMWhmbzlDYV84cFBmY0l4OUwzRUxCRS1peFM1LV9vIjtzOjIwOiJfY3NyZi9zNTNiZmNmZWMyMWQzOCI7czo0MzoiSVh0THAwUkNHMjUxNVpjbDBIS3BXYklCTXFrYkpmSEQ1eDd4U3RqZzNnOCI7czoyMDoiX2NzcmYvczUzYmZjZmY5MzM5MjkiO3M6NDM6IkRmUmxSMDVlT3VOMnhQWGFBcUYzeGpvdWZuZG9qVVZvS2J0NU4zWVRJc0EiO3M6MjA6Il9jc3JmL3M1M2JmZDBmOWFjZGVlIjtzOjQzOiIwaFR5enVKNk9oV0lvb3RSWU1QVnBQbE9OOE1qRFV1bkd4UGc0RkN5RUQwIjtzOjIwOiJfY3NyZi9zNTNiZmQxMGNlYzRiMiI7czo0MzoiME45R3Y0UWJac0RxYUVhdjZ3ZnpSUWNsM3kxMnkyWTRpdTVmNHhyM0s0TSI7czoyMDoiX2NzcmYvczUzYmZkMTM4MGU4NjciO3M6NDM6IlZnZkV5cFdQRWN6aTFHeWFYMjU5djNDbVRqLWpuNHd2eS1jUXRNZXRlUHciO3M6MjA6Il9jc3JmL3M1M2JmZDE2MzYxNWMzIjtzOjQzOiJxelpDbWYyaGlMMUNibXlZOTRFYUNHamIzSWJ3Sm1FdEE2ZVptV2tnNmE0IjtzOjE4OiJfY3NyZi9yZWdpc3RyYXRpb24iO3M6NDM6IllCWTByNXJ6ZzVMSExnSDZvOXBfYTBNUzFYRl9FOWpQQXM5UlB5TFI3cVUiO3M6MTg6Il9jc3JmL2F1dGhlbnRpY2F0ZSI7czo0MzoiUFA1b0t5dzJySUpQWTlmYkhDZGpmUExOTmp6Tm1OZHFpenBQMldFdHlxVSI7czoyMDoiX2NzcmYvczUzYzAwYWVkMmU5NWUiO3M6NDM6IkN4YmRyQm5SOHFlbWRwRWtRSUw1dFdnOWVLenhHd3BDLS1GNXpyc3RmcGsiO3M6MjA6Il9jc3JmL3M1M2MwMGFlZTJkZGFlIjtzOjQzOiJFQ2JKV3hFcmI4RDhIbGNKUlBjUXNjejdWTzI2YjJuTnJaMUsyUGZXMmg4IjtzOjIwOiJfY3NyZi9zNTNjMDBlNGI2MzhjZSI7czo0MzoiS1lVYjA2VEhQV3VfZXVCUUZDVTZ4ZEJXN2N1aVBrM3FHenpOVFAzUE5xUSI7czoyMDoiX2NzcmYvczUzYzAwZTRmNjRjMjAiO3M6NDM6IkQyNkMyYkZkT1h3TWdzUnphSV9OVXNoOXVfdHNCeENBamRfV3kyN1RweXciO31fc2YyX2ZsYXNoZXN8YTowOnt9X3NmMl9tZXRhfGE6Mzp7czoxOiJ1IjtpOjE0MDUwOTY3NDE7czoxOiJjIjtpOjE0MDUwNjkzNTM7czoxOiJsIjtzOjE6IjAiO30=', 1405096742),
('btoafd4ocus46g05phu73uq8r7', 'X3NmMl9hdHRyaWJ1dGVzfGE6Nzp7czoxMjoidXNlckxhdGl0dWRlIjtzOjA6IiI7czoxMzoidXNlckxvbmdpdHVkZSI7czowOiIiO3M6ODoiY2l0eVNsdWciO3M6MDoiIjtzOjE4OiJfY3NyZi9yZWdpc3RyYXRpb24iO3M6NDM6IjN1MFNjZ0U3cjRRM01GcjhLRnpuQVpJNEdxcXhZOUhjQ0R1WktpWEkta00iO3M6MTg6Il9jc3JmL2F1dGhlbnRpY2F0ZSI7czo0MzoiUFY3Zm1rSVBUdEhobkZyZk9DczdiSGlIZnh6TzhvRmszQVpES3RKSC1YbyI7czo3OiJmcm9tR2VvIjtiOjE7czoyNzoiX3NlY3VyaXR5LmFkbWluLnRhcmdldF9wYXRoIjtzOjMyOiJodHRwOi8vd2JiLmRldi9hcHBfZGV2LnBocC9hZG1pbiI7fV9zZjJfZmxhc2hlc3xhOjA6e31fc2YyX21ldGF8YTozOntzOjE6InUiO2k6MTQwNTE2MzY2NjtzOjE6ImMiO2k6MTQwNTA5NzMyNTtzOjE6ImwiO3M6MToiMCI7fQ==', 1405163666),
('lcr6fmmss9vuf53joijhj44e57', 'X3NmMl9hdHRyaWJ1dGVzfGE6Mjp7czo4OiJjaXR5U2x1ZyI7czowOiIiO3M6MTg6Il9jc3JmL2F1dGhlbnRpY2F0ZSI7czo0MzoiYnFKNVhKZnRvX3M0MTA3bXJ1MHhXQVV1bUpvd2JpMlhzamVEbUZHWE1xTSI7fV9zZjJfZmxhc2hlc3xhOjA6e31fc2YyX21ldGF8YTozOntzOjE6InUiO2k6MTQwNDcyODc3NztzOjE6ImMiO2k6MTQwNDcyODc2OTtzOjE6ImwiO3M6MToiMCI7fQ==', 1404728778),
('lsb0lr4ddr0eicsiv9bib1cmr6', 'X3NmMl9hdHRyaWJ1dGVzfGE6NDc6e3M6ODoiY2l0eVNsdWciO3M6MDoiIjtzOjE4OiJfY3NyZi9yZWdpc3RyYXRpb24iO3M6NDM6IjF2WnNZY2hnd092eTY3S0hHZkE1VkVTV3I2MVo2YTNaalJGelY1UHZqcmMiO3M6MTI6InVzZXJMYXRpdHVkZSI7czoxODoiMzEuNjMzMzMyOTk5OTk5OTk3IjtzOjEzOiJ1c2VyTG9uZ2l0dWRlIjtzOjI6Ii04IjtzOjI3OiJfc2VjdXJpdHkuYWRtaW4udGFyZ2V0X3BhdGgiO3M6MzI6Imh0dHA6Ly93YmIuZGV2L2FwcF9kZXYucGhwL2FkbWluIjtzOjE0OiJfc2VjdXJpdHlfdXNlciI7czo2OTI6IkM6NzQ6IlN5bWZvbnlcQ29tcG9uZW50XFNlY3VyaXR5XENvcmVcQXV0aGVudGljYXRpb25cVG9rZW5cVXNlcm5hbWVQYXNzd29yZFRva2VuIjo2MDQ6e2E6Mzp7aTowO047aToxO3M6NToiYWRtaW4iO2k6MjtzOjU2MzoiYTo0OntpOjA7QzoyNjoiV0JCXFVzZXJCdW5kbGVcRW50aXR5XFVzZXIiOjIyMTp7YTo5OntpOjA7czo4ODoiYmF2d2pGZXVEUG1OOGpNMFllTktwQ1FmU0FlbGtPY0xlVXp6TXd5TXZXWXc3ekJFSlVWbVB5eGxVdlhhSjQzVFowMk80VDR4Uzd4aGlsNnBGVUJxZGc9PSI7aToxO3M6MzE6ImFvcDF6bDh0MzFjZ3dzOGtrMDA0NDR3MDQwa29zMDAiO2k6MjtzOjU6ImFkbWluIjtpOjM7czo1OiJhZG1pbiI7aTo0O2I6MDtpOjU7YjowO2k6NjtiOjA7aTo3O2I6MTtpOjg7aToxO319aToxO2I6MTtpOjI7YToyOntpOjA7Tzo0MToiU3ltZm9ueVxDb21wb25lbnRcU2VjdXJpdHlcQ29yZVxSb2xlXFJvbGUiOjE6e3M6NDc6IgBTeW1mb255XENvbXBvbmVudFxTZWN1cml0eVxDb3JlXFJvbGVcUm9sZQByb2xlIjtzOjE2OiJST0xFX1NVUEVSX0FETUlOIjt9aToxO086NDE6IlN5bWZvbnlcQ29tcG9uZW50XFNlY3VyaXR5XENvcmVcUm9sZVxSb2xlIjoxOntzOjQ3OiIAU3ltZm9ueVxDb21wb25lbnRcU2VjdXJpdHlcQ29yZVxSb2xlXFJvbGUAcm9sZSI7czo5OiJST0xFX1VTRVIiO319aTozO2E6MDp7fX0iO319IjtzOjIwOiJfY3NyZi9zNTNiY2YxY2VkYzZkYyI7czo0MzoiX045WXluZVdVUFF6YmpsZGRneFlMbVJjWlNOaFVxTUphSHFNbnI2T0RKbyI7czoyMDoiX2NzcmYvczUzYmNmMWQwY2U2Y2EiO3M6NDM6Im9EU3NhMjAwamhSZXZPSXIzVFJTdjZGdExrempTUEZDeE9qM1BkNEZPWlUiO3M6MTg6Il9jc3JmL3NvbmF0YS5iYXRjaCI7czo0MzoiUWpJVy1Za3Q1dFZqSU84SVNvVzNRZGVFWGZXQUhXV2NFclNwVy1BX09FZyI7czoyMDoiX2NzcmYvczUzYmQzMWFjNGUzMmYiO3M6NDM6Inl0eHRFUnIxSnoxcmp6RUg2TENMYkNpYjZLY0RMVEgtSHNIWUg2WjFyXzAiO3M6MjA6Il9jc3JmL3M1M2JkNDdhOTk3NDcwIjtzOjQzOiJ5S2NxTzROYkU2aGVFakdSeE1YXy1MNWE2UmNBY0VpRFJ2UEtONVRhTDlvIjtzOjIwOiJfY3NyZi9zNTNiZDQ3YWI1YjFmOCI7czo0MzoiazBsSVJwSnpJNHBDeFJ2Zm5xT1ExZ0ptWXVBVHdIbnp3RTJkbWlhQmZuNCI7czoyMDoiX2NzcmYvczUzYmQ1NDNmY2YzNmYiO3M6NDM6IkZwS0cwbFdiek8zRUZ6MzYxVVhpdUVyZF9CVUNjalZRVlRMRnVaTFZOYWMiO3M6MjA6Il9jc3JmL3M1M2JkNTQ0MDJjYWEzIjtzOjQzOiJ5cnd0QzUway01UWlGNnRERTVwMEN2YmR2M0tJa2dtSi1DUkVNbXBESmFJIjtzOjIwOiJfY3NyZi9zNTNiZTYxMzI2MzBhOCI7czo0Mzoib0hXRUZ6OUVIejlFcFZocjlRdGR5MUdxbWhMblYxV0FWOVA5amJiNmJPVSI7czoyMDoiX2NzcmYvczUzYmU2MTNiZWYxODkiO3M6NDM6ImNiRVhzT3dMXy1IRWJ4VVFzNWpoQlVneVh6UFFVazZnNE1pdEo2cXF5ZEkiO3M6MjA6Il9jc3JmL3M1M2JlNjQzYTcxN2NkIjtzOjQzOiJ6RjdhdVlmSzBDUVhqaTl0eTBIVHNadkpFdG9rNlNjTHB2UTJHZzVidWJVIjtzOjIwOiJfY3NyZi9zNTNiZTdhMThhZGE3NyI7czo0MzoiYk9FUnRYZm80dXNxSUtrWmNVb1RWN3ljQmJSUnBWb0wxTE5reHAtV2lfcyI7czoyMDoiX2NzcmYvczUzYmU3YTIwMGY0ZmUiO3M6NDM6IjNsRnozNVJiSndCcWUzTlRmalpfM1ZtQ1hlQnVCa0NaV3Z6cHlNa3JoVmMiO3M6MjA6Il9jc3JmL3M1M2JlN2E3NmNlY2FkIjtzOjQzOiJMTk1yelY3dHN1WlIxQUN3UE9vQnVxNWNza3JzMEk3Xy12WElxN3FrR0FZIjtzOjIwOiJfY3NyZi9zNTNiZTdhN2I4MDI0NSI7czo0MzoiZlhYalk2X2VWdEQ2VGlVaF9PSGJkOFZkVXlRLXZBRzNXSjEwejRGQUs0QSI7czoyMDoiX2NzcmYvczUzYmU3Y2MyM2YwOGIiO3M6NDM6IkpWR0pqOUtfWndsOHJUd1U0X0VweHV6SWxfeGY3OXliRXEwdXJHanRnYmsiO3M6MjA6Il9jc3JmL3M1M2JlN2Q2MTE4NDBjIjtzOjQzOiJPSzZ1MjZnajFNNkpvakswSGYzU1BjQkd5Q1VKcHdiY1JCZW1UMDd4NHVrIjtzOjIwOiJfY3NyZi9zNTNiZTgyYTc0ZjQ0NSI7czo0MzoiMTdrZlRzWjhXcVY1RURNSGxzbHZxcWFmdEZyUWNnVHFyaE9lMC1IbUVaTSI7czoyMDoiX2NzcmYvczUzYmU4MzVmZjI1ZDYiO3M6NDM6IjdwMzVzSzhTZnVlSlVvZU40T2hONkthLTRyR25GREtRYzBQT2V6TkxsbnMiO3M6MjA6Il9jc3JmL3M1M2JlODM5MzU4ZGQ3IjtzOjQzOiJhMlNEaUJWcC1LUWNVa1RJMUNIc0YzUkVjNUtOSWpwQ0VUUElFeUQ0UkdNIjtzOjIwOiJfY3NyZi9zNTNiZTgzOTkyMjdlMSI7czo0MzoibHlEQTk0cnVhX1RKVWlCcmRJcXJLbU9zNEx6X0I3M2oza2Myel9HMHlrSSI7czoyMDoiX2NzcmYvczUzYmU4MzlmOGE2Y2IiO3M6NDM6Ijctdkp0UXpjZG5YLWg2Y2VZSWlZanFMai02X1FXVW1oYW9BNWpzRG9lalEiO3M6MjA6Il9jc3JmL3M1M2JlODNhMGUyMGQ2IjtzOjQzOiI2b1VTeUFQQ01HeGRwdWRmNHlDV1cyR2Zlc2NBbmxlakk4SmZ0TkJlWEVFIjtzOjIwOiJfY3NyZi9zNTNiZTgzYTFkNWVlZCI7czo0MzoidVBTck4yZHN6WWRxYXRVYVRDMl9VM3hOZUlmWmlwakd4YzdjRDNFVjBWYyI7czoyMDoiX2NzcmYvczUzYmU4M2E0NDg5NmUiO3M6NDM6IkJicUgxME0zdUE0T0tldUdHLURPV0JqcHNJOG5DUHo4U1dNVTh4akltSzQiO3M6MjA6Il9jc3JmL3M1M2JlODNhMzRhNGI3IjtzOjQzOiI0YTVJWUI5My1Hb0RMbUZ3b1p4UXhYcy16dHM2NURkY1hGMDVhcFJaTDBVIjtzOjIwOiJfY3NyZi9zNTNiZTgzY2YwZjg1ZiI7czo0MzoiZ2xON2JJTjVBYU5MU05uQTBSam1CTnVESFFNNG5DeTk3RnFqVzR2d3RnNCI7czoyMDoiX2NzcmYvczUzYmU4NDU0NGRiYjkiO3M6NDM6IjQzd0duckdkcXhtSHNvUlNTYmdMZ3BrMDF2RVRNVUdiTFJNVjRfNkNXTk0iO3M6MjA6Il9jc3JmL3M1M2JlODU2OGM1ODE1IjtzOjQzOiJXOHVIbTFSc1JmbWxDUng4OHhEV2FBVkt5Z0V5aENRcnBTOWRaa0J4M2lRIjtzOjIwOiJfY3NyZi9zNTNiZTg1NmI1NmU4NyI7czo0MzoiU1Uyb2duYV9VX1lVZ0hQNmZBcEl1Nld5Z2RKcS1zYThMeC0tX1puZ0ZKVSI7czoyMDoiX2NzcmYvczUzYmU4NTZkYTFjM2YiO3M6NDM6ImpoTDJ0d3dRSFphQm9DZmJiT0Nmd1hRUzVzWXEzazF6b1UxWmVXamNvRlkiO3M6MjA6Il9jc3JmL3M1M2JlODU3MGNiODk3IjtzOjQzOiJURElJNjZ4cFVydkJwSUUwY0JCMHRPby0wWXhremN4c0lRb3g3RlUtWWRJIjtzOjIwOiJfY3NyZi9zNTNiZTg1YWU4NmY5ZCI7czo0MzoiblpobHNUZF9XQnpZeW95R1dueXQ2ZUMzQkZMSVNnUHFQQk1jWFFHOW1XNCI7czoyMDoiX2NzcmYvczUzYmVhYjBkNDQ2NGYiO3M6NDM6InA1SmVic0kwNmd5S1dKdEY0bzAtaVJmeUgwX09KYm9makpSU1p6WmhMRjAiO3M6MjA6Il9jc3JmL3M1M2JlYWI5OTBmNTU0IjtzOjQzOiJkNlotaktlVWxrY3ktWDBlMklKNEZhV25PZElwR0RaUTRaMHBlRGNscWZvIjtzOjIwOiJfY3NyZi9zNTNiZWFiOTk3OGQ3YyI7czo0MzoiWVA0T1NfdGpRUlV4aVlXRVN5bEtEaEhqUmh1Q1FUY0NQZ2otWXBSbFg2cyI7czoyMDoiX2NzcmYvczUzYmViOGE5ZWFkMGIiO3M6NDM6IlZIRkc4OVB1RldHZjJFNmFreDl0WS1QdTlsZGY1VTU5RTM3WEMxUkE3cWciO3M6MjA6Il9jc3JmL3M1M2JlYmNhYjI3NGQxIjtzOjQzOiJzYXp4T2JGaGEzT2l1Q1oxZkQtMHE1bGI1Z2M2a3hqZDN5bmRMQXROME44IjtzOjIwOiJfY3NyZi9zNTNiZWJlNDAxODBiYSI7czo0MzoiaGVoc3lhMXpsaEFLQW1Mei1ZY3NwSjFSYWRIUXhmSGNCZ1I3VTY0NEV1VSI7czoyMDoiX2NzcmYvczUzYmViZTk5OGE4ZWMiO3M6NDM6ImNSdUJFT25pMlk1dWpidVdxZHZtaXhFUE9maWJ1bDZHQXVqeWlVOUh0NmMiO3M6MjA6Il9jc3JmL3M1M2JlYzE3N2JjNTkyIjtzOjQzOiJmQS1zRndrcjFqeEJBUkJsYURKaEFDQXowa0ZSSUlZUXNUUkNyV1ZESTJzIjt9X3NmMl9mbGFzaGVzfGE6MDp7fV9zZjJfbWV0YXxhOjM6e3M6MToidSI7aToxNDA1MDExNDU5O3M6MToiYyI7aToxNDA0ODI2MDA0O3M6MToibCI7czoxOiIwIjt9', 1405011460),
('nqh67o2k9sfioni6g902ql15j5', 'X3NmMl9hdHRyaWJ1dGVzfGE6NTp7czo4OiJjaXR5U2x1ZyI7czowOiIiO3M6MTI6InVzZXJMYXRpdHVkZSI7czoxODoiMzEuNjMzMzMyOTk5OTk5OTk3IjtzOjEzOiJ1c2VyTG9uZ2l0dWRlIjtzOjI6Ii04IjtzOjI2OiJfc2VjdXJpdHkubWFpbi50YXJnZXRfcGF0aCI7czozNToiaHR0cDovL3diYi5kZXYvYXBwX2Rldi5waHAvcHJvZmlsZS8iO3M6MTg6Il9jc3JmL2F1dGhlbnRpY2F0ZSI7czo0MzoiZXdMajY5TVQzbHFzS1JqNndIUHo2MXZ2M0JRSEkwLWMwNm82Z1J5akpSdyI7fV9zZjJfZmxhc2hlc3xhOjA6e31fc2YyX21ldGF8YTozOntzOjE6InUiO2k6MTQwNDczNTQxNTtzOjE6ImMiO2k6MTQwNDcyODgzMTtzOjE6ImwiO3M6MToiMCI7fQ==', 1404735419),
('qkmjn41qdeh4405bp9g2ogmp53', 'X3NmMl9hdHRyaWJ1dGVzfGE6MTI6e3M6ODoiY2l0eVNsdWciO3M6MDoiIjtzOjEyOiJ1c2VyTGF0aXR1ZGUiO3M6MTg6IjMxLjYzMzMzMjk5OTk5OTk5NyI7czoxMzoidXNlckxvbmdpdHVkZSI7czoyOiItOCI7czoyNjoiX3NlY3VyaXR5Lm1haW4udGFyZ2V0X3BhdGgiO3M6MzU6Imh0dHA6Ly93YmIuZGV2L2FwcF9kZXYucGhwL3Byb2ZpbGUvIjtzOjE4OiJfY3NyZi9hdXRoZW50aWNhdGUiO3M6NDM6ImV3TGo2OU1UM2xxc0tSajZ3SFB6NjF2djNCUUhJMC1jMDZvNmdSeWpKUnciO3M6MTQ6Il9zZWN1cml0eV91c2VyIjtzOjY5MjoiQzo3NDoiU3ltZm9ueVxDb21wb25lbnRcU2VjdXJpdHlcQ29yZVxBdXRoZW50aWNhdGlvblxUb2tlblxVc2VybmFtZVBhc3N3b3JkVG9rZW4iOjYwNDp7YTozOntpOjA7TjtpOjE7czo1OiJhZG1pbiI7aToyO3M6NTYzOiJhOjQ6e2k6MDtDOjI2OiJXQkJcVXNlckJ1bmRsZVxFbnRpdHlcVXNlciI6MjIxOnthOjk6e2k6MDtzOjg4OiJiYXZ3akZldURQbU44ak0wWWVOS3BDUWZTQWVsa09jTGVVenpNd3lNdldZdzd6QkVKVVZtUHl4bFV2WGFKNDNUWjAyTzRUNHhTN3hoaWw2cEZVQnFkZz09IjtpOjE7czozMToiYW9wMXpsOHQzMWNnd3M4a2swMDQ0NHcwNDBrb3MwMCI7aToyO3M6NToiYWRtaW4iO2k6MztzOjU6ImFkbWluIjtpOjQ7YjowO2k6NTtiOjA7aTo2O2I6MDtpOjc7YjoxO2k6ODtpOjE7fX1pOjE7YjoxO2k6MjthOjI6e2k6MDtPOjQxOiJTeW1mb255XENvbXBvbmVudFxTZWN1cml0eVxDb3JlXFJvbGVcUm9sZSI6MTp7czo0NzoiAFN5bWZvbnlcQ29tcG9uZW50XFNlY3VyaXR5XENvcmVcUm9sZVxSb2xlAHJvbGUiO3M6MTY6IlJPTEVfU1VQRVJfQURNSU4iO31pOjE7Tzo0MToiU3ltZm9ueVxDb21wb25lbnRcU2VjdXJpdHlcQ29yZVxSb2xlXFJvbGUiOjE6e3M6NDc6IgBTeW1mb255XENvbXBvbmVudFxTZWN1cml0eVxDb3JlXFJvbGVcUm9sZQByb2xlIjtzOjk6IlJPTEVfVVNFUiI7fX1pOjM7YTowOnt9fSI7fX0iO3M6MTg6Il9jc3JmL3NvbmF0YS5iYXRjaCI7czo0MzoiOFB5UU4wNFVyaUFha2doVl9qa0VzWE1kSDJzbkkyZ3ZFV0dBTHBJbEdWbyI7czoyMDoiX2NzcmYvczUzYmE5MzQ1ZDg5NzkiO3M6NDM6ImtnOFRPLVVWeWdMZ2dpZ2FpVVJFMHU5a3QxNEROZmQ2OUdOMnhOaUxPSjQiO3M6MjA6Il9jc3JmL3M1M2JhOTM0ZThiYzA3IjtzOjQzOiJNNldTT3U0TXRfeW1kMWlud005TDVxM0dDR25SdUh2R1B0OU9NdDlFZmcwIjtzOjIwOiJfY3NyZi9zNTNiYTkzNmVkYTgxYSI7czo0MzoiRTFMVmFkZHZDN3ZNNFFqQVdGRDUxemNGRU1NTDhJWEkyV0w4cUs4MzF5byI7czoyMDoiX2NzcmYvczUzYmE5Mzc1YWMyNGEiO3M6NDM6ImVrdzF4YmxycWw5LXpaQWlKWXRPRVlKRjNBcURTUlZiSUZhYzR1ajlPUUkiO3M6MTg6Il9jc3JmL3JlZ2lzdHJhdGlvbiI7czo0MzoiM3lvRUdoVXZTSzFaMlR2a25XNktNQnNvZjBjbkpDdlAxeG1GRWtmcVdIOCI7fV9zZjJfZmxhc2hlc3xhOjA6e31fc2YyX21ldGF8YTozOntzOjE6InUiO2k6MTQwNDgxMDcyNztzOjE6ImMiO2k6MTQwNDcyODgzMTtzOjE6ImwiO3M6MToiMCI7fQ==', 1404810727),
('qpabqu5vkb8758ber7fhtuuh32', 'X3NmMl9hdHRyaWJ1dGVzfGE6NTp7czo4OiJjaXR5U2x1ZyI7czowOiIiO3M6MTI6InVzZXJMYXRpdHVkZSI7czoxODoiMzEuNjMzMzMyOTk5OTk5OTk3IjtzOjEzOiJ1c2VyTG9uZ2l0dWRlIjtzOjI6Ii04IjtzOjI2OiJfc2VjdXJpdHkubWFpbi50YXJnZXRfcGF0aCI7czozNToiaHR0cDovL3diYi5kZXYvYXBwX2Rldi5waHAvcHJvZmlsZS8iO3M6MTg6Il9jc3JmL2F1dGhlbnRpY2F0ZSI7czo0MzoiWmxiQlc3YVJ6amFMZ2cwN2ZsVERKbl9uQlBjWVUwN2VnVmF3M3BiOThCOCI7fV9zZjJfZmxhc2hlc3xhOjA6e31fc2YyX21ldGF8YTozOntzOjE6InUiO2k6MTQwNDcyODgxMjtzOjE6ImMiO2k6MTQwNDcyODgwMDtzOjE6ImwiO3M6MToiMCI7fQ==', 1404728812),
('tc06v5f0j45jkqa5pqkjukvmu5', 'X3NmMl9hdHRyaWJ1dGVzfGE6MTp7czoyNzoiX3NlY3VyaXR5LmFkbWluLnRhcmdldF9wYXRoIjtzOjMyOiJodHRwOi8vd2JiLmRldi9hcHBfZGV2LnBocC9hZG1pbiI7fV9zZjJfZmxhc2hlc3xhOjA6e31fc2YyX21ldGF8YTozOntzOjE6InUiO2k6MTQwNTA2OTM1NDtzOjE6ImMiO2k6MTQwNTA2OTM1MztzOjE6ImwiO3M6MToiMCI7fQ==', 1405069354);

-- --------------------------------------------------------

--
-- Structure de la table `wbb_tag`
--

CREATE TABLE IF NOT EXISTS `wbb_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `on_top` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7DCBCAC28BAC62AF` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Contenu de la table `wbb_tag`
--

INSERT INTO `wbb_tag` (`id`, `city_id`, `name`, `on_top`, `created_at`, `updated_at`, `type`) VALUES
(1, NULL, 'Friendly', 1, '2014-06-05 14:37:15', '2014-07-10 12:35:22', '1'),
(2, NULL, 'Classy', 0, '2014-06-05 14:37:46', '2014-07-10 13:14:19', '2'),
(3, NULL, 'V.I.P', 1, '2014-06-05 14:42:21', '2014-07-10 13:14:42', '1'),
(4, NULL, 'Disco', 1, '2014-06-05 14:42:50', '2014-07-10 13:14:46', '2'),
(5, NULL, 'Luxury', 1, '2014-06-08 11:48:19', '2014-07-10 13:14:53', '6'),
(6, NULL, 'Romance', 1, '2014-06-08 12:29:21', '2014-07-10 13:15:10', '4'),
(7, NULL, 'test', 1, '2014-06-28 21:53:54', '2014-07-10 13:15:07', '4'),
(8, NULL, 'Party', 1, '2014-07-11 10:26:33', '2014-07-11 10:26:33', '5'),
(9, NULL, 'Chillout', 1, '2014-07-11 10:26:41', '2014-07-11 10:26:41', '5'),
(10, NULL, 'Casual', 1, '2014-07-11 10:26:49', '2014-07-11 10:26:49', '5');

-- --------------------------------------------------------

--
-- Structure de la table `wbb_tip`
--

CREATE TABLE IF NOT EXISTS `wbb_tip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `bar_id` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `status` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_36C1C50DA76ED395` (`user_id`),
  KEY `IDX_36C1C50D89A253A` (`bar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=323 ;

--
-- Contenu de la table `wbb_tip`
--

INSERT INTO `wbb_tip` (`id`, `user_id`, `bar_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', 2, '2014-06-05 20:39:29', '2014-06-11 15:09:07'),
(2, 1, 8, 'This place is awesome', 0, '2014-06-08 13:09:54', '2014-06-08 13:27:21'),
(4, 1, 1, '2', 0, '2014-06-10 07:35:56', '2014-06-11 05:44:08'),
(5, 1, 1, '3', 0, '2014-06-10 07:44:15', '2014-06-11 05:44:15'),
(6, 1, 3, 'xxcwccxc xcwc', 0, '2014-06-10 08:19:32', '2014-06-10 08:19:32'),
(7, 1, 3, 'Duis lobortis massa imperdiet quam. Cras risus ipsum, faucibus ut, ullamcorper id, varius ac, leo. Curabitur a felis in nunc fringilla tristique. Morbi vestibulum volutpat enim. Sed lectustpat nibh, nec pellentesque velit pede quis nunc.\r\n\r\nMaecenas egestas arcu quis ligula mattis placerat. Mauris sollicitudin fermentum libero. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent metus tellus, elementum eu, semper a, adipiscing nec, purus. Etiam feugiat lorem non metus.', 0, '2014-06-10 08:22:00', '2014-06-10 08:22:00'),
(8, 1, 1, '4', 0, '2014-06-10 11:37:11', '2014-06-11 05:44:24'),
(9, 1, 1, '5', 0, '2014-06-10 11:40:31', '2014-06-11 05:44:29'),
(10, 1, 1, '6', 0, '2014-06-10 12:21:06', '2014-06-11 05:44:34'),
(11, 1, 1, '7', 0, '2014-06-10 12:27:13', '2014-06-11 05:44:42'),
(12, 1, 1, '8', 0, '2014-06-10 12:28:23', '2014-06-11 05:45:01'),
(13, 1, 1, '9', 0, '2014-06-10 12:28:55', '2014-06-11 05:45:15'),
(14, 1, 1, '10', 0, '2014-06-10 12:29:54', '2014-06-11 05:45:32'),
(15, 1, 1, '11', 0, '2014-06-10 12:36:42', '2014-06-11 05:45:46'),
(16, 1, 1, '12', 0, '2014-06-10 12:38:10', '2014-06-11 05:45:56'),
(17, 1, 1, '13', 0, '2014-06-10 12:38:28', '2014-06-11 05:46:08'),
(18, 1, 1, '14', 0, '2014-06-10 12:42:03', '2014-06-11 05:46:14'),
(19, 1, 1, '15', 0, '2014-06-10 12:42:21', '2014-06-11 05:46:21'),
(20, 1, 1, '16', 0, '2014-06-10 12:42:45', '2014-06-11 05:46:29'),
(21, 1, 1, '17', 0, '2014-06-10 12:43:55', '2014-06-11 05:46:45'),
(22, 1, 1, '18', 0, '2014-06-10 12:44:10', '2014-06-11 05:46:52'),
(23, 1, 1, '19', 0, '2014-06-10 12:47:34', '2014-06-11 05:47:00'),
(24, 1, 1, '20', 0, '2014-06-10 12:50:22', '2014-06-11 05:47:07'),
(25, 1, 1, '21', 0, '2014-06-10 12:52:47', '2014-06-11 05:47:15'),
(26, 1, 1, '22', 0, '2014-06-10 12:52:55', '2014-06-11 05:47:21'),
(31, 1, 4, 'T1', 0, '2014-06-11 02:19:21', '2014-06-11 05:40:43'),
(32, 1, 4, 'T2', 0, '2014-06-11 02:26:27', '2014-06-11 05:40:24'),
(33, 1, 4, 'T3', 0, '2014-06-11 02:43:39', '2014-06-11 05:40:33'),
(37, 1, 4, 'T4', 0, '2014-06-11 02:48:15', '2014-06-11 05:40:51'),
(38, 1, 4, 'T5', 0, '2014-06-11 02:48:16', '2014-06-11 05:40:57'),
(39, 1, 9, 'jjgh', 0, '2014-06-11 11:07:52', '2014-06-11 11:07:52'),
(43, 1, 9, 'test 2', 0, '2014-06-11 11:10:11', '2014-06-11 11:10:11'),
(44, 1, 9, 'test 3', 0, '2014-06-11 11:12:06', '2014-06-11 11:12:06'),
(45, 1, 1, '0', 0, '2014-06-11 11:21:40', '2014-06-11 11:21:40'),
(46, 1, 1, '24', 0, '2014-06-11 11:49:25', '2014-06-11 11:49:25'),
(51, 1, 3, 'sdfdfsdfdf', 1, '2014-06-12 17:03:36', '2014-06-12 17:03:36'),
(52, 1, 3, 'sdfdfsdfdf', 1, '2014-06-12 17:03:37', '2014-06-12 17:03:37'),
(53, 1, 3, 'sdfsdfsdf', 1, '2014-06-12 17:03:42', '2014-06-12 17:03:42'),
(54, 1, 3, 'sdsqfdsfqsdfdsf', 1, '2014-06-12 17:07:19', '2014-06-12 17:07:19'),
(55, 1, 3, 'ssssssss', 1, '2014-06-12 17:07:25', '2014-06-12 17:07:25'),
(56, 1, 3, 'aaaa', 1, '2014-06-12 17:08:05', '2014-06-12 17:08:05'),
(75, 1, 9, 'test 1', 1, '2014-06-16 16:09:32', '2014-06-16 16:09:32'),
(90, 1, 1, NULL, 1, '2014-06-16 16:33:15', '2014-06-16 16:47:16'),
(139, 1, 12, 'test 123', 1, '2014-06-16 18:20:27', '2014-06-16 18:20:27'),
(141, 1, 12, 'test 1234', 1, '2014-06-16 18:20:35', '2014-06-16 18:20:35'),
(220, 1, 13, 'test', 1, '2014-06-17 12:20:16', '2014-06-17 12:20:16'),
(221, 1, 13, 'love it', 1, '2014-06-17 12:20:24', '2014-06-17 12:20:24'),
(222, 1, 13, 'really top', 1, '2014-06-17 12:20:37', '2014-06-17 12:20:37'),
(281, 1, 12, 'Test Mehdi', 1, '2014-06-19 17:48:52', '2014-06-19 17:48:52'),
(282, 1, 19, 'ssqdf', 1, '2014-06-20 16:41:27', '2014-06-20 16:41:27'),
(283, 1, 19, 'sqdfqsdf', 1, '2014-06-20 16:41:29', '2014-06-20 16:41:29'),
(284, 1, 19, 'sfqsdfqsdf', 1, '2014-06-20 16:41:31', '2014-06-20 16:41:31'),
(285, 1, 19, 'fsdqfsdfqsfeqes', 1, '2014-06-20 16:41:34', '2014-06-20 16:41:34'),
(286, 1, 13, 'Tu peux pas test', 1, '2014-06-20 16:53:43', '2014-06-20 16:53:43'),
(287, 3, 13, 'pas vide', 1, '2014-06-20 16:54:36', '2014-06-20 16:56:45'),
(288, 1, 3, 'qsdf', 0, '2014-06-22 12:25:52', '2014-06-28 09:18:28'),
(289, 1, 9, 'Test Mehdi', 1, '2014-06-27 16:53:19', '2014-06-27 16:53:19'),
(290, 1, 20, 'ddd', 1, '2014-06-27 17:04:17', '2014-06-27 17:04:17'),
(291, 1, 4, 'ghg', 1, '2014-06-27 17:21:44', '2014-06-27 17:21:44'),
(292, 1, 4, 'jdqdjq^jdqs\n DQ DQS DSQ dsqdqsJDSQkkd jklH DKLJSQH DJKSQH kjdhsqkj dsqjkl hdjklsqhkdsq\n dsq qdhsjkh dklsqh dsqh DSQHD JKSQHJKQ khdkjsqh dsq dsq\n dsq dhsqjk hdsqjkh dskqH DKSQJH DKJSQH DJKSQH DKLSQHK DHQKJD SKQHDKSHQ dhsqHDQ UÀZIOJOEZJFOIJ QKFJS ngksdj lfjsl jgmlsjg fsd\ng jfdskl gjflkdsj gflsjsdkgjnjdkfljskdgnkldsjgk s;gmlk djgdsg', 1, '2014-06-27 17:22:02', '2014-06-28 09:17:46'),
(293, 1, 4, NULL, 1, '2014-06-27 17:22:04', '2014-06-27 17:22:04'),
(294, 1, 4, NULL, 1, '2014-06-27 17:22:07', '2014-06-27 17:22:07'),
(295, 1, 4, NULL, 1, '2014-06-27 17:22:11', '2014-06-27 17:22:11'),
(296, 1, 13, NULL, 1, '2014-06-27 17:22:39', '2014-06-27 17:22:39'),
(297, 1, 4, NULL, 2, '2014-06-27 17:23:57', '2014-06-27 21:50:58'),
(298, 1, 13, NULL, 0, '2014-06-27 17:24:06', '2014-06-27 21:50:55'),
(299, 1, 13, 'bdvfdfvdsf', 1, '2014-06-28 11:36:12', '2014-06-28 11:36:12'),
(300, 1, 13, 'uuuuuuuuuhfcxfbnjvcgbgfgfbgfgrfgrgrbgr', 1, '2014-06-28 11:37:25', '2014-06-28 11:37:25'),
(301, 1, 13, NULL, 1, '2014-06-28 11:38:45', '2014-06-28 11:38:45'),
(302, 1, 13, 'gfgfgf', 1, '2014-06-28 11:39:11', '2014-06-28 11:39:11'),
(303, 1, 13, 'sddssd', 1, '2014-06-28 12:04:04', '2014-06-28 12:04:04'),
(304, 1, 6, NULL, 1, '2014-06-28 15:29:19', '2014-06-28 15:29:19'),
(305, 1, 6, NULL, 1, '2014-06-28 15:29:19', '2014-06-28 15:29:19'),
(306, 1, 4, 'test', 1, '2014-06-28 20:38:19', '2014-06-28 20:38:19'),
(307, 1, 4, '12536554655466+59+652+26', 1, '2014-06-28 20:38:27', '2014-06-28 20:38:27'),
(308, 1, 4, '215645641215645612156412315245623123', 1, '2014-06-28 20:38:34', '2014-06-28 20:38:34'),
(309, 1, 4, 'test1', 1, '2014-06-28 20:41:07', '2014-06-28 20:41:07'),
(310, 1, 4, 'sdvsdvsdvdsvsdcdv', 1, '2014-06-28 20:42:07', '2014-06-28 20:42:07'),
(312, 1, 13, 'Higf', 1, '2014-06-28 21:01:08', '2014-06-28 21:01:08'),
(313, 1, 13, 'Hgfggcggfgffgfdfgc', 0, '2014-06-28 21:10:35', '2014-06-28 21:51:44'),
(314, 1, 18, 'Hahsjxjd', 2, '2014-06-28 21:10:44', '2014-06-28 21:51:14'),
(316, 1, 1, 'Mon tip', 1, '2014-06-28 23:38:53', '2014-06-28 23:38:53'),
(317, 1, 20, 'Test Tips', 1, '2014-06-29 11:56:02', '2014-06-29 11:56:02'),
(318, 1, 9, 'qshdf mqsdkfjmsqlkfdjjsq dflksqj dfmlksjqdfmldksqjflsjdfksdjfsqjdfmljsqdfjsqdlkjfslkdjflksdjflksdjflskjdfmlksjdfslkdcnskfjskdlfmiosefjisfejisdjfs idfsdf jsidfjsd ifsd fjsidfjsmdijfismfjsd fjmsdfj smodjf smoidjfsdmoifj sdiljf sdklfmj sdmlkfjsq moiefj', 1, '2014-06-29 15:30:11', '2014-06-29 15:30:11'),
(322, 1, 15, '4', 1, '2014-06-30 11:43:37', '2014-06-30 11:43:37');

-- --------------------------------------------------------

--
-- Structure de la table `wbb_user`
--

CREATE TABLE IF NOT EXISTS `wbb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `first_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `pref_city_id_start` int(11) DEFAULT NULL,
  `title` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pref_when` time DEFAULT NULL,
  `pref_home` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pref_city3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stay_informed` tinyint(1) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `pref_city1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pref_city2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pref_bar1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pref_bar2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pref_bar3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pref_drink_brand_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pref_drink_brand_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pref_drink_brand_3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pref_cocktails_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pref_cocktails_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pref_cocktails_3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8C36E53292FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8C36E532A0D96FBF` (`email_canonical`),
  KEY `IDX_8C36E532B7E89101` (`pref_city_id_start`),
  KEY `IDX_8C36E532F92F3E70` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Contenu de la table `wbb_user`
--

INSERT INTO `wbb_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `website`, `description`, `latitude`, `longitude`, `created_at`, `updated_at`, `pref_city_id_start`, `title`, `pref_when`, `pref_home`, `pref_city3`, `stay_informed`, `country_id`, `birthdate`, `pref_city1`, `pref_city2`, `pref_bar1`, `pref_bar2`, `pref_bar3`, `pref_drink_brand_1`, `pref_drink_brand_2`, `pref_drink_brand_3`, `pref_cocktails_1`, `pref_cocktails_2`, `pref_cocktails_3`) VALUES
(1, 'admin', 'admin', 'b.hakkari@void.fr', 'b.hakkari@void.fr', 1, 'aop1zl8t31cgws8kk00444w040kos00', 'bavwjFeuDPmN8jM0YeNKpCQfSAelkOcLeUzzMwyMvWYw7zBEJUVmPyxlUvXaJ43TZ02O4T4xS7xhil6pFUBqdg==', '2014-07-12 12:14:34', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, 'Badr', 'HAKKARI', NULL, NULL, NULL, NULL, '1970-04-25 23:42:01', '2014-07-12 12:14:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Bar Expert', 'bar expert', 'expert@gmail.fr', 'expert@gmail.fr', 1, 'b8d9itx7a7wcs0k4oowkw88o4080gow', '944EtGg11L/5APCFyPS9xyOww+Z9/+jgB7LeKJMctI7qVULJpQ3k+/pKMvDmwmBKXQqVquBH5T2fQRg/mRN7+Q==', '2014-06-28 21:56:15', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_BAR_EXPERT";}', 0, NULL, NULL, NULL, NULL, NULL, '0.00000000', '0.00000000', '2014-06-08 13:11:43', '2014-06-28 21:56:15', NULL, 'Mrs', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'bar owner', 'bar owner', 'user@gmail.fr', 'user@gmail.fr', 1, '6y4gvd59lm4o0k48og8oc0kwgg0004s', 'zxLmKcnlr7UHvAlKjAKPek2BF6Kunhw84iPaXYCeKXwNOB3lw/CAVya0JsD7/S7ij7nsxsyNQcKwGs/hD15Pmg==', '2014-06-28 21:54:59', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:14:"ROLE_BAR_OWNER";}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-06-08 13:12:12', '2014-06-28 21:54:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Moderator', 'moderator', 'test@test.com', 'test@test.com', 1, 'et729upi1rcogg0ws8ccosk4cw80og0', 'lN07HfweULtye0FOxgo3CvfZOwAJvQTCAQahLlVz5wH2Zqvui963xH8NuSmacz5tKM8WNC8uPqjFHUlSlu0daA==', '2014-06-28 21:57:03', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:14:"ROLE_MODERATOR";}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-06-28 21:35:03', '2014-06-28 21:57:03', NULL, 'Mrs', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Publisher', 'publisher', 'ttest@test.com', 'ttest@test.com', 1, 'hgi2lh5fme8kckos0swcwg80owos4oc', 'gRbLS77/WCFf7EN5X6jZNBchPN9uxoMd41Wzch2fkFO5oFg0FK5kS5Vzy4M/OCWJo5LfULy7L8v88tu5G2m6RQ==', '2014-06-28 21:56:45', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:14:"ROLE_PUBLISHER";}', 0, NULL, NULL, NULL, NULL, NULL, '0.00000000', '0.00000000', '2014-06-28 21:41:23', '2014-06-28 21:56:45', NULL, 'Mrs', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Editorial Expert', 'editorial expert', 'teest@test.com', 'teest@test.com', 1, '1a4pttco88n44w04wokcscwssc4s800', 'WyVuGKnvP2d0gHPmQHwijji7UFm7P3jLjP5w5Uh27u+Iy549Jrh48exLRorF35posER80hWeV9z3Oww9zVv6cw==', '2014-06-28 21:56:27', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:21:"ROLE_EDITORIAL_EXPERT";}', 0, NULL, NULL, NULL, NULL, NULL, '0.00000000', '0.00000000', '2014-06-28 21:42:33', '2014-06-28 21:56:27', NULL, 'Mrs', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'test', 'test', 'test@yopmail.com', 'test@yopmail.com', 1, 'frl1j9t7p3k8kgwcscc44o8o4w08c8s', '5tYArhSMvLJ2yYVnADosduA2EntlCSKVXyyDeb/B/j3eF8HIYKoM/D9GT1fG1TvnbT71C9QeOWagAFoVJXZvcw==', '2014-07-07 11:27:02', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-07 11:25:56', '2014-07-07 11:27:02', NULL, NULL, NULL, NULL, NULL, 1, 1, '2009-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'fanopsis', 'fanopsis', 'fanopsis@yopmail.com', 'fanopsis@yopmail.com', 1, 'e1ghl6vq0iokcw0oc8048wo4ckc0g00', '3fGDBFJfLipxUiRtA3+BUfZOMUe9SUat+HqL1ZXYbLW8Y5SSnIDauYh+dhf3qzL10Y/jqtnrc/7tZ6HHMTW0yg==', '2014-07-08 10:12:37', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-07-08 10:12:36', '2014-07-08 10:12:37', NULL, NULL, NULL, NULL, NULL, 1, 1, '2013-07-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Test2', 'test2', 'test2@yopmail.com', 'test2@yopmail.com', 1, 't1q3imc2wao00c440k8kcsg0o0w8ows', '7ZLJRPLhe5i+ZqOiM4HmeUwFk19TwNq3sURytynppmMHc4usr72kCTio3p6amYLzRxyNxJBZ6SQQMVA9xXO2rw==', '2014-07-08 14:26:38', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'Badr', 'HAKKARI', NULL, NULL, NULL, NULL, '2014-07-08 14:26:38', '2014-07-08 14:26:38', NULL, 'M', NULL, NULL, NULL, 1, 1, '2018-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `bars_news`
--
ALTER TABLE `bars_news`
  ADD CONSTRAINT `FK_F848BD9289A253A` FOREIGN KEY (`bar_id`) REFERENCES `wbb_bar` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F848BD92B5A459A0` FOREIGN KEY (`news_id`) REFERENCES `wbb_news` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `bestofs_news`
--
ALTER TABLE `bestofs_news`
  ADD CONSTRAINT `FK_C4C10831B5A459A0` FOREIGN KEY (`news_id`) REFERENCES `wbb_news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C4C10831DD8BC253` FOREIGN KEY (`bestof_id`) REFERENCES `wbb_bestof` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `cities_news`
--
ALTER TABLE `cities_news`
  ADD CONSTRAINT `FK_3F44455D8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `wbb_city` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3F44455DB5A459A0` FOREIGN KEY (`news_id`) REFERENCES `wbb_news` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `media__gallery_media`
--
ALTER TABLE `media__gallery_media`
  ADD CONSTRAINT `FK_80D4C5414E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `media__gallery` (`id`),
  ADD CONSTRAINT `FK_80D4C541EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `wbb_ad`
--
ALTER TABLE `wbb_ad`
  ADD CONSTRAINT `FK_84E111553DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `wbb_bar`
--
ALTER TABLE `wbb_bar`
  ADD CONSTRAINT `FK_8BDF1EB76C25F1` FOREIGN KEY (`suburb_id`) REFERENCES `wbb_city_suburb` (`id`),
  ADD CONSTRAINT `FK_8BDF1EB8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `wbb_city` (`id`),
  ADD CONSTRAINT `FK_8BDF1EB97B12258` FOREIGN KEY (`energyLevel_id`) REFERENCES `wbb_tag` (`id`),
  ADD CONSTRAINT `FK_8BDF1EBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `wbb_user` (`id`);

--
-- Contraintes pour la table `wbb_bar_media`
--
ALTER TABLE `wbb_bar_media`
  ADD CONSTRAINT `FK_8C818C347218004` FOREIGN KEY (`video1_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_8C818C355942FEA` FOREIGN KEY (`video2_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_8C818C389A253A` FOREIGN KEY (`bar_id`) REFERENCES `wbb_bar` (`id`),
  ADD CONSTRAINT `FK_8C818C3EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `wbb_bar_occasion`
--
ALTER TABLE `wbb_bar_occasion`
  ADD CONSTRAINT `FK_82F53E6A4034998F` FOREIGN KEY (`occasion_id`) REFERENCES `wbb_tag` (`id`),
  ADD CONSTRAINT `FK_82F53E6A89A253A` FOREIGN KEY (`bar_id`) REFERENCES `wbb_bar` (`id`);

--
-- Contraintes pour la table `wbb_bar_opening`
--
ALTER TABLE `wbb_bar_opening`
  ADD CONSTRAINT `FK_F0EA768E89A253A` FOREIGN KEY (`bar_id`) REFERENCES `wbb_bar` (`id`),
  ADD CONSTRAINT `FK_F0EA768ED083AAA` FOREIGN KEY (`semsoftBar_id`) REFERENCES `wbb_semsoft_imported_bar` (`id`);

--
-- Contraintes pour la table `wbb_bar_tag`
--
ALTER TABLE `wbb_bar_tag`
  ADD CONSTRAINT `FK_A42A296089A253A` FOREIGN KEY (`bar_id`) REFERENCES `wbb_bar` (`id`),
  ADD CONSTRAINT `FK_A42A2960BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `wbb_tag` (`id`),
  ADD CONSTRAINT `FK_A42A2960D083AAA` FOREIGN KEY (`semsoftBar_id`) REFERENCES `wbb_semsoft_imported_bar` (`id`);

--
-- Contraintes pour la table `wbb_bestof`
--
ALTER TABLE `wbb_bestof`
  ADD CONSTRAINT `FK_BAF14BBA3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_BAF14BBA8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `wbb_city` (`id`),
  ADD CONSTRAINT `FK_BAF14BBA97B12258` FOREIGN KEY (`energyLevel_id`) REFERENCES `wbb_tag` (`id`),
  ADD CONSTRAINT `FK_BAF14BBAF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `wbb_country` (`id`),
  ADD CONSTRAINT `FK_BAF14BBAFAF5A804` FOREIGN KEY (`sponsorImage_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `wbb_bestof_bar`
--
ALTER TABLE `wbb_bestof_bar`
  ADD CONSTRAINT `FK_1387D3E189A253A` FOREIGN KEY (`bar_id`) REFERENCES `wbb_bar` (`id`),
  ADD CONSTRAINT `FK_1387D3E1DD8BC253` FOREIGN KEY (`bestof_id`) REFERENCES `wbb_bestof` (`id`),
  ADD CONSTRAINT `FK_1387D3E1EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `wbb_bar_media` (`id`);

--
-- Contraintes pour la table `wbb_bestof_bestof`
--
ALTER TABLE `wbb_bestof_bestof`
  ADD CONSTRAINT `FK_D6D851E5BF1126F0` FOREIGN KEY (`in_bestof_id`) REFERENCES `wbb_bestof` (`id`),
  ADD CONSTRAINT `FK_D6D851E5DD8BC253` FOREIGN KEY (`bestof_id`) REFERENCES `wbb_bestof` (`id`);

--
-- Contraintes pour la table `wbb_bestof_occasion`
--
ALTER TABLE `wbb_bestof_occasion`
  ADD CONSTRAINT `FK_74430C434034998F` FOREIGN KEY (`occasion_id`) REFERENCES `wbb_tag` (`id`),
  ADD CONSTRAINT `FK_74430C43DD8BC253` FOREIGN KEY (`bestof_id`) REFERENCES `wbb_bestof` (`id`);

--
-- Contraintes pour la table `wbb_bestof_tag`
--
ALTER TABLE `wbb_bestof_tag`
  ADD CONSTRAINT `FK_66F1E8C8BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `wbb_tag` (`id`),
  ADD CONSTRAINT `FK_66F1E8C8DD8BC253` FOREIGN KEY (`bestof_id`) REFERENCES `wbb_bestof` (`id`);

--
-- Contraintes pour la table `wbb_bestof_trend`
--
ALTER TABLE `wbb_bestof_trend`
  ADD CONSTRAINT `FK_1CA28C75BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `wbb_tag` (`id`),
  ADD CONSTRAINT `FK_1CA28C75DD8BC253` FOREIGN KEY (`bestof_id`) REFERENCES `wbb_bestof` (`id`);

--
-- Contraintes pour la table `wbb_city`
--
ALTER TABLE `wbb_city`
  ADD CONSTRAINT `FK_2CFE314F3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_2CFE314FF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `wbb_country` (`id`);

--
-- Contraintes pour la table `wbb_city_bestof`
--
ALTER TABLE `wbb_city_bestof`
  ADD CONSTRAINT `FK_505C43958BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `wbb_city` (`id`),
  ADD CONSTRAINT `FK_505C4395DD8BC253` FOREIGN KEY (`bestof_id`) REFERENCES `wbb_bestof` (`id`);

--
-- Contraintes pour la table `wbb_city_suburb`
--
ALTER TABLE `wbb_city_suburb`
  ADD CONSTRAINT `FK_E950F7E18BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `wbb_city` (`id`);

--
-- Contraintes pour la table `wbb_city_tag`
--
ALTER TABLE `wbb_city_tag`
  ADD CONSTRAINT `FK_10DBC9658BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `wbb_city` (`id`),
  ADD CONSTRAINT `FK_10DBC965BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `wbb_tag` (`id`);

--
-- Contraintes pour la table `wbb_country`
--
ALTER TABLE `wbb_country`
  ADD CONSTRAINT `FK_59007C814F34D596` FOREIGN KEY (`ad_id`) REFERENCES `wbb_ad` (`id`);

--
-- Contraintes pour la table `wbb_news`
--
ALTER TABLE `wbb_news`
  ADD CONSTRAINT `FK_1C76AA2BA13EB601` FOREIGN KEY (`sponsorImageSmall_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_1C76AA2BB5A459A0` FOREIGN KEY (`news_id`) REFERENCES `wbb_user` (`id`),
  ADD CONSTRAINT `FK_1C76AA2BFAF5A804` FOREIGN KEY (`sponsorImage_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `wbb_news_bars`
--
ALTER TABLE `wbb_news_bars`
  ADD CONSTRAINT `FK_5292A4A189A253A` FOREIGN KEY (`bar_id`) REFERENCES `wbb_bar` (`id`),
  ADD CONSTRAINT `FK_5292A4A1BD06B3B3` FOREIGN KEY (`new_id`) REFERENCES `wbb_news` (`id`);

--
-- Contraintes pour la table `wbb_news_bestofs`
--
ALTER TABLE `wbb_news_bestofs`
  ADD CONSTRAINT `FK_71975637BD06B3B3` FOREIGN KEY (`new_id`) REFERENCES `wbb_news` (`id`),
  ADD CONSTRAINT `FK_71975637DD8BC253` FOREIGN KEY (`bestof_id`) REFERENCES `wbb_bestof` (`id`);

--
-- Contraintes pour la table `wbb_news_cities`
--
ALTER TABLE `wbb_news_cities`
  ADD CONSTRAINT `FK_390EF44E8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `wbb_city` (`id`),
  ADD CONSTRAINT `FK_390EF44EB5A459A0` FOREIGN KEY (`news_id`) REFERENCES `wbb_news` (`id`);

--
-- Contraintes pour la table `wbb_news_media`
--
ALTER TABLE `wbb_news_media`
  ADD CONSTRAINT `FK_EC809A06B5A459A0` FOREIGN KEY (`news_id`) REFERENCES `wbb_news` (`id`),
  ADD CONSTRAINT `FK_EC809A06EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `wbb_semsoft_imported_bar`
--
ALTER TABLE `wbb_semsoft_imported_bar`
  ADD CONSTRAINT `FK_DFC4FF6B76C25F1` FOREIGN KEY (`suburb_id`) REFERENCES `wbb_city_suburb` (`id`),
  ADD CONSTRAINT `FK_DFC4FF6B89A253A` FOREIGN KEY (`bar_id`) REFERENCES `wbb_bar` (`id`),
  ADD CONSTRAINT `FK_DFC4FF6B8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `wbb_city` (`id`),
  ADD CONSTRAINT `FK_DFC4FF6BF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `wbb_country` (`id`);

--
-- Contraintes pour la table `wbb_tag`
--
ALTER TABLE `wbb_tag`
  ADD CONSTRAINT `FK_7DCBCAC28BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `wbb_city` (`id`);

--
-- Contraintes pour la table `wbb_tip`
--
ALTER TABLE `wbb_tip`
  ADD CONSTRAINT `FK_36C1C50D89A253A` FOREIGN KEY (`bar_id`) REFERENCES `wbb_bar` (`id`),
  ADD CONSTRAINT `FK_36C1C50DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `wbb_user` (`id`);

--
-- Contraintes pour la table `wbb_user`
--
ALTER TABLE `wbb_user`
  ADD CONSTRAINT `FK_8C36E532B7E89101` FOREIGN KEY (`pref_city_id_start`) REFERENCES `wbb_city` (`id`),
  ADD CONSTRAINT `FK_8C36E532F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `wbb_country` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
