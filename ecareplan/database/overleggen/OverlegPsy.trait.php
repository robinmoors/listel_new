<?php
trait OverlegPsyTrait {
	private $id;
	private $overlegId;
	private $psyAlgemeen;
	private $psyDoelstellingen;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return Overlegpsy
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
	 * @return Overlegpsy
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
	 * set value for psy_algemeen 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $psyAlgemeen
	 * @return Overlegpsy
	 */
	public function &setPsyAlgemeen($psyAlgemeen) {
		$this->psyAlgemeen=$psyAlgemeen;
		return $this;
	}

	/**
	 * get value for psy_algemeen 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPsyAlgemeen() {
		return $this->psyAlgemeen;
	}

	/**
	 * set value for psy_doelstellingen 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @param mixed $psyDoelstellingen
	 * @return Overlegpsy
	 */
	public function &setPsyDoelstellingen($psyDoelstellingen) {
		$this->psyDoelstellingen=$psyDoelstellingen;
		return $this;
	}

	/**
	 * get value for psy_doelstellingen 
	 *
	 * type:TEXT,size:65535,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPsyDoelstellingen() {
		return $this->psyDoelstellingen;
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
			'psy_algemeen'=>$this->getPsyAlgemeen(),
			'psy_doelstellingen'=>$this->getPsyDoelstellingen());
	}
}
?>