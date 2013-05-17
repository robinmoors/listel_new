<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class RizivTarieven extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='RizivTarieven';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='riziv_tarieven';
	const SQL_INSERT='INSERT INTO `riziv_tarieven` (`datum`,`thuis`,`elders`,`registratie`,`thuisPVS`,`eldersPVS`,`registratiePVS`,`zhTP`,`nietzhTP`,`registratie_zhTP`,`registratie_nietzhTP`,`omb`,`registratieomb`,`organisatie`,`actief`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `riziv_tarieven` (`datum`,`thuis`,`elders`,`registratie`,`thuisPVS`,`eldersPVS`,`registratiePVS`,`zhTP`,`nietzhTP`,`registratie_zhTP`,`registratie_nietzhTP`,`omb`,`registratieomb`,`organisatie`,`actief`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `riziv_tarieven` SET `datum`=?,`thuis`=?,`elders`=?,`registratie`=?,`thuisPVS`=?,`eldersPVS`=?,`registratiePVS`=?,`zhTP`=?,`nietzhTP`=?,`registratie_zhTP`=?,`registratie_nietzhTP`=?,`omb`=?,`registratieomb`=?,`organisatie`=?,`actief`=? WHERE `datum`=?';
	const SQL_SELECT_PK='SELECT * FROM `riziv_tarieven` WHERE `datum`=?';
	const SQL_DELETE_PK='DELETE FROM `riziv_tarieven` WHERE `datum`=?';
	const FIELD_DATUM=-1873623666;
	const FIELD_THUIS=-1858638198;
	const FIELD_ELDERS=2085504618;
	const FIELD_REGISTRATIE=-1484026838;
	const FIELD_THUISPVS=27903043;
	const FIELD_ELDERSPVS=-1728749469;
	const FIELD_REGISTRATIEPVS=1749893795;
	const FIELD_ZHTP=-475420373;
	const FIELD_NIETZHTP=-1399196843;
	const FIELD_REGISTRATIE_ZHTP=-1964294881;
	const FIELD_REGISTRATIE_NIETZHTP=-263688887;
	const FIELD_OMB=677390115;
	const FIELD_REGISTRATIEOMB=1749924314;
	const FIELD_ORGANISATIE=-161977367;
	const FIELD_ACTIEF=1963156409;
	private static $PRIMARY_KEYS=array(self::FIELD_DATUM);
	private static $AUTOINCREMENT_FIELDS=array();
	private static $FIELD_NAMES=array(
		self::FIELD_DATUM=>'datum',
		self::FIELD_THUIS=>'thuis',
		self::FIELD_ELDERS=>'elders',
		self::FIELD_REGISTRATIE=>'registratie',
		self::FIELD_THUISPVS=>'thuisPVS',
		self::FIELD_ELDERSPVS=>'eldersPVS',
		self::FIELD_REGISTRATIEPVS=>'registratiePVS',
		self::FIELD_ZHTP=>'zhTP',
		self::FIELD_NIETZHTP=>'nietzhTP',
		self::FIELD_REGISTRATIE_ZHTP=>'registratie_zhTP',
		self::FIELD_REGISTRATIE_NIETZHTP=>'registratie_nietzhTP',
		self::FIELD_OMB=>'omb',
		self::FIELD_REGISTRATIEOMB=>'registratieomb',
		self::FIELD_ORGANISATIE=>'organisatie',
		self::FIELD_ACTIEF=>'actief');
	private static $PROPERTY_NAMES=array(
		self::FIELD_DATUM=>'datum',
		self::FIELD_THUIS=>'thuis',
		self::FIELD_ELDERS=>'elders',
		self::FIELD_REGISTRATIE=>'registratie',
		self::FIELD_THUISPVS=>'thuisPVS',
		self::FIELD_ELDERSPVS=>'eldersPVS',
		self::FIELD_REGISTRATIEPVS=>'registratiePVS',
		self::FIELD_ZHTP=>'zhTP',
		self::FIELD_NIETZHTP=>'nietzhTP',
		self::FIELD_REGISTRATIE_ZHTP=>'registratieZhtp',
		self::FIELD_REGISTRATIE_NIETZHTP=>'registratieNietzhtp',
		self::FIELD_OMB=>'omb',
		self::FIELD_REGISTRATIEOMB=>'registratieomb',
		self::FIELD_ORGANISATIE=>'organisatie',
		self::FIELD_ACTIEF=>'actief');
	private static $PROPERTY_TYPES=array(
		self::FIELD_DATUM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_THUIS=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_ELDERS=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_REGISTRATIE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_THUISPVS=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_ELDERSPVS=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_REGISTRATIEPVS=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_ZHTP=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_NIETZHTP=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_REGISTRATIE_ZHTP=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_REGISTRATIE_NIETZHTP=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_OMB=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_REGISTRATIEOMB=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_ORGANISATIE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_ACTIEF=>Db2PhpEntity::PHP_TYPE_BOOL);
	private static $FIELD_TYPES=array(
		self::FIELD_DATUM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,8,0,false),
		self::FIELD_THUIS=>array(Db2PhpEntity::JDBC_TYPE_REAL,12,0,false),
		self::FIELD_ELDERS=>array(Db2PhpEntity::JDBC_TYPE_REAL,12,0,false),
		self::FIELD_REGISTRATIE=>array(Db2PhpEntity::JDBC_TYPE_REAL,12,0,false),
		self::FIELD_THUISPVS=>array(Db2PhpEntity::JDBC_TYPE_REAL,12,0,false),
		self::FIELD_ELDERSPVS=>array(Db2PhpEntity::JDBC_TYPE_REAL,12,0,false),
		self::FIELD_REGISTRATIEPVS=>array(Db2PhpEntity::JDBC_TYPE_REAL,12,0,false),
		self::FIELD_ZHTP=>array(Db2PhpEntity::JDBC_TYPE_REAL,12,0,false),
		self::FIELD_NIETZHTP=>array(Db2PhpEntity::JDBC_TYPE_REAL,12,0,false),
		self::FIELD_REGISTRATIE_ZHTP=>array(Db2PhpEntity::JDBC_TYPE_REAL,12,0,false),
		self::FIELD_REGISTRATIE_NIETZHTP=>array(Db2PhpEntity::JDBC_TYPE_REAL,12,0,false),
		self::FIELD_OMB=>array(Db2PhpEntity::JDBC_TYPE_DOUBLE,22,0,false),
		self::FIELD_REGISTRATIEOMB=>array(Db2PhpEntity::JDBC_TYPE_DOUBLE,22,0,false),
		self::FIELD_ORGANISATIE=>array(Db2PhpEntity::JDBC_TYPE_DOUBLE,22,0,false),
		self::FIELD_ACTIEF=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_DATUM=>'',
		self::FIELD_THUIS=>'0',
		self::FIELD_ELDERS=>'0',
		self::FIELD_REGISTRATIE=>'0',
		self::FIELD_THUISPVS=>'0',
		self::FIELD_ELDERSPVS=>'0',
		self::FIELD_REGISTRATIEPVS=>'0',
		self::FIELD_ZHTP=>'0',
		self::FIELD_NIETZHTP=>'0',
		self::FIELD_REGISTRATIE_ZHTP=>'0',
		self::FIELD_REGISTRATIE_NIETZHTP=>'0',
		self::FIELD_OMB=>30,
		self::FIELD_REGISTRATIEOMB=>10,
		self::FIELD_ORGANISATIE=>43.11,
		self::FIELD_ACTIEF=>'1');
	private $datum;
	private $thuis;
	private $elders;
	private $registratie;
	private $thuisPVS;
	private $eldersPVS;
	private $registratiePVS;
	private $zhTP;
	private $nietzhTP;
	private $registratieZhtp;
	private $registratieNietzhtp;
	private $omb;
	private $registratieomb;
	private $organisatie;
	private $actief;

	/**
	 * set value for datum 
	 *
	 * type:VARCHAR,size:8,default:,primary,index
	 *
	 * @param mixed $datum
	 * @return RizivTarieven
	 */
	public function &setDatum($datum) {
		$this->notifyChanged(self::FIELD_DATUM,$this->datum,$datum);
		$this->datum=$datum;
		return $this;
	}

	/**
	 * get value for datum 
	 *
	 * type:VARCHAR,size:8,default:,primary,index
	 *
	 * @return mixed
	 */
	public function getDatum() {
		return $this->datum;
	}

	/**
	 * set value for thuis 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @param mixed $thuis
	 * @return RizivTarieven
	 */
	public function &setThuis($thuis) {
		$this->notifyChanged(self::FIELD_THUIS,$this->thuis,$thuis);
		$this->thuis=$thuis;
		return $this;
	}

	/**
	 * get value for thuis 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @return mixed
	 */
	public function getThuis() {
		return $this->thuis;
	}

	/**
	 * set value for elders 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @param mixed $elders
	 * @return RizivTarieven
	 */
	public function &setElders($elders) {
		$this->notifyChanged(self::FIELD_ELDERS,$this->elders,$elders);
		$this->elders=$elders;
		return $this;
	}

	/**
	 * get value for elders 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @return mixed
	 */
	public function getElders() {
		return $this->elders;
	}

	/**
	 * set value for registratie 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @param mixed $registratie
	 * @return RizivTarieven
	 */
	public function &setRegistratie($registratie) {
		$this->notifyChanged(self::FIELD_REGISTRATIE,$this->registratie,$registratie);
		$this->registratie=$registratie;
		return $this;
	}

	/**
	 * get value for registratie 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @return mixed
	 */
	public function getRegistratie() {
		return $this->registratie;
	}

	/**
	 * set value for thuisPVS 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @param mixed $thuisPVS
	 * @return RizivTarieven
	 */
	public function &setThuisPVS($thuisPVS) {
		$this->notifyChanged(self::FIELD_THUISPVS,$this->thuisPVS,$thuisPVS);
		$this->thuisPVS=$thuisPVS;
		return $this;
	}

	/**
	 * get value for thuisPVS 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @return mixed
	 */
	public function getThuisPVS() {
		return $this->thuisPVS;
	}

	/**
	 * set value for eldersPVS 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @param mixed $eldersPVS
	 * @return RizivTarieven
	 */
	public function &setEldersPVS($eldersPVS) {
		$this->notifyChanged(self::FIELD_ELDERSPVS,$this->eldersPVS,$eldersPVS);
		$this->eldersPVS=$eldersPVS;
		return $this;
	}

	/**
	 * get value for eldersPVS 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @return mixed
	 */
	public function getEldersPVS() {
		return $this->eldersPVS;
	}

	/**
	 * set value for registratiePVS 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @param mixed $registratiePVS
	 * @return RizivTarieven
	 */
	public function &setRegistratiePVS($registratiePVS) {
		$this->notifyChanged(self::FIELD_REGISTRATIEPVS,$this->registratiePVS,$registratiePVS);
		$this->registratiePVS=$registratiePVS;
		return $this;
	}

	/**
	 * get value for registratiePVS 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @return mixed
	 */
	public function getRegistratiePVS() {
		return $this->registratiePVS;
	}

	/**
	 * set value for zhTP 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @param mixed $zhTP
	 * @return RizivTarieven
	 */
	public function &setZhTP($zhTP) {
		$this->notifyChanged(self::FIELD_ZHTP,$this->zhTP,$zhTP);
		$this->zhTP=$zhTP;
		return $this;
	}

	/**
	 * get value for zhTP 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @return mixed
	 */
	public function getZhTP() {
		return $this->zhTP;
	}

	/**
	 * set value for nietzhTP 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @param mixed $nietzhTP
	 * @return RizivTarieven
	 */
	public function &setNietzhTP($nietzhTP) {
		$this->notifyChanged(self::FIELD_NIETZHTP,$this->nietzhTP,$nietzhTP);
		$this->nietzhTP=$nietzhTP;
		return $this;
	}

	/**
	 * get value for nietzhTP 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @return mixed
	 */
	public function getNietzhTP() {
		return $this->nietzhTP;
	}

	/**
	 * set value for registratie_zhTP 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @param mixed $registratieZhtp
	 * @return RizivTarieven
	 */
	public function &setRegistratieZhtp($registratieZhtp) {
		$this->notifyChanged(self::FIELD_REGISTRATIE_ZHTP,$this->registratieZhtp,$registratieZhtp);
		$this->registratieZhtp=$registratieZhtp;
		return $this;
	}

	/**
	 * get value for registratie_zhTP 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @return mixed
	 */
	public function getRegistratieZhtp() {
		return $this->registratieZhtp;
	}

	/**
	 * set value for registratie_nietzhTP 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @param mixed $registratieNietzhtp
	 * @return RizivTarieven
	 */
	public function &setRegistratieNietzhtp($registratieNietzhtp) {
		$this->notifyChanged(self::FIELD_REGISTRATIE_NIETZHTP,$this->registratieNietzhtp,$registratieNietzhtp);
		$this->registratieNietzhtp=$registratieNietzhtp;
		return $this;
	}

	/**
	 * get value for registratie_nietzhTP 
	 *
	 * type:FLOAT,size:12,default:0
	 *
	 * @return mixed
	 */
	public function getRegistratieNietzhtp() {
		return $this->registratieNietzhtp;
	}

	/**
	 * set value for omb 
	 *
	 * type:DOUBLE,size:22,default:30
	 *
	 * @param mixed $omb
	 * @return RizivTarieven
	 */
	public function &setOmb($omb) {
		$this->notifyChanged(self::FIELD_OMB,$this->omb,$omb);
		$this->omb=$omb;
		return $this;
	}

	/**
	 * get value for omb 
	 *
	 * type:DOUBLE,size:22,default:30
	 *
	 * @return mixed
	 */
	public function getOmb() {
		return $this->omb;
	}

	/**
	 * set value for registratieomb 
	 *
	 * type:DOUBLE,size:22,default:10
	 *
	 * @param mixed $registratieomb
	 * @return RizivTarieven
	 */
	public function &setRegistratieomb($registratieomb) {
		$this->notifyChanged(self::FIELD_REGISTRATIEOMB,$this->registratieomb,$registratieomb);
		$this->registratieomb=$registratieomb;
		return $this;
	}

	/**
	 * get value for registratieomb 
	 *
	 * type:DOUBLE,size:22,default:10
	 *
	 * @return mixed
	 */
	public function getRegistratieomb() {
		return $this->registratieomb;
	}

	/**
	 * set value for organisatie 
	 *
	 * type:DOUBLE,size:22,default:43.11
	 *
	 * @param mixed $organisatie
	 * @return RizivTarieven
	 */
	public function &setOrganisatie($organisatie) {
		$this->notifyChanged(self::FIELD_ORGANISATIE,$this->organisatie,$organisatie);
		$this->organisatie=$organisatie;
		return $this;
	}

	/**
	 * get value for organisatie 
	 *
	 * type:DOUBLE,size:22,default:43.11
	 *
	 * @return mixed
	 */
	public function getOrganisatie() {
		return $this->organisatie;
	}

	/**
	 * set value for actief 
	 *
	 * type:BIT,size:0,default:1,index
	 *
	 * @param mixed $actief
	 * @return RizivTarieven
	 */
	public function &setActief($actief) {
		$this->notifyChanged(self::FIELD_ACTIEF,$this->actief,$actief);
		$this->actief=$actief;
		return $this;
	}

	/**
	 * get value for actief 
	 *
	 * type:BIT,size:0,default:1,index
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
			self::FIELD_DATUM=>$this->getDatum(),
			self::FIELD_THUIS=>$this->getThuis(),
			self::FIELD_ELDERS=>$this->getElders(),
			self::FIELD_REGISTRATIE=>$this->getRegistratie(),
			self::FIELD_THUISPVS=>$this->getThuisPVS(),
			self::FIELD_ELDERSPVS=>$this->getEldersPVS(),
			self::FIELD_REGISTRATIEPVS=>$this->getRegistratiePVS(),
			self::FIELD_ZHTP=>$this->getZhTP(),
			self::FIELD_NIETZHTP=>$this->getNietzhTP(),
			self::FIELD_REGISTRATIE_ZHTP=>$this->getRegistratieZhtp(),
			self::FIELD_REGISTRATIE_NIETZHTP=>$this->getRegistratieNietzhtp(),
			self::FIELD_OMB=>$this->getOmb(),
			self::FIELD_REGISTRATIEOMB=>$this->getRegistratieomb(),
			self::FIELD_ORGANISATIE=>$this->getOrganisatie(),
			self::FIELD_ACTIEF=>$this->getActief());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_DATUM=>$this->getDatum());
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
	 * Match by attributes of passed example instance and return matched rows as an array of RizivTarieven instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param RizivTarieven $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return RizivTarieven[]
	 */
	public static function findByExample(PDO $db,RizivTarieven $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of RizivTarieven instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return RizivTarieven[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `riziv_tarieven`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of RizivTarieven instances
	 *
	 * @param PDOStatement $stmt
	 * @return RizivTarieven[]
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
	 * returns the result as an array of RizivTarieven instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return RizivTarieven[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new RizivTarieven();
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
	 * Execute select query and return matched rows as an array of RizivTarieven instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return RizivTarieven[]
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
		$sql='DELETE FROM `riziv_tarieven`'
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
		$this->setDatum($result['datum']);
		$this->setThuis($result['thuis']);
		$this->setElders($result['elders']);
		$this->setRegistratie($result['registratie']);
		$this->setThuisPVS($result['thuisPVS']);
		$this->setEldersPVS($result['eldersPVS']);
		$this->setRegistratiePVS($result['registratiePVS']);
		$this->setZhTP($result['zhTP']);
		$this->setNietzhTP($result['nietzhTP']);
		$this->setRegistratieZhtp($result['registratie_zhTP']);
		$this->setRegistratieNietzhtp($result['registratie_nietzhTP']);
		$this->setOmb($result['omb']);
		$this->setRegistratieomb($result['registratieomb']);
		$this->setOrganisatie($result['organisatie']);
		$this->setActief($result['actief']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return RizivTarieven
	 */
	public static function findById(PDO $db,$datum) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$datum);
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
		$o=new RizivTarieven();
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
		$stmt->bindValue(1,$this->getDatum());
		$stmt->bindValue(2,$this->getThuis());
		$stmt->bindValue(3,$this->getElders());
		$stmt->bindValue(4,$this->getRegistratie());
		$stmt->bindValue(5,$this->getThuisPVS());
		$stmt->bindValue(6,$this->getEldersPVS());
		$stmt->bindValue(7,$this->getRegistratiePVS());
		$stmt->bindValue(8,$this->getZhTP());
		$stmt->bindValue(9,$this->getNietzhTP());
		$stmt->bindValue(10,$this->getRegistratieZhtp());
		$stmt->bindValue(11,$this->getRegistratieNietzhtp());
		$stmt->bindValue(12,$this->getOmb());
		$stmt->bindValue(13,$this->getRegistratieomb());
		$stmt->bindValue(14,$this->getOrganisatie());
		$stmt->bindValue(15,$this->getActief());
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
		$stmt->bindValue(16,$this->getDatum());
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
		$stmt->bindValue(1,$this->getDatum());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'RizivTarieven');
	}

	/**
	 * get single RizivTarieven instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return RizivTarieven
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new RizivTarieven();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of RizivTarieven from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return RizivTarieven[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('RizivTarieven') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>