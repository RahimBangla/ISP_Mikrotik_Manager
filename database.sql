-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2018 at 08:13 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@site.com', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`) VALUES
(5, 'Mayfair'),
(6, 'St. James\'s'),
(7, 'Westminster'),
(8, 'London'),
(9, 'DC'),
(10, 'Silicon Valley'),
(11, 'Chicago'),
(12, 'Mayfair'),
(13, 'St. James\'s'),
(14, 'Westminster'),
(15, 'New York'),
(16, 'DC'),
(17, 'Silicon Valley'),
(18, 'Chicago');

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `id` int(100) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`id`, `title`, `amount`, `type`, `date`) VALUES
(4, 'Purchase Cable ', '3', 'Expense', '2018-03-24'),
(5, 'Collect Bills 2', '20', 'Income', '2018-03-24'),
(6, 'Manual Payment Cash Hand To Hand', '5', 'Income', '2018-03-25'),
(7, 'Manual Payment Cash Don', '5', 'Income', '2018-03-25'),
(8, 'Stripe Payment4242', '3.45', 'Income', '2018-03-25'),
(9, 'Stripe Payment (4242)', '3.45', 'Income', '2018-03-25'),
(10, 'Manual Payment (Cash) (Office)', '10', 'Income', '2018-03-25'),
(11, 'Manual Payment (Cash) (Office)', '5', 'Income', '2018-03-25'),
(12, 'Manual Payment (Cash) (Office)', '10', 'Income', '2018-03-25'),
(13, 'Manual Payment (Cash) (Office)', '10', 'Income', '2018-03-25'),
(14, 'Manual Payment (Cash) (Office)', '10', 'Income', '2018-03-25'),
(15, 'Stripe Payment (4242)', '3.45', 'Income', '2018-03-25'),
(16, 'Stripe Payment (4242)', '3.45', 'Income', '2018-03-27'),
(17, 'Stripe Payment (4242)', '3.45', 'Income', '2018-03-27'),
(18, 'Stripe Payment (4242)', '13.8', 'Income', '2018-03-29');

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `billid` int(11) NOT NULL,
  `userid` int(100) NOT NULL,
  `billstatus` varchar(250) CHARACTER SET latin1 NOT NULL,
  `month` varchar(250) CHARACTER SET latin1 NOT NULL,
  `year` varchar(250) CHARACTER SET latin1 NOT NULL,
  `package` varchar(250) CHARACTER SET latin1 NOT NULL,
  `matchid` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`billid`, `userid`, `billstatus`, `month`, `year`, `package`, `matchid`) VALUES
(218, 348, 'Paid', 'August', '2018', '12', ''),
(217, 355, 'Paid', 'August', '2018', '12', ''),
(224, 343, 'Paid', 'August', '2018', '12', ''),
(220, 344, 'Paid', 'August', '2018', '12', '');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `emailID` int(11) NOT NULL,
  `time` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emailTo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emailSubject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `network` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoiceID` int(255) NOT NULL,
  `userid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duedate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paymentmethod` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paymentacc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paidamount` float DEFAULT NULL,
  `paidmethod` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paidacc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `package` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `discount` float NOT NULL,
  `matchid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost2` mediumtext COLLATE utf8_unicode_ci,
  `cost3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value1` float DEFAULT NULL,
  `value2` float DEFAULT NULL,
  `value3` float DEFAULT NULL,
  `value4` float DEFAULT NULL,
  `value5` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `packid` int(100) NOT NULL,
  `packname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `packvolume` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `packprice` float NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value1` float DEFAULT NULL,
  `value2` float DEFAULT NULL,
  `value3` float DEFAULT NULL,
  `value4` float DEFAULT NULL,
  `value5` float DEFAULT NULL,
  `total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`packid`, `packname`, `packvolume`, `packprice`, `code`, `cost1`, `cost2`, `cost3`, `cost4`, `cost5`, `value1`, `value2`, `value3`, `value4`, `value5`, `total`) VALUES
(12, 'Basic', '15 MB', 3, 'ST02', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(13, 'Standard', '20 MB', 5, 'ST02', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(14, 'Professional', '30 MB', 10, 'ST02', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(15, 'Premium', '50 MB', 20, 'ST02', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(16, 'Business', '100 MB', 30, 'ST02', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(17, 'IT Farm', '200 MB', 50, 'ST02', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(18, 'Startup', '40 MB', 15, 'ST02', '', '', '', '', '', 0, 0, 0, 0, 0, 0),
(19, 'Ultra Fast', '300 MB', 70, 'ST02', '', '', '', '', '', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentid` int(100) NOT NULL,
  `invoiceid` int(100) NOT NULL,
  `transactionid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` float NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payerid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payeremail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payerfname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payerlname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `saleid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `saletime` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentid`, `invoiceid`, `transactionid`, `amount`, `currency`, `method`, `payerid`, `payeremail`, `payerfname`, `payerlname`, `status`, `saleid`, `saletime`) VALUES
(20, 48, 'txn_1C7OXUA4JNh6ZWXnFFn0YeJy', 3.45, 'usd', 'Stripe_4242', 'card_1C7OXRA4JNh6ZWXnkZtY2riK_4242', 'ch_1C7OXTA4JNh6ZWXnY1WFRF0x', 'ch_1C7OXTA4JNh6ZWXnY1WFRF0x', 'ch_1C7OXTA4JNh6ZWXnY1WFRF0x', 'Paid', 'ch_1C7OXTA4JNh6ZWXnY1WFRF0x', '1970-01-01'),
(23, 52, 'N/A', 3.45, 'USD', 'Cash', '', 'Hand To Hand', '', '', 'Paid', '', ''),
(26, 52, 'txn_1C93UoA4JNh6ZWXnoBy5D9PZ', 3.45, 'USD', 'Stripe_4242', 'card_1C93UlA4JNh6ZWXn1XZRBn5M_4242', 'ch_1C93UoA4JNh6ZWXnUqiWVDE9', 'ch_1C93UoA4JNh6ZWXnUqiWVDE9', 'ch_1C93UoA4JNh6ZWXnUqiWVDE9', 'Paid', 'ch_1C93UoA4JNh6ZWXnUqiWVDE9', '1521863806'),
(27, 53, 'txn_1C93c6A4JNh6ZWXnJiZyrW3B', 3.45, 'USD', 'Stripe_4242', 'card_1C93c4A4JNh6ZWXncDFdDc0s_4242', 'ch_1C93c6A4JNh6ZWXn1ZtIqp7u', 'ch_1C93c6A4JNh6ZWXn1ZtIqp7u', 'ch_1C93c6A4JNh6ZWXn1ZtIqp7u', 'Paid', 'ch_1C93c6A4JNh6ZWXn1ZtIqp7u', '2018-03-24'),
(28, 54, 'N/A', 2.5, 'USD', 'Cash', '', 'Hand To Hand', '', '', 'Paid', '', '2018-03-24'),
(29, 58, 'N/A', 5, 'USD', 'Cash', '', 'Hand To Hand', '', '', 'Paid', '', '2018-03-25'),
(30, 65, 'N/A', 5, 'USD', 'Cash', '', 'Don', '', '', 'Paid', '', '2018-03-25'),
(31, 64, 'txn_1C9SuXA4JNh6ZWXnSAJs0VhE', 3.45, 'USD', 'Stripe_4242', 'card_1C9SuVA4JNh6ZWXnWHeYZC8P_4242', 'ch_1C9SuXA4JNh6ZWXna3PbnHcY', 'ch_1C9SuXA4JNh6ZWXna3PbnHcY', 'ch_1C9SuXA4JNh6ZWXna3PbnHcY', 'Paid', 'ch_1C9SuXA4JNh6ZWXna3PbnHcY', '2018-03-25'),
(32, 63, 'txn_1C9SxBA4JNh6ZWXnHjZrNKJC', 3.45, 'USD', 'Stripe_4242', 'card_1C9Sx9A4JNh6ZWXn7Li9GvLG_4242', 'ch_1C9SxBA4JNh6ZWXnTTKoL6D2', 'ch_1C9SxBA4JNh6ZWXnTTKoL6D2', 'ch_1C9SxBA4JNh6ZWXnTTKoL6D2', 'Paid', 'ch_1C9SxBA4JNh6ZWXnTTKoL6D2', '2018-03-25'),
(33, 61, 'N/A', 10, 'USD', 'Cash', '', 'Office', '', '', 'Paid', '', '2018-03-25'),
(34, 62, 'N/A', 5, 'USD', 'Cash', '', 'Office', '', '', 'Paid', '', '2018-03-25'),
(35, 60, 'N/A', 10, 'USD', 'Cash', '', 'Office', '', '', 'Paid', '', '2018-03-25'),
(36, 93, 'N/A', 10, 'USD', 'Cash', '', 'Office', '', '', 'Paid', '', '2018-03-25'),
(37, 111, 'N/A', 10, 'USD', 'Cash', '', 'Office', '', '', 'Paid', '', '2018-03-25'),
(38, 107, 'txn_1C9aQZA4JNh6ZWXnRF0imqbW', 3.45, 'USD', 'Stripe_4242', 'card_1C9aQWA4JNh6ZWXnJbftwcKF_4242', 'ch_1C9aQZA4JNh6ZWXn9O3w35S2', 'ch_1C9aQZA4JNh6ZWXn9O3w35S2', 'ch_1C9aQZA4JNh6ZWXn9O3w35S2', 'Paid', 'ch_1C9aQZA4JNh6ZWXn9O3w35S2', '2018-03-25'),
(39, 126, 'txn_1CABzXA4JNh6ZWXnRzhQmInc', 3.45, 'USD', 'Stripe_4242', 'card_1CABzUA4JNh6ZWXnd2ocQyEy_4242', 'ch_1CABzWA4JNh6ZWXnNGqgbjZh', 'ch_1CABzWA4JNh6ZWXnNGqgbjZh', 'ch_1CABzWA4JNh6ZWXnNGqgbjZh', 'Paid', 'ch_1CABzWA4JNh6ZWXnNGqgbjZh', '2018-03-27'),
(40, 125, 'txn_1CAIYOA4JNh6ZWXnH5zPfWq8', 3.45, 'USD', 'Stripe_4242', 'card_1CAIYKA4JNh6ZWXnL3J1uhRe_4242', 'ch_1CAIYOA4JNh6ZWXntRz3UR56', 'ch_1CAIYOA4JNh6ZWXntRz3UR56', 'ch_1CAIYOA4JNh6ZWXntRz3UR56', 'Paid', 'ch_1CAIYOA4JNh6ZWXntRz3UR56', '2018-03-27'),
(41, 127, 'txn_1CB0GAA4JNh6ZWXn5XWeMTT1', 13.8, 'USD', 'Stripe_4242', 'card_1CB0G5A4JNh6ZWXnK5BdUPBx_4242', 'ch_1CB0GAA4JNh6ZWXn6rwTb1h2', 'ch_1CB0GAA4JNh6ZWXn6rwTb1h2', 'ch_1CB0GAA4JNh6ZWXn6rwTb1h2', 'Paid', 'ch_1CB0GAA4JNh6ZWXn6rwTb1h2', '2018-03-29');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(100) NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `favicon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slogan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paymentmethod` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paymentacc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vat` float NOT NULL,
  `smsapi` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emailapi` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `smsonbills` int(11) NOT NULL,
  `emailonbills` int(11) NOT NULL,
  `mkipadd` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mkuser` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mkpassword` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `copyright` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kenadekha` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `favicon`, `name`, `slogan`, `mobile`, `email`, `currency`, `paymentmethod`, `paymentacc`, `vat`, `smsapi`, `emailapi`, `smsonbills`, `emailonbills`, `mkipadd`, `mkuser`, `mkpassword`, `address`, `city`, `country`, `zip`, `location`, `copyright`, `kenadekha`) VALUES
(1, '20181107_055321_241543.png', '20181107_055321_241543.png', 'Zal - ISP Management System', 'Easy, Clean and Simple', '00000000000', 'support@zal.com', 'USD', 'Paypal', 'support@zal.com', 15, 'Nexmo', 'Mailgun', 1, 1, '192.168.0.3', 'admin', '', '1634 Sussex Court', 'TX', 'USA', '76566', '', 'Copyright @ 2018', '');

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `smsid` int(11) NOT NULL,
  `time` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `to` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `messageid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `remainingbalance` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `messageprice` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `network` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(255) NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `photo`, `name`, `mobile`, `area`) VALUES
(5, '20180322_042702_967493.jpeg', 'John Smith', '714-579-8533', 'Mayfair'),
(6, '20180322_042702_967493.jpeg', 'John Doe', '714-579-8533', '');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticketID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `ticketdate` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `adminID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketID`, `userID`, `title`, `description`, `ticketdate`, `status`, `adminID`) VALUES
(1, 340, 'Net Connection is very slow 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2018-08-13 10:07:57', 'Closed', 0),
(2, 340, 'Net Connection is very slow', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2018-08-15 11:02:15', 'Closed', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticketcomment`
--

CREATE TABLE `ticketcomment` (
  `commentID` int(11) NOT NULL,
  `ticketID` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `commentdate` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usertype` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ticketcomment`
--

INSERT INTO `ticketcomment` (`commentID`, `ticketID`, `comment`, `commentdate`, `usertype`) VALUES
(1, 1, 'Hi, we are checking the issue. \r\nThanks for being with us. ', '2018-08-15 10:16:25', ''),
(2, 1, 'Hi, we are checking the issue. \r\nThanks for being with us. ', '2018-08-15 10:17:26', ''),
(3, 1, 'dfsdfsdfsd', '2018-08-15 10:32:46', '1'),
(4, 1, 'dsfsdfsdf', '2018-08-15 10:50:53', '2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `package` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `staff` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `advance` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `pppoe_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pppoe_password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pppoe_service` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pppoe_profile` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hotspot_server` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hotspot_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hotspot_pass` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hotspot_profile` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `photo`, `name`, `mobile`, `package`, `area`, `staff`, `amount`, `user_id`, `password`, `join_date`, `advance`, `email`, `pass`, `location`, `role`, `status`, `pppoe_name`, `pppoe_password`, `pppoe_service`, `pppoe_profile`, `hotspot_server`, `hotspot_name`, `hotspot_pass`, `hotspot_profile`) VALUES
(361, '20181107_055631_867452.png', 'Paul Shen', '000', '12', 'Mayfair', '5', ' ', 'shen', '123456', '2018-11-07', ' ', 'shen@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'London', 'User', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(360, '', 'Simon Doe', '1726562944', '13', 'St. James\'s', '5', ' ', 'admin', '123456', '2018-11-07', ' ', 'user@site.com', 'e10adc3949ba59abbe56e057f20f883e', 'Dhaka', 'User', 'Pending', 'simon', '123456', 'pppoe', 'default', NULL, NULL, NULL, NULL),
(359, '20181106_080942_811237.jpeg', 'John Doe', '1726562944', '12', 'Mayfair', '6', ' ', 'admin', '123456', '2018-11-07', ' ', 'admin@site.com', 'ab106ad07f4f3b1af478e0d08af191e3', 'Dhaka', 'Admin', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`billid`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`emailID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceID`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`packid`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`smsid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketID`);

--
-- Indexes for table `ticketcomment`
--
ALTER TABLE `ticketcomment`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `billid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `emailID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `packid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `smsid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticketcomment`
--
ALTER TABLE `ticketcomment`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=364;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
