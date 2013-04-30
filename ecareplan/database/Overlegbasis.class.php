<?php

include_once 'util/Db2PhpEntityBase.class.php';
include_once 'util/Db2PhpEntityModificationTracking.class.php';
include_once 'util/DSC.class.php';
/**
 * 
 *
 * @version 1.107
 * @package entity
 */
abstract class Overlegbasis extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Overlegbasis';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='overlegbasis';
	const SQL_INSERT='INSERT INTO `overlegbasis` (`id`,`patient_code`,`datum`,`locatie`,`soort_problematiek`,`keuze_vergoeding`,`geld_voor_hvl`,`afgerond`,`controle`,`logincode`,`genre`,`factuur_datum`,`toegewezen_genre`,`contact_hvl`,`contact_mz`,`katz_id`,`evalinstr_id`,`coordinator_id`,`factuur_code`,`omb_id`,`toegewezen_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `overlegbasis` (`patient_code`,`datum`,`locatie`,`soort_problematiek`,`keuze_vergoeding`,`geld_voor_hvl`,`afgerond`,`controle`,`logincode`,`genre`,`factuur_datum`,`toegewezen_genre`,`contact_hvl`,`contact_mz`,`katz_id`,`evalinstr_id`,`coordinator_id`,`factuur_code`,`omb_id`,`toegewezen_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `overlegbasis` SET `id`=?,`patient_code`=?,`datum`=?,`locatie`=?,`soort_problematiek`=?,`keuze_vergoeding`=?,`geld_voor_hvl`=?,`afgerond`=?,`controle`=?,`logincode`=?,`genre`=?,`factuur_datum`=?,`toegewezen_genre`=?,`contact_hvl`=?,`contact_mz`=?,`katz_id`=?,`evalinstr_id`=?,`coordinator_id`=?,`factuur_code`=?,`omb_id`=?,`toegewezen_id`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `overlegbasis` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `overlegbasis` WHERE `id`=?';
	const FIELD_ID=198344581;
	const FIELD_PATIENT_CODE=930516177;
	const FIELD_DATUM=-996178491;
	const FIELD_LOCATIE=-655205467;
	const FIELD_SOORT_PROBLEMATIEK=-230440495;
	const FIELD_KEUZE_VERGOEDING=800222715;
	const FIELD_GELD_VOOR_HVL=-537200806;
	const FIELD_AFGEROND=-107018784;
	const FIELD_CONTROLE=-1304510062;
	const FIELD_LOGINCODE=1186112300;
	const FIELD_GENRE=-993294631;
	const FIELD_FACTUUR_DATUM=-1277200852;
	const FIELD_TOEGEWEZEN_GENRE=-978834917;
	const FIELD_CONTACT_HVL=-39092907;
	const FIELD_CONTACT_MZ=-1260906;
	const FIELD_KATZ_ID=-1927092812;
	const FIELD_EVALINSTR_ID=1408197076;
	const FIELD_COORDINATOR_ID=443436020;
	const FIELD_FACTUUR_CODE=-41216880;
	const FIELD_OMB_ID=-491316640;
	const FIELD_TOEGEWEZEN_ID=-155159677;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_PATIENT_CODE=>'patient_code',
		self::FIELD_DATUM=>'datum',
		self::FIELD_LOCATIE=>'locatie',
		self::FIELD_SOORT_PROBLEMATIEK=>'soort_problematiek',
		self::FIELD_KEUZE_VERGOEDING=>'keuze_vergoeding',
		self::FIELD_GELD_VOOR_HVL=>'geld_voor_hvl',
		self::FIELD_AFGEROND=>'afgerond',
		self::FIELD_CONTROLE=>'controle',
		self::FIELD_LOGINCODE=>'logincode',
		self::FIELD_GENRE=>'genre',
		self::FIELD_FACTUUR_DATUM=>'factuur_datum',
		self::FIELD_TOEGEWEZEN_GENRE=>'toegewezen_genre',
		self::FIELD_CONTACT_HVL=>'contact_hvl',
		self::FIELD_CONTACT_MZ=>'contact_mz',
		self::FIELD_KATZ_ID=>'katz_id',
		self::FIELD_EVALINSTR_ID=>'evalinstr_id',
		self::FIELD_COORDINATOR_ID=>'coordinator_id',
		self::FIELD_FACTUUR_CODE=>'factuur_code',
		self::FIELD_OMB_ID=>'omb_id',
		self::FIELD_TOEGEWEZEN_ID=>'toegewezen_id');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_PATIENT_CODE=>'patientCode',
		self::FIELD_DATUM=>'datum',
		self::FIELD_LOCATIE=>'locatie',
		self::FIELD_SOORT_PROBLEMATIEK=>'soortProblematiek',
		self::FIELD_KEUZE_VERGOEDING=>'keuzeVergoeding',
		self::FIELD_GELD_VOOR_HVL=>'geldVoorHvl',
		self::FIELD_AFGEROND=>'afgerond',
		self::FIELD_CONTROLE=>'controle',
		self::FIELD_LOGINCODE=>'logincode',
		self::FIELD_GENRE=>'genre',
		self::FIELD_FACTUUR_DATUM=>'factuurDatum',
		self::FIELD_TOEGEWEZEN_GENRE=>'toegewezenGenre',
		self::FIELD_CONTACT_HVL=>'contactHvl',
		self::FIELD_CONTACT_MZ=>'contactMz',
		self::FIELD_KATZ_ID=>'katzId',
		self::FIELD_EVALINSTR_ID=>'evalinstrId',
		self::FIELD_COORDINATOR_ID=>'coordinatorId',
		self::FIELD_FACTUUR_CODE=>'factuurCode',
		self::FIELD_OMB_ID=>'ombId',
		self::FIELD_TOEGEWEZEN_ID=>'toegewezenId');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_PATIENT_CODE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DATUM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_LOCATIE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SOORT_PROBLEMATIEK=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_KEUZE_VERGOEDING=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_GELD_VOOR_HVL=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_AFGEROND=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_CONTROLE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_LOGINCODE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FACTUUR_DATUM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TOEGEWEZEN_GENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CONTACT_HVL=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_CONTACT_MZ=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_KATZ_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EVALINSTR_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_COORDINATOR_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_FACTUUR_CODE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_OMB_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TOEGEWEZEN_ID=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_PATIENT_CODE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_DATUM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,10,0,false),
		self::FIELD_LOCATIE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,false),
		self::FIELD_SOORT_PROBLEMATIEK=>array(Db2PhpEntity::JDBC_TYPE_CHAR,9,0,false),
		self::FIELD_KEUZE_VERGOEDING=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_GELD_VOOR_HVL=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_AFGEROND=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_CONTROLE=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_LOGINCODE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,16,0,false),
		self::FIELD_GENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,6,0,true),
		self::FIELD_FACTUUR_DATUM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,14,0,true),
		self::FIELD_TOEGEWEZEN_GENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,9,0,false),
		self::FIELD_CONTACT_HVL=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_CONTACT_MZ=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_KATZ_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_EVALINSTR_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_COORDINATOR_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_FACTUUR_CODE=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_OMB_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_TOEGEWEZEN_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_PATIENT_CODE=>'',
		self::FIELD_DATUM=>'',
		self::FIELD_LOCATIE=>'',
		self::FIELD_SOORT_PROBLEMATIEK=>'fysisch',
		self::FIELD_KEUZE_VERGOEDING=>null,
		self::FIELD_GELD_VOOR_HVL=>0,
		self::FIELD_AFGEROND=>0,
		self::FIELD_CONTROLE=>0,
		self::FIELD_LOGINCODE=>'',
		self::FIELD_GENRE=>'gewoon',
		self::FIELD_FACTUUR_DATUM=>null,
		self::FIELD_TOEGEWEZEN_GENRE=>'gemeente',
		self::FIELD_CONTACT_HVL=>null,
		self::FIELD_CONTACT_MZ=>null,
		self::FIELD_KATZ_ID=>null,
		self::FIELD_EVALINSTR_ID=>null,
		self::FIELD_COORDINATOR_ID=>null,
		self::FIELD_FACTUUR_CODE=>null,
		self::FIELD_OMB_ID=>null,
		self::FIELD_TOEGEWEZEN_ID=>null);
	private $id;
	private $patientCode;
	private $datum;
	private $locatie;
	private $soortProblematiek;
	private $keuzeVergoeding;
	private $geldVoorHvl;
	private $afgerond;
	private $controle;
	private $logincode;
	private $genre;
	private $factuurDatum;
	private $toegewezenGenre;
	private $contactHvl;
	private $contactMz;
	private $katzId;
	private $evalinstrId;
	private $coordinatorId;
	private $factuurCode;
	private $ombId;
	private $toegewezenId;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return Overlegbasis
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
	 * set value for patient_code 
	 *
	 * type:VARCHAR,size:20,default:,index
	 *
	 * @param mixed $patientCode
	 * @return Overlegbasis
	 */
	public function &setPatientCode($patientCode) {
		$this->notifyChanged(self::FIELD_PATIENT_CODE,$this->patientCode,$patientCode);
		$this->patientCode=$patientCode;
		return $this;
	}

	/**
	 * get value for patient_code 
	 *
	 * type:VARCHAR,size:20,default:,index
	 *
	 * @return mixed
	 */
	public function getPatientCode() {
		return $this->patientCode;
	}

	/**
	 * set value for datum 
	 *
	 * type:VARCHAR,size:10,default:,index
	 *
	 * @param mixed $datum
	 * @return Overlegbasis
	 */
	public function &setDatum($datum) {
		$this->notifyChanged(self::FIELD_DATUM,$this->datum,$datum);
		$this->datum=$datum;
		return $this;
	}

	/**
	 * get value for datum 
	 *
	 * type:VARCHAR,size:10,default:,index
	 *
	 * @return mixed
	 */
	public function getDatum() {
		return $this->datum;
	}

	/**
	 * set value for locatie 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @param mixed $locatie
	 * @return Overlegbasis
	 */
	public function &setLocatie($locatie) {
		$this->notifyChanged(self::FIELD_LOCATIE,$this->locatie,$locatie);
		$this->locatie=$locatie;
		return $this;
	}

	/**
	 * get value for locatie 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @return mixed
	 */
	public function getLocatie() {
		return $this->locatie;
	}

	/**
	 * set value for soort_problematiek 
	 *
	 * type:ENUM,size:9,default:fysisch
	 *
	 * @param mixed $soortProblematiek
	 * @return Overlegbasis
	 */
	public function &setSoortProblematiek($soortProblematiek) {
		$this->notifyChanged(self::FIELD_SOORT_PROBLEMATIEK,$this->soortProblematiek,$soortProblematiek);
		$this->soortProblematiek=$soortProblematiek;
		return $this;
	}

	/**
	 * get value for soort_problematiek 
	 *
	 * type:ENUM,size:9,default:fysisch
	 *
	 * @return mixed
	 */
	public function getSoortProblematiek() {
		return $this->soortProblematiek;
	}

	/**
	 * set value for keuze_vergoeding 
	 *
	 * type:INT,size:10,default:-88
	 *
	 * @param mixed $keuzeVergoeding
	 * @return Overlegbasis
	 */
	public function &setKeuzeVergoeding($keuzeVergoeding) {
		$this->notifyChanged(self::FIELD_KEUZE_VERGOEDING,$this->keuzeVergoeding,$keuzeVergoeding);
		$this->keuzeVergoeding=$keuzeVergoeding;
		return $this;
	}

	/**
	 * get value for keuze_vergoeding 
	 *
	 * type:INT,size:10,default:-88
	 *
	 * @return mixed
	 */
	public function getKeuzeVergoeding() {
		return $this->keuzeVergoeding;
	}

	/**
	 * set value for geld_voor_hvl 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @param mixed $geldVoorHvl
	 * @return Overlegbasis
	 */
	public function &setGeldVoorHvl($geldVoorHvl) {
		$this->notifyChanged(self::FIELD_GELD_VOOR_HVL,$this->geldVoorHvl,$geldVoorHvl);
		$this->geldVoorHvl=$geldVoorHvl;
		return $this;
	}

	/**
	 * get value for geld_voor_hvl 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @return mixed
	 */
	public function getGeldVoorHvl() {
		return $this->geldVoorHvl;
	}

	/**
	 * set value for afgerond 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $afgerond
	 * @return Overlegbasis
	 */
	public function &setAfgerond($afgerond) {
		$this->notifyChanged(self::FIELD_AFGEROND,$this->afgerond,$afgerond);
		$this->afgerond=$afgerond;
		return $this;
	}

	/**
	 * get value for afgerond 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @return mixed
	 */
	public function getAfgerond() {
		return $this->afgerond;
	}

	/**
	 * set value for controle 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $controle
	 * @return Overlegbasis
	 */
	public function &setControle($controle) {
		$this->notifyChanged(self::FIELD_CONTROLE,$this->controle,$controle);
		$this->controle=$controle;
		return $this;
	}

	/**
	 * get value for controle 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getControle() {
		return $this->controle;
	}

	/**
	 * set value for logincode 
	 *
	 * type:VARCHAR,size:16,default:
	 *
	 * @param mixed $logincode
	 * @return Overlegbasis
	 */
	public function &setLogincode($logincode) {
		$this->notifyChanged(self::FIELD_LOGINCODE,$this->logincode,$logincode);
		$this->logincode=$logincode;
		return $this;
	}

	/**
	 * get value for logincode 
	 *
	 * type:VARCHAR,size:16,default:
	 *
	 * @return mixed
	 */
	public function getLogincode() {
		return $this->logincode;
	}

	/**
	 * set value for genre 
	 *
	 * type:ENUM,size:6,default:gewoon,index,nullable
	 *
	 * @param mixed $genre
	 * @return Overlegbasis
	 */
	public function &setGenre($genre) {
		$this->notifyChanged(self::FIELD_GENRE,$this->genre,$genre);
		$this->genre=$genre;
		return $this;
	}

	/**
	 * get value for genre 
	 *
	 * type:ENUM,size:6,default:gewoon,index,nullable
	 *
	 * @return mixed
	 */
	public function getGenre() {
		return $this->genre;
	}

	/**
	 * set value for factuur_datum 
	 *
	 * type:VARCHAR,size:14,default:null,nullable
	 *
	 * @param mixed $factuurDatum
	 * @return Overlegbasis
	 */
	public function &setFactuurDatum($factuurDatum) {
		$this->notifyChanged(self::FIELD_FACTUUR_DATUM,$this->factuurDatum,$factuurDatum);
		$this->factuurDatum=$factuurDatum;
		return $this;
	}

	/**
	 * get value for factuur_datum 
	 *
	 * type:VARCHAR,size:14,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getFactuurDatum() {
		return $this->factuurDatum;
	}

	/**
	 * set value for toegewezen_genre 
	 *
	 * type:ENUM,size:9,default:gemeente
	 *
	 * @param mixed $toegewezenGenre
	 * @return Overlegbasis
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
	 * set value for contact_hvl 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $contactHvl
	 * @return Overlegbasis
	 */
	public function &setContactHvl($contactHvl) {
		$this->notifyChanged(self::FIELD_CONTACT_HVL,$this->contactHvl,$contactHvl);
		$this->contactHvl=$contactHvl;
		return $this;
	}

	/**
	 * get value for contact_hvl 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getContactHvl() {
		return $this->contactHvl;
	}

	/**
	 * set value for contact_mz 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $contactMz
	 * @return Overlegbasis
	 */
	public function &setContactMz($contactMz) {
		$this->notifyChanged(self::FIELD_CONTACT_MZ,$this->contactMz,$contactMz);
		$this->contactMz=$contactMz;
		return $this;
	}

	/**
	 * get value for contact_mz 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getContactMz() {
		return $this->contactMz;
	}

	/**
	 * set value for katz_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $katzId
	 * @return Overlegbasis
	 */
	public function &setKatzId($katzId) {
		$this->notifyChanged(self::FIELD_KATZ_ID,$this->katzId,$katzId);
		$this->katzId=$katzId;
		return $this;
	}

	/**
	 * get value for katz_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getKatzId() {
		return $this->katzId;
	}

	/**
	 * set value for evalinstr_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $evalinstrId
	 * @return Overlegbasis
	 */
	public function &setEvalinstrId($evalinstrId) {
		$this->notifyChanged(self::FIELD_EVALINSTR_ID,$this->evalinstrId,$evalinstrId);
		$this->evalinstrId=$evalinstrId;
		return $this;
	}

	/**
	 * get value for evalinstr_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getEvalinstrId() {
		return $this->evalinstrId;
	}

	/**
	 * set value for coordinator_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $coordinatorId
	 * @return Overlegbasis
	 */
	public function &setCoordinatorId($coordinatorId) {
		$this->notifyChanged(self::FIELD_COORDINATOR_ID,$this->coordinatorId,$coordinatorId);
		$this->coordinatorId=$coordinatorId;
		return $this;
	}

	/**
	 * get value for coordinator_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getCoordinatorId() {
		return $this->coordinatorId;
	}

	/**
	 * set value for factuur_code 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $factuurCode
	 * @return Overlegbasis
	 */
	public function &setFactuurCode($factuurCode) {
		$this->notifyChanged(self::FIELD_FACTUUR_CODE,$this->factuurCode,$factuurCode);
		$this->factuurCode=$factuurCode;
		return $this;
	}

	/**
	 * get value for factuur_code 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getFactuurCode() {
		return $this->factuurCode;
	}

	/**
	 * set value for omb_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $ombId
	 * @return Overlegbasis
	 */
	public function &setOmbId($ombId) {
		$this->notifyChanged(self::FIELD_OMB_ID,$this->ombId,$ombId);
		$this->ombId=$ombId;
		return $this;
	}

	/**
	 * get value for omb_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getOmbId() {
		return $this->ombId;
	}

	/**
	 * set value for toegewezen_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $toegewezenId
	 * @return Overlegbasis
	 */
	public function &setToegewezenId($toegewezenId) {
		$this->notifyChanged(self::FIELD_TOEGEWEZEN_ID,$this->toegewezenId,$toegewezenId);
		$this->toegewezenId=$toegewezenId;
		return $this;
	}

	/**
	 * get value for toegewezen_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getToegewezenId() {
		return $this->toegewezenId;
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
			self::FIELD_PATIENT_CODE=>$this->getPatientCode(),
			self::FIELD_DATUM=>$this->getDatum(),
			self::FIELD_LOCATIE=>$this->getLocatie(),
			self::FIELD_SOORT_PROBLEMATIEK=>$this->getSoortProblematiek(),
			self::FIELD_KEUZE_VERGOEDING=>$this->getKeuzeVergoeding(),
			self::FIELD_GELD_VOOR_HVL=>$this->getGeldVoorHvl(),
			self::FIELD_AFGEROND=>$this->getAfgerond(),
			self::FIELD_CONTROLE=>$this->getControle(),
			self::FIELD_LOGINCODE=>$this->getLogincode(),
			self::FIELD_GENRE=>$this->getGenre(),
			self::FIELD_FACTUUR_DATUM=>$this->getFactuurDatum(),
			self::FIELD_TOEGEWEZEN_GENRE=>$this->getToegewezenGenre(),
			self::FIELD_CONTACT_HVL=>$this->getContactHvl(),
			self::FIELD_CONTACT_MZ=>$this->getContactMz(),
			self::FIELD_KATZ_ID=>$this->getKatzId(),
			self::FIELD_EVALINSTR_ID=>$this->getEvalinstrId(),
			self::FIELD_COORDINATOR_ID=>$this->getCoordinatorId(),
			self::FIELD_FACTUUR_CODE=>$this->getFactuurCode(),
			self::FIELD_OMB_ID=>$this->getOmbId(),
			self::FIELD_TOEGEWEZEN_ID=>$this->getToegewezenId());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Overlegbasis instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Overlegbasis $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Overlegbasis[]
	 */
	public static function findByExample(PDO $db,Overlegbasis $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Overlegbasis instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Overlegbasis[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `overlegbasis`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Overlegbasis instances
	 *
	 * @param PDOStatement $stmt
	 * @return Overlegbasis[]
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
	 * returns the result as an array of Overlegbasis instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Overlegbasis[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Overlegbasis();
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
	 * Execute select query and return matched rows as an array of Overlegbasis instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Overlegbasis[]
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
		$sql='DELETE FROM `overlegbasis`'
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
		$this->setPatientCode($result['patient_code']);
		$this->setDatum($result['datum']);
		$this->setLocatie($result['locatie']);
		$this->setSoortProblematiek($result['soort_problematiek']);
		$this->setKeuzeVergoeding($result['keuze_vergoeding']);
		$this->setGeldVoorHvl($result['geld_voor_hvl']);
		$this->setAfgerond($result['afgerond']);
		$this->setControle($result['controle']);
		$this->setLogincode($result['logincode']);
		$this->setGenre($result['genre']);
		$this->setFactuurDatum($result['factuur_datum']);
		$this->setToegewezenGenre($result['toegewezen_genre']);
		$this->setContactHvl($result['contact_hvl']);
		$this->setContactMz($result['contact_mz']);
		$this->setKatzId($result['katz_id']);
		$this->setEvalinstrId($result['evalinstr_id']);
		$this->setCoordinatorId($result['coordinator_id']);
		$this->setFactuurCode($result['factuur_code']);
		$this->setOmbId($result['omb_id']);
		$this->setToegewezenId($result['toegewezen_id']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Overlegbasis
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
		$o=new Overlegbasis();
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
		$stmt->bindValue(2,$this->getPatientCode());
		$stmt->bindValue(3,$this->getDatum());
		$stmt->bindValue(4,$this->getLocatie());
		$stmt->bindValue(5,$this->getSoortProblematiek());
		$stmt->bindValue(6,$this->getKeuzeVergoeding());
		$stmt->bindValue(7,$this->getGeldVoorHvl());
		$stmt->bindValue(8,$this->getAfgerond());
		$stmt->bindValue(9,$this->getControle());
		$stmt->bindValue(10,$this->getLogincode());
		$stmt->bindValue(11,$this->getGenre());
		$stmt->bindValue(12,$this->getFactuurDatum());
		$stmt->bindValue(13,$this->getToegewezenGenre());
		$stmt->bindValue(14,$this->getContactHvl());
		$stmt->bindValue(15,$this->getContactMz());
		$stmt->bindValue(16,$this->getKatzId());
		$stmt->bindValue(17,$this->getEvalinstrId());
		$stmt->bindValue(18,$this->getCoordinatorId());
		$stmt->bindValue(19,$this->getFactuurCode());
		$stmt->bindValue(20,$this->getOmbId());
		$stmt->bindValue(21,$this->getToegewezenId());
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
			$stmt->bindValue(1,$this->getPatientCode());
			$stmt->bindValue(2,$this->getDatum());
			$stmt->bindValue(3,$this->getLocatie());
			$stmt->bindValue(4,$this->getSoortProblematiek());
			$stmt->bindValue(5,$this->getKeuzeVergoeding());
			$stmt->bindValue(6,$this->getGeldVoorHvl());
			$stmt->bindValue(7,$this->getAfgerond());
			$stmt->bindValue(8,$this->getControle());
			$stmt->bindValue(9,$this->getLogincode());
			$stmt->bindValue(10,$this->getGenre());
			$stmt->bindValue(11,$this->getFactuurDatum());
			$stmt->bindValue(12,$this->getToegewezenGenre());
			$stmt->bindValue(13,$this->getContactHvl());
			$stmt->bindValue(14,$this->getContactMz());
			$stmt->bindValue(15,$this->getKatzId());
			$stmt->bindValue(16,$this->getEvalinstrId());
			$stmt->bindValue(17,$this->getCoordinatorId());
			$stmt->bindValue(18,$this->getFactuurCode());
			$stmt->bindValue(19,$this->getOmbId());
			$stmt->bindValue(20,$this->getToegewezenId());
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
		$stmt->bindValue(22,$this->getId());
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
	 * Fetch AanvraagOverleg's which this Overlegbasis references.
	 * `overlegbasis`.`id` -> `aanvraag_overleg`.`overleg_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return AanvraagOverleg[]
	 */
	public function fetchAanvraagOverlegCollection(PDO $db, $sort=null) {
		$filter=array(AanvraagOverleg::FIELD_OVERLEG_ID=>$this->getId());
		return AanvraagOverleg::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch AfgerondeBetrokkenen's which this Overlegbasis references.
	 * `overlegbasis`.`id` -> `afgeronde_betrokkenen`.`overleg_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return AfgerondeBetrokkenen[]
	 */
	public function fetchAfgerondeBetrokkenenCollection(PDO $db, $sort=null) {
		$filter=array(AfgerondeBetrokkenen::FIELD_OVERLEG_ID=>$this->getId());
		return AfgerondeBetrokkenen::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch KatzAanvraag's which this Overlegbasis references.
	 * `overlegbasis`.`id` -> `katz_aanvraag`.`overleg`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return KatzAanvraag[]
	 */
	public function fetchKatzAanvraagCollection(PDO $db, $sort=null) {
		$filter=array(KatzAanvraag::FIELD_OVERLEG=>$this->getId());
		return KatzAanvraag::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch OverlegFiles's which this Overlegbasis references.
	 * `overlegbasis`.`id` -> `overleg_files`.`overleg_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return OverlegFiles[]
	 */
	public function fetchOverlegFilesCollection(PDO $db, $sort=null) {
		$filter=array(OverlegFiles::FIELD_OVERLEG_ID=>$this->getId());
		return OverlegFiles::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Overlegextended's which this Overlegbasis references.
	 * `overlegbasis`.`id` -> `overlegextended`.`overleg_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegextended[]
	 */
	public function fetchOverlegextendedCollection(PDO $db, $sort=null) {
		$filter=array(Overlegextended::FIELD_OVERLEG_ID=>$this->getId());
		return Overlegextended::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Overleglok's which this Overlegbasis references.
	 * `overlegbasis`.`id` -> `overleglok`.`overleg_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overleglok[]
	 */
	public function fetchOverleglokCollection(PDO $db, $sort=null) {
		$filter=array(Overleglok::FIELD_OVERLEG_ID=>$this->getId());
		return Overleglok::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Overlegomb's which this Overlegbasis references.
	 * `overlegbasis`.`id` -> `overlegomb`.`overleg_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegomb[]
	 */
	public function fetchOverlegombCollection(PDO $db, $sort=null) {
		$filter=array(Overlegomb::FIELD_OVERLEG_ID=>$this->getId());
		return Overlegomb::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Overlegorg's which this Overlegbasis references.
	 * `overlegbasis`.`id` -> `overlegorg`.`overleg_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegorg[]
	 */
	public function fetchOverlegorgCollection(PDO $db, $sort=null) {
		$filter=array(Overlegorg::FIELD_OVERLEG_ID=>$this->getId());
		return Overlegorg::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Overlegpsy's which this Overlegbasis references.
	 * `overlegbasis`.`id` -> `overlegpsy`.`overleg_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegpsy[]
	 */
	public function fetchOverlegpsyCollection(PDO $db, $sort=null) {
		$filter=array(Overlegpsy::FIELD_OVERLEG_ID=>$this->getId());
		return Overlegpsy::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Overlegtp's which this Overlegbasis references.
	 * `overlegbasis`.`id` -> `overlegtp`.`overleg_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegtp[]
	 */
	public function fetchOverlegtpCollection(PDO $db, $sort=null) {
		$filter=array(Overlegtp::FIELD_OVERLEG_ID=>$this->getId());
		return Overlegtp::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch PsyCrisis's which this Overlegbasis references.
	 * `overlegbasis`.`id` -> `psy_crisis`.`overleg_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return PsyCrisis[]
	 */
	public function fetchPsyCrisisCollection(PDO $db, $sort=null) {
		$filter=array(PsyCrisis::FIELD_OVERLEG_ID=>$this->getId());
		return PsyCrisis::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch PsyPlan's which this Overlegbasis references.
	 * `overlegbasis`.`id` -> `psy_plan`.`overleg_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return PsyPlan[]
	 */
	public function fetchPsyPlanCollection(PDO $db, $sort=null) {
		$filter=array(PsyPlan::FIELD_OVERLEG_ID=>$this->getId());
		return PsyPlan::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Hulpverleners which references this Overlegbasis. Will return null in case reference is invalid.
	 * `overlegbasis`.`contact_hvl` -> `hulpverleners`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Hulpverleners
	 */
	public function fetchHulpverleners(PDO $db, $sort=null) {
		$filter=array(Hulpverleners::FIELD_ID=>$this->getContactHvl());
		$result=Hulpverleners::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Mantelzorgers which references this Overlegbasis. Will return null in case reference is invalid.
	 * `overlegbasis`.`contact_mz` -> `mantelzorgers`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Mantelzorgers
	 */
	public function fetchMantelzorgers(PDO $db, $sort=null) {
		$filter=array(Mantelzorgers::FIELD_ID=>$this->getContactMz());
		$result=Mantelzorgers::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Logins which references this Overlegbasis. Will return null in case reference is invalid.
	 * `overlegbasis`.`coordinator_id` -> `logins`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Logins
	 */
	public function fetchLogins(PDO $db, $sort=null) {
		$filter=array(Logins::FIELD_ID=>$this->getCoordinatorId());
		$result=Logins::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Evalinstr which references this Overlegbasis. Will return null in case reference is invalid.
	 * `overlegbasis`.`evalinstr_id` -> `evalinstr`.`ei_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Evalinstr
	 */
	public function fetchEvalinstr(PDO $db, $sort=null) {
		$filter=array(Evalinstr::FIELD_EI_ID=>$this->getEvalinstrId());
		$result=Evalinstr::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Factuurmaand which references this Overlegbasis. Will return null in case reference is invalid.
	 * `overlegbasis`.`factuur_code` -> `factuurmaand`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Factuurmaand
	 */
	public function fetchFactuurmaand(PDO $db, $sort=null) {
		$filter=array(Factuurmaand::FIELD_ID=>$this->getFactuurCode());
		$result=Factuurmaand::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Katz which references this Overlegbasis. Will return null in case reference is invalid.
	 * `overlegbasis`.`katz_id` -> `katz`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Katz
	 */
	public function fetchKatz(PDO $db, $sort=null) {
		$filter=array(Katz::FIELD_ID=>$this->getKatzId());
		$result=Katz::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch OmbRegistratie which references this Overlegbasis. Will return null in case reference is invalid.
	 * `overlegbasis`.`omb_id` -> `omb_registratie`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return OmbRegistratie
	 */
	public function fetchOmbRegistratie(PDO $db, $sort=null) {
		$filter=array(OmbRegistratie::FIELD_ID=>$this->getOmbId());
		$result=OmbRegistratie::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Patient which references this Overlegbasis. Will return null in case reference is invalid.
	 * `overlegbasis`.`patient_code` -> `patient`.`code`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Patient
	 */
	public function fetchPatient(PDO $db, $sort=null) {
		$filter=array(Patient::FIELD_CODE=>$this->getPatientCode());
		$result=Patient::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Hulpverleners1 which references this Overlegbasis. Will return null in case reference is invalid.
	 * `overlegbasis`.`toegewezen_id` -> `hulpverleners`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Hulpverleners1
	 */
	public function fetchHulpverleners1(PDO $db, $sort=null) {
		$filter=array(Hulpverleners1::FIELD_ID=>$this->getToegewezenId());
		$result=Hulpverleners1::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'Overlegbasis');
	}

	/**
	 * get single Overlegbasis instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Overlegbasis
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Overlegbasis();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Overlegbasis from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Overlegbasis[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Overlegbasis') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>