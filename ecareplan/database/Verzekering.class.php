<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Verzekering extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Verzekering';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='verzekering';
	const SQL_INSERT='INSERT INTO `verzekering` (`id`,`nr`,`naam`,`dienst`,`contact`,`adres`,`gem_id`,`tel`,`fax`,`gsm`,`email`,`actief`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `verzekering` (`nr`,`naam`,`dienst`,`contact`,`adres`,`gem_id`,`tel`,`fax`,`gsm`,`email`,`actief`) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `verzekering` SET `id`=?,`nr`=?,`naam`=?,`dienst`=?,`contact`=?,`adres`=?,`gem_id`=?,`tel`=?,`fax`=?,`gsm`=?,`email`=?,`actief`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `verzekering` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `verzekering` WHERE `id`=?';
	const FIELD_ID=895545521;
	const FIELD_NR=895545690;
	const FIELD_NAAM=1625935669;
	const FIELD_DIENST=-1122697371;
	const FIELD_CONTACT=-1151136182;
	const FIELD_ADRES=-1147502009;
	const FIELD_GEM_ID=-1040280415;
	const FIELD_TEL=1992118085;
	const FIELD_FAX=1992104519;
	const FIELD_GSM=1992106027;
	const FIELD_EMAIL=-1143556026;
	const FIELD_ACTIEF=-1213684338;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_NR=>'nr',
		self::FIELD_NAAM=>'naam',
		self::FIELD_DIENST=>'dienst',
		self::FIELD_CONTACT=>'contact',
		self::FIELD_ADRES=>'adres',
		self::FIELD_GEM_ID=>'gem_id',
		self::FIELD_TEL=>'tel',
		self::FIELD_FAX=>'fax',
		self::FIELD_GSM=>'gsm',
		self::FIELD_EMAIL=>'email',
		self::FIELD_ACTIEF=>'actief');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_NR=>'nr',
		self::FIELD_NAAM=>'naam',
		self::FIELD_DIENST=>'dienst',
		self::FIELD_CONTACT=>'contact',
		self::FIELD_ADRES=>'adres',
		self::FIELD_GEM_ID=>'gemId',
		self::FIELD_TEL=>'tel',
		self::FIELD_FAX=>'fax',
		self::FIELD_GSM=>'gsm',
		self::FIELD_EMAIL=>'email',
		self::FIELD_ACTIEF=>'actief');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NR=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_NAAM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DIENST=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CONTACT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ADRES=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GEM_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TEL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FAX=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GSM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EMAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ACTIEF=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_NR=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,5,0,false),
		self::FIELD_NAAM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,100,0,false),
		self::FIELD_DIENST=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,false),
		self::FIELD_CONTACT=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,80,0,false),
		self::FIELD_ADRES=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,false),
		self::FIELD_GEM_ID=>array(Db2PhpEntity::JDBC_TYPE_SMALLINT,5,0,false),
		self::FIELD_TEL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,12,0,false),
		self::FIELD_FAX=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,12,0,false),
		self::FIELD_GSM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,12,0,false),
		self::FIELD_EMAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,false),
		self::FIELD_ACTIEF=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_NR=>'0',
		self::FIELD_NAAM=>'',
		self::FIELD_DIENST=>'',
		self::FIELD_CONTACT=>'',
		self::FIELD_ADRES=>'',
		self::FIELD_GEM_ID=>9999,
		self::FIELD_TEL=>'',
		self::FIELD_FAX=>'',
		self::FIELD_GSM=>'',
		self::FIELD_EMAIL=>'',
		self::FIELD_ACTIEF=>1);
	private $id;
	private $nr;
	private $naam;
	private $dienst;
	private $contact;
	private $adres;
	private $gemId;
	private $tel;
	private $fax;
	private $gsm;
	private $email;
	private $actief;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return Verzekering
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
	 * set value for nr 
	 *
	 * type:VARCHAR,size:5,default:0,index
	 *
	 * @param mixed $nr
	 * @return Verzekering
	 */
	public function &setNr($nr) {
		$this->notifyChanged(self::FIELD_NR,$this->nr,$nr);
		$this->nr=$nr;
		return $this;
	}

	/**
	 * get value for nr 
	 *
	 * type:VARCHAR,size:5,default:0,index
	 *
	 * @return mixed
	 */
	public function getNr() {
		return $this->nr;
	}

	/**
	 * set value for naam 
	 *
	 * type:VARCHAR,size:100,default:,index
	 *
	 * @param mixed $naam
	 * @return Verzekering
	 */
	public function &setNaam($naam) {
		$this->notifyChanged(self::FIELD_NAAM,$this->naam,$naam);
		$this->naam=$naam;
		return $this;
	}

	/**
	 * get value for naam 
	 *
	 * type:VARCHAR,size:100,default:,index
	 *
	 * @return mixed
	 */
	public function getNaam() {
		return $this->naam;
	}

	/**
	 * set value for dienst 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @param mixed $dienst
	 * @return Verzekering
	 */
	public function &setDienst($dienst) {
		$this->notifyChanged(self::FIELD_DIENST,$this->dienst,$dienst);
		$this->dienst=$dienst;
		return $this;
	}

	/**
	 * get value for dienst 
	 *
	 * type:VARCHAR,size:40,default:
	 *
	 * @return mixed
	 */
	public function getDienst() {
		return $this->dienst;
	}

	/**
	 * set value for contact 
	 *
	 * type:VARCHAR,size:80,default:
	 *
	 * @param mixed $contact
	 * @return Verzekering
	 */
	public function &setContact($contact) {
		$this->notifyChanged(self::FIELD_CONTACT,$this->contact,$contact);
		$this->contact=$contact;
		return $this;
	}

	/**
	 * get value for contact 
	 *
	 * type:VARCHAR,size:80,default:
	 *
	 * @return mixed
	 */
	public function getContact() {
		return $this->contact;
	}

	/**
	 * set value for adres 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @param mixed $adres
	 * @return Verzekering
	 */
	public function &setAdres($adres) {
		$this->notifyChanged(self::FIELD_ADRES,$this->adres,$adres);
		$this->adres=$adres;
		return $this;
	}

	/**
	 * get value for adres 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @return mixed
	 */
	public function getAdres() {
		return $this->adres;
	}

	/**
	 * set value for gem_id 
	 *
	 * type:SMALLINT,size:5,default:9999,index
	 *
	 * @param mixed $gemId
	 * @return Verzekering
	 */
	public function &setGemId($gemId) {
		$this->notifyChanged(self::FIELD_GEM_ID,$this->gemId,$gemId);
		$this->gemId=$gemId;
		return $this;
	}

	/**
	 * get value for gem_id 
	 *
	 * type:SMALLINT,size:5,default:9999,index
	 *
	 * @return mixed
	 */
	public function getGemId() {
		return $this->gemId;
	}

	/**
	 * set value for tel 
	 *
	 * type:VARCHAR,size:12,default:
	 *
	 * @param mixed $tel
	 * @return Verzekering
	 */
	public function &setTel($tel) {
		$this->notifyChanged(self::FIELD_TEL,$this->tel,$tel);
		$this->tel=$tel;
		return $this;
	}

	/**
	 * get value for tel 
	 *
	 * type:VARCHAR,size:12,default:
	 *
	 * @return mixed
	 */
	public function getTel() {
		return $this->tel;
	}

	/**
	 * set value for fax 
	 *
	 * type:VARCHAR,size:12,default:
	 *
	 * @param mixed $fax
	 * @return Verzekering
	 */
	public function &setFax($fax) {
		$this->notifyChanged(self::FIELD_FAX,$this->fax,$fax);
		$this->fax=$fax;
		return $this;
	}

	/**
	 * get value for fax 
	 *
	 * type:VARCHAR,size:12,default:
	 *
	 * @return mixed
	 */
	public function getFax() {
		return $this->fax;
	}

	/**
	 * set value for gsm 
	 *
	 * type:VARCHAR,size:12,default:
	 *
	 * @param mixed $gsm
	 * @return Verzekering
	 */
	public function &setGsm($gsm) {
		$this->notifyChanged(self::FIELD_GSM,$this->gsm,$gsm);
		$this->gsm=$gsm;
		return $this;
	}

	/**
	 * get value for gsm 
	 *
	 * type:VARCHAR,size:12,default:
	 *
	 * @return mixed
	 */
	public function getGsm() {
		return $this->gsm;
	}

	/**
	 * set value for email 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @param mixed $email
	 * @return Verzekering
	 */
	public function &setEmail($email) {
		$this->notifyChanged(self::FIELD_EMAIL,$this->email,$email);
		$this->email=$email;
		return $this;
	}

	/**
	 * get value for email 
	 *
	 * type:VARCHAR,size:50,default:
	 *
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * set value for actief 
	 *
	 * type:INT,size:10,default:1
	 *
	 * @param mixed $actief
	 * @return Verzekering
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
			self::FIELD_ID=>$this->getId(),
			self::FIELD_NR=>$this->getNr(),
			self::FIELD_NAAM=>$this->getNaam(),
			self::FIELD_DIENST=>$this->getDienst(),
			self::FIELD_CONTACT=>$this->getContact(),
			self::FIELD_ADRES=>$this->getAdres(),
			self::FIELD_GEM_ID=>$this->getGemId(),
			self::FIELD_TEL=>$this->getTel(),
			self::FIELD_FAX=>$this->getFax(),
			self::FIELD_GSM=>$this->getGsm(),
			self::FIELD_EMAIL=>$this->getEmail(),
			self::FIELD_ACTIEF=>$this->getActief());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Verzekering instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Verzekering $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Verzekering[]
	 */
	public static function findByExample(PDO $db,Verzekering $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Verzekering instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Verzekering[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `verzekering`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Verzekering instances
	 *
	 * @param PDOStatement $stmt
	 * @return Verzekering[]
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
	 * returns the result as an array of Verzekering instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Verzekering[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Verzekering();
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
	 * Execute select query and return matched rows as an array of Verzekering instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Verzekering[]
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
		$sql='DELETE FROM `verzekering`'
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
		$this->setNr($result['nr']);
		$this->setNaam($result['naam']);
		$this->setDienst($result['dienst']);
		$this->setContact($result['contact']);
		$this->setAdres($result['adres']);
		$this->setGemId($result['gem_id']);
		$this->setTel($result['tel']);
		$this->setFax($result['fax']);
		$this->setGsm($result['gsm']);
		$this->setEmail($result['email']);
		$this->setActief($result['actief']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Verzekering
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
		$o=new Verzekering();
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
		$stmt->bindValue(2,$this->getNr());
		$stmt->bindValue(3,$this->getNaam());
		$stmt->bindValue(4,$this->getDienst());
		$stmt->bindValue(5,$this->getContact());
		$stmt->bindValue(6,$this->getAdres());
		$stmt->bindValue(7,$this->getGemId());
		$stmt->bindValue(8,$this->getTel());
		$stmt->bindValue(9,$this->getFax());
		$stmt->bindValue(10,$this->getGsm());
		$stmt->bindValue(11,$this->getEmail());
		$stmt->bindValue(12,$this->getActief());
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
			$stmt->bindValue(1,$this->getNr());
			$stmt->bindValue(2,$this->getNaam());
			$stmt->bindValue(3,$this->getDienst());
			$stmt->bindValue(4,$this->getContact());
			$stmt->bindValue(5,$this->getAdres());
			$stmt->bindValue(6,$this->getGemId());
			$stmt->bindValue(7,$this->getTel());
			$stmt->bindValue(8,$this->getFax());
			$stmt->bindValue(9,$this->getGsm());
			$stmt->bindValue(10,$this->getEmail());
			$stmt->bindValue(11,$this->getActief());
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
		$stmt->bindValue(13,$this->getId());
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
	 * Fetch Factuurmaand's which this Verzekering references.
	 * `verzekering`.`id` -> `factuurmaand`.`mutualiteit`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Factuurmaand[]
	 */
	public function fetchFactuurmaandCollection(PDO $db, $sort=null) {
		$filter=array(Factuurmaand::FIELD_MUTUALITEIT=>$this->getId());
		return Factuurmaand::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Patient's which this Verzekering references.
	 * `verzekering`.`id` -> `patient`.`mut_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Patient[]
	 */
	public function fetchPatientCollection(PDO $db, $sort=null) {
		$filter=array(Patient::FIELD_MUT_ID=>$this->getId());
		return Patient::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Gemeente which references this Verzekering. Will return null in case reference is invalid.
	 * `verzekering`.`gem_id` -> `gemeente`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Gemeente
	 */
	public function fetchGemeente(PDO $db, $sort=null) {
		$filter=array(Gemeente::FIELD_ID=>$this->getGemId());
		$result=Gemeente::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'Verzekering');
	}

	/**
	 * get single Verzekering instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Verzekering
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Verzekering();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Verzekering from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Verzekering[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Verzekering') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>