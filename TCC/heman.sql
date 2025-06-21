-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/06/2025 às 06:02
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `heman`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` char(11) NOT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `frequencia` int(11) DEFAULT NULL,
  `objetivo` varchar(255) DEFAULT NULL,
  `data_matricula` date DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`id`, `nome`, `data_nascimento`, `cpf`, `telefone`, `endereco`, `frequencia`, `objetivo`, `data_matricula`, `ativo`) VALUES
(30, 'Alexandre Rossi Benassi', '2004-02-03', '06879534996', '44997011869', 'Avenida Guiomar Gaspar', 5, 'Ficar musculoso', '2025-06-13', 1),
(31, 'João Vitor', '1998-12-31', '10987678909', '44997168633', 'Avenida Torres', 5, 'asdasd', '2025-06-13', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `criar_aula`
--

CREATE TABLE `criar_aula` (
  `id` int(11) NOT NULL,
  `nome_aula` varchar(100) NOT NULL,
  `dia_aula` varchar(100) NOT NULL,
  `horario_aula` time NOT NULL,
  `professor_aula` varchar(100) NOT NULL,
  `local_aula` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `criar_aula`
--

INSERT INTO `criar_aula` (`id`, `nome_aula`, `dia_aula`, `horario_aula`, `professor_aula`, `local_aula`) VALUES
(15, 'Treino', 'segunda', '17:30:00', 'Alexandre Rossi Benassi', 'Sala 3');

-- --------------------------------------------------------

--
-- Estrutura para tabela `dieta`
--

CREATE TABLE `dieta` (
  `id` int(11) NOT NULL,
  `nome_aluno` varchar(50) NOT NULL,
  `dia_refeicao` varchar(50) NOT NULL,
  `tipo_refeicao` varchar(50) NOT NULL,
  `horario_refeicao` time NOT NULL,
  `descricao` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dieta`
--

INSERT INTO `dieta` (`id`, `nome_aluno`, `dia_refeicao`, `tipo_refeicao`, `horario_refeicao`, `descricao`) VALUES
(6, '31', 'SEXTA', 'Café da Manhã', '12:12:00', 'Josevaldo romero brito\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa\r\naaaaaaaaaa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento_aluno`
--

CREATE TABLE `evento_aluno` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `exercicio`
--

CREATE TABLE `exercicio` (
  `nome` varchar(255) NOT NULL,
  `tipo_exercicio` varchar(255) NOT NULL,
  `grupo_muscular` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `exercicio`
--

INSERT INTO `exercicio` (`nome`, `tipo_exercicio`, `grupo_muscular`, `id`) VALUES
('Corrida', 'CARDIO', 'ABDÔMEN', 11),
('Abdominal', 'MUSCULAÇÃO', 'ABDÔMEN', 12),
('Campe', 'MUSCULAÇÃO', 'CARDIO', 13),
('Terra', 'CARDIO', 'ABDÔMEN', 14),
('ASD', 'CARDIO', 'CARDIO', 15);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ficha`
--

CREATE TABLE `ficha` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `dia_treino` varchar(335) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ficha`
--

INSERT INTO `ficha` (`id`, `aluno_id`, `dia_treino`) VALUES
(12, 30, 'SEGUNDA'),
(13, 30, 'QUARTA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ficha_exercicio`
--

CREATE TABLE `ficha_exercicio` (
  `id` int(11) NOT NULL,
  `ficha_id` int(11) DEFAULT NULL,
  `exercicio_id` int(11) DEFAULT NULL,
  `num_series` int(11) DEFAULT NULL,
  `num_repeticoes` int(11) DEFAULT NULL,
  `tempo_descanso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ficha_exercicio`
--

INSERT INTO `ficha_exercicio` (`id`, `ficha_id`, `exercicio_id`, `num_series`, `num_repeticoes`, `tempo_descanso`) VALUES
(30, 12, 13, 30, 12, 30),
(31, 13, 15, 4, 12, 30),
(32, 13, 13, 4, 12, 30),
(33, 13, 14, 4, 12, 30);

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `turno_disponivel` varchar(255) DEFAULT NULL,
  `data_matricula` date NOT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `cpf` varchar(11) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `nome`, `data_nascimento`, `telefone`, `endereco`, `turno_disponivel`, `data_matricula`, `ativo`, `cpf`) VALUES
(45, 'Alexandre Rossi Benassi', '2025-05-07', '44997168633', 'Rua Presidente Feliz Paiva 527', 'Tarde', '2025-05-29', 1, '58226792002'),
(46, 'Alexandre Rossi Benassi', '2025-06-11', '44997168633', 'Rua presidente Vargas', 'Manha', '2025-06-13', 0, '06879534994'),
(47, 'Alexandre Rossi Benassi', '2025-06-04', '44997168633', 'Rua Presidente Feliz Paiva 527', NULL, '2025-06-13', 1, '06879534999'),
(48, 'Izabela Cabral Goya', '2025-05-13', '44098789876', 'Rua Presidente Feliz Paiva 527', 'Manha', '2025-06-13', 1, '06879534991');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf_unico` (`cpf`) USING BTREE;

--
-- Índices de tabela `criar_aula`
--
ALTER TABLE `criar_aula`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `dieta`
--
ALTER TABLE `dieta`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `evento_aluno`
--
ALTER TABLE `evento_aluno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evento_id` (`evento_id`),
  ADD KEY `aluno_id` (`aluno_id`);

--
-- Índices de tabela `exercicio`
--
ALTER TABLE `exercicio`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ficha_exercicio`
--
ALTER TABLE `ficha_exercicio`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf_unico_funcionario` (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `criar_aula`
--
ALTER TABLE `criar_aula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `dieta`
--
ALTER TABLE `dieta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `evento_aluno`
--
ALTER TABLE `evento_aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `exercicio`
--
ALTER TABLE `exercicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `ficha_exercicio`
--
ALTER TABLE `ficha_exercicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `evento_aluno`
--
ALTER TABLE `evento_aluno`
  ADD CONSTRAINT `evento_aluno_ibfk_1` FOREIGN KEY (`evento_id`) REFERENCES `criar_aula` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evento_aluno_ibfk_2` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
