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

  `name` VARCHAR(45) NOT NULL ,

  `cpf` VARCHAR(45) NOT NULL ,

  `email` VARCHAR(45) NOT NULL ,

  `logon` VARCHAR(45) NOT NULL ,

  `passwd` TEXT NOT NULL ,

  PRIMARY KEY (`logon`) )

ENGINE = InnoDB

DEFAULT CHARACTER SET = latin1;





-- -----------------------------------------------------

-- Table `nutritionanalyses`.`logon`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `nutritionanalyses`.`logon` ;



CREATE  TABLE IF NOT EXISTS `nutritionanalyses`.`logon` (

  `passwd` VARCHAR(45) NOT NULL ,

  `logon` VARCHAR(45) NOT NULL ,

  PRIMARY KEY (`logon`) ,

  INDEX `fk_logon_user1` (`logon` ASC) ,

  CONSTRAINT `fk_logon_user1`

    FOREIGN KEY (`logon` )

    REFERENCES `nutritionanalyses`.`user` (`logon` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB

DEFAULT CHARACTER SET = latin1;





-- -----------------------------------------------------

-- Table `nutritionanalyses`.`patient`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `nutritionanalyses`.`patient` ;



CREATE  TABLE IF NOT EXISTS `nutritionanalyses`.`patient` (

  `protocolo` VARCHAR(45) NOT NULL ,

  `fileName` TEXT NOT NULL ,

  `namePatient` VARCHAR(45) NOT NULL ,

  `logon` VARCHAR(45) NOT NULL ,

  PRIMARY KEY (`protocolo`) ,

  INDEX `fk_patient_logon1` (`logon` ASC) ,

  CONSTRAINT `fk_patient_logon1`

    FOREIGN KEY (`logon` )

    REFERENCES `nutritionanalyses`.`logon` (`logon` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB

DEFAULT CHARACTER SET = latin1;





-- -----------------------------------------------------

-- Table `nutritionanalyses`.`analyse`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `nutritionanalyses`.`analyse` ;



CREATE  TABLE IF NOT EXISTS `nutritionanalyses`.`analyse` (

  `nameAnalyse` VARCHAR(45) NOT NULL ,

  `descAnalyse` VARCHAR(100) NOT NULL ,

  `protocolo` VARCHAR(45) NOT NULL ,

  PRIMARY KEY (`nameAnalyse`) ,

  INDEX `fk_analyses_patient1` (`protocolo` ASC) ,

  CONSTRAINT `fk_analyses_patient1`

    FOREIGN KEY (`protocolo` )

    REFERENCES `nutritionanalyses`.`patient` (`protocolo` )

    ON DELETE NO ACTION

    ON UPDATE NO ACTION)

ENGINE = InnoDB

DEFAULT CHARACTER SET = latin1;







SET SQL_MODE=@OLD_SQL_MODE;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

SET FOREIGN_KEY_CHECKS=0;