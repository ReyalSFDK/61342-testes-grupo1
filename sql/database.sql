
-- phpMyAdmin SQL Dump
-- version 4.1.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 26, 2017 at 06:39 PM
-- Server version: 5.1.67-andiunpam
-- PHP Version: 5.6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-03:00";

CREATE TABLE `collectors` (
    `registration` INT(99) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `fullName` VARCHAR(60) NOT NULL,
    `birthDay` DATETIME NOT NULL,
    `phone` VARCHAR(11) NOT NULL,
    `email` VARCHAR(30) NOT NULL UNIQUE,
    `cpf` VARCHAR(11) NOT NULL UNIQUE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;