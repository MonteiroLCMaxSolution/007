-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           10.4.21-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para max_comanda
CREATE DATABASE IF NOT EXISTS `max_comanda` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `max_comanda`;

-- Copiando estrutura para tabela max_comanda.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '0',
  `user_register` int(11) NOT NULL DEFAULT 0,
  `date_register` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela max_comanda.category: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Copiando estrutura para tabela max_comanda.client
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `surname` varchar(255) NOT NULL DEFAULT '0',
  `CPF` varchar(255) NOT NULL DEFAULT '0',
  `birthday` date DEFAULT NULL,
  `phone` varchar(255) NOT NULL DEFAULT '0',
  `email` varchar(255) DEFAULT '0',
  `date_register` datetime NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '',
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela max_comanda.client: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
/*!40000 ALTER TABLE `client` ENABLE KEYS */;

-- Copiando estrutura para tabela max_comanda.client_delivery_address
CREATE TABLE IF NOT EXISTS `client_delivery_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL DEFAULT 0,
  `CEP` varchar(255) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL DEFAULT '0',
  `number` varchar(255) NOT NULL DEFAULT '0',
  `neighborhood` varchar(255) NOT NULL DEFAULT '0',
  `complement` varchar(255) DEFAULT '0',
  `city` varchar(255) NOT NULL DEFAULT '0',
  `UF` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela max_comanda.client_delivery_address: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `client_delivery_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_delivery_address` ENABLE KEYS */;

-- Copiando estrutura para tabela max_comanda.location_product
CREATE TABLE IF NOT EXISTS `location_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela max_comanda.location_product: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `location_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `location_product` ENABLE KEYS */;

-- Copiando estrutura para tabela max_comanda.order
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL DEFAULT '0',
  `client_id` int(11) DEFAULT 0,
  `order_sheet_id` int(11) DEFAULT 0,
  `table_id` int(11) DEFAULT 0,
  `delivery_address_id` int(11) DEFAULT 0,
  `delivery_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela max_comanda.order: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;

-- Copiando estrutura para tabela max_comanda.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `unitary_value` double NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `discount` double unsigned zerofill NOT NULL DEFAULT 0000000000000000000000,
  `kitchen_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela max_comanda.order_items: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;

-- Copiando estrutura para tabela max_comanda.order_sheet
CREATE TABLE IF NOT EXISTS `order_sheet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL DEFAULT 0,
  `sha1` varchar(255) NOT NULL DEFAULT '0',
  `user_register` int(11) NOT NULL DEFAULT 0,
  `date_register` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela max_comanda.order_sheet: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `order_sheet` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_sheet` ENABLE KEYS */;

-- Copiando estrutura para tabela max_comanda.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `sale_value` double NOT NULL DEFAULT 0,
  `cost_value` double DEFAULT 0,
  `quantity` int(11) DEFAULT NULL,
  `minimum_stock` int(11) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `EAN` varchar(255) DEFAULT NULL,
  `local_menu` varchar(255) DEFAULT NULL,
  `online_menu` varchar(255) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `user_register` int(11) DEFAULT NULL,
  `date_register` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela max_comanda.product: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Copiando estrutura para tabela max_comanda.promotion
CREATE TABLE IF NOT EXISTS `promotion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `company_id` int(11) NOT NULL DEFAULT 0,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `value` double NOT NULL DEFAULT 0,
  `user_register` int(11) NOT NULL DEFAULT 0,
  `date_register` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela max_comanda.promotion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `promotion` DISABLE KEYS */;
/*!40000 ALTER TABLE `promotion` ENABLE KEYS */;

-- Copiando estrutura para tabela max_comanda.subcategory
CREATE TABLE IF NOT EXISTS `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '0',
  `user_register` int(11) NOT NULL DEFAULT 0,
  `date_register` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela max_comanda.subcategory: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `subcategory` DISABLE KEYS */;
/*!40000 ALTER TABLE `subcategory` ENABLE KEYS */;

-- Copiando estrutura para tabela max_comanda.table
CREATE TABLE IF NOT EXISTS `table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL DEFAULT 0,
  `sha1` varchar(255) NOT NULL DEFAULT '0',
  `map_id` int(11) DEFAULT 0,
  `user_register` int(11) NOT NULL DEFAULT 0,
  `date_register` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela max_comanda.table: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `table` DISABLE KEYS */;
/*!40000 ALTER TABLE `table` ENABLE KEYS */;

-- Copiando estrutura para tabela max_comanda.table_map
CREATE TABLE IF NOT EXISTS `table_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL DEFAULT 0,
  `floor` varchar(255) DEFAULT '0',
  `sector` varchar(255) DEFAULT '0',
  `side` varchar(255) DEFAULT '0',
  `user_register` int(11) NOT NULL DEFAULT 0,
  `date_register` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela max_comanda.table_map: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `table_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `table_map` ENABLE KEYS */;

-- Copiando estrutura para tabela max_comanda.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `surname` varchar(255) DEFAULT '0',
  `CPF` varchar(255) NOT NULL DEFAULT '0',
  `CEP` varchar(255) DEFAULT '0',
  `address` varchar(255) DEFAULT '0',
  `number` varchar(255) DEFAULT '0',
  `complement` varchar(255) DEFAULT '0',
  `neighborhood` varchar(255) DEFAULT '0',
  `city` varchar(255) DEFAULT '0',
  `UF` varchar(255) DEFAULT '0',
  `phone` varchar(255) DEFAULT '0',
  `profile` varchar(255) DEFAULT '0',
  `wage` double DEFAULT NULL,
  `comission` double DEFAULT NULL,
  `payday` int(11) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admission_date` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `resignation_date` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `CNH` varchar(255) DEFAULT NULL,
  `CNH_expiration` date DEFAULT NULL,
  `vehicle_license_plate` varchar(255) DEFAULT NULL,
  `vehicle_owner` varchar(255) DEFAULT NULL,
  `km_value_traveled` double DEFAULT NULL,
  `comission_status` varchar(255) DEFAULT NULL,
  `user_register` int(11) DEFAULT NULL,
  `date_register` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `number_access` int(11) DEFAULT NULL,
  `last_access` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela max_comanda.user: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
