<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Factuurmaand extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Factuurmaand';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='factuurmaand';
	const SQL_INSERT='INSERT INTO `factuurmaand` (`id`,`genre`,`jaar`,`maand`,`nummer`,`mutualiteit`,`factuurdatum`,`factuurFile`,`creditActief`,`vervangt`) VALUES (?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `factuurmaand` (`genre`,`jaar`,`maand`,`nummer`,`mutualiteit`,`factuurdatum`,`factuurFile`,`creditActief`,`vervangt`) VALUES (?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `factuurmaand` SET `id`=?,`genre`=?,`jaar`=?,`maand`=?,`nummer`=?,`mutualiteit`=?,`factuurdatum`=?,`factuurFile`=?,`creditActief`=?,`vervangt`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `factuurmaand` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `factuurmaand` WHERE `id`=?';
	const FIELD_ID=-972100340;
	const FIELD_GENRE=1121540082;
	const FIELD_JAAR=2114473817;
	const FIELD_MAAND=1126949426;
	const FIELD_NUMMER=623150085;
	const FIELD_MUTUALITEIT=-1715348768;
	const FIELD_FACTUURDATUM=29566714;
	const FIELD_FACTUURFILE=1662635441;
	const FIELD_CREDITACTIEF=185768962;
	const FIELD_VERVANGT=1740539070;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_GENRE=>'genre',
		self::FIELD_JAAR=>'jaar',
		self::FIELD_MAAND=>'maand',
		self::FIELD_NUMMER=>'nummer',
		self::FIELD_MUTUALITEIT=>'mutualiteit',
		self::FIELD_FACTUURDATUM=>'factuurdatum',
		self::FIELD_FACTUURFILE=>'factuurFile',
		self::FIELD_CREDITACTIEF=>'creditActief',
		self::FIELD_VERVANGT=>'vervangt');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_GENRE=>'genre',
		self::FIELD_JAAR=>'jaar',
		self::FIELD_MAAND=>'maand',
		self::FIELD_NUMMER=>'nummer',
		self::FIELD_MUTUALITEIT=>'mutualiteit',
		self::FIELD_FACTUURDATUM=>'factuurdatum',
		self::FIELD_FACTUURFILE=>'factuurFile',
		self::FIELD_CREDITACTIEF=>'creditActief',
		self::FIELD_VERVANGT=>'vervangt');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_GENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_JAAR=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MAAND=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NUMMER=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MUTUALITEIT=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_FACTUURDATUM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FACTUURFILE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CREDITACTIEF=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_VERVANGT=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_GENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,6,0,false),
		self::FIELD_JAAR=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_MAAND=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_NUMMER=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_MUTUALITEIT=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_FACTUURDATUM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,10,0,false),
		self::FIELD_FACTUURFILE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,true),
		self::FIELD_CREDITACTIEF=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,true),
		self::FIELD_VERVANGT=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_GENRE=>'TP',
		self::FIELD_JAAR=>0,
		self::FIELD_MAAND=>0,
		self::FIELD_NUMMER=>0,
		self::FIELD_MUTUALITEIT=>0,
		self::FIELD_FACTUURDATUM=>'',
		self::FIELD_FACTUURFILE=>null,
		self::FIELD_CREDITACTIEF=>null,
		self::FIELD_VERVANGT=>null);
	private $id;
	private $genre;
	private $jaar;
	private $maand;
	private $nummer;
	private $mutualiteit;
	private $factuurdatum;
	private $factuurFile;
	private $creditActief;
	private $vervangt;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return Factuurmaand
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
	 * set value for genre 
	 *
	 * type:ENUM,size:6,default:TP,index
	 *
	 * @param mixed $genre
	 * @return Factuurmaand
	 */
	public function &setGenre($genre) {
		$this->notifyChanged(self::FIELD_GENRE,$this->genre,$genre);
		$this->genre=$genre;
		return $this;
	}

	/**
	 * get value for genre 
	 *
	 * type:ENUM,size:6,default:TP,index
	 *
	 * @return mixed
	 */
	public function getGenre() {
		return $this->genre;
	}

	/**
	 * set value for jaar 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $jaar
	 * @return Factuurmaand
	 */
	public function &setJaar($jaar) {
		$this->notifyChanged(self::FIELD_JAAR,$this->jaar,$jaar);
		$this->jaar=$jaar;
		return $this;
	}

	/**
	 * get value for jaar 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @return mixed
	 */
	public function getJaar() {
		return $this->jaar;
	}

	/**
	 * set value for maand 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $maand
	 * @return Factuurmaand
	 */
	public function &setMaand($maand) {
		$this->notifyChanged(self::FIELD_MAAND,$this->maand,$maand);
		$this->maand=$maand;
		return $this;
	}

	/**
	 * get value for maand 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getMaand() {
		return $this->maand;
	}

	/**
	 * set value for nummer 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $nummer
	 * @return Factuurmaand
	 */
	public function &setNummer($nummer) {
		$this->notifyChanged(self::FIELD_NUMMER,$this->nummer,$nummer);
		$this->nummer=$nummer;
		return $this;
	}

	/**
	 * get value for nummer 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getNummer() {
		return $this->nummer;
	}

	/**
	 * set value for mutualiteit 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $mutualiteit
	 * @return Factuurmaand
	 */
	public function &setMutualiteit($mutualiteit) {
		$this->notifyChanged(self::FIELD_MUTUALITEIT,$this->mutualiteit,$mutualiteit);
		$this->mutualiteit=$mutualiteit;
		return $this;
	}

	/**
	 * get value for mutualiteit 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @return mixed
	 */
	public function getMutualiteit() {
		return $this->mutualiteit;
	}

	/**
	 * set value for factuurdatum 
	 *
	 * type:VARCHAR,size:10,default:
	 *
	 * @param mixed $factuurdatum
	 * @return Factuurmaand
	 */
	public function &setFactuurdatum($factuurdatum) {
		$this->notifyChanged(self::FIELD_FACTUURDATUM,$this->factuurdatum,$factuurdatum);
		$this->factuurdatum=$factuurdatum;
		return $this;
	}

	/**
	 * get value for factuurdatum 
	 *
	 * type:VARCHAR,size:10,default:
	 *
	 * @return mixed
	 */
	public function getFactuurdatum() {
		return $this->factuurdatum;
	}

	/**
	 * set value for factuurFile 
	 *
	 * type:VARCHAR,size:200,default:null,nullable
	 *
	 * @param mixed $factuurFile
	 * @return Factuurmaand
	 */
	public function &setFactuurFile($factuurFile) {
		$this->notifyChanged(self::FIELD_FACTUURFILE,$this->factuurFile,$factuurFile);
		$this->factuurFile=$factuurFile;
		return $this;
	}

	/**
	 * get value for factuurFile 
	 *
	 * type:VARCHAR,size:200,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getFactuurFile() {
		return $this->factuurFile;
	}

	/**
	 * set value for creditActief 
	 *
	 * type:TINYINT,size:3,default:null,nullable
	 *
	 * @param mixed $creditActief
	 * @return Factuurmaand
	 */
	public function &setCreditActief($creditActief) {
		$this->notifyChanged(self::FIELD_CREDITACTIEF,$this->creditActief,$creditActief);
		$this->creditActief=$creditActief;
		return $this;
	}

	/**
	 * get value for creditActief 
	 *
	 * type:TINYINT,size:3,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCreditActief() {
		return $this->creditActief;
	}

	/**
	 * set value for vervangt 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $vervangt
	 * @return Factuurmaand
	 */
	public function &setVervangt($vervangt) {
		$this->notifyChanged(self::FIELD_VERVANGT,$this->vervangt,$vervangt);
		$this->vervangt=$vervangt;
		return $this;
	}

	/**
	 * get value for vervangt 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getVervangt() {
		return $this->vervangt;
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
			self::FIELD_GENRE=>$this->getGenre(),
			self::FIELD_JAAR=>$this->getJaar(),
			self::FIELD_MAAND=>$this->getMaand(),
			self::FIELD_NUMMER=>$this->getNummer(),
			self::FIELD_MUTUALITEIT=>$this->getMutualiteit(),
			self::FIELD_FACTUURDATUM=>$this->getFactuurdatum(),
			self::FIELD_FACTUURFILE=>$this->getFactuurFile(),
			self::FIELD_CREDITACTIEF=>$this->getCreditActief(),
			self::FIELD_VERVANGT=>$this->getVervangt());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Factuurmaand instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Factuurmaand $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Factuurmaand[]
	 */
	public static function findByExample(PDO $db,Factuurmaand $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Factuurmaand instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Factuurmaand[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `factuurmaand`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Factuurmaand instances
	 *
	 * @param PDOStatement $stmt
	 * @return Factuurmaand[]
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
	 * returns the result as an array of Factuurmaand instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Factuurmaand[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Factuurmaand();
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
	 * Execute select query and return matched rows as an array of Factuurmaand instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Factuurmaand[]
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
		$sql='DELETE FROM `factuurmaand`'
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
		$this->setGenre($result['genre']);
		$this->setJaar($result['jaar']);
		$this->setMaand($result['maand']);
		$this->setNummer($result['nummer']);
		$this->setMutualiteit($result['mutualiteit']);
		$this->setFactuurdatum($result['factuurdatum']);
		$this->setFactuurFile($result['factuurFile']);
		$this->setCreditActief($result['creditActief']);
		$this->setVervangt($result['vervangt']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Factuurmaand
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
		$o=new Factuurmaand();
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
		$stmt->bindValue(2,$this->getGenre());
		$stmt->bindValue(3,$this->getJaar());
		$stmt->bindValue(4,$this->getMaand());
		$stmt->bindValue(5,$this->getNummer());
		$stmt->bindValue(6,$this->getMutualiteit());
		$stmt->bindValue(7,$this->getFactuurdatum());
		$stmt->bindValue(8,$this->getFactuurFile());
		$stmt->bindValue(9,$this->getCreditActief());
		$stmt->bindValue(10,$this->getVervangt());
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
			$stmt->bindValue(1,$this->getGenre());
			$stmt->bindValue(2,$this->getJaar());
			$stmt->bindValue(3,$this->getMaand());
			$stmt->bindValue(4,$this->getNummer());
			$stmt->bindValue(5,$this->getMutualiteit());
			$stmt->bindValue(6,$this->getFactuurdatum());
			$stmt->bindValue(7,$this->getFactuurFile());
			$stmt->bindValue(8,$this->getCreditActief());
			$stmt->bindValue(9,$this->getVervangt());
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
		$stmt->bindValue(11,$this->getId());
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
	 * Fetch Factuurmaand's which this Factuurmaand references.
	 * `factuurmaand`.`id` -> `factuurmaand`.`vervangt`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Factuurmaand[]
	 */
	public function fetchFactuurmaandCollection(PDO $db, $sort=null) {
		$filter=array(Factuurmaand::FIELD_VERVANGT=>$this->getId());
		return Factuurmaand::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Overlegbasis's which this Factuurmaand references.
	 * `factuurmaand`.`id` -> `overlegbasis`.`factuur_code`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegbasis[]
	 */
	public function fetchOverlegbasisCollection(PDO $db, $sort=null) {
		$filter=array(Overlegbasis::FIELD_FACTUUR_CODE=>$this->getId());
		return Overlegbasis::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Verzekering which references this Factuurmaand. Will return null in case reference is invalid.
	 * `factuurmaand`.`mutualiteit` -> `verzekering`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Verzekering
	 */
	public function fetchVerzekering(PDO $db, $sort=null) {
		$filter=array(Verzekering::FIELD_ID=>$this->getMutualiteit());
		$result=Verzekering::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Factuurmaand which references this Factuurmaand. Will return null in case reference is invalid.
	 * `factuurmaand`.`vervangt` -> `factuurmaand`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Factuurmaand
	 */
	public function fetchFactuurmaand(PDO $db, $sort=null) {
		$filter=array(Factuurmaand::FIELD_ID=>$this->getVervangt());
		$result=Factuurmaand::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'Factuurmaand');
	}

	/**
	 * get single Factuurmaand instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Factuurmaand
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Factuurmaand();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Factuurmaand from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Factuurmaand[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Factuurmaand') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>