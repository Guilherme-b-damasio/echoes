-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Nov-2024 às 00:41
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.12

drop database db_echoes;
create database db_echoes;
use db_echoes;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_echoes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `likedplaylist`
--

CREATE TABLE `likedplaylist` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_music` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `likedplaylist`
--

INSERT INTO `likedplaylist` (`ID`, `user_id`, `id_music`) VALUES
(89, 1, 6),
(90, 1, 17),
(91, 1, 9),
(92, 1, 8),
(97, 1, 29);

-- --------------------------------------------------------

--
-- Estrutura da tabela `music`
--

CREATE TABLE `music` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `playlist_id` int(11) NOT NULL,
  `liked_id` int(11) DEFAULT NULL,
  `perso_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `music`
--

INSERT INTO `music` (`ID`, `name`, `src`, `autor`, `image`, `created_at`, `updated_at`, `playlist_id`, `liked_id`, `perso_id`) VALUES
(1, 'Viva La Vida', '../src/songs/Coldplay - Viva La Vida (Official Video).mp3', 'ColdPlay', '../src/images/coldplay.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 5, NULL, NULL),
(2, 'A Real Hero', '../src/songs/College & Electric Youth - A Real Hero (Drive Original Movie Soundtrack).mp3', 'College & Electric Youth', '../src/images/arealhero.png', '2024-08-30 04:11:31', '2024-08-30 04:11:31', 8, NULL, NULL),
(3, 'Back In Black', '../src/songs/AC_DC - Back In Black (Official 4K Video).mp3', 'AC/DC', '../src/images/Back_in_Black.jpg', '2024-09-03 02:11:33', '2024-09-04 03:26:43', 2, NULL, NULL),
(4, 'Highway to Hell', '../src/songs/AC_DC - Back In Black (Official 4K Video).mp3', 'AC/DC', '../src/images/Acdc_Highway_to_Hell.jfif', '2024-09-03 02:12:51', '2024-10-30 00:14:46', 2, NULL, 2),
(5, 'Numb', '../src/songs/Numb (Official Music Video) [4K UPGRADE] – Linkin Park.mp3', 'Linkin Park', '../src/images/lr60124_2017721_132122515753.jpg', '2024-09-03 02:14:13', '2024-10-30 00:27:48', 2, NULL, 2),
(6, 'Sweet Child O Mine', '../src/songs/Sweet Child O Mine (Official Music Video).mp3', 'Guns N Roses', '../src/images/Guns-N-Roses-Appetite-For-Destruction.jpg', '2024-09-16 23:14:13', '2024-09-05 01:31:14', 2, NULL, NULL),
(7, 'Hypnotize', '../src/songs/Biggie Smalls - Hypnotize.mp3', 'The Notorious B.I.G.', '../src/images/hqdefault.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 4, NULL, NULL),
(8, 'FE!N', '../src/songs/Travis Scott - FE!N (Official Audio) ft. Playboi Carti.mp3', 'Travis Scott', '../src/images/51nMgSxPQeL._UF1000,1000_QL80_.jpg', '2024-08-30 03:23:31', '2024-10-30 00:28:26', 4, NULL, 3),
(9, 'In Da Club', '../src/songs/50 Cent - In Da Club (Official Music Video).mp3', '50 Cent', '../src/images/81bpmchtQ6L._UF350,350_QL50_.jpg', '2024-08-30 03:23:31', '2024-10-30 00:14:03', 4, NULL, 1),
(10, 'Without Me', '../src/songs/Eminem - Without Me (Official Music Video).mp3', 'Eminem', '../src/images/Eminem_-_Without_Me_CD_cover.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 4, NULL, NULL),
(11, 'Lacrimosa', '../src/songs/Lacrimosa - Mozart - KV 626 - LEGENDADO PT_BR.mp3', 'Mozart', '../src/images/mozart.png', '2024-08-30 03:23:31', '2024-10-30 00:27:00', 1, NULL, 2),
(12, 'Moonlight Sonata', '../src/songs/Beethoven - Sonata ao Luar (Moonlight Sonata).mp3', 'Beethoven', '../src/images/beethoven.png', '2024-08-30 03:23:31', '2024-10-30 00:13:48', 1, NULL, 1),
(13, 'Valsa em Lá menor', '../src/songs/Chopin – Waltz in A minor, B. 150, Op. Posth..mp3', 'Frédéric Chopin', '../src/images/Chopin.png', '2024-08-30 03:23:31', '2024-10-31 22:20:13', 1, NULL, 4),
(14, 'Entry of the Gladiators', '../src/songs/Julius Fucik - Entry of the Gladiators.mp3', 'Julius Fucik', '../src/images/Fuciknew.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 1, NULL, NULL),
(15, 'Set Me Free', '../src/songs/House Boulevard feat. Samara - Set Me Free - Summer Eletrohits 5.mp3', 'House Boulevard feat. Samara', '../src/images/Summer5.png', '2024-08-30 04:11:31', '2024-08-30 04:11:31', 3, NULL, NULL),
(16, 'What a Feeling', '../src/songs/02 Global Deejays What a Feeling Summer Eletrohits 2 - 5082555 (youtube) (1).mp3', 'Global Deejays', '../src/images/Summer2.png', '2024-08-30 04:11:31', '2024-10-30 00:14:19', 3, NULL, 2),
(17, 'Can You Feel It', '../src/songs/01 Jean Roch - Can You Feel It (Summer EletroHits 1).mp3', 'Jean Roch', '../src/images/Summer1.png', '2024-08-30 04:11:31', '2024-08-30 04:11:31', 3, NULL, NULL),
(18, 'Billie Jean', '../src/songs/ytmp3free.cc_michael-jackson-billie-jean-traduaolegendado-youtubemp3free.org.mp3', 'Michael Jackson', '../src/images/mjbj.png', '2024-08-30 03:23:31', '2024-10-30 00:27:30', 5, NULL, 1),
(19, 'Paradise', '../src/songs/Coldplay - Paradise (Official Video) - Coldplay (youtube).mp3', 'Coldplay', '../src/images/Coldplay_-_Paradise.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 5, NULL, NULL),
(20, 'Sugar', '../src/songs/Maroon 5 - Sugar (Official Music Video) - Maroon5VEVO (youtube).mp3', 'Maroon 5', '../src/images/Capa_de_V_(Maroon_5).png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 5, NULL, NULL),
(21, 'Desejo Imortal', '../src/songs/Gusttavo Lima - DESEJO IMORTAL (Ao vivo no Mineirão) - Gusttavo Lima Oficial (youtube).mp3', 'Gusttavo Lima', '../src/images/gusttavolima_1_.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 6, NULL, NULL),
(22, 'Saudade da Minha Vida (Ao Vivo no Buteco São Paulo)', '../src/songs/Gusttavo Lima - Saudade da Minha Vida (Ao Vivo no Buteco São Paulo) - Gusttavo Lima Oficial (youtube).mp3', 'Gusttavo Lima', '../src/images/GusttavoLimaSDMV.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 6, NULL, NULL),
(23, 'Rancorosa', '../src/songs/Henrique e Juliano -  RANCOROSA - DVD To Be Ao Vivo Em Brasília - Henrique e Juliano (youtube).mp3', 'Henrique e Juliano', '../src/images/henriqueJulianoToBe.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 6, NULL, NULL),
(24, 'Cronômetro (PRAIOU Ao Vivo em São Paulo)', '../src/songs/Matheus & Kauan - Cronômetro (PRAIOU Ao Vivo em São Paulo) - Matheus e Kauan (youtube).mp3', 'Matheus & Kauan', '../src/images/MKcronometro.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 6, NULL, NULL),
(25, 'Em Busca Da Minha Sorte', '../src/songs/Thiaguinho e Billy SP - Em Busca Da Minha Sorte (Clipe Oficial) - Thiaguinho (youtube).mp3', 'Thiaguinho e Billy SP', '../src/images/EPsorte01.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 7, NULL, NULL),
(26, 'Diferentão (Ao Vivo)', '../src/songs/Dilsinho - Diferentão (Ao Vivo) - DilsinhoVEVO (youtube).mp3', 'Dilsinho', '../src/images/DiferentaoDilsinho.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 7, NULL, NULL),
(27, 'Vida Cigana/ Maravilha/ Jeito Felino', '../src/songs/Grupo Menos é Mais e Raça Negra - Vida Cigana_ Maravilha_ Jeito Felino (Clipe Oficial) - Grupo Menos é Mais (youtube).mp3', 'Grupo Menos é Mais e Raça Negra', '../src/images/Confia.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 7, NULL, NULL),
(28, 'Abandonado (Ao Vivo)', '../src/songs/Abandonado (Ao Vivo) - Pagode do Adame (youtube).mp3', 'Pagode do Adame', '../src/images/AdameVol02.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 7, NULL, NULL),
(29, 'Stereo Love', '../src/songs/Summer Eletrohits 7 - Edward Maya & Vika Jigulina - Stereo Love (2010) - Portali3 (youtube).mp3', 'Edward Maya & Vika Jigulina', '../src/images/summereletrohits7.jpg', '2024-08-30 04:11:31', '2024-11-04 22:14:42', 3, NULL, 1),
(30, 'Techno Prank', '../src/songs/Dubdogz - Techno Prank (Official Video) - Dubdogz (youtube).mp3', 'Dubdogz', '../src/images/TechnoPrank.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 8, NULL, NULL),
(31, 'Piece Of Your Heart (Alok Remix)', '../src/songs/Meduza - Piece Of Your Heart (Alok Remix) - Proximity (youtube).mp3', 'Meduza', '../src/images/meduza.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 8, NULL, NULL),
(32, 'Céu Azul (Vintage Culture & Santti Remix)', '../src/songs/Céu Azul (Vintage Culture & Santti Remix) - Vintage Culture (youtube).mp3', 'Vintage Culture', '../src/images/vintage.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 8, NULL, NULL),
(50, 'Viva La Vida', '../src/songs/Coldplay - Viva La Vida (Official Video).mp3', 'ColdPlay', '../src/images/coldplay.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 5, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expire_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `token`, `expire_at`) VALUES
(1, 1, '0f450bbc68ae09d29754a3a371d2d2b8c67f0036d38e48b21eb39db5361262243dfd1b284f99bc19d261e585a7dc6678665d', 1728348035),
(2, 1, 'a6ff905427272aabffc7b3a0f9a25cb76bafa1ab9e6c006631f250ad0c6f559319ad6732938064fca6e84dd02eb2178704a0', 1728348039),
(3, 1, '122adcf71d9974a4a835e346887a7db91902363a3082429e439620aba2c3fcb76756ebf3799ac94326bdb65835777baed991', 1728348044),
(4, 1, '76328e02ded325207ec90820b2d0212bd471f8e90ae9bcc9edb663825045470ed53aa614014ca1bbe9bea0b4946d8ffebe3a', 1728348048),
(5, 1, '9fba61cf3920eb9798a27f95910013c171ccface2a83efdd9db3801eb23567a00c3872277ddc75fdfa917546d98573e2d8f2', 1728348053),
(6, 1, '0939541234a3a6cc8c3c5aad2c7b763d72e53a50ba278d66472734d9f852336564df8482f59e9711c82c65cdad4f57f25480', 1728348189),
(7, 1, '8001c2b6284b7a24390fc55289c73bf52cfcf99a3c442be376a997aa2ee7ab559943f56820c461f5b4815c1b2dacf5e95003', 1728348193),
(8, 1, '4fe50c91d1d18333aae5b95031a8d4f226543a3780730752af29b03662e082356b11802b8555c695b8fc31450a17ac92d9aa', 1728348198),
(9, 1, '11549289cbbcf9592277e88c36b78be1896dd43fc4544d25999e75c0818eb4b212a670d375fc7bdcd581cd90b24ecc7e1658', 1728348202),
(10, 1, '0774a068eab1d52715f1610818321a6a6e0083af247fca8d5b7ec4c8a0420fbb67562ade0e8a37fa5b5e464c7aeb453c6cfe', 1728348206),
(11, 1, '4fedc417fb7ec5226f4cffd271bbe9d0e826130cddf4b50f510a9626392ebe89c5ae6cee5fe6438bfb680c8eab266d91a3ff', 1728348210);

-- --------------------------------------------------------

--
-- Estrutura da tabela `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `playlist`
--

INSERT INTO `playlist` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Melhores Clássicos', '2024-08-29 23:40:40', '2024-08-29 23:40:40'),
(2, 'Melhores do Rock', '2024-08-29 23:40:40', '2024-08-29 23:40:40'),
(3, 'SummerEletroHits', '2024-08-29 23:40:40', '2024-08-29 23:40:40'),
(4, 'Melhores do Rock', '2024-09-18 00:16:59', '2024-09-18 00:16:59'),
(5, 'Pop', '2024-08-30 02:40:40', '2024-08-30 02:40:40'),
(6, 'Sertanejo', '2024-08-30 02:40:40', '2024-08-30 02:40:40'),
(7, 'Pagode', '2024-08-30 02:40:40', '2024-08-30 02:40:40'),
(8, 'Eletrônica', '2024-08-30 02:40:40', '2024-08-30 02:40:40'),
(10, 'Hip Hop', '2024-08-30 02:40:40', '2024-08-30 02:40:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `playlist_perso`
--

CREATE TABLE `playlist_perso` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `playlist_perso`
--

INSERT INTO `playlist_perso` (`ID`, `user_id`, `name`) VALUES
(1, 1, 'rteste'),
(2, 1, 'teste2'),
(3, 1, 'musicas que gosto'),
(4, 1, 'musicas que gosto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `liked_songs` int(11) DEFAULT NULL,
  `creat_playlist` int(11) DEFAULT NULL,
  `playlist_id` int(11) DEFAULT NULL,
  `likedPlaylist` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`ID`, `name`, `login`, `email`, `password`, `phone`, `image`, `liked_songs`, `creat_playlist`, `playlist_id`, `likedPlaylist`) VALUES
(1, 'gui', 'gui', 'guilherme_b_damasio@estudante.sesissenai.org.br', '$2y$10$INfXNdjeZqIB2jgaau8O/OQ7nFcev89cF94ZA9ufwZ1RJeDQrO.U6', '', NULL, NULL, NULL, NULL, NULL),
(2, 'Rene', 'rebite', 'rene_nunes@estudante.sesisenai.org.br', '$2y$10$u.fCfSaBGmgSfCsF0AmoWuNnt2BEaybHjIQP/vf.EkXYt4zfJTWom', '4354645746', NULL, NULL, NULL, NULL, NULL),
(3, 'admin', 'admin', 'tabletgbd@gmail.com', '$2y$10$cPXrzn0tg7HzVNeduXxpQOL8caYu9ldRUZejdWhJMq4loNtfE2C6y', '(47) 99173-7334', NULL, NULL, NULL, NULL, NULL),
(4, 'g', 'g', 'guilherme_b_damasio@estudante.sesissenai.org.br', '$2y$10$NpOTy69Km.5R14aBW1J2Yemssf4vOS8WJ2FlvsxffzfCZhNqvPff2', '(35) 454-5545', NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `likedplaylist`
--
ALTER TABLE `likedplaylist`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idx_name` (`name`),
  ADD KEY `idx_autor` (`autor`),
  ADD KEY `playlist_id` (`playlist_id`),
  ADD KEY `liked_id` (`liked_id`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_name` (`name`);

--
-- Índices para tabela `playlist_perso`
--
ALTER TABLE `playlist_perso`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `playlist_id` (`playlist_id`),
  ADD KEY `likedPlaylist` (`likedPlaylist`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `likedplaylist`
--
ALTER TABLE `likedplaylist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de tabela `playlist_perso`
--
ALTER TABLE `playlist_perso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
