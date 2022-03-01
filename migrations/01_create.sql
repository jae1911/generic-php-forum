CREATE DATABASE IF NOT EXISTS `forum`;

USE `forum`;

CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL auto_increment,
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `signup_date` datetime NOT NULL,
    `last_login` datetime NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `posts` (
    `id` int(11) NOT NULL auto_increment,
    `title` varchar(255) NOT NULL,
    `content` text NOT NULL,
    `poster` int(11),
    PRIMARY KEY (`id`),
    FOREIGN KEY (`poster`) REFERENCES users(`id`)
);
