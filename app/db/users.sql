-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 22, 2020 at 09:50 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `lds`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` tinyint(7) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address_id` tinyint(7) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `personal_id` varchar(20) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dl_issued_date` datetime DEFAULT NULL,
  `dl_expire_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `address_id`, `email`, `role`, `username`, `password`, `phone_number`, `personal_id`, `last_update`, `dl_issued_date`, `dl_expire_date`) VALUES
(1, NULL, NULL, NULL, 'santari33@gmail.com', NULL, 'alex', '$2y$10$GzCUD4xDIsc/Sjz6nNo7FOIWTWUvjKA22rirYHMzrWyXhkrMoOYZe', NULL, NULL, '2020-03-19 19:09:49', NULL, NULL),
(2, NULL, NULL, NULL, 'jenny.maunonen@gmail.com', NULL, 'jenny', '$2y$10$s8WlTzFXOzo7gdw9gLQ64./XVneAlZy2nzWALJ4zOzuOE2KzWOH2a', NULL, NULL, '2020-03-19 21:35:02', NULL, NULL),
(3, NULL, NULL, NULL, 'santari@mail.ru', NULL, 'sendgrid', '$2y$10$C2FxlD0t33Ac28uySEh4.eUTePWlvLKdzc2ftbfxnLHFiv0Ie82qi', NULL, NULL, '2020-03-22 21:24:30', NULL, NULL),
(4, NULL, NULL, NULL, 'santari1@mail.ru', NULL, 'sendgrid', '$2y$10$pn8n9.emuFiuWuORHZdSBeOZGmxOEs0EBdb3Y5vlPSXELDMB2QtI2', NULL, NULL, '2020-03-22 21:26:03', NULL, NULL),
(5, NULL, NULL, NULL, 'santari2@mail.ru', NULL, 'sendgrid', '$2y$10$xWQuwn3h/PndhSdZVS39Cu9CYcYEUOxtB73vSP7rSv4SSMHqSnra6', NULL, NULL, '2020-03-22 21:29:46', NULL, NULL),
(6, NULL, NULL, NULL, '1santari33@mail.ru', NULL, 'jenny', '$2y$10$2SJ9W7QRLg5.EppBHVwlbehlKleYwBGHXNy8FbzqCIOMEsYLXon5q', NULL, NULL, '2020-03-22 21:32:02', NULL, NULL),
(7, NULL, NULL, NULL, 'cdsantari2@mail.ru', NULL, 'alex', '$2y$10$9bgYFhDKwkzFZe2NVjqEBul6tLYvoZzCyCNapuUqT1g5/jEmgGTLS', NULL, NULL, '2020-03-22 21:36:26', NULL, NULL),
(8, NULL, NULL, NULL, '8978santari33@gmail.com', NULL, 'sffsvsfd', '$2y$10$bma0/fXnJkR06ydqbuBw2uYiPtvceXkgSAA0zUu4n396mUhLgwvF.', NULL, NULL, '2020-03-22 21:38:09', NULL, NULL),
(9, NULL, NULL, NULL, '09809santari1@mail.ru', NULL, 'dajvnkdsb', '$2y$10$87L/0hujdKfGktIfZwgg3OvyvUrWliatY8.JriIBGY5/E/PBcZO5q', NULL, NULL, '2020-03-22 21:39:30', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` tinyint(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
