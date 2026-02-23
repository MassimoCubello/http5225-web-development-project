-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 23, 2026 at 01:41 PM
-- Server version: 5.7.24
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blockbuster`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_convert_currency` (`initial_value` DECIMAL(13,2), `conversion_rate` DECIMAL(3,2)) RETURNS DECIMAL(13,2)  BEGIN
	DECLARE converted_value DECIMAL(13,2);
    SET converted_value = initial_value * conversion_rate;
    RETURN converted_value;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `all_game_rentals`
-- (See below for the actual view)
--
CREATE TABLE `all_game_rentals` (
`first_name` varchar(255)
,`last_name` varchar(255)
,`game_title` varchar(255)
,`console` varchar(255)
,`date_rented` date
,`date_returned` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `all_movie_rentals`
-- (See below for the actual view)
--
CREATE TABLE `all_movie_rentals` (
`first_name` varchar(255)
,`last_name` varchar(255)
,`title` varchar(255)
,`date_rented` date
,`date_returned` date
);

-- --------------------------------------------------------

--
-- Table structure for table `consoles`
--

CREATE TABLE `consoles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `release_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `consoles`
--

INSERT INTO `consoles` (`id`, `name`, `release_date`) VALUES
(1, 'Nintendo Gamecube', '2001-11-05'),
(2, 'Playstation 2', '2000-10-26'),
(3, 'Microsoft Xbox', '2001-11-15'),
(4, 'Sega Dreamcast', '1999-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `contact_log`
--

CREATE TABLE `contact_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_log`
--

INSERT INTO `contact_log` (`id`, `name`, `email`, `subject`, `message`, `date_created`) VALUES
(1, 'sam', 'sam@email.com', 'sam', 'sam', '2026-02-21 23:07:39'),
(2, 'sam', 'sam@email.com', 'sam', 'sam', '2026-02-21 23:11:41'),
(3, 'Me', 'fake@mail.com', 'My Email', 'This is my email', '2026-02-21 23:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `console_id` int(11) NOT NULL,
  `release_date` date DEFAULT NULL,
  `rental_price` decimal(13,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `console_id`, `release_date`, `rental_price`) VALUES
(1, 'Super Mario Sunshine', 1, '2002-10-04', '8.99'),
(2, 'Luigi\'s Mansion', 1, '2001-11-14', '8.99'),
(3, 'Final Fantasy X', 2, '2001-12-20', '8.99'),
(4, 'Halo: Combat Evolved', 3, '2001-11-15', '10.99'),
(5, 'Sonic Adventure', 4, '1999-09-09', '8.99');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `release_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `release_date`) VALUES
(1, 'Shrek', '2001-05-18'),
(2, 'Spiderman', '2002-05-03'),
(3, 'Harry Potter and the Sorcerer\'s Stone', '2001-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` int(11) NOT NULL,
  `renter_id` int(11) NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `date_rented` date DEFAULT NULL,
  `date_returned` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `renter_id`, `game_id`, `movie_id`, `date_rented`, `date_returned`) VALUES
(1, 1, 1, NULL, '2025-11-01', NULL),
(2, 1, 2, NULL, '2025-10-29', '2025-11-02'),
(3, 2, NULL, 1, '2025-11-02', NULL),
(5, 3, NULL, 2, '2025-11-02', NULL),
(6, 1, NULL, 1, '2025-11-05', NULL),
(7, 1, NULL, 2, '2025-11-05', NULL);

--
-- Triggers `rentals`
--
DELIMITER $$
CREATE TRIGGER `insert_renter_last_activity` AFTER INSERT ON `rentals` FOR EACH ROW UPDATE renters SET renters.last_activity_date = NOW()
WHERE renters.id = NEW.renter_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `on_movie_rental_update_renter_last_movie` AFTER INSERT ON `rentals` FOR EACH ROW UPDATE renters SET last_rented_movie_id = NEW.movie_id
WHERE renters.id = NEW.renter_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `renters`
--

CREATE TABLE `renters` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_activity_date` timestamp NULL DEFAULT NULL,
  `last_rented_movie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `renters`
--

INSERT INTO `renters` (`id`, `first_name`, `last_name`, `phone`, `join_date`, `last_activity_date`, `last_rented_movie_id`) VALUES
(1, 'Sam', 'Bebenek', '9055551234', '2025-11-02 20:18:39', '2025-11-06 00:06:56', 2),
(2, 'Nicolos', 'Cage', '9055551235', '2025-11-02 20:20:06', NULL, NULL),
(3, 'John', 'Cena', '9055551236', '2025-11-02 20:20:06', '2025-11-02 20:45:32', NULL),
(4, 'Eddie', 'Van Halen', '4165531234', '2025-11-02 20:20:06', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure for view `all_game_rentals`
--
DROP TABLE IF EXISTS `all_game_rentals`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_game_rentals`  AS SELECT `renters`.`first_name` AS `first_name`, `renters`.`last_name` AS `last_name`, `games`.`name` AS `game_title`, `consoles`.`name` AS `console`, `rentals`.`date_rented` AS `date_rented`, `rentals`.`date_returned` AS `date_returned` FROM (((`renters` join `rentals` on((`renters`.`id` = `rentals`.`renter_id`))) join `games` on((`rentals`.`game_id` = `games`.`id`))) join `consoles` on((`games`.`console_id` = `consoles`.`id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `all_movie_rentals`
--
DROP TABLE IF EXISTS `all_movie_rentals`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_movie_rentals`  AS SELECT `renters`.`first_name` AS `first_name`, `renters`.`last_name` AS `last_name`, `movies`.`title` AS `title`, `rentals`.`date_rented` AS `date_rented`, `rentals`.`date_returned` AS `date_returned` FROM ((`renters` join `rentals` on((`renters`.`id` = `rentals`.`renter_id`))) join `movies` on((`rentals`.`movie_id` = `movies`.`id`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consoles`
--
ALTER TABLE `consoles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_log`
--
ALTER TABLE `contact_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `renters`
--
ALTER TABLE `renters`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consoles`
--
ALTER TABLE `consoles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_log`
--
ALTER TABLE `contact_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `renters`
--
ALTER TABLE `renters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
