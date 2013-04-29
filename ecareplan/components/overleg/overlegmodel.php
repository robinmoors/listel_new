<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_OverlegModel {

    protected $uid = 0;
    protected static $db; //db is een static object (zie factory)
    
    //data
    private static $organisations = null;

    public function __CONSTRUCT($uid) {
        $this->uid = $uid;
    }

    public function getPatientsWithOverleg($limit = 30, $from = 0, $to = 30){
        $user = ECPFactory::getUser($this->uid);
        //haal patienten op die een overleg hebben (fetchAanvraagOverlegCollection)
        self::$db = ECPFactory::getPDO("overlegbasis");
        $overleg = new Overlegbasis();
        //zie dat die overleggen nog open staan (=niet afgerond)
        $overleg->setAfgerond(0);
        
        //filter de patienten zodat enkel de patienten waarvoor user bevoegd is zichtbaar zijn
            //OCMW -> alle patienten uit zelfde gemeente
            //rdc & admin -> alle patienten?
            //psy -> enkel psy patienten
            //De userklasse zal dit voor ons doen :) (filterPatients)
        ecpimport("database.patient","class");
        $results = $user->filterPatients($overleg->fetchPatient(self::$db));
        print_r($results);
        //$patients = $this->db->newQuery("select","patients")->table("patient INNER JOIN overleg ON patient.code = overleg.patient_code INNER JOIN aanvraag_overleg ON overleg.id = aanvraag_overleg.overleg_id")->where("gem_id",$user->gem_id,"=")->limit($to,$from)->execute();
        return self::resultToArray($results,Patient::getFieldNames());
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
    
    public function getPatientToewijzing($id){
        $patient = self::startPatient();
        $patient->setId($id);
        $result = Patient::findByExample(self::$db, $patient);
        if(count($result)<1) return 0;
        else{
            $pat = $result[0];
            switch($pat->getToegewezenGenre()){
                case "gemeente": return 1; break;
                case "rdc": case "psy":
                    ecpimport("database.organisatie","class");
                    $org = new Organisatie();
                    $org->setId($pat->getToegewezenId());
                    $coresult = Organisatie::findByExample(self::$db, $org);
                    if(count($coresult)<1) return null;
                    else return $coresult[0]->getNaam(); 
                    break;
                default:
                    ecpimport("database.hulpverleners","class");
                    $hulp = new Hulpverleners();
                    $hulp->setId($pat->getToegewezenId());
                    $huresult = Hulpverleners::findByExample(self::$db, $hulp);
                    if(count($huresult)<1) return null;
                    else return $huresult[0]->getNaam();
                    break;
            }
        }
    }
    
    public function getRDC(){
        $result = self::getOrganisations();
        //hier gaan filteren op RDC!
        return self::resultToArray($result, Organisatie::getFieldNames());
    }
    
    public function getZA(){
        $result = self::getOrganisations();
        //hier gaan filteren op ZA!!
        return self::resultToArray($result, Organisatie::getFieldNames());
    }
    
    public function getPSY(){
        $result = self::getOrganisations();
        //hier gaan filteren op PSY!!
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
    
    /**
     * Get PDO object from factory and create Patient object, return the last one.
     * @return \Patient
     */
    private static function startPatient(){
        self::$db = ECPFactory::getPDO("patient");
        return new Patient();
    }
    
     public static function getOrganisations(){
        if(self::$organisations === null){
            self::$db = ECPFactory::getPDO("organisatie");
            $org = new Organisatie();
            $org->setActief(1);
            self::$organisations = Organisatie::findByExample(self::$db, $org);
        }
        return self::$organisations;
    }

}

?>
