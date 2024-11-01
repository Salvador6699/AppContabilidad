-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-11-2024 a las 07:43:53
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `contahogar2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balance`
--

DROP TABLE IF EXISTS `balance`;
CREATE TABLE IF NOT EXISTS `balance` (
  `mesBalance` varchar(15) NOT NULL,
  `anoBalance` int NOT NULL,
  `importeBalance` float(7,2) NOT NULL,
  `categorias_nomCategoria` varchar(45) NOT NULL,
  PRIMARY KEY (`mesBalance`,`anoBalance`,`categorias_nomCategoria`),
  KEY `fk_presupuestos_categorias1_idx` (`categorias_nomCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `nomCategoria` varchar(45) NOT NULL,
  `tipoCategoria` varchar(45) NOT NULL,
  PRIMARY KEY (`nomCategoria`,`tipoCategoria`),
  UNIQUE KEY `idcategorias_UNIQUE` (`nomCategoria`),
  UNIQUE KEY `ID_tipo_movimiento` (`nomCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

DROP TABLE IF EXISTS `cuentas`;
CREATE TABLE IF NOT EXISTS `cuentas` (
  `idCuenta` varchar(45) NOT NULL,
  `nomCuenta` varchar(25) NOT NULL,
  `saldoCuenta` float(7,2) DEFAULT NULL,
  `usuarios_dniUsuario` varchar(9) NOT NULL,
  PRIMARY KEY (`idCuenta`,`usuarios_dniUsuario`),
  KEY `fk_cuentas_usuarios_idx` (`usuarios_dniUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudas`
--

DROP TABLE IF EXISTS `deudas`;
CREATE TABLE IF NOT EXISTS `deudas` (
  `idDeuda` int NOT NULL,
  `nomDeuda` varchar(45) DEFAULT NULL,
  `totalDeuda` varchar(45) DEFAULT NULL,
  `restoDeuda` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDeuda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE IF NOT EXISTS `movimientos` (
  `idMovimiento` int NOT NULL AUTO_INCREMENT,
  `importeMovimiento` float(7,2) DEFAULT NULL,
  `fechaMovimiento` date DEFAULT NULL,
  `comentarioMovimiento` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `tipoMovimiento_nomTipoMovimiento` varchar(45) NOT NULL,
  `subcategorias_nomSubcategoira` varchar(45) NOT NULL,
  `subcategorias_categorias_nomCategoria` varchar(45) NOT NULL,
  `usuarios_dniUsuario` varchar(9) NOT NULL,
  `cuentas_idCuenta` varchar(45) NOT NULL,
  `cuentas_usuarios_dniUsuario` varchar(9) NOT NULL,
  PRIMARY KEY (`idMovimiento`,`tipoMovimiento_nomTipoMovimiento`,`subcategorias_nomSubcategoira`,`subcategorias_categorias_nomCategoria`,`usuarios_dniUsuario`,`cuentas_idCuenta`,`cuentas_usuarios_dniUsuario`),
  KEY `fk_movimientos_tipoMovimiento1_idx` (`tipoMovimiento_nomTipoMovimiento`),
  KEY `fk_movimientos_subcategorias1_idx` (`subcategorias_nomSubcategoira`,`subcategorias_categorias_nomCategoria`),
  KEY `fk_movimientos_usuarios1_idx` (`usuarios_dniUsuario`),
  KEY `fk_movimientos_cuentas1_idx` (`cuentas_idCuenta`,`cuentas_usuarios_dniUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--

DROP TABLE IF EXISTS `presupuestos`;
CREATE TABLE IF NOT EXISTS `presupuestos` (
  `mesPresupuesto` varchar(15) NOT NULL,
  `anoPresupuesto` int NOT NULL,
  `importePresupuesto` float(7,2) NOT NULL,
  `categorias_nomCategoria` varchar(45) NOT NULL,
  PRIMARY KEY (`mesPresupuesto`,`anoPresupuesto`,`categorias_nomCategoria`),
  KEY `fk_presupuestos_categorias1_idx` (`categorias_nomCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE IF NOT EXISTS `proyectos` (
  `idProyecto` int NOT NULL,
  `saldoProyecto` float(7,2) NOT NULL,
  `fechaProyecto` date NOT NULL,
  `usuarios_dniUsuario` varchar(9) NOT NULL,
  PRIMARY KEY (`idProyecto`,`usuarios_dniUsuario`),
  KEY `fk_proyectos_usuarios1_idx` (`usuarios_dniUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

DROP TABLE IF EXISTS `subcategorias`;
CREATE TABLE IF NOT EXISTS `subcategorias` (
  `nomSubcategoira` varchar(45) NOT NULL,
  `categorias_nomCategoria` varchar(45) NOT NULL,
  PRIMARY KEY (`nomSubcategoira`,`categorias_nomCategoria`),
  KEY `fk_subcategorias_categorias1_idx` (`categorias_nomCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomovimiento`
--

DROP TABLE IF EXISTS `tipomovimiento`;
CREATE TABLE IF NOT EXISTS `tipomovimiento` (
  `nomTipoMovimiento` varchar(45) NOT NULL,
  PRIMARY KEY (`nomTipoMovimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `dniUsuario` varchar(9) NOT NULL,
  `nomUsuario` varchar(45) NOT NULL,
  `emailUsuario` varchar(45) NOT NULL,
  `passwordUsuario` varchar(45) NOT NULL,
  PRIMARY KEY (`dniUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `balance`
--
ALTER TABLE `balance`
  ADD CONSTRAINT `fk_presupuestos_categorias10` FOREIGN KEY (`categorias_nomCategoria`) REFERENCES `categorias` (`nomCategoria`);

--
-- Filtros para la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD CONSTRAINT `fk_cuentas_usuarios` FOREIGN KEY (`usuarios_dniUsuario`) REFERENCES `usuarios` (`dniUsuario`);

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `fk_movimientos_cuentas1` FOREIGN KEY (`cuentas_idCuenta`,`cuentas_usuarios_dniUsuario`) REFERENCES `cuentas` (`idCuenta`, `usuarios_dniUsuario`),
  ADD CONSTRAINT `fk_movimientos_subcategorias1` FOREIGN KEY (`subcategorias_nomSubcategoira`,`subcategorias_categorias_nomCategoria`) REFERENCES `subcategorias` (`nomSubcategoira`, `categorias_nomCategoria`),
  ADD CONSTRAINT `fk_movimientos_tipoMovimiento1` FOREIGN KEY (`tipoMovimiento_nomTipoMovimiento`) REFERENCES `tipomovimiento` (`nomTipoMovimiento`),
  ADD CONSTRAINT `fk_movimientos_usuarios1` FOREIGN KEY (`usuarios_dniUsuario`) REFERENCES `usuarios` (`dniUsuario`);

--
-- Filtros para la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD CONSTRAINT `fk_presupuestos_categorias1` FOREIGN KEY (`categorias_nomCategoria`) REFERENCES `categorias` (`nomCategoria`);

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `fk_proyectos_usuarios1` FOREIGN KEY (`usuarios_dniUsuario`) REFERENCES `usuarios` (`dniUsuario`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `fk_subcategorias_categorias1` FOREIGN KEY (`categorias_nomCategoria`) REFERENCES `categorias` (`nomCategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
