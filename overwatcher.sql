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
-- Table `mydb`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`User` (
  `idUser` VARCHAR(50) NOT NULL,
  `userName` VARCHAR(45) NULL,
  `rankLevel` INT NULL,
  `skillRating` INT NULL,
  PRIMARY KEY (`idUser`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`GlobalStatsQuickplay`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`GlobalStatsQuickplay` (
  `wins` INT NULL,
  `loss` INT NULL,
  `gamesPlayed` INT NULL,
  `timePlayed` VARCHAR(50) NULL,
  `User_idUser` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`User_idUser`),
  INDEX `fk_GlobalStatsQuickplay_User1_idx` (`User_idUser` ASC),
  CONSTRAINT `fk_GlobalStatsQuickplay_User1`
    FOREIGN KEY (`User_idUser`)
    REFERENCES `mydb`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`GlobalStatsCompetitive`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`GlobalStatsCompetitive` (
  `wins` INT NULL,
  `loss` INT NULL,
  `gamesPlayed` INT NULL,
  `timePlayed` VARCHAR(50) NULL,
  `User_idUser` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`User_idUser`),
  INDEX `fk_GlobalStatsCompetitive_User1_idx` (`User_idUser` ASC),
  CONSTRAINT `fk_GlobalStatsCompetitive_User1`
    FOREIGN KEY (`User_idUser`)
    REFERENCES `mydb`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`HeroStatsQuickplay`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`HeroStatsQuickplay` (
  `idHero` INT NOT NULL,
  `heroName` VARCHAR(45) NULL,
  `timePlayed` VARCHAR(45) NULL,
  `gamesPlayed` VARCHAR(45) NULL,
  `kills` INT NULL,
  `deaths` INT NULL,
  `accuracy` INT NULL,
  `damage` INT NULL,
  `objectiveTime` VARCHAR(45) NULL,
  `healing` INT NULL,
  `criticalShots` INT NULL,
  `damageBlocked` INT NULL,
  `energyCharge` INT NULL,
  `heroImage` VARCHAR(400) NULL,
  `timeOnFire` VARCHAR(45) NULL,
  `sleep` INT NULL,
  `hookAccuracy` INT NULL,
  `User_idUser` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idHero`, `User_idUser`),
  INDEX `fk_HeroStatsQuickplay_User1_idx` (`User_idUser` ASC),
  CONSTRAINT `fk_HeroStatsQuickplay_User1`
    FOREIGN KEY (`User_idUser`)
    REFERENCES `mydb`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`HeroStatsCompetitive`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`HeroStatsCompetitive` (
  `idHero` INT NOT NULL,
  `heroName` VARCHAR(45) NULL,
  `timePlayed` VARCHAR(45) NULL,
  `gamesPlayed` VARCHAR(45) NULL,
  `kills` INT NULL,
  `deaths` INT NULL,
  `accuracy` INT NULL,
  `damage` INT NULL,
  `objectiveTime` VARCHAR(45) NULL,
  `healing` INT NULL,
  `criticalShots` INT NULL,
  `damageBlocked` INT NULL,
  `energyCharge` INT NULL,
  `heroImage` VARCHAR(400) NULL,
  `timeOnFire` VARCHAR(45) NULL,
  `sleep` INT NULL,
  `hookAccuracy` INT NULL,
  `User_idUser` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idHero`, `User_idUser`),
  INDEX `fk_HeroStatsCompetitive_User1_idx` (`User_idUser` ASC),
  CONSTRAINT `fk_HeroStatsCompetitive_User1`
    FOREIGN KEY (`User_idUser`)
    REFERENCES `mydb`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
