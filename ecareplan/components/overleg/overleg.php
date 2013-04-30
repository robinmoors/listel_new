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
        $patienten = $this->model->getPatientsWithOverleg("overleg");
        $this->view->viewList($patienten);
    }

    public function bewerk() {
        if (!is_null($this->vars[1])) {
            ecpimport("components.overleg.base.overlegform");
            $formmodel = new ECP_Comp_OverlegForm();
            if (!is_null($this->vars[2])) {
                //er is ook een overlegid opgegeven...
                $overleg = $this->model->getOverlegById($this->vars[2]);
                $this->view->editOverleg($overleg, $formmodel->getForm("edit"));
            } else {
                $patient = $this->model->getOverleg($this->vars[1]);
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
            if (!is_null($this->vars[1]) && !is_null($this->vars[2])) { //patientnummer opgeven en daarna de stap van het formulier...
                $pat_id = $this->vars[1];
                $step = $this->vars[2];
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
                $this->view->newOverleg($step, $patient, $formmodel->getForm("new"));
            } else {
                $patienten = $this->model->getAllPatients();
                $formmodel->updatePatientList($patienten);
                $this->view->selectPatient($patienten, $formmodel->getForm("select"));
            }
        }else{
            json_decode($_POST);
            ecpexit();
        }
    }

}

?>
