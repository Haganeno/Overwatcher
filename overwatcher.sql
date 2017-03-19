-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`globalstatscompetitive`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`globalstatscompetitive` (
  `idGlobalStats` INT(11) NOT NULL,
  `wins` INT(11) NULL DEFAULT NULL,
  `loss` INT(11) NULL DEFAULT NULL,
  `gamesPlayed` INT(11) NULL DEFAULT NULL,
  `timePlayed` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`idGlobalStats`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`globalstatsquickplay`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`globalstatsquickplay` (
  `idGlobalStats` INT(11) NOT NULL,
  `wins` INT(11) NULL DEFAULT NULL,
  `loss` INT(11) NULL DEFAULT NULL,
  `gamesPlayed` INT(11) NULL DEFAULT NULL,
  `timePlayed` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`idGlobalStats`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user` (
  `idUser` INT(11) NOT NULL,
  `userName` VARCHAR(45) NULL DEFAULT NULL,
  `rankLevel` INT(11) NULL DEFAULT NULL,
  `skillRating` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idUser`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`herostatscompetitive`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`herostatscompetitive` (
  `idHero` INT(11) NOT NULL,
  `heroName` VARCHAR(45) NULL DEFAULT NULL,
  `timePlayed` VARCHAR(45) NULL DEFAULT NULL,
  `gamesPlayed` VARCHAR(45) NULL DEFAULT NULL,
  `kills` INT(11) NULL DEFAULT NULL,
  `deaths` INT(11) NULL DEFAULT NULL,
  `accuracy` INT(11) NULL DEFAULT NULL,
  `damage` INT(11) NULL DEFAULT NULL,
  `objectiveTime` VARCHAR(45) NULL DEFAULT NULL,
  `healing` INT(11) NULL DEFAULT NULL,
  `criticalShots` INT(11) NULL DEFAULT NULL,
  `damageBlocked` INT(11) NULL DEFAULT NULL,
  `energyCharge` INT(11) NULL DEFAULT NULL,
  `heroImage` VARCHAR(400) NULL DEFAULT NULL,
  `timeOnFire` VARCHAR(45) NULL DEFAULT NULL,
  `sleep` INT(11) NULL DEFAULT NULL,
  `hookAccuracy` INT(11) NULL DEFAULT NULL,
  `User_idUser` INT(11) NOT NULL,
  PRIMARY KEY (`idHero`, `User_idUser`),
  INDEX `fk_HeroStatsCompetitive_User1_idx` (`User_idUser` ASC),
  CONSTRAINT `fk_HeroStatsCompetitive_User1`
    FOREIGN KEY (`User_idUser`)
    REFERENCES `mydb`.`user` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`herostatsquickplay`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`herostatsquickplay` (
  `idHero` INT(11) NOT NULL,
  `heroName` VARCHAR(45) NULL DEFAULT NULL,
  `timePlayed` VARCHAR(45) NULL DEFAULT NULL,
  `gamesPlayed` VARCHAR(45) NULL DEFAULT NULL,
  `kills` INT(11) NULL DEFAULT NULL,
  `deaths` INT(11) NULL DEFAULT NULL,
  `accuracy` INT(11) NULL DEFAULT NULL,
  `damage` INT(11) NULL DEFAULT NULL,
  `objectiveTime` VARCHAR(45) NULL DEFAULT NULL,
  `healing` INT(11) NULL DEFAULT NULL,
  `criticalShots` INT(11) NULL DEFAULT NULL,
  `damageBlocked` INT(11) NULL DEFAULT NULL,
  `energyCharge` INT(11) NULL DEFAULT NULL,
  `heroImage` VARCHAR(400) NULL DEFAULT NULL,
  `timeOnFire` VARCHAR(45) NULL DEFAULT NULL,
  `sleep` INT(11) NULL DEFAULT NULL,
  `hookAccuracy` INT(11) NULL DEFAULT NULL,
  `User_idUser` INT(11) NOT NULL,
  PRIMARY KEY (`idHero`, `User_idUser`),
  INDEX `fk_HeroStatsQuickplay_User1_idx` (`User_idUser` ASC),
  CONSTRAINT `fk_HeroStatsQuickplay_User1`
    FOREIGN KEY (`User_idUser`)
    REFERENCES `mydb`.`user` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
