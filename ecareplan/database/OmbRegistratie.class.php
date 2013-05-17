<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class OmbRegistratie extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='OmbRegistratie';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='omb_registratie';
	const SQL_INSERT='INSERT INTO `omb_registratie` (`id`,`auteur`,`dag`,`maand`,`jaar`,`dagnummer`,`contactwijze`,`bekendheid`,`doorverwijzing_intern`,`doorverwijzing_extern`,`genre_melding`,`melder_soort`,`melderhvl_id`,`melder_naam`,`melder_adres`,`melder_gemeente`,`melder_telefoon`,`melder_email`,`melder_relatie`,`melder_relatiedetail`,`slachtoffer_naam`,`slachtoffer_leeftijd`,`slachtoffer_geslacht`,`slachtoffer_adres`,`slachtoffer_gemeente`,`slachtoffer_telefoon`,`slachtoffer_email`,`slachtoffer_weetmelding`,`slachtoffer_ervaartmishandeling`,`samenwonen`,`samenwonen_detail`,`slachtoffer_meer`,`slachtoffer_meer_detail`,`pleger_naam`,`pleger_leeftijd`,`pleger_geslacht`,`pleger_adres`,`pleger_gemeente`,`pleger_telefoon`,`pleger_opdehoogte`,`pleger_relatie`,`pleger_relatiedetail`,`plegers_aantal`,`plegers_extra`,`situatieschets`,`vorige`,`justitie_soort`,`justitie_weetmelding`,`justitie_detail`,`mantelzorgers_aanwezig`,`mantelzorgers_detail`,`contactpersonen_aanwezig`,`contactpersonen_detail`,`opvolging_steunpunt`,`standvanzaken`,`afsluiten_dag`,`afsluiten_maand`,`afsluiten_jaar`,`afsluiten_detail`,`afgerond`,`omb_bron`,`voorCAW`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `omb_registratie` (`auteur`,`dag`,`maand`,`jaar`,`dagnummer`,`contactwijze`,`bekendheid`,`doorverwijzing_intern`,`doorverwijzing_extern`,`genre_melding`,`melder_soort`,`melderhvl_id`,`melder_naam`,`melder_adres`,`melder_gemeente`,`melder_telefoon`,`melder_email`,`melder_relatie`,`melder_relatiedetail`,`slachtoffer_naam`,`slachtoffer_leeftijd`,`slachtoffer_geslacht`,`slachtoffer_adres`,`slachtoffer_gemeente`,`slachtoffer_telefoon`,`slachtoffer_email`,`slachtoffer_weetmelding`,`slachtoffer_ervaartmishandeling`,`samenwonen`,`samenwonen_detail`,`slachtoffer_meer`,`slachtoffer_meer_detail`,`pleger_naam`,`pleger_leeftijd`,`pleger_geslacht`,`pleger_adres`,`pleger_gemeente`,`pleger_telefoon`,`pleger_opdehoogte`,`pleger_relatie`,`pleger_relatiedetail`,`plegers_aantal`,`plegers_extra`,`situatieschets`,`vorige`,`justitie_soort`,`justitie_weetmelding`,`justitie_detail`,`mantelzorgers_aanwezig`,`mantelzorgers_detail`,`contactpersonen_aanwezig`,`contactpersonen_detail`,`opvolging_steunpunt`,`standvanzaken`,`afsluiten_dag`,`afsluiten_maand`,`afsluiten_jaar`,`afsluiten_detail`,`afgerond`,`omb_bron`,`voorCAW`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `omb_registratie` SET `id`=?,`auteur`=?,`dag`=?,`maand`=?,`jaar`=?,`dagnummer`=?,`contactwijze`=?,`bekendheid`=?,`doorverwijzing_intern`=?,`doorverwijzing_extern`=?,`genre_melding`=?,`melder_soort`=?,`melderhvl_id`=?,`melder_naam`=?,`melder_adres`=?,`melder_gemeente`=?,`melder_telefoon`=?,`melder_email`=?,`melder_relatie`=?,`melder_relatiedetail`=?,`slachtoffer_naam`=?,`slachtoffer_leeftijd`=?,`slachtoffer_geslacht`=?,`slachtoffer_adres`=?,`slachtoffer_gemeente`=?,`slachtoffer_telefoon`=?,`slachtoffer_email`=?,`slachtoffer_weetmelding`=?,`slachtoffer_ervaartmishandeling`=?,`samenwonen`=?,`samenwonen_detail`=?,`slachtoffer_meer`=?,`slachtoffer_meer_detail`=?,`pleger_naam`=?,`pleger_leeftijd`=?,`pleger_geslacht`=?,`pleger_adres`=?,`pleger_gemeente`=?,`pleger_telefoon`=?,`pleger_opdehoogte`=?,`pleger_relatie`=?,`pleger_relatiedetail`=?,`plegers_aantal`=?,`plegers_extra`=?,`situatieschets`=?,`vorige`=?,`justitie_soort`=?,`justitie_weetmelding`=?,`justitie_detail`=?,`mantelzorgers_aanwezig`=?,`mantelzorgers_detail`=?,`contactpersonen_aanwezig`=?,`contactpersonen_detail`=?,`opvolging_steunpunt`=?,`standvanzaken`=?,`afsluiten_dag`=?,`afsluiten_maand`=?,`afsluiten_jaar`=?,`afsluiten_detail`=?,`afgerond`=?,`omb_bron`=?,`voorCAW`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `omb_registratie` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `omb_registratie` WHERE `id`=?';
	const FIELD_ID=603922169;
	const FIELD_AUTEUR=-1267463712;
	const FIELD_DAG=1541713260;
	const FIELD_MAAND=-168964827;
	const FIELD_JAAR=548649478;
	const FIELD_DAGNUMMER=-1972834048;
	const FIELD_CONTACTWIJZE=216631617;
	const FIELD_BEKENDHEID=-500326263;
	const FIELD_DOORVERWIJZING_INTERN=1760147720;
	const FIELD_DOORVERWIJZING_EXTERN=1654866326;
	const FIELD_GENRE_MELDING=897703288;
	const FIELD_MELDER_SOORT=-251132303;
	const FIELD_MELDERHVL_ID=9195575;
	const FIELD_MELDER_NAAM=823020099;
	const FIELD_MELDER_ADRES=-268080903;
	const FIELD_MELDER_GEMEENTE=556999668;
	const FIELD_MELDER_TELEFOON=1710098998;
	const FIELD_MELDER_EMAIL=-264134920;
	const FIELD_MELDER_RELATIE=-1997043452;
	const FIELD_MELDER_RELATIEDETAIL=1836043861;
	const FIELD_SLACHTOFFER_NAAM=-397657017;
	const FIELD_SLACHTOFFER_LEEFTIJD=1043620977;
	const FIELD_SLACHTOFFER_GESLACHT=1325281293;
	const FIELD_SLACHTOFFER_ADRES=545634165;
	const FIELD_SLACHTOFFER_GEMEENTE=1147171832;
	const FIELD_SLACHTOFFER_TELEFOON=-1994696134;
	const FIELD_SLACHTOFFER_EMAIL=549580148;
	const FIELD_SLACHTOFFER_WEETMELDING=1847026189;
	const FIELD_SLACHTOFFER_ERVAARTMISHANDELING=1620827384;
	const FIELD_SAMENWONEN=-1697787947;
	const FIELD_SAMENWONEN_DETAIL=-401622021;
	const FIELD_SLACHTOFFER_MEER=-397682835;
	const FIELD_SLACHTOFFER_MEER_DETAIL=-423724701;
	const FIELD_PLEGER_NAAM=-947718155;
	const FIELD_PLEGER_LEEFTIJD=-416704225;
	const FIELD_PLEGER_GESLACHT=-135043909;
	const FIELD_PLEGER_ADRES=673608071;
	const FIELD_PLEGER_GEMEENTE=-313153370;
	const FIELD_PLEGER_TELEFOON=839945960;
	const FIELD_PLEGER_OPDEHOOGTE=1309295304;
	const FIELD_PLEGER_RELATIE=1022928402;
	const FIELD_PLEGER_RELATIEDETAIL=1442736355;
	const FIELD_PLEGERS_AANTAL=1712407686;
	const FIELD_PLEGERS_EXTRA=-78923397;
	const FIELD_SITUATIESCHETS=2094611280;
	const FIELD_VORIGE=-671848852;
	const FIELD_JUSTITIE_SOORT=-1632992473;
	const FIELD_JUSTITIE_WEETMELDING=1686666439;
	const FIELD_JUSTITIE_DETAIL=478300799;
	const FIELD_MANTELZORGERS_AANWEZIG=-490700994;
	const FIELD_MANTELZORGERS_DETAIL=-1412445677;
	const FIELD_CONTACTPERSONEN_AANWEZIG=279498139;
	const FIELD_CONTACTPERSONEN_DETAIL=1833044912;
	const FIELD_OPVOLGING_STEUNPUNT=-1655706536;
	const FIELD_STANDVANZAKEN=-862493246;
	const FIELD_AFSLUITEN_DAG=-1705486536;
	const FIELD_AFSLUITEN_MAAND=1713255409;
	const FIELD_AFSLUITEN_JAAR=-1330296390;
	const FIELD_AFSLUITEN_DETAIL=1317895651;
	const FIELD_AFGEROND=938163796;
	const FIELD_OMB_BRON=1336102568;
	const FIELD_VOORCAW=644983999;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_AUTEUR=>'auteur',
		self::FIELD_DAG=>'dag',
		self::FIELD_MAAND=>'maand',
		self::FIELD_JAAR=>'jaar',
		self::FIELD_DAGNUMMER=>'dagnummer',
		self::FIELD_CONTACTWIJZE=>'contactwijze',
		self::FIELD_BEKENDHEID=>'bekendheid',
		self::FIELD_DOORVERWIJZING_INTERN=>'doorverwijzing_intern',
		self::FIELD_DOORVERWIJZING_EXTERN=>'doorverwijzing_extern',
		self::FIELD_GENRE_MELDING=>'genre_melding',
		self::FIELD_MELDER_SOORT=>'melder_soort',
		self::FIELD_MELDERHVL_ID=>'melderhvl_id',
		self::FIELD_MELDER_NAAM=>'melder_naam',
		self::FIELD_MELDER_ADRES=>'melder_adres',
		self::FIELD_MELDER_GEMEENTE=>'melder_gemeente',
		self::FIELD_MELDER_TELEFOON=>'melder_telefoon',
		self::FIELD_MELDER_EMAIL=>'melder_email',
		self::FIELD_MELDER_RELATIE=>'melder_relatie',
		self::FIELD_MELDER_RELATIEDETAIL=>'melder_relatiedetail',
		self::FIELD_SLACHTOFFER_NAAM=>'slachtoffer_naam',
		self::FIELD_SLACHTOFFER_LEEFTIJD=>'slachtoffer_leeftijd',
		self::FIELD_SLACHTOFFER_GESLACHT=>'slachtoffer_geslacht',
		self::FIELD_SLACHTOFFER_ADRES=>'slachtoffer_adres',
		self::FIELD_SLACHTOFFER_GEMEENTE=>'slachtoffer_gemeente',
		self::FIELD_SLACHTOFFER_TELEFOON=>'slachtoffer_telefoon',
		self::FIELD_SLACHTOFFER_EMAIL=>'slachtoffer_email',
		self::FIELD_SLACHTOFFER_WEETMELDING=>'slachtoffer_weetmelding',
		self::FIELD_SLACHTOFFER_ERVAARTMISHANDELING=>'slachtoffer_ervaartmishandeling',
		self::FIELD_SAMENWONEN=>'samenwonen',
		self::FIELD_SAMENWONEN_DETAIL=>'samenwonen_detail',
		self::FIELD_SLACHTOFFER_MEER=>'slachtoffer_meer',
		self::FIELD_SLACHTOFFER_MEER_DETAIL=>'slachtoffer_meer_detail',
		self::FIELD_PLEGER_NAAM=>'pleger_naam',
		self::FIELD_PLEGER_LEEFTIJD=>'pleger_leeftijd',
		self::FIELD_PLEGER_GESLACHT=>'pleger_geslacht',
		self::FIELD_PLEGER_ADRES=>'pleger_adres',
		self::FIELD_PLEGER_GEMEENTE=>'pleger_gemeente',
		self::FIELD_PLEGER_TELEFOON=>'pleger_telefoon',
		self::FIELD_PLEGER_OPDEHOOGTE=>'pleger_opdehoogte',
		self::FIELD_PLEGER_RELATIE=>'pleger_relatie',
		self::FIELD_PLEGER_RELATIEDETAIL=>'pleger_relatiedetail',
		self::FIELD_PLEGERS_AANTAL=>'plegers_aantal',
		self::FIELD_PLEGERS_EXTRA=>'plegers_extra',
		self::FIELD_SITUATIESCHETS=>'situatieschets',
		self::FIELD_VORIGE=>'vorige',
		self::FIELD_JUSTITIE_SOORT=>'justitie_soort',
		self::FIELD_JUSTITIE_WEETMELDING=>'justitie_weetmelding',
		self::FIELD_JUSTITIE_DETAIL=>'justitie_detail',
		self::FIELD_MANTELZORGERS_AANWEZIG=>'mantelzorgers_aanwezig',
		self::FIELD_MANTELZORGERS_DETAIL=>'mantelzorgers_detail',
		self::FIELD_CONTACTPERSONEN_AANWEZIG=>'contactpersonen_aanwezig',
		self::FIELD_CONTACTPERSONEN_DETAIL=>'contactpersonen_detail',
		self::FIELD_OPVOLGING_STEUNPUNT=>'opvolging_steunpunt',
		self::FIELD_STANDVANZAKEN=>'standvanzaken',
		self::FIELD_AFSLUITEN_DAG=>'afsluiten_dag',
		self::FIELD_AFSLUITEN_MAAND=>'afsluiten_maand',
		self::FIELD_AFSLUITEN_JAAR=>'afsluiten_jaar',
		self::FIELD_AFSLUITEN_DETAIL=>'afsluiten_detail',
		self::FIELD_AFGEROND=>'afgerond',
		self::FIELD_OMB_BRON=>'omb_bron',
		self::FIELD_VOORCAW=>'voorCAW');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_AUTEUR=>'auteur',
		self::FIELD_DAG=>'dag',
		self::FIELD_MAAND=>'maand',
		self::FIELD_JAAR=>'jaar',
		self::FIELD_DAGNUMMER=>'dagnummer',
		self::FIELD_CONTACTWIJZE=>'contactwijze',
		self::FIELD_BEKENDHEID=>'bekendheid',
		self::FIELD_DOORVERWIJZING_INTERN=>'doorverwijzingIntern',
		self::FIELD_DOORVERWIJZING_EXTERN=>'doorverwijzingExtern',
		self::FIELD_GENRE_MELDING=>'genreMelding',
		self::FIELD_MELDER_SOORT=>'melderSoort',
		self::FIELD_MELDERHVL_ID=>'melderhvlId',
		self::FIELD_MELDER_NAAM=>'melderNaam',
		self::FIELD_MELDER_ADRES=>'melderAdres',
		self::FIELD_MELDER_GEMEENTE=>'melderGemeente',
		self::FIELD_MELDER_TELEFOON=>'melderTelefoon',
		self::FIELD_MELDER_EMAIL=>'melderEmail',
		self::FIELD_MELDER_RELATIE=>'melderRelatie',
		self::FIELD_MELDER_RELATIEDETAIL=>'melderRelatiedetail',
		self::FIELD_SLACHTOFFER_NAAM=>'slachtofferNaam',
		self::FIELD_SLACHTOFFER_LEEFTIJD=>'slachtofferLeeftijd',
		self::FIELD_SLACHTOFFER_GESLACHT=>'slachtofferGeslacht',
		self::FIELD_SLACHTOFFER_ADRES=>'slachtofferAdres',
		self::FIELD_SLACHTOFFER_GEMEENTE=>'slachtofferGemeente',
		self::FIELD_SLACHTOFFER_TELEFOON=>'slachtofferTelefoon',
		self::FIELD_SLACHTOFFER_EMAIL=>'slachtofferEmail',
		self::FIELD_SLACHTOFFER_WEETMELDING=>'slachtofferWeetmelding',
		self::FIELD_SLACHTOFFER_ERVAARTMISHANDELING=>'slachtofferErvaartmishandeling',
		self::FIELD_SAMENWONEN=>'samenwonen',
		self::FIELD_SAMENWONEN_DETAIL=>'samenwonenDetail',
		self::FIELD_SLACHTOFFER_MEER=>'slachtofferMeer',
		self::FIELD_SLACHTOFFER_MEER_DETAIL=>'slachtofferMeerDetail',
		self::FIELD_PLEGER_NAAM=>'plegerNaam',
		self::FIELD_PLEGER_LEEFTIJD=>'plegerLeeftijd',
		self::FIELD_PLEGER_GESLACHT=>'plegerGeslacht',
		self::FIELD_PLEGER_ADRES=>'plegerAdres',
		self::FIELD_PLEGER_GEMEENTE=>'plegerGemeente',
		self::FIELD_PLEGER_TELEFOON=>'plegerTelefoon',
		self::FIELD_PLEGER_OPDEHOOGTE=>'plegerOpdehoogte',
		self::FIELD_PLEGER_RELATIE=>'plegerRelatie',
		self::FIELD_PLEGER_RELATIEDETAIL=>'plegerRelatiedetail',
		self::FIELD_PLEGERS_AANTAL=>'plegersAantal',
		self::FIELD_PLEGERS_EXTRA=>'plegersExtra',
		self::FIELD_SITUATIESCHETS=>'situatieschets',
		self::FIELD_VORIGE=>'vorige',
		self::FIELD_JUSTITIE_SOORT=>'justitieSoort',
		self::FIELD_JUSTITIE_WEETMELDING=>'justitieWeetmelding',
		self::FIELD_JUSTITIE_DETAIL=>'justitieDetail',
		self::FIELD_MANTELZORGERS_AANWEZIG=>'mantelzorgersAanwezig',
		self::FIELD_MANTELZORGERS_DETAIL=>'mantelzorgersDetail',
		self::FIELD_CONTACTPERSONEN_AANWEZIG=>'contactpersonenAanwezig',
		self::FIELD_CONTACTPERSONEN_DETAIL=>'contactpersonenDetail',
		self::FIELD_OPVOLGING_STEUNPUNT=>'opvolgingSteunpunt',
		self::FIELD_STANDVANZAKEN=>'standvanzaken',
		self::FIELD_AFSLUITEN_DAG=>'afsluitenDag',
		self::FIELD_AFSLUITEN_MAAND=>'afsluitenMaand',
		self::FIELD_AFSLUITEN_JAAR=>'afsluitenJaar',
		self::FIELD_AFSLUITEN_DETAIL=>'afsluitenDetail',
		self::FIELD_AFGEROND=>'afgerond',
		self::FIELD_OMB_BRON=>'ombBron',
		self::FIELD_VOORCAW=>'voorCAW');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_AUTEUR=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DAG=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MAAND=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_JAAR=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DAGNUMMER=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_CONTACTWIJZE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_BEKENDHEID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DOORVERWIJZING_INTERN=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DOORVERWIJZING_EXTERN=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GENRE_MELDING=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MELDER_SOORT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_MELDERHVL_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MELDER_NAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_MELDER_ADRES=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_MELDER_GEMEENTE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MELDER_TELEFOON=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_MELDER_EMAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_MELDER_RELATIE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MELDER_RELATIEDETAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SLACHTOFFER_NAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SLACHTOFFER_LEEFTIJD=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SLACHTOFFER_GESLACHT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SLACHTOFFER_ADRES=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SLACHTOFFER_GEMEENTE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_SLACHTOFFER_TELEFOON=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SLACHTOFFER_EMAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SLACHTOFFER_WEETMELDING=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_SLACHTOFFER_ERVAARTMISHANDELING=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_SAMENWONEN=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_SAMENWONEN_DETAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SLACHTOFFER_MEER=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_SLACHTOFFER_MEER_DETAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PLEGER_NAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PLEGER_LEEFTIJD=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PLEGER_GESLACHT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PLEGER_ADRES=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PLEGER_GEMEENTE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_PLEGER_TELEFOON=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PLEGER_OPDEHOOGTE=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_PLEGER_RELATIE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_PLEGER_RELATIEDETAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PLEGERS_AANTAL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PLEGERS_EXTRA=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SITUATIESCHETS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VORIGE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_JUSTITIE_SOORT=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_JUSTITIE_WEETMELDING=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_JUSTITIE_DETAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_MANTELZORGERS_AANWEZIG=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_MANTELZORGERS_DETAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CONTACTPERSONEN_AANWEZIG=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_CONTACTPERSONEN_DETAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_OPVOLGING_STEUNPUNT=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_STANDVANZAKEN=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_AFSLUITEN_DAG=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AFSLUITEN_MAAND=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AFSLUITEN_JAAR=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AFSLUITEN_DETAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AFGEROND=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_OMB_BRON=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VOORCAW=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_AUTEUR=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_DAG=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_MAAND=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_JAAR=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_DAGNUMMER=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_CONTACTWIJZE=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_BEKENDHEID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_DOORVERWIJZING_INTERN=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,false),
		self::FIELD_DOORVERWIJZING_EXTERN=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,false),
		self::FIELD_GENRE_MELDING=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_MELDER_SOORT=>array(Db2PhpEntity::JDBC_TYPE_CHAR,14,0,true),
		self::FIELD_MELDERHVL_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_MELDER_NAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,true),
		self::FIELD_MELDER_ADRES=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,100,0,true),
		self::FIELD_MELDER_GEMEENTE=>array(Db2PhpEntity::JDBC_TYPE_SMALLINT,5,0,true),
		self::FIELD_MELDER_TELEFOON=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_MELDER_EMAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,120,0,true),
		self::FIELD_MELDER_RELATIE=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_MELDER_RELATIEDETAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_SLACHTOFFER_NAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,true),
		self::FIELD_SLACHTOFFER_LEEFTIJD=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_SLACHTOFFER_GESLACHT=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,true),
		self::FIELD_SLACHTOFFER_ADRES=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,100,0,true),
		self::FIELD_SLACHTOFFER_GEMEENTE=>array(Db2PhpEntity::JDBC_TYPE_SMALLINT,5,0,true),
		self::FIELD_SLACHTOFFER_TELEFOON=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,true),
		self::FIELD_SLACHTOFFER_EMAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,120,0,true),
		self::FIELD_SLACHTOFFER_WEETMELDING=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,true),
		self::FIELD_SLACHTOFFER_ERVAARTMISHANDELING=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,true),
		self::FIELD_SAMENWONEN=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,true),
		self::FIELD_SAMENWONEN_DETAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_SLACHTOFFER_MEER=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,true),
		self::FIELD_SLACHTOFFER_MEER_DETAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_PLEGER_NAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,true),
		self::FIELD_PLEGER_LEEFTIJD=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_PLEGER_GESLACHT=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,true),
		self::FIELD_PLEGER_ADRES=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,true),
		self::FIELD_PLEGER_GEMEENTE=>array(Db2PhpEntity::JDBC_TYPE_SMALLINT,5,0,true),
		self::FIELD_PLEGER_TELEFOON=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,true),
		self::FIELD_PLEGER_OPDEHOOGTE=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,true),
		self::FIELD_PLEGER_RELATIE=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_PLEGER_RELATIEDETAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_PLEGERS_AANTAL=>array(Db2PhpEntity::JDBC_TYPE_CHAR,4,0,true),
		self::FIELD_PLEGERS_EXTRA=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_SITUATIESCHETS=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,true),
		self::FIELD_VORIGE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,80,0,true),
		self::FIELD_JUSTITIE_SOORT=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_JUSTITIE_WEETMELDING=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,true),
		self::FIELD_JUSTITIE_DETAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_MANTELZORGERS_AANWEZIG=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,true),
		self::FIELD_MANTELZORGERS_DETAIL=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,true),
		self::FIELD_CONTACTPERSONEN_AANWEZIG=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,true),
		self::FIELD_CONTACTPERSONEN_DETAIL=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,true),
		self::FIELD_OPVOLGING_STEUNPUNT=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,true),
		self::FIELD_STANDVANZAKEN=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_AFSLUITEN_DAG=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,true),
		self::FIELD_AFSLUITEN_MAAND=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,true),
		self::FIELD_AFSLUITEN_JAAR=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,4,0,true),
		self::FIELD_AFSLUITEN_DETAIL=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,true),
		self::FIELD_AFGEROND=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_OMB_BRON=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_VOORCAW=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_AUTEUR=>0,
		self::FIELD_DAG=>0,
		self::FIELD_MAAND=>0,
		self::FIELD_JAAR=>0,
		self::FIELD_DAGNUMMER=>0,
		self::FIELD_CONTACTWIJZE=>null,
		self::FIELD_BEKENDHEID=>null,
		self::FIELD_DOORVERWIJZING_INTERN=>'',
		self::FIELD_DOORVERWIJZING_EXTERN=>'',
		self::FIELD_GENRE_MELDING=>null,
		self::FIELD_MELDER_SOORT=>null,
		self::FIELD_MELDERHVL_ID=>null,
		self::FIELD_MELDER_NAAM=>null,
		self::FIELD_MELDER_ADRES=>null,
		self::FIELD_MELDER_GEMEENTE=>null,
		self::FIELD_MELDER_TELEFOON=>null,
		self::FIELD_MELDER_EMAIL=>null,
		self::FIELD_MELDER_RELATIE=>null,
		self::FIELD_MELDER_RELATIEDETAIL=>null,
		self::FIELD_SLACHTOFFER_NAAM=>null,
		self::FIELD_SLACHTOFFER_LEEFTIJD=>null,
		self::FIELD_SLACHTOFFER_GESLACHT=>null,
		self::FIELD_SLACHTOFFER_ADRES=>null,
		self::FIELD_SLACHTOFFER_GEMEENTE=>null,
		self::FIELD_SLACHTOFFER_TELEFOON=>null,
		self::FIELD_SLACHTOFFER_EMAIL=>null,
		self::FIELD_SLACHTOFFER_WEETMELDING=>null,
		self::FIELD_SLACHTOFFER_ERVAARTMISHANDELING=>null,
		self::FIELD_SAMENWONEN=>null,
		self::FIELD_SAMENWONEN_DETAIL=>null,
		self::FIELD_SLACHTOFFER_MEER=>null,
		self::FIELD_SLACHTOFFER_MEER_DETAIL=>null,
		self::FIELD_PLEGER_NAAM=>null,
		self::FIELD_PLEGER_LEEFTIJD=>null,
		self::FIELD_PLEGER_GESLACHT=>null,
		self::FIELD_PLEGER_ADRES=>null,
		self::FIELD_PLEGER_GEMEENTE=>null,
		self::FIELD_PLEGER_TELEFOON=>null,
		self::FIELD_PLEGER_OPDEHOOGTE=>null,
		self::FIELD_PLEGER_RELATIE=>null,
		self::FIELD_PLEGER_RELATIEDETAIL=>null,
		self::FIELD_PLEGERS_AANTAL=>null,
		self::FIELD_PLEGERS_EXTRA=>null,
		self::FIELD_SITUATIESCHETS=>null,
		self::FIELD_VORIGE=>null,
		self::FIELD_JUSTITIE_SOORT=>null,
		self::FIELD_JUSTITIE_WEETMELDING=>null,
		self::FIELD_JUSTITIE_DETAIL=>null,
		self::FIELD_MANTELZORGERS_AANWEZIG=>null,
		self::FIELD_MANTELZORGERS_DETAIL=>null,
		self::FIELD_CONTACTPERSONEN_AANWEZIG=>null,
		self::FIELD_CONTACTPERSONEN_DETAIL=>null,
		self::FIELD_OPVOLGING_STEUNPUNT=>null,
		self::FIELD_STANDVANZAKEN=>null,
		self::FIELD_AFSLUITEN_DAG=>null,
		self::FIELD_AFSLUITEN_MAAND=>null,
		self::FIELD_AFSLUITEN_JAAR=>null,
		self::FIELD_AFSLUITEN_DETAIL=>null,
		self::FIELD_AFGEROND=>0,
		self::FIELD_OMB_BRON=>null,
		self::FIELD_VOORCAW=>0);
	private $id;
	private $auteur;
	private $dag;
	private $maand;
	private $jaar;
	private $dagnummer;
	private $contactwijze;
	private $bekendheid;
	private $doorverwijzingIntern;
	private $doorverwijzingExtern;
	private $genreMelding;
	private $melderSoort;
	private $melderhvlId;
	private $melderNaam;
	private $melderAdres;
	private $melderGemeente;
	private $melderTelefoon;
	private $melderEmail;
	private $melderRelatie;
	private $melderRelatiedetail;
	private $slachtofferNaam;
	private $slachtofferLeeftijd;
	private $slachtofferGeslacht;
	private $slachtofferAdres;
	private $slachtofferGemeente;
	private $slachtofferTelefoon;
	private $slachtofferEmail;
	private $slachtofferWeetmelding;
	private $slachtofferErvaartmishandeling;
	private $samenwonen;
	private $samenwonenDetail;
	private $slachtofferMeer;
	private $slachtofferMeerDetail;
	private $plegerNaam;
	private $plegerLeeftijd;
	private $plegerGeslacht;
	private $plegerAdres;
	private $plegerGemeente;
	private $plegerTelefoon;
	private $plegerOpdehoogte;
	private $plegerRelatie;
	private $plegerRelatiedetail;
	private $plegersAantal;
	private $plegersExtra;
	private $situatieschets;
	private $vorige;
	private $justitieSoort;
	private $justitieWeetmelding;
	private $justitieDetail;
	private $mantelzorgersAanwezig;
	private $mantelzorgersDetail;
	private $contactpersonenAanwezig;
	private $contactpersonenDetail;
	private $opvolgingSteunpunt;
	private $standvanzaken;
	private $afsluitenDag;
	private $afsluitenMaand;
	private $afsluitenJaar;
	private $afsluitenDetail;
	private $afgerond;
	private $ombBron;
	private $voorCAW;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return OmbRegistratie
	 */
	public function &setId($id) {
		$this->notifyChanged(self::FIELD_ID,$this->id,$id);
		$this->id=$id;
		return $this;
	}

	/**
	 * get value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * set value for auteur 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $auteur
	 * @return OmbRegistratie
	 */
	public function &setAuteur($auteur) {
		$this->notifyChanged(self::FIELD_AUTEUR,$this->auteur,$auteur);
		$this->auteur=$auteur;
		return $this;
	}

	/**
	 * get value for auteur 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @return mixed
	 */
	public function getAuteur() {
		return $this->auteur;
	}

	/**
	 * set value for dag 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $dag
	 * @return OmbRegistratie
	 */
	public function &setDag($dag) {
		$this->notifyChanged(self::FIELD_DAG,$this->dag,$dag);
		$this->dag=$dag;
		return $this;
	}

	/**
	 * get value for dag 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @return mixed
	 */
	public function getDag() {
		return $this->dag;
	}

	/**
	 * set value for maand 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $maand
	 * @return OmbRegistratie
	 */
	public function &setMaand($maand) {
		$this->notifyChanged(self::FIELD_MAAND,$this->maand,$maand);
		$this->maand=$maand;
		return $this;
	}

	/**
	 * get value for maand 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @return mixed
	 */
	public function getMaand() {
		return $this->maand;
	}

	/**
	 * set value for jaar 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $jaar
	 * @return OmbRegistratie
	 */
	public function &setJaar($jaar) {
		$this->notifyChanged(self::FIELD_JAAR,$this->jaar,$jaar);
		$this->jaar=$jaar;
		return $this;
	}

	/**
	 * get value for jaar 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @return mixed
	 */
	public function getJaar() {
		return $this->jaar;
	}

	/**
	 * set value for dagnummer 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $dagnummer
	 * @return OmbRegistratie
	 */
	public function &setDagnummer($dagnummer) {
		$this->notifyChanged(self::FIELD_DAGNUMMER,$this->dagnummer,$dagnummer);
		$this->dagnummer=$dagnummer;
		return $this;
	}

	/**
	 * get value for dagnummer 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getDagnummer() {
		return $this->dagnummer;
	}

	/**
	 * set value for contactwijze 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $contactwijze
	 * @return OmbRegistratie
	 */
	public function &setContactwijze($contactwijze) {
		$this->notifyChanged(self::FIELD_CONTACTWIJZE,$this->contactwijze,$contactwijze);
		$this->contactwijze=$contactwijze;
		return $this;
	}

	/**
	 * get value for contactwijze 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getContactwijze() {
		return $this->contactwijze;
	}

	/**
	 * set value for bekendheid 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $bekendheid
	 * @return OmbRegistratie
	 */
	public function &setBekendheid($bekendheid) {
		$this->notifyChanged(self::FIELD_BEKENDHEID,$this->bekendheid,$bekendheid);
		$this->bekendheid=$bekendheid;
		return $this;
	}

	/**
	 * get value for bekendheid 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getBekendheid() {
		return $this->bekendheid;
	}

	/**
	 * set value for doorverwijzing_intern 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @param mixed $doorverwijzingIntern
	 * @return OmbRegistratie
	 */
	public function &setDoorverwijzingIntern($doorverwijzingIntern) {
		$this->notifyChanged(self::FIELD_DOORVERWIJZING_INTERN,$this->doorverwijzingIntern,$doorverwijzingIntern);
		$this->doorverwijzingIntern=$doorverwijzingIntern;
		return $this;
	}

	/**
	 * get value for doorverwijzing_intern 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @return mixed
	 */
	public function getDoorverwijzingIntern() {
		return $this->doorverwijzingIntern;
	}

	/**
	 * set value for doorverwijzing_extern 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @param mixed $doorverwijzingExtern
	 * @return OmbRegistratie
	 */
	public function &setDoorverwijzingExtern($doorverwijzingExtern) {
		$this->notifyChanged(self::FIELD_DOORVERWIJZING_EXTERN,$this->doorverwijzingExtern,$doorverwijzingExtern);
		$this->doorverwijzingExtern=$doorverwijzingExtern;
		return $this;
	}

	/**
	 * get value for doorverwijzing_extern 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @return mixed
	 */
	public function getDoorverwijzingExtern() {
		return $this->doorverwijzingExtern;
	}

	/**
	 * set value for genre_melding 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $genreMelding
	 * @return OmbRegistratie
	 */
	public function &setGenreMelding($genreMelding) {
		$this->notifyChanged(self::FIELD_GENRE_MELDING,$this->genreMelding,$genreMelding);
		$this->genreMelding=$genreMelding;
		return $this;
	}

	/**
	 * get value for genre_melding 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getGenreMelding() {
		return $this->genreMelding;
	}

	/**
	 * set value for melder_soort 
	 *
	 * type:ENUM,size:14,default:null,nullable
	 *
	 * @param mixed $melderSoort
	 * @return OmbRegistratie
	 */
	public function &setMelderSoort($melderSoort) {
		$this->notifyChanged(self::FIELD_MELDER_SOORT,$this->melderSoort,$melderSoort);
		$this->melderSoort=$melderSoort;
		return $this;
	}

	/**
	 * get value for melder_soort 
	 *
	 * type:ENUM,size:14,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMelderSoort() {
		return $this->melderSoort;
	}

	/**
	 * set value for melderhvl_id 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $melderhvlId
	 * @return OmbRegistratie
	 */
	public function &setMelderhvlId($melderhvlId) {
		$this->notifyChanged(self::FIELD_MELDERHVL_ID,$this->melderhvlId,$melderhvlId);
		$this->melderhvlId=$melderhvlId;
		return $this;
	}

	/**
	 * get value for melderhvl_id 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMelderhvlId() {
		return $this->melderhvlId;
	}

	/**
	 * set value for melder_naam 
	 *
	 * type:VARCHAR,size:200,default:null,nullable
	 *
	 * @param mixed $melderNaam
	 * @return OmbRegistratie
	 */
	public function &setMelderNaam($melderNaam) {
		$this->notifyChanged(self::FIELD_MELDER_NAAM,$this->melderNaam,$melderNaam);
		$this->melderNaam=$melderNaam;
		return $this;
	}

	/**
	 * get value for melder_naam 
	 *
	 * type:VARCHAR,size:200,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMelderNaam() {
		return $this->melderNaam;
	}

	/**
	 * set value for melder_adres 
	 *
	 * type:VARCHAR,size:100,default:null,nullable
	 *
	 * @param mixed $melderAdres
	 * @return OmbRegistratie
	 */
	public function &setMelderAdres($melderAdres) {
		$this->notifyChanged(self::FIELD_MELDER_ADRES,$this->melderAdres,$melderAdres);
		$this->melderAdres=$melderAdres;
		return $this;
	}

	/**
	 * get value for melder_adres 
	 *
	 * type:VARCHAR,size:100,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMelderAdres() {
		return $this->melderAdres;
	}

	/**
	 * set value for melder_gemeente 
	 *
	 * type:SMALLINT,size:5,default:null,nullable
	 *
	 * @param mixed $melderGemeente
	 * @return OmbRegistratie
	 */
	public function &setMelderGemeente($melderGemeente) {
		$this->notifyChanged(self::FIELD_MELDER_GEMEENTE,$this->melderGemeente,$melderGemeente);
		$this->melderGemeente=$melderGemeente;
		return $this;
	}

	/**
	 * get value for melder_gemeente 
	 *
	 * type:SMALLINT,size:5,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMelderGemeente() {
		return $this->melderGemeente;
	}

	/**
	 * set value for melder_telefoon 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @param mixed $melderTelefoon
	 * @return OmbRegistratie
	 */
	public function &setMelderTelefoon($melderTelefoon) {
		$this->notifyChanged(self::FIELD_MELDER_TELEFOON,$this->melderTelefoon,$melderTelefoon);
		$this->melderTelefoon=$melderTelefoon;
		return $this;
	}

	/**
	 * get value for melder_telefoon 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMelderTelefoon() {
		return $this->melderTelefoon;
	}

	/**
	 * set value for melder_email 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @param mixed $melderEmail
	 * @return OmbRegistratie
	 */
	public function &setMelderEmail($melderEmail) {
		$this->notifyChanged(self::FIELD_MELDER_EMAIL,$this->melderEmail,$melderEmail);
		$this->melderEmail=$melderEmail;
		return $this;
	}

	/**
	 * get value for melder_email 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMelderEmail() {
		return $this->melderEmail;
	}

	/**
	 * set value for melder_relatie 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $melderRelatie
	 * @return OmbRegistratie
	 */
	public function &setMelderRelatie($melderRelatie) {
		$this->notifyChanged(self::FIELD_MELDER_RELATIE,$this->melderRelatie,$melderRelatie);
		$this->melderRelatie=$melderRelatie;
		return $this;
	}

	/**
	 * get value for melder_relatie 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMelderRelatie() {
		return $this->melderRelatie;
	}

	/**
	 * set value for melder_relatiedetail 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $melderRelatiedetail
	 * @return OmbRegistratie
	 */
	public function &setMelderRelatiedetail($melderRelatiedetail) {
		$this->notifyChanged(self::FIELD_MELDER_RELATIEDETAIL,$this->melderRelatiedetail,$melderRelatiedetail);
		$this->melderRelatiedetail=$melderRelatiedetail;
		return $this;
	}

	/**
	 * get value for melder_relatiedetail 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMelderRelatiedetail() {
		return $this->melderRelatiedetail;
	}

	/**
	 * set value for slachtoffer_naam 
	 *
	 * type:VARCHAR,size:200,default:null,nullable
	 *
	 * @param mixed $slachtofferNaam
	 * @return OmbRegistratie
	 */
	public function &setSlachtofferNaam($slachtofferNaam) {
		$this->notifyChanged(self::FIELD_SLACHTOFFER_NAAM,$this->slachtofferNaam,$slachtofferNaam);
		$this->slachtofferNaam=$slachtofferNaam;
		return $this;
	}

	/**
	 * get value for slachtoffer_naam 
	 *
	 * type:VARCHAR,size:200,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSlachtofferNaam() {
		return $this->slachtofferNaam;
	}

	/**
	 * set value for slachtoffer_leeftijd 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @param mixed $slachtofferLeeftijd
	 * @return OmbRegistratie
	 */
	public function &setSlachtofferLeeftijd($slachtofferLeeftijd) {
		$this->notifyChanged(self::FIELD_SLACHTOFFER_LEEFTIJD,$this->slachtofferLeeftijd,$slachtofferLeeftijd);
		$this->slachtofferLeeftijd=$slachtofferLeeftijd;
		return $this;
	}

	/**
	 * get value for slachtoffer_leeftijd 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSlachtofferLeeftijd() {
		return $this->slachtofferLeeftijd;
	}

	/**
	 * set value for slachtoffer_geslacht 
	 *
	 * type:ENUM,size:2,default:null,nullable
	 *
	 * @param mixed $slachtofferGeslacht
	 * @return OmbRegistratie
	 */
	public function &setSlachtofferGeslacht($slachtofferGeslacht) {
		$this->notifyChanged(self::FIELD_SLACHTOFFER_GESLACHT,$this->slachtofferGeslacht,$slachtofferGeslacht);
		$this->slachtofferGeslacht=$slachtofferGeslacht;
		return $this;
	}

	/**
	 * get value for slachtoffer_geslacht 
	 *
	 * type:ENUM,size:2,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSlachtofferGeslacht() {
		return $this->slachtofferGeslacht;
	}

	/**
	 * set value for slachtoffer_adres 
	 *
	 * type:VARCHAR,size:100,default:null,nullable
	 *
	 * @param mixed $slachtofferAdres
	 * @return OmbRegistratie
	 */
	public function &setSlachtofferAdres($slachtofferAdres) {
		$this->notifyChanged(self::FIELD_SLACHTOFFER_ADRES,$this->slachtofferAdres,$slachtofferAdres);
		$this->slachtofferAdres=$slachtofferAdres;
		return $this;
	}

	/**
	 * get value for slachtoffer_adres 
	 *
	 * type:VARCHAR,size:100,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSlachtofferAdres() {
		return $this->slachtofferAdres;
	}

	/**
	 * set value for slachtoffer_gemeente 
	 *
	 * type:SMALLINT,size:5,default:null,nullable
	 *
	 * @param mixed $slachtofferGemeente
	 * @return OmbRegistratie
	 */
	public function &setSlachtofferGemeente($slachtofferGemeente) {
		$this->notifyChanged(self::FIELD_SLACHTOFFER_GEMEENTE,$this->slachtofferGemeente,$slachtofferGemeente);
		$this->slachtofferGemeente=$slachtofferGemeente;
		return $this;
	}

	/**
	 * get value for slachtoffer_gemeente 
	 *
	 * type:SMALLINT,size:5,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSlachtofferGemeente() {
		return $this->slachtofferGemeente;
	}

	/**
	 * set value for slachtoffer_telefoon 
	 *
	 * type:VARCHAR,size:40,default:null,nullable
	 *
	 * @param mixed $slachtofferTelefoon
	 * @return OmbRegistratie
	 */
	public function &setSlachtofferTelefoon($slachtofferTelefoon) {
		$this->notifyChanged(self::FIELD_SLACHTOFFER_TELEFOON,$this->slachtofferTelefoon,$slachtofferTelefoon);
		$this->slachtofferTelefoon=$slachtofferTelefoon;
		return $this;
	}

	/**
	 * get value for slachtoffer_telefoon 
	 *
	 * type:VARCHAR,size:40,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSlachtofferTelefoon() {
		return $this->slachtofferTelefoon;
	}

	/**
	 * set value for slachtoffer_email 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @param mixed $slachtofferEmail
	 * @return OmbRegistratie
	 */
	public function &setSlachtofferEmail($slachtofferEmail) {
		$this->notifyChanged(self::FIELD_SLACHTOFFER_EMAIL,$this->slachtofferEmail,$slachtofferEmail);
		$this->slachtofferEmail=$slachtofferEmail;
		return $this;
	}

	/**
	 * get value for slachtoffer_email 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSlachtofferEmail() {
		return $this->slachtofferEmail;
	}

	/**
	 * set value for slachtoffer_weetmelding 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @param mixed $slachtofferWeetmelding
	 * @return OmbRegistratie
	 */
	public function &setSlachtofferWeetmelding($slachtofferWeetmelding) {
		$this->notifyChanged(self::FIELD_SLACHTOFFER_WEETMELDING,$this->slachtofferWeetmelding,$slachtofferWeetmelding);
		$this->slachtofferWeetmelding=$slachtofferWeetmelding;
		return $this;
	}

	/**
	 * get value for slachtoffer_weetmelding 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSlachtofferWeetmelding() {
		return $this->slachtofferWeetmelding;
	}

	/**
	 * set value for slachtoffer_ervaartmishandeling 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @param mixed $slachtofferErvaartmishandeling
	 * @return OmbRegistratie
	 */
	public function &setSlachtofferErvaartmishandeling($slachtofferErvaartmishandeling) {
		$this->notifyChanged(self::FIELD_SLACHTOFFER_ERVAARTMISHANDELING,$this->slachtofferErvaartmishandeling,$slachtofferErvaartmishandeling);
		$this->slachtofferErvaartmishandeling=$slachtofferErvaartmishandeling;
		return $this;
	}

	/**
	 * get value for slachtoffer_ervaartmishandeling 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSlachtofferErvaartmishandeling() {
		return $this->slachtofferErvaartmishandeling;
	}

	/**
	 * set value for samenwonen 
	 *
	 * type:TINYINT,size:3,default:null,nullable
	 *
	 * @param mixed $samenwonen
	 * @return OmbRegistratie
	 */
	public function &setSamenwonen($samenwonen) {
		$this->notifyChanged(self::FIELD_SAMENWONEN,$this->samenwonen,$samenwonen);
		$this->samenwonen=$samenwonen;
		return $this;
	}

	/**
	 * get value for samenwonen 
	 *
	 * type:TINYINT,size:3,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSamenwonen() {
		return $this->samenwonen;
	}

	/**
	 * set value for samenwonen_detail 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $samenwonenDetail
	 * @return OmbRegistratie
	 */
	public function &setSamenwonenDetail($samenwonenDetail) {
		$this->notifyChanged(self::FIELD_SAMENWONEN_DETAIL,$this->samenwonenDetail,$samenwonenDetail);
		$this->samenwonenDetail=$samenwonenDetail;
		return $this;
	}

	/**
	 * get value for samenwonen_detail 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSamenwonenDetail() {
		return $this->samenwonenDetail;
	}

	/**
	 * set value for slachtoffer_meer 
	 *
	 * type:TINYINT,size:3,default:null,nullable
	 *
	 * @param mixed $slachtofferMeer
	 * @return OmbRegistratie
	 */
	public function &setSlachtofferMeer($slachtofferMeer) {
		$this->notifyChanged(self::FIELD_SLACHTOFFER_MEER,$this->slachtofferMeer,$slachtofferMeer);
		$this->slachtofferMeer=$slachtofferMeer;
		return $this;
	}

	/**
	 * get value for slachtoffer_meer 
	 *
	 * type:TINYINT,size:3,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSlachtofferMeer() {
		return $this->slachtofferMeer;
	}

	/**
	 * set value for slachtoffer_meer_detail 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $slachtofferMeerDetail
	 * @return OmbRegistratie
	 */
	public function &setSlachtofferMeerDetail($slachtofferMeerDetail) {
		$this->notifyChanged(self::FIELD_SLACHTOFFER_MEER_DETAIL,$this->slachtofferMeerDetail,$slachtofferMeerDetail);
		$this->slachtofferMeerDetail=$slachtofferMeerDetail;
		return $this;
	}

	/**
	 * get value for slachtoffer_meer_detail 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSlachtofferMeerDetail() {
		return $this->slachtofferMeerDetail;
	}

	/**
	 * set value for pleger_naam 
	 *
	 * type:VARCHAR,size:200,default:null,nullable
	 *
	 * @param mixed $plegerNaam
	 * @return OmbRegistratie
	 */
	public function &setPlegerNaam($plegerNaam) {
		$this->notifyChanged(self::FIELD_PLEGER_NAAM,$this->plegerNaam,$plegerNaam);
		$this->plegerNaam=$plegerNaam;
		return $this;
	}

	/**
	 * get value for pleger_naam 
	 *
	 * type:VARCHAR,size:200,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPlegerNaam() {
		return $this->plegerNaam;
	}

	/**
	 * set value for pleger_leeftijd 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @param mixed $plegerLeeftijd
	 * @return OmbRegistratie
	 */
	public function &setPlegerLeeftijd($plegerLeeftijd) {
		$this->notifyChanged(self::FIELD_PLEGER_LEEFTIJD,$this->plegerLeeftijd,$plegerLeeftijd);
		$this->plegerLeeftijd=$plegerLeeftijd;
		return $this;
	}

	/**
	 * get value for pleger_leeftijd 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPlegerLeeftijd() {
		return $this->plegerLeeftijd;
	}

	/**
	 * set value for pleger_geslacht 
	 *
	 * type:ENUM,size:2,default:null,nullable
	 *
	 * @param mixed $plegerGeslacht
	 * @return OmbRegistratie
	 */
	public function &setPlegerGeslacht($plegerGeslacht) {
		$this->notifyChanged(self::FIELD_PLEGER_GESLACHT,$this->plegerGeslacht,$plegerGeslacht);
		$this->plegerGeslacht=$plegerGeslacht;
		return $this;
	}

	/**
	 * get value for pleger_geslacht 
	 *
	 * type:ENUM,size:2,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPlegerGeslacht() {
		return $this->plegerGeslacht;
	}

	/**
	 * set value for pleger_adres 
	 *
	 * type:VARCHAR,size:200,default:null,nullable
	 *
	 * @param mixed $plegerAdres
	 * @return OmbRegistratie
	 */
	public function &setPlegerAdres($plegerAdres) {
		$this->notifyChanged(self::FIELD_PLEGER_ADRES,$this->plegerAdres,$plegerAdres);
		$this->plegerAdres=$plegerAdres;
		return $this;
	}

	/**
	 * get value for pleger_adres 
	 *
	 * type:VARCHAR,size:200,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPlegerAdres() {
		return $this->plegerAdres;
	}

	/**
	 * set value for pleger_gemeente 
	 *
	 * type:SMALLINT,size:5,default:null,nullable
	 *
	 * @param mixed $plegerGemeente
	 * @return OmbRegistratie
	 */
	public function &setPlegerGemeente($plegerGemeente) {
		$this->notifyChanged(self::FIELD_PLEGER_GEMEENTE,$this->plegerGemeente,$plegerGemeente);
		$this->plegerGemeente=$plegerGemeente;
		return $this;
	}

	/**
	 * get value for pleger_gemeente 
	 *
	 * type:SMALLINT,size:5,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPlegerGemeente() {
		return $this->plegerGemeente;
	}

	/**
	 * set value for pleger_telefoon 
	 *
	 * type:VARCHAR,size:40,default:null,nullable
	 *
	 * @param mixed $plegerTelefoon
	 * @return OmbRegistratie
	 */
	public function &setPlegerTelefoon($plegerTelefoon) {
		$this->notifyChanged(self::FIELD_PLEGER_TELEFOON,$this->plegerTelefoon,$plegerTelefoon);
		$this->plegerTelefoon=$plegerTelefoon;
		return $this;
	}

	/**
	 * get value for pleger_telefoon 
	 *
	 * type:VARCHAR,size:40,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPlegerTelefoon() {
		return $this->plegerTelefoon;
	}

	/**
	 * set value for pleger_opdehoogte 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @param mixed $plegerOpdehoogte
	 * @return OmbRegistratie
	 */
	public function &setPlegerOpdehoogte($plegerOpdehoogte) {
		$this->notifyChanged(self::FIELD_PLEGER_OPDEHOOGTE,$this->plegerOpdehoogte,$plegerOpdehoogte);
		$this->plegerOpdehoogte=$plegerOpdehoogte;
		return $this;
	}

	/**
	 * get value for pleger_opdehoogte 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPlegerOpdehoogte() {
		return $this->plegerOpdehoogte;
	}

	/**
	 * set value for pleger_relatie 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $plegerRelatie
	 * @return OmbRegistratie
	 */
	public function &setPlegerRelatie($plegerRelatie) {
		$this->notifyChanged(self::FIELD_PLEGER_RELATIE,$this->plegerRelatie,$plegerRelatie);
		$this->plegerRelatie=$plegerRelatie;
		return $this;
	}

	/**
	 * get value for pleger_relatie 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPlegerRelatie() {
		return $this->plegerRelatie;
	}

	/**
	 * set value for pleger_relatiedetail 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $plegerRelatiedetail
	 * @return OmbRegistratie
	 */
	public function &setPlegerRelatiedetail($plegerRelatiedetail) {
		$this->notifyChanged(self::FIELD_PLEGER_RELATIEDETAIL,$this->plegerRelatiedetail,$plegerRelatiedetail);
		$this->plegerRelatiedetail=$plegerRelatiedetail;
		return $this;
	}

	/**
	 * get value for pleger_relatiedetail 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPlegerRelatiedetail() {
		return $this->plegerRelatiedetail;
	}

	/**
	 * set value for plegers_aantal 
	 *
	 * type:ENUM,size:4,default:null,nullable
	 *
	 * @param mixed $plegersAantal
	 * @return OmbRegistratie
	 */
	public function &setPlegersAantal($plegersAantal) {
		$this->notifyChanged(self::FIELD_PLEGERS_AANTAL,$this->plegersAantal,$plegersAantal);
		$this->plegersAantal=$plegersAantal;
		return $this;
	}

	/**
	 * get value for plegers_aantal 
	 *
	 * type:ENUM,size:4,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPlegersAantal() {
		return $this->plegersAantal;
	}

	/**
	 * set value for plegers_extra 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $plegersExtra
	 * @return OmbRegistratie
	 */
	public function &setPlegersExtra($plegersExtra) {
		$this->notifyChanged(self::FIELD_PLEGERS_EXTRA,$this->plegersExtra,$plegersExtra);
		$this->plegersExtra=$plegersExtra;
		return $this;
	}

	/**
	 * get value for plegers_extra 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPlegersExtra() {
		return $this->plegersExtra;
	}

	/**
	 * set value for situatieschets 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $situatieschets
	 * @return OmbRegistratie
	 */
	public function &setSituatieschets($situatieschets) {
		$this->notifyChanged(self::FIELD_SITUATIESCHETS,$this->situatieschets,$situatieschets);
		$this->situatieschets=$situatieschets;
		return $this;
	}

	/**
	 * get value for situatieschets 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSituatieschets() {
		return $this->situatieschets;
	}

	/**
	 * set value for vorige 
	 *
	 * type:VARCHAR,size:80,default:null,nullable
	 *
	 * @param mixed $vorige
	 * @return OmbRegistratie
	 */
	public function &setVorige($vorige) {
		$this->notifyChanged(self::FIELD_VORIGE,$this->vorige,$vorige);
		$this->vorige=$vorige;
		return $this;
	}

	/**
	 * get value for vorige 
	 *
	 * type:VARCHAR,size:80,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getVorige() {
		return $this->vorige;
	}

	/**
	 * set value for justitie_soort 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $justitieSoort
	 * @return OmbRegistratie
	 */
	public function &setJustitieSoort($justitieSoort) {
		$this->notifyChanged(self::FIELD_JUSTITIE_SOORT,$this->justitieSoort,$justitieSoort);
		$this->justitieSoort=$justitieSoort;
		return $this;
	}

	/**
	 * get value for justitie_soort 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getJustitieSoort() {
		return $this->justitieSoort;
	}

	/**
	 * set value for justitie_weetmelding 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @param mixed $justitieWeetmelding
	 * @return OmbRegistratie
	 */
	public function &setJustitieWeetmelding($justitieWeetmelding) {
		$this->notifyChanged(self::FIELD_JUSTITIE_WEETMELDING,$this->justitieWeetmelding,$justitieWeetmelding);
		$this->justitieWeetmelding=$justitieWeetmelding;
		return $this;
	}

	/**
	 * get value for justitie_weetmelding 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getJustitieWeetmelding() {
		return $this->justitieWeetmelding;
	}

	/**
	 * set value for justitie_detail 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $justitieDetail
	 * @return OmbRegistratie
	 */
	public function &setJustitieDetail($justitieDetail) {
		$this->notifyChanged(self::FIELD_JUSTITIE_DETAIL,$this->justitieDetail,$justitieDetail);
		$this->justitieDetail=$justitieDetail;
		return $this;
	}

	/**
	 * get value for justitie_detail 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getJustitieDetail() {
		return $this->justitieDetail;
	}

	/**
	 * set value for mantelzorgers_aanwezig 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @param mixed $mantelzorgersAanwezig
	 * @return OmbRegistratie
	 */
	public function &setMantelzorgersAanwezig($mantelzorgersAanwezig) {
		$this->notifyChanged(self::FIELD_MANTELZORGERS_AANWEZIG,$this->mantelzorgersAanwezig,$mantelzorgersAanwezig);
		$this->mantelzorgersAanwezig=$mantelzorgersAanwezig;
		return $this;
	}

	/**
	 * get value for mantelzorgers_aanwezig 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMantelzorgersAanwezig() {
		return $this->mantelzorgersAanwezig;
	}

	/**
	 * set value for mantelzorgers_detail 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $mantelzorgersDetail
	 * @return OmbRegistratie
	 */
	public function &setMantelzorgersDetail($mantelzorgersDetail) {
		$this->notifyChanged(self::FIELD_MANTELZORGERS_DETAIL,$this->mantelzorgersDetail,$mantelzorgersDetail);
		$this->mantelzorgersDetail=$mantelzorgersDetail;
		return $this;
	}

	/**
	 * get value for mantelzorgers_detail 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMantelzorgersDetail() {
		return $this->mantelzorgersDetail;
	}

	/**
	 * set value for contactpersonen_aanwezig 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @param mixed $contactpersonenAanwezig
	 * @return OmbRegistratie
	 */
	public function &setContactpersonenAanwezig($contactpersonenAanwezig) {
		$this->notifyChanged(self::FIELD_CONTACTPERSONEN_AANWEZIG,$this->contactpersonenAanwezig,$contactpersonenAanwezig);
		$this->contactpersonenAanwezig=$contactpersonenAanwezig;
		return $this;
	}

	/**
	 * get value for contactpersonen_aanwezig 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getContactpersonenAanwezig() {
		return $this->contactpersonenAanwezig;
	}

	/**
	 * set value for contactpersonen_detail 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $contactpersonenDetail
	 * @return OmbRegistratie
	 */
	public function &setContactpersonenDetail($contactpersonenDetail) {
		$this->notifyChanged(self::FIELD_CONTACTPERSONEN_DETAIL,$this->contactpersonenDetail,$contactpersonenDetail);
		$this->contactpersonenDetail=$contactpersonenDetail;
		return $this;
	}

	/**
	 * get value for contactpersonen_detail 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getContactpersonenDetail() {
		return $this->contactpersonenDetail;
	}

	/**
	 * set value for opvolging_steunpunt 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @param mixed $opvolgingSteunpunt
	 * @return OmbRegistratie
	 */
	public function &setOpvolgingSteunpunt($opvolgingSteunpunt) {
		$this->notifyChanged(self::FIELD_OPVOLGING_STEUNPUNT,$this->opvolgingSteunpunt,$opvolgingSteunpunt);
		$this->opvolgingSteunpunt=$opvolgingSteunpunt;
		return $this;
	}

	/**
	 * get value for opvolging_steunpunt 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOpvolgingSteunpunt() {
		return $this->opvolgingSteunpunt;
	}

	/**
	 * set value for standvanzaken 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $standvanzaken
	 * @return OmbRegistratie
	 */
	public function &setStandvanzaken($standvanzaken) {
		$this->notifyChanged(self::FIELD_STANDVANZAKEN,$this->standvanzaken,$standvanzaken);
		$this->standvanzaken=$standvanzaken;
		return $this;
	}

	/**
	 * get value for standvanzaken 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getStandvanzaken() {
		return $this->standvanzaken;
	}

	/**
	 * set value for afsluiten_dag 
	 *
	 * type:CHAR,size:2,default:null,nullable
	 *
	 * @param mixed $afsluitenDag
	 * @return OmbRegistratie
	 */
	public function &setAfsluitenDag($afsluitenDag) {
		$this->notifyChanged(self::FIELD_AFSLUITEN_DAG,$this->afsluitenDag,$afsluitenDag);
		$this->afsluitenDag=$afsluitenDag;
		return $this;
	}

	/**
	 * get value for afsluiten_dag 
	 *
	 * type:CHAR,size:2,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAfsluitenDag() {
		return $this->afsluitenDag;
	}

	/**
	 * set value for afsluiten_maand 
	 *
	 * type:CHAR,size:2,default:null,nullable
	 *
	 * @param mixed $afsluitenMaand
	 * @return OmbRegistratie
	 */
	public function &setAfsluitenMaand($afsluitenMaand) {
		$this->notifyChanged(self::FIELD_AFSLUITEN_MAAND,$this->afsluitenMaand,$afsluitenMaand);
		$this->afsluitenMaand=$afsluitenMaand;
		return $this;
	}

	/**
	 * get value for afsluiten_maand 
	 *
	 * type:CHAR,size:2,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAfsluitenMaand() {
		return $this->afsluitenMaand;
	}

	/**
	 * set value for afsluiten_jaar 
	 *
	 * type:VARCHAR,size:4,default:null,nullable
	 *
	 * @param mixed $afsluitenJaar
	 * @return OmbRegistratie
	 */
	public function &setAfsluitenJaar($afsluitenJaar) {
		$this->notifyChanged(self::FIELD_AFSLUITEN_JAAR,$this->afsluitenJaar,$afsluitenJaar);
		$this->afsluitenJaar=$afsluitenJaar;
		return $this;
	}

	/**
	 * get value for afsluiten_jaar 
	 *
	 * type:VARCHAR,size:4,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAfsluitenJaar() {
		return $this->afsluitenJaar;
	}

	/**
	 * set value for afsluiten_detail 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $afsluitenDetail
	 * @return OmbRegistratie
	 */
	public function &setAfsluitenDetail($afsluitenDetail) {
		$this->notifyChanged(self::FIELD_AFSLUITEN_DETAIL,$this->afsluitenDetail,$afsluitenDetail);
		$this->afsluitenDetail=$afsluitenDetail;
		return $this;
	}

	/**
	 * get value for afsluiten_detail 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAfsluitenDetail() {
		return $this->afsluitenDetail;
	}

	/**
	 * set value for afgerond 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $afgerond
	 * @return OmbRegistratie
	 */
	public function &setAfgerond($afgerond) {
		$this->notifyChanged(self::FIELD_AFGEROND,$this->afgerond,$afgerond);
		$this->afgerond=$afgerond;
		return $this;
	}

	/**
	 * get value for afgerond 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getAfgerond() {
		return $this->afgerond;
	}

	/**
	 * set value for omb_bron 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @param mixed $ombBron
	 * @return OmbRegistratie
	 */
	public function &setOmbBron($ombBron) {
		$this->notifyChanged(self::FIELD_OMB_BRON,$this->ombBron,$ombBron);
		$this->ombBron=$ombBron;
		return $this;
	}

	/**
	 * get value for omb_bron 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOmbBron() {
		return $this->ombBron;
	}

	/**
	 * set value for voorCAW 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @param mixed $voorCAW
	 * @return OmbRegistratie
	 */
	public function &setVoorCAW($voorCAW) {
		$this->notifyChanged(self::FIELD_VOORCAW,$this->voorCAW,$voorCAW);
		$this->voorCAW=$voorCAW;
		return $this;
	}

	/**
	 * get value for voorCAW 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @return mixed
	 */
	public function getVoorCAW() {
		return $this->voorCAW;
	}

	/**
	 * Get table name
	 *
	 * @return string
	 */
	public static function getTableName() {
		return self::SQL_TABLE_NAME;
	}

	/**
	 * Get array with field id as index and field name as value
	 *
	 * @return array
	 */
	public static function getFieldNames() {
		return self::$FIELD_NAMES;
	}

	/**
	 * Get array with field id as index and property name as value
	 *
	 * @return array
	 */
	public static function getPropertyNames() {
		return self::$PROPERTY_NAMES;
	}

	/**
	 * get the field name for the passed field id.
	 *
	 * @param int $fieldId
	 * @param bool $fullyQualifiedName true if field name should be qualified by table name
	 * @return string field name for the passed field id, null if the field doesn't exist
	 */
	public static function getFieldNameByFieldId($fieldId, $fullyQualifiedName=true) {
		if (!array_key_exists($fieldId, self::$FIELD_NAMES)) {
			return null;
		}
		$fieldName=self::SQL_IDENTIFIER_QUOTE . self::$FIELD_NAMES[$fieldId] . self::SQL_IDENTIFIER_QUOTE;
		if ($fullyQualifiedName) {
			return self::SQL_IDENTIFIER_QUOTE . self::SQL_TABLE_NAME . self::SQL_IDENTIFIER_QUOTE . '.' . $fieldName;
		}
		return $fieldName;
	}

	/**
	 * Get array with field ids of identifiers
	 *
	 * @return array
	 */
	public static function getIdentifierFields() {
		return self::$PRIMARY_KEYS;
	}

	/**
	 * Get array with field ids of autoincrement fields
	 *
	 * @return array
	 */
	public static function getAutoincrementFields() {
		return self::$AUTOINCREMENT_FIELDS;
	}

	/**
	 * Get array with field id as index and property type as value
	 *
	 * @return array
	 */
	public static function getPropertyTypes() {
		return self::$PROPERTY_TYPES;
	}

	/**
	 * Get array with field id as index and field type as value
	 *
	 * @return array
	 */
	public static function getFieldTypes() {
		return self::$FIELD_TYPES;
	}

	/**
	 * Assign default values according to table
	 * 
	 */
	public function assignDefaultValues() {
		$this->assignByArray(self::$DEFAULT_VALUES);
	}


	/**
	 * return hash with the field name as index and the field value as value.
	 *
	 * @return array
	 */
	public function toHash() {
		$array=$this->toArray();
		$hash=array();
		foreach ($array as $fieldId=>$value) {
			$hash[self::$FIELD_NAMES[$fieldId]]=$value;
		}
		return $hash;
	}

	/**
	 * return array with the field id as index and the field value as value.
	 *
	 * @return array
	 */
	public function toArray() {
		return array(
			self::FIELD_ID=>$this->getId(),
			self::FIELD_AUTEUR=>$this->getAuteur(),
			self::FIELD_DAG=>$this->getDag(),
			self::FIELD_MAAND=>$this->getMaand(),
			self::FIELD_JAAR=>$this->getJaar(),
			self::FIELD_DAGNUMMER=>$this->getDagnummer(),
			self::FIELD_CONTACTWIJZE=>$this->getContactwijze(),
			self::FIELD_BEKENDHEID=>$this->getBekendheid(),
			self::FIELD_DOORVERWIJZING_INTERN=>$this->getDoorverwijzingIntern(),
			self::FIELD_DOORVERWIJZING_EXTERN=>$this->getDoorverwijzingExtern(),
			self::FIELD_GENRE_MELDING=>$this->getGenreMelding(),
			self::FIELD_MELDER_SOORT=>$this->getMelderSoort(),
			self::FIELD_MELDERHVL_ID=>$this->getMelderhvlId(),
			self::FIELD_MELDER_NAAM=>$this->getMelderNaam(),
			self::FIELD_MELDER_ADRES=>$this->getMelderAdres(),
			self::FIELD_MELDER_GEMEENTE=>$this->getMelderGemeente(),
			self::FIELD_MELDER_TELEFOON=>$this->getMelderTelefoon(),
			self::FIELD_MELDER_EMAIL=>$this->getMelderEmail(),
			self::FIELD_MELDER_RELATIE=>$this->getMelderRelatie(),
			self::FIELD_MELDER_RELATIEDETAIL=>$this->getMelderRelatiedetail(),
			self::FIELD_SLACHTOFFER_NAAM=>$this->getSlachtofferNaam(),
			self::FIELD_SLACHTOFFER_LEEFTIJD=>$this->getSlachtofferLeeftijd(),
			self::FIELD_SLACHTOFFER_GESLACHT=>$this->getSlachtofferGeslacht(),
			self::FIELD_SLACHTOFFER_ADRES=>$this->getSlachtofferAdres(),
			self::FIELD_SLACHTOFFER_GEMEENTE=>$this->getSlachtofferGemeente(),
			self::FIELD_SLACHTOFFER_TELEFOON=>$this->getSlachtofferTelefoon(),
			self::FIELD_SLACHTOFFER_EMAIL=>$this->getSlachtofferEmail(),
			self::FIELD_SLACHTOFFER_WEETMELDING=>$this->getSlachtofferWeetmelding(),
			self::FIELD_SLACHTOFFER_ERVAARTMISHANDELING=>$this->getSlachtofferErvaartmishandeling(),
			self::FIELD_SAMENWONEN=>$this->getSamenwonen(),
			self::FIELD_SAMENWONEN_DETAIL=>$this->getSamenwonenDetail(),
			self::FIELD_SLACHTOFFER_MEER=>$this->getSlachtofferMeer(),
			self::FIELD_SLACHTOFFER_MEER_DETAIL=>$this->getSlachtofferMeerDetail(),
			self::FIELD_PLEGER_NAAM=>$this->getPlegerNaam(),
			self::FIELD_PLEGER_LEEFTIJD=>$this->getPlegerLeeftijd(),
			self::FIELD_PLEGER_GESLACHT=>$this->getPlegerGeslacht(),
			self::FIELD_PLEGER_ADRES=>$this->getPlegerAdres(),
			self::FIELD_PLEGER_GEMEENTE=>$this->getPlegerGemeente(),
			self::FIELD_PLEGER_TELEFOON=>$this->getPlegerTelefoon(),
			self::FIELD_PLEGER_OPDEHOOGTE=>$this->getPlegerOpdehoogte(),
			self::FIELD_PLEGER_RELATIE=>$this->getPlegerRelatie(),
			self::FIELD_PLEGER_RELATIEDETAIL=>$this->getPlegerRelatiedetail(),
			self::FIELD_PLEGERS_AANTAL=>$this->getPlegersAantal(),
			self::FIELD_PLEGERS_EXTRA=>$this->getPlegersExtra(),
			self::FIELD_SITUATIESCHETS=>$this->getSituatieschets(),
			self::FIELD_VORIGE=>$this->getVorige(),
			self::FIELD_JUSTITIE_SOORT=>$this->getJustitieSoort(),
			self::FIELD_JUSTITIE_WEETMELDING=>$this->getJustitieWeetmelding(),
			self::FIELD_JUSTITIE_DETAIL=>$this->getJustitieDetail(),
			self::FIELD_MANTELZORGERS_AANWEZIG=>$this->getMantelzorgersAanwezig(),
			self::FIELD_MANTELZORGERS_DETAIL=>$this->getMantelzorgersDetail(),
			self::FIELD_CONTACTPERSONEN_AANWEZIG=>$this->getContactpersonenAanwezig(),
			self::FIELD_CONTACTPERSONEN_DETAIL=>$this->getContactpersonenDetail(),
			self::FIELD_OPVOLGING_STEUNPUNT=>$this->getOpvolgingSteunpunt(),
			self::FIELD_STANDVANZAKEN=>$this->getStandvanzaken(),
			self::FIELD_AFSLUITEN_DAG=>$this->getAfsluitenDag(),
			self::FIELD_AFSLUITEN_MAAND=>$this->getAfsluitenMaand(),
			self::FIELD_AFSLUITEN_JAAR=>$this->getAfsluitenJaar(),
			self::FIELD_AFSLUITEN_DETAIL=>$this->getAfsluitenDetail(),
			self::FIELD_AFGEROND=>$this->getAfgerond(),
			self::FIELD_OMB_BRON=>$this->getOmbBron(),
			self::FIELD_VOORCAW=>$this->getVoorCAW());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_ID=>$this->getId());
	}

	/**
	 * cached statements
	 *
	 * @var array<string,array<string,PDOStatement>>
	 */
	private static $stmts=array();
	private static $cacheStatements=true;
	
	/**
	 * prepare passed string as statement or return cached if enabled and available
	 *
	 * @param PDO $db
	 * @param string $statement
	 * @return PDOStatement
	 */
	protected static function prepareStatement(PDO $db, $statement) {
		if(self::isCacheStatements()) {
			if (in_array($statement, array(self::SQL_INSERT, self::SQL_INSERT_AUTOINCREMENT, self::SQL_UPDATE, self::SQL_SELECT_PK, self::SQL_DELETE_PK))) {
				$dbInstanceId=spl_object_hash($db);
				if (empty(self::$stmts[$statement][$dbInstanceId])) {
					self::$stmts[$statement][$dbInstanceId]=$db->prepare($statement);
				}
				return self::$stmts[$statement][$dbInstanceId];
			}
		}
		return $db->prepare($statement);
	}

	/**
	 * Enable statement cache
	 *
	 * @param bool $cache
	 */
	public static function setCacheStatements($cache) {
		self::$cacheStatements=true==$cache;
	}

	/**
	 * Check if statement cache is enabled
	 *
	 * @return bool
	 */
	public static function isCacheStatements() {
		return self::$cacheStatements;
	}
	
	/**
	 * check if this instance exists in the database
	 *
	 * @param PDO $db
	 * @return bool
	 */
	public function existsInDatabase(PDO $db) {
		$filter=array();
		foreach ($this->getPrimaryKeyValues() as $fieldId=>$value) {
			$filter[]=new DFC($fieldId, $value, DFC::EXACT_NULLSAFE);
		}
		return 0!=count(self::findByFilter($db, $filter, true));
	}
	
	/**
	 * Update to database if exists, otherwise insert
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function updateInsertToDatabase(PDO $db) {
		if ($this->existsInDatabase($db)) {
			return $this->updateToDatabase($db);
		} else {
			return $this->insertIntoDatabase($db);
		}
	}

	/**
	 * Query by Example.
	 *
	 * Match by attributes of passed example instance and return matched rows as an array of OmbRegistratie instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param OmbRegistratie $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return OmbRegistratie[]
	 */
	public static function findByExample(PDO $db,OmbRegistratie $example, $and=true, $sort=null) {
		$exampleValues=$example->toArray();
		$filter=array();
		foreach ($exampleValues as $fieldId=>$value) {
			if (null!==$value) {
				$filter[$fieldId]=$value;
			}
		}
		return self::findByFilter($db, $filter, $and, $sort);
	}

	/**
	 * Query by filter.
	 *
	 * The filter can be either an hash with the field id as index and the value as filter value,
	 * or a array of DFC instances.
	 *
	 * Will return matched rows as an array of OmbRegistratie instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return OmbRegistratie[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `omb_registratie`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of OmbRegistratie instances
	 *
	 * @param PDOStatement $stmt
	 * @return OmbRegistratie[]
	 */
	public static function fromStatement(PDOStatement $stmt) {
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		return self::fromExecutedStatement($stmt);
	}

	/**
	 * returns the result as an array of OmbRegistratie instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return OmbRegistratie[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new OmbRegistratie();
			$o->assignByHash($result);
			$o->notifyPristine();
			$resultInstances[]=$o;
		}
		$stmt->closeCursor();
		return $resultInstances;
	}

	/**
	 * Get sql WHERE part from filter.
	 *
	 * @param array $filter
	 * @param bool $and
	 * @param bool $fullyQualifiedNames true if field names should be qualified by table name
	 * @param bool $prependWhere true if WHERE should be prepended to conditions
	 * @return string
	 */
	public static function buildSqlWhere($filter, $and, $fullyQualifiedNames=true, $prependWhere=false) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		return $filter->buildSqlWhere(new self::$CLASS_NAME, $fullyQualifiedNames, $prependWhere);
	}

	/**
	 * get sql ORDER BY part from DSCs
	 *
	 * @param array $sort array of DSC instances
	 * @return string
	 */
	protected static function buildSqlOrderBy($sort) {
		return DSC::buildSqlOrderBy(new self::$CLASS_NAME, $sort);
	}

	/**
	 * bind values from filter to statement
	 *
	 * @param PDOStatement $stmt
	 * @param DFCInterface $filter
	 */
	public static function bindValuesForFilter(PDOStatement &$stmt, DFCInterface $filter) {
		$filter->bindValuesForFilter(new self::$CLASS_NAME, $stmt);
	}

	/**
	 * Execute select query and return matched rows as an array of OmbRegistratie instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return OmbRegistratie[]
	 */
	public static function findBySql(PDO $db, $sql) {
		$stmt=$db->query($sql);
		return self::fromExecutedStatement($stmt);
	}

	/**
	 * Delete rows matching the filter
	 *
	 * The filter can be either an hash with the field id as index and the value as filter value,
	 * or a array of DFC instances.
	 *
	 * @param PDO $db
	 * @param array $filter
	 * @param bool $and
	 * @return mixed
	 */
	public static function deleteByFilter(PDO $db, $filter, $and=true) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		if (0==count($filter)) {
			throw new InvalidArgumentException('refusing to delete without filter'); // just comment out this line if you are brave
		}
		$sql='DELETE FROM `omb_registratie`'
		. self::buildSqlWhere($filter, $and, false, true);
		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Assign values from array with the field id as index and the value as value
	 *
	 * @param array $array
	 */
	public function assignByArray($array) {
		$result=array();
		foreach ($array as $fieldId=>$value) {
			$result[self::$FIELD_NAMES[$fieldId]]=$value;
		}
		$this->assignByHash($result);
	}

	/**
	 * Assign values from hash where the indexes match the tables field names
	 *
	 * @param array $result
	 */
	public function assignByHash($result) {
		$this->setId($result['id']);
		$this->setAuteur($result['auteur']);
		$this->setDag($result['dag']);
		$this->setMaand($result['maand']);
		$this->setJaar($result['jaar']);
		$this->setDagnummer($result['dagnummer']);
		$this->setContactwijze($result['contactwijze']);
		$this->setBekendheid($result['bekendheid']);
		$this->setDoorverwijzingIntern($result['doorverwijzing_intern']);
		$this->setDoorverwijzingExtern($result['doorverwijzing_extern']);
		$this->setGenreMelding($result['genre_melding']);
		$this->setMelderSoort($result['melder_soort']);
		$this->setMelderhvlId($result['melderhvl_id']);
		$this->setMelderNaam($result['melder_naam']);
		$this->setMelderAdres($result['melder_adres']);
		$this->setMelderGemeente($result['melder_gemeente']);
		$this->setMelderTelefoon($result['melder_telefoon']);
		$this->setMelderEmail($result['melder_email']);
		$this->setMelderRelatie($result['melder_relatie']);
		$this->setMelderRelatiedetail($result['melder_relatiedetail']);
		$this->setSlachtofferNaam($result['slachtoffer_naam']);
		$this->setSlachtofferLeeftijd($result['slachtoffer_leeftijd']);
		$this->setSlachtofferGeslacht($result['slachtoffer_geslacht']);
		$this->setSlachtofferAdres($result['slachtoffer_adres']);
		$this->setSlachtofferGemeente($result['slachtoffer_gemeente']);
		$this->setSlachtofferTelefoon($result['slachtoffer_telefoon']);
		$this->setSlachtofferEmail($result['slachtoffer_email']);
		$this->setSlachtofferWeetmelding($result['slachtoffer_weetmelding']);
		$this->setSlachtofferErvaartmishandeling($result['slachtoffer_ervaartmishandeling']);
		$this->setSamenwonen($result['samenwonen']);
		$this->setSamenwonenDetail($result['samenwonen_detail']);
		$this->setSlachtofferMeer($result['slachtoffer_meer']);
		$this->setSlachtofferMeerDetail($result['slachtoffer_meer_detail']);
		$this->setPlegerNaam($result['pleger_naam']);
		$this->setPlegerLeeftijd($result['pleger_leeftijd']);
		$this->setPlegerGeslacht($result['pleger_geslacht']);
		$this->setPlegerAdres($result['pleger_adres']);
		$this->setPlegerGemeente($result['pleger_gemeente']);
		$this->setPlegerTelefoon($result['pleger_telefoon']);
		$this->setPlegerOpdehoogte($result['pleger_opdehoogte']);
		$this->setPlegerRelatie($result['pleger_relatie']);
		$this->setPlegerRelatiedetail($result['pleger_relatiedetail']);
		$this->setPlegersAantal($result['plegers_aantal']);
		$this->setPlegersExtra($result['plegers_extra']);
		$this->setSituatieschets($result['situatieschets']);
		$this->setVorige($result['vorige']);
		$this->setJustitieSoort($result['justitie_soort']);
		$this->setJustitieWeetmelding($result['justitie_weetmelding']);
		$this->setJustitieDetail($result['justitie_detail']);
		$this->setMantelzorgersAanwezig($result['mantelzorgers_aanwezig']);
		$this->setMantelzorgersDetail($result['mantelzorgers_detail']);
		$this->setContactpersonenAanwezig($result['contactpersonen_aanwezig']);
		$this->setContactpersonenDetail($result['contactpersonen_detail']);
		$this->setOpvolgingSteunpunt($result['opvolging_steunpunt']);
		$this->setStandvanzaken($result['standvanzaken']);
		$this->setAfsluitenDag($result['afsluiten_dag']);
		$this->setAfsluitenMaand($result['afsluiten_maand']);
		$this->setAfsluitenJaar($result['afsluiten_jaar']);
		$this->setAfsluitenDetail($result['afsluiten_detail']);
		$this->setAfgerond($result['afgerond']);
		$this->setOmbBron($result['omb_bron']);
		$this->setVoorCAW($result['voorCAW']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return OmbRegistratie
	 */
	public static function findById(PDO $db,$id) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$id);
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$result=$stmt->fetch(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		if(!$result) {
			return null;
		}
		$o=new OmbRegistratie();
		$o->assignByHash($result);
		$o->notifyPristine();
		return $o;
	}

	/**
	 * Bind all values to statement
	 *
	 * @param PDOStatement $stmt
	 */
	protected function bindValues(PDOStatement &$stmt) {
		$stmt->bindValue(1,$this->getId());
		$stmt->bindValue(2,$this->getAuteur());
		$stmt->bindValue(3,$this->getDag());
		$stmt->bindValue(4,$this->getMaand());
		$stmt->bindValue(5,$this->getJaar());
		$stmt->bindValue(6,$this->getDagnummer());
		$stmt->bindValue(7,$this->getContactwijze());
		$stmt->bindValue(8,$this->getBekendheid());
		$stmt->bindValue(9,$this->getDoorverwijzingIntern());
		$stmt->bindValue(10,$this->getDoorverwijzingExtern());
		$stmt->bindValue(11,$this->getGenreMelding());
		$stmt->bindValue(12,$this->getMelderSoort());
		$stmt->bindValue(13,$this->getMelderhvlId());
		$stmt->bindValue(14,$this->getMelderNaam());
		$stmt->bindValue(15,$this->getMelderAdres());
		$stmt->bindValue(16,$this->getMelderGemeente());
		$stmt->bindValue(17,$this->getMelderTelefoon());
		$stmt->bindValue(18,$this->getMelderEmail());
		$stmt->bindValue(19,$this->getMelderRelatie());
		$stmt->bindValue(20,$this->getMelderRelatiedetail());
		$stmt->bindValue(21,$this->getSlachtofferNaam());
		$stmt->bindValue(22,$this->getSlachtofferLeeftijd());
		$stmt->bindValue(23,$this->getSlachtofferGeslacht());
		$stmt->bindValue(24,$this->getSlachtofferAdres());
		$stmt->bindValue(25,$this->getSlachtofferGemeente());
		$stmt->bindValue(26,$this->getSlachtofferTelefoon());
		$stmt->bindValue(27,$this->getSlachtofferEmail());
		$stmt->bindValue(28,$this->getSlachtofferWeetmelding());
		$stmt->bindValue(29,$this->getSlachtofferErvaartmishandeling());
		$stmt->bindValue(30,$this->getSamenwonen());
		$stmt->bindValue(31,$this->getSamenwonenDetail());
		$stmt->bindValue(32,$this->getSlachtofferMeer());
		$stmt->bindValue(33,$this->getSlachtofferMeerDetail());
		$stmt->bindValue(34,$this->getPlegerNaam());
		$stmt->bindValue(35,$this->getPlegerLeeftijd());
		$stmt->bindValue(36,$this->getPlegerGeslacht());
		$stmt->bindValue(37,$this->getPlegerAdres());
		$stmt->bindValue(38,$this->getPlegerGemeente());
		$stmt->bindValue(39,$this->getPlegerTelefoon());
		$stmt->bindValue(40,$this->getPlegerOpdehoogte());
		$stmt->bindValue(41,$this->getPlegerRelatie());
		$stmt->bindValue(42,$this->getPlegerRelatiedetail());
		$stmt->bindValue(43,$this->getPlegersAantal());
		$stmt->bindValue(44,$this->getPlegersExtra());
		$stmt->bindValue(45,$this->getSituatieschets());
		$stmt->bindValue(46,$this->getVorige());
		$stmt->bindValue(47,$this->getJustitieSoort());
		$stmt->bindValue(48,$this->getJustitieWeetmelding());
		$stmt->bindValue(49,$this->getJustitieDetail());
		$stmt->bindValue(50,$this->getMantelzorgersAanwezig());
		$stmt->bindValue(51,$this->getMantelzorgersDetail());
		$stmt->bindValue(52,$this->getContactpersonenAanwezig());
		$stmt->bindValue(53,$this->getContactpersonenDetail());
		$stmt->bindValue(54,$this->getOpvolgingSteunpunt());
		$stmt->bindValue(55,$this->getStandvanzaken());
		$stmt->bindValue(56,$this->getAfsluitenDag());
		$stmt->bindValue(57,$this->getAfsluitenMaand());
		$stmt->bindValue(58,$this->getAfsluitenJaar());
		$stmt->bindValue(59,$this->getAfsluitenDetail());
		$stmt->bindValue(60,$this->getAfgerond());
		$stmt->bindValue(61,$this->getOmbBron());
		$stmt->bindValue(62,$this->getVoorCAW());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getId()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getAuteur());
			$stmt->bindValue(2,$this->getDag());
			$stmt->bindValue(3,$this->getMaand());
			$stmt->bindValue(4,$this->getJaar());
			$stmt->bindValue(5,$this->getDagnummer());
			$stmt->bindValue(6,$this->getContactwijze());
			$stmt->bindValue(7,$this->getBekendheid());
			$stmt->bindValue(8,$this->getDoorverwijzingIntern());
			$stmt->bindValue(9,$this->getDoorverwijzingExtern());
			$stmt->bindValue(10,$this->getGenreMelding());
			$stmt->bindValue(11,$this->getMelderSoort());
			$stmt->bindValue(12,$this->getMelderhvlId());
			$stmt->bindValue(13,$this->getMelderNaam());
			$stmt->bindValue(14,$this->getMelderAdres());
			$stmt->bindValue(15,$this->getMelderGemeente());
			$stmt->bindValue(16,$this->getMelderTelefoon());
			$stmt->bindValue(17,$this->getMelderEmail());
			$stmt->bindValue(18,$this->getMelderRelatie());
			$stmt->bindValue(19,$this->getMelderRelatiedetail());
			$stmt->bindValue(20,$this->getSlachtofferNaam());
			$stmt->bindValue(21,$this->getSlachtofferLeeftijd());
			$stmt->bindValue(22,$this->getSlachtofferGeslacht());
			$stmt->bindValue(23,$this->getSlachtofferAdres());
			$stmt->bindValue(24,$this->getSlachtofferGemeente());
			$stmt->bindValue(25,$this->getSlachtofferTelefoon());
			$stmt->bindValue(26,$this->getSlachtofferEmail());
			$stmt->bindValue(27,$this->getSlachtofferWeetmelding());
			$stmt->bindValue(28,$this->getSlachtofferErvaartmishandeling());
			$stmt->bindValue(29,$this->getSamenwonen());
			$stmt->bindValue(30,$this->getSamenwonenDetail());
			$stmt->bindValue(31,$this->getSlachtofferMeer());
			$stmt->bindValue(32,$this->getSlachtofferMeerDetail());
			$stmt->bindValue(33,$this->getPlegerNaam());
			$stmt->bindValue(34,$this->getPlegerLeeftijd());
			$stmt->bindValue(35,$this->getPlegerGeslacht());
			$stmt->bindValue(36,$this->getPlegerAdres());
			$stmt->bindValue(37,$this->getPlegerGemeente());
			$stmt->bindValue(38,$this->getPlegerTelefoon());
			$stmt->bindValue(39,$this->getPlegerOpdehoogte());
			$stmt->bindValue(40,$this->getPlegerRelatie());
			$stmt->bindValue(41,$this->getPlegerRelatiedetail());
			$stmt->bindValue(42,$this->getPlegersAantal());
			$stmt->bindValue(43,$this->getPlegersExtra());
			$stmt->bindValue(44,$this->getSituatieschets());
			$stmt->bindValue(45,$this->getVorige());
			$stmt->bindValue(46,$this->getJustitieSoort());
			$stmt->bindValue(47,$this->getJustitieWeetmelding());
			$stmt->bindValue(48,$this->getJustitieDetail());
			$stmt->bindValue(49,$this->getMantelzorgersAanwezig());
			$stmt->bindValue(50,$this->getMantelzorgersDetail());
			$stmt->bindValue(51,$this->getContactpersonenAanwezig());
			$stmt->bindValue(52,$this->getContactpersonenDetail());
			$stmt->bindValue(53,$this->getOpvolgingSteunpunt());
			$stmt->bindValue(54,$this->getStandvanzaken());
			$stmt->bindValue(55,$this->getAfsluitenDag());
			$stmt->bindValue(56,$this->getAfsluitenMaand());
			$stmt->bindValue(57,$this->getAfsluitenJaar());
			$stmt->bindValue(58,$this->getAfsluitenDetail());
			$stmt->bindValue(59,$this->getAfgerond());
			$stmt->bindValue(60,$this->getOmbBron());
			$stmt->bindValue(61,$this->getVoorCAW());
		} else {
			$stmt=self::prepareStatement($db,self::SQL_INSERT);
			$this->bindValues($stmt);
		}
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$lastInsertId=$db->lastInsertId();
		if (false!==$lastInsertId) {
			$this->setId($lastInsertId);
		}
		$stmt->closeCursor();
		$this->notifyPristine();
		return $affected;
	}


	/**
	 * Update this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function updateToDatabase(PDO $db) {
		$stmt=self::prepareStatement($db,self::SQL_UPDATE);
		$this->bindValues($stmt);
		$stmt->bindValue(63,$this->getId());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		$this->notifyPristine();
		return $affected;
	}


	/**
	 * Delete this instance from the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function deleteFromDatabase(PDO $db) {
		$stmt=self::prepareStatement($db,self::SQL_DELETE_PK);
		$stmt->bindValue(1,$this->getId());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch Overlegbasis's which this OmbRegistratie references.
	 * `omb_registratie`.`id` -> `overlegbasis`.`omb_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegbasis[]
	 */
	public function fetchOverlegbasisCollection(PDO $db, $sort=null) {
		$filter=array(Overlegbasis::FIELD_OMB_ID=>$this->getId());
		return Overlegbasis::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Logins which references this OmbRegistratie. Will return null in case reference is invalid.
	 * `omb_registratie`.`auteur` -> `logins`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Logins
	 */
	public function fetchLogins(PDO $db, $sort=null) {
		$filter=array(Logins::FIELD_ID=>$this->getAuteur());
		$result=Logins::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'OmbRegistratie');
	}

	/**
	 * get single OmbRegistratie instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return OmbRegistratie
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new OmbRegistratie();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of OmbRegistratie from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return OmbRegistratie[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('OmbRegistratie') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>