<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_OverlegForm {

    private $appobj = null;
    private $basisform = array("fname", "name", "email", "password");
    private $teamform = array("email", "password");
    private $paperform = array("");
    private $taskform = array("");
    private $formerror = 0;

    public function __CONSTRUCT() {
        $this->basisform = ECPFactory::getForm("basis");
        $this->basisform->addField(new ECP_FormObj_Radio("overleg_locatie_id",array("0"=>"Thuis bij pati&euml;nt,","1"=>"Elders."),true));
        $this->basisform->addField(new ECP_FormObj_Radio("aanwezig_patient", array("1"=>"Patient zelf,","2"=>"Vertegenwoordiger,","0"=>"Niemand aanwezig."),true));
        $this->basisform->addField(new ECP_FormObj_Radio("overleg_instemming", array("1"=>"Stemt in,","0"=>"Stemt niet in."), true));
        $this->basisform->addField(new ECP_FormObj_Button("Opslaan"));
    }
    
    public function getForm(){
        return $this->basisform;
    }
}