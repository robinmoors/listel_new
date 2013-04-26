<?php
include_once 'util/Db2PhpEntityBase.class.php';
include_once 'util/Db2PhpEntityModificationTracking.class.php';
include_once 'util/DFCAggregate.class.php';
/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class AanvraagOverdracht extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='AanvraagOverdracht';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='aanvraag_overdracht';
	const SQL_INSERT='INSERT INTO `aanvraag_overdracht` (`id`,`patient`,`van_genre`,`van_id`,`naar_genre`,`naar_id`) VALUES (?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `aanvraag_overdracht` (`patient`,`van_genre`,`van_id`,`naar_genre`,`naar_id`) VALUES (?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `aanvraag_overdracht` SET `id`=?,`patient`=?,`van_genre`=?,`van_id`=?,`naar_genre`=?,`naar_id`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `aanvraag_overdracht` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `aanvraag_overdracht` WHERE `id`=?';
	const FIELD_ID=27254647;
	const FIELD_PATIENT=-247123415;
	const FIELD_VAN_GENRE=-536994933;
	const FIELD_VAN_ID=2103277587;
	const FIELD_NAAR_GENRE=378679556;
	const FIELD_NAAR_ID=-2039415494;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_PATIENT=>'patient',
		self::FIELD_VAN_GENRE=>'van_genre',
		self::FIELD_VAN_ID=>'van_id',
		self::FIELD_NAAR_GENRE=>'naar_genre',
		self::FIELD_NAAR_ID=>'naar_id');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_PATIENT=>'patient',
		self::FIELD_VAN_GENRE=>'vanGenre',
		self::FIELD_VAN_ID=>'vanId',
		self::FIELD_NAAR_GENRE=>'naarGenre',
		self::FIELD_NAAR_ID=>'naarId');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_PATIENT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VAN_GENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VAN_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NAAR_GENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_NAAR_ID=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_PATIENT=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_VAN_GENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,9,0,false),
		self::FIELD_VAN_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_NAAR_GENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,9,0,false),
		self::FIELD_NAAR_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_PATIENT=>'',
		self::FIELD_VAN_GENRE=>'',
		self::FIELD_VAN_ID=>0,
		self::FIELD_NAAR_GENRE=>'',
		self::FIELD_NAAR_ID=>0);
	private $id;
	private $patient;
	private $vanGenre;
	private $vanId;
	private $naarGenre;
	private $naarId;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return AanvraagOverdracht
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
	 * @return AanvraagOverdracht
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
	 * set value for van_genre 
	 *
	 * type:ENUM,size:9,default:null,index
	 *
	 * @param mixed $vanGenre
	 * @return AanvraagOverdracht
	 */
	public function &setVanGenre($vanGenre) {
		$this->notifyChanged(self::FIELD_VAN_GENRE,$this->vanGenre,$vanGenre);
		$this->vanGenre=$vanGenre;
		return $this;
	}

	/**
	 * get value for van_genre 
	 *
	 * type:ENUM,size:9,default:null,index
	 *
	 * @return mixed
	 */
	public function getVanGenre() {
		return $this->vanGenre;
	}

	/**
	 * set value for van_id 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $vanId
	 * @return AanvraagOverdracht
	 */
	public function &setVanId($vanId) {
		$this->notifyChanged(self::FIELD_VAN_ID,$this->vanId,$vanId);
		$this->vanId=$vanId;
		return $this;
	}

	/**
	 * get value for van_id 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @return mixed
	 */
	public function getVanId() {
		return $this->vanId;
	}

	/**
	 * set value for naar_genre 
	 *
	 * type:ENUM,size:9,default:null
	 *
	 * @param mixed $naarGenre
	 * @return AanvraagOverdracht
	 */
	public function &setNaarGenre($naarGenre) {
		$this->notifyChanged(self::FIELD_NAAR_GENRE,$this->naarGenre,$naarGenre);
		$this->naarGenre=$naarGenre;
		return $this;
	}

	/**
	 * get value for naar_genre 
	 *
	 * type:ENUM,size:9,default:null
	 *
	 * @return mixed
	 */
	public function getNaarGenre() {
		return $this->naarGenre;
	}

	/**
	 * set value for naar_id 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $naarId
	 * @return AanvraagOverdracht
	 */
	public function &setNaarId($naarId) {
		$this->notifyChanged(self::FIELD_NAAR_ID,$this->naarId,$naarId);
		$this->naarId=$naarId;
		return $this;
	}

	/**
	 * get value for naar_id 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getNaarId() {
		return $this->naarId;
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
			self::FIELD_VAN_GENRE=>$this->getVanGenre(),
			self::FIELD_VAN_ID=>$this->getVanId(),
			self::FIELD_NAAR_GENRE=>$this->getNaarGenre(),
			self::FIELD_NAAR_ID=>$this->getNaarId());
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
	 * Match by attributes of passed example instance and return matched rows as an array of AanvraagOverdracht instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param AanvraagOverdracht $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return AanvraagOverdracht[]
	 */
	public static function findByExample(PDO $db,AanvraagOverdracht $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of AanvraagOverdracht instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return AanvraagOverdracht[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `aanvraag_overdracht`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of AanvraagOverdracht instances
	 *
	 * @param PDOStatement $stmt
	 * @return AanvraagOverdracht[]
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
	 * returns the result as an array of AanvraagOverdracht instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return AanvraagOverdracht[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new AanvraagOverdracht();
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
	 * Execute select query and return matched rows as an array of AanvraagOverdracht instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return AanvraagOverdracht[]
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
		$sql='DELETE FROM `aanvraag_overdracht`'
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
		$this->setVanGenre($result['van_genre']);
		$this->setVanId($result['van_id']);
		$this->setNaarGenre($result['naar_genre']);
		$this->setNaarId($result['naar_id']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return AanvraagOverdracht
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
		$o=new AanvraagOverdracht();
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
		$stmt->bindValue(3,$this->getVanGenre());
		$stmt->bindValue(4,$this->getVanId());
		$stmt->bindValue(5,$this->getNaarGenre());
		$stmt->bindValue(6,$this->getNaarId());
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
			$stmt->bindValue(2,$this->getVanGenre());
			$stmt->bindValue(3,$this->getVanId());
			$stmt->bindValue(4,$this->getNaarGenre());
			$stmt->bindValue(5,$this->getNaarId());
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
		$stmt->bindValue(7,$this->getId());
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
	 * Fetch Patient which references this AanvraagOverdracht. Will return null in case reference is invalid.
	 * `aanvraag_overdracht`.`patient` -> `patient`.`code`
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
		return self::hashToDomDocument($this->toHash(), 'AanvraagOverdracht');
	}

	/**
	 * get single AanvraagOverdracht instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return AanvraagOverdracht
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new AanvraagOverdracht();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of AanvraagOverdracht from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return AanvraagOverdracht[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('AanvraagOverdracht') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>