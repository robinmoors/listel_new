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
class ECP_Comp_Omb_Controller implements ECP_ComponentController {

    protected $action = null;
    protected $vars = null;
    protected $model = null;
    protected $view = null;
    protected $app = null;
    protected $user = null;

    public function __CONSTRUCT() {
        ecpimport("components.overleg.overlegobserver"); //observer interface
        ecpimport("components.overleg.overlegobservable"); //observable (subject) interface
        ecpimport("components.omb.ombmodel"); //std model
        ecpimport("components.omb.ombview"); //std view
        $this->action = "std_command";
        $this->app = ECPFactory::getApp(); //haal de app op om template te gaan veranderen
        $this->user = $this->app->getUser(); //via de app de user ophalen zodat we zeker de huidige user hebben :)
        $this->model = new ECP_Comp_OmbModel($this->user->getUserId());
        $this->view = new ECP_Comp_OmbView($this->app);
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
        $this->ouderzorg();
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
            ecpexit();
        }
    }

    public function ouderzorg() {
        ecpimport("components.omb.listel.ombform");
        $formmodel = new ECP_Comp_OmbForm();
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $contactwijze = $this->model->getContactwijze();
            $formmodel->updateContactwijzeList($contactwijze);
            $this->view->viewBase($formmodel->getBaseForm());
        } else {
            echo '{"succes":"negative","message":"Oei het loopt even mis!<br/>De server ontving geen waarden van het formulier..."}';
            ecpexit();
        }
    }

    public function nieuw() {
        ecpimport("components.omb.listel.ombform");
        $formmodel = new ECP_Comp_OmbForm();
        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            $contactwijze = $this->model->getContactwijze();

            $formmodel->updateContactwijzeList($contactwijze);
            $this->view->viewBase($formmodel->getBaseForm());
        } else {
            echo '{"succes":"negative","message":"Oei het loopt even mis!<br/>De server ontving geen waarden van het formulier..."}';
            ecpexit();
        }
    }

}

?>
