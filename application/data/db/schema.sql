CREATE TABLE `univalle_survey_information`.`surveys` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100) NULL,
	PRIMARY KEY (`id`));

INSERT INTO `univalle_survey_information`.`surveys` (`name`) VALUES ('Encuesta Empleo y Comunidades');

CREATE TABLE `univalle_survey_information`.`blocks` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `survey_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `survey_id_idx` (`survey_id` ASC),
  CONSTRAINT `survey_id`
    FOREIGN KEY (`survey_id`)
    REFERENCES `univalle_survey_information`.`surveys` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

INSERT INTO `univalle_survey_information`.`blocks` (`name`, `survey_id`) VALUES ('Información Personal', '1');
INSERT INTO `univalle_survey_information`.`blocks` (`name`, `survey_id`) VALUES ('Información del Primer Empleo', '1');

CREATE TABLE `univalle_survey_information`.`questions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(200) NULL,
  `type` INT NULL,
  `block_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `block_id_idx` (`block_id` ASC),
  CONSTRAINT `block_id`
    FOREIGN KEY (`block_id`)
    REFERENCES `univalle_survey_information`.`blocks` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);
    
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`) VALUES ('Nombre completo:', '1', '1');



