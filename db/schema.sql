-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Έκδοση διακομιστή: 10.4.8-MariaDB
-- Έκδοση PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `project_db`
--

DELIMITER $$
--
-- Διαδικασίες
--
DROP PROCEDURE IF EXISTS `clean_board`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `clean_board` ()  BEGIN
	REPLACE INTO board SELECT * FROM board_empty;
    END$$

DROP PROCEDURE IF EXISTS `deal_card`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deal_card` (`c_id` TINYINT, `position` VARCHAR(5))  BEGIN
	UPDATE board
	SET c_position=position
	WHERE card_id=c_id;
    END$$

DROP PROCEDURE IF EXISTS `play_card`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `play_card` (`c_id` TINYINT)  BEGIN
	UPDATE board
	SET c_position='stack'
	WHERE card_id=c_id;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `board`
--

DROP TABLE IF EXISTS `board`;
CREATE TABLE `board` (
  `card_id` tinyint(4) NOT NULL,
  `c_value` tinyint(4) NOT NULL,
  `c_score` tinyint(4) NOT NULL,
  `c_position` enum('deck','stack','hand1','hand2','won1','won2') COLLATE utf8mb4_bin NOT NULL DEFAULT 'deck'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Άδειασμα δεδομένων του πίνακα `board`
--

INSERT INTO `board` (`card_id`, `c_value`, `c_score`, `c_position`) VALUES
(1, 1, 1, 'deck'),
(2, 2, 0, 'deck'),
(3, 3, 0, 'deck'),
(4, 4, 0, 'deck'),
(5, 5, 0, 'deck'),
(6, 6, 0, 'deck'),
(7, 7, 0, 'deck'),
(8, 8, 0, 'deck'),
(9, 9, 0, 'deck'),
(10, 10, 1, 'deck'),
(11, 11, 1, 'deck'),
(12, 12, 1, 'deck'),
(13, 13, 1, 'deck'),
(14, 1, 1, 'deck'),
(15, 2, 0, 'deck'),
(16, 3, 0, 'deck'),
(17, 4, 0, 'deck'),
(18, 5, 0, 'deck'),
(19, 6, 0, 'deck'),
(20, 7, 0, 'deck'),
(21, 8, 0, 'deck'),
(22, 9, 0, 'deck'),
(23, 10, 1, 'deck'),
(24, 11, 1, 'deck'),
(25, 12, 1, 'deck'),
(26, 13, 1, 'deck'),
(27, 1, 1, 'deck'),
(28, 2, 0, 'deck'),
(29, 3, 0, 'deck'),
(30, 4, 0, 'deck'),
(31, 5, 0, 'deck'),
(32, 6, 0, 'deck'),
(33, 7, 0, 'deck'),
(34, 8, 0, 'deck'),
(35, 9, 0, 'deck'),
(36, 10, 2, 'deck'),
(37, 11, 1, 'deck'),
(38, 12, 1, 'deck'),
(39, 13, 1, 'deck'),
(40, 1, 1, 'deck'),
(41, 2, 1, 'deck'),
(42, 3, 0, 'deck'),
(43, 4, 0, 'deck'),
(44, 5, 0, 'deck'),
(45, 6, 0, 'deck'),
(46, 7, 0, 'deck'),
(47, 8, 0, 'deck'),
(48, 9, 0, 'deck'),
(49, 10, 1, 'deck'),
(50, 11, 1, 'deck'),
(51, 12, 1, 'deck'),
(52, 13, 1, 'deck');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `board_empty`
--

DROP TABLE IF EXISTS `board_empty`;
CREATE TABLE `board_empty` (
  `card_id` tinyint(4) NOT NULL,
  `c_value` tinyint(4) NOT NULL,
  `c_score` tinyint(4) NOT NULL,
  `c_position` enum('deck','stack','hand1','hand2','won1','won2') COLLATE utf8mb4_bin NOT NULL DEFAULT 'deck'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Άδειασμα δεδομένων του πίνακα `board_empty`
--

INSERT INTO `board_empty` (`card_id`, `c_value`, `c_score`, `c_position`) VALUES
(1, 1, 1, 'deck'),
(2, 2, 0, 'deck'),
(3, 3, 0, 'deck'),
(4, 4, 0, 'deck'),
(5, 5, 0, 'deck'),
(6, 6, 0, 'deck'),
(7, 7, 0, 'deck'),
(8, 8, 0, 'deck'),
(9, 9, 0, 'deck'),
(10, 10, 1, 'deck'),
(11, 11, 1, 'deck'),
(12, 12, 1, 'deck'),
(13, 13, 1, 'deck'),
(14, 1, 1, 'deck'),
(15, 2, 0, 'deck'),
(16, 3, 0, 'deck'),
(17, 4, 0, 'deck'),
(18, 5, 0, 'deck'),
(19, 6, 0, 'deck'),
(20, 7, 0, 'deck'),
(21, 8, 0, 'deck'),
(22, 9, 0, 'deck'),
(23, 10, 1, 'deck'),
(24, 11, 1, 'deck'),
(25, 12, 1, 'deck'),
(26, 13, 1, 'deck'),
(27, 1, 1, 'deck'),
(28, 2, 0, 'deck'),
(29, 3, 0, 'deck'),
(30, 4, 0, 'deck'),
(31, 5, 0, 'deck'),
(32, 6, 0, 'deck'),
(33, 7, 0, 'deck'),
(34, 8, 0, 'deck'),
(35, 9, 0, 'deck'),
(36, 10, 2, 'deck'),
(37, 11, 1, 'deck'),
(38, 12, 1, 'deck'),
(39, 13, 1, 'deck'),
(40, 1, 1, 'deck'),
(41, 2, 1, 'deck'),
(42, 3, 0, 'deck'),
(43, 4, 0, 'deck'),
(44, 5, 0, 'deck'),
(45, 6, 0, 'deck'),
(46, 7, 0, 'deck'),
(47, 8, 0, 'deck'),
(48, 9, 0, 'deck'),
(49, 10, 1, 'deck'),
(50, 11, 1, 'deck'),
(51, 12, 1, 'deck'),
(52, 13, 1, 'deck');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `game_status`
--

DROP TABLE IF EXISTS `game_status`;
CREATE TABLE `game_status` (
  `s_id` int(11) NOT NULL,
  `status` enum('not active','initialized','started','ended','aborted') COLLATE utf8mb4_bin NOT NULL DEFAULT 'not active',
  `p_turn` tinyint(4) DEFAULT NULL,
  `result` tinyint(4) DEFAULT NULL,
  `last_change` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Άδειασμα δεδομένων του πίνακα `game_status`
--

INSERT INTO `game_status` (`s_id`, `status`, `p_turn`, `result`, `last_change`) VALUES
(1, 'not active', NULL, NULL, NULL);

--
-- Δείκτες `game_status`
--
DROP TRIGGER IF EXISTS `game_status_update`;
DELIMITER $$
CREATE TRIGGER `game_status_update` BEFORE UPDATE ON `game_status` FOR EACH ROW BEGIN
    	SET NEW.last_change = NOW();
	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `players`
--

DROP TABLE IF EXISTS `players`;
CREATE TABLE `players` (
  `p_id` tinyint(4) NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Άδειασμα δεδομένων του πίνακα `players`
--

INSERT INTO `players` (`p_id`, `username`) VALUES
(1, 'george'),
(2, 'adam');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`card_id`);

--
-- Ευρετήρια για πίνακα `board_empty`
--
ALTER TABLE `board_empty`
  ADD PRIMARY KEY (`card_id`);

--
-- Ευρετήρια για πίνακα `game_status`
--
ALTER TABLE `game_status`
  ADD PRIMARY KEY (`s_id`);

--
-- Ευρετήρια για πίνακα `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `board`
--
ALTER TABLE `board`
  MODIFY `card_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT για πίνακα `board_empty`
--
ALTER TABLE `board_empty`
  MODIFY `card_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT για πίνακα `game_status`
--
ALTER TABLE `game_status`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT για πίνακα `players`
--
ALTER TABLE `players`
  MODIFY `p_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
