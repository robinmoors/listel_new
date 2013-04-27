<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_OverlegModel {

    protected $uid = 0;
    protected static $db; //db is een static object (zie factory)

    public function __CONSTRUCT($uid) {
        $this->uid = $uid;
    }

    public function getPatients($limit = 30, $from = 0, $to = 30){
        $user = ECPFactory::getUser($this->uid);
        $db = ECPFactory::getPDO("Patient");
        $patient = new Patient();
        //$patients = $this->db->newQuery("select","patients")->table("patient INNER JOIN overleg ON patient.code = overleg.patient_code INNER JOIN aanvraag_overleg ON overleg.id = aanvraag_overleg.overleg_id")->where("gem_id",$user->gem_id,"=")->limit($to,$from)->execute();
        return self::queryToArray($patients);
    }
    
    public function getAllPatients($limit = 30, $from=0, $to=30){
        $user = ECPFactory::getUser($this->uid);
        $patient = self::startPatient();
        $patient->setGemId($user->gem_id);
        $result = Patient::findByExample(self::$db, $patient);
        return self::resultToArray($result,Patient::getFieldNames());
    }
    
    public function getOverlegByPatientId($pat_id){
       // $pat = $this->db->newQuery("select","patient")->table("patient INNER JOIN overleg ON patient.code = overleg.patient_code INNER JOIN aanvraag_overleg ON overleg.id = aanvraag_overleg.overleg_id")->where("patient.id",$pat_id,"=")->execute();
       //  return self::queryToArray($pat);
        return null;
    }
    
    public function getPatientById($id){
        $patient = self::startPatient();
        $patient->setId($id);
        $result = Patient::findByExample(self::$db, $patient);
        return self::resultToArray($result, Patient::getFieldNames());
    }
    
    public function getRDC(){
        self::$db = ECPFactory::getPDO("Organisatie");
        $org = new Organisatie();
        ecpimport("database.Logins","class"); //om te fetchen met logins moeten we logins includen!
        $result = $org->fetchLoginsCollection(self::$db);
        return self::resultToArray($result, Organisatie::getFieldNames());
    }
    
    public function getZA(){
        self::$db = ECPFactory::getPDO("Organsatie");
        $org = new Organisatie();
        ecpimport("database.Hulpverleners","class");
        $result = $org->fetchHulpverlenersCollection(self::$db);
        return self::resultToArray($result, Organisatie::getFieldNames());
    }
    
    public function getPSY(){
        self::$db = ECPFactory::getPDO("Organisatie");
        $org = new Organisatie();
        ecpimport("database.Logins","class"); //om te fetchen met logins moeten we logins includen!
        $result = $org->fetchLoginsCollection(self::$db);
        return self::resultToArray($result, Organisatie::getFieldNames());
    }
    
    public function getOverleg($patientid=null){
        if($patientid==null){
            return null; //geen patient opgegeven
        }else{
            $patient = $this->db->newQuery("select","patient")->table("patient INNER JOIN overleg ON patient.code = overleg.patient_code INNER JOIN aanvraag_overleg ON overleg.id = aanvraag_overleg.overleg_id")->where("patient.id",$patientid,"=")->execute();
            if($patient->getRows()<1){
                return false; //geen patient gevonden met deze id :s
            }else{
                return self::queryToArray($patient);
            }
        }
    }
    
    public function getOverlegById($overlegid=null){
        if($overlegid==null){
            return null; //geen patient opgegeven
        }else{
            $overleg = $this->db->newQuery("select","overleg")->table("patient p INNER JOIN overleg o ON p.code = o.patient_code INNER JOIN aanvraag_overleg a ON o.id = a.overleg_id")->where("o.id",$overlegid,"=")->execute();
            if($overleg->getRows()<1){
                return false; //geen patient gevonden met deze id :s
            }else{
                return self::queryToArray($overleg);
            }
        }
    }
    
    private static function queryToArray($mysqlresult){
         for($i=0; $i<$mysqlresult->getRows(); $i++){
            $data[$i] = $mysqlresult->nextResult()->get();
        }
        return $data;
    }
    
    private static function resultToArray($result,$names){
        if(!is_array($names) || $result==null) return null;
        foreach($result as $resource){//array van objecten dus een object nemen..
            $res=$resource->toArray();//dat object omzetten naar array
            foreach($res as $key => $value){
                $ar[$names[$key]] = $value; //hier gebeurd de key-wissel..
            }
            $data[] = $ar; //alles netjes terug in een array zetten :)
        }
        return $data;
    }
    
    private static function startPatient(){
        self::$db = ECPFactory::getPDO("patient");
        return new Patient();
    }

}

?>
