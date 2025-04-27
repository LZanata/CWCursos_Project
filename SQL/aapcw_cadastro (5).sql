-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 27, 2025 at 09:56 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aapcw_cadastro`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificados`
--

DROP TABLE IF EXISTS `certificados`;
CREATE TABLE IF NOT EXISTS `certificados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `curso_id` int DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  `data_assinatura` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `curso_id` (`curso_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_curso` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  `duracao` int DEFAULT NULL,
  `status` enum('pendente','aprovado','reprovado') COLLATE utf8mb4_general_ci DEFAULT 'pendente',
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imagem` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cursos`
--

INSERT INTO `cursos` (`id`, `nome_curso`, `descricao`, `duracao`, `status`, `data_criacao`, `imagem`, `video_url`) VALUES
(1, 'Curso de SEO', 'Aprenda as melhores práticas de SEO para otimizar sites.', 1, 'aprovado', '2024-09-27 16:21:50', 'seoavançado.png', 'TtuloSEO.mp4'),
(2, 'Curso de Marketing de Conteúdo', 'Curso sobre como criar e distribuir conteúdo que engaja.', 1, 'aprovado', '2024-09-27 16:21:50', 'Marketingdeconteudo_curso.png', 'https://www.youtube.com/watch?v=Marketing1'),
(3, 'Curso de Mídias Sociais', 'Domine as estratégias para gerenciar redes sociais.', 1, 'aprovado', '2024-09-27 16:21:50', 'cursodeMidiasDigitais_curso.png', 'https://www.youtube.com/watch?v=Midias1'),
(4, 'Curso de Introdução ao MKT', 'Conceitos básicos de marketing para iniciantes.', 1, 'aprovado', '2024-09-27 16:21:50', 'intmktdigital.png', 'https://www.youtube.com/watch?v=MKT1'),
(5, 'Curso de Redes Sociais', 'Curso avançado para uso prático das redes.', 1, 'aprovado', '2024-09-27 16:21:50', 'mktemredessociasi.png', 'https://www.youtube.com/watch?v=Redes1');

-- --------------------------------------------------------

--
-- Table structure for table `fotos_perfil`
--

DROP TABLE IF EXISTS `fotos_perfil`;
CREATE TABLE IF NOT EXISTS `fotos_perfil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `caminho_foto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `data_upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professores_voluntarios`
--

DROP TABLE IF EXISTS `professores_voluntarios`;
CREATE TABLE IF NOT EXISTS `professores_voluntarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `rg` varchar(12) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `experiencia` text COLLATE utf8mb4_general_ci NOT NULL,
  `area_conhecimento` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `disponibilidade` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `curriculo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_inscricao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professores_voluntarios`
--

INSERT INTO `professores_voluntarios` (`id`, `nome`, `cpf`, `rg`, `data_nascimento`, `endereco`, `email`, `telefone`, `linkedin`, `experiencia`, `area_conhecimento`, `disponibilidade`, `curriculo`, `data_inscricao`) VALUES
(1, 'Matheus Garcia Bertoi', '46193010866', '501183620', '2005-05-16', 'Rua Werner Goldberg 157', 'matheusbertoi09@gmail.com', '11 988533778', 'https://www.linkedin.com/in/matheus-garcia-bertoi-70052128a/', '0', '0', '0', 'uploads/curriculos/MatheusGBertoi_RelatorioIndividua.pdf', '2024-10-31 19:02:28'),
(2, 'Fernando Gonsales Garcia', '41274892734', '340270431', '2005-05-16', 'Rua Werner Goldberg 157', 'fafa@gmail.com', '11 988533778', 'https://www.linkedin.com/in/matheus-garcia-bertoi-70052128a/', '0', '0', '0', 'uploads/curriculos/RelatorioIndividual_MatheusGBertoi01.pdf', '2024-10-31 19:09:20'),
(3, 'Almeida Junior', '32332323233', '252345454', '2005-05-16', 'Rua Werner Goldberg 157', 'almeidinha@gmail.com', '11 988533778', 'https://www.linkedin.com/in/matheus-garcia-bertoi-70052128a/', '3 anos na área.', 'SEO avançado', '40', 'uploads/curriculos/Calendario-Academico-2o-semestre-de-2024.pdf', '2024-11-02 00:28:22'),

-- --------------------------------------------------------

--
-- Table structure for table `respostas_tickets`
--

DROP TABLE IF EXISTS `respostas_tickets`;
CREATE TABLE IF NOT EXISTS `respostas_tickets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ticket_id` int NOT NULL,
  `resposta` text COLLATE utf8mb4_general_ci NOT NULL,
  `data_resposta` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `assunto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mensagem` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Aberto','Em andamento','Fechado') COLLATE utf8mb4_general_ci DEFAULT 'Aberto',
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'images/default_profile.jpg',
  `data_nascimento` date DEFAULT NULL,
  `tipo` enum('aluno','professor','administrador') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'aluno',
  `status` enum('ativo','pendente','bloqueado') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'ativo',
  `reset_token_hash` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `usuario` (`usuario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `email`, `senha`, `photo`, `data_nascimento`, `tipo`, `status`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(1, 'Matheus Garcia Bertoi adm', 'MatheusADM', 'matheusbertoi@cwadm.com', '123456', 'images/default_profile.jpg', '2005-05-16', 'administrador', 'ativo', NULL, NULL),
(7, 'Cristiane Garcia Bertoi', 'Cristiane01', 'cris09@cwprof.com', '123456', 'images/default_profile.jpg', '1978-08-21', 'professor', 'ativo', NULL, NULL),
(18, 'Matheus Garcia Bertoi', 'MatGa', 'matheusbertoi09@gmail.com', '$2y$10$v134Ad5R8d24L9WLiwD7S.c5ODjz9loa3sezWZD5ImxBV4/anGldC', 'uploads/imgcapaexemplo.jpg', NULL, 'aluno', 'ativo', NULL, NULL),
(19, 'Jonathas Yoshioka', 'Jonathas01', 'jonathasolsen@gmail.com', '$2y$10$pG/2knsNJEA8XxUIRwzQC.M0FzI0M3RF6yWAdX59P9q3PvHC8gZ/.', 'uploads/membrojonathans.jpeg', NULL, 'aluno', 'ativo', NULL, NULL),
(33, 'Jonathas Yoshioka Olsen', 'Jonathas Adm', 'jonathasyoshioka@cwadm.com', '$2y$10$s9O3nCZBIyAipGonWsRzeOiO8eGAmfLCIjCuH1QpVyD.NwtRX8KQK', 'images/default_profile.jpg', '2005-06-01', 'administrador', 'ativo', NULL, NULL),
(34, 'João Almeida Junior', 'Junior01', 'joaojunior01@gmail.com', '$2y$10$XbI3yIX2GhSPNbxBJz2qAOgU.obHScrPAl2dU3YQum132cBR.s4n6', 'uploads/1707685002137.jpeg', '2005-05-16', 'aluno', 'ativo', NULL, NULL),
(42, 'Leonardo Zanata de Jesus', 'LeoZanata', 'leonardozana19@gmail.com', '$2y$10$nfH8z7UoXzAGOoSIbKBgk.yfs9UxMlUrjgca4.EnHKmtVCpFc66pW', 'images/default_profile.jpg', '2003-11-18', 'administrador', 'ativo', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificados`
--
ALTER TABLE `certificados`
  ADD CONSTRAINT `certificados_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `certificados_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fotos_perfil`
--
ALTER TABLE `fotos_perfil`
  ADD CONSTRAINT `fotos_perfil_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;