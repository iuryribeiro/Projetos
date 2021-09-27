-- Copiando estrutura do banco de dados para bem
CREATE DATABASE IF NOT EXISTS `bem` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bem`;

-- Copiando estrutura para tabela bem.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `document` char(20) DEFAULT NULL,
  `rg` char(20) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `code` char(20) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `uf` varchar(50) DEFAULT NULL,
  `observation` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando estrutura para tabela bem.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `client_origem` varchar(255) NOT NULL,
  `street_origem` varchar(255) NOT NULL,
  `code_origem` varchar(255) NOT NULL,
  `tel_origem` varchar(255) NOT NULL,
  `uf_origem` varchar(255) NOT NULL,
  `city_origem` varchar(255) NOT NULL,
  `email_origem` varchar(255) NOT NULL,
  `client_dest` varchar(255) NOT NULL,
  `street_dest` varchar(255) NOT NULL,
  `code_dest` char(20) NOT NULL,
  `city_dest` varchar(255) NOT NULL,
  `tel_dest` char(20) NOT NULL,
  `uf_dest` char(50) NOT NULL,
  `email_dest` varchar(255) NOT NULL,
  `value_transp` float DEFAULT NULL,
  `collection` float DEFAULT NULL,
  `material` float DEFAULT NULL,
  `excess_weight` float DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `value_safe` float DEFAULT NULL,
  `percentage` float DEFAULT NULL,
  `total` float NOT NULL,
  `payment` varchar(100) NOT NULL DEFAULT '',
  `number_check` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando estrutura para tabela bem.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `box_size` char(1) DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `value` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando estrutura para tabela bem.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
