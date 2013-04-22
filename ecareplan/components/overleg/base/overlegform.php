<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_OverlegForm {

    private $appobj = null;
    private $selectform = array("patient");
    private $orgform = array("fname", "name", "email", "password");
    private $teamform = array("email", "password");
    private $paperform = array("");
    private $taskform = array("");
    private $formerror = 0;

    public function __CONSTRUCT() {
        $this->selectform = ECPFactory::getForm("patient_select")->addField(new ECP_FormObj_Select("patientlist"),array(),true)->addField(new ECP_FormObj_Button("Verder"));
        $this->orgform = ECPFactory::getForm("organisator_select");
        $this->orgform->addField(new ECP_FormObj_Radio("organisator",array("0"=>"Het plaatselijk OCMW,","1"=>"Het regionaal dientstencentrum","2"=>"Zorgverlener"),true));
    }
    
    public function getForm($type){
        switch($type){
            case "edit": return $this->basisform;
                break;
            case "new": return array($this->orgform);
                break;
            case "select": return $this->selectform;
                break;
            default: return null;
        }
    }
    
    public function updatePatientList($patients){
        $patientsnames = array();
        for($i=0; $i<count($patients); $i++){
            $patientsnames[$patients[$i]['id']]= $patients[$i]['naam']." ".$patients[$i]['voornaam'];
        }
        $this->selectform->patientlist->insertOptions($patientsnames);
    }
}