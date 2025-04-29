-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2025 at 06:42 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Veil`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `fileSize` int(11) NOT NULL,
  `EncriptedFile` longblob NOT NULL,
  `iv` varchar(24) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `IDNota` int(11) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `testo` text NOT NULL,
  `gruppo` int(11) DEFAULT NULL,
  `iv` varchar(24) NOT NULL,
  `userID` int(11) NOT NULL,
  `lastEdited` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`IDNota`, `titolo`, `testo`, `gruppo`, `iv`, `userID`, `lastEdited`) VALUES
(16, 'm4rwR0ymVQrbclj/doyAmZoZ+xAt05Cs4Q5VyA==', 'sZ7sVV7nfwTcd1ivTWaB5k7UU3POquf06hBFqoqM3xmma09SYT88yIhBshX4r/gQHl/Oqg==', 0, 'y/eocyHjrYr5UR11', 1, '2025-04-27 12:45:04'),
(17, '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', 3, 'JRdIk2EDHHlx3fFr', 1, '2025-04-27 23:23:04'),
(18, 'NI6tU1C9tSCCe8auKO38+ferj0dgjSin', 'Wou+XwestC4Sj4AfD3yPWvNiK9x3R1tEIk9ZODY4UyqmNIu9BJNhIUXfSF8fEGN24tCYq63E7w==', 5, '3L7Wf0yV7N6is/Zv', 1, '2025-04-26 16:53:16'),
(19, '9Qn97QHiTzJf2D6uYAANdtcDOfsOon7pgMY9', '0A/i8Q7lTX1f1C0FyJn1NgOhPHPjgS0zo1kTHIN38CPSLMgM4DTAKQ==', 2, 'FxJSQHB2z6yfpJmF', 1, '2025-04-27 18:31:04'),
(20, '3LbYPuJiK201i1ILb4zDcS4QTMExy1aZPu4AJbs=', '3LbYPuJiK207yVYSYWc3MenPRU/HykbUEqpfyl23W+UbzuGjMxQap9gSS0uvWec=', 4, 'vbeJOXwKCkGXriJd', 4, '2025-04-26 16:36:21'),
(21, 'uDMqmirqO+gz+C8/lzIW8AWNuCki3D0=', 'vTxunTn9fsYXz/1s6FWiCBZRhNGUvL//H1PXWu7Dvl7sXnDxRDLmwLkzsik1pLL7Qm1QqYDT', 5, 'hV9I72qXZH4LpyJs', 1, '2025-04-27 18:30:58'),
(22, 'Ts3vMcoRJ8Ec1d87rJ53G/FqP8vdswjX4Q==', 'XMXhMMsWL5MXqZ234JOOkDeCeZKXAOSwGlDZFmQRXIMuBnmrbTye2ibrPdBcf1NhthbCcgs=', 2, 'H4ZiFC39W/aTp/N7', 5, '2025-04-26 17:02:53');

-- --------------------------------------------------------

--
-- Table structure for table `utenti`
--

CREATE TABLE `utenti` (
  `UID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `passhash` char(64) DEFAULT NULL,
  `salt` char(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utenti`
--

INSERT INTO `utenti` (`UID`, `username`, `passhash`, `salt`) VALUES
(1, 'OtaRems', '66ae6540933db9bba113cf8f47221d890fd8099bdafd5b1d2ffa6bf3fbed8270', 'g6RNn454D9jz0l53'),
(2, 'Negro', 'a183602138e04b5c44fccb9664498924b417162b9fe2bf573a18720d79a24d8b', 'Sm52m7p3Apx6Ze5K'),
(3, 'OtaRemma', '353a6035dc45b6a942105d38205f86a59bb69b789b26fb31ae1a66a6ccf1a0a4', 'fbu45Gxh858P82Sp'),
(4, 'Gino', '2bd225ce52f7e837a4e0518079e7ad30fc400f89931a81a81ccc6058730658ed', 'Ogq4hVL0b4JJ28N9'),
(5, 'sasyanc', '0d05c11e7f1a7e2a48032df4d7de7874a0e99b71ca257b392510551496227a78', 'y4H1gHl02ar24g4x');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`IDNota`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `IDNota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `utenti`
--
ALTER TABLE `utenti`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `utenti` (`UID`);

--
-- Constraints for table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `utenti` (`UID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
