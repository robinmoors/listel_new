<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class MenosInterventie extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='MenosInterventie';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='menos_interventie';
	const SQL_INSERT='INSERT INTO `menos_interventie` (`id`,`datum`,`vorm`,`subvorm`,`vooruitgang`,`uitvoerder_id`,`genre`,`patient`,`uren`,`creatiedatum`) VALUES (?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `menos_interventie` (`datum`,`vorm`,`subvorm`,`vooruitgang`,`uitvoerder_id`,`genre`,`patient`,`uren`,`creatiedatum`) VALUES (?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `menos_interventie` SET `id`=?,`datum`=?,`vorm`=?,`subvorm`=?,`vooruitgang`=?,`uitvoerder_id`=?,`genre`=?,`patient`=?,`uren`=?,`creatiedatum`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `menos_interventie` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `menos_interventie` WHERE `id`=?';
	const FIELD_ID=-548113695;
	const FIELD_DATUM=605979881;
	const FIELD_VORM=1544118010;
	const FIELD_SUBVORM=-785238290;
	const FIELD_VOORUITGANG=164112273;
	const FIELD_UITVOERDER_ID=-847465591;
	const FIELD_GENRE=608863741;
	const FIELD_PATIENT=290861311;
	const FIELD_UREN=1544090700;
	const FIELD_CREATIEDATUM=1991100016;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_DATUM=>'datum',
		self::FIELD_VORM=>'vorm',
		self::FIELD_SUBVORM=>'subvorm',
		self::FIELD_VOORUITGANG=>'vooruitgang',
		self::FIELD_UITVOERDER_ID=>'uitvoerder_id',
		self::FIELD_GENRE=>'genre',
		self::FIELD_PATIENT=>'patient',
		self::FIELD_UREN=>'uren',
		self::FIELD_CREATIEDATUM=>'creatiedatum');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_DATUM=>'datum',
		self::FIELD_VORM=>'vorm',
		self::FIELD_SUBVORM=>'subvorm',
		self::FIELD_VOORUITGANG=>'vooruitgang',
		self::FIELD_UITVOERDER_ID=>'uitvoerderId',
		self::FIELD_GENRE=>'genre',
		self::FIELD_PATIENT=>'patient',
		self::FIELD_UREN=>'uren',
		self::FIELD_CREATIEDATUM=>'creatiedatum');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DATUM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VORM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SUBVORM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VOORUITGANG=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_UITVOERDER_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_GENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PATIENT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_UREN=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_CREATIEDATUM=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_DATUM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,10,0,false),
		self::FIELD_VORM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,60,0,false),
		self::FIELD_SUBVORM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,false),
		self::FIELD_VOORUITGANG=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,false),
		self::FIELD_UITVOERDER_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_GENRE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,7,0,false),
		self::FIELD_PATIENT=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_UREN=>array(Db2PhpEntity::JDBC_TYPE_REAL,12,0,false),
		self::FIELD_CREATIEDATUM=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_DATUM=>'',
		self::FIELD_VORM=>'',
		self::FIELD_SUBVORM=>'',
		self::FIELD_VOORUITGANG=>'',
		self::FIELD_UITVOERDER_ID=>0,
		self::FIELD_GENRE=>'',
		self::FIELD_PATIENT=>'',
		self::FIELD_UREN=>'',
		self::FIELD_CREATIEDATUM=>0);
	private $id;
	private $datum;
	private $vorm;
	private $subvorm;
	private $vooruitgang;
	private $uitvoerderId;
	private $genre;
	private $patient;
	private $uren;
	private $creatiedatum;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return MenosInterventie
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
	 * set value for datum 
	 *
	 * type:VARCHAR,size:10,default:null,index
	 *
	 * @param mixed $datum
	 * @return MenosInterventie
	 */
	public function &setDatum($datum) {
		$this->notifyChanged(self::FIELD_DATUM,$this->datum,$datum);
		$this->datum=$datum;
		return $this;
	}

	/**
	 * get value for datum 
	 *
	 * type:VARCHAR,size:10,default:null,index
	 *
	 * @return mixed
	 */
	public function getDatum() {
		return $this->datum;
	}

	/**
	 * set value for vorm 
	 *
	 * type:VARCHAR,size:60,default:null
	 *
	 * @param mixed $vorm
	 * @return MenosInterventie
	 */
	public function &setVorm($vorm) {
		$this->notifyChanged(self::FIELD_VORM,$this->vorm,$vorm);
		$this->vorm=$vorm;
		return $this;
	}

	/**
	 * get value for vorm 
	 *
	 * type:VARCHAR,size:60,default:null
	 *
	 * @return mixed
	 */
	public function getVorm() {
		return $this->vorm;
	}

	/**
	 * set value for subvorm 
	 *
	 * type:VARCHAR,size:200,default:null
	 *
	 * @param mixed $subvorm
	 * @return MenosInterventie
	 */
	public function &setSubvorm($subvorm) {
		$this->notifyChanged(self::FIELD_SUBVORM,$this->subvorm,$subvorm);
		$this->subvorm=$subvorm;
		return $this;
	}

	/**
	 * get value for subvorm 
	 *
	 * type:VARCHAR,size:200,default:null
	 *
	 * @return mixed
	 */
	public function getSubvorm() {
		return $this->subvorm;
	}

	/**
	 * set value for vooruitgang 
	 *
	 * type:TEXT,size:65535,default:null
	 *
	 * @param mixed $vooruitgang
	 * @return MenosInterventie
	 */
	public function &setVooruitgang($vooruitgang) {
		$this->notifyChanged(self::FIELD_VOORUITGANG,$this->vooruitgang,$vooruitgang);
		$this->vooruitgang=$vooruitgang;
		return $this;
	}

	/**
	 * get value for vooruitgang 
	 *
	 * type:TEXT,size:65535,default:null
	 *
	 * @return mixed
	 */
	public function getVooruitgang() {
		return $this->vooruitgang;
	}

	/**
	 * set value for uitvoerder_id 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @param mixed $uitvoerderId
	 * @return MenosInterventie
	 */
	public function &setUitvoerderId($uitvoerderId) {
		$this->notifyChanged(self::FIELD_UITVOERDER_ID,$this->uitvoerderId,$uitvoerderId);
		$this->uitvoerderId=$uitvoerderId;
		return $this;
	}

	/**
	 * get value for uitvoerder_id 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getUitvoerderId() {
		return $this->uitvoerderId;
	}

	/**
	 * set value for genre 
	 *
	 * type:ENUM,size:7,default:null
	 *
	 * @param mixed $genre
	 * @return MenosInterventie
	 */
	public function &setGenre($genre) {
		$this->notifyChanged(self::FIELD_GENRE,$this->genre,$genre);
		$this->genre=$genre;
		return $this;
	}

	/**
	 * get value for genre 
	 *
	 * type:ENUM,size:7,default:null
	 *
	 * @return mixed
	 */
	public function getGenre() {
		return $this->genre;
	}

	/**
	 * set value for patient 
	 *
	 * type:VARCHAR,size:20,default:null
	 *
	 * @param mixed $patient
	 * @return MenosInterventie
	 */
	public function &setPatient($patient) {
		$this->notifyChanged(self::FIELD_PATIENT,$this->patient,$patient);
		$this->patient=$patient;
		return $this;
	}

	/**
	 * get value for patient 
	 *
	 * type:VARCHAR,size:20,default:null
	 *
	 * @return mixed
	 */
	public function getPatient() {
		return $this->patient;
	}

	/**
	 * set value for uren 
	 *
	 * type:FLOAT,size:12,default:null
	 *
	 * @param mixed $uren
	 * @return MenosInterventie
	 */
	public function &setUren($uren) {
		$this->notifyChanged(self::FIELD_UREN,$this->uren,$uren);
		$this->uren=$uren;
		return $this;
	}

	/**
	 * get value for uren 
	 *
	 * type:FLOAT,size:12,default:null
	 *
	 * @return mixed
	 */
	public function getUren() {
		return $this->uren;
	}

	/**
	 * set value for creatiedatum 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @param mixed $creatiedatum
	 * @return MenosInterventie
	 */
	public function &setCreatiedatum($creatiedatum) {
		$this->notifyChanged(self::FIELD_CREATIEDATUM,$this->creatiedatum,$creatiedatum);
		$this->creatiedatum=$creatiedatum;
		return $this;
	}

	/**
	 * get value for creatiedatum 
	 *
	 * type:INT,size:10,default:null
	 *
	 * @return mixed
	 */
	public function getCreatiedatum() {
		return $this->creatiedatum;
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
			self::FIELD_DATUM=>$this->getDatum(),
			self::FIELD_VORM=>$this->getVorm(),
			self::FIELD_SUBVORM=>$this->getSubvorm(),
			self::FIELD_VOORUITGANG=>$this->getVooruitgang(),
			self::FIELD_UITVOERDER_ID=>$this->getUitvoerderId(),
			self::FIELD_GENRE=>$this->getGenre(),
			self::FIELD_PATIENT=>$this->getPatient(),
			self::FIELD_UREN=>$this->getUren(),
			self::FIELD_CREATIEDATUM=>$this->getCreatiedatum());
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
	 * Match by attributes of passed example instance and return matched rows as an array of MenosInterventie instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param MenosInterventie $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return MenosInterventie[]
	 */
	public static function findByExample(PDO $db,MenosInterventie $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of MenosInterventie instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return MenosInterventie[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `menos_interventie`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of MenosInterventie instances
	 *
	 * @param PDOStatement $stmt
	 * @return MenosInterventie[]
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
	 * returns the result as an array of MenosInterventie instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return MenosInterventie[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new MenosInterventie();
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
	 * Execute select query and return matched rows as an array of MenosInterventie instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return MenosInterventie[]
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
		$sql='DELETE FROM `menos_interventie`'
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
		$this->setDatum($result['datum']);
		$this->setVorm($result['vorm']);
		$this->setSubvorm($result['subvorm']);
		$this->setVooruitgang($result['vooruitgang']);
		$this->setUitvoerderId($result['uitvoerder_id']);
		$this->setGenre($result['genre']);
		$this->setPatient($result['patient']);
		$this->setUren($result['uren']);
		$this->setCreatiedatum($result['creatiedatum']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return MenosInterventie
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
		$o=new MenosInterventie();
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
		$stmt->bindValue(2,$this->getDatum());
		$stmt->bindValue(3,$this->getVorm());
		$stmt->bindValue(4,$this->getSubvorm());
		$stmt->bindValue(5,$this->getVooruitgang());
		$stmt->bindValue(6,$this->getUitvoerderId());
		$stmt->bindValue(7,$this->getGenre());
		$stmt->bindValue(8,$this->getPatient());
		$stmt->bindValue(9,$this->getUren());
		$stmt->bindValue(10,$this->getCreatiedatum());
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
			$stmt->bindValue(1,$this->getDatum());
			$stmt->bindValue(2,$this->getVorm());
			$stmt->bindValue(3,$this->getSubvorm());
			$stmt->bindValue(4,$this->getVooruitgang());
			$stmt->bindValue(5,$this->getUitvoerderId());
			$stmt->bindValue(6,$this->getGenre());
			$stmt->bindValue(7,$this->getPatient());
			$stmt->bindValue(8,$this->getUren());
			$stmt->bindValue(9,$this->getCreatiedatum());
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
		return self::hashToDomDocument($this->toHash(), 'MenosInterventie');
	}

	/**
	 * get single MenosInterventie instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return MenosInterventie
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new MenosInterventie();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of MenosInterventie from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return MenosInterventie[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('MenosInterventie') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>