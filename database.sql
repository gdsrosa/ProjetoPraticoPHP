CREATE DATABASE  IF NOT EXISTS `praticophp` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `praticophp`;

CREATE TABLE `contatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `endereco` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

CREATE TABLE `telefone_contatos` (
  `telefone` int(11) DEFAULT NULL,
  `contato_id` int(11) DEFAULT NULL,
  KEY `contato_id` (`contato_id`),
  CONSTRAINT `telefone_contatos_ibfk_1` FOREIGN KEY (`contato_id`) REFERENCES `contatos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

CREATE TABLE `usuarios_contatos` (
  `usuario_id` int(11) DEFAULT NULL,
  `contato_id` int(11) DEFAULT NULL,
  KEY `contato_id` (`contato_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `usuarios_contatos_ibfk_1` FOREIGN KEY (`contato_id`) REFERENCES `contatos` (`id`),
  CONSTRAINT `usuarios_contatos_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;