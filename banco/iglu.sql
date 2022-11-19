-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Nov-2022 às 05:23
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `iglu`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcargo`
--

CREATE TABLE `tbcargo` (
  `idCargo` int(11) NOT NULL,
  `nomeCargo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbcargo`
--

INSERT INTO `tbcargo` (`idCargo`, `nomeCargo`) VALUES
(1, 'Administrador '),
(2, 'Atendente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategoria`
--

CREATE TABLE `tbcategoria` (
  `idCategoria` int(11) NOT NULL,
  `nomeCategoria` varchar(150) NOT NULL,
  `descricaoCategoria` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategoriaproduto`
--

CREATE TABLE `tbcategoriaproduto` (
  `idCategoriaProduto` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcliente`
--

CREATE TABLE `tbcliente` (
  `idCliente` int(11) NOT NULL,
  `nomeCliente` varchar(150) NOT NULL,
  `telCliente` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfornecedor`
--

CREATE TABLE `tbfornecedor` (
  `idFornecedor` int(11) NOT NULL,
  `nomeEmpresaFornecedor` varchar(150) NOT NULL,
  `nomeFornecedor` varchar(150) NOT NULL,
  `emailEmpresarialFornecedor` varchar(150) NOT NULL,
  `emailContatoFornecedor` varchar(150) NOT NULL,
  `telEmpresarialFornecedor` varchar(15) DEFAULT NULL,
  `telContatoFornecedor` varchar(15) NOT NULL,
  `cnpjFornecedor` varchar(20) NOT NULL,
  `logradouroEndereco` varchar(150) NOT NULL,
  `numeroEndereco` int(10) NOT NULL,
  `complementoEndereco` varchar(50) DEFAULT NULL,
  `bairroEndereco` varchar(100) NOT NULL,
  `cidadeEndereco` varchar(100) NOT NULL,
  `ufEndereco` varchar(2) NOT NULL,
  `cepEndereco` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfunc`
--

CREATE TABLE `tbfunc` (
  `idFunc` int(11) NOT NULL,
  `cpfFunc` varchar(15) NOT NULL,
  `rgFunc` varchar(15) NOT NULL,
  `nomeFunc` varchar(150) NOT NULL,
  `generoFunc` char(1) NOT NULL,
  `dataNascFunc` date NOT NULL,
  `dataContratoFunc` date NOT NULL,
  `naturalidadeFunc` char(2) NOT NULL,
  `emailFunc` varchar(150) NOT NULL,
  `telFunc` varchar(15) NOT NULL,
  `senhaFunc` char(12) NOT NULL,
  `logradouroEndereco` varchar(150) NOT NULL,
  `numeroEndereco` int(10) NOT NULL,
  `complementoEndereco` varchar(50) DEFAULT NULL,
  `bairroEndereco` varchar(100) NOT NULL,
  `cidadeEndereco` varchar(100) NOT NULL,
  `ufEndereco` varchar(2) NOT NULL,
  `cepEndereco` varchar(12) DEFAULT NULL,
  `idCargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbfunc`
--

INSERT INTO `tbfunc` (`idFunc`, `cpfFunc`, `rgFunc`, `nomeFunc`, `generoFunc`, `dataNascFunc`, `dataContratoFunc`, `naturalidadeFunc`, `emailFunc`, `telFunc`, `senhaFunc`, `logradouroEndereco`, `numeroEndereco`, `complementoEndereco`, `bairroEndereco`, `cidadeEndereco`, `ufEndereco`, `cepEndereco`, `idCargo`) VALUES
(1, '123.456.987-12', '54.065.978-1', 'Clarice  Tânia Carolina', 'F', '1990-01-05', '2022-10-04', 'SP', 'downilolopes@gmail.com', '(11) 2702-2738', 'clarice123', 'R. da Lua', 15, NULL, 'Jd. Ruyce', 'Diadema', 'SP', '09981-480', 1),
(2, '133.447.988-21', '20.345.433-1', 'Cláudio Paulo Araújo', 'M', '1999-10-23', '1899-03-13', 'BA', 'claudio.paulo.araujo@gmail.com', '(11) 3907-6552', 'claudio123', 'R. Tamoios', 399, '', 'Conceição', 'Diadema', 'SP', '09991-070', 1),
(3, '417.271.991-04', '40.599.014-3', 'Maria Carvalho Dias', 'F', '2002-04-14', '2021-08-12', 'SP', 'marcia.caroline@gmail.com', '(11) 2506-9252', 'marcia123', 'R. do Socialismo Científico', 100, NULL, 'Conceição', 'Diadema', 'SP', '09993-140', 2),
(4, '137.921.230-05', '21.300.400-3', 'Rodrigo Juan Claudio', 'M', '1999-07-29', '2022-10-04', 'SP', 'rodrigoduarte06@gmail.com', '(11) 2668-9942', 'rodrigo123', 'R. Glauber Rocha', 40, NULL, 'Serraria', 'Diadema', 'SP', '09980-760', 2),
(14, '137.921.230-05', '21.300.400-3', 'Teste', 'M', '1999-07-29', '2022-10-04', 'SP', 'teste@gmail.com', '(11) 2668-9942', 'teste', 'R. da Lua', 15, NULL, 'Serraria', 'Diadema', 'SP', '09981-480', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpagamento`
--

CREATE TABLE `tbpagamento` (
  `idPagamento` int(11) NOT NULL,
  `metodoPagamento` varchar(75) NOT NULL,
  `valorPagamento` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpedido`
--

CREATE TABLE `tbpedido` (
  `idPedido` int(11) NOT NULL,
  `statusPedido` varchar(50) NOT NULL,
  `valorTotalPedido` decimal(10,0) NOT NULL,
  `dataPedido` datetime NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idPagamento` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbproduto`
--

CREATE TABLE `tbproduto` (
  `idProduto` int(11) NOT NULL,
  `nomeProduto` varchar(150) NOT NULL,
  `descricaoProduto` varchar(300) DEFAULT NULL,
  `imagemProduto` varchar(255) NOT NULL,
  `dataVerificacaoProduto` date NOT NULL,
  `dataFabricacaoProduto` date NOT NULL,
  `qtdeProduto` int(11) NOT NULL,
  `precoProduto` decimal(10,0) NOT NULL,
  `pesoProduto` decimal(10,0) NOT NULL,
  `loteProduto` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbcargo`
--
ALTER TABLE `tbcargo`
  ADD PRIMARY KEY (`idCargo`);

--
-- Índices para tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Índices para tabela `tbcategoriaproduto`
--
ALTER TABLE `tbcategoriaproduto`
  ADD PRIMARY KEY (`idCategoriaProduto`),
  ADD KEY `idCategoria` (`idCategoria`),
  ADD KEY `idProduto` (`idProduto`);

--
-- Índices para tabela `tbcliente`
--
ALTER TABLE `tbcliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Índices para tabela `tbfornecedor`
--
ALTER TABLE `tbfornecedor`
  ADD PRIMARY KEY (`idFornecedor`);

--
-- Índices para tabela `tbfunc`
--
ALTER TABLE `tbfunc`
  ADD PRIMARY KEY (`idFunc`),
  ADD KEY `idCargo` (`idCargo`);

--
-- Índices para tabela `tbpagamento`
--
ALTER TABLE `tbpagamento`
  ADD PRIMARY KEY (`idPagamento`);

--
-- Índices para tabela `tbpedido`
--
ALTER TABLE `tbpedido`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `tbpedido_ibfk_1` (`idPagamento`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idProduto` (`idProduto`);

--
-- Índices para tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  ADD PRIMARY KEY (`idProduto`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbcargo`
--
ALTER TABLE `tbcargo`
  MODIFY `idCargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbcategoriaproduto`
--
ALTER TABLE `tbcategoriaproduto`
  MODIFY `idCategoriaProduto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbfornecedor`
--
ALTER TABLE `tbfornecedor`
  MODIFY `idFornecedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbfunc`
--
ALTER TABLE `tbfunc`
  MODIFY `idFunc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `tbpagamento`
--
ALTER TABLE `tbpagamento`
  MODIFY `idPagamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbpedido`
--
ALTER TABLE `tbpedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tbcategoriaproduto`
--
ALTER TABLE `tbcategoriaproduto`
  ADD CONSTRAINT `tbcategoriaproduto_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `tbcategoria` (`idCategoria`),
  ADD CONSTRAINT `tbcategoriaproduto_ibfk_2` FOREIGN KEY (`idProduto`) REFERENCES `tbproduto` (`idProduto`);

--
-- Limitadores para a tabela `tbfunc`
--
ALTER TABLE `tbfunc`
  ADD CONSTRAINT `tbfunc_ibfk_1` FOREIGN KEY (`idCargo`) REFERENCES `tbcargo` (`idCargo`);

--
-- Limitadores para a tabela `tbpedido`
--
ALTER TABLE `tbpedido`
  ADD CONSTRAINT `tbpedido_ibfk_1` FOREIGN KEY (`idPagamento`) REFERENCES `tbpagamento` (`idPagamento`),
  ADD CONSTRAINT `tbpedido_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `tbcliente` (`idCliente`),
  ADD CONSTRAINT `tbpedido_ibfk_3` FOREIGN KEY (`idProduto`) REFERENCES `tbproduto` (`idProduto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
