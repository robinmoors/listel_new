<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class EvaluatieRechten extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='EvaluatieRechten';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='evaluatie_rechten';
	const SQL_INSERT='INSERT INTO `evaluatie_rechten` (`evaluatie`,`genre`,`id`,`rechten`) VALUES (?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `evaluatie_rechten` (`evaluatie`,`genre`,`id`,`rechten`) VALUES (?,?,?,?)';
	const SQL_UPDATE='UPDATE `evaluatie_rechten` SET `evaluatie`=?,`genre`=?,`id`=?,`rechten`=? WHERE `evaluatie`=?';
	const SQL_SELECT_PK='SELECT * FROM `evaluatie_rechten` WHERE `evaluatie`=?';
	const SQL_DELETE_PK='DELETE FROM `evaluatie_rechten` WHERE `evaluatie`=?';
	const FIELD_EVALUATIE=528639720;
	const FIELD_GENRE=-501724925;
	const FIELD_ID=156695963;
	const FIELD_RECHTEN=40851141;
	private static $PRIMARY_KEYS=array(self::FIELD_EVALUATIE);
	private static $AUTOINCREMENT_FIELDS=array();
	private static $FIELD_NAMES=array(
		self::FIELD_EVALUATIE=>'evaluatie',
		self::FIELD_GENRE=>'genre',
		self::FIELD_ID=>'id',
		self::FIELD_RECHTEN=>'rechten');
	private static $PROPERTY_NAMES=array(
		self::FIELD_EVALUATIE=>'evaluatie',
		self::FIELD_GENRE=>'genre',
		self::FIELD_ID=>'id',
		self::FIELD_RECHTEN=>'rechten');
	private static $PROPERTY_TYPES=array(
		self::FIELD_EVALUATIE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_GENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_RECHTEN=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_EVALUATIE=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_GENRE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,60,0,false),
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_RECHTEN=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_EVALUATIE=>0,
		self::FIELD_GENRE=>'',
		self::FIELD_ID=>0,
		self::FIELD_RECHTEN=>0);
	private $evaluatie;
	private $genre;
	private $id;
	private $rechten;

	/**
	 * set value for evaluatie 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $evaluatie
	 * @return EvaluatieRechten
	 */
	public function &setEvaluatie($evaluatie) {
		$this->notifyChanged(self::FIELD_EVALUATIE,$this->evaluatie,$evaluatie);
		$this->evaluatie=$evaluatie;
		return $this;
	}

	/**
	 * get value for evaluatie 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @return mixed
	 */
	public function getEvaluatie() {
		return $this->evaluatie;
	}

	/**
	 * set value for genre 
	 *
	 * type:VARCHAR,size:60,default:
	 *
	 * @param mixed $genre
	 * @return EvaluatieRechten
	 */
	public function &setGenre($genre) {
		$this->notifyChanged(self::FIELD_GENRE,$this->genre,$genre);
		$this->genre=$genre;
		return $this;
	}

	/**
	 * get value for genre 
	 *
	 * type:VARCHAR,size:60,default:
	 *
	 * @return mixed
	 */
	public function getGenre() {
		return $this->genre;
	}

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $id
	 * @return EvaluatieRechten
	 */
	public function &setId($id) {
		$this->notifyChanged(self::FIELD_ID,$this->id,$id);
		$this->id=$id;
		return $this;
	}

	/**
	 * get value for id 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * set value for rechten 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $rechten
	 * @return EvaluatieRechten
	 */
	public function &setRechten($rechten) {
		$this->notifyChanged(self::FIELD_RECHTEN,$this->rechten,$rechten);
		$this->rechten=$rechten;
		return $this;
	}

	/**
	 * get value for rechten 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getRechten() {
		return $this->rechten;
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
			self::FIELD_EVALUATIE=>$this->getEvaluatie(),
			self::FIELD_GENRE=>$this->getGenre(),
			self::FIELD_ID=>$this->getId(),
			self::FIELD_RECHTEN=>$this->getRechten());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_EVALUATIE=>$this->getEvaluatie());
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
	 * Match by attributes of passed example instance and return matched rows as an array of EvaluatieRechten instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param EvaluatieRechten $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return EvaluatieRechten[]
	 */
	public static function findByExample(PDO $db,EvaluatieRechten $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of EvaluatieRechten instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return EvaluatieRechten[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `evaluatie_rechten`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of EvaluatieRechten instances
	 *
	 * @param PDOStatement $stmt
	 * @return EvaluatieRechten[]
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
	 * returns the result as an array of EvaluatieRechten instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return EvaluatieRechten[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new EvaluatieRechten();
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
	 * Execute select query and return matched rows as an array of EvaluatieRechten instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return EvaluatieRechten[]
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
		$sql='DELETE FROM `evaluatie_rechten`'
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
		$this->setEvaluatie($result['evaluatie']);
		$this->setGenre($result['genre']);
		$this->setId($result['id']);
		$this->setRechten($result['rechten']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return EvaluatieRechten
	 */
	public static function findById(PDO $db,$evaluatie) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$evaluatie);
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
		$o=new EvaluatieRechten();
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
		$stmt->bindValue(1,$this->getEvaluatie());
		$stmt->bindValue(2,$this->getGenre());
		$stmt->bindValue(3,$this->getId());
		$stmt->bindValue(4,$this->getRechten());
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
		$stmt->bindValue(5,$this->getEvaluatie());
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
		$stmt->bindValue(1,$this->getEvaluatie());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch Evaluatie which references this EvaluatieRechten. Will return null in case reference is invalid.
	 * `evaluatie_rechten`.`evaluatie` -> `evaluatie`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Evaluatie
	 */
	public function fetchEvaluatie(PDO $db, $sort=null) {
		$filter=array(Evaluatie::FIELD_ID=>$this->getEvaluatie());
		$result=Evaluatie::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'EvaluatieRechten');
	}

	/**
	 * get single EvaluatieRechten instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return EvaluatieRechten
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new EvaluatieRechten();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of EvaluatieRechten from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return EvaluatieRechten[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('EvaluatieRechten') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>