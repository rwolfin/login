sql
CREATE DATABASE IF NOT EXISTS `auth_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `auth_db`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('regular','vk') NOT NULL DEFAULT 'regular',
  `email` varchar(100) DEFAULT NULL,
  `vk_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `vk_user_id` (`vk_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;