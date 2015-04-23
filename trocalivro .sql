-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 23-Abr-2015 às 21:02
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
-- Estrutura da tabela `livro`
--

CREATE TABLE IF NOT EXISTS `livro` (
`IdLivro` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `NomeLivro` varchar(60) NOT NULL,
  `Autor` varchar(30) NOT NULL,
  `Editora` varchar(30) NOT NULL,
  `Idioma` varchar(30) NOT NULL,
  `Ano` varchar(10) NOT NULL,
  `Foto` varchar(300) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`IdLivro`, `IdUsuario`, `NomeLivro`, `Autor`, `Editora`, `Idioma`, `Ano`, `Foto`) VALUES
(54, 5, 'A passagem', 'Justin Cronin', 'Justin Cronin', 'Portugues', '2010', 'LivrosUsuario/Apassagem.jpg'),
(55, 5, 'A Janela de Overton', 'Glenn Beck', 'Glenn Beck', 'Portugues', '2011', 'LivrosUsuario/Ajaneladeoverton.jpg'),
(56, 6, 'Circulo Secreto', 'Lisa Jane Smith', 'Lisa Jane Smith', 'Portugues', '2012', 'LivrosUsuario/Circulosecreto.jpg'),
(57, 6, 'Eu Sei o Que Você Está Pensando', 'John Verdon', 'John Verdon', 'Portugues', '2013', 'LivrosUsuario/Eusei.jpg'),
(58, 7, 'Folhas Caídas', 'Thomas H. Cook', 'Thomas H. Cook', 'Portugues', '2014', 'LivrosUsuario/Folhascaidas.jpg'),
(59, 7, 'O Guardião', 'Nicholas Sparks', 'Nicholas Sparks', 'Portugues', '2015', 'LivrosUsuario/OGuardiao.jpg'),
(60, 6, 'a estrada da noite', 'Joe Hill', 'Joe Hill', 'Portugues', '2009', 'LivrosUsuario/b38f69da6e304533dc5eaf3c3cc34d72.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`IdUsuario` int(11) NOT NULL,
  `Nome` varchar(70) NOT NULL,
  `Login` varchar(18) NOT NULL,
  `Senha` varchar(18) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Cpf` varchar(15) NOT NULL,
  `Telefone` varchar(15) DEFAULT NULL,
  `Celular` varchar(15) DEFAULT NULL,
  `Cep` varchar(15) NOT NULL,
  `Uf` varchar(2) DEFAULT NULL,
  `Cidade` varchar(50) DEFAULT NULL,
  `Bairro` varchar(50) DEFAULT NULL,
  `Foto` varchar(300) DEFAULT NULL,
  `Idade` int(11) DEFAULT NULL,
  `TipoUsuario` int(11) DEFAULT NULL,
  `DataCadastro` datetime DEFAULT NULL,
  `DataUltimoLogin` datetime DEFAULT NULL,
  `Ativo` varchar(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `Nome`, `Login`, `Senha`, `Email`, `Cpf`, `Telefone`, `Celular`, `Cep`, `Uf`, `Cidade`, `Bairro`, `Foto`, `Idade`, `TipoUsuario`, `DataCadastro`, `DataUltimoLogin`, `Ativo`) VALUES
(5, 'Victor', 'victor', '123', 'victorbernardo_@hotmail.com', '050.692.994-92', '81-3622-0375', '81-9521-3007', '55817-200', 'PE', 'carpina', 'IPSEP', 'FotoPerfilUsuario/fa6919ed62e3d0c4af0cbd46db7f6f1f.jpg', 24, 0, '2015-04-16 00:00:00', '2015-04-23 15:56:51', 'T'),
(6, 'Luiz', 'luiz', '123', 'victorbernardo_@hotmail.com', '233.296.704-44', '', '', '5581', '', '', '', NULL, 24, 0, '2015-04-22 00:00:00', '2015-04-23 16:01:11', 'T'),
(7, 'Lucas', 'lucas', '123', 'lucas@hotmail.com', '584.013.127-01', '', '', '55817-200', 'PE', 'Carpina', '', NULL, 24, 0, '2015-04-23 00:00:00', '2015-04-23 15:57:05', 'T');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `livro`
--
ALTER TABLE `livro`
 ADD PRIMARY KEY (`IdLivro`), ADD KEY `N_COD_Usuario` (`IdUsuario`), ADD KEY `N_COD _USUARIO` (`IdUsuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`IdUsuario`), ADD UNIQUE KEY `V_LOGIN` (`Login`), ADD UNIQUE KEY `V_CPF` (`Cpf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `livro`
--
ALTER TABLE `livro`
MODIFY `IdLivro` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `livro`
--
ALTER TABLE `livro`
ADD CONSTRAINT `livro_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
