<?php
trait OverlegOmbTrait {
	private $id;
	private $overlegId;
	private $ombFactuur;
	private $ombActief;
	private $ombRangorde;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return Overlegomb
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
	 * @return Overlegomb
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
	 * set value for omb_factuur 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @param mixed $ombFactuur
	 * @return Overlegomb
	 */
	public function &setOmbFactuur($ombFactuur) {
		$this->ombFactuur=$ombFactuur;
		return $this;
	}

	/**
	 * get value for omb_factuur 
	 *
	 * type:VARCHAR,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOmbFactuur() {
		return $this->ombFactuur;
	}

	/**
	 * set value for omb_actief 
	 *
	 * type:INT,size:10,default:0,nullable
	 *
	 * @param mixed $ombActief
	 * @return Overlegomb
	 */
	public function &setOmbActief($ombActief) {
		$this->ombActief=$ombActief;
		return $this;
	}

	/**
	 * get value for omb_actief 
	 *
	 * type:INT,size:10,default:0,nullable
	 *
	 * @return mixed
	 */
	public function getOmbActief() {
		return $this->ombActief;
	}

	/**
	 * set value for omb_rangorde 
	 *
	 * type:INT,size:10,default:0,nullable
	 *
	 * @param mixed $ombRangorde
	 * @return Overlegomb
	 */
	public function &setOmbRangorde($ombRangorde) {
		$this->ombRangorde=$ombRangorde;
		return $this;
	}

	/**
	 * get value for omb_rangorde 
	 *
	 * type:INT,size:10,default:0,nullable
	 *
	 * @return mixed
	 */
	public function getOmbRangorde() {
		return $this->ombRangorde;
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
			'omb_factuur'=>$this->getOmbFactuur(),
			'omb_actief'=>$this->getOmbActief(),
			'omb_rangorde'=>$this->getOmbRangorde());
	}
}
?>