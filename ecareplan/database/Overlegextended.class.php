<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Overlegextended extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Overlegextended';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='overlegextended';
	const SQL_INSERT='INSERT INTO `overlegextended` (`id`,`overleg_id`,`locatieTekst`,`tijdstip`,`akkoord_patient`,`aanwezig_patient`,`vertegenwoordiger`,`eval_nieuw`,`afronddatum`,`volgende_datum`,`verklaring_huisarts`,`ambulant`,`huisarts_belangrijk`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `overlegextended` (`overleg_id`,`locatieTekst`,`tijdstip`,`akkoord_patient`,`aanwezig_patient`,`vertegenwoordiger`,`eval_nieuw`,`afronddatum`,`volgende_datum`,`verklaring_huisarts`,`ambulant`,`huisarts_belangrijk`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `overlegextended` SET `id`=?,`overleg_id`=?,`locatieTekst`=?,`tijdstip`=?,`akkoord_patient`=?,`aanwezig_patient`=?,`vertegenwoordiger`=?,`eval_nieuw`=?,`afronddatum`=?,`volgende_datum`=?,`verklaring_huisarts`=?,`ambulant`=?,`huisarts_belangrijk`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `overlegextended` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `overlegextended` WHERE `id`=?';
	const FIELD_ID=-1101301514;
	const FIELD_OVERLEG_ID=806787995;
	const FIELD_LOCATIETEKST=-1459223673;
	const FIELD_TIJDSTIP=1222862290;
	const FIELD_AKKOORD_PATIENT=-1272728610;
	const FIELD_AANWEZIG_PATIENT=1022631005;
	const FIELD_VERTEGENWOORDIGER=1867282333;
	const FIELD_EVAL_NIEUW=-1298207324;
	const FIELD_AFRONDDATUM=560498588;
	const FIELD_VOLGENDE_DATUM=-1163816151;
	const FIELD_VERKLARING_HUISARTS=1383154462;
	const FIELD_AMBULANT=1510691733;
	const FIELD_HUISARTS_BELANGRIJK=1615542470;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_OVERLEG_ID=>'overleg_id',
		self::FIELD_LOCATIETEKST=>'locatieTekst',
		self::FIELD_TIJDSTIP=>'tijdstip',
		self::FIELD_AKKOORD_PATIENT=>'akkoord_patient',
		self::FIELD_AANWEZIG_PATIENT=>'aanwezig_patient',
		self::FIELD_VERTEGENWOORDIGER=>'vertegenwoordiger',
		self::FIELD_EVAL_NIEUW=>'eval_nieuw',
		self::FIELD_AFRONDDATUM=>'afronddatum',
		self::FIELD_VOLGENDE_DATUM=>'volgende_datum',
		self::FIELD_VERKLARING_HUISARTS=>'verklaring_huisarts',
		self::FIELD_AMBULANT=>'ambulant',
		self::FIELD_HUISARTS_BELANGRIJK=>'huisarts_belangrijk');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_OVERLEG_ID=>'overlegId',
		self::FIELD_LOCATIETEKST=>'locatieTekst',
		self::FIELD_TIJDSTIP=>'tijdstip',
		self::FIELD_AKKOORD_PATIENT=>'akkoordPatient',
		self::FIELD_AANWEZIG_PATIENT=>'aanwezigPatient',
		self::FIELD_VERTEGENWOORDIGER=>'vertegenwoordiger',
		self::FIELD_EVAL_NIEUW=>'evalNieuw',
		self::FIELD_AFRONDDATUM=>'afronddatum',
		self::FIELD_VOLGENDE_DATUM=>'volgendeDatum',
		self::FIELD_VERKLARING_HUISARTS=>'verklaringHuisarts',
		self::FIELD_AMBULANT=>'ambulant',
		self::FIELD_HUISARTS_BELANGRIJK=>'huisartsBelangrijk');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_OVERLEG_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_LOCATIETEKST=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TIJDSTIP=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AKKOORD_PATIENT=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_AANWEZIG_PATIENT=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_VERTEGENWOORDIGER=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EVAL_NIEUW=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_AFRONDDATUM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VOLGENDE_DATUM=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_VERKLARING_HUISARTS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AMBULANT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_HUISARTS_BELANGRIJK=>Db2PhpEntity::PHP_TYPE_BOOL);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_OVERLEG_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_LOCATIETEKST=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,true),
		self::FIELD_TIJDSTIP=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,80,0,true),
		self::FIELD_AKKOORD_PATIENT=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,true),
		self::FIELD_AANWEZIG_PATIENT=>array(Db2PhpEntity::JDBC_TYPE_TINYINT,3,0,true),
		self::FIELD_VERTEGENWOORDIGER=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_EVAL_NIEUW=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_AFRONDDATUM=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,10,0,true),
		self::FIELD_VOLGENDE_DATUM=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_VERKLARING_HUISARTS=>array(Db2PhpEntity::JDBC_TYPE_CHAR,9,0,true),
		self::FIELD_AMBULANT=>array(Db2PhpEntity::JDBC_TYPE_CHAR,10,0,true),
		self::FIELD_HUISARTS_BELANGRIJK=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_OVERLEG_ID=>0,
		self::FIELD_LOCATIETEKST=>null,
		self::FIELD_TIJDSTIP=>null,
		self::FIELD_AKKOORD_PATIENT=>1,
		self::FIELD_AANWEZIG_PATIENT=>null,
		self::FIELD_VERTEGENWOORDIGER=>null,
		self::FIELD_EVAL_NIEUW=>null,
		self::FIELD_AFRONDDATUM=>null,
		self::FIELD_VOLGENDE_DATUM=>null,
		self::FIELD_VERKLARING_HUISARTS=>null,
		self::FIELD_AMBULANT=>null,
		self::FIELD_HUISARTS_BELANGRIJK=>null);
	private $id;
	private $overlegId;
	private $locatieTekst;
	private $tijdstip;
	private $akkoordPatient;
	private $aanwezigPatient;
	private $vertegenwoordiger;
	private $evalNieuw;
	private $afronddatum;
	private $volgendeDatum;
	private $verklaringHuisarts;
	private $ambulant;
	private $huisartsBelangrijk;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return Overlegextended
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
	 * type:INT,size:10,default:null,index
	 *
	 * @param mixed $overlegId
	 * @return Overlegextended
	 */
	public function &setOverlegId($overlegId) {
		$this->notifyChanged(self::FIELD_OVERLEG_ID,$this->overlegId,$overlegId);
		$this->overlegId=$overlegId;
		return $this;
	}

	/**
	 * get value for overleg_id 
	 *
	 * type:INT,size:10,default:null,index
	 *
	 * @return mixed
	 */
	public function getOverlegId() {
		return $this->overlegId;
	}

	/**
	 * set value for locatieTekst 
	 *
	 * type:VARCHAR,size:200,default:null,nullable
	 *
	 * @param mixed $locatieTekst
	 * @return Overlegextended
	 */
	public function &setLocatieTekst($locatieTekst) {
		$this->notifyChanged(self::FIELD_LOCATIETEKST,$this->locatieTekst,$locatieTekst);
		$this->locatieTekst=$locatieTekst;
		return $this;
	}

	/**
	 * get value for locatieTekst 
	 *
	 * type:VARCHAR,size:200,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getLocatieTekst() {
		return $this->locatieTekst;
	}

	/**
	 * set value for tijdstip 
	 *
	 * type:VARCHAR,size:80,default:null,nullable
	 *
	 * @param mixed $tijdstip
	 * @return Overlegextended
	 */
	public function &setTijdstip($tijdstip) {
		$this->notifyChanged(self::FIELD_TIJDSTIP,$this->tijdstip,$tijdstip);
		$this->tijdstip=$tijdstip;
		return $this;
	}

	/**
	 * get value for tijdstip 
	 *
	 * type:VARCHAR,size:80,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTijdstip() {
		return $this->tijdstip;
	}

	/**
	 * set value for akkoord_patient 
	 *
	 * type:TINYINT,size:3,default:1,nullable
	 *
	 * @param mixed $akkoordPatient
	 * @return Overlegextended
	 */
	public function &setAkkoordPatient($akkoordPatient) {
		$this->notifyChanged(self::FIELD_AKKOORD_PATIENT,$this->akkoordPatient,$akkoordPatient);
		$this->akkoordPatient=$akkoordPatient;
		return $this;
	}

	/**
	 * get value for akkoord_patient 
	 *
	 * type:TINYINT,size:3,default:1,nullable
	 *
	 * @return mixed
	 */
	public function getAkkoordPatient() {
		return $this->akkoordPatient;
	}

	/**
	 * set value for aanwezig_patient 
	 *
	 * type:TINYINT,size:3,default:-1,nullable
	 *
	 * @param mixed $aanwezigPatient
	 * @return Overlegextended
	 */
	public function &setAanwezigPatient($aanwezigPatient) {
		$this->notifyChanged(self::FIELD_AANWEZIG_PATIENT,$this->aanwezigPatient,$aanwezigPatient);
		$this->aanwezigPatient=$aanwezigPatient;
		return $this;
	}

	/**
	 * get value for aanwezig_patient 
	 *
	 * type:TINYINT,size:3,default:-1,nullable
	 *
	 * @return mixed
	 */
	public function getAanwezigPatient() {
		return $this->aanwezigPatient;
	}

	/**
	 * set value for vertegenwoordiger 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $vertegenwoordiger
	 * @return Overlegextended
	 */
	public function &setVertegenwoordiger($vertegenwoordiger) {
		$this->notifyChanged(self::FIELD_VERTEGENWOORDIGER,$this->vertegenwoordiger,$vertegenwoordiger);
		$this->vertegenwoordiger=$vertegenwoordiger;
		return $this;
	}

	/**
	 * get value for vertegenwoordiger 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getVertegenwoordiger() {
		return $this->vertegenwoordiger;
	}

	/**
	 * set value for eval_nieuw 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $evalNieuw
	 * @return Overlegextended
	 */
	public function &setEvalNieuw($evalNieuw) {
		$this->notifyChanged(self::FIELD_EVAL_NIEUW,$this->evalNieuw,$evalNieuw);
		$this->evalNieuw=$evalNieuw;
		return $this;
	}

	/**
	 * get value for eval_nieuw 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEvalNieuw() {
		return $this->evalNieuw;
	}

	/**
	 * set value for afronddatum 
	 *
	 * type:VARCHAR,size:10,default:null,nullable
	 *
	 * @param mixed $afronddatum
	 * @return Overlegextended
	 */
	public function &setAfronddatum($afronddatum) {
		$this->notifyChanged(self::FIELD_AFRONDDATUM,$this->afronddatum,$afronddatum);
		$this->afronddatum=$afronddatum;
		return $this;
	}

	/**
	 * get value for afronddatum 
	 *
	 * type:VARCHAR,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAfronddatum() {
		return $this->afronddatum;
	}

	/**
	 * set value for volgende_datum 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $volgendeDatum
	 * @return Overlegextended
	 */
	public function &setVolgendeDatum($volgendeDatum) {
		$this->notifyChanged(self::FIELD_VOLGENDE_DATUM,$this->volgendeDatum,$volgendeDatum);
		$this->volgendeDatum=$volgendeDatum;
		return $this;
	}

	/**
	 * get value for volgende_datum 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getVolgendeDatum() {
		return $this->volgendeDatum;
	}

	/**
	 * set value for verklaring_huisarts 
	 *
	 * type:ENUM,size:9,default:null,nullable
	 *
	 * @param mixed $verklaringHuisarts
	 * @return Overlegextended
	 */
	public function &setVerklaringHuisarts($verklaringHuisarts) {
		$this->notifyChanged(self::FIELD_VERKLARING_HUISARTS,$this->verklaringHuisarts,$verklaringHuisarts);
		$this->verklaringHuisarts=$verklaringHuisarts;
		return $this;
	}

	/**
	 * get value for verklaring_huisarts 
	 *
	 * type:ENUM,size:9,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getVerklaringHuisarts() {
		return $this->verklaringHuisarts;
	}

	/**
	 * set value for ambulant 
	 *
	 * type:ENUM,size:10,default:null,nullable
	 *
	 * @param mixed $ambulant
	 * @return Overlegextended
	 */
	public function &setAmbulant($ambulant) {
		$this->notifyChanged(self::FIELD_AMBULANT,$this->ambulant,$ambulant);
		$this->ambulant=$ambulant;
		return $this;
	}

	/**
	 * get value for ambulant 
	 *
	 * type:ENUM,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAmbulant() {
		return $this->ambulant;
	}

	/**
	 * set value for huisarts_belangrijk 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @param mixed $huisartsBelangrijk
	 * @return Overlegextended
	 */
	public function &setHuisartsBelangrijk($huisartsBelangrijk) {
		$this->notifyChanged(self::FIELD_HUISARTS_BELANGRIJK,$this->huisartsBelangrijk,$huisartsBelangrijk);
		$this->huisartsBelangrijk=$huisartsBelangrijk;
		return $this;
	}

	/**
	 * get value for huisarts_belangrijk 
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getHuisartsBelangrijk() {
		return $this->huisartsBelangrijk;
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
			self::FIELD_LOCATIETEKST=>$this->getLocatieTekst(),
			self::FIELD_TIJDSTIP=>$this->getTijdstip(),
			self::FIELD_AKKOORD_PATIENT=>$this->getAkkoordPatient(),
			self::FIELD_AANWEZIG_PATIENT=>$this->getAanwezigPatient(),
			self::FIELD_VERTEGENWOORDIGER=>$this->getVertegenwoordiger(),
			self::FIELD_EVAL_NIEUW=>$this->getEvalNieuw(),
			self::FIELD_AFRONDDATUM=>$this->getAfronddatum(),
			self::FIELD_VOLGENDE_DATUM=>$this->getVolgendeDatum(),
			self::FIELD_VERKLARING_HUISARTS=>$this->getVerklaringHuisarts(),
			self::FIELD_AMBULANT=>$this->getAmbulant(),
			self::FIELD_HUISARTS_BELANGRIJK=>$this->getHuisartsBelangrijk());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Overlegextended instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Overlegextended $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Overlegextended[]
	 */
	public static function findByExample(PDO $db,Overlegextended $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Overlegextended instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Overlegextended[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `overlegextended`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Overlegextended instances
	 *
	 * @param PDOStatement $stmt
	 * @return Overlegextended[]
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
	 * returns the result as an array of Overlegextended instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Overlegextended[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Overlegextended();
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
	 * Execute select query and return matched rows as an array of Overlegextended instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Overlegextended[]
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
		$sql='DELETE FROM `overlegextended`'
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
		$this->setLocatieTekst($result['locatieTekst']);
		$this->setTijdstip($result['tijdstip']);
		$this->setAkkoordPatient($result['akkoord_patient']);
		$this->setAanwezigPatient($result['aanwezig_patient']);
		$this->setVertegenwoordiger($result['vertegenwoordiger']);
		$this->setEvalNieuw($result['eval_nieuw']);
		$this->setAfronddatum($result['afronddatum']);
		$this->setVolgendeDatum($result['volgende_datum']);
		$this->setVerklaringHuisarts($result['verklaring_huisarts']);
		$this->setAmbulant($result['ambulant']);
		$this->setHuisartsBelangrijk($result['huisarts_belangrijk']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Overlegextended
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
		$o=new Overlegextended();
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
		$stmt->bindValue(3,$this->getLocatieTekst());
		$stmt->bindValue(4,$this->getTijdstip());
		$stmt->bindValue(5,$this->getAkkoordPatient());
		$stmt->bindValue(6,$this->getAanwezigPatient());
		$stmt->bindValue(7,$this->getVertegenwoordiger());
		$stmt->bindValue(8,$this->getEvalNieuw());
		$stmt->bindValue(9,$this->getAfronddatum());
		$stmt->bindValue(10,$this->getVolgendeDatum());
		$stmt->bindValue(11,$this->getVerklaringHuisarts());
		$stmt->bindValue(12,$this->getAmbulant());
		$stmt->bindValue(13,$this->getHuisartsBelangrijk());
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
			$stmt->bindValue(2,$this->getLocatieTekst());
			$stmt->bindValue(3,$this->getTijdstip());
			$stmt->bindValue(4,$this->getAkkoordPatient());
			$stmt->bindValue(5,$this->getAanwezigPatient());
			$stmt->bindValue(6,$this->getVertegenwoordiger());
			$stmt->bindValue(7,$this->getEvalNieuw());
			$stmt->bindValue(8,$this->getAfronddatum());
			$stmt->bindValue(9,$this->getVolgendeDatum());
			$stmt->bindValue(10,$this->getVerklaringHuisarts());
			$stmt->bindValue(11,$this->getAmbulant());
			$stmt->bindValue(12,$this->getHuisartsBelangrijk());
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
		$stmt->bindValue(14,$this->getId());
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
	 * Fetch Overlegbasis which references this Overlegextended. Will return null in case reference is invalid.
	 * `overlegextended`.`overleg_id` -> `overlegbasis`.`id`
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
		return self::hashToDomDocument($this->toHash(), 'Overlegextended');
	}

	/**
	 * get single Overlegextended instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Overlegextended
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Overlegextended();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Overlegextended from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Overlegextended[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Overlegextended') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>