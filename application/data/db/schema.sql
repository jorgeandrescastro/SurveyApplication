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

ALTER TABLE `univalle_survey_information`.`surveys` 
ADD COLUMN `description` TEXT NULL AFTER `name`;

UPDATE `univalle_survey_information`.`surveys` SET `description`='Estimado(a) Egresado(a): La plataforma interactiva para la transferencia de información laboral busca recolectar y actualizar la historia laboral, el estado de empleo, los contactos y redes personales de los egresados de la Universidad del Valle, y hacer posible que cada uno de ustedes pueda consultar, en cualquier momento, las trayectorias potenciales que los unen con empleadores y las vacantes disponibles. \n\nLa encuesta que tiene ante sus ojos hace parte de la construcción de esa plataforma. Quiere identificar cómo, con la ayuda de amigos, colegas, conocidos, familiares ustedes han recibido, o transferido, información sobre vacantes. Con esa información se desean detectar las redes sociales y las comunidades que comparten y permiten el paso de información laboral entre egresados. Para asegurar la total confidencialidad de la información recibida y procesada, todos los datos serán encriptados. <br/> Muchas gracias por su ayuda.' WHERE `id`='1';

ALTER TABLE `univalle_survey_information`.`blocks` 
ADD COLUMN `weight` INT NULL AFTER `survey_id`;

UPDATE `univalle_survey_information`.`blocks` SET `weight`='1' WHERE `id`='1';
UPDATE `univalle_survey_information`.`blocks` SET `weight`='2' WHERE `id`='2';

ALTER TABLE `univalle_survey_information`.`questions` 
ADD COLUMN `weight` INT NULL AFTER `block_id`;

UPDATE `univalle_survey_information`.`questions` SET `weight`='1' WHERE `id`='1';

ALTER TABLE `univalle_survey_information`.`questions` 
ADD COLUMN `required` TINYINT NULL DEFAULT 0 AFTER `weight`;

UPDATE `univalle_survey_information`.`questions` SET `required`='1' WHERE `id`='1';

INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('Ciudad de residencia actual:', '1', '1', '2', '1');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('Estrato socioeconómico de la vivienda donde reside:', '1', '1', '3', '1');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Cuántos años cumplidos tiene?', '1', '1', '4', '1');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('Sexo: ', '4', '1', '5', '1');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('Usted se autoreconoce como:', '4', '1', '6', '1');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('Actualmente usted:', '4', '1', '7', '1');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Cuál es su parentesco con el jefe de hogar?', '4', '1', '8', '1');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿En qué año se graduó del programa de pregrado en la Universidad del Valle? (Si realizó más de un programa de pregrado, refiérase al primero)', '1', '1', '9', '1');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('Nombre del título que obtuvo (Si realizó más de un programa de pregrado refierase al primero)', '4', '1', '10', '1');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('Actualmente su máximo nivel educativo es:', '4', '1', '11', '1');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES (' ¿Pertenece a alguna comunidad u organización?', '3', '1', '12', '1');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('Su primer empleo lo obtuvo: ', '4', '2', '1', '1');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿En qué año obtuvo su primer empleo?', '1', '2', '2', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Su primer empleo lo obtuvo en una empresa en la trabajó alguno de sus padres, hermanos mayores, o cualquier otro integrante de su grupo familiar?', '4', '2', '3', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Cómo se enteró de la vacante que se convirtió en su primer empleo?', '4', '2', '4', '1');


INSERT INTO `univalle_survey_information`.`blocks` (`name`, `survey_id`, `weight`) VALUES ('Información Empleo Actual', '1', '3');
INSERT INTO `univalle_survey_information`.`blocks` (`name`, `survey_id`, `weight`) VALUES ('Búsqueda de Empleo', '1', '4');
INSERT INTO `univalle_survey_information`.`blocks` (`name`, `survey_id`, `weight`) VALUES ('Redes Sociales', '1', '5');

CREATE TABLE `univalle_survey_information`.`answers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(200) NULL,
  `question_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `question_id_idx` (`question_id` ASC),
  CONSTRAINT `question_id`
    FOREIGN KEY (`question_id`)
    REFERENCES `univalle_survey_information`.`questions` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);
    
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Masculino', '6');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Femenino', '6');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Afrodescendiente', '7');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Blanco', '7');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Indígena', '7');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Mestizo', '7');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('No está casado(a) y vive en pareja hace menos de 2 años', '8');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('No está  casado (a)  y vive en pareja hace 2 años o más', '8');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Está casado (a)', '8');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Está separado (a) o divorciado (a)', '8');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Está viudo (a)', '8');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Está soltero (a)', '8');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Jefe (a) del hogar', '9');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Pareja, esposo(a), Cónyuge, Compañero(a)', '9');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Hijo(a), hijastro(a)', '9');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Nieto(a)', '9');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Otro  pariente', '9');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Otro no pariente', '9');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Técnico', '12');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Tecnólogo', '12');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Profesional', '12');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Especialización', '12');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Maestría', '12');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Doctorado o Posdoctorado', '12');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Comunidad académica', '13');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Comunidad científica', '13');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Comunidad u organización política', '13');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Comunidad religiosa', '13');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Comunidad cultural-artística', '13');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Comunidad u organización deportiva', '13');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Antes de iniciar su pregrado', '14');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Mientras realizaba su pregrado', '14');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Después de obtener el grado', '14');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Aún no ha obtenido su primer empleo', '14');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Si', '16');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('No', '16');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Agencia de empleo', '17');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Anuncios clasificados (en medios físicos)', '17');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Anuncios clasificados (en internet) ', '17');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Convocatorias ', '17');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Llevando hojas de vida a empresas', '17');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Servicio público de empleo del SENA', '17');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('En la bolsa de empleo de egresados de Univalle', '17');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Profesores de la Universidad', '17');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Compañeros de la Universidad', '17');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Amigos (cercanos)', '17');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Personas conocidas (amigos de mis amigos)', '17');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Familiares', '17');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Vecinos', '17');

INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Cuántos empleos ha tenido hasta ahora en su vida laboral', '1', '2', '5', '1');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('En la actualidad su ocupación principal es', '3', '2', '6', '1');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Estudiar', '19');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Trabajar', '19');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Oficios del Hogar', '19');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Se encuentra incapacitado permanentemente para trabajar', '19');

INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Qué cargo desempeña en la actualidad?', '1', '3', '1', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('En esta ocupación usted es:', '4', '3', '2', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('Empresa', '1', '3', '3', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('Ciudad', '1', '3', '4', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Cuál es su área de desempeño?', '4', '3', '5', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Hace cuántos meses tiene este empleo?', '1', '3', '6', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Para obtener este empleo tuvo que cambiar de ciudad de residencia?', '4', '3', '7', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Cómo obtuvo su actual empleo?', '2', '3', '8', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Se relaciona su actual empleo con lo que estudia o estudió?', '4', '3', '9', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Qué tipo de contrato tiene?', '4', '3', '10', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('En este empleo le reconocen', '3', '3', '11', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('El número de personas que trabajan en su empresa es:', '1', '3', '12', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('Su ingreso laboral está en el rango:', '4', '3', '13', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Está satisfecho con su trabajo?', '4', '3', '14', '0');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Empleado de una empresa pública', '21');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Empleado de una empresa privada', '21');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Trabajador independiente', '21');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Arte, Cultura y Esparcimiento', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Asesoría, Capacitación y Análisis', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Automatización, Creación, Adaptación y Soluciones Tecnológicas', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Ciencias Naturales, Aplicadas y Relacionadas', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Deporte', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Diseño Gráfico y Publicidad', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Educación y Ciencias Sociales', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Explotación Primaria y Extractiva', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Finanzas, Administración, Contable y Organizacional', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Investigación, Diseño y Análisis de Proyectos', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Mantenimiento, Montajes y Asistencia Técnica', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Manufactura, Fabricación y Ensamble', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Medio Ambiente y Gestión Social', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Medios de Comunicación (Radio, Televisión y otras)', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Mercadeo, Ventas y Servicios (Telecomunicación, Gas, Acueducto y Energía)', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Ocupaciones de Dirección y Gerencia', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Operación de Equipos', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Producción, Calidad y Logística', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Transporte', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Salud', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Servicios Gubernamentales', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Servicio Social y Religión', '24');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Sistemas', '24');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Si', '26');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('No', '26');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Agencia de empleo', '27');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Anuncios clasificados (en medios físicos)', '27');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Anuncios clasificados (en internet)', '27');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Convocatorias', '27');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Llevando hojas de vida a empresas', '27');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Servicio público de empleo del SENA', '27');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('En la bolsa de empleo de egresados de Univalle', '27');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Profesores de la Universidad', '27');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Compañeros de la Universidad', '27');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Amigos (cercanos)', '27');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Personas conocidas (amigos de mis amigos)', '27');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Familiares', '27');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Vecinos', '27');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Si', '28');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('No', '28');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Escrito y fijo', '29');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Escrito e indefinido', '29');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Verbal y fijo', '29');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Verbal e indefinido', '29');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Contrato de prestación de servicios', '29');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Pensión', '30');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Salud', '30');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('ARP', '30');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Primas', '30');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Al menos 10', '31');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Entre 11 y 50', '31');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Entre 51 y 200', '31');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Más de 200', '31');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Menos de un S.M.M.L.V', '32');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('De 1 a 2 S.M.M.L.V', '32');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Más de 2 y hasta 3 S.M.M.L.V', '32');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Más de 3 y hasta 4 S.M.M.L.V', '32');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Más de 4 y hasta 5 S.M.M.L.V', '32');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Más de 5 y hasta 6 S.M.M.L.V', '32');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Más de 6 S.M.M.L.V', '32');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Si', '33');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('No', '33');

INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿En la actualidad usted se encuentra buscando empleo?', '2', '4', '1', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Hace cuántas semanas se encuentra buscando empleo?', '1', '4', '2', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Con qué frecuencia realiza la búsqueda de oportunidades laborales?', '4', '4', '3', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Cuáles de las siguientes alternativas está usando en la búsqueda de empleo?', '3', '4', '4', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('Si está haciendo uso de contactos (amigos, familiares, conocidos, etc) para buscar empleo ¿qué medios usa para comunicarse con ellos?', '3', '4', '5', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Qué tan a menudo se comunica con la(s) persona(s) que le brindó(aron) información sobre la vacante laboral?', '4', '4', '6', '0');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Sí, me encuentro buscando empleo activamente', '34');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Sí, mi búsqueda de empleo es pasiva: no es habitual la búsqueda de oportunidades laborales, pero estoy atento a la información que me llega sobre las vacantes', '34');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('No', '34');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Diariamente', '36');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Una vez por semana', '36');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Varias veces por semana', '36');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Varias veces en el mes', '36');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Ocasionalmente', '36');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Agencia de empleo', '37');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Anuncios clasificados (en medios físicos)', '37');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Anuncios clasificados (en internet)', '37');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Convocatorias', '37');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Llevando hojas de vida a empresas', '37');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Servicio público de empleo del SENA', '37');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('En la bolsa de empleo de egresados de Univalle', '37');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Antiguos empleadores', '37');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Profesores de la Universidad', '37');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Compañeros de la Universidad', '37');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Amigos (cercanos)', '37');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Personas conocidas (amigos de mis amigos)', '37');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Familiares', '37');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Vecinos', '37');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Los visita personalmente', '38');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Los contacta telefonicamente', '38');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Les escribe correos electrónicos', '38');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Los contacta por facebook o redes sociales similares', '38');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Una vez por semana', '39');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Dos o más veces por semana', '39');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Ocasionalmente', '39');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Perdió el contacto con esa(s) persona(s)', '39');

INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('¿Alguna vez ha actuado como intermediario entre una vacante y una persona que se encuentre buscando empleo?', '3', '5', '1', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('uando usted recibe información por un medio virtual (correo electrónico, portal de empleos, redes sociales, etc) sobre una vacante laboral:', '2', '5', '2', '0');
INSERT INTO `univalle_survey_information`.`questions` (`text`, `type`, `block_id`, `weight`, `required`) VALUES ('Por favor escriba tres las principales razones que lo(a) motivan a transmitir información sobre vacantes de empleo', '1', '5', '3', '0');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Sí, he ayudado directamente a que alguien se ubique laboralmente', '40');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Sí, he ayudado de manera indirecta a que alguien se ubique laboralmente', '40');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('Sí, he actudo como intermediario pero la contratación no fue efectiva', '40');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('No he actuado como intermediario para ayudar alguien que busca empleo', '40');

INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('La re-envía a todos sus contactos de correo electrónico o redes sociales, aunque no hayan manifestado que estén buscando empleo', '41');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('La re-envía sólo a sus contactos (no familiares) más cercanos, aunque no hayan manifestado que estén buscando empleo', '41');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('La re-envía sólo a los familiares que puedan estar interesados, aunque no hayan manifestado que estén buscando empleo', '41');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('La re-envía sólo a personas que le hayan manifestado que están buscando empleo', '41');
INSERT INTO `univalle_survey_information`.`answers` (`text`, `question_id`) VALUES ('No la re-envía', '41');

  
CREATE TABLE `univalle_survey_information`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fbid` INT NULL,
  `name` VARCHAR(200) NULL,
  `startDate` INT NULL,
  `finishDate` INT NULL,
  `currentBlock` INT NULL,
  PRIMARY KEY (`id`));
  
CREATE TABLE `univalle_survey_information`.`user_data` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NULL,
  `block_id` INT NULL,
  `results` LONGBLOB NULL,
  PRIMARY KEY (`id`),
  INDEX `user_id_idx` (`user_id` ASC),
  INDEX `block_id_idx` (`block_id` ASC),
  CONSTRAINT `user_data_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `univalle_survey_information`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `block_data_id`
    FOREIGN KEY (`block_id`)
    REFERENCES `univalle_survey_information`.`blocks` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


ALTER TABLE `univalle_survey_information`.`users` 
CHANGE COLUMN `fbid` `fbid` BIGINT UNSIGNED NULL DEFAULT NULL ;



INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología Química', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Interpretación Para Sordos Y Sordociegos', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Recreación', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Atención Prehospitalaria', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Electricidad Industrial Y De Potencia', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología Electrónica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Sistemas De Información', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Alimentos', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Manejo Y Conservación De Suelos Y Aguas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Ecología Y Manejo Ambiental', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología Agroambiental', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Logística Portuaria Y Del Transporte', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Mantenimiento De Equipo Portuario Y Del Transporte', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Topografía', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Administración De Empresas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Gestión Ejecutiva - Convenio Eustaquio Palacios (ceres)', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Administración De Empresas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Gestión Portuaria', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Dirección De Empresas Turísticas Y Hoteleras', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Gestión Ejecutiva', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Tecnología En Gestión Ejecutiva', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Biología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Biología Énfasis En Botánica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Biología Énfasis Entomología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Biología Énfasis En Genética', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Biología Énfasis En Marina', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Biología Énfasis En Zoología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Física', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Matemáticas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Química', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización Tecnológica En Química Con Énfasis En Técnicas Modernas De Análisis Instrumental', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Historia', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Trabajo Social', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Filosofía', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Historia', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Literatura', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Lenguas Modernas (diurna)', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Lenguas Modernas (vespertina)', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Ciencias Sociales', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Comercio Exterior', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Profesional En Filosofía', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Geografía', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Lenguas Extranjeras Inglés - Francés', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Educación Básica Con Énfasis En Ciencias Sociales (noc)', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Letras', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Economía', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Economía Industrial', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Sociología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Profesional En Ciencias Del Deporte', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Profesional En Ciencias Del Deporte', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Educación Inglés-español', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Educación Lenguas Modernas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Matemática', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Física', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Biología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Química', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Educación Matemática - Física', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Biología Y Química', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Educación Física Y Salud', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Consejería Psicológica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Psicología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Educación Primaria', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Profesional En Recreación', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Recreación', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Educación Básica Con Énfasis En Ciencias Naturales Y Educación Ambiental', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Educación Básica Con Énfasis En Matemáticas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Educación Biología - Química Ppd', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Ciencias Agropecuarias (ppd)', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Electricidad Y Electrónica (ppd)', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Dibujo De La Construcción (ppd)', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura Dibujo Mecánico (ppd)', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Educación Física Y Deportes', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Educación Popular', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Matemáticas Y Física', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Estudios Políticos Y Resolución De Conflictos', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Música', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Danza Clásica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Arquitectura', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Comunicación Social', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Diseño', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Diseño Industrial', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Diseño Grafico', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Música', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Arte Dramático', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Licenciatura En Artes Visuales', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Enfermería General', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Enfermería', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Fisioterapia', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Bacteriología Y Laboratorio Clínico', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Fonoaudiología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Terapia Ocupacional', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Medicina Y Cirugía', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Odontología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Ingeniería Topográfica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Ingeniería De Materiales', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Ingeniería De Sistemas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Ingeniería Electrónica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Ingeniería Agrícola', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Ingeniería Eléctrica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Ingeniería Civil', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Ingeniería Mecánica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Ingeniería Química', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Ingeniería Sanitaria', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Ingeniería Industrial', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Estadística', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Ingeniería De Alimentos', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Ingeniería Sanitaria Y Ambiental', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Contaduría Pública', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Administración De Empresas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Comercio Exterior', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Etnobiología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Entomología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Gerontología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Desarrollo Comunitario', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Enseñanza De Ciencias Sociales - Historia De Colombia', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Bilingüismo', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Traducción', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Ética Y Derechos Humanos', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Pensamiento Político Contemporáneo', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Educación Bilingüe', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Enseñanza De La Lectura Y Escritura En Lengua Materna', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Teoría, Métodos Y Técnicas En Investigación Social', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Intervención Con Familias', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Intervención Social Con Familias', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Intervención Social Comunitaria', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Teoría Y Métodos De Investigación En Sociología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Desarrollo De Agroindustrias Rurales', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Economía Solidaria', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Procesos De Intervención Social', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Psicología Del Nino', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Procesos Psicosociales Para La Efectividad Organizacional', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Docencia Universitaria', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Enseñanza De Las Ciencias Naturales', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Administración De La Educación', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Educación Matemática', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Administración De Empresas De La Construcción', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Paisajismo', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Educación Musical', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Practicas Audiovisuales', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Comunicación Y Cultura', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Cirugía General', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Anestesiología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Neurocirugía', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Oftalmología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Otorrinolaringología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Urología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Medicina Física Y Rehabilitación', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Pediatría', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Medicina Interna', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Ginecología Y Obstetricia', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Anatomía Patológica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Psiquiatría', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Dermatología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Radiodiagnóstico', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Anatomía Patológica Y Patología Clínica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Ortopedia Y Traumatología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Medicina Familiar', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Nefrología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Cardiología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Administración De Salud', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Bioética', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Auditoria En Salud', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Gastroenterología Y Endoscopia Digestiva', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Neonatología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Cirugía Pediátrica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Cuidado Intensivo', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Enfermería Nefrológica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Enfermería Materno Perinatal', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Enfermería Neonatal', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Salud Familiar', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Periodoncia', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Cirugía Plástica, Estética, Maxilofacial Y De La Mano', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Odontología Pediátrica Y Ortopedia Maxilar', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Ortodoncia', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Rehabilitación Oral', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Dermatología Y Cirugía Dermatológica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Fisioterapia Cardiopulmonar', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Enfermería En Cuidado Critico Del Adulto', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Enfermería En Cuidado A Las Personas Con Heridas Y Ostomías', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Medicina Crítica Y Cuidado Intensivo', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Enfermería En Salud Mental Y Psiquiatría', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Cirugía De Trauma Y Emergencias', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Enfermedades Infecciosas En Pediatría', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Otología Y Neurotología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Ciencias Térmicas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Geomática', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Estructuras', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Computadores Y Sistemas Digitales', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Redes De Comunicación', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Maquinaria Y Equipo Agrícola Y Agroindustrial', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Sistemas De Información', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Automatización Industrial', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Materiales De Ingeniería', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Ingeniería Sanitaria Y Ambiental', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Sistemas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Gestión De La Innovación Tecnológica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Sistemas De Transmisión Y Distribución De Energía Eléctrica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Diseño Y Construcción De Equipo Agroindustrial', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Mecatrónica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Estadística Aplicada', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Logística', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Administración De Empresas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Administración Pública (esap)', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Finanzas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Administración De La Calidad Total Y La Productividad', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Marketing Estratégico', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Políticas Públicas Y Gestión Pública', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Finanzas En Organizaciones Del Sector Salud', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Gestión De La Calidad Y La Productividad', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Negociación Y Contratación Internacional', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Conciliación Y Resolución De Conflictos', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Especialización En Enseñanza - Aprendizaje Del Derecho', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ciencias - Química', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ciencias - Física', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ciencias - Matemáticas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ciencias - Biología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Lingüística Y Español', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Historia Andina', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Filosofía', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Literatura Colombiana Y Latinoamericana', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Historia', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Intervención Social', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Economía Aplicada', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Sociología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Administración De La Educación Énfasis En Dirección Y Gestión', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Educación - Énfasis En Educación Popular Y Desarrollo Comunitario', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Educación - Énfasis En Enseñanza De Las Ciencias', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Educación - Énfasis En Fisiología Del Deporte', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Educación Con Énfasis En Lenguaje Y Educación', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Educación Con Énfasis En Pensamiento Educativo Moderno', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Educación - Énfasis En Planificación Educativa', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Educación - Énfasis En Educación Matemática', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Educación - Énfasis En Enseñanza De Las Ciencias Naturales', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Educación - Énfasis En Pedagogía Del Entrenamiento Deportivo', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Psicología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Administración Educativa (énfasis En Dirección)', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Docencia Universitaria', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Administración Educativa', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Comunicación Y Diseño Cultural', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Arquitectura Y Urbanismo', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Enfermería - Énfasis En Adulto Y Anciano', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Enfermería - Énfasis En Materno Infantil', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Enfermería - Énfasis En Atención Al Niño', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ciencias Biomédicas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Salud Pública', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Salud Ocupacional', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Administración De Salud', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ciencias Básicas Medicas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Farmacología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Bioquímica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Fisiología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Morfología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Microbiología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Epidemiología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Enfermería - Énfasis En Cuidado Al Adulto Y Al Anciano', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Enfermería - Énfasis En Cuidado Materno-infantil', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Enfermería - Énfasis En Cuidado Al Niño', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería - Énfasis En Automática', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería - Énfasis En Ingeniería Civil', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería - Énfasis En Ingeniería Eléctrica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería - Énfasis En Ingeniería Electrónica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería - Énfasis En Ingeniería Industrial', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería - Énfasis En Ingeniería De Los Materiales', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería - Énfasis En Ingeniería Mecánica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería - Énfasis En Ingeniería Química', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería - Énfasis En Ingeniería Sanitaria Y Ambiental', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería - Énfasis En Ingeniería De Sistemas Y Computación', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería - Énfasis En Ingeniería Aeroespacial', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Estadística', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería Industrial Y De Sistemas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Sistemas De Generación De Energía Eléctrica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería Civil', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Automática', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería Sanitaria Y Ambiental', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría Ingeniería Química', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería De Sistemas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Desarrollo Sustentable', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ingeniería De Alimentos', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Administración Industrial Tp', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Administración Industrial Tc', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Administración De Empresas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Ciencias De La Organización', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Políticas Públicas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Administración', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Maestría En Contabilidad', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ciencias Del Mar', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ciencias Químicas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ciencias - Biología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ciencias Físicas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ciencias Matemáticas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ciencias Ambientales', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Humanidades', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Filosofía', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Educación - Área Educación Matemática', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Educación - Área Historia De La Educación Y La Pedagogía', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Educación - Área Del Lenguaje Y Educación', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado Interinstitucional En Educación', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Psicología', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ciencias Biomédicas', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ingeniería', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ingeniería - Énfasis En Ingeniería De Alimentos', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ingeniería - Énfasis En Ciencias De La Computación', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ingeniería - Énfasis En Ingeniería Eléctrica Y Electrónica', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ingeniería - Énfasis En Ingeniería De Los Materiales', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ingeniería - Énfasis En Ingeniería Química', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ingeniería - Énfasis En Ingeniería Sanitaria Y Ambiental', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ingeniería - Énfasis En Ingeniería Industrial', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Ingeniería - Énfasis Mecánica De Sólidos', 11);
INSERT INTO `univalle_survey_information`.`answers` (`text`,`question_id`) VALUES('Doctorado En Administración', 11);



ALTER TABLE `univalle_survey_information`.`questions` 
ADD COLUMN `numeric` TINYINT(4) NULL DEFAULT 0 AFTER `required`,
ADD COLUMN `min` INT(11) NULL AFTER `numeric`,
ADD COLUMN `max` INT(11) NULL AFTER `min`;


UPDATE `univalle_survey_information`.`questions` SET `numeric`='1', `min`='18', `max`='100' WHERE `id`='4';
UPDATE `univalle_survey_information`.`questions` SET `numeric`='1', `min`='0', `max`='6' WHERE `id`='3';
UPDATE `univalle_survey_information`.`questions` SET `numeric`='1', `min`='1960', `max`='2015' WHERE `id`='10';
UPDATE `univalle_survey_information`.`questions` SET `numeric`='1', `min`='1950', `max`='2015' WHERE `id`='15';
UPDATE `univalle_survey_information`.`questions` SET `numeric`='1', `min`='1', `max`='100' WHERE `id`='18';
UPDATE `univalle_survey_information`.`questions` SET `numeric`='1', `min`='0', `max`='1000' WHERE `id`='35';













