-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Nov 16, 2025 alle 11:31
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tests`
--
CREATE DATABASE IF NOT EXISTS `tests` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tests`;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `Username` varchar(20) NOT NULL,
  `Password` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`Username`, `Password`) VALUES
('12345', '$argon2id$v=19$m=65536,t=4,p=1$RG1uVGUzVjBKdDgzZVQ5Nw$XoOeOEw2ji7j+iiw2Vigm1oD7WcB6Kg8TlQvbyyS02M'),
('matteo', '$argon2id$v=19$m=65536,t=4,p=1$QkVQR2QxcTdJOXF6SUtPeg$79s9fhnotSACV2vgvG2GfSicp+mTDwvaZfX0Ad0Imeg'),
('mattia', '$argon2id$v=19$m=65536,t=4,p=1$dC9jaVlZQTlPcHZSb3BYZQ$sTm6cEg+/ujELkECwie5VnKlnGf+KOd2IniqvQm8vhg'),
('pippo', '$argon2id$v=19$m=65536,t=4,p=1$ZEpmcWZoWVZ2c0pVYXZWUg$KCZeUYYFCgPlw2qQQEiJyprBsdt0bwYNLXyg1qr2wbI');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
