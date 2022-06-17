-- --------------------------------------------------------
-- Servidor:                     200.234.194.69
-- Versão do servidor:           5.6.51-log - MySQL Community Server (GPL)
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para maxcoman_max_comanda
CREATE DATABASE IF NOT EXISTS `maxcoman_max_comanda` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `maxcoman_max_comanda`;

-- Copiando estrutura para tabela maxcoman_max_comanda.cards
CREATE TABLE IF NOT EXISTS `cards` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.cashier
CREATE TABLE IF NOT EXISTS `cashier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `id_contract` int(11) NOT NULL,
  `number_cashier` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.cashier_opening
CREATE TABLE IF NOT EXISTS `cashier_opening` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cashier_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `dateTime_close` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL COMMENT 'Abertura ou Fechamento',
  `start_money` double DEFAULT NULL,
  `money` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `debit` double DEFAULT NULL,
  `PIX` double DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sequence` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `id_contract` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '0',
  `user_register` int(11) NOT NULL DEFAULT '0',
  `user_update` int(11) NOT NULL DEFAULT '0',
  `date_register` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.client
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_contract` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `id_sequence` int(11) unsigned NOT NULL,
  `name_razao_social` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `CPF_CNPJ` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `fantasia` varchar(255) NOT NULL,
  `inscricao_municipal` varchar(255) NOT NULL,
  `inscricao_estadual` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_register` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `number_access` int(11) DEFAULT NULL,
  `user_register` int(11) NOT NULL,
  `user_update` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.client_delivery_address
CREATE TABLE IF NOT EXISTS `client_delivery_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `CEP` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `neighborhood` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `complement` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `UF` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `last_update` datetime NOT NULL,
  `order_uniqID` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.company
CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_contract` int(11) NOT NULL,
  `id_sequence` int(11) NOT NULL,
  `name_razao_social` varchar(255) NOT NULL,
  `sha1` varchar(255) NOT NULL,
  `fantasia` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'Inativo' COMMENT 'Fisica ou Juridica',
  `CPF_CNPJ` varchar(255) NOT NULL,
  `inscricao_municipal` varchar(255) NOT NULL,
  `inscricao_estadual` varchar(255) NOT NULL,
  `CEP` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `complement` varchar(255) NOT NULL,
  `neighborhood` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `UF` varchar(255) NOT NULL,
  `ibge` int(11) NOT NULL,
  `site` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `user_register` int(11) NOT NULL,
  `date_register` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `last_update` datetime NOT NULL,
  `logo` varchar(255) NOT NULL,
  `color_header` varchar(255) NOT NULL,
  `color_text` varchar(255) NOT NULL,
  `delivery_status` varchar(255) NOT NULL DEFAULT 'Inativo',
  `delivery_start` time NOT NULL,
  `delivery_end` time NOT NULL,
  `km_delivery` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.company_opening_hours
CREATE TABLE IF NOT EXISTS `company_opening_hours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folder` varchar(255) DEFAULT NULL,
  `sha1` varchar(255) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `open` time DEFAULT NULL,
  `close` time DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date_record` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Horário de funcionamento da empresa';

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.estado
CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(75) DEFAULT NULL,
  `uf` varchar(5) DEFAULT NULL,
  `pais` int(11) DEFAULT NULL,
  `cod_uf` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Estado_pais` (`pais`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.location_product
CREATE TABLE IF NOT EXISTS `location_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '0',
  `user_register` int(11) NOT NULL DEFAULT '0',
  `user_update` int(11) NOT NULL DEFAULT '0',
  `date_register` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_contract` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `action` longtext NOT NULL,
  `IP` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `origin` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5840 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.log_user
CREATE TABLE IF NOT EXISTS `log_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) DEFAULT NULL,
  `id_contract` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `data_register` datetime DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `IP` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=620 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.natureza_grupo_fiscal
CREATE TABLE IF NOT EXISTS `natureza_grupo_fiscal` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cod_grupo_fiscal` int(10) NOT NULL DEFAULT '0',
  `cod_empresa` int(10) DEFAULT NULL,
  `cod_grupo_fiscal_g3` int(10) DEFAULT NULL,
  `descricao_grupo` varchar(255) DEFAULT NULL,
  `mensagem_nfe` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.ncm
CREATE TABLE IF NOT EXISTS `ncm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cest` varchar(7) NOT NULL,
  `ncm` varchar(8) DEFAULT NULL,
  `descricao` varchar(512) DEFAULT NULL,
  `cst_pis_entrada` varchar(512) DEFAULT NULL,
  `cst_cofins_entrada` varchar(512) DEFAULT NULL,
  `cst_pis_saida` varchar(512) DEFAULT NULL,
  `cst_cofins_saida` varchar(512) DEFAULT NULL,
  `pct_pis` double DEFAULT NULL,
  `pct_cofins` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1262 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.nfe_origem_mercadoria
CREATE TABLE IF NOT EXISTS `nfe_origem_mercadoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.nfe_situacao_operacao_ICMS
CREATE TABLE IF NOT EXISTS `nfe_situacao_operacao_ICMS` (
  `id_tb` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(50) DEFAULT NULL,
  `descricao` longtext,
  `selecionada` varchar(50) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `gera_st` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tb`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.nfe_situacao_tribut_COFINS
CREATE TABLE IF NOT EXISTS `nfe_situacao_tribut_COFINS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` longtext,
  `selecionada` varchar(255) DEFAULT '0',
  `status` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.nfe_situacao_tribut_PIS
CREATE TABLE IF NOT EXISTS `nfe_situacao_tribut_PIS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` longtext,
  `selecionada` varchar(255) DEFAULT '0',
  `status` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.nfe_tipo_item
CREATE TABLE IF NOT EXISTS `nfe_tipo_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_item` varchar(50) NOT NULL DEFAULT '0',
  `descricao` longtext,
  `selecionada` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `contract` int(11) DEFAULT NULL,
  `payment_uniqID` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `delivery_address_id` int(11) DEFAULT NULL,
  `delivery_status` varchar(255) DEFAULT NULL,
  `client_cpf_cnpj` varchar(255) DEFAULT NULL COMMENT 'Se o cliente não tiver cadastro',
  `dateTime` datetime NOT NULL,
  `discount` double DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_phone` varchar(255) DEFAULT NULL,
  `order_uniqID` varchar(255) DEFAULT NULL,
  `change_for` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniqID` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `delivery_address_id` int(11) DEFAULT NULL,
  `table_delivery` int(11) DEFAULT NULL COMMENT 'Mesa para Entregar o Item',
  `table_demand` int(11) DEFAULT NULL COMMENT 'Mesa que solicitou o Item',
  `order_sheet_demand` int(11) DEFAULT NULL COMMENT 'Comanda para Cobrança do Item',
  `waiter` int(11) DEFAULT NULL,
  `unitary_value` double DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `discount` double DEFAULT '0',
  `kitchen_status` varchar(255) DEFAULT NULL COMMENT 'status da Cozinha (NULL, Aguardando, Finalizado)',
  `counter_status` varchar(255) DEFAULT NULL COMMENT 'status do Balcão (NULL, Aguardando, Entregue)',
  `status` varchar(255) NOT NULL COMMENT 'Aguardando ou Aguardando Pagamento',
  `cashier_id` int(11) DEFAULT NULL,
  `observation` varchar(255) DEFAULT NULL,
  `dateTime` datetime NOT NULL,
  `company_id` int(11) NOT NULL,
  `contract` int(11) DEFAULT NULL,
  `payment_uniqID` varchar(255) DEFAULT NULL,
  `temp` int(11) DEFAULT '1' COMMENT '1 = liberado pra cobrar, 2  = não liberado pra cobrar',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=347 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.order_items_addition
CREATE TABLE IF NOT EXISTS `order_items_addition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `flavor_id` int(11) DEFAULT NULL,
  `addition_id` int(11) DEFAULT NULL,
  `value` double DEFAULT NULL,
  `order_item_id` int(11) NOT NULL,
  `uniqID` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.order_sheet
CREATE TABLE IF NOT EXISTS `order_sheet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `id_contract` int(11) NOT NULL DEFAULT '0',
  `user_register` int(11) NOT NULL DEFAULT '0',
  `number_order_sheet` int(11) NOT NULL DEFAULT '0',
  `date_register` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.param_payment_type
CREATE TABLE IF NOT EXISTS `param_payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `column_name` varchar(255) NOT NULL COMMENT 'nome da coluna nas tabelas',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.partial_payment
CREATE TABLE IF NOT EXISTS `partial_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `contract` int(11) DEFAULT NULL,
  `order_sheet` int(11) NOT NULL,
  `debit` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `money` double DEFAULT NULL,
  `PIX` double DEFAULT NULL,
  `dateTime` datetime NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.payment
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cashier_id` int(11) DEFAULT NULL,
  `order_sheet_id` int(11) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `payment_uniqID` varchar(255) NOT NULL,
  `credit` double DEFAULT NULL,
  `debit` double DEFAULT NULL,
  `money` double DEFAULT NULL,
  `PIX` double DEFAULT NULL,
  `dateTime` datetime DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.payment_methods
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.permission
CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_profile` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `full_permission` varchar(50) NOT NULL,
  `search` varchar(50) NOT NULL,
  `include` varchar(50) NOT NULL,
  `edit` varchar(50) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=379 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `uniqID` varchar(255) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '0',
  `sale_value` double NOT NULL DEFAULT '0',
  `cost_value` double DEFAULT '0',
  `minimum_stock` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `local_menu` varchar(255) DEFAULT NULL,
  `morning` varchar(255) DEFAULT NULL,
  `afternoon` varchar(255) DEFAULT NULL,
  `night` varchar(255) DEFAULT NULL,
  `defineStock` varchar(255) DEFAULT NULL,
  `online_menu` varchar(255) DEFAULT NULL,
  `kitchen` varchar(255) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `user_register` int(11) DEFAULT NULL,
  `date_register` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `fraction` int(11) NOT NULL DEFAULT '0',
  `unidade` varchar(255) NOT NULL,
  `tipo_uso` varchar(255) NOT NULL,
  `margem` double(20,4) NOT NULL,
  `valor_custo` double(10,3) NOT NULL,
  `sub_custo` double(10,3) NOT NULL,
  `pct_ipi` double(20,4) NOT NULL,
  `pct_st` double(20,4) NOT NULL,
  `valor_st` double(20,4) NOT NULL,
  `pct_frete_nfe` double(20,4) NOT NULL,
  `frete_nfe` double(20,4) NOT NULL,
  `valor_custo_seguro` double(20,4) NOT NULL,
  `pct_financeiro` double(20,4) NOT NULL,
  `pct_cooperado` double(20,4) NOT NULL,
  `valor_custo_outros` double(20,4) NOT NULL,
  `CST_PIS_entrada` varchar(255) NOT NULL DEFAULT '',
  `situacao_tributaria_PIS` varchar(255) NOT NULL DEFAULT '',
  `base_PIS` double(20,4) NOT NULL DEFAULT '0.0000',
  `aliq_PIS` double(20,4) NOT NULL DEFAULT '0.0000',
  `valor_PIS` double(20,4) NOT NULL DEFAULT '0.0000',
  `subs_tributaria_PIS` double(20,4) NOT NULL DEFAULT '0.0000',
  `CST_COFINS_entrada` varchar(255) NOT NULL DEFAULT '0',
  `situacao_tributaria_COFINS` varchar(255) NOT NULL DEFAULT '0',
  `base_COFINS` double(20,4) NOT NULL DEFAULT '0.0000',
  `aliq_COFINS` double(20,4) NOT NULL DEFAULT '0.0000',
  `valor_COFINS` double(20,4) NOT NULL DEFAULT '0.0000',
  `subs_tributaria_COFINS` double(20,4) NOT NULL DEFAULT '0.0000',
  `aliq_icms` double(20,4) NOT NULL DEFAULT '0.0000',
  `bc_st` double(20,4) NOT NULL DEFAULT '0.0000',
  `venda_valor_st` double(20,4) NOT NULL DEFAULT '0.0000',
  `origem_produto` varchar(255) NOT NULL DEFAULT '0',
  `CST` varchar(255) NOT NULL DEFAULT '0',
  `CSON` varchar(255) NOT NULL DEFAULT '0',
  `ean_tributario` varchar(255) NOT NULL DEFAULT '0',
  `cod_grupo_fiscal` int(10) NOT NULL DEFAULT '0',
  `NCM` varchar(255) NOT NULL DEFAULT '0',
  `cest` varchar(255) NOT NULL DEFAULT '0',
  `regime_pis_cofins` varchar(255) NOT NULL DEFAULT '0',
  `natureza_receita` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.product_addition
CREATE TABLE IF NOT EXISTS `product_addition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `value` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.product_flavor
CREATE TABLE IF NOT EXISTS `product_flavor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.product_img
CREATE TABLE IF NOT EXISTS `product_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `main_img` varchar(255) NOT NULL,
  `user_register` int(11) NOT NULL,
  `date_register` datetime NOT NULL,
  `user_update` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.produto_uf
CREATE TABLE IF NOT EXISTS `produto_uf` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cod_empresa` int(10) NOT NULL DEFAULT '0',
  `cod_produto` int(10) NOT NULL DEFAULT '0',
  `uf` varchar(50) NOT NULL DEFAULT '0',
  `saida_pct_icms` double NOT NULL DEFAULT '0',
  `saida_pct_base_calc` double NOT NULL DEFAULT '0',
  `saida_pct_subst_trib` double NOT NULL DEFAULT '0',
  `saida_pct_icms_interno` double NOT NULL DEFAULT '0',
  `saida_pct_red_bc_subs` double NOT NULL DEFAULT '0',
  `saida_pct_red_bc_pond` double NOT NULL DEFAULT '0',
  `entrada_pct_base_calc` double NOT NULL DEFAULT '0',
  `entrada_pct_subst_trib` double NOT NULL DEFAULT '0',
  `entrada_pct_icms` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.profile
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_contract` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_register` int(11) NOT NULL,
  `date_register` datetime NOT NULL,
  `user_update` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.promotion
CREATE TABLE IF NOT EXISTS `promotion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `new_value` double(10,2) NOT NULL DEFAULT '0.00',
  `old_value` double(10,2) NOT NULL DEFAULT '0.00',
  `user_register` int(11) NOT NULL DEFAULT '0',
  `date_register` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.provider
CREATE TABLE IF NOT EXISTS `provider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_razao_social` varchar(255) NOT NULL DEFAULT '0',
  `fantasia` varchar(255) DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT '0' COMMENT 'Fisica ou Juridica',
  `CPF_CNPJ` varchar(255) NOT NULL DEFAULT '0',
  `inscricao_municipal` varchar(255) DEFAULT '0',
  `inscricao_estadual` varchar(255) DEFAULT '0',
  `CEP` varchar(255) NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL DEFAULT '0',
  `number` varchar(255) NOT NULL DEFAULT '0',
  `complement` varchar(255) DEFAULT '0',
  `neighborhood` varchar(255) NOT NULL DEFAULT '0',
  `city` varchar(255) NOT NULL DEFAULT '0',
  `UF` varchar(255) NOT NULL DEFAULT '0',
  `site` varchar(255) DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '0',
  `phone` varchar(255) NOT NULL DEFAULT '0',
  `user_register` int(11) NOT NULL DEFAULT '0',
  `date_register` datetime NOT NULL,
  `user_update` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.stock_adjustment
CREATE TABLE IF NOT EXISTS `stock_adjustment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniqID` varchar(255) NOT NULL DEFAULT '',
  `company_id` int(11) NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `user_register` int(11) NOT NULL,
  `date_register` datetime NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL COMMENT 'Entrada ou Saída',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.subcategory
CREATE TABLE IF NOT EXISTS `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '0',
  `user_register` int(11) NOT NULL DEFAULT '0',
  `user_update` int(11) NOT NULL DEFAULT '0',
  `date_register` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.supply
CREATE TABLE IF NOT EXISTS `supply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `uniqID` varchar(255) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '0',
  `cost_value` double DEFAULT '0',
  `minimum_stock` int(11) DEFAULT NULL,
  `user_register` int(11) DEFAULT NULL,
  `date_register` datetime DEFAULT NULL,
  `user_update` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.tables
CREATE TABLE IF NOT EXISTS `tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `contract` int(11) DEFAULT NULL,
  `map_id` int(11) NOT NULL DEFAULT '0',
  `user_register` int(11) NOT NULL DEFAULT '0',
  `user_update` int(11) DEFAULT '0',
  `date_register` datetime NOT NULL,
  `last_update` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `uniqID` varchar(255) DEFAULT NULL,
  `status_table` varchar(255) DEFAULT 'ABERTO',
  `people` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.table_map
CREATE TABLE IF NOT EXISTS `table_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `floor` varchar(255) DEFAULT '0',
  `sector` varchar(255) DEFAULT '0',
  `side` varchar(255) DEFAULT '0',
  `user_register` int(11) NOT NULL DEFAULT '0',
  `date_register` datetime NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `id_contract` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `folder` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `CPF` varchar(255) NOT NULL,
  `CEP` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `complement` varchar(255) NOT NULL,
  `neighborhood` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `UF` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `profile` int(11) NOT NULL,
  `wage` double NOT NULL,
  `comission` double NOT NULL,
  `payday` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admission_date` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `resignation_date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `key_password` varchar(255) NOT NULL,
  `CNH` varchar(255) NOT NULL,
  `CNH_expiration` date NOT NULL,
  `vehicle_license_plate` varchar(255) NOT NULL,
  `vehicle_owner` varchar(255) NOT NULL,
  `km_value_traveled` double NOT NULL,
  `comission_status` varchar(255) NOT NULL,
  `user_register` int(11) NOT NULL,
  `date_register` datetime NOT NULL,
  `user_update` int(11) NOT NULL,
  `last_update` datetime NOT NULL,
  `number_access` double NOT NULL,
  `last_access` datetime NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_contract` (`id_contract`),
  KEY `login` (`login`(191)),
  KEY `password` (`password`(191)),
  KEY `email` (`email`(191)),
  KEY `folder` (`folder`(191))
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.user_company
CREATE TABLE IF NOT EXISTS `user_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_company` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL COMMENT '"Ativo" ou "Inativo"',
  `folder` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_company` (`id_company`),
  KEY `status` (`status`),
  KEY `folder` (`folder`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela maxcoman_max_comanda.withdraw_money
CREATE TABLE IF NOT EXISTS `withdraw_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cashier_id` int(11) DEFAULT '0',
  `cashier_id_destiny` int(11) DEFAULT '0',
  `value` double NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `payment_uniqID` varchar(255) DEFAULT NULL COMMENT 'Se for retirada para troco, informar o UniqID do pagamento',
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
