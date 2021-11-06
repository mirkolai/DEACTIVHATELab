-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Nov 06, 2021 alle 16:09
-- Versione del server: 10.1.48-MariaDB-cll-lve
-- Versione PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `h572054_didattica`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `tweets`
--

CREATE TABLE `tweets` (
  `topic` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` bigint(20) NOT NULL,
  `text` varchar(1500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_retweet` int(11) NOT NULL,
  `is_quote` int(11) NOT NULL,
  `is_reply` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `week_year` int(11) NOT NULL,
  `administrative_division_0` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `administrative_division_1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `administrative_division_2` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hs` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aggressiveness` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '3 no weak strong',
  `offensiveness` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '3 no weak strong',
  `stereotype` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '2 yes no',
  `irony` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '2 yes no',
  `intensity` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '4. 1 2 3 4',
  `annotatori` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='insert into annotazione.ids SELECT id,sum(retweet) from HS.daily_virality group by id having sum(retweet)>50  insert into annotazione.ids_tweets SELECT  * from annotazione.ids join HS.tweet_backup on HS.tweet_backup.id=annotazione.ids.id where topic=''all''   insert into annotazione.tweets SELECT  `topic`, `id`, `text`, `is_retweet`, `is_quote`, `is_reply`, `year`, `month`, `day`, `week_year`, `administrative_division_0`, `administrative_division_1`, `administrative_division_2`, `hs`, `aggressiveness`, `offensiveness`, `stereotype`, `irony`, `intensity`, `re-annotate`   from annotazione.ids_tweets where hs=''yes'' order by sum desc limit 50  insert into annotazione.tweets SELECT `topic`, `id`, `text`, `is_retweet`, `is_quote`, `is_reply`, `year`, `month`, `day`, `week_year`, `administrative_division_0`, `administrative_division_1`, `administrative_division_2`, `hs`, `aggressiveness`, `offensiveness`, `stereotype`, `irony`, `intensity`, `re-annotate` from annotazione.ids_tweets where hs=''no'' order by sum desc limit 50';

-- --------------------------------------------------------

--
-- Struttura della tabella `tweet_test`
--

CREATE TABLE `tweet_test` (
  `id` bigint(20) NOT NULL,
  `text` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hs` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `_accessi`
--

CREATE TABLE `_accessi` (
  `user_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `_annotazioni`
--

CREATE TABLE `_annotazioni` (
  `tweet_id` bigint(20) NOT NULL,
  `user_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hs` int(50) NOT NULL,
  `dimensione_1` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dimensione_2` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dimensione_3` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creazione` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sessione_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `_annotazioni_temp`
--

CREATE TABLE `_annotazioni_temp` (
  `id` int(11) NOT NULL,
  `tweet_id` bigint(20) NOT NULL,
  `user_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hs` int(50) NOT NULL,
  `dimensione_1` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dimensione_2` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dimensione_3` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creazione` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `_cap`
--

CREATE TABLE `_cap` (
  `code` varchar(47) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `_country`
--

CREATE TABLE `_country` (
  `Code` char(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `Name` char(52) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `Continent` enum('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Asia',
  `Region` char(26) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `SurfaceArea` float(10,2) NOT NULL DEFAULT '0.00',
  `IndepYear` smallint(6) DEFAULT NULL,
  `Population` int(11) NOT NULL DEFAULT '0',
  `LifeExpectancy` float(3,1) DEFAULT NULL,
  `GNP` float(10,2) DEFAULT NULL,
  `GNPOld` float(10,2) DEFAULT NULL,
  `LocalName` char(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `GovernmentForm` char(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `HeadOfState` char(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Capital` int(11) DEFAULT NULL,
  `Code2` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `_sessioni`
--

CREATE TABLE `_sessioni` (
  `sessione_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `affidabilita` double NOT NULL,
  `agreement_macchina` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `_survey`
--

CREATE TABLE `_survey` (
  `user_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_compilazione` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `genere` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eta` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cittadinanza` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `istruzione` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `professione` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_politica` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CAP` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `_user`
--

CREATE TABLE `_user` (
  `user_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hash_mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data_creazione` timestamp(1) NOT NULL DEFAULT CURRENT_TIMESTAMP(1) ON UPDATE CURRENT_TIMESTAMP(1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`topic`,`id`);

--
-- Indici per le tabelle `tweet_test`
--
ALTER TABLE `tweet_test`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `text` (`text`);

--
-- Indici per le tabelle `_accessi`
--
ALTER TABLE `_accessi`
  ADD PRIMARY KEY (`user_id`,`data`);

--
-- Indici per le tabelle `_annotazioni`
--
ALTER TABLE `_annotazioni`
  ADD PRIMARY KEY (`tweet_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `_annotazioni_temp`
--
ALTER TABLE `_annotazioni_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `_cap`
--
ALTER TABLE `_cap`
  ADD PRIMARY KEY (`code`);

--
-- Indici per le tabelle `_country`
--
ALTER TABLE `_country`
  ADD PRIMARY KEY (`Code`);

--
-- Indici per le tabelle `_sessioni`
--
ALTER TABLE `_sessioni`
  ADD PRIMARY KEY (`sessione_id`);

--
-- Indici per le tabelle `_survey`
--
ALTER TABLE `_survey`
  ADD PRIMARY KEY (`user_id`);

--
-- Indici per le tabelle `_user`
--
ALTER TABLE `_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `hash_mail` (`hash_mail`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `_annotazioni_temp`
--
ALTER TABLE `_annotazioni_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
