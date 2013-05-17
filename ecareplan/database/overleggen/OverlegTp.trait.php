<?php
trait OverlegTpTrait {
	private $id;
	private $overlegId;
	private $tpVerslag;
	private $tpAuteur;
	private $tpNieuwepartners;
	private $tpRechtenoc;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return Overlegtp
	 */
	public function &setId($id) {
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
	 * @return Overlegtp
	 */
	public function &setOverlegId($overlegId) {
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
	 * set value for tp_verslag 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $tpVerslag
	 * @return Overlegtp
	 */
	public function &setTpVerslag($tpVerslag) {
		$this->tpVerslag=$tpVerslag;
		return $this;
	}

	/**
	 * get value for tp_verslag 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTpVerslag() {
		return $this->tpVerslag;
	}

	/**
	 * set value for tp_auteur 
	 *
	 * type:ENUM,size:3,default:null,nullable
	 *
	 * @param mixed $tpAuteur
	 * @return Overlegtp
	 */
	public function &setTpAuteur($tpAuteur) {
		$this->tpAuteur=$tpAuteur;
		return $this;
	}

	/**
	 * get value for tp_auteur 
	 *
	 * type:ENUM,size:3,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTpAuteur() {
		return $this->tpAuteur;
	}

	/**
	 * set value for tp_nieuwepartners 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $tpNieuwepartners
	 * @return Overlegtp
	 */
	public function &setTpNieuwepartners($tpNieuwepartners) {
		$this->tpNieuwepartners=$tpNieuwepartners;
		return $this;
	}

	/**
	 * get value for tp_nieuwepartners 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTpNieuwepartners() {
		return $this->tpNieuwepartners;
	}

	/**
	 * set value for tp_rechtenOC 
	 *
	 * type:TINYINT,size:3,default:1,nullable
	 *
	 * @param mixed $tpRechtenoc
	 * @return Overlegtp
	 */
	public function &setTpRechtenoc($tpRechtenoc) {
		$this->tpRechtenoc=$tpRechtenoc;
		return $this;
	}

	/**
	 * get value for tp_rechtenOC 
	 *
	 * type:TINYINT,size:3,default:1,nullable
	 *
	 * @return mixed
	 */
	public function getTpRechtenoc() {
		return $this->tpRechtenoc;
	}

	/**
	 * return array with the field id as index and the field value as value.
	 *
	 * @return array
	 */
	public function toArray() {
		return array(
			'id'=>$this->getId(),
			'overleg_id'=>$this->getOverlegId(),
			'tp_verslag'=>$this->getTpVerslag(),
			'tp_auteur'=>$this->getTpAuteur(),
			'tp_nieuwepartners'=>$this->getTpNieuwepartners(),
			'tp_rechtenOC'=>$this->getTpRechtenoc());
	}
}
?>