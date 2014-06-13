-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Ven 13 Juin 2014 à 16:24
-- Version du serveur: 5.5.31
-- Version de PHP: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `wbb-dev`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Contenu de la table `media__media`
--

INSERT INTO `media__media` (`id`, `name`, `description`, `enabled`, `provider_name`, `provider_status`, `provider_reference`, `provider_metadata`, `width`, `height`, `length`, `content_type`, `content_size`, `copyright`, `author_name`, `context`, `cdn_is_flushable`, `cdn_flush_at`, `cdn_status`, `updated_at`, `created_at`) VALUES
(1, 'AndyWahloo_24.jpg', NULL, 0, 'sonata.media.provider.image', 1, '131d876f1ea010828b9a37e4a337af835250b4ba.jpeg', '{"filename":"AndyWahloo_24.jpg"}', 585, 422, NULL, 'image/jpeg', 247773, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-12 12:40:40', '2014-06-12 12:40:40'),
(2, 'AndyWahloo_04.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'e8422f7719be4bed1260e2b27a3e46c060992bc0.jpeg', '{"filename":"AndyWahloo_04.jpg"}', 585, 390, NULL, 'image/jpeg', 71049, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-12 12:41:00', '2014-06-12 12:41:00'),
(3, 'AndyWahloo_24.jpg', NULL, 0, 'sonata.media.provider.image', 1, '883db7b818ac9e341c5bcd77e4c0924bdf06b705.jpeg', '{"filename":"AndyWahloo_24.jpg"}', 585, 422, NULL, 'image/jpeg', 247773, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-12 12:41:21', '2014-06-12 12:41:21'),
(4, 'AndyWahloo_24.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'ee1807b5b3cf737b03072a3d0de23a4de3d8e6b1.jpeg', '{"filename":"AndyWahloo_24.jpg"}', 585, 422, NULL, 'image/jpeg', 247773, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-12 12:41:23', '2014-06-12 12:41:23'),
(5, 'AndyWahloo_24.jpg', NULL, 0, 'sonata.media.provider.image', 1, '4626a893044107ef06fdc134bf5337a075f6a8eb.jpeg', '{"filename":"AndyWahloo_24.jpg"}', 585, 422, NULL, 'image/jpeg', 247773, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-12 12:41:27', '2014-06-12 12:41:27'),
(6, 'AndyWahloo_39.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'e68398086d71ba2593970e6b3446f361f6df190d.jpeg', '{"filename":"AndyWahloo_39.jpg"}', 585, 385, NULL, 'image/jpeg', 255330, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-12 12:44:24', '2014-06-12 12:44:24'),
(7, 'AndyWahloo_65.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'b8ae478672ca0ba833dc2d9c7b0ae90f1f6e7224.jpeg', '{"filename":"AndyWahloo_65.jpg"}', 585, 355, NULL, 'image/jpeg', 179782, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-12 12:44:49', '2014-06-12 12:44:49'),
(8, 'step-1.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'f8435e7d740fae80aecc71be5e61b589741567ab.jpeg', '{"filename":"step-1.jpg"}', 1240, 882, NULL, 'image/jpeg', 306371, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-12 13:03:16', '2014-06-12 13:03:16'),
(9, 'step-3.jpg', NULL, 0, 'sonata.media.provider.image', 1, '44603bd4a9b3cad9757ee99f9e6aebe902ae06eb.jpeg', '{"filename":"step-3.jpg"}', 1240, 687, NULL, 'image/jpeg', 204668, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-12 13:04:57', '2014-06-12 13:04:57'),
(10, 'step-2.jpg', NULL, 0, 'sonata.media.provider.image', 1, '777313748a61ae46e812b0ca9e37a7bb7c9e73fe.jpeg', '{"filename":"step-2.jpg"}', 1240, 780, NULL, 'image/jpeg', 160759, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-12 13:05:19', '2014-06-12 13:05:19'),
(11, 'step-5.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'f5c679df1c8a89ba32d0a8cc363c7e61af82717c.jpeg', '{"filename":"step-5.jpg"}', 1240, 930, NULL, 'image/jpeg', 297154, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-12 13:05:39', '2014-06-12 13:05:39'),
(12, 'acte3.jpg', NULL, 0, 'sonata.media.provider.image', 1, '9054f2c257f5c8e4e4e0afe10199cd735c6d111e.jpeg', '{"filename":"acte3.jpg"}', 289, 289, NULL, 'image/jpeg', 10968, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-12 13:17:20', '2014-06-12 13:17:20'),
(13, 'BarO.jpg', NULL, 0, 'sonata.media.provider.image', 1, '1506f2b886c5899f4a2f51a796fbb87f95560bcc.jpeg', '{"filename":"BarO.jpg"}', 1341, 432, NULL, 'image/jpeg', 122232, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-12 13:51:11', '2014-06-12 13:51:11'),
(14, 'Café_de_Flore.jpg', NULL, 0, 'sonata.media.provider.image', 1, '72abfced7994c6943b906f734b1f8a6b371fc19e.jpeg', '{"filename":"Caf\\u00e9_de_Flore.jpg"}', 1024, 768, NULL, 'image/jpeg', 539645, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-12 14:39:02', '2014-06-12 14:39:02'),
(15, 'ACTE III', NULL, 0, 'sonata.media.provider.youtube', 1, 'SYlMclvcJk4', '{"thumbnail_width":480,"author_url":"http:\\/\\/www.youtube.com\\/channel\\/UCrbdBkvSRrtY-efBznJQ35A","height":344,"title":"ACTE III","author_name":"quero mickael","html":"<iframe width=\\"459\\" height=\\"344\\" src=\\"http:\\/\\/www.youtube.com\\/embed\\/SYlMclvcJk4?feature=oembed\\" frameborder=\\"0\\" allowfullscreen><\\/iframe>","version":"1.0","thumbnail_url":"http:\\/\\/i1.ytimg.com\\/vi\\/SYlMclvcJk4\\/hqdefault.jpg","provider_name":"YouTube","width":459,"type":"video","provider_url":"http:\\/\\/www.youtube.com\\/","thumbnail_height":360}', 459, 344, NULL, 'video/x-flv', NULL, NULL, 'quero mickael', 'default', NULL, NULL, NULL, '2014-06-12 14:46:02', '2014-06-12 14:46:02'),
(16, 'Café_de_Flore.jpg', NULL, 0, 'sonata.media.provider.image', 1, 'ae01d37e7a80518b5291cbca9e801ad2ec667b1d.jpeg', '{"filename":"Caf\\u00e9_de_Flore.jpg"}', 1024, 768, NULL, 'image/jpeg', 539645, NULL, NULL, 'default', NULL, NULL, NULL, '2014-06-12 14:47:57', '2014-06-12 14:47:57');

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
  `bar_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8BDF1EB989D9B62` (`slug`),
  KEY `IDX_8BDF1EBA76ED395` (`user_id`),
  KEY `IDX_8BDF1EB8BAC62AF` (`city_id`),
  KEY `IDX_8BDF1EB76C25F1` (`suburb_id`),
  KEY `IDX_8BDF1EB89A253A` (`bar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `wbb_bar`
--

INSERT INTO `wbb_bar` (`id`, `user_id`, `city_id`, `suburb_id`, `bar_id`, `name`, `slug`, `latitude`, `longitude`, `address`, `phone`, `email`, `website`, `foursquare`, `twitter`, `facebook`, `instagram`, `is_credit_card`, `is_coat_check`, `parking`, `price`, `menu`, `is_reservation`, `reservation`, `description`, `seo_description`, `on_top`, `status`, `foursquare_excluded_tips`, `foursquare_selected_images`, `instagram_excluded_imgs`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, 'Andy Wahloo', 'Andy-Wahloo', '48.864468', '2.354261700000052', '69, rue des Gravilliers, 3ème arrondissement', '00 33 1 42 71 20 38', 'info@andywahloo-bar.com', 'http://andywahloo-bar.com/restaurant/paris/andy-wahloo/', '4adcda08f964a520bb3321e3', NULL, 'groups/43223358763/', NULL, 1, 1, NULL, 3, 'http://andywahloo-bar.com/restaurant/paris/andy-wahloo/cocktail-et-tartine/', 1, NULL, 'Owned by the same folks as the swish neighbouring Derrière and\r\n  404 Restaurants (as well as London''s Sketch and Momo), Andy Wahloo boasts an\r\n  interior verging on the kitsch. The style can best be described as Pop Art\r\n  meets Moroccan. Smartly attired guests perch on stools made from paint tins\r\n  and lanterns jangle from the ceiling. If you''re here in the summer you must\r\n  check out the stunning summer courtyard. The cocktails and the wine list both\r\n  exhibit North American influences. If you fancy something fresh and\r\n  non-boozey, opt for one of their mint teas.\r\n<br>', 'Owned by the same folks as the swish neighbouring Derrière and 404 Restaurants (as well as London''s Sketch and Momo), Andy Wahloo boasts an interior verging on the kitsch.', 1, 2, 'a:0:{}', 'a:5:{i:2;s:24:"51719d7a45b0097e385940ed";i:3;s:24:"5390c800498ef1ef62f7c88e";i:4;s:24:"512d1794e4b0c94a5e2e9c50";i:5;s:24:"5390b7b4498e6aa3fc66cbff";i:6;s:24:"534d76f5498eac7106293ce6";}', 'a:0:{}', '2014-06-12 12:27:26', '2014-06-12 12:48:48'),
(2, 1, 1, 2, NULL, 'Bar du Crillon', 'Bar-Du-Crillon', '48.8687817', '2.3218008000000054', 'Hotel du Crillon - 16 Rue Boissy d''Anglas, 8ème arrondissement', '00 33 1 44 71 15 39', 'crillon@rosewoodhotels.com', 'http://www.crillon.com/en/', '4adcd9fef964a520743021e3', 'hoteldecrillon', 'hoteldecrillon', NULL, 1, 1, NULL, 4, NULL, 0, NULL, 'Elegant Parisian landmark in the Hotel du Crillon, you''ll need\r\n  to put away those jeans and trainers to make it anywhere near the counter.\r\n  Designed by the sculptor Cesar in 1907 and recently redecorated by Sonia\r\n  Rykiel, the likes of Madonna and Harrison Ford recline on antique armchairs\r\n  and sip on signature Duc de Crillon''s: an Armagnac and Tattinger Champagne\r\n  cocktail, it tastes of class and costs about 120 Francs a glass.\r\n<br>', 'Elegant Parisian landmark in the Hotel du Crillon, you''ll need to put away those jeans and trainers to make it anywhere near the counter.', 1, 2, 'a:0:{}', 'a:4:{i:0;s:24:"4ee34b980aafe03523b23210";i:1;s:24:"516c30f9e4b0e67c1819c448";i:2;s:24:"5132067ee4b0ba071d13339d";i:3;s:24:"4fec8c36e4b03430aeb6e093";}', 'a:0:{}', '2014-06-12 12:53:48', '2014-06-12 13:41:40'),
(3, 1, 1, 3, NULL, 'Acte 3', 'Acte-3', '48.8628356', '2.351563199999987', '94 Rue Quincampoix, 3ème arrondissement', '00 33 1 44 61 29 69', NULL, NULL, '4f039bb84901a1400a7cd450', NULL, 'lacte3', NULL, 1, 1, NULL, 2, NULL, 1, NULL, 'Acte 3 is a new cocktail bar in the 3eme arrondissement. Hidden behind \r\nan unmarked door (keep an eye out for a menu in a gilt frame), it’s a \r\nhip space with a focus on quality cocktails. There’s a compact drinks \r\nlist but the bartenders are more than happy to go off-piste and make you\r\n up an inventive bespoke creation.  The décor is simple but attractive, \r\nwith flickering candles softening the more industrial edges. The bar \r\nitself dominates the main floor but there’s also a basement space \r\ncomplete with DJ and dance floor where they occasionally stage burlesque\r\n nights and other entertainments.<br>', 'Acte 3 is a new cocktail bar in the 3eme arrondissement. Hidden behind an unmarked door (keep an eye out for a menu in a gilt frame), it’s a hip space with a focus on quality cocktails.', 1, 2, 'a:0:{}', 'a:5:{i:0;s:24:"4fb69f34e4b0bf7a6c362cf1";i:1;s:24:"4fa6ad84e4b0bbcd4ad6ef1a";i:2;s:24:"50c28985e4b04a2d9c23a73f";i:3;s:24:"5047e06de4b0ad1856f99509";i:4;s:24:"516c6a8ce4b0ea0f66d9aa82";}', 'a:0:{}', '2014-06-12 13:09:41', '2014-06-12 13:36:12'),
(5, 1, 1, 5, NULL, 'Bar O', 'Bar-O', '48.8651136', '2.3415774000000056', '19, rue Hérold, 1er arrondissement', '00 33 1 42 36 04 02', 'contact@hotel-o-paris.com', 'http://www.hotel-o-paris.com/fr/bar.html', '510001067043eddd52e30d79', 'HotelOParis', 'hotelOparis', NULL, 1, 1, NULL, 3, 'http://www.hotel-o-paris.com/download/19081', 1, NULL, 'In the heart of the Halles district, the stylish O - one of Paris’ \r\nmany super-hip boutique hotels - has a cocktail bar that befits such an \r\nestablishment. Designed by the renowned Ora Ito, it’s a faintly \r\nfuturistic space, deliciously swish, all curves and glass with a wall \r\nmade up of lights which slowly change colour. There are chic green \r\nbanquettes, lots of pale blonde wood, striking honeycomb-style shelving \r\nand a sleek minimal, Asian aesthetic to the place. \r\nThe bar itself stocks a small selection of spirits including many \r\noriginal and unusual choices. There’s an Asian influence to the menu, \r\nthe cocktails all feature bold flavours like coriander and ginger.  \r\nThere are plenty of house made syrups and infusions on offer and the bar\r\n tenders are happy to craft a cocktail on-demand, to meet your personal \r\ntaste. Choose your base spirit and let them create something bespoke and\r\n fabulous. Their newly instituted Thursday “After-works” sessions should\r\n prove popular with stylish local crowd as well as guests at the hotel \r\n(which is equally visually playful, a fun urban hideaway, ideal for a \r\nweekend retreat). The service is effiecient and knowledgeable, and given\r\n the look of the place and the standard of drinks, the prices are \r\neminently reasonable, at least by Paris hotel bar standards.<br>', 'In the heart of the Halles district, the stylish O - one of Paris’ many super-hip boutique hotels - has a cocktail bar that befits such an establishment.', 1, 2, 'a:0:{}', 'a:5:{i:0;s:24:"537d20ce498e1bb13ff89b53";i:1;s:24:"511944fee4b066681d276e17";i:2;s:24:"5100616ae4b06b4b08b909bf";i:3;s:24:"510062f7e4b0c9cd287a7eb2";i:4;s:24:"5103c678e4b0fb051c9b49e7";}', 'a:0:{}', '2014-06-12 13:49:20', '2014-06-12 13:57:59'),
(6, 1, 1, 6, NULL, 'Café de Flore', 'Cafe-De-Flore', '48.8541411', '2.3324943000000076', '172 Bld St Germain, 6ème arrondissement', '00 33 1 45 48 55 26', NULL, 'http://www.cafedeflore.fr/', '4adcda04f964a520323221e3', NULL, NULL, NULL, 1, 1, 'Street level', 3, 'http://www.cafedeflore.fr/accueil/menu/menu/', 0, NULL, 'The Cafe de Flore is one of Paris’ landmark destinations. Its history is\r\n rich, its clientele legendary: Ernest Hemingway, Truman Capote, \r\nLawrence Durrel, Jean Paul Sartre and Simone de Beauvoir, the usual \r\nsubjects. It has lost some of its sheen over the years, inevitably, and \r\nnow you’re as likely to have a table beside a party of guidebook-toting \r\ntourists as the Parisian intellectual elite, but it is also still \r\nfavoured by locals looking for a chic place to start their evening or to\r\n take their breakfast coffee and croissant.<br>', 'The Cafe de Flore is one of Paris’ landmark destinations. Its history is rich, its clientele legendary: Ernest Hemingway, Truman Capote, Lawrence Durrel, Jean Paul Sartre and Simone de Beauvoir, the usual subjects.', 1, 2, 'a:0:{}', 'a:9:{i:0;s:24:"500533fbe4b0dd7b6fcd9c9d";i:1;s:24:"50cb5082e4b082174b532660";i:2;s:24:"51b30a52498ebbd721a09542";i:3;s:24:"5085b356e4b0fb5cba2093f4";i:4;s:24:"51d33556498e51492b3d2b77";i:5;s:24:"5392d0d6498ea8ca9cc5465d";i:6;s:24:"5392ce27498ef3964bd17c3c";i:7;s:24:"539450f5498e16f441ca4ce9";i:8;s:24:"53973748498e509e58136e98";}', 'a:0:{}', '2014-06-12 14:04:47', '2014-06-12 14:51:04');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `wbb_bar_media`
--

INSERT INTO `wbb_bar_media` (`id`, `bar_id`, `media_id`, `video1_id`, `video2_id`, `alt`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 5, NULL, NULL, 'Andy Wahloo 1', 1, '2014-06-12 12:45:12', '2014-06-12 16:56:14'),
(2, 1, 2, NULL, NULL, 'Andy Wahloo 2', 2, '2014-06-12 12:45:12', '2014-06-12 16:56:14'),
(3, 1, 6, NULL, NULL, 'Andy Wahloo 3', 3, '2014-06-12 12:45:12', '2014-06-12 16:56:14'),
(4, 1, 7, NULL, NULL, 'Andy Wahloo 4', 4, '2014-06-12 12:45:12', '2014-06-12 16:56:14'),
(5, 2, 8, NULL, NULL, 'Hotel Crillon 1', 1, '2014-06-12 13:06:22', '2014-06-12 14:55:37'),
(6, 2, 9, NULL, NULL, 'Hotel Crillon 2', 2, '2014-06-12 13:06:22', '2014-06-12 14:55:37'),
(7, 2, 10, NULL, NULL, 'Hotel Crillon 3', 3, '2014-06-12 13:06:22', '2014-06-12 14:55:37'),
(8, 2, 11, NULL, NULL, 'Hotel Crillon 4', 4, '2014-06-12 13:06:22', '2014-06-12 14:55:37'),
(9, 3, 15, NULL, NULL, 'acte 3', 1, '2014-06-12 13:17:26', '2014-06-12 14:46:08'),
(10, 5, 13, NULL, NULL, NULL, 1, '2014-06-12 13:51:15', '2014-06-12 13:57:59'),
(11, 6, 16, NULL, NULL, 'Café de Flore', 1, '2014-06-12 14:48:06', '2014-06-12 14:51:04');

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
  PRIMARY KEY (`id`),
  KEY `IDX_F0EA768E89A253A` (`bar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Contenu de la table `wbb_bar_opening`
--

INSERT INTO `wbb_bar_opening` (`id`, `bar_id`, `opening_day`, `from_hour`, `to_hour`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 18, 2, '2014-06-12 12:27:26', '2014-06-12 12:27:26'),
(2, 1, 3, 18, 2, '2014-06-12 12:27:26', '2014-06-12 12:27:26'),
(3, 1, 4, 18, 2, '2014-06-12 12:27:26', '2014-06-12 12:27:26'),
(4, 1, 5, 18, 2, '2014-06-12 12:27:26', '2014-06-12 12:27:26'),
(5, 1, 6, 18, 2, '2014-06-12 12:27:26', '2014-06-12 12:27:26'),
(6, 3, 2, 18, 2, '2014-06-12 13:36:12', '2014-06-12 13:36:12'),
(7, 3, 3, 18, 2, '2014-06-12 13:36:12', '2014-06-12 13:36:12'),
(8, 3, 4, 18, 2, '2014-06-12 13:36:12', '2014-06-12 13:36:12'),
(9, 3, 5, 18, 2, '2014-06-12 13:36:12', '2014-06-12 13:36:12'),
(10, 3, 6, 18, 2, '2014-06-12 13:36:12', '2014-06-12 13:36:12'),
(11, 5, 2, 16, 0, '2014-06-12 13:49:20', '2014-06-12 13:49:20'),
(12, 5, 3, 16, 0, '2014-06-12 13:49:20', '2014-06-12 13:49:20'),
(13, 5, 4, 16, 0, '2014-06-12 13:49:20', '2014-06-12 13:49:20'),
(14, 5, 5, 16, 0, '2014-06-12 13:49:20', '2014-06-12 13:49:20'),
(15, 5, 6, 16, 0, '2014-06-12 13:49:20', '2014-06-12 13:49:20'),
(16, 6, 1, 7, 0, '2014-06-12 14:49:54', '2014-06-12 14:49:54'),
(17, 6, 2, 7, 0, '2014-06-12 14:49:54', '2014-06-12 14:49:54'),
(18, 6, 3, 7, 0, '2014-06-12 14:49:54', '2014-06-12 14:49:54'),
(19, 6, 4, 7, 0, '2014-06-12 14:49:54', '2014-06-12 14:49:54'),
(20, 6, 5, 7, 0, '2014-06-12 14:49:54', '2014-06-12 14:49:54'),
(21, 6, 6, 7, 0, '2014-06-12 14:49:54', '2014-06-12 14:49:54'),
(22, 6, 7, 7, 0, '2014-06-12 14:49:54', '2014-06-12 14:49:54');

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
  PRIMARY KEY (`id`),
  KEY `IDX_A42A296089A253A` (`bar_id`),
  KEY `IDX_A42A2960BAD26311` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `wbb_bar_tag`
--

INSERT INTO `wbb_bar_tag` (`id`, `bar_id`, `tag_id`, `position`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, '2014-06-12 13:24:01', '2014-06-12 14:46:08'),
(4, 5, 1, 1, '2014-06-12 13:54:13', '2014-06-12 13:57:59'),
(5, 5, 2, 2, '2014-06-12 13:54:13', '2014-06-12 13:57:59'),
(6, 6, 3, 1, '2014-06-12 14:49:54', '2014-06-12 14:51:04'),
(7, 1, 1, 1, '2014-06-12 14:52:14', '2014-06-12 16:56:14'),
(8, 2, 4, 1, '2014-06-12 14:55:37', '2014-06-12 14:55:37'),
(9, 2, 2, 2, '2014-06-12 14:55:37', '2014-06-12 14:55:37'),
(10, 1, 5, 2, '2014-06-12 16:29:02', '2014-06-12 16:56:14'),
(11, 1, NULL, 3, '2014-06-12 16:29:02', '2014-06-12 16:56:14');

-- --------------------------------------------------------

--
-- Structure de la table `wbb_bestof`
--

CREATE TABLE IF NOT EXISTS `wbb_bestof` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `bestof_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sponsor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sponsor_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `by_tag` tinyint(1) DEFAULT NULL,
  `on_top` tinyint(1) DEFAULT NULL,
  `ordered` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BAF14BBA8BAC62AF` (`city_id`),
  KEY `IDX_BAF14BBAF92F3E70` (`country_id`),
  KEY `IDX_BAF14BBADD8BC253` (`bestof_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`),
  KEY `IDX_1387D3E1DD8BC253` (`bestof_id`),
  KEY `IDX_1387D3E189A253A` (`bar_id`),
  KEY `IDX_1387D3E1EA9FDD75` (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`),
  KEY `IDX_66F1E8C8DD8BC253` (`bestof_id`),
  KEY `IDX_66F1E8C8BAD26311` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `wbb_city`
--

CREATE TABLE IF NOT EXISTS `wbb_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `news_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seo_description` longtext COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `on_top` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2CFE314F989D9B62` (`slug`),
  KEY `IDX_2CFE314FF92F3E70` (`country_id`),
  KEY `IDX_2CFE314FB5A459A0` (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `wbb_city`
--

INSERT INTO `wbb_city` (`id`, `country_id`, `news_id`, `name`, `slug`, `latitude`, `longitude`, `seo_description`, `image`, `on_top`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Paris', 'Paris', NULL, NULL, 'When it comes to art, fashion, food and drink the French have things sewn up. Their bar scene is one of the best in the world.', NULL, 1, '2014-06-12 12:22:49', '2014-06-12 12:22:49');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  KEY `IDX_E950F7E18BAC62AF` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `wbb_city_suburb`
--

INSERT INTO `wbb_city_suburb` (`id`, `city_id`, `name`, `created_at`, `updated_at`, `slug`) VALUES
(1, 1, 'Bastille and the Marais', '2014-06-12 12:22:49', '2014-06-12 12:22:49', 'Bastille-And-The-Marais'),
(2, 1, 'Champs Elysees', '2014-06-12 12:22:49', '2014-06-12 12:22:49', 'Champs-Elysees'),
(3, 1, 'Le Louvre', '2014-06-12 12:22:49', '2014-06-12 12:22:49', 'Le-Louvre'),
(4, 1, 'Montmartre and the North', '2014-06-12 12:22:49', '2014-06-12 12:22:49', 'Montmartre-And-The-North'),
(5, 1, 'Opera and Les Halles', '2014-06-12 12:22:49', '2014-06-12 12:22:49', 'Opera-And-Les-Halles'),
(6, 1, 'St Germain and the Latin Quarter', '2014-06-12 12:22:49', '2014-06-12 12:22:49', 'St-Germain-And-The-Latin-Quarter');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `wbb_country`
--

CREATE TABLE IF NOT EXISTS `wbb_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `acronym` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_59007C814F34D596` (`ad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `wbb_country`
--

INSERT INTO `wbb_country` (`id`, `ad_id`, `name`, `acronym`, `created_at`, `updated_at`) VALUES
(1, NULL, 'France', 'France', '2014-06-12 12:19:47', '2014-06-12 12:19:47');

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
  PRIMARY KEY (`id`),
  KEY `IDX_1C76AA2BB5A459A0` (`news_id`),
  KEY `IDX_1C76AA2BFAF5A804` (`sponsorImage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`),
  KEY `IDX_EC809A06B5A459A0` (`news_id`),
  KEY `IDX_EC809A06EA9FDD75` (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `wbb_tag`
--

CREATE TABLE IF NOT EXISTS `wbb_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_style` tinyint(1) DEFAULT NULL,
  `is_occasion` tinyint(1) DEFAULT NULL,
  `is_atmosphere` tinyint(1) DEFAULT NULL,
  `is_alcohol` tinyint(1) DEFAULT NULL,
  `is_cocktail` tinyint(1) DEFAULT NULL,
  `is_mood` tinyint(1) DEFAULT NULL,
  `energy_level` smallint(6) DEFAULT NULL,
  `on_top` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7DCBCAC28BAC62AF` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Contenu de la table `wbb_tag`
--

INSERT INTO `wbb_tag` (`id`, `city_id`, `name`, `is_style`, `is_occasion`, `is_atmosphere`, `is_alcohol`, `is_cocktail`, `is_mood`, `energy_level`, `on_top`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Cocktails', 1, 1, 1, 1, 1, 1, 1, 1, '2014-06-12 13:23:52', '2014-06-12 13:23:52'),
(2, NULL, 'Hotel Bar', 0, 0, 1, 1, 1, 0, 1, 1, '2014-06-12 13:53:46', '2014-06-12 13:53:46'),
(3, NULL, 'Brasserie', 1, 0, 0, 1, 0, 0, 3, 1, '2014-06-12 14:48:40', '2014-06-12 17:32:03'),
(4, NULL, 'Champagne', 1, 1, 1, 1, 1, 1, 2, 1, '2014-06-12 14:55:25', '2014-06-12 14:55:25'),
(5, NULL, 'Friends', 1, 1, 1, 1, 1, 1, 3, 1, '2014-06-12 16:27:59', '2014-06-12 16:27:59'),
(6, NULL, 'A date', 1, 1, 1, 1, 1, 1, 1, 1, '2014-06-12 16:28:37', '2014-06-12 16:28:37'),
(7, NULL, 'Colleagues', 1, 1, 1, 1, 1, 1, 2, 1, '2014-06-12 16:28:47', '2014-06-12 16:28:47'),
(8, NULL, 'A date', 1, 1, 1, 1, 1, 1, 2, 1, '2014-06-12 16:28:59', '2014-06-12 16:28:59'),
(9, NULL, 'test', 1, 1, 1, 1, 1, 1, 2, 1, '2014-06-12 17:31:18', '2014-06-12 17:31:18');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=81 ;

--
-- Contenu de la table `wbb_tip`
--

INSERT INTO `wbb_tip` (`id`, `user_id`, `bar_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(78, 1, NULL, NULL, 1, '2014-06-12 19:47:54', '2014-06-12 19:47:54'),
(79, 1, NULL, NULL, 1, '2014-06-12 19:47:58', '2014-06-12 19:47:58'),
(80, 1, NULL, NULL, 1, '2014-06-12 19:48:01', '2014-06-12 19:48:01');

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
  `latitude` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8C36E53292FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8C36E532A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `wbb_user`
--

INSERT INTO `wbb_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `first_name`, `last_name`, `website`, `description`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'b.hakkari@void.fr', 'b.hakkari@void.fr', 1, 'ax3q23hcsrso88c8wkckcc0o0w8go4o', 'RaLK7kbHRZRUw+b6q9l4qR9O1F6ZR7gVBz8JVFQlPqgyzrQet/q3Uf3pyXbt2+FJP+IdMY8RXyF8MMxM4bHOVA==', '2014-06-13 13:37:39', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, 'Ryan', 'Melon', NULL, NULL, NULL, NULL, '1970-04-26 00:52:35', '2014-06-13 13:37:39'),
(2, 'Moderator', 'moderator', 'moderator@test.fr', 'moderator@test.fr', 1, 'fz6q810hqzkggoggwwgsk0koso44ok0', 'aDO2I8sxAqt/3yu/4ij3ARNN0Ug8YfhT/8Ci3VWn6vv/rqiuMRLeOXw0pIZGTbzevvdaMjshPW4MVGlbIlemRg==', '2014-06-12 12:25:07', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:14:"ROLE_MODERATOR";}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-06-12 12:20:46', '2014-06-12 12:25:07'),
(3, 'Publisher', 'publisher', 'Publisher@test.com', 'publisher@test.com', 1, '3stwfqoc7pk4ggokkgscc4gw4w4okw4', 'GK/xaKRE1bNOubjJ2uoVmeU3HHUxQ4QHisEFJeQ3kl7lR11xd5DlxrpzS0dxzPtvop6BT/V2WkLylL44Weilwg==', '2014-06-12 12:26:54', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:14:"ROLE_PUBLISHER";}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-06-12 12:21:10', '2014-06-12 12:26:54'),
(4, 'Editorial Expert', 'editorial expert', 'Editorial@test.fr', 'editorial@test.fr', 1, '2wh4ozok8m4g0cgg0cs88okggcsg4o4', 'k3Mpg/lB17/nsaYebvUYOGA4CqJuj0kDj4HqYRqzacgd5GYZuYFfvlgFHWf2rkBRqkhmpyfDsb+wTOIEK0BfsA==', '2014-06-12 12:27:10', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:21:"ROLE_EDITORIAL_EXPERT";}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-06-12 12:21:48', '2014-06-12 12:27:10'),
(5, 'Bar Expert', 'bar expert', 'Bar@expert.fr', 'bar@expert.fr', 1, 'r67x3gsz2aokc00wwwoo0ko80k0w8ss', 'F2F4KbyJjCKAf55NTmMhQUUgfyqtoMpVUnN7DFQo5TqkV2EZbHwxC7M8WnYBKr+j6mQygsAo/7LFtJ4G26sdiA==', '2014-06-12 12:27:23', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_BAR_EXPERT";}', 0, NULL, 'Ryan', 'Melon', NULL, NULL, NULL, NULL, '2014-06-12 12:22:21', '2014-06-12 16:28:43'),
(6, 'Bar Owner', 'bar owner', 'bar@owner.com', 'bar@owner.com', 1, '9cbnrx8mc18ogk8k08so8kokkg040gw', 'arZvPt90pzikposrw/r6F24wtmVS0FcoUFkGM5HQQPqC4wzLJo2fq7iWUdGjdlzXEk7h2dvNaBWsD03FwEBsEQ==', '2014-06-12 12:27:52', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:14:"ROLE_BAR_OWNER";}', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-06-12 12:22:54', '2014-06-12 12:27:52');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `media__gallery_media`
--
ALTER TABLE `media__gallery_media`
  ADD CONSTRAINT `FK_80D4C541EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_80D4C5414E7AF8F` FOREIGN KEY (`gallery_id`) REFERENCES `media__gallery` (`id`);

--
-- Contraintes pour la table `wbb_ad`
--
ALTER TABLE `wbb_ad`
  ADD CONSTRAINT `FK_84E111553DA5256D` FOREIGN KEY (`image_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `wbb_bar`
--
ALTER TABLE `wbb_bar`
  ADD CONSTRAINT `FK_8BDF1EB89A253A` FOREIGN KEY (`bar_id`) REFERENCES `wbb_news` (`id`),
  ADD CONSTRAINT `FK_8BDF1EB76C25F1` FOREIGN KEY (`suburb_id`) REFERENCES `wbb_city_suburb` (`id`),
  ADD CONSTRAINT `FK_8BDF1EB8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `wbb_city` (`id`),
  ADD CONSTRAINT `FK_8BDF1EBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `wbb_user` (`id`);

--
-- Contraintes pour la table `wbb_bar_media`
--
ALTER TABLE `wbb_bar_media`
  ADD CONSTRAINT `FK_8C818C355942FEA` FOREIGN KEY (`video2_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_8C818C347218004` FOREIGN KEY (`video1_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_8C818C389A253A` FOREIGN KEY (`bar_id`) REFERENCES `wbb_bar` (`id`),
  ADD CONSTRAINT `FK_8C818C3EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`);

--
-- Contraintes pour la table `wbb_bar_opening`
--
ALTER TABLE `wbb_bar_opening`
  ADD CONSTRAINT `FK_F0EA768E89A253A` FOREIGN KEY (`bar_id`) REFERENCES `wbb_bar` (`id`);

--
-- Contraintes pour la table `wbb_bar_tag`
--
ALTER TABLE `wbb_bar_tag`
  ADD CONSTRAINT `FK_A42A2960BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `wbb_tag` (`id`),
  ADD CONSTRAINT `FK_A42A296089A253A` FOREIGN KEY (`bar_id`) REFERENCES `wbb_bar` (`id`);

--
-- Contraintes pour la table `wbb_bestof`
--
ALTER TABLE `wbb_bestof`
  ADD CONSTRAINT `FK_BAF14BBADD8BC253` FOREIGN KEY (`bestof_id`) REFERENCES `wbb_news` (`id`),
  ADD CONSTRAINT `FK_BAF14BBA8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `wbb_city` (`id`),
  ADD CONSTRAINT `FK_BAF14BBAF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `wbb_country` (`id`);

--
-- Contraintes pour la table `wbb_bestof_bar`
--
ALTER TABLE `wbb_bestof_bar`
  ADD CONSTRAINT `FK_1387D3E1EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `wbb_bar_media` (`id`),
  ADD CONSTRAINT `FK_1387D3E189A253A` FOREIGN KEY (`bar_id`) REFERENCES `wbb_bar` (`id`),
  ADD CONSTRAINT `FK_1387D3E1DD8BC253` FOREIGN KEY (`bestof_id`) REFERENCES `wbb_bestof` (`id`);

--
-- Contraintes pour la table `wbb_bestof_bestof`
--
ALTER TABLE `wbb_bestof_bestof`
  ADD CONSTRAINT `FK_D6D851E5BF1126F0` FOREIGN KEY (`in_bestof_id`) REFERENCES `wbb_bestof` (`id`),
  ADD CONSTRAINT `FK_D6D851E5DD8BC253` FOREIGN KEY (`bestof_id`) REFERENCES `wbb_bestof` (`id`);

--
-- Contraintes pour la table `wbb_bestof_tag`
--
ALTER TABLE `wbb_bestof_tag`
  ADD CONSTRAINT `FK_66F1E8C8BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `wbb_tag` (`id`),
  ADD CONSTRAINT `FK_66F1E8C8DD8BC253` FOREIGN KEY (`bestof_id`) REFERENCES `wbb_bestof` (`id`);

--
-- Contraintes pour la table `wbb_city`
--
ALTER TABLE `wbb_city`
  ADD CONSTRAINT `FK_2CFE314FB5A459A0` FOREIGN KEY (`news_id`) REFERENCES `wbb_news` (`id`),
  ADD CONSTRAINT `FK_2CFE314FF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `wbb_country` (`id`);

--
-- Contraintes pour la table `wbb_city_bestof`
--
ALTER TABLE `wbb_city_bestof`
  ADD CONSTRAINT `FK_505C4395DD8BC253` FOREIGN KEY (`bestof_id`) REFERENCES `wbb_bestof` (`id`),
  ADD CONSTRAINT `FK_505C43958BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `wbb_city` (`id`);

--
-- Contraintes pour la table `wbb_city_suburb`
--
ALTER TABLE `wbb_city_suburb`
  ADD CONSTRAINT `FK_E950F7E18BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `wbb_city` (`id`);

--
-- Contraintes pour la table `wbb_city_tag`
--
ALTER TABLE `wbb_city_tag`
  ADD CONSTRAINT `FK_10DBC965BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `wbb_tag` (`id`),
  ADD CONSTRAINT `FK_10DBC9658BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `wbb_city` (`id`);

--
-- Contraintes pour la table `wbb_country`
--
ALTER TABLE `wbb_country`
  ADD CONSTRAINT `FK_59007C814F34D596` FOREIGN KEY (`ad_id`) REFERENCES `wbb_ad` (`id`);

--
-- Contraintes pour la table `wbb_news`
--
ALTER TABLE `wbb_news`
  ADD CONSTRAINT `FK_1C76AA2BFAF5A804` FOREIGN KEY (`sponsorImage_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_1C76AA2BB5A459A0` FOREIGN KEY (`news_id`) REFERENCES `wbb_user` (`id`);

--
-- Contraintes pour la table `wbb_news_media`
--
ALTER TABLE `wbb_news_media`
  ADD CONSTRAINT `FK_EC809A06EA9FDD75` FOREIGN KEY (`media_id`) REFERENCES `media__media` (`id`),
  ADD CONSTRAINT `FK_EC809A06B5A459A0` FOREIGN KEY (`news_id`) REFERENCES `wbb_news` (`id`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
