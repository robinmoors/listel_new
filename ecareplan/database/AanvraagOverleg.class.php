<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class AanvraagOverleg extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='AanvraagOverleg';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='aanvraag_overleg';
	const SQL_INSERT='INSERT INTO `aanvraag_overleg` (`id`,`timestamp`,`rijksregister`,`patient_code`,`gemeente_id`,`keuze_organisator`,`reden_organisator`,`andere_reden_organisator`,`id_organisator`,`id_organisator_user`,`doel_informeren`,`doel_overtuigen`,`doel_organiseren`,`doel_debriefen`,`doel_beslissen`,`doel_andere`,`naam_aanvrager`,`discipline_aanvrager`,`organisatie_aanvrager`,`info_aanvrager`,`dringend`,`status`,`reden_status`,`overleg_id`,`ontvangst`,`bron`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `aanvraag_overleg` (`timestamp`,`rijksregister`,`patient_code`,`gemeente_id`,`keuze_organisator`,`reden_organisator`,`andere_reden_organisator`,`id_organisator`,`id_organisator_user`,`doel_informeren`,`doel_overtuigen`,`doel_organiseren`,`doel_debriefen`,`doel_beslissen`,`doel_andere`,`naam_aanvrager`,`discipline_aanvrager`,`organisatie_aanvrager`,`info_aanvrager`,`dringend`,`status`,`reden_status`,`overleg_id`,`ontvangst`,`bron`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `aanvraag_overleg` SET `id`=?,`timestamp`=?,`rijksregister`=?,`patient_code`=?,`gemeente_id`=?,`keuze_organisator`=?,`reden_organisator`=?,`andere_reden_organisator`=?,`id_organisator`=?,`id_organisator_user`=?,`doel_informeren`=?,`doel_overtuigen`=?,`doel_organiseren`=?,`doel_debriefen`=?,`doel_beslissen`=?,`doel_andere`=?,`naam_aanvrager`=?,`discipline_aanvrager`=?,`organisatie_aanvrager`=?,`info_aanvrager`=?,`dringend`=?,`status`=?,`reden_status`=?,`overleg_id`=?,`ontvangst`=?,`bron`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `aanvraag_overleg` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `aanvraag_overleg` WHERE `id`=?';
	const FIELD_ID=-392826927;
	const FIELD_TIMESTAMP=-590942816;
	const FIELD_RIJKSREGISTER=902332648;
	const FIELD_PATIENT_CODE=2123566621;
	const FIELD_GEMEENTE_ID=2016593140;
	const FIELD_KEUZE_ORGANISATOR=-1915304606;
	const FIELD_REDEN_ORGANISATOR=-1504478826;
	const FIELD_ANDERE_REDEN_ORGANISATOR=172156068;
	const FIELD_ID_ORGANISATOR=1751211875;
	const FIELD_ID_ORGANISATOR_USER=1996712743;
	const FIELD_DOEL_INFORMEREN=2002981366;
	const FIELD_DOEL_OVERTUIGEN=233622291;
	const FIELD_DOEL_ORGANISEREN=-808952454;
	const FIELD_DOEL_DEBRIEFEN=57870123;
	const FIELD_DOEL_BESLISSEN=1409127103;
	const FIELD_DOEL_ANDERE=629050520;
	const FIELD_NAAM_AANVRAGER=1725552755;
	const FIELD_DISCIPLINE_AANVRAGER=2131060996;
	const FIELD_ORGANISATIE_AANVRAGER=384924530;
	const FIELD_INFO_AANVRAGER=1785584962;
	const FIELD_DRINGEND=481933821;
	const FIELD_STATUS=-609785944;
	const FIELD_REDEN_STATUS=-658525683;
	const FIELD_OVERLEG_ID=-502921354;
	const FIELD_ONTVANGST=-1926997436;
	const FIELD_BRON=450253669;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_TIMESTAMP=>'timestamp',
		self::FIELD_RIJKSREGISTER=>'rijksregister',
		self::FIELD_PATIENT_CODE=>'patient_code',
		self::FIELD_GEMEENTE_ID=>'gemeente_id',
		self::FIELD_KEUZE_ORGANISATOR=>'keuze_organisator',
		self::FIELD_REDEN_ORGANISATOR=>'reden_organisator',
		self::FIELD_ANDERE_REDEN_ORGANISATOR=>'andere_reden_organisator',
		self::FIELD_ID_ORGANISATOR=>'id_organisator',
		self::FIELD_ID_ORGANISATOR_USER=>'id_organisator_user',
		self::FIELD_DOEL_INFORMEREN=>'doel_informeren',
		self::FIELD_DOEL_OVERTUIGEN=>'doel_overtuigen',
		self::FIELD_DOEL_ORGANISEREN=>'doel_organiseren',
		self::FIELD_DOEL_DEBRIEFEN=>'doel_debriefen',
		self::FIELD_DOEL_BESLISSEN=>'doel_beslissen',
		self::FIELD_DOEL_ANDERE=>'doel_andere',
		self::FIELD_NAAM_AANVRAGER=>'naam_aanvrager',
		self::FIELD_DISCIPLINE_AANVRAGER=>'discipline_aanvrager',
		self::FIELD_ORGANISATIE_AANVRAGER=>'organisatie_aanvrager',
		self::FIELD_INFO_AANVRAGER=>'info_aanvrager',
		self::FIELD_DRINGEND=>'dringend',
		self::FIELD_STATUS=>'status',
		self::FIELD_REDEN_STATUS=>'reden_status',
		self::FIELD_OVERLEG_ID=>'overleg_id',
		self::FIELD_ONTVANGST=>'ontvangst',
		self::FIELD_BRON=>'bron');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_TIMESTAMP=>'timestamp',
		self::FIELD_RIJKSREGISTER=>'rijksregister',
		self::FIELD_PATIENT_CODE=>'patientCode',
		self::FIELD_GEMEENTE_ID=>'gemeenteId',
		self::FIELD_KEUZE_ORGANISATOR=>'keuzeOrganisator',
		self::FIELD_REDEN_ORGANISATOR=>'redenOrganisator',
		self::FIELD_ANDERE_REDEN_ORGANISATOR=>'andereRedenOrganisator',
		self::FIELD_ID_ORGANISATOR=>'idOrganisator',
		self::FIELD_ID_ORGANISATOR_USER=>'idOrganisatorUser',
		self::FIELD_DOEL_INFORMEREN=>'doelInformeren',
		self::FIELD_DOEL_OVERTUIGEN=>'doelOvertuigen',
		self::FIELD_DOEL_ORGANISEREN=>'doelOrganiseren',
		self::FIELD_DOEL_DEBRIEFEN=>'doelDebriefen',
		self::FIELD_DOEL_BESLISSEN=>'doelBeslissen',
		self::FIELD_DOEL_ANDERE=>'doelAndere',
		self::FIELD_NAAM_AANVRAGER=>'naamAanvrager',
		self::FIELD_DISCIPLINE_AANVRAGER=>'disciplineAanvrager',
		self::FIELD_ORGANISATIE_AANVRAGER=>'organisatieAanvrager',
		self::FIELD_INFO_AANVRAGER=>'infoAanvrager',
		self::FIELD_DRINGEND=>'dringend',
		self::FIELD_STATUS=>'status',
		self::FIELD_REDEN_STATUS=>'redenStatus',
		self::FIELD_OVERLEG_ID=>'overlegId',
		self::FIELD_ONTVANGST=>'ontvangst',
		self::FIELD_BRON=>'bron');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TIMESTAMP=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_RIJKSREGISTER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PATIENT_CODE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GEMEENTE_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_KEUZE_ORGANISATOR=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_REDEN_ORGANISATOR=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ANDERE_REDEN_ORGANISATOR=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ID_ORGANISATOR=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_ID_ORGANISATOR_USER=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DOEL_INFORMEREN=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DOEL_OVERTUIGEN=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DOEL_ORGANISEREN=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DOEL_DEBRIEFEN=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DOEL_BESLISSEN=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DOEL_ANDERE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_NAAM_AANVRAGER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DISCIPLINE_AANVRAGER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ORGANISATIE_AANVRAGER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_INFO_AANVRAGER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DRINGEND=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_STATUS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_REDEN_STATUS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_OVERLEG_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_ONTVANGST=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_BRON=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_TIMESTAMP=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_RIJKSREGISTER=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,11,0,false),
		self::FIELD_PATIENT_CODE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_GEMEENTE_ID=>array(Db2PhpEntity::JDBC_TYPE_SMALLINT,5,0,false),
		self::FIELD_KEUZE_ORGANISATOR=>array(Db2PhpEntity::JDBC_TYPE_CHAR,5,0,false),
		self::FIELD_REDEN_ORGANISATOR=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_ANDERE_REDEN_ORGANISATOR=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_ID_ORGANISATOR=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_ID_ORGANISATOR_USER=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_DOEL_INFORMEREN=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_DOEL_OVERTUIGEN=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_DOEL_ORGANISEREN=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_DOEL_DEBRIEFEN=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_DOEL_BESLISSEN=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_DOEL_ANDERE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_NAAM_AANVRAGER=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,120,0,false),
		self::FIELD_DISCIPLINE_AANVRAGER=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,80,0,false),
		self::FIELD_ORGANISATIE_AANVRAGER=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,false),
		self::FIELD_INFO_AANVRAGER=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,false),
		self::FIELD_DRINGEND=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_STATUS=>array(Db2PhpEntity::JDBC_TYPE_CHAR,20,0,false),
		self::FIELD_REDEN_STATUS=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_OVERLEG_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_ONTVANGST=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_BRON=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_TIMESTAMP=>0,
		self::FIELD_RIJKSREGISTER=>'',
		self::FIELD_PATIENT_CODE=>'',
		self::FIELD_GEMEENTE_ID=>0,
		self::FIELD_KEUZE_ORGANISATOR=>'',
		self::FIELD_REDEN_ORGANISATOR=>'',
		self::FIELD_ANDERE_REDEN_ORGANISATOR=>'',
		self::FIELD_ID_ORGANISATOR=>0,
		self::FIELD_ID_ORGANISATOR_USER=>null,
		self::FIELD_DOEL_INFORMEREN=>0,
		self::FIELD_DOEL_OVERTUIGEN=>0,
		self::FIELD_DOEL_ORGANISEREN=>0,
		self::FIELD_DOEL_DEBRIEFEN=>0,
		self::FIELD_DOEL_BESLISSEN=>0,
		self::FIELD_DOEL_ANDERE=>'',
		self::FIELD_NAAM_AANVRAGER=>'',
		self::FIELD_DISCIPLINE_AANVRAGER=>'',
		self::FIELD_ORGANISATIE_AANVRAGER=>'',
		self::FIELD_INFO_AANVRAGER=>'',
		self::FIELD_DRINGEND=>0,
		self::FIELD_STATUS=>'',
		self::FIELD_REDEN_STATUS=>'',
		self::FIELD_OVERLEG_ID=>null,
		self::FIELD_ONTVANGST=>null,
		self::FIELD_BRON=>null);
	private $id;
	private $timestamp;
	private $rijksregister;
	private $patientCode;
	private $gemeenteId;
	private $keuzeOrganisator;
	private $redenOrganisator;
	private $andereRedenOrganisator;
	private $idOrganisator;
	private $idOrganisatorUser;
	private $doelInformeren;
	private $doelOvertuigen;
	private $doelOrganiseren;
	private $doelDebriefen;
	private $doelBeslissen;
	private $doelAndere;
	private $naamAanvrager;
	private $disciplineAanvrager;
	private $organisatieAanvrager;
	private $infoAanvrager;
	private $dringend;
	private $status;
	private $redenStatus;
	private $overlegId;
	private $ontvangst;
	private $bron;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return AanvraagOverleg
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
	 * set value for timestamp 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @param mixed $timestamp
	 * @return AanvraagOverleg
	 */
	public function &setTimestamp($timestamp) {
		$this->notifyChanged(self::FIELD_TIMESTAMP,$this->timestamp,$timestamp);
		$this->timestamp=$timestamp;
		return $this;
	}

	/**
	 * get value for timestamp 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getTimestamp() {
		return $this->timestamp;
	}

	/**
	 * set value for rijksregister 
	 *
	 * type:VARCHAR,size:11,default:null,index
	 *
	 * @param mixed $rijksregister
	 * @return AanvraagOverleg
	 */
	public function &setRijksregister($rijksregister) {
		$this->notifyChanged(self::FIELD_RIJKSREGISTER,$this->rijksregister,$rijksregister);
		$this->rijksregister=$rijksregister;
		return $this;
	}

	/**
	 * get value for rijksregister 
	 *
	 * type:VARCHAR,size:11,default:null,index
	 *
	 * @return mixed
	 */
	public function getRijksregister() {
		return $this->rijksregister;
	}

	/**
	 * set value for patient_code 
	 *
	 * type:VARCHAR,size:20,default:null,index
	 *
	 * @param mixed $patientCode
	 * @return AanvraagOverleg
	 */
	public function &setPatientCode($patientCode) {
		$this->notifyChanged(self::FIELD_PATIENT_CODE,$this->patientCode,$patientCode);
		$this->patientCode=$patientCode;
		return $this;
	}

	/**
	 * get value for patient_code 
	 *
	 * type:VARCHAR,size:20,default:null,index
	 *
	 * @return mixed
	 */
	public function getPatientCode() {
		return $this->patientCode;
	}

	/**
	 * set value for gemeente_id 
	 *
	 * type:SMALLINT,size:5,default:null,index
	 *
	 * @param mixed $gemeenteId
	 * @return AanvraagOverleg
	 */
	public function &setGemeenteId($gemeenteId) {
		$this->notifyChanged(self::FIELD_GEMEENTE_ID,$this->gemeenteId,$gemeenteId);
		$this->gemeenteId=$gemeenteId;
		return $this;
	}

	/**
	 * get value for gemeente_id 
	 *
	 * type:SMALLINT,size:5,default:null,index
	 *
	 * @return mixed
	 */
	public function getGemeenteId() {
		return $this->gemeenteId;
	}

	/**
	 * set value for keuze_organisator 
	 *
	 * type:ENUM,size:5,default:null
	 *
	 * @param mixed $keuzeOrganisator
	 * @return AanvraagOverleg
	 */
	public function &setKeuzeOrganisator($keuzeOrganisator) {
		$this->notifyChanged(self::FIELD_KEUZE_ORGANISATOR,$this->keuzeOrganisator,$keuzeOrganisator);
		$this->keuzeOrganisator=$keuzeOrganisator;
		return $this;
	}

	/**
	 * get value for keuze_organisator 
	 *
	 * type:ENUM,size:5,default:null
	 *
	 * @return mixed
	 */
	public function getKeuzeOrganisator() {
		return $this->keuzeOrganisator;
	}

	/**
	 * set value for reden_organisator 
	 *
	 * type:VARCHAR,size:255,default:null
	 *
	 * @param mixed $redenOrganisator
	 * @return AanvraagOverleg
	 */
	public function &setRedenOrganisator($redenOrganisator) {
		$this->notifyChanged(self::FIELD_REDEN_ORGANISATOR,$this->redenOrganisator,$redenOrganisator);
		$this->redenOrganisator=$redenOrganisator;
		return $this;
	}

	/**
	 * get value for reden_organisator 
	 *
	 * type:VARCHAR,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getRedenOrganisator() {
		return $this->redenOrganisator;
	}

	/**
	 * set value for andere_reden_organisator 
	 *
	 * type:VARCHAR,size:255,default:null
	 *
	 * @param mixed $andereRedenOrganisator
	 * @return AanvraagOverleg
	 */
	public function &setAndereRedenOrganisator($andereRedenOrganisator) {
		$this->notifyChanged(self::FIELD_ANDERE_REDEN_ORGANISATOR,$this->andereRedenOrganisator,$andereRedenOrganisator);
		$this->andereRedenOrganisator=$andereRedenOrganisator;
		return $this;
	}

	/**
	 * get value for andere_reden_organisator 
	 *
	 * type:VARCHAR,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getAndereRedenOrganisator() {
		return $this->andereRedenOrganisator;
	}

	/**
	 * set value for id_organisator 
	 *
	 * type:INT,size:10,default:null,index
	 *
	 * @param mixed $idOrganisator
	 * @return AanvraagOverleg
	 */
	public function &setIdOrganisator($idOrganisator) {
		$this->notifyChanged(self::FIELD_ID_ORGANISATOR,$this->idOrganisator,$idOrganisator);
		$this->idOrganisator=$idOrganisator;
		return $this;
	}

	/**
	 * get value for id_organisator 
	 *
	 * type:INT,size:10,default:null,index
	 *
	 * @return mixed
	 */
	public function getIdOrganisator() {
		return $this->idOrganisator;
	}

	/**
	 * set value for id_organisator_user 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $idOrganisatorUser
	 * @return AanvraagOverleg
	 */
	public function &setIdOrganisatorUser($idOrganisatorUser) {
		$this->notifyChanged(self::FIELD_ID_ORGANISATOR_USER,$this->idOrganisatorUser,$idOrganisatorUser);
		$this->idOrganisatorUser=$idOrganisatorUser;
		return $this;
	}

	/**
	 * get value for id_organisator_user 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getIdOrganisatorUser() {
		return $this->idOrganisatorUser;
	}

	/**
	 * set value for doel_informeren 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @param mixed $doelInformeren
	 * @return AanvraagOverleg
	 */
	public function &setDoelInformeren($doelInformeren) {
		$this->notifyChanged(self::FIELD_DOEL_INFORMEREN,$this->doelInformeren,$doelInformeren);
		$this->doelInformeren=$doelInformeren;
		return $this;
	}

	/**
	 * get value for doel_informeren 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @return mixed
	 */
	public function getDoelInformeren() {
		return $this->doelInformeren;
	}

	/**
	 * set value for doel_overtuigen 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @param mixed $doelOvertuigen
	 * @return AanvraagOverleg
	 */
	public function &setDoelOvertuigen($doelOvertuigen) {
		$this->notifyChanged(self::FIELD_DOEL_OVERTUIGEN,$this->doelOvertuigen,$doelOvertuigen);
		$this->doelOvertuigen=$doelOvertuigen;
		return $this;
	}

	/**
	 * get value for doel_overtuigen 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @return mixed
	 */
	public function getDoelOvertuigen() {
		return $this->doelOvertuigen;
	}

	/**
	 * set value for doel_organiseren 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @param mixed $doelOrganiseren
	 * @return AanvraagOverleg
	 */
	public function &setDoelOrganiseren($doelOrganiseren) {
		$this->notifyChanged(self::FIELD_DOEL_ORGANISEREN,$this->doelOrganiseren,$doelOrganiseren);
		$this->doelOrganiseren=$doelOrganiseren;
		return $this;
	}

	/**
	 * get value for doel_organiseren 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @return mixed
	 */
	public function getDoelOrganiseren() {
		return $this->doelOrganiseren;
	}

	/**
	 * set value for doel_debriefen 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @param mixed $doelDebriefen
	 * @return AanvraagOverleg
	 */
	public function &setDoelDebriefen($doelDebriefen) {
		$this->notifyChanged(self::FIELD_DOEL_DEBRIEFEN,$this->doelDebriefen,$doelDebriefen);
		$this->doelDebriefen=$doelDebriefen;
		return $this;
	}

	/**
	 * get value for doel_debriefen 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @return mixed
	 */
	public function getDoelDebriefen() {
		return $this->doelDebriefen;
	}

	/**
	 * set value for doel_beslissen 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @param mixed $doelBeslissen
	 * @return AanvraagOverleg
	 */
	public function &setDoelBeslissen($doelBeslissen) {
		$this->notifyChanged(self::FIELD_DOEL_BESLISSEN,$this->doelBeslissen,$doelBeslissen);
		$this->doelBeslissen=$doelBeslissen;
		return $this;
	}

	/**
	 * get value for doel_beslissen 
	 *
	 * type:TINYINT,size:3,default:0
	 *
	 * @return mixed
	 */
	public function getDoelBeslissen() {
		return $this->doelBeslissen;
	}

	/**
	 * set value for doel_andere 
	 *
	 * type:VARCHAR,size:255,default:null
	 *
	 * @param mixed $doelAndere
	 * @return AanvraagOverleg
	 */
	public function &setDoelAndere($doelAndere) {
		$this->notifyChanged(self::FIELD_DOEL_ANDERE,$this->doelAndere,$doelAndere);
		$this->doelAndere=$doelAndere;
		return $this;
	}

	/**
	 * get value for doel_andere 
	 *
	 * type:VARCHAR,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getDoelAndere() {
		return $this->doelAndere;
	}

	/**
	 * set value for naam_aanvrager 
	 *
	 * type:VARCHAR,size:120,default:null
	 *
	 * @param mixed $naamAanvrager
	 * @return AanvraagOverleg
	 */
	public function &setNaamAanvrager($naamAanvrager) {
		$this->notifyChanged(self::FIELD_NAAM_AANVRAGER,$this->naamAanvrager,$naamAanvrager);
		$this->naamAanvrager=$naamAanvrager;
		return $this;
	}

	/**
	 * get value for naam_aanvrager 
	 *
	 * type:VARCHAR,size:120,default:null
	 *
	 * @return mixed
	 */
	public function getNaamAanvrager() {
		return $this->naamAanvrager;
	}

	/**
	 * set value for discipline_aanvrager 
	 *
	 * type:VARCHAR,size:80,default:null
	 *
	 * @param mixed $disciplineAanvrager
	 * @return AanvraagOverleg
	 */
	public function &setDisciplineAanvrager($disciplineAanvrager) {
		$this->notifyChanged(self::FIELD_DISCIPLINE_AANVRAGER,$this->disciplineAanvrager,$disciplineAanvrager);
		$this->disciplineAanvrager=$disciplineAanvrager;
		return $this;
	}

	/**
	 * get value for discipline_aanvrager 
	 *
	 * type:VARCHAR,size:80,default:null
	 *
	 * @return mixed
	 */
	public function getDisciplineAanvrager() {
		return $this->disciplineAanvrager;
	}

	/**
	 * set value for organisatie_aanvrager 
	 *
	 * type:VARCHAR,size:200,default:null
	 *
	 * @param mixed $organisatieAanvrager
	 * @return AanvraagOverleg
	 */
	public function &setOrganisatieAanvrager($organisatieAanvrager) {
		$this->notifyChanged(self::FIELD_ORGANISATIE_AANVRAGER,$this->organisatieAanvrager,$organisatieAanvrager);
		$this->organisatieAanvrager=$organisatieAanvrager;
		return $this;
	}

	/**
	 * get value for organisatie_aanvrager 
	 *
	 * type:VARCHAR,size:200,default:null
	 *
	 * @return mixed
	 */
	public function getOrganisatieAanvrager() {
		return $this->organisatieAanvrager;
	}

	/**
	 * set value for info_aanvrager 
	 *
	 * type:VARCHAR,size:200,default:null
	 *
	 * @param mixed $infoAanvrager
	 * @return AanvraagOverleg
	 */
	public function &setInfoAanvrager($infoAanvrager) {
		$this->notifyChanged(self::FIELD_INFO_AANVRAGER,$this->infoAanvrager,$infoAanvrager);
		$this->infoAanvrager=$infoAanvrager;
		return $this;
	}

	/**
	 * get value for info_aanvrager 
	 *
	 * type:VARCHAR,size:200,default:null
	 *
	 * @return mixed
	 */
	public function getInfoAanvrager() {
		return $this->infoAanvrager;
	}

	/**
	 * set value for dringend 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $dringend
	 * @return AanvraagOverleg
	 */
	public function &setDringend($dringend) {
		$this->notifyChanged(self::FIELD_DRINGEND,$this->dringend,$dringend);
		$this->dringend=$dringend;
		return $this;
	}

	/**
	 * get value for dringend 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getDringend() {
		return $this->dringend;
	}

	/**
	 * set value for status 
	 *
	 * type:ENUM,size:20,default:null
	 *
	 * @param mixed $status
	 * @return AanvraagOverleg
	 */
	public function &setStatus($status) {
		$this->notifyChanged(self::FIELD_STATUS,$this->status,$status);
		$this->status=$status;
		return $this;
	}

	/**
	 * get value for status 
	 *
	 * type:ENUM,size:20,default:null
	 *
	 * @return mixed
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * set value for reden_status 
	 *
	 * type:VARCHAR,size:255,default:null
	 *
	 * @param mixed $redenStatus
	 * @return AanvraagOverleg
	 */
	public function &setRedenStatus($redenStatus) {
		$this->notifyChanged(self::FIELD_REDEN_STATUS,$this->redenStatus,$redenStatus);
		$this->redenStatus=$redenStatus;
		return $this;
	}

	/**
	 * get value for reden_status 
	 *
	 * type:VARCHAR,size:255,default:null
	 *
	 * @return mixed
	 */
	public function getRedenStatus() {
		return $this->redenStatus;
	}

	/**
	 * set value for overleg_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $overlegId
	 * @return AanvraagOverleg
	 */
	public function &setOverlegId($overlegId) {
		$this->notifyChanged(self::FIELD_OVERLEG_ID,$this->overlegId,$overlegId);
		$this->overlegId=$overlegId;
		return $this;
	}

	/**
	 * get value for overleg_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getOverlegId() {
		return $this->overlegId;
	}

	/**
	 * set value for ontvangst 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @param mixed $ontvangst
	 * @return AanvraagOverleg
	 */
	public function &setOntvangst($ontvangst) {
		$this->notifyChanged(self::FIELD_ONTVANGST,$this->ontvangst,$ontvangst);
		$this->ontvangst=$ontvangst;
		return $this;
	}

	/**
	 * get value for ontvangst 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOntvangst() {
		return $this->ontvangst;
	}

	/**
	 * set value for bron 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $bron
	 * @return AanvraagOverleg
	 */
	public function &setBron($bron) {
		$this->notifyChanged(self::FIELD_BRON,$this->bron,$bron);
		$this->bron=$bron;
		return $this;
	}

	/**
	 * get value for bron 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getBron() {
		return $this->bron;
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
			self::FIELD_TIMESTAMP=>$this->getTimestamp(),
			self::FIELD_RIJKSREGISTER=>$this->getRijksregister(),
			self::FIELD_PATIENT_CODE=>$this->getPatientCode(),
			self::FIELD_GEMEENTE_ID=>$this->getGemeenteId(),
			self::FIELD_KEUZE_ORGANISATOR=>$this->getKeuzeOrganisator(),
			self::FIELD_REDEN_ORGANISATOR=>$this->getRedenOrganisator(),
			self::FIELD_ANDERE_REDEN_ORGANISATOR=>$this->getAndereRedenOrganisator(),
			self::FIELD_ID_ORGANISATOR=>$this->getIdOrganisator(),
			self::FIELD_ID_ORGANISATOR_USER=>$this->getIdOrganisatorUser(),
			self::FIELD_DOEL_INFORMEREN=>$this->getDoelInformeren(),
			self::FIELD_DOEL_OVERTUIGEN=>$this->getDoelOvertuigen(),
			self::FIELD_DOEL_ORGANISEREN=>$this->getDoelOrganiseren(),
			self::FIELD_DOEL_DEBRIEFEN=>$this->getDoelDebriefen(),
			self::FIELD_DOEL_BESLISSEN=>$this->getDoelBeslissen(),
			self::FIELD_DOEL_ANDERE=>$this->getDoelAndere(),
			self::FIELD_NAAM_AANVRAGER=>$this->getNaamAanvrager(),
			self::FIELD_DISCIPLINE_AANVRAGER=>$this->getDisciplineAanvrager(),
			self::FIELD_ORGANISATIE_AANVRAGER=>$this->getOrganisatieAanvrager(),
			self::FIELD_INFO_AANVRAGER=>$this->getInfoAanvrager(),
			self::FIELD_DRINGEND=>$this->getDringend(),
			self::FIELD_STATUS=>$this->getStatus(),
			self::FIELD_REDEN_STATUS=>$this->getRedenStatus(),
			self::FIELD_OVERLEG_ID=>$this->getOverlegId(),
			self::FIELD_ONTVANGST=>$this->getOntvangst(),
			self::FIELD_BRON=>$this->getBron());
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
	 * Match by attributes of passed example instance and return matched rows as an array of AanvraagOverleg instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param AanvraagOverleg $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return AanvraagOverleg[]
	 */
	public static function findByExample(PDO $db,AanvraagOverleg $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of AanvraagOverleg instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return AanvraagOverleg[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `aanvraag_overleg`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of AanvraagOverleg instances
	 *
	 * @param PDOStatement $stmt
	 * @return AanvraagOverleg[]
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
	 * returns the result as an array of AanvraagOverleg instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return AanvraagOverleg[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new AanvraagOverleg();
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
	 * Execute select query and return matched rows as an array of AanvraagOverleg instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return AanvraagOverleg[]
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
		$sql='DELETE FROM `aanvraag_overleg`'
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
		$this->setTimestamp($result['timestamp']);
		$this->setRijksregister($result['rijksregister']);
		$this->setPatientCode($result['patient_code']);
		$this->setGemeenteId($result['gemeente_id']);
		$this->setKeuzeOrganisator($result['keuze_organisator']);
		$this->setRedenOrganisator($result['reden_organisator']);
		$this->setAndereRedenOrganisator($result['andere_reden_organisator']);
		$this->setIdOrganisator($result['id_organisator']);
		$this->setIdOrganisatorUser($result['id_organisator_user']);
		$this->setDoelInformeren($result['doel_informeren']);
		$this->setDoelOvertuigen($result['doel_overtuigen']);
		$this->setDoelOrganiseren($result['doel_organiseren']);
		$this->setDoelDebriefen($result['doel_debriefen']);
		$this->setDoelBeslissen($result['doel_beslissen']);
		$this->setDoelAndere($result['doel_andere']);
		$this->setNaamAanvrager($result['naam_aanvrager']);
		$this->setDisciplineAanvrager($result['discipline_aanvrager']);
		$this->setOrganisatieAanvrager($result['organisatie_aanvrager']);
		$this->setInfoAanvrager($result['info_aanvrager']);
		$this->setDringend($result['dringend']);
		$this->setStatus($result['status']);
		$this->setRedenStatus($result['reden_status']);
		$this->setOverlegId($result['overleg_id']);
		$this->setOntvangst($result['ontvangst']);
		$this->setBron($result['bron']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return AanvraagOverleg
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
		$o=new AanvraagOverleg();
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
		$stmt->bindValue(2,$this->getTimestamp());
		$stmt->bindValue(3,$this->getRijksregister());
		$stmt->bindValue(4,$this->getPatientCode());
		$stmt->bindValue(5,$this->getGemeenteId());
		$stmt->bindValue(6,$this->getKeuzeOrganisator());
		$stmt->bindValue(7,$this->getRedenOrganisator());
		$stmt->bindValue(8,$this->getAndereRedenOrganisator());
		$stmt->bindValue(9,$this->getIdOrganisator());
		$stmt->bindValue(10,$this->getIdOrganisatorUser());
		$stmt->bindValue(11,$this->getDoelInformeren());
		$stmt->bindValue(12,$this->getDoelOvertuigen());
		$stmt->bindValue(13,$this->getDoelOrganiseren());
		$stmt->bindValue(14,$this->getDoelDebriefen());
		$stmt->bindValue(15,$this->getDoelBeslissen());
		$stmt->bindValue(16,$this->getDoelAndere());
		$stmt->bindValue(17,$this->getNaamAanvrager());
		$stmt->bindValue(18,$this->getDisciplineAanvrager());
		$stmt->bindValue(19,$this->getOrganisatieAanvrager());
		$stmt->bindValue(20,$this->getInfoAanvrager());
		$stmt->bindValue(21,$this->getDringend());
		$stmt->bindValue(22,$this->getStatus());
		$stmt->bindValue(23,$this->getRedenStatus());
		$stmt->bindValue(24,$this->getOverlegId());
		$stmt->bindValue(25,$this->getOntvangst());
		$stmt->bindValue(26,$this->getBron());
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
			$stmt->bindValue(1,$this->getTimestamp());
			$stmt->bindValue(2,$this->getRijksregister());
			$stmt->bindValue(3,$this->getPatientCode());
			$stmt->bindValue(4,$this->getGemeenteId());
			$stmt->bindValue(5,$this->getKeuzeOrganisator());
			$stmt->bindValue(6,$this->getRedenOrganisator());
			$stmt->bindValue(7,$this->getAndereRedenOrganisator());
			$stmt->bindValue(8,$this->getIdOrganisator());
			$stmt->bindValue(9,$this->getIdOrganisatorUser());
			$stmt->bindValue(10,$this->getDoelInformeren());
			$stmt->bindValue(11,$this->getDoelOvertuigen());
			$stmt->bindValue(12,$this->getDoelOrganiseren());
			$stmt->bindValue(13,$this->getDoelDebriefen());
			$stmt->bindValue(14,$this->getDoelBeslissen());
			$stmt->bindValue(15,$this->getDoelAndere());
			$stmt->bindValue(16,$this->getNaamAanvrager());
			$stmt->bindValue(17,$this->getDisciplineAanvrager());
			$stmt->bindValue(18,$this->getOrganisatieAanvrager());
			$stmt->bindValue(19,$this->getInfoAanvrager());
			$stmt->bindValue(20,$this->getDringend());
			$stmt->bindValue(21,$this->getStatus());
			$stmt->bindValue(22,$this->getRedenStatus());
			$stmt->bindValue(23,$this->getOverlegId());
			$stmt->bindValue(24,$this->getOntvangst());
			$stmt->bindValue(25,$this->getBron());
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
		$stmt->bindValue(27,$this->getId());
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
	 * Fetch Overlegbasis which references this AanvraagOverleg. Will return null in case reference is invalid.
	 * `aanvraag_overleg`.`overleg_id` -> `overlegbasis`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegbasis
	 */
	public function fetchOverlegbasis(PDO $db, $sort=null) {
		$filter=array(Overlegbasis::FIELD_ID=>$this->getOverlegId());
		$result=Overlegbasis::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Gemeente which references this AanvraagOverleg. Will return null in case reference is invalid.
	 * `aanvraag_overleg`.`gemeente_id` -> `gemeente`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Gemeente
	 */
	public function fetchGemeente(PDO $db, $sort=null) {
		$filter=array(Gemeente::FIELD_ID=>$this->getGemeenteId());
		$result=Gemeente::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Hulpverleners which references this AanvraagOverleg. Will return null in case reference is invalid.
	 * `aanvraag_overleg`.`id_organisator` -> `hulpverleners`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Hulpverleners
	 */
	public function fetchHulpverleners(PDO $db, $sort=null) {
		$filter=array(Hulpverleners::FIELD_ID=>$this->getIdOrganisator());
		$result=Hulpverleners::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Patient which references this AanvraagOverleg. Will return null in case reference is invalid.
	 * `aanvraag_overleg`.`patient_code` -> `patient`.`code`
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
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'AanvraagOverleg');
	}

	/**
	 * get single AanvraagOverleg instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return AanvraagOverleg
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new AanvraagOverleg();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of AanvraagOverleg from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return AanvraagOverleg[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('AanvraagOverleg') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>