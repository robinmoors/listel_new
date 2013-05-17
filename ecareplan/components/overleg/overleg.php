<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of overleg
 *
 * @author robindell
 */
class ECP_Comp_Overleg_Controller implements ECP_ComponentController {

    protected $action = null;
    protected $vars = null;
    protected $model = null;
    protected $view = null;
    protected $app = null;
    protected $user = null;

    public function __CONSTRUCT() {
        ecpimport("components.overleg.overlegobserver"); //observer interface
        ecpimport("components.overleg.overlegobservable"); //observable (subject) interface
        ecpimport("components.overleg.overlegmodel"); //std model
        ecpimport("components.overleg.overlegview"); //std view
        $this->action = "std_command";
        $this->app = ECPFactory::getApp(); //haal de app op om template te gaan veranderen
        $this->user = $this->app->getUser(); //via de app de user ophalen zodat we zeker de huidige user hebben :)
        $this->model = new ECP_Comp_OverlegModel($this->user->getUserId());
        $this->view = new ECP_Comp_OverlegView($this->app);
    }

    public function command($command) {
        if ($command == "command" || !is_callable(array(&$this, $command))) {
            $command = "command_error";
        }
        $this->action = $command;
    }

    public function command_error() {
        $this->std_command();
    }

    public function execute() {
        call_user_func(array(&$this, $this->action));
    }

    public function params($vars) {
        $this->vars = $vars;
    }

    public function lijst() {
        $this->std_command();
    }

    public function std_command() {
        //we tonen de overleg aanvragen zodat we die kunnen starten :)
        $aanvragen = $this->model->getOverlegAanvragen();
        $this->view->viewList($aanvragen);
    }

    public function bewerk() {
        if (!is_null($this->vars[0])) {
            ecpimport("components.overleg.base.overlegform");
            $formmodel = new ECP_Comp_OverlegForm();
            if (!is_null($this->vars[1])) {
                //er is ook een overlegid opgegeven...
                $overleg = $this->model->getOverlegById($this->vars[1]);
                $this->view->editOverleg($overleg, $formmodel->getForm("edit"));
            } else {
                $patient = $this->model->getOverleg($this->vars[0]);
                if (count($patient) > 1) { //meer dan 1 overleg gevonden dus daar uit kiezen...
                    $this->view->viewOverlegList($patient);
                }
                else
                    $this->view->editOverleg($patient, $formmodel->getForm("edit")); //maar 1 overleg dus dat ook bewerken...
            }
        }else {
            $this->std_command();
        }
    }

    public function nieuw() {
        ecpimport("components.overleg.base.overlegform");
        $formmodel = new ECP_Comp_OverlegForm();
        if($_SERVER['REQUEST_METHOD']!="POST"){
            if (!is_null($this->vars[0])) { //patientnummer opgeven
                $pat_id = $this->vars[0];
                //patient met overleggen ophalen
                $patient = $this->model->getOverlegByPatientId($pat_id);
                if ($patient == null) {
                    //patient had geen overleggen... Dan maar alleen patient opgeven
                    $patient = $this->model->getPatientById($pat_id);
                }
                //de toegewezen OC ophalen en bij data patient steken...
                $patient['toegewezen'] = $this->model->getPatientToewijzing($pat_id);
                //regionaal dienstencentra ophalen (RDC)
                $formmodel->updateRDCList($this->model->getRDC());
                //zorgaanbieders ophalen (ZA)
                $formmodel->updateZAList($this->model->getZA());
                //zorgaanbieders profiel PSY ophalen
                $formmodel->updatePSYList($this->model->getPSY());
                $this->view->newOverleg($patient, $pat_id, $formmodel->getForm("new"));
            } else {
                $patienten = $this->model->getAllPatients();
                $formmodel->updatePatientList($patienten);
                $this->view->selectPatient($patienten, $formmodel->getForm("select"));
            }
        }else{
            //we zouden nu data hebben mee gekregen :)
            if(array_key_exists("values", $_POST) && array_key_exists("patid", $_POST)){
                $session = ECPFactory::getSession();
                if($session->isActive()){
                    //hier normaal controle op loginpin
                    $patient = $this->model->getOverlegByPatientId($_POST['patid']);
                    if ($patient == null) {
                        //patient had geen overleggen... Dan maar alleen patient opgeven
                        $patient = $this->model->getPatientById($_POST['patid']);
                    }
                    if($patient == null) {
                        ecpexit('{"succes":"negative","message":"Oei het loopt even mis!<br/>De server kon de patient niet vinden..."}');
                    }
                    //regionaal dienstencentra ophalen (RDC)
                    $formmodel->updateRDCList($this->model->getRDC());
                    //zorgaanbieders ophalen (ZA)
                    $formmodel->updateZAList($this->model->getZA());
                    //zorgaanbieders profiel PSY ophalen
                    $formmodel->updatePSYList($this->model->getPSY());
                    //data insteken
                    $values = json_decode($_POST['values'],true); //json string naar assoc array parsen..
                    $report = $formmodel->validateValuesNewOverleg($values);
                    if($report===0){
                        ecpexit('{"succes":"negative","message":"Oei het loopt even mis!<br/>De server kon niets opmaken uit de gestuurde waarden..."}');
                    }
                    //en dan nu valideren :)
                        //print_r($report);
                    $error = $formmodel->validateNewOverleg($report);
                        //print_r($error);
                    if($this->model->setAanvraag($_POST['patid'],$values)){
                        ecpexit('{"succes":"positive","message":"Het overleg werd aangevraagd!<br/>Het systeem keert terug naar de overleglijst..."}');
                    }else{
                        ecpexit('{"succes":"negative","message":"Oei het loopt even mis!<br/>Onze database kon de aanvraag niet verwerken.<br/>Probeer opnieuw of neem contact op met de beheerder."}');
                    }
                }else{
                    echo $session->getState();
                }
            }else {
                echo '{"succes":"negative","message":"Oei het loopt even mis!<br/>De server ontving geen waarden van het formulier..."}';
                ecpexit();
            }
        }
    }

}

?>
