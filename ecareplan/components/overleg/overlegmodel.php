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
    
    public function getRDC(){
        $rdc = $this->db->newQuery("select","rdc")->table("organisatie inner join logins")->rows("distinct organisatie.naam,organisatie.id")->where("organisatie.id = logins.organisatie AND organisatie.actief = 1 AND logins.actief = 1 AND logins.profiel","rdc","=")->execute();
        return self::queryToArray($rdc);
    }
    
    public function getZA(){
        $za = $this->db->newQuery("select","za")->table("organisatie o inner join hulpverleners h")->rows("distinct o.naam, o.id")->where("o.id = h.organisatie and h.is_organisator = 1 and o.actief = 1 and h.actief",1,"=")->execute();
        return self::queryToArray($za);
    }
    
    public function getPSY(){
        $psy = $this->db->newQuery("select","psy")->table("organisatie o inner join logins l")->rows("distinct o.naam, o.id")->where("o.id = l.organisatie and l.actief = 1 and o.actief = 1 and l.profiel","psy","=")->execute();
        return self::queryToArray($psy);
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
