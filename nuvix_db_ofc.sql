-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2025 at 08:06 PM
-- Server version: 11.7.2-MariaDB
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nuvix_db_ofc`
--

-- --------------------------------------------------------

--
-- Table structure for table `administradores`
--

CREATE TABLE `administradores` (
  `id_adm` int(11) NOT NULL,
  `nome` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `senha` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `administradores`
--

INSERT INTO `administradores` (`id_adm`, `nome`, `email`, `senha`) VALUES
(1, 'mike', 'mk@mk.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(2, 'Dylan', 'dy@dy.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(3, 'Guarana', 'guarana@Cha.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(4, 'Vicky', 'v@v.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

-- --------------------------------------------------------

--
-- Table structure for table `carrinho`
--

CREATE TABLE `carrinho` (
  `id_carrinho` int(11) NOT NULL,
  `id_game` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `quantidade` int(10) NOT NULL,
  `preco` decimal(8,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `carrinho`
--

INSERT INTO `carrinho` (`id_carrinho`, `id_game`, `id_usuario`, `quantidade`, `preco`) VALUES
(1, 7, 4, 1, 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `dev`
--

CREATE TABLE `dev` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dev`
--

INSERT INTO `dev` (`id`, `nome`, `email`, `senha`) VALUES
(4, 'eu', 'eu@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(6, 'Vitoria', 'admin@admin', 'f865b53623b121fd34ee5426c792e5c33af8c227'),
(8, 'Vitoria', 'eu1@eu', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(9, 'mike', 'mk@mk.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

-- --------------------------------------------------------

--
-- Table structure for table `expansao`
--

CREATE TABLE `expansao` (
  `id_expansao` int(11) NOT NULL,
  `id_jogo` int(11) NOT NULL,
  `nome_expansao` varchar(100) NOT NULL DEFAULT '',
  `empresa_expansao` varchar(50) DEFAULT '',
  `preco` decimal(8,2) DEFAULT NULL,
  `imagembanner` text DEFAULT NULL,
  `preco_expansao` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gamers`
--

CREATE TABLE `gamers` (
  `id_game` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `desenvolvedora` varchar(100) DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `data_lancamento` date DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `imagem` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gamers`
--

INSERT INTO `gamers` (`id_game`, `titulo`, `descricao`, `desenvolvedora`, `preco`, `data_lancamento`, `categoria`, `imagem`) VALUES
(3, 'PEAK', 'PEAK é um jogo cooperativo de escalada onde o menor erro pode custar a sua vida. Sozinho ou em grupo, sua única esperança de resgate em uma ilha misteriosa é escalar a montanha no seu centro. Você tem o que é preciso para chegar ao PICO?', ' Team PEAK', 23.99, '2025-12-05', 'Aventura', '8ad0788d793d3c346502c117b1ac6b45.jpg'),
(4, 'Lies of P', 'Lies of P é um soulslike emocionante que pega a história de Pinóquio, vira-a de ponta-cabeça e coloca-a num cenário sombrio e elegante da era belle époque.', 'NEOWIZ', 124.95, '2023-07-18', 'RPG', '5fcb54ae221281e46566e1bdcbb2ef5a.jpg'),
(5, 'Dead Cells', 'Dead Cells é um \"roguelite\" de ação em plataforma estilo Metroidvania. Você vai explorar um castelo extenso e em constante mutação... Sem checkpoints. Mate, morra, aprenda, repita.', 'Motion Twin', 18.99, '2018-08-06', 'Plataforma', 'f0f0914c254d38236d18e4f533f4f480.jpg'),
(7, 'Assassin’s Creed', 'The year is 1715. Pirates rule the Caribbean and have established their own lawless Republic where corruption, greediness and cruelty are commonplace.Among these outlaws is a brash young captain named Edward Kenway.', 'Ubisoft Montreal', 35.99, '2025-12-05', 'Aventura', '10a8e1f352db2e51c6b3d9d992f903ed.jpg'),
(9, 'Marvel Rivals', 'Marvel Rivals é um jogo de tiro JxJ em equipe com Super Heróis! Reúna um grupo de estrelas da Marvel, crie estratégias e combine seus poderes para executar poderosas habilidades de equipe. Lute em cenários destrutíveis e campos de batalha dinâmicos pelo universo Marvel em constante', ' NetEase Games', 200.00, '2025-07-02', 'Ação', '1ad38d01455870accae76c9a80d8bd06.jpg'),
(10, 'Broken Arrow', 'Broken Arrow é um jogo de táticas de guerra moderna de grande escala em tempo real que combina a complexidade de jogos de guerra com forças conjuntas com jogabilidade tática em tempo real envolvendo muita ação. ', 'Steel Balalaika', 200.00, '2025-07-05', 'Estratégia', 'fd63f86d3a628035c05efe13173dad7d.jpg'),
(11, 'The Wandering Village', 'The Wandering Village é um jogo de simulação de cidade nas costas de uma criatura gigante. Construa seu povoado e forme uma relação simbiótica com o colosso. Vocês conseguem sobreviver juntos nesse mundo pós-apocalíptico hostil, mas lindo, contaminado por plantas venenosas?', 'Stray Fawn Studio', 200.00, '2025-07-19', 'Simulação', '3fc247bc5cface87d102464d019bc801.jpg'),
(13, 'Cuphead', 'Cuphead é um jogo de ação e tiros clássico, com enorme ênfase nas batalhas de chefes. Inspirado nas animações infantis da década de 1930, os visuais e efeitos sonoros foram minuciosamente recriados com as mesmíssimas técnicas dessa era, com destaque para desenhos feitos à mão, fundos', 'desenvolvedora', 200.00, '2025-07-09', 'Aventura', '5ade46967add0d0457f2d37ac08ee065.jpg'),
(14, 'cyberpunk', 'Cyberpunk 2077 é um RPG de ação e aventura em mundo aberto que se passa em Night City, uma megalópole perigosa onde todos são obcecados por poder, glamour e alterações corporais.', 'Eu', 20.00, '2025-07-17', 'Ação', 'cb0a177b75c45761e1a16d9c3827a229.jpg'),
(15, 'it take two', 'Embarque na jornada mais maluca da sua vida em It Takes Two. Convide um amigo ou amiga para se juntar de graça com o Passe de Amigo* e trabalhem juntos em uma variedade de desafios deliciosamente perturbadores.', 'ea', 200.00, '2025-12-25', 'Aventura', '8f8339c5966c0a16cf027e38a29131da.png'),
(20, 'teste', 'teste', 'teste', 12.00, '2025-09-10', 'Ação', NULL),
(21, 'teste', 'teste', 'teste', 12.00, '2025-09-10', 'Ação', '52c1dd7a39bab51e3107dceeeb6ea8d9.png');

-- --------------------------------------------------------

--
-- Table structure for table `game_images`
--

CREATE TABLE `game_images` (
  `id_imademo` int(11) NOT NULL,
  `id_game` int(10) UNSIGNED NOT NULL,
  `demo_imagem` text NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `game_images`
--

INSERT INTO `game_images` (`id_imademo`, `id_game`, `demo_imagem`, `descricao`) VALUES
(7, 4, 'imagem.jpg', NULL),
(8, 4, 'cuphead3.jpg', 'imagem');

-- --------------------------------------------------------

--
-- Table structure for table `game_keys`
--

CREATE TABLE `game_keys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `chave` varchar(100) NOT NULL,
  `status` varchar(20) DEFAULT 'disponível',
  `data_geracao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itens_carrinho`
--

CREATE TABLE `itens_carrinho` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_carrinho` int(11) DEFAULT NULL,
  `id_game` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT 1,
  `preco` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jogos`
--

CREATE TABLE `jogos` (
  `id_jogo` int(11) NOT NULL COMMENT 'id do jogo',
  `nome` varchar(100) NOT NULL DEFAULT '0' COMMENT 'nome do jogo',
  `descricao` text DEFAULT NULL COMMENT 'descricao',
  `preco` decimal(8,2) DEFAULT NULL,
  `empresa_game` varchar(100) DEFAULT NULL,
  `codigo_game` varchar(100) DEFAULT NULL,
  `imagem` text DEFAULT NULL,
  `imagemcapa` text DEFAULT NULL,
  `imagembanner` text DEFAULT NULL,
  `imagemexemplo1` text DEFAULT NULL,
  `imagemexemplo2` text DEFAULT NULL,
  `imagemexemplo3` text DEFAULT NULL,
  `categorias` text DEFAULT NULL,
  `classificacao` varchar(50) NOT NULL,
  `avaliacao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `jogos`
--

INSERT INTO `jogos` (`id_jogo`, `nome`, `descricao`, `preco`, `empresa_game`, `codigo_game`, `imagem`, `imagemcapa`, `imagembanner`, `imagemexemplo1`, `imagemexemplo2`, `imagemexemplo3`, `categorias`, `classificacao`, `avaliacao`) VALUES
(1, 'Cult of the Lamb', 'Crie seu próprio culto em uma terra de falsos profetas, aventurando-se por regiões misteriosas e diversas para criar uma comunidade fiel de Seguidores da floresta e para propagar sua Palavra e se tornar o único culto verdadeiro.', 64.95, 'Devolver Digital', 'CULT12345', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTrsnUTD9XNANFMBbn3q4LXldQQ73D2RSc_06PTvjDp5mkgkpBX3VlE9SDM3ryJpuCoDw&usqp=CAU', 'https://cdn.ome.lt/9A67V-ziKTfCpQ_BCK4gY-s-h90=/200x0/smart/extras/capas/cult_of_the_lamb_box_art.jpg', 'https://i.ytimg.com/vi/tY1EYzn_5qY/maxresdefault.jpg', 'https://uploads.jovemnerd.com.br/wp-content/uploads/2022/08/cult_of_the_lamb_review_1__5vu672n.jpg', 'https://uploads.jovemnerd.com.br/wp-content/uploads/2022/08/cultofthelamb_review_3__54801fcw2.jpg', 'https://uploads.jovemnerd.com.br/wp-content/uploads/2022/08/cultofthelamb_review_6__xwc8gy.jpg', NULL, '12', '4.5'),
(3, 'Lies of P', 'Lies of P é um jogo de ação e RPG ambientado em uma versão sombria e distorcida do conto clássico de Pinóquio. Os jogadores assumem o papel de Pinóquio, um autômato que busca se tornar humano em uma cidade decadente cheia de perigos, monstros e segredos. Com um sistema de combate desafiador e uma narrativa envolvente, Lies of P oferece uma experiência única para os fãs de jogos de ação e aventura.', 249.90, 'NEOWIZ', 'LIES12345', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwGYeEJwD3FIwVxbOouIugjzLryJ4GPPxTQ2Juvii0kFI0BOHOYkRR60kntuVTFmrfE2w&usqp=CAU', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwGYeEJwD3FIwVxbOouIugjzLryJ4GPPxTQ2Juvii0kFI0BOHOYkRR60kntuVTFmrfE2w&usqp=CAU', 'https://www.adrenaline.com.br/wp-content/uploads/2024/03/lies-of-p-912x569.jpg', 'https://www.adrenaline.com.br/wp-content/uploads/2023/09/Lies-of-P-traz-bug-que-pode-quebrar-a-progressao-de-seu-Capitulo-2-912x569.jpg', 'https://cdn.ome.lt/Inl2v_YpNhKZWSCzOMFIZ5tYPcY=/770x0/smart/uploads/conteudo/fotos/lies-of-p-paisagem-sombria.jpg', 'https://i.ytimg.com/vi/jhQsYonkG8Q/maxresdefault.jpg', NULL, '14', '4.7');

-- --------------------------------------------------------

--
-- Table structure for table `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id_tabela_pago` int(10) UNSIGNED NOT NULL,
  `id_pagamento` varchar(100) NOT NULL DEFAULT '',
  `status` varchar(50) DEFAULT NULL,
  `valor` decimal(6,2) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `data_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `data_hora` datetime NOT NULL,
  `status` enum('Aguardando Pagamento','Em processamento','Enviado','Finalizado','Cancelado') DEFAULT 'Aguardando Pagamento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rl_pedido_game`
--

CREATE TABLE `rl_pedido_game` (
  `id_pedido` int(11) NOT NULL,
  `id_chave` bigint(20) UNSIGNED NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id_token` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `cliente` varchar(50) NOT NULL,
  `validade` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id_token`, `token`, `cliente`, `validade`, `status`) VALUES
(1, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Nuvix', '2026-01-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `tipo_usuario` varchar(20) DEFAULT 'cliente',
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `imagem` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`, `tipo_usuario`, `data_criacao`, `imagem`) VALUES
(4, 'eu', 'eu@gmail.com', '123456', NULL, '2025-07-23 19:25:55', NULL),
(5, 'Vitoria', 'vitoria@vitoria.gmail.com', '123456', 'user', '2025-07-24 20:25:08', NULL),
(6, 'Lucas', 'lucas@gmail.com', '123456', NULL, '2025-07-24 21:11:54', NULL),
(7, 'eu', 'Vic@gmail', '123456', NULL, '2025-09-04 22:48:02', NULL),
(8, 'vitoria', 'vitoria.eu@gmail.com', '123', 'user', '2025-10-16 23:01:45', NULL),
(9, 'teste', 'eu@eu', '123', 'user', '2025-10-16 23:03:46', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_adm`),
  ADD UNIQUE KEY `email_adm` (`email`) USING BTREE;

--
-- Indexes for table `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id_carrinho`),
  ADD KEY `id_game` (`id_game`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `dev`
--
ALTER TABLE `dev`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `expansao`
--
ALTER TABLE `expansao`
  ADD PRIMARY KEY (`id_expansao`),
  ADD KEY `id_jogo` (`id_jogo`);

--
-- Indexes for table `gamers`
--
ALTER TABLE `gamers`
  ADD PRIMARY KEY (`id_game`);

--
-- Indexes for table `game_images`
--
ALTER TABLE `game_images`
  ADD PRIMARY KEY (`id_imademo`),
  ADD KEY `FK_game_images_games` (`id_game`);

--
-- Indexes for table `game_keys`
--
ALTER TABLE `game_keys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chave` (`chave`);

--
-- Indexes for table `itens_carrinho`
--
ALTER TABLE `itens_carrinho`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jogos`
--
ALTER TABLE `jogos`
  ADD PRIMARY KEY (`id_jogo`) USING BTREE;

--
-- Indexes for table `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id_tabela_pago`) USING BTREE;

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `rl_pedido_game`
--
ALTER TABLE `rl_pedido_game`
  ADD KEY `id_chave` (`id_chave`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id_token`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id_carrinho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dev`
--
ALTER TABLE `dev`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `expansao`
--
ALTER TABLE `expansao`
  MODIFY `id_expansao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gamers`
--
ALTER TABLE `gamers`
  MODIFY `id_game` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `game_images`
--
ALTER TABLE `game_images`
  MODIFY `id_imademo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `game_keys`
--
ALTER TABLE `game_keys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itens_carrinho`
--
ALTER TABLE `itens_carrinho`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jogos`
--
ALTER TABLE `jogos`
  MODIFY `id_jogo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id do jogo', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id_tabela_pago` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `id_game` FOREIGN KEY (`id_game`) REFERENCES `gamers` (`id_game`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `expansao`
--
ALTER TABLE `expansao`
  ADD CONSTRAINT `id_jogo` FOREIGN KEY (`id_jogo`) REFERENCES `jogos` (`id_jogo`) ON DELETE NO ACTION;

--
-- Constraints for table `game_images`
--
ALTER TABLE `game_images`
  ADD CONSTRAINT `FK_game_images_games` FOREIGN KEY (`id_game`) REFERENCES `gamers` (`id_game`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Constraints for table `rl_pedido_game`
--
ALTER TABLE `rl_pedido_game`
  ADD CONSTRAINT `rl_pedido_game_ibfk_1` FOREIGN KEY (`id_chave`) REFERENCES `game_keys` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
