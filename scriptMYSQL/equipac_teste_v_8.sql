-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema testing_db
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `testing_db` ;

-- -----------------------------------------------------
-- Schema testing_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `testing_db` DEFAULT CHARACTER SET utf8 ;
USE `testing_db` ;

-- -----------------------------------------------------
-- Table `testing_db`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testing_db`.`admin` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `password` VARCHAR(200) NOT NULL,
  `admin_password_resets` VARCHAR(32) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `nivel` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `testing_db`.`bolsista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testing_db`.`bolsista` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `cpf` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `nivel` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `testing_db`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testing_db`.`usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL DEFAULT NULL,
  `password` VARCHAR(5000) NULL DEFAULT NULL,
  `usuario_password_resets` VARCHAR(32) NULL DEFAULT NULL,
  `cargo` VARCHAR(45) NULL DEFAULT NULL,
  `cpf` VARCHAR(11) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `nivel` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `testing_db`.`problema`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testing_db`.`problema` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(300) NULL DEFAULT NULL,
  `criacao` DATETIME NOT NULL,
  `finalizacao` TIMESTAMP NULL DEFAULT NULL,
  `usuario_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `usuario_id`),
  INDEX `fk_problema_usuario1_idx` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_problema_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `testing_db`.`usuario` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `testing_db`.`status_chamado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testing_db`.`status_chamado` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `testing_db`.`chamado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testing_db`.`chamado` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `dataAtribuida` DATE NULL DEFAULT NULL,
  `dataFinalizada` DATE NULL DEFAULT NULL,
  `solucao` VARCHAR(200) NULL DEFAULT NULL,
  `status_chamado_id` INT(11) NOT NULL,
  `problema_id` INT(11) NOT NULL,
  `problema_usuario_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `status_chamado_id`, `problema_id`, `problema_usuario_id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_chamado_status_chamado_idx` (`status_chamado_id` ASC) VISIBLE,
  INDEX `fk_chamado_problema1_idx` (`problema_id` ASC, `problema_usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_chamado_problema1`
    FOREIGN KEY (`problema_id` , `problema_usuario_id`)
    REFERENCES `testing_db`.`problema` (`id` , `usuario_id`),
  CONSTRAINT `fk_chamado_status_chamado`
    FOREIGN KEY (`status_chamado_id`)
    REFERENCES `testing_db`.`status_chamado` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `testing_db`.`bolsista_has_chamado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testing_db`.`bolsista_has_chamado` (
  `bolsista_id` INT(10) UNSIGNED NOT NULL,
  `chamado_id` INT(11) NOT NULL,
  PRIMARY KEY (`bolsista_id`, `chamado_id`),
  INDEX `fk_bolsista_has_chamado_chamado1_idx` (`chamado_id` ASC) VISIBLE,
  INDEX `fk_bolsista_has_chamado_bolsista1_idx` (`bolsista_id` ASC) VISIBLE,
  CONSTRAINT `fk_bolsista_has_chamado_bolsista1`
    FOREIGN KEY (`bolsista_id`)
    REFERENCES `testing_db`.`bolsista` (`id`),
  CONSTRAINT `fk_bolsista_has_chamado_chamado1`
    FOREIGN KEY (`chamado_id`)
    REFERENCES `testing_db`.`chamado` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `testing_db`.`equipamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testing_db`.`equipamento` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `patrimonio` INT(11) NULL DEFAULT NULL,
  `modelo` VARCHAR(45) NULL DEFAULT NULL,
  `criacao` DATETIME NOT NULL,
  `usuario_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `usuario_id`),
  INDEX `fk_equipamento_usuario_idx` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_equipamento_usuario`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `testing_db`.`usuario` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `testing_db`.`status_manutencao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testing_db`.`status_manutencao` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `testing_db`.`manutencao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testing_db`.`manutencao` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `solucao` VARCHAR(200) NULL DEFAULT NULL,
  `dataAtribuida` DATE NULL DEFAULT NULL,
  `dataFinalidada` DATE NULL DEFAULT NULL,
  `status_id` INT(11) NOT NULL,
  `equipamento_id` INT(11) NOT NULL,
  `equipamento_usuario_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `status_id`, `equipamento_id`, `equipamento_usuario_id`),
  INDEX `fk_manutencao_status1_idx` (`status_id` ASC) VISIBLE,
  INDEX `fk_manutencao_equipamento1_idx` (`equipamento_id` ASC, `equipamento_usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_manutencao_equipamento1`
    FOREIGN KEY (`equipamento_id` , `equipamento_usuario_id`)
    REFERENCES `testing_db`.`equipamento` (`id` , `usuario_id`),
  CONSTRAINT `fk_manutencao_status1`
    FOREIGN KEY (`status_id`)
    REFERENCES `testing_db`.`status_manutencao` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `testing_db`.`bolsista_has_manutencao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testing_db`.`bolsista_has_manutencao` (
  `bolsista_id` INT(10) UNSIGNED NOT NULL,
  `manutencao_id` INT(11) NOT NULL,
  PRIMARY KEY (`bolsista_id`, `manutencao_id`),
  INDEX `fk_bolsista_has_manutencao_manutencao1_idx` (`manutencao_id` ASC) VISIBLE,
  INDEX `fk_bolsista_has_manutencao_bolsista1_idx` (`bolsista_id` ASC) VISIBLE,
  CONSTRAINT `fk_bolsista_has_manutencao_bolsista1`
    FOREIGN KEY (`bolsista_id`)
    REFERENCES `testing_db`.`bolsista` (`id`),
  CONSTRAINT `fk_bolsista_has_manutencao_manutencao1`
    FOREIGN KEY (`manutencao_id`)
    REFERENCES `testing_db`.`manutencao` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `testing_db`.`supervisor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `testing_db`.`supervisor` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL DEFAULT NULL,
  `password` VARCHAR(5000) NULL DEFAULT NULL,
  `usuario_password_resets` VARCHAR(32) NULL DEFAULT NULL,
  `cargo` VARCHAR(45) NULL DEFAULT NULL,
  `cpf` VARCHAR(11) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `nivel` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `testing_db`.`status_chamado`
-- -----------------------------------------------------
START TRANSACTION;
USE `testing_db`;
INSERT INTO `testing_db`.`status_chamado` (`id`, `name`) VALUES (1, 'Aberta');
INSERT INTO `testing_db`.`status_chamado` (`id`, `name`) VALUES (2, 'Atribuida');
INSERT INTO `testing_db`.`status_chamado` (`id`, `name`) VALUES (3, 'Em progresso');
INSERT INTO `testing_db`.`status_chamado` (`id`, `name`) VALUES (4, 'Finalizada');

COMMIT;


-- -----------------------------------------------------
-- Data for table `testing_db`.`status_manutencao`
-- -----------------------------------------------------
START TRANSACTION;
USE `testing_db`;
INSERT INTO `testing_db`.`status_manutencao` (`id`, `name`) VALUES (1, 'Aberta');
INSERT INTO `testing_db`.`status_manutencao` (`id`, `name`) VALUES (2, 'Atribuida');
INSERT INTO `testing_db`.`status_manutencao` (`id`, `name`) VALUES (3, 'Em progresso');
INSERT INTO `testing_db`.`status_manutencao` (`id`, `name`) VALUES (4, 'Finalizada');

COMMIT;

