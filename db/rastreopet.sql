-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema mrastrem7_rastreopet
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mrastrem7_rastreopet
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mrastrem7_rastreopet` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ;
USE `mrastrem7_rastreopet` ;

-- -----------------------------------------------------
-- Table `mrastrem7_rastreopet`.`permission`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mrastrem7_rastreopet`.`permission` (
                                                           `entity_id` INT NOT NULL,
                                                           `permission_name` VARCHAR(45) NULL DEFAULT NULL,
    PRIMARY KEY (`entity_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `mrastrem7_rastreopet`.`permissionxrole`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mrastrem7_rastreopet`.`permissionxrole` (
                                                                `entity_id` INT NOT NULL,
                                                                `permission_id` INT NULL DEFAULT NULL,
                                                                `role_id` INT NULL DEFAULT NULL,
                                                                PRIMARY KEY (`entity_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `mrastrem7_rastreopet`.`pet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mrastrem7_rastreopet`.`pet` (
                                                    `entity_id` INT NOT NULL AUTO_INCREMENT,
                                                    `name` VARCHAR(45) NULL DEFAULT NULL,
    `pet_type` VARCHAR(45) NULL DEFAULT NULL,
    `reward` VARCHAR(45) NULL DEFAULT NULL,
    `diet` LONGTEXT NULL DEFAULT NULL,
    `clinic_history` LONGTEXT NULL DEFAULT NULL,
    `locator_id` INT NULL DEFAULT NULL,
    `alergy` LONGTEXT NULL DEFAULT NULL,
    `img_name` LONGTEXT NULL DEFAULT NULL,
    `medicine` VARCHAR(45) NULL DEFAULT NULL,
    `pet_breed` VARCHAR(45) NULL DEFAULT NULL,
    `weight` VARCHAR(45) NULL DEFAULT NULL,
    `owner_id` INT NULL DEFAULT NULL,
    `img_path` LONGTEXT NULL DEFAULT NULL,
    `age` VARCHAR(45) NULL DEFAULT NULL,
    PRIMARY KEY (`entity_id`))
    ENGINE = InnoDB
    AUTO_INCREMENT = 53
    DEFAULT CHARACTER SET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `mrastrem7_rastreopet`.`pet_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mrastrem7_rastreopet`.`pet_type` (
                                                         `entity_id` INT NOT NULL,
                                                         `type_name` VARCHAR(45) NULL DEFAULT NULL,
    PRIMARY KEY (`entity_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `mrastrem7_rastreopet`.`position_track_history`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mrastrem7_rastreopet`.`position_track_history` (
                                                                       `entity_id` INT NOT NULL AUTO_INCREMENT,
                                                                       `lattitude` VARCHAR(45) NULL DEFAULT NULL,
    `longitude` VARCHAR(45) NULL DEFAULT NULL,
    `pet_id` VARCHAR(45) NULL DEFAULT NULL,
    `qr_identifier` VARCHAR(45) NULL DEFAULT NULL,
    `created_at` DATETIME NULL DEFAULT NULL,
    PRIMARY KEY (`entity_id`))
    ENGINE = InnoDB
    AUTO_INCREMENT = 119
    DEFAULT CHARACTER SET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `mrastrem7_rastreopet`.`qr_locator`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mrastrem7_rastreopet`.`qr_locator` (
                                                           `entity_id` INT NOT NULL AUTO_INCREMENT,
                                                           `qr_identifier` LONGTEXT NULL DEFAULT NULL,
                                                           `image_path` VARCHAR(200) NULL DEFAULT NULL,
    `enabled` INT NOT NULL DEFAULT '0',
    `pet_id` INT NULL DEFAULT NULL,
    `owner_id` INT NULL DEFAULT NULL,
    `img_name` LONGTEXT NULL DEFAULT NULL,
    `img_ext` VARCHAR(45) NULL DEFAULT NULL,
    `pointer_url` LONGTEXT NULL DEFAULT NULL,
    PRIMARY KEY (`entity_id`))
    ENGINE = InnoDB
    AUTO_INCREMENT = 232
    DEFAULT CHARACTER SET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `mrastrem7_rastreopet`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mrastrem7_rastreopet`.`user` (
                                                     `entity_id` INT NOT NULL AUTO_INCREMENT,
                                                     `name` VARCHAR(45) NULL DEFAULT NULL,
    `lastname` VARCHAR(45) NULL DEFAULT NULL,
    `phone` VARCHAR(45) NULL DEFAULT NULL,
    `address` VARCHAR(45) NULL DEFAULT NULL,
    `user_role` INT NULL DEFAULT NULL,
    `password` VARCHAR(100) NULL DEFAULT NULL,
    `username` VARCHAR(45) NULL DEFAULT NULL,
    `is_phone_whatsapp` INT NULL DEFAULT '0',
    `usercol` VARCHAR(45) NULL DEFAULT NULL,
    PRIMARY KEY (`entity_id`))
    ENGINE = InnoDB
    AUTO_INCREMENT = 56
    DEFAULT CHARACTER SET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `mrastrem7_rastreopet`.`user_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mrastrem7_rastreopet`.`user_role` (
                                                          `entity_id` INT NOT NULL,
                                                          `type_name` VARCHAR(45) NULL DEFAULT NULL,
    PRIMARY KEY (`entity_id`))
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
