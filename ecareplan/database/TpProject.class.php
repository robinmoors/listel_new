<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class TpProject extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='TpProject';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='tp_project';
	const SQL_INSERT='INSERT INTO `tp_project` (`id`,`nummer`,`naam`,`doelgroep`,`diagnosegenre`,`bijkomend_complexiteit`,`bijkomend_langdurig`,`aanvullend1`,`aanvullend2`,`aanvullend3`,`aanvullend4`,`aanvullend5`,`aanvullend6`,`aanvullend7`,`aanvullend8`,`actief`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `tp_project` (`nummer`,`naam`,`doelgroep`,`diagnosegenre`,`bijkomend_complexiteit`,`bijkomend_langdurig`,`aanvullend1`,`aanvullend2`,`aanvullend3`,`aanvullend4`,`aanvullend5`,`aanvullend6`,`aanvullend7`,`aanvullend8`,`actief`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `tp_project` SET `id`=?,`nummer`=?,`naam`=?,`doelgroep`=?,`diagnosegenre`=?,`bijkomend_complexiteit`=?,`bijkomend_langdurig`=?,`aanvullend1`=?,`aanvullend2`=?,`aanvullend3`=?,`aanvullend4`=?,`aanvullend5`=?,`aanvullend6`=?,`aanvullend7`=?,`aanvullend8`=?,`actief`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `tp_project` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `tp_project` WHERE `id`=?';
	const FIELD_ID=1015647667;
	const FIELD_NUMMER=-1501529812;
	const FIELD_NAAM=1079980983;
	const FIELD_DOELGROEP=500739525;
	const FIELD_DIAGNOSEGENRE=1693160173;
	const FIELD_BIJKOMEND_COMPLEXITEIT=-149428809;
	const FIELD_BIJKOMEND_LANGDURIG=-1419085873;
	const FIELD_AANVULLEND1=253073515;
	const FIELD_AANVULLEND2=253073516;
	const FIELD_AANVULLEND3=253073517;
	const FIELD_AANVULLEND4=253073518;
	const FIELD_AANVULLEND5=253073519;
	const FIELD_AANVULLEND6=253073520;
	const FIELD_AANVULLEND7=253073521;
	const FIELD_AANVULLEND8=253073522;
	const FIELD_ACTIEF=-1890127472;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_NUMMER=>'nummer',
		self::FIELD_NAAM=>'naam',
		self::FIELD_DOELGROEP=>'doelgroep',
		self::FIELD_DIAGNOSEGENRE=>'diagnosegenre',
		self::FIELD_BIJKOMEND_COMPLEXITEIT=>'bijkomend_complexiteit',
		self::FIELD_BIJKOMEND_LANGDURIG=>'bijkomend_langdurig',
		self::FIELD_AANVULLEND1=>'aanvullend1',
		self::FIELD_AANVULLEND2=>'aanvullend2',
		self::FIELD_AANVULLEND3=>'aanvullend3',
		self::FIELD_AANVULLEND4=>'aanvullend4',
		self::FIELD_AANVULLEND5=>'aanvullend5',
		self::FIELD_AANVULLEND6=>'aanvullend6',
		self::FIELD_AANVULLEND7=>'aanvullend7',
		self::FIELD_AANVULLEND8=>'aanvullend8',
		self::FIELD_ACTIEF=>'actief');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_NUMMER=>'nummer',
		self::FIELD_NAAM=>'naam',
		self::FIELD_DOELGROEP=>'doelgroep',
		self::FIELD_DIAGNOSEGENRE=>'diagnosegenre',
		self::FIELD_BIJKOMEND_COMPLEXITEIT=>'bijkomendComplexiteit',
		self::FIELD_BIJKOMEND_LANGDURIG=>'bijkomendLangdurig',
		self::FIELD_AANVULLEND1=>'aanvullend1',
		self::FIELD_AANVULLEND2=>'aanvullend2',
		self::FIELD_AANVULLEND3=>'aanvullend3',
		self::FIELD_AANVULLEND4=>'aanvullend4',
		self::FIELD_AANVULLEND5=>'aanvullend5',
		self::FIELD_AANVULLEND6=>'aanvullend6',
		self::FIELD_AANVULLEND7=>'aanvullend7',
		self::FIELD_AANVULLEND8=>'aanvullend8',
		self::FIELD_ACTIEF=>'actief');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NUMMER=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DOELGROEP=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DIAGNOSEGENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_BIJKOMEND_COMPLEXITEIT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_BIJKOMEND_LANGDURIG=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AANVULLEND1=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AANVULLEND2=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AANVULLEND3=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AANVULLEND4=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AANVULLEND5=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AANVULLEND6=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AANVULLEND7=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AANVULLEND8=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ACTIEF=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_NUMMER=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_NAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,false),
		self::FIELD_DOELGROEP=>array(Db2PhpEntity::JDBC_TYPE_CHAR,21,0,true),
		self::FIELD_DIAGNOSEGENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,4,0,true),
		self::FIELD_BIJKOMEND_COMPLEXITEIT=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,false),
		self::FIELD_BIJKOMEND_LANGDURIG=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,false),
		self::FIELD_AANVULLEND1=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,120,0,true),
		self::FIELD_AANVULLEND2=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,120,0,true),
		self::FIELD_AANVULLEND3=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,120,0,true),
		self::FIELD_AANVULLEND4=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,120,0,true),
		self::FIELD_AANVULLEND5=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,120,0,true),
		self::FIELD_AANVULLEND6=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,120,0,true),
		self::FIELD_AANVULLEND7=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,120,0,true),
		self::FIELD_AANVULLEND8=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,120,0,true),
		self::FIELD_ACTIEF=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_NUMMER=>0,
		self::FIELD_NAAM=>'',
		self::FIELD_DOELGROEP=>null,
		self::FIELD_DIAGNOSEGENRE=>null,
		self::FIELD_BIJKOMEND_COMPLEXITEIT=>'',
		self::FIELD_BIJKOMEND_LANGDURIG=>'',
		self::FIELD_AANVULLEND1=>null,
		self::FIELD_AANVULLEND2=>null,
		self::FIELD_AANVULLEND3=>null,
		self::FIELD_AANVULLEND4=>null,
		self::FIELD_AANVULLEND5=>null,
		self::FIELD_AANVULLEND6=>null,
		self::FIELD_AANVULLEND7=>null,
		self::FIELD_AANVULLEND8=>null,
		self::FIELD_ACTIEF=>1);
	private $id;
	private $nummer;
	private $naam;
	private $doelgroep;
	private $diagnosegenre;
	private $bijkomendComplexiteit;
	private $bijkomendLangdurig;
	private $aanvullend1;
	private $aanvullend2;
	private $aanvullend3;
	private $aanvullend4;
	private $aanvullend5;
	private $aanvullend6;
	private $aanvullend7;
	private $aanvullend8;
	private $actief;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return TpProject
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
	 * set value for nummer 
	 *
	 * type:INT,size:10,default:0,unique
	 *
	 * @param mixed $nummer
	 * @return TpProject
	 */
	public function &setNummer($nummer) {
		$this->notifyChanged(self::FIELD_NUMMER,$this->nummer,$nummer);
		$this->nummer=$nummer;
		return $this;
	}

	/**
	 * get value for nummer 
	 *
	 * type:INT,size:10,default:0,unique
	 *
	 * @return mixed
	 */
	public function getNummer() {
		return $this->nummer;
	}

	/**
	 * set value for naam 
	 *
	 * type:VARCHAR,size:255,default:
	 *
	 * @param mixed $naam
	 * @return TpProject
	 */
	public function &setNaam($naam) {
		$this->notifyChanged(self::FIELD_NAAM,$this->naam,$naam);
		$this->naam=$naam;
		return $this;
	}

	/**
	 * get value for naam 
	 *
	 * type:VARCHAR,size:255,default:
	 *
	 * @return mixed
	 */
	public function getNaam() {
		return $this->naam;
	}

	/**
	 * set value for doelgroep 
	 *
	 * type:ENUM,size:21,default:null,nullable
	 *
	 * @param mixed $doelgroep
	 * @return TpProject
	 */
	public function &setDoelgroep($doelgroep) {
		$this->notifyChanged(self::FIELD_DOELGROEP,$this->doelgroep,$doelgroep);
		$this->doelgroep=$doelgroep;
		return $this;
	}

	/**
	 * get value for doelgroep 
	 *
	 * type:ENUM,size:21,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDoelgroep() {
		return $this->doelgroep;
	}

	/**
	 * set value for diagnosegenre 
	 *
	 * type:ENUM,size:4,default:null,nullable
	 *
	 * @param mixed $diagnosegenre
	 * @return TpProject
	 */
	public function &setDiagnosegenre($diagnosegenre) {
		$this->notifyChanged(self::FIELD_DIAGNOSEGENRE,$this->diagnosegenre,$diagnosegenre);
		$this->diagnosegenre=$diagnosegenre;
		return $this;
	}

	/**
	 * get value for diagnosegenre 
	 *
	 * type:ENUM,size:4,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDiagnosegenre() {
		return $this->diagnosegenre;
	}

	/**
	 * set value for bijkomend_complexiteit 
	 *
	 * type:TEXT,size:65535,default:null
	 *
	 * @param mixed $bijkomendComplexiteit
	 * @return TpProject
	 */
	public function &setBijkomendComplexiteit($bijkomendComplexiteit) {
		$this->notifyChanged(self::FIELD_BIJKOMEND_COMPLEXITEIT,$this->bijkomendComplexiteit,$bijkomendComplexiteit);
		$this->bijkomendComplexiteit=$bijkomendComplexiteit;
		return $this;
	}

	/**
	 * get value for bijkomend_complexiteit 
	 *
	 * type:TEXT,size:65535,default:null
	 *
	 * @return mixed
	 */
	public function getBijkomendComplexiteit() {
		return $this->bijkomendComplexiteit;
	}

	/**
	 * set value for bijkomend_langdurig 
	 *
	 * type:TEXT,size:65535,default:null
	 *
	 * @param mixed $bijkomendLangdurig
	 * @return TpProject
	 */
	public function &setBijkomendLangdurig($bijkomendLangdurig) {
		$this->notifyChanged(self::FIELD_BIJKOMEND_LANGDURIG,$this->bijkomendLangdurig,$bijkomendLangdurig);
		$this->bijkomendLangdurig=$bijkomendLangdurig;
		return $this;
	}

	/**
	 * get value for bijkomend_langdurig 
	 *
	 * type:TEXT,size:65535,default:null
	 *
	 * @return mixed
	 */
	public function getBijkomendLangdurig() {
		return $this->bijkomendLangdurig;
	}

	/**
	 * set value for aanvullend1 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @param mixed $aanvullend1
	 * @return TpProject
	 */
	public function &setAanvullend1($aanvullend1) {
		$this->notifyChanged(self::FIELD_AANVULLEND1,$this->aanvullend1,$aanvullend1);
		$this->aanvullend1=$aanvullend1;
		return $this;
	}

	/**
	 * get value for aanvullend1 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAanvullend1() {
		return $this->aanvullend1;
	}

	/**
	 * set value for aanvullend2 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @param mixed $aanvullend2
	 * @return TpProject
	 */
	public function &setAanvullend2($aanvullend2) {
		$this->notifyChanged(self::FIELD_AANVULLEND2,$this->aanvullend2,$aanvullend2);
		$this->aanvullend2=$aanvullend2;
		return $this;
	}

	/**
	 * get value for aanvullend2 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAanvullend2() {
		return $this->aanvullend2;
	}

	/**
	 * set value for aanvullend3 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @param mixed $aanvullend3
	 * @return TpProject
	 */
	public function &setAanvullend3($aanvullend3) {
		$this->notifyChanged(self::FIELD_AANVULLEND3,$this->aanvullend3,$aanvullend3);
		$this->aanvullend3=$aanvullend3;
		return $this;
	}

	/**
	 * get value for aanvullend3 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAanvullend3() {
		return $this->aanvullend3;
	}

	/**
	 * set value for aanvullend4 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @param mixed $aanvullend4
	 * @return TpProject
	 */
	public function &setAanvullend4($aanvullend4) {
		$this->notifyChanged(self::FIELD_AANVULLEND4,$this->aanvullend4,$aanvullend4);
		$this->aanvullend4=$aanvullend4;
		return $this;
	}

	/**
	 * get value for aanvullend4 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAanvullend4() {
		return $this->aanvullend4;
	}

	/**
	 * set value for aanvullend5 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @param mixed $aanvullend5
	 * @return TpProject
	 */
	public function &setAanvullend5($aanvullend5) {
		$this->notifyChanged(self::FIELD_AANVULLEND5,$this->aanvullend5,$aanvullend5);
		$this->aanvullend5=$aanvullend5;
		return $this;
	}

	/**
	 * get value for aanvullend5 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAanvullend5() {
		return $this->aanvullend5;
	}

	/**
	 * set value for aanvullend6 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @param mixed $aanvullend6
	 * @return TpProject
	 */
	public function &setAanvullend6($aanvullend6) {
		$this->notifyChanged(self::FIELD_AANVULLEND6,$this->aanvullend6,$aanvullend6);
		$this->aanvullend6=$aanvullend6;
		return $this;
	}

	/**
	 * get value for aanvullend6 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAanvullend6() {
		return $this->aanvullend6;
	}

	/**
	 * set value for aanvullend7 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @param mixed $aanvullend7
	 * @return TpProject
	 */
	public function &setAanvullend7($aanvullend7) {
		$this->notifyChanged(self::FIELD_AANVULLEND7,$this->aanvullend7,$aanvullend7);
		$this->aanvullend7=$aanvullend7;
		return $this;
	}

	/**
	 * get value for aanvullend7 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAanvullend7() {
		return $this->aanvullend7;
	}

	/**
	 * set value for aanvullend8 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @param mixed $aanvullend8
	 * @return TpProject
	 */
	public function &setAanvullend8($aanvullend8) {
		$this->notifyChanged(self::FIELD_AANVULLEND8,$this->aanvullend8,$aanvullend8);
		$this->aanvullend8=$aanvullend8;
		return $this;
	}

	/**
	 * get value for aanvullend8 
	 *
	 * type:VARCHAR,size:120,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAanvullend8() {
		return $this->aanvullend8;
	}

	/**
	 * set value for actief 
	 *
	 * type:TINYINT,size:3,default:1
	 *
	 * @param mixed $actief
	 * @return TpProject
	 */
	public function &setActief($actief) {
		$this->notifyChanged(self::FIELD_ACTIEF,$this->actief,$actief);
		$this->actief=$actief;
		return $this;
	}

	/**
	 * get value for actief 
	 *
	 * type:TINYINT,size:3,default:1
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
			self::FIELD_NUMMER=>$this->getNummer(),
			self::FIELD_NAAM=>$this->getNaam(),
			self::FIELD_DOELGROEP=>$this->getDoelgroep(),
			self::FIELD_DIAGNOSEGENRE=>$this->getDiagnosegenre(),
			self::FIELD_BIJKOMEND_COMPLEXITEIT=>$this->getBijkomendComplexiteit(),
			self::FIELD_BIJKOMEND_LANGDURIG=>$this->getBijkomendLangdurig(),
			self::FIELD_AANVULLEND1=>$this->getAanvullend1(),
			self::FIELD_AANVULLEND2=>$this->getAanvullend2(),
			self::FIELD_AANVULLEND3=>$this->getAanvullend3(),
			self::FIELD_AANVULLEND4=>$this->getAanvullend4(),
			self::FIELD_AANVULLEND5=>$this->getAanvullend5(),
			self::FIELD_AANVULLEND6=>$this->getAanvullend6(),
			self::FIELD_AANVULLEND7=>$this->getAanvullend7(),
			self::FIELD_AANVULLEND8=>$this->getAanvullend8(),
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
	 * Match by attributes of passed example instance and return matched rows as an array of TpProject instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param TpProject $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return TpProject[]
	 */
	public static function findByExample(PDO $db,TpProject $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of TpProject instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return TpProject[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `tp_project`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of TpProject instances
	 *
	 * @param PDOStatement $stmt
	 * @return TpProject[]
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
	 * returns the result as an array of TpProject instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return TpProject[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new TpProject();
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
	 * Execute select query and return matched rows as an array of TpProject instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return TpProject[]
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
		$sql='DELETE FROM `tp_project`'
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
		$this->setNummer($result['nummer']);
		$this->setNaam($result['naam']);
		$this->setDoelgroep($result['doelgroep']);
		$this->setDiagnosegenre($result['diagnosegenre']);
		$this->setBijkomendComplexiteit($result['bijkomend_complexiteit']);
		$this->setBijkomendLangdurig($result['bijkomend_langdurig']);
		$this->setAanvullend1($result['aanvullend1']);
		$this->setAanvullend2($result['aanvullend2']);
		$this->setAanvullend3($result['aanvullend3']);
		$this->setAanvullend4($result['aanvullend4']);
		$this->setAanvullend5($result['aanvullend5']);
		$this->setAanvullend6($result['aanvullend6']);
		$this->setAanvullend7($result['aanvullend7']);
		$this->setAanvullend8($result['aanvullend8']);
		$this->setActief($result['actief']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return TpProject
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
		$o=new TpProject();
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
		$stmt->bindValue(2,$this->getNummer());
		$stmt->bindValue(3,$this->getNaam());
		$stmt->bindValue(4,$this->getDoelgroep());
		$stmt->bindValue(5,$this->getDiagnosegenre());
		$stmt->bindValue(6,$this->getBijkomendComplexiteit());
		$stmt->bindValue(7,$this->getBijkomendLangdurig());
		$stmt->bindValue(8,$this->getAanvullend1());
		$stmt->bindValue(9,$this->getAanvullend2());
		$stmt->bindValue(10,$this->getAanvullend3());
		$stmt->bindValue(11,$this->getAanvullend4());
		$stmt->bindValue(12,$this->getAanvullend5());
		$stmt->bindValue(13,$this->getAanvullend6());
		$stmt->bindValue(14,$this->getAanvullend7());
		$stmt->bindValue(15,$this->getAanvullend8());
		$stmt->bindValue(16,$this->getActief());
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
			$stmt->bindValue(1,$this->getNummer());
			$stmt->bindValue(2,$this->getNaam());
			$stmt->bindValue(3,$this->getDoelgroep());
			$stmt->bindValue(4,$this->getDiagnosegenre());
			$stmt->bindValue(5,$this->getBijkomendComplexiteit());
			$stmt->bindValue(6,$this->getBijkomendLangdurig());
			$stmt->bindValue(7,$this->getAanvullend1());
			$stmt->bindValue(8,$this->getAanvullend2());
			$stmt->bindValue(9,$this->getAanvullend3());
			$stmt->bindValue(10,$this->getAanvullend4());
			$stmt->bindValue(11,$this->getAanvullend5());
			$stmt->bindValue(12,$this->getAanvullend6());
			$stmt->bindValue(13,$this->getAanvullend7());
			$stmt->bindValue(14,$this->getAanvullend8());
			$stmt->bindValue(15,$this->getActief());
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
		$stmt->bindValue(17,$this->getId());
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
	 * Fetch Logins's which this TpProject references.
	 * `tp_project`.`id` -> `logins`.`tp_project`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Logins[]
	 */
	public function fetchLoginsCollection(PDO $db, $sort=null) {
		$filter=array(Logins::FIELD_TP_PROJECT=>$this->getId());
		return Logins::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch PatientSecundair's which this TpProject references.
	 * `tp_project`.`id` -> `patient_secundair`.`project`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return PatientSecundair[]
	 */
	public function fetchPatientSecundairCollection(PDO $db, $sort=null) {
		$filter=array(PatientSecundair::FIELD_PROJECT=>$this->getId());
		return PatientSecundair::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch PatientTp's which this TpProject references.
	 * `tp_project`.`id` -> `patient_tp`.`project`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return PatientTp[]
	 */
	public function fetchPatientTpCollection(PDO $db, $sort=null) {
		$filter=array(PatientTp::FIELD_PROJECT=>$this->getId());
		return PatientTp::findByFilter($db, $filter, true, $sort);
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'TpProject');
	}

	/**
	 * get single TpProject instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return TpProject
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new TpProject();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of TpProject from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return TpProject[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('TpProject') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>