CREATE DATABASE  IF NOT EXISTS `univalle_survey_information` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `univalle_survey_information`;
-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: univalle_survey_information
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'Jorge Andres Castro','jcastro','db43c029cd78f1772ccd268179e01e32');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(200) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id_idx` (`question_id`),
  CONSTRAINT `question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=477 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (1,'Masculino',7),(2,'Femenino',7),(3,'Afrodescendiente',8),(4,'Blanco',8),(5,'Indígena',8),(6,'Mestizo',8),(7,'No está casado(a) y vive en pareja hace menos de 2 años',9),(8,'No está  casado (a)  y vive en pareja hace 2 años o más',9),(9,'Está casado (a)',9),(10,'Está separado (a) o divorciado (a)',9),(11,'Está viudo (a)',9),(12,'Está soltero (a)',9),(13,'Jefe (a) del hogar',10),(14,'Pareja, esposo(a), Cónyuge, Compañero(a)',10),(15,'Hijo(a), hijastro(a)',10),(16,'Nieto(a)',10),(17,'Otro  pariente',10),(18,'Otro no pariente',10),(19,'Tecnología Química',11),(20,'Tecnología En Interpretación Para Sordos Y Sordociegos',11),(21,'Tecnología En Recreación',11),(22,'Tecnología En Atención Prehospitalaria',11),(23,'Tecnología En Electricidad Industrial Y De Potencia',11),(24,'Tecnología Electrónica',11),(25,'Tecnología En Sistemas De Información',11),(26,'Tecnología En Alimentos',11),(27,'Tecnología En Manejo Y Conservación De Suelos Y Aguas',11),(28,'Tecnología En Ecología Y Manejo Ambiental',11),(29,'Tecnología Agroambiental',11),(30,'Tecnología En Logística Portuaria Y Del Transporte',11),(31,'Tecnología En Mantenimiento De Equipo Portuario Y Del Transporte',11),(32,'Tecnología En Topografía',11),(33,'Tecnología En Administración De Empresas',11),(34,'Tecnología En Gestión Ejecutiva - Convenio Eustaquio Palacios (ceres)',11),(35,'Tecnología En Administración De Empresas',11),(36,'Tecnología En Gestión Portuaria',11),(37,'Tecnología En Dirección De Empresas Turísticas Y Hoteleras',11),(38,'Tecnología En Gestión Ejecutiva',11),(39,'Tecnología En Gestión Ejecutiva',11),(40,'Biología',11),(41,'Biología Énfasis En Botánica',11),(42,'Biología Énfasis Entomología',11),(43,'Biología Énfasis En Genética',11),(44,'Biología Énfasis En Marina',11),(45,'Biología Énfasis En Zoología',11),(46,'Física',11),(47,'Matemáticas',11),(48,'Química',11),(49,'Especialización Tecnológica En Química Con Énfasis En Técnicas Modernas De Análisis Instrumental',11),(50,'Historia',11),(51,'Trabajo Social',11),(52,'Licenciatura En Filosofía',11),(53,'Licenciatura En Historia',11),(54,'Licenciatura En Literatura',11),(55,'Licenciatura En Lenguas Modernas (diurna)',11),(56,'Licenciatura En Lenguas Modernas (vespertina)',11),(57,'Licenciatura En Ciencias Sociales',11),(58,'Comercio Exterior',11),(59,'Profesional En Filosofía',11),(60,'Geografía',11),(61,'Licenciatura En Lenguas Extranjeras Inglés - Francés',11),(62,'Licenciatura En Educación Básica Con Énfasis En Ciencias Sociales (noc)',11),(63,'Licenciatura En Letras',11),(64,'Economía',11),(65,'Economía Industrial',11),(66,'Sociología',11),(67,'Profesional En Ciencias Del Deporte',11),(68,'Profesional En Ciencias Del Deporte',11),(69,'Licenciatura En Educación Inglés-español',11),(70,'Licenciatura En Educación Lenguas Modernas',11),(71,'Licenciatura En Matemática',11),(72,'Licenciatura En Física',11),(73,'Licenciatura En Biología',11),(74,'Licenciatura En Química',11),(75,'Licenciatura En Educación Matemática - Física',11),(76,'Licenciatura En Biología Y Química',11),(77,'Licenciatura En Educación Física Y Salud',11),(78,'Licenciatura En Consejería Psicológica',11),(79,'Psicología',11),(80,'Licenciatura En Educación Primaria',11),(81,'Profesional En Recreación',11),(82,'Recreación',11),(83,'Licenciatura En Educación Básica Con Énfasis En Ciencias Naturales Y Educación Ambiental',11),(84,'Licenciatura En Educación Básica Con Énfasis En Matemáticas',11),(85,'Licenciatura En Educación Biología - Química Ppd',11),(86,'Licenciatura En Ciencias Agropecuarias (ppd)',11),(87,'Licenciatura En Electricidad Y Electrónica (ppd)',11),(88,'Licenciatura En Dibujo De La Construcción (ppd)',11),(89,'Licenciatura Dibujo Mecánico (ppd)',11),(90,'Licenciatura En Educación Física Y Deportes',11),(91,'Licenciatura En Educación Popular',11),(92,'Licenciatura En Matemáticas Y Física',11),(93,'Estudios Políticos Y Resolución De Conflictos',11),(94,'Licenciatura En Música',11),(95,'Licenciatura En Danza Clásica',11),(96,'Arquitectura',11),(97,'Comunicación Social',11),(98,'Diseño',11),(99,'Diseño Industrial',11),(100,'Diseño Grafico',11),(101,'Música',11),(102,'Licenciatura En Arte Dramático',11),(103,'Licenciatura En Artes Visuales',11),(104,'Enfermería General',11),(105,'Enfermería',11),(106,'Fisioterapia',11),(107,'Bacteriología Y Laboratorio Clínico',11),(108,'Fonoaudiología',11),(109,'Terapia Ocupacional',11),(110,'Medicina Y Cirugía',11),(111,'Odontología',11),(112,'Ingeniería Topográfica',11),(113,'Ingeniería De Materiales',11),(114,'Ingeniería De Sistemas',11),(115,'Ingeniería Electrónica',11),(116,'Ingeniería Agrícola',11),(117,'Ingeniería Eléctrica',11),(118,'Ingeniería Civil',11),(119,'Ingeniería Mecánica',11),(120,'Ingeniería Química',11),(121,'Ingeniería Sanitaria',11),(122,'Ingeniería Industrial',11),(123,'Estadística',11),(124,'Ingeniería De Alimentos',11),(125,'Ingeniería Sanitaria Y Ambiental',11),(126,'Contaduría Pública',11),(127,'Administración De Empresas',11),(128,'Comercio Exterior',11),(129,'Especialización En Etnobiología',11),(130,'Especialización En Entomología',11),(131,'Especialización En Gerontología',11),(132,'Especialización En Desarrollo Comunitario',11),(133,'Especialización En Enseñanza De Ciencias Sociales - Historia De Colombia',11),(134,'Especialización En Bilingüismo',11),(135,'Especialización En Traducción',11),(136,'Especialización En Ética Y Derechos Humanos',11),(137,'Especialización En Pensamiento Político Contemporáneo',11),(138,'Especialización En Educación Bilingüe',11),(139,'Especialización En Enseñanza De La Lectura Y Escritura En Lengua Materna',11),(140,'Especialización En Teoría, Métodos Y Técnicas En Investigación Social',11),(141,'Especialización En Intervención Con Familias',11),(142,'Especialización En Intervención Social Con Familias',11),(143,'Especialización En Intervención Social Comunitaria',11),(144,'Especialización En Teoría Y Métodos De Investigación En Sociología',11),(145,'Especialización En Desarrollo De Agroindustrias Rurales',11),(146,'Especialización En Economía Solidaria',11),(147,'Especialización En Procesos De Intervención Social',11),(148,'Especialización En Psicología Del Nino',11),(149,'Especialización En Procesos Psicosociales Para La Efectividad Organizacional',11),(150,'Especialización En Docencia Universitaria',11),(151,'Especialización En Enseñanza De Las Ciencias Naturales',11),(152,'Especialización En Administración De La Educación',11),(153,'Especialización En Educación Matemática',11),(154,'Especialización En Administración De Empresas De La Construcción',11),(155,'Especialización En Paisajismo',11),(156,'Especialización En Educación Musical',11),(157,'Especialización En Practicas Audiovisuales',11),(158,'Especialización En Comunicación Y Cultura',11),(159,'Especialización En Cirugía General',11),(160,'Especialización En Anestesiología',11),(161,'Especialización En Neurocirugía',11),(162,'Especialización En Oftalmología',11),(163,'Especialización En Otorrinolaringología',11),(164,'Especialización En Urología',11),(165,'Especialización En Medicina Física Y Rehabilitación',11),(166,'Especialización En Pediatría',11),(167,'Especialización En Medicina Interna',11),(168,'Especialización En Ginecología Y Obstetricia',11),(169,'Especialización En Anatomía Patológica',11),(170,'Especialización En Psiquiatría',11),(171,'Especialización En Dermatología',11),(172,'Especialización En Radiodiagnóstico',11),(173,'Especialización En Anatomía Patológica Y Patología Clínica',11),(174,'Especialización En Ortopedia Y Traumatología',11),(175,'Especialización En Medicina Familiar',11),(176,'Especialización En Nefrología',11),(177,'Especialización En Cardiología',11),(178,'Especialización En Administración De Salud',11),(179,'Especialización En Bioética',11),(180,'Especialización En Auditoria En Salud',11),(181,'Especialización En Gastroenterología Y Endoscopia Digestiva',11),(182,'Especialización En Neonatología',11),(183,'Especialización En Cirugía Pediátrica',11),(184,'Especialización En Cuidado Intensivo',11),(185,'Especialización En Enfermería Nefrológica',11),(186,'Especialización En Enfermería Materno Perinatal',11),(187,'Especialización En Enfermería Neonatal',11),(188,'Especialización En Salud Familiar',11),(189,'Especialización En Periodoncia',11),(190,'Especialización En Cirugía Plástica, Estética, Maxilofacial Y De La Mano',11),(191,'Especialización En Odontología Pediátrica Y Ortopedia Maxilar',11),(192,'Especialización En Ortodoncia',11),(193,'Especialización En Rehabilitación Oral',11),(194,'Especialización En Dermatología Y Cirugía Dermatológica',11),(195,'Especialización En Fisioterapia Cardiopulmonar',11),(196,'Especialización En Enfermería En Cuidado Critico Del Adulto',11),(197,'Especialización En Enfermería En Cuidado A Las Personas Con Heridas Y Ostomías',11),(198,'Especialización En Medicina Crítica Y Cuidado Intensivo',11),(199,'Especialización En Enfermería En Salud Mental Y Psiquiatría',11),(200,'Especialización En Cirugía De Trauma Y Emergencias',11),(201,'Especialización En Enfermedades Infecciosas En Pediatría',11),(202,'Especialización En Otología Y Neurotología',11),(203,'Especialización En Ciencias Térmicas',11),(204,'Especialización En Geomática',11),(205,'Especialización En Estructuras',11),(206,'Especialización En Computadores Y Sistemas Digitales',11),(207,'Especialización En Redes De Comunicación',11),(208,'Especialización En Maquinaria Y Equipo Agrícola Y Agroindustrial',11),(209,'Especialización En Sistemas De Información',11),(210,'Especialización En Automatización Industrial',11),(211,'Especialización En Materiales De Ingeniería',11),(212,'Especialización En Ingeniería Sanitaria Y Ambiental',11),(213,'Especialización En Sistemas',11),(214,'Especialización En Gestión De La Innovación Tecnológica',11),(215,'Especialización En Sistemas De Transmisión Y Distribución De Energía Eléctrica',11),(216,'Especialización En Diseño Y Construcción De Equipo Agroindustrial',11),(217,'Especialización En Mecatrónica',11),(218,'Especialización En Estadística Aplicada',11),(219,'Especialización En Logística',11),(220,'Especialización En Administración De Empresas',11),(221,'Especialización En Administración Pública (esap)',11),(222,'Especialización En Finanzas',11),(223,'Especialización En Administración De La Calidad Total Y La Productividad',11),(224,'Especialización En Marketing Estratégico',11),(225,'Especialización En Políticas Públicas Y Gestión Pública',11),(226,'Especialización En Finanzas En Organizaciones Del Sector Salud',11),(227,'Especialización En Gestión De La Calidad Y La Productividad',11),(228,'Especialización En Negociación Y Contratación Internacional',11),(229,'Especialización En Conciliación Y Resolución De Conflictos',11),(230,'Especialización En Enseñanza - Aprendizaje Del Derecho',11),(231,'Maestría En Ciencias - Química',11),(232,'Maestría En Ciencias - Física',11),(233,'Maestría En Ciencias - Matemáticas',11),(234,'Maestría En Ciencias - Biología',11),(235,'Maestría En Lingüística Y Español',11),(236,'Maestría En Historia Andina',11),(237,'Maestría En Filosofía',11),(238,'Maestría En Literatura Colombiana Y Latinoamericana',11),(239,'Maestría En Historia',11),(240,'Maestría En Intervención Social',11),(241,'Maestría En Economía Aplicada',11),(242,'Maestría En Sociología',11),(243,'Maestría En Administración De La Educación Énfasis En Dirección Y Gestión',11),(244,'Maestría En Educación - Énfasis En Educación Popular Y Desarrollo Comunitario',11),(245,'Maestría En Educación - Énfasis En Enseñanza De Las Ciencias',11),(246,'Maestría En Educación - Énfasis En Fisiología Del Deporte',11),(247,'Maestría En Educación Con Énfasis En Lenguaje Y Educación',11),(248,'Maestría En Educación Con Énfasis En Pensamiento Educativo Moderno',11),(249,'Maestría En Educación - Énfasis En Planificación Educativa',11),(250,'Maestría En Educación - Énfasis En Educación Matemática',11),(251,'Maestría En Educación - Énfasis En Enseñanza De Las Ciencias Naturales',11),(252,'Maestría En Educación - Énfasis En Pedagogía Del Entrenamiento Deportivo',11),(253,'Maestría En Psicología',11),(254,'Maestría En Administración Educativa (énfasis En Dirección)',11),(255,'Maestría En Docencia Universitaria',11),(256,'Maestría En Administración Educativa',11),(257,'Maestría En Comunicación Y Diseño Cultural',11),(258,'Maestría En Arquitectura Y Urbanismo',11),(259,'Maestría En Enfermería - Énfasis En Adulto Y Anciano',11),(260,'Maestría En Enfermería - Énfasis En Materno Infantil',11),(261,'Maestría En Enfermería - Énfasis En Atención Al Niño',11),(262,'Maestría En Ciencias Biomédicas',11),(263,'Maestría En Salud Pública',11),(264,'Maestría En Salud Ocupacional',11),(265,'Maestría En Administración De Salud',11),(266,'Maestría En Ciencias Básicas Medicas',11),(267,'Maestría En Farmacología',11),(268,'Maestría En Bioquímica',11),(269,'Maestría En Fisiología',11),(270,'Maestría En Morfología',11),(271,'Maestría En Microbiología',11),(272,'Maestría En Epidemiología',11),(273,'Maestría En Enfermería - Énfasis En Cuidado Al Adulto Y Al Anciano',11),(274,'Maestría En Enfermería - Énfasis En Cuidado Materno-infantil',11),(275,'Maestría En Enfermería - Énfasis En Cuidado Al Niño',11),(276,'Maestría En Ingeniería',11),(277,'Maestría En Ingeniería - Énfasis En Automática',11),(278,'Maestría En Ingeniería - Énfasis En Ingeniería Civil',11),(279,'Maestría En Ingeniería - Énfasis En Ingeniería Eléctrica',11),(280,'Maestría En Ingeniería - Énfasis En Ingeniería Electrónica',11),(281,'Maestría En Ingeniería - Énfasis En Ingeniería Industrial',11),(282,'Maestría En Ingeniería - Énfasis En Ingeniería De Los Materiales',11),(283,'Maestría En Ingeniería - Énfasis En Ingeniería Mecánica',11),(284,'Maestría En Ingeniería - Énfasis En Ingeniería Química',11),(285,'Maestría En Ingeniería - Énfasis En Ingeniería Sanitaria Y Ambiental',11),(286,'Maestría En Ingeniería - Énfasis En Ingeniería De Sistemas Y Computación',11),(287,'Maestría En Ingeniería - Énfasis En Ingeniería Aeroespacial',11),(288,'Maestría En Estadística',11),(289,'Maestría En Ingeniería Industrial Y De Sistemas',11),(290,'Maestría En Sistemas De Generación De Energía Eléctrica',11),(291,'Maestría En Ingeniería Civil',11),(292,'Maestría En Automática',11),(293,'Maestría En Ingeniería Sanitaria Y Ambiental',11),(294,'Maestría Ingeniería Química',11),(295,'Maestría En Ingeniería De Sistemas',11),(296,'Maestría En Desarrollo Sustentable',11),(297,'Maestría En Ingeniería De Alimentos',11),(298,'Maestría En Administración Industrial Tp',11),(299,'Maestría En Administración Industrial Tc',11),(300,'Maestría En Administración De Empresas',11),(301,'Maestría En Ciencias De La Organización',11),(302,'Maestría En Políticas Públicas',11),(303,'Maestría En Administración',11),(304,'Maestría En Contabilidad',11),(305,'Doctorado En Ciencias Del Mar',11),(306,'Doctorado En Ciencias Químicas',11),(307,'Doctorado En Ciencias - Biología',11),(308,'Doctorado En Ciencias Físicas',11),(309,'Doctorado En Ciencias Matemáticas',11),(310,'Doctorado En Ciencias Ambientales',11),(311,'Doctorado En Humanidades',11),(312,'Doctorado En Filosofía',11),(313,'Doctorado En Educación - Área Educación Matemática',11),(314,'Doctorado En Educación - Área Historia De La Educación Y La Pedagogía',11),(315,'Doctorado En Educación - Área Del Lenguaje Y Educación',11),(316,'Doctorado Interinstitucional En Educación',11),(317,'Doctorado En Psicología',11),(318,'Doctorado En Ciencias Biomédicas',11),(319,'Doctorado En Ingeniería',11),(320,'Doctorado En Ingeniería - Énfasis En Ingeniería De Alimentos',11),(321,'Doctorado En Ingeniería - Énfasis En Ciencias De La Computación',11),(322,'Doctorado En Ingeniería - Énfasis En Ingeniería Eléctrica Y Electrónica',11),(323,'Doctorado En Ingeniería - Énfasis En Ingeniería De Los Materiales',11),(324,'Doctorado En Ingeniería - Énfasis En Ingeniería Química',11),(325,'Doctorado En Ingeniería - Énfasis En Ingeniería Sanitaria Y Ambiental',11),(326,'Doctorado En Ingeniería - Énfasis En Ingeniería Industrial',11),(327,'Doctorado En Ingeniería - Énfasis Mecánica De Sólidos',11),(328,'Doctorado En Administración',11),(329,'Técnico',12),(330,'Tecnólogo',12),(331,'Profesional',12),(332,'Especialización',12),(333,'Maestría',12),(334,'Doctorado o Posdoctorado',12),(335,'Antes de iniciar su pregrado',13),(336,'Mientras realizaba su pregrado',13),(337,'Después de obtener el grado',13),(338,'Aún no ha obtenido su primer empleo',13),(339,'Si',15),(340,'No',15),(341,'Agencia de empleo',17),(342,'Anuncios clasificados (en medios físicos)',17),(343,'Anuncios clasificados (en internet) ',17),(344,'Convocatorias ',17),(345,'Llevando hojas de vida a empresas',17),(346,'Servicio público de empleo del SENA',17),(347,'En la bolsa de empleo de egresados de Univalle',17),(348,'Profesores de la Universidad',17),(349,'Compañeros de la Universidad',17),(350,'Amigos (cercanos)',17),(351,'Personas conocidas (amigos de mis amigos)',17),(352,'Familiares',17),(353,'Vecinos',17),(354,'En una reunión familiar',19),(355,'En un evento social',19),(356,'En un evento deportivo',19),(357,'En un evento religioso',19),(358,'En un encuentro casual',19),(359,'Contacto directo (correo, mensaje, llamada)',19),(360,'Otro',19),(361,'Si',20),(362,'No',20),(363,'Si',23),(364,'No',23),(365,'Si',26),(366,'No',26),(367,'Arte, Cultura y Esparcimiento',30),(368,'Asesoría, Capacitación y Análisis',30),(369,'Automatización, Creación, Adaptación y Soluciones Tecnológicas',30),(370,'Ciencias Naturales, Aplicadas y Relacionadas',30),(371,'Deporte',30),(372,'Diseño Gráfico y Publicidad',30),(373,'Educación y Ciencias Sociales',30),(374,'Explotación Primaria y Extractiva',30),(375,'Finanzas, Administración, Contable y Organizacional',30),(376,'Investigación, Diseño y Análisis de Proyectos',30),(377,'Mantenimiento, Montajes y Asistencia Técnica',30),(378,'Manufactura, Fabricación y Ensamble',30),(379,'Medio Ambiente y Gestión Social',30),(380,'Medios de Comunicación (Radio, Televisión y otras)',30),(381,'Mercadeo, Ventas y Servicios (Telecomunicación, Gas, Acueducto y Energía)',30),(382,'Ocupaciones de Dirección y Gerencia',30),(383,'Operación de Equipos',30),(384,'Producción, Calidad y Logística',30),(385,'Transporte',30),(386,'Salud',30),(387,'Servicios Gubernamentales',30),(388,'Servicio Social y Religión',30),(389,'Sistemas',30),(390,'Si',32),(391,'No',32),(392,'Agencia de empleo',33),(393,'Anuncios clasificados (en medios físicos)',33),(394,'Anuncios clasificados (en internet)',33),(395,'Convocatorias',33),(396,'Llevando hojas de vida a empresas',33),(397,'Servicio público de empleo del SENA',33),(398,'En la bolsa de empleo de egresados de Univalle',33),(399,'Profesores de la Universidad',33),(400,'Compañeros de la Universidad',33),(401,'Amigos (cercanos)',33),(402,'Personas conocidas (amigos de mis amigos)',33),(403,'Familiares',33),(404,'Vecinos',33),(405,'Si',34),(406,'No',34),(407,'Escrito y fijo',35),(408,'Escrito e indefinido',35),(409,'Verbal y fijo',35),(410,'Verbal e indefinido',35),(411,'Contrato de prestación de servicios',35),(412,'Pensión',36),(413,'Salud',36),(414,'ARP',36),(415,'Primas',36),(416,'Menos de un S.M.M.L.V',37),(417,'De 1 a 2 S.M.M.L.V',37),(418,'Más de 2 y hasta 3 S.M.M.L.V',37),(419,'Más de 3 y hasta 4 S.M.M.L.V',37),(420,'Más de 4 y hasta 5 S.M.M.L.V',37),(421,'Más de 5 y hasta 6 S.M.M.L.V',37),(422,'Más de 6 S.M.M.L.V',37),(423,'Si',38),(424,'No',38),(425,'En una reunión familiar',40),(426,'En un evento social',40),(427,'En un evento deportivo',40),(428,'En un evento religioso',40),(429,'En un encuentro casual',40),(430,'Contacto directo (correo, mensaje, llamada)',40),(431,'Otro',40),(432,'Si',41),(433,'No',41),(434,'Si',44),(435,'No',44),(436,'Sí, me encuentro buscando empleo activamente',47),(437,'Sí, mi búsqueda de empleo es pasiva: no es habitual la búsqueda de oportunidades laborales, pero estoy atento a la información que me llega sobre las vacantes',47),(438,'No',47),(439,'Diariamente',49),(440,'Una vez por semana',49),(441,'Varias veces por semana',49),(442,'Varias veces en el mes',49),(443,'Ocasionalmente',49),(444,'Agencia de empleo',50),(445,'Anuncios clasificados (en medios físicos)',50),(446,'Anuncios clasificados (en internet)',50),(447,'Convocatorias',50),(448,'Llevando hojas de vida a empresas',50),(449,'Servicio público de empleo del SENA',50),(450,'En la bolsa de empleo de egresados de Univalle',50),(451,'Antiguos empleadores',50),(452,'Profesores de la Universidad',50),(453,'Compañeros de la Universidad',50),(454,'Amigos (cercanos)',50),(455,'Personas conocidas (amigos de mis amigos)',50),(456,'Familiares',50),(457,'Vecinos',50),(458,'Los visita personalmente',51),(459,'Los contacta telefonicamente',51),(460,'Les escribe correos electrónicos',51),(461,'Los contacta por facebook o redes sociales similares',51),(462,'Una vez por semana',52),(463,'Dos o más veces por semana',52),(464,'Ocasionalmente',52),(465,'Perdió el contacto con esa(s) persona(s)',52),(466,'Sí, he ayudado directamente a que alguien se ubique laboralmente',53),(467,'Sí, he ayudado de manera indirecta a que alguien se ubique laboralmente',53),(468,'Sí, he actudo como intermediario pero la contratación no fue efectiva',53),(469,'No he actuado como intermediario para ayudar alguien que busca empleo',53),(470,'La re-envía a todos sus contactos de correo electrónico o redes sociales, aunque no hayan manifestado que estén buscando empleo',54),(471,'La re-envía sólo a sus contactos (no familiares) más cercanos, aunque no hayan manifestado que estén buscando empleo',54),(472,'La re-envía sólo a los familiares que puedan estar interesados, aunque no hayan manifestado que estén buscando empleo',54),(473,'La re-envía sólo a personas que le hayan manifestado que están buscando empleo',54),(474,'No la re-envía',54),(475,'Una vez por semana',56),(476,'Dos o más veces por semana',56);
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `survey_id_idx` (`survey_id`),
  CONSTRAINT `survey_id` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocks`
--

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
INSERT INTO `blocks` VALUES (1,'Información Personal',1,1),(2,'Información del Primer Empleo',1,2),(3,'Información Empleo Actual',1,3),(4,'Búsqueda de Empleo',1,4),(5,'Redes Sociales',1,5);
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edges`
--

DROP TABLE IF EXISTS `edges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `edges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` int(11) DEFAULT NULL,
  `target` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edges`
--

LOCK TABLES `edges` WRITE;
/*!40000 ALTER TABLE `edges` DISABLE KEYS */;
INSERT INTO `edges` VALUES (1,1,2),(2,1,4),(3,4,3),(4,5,1),(5,6,1);
/*!40000 ALTER TABLE `edges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nodes`
--

DROP TABLE IF EXISTS `nodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nodes`
--

LOCK TABLES `nodes` WRITE;
/*!40000 ALTER TABLE `nodes` DISABLE KEYS */;
INSERT INTO `nodes` VALUES (1,71,'Jorge Andres Castro',1),(2,0,'Guerrilla Mobile Berlin GmbH',4),(3,0,'Softgames',4),(4,0,'Markus Stuebing',3),(5,0,'Roland Castillo',3),(6,0,'Iván Sanabria',3);
/*!40000 ALTER TABLE `nodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(200) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `block_id` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `required` tinyint(4) DEFAULT '0',
  `numeric` tinyint(4) DEFAULT '0',
  `min` int(11) DEFAULT NULL,
  `max` int(11) DEFAULT NULL,
  `has_dependent` tinyint(4) DEFAULT '0',
  `depends_of` int(11) DEFAULT NULL,
  `description` varchar(145) DEFAULT NULL,
  `editable` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `block_id_idx` (`block_id`),
  CONSTRAINT `block_id` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,'ID:',1,1,1,1,0,NULL,NULL,0,NULL,'Tu ID de Facebook',0),(2,'Cédula:',1,1,2,1,0,NULL,NULL,0,NULL,'Ingresa tu número de Cédula',1),(3,'Nombre completo:',1,1,3,1,0,NULL,NULL,0,NULL,NULL,0),(4,'Ciudad de residencia actual:',1,1,4,1,0,NULL,NULL,0,NULL,'Ciudad - Departamento, o si se encuentra fuera de Colombia: Ciudad - País',1),(5,'Estrato socioeconomico de la vivienda donde reside:',1,1,5,1,1,0,6,0,NULL,NULL,1),(6,'¿Su Fecha de Nacimiento es?',1,1,6,1,0,NULL,NULL,0,NULL,NULL,1),(7,'Sexo: ',4,1,7,1,0,NULL,NULL,0,NULL,NULL,1),(8,'Usted se autoreconoce como:',4,1,8,1,0,NULL,NULL,0,NULL,NULL,1),(9,'Hoy usted:',4,1,9,1,0,NULL,NULL,0,NULL,NULL,1),(10,'¿Cual es su parentesco con el jefe de hogar?',4,1,10,1,0,NULL,NULL,0,NULL,NULL,1),(11,'Mencione los títulos que obtuvo en la Universidad del Valle',4,1,11,1,0,NULL,NULL,0,NULL,'Incluya por favor tanto pregrado como postgrado',1),(12,'¿Cuál es su máximo nivel educativo?',4,1,12,1,0,NULL,NULL,0,NULL,NULL,1),(13,'Su primer empleo lo obtuvo: ',4,2,1,1,0,NULL,NULL,0,NULL,NULL,1),(14,'¿En qué año obtuvo su primer empleo?',1,2,2,0,1,1950,2015,0,NULL,NULL,1),(15,'¿Su primer empleo lo obtuvo en una empresa en la trabajó alguno de sus padres, hermanos mayores, o cualquier otro integrante de su grupo familiar?',2,2,3,1,0,NULL,NULL,0,NULL,NULL,1),(16,'Mencione sus últimos tres empleos',5,2,4,0,0,NULL,NULL,1,NULL,'En formato: EMPRESA, DURACIÓN, JEFE DIRECTO',1),(17,'¿Cómo se enteró de la vacante que se convirtió en su primer empleo?',4,2,5,1,0,NULL,NULL,1,NULL,NULL,1),(18,'¿Quién le informó de su primer empleo?',1,2,6,0,0,NULL,NULL,0,17,'Si la persona se encuentra en su red de Facebook, etíquetela. En caso contrario, ingrese el nombre, por favor.',1),(19,'¿En qué tipo de evento le informó de la vacante?',2,2,7,0,0,NULL,NULL,0,17,NULL,1),(20,'¿Estaba empleada cuándo le pasó la información?',2,2,8,0,0,NULL,NULL,1,17,NULL,1),(21,'¿En qué empresa trabajaba?',1,2,9,0,0,NULL,NULL,0,20,'Se refiere a su contacto',1),(22,'¿Cuál era el cargo?',1,2,10,0,0,NULL,NULL,0,20,'Se refiere a su contacto',1),(23,'¿Alguién más le informó a su contacto?',2,2,11,0,0,NULL,NULL,0,17,NULL,1),(24,'¿En qué empresa trabajaba?',1,2,12,0,0,NULL,NULL,0,23,'Se refiere al amigo de su contacto',1),(25,'¿Cuál era el cargo?',1,2,13,0,0,NULL,NULL,0,23,'Se refiere al amigo de su contacto',1),(26,'¿Su empleo actual es su primer empleo?',2,3,1,1,0,NULL,NULL,1,NULL,NULL,1),(27,'¿Cuál es su cargo?',1,3,2,0,0,NULL,NULL,0,26,NULL,1),(28,'Empresa',1,3,3,0,0,NULL,NULL,0,26,NULL,1),(29,'Ciudad',1,3,4,0,0,NULL,NULL,0,26,NULL,1),(30,'¿Cuál es su área de desempeño?',4,3,5,0,0,NULL,NULL,0,26,NULL,1),(31,'¿Hace cuántos meses tiene este empleo?',1,3,6,0,1,0,NULL,0,26,'Si lleva menos de un mes en este empleo escriba cero',1),(32,'¿Para obtener este empleo tuvo que cambiar de ciudad de residencia?',2,3,7,0,0,NULL,NULL,0,26,NULL,1),(33,'¿Cómo obtuvo su actual empleo?',4,3,13,0,0,NULL,NULL,1,26,NULL,1),(34,'¿Se relaciona su actual empleo con lo que estudia o estudió?',2,3,8,0,0,NULL,NULL,0,26,NULL,1),(35,'¿Qué tipo de contrato tiene?',4,3,9,0,0,NULL,NULL,0,26,NULL,1),(36,'En este empleo le reconocen',3,3,10,0,0,NULL,NULL,0,26,NULL,1),(37,'Su ingreso laboral está en el rango:',4,3,11,0,0,NULL,NULL,0,26,NULL,1),(38,'¿Está satisfecho con su trabajo?',2,3,12,0,0,NULL,NULL,0,26,NULL,1),(39,'¿Quién le informó de su empleo actual?',1,3,14,0,0,NULL,NULL,0,33,'Si la persona se encuentra en su red de Facebook, etíquetela. En caso contrario, ingrese el nombre, por favor.',1),(40,'¿En qué tipo de evento le informó de la vacante?',2,3,16,0,0,NULL,NULL,0,33,NULL,1),(41,'¿Estaba empleada cuándo le pasó la información?',2,3,17,0,0,NULL,NULL,1,33,NULL,1),(42,'¿En qué empresa trabajaba?',1,3,18,0,0,NULL,NULL,0,41,'Se refiere a su contacto',1),(43,'¿Cuál era el cargo?',1,3,19,0,0,NULL,NULL,0,41,'Se refiere a su contacto',1),(44,'¿Alguién más le informó a su contacto?',2,3,20,0,0,NULL,NULL,1,33,NULL,1),(45,'¿En qué empresa trabajaba?',1,3,21,0,0,NULL,NULL,0,44,'Se refiere al amigo de su contacto',1),(46,'¿Cuál era el cargo?',1,3,22,0,0,NULL,NULL,0,44,'Se refiere al amigo de su contacto',1),(47,'¿En la actualidad usted se encuentra buscando empleo?',2,4,1,0,0,NULL,NULL,0,NULL,NULL,1),(48,'¿Hace cuántas semanas se encuentra buscando empleo?',1,4,2,0,1,0,1000,0,NULL,NULL,1),(49,'¿Con qué frecuencia realiza la búsqueda de oportunidades laborales?',4,4,3,0,0,NULL,NULL,0,NULL,NULL,1),(50,'¿Cuáles de las siguientes alternativas está usando en la búsqueda de empleo?',3,4,4,0,0,NULL,NULL,0,NULL,NULL,1),(51,'Si está haciendo uso de contactos (amigos, familiares, conocidos, etc) para buscar empleo ¿qué medios usa para comunicarse con ellos?',3,4,5,0,0,NULL,NULL,0,NULL,NULL,1),(52,'¿Qué tan a menudo se comunica con la(s) persona(s) que le brindó(aron) información sobre la vacante laboral?',4,4,6,0,0,NULL,NULL,0,NULL,NULL,1),(53,'¿Alguna vez ha actuado como intermediario entre una vacante y una persona que se encuentre buscando empleo?',3,5,1,0,0,NULL,NULL,0,NULL,NULL,1),(54,'Cuando usted recibe información por un medio virtual (correo electrónico, portal de empleos, redes sociales, etc) sobre una vacante laboral:',2,5,2,0,0,NULL,NULL,0,NULL,NULL,1),(55,'Por favor escriba tres las principales razones que lo(a) motivan a transmitir información sobre vacantes de empleo',5,5,3,0,0,NULL,NULL,0,NULL,NULL,1),(56,'¿Qué tan a menudo se comunica con la persona que le brindó información sobre la vacante laboral?',4,3,15,0,0,NULL,NULL,0,33,NULL,1),(57,'Títulos obtenidos en la Universidad del Valle',6,1,13,0,0,NULL,NULL,0,NULL,NULL,1),(58,'¿En qué empresa obtuvo su primer empleo?',1,2,0,1,0,NULL,NULL,0,NULL,'Ingrese el nombre de la primera empresa en la que laboró',1);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surveys`
--

DROP TABLE IF EXISTS `surveys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surveys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surveys`
--

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;
INSERT INTO `surveys` VALUES (1,'Encuesta Empleo y Comunidades','La plataforma interactiva para la transferencia de información laboral busca recolectar y actualizar la historia laboral, el estado de empleo, los contactos y redes personales de los egresados de la Universidad del Valle, y hacer posible que cada uno de ustedes pueda consultar, en cualquier momento, las trayectorias potenciales que los unen con empleadores y las vacantes disponibles.   La encuesta que tiene ante sus ojos hace parte de la construcción de esa plataforma. Quiere identificar cómo, con la ayuda de amigos, colegas, conocidos, familiares ustedes han recibido, o transferido, información sobre vacantes. Con esa información se desean detectar las redes sociales y las comunidades que comparten y permiten el paso de información laboral entre egresados. Para asegurar la total confidencialidad de la información recibida y procesada, todos los datos serán encriptados. <br/>Muchas gracias por su ayuda.');
/*!40000 ALTER TABLE `surveys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_data`
--

DROP TABLE IF EXISTS `user_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `block_id` int(11) DEFAULT NULL,
  `results` longblob,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `block_id_idx` (`block_id`),
  CONSTRAINT `block_data_id` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_data_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_data`
--

LOCK TABLES `user_data` WRITE;
/*!40000 ALTER TABLE `user_data` DISABLE KEYS */;
INSERT INTO `user_data` VALUES (1,71,1,'a:13:{s:10:\"question_1\";s:17:\"10152613101098041\";s:10:\"question_2\";s:10:\"1032387845\";s:10:\"question_3\";s:27:\"Jorge Andrés Castro Muñoz\";s:10:\"question_4\";s:17:\"Bogotá, Colombia\";s:10:\"question_5\";s:1:\"3\";s:10:\"question_6\";s:10:\"03/19/1987\";s:10:\"question_7\";s:9:\"Masculino\";s:10:\"question_8\";s:16:\"Afrodescendiente\";s:10:\"question_9\";s:58:\"No está  casado (a)  y vive en pareja hace 2 años o más\";s:11:\"question_10\";s:42:\"Pareja, esposo(a), Cónyuge, Compañero(a)\";s:11:\"question_11\";s:24:\"Tecnología Electrónica\";s:11:\"question_12\";s:11:\"Profesional\";s:11:\"question_57\";s:69:\",Tecnología En Ecología Y Manejo Ambiental,Tecnología Electrónica\";}'),(2,71,2,'a:14:{s:11:\"question_58\";s:4:\"ST&T\";s:11:\"question_13\";s:30:\"Mientras realizaba su pregrado\";s:11:\"question_14\";s:4:\"2008\";s:11:\"question_15\";s:2:\"Si\";s:11:\"question_16\";s:46:\"Guerilla Mobile Berlin GmbH\r\nAIESEC\r\nSoftgames\";s:11:\"question_17\";s:17:\"Amigos (cercanos)\";s:11:\"question_18\";s:18:\"Sergio Aristizabal\";s:11:\"question_19\";s:43:\"Contacto directo (correo, mensaje, llamada)\";s:11:\"question_20\";s:2:\"Si\";s:11:\"question_21\";s:4:\"ST&T\";s:11:\"question_22\";s:18:\"Desarrollador .NET\";s:11:\"question_23\";s:2:\"No\";s:11:\"question_24\";s:0:\"\";s:11:\"question_25\";s:0:\"\";}');
/*!40000 ALTER TABLE `user_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fbid` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `startDate` int(11) DEFAULT NULL,
  `finishDate` int(11) DEFAULT NULL,
  `currentBlock` int(11) DEFAULT NULL,
  `fbdata` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (31,10152559445936720,'Alejandro Marin',1420568013,0,1,'b:0;'),(71,10152613101098041,'Jorge AndrÃ©s Castro MuÃ±oz',1424649497,0,3,'a:6:{i:1;s:17:\"10152613101098041\";i:3;s:27:\"Jorge Andrés Castro Muñoz\";i:4;s:17:\"Bogotá, Colombia\";i:6;s:10:\"03/19/1987\";i:7;s:9:\"Masculino\";i:16;a:2:{i:592203934164240;s:27:\"Guerilla Mobile Berlin GmbH\";i:8496751819;s:6:\"AIESEC\";}}');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-11 22:42:30
