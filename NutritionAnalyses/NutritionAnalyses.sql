SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;

SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';



DROP SCHEMA IF EXISTS `nutritionanalyses` ;

CREATE SCHEMA IF NOT EXISTS `nutritionanalyses` DEFAULT CHARACTER SET latin1 ;

USE `nutritionanalyses` ;



-- -----------------------------------------------------

-- Table `nutritionanalyses`.`user`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `nutritionanalyses`.`user` ;



CREATE  TABLE IF NOT EXISTS `nutritionanalyses`.`user` (

  `id_user` INT NOT NULL AUTO_INCREMENT ,

  `name` VARCHAR(45) NOT NULL ,

  `cpf` VARCHAR(45) NOT NULL ,

  `email` VARCHAR(45) NOT NULL ,

  `logon` VARCHAR(45) NOT NULL ,

  `passwd` TEXT NOT NULL ,

  PRIMARY KEY (`id_user`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `nutritionanalyses`.`logon`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `nutritionanalyses`.`logon` ;



CREATE  TABLE IF NOT EXISTS `nutritionanalyses`.`logon` (

  `id_logon` INT NOT NULL AUTO_INCREMENT ,

  `logon` VARCHAR(45) NOT NULL ,

  `passwd` VARCHAR(45) NOT NULL ,

  `id_user` INT NOT NULL ,

  PRIMARY KEY (`id_logon`) ,

  INDEX `fk_logon_user` (`id_user` ASC) ,

  CONSTRAINT `fk_logon_user`

    FOREIGN KEY (`id_user` )

    REFERENCES `nutritionanalyses`.`user` (`id_user` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `nutritionanalyses`.`patient`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `nutritionanalyses`.`patient` ;



CREATE  TABLE IF NOT EXISTS `nutritionanalyses`.`patient` (

  `id_patient` INT NOT NULL AUTO_INCREMENT ,

  `fileName` TEXT NOT NULL ,

  `id_logon` INT NOT NULL ,

  `namePatient` VARCHAR(45) NOT NULL ,

  PRIMARY KEY (`id_patient`) ,

  INDEX `fk_patient_logon1` (`id_logon` ASC) ,

  CONSTRAINT `fk_patient_logon1`

    FOREIGN KEY (`id_logon` )

    REFERENCES `nutritionanalyses`.`logon` (`id_logon` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `nutritionanalyses`.`analyses`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `nutritionanalyses`.`analyses` ;



CREATE  TABLE IF NOT EXISTS `nutritionanalyses`.`analyses` (

  `id_analyses` INT NOT NULL AUTO_INCREMENT ,

  `nameAnalyse` VARCHAR(45) NOT NULL ,

  `descAnayse` VARCHAR(45) NOT NULL ,

  `id_patient` INT NOT NULL ,

  PRIMARY KEY (`id_analyses`) ,

  INDEX `fk_analyses_patient1` (`id_patient` ASC) ,

  CONSTRAINT `fk_analyses_patient1`

    FOREIGN KEY (`id_patient` )

    REFERENCES `nutritionanalyses`.`patient` (`id_patient` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB;







SET SQL_MODE=@OLD_SQL_MODE;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;