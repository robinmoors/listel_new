<?php

include_once 'util/Db2PhpEntityBase.class.php';
include_once 'util/Db2PhpEntityModificationTracking.class.php';

include_once 'util/DFCAggregate.class.php';
/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Patient extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Patient';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='patient';
	const SQL_INSERT='INSERT INTO `patient` (`id`,`code`,`naam`,`voornaam`,`sex`,`gebdatum`,`geboorteplaats`,`burgstand_id`,`naam_echtg`,`voornaam_echtg`,`adres`,`gem_id`,`tel`,`gsm`,`woonsit`,`mantelz`,`alarm`,`mut_id`,`email`,`actief`,`type`,`mutnr`,`rijksregister`,`startdatum`,`stopzetting_text`,`stopzetting_cat`,`einddatum`,`minimum_subsidiestatus`,`subsidiestatus`,`tp_record`,`omb_actief`,`omb_bron`,`login`,`paswoord`,`pwd_recovery`,`geheime_vraag`,`geheim_antwoord`,`ipadres`,`logindatum`,`validatiestatus`,`aanvraagdatum`,`validatiedatum`,`weigerdatum`,`toegewezen_genre`,`toegewezen_id`,`menos`,`toestemming_zh`,`zorgtraject_diabetes`,`zorgtraject_nieren`,`zorgtraject_datum`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `patient` (`code`,`naam`,`voornaam`,`sex`,`gebdatum`,`geboorteplaats`,`burgstand_id`,`naam_echtg`,`voornaam_echtg`,`adres`,`gem_id`,`tel`,`gsm`,`woonsit`,`mantelz`,`alarm`,`mut_id`,`email`,`actief`,`type`,`mutnr`,`rijksregister`,`startdatum`,`stopzetting_text`,`stopzetting_cat`,`einddatum`,`minimum_subsidiestatus`,`subsidiestatus`,`tp_record`,`omb_actief`,`omb_bron`,`login`,`paswoord`,`pwd_recovery`,`geheime_vraag`,`geheim_antwoord`,`ipadres`,`logindatum`,`validatiestatus`,`aanvraagdatum`,`validatiedatum`,`weigerdatum`,`toegewezen_genre`,`toegewezen_id`,`menos`,`toestemming_zh`,`zorgtraject_diabetes`,`zorgtraject_nieren`,`zorgtraject_datum`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `patient` SET `id`=?,`code`=?,`naam`=?,`voornaam`=?,`sex`=?,`gebdatum`=?,`geboorteplaats`=?,`burgstand_id`=?,`naam_echtg`=?,`voornaam_echtg`=?,`adres`=?,`gem_id`=?,`tel`=?,`gsm`=?,`woonsit`=?,`mantelz`=?,`alarm`=?,`mut_id`=?,`email`=?,`actief`=?,`type`=?,`mutnr`=?,`rijksregister`=?,`startdatum`=?,`stopzetting_text`=?,`stopzetting_cat`=?,`einddatum`=?,`minimum_subsidiestatus`=?,`subsidiestatus`=?,`tp_record`=?,`omb_actief`=?,`omb_bron`=?,`login`=?,`paswoord`=?,`pwd_recovery`=?,`geheime_vraag`=?,`geheim_antwoord`=?,`ipadres`=?,`logindatum`=?,`validatiestatus`=?,`aanvraagdatum`=?,`validatiedatum`=?,`weigerdatum`=?,`toegewezen_genre`=?,`toegewezen_id`=?,`menos`=?,`toestemming_zh`=?,`zorgtraject_diabetes`=?,`zorgtraject_nieren`=?,`zorgtraject_datum`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `patient` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `patient` WHERE `id`=?';
	const FIELD_ID=-2061290332;
	const FIELD_CODE=-920250570;
	const FIELD_NAAM=-919936408;
	const FIELD_VOORNAAM=-694035900;
	const FIELD_SEX=524518909;
	const FIELD_GEBDATUM=-1736966028;
	const FIELD_GEBOORTEPLAATS=-1505422045;
	const FIELD_BURGSTAND_ID=-134008779;
	const FIELD_NAAM_ECHTG=660320998;
	const FIELD_VOORNAAM_ECHTG=1566070210;
	const FIELD_ADRES=1534842228;
	const FIELD_GEM_ID=508012308;
	const FIELD_TEL=524519858;
	const FIELD_GSM=524507800;
	const FIELD_WOONSIT=172264670;
	const FIELD_MANTELZ=-514403792;
	const FIELD_ALARM=1535064616;
	const FIELD_MUT_ID=694772087;
	const FIELD_EMAIL=1538788211;
	const FIELD_ACTIEF=334608385;
	const FIELD_TYPE=-919734141;
	const FIELD_MUTNR=1546433127;
	const FIELD_RIJKSREGISTER=-1233909195;
	const FIELD_STARTDATUM=438648790;
	const FIELD_STOPZETTING_TEXT=2023276576;
	const FIELD_STOPZETTING_CAT=1589271171;
	const FIELD_EINDDATUM=1752189868;
	const FIELD_MINIMUM_SUBSIDIESTATUS=-1755280906;
	const FIELD_SUBSIDIESTATUS=836346533;
	const FIELD_TP_RECORD=-300919861;
	const FIELD_OMB_ACTIEF=-1787197988;
	const FIELD_OMB_BRON=2121086995;
	const FIELD_LOGIN=1545318208;
	const FIELD_PASWOORD=-1981934992;
	const FIELD_PWD_RECOVERY=293429920;
	const FIELD_GEHEIME_VRAAG=-1786275095;
	const FIELD_GEHEIM_ANTWOORD=94939673;
	const FIELD_IPADRES=647515885;
	const FIELD_LOGINDATUM=264167727;
	const FIELD_VALIDATIESTATUS=-912284332;
	const FIELD_AANVRAAGDATUM=651042537;
	const FIELD_VALIDATIEDATUM=1618738893;
	const FIELD_WEIGERDATUM=1472622733;
	const FIELD_TOEGEWEZEN_GENRE=-1230373638;
	const FIELD_TOEGEWEZEN_ID=333423876;
	const FIELD_MENOS=1545950737;
	const FIELD_TOESTEMMING_ZH=-595953938;
	const FIELD_ZORGTRAJECT_DIABETES=193961126;
	const FIELD_ZORGTRAJECT_NIEREN=2025173428;
	const FIELD_ZORGTRAJECT_DATUM=-1606698836;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_CODE=>'code',
		self::FIELD_NAAM=>'naam',
		self::FIELD_VOORNAAM=>'voornaam',
		self::FIELD_SEX=>'sex',
		self::FIELD_GEBDATUM=>'gebdatum',
		self::FIELD_GEBOORTEPLAATS=>'geboorteplaats',
		self::FIELD_BURGSTAND_ID=>'burgstand_id',
		self::FIELD_NAAM_ECHTG=>'naam_echtg',
		self::FIELD_VOORNAAM_ECHTG=>'voornaam_echtg',
		self::FIELD_ADRES=>'adres',
		self::FIELD_GEM_ID=>'gem_id',
		self::FIELD_TEL=>'tel',
		self::FIELD_GSM=>'gsm',
		self::FIELD_WOONSIT=>'woonsit',
		self::FIELD_MANTELZ=>'mantelz',
		self::FIELD_ALARM=>'alarm',
		self::FIELD_MUT_ID=>'mut_id',
		self::FIELD_EMAIL=>'email',
		self::FIELD_ACTIEF=>'actief',
		self::FIELD_TYPE=>'type',
		self::FIELD_MUTNR=>'mutnr',
		self::FIELD_RIJKSREGISTER=>'rijksregister',
		self::FIELD_STARTDATUM=>'startdatum',
		self::FIELD_STOPZETTING_TEXT=>'stopzetting_text',
		self::FIELD_STOPZETTING_CAT=>'stopzetting_cat',
		self::FIELD_EINDDATUM=>'einddatum',
		self::FIELD_MINIMUM_SUBSIDIESTATUS=>'minimum_subsidiestatus',
		self::FIELD_SUBSIDIESTATUS=>'subsidiestatus',
		self::FIELD_TP_RECORD=>'tp_record',
		self::FIELD_OMB_ACTIEF=>'omb_actief',
		self::FIELD_OMB_BRON=>'omb_bron',
		self::FIELD_LOGIN=>'login',
		self::FIELD_PASWOORD=>'paswoord',
		self::FIELD_PWD_RECOVERY=>'pwd_recovery',
		self::FIELD_GEHEIME_VRAAG=>'geheime_vraag',
		self::FIELD_GEHEIM_ANTWOORD=>'geheim_antwoord',
		self::FIELD_IPADRES=>'ipadres',
		self::FIELD_LOGINDATUM=>'logindatum',
		self::FIELD_VALIDATIESTATUS=>'validatiestatus',
		self::FIELD_AANVRAAGDATUM=>'aanvraagdatum',
		self::FIELD_VALIDATIEDATUM=>'validatiedatum',
		self::FIELD_WEIGERDATUM=>'weigerdatum',
		self::FIELD_TOEGEWEZEN_GENRE=>'toegewezen_genre',
		self::FIELD_TOEGEWEZEN_ID=>'toegewezen_id',
		self::FIELD_MENOS=>'menos',
		self::FIELD_TOESTEMMING_ZH=>'toestemming_zh',
		self::FIELD_ZORGTRAJECT_DIABETES=>'zorgtraject_diabetes',
		self::FIELD_ZORGTRAJECT_NIEREN=>'zorgtraject_nieren',
		self::FIELD_ZORGTRAJECT_DATUM=>'zorgtraject_datum');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_CODE=>'code',
		self::FIELD_NAAM=>'naam',
		self::FIELD_VOORNAAM=>'voornaam',
		self::FIELD_SEX=>'sex',
		self::FIELD_GEBDATUM=>'gebdatum',
		self::FIELD_GEBOORTEPLAATS=>'geboorteplaats',
		self::FIELD_BURGSTAND_ID=>'burgstandId',
		self::FIELD_NAAM_ECHTG=>'naamEchtg',
		self::FIELD_VOORNAAM_ECHTG=>'voornaamEchtg',
		self::FIELD_ADRES=>'adres',
		self::FIELD_GEM_ID=>'gemId',
		self::FIELD_TEL=>'tel',
		self::FIELD_GSM=>'gsm',
		self::FIELD_WOONSIT=>'woonsit',
		self::FIELD_MANTELZ=>'mantelz',
		self::FIELD_ALARM=>'alarm',
		self::FIELD_MUT_ID=>'mutId',
		self::FIELD_EMAIL=>'email',
		self::FIELD_ACTIEF=>'actief',
		self::FIELD_TYPE=>'type',
		self::FIELD_MUTNR=>'mutnr',
		self::FIELD_RIJKSREGISTER=>'rijksregister',
		self::FIELD_STARTDATUM=>'startdatum',
		self::FIELD_STOPZETTING_TEXT=>'stopzettingText',
		self::FIELD_STOPZETTING_CAT=>'stopzettingCat',
		self::FIELD_EINDDATUM=>'einddatum',
		self::FIELD_MINIMUM_SUBSIDIESTATUS=>'minimumSubsidiestatus',
		self::FIELD_SUBSIDIESTATUS=>'subsidiestatus',
		self::FIELD_TP_RECORD=>'tpRecord',
		self::FIELD_OMB_ACTIEF=>'ombActief',
		self::FIELD_OMB_BRON=>'ombBron',
		self::FIELD_LOGIN=>'login',
		self::FIELD_PASWOORD=>'paswoord',
		self::FIELD_PWD_RECOVERY=>'pwdRecovery',
		self::FIELD_GEHEIME_VRAAG=>'geheimeVraag',
		self::FIELD_GEHEIM_ANTWOORD=>'geheimAntwoord',
		self::FIELD_IPADRES=>'ipadres',
		self::FIELD_LOGINDATUM=>'logindatum',
		self::FIELD_VALIDATIESTATUS=>'validatiestatus',
		self::FIELD_AANVRAAGDATUM=>'aanvraagdatum',
		self::FIELD_VALIDATIEDATUM=>'validatiedatum',
		self::FIELD_WEIGERDATUM=>'weigerdatum',
		self::FIELD_TOEGEWEZEN_GENRE=>'toegewezenGenre',
		self::FIELD_TOEGEWEZEN_ID=>'toegewezenId',
		self::FIELD_MENOS=>'menos',
		self::FIELD_TOESTEMMING_ZH=>'toestemmingZh',
		self::FIELD_ZORGTRAJECT_DIABETES=>'zorgtrajectDiabetes',
		self::FIELD_ZORGTRAJECT_NIEREN=>'zorgtrajectNieren',
		self::FIELD_ZORGTRAJECT_DATUM=>'zorgtrajectDatum');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_CODE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_NAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VOORNAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SEX=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_GEBDATUM=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_GEBOORTEPLAATS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_BURGSTAND_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NAAM_ECHTG=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VOORNAAM_ECHTG=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ADRES=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GEM_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TEL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GSM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_WOONSIT=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MANTELZ=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_ALARM=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MUT_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EMAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ACTIEF=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TYPE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MUTNR=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_RIJKSREGISTER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_STARTDATUM=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_STOPZETTING_TEXT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_STOPZETTING_CAT=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EINDDATUM=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MINIMUM_SUBSIDIESTATUS=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_SUBSIDIESTATUS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TP_RECORD=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_OMB_ACTIEF=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_OMB_BRON=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_LOGIN=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PASWOORD=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PWD_RECOVERY=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GEHEIME_VRAAG=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GEHEIM_ANTWOORD=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_IPADRES=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_LOGINDATUM=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_VALIDATIESTATUS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AANVRAAGDATUM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VALIDATIEDATUM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_WEIGERDATUM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TOEGEWEZEN_GENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TOEGEWEZEN_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MENOS=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TOESTEMMING_ZH=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_ZORGTRAJECT_DIABETES=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_ZORGTRAJECT_NIEREN=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_ZORGTRAJECT_DATUM=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_CODE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_NAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,25,0,false),
		self::FIELD_VOORNAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,25,0,false),
		self::FIELD_SEX=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_GEBDATUM=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_GEBOORTEPLAATS=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,80,0,false),
		self::FIELD_BURGSTAND_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_NAAM_ECHTG=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,25,0,false),
		self::FIELD_VOORNAAM_ECHTG=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,25,0,false),
		self::FIELD_ADRES=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,false),
		self::FIELD_GEM_ID=>array(Db2PhpEntity::JDBC_TYPE_SMALLINT,5,0,false),
		self::FIELD_TEL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_GSM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_WOONSIT=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_MANTELZ=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_ALARM=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_MUT_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EMAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,false),
		self::FIELD_ACTIEF=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_TYPE=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_MUTNR=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,25,0,false),
		self::FIELD_RIJKSREGISTER=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,11,0,true),
		self::FIELD_STARTDATUM=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_STOPZETTING_TEXT=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_STOPZETTING_CAT=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_EINDDATUM=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_MINIMUM_SUBSIDIESTATUS=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_SUBSIDIESTATUS=>array(Db2PhpEntity::JDBC_TYPE_CHAR,18,0,false),
		self::FIELD_TP_RECORD=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_OMB_ACTIEF=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_OMB_BRON=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_LOGIN=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,false),
		self::FIELD_PASWOORD=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,false),
		self::FIELD_PWD_RECOVERY=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,false),
		self::FIELD_GEHEIME_VRAAG=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,false),
		self::FIELD_GEHEIM_ANTWOORD=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,false),
		self::FIELD_IPADRES=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,false),
		self::FIELD_LOGINDATUM=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_VALIDATIESTATUS=>array(Db2PhpEntity::JDBC_TYPE_CHAR,11,0,false),
		self::FIELD_AANVRAAGDATUM=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,false),
		self::FIELD_VALIDATIEDATUM=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,false),
		self::FIELD_WEIGERDATUM=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,false),
		self::FIELD_TOEGEWEZEN_GENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,9,0,false),
		self::FIELD_TOEGEWEZEN_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_MENOS=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_TOESTEMMING_ZH=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_ZORGTRAJECT_DIABETES=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_ZORGTRAJECT_NIEREN=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_ZORGTRAJECT_DATUM=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_CODE=>'',
		self::FIELD_NAAM=>'',
		self::FIELD_VOORNAAM=>'',
		self::FIELD_SEX=>'1',
		self::FIELD_GEBDATUM=>0,
		self::FIELD_GEBOORTEPLAATS=>'',
		self::FIELD_BURGSTAND_ID=>1,
		self::FIELD_NAAM_ECHTG=>'',
		self::FIELD_VOORNAAM_ECHTG=>'',
		self::FIELD_ADRES=>'',
		self::FIELD_GEM_ID=>0,
		self::FIELD_TEL=>'',
		self::FIELD_GSM=>'',
		self::FIELD_WOONSIT=>1,
		self::FIELD_MANTELZ=>1,
		self::FIELD_ALARM=>0,
		self::FIELD_MUT_ID=>1,
		self::FIELD_EMAIL=>'',
		self::FIELD_ACTIEF=>1,
		self::FIELD_TYPE=>0,
		self::FIELD_MUTNR=>'',
		self::FIELD_RIJKSREGISTER=>null,
		self::FIELD_STARTDATUM=>null,
		self::FIELD_STOPZETTING_TEXT=>'',
		self::FIELD_STOPZETTING_CAT=>0,
		self::FIELD_EINDDATUM=>0,
		self::FIELD_MINIMUM_SUBSIDIESTATUS=>1,
		self::FIELD_SUBSIDIESTATUS=>'niet-verdedigbaar',
		self::FIELD_TP_RECORD=>null,
		self::FIELD_OMB_ACTIEF=>'0',
		self::FIELD_OMB_BRON=>null,
		self::FIELD_LOGIN=>'',
		self::FIELD_PASWOORD=>'',
		self::FIELD_PWD_RECOVERY=>'',
		self::FIELD_GEHEIME_VRAAG=>'',
		self::FIELD_GEHEIM_ANTWOORD=>'',
		self::FIELD_IPADRES=>'',
		self::FIELD_LOGINDATUM=>0,
		self::FIELD_VALIDATIESTATUS=>'geenkeuze',
		self::FIELD_AANVRAAGDATUM=>'1000-01-01',
		self::FIELD_VALIDATIEDATUM=>'1000-01-01',
		self::FIELD_WEIGERDATUM=>'1000-01-01',
		self::FIELD_TOEGEWEZEN_GENRE=>'gemeente',
		self::FIELD_TOEGEWEZEN_ID=>null,
		self::FIELD_MENOS=>0,
		self::FIELD_TOESTEMMING_ZH=>'0',
		self::FIELD_ZORGTRAJECT_DIABETES=>0,
		self::FIELD_ZORGTRAJECT_NIEREN=>0,
		self::FIELD_ZORGTRAJECT_DATUM=>'');
	private $id;
	private $code;
	private $naam;
	private $voornaam;
	private $sex;
	private $gebdatum;
	private $geboorteplaats;
	private $burgstandId;
	private $naamEchtg;
	private $voornaamEchtg;
	private $adres;
	private $gemId;
	private $tel;
	private $gsm;
	private $woonsit;
	private $mantelz;
	private $alarm;
	private $mutId;
	private $email;
	private $actief;
	private $type;
	private $mutnr;
	private $rijksregister;
	private $startdatum;
	private $stopzettingText;
	private $stopzettingCat;
	private $einddatum;
	private $minimumSubsidiestatus;
	private $subsidiestatus;
	private $tpRecord;
	private $ombActief;
	private $ombBron;
	private $login;
	private $paswoord;
	private $pwdRecovery;
	private $geheimeVraag;
	private $geheimAntwoord;
	private $ipadres;
	private $logindatum;
	private $validatiestatus;
	private $aanvraagdatum;
	private $validatiedatum;
	private $weigerdatum;
	private $toegewezenGenre;
	private $toegewezenId;
	private $menos;
	private $toestemmingZh;
	private $zorgtrajectDiabetes;
	private $zorgtrajectNieren;
	private $zorgtrajectDatum;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return Patient
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
	 * set value for code 
	 *
	 * type:VARCHAR,size:20,default:,unique
	 *
	 * @param mixed $code
	 * @return Patient
	 */
	public function &setCode($code) {
		$this->notifyChanged(self::FIELD_CODE,$this->code,$code);
		$this->code=$code;
		return $this;
	}

	/**
	 * get value for code 
	 *
	 * type:VARCHAR,size:20,default:,unique
	 *
	 * @return mixed
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * set value for naam 
	 *
	 * type:VARCHAR,size:25,default:
	 *
	 * @param mixed $naam
	 * @return Patient
	 */
	public function &setNaam($naam) {
		$this->notifyChanged(self::FIELD_NAAM,$this->naam,$naam);
		$this->naam=$naam;
		return $this;
	}

	/**
	 * get value for naam 
	 *
	 * type:VARCHAR,size:25,default:
	 *
	 * @return mixed
	 */
	public function getNaam() {
		return $this->naam;
	}

	/**
	 * set value for voornaam 
	 *
	 * type:VARCHAR,size:25,default:
	 *
	 * @param mixed $voornaam
	 * @return Patient
	 */
	public function &setVoornaam($voornaam) {
		$this->notifyChanged(self::FIELD_VOORNAAM,$this->voornaam,$voornaam);
		$this->voornaam=$voornaam;
		return $this;
	}

	/**
	 * get value for voornaam 
	 *
	 * type:VARCHAR,size:25,default:
	 *
	 * @return mixed
	 */
	public function getVoornaam() {
		return $this->voornaam;
	}

	/**
	 * set value for sex 
	 *
	 * type:BIT,size:0,default:1
	 *
	 * @param mixed $sex
	 * @return Patient
	 */
	public function &setSex($sex) {
		$this->notifyChanged(self::FIELD_SEX,$this->sex,$sex);
		$this->sex=$sex;
		return $this;
	}

	/**
	 * get value for sex 
	 *
	 * type:BIT,size:0,default:1
	 *
	 * @return mixed
	 */
	public function getSex() {
		return $this->sex;
	}

	/**
	 * set value for gebdatum 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $gebdatum
	 * @return Patient
	 */
	public function &setGebdatum($gebdatum) {
		$this->notifyChanged(self::FIELD_GEBDATUM,$this->gebdatum,$gebdatum);
		$this->gebdatum=$gebdatum;
		return $this;
	}

	/**
	 * get value for gebdatum 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getGebdatum() {
		return $this->gebdatum;
	}

	/**
	 * set value for geboorteplaats 
	 *
	 * type:VARCHAR,size:80,default:null
	 *
	 * @param mixed $geboorteplaats
	 * @return Patient
	 */
	public function &setGeboorteplaats($geboorteplaats) {
		$this->notifyChanged(self::FIELD_GEBOORTEPLAATS,$this->geboorteplaats,$geboorteplaats);
		$this->geboorteplaats=$geboorteplaats;
		return $this;
	}

	/**
	 * get value for geboorteplaats 
	 *
	 * type:VARCHAR,size:80,default:null
	 *
	 * @return mixed
	 */
	public function getGeboorteplaats() {
		return $this->geboorteplaats;
	}

	/**
	 * set value for burgstand_id 
	 *
	 * type:INT,size:10,default:1,index
	 *
	 * @param mixed $burgstandId
	 * @return Patient
	 */
	public function &setBurgstandId($burgstandId) {
		$this->notifyChanged(self::FIELD_BURGSTAND_ID,$this->burgstandId,$burgstandId);
		$this->burgstandId=$burgstandId;
		return $this;
	}

	/**
	 * get value for burgstand_id 
	 *
	 * type:INT,size:10,default:1,index
	 *
	 * @return mixed
	 */
	public function getBurgstandId() {
		return $this->burgstandId;
	}

	/**
	 * set value for naam_echtg 
	 *
	 * type:VARCHAR,size:25,default:
	 *
	 * @param mixed $naamEchtg
	 * @return Patient
	 */
	public function &setNaamEchtg($naamEchtg) {
		$this->notifyChanged(self::FIELD_NAAM_ECHTG,$this->naamEchtg,$naamEchtg);
		$this->naamEchtg=$naamEchtg;
		return $this;
	}

	/**
	 * get value for naam_echtg 
	 *
	 * type:VARCHAR,size:25,default:
	 *
	 * @return mixed
	 */
	public function getNaamEchtg() {
		return $this->naamEchtg;
	}

	/**
	 * set value for voornaam_echtg 
	 *
	 * type:VARCHAR,size:25,default:
	 *
	 * @param mixed $voornaamEchtg
	 * @return Patient
	 */
	public function &setVoornaamEchtg($voornaamEchtg) {
		$this->notifyChanged(self::FIELD_VOORNAAM_ECHTG,$this->voornaamEchtg,$voornaamEchtg);
		$this->voornaamEchtg=$voornaamEchtg;
		return $this;
	}

	/**
	 * get value for voornaam_echtg 
	 *
	 * type:VARCHAR,size:25,default:
	 *
	 * @return mixed
	 */
	public function getVoornaamEchtg() {
		return $this->voornaamEchtg;
	}

	/**
	 * set value for adres 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @param mixed $adres
	 * @return Patient
	 */
	public function &setAdres($adres) {
		$this->notifyChanged(self::FIELD_ADRES,$this->adres,$adres);
		$this->adres=$adres;
		return $this;
	}

	/**
	 * get value for adres 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @return mixed
	 */
	public function getAdres() {
		return $this->adres;
	}

	/**
	 * set value for gem_id 
	 *
	 * type:SMALLINT,size:5,default:0,index
	 *
	 * @param mixed $gemId
	 * @return Patient
	 */
	public function &setGemId($gemId) {
		$this->notifyChanged(self::FIELD_GEM_ID,$this->gemId,$gemId);
		$this->gemId=$gemId;
		return $this;
	}

	/**
	 * get value for gem_id 
	 *
	 * type:SMALLINT,size:5,default:0,index
	 *
	 * @return mixed
	 */
	public function getGemId() {
		return $this->gemId;
	}

	/**
	 * set value for tel 
	 *
	 * type:VARCHAR,size:20,default:
	 *
	 * @param mixed $tel
	 * @return Patient
	 */
	public function &setTel($tel) {
		$this->notifyChanged(self::FIELD_TEL,$this->tel,$tel);
		$this->tel=$tel;
		return $this;
	}

	/**
	 * get value for tel 
	 *
	 * type:VARCHAR,size:20,default:
	 *
	 * @return mixed
	 */
	public function getTel() {
		return $this->tel;
	}

	/**
	 * set value for gsm 
	 *
	 * type:VARCHAR,size:20,default:
	 *
	 * @param mixed $gsm
	 * @return Patient
	 */
	public function &setGsm($gsm) {
		$this->notifyChanged(self::FIELD_GSM,$this->gsm,$gsm);
		$this->gsm=$gsm;
		return $this;
	}

	/**
	 * get value for gsm 
	 *
	 * type:VARCHAR,size:20,default:
	 *
	 * @return mixed
	 */
	public function getGsm() {
		return $this->gsm;
	}

	/**
	 * set value for woonsit 
	 *
	 * type:INT,size:10,default:1
	 *
	 * @param mixed $woonsit
	 * @return Patient
	 */
	public function &setWoonsit($woonsit) {
		$this->notifyChanged(self::FIELD_WOONSIT,$this->woonsit,$woonsit);
		$this->woonsit=$woonsit;
		return $this;
	}

	/**
	 * get value for woonsit 
	 *
	 * type:INT,size:10,default:1
	 *
	 * @return mixed
	 */
	public function getWoonsit() {
		return $this->woonsit;
	}

	/**
	 * set value for mantelz 
	 *
	 * type:INT,size:10,default:1
	 *
	 * @param mixed $mantelz
	 * @return Patient
	 */
	public function &setMantelz($mantelz) {
		$this->notifyChanged(self::FIELD_MANTELZ,$this->mantelz,$mantelz);
		$this->mantelz=$mantelz;
		return $this;
	}

	/**
	 * get value for mantelz 
	 *
	 * type:INT,size:10,default:1
	 *
	 * @return mixed
	 */
	public function getMantelz() {
		return $this->mantelz;
	}

	/**
	 * set value for alarm 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $alarm
	 * @return Patient
	 */
	public function &setAlarm($alarm) {
		$this->notifyChanged(self::FIELD_ALARM,$this->alarm,$alarm);
		$this->alarm=$alarm;
		return $this;
	}

	/**
	 * get value for alarm 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getAlarm() {
		return $this->alarm;
	}

	/**
	 * set value for mut_id 
	 *
	 * type:INT,size:10,default:1,index
	 *
	 * @param mixed $mutId
	 * @return Patient
	 */
	public function &setMutId($mutId) {
		$this->notifyChanged(self::FIELD_MUT_ID,$this->mutId,$mutId);
		$this->mutId=$mutId;
		return $this;
	}

	/**
	 * get value for mut_id 
	 *
	 * type:INT,size:10,default:1,index
	 *
	 * @return mixed
	 */
	public function getMutId() {
		return $this->mutId;
	}

	/**
	 * set value for email 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @param mixed $email
	 * @return Patient
	 */
	public function &setEmail($email) {
		$this->notifyChanged(self::FIELD_EMAIL,$this->email,$email);
		$this->email=$email;
		return $this;
	}

	/**
	 * get value for email 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * set value for actief 
	 *
	 * type:INT,size:10,default:1
	 *
	 * @param mixed $actief
	 * @return Patient
	 */
	public function &setActief($actief) {
		$this->notifyChanged(self::FIELD_ACTIEF,$this->actief,$actief);
		$this->actief=$actief;
		return $this;
	}

	/**
	 * get value for actief 
	 *
	 * type:INT,size:10,default:1
	 *
	 * @return mixed
	 */
	public function getActief() {
		return $this->actief;
	}

	/**
	 * set value for type 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $type
	 * @return Patient
	 */
	public function &setType($type) {
		$this->notifyChanged(self::FIELD_TYPE,$this->type,$type);
		$this->type=$type;
		return $this;
	}

	/**
	 * get value for type 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * set value for mutnr 
	 *
	 * type:VARCHAR,size:25,default:
	 *
	 * @param mixed $mutnr
	 * @return Patient
	 */
	public function &setMutnr($mutnr) {
		$this->notifyChanged(self::FIELD_MUTNR,$this->mutnr,$mutnr);
		$this->mutnr=$mutnr;
		return $this;
	}

	/**
	 * get value for mutnr 
	 *
	 * type:VARCHAR,size:25,default:
	 *
	 * @return mixed
	 */
	public function getMutnr() {
		return $this->mutnr;
	}

	/**
	 * set value for rijksregister 
	 *
	 * type:VARCHAR,size:11,default:null,nullable
	 *
	 * @param mixed $rijksregister
	 * @return Patient
	 */
	public function &setRijksregister($rijksregister) {
		$this->notifyChanged(self::FIELD_RIJKSREGISTER,$this->rijksregister,$rijksregister);
		$this->rijksregister=$rijksregister;
		return $this;
	}

	/**
	 * get value for rijksregister 
	 *
	 * type:VARCHAR,size:11,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getRijksregister() {
		return $this->rijksregister;
	}

	/**
	 * set value for startdatum 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $startdatum
	 * @return Patient
	 */
	public function &setStartdatum($startdatum) {
		$this->notifyChanged(self::FIELD_STARTDATUM,$this->startdatum,$startdatum);
		$this->startdatum=$startdatum;
		return $this;
	}

	/**
	 * get value for startdatum 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getStartdatum() {
		return $this->startdatum;
	}

	/**
	 * set value for stopzetting_text 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @param mixed $stopzettingText
	 * @return Patient
	 */
	public function &setStopzettingText($stopzettingText) {
		$this->notifyChanged(self::FIELD_STOPZETTING_TEXT,$this->stopzettingText,$stopzettingText);
		$this->stopzettingText=$stopzettingText;
		return $this;
	}

	/**
	 * get value for stopzetting_text 
	 *
	 * type:TINYTEXT,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getStopzettingText() {
		return $this->stopzettingText;
	}

	/**
	 * set value for stopzetting_cat 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $stopzettingCat
	 * @return Patient
	 */
	public function &setStopzettingCat($stopzettingCat) {
		$this->notifyChanged(self::FIELD_STOPZETTING_CAT,$this->stopzettingCat,$stopzettingCat);
		$this->stopzettingCat=$stopzettingCat;
		return $this;
	}

	/**
	 * get value for stopzetting_cat 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getStopzettingCat() {
		return $this->stopzettingCat;
	}

	/**
	 * set value for einddatum 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $einddatum
	 * @return Patient
	 */
	public function &setEinddatum($einddatum) {
		$this->notifyChanged(self::FIELD_EINDDATUM,$this->einddatum,$einddatum);
		$this->einddatum=$einddatum;
		return $this;
	}

	/**
	 * get value for einddatum 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getEinddatum() {
		return $this->einddatum;
	}

	/**
	 * set value for minimum_subsidiestatus 
	 *
	 * type:INT,size:10,default:1
	 *
	 * @param mixed $minimumSubsidiestatus
	 * @return Patient
	 */
	public function &setMinimumSubsidiestatus($minimumSubsidiestatus) {
		$this->notifyChanged(self::FIELD_MINIMUM_SUBSIDIESTATUS,$this->minimumSubsidiestatus,$minimumSubsidiestatus);
		$this->minimumSubsidiestatus=$minimumSubsidiestatus;
		return $this;
	}

	/**
	 * get value for minimum_subsidiestatus 
	 *
	 * type:INT,size:10,default:1
	 *
	 * @return mixed
	 */
	public function getMinimumSubsidiestatus() {
		return $this->minimumSubsidiestatus;
	}

	/**
	 * set value for subsidiestatus 
	 *
	 * type:ENUM,size:18,default:niet-verdedigbaar
	 *
	 * @param mixed $subsidiestatus
	 * @return Patient
	 */
	public function &setSubsidiestatus($subsidiestatus) {
		$this->notifyChanged(self::FIELD_SUBSIDIESTATUS,$this->subsidiestatus,$subsidiestatus);
		$this->subsidiestatus=$subsidiestatus;
		return $this;
	}

	/**
	 * get value for subsidiestatus 
	 *
	 * type:ENUM,size:18,default:niet-verdedigbaar
	 *
	 * @return mixed
	 */
	public function getSubsidiestatus() {
		return $this->subsidiestatus;
	}

	/**
	 * set value for tp_record 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $tpRecord
	 * @return Patient
	 */
	public function &setTpRecord($tpRecord) {
		$this->notifyChanged(self::FIELD_TP_RECORD,$this->tpRecord,$tpRecord);
		$this->tpRecord=$tpRecord;
		return $this;
	}

	/**
	 * get value for tp_record 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTpRecord() {
		return $this->tpRecord;
	}

	/**
	 * set value for omb_actief 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $ombActief
	 * @return Patient
	 */
	public function &setOmbActief($ombActief) {
		$this->notifyChanged(self::FIELD_OMB_ACTIEF,$this->ombActief,$ombActief);
		$this->ombActief=$ombActief;
		return $this;
	}

	/**
	 * get value for omb_actief 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getOmbActief() {
		return $this->ombActief;
	}

	/**
	 * set value for omb_bron 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @param mixed $ombBron
	 * @return Patient
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
	 * set value for login 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @param mixed $login
	 * @return Patient
	 */
	public function &setLogin($login) {
		$this->notifyChanged(self::FIELD_LOGIN,$this->login,$login);
		$this->login=$login;
		return $this;
	}

	/**
	 * get value for login 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @return mixed
	 */
	public function getLogin() {
		return $this->login;
	}

	/**
	 * set value for paswoord 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @param mixed $paswoord
	 * @return Patient
	 */
	public function &setPaswoord($paswoord) {
		$this->notifyChanged(self::FIELD_PASWOORD,$this->paswoord,$paswoord);
		$this->paswoord=$paswoord;
		return $this;
	}

	/**
	 * get value for paswoord 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @return mixed
	 */
	public function getPaswoord() {
		return $this->paswoord;
	}

	/**
	 * set value for pwd_recovery 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @param mixed $pwdRecovery
	 * @return Patient
	 */
	public function &setPwdRecovery($pwdRecovery) {
		$this->notifyChanged(self::FIELD_PWD_RECOVERY,$this->pwdRecovery,$pwdRecovery);
		$this->pwdRecovery=$pwdRecovery;
		return $this;
	}

	/**
	 * get value for pwd_recovery 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @return mixed
	 */
	public function getPwdRecovery() {
		return $this->pwdRecovery;
	}

	/**
	 * set value for geheime_vraag 
	 *
	 * type:VARCHAR,size:200,default:
	 *
	 * @param mixed $geheimeVraag
	 * @return Patient
	 */
	public function &setGeheimeVraag($geheimeVraag) {
		$this->notifyChanged(self::FIELD_GEHEIME_VRAAG,$this->geheimeVraag,$geheimeVraag);
		$this->geheimeVraag=$geheimeVraag;
		return $this;
	}

	/**
	 * get value for geheime_vraag 
	 *
	 * type:VARCHAR,size:200,default:
	 *
	 * @return mixed
	 */
	public function getGeheimeVraag() {
		return $this->geheimeVraag;
	}

	/**
	 * set value for geheim_antwoord 
	 *
	 * type:VARCHAR,size:200,default:
	 *
	 * @param mixed $geheimAntwoord
	 * @return Patient
	 */
	public function &setGeheimAntwoord($geheimAntwoord) {
		$this->notifyChanged(self::FIELD_GEHEIM_ANTWOORD,$this->geheimAntwoord,$geheimAntwoord);
		$this->geheimAntwoord=$geheimAntwoord;
		return $this;
	}

	/**
	 * get value for geheim_antwoord 
	 *
	 * type:VARCHAR,size:200,default:
	 *
	 * @return mixed
	 */
	public function getGeheimAntwoord() {
		return $this->geheimAntwoord;
	}

	/**
	 * set value for ipadres 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @param mixed $ipadres
	 * @return Patient
	 */
	public function &setIpadres($ipadres) {
		$this->notifyChanged(self::FIELD_IPADRES,$this->ipadres,$ipadres);
		$this->ipadres=$ipadres;
		return $this;
	}

	/**
	 * get value for ipadres 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @return mixed
	 */
	public function getIpadres() {
		return $this->ipadres;
	}

	/**
	 * set value for logindatum 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $logindatum
	 * @return Patient
	 */
	public function &setLogindatum($logindatum) {
		$this->notifyChanged(self::FIELD_LOGINDATUM,$this->logindatum,$logindatum);
		$this->logindatum=$logindatum;
		return $this;
	}

	/**
	 * get value for logindatum 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getLogindatum() {
		return $this->logindatum;
	}

	/**
	 * set value for validatiestatus 
	 *
	 * type:ENUM,size:11,default:geenkeuze
	 *
	 * @param mixed $validatiestatus
	 * @return Patient
	 */
	public function &setValidatiestatus($validatiestatus) {
		$this->notifyChanged(self::FIELD_VALIDATIESTATUS,$this->validatiestatus,$validatiestatus);
		$this->validatiestatus=$validatiestatus;
		return $this;
	}

	/**
	 * get value for validatiestatus 
	 *
	 * type:ENUM,size:11,default:geenkeuze
	 *
	 * @return mixed
	 */
	public function getValidatiestatus() {
		return $this->validatiestatus;
	}

	/**
	 * set value for aanvraagdatum 
	 *
	 * type:DATE,size:10,default:1000-01-01
	 *
	 * @param mixed $aanvraagdatum
	 * @return Patient
	 */
	public function &setAanvraagdatum($aanvraagdatum) {
		$this->notifyChanged(self::FIELD_AANVRAAGDATUM,$this->aanvraagdatum,$aanvraagdatum);
		$this->aanvraagdatum=$aanvraagdatum;
		return $this;
	}

	/**
	 * get value for aanvraagdatum 
	 *
	 * type:DATE,size:10,default:1000-01-01
	 *
	 * @return mixed
	 */
	public function getAanvraagdatum() {
		return $this->aanvraagdatum;
	}

	/**
	 * set value for validatiedatum 
	 *
	 * type:DATE,size:10,default:1000-01-01
	 *
	 * @param mixed $validatiedatum
	 * @return Patient
	 */
	public function &setValidatiedatum($validatiedatum) {
		$this->notifyChanged(self::FIELD_VALIDATIEDATUM,$this->validatiedatum,$validatiedatum);
		$this->validatiedatum=$validatiedatum;
		return $this;
	}

	/**
	 * get value for validatiedatum 
	 *
	 * type:DATE,size:10,default:1000-01-01
	 *
	 * @return mixed
	 */
	public function getValidatiedatum() {
		return $this->validatiedatum;
	}

	/**
	 * set value for weigerdatum 
	 *
	 * type:DATE,size:10,default:1000-01-01
	 *
	 * @param mixed $weigerdatum
	 * @return Patient
	 */
	public function &setWeigerdatum($weigerdatum) {
		$this->notifyChanged(self::FIELD_WEIGERDATUM,$this->weigerdatum,$weigerdatum);
		$this->weigerdatum=$weigerdatum;
		return $this;
	}

	/**
	 * get value for weigerdatum 
	 *
	 * type:DATE,size:10,default:1000-01-01
	 *
	 * @return mixed
	 */
	public function getWeigerdatum() {
		return $this->weigerdatum;
	}

	/**
	 * set value for toegewezen_genre 
	 *
	 * type:ENUM,size:9,default:gemeente
	 *
	 * @param mixed $toegewezenGenre
	 * @return Patient
	 */
	public function &setToegewezenGenre($toegewezenGenre) {
		$this->notifyChanged(self::FIELD_TOEGEWEZEN_GENRE,$this->toegewezenGenre,$toegewezenGenre);
		$this->toegewezenGenre=$toegewezenGenre;
		return $this;
	}

	/**
	 * get value for toegewezen_genre 
	 *
	 * type:ENUM,size:9,default:gemeente
	 *
	 * @return mixed
	 */
	public function getToegewezenGenre() {
		return $this->toegewezenGenre;
	}

	/**
	 * set value for toegewezen_id 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $toegewezenId
	 * @return Patient
	 */
	public function &setToegewezenId($toegewezenId) {
		$this->notifyChanged(self::FIELD_TOEGEWEZEN_ID,$this->toegewezenId,$toegewezenId);
		$this->toegewezenId=$toegewezenId;
		return $this;
	}

	/**
	 * get value for toegewezen_id 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getToegewezenId() {
		return $this->toegewezenId;
	}

	/**
	 * set value for menos 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @param mixed $menos
	 * @return Patient
	 */
	public function &setMenos($menos) {
		$this->notifyChanged(self::FIELD_MENOS,$this->menos,$menos);
		$this->menos=$menos;
		return $this;
	}

	/**
	 * get value for menos 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @return mixed
	 */
	public function getMenos() {
		return $this->menos;
	}

	/**
	 * set value for toestemming_zh 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $toestemmingZh
	 * @return Patient
	 */
	public function &setToestemmingZh($toestemmingZh) {
		$this->notifyChanged(self::FIELD_TOESTEMMING_ZH,$this->toestemmingZh,$toestemmingZh);
		$this->toestemmingZh=$toestemmingZh;
		return $this;
	}

	/**
	 * get value for toestemming_zh 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getToestemmingZh() {
		return $this->toestemmingZh;
	}

	/**
	 * set value for zorgtraject_diabetes 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $zorgtrajectDiabetes
	 * @return Patient
	 */
	public function &setZorgtrajectDiabetes($zorgtrajectDiabetes) {
		$this->notifyChanged(self::FIELD_ZORGTRAJECT_DIABETES,$this->zorgtrajectDiabetes,$zorgtrajectDiabetes);
		$this->zorgtrajectDiabetes=$zorgtrajectDiabetes;
		return $this;
	}

	/**
	 * get value for zorgtraject_diabetes 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getZorgtrajectDiabetes() {
		return $this->zorgtrajectDiabetes;
	}

	/**
	 * set value for zorgtraject_nieren 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $zorgtrajectNieren
	 * @return Patient
	 */
	public function &setZorgtrajectNieren($zorgtrajectNieren) {
		$this->notifyChanged(self::FIELD_ZORGTRAJECT_NIEREN,$this->zorgtrajectNieren,$zorgtrajectNieren);
		$this->zorgtrajectNieren=$zorgtrajectNieren;
		return $this;
	}

	/**
	 * get value for zorgtraject_nieren 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getZorgtrajectNieren() {
		return $this->zorgtrajectNieren;
	}

	/**
	 * set value for zorgtraject_datum 
	 *
	 * type:DATE,size:10,default:null
	 *
	 * @param mixed $zorgtrajectDatum
	 * @return Patient
	 */
	public function &setZorgtrajectDatum($zorgtrajectDatum) {
		$this->notifyChanged(self::FIELD_ZORGTRAJECT_DATUM,$this->zorgtrajectDatum,$zorgtrajectDatum);
		$this->zorgtrajectDatum=$zorgtrajectDatum;
		return $this;
	}

	/**
	 * get value for zorgtraject_datum 
	 *
	 * type:DATE,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getZorgtrajectDatum() {
		return $this->zorgtrajectDatum;
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
			self::FIELD_CODE=>$this->getCode(),
			self::FIELD_NAAM=>$this->getNaam(),
			self::FIELD_VOORNAAM=>$this->getVoornaam(),
			self::FIELD_SEX=>$this->getSex(),
			self::FIELD_GEBDATUM=>$this->getGebdatum(),
			self::FIELD_GEBOORTEPLAATS=>$this->getGeboorteplaats(),
			self::FIELD_BURGSTAND_ID=>$this->getBurgstandId(),
			self::FIELD_NAAM_ECHTG=>$this->getNaamEchtg(),
			self::FIELD_VOORNAAM_ECHTG=>$this->getVoornaamEchtg(),
			self::FIELD_ADRES=>$this->getAdres(),
			self::FIELD_GEM_ID=>$this->getGemId(),
			self::FIELD_TEL=>$this->getTel(),
			self::FIELD_GSM=>$this->getGsm(),
			self::FIELD_WOONSIT=>$this->getWoonsit(),
			self::FIELD_MANTELZ=>$this->getMantelz(),
			self::FIELD_ALARM=>$this->getAlarm(),
			self::FIELD_MUT_ID=>$this->getMutId(),
			self::FIELD_EMAIL=>$this->getEmail(),
			self::FIELD_ACTIEF=>$this->getActief(),
			self::FIELD_TYPE=>$this->getType(),
			self::FIELD_MUTNR=>$this->getMutnr(),
			self::FIELD_RIJKSREGISTER=>$this->getRijksregister(),
			self::FIELD_STARTDATUM=>$this->getStartdatum(),
			self::FIELD_STOPZETTING_TEXT=>$this->getStopzettingText(),
			self::FIELD_STOPZETTING_CAT=>$this->getStopzettingCat(),
			self::FIELD_EINDDATUM=>$this->getEinddatum(),
			self::FIELD_MINIMUM_SUBSIDIESTATUS=>$this->getMinimumSubsidiestatus(),
			self::FIELD_SUBSIDIESTATUS=>$this->getSubsidiestatus(),
			self::FIELD_TP_RECORD=>$this->getTpRecord(),
			self::FIELD_OMB_ACTIEF=>$this->getOmbActief(),
			self::FIELD_OMB_BRON=>$this->getOmbBron(),
			self::FIELD_LOGIN=>$this->getLogin(),
			self::FIELD_PASWOORD=>$this->getPaswoord(),
			self::FIELD_PWD_RECOVERY=>$this->getPwdRecovery(),
			self::FIELD_GEHEIME_VRAAG=>$this->getGeheimeVraag(),
			self::FIELD_GEHEIM_ANTWOORD=>$this->getGeheimAntwoord(),
			self::FIELD_IPADRES=>$this->getIpadres(),
			self::FIELD_LOGINDATUM=>$this->getLogindatum(),
			self::FIELD_VALIDATIESTATUS=>$this->getValidatiestatus(),
			self::FIELD_AANVRAAGDATUM=>$this->getAanvraagdatum(),
			self::FIELD_VALIDATIEDATUM=>$this->getValidatiedatum(),
			self::FIELD_WEIGERDATUM=>$this->getWeigerdatum(),
			self::FIELD_TOEGEWEZEN_GENRE=>$this->getToegewezenGenre(),
			self::FIELD_TOEGEWEZEN_ID=>$this->getToegewezenId(),
			self::FIELD_MENOS=>$this->getMenos(),
			self::FIELD_TOESTEMMING_ZH=>$this->getToestemmingZh(),
			self::FIELD_ZORGTRAJECT_DIABETES=>$this->getZorgtrajectDiabetes(),
			self::FIELD_ZORGTRAJECT_NIEREN=>$this->getZorgtrajectNieren(),
			self::FIELD_ZORGTRAJECT_DATUM=>$this->getZorgtrajectDatum());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Patient instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Patient $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Patient[]
	 */
	public static function findByExample(PDO $db,Patient $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Patient instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Patient[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `patient`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Patient instances
	 *
	 * @param PDOStatement $stmt
	 * @return Patient[]
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
	 * returns the result as an array of Patient instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Patient[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Patient();
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
	 * Execute select query and return matched rows as an array of Patient instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Patient[]
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
		$sql='DELETE FROM `patient`'
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
		$this->setCode($result['code']);
		$this->setNaam($result['naam']);
		$this->setVoornaam($result['voornaam']);
		$this->setSex($result['sex']);
		$this->setGebdatum($result['gebdatum']);
		$this->setGeboorteplaats($result['geboorteplaats']);
		$this->setBurgstandId($result['burgstand_id']);
		$this->setNaamEchtg($result['naam_echtg']);
		$this->setVoornaamEchtg($result['voornaam_echtg']);
		$this->setAdres($result['adres']);
		$this->setGemId($result['gem_id']);
		$this->setTel($result['tel']);
		$this->setGsm($result['gsm']);
		$this->setWoonsit($result['woonsit']);
		$this->setMantelz($result['mantelz']);
		$this->setAlarm($result['alarm']);
		$this->setMutId($result['mut_id']);
		$this->setEmail($result['email']);
		$this->setActief($result['actief']);
		$this->setType($result['type']);
		$this->setMutnr($result['mutnr']);
		$this->setRijksregister($result['rijksregister']);
		$this->setStartdatum($result['startdatum']);
		$this->setStopzettingText($result['stopzetting_text']);
		$this->setStopzettingCat($result['stopzetting_cat']);
		$this->setEinddatum($result['einddatum']);
		$this->setMinimumSubsidiestatus($result['minimum_subsidiestatus']);
		$this->setSubsidiestatus($result['subsidiestatus']);
		$this->setTpRecord($result['tp_record']);
		$this->setOmbActief($result['omb_actief']);
		$this->setOmbBron($result['omb_bron']);
		$this->setLogin($result['login']);
		$this->setPaswoord($result['paswoord']);
		$this->setPwdRecovery($result['pwd_recovery']);
		$this->setGeheimeVraag($result['geheime_vraag']);
		$this->setGeheimAntwoord($result['geheim_antwoord']);
		$this->setIpadres($result['ipadres']);
		$this->setLogindatum($result['logindatum']);
		$this->setValidatiestatus($result['validatiestatus']);
		$this->setAanvraagdatum($result['aanvraagdatum']);
		$this->setValidatiedatum($result['validatiedatum']);
		$this->setWeigerdatum($result['weigerdatum']);
		$this->setToegewezenGenre($result['toegewezen_genre']);
		$this->setToegewezenId($result['toegewezen_id']);
		$this->setMenos($result['menos']);
		$this->setToestemmingZh($result['toestemming_zh']);
		$this->setZorgtrajectDiabetes($result['zorgtraject_diabetes']);
		$this->setZorgtrajectNieren($result['zorgtraject_nieren']);
		$this->setZorgtrajectDatum($result['zorgtraject_datum']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Patient
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
		$o=new Patient();
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
		$stmt->bindValue(2,$this->getCode());
		$stmt->bindValue(3,$this->getNaam());
		$stmt->bindValue(4,$this->getVoornaam());
		$stmt->bindValue(5,$this->getSex());
		$stmt->bindValue(6,$this->getGebdatum());
		$stmt->bindValue(7,$this->getGeboorteplaats());
		$stmt->bindValue(8,$this->getBurgstandId());
		$stmt->bindValue(9,$this->getNaamEchtg());
		$stmt->bindValue(10,$this->getVoornaamEchtg());
		$stmt->bindValue(11,$this->getAdres());
		$stmt->bindValue(12,$this->getGemId());
		$stmt->bindValue(13,$this->getTel());
		$stmt->bindValue(14,$this->getGsm());
		$stmt->bindValue(15,$this->getWoonsit());
		$stmt->bindValue(16,$this->getMantelz());
		$stmt->bindValue(17,$this->getAlarm());
		$stmt->bindValue(18,$this->getMutId());
		$stmt->bindValue(19,$this->getEmail());
		$stmt->bindValue(20,$this->getActief());
		$stmt->bindValue(21,$this->getType());
		$stmt->bindValue(22,$this->getMutnr());
		$stmt->bindValue(23,$this->getRijksregister());
		$stmt->bindValue(24,$this->getStartdatum());
		$stmt->bindValue(25,$this->getStopzettingText());
		$stmt->bindValue(26,$this->getStopzettingCat());
		$stmt->bindValue(27,$this->getEinddatum());
		$stmt->bindValue(28,$this->getMinimumSubsidiestatus());
		$stmt->bindValue(29,$this->getSubsidiestatus());
		$stmt->bindValue(30,$this->getTpRecord());
		$stmt->bindValue(31,$this->getOmbActief());
		$stmt->bindValue(32,$this->getOmbBron());
		$stmt->bindValue(33,$this->getLogin());
		$stmt->bindValue(34,$this->getPaswoord());
		$stmt->bindValue(35,$this->getPwdRecovery());
		$stmt->bindValue(36,$this->getGeheimeVraag());
		$stmt->bindValue(37,$this->getGeheimAntwoord());
		$stmt->bindValue(38,$this->getIpadres());
		$stmt->bindValue(39,$this->getLogindatum());
		$stmt->bindValue(40,$this->getValidatiestatus());
		$stmt->bindValue(41,$this->getAanvraagdatum());
		$stmt->bindValue(42,$this->getValidatiedatum());
		$stmt->bindValue(43,$this->getWeigerdatum());
		$stmt->bindValue(44,$this->getToegewezenGenre());
		$stmt->bindValue(45,$this->getToegewezenId());
		$stmt->bindValue(46,$this->getMenos());
		$stmt->bindValue(47,$this->getToestemmingZh());
		$stmt->bindValue(48,$this->getZorgtrajectDiabetes());
		$stmt->bindValue(49,$this->getZorgtrajectNieren());
		$stmt->bindValue(50,$this->getZorgtrajectDatum());
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
			$stmt->bindValue(1,$this->getCode());
			$stmt->bindValue(2,$this->getNaam());
			$stmt->bindValue(3,$this->getVoornaam());
			$stmt->bindValue(4,$this->getSex());
			$stmt->bindValue(5,$this->getGebdatum());
			$stmt->bindValue(6,$this->getGeboorteplaats());
			$stmt->bindValue(7,$this->getBurgstandId());
			$stmt->bindValue(8,$this->getNaamEchtg());
			$stmt->bindValue(9,$this->getVoornaamEchtg());
			$stmt->bindValue(10,$this->getAdres());
			$stmt->bindValue(11,$this->getGemId());
			$stmt->bindValue(12,$this->getTel());
			$stmt->bindValue(13,$this->getGsm());
			$stmt->bindValue(14,$this->getWoonsit());
			$stmt->bindValue(15,$this->getMantelz());
			$stmt->bindValue(16,$this->getAlarm());
			$stmt->bindValue(17,$this->getMutId());
			$stmt->bindValue(18,$this->getEmail());
			$stmt->bindValue(19,$this->getActief());
			$stmt->bindValue(20,$this->getType());
			$stmt->bindValue(21,$this->getMutnr());
			$stmt->bindValue(22,$this->getRijksregister());
			$stmt->bindValue(23,$this->getStartdatum());
			$stmt->bindValue(24,$this->getStopzettingText());
			$stmt->bindValue(25,$this->getStopzettingCat());
			$stmt->bindValue(26,$this->getEinddatum());
			$stmt->bindValue(27,$this->getMinimumSubsidiestatus());
			$stmt->bindValue(28,$this->getSubsidiestatus());
			$stmt->bindValue(29,$this->getTpRecord());
			$stmt->bindValue(30,$this->getOmbActief());
			$stmt->bindValue(31,$this->getOmbBron());
			$stmt->bindValue(32,$this->getLogin());
			$stmt->bindValue(33,$this->getPaswoord());
			$stmt->bindValue(34,$this->getPwdRecovery());
			$stmt->bindValue(35,$this->getGeheimeVraag());
			$stmt->bindValue(36,$this->getGeheimAntwoord());
			$stmt->bindValue(37,$this->getIpadres());
			$stmt->bindValue(38,$this->getLogindatum());
			$stmt->bindValue(39,$this->getValidatiestatus());
			$stmt->bindValue(40,$this->getAanvraagdatum());
			$stmt->bindValue(41,$this->getValidatiedatum());
			$stmt->bindValue(42,$this->getWeigerdatum());
			$stmt->bindValue(43,$this->getToegewezenGenre());
			$stmt->bindValue(44,$this->getToegewezenId());
			$stmt->bindValue(45,$this->getMenos());
			$stmt->bindValue(46,$this->getToestemmingZh());
			$stmt->bindValue(47,$this->getZorgtrajectDiabetes());
			$stmt->bindValue(48,$this->getZorgtrajectNieren());
			$stmt->bindValue(49,$this->getZorgtrajectDatum());
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
		$stmt->bindValue(51,$this->getId());
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
	 * Fetch AanvraagOverdracht's which this Patient references.
	 * `patient`.`code` -> `aanvraag_overdracht`.`patient`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return AanvraagOverdracht[]
	 */
	public function fetchAanvraagOverdrachtCollection(PDO $db, $sort=null) {
		$filter=array(AanvraagOverdracht::FIELD_PATIENT=>$this->getCode());
		return AanvraagOverdracht::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch AanvraagOverleg's which this Patient references.
	 * `patient`.`code` -> `aanvraag_overleg`.`patient_code`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return AanvraagOverleg[]
	 */
	public function fetchAanvraagOverlegCollection(PDO $db, $sort=null) {
		$filter=array(AanvraagOverleg::FIELD_PATIENT_CODE=>$this->getCode());
		return AanvraagOverleg::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Berichten's which this Patient references.
	 * `patient`.`code` -> `berichten`.`patient`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Berichten[]
	 */
	public function fetchBerichtenCollection(PDO $db, $sort=null) {
		$filter=array(Berichten::FIELD_PATIENT=>$this->getCode());
		return Berichten::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Evaluatie's which this Patient references.
	 * `patient`.`code` -> `evaluatie`.`patient`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Evaluatie[]
	 */
	public function fetchEvaluatieCollection(PDO $db, $sort=null) {
		$filter=array(Evaluatie::FIELD_PATIENT=>$this->getCode());
		return Evaluatie::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch HuidigeBetrokkenen's which this Patient references.
	 * `patient`.`code` -> `huidige_betrokkenen`.`patient_code`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return HuidigeBetrokkenen[]
	 */
	public function fetchHuidigeBetrokkenenCollection(PDO $db, $sort=null) {
		$filter=array(HuidigeBetrokkenen::FIELD_PATIENT_CODE=>$this->getCode());
		return HuidigeBetrokkenen::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Overlegbasis's which this Patient references.
	 * `patient`.`code` -> `overlegbasis`.`patient_code`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegbasis[]
	 */
	public function fetchOverlegbasisCollection(PDO $db, $sort=null) {
		$filter=array(Overlegbasis::FIELD_PATIENT_CODE=>$this->getCode());
		return Overlegbasis::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch PatientMenos's which this Patient references.
	 * `patient`.`code` -> `patient_menos`.`patient`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return PatientMenos[]
	 */
	public function fetchPatientMenosCollection(PDO $db, $sort=null) {
		$filter=array(PatientMenos::FIELD_PATIENT=>$this->getCode());
		return PatientMenos::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch PatientPsy's which this Patient references.
	 * `patient`.`code` -> `patient_psy`.`code`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return PatientPsy[]
	 */
	public function fetchPatientPsyCollection(PDO $db, $sort=null) {
		$filter=array(PatientPsy::FIELD_CODE=>$this->getCode());
		return PatientPsy::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch PatientSecundair's which this Patient references.
	 * `patient`.`code` -> `patient_secundair`.`patient`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return PatientSecundair[]
	 */
	public function fetchPatientSecundairCollection(PDO $db, $sort=null) {
		$filter=array(PatientSecundair::FIELD_PATIENT=>$this->getCode());
		return PatientSecundair::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch PatientTp's which this Patient references.
	 * `patient`.`code` -> `patient_tp`.`patient`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return PatientTp[]
	 */
	public function fetchPatientTpCollection(PDO $db, $sort=null) {
		$filter=array(PatientTp::FIELD_PATIENT=>$this->getCode());
		return PatientTp::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Burgstaat which references this Patient. Will return null in case reference is invalid.
	 * `patient`.`burgstand_id` -> `burgstaat`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Burgstaat
	 */
	public function fetchBurgstaat(PDO $db, $sort=null) {
		$filter=array(Burgstaat::FIELD_ID=>$this->getBurgstandId());
		$result=Burgstaat::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Gemeente which references this Patient. Will return null in case reference is invalid.
	 * `patient`.`gem_id` -> `gemeente`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Gemeente
	 */
	public function fetchGemeente(PDO $db, $sort=null) {
		$filter=array(Gemeente::FIELD_ID=>$this->getGemId());
		$result=Gemeente::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Verzekering which references this Patient. Will return null in case reference is invalid.
	 * `patient`.`mut_id` -> `verzekering`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Verzekering
	 */
	public function fetchVerzekering(PDO $db, $sort=null) {
		$filter=array(Verzekering::FIELD_ID=>$this->getMutId());
		$result=Verzekering::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'Patient');
	}

	/**
	 * get single Patient instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Patient
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Patient();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Patient from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Patient[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Patient') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>