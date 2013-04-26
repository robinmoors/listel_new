<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class PsyDomeinen extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='PsyDomeinen';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='psy_domeinen';
	const SQL_INSERT='INSERT INTO `psy_domeinen` (`id`,`code`,`datum`,`basis`,`woon`,`gemeenschap`,`taal`,`maatschappij`,`werk`,`gezin`,`school`,`sociaal`,`motoriek`,`persoonlijk`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `psy_domeinen` (`code`,`datum`,`basis`,`woon`,`gemeenschap`,`taal`,`maatschappij`,`werk`,`gezin`,`school`,`sociaal`,`motoriek`,`persoonlijk`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `psy_domeinen` SET `id`=?,`code`=?,`datum`=?,`basis`=?,`woon`=?,`gemeenschap`=?,`taal`=?,`maatschappij`=?,`werk`=?,`gezin`=?,`school`=?,`sociaal`=?,`motoriek`=?,`persoonlijk`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `psy_domeinen` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `psy_domeinen` WHERE `id`=?';
	const FIELD_ID=59226575;
	const FIELD_CODE=1081998753;
	const FIELD_DATUM=-817254597;
	const FIELD_BASIS=-819102966;
	const FIELD_WOON=1082594923;
	const FIELD_GEMEENSCHAP=654473556;
	const FIELD_TAAL=1082491660;
	const FIELD_MAATSCHAPPIJ=637747045;
	const FIELD_WERK=1082585403;
	const FIELD_GEZIN=-814359475;
	const FIELD_SCHOOL=865832488;
	const FIELD_SOCIAAL=1409743126;
	const FIELD_MOTORIEK=-621812754;
	const FIELD_PERSOONLIJK=153366818;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_CODE=>'code',
		self::FIELD_DATUM=>'datum',
		self::FIELD_BASIS=>'basis',
		self::FIELD_WOON=>'woon',
		self::FIELD_GEMEENSCHAP=>'gemeenschap',
		self::FIELD_TAAL=>'taal',
		self::FIELD_MAATSCHAPPIJ=>'maatschappij',
		self::FIELD_WERK=>'werk',
		self::FIELD_GEZIN=>'gezin',
		self::FIELD_SCHOOL=>'school',
		self::FIELD_SOCIAAL=>'sociaal',
		self::FIELD_MOTORIEK=>'motoriek',
		self::FIELD_PERSOONLIJK=>'persoonlijk');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_CODE=>'code',
		self::FIELD_DATUM=>'datum',
		self::FIELD_BASIS=>'basis',
		self::FIELD_WOON=>'woon',
		self::FIELD_GEMEENSCHAP=>'gemeenschap',
		self::FIELD_TAAL=>'taal',
		self::FIELD_MAATSCHAPPIJ=>'maatschappij',
		self::FIELD_WERK=>'werk',
		self::FIELD_GEZIN=>'gezin',
		self::FIELD_SCHOOL=>'school',
		self::FIELD_SOCIAAL=>'sociaal',
		self::FIELD_MOTORIEK=>'motoriek',
		self::FIELD_PERSOONLIJK=>'persoonlijk');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_CODE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DATUM=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_BASIS=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_WOON=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_GEMEENSCHAP=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_TAAL=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_MAATSCHAPPIJ=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_WERK=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_GEZIN=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_SCHOOL=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_SOCIAAL=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_MOTORIEK=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_PERSOONLIJK=>Db2PhpEntity::PHP_TYPE_BOOL);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_CODE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,30,0,false),
		self::FIELD_DATUM=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_BASIS=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_WOON=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_GEMEENSCHAP=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_TAAL=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_MAATSCHAPPIJ=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_WERK=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_GEZIN=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_SCHOOL=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_SOCIAAL=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_MOTORIEK=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_PERSOONLIJK=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_CODE=>'',
		self::FIELD_DATUM=>0,
		self::FIELD_BASIS=>'',
		self::FIELD_WOON=>'',
		self::FIELD_GEMEENSCHAP=>'',
		self::FIELD_TAAL=>'',
		self::FIELD_MAATSCHAPPIJ=>'',
		self::FIELD_WERK=>'',
		self::FIELD_GEZIN=>'',
		self::FIELD_SCHOOL=>'',
		self::FIELD_SOCIAAL=>'',
		self::FIELD_MOTORIEK=>'',
		self::FIELD_PERSOONLIJK=>'');
	private $id;
	private $code;
	private $datum;
	private $basis;
	private $woon;
	private $gemeenschap;
	private $taal;
	private $maatschappij;
	private $werk;
	private $gezin;
	private $school;
	private $sociaal;
	private $motoriek;
	private $persoonlijk;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,index,autoincrement
	 *
	 * @param mixed $id
	 * @return PsyDomeinen
	 */
	public function &setId($id) {
		$this->notifyChanged(self::FIELD_ID,$this->id,$id);
		$this->id=$id;
		return $this;
	}

	/**
	 * get value for id 
	 *
	 * type:INT,size:10,default:null,primary,index,autoincrement
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
	 * @return PsyDomeinen
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
	 * set value for datum 
	 *
	 * type:INT,size:10,default:null,index
	 *
	 * @param mixed $datum
	 * @return PsyDomeinen
	 */
	public function &setDatum($datum) {
		$this->notifyChanged(self::FIELD_DATUM,$this->datum,$datum);
		$this->datum=$datum;
		return $this;
	}

	/**
	 * get value for datum 
	 *
	 * type:INT,size:10,default:null,index
	 *
	 * @return mixed
	 */
	public function getDatum() {
		return $this->datum;
	}

	/**
	 * set value for basis 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $basis
	 * @return PsyDomeinen
	 */
	public function &setBasis($basis) {
		$this->notifyChanged(self::FIELD_BASIS,$this->basis,$basis);
		$this->basis=$basis;
		return $this;
	}

	/**
	 * get value for basis 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getBasis() {
		return $this->basis;
	}

	/**
	 * set value for woon 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $woon
	 * @return PsyDomeinen
	 */
	public function &setWoon($woon) {
		$this->notifyChanged(self::FIELD_WOON,$this->woon,$woon);
		$this->woon=$woon;
		return $this;
	}

	/**
	 * get value for woon 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getWoon() {
		return $this->woon;
	}

	/**
	 * set value for gemeenschap 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $gemeenschap
	 * @return PsyDomeinen
	 */
	public function &setGemeenschap($gemeenschap) {
		$this->notifyChanged(self::FIELD_GEMEENSCHAP,$this->gemeenschap,$gemeenschap);
		$this->gemeenschap=$gemeenschap;
		return $this;
	}

	/**
	 * get value for gemeenschap 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getGemeenschap() {
		return $this->gemeenschap;
	}

	/**
	 * set value for taal 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $taal
	 * @return PsyDomeinen
	 */
	public function &setTaal($taal) {
		$this->notifyChanged(self::FIELD_TAAL,$this->taal,$taal);
		$this->taal=$taal;
		return $this;
	}

	/**
	 * get value for taal 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getTaal() {
		return $this->taal;
	}

	/**
	 * set value for maatschappij 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $maatschappij
	 * @return PsyDomeinen
	 */
	public function &setMaatschappij($maatschappij) {
		$this->notifyChanged(self::FIELD_MAATSCHAPPIJ,$this->maatschappij,$maatschappij);
		$this->maatschappij=$maatschappij;
		return $this;
	}

	/**
	 * get value for maatschappij 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getMaatschappij() {
		return $this->maatschappij;
	}

	/**
	 * set value for werk 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $werk
	 * @return PsyDomeinen
	 */
	public function &setWerk($werk) {
		$this->notifyChanged(self::FIELD_WERK,$this->werk,$werk);
		$this->werk=$werk;
		return $this;
	}

	/**
	 * get value for werk 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getWerk() {
		return $this->werk;
	}

	/**
	 * set value for gezin 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $gezin
	 * @return PsyDomeinen
	 */
	public function &setGezin($gezin) {
		$this->notifyChanged(self::FIELD_GEZIN,$this->gezin,$gezin);
		$this->gezin=$gezin;
		return $this;
	}

	/**
	 * get value for gezin 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getGezin() {
		return $this->gezin;
	}

	/**
	 * set value for school 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $school
	 * @return PsyDomeinen
	 */
	public function &setSchool($school) {
		$this->notifyChanged(self::FIELD_SCHOOL,$this->school,$school);
		$this->school=$school;
		return $this;
	}

	/**
	 * get value for school 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getSchool() {
		return $this->school;
	}

	/**
	 * set value for sociaal 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $sociaal
	 * @return PsyDomeinen
	 */
	public function &setSociaal($sociaal) {
		$this->notifyChanged(self::FIELD_SOCIAAL,$this->sociaal,$sociaal);
		$this->sociaal=$sociaal;
		return $this;
	}

	/**
	 * get value for sociaal 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getSociaal() {
		return $this->sociaal;
	}

	/**
	 * set value for motoriek 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $motoriek
	 * @return PsyDomeinen
	 */
	public function &setMotoriek($motoriek) {
		$this->notifyChanged(self::FIELD_MOTORIEK,$this->motoriek,$motoriek);
		$this->motoriek=$motoriek;
		return $this;
	}

	/**
	 * get value for motoriek 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getMotoriek() {
		return $this->motoriek;
	}

	/**
	 * set value for persoonlijk 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @param mixed $persoonlijk
	 * @return PsyDomeinen
	 */
	public function &setPersoonlijk($persoonlijk) {
		$this->notifyChanged(self::FIELD_PERSOONLIJK,$this->persoonlijk,$persoonlijk);
		$this->persoonlijk=$persoonlijk;
		return $this;
	}

	/**
	 * get value for persoonlijk 
	 *
	 * type:BIT,size:0,default:null
	 *
	 * @return mixed
	 */
	public function getPersoonlijk() {
		return $this->persoonlijk;
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
			self::FIELD_DATUM=>$this->getDatum(),
			self::FIELD_BASIS=>$this->getBasis(),
			self::FIELD_WOON=>$this->getWoon(),
			self::FIELD_GEMEENSCHAP=>$this->getGemeenschap(),
			self::FIELD_TAAL=>$this->getTaal(),
			self::FIELD_MAATSCHAPPIJ=>$this->getMaatschappij(),
			self::FIELD_WERK=>$this->getWerk(),
			self::FIELD_GEZIN=>$this->getGezin(),
			self::FIELD_SCHOOL=>$this->getSchool(),
			self::FIELD_SOCIAAL=>$this->getSociaal(),
			self::FIELD_MOTORIEK=>$this->getMotoriek(),
			self::FIELD_PERSOONLIJK=>$this->getPersoonlijk());
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
	 * Match by attributes of passed example instance and return matched rows as an array of PsyDomeinen instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param PsyDomeinen $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return PsyDomeinen[]
	 */
	public static function findByExample(PDO $db,PsyDomeinen $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of PsyDomeinen instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return PsyDomeinen[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `psy_domeinen`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of PsyDomeinen instances
	 *
	 * @param PDOStatement $stmt
	 * @return PsyDomeinen[]
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
	 * returns the result as an array of PsyDomeinen instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return PsyDomeinen[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new PsyDomeinen();
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
	 * Execute select query and return matched rows as an array of PsyDomeinen instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return PsyDomeinen[]
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
		$sql='DELETE FROM `psy_domeinen`'
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
		$this->setDatum($result['datum']);
		$this->setBasis($result['basis']);
		$this->setWoon($result['woon']);
		$this->setGemeenschap($result['gemeenschap']);
		$this->setTaal($result['taal']);
		$this->setMaatschappij($result['maatschappij']);
		$this->setWerk($result['werk']);
		$this->setGezin($result['gezin']);
		$this->setSchool($result['school']);
		$this->setSociaal($result['sociaal']);
		$this->setMotoriek($result['motoriek']);
		$this->setPersoonlijk($result['persoonlijk']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return PsyDomeinen
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
		$o=new PsyDomeinen();
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
		$stmt->bindValue(3,$this->getDatum());
		$stmt->bindValue(4,$this->getBasis());
		$stmt->bindValue(5,$this->getWoon());
		$stmt->bindValue(6,$this->getGemeenschap());
		$stmt->bindValue(7,$this->getTaal());
		$stmt->bindValue(8,$this->getMaatschappij());
		$stmt->bindValue(9,$this->getWerk());
		$stmt->bindValue(10,$this->getGezin());
		$stmt->bindValue(11,$this->getSchool());
		$stmt->bindValue(12,$this->getSociaal());
		$stmt->bindValue(13,$this->getMotoriek());
		$stmt->bindValue(14,$this->getPersoonlijk());
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
			$stmt->bindValue(2,$this->getDatum());
			$stmt->bindValue(3,$this->getBasis());
			$stmt->bindValue(4,$this->getWoon());
			$stmt->bindValue(5,$this->getGemeenschap());
			$stmt->bindValue(6,$this->getTaal());
			$stmt->bindValue(7,$this->getMaatschappij());
			$stmt->bindValue(8,$this->getWerk());
			$stmt->bindValue(9,$this->getGezin());
			$stmt->bindValue(10,$this->getSchool());
			$stmt->bindValue(11,$this->getSociaal());
			$stmt->bindValue(12,$this->getMotoriek());
			$stmt->bindValue(13,$this->getPersoonlijk());
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
		$stmt->bindValue(15,$this->getId());
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
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'PsyDomeinen');
	}

	/**
	 * get single PsyDomeinen instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return PsyDomeinen
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new PsyDomeinen();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of PsyDomeinen from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return PsyDomeinen[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('PsyDomeinen') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>