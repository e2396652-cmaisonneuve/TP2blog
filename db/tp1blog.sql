-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema tp1blog
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tp1blog
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tp1blog` DEFAULT CHARACTER SET utf8 ;
USE `tp1blog` ;

-- -----------------------------------------------------
-- Table `tp1blog`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tp1blog`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tp1blog`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tp1blog`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tp1blog`.`articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tp1blog`.`articles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(80) NOT NULL,
  `content` TEXT NOT NULL,
  `date` DATE NOT NULL,
  `users_id` INT NOT NULL,
  `categories_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_articles_users_idx` (`users_id` ASC),
  INDEX `fk_articles_categories1_idx` (`categories_id` ASC),
  CONSTRAINT `fk_articles_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `tp1blog`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `tp1blog`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tp1blog`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tp1blog`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `message` TEXT NOT NULL,
  `date` DATE NOT NULL,
  `users_id` INT NOT NULL,
  `articles_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comments_users1_idx` (`users_id` ASC),
  INDEX `fk_comments_articles1_idx` (`articles_id` ASC),
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `tp1blog`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_articles1`
    FOREIGN KEY (`articles_id`)
    REFERENCES `tp1blog`.`articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
