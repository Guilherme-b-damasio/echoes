-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Out-2024 às 00:03
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.0

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
  `playlist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `music`
--

INSERT INTO `music` (`ID`, `name`, `src`, `autor`, `image`, `created_at`, `updated_at`, `playlist_id`) VALUES
(1, 'Viva La Vida', '../src/songs/Coldplay - Viva La Vida (Official Video).mp3', 'ColdPlay', '../src/images/coldplay.jpg', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 5),
(2, 'A Real Hero', '../src/songs/College & Electric Youth - A Real Hero (Drive Original Movie Soundtrack).mp3', 'College & Electric Youth', '../src/images/arealhero.png', '2024-08-30 01:11:31', '2024-08-30 01:11:31', 8),
(3, 'Back In Black', '../src/songs/AC_DC - Back In Black (Official 4K Video).mp3', 'AC/DC', '../src/images/Back_in_Black.jpg', '2024-09-02 23:11:33', '2024-09-04 00:26:43', 2),
(4, 'Highway to Hell', '../src/songs/AC_DC - Back In Black (Official 4K Video).mp3', 'AC/DC', '../src/images/Acdc_Highway_to_Hell.jfif', '2024-09-02 23:12:51', '2024-09-04 00:26:43', 2),
(5, 'Numb', '../src/songs/Numb (Official Music Video) [4K UPGRADE] – Linkin Park.mp3', 'Linkin Park', '../src/images/lr60124_2017721_132122515753.jpg', '2024-09-02 23:14:13', '2024-09-02 23:14:13', 2),
(6, 'Sweet Child O Mine', '../src/songs/Sweet Child O Mine (Official Music Video).mp3', 'Guns N Roses', '../src/images/Guns-N-Roses-Appetite-For-Destruction.jpg', '2024-09-16 20:14:13', '2024-09-04 22:31:14', 2),
(7, 'Hypnotize', '../src/songs/Biggie Smalls - Hypnotize.mp3', 'The Notorious B.I.G.', '../src/images/lifeafterdeath.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 4),
(8, 'FE!N', '../src/songs/Travis Scott - FE!N (Official Audio) ft. Playboi Carti.mp3', 'Travis Scott', '../src/images/51nMgSxPQeL._UF1000,1000_QL80_.jpg', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 4),
(9, 'In Da Club', '../src/songs/50 Cent - In Da Club (Official Music Video).mp3', '50 Cent', '../src/images/81bpmchtQ6L._UF350,350_QL50_.jpg', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 4),
(10, 'Without Me', '../src/songs/Eminem - Without Me (Official Music Video).mp3', 'Eminem', '../src/images/Eminem_-_Without_Me_CD_cover.jpg', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 4),
(11, 'Lacrimosa', '../src/songs/Lacrimosa - Mozart - KV 626 - LEGENDADO PT_BR.mp3', 'Mozart', '../src/images/mozart.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 1),
(12, 'Moonlight Sonata', '../src/songs/Beethoven - Sonata ao Luar (Moonlight Sonata).mp3', 'Beethoven', '../src/images/beethoven.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 1),
(13, 'Valsa em Lá menor', '../src/songs/Chopin – Waltz in A minor, B. 150, Op. Posth..mp3', 'Frédéric Chopin', '../src/images/Chopin.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 1),
(14, 'Entry of the Gladiators', '../src/songs/Julius Fucik - Entry of the Gladiators.mp3', 'Julius Fucik', '../src/images/Fuciknew.jpg', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 1),
(15, 'Set Me Free', '../src/songs/House Boulevard feat. Samara - Set Me Free - Summer Eletrohits 5.mp3', 'House Boulevard feat. Samara', '../src/images/Summer5.png', '2024-08-30 01:11:31', '2024-08-30 01:11:31', 3),
(16, 'What a Feeling', '../src/songs/02 Global Deejays What a Feeling Summer Eletrohits 2 - 5082555 (youtube) (1).mp3', 'Global Deejays', '../src/images/Summer2.png', '2024-08-30 01:11:31', '2024-08-30 01:11:31', 3),
(17, 'Can You Feel It', '../src/songs/01 Jean Roch - Can You Feel It (Summer EletroHits 1).mp3', 'Jean Roch', '../src/images/Summer1.png', '2024-08-30 01:11:31', '2024-08-30 01:11:31', 3),
(18, 'Billie Jean', '../src/songs/ytmp3free.cc_michael-jackson-billie-jean-traduaolegendado-youtubemp3free.org.mp3', 'Michael Jackson', '../src/images/mjbj.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 5),
(19, 'Paradise', '../src/songs/Coldplay - Paradise (Official Video) - Coldplay (youtube).mp3', 'Coldplay', '../src/images/Coldplay_-_Paradise.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 5),
(20, 'Sugar', '../src/songs/Maroon 5 - Sugar (Official Music Video) - Maroon5VEVO (youtube).mp3', 'Maroon 5', '../src/images/Capa_de_V_(Maroon_5).png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 5),
(21, 'Desejo Imortal', '../src/songs/Gusttavo Lima - DESEJO IMORTAL (Ao vivo no Mineirão) - Gusttavo Lima Oficial (youtube).mp3', 'Gusttavo Lima', '../src/images/gusttavolima_1_.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 6),
(22, 'Saudade da Minha Vida (Ao Vivo no Buteco São Paulo)', '../src/songs/Gusttavo Lima - Saudade da Minha Vida (Ao Vivo no Buteco São Paulo) - Gusttavo Lima Oficial (youtube).mp3', 'Gusttavo Lima', '../src/images/GusttavoLimaSDMV.jpg', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 6),
(23, 'Rancorosa', '../src/songs/Henrique e Juliano -  RANCOROSA - DVD To Be Ao Vivo Em Brasília - Henrique e Juliano (youtube).mp3', 'Henrique e Juliano', '../src/images/henriqueJulianoToBe.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 6),
(24, 'Cronômetro (PRAIOU Ao Vivo em São Paulo)', '../src/songs/Matheus & Kauan - Cronômetro (PRAIOU Ao Vivo em São Paulo) - Matheus e Kauan (youtube).mp3', 'Matheus & Kauan', '../src/images/MKcronometro.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 6),
(25, 'Em Busca Da Minha Sorte', '../src/songs/Thiaguinho e Billy SP - Em Busca Da Minha Sorte (Clipe Oficial) - Thiaguinho (youtube).mp3', 'Thiaguinho e Billy SP', '../src/images/EPsorte01.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 7),
(26, 'Diferentão (Ao Vivo)', '../src/songs/Dilsinho - Diferentão (Ao Vivo) - DilsinhoVEVO (youtube).mp3', 'Dilsinho', '../src/images/DiferentaoDilsinho.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 7),
(27, 'Vida Cigana/ Maravilha/ Jeito Felino', '../src/songs/Grupo Menos é Mais e Raça Negra - Vida Cigana_ Maravilha_ Jeito Felino (Clipe Oficial) - Grupo Menos é Mais (youtube).mp3', 'Grupo Menos é Mais e Raça Negra', '../src/images/Confia.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 7),
(28, 'Abandonado (Ao Vivo)', '../src/songs/Abandonado (Ao Vivo) - Pagode do Adame (youtube).mp3', 'Pagode do Adame', '../src/images/AdameVol02.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 7),
(29, 'Stereo Love', '../src/songs/Summer Eletrohits 7 - Edward Maya & Vika Jigulina - Stereo Love (2010) - Portali3 (youtube).mp3', 'Edward Maya & Vika Jigulina', '../src/images/summer7new.png', '2024-08-30 01:11:31', '2024-08-30 01:11:31', 3),
(30, 'Techno Prank', '../src/songs/Dubdogz - Techno Prank (Official Video) - Dubdogz (youtube).mp3', 'Dubdogz', '../src/images/TechnoPrank.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 8),
(31, 'Piece Of Your Heart (Alok Remix)', '../src/songs/Meduza - Piece Of Your Heart (Alok Remix) - Proximity (youtube).mp3', 'Meduza', '../src/images/meduza.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 8),
(32, 'Céu Azul (Vintage Culture & Santti Remix)', '../src/songs/Céu Azul (Vintage Culture & Santti Remix) - Vintage Culture (youtube).mp3', 'Vintage Culture', '../src/images/vintage.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 8),
(33, 'I ve got you under my skin', '../src/songs/Frank Sinatra- I ve got you under my skin - lightningr0d (youtube).mp3', 'Frank Sinatra', '../src/images/FrankSinatra.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 9),
(34, 'Smile', '../src/songs/Nat King Cole - Smile - Legendas EN - PT-BR - Magyart HD Videos (youtube).mp3', 'Nat King Cole', '../src/images/natkingcole.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 9),
(35, 'Moonlight Serenade', '../src/songs/MOONLIGHT SERENADE BY GLENN MILLER - WorldWar2Music (youtube).mp3', 'Glenn Miller Orchestra', '../src/images/glennmiller.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 9),
(36, 'Moon River', '../src/songs/LOUIS ARMSTRONG  ~ Moon River ~ - Scout4Me1 (youtube).mp3.crdownload', 'Louis Armstrong', '../src/images/MoonRiver.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 9),
(37, 'Time', '../src/songs/Pink Floyd – Time (Official Audio) - Pink Floyd (youtube).mp3.crdownload', 'Pink Floyd', '../src/images/Dark_Side_of_the_Moon.png', '2024-09-02 23:11:33', '2024-09-04 00:26:43', 2),
(38, 'Valsa Danúbio Azul (The Blue Danube Valse) ', '../src/songs/Valsa Danúbio Azul (The Blue Danube Valse) - Johann Strauss Jr - DJ Pilo (youtube).mp3', 'Johann Strauss Jr', '../src/images/danubioazul.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 1),
(39, 'Can t Get Over You', '../src/songs/01 Kasino - Can t Get Over You (Summer Eletrohits 2) - SummerEletroBoy (youtube).mp3', 'Kasino', '../src/images/Summer2.png', '2024-08-30 01:11:31', '2024-08-30 01:11:31', 3),
(40, 'Beautiful ft. Pharrell Williams', '../src/songs/Snoop Dogg - Beautiful (Official Music Video) ft. Pharrell Williams - SnoopDoggVEVO (youtube).mp3', 'Snoop Dogg, Pharrell Williams, Charlie Wilson', '../src/images/Paid_tha_Cost_to_Be_da_Boss.jpg', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 4),
(41, '93 Million Miles', '../src/songs/Jason Mraz - 93 Million Miles (Official Video) - Jason Mraz (youtube).mp3', 'Jason Mraz', '../src/images/Loveisafourletterword-mraz.jpg', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 5),
(42, 'Liga Lá em Casa (Ao Vivo)', '../src/songs/Leonardo - Liga Lá em Casa (Ao Vivo) - LeonardoVEVO (youtube).mp3', 'Leonardo', '../src/images/Leonardo_-_30_Anos.jpg', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 6),
(43, 'Melhor eu ir (ACÚSTICO)', '../src/songs/PÉRICLES - MELHOR EU IR (ACÚSTICO) - VÍDEO OFICIAL - Canal do Pericão (youtube).mp3', 'Péricles', '../src/images/Capa_de_Feito_Pra_Durar.jpg', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 7),
(44, 'Animals', '../src/songs/Martin Garrix - Animals (Official Video) - STMPD RCRDS (youtube).mp3', 'Martin Garrix', '../src/images/MNMParty2013.2.png', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 8),
(45, 'that s life', '../src/songs/That s Life - Frank Sinatra (youtube).mp3', 'Frank Sinatra', '../src/images/ThatsLife.jpg', '2024-08-30 00:23:31', '2024-08-30 00:23:31', 9);

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
(1, 'Clássicos', '2024-08-29 23:40:40', '2024-08-29 23:40:40'),
(2, 'Rock', '2024-08-29 23:40:40', '2024-08-29 23:40:40'),
(3, 'SummerEletroHits', '2024-08-29 23:40:40', '2024-08-29 23:40:40'),
(4, 'Hip Hop', '2024-08-29 23:40:40', '2024-08-29 23:40:40'),
(5, 'Pop', '2024-08-29 23:40:40', '2024-08-29 23:40:40'),
(6, 'Sertanejo', '2024-08-29 23:40:40', '2024-08-29 23:40:40'),
(7, 'Pagode', '2024-08-29 23:40:40', '2024-08-29 23:40:40'),
(8, 'Eletrônica', '2024-08-29 23:40:40', '2024-08-29 23:40:40'),
(9, 'Jazz', '2024-08-29 23:40:40', '2024-08-29 23:40:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`ID`, `name`, `login`, `password`, `email`, `phone`) VALUES
(1, 'admin', 'admin', '$2y$10$6ynbhJ6lrMjzWbkzomhwSOLeTwr2HYikFmRZEfMWH4fdDk9q38rEy', 'a@a.com', '4799173334'),
(2, '', 'teste', '123', 'guilherme_b_damasio@estudante.sesissenai.org.br', ''),
(3, '', 'Gui', '$2y$10$ZS0o/ruLIe6MRsagvflQp.t9zbl/0tAnh71DOxJgrtkAeefsViHLW', 'guilherme_b_damasio@estudante.sesissenai.org.br', ''),
(4, '', 'Renê', '$2y$10$1ngAYULi77AGEk2lXElpdup8vi69ewaIrMyobr.vk/zWNSVQavbae', 'guilherme_b_damasio@estudante.sesissenai.org.br', ''),
(5, '', 'gabriel', '$2y$10$eFv9bGtTlSCL5qal/gawfuImDkyEiTMT85DGui3kyLVZQG4VuIbz2', 'macify@mailinator.com', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idx_name` (`name`),
  ADD KEY `idx_autor` (`autor`),
  ADD KEY `playlist_id` (`playlist_id`);

--
-- Índices para tabela `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_name` (`name`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `music`
--
ALTER TABLE `music`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `music_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
