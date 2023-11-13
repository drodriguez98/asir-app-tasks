CREATE DATABASE TASKS;

USE TASKS;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `tasks` (
  `taskId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `priority` varchar(50) NOT NULL,
  PRIMARY KEY (`taskId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,  
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tasks` (`taskId`, `name`, `description`, `priority`) VALUES
(1, 'Task 1', 'Create design', 'Medium'),
(2, 'Task 2', 'Add controllers in backend', 'High');

CREATE USER 'tasks'@'localhost' IDENTIFIED BY 'abc123.';
GRANT ALL PRIVILEGES ON *.* TO 'tasks'@'localhost' WITH GRANT OPTION;

FLUSH PRIVILEGES;
COMMIT;