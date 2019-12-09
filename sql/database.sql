
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
    `birthDay` DATE NOT NULL,
    `phone` VARCHAR(11) NOT NULL,
    `email` VARCHAR(30) NOT NULL UNIQUE,
    `cpf` VARCHAR(11) NOT NULL UNIQUE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Adiciona dados na tabela `collectors`
--

INSERT INTO `collectors` (`registration`, `fullName`, `birthDay`, `phone`, `email`, `cpf`) VALUES
(1, 'Rayssa Ayla da Paz', '2000-06-26', '83986898919', 'rayssaay@jerasistemas.com.br', '11284495876'),
(2, 'AndrÃ© Carlos Eduardo', '1957-10-21', '31985341216', 'henrysales@pib.com.br', '48763624168'),
(3, 'Carlos Eduardo Augusto', '1982-12-07', '2137719410', 'porto@salvadorlogistica.com', '60507423321'),
(4, 'Bryan Yuri Melo', '1960-01-13', '6939111653', 'bbryanyurimelo@alcoa.com.br', '92133668330'),
(5, 'Yago Caleb Rezende', '1995-09-14', '14991701931', 'calebrezende@eletrovip.com', '71686549180'),
(6, 'Marlene Eduarda Barbosa', '1949-09-22', '8226422726', 'barbosa@grupoannaprado.com.br', '65308852936'),
(7, 'Stella Alice Alves', '1956-06-07', '9537249059', 'stellaalicealves@lvnonline.com', '83582083675');
