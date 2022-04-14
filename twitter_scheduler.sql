-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Apr 12, 2022 alle 09:36
-- Versione del server: 10.3.34-MariaDB-0ubuntu0.20.04.1
-- Versione PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twitter_scheduler`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `scheduled_tweets`
--

CREATE TABLE `scheduled_tweets` (
  `id` int(5) NOT NULL,
  `text` varchar(281) NOT NULL,
  `timestamp` int(50) NOT NULL,
  `inviato` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `scheduled_tweets`
--

INSERT INTO `scheduled_tweets` (`id`, `text`, `timestamp`, `inviato`) VALUES
(37, 'Tweet di prova 11:31', 1649755860, 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `scheduled_tweets`
--
ALTER TABLE `scheduled_tweets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `scheduled_tweets`
--
ALTER TABLE `scheduled_tweets`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
