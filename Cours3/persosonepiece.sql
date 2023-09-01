-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 01 Septembre 2023 à 14:38
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `persosonepiece`
--

-- --------------------------------------------------------

--
-- Structure de la table `persosonepiece`
--

CREATE TABLE `persosonepiece` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prime` double NOT NULL,
  `image` varchar(1500) NOT NULL,
  `equipage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Contenu de la table `persosonepiece`
--

INSERT INTO `persosonepiece` (`id`, `nom`, `prime`, `image`, `equipage`) VALUES
(2, 'Roronoa Zoro', 1111000000, 'https://orig00.deviantart.net/df2c/f/2016/131/9/7/roronoa_zoro___one_piece_by_enrestoxd-da253hn.jpg', 'Chapeau de paille'),
(3, 'Sanji', 1032000000, 'https://images8.alphacoders.com/100/thumb-1920-1002981.png', 'Chapeau de paille'),
(4, 'Marchalls D. Teach', 3996000000, 'https://th.bing.com/th/id/OIP.cJnDeKV3_gkPg5-z-mMMnQHaEK?pid=ImgDet&rs=1', 'Pirates de Barbe noire'),
(6, 'Marco2', 1374000000, 'https://i.pinimg.com/736x/b7/9a/22/b79a22893d912a876f7ea1f231394368.jpg', 'Pirates de Barbe blanche'),
(7, 'Chopper', 1000, 'https://th.bing.com/th/id/R.007a6324a8c1ec7faa4a07cf54e7d832?rik=X%2f97n04TmwtwfQ&amp;riu=http%3a%2f%2fvignette1.wikia.nocookie.net%2ffairyonepiecetail%2fimages%2fe%2fed%2fAnimepaper_net_vector_standard_anime_one_piece_2yl_tony_tony_chopper_218677_hao_sama_preview-ede19200.jpg%2frevision%2flatest%3fcb%3d20130719134927&amp;ehk=hnncT4%2bf01F%2b2dG%2fnX2XjJ8IpuPhMP2FwS2Pl%2fZZ8EY%3d&amp;risl=&amp;pid=ImgRaw&amp;r=0', 'Chapeau de paille'),
(8, 'Koby', 0, 'https://th.bing.com/th/id/R.0d03bb8aa1d3c23f919fea747636ba4f?rik=dsDOYOc5T6m3fA&amp;riu=http%3a%2f%2f1.bp.blogspot.com%2f-cRQgdb0Y_Ec%2fTh6epBEv2hI%2fAAAAAAAAAH8%2f_3cj1I6leRs%2fs1600%2fcoby.jpg&amp;ehk=LC1FdZF4EZX81C3qnl%2b9pyG%2fVuA4oTy1XFjwH%2fDaVig%3d&amp;risl=&amp;pid=ImgRaw&amp;r=0', 'Marine'),
(13, 'Nico Robin', 88000000, 'https://th.bing.com/th/id/R.9e8e842869f67533cf5d5d2e32c4c6c6?rik=V5yQRy80fR3rQA&amp;riu=http%3a%2f%2fwallpapercave.com%2fwp%2fayE6Rkc.jpg&amp;ehk=dxHUYb5R1Xi2v1PApT7VluJxWnZ1%2b5Rd6UOOMlajASQ%3d&amp;risl=&amp;pid=ImgRaw&amp;r=0', 'Chapeau de paille'),
(16, 'Luffy', 30000000, 'https://phobiacures.info/blog/wp-content/uploads/2009/12/test.jpg', 'Chapeau de paille');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `persosonepiece`
--
ALTER TABLE `persosonepiece`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `persosonepiece`
--
ALTER TABLE `persosonepiece`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
