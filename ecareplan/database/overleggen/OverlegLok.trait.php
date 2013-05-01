<?php
trait OverlegLokTrait {
	private $id;
	private $overlegId;
	private $lokaalAlgemeen;
	private $lokaalDoelstellingen;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return Overleglok
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
	 * @return Overleglok
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
	 * set value for lokaal_algemeen 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $lokaalAlgemeen
	 * @return Overleglok
	 */
	public function &setLokaalAlgemeen($lokaalAlgemeen) {
		$this->lokaalAlgemeen=$lokaalAlgemeen;
		return $this;
	}

	/**
	 * get value for lokaal_algemeen 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getLokaalAlgemeen() {
		return $this->lokaalAlgemeen;
	}

	/**
	 * set value for lokaal_doelstellingen 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $lokaalDoelstellingen
	 * @return Overleglok
	 */
	public function &setLokaalDoelstellingen($lokaalDoelstellingen) {
		$this->lokaalDoelstellingen=$lokaalDoelstellingen;
		return $this;
	}

	/**
	 * get value for lokaal_doelstellingen 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getLokaalDoelstellingen() {
		return $this->lokaalDoelstellingen;
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
			'lokaal_algemeen'=>$this->getLokaalAlgemeen(),
			'lokaal_doelstellingen'=>$this->getLokaalDoelstellingen());
	}
}
?>