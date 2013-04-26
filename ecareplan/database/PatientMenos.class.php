<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class PatientMenos extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='PatientMenos';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='patient_menos';
	const SQL_INSERT='INSERT INTO `patient_menos` (`id`,`patient`,`complexe_verzorging`,`katz`,`diagnose_dementie`,`diagnose`,`edmonton_schaal`,`jonger`,`uitzondering`,`informed_consent`,`meetschaal_dag`,`meetschaal_maand`,`meetschaal_jaar`,`economie`,`hc`,`who`,`zarit`,`afspraken`,`begindatum`,`einddatum`,`reden`,`menos2gdt_vraag`,`menos2gdt_toestemming`,`gdt2menos_vraag`,`gdt2menos_toestemming`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `patient_menos` (`patient`,`complexe_verzorging`,`katz`,`diagnose_dementie`,`diagnose`,`edmonton_schaal`,`jonger`,`uitzondering`,`informed_consent`,`meetschaal_dag`,`meetschaal_maand`,`meetschaal_jaar`,`economie`,`hc`,`who`,`zarit`,`afspraken`,`begindatum`,`einddatum`,`reden`,`menos2gdt_vraag`,`menos2gdt_toestemming`,`gdt2menos_vraag`,`gdt2menos_toestemming`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `patient_menos` SET `id`=?,`patient`=?,`complexe_verzorging`=?,`katz`=?,`diagnose_dementie`=?,`diagnose`=?,`edmonton_schaal`=?,`jonger`=?,`uitzondering`=?,`informed_consent`=?,`meetschaal_dag`=?,`meetschaal_maand`=?,`meetschaal_jaar`=?,`economie`=?,`hc`=?,`who`=?,`zarit`=?,`afspraken`=?,`begindatum`=?,`einddatum`=?,`reden`=?,`menos2gdt_vraag`=?,`menos2gdt_toestemming`=?,`gdt2menos_vraag`=?,`gdt2menos_toestemming`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `patient_menos` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `patient_menos` WHERE `id`=?';
	const FIELD_ID=2113183049;
	const FIELD_PATIENT=-206026857;
	const FIELD_COMPLEXE_VERZORGING=1197963473;
	const FIELD_KATZ=-750560502;
	const FIELD_DIAGNOSE_DEMENTIE=840577582;
	const FIELD_DIAGNOSE=728777580;
	const FIELD_EDMONTON_SCHAAL=-1155633665;
	const FIELD_JONGER=249969689;
	const FIELD_UITZONDERING=1752429976;
	const FIELD_INFORMED_CONSENT=31890513;
	const FIELD_MEETSCHAAL_DAG=-2100330316;
	const FIELD_MEETSCHAAL_MAAND=225504877;
	const FIELD_MEETSCHAAL_JAAR=-685551682;
	const FIELD_ECONOMIE=1848833445;
	const FIELD_HC=2113183017;
	const FIELD_WHO=1084178768;
	const FIELD_ZARIT=-1778688600;
	const FIELD_AFSPRAKEN=367329749;
	const FIELD_BEGINDATUM=-1355213932;
	const FIELD_EINDDATUM=-2133078169;
	const FIELD_REDEN=-1785971188;
	const FIELD_MENOS2GDT_VRAAG=-859445923;
	const FIELD_MENOS2GDT_TOESTEMMING=-1977059910;
	const FIELD_GDT2MENOS_VRAAG=241987997;
	const FIELD_GDT2MENOS_TOESTEMMING=-1723543046;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_PATIENT=>'patient',
		self::FIELD_COMPLEXE_VERZORGING=>'complexe_verzorging',
		self::FIELD_KATZ=>'katz',
		self::FIELD_DIAGNOSE_DEMENTIE=>'diagnose_dementie',
		self::FIELD_DIAGNOSE=>'diagnose',
		self::FIELD_EDMONTON_SCHAAL=>'edmonton_schaal',
		self::FIELD_JONGER=>'jonger',
		self::FIELD_UITZONDERING=>'uitzondering',
		self::FIELD_INFORMED_CONSENT=>'informed_consent',
		self::FIELD_MEETSCHAAL_DAG=>'meetschaal_dag',
		self::FIELD_MEETSCHAAL_MAAND=>'meetschaal_maand',
		self::FIELD_MEETSCHAAL_JAAR=>'meetschaal_jaar',
		self::FIELD_ECONOMIE=>'economie',
		self::FIELD_HC=>'hc',
		self::FIELD_WHO=>'who',
		self::FIELD_ZARIT=>'zarit',
		self::FIELD_AFSPRAKEN=>'afspraken',
		self::FIELD_BEGINDATUM=>'begindatum',
		self::FIELD_EINDDATUM=>'einddatum',
		self::FIELD_REDEN=>'reden',
		self::FIELD_MENOS2GDT_VRAAG=>'menos2gdt_vraag',
		self::FIELD_MENOS2GDT_TOESTEMMING=>'menos2gdt_toestemming',
		self::FIELD_GDT2MENOS_VRAAG=>'gdt2menos_vraag',
		self::FIELD_GDT2MENOS_TOESTEMMING=>'gdt2menos_toestemming');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_PATIENT=>'patient',
		self::FIELD_COMPLEXE_VERZORGING=>'complexeVerzorging',
		self::FIELD_KATZ=>'katz',
		self::FIELD_DIAGNOSE_DEMENTIE=>'diagnoseDementie',
		self::FIELD_DIAGNOSE=>'diagnose',
		self::FIELD_EDMONTON_SCHAAL=>'edmontonSchaal',
		self::FIELD_JONGER=>'jonger',
		self::FIELD_UITZONDERING=>'uitzondering',
		self::FIELD_INFORMED_CONSENT=>'informedConsent',
		self::FIELD_MEETSCHAAL_DAG=>'meetschaalDag',
		self::FIELD_MEETSCHAAL_MAAND=>'meetschaalMaand',
		self::FIELD_MEETSCHAAL_JAAR=>'meetschaalJaar',
		self::FIELD_ECONOMIE=>'economie',
		self::FIELD_HC=>'hc',
		self::FIELD_WHO=>'who',
		self::FIELD_ZARIT=>'zarit',
		self::FIELD_AFSPRAKEN=>'afspraken',
		self::FIELD_BEGINDATUM=>'begindatum',
		self::FIELD_EINDDATUM=>'einddatum',
		self::FIELD_REDEN=>'reden',
		self::FIELD_MENOS2GDT_VRAAG=>'menos2gdtVraag',
		self::FIELD_MENOS2GDT_TOESTEMMING=>'menos2gdtToestemming',
		self::FIELD_GDT2MENOS_VRAAG=>'gdt2menosVraag',
		self::FIELD_GDT2MENOS_TOESTEMMING=>'gdt2menosToestemming');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_PATIENT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_COMPLEXE_VERZORGING=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_KATZ=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DIAGNOSE_DEMENTIE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DIAGNOSE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EDMONTON_SCHAAL=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_JONGER=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_UITZONDERING=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_INFORMED_CONSENT=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MEETSCHAAL_DAG=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MEETSCHAAL_MAAND=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MEETSCHAAL_JAAR=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_ECONOMIE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_HC=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_WHO=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_ZARIT=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_AFSPRAKEN=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_BEGINDATUM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EINDDATUM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_REDEN=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_MENOS2GDT_VRAAG=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MENOS2GDT_TOESTEMMING=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_GDT2MENOS_VRAAG=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_GDT2MENOS_TOESTEMMING=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_PATIENT=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_COMPLEXE_VERZORGING=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_KATZ=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,true),
		self::FIELD_DIAGNOSE_DEMENTIE=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,true),
		self::FIELD_DIAGNOSE=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,true),
		self::FIELD_EDMONTON_SCHAAL=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,true),
		self::FIELD_JONGER=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,true),
		self::FIELD_UITZONDERING=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_INFORMED_CONSENT=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_MEETSCHAAL_DAG=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_MEETSCHAAL_MAAND=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_MEETSCHAAL_JAAR=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_ECONOMIE=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_HC=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_WHO=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_ZARIT=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_AFSPRAKEN=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,true),
		self::FIELD_BEGINDATUM=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,false),
		self::FIELD_EINDDATUM=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,true),
		self::FIELD_REDEN=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,true),
		self::FIELD_MENOS2GDT_VRAAG=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_MENOS2GDT_TOESTEMMING=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_GDT2MENOS_VRAAG=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_GDT2MENOS_TOESTEMMING=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_PATIENT=>'',
		self::FIELD_COMPLEXE_VERZORGING=>null,
		self::FIELD_KATZ=>null,
		self::FIELD_DIAGNOSE_DEMENTIE=>null,
		self::FIELD_DIAGNOSE=>null,
		self::FIELD_EDMONTON_SCHAAL=>null,
		self::FIELD_JONGER=>null,
		self::FIELD_UITZONDERING=>0,
		self::FIELD_INFORMED_CONSENT=>0,
		self::FIELD_MEETSCHAAL_DAG=>0,
		self::FIELD_MEETSCHAAL_MAAND=>0,
		self::FIELD_MEETSCHAAL_JAAR=>0,
		self::FIELD_ECONOMIE=>0,
		self::FIELD_HC=>0,
		self::FIELD_WHO=>0,
		self::FIELD_ZARIT=>0,
		self::FIELD_AFSPRAKEN=>null,
		self::FIELD_BEGINDATUM=>'',
		self::FIELD_EINDDATUM=>null,
		self::FIELD_REDEN=>null,
		self::FIELD_MENOS2GDT_VRAAG=>1,
		self::FIELD_MENOS2GDT_TOESTEMMING=>1,
		self::FIELD_GDT2MENOS_VRAAG=>1,
		self::FIELD_GDT2MENOS_TOESTEMMING=>1);
	private $id;
	private $patient;
	private $complexeVerzorging;
	private $katz;
	private $diagnoseDementie;
	private $diagnose;
	private $edmontonSchaal;
	private $jonger;
	private $uitzondering;
	private $informedConsent;
	private $meetschaalDag;
	private $meetschaalMaand;
	private $meetschaalJaar;
	private $economie;
	private $hc;
	private $who;
	private $zarit;
	private $afspraken;
	private $begindatum;
	private $einddatum;
	private $reden;
	private $menos2gdtVraag;
	private $menos2gdtToestemming;
	private $gdt2menosVraag;
	private $gdt2menosToestemming;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return PatientMenos
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
	 * set value for patient 
	 *
	 * type:VARCHAR,size:20,default:null,index
	 *
	 * @param mixed $patient
	 * @return PatientMenos
	 */
	public function &setPatient($patient) {
		$this->notifyChanged(self::FIELD_PATIENT,$this->patient,$patient);
		$this->patient=$patient;
		return $this;
	}

	/**
	 * get value for patient 
	 *
	 * type:VARCHAR,size:20,default:null,index
	 *
	 * @return mixed
	 */
	public function getPatient() {
		return $this->patient;
	}

	/**
	 * set value for complexe_verzorging 
	 *
	 * type:TINYTEXT,size:255,default:null,nullable
	 *
	 * @param mixed $complexeVerzorging
	 * @return PatientMenos
	 */
	public function &setComplexeVerzorging($complexeVerzorging) {
		$this->notifyChanged(self::FIELD_COMPLEXE_VERZORGING,$this->complexeVerzorging,$complexeVerzorging);
		$this->complexeVerzorging=$complexeVerzorging;
		return $this;
	}

	/**
	 * get value for complexe_verzorging 
	 *
	 * type:TINYTEXT,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getComplexeVerzorging() {
		return $this->complexeVerzorging;
	}

	/**
	 * set value for katz 
	 *
	 * type:ENUM,size:2,default:null,nullable
	 *
	 * @param mixed $katz
	 * @return PatientMenos
	 */
	public function &setKatz($katz) {
		$this->notifyChanged(self::FIELD_KATZ,$this->katz,$katz);
		$this->katz=$katz;
		return $this;
	}

	/**
	 * get value for katz 
	 *
	 * type:ENUM,size:2,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getKatz() {
		return $this->katz;
	}

	/**
	 * set value for diagnose_dementie 
	 *
	 * type:TINYINT,size:3,default:null,nullable
	 *
	 * @param mixed $diagnoseDementie
	 * @return PatientMenos
	 */
	public function &setDiagnoseDementie($diagnoseDementie) {
		$this->notifyChanged(self::FIELD_DIAGNOSE_DEMENTIE,$this->diagnoseDementie,$diagnoseDementie);
		$this->diagnoseDementie=$diagnoseDementie;
		return $this;
	}

	/**
	 * get value for diagnose_dementie 
	 *
	 * type:TINYINT,size:3,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDiagnoseDementie() {
		return $this->diagnoseDementie;
	}

	/**
	 * set value for diagnose 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $diagnose
	 * @return PatientMenos
	 */
	public function &setDiagnose($diagnose) {
		$this->notifyChanged(self::FIELD_DIAGNOSE,$this->diagnose,$diagnose);
		$this->diagnose=$diagnose;
		return $this;
	}

	/**
	 * get value for diagnose 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDiagnose() {
		return $this->diagnose;
	}

	/**
	 * set value for edmonton_schaal 
	 *
	 * type:TINYINT,size:3,default:null,nullable
	 *
	 * @param mixed $edmontonSchaal
	 * @return PatientMenos
	 */
	public function &setEdmontonSchaal($edmontonSchaal) {
		$this->notifyChanged(self::FIELD_EDMONTON_SCHAAL,$this->edmontonSchaal,$edmontonSchaal);
		$this->edmontonSchaal=$edmontonSchaal;
		return $this;
	}

	/**
	 * get value for edmonton_schaal 
	 *
	 * type:TINYINT,size:3,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEdmontonSchaal() {
		return $this->edmontonSchaal;
	}

	/**
	 * set value for jonger 
	 *
	 * type:TINYINT,size:3,default:null,nullable
	 *
	 * @param mixed $jonger
	 * @return PatientMenos
	 */
	public function &setJonger($jonger) {
		$this->notifyChanged(self::FIELD_JONGER,$this->jonger,$jonger);
		$this->jonger=$jonger;
		return $this;
	}

	/**
	 * get value for jonger 
	 *
	 * type:TINYINT,size:3,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getJonger() {
		return $this->jonger;
	}

	/**
	 * set value for uitzondering 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $uitzondering
	 * @return PatientMenos
	 */
	public function &setUitzondering($uitzondering) {
		$this->notifyChanged(self::FIELD_UITZONDERING,$this->uitzondering,$uitzondering);
		$this->uitzondering=$uitzondering;
		return $this;
	}

	/**
	 * get value for uitzondering 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getUitzondering() {
		return $this->uitzondering;
	}

	/**
	 * set value for informed_consent 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $informedConsent
	 * @return PatientMenos
	 */
	public function &setInformedConsent($informedConsent) {
		$this->notifyChanged(self::FIELD_INFORMED_CONSENT,$this->informedConsent,$informedConsent);
		$this->informedConsent=$informedConsent;
		return $this;
	}

	/**
	 * get value for informed_consent 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getInformedConsent() {
		return $this->informedConsent;
	}

	/**
	 * set value for meetschaal_dag 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @param mixed $meetschaalDag
	 * @return PatientMenos
	 */
	public function &setMeetschaalDag($meetschaalDag) {
		$this->notifyChanged(self::FIELD_MEETSCHAAL_DAG,$this->meetschaalDag,$meetschaalDag);
		$this->meetschaalDag=$meetschaalDag;
		return $this;
	}

	/**
	 * get value for meetschaal_dag 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getMeetschaalDag() {
		return $this->meetschaalDag;
	}

	/**
	 * set value for meetschaal_maand 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @param mixed $meetschaalMaand
	 * @return PatientMenos
	 */
	public function &setMeetschaalMaand($meetschaalMaand) {
		$this->notifyChanged(self::FIELD_MEETSCHAAL_MAAND,$this->meetschaalMaand,$meetschaalMaand);
		$this->meetschaalMaand=$meetschaalMaand;
		return $this;
	}

	/**
	 * get value for meetschaal_maand 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getMeetschaalMaand() {
		return $this->meetschaalMaand;
	}

	/**
	 * set value for meetschaal_jaar 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @param mixed $meetschaalJaar
	 * @return PatientMenos
	 */
	public function &setMeetschaalJaar($meetschaalJaar) {
		$this->notifyChanged(self::FIELD_MEETSCHAAL_JAAR,$this->meetschaalJaar,$meetschaalJaar);
		$this->meetschaalJaar=$meetschaalJaar;
		return $this;
	}

	/**
	 * get value for meetschaal_jaar 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getMeetschaalJaar() {
		return $this->meetschaalJaar;
	}

	/**
	 * set value for economie 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $economie
	 * @return PatientMenos
	 */
	public function &setEconomie($economie) {
		$this->notifyChanged(self::FIELD_ECONOMIE,$this->economie,$economie);
		$this->economie=$economie;
		return $this;
	}

	/**
	 * get value for economie 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getEconomie() {
		return $this->economie;
	}

	/**
	 * set value for hc 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $hc
	 * @return PatientMenos
	 */
	public function &setHc($hc) {
		$this->notifyChanged(self::FIELD_HC,$this->hc,$hc);
		$this->hc=$hc;
		return $this;
	}

	/**
	 * get value for hc 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getHc() {
		return $this->hc;
	}

	/**
	 * set value for who 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $who
	 * @return PatientMenos
	 */
	public function &setWho($who) {
		$this->notifyChanged(self::FIELD_WHO,$this->who,$who);
		$this->who=$who;
		return $this;
	}

	/**
	 * get value for who 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getWho() {
		return $this->who;
	}

	/**
	 * set value for zarit 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @param mixed $zarit
	 * @return PatientMenos
	 */
	public function &setZarit($zarit) {
		$this->notifyChanged(self::FIELD_ZARIT,$this->zarit,$zarit);
		$this->zarit=$zarit;
		return $this;
	}

	/**
	 * get value for zarit 
	 *
	 * type:TINYINT,size:3,default:null
	 *
	 * @return mixed
	 */
	public function getZarit() {
		return $this->zarit;
	}

	/**
	 * set value for afspraken 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $afspraken
	 * @return PatientMenos
	 */
	public function &setAfspraken($afspraken) {
		$this->notifyChanged(self::FIELD_AFSPRAKEN,$this->afspraken,$afspraken);
		$this->afspraken=$afspraken;
		return $this;
	}

	/**
	 * get value for afspraken 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAfspraken() {
		return $this->afspraken;
	}

	/**
	 * set value for begindatum 
	 *
	 * type:DATE,size:10,default:null
	 *
	 * @param mixed $begindatum
	 * @return PatientMenos
	 */
	public function &setBegindatum($begindatum) {
		$this->notifyChanged(self::FIELD_BEGINDATUM,$this->begindatum,$begindatum);
		$this->begindatum=$begindatum;
		return $this;
	}

	/**
	 * get value for begindatum 
	 *
	 * type:DATE,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getBegindatum() {
		return $this->begindatum;
	}

	/**
	 * set value for einddatum 
	 *
	 * type:DATE,size:10,default:null,nullable
	 *
	 * @param mixed $einddatum
	 * @return PatientMenos
	 */
	public function &setEinddatum($einddatum) {
		$this->notifyChanged(self::FIELD_EINDDATUM,$this->einddatum,$einddatum);
		$this->einddatum=$einddatum;
		return $this;
	}

	/**
	 * get value for einddatum 
	 *
	 * type:DATE,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEinddatum() {
		return $this->einddatum;
	}

	/**
	 * set value for reden 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $reden
	 * @return PatientMenos
	 */
	public function &setReden($reden) {
		$this->notifyChanged(self::FIELD_REDEN,$this->reden,$reden);
		$this->reden=$reden;
		return $this;
	}

	/**
	 * get value for reden 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getReden() {
		return $this->reden;
	}

	/**
	 * set value for menos2gdt_vraag 
	 *
	 * type:TINYINT,size:3,default:1
	 *
	 * @param mixed $menos2gdtVraag
	 * @return PatientMenos
	 */
	public function &setMenos2gdtVraag($menos2gdtVraag) {
		$this->notifyChanged(self::FIELD_MENOS2GDT_VRAAG,$this->menos2gdtVraag,$menos2gdtVraag);
		$this->menos2gdtVraag=$menos2gdtVraag;
		return $this;
	}

	/**
	 * get value for menos2gdt_vraag 
	 *
	 * type:TINYINT,size:3,default:1
	 *
	 * @return mixed
	 */
	public function getMenos2gdtVraag() {
		return $this->menos2gdtVraag;
	}

	/**
	 * set value for menos2gdt_toestemming 
	 *
	 * type:TINYINT,size:3,default:1
	 *
	 * @param mixed $menos2gdtToestemming
	 * @return PatientMenos
	 */
	public function &setMenos2gdtToestemming($menos2gdtToestemming) {
		$this->notifyChanged(self::FIELD_MENOS2GDT_TOESTEMMING,$this->menos2gdtToestemming,$menos2gdtToestemming);
		$this->menos2gdtToestemming=$menos2gdtToestemming;
		return $this;
	}

	/**
	 * get value for menos2gdt_toestemming 
	 *
	 * type:TINYINT,size:3,default:1
	 *
	 * @return mixed
	 */
	public function getMenos2gdtToestemming() {
		return $this->menos2gdtToestemming;
	}

	/**
	 * set value for gdt2menos_vraag 
	 *
	 * type:TINYINT,size:3,default:1
	 *
	 * @param mixed $gdt2menosVraag
	 * @return PatientMenos
	 */
	public function &setGdt2menosVraag($gdt2menosVraag) {
		$this->notifyChanged(self::FIELD_GDT2MENOS_VRAAG,$this->gdt2menosVraag,$gdt2menosVraag);
		$this->gdt2menosVraag=$gdt2menosVraag;
		return $this;
	}

	/**
	 * get value for gdt2menos_vraag 
	 *
	 * type:TINYINT,size:3,default:1
	 *
	 * @return mixed
	 */
	public function getGdt2menosVraag() {
		return $this->gdt2menosVraag;
	}

	/**
	 * set value for gdt2menos_toestemming 
	 *
	 * type:TINYINT,size:3,default:1
	 *
	 * @param mixed $gdt2menosToestemming
	 * @return PatientMenos
	 */
	public function &setGdt2menosToestemming($gdt2menosToestemming) {
		$this->notifyChanged(self::FIELD_GDT2MENOS_TOESTEMMING,$this->gdt2menosToestemming,$gdt2menosToestemming);
		$this->gdt2menosToestemming=$gdt2menosToestemming;
		return $this;
	}

	/**
	 * get value for gdt2menos_toestemming 
	 *
	 * type:TINYINT,size:3,default:1
	 *
	 * @return mixed
	 */
	public function getGdt2menosToestemming() {
		return $this->gdt2menosToestemming;
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
			self::FIELD_PATIENT=>$this->getPatient(),
			self::FIELD_COMPLEXE_VERZORGING=>$this->getComplexeVerzorging(),
			self::FIELD_KATZ=>$this->getKatz(),
			self::FIELD_DIAGNOSE_DEMENTIE=>$this->getDiagnoseDementie(),
			self::FIELD_DIAGNOSE=>$this->getDiagnose(),
			self::FIELD_EDMONTON_SCHAAL=>$this->getEdmontonSchaal(),
			self::FIELD_JONGER=>$this->getJonger(),
			self::FIELD_UITZONDERING=>$this->getUitzondering(),
			self::FIELD_INFORMED_CONSENT=>$this->getInformedConsent(),
			self::FIELD_MEETSCHAAL_DAG=>$this->getMeetschaalDag(),
			self::FIELD_MEETSCHAAL_MAAND=>$this->getMeetschaalMaand(),
			self::FIELD_MEETSCHAAL_JAAR=>$this->getMeetschaalJaar(),
			self::FIELD_ECONOMIE=>$this->getEconomie(),
			self::FIELD_HC=>$this->getHc(),
			self::FIELD_WHO=>$this->getWho(),
			self::FIELD_ZARIT=>$this->getZarit(),
			self::FIELD_AFSPRAKEN=>$this->getAfspraken(),
			self::FIELD_BEGINDATUM=>$this->getBegindatum(),
			self::FIELD_EINDDATUM=>$this->getEinddatum(),
			self::FIELD_REDEN=>$this->getReden(),
			self::FIELD_MENOS2GDT_VRAAG=>$this->getMenos2gdtVraag(),
			self::FIELD_MENOS2GDT_TOESTEMMING=>$this->getMenos2gdtToestemming(),
			self::FIELD_GDT2MENOS_VRAAG=>$this->getGdt2menosVraag(),
			self::FIELD_GDT2MENOS_TOESTEMMING=>$this->getGdt2menosToestemming());
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
	 * Match by attributes of passed example instance and return matched rows as an array of PatientMenos instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param PatientMenos $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return PatientMenos[]
	 */
	public static function findByExample(PDO $db,PatientMenos $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of PatientMenos instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return PatientMenos[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `patient_menos`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of PatientMenos instances
	 *
	 * @param PDOStatement $stmt
	 * @return PatientMenos[]
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
	 * returns the result as an array of PatientMenos instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return PatientMenos[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new PatientMenos();
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
	 * Execute select query and return matched rows as an array of PatientMenos instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return PatientMenos[]
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
		$sql='DELETE FROM `patient_menos`'
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
		$this->setPatient($result['patient']);
		$this->setComplexeVerzorging($result['complexe_verzorging']);
		$this->setKatz($result['katz']);
		$this->setDiagnoseDementie($result['diagnose_dementie']);
		$this->setDiagnose($result['diagnose']);
		$this->setEdmontonSchaal($result['edmonton_schaal']);
		$this->setJonger($result['jonger']);
		$this->setUitzondering($result['uitzondering']);
		$this->setInformedConsent($result['informed_consent']);
		$this->setMeetschaalDag($result['meetschaal_dag']);
		$this->setMeetschaalMaand($result['meetschaal_maand']);
		$this->setMeetschaalJaar($result['meetschaal_jaar']);
		$this->setEconomie($result['economie']);
		$this->setHc($result['hc']);
		$this->setWho($result['who']);
		$this->setZarit($result['zarit']);
		$this->setAfspraken($result['afspraken']);
		$this->setBegindatum($result['begindatum']);
		$this->setEinddatum($result['einddatum']);
		$this->setReden($result['reden']);
		$this->setMenos2gdtVraag($result['menos2gdt_vraag']);
		$this->setMenos2gdtToestemming($result['menos2gdt_toestemming']);
		$this->setGdt2menosVraag($result['gdt2menos_vraag']);
		$this->setGdt2menosToestemming($result['gdt2menos_toestemming']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return PatientMenos
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
		$o=new PatientMenos();
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
		$stmt->bindValue(2,$this->getPatient());
		$stmt->bindValue(3,$this->getComplexeVerzorging());
		$stmt->bindValue(4,$this->getKatz());
		$stmt->bindValue(5,$this->getDiagnoseDementie());
		$stmt->bindValue(6,$this->getDiagnose());
		$stmt->bindValue(7,$this->getEdmontonSchaal());
		$stmt->bindValue(8,$this->getJonger());
		$stmt->bindValue(9,$this->getUitzondering());
		$stmt->bindValue(10,$this->getInformedConsent());
		$stmt->bindValue(11,$this->getMeetschaalDag());
		$stmt->bindValue(12,$this->getMeetschaalMaand());
		$stmt->bindValue(13,$this->getMeetschaalJaar());
		$stmt->bindValue(14,$this->getEconomie());
		$stmt->bindValue(15,$this->getHc());
		$stmt->bindValue(16,$this->getWho());
		$stmt->bindValue(17,$this->getZarit());
		$stmt->bindValue(18,$this->getAfspraken());
		$stmt->bindValue(19,$this->getBegindatum());
		$stmt->bindValue(20,$this->getEinddatum());
		$stmt->bindValue(21,$this->getReden());
		$stmt->bindValue(22,$this->getMenos2gdtVraag());
		$stmt->bindValue(23,$this->getMenos2gdtToestemming());
		$stmt->bindValue(24,$this->getGdt2menosVraag());
		$stmt->bindValue(25,$this->getGdt2menosToestemming());
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
			$stmt->bindValue(1,$this->getPatient());
			$stmt->bindValue(2,$this->getComplexeVerzorging());
			$stmt->bindValue(3,$this->getKatz());
			$stmt->bindValue(4,$this->getDiagnoseDementie());
			$stmt->bindValue(5,$this->getDiagnose());
			$stmt->bindValue(6,$this->getEdmontonSchaal());
			$stmt->bindValue(7,$this->getJonger());
			$stmt->bindValue(8,$this->getUitzondering());
			$stmt->bindValue(9,$this->getInformedConsent());
			$stmt->bindValue(10,$this->getMeetschaalDag());
			$stmt->bindValue(11,$this->getMeetschaalMaand());
			$stmt->bindValue(12,$this->getMeetschaalJaar());
			$stmt->bindValue(13,$this->getEconomie());
			$stmt->bindValue(14,$this->getHc());
			$stmt->bindValue(15,$this->getWho());
			$stmt->bindValue(16,$this->getZarit());
			$stmt->bindValue(17,$this->getAfspraken());
			$stmt->bindValue(18,$this->getBegindatum());
			$stmt->bindValue(19,$this->getEinddatum());
			$stmt->bindValue(20,$this->getReden());
			$stmt->bindValue(21,$this->getMenos2gdtVraag());
			$stmt->bindValue(22,$this->getMenos2gdtToestemming());
			$stmt->bindValue(23,$this->getGdt2menosVraag());
			$stmt->bindValue(24,$this->getGdt2menosToestemming());
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
		$stmt->bindValue(26,$this->getId());
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
	 * Fetch Patient which references this PatientMenos. Will return null in case reference is invalid.
	 * `patient_menos`.`patient` -> `patient`.`code`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Patient
	 */
	public function fetchPatient(PDO $db, $sort=null) {
		$filter=array(Patient::FIELD_CODE=>$this->getPatient());
		$result=Patient::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'PatientMenos');
	}

	/**
	 * get single PatientMenos instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return PatientMenos
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new PatientMenos();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of PatientMenos from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return PatientMenos[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('PatientMenos') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>