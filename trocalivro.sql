-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12-Abr-2015 às 23:39
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

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
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`N_COD_USUARIO` int(11) NOT NULL,
  `V_NOME` varchar(70) NOT NULL,
  `V_LOGIN` varchar(18) NOT NULL,
  `V_SENHA` varchar(18) NOT NULL,
  `V_EMAIL` varchar(50) NOT NULL,
  `V_CPF` varchar(15) NOT NULL,
  `V_TELEFONE` varchar(15) DEFAULT NULL,
  `V_CELULAR` varchar(15) DEFAULT NULL,
  `V_CEP` varchar(15) NOT NULL,
  `V_UF` varchar(2) DEFAULT NULL,
  `V_CIDADE` varchar(50) DEFAULT NULL,
  `V_BAIRRO` varchar(50) DEFAULT NULL,
  `V_FOTO` varchar(300) DEFAULT NULL,
  `V_IDADE` int(11) DEFAULT NULL,
  `N_TIPO_USUARIO` int(11) DEFAULT NULL,
  `D_DATA_CADASTRO` datetime DEFAULT NULL,
  `D_DATA_ULTIMO_LOGIN` datetime DEFAULT NULL,
  `B_ATIVO` varchar(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`N_COD_USUARIO`, `V_NOME`, `V_LOGIN`, `V_SENHA`, `V_EMAIL`, `V_CPF`, `V_TELEFONE`, `V_CELULAR`, `V_CEP`, `V_UF`, `V_CIDADE`, `V_BAIRRO`, `V_FOTO`, `V_IDADE`, `N_TIPO_USUARIO`, `D_DATA_CADASTRO`, `D_DATA_ULTIMO_LOGIN`, `B_ATIVO`) VALUES
(1, 'BRUNO', 'duel325', 'b8807008136', 'bruno_fmb123@hotmail.com', '103.344.314-09', '81-8979-8798', '81-8487-8789', '54470-040', 'PE', 'RECIFE', 'BARRA DE JANGADA', 'FotoPerfilUsuario/3f296d1ea9bf85a216845e25be6605c4.jpg', 20, 0, '2015-04-12 00:00:00', '2015-04-12 18:38:44', 'T');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`N_COD_USUARIO`), ADD UNIQUE KEY `V_LOGIN` (`V_LOGIN`), ADD UNIQUE KEY `V_CPF` (`V_CPF`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `N_COD_USUARIO` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
