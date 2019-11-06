-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06-Nov-2019 às 17:07
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
-- Estrutura da tabela `mm_pedidos_fornecedor`
--

CREATE TABLE `mm_pedidos_fornecedor` (
  `ID_PEDIDO` int(11) NOT NULL,
  `CODIGO_PEDIDO` int(20) NOT NULL,
  `CODIGO_FORNECEDOR` int(11) NOT NULL,
  `ID_PROGRAMA` int(11) NOT NULL,
  `DATA_PEDIDO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATA_ENVIO` date DEFAULT NULL,
  `DATA_RECEBIMENTO` date DEFAULT NULL,
  `STATUS` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mm_pedidos_fornecedor`
--
ALTER TABLE `mm_pedidos_fornecedor`
  ADD PRIMARY KEY (`ID_PEDIDO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mm_pedidos_fornecedor`
--
ALTER TABLE `mm_pedidos_fornecedor`
  MODIFY `ID_PEDIDO` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
