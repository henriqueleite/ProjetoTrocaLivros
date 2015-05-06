-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06-Maio-2015 às 16:37
-- Versão do servidor: 5.6.20
-- PHP Version: 5.5.15

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
  `V_MENSAGEM` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_livro`
--

CREATE TABLE IF NOT EXISTS `categoria_livro` (
`N_COD_CATEGORIA` int(11) NOT NULL,
  `V_GENERO` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `categoria_livro`
--

INSERT INTO `categoria_livro` (`N_COD_CATEGORIA`, `V_GENERO`) VALUES
(1, 'Comédia'),
(2, 'Drama'),
(4, 'Ficcão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
`N_COD_COMENTARIO` int(11) NOT NULL,
  `V_AVALIACAO` varchar(5) DEFAULT NULL,
  `V_COMENTARIO` varchar(255) DEFAULT NULL,
  `N_COD_USUARIO_IE` int(11) DEFAULT NULL,
  `N_COD_LIVRO_IE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE IF NOT EXISTS `livro` (
`N_COD_LIVRO` int(11) NOT NULL,
  `V_FOTO` varchar(300) DEFAULT NULL,
  `V_TITULO` varchar(50) DEFAULT NULL,
  `V_AUTOR` varchar(50) DEFAULT NULL,
  `V_EDITORA` varchar(50) DEFAULT NULL,
  `V_ESTADO_LIVRO` varchar(50) DEFAULT NULL,
  `D_ANO` varchar(10) DEFAULT NULL,
  `V_OBSERVACAO` varchar(255) DEFAULT NULL,
  `N_COD_CATEGORIA_IE` int(11) DEFAULT NULL,
  `N_COD_USUARIO_IE` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`N_COD_LIVRO`, `V_FOTO`, `V_TITULO`, `V_AUTOR`, `V_EDITORA`, `V_ESTADO_LIVRO`, `D_ANO`, `V_OBSERVACAO`, `N_COD_CATEGORIA_IE`, `N_COD_USUARIO_IE`) VALUES
(20, 'FotoLivroUsuario/4b934ba32b279b2ef62e092cbe3c4b73.jpg', 'O guardiao ', 'Joe Hill', 'James, E L', 'Novo', '2012', 'Muito bom o livro', 4, 7),
(22, 'FotoLivroUsuario/bafab7b2d83961ddabbaf9278fbefd07.jpg', 'Folhas Caidas', 'Joe Hill', 'James, E L', 'Acabadi', '2001', 'Muito engraçado', 1, 8);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `troca`
--

CREATE TABLE IF NOT EXISTS `troca` (
`N_COD_TROCA` int(11) NOT NULL,
  `N_COD_USUARIO_IE` int(11) DEFAULT NULL,
  `N_COD_LIVRO_SOLICITANTE` int(11) DEFAULT NULL,
  `D_DATA_FINALIZOU` date DEFAULT NULL,
  `B_ATIVO` varchar(1) DEFAULT NULL,
  `V_AVALIACAO_TROCA` varchar(255) DEFAULT NULL,
  `V_MENSAGEM_TROCA` varchar(255) DEFAULT NULL,
  `D_DATA_MENSAGEM` datetime DEFAULT NULL,
  `D_DATA` datetime DEFAULT NULL,
  `V_STATUS` varchar(15) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `troca`
--

INSERT INTO `troca` (`N_COD_TROCA`, `N_COD_USUARIO_IE`, `N_COD_LIVRO_SOLICITANTE`, `D_DATA_FINALIZOU`, `B_ATIVO`, `V_AVALIACAO_TROCA`, `V_MENSAGEM_TROCA`, `D_DATA_MENSAGEM`, `D_DATA`, `V_STATUS`) VALUES
(2, 7, 22, NULL, NULL, NULL, NULL, NULL, '2015-05-06 00:00:00', 'Aceito');

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
  `B_ATIVO` varchar(1) DEFAULT NULL,
  `D_DATA_CADASTRO` datetime DEFAULT NULL,
  `D_DATA_ULTIMO_LOGIN` datetime DEFAULT NULL,
  `V_FOTO` varchar(300) DEFAULT NULL,
  `V_IDADE` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`N_COD_USUARIO`, `V_NOME`, `V_LOGIN`, `V_SENHA`, `V_EMAIL`, `V_CPF`, `V_TELEFONE`, `V_CELULAR`, `V_CIDADE`, `V_BAIRRO`, `V_UF`, `V_CEP`, `N_TIPO_USUARIO`, `B_ATIVO`, `D_DATA_CADASTRO`, `D_DATA_ULTIMO_LOGIN`, `V_FOTO`, `V_IDADE`) VALUES
(7, 'victor', 'victor', '123', 'victorbernardo_@hotmail.com', '050.692.994-92', '', '', '', '', '', '55817-200', 0, 'T', '2015-05-04 00:00:00', '2015-05-06 11:13:25', 'FotoPerfilUsuario/654c1ed7dbbced131e02b036026637de.jpg', 21),
(8, 'Luiz', 'luiz', '123', 'luiz@hotmail.com', '233.296.704-44', '', '', '', '', '', '55817-200', 0, 'T', '2015-05-05 00:00:00', '2015-05-06 11:12:49', NULL, 23);

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
 ADD PRIMARY KEY (`N_COD_COMENTARIO`), ADD KEY `N_COD_LIVRO_IE` (`N_COD_LIVRO_IE`), ADD KEY `N_COD_USUARIO_IE` (`N_COD_USUARIO_IE`);

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
-- Indexes for table `troca`
--
ALTER TABLE `troca`
 ADD PRIMARY KEY (`N_COD_TROCA`), ADD KEY `N_COD_USUARIO_IE` (`N_COD_USUARIO_IE`), ADD KEY `N_COD_LIVRO_SOLICITANTE` (`N_COD_LIVRO_SOLICITANTE`);

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
MODIFY `N_COD_AJUDA` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categoria_livro`
--
ALTER TABLE `categoria_livro`
MODIFY `N_COD_CATEGORIA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
MODIFY `N_COD_COMENTARIO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `livro`
--
ALTER TABLE `livro`
MODIFY `N_COD_LIVRO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `livro_desejado`
--
ALTER TABLE `livro_desejado`
MODIFY `N_COD_LIVRO_DESEJADO` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `troca`
--
ALTER TABLE `troca`
MODIFY `N_COD_TROCA` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `N_COD_USUARIO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
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
ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`N_COD_LIVRO_IE`) REFERENCES `livro` (`N_COD_LIVRO`),
ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`N_COD_USUARIO_IE`) REFERENCES `usuario` (`N_COD_USUARIO`);

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
ADD CONSTRAINT `troca_ibfk_1` FOREIGN KEY (`N_COD_USUARIO_IE`) REFERENCES `usuario` (`N_COD_USUARIO`),
ADD CONSTRAINT `troca_ibfk_2` FOREIGN KEY (`N_COD_LIVRO_SOLICITANTE`) REFERENCES `livro` (`N_COD_LIVRO`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
