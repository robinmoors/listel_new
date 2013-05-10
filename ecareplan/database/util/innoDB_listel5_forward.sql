SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `listel5` DEFAULT CHARACTER SET utf8 ;
USE `listel5` ;

-- -----------------------------------------------------
-- Table `listel5`.`sit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`sit` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`sit` (
  `id` INT(2) NOT NULL AUTO_INCREMENT ,
  `nr` VARCHAR(2) NOT NULL DEFAULT '' ,
  `naam` VARCHAR(30) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) ,
  INDEX `nr_idx` (`nr` ASC) ,
  INDEX `naam_idx` (`naam` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`gemeente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`gemeente` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`gemeente` (
  `id` SMALLINT(4) NOT NULL AUTO_INCREMENT ,
  `zip` SMALLINT(4) NOT NULL DEFAULT '0' ,
  `naam` VARCHAR(50) NOT NULL DEFAULT '' ,
  `dlzip` SMALLINT(4) NOT NULL DEFAULT '0' ,
  `dlnaam` VARCHAR(50) NOT NULL DEFAULT '' ,
  `taal` VARCHAR(8) NOT NULL DEFAULT '' ,
  `sit_id` INT(2) NOT NULL DEFAULT '-1' ,
  `deelvzw` ENUM('H','G') NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `zip_idx` (`zip` ASC) ,
  INDEX `sit_id_idx` (`sit_id` ASC) ,
  CONSTRAINT `FK_gemeente_sid_id`
    FOREIGN KEY (`sit_id` )
    REFERENCES `listel5`.`sit` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 10015
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`verzekering`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`verzekering` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`verzekering` (
  `id` INT(3) NOT NULL AUTO_INCREMENT ,
  `nr` VARCHAR(5) NOT NULL DEFAULT '0' ,
  `naam` VARCHAR(100) NOT NULL DEFAULT '' ,
  `dienst` VARCHAR(40) NOT NULL DEFAULT '' ,
  `contact` VARCHAR(80) NOT NULL DEFAULT '' ,
  `adres` VARCHAR(50) NOT NULL DEFAULT '' ,
  `gem_id` SMALLINT(4) NOT NULL DEFAULT '9999' ,
  `tel` VARCHAR(12) NOT NULL DEFAULT '' ,
  `fax` VARCHAR(12) NOT NULL DEFAULT '' ,
  `gsm` VARCHAR(12) NOT NULL DEFAULT '' ,
  `email` VARCHAR(50) NOT NULL DEFAULT '' ,
  `actief` INT(1) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id`) ,
  INDEX `nr_idx` (`nr` ASC) ,
  INDEX `naam_idx` (`naam` ASC) ,
  INDEX `gem_id_idx` (`gem_id` ASC) ,
  CONSTRAINT `FK_verzekering_gem_id`
    FOREIGN KEY (`gem_id` )
    REFERENCES `listel5`.`gemeente` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 30
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`burgstaat`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`burgstaat` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`burgstaat` (
  `id` INT(2) NOT NULL AUTO_INCREMENT ,
  `omschr` VARCHAR(50) NOT NULL DEFAULT '' ,
  `actief` INT(1) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id`) ,
  INDEX `actief_idx` (`actief` ASC) ,
  INDEX `omschr_idx` (`omschr` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`patient`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`patient` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`patient` (
  `id` INT(6) NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(20) NOT NULL DEFAULT '' ,
  `naam` VARCHAR(25) NOT NULL DEFAULT '' ,
  `voornaam` VARCHAR(25) NOT NULL DEFAULT '' ,
  `sex` TINYINT(1) NOT NULL DEFAULT '1' ,
  `gebdatum` INT(8) NOT NULL DEFAULT '0' ,
  `geboorteplaats` VARCHAR(80) NOT NULL ,
  `burgstand_id` INT(2) NOT NULL DEFAULT '1' ,
  `naam_echtg` VARCHAR(25) NOT NULL DEFAULT '' ,
  `voornaam_echtg` VARCHAR(25) NOT NULL DEFAULT '' ,
  `adres` VARCHAR(50) NOT NULL DEFAULT '' ,
  `gem_id` SMALLINT(4) NOT NULL DEFAULT '0' ,
  `tel` VARCHAR(20) NOT NULL DEFAULT '' ,
  `gsm` VARCHAR(20) NOT NULL DEFAULT '' ,
  `woonsit` INT(1) NOT NULL DEFAULT '1' ,
  `mantelz` INT(1) NOT NULL DEFAULT '1' ,
  `alarm` INT(1) NOT NULL DEFAULT '0' ,
  `mut_id` INT(3) NOT NULL DEFAULT '1' ,
  `email` VARCHAR(50) NOT NULL DEFAULT '' ,
  `actief` INT(1) NOT NULL DEFAULT '1' ,
  `type` INT(2) NOT NULL DEFAULT '0' ,
  `mutnr` VARCHAR(25) NOT NULL DEFAULT '' ,
  `rijksregister` VARCHAR(11) NULL DEFAULT NULL ,
  `startdatum` INT(8) NULL DEFAULT NULL ,
  `stopzetting_text` TINYTEXT NOT NULL ,
  `stopzetting_cat` INT(1) NOT NULL DEFAULT '0' ,
  `einddatum` INT(8) NOT NULL DEFAULT '0' ,
  `minimum_subsidiestatus` INT(11) NOT NULL DEFAULT '1' ,
  `subsidiestatus` ENUM('niet-verdedigbaar','verdedigbaar','verdedigd','niet-verdedigd','ok') NOT NULL DEFAULT 'niet-verdedigbaar' ,
  `tp_record` INT(11) NULL DEFAULT NULL ,
  `omb_actief` TINYINT(1) NOT NULL DEFAULT '0' ,
  `omb_bron` VARCHAR(20) NULL DEFAULT NULL ,
  `login` VARCHAR(40) NOT NULL DEFAULT '' ,
  `paswoord` VARCHAR(40) NOT NULL DEFAULT '' ,
  `pwd_recovery` VARCHAR(40) NOT NULL DEFAULT '' ,
  `geheime_vraag` VARCHAR(200) NOT NULL DEFAULT '' ,
  `geheim_antwoord` VARCHAR(200) NOT NULL DEFAULT '' ,
  `ipadres` VARCHAR(40) NOT NULL DEFAULT '' ,
  `logindatum` INT(11) NOT NULL DEFAULT '0' ,
  `validatiestatus` ENUM('geenkeuze','halfweg','gevalideerd','weigering') NOT NULL DEFAULT 'geenkeuze' ,
  `aanvraagdatum` DATE NOT NULL DEFAULT '1000-01-01' ,
  `validatiedatum` DATE NOT NULL DEFAULT '1000-01-01' ,
  `weigerdatum` DATE NOT NULL DEFAULT '1000-01-01' ,
  `toegewezen_genre` ENUM('gemeente','rdc','hulp','psy') NOT NULL DEFAULT 'gemeente' ,
  `toegewezen_id` INT(11) NULL DEFAULT NULL ,
  `menos` TINYINT(4) NOT NULL DEFAULT '0' ,
  `toestemming_zh` TINYINT(1) NOT NULL DEFAULT '0' ,
  `zorgtraject_diabetes` TINYINT(4) NOT NULL ,
  `zorgtraject_nieren` TINYINT(4) NOT NULL ,
  `zorgtraject_datum` DATE NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `code` (`code` ASC) ,
  UNIQUE INDEX `pat_id` (`id` ASC) ,
  INDEX `gem_id_idx` (`gem_id` ASC) ,
  INDEX `mut_id_idx` (`mut_id` ASC) ,
  INDEX `burgstand_id_idx` (`burgstand_id` ASC) ,
  CONSTRAINT `FK_patient_gem_id`
    FOREIGN KEY (`gem_id` )
    REFERENCES `listel5`.`gemeente` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_patient_mut_id`
    FOREIGN KEY (`mut_id` )
    REFERENCES `listel5`.`verzekering` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_patient_burgstand_id`
    FOREIGN KEY (`burgstand_id` )
    REFERENCES `listel5`.`burgstaat` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 1513
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`aanvraag_overdracht`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`aanvraag_overdracht` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`aanvraag_overdracht` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `patient` VARCHAR(20) NOT NULL DEFAULT '' ,
  `van_genre` ENUM('gemeente','rdc','hulp','psy') CHARACTER SET 'utf8' NOT NULL ,
  `van_id` INT(11) NOT NULL DEFAULT '0' ,
  `naar_genre` ENUM('gemeente','rdc','hulp','psy') CHARACTER SET 'utf8' NOT NULL ,
  `naar_id` INT(11) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  INDEX `van_genre_idx` (`van_genre` ASC) ,
  INDEX `van_id_idx` (`van_id` ASC) ,
  INDEX `patient_idx` (`patient` ASC) ,
  CONSTRAINT `FK_aanvraag_overdracht_patient`
    FOREIGN KEY (`patient` )
    REFERENCES `listel5`.`patient` (`code` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 55
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`persoon`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`persoon` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`persoon` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `persoon_type` CHAR(3) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`functiegroepen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`functiegroepen` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`functiegroepen` (
  `id` INT(3) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(30) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`functies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`functies` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`functies` (
  `id` INT(3) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(40) NOT NULL DEFAULT 'nieuwe functie' ,
  `groep_id` INT(3) NOT NULL DEFAULT '0' ,
  `rangorde` INT(3) NOT NULL DEFAULT '0' ,
  `actief` INT(1) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id`) ,
  INDEX `rangorde_idx` (`rangorde` ASC) ,
  INDEX `actief_idx` (`actief` ASC) ,
  INDEX `groep_id_idx` (`groep_id` ASC) ,
  CONSTRAINT `FK_functies_groep_id`
    FOREIGN KEY (`groep_id` )
    REFERENCES `listel5`.`functiegroepen` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 128
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`organisatie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`organisatie` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`organisatie` (
  `id` INT(11) NOT NULL ,
  `naam` VARCHAR(150) NOT NULL DEFAULT '' ,
  `adres` VARCHAR(75) NOT NULL DEFAULT '' ,
  `gem_id` SMALLINT(4) NOT NULL DEFAULT '9999' ,
  `tel` VARCHAR(20) NOT NULL DEFAULT '' ,
  `fax` VARCHAR(20) NOT NULL DEFAULT '' ,
  `gsm` VARCHAR(20) NOT NULL DEFAULT '' ,
  `reknr` VARCHAR(20) NOT NULL DEFAULT '' ,
  `iban` VARCHAR(34) NOT NULL DEFAULT '' ,
  `bic` VARCHAR(11) NOT NULL DEFAULT '' ,
  `contact_inhoudelijk` VARCHAR(60) NOT NULL DEFAULT '' ,
  `email_inhoudelijk` VARCHAR(80) NOT NULL DEFAULT '' ,
  `contact_administratie` VARCHAR(60) NOT NULL DEFAULT '' ,
  `email_administratie` VARCHAR(80) NOT NULL DEFAULT '' ,
  `actief` INT(1) NOT NULL DEFAULT '1' ,
  `genre` ENUM('ZVL','HVL','XVL','XVLNP','XVLP') NULL DEFAULT NULL ,
  `hoofdzetel` INT(11) NOT NULL DEFAULT '-1' ,
  `ggz` TINYINT(4) NOT NULL DEFAULT '0' ,
  `art107` TINYINT(4) NOT NULL DEFAULT '0' ,
  `mobiele_equipe` TINYINT(4) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  INDEX `naam_idx` (`naam` ASC) ,
  INDEX `gem_id_idx` (`gem_id` ASC) ,
  CONSTRAINT `FK_organisatie_id`
    FOREIGN KEY (`id` )
    REFERENCES `listel5`.`persoon` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_organisatie_gem_id`
    FOREIGN KEY (`gem_id` )
    REFERENCES `listel5`.`gemeente` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 1909
DEFAULT CHARACTER SET = utf8
PACK_KEYS = 0;


-- -----------------------------------------------------
-- Table `listel5`.`hulpverleners`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`hulpverleners` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`hulpverleners` (
  `id` INT(11) NOT NULL ,
  `naam` VARCHAR(25) NOT NULL DEFAULT '' ,
  `voornaam` VARCHAR(25) NOT NULL DEFAULT '' ,
  `fnct_id` INT(3) NOT NULL DEFAULT '0' ,
  `tel` VARCHAR(20) NOT NULL DEFAULT '' ,
  `adres` VARCHAR(50) NOT NULL DEFAULT '' ,
  `gem_id` SMALLINT(4) NOT NULL DEFAULT '9999' ,
  `email` VARCHAR(50) NOT NULL DEFAULT '' ,
  `reknr` VARCHAR(20) NOT NULL DEFAULT '' ,
  `iban` VARCHAR(34) NOT NULL DEFAULT '' ,
  `bic` VARCHAR(11) NOT NULL DEFAULT '' ,
  `riziv1` INT(6) NOT NULL DEFAULT '0' ,
  `riziv2` INT(2) NOT NULL DEFAULT '0' ,
  `riziv3` INT(3) NOT NULL DEFAULT '0' ,
  `organisatie` INT(11) NULL DEFAULT NULL ,
  `convenant` ENUM('afgesloten','gezamenlijk','niet') NULL DEFAULT NULL ,
  `fax` VARCHAR(20) NOT NULL DEFAULT '' ,
  `gsm` VARCHAR(20) NOT NULL DEFAULT '' ,
  `actief` INT(1) NOT NULL DEFAULT '1' ,
  `mag_weg` TINYINT(1) NOT NULL DEFAULT '0' ,
  `vervangt` INT(11) NULL DEFAULT NULL ,
  `login` VARCHAR(40) NOT NULL DEFAULT '' ,
  `paswoord` VARCHAR(40) NOT NULL DEFAULT '' ,
  `pwd_recovery` VARCHAR(40) NOT NULL DEFAULT '' ,
  `geheime_vraag` VARCHAR(200) NOT NULL DEFAULT '' ,
  `geheim_antwoord` VARCHAR(200) NOT NULL DEFAULT '' ,
  `ipadres` VARCHAR(40) NOT NULL DEFAULT '' ,
  `logindatum` INT(11) NOT NULL DEFAULT '0' ,
  `validatiestatus` ENUM('geenkeuze','aanvraag','halfweg','gevalideerd','weigering') NOT NULL DEFAULT 'geenkeuze' ,
  `aanvraagdatum` DATE NOT NULL DEFAULT '1000-01-01' ,
  `validatiedatum` DATE NOT NULL DEFAULT '1000-01-01' ,
  `weigerdatum` DATE NOT NULL DEFAULT '1000-01-01' ,
  `is_organisator` INT(1) NOT NULL DEFAULT '0' ,
  `sociale_kaart` INT(11) NOT NULL DEFAULT '0' ,
  `sociale_functie` VARCHAR(200) NOT NULL DEFAULT '' ,
  `sociale_email` INT(11) NOT NULL DEFAULT '0' ,
  `sociale_tel` INT(11) NOT NULL DEFAULT '0' ,
  `sociale_fax` INT(11) NOT NULL DEFAULT '0' ,
  `gedetacheerd_ggz` TINYINT(1) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  INDEX `naam_idx` (`naam` ASC, `voornaam` ASC) ,
  INDEX `actief_idx` (`actief` ASC) ,
  INDEX `organisatie_idx` (`organisatie` ASC) ,
  INDEX `gem_id_idx` (`gem_id` ASC) ,
  INDEX `fnct_id_idx` (`fnct_id` ASC) ,
  CONSTRAINT `FK_hulpverleners_id`
    FOREIGN KEY (`id` )
    REFERENCES `listel5`.`persoon` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_hulpverleners_gem_id`
    FOREIGN KEY (`gem_id` )
    REFERENCES `listel5`.`gemeente` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_hulpverleners_fnct_id`
    FOREIGN KEY (`fnct_id` )
    REFERENCES `listel5`.`functies` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_hulpverleners_organisatie`
    FOREIGN KEY (`organisatie` )
    REFERENCES `listel5`.`organisatie` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 12227
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`tp_project`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`tp_project` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`tp_project` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `nummer` INT(11) NOT NULL DEFAULT '0' ,
  `naam` VARCHAR(255) NOT NULL DEFAULT '' ,
  `doelgroep` ENUM('kinderen en jongeren','volwassenen','ouderen','forensische kinderen') NULL DEFAULT NULL ,
  `diagnosegenre` ENUM('dsm','icd') NULL DEFAULT NULL ,
  `bijkomend_complexiteit` TEXT NOT NULL ,
  `bijkomend_langdurig` TEXT NOT NULL ,
  `aanvullend1` VARCHAR(120) NULL DEFAULT NULL ,
  `aanvullend2` VARCHAR(120) NULL DEFAULT NULL ,
  `aanvullend3` VARCHAR(120) NULL DEFAULT NULL ,
  `aanvullend4` VARCHAR(120) NULL DEFAULT NULL ,
  `aanvullend5` VARCHAR(120) NULL DEFAULT NULL ,
  `aanvullend6` VARCHAR(120) NULL DEFAULT NULL ,
  `aanvullend7` VARCHAR(120) NULL DEFAULT NULL ,
  `aanvullend8` VARCHAR(120) NULL DEFAULT NULL ,
  `actief` TINYINT(2) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `nummer` (`nummer` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 22
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`logins`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`logins` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`logins` (
  `id` INT(5) NOT NULL AUTO_INCREMENT ,
  `voornaam` VARCHAR(25) NOT NULL DEFAULT '' ,
  `naam` VARCHAR(25) NOT NULL DEFAULT '' ,
  `profiel` ENUM('OC','listel','hoofdproject','bijkomend project','caw','rdc','menos','ziekenhuis','psy') CHARACTER SET 'utf8' NOT NULL DEFAULT 'OC' ,
  `organisatie` INT(11) NULL DEFAULT NULL ,
  `adres` VARCHAR(50) NOT NULL DEFAULT '' ,
  `gem_id` SMALLINT(4) NOT NULL DEFAULT '9999' ,
  `tel` VARCHAR(12) NOT NULL DEFAULT '' ,
  `fax` VARCHAR(12) NOT NULL DEFAULT '' ,
  `gsm` VARCHAR(12) NOT NULL DEFAULT '' ,
  `email` VARCHAR(50) NOT NULL DEFAULT '' ,
  `tp_project` INT(11) NULL DEFAULT NULL ,
  `sit_id` INT(2) NULL DEFAULT NULL ,
  `overleg_gemeente` SMALLINT(4) NULL DEFAULT NULL ,
  `login` VARCHAR(40) NOT NULL DEFAULT '' ,
  `paswoord` VARCHAR(40) NOT NULL DEFAULT '' ,
  `pwd_recovery` VARCHAR(40) NOT NULL ,
  `ipadres` VARCHAR(40) NOT NULL DEFAULT '' ,
  `logindatum` INT(30) NOT NULL DEFAULT '0' ,
  `actief` INT(1) NOT NULL DEFAULT '1' ,
  `loginpin` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `naam_idx` (`naam` ASC, `voornaam` ASC) ,
  INDEX `organisatie_idx` (`organisatie` ASC) ,
  INDEX `tp_project_idx` (`tp_project` ASC) ,
  INDEX `sit_id_idx` (`sit_id` ASC) ,
  INDEX `overleg_gemeente_idx` (`overleg_gemeente` ASC) ,
  CONSTRAINT `FK_logins_organisatie`
    FOREIGN KEY (`organisatie` )
    REFERENCES `listel5`.`organisatie` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_logins_tp_project`
    FOREIGN KEY (`tp_project` )
    REFERENCES `listel5`.`tp_project` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_logins_sit_id`
    FOREIGN KEY (`sit_id` )
    REFERENCES `listel5`.`sit` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_logins_overleg_gemeente`
    FOREIGN KEY (`overleg_gemeente` )
    REFERENCES `listel5`.`gemeente` (`zip` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 474
DEFAULT CHARACTER SET = utf8
PACK_KEYS = 0;


-- -----------------------------------------------------
-- Table `listel5`.`omb_registratie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`omb_registratie` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`omb_registratie` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `auteur` INT(11) NOT NULL DEFAULT '0' ,
  `dag` INT(11) NOT NULL DEFAULT '0' ,
  `maand` INT(11) NOT NULL DEFAULT '0' ,
  `jaar` INT(11) NOT NULL DEFAULT '0' ,
  `dagnummer` INT(11) NOT NULL DEFAULT '0' ,
  `contactwijze` INT(11) NULL DEFAULT NULL ,
  `bekendheid` INT(11) NULL DEFAULT NULL ,
  `doorverwijzing_intern` VARCHAR(40) CHARACTER SET 'utf8' NOT NULL DEFAULT '' ,
  `doorverwijzing_extern` VARCHAR(40) CHARACTER SET 'utf8' NOT NULL DEFAULT '' ,
  `genre_melding` INT(11) NULL DEFAULT NULL ,
  `melder_soort` ENUM('hulpverleners','slachtoffer','ander') CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `melderhvl_id` INT(11) NULL DEFAULT NULL ,
  `melder_naam` VARCHAR(200) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `melder_adres` VARCHAR(100) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `melder_gemeente` SMALLINT(4) NULL DEFAULT NULL ,
  `melder_telefoon` VARCHAR(20) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `melder_email` VARCHAR(120) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `melder_relatie` INT(11) NULL DEFAULT NULL ,
  `melder_relatiedetail` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `slachtoffer_naam` VARCHAR(200) NULL DEFAULT NULL ,
  `slachtoffer_leeftijd` VARCHAR(20) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `slachtoffer_geslacht` ENUM('M','V') CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `slachtoffer_adres` VARCHAR(100) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `slachtoffer_gemeente` SMALLINT(4) NULL DEFAULT NULL ,
  `slachtoffer_telefoon` VARCHAR(40) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `slachtoffer_email` VARCHAR(120) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `slachtoffer_weetmelding` TINYINT(1) NULL DEFAULT NULL ,
  `slachtoffer_ervaartmishandeling` TINYINT(1) NULL DEFAULT NULL ,
  `samenwonen` TINYINT(2) NULL DEFAULT NULL ,
  `samenwonen_detail` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `slachtoffer_meer` TINYINT(4) NULL DEFAULT NULL ,
  `slachtoffer_meer_detail` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `pleger_naam` VARCHAR(200) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `pleger_leeftijd` VARCHAR(20) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `pleger_geslacht` ENUM('M','V') CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `pleger_adres` VARCHAR(200) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `pleger_gemeente` SMALLINT(4) NULL DEFAULT NULL ,
  `pleger_telefoon` VARCHAR(40) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `pleger_opdehoogte` TINYINT(1) NULL DEFAULT NULL ,
  `pleger_relatie` INT(11) NULL DEFAULT NULL ,
  `pleger_relatiedetail` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `plegers_aantal` ENUM('1','2','meer') CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `plegers_extra` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `situatieschets` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `vorige` VARCHAR(80) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `justitie_soort` INT(11) NULL DEFAULT NULL ,
  `justitie_weetmelding` TINYINT(1) NULL DEFAULT NULL ,
  `justitie_detail` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `mantelzorgers_aanwezig` TINYINT(1) NULL DEFAULT NULL ,
  `mantelzorgers_detail` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `contactpersonen_aanwezig` TINYINT(1) NULL DEFAULT NULL ,
  `contactpersonen_detail` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `opvolging_steunpunt` TINYINT(1) NULL DEFAULT NULL ,
  `standvanzaken` INT(11) NULL DEFAULT NULL ,
  `afsluiten_dag` CHAR(2) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `afsluiten_maand` CHAR(2) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `afsluiten_jaar` VARCHAR(4) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `afsluiten_detail` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `afgerond` INT(11) NOT NULL DEFAULT '0' ,
  `omb_bron` VARCHAR(20) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `voorCAW` TINYINT(4) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  INDEX `auteur_idx` (`auteur` ASC) ,
  INDEX `datum_idx` (`jaar` DESC, `maand` DESC, `dag` DESC) ,
  CONSTRAINT `FK_omb_registratie`
    FOREIGN KEY (`auteur` )
    REFERENCES `listel5`.`logins` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 152
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`verwantschap`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`verwantschap` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`verwantschap` (
  `id` INT(2) NOT NULL AUTO_INCREMENT ,
  `naam` VARCHAR(30) NOT NULL DEFAULT '' ,
  `rangorde` INT(2) NOT NULL DEFAULT '0' ,
  `actief` INT(1) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id`) ,
  INDEX `naam_idx` (`naam` ASC) ,
  INDEX `rangorde_idx` (`rangorde` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 34
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`mantelzorgers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`mantelzorgers` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`mantelzorgers` (
  `id` INT(5) NOT NULL ,
  `naam` VARCHAR(50) NOT NULL DEFAULT '' ,
  `voornaam` VARCHAR(50) NOT NULL DEFAULT '' ,
  `verwsch_id` INT(2) NOT NULL DEFAULT '1' ,
  `tel` VARCHAR(20) NOT NULL DEFAULT '' ,
  `fax` VARCHAR(20) NOT NULL DEFAULT '' ,
  `gsm` VARCHAR(20) NOT NULL DEFAULT '' ,
  `adres` VARCHAR(80) NOT NULL DEFAULT '' ,
  `gem_id` SMALLINT(4) NOT NULL DEFAULT '0' ,
  `email` VARCHAR(80) NOT NULL DEFAULT '' ,
  `actief` INT(1) NOT NULL DEFAULT '1' ,
  `login` VARCHAR(40) NOT NULL DEFAULT '' ,
  `paswoord` VARCHAR(40) NOT NULL DEFAULT '' ,
  `pwd_recovery` VARCHAR(40) NOT NULL DEFAULT '' ,
  `geheime_vraag` VARCHAR(200) NOT NULL DEFAULT '' ,
  `geheim_antwoord` VARCHAR(200) NOT NULL DEFAULT '' ,
  `ipadres` VARCHAR(40) NOT NULL DEFAULT '' ,
  `logindatum` INT(11) NOT NULL DEFAULT '0' ,
  `validatiestatus` ENUM('geenkeuze','halfweg','gevalideerd','weigering') NOT NULL DEFAULT 'geenkeuze' ,
  `aanvraagdatum` DATE NOT NULL DEFAULT '1000-01-01' ,
  `validatiedatum` DATE NOT NULL DEFAULT '1000-01-01' ,
  `weigerdatum` DATE NOT NULL DEFAULT '1000-01-01' ,
  PRIMARY KEY (`id`) ,
  INDEX `naam_idx` (`naam` ASC, `voornaam` ASC) ,
  INDEX `verwsch_id_idx` (`verwsch_id` ASC) ,
  INDEX `gem_id_idx` (`gem_id` ASC) ,
  CONSTRAINT `FK_manterzorgers_id`
    FOREIGN KEY (`id` )
    REFERENCES `listel5`.`persoon` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_mantelzorgers_verwsch_id`
    FOREIGN KEY (`verwsch_id` )
    REFERENCES `listel5`.`verwantschap` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_mantelzorgers_gem_id`
    FOREIGN KEY (`gem_id` )
    REFERENCES `listel5`.`gemeente` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 2134
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`katz`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`katz` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`katz` (
  `id` INT(5) NOT NULL AUTO_INCREMENT ,
  `dd` CHAR(2) NOT NULL DEFAULT '0' ,
  `mm` CHAR(2) NOT NULL DEFAULT '0' ,
  `jj` CHAR(4) NOT NULL DEFAULT '0' ,
  `wassen` CHAR(2) NOT NULL DEFAULT '0' ,
  `kleden` CHAR(2) NOT NULL DEFAULT '0' ,
  `verpla` CHAR(2) NOT NULL DEFAULT '0' ,
  `toilet` CHAR(2) NOT NULL DEFAULT '0' ,
  `continent` CHAR(2) NOT NULL DEFAULT '0' ,
  `eten` CHAR(2) NOT NULL DEFAULT '0' ,
  `orient` CHAR(2) NOT NULL DEFAULT '0' ,
  `rust` CHAR(2) NOT NULL DEFAULT '0' ,
  `woon` CHAR(2) NOT NULL DEFAULT '0' ,
  `mantel` CHAR(2) NOT NULL DEFAULT '0' ,
  `sanitair` CHAR(2) NOT NULL DEFAULT '0' ,
  `totaal` INT(2) NOT NULL DEFAULT '0' ,
  `hvl_id` INT(5) NOT NULL DEFAULT '0' ,
  `goedkeuring_inspectie` TINYINT(1) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_katz_hvl_id` (`hvl_id` ASC) ,
  CONSTRAINT `FK_katz_hvl_id`
    FOREIGN KEY (`hvl_id` )
    REFERENCES `listel5`.`hulpverleners` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 217
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`evalinstr`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`evalinstr` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`evalinstr` (
  `ei_id` INT(6) NOT NULL AUTO_INCREMENT ,
  `ei_datum` VARCHAR(30) NOT NULL DEFAULT '0' ,
  `ei_01_01_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_01_01_t` TINYTEXT NOT NULL ,
  `ei_01_02_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_01_02_t` TINYTEXT NOT NULL ,
  `ei_01_03_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_01_03_t` TINYTEXT NOT NULL ,
  `ei_01_04_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_01_04_t` TINYTEXT NOT NULL ,
  `ei_01_05_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_01_05_t` TINYTEXT NOT NULL ,
  `ei_01_06_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_01_06_t` TINYTEXT NOT NULL ,
  `ei_01_07_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_01_07_t` TINYTEXT NOT NULL ,
  `ei_02_01_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_02_01_t` TINYTEXT NOT NULL ,
  `ei_02_02_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_02_02_t` TINYTEXT NOT NULL ,
  `ei_02_03_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_02_03_t` TINYTEXT NOT NULL ,
  `ei_02_04_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_02_04_t` TINYTEXT NOT NULL ,
  `ei_02_05_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_02_05_t` TINYTEXT NOT NULL ,
  `ei_02_06_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_02_06_t` TINYTEXT NOT NULL ,
  `ei_02_07_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_02_07_t` TINYTEXT NOT NULL ,
  `ei_02_08_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_02_08_t` TINYTEXT NOT NULL ,
  `ei_02_09_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_02_09_t` TINYTEXT NOT NULL ,
  `ei_031_01_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_031_01_t` TINYTEXT NOT NULL ,
  `ei_031_02_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_031_02_t` TINYTEXT NOT NULL ,
  `ei_031_03_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_031_03_t` TINYTEXT NOT NULL ,
  `ei_031_04_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_031_04_t` TINYTEXT NOT NULL ,
  `ei_031_05_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_031_05_t` TINYTEXT NOT NULL ,
  `ei_031_06_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_031_06_t` TINYTEXT NOT NULL ,
  `ei_031_07_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_031_07_t` TINYTEXT NOT NULL ,
  `ei_031_08_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_031_08_t` TINYTEXT NOT NULL ,
  `ei_032_01_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_032_01_t` TINYTEXT NOT NULL ,
  `ei_032_02_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_032_02_t` TINYTEXT NOT NULL ,
  `ei_032_03_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_032_03_t` TINYTEXT NOT NULL ,
  `ei_032_04_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_032_04_t` TINYTEXT NOT NULL ,
  `ei_032_05_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_032_05_t` TINYTEXT NOT NULL ,
  `ei_032_06_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_032_06_t` TINYTEXT NOT NULL ,
  `ei_032_07_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_032_07_t` TINYTEXT NOT NULL ,
  `ei_032_08_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_032_08_t` TINYTEXT NOT NULL ,
  `ei_032_09_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_032_09_t` TINYTEXT NOT NULL ,
  `ei_032_10_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_032_10_t` TINYTEXT NOT NULL ,
  `ei_032_11_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_032_11_t` TINYTEXT NOT NULL ,
  `ei_032_12_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_032_12_t` TINYTEXT NOT NULL ,
  `ei_032_13_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_032_13_t` TINYTEXT NOT NULL ,
  `ei_032_14_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_032_14_t` TINYTEXT NOT NULL ,
  `ei_033_01_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_033_01_t` TINYTEXT NOT NULL ,
  `ei_033_02_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_033_02_t` TINYTEXT NOT NULL ,
  `ei_033_03_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_033_03_t` TINYTEXT NOT NULL ,
  `ei_033_04_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_033_04_t` TINYTEXT NOT NULL ,
  `ei_033_05_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_033_05_t` TINYTEXT NOT NULL ,
  `ei_033_06_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_033_06_t` TINYTEXT NOT NULL ,
  `ei_033_07_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_033_07_t` TINYTEXT NOT NULL ,
  `ei_033_08_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_033_08_t` TINYTEXT NOT NULL ,
  `ei_04_01_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_04_01_t` TINYTEXT NOT NULL ,
  `ei_04_02_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_04_02_t` TINYTEXT NOT NULL ,
  `ei_04_03_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_04_03_t` TINYTEXT NOT NULL ,
  `ei_04_04_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_04_04_t` TINYTEXT NOT NULL ,
  `ei_04_05_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_04_05_t` TINYTEXT NOT NULL ,
  `ei_04_06_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_04_06_t` TINYTEXT NOT NULL ,
  `ei_04_07_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_04_07_t` TINYTEXT NOT NULL ,
  `ei_04_08_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_04_08_t` TINYTEXT NOT NULL ,
  `ei_04_09_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_04_09_t` TINYTEXT NOT NULL ,
  `ei_04_10_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_04_10_t` TINYTEXT NOT NULL ,
  `ei_04_11_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_04_11_t` TINYTEXT NOT NULL ,
  `ei_04_12_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_04_12_t` TINYTEXT NOT NULL ,
  `ei_04_13_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_04_13_t` TINYTEXT NOT NULL ,
  `ei_04_14_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_04_14_t` TINYTEXT NOT NULL ,
  `ei_05_01_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_05_01_t` TINYTEXT NOT NULL ,
  `ei_05_02_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_05_02_t` TINYTEXT NOT NULL ,
  `ei_05_03_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_05_03_t` TINYTEXT NOT NULL ,
  `ei_05_04_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_05_04_t` TINYTEXT NOT NULL ,
  `ei_05_05_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_05_05_t` TINYTEXT NOT NULL ,
  `ei_05_06_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_05_06_t` TINYTEXT NOT NULL ,
  `ei_05_07_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_05_07_t` TINYTEXT NOT NULL ,
  `ei_05_08_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_05_08_t` TINYTEXT NOT NULL ,
  `ei_05_09_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_05_09_t` TINYTEXT NOT NULL ,
  `ei_05_10_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_05_10_t` TINYTEXT NOT NULL ,
  `ei_05_11_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_05_11_t` TINYTEXT NOT NULL ,
  `ei_05_12_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_05_12_t` TINYTEXT NOT NULL ,
  `ei_05_13_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_05_13_t` TINYTEXT NOT NULL ,
  `ei_05_14_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_05_14_t` TINYTEXT NOT NULL ,
  `ei_06_01_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_06_01_t` TINYTEXT NOT NULL ,
  `ei_06_02_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_06_02_t` TINYTEXT NOT NULL ,
  `ei_06_03_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_06_03_t` TINYTEXT NOT NULL ,
  `ei_06_04_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_06_04_t` TINYTEXT NOT NULL ,
  `ei_06_05_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_06_05_t` TINYTEXT NOT NULL ,
  `ei_06_06_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_06_06_t` TINYTEXT NOT NULL ,
  `ei_06_07_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_06_07_t` TINYTEXT NOT NULL ,
  `ei_06_08_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_06_08_t` TINYTEXT NOT NULL ,
  `ei_06_09_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_06_09_t` TINYTEXT NOT NULL ,
  `ei_06_10_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_06_10_t` TINYTEXT NOT NULL ,
  `ei_06_11_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_06_11_t` TINYTEXT NOT NULL ,
  `ei_07_01_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_07_01_t` TINYTEXT NOT NULL ,
  `ei_07_02_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_07_02_t` TINYTEXT NOT NULL ,
  `ei_07_03_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_07_03_t` TINYTEXT NOT NULL ,
  `ei_07_04_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_07_04_t` TINYTEXT NOT NULL ,
  `ei_07_05_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_07_05_t` TINYTEXT NOT NULL ,
  `ei_07_06_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_07_06_t` TINYTEXT NOT NULL ,
  `ei_07_07_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_07_07_t` TINYTEXT NOT NULL ,
  `ei_07_08_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_07_08_t` TINYTEXT NOT NULL ,
  `ei_081_01_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_01_t` TINYTEXT NOT NULL ,
  `ei_081_02_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_02_t` TINYTEXT NOT NULL ,
  `ei_081_03_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_03_t` TINYTEXT NOT NULL ,
  `ei_081_04_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_04_t` TINYTEXT NOT NULL ,
  `ei_081_05_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_05_t` TINYTEXT NOT NULL ,
  `ei_081_06_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_06_t` TINYTEXT NOT NULL ,
  `ei_081_07_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_07_t` TINYTEXT NOT NULL ,
  `ei_081_08_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_08_t` TINYTEXT NOT NULL ,
  `ei_081_09_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_09_t` TINYTEXT NOT NULL ,
  `ei_081_10_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_10_t` TINYTEXT NOT NULL ,
  `ei_081_11_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_11_t` TINYTEXT NOT NULL ,
  `ei_081_12_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_12_t` TINYTEXT NOT NULL ,
  `ei_081_13_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_13_t` TINYTEXT NOT NULL ,
  `ei_081_14_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_14_t` TINYTEXT NOT NULL ,
  `ei_081_15_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_15_t` TINYTEXT NOT NULL ,
  `ei_081_16_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_16_t` TINYTEXT NOT NULL ,
  `ei_081_17_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_17_t` TINYTEXT NOT NULL ,
  `ei_081_18_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_18_t` TINYTEXT NOT NULL ,
  `ei_081_19_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_081_19_t` TINYTEXT NOT NULL ,
  `ei_082_01_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_01_t` TINYTEXT NOT NULL ,
  `ei_082_02_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_02_t` TINYTEXT NOT NULL ,
  `ei_082_03_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_03_t` TINYTEXT NOT NULL ,
  `ei_082_04_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_04_t` TINYTEXT NOT NULL ,
  `ei_082_05_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_05_t` TINYTEXT NOT NULL ,
  `ei_082_06_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_06_t` TINYTEXT NOT NULL ,
  `ei_082_07_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_07_t` TINYTEXT NOT NULL ,
  `ei_082_08_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_08_t` TINYTEXT NOT NULL ,
  `ei_082_09_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_09_t` TINYTEXT NOT NULL ,
  `ei_082_10_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_10_t` TINYTEXT NOT NULL ,
  `ei_082_11_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_11_t` TINYTEXT NOT NULL ,
  `ei_082_12_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_12_t` TINYTEXT NOT NULL ,
  `ei_082_13_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_13_t` TINYTEXT NOT NULL ,
  `ei_082_14_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_14_t` TINYTEXT NOT NULL ,
  `ei_082_15_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_15_t` TINYTEXT NOT NULL ,
  `ei_082_16_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_16_t` TINYTEXT NOT NULL ,
  `ei_082_17_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_17_t` TINYTEXT NOT NULL ,
  `ei_082_18_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_18_t` TINYTEXT NOT NULL ,
  `ei_082_19_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_19_t` TINYTEXT NOT NULL ,
  `ei_082_20_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_20_t` TINYTEXT NOT NULL ,
  `ei_082_21_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_21_t` TINYTEXT NOT NULL ,
  `ei_082_22_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_22_t` TINYTEXT NOT NULL ,
  `ei_082_23_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_23_t` TINYTEXT NOT NULL ,
  `ei_082_24_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_24_t` TINYTEXT NOT NULL ,
  `ei_082_25_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_25_t` TINYTEXT NOT NULL ,
  `ei_082_26_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_26_t` TINYTEXT NOT NULL ,
  `ei_082_27_s` INT(1) NOT NULL DEFAULT '0' ,
  `ei_082_27_t` TINYTEXT NOT NULL ,
  `ei_09_01_t` TEXT NOT NULL ,
  PRIMARY KEY (`ei_id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 164
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`factuurmaand`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`factuurmaand` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`factuurmaand` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `genre` ENUM('TP','gewoon','ForK','H','G','TP-H','TP-G','ForK-H','ForK-G') NOT NULL DEFAULT 'TP' ,
  `jaar` INT(11) NOT NULL DEFAULT '0' ,
  `maand` INT(11) NOT NULL DEFAULT '0' ,
  `nummer` INT(11) NOT NULL DEFAULT '0' ,
  `mutualiteit` INT(3) NOT NULL DEFAULT '0' ,
  `factuurdatum` VARCHAR(10) NOT NULL DEFAULT '' ,
  `factuurFile` VARCHAR(200) NULL DEFAULT NULL ,
  `creditActief` TINYINT(4) NULL DEFAULT NULL ,
  `vervangt` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `genre_idx` (`genre` ASC) ,
  INDEX `jaar_idx` (`jaar` ASC) ,
  INDEX `vervangt_idx` (`vervangt` ASC) ,
  INDEX `mutualiteit_idx` (`mutualiteit` ASC) ,
  CONSTRAINT `FK_factuurmaand_vervangt`
    FOREIGN KEY (`vervangt` )
    REFERENCES `listel5`.`factuurmaand` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_factuurmaand_mutualiteit`
    FOREIGN KEY (`mutualiteit` )
    REFERENCES `listel5`.`verzekering` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`overlegbasis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`overlegbasis` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`overlegbasis` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `patient_code` VARCHAR(20) NOT NULL DEFAULT '' ,
  `datum` VARCHAR(10) NOT NULL DEFAULT '' ,
  `locatie` VARCHAR(40) NOT NULL DEFAULT '' ,
  `soort_problematiek` ENUM('fysisch','psychisch') NOT NULL DEFAULT 'fysisch' ,
  `keuze_vergoeding` INT(11) NOT NULL DEFAULT '-88' ,
  `geld_voor_hvl` TINYINT(4) NOT NULL DEFAULT '0' ,
  `afgerond` INT(1) NOT NULL DEFAULT '0' ,
  `controle` INT(11) NOT NULL DEFAULT '0' ,
  `logincode` VARCHAR(16) NOT NULL DEFAULT '' ,
  `genre` ENUM('TP','gewoon','menos','psy') NULL DEFAULT 'gewoon' ,
  `factuur_datum` VARCHAR(14) NULL DEFAULT NULL ,
  `toegewezen_genre` ENUM('gemeente','rdc','hulp','TP','menos','psy') NOT NULL DEFAULT 'gemeente' ,
  `contact_hvl` INT(11) NULL DEFAULT NULL ,
  `contact_mz` INT(11) NULL DEFAULT NULL ,
  `katz_id` INT(5) NULL DEFAULT NULL ,
  `evalinstr_id` INT(6) NULL DEFAULT NULL ,
  `coordinator_id` INT(11) NULL DEFAULT NULL ,
  `factuur_code` INT(11) NULL DEFAULT NULL ,
  `omb_id` INT(11) NULL DEFAULT NULL ,
  `toegewezen_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `patient_id` (`patient_code` ASC, `datum` ASC) ,
  INDEX `afgerond_idx` (`afgerond` ASC) ,
  INDEX `datum_idx` (`datum` ASC) ,
  INDEX `genre_idx` (`genre` ASC) ,
  INDEX `omb_id_idx` (`omb_id` ASC) ,
  INDEX `contact_hvl_idx` (`contact_hvl` ASC) ,
  INDEX `contact_mz_idx` (`contact_mz` ASC) ,
  INDEX `katz_id_idx` (`katz_id` ASC) ,
  INDEX `evalinstr_id_idx` (`evalinstr_id` ASC) ,
  INDEX `coordinator_id_idx` (`coordinator_id` ASC) ,
  INDEX `toegewezen_id_idx` (`toegewezen_id` ASC) ,
  INDEX `factuur_code_idx` (`factuur_code` ASC) ,
  CONSTRAINT `FK_overlegbasis_omb_id`
    FOREIGN KEY (`omb_id` )
    REFERENCES `listel5`.`omb_registratie` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_patient_code`
    FOREIGN KEY (`patient_code` )
    REFERENCES `listel5`.`patient` (`code` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_contact_hvl`
    FOREIGN KEY (`contact_hvl` )
    REFERENCES `listel5`.`hulpverleners` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_contact_mz`
    FOREIGN KEY (`contact_mz` )
    REFERENCES `listel5`.`mantelzorgers` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_katz_id`
    FOREIGN KEY (`katz_id` )
    REFERENCES `listel5`.`katz` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_evalinstr_id`
    FOREIGN KEY (`evalinstr_id` )
    REFERENCES `listel5`.`evalinstr` (`ei_id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_coordinator_id`
    FOREIGN KEY (`coordinator_id` )
    REFERENCES `listel5`.`logins` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_toegewezen_id`
    FOREIGN KEY (`toegewezen_id` )
    REFERENCES `listel5`.`hulpverleners` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_factuur_code`
    FOREIGN KEY (`factuur_code` )
    REFERENCES `listel5`.`factuurmaand` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 432
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`aanvraag_overleg`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`aanvraag_overleg` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`aanvraag_overleg` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `timestamp` INT(11) NOT NULL ,
  `rijksregister` VARCHAR(11) CHARACTER SET 'utf8' NOT NULL ,
  `patient_code` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL ,
  `gemeente_id` SMALLINT(4) NOT NULL ,
  `keuze_organisator` ENUM('ocmw','rdc','hulp','psy') CHARACTER SET 'utf8' NOT NULL ,
  `reden_organisator` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL ,
  `andere_reden_organisator` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL ,
  `id_organisator` INT(11) NOT NULL ,
  `id_organisator_user` INT(11) NULL DEFAULT NULL ,
  `doel_informeren` TINYINT(4) NOT NULL DEFAULT '0' ,
  `doel_overtuigen` TINYINT(4) NOT NULL DEFAULT '0' ,
  `doel_organiseren` TINYINT(4) NOT NULL DEFAULT '0' ,
  `doel_debriefen` TINYINT(4) NOT NULL DEFAULT '0' ,
  `doel_beslissen` TINYINT(4) NOT NULL DEFAULT '0' ,
  `doel_andere` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL ,
  `naam_aanvrager` VARCHAR(120) CHARACTER SET 'utf8' NOT NULL ,
  `discipline_aanvrager` VARCHAR(80) CHARACTER SET 'utf8' NOT NULL ,
  `organisatie_aanvrager` VARCHAR(200) CHARACTER SET 'utf8' NOT NULL ,
  `info_aanvrager` VARCHAR(200) CHARACTER SET 'utf8' NOT NULL ,
  `dringend` TINYINT(4) NOT NULL ,
  `status` ENUM('aanvraag','overname','overname_aangevraagd','overleg','weiger','laat','doorgestuurd') CHARACTER SET 'utf8' NOT NULL ,
  `reden_status` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL ,
  `overleg_id` INT(11) NULL DEFAULT NULL ,
  `ontvangst` VARCHAR(20) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `bron` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `rijksregister_idx` (`rijksregister` ASC) ,
  INDEX `overleg_id_idx` (`overleg_id` ASC) ,
  INDEX `gemeente_id_idx` (`gemeente_id` ASC) ,
  INDEX `id_organisator_idx` (`id_organisator` ASC) ,
  INDEX `patient_code_idx` (`patient_code` ASC) ,
  CONSTRAINT `FK_aanvraag_overleg_patient_code`
    FOREIGN KEY (`patient_code` )
    REFERENCES `listel5`.`patient` (`code` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_aanvraag_overleg_gemeente_id`
    FOREIGN KEY (`gemeente_id` )
    REFERENCES `listel5`.`gemeente` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_aanvraag_overleg_id_organisator`
    FOREIGN KEY (`id_organisator` )
    REFERENCES `listel5`.`hulpverleners` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_aanvraag_overlegbasis_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `listel5`.`overlegbasis` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 377
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`afgeronde_betrokkenen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`afgeronde_betrokkenen` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`afgeronde_betrokkenen` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `overleg_id` INT(11) NOT NULL DEFAULT '0' ,
  `genre` ENUM('hulp','mantel','org','orgpersoon','patient') NOT NULL DEFAULT 'hulp' ,
  `persoon_id` INT(11) NOT NULL DEFAULT '0' ,
  `aanwezig` TINYINT(1) NOT NULL DEFAULT '0' ,
  `namens` INT(11) NULL DEFAULT NULL ,
  `rechten` INT(1) NOT NULL DEFAULT '0' ,
  `overleggenre` ENUM('gewoon','menos') NOT NULL DEFAULT 'gewoon' ,
  `bereikbaarheid` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `persoon_id_idx` (`persoon_id` ASC) ,
  INDEX `overleg_id_idx` (`overleg_id` ASC) ,
  CONSTRAINT `FK_afgeronde_betrokkenen_persoon`
    FOREIGN KEY (`persoon_id` )
    REFERENCES `listel5`.`persoon` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_afgeronde_betrokkenen_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `listel5`.`overlegbasis` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 1496
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`berichten`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`berichten` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`berichten` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `patient` VARCHAR(20) NOT NULL DEFAULT '' ,
  `onderwerp` VARCHAR(200) NOT NULL DEFAULT '' ,
  `boodschap` TEXT NOT NULL ,
  `auteur_genre` VARCHAR(20) NOT NULL DEFAULT '' ,
  `auteur_id` INT(11) NULL DEFAULT NULL ,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  INDEX `patient_idx` (`patient` ASC) ,
  CONSTRAINT `FK_berichten_patient`
    FOREIGN KEY (`patient` )
    REFERENCES `listel5`.`patient` (`code` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 173
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`berichten_bijlage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`berichten_bijlage` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`berichten_bijlage` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `bericht` INT(11) NOT NULL DEFAULT '0' ,
  `bestand` VARCHAR(200) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) ,
  INDEX `bestand_idx` (`bestand` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 54
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`berichten_to`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`berichten_to` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`berichten_to` (
  `bericht` INT(11) NOT NULL DEFAULT '0' ,
  `persoon` INT(11) NOT NULL DEFAULT '0' ,
  `genre` ENUM('rdc','sit','gemeente','login','hulp','mantel','menos') NOT NULL DEFAULT 'gemeente' ,
  `status` ENUM('to','cc') NOT NULL DEFAULT 'to' ,
  `gelezen` INT(1) NOT NULL DEFAULT '0' ,
  `actief` INT(1) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`bericht`, `persoon`, `genre`) ,
  INDEX `persoon_idx` (`persoon` ASC) ,
  CONSTRAINT `FK_berichten_to_bericht`
    FOREIGN KEY (`bericht` )
    REFERENCES `listel5`.`berichten` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_berichten_to`
    FOREIGN KEY (`persoon` )
    REFERENCES `listel5`.`hulpverleners` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`evalinstr_nieuw`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`evalinstr_nieuw` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`evalinstr_nieuw` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `uitvoerder_id` INT(11) NOT NULL ,
  `dd` INT(2) NOT NULL ,
  `mm` INT(2) NOT NULL ,
  `jjjj` INT(4) NOT NULL ,
  `v1_1` TINYINT(4) NOT NULL ,
  `extra1_1` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_2` TINYINT(4) NOT NULL ,
  `extra1_2` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_3` TINYINT(4) NOT NULL ,
  `extra1_3` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_4` TINYINT(4) NOT NULL ,
  `extra1_4` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_5` TINYINT(4) NOT NULL ,
  `extra1_5` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_6` TINYINT(4) NOT NULL ,
  `extra1_6` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_7` TINYINT(4) NOT NULL ,
  `extra1_7` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_8` TINYINT(4) NOT NULL ,
  `extra1_8` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_9` TINYINT(4) NOT NULL ,
  `extra1_9` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_10` TINYINT(4) NOT NULL ,
  `extra1_10` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_11` TINYINT(4) NOT NULL ,
  `extra1_11` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_12` TINYINT(4) NOT NULL ,
  `extra1_12` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_13` TINYINT(4) NOT NULL ,
  `extra1_13` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_14` TINYINT(4) NOT NULL ,
  `extra1_14` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_15` TINYINT(4) NOT NULL ,
  `extra1_15` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_16` TINYINT(4) NOT NULL ,
  `extra1_16` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_17` TINYINT(4) NOT NULL ,
  `extra1_17` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_18` TINYINT(4) NOT NULL ,
  `extra1_18` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_19` TINYINT(4) NOT NULL ,
  `extra1_19` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_20` TINYINT(4) NOT NULL ,
  `extra1_20` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_21` TINYINT(4) NOT NULL ,
  `extra1_21` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v1_22` TINYINT(4) NOT NULL ,
  `extra1_22` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v2_1` TINYINT(4) NOT NULL ,
  `extra2_1` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v2_2` TINYINT(4) NOT NULL ,
  `extra2_2` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v2_3` TINYINT(4) NOT NULL ,
  `extra2_3` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v2_4` TINYINT(4) NOT NULL ,
  `extra2_4` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v2_5` TINYINT(4) NOT NULL ,
  `extra2_5` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v2_6` TINYINT(4) NOT NULL ,
  `extra2_6` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v2_7` TINYINT(4) NOT NULL ,
  `extra2_7` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v2_8` TINYINT(4) NOT NULL ,
  `extra2_8` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v2_9` TINYINT(4) NOT NULL ,
  `extra2_9` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v2_10` TINYINT(4) NOT NULL ,
  `extra2_10` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v2_11` TINYINT(4) NOT NULL ,
  `extra2_11` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v3_1` TINYINT(4) NOT NULL ,
  `extra3_1` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v3_2` TINYINT(4) NOT NULL ,
  `extra3_2` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v3_3` TINYINT(4) NOT NULL ,
  `extra3_3` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v4_1` TINYINT(4) NOT NULL ,
  `extra4_1` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v4_2` TINYINT(4) NOT NULL ,
  `extra4_2` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v4_3` TINYINT(4) NOT NULL ,
  `extra4_3` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v4_4` TINYINT(4) NOT NULL ,
  `extra4_4` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v5_1` TINYINT(4) NOT NULL ,
  `extra5_1` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v5_2` TINYINT(4) NOT NULL ,
  `extra5_2` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v5_3` TINYINT(4) NOT NULL ,
  `extra5_3` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v5_4` TINYINT(4) NOT NULL ,
  `extra5_4` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v5_5` TINYINT(4) NOT NULL ,
  `extra5_5` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v5_6` TINYINT(4) NOT NULL ,
  `extra5_6` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v5_7` TINYINT(4) NOT NULL ,
  `extra5_7` VARCHAR(255) CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v6` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v7` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `v8` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 32
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`evaluatie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`evaluatie` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`evaluatie` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `patient` VARCHAR(20) NOT NULL DEFAULT '' ,
  `datum` VARCHAR(10) NOT NULL DEFAULT '' ,
  `locatie` ENUM('huisbezoek','bureelbezoek','telefonisch','email') NOT NULL DEFAULT 'huisbezoek' ,
  `vooruitgang` TEXT NOT NULL ,
  `katz_id` INT(11) NULL DEFAULT NULL ,
  `uitvoerder_id` INT(11) NOT NULL DEFAULT '0' ,
  `genre` VARCHAR(20) NOT NULL DEFAULT '' ,
  `tp_rechtenOC` TINYINT(1) NULL DEFAULT '1' ,
  `creatiedatum` INT(11) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  INDEX `patient` (`patient` ASC) ,
  INDEX `datum_idx` (`datum` ASC) ,
  INDEX `katz_id_idx` (`katz_id` ASC) ,
  INDEX `uitvoerder_id_idx` (`uitvoerder_id` ASC) ,
  CONSTRAINT `FK_evaluatie_patient`
    FOREIGN KEY (`patient` )
    REFERENCES `listel5`.`patient` (`code` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_evaluatie_uitvoerder_id`
    FOREIGN KEY (`uitvoerder_id` )
    REFERENCES `listel5`.`hulpverleners` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_evaluatie_katz_id`
    FOREIGN KEY (`katz_id` )
    REFERENCES `listel5`.`katz` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 101
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`evaluatie_rechten`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`evaluatie_rechten` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`evaluatie_rechten` (
  `evaluatie` INT(11) NOT NULL DEFAULT '0' ,
  `genre` VARCHAR(60) NOT NULL DEFAULT '' ,
  `id` INT(11) NOT NULL DEFAULT '0' ,
  `rechten` INT(1) NOT NULL DEFAULT '0' ,
  INDEX `evaluatie_idx` (`evaluatie` ASC) ,
  CONSTRAINT `FK_evaluatie_rechten_evaluatie`
    FOREIGN KEY (`evaluatie` )
    REFERENCES `listel5`.`evaluatie` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`factuur`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`factuur` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`factuur` (
  `jaar` VARCHAR(4) NOT NULL DEFAULT '' ,
  `nr` INT(11) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`jaar`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`factuur_organisatie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`factuur_organisatie` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`factuur_organisatie` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `minimum` INT(11) NOT NULL ,
  `maximum` INT(11) NOT NULL ,
  `datum` VARCHAR(12) CHARACTER SET 'utf8' NOT NULL ,
  `deelvzw` ENUM('H','G') CHARACTER SET 'utf8' NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `deelvzw_idx` (`deelvzw` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`huidige_betrokkenen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`huidige_betrokkenen` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`huidige_betrokkenen` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `patient_code` VARCHAR(20) NOT NULL DEFAULT '0' ,
  `genre` ENUM('hulp','mantel','org','orgpersoon','patient') NOT NULL DEFAULT 'hulp' ,
  `persoon_id` INT(11) NOT NULL DEFAULT '0' ,
  `aanwezig` TINYINT(1) NOT NULL DEFAULT '0' ,
  `namens` INT(11) NULL DEFAULT NULL ,
  `rechten` INT(1) NOT NULL DEFAULT '0' ,
  `overleggenre` ENUM('gewoon','menos') NOT NULL DEFAULT 'gewoon' ,
  `bereikbaarheid` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `patient_code_idx` (`patient_code` ASC) ,
  INDEX `aanwezig_idx` (`aanwezig` ASC) ,
  INDEX `genre_idx` (`genre` ASC) ,
  INDEX `overleggenre_idx` (`overleggenre` ASC) ,
  INDEX `persoon_id_idx` (`persoon_id` ASC) ,
  CONSTRAINT `FK_huidige_betrokkenen_persoon_id`
    FOREIGN KEY (`persoon_id` )
    REFERENCES `listel5`.`persoon` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_huidige_betrokkenen_patient_code`
    FOREIGN KEY (`patient_code` )
    REFERENCES `listel5`.`patient` (`code` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 2591
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`katz_aanvraag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`katz_aanvraag` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`katz_aanvraag` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `overleg` INT(11) NOT NULL DEFAULT '0' ,
  `hvl` INT(11) NOT NULL DEFAULT '0' ,
  `wat` VARCHAR(30) NULL DEFAULT 'katz+evaluatie' ,
  `wanneer` INT(11) NOT NULL DEFAULT '1273788000' ,
  PRIMARY KEY (`id`) ,
  INDEX `overleg_id_idx` (`overleg` ASC) ,
  INDEX `FK_katz_aanvraag_hvl` (`hvl` ASC) ,
  CONSTRAINT `FK_katz_aanvraag_overleg`
    FOREIGN KEY (`overleg` )
    REFERENCES `listel5`.`overlegbasis` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_katz_aanvraag_hvl`
    FOREIGN KEY (`hvl` )
    REFERENCES `listel5`.`hulpverleners` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 186
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`logs_ziekenhuis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`logs_ziekenhuis` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`logs_ziekenhuis` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `login` INT(11) NOT NULL ,
  `timestamp` INT(11) NOT NULL ,
  `rijksregister` VARCHAR(11) CHARACTER SET 'utf8' NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_logs_ziekenhuis_login` (`login` ASC) ,
  CONSTRAINT `FK_logs_ziekenhuis_login`
    FOREIGN KEY (`login` )
    REFERENCES `listel5`.`logins` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 84
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`menos_files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`menos_files` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`menos_files` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `patient` VARCHAR(20) NOT NULL DEFAULT '0' ,
  `filename` VARCHAR(200) NOT NULL DEFAULT '' ,
  `alias` VARCHAR(200) NOT NULL DEFAULT '' ,
  `created` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `patient_idx` (`patient` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 36
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`menos_interventie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`menos_interventie` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`menos_interventie` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `datum` VARCHAR(10) CHARACTER SET 'utf8' NOT NULL ,
  `vorm` VARCHAR(60) CHARACTER SET 'utf8' NOT NULL ,
  `subvorm` VARCHAR(200) CHARACTER SET 'utf8' NOT NULL ,
  `vooruitgang` TEXT CHARACTER SET 'utf8' NOT NULL ,
  `uitvoerder_id` INT(11) NOT NULL ,
  `genre` ENUM('menos','hulp','mantel','patient') CHARACTER SET 'utf8' NOT NULL ,
  `patient` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL ,
  `uren` FLOAT NOT NULL ,
  `creatiedatum` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `datum_idx` (`datum` DESC) )
ENGINE = InnoDB
AUTO_INCREMENT = 141
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`omb_probleemfactor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`omb_probleemfactor` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`omb_probleemfactor` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `probleemfactor` VARCHAR(60) CHARACTER SET 'utf8' NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`omb_aanwezigeprobleemfactor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`omb_aanwezigeprobleemfactor` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`omb_aanwezigeprobleemfactor` (
  `registratie_id` INT(11) NOT NULL DEFAULT '0' ,
  `wie` ENUM('slachtoffer','pleger') CHARACTER SET 'utf8' NOT NULL DEFAULT 'slachtoffer' ,
  `probleemfactor` INT(11) NOT NULL DEFAULT '0' ,
  `detail` TEXT CHARACTER SET 'utf8' NOT NULL ,
  PRIMARY KEY (`registratie_id`, `wie`, `probleemfactor`) ,
  INDEX `probleemfactor_idx` (`probleemfactor` ASC) ,
  CONSTRAINT `FK_omb_aanwezigeprobleemfactor_probleemfactor`
    FOREIGN KEY (`probleemfactor` )
    REFERENCES `listel5`.`omb_probleemfactor` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`omb_bekendheid`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`omb_bekendheid` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`omb_bekendheid` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `bekendheid` VARCHAR(60) CHARACTER SET 'utf8' NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`omb_contactwijze`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`omb_contactwijze` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`omb_contactwijze` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `contactwijze` VARCHAR(40) CHARACTER SET 'utf8' NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`omb_hoofdrelatie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`omb_hoofdrelatie` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`omb_hoofdrelatie` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `hoofdrelatie` VARCHAR(60) CHARACTER SET 'utf8' NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 14
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`omb_hulpvorm`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`omb_hulpvorm` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`omb_hulpvorm` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `hulpvorm` VARCHAR(80) CHARACTER SET 'utf8' NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`omb_hulp`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`omb_hulp` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`omb_hulp` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `registratie_id` INT(11) NOT NULL DEFAULT '0' ,
  `genre` INT(11) NOT NULL DEFAULT '0' ,
  `detail` VARCHAR(255) CHARACTER SET 'utf8' NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) ,
  INDEX `registratie_id_idx` (`registratie_id` ASC) ,
  INDEX `genre_idx` (`genre` ASC) ,
  CONSTRAINT `FK_omb_hulp_genre`
    FOREIGN KEY (`genre` )
    REFERENCES `listel5`.`omb_hulpvorm` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 522
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`omb_justitie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`omb_justitie` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`omb_justitie` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `justitie` VARCHAR(60) CHARACTER SET 'utf8' NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`omb_mishandeling`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`omb_mishandeling` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`omb_mishandeling` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `mishandeling` VARCHAR(80) CHARACTER SET 'utf8' NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`omb_mishandelvorm`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`omb_mishandelvorm` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`omb_mishandelvorm` (
  `registratie_id` INT(11) NOT NULL DEFAULT '0' ,
  `mishandeling` INT(11) NOT NULL DEFAULT '0' ,
  `genre` ENUM('aanmelding','opvolging') CHARACTER SET 'utf8' NOT NULL DEFAULT 'aanmelding' ,
  PRIMARY KEY (`registratie_id`, `mishandeling`, `genre`) ,
  INDEX `mishandeling_idx` (`mishandeling` ASC) ,
  CONSTRAINT `FK_omb_mishandelvorm_mishandeling`
    FOREIGN KEY (`mishandeling` )
    REFERENCES `listel5`.`omb_mishandeling` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`omb_pot`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`omb_pot` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`omb_pot` (
  `jaar` INT(11) NOT NULL DEFAULT '0' ,
  `pot` DOUBLE NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`jaar`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`omb_standvanzaken`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`omb_standvanzaken` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`omb_standvanzaken` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `standvanzaken` VARCHAR(60) CHARACTER SET 'utf8' NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`omb_tijd`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`omb_tijd` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`omb_tijd` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `dag` INT(11) NOT NULL DEFAULT '0' ,
  `maand` INT(11) NOT NULL DEFAULT '0' ,
  `jaar` INT(11) NOT NULL DEFAULT '0' ,
  `uur1` INT(11) NOT NULL DEFAULT '0' ,
  `min1` INT(11) NOT NULL DEFAULT '0' ,
  `sec1` INT(11) NOT NULL DEFAULT '0' ,
  `uur2` INT(11) NULL DEFAULT NULL ,
  `min2` INT(11) NULL DEFAULT NULL ,
  `sec2` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 161
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`omb_vraag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`omb_vraag` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`omb_vraag` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `vraag` VARCHAR(40) CHARACTER SET 'utf8' NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`overlegextended`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`overlegextended` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`overlegextended` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `overleg_id` INT(11) NOT NULL ,
  `locatieTekst` VARCHAR(200) NULL DEFAULT NULL ,
  `tijdstip` VARCHAR(80) NULL DEFAULT NULL ,
  `akkoord_patient` TINYINT(4) NULL DEFAULT '1' ,
  `aanwezig_patient` TINYINT(2) NULL DEFAULT '-1' ,
  `vertegenwoordiger` INT(11) NULL DEFAULT NULL ,
  `eval_nieuw` INT(11) NULL DEFAULT NULL ,
  `afronddatum` VARCHAR(10) NULL DEFAULT NULL ,
  `volgende_datum` INT(10) NULL DEFAULT NULL ,
  `verklaring_huisarts` ENUM('thuis','opgenomen') NULL DEFAULT NULL ,
  `ambulant` ENUM('ambulant','ziekenhuis') NULL DEFAULT NULL ,
  `huisarts_belangrijk` TINYINT(1) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `overleg_idx` (`overleg_id` ASC) ,
  CONSTRAINT `FK_overlegextended_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `listel5`.`overlegbasis` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 265
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`overlegtp`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`overlegtp` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`overlegtp` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `overleg_id` INT(11) NOT NULL ,
  `tp_verslag` TEXT NULL DEFAULT NULL ,
  `tp_auteur` ENUM('OC','TP') NULL DEFAULT NULL ,
  `tp_nieuwepartners` TEXT NULL DEFAULT NULL ,
  `tp_rechtenOC` TINYINT(4) NULL DEFAULT '1' ,
  PRIMARY KEY (`id`) ,
  INDEX `overleg_idx` (`overleg_id` ASC) ,
  CONSTRAINT `FK_overlegtp_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `listel5`.`overlegbasis` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 445
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`overlegomb`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`overlegomb` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`overlegomb` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `overleg_id` INT(11) NOT NULL ,
  `omb_factuur` VARCHAR(20) NULL DEFAULT NULL ,
  `omb_actief` INT(11) NULL DEFAULT '0' ,
  `omb_rangorde` INT(11) NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  INDEX `overleg_idx` (`overleg_id` ASC) ,
  CONSTRAINT `FK_overlegomb_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `listel5`.`overlegbasis` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 475
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`overlegorg`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`overlegorg` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`overlegorg` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `overleg_id` INT(11) NOT NULL ,
  `organisatie_factuur` INT(11) NULL DEFAULT NULL ,
  `organisatie_factuur_datum` VARCHAR(12) NULL DEFAULT NULL ,
  `organisatie_dubbel` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `overleg_idx` (`overleg_id` ASC) ,
  CONSTRAINT `FK_overlegorg_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `listel5`.`overlegbasis` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 175
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`overlegpsy`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`overlegpsy` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`overlegpsy` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `overleg_id` INT(11) NOT NULL ,
  `psy_algemeen` TEXT NULL DEFAULT NULL ,
  `psy_doelstellingen` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `overleg_idx` (`overleg_id` ASC) ,
  CONSTRAINT `FK_overlegpsy_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `listel5`.`overlegbasis` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 155
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`overleglok`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`overleglok` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`overleglok` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `overleg_id` INT(11) NOT NULL ,
  `lokaal_algemeen` TEXT NULL DEFAULT NULL ,
  `lokaal_doelstellingen` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `overleg_idx` (`overleg_id` ASC) ,
  CONSTRAINT `FK_overleglok_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `listel5`.`overlegbasis` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 214
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`overleg_files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`overleg_files` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`overleg_files` (
  `overleg_id` INT(11) NOT NULL DEFAULT '0' ,
  `filename` VARCHAR(200) NOT NULL DEFAULT '' ,
  `alias` VARCHAR(200) NOT NULL DEFAULT '' ,
  `created` DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00' ,
  `genre` ENUM('verslag','gewoon') NULL DEFAULT 'gewoon' ,
  `auteurgenre` ENUM('OC','TP') NULL DEFAULT 'OC' ,
  `auteur` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`filename`) ,
  INDEX `genre_idx` (`genre` ASC) ,
  INDEX `overleg_id_idx` (`overleg_id` ASC) ,
  CONSTRAINT `FK_overleg_files_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `listel5`.`overlegbasis` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`overleg_files_rechten`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`overleg_files_rechten` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`overleg_files_rechten` (
  `filename` VARCHAR(200) NOT NULL DEFAULT '' ,
  `genre` VARCHAR(60) NOT NULL DEFAULT '' ,
  `id` INT(11) NOT NULL DEFAULT '0' ,
  `rechten` INT(1) NOT NULL DEFAULT '0' ,
  INDEX `filename_idx` (`filename` ASC) ,
  INDEX `id_idx` (`id` ASC) ,
  CONSTRAINT `FK_overleg_files_rechten_filename`
    FOREIGN KEY (`filename` )
    REFERENCES `listel5`.`overleg_files` (`filename` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`overleg_tp_plan`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`overleg_tp_plan` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`overleg_tp_plan` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `overleg` INT(11) NOT NULL DEFAULT '0' ,
  `persoon` INT(11) NOT NULL DEFAULT '0' ,
  `genre` ENUM('org','orgpersoon','hulp','mantel') NOT NULL DEFAULT 'org' ,
  `plan` VARCHAR(255) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `persoon_op_overleg` (`persoon` ASC, `overleg` ASC, `genre` ASC) ,
  CONSTRAINT `FK_overleg_tp_plan_persoon`
    FOREIGN KEY (`persoon` )
    REFERENCES `listel5`.`mantelzorgers` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 500
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`patient_menos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`patient_menos` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`patient_menos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `patient` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL ,
  `complexe_verzorging` TINYTEXT CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `katz` ENUM('A','B','C') CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `diagnose_dementie` TINYINT(4) NULL DEFAULT NULL ,
  `diagnose` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `edmonton_schaal` TINYINT(4) NULL DEFAULT NULL ,
  `jonger` TINYINT(4) NULL DEFAULT NULL ,
  `uitzondering` TINYINT(4) NOT NULL ,
  `informed_consent` TINYINT(4) NOT NULL ,
  `meetschaal_dag` INT(11) NOT NULL ,
  `meetschaal_maand` INT(11) NOT NULL ,
  `meetschaal_jaar` INT(11) NOT NULL ,
  `economie` TINYINT(4) NOT NULL ,
  `hc` TINYINT(4) NOT NULL ,
  `who` TINYINT(4) NOT NULL ,
  `zarit` TINYINT(4) NOT NULL ,
  `afspraken` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `begindatum` DATE NOT NULL ,
  `einddatum` DATE NULL DEFAULT NULL ,
  `reden` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `menos2gdt_vraag` TINYINT(4) NOT NULL DEFAULT '1' ,
  `menos2gdt_toestemming` TINYINT(4) NOT NULL DEFAULT '1' ,
  `gdt2menos_vraag` TINYINT(4) NOT NULL DEFAULT '1' ,
  `gdt2menos_toestemming` TINYINT(4) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id`) ,
  INDEX `patient` (`patient` ASC) ,
  CONSTRAINT `FK_patient_menos_patient`
    FOREIGN KEY (`patient` )
    REFERENCES `listel5`.`patient` (`code` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 68
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`patient_psy`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`patient_psy` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`patient_psy` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL ,
  `startdatum` INT(8) NULL DEFAULT NULL ,
  `einddatum` INT(8) NULL DEFAULT NULL ,
  `stopzetting_text` TINYTEXT CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `stopzetting_cat` INT(1) NULL DEFAULT NULL ,
  `tp_nummer` INT(11) NULL DEFAULT NULL ,
  `hoofddiagnose` VARCHAR(10) CHARACTER SET 'utf8' NOT NULL ,
  `diagnose_genre` ENUM('dsm','icd') CHARACTER SET 'utf8' NOT NULL ,
  `nood_begeleidingsplan` TINYINT(1) NOT NULL ,
  `toename_symptonen` TINYINT(1) NOT NULL ,
  `ziekenhuis` TINYINT(1) NOT NULL ,
  `art107` TINYINT(1) NOT NULL ,
  `ziekenhuis_ander` TINYINT(1) NOT NULL ,
  `outreach` TINYINT(1) NULL DEFAULT NULL ,
  `cgg` TINYINT(1) NULL DEFAULT NULL ,
  `politie` TINYINT(1) NULL DEFAULT NULL ,
  `domeinen` INT(11) NOT NULL ,
  `crisissituatie` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `crisis_id` INT(11) NULL DEFAULT NULL ,
  `crisis_genre` ENUM('hulp','mantel','referentie') CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `code` (`code` ASC) ,
  INDEX `startdatum_idx` (`startdatum` ASC) ,
  INDEX `code_idx` (`code` ASC) ,
  CONSTRAINT `FK_patient_psy_code`
    FOREIGN KEY (`code` )
    REFERENCES `listel5`.`patient` (`code` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 142
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`patient_secundair`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`patient_secundair` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`patient_secundair` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `patient` VARCHAR(20) NOT NULL DEFAULT '' ,
  `project` INT(11) NOT NULL DEFAULT '0' ,
  `dsm` VARCHAR(20) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) ,
  INDEX `project_idx` (`project` ASC) ,
  INDEX `patient_idx` (`patient` ASC) ,
  INDEX `dsm_idx` (`dsm` ASC) ,
  CONSTRAINT `FK_patient_secundair_project`
    FOREIGN KEY (`project` )
    REFERENCES `listel5`.`tp_project` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_patient_secundair_patient`
    FOREIGN KEY (`patient` )
    REFERENCES `listel5`.`patient` (`code` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 218
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`patient_tp`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`patient_tp` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`patient_tp` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `patient` VARCHAR(20) NOT NULL DEFAULT '' ,
  `project` INT(11) NOT NULL DEFAULT '0' ,
  `begindatum` DATE NOT NULL DEFAULT '1000-01-01' ,
  `einddatum` DATE NULL DEFAULT NULL ,
  `omschrijving` TEXT NULL DEFAULT NULL ,
  `hoofddiagnose` VARCHAR(20) NULL DEFAULT NULL ,
  `diagnosegenre` ENUM('dsm','icd') NOT NULL DEFAULT 'dsm' ,
  `secundairediagnose` VARCHAR(20) NULL DEFAULT NULL ,
  `aanvullend1` TINYINT(1) NOT NULL DEFAULT '0' ,
  `aanvullend2` TINYINT(1) NOT NULL DEFAULT '0' ,
  `aanvullend3` TINYINT(1) NOT NULL DEFAULT '0' ,
  `aanvullend4` TINYINT(1) NOT NULL DEFAULT '0' ,
  `aanvullend5` TINYINT(1) NOT NULL DEFAULT '0' ,
  `aanvullend6` TINYINT(1) NOT NULL DEFAULT '0' ,
  `aanvullend7` TINYINT(1) NOT NULL DEFAULT '0' ,
  `aanvullend8` TINYINT(1) NOT NULL DEFAULT '0' ,
  `opname_overige` VARCHAR(255) NULL DEFAULT NULL ,
  `toestemming` TINYINT(4) NOT NULL DEFAULT '1' ,
  `rechtenOC` VARCHAR(8) NULL DEFAULT NULL ,
  `in_email` TINYINT(1) NOT NULL DEFAULT '0' ,
  `in_print` TINYINT(1) NOT NULL DEFAULT '0' ,
  `uit_email` TINYINT(1) NOT NULL DEFAULT '0' ,
  `uit_print` TINYINT(1) NOT NULL DEFAULT '0' ,
  `stopzetting_text` TINYTEXT NULL DEFAULT NULL ,
  `stopzetting_cat` INT(1) NULL DEFAULT NULL ,
  `actief` TINYINT(4) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id`) ,
  INDEX `actief_idx` (`actief` DESC) ,
  INDEX `einddatum_idx` (`einddatum` DESC) ,
  INDEX `patient_idx` (`patient` ASC) ,
  INDEX `project_idx` (`project` ASC) ,
  CONSTRAINT `FK_patient_tp_project`
    FOREIGN KEY (`project` )
    REFERENCES `listel5`.`tp_project` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_patient_tp_patient`
    FOREIGN KEY (`patient` )
    REFERENCES `listel5`.`patient` (`code` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 165
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`patient_tpopname`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`patient_tpopname` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`patient_tpopname` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `patient` VARCHAR(20) NOT NULL DEFAULT '' ,
  `project` INT(11) NOT NULL DEFAULT '0' ,
  `partner` INT(11) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`) ,
  INDEX `partner_idx` (`partner` ASC) ,
  CONSTRAINT `FK_patient_tpopname_partner`
    FOREIGN KEY (`partner` )
    REFERENCES `listel5`.`organisatie` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 193
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`patient_tpvragen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`patient_tpvragen` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`patient_tpvragen` (
  `patient` VARCHAR(20) NOT NULL DEFAULT '' ,
  `tp` INT(11) NOT NULL DEFAULT '0' ,
  `vraag` INT(11) NOT NULL DEFAULT '0' ,
  `antwoord` INT(11) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`patient`, `tp`, `vraag`, `antwoord`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`patient_zorgtraject`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`patient_zorgtraject` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`patient_zorgtraject` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `patient` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL ,
  `diabetes` TINYINT(4) NOT NULL ,
  `nieren` TINYINT(4) NOT NULL ,
  `datum` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`psy_comorbiditeit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`psy_comorbiditeit` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`psy_comorbiditeit` (
  `patient` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL ,
  `diagnose` VARCHAR(20) CHARACTER SET 'utf8' NOT NULL ,
  `genre` ENUM('dsm','icd') CHARACTER SET 'utf8' NOT NULL ,
  PRIMARY KEY (`patient`, `diagnose`, `genre`) ,
  INDEX `patient` (`patient` ASC) ,
  INDEX `diagnose_idx` (`diagnose` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`psy_crisis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`psy_crisis` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`psy_crisis` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `overleg_id` INT(11) NULL DEFAULT NULL ,
  `crisis_id` INT(11) NULL DEFAULT NULL ,
  `crisis_genre` ENUM('hulp','mantel','referentie') CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  `crisissituatie` TEXT CHARACTER SET 'utf8' NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `overleg_id` (`overleg_id` ASC) ,
  CONSTRAINT `FK_psy_crisis_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `listel5`.`overlegbasis` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 86
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`psy_domeinen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`psy_domeinen` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`psy_domeinen` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `code` VARCHAR(30) CHARACTER SET 'utf8' NOT NULL ,
  `datum` INT(8) NOT NULL ,
  `basis` TINYINT(1) NOT NULL ,
  `woon` TINYINT(1) NOT NULL ,
  `gemeenschap` TINYINT(1) NOT NULL ,
  `taal` TINYINT(1) NOT NULL ,
  `maatschappij` TINYINT(1) NOT NULL ,
  `werk` TINYINT(1) NOT NULL ,
  `gezin` TINYINT(1) NOT NULL ,
  `school` TINYINT(1) NOT NULL ,
  `sociaal` TINYINT(1) NOT NULL ,
  `motoriek` TINYINT(1) NOT NULL ,
  `persoonlijk` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `code` (`code` ASC) ,
  INDEX `datum_idx` (`datum` DESC, `id` DESC) )
ENGINE = InnoDB
AUTO_INCREMENT = 236
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`psy_dsm`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`psy_dsm` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`psy_dsm` (
  `code` VARCHAR(8) CHARACTER SET 'utf8' NOT NULL ,
  `hoofddiagnose` TINYINT(1) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`code`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`psy_plan`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`psy_plan` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`psy_plan` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `domein` VARCHAR(16) CHARACTER SET 'utf8' NOT NULL ,
  `overleg_id` INT(11) NOT NULL ,
  `afspraak` TEXT CHARACTER SET 'utf8' NOT NULL ,
  `einddatum` TEXT CHARACTER SET 'utf8' NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `overleg_id_idx` (`overleg_id` ASC) ,
  CONSTRAINT `FK_psy_plan`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `listel5`.`overlegbasis` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 1008
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`psy_plan_mens`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`psy_plan_mens` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`psy_plan_mens` (
  `plan` INT(11) NOT NULL ,
  `persoon_id` INT(11) NULL DEFAULT NULL ,
  `genre` ENUM('hulp','mantel','patient','oc','ander') CHARACTER SET 'utf8' NOT NULL ,
  INDEX `plan` (`plan` ASC) ,
  INDEX `genre_idx` (`genre` ASC) ,
  INDEX `persoon_id_idx` (`persoon_id` ASC) ,
  CONSTRAINT `FK_psy_plan_mens_plan`
    FOREIGN KEY (`plan` )
    REFERENCES `listel5`.`psy_plan` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_psy_plan_mens_persoon_id`
    FOREIGN KEY (`persoon_id` )
    REFERENCES `listel5`.`persoon` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`riziv_tarieven`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`riziv_tarieven` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`riziv_tarieven` (
  `datum` VARCHAR(8) NOT NULL DEFAULT '' ,
  `thuis` FLOAT NOT NULL DEFAULT '0' ,
  `elders` FLOAT NOT NULL DEFAULT '0' ,
  `registratie` FLOAT NOT NULL DEFAULT '0' ,
  `thuisPVS` FLOAT NOT NULL DEFAULT '0' ,
  `eldersPVS` FLOAT NOT NULL DEFAULT '0' ,
  `registratiePVS` FLOAT NOT NULL DEFAULT '0' ,
  `zhTP` FLOAT NOT NULL DEFAULT '0' ,
  `nietzhTP` FLOAT NOT NULL DEFAULT '0' ,
  `registratie_zhTP` FLOAT NOT NULL DEFAULT '0' ,
  `registratie_nietzhTP` FLOAT NOT NULL DEFAULT '0' ,
  `omb` DOUBLE NOT NULL DEFAULT '30' ,
  `registratieomb` DOUBLE NOT NULL DEFAULT '10' ,
  `organisatie` DOUBLE NOT NULL DEFAULT '43.11' ,
  `actief` TINYINT(1) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`datum`) ,
  INDEX `datum_idx` (`datum` DESC) ,
  INDEX `actief_idx` (`actief` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`taakfiche`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`taakfiche` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`taakfiche` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `ref_id` VARCHAR(40) NOT NULL DEFAULT '0' ,
  `taak` TEXT NOT NULL ,
  `categorie` ENUM('Verzorging','Mobiliteit','Huishouden','Toezicht','Sociaal\r\n\r\nleven','Financieel','Hulpmiddelen','Andere') NOT NULL DEFAULT 'Verzorging' ,
  `frequentie` VARCHAR(80) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`) ,
  INDEX `categorie_idx` (`categorie` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 178
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`taakfiche_mensen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`taakfiche_mensen` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`taakfiche_mensen` (
  `mens_id` INT(11) NOT NULL DEFAULT '0' ,
  `mens_type` VARCHAR(5) NOT NULL DEFAULT '0' ,
  `taakfiche_id` INT(11) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`mens_id`, `mens_type`, `taakfiche_id`) ,
  INDEX `mens_type_idx` (`mens_type` DESC) ,
  INDEX `taakfiche_id_idx` (`taakfiche_id` ASC) ,
  CONSTRAINT `FK_taakfiche_mensen_mens_hvl`
    FOREIGN KEY (`mens_id` )
    REFERENCES `listel5`.`hulpverleners` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_taakfiche_mensen_mens_mz`
    FOREIGN KEY (`mens_id` )
    REFERENCES `listel5`.`mantelzorgers` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_taakfiche_taakfiche_id`
    FOREIGN KEY (`taakfiche_id` )
    REFERENCES `listel5`.`taakfiche` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`tp_alle_dsm`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`tp_alle_dsm` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`tp_alle_dsm` (
  `dsm` VARCHAR(20) NOT NULL DEFAULT '' ,
  `genre` ENUM('dsm','icd') NOT NULL DEFAULT 'dsm' ,
  PRIMARY KEY (`dsm`, `genre`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`tp_antwoorden`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`tp_antwoorden` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`tp_antwoorden` (
  `tp` INT(11) NOT NULL DEFAULT '0' ,
  `vraag` INT(11) NOT NULL DEFAULT '0' ,
  `optie` INT(11) NOT NULL DEFAULT '0' ,
  `antwoord` TEXT NOT NULL ,
  PRIMARY KEY (`tp`, `vraag`, `optie`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`tp_dsm`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`tp_dsm` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`tp_dsm` (
  `tp` INT(11) NOT NULL DEFAULT '0' ,
  `dsm` VARCHAR(20) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`tp`, `dsm`) ,
  INDEX `dsm` (`dsm` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`tp_oude_rechten`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`tp_oude_rechten` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`tp_oude_rechten` (
  `patient_tp_id` INT(11) NOT NULL DEFAULT '0' ,
  `start` VARCHAR(10) NOT NULL DEFAULT '' ,
  `einde` DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00' ,
  PRIMARY KEY (`patient_tp_id`, `start`, `einde`) ,
  CONSTRAINT `FK_tp_oude_rechten`
    FOREIGN KEY (`patient_tp_id` )
    REFERENCES `listel5`.`patient_tp` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`tp_partner`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`tp_partner` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`tp_partner` (
  `tp` INT(11) NOT NULL DEFAULT '0' ,
  `partner` INT(11) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`tp`, `partner`) ,
  INDEX `partner_idx` (`partner` ASC) ,
  CONSTRAINT `FK_tp_partner_partner`
    FOREIGN KEY (`partner` )
    REFERENCES `listel5`.`organisatie` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`tp_vragen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`tp_vragen` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`tp_vragen` (
  `tp` INT(11) NOT NULL DEFAULT '0' ,
  `nr` INT(11) NOT NULL DEFAULT '0' ,
  `vraag` TEXT NOT NULL ,
  PRIMARY KEY (`tp`, `nr`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `listel5`.`tp_werkingsgebied`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `listel5`.`tp_werkingsgebied` ;

CREATE  TABLE IF NOT EXISTS `listel5`.`tp_werkingsgebied` (
  `tp` INT(11) NOT NULL DEFAULT '0' ,
  `gemeente` SMALLINT(4) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`tp`, `gemeente`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'gemeente is een beetje misleidend, kan ook provincie zijn (n';



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
