-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14-Maio-2015 às 05:17
-- Versão do servidor: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trocalivro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ajuda`
--

CREATE TABLE IF NOT EXISTS `ajuda` (
  `N_COD_AJUDA` int(11) NOT NULL,
  `N_COD_USUARIO_IE` int(11) DEFAULT NULL,
  `V_TITULO` varchar(30) DEFAULT NULL,
  `V_TIPO` varchar(15) DEFAULT NULL,
  `V_MENSAGEM` varchar(255) DEFAULT NULL,
  `N_COD_RESPOSTA` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ajuda`
--

INSERT INTO `ajuda` (`N_COD_AJUDA`, `N_COD_USUARIO_IE`, `V_TITULO`, `V_TIPO`, `V_MENSAGEM`, `N_COD_RESPOSTA`) VALUES
(1, NULL, 'novamensagem', '1', 'asdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasda', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_livro`
--

CREATE TABLE IF NOT EXISTS `categoria_livro` (
  `N_COD_CATEGORIA` int(11) NOT NULL,
  `V_GENERO` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria_livro`
--

INSERT INTO `categoria_livro` (`N_COD_CATEGORIA`, `V_GENERO`) VALUES
(1, 'Comédia'),
(2, 'Drama'),
(3, 'Ficcão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `N_COD_COMENTARIO` int(11) NOT NULL,
  `V_AVALIACAO` varchar(5) DEFAULT NULL,
  `V_COMENTARIO` varchar(255) DEFAULT NULL,
  `N_COD_USUARIO_IE` int(11) DEFAULT NULL,
  `N_COD_LIVRO_IE` int(11) DEFAULT NULL,
  `D_DATA` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE IF NOT EXISTS `livro` (
  `N_COD_LIVRO` int(11) NOT NULL,
  `V_FOTO` varchar(100) DEFAULT NULL,
  `V_TITULO` varchar(50) DEFAULT NULL,
  `V_AUTOR` varchar(50) DEFAULT NULL,
  `V_ESTADO_LIVRO` varchar(50) DEFAULT NULL,
  `V_ANO` varchar(10) DEFAULT NULL,
  `V_OBSERVACAO` varchar(255) DEFAULT NULL,
  `N_COD_CATEGORIA_IE` int(11) DEFAULT NULL,
  `N_COD_USUARIO_IE` int(11) DEFAULT NULL,
  `V_EDITORA` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`N_COD_LIVRO`, `V_FOTO`, `V_TITULO`, `V_AUTOR`, `V_ESTADO_LIVRO`, `V_ANO`, `V_OBSERVACAO`, `N_COD_CATEGORIA_IE`, `N_COD_USUARIO_IE`, `V_EDITORA`) VALUES
(37, 'FotoLivroUsuario/ea203192fcdc3c26ceebe73000fb0579.jpg', 'A casa na lama', 'Xico', 'Novo', '2015', 'N curti', 3, 13, 'Olinda'),
(38, 'FotoLivroUsuario/075f0ab736aef0f1aaa19afff31e1c21.jpg', 'A volta dos que não foram', 'abrham lincom', 'lindo', '2015', 'muito bom', 1, 14, 'nova editora'),
(39, 'FotoLivroUsuario/da43ec5f06d7d9ddf61b1f75ba5695ad.jpg', 'Folhas Caidas', 'José Neves', 'Novo', '2015', 'Mais ou Menos', 1, 15, 'Roma');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro_desejado`
--

CREATE TABLE IF NOT EXISTS `livro_desejado` (
  `N_COD_LIVRO_DESEJADO` int(11) NOT NULL,
  `V_TITULO` varchar(50) DEFAULT NULL,
  `D_ANO` int(11) DEFAULT NULL,
  `N_COD_CATEGORIA_IE` int(11) DEFAULT NULL,
  `N_COD_USUARIO_IE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens_troca`
--

CREATE TABLE IF NOT EXISTS `mensagens_troca` (
  `N_COD_MENSAGENS_TROCA` int(11) NOT NULL,
  `N_COD_TROCA_IE` int(11) DEFAULT NULL,
  `V_MENSAGEM` varchar(255) DEFAULT NULL,
  `N_USUARIO_DE` int(11) DEFAULT NULL,
  `N_USUARIO_PARA` int(11) DEFAULT NULL,
  `D_DATA_MENSAGEM` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `troca`
--

CREATE TABLE IF NOT EXISTS `troca` (
  `N_COD_TROCA` int(11) NOT NULL,
  `N_COD_LIVRO` int(11) DEFAULT NULL,
  `N_COD_LIVRO_SOLICITANTE` int(11) DEFAULT NULL,
  `D_DATA_FINALIZOU` date DEFAULT NULL,
  `B_ATIVO` varchar(1) DEFAULT NULL,
  `V_AVALIACAO_TROCA` varchar(255) DEFAULT NULL,
  `V_AVALIACAO_TROCA_SOLICITANTE` varchar(255) DEFAULT NULL,
  `D_DATA` datetime DEFAULT NULL,
  `V_STATUS` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `N_COD_USUARIO` int(11) NOT NULL,
  `V_NOME` varchar(70) DEFAULT NULL,
  `V_LOGIN` varchar(18) DEFAULT NULL,
  `V_SENHA` varchar(18) DEFAULT NULL,
  `V_EMAIL` varchar(50) DEFAULT NULL,
  `V_CPF` varchar(15) DEFAULT NULL,
  `V_TELEFONE` varchar(15) DEFAULT NULL,
  `V_CELULAR` varchar(15) DEFAULT NULL,
  `V_CIDADE` varchar(30) DEFAULT NULL,
  `V_BAIRRO` varchar(50) DEFAULT NULL,
  `V_UF` varchar(2) DEFAULT NULL,
  `V_CEP` varchar(15) DEFAULT NULL,
  `N_TIPO_USUARIO` int(11) DEFAULT NULL,
  `B_ATIVO` varchar(1) DEFAULT 'T',
  `D_DATA_CADASTRO` datetime DEFAULT NULL,
  `D_DATA_ULTIMO_LOGIN` datetime DEFAULT NULL,
  `V_FOTO` varchar(300) DEFAULT NULL,
  `V_IDADE` int(11) DEFAULT NULL,
  `V_SEXO` varchar(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`N_COD_USUARIO`, `V_NOME`, `V_LOGIN`, `V_SENHA`, `V_EMAIL`, `V_CPF`, `V_TELEFONE`, `V_CELULAR`, `V_CIDADE`, `V_BAIRRO`, `V_UF`, `V_CEP`, `N_TIPO_USUARIO`, `B_ATIVO`, `D_DATA_CADASTRO`, `D_DATA_ULTIMO_LOGIN`, `V_FOTO`, `V_IDADE`, `V_SEXO`) VALUES
(13, 'danilo', 'danilo', '123', 'danilo@hotmail..com', '809.371.219-40', '81-9989-6623', '81-3431-2885', 'Olinda', 'RIO DOCE', 'PE', '53150-430', 0, 'T', '2015-05-09 00:00:00', '2015-05-11 00:08:14', NULL, 12, 'M'),
(14, 'bruno', 'duel325', 'b8807008136', 'bruno.jo.gos@hotmail.com', '771.538.725-82', '', '', '', '', '', '54470-040', 0, 'T', '2015-05-11 00:00:00', '2015-05-11 23:47:38', NULL, 20, 'M'),
(15, 'thiago', 'thiago', '123', 'thiagotol@hotmail.com', '873.648.389-37', '', '', '', '', '', '54470-040', 0, 'T', '2015-05-12 00:00:00', '2015-05-11 19:57:24', NULL, 20, 'M'),
(16, 'aaa', 'duel3252', '1234', 'aaa@hotmial.com', '433.173.451-01', '', '', '', '', '', '54470-040', 0, 'T', '2015-05-12 00:00:00', '2015-05-12 00:00:00', NULL, 20, 'M');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ajuda`
--
ALTER TABLE `ajuda`
  ADD PRIMARY KEY (`N_COD_AJUDA`), ADD KEY `N_COD_USUARIO_IE` (`N_COD_USUARIO_IE`);

--
-- Indexes for table `categoria_livro`
--
ALTER TABLE `categoria_livro`
  ADD PRIMARY KEY (`N_COD_CATEGORIA`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`N_COD_COMENTARIO`), ADD KEY `N_COD_USUARIO_IE` (`N_COD_USUARIO_IE`), ADD KEY `N_COD_LIVRO_IE` (`N_COD_LIVRO_IE`);

--
-- Indexes for table `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`N_COD_LIVRO`), ADD KEY `N_COD_CATEGORIA_IE` (`N_COD_CATEGORIA_IE`), ADD KEY `N_COD_USUARIO_IE` (`N_COD_USUARIO_IE`);

--
-- Indexes for table `livro_desejado`
--
ALTER TABLE `livro_desejado`
  ADD PRIMARY KEY (`N_COD_LIVRO_DESEJADO`), ADD KEY `N_COD_CATEGORIA_IE` (`N_COD_CATEGORIA_IE`), ADD KEY `N_COD_USUARIO_IE` (`N_COD_USUARIO_IE`);

--
-- Indexes for table `mensagens_troca`
--
ALTER TABLE `mensagens_troca`
  ADD PRIMARY KEY (`N_COD_MENSAGENS_TROCA`);

--
-- Indexes for table `troca`
--
ALTER TABLE `troca`
  ADD PRIMARY KEY (`N_COD_TROCA`), ADD KEY `N_COD_LIVRO` (`N_COD_LIVRO`), ADD KEY `N_COD_LIVRO_SOLICITANTE` (`N_COD_LIVRO_SOLICITANTE`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`N_COD_USUARIO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ajuda`
--
ALTER TABLE `ajuda`
  MODIFY `N_COD_AJUDA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categoria_livro`
--
ALTER TABLE `categoria_livro`
  MODIFY `N_COD_CATEGORIA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `N_COD_COMENTARIO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `livro`
--
ALTER TABLE `livro`
  MODIFY `N_COD_LIVRO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `livro_desejado`
--
ALTER TABLE `livro_desejado`
  MODIFY `N_COD_LIVRO_DESEJADO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mensagens_troca`
--
ALTER TABLE `mensagens_troca`
  MODIFY `N_COD_MENSAGENS_TROCA` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `troca`
--
ALTER TABLE `troca`
  MODIFY `N_COD_TROCA` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `N_COD_USUARIO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `ajuda`
--
ALTER TABLE `ajuda`
ADD CONSTRAINT `ajuda_ibfk_1` FOREIGN KEY (`N_COD_USUARIO_IE`) REFERENCES `usuario` (`N_COD_USUARIO`);

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`N_COD_USUARIO_IE`) REFERENCES `usuario` (`N_COD_USUARIO`),
ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`N_COD_LIVRO_IE`) REFERENCES `livro` (`N_COD_LIVRO`);

--
-- Limitadores para a tabela `livro`
--
ALTER TABLE `livro`
ADD CONSTRAINT `livro_ibfk_1` FOREIGN KEY (`N_COD_CATEGORIA_IE`) REFERENCES `categoria_livro` (`N_COD_CATEGORIA`),
ADD CONSTRAINT `livro_ibfk_2` FOREIGN KEY (`N_COD_USUARIO_IE`) REFERENCES `usuario` (`N_COD_USUARIO`);

--
-- Limitadores para a tabela `livro_desejado`
--
ALTER TABLE `livro_desejado`
ADD CONSTRAINT `livro_desejado_ibfk_1` FOREIGN KEY (`N_COD_CATEGORIA_IE`) REFERENCES `categoria_livro` (`N_COD_CATEGORIA`),
ADD CONSTRAINT `livro_desejado_ibfk_2` FOREIGN KEY (`N_COD_USUARIO_IE`) REFERENCES `usuario` (`N_COD_USUARIO`);

--
-- Limitadores para a tabela `troca`
--
ALTER TABLE `troca`
ADD CONSTRAINT `troca_ibfk_1` FOREIGN KEY (`N_COD_LIVRO`) REFERENCES `livro` (`N_COD_LIVRO`),
ADD CONSTRAINT `troca_ibfk_2` FOREIGN KEY (`N_COD_LIVRO_SOLICITANTE`) REFERENCES `livro` (`N_COD_LIVRO`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
