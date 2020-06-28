-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Cze 2020, 08:59
-- Wersja serwera: 10.4.13-MariaDB
-- Wersja PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `books`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `author`
--

INSERT INTO `author` (`id`, `name`, `lastname`) VALUES
(1, 'Blanka', 'Lipińska'),
(2, 'Remigiusz', 'Mróz'),
(3, 'Coben', 'Harlan'),
(4, 'Riddle', 'A.G.'),
(5, 'Magda', 'Knedler');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `print` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_order` tinyint(1) NOT NULL,
  `order_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `book`
--

INSERT INTO `book` (`id`, `author_id`, `title`, `print`, `year`, `description`, `is_order`, `order_date`) VALUES
(1, 1, '\"Ten dzień\"', 'Edipresse Książki', 2018, 'Literatura obyczajowa', 1, NULL),
(2, 2, '\"Ekstradycja\"', 'Czwarta Strona', 2020, 'Kryminał', 1, NULL),
(3, 2, '\"Lot 202\"', 'Wydawnictwo Filia', 2020, 'Kryminał', 0, NULL),
(4, 2, '\"Głosy z zaświatów\"', 'Wydawnictwo Filia', 2020, 'Thriller', 1, NULL),
(5, 1, '\"365 dni\"', 'Edipresse Książki', 2018, 'Literatura obyczajowa', 0, NULL),
(6, 3, '\"O krok za daleko\"', 'Wydawnictwo Albatros', 2020, 'Thriller', 0, NULL),
(7, 4, '\"Pandemia\"', 'Wydawnictwo Filia', 2019, 'Science Fiction', 0, NULL),
(8, 5, '\"Położna z Auschwitz\"', 'Mando', 2020, 'Literatura piękna polska', 1, NULL),
(9, 5, '\"Dziewczyna kata\"', 'Mando', 2019, 'Literatura piękna polska', 0, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `book_user`
--

CREATE TABLE `book_user` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `book_user`
--

INSERT INTO `book_user` (`id`, `book_id`, `user_id`) VALUES
(2, 5, 6),
(3, 2, 6),
(4, 3, 6),
(5, 8, 6),
(6, 1, 6),
(7, 3, 23),
(8, 4, 24);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `surname`) VALUES
(5, 'admin@php.pl', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$YkRocDlBNzNyQkZFcmpMeg$lXTr0dfgFgOwuXOlsGRxdu3KLU9wvcSuNI5JMpQHpd4', 'admin', 'admin'),
(6, 'manager1@php.pl', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$RzltWEtqSUpZcXcyaHl5ZA$F1VMqCsW1Og0jiX2zEBNx5ym3zovRBdrvA1FF4LWMmc', 'manager', 'manager1'),
(20, 'olla@op.pl', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$T0ZNR0EyckgxblB2RHFxQw$SVf33TnX20wMHWq7rnxBSXpZcu92PJ1cB9xTRLGMoro', 'Ola', 'Ola'),
(21, 'olabodziacka@op.pl', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$VmZlOXJ1ZW94LzV5bWVuVQ$RtJPotCRkKBFZ/w4hXvxFK4bEX3IpGk6Ajo0XpDl47U', 'Aleksandra Bodziacka', 'Ola'),
(22, 'aleksandrabodziacka@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$ZGFWcjJhR0V6NlYzSlY1eA$BYvt5CsG/9tpyu0xHk+l9Z9es3qe+FHeANLV2FD2H18', 'Aleksandra Bodziacka', 'Ola'),
(23, 'olaabodziacka@op.plq', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$dWhQZkJHMURWQWFxOXJ5eg$QElifJLl9RHV/c2y9rfKJrAJvAJiyh4cJf1ApTCNV+s', 'Aleksandra', 'Ola'),
(24, 'ola123@op.pl', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$UjZKL1hPRFlvOUJwTzJTbA$evJzSRUv4o+sSp/SYHQmVPubNpbVmBUocKDYwSbg6wM', 'Ola', 'Ola');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indeksy dla tabeli `book_user`
--
ALTER TABLE `book_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `book_user`
--
ALTER TABLE `book_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`);

--
-- Ograniczenia dla tabeli `book_user`
--
ALTER TABLE `book_user`
  ADD CONSTRAINT `book_user_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `book_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
