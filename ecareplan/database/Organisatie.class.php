<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Organisatie extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Organisatie';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='organisatie';
	const SQL_INSERT='INSERT INTO `organisatie` (`id`,`naam`,`adres`,`gem_id`,`tel`,`fax`,`gsm`,`reknr`,`iban`,`bic`,`contact_inhoudelijk`,`email_inhoudelijk`,`contact_administratie`,`email_administratie`,`actief`,`genre`,`hoofdzetel`,`ggz`,`art107`,`mobiele_equipe`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `organisatie` (`id`,`naam`,`adres`,`gem_id`,`tel`,`fax`,`gsm`,`reknr`,`iban`,`bic`,`contact_inhoudelijk`,`email_inhoudelijk`,`contact_administratie`,`email_administratie`,`actief`,`genre`,`hoofdzetel`,`ggz`,`art107`,`mobiele_equipe`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `organisatie` SET `id`=?,`naam`=?,`adres`=?,`gem_id`=?,`tel`=?,`fax`=?,`gsm`=?,`reknr`=?,`iban`=?,`bic`=?,`contact_inhoudelijk`=?,`email_inhoudelijk`=?,`contact_administratie`=?,`email_administratie`=?,`actief`=?,`genre`=?,`hoofdzetel`=?,`ggz`=?,`art107`=?,`mobiele_equipe`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `organisatie` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `organisatie` WHERE `id`=?';
	const FIELD_ID=-242171009;
	const FIELD_NAAM=-797956477;
	const FIELD_ADRES=1021252793;
	const FIELD_GEM_ID=1766609007;
	const FIELD_TEL=1082644023;
	const FIELD_FAX=1082630457;
	const FIELD_GSM=1082631965;
	const FIELD_REKNR=1036975992;
	const FIELD_IBAN=-798104470;
	const FIELD_BIC=1082626840;
	const FIELD_CONTACT_INHOUDELIJK=67621445;
	const FIELD_EMAIL_INHOUDELIJK=-1023379775;
	const FIELD_CONTACT_ADMINISTRATIE=2068989763;
	const FIELD_EMAIL_ADMINISTRATIE=1588837567;
	const FIELD_ACTIEF=1593205084;
	const FIELD_GENRE=1026820255;
	const FIELD_HOOFDZETEL=1252111406;
	const FIELD_GGZ=1082631606;
	const FIELD_ART107=1607002393;
	const FIELD_MOBIELE_EQUIPE=1129533315;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array();
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_NAAM=>'naam',
		self::FIELD_ADRES=>'adres',
		self::FIELD_GEM_ID=>'gem_id',
		self::FIELD_TEL=>'tel',
		self::FIELD_FAX=>'fax',
		self::FIELD_GSM=>'gsm',
		self::FIELD_REKNR=>'reknr',
		self::FIELD_IBAN=>'iban',
		self::FIELD_BIC=>'bic',
		self::FIELD_CONTACT_INHOUDELIJK=>'contact_inhoudelijk',
		self::FIELD_EMAIL_INHOUDELIJK=>'email_inhoudelijk',
		self::FIELD_CONTACT_ADMINISTRATIE=>'contact_administratie',
		self::FIELD_EMAIL_ADMINISTRATIE=>'email_administratie',
		self::FIELD_ACTIEF=>'actief',
		self::FIELD_GENRE=>'genre',
		self::FIELD_HOOFDZETEL=>'hoofdzetel',
		self::FIELD_GGZ=>'ggz',
		self::FIELD_ART107=>'art107',
		self::FIELD_MOBIELE_EQUIPE=>'mobiele_equipe');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_NAAM=>'naam',
		self::FIELD_ADRES=>'adres',
		self::FIELD_GEM_ID=>'gemId',
		self::FIELD_TEL=>'tel',
		self::FIELD_FAX=>'fax',
		self::FIELD_GSM=>'gsm',
		self::FIELD_REKNR=>'reknr',
		self::FIELD_IBAN=>'iban',
		self::FIELD_BIC=>'bic',
		self::FIELD_CONTACT_INHOUDELIJK=>'contactInhoudelijk',
		self::FIELD_EMAIL_INHOUDELIJK=>'emailInhoudelijk',
		self::FIELD_CONTACT_ADMINISTRATIE=>'contactAdministratie',
		self::FIELD_EMAIL_ADMINISTRATIE=>'emailAdministratie',
		self::FIELD_ACTIEF=>'actief',
		self::FIELD_GENRE=>'genre',
		self::FIELD_HOOFDZETEL=>'hoofdzetel',
		self::FIELD_GGZ=>'ggz',
		self::FIELD_ART107=>'art107',
		self::FIELD_MOBIELE_EQUIPE=>'mobieleEquipe');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ADRES=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GEM_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TEL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FAX=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GSM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_REKNR=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_IBAN=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_BIC=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CONTACT_INHOUDELIJK=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EMAIL_INHOUDELIJK=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CONTACT_ADMINISTRATIE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EMAIL_ADMINISTRATIE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ACTIEF=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_GENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_HOOFDZETEL=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_GGZ=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_ART107=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MOBIELE_EQUIPE=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_NAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,150,0,false),
		self::FIELD_ADRES=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,75,0,false),
		self::FIELD_GEM_ID=>array(Db2PhpEntity::JDBC_TYPE_SMALLINT,5,0,false),
		self::FIELD_TEL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_FAX=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_GSM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_REKNR=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_IBAN=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,34,0,false),
		self::FIELD_BIC=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,11,0,false),
		self::FIELD_CONTACT_INHOUDELIJK=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,60,0,false),
		self::FIELD_EMAIL_INHOUDELIJK=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,80,0,false),
		self::FIELD_CONTACT_ADMINISTRATIE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,60,0,false),
		self::FIELD_EMAIL_ADMINISTRATIE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,80,0,false),
		self::FIELD_ACTIEF=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_GENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,5,0,true),
		self::FIELD_HOOFDZETEL=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_GGZ=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_ART107=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_MOBIELE_EQUIPE=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>0,
		self::FIELD_NAAM=>'',
		self::FIELD_ADRES=>'',
		self::FIELD_GEM_ID=>9999,
		self::FIELD_TEL=>'',
		self::FIELD_FAX=>'',
		self::FIELD_GSM=>'',
		self::FIELD_REKNR=>'',
		self::FIELD_IBAN=>'',
		self::FIELD_BIC=>'',
		self::FIELD_CONTACT_INHOUDELIJK=>'',
		self::FIELD_EMAIL_INHOUDELIJK=>'',
		self::FIELD_CONTACT_ADMINISTRATIE=>'',
		self::FIELD_EMAIL_ADMINISTRATIE=>'',
		self::FIELD_ACTIEF=>1,
		self::FIELD_GENRE=>null,
		self::FIELD_HOOFDZETEL=>null,
		self::FIELD_GGZ=>0,
		self::FIELD_ART107=>0,
		self::FIELD_MOBIELE_EQUIPE=>0);
	private $id;
	private $naam;
	private $adres;
	private $gemId;
	private $tel;
	private $fax;
	private $gsm;
	private $reknr;
	private $iban;
	private $bic;
	private $contactInhoudelijk;
	private $emailInhoudelijk;
	private $contactAdministratie;
	private $emailAdministratie;
	private $actief;
	private $genre;
	private $hoofdzetel;
	private $ggz;
	private $art107;
	private $mobieleEquipe;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique
	 *
	 * @param mixed $id
	 * @return Organisatie
	 */
	public function &setId($id) {
		$this->notifyChanged(self::FIELD_ID,$this->id,$id);
		$this->id=$id;
		return $this;
	}

	/**
	 * get value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique
	 *
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * set value for naam 
	 *
	 * type:VARCHAR,size:150,default:,index
	 *
	 * @param mixed $naam
	 * @return Organisatie
	 */
	public function &setNaam($naam) {
		$this->notifyChanged(self::FIELD_NAAM,$this->naam,$naam);
		$this->naam=$naam;
		return $this;
	}

	/**
	 * get value for naam 
	 *
	 * type:VARCHAR,size:150,default:,index
	 *
	 * @return mixed
	 */
	public function getNaam() {
		return $this->naam;
	}

	/**
	 * set value for adres 
	 *
	 * type:VARCHAR,size:75,default:
	 *
	 * @param mixed $adres
	 * @return Organisatie
	 */
	public function &setAdres($adres) {
		$this->notifyChanged(self::FIELD_ADRES,$this->adres,$adres);
		$this->adres=$adres;
		return $this;
	}

	/**
	 * get value for adres 
	 *
	 * type:VARCHAR,size:75,default:
	 *
	 * @return mixed
	 */
	public function getAdres() {
		return $this->adres;
	}

	/**
	 * set value for gem_id 
	 *
	 * type:SMALLINT,size:5,default:9999,index
	 *
	 * @param mixed $gemId
	 * @return Organisatie
	 */
	public function &setGemId($gemId) {
		$this->notifyChanged(self::FIELD_GEM_ID,$this->gemId,$gemId);
		$this->gemId=$gemId;
		return $this;
	}

	/**
	 * get value for gem_id 
	 *
	 * type:SMALLINT,size:5,default:9999,index
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
	 * @return Organisatie
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
	 * set value for fax 
	 *
	 * type:VARCHAR,size:20,default:
	 *
	 * @param mixed $fax
	 * @return Organisatie
	 */
	public function &setFax($fax) {
		$this->notifyChanged(self::FIELD_FAX,$this->fax,$fax);
		$this->fax=$fax;
		return $this;
	}

	/**
	 * get value for fax 
	 *
	 * type:VARCHAR,size:20,default:
	 *
	 * @return mixed
	 */
	public function getFax() {
		return $this->fax;
	}

	/**
	 * set value for gsm 
	 *
	 * type:VARCHAR,size:20,default:
	 *
	 * @param mixed $gsm
	 * @return Organisatie
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
	 * set value for reknr 
	 *
	 * type:VARCHAR,size:20,default:
	 *
	 * @param mixed $reknr
	 * @return Organisatie
	 */
	public function &setReknr($reknr) {
		$this->notifyChanged(self::FIELD_REKNR,$this->reknr,$reknr);
		$this->reknr=$reknr;
		return $this;
	}

	/**
	 * get value for reknr 
	 *
	 * type:VARCHAR,size:20,default:
	 *
	 * @return mixed
	 */
	public function getReknr() {
		return $this->reknr;
	}

	/**
	 * set value for iban 
	 *
	 * type:VARCHAR,size:34,default:
	 *
	 * @param mixed $iban
	 * @return Organisatie
	 */
	public function &setIban($iban) {
		$this->notifyChanged(self::FIELD_IBAN,$this->iban,$iban);
		$this->iban=$iban;
		return $this;
	}

	/**
	 * get value for iban 
	 *
	 * type:VARCHAR,size:34,default:
	 *
	 * @return mixed
	 */
	public function getIban() {
		return $this->iban;
	}

	/**
	 * set value for bic 
	 *
	 * type:VARCHAR,size:11,default:
	 *
	 * @param mixed $bic
	 * @return Organisatie
	 */
	public function &setBic($bic) {
		$this->notifyChanged(self::FIELD_BIC,$this->bic,$bic);
		$this->bic=$bic;
		return $this;
	}

	/**
	 * get value for bic 
	 *
	 * type:VARCHAR,size:11,default:
	 *
	 * @return mixed
	 */
	public function getBic() {
		return $this->bic;
	}

	/**
	 * set value for contact_inhoudelijk 
	 *
	 * type:VARCHAR,size:60,default:
	 *
	 * @param mixed $contactInhoudelijk
	 * @return Organisatie
	 */
	public function &setContactInhoudelijk($contactInhoudelijk) {
		$this->notifyChanged(self::FIELD_CONTACT_INHOUDELIJK,$this->contactInhoudelijk,$contactInhoudelijk);
		$this->contactInhoudelijk=$contactInhoudelijk;
		return $this;
	}

	/**
	 * get value for contact_inhoudelijk 
	 *
	 * type:VARCHAR,size:60,default:
	 *
	 * @return mixed
	 */
	public function getContactInhoudelijk() {
		return $this->contactInhoudelijk;
	}

	/**
	 * set value for email_inhoudelijk 
	 *
	 * type:VARCHAR,size:80,default:
	 *
	 * @param mixed $emailInhoudelijk
	 * @return Organisatie
	 */
	public function &setEmailInhoudelijk($emailInhoudelijk) {
		$this->notifyChanged(self::FIELD_EMAIL_INHOUDELIJK,$this->emailInhoudelijk,$emailInhoudelijk);
		$this->emailInhoudelijk=$emailInhoudelijk;
		return $this;
	}

	/**
	 * get value for email_inhoudelijk 
	 *
	 * type:VARCHAR,size:80,default:
	 *
	 * @return mixed
	 */
	public function getEmailInhoudelijk() {
		return $this->emailInhoudelijk;
	}

	/**
	 * set value for contact_administratie 
	 *
	 * type:VARCHAR,size:60,default:
	 *
	 * @param mixed $contactAdministratie
	 * @return Organisatie
	 */
	public function &setContactAdministratie($contactAdministratie) {
		$this->notifyChanged(self::FIELD_CONTACT_ADMINISTRATIE,$this->contactAdministratie,$contactAdministratie);
		$this->contactAdministratie=$contactAdministratie;
		return $this;
	}

	/**
	 * get value for contact_administratie 
	 *
	 * type:VARCHAR,size:60,default:
	 *
	 * @return mixed
	 */
	public function getContactAdministratie() {
		return $this->contactAdministratie;
	}

	/**
	 * set value for email_administratie 
	 *
	 * type:VARCHAR,size:80,default:
	 *
	 * @param mixed $emailAdministratie
	 * @return Organisatie
	 */
	public function &setEmailAdministratie($emailAdministratie) {
		$this->notifyChanged(self::FIELD_EMAIL_ADMINISTRATIE,$this->emailAdministratie,$emailAdministratie);
		$this->emailAdministratie=$emailAdministratie;
		return $this;
	}

	/**
	 * get value for email_administratie 
	 *
	 * type:VARCHAR,size:80,default:
	 *
	 * @return mixed
	 */
	public function getEmailAdministratie() {
		return $this->emailAdministratie;
	}

	/**
	 * set value for actief 
	 *
	 * type:INT,size:10,default:1
	 *
	 * @param mixed $actief
	 * @return Organisatie
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
	 * set value for genre 
	 *
	 * type:ENUM,size:5,default:null,nullable
	 *
	 * @param mixed $genre
	 * @return Organisatie
	 */
	public function &setGenre($genre) {
		$this->notifyChanged(self::FIELD_GENRE,$this->genre,$genre);
		$this->genre=$genre;
		return $this;
	}

	/**
	 * get value for genre 
	 *
	 * type:ENUM,size:5,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getGenre() {
		return $this->genre;
	}

	/**
	 * set value for hoofdzetel 
	 *
	 * type:INT,size:10,default:-1
	 *
	 * @param mixed $hoofdzetel
	 * @return Organisatie
	 */
	public function &setHoofdzetel($hoofdzetel) {
		$this->notifyChanged(self::FIELD_HOOFDZETEL,$this->hoofdzetel,$hoofdzetel);
		$this->hoofdzetel=$hoofdzetel;
		return $this;
	}

	/**
	 * get value for hoofdzetel 
	 *
	 * type:INT,size:10,default:-1
	 *
	 * @return mixed
	 */
	public function getHoofdzetel() {
		return $this->hoofdzetel;
	}

	/**
	 * set value for ggz 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @param mixed $ggz
	 * @return Organisatie
	 */
	public function &setGgz($ggz) {
		$this->notifyChanged(self::FIELD_GGZ,$this->ggz,$ggz);
		$this->ggz=$ggz;
		return $this;
	}

	/**
	 * get value for ggz 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @return mixed
	 */
	public function getGgz() {
		return $this->ggz;
	}

	/**
	 * set value for art107 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @param mixed $art107
	 * @return Organisatie
	 */
	public function &setArt107($art107) {
		$this->notifyChanged(self::FIELD_ART107,$this->art107,$art107);
		$this->art107=$art107;
		return $this;
	}

	/**
	 * get value for art107 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @return mixed
	 */
	public function getArt107() {
		return $this->art107;
	}

	/**
	 * set value for mobiele_equipe 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @param mixed $mobieleEquipe
	 * @return Organisatie
	 */
	public function &setMobieleEquipe($mobieleEquipe) {
		$this->notifyChanged(self::FIELD_MOBIELE_EQUIPE,$this->mobieleEquipe,$mobieleEquipe);
		$this->mobieleEquipe=$mobieleEquipe;
		return $this;
	}

	/**
	 * get value for mobiele_equipe 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @return mixed
	 */
	public function getMobieleEquipe() {
		return $this->mobieleEquipe;
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
			self::FIELD_NAAM=>$this->getNaam(),
			self::FIELD_ADRES=>$this->getAdres(),
			self::FIELD_GEM_ID=>$this->getGemId(),
			self::FIELD_TEL=>$this->getTel(),
			self::FIELD_FAX=>$this->getFax(),
			self::FIELD_GSM=>$this->getGsm(),
			self::FIELD_REKNR=>$this->getReknr(),
			self::FIELD_IBAN=>$this->getIban(),
			self::FIELD_BIC=>$this->getBic(),
			self::FIELD_CONTACT_INHOUDELIJK=>$this->getContactInhoudelijk(),
			self::FIELD_EMAIL_INHOUDELIJK=>$this->getEmailInhoudelijk(),
			self::FIELD_CONTACT_ADMINISTRATIE=>$this->getContactAdministratie(),
			self::FIELD_EMAIL_ADMINISTRATIE=>$this->getEmailAdministratie(),
			self::FIELD_ACTIEF=>$this->getActief(),
			self::FIELD_GENRE=>$this->getGenre(),
			self::FIELD_HOOFDZETEL=>$this->getHoofdzetel(),
			self::FIELD_GGZ=>$this->getGgz(),
			self::FIELD_ART107=>$this->getArt107(),
			self::FIELD_MOBIELE_EQUIPE=>$this->getMobieleEquipe());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Organisatie instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Organisatie $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Organisatie[]
	 */
	public static function findByExample(PDO $db,Organisatie $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Organisatie instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Organisatie[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `organisatie`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Organisatie instances
	 *
	 * @param PDOStatement $stmt
	 * @return Organisatie[]
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
	 * returns the result as an array of Organisatie instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Organisatie[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Organisatie();
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
	 * Execute select query and return matched rows as an array of Organisatie instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Organisatie[]
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
		$sql='DELETE FROM `organisatie`'
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
		$this->setNaam($result['naam']);
		$this->setAdres($result['adres']);
		$this->setGemId($result['gem_id']);
		$this->setTel($result['tel']);
		$this->setFax($result['fax']);
		$this->setGsm($result['gsm']);
		$this->setReknr($result['reknr']);
		$this->setIban($result['iban']);
		$this->setBic($result['bic']);
		$this->setContactInhoudelijk($result['contact_inhoudelijk']);
		$this->setEmailInhoudelijk($result['email_inhoudelijk']);
		$this->setContactAdministratie($result['contact_administratie']);
		$this->setEmailAdministratie($result['email_administratie']);
		$this->setActief($result['actief']);
		$this->setGenre($result['genre']);
		$this->setHoofdzetel($result['hoofdzetel']);
		$this->setGgz($result['ggz']);
		$this->setArt107($result['art107']);
		$this->setMobieleEquipe($result['mobiele_equipe']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Organisatie
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
		$o=new Organisatie();
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
		$stmt->bindValue(2,$this->getNaam());
		$stmt->bindValue(3,$this->getAdres());
		$stmt->bindValue(4,$this->getGemId());
		$stmt->bindValue(5,$this->getTel());
		$stmt->bindValue(6,$this->getFax());
		$stmt->bindValue(7,$this->getGsm());
		$stmt->bindValue(8,$this->getReknr());
		$stmt->bindValue(9,$this->getIban());
		$stmt->bindValue(10,$this->getBic());
		$stmt->bindValue(11,$this->getContactInhoudelijk());
		$stmt->bindValue(12,$this->getEmailInhoudelijk());
		$stmt->bindValue(13,$this->getContactAdministratie());
		$stmt->bindValue(14,$this->getEmailAdministratie());
		$stmt->bindValue(15,$this->getActief());
		$stmt->bindValue(16,$this->getGenre());
		$stmt->bindValue(17,$this->getHoofdzetel());
		$stmt->bindValue(18,$this->getGgz());
		$stmt->bindValue(19,$this->getArt107());
		$stmt->bindValue(20,$this->getMobieleEquipe());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		$stmt=self::prepareStatement($db,self::SQL_INSERT);
		$this->bindValues($stmt);
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
	 * Update this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function updateToDatabase(PDO $db) {
		$stmt=self::prepareStatement($db,self::SQL_UPDATE);
		$this->bindValues($stmt);
		$stmt->bindValue(21,$this->getId());
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
	 * Fetch Hulpverleners's which this Organisatie references.
	 * `organisatie`.`id` -> `hulpverleners`.`organisatie`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Hulpverleners[]
	 */
	public function fetchHulpverlenersCollection(PDO $db, $sort=null) {
		$filter=array(Hulpverleners::FIELD_ORGANISATIE=>$this->getId());
		return Hulpverleners::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Logins's which this Organisatie references.
	 * `organisatie`.`id` -> `logins`.`organisatie`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Logins[]
	 */
	public function fetchLoginsCollection(PDO $db, $sort=null) {
		$filter=array(Logins::FIELD_ORGANISATIE=>$this->getId());
		return Logins::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch PatientTpopname's which this Organisatie references.
	 * `organisatie`.`id` -> `patient_tpopname`.`partner`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return PatientTpopname[]
	 */
	public function fetchPatientTpopnameCollection(PDO $db, $sort=null) {
		$filter=array(PatientTpopname::FIELD_PARTNER=>$this->getId());
		return PatientTpopname::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch TpPartner's which this Organisatie references.
	 * `organisatie`.`id` -> `tp_partner`.`partner`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return TpPartner[]
	 */
	public function fetchTpPartnerCollection(PDO $db, $sort=null) {
		$filter=array(TpPartner::FIELD_PARTNER=>$this->getId());
		return TpPartner::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Gemeente which references this Organisatie. Will return null in case reference is invalid.
	 * `organisatie`.`gem_id` -> `gemeente`.`id`
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
	 * Fetch Persoon which references this Organisatie. Will return null in case reference is invalid.
	 * `organisatie`.`id` -> `persoon`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Persoon
	 */
	public function fetchPersoon(PDO $db, $sort=null) {
		$filter=array(Persoon::FIELD_ID=>$this->getId());
		$result=Persoon::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'Organisatie');
	}

	/**
	 * get single Organisatie instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Organisatie
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Organisatie();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Organisatie from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Organisatie[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Organisatie') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>