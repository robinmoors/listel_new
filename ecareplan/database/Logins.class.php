<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Logins extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Logins';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='logins';
	const SQL_INSERT='INSERT INTO `logins` (`id`,`voornaam`,`naam`,`profiel`,`organisatie`,`adres`,`gem_id`,`tel`,`fax`,`gsm`,`email`,`tp_project`,`sit_id`,`overleg_gemeente`,`login`,`paswoord`,`pwd_recovery`,`ipadres`,`logindatum`,`actief`,`loginpin`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `logins` (`voornaam`,`naam`,`profiel`,`organisatie`,`adres`,`gem_id`,`tel`,`fax`,`gsm`,`email`,`tp_project`,`sit_id`,`overleg_gemeente`,`login`,`paswoord`,`pwd_recovery`,`ipadres`,`logindatum`,`actief`,`loginpin`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `logins` SET `id`=?,`voornaam`=?,`naam`=?,`profiel`=?,`organisatie`=?,`adres`=?,`gem_id`=?,`tel`=?,`fax`=?,`gsm`=?,`email`=?,`tp_project`=?,`sit_id`=?,`overleg_gemeente`=?,`login`=?,`paswoord`=?,`pwd_recovery`=?,`ipadres`=?,`logindatum`=?,`actief`=?,`loginpin`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `logins` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `logins` WHERE `id`=?';
	const FIELD_ID=-1718414497;
	const FIELD_VOORNAAM=-413105985;
	const FIELD_NAAM=-2128740765;
	const FIELD_PROFIEL=150523155;
	const FIELD_ORGANISATIE=-397735866;
	const FIELD_ADRES=-1578354471;
	const FIELD_GEM_ID=-1511804849;
	const FIELD_TEL=-1731231145;
	const FIELD_FAX=-1731244711;
	const FIELD_GSM=-1731243203;
	const FIELD_EMAIL=-1574408488;
	const FIELD_TP_PROJECT=1555187354;
	const FIELD_SIT_ID=-1164352416;
	const FIELD_OVERLEG_GEMEENTE=564126201;
	const FIELD_LOGIN=-1567878491;
	const FIELD_PASWOORD=-1701005077;
	const FIELD_PWD_RECOVERY=-1119988837;
	const FIELD_IPADRES=-1837273838;
	const FIELD_LOGINDATUM=-345123606;
	const FIELD_ACTIEF=-1685208772;
	const FIELD_LOGINPIN=-898670384;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_VOORNAAM=>'voornaam',
		self::FIELD_NAAM=>'naam',
		self::FIELD_PROFIEL=>'profiel',
		self::FIELD_ORGANISATIE=>'organisatie',
		self::FIELD_ADRES=>'adres',
		self::FIELD_GEM_ID=>'gem_id',
		self::FIELD_TEL=>'tel',
		self::FIELD_FAX=>'fax',
		self::FIELD_GSM=>'gsm',
		self::FIELD_EMAIL=>'email',
		self::FIELD_TP_PROJECT=>'tp_project',
		self::FIELD_SIT_ID=>'sit_id',
		self::FIELD_OVERLEG_GEMEENTE=>'overleg_gemeente',
		self::FIELD_LOGIN=>'login',
		self::FIELD_PASWOORD=>'paswoord',
		self::FIELD_PWD_RECOVERY=>'pwd_recovery',
		self::FIELD_IPADRES=>'ipadres',
		self::FIELD_LOGINDATUM=>'logindatum',
		self::FIELD_ACTIEF=>'actief',
		self::FIELD_LOGINPIN=>'loginpin');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_VOORNAAM=>'voornaam',
		self::FIELD_NAAM=>'naam',
		self::FIELD_PROFIEL=>'profiel',
		self::FIELD_ORGANISATIE=>'organisatie',
		self::FIELD_ADRES=>'adres',
		self::FIELD_GEM_ID=>'gemId',
		self::FIELD_TEL=>'tel',
		self::FIELD_FAX=>'fax',
		self::FIELD_GSM=>'gsm',
		self::FIELD_EMAIL=>'email',
		self::FIELD_TP_PROJECT=>'tpProject',
		self::FIELD_SIT_ID=>'sitId',
		self::FIELD_OVERLEG_GEMEENTE=>'overlegGemeente',
		self::FIELD_LOGIN=>'login',
		self::FIELD_PASWOORD=>'paswoord',
		self::FIELD_PWD_RECOVERY=>'pwdRecovery',
		self::FIELD_IPADRES=>'ipadres',
		self::FIELD_LOGINDATUM=>'logindatum',
		self::FIELD_ACTIEF=>'actief',
		self::FIELD_LOGINPIN=>'loginpin');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_VOORNAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_NAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PROFIEL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ORGANISATIE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_ADRES=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GEM_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TEL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FAX=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GSM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EMAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TP_PROJECT=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_SIT_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_OVERLEG_GEMEENTE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_LOGIN=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PASWOORD=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PWD_RECOVERY=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_IPADRES=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_LOGINDATUM=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_ACTIEF=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_LOGINPIN=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_VOORNAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,25,0,false),
		self::FIELD_NAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,25,0,false),
		self::FIELD_PROFIEL=>array(Db2PhpEntity::JDBC_TYPE_CHAR,17,0,false),
		self::FIELD_ORGANISATIE=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_ADRES=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,false),
		self::FIELD_GEM_ID=>array(Db2PhpEntity::JDBC_TYPE_SMALLINT,5,0,false),
		self::FIELD_TEL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,12,0,false),
		self::FIELD_FAX=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,12,0,false),
		self::FIELD_GSM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,12,0,false),
		self::FIELD_EMAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,false),
		self::FIELD_TP_PROJECT=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_SIT_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_OVERLEG_GEMEENTE=>array(Db2PhpEntity::JDBC_TYPE_SMALLINT,5,0,true),
		self::FIELD_LOGIN=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,false),
		self::FIELD_PASWOORD=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,false),
		self::FIELD_PWD_RECOVERY=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,false),
		self::FIELD_IPADRES=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,false),
		self::FIELD_LOGINDATUM=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_ACTIEF=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_LOGINPIN=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_VOORNAAM=>'',
		self::FIELD_NAAM=>'',
		self::FIELD_PROFIEL=>'OC',
		self::FIELD_ORGANISATIE=>null,
		self::FIELD_ADRES=>'',
		self::FIELD_GEM_ID=>9999,
		self::FIELD_TEL=>'',
		self::FIELD_FAX=>'',
		self::FIELD_GSM=>'',
		self::FIELD_EMAIL=>'',
		self::FIELD_TP_PROJECT=>null,
		self::FIELD_SIT_ID=>null,
		self::FIELD_OVERLEG_GEMEENTE=>null,
		self::FIELD_LOGIN=>'',
		self::FIELD_PASWOORD=>'',
		self::FIELD_PWD_RECOVERY=>'',
		self::FIELD_IPADRES=>'',
		self::FIELD_LOGINDATUM=>0,
		self::FIELD_ACTIEF=>1,
		self::FIELD_LOGINPIN=>null);
	private $id;
	private $voornaam;
	private $naam;
	private $profiel;
	private $organisatie;
	private $adres;
	private $gemId;
	private $tel;
	private $fax;
	private $gsm;
	private $email;
	private $tpProject;
	private $sitId;
	private $overlegGemeente;
	private $login;
	private $paswoord;
	private $pwdRecovery;
	private $ipadres;
	private $logindatum;
	private $actief;
	private $loginpin;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return Logins
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
	 * set value for voornaam 
	 *
	 * type:VARCHAR,size:25,default:,index
	 *
	 * @param mixed $voornaam
	 * @return Logins
	 */
	public function &setVoornaam($voornaam) {
		$this->notifyChanged(self::FIELD_VOORNAAM,$this->voornaam,$voornaam);
		$this->voornaam=$voornaam;
		return $this;
	}

	/**
	 * get value for voornaam 
	 *
	 * type:VARCHAR,size:25,default:,index
	 *
	 * @return mixed
	 */
	public function getVoornaam() {
		return $this->voornaam;
	}

	/**
	 * set value for naam 
	 *
	 * type:VARCHAR,size:25,default:,index
	 *
	 * @param mixed $naam
	 * @return Logins
	 */
	public function &setNaam($naam) {
		$this->notifyChanged(self::FIELD_NAAM,$this->naam,$naam);
		$this->naam=$naam;
		return $this;
	}

	/**
	 * get value for naam 
	 *
	 * type:VARCHAR,size:25,default:,index
	 *
	 * @return mixed
	 */
	public function getNaam() {
		return $this->naam;
	}

	/**
	 * set value for profiel 
	 *
	 * type:ENUM,size:17,default:OC
	 *
	 * @param mixed $profiel
	 * @return Logins
	 */
	public function &setProfiel($profiel) {
		$this->notifyChanged(self::FIELD_PROFIEL,$this->profiel,$profiel);
		$this->profiel=$profiel;
		return $this;
	}

	/**
	 * get value for profiel 
	 *
	 * type:ENUM,size:17,default:OC
	 *
	 * @return mixed
	 */
	public function getProfiel() {
		return $this->profiel;
	}

	/**
	 * set value for organisatie 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $organisatie
	 * @return Logins
	 */
	public function &setOrganisatie($organisatie) {
		$this->notifyChanged(self::FIELD_ORGANISATIE,$this->organisatie,$organisatie);
		$this->organisatie=$organisatie;
		return $this;
	}

	/**
	 * get value for organisatie 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getOrganisatie() {
		return $this->organisatie;
	}

	/**
	 * set value for adres 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @param mixed $adres
	 * @return Logins
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
	 * type:SMALLINT,size:5,default:9999
	 *
	 * @param mixed $gemId
	 * @return Logins
	 */
	public function &setGemId($gemId) {
		$this->notifyChanged(self::FIELD_GEM_ID,$this->gemId,$gemId);
		$this->gemId=$gemId;
		return $this;
	}

	/**
	 * get value for gem_id 
	 *
	 * type:SMALLINT,size:5,default:9999
	 *
	 * @return mixed
	 */
	public function getGemId() {
		return $this->gemId;
	}

	/**
	 * set value for tel 
	 *
	 * type:VARCHAR,size:12,default:
	 *
	 * @param mixed $tel
	 * @return Logins
	 */
	public function &setTel($tel) {
		$this->notifyChanged(self::FIELD_TEL,$this->tel,$tel);
		$this->tel=$tel;
		return $this;
	}

	/**
	 * get value for tel 
	 *
	 * type:VARCHAR,size:12,default:
	 *
	 * @return mixed
	 */
	public function getTel() {
		return $this->tel;
	}

	/**
	 * set value for fax 
	 *
	 * type:VARCHAR,size:12,default:
	 *
	 * @param mixed $fax
	 * @return Logins
	 */
	public function &setFax($fax) {
		$this->notifyChanged(self::FIELD_FAX,$this->fax,$fax);
		$this->fax=$fax;
		return $this;
	}

	/**
	 * get value for fax 
	 *
	 * type:VARCHAR,size:12,default:
	 *
	 * @return mixed
	 */
	public function getFax() {
		return $this->fax;
	}

	/**
	 * set value for gsm 
	 *
	 * type:VARCHAR,size:12,default:
	 *
	 * @param mixed $gsm
	 * @return Logins
	 */
	public function &setGsm($gsm) {
		$this->notifyChanged(self::FIELD_GSM,$this->gsm,$gsm);
		$this->gsm=$gsm;
		return $this;
	}

	/**
	 * get value for gsm 
	 *
	 * type:VARCHAR,size:12,default:
	 *
	 * @return mixed
	 */
	public function getGsm() {
		return $this->gsm;
	}

	/**
	 * set value for email 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @param mixed $email
	 * @return Logins
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
	 * set value for tp_project 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $tpProject
	 * @return Logins
	 */
	public function &setTpProject($tpProject) {
		$this->notifyChanged(self::FIELD_TP_PROJECT,$this->tpProject,$tpProject);
		$this->tpProject=$tpProject;
		return $this;
	}

	/**
	 * get value for tp_project 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getTpProject() {
		return $this->tpProject;
	}

	/**
	 * set value for sit_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $sitId
	 * @return Logins
	 */
	public function &setSitId($sitId) {
		$this->notifyChanged(self::FIELD_SIT_ID,$this->sitId,$sitId);
		$this->sitId=$sitId;
		return $this;
	}

	/**
	 * get value for sit_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getSitId() {
		return $this->sitId;
	}

	/**
	 * set value for overleg_gemeente 
	 *
	 * type:SMALLINT,size:5,default:null,index,nullable
	 *
	 * @param mixed $overlegGemeente
	 * @return Logins
	 */
	public function &setOverlegGemeente($overlegGemeente) {
		$this->notifyChanged(self::FIELD_OVERLEG_GEMEENTE,$this->overlegGemeente,$overlegGemeente);
		$this->overlegGemeente=$overlegGemeente;
		return $this;
	}

	/**
	 * get value for overleg_gemeente 
	 *
	 * type:SMALLINT,size:5,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getOverlegGemeente() {
		return $this->overlegGemeente;
	}

	/**
	 * set value for login 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @param mixed $login
	 * @return Logins
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
	 * @return Logins
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
	 * type:VARCHAR,size:40,default:null
	 *
	 * @param mixed $pwdRecovery
	 * @return Logins
	 */
	public function &setPwdRecovery($pwdRecovery) {
		$this->notifyChanged(self::FIELD_PWD_RECOVERY,$this->pwdRecovery,$pwdRecovery);
		$this->pwdRecovery=$pwdRecovery;
		return $this;
	}

	/**
	 * get value for pwd_recovery 
	 *
	 * type:VARCHAR,size:40,default:null
	 *
	 * @return mixed
	 */
	public function getPwdRecovery() {
		return $this->pwdRecovery;
	}

	/**
	 * set value for ipadres 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @param mixed $ipadres
	 * @return Logins
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
	 * @return Logins
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
	 * set value for actief 
	 *
	 * type:INT,size:10,default:1
	 *
	 * @param mixed $actief
	 * @return Logins
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
	 * set value for loginpin 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $loginpin
	 * @return Logins
	 */
	public function &setLoginpin($loginpin) {
		$this->notifyChanged(self::FIELD_LOGINPIN,$this->loginpin,$loginpin);
		$this->loginpin=$loginpin;
		return $this;
	}

	/**
	 * get value for loginpin 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getLoginpin() {
		return $this->loginpin;
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
			self::FIELD_VOORNAAM=>$this->getVoornaam(),
			self::FIELD_NAAM=>$this->getNaam(),
			self::FIELD_PROFIEL=>$this->getProfiel(),
			self::FIELD_ORGANISATIE=>$this->getOrganisatie(),
			self::FIELD_ADRES=>$this->getAdres(),
			self::FIELD_GEM_ID=>$this->getGemId(),
			self::FIELD_TEL=>$this->getTel(),
			self::FIELD_FAX=>$this->getFax(),
			self::FIELD_GSM=>$this->getGsm(),
			self::FIELD_EMAIL=>$this->getEmail(),
			self::FIELD_TP_PROJECT=>$this->getTpProject(),
			self::FIELD_SIT_ID=>$this->getSitId(),
			self::FIELD_OVERLEG_GEMEENTE=>$this->getOverlegGemeente(),
			self::FIELD_LOGIN=>$this->getLogin(),
			self::FIELD_PASWOORD=>$this->getPaswoord(),
			self::FIELD_PWD_RECOVERY=>$this->getPwdRecovery(),
			self::FIELD_IPADRES=>$this->getIpadres(),
			self::FIELD_LOGINDATUM=>$this->getLogindatum(),
			self::FIELD_ACTIEF=>$this->getActief(),
			self::FIELD_LOGINPIN=>$this->getLoginpin());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Logins instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Logins $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Logins[]
	 */
	public static function findByExample(PDO $db,Logins $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Logins instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Logins[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `logins`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Logins instances
	 *
	 * @param PDOStatement $stmt
	 * @return Logins[]
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
	 * returns the result as an array of Logins instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Logins[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Logins();
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
	 * Execute select query and return matched rows as an array of Logins instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Logins[]
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
		$sql='DELETE FROM `logins`'
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
		$this->setVoornaam($result['voornaam']);
		$this->setNaam($result['naam']);
		$this->setProfiel($result['profiel']);
		$this->setOrganisatie($result['organisatie']);
		$this->setAdres($result['adres']);
		$this->setGemId($result['gem_id']);
		$this->setTel($result['tel']);
		$this->setFax($result['fax']);
		$this->setGsm($result['gsm']);
		$this->setEmail($result['email']);
		$this->setTpProject($result['tp_project']);
		$this->setSitId($result['sit_id']);
		$this->setOverlegGemeente($result['overleg_gemeente']);
		$this->setLogin($result['login']);
		$this->setPaswoord($result['paswoord']);
		$this->setPwdRecovery($result['pwd_recovery']);
		$this->setIpadres($result['ipadres']);
		$this->setLogindatum($result['logindatum']);
		$this->setActief($result['actief']);
		$this->setLoginpin($result['loginpin']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Logins
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
		$o=new Logins();
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
		$stmt->bindValue(2,$this->getVoornaam());
		$stmt->bindValue(3,$this->getNaam());
		$stmt->bindValue(4,$this->getProfiel());
		$stmt->bindValue(5,$this->getOrganisatie());
		$stmt->bindValue(6,$this->getAdres());
		$stmt->bindValue(7,$this->getGemId());
		$stmt->bindValue(8,$this->getTel());
		$stmt->bindValue(9,$this->getFax());
		$stmt->bindValue(10,$this->getGsm());
		$stmt->bindValue(11,$this->getEmail());
		$stmt->bindValue(12,$this->getTpProject());
		$stmt->bindValue(13,$this->getSitId());
		$stmt->bindValue(14,$this->getOverlegGemeente());
		$stmt->bindValue(15,$this->getLogin());
		$stmt->bindValue(16,$this->getPaswoord());
		$stmt->bindValue(17,$this->getPwdRecovery());
		$stmt->bindValue(18,$this->getIpadres());
		$stmt->bindValue(19,$this->getLogindatum());
		$stmt->bindValue(20,$this->getActief());
		$stmt->bindValue(21,$this->getLoginpin());
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
			$stmt->bindValue(1,$this->getVoornaam());
			$stmt->bindValue(2,$this->getNaam());
			$stmt->bindValue(3,$this->getProfiel());
			$stmt->bindValue(4,$this->getOrganisatie());
			$stmt->bindValue(5,$this->getAdres());
			$stmt->bindValue(6,$this->getGemId());
			$stmt->bindValue(7,$this->getTel());
			$stmt->bindValue(8,$this->getFax());
			$stmt->bindValue(9,$this->getGsm());
			$stmt->bindValue(10,$this->getEmail());
			$stmt->bindValue(11,$this->getTpProject());
			$stmt->bindValue(12,$this->getSitId());
			$stmt->bindValue(13,$this->getOverlegGemeente());
			$stmt->bindValue(14,$this->getLogin());
			$stmt->bindValue(15,$this->getPaswoord());
			$stmt->bindValue(16,$this->getPwdRecovery());
			$stmt->bindValue(17,$this->getIpadres());
			$stmt->bindValue(18,$this->getLogindatum());
			$stmt->bindValue(19,$this->getActief());
			$stmt->bindValue(20,$this->getLoginpin());
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
	 * Fetch LogsZiekenhuis's which this Logins references.
	 * `logins`.`id` -> `logs_ziekenhuis`.`login`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return LogsZiekenhuis[]
	 */
	public function fetchLogsZiekenhuisCollection(PDO $db, $sort=null) {
		$filter=array(LogsZiekenhuis::FIELD_LOGIN=>$this->getId());
		return LogsZiekenhuis::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch OmbRegistratie's which this Logins references.
	 * `logins`.`id` -> `omb_registratie`.`auteur`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return OmbRegistratie[]
	 */
	public function fetchOmbRegistratieCollection(PDO $db, $sort=null) {
		$filter=array(OmbRegistratie::FIELD_AUTEUR=>$this->getId());
		return OmbRegistratie::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Overlegbasis's which this Logins references.
	 * `logins`.`id` -> `overlegbasis`.`coordinator_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegbasis[]
	 */
	public function fetchOverlegbasisCollection(PDO $db, $sort=null) {
		$filter=array(Overlegbasis::FIELD_COORDINATOR_ID=>$this->getId());
		return Overlegbasis::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Organisatie which references this Logins. Will return null in case reference is invalid.
	 * `logins`.`organisatie` -> `organisatie`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Organisatie
	 */
	public function fetchOrganisatie(PDO $db, $sort=null) {
		$filter=array(Organisatie::FIELD_ID=>$this->getOrganisatie());
		$result=Organisatie::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch TpProject which references this Logins. Will return null in case reference is invalid.
	 * `logins`.`tp_project` -> `tp_project`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return TpProject
	 */
	public function fetchTpProject(PDO $db, $sort=null) {
		$filter=array(TpProject::FIELD_ID=>$this->getTpProject());
		$result=TpProject::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Sit which references this Logins. Will return null in case reference is invalid.
	 * `logins`.`sit_id` -> `sit`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Sit
	 */
	public function fetchSit(PDO $db, $sort=null) {
		$filter=array(Sit::FIELD_ID=>$this->getSitId());
		$result=Sit::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Gemeente which references this Logins. Will return null in case reference is invalid.
	 * `logins`.`overleg_gemeente` -> `gemeente`.`zip`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Gemeente
	 */
	public function fetchGemeente(PDO $db, $sort=null) {
		$filter=array(Gemeente::FIELD_ZIP=>$this->getOverlegGemeente());
		$result=Gemeente::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'Logins');
	}

	/**
	 * get single Logins instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Logins
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Logins();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Logins from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Logins[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Logins') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>