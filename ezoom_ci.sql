-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 29/07/2020 às 17:52
-- Versão do servidor: 10.4.11-MariaDB
-- Versão do PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ezoom_ci`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(44) NOT NULL,
  `slug` varchar(44) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `slug`) VALUES
(1, 'Paisajes', 'paisajes'),
(2, 'Animales', 'animales'),
(3, 'Automoviles', 'automoviles'),
(4, 'Figuras 3D', 'figuras-3d'),
(5, 'Espacio', 'espacio'),
(6, 'Mujeres Famosas', 'mujeres-famosas'),
(9, 'Peliculas', 'peliculas'),
(10, 'Celulares', 'celulares'),
(11, 'Computación', 'computacion'),
(12, 'Programación', 'programacion'),
(13, 'Nalgas Peludas', 'nalgas-peludas'),
(14, 'Teste', 'teste');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(44) NOT NULL,
  `slug` varchar(44) NOT NULL,
  `imagem` varchar(50) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `cursos`
--

INSERT INTO `cursos` (`id`, `titulo`, `slug`, `imagem`, `categoria_id`, `descricao`) VALUES
(26, 'Aquele que esta acima de todos os clãs', 'aquele-que-esta-acima-de-todos-os-clas', 'e4dcd67a9897592550b91689b984319c.jpg', 1, 'Escanor Pecado do Orgulho TESTE'),
(27, 'ESCANOR', 'escanor', 'd9372dd6bab7ed41c8b9cddf435717d1.jpg', 1, 'TESTE');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos_imagens`
--

CREATE TABLE `cursos_imagens` (
  `id` int(11) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `curso_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `cursos_imagens`
--

INSERT INTO `cursos_imagens` (`id`, `imagem`, `curso_id`) VALUES
(9, '0dc966537fee880ab2fba935b4b98baa.jpg', '26'),
(11, '90f364f52567d6d4039d796b2acde20e.jpg', '25'),
(12, '97dfb96ccb3f079521e126c5c33093de.jpg', '27'),
(14, '3d357b51aec2aac1138809e1766ed4d5.jpg', '26');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(80) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `password`, `nome`) VALUES
(1, 'admin@example.com', 'e10adc3949ba59abbe56e057f20f883e', 'William');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nome`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `titulo` (`titulo`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Índices de tabela `cursos_imagens`
--
ALTER TABLE `cursos_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `cursos_imagens`
--
ALTER TABLE `cursos_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
