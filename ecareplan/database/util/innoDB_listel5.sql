CREATE SCHEMA IF NOT EXISTS `listel5` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE listel5;

CREATE TABLE IF NOT EXISTS `aanvraag_overdracht` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient` varchar(20) NOT NULL DEFAULT '',
  `van_genre` enum('gemeente','rdc','hulp','psy') CHARACTER SET utf8 NOT NULL,
  `van_id` int(11) NOT NULL DEFAULT '0',
  `naar_genre` enum('gemeente','rdc','hulp','psy') CHARACTER SET utf8 NOT NULL,
  `naar_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX van_genre_idx (`van_genre`),
  INDEX van_id_idx (`van_id`),
  INDEX patient_idx (`patient`),
  CONSTRAINT `FK_aanvraag_overdracht_patient`
  FOREIGN KEY (`patient`) REFERENCES patient(`code`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Tabelstructuur voor tabel `aanvraag_overleg`
--

CREATE TABLE IF NOT EXISTS `aanvraag_overleg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` int(11) NOT NULL,
  `rijksregister` varchar(11) COLLATE utf8_general_ci NOT NULL,
  `patient_code` varchar(20) COLLATE utf8_general_ci NOT NULL,
  `gemeente_id` smallint(4) NOT NULL,
  `keuze_organisator` enum('ocmw','rdc','hulp','psy') CHARACTER SET utf8 NOT NULL,
  `reden_organisator` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `andere_reden_organisator` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `id_organisator` int(11) NOT NULL,
  `id_organisator_user` int(11) DEFAULT NULL,
  `doel_informeren` tinyint(4) NOT NULL DEFAULT '0',
  `doel_overtuigen` tinyint(4) NOT NULL DEFAULT '0',
  `doel_organiseren` tinyint(4) NOT NULL DEFAULT '0',
  `doel_debriefen` tinyint(4) NOT NULL DEFAULT '0',
  `doel_beslissen` tinyint(4) NOT NULL DEFAULT '0',
  `doel_andere` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `naam_aanvrager` varchar(120) COLLATE utf8_general_ci NOT NULL,
  `discipline_aanvrager` varchar(80) COLLATE utf8_general_ci NOT NULL,
  `organisatie_aanvrager` varchar(200) COLLATE utf8_general_ci NOT NULL,
  `info_aanvrager` varchar(200) COLLATE utf8_general_ci NOT NULL,
  `dringend` tinyint(4) NOT NULL,
  `status` enum('aanvraag','overname','overname_aangevraagd','overleg','weiger','laat','doorgestuurd') CHARACTER SET utf8 NOT NULL,
  `reden_status` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `overleg_id` int(11) DEFAULT NULL,
  `ontvangst` varchar(20) COLLATE utf8_general_ci DEFAULT NULL,
  `bron` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX rijksregister_idx (`rijksregister`),
  INDEX overleg_id_idx(`overleg_id`),
  INDEX gemeente_id_idx (`gemeente_id`),
  INDEX id_organisator_idx(`id_organisator`),
  INDEX patient_code_idx (`patient_code`),
  CONSTRAINT `FK_aanvraag_overleg_patient_code`
  FOREIGN KEY (`patient_code`) REFERENCES patient(`code`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_aanvraag_overleg_gemeente_id`
  FOREIGN KEY (`gemeente_id`) REFERENCES gemeente(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_aanvraag_overleg_id_organisator`
  FOREIGN KEY (`id_organisator`) REFERENCES hulpverleners(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_aanvraag_overlegbasis_overleg_id`
  FOREIGN KEY (`overleg_id`) REFERENCES overlegbasis(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=377 ;

--
-- Tabelstructuur voor tabel `afgeronde_betrokkenen`
--

CREATE TABLE IF NOT EXISTS `afgeronde_betrokkenen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `overleg_id` int(11) NOT NULL DEFAULT '0',
  `genre` enum('hulp','mantel','org','orgpersoon','patient') NOT NULL DEFAULT 'hulp',
  `persoon_id` int(11) NOT NULL DEFAULT '0',
  `aanwezig` tinyint(1) NOT NULL DEFAULT '0',
  `namens` int(11) DEFAULT NULL,
  `rechten` int(1) NOT NULL DEFAULT '0',
  `overleggenre` enum('gewoon','menos') NOT NULL DEFAULT 'gewoon',
  `bereikbaarheid` text,
  PRIMARY KEY (`id`),
  INDEX persoon_id_idx (`persoon_id`),
  INDEX overleg_id_idx (`overleg_id`),
  CONSTRAINT `FK_afgeronde_betrokkenen_persoon`
  FOREIGN KEY (`persoon_id`) REFERENCES persoon(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_afgeronde_betrokkenen_overleg_id`
  FOREIGN KEY (`overleg_id`) REFERENCES overlegbasis(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1496 ;

--
-- Tabelstructuur voor tabel `berichten`
--

CREATE TABLE IF NOT EXISTS `berichten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient` varchar(20) NOT NULL DEFAULT '',
  `onderwerp` varchar(200) NOT NULL DEFAULT '',
  `boodschap` text NOT NULL,
  `auteur_genre` varchar(20) NOT NULL DEFAULT '',
  `auteur_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX patient_idx (`patient`),
  CONSTRAINT `FK_berichten_patient`
  FOREIGN KEY (`patient`) REFERENCES patient(`code`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=173 ;

--
-- Tabelstructuur voor tabel `berichten_bijlage`
--

CREATE TABLE IF NOT EXISTS `berichten_bijlage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bericht` int(11) NOT NULL DEFAULT '0',
  `bestand` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  INDEX bestand_idx (`bestand`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Tabelstructuur voor tabel `berichten_to`
--

CREATE TABLE IF NOT EXISTS `berichten_to` (
  `bericht` int(11) NOT NULL DEFAULT '0',
  `persoon` int(11) NOT NULL DEFAULT '0',
  `genre` enum('rdc','sit','gemeente','login','hulp','mantel','menos') NOT NULL DEFAULT 'gemeente',
  `status` enum('to','cc') NOT NULL DEFAULT 'to',
  `gelezen` int(1) NOT NULL DEFAULT '0',
  `actief` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`bericht`,`persoon`,`genre`),
  INDEX persoon_idx (`persoon`),
  CONSTRAINT `FK_berichten_to_bericht`
  FOREIGN KEY (`bericht`) REFERENCES berichten(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `FK_berichten_to`
  FOREIGN KEY (`persoon`) REFERENCES hulpverleners(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB DEFAULT CHARSET=utf8;

--
-- Tabelstructuur voor tabel `burgstaat`
--

CREATE TABLE IF NOT EXISTS `burgstaat` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `omschr` varchar(50) NOT NULL DEFAULT '',
  `actief` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX actief_idx (`actief`),
  INDEX omschr_idx (`omschr`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Tabelstructuur voor tabel `evalinstr`
--

CREATE TABLE IF NOT EXISTS `evalinstr` (
  `ei_id` int(6) NOT NULL AUTO_INCREMENT,
  `ei_datum` varchar(30) NOT NULL DEFAULT '0',
  `ei_01_01_s` int(1) NOT NULL DEFAULT '0',
  `ei_01_01_t` tinytext NOT NULL,
  `ei_01_02_s` int(1) NOT NULL DEFAULT '0',
  `ei_01_02_t` tinytext NOT NULL,
  `ei_01_03_s` int(1) NOT NULL DEFAULT '0',
  `ei_01_03_t` tinytext NOT NULL,
  `ei_01_04_s` int(1) NOT NULL DEFAULT '0',
  `ei_01_04_t` tinytext NOT NULL,
  `ei_01_05_s` int(1) NOT NULL DEFAULT '0',
  `ei_01_05_t` tinytext NOT NULL,
  `ei_01_06_s` int(1) NOT NULL DEFAULT '0',
  `ei_01_06_t` tinytext NOT NULL,
  `ei_01_07_s` int(1) NOT NULL DEFAULT '0',
  `ei_01_07_t` tinytext NOT NULL,
  `ei_02_01_s` int(1) NOT NULL DEFAULT '0',
  `ei_02_01_t` tinytext NOT NULL,
  `ei_02_02_s` int(1) NOT NULL DEFAULT '0',
  `ei_02_02_t` tinytext NOT NULL,
  `ei_02_03_s` int(1) NOT NULL DEFAULT '0',
  `ei_02_03_t` tinytext NOT NULL,
  `ei_02_04_s` int(1) NOT NULL DEFAULT '0',
  `ei_02_04_t` tinytext NOT NULL,
  `ei_02_05_s` int(1) NOT NULL DEFAULT '0',
  `ei_02_05_t` tinytext NOT NULL,
  `ei_02_06_s` int(1) NOT NULL DEFAULT '0',
  `ei_02_06_t` tinytext NOT NULL,
  `ei_02_07_s` int(1) NOT NULL DEFAULT '0',
  `ei_02_07_t` tinytext NOT NULL,
  `ei_02_08_s` int(1) NOT NULL DEFAULT '0',
  `ei_02_08_t` tinytext NOT NULL,
  `ei_02_09_s` int(1) NOT NULL DEFAULT '0',
  `ei_02_09_t` tinytext NOT NULL,
  `ei_031_01_s` int(1) NOT NULL DEFAULT '0',
  `ei_031_01_t` tinytext NOT NULL,
  `ei_031_02_s` int(1) NOT NULL DEFAULT '0',
  `ei_031_02_t` tinytext NOT NULL,
  `ei_031_03_s` int(1) NOT NULL DEFAULT '0',
  `ei_031_03_t` tinytext NOT NULL,
  `ei_031_04_s` int(1) NOT NULL DEFAULT '0',
  `ei_031_04_t` tinytext NOT NULL,
  `ei_031_05_s` int(1) NOT NULL DEFAULT '0',
  `ei_031_05_t` tinytext NOT NULL,
  `ei_031_06_s` int(1) NOT NULL DEFAULT '0',
  `ei_031_06_t` tinytext NOT NULL,
  `ei_031_07_s` int(1) NOT NULL DEFAULT '0',
  `ei_031_07_t` tinytext NOT NULL,
  `ei_031_08_s` int(1) NOT NULL DEFAULT '0',
  `ei_031_08_t` tinytext NOT NULL,
  `ei_032_01_s` int(1) NOT NULL DEFAULT '0',
  `ei_032_01_t` tinytext NOT NULL,
  `ei_032_02_s` int(1) NOT NULL DEFAULT '0',
  `ei_032_02_t` tinytext NOT NULL,
  `ei_032_03_s` int(1) NOT NULL DEFAULT '0',
  `ei_032_03_t` tinytext NOT NULL,
  `ei_032_04_s` int(1) NOT NULL DEFAULT '0',
  `ei_032_04_t` tinytext NOT NULL,
  `ei_032_05_s` int(1) NOT NULL DEFAULT '0',
  `ei_032_05_t` tinytext NOT NULL,
  `ei_032_06_s` int(1) NOT NULL DEFAULT '0',
  `ei_032_06_t` tinytext NOT NULL,
  `ei_032_07_s` int(1) NOT NULL DEFAULT '0',
  `ei_032_07_t` tinytext NOT NULL,
  `ei_032_08_s` int(1) NOT NULL DEFAULT '0',
  `ei_032_08_t` tinytext NOT NULL,
  `ei_032_09_s` int(1) NOT NULL DEFAULT '0',
  `ei_032_09_t` tinytext NOT NULL,
  `ei_032_10_s` int(1) NOT NULL DEFAULT '0',
  `ei_032_10_t` tinytext NOT NULL,
  `ei_032_11_s` int(1) NOT NULL DEFAULT '0',
  `ei_032_11_t` tinytext NOT NULL,
  `ei_032_12_s` int(1) NOT NULL DEFAULT '0',
  `ei_032_12_t` tinytext NOT NULL,
  `ei_032_13_s` int(1) NOT NULL DEFAULT '0',
  `ei_032_13_t` tinytext NOT NULL,
  `ei_032_14_s` int(1) NOT NULL DEFAULT '0',
  `ei_032_14_t` tinytext NOT NULL,
  `ei_033_01_s` int(1) NOT NULL DEFAULT '0',
  `ei_033_01_t` tinytext NOT NULL,
  `ei_033_02_s` int(1) NOT NULL DEFAULT '0',
  `ei_033_02_t` tinytext NOT NULL,
  `ei_033_03_s` int(1) NOT NULL DEFAULT '0',
  `ei_033_03_t` tinytext NOT NULL,
  `ei_033_04_s` int(1) NOT NULL DEFAULT '0',
  `ei_033_04_t` tinytext NOT NULL,
  `ei_033_05_s` int(1) NOT NULL DEFAULT '0',
  `ei_033_05_t` tinytext NOT NULL,
  `ei_033_06_s` int(1) NOT NULL DEFAULT '0',
  `ei_033_06_t` tinytext NOT NULL,
  `ei_033_07_s` int(1) NOT NULL DEFAULT '0',
  `ei_033_07_t` tinytext NOT NULL,
  `ei_033_08_s` int(1) NOT NULL DEFAULT '0',
  `ei_033_08_t` tinytext NOT NULL,
  `ei_04_01_s` int(1) NOT NULL DEFAULT '0',
  `ei_04_01_t` tinytext NOT NULL,
  `ei_04_02_s` int(1) NOT NULL DEFAULT '0',
  `ei_04_02_t` tinytext NOT NULL,
  `ei_04_03_s` int(1) NOT NULL DEFAULT '0',
  `ei_04_03_t` tinytext NOT NULL,
  `ei_04_04_s` int(1) NOT NULL DEFAULT '0',
  `ei_04_04_t` tinytext NOT NULL,
  `ei_04_05_s` int(1) NOT NULL DEFAULT '0',
  `ei_04_05_t` tinytext NOT NULL,
  `ei_04_06_s` int(1) NOT NULL DEFAULT '0',
  `ei_04_06_t` tinytext NOT NULL,
  `ei_04_07_s` int(1) NOT NULL DEFAULT '0',
  `ei_04_07_t` tinytext NOT NULL,
  `ei_04_08_s` int(1) NOT NULL DEFAULT '0',
  `ei_04_08_t` tinytext NOT NULL,
  `ei_04_09_s` int(1) NOT NULL DEFAULT '0',
  `ei_04_09_t` tinytext NOT NULL,
  `ei_04_10_s` int(1) NOT NULL DEFAULT '0',
  `ei_04_10_t` tinytext NOT NULL,
  `ei_04_11_s` int(1) NOT NULL DEFAULT '0',
  `ei_04_11_t` tinytext NOT NULL,
  `ei_04_12_s` int(1) NOT NULL DEFAULT '0',
  `ei_04_12_t` tinytext NOT NULL,
  `ei_04_13_s` int(1) NOT NULL DEFAULT '0',
  `ei_04_13_t` tinytext NOT NULL,
  `ei_04_14_s` int(1) NOT NULL DEFAULT '0',
  `ei_04_14_t` tinytext NOT NULL,
  `ei_05_01_s` int(1) NOT NULL DEFAULT '0',
  `ei_05_01_t` tinytext NOT NULL,
  `ei_05_02_s` int(1) NOT NULL DEFAULT '0',
  `ei_05_02_t` tinytext NOT NULL,
  `ei_05_03_s` int(1) NOT NULL DEFAULT '0',
  `ei_05_03_t` tinytext NOT NULL,
  `ei_05_04_s` int(1) NOT NULL DEFAULT '0',
  `ei_05_04_t` tinytext NOT NULL,
  `ei_05_05_s` int(1) NOT NULL DEFAULT '0',
  `ei_05_05_t` tinytext NOT NULL,
  `ei_05_06_s` int(1) NOT NULL DEFAULT '0',
  `ei_05_06_t` tinytext NOT NULL,
  `ei_05_07_s` int(1) NOT NULL DEFAULT '0',
  `ei_05_07_t` tinytext NOT NULL,
  `ei_05_08_s` int(1) NOT NULL DEFAULT '0',
  `ei_05_08_t` tinytext NOT NULL,
  `ei_05_09_s` int(1) NOT NULL DEFAULT '0',
  `ei_05_09_t` tinytext NOT NULL,
  `ei_05_10_s` int(1) NOT NULL DEFAULT '0',
  `ei_05_10_t` tinytext NOT NULL,
  `ei_05_11_s` int(1) NOT NULL DEFAULT '0',
  `ei_05_11_t` tinytext NOT NULL,
  `ei_05_12_s` int(1) NOT NULL DEFAULT '0',
  `ei_05_12_t` tinytext NOT NULL,
  `ei_05_13_s` int(1) NOT NULL DEFAULT '0',
  `ei_05_13_t` tinytext NOT NULL,
  `ei_05_14_s` int(1) NOT NULL DEFAULT '0',
  `ei_05_14_t` tinytext NOT NULL,
  `ei_06_01_s` int(1) NOT NULL DEFAULT '0',
  `ei_06_01_t` tinytext NOT NULL,
  `ei_06_02_s` int(1) NOT NULL DEFAULT '0',
  `ei_06_02_t` tinytext NOT NULL,
  `ei_06_03_s` int(1) NOT NULL DEFAULT '0',
  `ei_06_03_t` tinytext NOT NULL,
  `ei_06_04_s` int(1) NOT NULL DEFAULT '0',
  `ei_06_04_t` tinytext NOT NULL,
  `ei_06_05_s` int(1) NOT NULL DEFAULT '0',
  `ei_06_05_t` tinytext NOT NULL,
  `ei_06_06_s` int(1) NOT NULL DEFAULT '0',
  `ei_06_06_t` tinytext NOT NULL,
  `ei_06_07_s` int(1) NOT NULL DEFAULT '0',
  `ei_06_07_t` tinytext NOT NULL,
  `ei_06_08_s` int(1) NOT NULL DEFAULT '0',
  `ei_06_08_t` tinytext NOT NULL,
  `ei_06_09_s` int(1) NOT NULL DEFAULT '0',
  `ei_06_09_t` tinytext NOT NULL,
  `ei_06_10_s` int(1) NOT NULL DEFAULT '0',
  `ei_06_10_t` tinytext NOT NULL,
  `ei_06_11_s` int(1) NOT NULL DEFAULT '0',
  `ei_06_11_t` tinytext NOT NULL,
  `ei_07_01_s` int(1) NOT NULL DEFAULT '0',
  `ei_07_01_t` tinytext NOT NULL,
  `ei_07_02_s` int(1) NOT NULL DEFAULT '0',
  `ei_07_02_t` tinytext NOT NULL,
  `ei_07_03_s` int(1) NOT NULL DEFAULT '0',
  `ei_07_03_t` tinytext NOT NULL,
  `ei_07_04_s` int(1) NOT NULL DEFAULT '0',
  `ei_07_04_t` tinytext NOT NULL,
  `ei_07_05_s` int(1) NOT NULL DEFAULT '0',
  `ei_07_05_t` tinytext NOT NULL,
  `ei_07_06_s` int(1) NOT NULL DEFAULT '0',
  `ei_07_06_t` tinytext NOT NULL,
  `ei_07_07_s` int(1) NOT NULL DEFAULT '0',
  `ei_07_07_t` tinytext NOT NULL,
  `ei_07_08_s` int(1) NOT NULL DEFAULT '0',
  `ei_07_08_t` tinytext NOT NULL,
  `ei_081_01_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_01_t` tinytext NOT NULL,
  `ei_081_02_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_02_t` tinytext NOT NULL,
  `ei_081_03_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_03_t` tinytext NOT NULL,
  `ei_081_04_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_04_t` tinytext NOT NULL,
  `ei_081_05_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_05_t` tinytext NOT NULL,
  `ei_081_06_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_06_t` tinytext NOT NULL,
  `ei_081_07_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_07_t` tinytext NOT NULL,
  `ei_081_08_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_08_t` tinytext NOT NULL,
  `ei_081_09_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_09_t` tinytext NOT NULL,
  `ei_081_10_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_10_t` tinytext NOT NULL,
  `ei_081_11_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_11_t` tinytext NOT NULL,
  `ei_081_12_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_12_t` tinytext NOT NULL,
  `ei_081_13_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_13_t` tinytext NOT NULL,
  `ei_081_14_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_14_t` tinytext NOT NULL,
  `ei_081_15_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_15_t` tinytext NOT NULL,
  `ei_081_16_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_16_t` tinytext NOT NULL,
  `ei_081_17_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_17_t` tinytext NOT NULL,
  `ei_081_18_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_18_t` tinytext NOT NULL,
  `ei_081_19_s` int(1) NOT NULL DEFAULT '0',
  `ei_081_19_t` tinytext NOT NULL,
  `ei_082_01_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_01_t` tinytext NOT NULL,
  `ei_082_02_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_02_t` tinytext NOT NULL,
  `ei_082_03_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_03_t` tinytext NOT NULL,
  `ei_082_04_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_04_t` tinytext NOT NULL,
  `ei_082_05_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_05_t` tinytext NOT NULL,
  `ei_082_06_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_06_t` tinytext NOT NULL,
  `ei_082_07_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_07_t` tinytext NOT NULL,
  `ei_082_08_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_08_t` tinytext NOT NULL,
  `ei_082_09_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_09_t` tinytext NOT NULL,
  `ei_082_10_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_10_t` tinytext NOT NULL,
  `ei_082_11_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_11_t` tinytext NOT NULL,
  `ei_082_12_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_12_t` tinytext NOT NULL,
  `ei_082_13_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_13_t` tinytext NOT NULL,
  `ei_082_14_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_14_t` tinytext NOT NULL,
  `ei_082_15_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_15_t` tinytext NOT NULL,
  `ei_082_16_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_16_t` tinytext NOT NULL,
  `ei_082_17_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_17_t` tinytext NOT NULL,
  `ei_082_18_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_18_t` tinytext NOT NULL,
  `ei_082_19_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_19_t` tinytext NOT NULL,
  `ei_082_20_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_20_t` tinytext NOT NULL,
  `ei_082_21_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_21_t` tinytext NOT NULL,
  `ei_082_22_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_22_t` tinytext NOT NULL,
  `ei_082_23_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_23_t` tinytext NOT NULL,
  `ei_082_24_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_24_t` tinytext NOT NULL,
  `ei_082_25_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_25_t` tinytext NOT NULL,
  `ei_082_26_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_26_t` tinytext NOT NULL,
  `ei_082_27_s` int(1) NOT NULL DEFAULT '0',
  `ei_082_27_t` tinytext NOT NULL,
  `ei_09_01_t` text NOT NULL,
  PRIMARY KEY (`ei_id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=164 ;

--
-- Tabelstructuur voor tabel `evalinstr_nieuw`
--

CREATE TABLE IF NOT EXISTS `evalinstr_nieuw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uitvoerder_id` int(11) NOT NULL,
  `dd` int(2) NOT NULL,
  `mm` int(2) NOT NULL,
  `jjjj` int(4) NOT NULL,
  `v1_1` tinyint(4) NOT NULL,
  `extra1_1` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_2` tinyint(4) NOT NULL,
  `extra1_2` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_3` tinyint(4) NOT NULL,
  `extra1_3` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_4` tinyint(4) NOT NULL,
  `extra1_4` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_5` tinyint(4) NOT NULL,
  `extra1_5` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_6` tinyint(4) NOT NULL,
  `extra1_6` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_7` tinyint(4) NOT NULL,
  `extra1_7` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_8` tinyint(4) NOT NULL,
  `extra1_8` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_9` tinyint(4) NOT NULL,
  `extra1_9` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_10` tinyint(4) NOT NULL,
  `extra1_10` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_11` tinyint(4) NOT NULL,
  `extra1_11` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_12` tinyint(4) NOT NULL,
  `extra1_12` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_13` tinyint(4) NOT NULL,
  `extra1_13` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_14` tinyint(4) NOT NULL,
  `extra1_14` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_15` tinyint(4) NOT NULL,
  `extra1_15` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_16` tinyint(4) NOT NULL,
  `extra1_16` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_17` tinyint(4) NOT NULL,
  `extra1_17` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_18` tinyint(4) NOT NULL,
  `extra1_18` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_19` tinyint(4) NOT NULL,
  `extra1_19` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_20` tinyint(4) NOT NULL,
  `extra1_20` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_21` tinyint(4) NOT NULL,
  `extra1_21` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v1_22` tinyint(4) NOT NULL,
  `extra1_22` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v2_1` tinyint(4) NOT NULL,
  `extra2_1` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v2_2` tinyint(4) NOT NULL,
  `extra2_2` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v2_3` tinyint(4) NOT NULL,
  `extra2_3` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v2_4` tinyint(4) NOT NULL,
  `extra2_4` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v2_5` tinyint(4) NOT NULL,
  `extra2_5` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v2_6` tinyint(4) NOT NULL,
  `extra2_6` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v2_7` tinyint(4) NOT NULL,
  `extra2_7` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v2_8` tinyint(4) NOT NULL,
  `extra2_8` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v2_9` tinyint(4) NOT NULL,
  `extra2_9` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v2_10` tinyint(4) NOT NULL,
  `extra2_10` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v2_11` tinyint(4) NOT NULL,
  `extra2_11` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v3_1` tinyint(4) NOT NULL,
  `extra3_1` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v3_2` tinyint(4) NOT NULL,
  `extra3_2` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v3_3` tinyint(4) NOT NULL,
  `extra3_3` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v4_1` tinyint(4) NOT NULL,
  `extra4_1` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v4_2` tinyint(4) NOT NULL,
  `extra4_2` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v4_3` tinyint(4) NOT NULL,
  `extra4_3` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v4_4` tinyint(4) NOT NULL,
  `extra4_4` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v5_1` tinyint(4) NOT NULL,
  `extra5_1` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v5_2` tinyint(4) NOT NULL,
  `extra5_2` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v5_3` tinyint(4) NOT NULL,
  `extra5_3` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v5_4` tinyint(4) NOT NULL,
  `extra5_4` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v5_5` tinyint(4) NOT NULL,
  `extra5_5` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v5_6` tinyint(4) NOT NULL,
  `extra5_6` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v5_7` tinyint(4) NOT NULL,
  `extra5_7` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
  `v6` text COLLATE utf8_general_ci,
  `v7` text COLLATE utf8_general_ci,
  `v8` text COLLATE utf8_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=32 ;

--
-- Tabelstructuur voor tabel `evaluatie`
--

CREATE TABLE IF NOT EXISTS `evaluatie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient` varchar(20) NOT NULL DEFAULT '',
  `datum` varchar(10) NOT NULL DEFAULT '',
  `locatie` enum('huisbezoek','bureelbezoek','telefonisch','email') NOT NULL DEFAULT 'huisbezoek',
  `vooruitgang` text NOT NULL,
  `katz_id` int(11) DEFAULT NULL,
  `uitvoerder_id` int(11) NOT NULL DEFAULT '0',
  `genre` varchar(20) NOT NULL DEFAULT '',
  `tp_rechtenOC` tinyint(1) DEFAULT '1',
  `creatiedatum` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `patient` (`patient`),
  INDEX datum_idx (`datum`),
  INDEX katz_id_idx (`katz_id`),
  INDEX uitvoerder_id_idx (`uitvoerder_id`),
  CONSTRAINT `FK_evaluatie_patient`
  FOREIGN KEY (`patient`) REFERENCES patient(`code`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_evaluatie_uitvoerder_id`
  FOREIGN KEY (`uitvoerder_id`) REFERENCES hulpverleners(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_evaluatie_katz_id`
  FOREIGN KEY (`katz_id`) REFERENCES katz(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Tabelstructuur voor tabel `evaluatie_rechten`
--

CREATE TABLE IF NOT EXISTS `evaluatie_rechten` (
  `evaluatie` int(11) NOT NULL DEFAULT '0',
  `genre` varchar(60) NOT NULL DEFAULT '',
  `id` int(11) NOT NULL DEFAULT '0',
  `rechten` int(1) NOT NULL DEFAULT '0',
  INDEX evaluatie_idx (`evaluatie`),
  CONSTRAINT `FK_evaluatie_rechten_evaluatie`
  FOREIGN KEY (`evaluatie`) REFERENCES evaluatie(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB DEFAULT CHARSET=utf8;

--
-- Tabelstructuur voor tabel `factuur`
--

CREATE TABLE IF NOT EXISTS `factuur` (
  `jaar` varchar(4) NOT NULL DEFAULT '',
  `nr` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`jaar`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

--
-- Tabelstructuur voor tabel `factuurmaand`
--

CREATE TABLE IF NOT EXISTS `factuurmaand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` enum('TP','gewoon','ForK','H','G','TP-H','TP-G','ForK-H','ForK-G') NOT NULL DEFAULT 'TP',
  `jaar` int(11) NOT NULL DEFAULT '0',
  `maand` int(11) NOT NULL DEFAULT '0',
  `nummer` int(11) NOT NULL DEFAULT '0',
  `mutualiteit` int(3) NOT NULL DEFAULT '0',
  `factuurdatum` varchar(10) NOT NULL DEFAULT '',
  `factuurFile` varchar(200) DEFAULT NULL,
  `creditActief` tinyint(4) DEFAULT NULL,
  `vervangt` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX genre_idx (`genre`),
  INDEX jaar_idx (`jaar`),
  INDEX vervangt_idx (`vervangt`),
  INDEX mutualiteit_idx (`mutualiteit`),
  CONSTRAINT `FK_factuurmaand_vervangt`
  FOREIGN KEY (`vervangt`) REFERENCES factuurmaand(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_factuurmaand_mutualiteit`
  FOREIGN KEY (`mutualiteit`) REFERENCES verzekering(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Tabelstructuur voor tabel `factuur_organisatie`
--

CREATE TABLE IF NOT EXISTS `factuur_organisatie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `minimum` int(11) NOT NULL,
  `maximum` int(11) NOT NULL,
  `datum` varchar(12) COLLATE utf8_general_ci NOT NULL,
  `deelvzw` enum('H','G','D') COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  INDEX deelvzw_idx (`deelvzw`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=16 ;

--
-- Tabelstructuur voor tabel `functiegroepen`
--

CREATE TABLE IF NOT EXISTS `functiegroepen` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `naam` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Tabelstructuur voor tabel `functies`
--

CREATE TABLE IF NOT EXISTS `functies` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `naam` varchar(40) NOT NULL DEFAULT 'nieuwe functie',
  `groep_id` int(3) NOT NULL DEFAULT '0',
  `rangorde` int(3) NOT NULL DEFAULT '0',
  `actief` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX rangorde_idx (`rangorde`),
  INDEX actief_idx (`actief`),
  INDEX groep_id_idx (`groep_id`),
  CONSTRAINT `FK_functies_groep_id`
  FOREIGN KEY (`groep_id`) REFERENCES functiegroepen(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=128 ;

--
-- Tabelstructuur voor tabel `gemeente`
--

CREATE TABLE IF NOT EXISTS `gemeente` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `zip` smallint(4) NOT NULL DEFAULT '0',
  `naam` varchar(50) NOT NULL DEFAULT '',
  `dlzip` smallint(4) NOT NULL DEFAULT '0',
  `dlnaam` varchar(50) NOT NULL DEFAULT '',
  `taal` varchar(8) NOT NULL DEFAULT '',
  `sit_id` int(2) NOT NULL DEFAULT '-1',
  `deelvzw` enum('H','G') DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX zip_idx (`zip`),
  INDEX sit_id_idx (`sit_id`),
  CONSTRAINT `FK_gemeente_sid_id`
  FOREIGN KEY (`sit_id`) REFERENCES sit(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10015 ;

--
-- Tabelstructuur voor tabel `huidige_betrokkenen`
--

CREATE TABLE IF NOT EXISTS `huidige_betrokkenen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_code` varchar(20) NOT NULL DEFAULT '0',
  `genre` enum('hulp','mantel','org','orgpersoon','patient') NOT NULL DEFAULT 'hulp',
  `persoon_id` int(11) NOT NULL DEFAULT '0',
  `aanwezig` tinyint(1) NOT NULL DEFAULT '0',
  `namens` int(11) DEFAULT NULL,
  `rechten` int(1) NOT NULL DEFAULT '0',
  `overleggenre` enum('gewoon','menos') NOT NULL DEFAULT 'gewoon',
  `bereikbaarheid` text,
  PRIMARY KEY (`id`),
  INDEX patient_code_idx (`patient_code`),
  INDEX aanwezig_idx (`aanwezig`),
  INDEX genre_idx (`genre`),
  INDEX overleggenre_idx (`overleggenre`),
  INDEX persoon_id_idx (`persoon_id`),
  CONSTRAINT `FK_huidige_betrokkenen_persoon_id`
  FOREIGN KEY (`persoon_id`) REFERENCES persoon(`id`) ON UPDATE CASCADE ON DELETE RESTRICT ,
  CONSTRAINT `FK_huidige_betrokkenen_patient_code`
  FOREIGN KEY (`patient_code`) REFERENCES patient(`code`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2591 ;

--
-- Tabelstructuur voor tabel `hulpverleners`
--

CREATE TABLE IF NOT EXISTS `hulpverleners` (
  `id` int(11) NOT NULL,
  `naam` varchar(25) NOT NULL DEFAULT '',
  `voornaam` varchar(25) NOT NULL DEFAULT '',
  `fnct_id` int(3) NOT NULL DEFAULT '0',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `adres` varchar(50) NOT NULL DEFAULT '',
  `gem_id` smallint(4) NOT NULL DEFAULT '9999',
  `email` varchar(50) NOT NULL DEFAULT '',
  `reknr` varchar(20) NOT NULL DEFAULT '',
  `iban` varchar(34) NOT NULL DEFAULT '',
  `bic` varchar(11) NOT NULL DEFAULT '',
  `riziv1` int(6) NOT NULL DEFAULT '0',
  `riziv2` int(2) NOT NULL DEFAULT '0',
  `riziv3` int(3) NOT NULL DEFAULT '0',
  `organisatie` int(11) DEFAULT NULL,
  `convenant` enum('afgesloten','gezamenlijk','niet') DEFAULT NULL,
  `fax` varchar(20) NOT NULL DEFAULT '',
  `gsm` varchar(20) NOT NULL DEFAULT '',
  `actief` int(1) NOT NULL DEFAULT '1',
  `mag_weg` tinyint(1) NOT NULL DEFAULT '0',
  `vervangt` int(11) DEFAULT NULL,
  `login` varchar(40) NOT NULL DEFAULT '',
  `paswoord` varchar(40) NOT NULL DEFAULT '',
  `pwd_recovery` varchar(40) NOT NULL DEFAULT '',
  `geheime_vraag` varchar(200) NOT NULL DEFAULT '',
  `geheim_antwoord` varchar(200) NOT NULL DEFAULT '',
  `ipadres` varchar(40) NOT NULL DEFAULT '',
  `logindatum` int(11) NOT NULL DEFAULT '0',
  `validatiestatus` enum('geenkeuze','aanvraag','halfweg','gevalideerd','weigering') NOT NULL DEFAULT 'geenkeuze',
  `aanvraagdatum` DATE NOT NULL DEFAULT '1000-01-01',
  `validatiedatum` DATE NOT NULL DEFAULT '1000-01-01',
  `weigerdatum` DATE NOT NULL DEFAULT '1000-01-01',
  `is_organisator` int(1) NOT NULL DEFAULT '0',
  `sociale_kaart` int(11) NOT NULL DEFAULT '0',
  `sociale_functie` varchar(200) NOT NULL DEFAULT '',
  `sociale_email` int(11) NOT NULL DEFAULT '0',
  `sociale_tel` int(11) NOT NULL DEFAULT '0',
  `sociale_fax` int(11) NOT NULL DEFAULT '0',
  `gedetacheerd_ggz` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX naam_idx (`naam`,`voornaam`),
  INDEX actief_idx (`actief`),
  INDEX organisatie_idx (`organisatie`),
  INDEX gem_id_idx (`gem_id`),
  INDEX fnct_id_idx (`fnct_id`),
  CONSTRAINT `FK_hulpverleners_id`
  FOREIGN KEY (`id`) REFERENCES persoon(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_hulpverleners_gem_id`
  FOREIGN KEY (`gem_id`) REFERENCES gemeente(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_hulpverleners_fnct_id`
  FOREIGN KEY (`fnct_id`) REFERENCES functies(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_hulpverleners_organisatie`
  FOREIGN KEY (`organisatie`) REFERENCES organisatie(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12227 ;

--
-- Tabelstructuur voor tabel `katz`
--

CREATE TABLE IF NOT EXISTS `katz` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `dd` char(2) NOT NULL DEFAULT '0',
  `mm` char(2) NOT NULL DEFAULT '0',
  `jj` char(4) NOT NULL DEFAULT '0',
  `wassen` char(2) NOT NULL DEFAULT '0',
  `kleden` char(2) NOT NULL DEFAULT '0',
  `verpla` char(2) NOT NULL DEFAULT '0',
  `toilet` char(2) NOT NULL DEFAULT '0',
  `continent` char(2) NOT NULL DEFAULT '0',
  `eten` char(2) NOT NULL DEFAULT '0',
  `orient` char(2) NOT NULL DEFAULT '0',
  `rust` char(2) NOT NULL DEFAULT '0',
  `woon` char(2) NOT NULL DEFAULT '0',
  `mantel` char(2) NOT NULL DEFAULT '0',
  `sanitair` char(2) NOT NULL DEFAULT '0',
  `totaal` int(2) NOT NULL DEFAULT '0',
  `hvl_id` int(5) NOT NULL DEFAULT '0',
  `goedkeuring_inspectie` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_katz_hvl_id`
  FOREIGN KEY (`hvl_id`) REFERENCES hulpverleners(`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=217 ;

--
-- Tabelstructuur voor tabel `katz_aanvraag`
--

CREATE TABLE IF NOT EXISTS `katz_aanvraag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `overleg` int(11) NOT NULL DEFAULT '0',
  `hvl` int(11) NOT NULL DEFAULT '0',
  `wat` varchar(30) DEFAULT 'katz+evaluatie',
  `wanneer` int(11) NOT NULL DEFAULT '1273788000',
  PRIMARY KEY (`id`),
  INDEX overleg_id_idx (`overleg`),
  CONSTRAINT `FK_katz_aanvraag_overleg`
  FOREIGN KEY (`overleg`) REFERENCES overlegbasis(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_katz_aanvraag_hvl`
  FOREIGN KEY (`hvl`) REFERENCES hulpverleners(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=186 ;

--
-- Tabelstructuur voor tabel `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(25) NOT NULL DEFAULT '',
  `naam` varchar(25) NOT NULL DEFAULT '',
  `profiel` enum('OC','listel','hoofdproject','bijkomend project','caw','rdc','menos','ziekenhuis','psy') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'OC',
  `organisatie` int(11) DEFAULT NULL,
  `adres` varchar(50) NOT NULL DEFAULT '',
  `gem_id` smallint(4) NOT NULL DEFAULT '9999',
  `tel` varchar(12) NOT NULL DEFAULT '',
  `fax` varchar(12) NOT NULL DEFAULT '',
  `gsm` varchar(12) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `tp_project` int(11) DEFAULT NULL,
  `sit_id` int(2) DEFAULT NULL,
  `overleg_gemeente` smallint(4) DEFAULT NULL,
  `login` varchar(40) NOT NULL DEFAULT '',
  `paswoord` varchar(40) NOT NULL DEFAULT '',
  `pwd_recovery` varchar(40) NOT NULL,
  `ipadres` varchar(40) NOT NULL DEFAULT '',
  `logindatum` int(30) NOT NULL DEFAULT '0',
  `actief` int(1) NOT NULL DEFAULT '1',
  `loginpin` TEXT,
  PRIMARY KEY (`id`),
  INDEX naam_idx (`naam`,`voornaam`),
  INDEX organisatie_idx (`organisatie`),
  INDEX tp_project_idx (`tp_project`),
  INDEX sit_id_idx (`sit_id`),
  INDEX overleg_gemeente_idx (`overleg_gemeente`),
  CONSTRAINT `FK_logins_organisatie`
  FOREIGN KEY (`organisatie`) REFERENCES organisatie(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `FK_logins_tp_project`
  FOREIGN KEY (`tp_project`) REFERENCES tp_project(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `FK_logins_sit_id`
  FOREIGN KEY (`sit_id`) REFERENCES sit(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `FK_logins_overleg_gemeente`
  FOREIGN KEY (`overleg_gemeente`) REFERENCES gemeente(`zip`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=474 ;

--
-- Tabelstructuur voor tabel `logs_ziekenhuis`
--

CREATE TABLE IF NOT EXISTS `logs_ziekenhuis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `rijksregister` varchar(11) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_logs_ziekenhuis_login`
  FOREIGN KEY (`login`) REFERENCES logins(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=84 ;

--
-- Tabelstructuur voor tabel `mantelzorgers`
--

CREATE TABLE IF NOT EXISTS `mantelzorgers` (
  `id` int(5) NOT NULL,
  `naam` varchar(50) NOT NULL DEFAULT '',
  `voornaam` varchar(50) NOT NULL DEFAULT '',
  `verwsch_id` int(2) NOT NULL DEFAULT '1',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `fax` varchar(20) NOT NULL DEFAULT '',
  `gsm` varchar(20) NOT NULL DEFAULT '',
  `adres` varchar(80) NOT NULL DEFAULT '',
  `gem_id` smallint(4) NOT NULL DEFAULT '0',
  `email` varchar(80) NOT NULL DEFAULT '',
  `actief` int(1) NOT NULL DEFAULT '1',
  `login` varchar(40) NOT NULL DEFAULT '',
  `paswoord` varchar(40) NOT NULL DEFAULT '',
  `pwd_recovery` varchar(40) NOT NULL DEFAULT '',
  `geheime_vraag` varchar(200) NOT NULL DEFAULT '',
  `geheim_antwoord` varchar(200) NOT NULL DEFAULT '',
  `ipadres` varchar(40) NOT NULL DEFAULT '',
  `logindatum` int(11) NOT NULL DEFAULT '0',
  `validatiestatus` enum('geenkeuze','halfweg','gevalideerd','weigering') NOT NULL DEFAULT 'geenkeuze',
  `aanvraagdatum` date NOT NULL DEFAULT '1000-01-01',
  `validatiedatum` date NOT NULL DEFAULT '1000-01-01',
  `weigerdatum` date NOT NULL DEFAULT '1000-01-01',
  PRIMARY KEY (`id`),
  INDEX naam_idx (`naam`,`voornaam`),
  INDEX verwsch_id_idx (`verwsch_id`),
  INDEX gem_id_idx (`gem_id`),
  CONSTRAINT `FK_manterzorgers_id`
  FOREIGN KEY (`id`) REFERENCES persoon(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_mantelzorgers_verwsch_id`
  FOREIGN KEY (`verwsch_id`) REFERENCES verwantschap(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_mantelzorgers_gem_id`
  FOREIGN KEY (`gem_id`) REFERENCES gemeente(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2134 ;

--
-- Tabelstructuur voor tabel `menos_files`
--

CREATE TABLE IF NOT EXISTS `menos_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient` varchar(20) NOT NULL DEFAULT '0',
  `filename` varchar(200) NOT NULL DEFAULT '',
  `alias` varchar(200) NOT NULL DEFAULT '',
  `created` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX patient_idx (`patient`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Tabelstructuur voor tabel `menos_interventie`
--

CREATE TABLE IF NOT EXISTS `menos_interventie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` varchar(10) COLLATE utf8_general_ci NOT NULL,
  `vorm` varchar(60) COLLATE utf8_general_ci NOT NULL,
  `subvorm` varchar(200) COLLATE utf8_general_ci NOT NULL,
  `vooruitgang` text COLLATE utf8_general_ci NOT NULL,
  `uitvoerder_id` int(11) NOT NULL,
  `genre` enum('menos','hulp','mantel','patient') COLLATE utf8_general_ci NOT NULL,
  `patient` varchar(20) COLLATE utf8_general_ci NOT NULL,
  `uren` float NOT NULL,
  `creatiedatum` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX datum_idx (`datum` DESC)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=141 ;

--
-- Tabelstructuur voor tabel `omb_aanwezigeprobleemfactor`
--

CREATE TABLE IF NOT EXISTS `omb_aanwezigeprobleemfactor` (
  `registratie_id` int(11) NOT NULL DEFAULT '0',
  `wie` enum('slachtoffer','pleger') COLLATE utf8_general_ci NOT NULL DEFAULT 'slachtoffer',
  `probleemfactor` int(11) NOT NULL DEFAULT '0',
  `detail` text COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`registratie_id`,`wie`,`probleemfactor`),
  INDEX probleemfactor_idx (`probleemfactor`),
  CONSTRAINT `FK_omb_aanwezigeprobleemfactor_probleemfactor`
  FOREIGN KEY (`probleemfactor`) REFERENCES omb_probleemfactor(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tabelstructuur voor tabel `omb_bekendheid`
--

CREATE TABLE IF NOT EXISTS `omb_bekendheid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bekendheid` varchar(60) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=9 ;

--
-- Tabelstructuur voor tabel `omb_contactwijze`
--

CREATE TABLE IF NOT EXISTS `omb_contactwijze` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contactwijze` varchar(40) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=7 ;

--
-- Tabelstructuur voor tabel `omb_hoofdrelatie`
--

CREATE TABLE IF NOT EXISTS `omb_hoofdrelatie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hoofdrelatie` varchar(60) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=14 ;

--
-- Tabelstructuur voor tabel `omb_hulp`
--

CREATE TABLE IF NOT EXISTS `omb_hulp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registratie_id` int(11) NOT NULL DEFAULT '0',
  `genre` int(11) NOT NULL DEFAULT '0',
  `detail` varchar(255) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  INDEX registratie_id_idx (`registratie_id`),
  INDEX genre_idx (`genre`),
  CONSTRAINT `FK_omb_hulp_genre`
  FOREIGN KEY (`genre`) REFERENCES omb_hulpvorm(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=522 ;

--
-- Tabelstructuur voor tabel `omb_hulpvorm`
--

CREATE TABLE IF NOT EXISTS `omb_hulpvorm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hulpvorm` varchar(80) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=20 ;

--
-- Tabelstructuur voor tabel `omb_justitie`
--

CREATE TABLE IF NOT EXISTS `omb_justitie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `justitie` varchar(60) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=6 ;

--
-- Tabelstructuur voor tabel `omb_mishandeling`
--

CREATE TABLE IF NOT EXISTS `omb_mishandeling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mishandeling` varchar(80) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=8 ;

--
-- Tabelstructuur voor tabel `omb_mishandelvorm`
--

CREATE TABLE IF NOT EXISTS `omb_mishandelvorm` (
  `registratie_id` int(11) NOT NULL DEFAULT '0',
  `mishandeling` int(11) NOT NULL DEFAULT '0',
  `genre` enum('aanmelding','opvolging') COLLATE utf8_general_ci NOT NULL DEFAULT 'aanmelding',
  PRIMARY KEY (`registratie_id`,`mishandeling`,`genre`),
  INDEX mishandeling_idx (`mishandeling`),
  CONSTRAINT `FK_omb_mishandelvorm_mishandeling`
  FOREIGN KEY (`mishandeling`) REFERENCES omb_mishandeling(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tabelstructuur voor tabel `omb_pot`
--

CREATE TABLE IF NOT EXISTS `omb_pot` (
  `jaar` int(11) NOT NULL DEFAULT '0',
  `pot` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`jaar`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

--
-- Tabelstructuur voor tabel `omb_probleemfactor`
--

CREATE TABLE IF NOT EXISTS `omb_probleemfactor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `probleemfactor` varchar(60) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=10 ;

--
-- Tabelstructuur voor tabel `omb_registratie`
--

CREATE TABLE IF NOT EXISTS `omb_registratie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auteur` int(11) NOT NULL DEFAULT '0',
  `dag` int(11) NOT NULL DEFAULT '0',
  `maand` int(11) NOT NULL DEFAULT '0',
  `jaar` int(11) NOT NULL DEFAULT '0',
  `dagnummer` int(11) NOT NULL DEFAULT '0',
  `contactwijze` int(11) DEFAULT NULL,
  `bekendheid` int(11) DEFAULT NULL,
  `doorverwijzing_intern` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `doorverwijzing_extern` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `genre_melding` int(11) DEFAULT NULL,
  `melder_soort` enum('hulpverleners','slachtoffer','ander') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `melderhvl_id` int(11) DEFAULT NULL,
  `melder_naam` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `melder_adres` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `melder_gemeente` smallint(4) DEFAULT NULL,
  `melder_telefoon` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `melder_email` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `melder_relatie` int(11) DEFAULT NULL,
  `melder_relatiedetail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `slachtoffer_naam` varchar(200) DEFAULT NULL,
  `slachtoffer_leeftijd` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `slachtoffer_geslacht` enum('M','V') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `slachtoffer_adres` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `slachtoffer_gemeente` smallint(4) DEFAULT NULL,
  `slachtoffer_telefoon` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `slachtoffer_email` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `slachtoffer_weetmelding` tinyint(1) DEFAULT NULL,
  `slachtoffer_ervaartmishandeling` tinyint(1) DEFAULT NULL,
  `samenwonen` tinyint(2) DEFAULT NULL,
  `samenwonen_detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `slachtoffer_meer` tinyint(4) DEFAULT NULL,
  `slachtoffer_meer_detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pleger_naam` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pleger_leeftijd` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pleger_geslacht` enum('M','V') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pleger_adres` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pleger_gemeente` smallint(4) DEFAULT NULL,
  `pleger_telefoon` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pleger_opdehoogte` tinyint(1) DEFAULT NULL,
  `pleger_relatie` int(11) DEFAULT NULL,
  `pleger_relatiedetail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `plegers_aantal` enum('1','2','meer') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `plegers_extra` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `situatieschets` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `vorige` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `justitie_soort` int(11) DEFAULT NULL,
  `justitie_weetmelding` tinyint(1) DEFAULT NULL,
  `justitie_detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `mantelzorgers_aanwezig` tinyint(1) DEFAULT NULL,
  `mantelzorgers_detail` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `contactpersonen_aanwezig` tinyint(1) DEFAULT NULL,
  `contactpersonen_detail` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `opvolging_steunpunt` tinyint(1) DEFAULT NULL,
  `standvanzaken` int(11) DEFAULT NULL,
  `afsluiten_dag` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `afsluiten_maand` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `afsluiten_jaar` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `afsluiten_detail` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `afgerond` int(11) NOT NULL DEFAULT '0',
  `omb_bron` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `voorCAW` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX auteur_idx (`auteur`),
  INDEX datum_idx (`jaar` DESC,`maand` DESC,`dag` DESC),
  CONSTRAINT `FK_omb_registratie`
  FOREIGN KEY (`auteur`) REFERENCES logins(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=152 ;

--
-- Tabelstructuur voor tabel `omb_standvanzaken`
--

CREATE TABLE IF NOT EXISTS `omb_standvanzaken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `standvanzaken` varchar(60) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=7 ;

--
-- Tabelstructuur voor tabel `omb_tijd`
--

CREATE TABLE IF NOT EXISTS `omb_tijd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dag` int(11) NOT NULL DEFAULT '0',
  `maand` int(11) NOT NULL DEFAULT '0',
  `jaar` int(11) NOT NULL DEFAULT '0',
  `uur1` int(11) NOT NULL DEFAULT '0',
  `min1` int(11) NOT NULL DEFAULT '0',
  `sec1` int(11) NOT NULL DEFAULT '0',
  `uur2` int(11) DEFAULT NULL,
  `min2` int(11) DEFAULT NULL,
  `sec2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=161 ;

--
-- Tabelstructuur voor tabel `omb_vraag`
--

CREATE TABLE IF NOT EXISTS `omb_vraag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vraag` varchar(40) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=5 ;

--
-- Tabelstructuur voor tabel `organisatie`
--

CREATE TABLE IF NOT EXISTS `organisatie` (
  `id` int(11) NOT NULL,
  `naam` varchar(150) NOT NULL DEFAULT '',
  `adres` varchar(75) NOT NULL DEFAULT '',
  `gem_id` smallint(4) NOT NULL DEFAULT '9999',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `fax` varchar(20) NOT NULL DEFAULT '',
  `gsm` varchar(20) NOT NULL DEFAULT '',
  `reknr` varchar(20) NOT NULL DEFAULT '',
  `iban` varchar(34) NOT NULL DEFAULT '',
  `bic` varchar(11) NOT NULL DEFAULT '',
  `contact_inhoudelijk` varchar(60) NOT NULL DEFAULT '',
  `email_inhoudelijk` varchar(80) NOT NULL DEFAULT '',
  `contact_administratie` varchar(60) NOT NULL DEFAULT '',
  `email_administratie` varchar(80) NOT NULL DEFAULT '',
  `actief` int(1) NOT NULL DEFAULT '1',
  `genre` enum('ZVL','HVL','XVL','XVLNP','XVLP') DEFAULT NULL,
  `hoofdzetel` int(11) NOT NULL DEFAULT '-1',
  `ggz` tinyint(4) NOT NULL DEFAULT '0',
  `art107` tinyint(4) NOT NULL DEFAULT '0',
  `mobiele_equipe` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX naam_idx (`naam`),
  INDEX gem_id_idx (`gem_id`),
  CONSTRAINT `FK_organisatie_id`
  FOREIGN KEY (`id`) REFERENCES persoon(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_organisatie_gem_id`
  FOREIGN KEY (`gem_id`) REFERENCES gemeente(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=1909 ;

--
-- Tabelstructuur voor tabel `overlegbasis`
--

CREATE  TABLE IF NOT EXISTS `overlegbasis` (
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
    REFERENCES `omb_registratie` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_patient_code`
    FOREIGN KEY (`patient_code` )
    REFERENCES `patient` (`code` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_contact_hvl`
    FOREIGN KEY (`contact_hvl` )
    REFERENCES `hulpverleners` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_contact_mz`
    FOREIGN KEY (`contact_mz` )
    REFERENCES `mantelzorgers` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_katz_id`
    FOREIGN KEY (`katz_id` )
    REFERENCES `katz` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_evalinstr_id`
    FOREIGN KEY (`evalinstr_id` )
    REFERENCES `evalinstr` (`ei_id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_coordinator_id`
    FOREIGN KEY (`coordinator_id` )
    REFERENCES `logins` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_toegewezen_id`
    FOREIGN KEY (`toegewezen_id` )
    REFERENCES `hulpverleners` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `FK_overlegbasis_factuur_code`
    FOREIGN KEY (`factuur_code` )
    REFERENCES `factuurmaand` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE
	)
ENGINE = InnoDB
AUTO_INCREMENT = 432
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

--
-- Tabelstructuur voor tabel `overlegextended`
--

CREATE  TABLE IF NOT EXISTS `overlegextended` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `overleg_id` INT(11) NOT NULL,
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
  `huisarts_belangrijk` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX overleg_idx (`overleg_id`),
  CONSTRAINT `FK_overlegextended_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `overlegbasis` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE
  )
  ENGINE = InnoDB
AUTO_INCREMENT = 265
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;



--
-- Tabelstructuur voor tabel `overlegtp`
--

CREATE  TABLE IF NOT EXISTS `overlegtp` (
 `id` INT(11) NOT NULL AUTO_INCREMENT ,
 `overleg_id` INT(11) NOT NULL,
 `tp_verslag` TEXT NULL DEFAULT NULL ,
 `tp_auteur` ENUM('OC','TP') NULL DEFAULT NULL ,
 `tp_nieuwepartners` TEXT NULL DEFAULT NULL ,
 `tp_rechtenOC` TINYINT(4) NULL DEFAULT '1' ,
 PRIMARY KEY (`id`),
 INDEX overleg_idx (`overleg_id`),
 CONSTRAINT `FK_overlegtp_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `overlegbasis` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE
 )
 ENGINE = InnoDB
AUTO_INCREMENT = 445
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

--
-- Tabelstructuur voor tabel `overlegomb`
--
 
 CREATE TABLE IF NOT EXISTS `overlegomb` (
 `id` INT(11) NOT NULL AUTO_INCREMENT ,
 `overleg_id` INT(11) NOT NULL,
 `omb_factuur` VARCHAR(20) NULL DEFAULT NULL ,
 `omb_actief` INT(11) NULL DEFAULT '0' ,
 `omb_rangorde` INT(11) NULL DEFAULT '0' ,
 PRIMARY KEY (`id`),
 INDEX overleg_idx (`overleg_id`),
CONSTRAINT `FK_overlegomb_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `overlegbasis` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE 
 )
 ENGINE = InnoDB
AUTO_INCREMENT = 475
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

--
-- Tabelstructuur voor tabel `overlegorg`
--

 CREATE TABLE IF NOT EXISTS `overlegorg` (
 `id` INT(11) NOT NULL AUTO_INCREMENT ,
 `overleg_id` INT(11) NOT NULL,
 `organisatie_factuur` INT(11) NULL DEFAULT NULL ,
 `organisatie_factuur_datum` VARCHAR(12) NULL DEFAULT NULL ,
 `organisatie_dubbel` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`),
  INDEX overleg_idx (`overleg_id`),
  CONSTRAINT `FK_overlegorg_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `overlegbasis` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE
  )
  ENGINE = InnoDB
AUTO_INCREMENT = 175
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

--
-- Tabelstructuur voor tabel `overlegpsy`
--
  
 CREATE TABLE IF NOT EXISTS `overlegpsy` (
 `id` INT(11) NOT NULL AUTO_INCREMENT , 
 `overleg_id` INT(11) NOT NULL,
 `psy_algemeen` TEXT NULL DEFAULT NULL ,
 `psy_doelstellingen` TEXT NULL DEFAULT NULL ,
 PRIMARY KEY (`id`),
 INDEX overleg_idx (`overleg_id`),
 CONSTRAINT `FK_overlegpsy_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `overlegbasis` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE
 )
 ENGINE = InnoDB
AUTO_INCREMENT = 155
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

--
-- Tabelstructuur voor tabel `overleglok`
--
  
 CREATE TABLE IF NOT EXISTS `overleglok` (
 `id` INT(11) NOT NULL AUTO_INCREMENT , 
 `overleg_id` INT(11) NOT NULL,
 `lokaal_algemeen` TEXT NULL DEFAULT NULL ,
 `lokaal_doelstellingen` TEXT NULL DEFAULT NULL ,
 PRIMARY KEY (`id`),
 INDEX overleg_idx (`overleg_id`),
 CONSTRAINT `FK_overleglok_overleg_id`
    FOREIGN KEY (`overleg_id` )
    REFERENCES `overlegbasis` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE
 )
 ENGINE = InnoDB
AUTO_INCREMENT = 214
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

--
-- Tabelstructuur voor tabel `overleg_files`
--

CREATE TABLE IF NOT EXISTS `overleg_files` (
  `overleg_id` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(200) NOT NULL DEFAULT '',
  `alias` varchar(200) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `genre` enum('verslag','gewoon') DEFAULT 'gewoon',
  `auteurgenre` enum('OC','TP') DEFAULT 'OC',
  `auteur` int(11) DEFAULT NULL,
  PRIMARY KEY (`filename`),
  INDEX genre_idx (`genre`),
  INDEX overleg_id_idx (`overleg_id`),
  CONSTRAINT `FK_overleg_files_overleg_id`
  FOREIGN KEY (`overleg_id`) REFERENCES overlegbasis(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

--
-- Tabelstructuur voor tabel `overleg_files_rechten`
--

CREATE TABLE IF NOT EXISTS `overleg_files_rechten` (
  `filename` varchar(200) NOT NULL DEFAULT '',
  `genre` varchar(60) NOT NULL DEFAULT '',
  `id` int(11) NOT NULL DEFAULT '0',
  `rechten` int(1) NOT NULL DEFAULT '0',
  INDEX filename_idx (`filename`),
  INDEX id_idx (`id`),
  CONSTRAINT `FK_overleg_files_rechten_filename`
  FOREIGN KEY (`filename`) REFERENCES overleg_files(`filename`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB DEFAULT CHARSET=utf8;

--
-- Tabelstructuur voor tabel `overleg_tp_plan`
--

CREATE TABLE IF NOT EXISTS `overleg_tp_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `overleg` int(11) NOT NULL DEFAULT '0',
  `persoon` int(11) NOT NULL DEFAULT '0',
  `genre` enum('org','orgpersoon','hulp','mantel') NOT NULL DEFAULT 'org',
  `plan` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `persoon_op_overleg` (`persoon`,`overleg`,`genre`),
  CONSTRAINT `FK_overleg_tp_plan_persoon`
  FOREIGN KEY (`persoon`) REFERENCES mantelzorgers(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=500 ;

--
-- Tabelstructuur voor tabel `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL DEFAULT '',
  `naam` varchar(25) NOT NULL DEFAULT '',
  `voornaam` varchar(25) NOT NULL DEFAULT '',
  `sex` tinyint(1) NOT NULL DEFAULT '1',
  `gebdatum` int(8) NOT NULL DEFAULT '0',
  `geboorteplaats` varchar(80) NOT NULL,
  `burgstand_id` int(2) NOT NULL DEFAULT '1',
  `naam_echtg` varchar(25) NOT NULL DEFAULT '',
  `voornaam_echtg` varchar(25) NOT NULL DEFAULT '',
  `adres` varchar(50) NOT NULL DEFAULT '',
  `gem_id` smallint(4) NOT NULL DEFAULT '0',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `gsm` varchar(20) NOT NULL DEFAULT '',
  `woonsit` int(1) NOT NULL DEFAULT '1',
  `mantelz` int(1) NOT NULL DEFAULT '1',
  `alarm` int(1) NOT NULL DEFAULT '0',
  `mut_id` int(3) NOT NULL DEFAULT '1',
  `email` varchar(50) NOT NULL DEFAULT '',
  `actief` int(1) NOT NULL DEFAULT '1',
  `type` int(2) NOT NULL DEFAULT '0',
  `mutnr` varchar(25) NOT NULL DEFAULT '',
  `rijksregister` varchar(11) DEFAULT NULL,
  `startdatum` int(8) DEFAULT NULL,
  `stopzetting_text` tinytext NOT NULL,
  `stopzetting_cat` int(1) NOT NULL DEFAULT '0',
  `einddatum` int(8) NOT NULL DEFAULT '0',
  `minimum_subsidiestatus` int(11) NOT NULL DEFAULT '1',
  `subsidiestatus` enum('niet-verdedigbaar','verdedigbaar','verdedigd','niet-verdedigd','ok') NOT NULL DEFAULT 'niet-verdedigbaar',
  `tp_record` int(11) DEFAULT NULL,
  `omb_actief` tinyint(1) NOT NULL DEFAULT '0',
  `omb_bron` varchar(20) DEFAULT NULL,
  `login` varchar(40) NOT NULL DEFAULT '',
  `paswoord` varchar(40) NOT NULL DEFAULT '',
  `pwd_recovery` varchar(40) NOT NULL DEFAULT '',
  `geheime_vraag` varchar(200) NOT NULL DEFAULT '',
  `geheim_antwoord` varchar(200) NOT NULL DEFAULT '',
  `ipadres` varchar(40) NOT NULL DEFAULT '',
  `logindatum` int(11) NOT NULL DEFAULT '0',
  `validatiestatus` enum('geenkeuze','halfweg','gevalideerd','weigering') NOT NULL DEFAULT 'geenkeuze',
  `aanvraagdatum` date NOT NULL DEFAULT '1000-01-01',
  `validatiedatum` date NOT NULL DEFAULT '1000-01-01',
  `weigerdatum` date NOT NULL DEFAULT '1000-01-01',
  `toegewezen_genre` enum('gemeente','rdc','hulp','psy') NOT NULL DEFAULT 'gemeente',
  `toegewezen_id` int(11) DEFAULT NULL,
  `menos` tinyint(4) NOT NULL DEFAULT '0',
  `toestemming_zh` tinyint(1) NOT NULL DEFAULT '0',
  `zorgtraject_diabetes` tinyint(4) NOT NULL,
  `zorgtraject_nieren` tinyint(4) NOT NULL,
  `zorgtraject_datum` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY `pat_id` (`id`),
  INDEX gem_id_idx (`gem_id`),
  INDEX mut_id_idx (`mut_id`),
  INDEX burgstand_id_idx (`burgstand_id`),
  CONSTRAINT `FK_patient_gem_id`
  FOREIGN KEY (`gem_id`) REFERENCES gemeente(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_patient_mut_id`
  FOREIGN KEY (`mut_id`) REFERENCES verzekering(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_patient_burgstand_id`
  FOREIGN KEY (`burgstand_id`) REFERENCES burgstaat(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1513 ;

--
-- Tabelstructuur voor tabel `patient_menos`
--

CREATE TABLE IF NOT EXISTS `patient_menos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient` varchar(20) COLLATE utf8_general_ci NOT NULL,
  `complexe_verzorging` tinytext COLLATE utf8_general_ci,
  `katz` enum('A','B','C') COLLATE utf8_general_ci DEFAULT NULL,
  `diagnose_dementie` tinyint(4) DEFAULT NULL,
  `diagnose` text COLLATE utf8_general_ci,
  `edmonton_schaal` tinyint(4) DEFAULT NULL,
  `jonger` tinyint(4) DEFAULT NULL,
  `uitzondering` tinyint(4) NOT NULL,
  `informed_consent` tinyint(4) NOT NULL,
  `meetschaal_dag` int(11) NOT NULL,
  `meetschaal_maand` int(11) NOT NULL,
  `meetschaal_jaar` int(11) NOT NULL,
  `economie` tinyint(4) NOT NULL,
  `hc` tinyint(4) NOT NULL,
  `who` tinyint(4) NOT NULL,
  `zarit` tinyint(4) NOT NULL,
  `afspraken` text COLLATE utf8_general_ci,
  `begindatum` date NOT NULL,
  `einddatum` date DEFAULT NULL,
  `reden` text COLLATE utf8_general_ci,
  `menos2gdt_vraag` tinyint(4) NOT NULL DEFAULT '1',
  `menos2gdt_toestemming` tinyint(4) NOT NULL DEFAULT '1',
  `gdt2menos_vraag` tinyint(4) NOT NULL DEFAULT '1',
  `gdt2menos_toestemming` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `patient` (`patient`),
  CONSTRAINT `FK_patient_menos_patient`
  FOREIGN KEY (`patient`) REFERENCES patient(`code`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=68 ;

--
-- Tabelstructuur voor tabel `patient_psy`
--

CREATE TABLE IF NOT EXISTS `patient_psy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) COLLATE utf8_general_ci NOT NULL,
  `startdatum` int(8) DEFAULT NULL,
  `einddatum` int(8) DEFAULT NULL,
  `stopzetting_text` tinytext COLLATE utf8_general_ci,
  `stopzetting_cat` int(1) DEFAULT NULL,
  `tp_nummer` int(11) DEFAULT NULL,
  `hoofddiagnose` varchar(10) COLLATE utf8_general_ci NOT NULL,
  `diagnose_genre` enum('dsm','icd') COLLATE utf8_general_ci NOT NULL,
  `nood_begeleidingsplan` tinyint(1) NOT NULL,
  `toename_symptonen` tinyint(1) NOT NULL,
  `ziekenhuis` tinyint(1) NOT NULL,
  `art107` tinyint(1) NOT NULL,
  `ziekenhuis_ander` tinyint(1) NOT NULL,
  `outreach` tinyint(1) DEFAULT NULL,
  `cgg` tinyint(1) DEFAULT NULL,
  `politie` tinyint(1) DEFAULT NULL,
  `domeinen` int(11) NOT NULL,
  `crisissituatie` text COLLATE utf8_general_ci,
  `crisis_id` int(11) DEFAULT NULL,
  `crisis_genre` enum('hulp','mantel','referentie') COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`),
  INDEX startdatum_idx (`startdatum`),
  INDEX code_idx (`code`),
  CONSTRAINT `FK_patient_psy_code`
  FOREIGN KEY (`code`) REFERENCES patient(`code`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=142 ;

--
-- Tabelstructuur voor tabel `patient_secundair`
--

CREATE TABLE IF NOT EXISTS `patient_secundair` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient` varchar(20) NOT NULL DEFAULT '',
  `project` int(11) NOT NULL DEFAULT '0',
  `dsm` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  INDEX project_idx (`project`),
  INDEX patient_idx (`patient`),
  INDEX dsm_idx (`dsm`),
  CONSTRAINT `FK_patient_secundair_project`
  FOREIGN KEY (`project`) REFERENCES tp_project(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_patient_secundair_patient`
  FOREIGN KEY (`patient`) REFERENCES patient(`code`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=218 ;

--
-- Tabelstructuur voor tabel `patient_tp`
--

CREATE TABLE IF NOT EXISTS `patient_tp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient` varchar(20) NOT NULL DEFAULT '',
  `project` int(11) NOT NULL DEFAULT '0',
  `begindatum` date NOT NULL DEFAULT '1000-01-01',
  `einddatum` date DEFAULT NULL,
  `omschrijving` text,
  `hoofddiagnose` varchar(20) DEFAULT NULL,
  `diagnosegenre` enum('dsm','icd') NOT NULL DEFAULT 'dsm',
  `secundairediagnose` varchar(20) DEFAULT NULL,
  `aanvullend1` tinyint(1) NOT NULL DEFAULT '0',
  `aanvullend2` tinyint(1) NOT NULL DEFAULT '0',
  `aanvullend3` tinyint(1) NOT NULL DEFAULT '0',
  `aanvullend4` tinyint(1) NOT NULL DEFAULT '0',
  `aanvullend5` tinyint(1) NOT NULL DEFAULT '0',
  `aanvullend6` tinyint(1) NOT NULL DEFAULT '0',
  `aanvullend7` tinyint(1) NOT NULL DEFAULT '0',
  `aanvullend8` tinyint(1) NOT NULL DEFAULT '0',
  `opname_overige` varchar(255) DEFAULT NULL,
  `toestemming` tinyint(4) NOT NULL DEFAULT '1',
  `rechtenOC` varchar(8) DEFAULT NULL,
  `in_email` tinyint(1) NOT NULL DEFAULT '0',
  `in_print` tinyint(1) NOT NULL DEFAULT '0',
  `uit_email` tinyint(1) NOT NULL DEFAULT '0',
  `uit_print` tinyint(1) NOT NULL DEFAULT '0',
  `stopzetting_text` tinytext,
  `stopzetting_cat` int(1) DEFAULT NULL,
  `actief` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX actief_idx (`actief` DESC),
  INDEX einddatum_idx (`einddatum` DESC),
  INDEX patient_idx (`patient`),
  INDEX project_idx (`project`),
  CONSTRAINT `FK_patient_tp_project`
  FOREIGN KEY (`project`) REFERENCES tp_project(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_patient_tp_patient`
  FOREIGN KEY (`patient`) REFERENCES patient(`code`) ON UPDATE CASCADE ON DELETE RESTRICT
  
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=165 ;

--
-- Tabelstructuur voor tabel `patient_tpopname`
--

CREATE TABLE IF NOT EXISTS `patient_tpopname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient` varchar(20) NOT NULL DEFAULT '',
  `project` int(11) NOT NULL DEFAULT '0',
  `partner` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX partner_idx (`partner`),
  CONSTRAINT `FK_patient_tpopname_partner`
  FOREIGN KEY (`partner`) REFERENCES organisatie(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=193 ;

--
-- Tabelstructuur voor tabel `patient_tpvragen`
--

CREATE TABLE IF NOT EXISTS `patient_tpvragen` (
  `patient` varchar(20) NOT NULL DEFAULT '',
  `tp` int(11) NOT NULL DEFAULT '0',
  `vraag` int(11) NOT NULL DEFAULT '0',
  `antwoord` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`patient`,`tp`,`vraag`,`antwoord`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

--
-- Tabelstructuur voor tabel `patient_zorgtraject`
--

CREATE TABLE IF NOT EXISTS `patient_zorgtraject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient` varchar(30) COLLATE utf8_general_ci NOT NULL,
  `diabetes` tinyint(4) NOT NULL,
  `nieren` tinyint(4) NOT NULL,
  `datum` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=2 ;

--
-- Tabelstructuur voor tabel `persoon`
--
CREATE TABLE IF NOT EXISTS `persoon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persoon_type` CHAR(3),
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tabelstructuur voor tabel `psy_comorbiditeit`
--

CREATE TABLE IF NOT EXISTS `psy_comorbiditeit` (
  `patient` varchar(30) COLLATE utf8_general_ci NOT NULL,
  `diagnose` varchar(20) COLLATE utf8_general_ci NOT NULL,
  `genre` enum('dsm','icd') COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`patient`,`diagnose`,`genre`),
  KEY `patient` (`patient`),
  INDEX diagnose_idx (`diagnose`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tabelstructuur voor tabel `psy_crisis`
--

CREATE TABLE IF NOT EXISTS `psy_crisis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `overleg_id` int(11) DEFAULT NULL,
  `crisis_id` int(11) DEFAULT NULL,
  `crisis_genre` enum('hulp','mantel','referentie') COLLATE utf8_general_ci DEFAULT NULL,
  `crisissituatie` text COLLATE utf8_general_ci,
  PRIMARY KEY (`id`),
  KEY `overleg_id` (`overleg_id`),
  CONSTRAINT `FK_psy_crisis_overleg_id`
  FOREIGN KEY (`overleg_id`) REFERENCES overlegbasis(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=86 ;

--
-- Tabelstructuur voor tabel `psy_domeinen`
--

CREATE TABLE IF NOT EXISTS `psy_domeinen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) COLLATE utf8_general_ci NOT NULL,
  `datum` int(8) NOT NULL,
  `basis` tinyint(1) NOT NULL,
  `woon` tinyint(1) NOT NULL,
  `gemeenschap` tinyint(1) NOT NULL,
  `taal` tinyint(1) NOT NULL,
  `maatschappij` tinyint(1) NOT NULL,
  `werk` tinyint(1) NOT NULL,
  `gezin` tinyint(1) NOT NULL,
  `school` tinyint(1) NOT NULL,
  `sociaal` tinyint(1) NOT NULL,
  `motoriek` tinyint(1) NOT NULL,
  `persoonlijk` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`),
  INDEX datum_idx (`datum` DESC, `id` DESC)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=236 ;

--
-- Tabelstructuur voor tabel `psy_dsm`
--

CREATE TABLE IF NOT EXISTS `psy_dsm` (
  `code` varchar(8) COLLATE utf8_general_ci NOT NULL,
  `hoofddiagnose` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`code`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tabelstructuur voor tabel `psy_plan`
--

CREATE TABLE IF NOT EXISTS `psy_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domein` varchar(16) COLLATE utf8_general_ci NOT NULL,
  `overleg_id` int(11) NOT NULL,
  `afspraak` text COLLATE utf8_general_ci NOT NULL,
  `einddatum` text COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  INDEX overleg_id_idx (`overleg_id`),
  CONSTRAINT `FK_psy_plan`
  FOREIGN KEY (`overleg_id`) REFERENCES overlegbasis(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1008 ;

--
-- Tabelstructuur voor tabel `psy_plan_mens`
--

CREATE TABLE IF NOT EXISTS `psy_plan_mens` (
  `plan` int(11) NOT NULL,
  `persoon_id` int(11) DEFAULT NULL,
  `genre` enum('hulp','mantel','patient','oc','ander') CHARACTER SET utf8 NOT NULL,
  KEY `plan` (`plan`),
  INDEX genre_idx (`genre`),
  INDEX persoon_id_idx (`persoon_id`),
  CONSTRAINT `FK_psy_plan_mens_plan`
  FOREIGN KEY (`plan`) REFERENCES psy_plan(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_psy_plan_mens_persoon_id`
  FOREIGN KEY (`persoon_id`) REFERENCES persoon(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tabelstructuur voor tabel `riziv_tarieven`
--

CREATE TABLE IF NOT EXISTS `riziv_tarieven` (
  `datum` varchar(8) NOT NULL DEFAULT '',
  `thuis` float NOT NULL DEFAULT '0',
  `elders` float NOT NULL DEFAULT '0',
  `registratie` float NOT NULL DEFAULT '0',
  `thuisPVS` float NOT NULL DEFAULT '0',
  `eldersPVS` float NOT NULL DEFAULT '0',
  `registratiePVS` float NOT NULL DEFAULT '0',
  `zhTP` float NOT NULL DEFAULT '0',
  `nietzhTP` float NOT NULL DEFAULT '0',
  `registratie_zhTP` float NOT NULL DEFAULT '0',
  `registratie_nietzhTP` float NOT NULL DEFAULT '0',
  `omb` double NOT NULL DEFAULT '30',
  `registratieomb` double NOT NULL DEFAULT '10',
  `organisatie` double NOT NULL DEFAULT '43.11',
  `actief` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`datum`),
  INDEX datum_idx (`datum` DESC),
  INDEX actief_idx (`actief`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

--
-- Tabelstructuur voor tabel `sit`
--

CREATE TABLE IF NOT EXISTS `sit` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nr` varchar(2) NOT NULL DEFAULT '',
  `naam` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  INDEX nr_idx (`nr`),
  INDEX naam_idx (`naam`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Tabelstructuur voor tabel `taakfiche`
--

CREATE TABLE IF NOT EXISTS `taakfiche` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(40) NOT NULL DEFAULT '0',
  `taak` text NOT NULL,
  `categorie` enum('Verzorging','Mobiliteit','Huishouden','Toezicht','Sociaal\r\n\r\nleven','Financieel','Hulpmiddelen','Andere') NOT NULL DEFAULT 'Verzorging',
  `frequentie` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  INDEX categorie_idx (`categorie`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=178 ;

--
-- Tabelstructuur voor tabel `taakfiche_mensen`
--

CREATE TABLE IF NOT EXISTS `taakfiche_mensen` (
  `mens_id` int(11) NOT NULL DEFAULT '0',
  `mens_type` varchar(5) NOT NULL DEFAULT '0',
  `taakfiche_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mens_id`,`mens_type`,`taakfiche_id`),
  INDEX mens_type_idx (`mens_type` DESC),
  INDEX taakfiche_id_idx (`taakfiche_id`),
  CONSTRAINT `FK_taakfiche_mensen_mens_hvl`
  FOREIGN KEY (`mens_id`) REFERENCES hulpverleners(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_taakfiche_mensen_mens_mz`
  FOREIGN KEY (`mens_id`) REFERENCES mantelzorgers(`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `FK_taakfiche_taakfiche_id` 
  FOREIGN KEY (`taakfiche_id`) REFERENCES taakfiche(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

--
-- Tabelstructuur voor tabel `tp_alle_dsm`
--

CREATE TABLE IF NOT EXISTS `tp_alle_dsm` (
  `dsm` varchar(20) NOT NULL DEFAULT '',
  `genre` enum('dsm','icd') NOT NULL DEFAULT 'dsm',
  PRIMARY KEY (`dsm`,`genre`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;


--
-- Tabelstructuur voor tabel `tp_antwoorden`
--

CREATE TABLE IF NOT EXISTS `tp_antwoorden` (
  `tp` int(11) NOT NULL DEFAULT '0',
  `vraag` int(11) NOT NULL DEFAULT '0',
  `optie` int(11) NOT NULL DEFAULT '0',
  `antwoord` text NOT NULL,
  PRIMARY KEY (`tp`,`vraag`,`optie`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

--
-- Tabelstructuur voor tabel `tp_dsm`
--

CREATE TABLE IF NOT EXISTS `tp_dsm` (
  `tp` int(11) NOT NULL DEFAULT '0',
  `dsm` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`tp`,`dsm`),
  KEY `dsm` (`dsm`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

--
-- Tabelstructuur voor tabel `tp_oude_rechten`
--

CREATE TABLE IF NOT EXISTS `tp_oude_rechten` (
  `patient_tp_id` int(11) NOT NULL DEFAULT '0',
  `start` varchar(10) NOT NULL DEFAULT '',
  `einde` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`patient_tp_id`,`start`,`einde`),
  CONSTRAINT `FK_tp_oude_rechten`
  FOREIGN KEY (`patient_tp_id`) REFERENCES patient_tp(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

--
-- Tabelstructuur voor tabel `tp_partner`
--

CREATE TABLE IF NOT EXISTS `tp_partner` (
  `tp` int(11) NOT NULL DEFAULT '0',
  `partner` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tp`,`partner`),
  INDEX partner_idx (`partner`),
  CONSTRAINT `FK_tp_partner_partner`
  FOREIGN KEY (`partner`) REFERENCES organisatie(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB DEFAULT CHARSET=utf8;

--
-- Tabelstructuur voor tabel `tp_project`
--

CREATE TABLE IF NOT EXISTS `tp_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nummer` int(11) NOT NULL DEFAULT '0',
  `naam` varchar(255) NOT NULL DEFAULT '',
  `doelgroep` enum('kinderen en jongeren','volwassenen','ouderen','forensische kinderen') DEFAULT NULL,
  `diagnosegenre` enum('dsm','icd') DEFAULT NULL,
  `bijkomend_complexiteit` text NOT NULL,
  `bijkomend_langdurig` text NOT NULL,
  `aanvullend1` varchar(120) DEFAULT NULL,
  `aanvullend2` varchar(120) DEFAULT NULL,
  `aanvullend3` varchar(120) DEFAULT NULL,
  `aanvullend4` varchar(120) DEFAULT NULL,
  `aanvullend5` varchar(120) DEFAULT NULL,
  `aanvullend6` varchar(120) DEFAULT NULL,
  `aanvullend7` varchar(120) DEFAULT NULL,
  `aanvullend8` varchar(120) DEFAULT NULL,
  `actief` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nummer` (`nummer`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Tabelstructuur voor tabel `tp_vragen`
--

CREATE TABLE IF NOT EXISTS `tp_vragen` (
  `tp` int(11) NOT NULL DEFAULT '0',
  `nr` int(11) NOT NULL DEFAULT '0',
  `vraag` text NOT NULL,
  PRIMARY KEY (`tp`,`nr`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;


--
-- Tabelstructuur voor tabel `tp_werkingsgebied`
--

CREATE TABLE IF NOT EXISTS `tp_werkingsgebied` (
  `tp` int(11) NOT NULL DEFAULT '0',
  `gemeente` smallint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tp`,`gemeente`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='gemeente is een beetje misleidend, kan ook provincie zijn (n';

--
-- Tabelstructuur voor tabel `verwantschap`
--

CREATE TABLE IF NOT EXISTS `verwantschap` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `naam` varchar(30) NOT NULL DEFAULT '',
  `rangorde` int(2) NOT NULL DEFAULT '0',
  `actief` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX naam_idx (`naam`),
  INDEX rangorde_idx (`rangorde`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;


--
-- Tabelstructuur voor tabel `verzekering`
--

CREATE TABLE IF NOT EXISTS `verzekering` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nr` varchar(5) NOT NULL DEFAULT '0',
  `naam` varchar(100) NOT NULL DEFAULT '',
  `dienst` varchar(40) NOT NULL DEFAULT '',
  `contact` varchar(80) NOT NULL DEFAULT '',
  `adres` varchar(50) NOT NULL DEFAULT '',
  `gem_id` smallint(4) NOT NULL DEFAULT '9999',
  `tel` varchar(12) NOT NULL DEFAULT '',
  `fax` varchar(12) NOT NULL DEFAULT '',
  `gsm` varchar(12) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `actief` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX nr_idx (`nr`),
  INDEX naam_idx (`naam`),
  INDEX gem_id_idx (`gem_id`),
  CONSTRAINT `FK_verzekering_gem_id`
  FOREIGN KEY (`gem_id`) REFERENCES gemeente(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;
