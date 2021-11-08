-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 08, 2021 at 12:14 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `proprietaire`
--

DROP TABLE IF EXISTS `proprietaire`;
CREATE TABLE IF NOT EXISTS `proprietaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proprietaire`
--

INSERT INTO `proprietaire` (`id`, `nom`, `prenom`, `email`, `tel`, `password`) VALUES
(1, 'Mforen', 'Assiatou', 'assiatoumforen@gmail.com', 'O752814982', NULL),
(2, 'toto', 'titi', 'totios@gmail.com', '0758236459', NULL),
(3, 'DIAKITE', 'SOUMAILA', 'soumdiakite182@gmail.com', '0767988610', '$2y$10$UkcCpljLrx9/b3dvkIfD0enwfe9jwfn1.b0Jha28gnsXc.KhbessG'),
(11, 'DOUMBIA', 'ABDOUL AZIZ', 'soum.diakite@outlook.com', '0556058826', '$2y$10$.kGKebQ5qd4uo0tQgLhcf.32E855zN9GmDljrImCnYN8Cs5tbaKRa'),
(12, 'AAAAA', 'BBBBBB', 'aaa@gmail.com', '456789', '$2y$10$L47f6qkelDk3m4g3k0K8g.STArdP4cdmwVcYhSpjFPjr3w19cLdFa'),
(13, 'qqqq', 'uuuuu', 'aaab@gmail.com', '45678', '$2y$10$PaPpEhVrGoCQgceM.QnELOH27Uy/9LQ.gCqB1ocFE2obcVmMWHU7W');

-- --------------------------------------------------------

--
-- Table structure for table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE IF NOT EXISTS `vehicule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plaque` varchar(20) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `id_proprietaire` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plaque` (`plaque`),
  KEY `id_proprietaire` (`id_proprietaire`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicule`
--

INSERT INTO `vehicule` (`id`, `plaque`, `nom`, `type`, `id_proprietaire`, `photo`) VALUES
(4, 'MH 0124 7', 'Range', 'Personnelle', 12, 'MH 0124 7.jpg'),
(5, 'PG 7687', 'MercÃ©s', 'Benz', 12, 'PG 7687.png');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `vehicule_ibfk_1` FOREIGN KEY (`id_proprietaire`) REFERENCES `proprietaire` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
