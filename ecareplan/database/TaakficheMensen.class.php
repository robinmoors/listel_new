<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class TaakficheMensen extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='TaakficheMensen';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='taakfiche_mensen';
	const SQL_INSERT='INSERT INTO `taakfiche_mensen` (`mens_id`,`mens_type`,`taakfiche_id`) VALUES (?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `taakfiche_mensen` (`mens_id`,`mens_type`,`taakfiche_id`) VALUES (?,?,?)';
	const SQL_UPDATE='UPDATE `taakfiche_mensen` SET `mens_id`=?,`mens_type`=?,`taakfiche_id`=? WHERE `mens_id`=? AND `mens_type`=? AND `taakfiche_id`=?';
	const SQL_SELECT_PK='SELECT * FROM `taakfiche_mensen` WHERE `mens_id`=? AND `mens_type`=? AND `taakfiche_id`=?';
	const SQL_DELETE_PK='DELETE FROM `taakfiche_mensen` WHERE `mens_id`=? AND `mens_type`=? AND `taakfiche_id`=?';
	const FIELD_MENS_ID=-1081415314;
	const FIELD_MENS_TYPE=142320333;
	const FIELD_TAAKFICHE_ID=1868208227;
	private static $PRIMARY_KEYS=array(self::FIELD_MENS_ID,self::FIELD_MENS_TYPE,self::FIELD_TAAKFICHE_ID);
	private static $AUTOINCREMENT_FIELDS=array();
	private static $FIELD_NAMES=array(
		self::FIELD_MENS_ID=>'mens_id',
		self::FIELD_MENS_TYPE=>'mens_type',
		self::FIELD_TAAKFICHE_ID=>'taakfiche_id');
	private static $PROPERTY_NAMES=array(
		self::FIELD_MENS_ID=>'mensId',
		self::FIELD_MENS_TYPE=>'mensType',
		self::FIELD_TAAKFICHE_ID=>'taakficheId');
	private static $PROPERTY_TYPES=array(
		self::FIELD_MENS_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MENS_TYPE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TAAKFICHE_ID=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_MENS_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_MENS_TYPE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,5,0,false),
		self::FIELD_TAAKFICHE_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_MENS_ID=>0,
		self::FIELD_MENS_TYPE=>'0',
		self::FIELD_TAAKFICHE_ID=>0);
	private $mensId;
	private $mensType;
	private $taakficheId;

	/**
	 * set value for mens_id 
	 *
	 * type:INT,size:10,default:0,primary,unique
	 *
	 * @param mixed $mensId
	 * @return TaakficheMensen
	 */
	public function &setMensId($mensId) {
		$this->notifyChanged(self::FIELD_MENS_ID,$this->mensId,$mensId);
		$this->mensId=$mensId;
		return $this;
	}

	/**
	 * get value for mens_id 
	 *
	 * type:INT,size:10,default:0,primary,unique
	 *
	 * @return mixed
	 */
	public function getMensId() {
		return $this->mensId;
	}

	/**
	 * set value for mens_type 
	 *
	 * type:VARCHAR,size:5,default:0,primary,index
	 *
	 * @param mixed $mensType
	 * @return TaakficheMensen
	 */
	public function &setMensType($mensType) {
		$this->notifyChanged(self::FIELD_MENS_TYPE,$this->mensType,$mensType);
		$this->mensType=$mensType;
		return $this;
	}

	/**
	 * get value for mens_type 
	 *
	 * type:VARCHAR,size:5,default:0,primary,index
	 *
	 * @return mixed
	 */
	public function getMensType() {
		return $this->mensType;
	}

	/**
	 * set value for taakfiche_id 
	 *
	 * type:INT,size:10,default:0,primary,index
	 *
	 * @param mixed $taakficheId
	 * @return TaakficheMensen
	 */
	public function &setTaakficheId($taakficheId) {
		$this->notifyChanged(self::FIELD_TAAKFICHE_ID,$this->taakficheId,$taakficheId);
		$this->taakficheId=$taakficheId;
		return $this;
	}

	/**
	 * get value for taakfiche_id 
	 *
	 * type:INT,size:10,default:0,primary,index
	 *
	 * @return mixed
	 */
	public function getTaakficheId() {
		return $this->taakficheId;
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
			self::FIELD_MENS_ID=>$this->getMensId(),
			self::FIELD_MENS_TYPE=>$this->getMensType(),
			self::FIELD_TAAKFICHE_ID=>$this->getTaakficheId());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_MENS_ID=>$this->getMensId(),
			self::FIELD_MENS_TYPE=>$this->getMensType(),
			self::FIELD_TAAKFICHE_ID=>$this->getTaakficheId());
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
	 * Match by attributes of passed example instance and return matched rows as an array of TaakficheMensen instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param TaakficheMensen $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return TaakficheMensen[]
	 */
	public static function findByExample(PDO $db,TaakficheMensen $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of TaakficheMensen instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return TaakficheMensen[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `taakfiche_mensen`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of TaakficheMensen instances
	 *
	 * @param PDOStatement $stmt
	 * @return TaakficheMensen[]
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
	 * returns the result as an array of TaakficheMensen instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return TaakficheMensen[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new TaakficheMensen();
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
	 * Execute select query and return matched rows as an array of TaakficheMensen instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return TaakficheMensen[]
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
		$sql='DELETE FROM `taakfiche_mensen`'
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
		$this->setMensId($result['mens_id']);
		$this->setMensType($result['mens_type']);
		$this->setTaakficheId($result['taakfiche_id']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return TaakficheMensen
	 */
	public static function findById(PDO $db,$mensId,$mensType,$taakficheId) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$mensId);
		$stmt->bindValue(2,$mensType);
		$stmt->bindValue(3,$taakficheId);
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
		$o=new TaakficheMensen();
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
		$stmt->bindValue(1,$this->getMensId());
		$stmt->bindValue(2,$this->getMensType());
		$stmt->bindValue(3,$this->getTaakficheId());
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
		$stmt->bindValue(4,$this->getMensId());
		$stmt->bindValue(5,$this->getMensType());
		$stmt->bindValue(6,$this->getTaakficheId());
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
		$stmt->bindValue(1,$this->getMensId());
		$stmt->bindValue(2,$this->getMensType());
		$stmt->bindValue(3,$this->getTaakficheId());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch Hulpverleners which references this TaakficheMensen. Will return null in case reference is invalid.
	 * `taakfiche_mensen`.`mens_id` -> `hulpverleners`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Hulpverleners
	 */
	public function fetchHulpverleners(PDO $db, $sort=null) {
		$filter=array(Hulpverleners::FIELD_ID=>$this->getMensId());
		$result=Hulpverleners::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Mantelzorgers which references this TaakficheMensen. Will return null in case reference is invalid.
	 * `taakfiche_mensen`.`mens_id` -> `mantelzorgers`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Mantelzorgers
	 */
	public function fetchMantelzorgers(PDO $db, $sort=null) {
		$filter=array(Mantelzorgers::FIELD_ID=>$this->getMensId());
		$result=Mantelzorgers::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Taakfiche which references this TaakficheMensen. Will return null in case reference is invalid.
	 * `taakfiche_mensen`.`taakfiche_id` -> `taakfiche`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Taakfiche
	 */
	public function fetchTaakfiche(PDO $db, $sort=null) {
		$filter=array(Taakfiche::FIELD_ID=>$this->getTaakficheId());
		$result=Taakfiche::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'TaakficheMensen');
	}

	/**
	 * get single TaakficheMensen instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return TaakficheMensen
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new TaakficheMensen();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of TaakficheMensen from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return TaakficheMensen[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('TaakficheMensen') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>