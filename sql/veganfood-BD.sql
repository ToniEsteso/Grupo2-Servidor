-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.8-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para veganfood
CREATE DATABASE IF NOT EXISTS `veganfood` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `veganfood`;

-- Volcando estructura para tabla veganfood.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `tipo` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla veganfood.categorias: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `nombre`, `tipo`) VALUES
	(1, 'Carnes', 'Carnes'),
	(2, 'Lentejas', 'Legumbres'),
	(3, 'Lácteos', 'Lacteos');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla veganfood.direcciones
CREATE TABLE IF NOT EXISTS `direcciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `codigoPostal` int(5) NOT NULL,
  `localidad` varchar(40) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `numero` int(3) NOT NULL,
  `piso` int(3) NOT NULL,
  `escalera` varchar(2) NOT NULL,
  `puerta` int(3) NOT NULL,
  `masInfo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `fk_direcciones_usuarios_id` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla veganfood.direcciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `direcciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `direcciones` ENABLE KEYS */;

-- Volcando estructura para tabla veganfood.imagenescarousel
CREATE TABLE IF NOT EXISTS `imagenescarousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extension` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla veganfood.imagenescarousel: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `imagenescarousel` DISABLE KEYS */;
INSERT INTO `imagenescarousel` (`id`, `extension`) VALUES
	(1, NULL);
/*!40000 ALTER TABLE `imagenescarousel` ENABLE KEYS */;

-- Volcando estructura para tabla veganfood.informacionnutricional
CREATE TABLE IF NOT EXISTS `informacionnutricional` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(3) NOT NULL,
  `medida` varchar(2) NOT NULL,
  `grasasTotales` int(3) NOT NULL,
  `grasasSaturadas` int(3) NOT NULL,
  `grasasMonoInsaturadas` int(3) NOT NULL,
  `grasasPoliInsaturadas` int(3) NOT NULL,
  `hidratosCarbono` int(3) NOT NULL,
  `azucares` int(3) NOT NULL,
  `fibra` int(3) NOT NULL,
  `sal` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idProducto` (`idProducto`),
  CONSTRAINT `fk_informacionnutricional_productos_id` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla veganfood.informacionnutricional: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `informacionnutricional` DISABLE KEYS */;
/*!40000 ALTER TABLE `informacionnutricional` ENABLE KEYS */;

-- Volcando estructura para tabla veganfood.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `imagen` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla veganfood.productos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla veganfood.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `avatar` varchar(30) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickName` (`nickName`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla veganfood.usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
