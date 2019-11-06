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
-- Estrutura da tabela `mm_unidades_medida`
--

CREATE TABLE `mm_unidades_medida` (
  `ID_UNIDADE_MEDIDA` int(11) NOT NULL,
  `DESC_UNIDADE_MEDIDA` varchar(255) CHARACTER SET utf8 NOT NULL,
  `SIGLA_UNIDADE_MEDIDA` varchar(30) CHARACTER SET utf8 NOT NULL,
  `STATUS` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mm_unidades_medida`
--

INSERT INTO `mm_unidades_medida` (`ID_UNIDADE_MEDIDA`, `DESC_UNIDADE_MEDIDA`, `SIGLA_UNIDADE_MEDIDA`, `STATUS`) VALUES
(1, 'AMPOLA', 'AMPOLA', 1),
(2, 'BALDE', 'BALDE', 1),
(3, 'BANDEJA', 'BANDEJ', 1),
(4, 'BARRA', 'BARRA', 1),
(5, 'BISNAGA', 'BISNAG', 1),
(6, 'BLOCO', 'BLOCO', 1),
(7, 'BOBINA', 'BOBINA', 1),
(8, 'BOMBONA', 'BOMB', 1),
(9, 'CAPSULA', 'CAPS', 1),
(10, 'CART', 'CARTELA', 1),
(11, 'CENTO', 'CENTO', 1),
(12, 'CONJUNTO', 'CJ', 1),
(13, 'CENTIMETRO', 'CM', 1),
(14, 'CENTIMETRO QUADRADO', 'CM2', 1),
(15, 'CAIXA', 'CX', 1),
(16, 'DUZIA', 'DUZIA', 1),
(17, 'EMBALAGEM', 'EMBAL', 1),
(18, 'FARDO', 'FARDO', 1),
(19, 'FRASCO', 'FRASCO', 1),
(20, 'UNIDADE', 'UNID', 1),
(21, 'SACO', 'SACO', 1),
(22, 'PEÇA', 'PC', 1),
(23, 'QUILOGRAMA', 'KG', 1),
(24, 'KIT', 'KIT', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mm_unidades_medida`
--
ALTER TABLE `mm_unidades_medida`
  ADD PRIMARY KEY (`ID_UNIDADE_MEDIDA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mm_unidades_medida`
--
ALTER TABLE `mm_unidades_medida`
  MODIFY `ID_UNIDADE_MEDIDA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
