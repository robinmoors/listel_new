<?php
trait OverlegExtendedTrait {
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
	 * return array with the field id as index and the field value as value.
	 *
	 * @return array
	 */
	public function toArray() {
		return array(
			'id'=>$this->getId(),
			'overleg_id'=>$this->getOverlegId(),
			'locatieTekst'=>$this->getLocatieTekst(),
			'tijdstip'=>$this->getTijdstip(),
			'akkoord_patient'=>$this->getAkkoordPatient(),
			'aanwezig_patient'=>$this->getAanwezigPatient(),
			'vertegenwoordiger'=>$this->getVertegenwoordiger(),
			'eval_nieuw'=>$this->getEvalNieuw(),
			'afronddatum'=>$this->getAfronddatum(),
			'volgende_datum'=>$this->getVolgendeDatum(),
			'verklaring_huisarts'=>$this->getVerklaringHuisarts(),
			'ambulant'=>$this->getAmbulant(),
			'huisarts_belangrijk'=>$this->getHuisartsBelangrijk());
	}
}
?>