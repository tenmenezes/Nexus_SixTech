-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2025 at 11:07 PM
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
-- Database: `nexus_database`
--

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nascimento` date DEFAULT NULL,
  `genero` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mae` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `celular` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fixo` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `rua` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `numero` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `complemento` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cep` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bairro` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cidade` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `estado` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('A','C') NOT NULL COMMENT 'A=Administrador, C=Cliente',
  `criado` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nome`, `nascimento`, `genero`, `mae`, `cpf`, `email`, `celular`, `fixo`, `rua`, `numero`, `complemento`, `cep`, `bairro`, `cidade`, `estado`, `login`, `password`, `user_type`, `criado`, `atualizado`) VALUES
(3, 'Fredi Wallace', '2021-02-02', 'Masculin', 'Matilde', '33333333333', 'Wallace@gmail.com', '21985396305', '21985396305', 'Rua Odete Lara', '74', 'Bl12', '23036-156', 'Campo Grande', 'Angra dos Reis', 'RJ', 'Fred', '$2y$10$uRaokjyc44b0hwneU5shM.9cHMNcOU1aFO2gWaAV58tt8gsqI.qNi', 'C', '2025-10-14 08:55:55', '2025-11-10 18:24:41'),
(4, 'Arthur Pendragon', '0500-01-01', 'M', 'Mae Arthur', '111.111.111-11', 'arthur@email.com', '(11) 11111-1111', NULL, 'Rua da Távola', '1', NULL, '11111-111', 'Camelot', 'Londres', 'UK', 'arthurp', '$2y$10$i90V.qycN7lcPOMAA9KTvOu1uNPxtFNib2G453EKGNpLynZGCPqoO', 'C', '2025-10-16 18:33:15', '2025-11-10 16:49:06'),
(5, 'Alexandre Magnus', '0356-07-20', 'M', 'Mae Alexandre', '222.222.222-22', 'alexandre@email.com', '(22) 22222-2222', NULL, 'Rua da Conquista', '2', NULL, '22222-222', 'Macedônia', 'Pella', 'MA', 'alexandrem', '$2y$10$p7j1zApCiRojybK4W6/C8OCCoETqOmROCYEfr/kznhZ6fPqzyvTjy', 'C', '2025-10-16 18:33:15', '2025-11-10 16:49:06'),
(7, 'Joana D Arc', '1412-01-06', 'F', 'Mae Joana', '444.444.444-44', 'joana@email.com', '(44) 44444-4444', '', 'Rua da Heroína', '4', '', '44444-444', 'Lorena', 'Domrémy', 'FR', 'joanadarc', '$2y$10$0oOjXgxGj42o6jm/.BGzUOrSnNQKXpfZLr.if6auNOTopd55Gdu7.', 'C', '2025-10-16 18:33:15', '2025-11-20 13:08:19'),
(8, 'Maria Antonieta', '1755-11-02', 'F', 'Mae Maria', '555.555.555-55', 'mariaa@email.com', '(55) 55555-5555', NULL, 'Rua da Rainha', '5', NULL, '55555-555', 'Palácio', 'Versalhes', 'FR', 'mariaant', '$2y$10$36pA8Ksc4gNN3ADDBM.h.Og2VRUHnr1HODzH12P4KKcIE5BRGhloy', 'C', '2025-10-16 18:33:15', '2025-11-10 16:49:06'),
(10, 'Cleópatra VII', '0069-01-01', 'F', 'Mae Cleópatra', '777.777.777-77', 'cleopatra@email.com', '(77) 77777-7777', NULL, 'Rua do Nilo', '7', NULL, '77777-777', 'Ptolomeu', 'Alexandria', 'EG', 'cleopatra', '$2y$10$KGInm.N4Jb6mniZVu8rQs.DCpgpm2mIWxmWEEPD./qANGPbypVoVu', 'C', '2025-10-16 18:33:15', '2025-11-10 16:49:06'),
(11, 'Administrador Master', '1980-01-01', 'M', 'Mae Administrador', '000.000.000-00', 'admin@email.com', '(00) 00000-0000', '(00) 0000-0000', 'Rua Principal', '1', 'Sala', '00000-000', 'Centro', 'Capital', 'CA', 'admin', '$2y$10$4xVeyxd7I.btqk8aKY8tdesF9GSdmHVLYR2IiQZJk5WqjvbjiKmXi', 'A', '2025-10-16 18:35:31', '2025-11-10 16:49:06'),
(12, 'Júlio César', '0100-07-13', 'M', 'Mae Júlio', '888.888.888-88', 'julio@email.com', '(88) 88888-8888', NULL, 'Rua de Roma', '8', NULL, '88888-888', 'Império', 'Roma', 'IT', 'julioc', '$2y$10$7JqO9VdK2FbiIkigmPhNxO/xzcglaOxLaAhlWVHrEFTydxMUsHWyO', 'C', '2025-10-16 18:36:39', '2025-11-10 16:49:06'),
(13, 'Elizabeth Tudor', '1533-09-07', 'F', 'Mae Elizabeth', '999.999.999-99', 'elizabeth@email.com', '(99) 99999-9999', NULL, 'Rua da Inglaterra', '9', NULL, '99999-999', 'Tudor', 'Greenwich', 'UK', 'elizabetht', '$2y$10$Ju7WtfRO5CLpVF0eytvlHeqnjSLtnvtZbPbN2GXS62lRzANWEdZz.', 'C', '2025-10-16 18:36:39', '2025-11-10 16:49:06'),
(15, 'Thiago Rocha', '1984-04-28', 'Masculino', 'Marilda', '33333333323', 'thiago.alves.rocha@souunisuam.com.br', '21999999999', '21333333333', 'Rua das flores', '123', '', '23013510', 'Maré', 'Rio de Janeiro', 'RJ', 'thiagoRocha', '$2y$10$0LddOUYfAC7j62waFS2TvOCiO4c8II4fu1qtseMv2V.wi4H6lwl8a', 'C', '2025-10-22 22:12:35', '2025-11-10 16:49:06'),
(23, 'Pafuncio', '1900-01-01', 'P', 'Pafuncia', '12345654902', 'pafuncio@email.com', '21985396305', '2134062140', 'Rua Odete Lara', '74', 'Bl12', '23036-156', 'Campo Grande', 'Angra dos Reis', 'RJ', 'Sr. P', '$2y$10$Rh93bX.aZ9mW6NNUklXJB.va35pveFpUiVRPgU0UWka7dnP6NgpO2', 'C', '2025-11-18 19:36:05', '2025-11-18 19:36:05'),
(27, 'SENHORA', '1987-10-10', 'F', 'Senhora', '12345678911', 'senhora@email.com', '2199999991', '2132518798', 'Rua do Rio', '13', 'praça 15', '23036-156', 'Campo Grande', 'Rio de Janeiro', 'RJ', 'Senhora', '$2y$10$PhCRz6VZ6WHlm87klwpYDu79X35cz6ZaIv8ZRG5/YJHIjUlQSEeJu', 'C', '2025-11-20 20:43:01', '2025-11-20 20:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `preco` decimal(6,2) NOT NULL,
  `plataforma` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `genero` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `estoque` int NOT NULL,
  `criado` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `img` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `nome`, `descricao`, `preco`, `plataforma`, `genero`, `estoque`, `criado`, `atualizado`, `img`) VALUES
(1, 'Bomberman', 'Bomberman é uma série de jogos de estratégia desenvolvida pela Hudson Soft, lançada pela primeira vez em 1983. O objetivo principal do jogo é plantar bombas estratégicamente para destruir obstáculos e inimigos em um labirinto labiríntico.', 300.00, 'Nintendo', 'Arcade', 100, '2025-11-17 21:34:00', '2025-11-20 21:03:35', 'https://i.pinimg.com/1200x/cb/02/52/cb0252075d75bb701a088c20560fa67d.jpg'),
(2, 'Earthworm', NULL, 449.99, 'nintendo', 'aventura', 100, '2025-11-20 21:10:08', '2025-11-20 21:10:08', 'https://i.pinimg.com/736x/c2/84/11/c28411baeaecceee52a63693f07f8830.jpg'),
(3, 'Castlevania Dawn of Sorrow', NULL, 349.99, 'nintendo', 'aventura', 100, '2025-11-20 21:34:09', '2025-11-20 21:34:09', 'https://i.pinimg.com/1200x/e5/4e/c4/e54ec4219e49039f20afcb67d8b5a99d.jpg'),
(4, 'The Legend of Zelda', NULL, 299.99, 'nintendo', 'aventura', 100, '2025-11-20 21:34:09', '2025-11-20 21:34:09', 'https://i.pinimg.com/736x/15/3f/06/153f0641d82636ae6ff1f0cdbe08f293.jpg'),
(5, 'Final Figth', NULL, 99.99, 'nintendo', 'arcade', 100, '2025-11-20 21:34:09', '2025-11-20 21:34:09', 'https://i.pinimg.com/736x/6f/1e/92/6f1e928bb413f45957b3c3540628cdb8.jpg'),
(6, 'Super Mario 64', NULL, 149.99, 'nintendo', 'aventura', 100, '2025-11-20 21:34:09', '2025-11-20 21:34:09', 'https://i.pinimg.com/1200x/77/d6/ed/77d6edd7b3092cbce1c1bf5678dba124.jpg'),
(7, 'Super Mario Allstar', NULL, 249.99, 'nintendo', 'aventura', 100, '2025-11-20 21:34:09', '2025-11-20 21:34:09', 'https://i.pinimg.com/736x/65/3f/20/653f20c8ec11a7ed6d5a6eaa880afc71.jpg'),
(8, 'Mario Party', NULL, 349.99, 'nintendo', 'aventura', 100, '2025-11-20 21:34:09', '2025-11-20 21:34:09', 'https://i.pinimg.com/736x/29/78/0e/29780eb736690455fb8419ee6b8a5c51.jpg'),
(9, 'Mario Kart 8 Deluxe', NULL, 199.99, 'nintendo', 'aventura', 100, '2025-11-20 21:34:09', '2025-11-20 21:34:09', 'https://i.pinimg.com/736x/27/87/78/278778d3778694a01d340de8746d6625.jpg'),
(10, 'The Legende of Zelda TK', NULL, 249.99, 'nintendo', 'aventura', 100, '2025-11-20 21:34:09', '2025-11-20 21:34:09', 'https://i.pinimg.com/736x/fc/29/86/fc2986995dabf4436c80cc67662dd5e8.jpg'),
(11, 'Senuas Sacrifice', NULL, 99.99, 'xbox', 'aventura', 100, '2025-11-20 21:41:50', '2025-11-20 21:41:50', 'https://i.pinimg.com/736x/a8/f6/61/a8f6611bb6520d0d5ad3e41960f18196.jpg'),
(12, 'Ghost of Yotei', NULL, 399.99, 'playstation', 'aventura', 100, '2025-11-20 21:41:50', '2025-11-20 21:41:50', 'https://i.pinimg.com/736x/3d/e1/4f/3de14f998b8a7fc943f780a57c3718e8.jpg'),
(13, 'Gears of War E-Day', NULL, 99.99, 'xbox', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/b0/ee/2b/b0ee2b57264aa656ed48e72a0b80ea99.jpg'),
(14, 'Sea of Thieves', NULL, 99.99, 'xbox', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/99/12/d6/9912d67dc38614f0e78c09e1144f07c1.jpg'),
(15, 'Forza 6', NULL, 99.99, 'xbox', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/d0/d4/fd/d0d4fda1bfb549bbc7afb07b93072a60.jpg'),
(16, 'Doom Eternal', NULL, 99.99, 'xbox', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/12/c5/21/12c521345b1ede517691583f1dac0d20.jpg'),
(17, 'Dishonored2', NULL, 99.99, 'xbox', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/06/f3/49/06f34977c3fa486ca956e673d226d5b2.jpg'),
(18, 'Halo Ininite', NULL, 99.99, 'xbox', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/46/25/46/4625466c0b85720b8fe1804630f3d362.jpg'),
(19, 'Dishonored', NULL, 99.99, 'xbox', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/5f/8f/7f/5f8f7ffcb100cddb4d9a04450bc03ec4.jpg'),
(20, 'Doom', NULL, 99.99, 'xbox', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/23/df/ae/23dfaea51d63ae91a9c3026ce192b29f.jpg'),
(21, 'Senuas Saga', NULL, 99.99, 'xbox', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/e0/37/69/e03769d041d6ff4526e4a767fd285d07.jpg'),
(22, 'Until Dawn', NULL, 99.99, 'playstation', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/e1/4b/62/e14b6210da2fdcb812caff6170644f8e.jpg'),
(23, 'God of War Ragnarok', NULL, 99.99, 'playstation', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/c7/53/e1/c753e123b7151a399e8245673ac707a4.jpg'),
(24, 'Star War Fallen order', NULL, 99.99, 'playstation', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/87/05/e8/8705e8a6685690f1a2b246432731f0bf.jpg'),
(25, 'Wild Arms', NULL, 99.99, 'playstation', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/67/d4/4e/67d44e6d7004da0965ad370ef7fc1778.jpg'),
(26, 'Dini Crisis', NULL, 99.99, 'playstation', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/f2/e7/dd/f2e7ddd71bcea2a409093bdf1c7a27a8.jpg'),
(27, 'Alters', NULL, 99.99, 'playstation', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/3f/13/d6/3f13d62d1c3b06f9888f821efed0293e.jpg'),
(28, 'Fallout', NULL, 99.99, 'playstation', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/6a/6a/7f/6a6a7fdbd30e42b85e1760651c6b353c.jpg'),
(29, 'Ghost of Tsushima', NULL, 99.99, 'playstation', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/c4/5b/70/c45b70ec90e99fc6833faf347466d099.jpg'),
(30, 'Lego Star Wars', NULL, 99.99, 'playstation', 'aventura', 100, '2025-11-20 22:15:54', '2025-11-20 22:15:54', 'https://i.pinimg.com/736x/42/6c/4c/426c4c70bfe823eed986389f1c6346b7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `data_pedido` date DEFAULT NULL,
  `status` enum('Pendente','Processando','Enviado','Entregue','Cancelado') NOT NULL,
  `valor_total` decimal(6,2) DEFAULT NULL,
  `criado` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `data_pedido`, `status`, `valor_total`, `criado`, `atualizado`) VALUES
(1, 3, '2025-11-13', 'Processando', 199.90, '2025-11-17 21:49:47', '2025-11-17 21:49:47');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `game_id` int NOT NULL,
  `quantidade` int NOT NULL,
  `preco_unitario` decimal(6,2) NOT NULL,
  `criado` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `game_id`, `quantidade`, `preco_unitario`, `criado`, `atualizado`) VALUES
(1, 1, 1, 1, 199.90, '2025-11-17 21:50:29', '2025-11-17 21:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `session_logs`
--

CREATE TABLE `session_logs` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `login` datetime DEFAULT NULL,
  `logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `session_logs`
--

INSERT INTO `session_logs` (`id`, `user_id`, `login`, `logout`) VALUES
(1, 5, '2025-11-13 17:39:36', '2025-11-13 18:39:36'),
(2, 5, '2025-11-13 17:39:36', '2025-11-13 18:39:36');

-- --------------------------------------------------------



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
-- Indexes for table `session_logs`
--
ALTER TABLE `session_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `session_logs`
--
ALTER TABLE `session_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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

--
-- Constraints for table `session_logs`
--
ALTER TABLE `session_logs`
  ADD CONSTRAINT `session_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
