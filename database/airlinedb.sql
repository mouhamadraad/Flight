-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 06:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airlinedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `AirlineID` int(11) NOT NULL,
  `AirlineName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`AirlineID`, `AirlineName`) VALUES
(1001, 'Delta Airlines'),
(1002, 'United Airlines'),
(1003, 'American Airlines');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BookingID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `FlightID` int(11) NOT NULL,
  `BookingDate` datetime(6) NOT NULL,
  `NumberofPassenger` int(11) NOT NULL,
  `SeatNumbers` varchar(50) NOT NULL,
  `PaymentStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`BookingID`, `UserID`, `FlightID`, `BookingDate`, `NumberofPassenger`, `SeatNumbers`, `PaymentStatus`) VALUES
(1100, 1, 1, '2024-03-16 15:00:00.000000', 2, 'A1, A2', 'Paid'),
(1200, 2, 2, '2024-03-17 10:00:00.000000', 1, 'B3', 'Pending'),
(1300, 3, 3, '2024-03-18 12:00:00.000000', 3, 'C4', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `coinsrequest`
--

CREATE TABLE `coinsrequest` (
  `requestID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `coinsAmount` int(11) NOT NULL,
  `requestDate` datetime(6) DEFAULT current_timestamp(6),
  `ApprovalStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coinsrequest`
--

INSERT INTO `coinsrequest` (`requestID`, `UserID`, `coinsAmount`, `requestDate`, `ApprovalStatus`) VALUES
(1, 1, 100, '2024-03-16 14:00:00.000000', 'Approved'),
(2, 2, 150, '2024-03-17 09:00:00.000000', 'Pending'),
(3, 3, 200, '2024-03-18 11:00:00.000000', 'Approved'),
(4, 8, 250, '2024-06-19 21:45:04.597516', 'Accept'),
(8, 10, 400, '2024-06-21 16:41:02.000000', 'Pending'),
(9, 10, 400, '2024-06-21 16:41:56.000000', 'Accept');

-- --------------------------------------------------------

--
-- Table structure for table `flightreviews`
--

CREATE TABLE `flightreviews` (
  `ReviewID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `FlightID` int(11) NOT NULL,
  `Rating` int(11) NOT NULL,
  `reviewText` varchar(50) NOT NULL,
  `reviewDate` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flightreviews`
--

INSERT INTO `flightreviews` (`ReviewID`, `UserID`, `FlightID`, `Rating`, `reviewText`, `reviewDate`) VALUES
(4, 1, 1, 5, 'Great flight, smooth ride!', '2024-03-17 12:00:00.000000'),
(5, 2, 2, 4, 'Good service, but food could be better.', '2024-03-18 13:00:00.000000'),
(6, 3, 3, 5, 'Excellent experience overall.', '2024-03-19 14:00:00.000000'),
(7, 1, 1, 5, 'gd', '2024-06-20 20:34:34.501774');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `FlightID` int(11) NOT NULL,
  `AirlineID` int(11) NOT NULL,
  `DepartureCity` varchar(50) NOT NULL,
  `ArrivalCity` varchar(50) NOT NULL,
  `DepartureTime` datetime(6) NOT NULL,
  `ArrivalTime` datetime(6) NOT NULL,
  `price` int(11) NOT NULL,
  `AvailableSeats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`FlightID`, `AirlineID`, `DepartureCity`, `ArrivalCity`, `DepartureTime`, `ArrivalTime`, `price`, `AvailableSeats`) VALUES
(1, 1001, 'New York', 'Los Angeles', '2024-03-17 08:00:00.000000', '2024-03-17 11:00:00.000000', 250, 100),
(2, 1002, 'Chicago', 'Dallas', '2024-03-18 09:00:00.000000', '2024-03-18 11:30:00.000000', 200, 150),
(3, 1003, 'Miami', 'Denver', '2024-03-19 10:00:00.000000', '2024-03-19 13:00:00.000000', 300, 80);

-- --------------------------------------------------------

--
-- Table structure for table `flightstatues`
--

CREATE TABLE `flightstatues` (
  `statusID` int(11) NOT NULL,
  `FlightID` int(11) NOT NULL,
  `statusText` varchar(50) NOT NULL,
  `statusDate` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flightstatues`
--

INSERT INTO `flightstatues` (`statusID`, `FlightID`, `statusText`, `statusDate`) VALUES
(4, 1, 'On time', '2024-03-17 07:00:00.000000'),
(5, 2, 'Delayed', '2024-03-18 08:30:00.000000'),
(6, 3, 'Scheduled', '2024-03-19 09:30:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `recipientID` int(11) NOT NULL DEFAULT 0,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `UserID`, `recipientID`, `message`, `timestamp`) VALUES
(1, 8, 0, 'die', '2024-06-20 07:48:10'),
(2, 8, 0, 'hi', '2024-06-20 08:00:42'),
(3, 10, 1, 'hello', '2024-06-21 14:38:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `accessibility` text DEFAULT NULL,
  `seat` varchar(255) DEFAULT NULL,
  `assistance` text DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `name`, `email`, `password`, `gender`, `accessibility`, `seat`, `assistance`, `amount`) VALUES
(1, 'John Doe', 'john@example.com', 'password123', 'male', NULL, NULL, NULL, 0.00),
(2, 'Jane Smith', 'jane@example.com', 'password456', 'female', NULL, NULL, NULL, 0.00),
(3, 'Michael Johnson', 'michael@example.com', 'password789', 'male', NULL, NULL, NULL, 0.00),
(8, 'joujou', 'joumanaraad76@gmail.com', '$2y$10$0wvcEF5P.sh4GWqEsfTZoegvGHTT0/2n3MDJPEzE.PfmMkoOaJbK6', 'female', NULL, NULL, NULL, 250.00),
(10, ' mhmd', 'mohamadraad515@gmail.com', '$2y$10$Kr0UPgux8ZMWx8tP5uqrgOMIhchXh8B/XA83GLBxDovL7mREkIGCm', 'male', 'null', '7', 'null', 400.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`AirlineID`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `FlightID` (`FlightID`);

--
-- Indexes for table `coinsrequest`
--
ALTER TABLE `coinsrequest`
  ADD PRIMARY KEY (`requestID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `flightreviews`
--
ALTER TABLE `flightreviews`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `FlightID` (`FlightID`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`FlightID`),
  ADD KEY `AirlineID` (`AirlineID`);

--
-- Indexes for table `flightstatues`
--
ALTER TABLE `flightstatues`
  ADD PRIMARY KEY (`statusID`),
  ADD KEY `FlightID` (`FlightID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `AirlineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1301;

--
-- AUTO_INCREMENT for table `coinsrequest`
--
ALTER TABLE `coinsrequest`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `flightreviews`
--
ALTER TABLE `flightreviews`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `FlightID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `flightstatues`
--
ALTER TABLE `flightstatues`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`FlightID`) REFERENCES `flights` (`FlightID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `coinsrequest`
--
ALTER TABLE `coinsrequest`
  ADD CONSTRAINT `coinsrequest_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `flightreviews`
--
ALTER TABLE `flightreviews`
  ADD CONSTRAINT `flightreviews_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `flightreviews_ibfk_2` FOREIGN KEY (`FlightID`) REFERENCES `flights` (`FlightID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`AirlineID`) REFERENCES `airlines` (`AirlineID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `flightstatues`
--
ALTER TABLE `flightstatues`
  ADD CONSTRAINT `flightstatues_ibfk_1` FOREIGN KEY (`FlightID`) REFERENCES `flights` (`FlightID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
