<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_OverlegForm implements ECP_OverlegObservable{

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
    //Begin Observer pattern (Subject)
    public function attach(ECP_OverlegObserver $obs){
        $this->observer["$obs"] = $obs;
    }
    public function detach(ECP_OverlegObserver $obs){
        delete($this->observers["$obs"]);
    }
    public function notify($message){
        foreach($this->observers as $obs){
            $obs->update($this,$message);
        }
    }
    //End Observer pattern (Subject
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