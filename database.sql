-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Lucio
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `Lucio` ;

-- -----------------------------------------------------
-- Schema Lucio
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Lucio` DEFAULT CHARACTER SET utf8 ;
USE `Lucio` ;

-- -----------------------------------------------------
-- Table `Lucio`.`Administradores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Lucio`.`Administradores` ;

CREATE TABLE IF NOT EXISTS `Lucio`.`Administradores` (
  `idAdministrador` INT NOT NULL AUTO_INCREMENT,
  `correo` VARCHAR(100) NOT NULL,
  `passwd` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idAdministrador`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Lucio`.`Padres`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Lucio`.`Padres` ;

CREATE TABLE IF NOT EXISTS `Lucio`.`Padres` (
  `idPadre` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `paterno` VARCHAR(45) NOT NULL,
  `materno` VARCHAR(45) NOT NULL,
  `correo` VARCHAR(100) NOT NULL,
  `passwd` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPadre`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Lucio`.`Infantes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Lucio`.`Infantes` ;

CREATE TABLE IF NOT EXISTS `Lucio`.`Infantes` (
  `idInfante` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `paterno` VARCHAR(45) NOT NULL,
  `materno` VARCHAR(45) NOT NULL,
  `tutor` INT NOT NULL,
  `hashcode` VARCHAR(13) NULL,
  PRIMARY KEY (`idInfante`),
  INDEX `fk_Infantes_Padres_idx` (`tutor` ASC),
  CONSTRAINT `fk_Infantes_Padres`
    FOREIGN KEY (`tutor`)
    REFERENCES `Lucio`.`Padres` (`idPadre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Lucio`.`Cursos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Lucio`.`Cursos` ;

CREATE TABLE IF NOT EXISTS `Lucio`.`Cursos` (
  `idCurso` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `temario` TEXT NOT NULL,
  PRIMARY KEY (`idCurso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Lucio`.`VideosCurso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Lucio`.`VideosCurso` ;

CREATE TABLE IF NOT EXISTS `Lucio`.`VideosCurso` (
  `idVideoCurso` INT NOT NULL AUTO_INCREMENT,
  `frame` TEXT NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `curso` INT NOT NULL,
  PRIMARY KEY (`idVideoCurso`),
  INDEX `fk_VideosCurso_Cursos1_idx` (`curso` ASC),
  CONSTRAINT `fk_VideosCurso_Cursos1`
    FOREIGN KEY (`curso`)
    REFERENCES `Lucio`.`Cursos` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Lucio`.`DocumentosCurso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Lucio`.`DocumentosCurso` ;

CREATE TABLE IF NOT EXISTS `Lucio`.`DocumentosCurso` (
  `idDocumentoCurso` INT NOT NULL AUTO_INCREMENT,
  `documento` TEXT NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `curso` INT NOT NULL,
  PRIMARY KEY (`idDocumentoCurso`),
  INDEX `fk_DocumentosCurso_Cursos1_idx` (`curso` ASC),
  CONSTRAINT `fk_DocumentosCurso_Cursos1`
    FOREIGN KEY (`curso`)
    REFERENCES `Lucio`.`Cursos` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Lucio`.`JuegosCurso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Lucio`.`JuegosCurso` ;

CREATE TABLE IF NOT EXISTS `Lucio`.`JuegosCurso` (
  `idJuegoCurso` INT NOT NULL AUTO_INCREMENT,
  `path` TEXT NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `curso` INT NOT NULL,
  PRIMARY KEY (`idJuegoCurso`),
  INDEX `fk_JuegosCurso_Cursos1_idx` (`curso` ASC),
  CONSTRAINT `fk_JuegosCurso_Cursos1`
    FOREIGN KEY (`curso`)
    REFERENCES `Lucio`.`Cursos` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Lucio`.`InscritosCurso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Lucio`.`InscritosCurso` ;

CREATE TABLE IF NOT EXISTS `Lucio`.`InscritosCurso` (
  `idInscritoCurso` INT NOT NULL AUTO_INCREMENT,
  `curso` INT NOT NULL,
  `infante` INT NOT NULL,
  PRIMARY KEY (`idInscritoCurso`),
  INDEX `fk_InscritosCurso_Cursos1_idx` (`curso` ASC),
  INDEX `fk_InscritosCurso_Infantes1_idx` (`infante` ASC),
  CONSTRAINT `fk_InscritosCurso_Cursos1`
    FOREIGN KEY (`curso`)
    REFERENCES `Lucio`.`Cursos` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_InscritosCurso_Infantes1`
    FOREIGN KEY (`infante`)
    REFERENCES `Lucio`.`Infantes` (`idInfante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Lucio`.`CheckVideos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Lucio`.`CheckVideos` ;

CREATE TABLE IF NOT EXISTS `Lucio`.`CheckVideos` (
  `idCheckVideo` INT NOT NULL AUTO_INCREMENT,
  `video` INT NOT NULL,
  `infante` INT NOT NULL,
  PRIMARY KEY (`idCheckVideo`),
  INDEX `fk_CheckVideos_VideosCurso1_idx` (`video` ASC),
  INDEX `fk_CheckVideos_Infantes1_idx` (`infante` ASC),
  CONSTRAINT `fk_CheckVideos_VideosCurso1`
    FOREIGN KEY (`video`)
    REFERENCES `Lucio`.`VideosCurso` (`idVideoCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CheckVideos_Infantes1`
    FOREIGN KEY (`infante`)
    REFERENCES `Lucio`.`Infantes` (`idInfante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Lucio`.`CheckDocumentos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Lucio`.`CheckDocumentos` ;

CREATE TABLE IF NOT EXISTS `Lucio`.`CheckDocumentos` (
  `idCheckDocumento` INT NOT NULL AUTO_INCREMENT,
  `documento` INT NOT NULL,
  `infante` INT NOT NULL,
  PRIMARY KEY (`idCheckDocumento`),
  INDEX `fk_CheckDocumentos_DocumentosCurso1_idx` (`documento` ASC),
  INDEX `fk_CheckDocumentos_Infantes1_idx` (`infante` ASC),
  CONSTRAINT `fk_CheckDocumentos_DocumentosCurso1`
    FOREIGN KEY (`documento`)
    REFERENCES `Lucio`.`DocumentosCurso` (`idDocumentoCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CheckDocumentos_Infantes1`
    FOREIGN KEY (`infante`)
    REFERENCES `Lucio`.`Infantes` (`idInfante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Lucio`.`CheckJuegos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Lucio`.`CheckJuegos` ;

CREATE TABLE IF NOT EXISTS `Lucio`.`CheckJuegos` (
  `idCheckJuego` INT NOT NULL AUTO_INCREMENT,
  `juego` INT NOT NULL,
  `infante` INT NOT NULL,
  PRIMARY KEY (`idCheckJuego`),
  INDEX `fk_CheckJuegos_JuegosCurso1_idx` (`juego` ASC),
  INDEX `fk_CheckJuegos_Infantes1_idx` (`infante` ASC),
  CONSTRAINT `fk_CheckJuegos_JuegosCurso1`
    FOREIGN KEY (`juego`)
    REFERENCES `Lucio`.`JuegosCurso` (`idJuegoCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CheckJuegos_Infantes1`
    FOREIGN KEY (`infante`)
    REFERENCES `Lucio`.`Infantes` (`idInfante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
