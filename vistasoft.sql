-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Fev-2021 às 03:28
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vistasoft`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `contracts`
--

CREATE TABLE `contracts` (
  `id` int(11) NOT NULL,
  `cod` binary(36) NOT NULL DEFAULT uuid(),
  `property` int(11) NOT NULL,
  `lessor` int(11) NOT NULL,
  `lessee` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `administration_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `rent` decimal(10,2) NOT NULL,
  `condominium` decimal(10,2) DEFAULT NULL,
  `iptu` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `contracts`
--

INSERT INTO `contracts` (`id`, `cod`, `property`, `lessor`, `lessee`, `start_date`, `end_date`, `administration_fee`, `rent`, `condominium`, `iptu`, `status`, `created_at`, `updated_at`) VALUES
(5, 0x39383534623765372d366230652d313165622d623638622d313464616539623837343434, 2, 2, 3, '2021-02-09', '2022-02-09', '9.00', '1500.00', '750.00', '100.00', 'active', '2021-02-09 17:40:01', '2021-02-09 23:46:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lessees`
--

CREATE TABLE `lessees` (
  `id` int(11) NOT NULL,
  `cod` binary(36) NOT NULL DEFAULT uuid(),
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `cel` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `lessees`
--

INSERT INTO `lessees` (`id`, `cod`, `name`, `email`, `cel`, `created_at`, `updated_at`) VALUES
(3, 0x33363137373038322d366163642d313165622d623638622d313464616539623837343434, 'Irandir Azevedo', 'irandir@gmail.com', '(22)99999-9999', '2021-02-09 09:51:58', '2021-02-09 09:51:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lessors`
--

CREATE TABLE `lessors` (
  `id` int(11) NOT NULL,
  `cod` binary(36) NOT NULL DEFAULT uuid(),
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `cel` varchar(20) NOT NULL,
  `transfer_day` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `lessors`
--

INSERT INTO `lessors` (`id`, `cod`, `name`, `email`, `cel`, `transfer_day`, `created_at`, `updated_at`) VALUES
(2, 0x34336266396134362d366135342d313165622d623638622d313464616539623837343434, 'Luiz Felipe', 'luizfelip31@gmail.com', '(21)97610-3214', 5, '2021-02-08 19:26:10', '2021-02-08 19:26:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `cod` binary(36) NOT NULL DEFAULT uuid(),
  `contract` int(11) NOT NULL,
  `lessee` int(11) NOT NULL,
  `rent` decimal(10,2) NOT NULL DEFAULT 0.00,
  `condominium` decimal(10,2) DEFAULT 0.00,
  `iptu` decimal(10,2) NOT NULL DEFAULT 0.00,
  `reference` char(7) NOT NULL,
  `due_date` date NOT NULL,
  `status` char(3) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `payments`
--

INSERT INTO `payments` (`id`, `cod`, `contract`, `lessee`, `rent`, `condominium`, `iptu`, `reference`, `due_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 0x39383561366536312d366230652d313165622d623638622d313464616539623837343434, 5, 3, '1017.86', '750.00', '100.00', '02/2021', '2021-03-01', '1', '2021-02-09 17:40:01', '2021-02-09 19:29:47'),
(2, 0x39383630343733612d366230652d313165622d623638622d313464616539623837343434, 5, 3, '1500.00', '750.00', '100.00', '03/2021', '2021-04-01', '1', '2021-02-09 17:40:01', '2021-02-09 22:41:06'),
(3, 0x39383661623635662d366230652d313165622d623638622d313464616539623837343434, 5, 3, '1500.00', '750.00', '100.00', '04/2021', '2021-05-01', '0', '2021-02-09 17:40:01', '2021-02-09 23:46:24'),
(4, 0x39383665353838662d366230652d313165622d623638622d313464616539623837343434, 5, 3, '1500.00', '750.00', '100.00', '05/2021', '2021-06-01', '0', '2021-02-09 17:40:01', '2021-02-09 23:46:24'),
(5, 0x39383730356664342d366230652d313165622d623638622d313464616539623837343434, 5, 3, '1500.00', '750.00', '100.00', '06/2021', '2021-07-01', '0', '2021-02-09 17:40:01', '2021-02-09 23:46:24'),
(6, 0x39383731663033382d366230652d313165622d623638622d313464616539623837343434, 5, 3, '1500.00', '750.00', '100.00', '07/2021', '2021-08-01', '0', '2021-02-09 17:40:01', '2021-02-09 23:46:24'),
(7, 0x39383737663763632d366230652d313165622d623638622d313464616539623837343434, 5, 3, '1500.00', '750.00', '100.00', '08/2021', '2021-09-01', '0', '2021-02-09 17:40:01', '2021-02-09 23:46:24'),
(8, 0x39383761643162662d366230652d313165622d623638622d313464616539623837343434, 5, 3, '1500.00', '750.00', '100.00', '09/2021', '2021-10-01', '0', '2021-02-09 17:40:01', '2021-02-09 23:46:24'),
(9, 0x39383763343731362d366230652d313165622d623638622d313464616539623837343434, 5, 3, '1500.00', '750.00', '100.00', '10/2021', '2021-11-01', '0', '2021-02-09 17:40:01', '2021-02-09 23:46:24'),
(10, 0x39383764353861332d366230652d313165622d623638622d313464616539623837343434, 5, 3, '1500.00', '750.00', '100.00', '11/2021', '2021-12-01', '0', '2021-02-09 17:40:01', '2021-02-09 23:46:24'),
(11, 0x39383831396133652d366230652d313165622d623638622d313464616539623837343434, 5, 3, '1500.00', '750.00', '100.00', '12/2021', '2022-01-01', '0', '2021-02-09 17:40:01', '2021-02-09 23:46:24'),
(12, 0x39383835633062612d366230652d313165622d623638622d313464616539623837343434, 5, 3, '1500.00', '750.00', '100.00', '01/2022', '2022-02-01', '0', '2021-02-09 17:40:01', '2021-02-09 23:46:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `cod` binary(36) NOT NULL DEFAULT uuid(),
  `zipcode` varchar(20) NOT NULL,
  `street` varchar(100) NOT NULL,
  `number` varchar(50) NOT NULL,
  `complement` varchar(50) DEFAULT NULL,
  `district` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `lessor` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `properties`
--

INSERT INTO `properties` (`id`, `cod`, `zipcode`, `street`, `number`, `complement`, `district`, `state`, `city`, `lessor`, `created_at`, `updated_at`) VALUES
(2, 0x32313336313761312d366163642d313165622d623638622d313464616539623837343434, '20730-400', 'Rua Dionísio Fernandes', '297', 'apto 406 bloco 1', 'Engenho de Dentro', 'RJ', 'Rio de Janeiro', 2, '2021-02-09 09:51:23', '2021-02-09 09:51:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transfers`
--

CREATE TABLE `transfers` (
  `id` int(11) NOT NULL,
  `cod` binary(36) NOT NULL DEFAULT uuid(),
  `contract` int(11) NOT NULL,
  `lessor` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `administration_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `value` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transfer_date` date NOT NULL,
  `status` char(3) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `transfers`
--

INSERT INTO `transfers` (`id`, `cod`, `contract`, `lessor`, `payment`, `administration_fee`, `value`, `transfer_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 0x39383566356664322d366230652d313165622d623638622d313464616539623837343434, 5, 2, 1, '10.00', '1006.07', '2021-03-05', '1', '2021-02-10 00:40:56', '2021-02-10 00:40:56'),
(2, 0x39383638636238392d366230652d313165622d623638622d313464616539623837343434, 5, 2, 2, '10.00', '1440.00', '2021-04-05', '0', '2021-02-10 00:51:27', '2021-02-10 00:51:27'),
(3, 0x39383664396665632d366230652d313165622d623638622d313464616539623837343434, 5, 2, 3, '9.00', '1456.00', '2021-05-05', '0', '2021-02-10 00:41:09', '2021-02-09 23:46:24'),
(4, 0x39383665653764322d366230652d313165622d623638622d313464616539623837343434, 5, 2, 4, '9.00', '1456.00', '2021-06-05', '0', '2021-02-10 00:41:13', '2021-02-09 23:46:24'),
(5, 0x39383731333632622d366230652d313165622d623638622d313464616539623837343434, 5, 2, 5, '9.00', '1456.00', '2021-07-05', '0', '2021-02-10 00:41:17', '2021-02-09 23:46:24'),
(6, 0x39383732376264322d366230652d313165622d623638622d313464616539623837343434, 5, 2, 6, '9.00', '1456.00', '2021-08-05', '0', '2021-02-10 00:41:20', '2021-02-09 23:46:24'),
(7, 0x39383738393233372d366230652d313165622d623638622d313464616539623837343434, 5, 2, 7, '9.00', '1456.00', '2021-09-05', '0', '2021-02-10 00:41:24', '2021-02-09 23:46:24'),
(8, 0x39383762383337632d366230652d313165622d623638622d313464616539623837343434, 5, 2, 8, '9.00', '1456.00', '2021-10-05', '0', '2021-02-10 00:41:27', '2021-02-09 23:46:24'),
(9, 0x39383763636436332d366230652d313165622d623638622d313464616539623837343434, 5, 2, 9, '9.00', '1456.00', '2021-11-05', '0', '2021-02-10 00:41:30', '2021-02-09 23:46:24'),
(10, 0x39383765313330352d366230652d313165622d623638622d313464616539623837343434, 5, 2, 10, '9.00', '1456.00', '2021-12-05', '0', '2021-02-10 00:41:33', '2021-02-09 23:46:24'),
(11, 0x39383832336134352d366230652d313165622d623638622d313464616539623837343434, 5, 2, 11, '9.00', '1456.00', '2022-01-05', '0', '2021-02-10 00:41:40', '2021-02-09 23:46:24'),
(12, 0x39383836363635392d366230652d313165622d623638622d313464616539623837343434, 5, 2, 12, '9.00', '1456.00', '2022-02-05', '0', '2021-02-10 00:41:37', '2021-02-09 23:46:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `cod` binary(36) NOT NULL DEFAULT uuid(),
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `cod`, `name`, `email`, `phone`, `password`, `photo`, `created_at`, `updated_at`) VALUES
(2, 0x34373338376562622d333462322d313165622d613061322d373466303664663066636462, 'Luiz Felipe', 'luizfelipe31@gmail.com', '(21)97610-3214', '$2y$10$/D0SF9Y/t33BNaeqptbdI.54CV5FKNukJ1hl1G3Wdm1yKUALS3Cti', NULL, '2021-02-05 21:00:00', '2021-02-05 21:10:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `lessees`
--
ALTER TABLE `lessees`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `lessors`
--
ALTER TABLE `lessors`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `lessees`
--
ALTER TABLE `lessees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `lessors`
--
ALTER TABLE `lessors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
