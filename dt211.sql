-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2018 at 03:10 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dt211`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `publisher` varchar(20) NOT NULL,
  `year` date NOT NULL,
  `genre` varchar(40) NOT NULL,
  `descr` varchar(40) NOT NULL,
  `quantity` int(3) NOT NULL,
  `price` float NOT NULL,
  `book_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`title`, `author`, `publisher`, `year`, `genre`, `descr`, `quantity`, `price`, `book_id`) VALUES
('Detective Comics 27', 'E.C Stoner', 'DC', '1939-05-23', 'crime-fict', 'Detective Comics Issue #27', 1, 100, 1),
('1984', 'George Orwell', 'Secker and Warburg', '1949-06-08', 'Political ', 'The dystopian novel is set in 1984', 6, 19.84, 2),
('One Direction Where We Are', 'One Direction', 'HarperCollins', '2013-08-27', 'autobiography', 'In depth autobiography of the member of ', 67, 1.99, 3),
('To Kill a Mockingbird', 'Harper Lee', 'J. B. Lippincott & C', '1960-07-11', 'Southern G', 'Cult classic deals with sensitive topics', 45, 16.45, 4),
('A Study in Scarlet', 'Sir Arthur Conan Doyle', 'Ward Lock & Co', '1887-08-12', 'crime', 'Elementary my dear Watson', 32, 23.99, 5),
('The Gospel According to Blindboy', 'Blindboy Boatclub', 'Gill', '2017-10-20', 'fiction', 'surreal genre-defying collection of shor', 4, 9.25, 6),
('The Secret History', 'Donna Heart', 'Alfred A. Knopf', '1992-09-23', 'Novel', 'tells the story of 6 close friends', 34, 14.25, 7),
('Dracula', 'Bram Stoker', 'Archibald Constable ', '1897-05-26', 'Horror', 'Story of Draculas attempt to move from T', 15, 13.23, 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `book_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `title` varchar(60) NOT NULL,
  `username` varchar(100) NOT NULL,
  `quantity` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `address`, `email`, `image`) VALUES
('Casey Ogbevoen', 'hello1', '60 Goatstown Close, Goatstown, Dublin 14', 'caseyv1999@gmail.com', '0'),
('jack', '$2y$10$5XDKZLySjtPCVqIl5crk7e7GTbfrZ2sbh8C3AHLWvcaQvx2psiBxO', '17 dublin, jlkj', 'jack@me.ie', 'uploads/jack.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
