-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18-Nov-2019 às 14:32
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_angosearch`
--
CREATE DATABASE IF NOT EXISTS `bd_angosearch` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bd_angosearch`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairro`
--

CREATE TABLE `bairro` (
  `id_bairro` int(11) NOT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `fk_distrito` int(11) DEFAULT NULL,
  `fk_municipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bairro`
--

INSERT INTO `bairro` (`id_bairro`, `bairro`, `fk_distrito`, `fk_municipio`) VALUES
(1, 'camama', NULL, 1),
(2, 'danjareux', NULL, 1),
(3, 'Fubu', NULL, 1),
(4, 'Simeone', NULL, 1),
(5, 'Desconhecido', NULL, 12),
(6, 'Camama 1', 1, 1),
(7, 'Chimbicado', 1, 1),
(8, 'Jardim do Eden', 1, 1),
(9, 'Jardim de Rosa', 1, 1),
(10, 'Golf 2', 1, 11),
(11, 'Kilamba', NULL, 11),
(12, 'Benfica', NULL, 1),
(13, 'Cuca', NULL, 9),
(14, 'Tala hadi', NULL, 9),
(15, 'Rocha', NULL, 2),
(16, 'Morro da Luz', NULL, 2),
(17, 'Prenda', NULL, 2),
(18, 'Samba', NULL, 2),
(19, 'Mundial', NULL, 1),
(20, 'Maianga', NULL, 7),
(21, 'Ingombota', NULL, 7),
(22, 'Hoji Ya Henda', NULL, 9),
(23, 'Kicolo', NULL, 9),
(24, 'Mabor', NULL, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `utilizador` int(11) DEFAULT NULL,
  `comentario` text NOT NULL,
  `fk_desaparecido` int(11) DEFAULT NULL,
  `data_comentario` datetime NOT NULL,
  `estado_comment` set('1','0') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `utilizador`, `comentario`, `fk_desaparecido`, `data_comentario`, `estado_comment`) VALUES
(18, 15, 'Realmente a página está clara, boa e simples . Verdadeiramente pude me informar sobre os desaparecidos de Luanda.\r\n ** Crítica a fazer é a seguinte:  vocês precisam implementar este sistema para Angola inteira.', 0, '2019-09-02 21:35:52', '1'),
(7, 14, 'ele está onde ?', 14, '2019-08-30 19:11:09', '1'),
(8, 0, '.vvv\r\n.', 9, '0000-00-00 00:00:00', '1'),
(9, 0, 'vvv\r\n.', 9, '2019-08-31 00:33:59', '1'),
(10, 14, 'vvv\r\n.', 9, '2019-08-31 01:44:48', '1'),
(11, 14, 'bb.', 9, '2019-08-31 20:50:23', '1'),
(12, 14, '<b style="color:#005fcb;">bbb</b>.', 14, '2019-08-30 21:38:53', '1'),
(13, 14, 'oh jÃ¡ foi encontrada ??.', 3, '2019-08-30 22:04:16', '1'),
(14, 14, 'oh jÃ¡ foi encontrada ??.', 3, '2019-08-30 22:05:07', '1'),
(15, 14, 'erro porquê ?.', 3, '2019-08-30 22:06:22', '1'),
(16, 14, 'boa página hein!.', NULL, '2019-08-31 02:07:30', '1'),
(19, 14, 'so para informar que gostei muito da página, pois que esta página ajudará muito as pessoas,\r\n                                a fim de elas encontrarem os seus parente,a crítica que eu tenho é que a página não tem muitas segurança..', 0, '2019-09-02 21:37:24', '1'),
(26, 15, 'ok me apercebi\r\n.', 30, '2019-10-02 17:46:17', '1'),
(21, 15, 'está no camama.', 14, '2019-09-02 22:25:55', '1'),
(22, 15, 'oh sério ??.', 9, '2019-09-05 13:47:18', '1'),
(23, 15, 'bv.', 14, '2019-09-05 14:40:03', '0'),
(27, 14, 'testando o comment....', 28, '2019-10-15 14:45:14', '1'),
(31, 15, 'Corrigindo', 35, '2019-11-11 14:20:43', '0'),
(28, 15, 'já fiz o comment.', 28, '2019-11-02 13:29:23', '1'),
(29, 15, 'corrigindo o comment.', 30, '2019-11-02 14:43:57', '1'),
(30, 15, 'vvvvv.', 0, '2019-11-02 15:07:52', '0'),
(32, 15, 'v.', 37, '2019-11-14 10:01:48', '1'),
(33, 15, 'v.', 37, '2019-11-14 10:02:52', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `definicoes`
--

CREATE TABLE `definicoes` (
  `id_definicoes` int(11) NOT NULL,
  `webtitulo` varchar(95) DEFAULT NULL,
  `logo` varchar(245) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `definicoes`
--

INSERT INTO `definicoes` (`id_definicoes`, `webtitulo`, `logo`) VALUES
(1, 'ANGOSEARCH', '1319068600.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `desaparecidos`
--

CREATE TABLE `desaparecidos` (
  `id_desaparecido` int(11) NOT NULL,
  `nome_completo` varchar(95) NOT NULL DEFAULT 'Desonhecido',
  `idade` varchar(140) DEFAULT NULL,
  `fk_bairro` int(11) DEFAULT NULL,
  `nome_pai` varchar(100) DEFAULT NULL,
  `nome_mae` varchar(100) DEFAULT NULL,
  `data_desaparecimento` varchar(30) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `telefone1` varchar(12) DEFAULT NULL,
  `telefone2` varchar(12) DEFAULT NULL,
  `descricao` text,
  `caracteristicas_especiais` text,
  `estado` enum('0','1','2','3') DEFAULT NULL,
  `fk_genero` int(11) DEFAULT NULL,
  `fk_provincia` int(11) DEFAULT NULL,
  `postado_por` varchar(255) DEFAULT NULL,
  `removido_por` varchar(255) DEFAULT NULL,
  `dataRegistro` varchar(255) DEFAULT NULL,
  `dataEncontrado` varchar(100) DEFAULT NULL,
  `dataExcluido` varchar(255) DEFAULT NULL,
  `fk_utilizador` int(11) DEFAULT NULL,
  `dataSolicitacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `desaparecidos`
--

INSERT INTO `desaparecidos` (`id_desaparecido`, `nome_completo`, `idade`, `fk_bairro`, `nome_pai`, `nome_mae`, `data_desaparecimento`, `foto`, `telefone1`, `telefone2`, `descricao`, `caracteristicas_especiais`, `estado`, `fk_genero`, `fk_provincia`, `postado_por`, `removido_por`, `dataRegistro`, `dataEncontrado`, `dataExcluido`, `fk_utilizador`, `dataSolicitacao`) VALUES
(1, 'Ludimila Airosa', '17', 7, 'Desconhecido', 'Desconhecido', '14-05-2019 ', '3073726500.jpg', '922-374-690', '-', '\r\n                                                                                    ', '                                                                                         ', '1', 2, 19, 'admin: Igor Ginga', 'Igor Ginga', '29/Julho/2019 , 23:44:2', '2019-12-09', '2019-09-25', NULL, NULL),
(2, 'Junilson Antonio', 'Desconhecido', 2, 'Desconhecido', 'Desconhecido', '30-06-2019 ', '3006669000.jpg', '998-752-1', '-', '                ', '                ', '1', 1, 19, 'admin: Igor Ginga', 'Igor Ginga', '29/Julho/2019 , 23:45:29', NULL, '2/Agosto/2019 , 23:45:27', NULL, NULL),
(3, 'Fifi de Rosa', 'Desconhecido', 6, 'Desconhecido', 'Desconhecido', '03-03-2019 ', '3026936700.jpg', '975-437-7', '-', '                vista pela ultima vez em casa antes de ir para festa', '                ', '1', 2, 19, 'Nlandu JoÃ£o "Cante" : Esquadra MÃ³vel do Simeone', 'Igor Ginga', '29/Julho/2019 , 23:49:10', '2019-09-26', '2019-09-25', NULL, NULL),
(4, 'JÃ³ dos Santos JosÃ©', '22', 4, 'Desconhecido', 'Desconhecido', '13-04-2019 ', 'usuario.png', '-', '-', '                                                            ', '                                                            ', '1', 1, 2, 'Nlandu JoÃ£o "Cante" : Esquadra MÃ³vel do Simeone', 'Igor Ginga', '29/Julho/2019 , 23:51:59', NULL, '2/Agosto/2019 , 23:45:17', NULL, NULL),
(5, 'Maninha Gomes', '6', 2, 'Desconhecido', 'Desconhecido', '14-04-2019 ', '0120375100.jpg', '', '', '                                            ', '                                            ', '1', 2, 19, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', 'Nlandu JoÃ£o "Cante" : Esquadra MÃ³vel do Simeone', '1/Agosto/2019 , 13:29:36', NULL, '13/Agosto/2019 , 4:45:39', NULL, NULL),
(7, 'Henriques Marcos', 'Desconhecido', 7, 'Desconhecido', 'Desconhecido', '30-04-2019 ', '2637199800.jpg', '-', '-', '                                    ', '                                    ', '1', 1, 19, 'admin: Igor Ginga', NULL, '26/Agosto/2019 , 22:52:39', NULL, NULL, NULL, NULL),
(8, 'JoÃ£o Armando Salvador', '19', 10, 'Isaac Salvador', 'Desconhecido', '22-07-2019 ', '2659422800.jpg', '-', '-', '                                    ', '                                    ', '1', 1, 17, 'admin: Igor Ginga', NULL, '26/Agosto/2019 , 22:57:34', NULL, NULL, NULL, NULL),
(9, 'MÃ¡rio Tomboca', '11', 2, 'Edgar Tomboca', '', '', '2700054700.jpg', '-', '-', '                                    ', '                                    ', '0', 1, 19, 'admin: Igor Ginga', 'Igor Ginga', '26/Agosto/2019 , 23:8:37', '2019-11-14', '2019-11-14', NULL, NULL),
(12, 'JoÃ£o Francisco', '65', 21, 'Desconhecido', 'Desconhecido', '20-08-2019 ', '2891803400.jpg', '992-987-654', '-', '                                                            ', '                                                           ', '1', 1, 9, 'admin: Igor Ginga', NULL, '27/Agosto/2019 , 23:33:56', NULL, NULL, NULL, NULL),
(13, 'JesuÃ­na SimÃ£o', '23', 12, 'Desconhecido', 'Desconhecido', '10-02-2019 ', '2818507000.jpg', '990-876-543', '913-014-670', '                                                            ', '                                                            ', '1', 2, 3, 'admin: Igor Ginga', NULL, '27/Agosto/2019 , 23:37:15', NULL, NULL, NULL, NULL),
(14, 'Borges Lucas', '28', 18, 'Desconhecido', 'Desconhecido', '09-07-2019 ', '2899164600.jpg', '934-876-567', '-', '                                                            ', '                                                            ', '1', 1, 19, 'admin: Igor Ginga', NULL, '27/Agosto/2019 , 23:37:45', NULL, NULL, NULL, NULL),
(15, 'TomÃ¡s JÃ­gi', '16', 12, 'JoÃ£o JÃ­gi', '', '08-02-2019 ', 'usuario.png', '987 654 312', '937 622 991', '                            ', '                            ', '', 1, 2, NULL, NULL, NULL, NULL, NULL, 14, '2019-08-31 00:51:03'),
(23, 'TomÃ¡s JÃ­gi', '16', 12, '', '', '', 'usuario.png', '-', '-', '                            ', '                            ', '', 3, 2, NULL, NULL, NULL, NULL, NULL, 14, '2019-08-31 01:15:57'),
(25, 'yui-mb', '16', 24, '', '', '02-12-2019 ', '3132943600.jpg', '987 654 567', '-', '                            ', 'altura mÃ©dia, arquiado, e escuro                            ', '', 3, 14, NULL, NULL, NULL, NULL, NULL, 14, '2019-08-31 01:45:27'),
(26, 'elissh', '', 1, '', '', '', '0531244400.jpg', '678 765 457', '-', '                            ', '                            ', '', 3, 10, NULL, NULL, NULL, NULL, NULL, 14, '2019-09-05 14:36:02'),
(27, 'Milton quissanga Mateus ', '22', 4, 'quim', 'sebastiÃ£o', '05-09-1997 ', '0527499500.jpg', '123 456 714', '-', 'perdeu ontem                            ', 'Alto                            ', '', 1, 1, NULL, NULL, NULL, NULL, NULL, 15, '2019-09-05 17:04:26'),
(28, 'FÃ¡bio Marcos', '23', 13, 'Desconhecido', 'Desconhecido', '08-12-2019 ', '0556886800.jpg', '-', '-', '                                                                                                                                                                        ', '                                                                                                                                                                        ', '0', 1, 17, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', 'Igor Ginga', '5/Setembro/2019 , 22:35:35', '2019-10-11', '2019-11-11', NULL, NULL),
(29, 'Jorge Danda', '5', 1, 'Danda Simão', 'Desconhecido', 'Desconhecido', 'usuario.png', '555-552-226', '987-654-323', '                                    hhhhhhh                        ', '                                    tggggggg                        ', '0', 1, 2, 'admin: Igor Ginga', 'Igor Ginga', '19/Setembro/2019 , 12:13:44', '2019-09-23', '2019-09-25', NULL, NULL),
(30, 'Belo ArÃ£o', '6', 3, 'Desconhecido', 'Desconhecido', '26-03-2019 ', 'usuario.png', '980654569', '-', '', 'Pele clara', '0', 1, 17, 'admin: Igor Ginga', 'Igor Ginga', '25/Setembro/2019 , 11:22:24', '2019-03-02', '2019-11-14', NULL, NULL),
(35, 'Nelinho JoÃ£o', '9', 5, 'Desconhecido', 'Desconhecido', '14-08-2019 ', 'usuario.png', '938625227', '986433488', '', 'Magrelo, baixo e claro', '3', 1, 17, 'admin: Igor Ginga', 'Igor Ginga', '15/outubro/2019 , 20:45:18', NULL, '2019-11-16', NULL, NULL),
(36, 'Ntanda Oky', '13', 20, 'Oky JoÃ£o', '', '11-11-2019 ', 'usuario.png', '998765457', '-', '', 'alto, escuro', '2', 2, 19, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', NULL, '14-11-2019', NULL, NULL, 15, '2019-11-11 14:32:32'),
(37, 'DÃ¡rio Picasso', '17', 4, 'Junior casemiro', 'Celina Muquinje', '03-05-2019 ', 'usuario.png', '923837103', '-', 'Estava celebrar a festa de aniversÃ¡rio e desapareceu.', 'alto, escuro.', '2', 1, 1, 'Nlandu JoÃ£o  : Esquadra MÃ³vel do Simeone', NULL, '14-11-2019', NULL, NULL, 15, '2019-11-14 09:25:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `distrito`
--

CREATE TABLE `distrito` (
  `id_distrito` int(11) NOT NULL,
  `distrito` varchar(85) NOT NULL,
  `fk_municipio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `distrito`
--

INSERT INTO `distrito` (`id_distrito`, `distrito`, `fk_municipio`) VALUES
(1, 'Camama', 1),
(2, 'Rangel', 9),
(3, 'Sambizanga', 9),
(4, 'Sequele', 6),
(5, 'Maianga', 7),
(6, 'Ingombota', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `id_doc` int(11) NOT NULL,
  `nome_doc` varchar(250) DEFAULT NULL,
  `fotografia` varchar(455) NOT NULL,
  `detalhe` text NOT NULL,
  `codigo_doc` varchar(300) DEFAULT NULL,
  `postado_por` varchar(255) DEFAULT NULL,
  `removido_por` varchar(255) DEFAULT NULL,
  `dataRegistro` varchar(255) NOT NULL,
  `dataEncontrado` date DEFAULT NULL,
  `dataExcluido` date DEFAULT NULL,
  `estado` enum('1','0','2') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `documentos`
--

INSERT INTO `documentos` (`id_doc`, `nome_doc`, `fotografia`, `detalhe`, `codigo_doc`, `postado_por`, `removido_por`, `dataRegistro`, `dataEncontrado`, `dataExcluido`, `estado`) VALUES
(1, 'Bilhete de Identidade de CidadÃ£o Nacional', '0312464400.jpg', 'Pertencente a Sr. Manuela Lucas Fonseca .\r\n', '007069655LA048', 'Igor Ginga', 'Igor Ginga', '3/Agosto/2019 , 4:46:7', NULL, '2019-09-27', '2'),
(2, 'Bilhete de Identidade de CidadÃ£o Nacional', '0335808800.jpg', 'Pertencente a Sr. AngÃ©lica RÃ©gia Fernandes da Costa .', '002869717LA038', 'Igor Ginga', 'Igor Ginga', '3/Agosto/2019 , 4:51:54', NULL, '0000-00-00', '1'),
(3, 'CartÃ£o do Formado', '1329068400.jpg', 'Pertence ao Sr. T.C Serafim', '', 'Igor Ginga', 'Igor Ginga', '13/Agosto/2019 , 8:19:33', NULL, '0000-00-00', '1'),
(4, 'Certificado de HabilitaÃ§Ã£o', '2749336300.jpg', 'Pertence a sr. Priscila SimÃ£o Mawete', '008566239LA041', 'Igor Ginga', NULL, '27/Agosto/2019 , 15:54:25', NULL, NULL, '1'),
(5, 'Bilhete de Identidade', '2725720200.jpeg', 'Pertence a Sr. Joaquina Camela', '004857799HO047', 'Igor Ginga', 'Igor Ginga', '27/Agosto/2019 , 15:59:27', '2019-09-18', '2019-09-27', '0'),
(6, 'CartÃ£o de IdentificaÃ§Ã£o JMPLA', '2763538600.jpg', 'Pertence ao Sr. Figueiredo Lopes', '930822', 'Igor Ginga', NULL, '27/Agosto/2019 , 16:2:33', NULL, NULL, '1'),
(7, 'Certificado de HabilitaÃ§Ã£o', '2762152600.jpg', 'Pertence a Sr. MÃ¡rcia Armanda', '003596668LA038', 'Igor Ginga', NULL, '27/Agosto/2019 , 16:4:56', NULL, NULL, '1'),
(8, 'Bilhete de Identidade', '2735049900.jpg', 'Pertence a Sr. Laurinda JosÃ©', '002847891HO049', 'Igor Ginga', NULL, '27/Agosto/2019 , 16:7:22', NULL, NULL, '1'),
(9, 'CartÃ£o de Estudante', '2751228500.jpg', 'Pertence Maria Benedetto,  uma cidadÃ£ estrangeira', '', 'Igor Ginga', 'Igor Ginga', '27/Agosto/2019 , 16:11:23', NULL, '0000-00-00', '1'),
(10, 'Passaporte', '2760380400.jpg', 'Pertence ao Sr. Geremias Caleto', '0908LD', 'Igor Ginga', 'Igor Ginga', '27/Agosto/2019 , 16:15:11', NULL, '0000-00-00', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `esquadra`
--

CREATE TABLE `esquadra` (
  `id_esquadra` int(11) NOT NULL,
  `esquadra` varchar(45) DEFAULT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `fk_bairro` int(11) DEFAULT NULL,
  `fk_tipoEsquadra` int(11) DEFAULT NULL,
  `dataRegistro` varchar(255) NOT NULL,
  `data_excluido` varchar(255) DEFAULT NULL,
  `estado` enum('1','0') NOT NULL,
  `func_esquadra` varchar(255) NOT NULL,
  `func_foto` varchar(255) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `telefone` varchar(12) DEFAULT NULL,
  `registrado_por` varchar(255) NOT NULL,
  `removido_por` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `esquadra`
--

INSERT INTO `esquadra` (`id_esquadra`, `esquadra`, `numero`, `fk_bairro`, `fk_tipoEsquadra`, `dataRegistro`, `data_excluido`, `estado`, `func_esquadra`, `func_foto`, `email`, `telefone`, `registrado_por`, `removido_por`) VALUES
(4, 'Esquadra Jardim do Ã‰den', '', 1, 2, '15-07-2019', '2019-09-29', '0', 'Eduani Neto', '1576476200.jpg', NULL, NULL, 'admin: Igor Ginga', 'Igor Ginga'),
(5, 'Esquadra MÃ³vel do Jardim do Ã‰den', '124444', 8, 1, '15/Julho/2019 , 14:58:25', NULL, '1', 'Eduani Neto', '1569407700.jpg', NULL, NULL, '', NULL),
(6, 'Esquadra MÃ³vel do Simeone', '', 4, 1, '16/Julho/2019 , 15:35:33', '', '1', 'Nlandu JoÃ£o ', '0548680200.jpg', 'nlandujoao@gmail.com', '987 987 654', '', 'admin: Igor Ginga'),
(7, 'Esquadra Fixa do Danjareux', '56238', 2, 2, '16/Julho/2019 , 16:18:59', '', '1', 'Avelino FÃ©lix', '1652531300.jpg', NULL, NULL, 'admin: Igor Ginga', 'admin: Igor Ginga'),
(8, 'Esquadra Fixa do Golf 2', '45678765', 10, 2, '30/Julho/2019 , 5:57:42', NULL, '1', 'FÃ¡bio Antonio', 'usuario.png', NULL, NULL, 'admin: Igor Ginga', NULL),
(9, 'Esquadra MÃ³vel do Kilamba', '', 11, 1, '1/Agosto/2019 , 13:19:43', '4/Agosto/2019 , 4:55:45', '1', 'Odete Cacoma', '0174185400.png', 'odete@gmail.com', '944876567', 'admin: Igor Ginga', 'admin: Igor Ginga'),
(10, 'Esquadra Fixa do Golf 2', '', 10, 2, '2/Agosto/2019 , 17:21:25', '2019-09-29', '0', 'Josemar', 'usuario.png', NULL, NULL, 'admin: ', 'Igor Ginga');

-- --------------------------------------------------------

--
-- Estrutura da tabela `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `genero` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `genero`
--

INSERT INTO `genero` (`id_genero`, `genero`) VALUES
(2, 'Femenimo'),
(1, 'Masculino'),
(3, 'Outros');

-- --------------------------------------------------------

--
-- Estrutura da tabela `inicia_sessao`
--

CREATE TABLE `inicia_sessao` (
  `id_iniciaSessao` int(11) NOT NULL,
  `nome_user` varchar(390) NOT NULL,
  `dataLogin` varchar(400) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `inicia_sessao`
--

INSERT INTO `inicia_sessao` (`id_iniciaSessao`, `nome_user`, `dataLogin`) VALUES
(1, 'Dennys Jorge', '29/Setembro/2019 , 13:5:29'),
(2, 'Job Paulo', '29/Setembro/2019 , 13:5:43'),
(3, 'admin : Igor Ginga', '29/Setembro/2019 , 13:5:58'),
(4, 'admin : Igor Ginga', '1/outubro/2019 , 11:33:12'),
(5, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '1/outubro/2019 , 11:57:40'),
(6, 'admin : Igor Ginga', '1/outubro/2019 , 13:48:43'),
(7, 'admin : Igor Ginga', '1/outubro/2019 , 16:22:25'),
(8, 'admin : Igor Ginga', '1/outubro/2019 , 17:38:54'),
(9, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '1/outubro/2019 , 17:39:27'),
(10, 'admin : Igor Ginga', '1/outubro/2019 , 17:43:4'),
(11, 'admin : Igor Ginga', '1/outubro/2019 , 17:49:36'),
(12, 'admin : Igor Ginga', '1/outubro/2019 , 17:50:19'),
(13, 'admin : Igor Ginga', '1/outubro/2019 , 17:51:3'),
(14, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '1/outubro/2019 , 17:51:24'),
(15, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '2/outubro/2019 , 8:22:25'),
(16, 'Dennys Jorge', '2/outubro/2019 , 13:45:10'),
(17, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '2/outubro/2019 , 17:17:55'),
(18, 'admin : Igor Ginga', '2/outubro/2019 , 17:18:46'),
(19, 'Dennys Jorge', '2/outubro/2019 , 17:20:10'),
(20, 'Dennys Jorge', '2/outubro/2019 , 18:49:4'),
(21, 'Bondoso Alberto', '2/outubro/2019 , 19:18:47'),
(22, 'admin : Igor Ginga', '2/outubro/2019 , 19:19:59'),
(23, 'admin : Igor Ginga', '2/outubro/2019 , 19:33:23'),
(24, 'Josemar Joaquim', '2/outubro/2019 , 19:38:13'),
(25, 'Dennys Jorge', '2/outubro/2019 , 20:6:36'),
(26, 'admin : Igor Ginga', '2/outubro/2019 , 22:13:35'),
(27, 'Dennys Jorge', '3/outubro/2019 , 17:43:58'),
(28, 'Dennys Jorge', '3/outubro/2019 , 17:48:56'),
(29, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '3/outubro/2019 , 17:59:40'),
(30, 'admin : Igor Ginga', '3/outubro/2019 , 18:0:38'),
(31, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '3/outubro/2019 , 18:52:26'),
(32, 'Dennys Jorge', '3/outubro/2019 , 18:52:56'),
(33, 'admin : Igor Ginga', '3/outubro/2019 , 19:5:25'),
(34, 'admin : Igor Ginga', '3/outubro/2019 , 19:7:47'),
(35, 'admin : Igor Ginga', '3/outubro/2019 , 19:12:11'),
(36, 'admin : Igor Ginga', '4/outubro/2019 , 8:2:14'),
(37, 'Dennys Jorge', '6/outubro/2019 , 21:34:33'),
(38, 'admin : Igor Ginga', '8/outubro/2019 , 13:40:18'),
(39, 'admin : Igor Ginga', '8/outubro/2019 , 19:8:25'),
(40, 'admin : Igor Ginga', '8/outubro/2019 , 19:19:48'),
(41, 'admin : Igor Ginga', '14/outubro/2019 , 21:21:56'),
(42, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '14/outubro/2019 , 22:35:27'),
(43, 'Job Paulo', '14/outubro/2019 , 23:2:12'),
(44, 'Dennys Jorge', '14/outubro/2019 , 23:37:8'),
(45, 'Dennys Jorge', '15/outubro/2019 , 12:14:15'),
(46, 'Job Paulo', '15/outubro/2019 , 12:40:44'),
(47, 'admin : Igor Ginga', '15/outubro/2019 , 12:42:1'),
(48, 'Dennys Jorge', '15/outubro/2019 , 13:42:58'),
(49, 'Job Paulo', '15/outubro/2019 , 13:44:12'),
(50, 'Dennys Jorge', '15/outubro/2019 , 13:47:9'),
(51, 'Dennys Jorge', '15/outubro/2019 , 17:10:36'),
(52, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '15/outubro/2019 , 17:12:21'),
(53, 'Esquadra MÃ³vel do Simeone : Nlandu JoÃ£o ', '15/outubro/2019 , 18:41:9'),
(54, 'Dennys Jorge', '15/outubro/2019 , 18:43:10'),
(55, 'Dennys Africano', '15/outubro/2019 , 18:47:7'),
(56, 'Bereiano', '15/outubro/2019 , 18:52:36'),
(57, 'Denis Malemba', '15/outubro/2019 , 18:58:55'),
(58, 'Bereiano', '15/outubro/2019 , 19:2:14'),
(59, 'Denis Malemba', '15/outubro/2019 , 19:5:49'),
(60, 'Bereiano', '15/outubro/2019 , 19:6:26'),
(61, 'Denis Malemba', '15/outubro/2019 , 19:8:31'),
(62, 'Dennys Africano', '15/outubro/2019 , 19:14:8'),
(63, 'admin : Igor Ginga', '15/outubro/2019 , 19:14:47'),
(64, 'admin : Igor Canda Ginga', '15/outubro/2019 , 19:20:37'),
(65, 'admin : Igor Ginga', '15/outubro/2019 , 19:20:59'),
(66, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '15/outubro/2019 , 19:26:47'),
(67, 'admin : Igor Ginga', '15/outubro/2019 , 20:26:3'),
(68, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '15/outubro/2019 , 21:3:54'),
(69, 'Dennys Africano', '16/outubro/2019 , 13:54:18'),
(70, 'Dennys Jorge', '16/outubro/2019 , 14:3:7'),
(71, 'admin : Igor Ginga', '16/outubro/2019 , 14:5:5'),
(72, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '24/outubro/2019 , 9:49:53'),
(73, 'Dennys Jorge', '29/outubro/2019 , 7:17:27'),
(74, 'Dennys Jorge', '29/outubro/2019 , 7:17:53'),
(75, 'admin : Igor Ginga', '29/outubro/2019 , 8:8:11'),
(76, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '29/outubro/2019 , 8:10:31'),
(77, 'admin : Igor Ginga', '29/outubro/2019 , 8:12:31'),
(78, 'Dennys Jorge', '29/outubro/2019 , 8:13:28'),
(79, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '29/outubro/2019 , 8:15:44'),
(80, 'Dennys Jorge', '29/outubro/2019 , 8:18:59'),
(81, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '29/outubro/2019 , 8:20:31'),
(82, 'admin : Igor Ginga', '29/outubro/2019 , 8:20:48'),
(83, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '2/Novembro/2019 , 12:5:8'),
(84, 'admin : Igor Ginga', '2/Novembro/2019 , 12:9:6'),
(85, 'Dennys Jorge', '2/Novembro/2019 , 12:19:46'),
(86, 'admin : Igor Ginga', '2/Novembro/2019 , 14:0:47'),
(87, 'Dennys Jorge', '2/Novembro/2019 , 14:2:3'),
(88, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '2/Novembro/2019 , 14:24:24'),
(89, 'Dennys Jorge', '5/Novembro/2019 , 11:59:51'),
(90, 'admin : Igor Ginga', '5/Novembro/2019 , 12:9:27'),
(91, 'admin : Igor Ginga', '5/Novembro/2019 , 12:14:53'),
(92, 'admin : Igor Ginga', '5/Novembro/2019 , 12:19:28'),
(93, 'admin : Igor Ginga', '9/Novembro/2019 , 10:21:38'),
(94, 'admin : Igor Ginga', '11/Novembro/2019 , 13:16:30'),
(95, 'admin : Igor Canda Ginga', '11/Novembro/2019 , 13:18:49'),
(96, 'admin : Igor Ginga', '11/Novembro/2019 , 13:19:10'),
(97, 'Dennys Jorge', '11/Novembro/2019 , 13:19:27'),
(98, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '11/Novembro/2019 , 13:23:30'),
(99, 'Dennys Jorge', '11/Novembro/2019 , 13:24:21'),
(100, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '11/Novembro/2019 , 13:50:15'),
(101, 'Dennys Jorge', '11/Novembro/2019 , 19:59:57'),
(102, 'admin : Igor Ginga', '11/Novembro/2019 , 20:1:12'),
(103, 'Dennys Jorge', '11/Novembro/2019 , 20:5:57'),
(104, 'Esquadra MÃ³vel do Kilamba : Odete Cacoma', '14/Novembro/2019 , 7:33:26'),
(105, 'Dennys Jorge', '14/Novembro/2019 , 8:22:9'),
(106, 'Esquadra MÃ³vel do Simeone : Nlandu JoÃ£o ', '14/Novembro/2019 , 8:30:26'),
(107, 'Dennys Jorge', '14/Novembro/2019 , 8:42:20'),
(108, 'Job Paulo', '14/Novembro/2019 , 9:7:12'),
(109, 'admin : Igor Ginga', '14/Novembro/2019 , 9:11:20'),
(110, 'admin : Igor Ginga', '14/Novembro/2019 , 9:22:54'),
(111, 'admin : Igor Ginga', '14/Novembro/2019 , 9:31:25'),
(112, 'admin : Igor Ginga', '14/Novembro/2019 , 12:57:14'),
(113, 'Dennys Jorge', '16/Novembro/2019 , 9:11:53'),
(114, 'admin : Igor Ginga', '16/Novembro/2019 , 9:17:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `usuario` varchar(95) NOT NULL,
  `senha` varchar(95) NOT NULL,
  `acesso` set('admin','esquadra','utilizador') NOT NULL,
  `estado` enum('1','0') NOT NULL,
  `admin` varchar(255) DEFAULT NULL,
  `foto_admin` varchar(255) DEFAULT NULL,
  `email_admin` varchar(30) NOT NULL,
  `dtRegistro` date DEFAULT NULL,
  `dtActivado` date DEFAULT NULL,
  `dtDesactivado` date DEFAULT NULL,
  `adminRegister` varchar(255) DEFAULT NULL,
  `fk_esquadra` int(11) DEFAULT NULL,
  `fk_utilizador` int(11) DEFAULT NULL,
  `cod_recuperacao` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id_login`, `usuario`, `senha`, `acesso`, `estado`, `admin`, `foto_admin`, `email_admin`, `dtRegistro`, `dtActivado`, `dtDesactivado`, `adminRegister`, `fk_esquadra`, `fk_utilizador`, `cod_recuperacao`) VALUES
(2, 'adminAngoSearch', '1bbd886460827015e5d605ed44252251', 'admin', '1', 'Igor Ginga', '1533824400.jpg', 'igorginga@gmail.com', '2019-02-13', '2019-02-13', NULL, NULL, NULL, NULL, '492082'),
(3, 'esquadra1234', '234805daae83bc3286fd063350d0b011', 'esquadra', '0', NULL, NULL, '', NULL, NULL, NULL, NULL, 1, NULL, '492082'),
(4, 'postopolicialfubu', 'c8d5d42d080825af2c841c8b5a15a270', 'esquadra', '0', NULL, NULL, '', NULL, NULL, NULL, NULL, 2, NULL, '492082'),
(5, 'esquadraJardim', 'adbf56386de1005fe01e2edf803240b7', 'esquadra', '0', NULL, NULL, '', NULL, NULL, NULL, NULL, 3, NULL, '492082'),
(6, 'jardim', 'adbf56386de1005fe01e2edf803240b7', 'esquadra', '1', NULL, NULL, '', NULL, NULL, NULL, NULL, 4, NULL, '492082'),
(7, 'Eden', 'ace22c350f88b84d4d4763ce2d6626fd', 'esquadra', '1', NULL, NULL, '', NULL, NULL, NULL, NULL, 5, NULL, '492082'),
(8, 'simeone', '9fb3b44d0ebfced15ca433cd2ea9c666', 'esquadra', '1', NULL, NULL, '', NULL, NULL, NULL, NULL, 6, NULL, '492082'),
(9, 'odete', '612c2ea1a1652dbbbe6d522999b1f105', 'esquadra', '1', NULL, NULL, '', NULL, NULL, NULL, NULL, 9, NULL, '492082'),
(10, 'eden', 'fa246d0262c3925617b0c72bb20eeb1d', 'esquadra', '1', NULL, NULL, '', NULL, NULL, NULL, NULL, 10, NULL, '492082'),
(11, 'eden', '612c2ea1a1652dbbbe6d522999b1f105', 'esquadra', '1', NULL, NULL, '', NULL, NULL, NULL, NULL, 9, NULL, '492082'),
(12, 'eden', 'a1931ec126bbad3fa7a3fc64209fd921', 'esquadra', '1', NULL, NULL, '', NULL, NULL, NULL, NULL, 10, NULL, '492082'),
(17, 'Golf', 'ad898772dc012dbc89a4968efbfd1deb', 'esquadra', '1', NULL, NULL, '', NULL, NULL, NULL, NULL, 8, NULL, '492082'),
(28, 'jobpaulo', '13a16efb492b4b9098ec94ce9b0f6b8f', 'utilizador', '1', NULL, NULL, '', NULL, '2019-10-01', NULL, NULL, NULL, 14, '492082'),
(29, 'dennys', 'f638f4354ff089323d1a5f78fd8f63ca', 'utilizador', '1', NULL, NULL, '', NULL, '2019-10-01', '2019-10-01', NULL, NULL, 15, '492082'),
(30, 'cante', '25d55ad283aa400af464c76d713c07ad', 'utilizador', '1', NULL, NULL, '', NULL, '2019-10-02', NULL, NULL, NULL, 16, '492082'),
(37, 'ruijm', 'bae5e3208a3c700e3db642b6631e95b9', 'admin', '0', 'Rui Yuri ', '2666141900.jpg', 'ruimalemba11@gmail.com', '2019-09-26', '2019-10-01', '2019-10-01', 'Igor Ginga', NULL, NULL, '492082'),
(38, 'bondoso', 'dd4b21e9ef71e1291183a46b913ae6f2', 'utilizador', '1', NULL, NULL, '', NULL, '2019-10-02', NULL, NULL, NULL, 17, '492082'),
(39, 'josemar', 'fb04099906bc76a35a041e6b815d3b3e', 'utilizador', '1', NULL, NULL, '', NULL, '2019-10-02', NULL, NULL, NULL, 18, '492082');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logout`
--

CREATE TABLE `logout` (
  `id_logout` int(11) NOT NULL,
  `nome_user` varchar(90) NOT NULL,
  `dataLogout` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `logout`
--

INSERT INTO `logout` (`id_logout`, `nome_user`, `dataLogout`) VALUES
(1, 'admin : Igor Ginga', '29/Sep/2019 , 13:05:18'),
(2, 'Dennys Jorge', '29/Sep/2019 , 13:05:35'),
(3, 'Job Paulo', '29/Sep/2019 , 13:05:49'),
(4, 'admin : Igor Ginga', '29/Sep/2019 , 13:12:59'),
(5, 'admin : Igor Ginga', '01/Oct/2019 , 11:57:29'),
(6, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '01/Oct/2019 , 11:59:46'),
(7, 'admin : Igor Ginga', '01/Oct/2019 , 12:07:55'),
(8, 'admin : Igor Ginga', '01/Oct/2019 , 17:37:28'),
(9, 'admin : Igor Ginga', '01/Oct/2019 , 17:39:15'),
(10, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '01/Oct/2019 , 17:42:57'),
(11, 'admin : Igor Ginga', '01/Oct/2019 , 17:48:46'),
(12, 'admin : Igor Ginga', '01/Oct/2019 , 17:50:08'),
(13, 'admin : Igor Ginga', '01/Oct/2019 , 17:51:16'),
(14, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '02/Oct/2019 , 13:44:58'),
(15, 'Dennys Jorge', '02/Oct/2019 , 17:17:44'),
(16, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '02/Oct/2019 , 17:18:39'),
(17, 'admin : Igor Ginga', '02/Oct/2019 , 17:19:18'),
(18, 'Dennys Jorge', '02/Oct/2019 , 17:27:14'),
(19, 'Dennys Jorge', '02/Oct/2019 , 18:52:04'),
(20, 'Bondoso Alberto', '02/Oct/2019 , 19:19:38'),
(21, 'admin : Igor Ginga', '02/Oct/2019 , 19:30:17'),
(22, 'admin : Igor Ginga', '02/Oct/2019 , 19:34:13'),
(23, 'Josemar Joaquim', '02/Oct/2019 , 19:39:55'),
(24, 'Dennys Jorge', '02/Oct/2019 , 20:27:35'),
(25, 'admin : Igor Ginga', '02/Oct/2019 , 22:14:08'),
(26, 'Dennys Jorge', '03/Oct/2019 , 17:44:07'),
(27, 'Dennys Jorge', '03/Oct/2019 , 17:49:07'),
(28, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '03/Oct/2019 , 18:00:29'),
(29, 'admin : Igor Ginga', '03/Oct/2019 , 18:32:35'),
(30, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '03/Oct/2019 , 18:52:33'),
(31, 'Dennys Jorge', '03/Oct/2019 , 18:53:07'),
(32, 'admin : Igor Ginga', '03/Oct/2019 , 19:05:30'),
(33, 'admin : Igor Ginga', '03/Oct/2019 , 19:07:53'),
(34, 'admin : Igor Ginga', '03/Oct/2019 , 19:12:19'),
(35, 'admin : Igor Ginga', '04/Oct/2019 , 8:02:26'),
(36, 'admin : Igor Ginga', '08/Oct/2019 , 13:51:18'),
(37, 'admin : Igor Ginga', '08/Oct/2019 , 19:09:58'),
(38, 'admin : Igor Ginga', '09/Oct/2019 , 0:01:28'),
(39, 'admin : Igor Ginga', '14/Oct/2019 , 22:33:41'),
(40, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '15/Oct/2019 , -1:02:01'),
(41, 'Job Paulo', '15/Oct/2019 , -1:36:58'),
(42, 'Dennys Jorge', '15/Oct/2019 , 11:59:56'),
(43, 'Dennys Jorge', '15/Oct/2019 , 12:39:26'),
(44, 'Job Paulo', '15/Oct/2019 , 12:40:53'),
(45, 'admin : Igor Ginga', '15/Oct/2019 , 13:42:50'),
(46, 'Dennys Jorge', '15/Oct/2019 , 13:43:04'),
(47, 'Job Paulo', '15/Oct/2019 , 13:46:23'),
(48, 'Dennys Jorge', '15/Oct/2019 , 17:11:57'),
(49, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '15/Oct/2019 , 18:38:11'),
(50, 'Nlandu JoÃ£o  : Esquadra MÃ³vel do Simeone', '15/Oct/2019 , 18:42:54'),
(51, 'Dennys Jorge', '15/Oct/2019 , 18:46:58'),
(52, '', '15/Oct/2019 , 19:01:58'),
(53, 'Dennys Africano', '15/Oct/2019 , 19:14:38'),
(54, 'admin : Igor Ginga', '15/Oct/2019 , 19:26:33'),
(55, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '15/Oct/2019 , 20:25:45'),
(56, 'Dennys Jorge', '16/Oct/2019 , 14:04:57'),
(57, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '24/Oct/2019 , 9:50:01'),
(58, 'Dennys Jorge', '29/Oct/2019 , 7:17:33'),
(59, 'Dennys Jorge', '29/Oct/2019 , 7:18:02'),
(60, 'admin : Igor Ginga', '29/Oct/2019 , 8:10:18'),
(61, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '29/Oct/2019 , 8:12:22'),
(62, 'admin : Igor Ginga', '29/Oct/2019 , 8:13:18'),
(63, 'Dennys Jorge', '29/Oct/2019 , 8:15:32'),
(64, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '29/Oct/2019 , 8:17:36'),
(65, 'Dennys Jorge', '29/Oct/2019 , 8:20:14'),
(66, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '29/Oct/2019 , 8:20:38'),
(67, 'admin : Igor Ginga', '29/Oct/2019 , 8:22:21'),
(68, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '02/Nov/2019 , 12:08:56'),
(69, 'admin : Igor Ginga', '02/Nov/2019 , 12:18:16'),
(70, 'Dennys Jorge', '02/Nov/2019 , 13:59:54'),
(71, 'admin : Igor Ginga', '02/Nov/2019 , 14:01:40'),
(72, 'Dennys Jorge', '02/Nov/2019 , 14:23:42'),
(73, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '02/Nov/2019 , 14:25:14'),
(74, 'Dennys Jorge', '05/Nov/2019 , 12:00:09'),
(75, 'admin : Igor Ginga', '05/Nov/2019 , 12:11:02'),
(76, 'admin : Igor Ginga', '05/Nov/2019 , 12:16:15'),
(77, 'admin : Igor Ginga', '05/Nov/2019 , 12:20:30'),
(78, 'admin : Igor Ginga', '09/Nov/2019 , 10:29:59'),
(79, 'admin : Igor Ginga', '11/Nov/2019 , 13:19:19'),
(80, 'Dennys Jorge', '11/Nov/2019 , 13:21:43'),
(81, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '11/Nov/2019 , 13:24:14'),
(82, 'Dennys Jorge', '11/Nov/2019 , 13:37:53'),
(83, '', '11/Nov/2019 , 14:21:30'),
(84, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '11/Nov/2019 , 14:25:08'),
(85, 'Dennys Jorge', '11/Nov/2019 , 14:41:23'),
(86, 'Dennys Jorge', '11/Nov/2019 , 20:00:57'),
(87, 'admin : Igor Ginga', '11/Nov/2019 , 20:05:46'),
(88, 'Dennys Jorge', '11/Nov/2019 , 20:06:47'),
(89, 'Odete Cacoma : Esquadra MÃ³vel do Kilamba', '14/Nov/2019 , 8:21:44'),
(90, 'Dennys Jorge', '14/Nov/2019 , 8:29:56'),
(91, 'Nlandu JoÃ£o  : Esquadra MÃ³vel do Simeone', '14/Nov/2019 , 8:41:55'),
(92, 'Dennys Jorge', '14/Nov/2019 , 9:07:03'),
(93, 'Job Paulo', '14/Nov/2019 , 9:11:08'),
(94, 'admin : Igor Ginga', '14/Nov/2019 , 9:18:32'),
(95, 'admin : Igor Ginga', '14/Nov/2019 , 9:29:48'),
(96, 'Dennys Jorge', '16/Nov/2019 , 9:17:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `municipio`
--

CREATE TABLE `municipio` (
  `id_municipio` int(11) NOT NULL,
  `municipio` varchar(95) NOT NULL,
  `fk_provincia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `municipio`
--

INSERT INTO `municipio` (`id_municipio`, `municipio`, `fk_provincia`) VALUES
(1, 'Talatona', 1),
(2, 'Belas', 1),
(5, 'Viana', 1),
(6, 'Cacuaco', 1),
(7, 'Luanda', 1),
(8, 'Quissama', 1),
(9, 'Cazenga', 1),
(10, 'Ícole e Bengo', 1),
(11, 'Kilamba Kiaxi', 1),
(12, 'Desconhecido', 19);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacao`
--

CREATE TABLE `notificacao` (
  `id_notificacao` int(11) NOT NULL,
  `assunto` text NOT NULL,
  `conteudo` text NOT NULL,
  `usuario` varchar(355) NOT NULL,
  `data_notifica` datetime NOT NULL,
  `acesso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `notificacao`
--

INSERT INTO `notificacao` (`id_notificacao`, `assunto`, `conteudo`, `usuario`, `data_notifica`, `acesso`) VALUES
(1, 'admin: Igor Ginga, Efectuou um novo registro', 'admin: Igor Ginga, Registrou, Nelinho JoÃ£o, que desapareceu em 14-08-2019  .', 'Igor Ginga', '2019-10-15 21:45:18', 'todos'),
(2, 'admin: Igor Ginga, Efectuou AlteraÃ§Ã£o sobre o desaparecido...', 'admin: Igor Ginga, Alterou dados do Nelinho JoÃ£o, que desapareceu em 14-08-2019  .', 'Igor Ginga', '2019-10-15 21:58:32', 'todos'),
(3, 'admin: Igor Ginga, Efectuou AlteraÃ§Ã£o sobre o desaparecido...', 'admin: Igor Ginga, Alterou dados do Maninha Gomes, que desapareceu em 14-04-2019  .', 'Igor Ginga', '2019-11-14 10:39:07', 'todos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagina`
--

CREATE TABLE `pagina` (
  `id_pagina` int(225) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `texto_inicial` text,
  `texto_adicional` text NOT NULL,
  `tag_meta` text NOT NULL,
  `descricao_meta` text NOT NULL,
  `visualizacao` varchar(555) DEFAULT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pagina`
--

INSERT INTO `pagina` (`id_pagina`, `titulo`, `conteudo`, `texto_inicial`, `texto_adicional`, `tag_meta`, `descricao_meta`, `visualizacao`, `estado`) VALUES
(1, 'PÃ¡gina Inicial', '<div class="col-lg-6">\r\n<div class="welcome_text">\r\n<h4>Crian&ccedil;a perdidas, lutam para sobreviver</h4>\r\n\r\n<p>A cada nascer do sol e em grande parte de Angola, especialmente na Prov&iacute;nca de Luanda, crian&ccedil;as e adolescentes partilham, todos os dias, os mesmos cen&aacute;rios de dor e solid&atilde;o.</p>\r\n\r\n<p>Em muitos pontos da capital `Luanda`, com destaque para os arredores do 1.&ordm; de Maio, Aeroporto, Golfe II, Ba&iacute;a de Luanda e Vila de Cacuaco, v&ecirc;em-se petizes mendigarem, em busca de p&atilde;o.</p>\r\n\r\n<p>Pesquisa realizada de Mar&ccedil;o a Junho de 2018 pela organiza&ccedil;&atilde;o Voluntariado Internacional para o Desenvolvimento espelha que 80% das crian&ccedil;as que se encontram nas ruas, em Angola, t&ecirc;m entre 8 e 14 anos.</p>\r\n\r\n<div class="row">\r\n<div class="col-sm-4">\r\n<div class="wel_item">\r\n<h4><span class="milestone_counter" data-end-value="5">0</span>%</h4>\r\n\r\n<p>M&eacute;dia por Semana</p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-sm-4">\r\n<div class="wel_item">\r\n<h4><span class="milestone_counter" data-end-value="10">0</span>%</h4>\r\n\r\n<p>M&eacute;dia por M&ecirc;s</p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-sm-4">\r\n<div class="wel_item">\r\n<h4><span class="milestone_counter" data-end-value="15">0</span>%</h4>\r\n\r\n<p>M&eacute;dia por Ano</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="col-lg-6">\r\n<div class="welcome_img"><img alt="A procura de Desaparecido" class="img-fluid" height="427" src="http://localhost/Projecto Final - Loide Laura/webimg/images/0%2Ce4526f42-c975-4ebb-a76a-235a32d56d85.jpg" width="640" /></div>\r\n</div>\r\n\r\n', '<h5>Precisamos de sua Ajuda para servir a popula&ccedil;&atilde;o Angolana!</h5>\r\n\r\n<h3>Ajuda para aqueles que tem seus parentes ou documento perdidos .</h3>\r\n\r\n<p>Se encontrar algu&eacute;m desaparecido, Dirija-se a esquadra mais<br />\r\npr&oacute;xima da sua localidade.&nbsp;</p>\r\n', '<div class="container">\r\n<center>\r\n<div class="main_title">\r\n<h2>Maior Preocupa&ccedil;&atilde;o</h2>\r\n\r\n<p>Desde muitos anos atr&aacute;s que Luanda registra muitos desaparecidos, outros at&eacute; s&atilde;o encontrados j&aacute; morto. J&aacute; se fala tamb&eacute;m a muito tempo de um n&uacute;mero elevados de pessoas , que perdem seus documentos importantes que por sua vez s&atilde;o condicionados nos locais de servi&ccedil;os e nas outras institui&ccedil;&otilde;es.</p>\r\n</div>\r\n\r\n<section class="donation_details pad_top">\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-3 col-md-6 single_donation_box   alert alert-danger bold">\r\n<h4>Desaparecimento de Pessoas</h4>\r\n\r\n<p>Se tiveres um familiar ou amigo desaparecido, deve, primeiramente, registrar um boletim de ocorr&ecirc;ncia, que pode ser feito pela internet, neste portal , <a href="add_conta.php">Tendo uma conta</a> , ou no <a href="http://www.ssp.sp.gov.br/servicos/mapaTelefones.aspx">distrito policial mais pr&oacute;ximo de sua localidade. </a></p>\r\n</div>\r\n\r\n<div class="col-lg-3 col-md-6 single_donation_box   alert alert-warning bold">\r\n<h4>Fotos de Pessoas</h4>\r\n\r\n<p>Para auxiliar nas buscas, os postos policiais divulgam, na internet, a foto da pessoa desaparecida que for enviada ao departamento policial.</p>\r\n</div>\r\n\r\n<div class="col-lg-3 col-md-6 single_donation_box   alert alert-info">\r\n<h4>Encontro de Documentos</h4>\r\nCaso voc&ecirc; tenha encontrado uma carteira de documentos ou mesmo apenas um documento seja qual for o mesmo deve levar ao posto policial mais pr&oacute;ximo de sua localidade.</div>\r\n\r\n<div class="col-lg-3 col-md-6 single_donation_box   alert alert-success bold">\r\n<h4>Encontro de Pessoas</h4>\r\nCaso voc&ecirc; tenha optado por divulgar a foto da pessoa desaparecida na internet, ap&oacute;s encontr&aacute;-la, comunique tamb&eacute;m os postos policiais, A comunica&ccedil;&atilde;o poder&aacute; ser feita por telefone, pessoalmente ou <a href="http://www.ssp.sp.gov.br/bo/encontroPessoaEntrada.aspx">por meio de formul&aacute;rio</a> .</div>\r\n</div>\r\n</div>\r\n</section>\r\n</center>\r\n\r\n<div class="main_title">\r\n<h2>Nivel Elevado de Documentos Perdidos</h2>\r\n\r\n<p>Desde muitos anos atr&aacute;s que Luanda registra muitos documentos perdidos, J&aacute; se fala tamb&eacute;m a muito tempo de um n&uacute;mero elevados de pessoas , que perdem seus documentos importantes que por sua vez condicionam nos locais de servi&ccedil;os e nas outras institui&ccedil;&otilde;es.</p>\r\n</div>\r\n</div>\r\n', '', '', '2971', '1'),
(2, 'Sobre NÃ³s', '<div class="col-lg-6">\n<div class="welcome_text">\n<h4><span style="font-family:trebuchet ms,helvetica,sans-serif;">Descri&ccedil;&atilde;o &quot;AngoSearch&quot;</span></h4>\n\n<p>Portal que na qual vai ajudar na localiza&ccedil;&atilde;o, de pessoas&nbsp; e documentos perdidos ( Bilhete de identidade, Carta de Condu&ccedil;&atilde;o , cart&atilde;o de multicaixa ou mesmo uma carteira completa ). &Eacute; necess&aacute;rio se&nbsp; encontrar um desaparecido ou mesmo documento que n&atilde;o lhe pertence&nbsp; levar a uma esquadra e por sua vez a esquadra poder&aacute; publicar neste portal<span style="color:#0000FF;"> </span>.</p>\n\n<div class="row">\n<div class="col-sm-4">\n<div class="wel_item">\n<h4><span class="milestone_counter" data-end-value="5">0</span>%</h4>\n\n<p>M&eacute;dia por Semana</p>\n</div>\n</div>\n\n<div class="col-sm-4">\n<div class="wel_item">\n<h4><span class="milestone_counter" data-end-value="10">0</span>%</h4>\n\n<p>M&eacute;dia por M&ecirc;s</p>\n</div>\n</div>\n\n<div class="col-sm-4">\n<div class="wel_item">\n<h4><span class="milestone_counter" data-end-value="15">0</span>%</h4>\n\n<p>M&eacute;dia por Ano</p>\n</div>\n</div>\n</div>\n</div>\n</div>\n\n<div class="col-lg-6">\n<div class="welcome_img"><img alt="A procura de Desaparecido" class="img-fluid" height="449" src="http://localhost/Projecto Final - Loide Laura/webimg/images/TECHNOLOGY-AFRICA-facebook.jpg" width="731" /></div>\n</div>\n', '', '<div class="overlay bg-parallax" data-background="" data-stellar-ratio="0.9" data-stellar-vertical-offset="0">&nbsp;</div>\r\n\r\n<div class="container">\r\n<div class="white_title">\r\n<h2>Objectivos</h2>\r\n\r\n<p>Ajudar na localiza&ccedil;&atilde;o de Documenta&ccedil;&otilde;es e Pessoas Desaparecidas</p>\r\n</div>\r\n\r\n<div class="row feature_inner">\r\n<div class="col-lg-4">\r\n<div class="feature_item">\r\n<h4>Desvantagem na Procura</h4>\r\n\r\n<p>Uma dificuldade encontrada por grande parte das pessoas na procura de seus parentes desaparecidos , &eacute; o m&eacute;todo cujo em Angola &eacute; chamado &quot;Bate - Lata&quot;, uma forma muito esfor&ccedil;ada , menos eficaz e por outro lado muito prejudicial a sa&uacute;de, uma vez que percorrem grandes dist&acirc;ncias .</p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-lg-4">\r\n<div class="feature_item">\r\n<h4>Nivel Elevado de Desaparecidos</h4>\r\n\r\n<p>A sociedade Angolana registra nos ultimos anos, muitos desaprecidos, na sua maioria &quot;Crian&ccedil;as e Adolescentes&quot; .</p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-lg-4">\r\n<div class="feature_item">\r\n<h4>Solu&ccedil;&atilde;o R&aacute;pida e Eficiente</h4>\r\n\r\n<p>Este portal , por sua vez &eacute; um dos meio em na qual o cidad&atilde;o Angolano poder&aacute; encontrar o parente desaparecido com maior rapidez e efic&aacute;cia .<br />\r\n<a href="add_conta.php">Tendo uma conta, ter&aacute; o previl&eacute;gio de publicar o seu desaparecido.</a></p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n', '', '', '357', '1'),
(3, 'Galeria', '<div class="container">\r\n<div class="row"><!-- start course content --><!-- start single course -->\r\n<div class="col-lg-6 col-md-6 col-sm-6">\r\n<div class="single_course wow fadeInUp">\r\n<div class="singCourse_imgarea">\r\n<center><img alt="" height="414" src="http://localhost/Projecto Final - Loide Laura/webimg/images/19507528_304.jpg" style="max-width: 360px;max-height: 260px" /></center>\r\n\r\n<div class="mask"><a class="course_more" href="http://localhost/Projecto Final - Loide Laura/webimg/images/19507528_304.jpg">Visualizar</a></div>\r\n</div>\r\n\r\n<div class="singCourse_content">\r\n<center>\r\n<h3 class="singCourse_title"><a href="http://localhost/Projecto Final - Loide Laura/webimg/images/19507528_304.jpg">Jovem Desaparecido</a></h3>\r\n</center>\r\n</div>\r\n\r\n<div class="singCourse_author"><img alt="img" height="160" src="http://localhost/Projecto Final - Loide Laura/webimg/images/igor.jpg" width="160" />\r\n<p>Igor Ginga, Administrador</p>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- End single course --><!-- start single course -->\r\n\r\n<div class="col-lg-6 col-md-6 col-sm-6">\r\n<div class="single_course wow fadeInUp">\r\n<div class="singCourse_imgarea">\r\n<center><img alt="" height="414" src="http://localhost/Projecto Final - Loide Laura/webimg/images/foto_01_860x608px.jpg" style="max-width: 360px;max-height: 260px" /></center>\r\n\r\n<div class="mask"><a class="course_more" href="http://localhost/Projecto Final - Loide Laura/webimg/images/foto_01_860x608px.jpg">Visualizar</a></div>\r\n</div>\r\n\r\n<div class="singCourse_content">\r\n<center>\r\n<h3 class="singCourse_title"><a href="http://localhost/Projecto Final - Loide Laura/webimg/images/foto_01_860x608px.jpg">Jovem Desaparecida</a></h3>\r\n</center>\r\n</div>\r\n\r\n<div class="singCourse_author"><img alt="img" height="160" src="http://localhost/Projecto Final - Loide Laura/webimg/images/igor.jpg" width="160" />\r\n<p>Igor Ginga, Administrador</p>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- start single course -->\r\n\r\n<div class="col-lg-6 col-md-6 col-sm-6">\r\n<div class="single_course wow fadeInUp">\r\n<div class="singCourse_imgarea">\r\n<center><img alt="" height="414" src="http://localhost/Projecto Final - Loide Laura/webimg/images/causes-3.jpg" style="max-width: 360px;max-height: 260px" /></center>\r\n\r\n<div class="mask"><a class="course_more" href="http://localhost/Projecto Final - Loide Laura/webimg/images/causes-3.jpg">Visualizar</a></div>\r\n</div>\r\n\r\n<div class="singCourse_content">\r\n<center>\r\n<h3 class="singCourse_title"><a href="http://localhost/Projecto Final - Loide Laura/webimg/images/causes-3.jpg">Crian&ccedil;a Desaparecida</a></h3>\r\n</center>\r\n</div>\r\n\r\n<div class="singCourse_author"><img alt="img" src="http://localhost/Projecto Final - Loide Laura/webimg/images/igor.jpg" />\r\n<p>Igor Ginga, Administrador</p>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- End single course --><!-- start single course -->\r\n\r\n<div class="col-lg-6 col-md-6 col-sm-6">\r\n<div class="single_course wow fadeInUp">\r\n<div class="singCourse_imgarea">\r\n<center><img alt="" height="414" src="http://localhost/Projecto Final - Loide Laura/webimg/images/course-1.jpg" style="max-width: 360px;max-height: 260px" /></center>\r\n\r\n<div class="mask"><a class="course_more" href="http://localhost/Projecto Final - Loide Laura/webimg/images/course-1.jpg">Visualizar</a></div>\r\n</div>\r\n\r\n<div class="singCourse_content">\r\n<center>\r\n<h3 class="singCourse_title"><a href="http://localhost/Projecto Final - Loide Laura/webimg/images/course-1.jpg">Jovem a Procura de Solu&ccedil;&atilde;o</a></h3>\r\n</center>\r\n</div>\r\n\r\n<div class="singCourse_author"><img alt="img" src="http://localhost/Projecto Final - Loide Laura/webimg/images/igor.jpg" />\r\n<p>Igor Ginga, Administrador</p>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- End single course --><!-- start single course -->\r\n\r\n<div class="col-lg-6 col-md-6 col-sm-6">\r\n<div class="single_course wow fadeInUp">\r\n<div class="singCourse_imgarea">\r\n<center><img alt="" height="414" src="http://localhost/Projecto Final - Loide Laura/webimg/images/causes-1.jpg" style="max-width: 360px;max-height: 260px" /></center>\r\n\r\n<div class="mask"><a class="course_more" href="http://localhost/Projecto Final - Loide Laura/webimg/images/causes-1.jpg">Visualizar</a></div>\r\n</div>\r\n\r\n<div class="singCourse_content">\r\n<center>\r\n<h3 class="singCourse_title"><a href="http://localhost/Projecto Final - Loide Laura/webimg/images/causes-1.jpg">Meninos Perdidos</a></h3>\r\n</center>\r\n</div>\r\n\r\n<div class="singCourse_author"><img alt="img" src="http://localhost/Projecto Final - Loide Laura/webimg/images/igor.jpg" />\r\n<p>Igor Ginga, Administrador</p>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- End single course --><!-- start single course -->\r\n\r\n<div class="col-lg-6 col-md-6 col-sm-6">\r\n<div class="single_course wow fadeInUp">\r\n<div class="singCourse_imgarea">\r\n<center><img alt="" height="414" src="http://localhost/Projecto Final - Loide Laura/webimg/images/causes-8.jpg" style="max-width: 360px;max-height: 260px" /></center>\r\n\r\n<div class="mask"><a class="course_more" href="http://localhost/Projecto Final - Loide Laura/webimg/images/causes-8.jpg">Visualizar</a></div>\r\n</div>\r\n\r\n<div class="singCourse_content">\r\n<center>\r\n<h3 class="singCourse_title"><a href="http://localhost/Projecto Final - Loide Laura/webimg/images/causes-8.jpg">Meninos Perdidos</a></h3>\r\n</center>\r\n</div>\r\n\r\n<div class="singCourse_author"><img alt="img" src="http://localhost/Projecto Final - Loide Laura/webimg/images/igor.jpg" />\r\n<p>Igor Ginga, Administrador</p>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- End single course --><!-- start single course --><!-- start single course -->\r\n\r\n<div class="col-lg-6 col-md-6 col-sm-6">\r\n<div class="single_course wow fadeInUp">\r\n<div class="singCourse_imgarea">\r\n<center><img alt="" height="414" src="http://localhost/Projecto Final - Loide Laura/webimg/images/causes-7.jpg" style="max-width: 224px;max-height: 225px;margin-bottom: 35px" /></center>\r\n</div>\r\n\r\n<div class="singCourse_content">\r\n<center>\r\n<h3 class="singCourse_title"><a href="http://localhost/Projecto Final - Loide Laura/webimg/images/causes-7.jpg">Menina Desaparecida</a></h3>\r\n</center>\r\n</div>\r\n\r\n<div class="singCourse_author"><img alt="img" src="http://localhost/Projecto Final - Loide Laura/webimg/images/igor.jpg" />\r\n<p>Igor Ginga, Administrador</p>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- End single course --><!-- start single course --><!-- start single course -->\r\n\r\n<div class="col-lg-6 col-md-6 col-sm-6">\r\n<div class="single_course wow fadeInUp">\r\n<div class="singCourse_imgarea">\r\n<center><img alt="" height="414" src="http://localhost/Projecto Final - Loide Laura/webimg/images/d2.jpg" style="max-width: 224px;max-height: 225px;margin-bottom: 35px" /></center>\r\n\r\n<div class="mask"><a class="course_more" href="http://localhost/Projecto Final - Loide Laura/webimg/images/.d2.jpg">Visualizar</a></div>\r\n</div>\r\n\r\n<div class="singCourse_content">\r\n<center>\r\n<h3 class="singCourse_title"><a href="http://localhost/Projecto Final - Loide Laura/webimg/images/d2.jpg">Jovem Desaparecida</a></h3>\r\n</center>\r\n</div>\r\n\r\n<div class="singCourse_author"><img alt="img" src="http://localhost/Projecto Final - Loide Laura/webimg/images/igor.jpg" />\r\n<p>Igor Ginga, Administrador</p>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- End single course --><!-- start single course -->\r\n\r\n<div class="col-lg-6 col-md-6 col-sm-6">\r\n<div class="single_course wow fadeInUp">\r\n<div class="singCourse_imgarea">\r\n<center><img alt="" height="414" src="http://localhost/Projecto Final - Loide Laura/webimg/images/im-10.jpg" style="max-width: 360px;max-height: 260px" /></center>\r\n\r\n<div class="mask"><a class="course_more" href="http://localhost/Projecto Final - Loide Laura/webimg/images/im-10.jpg">Visualizar</a></div>\r\n</div>\r\n\r\n<div class="singCourse_content">\r\n<center>\r\n<h3 class="singCourse_title"><a href="http://localhost/Projecto Final - Loide Laura/webimg/images/im-10.jpg">M&atilde;e desesperada pelo desaparecimento do seu filho</a></h3>\r\n</center>\r\n</div>\r\n\r\n<div class="singCourse_author"><img alt="img" src="http://localhost/Projecto Final - Loide Laura/webimg/images/igor.jpg" />\r\n<p>Igor Ginga, Administrador</p>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- End single course --><!-- start single course -->\r\n\r\n<div class="col-lg-6 col-md-6 col-sm-6">\r\n<div class="single_course wow fadeInUp">\r\n<div class="singCourse_imgarea">\r\n<center><img alt="" height="414" src="http://localhost/Projecto Final - Loide Laura/webimg/images/causes-13.jpg" style="max-width: 360px;max-height: 260px" /></center>\r\n\r\n<div class="mask"><a class="course_more" href="http://localhost/Projecto Final - Loide Laura/webimg/images/causes-13.jpg">Visualizar</a></div>\r\n</div>\r\n\r\n<div class="singCourse_content">\r\n<center>\r\n<h3 class="singCourse_title"><a href="http://localhost/Projecto Final - Loide Laura/webimg/images/causes-13.jpg">Jovem chora pela sua irm&atilde; perdida </a></h3>\r\n</center>\r\n</div>\r\n\r\n<div class="singCourse_author"><img alt="img" src="http://localhost/Projecto Final - Loide Laura/webimg/images/igor.jpg" />\r\n<p>Igor Ginga, Administrador</p>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- End single course --><!-- End single course --></div>\r\n<!-- start previous & next button --></div>\r\n', '', '', '', '', '304', '1'),
(4, 'Contacte-Nos', '<div class="container">&nbsp;\n<div class="row justify-content">\n<div class="col-lg-3">\n<div class="contact_info">\n<div class="info_item">\n<h6><span class="fa fa-map-marker"></span> Luanda, Angola</h6>\n\n<p>Instalado em Esquadras , Postos policias e Monoblocos</p>\n</div>\n\n<div class="info_item">\n<h6><span class="fa fa-phone"></span><a href="#"> (+244) 933 988 158</a></h6>\n\n<p>Segunda a Sexta das 9h &agrave; 18h</p>\n</div>\n\n<div class="info_item">\n<h6><span class="fa fa-envelope"></span><a href="#"> angosearch@gmail.com</a></h6>\n\n<p>Nos envie a qualquer hora sua quest&atilde;o!</p>\n</div>\n</div>\n</div>\n\n<div class="col-md-7">\n<h2 class="section-title mb-3" style="color: #555;">Messagem para N&oacute;s</h2>\n\n<p class="mb-5" style="color: #444;">Em caso de uma sugest&atilde;o , cr&iacute;tica ou solicita&ccedil;&atilde;o clique em <a href="add_conta.php">Criar Conta</a> para poder faze-lo e tamb&eacute;m para poder interagir com os postos policiais de Luanda .</p>\n\n<p class="mb-5" style="color: #444;">Caso j&aacute; tenha uma conta no AngoSearch, para fazer uma sugest&atilde;o , cr&iacute;tica ou solicita&ccedil;&atilde;o clique em <a href="login-usuario.php">Minha Conta</a> acessando assim , ao sistema para poder faze-lo e tamb&eacute;m para poder interagir com os postos policiais de Luanda .</p>\n</div>\n</div>\n</div>\n', '', '', '', '', '198', '1'),
(5, 'Desaparecidos: Pessoas', '', NULL, '', '', '', '514', '1'),
(6, 'Desaparecidos: Documentos', '', NULL, '', '', '', '131', '1'),
(7, 'Encontrados: Pessoas', '', NULL, '', '', '', '186', '1'),
(8, 'Encontrados: Documentos', '', NULL, '', '', '', '100', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `provincia`
--

CREATE TABLE `provincia` (
  `id_provincia` int(11) NOT NULL,
  `provincia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `provincia`
--

INSERT INTO `provincia` (`id_provincia`, `provincia`) VALUES
(2, 'Bengo'),
(17, 'Benguela'),
(11, 'Bié'),
(10, 'Cabinda'),
(16, 'Cuando-Cubango'),
(15, 'Cunene'),
(19, 'Desconhecido'),
(18, 'Huambo'),
(12, 'Huíla'),
(4, 'Kwanza Norte'),
(3, 'Kwanza Sul'),
(1, 'Luanda '),
(7, 'Lunda Norte'),
(8, 'Lunda Sul'),
(6, 'Malanje'),
(5, 'Moxico'),
(9, 'Namibe'),
(14, 'Uíge'),
(13, 'Zaire');

-- --------------------------------------------------------

--
-- Estrutura da tabela `rodape`
--

CREATE TABLE `rodape` (
  `id_rodape` int(11) NOT NULL,
  `rodape` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `rodape`
--

INSERT INTO `rodape` (`id_rodape`, `rodape`) VALUES
(1, '<div class="row">\r\n            <div class="col-lg-2 col-sm-6 single-footer-widget">\r\n                <h4>ANGOSEARCH</h4>\r\n                <ul>\r\n                    <li><a href="sobre.php">Projecto, que vai ajudar a População de Angola,\r\n                            na localização, das Pessoas Desaparecidas e dos Documentos Perdidos.\r\n\r\n                        </a></li>\r\n\r\n                </ul>\r\n            </div>\r\n            <div class="col-lg-2 col-sm-6 single-footer-widget">\r\n                <h4>Links do Portal</h4>\r\n                <ul>\r\n                    <li><a href="index.php">Página Inicial</a></li>\r\n                    <li><a href="sobre.php">Sobre</a></li>\r\n                    <li><a href="galeria.php">Galeria</a></li>\r\n                    <li><a href="contacto.php">Contacte-nos</a></li>\r\n                </ul>\r\n            </div>\r\n            <div class="col-lg-2 col-sm-6 single-footer-widget">\r\n                <h4>Desaparecimento</h4>\r\n                <ul>\r\n                    <li><a href="todosDesaparecidos.php">Pessoas Perdidas</a></li>\r\n                    <li><a href="todosDocDesaparecidos.php">Documentos Perdidos</a></li>\r\n                    <li><a href="pessoas_encontradas.php">Pessoas Encontradas</a></li>\r\n                    <li><a href="todosDocEncontrados.php">Documentos Encontrados</a></li>\r\n                </ul>\r\n            </div>\r\n            <div class="col-lg-2 col-sm-6 single-footer-widget">\r\n                <h4>Interatividade</h4>\r\n                <ul>\r\n                    <li><a href="login-usuario.php">Fazer Login</a></li>\r\n                    <li><a href="add_conta.php">Criar Conta</a></li>\r\n                    <li><a href="#">Políticas</a></li>\r\n                    <li><a href="#">Termos</a></li>\r\n                </ul>\r\n            </div>\r\n            <div class="col-lg-4 col-md-6 single-footer-widget">\r\n                <h4>Receber Notificação</h4>\r\n                <p>Você será notificado em caso de novo desaparecimento. Basta enviar-nos seu E-mail.</p>\r\n                <div class="form-wrap" id="mc_embed_signup">\r\n                    <form target="_blank" action=""\r\n                          method="post" class="form-inline">\r\n                        <input class="form-control" name="EMAIL" placeholder="Teu Endereço de E-mail" onfocus="this.placeholder = ''''"\r\n                               onblur="this.placeholder = ''Teu Endereço de E-mail''"\r\n                               required="required" type="email" />\r\n                        <button class="click-btn btn btn-default">\r\n                            <i class="ti-arrow-right"></i>\r\n                        </button>\r\n                        <div style="position: absolute; left: -5000px;">\r\n                            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text" />\r\n                        </div>\r\n\r\n                        <div class="info"></div>\r\n                    </form>\r\n                </div>\r\n            </div>\r\n        </div>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoesquadra`
--

CREATE TABLE `tipoesquadra` (
  `id_tipoEsquadra` int(11) NOT NULL,
  `tipoEsquadra` varchar(95) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipoesquadra`
--

INSERT INTO `tipoesquadra` (`id_tipoEsquadra`, `tipoEsquadra`) VALUES
(1, 'Esquadra Movel'),
(2, 'Esquadra Fixa'),
(3, 'Monobloco'),
(6, 'Posto Policial');

-- --------------------------------------------------------

--
-- Estrutura da tabela `trafego`
--

CREATE TABLE `trafego` (
  `id_trafego` int(11) NOT NULL,
  `dt` varchar(200) NOT NULL,
  `pagina` varchar(200) NOT NULL,
  `ip` varchar(200) NOT NULL,
  `cidade` varchar(200) NOT NULL,
  `regiao` varchar(200) NOT NULL,
  `pais` varchar(200) NOT NULL,
  `navegador` varchar(200) NOT NULL,
  `referencia` varchar(200) NOT NULL,
  `plataforma` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `trafego`
--

INSERT INTO `trafego` (`id_trafego`, `dt`, `pagina`, `ip`, `cidade`, `regiao`, `pais`, `navegador`, `referencia`, `plataforma`) VALUES
(21, '2019-08-25 00:51:11', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(22, '2019-08-25 00:51:25', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(23, '2019-08-25 00:51:45', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(24, '2019-08-25 00:51:51', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(25, '2019-08-25 00:52:17', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(26, '2019-08-25 01:22:03', '/Projecto Final - Loide Laura/php/todosDocEncontrados.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(27, '2019-08-25 01:22:17', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(28, '2019-08-25 01:37:49', '/Projecto Final - Loide Laura/php/todosDocDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(29, '2019-08-25 01:45:13', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(30, '2019-08-25 20:33:22', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(31, '2019-08-25 20:33:27', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(32, '2019-08-25 20:36:05', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Edge', 'Navegação Interna', 'windows 10'),
(33, '2019-08-25 20:36:32', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Edge', 'Navegação Interna', 'windows 10'),
(34, '2019-08-26 19:59:43', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(35, '2019-08-26 20:00:12', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(36, '2019-08-26 20:00:39', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(37, '2019-08-26 20:02:29', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(38, '2019-08-27 00:01:49', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(39, '2019-08-27 00:14:37', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(40, '2019-08-27 00:17:39', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(41, '2019-08-27 00:18:33', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(42, '2019-08-27 00:18:52', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(43, '2019-08-27 00:19:07', '/Projecto Final - Loide Laura/php/todosDocEncontrados.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(44, '2019-08-27 17:16:16', '/Projecto Final - Loide Laura/php/todosDocDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Edge', 'Navegação Interna', 'windows 10'),
(45, '2019-08-27 17:17:06', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Edge', 'Navegação Interna', 'windows 10'),
(46, '2019-08-27 18:38:32', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Edge', 'Navegação Interna', 'windows 10'),
(47, '2019-08-27 19:21:20', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Edge', 'Navegação Interna', 'windows 10'),
(48, '2019-08-27 19:21:42', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Edge', 'Navegação Interna', 'windows 10'),
(49, '2019-08-27 19:43:50', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Edge', 'Navegação Interna', 'windows 10'),
(50, '2019-08-27 21:30:32', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Edge', 'Navegação Interna', 'windows 10'),
(51, '2019-08-27 23:07:59', '/Projecto Final - Loide Laura/php/todosDocEncontrados.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Edge', 'Navegação Interna', 'windows 10'),
(52, '2019-08-27 23:27:30', '/Projecto Final - Loide Laura/php/todosDocDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(53, '2019-08-27 23:37:15', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Internet Explorer', 'Navegação Interna', 'windows 10'),
(54, '2019-08-27 23:37:21', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Internet Explorer', 'Navegação Interna', 'windows 10'),
(55, '2019-08-27 23:37:46', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Internet Explorer', 'Navegação Interna', 'windows 10'),
(56, '2019-08-27 23:38:41', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Internet Explorer', 'Navegação Interna', 'windows 10'),
(57, '2019-08-27 23:38:46', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Internet Explorer', 'Navegação Interna', 'windows 10'),
(58, '2019-08-28 00:00:04', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(59, '2019-08-28 00:02:44', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(60, '2019-08-28 00:38:55', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(61, '2019-08-28 00:44:10', '/Projecto Final - Loide Laura/php/todosDocDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(62, '2019-08-28 02:32:27', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(63, '2019-08-28 03:07:07', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(64, '2019-08-28 03:08:07', '/Projecto Final - Loide Laura/php/todosDocEncontrados.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(65, '2019-08-28 03:08:37', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(66, '2019-08-29 11:01:45', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(67, '2019-08-29 11:29:14', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(68, '2019-08-29 12:21:26', '/Projecto Final - Loide Laura/php/galeria.php?q=&seach=', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(69, '2019-08-30 06:06:13', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(70, '2019-08-30 06:28:19', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(71, '2019-08-30 19:18:31', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(72, '2019-08-30 19:19:23', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(73, '2019-08-30 19:19:58', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(74, '2019-08-30 19:20:14', '/Projecto Final - Loide Laura/php/todosDocDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(75, '2019-08-30 19:20:22', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(76, '2019-08-30 19:20:26', '/Projecto Final - Loide Laura/php/todosDocEncontrados.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(77, '2019-08-30 19:20:35', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(78, '2019-08-30 19:21:01', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'windows 8.1'),
(79, '2019-08-30 22:04:30', '/Projecto Final - Loide Laura/php/angosearch/utilizador/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(80, '2019-08-30 22:20:57', '/Projecto Final - Loide Laura/php/angosearch/utilizador/maisDesaparecido.php?id_desaparecido=13', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(81, '2019-08-31 00:05:01', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(82, '2019-08-31 00:05:21', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(83, '2019-09-01 21:12:35', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(84, '2019-09-01 21:13:04', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(85, '2019-09-02 01:23:40', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(86, '2019-09-02 01:23:46', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(87, '2019-09-02 22:27:15', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(88, '2019-09-02 22:30:25', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(89, '2019-09-02 22:30:45', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(90, '2019-09-02 22:31:00', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(91, '2019-09-02 22:31:08', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(92, '2019-09-04 23:09:16', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(93, '2019-09-04 23:11:02', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(94, '2019-09-04 23:11:41', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(95, '2019-09-04 23:30:28', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(96, '2019-09-04 23:41:42', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(97, '2019-09-04 23:41:50', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(98, '2019-09-05 00:13:12', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(99, '2019-09-05 00:14:27', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(100, '2019-09-05 00:17:15', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(101, '2019-09-05 01:45:03', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(102, '2019-09-05 17:41:56', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(103, '2019-09-05 17:42:07', '/Projecto Final - Loide Laura/php/todosDocDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(104, '2019-09-05 17:42:11', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(105, '2019-09-05 17:43:13', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(106, '2019-09-06 00:04:40', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(107, '2019-09-06 00:48:57', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(108, '2019-09-06 00:49:17', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(109, '2019-09-06 00:50:46', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(110, '2019-09-06 00:53:45', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(111, '2019-09-06 12:22:30', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(112, '2019-09-06 14:02:19', '/Projecto Final - Loide Laura/php/todosDocDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(113, '2019-09-06 14:02:33', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(114, '2019-09-17 12:28:49', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(115, '2019-09-17 12:29:20', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(116, '2019-09-17 12:29:45', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(117, '2019-09-17 12:30:10', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(118, '2019-09-17 12:31:08', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(119, '2019-09-18 06:58:09', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(120, '2019-09-18 07:00:30', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(121, '2019-09-18 07:00:53', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(122, '2019-09-19 12:32:46', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(123, '2019-09-19 12:51:50', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(124, '2019-09-19 13:07:20', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(125, '2019-09-19 13:07:58', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(126, '2019-09-19 12:33:58', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(127, '2019-09-19 19:55:06', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Acesso Direito', 'Android'),
(128, '2019-09-19 19:58:04', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Acesso Direito', 'Android'),
(129, '2019-09-19 19:58:23', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'Android'),
(130, '2019-09-19 19:59:10', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'Android'),
(131, '2019-09-19 20:01:36', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'Android'),
(132, '2019-09-19 20:02:35', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'Android'),
(133, '2019-09-19 20:02:38', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'Android'),
(134, '2019-09-19 21:08:36', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Acesso Direito', 'Android'),
(135, '2019-09-19 21:11:43', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'Android'),
(136, '2019-09-19 21:12:23', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'Android'),
(137, '2019-09-19 21:15:32', '/Projecto Final - Loide Laura/php/todosDocDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'Android'),
(138, '2019-09-22 19:50:15', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(139, '2019-09-22 21:23:44', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(140, '2019-09-23 01:05:04', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(141, '2019-09-23 01:06:03', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(142, '2019-09-23 01:19:16', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(143, '2019-09-23 01:46:06', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(144, '2019-09-23 01:46:24', '/Projecto Final - Loide Laura/php/todosDocDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(145, '2019-09-23 02:07:13', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(146, '2019-09-24 16:34:55', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(147, '2019-09-24 16:35:14', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(148, '2019-09-24 16:43:00', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Acesso Direito', 'Android'),
(149, '2019-09-24 16:45:18', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'Android'),
(150, '2019-09-24 19:14:29', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(151, '2019-09-24 19:14:51', '/Projecto Final - Loide Laura/php/todosDocEncontrados.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(152, '2019-09-25 01:30:53', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(153, '2019-09-25 10:50:25', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(154, '2019-09-25 11:01:52', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(155, '2019-09-25 11:04:36', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(156, '2019-09-25 12:58:10', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(157, '2019-09-26 00:11:58', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(158, '2019-09-27 14:58:17', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(159, '2019-09-28 12:09:15', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Acesso Direito', 'Android'),
(160, '2019-09-28 12:11:28', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(161, '2019-09-28 12:12:24', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'Android'),
(162, '2019-09-29 09:46:14', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(163, '2019-09-29 10:26:07', '/Projecto Final - Loide Laura/php/todosDocEncontrados.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(164, '2019-09-29 10:28:19', '/Projecto Final - Loide Laura/php/todosDocDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(165, '2019-09-29 13:23:30', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(166, '2019-10-01 12:32:03', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(167, '2019-10-01 13:04:16', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Acesso Direito', 'Android'),
(168, '2019-10-01 13:05:21', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'Android'),
(169, '2019-10-01 13:05:57', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'Android'),
(170, '2019-10-01 13:08:23', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(171, '2019-10-01 13:08:32', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(172, '2019-10-01 13:09:11', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'Android'),
(173, '2019-10-01 17:17:28', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Acesso Direito', 'Android'),
(174, '2019-10-01 18:50:08', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Opera', 'Navegação Interna', 'windows 8.1'),
(175, '2019-10-02 09:21:36', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(176, '2019-10-02 14:45:10', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(177, '2019-10-02 18:27:21', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(178, '2019-10-02 18:29:56', '/Projecto Final - Loide Laura/php/todosDocDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(179, '2019-10-02 18:30:11', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(180, '2019-10-02 19:55:14', '/Projecto Final - Loide Laura/php/todosDocEncontrados.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(181, '2019-10-02 20:02:48', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(182, '2019-10-02 20:27:13', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(183, '2019-10-02 20:44:17', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(184, '2019-10-03 07:04:11', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(185, '2019-10-03 18:44:00', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(186, '2019-10-04 08:32:06', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(187, '2019-10-06 18:57:32', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(188, '2019-10-06 21:35:40', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(189, '2019-10-06 21:37:28', '/Projecto Final - Loide Laura/php/todosDocDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(190, '2019-10-06 21:38:41', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(191, '2019-10-06 22:34:36', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(192, '2019-10-08 14:27:18', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(193, '2019-10-08 14:29:16', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(194, '2019-10-08 14:29:37', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(195, '2019-10-08 14:32:17', '/Projecto Final - Loide Laura/php/todosDocDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(196, '2019-10-08 14:33:59', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(197, '2019-10-08 14:34:11', '/Projecto Final - Loide Laura/php/todosDocEncontrados.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(198, '2019-10-08 14:34:20', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(199, '2019-10-08 14:35:03', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(200, '2019-10-09 01:01:37', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Opera', 'Navegação Interna', 'windows 8.1'),
(201, '2019-10-14 22:20:46', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(202, '2019-10-15 00:02:01', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(203, '2019-10-15 00:02:14', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(204, '2019-10-16 14:53:34', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(205, '2019-10-16 14:54:19', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(206, '2019-10-16 16:09:57', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Opera', 'Navegação Interna', 'windows 8.1'),
(207, '2019-10-24 10:47:54', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(208, '2019-10-24 10:50:01', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Internet Explorer', 'Navegação Interna', 'windows 8.1'),
(209, '2019-10-29 08:17:27', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(210, '2019-10-29 08:17:34', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(211, '2019-10-29 09:18:31', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(212, '2019-11-05 11:10:34', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(213, '2019-11-05 11:10:48', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(214, '2019-11-05 11:15:06', '/Projecto Final - Loide Laura/php/contacto.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(215, '2019-11-05 11:29:59', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(216, '2019-11-05 12:59:52', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(217, '2019-11-05 13:02:31', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(218, '2019-11-05 13:02:42', '/Projecto Final - Loide Laura/php/todosDocDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(219, '2019-11-05 13:03:05', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(220, '2019-11-05 13:04:52', '/Projecto Final - Loide Laura/php/todosDocEncontrados.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(221, '2019-11-09 11:18:51', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Internet Explorer', 'Acesso Direito', 'windows 8'),
(222, '2019-11-09 11:18:58', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(223, '2019-11-09 11:20:42', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(224, '2019-11-09 11:21:04', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(225, '2019-11-09 11:30:13', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(226, '2019-11-09 11:45:33', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(227, '2019-11-09 11:47:28', '/Projecto Final - Loide Laura/php/todosDocEncontrados.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(228, '2019-11-11 14:12:45', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Internet Explorer', 'Acesso Direito', 'windows 8'),
(229, '2019-11-11 14:12:50', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Acesso Direito', 'windows 8.1'),
(230, '2019-11-11 14:13:58', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(231, '2019-11-11 14:14:24', '/Projecto Final - Loide Laura/php/todosDocDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(232, '2019-11-11 14:14:43', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(233, '2019-11-11 14:14:49', '/Projecto Final - Loide Laura/php/todosDocEncontrados.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(234, '2019-11-11 14:14:54', '/Projecto Final - Loide Laura/php/galeria.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(235, '2019-11-11 14:19:28', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(236, '2019-11-11 14:22:42', '/Projecto Final - Loide Laura/php/sobre.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(237, '2019-11-11 21:15:49', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Acesso Direito', 'Android'),
(238, '2019-11-11 21:18:44', '/Projecto Final - Loide Laura/php/todosDesaparecidos.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Chrome', 'Navegação Interna', 'Android'),
(239, '2019-11-14 09:21:45', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(240, '2019-11-14 09:22:10', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(241, '2019-11-14 10:18:46', '/Projecto Final - Loide Laura/php/pessoas_encontradas.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(242, '2019-11-16 10:11:55', '/Projecto Final - Loide Laura/php/angosearch/utilizador/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1'),
(243, '2019-11-16 10:17:31', '/Projecto Final - Loide Laura/php/index.php', '129.122.148.198', 'Talatona', 'Luanda', 'Angola', 'Firefox', 'Navegação Interna', 'windows 8.1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `id_utilizador` int(11) NOT NULL,
  `nome_completo` varchar(95) NOT NULL,
  `foto` varchar(300) DEFAULT NULL,
  `bi` varchar(45) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `fk_bairro` int(11) DEFAULT NULL,
  `fk_genero` int(11) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(260) DEFAULT NULL,
  `nota` text,
  `dataRegistro` datetime DEFAULT NULL,
  `dataExcluido` datetime DEFAULT NULL,
  `cod_confirmacao` varchar(8) NOT NULL,
  `estado` enum('1','0') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`id_utilizador`, `nome_completo`, `foto`, `bi`, `nascimento`, `fk_bairro`, `fk_genero`, `telefone`, `email`, `nota`, `dataRegistro`, `dataExcluido`, `cod_confirmacao`, `estado`) VALUES
(1, 'aguinaldo', NULL, NULL, NULL, NULL, 1, '987-654-565', 'hhh@gmail.com', NULL, '2019-08-26 20:44:39', NULL, '492069', '0'),
(14, 'Job Paulo', '0512897200.jpg', '87654LN0986', '0000-00-00', 1, 1, '925 251 135', 'jobpaulo@gmail.com', 'Bom Ã© ser utilizador deste portal que muito vai ajudar nossos compatriotas                                                                ', '2019-08-30 05:31:00', NULL, '492069', '1'),
(15, 'Dennys Jorge', '0222533400.jpg', '098LA987678', '0000-00-00', 1, 1, '939 717 724', 'ruimalemba11@gmail.com', '\r\n', '2019-09-01 22:20:16', NULL, '492069', '1'),
(16, 'Nlandu JoÃ£o Cante', 'usuario.png', NULL, NULL, 5, 3, '987 656 789', 'nlandu@gmail.com', NULL, '2019-09-06 14:18:34', NULL, '492069', '1'),
(17, 'Bondoso Alberto', 'usuario.png', NULL, NULL, 5, 3, '987 656 789', 'bondosoalberto@gmail.com', NULL, '2019-10-02 19:56:34', NULL, '492069', '1'),
(18, 'Josemar Joaquim', 'usuario.png', NULL, '1970-01-01', 5, 3, '945 220 335', 'josemarjoaquim@gmail.com', '                                            ', '2019-10-02 20:36:53', NULL, '492069', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bairro`
--
ALTER TABLE `bairro`
  ADD PRIMARY KEY (`id_bairro`),
  ADD KEY `bairro pertence a um distrito_idx` (`fk_distrito`),
  ADD KEY `fk_municipio` (`fk_municipio`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `fk_desaparecido` (`fk_desaparecido`),
  ADD KEY `utilizador` (`utilizador`);

--
-- Indexes for table `definicoes`
--
ALTER TABLE `definicoes`
  ADD PRIMARY KEY (`id_definicoes`);

--
-- Indexes for table `desaparecidos`
--
ALTER TABLE `desaparecidos`
  ADD PRIMARY KEY (`id_desaparecido`),
  ADD KEY `desaparecido vivi em um bairro_idx` (`fk_bairro`),
  ADD KEY `desaparecido tem um genero_idx` (`fk_genero`),
  ADD KEY `fk_provincia` (`fk_provincia`);

--
-- Indexes for table `distrito`
--
ALTER TABLE `distrito`
  ADD PRIMARY KEY (`id_distrito`),
  ADD UNIQUE KEY `distrito_UNIQUE` (`distrito`),
  ADD KEY `distrito pertence a um municipio_idx` (`fk_municipio`);

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_doc`);

--
-- Indexes for table `esquadra`
--
ALTER TABLE `esquadra`
  ADD PRIMARY KEY (`id_esquadra`),
  ADD KEY `um posto policial está localizado em um bairro_idx` (`fk_bairro`),
  ADD KEY `um posto tem um tipo_idx` (`fk_tipoEsquadra`);

--
-- Indexes for table `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`),
  ADD UNIQUE KEY `genero_UNIQUE` (`genero`);

--
-- Indexes for table `inicia_sessao`
--
ALTER TABLE `inicia_sessao`
  ADD PRIMARY KEY (`id_iniciaSessao`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `fk_esquadra` (`fk_esquadra`),
  ADD KEY `fk_utilizador` (`fk_utilizador`);

--
-- Indexes for table `logout`
--
ALTER TABLE `logout`
  ADD PRIMARY KEY (`id_logout`);

--
-- Indexes for table `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id_municipio`),
  ADD UNIQUE KEY `municipio_UNIQUE` (`municipio`),
  ADD KEY `municipio pertence a uma provincia_idx` (`fk_provincia`);

--
-- Indexes for table `notificacao`
--
ALTER TABLE `notificacao`
  ADD PRIMARY KEY (`id_notificacao`);

--
-- Indexes for table `pagina`
--
ALTER TABLE `pagina`
  ADD PRIMARY KEY (`id_pagina`);

--
-- Indexes for table `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id_provincia`),
  ADD UNIQUE KEY `provincia_UNIQUE` (`provincia`);

--
-- Indexes for table `rodape`
--
ALTER TABLE `rodape`
  ADD PRIMARY KEY (`id_rodape`);

--
-- Indexes for table `tipoesquadra`
--
ALTER TABLE `tipoesquadra`
  ADD PRIMARY KEY (`id_tipoEsquadra`);

--
-- Indexes for table `trafego`
--
ALTER TABLE `trafego`
  ADD PRIMARY KEY (`id_trafego`);

--
-- Indexes for table `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`id_utilizador`),
  ADD KEY `utilizador possui genero_idx` (`fk_genero`),
  ADD KEY `utilizador é natural de uma provincia_idx` (`fk_bairro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bairro`
--
ALTER TABLE `bairro`
  MODIFY `id_bairro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `desaparecidos`
--
ALTER TABLE `desaparecidos`
  MODIFY `id_desaparecido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `distrito`
--
ALTER TABLE `distrito`
  MODIFY `id_distrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `esquadra`
--
ALTER TABLE `esquadra`
  MODIFY `id_esquadra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `inicia_sessao`
--
ALTER TABLE `inicia_sessao`
  MODIFY `id_iniciaSessao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `logout`
--
ALTER TABLE `logout`
  MODIFY `id_logout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `notificacao`
--
ALTER TABLE `notificacao`
  MODIFY `id_notificacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tipoesquadra`
--
ALTER TABLE `tipoesquadra`
  MODIFY `id_tipoEsquadra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `trafego`
--
ALTER TABLE `trafego`
  MODIFY `id_trafego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;
--
-- AUTO_INCREMENT for table `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `id_utilizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `bairro`
--
ALTER TABLE `bairro`
  ADD CONSTRAINT `bairro pertence a um distrito` FOREIGN KEY (`fk_distrito`) REFERENCES `distrito` (`id_distrito`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `bairro_ibfk_1` FOREIGN KEY (`fk_municipio`) REFERENCES `municipio` (`id_municipio`);

--
-- Limitadores para a tabela `desaparecidos`
--
ALTER TABLE `desaparecidos`
  ADD CONSTRAINT `desaparecido tem um genero` FOREIGN KEY (`fk_genero`) REFERENCES `genero` (`id_genero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `desaparecido vivi em um bairro` FOREIGN KEY (`fk_bairro`) REFERENCES `bairro` (`id_bairro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `desaparecidos_ibfk_1` FOREIGN KEY (`fk_provincia`) REFERENCES `provincia` (`id_provincia`);

--
-- Limitadores para a tabela `distrito`
--
ALTER TABLE `distrito`
  ADD CONSTRAINT `distrito pertence a um municipio` FOREIGN KEY (`fk_municipio`) REFERENCES `municipio` (`id_municipio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `esquadra`
--
ALTER TABLE `esquadra`
  ADD CONSTRAINT `um posto policial está localizado em um bairro` FOREIGN KEY (`fk_bairro`) REFERENCES `bairro` (`id_bairro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `um posto tem um tipo` FOREIGN KEY (`fk_tipoEsquadra`) REFERENCES `tipoesquadra` (`id_tipoEsquadra`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`fk_esquadra`) REFERENCES `esquadra` (`id_esquadra`),
  ADD CONSTRAINT `login_ibfk_2` FOREIGN KEY (`fk_utilizador`) REFERENCES `utilizador` (`id_utilizador`);

--
-- Limitadores para a tabela `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `municipio pertence a uma provincia` FOREIGN KEY (`fk_provincia`) REFERENCES `provincia` (`id_provincia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD CONSTRAINT `utilizador possui genero` FOREIGN KEY (`fk_genero`) REFERENCES `genero` (`id_genero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `utilizador é vive em um determinado bairro` FOREIGN KEY (`fk_bairro`) REFERENCES `bairro` (`id_bairro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
