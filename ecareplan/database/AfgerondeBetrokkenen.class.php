<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class AfgerondeBetrokkenen extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='AfgerondeBetrokkenen';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='afgeronde_betrokkenen';
	const SQL_INSERT='INSERT INTO `afgeronde_betrokkenen` (`id`,`overleg_id`,`genre`,`persoon_id`,`aanwezig`,`namens`,`rechten`,`overleggenre`,`bereikbaarheid`) VALUES (?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `afgeronde_betrokkenen` (`overleg_id`,`genre`,`persoon_id`,`aanwezig`,`namens`,`rechten`,`overleggenre`,`bereikbaarheid`) VALUES (?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `afgeronde_betrokkenen` SET `id`=?,`overleg_id`=?,`genre`=?,`persoon_id`=?,`aanwezig`=?,`namens`=?,`rechten`=?,`overleggenre`=?,`bereikbaarheid`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `afgeronde_betrokkenen` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `afgeronde_betrokkenen` WHERE `id`=?';
	const FIELD_ID=306300761;
	const FIELD_OVERLEG_ID=1850070782;
	const FIELD_GENRE=-1801240955;
	const FIELD_PERSOON_ID=185077536;
	const FIELD_AANWEZIG=-565130822;
	const FIELD_NAMENS=192773326;
	const FIELD_RECHTEN=1041429447;
	const FIELD_OVERLEGGENRE=-191156793;
	const FIELD_BEREIKBAARHEID=290192926;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_OVERLEG_ID=>'overleg_id',
		self::FIELD_GENRE=>'genre',
		self::FIELD_PERSOON_ID=>'persoon_id',
		self::FIELD_AANWEZIG=>'aanwezig',
		self::FIELD_NAMENS=>'namens',
		self::FIELD_RECHTEN=>'rechten',
		self::FIELD_OVERLEGGENRE=>'overleggenre',
		self::FIELD_BEREIKBAARHEID=>'bereikbaarheid');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_OVERLEG_ID=>'overlegId',
		self::FIELD_GENRE=>'genre',
		self::FIELD_PERSOON_ID=>'persoonId',
		self::FIELD_AANWEZIG=>'aanwezig',
		self::FIELD_NAMENS=>'namens',
		self::FIELD_RECHTEN=>'rechten',
		self::FIELD_OVERLEGGENRE=>'overleggenre',
		self::FIELD_BEREIKBAARHEID=>'bereikbaarheid');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_OVERLEG_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_GENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PERSOON_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_AANWEZIG=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_NAMENS=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_RECHTEN=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_OVERLEGGENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_BEREIKBAARHEID=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_OVERLEG_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_GENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,10,0,false),
		self::FIELD_PERSOON_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_AANWEZIG=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false),
		self::FIELD_NAMENS=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_RECHTEN=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_OVERLEGGENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,7,0,false),
		self::FIELD_BEREIKBAARHEID=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_OVERLEG_ID=>0,
		self::FIELD_GENRE=>'hulp',
		self::FIELD_PERSOON_ID=>0,
		self::FIELD_AANWEZIG=>'0',
		self::FIELD_NAMENS=>null,
		self::FIELD_RECHTEN=>0,
		self::FIELD_OVERLEGGENRE=>'gewoon',
		self::FIELD_BEREIKBAARHEID=>null);
	private $id;
	private $overlegId;
	private $genre;
	private $persoonId;
	private $aanwezig;
	private $namens;
	private $rechten;
	private $overleggenre;
	private $bereikbaarheid;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return AfgerondeBetrokkenen
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
	 * set value for overleg_id 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $overlegId
	 * @return AfgerondeBetrokkenen
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
	 * set value for genre 
	 *
	 * type:ENUM,size:10,default:hulp
	 *
	 * @param mixed $genre
	 * @return AfgerondeBetrokkenen
	 */
	public function &setGenre($genre) {
		$this->notifyChanged(self::FIELD_GENRE,$this->genre,$genre);
		$this->genre=$genre;
		return $this;
	}

	/**
	 * get value for genre 
	 *
	 * type:ENUM,size:10,default:hulp
	 *
	 * @return mixed
	 */
	public function getGenre() {
		return $this->genre;
	}

	/**
	 * set value for persoon_id 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $persoonId
	 * @return AfgerondeBetrokkenen
	 */
	public function &setPersoonId($persoonId) {
		$this->notifyChanged(self::FIELD_PERSOON_ID,$this->persoonId,$persoonId);
		$this->persoonId=$persoonId;
		return $this;
	}

	/**
	 * get value for persoon_id 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @return mixed
	 */
	public function getPersoonId() {
		return $this->persoonId;
	}

	/**
	 * set value for aanwezig 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $aanwezig
	 * @return AfgerondeBetrokkenen
	 */
	public function &setAanwezig($aanwezig) {
		$this->notifyChanged(self::FIELD_AANWEZIG,$this->aanwezig,$aanwezig);
		$this->aanwezig=$aanwezig;
		return $this;
	}

	/**
	 * get value for aanwezig 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getAanwezig() {
		return $this->aanwezig;
	}

	/**
	 * set value for namens 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $namens
	 * @return AfgerondeBetrokkenen
	 */
	public function &setNamens($namens) {
		$this->notifyChanged(self::FIELD_NAMENS,$this->namens,$namens);
		$this->namens=$namens;
		return $this;
	}

	/**
	 * get value for namens 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getNamens() {
		return $this->namens;
	}

	/**
	 * set value for rechten 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $rechten
	 * @return AfgerondeBetrokkenen
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
	 * set value for overleggenre 
	 *
	 * type:ENUM,size:7,default:gewoon
	 *
	 * @param mixed $overleggenre
	 * @return AfgerondeBetrokkenen
	 */
	public function &setOverleggenre($overleggenre) {
		$this->notifyChanged(self::FIELD_OVERLEGGENRE,$this->overleggenre,$overleggenre);
		$this->overleggenre=$overleggenre;
		return $this;
	}

	/**
	 * get value for overleggenre 
	 *
	 * type:ENUM,size:7,default:gewoon
	 *
	 * @return mixed
	 */
	public function getOverleggenre() {
		return $this->overleggenre;
	}

	/**
	 * set value for bereikbaarheid 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $bereikbaarheid
	 * @return AfgerondeBetrokkenen
	 */
	public function &setBereikbaarheid($bereikbaarheid) {
		$this->notifyChanged(self::FIELD_BEREIKBAARHEID,$this->bereikbaarheid,$bereikbaarheid);
		$this->bereikbaarheid=$bereikbaarheid;
		return $this;
	}

	/**
	 * get value for bereikbaarheid 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getBereikbaarheid() {
		return $this->bereikbaarheid;
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
			self::FIELD_OVERLEG_ID=>$this->getOverlegId(),
			self::FIELD_GENRE=>$this->getGenre(),
			self::FIELD_PERSOON_ID=>$this->getPersoonId(),
			self::FIELD_AANWEZIG=>$this->getAanwezig(),
			self::FIELD_NAMENS=>$this->getNamens(),
			self::FIELD_RECHTEN=>$this->getRechten(),
			self::FIELD_OVERLEGGENRE=>$this->getOverleggenre(),
			self::FIELD_BEREIKBAARHEID=>$this->getBereikbaarheid());
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
	 * Match by attributes of passed example instance and return matched rows as an array of AfgerondeBetrokkenen instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param AfgerondeBetrokkenen $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return AfgerondeBetrokkenen[]
	 */
	public static function findByExample(PDO $db,AfgerondeBetrokkenen $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of AfgerondeBetrokkenen instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return AfgerondeBetrokkenen[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `afgeronde_betrokkenen`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of AfgerondeBetrokkenen instances
	 *
	 * @param PDOStatement $stmt
	 * @return AfgerondeBetrokkenen[]
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
	 * returns the result as an array of AfgerondeBetrokkenen instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return AfgerondeBetrokkenen[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new AfgerondeBetrokkenen();
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
	 * Execute select query and return matched rows as an array of AfgerondeBetrokkenen instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return AfgerondeBetrokkenen[]
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
		$sql='DELETE FROM `afgeronde_betrokkenen`'
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
		$this->setOverlegId($result['overleg_id']);
		$this->setGenre($result['genre']);
		$this->setPersoonId($result['persoon_id']);
		$this->setAanwezig($result['aanwezig']);
		$this->setNamens($result['namens']);
		$this->setRechten($result['rechten']);
		$this->setOverleggenre($result['overleggenre']);
		$this->setBereikbaarheid($result['bereikbaarheid']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return AfgerondeBetrokkenen
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
		$o=new AfgerondeBetrokkenen();
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
		$stmt->bindValue(2,$this->getOverlegId());
		$stmt->bindValue(3,$this->getGenre());
		$stmt->bindValue(4,$this->getPersoonId());
		$stmt->bindValue(5,$this->getAanwezig());
		$stmt->bindValue(6,$this->getNamens());
		$stmt->bindValue(7,$this->getRechten());
		$stmt->bindValue(8,$this->getOverleggenre());
		$stmt->bindValue(9,$this->getBereikbaarheid());
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
			$stmt->bindValue(1,$this->getOverlegId());
			$stmt->bindValue(2,$this->getGenre());
			$stmt->bindValue(3,$this->getPersoonId());
			$stmt->bindValue(4,$this->getAanwezig());
			$stmt->bindValue(5,$this->getNamens());
			$stmt->bindValue(6,$this->getRechten());
			$stmt->bindValue(7,$this->getOverleggenre());
			$stmt->bindValue(8,$this->getBereikbaarheid());
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
		$stmt->bindValue(10,$this->getId());
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
	 * Fetch Overlegbasis which references this AfgerondeBetrokkenen. Will return null in case reference is invalid.
	 * `afgeronde_betrokkenen`.`overleg_id` -> `overlegbasis`.`id`
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
	 * Fetch Persoon which references this AfgerondeBetrokkenen. Will return null in case reference is invalid.
	 * `afgeronde_betrokkenen`.`persoon_id` -> `persoon`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Persoon
	 */
	public function fetchPersoon(PDO $db, $sort=null) {
		$filter=array(Persoon::FIELD_ID=>$this->getPersoonId());
		$result=Persoon::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'AfgerondeBetrokkenen');
	}

	/**
	 * get single AfgerondeBetrokkenen instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return AfgerondeBetrokkenen
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new AfgerondeBetrokkenen();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of AfgerondeBetrokkenen from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return AfgerondeBetrokkenen[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('AfgerondeBetrokkenen') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>