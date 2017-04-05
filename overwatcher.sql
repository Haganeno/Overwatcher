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
  `Level` INT NULL,
  `Rank` INT NULL,
  `QuickWins` INT NULL,
  `RankedWins` INT NULL,
  `Icon` VARCHAR(200) NULL,
  `RankedLost` INT NULL,
  `RankedPlayed` INT NULL,
  `RankedTime` INT NULL,
  `QuickTime` INT NULL,
  `RankedKillsAvg` FLOAT NULL,
  `RankedDeathsAvg` FLOAT NULL,
  `QuickKillsAvg` FLOAT NULL,
  `QuickDeathsAvg` FLOAT NULL,
  PRIMARY KEY (`idUser`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
