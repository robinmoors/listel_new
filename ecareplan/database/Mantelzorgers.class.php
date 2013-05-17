<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Mantelzorgers extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Mantelzorgers';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='mantelzorgers';
	const SQL_INSERT='INSERT INTO `mantelzorgers` (`id`,`naam`,`voornaam`,`verwsch_id`,`tel`,`fax`,`gsm`,`adres`,`gem_id`,`email`,`actief`,`login`,`paswoord`,`pwd_recovery`,`geheime_vraag`,`geheim_antwoord`,`ipadres`,`logindatum`,`validatiestatus`,`aanvraagdatum`,`validatiedatum`,`weigerdatum`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `mantelzorgers` (`id`,`naam`,`voornaam`,`verwsch_id`,`tel`,`fax`,`gsm`,`adres`,`gem_id`,`email`,`actief`,`login`,`paswoord`,`pwd_recovery`,`geheime_vraag`,`geheim_antwoord`,`ipadres`,`logindatum`,`validatiestatus`,`aanvraagdatum`,`validatiedatum`,`weigerdatum`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `mantelzorgers` SET `id`=?,`naam`=?,`voornaam`=?,`verwsch_id`=?,`tel`=?,`fax`=?,`gsm`=?,`adres`=?,`gem_id`=?,`email`=?,`actief`=?,`login`=?,`paswoord`=?,`pwd_recovery`=?,`geheime_vraag`=?,`geheim_antwoord`=?,`ipadres`=?,`logindatum`=?,`validatiestatus`=?,`aanvraagdatum`=?,`validatiedatum`=?,`weigerdatum`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `mantelzorgers` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `mantelzorgers` WHERE `id`=?';
	const FIELD_ID=65323662;
	const FIELD_NAAM=-1648321070;
	const FIELD_VOORNAAM=-1447571282;
	const FIELD_VERWSCH_ID=-1725683895;
	const FIELD_TEL=2025044232;
	const FIELD_FAX=2025030666;
	const FIELD_GSM=2025032174;
	const FIELD_ADRES=429754186;
	const FIELD_GEM_ID=610021374;
	const FIELD_EMAIL=433700169;
	const FIELD_ACTIEF=436617451;
	const FIELD_LOGIN=440230166;
	const FIELD_PASWOORD=1559496922;
	const FIELD_PWD_RECOVERY=-495053814;
	const FIELD_GEHEIME_VRAAG=-459467073;
	const FIELD_GEHEIM_ANTWOORD=-447838097;
	const FIELD_IPADRES=-485170365;
	const FIELD_LOGINDATUM=1966138649;
	const FIELD_VALIDATIESTATUS=-1455062102;
	const FIELD_AANVRAAGDATUM=1977850559;
	const FIELD_VALIDATIEDATUM=-199885385;
	const FIELD_WEIGERDATUM=-1600853533;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array();
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_NAAM=>'naam',
		self::FIELD_VOORNAAM=>'voornaam',
		self::FIELD_VERWSCH_ID=>'verwsch_id',
		self::FIELD_TEL=>'tel',
		self::FIELD_FAX=>'fax',
		self::FIELD_GSM=>'gsm',
		self::FIELD_ADRES=>'adres',
		self::FIELD_GEM_ID=>'gem_id',
		self::FIELD_EMAIL=>'email',
		self::FIELD_ACTIEF=>'actief',
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
		self::FIELD_WEIGERDATUM=>'weigerdatum');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_NAAM=>'naam',
		self::FIELD_VOORNAAM=>'voornaam',
		self::FIELD_VERWSCH_ID=>'verwschId',
		self::FIELD_TEL=>'tel',
		self::FIELD_FAX=>'fax',
		self::FIELD_GSM=>'gsm',
		self::FIELD_ADRES=>'adres',
		self::FIELD_GEM_ID=>'gemId',
		self::FIELD_EMAIL=>'email',
		self::FIELD_ACTIEF=>'actief',
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
		self::FIELD_WEIGERDATUM=>'weigerdatum');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VOORNAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VERWSCH_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TEL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FAX=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GSM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ADRES=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GEM_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EMAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ACTIEF=>Db2PhpEntity::PHP_TYPE_INT,
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
		self::FIELD_WEIGERDATUM=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_NAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,false),
		self::FIELD_VOORNAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,false),
		self::FIELD_VERWSCH_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_TEL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_FAX=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_GSM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_ADRES=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,80,0,false),
		self::FIELD_GEM_ID=>array(Db2PhpEntity::JDBC_TYPE_SMALLINT,5,0,false),
		self::FIELD_EMAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,80,0,false),
		self::FIELD_ACTIEF=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
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
		self::FIELD_WEIGERDATUM=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>0,
		self::FIELD_NAAM=>'',
		self::FIELD_VOORNAAM=>'',
		self::FIELD_VERWSCH_ID=>1,
		self::FIELD_TEL=>'',
		self::FIELD_FAX=>'',
		self::FIELD_GSM=>'',
		self::FIELD_ADRES=>'',
		self::FIELD_GEM_ID=>0,
		self::FIELD_EMAIL=>'',
		self::FIELD_ACTIEF=>1,
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
		self::FIELD_WEIGERDATUM=>'1000-01-01');
	private $id;
	private $naam;
	private $voornaam;
	private $verwschId;
	private $tel;
	private $fax;
	private $gsm;
	private $adres;
	private $gemId;
	private $email;
	private $actief;
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

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique
	 *
	 * @param mixed $id
	 * @return Mantelzorgers
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
	 * type:VARCHAR,size:50,default:,index
	 *
	 * @param mixed $naam
	 * @return Mantelzorgers
	 */
	public function &setNaam($naam) {
		$this->notifyChanged(self::FIELD_NAAM,$this->naam,$naam);
		$this->naam=$naam;
		return $this;
	}

	/**
	 * get value for naam 
	 *
	 * type:VARCHAR,size:50,default:,index
	 *
	 * @return mixed
	 */
	public function getNaam() {
		return $this->naam;
	}

	/**
	 * set value for voornaam 
	 *
	 * type:VARCHAR,size:50,default:,index
	 *
	 * @param mixed $voornaam
	 * @return Mantelzorgers
	 */
	public function &setVoornaam($voornaam) {
		$this->notifyChanged(self::FIELD_VOORNAAM,$this->voornaam,$voornaam);
		$this->voornaam=$voornaam;
		return $this;
	}

	/**
	 * get value for voornaam 
	 *
	 * type:VARCHAR,size:50,default:,index
	 *
	 * @return mixed
	 */
	public function getVoornaam() {
		return $this->voornaam;
	}

	/**
	 * set value for verwsch_id 
	 *
	 * type:INT,size:10,default:1,index
	 *
	 * @param mixed $verwschId
	 * @return Mantelzorgers
	 */
	public function &setVerwschId($verwschId) {
		$this->notifyChanged(self::FIELD_VERWSCH_ID,$this->verwschId,$verwschId);
		$this->verwschId=$verwschId;
		return $this;
	}

	/**
	 * get value for verwsch_id 
	 *
	 * type:INT,size:10,default:1,index
	 *
	 * @return mixed
	 */
	public function getVerwschId() {
		return $this->verwschId;
	}

	/**
	 * set value for tel 
	 *
	 * type:VARCHAR,size:20,default:
	 *
	 * @param mixed $tel
	 * @return Mantelzorgers
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
	 * @return Mantelzorgers
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
	 * @return Mantelzorgers
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
	 * set value for adres 
	 *
	 * type:VARCHAR,size:80,default:
	 *
	 * @param mixed $adres
	 * @return Mantelzorgers
	 */
	public function &setAdres($adres) {
		$this->notifyChanged(self::FIELD_ADRES,$this->adres,$adres);
		$this->adres=$adres;
		return $this;
	}

	/**
	 * get value for adres 
	 *
	 * type:VARCHAR,size:80,default:
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
	 * @return Mantelzorgers
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
	 * set value for email 
	 *
	 * type:VARCHAR,size:80,default:
	 *
	 * @param mixed $email
	 * @return Mantelzorgers
	 */
	public function &setEmail($email) {
		$this->notifyChanged(self::FIELD_EMAIL,$this->email,$email);
		$this->email=$email;
		return $this;
	}

	/**
	 * get value for email 
	 *
	 * type:VARCHAR,size:80,default:
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
	 * @return Mantelzorgers
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
	 * set value for login 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @param mixed $login
	 * @return Mantelzorgers
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
	 * @return Mantelzorgers
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
	 * @return Mantelzorgers
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
	 * @return Mantelzorgers
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
	 * @return Mantelzorgers
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
	 * @return Mantelzorgers
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
	 * @return Mantelzorgers
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
	 * @return Mantelzorgers
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
	 * @return Mantelzorgers
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
	 * @return Mantelzorgers
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
	 * @return Mantelzorgers
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
			self::FIELD_VOORNAAM=>$this->getVoornaam(),
			self::FIELD_VERWSCH_ID=>$this->getVerwschId(),
			self::FIELD_TEL=>$this->getTel(),
			self::FIELD_FAX=>$this->getFax(),
			self::FIELD_GSM=>$this->getGsm(),
			self::FIELD_ADRES=>$this->getAdres(),
			self::FIELD_GEM_ID=>$this->getGemId(),
			self::FIELD_EMAIL=>$this->getEmail(),
			self::FIELD_ACTIEF=>$this->getActief(),
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
			self::FIELD_WEIGERDATUM=>$this->getWeigerdatum());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Mantelzorgers instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Mantelzorgers $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Mantelzorgers[]
	 */
	public static function findByExample(PDO $db,Mantelzorgers $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Mantelzorgers instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Mantelzorgers[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `mantelzorgers`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Mantelzorgers instances
	 *
	 * @param PDOStatement $stmt
	 * @return Mantelzorgers[]
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
	 * returns the result as an array of Mantelzorgers instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Mantelzorgers[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Mantelzorgers();
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
	 * Execute select query and return matched rows as an array of Mantelzorgers instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Mantelzorgers[]
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
		$sql='DELETE FROM `mantelzorgers`'
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
		$this->setVoornaam($result['voornaam']);
		$this->setVerwschId($result['verwsch_id']);
		$this->setTel($result['tel']);
		$this->setFax($result['fax']);
		$this->setGsm($result['gsm']);
		$this->setAdres($result['adres']);
		$this->setGemId($result['gem_id']);
		$this->setEmail($result['email']);
		$this->setActief($result['actief']);
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
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Mantelzorgers
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
		$o=new Mantelzorgers();
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
		$stmt->bindValue(3,$this->getVoornaam());
		$stmt->bindValue(4,$this->getVerwschId());
		$stmt->bindValue(5,$this->getTel());
		$stmt->bindValue(6,$this->getFax());
		$stmt->bindValue(7,$this->getGsm());
		$stmt->bindValue(8,$this->getAdres());
		$stmt->bindValue(9,$this->getGemId());
		$stmt->bindValue(10,$this->getEmail());
		$stmt->bindValue(11,$this->getActief());
		$stmt->bindValue(12,$this->getLogin());
		$stmt->bindValue(13,$this->getPaswoord());
		$stmt->bindValue(14,$this->getPwdRecovery());
		$stmt->bindValue(15,$this->getGeheimeVraag());
		$stmt->bindValue(16,$this->getGeheimAntwoord());
		$stmt->bindValue(17,$this->getIpadres());
		$stmt->bindValue(18,$this->getLogindatum());
		$stmt->bindValue(19,$this->getValidatiestatus());
		$stmt->bindValue(20,$this->getAanvraagdatum());
		$stmt->bindValue(21,$this->getValidatiedatum());
		$stmt->bindValue(22,$this->getWeigerdatum());
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
		$stmt->bindValue(23,$this->getId());
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
	 * Fetch OverlegTpPlan's which this Mantelzorgers references.
	 * `mantelzorgers`.`id` -> `overleg_tp_plan`.`persoon`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return OverlegTpPlan[]
	 */
	public function fetchOverlegTpPlanCollection(PDO $db, $sort=null) {
		$filter=array(OverlegTpPlan::FIELD_PERSOON=>$this->getId());
		return OverlegTpPlan::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Overlegbasis's which this Mantelzorgers references.
	 * `mantelzorgers`.`id` -> `overlegbasis`.`contact_mz`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegbasis[]
	 */
	public function fetchOverlegbasisCollection(PDO $db, $sort=null) {
		$filter=array(Overlegbasis::FIELD_CONTACT_MZ=>$this->getId());
		return Overlegbasis::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch TaakficheMensen's which this Mantelzorgers references.
	 * `mantelzorgers`.`id` -> `taakfiche_mensen`.`mens_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return TaakficheMensen[]
	 */
	public function fetchTaakficheMensenCollection(PDO $db, $sort=null) {
		$filter=array(TaakficheMensen::FIELD_MENS_ID=>$this->getId());
		return TaakficheMensen::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Gemeente which references this Mantelzorgers. Will return null in case reference is invalid.
	 * `mantelzorgers`.`gem_id` -> `gemeente`.`id`
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
	 * Fetch Verwantschap which references this Mantelzorgers. Will return null in case reference is invalid.
	 * `mantelzorgers`.`verwsch_id` -> `verwantschap`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Verwantschap
	 */
	public function fetchVerwantschap(PDO $db, $sort=null) {
		$filter=array(Verwantschap::FIELD_ID=>$this->getVerwschId());
		$result=Verwantschap::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Persoon which references this Mantelzorgers. Will return null in case reference is invalid.
	 * `mantelzorgers`.`id` -> `persoon`.`id`
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
		return self::hashToDomDocument($this->toHash(), 'Mantelzorgers');
	}

	/**
	 * get single Mantelzorgers instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Mantelzorgers
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Mantelzorgers();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Mantelzorgers from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Mantelzorgers[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Mantelzorgers') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>