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
        
        public function assignByHash($result){
            $this->setId($result['id']);
            $this->setOverlegId($result['overleg_id']);
            $this->setOmbFactuur($result['omb_factuur']);
            $this->setOmbActief($result['omb_actief']);
            $this->setOmbRangorde($result['omb_rangorde']);
        }
        
        public function getFieldNames(){
            return array(1=>'id',
                2=>'overleg_id',
                3=>'omb_factuur',
                4=>'omb_actief',
                5=>'omb_rangorde');
        }
        
        public function insertIntoDatabase(PDO $db){
            $overlegid  = $this->getOverlegId();
            $ombfactuur = $this->getOmbFactuur();
            $ombactief = $this->getOmbActief();
            $ombrangorde = $this->getOmbRangorde();
            
            $query = 'INSERT INTO `overlegomb`
                SET `id`= :id, `overleg_id`= :overleg_id, `omb_factuur`= :omb_factuur, `omb_actief`= :omb_actief, `omb_rangorde`= :omb_rangorde';
            
            try{
                $statement= $db->prepare($query);
                $statement->bindValue(':overleg_id',$overlegid);
                $statement->bindValue(':omb_factuur',$ombfactuur);
                $statement->bindValue(':omb_actief',$ombactief);
                $statement->bindValue(':omb_rangorde',$ombrangorde);
                $affected = $statement->execute();
                $statement->closeCursor();
            } catch (PDOException $e) {
                $error_messsage = $e->getMessage();
                //display
            }
            return $affected;
        }
        
        public function updateToDatabase(PDO $db){
            $id = $this->getId();
            $overlegid  = $this->getOverlegId();
            $ombfactuur = $this->getOmbFactuur();
            $ombactief = $this->getOmbActief();
            $ombrangorde = $this->getOmbRangorde();
            
            $query = 'UPDATE `overlegomb` 
                SET `overleg_id`= :overleg_id,`omb_factuur`= :omb_factuur,`omb_actief`= :omb_actief,`omb_rangorde`= :omb_rangorde 
                WHERE `id` = :id';
            
            try{
                $statement= $db->prepare($query);
                $statement->bindValue(':overleg_id',$overlegid);
                $statement->bindValue(':omb_factuur',$ombfactuur);
                $statement->bindValue(':omb_actief',$ombactief);
                $statement->bindValue(':omb_rangorde',$ombrangorde);
                $affected = $statement->execute();
                $statement->closeCursor();
            } catch (PDOException $e) {
                $error_messsage = $e->getMessage();
                //display
            }
        }
            
        public function deleteFromDatabase(PDO $db){
            $id = $this->getId();
            $query = 'DELETE FROM `overlegomb` 
            WHERE `id`= :id';
            try{
                $statement=$db->prepare($query);
                $statement->bindValue(':id',$id);
                $statement->execute();
                $valid = ($statement->rowCount() >=1);
                $statement->closeCursor();
            } catch (PDOException $e){
                $error_message = $e->getMessage();
                //display
            }
            return $valid;
        }
        
        public function findById(PDO $db){
            $id = $this->getId();
            $query = 'SELECT `id`, `overleg_id`, `omb_factuur`, `omb_actief`, `omb_rangorde` 
                FROM `overlegomb` 
                WHERE id= :id';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $id);
            $affected= $statement->execute();
            if (false===$affected) {
                    $statement->closeCursor();			
            }
            $result = $statement->fetch();
            $statement->closeCursor();
            if(!$result) {
                    return null;
            }
            return toArray($result);
        }
        
        public function findByOverleg(PDO $db){
            $overlegid = $this->getOverlegId();
            $query = 'SELECT `id`, `overleg_id`, `omb_factuur`, `omb_actief`, `omb_rangorde` 
                FROM `overlegomb` 
                WHERE overleg_id= :overleg_id';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':overleg_id', $overlegid);
            $statement->execute();
            
            $resultInstances=array();
            while($result=$statement->fetch(PDO::FETCH_ASSOC)) {
                $resultInstances[]=toArray($result);
            }
            $statement->closeCursor();
            return $resultInstances;
        }
        
}
?>