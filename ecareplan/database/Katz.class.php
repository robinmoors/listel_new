<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Katz extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Katz';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='katz';
	const SQL_INSERT='INSERT INTO `katz` (`id`,`dd`,`mm`,`jj`,`wassen`,`kleden`,`verpla`,`toilet`,`continent`,`eten`,`orient`,`rust`,`woon`,`mantel`,`sanitair`,`totaal`,`hvl_id`,`goedkeuring_inspectie`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `katz` (`dd`,`mm`,`jj`,`wassen`,`kleden`,`verpla`,`toilet`,`continent`,`eten`,`orient`,`rust`,`woon`,`mantel`,`sanitair`,`totaal`,`hvl_id`,`goedkeuring_inspectie`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `katz` SET `id`=?,`dd`=?,`mm`=?,`jj`=?,`wassen`=?,`kleden`=?,`verpla`=?,`toilet`=?,`continent`=?,`eten`=?,`orient`=?,`rust`=?,`woon`=?,`mantel`=?,`sanitair`=?,`totaal`=?,`hvl_id`=?,`goedkeuring_inspectie`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `katz` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `katz` WHERE `id`=?';
	const FIELD_ID=-933515795;
	const FIELD_DD=-933515950;
	const FIELD_MM=-933515662;
	const FIELD_JJ=-933515758;
	const FIELD_WASSEN=-843545435;
	const FIELD_KLEDEN=-1177368005;
	const FIELD_VERPLA=-868512972;
	const FIELD_TOILET=-916808225;
	const FIELD_CONTINENT=100359330;
	const FIELD_ETEN=539385322;
	const FIELD_ORIENT=-1057189865;
	const FIELD_RUST=539774006;
	const FIELD_WOON=539917065;
	const FIELD_MANTEL=-1129984941;
	const FIELD_SANITAIR=-1726561359;
	const FIELD_TOTAAL=-916491227;
	const FIELD_HVL_ID=-1253816402;
	const FIELD_GOEDKEURING_INSPECTIE=175726403;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_DD=>'dd',
		self::FIELD_MM=>'mm',
		self::FIELD_JJ=>'jj',
		self::FIELD_WASSEN=>'wassen',
		self::FIELD_KLEDEN=>'kleden',
		self::FIELD_VERPLA=>'verpla',
		self::FIELD_TOILET=>'toilet',
		self::FIELD_CONTINENT=>'continent',
		self::FIELD_ETEN=>'eten',
		self::FIELD_ORIENT=>'orient',
		self::FIELD_RUST=>'rust',
		self::FIELD_WOON=>'woon',
		self::FIELD_MANTEL=>'mantel',
		self::FIELD_SANITAIR=>'sanitair',
		self::FIELD_TOTAAL=>'totaal',
		self::FIELD_HVL_ID=>'hvl_id',
		self::FIELD_GOEDKEURING_INSPECTIE=>'goedkeuring_inspectie');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_DD=>'dd',
		self::FIELD_MM=>'mm',
		self::FIELD_JJ=>'jj',
		self::FIELD_WASSEN=>'wassen',
		self::FIELD_KLEDEN=>'kleden',
		self::FIELD_VERPLA=>'verpla',
		self::FIELD_TOILET=>'toilet',
		self::FIELD_CONTINENT=>'continent',
		self::FIELD_ETEN=>'eten',
		self::FIELD_ORIENT=>'orient',
		self::FIELD_RUST=>'rust',
		self::FIELD_WOON=>'woon',
		self::FIELD_MANTEL=>'mantel',
		self::FIELD_SANITAIR=>'sanitair',
		self::FIELD_TOTAAL=>'totaal',
		self::FIELD_HVL_ID=>'hvlId',
		self::FIELD_GOEDKEURING_INSPECTIE=>'goedkeuringInspectie');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DD=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_MM=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_JJ=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_WASSEN=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_KLEDEN=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VERPLA=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TOILET=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CONTINENT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ETEN=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ORIENT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_RUST=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_WOON=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_MANTEL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SANITAIR=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TOTAAL=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_HVL_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_GOEDKEURING_INSPECTIE=>Db2PhpEntity::PHP_TYPE_BOOL);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_DD=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,false),
		self::FIELD_MM=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,false),
		self::FIELD_JJ=>array(Db2PhpEntity::JDBC_TYPE_CHAR,4,0,false),
		self::FIELD_WASSEN=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,false),
		self::FIELD_KLEDEN=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,false),
		self::FIELD_VERPLA=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,false),
		self::FIELD_TOILET=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,false),
		self::FIELD_CONTINENT=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,false),
		self::FIELD_ETEN=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,false),
		self::FIELD_ORIENT=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,false),
		self::FIELD_RUST=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,false),
		self::FIELD_WOON=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,false),
		self::FIELD_MANTEL=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,false),
		self::FIELD_SANITAIR=>array(Db2PhpEntity::JDBC_TYPE_CHAR,2,0,false),
		self::FIELD_TOTAAL=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_HVL_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_GOEDKEURING_INSPECTIE=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,false));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_DD=>'0',
		self::FIELD_MM=>'0',
		self::FIELD_JJ=>'0',
		self::FIELD_WASSEN=>'0',
		self::FIELD_KLEDEN=>'0',
		self::FIELD_VERPLA=>'0',
		self::FIELD_TOILET=>'0',
		self::FIELD_CONTINENT=>'0',
		self::FIELD_ETEN=>'0',
		self::FIELD_ORIENT=>'0',
		self::FIELD_RUST=>'0',
		self::FIELD_WOON=>'0',
		self::FIELD_MANTEL=>'0',
		self::FIELD_SANITAIR=>'0',
		self::FIELD_TOTAAL=>0,
		self::FIELD_HVL_ID=>0,
		self::FIELD_GOEDKEURING_INSPECTIE=>'0');
	private $id;
	private $dd;
	private $mm;
	private $jj;
	private $wassen;
	private $kleden;
	private $verpla;
	private $toilet;
	private $continent;
	private $eten;
	private $orient;
	private $rust;
	private $woon;
	private $mantel;
	private $sanitair;
	private $totaal;
	private $hvlId;
	private $goedkeuringInspectie;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return Katz
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
	 * set value for dd 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @param mixed $dd
	 * @return Katz
	 */
	public function &setDd($dd) {
		$this->notifyChanged(self::FIELD_DD,$this->dd,$dd);
		$this->dd=$dd;
		return $this;
	}

	/**
	 * get value for dd 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @return mixed
	 */
	public function getDd() {
		return $this->dd;
	}

	/**
	 * set value for mm 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @param mixed $mm
	 * @return Katz
	 */
	public function &setMm($mm) {
		$this->notifyChanged(self::FIELD_MM,$this->mm,$mm);
		$this->mm=$mm;
		return $this;
	}

	/**
	 * get value for mm 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @return mixed
	 */
	public function getMm() {
		return $this->mm;
	}

	/**
	 * set value for jj 
	 *
	 * type:CHAR,size:4,default:0
	 *
	 * @param mixed $jj
	 * @return Katz
	 */
	public function &setJj($jj) {
		$this->notifyChanged(self::FIELD_JJ,$this->jj,$jj);
		$this->jj=$jj;
		return $this;
	}

	/**
	 * get value for jj 
	 *
	 * type:CHAR,size:4,default:0
	 *
	 * @return mixed
	 */
	public function getJj() {
		return $this->jj;
	}

	/**
	 * set value for wassen 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @param mixed $wassen
	 * @return Katz
	 */
	public function &setWassen($wassen) {
		$this->notifyChanged(self::FIELD_WASSEN,$this->wassen,$wassen);
		$this->wassen=$wassen;
		return $this;
	}

	/**
	 * get value for wassen 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @return mixed
	 */
	public function getWassen() {
		return $this->wassen;
	}

	/**
	 * set value for kleden 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @param mixed $kleden
	 * @return Katz
	 */
	public function &setKleden($kleden) {
		$this->notifyChanged(self::FIELD_KLEDEN,$this->kleden,$kleden);
		$this->kleden=$kleden;
		return $this;
	}

	/**
	 * get value for kleden 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @return mixed
	 */
	public function getKleden() {
		return $this->kleden;
	}

	/**
	 * set value for verpla 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @param mixed $verpla
	 * @return Katz
	 */
	public function &setVerpla($verpla) {
		$this->notifyChanged(self::FIELD_VERPLA,$this->verpla,$verpla);
		$this->verpla=$verpla;
		return $this;
	}

	/**
	 * get value for verpla 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @return mixed
	 */
	public function getVerpla() {
		return $this->verpla;
	}

	/**
	 * set value for toilet 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @param mixed $toilet
	 * @return Katz
	 */
	public function &setToilet($toilet) {
		$this->notifyChanged(self::FIELD_TOILET,$this->toilet,$toilet);
		$this->toilet=$toilet;
		return $this;
	}

	/**
	 * get value for toilet 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @return mixed
	 */
	public function getToilet() {
		return $this->toilet;
	}

	/**
	 * set value for continent 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @param mixed $continent
	 * @return Katz
	 */
	public function &setContinent($continent) {
		$this->notifyChanged(self::FIELD_CONTINENT,$this->continent,$continent);
		$this->continent=$continent;
		return $this;
	}

	/**
	 * get value for continent 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @return mixed
	 */
	public function getContinent() {
		return $this->continent;
	}

	/**
	 * set value for eten 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @param mixed $eten
	 * @return Katz
	 */
	public function &setEten($eten) {
		$this->notifyChanged(self::FIELD_ETEN,$this->eten,$eten);
		$this->eten=$eten;
		return $this;
	}

	/**
	 * get value for eten 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @return mixed
	 */
	public function getEten() {
		return $this->eten;
	}

	/**
	 * set value for orient 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @param mixed $orient
	 * @return Katz
	 */
	public function &setOrient($orient) {
		$this->notifyChanged(self::FIELD_ORIENT,$this->orient,$orient);
		$this->orient=$orient;
		return $this;
	}

	/**
	 * get value for orient 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @return mixed
	 */
	public function getOrient() {
		return $this->orient;
	}

	/**
	 * set value for rust 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @param mixed $rust
	 * @return Katz
	 */
	public function &setRust($rust) {
		$this->notifyChanged(self::FIELD_RUST,$this->rust,$rust);
		$this->rust=$rust;
		return $this;
	}

	/**
	 * get value for rust 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @return mixed
	 */
	public function getRust() {
		return $this->rust;
	}

	/**
	 * set value for woon 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @param mixed $woon
	 * @return Katz
	 */
	public function &setWoon($woon) {
		$this->notifyChanged(self::FIELD_WOON,$this->woon,$woon);
		$this->woon=$woon;
		return $this;
	}

	/**
	 * get value for woon 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @return mixed
	 */
	public function getWoon() {
		return $this->woon;
	}

	/**
	 * set value for mantel 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @param mixed $mantel
	 * @return Katz
	 */
	public function &setMantel($mantel) {
		$this->notifyChanged(self::FIELD_MANTEL,$this->mantel,$mantel);
		$this->mantel=$mantel;
		return $this;
	}

	/**
	 * get value for mantel 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @return mixed
	 */
	public function getMantel() {
		return $this->mantel;
	}

	/**
	 * set value for sanitair 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @param mixed $sanitair
	 * @return Katz
	 */
	public function &setSanitair($sanitair) {
		$this->notifyChanged(self::FIELD_SANITAIR,$this->sanitair,$sanitair);
		$this->sanitair=$sanitair;
		return $this;
	}

	/**
	 * get value for sanitair 
	 *
	 * type:CHAR,size:2,default:0
	 *
	 * @return mixed
	 */
	public function getSanitair() {
		return $this->sanitair;
	}

	/**
	 * set value for totaal 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @param mixed $totaal
	 * @return Katz
	 */
	public function &setTotaal($totaal) {
		$this->notifyChanged(self::FIELD_TOTAAL,$this->totaal,$totaal);
		$this->totaal=$totaal;
		return $this;
	}

	/**
	 * get value for totaal 
	 *
	 * type:INT,size:10,default:0
	 *
	 * @return mixed
	 */
	public function getTotaal() {
		return $this->totaal;
	}

	/**
	 * set value for hvl_id 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @param mixed $hvlId
	 * @return Katz
	 */
	public function &setHvlId($hvlId) {
		$this->notifyChanged(self::FIELD_HVL_ID,$this->hvlId,$hvlId);
		$this->hvlId=$hvlId;
		return $this;
	}

	/**
	 * get value for hvl_id 
	 *
	 * type:INT,size:10,default:0,index
	 *
	 * @return mixed
	 */
	public function getHvlId() {
		return $this->hvlId;
	}

	/**
	 * set value for goedkeuring_inspectie 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @param mixed $goedkeuringInspectie
	 * @return Katz
	 */
	public function &setGoedkeuringInspectie($goedkeuringInspectie) {
		$this->notifyChanged(self::FIELD_GOEDKEURING_INSPECTIE,$this->goedkeuringInspectie,$goedkeuringInspectie);
		$this->goedkeuringInspectie=$goedkeuringInspectie;
		return $this;
	}

	/**
	 * get value for goedkeuring_inspectie 
	 *
	 * type:BIT,size:0,default:0
	 *
	 * @return mixed
	 */
	public function getGoedkeuringInspectie() {
		return $this->goedkeuringInspectie;
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
			self::FIELD_DD=>$this->getDd(),
			self::FIELD_MM=>$this->getMm(),
			self::FIELD_JJ=>$this->getJj(),
			self::FIELD_WASSEN=>$this->getWassen(),
			self::FIELD_KLEDEN=>$this->getKleden(),
			self::FIELD_VERPLA=>$this->getVerpla(),
			self::FIELD_TOILET=>$this->getToilet(),
			self::FIELD_CONTINENT=>$this->getContinent(),
			self::FIELD_ETEN=>$this->getEten(),
			self::FIELD_ORIENT=>$this->getOrient(),
			self::FIELD_RUST=>$this->getRust(),
			self::FIELD_WOON=>$this->getWoon(),
			self::FIELD_MANTEL=>$this->getMantel(),
			self::FIELD_SANITAIR=>$this->getSanitair(),
			self::FIELD_TOTAAL=>$this->getTotaal(),
			self::FIELD_HVL_ID=>$this->getHvlId(),
			self::FIELD_GOEDKEURING_INSPECTIE=>$this->getGoedkeuringInspectie());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Katz instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Katz $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Katz[]
	 */
	public static function findByExample(PDO $db,Katz $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Katz instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Katz[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `katz`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Katz instances
	 *
	 * @param PDOStatement $stmt
	 * @return Katz[]
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
	 * returns the result as an array of Katz instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Katz[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Katz();
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
	 * Execute select query and return matched rows as an array of Katz instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Katz[]
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
		$sql='DELETE FROM `katz`'
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
		$this->setDd($result['dd']);
		$this->setMm($result['mm']);
		$this->setJj($result['jj']);
		$this->setWassen($result['wassen']);
		$this->setKleden($result['kleden']);
		$this->setVerpla($result['verpla']);
		$this->setToilet($result['toilet']);
		$this->setContinent($result['continent']);
		$this->setEten($result['eten']);
		$this->setOrient($result['orient']);
		$this->setRust($result['rust']);
		$this->setWoon($result['woon']);
		$this->setMantel($result['mantel']);
		$this->setSanitair($result['sanitair']);
		$this->setTotaal($result['totaal']);
		$this->setHvlId($result['hvl_id']);
		$this->setGoedkeuringInspectie($result['goedkeuring_inspectie']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Katz
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
		$o=new Katz();
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
		$stmt->bindValue(2,$this->getDd());
		$stmt->bindValue(3,$this->getMm());
		$stmt->bindValue(4,$this->getJj());
		$stmt->bindValue(5,$this->getWassen());
		$stmt->bindValue(6,$this->getKleden());
		$stmt->bindValue(7,$this->getVerpla());
		$stmt->bindValue(8,$this->getToilet());
		$stmt->bindValue(9,$this->getContinent());
		$stmt->bindValue(10,$this->getEten());
		$stmt->bindValue(11,$this->getOrient());
		$stmt->bindValue(12,$this->getRust());
		$stmt->bindValue(13,$this->getWoon());
		$stmt->bindValue(14,$this->getMantel());
		$stmt->bindValue(15,$this->getSanitair());
		$stmt->bindValue(16,$this->getTotaal());
		$stmt->bindValue(17,$this->getHvlId());
		$stmt->bindValue(18,$this->getGoedkeuringInspectie());
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
			$stmt->bindValue(1,$this->getDd());
			$stmt->bindValue(2,$this->getMm());
			$stmt->bindValue(3,$this->getJj());
			$stmt->bindValue(4,$this->getWassen());
			$stmt->bindValue(5,$this->getKleden());
			$stmt->bindValue(6,$this->getVerpla());
			$stmt->bindValue(7,$this->getToilet());
			$stmt->bindValue(8,$this->getContinent());
			$stmt->bindValue(9,$this->getEten());
			$stmt->bindValue(10,$this->getOrient());
			$stmt->bindValue(11,$this->getRust());
			$stmt->bindValue(12,$this->getWoon());
			$stmt->bindValue(13,$this->getMantel());
			$stmt->bindValue(14,$this->getSanitair());
			$stmt->bindValue(15,$this->getTotaal());
			$stmt->bindValue(16,$this->getHvlId());
			$stmt->bindValue(17,$this->getGoedkeuringInspectie());
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
		$stmt->bindValue(19,$this->getId());
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
	 * Fetch Evaluatie's which this Katz references.
	 * `katz`.`id` -> `evaluatie`.`katz_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Evaluatie[]
	 */
	public function fetchEvaluatieCollection(PDO $db, $sort=null) {
		$filter=array(Evaluatie::FIELD_KATZ_ID=>$this->getId());
		return Evaluatie::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Overlegbasis's which this Katz references.
	 * `katz`.`id` -> `overlegbasis`.`katz_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Overlegbasis[]
	 */
	public function fetchOverlegbasisCollection(PDO $db, $sort=null) {
		$filter=array(Overlegbasis::FIELD_KATZ_ID=>$this->getId());
		return Overlegbasis::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Hulpverleners which references this Katz. Will return null in case reference is invalid.
	 * `katz`.`hvl_id` -> `hulpverleners`.`id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Hulpverleners
	 */
	public function fetchHulpverleners(PDO $db, $sort=null) {
		$filter=array(Hulpverleners::FIELD_ID=>$this->getHvlId());
		$result=Hulpverleners::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'Katz');
	}

	/**
	 * get single Katz instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Katz
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Katz();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Katz from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Katz[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Katz') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>