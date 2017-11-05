-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: winners
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `asaas`
--

DROP TABLE IF EXISTS `asaas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asaas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `api_key` varchar(100) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_new_table_1_idx` (`usuario_id`),
  CONSTRAINT `fk_new_table_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_banner` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `categoria_banner_id` int(11) NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_banner_usuario_id` (`usuario_id`),
  KEY `fk_banner_categoria_id` (`categoria_banner_id`),
  CONSTRAINT `fk_banner_categoria_id` FOREIGN KEY (`categoria_banner_id`) REFERENCES `categoria_banners` (`id`),
  CONSTRAINT `fk_banner_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `blings`
--

DROP TABLE IF EXISTS `blings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `api_key` varchar(100) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `caixas`
--

DROP TABLE IF EXISTS `caixas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caixas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `valor_inicial` float DEFAULT NULL,
  `data_abertura` date DEFAULT NULL,
  `data_fechamento` date DEFAULT NULL,
  `valor_final_total` float DEFAULT NULL,
  `valor_final_cartao` float DEFAULT NULL,
  `valor_final_dinheiro` float DEFAULT NULL,
  `valor_final_outros` float DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index2` (`usuario_id`),
  KEY `index3` (`ativo`),
  CONSTRAINT `fk_caixas_userid` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categoria_banners`
--

DROP TABLE IF EXISTS `categoria_banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id` (`usuario_id`),
  CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome1` char(100) DEFAULT NULL,
  `nome2` char(100) DEFAULT NULL,
  `data_de_nascimento` date DEFAULT NULL,
  `documento1` varchar(25) DEFAULT NULL,
  `documento2` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_usuario` varchar(100) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `asaas_id` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `consultas`
--

DROP TABLE IF EXISTS `consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `hora` varchar(20) DEFAULT NULL,
  `id_usuario` varchar(255) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cores`
--

DROP TABLE IF EXISTS `cores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `cor` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cupoms`
--

DROP TABLE IF EXISTS `cupoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cupoms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `cupoms_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `endereco_cliente_cadastros`
--

DROP TABLE IF EXISTS `endereco_cliente_cadastros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco_cliente_cadastros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `ativo` int(1) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `endereco` varchar(70) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_usuario_endereco` (`id_usuario`),
  KEY `fk_id_cliente_endereco` (`id_cliente`),
  CONSTRAINT `fk_id_cliente_endereco` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `fk_id_usuario_endereco` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `forma_pagamentos`
--

DROP TABLE IF EXISTS `forma_pagamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_pagamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fornecedores_usuario_id` (`usuario_id`),
  CONSTRAINT `fk_fornecedores_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `grau_de_ocorrencias`
--

DROP TABLE IF EXISTS `grau_de_ocorrencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grau_de_ocorrencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cor_id` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `grau` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cor_id` (`cor_id`),
  CONSTRAINT `fk_cor_id` FOREIGN KEY (`cor_id`) REFERENCES `cores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hieraquias`
--

DROP TABLE IF EXISTS `hieraquias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hieraquias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `id_usuario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `imagens`
--

DROP TABLE IF EXISTS `imagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `alt` varchar(100) DEFAULT NULL,
  `order` int(4) DEFAULT NULL,
  `usuario_id` varchar(45) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `arquivo` varchar(100) DEFAULT NULL,
  `produto_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index4` (`arquivo`),
  KEY `index2` (`usuario_id`),
  KEY `index3` (`ativo`),
  KEY `fk_imagens_1_idx` (`produto_id`),
  CONSTRAINT `fk_imagens_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lancamento_categorias`
--

DROP TABLE IF EXISTS `lancamento_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lancamento_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `lancamento_categoriascol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lancamento_categorias_1_idx` (`usuario_id`),
  CONSTRAINT `fk_lancamento_categorias_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lancamento_vendas`
--

DROP TABLE IF EXISTS `lancamento_vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lancamento_vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venda_id` int(11) DEFAULT NULL,
  `valor` float NOT NULL,
  `valor_pago` float NOT NULL,
  `data_pgt` date NOT NULL,
  `ativo` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `forma_pagamento` varchar(40) DEFAULT NULL,
  `lancamento_categoria_id` int(11) DEFAULT NULL,
  `data_vencimento` date DEFAULT NULL,
  `fornecedore_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lancamento_vendas_1_idx` (`venda_id`),
  KEY `fk_lancamento_vendas_2_idx` (`lancamento_categoria_id`),
  KEY `fk_lancamento_vendas_3_idx` (`fornecedore_id`),
  KEY `fk_lancamento_vendas_4_idx` (`lancamento_categoria_id`),
  CONSTRAINT `fk_lancamento_vendas_1` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lancamento_vendas_2` FOREIGN KEY (`lancamento_categoria_id`) REFERENCES `lancamento_categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lancamento_vendas_3` FOREIGN KEY (`fornecedore_id`) REFERENCES `fornecedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lancamento_vendas_4` FOREIGN KEY (`lancamento_categoria_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6385 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `modulo_relaciona_usuarios`
--

DROP TABLE IF EXISTS `modulo_relaciona_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulo_relaciona_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk2_modelo_relaciona_id_modulo` (`id_modulo`),
  KEY `fk1_usuario_id` (`id_usuario`),
  CONSTRAINT `fk1_usuario_id` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk2_modelo_relaciona_id_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `modulo` varchar(50) DEFAULT NULL,
  `nome_modulo` varchar(50) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `padrao` tinyint(1) DEFAULT NULL,
  `funcao` varchar(100) DEFAULT NULL,
  `icone` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `newsletters_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ocorrencias`
--

DROP TABLE IF EXISTS `ocorrencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ocorrencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grau_ocorrencia_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `fk_grau_ocorrencia_id` (`grau_ocorrencia_id`),
  CONSTRAINT `fk_grau_ocorrencia_id` FOREIGN KEY (`grau_ocorrencia_id`) REFERENCES `grau_de_ocorrencias` (`id`),
  CONSTRAINT `fk_ocorrencias_cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parentes`
--

DROP TABLE IF EXISTS `parentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `login` varchar(60) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `ativo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `cliente_id` (`cliente_id`),
  CONSTRAINT `parentes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `parentes_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `categoria_id` int(11) DEFAULT NULL,
  `sku` varchar(40) DEFAULT NULL,
  `quantidade_minima` int(11) DEFAULT NULL,
  `destaque` tinyint(1) NOT NULL,
  `preco_promocional` decimal(10,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2511 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `queue_products`
--

DROP TABLE IF EXISTS `queue_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `queue_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caminho` varchar(255) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `processado` tinyint(4) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_queue_usuario_id` (`usuario_id`) USING BTREE,
  CONSTRAINT `fk_queue_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subusuarios`
--

DROP TABLE IF EXISTS `subusuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subusuarios` (
  `id` int(11) NOT NULL,
  `id_usuario` varchar(255) DEFAULT NULL,
  `id_hieraquia` int(11) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `ead` tinyint(4) DEFAULT NULL,
  `erp` tinyint(4) DEFAULT NULL,
  `site` tinyint(4) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `estoque_minimo` int(4) DEFAULT NULL,
  `sale_without_stock` tinyint(1) DEFAULT NULL,
  `loja` varchar(100) NOT NULL,
  `layout_loja` varchar(100) NOT NULL,
  `cep_origem` varchar(15) NOT NULL,
  `descricao` text NOT NULL,
  `token_pagseguro` varchar(50) NOT NULL,
  `loja_active` tinyint(1) NOT NULL,
  `email_pagseguro` varchar(30) NOT NULL,
  `folder_view` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `variacaos`
--

DROP TABLE IF EXISTS `variacaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variacaos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nome_variacao` varchar(50) NOT NULL,
  `estoque` int(11) NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `venda_itens_produtos`
--

DROP TABLE IF EXISTS `venda_itens_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venda_itens_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `venda_id` int(11) NOT NULL,
  `quantidade_produto` int(11) NOT NULL,
  `ativo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_venda_itens_produtos_1_idx` (`venda_id`),
  CONSTRAINT `fk_venda_itens_produtos_1` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11743 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vendas`
--

DROP TABLE IF EXISTS `vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,4) DEFAULT NULL,
  `id_alias` int(11) DEFAULT NULL,
  `custo` decimal(10,0) DEFAULT NULL,
  `data_venda` date DEFAULT NULL,
  `data_entrega` date DEFAULT NULL,
  `id_lancamento_financeiro` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_cadastro_situacao_venda` int(11) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT NULL,
  `orcamento` tinyint(1) DEFAULT NULL,
  `desconto` decimal(10,0) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `asaas_boleto` varchar(100) DEFAULT NULL,
  `asaas_status` varchar(40) DEFAULT NULL,
  `asaas_transaction_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vendas_cliente_idx` (`cliente_id`),
  CONSTRAINT `fk_vendas_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6466 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-05 12:15:39
INSERT INTO `winners`.`admins` (`login`, `senha`, `ativo`) VALUES ('email@email.com', '123456', '1');