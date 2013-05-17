<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class OverlegFiles extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='OverlegFiles';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='overleg_files';
	const SQL_INSERT='INSERT INTO `overleg_files` (`overleg_id`,`filename`,`alias`,`created`,`genre`,`auteurgenre`,`auteur`) VALUES (?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `overleg_files` (`overleg_id`,`filename`,`alias`,`created`,`genre`,`auteurgenre`,`auteur`) VALUES (?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `overleg_files` SET `overleg_id`=?,`filename`=?,`alias`=?,`created`=?,`genre`=?,`auteurgenre`=?,`auteur`=? WHERE `filename`=?';
	const SQL_SELECT_PK='SELECT * FROM `overleg_files` WHERE `filename`=?';
	const SQL_DELETE_PK='DELETE FROM `overleg_files` WHERE `filename`=?';
	const FIELD_OVERLEG_ID=-390846596;
	const FIELD_FILENAME=-89571901;
	const FIELD_ALIAS=171353108;
	const FIELD_CREATED=-890295380;
	const FIELD_GENRE=176691015;
	const FIELD_AUTEURGENRE=1893904005;
	const FIELD_AUTEUR=1025622462;
	private static $PRIMARY_KEYS=array(self::FIELD_FILENAME);
	private static $AUTOINCREMENT_FIELDS=array();
	private static $FIELD_NAMES=array(
		self::FIELD_OVERLEG_ID=>'overleg_id',
		self::FIELD_FILENAME=>'filename',
		self::FIELD_ALIAS=>'alias',
		self::FIELD_CREATED=>'created',
		self::FIELD_GENRE=>'genre',
		self::FIELD_AUTEURGENRE=>'auteurgenre',
		self::FIELD_AUTEUR=>'auteur');
	private static $PROPERTY_NAMES=array(
		self::FIELD_OVERLEG_ID=>'overlegId',
		self::FIELD_FILENAME=>'filename',
		self::FIELD_ALIAS=>'alias',
		self::FIELD_CREATED=>'created',
		self::FIELD_GENRE=>'genre',
		self::FIELD_AUTEURGENRE=>'auteurgenre',
		self::FIELD_AUTEUR=>'auteur');
	private static $PROPERTY_TYPES=array(
		self::FIELD_OVERLEG_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_FILENAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ALIAS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CREATED=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AUTEURGENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AUTEUR=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_OVERLEG_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_FILENAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,false),
		self::FIELD_ALIAS=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,false),
		self::FIELD_CREATED=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,19,0,false),
		self::FIELD_GENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,8,0,true),
		self::FIELD_AUTEURGENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,3,0,true),
		self::FIELD_AUTEUR=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_OVERLEG_ID=>0,
		self::FIELD_FILENAME=>'',
		self::FIELD_ALIAS=>'',
		self::FIELD_CREATED=>'1000-01-01 00:00:00',
		self::FIELD_GENRE=>'gewoon',
		self::FIELD_AUTEURGENRE=>'OC',
		self::FIELD_AUTEUR=>null);
	private $overlegId;
	private $filename;
	private $alias;
	private $created;
	private $genre;
	private $auteurgenre;
	private $auteur;

	/**
	 * set value for overleg_id 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $overlegId
	 * @return OverlegFiles
	 */
	public function &setOverlegId($overlegId) {
		$this->notifyChanged(self::FIELD_OVERLEG_ID,$this->overlegId,$overlegId);
		$this->overlegId=$overlegId;
		return $this;
	}

	/**
	 * get value for overleg_id 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @return mixed
	 */
	public function getOverlegId() {
		return $this->overlegId;
	}

	/**
	 * set value for filename 
	 *
	 * type:VARCHAR,size:200,default:,primary,unique
	 *
	 * @param mixed $filename
	 * @return OverlegFiles
	 */
	public function &setFilename($filename) {
		$this->notifyChanged(self::FIELD_FILENAME,$this->filename,$filename);
		$this->filename=$filename;
		return $this;
	}

	/**
	 * get value for filename 
	 *
	 * type:VARCHAR,size:200,default:,primary,unique
	 *
	 * @return mixed
	 */
	public function getFilename() {
		return $this->filename;
	}

	/**
	 * set value for alias 
	 *
	 * type:VARCHAR,size:200,default:
	 *
	 * @param mixed $alias
	 * @return OverlegFiles
	 */
	public function &setAlias($alias) {
		$this->notifyChanged(self::FIELD_ALIAS,$this->alias,$alias);
		$this->alias=$alias;
		return $this;
	}

	/**
	 * get value for alias 
	 *
	 * type:VARCHAR,size:200,default:
	 *
	 * @return mixed
	 */
	public function getAlias() {
		return $this->alias;
	}

	/**
	 * set value for created 
	 *
	 * type:DATETIME,size:19,default:1000-01-01 00:00:00
	 *
	 * @param mixed $created
	 * @return OverlegFiles
	 */
	public function &setCreated($created) {
		$this->notifyChanged(self::FIELD_CREATED,$this->created,$created);
		$this->created=$created;
		return $this;
	}

	/**
	 * get value for created 
	 *
	 * type:DATETIME,size:19,default:1000-01-01 00:00:00
	 *
	 * @return mixed
	 */
	public function getCreated() {
		return $this->created;
	}

	/**
	 * set value for genre 
	 *
	 * type:ENUM,size:8,default:gewoon,index,nullable
	 *
	 * @param mixed $genre
	 * @return OverlegFiles
	 */
	public function &setGenre($genre) {
		$this->notifyChanged(self::FIELD_GENRE,$this->genre,$genre);
		$this->genre=$genre;
		return $this;
	}

	/**
	 * get value for genre 
	 *
	 * type:ENUM,size:8,default:gewoon,index,nullable
	 *
	 * @return mixed
	 */
	public function getGenre() {
		return $this->genre;
	}

	/**
	 * set value for auteurgenre 
	 *
	 * type:ENUM,size:3,default:OC,nullable
	 *
	 * @param mixed $auteurgenre
	 * @return OverlegFiles
	 */
	public function &setAuteurgenre($auteurgenre) {
		$this->notifyChanged(self::FIELD_AUTEURGENRE,$this->auteurgenre,$auteurgenre);
		$this->auteurgenre=$auteurgenre;
		return $this;
	}

	/**
	 * get value for auteurgenre 
	 *
	 * type:ENUM,size:3,default:OC,nullable
	 *
	 * @return mixed
	 */
	public function getAuteurgenre() {
		return $this->auteurgenre;
	}

	/**
	 * set value for auteur 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $auteur
	 * @return OverlegFiles
	 */
	public function &setAuteur($auteur) {
		$this->notifyChanged(self::FIELD_AUTEUR,$this->auteur,$auteur);
		$this->auteur=$auteur;
		return $this;
	}

	/**
	 * get value for auteur 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAuteur() {
		return $this->auteur;
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
			self::FIELD_OVERLEG_ID=>$this->getOverlegId(),
			self::FIELD_FILENAME=>$this->getFilename(),
			self::FIELD_ALIAS=>$this->getAlias(),
			self::FIELD_CREATED=>$this->getCreated(),
			self::FIELD_GENRE=>$this->getGenre(),
			self::FIELD_AUTEURGENRE=>$this->getAuteurgenre(),
			self::FIELD_AUTEUR=>$this->getAuteur());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_FILENAME=>$this->getFilename());
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
	 * Match by attributes of passed example instance and return matched rows as an array of OverlegFiles instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param OverlegFiles $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return OverlegFiles[]
	 */
	public static function findByExample(PDO $db,OverlegFiles $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of OverlegFiles instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return OverlegFiles[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `overleg_files`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of OverlegFiles instances
	 *
	 * @param PDOStatement $stmt
	 * @return OverlegFiles[]
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
	 * returns the result as an array of OverlegFiles instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return OverlegFiles[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new OverlegFiles();
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
	 * Execute select query and return matched rows as an array of OverlegFiles instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return OverlegFiles[]
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
		$sql='DELETE FROM `overleg_files`'
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
		$this->setOverlegId($result['overleg_id']);
		$this->setFilename($result['filename']);
		$this->setAlias($result['alias']);
		$this->setCreated($result['created']);
		$this->setGenre($result['genre']);
		$this->setAuteurgenre($result['auteurgenre']);
		$this->setAuteur($result['auteur']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return OverlegFiles
	 */
	public static function findById(PDO $db,$filename) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$filename);
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
		$o=new OverlegFiles();
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
		$stmt->bindValue(1,$this->getOverlegId());
		$stmt->bindValue(2,$this->getFilename());
		$stmt->bindValue(3,$this->getAlias());
		$stmt->bindValue(4,$this->getCreated());
		$stmt->bindValue(5,$this->getGenre());
		$stmt->bindValue(6,$this->getAuteurgenre());
		$stmt->bindValue(7,$this->getAuteur());
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
		$stmt->bindValue(8,$this->getFilename());
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
		$stmt->bindValue(1,$this->getFilename());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch OverlegFilesRechten's which this OverlegFiles references.
	 * `overleg_files`.`filename` -> `overleg_files_rechten`.`filename`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return OverlegFilesRechten[]
	 */
	public function fetchOverlegFilesRechtenCollection(PDO $db, $sort=null) {
		$filter=array(OverlegFilesRechten::FIELD_FILENAME=>$this->getFilename());
		return OverlegFilesRechten::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Overlegbasis which references this OverlegFiles. Will return null in case reference is invalid.
	 * `overleg_files`.`overleg_id` -> `overlegbasis`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegbasis
	 */
	public function fetchOverlegbasis(PDO $db, $sort=null) {
		$filter=array(Overlegbasis::FIELD_ID=>$this->getOverlegId());
		$result=Overlegbasis::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'OverlegFiles');
	}

	/**
	 * get single OverlegFiles instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return OverlegFiles
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new OverlegFiles();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of OverlegFiles from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return OverlegFiles[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('OverlegFiles') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>