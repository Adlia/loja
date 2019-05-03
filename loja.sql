-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03-Maio-2019 às 06:03
-- Versão do servidor: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartoes_credito`
--

CREATE TABLE `cartoes_credito` (
  `id` int(10) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `titular` varchar(255) NOT NULL,
  `usuario_id` int(10) NOT NULL,
  `bandeira` enum('MASTER','VISA','HIPER','ELO') NOT NULL,
  `validade` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cartoes_credito`
--

INSERT INTO `cartoes_credito` (`id`, `numero`, `titular`, `usuario_id`, `bandeira`, `validade`) VALUES
(1, '12939039403', 'maravilhosa', 2, 'HIPER', '05/19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `geek` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `descricao`, `geek`) VALUES
(1, 'AnÃ©is ', 'Anel ', 0),
(2, 'Colares', 'Ouro', 0),
(3, 'Pulseiras', 'Banhadas a ouro', 0),
(4, 'Brincos', 'Pedras preciosas', 0),
(5, 'Vingadores', 'JÃ³ias do Infinito', 1),
(6, 'Harry Potter', 'ouro', 1),
(7, 'Game Of Thrones', 'Got', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(10) NOT NULL,
  `data_status` date NOT NULL,
  `status` enum('APROVACAO','PAGO','ENVIADO','ENTREGUE','CANCELADO') NOT NULL,
  `total` decimal(6,2) NOT NULL DEFAULT '0.00',
  `parcelas` int(2) NOT NULL DEFAULT '1',
  `metodo_pagamento` enum('BOLETO','CARTAO') NOT NULL,
  `boleto_numero` varchar(255) DEFAULT NULL,
  `usuario_id` int(10) NOT NULL,
  `cartao_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `data_status`, `status`, `total`, `parcelas`, `metodo_pagamento`, `boleto_numero`, `usuario_id`, `cartao_id`) VALUES
(1, '2019-05-03', 'PAGO', '2000.00', 2, 'BOLETO', '174517115155130603134624181419', 2, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(10) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `preco` varchar(10) NOT NULL,
  `quantidade` int(4) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `categoria_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `quantidade`, `imagem`, `categoria_id`) VALUES
(1, 'Anel de Brilhantes', 'Anel 18k com diamantes raros', '2000', 12, 'download.jpg', 1),
(2, 'Anel coraÃ§Ã£o', 'anel coraÃ§Ã£o ouro 18k com 100 pedras diamantes', '2345', 2, 'S_13927-MLB103814049_2648-O.jpg', 1),
(3, 'Anel em Ouro Amarelo', 'Anel Ouro Amarelo Oval 60 Pedras', '3683', 5, 'Anel-Ouro-Amarelo-Oval-60-Pedras-30-Pts.webp', 1),
(4, 'Gargantilha ', 'Gargantilha de ouro com pedras', '399', 2, 'images.png', 2),
(5, 'Gargantilha CoraÃ§Ã£o', 'Gargantilha coraÃ§Ã£o', '483', 2, 'gargantilha-de-ouro-com-coracao.jpeg', 2),
(6, 'Brinco de Ouro', 'Brinco de Ouro 18K Feminino Longo com Elos', '579', 2, 'brinco-feminino-ouro-elos-micheletti-joias-mi22474-2.png', 4),
(7, 'Brinco Grande', 'Brinco Feminino Grande Ouro 18K', '254', 5, 'd54c12f1b754467498e81e73240c9339.jpg', 4),
(8, 'Pulseira de Ouro', 'Pulseira de Ouro 18K Elo PortuguÃªs com Pingentes 19cm', '120', 6, 'pulseira_43_.jpg', 3),
(9, 'Pulseira Bolinhas', 'Pulseira Feminina Delicada De Bolinhas Folheado Ouro 18k', '57', 3, 'images.jpg', 3),
(10, 'Pulseira Manopla do Infinito', 'Banhada a ouro', '568', 15, 'Filme-Os-Vingadores-3-Infinito-Guerra-Gem-Energia-Pulseira-Infinito-Guerra-Estrela-Principal-Josh-James-Brolin.jpg', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_pedido`
--

CREATE TABLE `produtos_pedido` (
  `pedido_id` int(10) NOT NULL,
  `produto_id` int(10) NOT NULL,
  `quantidade` int(4) NOT NULL,
  `total` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos_pedido`
--

INSERT INTO `produtos_pedido` (`pedido_id`, `produto_id`, `quantidade`, `total`) VALUES
(1, 1, 1, '2000.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nivel` enum('ADMIN','CLIENTE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `nome`, `endereco`, `cpf`, `email`, `nivel`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'endereço', '000.000.000-00', 'admin@admin.com', 'ADMIN'),
(2, 'linda', 'e10adc3949ba59abbe56e057f20f883e', 'AdÃ©lia Lopes', 'Rua JoÃ£o Carlota ', '131.967.974-90', 'lopes.adelia03@gmail.com', 'CLIENTE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartoes_credito`
--
ALTER TABLE `cartoes_credito`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`),
  ADD KEY `USUARIO_FK` (`usuario_id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `USUARIO_FK2` (`usuario_id`),
  ADD KEY `CARTAO_FK` (`cartao_id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CATEGORIA_FK` (`categoria_id`);

--
-- Indexes for table `produtos_pedido`
--
ALTER TABLE `produtos_pedido`
  ADD PRIMARY KEY (`pedido_id`,`produto_id`),
  ADD KEY `PRODUTO_FK` (`produto_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartoes_credito`
--
ALTER TABLE `cartoes_credito`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `cartoes_credito`
--
ALTER TABLE `cartoes_credito`
  ADD CONSTRAINT `USUARIO_FK` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `CARTAO_FK` FOREIGN KEY (`cartao_id`) REFERENCES `cartoes_credito` (`id`),
  ADD CONSTRAINT `USUARIO_FK2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `CATEGORIA_FK` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Limitadores para a tabela `produtos_pedido`
--
ALTER TABLE `produtos_pedido`
  ADD CONSTRAINT `PEDIDO_FK` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `PRODUTO_FK` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
