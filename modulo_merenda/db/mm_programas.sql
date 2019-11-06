-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06-Nov-2019 às 17:08
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `educapela`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `mm_programas`
--

CREATE TABLE `mm_programas` (
  `ID_PROGRAMA` int(11) NOT NULL,
  `DESC_PROGRAMA` varchar(255) DEFAULT NULL,
  `STATUS` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mm_programas`
--

INSERT INTO `mm_programas` (`ID_PROGRAMA`, `DESC_PROGRAMA`, `STATUS`) VALUES
(1, 'PNAIC', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mm_programas`
--
ALTER TABLE `mm_programas`
  ADD PRIMARY KEY (`ID_PROGRAMA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mm_programas`
--
ALTER TABLE `mm_programas`
  MODIFY `ID_PROGRAMA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
