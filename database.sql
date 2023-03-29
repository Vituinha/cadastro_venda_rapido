CREATE DATABASE `senioridade` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id do produto',
  `descricao` varchar(100) DEFAULT NULL COMMENT 'Descrição/Nome',
  `observacao` varchar(100) DEFAULT NULL COMMENT 'Observação do produto',
  `fotos` text DEFAULT NULL COMMENT 'Fotos serializadas',
  `valor_venda` decimal(8,2) DEFAULT NULL COMMENT 'Valor de venda',
  `estoque` decimal(8,2) DEFAULT NULL COMMENT 'Estoque inicial/atual',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- senioridade.vendas definition
CREATE TABLE `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id da venda',
  `valor` decimal(8,4) DEFAULT NULL COMMENT 'Valor total da venda',
  `cliente` varchar(100) DEFAULT NULL COMMENT 'Cliente relacionado a venda',
  `data_cadastro` date DEFAULT NULL COMMENT 'Data de criação da venda',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- senioridade.venda_item definition
CREATE TABLE `venda_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id do pedidos - item',
  `id_produto` int(11) DEFAULT NULL COMMENT 'Id do produto relacionado ao pedido',
  `id_pedido` int(11) DEFAULT NULL COMMENT 'Id do pedido relacionado ao item',
  `valor_item` decimal(8,4) DEFAULT NULL COMMENT 'Valor do produto adicionado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
