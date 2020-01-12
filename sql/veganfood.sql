-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.6-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para veganfood
CREATE DATABASE IF NOT EXISTS `veganfood` /*!40100 DEFAULT CHARACTER SET latin1 */;
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
	(2, 'Bebidas', 'fas fa-coffee'),
	(3, 'Frutas', 'fas fa-apple-alt');
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
  `precio` float(5,2) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `imagen` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla veganfood.productos: ~20 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`id`, `nombre`, `precio`, `descripcion`, `imagen`) VALUES
	(1, 'Pechuga de Pavo', 3.00, 'Pechuga de pavo sin grasa', 'pechugaPavo.jpg'),
	(2, 'Pechuga de Pollo', 5.00, 'Pechuga de pollo casi sin grasa', 'pechugaPollo.jpg'),
	(3, 'Lomo de Cerdo', 4.00, 'Excelente lomo de cerdo para comer en plato o bocadillo', 'lomoCerdo.jpg'),
	(4, 'Ternera Gallega', 7.00, 'Sabrosisimos filetes de ternera gallega', 'terneraGallega.jpg'),
	(5, 'Entrecot de Vaca', 9.00, 'Jugoso entrecot de vaca, alimentada con lagrimas de veganos', 'entrecotVaca.jpg'),
	(6, 'Agua Mineral', 0.50, 'Agua mineral sin sabor', 'aguaMineral.jpg'),
	(7, 'Coca-Cola', 1.00, 'Coca-Cola Original con medio kg de azucar por lata', 'cocacola.jpg'),
	(8, 'Zumo de Naranja', 1.50, 'Zumo de naranja natural con pulpa', 'zumoNaranja.jpg'),
	(9, 'Leche Entera', 1.00, 'Leche entera de vaca asturiana', 'lecheEntera.jpg'),
	(10, 'Aquarius', 2.00, 'Posiblemente el peor refresco ever', 'aquarius.jpg'),
	(11, 'Platano', 1.00, 'Platanos de canarias', 'platano.jpg'),
	(12, 'Manzana', 1.00, 'Manzanas del eden', 'manzana.jpg'),
	(13, 'Pera', 1.00, 'Pera clasicas de toda la vida', 'pera.jpg'),
	(14, 'Melocoton', 1.00, 'Melocotones robados por gitanos', 'melocoton.jpg'),
	(15, 'Uva', 1.00, 'Uva rancia y con semillas para nochevieja', 'uva.jpg'),
	(16, 'Sandia', 1.00, 'Sandia de la que comen los niggas', 'sandia.jpg'),
	(17, 'Melon', 1.00, 'Melon de albacete bueno bueno', 'melon.jpg'),
	(18, 'Kiwi', 1.00, 'Kiwi de los que hacen que no cagues', 'kiwi.jpg'),
	(19, 'Naranja', 1.00, 'Naranjas de valencia', 'naranja.jpg'),
	(20, 'Mandarina', 1.00, 'Son como naranjas pero con enanismo', 'mandarinas.jpg');
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

-- Volcando datos para la tabla veganfood.productos_categorias: ~20 rows (aproximadamente)
/*!40000 ALTER TABLE `productos_categorias` DISABLE KEYS */;
INSERT INTO `productos_categorias` (`idProducto`, `idCategoria`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 2),
	(7, 2),
	(8, 2),
	(9, 2),
	(10, 2),
	(11, 3),
	(12, 3),
	(13, 3),
	(14, 3),
	(15, 3),
	(16, 3),
	(17, 3),
	(18, 3),
	(19, 3),
	(20, 3);
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
	(1, 'Twitter', 'https://www.twitter.com/VeganFoodVLC', 'fab fa-twitter'),
	(2, 'Facebook', 'https://www.facebook.com/Veganfoodvlc-107226347474951/', 'fab fa-facebook-f'),
	(3, 'Instagram', 'https://www.instagram.com/vlcveganfood/?hl=es', 'fab fa-instagram');
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
