-- Database: Liga Solidaria Storage

CREATE DATABASE `liga`;

CREATE TABLE `user` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(40) NOT NULL,
    `password` varchar(40) NOT NULL,
    `email` varchar(100) NOT NULL,
    `group_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `group` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `group` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(45) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSE=utf8;
