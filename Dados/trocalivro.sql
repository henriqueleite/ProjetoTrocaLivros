-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28-Maio-2015 às 19:33
-- Versão do servidor: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trocalivro2`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `ajuda`
--

INSERT INTO `ajuda` (`N_COD_AJUDA`, `N_COD_USUARIO_IE`, `V_TITULO`, `V_TIPO`, `V_MENSAGEM`, `N_COD_RESPOSTA`) VALUES
(1, 14, 'novamensagem', '1', 'asdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasda', 1),
(2, NULL, 'NOVO', '1', 'asdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdaasdasdasdasdasdasdasd', 1),
(3, 17, 'teste bruno', 'Dúvida', 'novamensagem', NULL),
(4, 17, '', '', '', NULL),
(5, 17, '', '', '', NULL),
(6, NULL, 'RE-', 'Dúvida', '', 0),
(7, NULL, 'RE-', '', '', 0),
(8, NULL, 'RE-', '', '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_livro`
--

CREATE TABLE IF NOT EXISTS `categoria_livro` (
`N_COD_CATEGORIA` int(11) NOT NULL,
  `V_GENERO` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`N_COD_LIVRO`, `V_FOTO`, `V_TITULO`, `V_AUTOR`, `V_ESTADO_LIVRO`, `V_ANO`, `V_OBSERVACAO`, `N_COD_CATEGORIA_IE`, `N_COD_USUARIO_IE`, `V_EDITORA`) VALUES
(37, 'FotoLivroUsuario/c82f9896a409dc13e505ddbbf103b9f5.jpg', 'A casa na lama', 'Xico', 'Novo', '2015', 'N curti', 3, 13, 'Olinda'),
(38, 'FotoLivroUsuario/031c9bdb39c7f9a96a48e197a09b9fa9.jpg', 'A volta dos que não foram', 'abrham lincom', 'lindo', '2015', 'muito bom', 1, 14, 'nova editora'),
(39, 'FotoLivroUsuario/da43ec5f06d7d9ddf61b1f75ba5695ad.jpg', 'Folhas Caidas', 'José Neves', 'Novo', '2015', 'Mais ou Menos', 1, 15, 'Roma'),
(40, 'FotoLivroUsuario/031c9bdb39c7f9a96a48e197a09b9fa9.jpg', 'HARRY POTTER', 'C. J. ABRAMS', 'Novo', '2007', 'Muito bom', 3, 17, 'LUMIA'),
(48, 'FotoLivroUsuario/ed19d7d7d98a83b9e9766e9709417b1c.jpg', 'O EXORCISTA', 'DENIS LENZ', 'NOVO', '2012', '', 1, 33, 'DENIS LENZ');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `livro_desejado`
--

INSERT INTO `livro_desejado` (`N_COD_LIVRO_DESEJADO`, `V_TITULO`, `D_ANO`, `N_COD_CATEGORIA_IE`, `N_COD_USUARIO_IE`) VALUES
(1, 'NOVO LIVRO', 2015, 2, 14),
(2, 'JOGOS VORAZES', 2015, 3, 18);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `mensagens_troca`
--

INSERT INTO `mensagens_troca` (`N_COD_MENSAGENS_TROCA`, `N_COD_TROCA_IE`, `V_MENSAGEM`, `N_USUARIO_DE`, `N_USUARIO_PARA`, `D_DATA_MENSAGEM`) VALUES
(1, 1, 'ASDAD', 14, NULL, NULL),
(2, 2, 'ASFFF', 14, NULL, NULL),
(3, 2, 'FASD', 14, NULL, NULL),
(8, 2, 'das', 14, NULL, NULL),
(9, 2, 'das', 14, NULL, NULL),
(10, 2, 'asdas', 14, NULL, NULL),
(11, 2, 'aease', 14, NULL, NULL),
(12, 1, 'OLÁ', 13, NULL, NULL),
(13, 1, 'asdas', 13, NULL, NULL),
(14, 1, 'asdasdasd', 13, NULL, NULL),
(15, 2, 'asdas', 13, NULL, NULL),
(16, 2, 'dddd', 13, NULL, NULL),
(17, 1, 'aa', 13, NULL, NULL),
(18, 2, 'adas', 13, NULL, NULL),
(19, 2, 'ADSA', 13, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `troca`
--

INSERT INTO `troca` (`N_COD_TROCA`, `N_COD_LIVRO`, `N_COD_LIVRO_SOLICITANTE`, `D_DATA_FINALIZOU`, `B_ATIVO`, `V_AVALIACAO_TROCA`, `V_AVALIACAO_TROCA_SOLICITANTE`, `D_DATA`, `V_STATUS`) VALUES
(1, 37, 38, NULL, 'T', NULL, NULL, '2015-05-14 00:00:00', 'PENDENTE'),
(2, 38, 37, NULL, NULL, NULL, NULL, '2015-05-19 00:00:00', 'ACEITO'),
(3, 37, 39, NULL, NULL, NULL, NULL, '2015-05-25 00:00:00', 'Pendente'),
(4, 37, 39, NULL, NULL, NULL, NULL, '2015-05-25 00:00:00', 'Pendente'),
(5, 39, 37, NULL, NULL, NULL, NULL, '2015-05-25 00:00:00', 'Pendente'),
(6, 40, 39, NULL, NULL, NULL, NULL, '2015-05-25 00:00:00', 'Pendente');

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
  `V_SEXO` varchar(1) DEFAULT NULL,
  `D_DATA_NASC` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`N_COD_USUARIO`, `V_NOME`, `V_LOGIN`, `V_SENHA`, `V_EMAIL`, `V_CPF`, `V_TELEFONE`, `V_CELULAR`, `V_CIDADE`, `V_BAIRRO`, `V_UF`, `V_CEP`, `N_TIPO_USUARIO`, `B_ATIVO`, `D_DATA_CADASTRO`, `D_DATA_ULTIMO_LOGIN`, `V_FOTO`, `V_SEXO`, `D_DATA_NASC`) VALUES
(13, 'danilo', 'danilo', '123', 'danilo@hotmail..com', '809.371.219-40', '81-9989-6623', '81-3431-2885', 'Olinda', 'RIO DOCE', 'PE', '53150-430', 0, 'T', '2015-05-09 00:00:00', '2015-05-24 20:18:07', '../FotoPerfilUsuario/b407363cc7dca931120cffe17bb17f2a.jpg', 'M', '1998-01-19'),
(14, 'bruno', 'duel325', 'b8807008136', 'bruno.jo.gos@hotmail.com', '771.538.725-82', '', '', '', '', '', '54470-040', 0, 'T', '2015-05-11 00:00:00', '2015-05-24 15:37:16', '../FotoPerfilUsuario/e174d2fa41b043ba7ea5f2f3161b47df.jpg', 'M', '1995-01-19'),
(15, 'thiago', 'thiago', '123', 'thiagotol@hotmail.com', '873.648.389-37', '', '', '', '', '', '54470-040', 0, 'T', '2015-05-12 00:00:00', '2015-05-24 20:18:52', NULL, 'M', '0000-00-00'),
(17, 'ADMIN', 'admin', 'admin', 'admin@hotmail.com', '485.521.325-08', '', '', '', '', '', '54470-040', 1, 'T', '2015-05-16 00:00:00', '2015-05-17 13:52:20', NULL, 'M', '0000-00-00'),
(18, 'BRUNO', 'bruno', '123', 'bruno@hotmail.com', '750.468.746-44', '81-3478-5807', '81-9578-2171', 'JABOATãO DOS GUARARAPES', 'BARRA DE JANGADA', 'PE', '54470-040', 0, 'T', '2015-05-16 00:00:00', '2015-05-15 20:18:11', NULL, 'M', '0000-00-00'),
(33, 'VICTOR', 'victor', '123', 'victorbernardo_@hotmail.com', '050.692.994-92', '', '', '', '', '', '55817-200', 0, 'T', '2015-05-28 00:00:00', NULL, '../FotoPerfilUsuario/f44bb220efa8c26b9d1ecadcb570d549.jpg', 'M', '1990-12-24');

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
MODIFY `N_COD_AJUDA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
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
MODIFY `N_COD_LIVRO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `livro_desejado`
--
ALTER TABLE `livro_desejado`
MODIFY `N_COD_LIVRO_DESEJADO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mensagens_troca`
--
ALTER TABLE `mensagens_troca`
MODIFY `N_COD_MENSAGENS_TROCA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `troca`
--
ALTER TABLE `troca`
MODIFY `N_COD_TROCA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `N_COD_USUARIO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
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
