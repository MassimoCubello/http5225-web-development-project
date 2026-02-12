-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 12, 2026 at 09:00 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wdp_assign1`
--

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int NOT NULL,
  `firstName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dateOfBirth` date NOT NULL,
  `hometown` varchar(255) NOT NULL,
  `manufacturer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `team` varchar(255) NOT NULL,
  `carNumber` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `firstName`, `lastName`, `dateOfBirth`, `hometown`, `manufacturer`, `team`, `carNumber`) VALUES
(1, 'Kyle', 'Larson', '1992-07-31', 'Elk Grove, CA', 'Chevrolet', 'Hendrick Motorsports', 5),
(2, 'Chase', 'Elliott', '1995-11-28', 'Dawsonville, GA', 'Chevrolet', 'Hendrick Motorsports', 9),
(3, 'Denny', 'Hamlin', '1980-11-18', 'Chesterfield, VA', 'Toyota', 'Joe Gibbs Racing', 11),
(4, 'Joey', 'Logano', '1990-05-24', 'Middletown, CT', 'Ford', 'Team Penske', 22),
(5, 'Kevin', 'Harvick', '1975-12-08', 'Bakersfield, CA', 'Ford', 'Stewart-Haas Racing', 4),
(6, 'Martin', 'Truex Jr.', '1980-06-29', 'Mayetta, NJ', 'Toyota', 'Joe Gibbs Racing', 19),
(7, 'William', 'Byron', '1997-11-29', 'Charlotte, NC', 'Chevrolet', 'Hendrick Motorsports', 24),
(8, 'Ryan', 'Blaney', '1993-12-31', 'High Point, NC', 'Ford', 'Team Penske', 12),
(9, 'Brad', 'Keselowski', '1984-02-12', 'Rochester Hills, MI', 'Ford', 'RFK Racing', 6),
(10, 'Kyle', 'Busch', '1985-05-02', 'Las Vegas, NV', 'Chevrolet', 'Richard Childress Racing', 8),
(11, 'Alex', 'Bowman', '1993-04-25', 'Tucson, AZ', 'Chevrolet', 'Hendrick Motorsports', 48),
(12, 'Christopher', 'Bell', '1995-12-16', 'Norman, OK', 'Toyota', 'Joe Gibbs Racing', 20),
(13, 'Tyler', 'Reddick', '1996-01-11', 'Corning, CA', 'Toyota', '23XI Racing', 45),
(14, 'Bubba', 'Wallace', '1993-10-08', 'Mobile, AL', 'Toyota', '23XI Racing', 23),
(15, 'Ross', 'Chastain', '1992-12-04', 'Alva, FL', 'Chevrolet', 'Trackhouse Racing', 1),
(16, 'Daniel', 'Suárez', '1992-01-07', 'Monterrey, Mexico', 'Chevrolet', 'Trackhouse Racing', 99),
(17, 'Austin', 'Dillon', '1990-04-27', 'Welcome, NC', 'Chevrolet', 'Richard Childress Racing', 3),
(18, 'Michael', 'McDowell', '1984-12-21', 'Glendale, AZ', 'Ford', 'Front Row Motorsports', 34),
(19, 'Chris', 'Buescher', '1992-10-29', 'Prosper, TX', 'Ford', 'RFK Racing', 17),
(20, 'Aric', 'Almirola', '1984-03-14', 'Tampa, FL', 'Ford', 'Stewart-Haas Racing', 10),
(21, 'AJ', 'Allmendinger', '1981-12-16', 'Los Gatos, CA', 'Chevrolet', 'Kaulig Racing', 16),
(22, 'Erik', 'Jones', '1996-05-30', 'Byron, MI', 'Toyota', 'Legacy Motor Club', 43),
(23, 'Ricky', 'Stenhouse Jr.', '1987-10-02', 'Olive Branch, MS', 'Chevrolet', 'JTG Daugherty Racing', 47),
(24, 'Justin', 'Haley', '1999-07-28', 'Winamac, IN', 'Chevrolet', 'Kaulig Racing', 31),
(25, 'Corey', 'LaJoie', '1991-09-25', 'Charlotte, NC', 'Chevrolet', 'Spire Motorsports', 7),
(26, 'Noah', 'Gragson', '1998-07-15', 'Las Vegas, NV', 'Ford', 'Stewart-Haas Racing', 10),
(27, 'Ty', 'Gibbs', '2002-10-04', 'Charlotte, NC', 'Toyota', 'Joe Gibbs Racing', 54),
(28, 'Zane', 'Smith', '1999-06-09', 'Huntington Beach, CA', 'Ford', 'Front Row Motorsports', 38),
(29, 'Josh', 'Berry', '1990-10-02', 'Hendersonville, TN', 'Ford', 'Stewart-Haas Racing', 4),
(30, 'Chase', 'Briscoe', '1994-12-15', 'Mitchell, IN', 'Ford', 'Stewart-Haas Racing', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
