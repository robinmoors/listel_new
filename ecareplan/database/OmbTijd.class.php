<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class OmbTijd extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='OmbTijd';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='omb_tijd';
	const SQL_INSERT='INSERT INTO `omb_tijd` (`id`,`dag`,`maand`,`jaar`,`uur1`,`min1`,`sec1`,`uur2`,`min2`,`sec2`) VALUES (?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `omb_tijd` (`dag`,`maand`,`jaar`,`uur1`,`min1`,`sec1`,`uur2`,`min2`,`sec2`) VALUES (?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `omb_tijd` SET `id`=?,`dag`=?,`maand`=?,`jaar`=?,`uur1`=?,`min1`=?,`sec1`=?,`uur2`=?,`min2`=?,`sec2`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `omb_tijd` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `omb_tijd` WHERE `id`=?';
	const FIELD_ID=-1833669121;
	const FIELD_DAG=-1009172698;
	const FIELD_MAAND=855955551;
	const FIELD_JAAR=-1219403892;
	const FIELD_UUR1=-1219056509;
	const FIELD_MIN1=-1219306493;
	const FIELD_SEC1=-1219131932;
	const FIELD_UUR2=-1219056508;
	const FIELD_MIN2=-1219306492;
	const FIELD_SEC2=-1219131931;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_DAG=>'dag',
		self::FIELD_MAAND=>'maand',
		self::FIELD_JAAR=>'jaar',
		self::FIELD_UUR1=>'uur1',
		self::FIELD_MIN1=>'min1',
		self::FIELD_SEC1=>'sec1',
		self::FIELD_UUR2=>'uur2',
		self::FIELD_MIN2=>'min2',
		self::FIELD_SEC2=>'sec2');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_DAG=>'dag',
		self::FIELD_MAAND=>'maand',
		self::FIELD_JAAR=>'jaar',
		self::FIELD_UUR1=>'uur1',
		self::FIELD_MIN1=>'min1',
		self::FIELD_SEC1=>'sec1',
		self::FIELD_UUR2=>'uur2',
		self::FIELD_MIN2=>'min2',
		self::FIELD_SEC2=>'sec2');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DAG=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MAAND=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_JAAR=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_UUR1=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MIN1=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_SEC1=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_UUR2=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MIN2=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_SEC2=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_DAG=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_MAAND=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_JAAR=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_UUR1=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_MIN1=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_SEC1=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_UUR2=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_MIN2=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_SEC2=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_DAG=>0,
		self::FIELD_MAAND=>0,
		self::FIELD_JAAR=>0,
		self::FIELD_UUR1=>0,
		self::FIELD_MIN1=>0,
		self::FIELD_SEC1=>0,
		self::FIELD_UUR2=>null,
		self::FIELD_MIN2=>null,
		self::FIELD_SEC2=>null);
	private $id;
	private $dag;
	private $maand;
	private $jaar;
	private $uur1;
	private $min1;
	private $sec1;
	private $uur2;
	private $min2;
	private $sec2;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return OmbTijd
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
	 * set value for dag 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $dag
	 * @return OmbTijd
	 */
	public function &setDag($dag) {
		$this->notifyChanged(self::FIELD_DAG,$this->dag,$dag);
		$this->dag=$dag;
		return $this;
	}

	/**
	 * get value for dag 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getDag() {
		return $this->dag;
	}

	/**
	 * set value for maand 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $maand
	 * @return OmbTijd
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
	 * set value for jaar 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $jaar
	 * @return OmbTijd
	 */
	public function &setJaar($jaar) {
		$this->notifyChanged(self::FIELD_JAAR,$this->jaar,$jaar);
		$this->jaar=$jaar;
		return $this;
	}

	/**
	 * get value for jaar 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getJaar() {
		return $this->jaar;
	}

	/**
	 * set value for uur1 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $uur1
	 * @return OmbTijd
	 */
	public function &setUur1($uur1) {
		$this->notifyChanged(self::FIELD_UUR1,$this->uur1,$uur1);
		$this->uur1=$uur1;
		return $this;
	}

	/**
	 * get value for uur1 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getUur1() {
		return $this->uur1;
	}

	/**
	 * set value for min1 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $min1
	 * @return OmbTijd
	 */
	public function &setMin1($min1) {
		$this->notifyChanged(self::FIELD_MIN1,$this->min1,$min1);
		$this->min1=$min1;
		return $this;
	}

	/**
	 * get value for min1 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getMin1() {
		return $this->min1;
	}

	/**
	 * set value for sec1 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $sec1
	 * @return OmbTijd
	 */
	public function &setSec1($sec1) {
		$this->notifyChanged(self::FIELD_SEC1,$this->sec1,$sec1);
		$this->sec1=$sec1;
		return $this;
	}

	/**
	 * get value for sec1 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getSec1() {
		return $this->sec1;
	}

	/**
	 * set value for uur2 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $uur2
	 * @return OmbTijd
	 */
	public function &setUur2($uur2) {
		$this->notifyChanged(self::FIELD_UUR2,$this->uur2,$uur2);
		$this->uur2=$uur2;
		return $this;
	}

	/**
	 * get value for uur2 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getUur2() {
		return $this->uur2;
	}

	/**
	 * set value for min2 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $min2
	 * @return OmbTijd
	 */
	public function &setMin2($min2) {
		$this->notifyChanged(self::FIELD_MIN2,$this->min2,$min2);
		$this->min2=$min2;
		return $this;
	}

	/**
	 * get value for min2 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMin2() {
		return $this->min2;
	}

	/**
	 * set value for sec2 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $sec2
	 * @return OmbTijd
	 */
	public function &setSec2($sec2) {
		$this->notifyChanged(self::FIELD_SEC2,$this->sec2,$sec2);
		$this->sec2=$sec2;
		return $this;
	}

	/**
	 * get value for sec2 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSec2() {
		return $this->sec2;
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
			self::FIELD_DAG=>$this->getDag(),
			self::FIELD_MAAND=>$this->getMaand(),
			self::FIELD_JAAR=>$this->getJaar(),
			self::FIELD_UUR1=>$this->getUur1(),
			self::FIELD_MIN1=>$this->getMin1(),
			self::FIELD_SEC1=>$this->getSec1(),
			self::FIELD_UUR2=>$this->getUur2(),
			self::FIELD_MIN2=>$this->getMin2(),
			self::FIELD_SEC2=>$this->getSec2());
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
	 * Match by attributes of passed example instance and return matched rows as an array of OmbTijd instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param OmbTijd $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return OmbTijd[]
	 */
	public static function findByExample(PDO $db,OmbTijd $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of OmbTijd instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return OmbTijd[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `omb_tijd`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of OmbTijd instances
	 *
	 * @param PDOStatement $stmt
	 * @return OmbTijd[]
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
	 * returns the result as an array of OmbTijd instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return OmbTijd[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new OmbTijd();
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
	 * Execute select query and return matched rows as an array of OmbTijd instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return OmbTijd[]
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
		$sql='DELETE FROM `omb_tijd`'
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
		$this->setDag($result['dag']);
		$this->setMaand($result['maand']);
		$this->setJaar($result['jaar']);
		$this->setUur1($result['uur1']);
		$this->setMin1($result['min1']);
		$this->setSec1($result['sec1']);
		$this->setUur2($result['uur2']);
		$this->setMin2($result['min2']);
		$this->setSec2($result['sec2']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return OmbTijd
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
		$o=new OmbTijd();
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
		$stmt->bindValue(2,$this->getDag());
		$stmt->bindValue(3,$this->getMaand());
		$stmt->bindValue(4,$this->getJaar());
		$stmt->bindValue(5,$this->getUur1());
		$stmt->bindValue(6,$this->getMin1());
		$stmt->bindValue(7,$this->getSec1());
		$stmt->bindValue(8,$this->getUur2());
		$stmt->bindValue(9,$this->getMin2());
		$stmt->bindValue(10,$this->getSec2());
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
			$stmt->bindValue(1,$this->getDag());
			$stmt->bindValue(2,$this->getMaand());
			$stmt->bindValue(3,$this->getJaar());
			$stmt->bindValue(4,$this->getUur1());
			$stmt->bindValue(5,$this->getMin1());
			$stmt->bindValue(6,$this->getSec1());
			$stmt->bindValue(7,$this->getUur2());
			$stmt->bindValue(8,$this->getMin2());
			$stmt->bindValue(9,$this->getSec2());
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
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'OmbTijd');
	}

	/**
	 * get single OmbTijd instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return OmbTijd
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new OmbTijd();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of OmbTijd from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return OmbTijd[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('OmbTijd') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>