<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_OverlegForm implements ECP_OverlegObservable{

    private $appobj = null;
    private $selectform = null;
    private $orgform = null;
    private $rdcform = null; //selectie RDC stap 2
    private $rdcwhyform = null; //selectie reden RDC stap 2
    private $zaform = null; //selectie zorgaanbieder stap 2
    private $zawhyform = null; //selectie reden ZA stap 2
    private $psyform = null; //selectie PSY stap 2
    private $psywhyform = null; //selectie reden PSY stap 2
    
    
    private $purposeform = null; //stap 3 = het doel kiezen
    
    private $requestorform =  null; //stap 4 = info aanvrager
    
    private $formerror = 0;
    
    private $observers = array();
    private $state = "unset";

    public function __CONSTRUCT() {
        $this->selectform = ECPFactory::getForm("patient_select")->addField(new ECP_FormObj_Select("patientlist"),array(),true)->addField(new ECP_FormObj_Button("Verder"));
        $this->orgform = ECPFactory::getForm("organisator_select");
        $this->orgform->addField(new ECP_FormObj_Radio("organisator",array("0"=>"Het plaatselijk OCMW,","1"=>"Het regionaal dientstencentrum","2"=>"Zorgverlener"),true));
        $this->rdcform = ECPFactory::getForm("rdc_select")->addField(new ECP_FormObj_Select("rdclist",array(),true));
        $this->rdcwhyform = ECPFactory::getForm("rdc_why")->addField(new ECP_FormObj_Radio("rdcwhy",array(
            "0"=>"De pati&euml;nt heeft het expliciet gevraagd.",
            "1"=>"Het OCMW kan dit overleg niet binnen 30 dagen organiseren.",
            "2"=>"Er zijn andere redenen (vul vak reden in).")
                ,true));
        $this->zaform = ECPFactory::getForm("za_select")->addField(new ECP_FormObj_Select("zalist",array(),true));
        $this->zawhyform = ECPFactory::getForm("za_why")->addField(new ECP_FormObj_Radio("zawhy",array(
            "0"=>"zij al betrokken is in de zorg.",
            "2"=>"Er zijn andere redenen (vul vak reden in).")
                ,true));
        $this->psyform = ECPFactory::getForm("psy_select")->addField(new ECP_FormObj_Select("psylist",array(),true));
        $this->psywhyform = ECPFactory::getForm("psy_why")->addField(new ECP_FormObj_Radio("psywhy",array(
            "0"=>"zij al betrokken is in de zorg.",
            "2"=>"Er zijn andere redenen (vul vak reden in).")
                ,true));
        //stap 3
        $this->purposeform = ECPFactory::getForm("purpose");
        //stap 4
        $this->requestorform = ECPFactory::getForm("requestor")->addField(new ECP_FormObj_Input("naam", 3, 100))->addField(new ECP_FormObj_Select("relatie", array(), true));
        $this->requestorform->addField(new ECP_FormObj_Input("telefoon",9,12))->addField(new ECP_FormObj_Email("email"))->addField(new ECP_FormObj_Input("organisatie", 3, 100));
    }
    //Begin Observer pattern (Subject)
    public function attach(ECP_OverlegObserver $obs){
        $i = array_search($obs, $this->observer);
        if($i===false){
            $this->observers[]=$obs;
        }
        return $this;
    }
    public function detach(ECP_OverlegObserver $obs){
        if(!empty($this->observers)){
            $i = array_search($obs, $this->observers);
            if($i !== false){
                delete($this->observers[$i]);
            }
        }
        return $this;
    }
    public function notify(){
        foreach($this->observers as $obs){
            $obs->update($this);
        }
        return $this;
    }
    public function getObservers() {
        return $this->observers;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $old = $this->state;
        $this->state = $state;
        if($old !== $this->state) $this->notify(); //autonotify on statechange...
        return $this;
    }
    //End Observer pattern (Subject
    public function getForm($type){
        switch($type){
            case "edit": return $this->basisform;
                break;
            case "new": return array($this->orgform,$this->rdcform,$this->rdcwhyform,
                $this->zaform,$this->zawhyform,$this->psyform,$this->psywhyform,
                $this->purposeform,$this->requestorform);
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
    
    public function updateRDCList($rdc){
        $rdclist = array();
        for($i=0; $i<count($rdc); $i++){
            $rdclist[$rdc[$i]['id']]= $rdc[$i]['naam'];
        }
        $this->rdcform->rdclist->insertOptions($rdclist);
    }
    
    public function updateZAList($za){
        $zalist = array();
        for($i=0; $i<count($za); $i++){
            $zalist[$za[$i]['id']]= $za[$i]['naam'];
        }
        $this->zaform->zalist->insertOptions($zalist);
    }
    
    public function updatePSYList($psy){
        $psylist = array();
        for($i=0; $i<count($psy); $i++){
            $psylist[$psy[$i]['id']]= $psy[$i]['naam'];
        }
        $this->psyform->psylist->insertOptions($psylist);
    }

}