-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Out-2024 às 01:38
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4


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

DROP DATABASE IF EXISTS db_echoes;
CREATE DATABASE db_echoes;
use db_echoes;

CREATE TABLE `category` (
  `id` int(11)  NOT NULL auto_increment primary key,
  `name` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `likedplaylist`
--

CREATE TABLE `likedplaylist` (
  `ID` int(11)  NOT NULL auto_increment primary key,
  `user_id` int(11) NOT NULL,
  `id_music` int(11) NOT NULL
) ;

CREATE TABLE `playlist_perso` (
  `ID` int(11) NOT NULL AUTO_INCREMENT primary key,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
);


--
-- Extraindo dados da tabela `likedplaylist`
--

INSERT INTO `likedplaylist` (`ID`, `user_id`, `id_music`) VALUES
(87, 1, 13),
(89, 1, 6),
(90, 1, 17),
(91, 1, 9),
(92, 1, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `music`
--

CREATE TABLE `music` (
  `ID` int(11)  NOT NULL auto_increment primary key,
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
(2, 'A Real Hero', '../src/songs/College  Electric Youth - A Real Hero (Drive Original Movie Soundtrack).mp3', 'College & Electric Youth', '../src/images/arealhero.png', '2024-08-30 04:11:31', '2024-08-30 04:11:31', 3, NULL, NULL),
(3, 'Echoes', '../src/songs/Echoes.mp3', 'Pink Floyd', '../src/images/MeddleCover.jpeg', '2024-09-03 02:11:33', '2024-09-04 03:26:43', 1, NULL, NULL),
(4, 'Stairway To Heaven', '../src/songs/Led Zeppelin - Stairway To Heaven (Official Audio).mp3', 'Led Zeppelin', '../src/images/LedZeppelin.jpg', '2024-09-03 02:11:33', '2024-09-04 03:26:43', 1, NULL, NULL),
(5, 'Something In The Way', '../src/songs/Nirvana - Something In The Way (Audio).mp3', 'Nirvana', '../src/images/nevermind.jpg', '2024-09-03 02:11:33', '2024-09-04 03:26:43', 1, NULL, NULL),
(6, 'Highway to Hell', '../src/songs/AC_DC - Highway to Hell (Official Video).mp3', 'AC/DC', '../src/images/Acdc_Highway_to_Hell.jfif', '2024-09-03 02:12:51', '2024-10-30 00:14:46', 1, NULL, 2),
(7, 'Hypnotize', '../src/songs/Biggie Smalls - Hypnotize.mp3', 'The Notorious B.I.G.', '../src/images/BiggieHypnotize.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 4, NULL, NULL),
(8, 'FE!N', '../src/songs/Travis Scott - FE!N (Official Audio) ft. Playboi Carti.mp3', 'Travis Scott', '../src/images/51nMgSxPQeL._UF1000,1000_QL80_.jpg', '2024-08-30 03:23:31', '2024-10-30 00:28:26', 4, NULL, 3),
(9, 'In Da Club', '../src/songs/50 Cent - In Da Club (Official Music Video).mp3', '50 Cent', '../src/images/81bpmchtQ6L._UF350,350_QL50_.jpg', '2024-08-30 03:23:31', '2024-10-30 00:14:03', 4, NULL, 1),
(10, 'Without Me', '../src/songs/Eminem - Without Me (Official Music Video).mp3', 'Eminem', '../src/images/Eminem_-_Without_Me_CD_cover.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 4, NULL, NULL),
(11, 'Lacrimosa', '../src/songs/Lacrimosa - Mozart - KV 626 - LEGENDADO PT_BR.mp3', 'Mozart', '../src/images/mozart.png', '2024-08-30 03:23:31', '2024-10-30 00:27:00', 9, NULL, 2),
(12, 'Moonlight Sonata', '../src/songs/Beethoven - Sonata ao Luar (Moonlight Sonata).mp3', 'Beethoven', '../src/images/beethoven.png', '2024-08-30 03:23:31', '2024-10-30 00:13:48', 9, NULL, 1),
(13, 'Valsa em Lá menor', '../src/songs/Chopin – Waltz in A minor, B. 150, Op. Posth..mp3', 'Frédéric Chopin', '../src/images/Chopin.png', '2024-08-30 03:23:31', '2024-10-31 22:20:13', 9, NULL, 4),
(14, 'Entry of the Gladiators', '../src/songs/Julius Fucik - Entry of the Gladiators.mp3', 'Julius Fucik', '../src/images/Fuciknew.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 9, NULL, NULL),
(15, 'Set Me Free', '../src/songs/House Boulevard feat. Samara - Set Me Free - Summer Eletrohits 5.mp3', 'House Boulevard feat. Samara', '../src/images/Summer5.png', '2024-08-30 04:11:31', '2024-08-30 04:11:31', 8, NULL, NULL),
(16, 'What a Feeling', '../src/songs/02 Global Deejays What a Feeling Summer Eletrohits 2 - 5082555 (youtube) (1).mp3', 'Global Deejays', '../src/images/Summer2.png', '2024-08-30 04:11:31', '2024-10-30 00:14:19', 8, NULL, 2),
(17, 'Can You Feel It', '../src/songs/01 Jean Roch - Can You Feel It (Summer EletroHits 1).mp3', 'Jean Roch', '../src/images/Summer1.png', '2024-08-30 04:11:31', '2024-08-30 04:11:31', 8, NULL, NULL),
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
(29, 'Stereo Love', '../src/songs/Summer Eletrohits 7 - Edward Maya & Vika Jigulina - Stereo Love (2010) - Portali3 (youtube).mp3', 'Edward Maya & Vika Jigulina', '../src/images/summereletrohits7.jpg', '2024-08-30 04:11:31', '2024-11-04 22:14:42', 8, NULL, 1),
(30, 'Techno Prank', '../src/songs/Dubdogz - Techno Prank (Official Video) - Dubdogz (youtube).mp3', 'Dubdogz', '../src/images/TechnoPrank.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 3, NULL, NULL),
(31, 'Piece Of Your Heart (Alok Remix)', '../src/songs/Meduza - Piece Of Your Heart (Alok Remix) - Proximity (youtube).mp3', 'Meduza', '../src/images/meduza.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 3, NULL, NULL),
(32, 'Céu Azul (Vintage Culture & Santti Remix)', '../src/songs/Céu Azul (Vintage Culture & Santti Remix) - Vintage Culture (youtube).mp3', 'Vintage Culture', '../src/images/vintage.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 3, NULL, NULL),
(33, 'Nocturne op.9 No.2', '../src/songs/Chopin - Nocturne op.9 No.2.mp3', 'Chopin', '../src/images/Chopin - Nocturne op.9 No.2.jpg', '2024-08-30 03:23:31', '2024-10-30 00:13:48', 9, NULL, 1),
(34, 'Bachianas Brasileiras Nº 2 - IV. Tocata (O trenzinho do caipira)', '../src/songs/Villa-Lobos - Bachianas Brasileiras Nº 2 - IV. Tocata (O trenzinho do caipira) . Minczuk.mp3', 'Villa-Lobos', '../src/images/Trenzinho-caipira-—-Villa-Lobos.jpg', '2024-08-30 03:23:31', '2024-10-30 00:13:48', 9, NULL, 1),
(35, 'Prokofiev "Troika" (Lieutenant Kije) - Fistoulari conducts', '../src/songs/Prokofiev _Troika_ (Lieutenant Kije) - Fistoulari conducts.mp3', 'Sergei-Prokofiev', '../src/images/Troika-from-Lieutenant-Kijé-suite-1934-Sergei-Prokofiev.png', '2024-08-30 03:23:31', '2024-10-30 00:13:48', 9, NULL, 1),
(37, 'Time', '../src/songs/Pink Floyd – Time (Official Audio).mp3', 'Pink Floyd', '../src/images/Dark_Side_of_the_Moon.png', '2024-08-30 03:23:31', '2024-10-30 00:13:48', 1, NULL, 1),
(38, 'Master of Puppets', '../src/songs/Metallica_ Master of Puppets (Official Lyric Video).mp3', 'Metallica', '../src/images/Master_of_Puppets.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 1, NULL, 1),
(39, 'Rotten Apple', '../src/songs/Alice In Chains - Rotten Apple (Official Audio).mp3', 'Alice In Chains', '../src/images/Alice_in_Chains_Jar_of_Flies.jpg', '2024-09-03 02:11:33', '2024-09-04 03:26:43', 1, NULL, NULL),
(40, 'Can t Get Over You', '../src/songs/01 Kasino - Can t Get Over You (Summer Eletrohits 2) - SummerEletroBoy (youtube).mp3', 'Global Deejays', '../src/images/Summer2.png', '2024-08-30 04:11:31', '2024-10-30 00:14:19', 8, NULL, 2),
(41, 'Love Is Gone', '../src/songs/David Guetta & Chris Willis - Love Is Gone (Official Video).mp3', 'David Guetta & Chris Willis', '../src/images/Summer_Eletrohits_4.jpg', '2024-08-30 04:11:31', '2024-10-30 00:14:19', 8, NULL, 2),
(42, 'Movin On', '../src/songs/David Guetta & Chris Willis - Love Is Gone (Official Video).mp3', 'Ian Van Dahl', '../src/images/Summer_Eletrohits_3.jpg', '2024-08-30 04:11:31', '2024-10-30 00:14:19', 8, NULL, 2),
(43, 'Beautiful ft. Pharrell Williams', '../src/songs/Snoop Dogg - Beautiful (Official Music Video) ft. Pharrell Williams - SnoopDoggVEVO (youtube).mp3', 'Snoop Dogg', '../src/images/Paid_tha_Cost_to_Be_da_Boss.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 4, NULL, NULL),
(44, 'Still D.R.E. ft. Snoop Dogg', '../src/songs/Dr. Dre - Still D.R.E. ft. Snoop Dogg (1).mp3', 'Dr. Dre', '../src/images/Dr._Dre_-_2001.jpg', '2024-08-30 04:11:31', '2024-10-30 00:14:19', 4, NULL, 2),
(45, 'Heartless', '../src/songs/Kanye West - Heartless.mp3', 'Kanye West', '../src/images/220px-Ye_-_Kanye_West.jpg', '2024-08-30 04:11:31', '2024-10-30 00:14:19', 4, NULL, 2),
(46, 'Something', '../src/songs/The Beatles - Something.mp3', 'The Beatles', '../src/images/Abbey_Road.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 5, NULL, 1),
(47, 'Summer', '../src/songs/Summer.mp3', 'Calvin Harris', '../src/images/Capa_de_Motion_(Calvin_Harris).jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 5, NULL, 1),
(48, 'The Lazy Song', '../src/songs/Bruno Mars - The Lazy Song (Official Music Video).mp3', 'Bruno Mars', '../src/images/Doo-Wops_&_Hooligans.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 5, NULL, 1),
(49, 'Infarto', '../src/songs/Diego & Victor Hugo - Infarto.mp3', 'Diego & Victor Hugo', '../src/images/querosene.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 6, NULL, NULL),
(50, '3 Batidas', '../src/songs/Guilherme e Benuto - 3 Batidas (DVD AMANDO BEBENDO E SOFRENDO).mp3', 'Guilherme e Benuto', '../src/images/3batidas.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 6, NULL, NULL),
(51, 'Áudio', '../src/songs/Diego & Victor Hugo - Áudio (Ao Vivo em Brasília).mp3', 'Diego & Victor Hugo', '../src/images/diegoevictorhugoaovivoembrasilia.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 6, NULL, NULL),
(52, 'Coração Partido', '../src/songs/Grupo Menos é Mais - Coração Partido (Clipe Oficial).mp3', 'Grupo Menos é Mais', '../src/images/corcaopartido.jpeg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 7, NULL, NULL),
(53, 'Duvido (Ao Vivo)', '../src/songs/Turma do Pagode, Ferrugem, Mumuzinho - Duvido (Ao Vivo).mp3', 'Turma do Pagode, Ferrugem, Mumuzinho', '../src/images/mixturadin3v1.jpeg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 7, NULL, NULL),
(54, 'Fica Light (Ao Vivo)', '../src/songs/Dilsinho, Grupo Menos É Mais - Fica Light (Ao Vivo).mp3', 'Dilsinho, Grupo Menos É Mais', '../src/images/diferentao2.jpeg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 7, NULL, NULL),
(55, 'Alive (It Feels Like)', '../src/songs/Alok - Alive (It Feels Like) [Official Video].mp3', 'Alok', '../src/images/alivealok.jpeg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 3, NULL, NULL),
(56, 'Free', '../src/songs/Calvin Harris, Ellie Goulding - Free (Official Lyric Video).mp3', 'Calvin Harris, Ellie Goulding', '../src/images/Calvin_Harris_96_Months.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 3, NULL, NULL),
(57, 'Numb', '../src/songs/Marshmello, Khalid - Numb (Lyric Video).mp3', 'Marshmello, Khalid', '../src/images/numb.jpeg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 3, NULL, NULL),
(58, 'I ve got you under my skin', '../src/songs/Frank Sinatra- I ve got you under my skin - lightningr0d (youtube).mp3', 'Frank Sinatra', '../src/images/FrankSinatra.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 10, NULL, NULL),
(59, 'Strange Fruit', '../src/songs/Billie Holiday - _Strange Fruit_ Live 1959 [Reelin In The Years Archives].mp3', 'Billie Holiday', '../src/images/billieH.jpeg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 10, NULL, NULL),
(60, 'At Last', '../src/songs/At Last.mp3', 'Etta James', '../src/images/At_Last_-_Etta_James.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 10, NULL, NULL),
(61, 'Lady Bird', '../src/songs/Chet Baker - Lady Bird.mp3', 'Chet Baker', '../src/images/lady-bird.jpeg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 10, NULL, NULL),
(62, 'Satin Doll', '../src/songs/Satin Doll.mp3', 'Duke Ellington', '../src/images/SatinDoll.jpeg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 10, NULL, NULL),
(63, 'Sing, Sing, Sing', '../src/songs/Benny Goodman and His Orchestra - Sing, Sing, Sing (Audio).mp3', 'Benny Goodman', '../src/images/sing_sing_sing.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 10, NULL, NULL),
(64, 'Waltz For Debby', '../src/songs/Bill Evans - Waltz For Debby.mp3', 'Bill Evans', '../src/images/Bill_Evans_Trio_-_Waltz_for_Debby.png', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 10, NULL, NULL),
(65, 'Back In Black', '../src/songs/AC_DC - Back In Black (Official 4K Video).mp3', 'AC/DC', '../src/images/Back_in_Black.jpg', '2024-09-03 02:11:33', '2024-09-04 03:26:43', 1, NULL, NULL),
(66, 'Sweet Child O Mine', '../src/songs/Sweet Child O Mine (Official Music Video).mp3', 'Guns N Roses', '../src/images/Guns-N-Roses-Appetite-For-Destruction.jpg', '2024-09-16 23:14:13', '2024-09-05 01:31:14', 1, NULL, NULL),
(67, 'Numb', '../src/songs/Numb (Official Music Video) [4K UPGRADE] – Linkin Park.mp3', 'Linkin Park', '../src/images/lr60124_2017721_132122515753.jpg', '2024-09-03 02:14:13', '2024-10-30 00:27:48', 1, NULL, 2),
(68, 'Boulevard Of Broken Dreams', '../src/songs/Green Day - Boulevard Of Broken Dreams [Official Music Video] [4K Upgrade].mp3', 'Green Day', '../src/images/AmericanIdiot.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 1, NULL, 1),
(69, 'Its My Life', '../src/songs/Bon Jovi - Its My Life (Official Music Video).mp3', 'Bon Jovi', '../src/images/Bon_Jovi_-_Crush.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 1, NULL, 1),
(70, 'Sultans Of Swing', '../src/songs/Dire Straits - Sultans Of Swing (Official Music Video).mp3', 'Dire Straits', '../src/images/DS_Dire_Straits.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 1, NULL, 1),
(71, 'Chop Suey', '../src/songs/System Of A Down - Chop Suey (Official HD Video).mp3', 'Dire Straits', '../src/images/220px-SystemofaDownToxicityalbumcover.jpg', '2024-08-30 03:23:31', '2024-08-30 03:23:31', 1, NULL, 1);
-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL auto_increment primary key,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expire_at` int(11) NOT NULL
);

--
-- Extraindo dados da tabela `password_resets`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11)  NOT NULL auto_increment primary key,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `playlist`
--

INSERT INTO `playlist` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Rock', '2024-08-29 23:40:40', '2024-08-29 23:40:40'),
(3, 'Eletrônica', '2024-08-30 02:40:40', '2024-08-30 02:40:40'),
(4, 'Hip Hop', '2024-09-18 00:16:59', '2024-09-18 00:16:59'),
(5, 'Pop', '2024-08-30 02:40:40', '2024-08-30 02:40:40'),
(6, 'Sertanejo', '2024-08-30 02:40:40', '2024-08-30 02:40:40'),
(7, 'Pagode', '2024-08-30 02:40:40', '2024-08-30 02:40:40'),
(8, 'Summer EletroHits', '2024-08-29 23:40:40', '2024-08-29 23:40:40'),
(9, 'Clássicos', '2024-08-29 23:40:40', '2024-08-29 23:40:40'),
(10, 'Jazz', '2024-08-30 02:40:40', '2024-08-30 02:40:40');

-- --------------------------------------------------------
--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL auto_increment primary key,
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
);
drop table users;
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

--
-- Índices para tabela `music`
--
ALTER TABLE `music`
  ADD KEY `idx_name` (`name`),
  ADD KEY `idx_autor` (`autor`),
  ADD KEY `playlist_id` (`playlist_id`),
  ADD KEY `liked_id` (`liked_id`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `user_id` (`user_id`);
--
-- Índices para tabela `playlist`
--
ALTER TABLE `playlist`
  ADD KEY `idx_name` (`name`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD KEY `playlist_id` (`playlist_id`),
  ADD KEY `likedPlaylist` (`likedPlaylist`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `music_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `music_ibfk_2` FOREIGN KEY (`liked_id`) REFERENCES `likedplaylist` (`ID`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`likedPlaylist`) REFERENCES `likedplaylist` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
