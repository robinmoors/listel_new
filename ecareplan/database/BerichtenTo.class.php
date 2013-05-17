<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class BerichtenTo extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='BerichtenTo';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='berichten_to';
	const SQL_INSERT='INSERT INTO `berichten_to` (`bericht`,`persoon`,`genre`,`status`,`gelezen`,`actief`) VALUES (?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `berichten_to` (`bericht`,`persoon`,`genre`,`status`,`gelezen`,`actief`) VALUES (?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `berichten_to` SET `bericht`=?,`persoon`=?,`genre`=?,`status`=?,`gelezen`=?,`actief`=? WHERE `bericht`=? AND `persoon`=? AND `genre`=?';
	const SQL_SELECT_PK='SELECT * FROM `berichten_to` WHERE `bericht`=? AND `persoon`=? AND `genre`=?';
	const SQL_DELETE_PK='DELETE FROM `berichten_to` WHERE `bericht`=? AND `persoon`=? AND `genre`=?';
	const FIELD_BERICHT=-987957501;
	const FIELD_PERSOON=-1447498202;
	const FIELD_GENRE=749953873;
	const FIELD_STATUS=2130751460;
	const FIELD_GELEZEN=-851044678;
	const FIELD_ACTIEF=1600281834;
	private static $PRIMARY_KEYS=array(self::FIELD_BERICHT,self::FIELD_PERSOON,self::FIELD_GENRE);
	private static $AUTOINCREMENT_FIELDS=array();
	private static $FIELD_NAMES=array(
		self::FIELD_BERICHT=>'bericht',
		self::FIELD_PERSOON=>'persoon',
		self::FIELD_GENRE=>'genre',
		self::FIELD_STATUS=>'status',
		self::FIELD_GELEZEN=>'gelezen',
		self::FIELD_ACTIEF=>'actief');
	private static $PROPERTY_NAMES=array(
		self::FIELD_BERICHT=>'bericht',
		self::FIELD_PERSOON=>'persoon',
		self::FIELD_GENRE=>'genre',
		self::FIELD_STATUS=>'status',
		self::FIELD_GELEZEN=>'gelezen',
		self::FIELD_ACTIEF=>'actief');
	private static $PROPERTY_TYPES=array(
		self::FIELD_BERICHT=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_PERSOON=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_GENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_STATUS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GELEZEN=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_ACTIEF=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_BERICHT=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_PERSOON=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_GENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,8,0,false),
		self::FIELD_STATUS=>array(Db2PhpEntity::JDBC_TYPE_CHAR,3,0,false),
		self::FIELD_GELEZEN=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_ACTIEF=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_BERICHT=>0,
		self::FIELD_PERSOON=>0,
		self::FIELD_GENRE=>'gemeente',
		self::FIELD_STATUS=>'to',
		self::FIELD_GELEZEN=>0,
		self::FIELD_ACTIEF=>1);
	private $bericht;
	private $persoon;
	private $genre;
	private $status;
	private $gelezen;
	private $actief;

	/**
	 * set value for bericht 
	 *
	 * type:INT,size:10,default:0,primary,unique
	 *
	 * @param mixed $bericht
	 * @return BerichtenTo
	 */
	public function &setBericht($bericht) {
		$this->notifyChanged(self::FIELD_BERICHT,$this->bericht,$bericht);
		$this->bericht=$bericht;
		return $this;
	}

	/**
	 * get value for bericht 
	 *
	 * type:INT,size:10,default:0,primary,unique
	 *
	 * @return mixed
	 */
	public function getBericht() {
		return $this->bericht;
	}

	/**
	 * set value for persoon 
	 *
	 * type:INT,size:10,default:0,primary,index
	 *
	 * @param mixed $persoon
	 * @return BerichtenTo
	 */
	public function &setPersoon($persoon) {
		$this->notifyChanged(self::FIELD_PERSOON,$this->persoon,$persoon);
		$this->persoon=$persoon;
		return $this;
	}

	/**
	 * get value for persoon 
	 *
	 * type:INT,size:10,default:0,primary,index
	 *
	 * @return mixed
	 */
	public function getPersoon() {
		return $this->persoon;
	}

	/**
	 * set value for genre 
	 *
	 * type:ENUM,size:8,default:gemeente,primary,unique
	 *
	 * @param mixed $genre
	 * @return BerichtenTo
	 */
	public function &setGenre($genre) {
		$this->notifyChanged(self::FIELD_GENRE,$this->genre,$genre);
		$this->genre=$genre;
		return $this;
	}

	/**
	 * get value for genre 
	 *
	 * type:ENUM,size:8,default:gemeente,primary,unique
	 *
	 * @return mixed
	 */
	public function getGenre() {
		return $this->genre;
	}

	/**
	 * set value for status 
	 *
	 * type:ENUM,size:3,default:to
	 *
	 * @param mixed $status
	 * @return BerichtenTo
	 */
	public function &setStatus($status) {
		$this->notifyChanged(self::FIELD_STATUS,$this->status,$status);
		$this->status=$status;
		return $this;
	}

	/**
	 * get value for status 
	 *
	 * type:ENUM,size:3,default:to
	 *
	 * @return mixed
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * set value for gelezen 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $gelezen
	 * @return BerichtenTo
	 */
	public function &setGelezen($gelezen) {
		$this->notifyChanged(self::FIELD_GELEZEN,$this->gelezen,$gelezen);
		$this->gelezen=$gelezen;
		return $this;
	}

	/**
	 * get value for gelezen 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getGelezen() {
		return $this->gelezen;
	}

	/**
	 * set value for actief 
	 *
	 * type:INT,size:10,default:1
	 *
	 * @param mixed $actief
	 * @return BerichtenTo
	 */
	public function &setActief($actief) {
		$this->notifyChanged(self::FIELD_ACTIEF,$this->actief,$actief);
		$this->actief=$actief;
		return $this;
	}

	/**
	 * get value for actief 
	 *
	 * type:INT,size:10,default:1
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
			self::FIELD_BERICHT=>$this->getBericht(),
			self::FIELD_PERSOON=>$this->getPersoon(),
			self::FIELD_GENRE=>$this->getGenre(),
			self::FIELD_STATUS=>$this->getStatus(),
			self::FIELD_GELEZEN=>$this->getGelezen(),
			self::FIELD_ACTIEF=>$this->getActief());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_BERICHT=>$this->getBericht(),
			self::FIELD_PERSOON=>$this->getPersoon(),
			self::FIELD_GENRE=>$this->getGenre());
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
	 * Match by attributes of passed example instance and return matched rows as an array of BerichtenTo instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param BerichtenTo $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return BerichtenTo[]
	 */
	public static function findByExample(PDO $db,BerichtenTo $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of BerichtenTo instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return BerichtenTo[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `berichten_to`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of BerichtenTo instances
	 *
	 * @param PDOStatement $stmt
	 * @return BerichtenTo[]
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
	 * returns the result as an array of BerichtenTo instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return BerichtenTo[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new BerichtenTo();
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
	 * Execute select query and return matched rows as an array of BerichtenTo instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return BerichtenTo[]
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
		$sql='DELETE FROM `berichten_to`'
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
		$this->setBericht($result['bericht']);
		$this->setPersoon($result['persoon']);
		$this->setGenre($result['genre']);
		$this->setStatus($result['status']);
		$this->setGelezen($result['gelezen']);
		$this->setActief($result['actief']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return BerichtenTo
	 */
	public static function findById(PDO $db,$bericht,$persoon,$genre) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$bericht);
		$stmt->bindValue(2,$persoon);
		$stmt->bindValue(3,$genre);
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
		$o=new BerichtenTo();
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
		$stmt->bindValue(1,$this->getBericht());
		$stmt->bindValue(2,$this->getPersoon());
		$stmt->bindValue(3,$this->getGenre());
		$stmt->bindValue(4,$this->getStatus());
		$stmt->bindValue(5,$this->getGelezen());
		$stmt->bindValue(6,$this->getActief());
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
		$stmt->bindValue(7,$this->getBericht());
		$stmt->bindValue(8,$this->getPersoon());
		$stmt->bindValue(9,$this->getGenre());
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
		$stmt->bindValue(1,$this->getBericht());
		$stmt->bindValue(2,$this->getPersoon());
		$stmt->bindValue(3,$this->getGenre());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch Hulpverleners which references this BerichtenTo. Will return null in case reference is invalid.
	 * `berichten_to`.`persoon` -> `hulpverleners`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Hulpverleners
	 */
	public function fetchHulpverleners(PDO $db, $sort=null) {
		$filter=array(Hulpverleners::FIELD_ID=>$this->getPersoon());
		$result=Hulpverleners::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Berichten which references this BerichtenTo. Will return null in case reference is invalid.
	 * `berichten_to`.`bericht` -> `berichten`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Berichten
	 */
	public function fetchBerichten(PDO $db, $sort=null) {
		$filter=array(Berichten::FIELD_ID=>$this->getBericht());
		$result=Berichten::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'BerichtenTo');
	}

	/**
	 * get single BerichtenTo instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return BerichtenTo
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new BerichtenTo();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of BerichtenTo from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return BerichtenTo[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('BerichtenTo') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>