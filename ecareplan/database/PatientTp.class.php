<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class PatientTp extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='PatientTp';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='patient_tp';
	const SQL_INSERT='INSERT INTO `patient_tp` (`id`,`patient`,`project`,`begindatum`,`einddatum`,`omschrijving`,`hoofddiagnose`,`diagnosegenre`,`secundairediagnose`,`aanvullend1`,`aanvullend2`,`aanvullend3`,`aanvullend4`,`aanvullend5`,`aanvullend6`,`aanvullend7`,`aanvullend8`,`opname_overige`,`toestemming`,`rechtenOC`,`in_email`,`in_print`,`uit_email`,`uit_print`,`stopzetting_text`,`stopzetting_cat`,`actief`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `patient_tp` (`patient`,`project`,`begindatum`,`einddatum`,`omschrijving`,`hoofddiagnose`,`diagnosegenre`,`secundairediagnose`,`aanvullend1`,`aanvullend2`,`aanvullend3`,`aanvullend4`,`aanvullend5`,`aanvullend6`,`aanvullend7`,`aanvullend8`,`opname_overige`,`toestemming`,`rechtenOC`,`in_email`,`in_print`,`uit_email`,`uit_print`,`stopzetting_text`,`stopzetting_cat`,`actief`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `patient_tp` SET `id`=?,`patient`=?,`project`=?,`begindatum`=?,`einddatum`=?,`omschrijving`=?,`hoofddiagnose`=?,`diagnosegenre`=?,`secundairediagnose`=?,`aanvullend1`=?,`aanvullend2`=?,`aanvullend3`=?,`aanvullend4`=?,`aanvullend5`=?,`aanvullend6`=?,`aanvullend7`=?,`aanvullend8`=?,`opname_overige`=?,`toestemming`=?,`rechtenOC`=?,`in_email`=?,`in_print`=?,`uit_email`=?,`uit_print`=?,`stopzetting_text`=?,`stopzetting_cat`=?,`actief`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `patient_tp` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `patient_tp` WHERE `id`=?';
	const FIELD_ID=-1339457517;
	const FIELD_PATIENT=32740109;
	const FIELD_PROJECT=514847521;
	const FIELD_BEGINDATUM=-714372002;
	const FIELD_EINDDATUM=-311290531;
	const FIELD_OMSCHRIJVING=-1339680387;
	const FIELD_HOOFDDIAGNOSE=1478875340;
	const FIELD_DIAGNOSEGENRE=-1730255731;
	const FIELD_SECUNDAIREDIAGNOSE=-488150517;
	const FIELD_AANVULLEND1=1188057611;
	const FIELD_AANVULLEND2=1188057612;
	const FIELD_AANVULLEND3=1188057613;
	const FIELD_AANVULLEND4=1188057614;
	const FIELD_AANVULLEND5=1188057615;
	const FIELD_AANVULLEND6=1188057616;
	const FIELD_AANVULLEND7=1188057617;
	const FIELD_AANVULLEND8=1188057618;
	const FIELD_OPNAME_OVERIGE=-239099048;
	const FIELD_TOESTEMMING=16505328;
	const FIELD_RECHTENOC=-1757869599;
	const FIELD_IN_EMAIL=-251861766;
	const FIELD_IN_PRINT=-241546229;
	const FIELD_UIT_EMAIL=1722380549;
	const FIELD_UIT_PRINT=1732696086;
	const FIELD_STOPZETTING_TEXT=526572879;
	const FIELD_STOPZETTING_CAT=-1229956236;
	const FIELD_ACTIEF=1928770544;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_PATIENT=>'patient',
		self::FIELD_PROJECT=>'project',
		self::FIELD_BEGINDATUM=>'begindatum',
		self::FIELD_EINDDATUM=>'einddatum',
		self::FIELD_OMSCHRIJVING=>'omschrijving',
		self::FIELD_HOOFDDIAGNOSE=>'hoofddiagnose',
		self::FIELD_DIAGNOSEGENRE=>'diagnosegenre',
		self::FIELD_SECUNDAIREDIAGNOSE=>'secundairediagnose',
		self::FIELD_AANVULLEND1=>'aanvullend1',
		self::FIELD_AANVULLEND2=>'aanvullend2',
		self::FIELD_AANVULLEND3=>'aanvullend3',
		self::FIELD_AANVULLEND4=>'aanvullend4',
		self::FIELD_AANVULLEND5=>'aanvullend5',
		self::FIELD_AANVULLEND6=>'aanvullend6',
		self::FIELD_AANVULLEND7=>'aanvullend7',
		self::FIELD_AANVULLEND8=>'aanvullend8',
		self::FIELD_OPNAME_OVERIGE=>'opname_overige',
		self::FIELD_TOESTEMMING=>'toestemming',
		self::FIELD_RECHTENOC=>'rechtenOC',
		self::FIELD_IN_EMAIL=>'in_email',
		self::FIELD_IN_PRINT=>'in_print',
		self::FIELD_UIT_EMAIL=>'uit_email',
		self::FIELD_UIT_PRINT=>'uit_print',
		self::FIELD_STOPZETTING_TEXT=>'stopzetting_text',
		self::FIELD_STOPZETTING_CAT=>'stopzetting_cat',
		self::FIELD_ACTIEF=>'actief');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_PATIENT=>'patient',
		self::FIELD_PROJECT=>'project',
		self::FIELD_BEGINDATUM=>'begindatum',
		self::FIELD_EINDDATUM=>'einddatum',
		self::FIELD_OMSCHRIJVING=>'omschrijving',
		self::FIELD_HOOFDDIAGNOSE=>'hoofddiagnose',
		self::FIELD_DIAGNOSEGENRE=>'diagnosegenre',
		self::FIELD_SECUNDAIREDIAGNOSE=>'secundairediagnose',
		self::FIELD_AANVULLEND1=>'aanvullend1',
		self::FIELD_AANVULLEND2=>'aanvullend2',
		self::FIELD_AANVULLEND3=>'aanvullend3',
		self::FIELD_AANVULLEND4=>'aanvullend4',
		self::FIELD_AANVULLEND5=>'aanvullend5',
		self::FIELD_AANVULLEND6=>'aanvullend6',
		self::FIELD_AANVULLEND7=>'aanvullend7',
		self::FIELD_AANVULLEND8=>'aanvullend8',
		self::FIELD_OPNAME_OVERIGE=>'opnameOverige',
		self::FIELD_TOESTEMMING=>'toestemming',
		self::FIELD_RECHTENOC=>'rechtenOC',
		self::FIELD_IN_EMAIL=>'inEmail',
		self::FIELD_IN_PRINT=>'inPrint',
		self::FIELD_UIT_EMAIL=>'uitEmail',
		self::FIELD_UIT_PRINT=>'uitPrint',
		self::FIELD_STOPZETTING_TEXT=>'stopzettingText',
		self::FIELD_STOPZETTING_CAT=>'stopzettingCat',
		self::FIELD_ACTIEF=>'actief');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_PATIENT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PROJECT=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_BEGINDATUM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EINDDATUM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_OMSCHRIJVING=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_HOOFDDIAGNOSE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DIAGNOSEGENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SECUNDAIREDIAGNOSE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AANVULLEND1=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_AANVULLEND2=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_AANVULLEND3=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_AANVULLEND4=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_AANVULLEND5=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_AANVULLEND6=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_AANVULLEND7=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_AANVULLEND8=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_OPNAME_OVERIGE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TOESTEMMING=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_RECHTENOC=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_IN_EMAIL=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_IN_PRINT=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_UIT_EMAIL=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_UIT_PRINT=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_STOPZETTING_TEXT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_STOPZETTING_CAT=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_ACTIEF=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_PATIENT=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_PROJECT=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_BEGINDATUM=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,false),
		self::FIELD_EINDDATUM=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,true),
		self::FIELD_OMSCHRIJVING=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,true),
		self::FIELD_HOOFDDIAGNOSE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_DIAGNOSEGENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,4,0,false),
		self::FIELD_SECUNDAIREDIAGNOSE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_AANVULLEND1=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_AANVULLEND2=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_AANVULLEND3=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_AANVULLEND4=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_AANVULLEND5=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_AANVULLEND6=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_AANVULLEND7=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_AANVULLEND8=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_OPNAME_OVERIGE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_TOESTEMMING=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false),
		self::FIELD_RECHTENOC=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,8,0,true),
		self::FIELD_IN_EMAIL=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_IN_PRINT=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_UIT_EMAIL=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_UIT_PRINT=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_STOPZETTING_TEXT=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_STOPZETTING_CAT=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_ACTIEF=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_PATIENT=>'',
		self::FIELD_PROJECT=>0,
		self::FIELD_BEGINDATUM=>'1000-01-01',
		self::FIELD_EINDDATUM=>null,
		self::FIELD_OMSCHRIJVING=>null,
		self::FIELD_HOOFDDIAGNOSE=>null,
		self::FIELD_DIAGNOSEGENRE=>'dsm',
		self::FIELD_SECUNDAIREDIAGNOSE=>null,
		self::FIELD_AANVULLEND1=>'0',
		self::FIELD_AANVULLEND2=>'0',
		self::FIELD_AANVULLEND3=>'0',
		self::FIELD_AANVULLEND4=>'0',
		self::FIELD_AANVULLEND5=>'0',
		self::FIELD_AANVULLEND6=>'0',
		self::FIELD_AANVULLEND7=>'0',
		self::FIELD_AANVULLEND8=>'0',
		self::FIELD_OPNAME_OVERIGE=>null,
		self::FIELD_TOESTEMMING=>1,
		self::FIELD_RECHTENOC=>null,
		self::FIELD_IN_EMAIL=>'0',
		self::FIELD_IN_PRINT=>'0',
		self::FIELD_UIT_EMAIL=>'0',
		self::FIELD_UIT_PRINT=>'0',
		self::FIELD_STOPZETTING_TEXT=>null,
		self::FIELD_STOPZETTING_CAT=>null,
		self::FIELD_ACTIEF=>1);
	private $id;
	private $patient;
	private $project;
	private $begindatum;
	private $einddatum;
	private $omschrijving;
	private $hoofddiagnose;
	private $diagnosegenre;
	private $secundairediagnose;
	private $aanvullend1;
	private $aanvullend2;
	private $aanvullend3;
	private $aanvullend4;
	private $aanvullend5;
	private $aanvullend6;
	private $aanvullend7;
	private $aanvullend8;
	private $opnameOverige;
	private $toestemming;
	private $rechtenOC;
	private $inEmail;
	private $inPrint;
	private $uitEmail;
	private $uitPrint;
	private $stopzettingText;
	private $stopzettingCat;
	private $actief;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return PatientTp
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
	 * type:VARCHAR,size:20,default:,index
	 *
	 * @param mixed $patient
	 * @return PatientTp
	 */
	public function &setPatient($patient) {
		$this->notifyChanged(self::FIELD_PATIENT,$this->patient,$patient);
		$this->patient=$patient;
		return $this;
	}

	/**
	 * get value for patient 
	 *
	 * type:VARCHAR,size:20,default:,index
	 *
	 * @return mixed
	 */
	public function getPatient() {
		return $this->patient;
	}

	/**
	 * set value for project 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $project
	 * @return PatientTp
	 */
	public function &setProject($project) {
		$this->notifyChanged(self::FIELD_PROJECT,$this->project,$project);
		$this->project=$project;
		return $this;
	}

	/**
	 * get value for project 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @return mixed
	 */
	public function getProject() {
		return $this->project;
	}

	/**
	 * set value for begindatum 
	 *
	 * type:DATE,size:10,default:1000-01-01
	 *
	 * @param mixed $begindatum
	 * @return PatientTp
	 */
	public function &setBegindatum($begindatum) {
		$this->notifyChanged(self::FIELD_BEGINDATUM,$this->begindatum,$begindatum);
		$this->begindatum=$begindatum;
		return $this;
	}

	/**
	 * get value for begindatum 
	 *
	 * type:DATE,size:10,default:1000-01-01
	 *
	 * @return mixed
	 */
	public function getBegindatum() {
		return $this->begindatum;
	}

	/**
	 * set value for einddatum 
	 *
	 * type:DATE,size:10,default:null,index,nullable
	 *
	 * @param mixed $einddatum
	 * @return PatientTp
	 */
	public function &setEinddatum($einddatum) {
		$this->notifyChanged(self::FIELD_EINDDATUM,$this->einddatum,$einddatum);
		$this->einddatum=$einddatum;
		return $this;
	}

	/**
	 * get value for einddatum 
	 *
	 * type:DATE,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getEinddatum() {
		return $this->einddatum;
	}

	/**
	 * set value for omschrijving 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $omschrijving
	 * @return PatientTp
	 */
	public function &setOmschrijving($omschrijving) {
		$this->notifyChanged(self::FIELD_OMSCHRIJVING,$this->omschrijving,$omschrijving);
		$this->omschrijving=$omschrijving;
		return $this;
	}

	/**
	 * get value for omschrijving 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOmschrijving() {
		return $this->omschrijving;
	}

	/**
	 * set value for hoofddiagnose 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @param mixed $hoofddiagnose
	 * @return PatientTp
	 */
	public function &setHoofddiagnose($hoofddiagnose) {
		$this->notifyChanged(self::FIELD_HOOFDDIAGNOSE,$this->hoofddiagnose,$hoofddiagnose);
		$this->hoofddiagnose=$hoofddiagnose;
		return $this;
	}

	/**
	 * get value for hoofddiagnose 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getHoofddiagnose() {
		return $this->hoofddiagnose;
	}

	/**
	 * set value for diagnosegenre 
	 *
	 * type:ENUM,size:4,default:dsm
	 *
	 * @param mixed $diagnosegenre
	 * @return PatientTp
	 */
	public function &setDiagnosegenre($diagnosegenre) {
		$this->notifyChanged(self::FIELD_DIAGNOSEGENRE,$this->diagnosegenre,$diagnosegenre);
		$this->diagnosegenre=$diagnosegenre;
		return $this;
	}

	/**
	 * get value for diagnosegenre 
	 *
	 * type:ENUM,size:4,default:dsm
	 *
	 * @return mixed
	 */
	public function getDiagnosegenre() {
		return $this->diagnosegenre;
	}

	/**
	 * set value for secundairediagnose 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @param mixed $secundairediagnose
	 * @return PatientTp
	 */
	public function &setSecundairediagnose($secundairediagnose) {
		$this->notifyChanged(self::FIELD_SECUNDAIREDIAGNOSE,$this->secundairediagnose,$secundairediagnose);
		$this->secundairediagnose=$secundairediagnose;
		return $this;
	}

	/**
	 * get value for secundairediagnose 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSecundairediagnose() {
		return $this->secundairediagnose;
	}

	/**
	 * set value for aanvullend1 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $aanvullend1
	 * @return PatientTp
	 */
	public function &setAanvullend1($aanvullend1) {
		$this->notifyChanged(self::FIELD_AANVULLEND1,$this->aanvullend1,$aanvullend1);
		$this->aanvullend1=$aanvullend1;
		return $this;
	}

	/**
	 * get value for aanvullend1 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getAanvullend1() {
		return $this->aanvullend1;
	}

	/**
	 * set value for aanvullend2 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $aanvullend2
	 * @return PatientTp
	 */
	public function &setAanvullend2($aanvullend2) {
		$this->notifyChanged(self::FIELD_AANVULLEND2,$this->aanvullend2,$aanvullend2);
		$this->aanvullend2=$aanvullend2;
		return $this;
	}

	/**
	 * get value for aanvullend2 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getAanvullend2() {
		return $this->aanvullend2;
	}

	/**
	 * set value for aanvullend3 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $aanvullend3
	 * @return PatientTp
	 */
	public function &setAanvullend3($aanvullend3) {
		$this->notifyChanged(self::FIELD_AANVULLEND3,$this->aanvullend3,$aanvullend3);
		$this->aanvullend3=$aanvullend3;
		return $this;
	}

	/**
	 * get value for aanvullend3 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getAanvullend3() {
		return $this->aanvullend3;
	}

	/**
	 * set value for aanvullend4 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $aanvullend4
	 * @return PatientTp
	 */
	public function &setAanvullend4($aanvullend4) {
		$this->notifyChanged(self::FIELD_AANVULLEND4,$this->aanvullend4,$aanvullend4);
		$this->aanvullend4=$aanvullend4;
		return $this;
	}

	/**
	 * get value for aanvullend4 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getAanvullend4() {
		return $this->aanvullend4;
	}

	/**
	 * set value for aanvullend5 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $aanvullend5
	 * @return PatientTp
	 */
	public function &setAanvullend5($aanvullend5) {
		$this->notifyChanged(self::FIELD_AANVULLEND5,$this->aanvullend5,$aanvullend5);
		$this->aanvullend5=$aanvullend5;
		return $this;
	}

	/**
	 * get value for aanvullend5 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getAanvullend5() {
		return $this->aanvullend5;
	}

	/**
	 * set value for aanvullend6 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $aanvullend6
	 * @return PatientTp
	 */
	public function &setAanvullend6($aanvullend6) {
		$this->notifyChanged(self::FIELD_AANVULLEND6,$this->aanvullend6,$aanvullend6);
		$this->aanvullend6=$aanvullend6;
		return $this;
	}

	/**
	 * get value for aanvullend6 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getAanvullend6() {
		return $this->aanvullend6;
	}

	/**
	 * set value for aanvullend7 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $aanvullend7
	 * @return PatientTp
	 */
	public function &setAanvullend7($aanvullend7) {
		$this->notifyChanged(self::FIELD_AANVULLEND7,$this->aanvullend7,$aanvullend7);
		$this->aanvullend7=$aanvullend7;
		return $this;
	}

	/**
	 * get value for aanvullend7 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getAanvullend7() {
		return $this->aanvullend7;
	}

	/**
	 * set value for aanvullend8 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $aanvullend8
	 * @return PatientTp
	 */
	public function &setAanvullend8($aanvullend8) {
		$this->notifyChanged(self::FIELD_AANVULLEND8,$this->aanvullend8,$aanvullend8);
		$this->aanvullend8=$aanvullend8;
		return $this;
	}

	/**
	 * get value for aanvullend8 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getAanvullend8() {
		return $this->aanvullend8;
	}

	/**
	 * set value for opname_overige 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $opnameOverige
	 * @return PatientTp
	 */
	public function &setOpnameOverige($opnameOverige) {
		$this->notifyChanged(self::FIELD_OPNAME_OVERIGE,$this->opnameOverige,$opnameOverige);
		$this->opnameOverige=$opnameOverige;
		return $this;
	}

	/**
	 * get value for opname_overige 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOpnameOverige() {
		return $this->opnameOverige;
	}

	/**
	 * set value for toestemming 
	 *
	 * type:TINYINT,size:3,default:1
	 *
	 * @param mixed $toestemming
	 * @return PatientTp
	 */
	public function &setToestemming($toestemming) {
		$this->notifyChanged(self::FIELD_TOESTEMMING,$this->toestemming,$toestemming);
		$this->toestemming=$toestemming;
		return $this;
	}

	/**
	 * get value for toestemming 
	 *
	 * type:TINYINT,size:3,default:1
	 *
	 * @return mixed
	 */
	public function getToestemming() {
		return $this->toestemming;
	}

	/**
	 * set value for rechtenOC 
	 *
	 * type:VARCHAR,size:8,default:null,nullable
	 *
	 * @param mixed $rechtenOC
	 * @return PatientTp
	 */
	public function &setRechtenOC($rechtenOC) {
		$this->notifyChanged(self::FIELD_RECHTENOC,$this->rechtenOC,$rechtenOC);
		$this->rechtenOC=$rechtenOC;
		return $this;
	}

	/**
	 * get value for rechtenOC 
	 *
	 * type:VARCHAR,size:8,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getRechtenOC() {
		return $this->rechtenOC;
	}

	/**
	 * set value for in_email 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $inEmail
	 * @return PatientTp
	 */
	public function &setInEmail($inEmail) {
		$this->notifyChanged(self::FIELD_IN_EMAIL,$this->inEmail,$inEmail);
		$this->inEmail=$inEmail;
		return $this;
	}

	/**
	 * get value for in_email 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getInEmail() {
		return $this->inEmail;
	}

	/**
	 * set value for in_print 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $inPrint
	 * @return PatientTp
	 */
	public function &setInPrint($inPrint) {
		$this->notifyChanged(self::FIELD_IN_PRINT,$this->inPrint,$inPrint);
		$this->inPrint=$inPrint;
		return $this;
	}

	/**
	 * get value for in_print 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getInPrint() {
		return $this->inPrint;
	}

	/**
	 * set value for uit_email 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $uitEmail
	 * @return PatientTp
	 */
	public function &setUitEmail($uitEmail) {
		$this->notifyChanged(self::FIELD_UIT_EMAIL,$this->uitEmail,$uitEmail);
		$this->uitEmail=$uitEmail;
		return $this;
	}

	/**
	 * get value for uit_email 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getUitEmail() {
		return $this->uitEmail;
	}

	/**
	 * set value for uit_print 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $uitPrint
	 * @return PatientTp
	 */
	public function &setUitPrint($uitPrint) {
		$this->notifyChanged(self::FIELD_UIT_PRINT,$this->uitPrint,$uitPrint);
		$this->uitPrint=$uitPrint;
		return $this;
	}

	/**
	 * get value for uit_print 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getUitPrint() {
		return $this->uitPrint;
	}

	/**
	 * set value for stopzetting_text 
	 *
	 * type:TINYTEXT,size:255,default:null,nullable
	 *
	 * @param mixed $stopzettingText
	 * @return PatientTp
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
	 * @return PatientTp
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
	 * set value for actief 
	 *
	 * type:TINYINT,size:3,default:1,index
	 *
	 * @param mixed $actief
	 * @return PatientTp
	 */
	public function &setActief($actief) {
		$this->notifyChanged(self::FIELD_ACTIEF,$this->actief,$actief);
		$this->actief=$actief;
		return $this;
	}

	/**
	 * get value for actief 
	 *
	 * type:TINYINT,size:3,default:1,index
	 *
	 * @return mixed
	 */
	public function getActief() {
		return $this->actief;
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
			self::FIELD_PROJECT=>$this->getProject(),
			self::FIELD_BEGINDATUM=>$this->getBegindatum(),
			self::FIELD_EINDDATUM=>$this->getEinddatum(),
			self::FIELD_OMSCHRIJVING=>$this->getOmschrijving(),
			self::FIELD_HOOFDDIAGNOSE=>$this->getHoofddiagnose(),
			self::FIELD_DIAGNOSEGENRE=>$this->getDiagnosegenre(),
			self::FIELD_SECUNDAIREDIAGNOSE=>$this->getSecundairediagnose(),
			self::FIELD_AANVULLEND1=>$this->getAanvullend1(),
			self::FIELD_AANVULLEND2=>$this->getAanvullend2(),
			self::FIELD_AANVULLEND3=>$this->getAanvullend3(),
			self::FIELD_AANVULLEND4=>$this->getAanvullend4(),
			self::FIELD_AANVULLEND5=>$this->getAanvullend5(),
			self::FIELD_AANVULLEND6=>$this->getAanvullend6(),
			self::FIELD_AANVULLEND7=>$this->getAanvullend7(),
			self::FIELD_AANVULLEND8=>$this->getAanvullend8(),
			self::FIELD_OPNAME_OVERIGE=>$this->getOpnameOverige(),
			self::FIELD_TOESTEMMING=>$this->getToestemming(),
			self::FIELD_RECHTENOC=>$this->getRechtenOC(),
			self::FIELD_IN_EMAIL=>$this->getInEmail(),
			self::FIELD_IN_PRINT=>$this->getInPrint(),
			self::FIELD_UIT_EMAIL=>$this->getUitEmail(),
			self::FIELD_UIT_PRINT=>$this->getUitPrint(),
			self::FIELD_STOPZETTING_TEXT=>$this->getStopzettingText(),
			self::FIELD_STOPZETTING_CAT=>$this->getStopzettingCat(),
			self::FIELD_ACTIEF=>$this->getActief());
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
	 * Match by attributes of passed example instance and return matched rows as an array of PatientTp instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param PatientTp $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return PatientTp[]
	 */
	public static function findByExample(PDO $db,PatientTp $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of PatientTp instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return PatientTp[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `patient_tp`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of PatientTp instances
	 *
	 * @param PDOStatement $stmt
	 * @return PatientTp[]
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
	 * returns the result as an array of PatientTp instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return PatientTp[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new PatientTp();
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
	 * Execute select query and return matched rows as an array of PatientTp instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return PatientTp[]
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
		$sql='DELETE FROM `patient_tp`'
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
		$this->setProject($result['project']);
		$this->setBegindatum($result['begindatum']);
		$this->setEinddatum($result['einddatum']);
		$this->setOmschrijving($result['omschrijving']);
		$this->setHoofddiagnose($result['hoofddiagnose']);
		$this->setDiagnosegenre($result['diagnosegenre']);
		$this->setSecundairediagnose($result['secundairediagnose']);
		$this->setAanvullend1($result['aanvullend1']);
		$this->setAanvullend2($result['aanvullend2']);
		$this->setAanvullend3($result['aanvullend3']);
		$this->setAanvullend4($result['aanvullend4']);
		$this->setAanvullend5($result['aanvullend5']);
		$this->setAanvullend6($result['aanvullend6']);
		$this->setAanvullend7($result['aanvullend7']);
		$this->setAanvullend8($result['aanvullend8']);
		$this->setOpnameOverige($result['opname_overige']);
		$this->setToestemming($result['toestemming']);
		$this->setRechtenOC($result['rechtenOC']);
		$this->setInEmail($result['in_email']);
		$this->setInPrint($result['in_print']);
		$this->setUitEmail($result['uit_email']);
		$this->setUitPrint($result['uit_print']);
		$this->setStopzettingText($result['stopzetting_text']);
		$this->setStopzettingCat($result['stopzetting_cat']);
		$this->setActief($result['actief']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return PatientTp
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
		$o=new PatientTp();
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
		$stmt->bindValue(3,$this->getProject());
		$stmt->bindValue(4,$this->getBegindatum());
		$stmt->bindValue(5,$this->getEinddatum());
		$stmt->bindValue(6,$this->getOmschrijving());
		$stmt->bindValue(7,$this->getHoofddiagnose());
		$stmt->bindValue(8,$this->getDiagnosegenre());
		$stmt->bindValue(9,$this->getSecundairediagnose());
		$stmt->bindValue(10,$this->getAanvullend1());
		$stmt->bindValue(11,$this->getAanvullend2());
		$stmt->bindValue(12,$this->getAanvullend3());
		$stmt->bindValue(13,$this->getAanvullend4());
		$stmt->bindValue(14,$this->getAanvullend5());
		$stmt->bindValue(15,$this->getAanvullend6());
		$stmt->bindValue(16,$this->getAanvullend7());
		$stmt->bindValue(17,$this->getAanvullend8());
		$stmt->bindValue(18,$this->getOpnameOverige());
		$stmt->bindValue(19,$this->getToestemming());
		$stmt->bindValue(20,$this->getRechtenOC());
		$stmt->bindValue(21,$this->getInEmail());
		$stmt->bindValue(22,$this->getInPrint());
		$stmt->bindValue(23,$this->getUitEmail());
		$stmt->bindValue(24,$this->getUitPrint());
		$stmt->bindValue(25,$this->getStopzettingText());
		$stmt->bindValue(26,$this->getStopzettingCat());
		$stmt->bindValue(27,$this->getActief());
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
			$stmt->bindValue(2,$this->getProject());
			$stmt->bindValue(3,$this->getBegindatum());
			$stmt->bindValue(4,$this->getEinddatum());
			$stmt->bindValue(5,$this->getOmschrijving());
			$stmt->bindValue(6,$this->getHoofddiagnose());
			$stmt->bindValue(7,$this->getDiagnosegenre());
			$stmt->bindValue(8,$this->getSecundairediagnose());
			$stmt->bindValue(9,$this->getAanvullend1());
			$stmt->bindValue(10,$this->getAanvullend2());
			$stmt->bindValue(11,$this->getAanvullend3());
			$stmt->bindValue(12,$this->getAanvullend4());
			$stmt->bindValue(13,$this->getAanvullend5());
			$stmt->bindValue(14,$this->getAanvullend6());
			$stmt->bindValue(15,$this->getAanvullend7());
			$stmt->bindValue(16,$this->getAanvullend8());
			$stmt->bindValue(17,$this->getOpnameOverige());
			$stmt->bindValue(18,$this->getToestemming());
			$stmt->bindValue(19,$this->getRechtenOC());
			$stmt->bindValue(20,$this->getInEmail());
			$stmt->bindValue(21,$this->getInPrint());
			$stmt->bindValue(22,$this->getUitEmail());
			$stmt->bindValue(23,$this->getUitPrint());
			$stmt->bindValue(24,$this->getStopzettingText());
			$stmt->bindValue(25,$this->getStopzettingCat());
			$stmt->bindValue(26,$this->getActief());
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
		$stmt->bindValue(28,$this->getId());
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
	 * Fetch TpOudeRechten's which this PatientTp references.
	 * `patient_tp`.`id` -> `tp_oude_rechten`.`patient_tp_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return TpOudeRechten[]
	 */
	public function fetchTpOudeRechtenCollection(PDO $db, $sort=null) {
		$filter=array(TpOudeRechten::FIELD_PATIENT_TP_ID=>$this->getId());
		return TpOudeRechten::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Patient which references this PatientTp. Will return null in case reference is invalid.
	 * `patient_tp`.`patient` -> `patient`.`code`
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
	 * Fetch TpProject which references this PatientTp. Will return null in case reference is invalid.
	 * `patient_tp`.`project` -> `tp_project`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return TpProject
	 */
	public function fetchTpProject(PDO $db, $sort=null) {
		$filter=array(TpProject::FIELD_ID=>$this->getProject());
		$result=TpProject::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'PatientTp');
	}

	/**
	 * get single PatientTp instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return PatientTp
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new PatientTp();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of PatientTp from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return PatientTp[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('PatientTp') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>