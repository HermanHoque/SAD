-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- A despejar estrutura da base de dados para escolah
DROP DATABASE IF EXISTS `escolah`;
CREATE DATABASE IF NOT EXISTS `escolah` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `escolah`;

-- A despejar estrutura para tabela escolah.admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pass` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pass` (`pass`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela escolah.admin: ~0 rows (aproximadamente)
INSERT INTO `admin` (`id`, `pass`) VALUES
	(1, '12345');

-- A despejar estrutura para tabela escolah.aluno
DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `id_turma` int NOT NULL,
  `id_curso` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_turma` (`id_turma`),
  KEY `id_curso` (`id_curso`),
  CONSTRAINT `id_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`),
  CONSTRAINT `id_turma` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela escolah.aluno: ~8 rows (aproximadamente)
INSERT INTO `aluno` (`id`, `nome`, `genero`, `data_nascimento`, `id_turma`, `id_curso`) VALUES
	(200, 'Celso Manuel', 'masculino', '2003-03-12', 5, 1),
	(201, 'Rosa Isabel', 'feminino', '2004-07-25', 5, 1),
	(203, 'Mateus Joaquim', 'masculino', '2002-09-18', 5, 1),
	(204, 'Ana Cristina', 'feminino', '2001-12-04', 5, 1),
	(205, 'Dário Sebastião', 'masculino', '2003-06-09', 5, 1),
	(206, 'Lúcia Domingos', 'feminino', '2004-02-17', 2, 2),
	(207, 'Nelson António', 'masculino', '2003-08-30', 6, 2),
	(208, 'Marta Joaquim', 'feminino', '2002-05-11', 6, 2),
	(209, 'Edson Mateus', 'masculino', '2000-10-21', 5, 1);

-- A despejar estrutura para tabela escolah.ano_lectivo
DROP TABLE IF EXISTS `ano_lectivo`;
CREATE TABLE IF NOT EXISTS `ano_lectivo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `inicio_ano` date NOT NULL,
  `fim_ano` date NOT NULL,
  `data_criacao` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela escolah.ano_lectivo: ~0 rows (aproximadamente)
INSERT INTO `ano_lectivo` (`id`, `nome`, `inicio_ano`, `fim_ano`, `data_criacao`) VALUES
	(1, '2024/2025', '2024-11-16', '2025-11-16', '2024-11-16');

-- A despejar estrutura para tabela escolah.avaliaçao
DROP TABLE IF EXISTS `avaliaçao`;
CREATE TABLE IF NOT EXISTS `avaliaçao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pontualidade` float NOT NULL,
  `apresentacao` float NOT NULL,
  `dominio_cadeira` float NOT NULL,
  `modo_avaliacao` float NOT NULL,
  `presenca` float NOT NULL,
  `organizacao` float NOT NULL,
  `explicacao_materia` float NOT NULL,
  `id_prof` int NOT NULL,
  `id_disciplina` int NOT NULL,
  `id_aluno` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prof` (`id_prof`),
  KEY `id_disciplina` (`id_disciplina`),
  KEY `id_aluno` (`id_aluno`),
  CONSTRAINT `id_aluno` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id`),
  CONSTRAINT `id_disciplina` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id`),
  CONSTRAINT `id_prof` FOREIGN KEY (`id_prof`) REFERENCES `professor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela escolah.avaliaçao: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela escolah.curso
DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela escolah.curso: ~13 rows (aproximadamente)
INSERT INTO `curso` (`id`, `nome`) VALUES
	(1, 'Engenharia Informática'),
	(2, 'Engenharia Eletronica e Telecomunicação'),
	(3, 'Direito'),
	(4, 'Gestão de Empresa'),
	(5, 'Gestão de Recursos Humano'),
	(6, 'Economia'),
	(7, 'Psicologia'),
	(8, 'Analises Clinicas'),
	(9, 'Enfermagem'),
	(10, 'Fisioterapia'),
	(11, 'Ciencias Alimentares(Nutrição)'),
	(12, 'Sociologia'),
	(13, 'Comunicação Social');

-- A despejar estrutura para tabela escolah.disciplina
DROP TABLE IF EXISTS `disciplina`;
CREATE TABLE IF NOT EXISTS `disciplina` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela escolah.disciplina: ~44 rows (aproximadamente)
INSERT INTO `disciplina` (`id`, `nome`) VALUES
	(1, 'Analise Matemática I'),
	(2, 'Física'),
	(3, 'Lingua Portuguesa'),
	(4, 'Ingles I'),
	(5, 'Algebra Linear'),
	(6, 'Introdução a Informatica'),
	(7, 'Introdução a Economia'),
	(8, 'Planeamento Estrategicos'),
	(9, 'Sistemas Inteligentes'),
	(10, 'Engenharia de Software'),
	(11, 'Analise Matemática II'),
	(12, 'Engenharia de Rede I'),
	(13, 'Engenharia de Rede II'),
	(14, 'Computação Grafica'),
	(15, 'IPC'),
	(16, 'Fundanentos de Programação I'),
	(17, 'Fundanentos de Programação II'),
	(18, 'Estatistica I'),
	(19, 'Estatistica II'),
	(20, 'Sistemas Operativos'),
	(21, 'Base de Dados I'),
	(22, 'Base de Dados II'),
	(23, 'Matematica Discreta'),
	(24, 'Sistemas Digitais I'),
	(25, 'Sistemas Digitais II'),
	(26, 'MIC'),
	(27, 'Analise Matemática III'),
	(28, 'Arquitetura de Computadores'),
	(29, 'Analise Numerica'),
	(30, 'Técnicas Labo.em Electrônica'),
	(31, 'Estágio Supervisionado'),
	(32, 'Sistemas de Comunicação I'),
	(33, 'Sistemas de Comunicação II'),
	(34, 'Intro. à Análise e Process. de sinal'),
	(35, 'Electrônica I'),
	(36, 'Electrônica II'),
	(37, 'Electrotecnia Teórica'),
	(38, 'Métodos Probabilísticos em Electrotecnia'),
	(39, 'Projecto Final I'),
	(40, 'Projecto Final II'),
	(41, 'Telecom I'),
	(42, 'Telecom II'),
	(43, 'Qualidade nos Sist. de Informação'),
	(44, 'Redes de Alto Debito');

-- A despejar estrutura para tabela escolah.disc_curso
DROP TABLE IF EXISTS `disc_curso`;
CREATE TABLE IF NOT EXISTS `disc_curso` (
  `id_disciplina` int NOT NULL,
  `id_curso` int NOT NULL,
  KEY `id_disciplina` (`id_disciplina`),
  KEY `id_curso` (`id_curso`),
  CONSTRAINT `FK__curso_` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`),
  CONSTRAINT `FK__disciplina` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela escolah.disc_curso: ~15 rows (aproximadamente)
INSERT INTO `disc_curso` (`id_disciplina`, `id_curso`) VALUES
	(2, 1),
	(1, 1),
	(14, 1),
	(10, 1),
	(8, 1),
	(9, 1),
	(12, 1),
	(15, 2),
	(2, 2),
	(32, 2),
	(33, 2),
	(34, 2),
	(35, 2),
	(36, 2),
	(38, 2),
	(37, 2);

-- A despejar estrutura para tabela escolah.horario
DROP TABLE IF EXISTS `horario`;
CREATE TABLE IF NOT EXISTS `horario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dia_semana` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fim` time NOT NULL,
  `id_turma` int NOT NULL,
  `id_disci` int NOT NULL,
  `id_professor` int NOT NULL DEFAULT '0',
  `id_sala` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_turma` (`id_turma`),
  KEY `id_disci` (`id_disci`),
  KEY `id_professor` (`id_professor`),
  KEY `id_sala` (`id_sala`),
  CONSTRAINT `FK__disciplina_horario` FOREIGN KEY (`id_disci`) REFERENCES `disciplina` (`id`),
  CONSTRAINT `FK__professor_horario` FOREIGN KEY (`id_professor`) REFERENCES `professor` (`id`),
  CONSTRAINT `FK__sala_horario` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id`),
  CONSTRAINT `FK__turma_horario` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela escolah.horario: ~2 rows (aproximadamente)
INSERT INTO `horario` (`id`, `dia_semana`, `hora_inicio`, `hora_fim`, `id_turma`, `id_disci`, `id_professor`, `id_sala`) VALUES
	(1, 'segunda-feira', '07:31:00', '09:30:00', 1, 1, 1, 1),
	(2, 'segunda-feira', '10:45:00', '13:05:00', 1, 2, 2, 1);

-- A despejar estrutura para tabela escolah.matricula
DROP TABLE IF EXISTS `matricula`;
CREATE TABLE IF NOT EXISTS `matricula` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int NOT NULL,
  `id_turma` int NOT NULL,
  `id_ano_lectivo` int NOT NULL,
  `data_matricula` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aluno` (`id_aluno`),
  KEY `id_turma` (`id_turma`),
  KEY `id_ano_lectivo` (`id_ano_lectivo`),
  CONSTRAINT `FK__aluno` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id`),
  CONSTRAINT `FK__ano_lectivo` FOREIGN KEY (`id_ano_lectivo`) REFERENCES `ano_lectivo` (`id`),
  CONSTRAINT `FK__turma` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela escolah.matricula: ~0 rows (aproximadamente)
INSERT INTO `matricula` (`id`, `id_aluno`, `id_turma`, `id_ano_lectivo`, `data_matricula`) VALUES
	(1, 200, 1, 1, '2024-11-16');

-- A despejar estrutura para tabela escolah.professor
DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` int DEFAULT NULL,
  `genero` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pass` (`pass`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `telefone` (`telefone`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela escolah.professor: ~7 rows (aproximadamente)
INSERT INTO `professor` (`id`, `nome`, `pass`, `Email`, `telefone`, `genero`) VALUES
	(1, 'Helena Manuel', 'Prof#A821', 'helena.manuel@example.com', 923456701, 'feminino'),
	(2, 'Ricardo António', 'Prof#B734', 'ricardo.antonio@example.com', 924567812, 'masculino'),
	(3, 'Teresa Joaquim', 'Prof#C659', 'teresa.joaquim@example.com', 925678123, 'feminino'),
	(4, 'Bruno Sebastião', 'Prof#D482', 'bruno.sebastiao@example.com', 926789234, 'masculino'),
	(5, 'Carla Domingos', 'Prof#E517', 'carla.domingos@example.com', 927891345, 'feminino'),
	(6, 'Mário Francisco', 'Prof#F963', 'mario.francisco@example.com', 928912456, 'masculino'),
	(7, 'Sónia Mateus', 'Prof#G246', 'sonia.mateus@example.com', 929123567, 'feminino');

-- A despejar estrutura para tabela escolah.prof_curso
DROP TABLE IF EXISTS `prof_curso`;
CREATE TABLE IF NOT EXISTS `prof_curso` (
  `id_prof` int NOT NULL,
  `id_curso` int NOT NULL,
  KEY `id_prof` (`id_prof`),
  KEY `id_curso` (`id_curso`),
  CONSTRAINT `FK__curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`),
  CONSTRAINT `FK__professor` FOREIGN KEY (`id_prof`) REFERENCES `professor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela escolah.prof_curso: ~9 rows (aproximadamente)
INSERT INTO `prof_curso` (`id_prof`, `id_curso`) VALUES
	(1, 1),
	(1, 2),
	(2, 1),
	(4, 1),
	(3, 1),
	(3, 2),
	(5, 1),
	(3, 2),
	(6, 2),
	(7, 2);

-- A despejar estrutura para tabela escolah.prof_disciplina
DROP TABLE IF EXISTS `prof_disciplina`;
CREATE TABLE IF NOT EXISTS `prof_disciplina` (
  `id_prof` int NOT NULL,
  `id_disciplina` int NOT NULL,
  KEY `id_prof` (`id_prof`),
  KEY `id_disciplina` (`id_disciplina`),
  CONSTRAINT `FK__disciplina_` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id`),
  CONSTRAINT `FK__professor_` FOREIGN KEY (`id_prof`) REFERENCES `professor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela escolah.prof_disciplina: ~12 rows (aproximadamente)
INSERT INTO `prof_disciplina` (`id_prof`, `id_disciplina`) VALUES
	(1, 15),
	(2, 16),
	(2, 21),
	(2, 10),
	(4, 14),
	(4, 9),
	(5, 8),
	(5, 12),
	(3, 2),
	(3, 32),
	(6, 35),
	(6, 37),
	(7, 38),
	(3, 34);

-- A despejar estrutura para tabela escolah.sala
DROP TABLE IF EXISTS `sala`;
CREATE TABLE IF NOT EXISTS `sala` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela escolah.sala: ~15 rows (aproximadamente)
INSERT INTO `sala` (`id`, `nome`) VALUES
	(1, 'E002'),
	(2, 'E001'),
	(3, 'E003'),
	(4, 'A001'),
	(5, 'A002'),
	(6, 'A003'),
	(7, 'B001'),
	(8, 'B002'),
	(9, 'B003'),
	(10, 'C001'),
	(11, 'C002'),
	(12, 'C003'),
	(13, 'F001'),
	(14, 'F002'),
	(15, 'F003');

-- A despejar estrutura para tabela escolah.turma
DROP TABLE IF EXISTS `turma`;
CREATE TABLE IF NOT EXISTS `turma` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `periodo` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ano` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sala` int NOT NULL,
  `id_ano_lectivo` int NOT NULL,
  `id_curso` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sala` (`id_sala`),
  KEY `id_ano_lectivo` (`id_ano_lectivo`),
  KEY `id_curso` (`id_curso`),
  CONSTRAINT `id_ano_lectivo` FOREIGN KEY (`id_ano_lectivo`) REFERENCES `ano_lectivo` (`id`),
  CONSTRAINT `id_cusro` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`),
  CONSTRAINT `id_sala` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela escolah.turma: ~0 rows (aproximadamente)
INSERT INTO `turma` (`id`, `nome`, `periodo`, `ano`, `id_sala`, `id_ano_lectivo`, `id_curso`) VALUES
	(1, 'Info_Ano_1_A', 'Manhã', '1º', 4, 1, 1),
	(2, 'Eletro_Ano_1_A', 'Manhã', '1º', 7, 1, 2),
	(3, 'Info_Ano_2_A', 'Manhã', '2º', 5, 1, 1),
	(4, 'Eletro_Ano_2_A', 'Manhã', '2º', 8, 1, 2),
	(5, 'Info_Ano_3_A', 'Manhã', '3º', 6, 1, 1),
	(6, 'Eletro_Ano_3_A', 'Manhã', '3º', 9, 1, 2);

-- A despejar estrutura para tabela escolah.turma_disc
DROP TABLE IF EXISTS `turma_disc`;
CREATE TABLE IF NOT EXISTS `turma_disc` (
  `id_turma` int NOT NULL,
  `id_disc` int NOT NULL,
  KEY `id_turma` (`id_turma`),
  KEY `id_disc` (`id_disc`),
  CONSTRAINT `FK__turma_turma_disc` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id`),
  CONSTRAINT `FK_disciplina_turma_disc` FOREIGN KEY (`id_disc`) REFERENCES `disciplina` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- A despejar dados para tabela escolah.turma_disc: ~15 rows (aproximadamente)
INSERT INTO `turma_disc` (`id_turma`, `id_disc`) VALUES
	(1, 2),
	(1, 1),
	(5, 14),
	(5, 12),
	(5, 13),
	(5, 10),
	(5, 8),
	(5, 9),
	(2, 15),
	(2, 2),
	(6, 32),
	(6, 34),
	(6, 35),
	(6, 37),
	(6, 38);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;