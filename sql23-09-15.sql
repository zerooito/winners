-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 26-Set-2015 às 16:40
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `winners`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
`id` int(11) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
`id` int(11) NOT NULL,
  `nome_banner` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `categoria_banner_id` int(11) NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
`id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_banners`
--

CREATE TABLE IF NOT EXISTS `categoria_banners` (
`id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
`id` int(11) NOT NULL,
  `nome1` char(100) DEFAULT NULL,
  `nome2` char(100) DEFAULT NULL,
  `data_de_nascimento` date DEFAULT NULL,
  `documento1` varchar(25) DEFAULT NULL,
  `documento2` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_usuario` varchar(100) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `consultas`
--

CREATE TABLE IF NOT EXISTS `consultas` (
`id` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `hora` varchar(20) DEFAULT NULL,
  `id_usuario` varchar(255) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cores`
--

CREATE TABLE IF NOT EXISTS `cores` (
`id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `cor` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupoms`
--

CREATE TABLE IF NOT EXISTS `cupoms` (
`id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `ativo` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco_cliente_cadastros`
--

CREATE TABLE IF NOT EXISTS `endereco_cliente_cadastros` (
`id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `ativo` int(1) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `endereco` varchar(70) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `forma_pagamentos`
--

CREATE TABLE IF NOT EXISTS `forma_pagamentos` (
`id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grau_de_ocorrencias`
--

CREATE TABLE IF NOT EXISTS `grau_de_ocorrencias` (
`id` int(11) NOT NULL,
  `cor_id` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `grau` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `hieraquias`
--

CREATE TABLE IF NOT EXISTS `hieraquias` (
`id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `id_usuario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lancamento_vendas`
--

CREATE TABLE IF NOT EXISTS `lancamento_vendas` (
`id` int(11) NOT NULL,
  `venda_id` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `valor_pago` int(11) NOT NULL,
  `data_pgt` int(11) NOT NULL,
  `ativo` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

CREATE TABLE IF NOT EXISTS `modulos` (
`id` int(100) NOT NULL,
  `modulo` varchar(50) DEFAULT NULL,
  `nome_modulo` varchar(50) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `padrao` tinyint(1) DEFAULT NULL,
  `funcao` varchar(100) DEFAULT NULL,
  `icone` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulo_relaciona_usuarios`
--

CREATE TABLE IF NOT EXISTS `modulo_relaciona_usuarios` (
`id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `newsletters`
--

CREATE TABLE IF NOT EXISTS `newsletters` (
`id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ocorrencias`
--

CREATE TABLE IF NOT EXISTS `ocorrencias` (
`id` int(11) NOT NULL,
  `grau_ocorrencia_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `parentes`
--

CREATE TABLE IF NOT EXISTS `parentes` (
`id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `login` varchar(60) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
`id` int(11) NOT NULL,
  `id_alias` int(11) DEFAULT NULL,
  `preco` decimal(10,4) DEFAULT NULL,
  `estoque` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `peso_bruto` decimal(10,4) DEFAULT NULL,
  `peso_liquido` decimal(10,4) DEFAULT NULL,
  `id_usuario` varchar(100) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `custo` decimal(10,4) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `subusuarios`
--

CREATE TABLE IF NOT EXISTS `subusuarios` (
  `id` int(11) NOT NULL,
  `id_usuario` varchar(255) DEFAULT NULL,
  `id_hieraquia` int(11) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `ead` tinyint(4) DEFAULT NULL,
  `erp` tinyint(4) DEFAULT NULL,
  `site` tinyint(4) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `variacaos`
--

CREATE TABLE IF NOT EXISTS `variacaos` (
`id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nome_variacao` varchar(50) NOT NULL,
  `estoque` int(11) NOT NULL,
  `ativo` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE IF NOT EXISTS `vendas` (
`id` int(11) NOT NULL,
  `valor` decimal(10,4) DEFAULT NULL,
  `id_alias` int(11) DEFAULT NULL,
  `custo` decimal(10,0) DEFAULT NULL,
  `data_venda` date DEFAULT NULL,
  `data_entrega` date DEFAULT NULL,
  `id_lancamento_financeiro` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_cadastro_situacao_venda` int(11) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda_itens_produtos`
--

CREATE TABLE IF NOT EXISTS `venda_itens_produtos` (
`id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `venda_id` int(11) NOT NULL,
  `quantidade_produto` int(11) NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_banner_usuario_id` (`usuario_id`), ADD KEY `fk_banner_categoria_id` (`categoria_banner_id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_usuario_id` (`usuario_id`);

--
-- Indexes for table `categoria_banners`
--
ALTER TABLE `categoria_banners`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultas`
--
ALTER TABLE `consultas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cores`
--
ALTER TABLE `cores`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cupoms`
--
ALTER TABLE `cupoms`
 ADD PRIMARY KEY (`id`), ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `endereco_cliente_cadastros`
--
ALTER TABLE `endereco_cliente_cadastros`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_id_usuario_endereco` (`id_usuario`), ADD KEY `fk_id_cliente_endereco` (`id_cliente`);

--
-- Indexes for table `forma_pagamentos`
--
ALTER TABLE `forma_pagamentos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grau_de_ocorrencias`
--
ALTER TABLE `grau_de_ocorrencias`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_cor_id` (`cor_id`);

--
-- Indexes for table `hieraquias`
--
ALTER TABLE `hieraquias`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lancamento_vendas`
--
ALTER TABLE `lancamento_vendas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modulos`
--
ALTER TABLE `modulos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modulo_relaciona_usuarios`
--
ALTER TABLE `modulo_relaciona_usuarios`
 ADD PRIMARY KEY (`id`), ADD KEY `fk2_modelo_relaciona_id_modulo` (`id_modulo`), ADD KEY `fk1_usuario_id` (`id_usuario`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
 ADD PRIMARY KEY (`id`), ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `ocorrencias`
--
ALTER TABLE `ocorrencias`
 ADD PRIMARY KEY (`id`), ADD KEY `cliente_id` (`cliente_id`), ADD KEY `fk_grau_ocorrencia_id` (`grau_ocorrencia_id`);

--
-- Indexes for table `parentes`
--
ALTER TABLE `parentes`
 ADD PRIMARY KEY (`id`), ADD KEY `usuario_id` (`usuario_id`), ADD KEY `cliente_id` (`cliente_id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
 ADD PRIMARY KEY (`id`), ADD KEY `categoria_id` (`categoria_id`);

--
-- Indexes for table `subusuarios`
--
ALTER TABLE `subusuarios`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variacaos`
--
ALTER TABLE `variacaos`
 ADD PRIMARY KEY (`id`), ADD KEY `produto_id` (`produto_id`), ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venda_itens_produtos`
--
ALTER TABLE `venda_itens_produtos`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_venda_itens_produtos_1_idx` (`venda_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `categoria_banners`
--
ALTER TABLE `categoria_banners`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `consultas`
--
ALTER TABLE `consultas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cores`
--
ALTER TABLE `cores`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cupoms`
--
ALTER TABLE `cupoms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `endereco_cliente_cadastros`
--
ALTER TABLE `endereco_cliente_cadastros`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `forma_pagamentos`
--
ALTER TABLE `forma_pagamentos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `grau_de_ocorrencias`
--
ALTER TABLE `grau_de_ocorrencias`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hieraquias`
--
ALTER TABLE `hieraquias`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lancamento_vendas`
--
ALTER TABLE `lancamento_vendas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `modulos`
--
ALTER TABLE `modulos`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `modulo_relaciona_usuarios`
--
ALTER TABLE `modulo_relaciona_usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ocorrencias`
--
ALTER TABLE `ocorrencias`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parentes`
--
ALTER TABLE `parentes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `variacaos`
--
ALTER TABLE `variacaos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `venda_itens_produtos`
--
ALTER TABLE `venda_itens_produtos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `banners`
--
ALTER TABLE `banners`
ADD CONSTRAINT `fk_banner_categoria_id` FOREIGN KEY (`categoria_banner_id`) REFERENCES `categoria_banners` (`id`),
ADD CONSTRAINT `fk_banner_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `categorias`
--
ALTER TABLE `categorias`
ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `cupoms`
--
ALTER TABLE `cupoms`
ADD CONSTRAINT `cupoms_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `endereco_cliente_cadastros`
--
ALTER TABLE `endereco_cliente_cadastros`
ADD CONSTRAINT `fk_id_cliente_endereco` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
ADD CONSTRAINT `fk_id_usuario_endereco` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `grau_de_ocorrencias`
--
ALTER TABLE `grau_de_ocorrencias`
ADD CONSTRAINT `fk_cor_id` FOREIGN KEY (`cor_id`) REFERENCES `cores` (`id`);

--
-- Limitadores para a tabela `modulo_relaciona_usuarios`
--
ALTER TABLE `modulo_relaciona_usuarios`
ADD CONSTRAINT `fk1_usuario_id` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
ADD CONSTRAINT `fk2_modelo_relaciona_id_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id`);

--
-- Limitadores para a tabela `newsletters`
--
ALTER TABLE `newsletters`
ADD CONSTRAINT `newsletters_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
ADD CONSTRAINT `fk_grau_ocorrencia_id` FOREIGN KEY (`grau_ocorrencia_id`) REFERENCES `grau_de_ocorrencias` (`id`),
ADD CONSTRAINT `fk_ocorrencias_cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);

--
-- Limitadores para a tabela `parentes`
--
ALTER TABLE `parentes`
ADD CONSTRAINT `parentes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
ADD CONSTRAINT `parentes_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Limitadores para a tabela `variacaos`
--
ALTER TABLE `variacaos`
ADD CONSTRAINT `variacaos_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
ADD CONSTRAINT `variacaos_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `venda_itens_produtos`
--
ALTER TABLE `venda_itens_produtos`
ADD CONSTRAINT `fk_venda_itens_produtos_1` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
