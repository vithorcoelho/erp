-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04-Fev-2019 às 03:33
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `erp_clientes`
--

CREATE TABLE `erp_clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `celular` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `erp_fluxocaixa`
--

CREATE TABLE `erp_fluxocaixa` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `valor` varchar(55) NOT NULL,
  `data` date NOT NULL,
  `tipo` varchar(55) NOT NULL,
  `SKU` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `erp_listavendas`
--

CREATE TABLE `erp_listavendas` (
  `id` int(11) NOT NULL,
  `produto` varchar(255) NOT NULL,
  `quantidade` varchar(255) NOT NULL,
  `preco` varchar(255) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `chave` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `erp_produtos`
--



-- --------------------------------------------------------

--
-- Estrutura da tabela `erp_vendas`
--



--
-- Indexes for dumped tables
--

--
-- Indexes for table `erp_clientes`
--
ALTER TABLE `erp_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_fluxocaixa`
--
ALTER TABLE `erp_fluxocaixa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_listavendas`
--
ALTER TABLE `erp_listavendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_produtos`
--
ALTER TABLE `erp_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_vendas`
--
ALTER TABLE `erp_vendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `erp_clientes`
--
ALTER TABLE `erp_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_fluxocaixa`
--
ALTER TABLE `erp_fluxocaixa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_listavendas`
--
ALTER TABLE `erp_listavendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_produtos`
--
ALTER TABLE `erp_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `erp_vendas`
--
ALTER TABLE `erp_vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
