<?php
trait OverlegOrgTrait {
	private $id;
	private $overlegId;
	private $organisatieFactuur;
	private $organisatieFactuurDatum;
	private $organisatieDubbel;

	/**
	 * set value for id 
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $id
	 * @return Overlegorg
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
	 * @return Overlegorg
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
	 * set value for organisatie_factuur 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $organisatieFactuur
	 * @return Overlegorg
	 */
	public function &setOrganisatieFactuur($organisatieFactuur) {
		$this->organisatieFactuur=$organisatieFactuur;
		return $this;
	}

	/**
	 * get value for organisatie_factuur 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOrganisatieFactuur() {
		return $this->organisatieFactuur;
	}

	/**
	 * set value for organisatie_factuur_datum 
	 *
	 * type:VARCHAR,size:12,default:null,nullable
	 *
	 * @param mixed $organisatieFactuurDatum
	 * @return Overlegorg
	 */
	public function &setOrganisatieFactuurDatum($organisatieFactuurDatum) {
		$this->organisatieFactuurDatum=$organisatieFactuurDatum;
		return $this;
	}

	/**
	 * get value for organisatie_factuur_datum 
	 *
	 * type:VARCHAR,size:12,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOrganisatieFactuurDatum() {
		return $this->organisatieFactuurDatum;
	}

	/**
	 * set value for organisatie_dubbel 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $organisatieDubbel
	 * @return Overlegorg
	 */
	public function &setOrganisatieDubbel($organisatieDubbel) {
		$this->organisatieDubbel=$organisatieDubbel;
		return $this;
	}

	/**
	 * get value for organisatie_dubbel 
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOrganisatieDubbel() {
		return $this->organisatieDubbel;
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
			'organisatie_factuur'=>$this->getOrganisatieFactuur(),
			'organisatie_factuur_datum'=>$this->getOrganisatieFactuurDatum(),
			'organisatie_dubbel'=>$this->getOrganisatieDubbel());
	}
}
?>