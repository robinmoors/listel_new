<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class PatientPsy extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='PatientPsy';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='patient_psy';
	const SQL_INSERT='INSERT INTO `patient_psy` (`id`,`code`,`startdatum`,`einddatum`,`stopzetting_text`,`stopzetting_cat`,`tp_nummer`,`hoofddiagnose`,`diagnose_genre`,`nood_begeleidingsplan`,`toename_symptonen`,`ziekenhuis`,`art107`,`ziekenhuis_ander`,`outreach`,`cgg`,`politie`,`domeinen`,`crisissituatie`,`crisis_id`,`crisis_genre`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `patient_psy` (`code`,`startdatum`,`einddatum`,`stopzetting_text`,`stopzetting_cat`,`tp_nummer`,`hoofddiagnose`,`diagnose_genre`,`nood_begeleidingsplan`,`toename_symptonen`,`ziekenhuis`,`art107`,`ziekenhuis_ander`,`outreach`,`cgg`,`politie`,`domeinen`,`crisissituatie`,`crisis_id`,`crisis_genre`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `patient_psy` SET `id`=?,`code`=?,`startdatum`=?,`einddatum`=?,`stopzetting_text`=?,`stopzetting_cat`=?,`tp_nummer`=?,`hoofddiagnose`=?,`diagnose_genre`=?,`nood_begeleidingsplan`=?,`toename_symptonen`=?,`ziekenhuis`=?,`art107`=?,`ziekenhuis_ander`=?,`outreach`=?,`cgg`=?,`politie`=?,`domeinen`=?,`crisissituatie`=?,`crisis_id`=?,`crisis_genre`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `patient_psy` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `patient_psy` WHERE `id`=?';
	const FIELD_ID=1316921773;
	const FIELD_CODE=-1453693441;
	const FIELD_STARTDATUM=-1305766945;
	const FIELD_EINDDATUM=-105196925;
	const FIELD_STOPZETTING_TEXT=-609736343;
	const FIELD_STOPZETTING_CAT=1088693274;
	const FIELD_TP_NUMMER=2037215973;
	const FIELD_HOOFDDIAGNOSE=1776259826;
	const FIELD_DIAGNOSE_GENRE=-1696793260;
	const FIELD_NOOD_BEGELEIDINGSPLAN=-893751642;
	const FIELD_TOENAME_SYMPTONEN=117049495;
	const FIELD_ZIEKENHUIS=359491079;
	const FIELD_ART107=-1189085113;
	const FIELD_ZIEKENHUIS_ANDER=1698387084;
	const FIELD_OUTREACH=1104210423;
	const FIELD_CGG=-2125103567;
	const FIELD_POLITIE=2129180162;
	const FIELD_DOMEINEN=-2129166973;
	const FIELD_CRISISSITUATIE=-676020293;
	const FIELD_CRISIS_ID=-1987812027;
	const FIELD_CRISIS_GENRE=99272985;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_CODE=>'code',
		self::FIELD_STARTDATUM=>'startdatum',
		self::FIELD_EINDDATUM=>'einddatum',
		self::FIELD_STOPZETTING_TEXT=>'stopzetting_text',
		self::FIELD_STOPZETTING_CAT=>'stopzetting_cat',
		self::FIELD_TP_NUMMER=>'tp_nummer',
		self::FIELD_HOOFDDIAGNOSE=>'hoofddiagnose',
		self::FIELD_DIAGNOSE_GENRE=>'diagnose_genre',
		self::FIELD_NOOD_BEGELEIDINGSPLAN=>'nood_begeleidingsplan',
		self::FIELD_TOENAME_SYMPTONEN=>'toename_symptonen',
		self::FIELD_ZIEKENHUIS=>'ziekenhuis',
		self::FIELD_ART107=>'art107',
		self::FIELD_ZIEKENHUIS_ANDER=>'ziekenhuis_ander',
		self::FIELD_OUTREACH=>'outreach',
		self::FIELD_CGG=>'cgg',
		self::FIELD_POLITIE=>'politie',
		self::FIELD_DOMEINEN=>'domeinen',
		self::FIELD_CRISISSITUATIE=>'crisissituatie',
		self::FIELD_CRISIS_ID=>'crisis_id',
		self::FIELD_CRISIS_GENRE=>'crisis_genre');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_CODE=>'code',
		self::FIELD_STARTDATUM=>'startdatum',
		self::FIELD_EINDDATUM=>'einddatum',
		self::FIELD_STOPZETTING_TEXT=>'stopzettingText',
		self::FIELD_STOPZETTING_CAT=>'stopzettingCat',
		self::FIELD_TP_NUMMER=>'tpNummer',
		self::FIELD_HOOFDDIAGNOSE=>'hoofddiagnose',
		self::FIELD_DIAGNOSE_GENRE=>'diagnoseGenre',
		self::FIELD_NOOD_BEGELEIDINGSPLAN=>'noodBegeleidingsplan',
		self::FIELD_TOENAME_SYMPTONEN=>'toenameSymptonen',
		self::FIELD_ZIEKENHUIS=>'ziekenhuis',
		self::FIELD_ART107=>'art107',
		self::FIELD_ZIEKENHUIS_ANDER=>'ziekenhuisAnder',
		self::FIELD_OUTREACH=>'outreach',
		self::FIELD_CGG=>'cgg',
		self::FIELD_POLITIE=>'politie',
		self::FIELD_DOMEINEN=>'domeinen',
		self::FIELD_CRISISSITUATIE=>'crisissituatie',
		self::FIELD_CRISIS_ID=>'crisisId',
		self::FIELD_CRISIS_GENRE=>'crisisGenre');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_CODE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_STARTDATUM=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EINDDATUM=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_STOPZETTING_TEXT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_STOPZETTING_CAT=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TP_NUMMER=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_HOOFDDIAGNOSE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DIAGNOSE_GENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_NOOD_BEGELEIDINGSPLAN=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_TOENAME_SYMPTONEN=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_ZIEKENHUIS=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_ART107=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_ZIEKENHUIS_ANDER=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_OUTREACH=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_CGG=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_POLITIE=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_DOMEINEN=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_CRISISSITUATIE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CRISIS_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_CRISIS_GENRE=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_CODE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,30,0,false),
		self::FIELD_STARTDATUM=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_EINDDATUM=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_STOPZETTING_TEXT=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_STOPZETTING_CAT=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_TP_NUMMER=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_HOOFDDIAGNOSE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,10,0,false),
		self::FIELD_DIAGNOSE_GENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,4,0,false),
		self::FIELD_NOOD_BEGELEIDINGSPLAN=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_TOENAME_SYMPTONEN=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_ZIEKENHUIS=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_ART107=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_ZIEKENHUIS_ANDER=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_OUTREACH=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,true),
		self::FIELD_CGG=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,true),
		self::FIELD_POLITIE=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,true),
		self::FIELD_DOMEINEN=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_CRISISSITUATIE=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,true),
		self::FIELD_CRISIS_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_CRISIS_GENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,10,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_CODE=>'',
		self::FIELD_STARTDATUM=>null,
		self::FIELD_EINDDATUM=>null,
		self::FIELD_STOPZETTING_TEXT=>null,
		self::FIELD_STOPZETTING_CAT=>null,
		self::FIELD_TP_NUMMER=>null,
		self::FIELD_HOOFDDIAGNOSE=>'',
		self::FIELD_DIAGNOSE_GENRE=>'',
		self::FIELD_NOOD_BEGELEIDINGSPLAN=>'',
		self::FIELD_TOENAME_SYMPTONEN=>'',
		self::FIELD_ZIEKENHUIS=>'',
		self::FIELD_ART107=>'',
		self::FIELD_ZIEKENHUIS_ANDER=>'',
		self::FIELD_OUTREACH=>null,
		self::FIELD_CGG=>null,
		self::FIELD_POLITIE=>null,
		self::FIELD_DOMEINEN=>0,
		self::FIELD_CRISISSITUATIE=>null,
		self::FIELD_CRISIS_ID=>null,
		self::FIELD_CRISIS_GENRE=>null);
	private $id;
	private $code;
	private $startdatum;
	private $einddatum;
	private $stopzettingText;
	private $stopzettingCat;
	private $tpNummer;
	private $hoofddiagnose;
	private $diagnoseGenre;
	private $noodBegeleidingsplan;
	private $toenameSymptonen;
	private $ziekenhuis;
	private $art107;
	private $ziekenhuisAnder;
	private $outreach;
	private $cgg;
	private $politie;
	private $domeinen;
	private $crisissituatie;
	private $crisisId;
	private $crisisGenre;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return PatientPsy
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
	 * type:VARCHAR,size:30,default:null,index
	 *
	 * @param mixed $code
	 * @return PatientPsy
	 */
	public function &setCode($code) {
		$this->notifyChanged(self::FIELD_CODE,$this->code,$code);
		$this->code=$code;
		return $this;
	}

	/**
	 * get value for code 
	 *
	 * type:VARCHAR,size:30,default:null,index
	 *
	 * @return mixed
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * set value for startdatum 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $startdatum
	 * @return PatientPsy
	 */
	public function &setStartdatum($startdatum) {
		$this->notifyChanged(self::FIELD_STARTDATUM,$this->startdatum,$startdatum);
		$this->startdatum=$startdatum;
		return $this;
	}

	/**
	 * get value for startdatum 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getStartdatum() {
		return $this->startdatum;
	}

	/**
	 * set value for einddatum 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $einddatum
	 * @return PatientPsy
	 */
	public function &setEinddatum($einddatum) {
		$this->notifyChanged(self::FIELD_EINDDATUM,$this->einddatum,$einddatum);
		$this->einddatum=$einddatum;
		return $this;
	}

	/**
	 * get value for einddatum 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEinddatum() {
		return $this->einddatum;
	}

	/**
	 * set value for stopzetting_text 
	 *
	 * type:TINYTEXT,size:255,default:null,nullable
	 *
	 * @param mixed $stopzettingText
	 * @return PatientPsy
	 */
	public function &setStopzettingText($stopzettingText) {
		$this->notifyChanged(self::FIELD_STOPZETTING_TEXT,$this->stopzettingText,$stopzettingText);
		$this->stopzettingText=$stopzettingText;
		return $this;
	}

	/**
	 * get value for stopzetting_text 
	 *
	 * type:TINYTEXT,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getStopzettingText() {
		return $this->stopzettingText;
	}

	/**
	 * set value for stopzetting_cat 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $stopzettingCat
	 * @return PatientPsy
	 */
	public function &setStopzettingCat($stopzettingCat) {
		$this->notifyChanged(self::FIELD_STOPZETTING_CAT,$this->stopzettingCat,$stopzettingCat);
		$this->stopzettingCat=$stopzettingCat;
		return $this;
	}

	/**
	 * get value for stopzetting_cat 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getStopzettingCat() {
		return $this->stopzettingCat;
	}

	/**
	 * set value for tp_nummer 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $tpNummer
	 * @return PatientPsy
	 */
	public function &setTpNummer($tpNummer) {
		$this->notifyChanged(self::FIELD_TP_NUMMER,$this->tpNummer,$tpNummer);
		$this->tpNummer=$tpNummer;
		return $this;
	}

	/**
	 * get value for tp_nummer 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTpNummer() {
		return $this->tpNummer;
	}

	/**
	 * set value for hoofddiagnose 
	 *
	 * type:VARCHAR,size:10,default:null
	 *
	 * @param mixed $hoofddiagnose
	 * @return PatientPsy
	 */
	public function &setHoofddiagnose($hoofddiagnose) {
		$this->notifyChanged(self::FIELD_HOOFDDIAGNOSE,$this->hoofddiagnose,$hoofddiagnose);
		$this->hoofddiagnose=$hoofddiagnose;
		return $this;
	}

	/**
	 * get value for hoofddiagnose 
	 *
	 * type:VARCHAR,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getHoofddiagnose() {
		return $this->hoofddiagnose;
	}

	/**
	 * set value for diagnose_genre 
	 *
	 * type:ENUM,size:4,default:null
	 *
	 * @param mixed $diagnoseGenre
	 * @return PatientPsy
	 */
	public function &setDiagnoseGenre($diagnoseGenre) {
		$this->notifyChanged(self::FIELD_DIAGNOSE_GENRE,$this->diagnoseGenre,$diagnoseGenre);
		$this->diagnoseGenre=$diagnoseGenre;
		return $this;
	}

	/**
	 * get value for diagnose_genre 
	 *
	 * type:ENUM,size:4,default:null
	 *
	 * @return mixed
	 */
	public function getDiagnoseGenre() {
		return $this->diagnoseGenre;
	}

	/**
	 * set value for nood_begeleidingsplan 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $noodBegeleidingsplan
	 * @return PatientPsy
	 */
	public function &setNoodBegeleidingsplan($noodBegeleidingsplan) {
		$this->notifyChanged(self::FIELD_NOOD_BEGELEIDINGSPLAN,$this->noodBegeleidingsplan,$noodBegeleidingsplan);
		$this->noodBegeleidingsplan=$noodBegeleidingsplan;
		return $this;
	}

	/**
	 * get value for nood_begeleidingsplan 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getNoodBegeleidingsplan() {
		return $this->noodBegeleidingsplan;
	}

	/**
	 * set value for toename_symptonen 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $toenameSymptonen
	 * @return PatientPsy
	 */
	public function &setToenameSymptonen($toenameSymptonen) {
		$this->notifyChanged(self::FIELD_TOENAME_SYMPTONEN,$this->toenameSymptonen,$toenameSymptonen);
		$this->toenameSymptonen=$toenameSymptonen;
		return $this;
	}

	/**
	 * get value for toename_symptonen 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getToenameSymptonen() {
		return $this->toenameSymptonen;
	}

	/**
	 * set value for ziekenhuis 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $ziekenhuis
	 * @return PatientPsy
	 */
	public function &setZiekenhuis($ziekenhuis) {
		$this->notifyChanged(self::FIELD_ZIEKENHUIS,$this->ziekenhuis,$ziekenhuis);
		$this->ziekenhuis=$ziekenhuis;
		return $this;
	}

	/**
	 * get value for ziekenhuis 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getZiekenhuis() {
		return $this->ziekenhuis;
	}

	/**
	 * set value for art107 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $art107
	 * @return PatientPsy
	 */
	public function &setArt107($art107) {
		$this->notifyChanged(self::FIELD_ART107,$this->art107,$art107);
		$this->art107=$art107;
		return $this;
	}

	/**
	 * get value for art107 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getArt107() {
		return $this->art107;
	}

	/**
	 * set value for ziekenhuis_ander 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $ziekenhuisAnder
	 * @return PatientPsy
	 */
	public function &setZiekenhuisAnder($ziekenhuisAnder) {
		$this->notifyChanged(self::FIELD_ZIEKENHUIS_ANDER,$this->ziekenhuisAnder,$ziekenhuisAnder);
		$this->ziekenhuisAnder=$ziekenhuisAnder;
		return $this;
	}

	/**
	 * get value for ziekenhuis_ander 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getZiekenhuisAnder() {
		return $this->ziekenhuisAnder;
	}

	/**
	 * set value for outreach 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @param mixed $outreach
	 * @return PatientPsy
	 */
	public function &setOutreach($outreach) {
		$this->notifyChanged(self::FIELD_OUTREACH,$this->outreach,$outreach);
		$this->outreach=$outreach;
		return $this;
	}

	/**
	 * get value for outreach 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOutreach() {
		return $this->outreach;
	}

	/**
	 * set value for cgg 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @param mixed $cgg
	 * @return PatientPsy
	 */
	public function &setCgg($cgg) {
		$this->notifyChanged(self::FIELD_CGG,$this->cgg,$cgg);
		$this->cgg=$cgg;
		return $this;
	}

	/**
	 * get value for cgg 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCgg() {
		return $this->cgg;
	}

	/**
	 * set value for politie 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @param mixed $politie
	 * @return PatientPsy
	 */
	public function &setPolitie($politie) {
		$this->notifyChanged(self::FIELD_POLITIE,$this->politie,$politie);
		$this->politie=$politie;
		return $this;
	}

	/**
	 * get value for politie 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPolitie() {
		return $this->politie;
	}

	/**
	 * set value for domeinen 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @param mixed $domeinen
	 * @return PatientPsy
	 */
	public function &setDomeinen($domeinen) {
		$this->notifyChanged(self::FIELD_DOMEINEN,$this->domeinen,$domeinen);
		$this->domeinen=$domeinen;
		return $this;
	}

	/**
	 * get value for domeinen 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getDomeinen() {
		return $this->domeinen;
	}

	/**
	 * set value for crisissituatie 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $crisissituatie
	 * @return PatientPsy
	 */
	public function &setCrisissituatie($crisissituatie) {
		$this->notifyChanged(self::FIELD_CRISISSITUATIE,$this->crisissituatie,$crisissituatie);
		$this->crisissituatie=$crisissituatie;
		return $this;
	}

	/**
	 * get value for crisissituatie 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCrisissituatie() {
		return $this->crisissituatie;
	}

	/**
	 * set value for crisis_id 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $crisisId
	 * @return PatientPsy
	 */
	public function &setCrisisId($crisisId) {
		$this->notifyChanged(self::FIELD_CRISIS_ID,$this->crisisId,$crisisId);
		$this->crisisId=$crisisId;
		return $this;
	}

	/**
	 * get value for crisis_id 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCrisisId() {
		return $this->crisisId;
	}

	/**
	 * set value for crisis_genre 
	 *
	 * type:ENUM,size:10,default:null,nullable
	 *
	 * @param mixed $crisisGenre
	 * @return PatientPsy
	 */
	public function &setCrisisGenre($crisisGenre) {
		$this->notifyChanged(self::FIELD_CRISIS_GENRE,$this->crisisGenre,$crisisGenre);
		$this->crisisGenre=$crisisGenre;
		return $this;
	}

	/**
	 * get value for crisis_genre 
	 *
	 * type:ENUM,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCrisisGenre() {
		return $this->crisisGenre;
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
			self::FIELD_STARTDATUM=>$this->getStartdatum(),
			self::FIELD_EINDDATUM=>$this->getEinddatum(),
			self::FIELD_STOPZETTING_TEXT=>$this->getStopzettingText(),
			self::FIELD_STOPZETTING_CAT=>$this->getStopzettingCat(),
			self::FIELD_TP_NUMMER=>$this->getTpNummer(),
			self::FIELD_HOOFDDIAGNOSE=>$this->getHoofddiagnose(),
			self::FIELD_DIAGNOSE_GENRE=>$this->getDiagnoseGenre(),
			self::FIELD_NOOD_BEGELEIDINGSPLAN=>$this->getNoodBegeleidingsplan(),
			self::FIELD_TOENAME_SYMPTONEN=>$this->getToenameSymptonen(),
			self::FIELD_ZIEKENHUIS=>$this->getZiekenhuis(),
			self::FIELD_ART107=>$this->getArt107(),
			self::FIELD_ZIEKENHUIS_ANDER=>$this->getZiekenhuisAnder(),
			self::FIELD_OUTREACH=>$this->getOutreach(),
			self::FIELD_CGG=>$this->getCgg(),
			self::FIELD_POLITIE=>$this->getPolitie(),
			self::FIELD_DOMEINEN=>$this->getDomeinen(),
			self::FIELD_CRISISSITUATIE=>$this->getCrisissituatie(),
			self::FIELD_CRISIS_ID=>$this->getCrisisId(),
			self::FIELD_CRISIS_GENRE=>$this->getCrisisGenre());
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
	 * Match by attributes of passed example instance and return matched rows as an array of PatientPsy instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param PatientPsy $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return PatientPsy[]
	 */
	public static function findByExample(PDO $db,PatientPsy $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of PatientPsy instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return PatientPsy[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `patient_psy`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of PatientPsy instances
	 *
	 * @param PDOStatement $stmt
	 * @return PatientPsy[]
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
	 * returns the result as an array of PatientPsy instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return PatientPsy[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new PatientPsy();
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
	 * Execute select query and return matched rows as an array of PatientPsy instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return PatientPsy[]
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
		$sql='DELETE FROM `patient_psy`'
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
		$this->setStartdatum($result['startdatum']);
		$this->setEinddatum($result['einddatum']);
		$this->setStopzettingText($result['stopzetting_text']);
		$this->setStopzettingCat($result['stopzetting_cat']);
		$this->setTpNummer($result['tp_nummer']);
		$this->setHoofddiagnose($result['hoofddiagnose']);
		$this->setDiagnoseGenre($result['diagnose_genre']);
		$this->setNoodBegeleidingsplan($result['nood_begeleidingsplan']);
		$this->setToenameSymptonen($result['toename_symptonen']);
		$this->setZiekenhuis($result['ziekenhuis']);
		$this->setArt107($result['art107']);
		$this->setZiekenhuisAnder($result['ziekenhuis_ander']);
		$this->setOutreach($result['outreach']);
		$this->setCgg($result['cgg']);
		$this->setPolitie($result['politie']);
		$this->setDomeinen($result['domeinen']);
		$this->setCrisissituatie($result['crisissituatie']);
		$this->setCrisisId($result['crisis_id']);
		$this->setCrisisGenre($result['crisis_genre']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return PatientPsy
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
		$o=new PatientPsy();
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
		$stmt->bindValue(3,$this->getStartdatum());
		$stmt->bindValue(4,$this->getEinddatum());
		$stmt->bindValue(5,$this->getStopzettingText());
		$stmt->bindValue(6,$this->getStopzettingCat());
		$stmt->bindValue(7,$this->getTpNummer());
		$stmt->bindValue(8,$this->getHoofddiagnose());
		$stmt->bindValue(9,$this->getDiagnoseGenre());
		$stmt->bindValue(10,$this->getNoodBegeleidingsplan());
		$stmt->bindValue(11,$this->getToenameSymptonen());
		$stmt->bindValue(12,$this->getZiekenhuis());
		$stmt->bindValue(13,$this->getArt107());
		$stmt->bindValue(14,$this->getZiekenhuisAnder());
		$stmt->bindValue(15,$this->getOutreach());
		$stmt->bindValue(16,$this->getCgg());
		$stmt->bindValue(17,$this->getPolitie());
		$stmt->bindValue(18,$this->getDomeinen());
		$stmt->bindValue(19,$this->getCrisissituatie());
		$stmt->bindValue(20,$this->getCrisisId());
		$stmt->bindValue(21,$this->getCrisisGenre());
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
			$stmt->bindValue(2,$this->getStartdatum());
			$stmt->bindValue(3,$this->getEinddatum());
			$stmt->bindValue(4,$this->getStopzettingText());
			$stmt->bindValue(5,$this->getStopzettingCat());
			$stmt->bindValue(6,$this->getTpNummer());
			$stmt->bindValue(7,$this->getHoofddiagnose());
			$stmt->bindValue(8,$this->getDiagnoseGenre());
			$stmt->bindValue(9,$this->getNoodBegeleidingsplan());
			$stmt->bindValue(10,$this->getToenameSymptonen());
			$stmt->bindValue(11,$this->getZiekenhuis());
			$stmt->bindValue(12,$this->getArt107());
			$stmt->bindValue(13,$this->getZiekenhuisAnder());
			$stmt->bindValue(14,$this->getOutreach());
			$stmt->bindValue(15,$this->getCgg());
			$stmt->bindValue(16,$this->getPolitie());
			$stmt->bindValue(17,$this->getDomeinen());
			$stmt->bindValue(18,$this->getCrisissituatie());
			$stmt->bindValue(19,$this->getCrisisId());
			$stmt->bindValue(20,$this->getCrisisGenre());
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
	 * Fetch Patient which references this PatientPsy. Will return null in case reference is invalid.
	 * `patient_psy`.`code` -> `patient`.`code`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Patient
	 */
	public function fetchPatient(PDO $db, $sort=null) {
		$filter=array(Patient::FIELD_CODE=>$this->getCode());
		$result=Patient::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'PatientPsy');
	}

	/**
	 * get single PatientPsy instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return PatientPsy
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new PatientPsy();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of PatientPsy from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return PatientPsy[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('PatientPsy') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>