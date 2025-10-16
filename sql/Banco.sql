-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.4.3 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para  nexus_database
CREATE DATABASE IF NOT EXISTS ` nexus_database` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE ` nexus_database`;

-- Copiando estrutura para tabela  nexus_database.games
CREATE TABLE IF NOT EXISTS `games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(6,2) NOT NULL,
  `platform` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `stock` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela  nexus_database.games: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela  nexus_database.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_date` date DEFAULT NULL,
  `status` enum('Pendente','Processando','Enviado','Entregue','Cancelado') NOT NULL,
  `total_value` decimal(6,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela  nexus_database.orders: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela  nexus_database.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `game_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price_at_purchase` decimal(6,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `game_id` (`game_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela  nexus_database.order_items: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela  nexus_database.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mother_name` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile_phone` varchar(16) DEFAULT NULL,
  `home_phone` varchar(16) DEFAULT NULL,
  `street` varchar(80) DEFAULT NULL,
  `number` varchar(5) DEFAULT NULL,
  `complement` varchar(20) DEFAULT NULL,
  `zip_code` varchar(9) DEFAULT NULL,
  `neighborhood` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(2) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_type` enum('A','C') NOT NULL COMMENT 'A=Administrador,\r\nC=Cliente',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela  nexus_database.users: ~1 rows (aproximadamente)
INSERT INTO `users` (`id`, `full_name`, `date_of_birth`, `gender`, `mother_name`, `cpf`, `email`, `mobile_phone`, `home_phone`, `street`, `number`, `complement`, `zip_code`, `neighborhood`, `city`, `state`, `login`, `password`, `user_type`, `created_at`, `updated_at`) VALUES
	(3, 'FREDI WALLACE OLIVEIRA DA SILVA', '2021-02-02', 'Masculino', 'Matilde', '33333333333', 'Wallace@gmail.com', '21985396305', '21985396305', 'Rua Odete Lara', '74', 'Bl12', '23036-156', 'Campo Grande', 'Angra dos Reis', 'RJ', 'Fred', '$2y$10$nCb6s.eM2QhvqnfyOMPiGOUrNmrnf8f84DcR8mOJpPEEvjWmnWQCq', 'C', '2025-10-14 08:55:55', '2025-10-14 09:44:41');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
