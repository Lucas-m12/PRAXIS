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
-- Estrutura da tabela `mm_status_pedido`
--

CREATE TABLE `mm_status_pedido` (
  `ID_STATUS` int(11) NOT NULL,
  `TIPO_STATUS` varchar(50) CHARACTER SET utf8 NOT NULL,
  `DESC_STATUS` varchar(50) DEFAULT NULL,
  `COR` varchar(50) DEFAULT NULL,
  `STATUS` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mm_status_pedido`
--

INSERT INTO `mm_status_pedido` (`ID_STATUS`, `TIPO_STATUS`, `DESC_STATUS`, `COR`, `STATUS`) VALUES
(1, 'DISPONÍVEL', 'PEDIDO CRIADO E NÃO ENTREGUE AO FORNECEDOR', '#5bc0de', 1),
(2, 'PENDENTE', 'PEDIDO ENTREGUE AO FORNECEDOR', '#f0ad4e', 1),
(3, 'FINALIZADO', 'PEDIDO RECEBIDO', '#5cb85c', 1),
(4, 'CANCELADO', 'PEDIDO CANCELADO PELA CENTRAL', '#d9534f', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mm_status_pedido`
--
ALTER TABLE `mm_status_pedido`
  ADD PRIMARY KEY (`ID_STATUS`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mm_status_pedido`
--
ALTER TABLE `mm_status_pedido`
  MODIFY `ID_STATUS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
