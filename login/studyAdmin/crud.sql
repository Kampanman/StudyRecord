-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `crud`
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `studyrecords` (
    id INT NOT NULL AUTO_INCREMENT,
    studiedname VARCHAR(255)  NOT NULL,
    category VARCHAR(60)  NULL,
    level INT NULL,
    laststudied VARCHAR(30)  NULL, 
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

ALTER TABLE `studyrecords`
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT for table `studyrecords`
ALTER TABLE `studyrecords`
  MODIFY `id` int(11) NOT NULL;

SET @i := 0;
UPDATE `schedule` SET `id` = (@i := @i +1);
  
