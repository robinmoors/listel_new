<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Hulpverleners extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Hulpverleners';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='hulpverleners';
	const SQL_INSERT='INSERT INTO `hulpverleners` (`id`,`naam`,`voornaam`,`fnct_id`,`tel`,`adres`,`gem_id`,`email`,`reknr`,`iban`,`bic`,`riziv1`,`riziv2`,`riziv3`,`organisatie`,`convenant`,`fax`,`gsm`,`actief`,`mag_weg`,`vervangt`,`login`,`paswoord`,`pwd_recovery`,`geheime_vraag`,`geheim_antwoord`,`ipadres`,`logindatum`,`validatiestatus`,`aanvraagdatum`,`validatiedatum`,`weigerdatum`,`is_organisator`,`sociale_kaart`,`sociale_functie`,`sociale_email`,`sociale_tel`,`sociale_fax`,`gedetacheerd_ggz`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `hulpverleners` (`id`,`naam`,`voornaam`,`fnct_id`,`tel`,`adres`,`gem_id`,`email`,`reknr`,`iban`,`bic`,`riziv1`,`riziv2`,`riziv3`,`organisatie`,`convenant`,`fax`,`gsm`,`actief`,`mag_weg`,`vervangt`,`login`,`paswoord`,`pwd_recovery`,`geheime_vraag`,`geheim_antwoord`,`ipadres`,`logindatum`,`validatiestatus`,`aanvraagdatum`,`validatiedatum`,`weigerdatum`,`is_organisator`,`sociale_kaart`,`sociale_functie`,`sociale_email`,`sociale_tel`,`sociale_fax`,`gedetacheerd_ggz`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `hulpverleners` SET `id`=?,`naam`=?,`voornaam`=?,`fnct_id`=?,`tel`=?,`adres`=?,`gem_id`=?,`email`=?,`reknr`=?,`iban`=?,`bic`=?,`riziv1`=?,`riziv2`=?,`riziv3`=?,`organisatie`=?,`convenant`=?,`fax`=?,`gsm`=?,`actief`=?,`mag_weg`=?,`vervangt`=?,`login`=?,`paswoord`=?,`pwd_recovery`=?,`geheime_vraag`=?,`geheim_antwoord`=?,`ipadres`=?,`logindatum`=?,`validatiestatus`=?,`aanvraagdatum`=?,`validatiedatum`=?,`weigerdatum`=?,`is_organisator`=?,`sociale_kaart`=?,`sociale_functie`=?,`sociale_email`=?,`sociale_tel`=?,`sociale_fax`=?,`gedetacheerd_ggz`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `hulpverleners` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `hulpverleners` WHERE `id`=?';
	const FIELD_ID=1622582918;
	const FIELD_NAAM=229204938;
	const FIELD_VOORNAAM=-883107162;
	const FIELD_FNCT_ID=1110541654;
	const FIELD_TEL=-1239526384;
	const FIELD_ADRES=-1496481710;
	const FIELD_GEM_ID=1026250742;
	const FIELD_EMAIL=-1492535727;
	const FIELD_REKNR=-1480758511;
	const FIELD_IBAN=229056945;
	const FIELD_BIC=-1239543567;
	const FIELD_RIZIV1=1345262732;
	const FIELD_RIZIV2=1345262733;
	const FIELD_RIZIV3=1345262734;
	const FIELD_ORGANISATIE=-609414913;
	const FIELD_CONVENANT=1889434143;
	const FIELD_FAX=-1239539950;
	const FIELD_GSM=-1239538442;
	const FIELD_ACTIEF=852846819;
	const FIELD_MAG_WEG=-1635954718;
	const FIELD_VERVANGT=-1079002440;
	const FIELD_LOGIN=-1486005730;
	const FIELD_PASWOORD=2123961042;
	const FIELD_PWD_RECOVERY=907895298;
	const FIELD_GEHEIME_VRAAG=82282439;
	const FIELD_GEHEIM_ANTWOORD=482400119;
	const FIELD_IPADRES=-466961845;
	const FIELD_LOGINDATUM=-1044688623;
	const FIELD_VALIDATIESTATUS=-524823886;
	const FIELD_AANVRAAGDATUM=-1775367225;
	const FIELD_VALIDATIEDATUM=-585519697;
	const FIELD_WEIGERDATUM=-447218453;
	const FIELD_IS_ORGANISATOR=1936855079;
	const FIELD_SOCIALE_KAART=1577267867;
	const FIELD_SOCIALE_FUNCTIE=72558874;
	const FIELD_SOCIALE_EMAIL=1572083946;
	const FIELD_SOCIALE_TEL=-1794995991;
	const FIELD_SOCIALE_FAX=-1795009557;
	const FIELD_GEDETACHEERD_GGZ=1665056713;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array();
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_NAAM=>'naam',
		self::FIELD_VOORNAAM=>'voornaam',
		self::FIELD_FNCT_ID=>'fnct_id',
		self::FIELD_TEL=>'tel',
		self::FIELD_ADRES=>'adres',
		self::FIELD_GEM_ID=>'gem_id',
		self::FIELD_EMAIL=>'email',
		self::FIELD_REKNR=>'reknr',
		self::FIELD_IBAN=>'iban',
		self::FIELD_BIC=>'bic',
		self::FIELD_RIZIV1=>'riziv1',
		self::FIELD_RIZIV2=>'riziv2',
		self::FIELD_RIZIV3=>'riziv3',
		self::FIELD_ORGANISATIE=>'organisatie',
		self::FIELD_CONVENANT=>'convenant',
		self::FIELD_FAX=>'fax',
		self::FIELD_GSM=>'gsm',
		self::FIELD_ACTIEF=>'actief',
		self::FIELD_MAG_WEG=>'mag_weg',
		self::FIELD_VERVANGT=>'vervangt',
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
		self::FIELD_IS_ORGANISATOR=>'is_organisator',
		self::FIELD_SOCIALE_KAART=>'sociale_kaart',
		self::FIELD_SOCIALE_FUNCTIE=>'sociale_functie',
		self::FIELD_SOCIALE_EMAIL=>'sociale_email',
		self::FIELD_SOCIALE_TEL=>'sociale_tel',
		self::FIELD_SOCIALE_FAX=>'sociale_fax',
		self::FIELD_GEDETACHEERD_GGZ=>'gedetacheerd_ggz');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_NAAM=>'naam',
		self::FIELD_VOORNAAM=>'voornaam',
		self::FIELD_FNCT_ID=>'fnctId',
		self::FIELD_TEL=>'tel',
		self::FIELD_ADRES=>'adres',
		self::FIELD_GEM_ID=>'gemId',
		self::FIELD_EMAIL=>'email',
		self::FIELD_REKNR=>'reknr',
		self::FIELD_IBAN=>'iban',
		self::FIELD_BIC=>'bic',
		self::FIELD_RIZIV1=>'riziv1',
		self::FIELD_RIZIV2=>'riziv2',
		self::FIELD_RIZIV3=>'riziv3',
		self::FIELD_ORGANISATIE=>'organisatie',
		self::FIELD_CONVENANT=>'convenant',
		self::FIELD_FAX=>'fax',
		self::FIELD_GSM=>'gsm',
		self::FIELD_ACTIEF=>'actief',
		self::FIELD_MAG_WEG=>'magWeg',
		self::FIELD_VERVANGT=>'vervangt',
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
		self::FIELD_IS_ORGANISATOR=>'isOrganisator',
		self::FIELD_SOCIALE_KAART=>'socialeKaart',
		self::FIELD_SOCIALE_FUNCTIE=>'socialeFunctie',
		self::FIELD_SOCIALE_EMAIL=>'socialeEmail',
		self::FIELD_SOCIALE_TEL=>'socialeTel',
		self::FIELD_SOCIALE_FAX=>'socialeFax',
		self::FIELD_GEDETACHEERD_GGZ=>'gedetacheerdGgz');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VOORNAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FNCT_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TEL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ADRES=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GEM_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EMAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_REKNR=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_IBAN=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_BIC=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_RIZIV1=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_RIZIV2=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_RIZIV3=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_ORGANISATIE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_CONVENANT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FAX=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GSM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ACTIEF=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MAG_WEG=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_VERVANGT=>Db2PhpEntity::PHP_TYPE_INT,
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
		self::FIELD_IS_ORGANISATOR=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_SOCIALE_KAART=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_SOCIALE_FUNCTIE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SOCIALE_EMAIL=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_SOCIALE_TEL=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_SOCIALE_FAX=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_GEDETACHEERD_GGZ=>Db2PhpEntity::PHP_TYPE_BOOL);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_NAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,25,0,false),
		self::FIELD_VOORNAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,25,0,false),
		self::FIELD_FNCT_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_TEL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_ADRES=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,false),
		self::FIELD_GEM_ID=>array(Db2PhpEntity::JDBC_TYPE_SMALLINT,5,0,false),
		self::FIELD_EMAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,false),
		self::FIELD_REKNR=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_IBAN=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,34,0,false),
		self::FIELD_BIC=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,11,0,false),
		self::FIELD_RIZIV1=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_RIZIV2=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_RIZIV3=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_ORGANISATIE=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_CONVENANT=>array(Db2PhpEntity::JDBC_TYPE_CHAR,11,0,true),
		self::FIELD_FAX=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_GSM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_ACTIEF=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_MAG_WEG=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_VERVANGT=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
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
		self::FIELD_IS_ORGANISATOR=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_SOCIALE_KAART=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_SOCIALE_FUNCTIE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,false),
		self::FIELD_SOCIALE_EMAIL=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_SOCIALE_TEL=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_SOCIALE_FAX=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_GEDETACHEERD_GGZ=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>0,
		self::FIELD_NAAM=>'',
		self::FIELD_VOORNAAM=>'',
		self::FIELD_FNCT_ID=>0,
		self::FIELD_TEL=>'',
		self::FIELD_ADRES=>'',
		self::FIELD_GEM_ID=>9999,
		self::FIELD_EMAIL=>'',
		self::FIELD_REKNR=>'',
		self::FIELD_IBAN=>'',
		self::FIELD_BIC=>'',
		self::FIELD_RIZIV1=>0,
		self::FIELD_RIZIV2=>0,
		self::FIELD_RIZIV3=>0,
		self::FIELD_ORGANISATIE=>null,
		self::FIELD_CONVENANT=>null,
		self::FIELD_FAX=>'',
		self::FIELD_GSM=>'',
		self::FIELD_ACTIEF=>1,
		self::FIELD_MAG_WEG=>'0',
		self::FIELD_VERVANGT=>null,
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
		self::FIELD_IS_ORGANISATOR=>0,
		self::FIELD_SOCIALE_KAART=>0,
		self::FIELD_SOCIALE_FUNCTIE=>'',
		self::FIELD_SOCIALE_EMAIL=>0,
		self::FIELD_SOCIALE_TEL=>0,
		self::FIELD_SOCIALE_FAX=>0,
		self::FIELD_GEDETACHEERD_GGZ=>'0');
	private $id;
	private $naam;
	private $voornaam;
	private $fnctId;
	private $tel;
	private $adres;
	private $gemId;
	private $email;
	private $reknr;
	private $iban;
	private $bic;
	private $riziv1;
	private $riziv2;
	private $riziv3;
	private $organisatie;
	private $convenant;
	private $fax;
	private $gsm;
	private $actief;
	private $magWeg;
	private $vervangt;
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
	private $isOrganisator;
	private $socialeKaart;
	private $socialeFunctie;
	private $socialeEmail;
	private $socialeTel;
	private $socialeFax;
	private $gedetacheerdGgz;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique
	 *
	 * @param mixed $id
	 * @return Hulpverleners
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
	 * type:VARCHAR,size:25,default:,index
	 *
	 * @param mixed $naam
	 * @return Hulpverleners
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
	 * set value for voornaam 
	 *
	 * type:VARCHAR,size:25,default:,index
	 *
	 * @param mixed $voornaam
	 * @return Hulpverleners
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
	 * set value for fnct_id 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $fnctId
	 * @return Hulpverleners
	 */
	public function &setFnctId($fnctId) {
		$this->notifyChanged(self::FIELD_FNCT_ID,$this->fnctId,$fnctId);
		$this->fnctId=$fnctId;
		return $this;
	}

	/**
	 * get value for fnct_id 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @return mixed
	 */
	public function getFnctId() {
		return $this->fnctId;
	}

	/**
	 * set value for tel 
	 *
	 * type:VARCHAR,size:20,default:
	 *
	 * @param mixed $tel
	 * @return Hulpverleners
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
	 * set value for adres 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @param mixed $adres
	 * @return Hulpverleners
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
	 * type:SMALLINT,size:5,default:9999,index
	 *
	 * @param mixed $gemId
	 * @return Hulpverleners
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
	 * set value for email 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @param mixed $email
	 * @return Hulpverleners
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
	 * set value for reknr 
	 *
	 * type:VARCHAR,size:20,default:
	 *
	 * @param mixed $reknr
	 * @return Hulpverleners
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
	 * @return Hulpverleners
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
	 * @return Hulpverleners
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
	 * set value for riziv1 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $riziv1
	 * @return Hulpverleners
	 */
	public function &setRiziv1($riziv1) {
		$this->notifyChanged(self::FIELD_RIZIV1,$this->riziv1,$riziv1);
		$this->riziv1=$riziv1;
		return $this;
	}

	/**
	 * get value for riziv1 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getRiziv1() {
		return $this->riziv1;
	}

	/**
	 * set value for riziv2 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $riziv2
	 * @return Hulpverleners
	 */
	public function &setRiziv2($riziv2) {
		$this->notifyChanged(self::FIELD_RIZIV2,$this->riziv2,$riziv2);
		$this->riziv2=$riziv2;
		return $this;
	}

	/**
	 * get value for riziv2 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getRiziv2() {
		return $this->riziv2;
	}

	/**
	 * set value for riziv3 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $riziv3
	 * @return Hulpverleners
	 */
	public function &setRiziv3($riziv3) {
		$this->notifyChanged(self::FIELD_RIZIV3,$this->riziv3,$riziv3);
		$this->riziv3=$riziv3;
		return $this;
	}

	/**
	 * get value for riziv3 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getRiziv3() {
		return $this->riziv3;
	}

	/**
	 * set value for organisatie 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $organisatie
	 * @return Hulpverleners
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
	 * set value for convenant 
	 *
	 * type:ENUM,size:11,default:null,nullable
	 *
	 * @param mixed $convenant
	 * @return Hulpverleners
	 */
	public function &setConvenant($convenant) {
		$this->notifyChanged(self::FIELD_CONVENANT,$this->convenant,$convenant);
		$this->convenant=$convenant;
		return $this;
	}

	/**
	 * get value for convenant 
	 *
	 * type:ENUM,size:11,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getConvenant() {
		return $this->convenant;
	}

	/**
	 * set value for fax 
	 *
	 * type:VARCHAR,size:20,default:
	 *
	 * @param mixed $fax
	 * @return Hulpverleners
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
	 * @return Hulpverleners
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
	 * set value for actief 
	 *
	 * type:INT,size:10,default:1,index
	 *
	 * @param mixed $actief
	 * @return Hulpverleners
	 */
	public function &setActief($actief) {
		$this->notifyChanged(self::FIELD_ACTIEF,$this->actief,$actief);
		$this->actief=$actief;
		return $this;
	}

	/**
	 * get value for actief 
	 *
	 * type:INT,size:10,default:1,index
	 *
	 * @return mixed
	 */
	public function getActief() {
		return $this->actief;
	}

	/**
	 * set value for mag_weg 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $magWeg
	 * @return Hulpverleners
	 */
	public function &setMagWeg($magWeg) {
		$this->notifyChanged(self::FIELD_MAG_WEG,$this->magWeg,$magWeg);
		$this->magWeg=$magWeg;
		return $this;
	}

	/**
	 * get value for mag_weg 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getMagWeg() {
		return $this->magWeg;
	}

	/**
	 * set value for vervangt 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $vervangt
	 * @return Hulpverleners
	 */
	public function &setVervangt($vervangt) {
		$this->notifyChanged(self::FIELD_VERVANGT,$this->vervangt,$vervangt);
		$this->vervangt=$vervangt;
		return $this;
	}

	/**
	 * get value for vervangt 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getVervangt() {
		return $this->vervangt;
	}

	/**
	 * set value for login 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @param mixed $login
	 * @return Hulpverleners
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
	 * @return Hulpverleners
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
	 * @return Hulpverleners
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
	 * @return Hulpverleners
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
	 * @return Hulpverleners
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
	 * @return Hulpverleners
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
	 * @return Hulpverleners
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
	 * @return Hulpverleners
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
	 * @return Hulpverleners
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
	 * @return Hulpverleners
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
	 * @return Hulpverleners
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
	 * set value for is_organisator 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $isOrganisator
	 * @return Hulpverleners
	 */
	public function &setIsOrganisator($isOrganisator) {
		$this->notifyChanged(self::FIELD_IS_ORGANISATOR,$this->isOrganisator,$isOrganisator);
		$this->isOrganisator=$isOrganisator;
		return $this;
	}

	/**
	 * get value for is_organisator 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getIsOrganisator() {
		return $this->isOrganisator;
	}

	/**
	 * set value for sociale_kaart 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $socialeKaart
	 * @return Hulpverleners
	 */
	public function &setSocialeKaart($socialeKaart) {
		$this->notifyChanged(self::FIELD_SOCIALE_KAART,$this->socialeKaart,$socialeKaart);
		$this->socialeKaart=$socialeKaart;
		return $this;
	}

	/**
	 * get value for sociale_kaart 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getSocialeKaart() {
		return $this->socialeKaart;
	}

	/**
	 * set value for sociale_functie 
	 *
	 * type:VARCHAR,size:200,default:
	 *
	 * @param mixed $socialeFunctie
	 * @return Hulpverleners
	 */
	public function &setSocialeFunctie($socialeFunctie) {
		$this->notifyChanged(self::FIELD_SOCIALE_FUNCTIE,$this->socialeFunctie,$socialeFunctie);
		$this->socialeFunctie=$socialeFunctie;
		return $this;
	}

	/**
	 * get value for sociale_functie 
	 *
	 * type:VARCHAR,size:200,default:
	 *
	 * @return mixed
	 */
	public function getSocialeFunctie() {
		return $this->socialeFunctie;
	}

	/**
	 * set value for sociale_email 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $socialeEmail
	 * @return Hulpverleners
	 */
	public function &setSocialeEmail($socialeEmail) {
		$this->notifyChanged(self::FIELD_SOCIALE_EMAIL,$this->socialeEmail,$socialeEmail);
		$this->socialeEmail=$socialeEmail;
		return $this;
	}

	/**
	 * get value for sociale_email 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getSocialeEmail() {
		return $this->socialeEmail;
	}

	/**
	 * set value for sociale_tel 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $socialeTel
	 * @return Hulpverleners
	 */
	public function &setSocialeTel($socialeTel) {
		$this->notifyChanged(self::FIELD_SOCIALE_TEL,$this->socialeTel,$socialeTel);
		$this->socialeTel=$socialeTel;
		return $this;
	}

	/**
	 * get value for sociale_tel 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getSocialeTel() {
		return $this->socialeTel;
	}

	/**
	 * set value for sociale_fax 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $socialeFax
	 * @return Hulpverleners
	 */
	public function &setSocialeFax($socialeFax) {
		$this->notifyChanged(self::FIELD_SOCIALE_FAX,$this->socialeFax,$socialeFax);
		$this->socialeFax=$socialeFax;
		return $this;
	}

	/**
	 * get value for sociale_fax 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getSocialeFax() {
		return $this->socialeFax;
	}

	/**
	 * set value for gedetacheerd_ggz 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $gedetacheerdGgz
	 * @return Hulpverleners
	 */
	public function &setGedetacheerdGgz($gedetacheerdGgz) {
		$this->notifyChanged(self::FIELD_GEDETACHEERD_GGZ,$this->gedetacheerdGgz,$gedetacheerdGgz);
		$this->gedetacheerdGgz=$gedetacheerdGgz;
		return $this;
	}

	/**
	 * get value for gedetacheerd_ggz 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getGedetacheerdGgz() {
		return $this->gedetacheerdGgz;
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
			self::FIELD_FNCT_ID=>$this->getFnctId(),
			self::FIELD_TEL=>$this->getTel(),
			self::FIELD_ADRES=>$this->getAdres(),
			self::FIELD_GEM_ID=>$this->getGemId(),
			self::FIELD_EMAIL=>$this->getEmail(),
			self::FIELD_REKNR=>$this->getReknr(),
			self::FIELD_IBAN=>$this->getIban(),
			self::FIELD_BIC=>$this->getBic(),
			self::FIELD_RIZIV1=>$this->getRiziv1(),
			self::FIELD_RIZIV2=>$this->getRiziv2(),
			self::FIELD_RIZIV3=>$this->getRiziv3(),
			self::FIELD_ORGANISATIE=>$this->getOrganisatie(),
			self::FIELD_CONVENANT=>$this->getConvenant(),
			self::FIELD_FAX=>$this->getFax(),
			self::FIELD_GSM=>$this->getGsm(),
			self::FIELD_ACTIEF=>$this->getActief(),
			self::FIELD_MAG_WEG=>$this->getMagWeg(),
			self::FIELD_VERVANGT=>$this->getVervangt(),
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
			self::FIELD_IS_ORGANISATOR=>$this->getIsOrganisator(),
			self::FIELD_SOCIALE_KAART=>$this->getSocialeKaart(),
			self::FIELD_SOCIALE_FUNCTIE=>$this->getSocialeFunctie(),
			self::FIELD_SOCIALE_EMAIL=>$this->getSocialeEmail(),
			self::FIELD_SOCIALE_TEL=>$this->getSocialeTel(),
			self::FIELD_SOCIALE_FAX=>$this->getSocialeFax(),
			self::FIELD_GEDETACHEERD_GGZ=>$this->getGedetacheerdGgz());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Hulpverleners instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Hulpverleners $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Hulpverleners[]
	 */
	public static function findByExample(PDO $db,Hulpverleners $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Hulpverleners instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Hulpverleners[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `hulpverleners`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Hulpverleners instances
	 *
	 * @param PDOStatement $stmt
	 * @return Hulpverleners[]
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
	 * returns the result as an array of Hulpverleners instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Hulpverleners[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Hulpverleners();
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
	 * Execute select query and return matched rows as an array of Hulpverleners instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Hulpverleners[]
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
		$sql='DELETE FROM `hulpverleners`'
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
		$this->setFnctId($result['fnct_id']);
		$this->setTel($result['tel']);
		$this->setAdres($result['adres']);
		$this->setGemId($result['gem_id']);
		$this->setEmail($result['email']);
		$this->setReknr($result['reknr']);
		$this->setIban($result['iban']);
		$this->setBic($result['bic']);
		$this->setRiziv1($result['riziv1']);
		$this->setRiziv2($result['riziv2']);
		$this->setRiziv3($result['riziv3']);
		$this->setOrganisatie($result['organisatie']);
		$this->setConvenant($result['convenant']);
		$this->setFax($result['fax']);
		$this->setGsm($result['gsm']);
		$this->setActief($result['actief']);
		$this->setMagWeg($result['mag_weg']);
		$this->setVervangt($result['vervangt']);
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
		$this->setIsOrganisator($result['is_organisator']);
		$this->setSocialeKaart($result['sociale_kaart']);
		$this->setSocialeFunctie($result['sociale_functie']);
		$this->setSocialeEmail($result['sociale_email']);
		$this->setSocialeTel($result['sociale_tel']);
		$this->setSocialeFax($result['sociale_fax']);
		$this->setGedetacheerdGgz($result['gedetacheerd_ggz']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Hulpverleners
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
		$o=new Hulpverleners();
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
		$stmt->bindValue(4,$this->getFnctId());
		$stmt->bindValue(5,$this->getTel());
		$stmt->bindValue(6,$this->getAdres());
		$stmt->bindValue(7,$this->getGemId());
		$stmt->bindValue(8,$this->getEmail());
		$stmt->bindValue(9,$this->getReknr());
		$stmt->bindValue(10,$this->getIban());
		$stmt->bindValue(11,$this->getBic());
		$stmt->bindValue(12,$this->getRiziv1());
		$stmt->bindValue(13,$this->getRiziv2());
		$stmt->bindValue(14,$this->getRiziv3());
		$stmt->bindValue(15,$this->getOrganisatie());
		$stmt->bindValue(16,$this->getConvenant());
		$stmt->bindValue(17,$this->getFax());
		$stmt->bindValue(18,$this->getGsm());
		$stmt->bindValue(19,$this->getActief());
		$stmt->bindValue(20,$this->getMagWeg());
		$stmt->bindValue(21,$this->getVervangt());
		$stmt->bindValue(22,$this->getLogin());
		$stmt->bindValue(23,$this->getPaswoord());
		$stmt->bindValue(24,$this->getPwdRecovery());
		$stmt->bindValue(25,$this->getGeheimeVraag());
		$stmt->bindValue(26,$this->getGeheimAntwoord());
		$stmt->bindValue(27,$this->getIpadres());
		$stmt->bindValue(28,$this->getLogindatum());
		$stmt->bindValue(29,$this->getValidatiestatus());
		$stmt->bindValue(30,$this->getAanvraagdatum());
		$stmt->bindValue(31,$this->getValidatiedatum());
		$stmt->bindValue(32,$this->getWeigerdatum());
		$stmt->bindValue(33,$this->getIsOrganisator());
		$stmt->bindValue(34,$this->getSocialeKaart());
		$stmt->bindValue(35,$this->getSocialeFunctie());
		$stmt->bindValue(36,$this->getSocialeEmail());
		$stmt->bindValue(37,$this->getSocialeTel());
		$stmt->bindValue(38,$this->getSocialeFax());
		$stmt->bindValue(39,$this->getGedetacheerdGgz());
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
		$stmt->bindValue(40,$this->getId());
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
	 * Fetch AanvraagOverleg's which this Hulpverleners references.
	 * `hulpverleners`.`id` -> `aanvraag_overleg`.`id_organisator`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return AanvraagOverleg[]
	 */
	public function fetchAanvraagOverlegCollection(PDO $db, $sort=null) {
		$filter=array(AanvraagOverleg::FIELD_ID_ORGANISATOR=>$this->getId());
		return AanvraagOverleg::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch BerichtenTo's which this Hulpverleners references.
	 * `hulpverleners`.`id` -> `berichten_to`.`persoon`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return BerichtenTo[]
	 */
	public function fetchBerichtenToCollection(PDO $db, $sort=null) {
		$filter=array(BerichtenTo::FIELD_PERSOON=>$this->getId());
		return BerichtenTo::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Evaluatie's which this Hulpverleners references.
	 * `hulpverleners`.`id` -> `evaluatie`.`uitvoerder_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Evaluatie[]
	 */
	public function fetchEvaluatieCollection(PDO $db, $sort=null) {
		$filter=array(Evaluatie::FIELD_UITVOERDER_ID=>$this->getId());
		return Evaluatie::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Katz's which this Hulpverleners references.
	 * `hulpverleners`.`id` -> `katz`.`hvl_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Katz[]
	 */
	public function fetchKatzCollection(PDO $db, $sort=null) {
		$filter=array(Katz::FIELD_HVL_ID=>$this->getId());
		return Katz::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch KatzAanvraag's which this Hulpverleners references.
	 * `hulpverleners`.`id` -> `katz_aanvraag`.`hvl`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return KatzAanvraag[]
	 */
	public function fetchKatzAanvraagCollection(PDO $db, $sort=null) {
		$filter=array(KatzAanvraag::FIELD_HVL=>$this->getId());
		return KatzAanvraag::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Overlegbasis's which this Hulpverleners references.
	 * `hulpverleners`.`id` -> `overlegbasis`.`contact_hvl`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegbasis[]
	 */
	public function fetchOverlegbasisCollection(PDO $db, $sort=null) {
		$filter=array(Overlegbasis::FIELD_CONTACT_HVL=>$this->getId());
		return Overlegbasis::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Overlegbasis1's which this Hulpverleners references.
	 * `hulpverleners`.`id` -> `overlegbasis`.`toegewezen_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegbasis1[]
	 */
	public function fetchOverlegbasis1Collection(PDO $db, $sort=null) {
		$filter=array(Overlegbasis1::FIELD_TOEGEWEZEN_ID=>$this->getId());
		return Overlegbasis1::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch TaakficheMensen's which this Hulpverleners references.
	 * `hulpverleners`.`id` -> `taakfiche_mensen`.`mens_id`
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
	 * Fetch Functies which references this Hulpverleners. Will return null in case reference is invalid.
	 * `hulpverleners`.`fnct_id` -> `functies`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Functies
	 */
	public function fetchFuncties(PDO $db, $sort=null) {
		$filter=array(Functies::FIELD_ID=>$this->getFnctId());
		$result=Functies::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Gemeente which references this Hulpverleners. Will return null in case reference is invalid.
	 * `hulpverleners`.`gem_id` -> `gemeente`.`id`
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
	 * Fetch Persoon which references this Hulpverleners. Will return null in case reference is invalid.
	 * `hulpverleners`.`id` -> `persoon`.`id`
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
	 * Fetch Organisatie which references this Hulpverleners. Will return null in case reference is invalid.
	 * `hulpverleners`.`organisatie` -> `organisatie`.`id`
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
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'Hulpverleners');
	}

	/**
	 * get single Hulpverleners instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Hulpverleners
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Hulpverleners();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Hulpverleners from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Hulpverleners[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Hulpverleners') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>