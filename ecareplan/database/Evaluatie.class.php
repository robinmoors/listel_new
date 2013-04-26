<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Evaluatie extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Evaluatie';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='evaluatie';
	const SQL_INSERT='INSERT INTO `evaluatie` (`id`,`patient`,`datum`,`locatie`,`vooruitgang`,`katz_id`,`uitvoerder_id`,`genre`,`tp_rechtenOC`,`creatiedatum`) VALUES (?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `evaluatie` (`patient`,`datum`,`locatie`,`vooruitgang`,`katz_id`,`uitvoerder_id`,`genre`,`tp_rechtenOC`,`creatiedatum`) VALUES (?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `evaluatie` SET `id`=?,`patient`=?,`datum`=?,`locatie`=?,`vooruitgang`=?,`katz_id`=?,`uitvoerder_id`=?,`genre`=?,`tp_rechtenOC`=?,`creatiedatum`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `evaluatie` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `evaluatie` WHERE `id`=?';
	const FIELD_ID=406960481;
	const FIELD_PATIENT=-1305412993;
	const FIELD_DATUM=-937578903;
	const FIELD_LOCATIE=-175576247;
	const FIELD_VOORUITGANG=-987614959;
	const FIELD_KATZ_ID=-1447463592;
	const FIELD_UITVOERDER_ID=444226825;
	const FIELD_GENRE=-934695043;
	const FIELD_TP_RECHTENOC=1356131996;
	const FIELD_CREATIEDATUM=647294192;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_PATIENT=>'patient',
		self::FIELD_DATUM=>'datum',
		self::FIELD_LOCATIE=>'locatie',
		self::FIELD_VOORUITGANG=>'vooruitgang',
		self::FIELD_KATZ_ID=>'katz_id',
		self::FIELD_UITVOERDER_ID=>'uitvoerder_id',
		self::FIELD_GENRE=>'genre',
		self::FIELD_TP_RECHTENOC=>'tp_rechtenOC',
		self::FIELD_CREATIEDATUM=>'creatiedatum');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_PATIENT=>'patient',
		self::FIELD_DATUM=>'datum',
		self::FIELD_LOCATIE=>'locatie',
		self::FIELD_VOORUITGANG=>'vooruitgang',
		self::FIELD_KATZ_ID=>'katzId',
		self::FIELD_UITVOERDER_ID=>'uitvoerderId',
		self::FIELD_GENRE=>'genre',
		self::FIELD_TP_RECHTENOC=>'tpRechtenoc',
		self::FIELD_CREATIEDATUM=>'creatiedatum');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_PATIENT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DATUM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_LOCATIE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VOORUITGANG=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_KATZ_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_UITVOERDER_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_GENRE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TP_RECHTENOC=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_CREATIEDATUM=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_PATIENT=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_DATUM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,10,0,false),
		self::FIELD_LOCATIE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,12,0,false),
		self::FIELD_VOORUITGANG=>array(Db2PhpEntity::JDBC_TYPE_LONGVARCHAR,65535,0,false),
		self::FIELD_KATZ_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_UITVOERDER_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_GENRE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,false),
		self::FIELD_TP_RECHTENOC=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,true),
		self::FIELD_CREATIEDATUM=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_PATIENT=>'',
		self::FIELD_DATUM=>'',
		self::FIELD_LOCATIE=>'huisbezoek',
		self::FIELD_VOORUITGANG=>'',
		self::FIELD_KATZ_ID=>null,
		self::FIELD_UITVOERDER_ID=>0,
		self::FIELD_GENRE=>'',
		self::FIELD_TP_RECHTENOC=>'1',
		self::FIELD_CREATIEDATUM=>0);
	private $id;
	private $patient;
	private $datum;
	private $locatie;
	private $vooruitgang;
	private $katzId;
	private $uitvoerderId;
	private $genre;
	private $tpRechtenoc;
	private $creatiedatum;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return Evaluatie
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
	 * @return Evaluatie
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
	 * set value for datum 
	 *
	 * type:VARCHAR,size:10,default:,index
	 *
	 * @param mixed $datum
	 * @return Evaluatie
	 */
	public function &setDatum($datum) {
		$this->notifyChanged(self::FIELD_DATUM,$this->datum,$datum);
		$this->datum=$datum;
		return $this;
	}

	/**
	 * get value for datum 
	 *
	 * type:VARCHAR,size:10,default:,index
	 *
	 * @return mixed
	 */
	public function getDatum() {
		return $this->datum;
	}

	/**
	 * set value for locatie 
	 *
	 * type:ENUM,size:12,default:huisbezoek
	 *
	 * @param mixed $locatie
	 * @return Evaluatie
	 */
	public function &setLocatie($locatie) {
		$this->notifyChanged(self::FIELD_LOCATIE,$this->locatie,$locatie);
		$this->locatie=$locatie;
		return $this;
	}

	/**
	 * get value for locatie 
	 *
	 * type:ENUM,size:12,default:huisbezoek
	 *
	 * @return mixed
	 */
	public function getLocatie() {
		return $this->locatie;
	}

	/**
	 * set value for vooruitgang 
	 *
	 * type:TEXT,size:65535,default:null
	 *
	 * @param mixed $vooruitgang
	 * @return Evaluatie
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
	 * set value for katz_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $katzId
	 * @return Evaluatie
	 */
	public function &setKatzId($katzId) {
		$this->notifyChanged(self::FIELD_KATZ_ID,$this->katzId,$katzId);
		$this->katzId=$katzId;
		return $this;
	}

	/**
	 * get value for katz_id 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getKatzId() {
		return $this->katzId;
	}

	/**
	 * set value for uitvoerder_id 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $uitvoerderId
	 * @return Evaluatie
	 */
	public function &setUitvoerderId($uitvoerderId) {
		$this->notifyChanged(self::FIELD_UITVOERDER_ID,$this->uitvoerderId,$uitvoerderId);
		$this->uitvoerderId=$uitvoerderId;
		return $this;
	}

	/**
	 * get value for uitvoerder_id 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @return mixed
	 */
	public function getUitvoerderId() {
		return $this->uitvoerderId;
	}

	/**
	 * set value for genre 
	 *
	 * type:VARCHAR,size:20,default:
	 *
	 * @param mixed $genre
	 * @return Evaluatie
	 */
	public function &setGenre($genre) {
		$this->notifyChanged(self::FIELD_GENRE,$this->genre,$genre);
		$this->genre=$genre;
		return $this;
	}

	/**
	 * get value for genre 
	 *
	 * type:VARCHAR,size:20,default:
	 *
	 * @return mixed
	 */
	public function getGenre() {
		return $this->genre;
	}

	/**
	 * set value for tp_rechtenOC 
	 *
	 * type:BIT,size:0,default:1,nullable
	 *
	 * @param mixed $tpRechtenoc
	 * @return Evaluatie
	 */
	public function &setTpRechtenoc($tpRechtenoc) {
		$this->notifyChanged(self::FIELD_TP_RECHTENOC,$this->tpRechtenoc,$tpRechtenoc);
		$this->tpRechtenoc=$tpRechtenoc;
		return $this;
	}

	/**
	 * get value for tp_rechtenOC 
	 *
	 * type:BIT,size:0,default:1,nullable
	 *
	 * @return mixed
	 */
	public function getTpRechtenoc() {
		return $this->tpRechtenoc;
	}

	/**
	 * set value for creatiedatum 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $creatiedatum
	 * @return Evaluatie
	 */
	public function &setCreatiedatum($creatiedatum) {
		$this->notifyChanged(self::FIELD_CREATIEDATUM,$this->creatiedatum,$creatiedatum);
		$this->creatiedatum=$creatiedatum;
		return $this;
	}

	/**
	 * get value for creatiedatum 
	 *
	 * type:INT,size:10,default:0
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
			self::FIELD_PATIENT=>$this->getPatient(),
			self::FIELD_DATUM=>$this->getDatum(),
			self::FIELD_LOCATIE=>$this->getLocatie(),
			self::FIELD_VOORUITGANG=>$this->getVooruitgang(),
			self::FIELD_KATZ_ID=>$this->getKatzId(),
			self::FIELD_UITVOERDER_ID=>$this->getUitvoerderId(),
			self::FIELD_GENRE=>$this->getGenre(),
			self::FIELD_TP_RECHTENOC=>$this->getTpRechtenoc(),
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
	 * Match by attributes of passed example instance and return matched rows as an array of Evaluatie instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Evaluatie $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Evaluatie[]
	 */
	public static function findByExample(PDO $db,Evaluatie $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Evaluatie instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Evaluatie[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `evaluatie`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Evaluatie instances
	 *
	 * @param PDOStatement $stmt
	 * @return Evaluatie[]
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
	 * returns the result as an array of Evaluatie instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Evaluatie[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Evaluatie();
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
	 * Execute select query and return matched rows as an array of Evaluatie instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Evaluatie[]
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
		$sql='DELETE FROM `evaluatie`'
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
		$this->setDatum($result['datum']);
		$this->setLocatie($result['locatie']);
		$this->setVooruitgang($result['vooruitgang']);
		$this->setKatzId($result['katz_id']);
		$this->setUitvoerderId($result['uitvoerder_id']);
		$this->setGenre($result['genre']);
		$this->setTpRechtenoc($result['tp_rechtenOC']);
		$this->setCreatiedatum($result['creatiedatum']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Evaluatie
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
		$o=new Evaluatie();
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
		$stmt->bindValue(3,$this->getDatum());
		$stmt->bindValue(4,$this->getLocatie());
		$stmt->bindValue(5,$this->getVooruitgang());
		$stmt->bindValue(6,$this->getKatzId());
		$stmt->bindValue(7,$this->getUitvoerderId());
		$stmt->bindValue(8,$this->getGenre());
		$stmt->bindValue(9,$this->getTpRechtenoc());
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
			$stmt->bindValue(1,$this->getPatient());
			$stmt->bindValue(2,$this->getDatum());
			$stmt->bindValue(3,$this->getLocatie());
			$stmt->bindValue(4,$this->getVooruitgang());
			$stmt->bindValue(5,$this->getKatzId());
			$stmt->bindValue(6,$this->getUitvoerderId());
			$stmt->bindValue(7,$this->getGenre());
			$stmt->bindValue(8,$this->getTpRechtenoc());
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
	 * Fetch EvaluatieRechten's which this Evaluatie references.
	 * `evaluatie`.`id` -> `evaluatie_rechten`.`evaluatie`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return EvaluatieRechten[]
	 */
	public function fetchEvaluatieRechtenCollection(PDO $db, $sort=null) {
		$filter=array(EvaluatieRechten::FIELD_EVALUATIE=>$this->getId());
		return EvaluatieRechten::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Katz which references this Evaluatie. Will return null in case reference is invalid.
	 * `evaluatie`.`katz_id` -> `katz`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Katz
	 */
	public function fetchKatz(PDO $db, $sort=null) {
		$filter=array(Katz::FIELD_ID=>$this->getKatzId());
		$result=Katz::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Patient which references this Evaluatie. Will return null in case reference is invalid.
	 * `evaluatie`.`patient` -> `patient`.`code`
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
	 * Fetch Hulpverleners which references this Evaluatie. Will return null in case reference is invalid.
	 * `evaluatie`.`uitvoerder_id` -> `hulpverleners`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Hulpverleners
	 */
	public function fetchHulpverleners(PDO $db, $sort=null) {
		$filter=array(Hulpverleners::FIELD_ID=>$this->getUitvoerderId());
		$result=Hulpverleners::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'Evaluatie');
	}

	/**
	 * get single Evaluatie instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Evaluatie
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Evaluatie();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Evaluatie from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Evaluatie[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Evaluatie') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>