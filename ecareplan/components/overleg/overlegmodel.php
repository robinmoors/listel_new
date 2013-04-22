<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_OverlegModel {

    protected $db = null;
    protected $uid = 0;

    public function __CONSTRUCT($uid) {
        $this->uid = $uid;
        $this->db = ECPFactory::getDbo();
    }

    public function getPatients($limit = 30, $from = 0, $to = 30){
        $user = ECPFactory::getUser($this->uid);
        $patients = $this->db->newQuery("select","patients")->table("patient INNER JOIN overleg ON patient.code = overleg.patient_code")->where("gem_id",$user->gem_id,"=")->limit($to,$from)->execute();
        return self::queryToArray($patients);
    }
    
    public function getAllPatients($limit = 30, $from=0, $to=30){
        $user = ECPFactory::getUser($this->uid);
        $patients = $this->db->newQuery("select","patients")->table("patient")->where("gem_id",$user->gem_id,"=")->limit($to,$from)->execute();
        return self::queryToArray($patients);
    }
    
    public function getOverlegByPatientId($pat_id){
        $pat = $this->db->newQuery("select","patient")->table("patient INNER JOIN overleg ON patient.code = overleg.patient_code")->where("patient.id",$pat_id,"=")->execute();
        return self::queryToArray($pat);
    }
    
    public function getPatientById($pat_id){
        $pat = $this->db->newQuery("select","patient")->table("patient")->where("id",$pat_id,"=")->execute();
        return self::queryToArray($pat);
    }
    
    public function getOverleg($patientid=null){
        if($patientid==null){
            return null; //geen patient opgegeven
        }else{
            $patient = $this->db->newQuery("select","patient")->table("patient INNER JOIN overleg ON patient.code = overleg.patient_code")->where("patient.id",$patientid,"=")->execute();
            if($patient->getRows()!=1){
                return null; //geen patient gevonden met deze id of meerdere :s
            }else{
                return self::queryToArray($patient);
            }
        }
    }
    
    private static function queryToArray($mysqlresult){
         for($i=0; $i<$mysqlresult->getRows(); $i++){
            $data[$i] = $mysqlresult->nextResult()->get();
        }
        return $data;
    }
    

}

?>
