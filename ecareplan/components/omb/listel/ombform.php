<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("ECP_AC") or die("Stop! Wat we onder de motorkap hebben zitten houden we liever verborgen.");

class ECP_Comp_OmbForm implements ECP_OverlegObservable{
    
    private $baseform;
    // Eerste tab "Melding"
    private $meldingform = null;
    private $melderhvlform = null;
    private $melderandersform = null;
    
    private $slachtofferform = null;
    private $plegerform = null;
    private $misbehandeling = null;
    private $hulp = null;
    private $mantelzorgersform = null;
    
    private $state = "unset";
    
    public function __construct() {
        $this->meldingform = ECPFactory::getForm("melding")
                ->addField(new ECP_FormObj_Date("datum")) 
                ->addField(new ECP_FormObj_Select("contactwijzelist"))
                ->addField(new ECP_FormObj_Checkbox("meldpunt"))
                ->addField(new ECP_FormObj_Radio("meldersoort",array(
                    "0"=>"hulpverlener",
                    "1"=>"slachtoffer zelf",
                    "2"=>"andere")));
        
        $this->melderhvlform = ECPFactory::getForm("meldingsoorthvl")
                ->addField(new ECP_FormObj_Hulpverlener("hulpverlener"));
        
        $this->melderandersform = ECPFactory::getForm("meldersoortanders")
                ->addField(new ECP_FormObj_Input("naam"))
                ->addField(new ECP_FormObj_Input("adres"))
                ->addField(new ECP_FormObj_Postcode("postcode"))
                ->addField(new ECP_FormObj_Telefoon("telefoon"))
                ->addField(new ECP_FormObj_Email("email"))
                ->addField(new ECP_FormObj_Select("relatielist"))
                ->addField(new ECP_FormObj_Input("detail"));

    }
    public function attach(\ECP_OverlegObserver $observer) {
        
    }

    public function detach(\ECP_OverlegObserver $observer) {
        
    }

    public function getObservers() {
        return $this->observers;
    }

    public function getState() {
        return $this->state;
    }

    public function notify() {
        foreach($this->observers as $obs){
            $obs->update($this);
        }
        return $this;
    }

    public function setState($state) {
        $old = $this->state;
        $this->state = "form.".$state;
        if($old !== $this->state) $this->notify(); //autonotify on statechange...
        return $this;
    }    
    
    public function updateContactwijzeList($contactwijze=array()){
        if(!is_array($contactwijze)) return null;
        else{
            $contactlist = array();
            for($i=0; $i<count($contactwijze); $i++){
                $contactlist[$contactwijze[$i]['id']] = $contactwijze[$i]['contactwijze'];
            }
            $this->meldingform->contactwijzelist->insertOptions($contactlist);
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
    
    public function updateHoofdrelatieList($relatie=array()){
        if(!is_array($relatie)) return null;
        else {
            $relatielist=array();
            for($i=0;$i<count($relatie);$i++){
                $relatielist[$relatie[$i]['id']] = $relatie[$i]['hoofdrelatie'];
            }
            $this->melderandersform->relatielist->insertOptions($relatielist);
        }
    }
    
    public function getForm($type){
        switch ($type) {
            case "melding":
                return array($this->meldingform,$this->melderhvlform,$this->melderandersform);
                break;
            case "slachtoffer":
                return null;
                break;
            case "pleger":
                return null;
                break;
            case "misbehandeling":
                return null;
                break;
            case "hulp":
                return null;
                break;
            case "mantelzorger":
                return null;
                break;
            default:
                return null;
        }
    }
}
?>
