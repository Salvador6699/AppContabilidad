-- MySQL Script generated by MySQL Workbench
-- Fri Oct 11 11:26:33 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema contahogar2
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema contahogar2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `contahogar2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `contahogar2` ;

-- -----------------------------------------------------
-- Table `contahogar2`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `contahogar2`.`categorias` (
  `nomCategoria` VARCHAR(45) NOT NULL,
  `tipoCategoria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`nomCategoria`, `tipoCategoria`),
  UNIQUE INDEX `idcategorias_UNIQUE` (`nomCategoria` ASC) VISIBLE,
  UNIQUE INDEX `ID_tipo_movimiento` (`nomCategoria` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contahogar2`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `contahogar2`.`usuarios` (
  `dniUsuario` VARCHAR(9) NOT NULL,
  `nomUsuario` VARCHAR(45) NOT NULL,
  `emailUsuario` VARCHAR(45) NOT NULL,
  `passwordUsuario` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`dniUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contahogar2`.`cuentas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `contahogar2`.`cuentas` (
  `idCuenta` VARCHAR(45) NOT NULL,
  `nomCuenta` VARCHAR(25) NOT NULL,
  `saldoCuenta` FLOAT(7,2) NULL DEFAULT NULL,
  `usuarios_dniUsuario` VARCHAR(9) NOT NULL,
  PRIMARY KEY (`idCuenta`, `usuarios_dniUsuario`),
  INDEX `fk_cuentas_usuarios_idx` (`usuarios_dniUsuario` ASC) VISIBLE,
  CONSTRAINT `fk_cuentas_usuarios`
    FOREIGN KEY (`usuarios_dniUsuario`)
    REFERENCES `contahogar2`.`usuarios` (`dniUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contahogar2`.`tipoMovimiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `contahogar2`.`tipoMovimiento` (
  `nomTipoMovimiento` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`nomTipoMovimiento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contahogar2`.`subcategorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `contahogar2`.`subcategorias` (
  `nomSubcategoira` VARCHAR(45) NOT NULL,
  `categorias_nomCategoria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`nomSubcategoira`, `categorias_nomCategoria`),
  INDEX `fk_subcategorias_categorias1_idx` (`categorias_nomCategoria` ASC) VISIBLE,
  CONSTRAINT `fk_subcategorias_categorias1`
    FOREIGN KEY (`categorias_nomCategoria`)
    REFERENCES `contahogar2`.`categorias` (`nomCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contahogar2`.`movimientos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `contahogar2`.`movimientos` (
  `idMovimiento` INT NOT NULL AUTO_INCREMENT,
  `importeMovimiento` FLOAT(7,2) NULL DEFAULT NULL,
  `fechaMovimiento` DATE NULL DEFAULT NULL,
  `comentarioMovimiento` VARCHAR(250) COLLATE 'utf8mb3_spanish_ci' NULL DEFAULT NULL,
  `tipoMovimiento_nomTipoMovimiento` VARCHAR(45) NOT NULL,
  `subcategorias_nomSubcategoira` VARCHAR(45) NOT NULL,
  `subcategorias_categorias_nomCategoria` VARCHAR(45) NOT NULL,
  `usuarios_dniUsuario` VARCHAR(9) NOT NULL,
  `cuentas_idCuenta` VARCHAR(45) NOT NULL,
  `cuentas_usuarios_dniUsuario` VARCHAR(9) NOT NULL,
  PRIMARY KEY (`idMovimiento`, `tipoMovimiento_nomTipoMovimiento`, `subcategorias_nomSubcategoira`, `subcategorias_categorias_nomCategoria`, `usuarios_dniUsuario`, `cuentas_idCuenta`, `cuentas_usuarios_dniUsuario`),
  INDEX `fk_movimientos_tipoMovimiento1_idx` (`tipoMovimiento_nomTipoMovimiento` ASC) VISIBLE,
  INDEX `fk_movimientos_subcategorias1_idx` (`subcategorias_nomSubcategoira` ASC, `subcategorias_categorias_nomCategoria` ASC) VISIBLE,
  INDEX `fk_movimientos_usuarios1_idx` (`usuarios_dniUsuario` ASC) VISIBLE,
  INDEX `fk_movimientos_cuentas1_idx` (`cuentas_idCuenta` ASC, `cuentas_usuarios_dniUsuario` ASC) VISIBLE,
  CONSTRAINT `fk_movimientos_tipoMovimiento1`
    FOREIGN KEY (`tipoMovimiento_nomTipoMovimiento`)
    REFERENCES `contahogar2`.`tipoMovimiento` (`nomTipoMovimiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientos_subcategorias1`
    FOREIGN KEY (`subcategorias_nomSubcategoira` , `subcategorias_categorias_nomCategoria`)
    REFERENCES `contahogar2`.`subcategorias` (`nomSubcategoira` , `categorias_nomCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientos_usuarios1`
    FOREIGN KEY (`usuarios_dniUsuario`)
    REFERENCES `contahogar2`.`usuarios` (`dniUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientos_cuentas1`
    FOREIGN KEY (`cuentas_idCuenta` , `cuentas_usuarios_dniUsuario`)
    REFERENCES `contahogar2`.`cuentas` (`idCuenta` , `usuarios_dniUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contahogar2`.`presupuestos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `contahogar2`.`presupuestos` (
  `mesPresupuesto` VARCHAR(15) NOT NULL,
  `anoPresupuesto` INT NOT NULL,
  `importePresupuesto` FLOAT(7,2) NOT NULL,
  `categorias_nomCategoria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`mesPresupuesto`, `anoPresupuesto`, `categorias_nomCategoria`),
  INDEX `fk_presupuestos_categorias1_idx` (`categorias_nomCategoria` ASC) VISIBLE,
  CONSTRAINT `fk_presupuestos_categorias1`
    FOREIGN KEY (`categorias_nomCategoria`)
    REFERENCES `contahogar2`.`categorias` (`nomCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contahogar2`.`proyectos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `contahogar2`.`proyectos` (
  `idProyecto` INT NOT NULL,
  `saldoProyecto` FLOAT(7,2) NOT NULL,
  `fechaProyecto` DATE NOT NULL,
  `usuarios_dniUsuario` VARCHAR(9) NOT NULL,
  PRIMARY KEY (`idProyecto`, `usuarios_dniUsuario`),
  INDEX `fk_proyectos_usuarios1_idx` (`usuarios_dniUsuario` ASC) VISIBLE,
  CONSTRAINT `fk_proyectos_usuarios1`
    FOREIGN KEY (`usuarios_dniUsuario`)
    REFERENCES `contahogar2`.`usuarios` (`dniUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contahogar2`.`balance`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `contahogar2`.`balance` (
  `mesBalance` VARCHAR(15) NOT NULL,
  `anoBalance` INT NOT NULL,
  `importeBalance` FLOAT(7,2) NOT NULL,
  `categorias_nomCategoria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`mesBalance`, `anoBalance`, `categorias_nomCategoria`),
  INDEX `fk_presupuestos_categorias1_idx` (`categorias_nomCategoria` ASC) VISIBLE,
  CONSTRAINT `fk_presupuestos_categorias10`
    FOREIGN KEY (`categorias_nomCategoria`)
    REFERENCES `contahogar2`.`categorias` (`nomCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contahogar2`.`deudas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `contahogar2`.`deudas` (
  `idDeuda` INT NOT NULL,
  `nomDeuda` VARCHAR(45) NULL,
  `totalDeuda` VARCHAR(45) NULL,
  `restoDeuda` VARCHAR(45) NULL,
  PRIMARY KEY (`idDeuda`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
