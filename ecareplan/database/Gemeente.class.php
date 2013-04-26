<?php

include_once 'util/Db2PhpEntityBase.class.php';
include_once 'util/Db2PhpEntityModificationTracking.class.php';

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Gemeente extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Gemeente';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='gemeente';
	const SQL_INSERT='INSERT INTO `gemeente` (`id`,`zip`,`naam`,`dlzip`,`dlnaam`,`taal`,`sit_id`,`deelvzw`) VALUES (?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `gemeente` (`zip`,`naam`,`dlzip`,`dlnaam`,`taal`,`sit_id`,`deelvzw`) VALUES (?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `gemeente` SET `id`=?,`zip`=?,`naam`=?,`dlzip`=?,`dlnaam`=?,`taal`=?,`sit_id`=?,`deelvzw`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `gemeente` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `gemeente` WHERE `id`=?';
	const FIELD_ID=118702841;
	const FIELD_ZIP=-615162621;
	const FIELD_NAAM=-1890537603;
	const FIELD_DLZIP=1513992955;
	const FIELD_DLNAAM=-311224187;
	const FIELD_TAAL=-1890358858;
	const FIELD_SIT_ID=115619578;
	const FIELD_DEELVZW=-1266382547;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_ZIP=>'zip',
		self::FIELD_NAAM=>'naam',
		self::FIELD_DLZIP=>'dlzip',
		self::FIELD_DLNAAM=>'dlnaam',
		self::FIELD_TAAL=>'taal',
		self::FIELD_SIT_ID=>'sit_id',
		self::FIELD_DEELVZW=>'deelvzw');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_ZIP=>'zip',
		self::FIELD_NAAM=>'naam',
		self::FIELD_DLZIP=>'dlzip',
		self::FIELD_DLNAAM=>'dlnaam',
		self::FIELD_TAAL=>'taal',
		self::FIELD_SIT_ID=>'sitId',
		self::FIELD_DEELVZW=>'deelvzw');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_ZIP=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DLZIP=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DLNAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TAAL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SIT_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DEELVZW=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_SMALLINT,5,0,false),
		self::FIELD_ZIP=>array(Db2PhpEntity::JDBC_TYPE_SMALLINT,5,0,false),
		self::FIELD_NAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,false),
		self::FIELD_DLZIP=>array(Db2PhpEntity::JDBC_TYPE_SMALLINT,5,0,false),
		self::FIELD_DLNAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,false),
		self::FIELD_TAAL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,8,0,false),
		self::FIELD_SIT_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_DEELVZW=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_ZIP=>0,
		self::FIELD_NAAM=>'',
		self::FIELD_DLZIP=>0,
		self::FIELD_DLNAAM=>'',
		self::FIELD_TAAL=>'',
		self::FIELD_SIT_ID=>null,
		self::FIELD_DEELVZW=>null);
	private $id;
	private $zip;
	private $naam;
	private $dlzip;
	private $dlnaam;
	private $taal;
	private $sitId;
	private $deelvzw;

	/**
	 * set value for id 
	 *
	 * type:SMALLINT,size:5,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return Gemeente
	 */
	public function &setId($id) {
		$this->notifyChanged(self::FIELD_ID,$this->id,$id);
		$this->id=$id;
		return $this;
	}

	/**
	 * get value for id 
	 *
	 * type:SMALLINT,size:5,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * set value for zip 
	 *
	 * type:SMALLINT,size:5,default:0,unique
	 *
	 * @param mixed $zip
	 * @return Gemeente
	 */
	public function &setZip($zip) {
		$this->notifyChanged(self::FIELD_ZIP,$this->zip,$zip);
		$this->zip=$zip;
		return $this;
	}

	/**
	 * get value for zip 
	 *
	 * type:SMALLINT,size:5,default:0,unique
	 *
	 * @return mixed
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * set value for naam 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @param mixed $naam
	 * @return Gemeente
	 */
	public function &setNaam($naam) {
		$this->notifyChanged(self::FIELD_NAAM,$this->naam,$naam);
		$this->naam=$naam;
		return $this;
	}

	/**
	 * get value for naam 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @return mixed
	 */
	public function getNaam() {
		return $this->naam;
	}

	/**
	 * set value for dlzip 
	 *
	 * type:SMALLINT,size:5,default:0
	 *
	 * @param mixed $dlzip
	 * @return Gemeente
	 */
	public function &setDlzip($dlzip) {
		$this->notifyChanged(self::FIELD_DLZIP,$this->dlzip,$dlzip);
		$this->dlzip=$dlzip;
		return $this;
	}

	/**
	 * get value for dlzip 
	 *
	 * type:SMALLINT,size:5,default:0
	 *
	 * @return mixed
	 */
	public function getDlzip() {
		return $this->dlzip;
	}

	/**
	 * set value for dlnaam 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @param mixed $dlnaam
	 * @return Gemeente
	 */
	public function &setDlnaam($dlnaam) {
		$this->notifyChanged(self::FIELD_DLNAAM,$this->dlnaam,$dlnaam);
		$this->dlnaam=$dlnaam;
		return $this;
	}

	/**
	 * get value for dlnaam 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @return mixed
	 */
	public function getDlnaam() {
		return $this->dlnaam;
	}

	/**
	 * set value for taal 
	 *
	 * type:VARCHAR,size:8,default:
	 *
	 * @param mixed $taal
	 * @return Gemeente
	 */
	public function &setTaal($taal) {
		$this->notifyChanged(self::FIELD_TAAL,$this->taal,$taal);
		$this->taal=$taal;
		return $this;
	}

	/**
	 * get value for taal 
	 *
	 * type:VARCHAR,size:8,default:
	 *
	 * @return mixed
	 */
	public function getTaal() {
		return $this->taal;
	}

	/**
	 * set value for sit_id 
	 *
	 * type:INT,size:10,default:-1,index
	 *
	 * @param mixed $sitId
	 * @return Gemeente
	 */
	public function &setSitId($sitId) {
		$this->notifyChanged(self::FIELD_SIT_ID,$this->sitId,$sitId);
		$this->sitId=$sitId;
		return $this;
	}

	/**
	 * get value for sit_id 
	 *
	 * type:INT,size:10,default:-1,index
	 *
	 * @return mixed
	 */
	public function getSitId() {
		return $this->sitId;
	}

	/**
	 * set value for deelvzw 
	 *
	 * type:ENUM,size:2,default:null,nullable
	 *
	 * @param mixed $deelvzw
	 * @return Gemeente
	 */
	public function &setDeelvzw($deelvzw) {
		$this->notifyChanged(self::FIELD_DEELVZW,$this->deelvzw,$deelvzw);
		$this->deelvzw=$deelvzw;
		return $this;
	}

	/**
	 * get value for deelvzw 
	 *
	 * type:ENUM,size:2,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDeelvzw() {
		return $this->deelvzw;
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
			self::FIELD_ZIP=>$this->getZip(),
			self::FIELD_NAAM=>$this->getNaam(),
			self::FIELD_DLZIP=>$this->getDlzip(),
			self::FIELD_DLNAAM=>$this->getDlnaam(),
			self::FIELD_TAAL=>$this->getTaal(),
			self::FIELD_SIT_ID=>$this->getSitId(),
			self::FIELD_DEELVZW=>$this->getDeelvzw());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Gemeente instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Gemeente $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Gemeente[]
	 */
	public static function findByExample(PDO $db,Gemeente $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Gemeente instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Gemeente[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `gemeente`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Gemeente instances
	 *
	 * @param PDOStatement $stmt
	 * @return Gemeente[]
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
	 * returns the result as an array of Gemeente instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Gemeente[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Gemeente();
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
	 * Execute select query and return matched rows as an array of Gemeente instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Gemeente[]
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
		$sql='DELETE FROM `gemeente`'
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
		$this->setZip($result['zip']);
		$this->setNaam($result['naam']);
		$this->setDlzip($result['dlzip']);
		$this->setDlnaam($result['dlnaam']);
		$this->setTaal($result['taal']);
		$this->setSitId($result['sit_id']);
		$this->setDeelvzw($result['deelvzw']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Gemeente
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
		$o=new Gemeente();
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
		$stmt->bindValue(2,$this->getZip());
		$stmt->bindValue(3,$this->getNaam());
		$stmt->bindValue(4,$this->getDlzip());
		$stmt->bindValue(5,$this->getDlnaam());
		$stmt->bindValue(6,$this->getTaal());
		$stmt->bindValue(7,$this->getSitId());
		$stmt->bindValue(8,$this->getDeelvzw());
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
			$stmt->bindValue(1,$this->getZip());
			$stmt->bindValue(2,$this->getNaam());
			$stmt->bindValue(3,$this->getDlzip());
			$stmt->bindValue(4,$this->getDlnaam());
			$stmt->bindValue(5,$this->getTaal());
			$stmt->bindValue(6,$this->getSitId());
			$stmt->bindValue(7,$this->getDeelvzw());
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
		$stmt->bindValue(9,$this->getId());
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
	 * Fetch AanvraagOverleg's which this Gemeente references.
	 * `gemeente`.`id` -> `aanvraag_overleg`.`gemeente_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return AanvraagOverleg[]
	 */
	public function fetchAanvraagOverlegCollection(PDO $db, $sort=null) {
		$filter=array(AanvraagOverleg::FIELD_GEMEENTE_ID=>$this->getId());
		return AanvraagOverleg::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Hulpverleners's which this Gemeente references.
	 * `gemeente`.`id` -> `hulpverleners`.`gem_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Hulpverleners[]
	 */
	public function fetchHulpverlenersCollection(PDO $db, $sort=null) {
		$filter=array(Hulpverleners::FIELD_GEM_ID=>$this->getId());
		return Hulpverleners::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Logins's which this Gemeente references.
	 * `gemeente`.`zip` -> `logins`.`overleg_gemeente`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Logins[]
	 */
	public function fetchLoginsCollection(PDO $db, $sort=null) {
		$filter=array(Logins::FIELD_OVERLEG_GEMEENTE=>$this->getZip());
		return Logins::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Mantelzorgers's which this Gemeente references.
	 * `gemeente`.`id` -> `mantelzorgers`.`gem_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Mantelzorgers[]
	 */
	public function fetchMantelzorgersCollection(PDO $db, $sort=null) {
		$filter=array(Mantelzorgers::FIELD_GEM_ID=>$this->getId());
		return Mantelzorgers::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Organisatie's which this Gemeente references.
	 * `gemeente`.`id` -> `organisatie`.`gem_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Organisatie[]
	 */
	public function fetchOrganisatieCollection(PDO $db, $sort=null) {
		$filter=array(Organisatie::FIELD_GEM_ID=>$this->getId());
		return Organisatie::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Patient's which this Gemeente references.
	 * `gemeente`.`id` -> `patient`.`gem_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Patient[]
	 */
	public function fetchPatientCollection(PDO $db, $sort=null) {
		$filter=array(Patient::FIELD_GEM_ID=>$this->getId());
		return Patient::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Verzekering's which this Gemeente references.
	 * `gemeente`.`id` -> `verzekering`.`gem_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Verzekering[]
	 */
	public function fetchVerzekeringCollection(PDO $db, $sort=null) {
		$filter=array(Verzekering::FIELD_GEM_ID=>$this->getId());
		return Verzekering::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Sit which references this Gemeente. Will return null in case reference is invalid.
	 * `gemeente`.`sit_id` -> `sit`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Sit
	 */
	public function fetchSit(PDO $db, $sort=null) {
		$filter=array(Sit::FIELD_ID=>$this->getSitId());
		$result=Sit::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'Gemeente');
	}

	/**
	 * get single Gemeente instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Gemeente
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Gemeente();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Gemeente from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Gemeente[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Gemeente') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>