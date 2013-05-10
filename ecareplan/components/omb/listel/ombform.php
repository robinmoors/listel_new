<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_OmbForm implements ECP_OverlegObservable{
    
    private $baseform;
    
    public function __construct() {
        $this->baseform = ECPFactory::getForm("base")->addField(new ECP_FormObj_Select("contactwijze"));
        $this->baseform = ECPFactory::getForm("base")->addField(new ECP_FormObj_Select("probleemfactor"));
        $this->baseform = ECPFactory::getForm("base")->addField(new ECP_FormObj_Input("dag", 1, 2));
        $this->baseform = ECPFactory::getForm("base")->addField(new ECP_FormObj_Button("validate"));
        $this->baseform = ECPFactory::getForm("base")->addField(new ECP_FormObj_Day("dag"));
    }
    public function attach(\ECP_OverlegObserver $observer) {
        
    }

    public function detach(\ECP_OverlegObserver $observer) {
        
    }

    public function getObservers() {
        
    }

    public function getState() {
        
    }

    public function notify() {
        
    }

    public function setState($state) {
        
    }    
    
    public function updateContactwijzeList($contactwijze=array()){
        if(!is_array($contactwijze)) return null;
        else{
            $contactlist = array();
            for($i=0; $i<count($contactwijze); $i++){
                $contactlist[$contactwijze[$i]['id']] = $contactwijze[$i]['contactwijze'];
            }
            $this->baseform->contactwijze->insertOptions($contactlist);
        }
    }
    
    public function updateProbleemfactorList($probleem=array()){
        if(!is_array($probleem)) return null;
        else {
            $probleemlist=array();
            for($i=0;$i<count($probleem);$i++){
                $probleemlist[$probleem[$i]['id']] = $probleem[$i]['probleemfactor'];
            }
            $this->baseform->probleemfactor->insertOptions($probleemlist);
        }
    }
    
    public function getBaseForm(){
        return $this->baseform;
    }
    
}
?>
