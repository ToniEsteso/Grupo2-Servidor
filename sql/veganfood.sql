-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         10.4.6-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.3.0.5771
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
  `icono` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla veganfood.categorias: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `nombre`, `icono`) VALUES
	(1, 'Carnes', 'fas fa-drumstick-bite'),
	(4, 'Bebidas', 'fas fa-coffee'),
	(5, 'Frutas', 'fas fa-apple-alt');
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

-- Volcando estructura para tabla veganfood.imagenescarouselpromocion
CREATE TABLE IF NOT EXISTS `imagenescarouselpromocion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `extension` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla veganfood.imagenescarouselpromocion: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `imagenescarouselpromocion` DISABLE KEYS */;
INSERT INTO `imagenescarouselpromocion` (`id`, `nombre`, `extension`) VALUES
	(1, 'carousel1', 'jpg'),
	(2, 'carousel2', 'jpg'),
	(3, 'carousel3', 'jpg');
/*!40000 ALTER TABLE `imagenescarouselpromocion` ENABLE KEYS */;

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
  `categoria` varchar(40) NOT NULL,
  `precio` float(5,2) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `imagen` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla veganfood.productos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`id`, `nombre`, `categoria`, `precio`, `descripcion`, `imagen`) VALUES
	(1, 'pechuga', '', 0.00, 'pechugota de carne autentica', 'imagen'),
	(2, 'entrecot', '', 0.00, 'entrecot que ha salido de matar a muchos animales', 'muerte');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla veganfood.productos_categorias
CREATE TABLE IF NOT EXISTS `productos_categorias` (
  `idProducto` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idProducto`,`idCategoria`),
  KEY `fk_productos_categorias2` (`idCategoria`),
  CONSTRAINT `fk_productos_categorias1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_productos_categorias2` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla veganfood.productos_categorias: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `productos_categorias` DISABLE KEYS */;
INSERT INTO `productos_categorias` (`idProducto`, `idCategoria`) VALUES
	(1, 1),
	(2, 1);
/*!40000 ALTER TABLE `productos_categorias` ENABLE KEYS */;

-- Volcando estructura para tabla veganfood.redessociales
CREATE TABLE IF NOT EXISTS `redessociales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL DEFAULT '0',
  `enlace` varchar(250) NOT NULL DEFAULT '0',
  `icono` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla veganfood.redessociales: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `redessociales` DISABLE KEYS */;
INSERT INTO `redessociales` (`id`, `nombre`, `enlace`, `icono`) VALUES
	(1, 'Twitter', '#', 'fab fa-twitter'),
	(2, 'Facebook', '#', 'fab fa-facebook-f'),
	(3, 'Instagram', '#', 'fab fa-instagram');
/*!40000 ALTER TABLE `redessociales` ENABLE KEYS */;

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
