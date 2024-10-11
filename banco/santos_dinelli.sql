-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 11-Out-2024 às 00:42
-- Versão do servidor: 8.0.30
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `santos_dinelli`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int NOT NULL,
  `tipo_pessoa` int DEFAULT NULL,
  `nome_cliente` varchar(100) DEFAULT NULL,
  `email_cliente` varchar(100) DEFAULT NULL,
  `cpf_cliente` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `bairro` varchar(115) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `cidade` varchar(115) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `complemento` varchar(115) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `forma_pagamento` varchar(50) DEFAULT NULL,
  `razao_social` varchar(100) DEFAULT NULL,
  `email_cliente_pj` varchar(100) DEFAULT NULL,
  `cnpj` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telefone_pj` varchar(15) DEFAULT NULL,
  `endereco_pj` varchar(255) DEFAULT NULL,
  `cep_pj` varchar(10) DEFAULT NULL,
  `referencia_pj` varchar(100) DEFAULT NULL,
  `bairro_pj` varchar(115) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cidade_pj` varchar(115) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `complemento_pj` varchar(115) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `forma_pagamento_pj` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `tipo_pessoa`, `nome_cliente`, `email_cliente`, `cpf_cliente`, `data_nascimento`, `telefone`, `endereco`, `bairro`, `cep`, `cidade`, `complemento`, `forma_pagamento`, `razao_social`, `email_cliente_pj`, `cnpj`, `telefone_pj`, `endereco_pj`, `cep_pj`, `referencia_pj`, `bairro_pj`, `cidade_pj`, `complemento_pj`, `forma_pagamento_pj`) VALUES
(48, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dadas', 'ddadas@gmail.com', '45.435.345/3535-43', '(41) 2341-3423', 'das', '33213-133', 'da', 'dad', 'da', 'dad', NULL),
(49, 1, 'leo', 'leodudasd@gmail.com', '433.242.344-42', '1111-11-11', '(12) 31321-3123', 'dasdada', 'dada', '32131-231', 'dada', 'dadad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 1, 'leo', 'leodudasd@gmail.com', '433.242.344-42', '0111-11-11', '(11) 11111-1111', '111111111111dasd', 'dsadasda', '11111-111', 'dasdsad', 'asdasdasda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dsad', 'ddadada@gmail.com', '43.324.234/2342-34', '(23) 4523-4321', 'dasdasd', '33213-133', 'adasd', 'adad', 'asd', 'adasd', NULL),
(52, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dsad', 'ddadada@gmail.com', '43.324.234/2342-34', '(23) 4523-4321', 'dasdasd', '33213-133', 'adasd', 'adad', 'asd', 'adasd', NULL),
(53, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dadas', 'ddadada@gmail.com', '45.435.345/3535-43', '(41) 2341-3423', 'das', '33213-133', 'da', 'dad', 'da', 'dad', 'boleto'),
(54, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dadas', 'ddadada@gmail.com', '45.435.345/3535-43', '(41) 2341-3423', 'das', '33213-133', 'da', 'dad', 'da', 'dad', 'boleto'),
(55, 1, 'leo', 'leodudasd@gmail.com', '433.242.344-42', '1111-11-11', '(32) 14123-4233', 'dasdadadasd', 'asdasd', '32131-231', 'asdadsa', 'dadasda', 'Dinheiro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `title` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `obs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `servico` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`, `obs`, `servico`) VALUES
(101, 'Etec Heliópolis – Arquiteto Ruy Ohtake', '#FF4500', '2024-10-03 13:00:00', '2024-10-03 18:20:00', 'Apresentação pré banca', 'Visita'),
(103, 'Etec Heliópolis – Arquiteto Ruy Ohtake', '#40E0D0', '2024-10-02 14:00:00', '2024-10-02 14:30:00', 'Levar maquininha', 'Visita'),
(104, 'Aline', '#228B22', '2024-10-09 11:00:00', '2024-10-09 11:11:00', 'ada', 'Higienização'),
(105, 'Izael', '#1C1C1C', '2024-10-16 13:00:00', '2024-10-16 14:30:00', 'Verificar gás', 'Desinstalação');

-- --------------------------------------------------------

--
-- Estrutura da tabela `financas`
--

CREATE TABLE `financas` (
  `id` int NOT NULL,
  `mes` varchar(20) NOT NULL,
  `recebimento` decimal(10,2) NOT NULL,
  `despesa` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `financas`
--

INSERT INTO `financas` (`id`, `mes`, `recebimento`, `despesa`) VALUES
(25, 'Janeiro', 1.00, 1.00),
(26, 'Julho', 17.00, 17.00),
(27, 'Março', 46.00, 80.00),
(28, 'Maio', 80.00, 50.00),
(29, 'Dezembro', 100.00, 12.00),
(30, 'Junho', 20.00, 20.00),
(31, 'Setembro', 544.00, 244.00),
(32, 'Fevereiro', 24.00, 24.00),
(33, 'Abril', 51.00, 32.00),
(34, 'Novembro', 10.00, 5.00),
(35, 'Outubro', 300.00, 100.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nome` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha_usuario` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_autenticacao` int DEFAULT NULL,
  `data_codigo_autenticacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `senha_usuario`, `codigo_autenticacao`, `data_codigo_autenticacao`) VALUES
(1, 'Gabriel Braga', 'gabrielbraga1324@gmail.com', '$2y$10$/8h3zj2her/0yPi77XGj0OWJBOSdTLdzrep/m6tq3iYSisH49ZsQe', NULL, NULL),
(2, 'Matheus Estevam', 'matheusoliveirale2007@gmail.com', '$2y$10$W6svxbrsCZ4LAOGnkV13iepjTtomS5.2tnEZR/cNl2SsnkTYAUeBm', 286873, '2024-10-01 10:00:33'),
(3, 'Castellinho', 'isabellasilvestrecastellon@gmail.com', '$2y$10$V98pJibds2bCSOT2bHCsg.dmF9Xb/07LAFx1jC9c2nLeSYzzU.GIS', NULL, NULL),
(4, 'Leonardo Dinelli', 'leodinelli2007@gmail.com', '$2y$10$QjiKQ3IKJ95BL1pGwBQYSeMzvn9SH8gVpfmVHMQIEfMvXr/zacohe', NULL, NULL),
(5, 'Henrick Gomes', 'henrickgomes46@gmail.com', '$2y$10$sKSYqTve.IP8KM9YqcCTf.jEaZMdXu1Lvm3z.VGzrg.od./srVwh6', 260643, '2024-09-27 10:10:05'),
(6, 'Matheus Ribeiro', 'matheusribeiro2409@outlook.com ', '$2y$10$eIaKTCE3Y.P.src/1C2pF.7dml6VAd0bE09SOr4rir0.VFfVt2XAi', 630028, '2024-09-27 10:15:30');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `financas`
--
ALTER TABLE `financas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de tabela `financas`
--
ALTER TABLE `financas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
