-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 22, 2025 at 10:36 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: ` nexus_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
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
  `password` varchar(255) NOT NULL,
  `user_type` enum('A','C') NOT NULL COMMENT 'A=Administrador, C=Cliente',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(6,2) NOT NULL,
  `platform` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `stock` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_date` date DEFAULT NULL,
  `status` enum('Pendente','Processando','Enviado','Entregue','Cancelado') NOT NULL,
  `total_value` decimal(6,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `game_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price_at_purchase` decimal(6,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------


--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `date_of_birth`, `gender`, `mother_name`, `cpf`, `email`, `mobile_phone`, `home_phone`, `street`, `number`, `complement`, `zip_code`, `neighborhood`, `city`, `state`, `login`, `password`, `user_type`, `created_at`, `updated_at`) VALUES
(3, 'FREDI WALLACE OLIVEIRA DA SILVA', '2021-02-02', 'Masculin', 'Matilde', '33333333333', 'Wallace@gmail.com', '21985396305', '21985396305', 'Rua Odete Lara', '74', 'Bl12', '23036-156', 'Campo Grande', 'Angra dos Reis', 'RJ', 'Fred', '$2y$10$nCb6s.eM2QhvqnfyOMPiGOUrNmrnf8f84DcR8mOJpPEEvjWmnWQCq', 'C', '2025-10-14 08:55:55', '2025-10-14 09:44:41'),
(4, 'Arthur Pendragon', '0500-01-01', 'M', 'Mae Arthur', '111.111.111-11', 'arthur@email.com', '(11) 11111-1111', NULL, 'Rua da Távola', '1', NULL, '11111-111', 'Camelot', 'Londres', 'UK', 'arthurp', 'history1', 'C', '2025-10-16 18:33:15', '2025-10-16 18:33:15'),
(5, 'Alexandre Magnus', '0356-07-20', 'M', 'Mae Alexandre', '222.222.222-22', 'alexandre@email.com', '(22) 22222-2222', NULL, 'Rua da Conquista', '2', NULL, '22222-222', 'Macedônia', 'Pella', 'MA', 'alexandrem', 'history2', 'C', '2025-10-16 18:33:15', '2025-10-16 18:33:15'),
(6, 'Ricardo Coração de Leão', '1157-09-08', 'M', 'Mae Ricardo', '333.333.333-33', 'ricardo@email.com', '(33) 33333-3333', NULL, 'Rua Cruzada', '3', NULL, '33333-333', 'Aquitânia', 'Poitiers', 'FR', 'ricardocl', 'history3', 'C', '2025-10-16 18:33:15', '2025-10-16 18:33:15'),
(7, 'Joana D Arc', '1412-01-06', 'F', 'Mae Joana', '444.444.444-44', 'joana@email.com', '(44) 44444-4444', NULL, 'Rua da Heroína', '4', NULL, '44444-444', 'Lorena', 'Domrémy', 'FR', 'joanadarc', 'history4', 'C', '2025-10-16 18:33:15', '2025-10-16 18:33:15'),
(8, 'Maria Antonieta', '1755-11-02', 'F', 'Mae Maria', '555.555.555-55', 'mariaa@email.com', '(55) 55555-5555', NULL, 'Rua da Rainha', '5', NULL, '55555-555', 'Palácio', 'Versalhes', 'FR', 'mariaant', 'history5', 'C', '2025-10-16 18:33:15', '2025-10-16 18:33:15'),
(9, 'Vlad Empalador', '1431-12-06', 'M', 'Mae Vlad', '666.666.666-66', 'vlad@email.com', '(66) 66666-6666', NULL, 'Rua da Valaquia', '6', NULL, '66666-666', 'Transilvânia', 'Sighisoara', 'RO', 'vlademp', 'history6', 'C', '2025-10-16 18:33:15', '2025-10-16 18:33:15'),
(10, 'Cleópatra VII', '0069-01-01', 'F', 'Mae Cleópatra', '777.777.777-77', 'cleopatra@email.com', '(77) 77777-7777', NULL, 'Rua do Nilo', '7', NULL, '77777-777', 'Ptolomeu', 'Alexandria', 'EG', 'cleopatra', 'history7', 'C', '2025-10-16 18:33:15', '2025-10-16 18:33:15'),
(11, 'Administrador Master', '1980-01-01', 'M', 'Mae Administrador', '000.000.000-00', 'admin@email.com', '(00) 00000-0000', '(00) 0000-0000', 'Rua Principal', '1', 'Sala', '00000-000', 'Centro', 'Capital', 'CA', 'admin', 'admin', 'A', '2025-10-16 18:35:31', '2025-10-16 18:35:31'),
(12, 'Júlio César', '0100-07-13', 'M', 'Mae Júlio', '888.888.888-88', 'julio@email.com', '(88) 88888-8888', NULL, 'Rua de Roma', '8', NULL, '88888-888', 'Império', 'Roma', 'IT', 'julioc', 'history8', 'C', '2025-10-16 18:36:39', '2025-10-16 18:36:39'),
(13, 'Elizabeth Tudor', '1533-09-07', 'F', 'Mae Elizabeth', '999.999.999-99', 'elizabeth@email.com', '(99) 99999-9999', NULL, 'Rua da Inglaterra', '9', NULL, '99999-999', 'Tudor', 'Greenwich', 'UK', 'elizabetht', 'history9', 'C', '2025-10-16 18:36:39', '2025-10-16 18:36:39'),
(14, 'Napoleão Bonaparte', '1769-08-15', 'M', 'Mae Napoleão', '100.000.000-00', 'napoleao@email.com', '(10) 00000-0000', NULL, 'Rua do Imperador', '10', NULL, '10000-000', 'Córsega', 'Ajaccio', 'FR', 'napoleao', 'history10', 'C', '2025-10-16 18:36:39', '2025-10-16 18:36:39'),
(15, 'Thiago Rocha', '1984-04-28', 'Masculino', 'Marilda', '33333333323', 'thiago.alves.rocha@souunisuam.com.br', '21999999999', '21333333333', 'Rua das flores', '123', '', '23013510', 'Maré', 'Rio de Janeiro', 'RJ', 'thiagoRocha', '$2y$10$PhLNzI9M3wN04rj9P5S2DeLuR/hHbLUwXbRr2voEyQrB0fv/l.eeS', 'C', '2025-10-22 22:12:35', '2025-10-22 22:12:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
