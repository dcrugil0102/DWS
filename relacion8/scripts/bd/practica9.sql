-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         12.1.2-MariaDB - MariaDB Server
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para practica9
CREATE DATABASE IF NOT EXISTS `practica9` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci */;
USE `practica9`;

-- Volcando estructura para tabla practica9.acl_roles
CREATE TABLE IF NOT EXISTS `acl_roles` (
  `cod_acl_role` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `perm1` tinyint(1) NOT NULL DEFAULT 0,
  `perm2` tinyint(1) NOT NULL DEFAULT 0,
  `perm3` tinyint(1) NOT NULL DEFAULT 0,
  `perm4` tinyint(1) NOT NULL DEFAULT 0,
  `perm5` tinyint(1) NOT NULL DEFAULT 0,
  `perm6` tinyint(1) NOT NULL DEFAULT 0,
  `perm7` tinyint(1) NOT NULL DEFAULT 0,
  `perm8` tinyint(1) NOT NULL DEFAULT 0,
  `perm9` tinyint(1) NOT NULL DEFAULT 0,
  `perm10` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`cod_acl_role`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- Volcando datos para la tabla practica9.acl_roles: ~2 rows (aproximadamente)
DELETE FROM `acl_roles`;
INSERT INTO `acl_roles` (`cod_acl_role`, `nombre`, `perm1`, `perm2`, `perm3`, `perm4`, `perm5`, `perm6`, `perm7`, `perm8`, `perm9`, `perm10`) VALUES
	(3, 'administradores', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
	(4, 'normales', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0);

-- Volcando estructura para tabla practica9.acl_usuarios
CREATE TABLE IF NOT EXISTS `acl_usuarios` (
  `cod_acl_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL DEFAULT '',
  `contrasenia` varchar(64) NOT NULL,
  `cod_acl_role` int(11) NOT NULL,
  `borrado` tinyint(1) NOT NULL,
  PRIMARY KEY (`cod_acl_usuario`),
  UNIQUE KEY `uq_acl_roles_1` (`nick`),
  KEY `cod_acl_role` (`cod_acl_role`),
  CONSTRAINT `fk_acl_roles_1` FOREIGN KEY (`cod_acl_role`) REFERENCES `acl_roles` (`cod_acl_role`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- Volcando datos para la tabla practica9.acl_usuarios: ~1 rows (aproximadamente)
DELETE FROM `acl_usuarios`;
INSERT INTO `acl_usuarios` (`cod_acl_usuario`, `nick`, `nombre`, `contrasenia`, `cod_acl_role`, `borrado`) VALUES
	(2, 'damian', 'Damian', 'd033e22ae348aeb5660fc2140aec35850c4da997', 3, 0);

-- Volcando estructura para tabla practica9.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `cod_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nif` varchar(10) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `poblacion` varchar(30) NOT NULL,
  `provincia` varchar(30) NOT NULL,
  `CP` varchar(5) NOT NULL DEFAULT '00000',
  `fecha_nacimiento` date NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT 0,
  `foto` varchar(50) NOT NULL,
  PRIMARY KEY (`cod_usuario`),
  UNIQUE KEY `nick` (`nick`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

-- Volcando datos para la tabla practica9.usuarios: ~1 rows (aproximadamente)
DELETE FROM `usuarios`;
INSERT INTO `usuarios` (`cod_usuario`, `nick`, `nombre`, `nif`, `direccion`, `poblacion`, `provincia`, `CP`, `fecha_nacimiento`, `borrado`, `foto`) VALUES
	(2, 'damian', 'Damian', '26791215X', 'Calle Alhambra de Granada', 'Antequera', 'Malaga', '29200', '2006-02-01', 0, 'damian.jpeg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
